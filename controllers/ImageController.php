<?php

namespace app\controllers;

use app\models\Image;
use Yii;
use yii\web\UploadedFile;

class ImageController extends \yii\web\Controller
{
    public $modelClass = 'app\models\Image';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionImageLoad()
    {
        $model = new Image();
        if (Yii::$app->request->post()) {
            $files = UploadedFile::getInstance($model, 'title');
            dump($files);die;
        }
        return $this->render('image-load', ['model' => $model]);
    }
}
