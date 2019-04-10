<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LiveFeed extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'live_feed';

    /**
     * Primary key field.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable. Fillable fields for a patient.
     *
     * @var array
     */
    protected $fillable = ['feed_id', 'company_id', 'is_published', 'published_by'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get live_feed's feed
     */
    public function Feed()
    {
        return $this->hasOne('App\Models\Feed', 'id', 'feed_id');
    }

    /**
     * Get live_feed's feed items
     */
    public function FeedItems()
    {
        return $this->hasMany('App\Models\FeedItems', 'feed_id', 'feed_id');
    }

    /**
     * Get live_feed's creator
     */
    public function Creator()
    {
        return $this->hasOne('App\Models\Users', 'id', 'created_by');
    }
}