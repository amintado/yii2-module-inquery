<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */

$this->title = Yii::t('amintado_inquery', 'Update {modelClass}: ', [
    'modelClass' => 'Inquery',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inqueries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('amintado_inquery', 'Update');
?>
<div class="inquery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
