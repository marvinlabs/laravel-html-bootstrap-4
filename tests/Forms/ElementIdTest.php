<?php

namespace MarvinLabs\Html\Bootstrap\Tests\Forms;

use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Tests\HtmlTestCase;

class ElementIdTest extends HtmlTestCase
{

    /** @test */
    public function id_is_deduced_from_name_if_not_specified()
    {
        $html = bs()->text('username')->render()->toHtml();
        $this->assertContains('id="username"', $html);
    }

    /** @test */
    public function id_can_be_overridden()
    {
        $controls = [
            bs()->text('username')->id('special_id'),
            bs()->email('username')->id('special_id'),
            bs()->checkBox('username')->controlId('special_id'),
            bs()->radio('username')->controlId('special_id'),
            bs()->radioGroup('username', ['y'=>'Yes', 'n'=>'No'])->id('special_id'),
        ];

        \collect($controls)->each(function($ctrl) {
            $html = $ctrl->render()->toHtml();
            $this->assertContains('id="special_id"', $html);
        });
    }

    /** @test */
    public function a_name_for_an_array_is_properly_converted()
    {
        $html = bs()->text('address[]')->render()->toHtml();
        $this->assertContains('id="address"', $html);

        $html = bs()->text('address[city]')->render()->toHtml();
        $this->assertContains('id="address_city"', $html);
    }

}
