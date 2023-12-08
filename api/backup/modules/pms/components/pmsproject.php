<?php

namespace api\modules\pms\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;
use common\components\Security;
use common\components\Common;
use api\modules\pd\models\ProjecttmpTbl;
use api\modules\pd\models\s;


class Pmsproject {

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
        $query->orderBy('prjt_submittedon DESC');
        }else {
        $query->orderBy('prjt_submittedon ASC');    
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
    
  
   public function investorindex($data)
    {
        $query = ProjectdtlsTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        if($data['type']=='filter')
        {
            if($data['invstatus']){

                $str_status = '';
                $state = 0;
                $data['invstatus'] = explode(",",$data['invstatus']);
                // return $data['invstatus'];


                // if (in_array(1, array($data['invstatus']))){
                //     $query->orWhere("prdsd_status!=2");
                //     $query->orWhere("pind_status!=3");
                // }
                // if (in_array(2, array($data['invstatus']))){
                //     $query->orWhere("prdsd_status!=2");
                //     $query->orWhere("pind_status!=3");
                // }
                // if (in_array(3, array($data['invstatus']))){
                //     $query->orWhere("prdsd_status!=2");
                //     $query->orWhere("pind_status!=3");
                // }
                if (in_array(1, $data['invstatus'])) {
                    $key = array_search(1,$data['invstatus']);
                    // unset(array($data['invstatus'][$key]));
                    $state = 1;
                    $str_status .= '(prdsd_status!=2 and pind_status is null)';
                }
                if (in_array(2,$data['invstatus'])) {

                    if ($state == 0) {
                        $state = 1;
                    } else {
                        $state = 1;
                        $str_status .= " OR ";
                    }
                    $str_status .= '(presd_status=2 and prdsd_status=2 and pind_status!=4)';
    
                    $key = array_search(2,$data['invstatus']);
                    // unset(array($data['invstatus'][$key]));
                }

                if (in_array(3, $data['invstatus'])) {
                    if ($state == 1) {
                        $str_status .= " OR ";
                    }
                    $str_status .= "(presd_status=2 and prdsd_status=2 and pind_status=4)";
                }
                $query->andWhere($str_status);
    


            }
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            unset($data['onsortpk']);
            unset($data['invstatus']);

            $querypin='';
            $querystat=false;
            if($data['pind_status']!=''){
                $exploadarr= explode(',', $data['pind_status']);
                if(in_array('5', $exploadarr))
                {
                    $querypin.=" pind_status is null or";
                    $key= array_search('5', $exploadarr);
                    unset($exploadarr[$key]);
                }
               
                if($exploadarr)
                {
                    $pinstate2= implode(',', $exploadarr);
                     $querypin .= " pind_status in ($pinstate2) or";
                
                }
                $querypin= substr($querypin, 0,-2);
                if($querypin!='')
                {
                $query->andOnCondition($querypin);
                }
                unset($data['pind_status']);
            }
            $statusval='';
            if($data['prjsl_status']!='' || $data['presd_status']!='' || $data['prdsd_status']!='') 
            {
                
                if(!empty($data['prjsl_status']))
                $statusval.=" prjsl_status in ({$data['prjsl_status']}) or";
                if(!empty($data['presd_status']))
                {
                    $data['presd_status']= str_replace('1', '1,4', $data['presd_status']);
                    $statusval.=" presd_status in ({$data['presd_status']}) or";
                }
                if(!empty($data['prdsd_status']))
                $statusval.=" prdsd_status in ({$data['prdsd_status']}) or";
                $statusval= substr($statusval, 0,-2);
                
                
                if($statusval!='')
                {
                    $query->andOnCondition($statusval);
                    unset($data['prjsl_status']);
                    unset($data['presd_status']);
                    unset($data['prdsd_status']);
                }
            }


            foreach(array_filter($data) as $key =>$val)
            {
                // print_r($key);exit;
                if($val !=null)
                {
                    if($key!="prjd_projname" && $key!="prjd_projectid")
                    {
                      
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjd_projname', true), ':value',array(':value' =>  $val)],['LIKE',Common::getTableWithPrefix('prjd_referenceno', true), ':value',array(':value' =>  $val)],['LIKE',Common::getTableWithPrefix('prjd_projectid', true), ':value',array(':value' =>  $val)]]); 
                    }
                }
            }
        }
        $query->select(["TIMESTAMPDIFF(YEAR, prjd_plannedprojstrtdt, prjd_plannedprojenddt) as Diff",'prjd_submittedon','COALESCE(prjd_projcategory,"NIL") as prjd_projcategory','COALESCE(prjd_presentstatus,"NIL") as prjd_presentstatus','prjd_presentstatusothers as presentstatusothers','SecM_SectorName','mcm.MCM_CompanyName as ProjectOwnerName','projmodeofimplentmst_pk','projshortlist_pk','presd_status','prdsd_status','pind.pind_status as pind_status','projownershipmst_pk','posm_ownership','pind.pind_appdeclon as appdeclon',"concat(um4.um_firstname,' ',um4.um_lastname) as appdeclbyname",'projmodeofimplentmst_tbl.pmim_modesubtype as pmim_modesubtype','prjd_otherimplementation as otherimplementation',"concat(um5.um_firstname,' ',um5.um_lastname) as resubname",'pind.pind_updatedon resubon','pind.pind_invamount as invamt','prjsl_memberregmst_fk as companypk','pind.pind_declaredon as declaredon','pind.pind_createdon as createdon','pind.projinvestmentdtls_pk as lpk','pind.pind_appdeclcomments as appdeclcom','prjd_projmodeofimplentmst_fk','st.SM_StateName_en as SM_StateName_en','ct.CM_CityName_en as CM_CityName_en',"TIMESTAMPDIFF(MONTH, prjd_plannedprojstrtdt, prjd_plannedprojenddt)%12 as Diffmonth,prjd_projname, prjd_projectid,prjd_referenceno,prjd_projtype ,prjd_projstage,prjd_plannedprojstrtdt,prjd_plannedprojenddt,substring_index(group_concat(distinct prjsl_status order by projshortlist_pk),',',1) as 'prjsl_status',prjd_addressline,prjd_projcost,prjsl_shortlistedcancon,projeoisubdtls_pk,projectdtls_pk,presd_eoisubmittedon ,prdsd_submittedon"]);
// SM_StateName_en,CM_CityName_en, removed form db
 $query->leftJoin('projshortlist_tbl psl',"psl.prjsl_projectdtls_fk=projectdtls_tbl.projectdtls_pk  and prjsl_memberregmst_fk=$companypk");       
 $query->leftJoin('usermst_tbl um','um.UserMst_Pk=psl.prjsl_shortlistedcancby');       
 $query->leftJoin('projeoisubdtls_tbl pes','pes.presd_projshortlist_fk=psl.projshortlist_pk'); 
 $query->leftJoin('usermst_tbl um1','um1.UserMst_Pk=pes.presd_eoisubmittedby'); 
 $query->leftJoin('projdilsubdtls_tbl pds','pds.prdsd_projeoisubdtls_fk=pes.projeoisubdtls_pk'); 
 $query->leftJoin('usermst_tbl um2','um2.UserMst_Pk=pds.prdsd_submittedby'); 
 $query->leftJoin('projinvestmentdtls_tbl pind','pind.pind_projectdtls_fk=projectdtls_tbl.projectdtls_pk'); 
 $query->leftJoin('usermst_tbl um3','um3.UserMst_Pk=pind.pind_createdby'); 
 $query->leftJoin('usermst_tbl um4','um4.UserMst_Pk=pind.pind_appdeclby'); 
 $query->leftJoin('usermst_tbl um5','um5.UserMst_Pk=pind.pind_updatedby'); 
 $query->leftJoin('membercompanymst_tbl mcm','mcm.MCM_MemberRegMst_Fk=projectdtls_tbl.prjd_memberregmst_fk'); 
 $query->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk=projectdtls_tbl.prjd_sectormst_fk');
 $query->leftJoin('projownershipmst_tbl','projownershipmst_tbl.projownershipmst_pk=projectdtls_tbl.prjd_projownershipmst_fk'); 
 $query->leftJoin('projmodeofimplentmst_tbl','projmodeofimplentmst_tbl.projmodeofimplentmst_pk=projectdtls_tbl.prjd_projmodeofimplentmst_fk');
//  $query->leftJoin('projschememst_tbl','projschememst_tbl.projschememst_pk=projectdtls_tbl.prjd_projscentralschememst_fk'); 
//  $query->leftJoin('memcompmplocationdtls_tbl mcld','mcld.memcompmplocationdtls_pk=projectdtls_tbl.prjd_memcompmplocationdtls_fk'); 
$query->leftJoin('statemst_tbl st','st.StateMst_Pk=projectdtls_tbl.prjd_statemst_fk'); 
$query->leftJoin('citymst_tbl ct','ct.CityMst_Pk=projectdtls_tbl.prjd_citymst_fk'); 
$query->andWhere('prjd_projstatus=:status',array(':status' =>  3));
$query->andWhere('prjd_projstage<>:stage',array(':stage' =>  6));
$query->groupBy(['projectdtls_pk']);
        if($sortpk==1){
        $query->orderBy('prjd_submittedon DESC');
        }else {
        $query->orderBy('prjd_submittedon ASC');    
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);

        $model = ProjectdtlsTbl::find()
        ->select(['projectdtls_pk'])
        ->where('prjd_projstatus=:status',array(':status' =>  3))
        ->andWhere('prjd_projstage<>:stage',array(':stage' =>  6))
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total_entry' => count($model)
        ];
    }
    
    public function projectlisingnoc($data)
    {
        $query = ProjecttmpTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            unset($data['onsortpk']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null && $val !='')
                {
                    if($key!="prjt_projname" && $key!="prjt_projectid")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE','prjt_projname',$val],['LIKE','prjt_projectid',$val],['LIKE','prjt_referenceno',$val]]); 
                    }
                }
            }
        }
        $query->select(['*',"TIMESTAMPDIFF(YEAR, prjt_plannedprojstrtdt, prjt_plannedprojenddt) as Diff,"
            . "TIMESTAMPDIFF(MONTH, prjt_plannedprojstrtdt, prjt_plannedprojenddt)%12 as Diffmonth"]);
        $query->leftJoin('sectormst_tbl','projecttmp_tbl.prjt_sectormst_fk=sectormst_tbl.sectorMst_Pk'); 
        $query->leftJoin('membercompanymst_tbl','projecttmp_tbl.prjt_memberregmst_fk = membercompanymst_tbl.MCM_MemberRegMst_Fk'); 
        $query->leftJoin('projinvinfotmp_tbl','projecttmp_tbl.projecttmp_pk=projinvinfotmp_tbl.piit_projecttmp_fk');      
        $query->leftJoin('statemst_tbl','projecttmp_tbl.prjt_statemst_fk = statemst_tbl.StateMst_Pk');
        $query->leftJoin('citymst_tbl','projecttmp_tbl.prjt_citymst_fk=citymst_tbl.CityMst_Pk');
        $query->leftJoin('usermst_tbl crby','projecttmp_tbl.prjt_submittedby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl decby','projecttmp_tbl.prjt_apprdeclby=decby.UserMst_Pk');
        $query->andWhere('prjt_projstage<>:stage',array(':stage' =>  6));       
        $query->andWhere('prjt_projstatus<>:status',array(':status' =>  1));
        if($sortpk==1){
        $query->orderBy('prjt_submittedon DESC');
        }else {
        $query->orderBy('prjt_submittedon ASC');    
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);

        $model = ProjecttmpTbl::find()
        ->select(['projecttmp_pk'])
        ->where('prjt_projstatus<>:status',array(':status' =>  1))
        ->andWhere('prjt_projstage<>:stage',array(':stage' =>  6))
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total_entry' => count($model)
        ];
    }
    
    public function projectlicenselist($datavalue=null){
        $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $size = Security::sanitizeInput($datavalue['size'], "number");
         $query = LicinvappliedTbl::find();
         if(!empty($datavalue))
         {
         $datavalue= json_decode($datavalue['formdata']);
         $page=(!empty($size))?$size:10;
            if(!empty($datavalue->searchvalue->licencevalue))
            $query->andWhere("licensinginfo_tbl.licensinginfo_pk=:licencepk",array(':licencepk'=>$datavalue->searchvalue->licencevalue)); 
            if(!empty($datavalue->searchvalue->projectvalue))
            $query->andWhere("licinvapplied_tbl.lia_projectdtls_fk=:projectpks",array(':projectpks'=>$datavalue->searchvalue->projectvalue));
            if(!empty($datavalue->searchvalue->licencestatus))
            $query->andWhere("licinvapplied_tbl.lia_status IN ({$datavalue->searchvalue->licencestatus})");
            if(!empty($datavalue->formvalue->search))
                $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('li_referenceno', true), ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','lia_applicationno', ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','li_lictitleen', ':value',array(':value' =>  $datavalue->formvalue->search)]]);
         }
         if(!empty($datavalue))
         {
         $query->select('projectdtls_pk as projectpk');
         }else{
            $query->select('count(distinct projectdtls_pk) as projectpk');  
         }
         $query->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk'); 
         $query->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk'); 
         $query->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk'); 
         $query->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk');
         $query->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk');
         $query->andWhere('licinvapplied_tbl.lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $query->asArray();
         $query->distinct(TRUE);
         $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
         return [
             'items' => $provider->getModels(),
             'total_count' => $provider->getTotalCount(),
             'limit' => $page,
         ];
         
     }
     
     public function getlicenselist($datavalue,$projectlistpks){
         
         $datavalue= json_decode($datavalue['formdata']);
         $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $querylist = LicinvappliedTbl::find();
         
         
             $projectpks=0;
             if(!empty($projectlistpks))
             {
                 $projectpks= implode(',', $projectlistpks);
             }
            if(!empty($datavalue->searchvalue->licencevalue))
            $querylist->andWhere("licensinginfo_tbl.licensinginfo_pk=:licencepk",array(':licencepk'=>$datavalue->searchvalue->licencevalue)); 
            if(!empty($datavalue->searchvalue->projectvalue))
            $querylist->andWhere("licinvapplied_tbl.lia_projectdtls_fk=:projectpks",array(':projectpks'=>$datavalue->searchvalue->projectvalue));
            if(!empty($datavalue->searchvalue->licencestatus))
            $querylist->andWhere("licinvapplied_tbl.lia_status IN ({$datavalue->searchvalue->licencestatus})");
            if(!empty($datavalue->formvalue->search))
             $querylist->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('li_referenceno', true), ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','lia_applicationno', ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','li_lictitleen', ':value',array(':value' =>  $datavalue->formvalue->search)]]);
 
         
         
         $querylist->select(['licinvapplied_tbl.*','prjd_projectid','prjd_referenceno','prjd_projname','projectdtls_pk','li_lictitleen','li_referenceno','SecM_SectorName']);
         $querylist->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk'); 
         $querylist->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk'); 
         $querylist->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk'); 
         $querylist->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk');
         $querylist->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk');
         $querylist->andWhere('licinvapplied_tbl.lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $querylist->andWhere("licinvapplied_tbl.lia_projectdtls_fk IN ($projectpks)") ;
         $querylist->orderBy('licinvapplied_tbl.lia_createdon desc');
         $querylist->asArray();
         
         return $querylist->all();
     }
     
     public function getlicdtls($data)
     {
 
       return new ActiveDataProvider([
         'query' => LicinvappliedTbl::find()
             ->select(['licinvapplied_tbl.*','licprocedurepinup_tbl.*','prjd_projectid','prjd_referenceno',
             'prjd_projname','projectdtls_pk','licensinginfo_tbl.*','SecM_SectorName',
             'crby.um_firstname as invfname','decby.um_firstname as licauthfname',
             'crby.um_lastname as invlname','decby.um_lastname as licauthlname',
             'reby.um_lastname as rebyinvlname','reby.um_firstname as rebyinvfname',
             ])
             ->where('licinvapplied_pk=:id',array(':id' =>  $data['licdtls']))
         ->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk')
         ->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk')
          ->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk')
          ->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk')
          ->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk')
           ->leftJoin('usermst_tbl decby','licinvapplied_tbl.lia_appdeclby=decby.UserMst_Pk')
         ->leftJoin('usermst_tbl crby','licinvapplied_tbl.lia_createdby=crby.UserMst_Pk')
         ->leftJoin('usermst_tbl reby','licinvapplied_tbl.lia_updatedby=reby.UserMst_Pk')
           ->asArray()
 
     ]);
     }
     public function activefunder(){
        return ProjfundmstTbl::find()
                ->select(['projfundmst_pk','pfm_fundedby'])
                ->where('pfm_status = :pfm_status',[':pfm_status' => 1])
                ->orderBy('projfundmst_pk ASC')
                ->asArray()
                ->all();
    }
    public function delete($id)
    {
      $model = ProjectdtlsTbl::find()->where('projectdtls_pk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->one();
      if ($model->delete() === false) {
          $result=array(
              'status' => 422,
              'statusmsg' => 'warning',
              'flag'=>'E',
              'msg'=>'Failed to delete the object!'
          );
      }else{
          $result=array(
              'status' => 200,
              'statusmsg' => 'success',
              'flag'=>'S',
              'msg'=>'Deleted successfully!',
              'returndata' => $model->projectdtls_pk
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
    
    public function projlist(){
        $companypk=\yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $result['proj']= ProjectdtlsTbl::find()
                ->select(['projectdtls_pk','prjd_projname'])
                ->where('prjd_projstatus = :Status',[':Status' => 3])
                ->andWhere("prjd_projstage not in (4,5,6)")
                ->orderBy('prjd_projname ASC')
                ->asArray()
                ->all();
        $result['inv']= \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['MCM_CompanyName','mcm_referenceno','mcm_stakeholderstatus'])
                ->where('MemberCompMst_Pk = :pk',[':pk' => $companypk])
                ->asArray()
                ->all();
return $result;
    }
    
    public function compprojlist(){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $result['proj']= ProjectdtlsTbl::find()
                ->select(['projectdtls_pk','prjd_projname'])
                ->where('prjd_projstage = :stage',[':stage' => 4])
                ->andWhere('prjd_memberregmst_fk=:regPK',array(':regPK' => $companypk))
                ->orderBy('prjd_projname ASC')
                ->asArray()
                ->all();
return $result;
    }
    
    public function liclist(){
        $companypk=\yii\db\ActiveRecord::getTokenData('comp_pk',true);
        return \api\modules\inv\models\LicprocedurepinupTbl::find()
                ->select(['licensinginfo_pk','li_lictitleen'])
                ->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licprocedurepinup_tbl.lppu_licensinginfo_fk')
                ->where('li_status = :Status',[':Status' => 1])
                ->andWhere('lppu_memcompmst_fk = :pk',[':pk' => $companypk])
                ->orderBy('li_lictitleen ASC')
                ->asArray()
                ->all();
    }
    
    public function activepartner()
    {
        return new ActiveDataProvider([
            'query' => PartnermstTbl::find()
                ->select(['partnermst_pk','prms_orgtype'])
                ->where(['prms_status' => 1])
                ->asArray()
                ->active()
        ]);
    }
    
    public function getlist()
    {
  
            $model = ProjsusdevelopgoalmstTbl::find()
                ->select(['projsusdevelopgoalmst_pk','psdgm_sustaindevelopgoal'])
                ->where(['psdgm_status' => 1])
                ->asArray()->all();
            return $model;
    }
    
    public function getsubsectorlist($sectorPk)
    {
      return new ActiveDataProvider([
        'query' => IndustrymstTbl::find()
            ->select(['IndustryMst_Pk','IndM_IndustryName'])
            ->where(['=','IndM_Status',1])
            ->orderBy('IndM_IndustryName ASC')
            ->andWhere('IndM_SectorMst_Fk=:pk',array(':pk'=>Security::sanitizeInput($sectorPk,"number")))

    ]);
    }
    
    // public function getlicenselist()
    // {
    //   return new \yii\data\ActiveDataProvider([
    //     'query' => \api\modules\mst\models\LicensinginfoTbl::find()
    //         ->select(['licensinginfo_pk','li_lictitleen'])
    //         ->where(['=','li_status',1])
    //         ->orderBy('li_lictitleen ASC'),
    //     'pagination' => false,
    // ]);
    // }
    
    public function getlicenseauthlist($licensePk)
    {
        $model = \api\modules\mst\models\LicensinginfoTbl::find()
                ->select('sectormst_tbl.SecM_SectorName , industrymst_tbl.IndM_IndustryName')
                ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
                ->leftJoin('industrymst_tbl','li_industrymst_fk=IndustryMst_Pk')
                ->where('licensinginfo_pk=:pk',array(':pk'=>Security::sanitizeInput($licensePk,"number")))->asArray()->all();
        
        $model1 = \api\modules\mst\models\LicauthdtlsTbl::find()
                ->select('group_concat(lam_licenseauthname_en) as licauthname')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=lad_licensauthoritiesmst_fk')
                ->where('licauthdtls_tbl.lad_licensinginfo_fk=:pk',array(':pk'=>Security::sanitizeInput($licensePk,"number")))->asArray()->all();
        $data[1]=$model;
        $data[2]=$model1;
        return $data;
    }
    
   public function addproject($data)
    {
      $formArray = $data['projectdetails'];  
      $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
      
      if(empty($formArray['projectdtls_pk'])){
          $curruser = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
          
          $model = ProjectdtlsTbl::find()
              ->where(['prjd_referenceno'=> $formArray['prjd_referenceno']])
              ->asArray()->one();

          $byuser = UsermstTbl::find()
          ->select(['UM_MemberRegMst_Fk'])
          ->where(['UserMst_Pk' => $curruser])
          ->asArray()->one();


          if (empty($model) && ($byuser->UM_MemberRegMst_Fk != $companypk)) {  }
          else{return "dup"; }
          $model = new ProjectdtlsTbl();
          $model->prjd_memberregmst_fk = $companypk;
          $model->prjd_referenceno = Security::sanitizeInput($formArray['prjd_referenceno'],"string");
          $model->prjd_projname = Security::sanitizeInput($formArray['prjd_projname'],"string");
          $model->prjd_projdesc = Security::sanitizeInput($formArray['prjd_projdesc'],"html");
          $model->prjd_benefeat = Security::sanitizeInput($formArray['prjd_benefeat'],"html");
          $model->prjd_approvals = Security::sanitizeInput($formArray['prjd_approvals'],"number");
          $model->prjd_sectormst_fk = Security::sanitizeInput($formArray['prjd_sectormst_fk'],"number");
          $model->prjd_industrymst_fk = Security::sanitizeInput($formArray['prjd_industrymst_fk'],"number");
          $model->prjd_projtype = Security::sanitizeInput($formArray['prjd_projtype'],"number");
          $model->prjd_projcost = Security::sanitizeInput($formArray['prjd_projcost'],"float");
          $model->prjd_projstage = Security::sanitizeInput($formArray['prjd_projstage'],"number");
          $model->prjd_projstatus = 1;
          $model->prjd_pymtstatus = 1;
          $model->prjd_submittedon = date('Y-m-d H:i:s');
          $model->prjd_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
          $model->prjd_submittedbyipaddr =\common\components\Common::getIpAddress();
            if($formArray['formname']=='formtimeline' && !empty($formArray['prjd_plannedprojstrtdt'])){
            $model->prjd_plannedprojstrtdt = Security::sanitizeInput(date('Y-m-d',  strtotime($formArray['prjd_plannedprojstrtdt'])),"string");
            }else{
            $model->prjd_plannedprojstrtdt = null;    
            }
            if($formArray['formname']=='formtimeline' && !empty($formArray['prjd_plannedprojenddt'])){
            $model->prjd_plannedprojenddt = Security::sanitizeInput(date('Y-m-d',  strtotime($formArray['prjd_plannedprojenddt'])),"string");
            }else{
            $model->prjd_plannedprojenddt = null;
            }
          $result=array(
              'status' => 200,
              'statusmsg' => 'success',
              'flag'=>'S',
              'msg'=>'Project created successfully!',
              'returndata' => $model
          );
      }  else {
          $model = ProjectdtlsTbl::find()->where(['projectdtls_pk' => $formArray['projectdtls_pk']])->one();   
          if($formArray['formname']=='forminfo'){
              $model->prjd_referenceno = Security::sanitizeInput($formArray['prjd_referenceno'],"string");
              $model->prjd_projname = Security::sanitizeInput($formArray['prjd_projname'],"string");
              $model->prjd_projdesc = Security::sanitizeInput($formArray['prjd_projdesc'],"html");
              $model->prjd_benefeat = Security::sanitizeInput($formArray['prjd_benefeat'],"html");
              $model->prjd_approvals = Security::sanitizeInput($formArray['prjd_approvals'],"number");
              $model->prjd_sectormst_fk = Security::sanitizeInput($formArray['prjd_sectormst_fk'],"number");
              $model->prjd_industrymst_fk = Security::sanitizeInput($formArray['prjd_industrymst_fk'],"number");
              $model->prjd_projtype = Security::sanitizeInput($formArray['prjd_projtype'],"number");
              $model->prjd_projcost = Security::sanitizeInput($formArray['prjd_projcost'],"float");
              $model->prjd_projstage = Security::sanitizeInput($formArray['prjd_projstage'],"number");            
          }
          if($formArray['formname']=='formlocation'){
          
          if($formArray['prjd_projpresloc']==1){
            $model->prjd_projpresloc = Security::sanitizeInput($formArray['prjd_projpresloc'],"number"); 
            $model->prjd_projpressubloc = Security::sanitizeInput($formArray['prjd_projpressubloc'],"number");
          }
          if($formArray['prjd_projpresloc']==3){
            $model->prjd_projpresloc = Security::sanitizeInput($formArray['prjd_projpresloc1'],"number");
          }
          if($formArray['prjd_projpresloc']==3 && $formArray['prjd_projpresloc1']==2){
            $model->prjd_projpressubloc = Security::sanitizeInput($formArray['prjd_projpressubloc1'],"number");  
          }
          
          $model->prjd_projpresence = Security::sanitizeInput($formArray['prjd_projpresence'],"number");
          $model->prjd_statemst_fk = Security::sanitizeInput($formArray['prjd_statemst_fk'],"number");
          $model->prjd_citymst_fk = Security::sanitizeInput($formArray['prjd_citymst_fk'],"number");
          $prjd_gmapcoord=Security::sanitizeInput($formArray['projlatitude'],"string")." , ".Security::sanitizeInput($formArray['projlongitude'],"string");
          $model->prjd_gmapcoord = $prjd_gmapcoord;
          }
          if($formArray['formname']=='formtimeline' && !empty($formArray['prjd_plannedprojstrtdt'])){
          $model->prjd_plannedprojstrtdt = Security::sanitizeInput(date('Y-m-d',  strtotime($formArray['prjd_plannedprojstrtdt'])),"string");
          }
          if($formArray['formname']=='formtimeline' && !empty($formArray['prjd_plannedprojenddt'])){
          $model->prjd_plannedprojenddt = Security::sanitizeInput(date('Y-m-d',  strtotime($formArray['prjd_plannedprojenddt'])),"string");
          }
          if($formArray['formname']=='formindicator'){
          $model->prjd_roi = Security::sanitizeInput($formArray['prjd_roi'],"string");
          $model->prjd_riskfactors = Security::sanitizeInput($formArray['prjd_riskfactors'],"string");
          }
          
          $model->prjd_projcategory = Security::sanitizeInput($formArray['prjd_projcategory'],"number");
          $model->prjd_projectid = Security::sanitizeInput($formArray['prjd_projectid'],"string");
          $model->prjd_projectdtls_fk = Security::sanitizeInput($formArray['prjd_projectdtls_fk'],"number");
          $model->prjd_scope = Security::sanitizeInput($formArray['prjd_scope'],"string");
          $model->prjd_accreditations = Security::sanitizeInput($formArray['prjd_accreditations'],"string");
          $model->prjd_natureofbusiness_fk = Security::sanitizeInput($formArray['prjd_natureofbusiness_fk'],"number");
          $model->prjd_abtprojpres = Security::sanitizeInput($formArray['prjd_abtprojpres'],"string");
          $model->prjd_projdurationtype = Security::sanitizeInput($formArray['prjd_projdurationtype'],"number");
          $model->prjd_projduration = Security::sanitizeInput($formArray['prjd_projduration'],"number");
          $model->prjd_dateofinception = $formArray['prjd_dateofinception'];
          $model->prjd_specifications = $formArray['prjd_specifications'];
          $model->prjd_demandinfo = Security::sanitizeInput($formArray['prjd_demandinfo'],"string");
          $model->prjd_potentialmarkets = Security::sanitizeInput($formArray['prjd_potentialmarkets'],"string");
          $model->prjd_investmenttype_fk = Security::sanitizeInput($formArray['prjd_investmenttype_fk'],"number");
          $model->prjd_diligenceformmst_fk = Security::sanitizeInput($formArray['prjd_diligenceformmst_fk'],"number");
          $model->prjd_localecoimpact = Security::sanitizeInput($formArray['prjd_localecoimpact'],"string");
          $model->prjd_omanimanpower = Security::sanitizeInput($formArray['prjd_omanimanpower'],"number");
          $model->prjd_expmanpower = Security::sanitizeInput($formArray['prjd_expmanpower'],"number");
          $model->prjd_projinvproced = Security::sanitizeInput($formArray['prjd_projinvproced'],"string");
          $model->prjd_projecttags = Security::sanitizeInput($formArray['prjd_projecttags'],"string");
          $model->prjd_indemandmst_fk = Security::sanitizeInput($formArray['prjd_indemandmst_fk'],"number");
          $model->prjd_permalink = Security::sanitizeInput($formArray['prjd_permalink'],"html");
          $model->prjd_updatedon = date('Y-m-d H:i:s');
          $model->prjd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
          $model->prjd_updatedbyipaddr =\common\components\Common::getIpAddress();
          $result=array(
              'status' => 200,
              'statusmsg' => 'success',
              'flag'=>'S',
              'msg'=>'Project updated successfully!',
              'returndata' => $model
          );
      }
      
      if ($model->save() === false) {
          $result=array(
              'status' => 404,
              'statusmsg' => 'warning',
              'flag'=>'E',
              'msg'=>'Something went wrong'
          );
      }  else {
            $fk=$model->projectdtls_pk;
            if($formArray['formname']=='forminfo')

           if($formArray['formname']=='forminfo'){
           $model1 = ProjlicpermauthTbl::find()->where('plpa_projectdtls_fk=:fk',array(':fk'=>Security::sanitizeInput($fk,"number")))->one();
          if(empty($formArray['projectdtls_pk']) || empty($model1)){
              
              $a= $data['list'];
              $max=sizeof($a);
              if($max>0){
              $licauthArr = "";
              for($i=0; $i<$max; $i++) { 
                  $licauthArr .=",".$a[$i];
              }    
              $licauthArr=substr($licauthArr,1);
                  $model1 = new ProjlicpermauthTbl();
                  $model1->plpa_projectdtls_fk = $fk;
                  $model1->plpa_createdbyipaddr = \common\components\Common::getIpAddress();
                  $model1->plpa_createdon = date('Y-m-d H:i:s');
                  $model1->plpa_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                  $model1->plpa_licensauthoritiesmst_fk = $licauthArr;
                  if ($model1->save() === false) {
                      $result=array(
                          'status' => 404,
                          'statusmsg' => 'warning',
                          'flag'=>'E',
                          'msg'=>'Something went wrong!'
                      );
                  }
              }
          }
          else{
          
              $fk=$model->projectdtls_pk;
              $licauthArr = "";
              $a= $data['list'];
              $max=sizeof($a);
              if($max>0){
              for($i=0; $i<$max; $i++) { 
                  $licauthArr .=",".$a[$i];
              }$licauthArr=substr($licauthArr,1);
                  $model1->plpa_projectdtls_fk = $fk;
                  $model1->plpa_updatedbyipaddr = \common\components\Common::getIpAddress();
                  $model1->plpa_updatedon = date('Y-m-d H:i:s');
                  $model1->plpa_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                  $model1->plpa_licensauthoritiesmst_fk = $licauthArr;
              if ($model1->save() === false) {
                  $result=array(
                      'status' => 200,
                      'statusmsg' => 'warning',
                      'flag'=>'E',
                      'msg'=>'Something went wrong'
                  );
                  }
              }
          }

           }
          if(!empty($formArray['projectdtls_pk'])){
             
             $invmodel = ProjinvinfodtlsTbl::find()->where(['piid_projectdtls_fk' => $model->projectdtls_pk])->one();  
              $invmodel->piid_updatedon = date('Y-m-d H:i:s');
              $invmodel->piid_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
              $invmodel->piid_updatedbyipaddr = \common\components\Common::getIpAddress();
          }else{
              
              $invmodel = new ProjinvinfodtlsTbl();
              $invmodel->piid_projectdtls_fk = $model->projectdtls_pk;
              $invmodel->piid_createdon = date('Y-m-d H:i:s');
              $invmodel->piid_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
              $invmodel->piid_createdbyipaddr = \common\components\Common::getIpAddress();
          }
          if($formArray['formname']=='forminfo'){
              $invmodel->piid_totinvreqd = Security::sanitizeInput($formArray['projreq'],"float");
              $invmodel->piid_totinvrecd = Security::sanitizeInput($formArray['projrec'],"float");
          }
          if (!$invmodel->save()) {
              $result=array(
                  'status' => 200,
                  'statusmsg' => 'warning',
                  'flag'=>'E',
                  'msg'=>'Something went wrong'
              );
          }
         if(!empty($formArray['deletepk'])){
                foreach (array_filter($formArray['deletepk']) as $key => $deletevaluepk) {
                    if(isset($deletevaluepk)){
                    $modelorgdelete = ProjectpartnerdtlsTbl::find()
                   ->where(['projectpartnerdtls_pk'=> $deletevaluepk])->one();
                    if(!empty($modelorgdelete)){
                    if ($modelorgdelete->delete() === false) {
                        $modelorgdelete->getErrors();
                    }
                    }
                    }
                }
            }
          if(!empty($formArray['opdtls'])){
              if(!empty($formArray['projectdtls_pk'])){
                  
                   foreach ($formArray['opdtls'] as $key => $opdtlsvalue) {
                   
                   $opdtlsmodel = ProjectpartnerdtlsTbl::find()->where("projectpartnerdtls_pk =:pk",array(':pk'=>Security::sanitizeInput($opdtlsvalue['organizaionpk'],"number")))->one();
                   if(empty($opdtlsmodel))
                   {
                          $opdtlsmodel = new ProjectpartnerdtlsTbl();
                          $opdtlsmodel->prjpd_projectdtls_fk = $model->projectdtls_pk;
                          $opdtlsmodel->prjpd_partnermst_fk = Security::sanitizeInput($opdtlsvalue['organisType'],"number");
                          $opdtlsmodel->prjpd_partnerorginfo = Security::sanitizeInput($opdtlsvalue['organisName'],"string");
                          $opdtlsmodel->prjpd_createdon = date('Y-m-d H:i:s');
                          $opdtlsmodel->prjpd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                          $opdtlsmodel->prjpd_createdbyipaddr = \common\components\Common::getIpAddress();
                          if ($opdtlsmodel->save() === false) {
                              $result=array(
                                  'status' => 200,
                                  'statusmsg' => 'warning',
                                  'flag'=>'E',
                                  'msg'=>'Something went wrong'
                              );
                     }
                   }else{
                          $opdtlsmodel->prjpd_partnermst_fk = Security::sanitizeInput($opdtlsvalue['organisType'],"number");
                          $opdtlsmodel->prjpd_partnerorginfo = Security::sanitizeInput($opdtlsvalue['organisName'],"string");   
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
                              'msg'=>'Something went wrong'
                          );
                         }
                   }
                   }
              }else{
              foreach ($formArray['opdtls'] as $opdtlsVal){
                  $opdtlsmodel = new ProjectpartnerdtlsTbl();
                  $opdtlsmodel->prjpd_projectdtls_fk = $model->projectdtls_pk;
                  $opdtlsmodel->prjpd_partnermst_fk = Security::sanitizeInput($opdtlsVal['organisType'],"number");
                  $opdtlsmodel->prjpd_partnerorginfo = Security::sanitizeInput($opdtlsVal['organisName'],"string");
                  $opdtlsmodel->prjpd_createdon = date('Y-m-d H:i:s');
                  $opdtlsmodel->prjpd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                  $opdtlsmodel->prjpd_createdbyipaddr = \common\components\Common::getIpAddress();
                  if ($opdtlsmodel->save() === false) {
                      $result=array(
                          'status' => 200,
                          'statusmsg' => 'warning',
                          'flag'=>'E',
                          'msg'=>'Something went wrong'
                      );
                  }
              }
              }
          }
          if(!empty($formArray['faqdeletepk'])){
                foreach (array_filter($formArray['faqdeletepk']) as $key => $deletevaluepk) {
                    if(isset($deletevaluepk)){
                    $modelfaqdelete = ProjfaqdtlsTbl::find()
                   ->where(['projfaqdtls_pk'=> $deletevaluepk])->one();
                    if(!empty($modelfaqdelete)){
                    if ($modelfaqdelete->delete() === false) {
                        $modelfaqdelete->getErrors();
                    }
                    }
                    }
                }
            }
          if(!empty($formArray['faqdtls'])){
              if(!empty($formArray['projectdtls_pk'])){
                  
                   foreach ($formArray['faqdtls'] as $key => $faqdtlsvalue) {
                   
                   $faqdtlsmodel = ProjfaqdtlsTbl::find()->where("projfaqdtls_pk =:pk",array(':pk'=>Security::sanitizeInput($faqdtlsvalue['faqpk'],"number")))->one();
                   if(empty($faqdtlsmodel))
                   {
                          $faqdtlsmodel = new ProjfaqdtlsTbl();
                          $faqdtlsmodel->pfd_projectdtls_fk = $formArray['projectdtls_pk'];
                          $faqdtlsmodel->pfd_question = Security::sanitizeInput($faqdtlsvalue['faqQues'],"string");
                          $faqdtlsmodel->pfd_answer = Security::sanitizeInput($faqdtlsvalue['faqAns'],"string");
                          $faqdtlsmodel->pfd_status=1;
                          $faqdtlsmodel->pfd_createdon = date('Y-m-d H:i:s');
                          $faqdtlsmodel->pfd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                          $faqdtlsmodel->pfd_createdbyipaddr = \common\components\Common::getIpAddress();
                          if ($faqdtlsmodel->save() === false) {
                              $result=array(
                                  'status' => 200,
                                  'statusmsg' => 'warning',
                                  'flag'=>'E',
                                  'msg'=>'Something went wrong'
                              );
                     }
                   }else{
                          $faqdtlsmodel->pfd_question = Security::sanitizeInput($faqdtlsvalue['faqQues'],"string");
                          $faqdtlsmodel->pfd_answer = Security::sanitizeInput($faqdtlsvalue['faqAns'],"string");
                          $faqdtlsmodel->pfd_status=1;
                          $faqdtlsmodel->pfd_updatedon = date('Y-m-d H:i:s');
                          $faqdtlsmodel->pfd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                          $faqdtlsmodel->pfd_updatedbyipaddr = \common\components\Common::getIpAddress();
                         if($faqdtlsmodel->save())
                         {
                         }else{
                          $result=array(
                              'status' => 200,
                              'statusmsg' => 'warning',
                              'flag'=>'E',
                              'msg'=>'Something went wrong'
                          );
                         }
                   }
                   }
              }else{
                  foreach ($formArray['faqdtls'] as $faqdtlsVal){
                  $faqdtlsmodel = new ProjfaqdtlsTbl();
                  $faqdtlsmodel->pfd_projectdtls_fk = $formArray['projectdtls_pk'];
                  $faqdtlsmodel->pfd_question = Security::sanitizeInput($faqdtlsVal['faqQues'],"string");
                  $faqdtlsmodel->pfd_answer = Security::sanitizeInput($faqdtlsVal['faqAns'],"string");
                  $faqdtlsmodel->pfd_status=1;
                  $faqdtlsmodel->pfd_createdon = date('Y-m-d H:i:s');
                  $faqdtlsmodel->pfd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                  $faqdtlsmodel->pfd_createdbyipaddr = \common\components\Common::getIpAddress();
                  if ($faqdtlsmodel->save() === false) {
                      $result=array(
                          'status' => 200,
                          'statusmsg' => 'warning',
                          'flag'=>'E',
                          'msg'=>'Something went wrong'
                      );
                  }
              }
              }
          }
       return [
          'msg' => "success",
          'status' => 1,
          'projecDtlspk' => $model->projectdtls_pk,
          ];
      }
    }  
     
    public function opdtls($projectPk)
    {
      $model =  ProjectpartnerdtlsTbl::find()
                ->select(['*'])
                ->leftJoin('partnermst_tbl','prjpd_partnermst_fk=partnermst_pk')
                ->where('prjpd_projectdtls_fk=:fk',array(':fk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'returndata' => $model
            );
        }
        return json_encode($result);
    }
    
    public function faqdtls($projectPk)
    {
      $model = ProjfaqdtlsTbl::find()
                ->select(['*'])
                ->where('pfd_projectdtls_fk=:fk',array(':fk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $model
            );
        }
        return json_encode($result);
    }
    
    public function authoritieslist($licensePk)
    {
        $model = ProjectdtlsTbl::find()
        ->select(['*'])
        ->where("projectdtls_pk =:pk",array(':pk'=> Security::sanitizeInput($licensePk,"number")))->one();
        if (empty($model)) {
            $model->getErrors();
        }else{
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($model)?$model:[],
            ];
}
    }
    
    public function activelicenseauthorities()
    {
        $model = LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk as value','lam_licenseauthname_en as display'])
                ->where(['=','lam_status',1])
                ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
                ->asArray()->All();
        return $model;
       
    }

    public function editauthoritiesprj($data)
    {
      $list = array(); 
        $a= $data['list']; 
        $a = explode (",", $a);  
        $max=sizeof($a);
        for($i=0; $i<$max; $i++) { 
            $name = LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk','lam_licenseauthname_en'])
                ->where(['=','lam_status',1])
                ->andwhere('licensauthoritiesmst_pk=:pk',array(':pk'=>Security::sanitizeInput($a[$i],"number")))->one()->lam_licenseauthname_en;
            // echo "$a[$i]"; 
            array_push( $list,$name);
        }
        return $list;
    }
    
    public function addLicPermitAuth($licensauthoritiesmst_fk,$projlicpermauth_pk,$projecdtlsPk){
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        if(empty($projlicpermauth_pk)){
            $model = new ProjlicpermauthTbl();
            $model->plpa_createdon= $date;
            $model->plpa_createdby= $userPk;
            $model->plpa_createdbyipaddr= $ip_address;
            $model->plpa_projectdtls_fk= $projecdtlsPk;
        }  else {
            $model = ProjaccreditationTbl::find()->where('projaccreditation_pk=:projaccreditation_pk',[':projaccreditation_pk'=> $accreditationData['projaccreditation_pk']])->one(); 
            $model->plpa_updatedon= $date;
            $model->plpa_updatedby= $userPk;
            $model->plpa_updatedbyipaddr= $ip_address;
        }
            $model->plpa_licensauthoritiesmst_fk= $licensauthoritiesmst_fk;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
                return json_encode($result);
            }
    }
    public function authorities($projecdtlsPk)
    {
      
        $model = ProjlicpermauthTbl::find()
                ->select('group_concat(lam_licenseauthname_en) as licAuthDtls')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=plpa_licensauthoritiesmst_fk')
                ->where('plpa_projectdtls_fk=:fk',array(':fk'=> Security::sanitizeInput($projecdtlsPk,"number")))->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'returndata' => $model
            );
        }
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
                    }else if($key=='prjt_projmodeofimplentmst_fk' || $key=='prjt_ppptype' || $key=='prjt_epctype'){
                        if(!empty($val) && $val!=0){
                            $model->prjt_projmodeofimplentmst_fk = Security::sanitizeInput($val,'number');
                        }
                    } else if($key=='prjt_projbanner'){
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
                );                
            }
            return json_encode($result);
        }
    }
    
    public function addInvestmentDtls($data){
        $proInvArray = $data['investmentDtls'];  
        $protype = $data['type'];  
        $projectPk = Security::decrypt($proInvArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        if($protype=='invdtls'){
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:piit_projectdtls_fk',[':piit_projectdtls_fk'=> $projectPk])->one();
        if(!empty($model)){
            $model->piit_updatedon = $date;
            $model->piit_updatedby = $userPk;
            $model->piit_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_investmentstatus= Security::sanitizeInput($proInvArray['piit_opentoinvest'], "number");
        $model->piit_investtype= Security::sanitizeInput($proInvArray['piit_invparticipation'], "number");
        $model->piit_invprefsrc= Security::sanitizeInput($proInvArray['piit_invprefsrc'], "number");
       $model->piit_totinvrecd= Security::sanitizeInput($proInvArray['projrec'], "number");
        
        }
        if($protype=='projval'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $model->prjt_projcostvalue= Security::sanitizeInput($proInvArray['projcst'], "number");
//        if($proInvArray['projcst']==1){
        $model->prjt_projcost= Security::sanitizeInput($proInvArray['projvalue'], "number");
//        }else{
//        $model->prjt_projcost= null;
//        }
        $model->prjt_debt= Security::sanitizeInput($proInvArray['funddebt'], "number");
        $model->prjt_amtspentsofar= Security::sanitizeInput($proInvArray['fundspentamt'], "number");
        $model->prjt_equity= Security::sanitizeInput($proInvArray['equityusd'], "number");
        $model->prjt_balanceamt= Security::sanitizeInput($proInvArray['balanceamt'], "number");
        $model->prjt_debtequityratio= Security::sanitizeInput($proInvArray['equitratio'], "string");
        
        $model1 = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        if(empty($model1)){
            $model1 = new ProjinvinfotmpTbl();
            $model1->piit_projecttmp_fk = $projectPk;
            $model1->piit_submittedon = $date;
            $model1->piit_submittedby = $userPk;
            $model1->piit_submittedbyipaddr = $ip_address;
        }
        $model1->piit_totinvrecd = Security::sanitizeInput($proInvArray['projrec'], "number");
        $model1->save();
        
    }
        if($protype=='projfund'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $model->prjt_projfundmst_fk= Security::sanitizeInput($proInvArray['projfundby'], "number");
        if($proInvArray['projfundby']==6){
        $model->prjt_projotherfund= Security::sanitizeInput($proInvArray['projother'], "string");
        }else{
        $model->prjt_projotherfund= null ;
        }
        $model->prjt_fundpercent= Security::sanitizeInput($proInvArray['fundper'], "number");
        $model->prjt_fundrefno= Security::sanitizeInput($proInvArray['fundrefno'], "string");
        }
        
        if($protype=='projinvguide'){
        $model = ProjecttmpTbl::find()->where('projecttmp_pk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        $model->prjt_projinvproced= Security::sanitizeInput($proInvArray['prjt_projinvproced'], "string");
        }
    
        if($protype=='projvid'){
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:projectdtls_pk',[':projectdtls_pk'=> $projectPk])->one(); 
        if(empty($model)){
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_welcomenote= Security::sanitizeInput($proInvArray['wecomenote'], "string");
        }
        if ($model->save() == false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        } else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Added Successfully!',
                'returndata' => $model
            );
        }
        
            return json_encode($result);
    }
    
    public function addInviteInvestors($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        
        $inviteInvArray = $data['listinv'];
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $regPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('reg_pk',true), "number");
        $inviteInvPk = [];
        foreach ($inviteInvArray as $key => $inviteInvData){
            $model = ProjinvmappingtmpTbl::find()->where('projinvmappingtmp_pk=:projinvmapping_pk',[':projinvmapping_pk'=> $inviteInvData['investorid']])->one(); 
            $model->pimt_updatedon= $date;
            $model->pimt_updatedby= $userPk;
            $model->pimt_updatedbyipaddr= $ip_address;
            $model->pimt_order= Security::sanitizeInput($key, "number");
            $model->pimt_name= Security::sanitizeInput($inviteInvData['name'], "string");
            $model->pimt_status=Security::sanitizeInput(1,'number');
            $model->pimt_emailid= $inviteInvData['emailid'];
            $model->pimt_projecttmp_fk= $projectPk;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            } else {
                $inviteInvPk[] = $model->projinvmappingtmp_pk;
            }
        }
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Invite Investors Add / Updated successfully!',
            'returndata' => $inviteInvPk,
        );        
        return json_encode($result);
    }
    
    public function getinvlistedit($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
      $model = ProjinvmappingtmpTbl::find()
                ->select(['*'])
                ->where('pimt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        $investor=[];
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'alert',
                'flag'=>'A',
                'msg'=>'No record found!'
            );
        }else{
        foreach ($model as $key => $value) {
            $investor[$key]['name']=$value['pimt_name'];
            $investor[$key]['investorid']=$value['projinvmappingtmp_pk'];
            $investor[$key]['emailid']=$value['pimt_emailid'];
        }
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $investor
            );
        }
        return json_encode($result);
    }
    
    public function getfaqlistedit($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
      $model = ProjfaqtmpTbl::find()
                ->select(['*'])
                ->where('pft_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        $faq=[];
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'alert',
                'flag'=>'A',
                'msg'=>'No record found!'
            );
        }else{
        foreach ($model as $key => $value) {
            $faq[$key]['ques']=$value['pft_question'];
            $faq[$key]['ans']=$value['pft_answer'];
        }
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $faq
            );
        }
        return json_encode($result);
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
            $model->prjt_projinvproced = Security::sanitizeInput($invGuideArray['prjt_projinvproced'], "string");

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
    
    public function addInvestorCiteria($data){
        $proInvCiteriaArray = $data['investorCiteriaData'];
        $projectPk = Security::decrypt($proInvCiteriaArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $i=1;
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');  
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjinvinfotmpTbl::find()->where('piit_projecttmp_fk=:piit_projectdtls_fk',[':piit_projectdtls_fk'=> $projectPk])->one(); 
        if(!empty($model)){
            $model->piit_updatedon = $date;
            $model->piit_updatedby = $userPk;
            $model->piit_updatedbyipaddr = $ip_address;
        }  else {
            $model = new ProjinvinfotmpTbl();
            $model->piit_submittedon = $date;
            $model->piit_submittedby = $userPk;
            $model->piit_submittedbyipaddr = $ip_address;
            $model->piit_projecttmp_fk= $projectPk;
        }
        $model->piit_targetinvestors= $proInvCiteriaArray['invinvestors'];
        $model->piit_welcomenote= $proInvCiteriaArray['welnote'];
        if ($model->save() === false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }  else {
            ProjreqdlictmpTbl::deleteAll('prlt_projecttmp_fk=:pk',[':pk'=>Security::sanitizeInput($projectPk,"number")]);
        foreach ($proInvCiteriaArray['permitlicenses'] as $value)
        {
            if(!empty($value['licensename']))
            {
            $modelreqlic = new ProjreqdlictmpTbl;
            $modelreqlic->prlt_projecttmp_fk=$projectPk;
            $modelreqlic->prlt_licensinginfo_fk= Security::sanitizeInput($value['licensename'], "number");
            $modelreqlic->prlt_order= $i;
            $modelreqlic->prlt_submittedon= $date;
            $modelreqlic->prlt_submittedby= $userPk;
            $modelreqlic->prlt_submittedbyipaddr= $ip_address;
            $i=$i+1;    
            if ($modelreqlic->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$modelreqlic->getErrors()
                );
            }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Investor Citeria Add / Updated successfully!',
                'returndata' => $model,
            ); }
        }
        }
        }
            return json_encode($result);
    }
    
    // public function activelicenseauthorities()
    // {
    //     $model = LicensauthoritiesmstTbl::find()
    //             ->select(['licensauthoritiesmst_pk as value','lam_licenseauthname_en as display'])
    //             ->where(['=','lam_status',1])
    //             ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
    //             ->asArray()->All();
    //     return $model;
       
    // }
    
    public function addFinancial($data){
        $proFinancialArray = $data['financialData'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            if(!empty($proFinancialArray['prjt_finindicators']))
            {
            $model->prjt_finindicators = Security::sanitizeInput($proFinancialArray['prjt_finindicators'], "html");
            }
            if(!empty($proFinancialArray['prjt_roi']))
            {
            $model->prjt_roi = Security::sanitizeInput($proFinancialArray['prjt_roi'], "html");
            }
            if(!empty($proFinancialArray['prjt_riskfactors']))
            {
            $model->prjt_riskfactors = Security::sanitizeInput($proFinancialArray['prjt_riskfactors'], "html");
            }
            if(!empty($proFinancialArray['prjt_riskdisclosures']))
            {
            $model->prjt_riskdisclosures = Security::sanitizeInput($proFinancialArray['prjt_riskdisclosures'], "html");
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
    
    public function addContactInfo($data){
        $proContactArray = $data['contactInfoData'];  
        $projectPk = Security::decrypt($data['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one();
        
        if(!empty($model) && !empty($proContactArray)){
           $proContactArray= implode(',', $proContactArray);
           
            $model->prjd_contactinfo = $proContactArray;
            if ($model->save() === false) {
                $result= array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else {
                $result= array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Contact Add / Updated Successfully!',
                    'returndata' => $model
                );
            }
        }  else {
            $result= array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model
            );
        }
        return json_encode($result);
    }


    public function getContracts($data){ 
        ini_set('memory_limit', '-1');
        
        if(!empty($data['projectpk'])){
            return \api\modules\pd\models\ProjectdtlsTblQuery::getContracts($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getContractsForIcvProgress($data) {
        ini_set('memory_limit', '-1');
        
        if(!empty($data['projectpk'])){
            return \api\modules\pd\models\ProjectdtlsTblQuery::getContractsForIcvProgress($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public static function getArrayRecursiveCount(&$a, $c = 0)
    {
        foreach($a as $v)
        {
            // $c += count($v);
            $c++;
            if($v['subContract']){
                self::getArrayRecursiveCount($v['subContract']);
            }
        }
        return $c;
    }
}
