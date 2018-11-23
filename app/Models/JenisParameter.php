<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JenisParameter
 * @package App\Models
 * @version November 23, 2018, 8:21 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection hasil
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \Illuminate\Database\Eloquent\Collection TindakanTanaman
 * @property string nama
 */
class JenisParameter extends Model
{
    use SoftDeletes;

    public $table = 'jenis_parameter';
    
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function units()
    {
        //return $this->belongsToMany(\App\Models\Unit::class, 'hasil');
        return $this->belongsToMany(\App\Models\Unit::class,'hasil')
            ->using(\App\Models\Hasil::class)
            ->withPivot([
                'value'
            ])->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tindakanTanamen()
    {
        return $this->hasMany(\App\Models\TindakanTanaman::class);
    }
}
