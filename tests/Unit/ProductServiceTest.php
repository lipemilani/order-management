<?php

namespace Tests\Unit;

use App\Application\DTO\ProductDTO;
use App\Application\Services\S3Service;
use App\Application\Transformers\ProductTransformer;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use App\Application\Services\ProductService;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    /**
     * @var ProductService
     */
    protected ProductService $service;
    /**
     * @var ProductTransformer|(ProductTransformer&Mockery\MockInterface&object&Mockery\LegacyMockInterface)|(Mockery\MockInterface&object&Mockery\LegacyMockInterface)
     */
    protected $transformerMock;
    /**
     * @var ProductRepository|(ProductRepository&Mockery\MockInterface&object&Mockery\LegacyMockInterface)|(Mockery\MockInterface&object&Mockery\LegacyMockInterface)
     */
    protected $repositoryMock;
    /**
     * @var S3Service|(S3Service&Mockery\MockInterface&object&Mockery\LegacyMockInterface)|(Mockery\MockInterface&object&Mockery\LegacyMockInterface)
     */
    protected $s3ServiceMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformerMock = Mockery::mock(ProductTransformer::class);
        $this->repositoryMock = Mockery::mock(ProductRepository::class);
        $this->s3ServiceMock = Mockery::mock(S3Service::class);

        $this->service = new ProductService($this->s3ServiceMock, $this->transformerMock, $this->repositoryMock);
    }

    /**
     * @return void
     */
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @param $overrides
     * @return ProductDTO
     * @throws \ReflectionException
     */
    protected function createProductDTO($overrides = []): ProductDTO
    {
        return new ProductDTO(array_merge([
            'id' => '1',
            'name' => 'Product Name',
            'price' => 100.0,
            'photo' => UploadedFile::fake()->image('photo.jpg'),
            'active' => true,
        ], $overrides));
    }

    /**
     * @return void
     */
    public function test_index_method()
    {
        $productCollection = new Collection([new Product()]);
        $this->repositoryMock->shouldReceive('index')->once()->andReturn($productCollection);

        $result = $this->service->index();

        $this->assertEquals($productCollection, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_store_method()
    {
        $dto = $this->createProductDTO();
        $productModel = new Product([
            'id' => $dto->id,
            'name' => $dto->name,
            'price' => $dto->price,
            'photo' => $dto->photo,
            'active' => $dto->active,
        ]);

        $this->transformerMock->shouldReceive('toModel')
            ->once()
            ->with($dto)
            ->andReturn($productModel);

        $this->s3ServiceMock->shouldReceive('put')
            ->once()
            ->with($dto->photo)
            ->andReturn('s3/photo.jpg');

        $productModel->photo = 's3/photo.jpg';

        $this->repositoryMock->shouldReceive('store')
            ->once()
            ->with($productModel)
            ->andReturn($productModel);

        $result = $this->service->store($dto);

        $this->assertEquals($productModel, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_update_method()
    {
        $dto = $this->createProductDTO(['id' => '1']);
        $productModel = new Product([
            'id' => $dto->id,
            'name' => 'Old Name',
            'price' => 50.0,
            'photo' => 'old_photo.jpg',
            'active' => false,
        ]);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($dto->id)
            ->andReturn($productModel);

        $this->transformerMock->shouldReceive('prepareForUpdate')
            ->once()
            ->with($productModel, $dto);

        $this->repositoryMock->shouldReceive('update')
            ->once()
            ->with($productModel)
            ->andReturn($productModel);

        $result = $this->service->update($dto);

        $this->assertEquals($productModel, $result);
    }

    /**
     * @return void
     */
    public function test_find_method()
    {
        $id = '1';
        $productModel = new Product(['id' => $id]);
        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($productModel);

        $result = $this->service->find($id);

        $this->assertEquals($productModel, $result);
    }

    /**
     * @return void
     */
    public function test_delete_method()
    {
        $id = '1';
        $productModel = new Product(['id' => $id]);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($productModel);

        $this->repositoryMock->shouldReceive('delete')
            ->once()
            ->with($productModel)
            ->andReturn(true);

        $result = $this->service->delete($id);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function test_delete_method_not_found()
    {
        $id = '1';

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn(null);

        $result = $this->service->delete($id);

        $this->assertFalse($result);
    }

    /**
     * @return void
     */
    public function test_restore_method()
    {
        $id = '1';
        $productModel = new Product(['id' => $id]);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn($productModel);

        $this->repositoryMock->shouldReceive('restore')
            ->once()
            ->with($productModel)
            ->andReturn(true);

        $result = $this->service->restore($id);

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function test_restore_method_not_found()
    {
        $id = '1';

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn(null);

        $result = $this->service->restore($id);

        $this->assertFalse($result);
    }
}
