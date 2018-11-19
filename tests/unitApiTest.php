<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class unitApiTest extends TestCase
{
    use MakeunitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateunit()
    {
        $unit = $this->fakeunitData();
        $this->json('POST', '/api/v1/units', $unit);

        $this->assertApiResponse($unit);
    }

    /**
     * @test
     */
    public function testReadunit()
    {
        $unit = $this->makeunit();
        $this->json('GET', '/api/v1/units/'.$unit->id);

        $this->assertApiResponse($unit->toArray());
    }

    /**
     * @test
     */
    public function testUpdateunit()
    {
        $unit = $this->makeunit();
        $editedunit = $this->fakeunitData();

        $this->json('PUT', '/api/v1/units/'.$unit->id, $editedunit);

        $this->assertApiResponse($editedunit);
    }

    /**
     * @test
     */
    public function testDeleteunit()
    {
        $unit = $this->makeunit();
        $this->json('DELETE', '/api/v1/units/'.$unit->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/units/'.$unit->id);

        $this->assertResponseStatus(404);
    }
}
