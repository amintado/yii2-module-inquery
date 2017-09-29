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

namespace amintado\inquery;

use amintado\ticket\models\User;
use Yii;

/**
 * ticket module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'amintado\inquery\controllers';

    /** @var bool Уведомление на почту о тикетах */
    public $mailSend = false;

    /** @var string Тема email сообщения когда пользователю приходит ответ */
    public $subjectAnswer = 'پاسخ درخواست پشتیبانی شما';


}
