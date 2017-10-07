<?php

use dosamigos\ckeditor\CKEditor;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\web\View;
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

        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'qdescription') ?></h3>
                    </div>
                    <div class="panel-body" style="min-height: 242px">
                        <?= Html::decode($model->qdescription) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'request data') ?></h3>
                            </div>
                            <div class="panel-body">
                                <?= Yii::t('amintado_inquery', 'qdate') ?>
                                :
                                <?php
                                if (Yii::$app->controller->module->jalaliDate) {
                                    echo (new amintado\base\AmintadoFunctions())->convertdate($model->qdate);
                                } else {
                                    echo $model->qdate;
                                }
                                ?>
                                <br>
                                <?= Yii::t('amintado_inquery', 'status') ?>
                                :
                                <?= $model->statusHtml ?>
                                <br>
                                <?= Yii::t('amintado_inquery', 'category') ?>
                                :
                                <?php
                                if (!empty($model->category)) {
                                    echo $model->category0->catname;
                                }
                                ?>
                                <br>
                                <?php
                                echo Yii::t('amintado_inquery', 'qfile');


                                ?>
                                :
                                <?php
                                if (!empty($model->file)) {
                                    echo '<a href="' . $model->file . '">' . $model->qfile . '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'user data') ?> </h3>
                            </div>
                            <div class="panel-body">
                                <?= Yii::t('amintado_inquery', 'user name') ?>
                                :
                                <?php
                                if (!empty($model->u->username)) {

                                    echo $model->u->username;
                                }
                                ?>

                                <br>
                                <?= Yii::t('amintado_inquery', 'user fullname') ?>
                                :
                                <?php
                                if (!empty($model->u->fullname)) {

                                    echo $model->u->fullname;
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <?= $form->field($model, 'adescription')->widget(CKEditor::className(),
            [
                'preset' => 'basic'
            ]) ?>
        <?= $form->field($model, 'afile')->widget(FileInput::className(), [
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ],
            'options' =>
                [
                    'multiple' => false
                ]

        ]) ?>


        <div class="form-group">
            <?= Html::submitButton(Yii::t('amintado_inquery', 'Create'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('amintado_inquery', 'Cancel'), '#', ['class' => 'btn btn-danger', 'id' => 'Cancel']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$js = <<<JS
$(document).on('ready',function() {

});
JS;
$this->registerJs($js, View::POS_END);
?>