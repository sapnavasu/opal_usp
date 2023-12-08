<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grademsthsty_tbl".
 *
 * @property int $grademsthsty_pk
 * @property int $gmh_grademst_fk Reference to grademst_pk
 * @property string $gmh_gradename_en
 * @property string $gmh_gradename_ar
 * @property int $gmh_scorefrom
 * @property int $gmh_scoreto
 * @property int $gmh_scoreinpercent Grade score in percentage
 * @property int $gmh_status 1-Active, 2-Inactive
 * @property string $gmh_createdon
 * @property int $gmh_createdby
 * @property string $gmh_updatedon
 * @property int $gmh_updatedby
 *
 * @property GrademstTbl $gmhGrademstFk
 */
class GrademsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grademsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gmh_grademst_fk', 'gmh_gradename_en', 'gmh_gradename_ar', 'gmh_scorefrom', 'gmh_scoreto', 'gmh_scoreinpercent', 'gmh_status', 'gmh_createdon', 'gmh_createdby'], 'required'],
            [['gmh_grademst_fk', 'gmh_scorefrom', 'gmh_scoreto', 'gmh_scoreinpercent', 'gmh_status', 'gmh_createdby', 'gmh_updatedby'], 'integer'],
            [['gmh_createdon', 'gmh_updatedon'], 'safe'],
            [['gmh_gradename_en', 'gmh_gradename_ar'], 'string', 'max' => 100],
            [['gmh_grademst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GrademstTbl::className(), 'targetAttribute' => ['gmh_grademst_fk' => 'grademst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'grademsthsty_pk' => 'Grademsthsty Pk',
            'gmh_grademst_fk' => 'Gmh Grademst Fk',
            'gmh_gradename_en' => 'Gmh Gradename En',
            'gmh_gradename_ar' => 'Gmh Gradename Ar',
            'gmh_scorefrom' => 'Gmh Scorefrom',
            'gmh_scoreto' => 'Gmh Scoreto',
            'gmh_scoreinpercent' => 'Gmh Scoreinpercent',
            'gmh_status' => 'Gmh Status',
            'gmh_createdon' => 'Gmh Createdon',
            'gmh_createdby' => 'Gmh Createdby',
            'gmh_updatedon' => 'Gmh Updatedon',
            'gmh_updatedby' => 'Gmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGmhGrademstFk()
    {
        return $this->hasOne(GrademstTbl::className(), ['grademst_pk' => 'gmh_grademst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return GrademsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GrademsthstyTblQuery(get_called_class());
    }

    public function getGradelog($id, $sort)
    {
        $result =  self::find()
        ->select(['OU.oum_firstname as lastUpdatedBy','gmh_updatedon as lastUpdatedOn', 'gmh_gradename_ar as grade_ar','gmh_gradename_en as grade', 'gmh_scorefrom as fromPercentage', 'gmh_scoreinpercent as percentageFromTotalValue', 'gmh_scoreto as toPercentage', 'gmh_status as status', 'grademsthsty_pk as id', 'gmh_grademst_fk'])
        ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = gmh_updatedby')
        ->where(['=','gmh_grademst_fk', $id]);
        
        if(!empty($sort)){
            if($sort['key'] == 'grade'){
                $result->orderby('gmh_gradename_en '.$sort['dir']);
            }
            if($sort['key'] == 'percentageFromTotalValue'){
                $result->orderby('gmh_scoreinpercent '.$sort['dir']);
            }
            if($sort['key'] == 'fromPercentage'){
                $result->orderby('gmh_scorefrom '.$sort['dir']);
            }
            if($sort['key'] == 'toPercentage'){
                $result->orderby('gmh_scoreto '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $result->orderby('gmh_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $result->orderby('OU.oum_firstname '.$sort['dir']);
            }
         }else{
            $result->orderby('gmh_updatedon desc');
         }

         $data = $result->asArray()->all();
         return $data;
    }
}
