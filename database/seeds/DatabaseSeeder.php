<?php

use Illuminate\Database\Seeder;
use App\Models\UsersRoles;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Administrator',
                'code' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'code' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        UsersRoles::insert($roles);
    }
}
