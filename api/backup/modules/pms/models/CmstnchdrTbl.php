<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmstnchdr_tbl".
 *
 * @property int $cmstnchdr_pk Primary key
 * @property int $ctnch_type 1 - RFI, 2 - EOI, 3 - RFP, 4 - RFQ, 5 - Contract Scope, 6 - Contract T&C
 * @property string $ctnch_name Name of Terms and Conditions
 * @property int $ctnch_ismandatory 1 - Yes, 2 - No
 * @property string $ctnch_sampletext Sample text for each title
 * @property int $ctnch_status 1 - Active, 2 - Inactive
 * @property string $ctnch_createdon Date of creation
 * @property int $ctnch_createdby Reference to usermst_tbl
 * @property string $ctnch_createdbyipaddr User IP Address
 * @property string $ctnch_updatedon Date of update
 * @property int $ctnch_updatedby Reference to usermst_tbl
 * @property string $ctnch_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $ctnchCreatedby
 * @property UsermstTbl $ctnchUpdatedby
 * @property CmstnctrnxTbl[] $cmstnctrnxTbls
 */
class CmstnchdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstnchdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctnch_type', 'ctnch_name', 'ctnch_ismandatory', 'ctnch_status'], 'required'],
            [['ctnch_type', 'ctnch_ismandatory', 'ctnch_status', 'ctnch_createdby', 'ctnch_updatedby'], 'integer'],
            [['ctnch_sampletext'], 'string'],
            [['ctnch_createdon', 'ctnch_updatedon'], 'safe'],
            [['ctnch_name', 'ctnch_createdbyipaddr', 'ctnch_updatedbyipaddr'], 'string', 'max' => 50],
            [['ctnch_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnch_createdby' => 'UserMst_Pk']],
            [['ctnch_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctnch_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstnchdr_pk' => 'Cmstnchdr Pk',
            'ctnch_type' => 'Ctnch Type',
            'ctnch_name' => 'Ctnch Name',
            'ctnch_ismandatory' => 'Ctnch Ismandatory',
            'ctnch_sampletext' => 'Ctnch Sampletext',
            'ctnch_status' => 'Ctnch Status',
            'ctnch_createdon' => 'Ctnch Createdon',
            'ctnch_createdby' => 'Ctnch Createdby',
            'ctnch_createdbyipaddr' => 'Ctnch Createdbyipaddr',
            'ctnch_updatedon' => 'Ctnch Updatedon',
            'ctnch_updatedby' => 'Ctnch Updatedby',
            'ctnch_updatedbyipaddr' => 'Ctnch Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnchCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnch_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtnchUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctnch_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstnctrnxTbls()
    {
        return $this->hasMany(CmstnctrnxTbl::className(), ['ctnct_cmstnchdr_fk' => 'cmstnchdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstnchdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstnchdrTblQuery(get_called_class());
    }
}
