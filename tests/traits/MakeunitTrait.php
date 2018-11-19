<?php

use Faker\Factory as Faker;
use App\Models\unit;
use App\Repositories\unitRepository;

trait MakeunitTrait
{
    /**
     * Create fake instance of unit and save it in database
     *
     * @param array $unitFields
     * @return unit
     */
    public function makeunit($unitFields = [])
    {
        /** @var unitRepository $unitRepo */
        $unitRepo = App::make(unitRepository::class);
        $theme = $this->fakeunitData($unitFields);
        return $unitRepo->create($theme);
    }

    /**
     * Get fake instance of unit
     *
     * @param array $unitFields
     * @return unit
     */
    public function fakeunit($unitFields = [])
    {
        return new unit($this->fakeunitData($unitFields));
    }

    /**
     * Get fake data of unit
     *
     * @param array $postFields
     * @return array
     */
    public function fakeunitData($unitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'katalog_tanaman_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $unitFields);
    }
}
