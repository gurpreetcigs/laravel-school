<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $subjects = [
                [
                    "name" => "Maths",
                    "standard_id" => 1
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 1
                ],
                [
                    "name" => "English",
                    "standard_id" => 1
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 2
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 2
                ],
                [
                    "name" => "English",
                    "standard_id" => 2
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 3
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 3
                ],
                [
                    "name" => "English",
                    "standard_id" => 3
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 4
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 4
                ],
                [
                    "name" => "English",
                    "standard_id" => 4
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 5
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 5
                ],
                [
                    "name" => "English",
                    "standard_id" => 5
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 6
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 6
                ],
                [
                    "name" => "English",
                    "standard_id" => 6
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 7
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 7
                ],
                [
                    "name" => "English",
                    "standard_id" => 7
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 8
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 8
                ],
                [
                    "name" => "English",
                    "standard_id" => 8
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 9
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 9
                ],
                [
                    "name" => "English",
                    "standard_id" => 9
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 10
                ],
                [
                    "name" => "Hindi",
                    "standard_id" => 10
                ],
                [
                    "name" => "English",
                    "standard_id" => 10
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 11
                ],
                [
                    "name" => "Chemistry",
                    "standard_id" => 11
                ],
                [
                    "name" => "Physics",
                    "standard_id" => 11
                ],
                [
                    "name" => "Maths",
                    "standard_id" => 12
                ],
                [
                    "name" => "Chemistry",
                    "standard_id" => 12
                ],
                [
                    "name" => "Physics",
                    "standard_id" => 12
                ],
            ];

            foreach ($subjects as $subject) {
                Subject::create($subject);
            }
        } catch (\Throwable $th) {
           dd($th);
        }
    }
}
