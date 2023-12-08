<?php

namespace api\modules\tend\models; 

use Yii;
use yii\db\BaseActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use \common\components\Security;
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
    public static function listtenders(){
            $query = OpentendersTbl::find();
            $query->select(['*'])
            ->orderBy(['ot_createdon' => SORT_DESC])
            ->asArray()
            ->all();
            if($_REQUEST['type']=='filter') {
                $joined['address'] = 0;
                unset($_REQUEST['type']);
                unset($_REQUEST['sort']);
                unset($_REQUEST['order']);
                unset($_REQUEST['page']);
                unset($_REQUEST['size']);
                $stringFields=['FileName','TenderName','BidderName'];
                $stringFieldswithaddress=['address','BidderName'];
                
                foreach($_REQUEST as $key =>$val) {
                    if(in_array($key ,$stringFields))
                    {
                        if(isset($_REQUEST[$key]) && !empty($_REQUEST[$key]))
                        {
                            if(in_array($key ,$stringFieldswithaddress) && !$joined['address'])
                            {
                                $query->leftJoin(OpentendersaddrTbl::Tablename() ,'opentendersaddr_tbl.ota_opentenders_fk=opentenders_tbl.opentenders_pk');
                                $joined['address'] =1;
                                $test='$.'.$key;
                                $query->andFilterWhere(['LIKE', "json_extract(ot_tenddtls,'$test')",':param'.$key, [':param'.$key=>Security::sanitizeInput($_REQUEST[$key],"string")]]);    
                            }
                            $test='$.'.$key;
                            $query->andFilterWhere(['LIKE', "json_extract(ot_tenddtls,'$test')",':param'.$key, [':param'.$key=>Security::sanitizeInput($_REQUEST[$key],"string")]]);
                        }
                    }
                }
                
            }
            
            $page=(isset($_GET['size']))?$_GET['size']: $this->default_table_row_size;
            $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
    
            return [
                'items' => $provider->getModels(),
                'total_count' => $provider->getTotalCount(),
                'limit' =>10,
            ];
        
    }
    public static function View($id){
        $tender = OpentendersTbl::find()->where([
            'opentenders_pk' => $id
        ])->one();

        if($tender){
            return $tender;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
}
