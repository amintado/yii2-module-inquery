<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="inquery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'uid')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\inquery\models\base\Users::find()->orderBy('id')->asArray()->all(), 'id', 'username'),
        'options' => ['placeholder' => Yii::t('amintado_inquery', 'Choose Taban users')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'qdescription')->textInput(['maxlength' => true, 'placeholder' => 'Qdescription']) ?>

    <?= $form->field($model, 'qfile')->textInput(['maxlength' => true, 'placeholder' => 'Qfile']) ?>

    <?= $form->field($model, 'qdate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('amintado_inquery', 'Choose Qdate'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'adate')->widget(\kartik\datecontrol\DateControl::classname(), [
        'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
        'saveFormat' => 'php:Y-m-d H:i:s',
        'ajaxConversion' => true,
        'options' => [
            'pluginOptions' => [
                'placeholder' => Yii::t('amintado_inquery', 'Choose Adate'),
                'autoclose' => true,
            ]
        ],
    ]); ?>

    <?= $form->field($model, 'afile')->textInput(['maxlength' => true, 'placeholder' => 'Afile']) ?>

    <?= $form->field($model, 'adescription')->textInput(['maxlength' => true, 'placeholder' => 'Adescription']) ?>

    <?= $form->field($model, 'category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\inquery\models\base\InqueryCategory::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => Yii::t('amintado_inquery', 'Choose Taban inquery category')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'UUID')->textInput(['maxlength' => true, 'placeholder' => 'UUID']) ?>

    <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'restored_by')->textInput(['maxlength' => true, 'placeholder' => 'Restored By']) ?>

    <?= $form->field($model, 'status')->textInput(['placeholder' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('amintado_inquery', 'Create') : Yii::t('amintado_inquery', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
