<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class tanaman
 * @package App\Models
 * @version November 12, 2018, 1:46 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection hasil
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property \App\Models\TindakanTanaman tindakanTanaman
 * @property \Illuminate\Database\Eloquent\Collection Unit
 * @property string nama
 * @property string gambar
 */
class tanaman extends Model
{
    use SoftDeletes;

    public $table = 'tanaman';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'gambar'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'gambar' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function tindakanTanaman()
    {
        return $this->hasOne(\App\Models\TindakanTanaman::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function units()
    {
        return $this->hasMany(\App\Models\Unit::class);
    }
}
