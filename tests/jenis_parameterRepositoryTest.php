<?php

use App\Models\jenis_parameter;
use App\Repositories\jenis_parameterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class jenis_parameterRepositoryTest extends TestCase
{
    use Makejenis_parameterTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var jenis_parameterRepository
     */
    protected $jenisParameterRepo;

    public function setUp()
    {
        parent::setUp();
        $this->jenisParameterRepo = App::make(jenis_parameterRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatejenis_parameter()
    {
        $jenisParameter = $this->fakejenis_parameterData();
        $createdjenis_parameter = $this->jenisParameterRepo->create($jenisParameter);
        $createdjenis_parameter = $createdjenis_parameter->toArray();
        $this->assertArrayHasKey('id', $createdjenis_parameter);
        $this->assertNotNull($createdjenis_parameter['id'], 'Created jenis_parameter must have id specified');
        $this->assertNotNull(jenis_parameter::find($createdjenis_parameter['id']), 'jenis_parameter with given id must be in DB');
        $this->assertModelData($jenisParameter, $createdjenis_parameter);
    }

    /**
     * @test read
     */
    public function testReadjenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $dbjenis_parameter = $this->jenisParameterRepo->find($jenisParameter->id);
        $dbjenis_parameter = $dbjenis_parameter->toArray();
        $this->assertModelData($jenisParameter->toArray(), $dbjenis_parameter);
    }

    /**
     * @test update
     */
    public function testUpdatejenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $fakejenis_parameter = $this->fakejenis_parameterData();
        $updatedjenis_parameter = $this->jenisParameterRepo->update($fakejenis_parameter, $jenisParameter->id);
        $this->assertModelData($fakejenis_parameter, $updatedjenis_parameter->toArray());
        $dbjenis_parameter = $this->jenisParameterRepo->find($jenisParameter->id);
        $this->assertModelData($fakejenis_parameter, $dbjenis_parameter->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletejenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $resp = $this->jenisParameterRepo->delete($jenisParameter->id);
        $this->assertTrue($resp);
        $this->assertNull(jenis_parameter::find($jenisParameter->id), 'jenis_parameter should not exist in DB');
    }
}
