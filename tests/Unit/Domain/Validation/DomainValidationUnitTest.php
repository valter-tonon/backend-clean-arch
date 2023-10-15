<?php

namespace Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Tests\TestCase;

class DomainValidationUnitTest extends TestCase
{

    public function testNotNull()
    {
        $value = '';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Test');
        DomainValidation::notNull($value, 'Test');
    }

    public function testNotNullDefaultMessage()
    {
        $value = '';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Value is required');
        DomainValidation::notNull($value);
    }

    public function testMinLength()
    {
        $value = 'abc';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Test');
        DomainValidation::minLength($value, 4, 'Test');
    }

    public function testMinLengthDefaultMessage()
    {
        $value = 'abc';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Value must be at least 4 characters');
        DomainValidation::minLength($value, 4);
    }

    public function testMaxLength()
    {
        $value = 'abc';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Test');
        DomainValidation::maxLength($value, 2, 'Test');
    }

    public function testMaxLengthDefaultMessage()
    {
        $value = 'abc';
        $this->expectException(EntityValidationException::class);
        $this->expectExceptionMessage('Value must be at most 2 characters');
        DomainValidation::maxLength($value, 2);
    }

    public function testCanNullAndMaxLenght()
    {
        $value = null;
        $this->assertNull(DomainValidation::strCanNullAndAndMaxLenght($value));
    }

    public function testCanNullAndMinLenght()
    {
        $value = null;
        $this->assertNull(DomainValidation::strCanNullAndAndMinLenght($value));
    }

}