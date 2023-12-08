<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "bgiindcodecateg_tbl".
 *
 * @property int $bgiindcodecateg_pk Primary key
 * @property string $bicc_categorycode Category Code
 * @property string $bicc_categoryname Category Name
 * @property int $bicc_categorytype 1 - Product, 2 - Service
 * @property int $bicc_categorystatus 1 - Active, 2 - Inactive
 * @property string $bicc_createdon Datetime of creation
 * @property int $bicc_createdby Reference to usermst_tbl
 * @property string $bicc_createdbyipaddr Creating User's IP Address
 * @property string $bicc_updatedon Datetime of updation
 * @property int $bicc_updatedby Reference to usermst_tbl
 * @property string $bicc_updatedbyipaddr Updating User's IP Address
 */
class BgiindcodecategTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgiindcodecateg_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bicc_categorycode', 'bicc_categoryname', 'bicc_categorytype', 'bicc_categorystatus', 'bicc_createdby'], 'required'],
            [['bicc_globalportalmst_fk','bicc_categorytype', 'bicc_categorystatus', 'bicc_createdby', 'bicc_updatedby'], 'integer'],
            [['bicc_createdon', 'bicc_updatedon'], 'safe'],
            [['bicc_categorycode'], 'string', 'max' => 45],
            [['bicc_categoryname'], 'string', 'max' => 200],
            [['bicc_createdbyipaddr', 'bicc_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bgiindcodecateg_pk' => 'Bgiindcodecateg Pk',
            'bicc_globalportalmst_fk' => 'Bicc globalportalmst Fk',
            'bicc_categorycode' => 'Bicc Categorycode',
            'bicc_categoryname' => 'Bicc Categoryname',
            'bicc_categorytype' => 'Bicc Categorytype',
            'bicc_categorystatus' => 'Bicc Categorystatus',
            'bicc_createdon' => 'Bicc Createdon',
            'bicc_createdby' => 'Bicc Createdby',
            'bicc_createdbyipaddr' => 'Bicc Createdbyipaddr',
            'bicc_updatedon' => 'Bicc Updatedon',
            'bicc_updatedby' => 'Bicc Updatedby',
            'bicc_updatedbyipaddr' => 'Bicc Updatedbyipaddr',
        ];
    }

    
        /**
     * {@inheritdoc}
     * @return BgiindcodecategTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BgiindcodecategTblQuery(get_called_class());
    }
}