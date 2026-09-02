<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Str;

class StudentObserver
{
    /**
     * Génère automatiquement le matricule avant la création de l'élève.
     */
    public function creating(Student $student): void
    {
        do {
            $matricule = 'STU-' . strtoupper(Str::random(6));
        } while (Student::where('matricule', $matricule)->exists());

        $student->matricule = $matricule;
    }
}
