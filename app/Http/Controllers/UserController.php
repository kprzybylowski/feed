<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\UserService;
use App\Services\CompanyService;

class UserController extends Controller
{
    protected $userService;
    protected $companyService;

    /**
     * Create a new controller instance.
     * 
     * @param UserService    $userService
     * @param CompanyService $companyService
     *
     * @return void
     */
    public function __construct(UserService $userService, CompanyService $companyService)
    {
        $this->userService = $userService;
        $this->companyService = $companyService;
    }

    /**
     * Shows a list of available users
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(Request $request)
    {
        $usersList = $this->userService->getUsers();
        return view('user_browse', ['users'=>$usersList]);
    }

    /**
     * Edit company
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->route('id');
        $user = null;
        $roles = $this->userService->getUsersRoles();
        $companies = $this->companyService->getCompanies();
        if (!empty($id)) {
            $user = $this->userService->getUser($id);
        }

        $data = [
            'user'      => $user,
            'roles'     => $roles,
            'companies' => $companies,
        ];

        return view('user_edit', $data);
    }

    /**
     * Save company
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $userData = $request->except(['_token']);
        if (!empty($userData)) {
            $this->userService->saveUser($userData);
        }

        $type = 'success';
        $message = empty($userData['id'])?'User created successfully':'User updated successfully';
        return redirect('/user/browse')->with('message', $message)->with('type', $type);
    }

    /**
     * Delete user
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->route('id');
        if (!empty($id)) {
            $this->userService->deleteUser($id);
        }

        $message = 'User deleted successfully';
        $type = 'success';
        return redirect('/user/browse')->with('message', $message)->with('type', $type);
    }
}
