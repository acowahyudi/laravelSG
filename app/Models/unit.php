<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Unit
 * @package App\Models
 * @version November 23, 2018, 6:58 am UTC
 *
 * @property \App\Models\Tanaman tanaman
 * @property \Illuminate\Database\Eloquent\Collection hasil
 * @property \Illuminate\Database\Eloquent\Collection permissionRole
 * @property \Illuminate\Database\Eloquent\Collection roleUser
 * @property string nama
 * @property integer katalog_tanaman_id
 */
class Unit extends Model
{
    use SoftDeletes;

    public $table = 'unit';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'katalog_tanaman_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nama' => 'string',
        'katalog_tanaman_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tanaman()
    {
        return $this->belongsTo(\App\Models\Tanaman::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function jenisParameters()
    {
        //return $this->belongsToMany(\App\Models\JenisParameter::class, 'hasil');

        return $this->belongsToMany(\App\Models\JenisParameter::class,'hasil')
            ->using(\App\Models\Hasil::class)
            ->withPivot([
                'created_at',
                'value',
                'updated_at'
            ]);
    }
}
