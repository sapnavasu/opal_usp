<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "bgiinduscodeservmst_tbl".
 *
 * @property int $bgiinduscodeservmst_pk Primary key
 * @property int $bicsm_bgiindcodecateg_fk Reference to bgiindcodecateg_tbl
 * @property int $bicsm_bgiindcodesubcateg_fk Reference to bgiindcodesubcateg_tbl
 * @property string $bicsm_servicecode Service Code
 * @property string $bicsm_servicename Service Name
 * @property int $bicsm_servstatus 1 - Active, 2 - Inactive
 * @property string $bicsm_createdon Datetime of creation
 * @property int $bicsm_createdby Reference to usermst_tbl
 * @property string $bicsm_createdbyipaddr Creating User's IP Address
 * @property string $bicsm_updatedon Datetime of updation
 * @property int $bicsm_updatedby Reference to usermst_tbl
 * @property string $bicsm_updatedbyipaddr Updating User's IP Address
 */
class BgiinduscodeservmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bgiinduscodeservmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bicsm_bgiindcodecateg_fk', 'bicsm_bgiindcodesubcateg_fk', 'bicsm_servicecode', 'bicsm_servicename', 'bicsm_servstatus', 'bicsm_createdby'], 'required'],
            [['bicsm_bgiindcodecateg_fk', 'bicsm_bgiindcodesubcateg_fk', 'bicsm_servstatus', 'bicsm_createdby', 'bicsm_updatedby'], 'integer'],
            [['bicsm_createdon', 'bicsm_updatedon'], 'safe'],
            [['bicsm_servicecode'], 'string', 'max' => 45],
            [['bicsm_servicename'], 'string', 'max' => 200],
            [['bicsm_createdbyipaddr', 'bicsm_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bgiinduscodeservmst_pk' => 'Bgiinduscodeservmst Pk',
            'bicsm_bgiindcodecateg_fk' => 'Bicsm Bgiindcodecateg Fk',
            'bicsm_bgiindcodesubcateg_fk' => 'Bicsm Bgiindcodesubcateg Fk',
            'bicsm_servicecode' => 'Bicsm Servicecode',
            'bicsm_servicename' => 'Bicsm Servicename',
            'bicsm_servstatus' => 'Bicsm Servstatus',
            'bicsm_createdon' => 'Bicsm Createdon',
            'bicsm_createdby' => 'Bicsm Createdby',
            'bicsm_createdbyipaddr' => 'Bicsm Createdbyipaddr',
            'bicsm_updatedon' => 'Bicsm Updatedon',
            'bicsm_updatedby' => 'Bicsm Updatedby',
            'bicsm_updatedbyipaddr' => 'Bicsm Updatedbyipaddr',
        ];
    }

         /**
     * {@inheritdoc}
     * @return BgiinduscodeservmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BgiinduscodeservmstTblQuery(get_called_class());
    }
}