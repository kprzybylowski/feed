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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentUser = $this->userService->getCurrentUser($user->id);
        dump($currentUser->role->code);

        return view('home');
    }
}
