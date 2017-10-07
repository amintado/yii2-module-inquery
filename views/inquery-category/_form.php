<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\InqueryCategory */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos' => \yii\web\View::POS_END,
    'viewParams' => [
        'class' => 'Inquery',
        'relID' => 'inquery',
        'value' => \yii\helpers\Json::encode($model->inqueries),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);

?>

<div class="inquery-category-form">

    <?php $form = ActiveForm::begin(
            [
                    'action' => ['create']
            ]
    ); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'catname')->textInput(['maxlength' => true, 'placeholder' => Yii::t('amintado_inquery', 'Catname placeholder')]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(),
        [
            'preset' => 'basic'
        ]
    ) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('amintado_inquery', 'Create') : Yii::t('amintado_inquery', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('amintado_inquery', 'Cancel'), '#', ['class' => 'btn btn-danger', 'id' => 'cancelID']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
