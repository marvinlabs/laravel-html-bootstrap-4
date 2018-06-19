<?php

namespace MarvinLabs\Html\Bootstrap\Tests;

use Illuminate\Contracts\Support\Htmlable;
use MarvinLabs\Html\Bootstrap\Contracts\FormState;
use MarvinLabs\Html\Bootstrap\Tests\Support\FakeFormState;
use Symfony\Component\DomCrawler\Crawler;

abstract class HtmlTestCase extends TestCase
{
    protected function assertHtmlTagWithAttribute($expectedValue,
                                                  string $attribute,
                                                  string $selector,
                                                  string $html): void
    {
        $crawler = new Crawler($html);
        $this->assertEquals($expectedValue,
            $crawler->filter($selector)->getNode(0)->getAttribute($attribute),
            "Attribute $attribute does not have the value $expectedValue in element $selector. HTML: $html");
    }


    protected function assertHtmlTagWithAttributes(array $attributes,
                                                   string $selector,
                                                   string $html): void
    {
        $crawler = new Crawler($html);
        foreach ($attributes as $attribute => $expectedValue)
        {
            $this->assertEquals($expectedValue,
                $crawler->filter($selector)->getNode(0)->getAttribute($attribute),
                "Attribute $attribute does not have the value $expectedValue in element $selector. HTML: $html");
        }
    }

    protected function assertHtmlHas(string $selector, string $html): void
    {
        $crawler = new Crawler($html);
        $this->assertNotEquals(0, $crawler->filter($selector)->count(), "$selector has not been found in HTML: $html");
    }

    protected function assertHtmlHasNot(string $selector, string $html): void
    {
        $crawler = new Crawler($html);
        $this->assertEquals(0, $crawler->filter($selector)->count(), "$selector has been found in HTML: $html");
    }

    protected function fakeFormState(array $errors = [],
                                     array $oldInput = [],
                                     $model = null,
                                     bool $shouldHideErrors =
                                     false): FakeFormState
    {
        return new FakeFormState($errors, $oldInput, $model, $shouldHideErrors);
    }

    protected function openFakeForm(array $errors = [],
                                    array $oldInput = [],
                                    $model = null,
                                    bool $shouldHideErrors = false,
                                    array $options = []): Htmlable
    {
        $state = $this->fakeFormState($errors, $oldInput, $model, $shouldHideErrors);
        $this->app->instance(FormState::class, $state);

        // Form must be open in order to setup form state
        return bs()->openForm('get', '/', $options);
    }
}
