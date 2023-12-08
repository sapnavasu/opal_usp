<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;
use api\modules\drv\models\MemcompfiledtlsTbl;

/**
 * This is the model class for table "cmstnctrnx_tbl".
 *
 * @property int $cmstnctrnx_pk Primary key
 * @property int $ctnct_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $ctnct_shared_fk Reference to  cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $ctnct_type 1 -  Requisition/ Tender Notice, 2- eTendering, 3 - Contract, 4 - Quotation
 * @property string $ctnct_title Title name
 * @property string $ctnct_content Content Area for Terms and Condition
 * @property string $ctnct_upload Reference to memcompfiledtls_tbl in comma separation
 * @property int $ctnct_status 1 - Active, 2 - Inactive
 * @property string $ctnct_createdon Date of creation
 * @property int $ctnct_createdby Reference to usermst_tbl
 * @property string $ctnct_createdbyipaddr User IP Address
 * @property string $ctnct_updatedon Date of update
 * @property int $ctnct_updatedby Reference to usermst_tbl
 * @property string $ctnct_updatedbyipaddr User IP Address
 *
 * @property CmstenderagreehdrTbl[] $cmstenderagreehdrTbls
 * @property CmstnchdrTbl $ctnctCmstnchdrFk
 * @property UsermstTbl $ctnctCreatedby
 * @property UsermstTbl $ctnctUpdatedby
 */
class CmstnctrnxTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstnctrnx_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctnct_cmstnchdr_fk', 'ctnct_shared_fk', 'ctnct_type', 'ctnct_status', 'ctnct_createdon', 'ctnct_createdby'], 'required'],
            [['ctnct_cmstnchdr_fk', 'ctnct_shared_fk', 'ctnct_type', 'ctnct_status', 'ctnct_createdby', 'ctnct_updatedby'], 'integer'],
            [['ctnct_title', 'ctnct_content', 'ctnct_upload'], 'string'],
            [['ctnct_createdon', 'ctnct_updatedon'], 'safe'],
            [['ctnct_createdbyipaddr', 'ctnct_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctnct_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['ctnct_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['ctnct_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnct_createdby' => 'UserMst_Pk']],
            [['ctnct_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnct_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstnctrnx_pk' => 'Cmstnctrnx Pk',
            'ctnct_cmstnchdr_fk' => 'Ctnct Cmstnchdr Fk',
            'ctnct_shared_fk' => 'Ctnct Shared Fk',
            'ctnct_type' => 'Ctnct Type',
            'ctnct_title' => 'Ctnct Title',
            'ctnct_content' => 'Ctnct Content',
            'ctnct_upload' => 'Ctnct Upload',
            'ctnct_status' => 'Ctnct Status',
            'ctnct_createdon' => 'Ctnct Createdon',
            'ctnct_createdby' => 'Ctnct Createdby',
            'ctnct_createdbyipaddr' => 'Ctnct Createdbyipaddr',
            'ctnct_updatedon' => 'Ctnct Updatedon',
            'ctnct_updatedby' => 'Ctnct Updatedby',
            'ctnct_updatedbyipaddr' => 'Ctnct Updatedbyipaddr',
        ];
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
    public function getCtnctCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'ctnct_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnctCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnct_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnctUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnct_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstnctrnxTblQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnctUploads()
    {
        return MemcompfiledtlsTbl::findAll(explode(',', $this->attributes['ctnct_upload']));
    }
}
