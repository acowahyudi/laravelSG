<?php

use App\Models\JenisParameter;
use App\Repositories\JenisParameterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisParameterRepositoryTest extends TestCase
{
    use MakeJenisParameterTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var JenisParameterRepository
     */
    protected $jenisParameterRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jenisParameterRepo = App::make(JenisParameterRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateJenisParameter()
    {
        $jenisParameter = $this->fakeJenisParameterData();
        $createdJenisParameter = $this->jenisParameterRepo->create($jenisParameter);
        $createdJenisParameter = $createdJenisParameter->toArray();
        $this->assertArrayHasKey('id', $createdJenisParameter);
        $this->assertNotNull($createdJenisParameter['id'], 'Created JenisParameter must have id specified');
        $this->assertNotNull(JenisParameter::find($createdJenisParameter['id']), 'JenisParameter with given id must be in DB');
        $this->assertModelData($jenisParameter, $createdJenisParameter);
    }

    /**
     * @test read
     */
    public function testReadJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $dbJenisParameter = $this->jenisParameterRepo->find($jenisParameter->id);
        $dbJenisParameter = $dbJenisParameter->toArray();
        $this->assertModelData($jenisParameter->toArray(), $dbJenisParameter);
    }

    /**
     * @test update
     */
    public function testUpdateJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $fakeJenisParameter = $this->fakeJenisParameterData();
        $updatedJenisParameter = $this->jenisParameterRepo->update($fakeJenisParameter, $jenisParameter->id);
        $this->assertModelData($fakeJenisParameter, $updatedJenisParameter->toArray());
        $dbJenisParameter = $this->jenisParameterRepo->find($jenisParameter->id);
        $this->assertModelData($fakeJenisParameter, $dbJenisParameter->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $resp = $this->jenisParameterRepo->delete($jenisParameter->id);
        $this->assertTrue($resp);
        $this->assertNull(JenisParameter::find($jenisParameter->id), 'JenisParameter should not exist in DB');
    }
}
