<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appstaffinfotmp_tbl".
 *
 * @property int $appostaffinfotmp_pk Primary Key
 * @property int $appsit_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appsit_applicationdtlstmp_fk Reference to appoffercoursetmp_pk
 * @property int $appsit_appinstinfotmp_fk Reference to appinstinfotmp_pk
 * @property int $appsit_appoffercoursetmp_fk Reference to appinstinfotmp_pk
 * @property int $appsit_staffinforepo_fk Reference to staffinforepo_pk
 * @property string $appsit_createdon
 * @property int $appsit_createdby
 * @property string $appsit_updatedon
 * @property int $appsit_updatedby
 * @property int $appsit_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appsit_appdecon
 * @property int $appsit_appdecby
 * @property string $appsit_appdeccomment
 *
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls
 * @property AppinstinfotmpTbl $appsitAppinstinfotmpFk
 * @property AppoffercoursetmpTbl $appsitApplicationdtlstmpFk
 * @property AppinstinfotmpTbl $appsitAppoffercoursetmpFk
 * @property OpalmemberregmstTbl $appsitOpalmemberregmstFk
 * @property StaffinforepoTbl $appsitStaffinforepoFk
 */
class AppstaffinfotmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appstaffinfotmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appsit_opalmemberregmst_fk', 'appsit_applicationdtlstmp_fk', 'appsit_staffinforepo_fk', 'appsit_createdby', 'appsit_status'], 'required'],
            [['appsit_opalmemberregmst_fk', 'appsit_applicationdtlstmp_fk', 'appsit_appinstinfotmp_fk', 'appsit_staffinforepo_fk', 'appsit_createdby', 'appsit_updatedby', 'appsit_status', 'appsit_appdecby'], 'integer'],
            [['appsit_createdon', 'appsit_updatedon', 'appsit_appdecon'], 'safe'],
            [['appsit_appdeccomment'], 'string'],
            // [['appsit_appinstinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfotmpTbl::className(), 'targetAttribute' => ['appsit_appinstinfotmp_fk' => 'appinstinfotmp_pk']],
            //[['appsit_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursetmpTbl::className(), 'targetAttribute' => ['appsit_applicationdtlstmp_fk' => 'appoffercoursetmp_pk']],
            //[['appsit_appoffercoursetmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfotmpTbl::className(), 'targetAttribute' => ['appsit_appoffercoursetmp_fk' => 'appinstinfotmp_pk']],
            [['appsit_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appsit_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['appsit_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['appsit_staffinforepo_fk' => 'staffinforepo_pk']],
            //[['appsit_staffinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinfotmpTbl::className(), 'targetAttribute' => ['appsit_staffinfotmp_fk' => 'staffinfotmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appostaffinfotmp_pk' => 'Appostaffinfo Pk',
            'appsit_opalmemberregmst_fk' => 'Appsit Opalmemberregmst Fk',
            'appsit_applicationdtlstmp_fk' => 'Appsit Applicationdtlstmp Fk',
            'appsit_appinstinfotmp_fk' => 'Appsit Appinstinfotmp Fk',
            //'appsit_appoffercoursetmp_fk' => 'Appsit Appoffercoursetmp Fk',
            'appsit_staffinforepo_fk' => 'Appsit Staffinforepo Fk',
            //'appsit_staffinfotmp_fk' => 'Appsit Staffinfotmp Fk',
            'appsit_createdon' => 'Appsit Createdon',
            'appsit_createdby' => 'Appsit Createdby',
            'appsit_updatedon' => 'Appsit Updatedon',
            'appsit_updatedby' => 'Appsit Updatedby',
            'appsit_status' => 'Appsit Status',
            'appsit_appdecon' => 'Appsit Appdecon',
            'appsit_appdecby' => 'Appsit Appdecby',
            'appsit_appdeccomment' => 'Appsit Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_AppStaffInfo_FK' => 'appostaffinfo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsitAppinstinfotmpFk()
    {
        return $this->hasOne(AppinstinfotmpTbl::className(), ['appinstinfotmp_pk' => 'appsit_appinstinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsitApplicationdtlstmpFk()
    {
        return $this->hasOne(AppoffercoursetmpTbl::className(), ['appoffercoursetmp_pk' => 'appsit_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsitAppoffercoursetmpFk()
    {
        //return $this->hasOne(AppinstinfotmpTbl::className(), ['appinstinfotmp_pk' => 'appsit_appoffercoursetmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsitOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appsit_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsitStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'appsit_staffinforepo_fk']);
        //return $this->hasOne(StaffinfotmpTbl::className(), ['staffinfotmp_pk' => 'appsit_staffinfotmp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppstaffinfotmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppstaffinfotmpTblQuery(get_called_class());
    }

    public static function getStaff(){
        $requestParam = $_GET;
        ini_set ( 'max_execution_time', 1200);
        $query = self::find();
        $statusFilter = $requestParam['statusFilter'];

        $query->select(['*',"(case  when appsit_iscarddetails = 2 and sccd_rascategorymst_fk is null then '1' when appsit_iscarddetails = 3 then '4' when appsit_iscarddetails = 1 then '4' 
         when sccd_status =1  and  appsit_iscarddetails = 2 then '2'  when sccd_status =2 then '3' end) as competcard",
         'DATE_FORMAT(appsit_createdon,"%d-%m-%Y") AS appsit_createdon1', 'GROUP_CONCAT(DISTINCT role.rm_rolename_en) AS rolename_en','GROUP_CONCAT(DISTINCT category.rcm_coursesubcatname_en) AS coursesubcatname_en','DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appsit_appdecon1',
         'DATE_FORMAT(appsit_updatedon,"%d-%m-%Y") AS appsit_updatedon1', 'TIMESTAMPDIFF(YEAR, sir_dob, CURDATE())  AS age',]);          $query->leftJoin('staffinforepo_tbl  repo','repo.staffinforepo_pk = appstaffinfotmp_tbl.appsit_staffinforepo_fk');
          $query->leftJoin('rolemst_tbl role','find_in_set(role.rolemst_pk,appstaffinfotmp_tbl.appsit_mainrole)');
          $query->leftJoin('applicationdtlstmp_tbl  app','app.applicationdtlstmp_pk = appstaffinfotmp_tbl.appsit_applicationdtlstmp_fk');
          $query->leftJoin('apprasvehinspcattmp_tbl vehicle','find_in_set(vehicle.apprasvehinspcattmp_pk,appstaffinfotmp_tbl.appsit_apprasvehinspcattmp_fk)');
          $query->leftJoin('rascategorymst_tbl  category','category.rascategorymst_pk = vehicle.arvict_rascategorymst_fk');
          $query->leftJoin('opalcountrymst_tbl  country','country.opalcountrymst_pk = repo.sir_nationality');
          $query->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk');
          $query->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');       //   $query->leftJoin("rolemst_tbl","find_in_set(rolemst_pk,appsit_mainrole)");
            $query->where([
            'appsit_applicationdtlstmp_fk'=> $requestParam['appid']
        ]);
        $query->groupBy('appostaffinfotmp_pk');
        if($requestParam['gridsearchValues'] != ''){

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
            
            $civilid = $gridsearchValues['sir_idnumber'];
            $staffname = $gridsearchValues['sir_name_en'];
            $emailid = $gridsearchValues['sir_emailid'];
            $staffgender  = $gridsearchValues['sir_gender'];
            $contracttype = $gridsearchValues['appsit_contracttype'];
            $mainrole  = $gridsearchValues['appsit_mainrole'];
            $roleforcourse  = $gridsearchValues['appsit_roleforcourse'];
            $vehicleinspection  = $gridsearchValues['appsit_apprasvehinspcattmp_fk'];
            $status  = $gridsearchValues['appsit_status'];
            $createdon = $gridsearchValues['appsit_createdon'];
            $updatedon = $gridsearchValues['appsit_updatedon'];
            $countryname =  $gridsearchValues['ocym_countryname_en'];
            $competencycard = $gridsearchValues['compcardfilt'];

            if($civilid)    //civil id
    {
            $query->andFilterWhere(['AND',
            ['LIKE', 'sir_idnumber', $civilid],
        ]);
    }           
        if($staffname) //opertsor name filter
    {
            $query->andFilterWhere(['AND',
            ['LIKE', 'sir_name_en', $staffname],
        ]);
    }
       
        if($emailid) //Company Name filter
        {
            $query->andFilterWhere(['AND',
            ['LIKE', 'sir_emailid', $emailid],
        ]);
        }



        if($competencycard){  // competency card

            if($competencycard == '1'){
                $appcond = "appsit_iscarddetails='2' and sccd_rascategorymst_fk is null";
             }else if($competencycard == '2'){
                $appcond = "sccd_status = '1' and appsit_iscarddetails = '2'";
             }else if($competencycard == '3'){
                $appcond = "sccd_status = '2'";
             }else if($competencycard == '4'){
                $appcond = "appsit_iscarddetails = '1'";
             }
             $query->andWhere($appcond);
        }
        if($staffgender){  // gender  Filter
            if(count($staffgender) >1){
                $appcond ="";
               if(in_array(1, $staffgender)){ //yes
                   $appcond .= "sir_gender='1' ||";
               }
               if(in_array(2, $staffgender)){ //no
                $appcond .= "sir_gender='2' ||";
               }
            
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($staffgender[0], [1,2])){ 
                    $pymt_sts = $staffgender[0];
                    $query->andWhere("sir_gender='$pymt_sts' ");
                }
            }
        }
        

        if(!empty($mainrole)){ // main role 
        $query->andwhere("rm_rolename_en  like '%".$mainrole."%'");
        }
        if(!empty($roleforcourse)){ // role for course
        $query->andwhere("rm_rolename_en  like '%".$roleforcourse."%'");
        }
        if(!empty($vehicleinspection)){ // inspection category
        $query->andwhere("rcm_coursesubcatname_en  like '%".$vehicleinspection."%'");
        }
        if(!empty($countryname)){ // inspection category
            $query->andwhere("ocym_countryname_en  like '%".$countryname."%'");
            }

        if($contracttype){  // contract type   Filter
            if(count($contracttype) >1){
                $appcond ="";
               if(in_array(1, $contracttype)){ //yes
                   $appcond .= "appsit_contracttype='1' ||";
               }
               if(in_array(2, $contracttype)){ //no
                $appcond .= "appsit_contracttype='2' ||";
               }
            
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($contracttype[0], [1,2])){ 
                    $pymt_sts = $contracttype[0];
                    $query->andWhere("appsit_contracttype='$pymt_sts' ");
                }
            }
        }
        
        if($role){  // contract role   Filter
            if(count($role) >1){
                $appcond ="";
               if(in_array(1, $role)){ //yes
                   $appcond .= "appsit_roleforcourse='1' ||";
               }
               if(in_array(2, $role)){ //no
                $appcond .= "appsit_roleforcourse='2' ||";
               }
            
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($role[0], [1,2])){ 
                    $pymt_sts = $role[0];
                    $query->andWhere("appsit_roleforcourse='$pymt_sts' ");
                }
            }
        }
        
    

        if($status){  // Status Filter
            if(count($status) >1){
                $appcond ="";
               if(in_array(1, $status)){ //new
                   $appcond .= "appsit_status='1' ||";
               }
               if(in_array(2, $status)){ //updated
                $appcond .= "appsit_status='2' ||";
               }
               if(in_array(3, $status)){ //Approved
                $appcond .= "appsit_status='3' ||";
               }
               if(in_array(4, $status)){ //Declined
                $appcond .= "appsit_status='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($status[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $status[0];
                    $query->andWhere("appsit_status='$pymt_sts' ");
                }
            }
        }



        if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(appsit_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
        }

    

         
        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
        {
            $query->andFilterWhere(['between', 'date(appsit_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
        }
     }

        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
        $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
        $query->orderBy(["$sort_column" => $order_by]);
        $query->asArray();
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
    //    $raw = $query->createCommand()->getRawSql();
    //    print_R($raw);
    //    exit;
     
        $data = $provider->getModels();
        $Roledata  =  \app\models\RolemstTbl::find()->where("rm_status =:pk", [':pk' => 1])->asArray()->All();
        foreach($Roledata as  $Data){

            $rolearr[$Data['rolemst_pk']] = $Data['rm_rolename_en'];
        }

        foreach ($provider->getModels() as $key => $favResData) {
            $histmodel     =   \app\models\AppstaffinfohstyTbl::find()->where("appsih_AppoStaffInfotmp_FK =:pk", [':pk' => $favResData['appostaffinfotmp_pk']])->orderBy(["AppStaffInfoHsty_PK" => SORT_DESC])->limit(2)->asArray()->all();
            $mainrole_arr = explode("," ,$favResData['appsit_mainrole']);
            $rolestr = [];
            foreach($mainrole_arr as $pk){
                 $rolestr[] =    $rolearr[$pk];
            }
            $mainrole_str = implode("," ,$rolestr);

            $rolecourse_arr = explode("," ,$favResData['appsit_roleforcourse']);
            $rolecoursestr = [];
            foreach($rolecourse_arr as $pk){
                 $rolecoursestr[] =    $rolearr[$pk];
            }
            $rolecourse_str = implode("," ,$rolecoursestr);


            $favData[$key] = $favResData;
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appsit_appdecby']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['hisstatus'] = $histmodel[1]['appsih_Status'];
           // $favData[$key]['appsit_updatedon'] = ($favResData['appsit_updatedon'])?$favResData['appsit_updatedon']:"-";
            $favData[$key]['status'] = ($favResData['appsit_appdeccomment'])?$favResData['appsit_appdeccomment']:'Nil';
            $favData[$key]['appsit_mainrole'] = $mainrole_str;
            $favData[$key]['appsit_roleforcourse'] = $rolecourse_str;
            $staffevaluation =  \app\models\StaffevaluationtmpTbl::find()->where(['set_appstaffinfotmp_fk' => $favResData['appostaffinfotmp_pk'],'set_staffinforepo_fk'=>$favResData['appsit_staffinforepo_fk'],'set_asmttype' =>'1'])->one();
            $favData[$key]['staffevaluationtmp_pk'] = $staffevaluation['staffevaluationtmp_pk'];

        }

        $condata  =  \app\models\AppstaffinfotmpTbl::find()->where("appsit_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
        foreach($condata as $key => $value){

            $docarray[] = $value['appsit_status'];
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
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;

    
    }
public static function fetchFavResult($staffid, $pageSize , $page){
  
    $favQuery = self::find();
    $favQuery->select([
                    '*'
                ])
                ->leftJoin('staffworkexp_tbl  staffexp','staffexp.sexp_staffinforepo_fk = appsit_staffinforepo_fk')
                ->leftJoin('staffacademics_tbl staffacd','staffacd.sacd_staffinforepo_fk = appsit_staffinforepo_fk')
                ->leftJoin('staffinforepo_tbl repo','repo.staffinforepo_pk = appsit_staffinforepo_fk');
               
    $favQuery->where([
                    'appostaffinfotmp_pk'=> $staffid,
                ]);
    $favQry = $favQuery->orderBy(['appostaffinfotmp_pk'=>SORT_DESC])
                ->asArray();
    $favProvider = new \yii\data\ActiveDataProvider([
        'query' => $favQry,
        'pagination' => [
                            'pageSize' =>$pageSize,
                            'page'=>$page
                        ]
    ]);


    $favouriteRes['data'] = $favProvider->getModels();
    $favouriteRes['totalcount'] = $favProvider->getTotalCount();
    $favouriteRes['size'] = $pageSize;
    $favouriteRes['page'] = $page;

    return $favouriteRes;
}

    
    
    
}
