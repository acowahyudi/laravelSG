<?php

use App\Models\unit;
use App\Repositories\unitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class unitRepositoryTest extends TestCase
{
    use MakeunitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var unitRepository
     */
    protected $unitRepo;

    public function setUp()
    {
        parent::setUp();
        $this->unitRepo = App::make(unitRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateunit()
    {
        $unit = $this->fakeunitData();
        $createdunit = $this->unitRepo->create($unit);
        $createdunit = $createdunit->toArray();
        $this->assertArrayHasKey('id', $createdunit);
        $this->assertNotNull($createdunit['id'], 'Created unit must have id specified');
        $this->assertNotNull(unit::find($createdunit['id']), 'unit with given id must be in DB');
        $this->assertModelData($unit, $createdunit);
    }

    /**
     * @test read
     */
    public function testReadunit()
    {
        $unit = $this->makeunit();
        $dbunit = $this->unitRepo->find($unit->id);
        $dbunit = $dbunit->toArray();
        $this->assertModelData($unit->toArray(), $dbunit);
    }

    /**
     * @test update
     */
    public function testUpdateunit()
    {
        $unit = $this->makeunit();
        $fakeunit = $this->fakeunitData();
        $updatedunit = $this->unitRepo->update($fakeunit, $unit->id);
        $this->assertModelData($fakeunit, $updatedunit->toArray());
        $dbunit = $this->unitRepo->find($unit->id);
        $this->assertModelData($fakeunit, $dbunit->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteunit()
    {
        $unit = $this->makeunit();
        $resp = $this->unitRepo->delete($unit->id);
        $this->assertTrue($resp);
        $this->assertNull(unit::find($unit->id), 'unit should not exist in DB');
    }
}
