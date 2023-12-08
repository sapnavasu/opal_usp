<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmssuppdocreqlisthdrtemp_tbl".
 *
 * @property int $cmssuppdocreqlisthdrtemp_pk Primary key
 * @property int $csdrlht_cmstnchdr_fk Reference to cmstnchdrtemp_tbl
 * @property int $csdrlht_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdrtemp_tbl, cmscontracthdr_tbl
 * @property int $csdrlht_shared_type 1 - Requisition/ Tender Notice, 2 - Enquiry (RFP, RFQ) 3 - Contract/ Purchase Order
 * @property string $csdrlht_sdrlrefno Supplier Document Requirement list (SDRL) Reference No
 * @property string $csdrlht_sdrldate SDRL Date
 * @property int $csdrlht_sdrlusermst_fk SDRL Issued By: Reference to usermst_tbl
 * @property int $csdrlht_status 1 - Active, 2 - Inactive
 * @property string $csdrlht_createdon Date of creation
 * @property int $csdrlht_createdby Reference to usermst_tbl
 * @property string $csdrlht_createdbyipaddr User IP Address
 * @property string $csdrlht_updatedon Date of update
 * @property int $csdrlht_updatedby Reference to usermst_tbl
 * @property string $csdrlht_updatedbyipaddr User IP Address
 *
 * @property CmstnchdrtempTbl $csdrlhtCmstnchdrtempFk
 * @property UsermstTbl $csdrlhtCreatedby
 * @property UsermstTbl $csdrlhtSdrlusermstFk
 * @property UsermstTbl $csdrlhtUpdatedby
 */
class CmssuppdocreqlisthdrtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlisthdrtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrlht_cmstnchdr_fk', 'csdrlht_shared_fk', 'csdrlht_shared_type', 'csdrlht_sdrlrefno', 'csdrlht_sdrldate', 'csdrlht_sdrlusermst_fk', 'csdrlht_status', 'csdrlht_createdon', 'csdrlht_createdby'], 'required'],
            [['csdrlht_cmstnchdr_fk', 'csdrlht_shared_fk', 'csdrlht_shared_type', 'csdrlht_sdrlusermst_fk', 'csdrlht_status', 'csdrlht_createdby', 'csdrlht_updatedby'], 'integer'],
            [['csdrlht_sdrldate', 'csdrlht_createdon', 'csdrlht_updatedon'], 'safe'],
            [['csdrlht_sdrlrefno', 'csdrlht_createdbyipaddr', 'csdrlht_updatedbyipaddr'], 'string', 'max' => 50],
            [['csdrlht_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['csdrlht_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['csdrlht_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlht_createdby' => 'UserMst_Pk']],
            [['csdrlht_sdrlusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlht_sdrlusermst_fk' => 'UserMst_Pk']],
            [['csdrlht_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlht_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlisthdrtemp_pk' => 'Cmssuppdocreqlisthdrtemp Pk',
            'csdrlht_cmstnchdr_fk' => 'Csdrlht Cmstnchdrtemp Fk',
            'csdrlht_shared_fk' => 'Csdrlht Shared Fk',
            'csdrlht_shared_type' => 'Csdrlht Shared Type',
            'csdrlht_sdrlrefno' => 'Csdrlht Sdrlrefno',
            'csdrlht_sdrldate' => 'Csdrlht Sdrldate',
            'csdrlht_sdrlusermst_fk' => 'Csdrlht Sdrlusermst Fk',
            'csdrlht_status' => 'Csdrlht Status',
            'csdrlht_createdon' => 'Csdrlht Createdon',
            'csdrlht_createdby' => 'Csdrlht Createdby',
            'csdrlht_createdbyipaddr' => 'Csdrlht Createdbyipaddr',
            'csdrlht_updatedon' => 'Csdrlht Updatedon',
            'csdrlht_updatedby' => 'Csdrlht Updatedby',
            'csdrlht_updatedbyipaddr' => 'Csdrlht Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhtCmstnchdrtempFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'csdrlht_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlistdtlstempTbls()
    {
        return $this->hasMany(CmssuppdocreqlistdtlstempTbl::className(), ['csdrldt_cmssuppdocreqlisthdrtemp_fk' => 'cmssuppdocreqlisthdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlht_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhtSdrlusermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlht_sdrlusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlht_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlisthdrtempTblQuery(get_called_class());
    }
}
