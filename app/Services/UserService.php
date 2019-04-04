<?php namespace App\Services;

use App\Models\User;
use App\Models\UsersRoles;
use Illuminate\Support\Facades\Hash;

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
	public function getUser($id)
	{
        $user = $this->usersModel->with('Company')->with('Role')->find($id);
		return $user;
	}

	/**
	 * Method gets users roles
	 * 
	 * @return object
	 */
	public function getUsersRoles()
	{
        $roles = $this->usersRolesModel->get();
		return $roles;
	}

	/**
	 * Method gets users list
	 * 
	 * @return object
	 */
	public function getUsers()
	{
        $usersList = $this->usersModel->with('Company')->with('Role')->get();
		return $usersList;
	}

	/**
	 * Method saves/creates new company
     * 
     * @param array $data Company data collection
     * 
	 * @return object
	 */
	public function saveUser($data)
	{
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if (empty($data['id'])) {
            return $this->usersModel->create($data);
        } else {
            return $this->usersModel->where('id', $data['id'])->update($data);
        }
	}

	/**
	 * Method deletes user
     * 
     * @param integer $id User identifier
     * 
	 * @return object
	 */
	public function deleteUser($id)
	{
        if (!empty($id)) {
            return $this->usersModel->where('id', $id)->delete();
        }
	}
}