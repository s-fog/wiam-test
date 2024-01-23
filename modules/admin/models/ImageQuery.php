<?php

namespace app\modules\admin\models;

use app\enums\ImageStatus;
use yii\db\ActiveQuery;

class ImageQuery extends ActiveQuery
{
    public function notCreated(): ImageQuery
    {
        return $this->where('"status" != :status', ['status' => ImageStatus::created->value]);
    }
}
