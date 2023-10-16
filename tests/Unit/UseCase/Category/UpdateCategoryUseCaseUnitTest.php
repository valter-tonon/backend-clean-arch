<?php

namespace Tests\Unit\UseCase\Category;

use AllowDynamicProperties;
use Core\Domain\Entity\Category as EntityCategory;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\Category\UpdateCategoryUseCase;
use Core\UseCase\DTO\Category\UpdateCategoryInputDTO;
use Core\UseCase\DTO\Category\UpdateCategoryOutputDTO;
use Mockery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use stdClass;

#[AllowDynamicProperties] class UpdateCategoryUseCaseUnitTest extends TestCase
{
    public function testRenameCategory()
    {
        $uuid = (string) Uuid::uuid4()->toString();
        $categoryName = 'Name';
        $categoryDesc = 'Desc';

        $this->mockEntity = Mockery::mock(EntityCategory::class, [
            $uuid, $categoryName, $categoryDesc,
        ]);
        $this->mockEntity->shouldReceive('update');
        $this->mockEntity->shouldReceive('createdAt')->andReturn(date('Y-m-d H:i:s'));

        $this->mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
        $this->mockRepo->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->mockRepo->shouldReceive('update')->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(UpdateCategoryInputDTO::class, [
            $uuid,
            'new name',
        ]);

        $useCase = new UpdateCategoryUseCase($this->mockRepo);
        $responseUseCase = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(UpdateCategoryOutputDTO::class, $responseUseCase);

        /**
         * Spies
         */
        $this->spy = Mockery::spy(stdClass::class, ICategoryRepository::class);
        $this->spy->shouldReceive('findById')->andReturn($this->mockEntity);
        $this->spy->shouldReceive('update')->andReturn($this->mockEntity);
        $useCase = new UpdateCategoryUseCase($this->spy);
        $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');
        $this->spy->shouldHaveReceived('update');

        Mockery::close();
    }
}