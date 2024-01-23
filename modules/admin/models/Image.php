<?php

namespace app\modules\admin\models;

use app\models\Traits\HasStatusValidator;
use app\enums\ImageStatus;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Image extends \yii\db\ActiveRecord
{
    use HasStatusValidator;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    public static function find()
    {
        return new ImageQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'id'], 'required'],
            [['id'], 'integer'],
            [['status'], 'string'],
            [['status'], 'validateStatus'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function createNew(int $id): self
    {
        $image = new Image();
        $image->id = $id;
        $image->status = ImageStatus::created->value;
        $image->save();

        return $image;
    }
}
