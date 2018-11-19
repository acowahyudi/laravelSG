<?php

namespace App\Repositories;

use App\Models\jenis_parameter;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class jenis_parameterRepository
 * @package App\Repositories
 * @version November 12, 2018, 1:46 pm UTC
 *
 * @method jenis_parameter findWithoutFail($id, $columns = ['*'])
 * @method jenis_parameter find($id, $columns = ['*'])
 * @method jenis_parameter first($columns = ['*'])
*/
class jenis_parameterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return jenis_parameter::class;
    }
}
