<?php

use App\Models\tindakan;
use App\Repositories\tindakanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tindakanRepositoryTest extends TestCase
{
    use MaketindakanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var tindakanRepository
     */
    protected $tindakanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tindakanRepo = App::make(tindakanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetindakan()
    {
        $tindakan = $this->faketindakanData();
        $createdtindakan = $this->tindakanRepo->create($tindakan);
        $createdtindakan = $createdtindakan->toArray();
        $this->assertArrayHasKey('id', $createdtindakan);
        $this->assertNotNull($createdtindakan['id'], 'Created tindakan must have id specified');
        $this->assertNotNull(tindakan::find($createdtindakan['id']), 'tindakan with given id must be in DB');
        $this->assertModelData($tindakan, $createdtindakan);
    }

    /**
     * @test read
     */
    public function testReadtindakan()
    {
        $tindakan = $this->maketindakan();
        $dbtindakan = $this->tindakanRepo->find($tindakan->id);
        $dbtindakan = $dbtindakan->toArray();
        $this->assertModelData($tindakan->toArray(), $dbtindakan);
    }

    /**
     * @test update
     */
    public function testUpdatetindakan()
    {
        $tindakan = $this->maketindakan();
        $faketindakan = $this->faketindakanData();
        $updatedtindakan = $this->tindakanRepo->update($faketindakan, $tindakan->id);
        $this->assertModelData($faketindakan, $updatedtindakan->toArray());
        $dbtindakan = $this->tindakanRepo->find($tindakan->id);
        $this->assertModelData($faketindakan, $dbtindakan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetindakan()
    {
        $tindakan = $this->maketindakan();
        $resp = $this->tindakanRepo->delete($tindakan->id);
        $this->assertTrue($resp);
        $this->assertNull(tindakan::find($tindakan->id), 'tindakan should not exist in DB');
    }
}
