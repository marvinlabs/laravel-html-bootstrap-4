<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class InputTest extends HtmlTestCase
{

    /** @test */
    public function adds_css_class_when_field_has_errors()
    {
        // Arrange
        $this->openFakeForm(['username' => ['Username is required.']]);

        // Act
        $html = bs()->text('username')
            ->render()->toHtml();

        // Assert
        $this->assertContains('is-invalid', $html);
    }

    /** @test */
    public function old_input_value_is_shown_before_user_default()
    {
        // Arrange
        $this->openFakeForm([], ['username' => 'john']);

        // Act
        $html = bs()->text('username', 'default-value')
            ->render()->toHtml();

        // Assert
        $this->assertContains('value="john"', $html);
    }
}