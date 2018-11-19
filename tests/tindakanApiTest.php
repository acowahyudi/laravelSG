<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tindakanApiTest extends TestCase
{
    use MaketindakanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetindakan()
    {
        $tindakan = $this->faketindakanData();
        $this->json('POST', '/api/v1/tindakans', $tindakan);

        $this->assertApiResponse($tindakan);
    }

    /**
     * @test
     */
    public function testReadtindakan()
    {
        $tindakan = $this->maketindakan();
        $this->json('GET', '/api/v1/tindakans/'.$tindakan->id);

        $this->assertApiResponse($tindakan->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetindakan()
    {
        $tindakan = $this->maketindakan();
        $editedtindakan = $this->faketindakanData();

        $this->json('PUT', '/api/v1/tindakans/'.$tindakan->id, $editedtindakan);

        $this->assertApiResponse($editedtindakan);
    }

    /**
     * @test
     */
    public function testDeletetindakan()
    {
        $tindakan = $this->maketindakan();
        $this->json('DELETE', '/api/v1/tindakans/'.$tindakan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tindakans/'.$tindakan->id);

        $this->assertResponseStatus(404);
    }
}
