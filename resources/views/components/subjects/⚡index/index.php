<?php

use App\Models\Subject;
use Livewire\Component;

new class extends Component
{
    public string $name = '';

    public string $code = '';

    public $coefficient = 1;

    public ?int $editingId = null;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50'],
            'coefficient' => ['required', 'integer', 'min:1', 'max:10'],
        ];
    }

    public function save(): void
    {
        $validated = $this->validate();

        if ($this->editingId) {
            $subject = Subject::findOrFail($this->editingId);

            $subject->update($validated);

            session()->flash('success', 'Matière modifiée avec succès.');
        } else {
            Subject::create($validated);

            session()->flash('success', 'Matière ajoutée avec succès.');
        }

        $this->resetForm();
    }

    public function edit(int $id): void
    {
        $subject = Subject::findOrFail($id);

        $this->editingId = $subject->id;
        $this->name = $subject->name;
        $this->code = $subject->code;
        $this->coefficient = $subject->coefficient;
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    public function delete(int $id): void
    {
        $subject = Subject::withCount('grades')->findOrFail($id);

        if ($subject->grades_count > 0) {
            session()->flash(
                'error',
                'Cette matière ne peut pas être supprimée car elle possède déjà des notes.'
            );

            return;
        }

        $subject->delete();

        session()->flash('success', 'Matière supprimée avec succès.');
    }

    private function resetForm(): void
    {
        $this->reset([
            'name',
            'code',
            'editingId',
        ]);

        $this->coefficient = 1;

        $this->resetValidation();
    }

    public function render()
    {
        return view('components.subjects.⚡index.index', [
            'subjects' => Subject::withCount('grades')
                ->orderBy('name')
                ->get(),
        ]);
    }
};
