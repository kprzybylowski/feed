<?php namespace App\Services;

use App\Models\User;
use App\Models\UsersRoles;

class UserService
{
    protected $usersModel;
    protected $usersRolesModel;

    /**
     * Constructor
     * 
     * @param User       $users
     * @param UsersRoles $usersRoles
	 * 
	 * @return void
     */
    public function __construct(User $users, UsersRoles $usersRoles)
    {
        $this->usersModel = $users;
        $this->usersRolesModel = $usersRoles;
    }

	/**
	 * Method gets user with all related data (company, role)
	 * 
	 * @param integer $id User identifier
	 * 
	 * @return object
	 */
	public function getCurrentUser($id)
	{
        $currentUser = $this->usersModel->with('Company')->with('Role')->find($id);
		return $currentUser;
	}

	/**
	 * Method gets users list
	 * 
	 * @return object
	 */
	public function getUses()
	{
        $usersList = $this->usersModel->with('Company')->with('Role')->get();
		return $usersList;
	}
}