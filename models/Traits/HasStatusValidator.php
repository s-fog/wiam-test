<?php

namespace app\models\Traits;

use app\enums\ImageStatus;

trait HasStatusValidator
{
    public function validateStatus($attribute, $params, $validator)
    {
        if (ImageStatus::tryFrom($this->$attribute) === null) {
            $this->addError($attribute, 'Invalid status');
        }
    }
}