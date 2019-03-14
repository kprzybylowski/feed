<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user's role
     */
    public function Role()
    {
        return $this->hasOne('App\Models\UsersRoles', 'id', 'role_id');
    }

    /**
     * Get user's company
     */
    public function Company()
    {
        return $this->hasOne('App\Models\Companies', 'id', 'company_id');
    }

    /**
     * Method creates the first admin user
     * 
     * @param string $email    User login
     * @param string $password User password
     * 
     * @return string
     */
    public function createAdminUser($email, $password)
    {
        $existing = $this->get()->count();
        if ($existing > 0) {
            return 'This method applies only for creating an initial application user. Try to log in using existing user credentials';
        } else {
            $adminName = 'Administrator';
            $adminCompanyName = 'Uniled';
            $role = DB::table('users_roles')->where('code', 'admin')->first()->id;
            $company = DB::table('companies')->insertGetId(['name' => 'Uniled', 'created_at' => now(), 'updated_at' => now()]);
            if (!empty($role) && !empty($company)) {
                $this->name = 'Administrator';
                $this->email = $email;
                $this->password = Hash::make($password);
                $this->company_id = $company;
                $this->role_id = $role;
                $this->save();
                return 'Admin user created.';
            } else {
                return 'No users roles or company available.';
            }
        }
    }
}
