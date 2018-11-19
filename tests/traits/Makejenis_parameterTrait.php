<?php

use Faker\Factory as Faker;
use App\Models\jenis_parameter;
use App\Repositories\jenis_parameterRepository;

trait Makejenis_parameterTrait
{
    /**
     * Create fake instance of jenis_parameter and save it in database
     *
     * @param array $jenisParameterFields
     * @return jenis_parameter
     */
    public function makejenis_parameter($jenisParameterFields = [])
    {
        /** @var jenis_parameterRepository $jenisParameterRepo */
        $jenisParameterRepo = App::make(jenis_parameterRepository::class);
        $theme = $this->fakejenis_parameterData($jenisParameterFields);
        return $jenisParameterRepo->create($theme);
    }

    /**
     * Get fake instance of jenis_parameter
     *
     * @param array $jenisParameterFields
     * @return jenis_parameter
     */
    public function fakejenis_parameter($jenisParameterFields = [])
    {
        return new jenis_parameter($this->fakejenis_parameterData($jenisParameterFields));
    }

    /**
     * Get fake data of jenis_parameter
     *
     * @param array $postFields
     * @return array
     */
    public function fakejenis_parameterData($jenisParameterFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $jenisParameterFields);
    }
}
