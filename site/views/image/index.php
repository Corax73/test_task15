<?php

/** @var yii\web\View $this */

use app\models\Image;
use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

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
        'created_at',
        [
            'label' => 'Preview',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::img('/uploads/' . $data->title, [
                    'alt' => $data->title,
                    'style' => 'width:5%;'
                ]);
            },
        ],
        [
            'label' => 'Download zip',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a('Скачать', ['image/download', 'title' => $data->title]);
            },
        ]
    ],
    'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
]);

echo Html::a('Image upload form', ['/image/image-load'], ['class' => 'btn btn-primary']);

$this->registerJsFile('/js/getOriginalImage.js', ['position'=>\yii\web\View::POS_END]);
