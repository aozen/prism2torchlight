<?php

namespace Aozen\Prism2Torchlight;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TorchlightCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): string
    {
        return Prism2Torchlight::convertToTorchlight($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
