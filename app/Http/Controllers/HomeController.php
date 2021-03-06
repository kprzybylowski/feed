<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\UserService;

class HomeController extends Controller
{
    protected $userService;

    /**
     * Create a new controller instance.
     * 
     * @param UserService $userService
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth');
    }

    /**
     * Application index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/feed/browse');
    }
}
