<?php

namespace api\modules\pms\models;

use common\models\UsermstTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use Yii;

/**
 * This is the model class for table "cmssupdocumenttemp_tbl".
 *
 * @property int $cmssupdocumenttemp_pk Primary key
 * @property int $cmssdt_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $cmssdt_type 1 - Requisition/ Tender/ Suppier Tender (crfd_type is 2, 3 ), 2 - Permit & Procedure, 3 - Supporting Document for Enquiry (RFI, EOI, PQ, etc,.), 6 - Additional Document (RFQ), 7 - Contract Supporting Document (Online, Offline, Direct, Single), 8 - Contract Offline -->Upload Contract Document: RFQ, 9 - Contract Offline -->Upload Contract Document: Quotation, 10 - Contract Offline -->Upload Contract Document: Evaluation Sheet (TBT, CBT), 11 - Contract Offline -->Upload Contract Document: Contract, 12 - Contract Direct --> Scope: Price Reference Document, 13 - Contract Offline -->Upload Contract Document: Others, 14 - Quotation Supporting Document
 * @property string $cmssdt_docname Name of the Document/ Attachment Link/ for contract Offline type = 13 (others) then Others title
 * @property string $cmssdt_closedate Attachment Closing Date
 * @property string $cmssdt_upload Reference to memcompfiledtls_tbl
 * @property int $cmssdt_status 1 - Active, 2 - Inactive
 * @property string $cmssdt_createdon Date of creation
 * @property int $cmssdt_createdby Reference to usermst_tbl
 * @property string $cmssdt_createdbyipaddr User IP Address
 * @property string $cmssdt_updatedon Date of update
 * @property int $cmssdt_updatedby Reference to usermst_tbl
 * @property string $cmssdt_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmssdtCreatedby
 * @property UsermstTbl $cmssdtUpdatedby
 * @property MemcompfiledtlsTbl $cmssdtUpload
 */
class CmssupdocumenttempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssupdocumenttemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmssdt_shared_fk', 'cmssdt_type', 'cmssdt_upload', 'cmssdt_status', 'cmssdt_createdon', 'cmssdt_createdby'], 'required'],
            [['cmssdt_shared_fk', 'cmssdt_type', 'cmssdt_upload', 'cmssdt_status', 'cmssdt_createdby', 'cmssdt_updatedby'], 'integer'],
            [['cmssdt_closedate', 'cmssdt_createdon', 'cmssdt_updatedon'], 'safe'],
            [['cmssdt_docname'], 'string', 'max' => 255],
            [['cmssdt_createdbyipaddr', 'cmssdt_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmssdt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssdt_createdby' => 'UserMst_Pk']],
            [['cmssdt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssdt_updatedby' => 'UserMst_Pk']],
            [['cmssdt_upload'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['cmssdt_upload' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssupdocumenttemp_pk' => 'Cmssupdocumenttemp Pk',
            'cmssdt_shared_fk' => 'Cmssdt Shared Fk',
            'cmssdt_type' => 'Cmssdt Type',
            'cmssdt_docname' => 'Cmssdt Docname',
            'cmssdt_closedate' => 'Cmssdt Closedate',
            'cmssdt_upload' => 'Cmssdt Upload',
            'cmssdt_status' => 'Cmssdt Status',
            'cmssdt_createdon' => 'Cmssdt Createdon',
            'cmssdt_createdby' => 'Cmssdt Createdby',
            'cmssdt_createdbyipaddr' => 'Cmssdt Createdbyipaddr',
            'cmssdt_updatedon' => 'Cmssdt Updatedon',
            'cmssdt_updatedby' => 'Cmssdt Updatedby',
            'cmssdt_updatedbyipaddr' => 'Cmssdt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssdt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssdt_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdtUpload()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'cmssdt_upload']);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumenttempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssupdocumenttempTblQuery(get_called_class());
    }
}
