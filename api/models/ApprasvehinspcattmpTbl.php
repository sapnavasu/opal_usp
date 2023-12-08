<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apprasvehinspcattmp_tbl".
 *
 * @property int $apprasvehinspcattmp_pk
 * @property int $arvict_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $arvict_appinstinfotmp_fk Reference to appinstinfotmp_pk
 * @property int $arvict_rascategorymst_fk Reference to rascategorymst_pk
 * @property string $arvict_createdon
 * @property int $arvict_createdby
 * @property string $arvict_updatedon
 * @property int $arvict_updatedby
 * @property int $arvict_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $arvict_appdecon
 * @property int $arvict_appdecby
 * @property string $arvict_appdecComments
 *
 * @property ApprasvehinspcathstyTbl[] $apprasvehinspcathstyTbls
 * @property ApprasvehinspcatmainTbl[] $apprasvehinspcatmainTbls
 * @property AppinstinfotmpTbl $arvictAppinstinfotmpFk
 * @property ApplicationdtlstmpTbl $arvictApplicationdtlstmpFk
 * @property RascategorymstTbl $arvictRascategorymstFk
 */
class ApprasvehinspcattmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apprasvehinspcattmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arvict_applicationdtlstmp_fk', 'arvict_appinstinfotmp_fk', 'arvict_rascategorymst_fk', 'arvict_createdby', 'arvict_status'], 'required'],
            [['arvict_applicationdtlstmp_fk', 'arvict_appinstinfotmp_fk', 'arvict_rascategorymst_fk', 'arvict_createdby', 'arvict_updatedby', 'arvict_status', 'arvict_appdecby'], 'integer'],
            [['arvict_createdon', 'arvict_updatedon', 'arvict_appdecon'], 'safe'],
            [['arvict_appdecComments'], 'string'],
            [['arvict_appinstinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfotmpTbl::className(), 'targetAttribute' => ['arvict_appinstinfotmp_fk' => 'appinstinfotmp_pk']],
            [['arvict_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['arvict_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['arvict_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['arvict_rascategorymst_fk' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apprasvehinspcattmp_pk' => 'Apprasvehinspcattmp Pk',
            'arvict_applicationdtlstmp_fk' => 'Arvict Applicationdtlstmp Fk',
            'arvict_appinstinfotmp_fk' => 'Arvict Appinstinfotmp Fk',
            'arvict_rascategorymst_fk' => 'Arvict Rascategorymst Fk',
            'arvict_createdon' => 'Arvict Createdon',
            'arvict_createdby' => 'Arvict Createdby',
            'arvict_updatedon' => 'Arvict Updatedon',
            'arvict_updatedby' => 'Arvict Updatedby',
            'arvict_status' => 'Arvict Status',
            'arvict_appdecon' => 'Arvict Appdecon',
            'arvict_appdecby' => 'Arvict Appdecby',
            'arvict_appdecComments' => 'Arvict Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprasvehinspcathstyTbls()
    {
        return $this->hasMany(ApprasvehinspcathstyTbl::className(), ['arvich_apprasvehinspcattmp_fk' => 'apprasvehinspcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApprasvehinspcatmainTbls()
    {
        return $this->hasMany(ApprasvehinspcatmainTbl::className(), ['arvicm_apprasvehinspcattmp_fk' => 'apprasvehinspcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvictAppinstinfotmpFk()
    {
        return $this->hasOne(AppinstinfotmpTbl::className(), ['appinstinfotmp_pk' => 'arvict_appinstinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvictApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'arvict_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArvictRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'arvict_rascategorymst_fk']);
    }

    
    public static function getInspection(){
        $requestParam = $_GET;
        ini_set ( 'max_execution_time', 1200);
        $query = self::find();
        $statusFilter = $requestParam['statusFilter'];

         $query->select(['*']);
         $query->leftJoin('rascategorymst_tbl  category','category.rascategorymst_pk = arvict_rascategorymst_fk');
         $query->leftJoin('applicationdtlstmp_tbl  appid','appid.applicationdtlstmp_pk = arvict_applicationdtlstmp_fk');
         $query->where([
            'arvict_applicationdtlstmp_fk'=> $requestParam['appid']
        ]);
        if($requestParam['gridsearchValues'] != ''){

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
            $inspectionname= $gridsearchValues['arvict_rascategorymst_fk'];
            $status = $gridsearchValues['arvict_status'];
            $createdon = $gridsearchValues['arvict_createdon'];
            $updatedon = $gridsearchValues['arvict_updatedon'];
        

            if($inspectionname) //opertsor name filter
    {
            $query->andFilterWhere(['AND',
            ['LIKE', 'rcm_coursesubcatname_en', $inspectionname],
        ]);
    }           

 

        if($status){  // Status Filter
            if(count($status) >1){
                $appcond ="";
               if(in_array(1, $status)){ //new
                   $appcond .= "arvict_status='1' ||";
               }
               if(in_array(2, $status)){ //updated
                $appcond .= "arvict_status='5' ||";
               }
               if(in_array(3, $status)){ //Approved
                $appcond .= "arvict_status='3' ||";
               }
               if(in_array(4, $status)){ //Declined
                $appcond .= "arvict_status='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($status[0], [1,2,3,5])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $status[0];
                    $query->andWhere("arvict_status='$pymt_sts' ");
                }
            }
        }

        



        if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(arvict_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
            }

    
        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(arvict_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
            }

       $sort_column = 'apprasvehinspcattmp_pk';
           
      // $query = $query->orderBy(['appdocsubmissiontmp_pk'=>'desc']);
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
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
      
        foreach ($provider->getModels() as $key => $favResData) {
         $histmodel     =   \app\models\ApprasvehinspcathstyTbl::find()->where("arvich_apprasvehinspcattmp_fk =:pk", [':pk' => $favResData['apprasvehinspcattmp_pk']])->orderBy(["apprasvehinspcathsty_pk" => SORT_DESC])->limit(2)->asArray()->all();
         $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['arvict_appdecby']])->one();
         $favData[$key] = $favResData;
         $favData[$key]['hisstatus'] = $histmodel[1]['arvich_status'];
         $favData[$key]['username'] = $model['oum_firstname'];
         $favData[$key]['status'] = ($favResData['arvict_appdecComments'])?$favResData['arvict_appdecComments']:'Nil';
       

        }

        $inspectionata  =  \app\models\ApprasvehinspcattmpTbl::find()->where("arvict_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
        foreach($inspectionata as $key => $value){

            $docarray[] = $value['arvict_status'];
        }

        if (count(array_unique($docarray)) === 1) {
            $datastatus=$docarray[0];
          } else {
            if(in_array(3,$docarray)){
                $datastatus=3;

            }
            if(in_array(4,$docarray)){
                $datastatus=4;

            }elseif(in_array(1,$docarray)){
                $datastatus=1;

            }elseif(in_array(2,$docarray)){
                $datastatus=2;

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
}


public static function getInspectiondata(){
    $requestParam = $_GET;
    ini_set ( 'max_execution_time', 1200);
    $query = self::find();
    $statusFilter = $requestParam['statusFilter'];
     $query->select(['*']);
     $query->leftJoin('rascategorymst_tbl  category','category.rascategorymst_pk = arvict_rascategorymst_fk');
     $query->leftJoin('applicationdtlstmp_tbl  appid','appid.applicationdtlstmp_pk = arvict_applicationdtlstmp_fk');
     $query->leftJoin('appstaffinfotmp_tbl staffid','find_in_set(apprasvehinspcattmp_tbl.apprasvehinspcattmp_pk,staffid.appsit_apprasvehinspcattmp_fk)');
     $query->leftJoin('staffevaluationtmp_tbl  staffevaluation','staffevaluation.set_appstaffinfotmp_fk = staffid.appostaffinfotmp_pk');
     $query->leftJoin('rolemst_tbl role','find_in_set(role.rolemst_pk,staffid.appsit_roleforcourse)');
     $query->where([
        'appostaffinfotmp_pk'=> $requestParam['appid']
    ]);



    $query->groupBy('apprasvehinspcattmp_pk');
    if($requestParam['gridsearchValues'] != ''){
        $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
        $inspectionname= $gridsearchValues['arvict_rascategorymst_fk'];
        $status = $gridsearchValues['arvict_status'];
        $knowledge = $gridsearchValues['knowledge_assessment'];
        $practical = $gridsearchValues['pract_assessment'];
        if($inspectionname){  // category Filter
            if(count($inspectionname) >1){
                $appcond ="";
               if(in_array(1, $inspectionname)){ //new
                   $appcond .= "arvict_rascategorymst_fk='1' ||";
               }
               if(in_array(2, $inspectionname)){ //updated
                $appcond .= "arvict_rascategorymst_fk='2' ||";
               }
               if(in_array(3, $inspectionname)){ //Approved
                $appcond .= "arvict_rascategorymst_fk='3' ||";
               }
               if(in_array(4, $inspectionname)){ //Declined
                $appcond .= "arvict_rascategorymst_fk='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($inspectionname[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $inspectionname[0];
                    $query->andWhere("arvict_rascategorymst_fk='$pymt_sts' ");
                }
            }
        }          

        if(!empty($status)){
            $query->andwhere("rm_rolename_en  like '%".$status."%'");
        }
    }
   $sort_column = 'apprasvehinspcattmp_pk';
   $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
   $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
    if($sort_column == 'knowassessment'){
    $sort_column1 = 'set_asmtstatus';
    }else if($sort_column == 'practassessment'){

    $sort_column1 = 'set_asmtstatus';
    }else{
        $sort_column1 =  $sort_column;
    }
   $query->orderBy(["$sort_column1" => $order_by]);
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
   
   
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
    $approval = true;
     //invoice number
     $appdata = $provider->getModels();
    if($appdata){
        $appid = $appdata[0]['arvict_applicationdtlstmp_fk'];
        $invoicedata  = OpalInvoiceTbl::find()
        ->select(['*'])
        ->where('apid_applicationdtlstmp_fk = '.$appid)
      ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC])->asArray()->one();
    }
   
   
    
    foreach ($provider->getModels() as $key => $favResData) {
     $histmodel     =   \app\models\AppdocsubmissionhstyTbl::find()->where("appdsh_AppDocSubmissionTmp_FK =:pk", [':pk' => $favResData['appdocsubmissiontmp_pk']])->orderBy(["appdocsubmissionhsty_pk" => SORT_DESC])->limit(2)->asArray()->all();
     $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appdst_appdecby']])->one();
    if($favResData['appdt_projectmst_fk'] == 4){
     $staffeval = \app\models\StaffevaluationtmpTbl::find()
    ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $favResData['appostaffinfotmp_pk']])
    ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $favResData['rascategorymst_pk']])
    ->andwhere("set_asmttype =:set_asmttype", [':set_asmttype' => 1])
    ->orderBy(["staffevaluationtmp_pk" => SORT_DESC])->asArray()->one(); 
    $carddetails = $favResData['appsit_iscarddetails'];
    if((!$staffeval['set_staffevanfee'] && $staffeval['set_asmtstatus'] != 2 && $staffeval['set_asmtstatus'] != 7) || $staffeval['set_asmtstatus'] ==  6) {
    $approval = false;
    }

    if($carddetails == 1 && $staffeval['set_apppytminvoicedtls_fk']){
        $approval = false;
    }


    $staffevalpracticalcheck = \app\models\StaffevaluationtmpTbl::find()
    ->where("set_appstaffinfotmp_fk =:set_appstaffinfotmp_fk", [':set_appstaffinfotmp_fk' => $favResData['appostaffinfotmp_pk']])
    ->andwhere("set_rascategorymst_fk =:set_rascategorymst_fk", [':set_rascategorymst_fk' => $favResData['rascategorymst_pk']])
  //  ->andwhere("set_apppytminvoicedtls_fk =:set_apppytminvoicedtls_fk", [':set_apppytminvoicedtls_fk' => $invoicedata['apppytminvoicedtls_pk']])
    ->andwhere("set_asmttype =:set_asmttype", [':set_asmttype' => 2])
    ->orderBy(["staffevaluationtmp_pk" => SORT_DESC])->asArray()->one();
    $staffevalpractical = \app\models\StaffevaluationtmpTbl::find()->where(['set_appstaffinfotmp_fk' => $favResData['appostaffinfotmp_pk'],'set_asmttype' =>'2', 'set_rascategorymst_fk' => $favResData['rascategorymst_pk']]);
    if($favResData['appsit_iscarddetails'] == 1 && $staffevalpracticalcheck['set_apppytminvoicedtls_fk']){
        $staffevalpractical->andWhere(['set_apppytminvoicedtls_fk'=>$invoicedata['apppytminvoicedtls_pk']]);
    }
    $staffevalpractical->orderBy(['staffevaluationtmp_pk' => SORT_DESC]);
    $staffevalpractical =  $staffevalpractical->asArray()->one();
    
    }
    if(empty($knowledge)){
    $condition = true;
    }
    if(empty($practical)){
    $condition1 = true;
    }

    if($knowledge){
        if($knowledge == 3){ //pass 
            $condition = $staffeval['set_asmtstatus'] == '5';
       }
       else if($knowledge == 4){ //fail
           $condition =  $staffeval['set_asmtstatus'] == '6';
       }else if($knowledge == 1){ //pending
           $condition =  $staffeval['set_asmtstatus'] != '2' && !$staffeval['set_staffevanfee'] ;
       }else if($knowledge == 2){ //not applicable
           $condition =  $staffeval['set_asmtstatus'] == '7' ||   $staffeval['set_asmtstatus'] == '2';
       }

    }


    if($practical){
        if($practical == 1){ //Competent 
            $condition1 = $staffevalpractical['set_asmtstatus'] == '3';
       }
       else if($practical == 2){ //not Competent
           $condition1 =  $staffevalpractical['set_asmtstatus'] == '4';
       }else if($practical == 3){ //not applicable
           $condition1 =  $staffevalpractical['set_asmtstatus'] == '2' ;
       }else if($practical == 4){ //pending
           $condition1 =  $staffevalpractical['set_asmtstatus'] != '2' &&  $staffevalpractical['set_asmtstatus'] != '4' && $staffevalpractical['set_asmtstatus'] != '3';
       }
    }
   
     if($condition &&  $condition1){
        $role_array = explode(',' , $favResData['appsit_roleforcourse']);
        $role_name  = [];
        foreach($role_array as $role){
            $role  =    \app\models\RolemstTbl::find()->where("rolemst_pk =:pk", [':pk' => $role])->asArray()->one();
            $role_name[]  = $role['rm_rolename_en'];
        }
        $role_str  = "";
        $role_str = implode(',' , $role_name);
        //echo $key.$role_str;
        $favData[$key]['hisstatus'] = $histmodel[1]['appdsh_Status'];
        $favData[$key]['username'] = $model['oum_firstname'];
        $favData[$key] = $favResData;  
        $favData[$key]['asmtstatus']      = $staffeval['set_asmtstatus'];
        $favData[$key]['asmtstatusp']     = $staffevalpractical['set_asmtstatus'];
        $favData[$key]['staffevanfee']     = $staffeval['set_staffevanfee'];
        $favData[$key]['staffevanfeep']     = $staffevalpractical['set_staffevanfee'];
        $favData[$key]['staffevanfee_pk']   = $staffeval['staffevaluationtmp_pk'];
        $favData[$key]['staffevanfee_pkp'] = $staffevalpractical['staffevaluationtmp_pk'];
        $favData[$key]['status'] = ($favResData['arvict_appdecComments'])?$favResData['arvict_appdecComments']:'Nil';
        $favData[$key]['arvict_updatedon'] = ($favResData['arvict_updatedon'])?$favResData['arvict_updatedon']:"-";
        $favData[$key]['rolename'] = $role_str;
        $favData[$key]['knowpending'] = ($staffeval['set_apppytminvoicedtls_fk'])?2:1;
        $favData[$key]['pracpending'] = ($staffevalpractical['set_apppytminvoicedtls_fk'])?2:1;
     }
    }

   
    $response = array();
    $response['data'] = array_values($favData);
    $response['approvalstatus'] = $approval;
    $response['isInspector'] =  (in_array("16",$role_array))?true:false;
    $response['appdt_apptype'] = $favData[0]['appdt_apptype'];
  //  $response['totalcount'] = $provider->getTotalCount();
    $response['totalcount'] = count($favData);
    $response['size'] = $page;
    return $response;

}

}

