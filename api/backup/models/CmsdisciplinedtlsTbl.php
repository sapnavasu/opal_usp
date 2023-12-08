<?php

namespace app\models;

use Yii;
use \common\models\UsermstTbl;
use \common\models\MembercompanymstTbl;


/**
 * This is the model class for table "cmsdisciplinedtls_tbl".
 *
 * @property int $cmsdisciplinedtls_pk
 * @property int $cmsdd_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $cmsdd_uid Unique ID Auto generated value
 * @property string $cmsdd_name discipline name
 * @property int $cmsdd_status 1- Active, 2 - Inactive, 3 - Deleted
 * @property string $cmsdd_createdon Date of creation
 * @property int $cmsdd_createdby Reference to usermst_tbl
 * @property string $cmsdd_createdbyipaddr User IP Address
 * @property string $cmsdd_updatedon Date of update
 * @property int $cmsdd_updatedby Reference to usermst_tbl
 * @property string $cmsdd_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsddCreatedby
 * @property MembercompanymstTbl $cmsddMemcompmstFk
 * @property UsermstTbl $cmsddUpdatedby
 * @property CmsrequisitionformdtlsTbl[] $cmsrequisitionformdtlsTbls
 */
class CmsdisciplinedtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsdisciplinedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsdd_memcompmst_fk', 'cmsdd_name', 'cmsdd_createdon', 'cmsdd_createdby'], 'required'],
            [['cmsdd_memcompmst_fk', 'cmsdd_status', 'cmsdd_createdby', 'cmsdd_updatedby'], 'integer'],
            [['cmsdd_createdon', 'cmsdd_updatedon'], 'safe'],
            // [['cmsdd_uid'], 'string', 'max' => 20],
            [['cmsdd_name'], 'string', 'max' => 100],
            [['cmsdd_createdbyipaddr', 'cmsdd_updatedbyipaddr'], 'string', 'max' => 50],
            // [['cmsdd_uid'], 'unique'],
            [['cmsdd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsdd_createdby' => 'UserMst_Pk']],
            [['cmsdd_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsdd_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsdd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsdd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsdisciplinedtls_pk' => 'Cmsdisciplinedtls Pk',
            'cmsdd_memcompmst_fk' => 'Cmsdd Memcompmst Fk',
            // 'cmsdd_uid' => 'Cmsdd Uid',
            'cmsdd_name' => 'Cmsdd Name',
            'cmsdd_status' => 'Cmsdd Status',
            'cmsdd_createdon' => 'Cmsdd Createdon',
            'cmsdd_createdby' => 'Cmsdd Createdby',
            'cmsdd_createdbyipaddr' => 'Cmsdd Createdbyipaddr',
            'cmsdd_updatedon' => 'Cmsdd Updatedon',
            'cmsdd_updatedby' => 'Cmsdd Updatedby',
            'cmsdd_updatedbyipaddr' => 'Cmsdd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsddCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsdd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsddMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsdd_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsddUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsdd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrequisitionformdtlsTbls()
    {
        return $this->hasMany(\api\modules\pms\models\CmsrequisitionformdtlsTbl::className(), ['crfd_cmsdisciplinedtls_fk' => 'cmsdisciplinedtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmsdisciplinedtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsdisciplinedtlsTblQuery(get_called_class());
    }
}
