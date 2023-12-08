<?php

namespace app\models;

use Yii;
use \yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use api\components\Drive;

/**
 * This is the model class for table "appintrecogtmp_tbl".
 *
 * @property int $appintrecogtmp_pk Primary Key
 * @property int $appintit_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appintit_intnatrecogmst_fk
 * @property string $appintit_lastauditdate
 * @property string $appintit_doc
 * @property string $appintit_createdon
 * @property int $appintit_createdby
 * @property string $appintit_updatedon
 * @property int $appintit_updatedby
 * @property int $appintit_status
 * @property string $appintit_appdecon
 * @property int $appintit_appdecby
 * @property string $appintit_appdeccomment
 *
 * @property ApplicationdtlstmpTbl $appintitApplicationdtlstmpFk
 * @property IntnatrecogmstTbl $appintitIntnatrecogmstFk
 */
class AppintrecogtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appintrecogtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appintit_applicationdtlstmp_fk', 'appintit_intnatrecogmst_fk', 'appintit_lastauditdate', 'appintit_doc', 'appintit_createdon', 'appintit_createdby', 'appintit_status'], 'required'],
            [['appintit_applicationdtlstmp_fk', 'appintit_intnatrecogmst_fk', 'appintit_createdby', 'appintit_updatedby', 'appintit_status', 'appintit_appdecby'], 'integer'],
            [['appintit_lastauditdate', 'appintit_createdon', 'appintit_updatedon', 'appintit_appdecon'], 'safe'],
            [['appintit_appdeccomment'], 'string'],
         //   [['appintit_doc'], 'string', 'max' => 255],
            //[['appintit_doc'], 'string', 'max' => 255],
            [['appintit_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appintit_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appintit_intnatrecogmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IntnatrecogmstTbl::className(), 'targetAttribute' => ['appintit_intnatrecogmst_fk' => 'intnatrecogmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appintrecogtmp_pk' => 'Appintrecogtmp Pk',
            'appintit_applicationdtlstmp_fk' => 'Appintit Applicationdtlstmp Fk',
            'appintit_intnatrecogmst_fk' => 'Appintit Intnatrecogmst Fk',
            'appintit_lastauditdate' => 'Appintit Lastauditdate',
            'appintit_doc' => 'Appintit Doc',
            'appintit_createdon' => 'Appintit Createdon',
            'appintit_createdby' => 'Appintit Createdby',
            'appintit_updatedon' => 'Appintit Updatedon',
            'appintit_updatedby' => 'Appintit Updatedby',
            'appintit_status' => 'Appintit Status',
            'appintit_appdecon' => 'Appintit Appdecon',
            'appintit_appdecby' => 'Appintit Appdecby',
            'appintit_appdeccomment' => 'Appintit Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintitApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appintit_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintitIntnatrecogmstFk()
    {
        return $this->hasOne(IntnatrecogmstTbl::className(), ['intnatrecogmst_pk' => 'appintit_intnatrecogmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppintrecogtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppintrecogtmpTblQuery(get_called_class());
    }

    public static function saveInsRecDtls($requestdata){
        //echo '<pre>';print_r($requestdata);exit;
        $model = new AppintrecogtmpTbl();
        $model->appintit_opalmemberregmst_fk = $companyPk = \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk',true);
        $model->appintit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        $model->appintit_intnatrecogmst_fk = $requestdata['award_organ'];
        $model->appintit_lastauditdate = date("Y-m-d", strtotime($requestdata['last_audit']));

        // $org="";
        // if(is_array($requestdata['file_award'])){
        //     $org=$requestdata['file_award'];
        // }else{
        //     $org=$requestdata['file_award'];
        // }
        if(count($requestdata['file_award']) == 1){
            $model->appintit_doc = $requestdata['file_award'][0];
        }

        if(count($requestdata['file_award']) == 2){
            $model->appintit_doc = $requestdata['file_award'][1];
        }
        
        $model->appintit_status = 1;
        $model->appintit_createdon = date("Y-m-d H:i:s");
        $model->appintit_createdby = $requestdata['appintit_createdby'];
         
        if($model->save()){
            return $model->appintrecogtmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }

    public static function updateInsRecDtls($requestdata){
        //echo '<pre>';print_r($requestdata);exit;
        $resSts = AppintrecogtmpTbl::changeStatus($requestdata['appintrecogtmp_pk']);
        
        $model = AppintrecogtmpTbl::find()->where(['appintrecogtmp_pk' => $requestdata['appintrecogtmp_pk']])->one();
        $model->appintrecogtmp_pk = $requestdata['appintrecogtmp_pk'];
        //$model->appintit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        $model->appintit_intnatrecogmst_fk = $requestdata['award_organ'];
        $model->appintit_lastauditdate = date("Y-m-d", strtotime($requestdata['last_audit']));

        if(count($requestdata['file_award']) == 1){
            $model->appintit_doc = $requestdata['file_award'][0];
        }

        if(count($requestdata['file_award']) == 2){
            $model->appintit_doc = $requestdata['file_award'][1];
        }
            
        

        if(!empty($resSts)){
            $model->appintit_status = 2;
            //$model->appintit_appdeccomment = "";
        }
        //$model->appintit_status = 1;
        $model->appintit_updatedon = date("Y-m-d H:i:s");
        $model->appintit_updatedby = $requestdata['appintit_createdby'];
         
        if($model->save()){
            return $model->appintrecogtmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }

    public static function getInterRecDtls($ipArray) {
       
       //echo "<pre>";print_r($ipArray);exit;
       //$userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       
       $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
       $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
       $provider="";
       if(!empty($ipArray['appdtlssavetmp_id']) && $ipArray['appdtlssavetmp_id'] != 'undefined'){

        $model = AppintrecogtmpTbl::find()
                ->select(['*','DATE_FORMAT(appintit_lastauditdate,"%d-%m-%Y") AS last_aud',
                'DATE_FORMAT(appintit_lastauditdate,"%d-%m-%Y") AS last_aud',
                'DATE_FORMAT(appintit_createdon,"%d-%m-%Y") AS created_on',
                'DATE_FORMAT(appintit_appdecon,"%d-%m-%Y") AS appdecon',
                'DATE_FORMAT(appintit_updatedon,"%d-%m-%Y") AS updated_on'])
                ->leftJoin('intnatrecogmst_tbl rec','rec.intnatrecogmst_pk = appintrecogtmp_tbl.appintit_intnatrecogmst_fk')
                ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appintrecogtmp_tbl.appintit_appdecby')
                ->where("appintit_applicationdtlstmp_fk =".$ipArray['appdtlssavetmp_id']);
                if($ipArray['gridsearchValues'] != ''){
                        $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);  
                        
                        $Awarding = $gridsearchValues['Awarding'];
                        $LastAudited = $gridsearchValues['LastAudited'];
                        $Status = $gridsearchValues['Status'];
                        $Addedon = $gridsearchValues['Addedon'];
                        $LastUpdated = $gridsearchValues['LastUpdated'];
                                        
                        if($Awarding){
                            $model->andFilterWhere(['AND', ['LIKE', 'irm_intlrecogname_en', $Awarding],]);
                        }
                        
                        if($LastAudited['startDate'] && $LastAudited['endDate']){
                            $model->andFilterWhere(['between', 'date(appintit_lastauditdate)', date('Y-m-d',strtotime($LastAudited['startDate']. " +1 day")), date('Y-m-d',strtotime($LastAudited['endDate']. " +1 day"))]);
                        }

                        if($Status){
                            $model->andFilterWhere(['AND',['IN', 'appintit_status', $Status],]);
                        }
                        
                        if($Addedon['startDate'] && $Addedon['endDate']){
                            $model->andFilterWhere(['between', 'date(appintit_createdon)', date('Y-m-d',strtotime($Addedon['startDate']. " +1 day")), date('Y-m-d',strtotime($Addedon['endDate']. " +1 day"))]);
                        }

                        if($LastUpdated['startDate'] && $LastUpdated['endDate']){
                            $model->andFilterWhere(['between', 'date(appintit_updatedon)', date('Y-m-d',strtotime($LastUpdated['startDate']. " +1 day")), date('Y-m-d',strtotime($LastUpdated['endDate']. " +1 day"))]);
                        }
                }
            $sort_column = (strpos($ipArray['sort'],"-") !== false) ? explode("-",$ipArray['sort'])[1] : $ipArray['sort'];
            $order_by = ($ipArray['order']=='asc')? 'asc': 'desc';
            $model->orderBy("$sort_column $order_by");
            $model->asArray();
            $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10 ;  
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $ipArray['page']
                ],
            ]);

            $data = $provider->getModels();
            //echo '<pre>';print_r($data);exit;
            $finalArray = array();
            foreach($data as $dataInfo){
                $resAry=$dataInfo;
                    $resAry['docUrl']= \api\components\Drive::generateUrl($dataInfo['appintit_doc'],$companyPk,$userPk);
                    $resAry['fileName']= \api\components\Drive::getFileName(\api\components\Security::encrypt($dataInfo['appintit_doc']));
                    $resAry['ext']= pathinfo($resAry['fileName'],PATHINFO_EXTENSION);
                    $resAry['flePk']= \api\components\Drive::getFileName(\api\components\Security::encrypt($dataInfo['appintit_doc']));
                    
                    $finalAry[]=$resAry;
            }

            $response = array();
            $response['data'] = $finalAry;
            $response['totalcount'] = $provider->getTotalCount();
            $response['size'] = $page;
            return $response;
        } else {
            
            $response = array();
            $response['data'] ="";
            $response['totalcount'] = "";
            $response['size'] = $page;
            return $response;
        }



        
 
   }

   public static function getInterRecDtlsFlt($appid , $pageSize , $page, $keyword='',$requestParam ,$sort , $order){
     
    $favQuery = AppintrecogtmpTbl::find();

        $favQuery->select([
            '*',
            'DATE_FORMAT(appintit_lastauditdate,"%d-%m-%Y") AS last_aud',
            'DATE_FORMAT(appintit_createdon,"%d-%m-%Y") AS created_on',
            'DATE_FORMAT(appintit_updatedon,"%d-%m-%Y") AS updated_on' , 'DATE_FORMAT(appintit_appdecon,"%d-%m-%Y") AS appintit_appdecon'
                ])
                ->leftJoin('intnatrecogmst_tbl rec','rec.intnatrecogmst_pk = appintrecogtmp_tbl.appintit_intnatrecogmst_fk')
                ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = appintit_doc')
                ->leftJoin('applicationdtlstmp_tbl  appid','appid.applicationdtlstmp_pk = appintit_applicationdtlstmp_fk');
                
    

    $favQuery->where([
                    'appintit_applicationdtlstmp_fk'=> $appid,
                ]);

    if(!empty($keyword)){
            $favQuery->andWhere(['OR',
                ['OR LIKE','MCM_CompanyName',$keyword],
                ['OR LIKE','UM_EmpId',$keyword],
                ['OR LIKE','REPLACE(concat_ws(" ",um_firstname, um_middlename, um_lastname),"  "," ")',$keyword]
            ]);
        
    }

   
    if($requestParam != ''){
       $gridsearchValues = json_decode($requestParam,true); 
      
      
        $awrd = $gridsearchValues['irm_intlrecogname_en'];
        $auditon = $gridsearchValues['appintit_lastauditdate'];
        $status = $gridsearchValues['appintit_status'];
        $createdon = $gridsearchValues['appintit_createdon'];
        $updatedon = $gridsearchValues['appintit_updatedon'];
      
              
    if($awrd) //awrd filter
{
        $favQuery->andWhere(['AND',
        ['LIKE', 'irm_intlrecogname_en', $awrd],
    ]);
}


    if($auditon && $auditon['startDate']!=null && $auditon['endDate']!=null)
    {
           $favQuery->andFilterWhere(['between', 'date(appintit_lastauditdate)', date('Y-m-d',strtotime($auditon['startDate'])), date('Y-m-d',strtotime($auditon['endDate']))]);
    }
  

    if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
    {
           $favQuery->andFilterWhere(['between', 'date(appintit_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
    }


        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
        {
               $favQuery->andFilterWhere(['between', 'date(appintit_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
        }

      

        if($status){  // Status Filter
            if(count($status) >1){
    
                $appcond ="";
               if(in_array(1, $status)){ //new
                   $appcond .= "appintit_status='1' ||";
               }
               if(in_array(2, $status)){ //updated
                $appcond .= "appintit_status='2' ||";
               }
               if(in_array(3, $status)){ //Approved
                $appcond .= "appintit_status='3' ||";
               }
               if(in_array(4, $status)){ //Declined
                $appcond .= "appintit_status='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $favQuery->andWhere($paymentstscond);
            }else{
                if(in_array($status[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $status[0];
                    $favQuery->andWhere("appintit_status='$pymt_sts' ");
                }
            }
        }

      

}


  $sort_column = (strpos($sort,"-") !== false) ? explode("-",$sort)[1] : $sort;   
  $favQry = $favQuery->orderBy(["$sort_column" => $order_by])->asArray();          
  $raw = $favQuery->createCommand()->getRawSql();
                

    $favProvider = new ActiveDataProvider([
        'query' => $favQry,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
    ]);

    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
    $favData = [];
    foreach ($favProvider->getModels() as $key => $favResData) {
        $driveImg      =   \api\components\Drive::generateUrl($favResData['appintit_doc'],$companypk,$userpk);
        $model        =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appintit_appdecby']])->one();
        $histmodel     =   \app\models\AppintrecoghstyTbl::find()->where("appintih_AppIntRecogTmp_FK =:pk", [':pk' => $favResData['appintrecogtmp_pk']])->orderBy(["AppIntRecogHsty_PK" => SORT_DESC])->limit(2)->asArray()->all();
    
        $favData[$key] = $favResData;
        $favData[$key]['coverImg'] = $driveImg;
        $favData[$key]['hisstatus'] = $histmodel[1]['appintih_Status'];
        $favData[$key]['username'] = $model['oum_firstname'];
        $favData[$key]['updated_on'] = ($favResData['updated_on'])?$favResData['updated_on']:"-";
        $favData[$key]['appintit_updatedby'] = ($favResData['appintit_updatedby'])?$favResData['appintit_updatedby']:"-";
        $favData[$key]['status'] = ($favResData['appintit_appdeccomment'])?$favResData['appintit_appdeccomment']:'Nil';
    }
    $data = $favProvider->getModels();

    $interdata  =  \app\models\AppintrecogtmpTbl::find()->where("appintit_applicationdtlstmp_fk =:pk", [':pk' => $appid])->asArray()->All();
    foreach($interdata as $key => $value){

        $interarray[] = $value['appintit_status'];
    }

    if (count(array_unique($interarray)) === 1) {
        $datastatus=$interarray[0];
      } else {
        if(in_array(1,$interarray)){
            $datastatus=1;

        }
        else if(in_array(2,$interarray)){
            $datastatus=2;

        }elseif(in_array(4,$interarray)){
            $datastatus=4;

        }elseif(in_array(3,$interarray)){
            $datastatus=3;

        }
      }
    $favouriteRes['data'] = $favData;
    $favouriteRes['appstatus'] = $datastatus;
    $favouriteRes['appdt_apptype'] = $favData[0]['appdt_apptype'];
    $favouriteRes['totalcount'] = $favProvider->getTotalCount();
    $favouriteRes['size'] = $pageSize;
    $favouriteRes['page'] = $page;

    return $favouriteRes;
}

public static function changeStatus($appDtlsPk){
    
    $model = AppintrecogtmpTbl::find()
            ->select(['appintit_status'])
            ->where("appintrecogtmp_pk = $appDtlsPk")
            ->andWhere("appintit_status = 2 OR appintit_status = 3 OR appintit_status = 4")
            ->asArray()
            ->one();
    
    if(!empty($model)){
        return true;
    }else{
        return false;
    } 
}
}
