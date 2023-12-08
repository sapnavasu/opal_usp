<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmsinspreqdochdrtemp_tbl".
 *
 * @property int $cmsinspreqdochdrtemp_pk Primary key
 * @property int $cirdht_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $cirdht_shared_fk Reference to cmsrequisitionformdtls_tbl, cmstenderhdrtemp_tbl, cmscontracthdr_tbl
 * @property int $cirdht_shared_type 1 - Requisition/ Tender Notice, 2 - Enquiry (RFP, RFQ) 3 - Contract/ Purchase Order
 * @property string $cirdht_itprefno Inspection Test Plan (ITP) Reference No
 * @property string $cirdht_itpdate ITP Date
 * @property int $cirdht_itpusermst_fk ITP Issued By: Reference to usermst_tbl
 * @property string $cirdht_technote Technical Notes
 * @property string $cirdht_generalnote General Notes
 * @property string $cirdht_applspec Applicable Specifications
 * @property int $cirdht_status 1 - Active, 2 - Inactive
 * @property string $cirdht_createdon Date of creation
 * @property int $cirdht_createdby Reference to usermst_tbl
 * @property string $cirdht_createdbyipaddr User IP Address
 * @property string $cirdht_updatedon Date of update
 * @property int $cirdht_updatedby Reference to usermst_tbl
 * @property string $cirdht_updatedbyipaddr User IP Address
 *
 * @property CmsinspreqdocdtlstempTbl[] $cmsinspreqdocdtlstempTbls
 * @property CmstnchdrTbl $cirdhtCmstnchdrFk
 * @property UsermstTbl $cirdhtCreatedby
 * @property UsermstTbl $cirdhtItpusermstFk
 * @property UsermstTbl $cirdhtUpdatedby
 */
class CmsinspreqdochdrtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdochdrtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdht_cmstnchdr_fk', 'cirdht_shared_fk', 'cirdht_shared_type', 'cirdht_itprefno', 'cirdht_itpdate', 'cirdht_itpusermst_fk', 'cirdht_status', 'cirdht_createdon', 'cirdht_createdby'], 'required'],
            [['cirdht_cmstnchdr_fk', 'cirdht_shared_fk', 'cirdht_shared_type', 'cirdht_itpusermst_fk', 'cirdht_status', 'cirdht_createdby', 'cirdht_updatedby'], 'integer'],
            [['cirdht_itpdate', 'cirdht_createdon', 'cirdht_updatedon'], 'safe'],
            [['cirdht_technote', 'cirdht_generalnote', 'cirdht_applspec'], 'string'],
            [['cirdht_itprefno', 'cirdht_createdbyipaddr', 'cirdht_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirdht_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['cirdht_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['cirdht_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdht_createdby' => 'UserMst_Pk']],
            [['cirdht_itpusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdht_itpusermst_fk' => 'UserMst_Pk']],
            [['cirdht_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdht_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdochdrtemp_pk' => 'Cmsinspreqdochdrtemp Pk',
            'cirdht_cmstnchdr_fk' => 'Cirdht Cmstnchdr Fk',
            'cirdht_shared_fk' => 'Cirdht Shared Fk',
            'cirdht_shared_type' => 'Cirdht Shared Type',
            'cirdht_itprefno' => 'Cirdht Itprefno',
            'cirdht_itpdate' => 'Cirdht Itpdate',
            'cirdht_itpusermst_fk' => 'Cirdht Itpusermst Fk',
            'cirdht_technote' => 'Cirdht Technote',
            'cirdht_generalnote' => 'Cirdht Generalnote',
            'cirdht_applspec' => 'Cirdht Applspec',
            'cirdht_status' => 'Cirdht Status',
            'cirdht_createdon' => 'Cirdht Createdon',
            'cirdht_createdby' => 'Cirdht Createdby',
            'cirdht_createdbyipaddr' => 'Cirdht Createdbyipaddr',
            'cirdht_updatedon' => 'Cirdht Updatedon',
            'cirdht_updatedby' => 'Cirdht Updatedby',
            'cirdht_updatedbyipaddr' => 'Cirdht Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdht_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'cirdht_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdocdtlsTbls()
    {
        return $this->hasMany(CmsinspreqdocdtlstempTbl::className(), ['cirddt_cmsinspreqdochdrtemp_fk' => 'cmsinspreqdochdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdocdtlstempTbls()
    {
        return $this->hasMany(CmsinspreqdocdtlstempTbl::className(), ['cirddt_cmsinspreqdochdrtemp_fk' => 'cmsinspreqdochdrtemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhtCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'cirdht_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdht_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhtItpusermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdht_itpusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdht_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdochdrtempTblQuery(get_called_class());
    }
}
