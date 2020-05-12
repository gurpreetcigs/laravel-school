<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $roles = [
                [
                    "name" => "admin",
                    "guard_name" => "admin"
                ],
                [
                    "name" => "student",
                    "guard_name" => "web"
                ],
                [
                    "name" => "school",
                    "guard_name" => "school"
                ],
            ];

            foreach ($roles as $role) {
                Role::create($role);
            }
        } catch (\Throwable $th) {
           dd($th);
        }
    }
}
