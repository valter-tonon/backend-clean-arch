<?php

namespace Unit\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\Domain\ValueObject\Uuid;
use Core\UseCase\Category\CreateCategoryUseCase;
use Core\UseCase\DTO\Category\CategoryCreateInputDTO;
use Core\UseCase\DTO\Category\CategoryCreateOutputDTO;
use Tests\TestCase;

class CreateCategoryUseCaseUnitTest extends TestCase
{
    public function testCreateNewCategory()
    {
        $categoryId = Uuid::random();
        $categoryName = 'Category Name';
        $categoryMock = \Mockery::mock(Category::class, [
            $categoryId,
            $categoryName
        ]);

        $repoMock = \Mockery::mock(\stdClass::class, ICategoryRepository::class);
        $repoMock->shouldReceive('insert')->once()->andReturn($categoryMock);

        $useCase = new CreateCategoryUseCase($repoMock);
        $category = $useCase->execute(new CategoryCreateInputDTO(
            name: $categoryName
        ));
        $this->assertEquals($categoryName, $category->name);
        $this->assertInstanceOf(CategoryCreateOutputDTO::class, $category);

        $this->spy = \Mockery::spy(\stdClass::class, ICategoryRepository::class);
        $this->spy->shouldReceive('insert')->once()->andReturn($categoryMock);
        $useCase = new CreateCategoryUseCase($this->spy);
        $useCase->execute(new CategoryCreateInputDTO(
            name: $categoryName
        ));
        $this->spy->shouldHaveReceived('insert')->once();
    }

}