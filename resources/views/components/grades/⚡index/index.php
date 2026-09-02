<?php

use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Subject;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component
{
    public $school_year_id = '';

    public $class_id = '';

    public $subject_id = '';

    public array $grades = [];

    public Collection $schoolYears;

    public Collection $classes;

    public Collection $subjects;

    public Collection $students;

    public function mount(): void
    {
        $this->schoolYears = SchoolYear::orderByDesc('starts_at')->get();

        $this->classes = collect();

        $this->subjects = Subject::orderBy('name')->get();

        $this->students = collect();
    }

    public function updatedSchoolYearId(): void
    {
        $this->class_id = '';

        $this->grades = [];

        $this->students = collect();

        $this->loadClasses();
    }

    public function updatedClassId(): void
    {
        $this->subject_id = '';

        $this->grades = [];

        $this->students = collect();

        $this->loadStudents();
    }

    public function updatedSubjectId(): void
    {
        $this->grades = [];

        $this->loadGrades();
    }

    private function loadClasses(): void
    {
        if (!$this->school_year_id) {
            $this->classes = collect();

            return;
        }

        $this->classes = SchoolClass::with('level')
            ->whereHas('enrollments', function ($query) {
                $query->where('school_year_id', $this->school_year_id);
            })
            ->orderBy('name')
            ->get();
    }

    private function loadStudents(): void
    {
        if (!$this->school_year_id || !$this->class_id) {
            $this->students = collect();

            return;
        }

        $this->students = SchoolClass::findOrFail($this->class_id)
            ->enrollments()
            ->where('school_year_id', $this->school_year_id)
            ->with('student')
            ->get()
            ->pluck('student');

        $this->grades = [];

        foreach ($this->students as $student) {
            $this->grades[$student->id] = '';
        }

        $this->loadGrades();
    }

    private function loadGrades(): void
    {
        if (
            !$this->school_year_id ||
            !$this->class_id ||
            !$this->subject_id
        ) {
            return;
        }

        $enrollmentIds = SchoolClass::findOrFail($this->class_id)
            ->enrollments()
            ->where('school_year_id', $this->school_year_id)
            ->pluck('id');

        $existingGrades = Grade::whereIn('enrollment_id', $enrollmentIds)
            ->where('subject_id', $this->subject_id)
            ->get()
            ->keyBy('enrollment_id');

        foreach ($this->students as $student) {
            $enrollment = $student->enrollments()
                ->where('school_year_id', $this->school_year_id)
                ->where('class_id', $this->class_id)
                ->first();

            if (!$enrollment) {
                continue;
            }

            $this->grades[$student->id] =
                $existingGrades[$enrollment->id]->value ?? '';
        }
    }

    public function save(): void
    {
        $this->validate([
            'school_year_id' => ['required', 'exists:school_years,id'],
            'class_id' => ['required', 'exists:school_classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'grades' => ['required', 'array'],
            'grades.*' => ['nullable', 'numeric', 'min:0', 'max:20'],
        ], [
            'school_year_id.required' => 'Veuillez sélectionner une année scolaire.',
            'class_id.required' => 'Veuillez sélectionner une classe.',
            'subject_id.required' => 'Veuillez sélectionner une matière.',
            'grades.*.numeric' => 'La note doit être un nombre.',
            'grades.*.min' => 'La note ne peut pas être inférieure à 0.',
            'grades.*.max' => 'La note ne peut pas être supérieure à 20.',
        ]);

        foreach ($this->students as $student) {

            $value = $this->grades[$student->id] ?? null;

            $enrollment = $student->enrollments()
                ->where('school_year_id', $this->school_year_id)
                ->where('class_id', $this->class_id)
                ->first();

            if (!$enrollment) {
                continue;
            }

            if ($value === '' || $value === null) {
                Grade::where('enrollment_id', $enrollment->id)
                    ->where('subject_id', $this->subject_id)
                    ->delete();

                continue;
            }

            Grade::updateOrCreate(
                [
                    'enrollment_id' => $enrollment->id,
                    'subject_id' => $this->subject_id,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        session()->flash(
            'success',
            'Les notes ont été enregistrées avec succès.'
        );

        $this->loadGrades();
    }

    public function render()
    {
        return view('components.grades.⚡index.index');
    }
};