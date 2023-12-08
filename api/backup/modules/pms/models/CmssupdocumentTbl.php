<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;
use Yii;

/**
 * This is the model class for table "cmssupdocument_tbl".
 *
 * @property int $cmssupdocument_pk Primary key
 * @property int $cmssd_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $cmssd_type 1 - Requisition, 2 - Permit & Procedure, 3 - RFI Supporting Document, 4 - EOI Supporting Document, 5 - PQ Supporting Document, 6 - RFI Additional Document, 7 - Contract Supporting Document (Online, Offline, Direct, Single), 8 - Contract Offline -->Upload Contract Document: RFQ, 9 - Contract Offline -->Upload Contract Document: Quotation, 10 - Contract Offline -->Upload Contract Document: Evaluation Sheet (TBT, CBT), 11 - Contract Offline -->Upload Contract Document: Contract, 12 - Contract Direct --> Scope: Price Reference Document, 13 - Contract Offline -->Upload Contract Document: Others
 * @property string $cmssd_docname Name of the Document/ Attachment Link/ for contract Offline type = 13 (others) then Others title
 * @property string $cmssd_closedate Attachment Closing Date
 * @property string $cmssd_upload Reference to memcompfiledtls_tbl
 * @property int $cmssd_status 1 - Active, 2 - Inactive
 * @property string $cmssd_createdon Date of creation
 * @property int $cmssd_createdby Reference to usermst_tbl
 * @property string $cmssd_createdbyipaddr User IP Address
 * @property string $cmssd_updatedon Date of update
 * @property int $cmssd_updatedby Reference to usermst_tbl
 * @property string $cmssd_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmssdCreatedby
 * @property UsermstTbl $cmssdUpdatedby
 * @property MemcompfiledtlsTbl $cmssdUpload
 */
class CmssupdocumentTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssupdocument_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmssd_shared_fk', 'cmssd_type', 'cmssd_upload', 'cmssd_status', 'cmssd_createdon', 'cmssd_createdby'], 'required'],
            [['cmssd_shared_fk', 'cmssd_type', 'cmssd_upload', 'cmssd_status', 'cmssd_createdby', 'cmssd_updatedby'], 'integer'],
            [['cmssd_closedate', 'cmssd_createdon', 'cmssd_updatedon'], 'safe'],
            [['cmssd_docname'], 'string', 'max' => 255],
            [['cmssd_createdbyipaddr', 'cmssd_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmssd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssd_createdby' => 'UserMst_Pk']],
            [['cmssd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmssd_updatedby' => 'UserMst_Pk']],
            [['cmssd_upload'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['cmssd_upload' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssupdocument_pk' => 'Cmssupdocument Pk',
            'cmssd_shared_fk' => 'Cmssd Shared Fk',
            'cmssd_type' => 'Cmssd Type',
            'cmssd_docname' => 'Cmssd Docname',
            'cmssd_closedate' => 'Cmssd Closedate',
            'cmssd_upload' => 'Cmssd Upload',
            'cmssd_status' => 'Cmssd Status',
            'cmssd_createdon' => 'Cmssd Createdon',
            'cmssd_createdby' => 'Cmssd Createdby',
            'cmssd_createdbyipaddr' => 'Cmssd Createdbyipaddr',
            'cmssd_updatedon' => 'Cmssd Updatedon',
            'cmssd_updatedby' => 'Cmssd Updatedby',
            'cmssd_updatedbyipaddr' => 'Cmssd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmssd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmssdUpload()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'cmssd_upload']);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumentTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssupdocumentTblQuery(get_called_class());
    }
}
