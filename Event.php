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


class Event implements EventInterface
{
    public static function afterAnswer($model)
    {
        return null;// TODO: Implement afterAnswer() method.
    }

    public static function afterCreate($model)
    {
        return null; // TODO: Implement afterCreate() method.
    }

    public static function afterViewed($model)
    {
        return null;// TODO: Implement afterViewed() method.
    }

    public static function AnswerError($model)
    {
        return null;// TODO: Implement AnswerError() method.
    }

    public static function CreateError($model)
    {
        return null;// TODO: Implement CreateError() method.
    }
}