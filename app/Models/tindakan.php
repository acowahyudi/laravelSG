<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tindakan
 * @package App\Models
 * @version November 12, 2018, 1:47 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection hasil
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection TindakanTanaman
 * @property string nama
 */
class tindakan extends Model
{
    use SoftDeletes;

    public $table = 'tindakan';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tindakanTanamen()
    {
        return $this->hasMany(\App\Models\TindakanTanaman::class);
    }
}
