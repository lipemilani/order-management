<?php

namespace Tests\Unit;

use Mockery;
use App\Models\Customer;
use PHPUnit\Framework\TestCase;
use App\Application\DTO\CustomerDTO;
use App\Repositories\CustomerRepository;
use App\Application\Services\CustomerService;
use App\Application\Transformers\CustomerTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerServiceTest extends TestCase
{
    /**
     * @var CustomerService
     */
    protected $service;
    /**
     * @var CustomerTransformer|(CustomerTransformer&Mockery\MockInterface&object&Mockery\LegacyMockInterface)|(Mockery\MockInterface&object&Mockery\LegacyMockInterface)
     */
    protected $transformerMock;
    /**
     * @var CustomerRepository|(CustomerRepository&Mockery\MockInterface&object&Mockery\LegacyMockInterface)|(Mockery\MockInterface&object&Mockery\LegacyMockInterface)
     */
    protected $repositoryMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->transformerMock = Mockery::mock(CustomerTransformer::class);
        $this->repositoryMock = Mockery::mock(CustomerRepository::class);

        $this->service = new CustomerService($this->transformerMock, $this->repositoryMock);
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
     * @return CustomerDTO
     * @throws \ReflectionException
     */
    protected function createCustomerDTO($overrides = []): CustomerDTO
    {
        return new CustomerDTO(array_merge([
            'id' => '1',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'dateOfBirth' => '1990-01-01',
            'address' => '123 Street',
            'complement' => 'Apt 1',
            'neighborhood' => 'Downtown',
            'cep' => '12345678',
            'createdAt' => now(),
            'active' => true,
        ], $overrides));
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_store_method()
    {
        $dto = $this->createCustomerDTO();
        $customerModel = new Customer([
            'id' => $dto->id,
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'date_of_birth' => $dto->dateOfBirth,
            'address' => $dto->address,
            'complement' => $dto->complement,
            'neighborhood' => $dto->neighborhood,
            'cep' => $dto->cep,
            'created_at' => $dto->createdAt,
            'active' => $dto->active,
        ]);

        $this->transformerMock->shouldReceive('toModel')
            ->once()
            ->with($dto)
            ->andReturn($customerModel);

        $this->repositoryMock->shouldReceive('store')
            ->once()
            ->with($customerModel)
            ->andReturn($customerModel);

        $result = $this->service->store($dto);

        $this->assertEquals($customerModel, $result);
    }

    /**
     * @return void
     * @throws \ReflectionException
     */
    public function test_update_method()
    {
        $dto = $this->createCustomerDTO(['name' => 'John Doe Updated']);
        $customerModel = new Customer([
            'id' => $dto->id,
            'name' => $dto->name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'date_of_birth' => $dto->dateOfBirth,
            'address' => $dto->address,
            'complement' => $dto->complement,
            'neighborhood' => $dto->neighborhood,
            'cep' => $dto->cep,
            'created_at' => $dto->createdAt,
            'active' => $dto->active,
        ]);

        $this->transformerMock->shouldReceive('prepareForUpdate')
            ->once()
            ->with($customerModel, $dto);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with($dto->id)
            ->andReturn($customerModel);

        $this->repositoryMock->shouldReceive('update')
            ->once()
            ->with($customerModel)
            ->andReturn($customerModel);

        $result = $this->service->update($dto);

        $this->assertEquals($customerModel, $result);
    }

    /**
     * @return void
     */
    public function test_find_method()
    {
        $customerModel = new Customer(['id' => '1', 'name' => 'John Doe', 'email' => 'john@example.com']);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with('1')
            ->andReturn($customerModel);

        $result = $this->service->find('1');

        $this->assertEquals($customerModel, $result);
    }

    /**
     * @return void
     */
    public function test_delete_method()
    {
        $customerModel = new Customer(['id' => '1', 'name' => 'John Doe', 'email' => 'john@example.com']);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with('1')
            ->andReturn($customerModel);

        $this->repositoryMock->shouldReceive('delete')
            ->once()
            ->with($customerModel);

        $result = $this->service->delete('1');

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function test_restore_method()
    {
        $customerModel = new Customer(['id' => '1', 'name' => 'John Doe', 'email' => 'john@example.com']);

        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with('1')
            ->andReturn($customerModel);

        $this->repositoryMock->shouldReceive('restore')
            ->once()
            ->with($customerModel);

        $result = $this->service->restore('1');

        $this->assertTrue($result);
    }

    /**
     * @return void
     */
    public function test_find_method_throws_exception_when_not_found()
    {
        $this->repositoryMock->shouldReceive('find')
            ->once()
            ->with('999')
            ->andThrow(new ModelNotFoundException());

        $this->expectException(ModelNotFoundException::class);
        $this->service->find('999');
    }
}
