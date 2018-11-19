<?php

use Faker\Factory as Faker;
use App\Models\tindakan;
use App\Repositories\tindakanRepository;

trait MaketindakanTrait
{
    /**
     * Create fake instance of tindakan and save it in database
     *
     * @param array $tindakanFields
     * @return tindakan
     */
    public function maketindakan($tindakanFields = [])
    {
        /** @var tindakanRepository $tindakanRepo */
        $tindakanRepo = App::make(tindakanRepository::class);
        $theme = $this->faketindakanData($tindakanFields);
        return $tindakanRepo->create($theme);
    }

    /**
     * Get fake instance of tindakan
     *
     * @param array $tindakanFields
     * @return tindakan
     */
    public function faketindakan($tindakanFields = [])
    {
        return new tindakan($this->faketindakanData($tindakanFields));
    }

    /**
     * Get fake data of tindakan
     *
     * @param array $postFields
     * @return array
     */
    public function faketindakanData($tindakanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $tindakanFields);
    }
}
