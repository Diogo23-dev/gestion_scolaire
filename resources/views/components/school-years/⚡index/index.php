<?php

use App\Models\SchoolYear;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public string $starts_at = '';

    public string $ends_at = '';

    public bool $is_active = false;

    public bool $showForm = false;

    public ?int $editingId = null;

    public function create(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'is_active' => ['boolean'],
        ]);

        if ($this->is_active) {
            SchoolYear::query()
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        SchoolYear::create([
            'name' => $this->name,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();

        session()->flash('success', 'L’année scolaire a été créée avec succès.');
    }

    public function edit(int $id): void
    {
        $schoolYear = SchoolYear::findOrFail($id);

        $this->editingId = $schoolYear->id;
        $this->name = $schoolYear->name;
        $this->starts_at = $schoolYear->starts_at->format('Y-m-d');
        $this->ends_at = $schoolYear->ends_at->format('Y-m-d');
        $this->is_active = $schoolYear->is_active;

        $this->showForm = true;
    }

    public function update(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'is_active' => ['boolean'],
        ]);

        $schoolYear = SchoolYear::findOrFail($this->editingId);

        if ($this->is_active) {
            SchoolYear::query()
                ->where('id', '!=', $schoolYear->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $schoolYear->update([
            'name' => $this->name,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'is_active' => $this->is_active,
        ]);

        $this->resetForm();

        session()->flash('success', 'L’année scolaire a été modifiée avec succès.');
    }

    public function toggleActive(int $id): void
    {
        $schoolYear = SchoolYear::findOrFail($id);

        if ($schoolYear->is_active) {
            $schoolYear->update([
                'is_active' => false,
            ]);

            session()->flash('success', 'L’année scolaire a été désactivée.');

            return;
        }

        SchoolYear::query()
            ->where('is_active', true)
            ->update(['is_active' => false]);

        $schoolYear->update([
            'is_active' => true,
        ]);

        session()->flash('success', 'L’année scolaire a été activée.');
    }

    public function delete(int $id): void
    {
        $schoolYear = SchoolYear::findOrFail($id);

        if ($schoolYear->enrollments()->exists()) {
            session()->flash(
                'error',
                'Cette année scolaire ne peut pas être supprimée car elle possède des inscriptions.'
            );

            return;
        }

        $schoolYear->delete();

        session()->flash('success', 'L’année scolaire a été supprimée.');
    }

    public function resetForm(): void
    {
        $this->reset([
            'name',
            'starts_at',
            'ends_at',
            'is_active',
            'editingId',
        ]);

        $this->showForm = false;
        $this->resetValidation();
    }

    public function with(): array
    {
        return [
            'schoolYears' => SchoolYear::query()
                ->withCount('enrollments')
                ->orderByDesc('starts_at')
                ->get(),
        ];
    }
};
