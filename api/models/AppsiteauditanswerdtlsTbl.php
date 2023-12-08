<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appsiteauditanswerdtls_tbl".
 *
 * @property int $appsiteauditanswerdtls_pk primary key
 * @property int $asaad_auditquestionmst_fk Reference to appsiteauditquestionmst_pk
 * @property string $asaad_answer_en
 * @property string $asaad_answer_ar
 * @property int $asaad_order Order of answers to be displayed
 * @property int $asaad_grademst_fk Reference to grademst_pk
 * @property int $asaad_isselected 1-Yes, 2-No, by default 2
 * @property string $asaad_createdon
 * @property int $asaad_createdby
 *
 * @property AppsiteauditquestionmsttmpTbl $asaadAuditquestionmstFk
 * @property GrademstTbl $asaadGrademstFk
 * @property AppsiteauditanswerdtlshstyTbl[] $appsiteauditanswerdtlshstyTbls
 * @property AppsiteauditanswerdtlsmainTbl[] $appsiteauditanswerdtlsmainTbls
 */
class AppsiteauditanswerdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appsiteauditanswerdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asaad_auditquestionmst_fk', 'asaad_answer_en', 'asaad_order', 'asaad_createdby'], 'required'],
            [['asaad_auditquestionmst_fk', 'asaad_order', 'asaad_grademst_fk', 'asaad_isselected', 'asaad_createdby'], 'integer'],
            [['asaad_answer_en', 'asaad_answer_ar'], 'string'],
            [['asaad_createdon'], 'safe'],
            [['asaad_auditquestionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppsiteauditquestionmsttmpTbl::className(), 'targetAttribute' => ['asaad_auditquestionmst_fk' => 'appsiteauditquestionmsttmp_pk']],
            [['asaad_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['asaad_grademst_fk' => 'grademst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditanswerdtls_pk' => 'primary key',
            'asaad_auditquestionmst_fk' => 'Reference to appsiteauditquestionmst_pk',
            'asaad_answer_en' => 'Asaad Answer En',
            'asaad_answer_ar' => 'Asaad Answer Ar',
            'asaad_order' => 'Order of answers to be displayed',
            'asaad_grademst_fk' => 'Reference to grademst_pk',
            'asaad_isselected' => '1-Yes, 2-No, by default 2',
            'asaad_createdon' => 'Asaad Createdon',
            'asaad_createdby' => 'Asaad Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaadAuditquestionmstFk()
    {
        return $this->hasOne(AppsiteauditquestionmsttmpTbl::className(), ['appsiteauditquestionmsttmp_pk' => 'asaad_auditquestionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaadGrademstFk()
    {
        return $this->hasOne(GrademstTbl::className(), ['grademst_pk' => 'asaad_grademst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlshstyTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlshstyTbl::className(), ['asaadh_appsiteauditanswerdtls_fk' => 'appsiteauditanswerdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlsmainTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlsmainTbl::className(), ['asaadm_appsiteauditanswerdtls_fk' => 'appsiteauditanswerdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditanswerdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppsiteauditanswerdtlsTblQuery(get_called_class());
    }
}
