<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auditquestionmst_tbl".
 *
 * @property int $auditquestionmst_pk
 * @property int $aqm_auditchklstmst_fk Reference to auditchklstmst_pk
 * @property string $aqm_question_en
 * @property string $aqm_quesdesc_en
 * @property string $aqm_question_ar
 * @property string $aqm_quesdesc_ar
 * @property int $aqm_questiontype 1-Single Choice, 2-Multiple Choice, by default 1
 * @property int $aqm_order Order of question to be displayed
 * @property int $aqm_isgraded 1 - Yes, 2 - No
 * @property int $aqm_status 1-Active, 2-Inactive, by default 1
 * @property string $aqm_createdon
 * @property int $aqm_createdby
 * @property string $aqm_updatedon
 * @property int $aqm_updatedby
 *
 * @property AppsiteauditanswerdtlsTbl[] $appsiteauditanswerdtlsTbls
 * @property AppsiteauditanswerdtlshstyTbl[] $appsiteauditanswerdtlshstyTbls
 * @property AppsiteauditanswerdtlsmainTbl[] $appsiteauditanswerdtlsmainTbls
 * @property AuditanswerdtlsTbl[] $auditanswerdtlsTbls
 * @property AuditchklstmstTbl $aqmAuditchklstmstFk
 */
class AuditquestionmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auditquestionmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aqm_auditchklstmst_fk', 'aqm_question_en', 'aqm_question_ar', 'aqm_order', 'aqm_createdby'], 'required'],
            [['aqm_auditchklstmst_fk', 'aqm_questiontype', 'aqm_order', 'aqm_isgraded', 'aqm_status', 'aqm_createdby', 'aqm_updatedby'], 'integer'],
            [['aqm_question_en', 'aqm_quesdesc_en', 'aqm_question_ar', 'aqm_quesdesc_ar'], 'string'],
            [['aqm_createdon', 'aqm_updatedon'], 'safe'],
            [['aqm_auditchklstmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditchklstmstTbl::className(), 'targetAttribute' => ['aqm_auditchklstmst_fk' => 'auditchklstmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auditquestionmst_pk' => 'Auditquestionmst Pk',
            'aqm_auditchklstmst_fk' => 'Reference to auditchklstmst_pk',
            'aqm_question_en' => 'Aqm Question En',
            'aqm_quesdesc_en' => 'Aqm Quesdesc En',
            'aqm_question_ar' => 'Aqm Question Ar',
            'aqm_quesdesc_ar' => 'Aqm Quesdesc Ar',
            'aqm_questiontype' => '1-Single Choice, 2-Multiple Choice, by default 1',
            'aqm_order' => 'Order of question to be displayed',
            'aqm_isgraded' => '1 - Yes, 2 - No',
            'aqm_status' => '1-Active, 2-Inactive, by default 1',
            'aqm_createdon' => 'Aqm Createdon',
            'aqm_createdby' => 'Aqm Createdby',
            'aqm_updatedon' => 'Aqm Updatedon',
            'aqm_updatedby' => 'Aqm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlsTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlsTbl::className(), ['asaad_auditquestionmst_fk' => 'auditquestionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlshstyTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlshstyTbl::className(), ['asaadh_auditquestionmst_fk' => 'auditquestionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlsmainTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlsmainTbl::className(), ['asaadm_auditquestionmst_fk' => 'auditquestionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditanswerdtlsTbls()
    {
        return $this->hasMany(AuditanswerdtlsTbl::className(), ['aad_auditquestionmst_fk' => 'auditquestionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAqmAuditchklstmstFk()
    {
        return $this->hasOne(AuditchklstmstTbl::className(), ['auditchklstmst_pk' => 'aqm_auditchklstmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AuditquestionmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuditquestionmstTblQuery(get_called_class());
    }
}
