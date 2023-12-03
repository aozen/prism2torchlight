<?php

namespace Aozen\Prism2Torchlight;

class Prism2Torchlight
{
    public static function convertToTorchlight(string $text): string
    {
        $pattern = '/<pre class="language-(\w+)"><code>(.*?)<\/code><\/pre>/s';
        $callback = function ($matches) {
            $language = $matches[1];
            $code = htmlspecialchars_decode($matches[2]);

            return "<pre><x-torchlight-code language='{$language}'>{$code}</x-torchlight-code></pre>";
        };

        return preg_replace_callback($pattern, $callback, $text);
    }
}
