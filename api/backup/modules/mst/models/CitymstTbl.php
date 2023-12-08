<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "citymst_tbl".
 *
 * @property int $CityMst_Pk
 * @property int $CM_CountryMst_Fk
 * @property int $CM_StateMst_Fk
 * @property string $CM_CityName_en
 * @property string $CM_Status
 * @property string $CM_CreatedOn
 * @property int $CM_CreatedBy
 * @property string $CM_UpdatedOn
 * @property int $CM_UpdatedBy
 *
 * @property AreamstTbl[] $areamstTbls
 * @property CountrymstTbl $cMCountryMstFk
 * @property StatemstTbl $cMStateMstFk
 */
class CitymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'citymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CM_CountryMst_Fk', 'CM_StateMst_Fk', 'CM_CreatedBy', 'CM_UpdatedBy'], 'integer'],
            [['CM_CityName_en', 'CM_CreatedOn', 'CM_CreatedBy'], 'required'],
            [['CM_Status'], 'string'],
            [['CM_CreatedOn', 'CM_UpdatedOn'], 'safe'],
            [['CM_CityName_en'], 'string', 'max' => 150],
            [['CM_CountryMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\CountryMaster::className(), 'targetAttribute' => ['CM_CountryMst_Fk' => 'CountryMst_Pk']],
            [['CM_StateMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => StatemstTbl::className(), 'targetAttribute' => ['CM_StateMst_Fk' => 'StateMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CityMst_Pk' => 'City Mst  Pk',
            'CM_CountryMst_Fk' => 'Cm  Country Mst  Fk',
            'CM_StateMst_Fk' => 'Cm  State Mst  Fk',
            'CM_CityName_en' => 'Cm  City Name',
            'CM_Status' => 'Cm  Status',
            'CM_CreatedOn' => 'Cm  Created On',
            'CM_CreatedBy' => 'Cm  Created By',
            'CM_UpdatedOn' => 'Cm  Updated On',
            'CM_UpdatedBy' => 'Cm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAreamstTbls()
    {
        return $this->hasMany(AreamstTbl::className(), ['am_citymst_fk' => 'CityMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCMCountryMstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'CM_CountryMst_Fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCMStateMstFk()
    {
        return $this->hasOne(StatemstTbl::className(), ['StateMst_Pk' => 'CM_StateMst_Fk']);
    }
    
    public static function getCitiesForRegAsOptions($statepk) {
        $data = self::find()
                ->select(['citymst_pk','CM_CityName_en'])
                ->where(['cm_status' => 'A','cm_statemst_fk' => $statepk])
                ->orderBy(['CM_CityName_en' => SORT_ASC])
                ->asArray()->all();
        $response = '<option></option>';
        foreach($data as $val) {
            $response .= "<option value='{$val['citymst_pk']}'>{$val['CM_CityName_en']}</option>";
        }
        return $response;
    }
    
    public static function addNewCity($countrypk,$statepk,$cityname,$userpk) {
        
        $data = self::find()
                ->select(['CityMst_Pk','CM_CityName_en'])
                ->where(['CM_CountryMst_Fk' => $countrypk,'cm_statemst_fk' => $statepk])
                ->andWhere(['OR',
                    ['LIKE','trim(lower(CM_CityName_en))', trim(strtolower($cityname))],
                    ['LIKE','trim(lower(CM_CityName_ar))',  trim(strtolower($cityname))]
                ])
                ->orderBy(['CM_CityName_en' => SORT_ASC])
                ->asArray()->one();
        
        if($data)
        {
           $response = $data['CityMst_Pk'];
        }
        else
        {
            $model = new CitymstTbl;
            $model->CM_CityName_en = $cityname;
            $model->CM_CountryMst_Fk = $countrypk;
            $model->CM_StateMst_Fk = $statepk;
            $model->CM_Status = 'I';
            $model->CM_CreatedBy = $userpk;
            $model->CM_CreatedOn = date('Y-m-d H:i:s');
            
            if(!$model->save())
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
            else
            {
                return $model->CityMst_Pk;
            }
                    
        }
        return $response;
    }
}
