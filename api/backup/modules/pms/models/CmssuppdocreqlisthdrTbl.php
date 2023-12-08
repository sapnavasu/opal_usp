<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmssuppdocreqlisthdr_tbl".
 *
 * @property int $cmssuppdocreqlisthdr_pk Primary key
 * @property int $csdrlh_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $csdrlh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmscontracthdr_tbl
 * @property int $csdrlh_shared_type 1 - Requisition/ Tender Notice, 3 - Contract/ Purchase Order
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
 *
 * @property CmssuppdocreqlistdtlsTbl[] $cmssuppdocreqlistdtlsTbls
 * @property CmstnchdrTbl $csdrlhCmstnchdrFk
 * @property UsermstTbl $csdrlhCreatedby
 * @property UsermstTbl $csdrlhSdrlusermstFk
 * @property UsermstTbl $csdrlhUpdatedby
 */
class CmssuppdocreqlisthdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlisthdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrlh_cmstnchdr_fk', 'csdrlh_shared_fk', 'csdrlh_shared_type', 'csdrlh_sdrlrefno', 'csdrlh_sdrldate', 'csdrlh_sdrlusermst_fk', 'csdrlh_status', 'csdrlh_createdon', 'csdrlh_createdby'], 'required'],
            [['csdrlh_cmstnchdr_fk', 'csdrlh_shared_fk', 'csdrlh_shared_type', 'csdrlh_sdrlusermst_fk', 'csdrlh_status', 'csdrlh_createdby', 'csdrlh_updatedby'], 'integer'],
            [['csdrlh_sdrldate', 'csdrlh_createdon', 'csdrlh_updatedon'], 'safe'],
            [['csdrlh_sdrlrefno', 'csdrlh_createdbyipaddr', 'csdrlh_updatedbyipaddr'], 'string', 'max' => 50],
            [['csdrlh_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['csdrlh_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['csdrlh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlh_createdby' => 'UserMst_Pk']],
            [['csdrlh_sdrlusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlh_sdrlusermst_fk' => 'UserMst_Pk']],
            [['csdrlh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrlh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlisthdr_pk' => 'Cmssuppdocreqlisthdr Pk',
            'csdrlh_cmstnchdr_fk' => 'Csdrlh Cmstnchdr Fk',
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
     * @return \yii\db\ActiveQuery
     */
    public function getCmssuppdocreqlistdtlsTbls()
    {
        return $this->hasMany(CmssuppdocreqlistdtlsTbl::className(), ['csdrld_cmssuppdocreqlisthdr_fk' => 'cmssuppdocreqlisthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'csdrlh_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhSdrlusermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlh_sdrlusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrlhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrlh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlisthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlisthdrTblQuery(get_called_class());
    }
}
