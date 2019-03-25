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
     * Action generates live feed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $liveFeed = $this->feedService->getLiveFeed();
        $jsonFeed = json_encode($liveFeed, JSON_UNESCAPED_SLASHES);

        return $jsonFeed;
    }

    /**
     * Edit feed
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function browse(Request $request)
    {
        return view('feed_browse');
    }

    /**
     * Edit feed
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view('feed_edit');
    }

    /**
     * Save feed
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        return redirect('/feed/browse')->with($message, $message)->with('type', $type);

    }
}
