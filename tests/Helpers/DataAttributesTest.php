<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Helpers;

use MarvinLabs\Html\Bootstrap\Tests\TestCase;

class DataAttributesTest extends TestCase
{
    /** @test */
    public function properly_converts_multiple_attributes_to_string()
    {
        // Arrange
        // Act
        $converted = data_attributes(['id' => 42, 'context' => 'tests']);

        // Assert
        $this->assertEquals('data-id="42" data-context="tests"', $converted);
    }

    /** @test */
    public function filters_duplicated_attributes_using_only_last_value()
    {
        // Arrange
        // Act
        /** @noinspection PhpDuplicateArrayKeysInspection */
        $converted = data_attributes(['id' => 42, 'context' => 'tests', 'id' => 51]);

        // Assert
        $this->assertEquals('data-id="51" data-context="tests"', $converted);
    }
}