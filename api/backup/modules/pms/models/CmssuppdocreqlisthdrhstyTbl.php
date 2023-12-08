<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmssuppdocreqlisthdrhsty_tbl".
 *
 * @property int $cmssuppdocreqlisthdrhsty_pk Primary key
 * @property int $csdrlh_cmssuppdocreqlisthdr_fk Reference to cmssuppdocreqlisthdr_tbl
 * @property int $csdrlh_cmstnchdrhsty_fk Reference to cmstnchdrhsty_tbl
 * @property int $csdrlh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl
 * @property int $csdrlh_shared_type 1 - Requisition/ Tender Notice, 2 - Enquiry (RFP, RFQ) 3 - Contract/ Purchase Order
 * @property string $csdrlh_sdrlrefno Supplier Document Requirement list (SDRL) Reference No
 * @property string $csdrlh_sdrldate SDRL Date
 * @property int $csdrlh_sdrlusermst_fk SDRL Issued By: Reference to usermst_tbl
 * @property int $csdrlh_status 1 - Active, 2 - Inactive
 * @property string $csdrlh_createdon Date of creation
 * @property int $csdrlh_createdby Reference to usermst_tbl
 * @property string $csdrlh_createdbyipaddr User IP Address
 * @property string $csdrlh_updatedon Date of update
 * @property int $csdrlh_updatedby Reference to usermst_tbl
 * @property string $csdrlh_updatedbyipaddr User IP Address
 */
class CmssuppdocreqlisthdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlisthdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrlh_cmssuppdocreqlisthdr_fk', 'csdrlh_cmstnchdrhsty_fk', 'csdrlh_shared_fk', 'csdrlh_shared_type', 'csdrlh_sdrlrefno', 'csdrlh_sdrldate', 'csdrlh_sdrlusermst_fk', 'csdrlh_status', 'csdrlh_createdon', 'csdrlh_createdby'], 'required'],
            [['csdrlh_cmssuppdocreqlisthdr_fk', 'csdrlh_cmstnchdrhsty_fk', 'csdrlh_shared_fk', 'csdrlh_shared_type', 'csdrlh_sdrlusermst_fk', 'csdrlh_status', 'csdrlh_createdby', 'csdrlh_updatedby'], 'integer'],
            [['csdrlh_sdrldate', 'csdrlh_createdon', 'csdrlh_updatedon'], 'safe'],
            [['csdrlh_sdrlrefno', 'csdrlh_createdbyipaddr', 'csdrlh_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlisthdrhsty_pk' => 'Cmssuppdocreqlisthdrhsty Pk',
            'csdrlh_cmssuppdocreqlisthdr_fk' => 'Csdrlh Cmssuppdocreqlisthdr Fk',
            'csdrlh_cmstnchdrhsty_fk' => 'Csdrlh Cmstnchdrhsty Fk',
            'csdrlh_shared_fk' => 'Csdrlh Shared Fk',
            'csdrlh_shared_type' => 'Csdrlh Shared Type',
            'csdrlh_sdrlrefno' => 'Csdrlh Sdrlrefno',
            'csdrlh_sdrldate' => 'Csdrlh Sdrldate',
            'csdrlh_sdrlusermst_fk' => 'Csdrlh Sdrlusermst Fk',
            'csdrlh_status' => 'Csdrlh Status',
            'csdrlh_createdon' => 'Csdrlh Createdon',
            'csdrlh_createdby' => 'Csdrlh Createdby',
            'csdrlh_createdbyipaddr' => 'Csdrlh Createdbyipaddr',
            'csdrlh_updatedon' => 'Csdrlh Updatedon',
            'csdrlh_updatedby' => 'Csdrlh Updatedby',
            'csdrlh_updatedbyipaddr' => 'Csdrlh Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlisthdrhstyTblQuery(get_called_class());
    }
}
