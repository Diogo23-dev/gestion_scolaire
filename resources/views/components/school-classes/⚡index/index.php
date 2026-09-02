<?php

use App\Models\SchoolClass;
use App\Models\SchoolLevel;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public ?int $level_id = null;

    public ?int $editingId = null;

    public function save(): void
    {
        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'level_id' => [
                'required',
                'exists:school_levels,id',
            ],
        ]);

        if ($this->editingId) {
            SchoolClass::findOrFail($this->editingId)->update($validated);

            session()->flash(
                'success',
                'Classe modifiée avec succès.'
            );
        } else {
            SchoolClass::create($validated);

            session()->flash(
                'success',
                'Classe ajoutée avec succès.'
            );
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $class = SchoolClass::findOrFail($id);

        $this->editingId = $class->id;
        $this->name = $class->name;
        $this->level_id = $class->level_id;
    }

    public function delete(int $id): void
    {
        $class = SchoolClass::findOrFail($id);

        if ($class->enrollments()->exists()) {
            session()->flash(
                'error',
                'Impossible de supprimer cette classe car des élèves y sont inscrits.'
            );

            return;
        }

        $class->delete();

        session()->flash(
            'success',
            'Classe supprimée avec succès.'
        );

        $this->resetForm();
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'name',
            'level_id',
            'editingId',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('components.school-classes.⚡index.index', [
            'classes' => SchoolClass::with('level')
                ->withCount('enrollments')
                ->orderBy('name')
                ->get(),

            'levels' => SchoolLevel::orderBy('name')->get(),
        ]);
    }
};
