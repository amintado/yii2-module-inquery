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
    </div>

    <div class="row">
<?php 
    $gridColumn = [
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
        [
                'attribute' => 'category0.id',
                'label' => Yii::t('amintado_inquery', 'Category')
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
</div>
