<?php

/** @var yii\web\View $this */

use app\models\Image;
use yii\bootstrap5\Button;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$dataProvider = new ActiveDataProvider([
    'query' => Image::find()->select([
        'title',
        'original_title',
        'created_at'
    ]),
    'pagination' => [
        'pageSize' => 5,
    ],
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'title',
        'original_title',
        'created_at'
    ],
    'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
]);

echo Html::a('Image upload form', ['/image/image-load'], ['class' => 'btn btn-primary']);
