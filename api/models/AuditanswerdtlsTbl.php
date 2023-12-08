<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auditanswerdtls_tbl".
 *
 * @property int $auditanswerdtls_pk
 * @property int $aad_auditquestionmst_fk Reference to auditquestionmst_pk
 * @property string $aad_answer_en
 * @property string $aad_answer_ar
 * @property int $aad_order Order of answers to be displayed
 * @property int $aad_grademst_fk
 * @property int $aad_status 1-Active, 2-Inactive, by default 1
 * @property string $aad_createdon
 * @property int $aad_createdby
 * @property string $aad_updatedon
 * @property int $aad_updatedby
 *
 * @property AuditquestionmstTbl $aadAuditquestionmstFk
 */
class AuditanswerdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auditanswerdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aad_auditquestionmst_fk', 'aad_answer_en', 'aad_answer_ar', 'aad_order', 'aad_createdby'], 'required'],
            [['aad_auditquestionmst_fk', 'aad_order', 'aad_grademst_fk', 'aad_status', 'aad_createdby', 'aad_updatedby'], 'integer'],
            [['aad_answer_en', 'aad_answer_ar'], 'string'],
            [['aad_createdon', 'aad_updatedon'], 'safe'],
            [['aad_auditquestionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AuditquestionmstTbl::className(), 'targetAttribute' => ['aad_auditquestionmst_fk' => 'auditquestionmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auditanswerdtls_pk' => 'Auditanswerdtls Pk',
            'aad_auditquestionmst_fk' => 'Reference to auditquestionmst_pk',
            'aad_answer_en' => 'Aad Answer En',
            'aad_answer_ar' => 'Aad Answer Ar',
            'aad_order' => 'Order of answers to be displayed',
            'aad_grademst_fk' => 'Aad Grademst Fk',
            'aad_status' => '1-Active, 2-Inactive, by default 1',
            'aad_createdon' => 'Aad Createdon',
            'aad_createdby' => 'Aad Createdby',
            'aad_updatedon' => 'Aad Updatedon',
            'aad_updatedby' => 'Aad Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAadAuditquestionmstFk()
    {
        return $this->hasOne(AuditquestionmstTbl::className(), ['auditquestionmst_pk' => 'aad_auditquestionmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AuditanswerdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuditanswerdtlsTblQuery(get_called_class());
    }
}
