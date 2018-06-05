<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Elements\FormGroup;
use MarvinLabs\Html\Bootstrap\Elements\Input;
use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class FormGroupTest extends HtmlTestCase
{

    /** @test */
    public function shows_an_error_when_containing_input_field()
    {
        // Arrange
        $state = $this->fakeFormState(['username' => ['Username is required.']]);

        // Act
        $formGroup = new FormGroup($state);
        $html = $formGroup
            ->control(bs()->text('username'))
            ->render()->toHtml();

        // Assert
        $this->assertContains('Username is required.', $html);
    }

    /** @test */
    public function old_input_value_is_shown_before_user_default()
    {
        // Arrange
        $this->openFakeForm([], ['username' => 'john']);

        // Act
        $html = bs()->formGroup()
                    ->control(bs()->text('username', 'Jane'))
                    ->render()->toHtml();

        // Assert
        $this->assertContains('value="john"', $html);
    }
}
