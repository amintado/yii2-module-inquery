<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inqueries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inquery-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('amintado_inquery', 'Inquery').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . Yii::t('amintado_inquery', 'PDF'), 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => Yii::t('amintado_inquery', 'Will open the generated PDF file in a new window')
                ]
            )?>
            
            <?= Html::a(Yii::t('amintado_inquery', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('amintado_inquery', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('amintado_inquery', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'u.username',
            'label' => Yii::t('amintado_inquery', 'Uid'),
        ],
        'qdescription',
        'qfile',
        'qdate',
        'adate',
        'afile',
        'adescription',
        [
            'attribute' => 'category0.id',
            'label' => Yii::t('amintado_inquery', 'Category'),
        ],
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>InqueryCategory<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnInqueryCategory = [
        ['attribute' => 'id', 'visible' => false],
        'catname',
        'description',
        'date',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
    ];
    echo DetailView::widget([
        'model' => $model->category0,
        'attributes' => $gridColumnInqueryCategory    ]);
    ?>
    <div class="row">
        <h4>Users<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnUsers = [
        ['attribute' => 'id', 'visible' => false],
        'username',
        'hash_id',
        'fullname',
        'RoleID',
        'Image',
        'auth_key',
        'access_token',
        'password_hash',
        'password_reset_token',
        'email',
        'status',
        'IsPrivate',
        'LastLoginIP',
        'imei',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'mode',
        'VerificationCode',
    ];
    echo DetailView::widget([
        'model' => $model->u,
        'attributes' => $gridColumnUsers    ]);
    ?>
</div>
