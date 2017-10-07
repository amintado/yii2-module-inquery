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

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model amintado\inquery\models\base\Inquery */
$this->title= Yii::t('amintado_inquery', 'Confirmation')
?>
<div class="inquery-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
