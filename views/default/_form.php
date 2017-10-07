<?php

use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="inquery-form">

    <?php $form = ActiveForm::begin(
            [
                    'action' => ['create']
            ]
    ); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'category')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\amintado\inquery\models\base\InqueryCategory::find()->orderBy('id')->asArray()->all(), 'id', 'catname'),
        'options' => ['placeholder' => Yii::t('amintado_inquery', Yii::t('amintado_inquery', 'Choose Taban inquery category'))],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'qdescription')->widget(CKEditor::className(),
        [
            'preset' => 'basic'
        ]) ?>
    <?= $form->field($model,'qfile')->widget(FileInput::className(),[
        'pluginOptions' => [
            'showPreview' => true,
            'showCaption' => true,
            'showRemove' => true,
            'showUpload' => false
        ],
        'options' =>
        [
                'multiple'=>false
        ]

    ]) ?>



    <div class="form-group">
        <?= Html::submitButton( Yii::t('amintado_inquery', 'Create') , ['class' =>  'btn btn-success']) ?>
        <?= Html::a(Yii::t('amintado_inquery', 'Cancel'), '#' , ['class'=> 'btn btn-danger','id'=>'Cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
