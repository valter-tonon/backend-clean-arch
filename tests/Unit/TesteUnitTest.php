<?php

namespace Unit;

use Core\Teste;
use PHPUnit\Framework\TestCase;

class TesteUnitTest extends TestCase
{
    public function testFoo()
    {
        $teste = new Teste();
        $this->assertEquals('bar', $teste->foo());
    }
}