<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ApiCredentials $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="api-credentials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'consumer_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_secret')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_updated')->textInput() ?>

    <?= $form->field($model, 'short_code')->textInput() ?>

    <?= $form->field($model, 'confirmation_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'validation_url')->textInput(['maxlength' => true]) ?>
        
    <?= $form->field($model, 'stk_callback_url')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
