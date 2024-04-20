<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Report $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput(['type' => 'text', 'readonly' => '']) ?>

    <?= $form->field($model, 'description')->textarea(['type' => 'text', 'readonly' => '']) ?>

    <?= $form->field($model, 'status_id')->dropDownList([2 => 'Подтверждено', 3 => 'Отклонено'], ['prompt' => ['text' => 'Новое', 'options' => ['style' => 'display:none']]]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
