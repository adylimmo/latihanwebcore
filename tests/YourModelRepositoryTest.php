<?php

use App\Models\YourModel;
use App\Repositories\YourModelRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class YourModelRepositoryTest extends TestCase
{
    use MakeYourModelTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var YourModelRepository
     */
    protected $yourModelRepo;

    public function setUp()
    {
        parent::setUp();
        $this->yourModelRepo = App::make(YourModelRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateYourModel()
    {
        $yourModel = $this->fakeYourModelData();
        $createdYourModel = $this->yourModelRepo->create($yourModel);
        $createdYourModel = $createdYourModel->toArray();
        $this->assertArrayHasKey('id', $createdYourModel);
        $this->assertNotNull($createdYourModel['id'], 'Created YourModel must have id specified');
        $this->assertNotNull(YourModel::find($createdYourModel['id']), 'YourModel with given id must be in DB');
        $this->assertModelData($yourModel, $createdYourModel);
    }

    /**
     * @test read
     */
    public function testReadYourModel()
    {
        $yourModel = $this->makeYourModel();
        $dbYourModel = $this->yourModelRepo->find($yourModel->id);
        $dbYourModel = $dbYourModel->toArray();
        $this->assertModelData($yourModel->toArray(), $dbYourModel);
    }

    /**
     * @test update
     */
    public function testUpdateYourModel()
    {
        $yourModel = $this->makeYourModel();
        $fakeYourModel = $this->fakeYourModelData();
        $updatedYourModel = $this->yourModelRepo->update($fakeYourModel, $yourModel->id);
        $this->assertModelData($fakeYourModel, $updatedYourModel->toArray());
        $dbYourModel = $this->yourModelRepo->find($yourModel->id);
        $this->assertModelData($fakeYourModel, $dbYourModel->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteYourModel()
    {
        $yourModel = $this->makeYourModel();
        $resp = $this->yourModelRepo->delete($yourModel->id);
        $this->assertTrue($resp);
        $this->assertNull(YourModel::find($yourModel->id), 'YourModel should not exist in DB');
    }
}
