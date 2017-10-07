<?php
/*******************************************************************************
 * Copyright (c) 2017.
 * this file created in printing-office project
 * framework: Yii2
 * license: GPL V3 2017 - 2025
 * Author:amintado@gmail.com
 * Company:shahrmap.ir
 * Official GitHub Page: https://github.com/amintado/printing-office
 * All rights reserved.
 ******************************************************************************/

/* @var $this yii\web\View */
/* @var $searchModel amintado\inquery\models\\InquerySearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use amintado\inquery\models\base\Inquery;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = Yii::t('amintado_inquery', 'Inqueries');
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$js = <<< JS
$('#createB').click(function(a){
    a.preventDefault();
    
   $('#createM').modal('show');
});
$('#Cancel').click(function(a) {
    a.preventDefault();
    $('#createM').modal('hide');
})
JS;
$this->registerJs($js, View::POS_END);
$this->registerJs($search);

Modal::begin(
    [
        'id' => 'createM',
        'header' => '<h4 style="color: #2121ff;">' . Yii::t('amintado_inquery', 'Create Inquery') . '</h4>'
    ]
);

echo $this->render('create', ['model' => new Inquery()]);
Modal::end()

?>
<div class="inquery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('amintado_inquery', 'Create Inquery'), '#', ['class' => 'btn btn-success', 'id' => 'createB']) ?>

    </p>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'uid',
            'label' => Yii::t('amintado_inquery', 'Uid'),
            'value' => function ($model) {
                if ($model->u) {
                    return $model->u->username;
                } else {
                    return NULL;
                }
            },
            'filterType' => GridView::TEXT,
        ],
        [
            'attribute' => 'qdescription',
            'format' => 'html'
        ],
        [
            'attribute' => 'qdate',
            'label' => Yii::t('amintado_inquery', 'qdate'),
            'value' => function ($model) {
                /**
                 * @var $model Inquery
                 */
                if (Yii::$app->language == 'fa-IR') {
                    if (!empty($model->qdate)) {
                        return (new amintado\base\AmintadoFunctions())->convertdatetime($model->qdate);
                    }
                }
            }
        ],


        [
            'attribute' => 'category',
            'label' => Yii::t('amintado_inquery', 'Category'),
            'value' => function ($model) {
                if ($model->category0) {
                    return $model->category0->id;
                } else {
                    return NULL;
                }
            },
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => \yii\helpers\ArrayHelper::map(\amintado\inquery\models\base\InqueryCategory::find()->asArray()->all(), 'id', 'id'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => Yii::t('amintado_inquery', 'Taban inquery category'), 'id' => 'grid-inquery-search-category']
        ],

        ['attribute' => 'lock', 'visible' => false],

        [
            'attribute' => 'status',
            'label' => Yii::t('amintado_inquery', 'status'),
            'value' => function ($model) {
                /**
                 * @var $model Inquery
                 */
                return $model->getStatusHtml();
            },
            'format' => 'html'

        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete} {confirm}',
            'buttons' =>
                [
                    'confirm' => function ($url, $model, $key) {
                        return '<a href="' . $url . '" title="'. Yii::t('amintado_inquery', 'Confirmation').'" aria-label="'. Yii::t('amintado_inquery', 'Confirmation').'" data-pjax="0"><span class="glyphicon glyphicon-ok"></span></a>';
                    }
                ]
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-inquery']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
