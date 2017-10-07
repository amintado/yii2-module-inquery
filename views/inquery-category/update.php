<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\InqueryCategory */

$this->title = Yii::t('amintado_inquery', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inquery Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('amintado_inquery', 'Update');
$this->params['breadcrumbs'][] = $model->catname;
?>
<div class="inquery-category-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
