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
 * @property int $asaqm_questiontype 1-Single Choice, 2-Multiple Choice, by default 1
 * @property int $asaqm_order Order of question to be displayed
 * @property int $asaqm_isgraded 1 - Yes, 2 - No
 * @property string $asaqm_comments
 * @property int $asaqm_fileupload Reference to memcompfiledtls_pk
 * @property string $asaqm_createdon
 * @property int $asaqm_createdby
 *
 * @property AppsiteauditreportcattmpTbl $asaqmSiteauditreportcattmpFk
 */
class OpalsitequestionTbl extends \yii\db\ActiveRecord
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
            [['asaqm_question_en', 'asaqm_quesdesc_en', 'asaqm_comments'], 'string'],
            [['asaqm_createdon'], 'safe'],
            [['asaqm_appsiteauditreportcattmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalsitecategoryTbl::class, 'targetAttribute' => ['asaqm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditquestionmsttmp_pk' => 'Appsiteauditquestionmst Pk',
            'asaqm_appsiteauditreportcattmp_fk' => 'Asaqm Siteauditreportcattmp Fk',
            'asaqm_question_en' => 'Asaqm Question',
            'asaqm_quesdesc_en' => 'Asaqm Quesdesc',
            'asaqm_questiontype' => 'Asaqm Questiontype',
            'asaqm_order' => 'Asaqm Order',
            'asaqm_isgraded' => 'Asaqm Isgraded',
            'asaqm_comments' => 'Asaqm Comments',
            'asaqm_fileupload' => 'Asaqm Fileupload',
            'asaqm_createdon' => 'Asaqm Createdon',
            'asaqm_createdby' => 'Asaqm Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaqmSiteauditreportcattmpFk()
    {
        return $this->hasOne(OpalsitecategoryTbl::class, ['appsiteauditreportcattmp_pk' => 'asaqm_appsiteauditreportcattmp_fk']);
    }

    public static function updateQuestion($requestdata){
        // echo '<pre>';print_r($requestdata);exit;
        $model = OpalsitequestionTbl::find()->where(['appsiteauditquestionmsttmp_pk' => $requestdata['appsiteauditquestionmsttmp_pk']])->one();
        if($model){
         if($requestdata['asaqm_question_en']){
           $model->asaqm_question_en = $requestdata['asaqm_question_en'];
        }
        if($requestdata['asaqm_quesdesc_en']){
        $model->asaqm_quesdesc_en = $requestdata['asaqm_quesdesc_en'];
        }
        if($requestdata['asaqm_comments']){
        $model->asaqm_comments = $requestdata['asaqm_comments'];
        }
        if($requestdata['asaqm_fileupload']){
            $model->asaqm_fileupload = $requestdata['asaqm_fileupload'];
           }

        if($model->save()){
            return $model->appsiteauditquestionmsttmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    }
}
