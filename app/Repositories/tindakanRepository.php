<?php

namespace App\Repositories;

use App\Models\tindakan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class tindakanRepository
 * @package App\Repositories
 * @version November 12, 2018, 1:47 pm UTC
 *
 * @method tindakan findWithoutFail($id, $columns = ['*'])
 * @method tindakan find($id, $columns = ['*'])
 * @method tindakan first($columns = ['*'])
*/
class tindakanRepository extends BaseRepository
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
        return tindakan::class;
    }
}
