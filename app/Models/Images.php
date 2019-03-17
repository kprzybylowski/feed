<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Images extends Model
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'images';

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
    protected $fillable = ['company_id', 'name', 'original_name', 'is_primary', 'created_by'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Get image's company
     */
    public function Company()
    {
        return $this->hasOne('App\Models\Companies', 'id', 'company_id');
    }

    /**
     * Get image's creator
     */
    public function Creator()
    {
        return $this->hasOne('App\Models\Users', 'id', 'created_by');
    }
}