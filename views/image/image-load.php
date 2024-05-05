<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Image $model */
/** @var ActiveForm $form */
$this->title = 'Загрузка файлов изображений';
?>
<div class="image-load">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <button>Загрузить</button>
    <?php ActiveForm::end(); ?>

</div><!-- image-load -->