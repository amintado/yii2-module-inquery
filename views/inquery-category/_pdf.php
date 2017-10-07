<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\InqueryCategory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inquery Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inquery-category-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('amintado_inquery', 'Inquery Category').' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'catname',
        'description',
        'date',
        'UUID',
        ['attribute' => 'lock', 'visible' => false],
        'restored_by',
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
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode(Yii::t('amintado_inquery', 'Inquery')),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInquery
    ]);
}
?>
    </div>
</div>
