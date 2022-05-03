<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Department::insert([
            ["name"=>"Marketing"],["name"=>"Management"],["name"=>"Development"],["name"=>"HR"]
            ]);
    }
}
