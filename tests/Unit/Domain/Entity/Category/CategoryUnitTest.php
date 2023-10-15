<?php

namespace Unit\Domain\Entity\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\ValueObject\Uuid;
use Tests\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );
        $attributes = ['id', 'name', 'description', 'isActive','createdAt', 'updatedAt'];
        $classAttributes = array_keys($category->toArray());
        $this->assertEquals($attributes, $classAttributes);
        $this->assertEquals('Category Name', $category->name);
        $this->assertEquals('Category Description', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testIsActivated()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: false
        );
        $this->assertFalse($category->isActive);

        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisable()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );
        $this->assertTrue($category->isActive);

        $category->disable();
        $this->assertFalse($category->isActive);

    }

    public function testUpdate()
    {
        $uuid = Uuid::random();
        $category = new Category(
            id: $uuid,
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $category->update(
            name: 'Category Name Updated',
            description: 'Category Description Updated'
        );

        $this->assertEquals($uuid, $category->id);
        $this->assertEquals('Category Name Updated', $category->name);
        $this->assertEquals('Category Description Updated', $category->description);

        //Update only name
        $category->update(
            name: 'Category Name Updated New'
        );
        $this->assertEquals('Category Name Updated New', $category->name);
        $this->assertEquals('Category Description Updated', $category->description);
    }

    public function testExceptionNameLength()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Name must be at least 3 characters');
        $category->update(
            name: 'Na'
        );
    }

    public function testExceptionNameRequired()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Name is required');
        $category->update(
            name: ''
        );
    }

    public function testExceptionDescriptionLenght()
    {
        $category = new Category(
            name: 'Category Name',
            description: 'Category Description',
            isActive: true
        );

        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Description must be at least 3 characters');
        $category->update(
            name: 'Category Name',
            description: 'De'
        );

    }

}