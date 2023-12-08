<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "statemst_tbl".
 *
 * @property int $StateMst_Pk
 * @property int $SM_CountryMst_Fk
 * @property string $SM_StateName_en
 * @property string $SM_Status
 * @property string $SM_CreatedOn
 * @property int $SM_CreatedBy
 * @property string $SM_UpdatedOn
 * @property int $SM_UpdatedBy
 */
class StatemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SM_CountryMst_Fk', 'SM_StateName_en', 'SM_Status'], 'required'],
            [['SM_CountryMst_Fk', 'SM_CreatedBy', 'SM_UpdatedBy'], 'integer'],
            //[['SM_Status'], 'string'],
            [['SM_CreatedOn', 'SM_UpdatedOn'], 'safe'],
            [['SM_StateName_en'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'StateMst_Pk' => 'State Mst  Pk',
            'SM_CountryMst_Fk' => 'Sm  Country Mst  Fk',
            'SM_StateName_en' => 'Sm  State Name',
            'SM_Status' => 'Sm  Status',
            'SM_CreatedOn' => 'Sm  Created On',
            'SM_CreatedBy' => 'Sm  Created By',
            'SM_UpdatedOn' => 'Sm  Updated On',
            'SM_UpdatedBy' => 'Sm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StatemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatemstTblQuery(get_called_class());
    }
	
	     /** @inheritdoc */
    public function behaviors()
    {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
                [
                     'class' => TimeBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['SM_CreatedOn'],
                         ActiveRecord::EVENT_BEFORE_UPDATE => ['SM_UpdatedOn'],
                     ],
                 ],
                [
                     'class' => UserBehavior::className(),
                     'attributes' => [
                         ActiveRecord::EVENT_BEFORE_INSERT => ['SM_CreatedBy'],
//                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                     ],
                 ],
        ];
    }
    
    public static function getStatesForRegAsOptions($countrypk) {
        $data = self::find()
                ->select(['StateMst_Pk','SM_StateName_en'])
                ->where(['sm_status' => 'A','sm_countrymst_fk' => $countrypk])
                ->orderBy(['SM_StateName_en' => SORT_ASC])
                ->asArray()->all();
        $response = '<option></option>';
        foreach($data as $val) {
            $response .= "<option value='{$val['StateMst_Pk']}'>{$val['SM_StateName_en']}</option>";
        }
        return $response;
    }
    
    public static function addNewState($countrypk,$statename) {
        $data = self::find()
                ->select(['StateMst_Pk','SM_StateName_en','SM_StateName_ar'])
                ->where(['sm_countrymst_fk' => $countrypk])
                ->andWhere(['OR',
                    ['LIKE','trim(lower(SM_StateName_en))', trim(strtolower($statename))],
                    ['LIKE','trim(lower(SM_StateName_ar))',  trim(strtolower($statename))]
                ])
                ->orderBy(['SM_StateName_en' => SORT_ASC])
                ->asArray()->one();

        if($data)
        {
           $response = $data['StateMst_Pk'];
}
        else
        {
            $model = new StatemstTbl;
            $model->SM_StateName_en = $statename ;
            $model->SM_CountryMst_Fk = $countrypk;
            $model->SM_Status = 'I';
            
            if(!$model->save())
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
            else
            {
                return $model->StateMst_Pk;
            }
                    
        }
        return $response;
    }
}
