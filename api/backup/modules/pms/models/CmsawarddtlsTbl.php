<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTbl;
use common\models\PdocategorymstTbl;
use Yii;

/**
 * This is the model class for table "cmsawarddtls_tbl".
 *
 * @property int $cmsawarddtls_pk Primary key
 * @property int $cmsad_cmscontracthdr_fk Reference to cmscontracthdr_tbl
 * @property int $cmsad_isdeviated 1 - Yes, 2 - No
 * @property int $cmsad_contractorcategory Applicable only for deviated: 1 - Supplier, 2 - Operator, 3 - Government Entity,  4 - Individual. Default 1.
 * @property int $cmsad_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsad_jsrssplstatus JSRS Special Status: 1 - CCED, 2 - DUQM, 3 - OXY, 4 - PDO
 * @property int $cmsad_pdocategorymst_fk Captures here when pdo awards :Reference to pdocategorymst_tbl
 * @property int $cmsad_classification Classification: 1 - MSME-Micro, 2 - MSME-Small, 3 - MSME-Medium, 4 - Large, 5 - International
 * @property int $cmsad_cmsnonjsrssupmap_fk Reference to cmsnonjsrssupmap_tbl
 * @property string $cmsad_nonjsrssplstatus Special Status of the awardee (Non-JSRS Supplier) as collected from the Awarder (Operator/Buyer)
 * @property string $cmsad_awardedon Awarded on
 * @property int $cmsad_isprimarycontractor Is Primary Contractor Default 0: 1 - Yes, 0 - No
 * @property string $cmsad_awardamt Award Amount from cmscontracthdr_tbl --> cmsch_contractvalue (Targetted Amount)
 * @property string $cmsad_awardcert
 * @property string $cmsad_itemwise Reference to eTender end pk in comma separation.
 * @property int $cmsad_appraisalcount
 * @property string $cmsad_avgappraisal
 * @property int $cmsad_ismaincontractor Is main Contractor Default 0: 1 - Yes, 0 - No
 * @property string $cmsad_justifydocupload
 * @property string $cmsad_justifycomment
 * @property int $cmsad_isdeactivated Is deactivated Default 0: 1 - Yes, 0 - No
 * @property string $cmsad_createdon Date of creation
 * @property int $cmsad_createdby Reference to usermst_tbl
 * @property string $cmsad_createdbyipaddr User IP Address
 * @property string $cmsad_updatedon Date of update
 * @property int $cmsad_updatedby Reference to usermst_tbl
 * @property string $cmsad_updatedbyipaddr User IP Address
 *
 * @property CmscontracthdrTbl $cmsadCmscontracthdrFk
 * @property CmsnonjsrssupmapTbl $cmsadCmsnonjsrssupmapFk
 * @property UsermstTbl $cmsadCreatedby
 * @property MembercompanymstTbl $cmsadMemcompmstFk
 * @property PdocategorymstTbl $cmsadPdocategorymstFk
 * @property UsermstTbl $cmsadUpdatedby
 * @property CmsawardhstyTbl[] $cmsawardhstyTbls
 */
class CmsawarddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsawarddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsad_cmscontracthdr_fk', 'cmsad_createdon', 'cmsad_createdby', 'cmsad_createdbyipaddr'], 'required'],
            [['cmsad_cmscontracthdr_fk', 'cmsad_isdeviated', 'cmsad_contractorcategory', 'cmsad_memcompmst_fk', 'cmsad_jsrssplstatus', 'cmsad_pdocategorymst_fk', 'cmsad_classification', 'cmsad_cmsnonjsrssupmap_fk', 'cmsad_isprimarycontractor', 'cmsad_appraisalcount', 'cmsad_ismaincontractor', 'cmsad_isdeactivated', 'cmsad_createdby', 'cmsad_updatedby'], 'integer'],
            [['cmsad_awardedon', 'cmsad_createdon', 'cmsad_updatedon'], 'safe'],
            [['cmsad_awardamt'], 'number'],
            [['cmsad_itemwise', 'cmsad_justifycomment'], 'string'],
            [['cmsad_nonjsrssplstatus'], 'string', 'max' => 45],
            [['cmsad_awardcert', 'cmsad_createdbyipaddr', 'cmsad_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsad_avgappraisal'], 'string', 'max' => 10],
            [['cmsad_justifydocupload'], 'string', 'max' => 100],
            [['cmsad_cmscontracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmscontracthdrTbl::className(), 'targetAttribute' => ['cmsad_cmscontracthdr_fk' => 'cmscontracthdr_pk']],
            [['cmsad_cmsnonjsrssupmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsnonjsrssupmapTbl::className(), 'targetAttribute' => ['cmsad_cmsnonjsrssupmap_fk' => 'cmsnonjsrssupmap_pk']],
            [['cmsad_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsad_createdby' => 'UserMst_Pk']],
            [['cmsad_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsad_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsad_pdocategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => PdocategorymstTbl::className(), 'targetAttribute' => ['cmsad_pdocategorymst_fk' => 'pdocategorymst_pk']],
            [['cmsad_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsad_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsawarddtls_pk' => 'Cmsawarddtls Pk',
            'cmsad_cmscontracthdr_fk' => 'Cmsad Cmscontracthdr Fk',
            'cmsad_isdeviated' => 'Cmsad Isdeviated',
            'cmsad_contractorcategory' => 'Cmsad Contractorcategory',
            'cmsad_memcompmst_fk' => 'Cmsad Memcompmst Fk',
            'cmsad_jsrssplstatus' => 'Cmsad Jsrssplstatus',
            'cmsad_pdocategorymst_fk' => 'Cmsad Pdocategorymst Fk',
            'cmsad_classification' => 'Cmsad Classification',
            'cmsad_cmsnonjsrssupmap_fk' => 'Cmsad Cmsnonjsrssupmap Fk',
            'cmsad_nonjsrssplstatus' => 'Cmsad Nonjsrssplstatus',
            'cmsad_awardedon' => 'Cmsad Awardedon',
            'cmsad_isprimarycontractor' => 'Cmsad Isprimarycontractor',
            'cmsad_awardamt' => 'Cmsad Awardamt',
            'cmsad_awardcert' => 'Cmsad Awardcert',
            'cmsad_itemwise' => 'Cmsad Itemwise',
            'cmsad_appraisalcount' => 'Cmsad Appraisalcount',
            'cmsad_avgappraisal' => 'Cmsad Avgappraisal',
            'cmsad_ismaincontractor' => 'Cmsad Ismaincontractor',
            'cmsad_justifydocupload' => 'Cmsad Justifydocupload',
            'cmsad_justifycomment' => 'Cmsad Justifycomment',
            'cmsad_isdeactivated' => 'Cmsad Isdeactivated',
            'cmsad_createdon' => 'Cmsad Createdon',
            'cmsad_createdby' => 'Cmsad Createdby',
            'cmsad_createdbyipaddr' => 'Cmsad Createdbyipaddr',
            'cmsad_updatedon' => 'Cmsad Updatedon',
            'cmsad_updatedby' => 'Cmsad Updatedby',
            'cmsad_updatedbyipaddr' => 'Cmsad Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadCmscontracthdrFk()
    {
        return $this->hasOne(CmscontracthdrTbl::className(), ['cmscontracthdr_pk' => 'cmsad_cmscontracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadCmsnonjsrssupmapFk()
    {
        return $this->hasOne(CmsnonjsrssupmapTbl::className(), ['cmsnonjsrssupmap_pk' => 'cmsad_cmsnonjsrssupmap_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsad_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsad_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadPdocategorymstFk()
    {
        return $this->hasOne(PdocategorymstTbl::className(), ['pdocategorymst_pk' => 'cmsad_pdocategorymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsadUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsad_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsawardhstyTbls()
    {
        return $this->hasMany(CmsawardhstyTbl::className(), ['cmsah_cmsawarddtls_fk' => 'cmsawarddtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsawarddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsawarddtlsTblQuery(get_called_class());
    }

    public static function getContractAwardedBy(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $CmsawarddtlsTbl = CmsawarddtlsTbl::find()
                            ->select([
                                'MemberCompMst_Pk as filterPk',
                                'MCM_CompanyName as filterName',
                            ])
                            ->innerJoin('cmscontracthdr_tbl','cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                            ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsch_memcompmst_fk')
                            ->where([
                                'cmsad_memcompmst_fk' => $cmpPK
                            ])
                            ->groupBy('MemberCompMst_Pk')
                            ->asArray()
                            ->all();
        return $CmsawarddtlsTbl;
}

    public static function awardeesAwardedTo(){
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $CmsawarddtlsTbl = CmsawarddtlsTbl::find()
                            ->select([
                                'MemberCompMst_Pk as filterPk',
                                'MCM_CompanyName as filterName',
                            ])
                            ->innerJoin('cmscontracthdr_tbl','cmsad_cmscontracthdr_fk = cmscontracthdr_pk')
                            ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                            ->where([
                                'cmsch_memcompmst_fk' => $cmpPK
                            ])
                            ->groupBy('MemberCompMst_Pk')
                            ->orderBy(['MCM_CompanyName' => SORT_ASC])
                            ->asArray()
                            ->all();
        return $CmsawarddtlsTbl;
    }
}
