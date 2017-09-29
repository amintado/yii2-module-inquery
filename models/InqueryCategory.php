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

namespace amintado\inquery\models;

use Yii;
use amintado\inquery\models\base\InqueryCategory as BaseTabanInqueryCategory;

/**
 * This is the model class for table "taban_inquery_category".
 */
class InqueryCategory extends BaseTabanInqueryCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['catname'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['catname'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
