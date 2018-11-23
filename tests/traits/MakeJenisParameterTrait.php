<?php

use Faker\Factory as Faker;
use App\Models\JenisParameter;
use App\Repositories\JenisParameterRepository;

trait MakeJenisParameterTrait
{
    /**
     * Create fake instance of JenisParameter and save it in database
     *
     * @param array $jenisParameterFields
     * @return JenisParameter
     */
    public function makeJenisParameter($jenisParameterFields = [])
    {
        /** @var JenisParameterRepository $jenisParameterRepo */
        $jenisParameterRepo = App::make(JenisParameterRepository::class);
        $theme = $this->fakeJenisParameterData($jenisParameterFields);
        return $jenisParameterRepo->create($theme);
    }

    /**
     * Get fake instance of JenisParameter
     *
     * @param array $jenisParameterFields
     * @return JenisParameter
     */
    public function fakeJenisParameter($jenisParameterFields = [])
    {
        return new JenisParameter($this->fakeJenisParameterData($jenisParameterFields));
    }

    /**
     * Get fake data of JenisParameter
     *
     * @param array $postFields
     * @return array
     */
    public function fakeJenisParameterData($jenisParameterFields = [])
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
