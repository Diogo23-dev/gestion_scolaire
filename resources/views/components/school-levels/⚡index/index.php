<?php

use App\Models\SchoolLevel;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public ?int $editingId = null;

    public function save(): void
    {
        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:school_levels,name,' . $this->editingId,
            ],
        ]);

        if ($this->editingId) {
            SchoolLevel::findOrFail($this->editingId)->update($validated);

            session()->flash('success', 'Niveau scolaire modifié avec succès.');
        } else {
            SchoolLevel::create($validated);

            session()->flash('success', 'Niveau scolaire ajouté avec succès.');
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $level = SchoolLevel::findOrFail($id);

        $this->editingId = $level->id;
        $this->name = $level->name;
    }

    public function delete(int $id): void
    {
        $level = SchoolLevel::findOrFail($id);

        if ($level->classes()->exists()) {
            session()->flash(
                'error',
                'Impossible de supprimer ce niveau car des classes y sont associées.'
            );

            return;
        }

        $level->delete();

        session()->flash('success', 'Niveau scolaire supprimé avec succès.');

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
            'editingId',
        ]);

        $this->resetValidation();
    }

    public function render()
    {
        return view('components.school-levels.⚡index.index', [
            'levels' => SchoolLevel::withCount('classes')
                ->orderBy('name')
                ->get(),
        ]);
    }
};