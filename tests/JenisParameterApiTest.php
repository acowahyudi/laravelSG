<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JenisParameterApiTest extends TestCase
{
    use MakeJenisParameterTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateJenisParameter()
    {
        $jenisParameter = $this->fakeJenisParameterData();
        $this->json('POST', '/api/v1/jenisParameters', $jenisParameter);

        $this->assertApiResponse($jenisParameter);
    }

    /**
     * @test
     */
    public function testReadJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $this->json('GET', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertApiResponse($jenisParameter->toArray());
    }

    /**
     * @test
     */
    public function testUpdateJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $editedJenisParameter = $this->fakeJenisParameterData();

        $this->json('PUT', '/api/v1/jenisParameters/'.$jenisParameter->id, $editedJenisParameter);

        $this->assertApiResponse($editedJenisParameter);
    }

    /**
     * @test
     */
    public function testDeleteJenisParameter()
    {
        $jenisParameter = $this->makeJenisParameter();
        $this->json('DELETE', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/jenisParameters/'.$jenisParameter->id);

        $this->assertResponseStatus(404);
    }
}
