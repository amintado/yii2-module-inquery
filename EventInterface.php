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
use amintado\inquery\models\Inquery;
use amintado\inquery\models\InqueryQuery;

interface EventInterface{
    /**
     * this function runs when an inquery is created with user
     * @param $model Inquery
     * @return mixed
     */
public static function afterCreate($model);

    /**
     * this function runs when an inquery is answered in 'Manage' controller
     * @param $model Inquery
     * @return mixed
     */
public static function afterAnswer($model);

    /**
     * this function runs when an inquery viewed in 'Manage' controller
     * @param $model Inquery
     * @return mixed
     */
public static function afterViewed($model);

    /**
     * this function runs when error occur in create an inquery
     * @param $model InqueryQuery
     * @return mixed
     */
public static function CreateError($model);

    /**
     * this function runs when error occur in answer to an inquery
     * @param $model Inquery
     * @return mixed
     */
public static function AnswerError($model);

}
