<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmsinspreqdocdtlstemp_tbl".
 *
 * @property int $cmsinspreqdocdtlstemp_pk Primary key
 * @property int $cirddt_cmsinspreqdochdrtemp_fk Reference to cmsinspreqdochdrtemp_tbl.cmsinspreqdochdrtemp_pk
 * @property string $cirddt_activityno Activity Number
 * @property string $cirddt_activitytitle Activity Title
 * @property string $cirddt_refdoc Ref. Doc / Acceptance Procedure
 * @property string $cirddt_remarks Remarks
 * @property int $cirddt_status 1 - Active, 2 - Inactive
 * @property string $cirddt_createdon Date of creation
 * @property int $cirddt_createdby Reference to usermst_tbl
 * @property string $cirddt_createdbyipaddr User IP Address
 * @property string $cirddt_updatedon Date of update
 * @property int $cirddt_updatedby Reference to usermst_tbl
 * @property string $cirddt_updatedbyipaddr User IP Address
 *
 * @property CmsinspreqdochdrtempTbl $cirddtCmsinspreqdochdrtempFk
 * @property UsermstTbl $cirddtCreatedby
 * @property UsermstTbl $cirddtUpdatedby
 */
class CmsinspreqdocdtlstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocdtlstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirddt_cmsinspreqdochdrtemp_fk', 'cirddt_activityno', 'cirddt_activitytitle', 'cirddt_refdoc', 'cirddt_status', 'cirddt_createdon', 'cirddt_createdby'], 'required'],
            [['cirddt_cmsinspreqdochdrtemp_fk', 'cirddt_status', 'cirddt_createdby', 'cirddt_updatedby'], 'integer'],
            [['cirddt_activitytitle', 'cirddt_remarks'], 'string'],
            [['cirddt_createdon', 'cirddt_updatedon'], 'safe'],
            [['cirddt_activityno', 'cirddt_refdoc'], 'string', 'max' => 25],
            [['cirddt_createdbyipaddr', 'cirddt_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirddt_cmsinspreqdochdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdochdrtempTbl::className(), 'targetAttribute' => ['cirddt_cmsinspreqdochdrtemp_fk' => 'cmsinspreqdochdrtemp_pk']],
            [['cirddt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirddt_createdby' => 'UserMst_Pk']],
            [['cirddt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirddt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocdtlstemp_pk' => 'Cmsinspreqdocdtlstemp Pk',
            'cirddt_cmsinspreqdochdrtemp_fk' => 'Cirddt Cmsinspreqdochdrtemp Fk',
            'cirddt_activityno' => 'Cirddt Activityno',
            'cirddt_activitytitle' => 'Cirddt Activitytitle',
            'cirddt_refdoc' => 'Cirddt Refdoc',
            'cirddt_remarks' => 'Cirddt Remarks',
            'cirddt_status' => 'Cirddt Status',
            'cirddt_createdon' => 'Cirddt Createdon',
            'cirddt_createdby' => 'Cirddt Createdby',
            'cirddt_createdbyipaddr' => 'Cirddt Createdbyipaddr',
            'cirddt_updatedon' => 'Cirddt Updatedon',
            'cirddt_updatedby' => 'Cirddt Updatedby',
            'cirddt_updatedbyipaddr' => 'Cirddt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdocactionmapTbls()
    {
        return $this->hasMany(CmsinspreqdocactionmaptempTbl::className(), ['cirdamt_cmsinspreqdocdtlstemp_fk' => 'cmsinspreqdocdtlstemp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddtCmsinspreqdochdrtempFk()
    {
        return $this->hasOne(CmsinspreqdochdrtempTbl::className(), ['cmsinspreqdochdrtemp_pk' => 'cirddt_cmsinspreqdochdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirddt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirddt_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamCmsinspreqdocdtlsFk()
    {
        return $this->hasOne(CmsinspreqdocdtlstempTbl::className(), ['cmsinspreqdocdtlstemp_pk' => 'cirdamt_cmsinspreqdocdtlstemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirdamQuancheckMcmFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cirdamt_quancheck_mcm_fk']);
    }
    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocdtlstempTblQuery(get_called_class());
    }
}
