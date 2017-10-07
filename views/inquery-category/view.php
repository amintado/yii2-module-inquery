<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\InqueryCategory */

$this->title = $model->catname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inquery Categories'), 'url' => ['index']];
?>
<div class="inquery-category-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('amintado_inquery', 'Inquery Category').' ' ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">

            
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
        'catname',
        [
            'attribute'=>'description',
            'value'=>function($model){
                if (!empty($model->description)){
                    return Html::decode($model->description);
                }
            },
            'format'=>'html'
        ]

    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    
    <div class="row">
<?php
if($providerInquery->totalCount){
    $gridColumnInquery = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'u.username',
                'label' => Yii::t('amintado_inquery', 'Uid')
            ],
            'qdescription',
            'qfile',
            'qdate',
            'adate',
            'afile',
            'adescription',
                        'UUID',
            ['attribute' => 'lock', 'visible' => false],
            'restored_by',
            'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInquery,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-taban-inquery']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('amintado_inquery', 'Inquery')),
        ],
        'columns' => $gridColumnInquery
    ]);
}
?>

    </div>
</div>
