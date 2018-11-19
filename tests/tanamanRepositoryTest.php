<?php

use App\Models\tanaman;
use App\Repositories\tanamanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tanamanRepositoryTest extends TestCase
{
    use MaketanamanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var tanamanRepository
     */
    protected $tanamanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tanamanRepo = App::make(tanamanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatetanaman()
    {
        $tanaman = $this->faketanamanData();
        $createdtanaman = $this->tanamanRepo->create($tanaman);
        $createdtanaman = $createdtanaman->toArray();
        $this->assertArrayHasKey('id', $createdtanaman);
        $this->assertNotNull($createdtanaman['id'], 'Created tanaman must have id specified');
        $this->assertNotNull(tanaman::find($createdtanaman['id']), 'tanaman with given id must be in DB');
        $this->assertModelData($tanaman, $createdtanaman);
    }

    /**
     * @test read
     */
    public function testReadtanaman()
    {
        $tanaman = $this->maketanaman();
        $dbtanaman = $this->tanamanRepo->find($tanaman->id);
        $dbtanaman = $dbtanaman->toArray();
        $this->assertModelData($tanaman->toArray(), $dbtanaman);
    }

    /**
     * @test update
     */
    public function testUpdatetanaman()
    {
        $tanaman = $this->maketanaman();
        $faketanaman = $this->faketanamanData();
        $updatedtanaman = $this->tanamanRepo->update($faketanaman, $tanaman->id);
        $this->assertModelData($faketanaman, $updatedtanaman->toArray());
        $dbtanaman = $this->tanamanRepo->find($tanaman->id);
        $this->assertModelData($faketanaman, $dbtanaman->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletetanaman()
    {
        $tanaman = $this->maketanaman();
        $resp = $this->tanamanRepo->delete($tanaman->id);
        $this->assertTrue($resp);
        $this->assertNull(tanaman::find($tanaman->id), 'tanaman should not exist in DB');
    }
}
