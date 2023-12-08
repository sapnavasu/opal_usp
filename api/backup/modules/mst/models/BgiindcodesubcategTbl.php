<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "bgiindcodesubcateg_tbl".
 *
 * @property int $bgiindcodesubcateg_pk Primary key
 * @property int $bicsc_bgiindcodecateg_fk Reference to bgiindcodecateg_tbl
 * @property string $bicsc_subcategorycode Sub Category Code
 * @property string $bicsc_subcategoryname Sub Category Name
 * @property int $bicsc_subcategorytype 1 - Product, 2 - Service
 * @property int $bicsc_categorystatus 1 - Active, 2 - Inactive
 * @property string $bicsc_createdon Datetime of creation
 * @property int $bicsc_createdby Reference to usermst_tbl
 * @property string $bicsc_createdbyipaddr Creating User's IP Address
 * @property string $bicsc_updatedon Datetime of updation
 * @property int $bicsc_updatedby Reference to usermst_tbl
 * @property string $bicsc_updatedbyipaddr Updating User's IP Address
 */
class BgiindcodesubcategTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgiindcodesubcateg_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bicsc_bgiindcodecateg_fk', 'bicsc_subcategorycode', 'bicsc_subcategoryname', 'bicsc_subcategorytype', 'bicsc_categorystatus', 'bicsc_createdby'], 'required'],
            [['bicsc_bgiindcodecateg_fk', 'bicsc_subcategorytype', 'bicsc_categorystatus', 'bicsc_createdby', 'bicsc_updatedby'], 'integer'],
            [['bicsc_createdon', 'bicsc_updatedon'], 'safe'],
            [['bicsc_subcategorycode'], 'string', 'max' => 45],
            [['bicsc_subcategoryname'], 'string', 'max' => 200],
            [['bicsc_createdbyipaddr', 'bicsc_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bgiindcodesubcateg_pk' => 'Primary key',
            'bicsc_bgiindcodecateg_fk' => 'Reference to bgiindcodecateg_tbl',
            'bicsc_subcategorycode' => 'Sub Category Code',
            'bicsc_subcategoryname' => 'Sub Category Name',
            'bicsc_subcategorytype' => '1 - Product, 2 - Service',
            'bicsc_categorystatus' => '1 - Active, 2 - Inactive',
            'bicsc_createdon' => 'Datetime of creation',
            'bicsc_createdby' => 'Reference to usermst_tbl',
            'bicsc_createdbyipaddr' => 'Creating User\'s IP Address',
            'bicsc_updatedon' => 'Datetime of updation',
            'bicsc_updatedby' => 'Reference to usermst_tbl',
            'bicsc_updatedbyipaddr' => 'Updating User\'s IP Address',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BgiindcodesubcategTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BgiindcodesubcategTblQuery(get_called_class());
    }
}