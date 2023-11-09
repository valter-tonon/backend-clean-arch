<?php

namespace Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\CategoryDeleteUseCase;
use Core\UseCase\DTO\Category\CategoryDeleteOutputDTO;
use Core\UseCase\DTO\Category\CategoryInputDTO;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class DeleteCategoryUseCaseUnitTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    public function testDeleteCategoryUseCase()
    {
        $uuid = Uuid::uuid4()->toString();
        $mockRepo = \Mockery::mock(\stdClass::class, ICategoryRepository::class);
        $mockRepo->shouldReceive('delete')->andReturn(true);

        $mockInputDto = \Mockery::mock(CategoryInputDTO::class, [
            $uuid
        ]);
        $useCase = new CategoryDeleteUseCase($mockRepo);
        $response = $useCase->execute($mockInputDto);
        $this->assertInstanceOf(CategoryDeleteOutputDTO::class, $response);
        $this->assertTrue($response->success);

        $spy = \Mockery::spy(\stdClass::class, ICategoryRepository::class);
        $spy->shouldReceive('delete')->andReturn(true);
        $useCase = new CategoryDeleteUseCase($spy);
        $useCase->execute($mockInputDto);
        $spy->shouldHaveReceived('delete');

    }


    public function testDeleteCategoryUseCaseReturnFalse()
    {
        $uuid = Uuid::uuid4()->toString();
        $mockRepo = \Mockery::mock(\stdClass::class, ICategoryRepository::class);
        $mockRepo->shouldReceive('delete')->andReturn(false);

        $mockInputDto = \Mockery::mock(CategoryInputDTO::class, [
            $uuid
        ]);
        $useCase = new CategoryDeleteUseCase($mockRepo);
        $response = $useCase->execute($mockInputDto);
        $this->assertInstanceOf(CategoryDeleteOutputDTO::class, $response);
        $this->assertFalse($response->success);
    }

}