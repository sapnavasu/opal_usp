<?php

namespace api\modules\pms\models;

use \common\models\UsermstTbl;
use common\components\Security;

use Yii;

/**
 * This is the model class for table "cmsaddinfodtlstemp_tbl".
 *
 * @property int $cmsaddinfodtlstemp_pk Primary key
 * @property int $caidt_cmstenderhdrtemp_fk Reference to cmstenderhdrtemp_tbl
 * @property string $caidt_title Title
 * @property string $caidt_description Description
 * @property int $caidt_index index
 * @property int $caidt_status 1 - Active, 2 - Inactive
 * @property string $caidt_createdon Date of creation
 * @property int $caidt_createdby Reference to usermst_tbl
 * @property string $caidt_createdbyipaddr User IP Address
 * @property string $caidt_updatedon Date of update
 * @property int $caidt_updatedby Reference to usermst_tbl
 * @property string $caidt_updatedbyipaddr User IP Address
 *
 * @property CmstenderhdrtempTbl $caidtCmstenderhdrtempFk
 * @property UsermstTbl $caidtCreatedby
 * @property UsermstTbl $caidtUpdatedby
 */
class CmsaddinfodtlstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsaddinfodtlstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caidt_cmstenderhdrtemp_fk', 'caidt_title', 'caidt_description', 'caidt_status'], 'required'],
            [['caidt_cmstenderhdrtemp_fk', 'caidt_index', 'caidt_status', 'caidt_createdby', 'caidt_updatedby'], 'integer'],
            [['caidt_title', 'caidt_description'], 'string'],
            [['caidt_createdon', 'caidt_updatedon'], 'safe'],
            [['caidt_createdbyipaddr', 'caidt_updatedbyipaddr'], 'string', 'max' => 50],
            [['caidt_cmstenderhdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrtempTbl::className(), 'targetAttribute' => ['caidt_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']],
            [['caidt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caidt_createdby' => 'UserMst_Pk']],
            [['caidt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caidt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsaddinfodtlstemp_pk' => 'Cmsaddinfodtlstemp Pk',
            'caidt_cmstenderhdrtemp_fk' => 'Caidt Cmstenderhdrtemp Fk',
            'caidt_title' => 'Caidt Title',
            'caidt_description' => 'Caidt Description',
            'caidt_index' => 'Caidt Index',
            'caidt_status' => 'Caidt Status',
            'caidt_createdon' => 'Caidt Createdon',
            'caidt_createdby' => 'Caidt Createdby',
            'caidt_createdbyipaddr' => 'Caidt Createdbyipaddr',
            'caidt_updatedon' => 'Caidt Updatedon',
            'caidt_updatedby' => 'Caidt Updatedby',
            'caidt_updatedbyipaddr' => 'Caidt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidtCmstenderhdrtempFk()
    {
        return $this->hasOne(CmstenderhdrtempTbl::className(), ['cmstenderhdrtemp_pk' => 'caidt_cmstenderhdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caidt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caidt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsaddinfodtlstempTblQuery(get_called_class());
    }
}
