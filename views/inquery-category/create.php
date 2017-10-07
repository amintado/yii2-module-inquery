<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\InqueryCategory */

$this->title = Yii::t('amintado_inquery', 'Create Inquery Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('amintado_inquery', 'Inquery Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inquery-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
