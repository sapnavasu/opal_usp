<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmsinspreqdochdr_tbl".
 *
 * @property int $cmsinspreqdochdr_pk Primary key
 * @property int $cirdh_cmstnchdr_fk Reference to cmstnchdr_tbl
 * @property int $cirdh_shared_fk Reference to cmsrequisitionformdtls_tbl, cmscontracthdr_tbl
 * @property int $cirdh_shared_type 1 - Requisition/ Tender Notice, 3 - Contract/ Purchase Order
 * @property string $cirdh_itprefno Inspection Test Plan (ITP) Reference No
 * @property string $cirdh_itpdate ITP Date
 * @property int $cirdh_itpusermst_fk ITP Issued By: Reference to usermst_tbl
 * @property string $cirdh_technote Technical Notes
 * @property string $cirdh_generalnote General Notes
 * @property string $cirdh_applspec Applicable Specifications
 * @property int $cirdh_status 1 - Active, 2 - Inactive
 * @property string $cirdh_createdon Date of creation
 * @property int $cirdh_createdby Reference to usermst_tbl
 * @property string $cirdh_createdbyipaddr User IP Address
 * @property string $cirdh_updatedon Date of update
 * @property int $cirdh_updatedby Reference to usermst_tbl
 * @property string $cirdh_updatedbyipaddr User IP Address
 *
 * @property CmsinspreqdocdtlsTbl[] $cmsinspreqdocdtlsTbls
 * @property CmstnchdrTbl $cirdhCmstnchdrFk
 * @property UsermstTbl $cirdhCreatedby
 * @property UsermstTbl $cirdhItpusermstFk
 * @property UsermstTbl $cirdhUpdatedby
 */
class CmsinspreqdochdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdochdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdh_cmstnchdr_fk', 'cirdh_shared_fk', 'cirdh_shared_type', 'cirdh_itprefno', 'cirdh_itpdate', 'cirdh_itpusermst_fk', 'cirdh_status', 'cirdh_createdon', 'cirdh_createdby'], 'required'],
            [['cirdh_cmstnchdr_fk', 'cirdh_shared_fk', 'cirdh_shared_type', 'cirdh_itpusermst_fk', 'cirdh_status', 'cirdh_createdby', 'cirdh_updatedby'], 'integer'],
            [['cirdh_itpdate', 'cirdh_createdon', 'cirdh_updatedon'], 'safe'],
            [['cirdh_technote', 'cirdh_generalnote', 'cirdh_applspec'], 'string'],
            [['cirdh_itprefno', 'cirdh_createdbyipaddr', 'cirdh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirdh_cmstnchdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstnchdrTbl::className(), 'targetAttribute' => ['cirdh_cmstnchdr_fk' => 'cmstnchdr_pk']],
            [['cirdh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdh_createdby' => 'UserMst_Pk']],
            [['cirdh_itpusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdh_itpusermst_fk' => 'UserMst_Pk']],
            [['cirdh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdochdr_pk' => 'Cmsinspreqdochdr Pk',
            'cirdh_cmstnchdr_fk' => 'Cirdh Cmstnchdr Fk',
            'cirdh_shared_fk' => 'Cirdh Shared Fk',
            'cirdh_shared_type' => 'Cirdh Shared Type',
            'cirdh_itprefno' => 'Cirdh Itprefno',
            'cirdh_itpdate' => 'Cirdh Itpdate',
            'cirdh_itpusermst_fk' => 'Cirdh Itpusermst Fk',
            'cirdh_technote' => 'Cirdh Technote',
            'cirdh_generalnote' => 'Cirdh Generalnote',
            'cirdh_applspec' => 'Cirdh Applspec',
            'cirdh_status' => 'Cirdh Status',
            'cirdh_createdon' => 'Cirdh Createdon',
            'cirdh_createdby' => 'Cirdh Createdby',
            'cirdh_createdbyipaddr' => 'Cirdh Createdbyipaddr',
            'cirdh_updatedon' => 'Cirdh Updatedon',
            'cirdh_updatedby' => 'Cirdh Updatedby',
            'cirdh_updatedbyipaddr' => 'Cirdh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdocdtlsTbls()
    {
        return $this->hasMany(CmsinspreqdocdtlsTbl::className(), ['cirdd_cmsinspreqdochdr_fk' => 'cmsinspreqdochdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhCmstnchdrFk()
    {
        return $this->hasOne(CmstnchdrTbl::className(), ['cmstnchdr_pk' => 'cirdh_cmstnchdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhItpusermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdh_itpusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdochdrTblQuery(get_called_class());
    }
}
