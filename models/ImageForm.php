<?php

namespace app\models;

use app\models\Traits\HasStatusValidator;
use app\modules\admin\models\Image;
use app\enums\ImageStatus;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class ImageForm extends Model
{
    use HasStatusValidator;

    const START = 1;
    const END = 10;

    public int $imageId;
    public string $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['imageId', 'status'], 'required'],
            ['imageId', 'integer'],
            ['status', 'validateStatus'],
        ];
    }

    public function generateImage(): Image
    {
        $currentIds = ArrayHelper::getColumn(Image::find()
            ->select('id')
            ->notCreated()
            ->all(), 'id');

        if (count($currentIds) === self::END) {
            throw new \Exception('Maximum amount of images exceeded');
        }

        do {
            $id = rand(self::START, self::END);
        } while(in_array($id, $currentIds));

        if (null !== $image = Image::findOne($id)) {
            return $image;
        }

        return Image::createNew($id);
    }

    public function saveNewStatus(): Image
    {
        $image = Image::find()
            ->where(['id' => $this->imageId])
            ->one();

        if ($image !== null) {
            $image->status = $this->status;

            if (! $image->save()) {
                throw new \Exception('Something goes wrong');
            }
        }

        return $image;
    }
}
