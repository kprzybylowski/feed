<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Companies extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
    protected $fillable = ['name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get company users
     */
    public function Users()
    {
    return $this->hasMany('App\Models\User', 'company_id', 'id');
    }

    /**
     * Get company images
     */
    public function Images()
    {
    return $this->hasMany('App\Models\Images', 'company_id', 'id');
    }

    /**
     * Get company feeds
     */
    public function Feeds()
    {
    return $this->hasMany('App\Models\Feed', 'company_id', 'id');
    }
}