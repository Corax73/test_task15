<?php

namespace app\controllers;

use app\models\UploadForm;
use app\repositories\ImageRepository;
use Yii;
use yii\web\UploadedFile;

class ImageController extends \yii\web\Controller
{
    public $modelClass = 'app\models\Image';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionImageLoad(): string
    {
        $model = new UploadForm();
        if (Yii::$app->request->post()) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            $rep = new ImageRepository();
            $result = $rep->saveImages($model->upload());
            if ($result) {
                $model = new UploadForm();
                return $this->render('image-load', ['model' => $model]);
            } else {
                /**
                 * stub
                 */
                return $this->render('index');
            }
        }
        return $this->render('image-load', ['model' => $model]);
    }

    public function actionDownload(string $title): \yii\web\Response | string
    {
        $result = false;
        $rep = new ImageRepository();
        $zipFileName = $rep->getZipFile($title);
        if ($zipFileName) {
            $result = true;
        }
        return $result ? Yii::$app->response->sendFile($zipFileName) : $this->render('index');
    }
}
