<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     * 
     * @param CompanyService $companyService
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
        return view('user_browse');
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
        return view('user_edit');
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
        return redirect('/user/browse')->with($message, $message)->with('type', $type);
    }
}
