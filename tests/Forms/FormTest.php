<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class FormTest extends HtmlTestCase
{

    /** @test */
    public function enctype_attribute_is_added_when_files_option_is_required()
    {
        // Arrange
        // Act
        $html = $this->openFakeForm([], [], null, false, ['files' => true]);

        // Assert
        $this->assertContains('enctype="multipart/form-data"', $html->toHtml());
    }
}