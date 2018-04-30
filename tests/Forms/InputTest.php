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

    /**
     * @test
     */
    public function radio_and_checkboxes_inputs_displays_plain_text_and_html_in_the_description()
    {
        $this->openFakeForm();

        // radio inputs
        $html = bs()->radio('name', 'this description is plain text')->render()->toHtml();
        $this->assertContains('this description is plain text', $html);

        $html = bs()->radio('name', 'this description contains <a href="#">html</a>')->render()->toHtml();
        $this->assertContains('this description contains <a href="#">html</a>', $html);
        $this->assertNotContains('&quot;', $html); // does not contain encoded html

        // checkbox inputs
        $html = bs()->checkBox('name', 'this description is plain text')->render()->toHtml();
        $this->assertContains('this description is plain text', $html);

        $html = bs()->checkBox('name', 'this description contains <a href="#">html</a>')->render()->toHtml();
        $this->assertContains('this description contains <a href="#">html</a>', $html);
        $this->assertNotContains('&quot;', $html); // does not contain encoded html

        // radio groups
        $options = ['text only 1', 'text only 2'];
        $html = bs()->radioGroup('name', $options)->render()->toHtml();
        $this->assertContains('text only 1', $html);
        $this->assertContains('text only 2', $html);

        $options = ['with <a href="#">html</a> 1', 'with <a href="#">html</a> 2'];
        $html = bs()->radioGroup('name', $options)->render()->toHtml();
        $this->assertContains('with <a href="#">html</a> 1', $html);
        $this->assertContains('with <a href="#">html</a> 2', $html);
        $this->assertNotContains('&quot;', $html); // does not contain encoded html
    }
}
