<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grademst_tbl".
 *
 * @property int $grademst_pk
 * @property string $gm_gradename_en
 * @property string $gm_gradename_ar
 * @property int $gm_scorefrom
 * @property int $gm_scoreto
 * @property int $gm_scoreinpercent Grade score in percentage
 * @property int $gm_status 1-Active, 2-Inactive
 * @property string $gm_createdon
 * @property int $gm_createdby
 * @property string $gm_updatedon
 * @property int $gm_updatedby
 *
 * @property ApplicationdtlshstyTbl[] $applicationdtlshstyTbls
 * @property ApplicationdtlsmainTbl[] $applicationdtlsmainTbls
 * @property ApplicationdtlstmpTbl[] $applicationdtlstmpTbls
 */
class GrademstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grademst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gm_gradename_en', 'gm_gradename_ar', 'gm_scorefrom', 'gm_scoreto', 'gm_scoreinpercent', 'gm_status', 'gm_createdby'], 'required'],
            [['gm_scorefrom', 'gm_scoreto', 'gm_scoreinpercent', 'gm_status', 'gm_createdby', 'gm_updatedby'], 'integer'],
            [['gm_createdon', 'gm_updatedon'], 'safe'],
            [['gm_gradename_en', 'gm_gradename_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'grademst_pk' => 'Grademst Pk',
            'gm_gradename_en' => 'Gm Gradename En',
            'gm_gradename_ar' => 'Gm Gradename Ar',
            'gm_scorefrom' => 'Gm Scorefrom',
            'gm_scoreto' => 'Gm Scoreto',
            'gm_scoreinpercent' => 'Gm Scoreinpercent',
            'gm_status' => 'Gm Status',
            'gm_createdon' => 'Gm Createdon',
            'gm_createdby' => 'Gm Createdby',
            'gm_updatedon' => 'Gm Updatedon',
            'gm_updatedby' => 'Gm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlshstyTbls()
    {
        return $this->hasMany(ApplicationdtlshstyTbl::className(), ['appdh_grademst_fk' => 'grademst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlsmainTbls()
    {
        return $this->hasMany(ApplicationdtlsmainTbl::className(), ['appdm_grademst_fk' => 'grademst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationdtlstmpTbls()
    {
        return $this->hasMany(ApplicationdtlstmpTbl::className(), ['appdt_grademst_fk' => 'grademst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return GrademstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrademstTblQuery(get_called_class());
    }

    public function getGradeMst(){
        $result = GrademstTbl::find()
        ->select(['*'])
        ->where('gm_status = :gm_status',[ ':gm_status' => 1])
        ->asArray()->all();
        return $result;
    }

    public function getGrades($sort)
    {
        $result =  self::find()->select(['OU.oum_firstname as createdBy','gm_createdon as createdOn', 'gm_gradename_ar as grade_ar','gm_gradename_en as grade', 'gm_scorefrom as fromPercentage', 'gm_scoreinpercent as percentageFromTotalValue', 'gm_scoreto as toPercentage', 'gm_status as status', 'OUU.oum_firstname as lastUpdatedBy', 'gm_updatedon as lastUpdatedOn', 'grademst_pk as id'])
        ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = gm_createdby')
        ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = gm_updatedby');
        if(!empty($sort)){
            if($sort['key'] == 'grade'){
                $result->orderby('gm_gradename_en '.$sort['dir']);
            }
            if($sort['key'] == 'percentageFromTotalValue'){
                $result->orderby('gm_scoreinpercent '.$sort['dir']);
            }
            if($sort['key'] == 'fromPercentage'){
                $result->orderby('gm_scorefrom '.$sort['dir']);
            }
            if($sort['key'] == 'toPercentage'){
                $result->orderby('gm_scoreto '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $result->orderby('gm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $result->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $result->orderby('gm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $result->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $result->orderby('gm_updatedon desc');
         }
         $data = $result->asArray()->all();
         return $data;
    }

    public function getgrade($id)
    {
        return self::findOne($id);
    }

    public function editGrade($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $grade = self::findOne($data['id']);

        $gradelogdata  = [
            'gmh_grademst_fk' => $grade->grademst_pk,
            'gmh_gradename_en' => $grade->gm_gradename_en,
            'gmh_gradename_ar' => $grade->gm_gradename_ar,
            'gmh_scorefrom' => $grade->gm_scorefrom,
            'gmh_scoreto' => $grade->gm_scoreto,
            'gmh_scoreinpercent' => $grade->gm_scoreinpercent,
            'gmh_status' => $grade->gm_status,
            'gmh_createdon' => $grade->gm_createdon,
            'gmh_createdby' => $grade->gm_createdby,
            'gmh_updatedon' => $grade->gm_updatedon,
            'gmh_updatedby' => $grade->gm_updatedby,
        ];
        $gradelog = new \app\models\GrademsthstyTbl($gradelogdata);
        if($gradelog->save()){

            $grade->gm_scorefrom = $data['fromPercentage'];
            $grade->gm_scoreto = $data['toPercentage'];
            $grade->gm_scoreinpercent = $data['percentageFromTotalValue'];
            $grade->gm_updatedon = date('Y-m-d H:i:s');
            $grade->gm_updatedby = $userPk;

            if($grade->save()){
                $transaction->commit();
                return $grade;
            }
            else{
                $transaction->rollBack();
                echo "<pre>4";
                print_r($grade->getErrors());
                die;
            }
        }
        else{
            $transaction->rollBack();
            echo "<pre>4";
            print_r($gradelog->getErrors());
            die;
        }
    }
}
