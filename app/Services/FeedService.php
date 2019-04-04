<?php namespace App\Services;

use App\Models\User;
use App\Models\UsersRoles;
use App\Models\LiveFeed;
use App\Models\Feed;
use App\Models\FeedItems;

class FeedService
{
    protected $usersModel;
    protected $usersRolesModel;
    protected $liveFeedModel;
    protected $feedModel;
    protected $feedItemsModel;

    /**
     * Constructor
     * 
     * @param User       $users
     * @param UsersRoles $usersRoles
     * @param LiveFeed   $liveFeed
     * @param Feed       $feed
     * @param FeedItems  $feedItems
     * 
     * @return void
     */
    public function __construct(User $users, UsersRoles $usersRoles, LiveFeed $liveFeed, Feed $feed, FeedItems $feedItems)
    {
        $this->usersModel = $users;
        $this->usersRolesModel = $usersRoles;
        $this->liveFeedModel = $liveFeed;
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
}