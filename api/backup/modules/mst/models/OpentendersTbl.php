<?php

namespace api\modules\mst\models; 

use Yii;
use yii\db\BaseActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "opentenders_tbl".
 *
 * @property int $opentenders_pk Primary key
 * @property array $ot_header
 * @property array $ot_tenddtls
 * @property array $ot_others
 * @property string $ot_createdon
 * @property int $ot_createdby
 * @property string $ot_createdbyipaddr
 */
class OpentendersTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opentenders_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ot_tenddtls', 'ot_createdon', 'ot_createdby'], 'required'],
            [['ot_header', 'ot_tenddtls', 'ot_others', 'ot_createdon'], 'safe'],
            [['ot_createdby'], 'integer'],
            [['ot_createdbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opentenders_pk' => 'Opentenders Pk',
            'ot_header' => 'Ot Header',
            'ot_tenddtls' => 'Ot Tenddtls',
            'ot_others' => 'Ot Others',
            'ot_createdon' => 'Ot Createdon',
            'ot_createdby' => 'Ot Createdby',
            'ot_createdbyipaddr' => 'Ot Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpentendersTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpentendersTblQuery(get_called_class());
    }
    
    public function inserTenders($tenders) { 
        $valid_tenders = $tenders['valid_arr'];
        $invalid_tenders = $tenders['invalid_arr']; 
      
        foreach($valid_tenders as $key => $value) { 
            $model=new OpentendersTbl;
            $tender_json = stripslashes(json_encode($value,JSON_UNESCAPED_SLASHES));
            $model->ot_tenddtls =$tender_json;
            $model->ot_createdon = date('Y-m-d H:i:s');
            $model->ot_createdby = 1; 
            $model->ot_header = '{"test":"1"}';
            $model->ot_others = '{"test":"1"}';
            if(!$model->save()) {
                $error[]=$model->getErrors();
            } 
        }
        return $error;
    }
}
