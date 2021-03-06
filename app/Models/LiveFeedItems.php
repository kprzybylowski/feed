<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class LiveFeedItems extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'live_feed_items';

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
    protected $fillable = ['live_feed_id', 'primary_image', 'secondary_image', 'title', 'created_by', 'sort'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get feed_items's feed
     */
    public function LiveFeed()
    {
        return $this->hasOne('App\Models\LiveFeed', 'id', 'live_feed_id');
    }

    /**
     * Get feed_item's creator
     */
    public function Creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    /**
     * Get feed_item's primary image
     */
    public function PrimaryImg()
    {
        return $this->hasOne('App\Models\Images', 'id', 'primary_image');
    }

    /**
     * Get feed_item's secondary image
     */
    public function SecondaryImg()
    {
        return $this->hasOne('App\Models\Images', 'id', 'secondary_image');
    }
}