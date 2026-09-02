<?php

namespace Database\Seeders;

use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\SchoolLevel;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Utilisateur administrateur
        |--------------------------------------------------------------------------
        */

        User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Année scolaire
        |--------------------------------------------------------------------------
        */

        $schoolYear = SchoolYear::create([
            'name' => '2026-2027',
            'starts_at' => '2026-10-01',
            'ends_at' => '2027-07-31',
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Niveaux
        |--------------------------------------------------------------------------
        */

        $primary = SchoolLevel::create([
            'name' => 'Primaire',
        ]);

        $middleSchool = SchoolLevel::create([
            'name' => 'Collège',
        ]);

        $highSchool = SchoolLevel::create([
            'name' => 'Lycée',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classes = collect([
            ['name' => '6ème Année', 'level_id' => $primary->id],
            ['name' => '7ème Année', 'level_id' => $primary->id],

            ['name' => '8ème Année', 'level_id' => $middleSchool->id],
            ['name' => '9ème Année', 'level_id' => $middleSchool->id],

            ['name' => '10ème Année', 'level_id' => $highSchool->id],
            ['name' => '11ème Année', 'level_id' => $highSchool->id],
        ])->map(
            fn (array $class) => SchoolClass::create($class)
        );

        /*
        |--------------------------------------------------------------------------
        | Matières
        |--------------------------------------------------------------------------
        */

        $subjects = collect([
            [
                'name' => 'Mathématiques',
                'code' => 'MATH',
                'coefficient' => 2,
            ],
            [
                'name' => 'Français',
                'code' => 'FR',
                'coefficient' => 2,
            ],
            [
                'name' => 'Anglais',
                'code' => 'ANG',
                'coefficient' => 2,
            ],
            [
                'name' => 'Histoire',
                'code' => 'HIST',
                'coefficient' => 1,
            ],
            [
                'name' => 'Géographie',
                'code' => 'GEO',
                'coefficient' => 1,
            ],
            [
                'name' => 'Sciences',
                'code' => 'SCI',
                'coefficient' => 1,
            ],
            [
                'name' => 'Informatique',
                'code' => 'INFO',
                'coefficient' => 1,
            ],
        ])->map(
            fn (array $subject) => Subject::create($subject)
        );

        /*
        |--------------------------------------------------------------------------
        | Élèves + inscriptions + notes
        |--------------------------------------------------------------------------
        */

        Student::factory(30)->create()->each(
            function (Student $student) use ($classes, $schoolYear, $subjects) {

                $class = $classes->random();

                $enrollment = Enrollment::create([
                    'student_id' => $student->id,
                    'class_id' => $class->id,
                    'school_year_id' => $schoolYear->id,
                ]);

                $subjects->each(
                    function (Subject $subject) use ($enrollment) {

                        Grade::create([
                            'enrollment_id' => $enrollment->id,
                            'subject_id' => $subject->id,
                            'value' => fake()->randomFloat(2, 0, 10),
                        ]);
                    }
                );
            }
        );
    }
}
