<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $permissions = [
                [
                    "name" => "Create Video",
                    "guard_name" => "school"
                ],
                [
                    "name" => "Update Video",
                    "guard_name" => "school"
                ],
                [
                    "name" => "Delete Video",
                    "guard_name" => "school"
                ],
                [
                    "name" => "Read Video",
                    "guard_name" => "school"
                ],
                [
                    "name" => "Create Video",
                    "guard_name" => "admin"
                ],
                [
                    "name" => "Update Video",
                    "guard_name" => "admin"
                ],
                [
                    "name" => "Delete Video",
                    "guard_name" => "admin"
                ],
                [
                    "name" => "Read Video",
                    "guard_name" => "admin"
                ],
                [
                    "name" => "Delete Video",
                    "guard_name" => "student"
                ],
                [
                    "name" => "Read Video",
                    "guard_name" => "student"
                ],
            ];

            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
        } catch (\Throwable $th) {
           dd($th);
        }
    }
}
