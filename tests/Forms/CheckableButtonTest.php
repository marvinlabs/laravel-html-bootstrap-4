<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class CheckableButtonTest extends HtmlTestCase
{

    /** @test */
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

    /**
     * @test
     */
    public function radio_group_accepts_loose_comparisons_for_checked_state()
    {
        $this->openFakeForm();

        $options = [
            1 => '1',
            2 => '2',
        ];

        $html = bs()->radioGroup('name', $options)->selectedOption(2)->render()->toHtml();
        $this->assertContains('checked="checked" name="name" id="name_2" value="2"', $html);
        $this->assertNotContains('checked="checked" name="name" id="name_1" value="1"', $html);

        $html = bs()->radioGroup('name', $options)->selectedOption(1)->render()->toHtml();
        $this->assertContains('checked="checked" name="name" id="name_1" value="1"', $html);
        $this->assertNotContains('checked="checked" name="name" id="name_2" value="2"', $html);

        $html = bs()->radioGroup('name', $options)->selectedOption('2')->render()->toHtml();
        $this->assertContains('checked="checked" name="name" id="name_2" value="2"', $html);
    }
}
