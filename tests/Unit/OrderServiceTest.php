<?php

namespace Tests\Unit;

use Mockery;
use App\Models\Order;
use PHPUnit\Framework\TestCase;
use App\Repositories\OrderRepository;
use App\Application\Services\OrderService;

class OrderServiceTest extends TestCase
{
    protected OrderService $service;
    protected $repositoryMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repositoryMock = Mockery::mock(OrderRepository::class);
        $this->service = new OrderService($this->repositoryMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_store_method_when_order_exists()
    {
        $customerId = 'customer-id';
        $productId = 'product-id';
        $existingOrder = new Order([
            'customer_id' => $customerId,
            'product_id' => $productId,
        ]);

        $this->repositoryMock->shouldReceive('checkIfExistsByCustomerIdAndProductId')
            ->once()
            ->with($customerId, $productId)
            ->andReturn($existingOrder);

        $result = $this->service->store($customerId, $productId);

        $this->assertTrue($result);
    }

    public function test_store_method_when_order_does_not_exist()
    {
        $customerId = 'customer-id';
        $productId = 'product-id';

        $this->repositoryMock->shouldReceive('checkIfExistsByCustomerIdAndProductId')
            ->once()
            ->with($customerId, $productId)
            ->andReturn(null);

        $this->repositoryMock->shouldReceive('store')
            ->once()
            ->with(['customer_id' => $customerId, 'product_id' => $productId]);

        $result = $this->service->store($customerId, $productId);

        $this->assertFalse($result);
    }

    public function test_delete_method_when_order_exists()
    {
        $customerId = 'customer-id';
        $productId = 'product-id';
        $order = new Order([
            'customer_id' => $customerId,
            'product_id' => $productId,
        ]);

        $this->repositoryMock->shouldReceive('checkIfExistsByCustomerIdAndProductId')
            ->once()
            ->with($customerId, $productId)
            ->andReturn($order);

        $this->repositoryMock->shouldReceive('delete')
            ->once()
            ->with($order)
            ->andReturn(true);

        $result = $this->service->delete($customerId, $productId);

        $this->assertTrue($result);
    }

    public function test_delete_method_when_order_does_not_exist()
    {
        $customerId = 'customer-id';
        $productId = 'product-id';

        $this->repositoryMock->shouldReceive('checkIfExistsByCustomerIdAndProductId')
            ->once()
            ->with($customerId, $productId)
            ->andReturn(null);

        $result = $this->service->delete($customerId, $productId);

        $this->assertFalse($result);
    }
}
