<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class jenis_parameterApiTest extends TestCase
{
    use Makejenis_parameterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatejenis_parameter()
    {
        $jenisParameter = $this->fakejenis_parameterData();
        $this->json('POST', '/api/v1/jenisParameters', $jenisParameter);

        $this->assertApiResponse($jenisParameter);
    }

    /**
     * @test
     */
    public function testReadjenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $this->json('GET', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertApiResponse($jenisParameter->toArray());
    }

    /**
     * @test
     */
    public function testUpdatejenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $editedjenis_parameter = $this->fakejenis_parameterData();

        $this->json('PUT', '/api/v1/jenisParameters/'.$jenisParameter->id, $editedjenis_parameter);

        $this->assertApiResponse($editedjenis_parameter);
    }

    /**
     * @test
     */
    public function testDeletejenis_parameter()
    {
        $jenisParameter = $this->makejenis_parameter();
        $this->json('DELETE', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertResponseStatus(404);
    }
}
