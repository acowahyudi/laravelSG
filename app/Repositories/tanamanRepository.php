<?php

namespace App\Repositories;

use App\Models\Tanaman;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TanamanRepository
 * @package App\Repositories
 * @version November 23, 2018, 7:01 am UTC
 *
 * @method Tanaman findWithoutFail($id, $columns = ['*'])
 * @method Tanaman find($id, $columns = ['*'])
 * @method Tanaman first($columns = ['*'])
*/
class TanamanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'gambar'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tanaman::class;
    }
}
