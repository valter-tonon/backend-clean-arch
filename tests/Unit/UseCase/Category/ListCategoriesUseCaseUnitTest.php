<?php

namespace Unit\UseCase\Category;

use AllowDynamicProperties;
use Core\Domain\Entity\Category as CategoryEntity;
use Core\Domain\Repository\ICategoryRepository;
use Core\Domain\Repository\IPagination;
use Core\UseCase\Category\ListCategoriesUseCase;
use Core\UseCase\Category\ListCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryInputDTO;
use Core\UseCase\DTO\Category\CategoryOutputDTO;
use Core\UseCase\DTO\Category\ListCategoriesInputDTO;
use Core\UseCase\DTO\Category\ListCategoriesOutputDTO;
use Mockery;
use Ramsey\Uuid\Uuid;
use stdClass;
use Tests\TestCase;

class ListCategoriesUseCaseUnitTest extends TestCase
{
    public function testListEmpty()
    {
        $paginateMock = $this->getMockPagination();

        $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
        $mockRepo->shouldReceive('paginate')->andReturn($paginateMock);

        $mockInputDto = new ListCategoriesInputDTO(
            orderBy: '',
            conditions: '',
            page: 1,
            perPage: 10
        );

        $useCase = new ListCategoriesUseCase($mockRepo);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(ListCategoriesOutputDTO::class, $response);
        $this->assertCount(0, $response->items);

        /**
         * Spies
         */
        $spyPaginate = Mockery::spy(stdClass::class, ICategoryRepository::class);
        $spyPaginate->shouldReceive('paginate')->andReturn($paginateMock);
        $useCase = new ListCategoriesUseCase($spyPaginate);
        $useCase->execute($mockInputDto);
        $spyPaginate->shouldHaveReceived('paginate');
    }

    public function testList()
    {
        $item = new stdClass();
        $item->id = Uuid::uuid4();
        $item->name = 'Category 1';
        $item->description = 'Description 1';
        $item->isActive = true;

        $paginateMock = $this->getMockPagination([$item]);

        $mockRepo = Mockery::mock(stdClass::class, ICategoryRepository::class);
        $mockRepo->shouldReceive('paginate')->andReturn($paginateMock);

        $mockInputDto = new ListCategoriesInputDTO(
            orderBy: '',
            conditions: '',
            page: 1,
            perPage: 10
        );

        $useCase = new ListCategoriesUseCase($mockRepo);
        $response = $useCase->execute($mockInputDto);

        $this->assertInstanceOf(ListCategoriesOutputDTO::class, $response);
        $this->assertCount(1, $response->items);
        $this->assertInstanceOf(stdClass::class, $response->items[0]);
    }

    /**
     * @return IPagination|(IPagination&Mockery\LegacyMockInterface)|(IPagination&Mockery\MockInterface)|Mockery\LegacyMockInterface|Mockery\MockInterface|stdClass|(stdClass&Mockery\LegacyMockInterface)|(stdClass&Mockery\MockInterface)
     */
    public function getMockPagination($items = [])
    {
        $paginateMock = Mockery::mock(stdClass::class, IPagination::class);
        $paginateMock->shouldReceive('items')->andReturn($items);
        $paginateMock->shouldReceive('total')->andReturn(0);
        $paginateMock->shouldReceive('currentPage')->andReturn(1);
        $paginateMock->shouldReceive('perPage')->andReturn(10);
        $paginateMock->shouldReceive('lastPage')->andReturn(1);
        $paginateMock->shouldReceive('firstPage')->andReturn(1);
        $paginateMock->shouldReceive('from')->andReturn(1);
        $paginateMock->shouldReceive('to')->andReturn(1);
        return $paginateMock;
    }
}