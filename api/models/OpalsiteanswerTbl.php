<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appsiteauditanswerdtls_tbl".
 *
 * @property int $appsiteauditanswerdtls_pk primary key
 * @property int $asaad_auditquestionmst_fk Reference to auditquestionmst_pk
 * @property string $asaad_answer_en
 * @property int $asaad_order Order of answers to be displayed
 * @property int $asaad_grademst_fk Reference to grademst_pk
 * @property int $asaad_isselected 1-Yes, 2-No, by default 1
 * @property string $asaad_createdon
 * @property int $asaad_createdby
 *
 * @property AuditquestionmstTbl $asaadAuditquestionmstFk
 * @property GrademstTbl $asaadGrademstFk
 */
class OpalsiteanswerTbl extends \yii\db\ActiveRecord
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
            [['asaad_answer_en'], 'string'],
            [['asaad_createdon'], 'safe'],
            [['asaad_auditquestionmst_fk'], 'exist', 'skipOnError' => true, ],
            [['asaad_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['asaad_grademst_fk' => 'grademst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditanswerdtls_pk' => 'Appsiteauditanswerdtls Pk',
            'asaad_auditquestionmst_fk' => 'Asaad Auditquestionmst Fk',
            'asaad_answer_en' => 'Asaad Answer',
            'asaad_order' => 'Asaad Order',
            'asaad_grademst_fk' => 'Asaad Grademst Fk',
            'asaad_isselected' => 'Asaad Isselected',
            'asaad_createdon' => 'Asaad Createdon',
            'asaad_createdby' => 'Asaad Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaadAuditquestionmstFk()
    {
        return $this->hasOne(AuditquestionmstTbl::className(), ['auditquestionmst_pk' => 'asaad_auditquestionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsaadGrademstFk()
    {
        return $this->hasOne(GrademstTbl::className(), ['grademst_pk' => 'asaad_grademst_fk']);
    }

    
    // public static function updateAnswer($requestdata){

    //     $model = OpalsiteanswerTbl::find()->where(['appsiteauditanswerdtls_pk' => $requestdata['appsiteauditanswerdtls_pk']])->one();
    //     print_R($model);
        
    // //     if($model){
    // //     $model->asaad_isselected = $requestdata['asaad_isselected'];
    // //     $model->asaad_grademst_fk = $requestdata['asaad_grademst_fk'];
    // //     if($model->save()){
    // //         return $model->appsiteauditanswerdtls_pk;
    // //     } else {
    // //         echo "<pre>";
    // //         var_dump($model->getErrors());
    // //         exit;
    // //     }
    // // }
    // }

    public static function updateAnswer($requestdata){
        // echo '<pre>';print_r($requestdata);exit;
        $model = OpalsiteanswerTbl::find()->where(['appsiteauditanswerdtls_pk' => $requestdata['appsiteauditanswerdtls_pk']])->one();
        if($model){
            $model->asaad_isselected = ($requestdata['asaad_isselected'] == 1)?1:0;
            $model->asaad_grademst_fk = $requestdata['asaad_grademst_fk'];

        if($model->save()){
            return $model->appsiteauditanswerdtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    }

public static function resetAnswer($requestdata){
        $ansarray = OpalsiteanswerTbl::find()->where(['asaad_auditquestionmst_fk' => $requestdata])->andwhere(['asaad_isselected' => 1])->asArray()->all();
        if($ansarray){
        foreach($ansarray  as $data){
        $model =  \app\models\OpalsiteanswerTbl::find()->where("appsiteauditanswerdtls_pk =:pk", [':pk' => $data['appsiteauditanswerdtls_pk']])->one();
            $model->asaad_isselected =0;
        if($model->save()){
       // return $model->appsiteauditanswerdtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    }
}
    public static function resetGrade($requestdata){
        $ansarray = OpalsiteanswerTbl::find()->where(['asaad_auditquestionmst_fk' => $requestdata['asaad_auditquestionmst_fk']])->asArray()->all();
        if($ansarray){
        foreach($ansarray  as $data){
        $model =  \app\models\OpalsiteanswerTbl::find()->where("appsiteauditanswerdtls_pk =:pk", [':pk' => $data['appsiteauditanswerdtls_pk']])->one();
        $model->asaad_grademst_fk = '';
        if($model->save()){
         //  return $model->appsiteauditanswerdtls_pk;
        } else {
        echo "<pre>";
        var_dump($model->getErrors());
        exit;
        }
        }
        }
    }
}
