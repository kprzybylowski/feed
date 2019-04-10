<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Exception;
use App\Services\FeedService;
use App\Services\UserService;
use App\Services\CompanyService;
use App\Services\ImagesService;

class FeedController extends Controller
{
    protected $feedService;
    protected $userService;
    protected $companyService;
    protected $imagesService;

    /**
     * Create a new controller instance.
     * 
     * @param FeedService    $feedService
     * @param UserService    $userService
     * @param CompanyService $companyService
     * @param ImagesService  $imagesService
     *
     * @return void
     */
    public function __construct(FeedService $feedService, UserService $userService, CompanyService $companyService, ImagesService $imagesService)
    {
        $this->feedService = $feedService;
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->imagesService = $imagesService;
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
        $auth = Auth::user();
        $user = $this->userService->getUser($auth->id);
        $feedList = $this->feedService->getFeedList($user);
        return view('feed_browse', ['feedList'=>$feedList, 'user'=>$user]);
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
        $id = $request->route('id');
        $auth = Auth::user();
        $user = $this->userService->getUser($auth->id);
        $companies = $this->companyService->getCompanies();
        $feed = !empty($id)?$this->feedService->getFeed($id, $user):null;
        $data = [
            'feed' => $feed,
            'created_by' => $user->id,
            'user_role' => $user->role->code,
            'company_id' => $user->company_id,
            'companies' => $companies,
        ];

        return view('feed_edit', ['data'=>$data]);
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
        $user = Auth::user();
        $company_id = isset($request->company_id)?$request->company_id:$user->company_id;
        $createdBy = $request->created_by;
        $name = $request->name;
        $feedData = [
            'company_id' => $company_id,
            'name' => $name,
            'created_by' => $createdBy,
        ];

        if (!empty($request->id)) {
            $feedData['id'] = $request->id;
        }

        $this->feedService->saveFeed($feedData);
        $message = empty($feedData['id'])?'Feed created successfully':'Feed updated successfully';
        $type = 'success';
        return redirect('/feed/browse')->with('message', $message)->with('type', $type);
    }


    /**
     * Publish feed
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        $user = Auth::user();
        $feedId = $request->route('id');
        $feed = $this->feedService->getFeed($feedId);

        $feedItemsData = $feed->items;
        $feedData = [
            'feed_id' => $feedId,
            'company_id' => $feed->company_id,
            'is_published' => true,
            'published_by' => $user->id
        ];

        $this->feedService->publishFeed($feedData, $feedItemsData);
        $message = 'Feed published successfully';
        $type = 'success';
        return redirect('/feed/browse')->with('message', $message)->with('type', $type);
    }

    /**
     * Delete feed
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->route('id');
        if (!empty($id)) {
            $this->feedService->deleteFeed($id);
        }

        $message = 'Feed deleted successfully';
        $type = 'success';
        return redirect('/feed/browse')->with('message', $message)->with('type', $type);
    }

    /**
     * Edit feed item
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function item_edit(Request $request)
    {
        $feedId = $request->route('feed_id');
        $itemId = $request->route('item_id');
        $auth = Auth::user();
        $user = $this->userService->getUser($auth->id);
        $feed = $this->feedService->getFeed($feedId);
        $images = $this->imagesService->getImages($feed->company_id);
        $item = !empty($itemId)?$this->feedService->getFeedItem($itemId):null;
        $data = [
            'item' => $item,
            'feed_id' => $feedId,
            'created_by' => $user->id,
            'images' => $images,
        ];

        return view('feed_item_edit', ['data'=>$data]);
    }

    /**
     * Save feed item
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function item_save(Request $request)
    {
        $user = Auth::user();
        $feedId = $request->feed_id;
        $maxSort = $this->feedService->findMaxSort($feedId);
        $createdBy = $request->created_by;
        $title = $request->title;
        $primaryImage = $request->primary_image;
        $secondaryImage = $request->secondary_image;
        $itemData = [
            'feed_id' => $feedId,
            'title' => $title,
            'created_by' => $createdBy,
            'primary_image' => $primaryImage,
            'secondary_image' => $secondaryImage,
            'sort' => $maxSort + 1,
        ];

        if (!empty($request->id)) {
            $itemData['id'] = $request->id;
        }

        $this->feedService->saveFeedItem($itemData);
        $message = empty($itemData['id'])?'Feed item created successfully':'Feed item updated successfully';
        $type = 'success';
        return redirect('/feed/edit/'.$feedId)->with('message', $message)->with('type', $type);
    }

    /**
     * Delete feed item
     * 
     * @param \Illuminate\Http\Request $request Request data collection
     *
     * @return \Illuminate\Http\Response
     */
    public function item_delete(Request $request)
    {
        $id = $request->route('id');
        $item = $this->feedService->getFeedItem($id);
        if (!empty($id)) {
            $this->feedService->deleteFeedItem($id);
        }

        $message = 'Feed item deleted successfully';
        $type = 'success';
        return redirect('/feed/edit/'.$item->feed_id)->with('message', $message)->with('type', $type);
    }
}
