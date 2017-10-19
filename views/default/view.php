<?php

use amintado\base\AmintadoFunctions;
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */

$this->title = Yii::t('amintado_inquery', 'Inquery in time') . ' ' .(new AmintadoFunctions())->convertdate($model->created_at);
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inqueries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inquery-view">

    <div class="row">

        <div class="col-md-7">
            <?php if (!empty($model->category0)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'category') ?></h3>
                            </div>
                            <div class="panel-body" >
                                <?php
                                echo $model->category0->catname;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'request text') ?></h3>
                        </div>
                        <div class="panel-body" style="min-height: 90px">
                            <?= Html::decode($model->qdescription) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'request data') ?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <?= Yii::t('amintado_inquery', 'qdate') ?>
                                    :
                                    <?php

                                    if (Yii::$app->controller->module->jalaliDate) {
                                        echo (new amintado\base\AmintadoFunctions())->convertdatetime($model->qdate);
                                    } else {
                                        echo $model->qdate;
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <?= Yii::t('amintado_inquery', 'status') ?>
                                    :
                                    <?= $model->getStatusHtml() ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <?php
                                    if (!empty($model->qfile)) {

                                        echo Html::a
                                        (
                                            Yii::t('amintado_inquery', 'qfile') .
                                            ':  <span style="direction: ltr">'
                                            . $model->qfile
                                            . '</span>',
                                            Yii::$app->controller->module->downloadUrl
                                            . '/' . $model->qfile
                                        );
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($model->adescription)){
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success panel-sidebar">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'answer') ?></h3>
                    </div>
                    <div class="panel-body">
                       <div class="row">
                           <div class="col-md-12">

                                   <div class="panel panel-default">
                                       <div class="panel-heading">
                                           <h3 class="panel-title"><?= Yii::t('amintado_inquery', 'adescription') ?></h3>
                                       </div>
                                       <div class="panel-body">
                                           <?= Html::decode($model->adescription); ?>
                                       </div>
                                   </div>

                           </div>

                       </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }  ?>


</div>
