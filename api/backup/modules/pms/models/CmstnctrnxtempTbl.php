<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the model class for table "cmstnctrnxtemp_tbl".
 *
 * @property int $cmstnctrnxtemp_pk Primary key
 * @property int $ctnctt_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $ctnctt_shared_fk Reference to  cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $ctnctt_type 1 -  Requisition/ Tender Notice, 2- Enquiry (RFI, EOI,etc,.) eTendering, 3 - Contract, 4 - Quotation
 * @property int $ctnctt_cmstenderagreehdr_fk Reference to cmstenderagreehdr_tbl [Only Agreed Supplier Quotation Reference is mapped]
 * @property string $ctnctt_title Title name
 * @property string $ctnctt_content Content Area for Terms and Condition
 * @property string $ctnctt_upload Reference to memcompfiledtls_tbl in comma separation
 * @property int $ctnctt_status 1 - Active, 2 - Inactive
 * @property string $ctnctt_createdon Date of creation
 * @property int $ctnctt_createdby Reference to usermst_tbl
 * @property string $ctnctt_createdbyipaddr User IP Address
 * @property string $ctnctt_updatedon Date of update
 * @property int $ctnctt_updatedby Reference to usermst_tbl
 * @property string $ctnctt_updatedbyipaddr User IP Address
 *
 * @property CmstenderagreehdrTbl $ctncttCmstenderagreehdrFk
 * @property CmstnchdrTbl $ctncttCmstnchdrFk
 * @property UsermstTbl $ctncttCreatedby
 * @property UsermstTbl $ctncttUpdatedby
 */
class CmstnctrnxtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstnctrnxtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctnctt_cmstnchdr_fk', 'ctnctt_shared_fk', 'ctnctt_type', 'ctnctt_status', 'ctnctt_createdon', 'ctnctt_createdby'], 'required'],
            [['ctnctt_cmstnchdr_fk', 'ctnctt_shared_fk', 'ctnctt_type', 'ctnctt_cmstenderagreehdr_fk', 'ctnctt_status', 'ctnctt_createdby', 'ctnctt_updatedby'], 'integer'],
            [['ctnctt_title', 'ctnctt_content', 'ctnctt_upload'], 'string'],
            [['ctnctt_createdon', 'ctnctt_updatedon'], 'safe'],
            [['ctnctt_createdbyipaddr', 'ctnctt_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctnctt_cmstenderagreehdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderagreehdrTbl::className(), 'targetAttribute' => ['ctnctt_cmstenderagreehdr_fk' => 'cmstenderagreehdr_pk']],
            [['ctnctt_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['ctnctt_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['ctnctt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnctt_createdby' => 'UserMst_Pk']],
            [['ctnctt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnctt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstnctrnxtemp_pk' => 'Cmstnctrnxtemp Pk',
            'ctnctt_cmstnchdr_fk' => 'Ctnctt Cmstnchdr Fk',
            'ctnctt_shared_fk' => 'Ctnctt Shared Fk',
            'ctnctt_type' => 'Ctnctt Type',
            'ctnctt_cmstenderagreehdr_fk' => 'Ctnctt Cmstenderagreehdr Fk',
            'ctnctt_title' => 'Ctnctt Title',
            'ctnctt_content' => 'Ctnctt Content',
            'ctnctt_upload' => 'Ctnctt Upload',
            'ctnctt_status' => 'Ctnctt Status',
            'ctnctt_createdon' => 'Ctnctt Createdon',
            'ctnctt_createdby' => 'Ctnctt Createdby',
            'ctnctt_createdbyipaddr' => 'Ctnctt Createdbyipaddr',
            'ctnctt_updatedon' => 'Ctnctt Updatedon',
            'ctnctt_updatedby' => 'Ctnctt Updatedby',
            'ctnctt_updatedbyipaddr' => 'Ctnctt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncttCmstenderagreehdrFk()
    {
        return $this->hasOne(CmstenderagreehdrTbl::className(), ['cmstenderagreehdr_pk' => 'ctnctt_cmstenderagreehdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncttCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'ctnctt_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncttCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnctt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncttUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnctt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstnctrnxtempTblQuery(get_called_class());
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderagreehdrTbls()
    {
        return $this->hasMany(CmstenderagreehdrTbl::className(), ['ctah_cmstnctrnx_fk' => 'cmstnctrnx_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnctCmsttnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'ctnctt_cmstnchdr_fk']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncttUploads()
    {
        return MemcompfiledtlsTbl::findAll(explode(',', $this->attributes['ctnctt_upload']));
    }
}
