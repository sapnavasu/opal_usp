<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appsiteauditreportcattmp_tbl".
 *
 * @property int $appsiteauditreportcattmp_pk primary key
 * @property int $asarct_appauditschedtmp_fk Reference to appauditschedtmp_pk
 * @property string $asarct_categorytitle_en
 * @property int $asarct_order Order of title to be displayed
 * @property int $asarct_totalques
 * @property int $asarct_bronze
 * @property int $asarct_silver
 * @property int $asarct_gold
 * @property int $asarct_grademst_fk Reference to grademst_pk
 * @property string $asarct_gradingreason
 * @property string $asarct_createdon
 * @property int $asarct_createdby
 *
 * @property AppsiteauditquestionmstTbl[] $appsiteauditquestionmstTbls
 * @property AppsiteauditquestionmstmainTbl[] $appsiteauditquestionmstmainTbls
 * @property AppsiteauditreportcathstyTbl[] $appsiteauditreportcathstyTbls
 * @property AppsiteauditreportcatmainTbl[] $appsiteauditreportcatmainTbls
 */ 
class OpalsitecategoryTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appsiteauditreportcattmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asarct_appauditschedtmp_fk', 'asarct_categorytitle_en', 'asarct_order'], 'required'],
            [['asarct_appauditschedtmp_fk', 'asarct_order', 'asarct_grademst_fk'], 'integer'],
            [['asarct_categorytitle_en', 'asarct_gradingreason'], 'string'],
            [['asaclm_createdon'], 'safe'],
        ];
    } 

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditreportcattmp_pk' => 'Appsiteauditreportcattmp Pk',
            'asarct_appauditschedtmp_fk' => 'Asaclm Appauditschedtmp Fk',
            'asarct_categorytitle_en' => 'Asaclm Categorytitle',
            'asaclm_order' => 'Asaclm Order',
            'asarct_grademst_fk' => 'Asaclm Grademst Fk',
            'asarct_gradingreason' => 'Asaclm Gradingreason',
            'asarct_createdon' => 'Asaclm Createdon',
            'asarct_createdby' => 'Asaclm Createdby',
        ];
    }


     /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditquestionmstTbls()
    {
        return $this->hasMany(AppsiteauditquestionmstTbl::className(), ['asaqm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditquestionmstmainTbls()
    {
        return $this->hasMany(AppsiteauditquestionmstmainTbl::className(), ['asaqmm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditreportcathstyTbls()
    {
        return $this->hasMany(AppsiteauditreportcathstyTbl::className(), ['asarch_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }


    public static function updateCategory($requestdata){
    
        $model = OpalsitecategoryTbl::find()->where(['appsiteauditreportcattmp_pk' => $requestdata['appsiteauditreportcattmp_pk']])->one();

        if($model){
            $model->asarct_bronze = $requestdata['asarct_bronze'];
            $model->asarct_gold = $requestdata['asarct_gold'];
            $model->asarct_silver = $requestdata['asarct_silver'];
            $model->asarct_totalques = $requestdata['asarct_totalques'];
            $model->asarct_grademst_fk = $requestdata['asarct_grademst_fk'];



        if($model->save()){
            return $model->appsiteauditreportcattmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    
    }
    }
}
