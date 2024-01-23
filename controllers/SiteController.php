<?php

namespace app\controllers;

use app\models\ImageForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new ImageForm();
        $request = \Yii::$app->getRequest();

        if ($request->isPost && $model->load($request->post())) {
            if ($model->validate()) {
                $model->saveNewStatus();
            }

            return $this->renderAjax('image-form', ['model' => $model]);
        } else {
            try {
                $image = $model->generateImage();
            } catch (\Exception $message) {
                return $this->render('index', [
                    'exceptionMessage' => $message->getMessage(),
                ]);
            }
            $model->imageId = $image->id;
            $model->status = $image->status;
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
