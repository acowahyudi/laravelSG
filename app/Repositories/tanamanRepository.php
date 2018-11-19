<?php

namespace App\Repositories;

use App\Models\tanaman;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tanamanRepository
 * @package App\Repositories
 * @version November 12, 2018, 1:46 pm UTC
 *
 * @method tanaman findWithoutFail($id, $columns = ['*'])
 * @method tanaman find($id, $columns = ['*'])
 * @method tanaman first($columns = ['*'])
*/
class tanamanRepository extends BaseRepository
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
        return tanaman::class;
    }
}
