<?php namespace App\Services;

use App\Models\User;
use App\Models\UsersRoles;
use App\Models\LiveFeed;
use App\Models\LiveFeedItems;
use App\Models\Feed;
use App\Models\FeedItems;

class FeedService
{
    protected $usersModel;
    protected $usersRolesModel;
    protected $liveFeedModel;
    protected $liveFeedItemsModel;
    protected $feedModel;
    protected $feedItemsModel;

    /**
     * Constructor
     * 
     * @param User          $users
     * @param UsersRoles    $usersRoles
     * @param LiveFeed      $liveFeed
     * @param LiveFeedItems $liveFeedItems
     * @param Feed          $feed
     * @param FeedItems     $feedItems
     * 
     * @return void
     */
    public function __construct(User $users, UsersRoles $usersRoles, LiveFeed $liveFeed, LiveFeedItems $liveFeedItems, Feed $feed, FeedItems $feedItems)
    {
        $this->usersModel = $users;
        $this->usersRolesModel = $usersRoles;
        $this->liveFeedModel = $liveFeed;
        $this->liveFeedItemsModel = $liveFeedItems;
        $this->feedModel = $feed;
        $this->feedItemsModel = $feedItems;
    }

    /**
     * Method gets public live feed
     * 
     * @return object
     */
    public function getLiveFeed()
    {
        $liveFeed = $this->liveFeedModel
            ->with([
                'FeedItems'=>function($query){
                    $query->orderBy('sort', 'asc');
                },
                'FeedItems.PrimaryImage',
                'FeedItems.SecondaryImage'
            ])
            ->leftJoin('feed', 'live_feed.feed_id', 'feed.id')
            ->leftJoin('companies', 'feed.company_id', 'companies.id')
            ->select(
                'live_feed.feed_id',
                'companies.name as company_name',
                'live_feed.company_id',
                'feed.name as feed_name'
            )
            ->where('live_feed.is_published', true)
            ->get();

        $data = [];
        if (!empty($liveFeed->toArray())) {
            $data = $liveFeed->map(function($row) {
                $items = $row->FeedItems->map(function($item) {
                    return [
                        'primary_image' => asset('storage/'.$item->PrimaryImage->name),
                        'secondary_image' => asset('storage/'.$item->SecondaryImage->name),
                        'title' => $item->title,
                        'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                        'updated_at' => $item->updated_at->format('Y-m-d H:i:s'),
                        'sort' => $item->sort,
                    ];
                });

                return [
                    'company_name' => $row->company_name,
                    'company_id' => $row->company_id,
                    'feed_items' => $items->toArray(),
                    'total_feed_items' => $row->FeedItems->count(),
                    'feed_name' => $row->feed_name,
                ];
            });
        }

        return $data;
    }

    /**
     * Method gets feed list
     * 
     * @param object $user Current user data object
     * 
     * @return object
     */
	public function getFeedList($user)
	{
        $feed = $this->feedModel->with('Company')->with('Creator')->with('Items');

        if ($user->role->code !== 'admin') {
            $feed->where('company_id', $user->company_id);
        }

        $feedList = $feed->get();
        return $feedList;
	}

	/**
	 * Method gets single feed with all related data (company, creator, items)
	 * 
	 * @param integer $id Feed identifier
	 * 
	 * @return object
	 */
	public function getFeed($id)
	{
        if (!empty($id)) {
            $feed = $this->feedModel->with('Company')->with('Creator')->with('Items')->with('Items.PrimaryImg')->with('Items.SecondaryImg')->find($id);
            return $feed;
        }
	}

	/**
     * Method saves single feed
     * 
     * @param object $data Feed data object
     * 
     * @return object
     */
    public function saveFeed($data)
    {
        if (empty($data['id'])) {
            return $this->feedModel->create($data);
        } else {
            return $this->feedModel->where('id', $data['id'])->update($data);
        }
    }

	/**
     * Method publishes single feed
     * 
     * @param array $feed  Feed data
     * @param array $items Feed items data
     * 
     * @return void
     */
    public function publishFeed($feed, $items)
    {
        $this->liveFeedModel->where('company_id', $feed['company_id'])->update(['is_published'=>false]);
        $liveFeed = new LiveFeed;
        $liveFeed->fill($feed);
        $liveFeed->save();

        foreach ($items as $item) {
            $itemData = [
                "live_feed_id" => $liveFeed->id,
                "primary_image" => $item->primary_image,
                "secondary_image" => $item->secondary_image,
                "title" => $item->title,
                "sort" => $item->sort,
                "created_by" => $item->created_by,
            ];

            $liveFeedItems = new LiveFeedItems;
            $liveFeedItems->fill($itemData);
            $liveFeedItems->save();
        }
    }

    /**
     * Method deletes feed
     * 
     * @param integer $id Feed identifier
     * 
     * @return object
     */
    public function deleteFeed($id)
    {
        if (!empty($id)) {
            return $this->feedModel->where('id', $id)->delete();
        }
    }

    /**
     * Method gets single feed item with related images
     * 
     * @param integer $id Feed item identifier
     * 
     * @return object
     */
    public function getFeedItem($id)
    {
        if (!empty($id)) {
            $item = $this->feedItemsModel->with('Creator')->with('PrimaryImg')->with('SecondaryImg')->find($id);
            return $item;
        }
    }

    /**
     * Method saves single feed item data
     * 
     * @param object $data Feed data object
     * 
     * @return object
     */
    public function saveFeedItem($data)
    {
        if (empty($data['id'])) {
            return $this->feedItemsModel->create($data);
        } else {
            return $this->feedItemsModel->where('id', $data['id'])->update($data);
        }
    }

    /**
     * Method gets item's max sort value for feed
     * 
     * @param object $feedId Feed identifier
     * 
     * @return object
     */
    public function findMaxSort($feedId)
    {
        return $this->feedItemsModel->where('feed_id', $feedId)->max('sort');
    }

    /**
     * Method deletes feed item
     * 
     * @param integer $id Feed item identifier
     * 
     * @return object
     */
    public function deleteFeedItem($id)
    {
        if (!empty($id)) {
            return $this->feedItemsModel->where('id', $id)->delete();
        }
    }

}