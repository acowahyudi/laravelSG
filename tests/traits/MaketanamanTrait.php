<?php

use Faker\Factory as Faker;
use App\Models\tanaman;
use App\Repositories\tanamanRepository;

trait MaketanamanTrait
{
    /**
     * Create fake instance of tanaman and save it in database
     *
     * @param array $tanamanFields
     * @return tanaman
     */
    public function maketanaman($tanamanFields = [])
    {
        /** @var tanamanRepository $tanamanRepo */
        $tanamanRepo = App::make(tanamanRepository::class);
        $theme = $this->faketanamanData($tanamanFields);
        return $tanamanRepo->create($theme);
    }

    /**
     * Get fake instance of tanaman
     *
     * @param array $tanamanFields
     * @return tanaman
     */
    public function faketanaman($tanamanFields = [])
    {
        return new tanaman($this->faketanamanData($tanamanFields));
    }

    /**
     * Get fake data of tanaman
     *
     * @param array $postFields
     * @return array
     */
    public function faketanamanData($tanamanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'gambar' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $tanamanFields);
    }
}
