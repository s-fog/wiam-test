<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ImageForm $model */
/** @var ActiveForm $form */
$this->title = 'Image';

if (isset($exceptionMessage)) {
    echo $exceptionMessage;
    return;
}

echo $this->render('image-form', ['model' => $model]);

?>

