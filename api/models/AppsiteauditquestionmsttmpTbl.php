<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appsiteauditquestionmsttmp_tbl".
 *
 * @property int $appsiteauditquestionmsttmp_pk primary key
 * @property int $asaqm_appsiteauditreportcattmp_fk Reference to siteauditreportcattmp_pk
 * @property string $asaqm_question_en
 * @property string $asaqm_quesdesc_en
 * @property string $asaqm_question_ar
 * @property string $asaqm_quesdesc_ar
 * @property int $asaqm_questiontype 1-Single Choice, 2-Multiple Choice, by default 1
 * @property int $asaqm_order Order of question to be displayed
 * @property int $asaqm_isgraded 1 - Yes, 2 - No
 * @property string $asaqm_comments
 * @property int $asaqm_fileupload Reference to memcompfiledtls_pk
 * @property string $asaqm_createdon
 * @property int $asaqm_createdby
 *
 * @property AppsiteauditanswerdtlsTbl[] $appsiteauditanswerdtlsTbls
 * @property AppsiteauditquestionmsthstyTbl[] $appsiteauditquestionmsthstyTbls
 * @property AppsiteauditquestionmstmainTbl[] $appsiteauditquestionmstmainTbls
 * @property AppsiteauditreportcattmpTbl $asaqmAppsiteauditreportcattmpFk
 */
class AppsiteauditquestionmsttmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appsiteauditquestionmsttmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asaqm_appsiteauditreportcattmp_fk', 'asaqm_question_en', 'asaqm_order', 'asaqm_createdby'], 'required'],
            [['asaqm_appsiteauditreportcattmp_fk', 'asaqm_questiontype', 'asaqm_order', 'asaqm_isgraded', 'asaqm_fileupload', 'asaqm_createdby'], 'integer'],
            [['asaqm_question_en', 'asaqm_quesdesc_en', 'asaqm_question_ar', 'asaqm_quesdesc_ar', 'asaqm_comments'], 'string'],
            [['asaqm_createdon'], 'safe'],
            [['asaqm_appsiteauditreportcattmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppsiteauditreportcattmpTbl::className(), 'targetAttribute' => ['asaqm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditquestionmsttmp_pk' => 'primary key',
            'asaqm_appsiteauditreportcattmp_fk' => 'Reference to siteauditreportcattmp_pk',
            'asaqm_question_en' => 'Asaqm Question En',
            'asaqm_quesdesc_en' => 'Asaqm Quesdesc En',
            'asaqm_question_ar' => 'Asaqm Question Ar',
            'asaqm_quesdesc_ar' => 'Asaqm Quesdesc Ar',
            'asaqm_questiontype' => '1-Single Choice, 2-Multiple Choice, by default 1',
            'asaqm_order' => 'Order of question to be displayed',
            'asaqm_isgraded' => '1 - Yes, 2 - No',
            'asaqm_comments' => 'Asaqm Comments',
            'asaqm_fileupload' => 'Reference to memcompfiledtls_pk',
            'asaqm_createdon' => 'Asaqm Createdon',
            'asaqm_createdby' => 'Asaqm Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditanswerdtlsTbls()
    {
        return $this->hasMany(AppsiteauditanswerdtlsTbl::className(), ['asaad_auditquestionmst_fk' => 'appsiteauditquestionmsttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditquestionmsthstyTbls()
    {
        return $this->hasMany(AppsiteauditquestionmsthstyTbl::className(), ['asaqmh_appsiteauditquestionmsttmp_fk' => 'appsiteauditquestionmsttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditquestionmstmainTbls()
    {
        return $this->hasMany(AppsiteauditquestionmstmainTbl::className(), ['asaqmm_appsiteauditquestionmsttmp_fk' => 'appsiteauditquestionmsttmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaqmAppsiteauditreportcattmpFk()
    {
        return $this->hasOne(AppsiteauditreportcattmpTbl::className(), ['appsiteauditreportcattmp_pk' => 'asaqm_appsiteauditreportcattmp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditquestionmsttmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppsiteauditquestionmsttmpTblQuery(get_called_class());
    }
}
