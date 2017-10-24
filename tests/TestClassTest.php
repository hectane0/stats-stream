<?php

namespace StatsStream\Test;

use StatsStream\TestClass;
use PHPUnit\Framework\TestCase;

class TestClassTest extends TestCase
{
    public function testIsTestFunctionReturnTrue()
    {
        $obj = new TestClass();
        $this->assertEquals(true, $obj->hello());
    }
}
