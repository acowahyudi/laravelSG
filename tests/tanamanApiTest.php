<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class tanamanApiTest extends TestCase
{
    use MaketanamanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatetanaman()
    {
        $tanaman = $this->faketanamanData();
        $this->json('POST', '/api/v1/tanamen', $tanaman);

        $this->assertApiResponse($tanaman);
    }

    /**
     * @test
     */
    public function testReadtanaman()
    {
        $tanaman = $this->maketanaman();
        $this->json('GET', '/api/v1/tanamen/'.$tanaman->id);

        $this->assertApiResponse($tanaman->toArray());
    }

    /**
     * @test
     */
    public function testUpdatetanaman()
    {
        $tanaman = $this->maketanaman();
        $editedtanaman = $this->faketanamanData();

        $this->json('PUT', '/api/v1/tanamen/'.$tanaman->id, $editedtanaman);

        $this->assertApiResponse($editedtanaman);
    }

    /**
     * @test
     */
    public function testDeletetanaman()
    {
        $tanaman = $this->maketanaman();
        $this->json('DELETE', '/api/v1/tanamen/'.$tanaman->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tanamen/'.$tanaman->id);

        $this->assertResponseStatus(404);
    }
}
