<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmsinspreqdocdtlshsty_tbl".
 *
 * @property int $cmsinspreqdocdtlshsty_pk Primary key
 * @property int $cirddh_cmsinspreqdocdtls_fk Reference to cmsinspreqdocdtls_tbl.cmsinspreqdocdtls_pk
 * @property string $cirddh_activityno Activity Number
 * @property string $cirddh_activitytitle Activity Title
 * @property string $cirddh_refdoc Ref. Doc / Acceptance Procedure
 * @property string $cirddh_remarks Remarks
 * @property int $cirddh_status 1 - Active, 2 - Inactive
 * @property string $cirddh_createdon Date of creation
 * @property int $cirddh_createdby Reference to usermst_tbl
 * @property string $cirddh_createdbyipaddr User IP Address
 * @property string $cirddh_updatedon Date of update
 * @property int $cirddh_updatedby Reference to usermst_tbl
 * @property string $cirddh_updatedbyipaddr User IP Address
 *
 * @property CmsinspreqdocdtlsTbl $cirddhCmsinspreqdocdtlsFk
 * @property UsermstTbl $cirddhCreatedby
 * @property UsermstTbl $cirddhUpdatedby
 */
class CmsinspreqdocdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirddh_cmsinspreqdocdtls_fk', 'cirddh_activityno', 'cirddh_activitytitle', 'cirddh_refdoc', 'cirddh_status', 'cirddh_createdon', 'cirddh_createdby'], 'required'],
            [['cirddh_cmsinspreqdocdtls_fk', 'cirddh_status', 'cirddh_createdby', 'cirddh_updatedby'], 'integer'],
            [['cirddh_activitytitle', 'cirddh_remarks'], 'string'],
            [['cirddh_createdon', 'cirddh_updatedon'], 'safe'],
            [['cirddh_activityno', 'cirddh_refdoc'], 'string', 'max' => 25],
            [['cirddh_createdbyipaddr', 'cirddh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirddh_cmsinspreqdocdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdocdtlsTbl::className(), 'targetAttribute' => ['cirddh_cmsinspreqdocdtls_fk' => 'cmsinspreqdocdtls_pk']],
            [['cirddh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirddh_createdby' => 'UserMst_Pk']],
            [['cirddh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirddh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocdtlshsty_pk' => 'Cmsinspreqdocdtlshsty Pk',
            'cirddh_cmsinspreqdocdtls_fk' => 'Cirddh Cmsinspreqdocdtls Fk',
            'cirddh_activityno' => 'Cirddh Activityno',
            'cirddh_activitytitle' => 'Cirddh Activitytitle',
            'cirddh_refdoc' => 'Cirddh Refdoc',
            'cirddh_remarks' => 'Cirddh Remarks',
            'cirddh_status' => 'Cirddh Status',
            'cirddh_createdon' => 'Cirddh Createdon',
            'cirddh_createdby' => 'Cirddh Createdby',
            'cirddh_createdbyipaddr' => 'Cirddh Createdbyipaddr',
            'cirddh_updatedon' => 'Cirddh Updatedon',
            'cirddh_updatedby' => 'Cirddh Updatedby',
            'cirddh_updatedbyipaddr' => 'Cirddh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddhCmsinspreqdocdtlsFk()
    {
        return $this->hasOne(CmsinspreqdocdtlsTbl::className(), ['cmsinspreqdocdtls_pk' => 'cirddh_cmsinspreqdocdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirddh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirddh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocdtlshstyTblQuery(get_called_class());
    }
}
