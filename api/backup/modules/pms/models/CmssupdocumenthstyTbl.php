<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the model class for table "cmssupdocumenthsty_tbl".
 *
 * @property int $cmssupdocumenthsty_pk Primary key
 * @property int $cmssdh_cmssupdocument_fk Reference to cmssupdocument_tbl.cmssupdocument_pk
 * @property int $cmssdh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $cmssdh_type 1 - Requisition/ Tender/ Suppier Tender (crfd_type is 2, 3 ), 2 - Permit & Procedure, 3 - Supporting Document for Enquiry (RFI, EOI, PQ, etc,.), 6 - Additional Document (RFQ), 7 - Contract Supporting Document (Online, Offline, Direct, Single), 8 - Contract Offline -->Upload Contract Document: RFQ, 9 - Contract Offline -->Upload Contract Document: Quotation, 10 - Contract Offline -->Upload Contract Document: Evaluation Sheet (TBT, CBT), 11 - Contract Offline -->Upload Contract Document: Contract, 12 - Contract Direct --> Scope: Price Reference Document, 13 - Contract Offline -->Upload Contract Document: Others, 14 - Quotation Supporting Document
 * @property string $cmssdh_docname Name of the Document/ Attachment Link/ for contract Offline type = 13 (others) then Others title
 * @property string $cmssdh_closedate Attachment Closing Date
 * @property string $cmssdh_upload Reference to memcompfiledtls_tbl
 * @property int $cmssdh_status 1 - Active, 2 - Inactive
 * @property string $cmssdh_createdon Date of creation
 * @property int $cmssdh_createdby Reference to usermst_tbl
 * @property string $cmssdh_createdbyipaddr User IP Address
 * @property string $cmssdh_updatedon Date of update
 * @property int $cmssdh_updatedby Reference to usermst_tbl
 * @property string $cmssdh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmssdhCreatedby
 * @property UsermstTbl $cmssdhUpdatedby
 * @property MemcompfiledtlsTbl $cmssdhUpload
 */
class CmssupdocumenthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssupdocumenthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmssdh_cmssupdocument_fk', 'cmssdh_shared_fk', 'cmssdh_type', 'cmssdh_upload', 'cmssdh_status', 'cmssdh_createdon', 'cmssdh_createdby'], 'required'],
            [['cmssdh_cmssupdocument_fk', 'cmssdh_shared_fk', 'cmssdh_type', 'cmssdh_upload', 'cmssdh_status', 'cmssdh_createdby', 'cmssdh_updatedby'], 'integer'],
            [['cmssdh_closedate', 'cmssdh_createdon', 'cmssdh_updatedon'], 'safe'],
            [['cmssdh_docname'], 'string', 'max' => 255],
            [['cmssdh_createdbyipaddr', 'cmssdh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmssdh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssdh_createdby' => 'UserMst_Pk']],
            [['cmssdh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssdh_updatedby' => 'UserMst_Pk']],
            [['cmssdh_upload'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['cmssdh_upload' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssupdocumenthsty_pk' => 'Cmssupdocumenthsty Pk',
            'cmssdh_cmssupdocument_fk' => 'Cmssdh Cmssupdocument Fk',
            'cmssdh_shared_fk' => 'Cmssdh Shared Fk',
            'cmssdh_type' => 'Cmssdh Type',
            'cmssdh_docname' => 'Cmssdh Docname',
            'cmssdh_closedate' => 'Cmssdh Closedate',
            'cmssdh_upload' => 'Cmssdh Upload',
            'cmssdh_status' => 'Cmssdh Status',
            'cmssdh_createdon' => 'Cmssdh Createdon',
            'cmssdh_createdby' => 'Cmssdh Createdby',
            'cmssdh_createdbyipaddr' => 'Cmssdh Createdbyipaddr',
            'cmssdh_updatedon' => 'Cmssdh Updatedon',
            'cmssdh_updatedby' => 'Cmssdh Updatedby',
            'cmssdh_updatedbyipaddr' => 'Cmssdh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssdh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssdh_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdhUpload()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'cmssdh_upload']);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumenthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssupdocumenthstyTblQuery(get_called_class());
    }
}
