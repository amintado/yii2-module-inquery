<?php

/* @var $this yii\web\View */
/* @var $searchModel amintado\inquery\models\\InqueryCategorySearch */

/* @var $dataProvider yii\data\ActiveDataProvider */

use amintado\inquery\models\InqueryCategory;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\web\View;

$this->title = Yii::t('amintado_inquery', 'Inquery Categories');
$this->params['breadcrumbs'][] = $this->title;

$j = <<<JS
$('#create').click(function(e) {
    e.preventDefault();
  $('#modalCreate').modal('show');
});
JS;


$this->registerJs($j, View::POS_END);
Modal::begin([
    'id' => 'modalCreate'
]);
echo $this->render('create', ['model' => $model]);

Modal::end();
?>
<div class="inquery-category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('amintado_inquery', 'Create Inquery Category'), '#', ['class' => 'btn btn-success', 'id' => 'create']) ?>
    </p>

    <div class="search-form" style="display:none">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
        'catname',
        [
            'attribute' => 'description',
            'value' => function ($model) {
                /**
                 * @var $model InqueryCategory
                 */
                if (!empty($model->description)) {
                    return Html::decode($model->description);
                }
            },
            'format' => 'html'
        ]
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-inquery-category']],
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
                    'label' => Yii::t('amintado_inquery', 'full'),
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">' . Yii::t('amintado_inquery', 'export all data') . '</li>',
                    ],
                ],
            ]),
        ],
    ]); ?>

</div>
