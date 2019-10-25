<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class ButtonTest extends HtmlTestCase
{

    /** @test */
    public function buttons_displays_plain_text_and_html_in_the_description()
    {
        $this->openFakeForm();

        $html = bs()->button('Add file')->render()->toHtml();
        $this->assertStringContainsString('Add file', $html);

        $html = bs()->button('<i class="fa fa-fw fa-plus"></i> Add file')->render()->toHtml();
        $this->assertStringContainsString('<i class="fa fa-fw fa-plus"></i> Add file', $html);
        $this->assertStringNotContainsString('&quot;', $html); // does not contain encoded html
    }
}
