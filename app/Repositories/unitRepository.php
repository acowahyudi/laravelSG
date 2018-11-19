<?php

namespace App\Repositories;

use App\Models\unit;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class unitRepository
 * @package App\Repositories
 * @version November 12, 2018, 1:47 pm UTC
 *
 * @method unit findWithoutFail($id, $columns = ['*'])
 * @method unit find($id, $columns = ['*'])
 * @method unit first($columns = ['*'])
*/
class unitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'katalog_tanaman_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return unit::class;
    }
}
