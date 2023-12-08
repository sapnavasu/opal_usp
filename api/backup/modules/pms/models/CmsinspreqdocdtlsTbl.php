<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmsinspreqdocdtls_tbl".
 *
 * @property int $cmsinspreqdocdtls_pk Primary key
 * @property int $cirdd_cmsinspreqdochdr_fk Reference to cmsinspreqdochdr_tbl
 * @property string $cirdd_activityno Activity Number
 * @property string $cirdd_activitytitle Activity Title
 * @property string $cirdd_refdoc Ref. Doc / Acceptance Procedure
 * @property string $cirdd_remarks Remarks
 * @property int $cirdd_status 1 - Active, 2 - Inactive
 * @property string $cirdd_createdon Date of creation
 * @property int $cirdd_createdby Reference to usermst_tbl
 * @property string $cirdd_createdbyipaddr User IP Address
 * @property string $cirdd_updatedon Date of update
 * @property int $cirdd_updatedby Reference to usermst_tbl
 * @property string $cirdd_updatedbyipaddr User IP Address
 *
 * @property CmsinspreqdocactionmapTbl[] $cmsinspreqdocactionmapTbls
 * @property CmsinspreqdochdrTbl $cirddCmsinspreqdochdrFk
 * @property UsermstTbl $cirddCreatedby
 * @property UsermstTbl $cirddUpdatedby
 */
class CmsinspreqdocdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsinspreqdocdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cirdd_cmsinspreqdochdr_fk', 'cirdd_activityno', 'cirdd_activitytitle', 'cirdd_refdoc', 'cirdd_status', 'cirdd_createdon', 'cirdd_createdby'], 'required'],
            [['cirdd_cmsinspreqdochdr_fk', 'cirdd_status', 'cirdd_createdby', 'cirdd_updatedby'], 'integer'],
            [['cirdd_activitytitle', 'cirdd_remarks'], 'string'],
            [['cirdd_createdon', 'cirdd_updatedon'], 'safe'],
            [['cirdd_createdbyipaddr', 'cirdd_updatedbyipaddr'], 'string', 'max' => 50],
            [['cirdd_activityno', 'cirdd_refdoc'], 'string', 'max' => 25],
            [['cirdd_cmsinspreqdochdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsinspreqdochdrTbl::className(), 'targetAttribute' => ['cirdd_cmsinspreqdochdr_fk' => 'cmsinspreqdochdr_pk']],
            [['cirdd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdd_createdby' => 'UserMst_Pk']],
            [['cirdd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cirdd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsinspreqdocdtls_pk' => 'Cmsinspreqdocdtls Pk',
            'cirdd_cmsinspreqdochdr_fk' => 'Cirdd Cmsinspreqdochdr Fk',
            'cirdd_activityno' => 'Cirdd Activityno',
            'cirdd_activitytitle' => 'Cirdd Activitytitle',
            'cirdd_refdoc' => 'Cirdd Refdoc',
            'cirdd_remarks' => 'Cirdd Remarks',
            'cirdd_status' => 'Cirdd Status',
            'cirdd_createdon' => 'Cirdd Createdon',
            'cirdd_createdby' => 'Cirdd Createdby',
            'cirdd_createdbyipaddr' => 'Cirdd Createdbyipaddr',
            'cirdd_updatedon' => 'Cirdd Updatedon',
            'cirdd_updatedby' => 'Cirdd Updatedby',
            'cirdd_updatedbyipaddr' => 'Cirdd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsinspreqdocactionmapTbls()
    {
        return $this->hasMany(CmsinspreqdocactionmapTbl::className(), ['cirdam_cmsinspreqdocdtls_fk' => 'cmsinspreqdocdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddCmsinspreqdochdrFk()
    {
        return $this->hasOne(CmsinspreqdochdrTbl::className(), ['cmsinspreqdochdr_pk' => 'cirdd_cmsinspreqdochdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCirddUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cirdd_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsinspreqdocdtlsTblQuery(get_called_class());
    }
}
