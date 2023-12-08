<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the model class for table "cmstnctrnxhsty_tbl".
 *
 * @property int $cmstnctrnxhsty_pk Primary key
 * @property int $ctncth_cmstnctrnx_fk Reference to cmstnctrnx_tbl
 * @property int $ctncth_cmstnchdrhsty_fk Reference to cmstnchdrhsty_tbl
 * @property int $ctncth_shared_fk Reference to  cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $ctncth_type 1 -  Requisition/ Tender Notice, 2- Enquiry (RFI, EOI,etc,.) eTendering, 3 - Contract, 4 - Quotation
 * @property int $ctncth_cmstenderagreehdr_fk Reference to cmstenderagreehdr_tbl [Only Agreed Supplier Quotation Reference is mapped]
 * @property string $ctncth_title Title name
 * @property string $ctncth_content Content Area for Terms and Condition
 * @property string $ctncth_upload Reference to memcompfiledtls_tbl in comma separation
 * @property int $ctncth_status 1 - Active, 2 - Inactive
 * @property string $ctncth_createdon Date of creation
 * @property int $ctncth_createdby Reference to usermst_tbl
 * @property string $ctncth_createdbyipaddr User IP Address
 * @property string $ctncth_updatedon Date of update
 * @property int $ctncth_updatedby Reference to usermst_tbl
 * @property string $ctncth_updatedbyipaddr User IP Address
 *
 * @property CmstenderagreehdrTbl $ctncthCmstenderagreehdrFk
 * @property CmstnchdrhstyTbl $ctncthCmstnchdrhstyFk
 * @property UsermstTbl $ctncthCreatedby
 * @property UsermstTbl $ctncthUpdatedby
 */
class CmstnctrnxhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstnctrnxhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctncth_cmstnctrnx_fk', 'ctncth_cmstnchdr_fk', 'ctncth_shared_fk', 'ctncth_type', 'ctncth_status', 'ctncth_createdon', 'ctncth_createdby'], 'required'],
            [['ctncth_cmstnctrnx_fk', 'ctncth_cmstnchdr_fk', 'ctncth_shared_fk', 'ctncth_type', 'ctncth_cmstenderagreehdr_fk', 'ctncth_status', 'ctncth_createdby', 'ctncth_updatedby'], 'integer'],
            [['ctncth_title', 'ctncth_content', 'ctncth_upload'], 'string'],
            [['ctncth_createdon', 'ctncth_updatedon'], 'safe'],
            [['ctncth_createdbyipaddr', 'ctncth_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctncth_cmstenderagreehdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderagreehdrTbl::className(), 'targetAttribute' => ['ctncth_cmstenderagreehdr_fk' => 'cmstenderagreehdr_pk']],
            [['ctncth_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['ctncth_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['ctncth_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctncth_createdby' => 'UserMst_Pk']],
            [['ctncth_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctncth_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstnctrnxhsty_pk' => 'Cmstnctrnxhsty Pk',
            'ctncth_cmstnctrnx_fk' => 'Ctncth Cmstnctrnx Fk',
            'ctncth_cmstnchdr_fk' => 'Ctncth Cmstnchdrhsty Fk',
            'ctncth_shared_fk' => 'Ctncth Shared Fk',
            'ctncth_type' => 'Ctncth Type',
            'ctncth_cmstenderagreehdr_fk' => 'Ctncth Cmstenderagreehdr Fk',
            'ctncth_title' => 'Ctncth Title',
            'ctncth_content' => 'Ctncth Content',
            'ctncth_upload' => 'Ctncth Upload',
            'ctncth_status' => 'Ctncth Status',
            'ctncth_createdon' => 'Ctncth Createdon',
            'ctncth_createdby' => 'Ctncth Createdby',
            'ctncth_createdbyipaddr' => 'Ctncth Createdbyipaddr',
            'ctncth_updatedon' => 'Ctncth Updatedon',
            'ctncth_updatedby' => 'Ctncth Updatedby',
            'ctncth_updatedbyipaddr' => 'Ctncth Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncthCmstenderagreehdrFk()
    {
        return $this->hasOne(CmstenderagreehdrTbl::className(), ['cmstenderagreehdr_pk' => 'ctncth_cmstenderagreehdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncthCmstnchdrhstyFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'ctncth_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncthCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctncth_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtncthUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctncth_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstnctrnxhstyTblQuery(get_called_class());
    }
}
