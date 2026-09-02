<?php

use App\Models\Student;
use Livewire\Component;

new class extends Component
{
    public $first_name = '';

    public $last_name = '';

    public $date_of_birth = '';

    public $gender = '';

    public $editingId = null;

    public function save(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:M,F'],
        ], [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'date_of_birth.required' => 'La date de naissance est obligatoire.',
            'date_of_birth.before' => 'La date de naissance doit être antérieure à aujourd’hui.',
            'gender.required' => 'Le sexe est obligatoire.',
            'gender.in' => 'Veuillez sélectionner un sexe valide.',
        ]);

        if ($this->editingId) {
            Student::findOrFail($this->editingId)->update($validated);

            session()->flash('success', 'Élève modifié avec succès.');
        } else {
            Student::create($validated);

            session()->flash('success', 'Élève ajouté avec succès.');
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $student = Student::findOrFail($id);

        $this->editingId = $student->id;
        $this->first_name = $student->first_name;
        $this->last_name = $student->last_name;
        $this->date_of_birth = $student->date_of_birth->format('Y-m-d');
        $this->gender = $student->gender;
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        $student = Student::withCount('enrollments')->findOrFail($id);

        if ($student->enrollments_count > 0) {
            session()->flash(
                'error',
                'Cet élève ne peut pas être supprimé car il possède des inscriptions.'
            );

            return;
        }

        $student->delete();

        session()->flash('success', 'Élève supprimé avec succès.');
    }

    private function resetForm(): void
    {
        $this->reset([
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'editingId',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('components.students.⚡index.index', [
            'students' => Student::withCount('enrollments')
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->get(),
        ]);
    }
};
