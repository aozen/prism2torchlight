<?php

namespace Aozen\Prism2Torchlight\Tests;

use Aozen\Prism2Torchlight\Prism2Torchlight;
use PHPUnit\Framework\TestCase;

class Prism2TorchlightTest extends TestCase
{
    /** @var Prism2Torchlight */
    private Prism2Torchlight $prism2Torchlight;

    protected function setUp(): void
    {
        parent::setUp();

        $this->prism2Torchlight = new Prism2Torchlight();
    }

    public function testEmptyInputConversion()
    {
        $text = '';
        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals('', $result);
    }

    public function testNoCodeBlocksConversion()
    {
        $text = '<p>no code blocks here</p>';
        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($text, $result);
    }

    public function testCodeBlockWithNoLanguageSpecifiedConversion()
    {
        $text = '<pre><code>echo "hello";</code></pre>';
        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($text, $result);
    }

    public function testInvalidCodeBlockStructureConversion()
    {
        $text = '<pre class="language-php"><code>echo "hello";</pre>';
        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($text, $result);
    }

    public function testSingleCodeBlockConversion()
    {
        $text = '<pre class="language-php"><code>echo \'some highlighted-text\';</code></pre>';
        $expected = "<pre><x-torchlight-code language='php'>echo 'some highlighted-text';</x-torchlight-code></pre>";

        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($expected, $result);
    }

    public function testMultipleCodeBlocksConversion()
    {
        $text = '<pre class="language-php"><code>echo "hello";</code></pre><pre class="language-javascript"><code>console.log("world");</code></pre>';
        $expected = '<pre><x-torchlight-code language=\'php\'>echo "hello";</x-torchlight-code></pre><pre><x-torchlight-code language=\'javascript\'>console.log("world");</x-torchlight-code></pre>';

        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($expected, $result);
    }

    public function testMixedBullshitContent()
    {
        $text = '<p>normal text</p>
                <pre class="language-php"><code>echo \'some highlighted-text\';</code></pre>
                <p>another normal line but new lines</p>
                <pre class="language-javascript"><code>console.log(\'highlighted js text\');</code></pre>
                <p>done</p>';

        $expected = "<p>normal text</p>
                <pre><x-torchlight-code language='php'>echo 'some highlighted-text';</x-torchlight-code></pre>
                <p>another normal line but new lines</p>
                <pre><x-torchlight-code language='javascript'>console.log('highlighted js text');</x-torchlight-code></pre>
                <p>done</p>";

        $result = $this->prism2Torchlight->convertToTorchlight($text);

        $this->assertEquals($expected, $result);
    }
}
