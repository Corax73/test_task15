<?php

namespace app\controllers;
 
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
 
class ImagesController extends ActiveController
{
    public $modelClass = 'app\models\Image';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create'], $actions['update'], $actions['options']);
        return ArrayHelper::merge($actions, [
            'index' => [
                'pagination' => [
                    'pageSize' => 5,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'created_at' => SORT_DESC,
                    ],
                ],
            ],
        ]);
    }
}
