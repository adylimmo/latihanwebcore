<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class YourModelApiTest extends TestCase
{
    use MakeYourModelTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateYourModel()
    {
        $yourModel = $this->fakeYourModelData();
        $this->json('POST', '/api/v1/yourModels', $yourModel);

        $this->assertApiResponse($yourModel);
    }

    /**
     * @test
     */
    public function testReadYourModel()
    {
        $yourModel = $this->makeYourModel();
        $this->json('GET', '/api/v1/yourModels/'.$yourModel->id);

        $this->assertApiResponse($yourModel->toArray());
    }

    /**
     * @test
     */
    public function testUpdateYourModel()
    {
        $yourModel = $this->makeYourModel();
        $editedYourModel = $this->fakeYourModelData();

        $this->json('PUT', '/api/v1/yourModels/'.$yourModel->id, $editedYourModel);

        $this->assertApiResponse($editedYourModel);
    }

    /**
     * @test
     */
    public function testDeleteYourModel()
    {
        $yourModel = $this->makeYourModel();
        $this->json('DELETE', '/api/v1/yourModels/'.$yourModel->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/yourModels/'.$yourModel->id);

        $this->assertResponseStatus(404);
    }
}
