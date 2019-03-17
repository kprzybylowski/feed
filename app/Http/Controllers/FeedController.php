<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\FeedService;

class FeedController extends Controller
{
    protected $feedService;

    /**
     * Create a new controller instance.
     * 
     * @param FeedService $feedService
     *
     * @return void
     */
    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liveFeed = $this->feedService->getLiveFeed();
        $jsonFeed = json_encode($liveFeed, JSON_UNESCAPED_SLASHES);

        return $jsonFeed;
    }
}
