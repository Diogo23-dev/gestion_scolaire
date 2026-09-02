<?php

use App\Models\Enrollment;
use App\Models\SchoolClass;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Livewire\Component;

new class extends Component
{
    public ?int $editingId = null;

    public $student_id = '';

    public $class_id = '';

    public $school_year_id = '';

    public function save(): void
    {
        $validated = $this->validate([
            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'school_year_id' => [
                'required',
                'exists:school_years,id',
                Rule::unique('enrollments', 'school_year_id')
                    ->where(fn ($query) => $query->where('student_id', $this->student_id))
                    ->ignore($this->editingId),
            ],
        ], [
            'student_id.required' => 'Veuillez sélectionner un élève.',
            'student_id.exists' => 'L’élève sélectionné est invalide.',

            'class_id.required' => 'Veuillez sélectionner une classe.',
            'class_id.exists' => 'La classe sélectionnée est invalide.',

            'school_year_id.required' => 'Veuillez sélectionner une année scolaire.',
            'school_year_id.exists' => 'L’année scolaire sélectionnée est invalide.',
            'school_year_id.unique' => 'Cet élève est déjà inscrit pour cette année scolaire.',
        ]);

        if ($this->editingId) {
            $enrollment = Enrollment::findOrFail($this->editingId);

            $enrollment->update($validated);

            session()->flash(
                'success',
                'L’inscription a été modifiée avec succès.'
            );
        } else {
            Enrollment::create($validated);

            session()->flash(
                'success',
                'L’élève a été inscrit avec succès.'
            );
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $enrollment = Enrollment::findOrFail($id);

        $this->editingId = $enrollment->id;
        $this->student_id = $enrollment->student_id;
        $this->class_id = $enrollment->class_id;
        $this->school_year_id = $enrollment->school_year_id;

        $this->resetValidation();
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        $enrollment = Enrollment::withCount('grades')->findOrFail($id);

        if ($enrollment->grades_count > 0) {
            session()->flash(
                'error',
                'Cette inscription ne peut pas être supprimée car elle possède des notes.'
            );

            return;
        }

        $enrollment->delete();

        session()->flash(
            'success',
            'L’inscription a été supprimée avec succès.'
        );

        if ($this->editingId === $id) {
            $this->resetForm();
        }
    }

    private function resetForm(): void
    {
        $this->reset([
            'editingId',
            'student_id',
            'class_id',
            'school_year_id',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('components.enrollments.⚡index.index', [
            'enrollments' => Enrollment::with([
                'student',
                'schoolClass.level',
                'schoolYear',
            ])
                ->withCount('grades')
                ->latest()
                ->get(),

            'students' => Student::orderBy('last_name')
                ->orderBy('first_name')
                ->get(),

            'classes' => SchoolClass::with('level')
                ->orderBy('name')
                ->get(),

            'schoolYears' => SchoolYear::orderByDesc('starts_at')
                ->get(),
        ]);
    }
};
