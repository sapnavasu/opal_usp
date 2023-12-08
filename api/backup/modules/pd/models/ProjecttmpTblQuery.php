<?php
namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;
use yii\web\NotFoundHttpException;
use api\modules\mst\models\CountryMaster;
use api\modules\mst\models\CountrymstTblQuery;
use api\modules\mst\models\StatemstTblQuery;
use api\modules\pd\models\ProjtechnicaltmpTbl;
use api\modules\pd\models\ProjinvinfotmpTbl;
use api\modules\pd\models\ProjaccachievetmpTbl;
use api\modules\pd\models\ProjfaqtmpTbl;
use api\modules\pd\models\ProjinvmappingtmpTbl;
use api\modules\pd\models\ProjlicpermauthTblQuery;
use api\modules\pd\models\ProjectpartnerdtlsTbl;
/**
 * This is the ActiveQuery class for [[ProjecttmpTbl]].
 *
 * @see ProjecttmpTbl
 */
class ProjecttmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjecttmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjecttmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function index($data)
    {  
        // return $_SESSION['v3session'];
        $query = ProjecttmpTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        if(array_key_exists('memberRegPk',$data)){ 
            $memberRegPk = $data['memberRegPk'];
            $securityObj = new Security();
            $companypk = $securityObj->decrypt($memberRegPk);
        }else{
            $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        }
        // return $companypk;

        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            unset($data['onsortpk']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key!="prjt_projname" && $key!="prjt_referenceno")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjt_projname', true), ':value',array(':value' =>  $val)],
                      ['LIKE',Common::getTableWithPrefix('prjt_referenceno', true), ':value',array(':value' =>  $val)],
                      ['LIKE',Common::getTableWithPrefix('prjt_projectid', true), ':value',array(':value' =>  $val)]]); 
                    }
                }
            }
        }
        $query->select(['*',"TIMESTAMPDIFF(YEAR, prjt_plannedprojstrtdt, prjt_plannedprojenddt) as Diff,"
            . "TIMESTAMPDIFF(MONTH, prjt_plannedprojstrtdt, prjt_plannedprojenddt)%12 as Diffmonth,"
            . "crby.um_firstname as projownerfname,"
            . "crby.um_lastname as projownerlname"]);
        $query->leftJoin('sectormst_tbl','projecttmp_tbl.prjt_sectormst_fk=sectormst_tbl.sectorMst_Pk');        
        $query->leftJoin('statemst_tbl','projecttmp_tbl.prjt_statemst_fk = statemst_tbl.StateMst_Pk');
        $query->leftJoin('citymst_tbl','projecttmp_tbl.prjt_citymst_fk=citymst_tbl.CityMst_Pk');
        $query->leftJoin('usermst_tbl crby','projecttmp_tbl.prjt_submittedby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl decby','projecttmp_tbl.prjt_submittedby=decby.UserMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','decby.UM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->andWhere('prjt_memberregmst_fk=:id',array(':id' => $companypk)); 
        if($sortpk==1){
        $query->orderBy('prjt_createdon DESC');
        }else {
        $query->orderBy('prjt_createdon ASC');    
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        $model = ProjecttmpTbl::find()
        ->select(['projecttmp_pk'])
        ->andWhere('prjt_memberregmst_fk=:id',array(':id' => $companypk))
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total_entry' => count($model)
        ];
    }
    
    public function addProjectCard($data){
//        $randomprojid = rand(1,100000000);
        $proCardArray = $data['projectCardData'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
         $query = ProjecttmpTbl::find();
         $query->select(['*']);
         $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
         $countid=$provider->getTotalCount();
        
//            $curruser = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
//            $modelref = ProjectdtlsTbl::find()
//                ->where(['prjt_referenceno'=> $proCardArray['prjt_referenceno']])
//                ->asArray()->one();
//            $byuser = UsermstTbl::find()
//            ->select(['UM_MemberRegMst_Fk'])
//            ->where(['UserMst_Pk' => $curruser])
//            ->asArray()->one();
//            if (empty($modelref) && ($byuser->UM_MemberRegMst_Fk != $companypk)) {  }
//            else{return "duplicate"; }
          
        if($proCardArray['projecttmp_pk']==''){
            $countrypk=\yii\db\ActiveRecord::getTokenData('company_country',true);
            $country_model =  CountryMaster::find()
            ->select(['CyM_CountryCode_en'])
            ->where("CountryMst_Pk =:pk",[':pk'=> $countrypk])->one();
            $con = $country_model->CyM_CountryCode_en;
            $count = ProjecttmpTbl::find()
                            // ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk = prjt_createdby')
                            // ->where(['UM_MemberRegMst_Fk'=>$companypk])
                            ->where(['prjt_memberregmst_fk'=>$companypk])
                            ->andWhere(['like','prjt_projectid',$country_model->CyM_CountryCode_en])
                            ->count();
            $count++;
            $count = str_pad($count,3,'0',STR_PAD_LEFT);
            $model = new ProjecttmpTbl();
            $model->prjt_projectid = 'LYP001-'.$con.'-'.$count;
            $model->prjt_projstatus = Security::sanitizeInput(1, "number");
            $model->prjt_createdon = date('Y-m-d H:i:s');
            $model->prjt_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjt_createdbyipaddr =\common\components\Common::getIpAddress();
            // $model->prjt_submittedon = date('Y-m-d H:i:s');
            // $model->prjt_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            // $model->prjt_submittedbyipaddr =\common\components\Common::getIpAddress();
        }else{
            $projectPk = Security::decrypt($proCardArray['projecttmp_pk']);
            $projectPk = Security::sanitizeInput($projectPk, "number");
            $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one(); 
            $model->prjt_updatedon = date('Y-m-d H:i:s');
            $model->prjt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjt_updatedbyipaddr =\common\components\Common::getIpAddress();
        }
            $model->prjt_referenceno = trim($proCardArray['prjt_referenceno']);
            $model->prjt_projname = trim($proCardArray['prjt_projname']);
            $model->prjt_sectormst_fk = Security::sanitizeInput($proCardArray['prjt_sectormst_fk'], "number");
            if($proCardArray['prjt_industrymst_fk'])
            {$model->prjt_industrymst_fk = Security::sanitizeInput($proCardArray['prjt_industrymst_fk'], "number");}
            $model->prjt_memberregmst_fk = Security::sanitizeInput($companypk, "number");
                    
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'error'=>$model->getErrors(),
                    'returndata' => $model
                );
            }  else {
            $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Card Added / Updated successfully!',
                    'projectpk' => Security::encrypt($model->projecttmp_pk),
                    'projectID' => $model->prjt_projectid,
                    'projectRefno' => $model->prjt_referenceno,
                    'projectName' => $model->prjt_projname,
                    'projectSector' => $model->prjt_sectormst_fk,
                    'projectIndustry' => $model->prjt_industrymst_fk,
                );                
            }
            return json_encode($result);
        
    }
    public function currcountry(){
        $countrypk=\yii\db\ActiveRecord::getTokenData('company_country',true);
        $country_model =  CountryMaster::find()
            ->select(['CyM_CountryName_en'])
            ->where("CountryMst_Pk =:pk",[':pk'=> $countrypk])->one();
            return $country_model->CyM_CountryName_en;
    }
    public function submitproject($data){

        if(!empty($data['projectpk'])){
        $pk = Security::decrypt($data['projectpk']);
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk'=>$pk))
                ->one();
        $proj_valid=1;
        $tech_valid=1;
        $mark_valid=1;
        $inve_valid=1;
        $fina_valid=1;
        $dili_valid=1;
        ///please dont delete or edit below towards project submiton validation checking required fields in db
        $proj_arr = array("prjt_shortsummary", "prjt_projstatus", "prjt_projstage","prjt_sectormst_fk","prjt_projpresloc","prjt_statemst_fk","prjt_citymst_fk","prjt_latitude","prjt_longitude","prjt_projpresence","prjt_addressline","prjt_memcompmplocationdtls_fk");
        // projaccreditation_tbl,projachievement_tbl "prjt_proptype",
        $tech_arr = array("pt_techinfo","pt_techapprovals","pt_employoppor","pt_tourism","pt_supplychain","pt_environmental");
        // projtechnical_tbl,
        $mark_arr = array("prjt_projecttags");
        //projfaqdtls_tbl
        $inve_arr = array("piid_targetinvestors",);
        //projinvinfodtls_tbl //projinvmapping_tbl

        //=======project details===============
        foreach ($model as $key => $value){
                if (in_array($key,$proj_arr)){
                if(empty($value)){
                    $proj_valid=0;echo($key);
                }               
                }
                if (in_array($key,$mark_arr)){
                    if(empty($value)){
                    $mark_valid=0;
                    }   
                }           
                    if(empty($model->prjt_projdiligenceform_fk)){
                    $dili_valid=0;
                    }   
            }
            

            //project info =======================================
            // $model = ProjinvinfodtlsTbl::find()
            //         ->where('piid_projectdtls_fk=:fk',array(':fk'=>$pk))
            //         ->one();
            // if(!($model)){
            //     $proj_valid=0;echo("bjbjjb");
            // }

            //=======project technical =======================
            $model = ProjtechnicaltmpTbl::find()
                    ->where('ptt_projecttmp_fk=:fk',array(':fk'=>$pk))
                    ->one();
                    if(!($model)){
                        $tech_valid=0;
                    } 
                    else{
                        foreach ($model as $key => $value){
                            if (in_array($key,$tech_arr)){
                                if(empty($value)){
                                    $tech_valid=0;
                                }               
                            }
                                            
                        }
                    }
            //============market========
            $model = ProjfaqtmpTbl::find()
                    ->where('pft_projecttmp_fk=:fk',array(':fk'=>$pk))
                    ->one();
            if(!$model){
                $mark_valid=0;
            }
            //========investor==========
            $model = ProjinvinfotmpTbl::find()
                ->where('piit_projecttmp_fk=:fk',array(':fk'=>$pk))
                ->one();
                if(!$model){
                    $inve_valid=0;
                }
//                else{
//                    if(empty($model->piid_targetinvestors)){
//                        $inve_valid=0; 
//                    }
//                }
        
//            $model = ProjinvmappingTbl::find()
//            ->where('pim_projectdtls_fk=:fk',array(':fk'=>$pk))
//            ->one();
//            if(!$model){
//                $inve_valid=0;
//            }
         
        }
        else{
            $proj_valid=0;
            $tech_valid=0;
            $mark_valid=0;
            $inve_valid=0;
            $fina_valid=0;
            $dili_valid=0;
        }
        $result=array(
            'proj' => $proj_valid,
            'tech' => $tech_valid,
            'mark'=>$mark_valid,
            'inve' => $inve_valid,
            'dili' => $dili_valid,
        );
        return json_encode($result);
        
        
    }
    public function addProjectInfo($data){
        $proInfoArray = $data['projectInfoData'];
        $projinfo = $data['projinfo'];
        if(!empty($data['projectpk'])){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            // $model->prjt_shortsummary = $proInfoArray['prjt_summary'];
            // $model->prjt_projdesc = $proInfoArray['prjt_prodescript'];
            // $model->prjt_projscentralschememst_fk = Security::sanitizeInput($proInfoArray['prjt_centscheme'],'string');
            // if(!empty($proInfoArray['prjt_centscheother'])){
            // $model->prjt_projcentralschemeothers = Security::sanitizeInput($proInfoArray['prjt_centscheother'],'string');
            // }
            // $model->prjt_projstateschememst_fk = Security::sanitizeInput($proInfoArray['prjt_scheme'],'string');
            // if(!empty($proInfoArray['prjt_centscheme'])){
            // $model->prjt_projstateschemeothers = Security::sanitizeInput($proInfoArray['prjt_stateother'],'string');
            // }
            // $model->prjt_sdgprojdesc = Security::sanitizeInput($proInfoArray['prjt_sdgdesc'],'string');
            // $model->prjt_presentstatus = Security::sanitizeInput($proInfoArray['prjt_presentsts'],'number');
            // if(!empty($proInfoArray['prjt_presothers'])){
            // $model->prjt_presentstatusothers = Security::sanitizeInput($proInfoArray['prjt_presothers'],'string');
            // }
            //  $model->prjt_projownershipmst_fk = Security::sanitizeInput($proInfoArray['prjt_porjowner'],'number');
            // $model->prjt_interestfortender = Security::sanitizeInput($proInfoArray['prjt_inttender'],'number');
            // if(!empty($proInfoArray['prjt_ppptype']))
            // {
            // $model->prjt_projmodeofimplentmst_fk = Security::sanitizeInput($proInfoArray['prjt_ppptype'],'number');
            // }else if(!empty($proInfoArray['prjt_epctype']))
            // {
            // $model->prjt_projmodeofimplentmst_fk = Security::sanitizeInput($proInfoArray['prjt_epctype'],'number');    
            // }
            // if(!empty($proInfoArray['prjt_modother'])){
            // $model->prjt_otherimplementation = Security::sanitizeInput($proInfoArray['prjt_modother'],'string');
            // }
            // $model->prjt_proptype = Security::sanitizeInput($proInfoArray['prjt_ppptype'],'number');
            
            // if(!empty($proInfoArray['prjt_stsother']))
            // {
            // $model->prjt_otherprojtype = Security::sanitizeInput($proInfoArray['prjt_stsother'],'string');    
            // }
            // $model->prjt_projstage = Security::sanitizeInput($proInfoArray['prjt_projstage'], "number");
            // $model->prjt_sectormst_fk = Security::sanitizeInput($proInfoArray['prjt_sectormst_fk'], "number");
            // if($proInfoArray['prjt_industrymst_fk']!=''){
            // $model->prjt_industrymst_fk = Security::sanitizeInput($proInfoArray['prjt_industrymst_fk'], "number");
            // }
            // $model->prjt_proptype = Security::sanitizeInput($proInfoArray['prjt_proptype'], "number");
            // if($proInfoArray['prjt_natureofprop']!=''){
            // $model->prjt_natureofprop = Security::sanitizeInput($proInfoArray['prjt_natureofprop'], "string");
            // }
            // $arr = [];
            // unset($projinfo['prjt_ppptype']);
            // unset($projinfo['prjt_pppothers']);
         
            foreach($projinfo as $key => $val){
                // array_push($arr,[$key,$val]);
                // if($val!=null && $val!='')
                
                    if($key=='prjt_dateofinception'||$key=='prjt_plannedprojstrtdt'||$key=='prjt_plannedprojenddt'){
                        if(!empty($val) && $val!=0){
                        $model[$key]=Common::convertDateTimeToServerTimezone($val,'Y-m-d');
                        }
                    } else if($key=='prjt_projscentralschememst_fk'||$key=='prjt_projstateschememst_fk'){
                        $model[$key]=(string)$val;
                    } else if($key=='prjt_pppothers'){
                        if(!empty($val)){
                            $model->prjt_otherimplementation = trim($val);
                        }
                    } else if($key=='prjt_otherimplementation'){
                            $model->prjt_otherimplementation = trim($val);
                    } else if($key=='prjt_presentstatusothers'){
                            $model->prjt_presentstatusothers = trim($val);
                    } else if($key=='prjt_sustdevelopgoal'){
                        if($val=='[]'){
                            $model->prjt_sustdevelopgoal = null;
                        }else{
                            $model->prjt_sustdevelopgoal = trim($val);
                        }
                    }else if($key=='prjt_projmodeofimplentmst_fk' || $key=='prjt_ppptype' || $key=='prjt_epctype'){
                        if(!empty($val) && $val!=0){
                            $model->prjt_projmodeofimplentmst_fk = Security::sanitizeInput($val,'number');
                        }
                    } else if($key=='prjt_projbanner' && !empty($val)){
                        $model->prjt_projbanner =implode(',', $val);
                    }else{
                        $model[$key]=trim($val);
                    }
                
            }
            // return $arr;
            $model->prjt_updatedon = date('Y-m-d H:i:s');
            $model->prjt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjt_updatedbyipaddr =\common\components\Common::getIpAddress();
            
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'error'=>$model->getErrors(),
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else{
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Info Add / Updated successfully!',
                    'returndata' => $model
                ); 
            }
            // else {
                {
            if(!empty($proInfoArray['opdtls'])){
                     foreach ($proInfoArray['opdtls'] as $key => $opdtlsvalue) {
                     if(!empty($opdtlsvalue['organisName'])){
                     $opdtlsmodel = ProjectpartnerdtlsTbl::find()->where("projectpartnerdtls_pk =:pk",array(':pk'=>Security::sanitizeInput($opdtlsvalue['organizaionpk'],"number")))->one();
                     if(empty($opdtlsmodel))
                     {
                            $opdtlsmodel = new ProjectpartnerdtlsTbl();
                            $opdtlsmodel->prjpd_projectdtls_fk = $projectPk;
                            $opdtlsmodel->prjpd_partnermst_fk = Security::sanitizeInput($opdtlsvalue['organisType'],"number");
                            $opdtlsmodel->prjpd_partnerorginfo = $opdtlsvalue['organisName'];
                            $opdtlsmodel->prjpd_index = Security::sanitizeInput($key,"number");
                            $opdtlsmodel->prjpd_createdon = date('Y-m-d H:i:s');
                            $opdtlsmodel->prjpd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                            $opdtlsmodel->prjpd_createdbyipaddr = \common\components\Common::getIpAddress();
                            if ($opdtlsmodel->save() === false) {
                                $result=array(
                                    'status' => 200,
                                    'statusmsg' => 'warning',
                                    'flag'=>'E',
                                    'error'=>$opdtlsmodel->getErrors(),
                                    'msg'=>'Something went wrong'
                                );
                       }
                     }else{
                            $opdtlsmodel->prjpd_partnermst_fk = Security::sanitizeInput($opdtlsvalue['organisType'],"number");
                            $opdtlsmodel->prjpd_partnerorginfo = $opdtlsvalue['organisName']; 
                            $opdtlsmodel->prjpd_index = Security::sanitizeInput($key,"number");  
                            $opdtlsmodel->prjpd_updatedon = date('Y-m-d H:i:s');
                            $opdtlsmodel->prjpd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                            $opdtlsmodel->prjpd_updatedbyipaddr = \common\components\Common::getIpAddress();
                           if($opdtlsmodel->save())
                           {
                           }else{
                            $result=array(
                                'status' => 200,
                                'statusmsg' => 'warning',
                                'flag'=>'E',
                                'error'=>$opdtlsmodel->getErrors(),
                                'msg'=>'Something went wrong'
                            );
                           }
                     }
                     }
            }
            }
           if(!empty($proInfoArray['projreq']) && !empty($proInfoArray['projrec'])) {
            $invmodel = ProjinvinfotmpTbl::find()->where("piit_projecttmp_fk =:pk",[':pk'=> $projectPk])->one(); 
            if(!empty($invmodel)){
              $invmodel->piit_updatedon = date('Y-m-d H:i:s');
              $invmodel->piit_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
              $invmodel->piit_updatedbyipaddr = \common\components\Common::getIpAddress(); 
            }else{
              $invmodel = new ProjinvinfotmpTbl();
              $invmodel->piit_projectdtls_fk = $model->projectdtls_pk;
              $invmodel->piit_createdon = date('Y-m-d H:i:s');
              $invmodel->piit_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
              $invmodel->piit_createdbyipaddr = \common\components\Common::getIpAddress();
            }
            $invmodel->piit_invreqdcurrencymst_fk = Security::sanitizeInput($proInfoArray['prjt_reqcur'], "number");
            $invmodel->piit_invrecdcurrencymst_fk = Security::sanitizeInput($proInfoArray['prjt_reccur'], "number");
            $invmodel->piit_totinvreqd = Security::sanitizeInput($proInfoArray['projreq'],"float");
            $invmodel->piit_totinvrecd = Security::sanitizeInput($proInfoArray['projrec'],"float");
            if (!$invmodel->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'error'=>$invmodel->getErrors(),
                    'msg'=>'Something went wrong'
                );
            }
            }
                              
            }
            return json_encode($result);
        }
    }
    }
    
    public function addProHighlights($data){
        $proHigArray = $data['highlightData'];  
        $proHigAccre = $data['accrdition'];  
        $proHigAcchive = $data['achivement'];  
        $proHigCert = $data['certificates'];  
        $proHigAwar = $data['awards'];  
        $proHiglicense = $data['license'];  
        $proHigtype = $data['typeval'];  
        $projectPk = Security::decrypt($data['projpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            // $model->prjt_benefeat = Security::sanitizeInput($proHigArray['prjt_benefeat'], "html");
            // $model->prjt_investorbenefits = Security::sanitizeInput($proHigArray['piid_investorbenefits'], "html");
            // $model->prjt_updatedon = $date;
            // $model->prjt_updatedby = $userPk;
            // $model->prjt_updatedbyipaddr = $ip_address;
            // if ($model->save() === false) {
            //     $result=array(
            //         'status' => 200,
            //         'statusmsg' => 'warning',
            //         'flag'=>'E',
            //         'msg'=>'Something went wrong!',
            //         'returndata' => $model
            //     );
            // }  else
             {
               
                
                
                if(!empty($proHigAccre) && $proHigtype=='accr'){
                    ProjaccachievetmpTbl::deleteAll('paat_projecttmp_fk=:pk and paat_type=1',[':pk'=>$projectPk]);
                    $proAccreditationArray = ProjaccachievetmpTblQuery::addAccreditation($proHigAccre,$projectPk);
                }
                if(!empty($proHigAcchive) && $proHigtype=='achi'){
                    ProjaccachievetmpTbl::deleteAll('paat_projecttmp_fk=:pk and paat_type=2',[':pk'=>$projectPk]);
                    $proAchievementArray= ProjaccachievetmpTblQuery::addAchievement($proHigAcchive,$projectPk);
                    
                }
                if(!empty($proHigCert) && $proHigtype=='cert'){
                    ProjaccachievetmpTbl::deleteAll('paat_projecttmp_fk=:pk and paat_type=4',[':pk'=>$projectPk]);
                    $proCertificateArray= ProjaccachievetmpTblQuery::addCertificate($proHigCert,$projectPk);
                    
                }
                if(!empty($proHigAwar) && $proHigtype=='awar'){
                    ProjaccachievetmpTbl::deleteAll('paat_projecttmp_fk=:pk and paat_type=3',[':pk'=>$projectPk]);
                    $proAwardArray= ProjaccachievetmpTblQuery::addAward($proHigAwar,$projectPk);
                    
                }
                if(!empty($proHiglicense)){
                    ProjacqlictmpTbl::deleteAll('palt_projecttmp_fk=:pk',[':pk'=>$projectPk]);
                    $proLicenseArray= ProjacqlictmpTblQuery::addlicense($proHiglicense,$projectPk);
                }
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Highlight Add / Updated successfully!',
                    'returndata' => $model,
                    'proAccreditationArray'=>$proAccreditationArray,
                    'proAchievementArray'=>$proAchievementArray,
                    'proLicenseArray'=>$proLicenseArray,
                    'proCertificateArray'=>$proCertificateArray,
                    'proAwardArray'=>$proAwardArray,
                );                
            }
            return json_encode($result);
        }
    }
    
    public function mapteam($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project team mapped successfully!',
        );
        if($model){
            $model->prjt_projteam = json_encode($data['mapteam']);
            if($model->save()==false){
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!'
                );
            }
        
        }
        return json_encode($result);
    }
    
    public function addlocation($data){
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        $model->prjt_statemst_fk=Security::sanitizeInput($data['projectloc']['proj_gov'], "number");
        $model->prjt_citymst_fk=Security::sanitizeInput($data['projectloc']['proj_cty'], "number");
        $model->prjt_latitude=Security::sanitizeInput($data['projectloc']['proj_latadd'], "string_spl_char");
        $model->prjt_longitude=Security::sanitizeInput($data['projectloc']['proj_longadd'], "string_spl_char");
        $model->prjt_addressline=Security::sanitizeInput($data['projectloc']['proj_line'], "string");
        $model->prjt_district=Security::sanitizeInput($data['projectloc']['prjt_district'], "string");
//        $model->prjt_projzone=Security::sanitizeInput($data['projectloc']['proj_zon'], "number");
//         $model->prjt_freezone=Security::sanitizeInput($data['projectloc']['sez'], "number");
        // $model->prjt_proptype=Security::sanitizeInput($data['projectloc']['type'], "number");
        // $model->prjt_landarea=Security::sanitizeInput($data['prjt_landarea']['type'], "number");
        // $model->prjt_unitmst_fk=Security::sanitizeInput($data['proj_araunit']['type'], "number");
        // $model->prjt_natureofprop=Security::sanitizeInput($data['projectloc']['nature'], "number");
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Location Added / Updated successfully!',
            'returndata' => $model
        );
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            'returndata' => $model->getErrors()
            );
        }
        return json_encode($result);

    }
    public function addlocation2($data){
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        $model->prjt_projzonemst_fk=Security::sanitizeInput($data['projectloc']['proj_zon'], "number");
        $model->prjt_projcategory=Security::sanitizeInput($data['projectloc']['proj_loccategory'], "number");
        $model->prjt_proptype=Security::sanitizeInput($data['projectloc']['type'], "number");
        $model->prjt_landarea=Security::sanitizeInput($data['projectloc']['prjt_landarea'], "number");
        $model->prjt_unitmst_fk=Security::sanitizeInput($data['projectloc']['proj_araunit'], "number");
        $model->prjt_natureofprop=Security::sanitizeInput($data['projectloc']['nature'], "number");
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Location Info Added / Updated successfully!',
            'returndata' => $model
        );
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            'returndata' => $model->getErrors()
            );
        }
        return json_encode($result);

    }
    
    
    
     public function getprojectbyid($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->select(['*'])
                ->andWhere('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->asArray()->one();
        return($model);
    }
    
    public function addtimeline($data){
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        $model->prjt_dateofinception = Common::convertDateTimeToServerTimezone($data['timeline']['inception'],'Y-m-d');
        $model->prjt_plannedprojstrtdt = Common::convertDateTimeToServerTimezone($data['timeline']['start'],'Y-m-d'); 
        $model->prjt_plannedprojenddt = Common::convertDateTimeToServerTimezone($data['timeline']['end'],'Y-m-d');
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Timeline added successfully!',
            'returndata' => $model
        );
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        }
        return json_encode($result);
    }
    
    public function addprojectwebpresence($data) {
        $dataval=$data['projectmedia'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $socialmodel = ProjecttmpTbl::find()->where('projecttmp_pk=:pk',array(':pk'=>$projectPk))->one();
        $socialmedialarr=[];
        foreach ($dataval['SocMedArray'] as $key => $value) {
            if($value['SMedia'] != null && $value['SMediaUrl'] != null){
                $socialmedialarr[] = $value;             
            }
        }
        if(!empty($dataval['website'])){
        $socialmodel->prjt_website=$dataval['website'];
        }
        if(!empty($socialmedialarr)){
        $socialmodel->prjt_socialmedia=$socialmedialarr;
        }
        if(!empty($dataval['prjt_debt'])){
            $socialmodel->prjt_selftags=$dataval['prjt_debt'];
            }
        if(!empty($dataval['prjt_tag'])){
            $socialmodel->prjt_predefinedtags=implode(",",$dataval['prjt_tag']);
            }
        if($socialmodel->save())
        {
            $data1['website']=$socialmodel->prjt_website;
            $data1['socialjson']=$socialmodel->prjt_socialmedia;
             $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($socialmodel->getErrors());
        }
        return $result;
    
    }
    public function mapofflocation($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project office location mapped successfully!',
        );
        if($model){
            $model->prjt_memcompmplocationdtls_fk = $data['locationpk'];
            if($model->save()==false){
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!'
                );
            }
        
        }
        return json_encode($result);
    }
    
    public function mapcontact($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project contact mapped successfully!',
        );
        if($model){
            $model->prjt_contactinfo = json_encode($data['mapcontact']);
            if($model->save()==false){
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!'
                );
            }
        
        }
        return json_encode($result);
    }
    
    public function getprojinvestors($data) {
        $val = [];
        foreach ($data['invitelist'] as $key => $value) {
            $val []=$value['investorid'];
        }
        $conditionval = implode(',', $val);
        if(empty($conditionval)){
            $conditionval = 0 ;
        }
        $investor=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $investordmodel = ProjinvmappingtmpTbl::find()
                ->select('pimt_name,projinvmappingtmp_pk,pimt_emailid')
                ->where('pimt_memberregmst_fk=:memcomppk',[':memcomppk'=> $companypk])
                ->andWhere("projinvmappingtmp_pk not in ($conditionval)")
                ->orderBy('projinvmappingtmp_pk desc')
                ->asArray()->all();
        if(!empty($investordmodel))
        {
        foreach ($investordmodel as $key => $value) {
            $investor[$key]['name']=$value['pimt_name'];
            $investor[$key]['investorid']=$value['projinvmappingtmp_pk'];
            $investor[$key]['emailid']=$value['pimt_emailid'];
        }
        }
        
         if (empty($investor)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$investor];
        }
    
    }
    
    public function addFinancial($data){
        $proFinancialArray = $data['financialData'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            if(!empty($proFinancialArray['prjt_finindicators']))
            {
            $model->prjt_finindicators = $proFinancialArray['prjt_finindicators'];
            }
            if(!empty($proFinancialArray['prjt_roi']))
            {
            $model->prjt_roi = $proFinancialArray['prjt_roi'];
            }
            if(!empty($proFinancialArray['prjt_riskfactors']))
            {
            $model->prjt_riskfactors = $proFinancialArray['prjt_riskfactors'];
            }
            if(!empty($proFinancialArray['prjt_riskdisclosures']))
            {
            $model->prjt_riskdisclosures = $proFinancialArray['prjt_riskdisclosures'];
            }
    
            if($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Financial Add / Updated successfully!',
                    'returndata' => $model
                );                
            }
            return json_encode($result);
        }
    }
    
    public function addtenderdtl($data){
        $proTenderArray = $data['tenderData'];
        $projpk = Security::decrypt($data['projectpk']);
        $projpk = Security::sanitizeInput($projpk, "number");
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $tenderdtlmodel= ProjtendtmpTbl::find()->where('ptt_projecttmp_fk=:id',array(':id' => $projpk))->one();
        if(empty($tenderdtlmodel)){
        $tenderdtlmodel = new ProjtendtmpTbl();
        $tenderdtlmodel->ptt_submittedon = date('Y-m-d H:i:s');
        $tenderdtlmodel->ptt_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $tenderdtlmodel->ptt_submittedbyipaddr = \common\components\Common::getIpAddress();
        }
        $tenderdtlmodel->ptt_tendertype=Security::sanitizeInput($proTenderArray['tendertype'],"number");;
        $tenderdtlmodel->ptt_bidstage=Security::sanitizeInput($proTenderArray['bidstage'],"number");;
        $tenderdtlmodel->ptt_bidprocess=Security::sanitizeInput($proTenderArray['bidprocess'],"number");;
        $tenderdtlmodel->ptt_tenderid=Security::sanitizeInput($proTenderArray['tenderid'],"string");;
        if($proTenderArray['bidprocess']==1){
        $tenderdtlmodel->ptt_tendportal=Security::sanitizeInput($proTenderArray['tenderportal'],"string");
        }
        else{
        $tenderdtlmodel->ptt_tendportal=null;
        }
        $tenderdtlmodel->ptt_engagementcost=Security::sanitizeInput($proTenderArray['engagementcost'],"number");
        $tenderdtlmodel->ptt_compltime=Security::sanitizeInput($proTenderArray['compltime'],"number");
        $tenderdtlmodel->ptt_noticeperiod=Security::sanitizeInput($proTenderArray['noticeperiod'],"number");
        $tenderdtlmodel->ptt_agreesign=Security::sanitizeInput(date('Y-m-d',  strtotime($proTenderArray['agreesign'])),"string");
        $tenderdtlmodel->ptt_tendopeningdt=Security::sanitizeInput(date('Y-m-d',  strtotime($proTenderArray['tenderdate'])),"string");
        $tenderdtlmodel->ptt_bidduedt=Security::sanitizeInput(date('Y-m-d',  strtotime($proTenderArray['biodate'])),"string");
        $tenderdtlmodel->ptt_projecttmp_fk=$projpk;
        $tenderdtlmodel->ptt_updatedon = date('Y-m-d H:i:s');
        $tenderdtlmodel->ptt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $tenderdtlmodel->ptt_updatedbyipaddr = \common\components\Common::getIpAddress();
            if($tenderdtlmodel->save() == false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $tenderdtlmodel->getErrors()
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Tender Add / Updated successfully!',
                    'returndata' => $tenderdtlmodel
                );                
            }
            return json_encode($result);
    }
    
    public function addtenderdocs($data)
    {
        $dataval=$data['tenderinfo'];
        $projpk = Security::decrypt($data['projectpk']);
        $tenderdoc = implode(',', $dataval['tenderdoc']);
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $tenderdocmodel= ProjtendtmpTbl::find()->where('ptt_projecttmp_fk=:id',array(':id' => $projpk))->one();
        if(empty($tenderdocmodel)){
        $tenderdocmodel = new ProjtendtmpTbl();
        $tenderdocmodel->ptt_submittedon = date('Y-m-d H:i:s');
        $tenderdocmodel->ptt_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $tenderdocmodel->ptt_submittedbyipaddr = \common\components\Common::getIpAddress();
        }
        $tenderdocmodel->ptt_memcompfiledtls_fk=$tenderdoc;
        $tenderdocmodel->ptt_projecttmp_fk=$projpk;
        $tenderdocmodel->ptt_updatedon = date('Y-m-d H:i:s');
        $tenderdocmodel->ptt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $tenderdocmodel->ptt_updatedbyipaddr = \common\components\Common::getIpAddress();
        if($tenderdocmodel->save())
        {
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($tenderdocmodel->getErrors());
        }
        return $result;
    }
    
    public function addprojpromotor($data)
    {   
        // return $data;
        $dataval=$data['promotorinfo'];
        $promopk = $data['projectpk'];
        $projpk = Security::decrypt($data['projectpk']);
        $type=$data['type'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        if($type=="add"){
            $promotordtlmodel = new ProjpromoterdtlsTbl();
            $promotordtlmodel->ppd_createdon = date('Y-m-d H:i:s');
            $promotordtlmodel->ppd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $promotordtlmodel->ppd_createdbyipaddr = \common\components\Common::getIpAddress();
            $promotordtlmodel->ppd_promotername=Security::sanitizeInput($dataval['proname'],"string_spl_char");
            $promotordtlmodel->ppd_website=$dataval['website'];
            $promotordtlmodel->ppd_promoterrefno=$dataval['prorefno'];
            $promotordtlmodel->ppd_address=$dataval['proj_line']==null?null:Security::sanitizeInput($dataval['proj_line'],"string_spl_char");
            $promotordtlmodel->ppd_others=$dataval['otherinfo']==null?null:Security::sanitizeInput($dataval['otherinfo'],"string_spl_char");
            $promotordtlmodel->ppd_projectrole=$dataval['projrole']==null?null:Security::sanitizeInput($dataval['projrole'],"string_spl_char");
            $promotordtlmodel->ppd_promsummary=$dataval['promotesummrys']==null?null:$dataval['promotesummrys'];
            $promotordtlmodel->ppd_statemst_fk=$dataval['proj_state']==null?null:Security::sanitizeInput($dataval['proj_state'],"number");
            $promotordtlmodel->ppd_citymst_fk=$dataval['proj_cty']==null?null:Security::sanitizeInput($dataval['proj_cty'],"number");
            $promotordtlmodel->ppd_countrymst_fk=$dataval['proj_cntry']==null?null:Security::sanitizeInput($dataval['proj_cntry'],"number");
        foreach ($dataval['comp_logo'] as $key => $value) {
            if($value!=NULL)
            {
            $promotordtlmodel->ppd_promoterlogo=$value==null?null:$value;
            }
        }
            if(!empty($dataval['proj_line'])){
            $promotordtlmodel->ppd_latitude=$dataval['proj_latadd']==null?null:(string)$dataval['proj_latadd'];
            $promotordtlmodel->ppd_longitude=$dataval['proj_longadd']==null?null:(string)$dataval['proj_longadd'];
            }
            // $promotordtlmodel->projpromoterdtls_pk=$projpk;

            $model1 = ProjecttmpTbl::find()
            ->where(['projecttmp_pk' => $projpk])
            ->one();
            
            if($promotordtlmodel->save()){
                // $model1->prjt_projpromoterdtls_fk = Strval($model1->prjt_projpromoterdtls_fk==null?$promotordtlmodel->projpromoterdtls_pk:$model1->prjt_projpromoterdtls_fk.','.$promotordtlmodel->projpromoterdtls_pk);
                if($model1->prjt_projpromoterdtls_fk==null){
                    $model1->prjt_projpromoterdtls_fk = $promotordtlmodel->projpromoterdtls_pk;
                }else{
                    $model1->prjt_projpromoterdtls_fk = $model1->prjt_projpromoterdtls_fk.','.$promotordtlmodel->projpromoterdtls_pk;
                }
                $model1->prjt_projpromoterdtls_fk = strval($model1->prjt_projpromoterdtls_fk );
                if($model1->save())
                    {
                        $result=array(
                            'status' => 200,
                            'statusmsg' => 'success',
                            'flag'=>'S',
                            'msg'=>'success',
                            'data'=>$promotordtlmodel->projpromoterdtls_pk,
                        );
                        return $result;
                    }else{
                        echo "<pre>";print_r($model1->getErrors());
                    }
                }else{
                    echo "<pre>";print_r($promotordtlmodel->getErrors());
                }
        }
        if($type=="fetch"){
            $model = ProjpromoterdtlsTbl::find()
            ->select(['*'])
            ->orderBy(['ppd_promotername'=>SORT_ASC])
            ->asArray()->all();

            $model1 = ProjecttmpTbl::find()
            ->select(['prjt_projpromoterdtls_fk'])
            ->where(['projecttmp_pk' => $projpk])
            ->one();
            $list = explode(",",$model1->prjt_projpromoterdtls_fk);
            $data = [];
            $selected = [];
            foreach($model as $val){
                $temp = [];
                $temp['proname'] = $val['ppd_promotername'];
                $temp['website'] = $val['ppd_website'];
                $temp['prorefno'] = $val['ppd_promoterrefno'];
                $temp['proj_line'] = $val['ppd_address'];
                $temp['otherinfo'] = $val['ppd_others'];
                $temp['projrole'] = $val['ppd_projectrole'];
                $temp['promotesummrys'] = $val['ppd_promsummary'];
                $temp['proj_state'] = $val['ppd_statemst_fk'];
                $temp['proj_cty'] = $val['ppd_citymst_fk'];
                $temp['proj_cntry'] = $val['ppd_countrymst_fk'];
                $temp['pk'] = $val['projpromoterdtls_pk'];
                $temp['comp_logo'] = $val['ppd_promoterlogo'];
                $temp['proj_latadd'] = $val['ppd_latitude'];
                $temp['proj_longadd'] = $val['ppd_longitude'];
                if(!empty($val['ppd_countrymst_fk'])){
                    $temp['country']=CountrymstTblQuery::getcountry($val['ppd_countrymst_fk']);
                }
                if(!empty($val['ppd_statemst_fk'])){
                    $temp['state']=StatemstTblQuery::getstate($val['ppd_statemst_fk']);
                }
                if(!empty($val['ppd_citymst_fk'])){
                    $temp['city']=  \api\modules\mst\models\CitymstTblQuery::getcity($val['ppd_citymst_fk']);
                }
                array_push($data,$temp);
            }
            $maped = [];
            for($i=0;$i<count($data);$i++){
                if(in_array($data[$i]['pk'],$list)){
                    $data[$i]['selected']=true;
                    array_push($selected,$data[$i]);
                    array_push($maped,$data[$i]['pk']);
                }
                else{
                    $data[$i]['selected']=false;
                }
                if(!empty($data[$i]['ppd_countrymst_fk'])){
                    $data[$i]['country']=CountrymstTblQuery::getcountry($data[$i]['ppd_countrymst_fk']);
                }
                if(!empty($data[$i]['ppd_statemst_fk'])){
                    $data[$i]['state']=StatemstTblQuery::getstate($data[$i]['ppd_statemst_fk']);
                }
                if(!empty($data[$i]['ppd_citymst_fk'])){
                    $data[$i]['city']=\api\modules\mst\models\CitymstTblQuery::getcity($val['ppd_citymst_fk']);
                }
            }

            $result=array(
                'data' => $data,
                'selected' => $selected,
                'maped' => $maped, 
            );

            return $result;

        }
        if($type=="delete"){
            $model1 = ProjecttmpTbl::find()
            ->select(['*'])
            ->where(['projecttmp_pk' => $projpk])
            ->one();
            $list = explode(",",$model1->prjt_projpromoterdtls_fk);
            $index = array_search($dataval,$list);
            array_splice($list,$index,1);
            $list_final = implode(",",$list);
            $model1->prjt_projpromoterdtls_fk = $list_final;

            if($model1->save())
        {
             $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($model1->getErrors());
        }
        return $result;
    }
    if($type=="map"){
        $list_final = [];
        $model1 = ProjecttmpTbl::find()
        ->select(['*'])
        ->where(['projecttmp_pk' => $projpk])
        ->one();
        // $list = explode(",",$model1->prjt_projpromoterdtls_fk);
        for($j=0;$j<count($dataval);$j++){
            if($dataval[$j]['selected']==true){
                // if(empty(array_search($dataval[$j]['pk'],$list))){
                array_push($list_final,$dataval[$j]['pk']);
                // }
            }
        }
        $list_final = implode(",",$list_final);
        $model1->prjt_projpromoterdtls_fk = $list_final;
        if($model1->save())
    {
         $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'success'
        );
    }else{
        echo "<pre>";print_r($model1->getErrors());
    }
    return $result;
}
if($type=="remap"){
    $list_final = [];
    $model1 = ProjecttmpTbl::find()
    ->select(['*'])
    ->where(['projecttmp_pk' => $projpk])
    ->one();
    for($j=0;$j<count($dataval);$j++){
        array_push($list_final,$dataval[$j]['pk']);
    }
    $list_final = implode(",",$list_final);
    $model1->prjt_projpromoterdtls_fk = $list_final;
    if($model1->save())
{
     $result=array(
        'status' => 200,
        'statusmsg' => 'success',
        'flag'=>'S',
        'msg'=>'success'
    );
}else{
    echo "<pre>";print_r($model1->getErrors());
}
return $result;
}
if($type=="update"){
    $model = ProjpromoterdtlsTbl::find()
            ->select(['*'])
            ->andWhere(['projpromoterdtls_pk'=>$promopk])
            ->one();

            $model->ppd_updatedon = date('Y-m-d H:i:s');
            $model->ppd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ppd_updatedbyipaddr = \common\components\Common::getIpAddress();
            $model->ppd_promotername=Security::sanitizeInput($dataval['proname'],"string");
            $model->ppd_website=$dataval['website'];
            $model->ppd_promoterrefno=$dataval['prorefno'];
            $model->ppd_address=$dataval['proj_line']==null?null:Security::sanitizeInput($dataval['proj_line'],"string_spl_char");
            $model->ppd_others=$dataval['otherinfo']==null?null:Security::sanitizeInput($dataval['otherinfo'],"string_spl_char");
            $model->ppd_projectrole=$dataval['projrole']==null?null:Security::sanitizeInput($dataval['projrole'],"string_spl_char");
            $model->ppd_promsummary=$dataval['promotesummrys']==null?null:$dataval['promotesummrys'];
            $model->ppd_statemst_fk=$dataval['proj_state']==null?null:Security::sanitizeInput($dataval['proj_state'],"number");
            $model->ppd_citymst_fk=$dataval['proj_cty']==null?null:Security::sanitizeInput($dataval['proj_cty'],"number");
            $model->ppd_countrymst_fk=$dataval['proj_cntry']==null?null:Security::sanitizeInput($dataval['proj_cntry'],"number");
        foreach ($dataval['comp_logo'] as $key => $value) {
            if($value!=NULL)
            {
            $model->ppd_promoterlogo=$value==null?null:$value;
            }
        }
            if(!empty($dataval['proj_line'])){
            $model->ppd_latitude=$dataval['proj_latadd']==null?null:(string)$dataval['proj_latadd'];
            $model->ppd_longitude=$dataval['proj_longadd']==null?null:(string)$dataval['proj_longadd'];
            }

            if($model->save())
            {
                 $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'success'
                );
            }else{
                echo "<pre>";print_r($model->getErrors());
            }
            return $result;

}
 }
    
    public function promotsref($data){

        $model = ProjpromoterdtlsTbl::find()
        ->select(['*'])
        ->andWhere(['ppd_promoterrefno'=>$data['refno']])
        ->asArray()->all();
        if(empty($model)){
            return 'new';
        }else{
            return 'duplicate';
        }
    }

    public function addInvestmentGuide($data){
        $invGuideArray = $data['investmentGuideData'];  
        $projectPk = Security::decrypt($invGuideArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            $model->prjt_projinvproced = $invGuideArray['prjt_projinvproced'];

            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Investment Guide Add / Updated successfully!',
                    'returndata' => $model,
                );                
            }
            return json_encode($result);
        }
    }
    public function getachiveacred($data) {
        
        if(!empty($data['projectpk']))
        {
        $accred=[];
        $achive=[];
        $model = ProjecttmpTbl::find()
        ->where('projecttmp_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
        ->one();
        $accredmodel = ProjaccachievetmpTbl::find()
                ->select('mcad_title,mcad_issuedon,mcad_desc,memcompacomplishdtls_pk')
                ->where('paat_projecttmp_fk=:projectpk and paat_type=1',[':projectpk'=> Security::decrypt($data['projectpk'])])
                ->leftJoin('memcompacomplishdtls_tbl','paat_memcompacomplishdtls_fk=memcompacomplishdtls_pk')
                ->orderBy('paad_index asc')
                ->asArray()->all();
        $achivemodel = ProjaccachievetmpTbl::find()
                ->select('mcad_title,mcad_desc,mcad_achvyear,memcompacomplishdtls_pk')
                ->where('paat_projecttmp_fk=:projectpk and paat_type=2',[':projectpk'=> Security::decrypt($data['projectpk'])])
                ->leftJoin('memcompacomplishdtls_tbl','paat_memcompacomplishdtls_fk=memcompacomplishdtls_pk')
                ->orderBy('paad_index asc')
                ->asArray()->all();
        
         $licensemodel = ProjacqlictmpTbl::find()
                ->select('li_referenceno,li_lictitleen,li_validity,licensinginfo_pk')
                ->where('palt_projecttmp_fk=:projectpk',[':projectpk'=> Security::decrypt($data['projectpk'])])
                ->leftJoin('licensinginfo_tbl','licensinginfo_pk=palt_licensinginfo_fk')
                ->asArray()->all();
        
         $certmodel = ProjaccachievetmpTbl::find()
                ->select('mcad_title,mcad_desc,mcad_achvyear,memcompacomplishdtls_pk')
                ->where('paat_projecttmp_fk=:projectpk and paat_type=4',[':projectpk'=> Security::decrypt($data['projectpk'])])
                ->leftJoin('memcompacomplishdtls_tbl','paat_memcompacomplishdtls_fk=memcompacomplishdtls_pk')
                ->orderBy('paad_index asc')
                ->asArray()->all();
        
         $awardmodel = ProjaccachievetmpTbl::find()
                ->select('mcad_title,mcad_desc,mcad_achvyear,memcompacomplishdtls_pk')
                ->where('paat_projecttmp_fk=:projectpk and paat_type=3',[':projectpk'=> Security::decrypt($data['projectpk'])])
                ->leftJoin('memcompacomplishdtls_tbl','paat_memcompacomplishdtls_fk=memcompacomplishdtls_pk')
                ->orderBy('paad_index asc')
                ->asArray()->all();
        
        if(!empty($licensemodel))
        {
        foreach ($licensemodel as $key => $value) {
            $lice[$key]['licenseid']=$value['licensinginfo_pk'];
            $lice[$key]['licensename']=$value['li_lictitleen'];
            $lice[$key]['licenserefno']=$value['li_referenceno'];
            $lice[$key]['validity']=!empty($value['li_validity'])?date('d/m/Y', strtotime($value['li_validity'])):"Nil";
        }
        }
        if(!empty($accredmodel))
        {
        foreach ($accredmodel as $key => $value) {
            $accred[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $accred[$key]['certificateName']=$value['mcad_title'];
            $accred[$key]['certificatenum']=$value['mcad_accachieveno'];
            $accred[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $accred[$key]['governingBody']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
        }
        }
        if(!empty($achivemodel)){
        foreach ($achivemodel as $key => $value) {
            $achive[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $achive[$key]['title']=$value['mcad_title'];
            $achive[$key]['description']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
            $achive[$key]['year']=!empty($value['mcad_achvyear'])?$value['mcad_achvyear']:"Nil";
        }       
        }
        if(!empty($certmodel)){
        foreach ($certmodel as $key => $value) {
            $cert[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $cert[$key]['certificateName']=$value['mcad_title'];
            $cert[$key]['certificatenum']=$value['mcad_accachieveno'];
            $cert[$key]['certificatedesc']=$value['mcad_desc'];
            $cert[$key]['certurl']=$value['mcad_websiteurl'];
            $cert[$key]['uploadfile'][]=$value['mcad_uploadpath'];
            $cert[$key]['relatedfile'][]=$value['mcad_relateddocs'];
            $cert[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $cert[$key]['governingBody']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
        }
        }
        if(!empty($awardmodel)){
        foreach ($awardmodel as $key => $value) {
            $awar[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $awar[$key]['awardName']=$value['mcad_title'];
            $awar[$key]['awardnum']=$value['mcad_accachieveno'];
            $awar[$key]['awarddesc']=$value['mcad_desc'];
            $awar[$key]['awarurl']=$value['mcad_websiteurl'];
            $awar[$key]['uploadfile'][]=$value['mcad_uploadpath'];
            $awar[$key]['relatedfile'][]=$value['mcad_relateddocs'];
            $awar[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $awar[$key]['governingBody']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
        }
      
        }
         if (empty($achive) && empty($accred)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$accred,$achive,$lice,$cert,$awar];
        }
        }
    
    }
    public function deleteteam($data){
        $projectPk = $data['projectpk'];
        $deletePk = $data['deleteteam'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
       
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project team member unmapped successfully!',
        );

        if($model){      
            $arr =  $model->prjt_projteam ;
            $arr = Json_decode($arr);            
            $arr1 = [];
            foreach($arr as $value){
                if($value!=$deletePk){
                    array_push($arr1,$value);
                }
            }
            $model->prjt_projteam = Json_encode($arr1);
            if($model->save()==false){
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!'
                );
            }
        
        }
        return json_encode($result);
    }
    public function getselectedteam($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjt_projteam,
        );
        if(!$model){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Empty!'
                );
        
        }
        return json_encode($result);
    }
    public function addteammember($data){
        $projectPk = $data['projectpk'];
        $userPk = $data['userpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        
        if(empty($model->prjt_projteam))
        {
            $model->prjt_projteam="[$userPk]";
        }else{
            $expks= json_decode($model->prjt_projteam);
            $expks= implode(',', $expks);
            $model->prjt_projteam= "[$expks,$userPk]";
        }
        $model->save();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjt_projteam,
        );
        if(!$model){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Empty!'
                );
        
        }
        return json_encode($result);
    }
    public function addcontmember($data){
        $projectPk = $data['projectpk'];
        $userPk = $data['userpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        
        if(empty($model->prjt_contactinfo))
        {
            $model->prjt_contactinfo="[$userPk]";
        }else{
            $expks= json_decode($model->prjt_contactinfo);
            $expks= implode(',', $expks);
            $model->prjt_contactinfo= "[$expks,$userPk]";
        }
        $model->save();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjt_contactinfo,
        );
        if(!$model){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Empty!'
                );
        
        }
        return json_encode($result);
    }
    public function deletecontact($data){
        $projectPk = $data['projectpk'];
        $deletePk = $data['deletecontact'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
       
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project contact unmapped successfully!',
        );

        if($model){      
            $arr =  $model->prjt_contactinfo ;
            $arr = Json_decode($arr);            
            $arr1 = [];
            foreach($arr as $value){
                if($value!=$deletePk){
                    array_push($arr1,$value);
                }
            }
            $model->prjt_contactinfo = Json_encode($arr1);
            if($model->save()==false){
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!'
                );
            }
        
        }
        return json_encode($result);
    }
    
    public function addinvestors($data)
    {
        $dataval=$data['investorinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $projectPk = Security::decrypt($dataval['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjinvmappingtmpTbl::find()->where('pimt_emailid=:email',array(':email'=>$dataval['pimt_emailid']))->one();
        if(empty($model)){        
        $investormodel = new ProjinvmappingtmpTbl();
        $investormodel->pimt_memberregmst_fk=$companypk;
        $investormodel->pimt_projecttmp_fk=$projectPk;
        $investormodel->pimt_name=Security::sanitizeInput($dataval['pimt_name'],'string');
        $investormodel->pimt_status=Security::sanitizeInput(0,'number');
        $investormodel->pimt_emailid=$dataval['pimt_emailid'];
        $investormodel->pimt_submittedon = date('Y-m-d H:i:s');
        $investormodel->pimt_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $investormodel->pimt_submittedbyipaddr = \common\components\Common::getIpAddress();
        if($investormodel->save())
        {
            $data1['name']=$investormodel->pimt_name;
            $data1['investorid']=$investormodel->projinvmappingtmp_pk;
            $data1['emailid']=$investormodel->pimt_emailid;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($investormodel->getErrors());
        }}else{
            $data1['name']=$investormodel->pimt_name;
            $data1['investorid']=$investormodel->projinvmappingtmp_pk;
            $data1['emailid']=$investormodel->pimt_emailid;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'dup',
                'flag'=>'F',
                'msg'=>'duplicate'
            );
        }
        return $result;
}


    public function getselectedcontact($data){
        $projectPk = $data['projectpk'];
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjt_contactinfo,
        );
        if(!$model){
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Empty!'
                );
        
        }
        return json_encode($result);
    }
    public function editoverallproject($data){
        $pk = Security::decrypt($data['projectpk']);
        if(!empty($pk))
        {
        $model = ProjecttmpTbl::find()
            ->select(['*'])
            ->leftJoin('sectormst_tbl','SectorMst_Pk=prjt_sectormst_fk')
            ->leftJoin('industrymst_tbl','IndustryMst_Pk=prjt_industrymst_fk')
            ->leftJoin('statemst_tbl','StateMst_Pk=prjt_statemst_fk')
            ->leftJoin('citymst_tbl','CityMst_Pk=prjt_citymst_fk')
            ->leftJoin('projtechnicaltmp_tbl','ptt_projecttmp_fk=projecttmp_pk')
            ->leftJoin('projtechdocumentstmp_tbl','ptdt_projecttmp_fk=projecttmp_pk')
            ->leftJoin('projinvinfotmp_tbl','piit_projecttmp_fk=projecttmp_pk')
        ->where('projecttmp_pk=:id',array(':id' =>  Security::sanitizeInput($pk,"number")))->asArray()->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $pk");
        }
        }
    }

    public function projbene($data){
        $pk = Security::decrypt($data['pk']);
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:id',array(':id' =>  Security::sanitizeInput($pk,"number")))->one();
        if($model){
            $model->prjt_benefeat = $data['projbene']['prjt_benefeat'];
            $model->prjt_investorbenefits = $data['projbene']['piid_investorbenefits'];
            $model->prjt_updatedon = date('Y-m-d H:i:s');
            $model->prjt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjt_updatedbyipaddr =\common\components\Common::getIpAddress();

            if($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Added successfully!',
                    'returndata' => $model
                );                
            }
            return json_encode($result);
        }
        
    }

    public function approvedmovehstry($projectPk){
        $projdtlsmodel = ProjectdtlsTbl::find()->where("prjd_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($projdtlsmodel))
        {
            ProjecttmpTblQuery::movemainhistry($projectPk);
        }
        $projtempmodel = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($projtempmodel))
        {

            $projectdttls=ProjectdtlsTbl::find()->where("prjd_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
            if(empty($projectdttls))
            {
            $projectdttls=new ProjectdtlsTbl();
            }
            
            $projectdttls->prjd_projecttmp_fk=$projectPk;
            $projectdttls->prjd_memberregmst_fk=$projtempmodel->prjt_memberregmst_fk;
            $projectdttls->prjd_projectid=$projtempmodel->prjt_projectid;
            $projectdttls->prjd_referenceno=$projtempmodel->prjt_referenceno;
            $projectdttls->prjd_projname=$projtempmodel->prjt_projname;
            $projectdttls->prjd_shortsummary=$projtempmodel->prjt_shortsummary;
            $projectdttls->prjd_projdesc=$projtempmodel->prjt_projdesc;
            $projectdttls->prjd_sectormst_fk=$projtempmodel->prjt_sectormst_fk;
            $projectdttls->prjd_industrymst_fk=$projtempmodel->prjt_industrymst_fk;
            $projectdttls->prjd_benefeat=$projtempmodel->prjt_benefeat;
            $projectdttls->prjd_investorbenefits=$projtempmodel->prjt_investorbenefits;
            $projectdttls->prjd_msgtoinvestors=$projtempmodel->prjt_msgtoinvestors;
            $projectdttls->prjd_projtype=$projtempmodel->prjt_projtype;
            $projectdttls->prjd_projcost=$projtempmodel->prjt_projcost;
            $projectdttls->prjd_dateofinception=$projtempmodel->prjt_dateofinception;
            $projectdttls->prjd_plannedprojstrtdt=$projtempmodel->prjt_plannedprojstrtdt;
            $projectdttls->prjd_plannedprojenddt=$projtempmodel->prjt_plannedprojenddt;
            $projectdttls->prjd_projstage=$projtempmodel->prjt_projstage;
            $projectdttls->prjd_projstatus=$projtempmodel->prjt_projstatus;
            $projectdttls->prjd_projzone=$projtempmodel->prjt_projzone;
            $projectdttls->prjd_natureofprop=$projtempmodel->prjt_natureofprop;
            $projectdttls->prjd_proptype=$projtempmodel->prjt_proptype;
            $projectdttls->prjd_addressline=$projtempmodel->prjt_addressline;
            $projectdttls->prjd_latitude=$projtempmodel->prjt_latitude;
            $projectdttls->prjd_longitude=$projtempmodel->prjt_longitude;
            $projectdttls->prjd_statemst_fk=$projtempmodel->prjt_statemst_fk;
            $projectdttls->prjd_citymst_fk=$projtempmodel->prjt_citymst_fk;
            $projectdttls->prjd_memcompmplocationdtls_fk=$projtempmodel->prjt_memcompmplocationdtls_fk;
            $projectdttls->prjd_projteam=$projtempmodel->prjt_projteam;
            $projectdttls->prjd_contactinfo=$projtempmodel->prjt_contactinfo;
            $projectdttls->prjd_projinvproced=$projtempmodel->prjt_projinvproced;
            $projectdttls->prjd_licensauthoritiesmst_fk=$projtempmodel->prjt_licensauthoritiesmst_fk;
            $projectdttls->prjd_website=$projtempmodel->prjt_website;
            $projectdttls->prjd_socialmedia=$projtempmodel->prjt_socialmedia;
            $projectdttls->prjd_finindicators=$projtempmodel->prjt_finindicators;
            $projectdttls->prjd_roi=$projtempmodel->prjt_roi;
            $projectdttls->prjd_riskfactors=$projtempmodel->prjt_riskfactors;
            $projectdttls->prjd_riskdisclosures=$projtempmodel->prjt_riskdisclosures;
            $projectdttls->prjd_projdiligenceform_fk=$projtempmodel->prjt_projdiligenceform_fk;
            $projectdttls->prjd_financialdocs=$projtempmodel->prjt_financialdocs;
            $projectdttls->prjd_submittedon=$projtempmodel->prjt_submittedon;
            $projectdttls->prjd_submittedby=$projtempmodel->prjt_submittedby;
            $projectdttls->prjd_submittedbyipaddr=$projtempmodel->prjt_submittedbyipaddr;
            $projectdttls->prjd_apprdeclon=$projtempmodel->prjt_apprdeclon;
            $projectdttls->prjd_apprdeclby=$projtempmodel->prjt_apprdeclby;
            $projectdttls->prjd_apprdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
            $projectdttls->prjd_appldeccomments=$projtempmodel->prjt_appldeccomments;
            if($projectdttls->save())
            {
                $projaccahivetemp= ProjaccachievetmpTbl::find()->where("paat_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projaccahivetemp))
                {
                    ProjaccachievedtlsTbl::deleteAll('paad_projectdtls_fk=:pk',[':pk'=>$projectdttls->projectdtls_pk]);
                    foreach ($projaccahivetemp as $key => $value) {
                        
                    $projaccahivedtls=new ProjaccachievedtlsTbl();
                    $projaccahivedtls->paad_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projaccahivedtls->paad_memcompacomplishdtls_fk=$value->paat_memcompacomplishdtls_fk;
                    $projaccahivedtls->paad_type=$value->paat_type;
                    $projaccahivedtls->paad_memcompfiledtls_fk=$value->paat_memcompfiledtls_fk;
                    $projaccahivedtls->paad_index=$value->paat_index;
                    $projaccahivedtls->paad_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projaccahivedtls->paad_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projaccahivedtls->paad_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projaccahivedtls->paad_submittedon=$value->paat_submittedon;
                    $projaccahivedtls->paad_submittedby=$value->paat_submittedby;
                    $projaccahivedtls->paad_submittedbyipaddr=$value->paat_submittedbyipaddr;
                    $projaccahivedtls->save();
                    }
                }
                
                $projparttemp= ProjectpartnertmpTbl::find()->where("prjpt_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projparttemp))
                {
                    ProjectpartnerdtlsTbl::deleteAll('prjpd_projectdtls_fk=:pk',[':pk'=>$projectdttls->projectdtls_pk]);
                    foreach ($projparttemp as $key => $parttemp) {
                        
                    $projpartdtls =new ProjectpartnerdtlsTbl();
                    $projpartdtls->prjpd_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projpartdtls->prjpd_partnermst_fk=$parttemp->prjpt_partnermst_fk;
                    $projpartdtls->prjpd_partnerorginfo=$parttemp->prjpt_partnerorginfo;
                    $projpartdtls->prjpd_index=$parttemp->prjpt_index;
                    $projpartdtls->prjpd_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projpartdtls->prjpd_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projpartdtls->prjpd_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projpartdtls->prjpd_submittedon=$parttemp->prjpt_submittedon;
                    $projpartdtls->prjpd_submittedby=$parttemp->prjpt_submittedby;
                    $projpartdtls->prjpd_submittedbyipaddr=$parttemp->prjpt_submittedbyipaddr;
                    $projpartdtls->save();
                    }
                }
                $projfaqtemp= ProjfaqtmpTbl::find()->where("pft_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                
                if(!empty($projfaqtemp))
                {
                    ProjfaqdtlsTbl::deleteAll('pfd_projectdtls_fk=:pk',[':pk'=>$projectdttls->projectdtls_pk]);
                    foreach ($projfaqtemp as $key => $faqtemp) {
                    $projfaqdtls=new ProjfaqdtlsTbl();
                    $projfaqdtls->pfd_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projfaqdtls->pfd_question=$faqtemp->pft_question;
                    $projfaqdtls->pfd_answer=$faqtemp->pft_answer;
                    $projfaqdtls->pfd_type=$faqtemp->pft_type;
                    $projfaqdtls->pfd_index=$faqtemp->pft_index;
                    $projfaqdtls->pfd_status=$faqtemp->pft_status;
                    $projfaqdtls->pfd_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projfaqdtls->pfd_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projfaqdtls->pfd_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projfaqdtls->pfd_submittedon=$faqtemp->pft_submittedon;
                    $projfaqdtls->pfd_submittedby=$faqtemp->pft_submittedby;
                    $projfaqdtls->pfd_submittedbyipaddr=$faqtemp->pft_submittedbyipaddr;
                    $projfaqdtls->save();
                    }
             
                }
                
                $projtinvtemp= ProjinvinfotmpTbl::find()->where("piit_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projtinvtemp))
                {
                    $projtinvdtls=ProjinvinfodtlsTbl::find()->where("piid_projectdtls_fk =:pk",[':pk'=> $projectdttls->projectdtls_pk])->one();
                    if(empty($projtinvdtls))
                    {
                    $projtinvdtls=new ProjinvinfodtlsTbl();
                    }
                    $projtinvdtls->piid_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projtinvdtls->piid_invprefsrc=$projtinvtemp->piit_invprefsrc;
                    $projtinvdtls->piid_otherprefsrc=$projtinvtemp->piit_otherprefsrc;
                    $projtinvdtls->piid_totinvreqd=$projtinvtemp->piit_totinvreqd;
                    $projtinvdtls->piid_invreqdcurrencymst_fk=$projtinvtemp->piit_invreqdcurrencymst_fk;
                    $projtinvdtls->piid_totinvrecd=$projtinvtemp->piit_totinvrecd;
                    $projtinvdtls->piid_targetinvestors=$projtinvtemp->piit_targetinvestors;
                    $projtinvdtls->piid_investtype=$projtinvtemp->piit_investtype;
                    $projtinvdtls->piid_investmentstatus=$projtinvtemp->piit_investmentstatus;
                    $projtinvdtls->piid_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projtinvdtls->piid_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projtinvdtls->piid_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projtinvdtls->piid_submittedon=$projtinvtemp->piit_submittedon;
                    $projtinvdtls->piid_submittedby=$projtinvtemp->piit_submittedby;
                    $projtinvdtls->piid_submittedbyipaddr=$projtinvtemp->piit_submittedbyipaddr;
                    $projtinvdtls->save();
                }
                
                $projinvmaptemp= ProjinvmappingtmpTbl::find()->where("pimt_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projinvmaptemp))
                {
                    ProjinvmappingTbl::deleteAll('pim_projectdtls_fk=:pk',[':pk'=>$projectdttls->projectdtls_pk]);
                    
                    foreach ($projinvmaptemp as $key => $maptemp) {
                        
                    $projinvmapdtls=new ProjinvmappingTbl();
                    $projinvmapdtls->pim_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projinvmapdtls->pim_memberregmst_fk=$maptemp->pimt_memberregmst_fk;
                    $projinvmapdtls->pim_name=$maptemp->pimt_name;
                    $projinvmapdtls->pim_emailid=$maptemp->pimt_emailid;
                    $projinvmapdtls->pim_status=$maptemp->pimt_status;
                    $projinvmapdtls->pim_order=$maptemp->pimt_order;
                    $projinvmapdtls->pim_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projinvmapdtls->pim_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projinvmapdtls->pim_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projinvmapdtls->pim_submittedon=$maptemp->pimt_submittedon;
                    $projinvmapdtls->pim_submittedby=$maptemp->pimt_submittedby;
                    $projinvmapdtls->pim_submittedbyipaddr=$maptemp->pimt_submittedbyipaddr;
                    $projinvmapdtls->save();
                    }
                }
                
                $projtechtemp= ProjtechnicaltmpTbl::find()->where("ptt_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projtechtemp))
                {
                    $projtechdtls=ProjtechnicalTbl::find()->where("pt_projectdtls_fk =:pk",[':pk'=> $projectdttls->projectdtls_pk])->one();
                    if(empty($projtechdtls))
                    {
                    $projtechdtls=new ProjtechnicalTbl();
                    }
                    $projtechdtls->pt_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projtechdtls->pt_techinfo=$projtechtemp->ptt_techinfo;
                    $projtechdtls->pt_techapprovals=$projtechtemp->ptt_techapprovals;
                    $projtechdtls->pt_employoppor=$projtechtemp->ptt_employoppor;
                    $projtechdtls->pt_infrastructure=$projtechtemp->ptt_infrastructure;
                    $projtechdtls->pt_tourism=$projtechtemp->ptt_tourism;
                    $projtechdtls->pt_employment=$projtechtemp->ptt_employment;
                    $projtechdtls->pt_supplychain=$projtechtemp->ptt_supplychain;
                    $projtechdtls->pt_environmental=$projtechtemp->ptt_environmental;
                    $projtechdtls->pt_marketoverview=$projtechtemp->ptt_marketoverview;
                    $projtechdtls->pt_marketneeds=$projtechtemp->ptt_marketneeds;
                    $projtechdtls->pt_markettrends=$projtechtemp->ptt_marketneeds;
                    $projtechdtls->pt_similrefer=$projtechtemp->ptt_similrefer;
                    $projtechdtls->pt_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projtechdtls->pt_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projtechdtls->pt_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projtechdtls->pt_submittedon=$projtechtemp->ptt_submittedon;
                    $projtechdtls->pt_submittedby=$projtechtemp->ptt_submittedby;
                    $projtechdtls->pt_submittedbyipaddr=$projtechtemp->ptt_submittedbyipaddr;
                    $projtechdtls->save();
                     
                }
                
                $projecttechdoctemp= ProjtechdocumentstmpTbl::find()->where("ptdt_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projecttechdoctemp))
                {
                    $projecttechdocdtls=ProjtechdocumentsTbl::find()->where("ptd_projectdtls_fk =:pk",[':pk'=> $projectdttls->projectdtls_pk])->one();
                    if(empty($projecttechdocdtls))
                    {
                    $projecttechdocdtls=new ProjtechdocumentsTbl();
                    }
                    $projecttechdocdtls->ptd_projectdtls_fk=$projectdttls->projectdtls_pk;
                    $projecttechdocdtls->ptd_typeofdoc=$projecttechdoctemp->ptdt_typeofdoc;
                    $projecttechdocdtls->ptd_techdoc=$projecttechdoctemp->ptdt_techdoc;
                    $projecttechdocdtls->ptd_approvedon=$projtempmodel->prjt_apprdeclon;
                    $projecttechdocdtls->ptd_approvedby=$projtempmodel->prjt_apprdeclby;
                    $projecttechdocdtls->ptd_approvedbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projecttechdocdtls->ptd_submittedon=$projecttechdoctemp->ptdt_submittedon;
                    $projecttechdocdtls->ptd_submittedby=$projecttechdoctemp->ptdt_submittedby;
                    $projecttechdocdtls->ptd_submittedbyipaddr=$projecttechdoctemp->ptdt_submittedbyipaddr;
                    $projecttechdocdtls->save();
                }
            }

        }
        
    }
    
    public function viewproject($data){
        $pk = Security::decrypt($data['projectpk']);
        $pk = 836;
//        Project Detail
        $mem = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $projtmp = ProjecttmpTbl::find()
            ->select(['*'])
            ->leftJoin('sectormst_tbl','SectorMst_Pk=prjt_sectormst_fk')
            ->leftJoin('industrymst_tbl','IndustryMst_Pk=prjt_industrymst_fk')
            ->leftJoin('statemst_tbl','StateMst_Pk=prjt_statemst_fk')
            ->leftJoin('citymst_tbl','CityMst_Pk=prjt_citymst_fk')
            ->leftJoin('projtechnicaltmp_tbl','ptt_projecttmp_fk=projecttmp_pk')
            ->leftJoin('projtechdocumentstmp_tbl','ptdt_projecttmp_fk=projecttmp_pk')
            ->leftJoin('projpromotertmp_tbl','ppt_projecttmp_fk=projecttmp_pk')
//            ->leftJoin('projtendtmp_tbl','ptt_projecttmp_fk=projecttmp_pk')
            ->leftJoin('projinvinfotmp_tbl','piit_projecttmp_fk=projecttmp_pk')
        ->where('projecttmp_pk=:id',array(':id' =>  Security::sanitizeInput($pk,"number")))->asArray()->one();
        
//        Team details
        $teamarr =  $projtmp['prjt_projteam'] ;
        $teamarr = Json_decode($teamarr);
        if($teamarr!=[]){
        $teampk = implode(',',$teamarr);
        $team = UsermstTbl::find()
                ->select(['*'])
                ->where("UserMst_Pk IN ($teampk)")
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                ->andWhere('UM_MemberRegMst_Fk=:fk',array(':fk' =>  $mem))
                ->andWhere('UM_Status=:status',array(':status'=>'A'))
                ->asArray()->all();
        }
        
//        Contact details
        $contactarr =  $projtmp['prjt_contactinfo'] ;
        if(!empty($contactarr))
        {
        $contactarr = Json_decode($contactarr);
        $cntctpk = implode(',',$contactarr);
        $mem = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $contact = UsermstTbl::find()
                ->select(['*'])
                ->where("UserMst_Pk IN ($cntctpk)")
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                ->andWhere('UM_MemberRegMst_Fk=:fk',array(':fk' =>  $mem))
                ->andWhere('UM_Status=:status',array(':status'=>'A'))
                ->asArray()->all();
        }
        
//        Invite Investor details
      $inviteinv = ProjinvmappingtmpTbl::find()
                ->select(['*'])
                ->where('pimt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($pk,"number")))
                ->asArray()->all();
        $investor=[];
        if (!empty($inviteinv)){
        foreach ($inviteinv as $key => $value) {
            $investor[$key]['name']=$value['pimt_name'];
            $investor[$key]['investorid']=$value['projinvmappingtmp_pk'];
            $investor[$key]['emailid']=$value['pimt_emailid'];
        }
        }
        $data['prjtmpdtl']=$projtmp;
        $data['prjtteam']=$team;
        $data['prjtcontact']=$contact;
        $data['prjtinviteinv']=$investor;
        
        if($projtmp){
            return $data;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    
    public function declinedmovehstry($projectPk){
        $projtempmodel = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($projtempmodel))
        {
            $projecthstry=new ProjecthstyTbl();
            $projecthstry->prjh_projecttmp_fk=$projectPk;
            $projecthstry->prjh_memberregmst_fk=$projtempmodel->prjt_memberregmst_fk;
            $projecthstry->prjh_projectid=$projtempmodel->prjt_projectid;
            $projecthstry->prjh_referenceno=$projtempmodel->prjt_referenceno;
            $projecthstry->prjh_projname=$projtempmodel->prjt_projname;
            $projecthstry->prjh_shortsummary=$projtempmodel->prjt_shortsummary;
            $projecthstry->prjh_projdesc=$projtempmodel->prjt_projdesc;
            $projecthstry->prjh_sectormst_fk=$projtempmodel->prjt_sectormst_fk;
            $projecthstry->prjh_industrymst_fk=$projtempmodel->prjt_industrymst_fk;
            $projecthstry->prjh_benefeat=$projtempmodel->prjt_benefeat;
            $projecthstry->prjh_investorbenefits=$projtempmodel->prjt_investorbenefits;
            $projecthstry->prjh_msgtoinvestors=$projtempmodel->prjt_msgtoinvestors;
            $projecthstry->prjh_projtype=$projtempmodel->prjt_projtype;
            $projecthstry->prjh_projcost=$projtempmodel->prjt_projcost;
            $projecthstry->prjh_dateofinception=$projtempmodel->prjt_dateofinception;
            $projecthstry->prjh_plannedprojstrtdt=$projtempmodel->prjt_plannedprojstrtdt;
            $projecthstry->prjh_plannedprojenddt=$projtempmodel->prjt_plannedprojenddt;
            $projecthstry->prjh_projstage=$projtempmodel->prjt_projstage;
            $projecthstry->prjh_projstatus=$projtempmodel->prjt_projstatus;
            $projecthstry->prjh_projzone=$projtempmodel->prjt_projzone;
            $projecthstry->prjh_natureofprop=$projtempmodel->prjt_natureofprop;
            $projecthstry->prjh_proptype=$projtempmodel->prjt_proptype;
            $projecthstry->prjh_addressline=$projtempmodel->prjt_addressline;
            $projecthstry->prjh_latitude=$projtempmodel->prjt_latitude;
            $projecthstry->prjh_longitude=$projtempmodel->prjt_longitude;
            $projecthstry->prjh_statemst_fk=$projtempmodel->prjt_statemst_fk;
            $projecthstry->prjh_citymst_fk=$projtempmodel->prjt_citymst_fk;
            $projecthstry->prjh_memcompmplocationdtls_fk=$projtempmodel->prjt_memcompmplocationdtls_fk;
            $projecthstry->prjh_projteam=$projtempmodel->prjt_projteam;
            $projecthstry->prjh_contactinfo=$projtempmodel->prjt_contactinfo;
            $projecthstry->prjh_projinvproced=$projtempmodel->prjt_projinvproced;
            $projecthstry->prjh_licensauthoritiesmst_fk=$projtempmodel->prjt_licensauthoritiesmst_fk;
            $projecthstry->prjh_website=$projtempmodel->prjt_website;
            $projecthstry->prjh_socialmedia=$projtempmodel->prjt_socialmedia;
            $projecthstry->prjh_finindicators=$projtempmodel->prjt_finindicators;
            $projecthstry->prjh_roi=$projtempmodel->prjt_roi;
            $projecthstry->prjh_riskfactors=$projtempmodel->prjt_riskfactors;
            $projecthstry->prjh_riskdisclosures=$projtempmodel->prjt_riskdisclosures;
            $projecthstry->prjh_projdiligenceform_fk=$projtempmodel->prjt_projdiligenceform_fk;
            $projecthstry->prjh_financialdocs=$projtempmodel->prjt_financialdocs;
            $projecthstry->prjh_histcreatedon=date('Y-m-d H:i:s');
            $projecthstry->prjh_submittedon=$projtempmodel->prjt_submittedon;
            $projecthstry->prjh_submittedby=$projtempmodel->prjt_submittedby;
            $projecthstry->prjh_submittedbyipaddr=$projtempmodel->prjt_submittedbyipaddr;
            $projecthstry->prjh_apprdeclon=$projtempmodel->prjt_apprdeclon;
            $projecthstry->prjh_apprdeclby=$projtempmodel->prjt_apprdeclby;
            $projecthstry->prjh_apprdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
            $projecthstry->prjh_appldeccomments=$projtempmodel->prjt_appldeccomments;
            
            
            if($projecthstry->save())
            {
                $projaccahivetemp= ProjaccachievetmpTbl::find()->where("paat_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projaccahivetemp))
                {
                    foreach ($projaccahivetemp as $key => $value) {
                        
                    $projaccahivehstry=new ProjaccachievehstyTbl();
                    $projaccahivehstry->paah_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projaccahivehstry->paah_memcompacomplishdtls_fk=$value->paat_memcompacomplishdtls_fk;
                    $projaccahivehstry->paah_type=$value->paat_type;
                    $projaccahivehstry->paah_memcompfiledtls_fk=$value->paat_memcompfiledtls_fk;
                    $projaccahivehstry->paah_index=$value->paat_index;
                    $projaccahivehstry->paah_histcreatedon=date('Y-m-d H:i:s');
                    $projaccahivehstry->paah_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projaccahivehstry->paah_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projaccahivehstry->paah_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projaccahivehstry->paah_submittedon=$value->paat_submittedon;
                    $projaccahivehstry->paah_submittedby=$value->paat_submittedby;
                    $projaccahivehstry->paah_submittedbyipaddr=$value->paat_submittedbyipaddr;
                    $projaccahivehstry->save();
                    }
                }
                
                $projparttemp= ProjectpartnertmpTbl::find()->where("prjpt_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projparttemp))
                {
                    foreach ($projparttemp as $key => $parttemp) {
                        
                    $projparthstry =new ProjectpartnerhstyTbl();
                    $projparthstry->prjph_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projparthstry->prjph_partnermst_fk=$parttemp->prjpt_partnermst_fk;
                    $projparthstry->prjph_partnerorginfo=$parttemp->prjpt_partnerorginfo;
                    $projparthstry->prjph_index=$parttemp->prjpt_index;
                    $projparthstry->prjph_histcreatedon=date('Y-m-d H:i:s');
                    $projparthstry->prjph_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projparthstry->prjph_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projparthstry->prjph_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projparthstry->prjph_submittedon=$parttemp->prjpt_submittedon;
                    $projparthstry->prjph_submittedby=$parttemp->prjpt_submittedby;
                    $projparthstry->prjph_submittedbyipaddr=$parttemp->prjpt_submittedbyipaddr;
                    $projparthstry->save();
                    }
                }
                $projfaqtemp= ProjfaqtmpTbl::find()->where("pft_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                
                if(!empty($projfaqtemp))
                {
                    foreach ($projfaqtemp as $key => $faqtemp) {
                    $projfaqhstry=new ProjfaqhstyTbl();
                    $projfaqhstry->pfh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projfaqhstry->pfh_question=$faqtemp->pft_question;
                    $projfaqhstry->pfh_answer=$faqtemp->pft_answer;
                    $projfaqhstry->pfh_type=$faqtemp->pft_type;
                    $projfaqhstry->pfh_index=$faqtemp->pft_index;
                    $projfaqhstry->pfh_status=$faqtemp->pft_status;
                    $projfaqhstry->pfh_histcreatedon=date('Y-m-d H:i:s');
                    $projfaqhstry->pfh_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projfaqhstry->pfh_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projfaqhstry->pfh_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projfaqhstry->pfh_submittedon=$faqtemp->pft_submittedon;
                    $projfaqhstry->pfh_submittedby=$faqtemp->pft_submittedby;
                    $projfaqhstry->pfh_submittedbyipaddr=$faqtemp->pft_submittedbyipaddr;
                    $projfaqhstry->save();
                    }
             
                }
                
                $projtinvtemp= ProjinvinfotmpTbl::find()->where("piit_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projtinvtemp))
                {
                    $projtinvhstry=new ProjinvinfohstyTbl();
                    $projtinvhstry->piih_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projtinvhstry->piih_invprefsrc=$projtinvtemp->piit_invprefsrc;
                    $projtinvhstry->piih_otherprefsrc=$projtinvtemp->piit_otherprefsrc;
                    $projtinvhstry->piih_totinvreqd=$projtinvtemp->piit_totinvreqd;
                    $projtinvhstry->piih_invreqdcurrencymst_fk=$projtinvtemp->piit_invreqdcurrencymst_fk;
                    $projtinvhstry->piih_targetinvestors=$projtinvtemp->piit_targetinvestors;
                    $projtinvhstry->piih_totinvrecd=$projtinvtemp->piit_totinvrecd;
                    $projtinvhstry->piih_investtype=$projtinvtemp->piit_investtype;
                    $projtinvhstry->piih_investmentstatus=$projtinvtemp->piit_investmentstatus;
                    $projtinvhstry->piih_histcreatedon=date('Y-m-d H:i:s');
                    $projtinvhstry->piih_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projtinvhstry->piih_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projtinvhstry->piih_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projtinvhstry->piih_submittedon=$projtinvtemp->piit_submittedon;
                    $projtinvhstry->piih_submittedby=$projtinvtemp->piit_submittedby;
                    $projtinvhstry->piih_submittedbyipaddr=$projtinvtemp->piit_submittedbyipaddr;
                    $projtinvhstry->save();
                }
                
                $projinvmaptemp= ProjinvmappingtmpTbl::find()->where("pimt_projecttmp_fk =:pk",[':pk'=> $projectPk])->all();
                if(!empty($projinvmaptemp))
                {
                    foreach ($projinvmaptemp as $key => $maptemp) {
                        
                    $projinvmaphstry=new ProjinvmappinghstyTbl();
                    $projinvmaphstry->pimh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projinvmaphstry->pimh_memberregmst_fk=$maptemp->pimt_memberregmst_fk;
                    $projinvmaphstry->pimh_name=$maptemp->pimt_name;
                    $projinvmaphstry->pimh_emailid=$maptemp->pimt_emailid;
                    $projinvmaphstry->pimh_status=$maptemp->pimt_status;
                    $projinvmaphstry->pimh_order=$maptemp->pimt_order;
                    $projinvmaphstry->pimh_histcreatedon=date('Y-m-d H:i:s');
                    $projinvmaphstry->pimh_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projinvmaphstry->pimh_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projinvmaphstry->pimh_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projinvmaphstry->pimh_submittedon=$maptemp->pimt_submittedon;
                    $projinvmaphstry->pimh_submittedby=$maptemp->pimt_submittedby;
                    $projinvmaphstry->pimh_submittedbyipaddr=$maptemp->pimt_submittedbyipaddr;
                    $projinvmaphstry->save();
                    }
                }
                
                $projtechtemp= ProjtechnicaltmpTbl::find()->where("ptt_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projtechtemp))
                {
                    $projtechhstry=new ProjtechnicalhstyTbl();
                    $projtechhstry->pth_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projtechhstry->pth_techinfo=$projtechtemp->ptt_techinfo;
                    $projtechhstry->pth_techapprovals=$projtechtemp->ptt_techapprovals;
                    $projtechhstry->pth_employoppor=$projtechtemp->ptt_employoppor;
                    $projtechhstry->pth_infrastructure=$projtechtemp->ptt_infrastructure;
                    $projtechhstry->pth_tourism=$projtechtemp->ptt_tourism;
                    $projtechhstry->pth_employment=$projtechtemp->ptt_employment;
                    $projtechhstry->pth_supplychain=$projtechtemp->ptt_supplychain;
                    $projtechhstry->pth_environmental=$projtechtemp->ptt_environmental;
                    $projtechhstry->pth_marketoverview=$projtechtemp->ptt_marketoverview;
                    $projtechhstry->pth_marketneeds=$projtechtemp->ptt_marketneeds;
                    $projtechhstry->pth_markettrends=$projtechtemp->ptt_marketneeds;
                    $projtechhstry->pth_similrefer=$projtechtemp->ptt_similrefer;
                    $projtechhstry->pth_histcreatedon=date('Y-m-d H:i:s');
                    $projtechhstry->pth_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projtechhstry->pth_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projtechhstry->pth_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projtechhstry->pth_submittedon=$projtechtemp->ptt_submittedon;
                    $projtechhstry->pth_submittedby=$projtechtemp->ptt_submittedby;
                    $projtechhstry->pth_submittedbyipaddr=$projtechtemp->ptt_submittedbyipaddr;
                    $projtechhstry->save();
                     
                }
                
                $projecttechdoctemp= ProjtechdocumentstmpTbl::find()->where("ptdt_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
                if(!empty($projecttechdoctemp))
                {
                    $projecttechdochstry=new ProjtechdocumentshstyTbl();
                    $projecttechdochstry->ptdh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projecttechdochstry->ptdh_typeofdoc=$projecttechdoctemp->ptdt_typeofdoc;
                    $projecttechdochstry->ptdh_techdoc=$projecttechdoctemp->ptdt_techdoc;
                    $projecttechdochstry->ptdh_histcreatedon=date('Y-m-d H:i:s');
                    $projecttechdochstry->ptdh_appdeclon=$projtempmodel->prjt_apprdeclon;
                    $projecttechdochstry->ptdh_appdeclby=$projtempmodel->prjt_apprdeclby;
                    $projecttechdochstry->ptdh_appdeclbyipaddr=$projtempmodel->prjt_apprdeclbyipaddr;
                    $projecttechdochstry->ptdh_submittedon=$projecttechdoctemp->ptdt_submittedon;
                    $projecttechdochstry->ptdh_submittedby=$projecttechdoctemp->ptdt_submittedby;
                    $projecttechdochstry->ptdh_submittedbyipaddr=$projecttechdoctemp->ptdt_submittedbyipaddr;
                    $projecttechdochstry->save();
                }
            }
            else{
                echo "<pre>";print_r($projecthstry->getErrors());exit;
            }
            
            
        }
    }
    
    public function movemainhistry($projectPk)
    {
        $projdtlsmodel = ProjectdtlsTbl::find()->where("prjd_projecttmp_fk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($projdtlsmodel))
        {
            $projecthstry=new ProjecthstyTbl();
            $projecthstry->prjh_projectdtls_fk=$projdtlsmodel->projectdtls_pk;
            $projecthstry->prjh_memberregmst_fk=$projdtlsmodel->prjd_memberregmst_fk;
            $projecthstry->prjh_projectid=$projdtlsmodel->prjd_projectid;
            $projecthstry->prjh_referenceno=$projdtlsmodel->prjd_referenceno;
            $projecthstry->prjh_projname=$projdtlsmodel->prjd_projname;
            $projecthstry->prjh_shortsummary=$projdtlsmodel->prjd_shortsummary;
            $projecthstry->prjh_projdesc=$projdtlsmodel->prjd_projdesc;
            $projecthstry->prjh_sectormst_fk=$projdtlsmodel->prjd_sectormst_fk;
            $projecthstry->prjh_industrymst_fk=$projdtlsmodel->prjd_industrymst_fk;
            $projecthstry->prjh_benefeat=$projdtlsmodel->prjd_benefeat;
            $projecthstry->prjh_investorbenefits=$projdtlsmodel->prjd_investorbenefits;
            $projecthstry->prjh_msgtoinvestors=$projdtlsmodel->prjd_msgtoinvestors;
            $projecthstry->prjh_projtype=$projdtlsmodel->prjd_projtype;
            $projecthstry->prjh_projcost=$projdtlsmodel->prjd_projcost;
            $projecthstry->prjh_dateofinception=$projdtlsmodel->prjd_dateofinception;
            $projecthstry->prjh_plannedprojstrtdt=$projdtlsmodel->prjd_plannedprojstrtdt;
            $projecthstry->prjh_plannedprojenddt=$projdtlsmodel->prjd_plannedprojenddt;
            $projecthstry->prjh_projstage=$projdtlsmodel->prjd_projstage;
            $projecthstry->prjh_projstatus=$projdtlsmodel->prjd_projstatus;
            $projecthstry->prjh_projzone=$projdtlsmodel->prjd_projzone;
            $projecthstry->prjh_natureofprop=$projdtlsmodel->prjd_natureofprop;
            $projecthstry->prjh_proptype=$projdtlsmodel->prjd_proptype;
            $projecthstry->prjh_addressline=$projdtlsmodel->prjd_addressline;
            $projecthstry->prjh_latitude=$projdtlsmodel->prjd_latitude;
            $projecthstry->prjh_longitude=$projdtlsmodel->prjd_longitude;
            $projecthstry->prjh_statemst_fk=$projdtlsmodel->prjd_statemst_fk;
            $projecthstry->prjh_citymst_fk=$projdtlsmodel->prjd_citymst_fk;
            $projecthstry->prjh_memcompmplocationdtls_fk=$projdtlsmodel->prjd_memcompmplocationdtls_fk;
            $projecthstry->prjh_projteam=$projdtlsmodel->prjd_projteam;
            $projecthstry->prjh_contactinfo=$projdtlsmodel->prjd_contactinfo;
            $projecthstry->prjh_projinvproced=$projdtlsmodel->prjd_projinvproced;
            $projecthstry->prjh_licensauthoritiesmst_fk=$projdtlsmodel->prjd_licensauthoritiesmst_fk;
            $projecthstry->prjh_website=$projdtlsmodel->prjd_website;
            $projecthstry->prjh_socialmedia=$projdtlsmodel->prjd_socialmedia;
            $projecthstry->prjh_finindicators=$projdtlsmodel->prjd_finindicators;
            $projecthstry->prjh_roi=$projdtlsmodel->prjd_roi;
            $projecthstry->prjh_riskfactors=$projdtlsmodel->prjd_riskfactors;
            $projecthstry->prjh_riskdisclosures=$projdtlsmodel->prjd_riskdisclosures;
            $projecthstry->prjh_projdiligenceform_fk=$projdtlsmodel->prjd_projdiligenceform_fk;
            $projecthstry->prjh_financialdocs=$projdtlsmodel->prjd_financialdocs;
            $projecthstry->prjh_submittedon=$projdtlsmodel->prjd_submittedon;
            $projecthstry->prjh_submittedby=$projdtlsmodel->prjd_submittedby;
            $projecthstry->prjh_submittedbyipaddr=$projdtlsmodel->prjd_submittedbyipaddr;
            $projecthstry->prjh_apprdeclon=$projdtlsmodel->prjd_apprdeclon;
            $projecthstry->prjh_apprdeclby=$projdtlsmodel->prjd_apprdeclby;
            $projecthstry->prjh_apprdeclbyipaddr=$projdtlsmodel->prjd_apprdeclbyipaddr;
            $projecthstry->prjh_appldeccomments=$projdtlsmodel->prjd_appldeccomments;
            if($projecthstry->save())
            {
                $projaccahivemain= ProjaccachievedtlsTbl::find()->where("paad_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->all();
                if(!empty($projaccahivemain))
                {
                    foreach ($projaccahivemain as $key => $value) {
                        
                    $projaccahivehstry=new ProjaccachievehstyTbl();
                    $projaccahivehstry->paah_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projaccahivehstry->paah_memcompacomplishdtls_fk=$value->paad_memcompacomplishdtls_fk;
                    $projaccahivehstry->paah_type=$value->paad_type;
                    $projaccahivehstry->paah_memcompfiledtls_fk=$value->paad_memcompfiledtls_fk;
                    $projaccahivehstry->paah_index=$value->paad_index;
                    $projaccahivehstry->paah_histcreatedon=date('Y-m-d H:i:s');
                    $projaccahivehstry->paah_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projaccahivehstry->paah_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projaccahivehstry->paah_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projaccahivehstry->paah_submittedon=$value->paad_submittedon;
                    $projaccahivehstry->paah_submittedby=$value->paad_submittedby;
                    $projaccahivehstry->paah_submittedbyipaddr=$value->paad_submittedbyipaddr;
                    $projaccahivehstry->save();
                    }
                }
                
                $projpartdtls= ProjectpartnerdtlsTbl::find()->where("prjpd_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->all();
                if(!empty($projpartdtls))
                {
                    foreach ($projpartdtls as $key => $partdls) {
                        
                    $projparthstry =new ProjectpartnerhstyTbl();
                    $projparthstry->prjph_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projparthstry->prjph_partnermst_fk=$partdls->prjpd_partnermst_fk;
                    $projparthstry->prjph_partnerorginfo=$partdls->prjpd_partnerorginfo;
                    $projparthstry->prjph_index=$partdls->prjpd_index;
                    $projparthstry->prjph_histcreatedon=date('Y-m-d H:i:s');
                    $projparthstry->prjph_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projparthstry->prjph_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projparthstry->prjph_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projparthstry->prjph_submittedon=$partdls->prjpd_submittedon;
                    $projparthstry->prjph_submittedby=$partdls->prjpd_submittedby;
                    $projparthstry->prjph_submittedbyipaddr=$partdls->prjpd_submittedbyipaddr;
                    $projparthstry->save();
                    }
                }
                $projfaqmain= ProjfaqdtlsTbl::find()->where("pfd_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->all();
                
                if(!empty($projfaqmain))
                {
                    foreach ($projfaqmain as $key => $faqmain) {
                    $projfaqhstry=new ProjfaqhstyTbl();
                    $projfaqhstry->pfh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projfaqhstry->pfh_question=$faqmain->pfd_question;
                    $projfaqhstry->pfh_answer=$faqmain->pfd_answer;
                    $projfaqhstry->pfh_type=$faqmain->pfd_type;
                    $projfaqhstry->pfh_index=$faqmain->pfd_index;
                    $projfaqhstry->pfh_status=$faqmain->pfd_status;
                    $projfaqhstry->pfh_histcreatedon=date('Y-m-d H:i:s');
                    $projfaqhstry->pfh_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projfaqhstry->pfh_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projfaqhstry->pfh_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projfaqhstry->pfh_submittedon=$faqmain->pfd_submittedon;
                    $projfaqhstry->pfh_submittedby=$faqmain->pfd_submittedby;
                    $projfaqhstry->pfh_submittedbyipaddr=$faqmain->pfd_submittedbyipaddr;
                    $projfaqhstry->save();
                    }
             
                }
                
                $projtinvdtls= ProjinvinfodtlsTbl::find()->where("piid_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->one();
                if(!empty($projtinvdtls))
                {
                    $projtinvhstry=new ProjinvinfohstyTbl();
                    $projtinvhstry->piih_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projtinvhstry->piih_invprefsrc=$projtinvdtls->piid_invprefsrc;
                    $projtinvhstry->piih_otherprefsrc=$projtinvdtls->piid_otherprefsrc;
                    $projtinvhstry->piih_totinvreqd=$projtinvdtls->piid_totinvreqd;
                    $projtinvhstry->piih_invreqdcurrencymst_fk=$projtinvdtls->piid_invreqdcurrencymst_fk;
                    $projtinvhstry->piih_totinvrecd=$projtinvdtls->piid_totinvrecd;
                    $projtinvhstry->piih_targetinvestors=$projtinvdtls->piid_targetinvestors;
                    $projtinvhstry->piih_investtype=$projtinvdtls->piid_investtype;
                    $projtinvhstry->piih_investmentstatus=$projtinvdtls->piid_investmentstatus;
                    $projtinvhstry->piih_histcreatedon=date('Y-m-d H:i:s');
                    $projtinvhstry->piih_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projtinvhstry->piih_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projtinvhstry->piih_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projtinvhstry->piih_submittedon=$projtinvdtls->piid_submittedon;
                    $projtinvhstry->piih_submittedby=$projtinvdtls->piid_submittedby;
                    $projtinvhstry->piih_submittedbyipaddr=$projtinvdtls->piid_submittedbyipaddr;
                    $projtinvhstry->save();
                }
                
                $projinvmapdtls= ProjinvmappingTbl::find()->where("pim_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->one();
                if(!empty($projinvmapdtls))
                {
                    foreach ($projinvmapdtls as $key => $mapdtls) {
                        
                    $projinvmaphstry=new ProjinvmappinghstyTbl();
                    $projinvmaphstry->pimh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projinvmaphstry->pimh_memberregmst_fk=$mapdtls->pimd_memberregmst_fk;
                    $projinvmaphstry->pimh_name=$mapdtls->pimd_name;
                    $projinvmaphstry->pimh_emailid=$mapdtls->pimd_emailid;
                    $projinvmaphstry->pimh_status=$mapdtls->pimd_status;
                    $projinvmaphstry->pimh_order=$mapdtls->pimd_order;
                    $projinvmaphstry->pimh_histcreatedon=date('Y-m-d H:i:s');
                    $projinvmaphstry->pimh_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projinvmaphstry->pimh_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projinvmaphstry->pimh_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projinvmaphstry->pimh_submittedon=$mapdtls->pimd_submittedon;
                    $projinvmaphstry->pimh_submittedby=$mapdtls->pimd_submittedby;
                    $projinvmaphstry->pimh_submittedbyipaddr=$mapdtls->pimd_submittedbyipaddr;
                    $projinvmaphstry->save();
                    }
                }
                
                $projtechdtls= ProjtechnicalTbl::find()->where("pt_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->one();
                if(!empty($projtechdtls))
                {
                    $projtechhstry=new ProjtechnicalhstyTbl();
                    $projtechhstry->pth_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projtechhstry->pth_techinfo=$projtechdtls->pt_techinfo;
                    $projtechhstry->pth_techapprovals=$projtechdtls->pt_techapprovals;
                    $projtechhstry->pth_employoppor=$projtechdtls->pt_employoppor;
                    $projtechhstry->pth_infrastructure=$projtechdtls->pt_infrastructure;
                    $projtechhstry->pth_tourism=$projtechdtls->pt_tourism;
                    $projtechhstry->pth_employment=$projtechdtls->pt_employment;
                    $projtechhstry->pth_supplychain=$projtechdtls->pt_supplychain;
                    $projtechhstry->pth_environmental=$projtechdtls->pt_environmental;
                    $projtechhstry->pth_marketoverview=$projtechdtls->pt_marketoverview;
                    $projtechhstry->pth_marketneeds=$projtechdtls->pt_marketneeds;
                    $projtechhstry->pth_markettrends=$projtechdtls->pt_marketneeds;
                    $projtechhstry->pth_similrefer=$projtechdtls->pt_similrefer;
                    $projtechhstry->pth_histcreatedon=date('Y-m-d H:i:s');
                    $projtechhstry->pth_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projtechhstry->pth_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projtechhstry->pth_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projtechhstry->pth_submittedon=$projtechdtls->pt_submittedon;
                    $projtechhstry->pth_submittedby=$projtechdtls->pt_submittedby;
                    $projtechhstry->pth_submittedbyipaddr=$projtechdtls->pt_submittedbyipaddr;
                    $projtechhstry->save();
                     
                }
                
                $projecttechdocdtls= ProjtechdocumentsTbl::find()->where("ptd_projectdtls_fk =:pk",[':pk'=> $projdtlsmodel->projectdtls_pk])->one();
                if(!empty($projecttechdocdtls))
                {
                    $projecttechdochstry=new ProjtechdocumentshstyTbl();
                    $projecttechdochstry->ptdh_projecthsty_fk=$projecthstry->projecthsty_pk;
                    $projecttechdochstry->ptdh_typeofdoc=$projecttechdocdtls->ptd_typeofdoc;
                    $projecttechdochstry->ptdh_techdoc=$projecttechdocdtls->ptd_techdoc;
                    $projecttechdochstry->ptdh_histcreatedon=date('Y-m-d H:i:s');
                    $projecttechdochstry->ptdh_appdeclon=$projecthstry->prjh_apprdeclon;
                    $projecttechdochstry->ptdh_appdeclby=$projecthstry->prjh_apprdeclby;
                    $projecttechdochstry->ptdh_appdeclbyipaddr=$projecthstry->prjh_apprdeclbyipaddr;
                    $projecttechdochstry->ptdh_submittedon=$projecttechdocdtls->ptd_submittedon;
                    $projecttechdochstry->ptdh_submittedby=$projecttechdocdtls->ptd_submittedby;
                    $projecttechdochstry->ptdh_submittedbyipaddr=$projecttechdocdtls->ptd_submittedbyipaddr;
                    $projecttechdochstry->save();
                }
            }
            
            
        }
    }

    public function addprojectFinancial($data){
        $proFinancialArray = $data['projfinancial'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            if(!empty($proFinancialArray['prjt_projcost']))
            {
            $model->prjt_projcost = $proFinancialArray['prjt_projcost'];
            }
            if(!empty($proFinancialArray['prjt_debt']))
            {
            $model->prjt_debt = $proFinancialArray['prjt_debt'];
            }
            if(!empty($proFinancialArray['prjt_amtspentsofar']))
            {
            $model->prjt_amtspentsofar = $proFinancialArray['prjt_amtspentsofar'];
            }
            if(!empty($proFinancialArray['prjt_equity']))
            {
            $model->prjt_equity = $proFinancialArray['prjt_equity'];
            }
            if(!empty($proFinancialArray['prjt_balanceamt']))
            {
            $model->prjt_balanceamt = $proFinancialArray['prjt_balanceamt'];
            }
            if(!empty($proFinancialArray['prjt_debtequratio']))
            {
            $model->prjt_debtequratio = $proFinancialArray['prjt_debtequratio'];
            }
            if(!empty($proFinancialArray['prjt_grant']))
            {
            $model->prjt_grant = $proFinancialArray['prjt_grant'];
            }



    
            if($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            } else {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Financial Add / Updated successfully!',
                    'returndata' => $model
                );                
            }
            return json_encode($result);
        }
    }

    public function getprojtempbyid($pk){
        // return "hi";
        $model = ProjecttmpTbl::find();
        $model->select([
            'projecttmp_pk',
            'prjt_projectid',
            'prjt_referenceno',
            'prjt_projname',
            'prjt_projstatus',
            'prjt_submittedon',
            'prjt_submittedby',
            'prjt_updatedon',
            'prjt_updatedby',
            'prjt_apprdeclon',
            'prjt_apprdeclby',
            'prjt_projstage',
            'val.um_firstname as valfname',
            'val.um_lastname as vallname',
             'sub.um_firstname as subfname',
            'sub.um_lastname as sublname',
            'upd.um_firstname as updfname',
            'upd.um_lastname as updlname',
            'prsm_projstage',
            'prjt_appldeccomments',
            'prjt_approvalno',
            'prjt_createdon',
            'prjt_createdby',

        ]);
        $model->leftJoin('usermst_tbl sub','sub.UserMst_Pk=prjt_createdby');
        $model->leftJoin('usermst_tbl val','val.UserMst_Pk=prjt_apprdeclby');
        $model->leftJoin('usermst_tbl upd','upd.UserMst_Pk=prjt_submittedby');
        $model->leftJoin('projstagemst_tbl','projstagemst_tbl.projstagemst_pk=prjt_projstage');
        $model->andWhere(['projecttmp_pk'=>$pk]);
        $model->asArray()->one();
        // return $model;

        $provider = new ActiveDataProvider([
            'query' => $model, 
		]);
        return [
            'items' => $provider->getModels(),
            // 'total_count' => $provider->getTotalCount(),
        ];


    }

    
    public function getprofiledata($data) {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $regpk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        
        if($data['licpk']['val']==1){
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
                ->select(['group_concat(distinct lam_licenseauthname_en) as lam_licenseauthname_en','licensinginfo_pk','SecM_SectorName','IndM_IndustryName','IndustryMst_Pk','SectorMst_Pk','li_referenceno','li_status'])
                ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
                ->leftJoin('industrymst_tbl','li_industrymst_fk=IndustryMst_Pk')
                ->leftJoin('licauthdtls_tbl','lad_licensinginfo_fk=licensinginfo_pk')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=lad_licensauthoritiesmst_fk')
                ->where('li_referenceno=:ref',[':ref'=> $data['licpk']])
                ->asArray()->all();
        if(!empty($model[0]['licensinginfo_pk'])){
        return [
            'data' => $model,
            'flag' => 'S',
        ];
        }
        else{
        return [
            'data' => $model,
            'flag' => 'F',
        ];
        
        }
        }
        
        if($data['licpk']['val']==2){
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
            ->select(['licensinginfo_pk as licenseid','li_lictitleen as licensename'])
            ->where(['=','li_status',1])
            ->andWhere('li_sectormst_fk=:pk',[':pk'=> $data['licpk']['sector']])
            ->orderBy('li_lictitleen ASC')
            ->asArray()->all();
        return $model;
        }
        
        if($data['licpk']['val']==3){
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
            ->select(['licensinginfo_pk as licenseid','li_lictitleen as licensename','li_sectormst_fk as sectorpk'])
            ->where(['=','li_status',1])
            ->andWhere('li_industrymst_fk=:pk',[':pk'=> $data['licpk']['industry']])
            ->orderBy('li_lictitleen ASC')
            ->asArray()->all();
        return $model;
        }
        
        if($data['licpk']['val']==4){
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
                ->select(['group_concat(distinct lam_licenseauthname_en) as lam_licenseauthname_en','SecM_SectorName','IndM_IndustryName','IndustryMst_Pk','SectorMst_Pk','li_referenceno','li_status'])
                ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
                ->leftJoin('industrymst_tbl','li_industrymst_fk=IndustryMst_Pk')
                ->leftJoin('licauthdtls_tbl','lad_licensinginfo_fk=licensinginfo_pk')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=lad_licensauthoritiesmst_fk')
                ->where('licensinginfo_pk=:pk',[':pk'=> $data['licpk']['licencevalue']])
                ->asArray()->all();
        return $model;
        }
        
    }
    
    
    public function addreqdlic($data) {
       $projectpk= \common\components\Security::decrypt($data['projpk']['projectpk']);
        $model = ProjreqdlictmpTbl::find()
            ->where("prlt_licensinginfo_fk =:pk",[':pk'=> $data['licpk']])
            ->andWhere('prlt_projecttmp_fk=:id',array(':id' => $projectpk))
            ->one();
        if(empty($model)){
        $model = new ProjreqdlictmpTbl(); 
        $model->prlt_submittedon=date('Y-m-d H:i:s');
        $model->prlt_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->prlt_submittedbyipaddr=\common\components\Common::getIpAddress();
        $data1='create';
        }else{
            $licensemodel->prlt_updatedon = date('Y-m-d H:i:s');
            $licensemodel->prlt_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $licensemodel->prlt_updatedbyipaddr = \common\components\Common::getIpAddress();
            $data1='update';
        }
        $model->prlt_licensinginfo_fk=Security::sanitizeInput($data['licpk'], "number");
        $model->prlt_projecttmp_fk=$projectpk;
        $model->prlt_order=Security::sanitizeInput($data['projpk']['order'], "number");
        if($model->save())
        {
            $data['model']=$model;
            $data['type']=$data1;
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$data,
        );
        }else{
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>$model->getErrors(),
            );
        }
//        }else{
//        $result=array(
//            'status' => 200,
//            'statusmsg' => 'duplicate',
//            'flag'=>'D',
//            'data'=>$model,
//        );
//        }
        return json_encode($result);
        
       
    }
    
    public static function projecttmpTblCacheQuery(){
        return ProjecttmpTbl::find()
        ->select(['max(prjt_updatedon), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
    
}
