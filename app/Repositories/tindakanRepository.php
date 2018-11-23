<?php

namespace App\Repositories;

use App\Models\Tindakan;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TindakanRepository
 * @package App\Repositories
 * @version November 23, 2018, 7:00 am UTC
 *
 * @method Tindakan findWithoutFail($id, $columns = ['*'])
 * @method Tindakan find($id, $columns = ['*'])
 * @method Tindakan first($columns = ['*'])
*/
class TindakanRepository extends BaseRepository
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
        return Tindakan::class;
    }
}
