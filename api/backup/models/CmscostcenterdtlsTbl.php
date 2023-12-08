<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cmscostcenterdtls_tbl".
 *
 * @property int $cmscostcenterdtls_pk
 * @property int $cmsccd_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $cmsccd_uid Unique ID Auto generated value
 * @property string $cmsccd_name Cost Center name
 * @property int $cmsccd_status 1- Active, 2 - Inactive, 3 - Deleted
 * @property string $cmsccd_createdon Date of creation
 * @property int $cmsccd_createdby Reference to usermst_tbl
 * @property string $cmsccd_createdbyipaddr User IP Address
 * @property string $cmsccd_updatedon Date of update
 * @property int $cmsccd_updatedby Reference to usermst_tbl
 * @property string $cmsccd_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsccdCreatedby
 * @property MembercompanymstTbl $cmsccdMemcompmstFk
 * @property UsermstTbl $cmsccdUpdatedby
 * @property CmsrequisitionformdtlsTbl[] $cmsrequisitionformdtlsTbls
 */
class CmscostcenterdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmscostcenterdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsccd_memcompmst_fk', 'cmsccd_name', 'cmsccd_createdon', 'cmsccd_createdby'], 'required'],
            [['cmsccd_memcompmst_fk', 'cmsccd_status', 'cmsccd_createdby', 'cmsccd_updatedby'], 'integer'],
            [['cmsccd_createdon', 'cmsccd_updatedon'], 'safe'],
            // [['cmsccd_uid'], 'string', 'max' => 20],
            [['cmsccd_name'], 'string', 'max' => 100],
            [['cmsccd_createdbyipaddr', 'cmsccd_updatedbyipaddr'], 'string', 'max' => 50],
            // [['cmsccd_uid'], 'unique'],
            [['cmsccd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsccd_createdby' => 'UserMst_Pk']],
            [['cmsccd_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['cmsccd_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['cmsccd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsccd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmscostcenterdtls_pk' => 'Cmscostcenterdtls Pk',
            'cmsccd_memcompmst_fk' => 'Cmsccd Memcompmst Fk',
            // 'cmsccd_uid' => 'Cmsccd Uid',
            'cmsccd_name' => 'Cmsccd Name',
            'cmsccd_status' => 'Cmsccd Status',
            'cmsccd_createdon' => 'Cmsccd Createdon',
            'cmsccd_createdby' => 'Cmsccd Createdby',
            'cmsccd_createdbyipaddr' => 'Cmsccd Createdbyipaddr',
            'cmsccd_updatedon' => 'Cmsccd Updatedon',
            'cmsccd_updatedby' => 'Cmsccd Updatedby',
            'cmsccd_updatedbyipaddr' => 'Cmsccd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsccdCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsccd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsccdMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsccd_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsccdUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsccd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsrequisitionformdtlsTbls()
    {
        return $this->hasMany(CmsrequisitionformdtlsTbl::className(), ['crfd_cmscostcenterdtls_fk' => 'cmscostcenterdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmscostcenterdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmscostcenterdtlsTblQuery(get_called_class());
    }
}
