<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\UsersRoles;

class InsertUsersRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        UsersRoles::query()->truncate();
        DB::statement('ALTER TABLE users_roles AUTO_INCREMENT = 1');
    }
}
