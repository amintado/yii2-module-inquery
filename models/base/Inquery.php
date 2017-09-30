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

namespace amintado\inquery\models\base;

use amintado\inquery\models\traits\GlobalTrait;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "{{%taban_inquery}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $qdescription
 * @property string $qfile
 * @property string $qdate
 * @property string $adate
 * @property string $afile
 * @property string $adescription
 * @property integer $category
 * @property string $UUID
 * @property string $lock
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property string $restored_by
 *
 * @property \common\models\InqueryCategory $category0
 * @property \common\models\TabanUsers $u
 */
class Inquery extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    use GlobalTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'restored_by' => \Yii::$app->user->id,
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'restored_by' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'category0',
            'u'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'category', 'lock', 'created_by', 'updated_by', 'deleted_by', 'restored_by'], 'integer'],
            [['qdescription', 'adescription'], 'required'],
            [['qdate', 'adate', 'created_at', 'updated_at'], 'safe'],
            [['qdescription', 'adescription'], 'string', 'max' => 2000],
            [['qfile', 'afile'], 'string', 'max' => 255],
            [['UUID'], 'string', 'max' => 32],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%inquery}}';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'uid' => Yii::t('common', 'answered by'),
            'qdescription' => Yii::t('common', 'Qdescription'),
            'qfile' => Yii::t('common', 'Qfile'),
            'qdate' => Yii::t('common', 'Qdate'),
            'adate' => Yii::t('common', 'Adate'),
            'afile' => Yii::t('common', 'Afile'),
            'adescription' => Yii::t('common', 'Adescription'),
            'category' => Yii::t('common', 'Category'),
            'UUID' => Yii::t('common', 'Uuid'),
            'lock' => Yii::t('common', 'Lock'),
            'restored_by' => Yii::t('common', 'Restored By'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(\amintado\inquery\models\InqueryCategory::className(), ['id' => 'category']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'uid']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \common\models\InqueryQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \amintado\inquery\models\InqueryQuery(get_called_class());
        return $query->where(['deleted_by' => 0]);
    }
}
