<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appoprcontracttmp_tbl".
 *
 * @property int $appoprcontracttmp_pk Primary Key
 * @property int $appoprct_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appoprct_operatorname Reference to referencemst_pk where rm_mastertype=2
 * @property int $appoprct_conttype 1-Contract, 2-sub contract
 * @property string $appoprct_contstartdate
 * @property string $appoprct_contenddate
 * @property string $appoprct_createdon
 * @property int $appoprct_createdby
 * @property string $appoprct_updatedon
 * @property int $appoprct_updatedby
 * @property int $appoprct_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appoprct_appdecon
 * @property int $appoprct_appdecby
 * @property string $appoprct_appdeccomment
 *
 * @property ApplicationdtlstmpTbl $appoprctApplicationdtlstmpFk
 */
class AppoprcontracttmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appoprcontracttmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appoprct_applicationdtlstmp_fk', 'appoprct_operatorname', 'appoprct_conttype', 'appoprct_contstartdate', 'appoprct_contenddate', 'appoprct_createdon', 'appoprct_createdby', 'appoprct_status'], 'required'],
            [['appoprct_applicationdtlstmp_fk', 'appoprct_operatorname', 'appoprct_conttype', 'appoprct_createdby', 'appoprct_updatedby', 'appoprct_status', 'appoprct_appdecby'], 'integer'],
            [['appoprct_contstartdate', 'appoprct_contenddate', 'appoprct_createdon', 'appoprct_updatedon', 'appoprct_appdecon'], 'safe'],
            [['appoprct_appdeccomment'], 'string'],
            [['appoprct_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appoprct_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appoprcontracttmp_pk' => 'Appoprcontracttmp Pk',
            'appoprct_applicationdtlstmp_fk' => 'Appoprct Applicationdtlstmp Fk',
            'appoprct_operatorname' => 'Appoprct Operatorname',
            'appoprct_conttype' => 'Appoprct Conttype',
            'appoprct_contstartdate' => 'Appoprct Contstartdate',
            'appoprct_contenddate' => 'Appoprct Contenddate',
            'appoprct_createdon' => 'Appoprct Createdon',
            'appoprct_createdby' => 'Appoprct Createdby',
            'appoprct_updatedon' => 'Appoprct Updatedon',
            'appoprct_updatedby' => 'Appoprct Updatedby',
            'appoprct_status' => 'Appoprct Status',
            'appoprct_appdecon' => 'Appoprct Appdecon',
            'appoprct_appdecby' => 'Appoprct Appdecby',
            'appoprct_appdeccomment' => 'Appoprct Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppoprctApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appoprct_applicationdtlstmp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppoprcontracttmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppoprcontracttmpTblQuery(get_called_class());
    }

    public static function saveOprContrCenter($requestdata){
        
        $model = new AppoprcontracttmpTbl();
        $model->appoprct_opalmemberregmst_fk = $requestdata['appoprct_opalmemberregmst_fk'];
        $model->appoprct_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        if(!empty($requestdata['opername_id'])){
            $model->appoprct_operatorname = $requestdata['opername_id'];
        }else{
            $model->appoprct_operatorname = AppoprcontracttmpTbl::saveRefMst($requestdata);
        }
        
        $model->appoprct_conttype = $requestdata['contract_typ'];
        $model->appoprct_contstartdate = date("Y-m-d", strtotime($requestdata['cont_strt']));
        $model->appoprct_contenddate = date("Y-m-d", strtotime($requestdata['cont_end']));
        $model->appoprct_status = 1;
        $model->appoprct_createdon = date("Y-m-d H:i:s");
        $model->appoprct_createdby = $requestdata['appoprct_createdby'];
         
        if($model->save()){
            return $model->appoprcontracttmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }


    public static function getOperatorDtlsFlt(){
        $requestParam = $_GET;
        ini_set ( 'max_execution_time', 1200);
        $query = self::find();
        $statusFilter = $requestParam['statusFilter'];

         $query->select(['*',
         'DATE_FORMAT(appoprct_createdon,"%d-%m-%Y") AS appoprct_createdon','DATE_FORMAT(appoprct_contstartdate,"%d-%m-%Y") AS appoprct_contstartdate','DATE_FORMAT(appoprct_contenddate,"%d-%m-%Y") AS appoprct_contenddate',
         'DATE_FORMAT(appoprct_updatedon,"%d-%m-%Y") AS appoprct_updatedon','rm_name_en','rm_name_ar','DATE_FORMAT(appoprct_appdecon,"%d-%m-%Y") AS appoprct_appdecon']);
         $query->leftJoin('referencemst_tbl  ref','ref.referencemst_pk = appoprcontracttmp_tbl.appoprct_operatorname');
         $query->leftJoin('applicationdtlstmp_tbl  appid','appid.applicationdtlstmp_pk = appoprct_applicationdtlstmp_fk');
         $query->where([
            'appoprct_applicationdtlstmp_fk'=> $requestParam['appid'],'rm_mastertype'=>'2',
        ]);
        if($requestParam['gridsearchValues'] != ''){

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
         
            $operatorname= $gridsearchValues['appoprct_operatorname'];
            $conttype = $gridsearchValues['appoprct_conttype'];
            $contractstartdate = $gridsearchValues['appoprct_contstartdate'];
            $contractenddate = $gridsearchValues['appoprct_contenddate'];
            $status = $gridsearchValues['appoprct_status'];
            $createdon = $gridsearchValues['appoprct_createdon'];
            $updatedon = $gridsearchValues['appoprct_updatedon'];
           

                    
        if($operatorname) //opertsor name filter
    {
            $query->andFilterWhere(['AND',
            ['LIKE', 'rm_name_en', $operatorname],
        ]);
    }
       
        // if($conttype) //Company Name filter
        // {
        //     $query->andFilterWhere(['AND',
        //     ['LIKE', 'appoprct_conttype', $conttype],
        // ]);
        // }


        if($conttype){  // contract type  Filter
            if(count($conttype) >1){
    
                $appcond ="";
               if(in_array(1, $conttype)){ //new
                   $appcond .= "appoprct_conttype='1' ||";
               }
               if(in_array(2, $conttype)){ //updated
                $appcond .= "appoprct_conttype='2' ||";
               }
             
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($conttype[0], [1,2,])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $conttype[0];
                   
                    $query->andWhere("appoprct_conttype='$pymt_sts'");
                }
            }
        }


        if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
        {
               $query->andFilterWhere(['between', 'date(appoprct_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
        }


        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
        {
               $query->andFilterWhere(['between', 'date(appoprct_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
        }


        if($contractstartdate && $contractstartdate['startDate']!=null && $contractstartdate['endDate']!=null)
        {
               $query->andFilterWhere(['between', 'date(appoprct_contstartdate)', date('Y-m-d',strtotime($contractstartdate['startDate'])), date('Y-m-d',strtotime($contractstartdate['endDate']))]);
        }

        if($contractenddate && $contractenddate['startDate']!=null && $contractenddate['endDate']!=null)
        {
               $query->andFilterWhere(['between', 'date(appoprct_contenddate)', date('Y-m-d',strtotime($contractenddate['startDate'])), date('Y-m-d',strtotime($contractenddate['endDate']))]);
        }
      
        // if($status && $status!=null )
        // {  
        //     //Submitted On Date Filter
        //    $query->andFilterWhere(['AND',
        //    ['LIKE', 'appoprct_status', $status],
        // ]);
         
        // }


        
        if($status){  // Status Filter
            if(count($status) >1){
    
                $appcond ="";
               if(in_array(1, $status)){ //new
                   $appcond .= "appoprct_status='1' ||";
               }
               if(in_array(2, $status)){ //updated
                $appcond .= "appoprct_status='2' ||";
               }
               if(in_array(3, $status)){ //Approved
                $appcond .= "appoprct_status='3' ||";
               }
               if(in_array(4, $status)){ //Declined
                $appcond .= "appoprct_status='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($status[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $status[0];
                   
                    $query->andWhere("appoprct_status='$pymt_sts'");
                }
            }
        }
        }

       // $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
          $sort_column = 'appoprcontracttmp_pk';
        // if($sort_column=='invoicedays')
        // {
        //     $sort_column='mcid.mcid_generatedon';
        // }
        // if($sort_column == 'MCM_JSRSRegistrationNo'){
        //     $sort_column = "cast(MCM_JSRSRegistrationNo as unsigned)";
        // }
       // $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
        
           // $query->orderBy(["$sort_column" => $order_by]);
           
        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
        $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
        $query->orderBy(["$sort_column" => $order_by]);
        $query->asArray();
        // echo '<pre>'; print_r($query); exit;
        // echo 'success'; exit;
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
       $raw = $query->createCommand()->getRawSql();
     
        $data = $provider->getModels();

        foreach ($provider->getModels() as $key => $favResData) {
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appoprct_appdecby']])->one();
            $histmodel     =   \app\models\AppoprcontracthstyTbl::find()->where("appoprch_Appoprcontracttmp_FK =:pk", [':pk' => $favResData['appoprcontracttmp_pk']])->orderBy(["AppOprContractHsty_PK" => SORT_DESC])->limit(2)->asArray()->all();
            $favData[$key] = $favResData;
            $favData[$key]['coverImages'] = $driveImg;
            $favData[$key]['hisstatus'] = $histmodel[1]['appoprch_Status'];
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['appoprct_updatedon'] = ($favResData['appoprct_updatedon'])?$favResData['appoprct_updatedon']:"-";
            $favData[$key]['status'] = ($favResData['appoprct_appdeccomment'])?$favResData['appoprct_appdeccomment']:'Nil';
           }

        $condata  =  \app\models\AppoprcontracttmpTbl::find()->where("appoprct_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
        foreach($condata as $key => $value){

            $docarray[] = $value['appoprct_status'];
        }
      

        if (count(array_unique($docarray)) === 1) {
            $datastatus=$docarray[0];
            } else {
            if(in_array(1, $docarray)){
                $datastatus=1;
            }else if(in_array(2, $docarray)){
                $datastatus=2;
            }
            else if(in_array(4,$docarray)){
                $datastatus=4;
            }
            else if(in_array(3,$docarray)){
                $datastatus=3;
            }
          }
          
        $response = array();
        $response['data'] = $favData;
        $response['appstatus'] = $datastatus;
        $response['appdt_apptype'] = $favData[0]['appdt_apptype'];
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
        
}
    public static function updateOprContrCenter($requestdata){
        
        //$model = new AppoprcontracttmpTbl();

        $resSts = AppoprcontracttmpTbl::changeStatus($requestdata['appoprcontracttmp_pk']);

        $model = AppoprcontracttmpTbl::find()->where(['appoprcontracttmp_pk' => $requestdata['appoprcontracttmp_pk']])->one();
        $model->appoprcontracttmp_pk = $requestdata['appoprcontracttmp_pk'];
        //$model->appoprct_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        if(!empty($requestdata['opername_id'])){
            $model->appoprct_operatorname = $requestdata['opername_id'];
        }else{
            $model->appoprct_operatorname = AppoprcontracttmpTbl::saveRefMst($requestdata);
        }
        $model->appoprct_conttype = $requestdata['contract_typ'];
        $model->appoprct_contstartdate = date("Y-m-d", strtotime($requestdata['cont_strt']));
        $model->appoprct_contenddate = date("Y-m-d", strtotime($requestdata['cont_end']));
        if(!empty($resSts)){
            $model->appoprct_status = 2;
            //$model->appoprct_appdeccomment = "";
        }
        
        $model->appoprct_updatedon = date("Y-m-d H:i:s");
        $model->appoprct_updatedby = $requestdata['appoprct_createdby'];
         
        if($model->save()){
            return $model->appoprcontracttmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }

    public static function getOprDtls($ipArray) {
        //echo '<pre>';print_r($ipArray);exit;
        if(!empty($ipArray['appdtlssavetmp_id']) && $ipArray['appdtlssavetmp_id'] != 'undefined'){
            $model = AppoprcontracttmpTbl::find()
                    ->select(['*','DATE_FORMAT(appoprct_contstartdate,"%d-%m-%Y") AS start_date',
                    'DATE_FORMAT(appoprct_contenddate,"%d-%m-%Y") AS end_date',
                    'DATE_FORMAT(appoprct_createdon,"%d-%m-%Y") AS created_on',
                    'DATE_FORMAT(appoprct_createdon,"%d-%m-%Y") AS created_on',
                    'DATE_FORMAT(appoprct_appdecon,"%d-%m-%Y") AS appdecon'])
                    ->leftJoin('referencemst_tbl ref','ref.referencemst_pk = appoprcontracttmp_tbl.appoprct_operatorname')
                    ->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appoprcontracttmp_tbl.appoprct_appdecby')
                    ->where("appoprct_applicationdtlstmp_fk =".$ipArray['appdtlssavetmp_id']);
            if($ipArray['gridsearchValues'] != ''){
                $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);  
                
                $operatorname = $gridsearchValues['operatorname'];
                $contracttype = $gridsearchValues['contracttype'];
                $contractstart = $gridsearchValues['contractstart'];
                $contractend = $gridsearchValues['contractend'];
                $Statusone = $gridsearchValues['Statusone'];
                $addedon = $gridsearchValues['addedon'];
                $lastUpdated = $gridsearchValues['lastUpdated'];
                                
                if($operatorname){
                    $model->andFilterWhere(['AND', ['LIKE', 'rm_name_en', $operatorname],]);
                }

                if($contracttype){
                    $model->andFilterWhere(['AND', ['LIKE', 'appoprct_conttype', $contracttype],]);
                }

                if($contractstart['startDate'] && $contractstart['endDate']){
                    $model->andFilterWhere(['between', 'date(appoprct_contstartdate)', date('Y-m-d',strtotime($contractstart['startDate'])), date('Y-m-d',strtotime($contractstart['endDate']))]);
                }
                
                if($contractend['startDate'] && $contractend['endDate']){
                    $model->andFilterWhere(['between', 'date(appoprct_contenddate)', date('Y-m-d',strtotime($contractend['startDate'])), date('Y-m-d',strtotime($contractend['endDate']))]);
                }

                if($Statusone){
                    $model->andFilterWhere(['AND',['IN', 'appoprct_status', $Statusone],]);
                }

                if($addedon['startDate'] && $addedon['endDate']){
                    $model->andFilterWhere(['between', 'date(appoprct_createdon)', date('Y-m-d',strtotime($addedon['startDate'])), date('Y-m-d',strtotime($addedon['endDate']))]);
                }

                if($lastUpdated['startDate'] && $lastUpdated['endDate']){
                    $model->andFilterWhere(['between', 'date(appoprct_updatedon)', date('Y-m-d',strtotime($lastUpdated['startDate'])), date('Y-m-d',strtotime($lastUpdated['endDate']))]);
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
            $response = array();
            $response['data'] = $data;
            $response['totalcount'] = $provider->getTotalCount();
            $response['size'] = $page;
            return $response;
        }else{
            $response = array();
            $response['data'] = "";
            $response['totalcount'] = "";
            $response['size'] = $page;
            return $response;
        } 
    }

    public static function saveRefMst($ipArray) {
        
        $model = new ReferencemstTbl();
        $model->rm_mastertype = 2;
        $model->rm_name_en = $ipArray['operator_name'];
        $model->srm_status = 2;
        $model->srm_createdon = date("Y-m-d H:i:s");
        $model->srm_createdby = $ipArray['appoprct_createdby'];
         
        if($model->save()){
            return $model->referencemst_pk;
        } else {
            echo "<pre>";var_dump($model->getErrors());exit;
        }  
    }

    public static function changeStatus($appDtlsPk){
        $model = AppoprcontracttmpTbl::find()
                ->select(['appoprct_status'])
                ->where("appoprcontracttmp_pk = $appDtlsPk")
                ->andWhere("appoprct_status = 2 OR appoprct_status = 3 OR appoprct_status = 4")
                ->asArray()
                ->one();

        if(!empty($model)){
            return true;
        }else{
            return false;
        } 
    }

    
}
