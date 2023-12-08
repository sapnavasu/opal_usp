<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
/**
 * This is the model class for table "incorpstylemst_tbl".
 *
 * @property int $IncorpStyleMst_Pk Primary key
 * @property int $ISM_CountryMst_Fk Reference to countrymst_tbl
 * @property string $ISM_IncorpStyleEntity Incorporation style entity in short form
 * @property string $ISM_IncorpStyleBrief Incorporation style entity in brief
 * @property string $ISM_Status Incorporation style statue. A - Active, I - Inactive
 */
class IncorpMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'incorpstylemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ISM_CountryMst_Fk', 'ISM_IncorpStyleEntity'], 'required'],
            [['ISM_CountryMst_Fk'], 'integer'],
            [['ISM_IncorpStyleBrief', 'ISM_Status'], 'string'],
            [['ISM_IncorpStyleEntity'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IncorpStyleMst_Pk' => 'Incorp Style Mst  Pk',
            'ISM_CountryMst_Fk' => 'Ism  Country Mst  Fk',
            'ISM_IncorpStyleEntity' => 'Ism  Incorp Style Entity',
            'ISM_IncorpStyleBrief' => 'Ism  Incorp Style Brief',
            'ISM_Status' => 'Ism  Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CountryMasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountryMasterQuery(get_called_class());
    }
    
    public static function isAlreadyAvailable($colName,$colVal,$pk = ''){
        return self::find()
                ->where([$colName => $colVal])
                ->andFilterWhere(['<>','incorpstylemst_pk',$pk])
                ->exists();
    }
}