<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "bgiinduscodeprodmst_tbl".
 *
 * @property int $bgiinduscodeprodmst_pk Primary key
 * @property int $bicpm_bgiindcodecateg_fk Reference to bgiindcodecateg_tbl
 * @property int $bicpm_bgiindcodesubcateg_fk Reference to bgiindcodesubcateg_tbl
 * @property string $bicpm_productcode Product Code
 * @property string $bicpm_productname Product Name
 * @property int $bicpm_prodstatus 1 - Active, 2 - Inactive
 * @property string $bicpm_createdon Datetime of creation
 * @property int $bicpm_createdby Reference to usermst_tbl
 * @property string $bicpm_createdbyipaddr Creating User's IP Address
 * @property string $bicpm_updatedon Datetime of updation
 * @property int $bicpm_updatedby Reference to usermst_tbl
 * @property string $bicpm_updatedbyipaddr Updating User's IP Address
 */
class BgiinduscodeprodmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgiinduscodeprodmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bicpm_bgiindcodecateg_fk', 'bicpm_bgiindcodesubcateg_fk', 'bicpm_productcode', 'bicpm_productname', 'bicpm_prodstatus', 'bicpm_createdby'], 'required'],
            [['bicpm_bgiindcodecateg_fk', 'bicpm_bgiindcodesubcateg_fk', 'bicpm_prodstatus', 'bicpm_createdby', 'bicpm_updatedby'], 'integer'],
            [['bicpm_createdon', 'bicpm_updatedon'], 'safe'],
            [['bicpm_productcode'], 'string', 'max' => 45],
            [['bicpm_productname'], 'string', 'max' => 200],
            [['bicpm_createdbyipaddr', 'bicpm_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bgiinduscodeprodmst_pk' => 'Bgiinduscodeprodmst Pk',
            'bicpm_bgiindcodecateg_fk' => 'Bicpm Bgiindcodecateg Fk',
            'bicpm_bgiindcodesubcateg_fk' => 'Bicpm Bgiindcodesubcateg Fk',
            'bicpm_productcode' => 'Bicpm Productcode',
            'bicpm_productname' => 'Bicpm Productname',
            'bicpm_prodstatus' => 'Bicpm Prodstatus',
            'bicpm_createdon' => 'Bicpm Createdon',
            'bicpm_createdby' => 'Bicpm Createdby',
            'bicpm_createdbyipaddr' => 'Bicpm Createdbyipaddr',
            'bicpm_updatedon' => 'Bicpm Updatedon',
            'bicpm_updatedby' => 'Bicpm Updatedby',
            'bicpm_updatedbyipaddr' => 'Bicpm Updatedbyipaddr',
        ];
    }
}