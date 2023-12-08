<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use common\models\IncorpstylemstTbl;
use Yii;

/**
 * This is the model class for table "cmsnonjsrssupmap_tbl".
 *
 * @property int $cmsnonjsrssupmap_pk Primary key
 * @property int $cnjsm_cmsnonjsrssupdtls_fk Reference to cmsnonjsrssupdtls_tbl
 * @property string $cnjsm_orgname Name of the organization
 * @property string $cnjsm_reason Reason for awarding to NON JSRS Supplier
 * @property string $cnjsm_compemail company email
 * @property string $cnjsm_contperson contact person name
 * @property string $cnjsm_designation designation
 * @property string $cnjsm_contactemail contact email
 * @property string $cnjsm_contactmobilecc contact mobile CC
 * @property string $cnjsm_contactmobile contact mobile number
 * @property string $cnjsm_address Address
 * @property int $cnjsm_classification Classification: 1 - MSME-Micro, 2 - MSME-Small, 3 - MSME-Medium, 4 - Large, 5 - International
 * @property string $cnjsm_specialstatus Special Status
 * @property int $cnjsm_incorpstylemst_fk for National Company insert the references to incorpstylemst_tbl.incorpstylemst_pk
 * @property string $cnjsm_incorpstyle for International company store the incorporation style in varchar format
 * @property string $cnjsm_createdon Date of creation
 * @property int $cnjsm_createdby Reference to usermst_tbl
 * @property string $cnjsm_createdbyipaddr User IP Address
 *
 * @property CmsawarddtlsTbl[] $cmsawarddtlsTbls
 * @property CmsnonjsrssupdtlsTbl $cnjsmCmsnonjsrssupdtlsFk
 * @property UsermstTbl $cnjsmCreatedby
 * @property IncorpstylemstTbl $cnjsmIncorpstylemstFk
 */
class CmsnonjsrssupmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsnonjsrssupmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_orgname'], 'required'],
            [['cnjsm_cmsnonjsrssupdtls_fk', 'cnjsm_classification', 'cnjsm_incorpstylemst_fk', 'cnjsm_createdby'], 'integer'],
            [['cnjsm_reason', 'cnjsm_address'], 'string'],
            [['cnjsm_createdon'], 'safe'],
            [['cnjsm_orgname'], 'string', 'max' => 250],
            [['cnjsm_compemail'], 'string', 'max' => 255],
            [['cnjsm_contperson', 'cnjsm_designation', 'cnjsm_incorpstyle'], 'string', 'max' => 100],
            [['cnjsm_contactemail', 'cnjsm_specialstatus'], 'string', 'max' => 45],
            [['cnjsm_contactmobilecc'], 'string', 'max' => 5],
            [['cnjsm_contactmobile'], 'string', 'max' => 20],
            [['cnjsm_createdbyipaddr'], 'string', 'max' => 50],
            [['cnjsm_cmsnonjsrssupdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsnonjsrssupdtlsTbl::className(), 'targetAttribute' => ['cnjsm_cmsnonjsrssupdtls_fk' => 'cmsnonjsrssupdtls_pk']],
            [['cnjsm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cnjsm_createdby' => 'UserMst_Pk']],
            [['cnjsm_incorpstylemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IncorpstylemstTbl::className(), 'targetAttribute' => ['cnjsm_incorpstylemst_fk' => 'IncorpStyleMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsnonjsrssupmap_pk' => 'Cmsnonjsrssupmap Pk',
            'cnjsm_cmsnonjsrssupdtls_fk' => 'Cnjsm Cmsnonjsrssupdtls Fk',
            'cnjsm_orgname' => 'Cnjsm Orgname',
            'cnjsm_reason' => 'Cnjsm Reason',
            'cnjsm_compemail' => 'Cnjsm Compemail',
            'cnjsm_contperson' => 'Cnjsm Contperson',
            'cnjsm_designation' => 'Cnjsm Designation',
            'cnjsm_contactemail' => 'Cnjsm Contactemail',
            'cnjsm_contactmobilecc' => 'Cnjsm Contactmobilecc',
            'cnjsm_contactmobile' => 'Cnjsm Contactmobile',
            'cnjsm_address' => 'Cnjsm Address',
            'cnjsm_classification' => 'Cnjsm Classification',
            'cnjsm_specialstatus' => 'Cnjsm Specialstatus',
            'cnjsm_incorpstylemst_fk' => 'Cnjsm Incorpstylemst Fk',
            'cnjsm_incorpstyle' => 'Cnjsm Incorpstyle',
            'cnjsm_createdon' => 'Cnjsm Createdon',
            'cnjsm_createdby' => 'Cnjsm Createdby',
            'cnjsm_createdbyipaddr' => 'Cnjsm Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsawarddtlsTbls()
    {
        return $this->hasMany(CmsawarddtlsTbl::className(), ['cmsad_cmsnonjsrssupmap_fk' => 'cmsnonjsrssupmap_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnjsmCmsnonjsrssupdtlsFk()
    {
        return $this->hasOne(CmsnonjsrssupdtlsTbl::className(), ['cmsnonjsrssupdtls_pk' => 'cnjsm_cmsnonjsrssupdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnjsmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cnjsm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCnjsmIncorpstylemstFk()
    {
        return $this->hasOne(IncorpstylemstTbl::className(), ['IncorpStyleMst_Pk' => 'cnjsm_incorpstylemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsnonjsrssupmapTblQuery(get_called_class());
    }
}
