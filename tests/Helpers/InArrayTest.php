<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Helpers;

use MarvinLabs\Html\Bootstrap\Tests\TestCase;

class InArrayTest extends TestCase
{
    /** @test */
    public function in_array_any_works_as_expected_on_simple_cases()
    {
        // Arrange
        $haystack = ['one', 'two', 'three'];

        // Act
        // Assert
        $this->assertTrue(in_array_any(['one', 'two'], $haystack));
        $this->assertTrue(in_array_any(['zero', 'one'], $haystack));
        $this->assertFalse(in_array_any(['zero', 'four'], $haystack));
    }

    /** @test */
    public function in_array_all_works_as_expected_on_simple_cases()
    {
        // Arrange
        $haystack = ['one', 'two', 'three'];

        // Act
        // Assert
        $this->assertTrue(in_array_all(['one', 'two'], $haystack));
        $this->assertFalse(in_array_all(['zero', 'one'], $haystack));
        $this->assertFalse(in_array_all(['zero', 'four'], $haystack));
    }
}