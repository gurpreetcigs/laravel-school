<?php

use Illuminate\Database\Seeder;
use App\Standard;

class StandardClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $standards = [
                [
                    "name" => "Class 1",
                    "value" => 1
                ],
                [
                    "name" => "Class 2",
                    "value" => 2
                ],
                [
                    "name" => "Class 3",
                    "value" => 3
                ],
                [
                    "name" => "Class 4",
                    "value" => 4
                ],
                [
                    "name" => "Class 5",
                    "value" => 5
                ],
                [
                    "name" => "Class 6",
                    "value" => 6
                ],
                [
                    "name" => "Class 7",
                    "value" => 7
                ],
                [
                    "name" => "Class 8",
                    "value" => 8
                ],
                [
                    "name" => "Class 9",
                    "value" => 9
                ],
                [
                    "name" => "Class 10",
                    "value" => 10
                ],
                [
                    "name" => "Class 11",
                    "value" => 11
                ],
                [
                    "name" => "Class 12",
                    "value" => 12
                ],
            ];

            foreach ($standards as $standard) {
                Standard::create($standard);
            }
        } catch (\Throwable $th) {
           dd($th);
        }
        
    }
}
