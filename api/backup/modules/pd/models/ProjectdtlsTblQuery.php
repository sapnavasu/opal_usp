<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use \api\modules\pd\models\ProjectdtlsTbl;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\models\SupportcollateraldtlsTbl;
use api\modules\mst\models\SectormstTbl;
use common\models\PartnermstTbl;
use common\models\ProjinvinfodtlsTbl;
use common\models\ProjectpartnerdtlsTbl;
use api\modules\mst\models\SubsectormstTbl;
use api\modules\mst\models\LicensauthoritiesmstTbl;
use api\modules\mst\models\ProjlicpermauthTbl;
use api\modules\mst\models\SubsectormstTblQuery;
use api\modules\mst\models\CountryMaster;
use common\components\Security;
use \common\models\UsermstTbl;
use common\components\Common;
use common\components\Drive;
use api\modules\pd\models\ProjfaqdtlsTbl;
use api\modules\pd\models\ProjfaqdtlsTblQuery;

/**
 * This is the ActiveQuery class for [[ProjectdtlsTbl]].
 *
 * @see ProjectdtlsTbl
 */
class ProjectdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function index($data)
    {   $query = ProjectdtlsTbl::find();
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
                if($val !=null)
                {
                    if($key!="prjd_projname" && $key!="prjd_referenceno")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjd_projname', true), ':value',array(':value' =>  $val)],
                      ['LIKE',Common::getTableWithPrefix('prjd_referenceno', true), ':value',array(':value' =>  $val)],
                      ['LIKE',Common::getTableWithPrefix('prjd_projectid', true), ':value',array(':value' =>  $val)]]); 
                    }
                }
            }
        }
        $query->select(['*',"TIMESTAMPDIFF(YEAR, prjd_plannedprojstrtdt, prjd_plannedprojenddt) as Diff,"
            . "TIMESTAMPDIFF(MONTH, prjd_plannedprojstrtdt, prjd_plannedprojenddt)%12 as Diffmonth,"
            . "crby.UM_EmpName as projownername"]);
        $query->leftJoin('sectormst_tbl','projectdtls_tbl.prjd_sectormst_fk=sectormst_tbl.sectorMst_Pk');        
        $query->leftJoin('statemst_tbl','projectdtls_tbl.prjd_statemst_fk = statemst_tbl.StateMst_Pk');
        $query->leftJoin('citymst_tbl','projectdtls_tbl.prjd_citymst_fk=citymst_tbl.CityMst_Pk');
        $query->leftJoin('usermst_tbl crby','projectdtls_tbl.prjd_createdby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl decby','projectdtls_tbl.prjd_apprdeclby=decby.UserMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','decby.UM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->andWhere('prjd_memberregmst_fk=:id',array(':id' =>  $_SESSION['v3session'])) ; 
        if($sortpk==1){
        $query->orderBy('prjd_submittedon DESC');
        }else {
        $query->orderBy('prjd_submittedon ASC');    
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
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

    public function view($id)
    {
        $model=ProjectdtlsTbl::find()
            ->select(['*'])
            ->leftJoin('projlicpermauth_tbl','projlicpermauth_tbl.plpa_projectdtls_fk=projectdtls_tbl.projectdtls_pk')
            ->leftJoin('projinvinfodtls_tbl','projinvinfodtls_tbl.piid_projectdtls_fk=projectdtls_tbl.projectdtls_pk')
            ->where('projectdtls_pk=:id',array(':id' =>  $id))
            ->asArray()
            ->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
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


    public function getorgtype()
    {
      return new ActiveDataProvider([
        'query' => PartnermstTbl::find()
            ->select(['partnermst_pk','prms_orgtype'])
            ->asArray()
            ->active()
    ]);
    }


    public function projdetails()
    {
      $model = ProjectdtlsTbl::find()
                ->select('COUNT(prjd_submittedby) as total')
                ->where(['prjd_submittedby'=> \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true)])
                ->asArray()->all();
                
        $model1 = ProjectdtlsTbl::find()
                ->select('COUNT(prjd_submittedby) as total')
                ->where(['prjd_submittedby'=> \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true)])
                ->where(['prjd_projstage'=> 6])
                ->asArray()->all();        
                echo "<pre>";

        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$model,$model1];
        }
    }

  

    public function viewproject($projecdtlsPk)
    {
      $model = ProjectdtlsTbl::find()
                ->select('IndM_IndustryName,SecM_SectorName,prjd_projname,prjd_projectid,prjd_projstage,prjd_projstatus,prjd_referenceno,MCM_CompanyName,piid_totinvreqd,piid_totinvrecd,piid_investorbenefits,prjd_projcost,prjd_projtype,prjd_projdesc,prjpd_partnerorginfo,prjd_projpresloc,prjd_plannedprojenddt,prjd_plannedprojstrtdt,projectdtls_pk')
                ->leftJoin('sectormst_tbl','SectorMst_Pk=prjd_sectormst_fk')
                ->leftJoin('industrymst_tbl','IndustryMst_Pk=prjd_industrymst_fk')
                ->leftJoin('projinvinfodtls_tbl','piid_projectdtls_fk=projectdtls_pk')
                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=prjd_memberregmst_fk')
                ->leftJoin('projectpartnerdtls_tbl','prjpd_projectdtls_fk=projectdtls_pk')
                ->leftJoin('projlicpermauth_tbl','prjpd_projectdtls_fk=projectdtls_pk')
                ->where('projectdtls_pk=:pk', array(':pk'=> Security::sanitizeInput($projecdtlsPk,"number")))->asArray()->one();
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
                'msg'=>'View request successfully!',
                'returndata' => $model
            );
        }
        return json_encode($result);
    }

    


    public function editproject($licensePk)
    {
      $model = ProjectdtlsTbl::find()
                ->select(['*'])
                ->where('projectdtls_pk=:pk',array(':pk'=> Security::sanitizeInput($licensePk,"number")))->one();
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


    public function submitProjectData($formData) {
        $memRegPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $date = date('Y-m-d H:i:s');
        $ipaddress = \common\components\Common::getIpAddress();
        if (!empty($formData['projectPk'])) {
            $flag = 'U';
            $comments = 'Project updated successfully.';
            $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk", [':pk' => $formData['projectPk']])->one();
            $model->prjd_updatedon = $date;
            $model->prjd_updatedby = $userPk;
            $model->prjd_updatedbyipaddr = $ipaddress;
        } else {
            $flag = 'C';
            $comments = 'Project Created Successfully.';
            $model = new ProjectdtlsTbl();
            $model->prjd_createdon = $date;
            $model->prjd_createdby = $userPk;
            $model->prjd_createdbyipaddr = $ipaddress;
            $model->prjd_memberregmst_fk = $memRegPk;
            $model->prjd_domain = 2;
            $model->prjd_projstatus = 3;
            $model->prjd_projectid = Common::getUniqueId('project');
        }
        $model->prjd_referenceno = $formData['refNo'];
        $model->prjd_projname = $formData['proName'];
        $model->prjd_currencymst_fk = $formData['currencyFk'];
        $model->prjd_projcost = $formData['proValue'];
        $model->prjd_district = $formData['district'];
        $model->prjd_sectormst_fk = $formData['sectorPk'];
        $model->prjd_industrymst_fk = $formData['industryPk'];
        $model->prjd_shortsummary = $formData['shortSummary'];
        $model->prjd_plannedprojstrtdt = $formData['plannedStartDate'];
        $model->prjd_plannedprojenddt = $formData['plannedEndDate'];
        $model->prjd_countrymst_fk = $formData['countryPk'];
        $model->prjd_statemst_fk = $formData['statePk'];
        $model->prjd_citymst_fk = $formData['cityPk'];
        $model->prjd_projteam = $formData['mapUser'];
        $model->prjd_projstage = $formData['stagePk'];
        $model->prjd_projimg_fk = $formData['proImgPk'];
        $model->prjd_projdesc = $formData['projDesc'];
        $model->prjd_blockmst_fk = $formData['block'];
        $model->prjd_projdelayreason = $formData['projdelayreason'];
        $model->prjd_classification = $formData['proClassification'];

        $model->prjd_submittedon = $date;
        $model->prjd_submittedby = $userPk;
        $model->prjd_submittedbyipaddr = $ipaddress;
        if ($model->save() === TRUE) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => $flag,
                'comments' => $comments
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'Error',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'moduleData' => $model->getErrors(),
            );
        }
        return $result;
    }
    public function getListProjectData($data) {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);        
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $proId = Security::sanitizeInput($data['proId'], "string_spl_char");
        $proRef = Security::sanitizeInput($data['proRef'], "string_spl_char");
        $projectName = Security::sanitizeInput($data['projectName'], "string_spl_char");
        $sectorPk = Security::sanitizeInput($data['sectorPk'], "string_spl_char");
        $industryPk = Security::sanitizeInput($data['industryPk'], "string_spl_char");
        $stage = Security::sanitizeInput($data['stage'], "string_spl_char");
        $startDate = Security::sanitizeInput($data['proStartDate'], "string_spl_char");
        $endDate = Security::sanitizeInput($data['proEndDate'], "string_spl_char");
        $model = ProjectdtlsTbl::find()
                ->select(['projectdtls_pk', 'prjd_projectid', 'prjd_referenceno','prjd_district', 'prjd_projname', 'prjd_projcost', 'prjd_shortsummary', 'prjd_plannedprojstrtdt', 'prjd_plannedprojenddt', 'SecM_SectorCode', 'SecM_SectorName', 'IndM_IndustryCode', 'IndM_IndustryName', 'prsm_projstage', 'prjd_projstage', 'CyM_CountryName_en', 'prjd_countrymst_fk', 'prjd_sectormst_fk', 'prjd_industrymst_fk', 'prjd_statemst_fk', 'SM_StateName_en', 'prjd_citymst_fk', 'CM_CityName_en', 'creater.um_firstname as createrName', 'creater.UM_EmpId as createrEmpId', 'prjd_contactinfo', 'prjd_projimg_fk', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk', 'mcfd_uploadedby', 'prjd_createdon', 'prjd_projstatus','prjd_projdesc','prjd_classification','prjd_projteam','prjd_projdelayreason','prjd_updatedon','prjd_currencymst_fk','prjd_blockmst_fk',
                    "ROUND(SUM(IF(prjd_currencymst_fk = 3, prjd_projcost * 2.60080, prjd_projcost)),2) as 'projectValueUSD'",
                    "ROUND(SUM(IF(prjd_currencymst_fk = 21, prjd_projcost / 2.60080, prjd_projcost)),3) as 'projectValueOMR'" 
                    ])
                ->leftJoin('sectormst_tbl', 'SectorMst_Pk = prjd_sectormst_fk')
                ->leftJoin('industrymst_tbl', 'IndustryMst_Pk = prjd_industrymst_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk = prjd_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk = prjd_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk = prjd_citymst_fk')
                ->leftJoin('usermst_tbl as creater', 'creater.UserMst_Pk = prjd_createdby')
                ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projimg_fk')
                ->where('prjd_memberregmst_fk=:pk', array(':pk' => $companypk))                
                ->andWhere('prjd_isdeleted=:type', array(':type' => 2));
        if (!empty($searchTxt)) {
            $model->andFilterWhere(['or', ['like', 'prjd_referenceno', $searchTxt], ['like', 'prjd_projectid', $searchTxt], ['like', 'prjd_projname', $searchTxt], ['like', 'SecM_SectorName', $searchTxt], ['like', 'IndM_IndustryName', $searchTxt], ['like', 'prsm_projstage', $searchTxt]]);
        }
        if (!empty($sectorPk) && !empty($stage)) {
            $model->andFilterWhere(['or',['IN', 'SectorMst_Pk', explode(',', $sectorPk)],['IN', 'projstagemst_pk', explode(',', $stage)]]);
        }  else {
            if (!empty($sectorPk)) {
                $model->andFilterWhere(['IN', 'SectorMst_Pk', explode(',', $sectorPk)]);
            }
            if (!empty($stage)) {
                $model->andFilterWhere(['IN', 'projstagemst_pk', explode(',', $stage)]);
            }            
        }
        if (count(array_filter($status)) > 0) {
            $model->andFilterWhere(['IN', 'prjd_projstatus', explode(',', $status)]);
        }        
        if (count(array_filter($industryPk)) > 0) {
            $model->andFilterWhere(['IN', 'prjd_industrymst_fk',explode(',', $industryPk) ]);
        }        
        if (!empty($proRef) && $proRef != null) {
            $model->andFilterWhere(['like', 'prjd_referenceno', $proRef]);
        }        
        if (!empty($projectName) && $projectName != null) {
            $model->andFilterWhere(['like', 'prjd_projname', $projectName]);
        }        
        if (!empty($proId) && $proId != null) {
            $model->andFilterWhere(['like', 'prjd_projectid', $proId]);
        }        
        if (!empty($startDate) && $startDate != null && !empty($endDate) && $endDate != null) {
            $model->andFilterWhere(['or',['between', 'STR_TO_DATE(prjd_plannedprojstrtdt,"%Y-%m-%d")', $startDate, $endDate],['between', 'STR_TO_DATE(prjd_plannedprojenddt,"%Y-%m-%d")', $startDate, $endDate]]);
        }
        if ($sortpk == 1) {
            $model->orderBy([new \yii\db\Expression("coalesce(prjd_updatedon,prjd_createdon) DESC")]);
        } elseif ($sortpk == 2) {
            $model->orderBy([new \yii\db\Expression("coalesce(prjd_updatedon,prjd_createdon) ASC")]);
        } elseif ($sortpk == 3) {
            $model->orderBy(['prjd_projname' => SORT_ASC]);
        } elseif ($sortpk == 4) {
            $model->orderBy(['prjd_projname' => SORT_DESC]);
        }
        $model->groupBy("projectdtls_pk");
        $page = (!empty($size)) ? $size : 10;
        $model->asArray();
        $provider = new ActiveDataProvider(['query' => $model, 'pagination' => ['pageSize' => $page]]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            $listData['contactUserlist'] = [];
            $listData['contractCount'] = 0;
            $listData['purchaseOrderCount'] = 0;
            $listData['subContractCount'] = 0;
            $listData['subOrderCount'] = 0;
            $listData['agreement'] = 0;
            $listData['subAgreement'] = 0;
            $listData['tenderCount'] = 0;
            if (!empty($listData['prjd_projcost']) && $listData['prjd_projcost'] != null) {
                $listData['prjd_projcostView'] = Common::numberConversionNew($listData['prjd_projcost']);
            }  else {
                $listData['prjd_projcostView'] =null;
            }
            if ($listData['prjd_projteam'] != NULL && !empty($listData['prjd_projteam'])) {
                $listData['contactUserlist'] = \common\models\UsermstTblQuery::getUserlistData($listData['prjd_projteam']);
            } else {
                $listData['contactUserlist'] = [];
            }
            if ($listData['prjd_projimg_fk'] != null) {
                $listData['imgUrl'] = Drive::generateUrl($listData['memcompfiledtls_pk'], $listData['mcfd_memcompmst_fk'], $listData['mcfd_uploadedby']);
            } else {
                $listData['imgUrl'] = 'assets/images/lypis_noimg.svg';
            }
            $contract = ProjectdtlsTbl::find()
                    ->select(["count(distinct if(cmsch_type = 1 and cmsch_contracttype = 1, cmscontracthdr_pk, null)) as 'Contract'","count(distinct if(cmsch_type = 1 and cmsch_contracttype = 2, cmscontracthdr_pk, null)) as 'Sub_Contract'","count(distinct if(cmsch_type = 2 and cmsch_contracttype = 1, cmscontracthdr_pk, null)) as 'Purchase_Order'","count(distinct if(cmsch_type = 2 and cmsch_contracttype = 2, cmscontracthdr_pk, null)) as 'Sub_Order'","count(distinct if(cmsch_type = 3 and cmsch_contracttype = 1, cmscontracthdr_pk, null)) as 'Agreement'","count(distinct if(cmsch_type = 3 and cmsch_contracttype = 2, cmscontracthdr_pk, null)) as 'Sub_Agreement'"])
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk and crfd_isdeleted = 2')
                    ->leftJoin('cmscontracthdr_tbl', 'cmsrequisitionformdtls_pk=cmsch_cmsrequisitionformdtls_fk')
                    ->where('projectdtls_pk=:proPK', array(':proPK' => $listData['projectdtls_pk']))
                    ->asArray()
                    ->one();
            $TenderTbl = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                    ->select("count(cmsrequisitionformdtls_pk) as tenderCount")
                    ->where("crfd_projectdtls_fk =:pk and crfd_isdeleted = 2", [':pk' => $listData['projectdtls_pk']])
                    ->asArray()->one();
            if (!empty($contract)) {
                $listData['contractCount'] = $contract['Contract'];
                $listData['purchaseOrderCount'] = $contract['Purchase_Order'];
                $listData['subContractCount'] = $contract['Sub_Contract'];
                $listData['subOrderCount'] = $contract['Sub_Order'];
                $listData['agreement'] = $contract['Agreement'];
                $listData['subAgreement'] = $contract['Sub_Agreement'];
            }
            if(!empty($TenderTbl)){
                $listData['tenderCount'] = $TenderTbl['tenderCount'];                
            }
            $finalData[] = $listData;
        }
        $coutModel = ProjectdtlsTbl::find()
                ->select(['count(projectdtls_pk) as totalProject'])
                ->leftJoin('usermst_tbl as creater', 'creater.UserMst_Pk = prjd_createdby')
                ->leftJoin('membercompanymst_tbl as userData', 'userData.MCM_MemberRegMst_Fk = creater.UM_MemberRegMst_Fk')
                ->where('userData.MemberCompMst_Pk=:pk', array(':pk' => $companypk))                
                ->andWhere('prjd_isdeleted=:type', array(':type' => 2))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'dataCount' => $provider->getTotalCount(),
            'totalCount' => $coutModel['totalProject'],
            'moduleData' => $finalData,
        );
        return $result;
    }
    public function deleteProject($dataPk) {
        if (!empty($dataPk)) {
            $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk", [':pk' => $dataPk])->one();
            $model->prjd_isdeleted = 1;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
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
    public function addProjectInfo($data){
        $proInfoArray = $data['projectInfoData'];
        if(!empty($data['projectpk'])){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            $model->prjd_shortsummary = $proInfoArray['prjd_summary'];
            $model->prjd_projdesc = $proInfoArray['prjd_prodescript'];
            $model->prjd_projtype = Security::sanitizeInput($proInfoArray['prjd_projtype'], "number");
            $model->prjd_projstage = Security::sanitizeInput($proInfoArray['prjd_projstage'], "number");
            $model->prjd_sectormst_fk = Security::sanitizeInput($proInfoArray['prjd_sectormst_fk'], "number");
            if($proInfoArray['prjd_industrymst_fk']!=''){
            $model->prjd_industrymst_fk = Security::sanitizeInput($proInfoArray['prjd_industrymst_fk'], "number");
            }
            $model->prjd_proptype = Security::sanitizeInput($proInfoArray['prjd_proptype'], "number");
            if($proInfoArray['prjd_natureofprop']!=''){
            $model->prjd_natureofprop = Security::sanitizeInput($proInfoArray['prjd_natureofprop'], "string");
            }
            $model->prjd_updatedon = date('Y-m-d H:i:s');
            $model->prjd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjd_updatedbyipaddr =\common\components\Common::getIpAddress();
            
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'error'=>$model->getErrors(),
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else {
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
            $invmodel = ProjinvinfodtlsTbl::find()->where("piid_projectdtls_fk =:pk",[':pk'=> $projectPk])->one(); 
            if(!empty($invmodel)){
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
            $invmodel->piid_invreqdcurrencymst_fk = Security::sanitizeInput($proInfoArray['prjd_reqcur'], "number");
            $invmodel->piid_invrecdcurrencymst_fk = Security::sanitizeInput($proInfoArray['prjd_reccur'], "number");
            $invmodel->piid_totinvreqd = Security::sanitizeInput($proInfoArray['projreq'],"float");
            $invmodel->piid_totinvrecd = Security::sanitizeInput($proInfoArray['projrec'],"float");
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
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Info Add / Updated successfully!',
                    'returndata' => $model
                );                
            }
            return json_encode($result);
        }
    }
    }
    public function addFinancial($data){
        $proFinancialArray = $data['financialData'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            if(!empty($proFinancialArray['prjd_financindic']))
            {
            $model->prjd_financindic = Security::sanitizeInput($proFinancialArray['prjd_financindic'], "html");
            }
            if(!empty($proFinancialArray['prjd_roi']))
            {
            $model->prjd_roi = Security::sanitizeInput($proFinancialArray['prjd_roi'], "html");
            }
            if(!empty($proFinancialArray['prjd_riskfactors']))
            {
            $model->prjd_riskfactors = Security::sanitizeInput($proFinancialArray['prjd_riskfactors'], "html");
            }
            if(!empty($proFinancialArray['prjd_riskdisclosure']))
            {
            $model->prjd_riskdisclosure = Security::sanitizeInput($proFinancialArray['prjd_riskdisclosure'], "html");
            }
            $model->prjd_updatedon = date('Y-m-d H:i:s');
            $model->prjd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjd_updatedbyipaddr =\common\components\Common::getIpAddress();
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
    public function addProHighlights($data){
        $proHigArray = $data['highlightData'];  
        $proHigAccre = $data['accrdition'];  
        $proHigAcchive = $data['achivement'];  
        $projectPk = Security::decrypt($proHigArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            $model->prjd_benefeat = Security::sanitizeInput($proHigArray['prjd_benefeat'], "html");
            $model->prjd_investorbenefits = Security::sanitizeInput($proHigArray['piid_investorbenefits'], "html");
            $model->prjd_msgtoinvestors = Security::sanitizeInput($proHigArray['piid_invtoinvestors'], "html");
            $model->prjd_updatedon = $date;
            $model->prjd_updatedby = $userPk;
            $model->prjd_updatedbyipaddr = $ip_address;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else {
                ProjaccachievedtlsTbl::deleteAll('paad_projectdtls_fk=:pk and paad_type=2',[':pk'=>$projectPk]);
                ProjaccachievedtlsTbl::deleteAll('paad_projectdtls_fk=:pk and paad_type=1',[':pk'=>$projectPk]);
                if(!empty($proHigAccre)){
                    $proAccreditationArray = ProjaccachievedtlsTblQuery::addAccreditation($proHigAccre,$projectPk);
                }
                if(!empty($proHigAcchive)){
                    $proAchievementArray= ProjaccachievedtlsTblQuery::addAchievement($proHigAcchive,$projectPk);
                }
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project Highlight Add / Updated successfully!',
                    'returndata' => $model,
                    'proAccreditationArray'=>$proAccreditationArray,
                    'proAchievementArray'=>$proAchievementArray
                );                
            }
            return json_encode($result);
        }
    }
    public function addInvestmentGuide($data){
        $invGuideArray = $data['investmentGuideData'];  
        $projectPk = Security::decrypt($invGuideArray['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one();
        if(!empty($model)){
            $model->prjd_projinvproced = Security::sanitizeInput($invGuideArray['prjd_projinvproced'], "string");
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
            }  else {
                if(!empty($invGuideArray['plpa_licensauthoritiesmst_fk'])){
                    ProjlicpermauthTblQuery::addLicPermitAuth($invGuideArray['plpa_licensauthoritiesmst_fk'],$invGuideArray['projlicpermauth_pk'],$projectPk);
                }
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
    public function addProjectCard($data){
//        $randomprojid = rand(1,100000000);
        $proCardArray = $data['projectCardData'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
         $query = ProjectdtlsTbl::find();
         $query->select(['*']);
         $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
         $countid=$provider->getTotalCount();
        
//            $curruser = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
//            $modelref = ProjectdtlsTbl::find()
//                ->where(['prjd_referenceno'=> $proCardArray['prjd_referenceno']])
//                ->asArray()->one();
//            $byuser = UsermstTbl::find()
//            ->select(['UM_MemberRegMst_Fk'])
//            ->where(['UserMst_Pk' => $curruser])
//            ->asArray()->one();
//            if (empty($modelref) && ($byuser->UM_MemberRegMst_Fk != $companypk)) {  }
//            else{return "duplicate"; }
          
        if($proCardArray['projectdtls_pk']==''){
            $countrypk=\yii\db\ActiveRecord::getTokenData('company_country',true);
            $country_model =  CountryMaster::find()
            ->select(['CyM_CountryCode_en'])
            ->where("CountryMst_Pk =:pk",[':pk'=> $countrypk])->one();
            $con = $country_model->CyM_CountryCode_en;
            $count_model = ProjectdtlsTbl::find()
                            ->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk = prjd_submittedby')
                            ->where(['UM_MemberRegMst_Fk'=>$companypk])
                            ->andWhere(['like', 'prjd_projectid', $country_model->CyM_CountryCode_en])
                            ->asArray()->All();
            $count = count($count_model);$count++;
            $count = str_pad($count,3,'0',STR_PAD_LEFT);
            $model = new ProjectdtlsTbl();
            $model->prjd_projectid = 'LYP001-'.$con.'-'.$count;
            $model->prjd_projstatus = Security::sanitizeInput(1, "number");
            $model->prjd_createdon = date('Y-m-d H:i:s');
            $model->prjd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjd_submittedon = date('Y-m-d H:i:s');
            $model->prjd_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjd_createdbyipaddr =\common\components\Common::getIpAddress();
        }else{
            $projectPk = Security::decrypt($proCardArray['projectdtls_pk']);
            $projectPk = Security::sanitizeInput($projectPk, "number");
            $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one(); 
            $model->prjd_updatedon = date('Y-m-d H:i:s');
            // $model->prjd_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->prjd_updatedbyipaddr =\common\components\Common::getIpAddress();
        }
            $model->prjd_referenceno = trim($proCardArray['prjd_referenceno']);
            $model->prjd_projname = trim($proCardArray['prjd_projname']);
            $model->prjd_memberregmst_fk = Security::sanitizeInput($companypk, "number");
            $model->prjd_proptype = 1;
            $model->prjd_shortsummary = 'test';
                    
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
                    'projectpk' => Security::encrypt($model->projectdtls_pk),
                    'projectID' => $model->prjd_projectid,
                    'projectRefno' => $model->prjd_referenceno,
                    'projectName' => $model->prjd_projname,
                );                
            }
            return json_encode($result);
        
    }
    public function addtimeline($data){
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        $model->prjd_dateofinception = Common::convertDateTimeToServerTimezone($data['timeline']['inception'],'Y-m-d');
        $model->prjd_plannedprojstrtdt = Common::convertDateTimeToServerTimezone($data['timeline']['start'],'Y-m-d'); 
        $model->prjd_plannedprojenddt = Common::convertDateTimeToServerTimezone($data['timeline']['end'],'Y-m-d');
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

    public function addlocation($data){
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        $model->prjd_projzone=Security::sanitizeInput($data['projectloc']['proj_zon'], "number");
        $model->prjd_statemst_fk=Security::sanitizeInput($data['projectloc']['proj_gov'], "number");
        $model->prjd_citymst_fk=Security::sanitizeInput($data['projectloc']['proj_cty'], "number");
        $model->prjd_latitude=Security::sanitizeInput($data['projectloc']['proj_add'][0], "float");
        $model->prjd_longitude=Security::sanitizeInput($data['projectloc']['proj_add'][1], "float");
        // $model->prjd_projpresence=Security::sanitizeInput($data['projectloc']['sez'], "number");
        $model->prjd_addressline=Security::sanitizeInput($data['projectloc']['proj_line'], "string");
        $model->prjd_proptype=Security::sanitizeInput($data['projectloc']['type'], "number");
        $model->prjd_natureofprop=Security::sanitizeInput($data['projectloc']['nature'], "number");
        // $model->prjd_memcompmplocationdtls_fk=1;
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
                'msg'=>'Something went wrong'
            );
        }
        return json_encode($result);

    }
    
    public function getdepartuser($data){
        $groupmstpack=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $departmodel= \common\models\DepartmentmstTbl::find()->where("DM_MembCompMst_Fk=:pk",[':pk'=> $companypk])->select('DM_Name,DepartmentMst_Pk')->distinct()->all();
        if(!empty($data['projectpk']))
        {
//            $projectPk = Security::decrypt($proCardArray['projectpk']);
            $projectPk = Security::sanitizeInput($data['projectpk'], "number");
            $model = ProjectdtlsTbl::find()->where("projectdtls_pk =:pk",[':pk'=> $projectPk])->one(); 
            
        }
      
        foreach ($departmodel as $key => $value) {
          $groupuser=[];
           $usemstmodel= \common\models\UsermstTbl::find()->where("um_departmentmst_fk=:pk",[':pk'=>$value->DepartmentMst_Pk])->select('UM_EmpName,UserMst_Pk')->all();
           if(!empty($usemstmodel))
           {
          foreach ($usemstmodel as $keyval => $valueget) {
               $groupuser[$keyval]['label']= $valueget->UM_EmpName;
               $groupuser[$keyval]['value']= intval($valueget->UserMst_Pk);
           }
            if(!empty($usemstmodel))
            {
              $groupmst['name']=$value->DM_Name;
              $groupmst['departid']=$value->DepartmentMst_Pk;
              $groupmst['items']=$groupuser;
            }
            $groupmstpack['userdata'][]=$groupmst;  
           }
        }
        if(!empty($model)){
            $groupmstpack['selectuser']=   explode(',', $model->prjd_contactinfo);
        }
       
        return json_encode($groupmstpack);
    }

    public function addprojectwebinar($data){
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk'=>  Security::decrypt($data['projectpk'])))
                ->one();
        
        if($data['projectwebinar']['linkedin']!=''){
            $myObj->linkedin = $data['projectwebinar']['linkedin'];
        }
        if($data['projectwebinar']['facebook']!=''){
            $myObj->facebook = $data['projectwebinar']['facebook'];
        }
        if($data['projectwebinar']['twitter']!=''){
            $myObj->twitter = $data['projectwebinar']['twitter'];
        }
        if($data['projectwebinar']['instagram']!=''){
            $myObj->instagram = $data['projectwebinar']['instagram'];
        }
        
        
        $myJSON = json_encode($myObj);

        $model->prjd_socialmedia=$myJSON;
        $model->prjd_website=$data['projectwebinar']['website'];
        $model->prjd_projecttags=$data['projectwebinar']['seotag'];

        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Webinar added successfully!',
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
    public function submitproject($data){

        if(!empty($data['projectpk'])){
        $pk = Security::decrypt($data['projectpk']);
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk'=>$pk))
                ->one();
        $proj_valid=1;
        $tech_valid=1;
        $mark_valid=1;
        $inve_valid=1;
        $fina_valid=1;
        ///please dont delete or edit below towards project submiton validation checking required fields in db
        $proj_arr = array("prjd_shortsummary", "prjd_projstatus", "prjd_projstage","prjd_sectormst_fk","prjd_projpresloc","prjd_statemst_fk","prjd_citymst_fk","prjd_latitude","prjd_longitude","prjd_projpresence","prjd_addressline","prjd_memcompmplocationdtls_fk");
        // projaccreditation_tbl,projachievement_tbl "prjd_proptype",
        $tech_arr = array("pt_techinfo","pt_techapprovals","pt_employoppor","pt_tourism","pt_supplychain","pt_environmental");
        // projtechnical_tbl,
        $mark_arr = array("prjd_projecttags");
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
            }
            

            //project info =======================================
            // $model = ProjinvinfodtlsTbl::find()
            //         ->where('piid_projectdtls_fk=:fk',array(':fk'=>$pk))
            //         ->one();
            // if(!($model)){
            //     $proj_valid=0;echo("bjbjjb");
            // }

            //=======project technical =======================
            $model = ProjtechnicalTbl::find()
                    ->where('pt_projectdtls_fk=:fk',array(':fk'=>$pk))
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
            $model = ProjfaqdtlsTbl::find()
                    ->where('pfd_projectdtls_fk=:fk',array(':fk'=>$pk))
                    ->one();
            if(!$model){
                $mark_valid=0;
            }
            //========investor==========
            $model = ProjinvinfodtlsTbl::find()
                ->where('piid_projectdtls_fk=:fk',array(':fk'=>$pk))
                ->one();
                if(!$model){
                    $inve_valid=0;
                }
                else{
                    if(empty($model->piid_targetinvestors)){
                        $inve_valid=0; 
                    }
                }
        
            $model = ProjinvmappingTbl::find()
            ->where('pim_projectdtls_fk=:fk',array(':fk'=>$pk))
            ->one();
            if(!$model){
                $inve_valid=0;
            }
         
        }
        else{
            $proj_valid=0;
            $tech_valid=0;
            $mark_valid=0;
            $inve_valid=0;
            $fina_valid=0;
        }
        $result=array(
            'proj' => $proj_valid,
            'tech' => $tech_valid,
            'mark'=>$mark_valid,
            'inve' => $inve_valid,
        );
        return json_encode($result);
        
        
    }
    public function finalsubmit($data){
        if(!empty($data['projectpk'])){
        $pk = Security::decrypt($data['projectpk']);
        $model = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk',array(':pk'=>$pk))
                ->one();
                if($data['projstat']==3 || $data['projstat']==4){
                $model->prjt_projstatus=5;
                }else{
                $model->prjt_projstatus=2;
                }
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project submitted for validation!',
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
        }
    
    
    public function getcompacred($data) {
        
        $accred=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $accredmodel = \common\models\MemcompacomplishdtlsTbl::find()
                ->select(['mcad_title','mcad_issuedon','mcad_issuedby','memcompacomplishdtls_pk','mcad_accachieveno'])
                ->where('mcad_membercompmst_fk=:memcomppk and mcad_type=1',[':memcomppk'=> $companypk])
                ->orderBy('memcompacomplishdtls_pk desc')
                ->asArray()->all();
              

        if(!empty($accredmodel))
        {
        foreach ($accredmodel as $key => $value) {
            $accred[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $accred[$key]['certificateName']=$value['mcad_title'];
            $accred[$key]['certificatenum']=$value['mcad_accachieveno'];
            $accred[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $accred[$key]['governingBody']=!empty($value['mcad_issuedby'])?$value['mcad_issuedby']:"Nil";
            $accred[$key]['isSelected']=FALSE;
        }
        }
        
         if (empty($accred)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$accred];
        }
    
    }
    public function getcompacerti($data) {
        
        $accred=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $accredmodel = \common\models\MemcompacomplishdtlsTbl::find()
                ->select(['mcad_title','mcad_issuedon','mcad_issuedby','memcompacomplishdtls_pk','mcad_accachieveno','mcad_desc','mcad_websiteurl','mcad_uploadpath','mcad_relateddocs'])
                ->where('mcad_membercompmst_fk=:memcomppk and mcad_type=4',[':memcomppk'=> $companypk])
                ->orderBy('memcompacomplishdtls_pk desc')
                ->asArray()->all();
              

        if(!empty($accredmodel))
        {
        foreach ($accredmodel as $key => $value) {
            if($value['mcad_relateddocs']==null){$reldocs=null;}else{$reldocs[]=$value['mcad_relateddocs'];}
            if($value['mcad_uploadpath']==null){$uppath=null;}else{$uppath[]=$value['mcad_uploadpath'];}
            $accred[$key]['isSelected']=FALSE;
            $accred[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $accred[$key]['certificateName']=$value['mcad_title'];
            $accred[$key]['certificatenum']=$value['mcad_accachieveno'];
            $accred[$key]['certificatedesc']=$value['mcad_desc'];
            $accred[$key]['certurl']=$value['mcad_websiteurl'];
            $accred[$key]['uploadfile']=$uppath;
            $accred[$key]['relatedfile']=$reldocs;
            $accred[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $accred[$key]['governingBody']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
        }
        }
        
         if (empty($accred)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$accred];
        }
    
    }
    public function getcompaawar($data) {
        
        $accred=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $accredmodel = \common\models\MemcompacomplishdtlsTbl::find()
                ->select(['mcad_title','mcad_issuedon','mcad_issuedby','memcompacomplishdtls_pk','mcad_accachieveno','mcad_desc','mcad_websiteurl','mcad_uploadpath','mcad_relateddocs'])
                ->where('mcad_membercompmst_fk=:memcomppk and mcad_type=2',[':memcomppk'=> $companypk])
                ->orderBy('memcompacomplishdtls_pk desc')
                ->asArray()->all();
              

        if(!empty($accredmodel))
        {
        foreach ($accredmodel as $key => $value) {
            if($value['mcad_relateddocs']==null){$reldocs=null;}else{$reldocs[]=$value['mcad_relateddocs'];}
            if($value['mcad_uploadpath']==null){$uppath=null;}else{$uppath[]=$value['mcad_uploadpath'];}
            $accred[$key]['isSelected']=FALSE;
            $accred[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $accred[$key]['awardName']=$value['mcad_title'];
            $accred[$key]['awardnum']=$value['mcad_accachieveno'];
            $accred[$key]['awarddesc']=$value['mcad_desc'];
            $accred[$key]['awarurl']=$value['mcad_websiteurl'];
            $accred[$key]['uploadfile']=$uppath;
            $accred[$key]['relatedfile']=$reldocs;
            $accred[$key]['certifiedOn']=!empty($value['mcad_issuedon'])?$value['mcad_issuedon']:'';
            $accred[$key]['governingBody']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
        }
        }
        
         if (empty($accred)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$accred];
        }
    
    }
    public function addaccretation($data)
    {
        
        $dataval=$data['accreationsinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $accretionPk=Security::sanitizeInput($dataval['accreditionPk'],'number');
        if($accretionPk == NULL){
            $accredmodel = new \common\models\MemcompacomplishdtlsTbl();
            $accredmodel->mcad_createdon = date('Y-m-d H:i:s');
            $accredmodel->mcad_createdby = $UserPk;
            $accredmodel->mcad_createdbyipaddr = $ipAddress;
        }  else {
            $accredmodel= \common\models\MemcompacomplishdtlsTbl::find()->where('memcompacomplishdtls_pk=:id',array(':id' => $accretionPk))->one();
            $accredmodel->mcad_updatedon = date('Y-m-d H:i:s');
            $accredmodel->mcad_updatedby = $UserPk;
            $accredmodel->mcad_updatedbyipaddr = $ipAddress;
        }
        $accredmodel->mcad_membercompmst_fk=$companypk;
        $accredmodel->mcad_title=Security::sanitizeInput($dataval['acceriationname'],'string_spl_char');
        $accredmodel->mcad_accachieveno=Security::sanitizeInput($dataval['certificatenum'],'string_spl_char');
        $accredmodel->mcad_issuedby=Security::sanitizeInput($dataval['governingbody'],'string_spl_char');
        if(!empty($dataval['createon'])){
            $accredmodel->mcad_issuedon=date('Y-m-d',strtotime($dataval['createon']));
        }else{
            $accredmodel->mcad_issuedon="";
        }
        $accredmodel->mcad_priority = 1;
        $accredmodel->mcad_acccertifi=1;
        $accredmodel->mcad_type=1;
        if($accredmodel->save())
        {
            $data1['accplishid']=$accredmodel->memcompacomplishdtls_pk;
            $data1['certificatenum']=$accredmodel->mcad_accachieveno;
            $data1['certificateName']=$accredmodel->mcad_title;
            $data1['certifiedOn']=!empty($accredmodel->mcad_issuedon)?$accredmodel->mcad_issuedon:"";
            $data1['governingBody']=!empty($accredmodel->mcad_issuedby)?$accredmodel->mcad_issuedby:"Nil";
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($accredmodel->getErrors());
        }
        return $result;
    }
    public function addcertificates($data)
    {
        $dataval=$data['certificatesinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $certificatePk=Security::sanitizeInput($dataval['certificatePk'],'number');
        if($certificatePk == NULL){
            $accredmodel = new \common\models\MemcompacomplishdtlsTbl();
            $accredmodel->mcad_createdon = date('Y-m-d H:i:s');
            $accredmodel->mcad_createdby = $UserPk;
            $accredmodel->mcad_createdbyipaddr = $ipAddress;
        }  else {
            $accredmodel= \common\models\MemcompacomplishdtlsTbl::find()->where('memcompacomplishdtls_pk=:id',array(':id' => $certificatePk))->one();
            $accredmodel->mcad_updatedon = date('Y-m-d H:i:s');
            $accredmodel->mcad_updatedby = $UserPk;
            $accredmodel->mcad_updatedbyipaddr = $ipAddress;
        }
        $accredmodel->mcad_membercompmst_fk=$companypk;
        $accredmodel->mcad_title=Security::sanitizeInput($dataval['certificateTitle'],'string_spl_char');
        $accredmodel->mcad_issuedby=Security::sanitizeInput($dataval['certificateIssuedBy'],'string_spl_char');
        $accredmodel->mcad_desc=Security::sanitizeInput($dataval['certificateDesc'],'string_spl_char');
        if($dataval['acmpUpload'][0]==NULL){
        $acmupload=$dataval['acmpUpload'][1];}else{$acmupload=$dataval['acmpUpload'][0];}
        $accredmodel->mcad_websiteurl=$dataval['certificateURL'];
        $accredmodel->mcad_uploadpath=$acmupload;
        $accredmodel->mcad_relateddocs=$dataval['newsupload'][0];
        if(!empty($dataval['certificateIssuedOn'])){
            $accredmodel->mcad_issuedon=date('Y-m-d',strtotime($dataval['certificateIssuedOn']));
        }else{
            $accredmodel->mcad_issuedon="";
        }
        $accredmodel->mcad_priority = 1;
        $accredmodel->mcad_acccertifi=1;
        $accredmodel->mcad_type=4;
        if($accredmodel->save())
        {
            $data1['accplishid']=$accredmodel->memcompacomplishdtls_pk;
            $data1['certificatedesc']=$accredmodel->mcad_desc;
            $data1['certificateName']=$accredmodel->mcad_title;
            $data1['certurl']=$accredmodel->mcad_websiteurl;
            $data1['uploadfile'][]=$accredmodel->mcad_uploadpath;
            $data1['relatedfile'][]=$accredmodel->mcad_relateddocs;
            $data1['certifiedOn']=!empty($accredmodel->mcad_issuedon)?$accredmodel->mcad_issuedon:"";
            $data1['governingBody']=!empty($accredmodel->mcad_issuedby)?$accredmodel->mcad_issuedby:"Nil";
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($accredmodel->getErrors());
        }
        return $result;
    }
    public function addawards($data)
    {
        $dataval=$data['awardsinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $awardPk=Security::sanitizeInput($dataval['awardPk'],'number');
        if($awardPk == NULL){
            $accredmodel = new \common\models\MemcompacomplishdtlsTbl();
            $accredmodel->mcad_createdon = date('Y-m-d H:i:s');
            $accredmodel->mcad_createdby = $UserPk;
            $accredmodel->mcad_createdbyipaddr = $ipAddress;
        }  else {
            $accredmodel= \common\models\MemcompacomplishdtlsTbl::find()->where('memcompacomplishdtls_pk=:id',array(':id' => $awardPk))->one();
            $accredmodel->mcad_updatedon = date('Y-m-d H:i:s');
            $accredmodel->mcad_updatedby = $UserPk;
            $accredmodel->mcad_updatedbyipaddr = $ipAddress;
        }
        $accredmodel->mcad_membercompmst_fk=$companypk;
        $accredmodel->mcad_title=Security::sanitizeInput($dataval['awardTitle'],'string_spl_char');
        $accredmodel->mcad_issuedby=Security::sanitizeInput($dataval['awardIssuedBy'],'string_spl_char');
        $accredmodel->mcad_desc=Security::sanitizeInput($dataval['awardDesc'],'string_spl_char');
        $accredmodel->mcad_websiteurl=$dataval['awardURL'];
        $accredmodel->mcad_uploadpath=$dataval['acmpUpload'][0];
        $accredmodel->mcad_relateddocs=$dataval['newsupload'][0];
        if(!empty($dataval['awardIssuedOn'])){
            $accredmodel->mcad_issuedon=date('Y-m-d',strtotime($dataval['awardIssuedOn']));
        }else{
            $accredmodel->mcad_issuedon="";
        }
        $accredmodel->mcad_priority = 1;
        $accredmodel->mcad_acccertifi=1;
        $accredmodel->mcad_type=2;
        if($accredmodel->save())
        {
            $data1['accplishid']=$accredmodel->memcompacomplishdtls_pk;
            $data1['awarddesc']=$accredmodel->mcad_desc;
            $data1['awardName']=$accredmodel->mcad_title;
            $data1['awarurl']=$accredmodel->mcad_websiteurl;
            $data1['uploadfile']=$accredmodel->mcad_uploadpath;
            $data1['relatedfile']=$accredmodel->mcad_relateddocs;
            $data1['certifiedOn']=!empty($accredmodel->mcad_issuedon)?$accredmodel->mcad_issuedon:"";
            $data1['governingBody']=!empty($accredmodel->mcad_issuedby)?$accredmodel->mcad_issuedby:"Nil";
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($accredmodel->getErrors());
        }
        return $result;
    }
    
    public function addachivements($data)
    {
        
        $dataval=$data['achivementsinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $achievemntPk=Security::sanitizeInput($dataval['achievemntPk'],'number');
        if($achievemntPk == NULL){
            $accredmodel = new \common\models\MemcompacomplishdtlsTbl();
            $accredmodel->mcad_createdon = date('Y-m-d H:i:s');
            $accredmodel->mcad_createdby = $UserPk;
            $accredmodel->mcad_createdbyipaddr = $ipAddress;
        } else {
            $accredmodel= \common\models\MemcompacomplishdtlsTbl::find()->where('memcompacomplishdtls_pk=:id',array(':id' => $achievemntPk))->one();
            $accredmodel->mcad_updatedon = date('Y-m-d H:i:s');
            $accredmodel->mcad_updatedby = $UserPk;
            $accredmodel->mcad_updatedbyipaddr = $ipAddress;
        }
        $accredmodel->mcad_membercompmst_fk=$companypk;
        $accredmodel->mcad_acccertifi=1;
        if(!empty($dataval['achievementdoc']))
        {
          $uploadpks= implode(',', $dataval['achievementdoc']);
          $uploadpks= str_replace(',', '', $uploadpks);
          $accredmodel->mcad_uploadpath=$uploadpks;
        }else{
           $accredmodel->mcad_uploadpath=''; 
        }
        $accredmodel->mcad_title=Security::sanitizeInput($dataval['achievementname'],'string_spl_char');
        $accredmodel->mcad_desc=Security::sanitizeInput($dataval['achivedescp'],'string_spl_char');
        $accredmodel->mcad_achvyear=!empty($dataval['acievementdate'])?date('Y', strtotime($dataval['acievementdate'])):"";
        $accredmodel->mcad_priority = 1;
        $accredmodel->mcad_type=3;
        if($accredmodel->save())
        {
            $data1['title']=$accredmodel->mcad_title;
            $data1['achievementdoc']=$accredmodel->mcad_uploadpath;
            $data1['accplishid']=$accredmodel->memcompacomplishdtls_pk;
            $data1['description']=!empty($accredmodel->mcad_desc)?$accredmodel->mcad_desc:"Nil";
            $data1['year']= !empty($accredmodel->mcad_achvyear)?$accredmodel->mcad_achvyear:"Nil";
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($accredmodel->getErrors());
        }
        return $result;
    }

    public function getcompachive($data) {
        
        $achive=[];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $achivedmodel = \common\models\MemcompacomplishdtlsTbl::find()
                ->select('mcad_title,mcad_achvyear,mcad_desc,memcompacomplishdtls_pk')
                ->where('mcad_membercompmst_fk=:memcomppk and mcad_type=3',[':memcomppk'=> $companypk])
                ->orderBy('memcompacomplishdtls_pk desc')
                ->asArray()->all();
              
        if(!empty($achivedmodel))
        {
        foreach ($achivedmodel as $key => $value) {
            $achive[$key]['title']=$value['mcad_title'];
            $achive[$key]['accplishid']=$value['memcompacomplishdtls_pk'];
            $achive[$key]['description']=!empty($value['mcad_desc'])?$value['mcad_desc']:"Nil";
            $achive[$key]['year']= !empty($value['mcad_achvyear'])?date('Y', strtotime($value['mcad_achvyear'])):"Nil";
            $achive[$key]['isSelected']=FALSE;
        }
        }
        
         if (empty($achive)) {
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return [$achive];
        }
    
    }
    public function addinvestors($data)
    {
        $dataval=$data['investorinfo'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $projectPk = Security::decrypt($dataval['projectdtls_pk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        
        $model = ProjinvmappingTbl::find()->where('pim_emailid=:email',array(':email'=>$dataval['pim_emailid']))->one();
        if(empty($model)){        
        $investormodel = new ProjinvmappingTbl();
        $investormodel->pim_memberregmst_fk=$companypk;
        $investormodel->pim_projectdtls_fk=$projectPk;
        $investormodel->pim_name=Security::sanitizeInput($dataval['pim_name'],'string');
        $investormodel->pim_status=Security::sanitizeInput(0,'number');
        $investormodel->pim_emailid=$dataval['pim_emailid'];
        $investormodel->pim_createdon = date('Y-m-d H:i:s');
        $investormodel->pim_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $investormodel->pim_createdbyipaddr = \common\components\Common::getIpAddress();
        if($investormodel->save())
        {
            $data1['name']=$investormodel->pim_name;
            $data1['investorid']=$investormodel->projinvmapping_pk;
            $data1['emailid']=$investormodel->pim_emailid;
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
            $data1['name']=$investormodel->pim_name;
            $data1['investorid']=$investormodel->projinvmapping_pk;
            $data1['emailid']=$investormodel->pim_emailid;
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
        $investordmodel = ProjinvmappingTbl::find()
                ->select('pim_name,projinvmapping_pk,pim_emailid')
                ->where('pim_memberregmst_fk=:memcomppk',[':memcomppk'=> $companypk])
                ->andWhere("projinvmapping_pk not in ($conditionval)")
                ->orderBy('projinvmapping_pk desc')
                ->asArray()->all();
        if(!empty($investordmodel))
        {
        foreach ($investordmodel as $key => $value) {
            $investor[$key]['name']=$value['pim_name'];
            $investor[$key]['investorid']=$value['projinvmapping_pk'];
            $investor[$key]['emailid']=$value['pim_emailid'];
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
    public function addprojectwebpresence($data){
        return("adsasdasd");
        $dataval=$data['projectmedia'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $socialmodel = ProjectdtlsTbl::find()->where('projectdtls_pk=:pk',array(':pk'=>$projectPk))->one();
        $socialmedialarr=[];
        foreach ($dataval['SocMedArray'] as $key => $value) {
            if($value['SMedia'] != null && $value['SMediaUrl'] != null){
                $socialmedialarr[] = $value;             
            }
        }
        if(!empty($dataval['website'])){
        $socialmodel->prjd_website=$dataval['website'];
        }
        if(!empty($socialmedialarr)){
        $socialmodel->prjd_socialmedia=json_encode($socialmedialarr);
        }
        if($socialmodel->save())
        {
            $data1['website']=$socialmodel->prjd_website;
            $data1['socialjson']=$socialmodel->prjd_socialmedia;
             $result=array(
                'status' => 200,
                'data'=>$data1,
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
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project office location mapped successfully!',
        );
        if($model){
            $model->prjd_memcompmplocationdtls_fk = $data['locationpk'];
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

    public function getviewoffloc($data){
        $projectPk = $data['projectpk'];
        $model = ProjectdtlsTbl::find()
                ->select(['*'])
                ->leftJoin('memcompmplocationdtls_tbl','prjd_memcompmplocationdtls_fk=memcompmplocationdtls_pk')
                ->andWhere('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->asArray()->one();
        return($model);
    }
    public function getprojectbyid($data){
        $projectPk = $data['projectpk'];
        $model = ProjectdtlsTbl::find()
                ->select(['*'])
                ->andWhere('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->asArray()->one();
        return($model);
    }
    
    public function invprojstatus($data){
        $projectPk = $data['projectpk'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $query = ProjectdtlsTbl::find()
        ->select(["prjd_projectid,prjd_referenceno,prjd_projtype ,prjd_projstage,prjd_projname,
substring_index(group_concat(distinct prjsl_status order by projshortlist_pk),',',1) as 'prjsl_status',
projshortlist_pk,presd_status,presd_eoiacknow,projdilsubdtls_pk,
concat(um.um_firstname,' ',um.um_lastname) as 'Shortlistedby',prjsl_shortlistedcancon,projeoisubdtls_pk,projectdtls_pk,
concat(um1.um_firstname,' ',um1.um_lastname) as 'EOISubmittedby',presd_eoisubmittedon,
concat(um2.um_firstname,' ',um2.um_lastname) as 'DiligenceSubmittedby' ,prdsd_submittedon,pind.pind_status invstatus"])
        ->leftJoin('projshortlist_tbl psl',"psl.prjsl_projectdtls_fk=projectdtls_tbl.projectdtls_pk  and prjsl_memberregmst_fk=$companypk")
        ->leftJoin('usermst_tbl um','um.UserMst_Pk=psl.prjsl_shortlistedcancby')       
        ->leftJoin('projeoisubdtls_tbl pes','pes.presd_projshortlist_fk=psl.projshortlist_pk')
        ->leftJoin('usermst_tbl um1','um1.UserMst_Pk=pes.presd_eoisubmittedby')
        ->leftJoin('projdilsubdtls_tbl pds','pds.prdsd_projeoisubdtls_fk=pes.projeoisubdtls_pk')
        ->leftJoin('usermst_tbl um2','um2.UserMst_Pk=pds.prdsd_submittedby')
        ->leftJoin('projinvestmentdtls_tbl pind',"pind.pind_projectdtls_fk=projectdtls_tbl.projectdtls_pk and pind_memcompmst_fk=$companypk")
        ->where('projectdtls_pk=:id',array(':id' =>  $projectPk))
        ->asArray();
        $provider = new ActiveDataProvider([ 'query' => $query]);
        if($query){
            return [
            'items' => $provider->getModels(),
        ];
        } else {
            throw new NotFoundHttpException("Object not found: $projectPk");
        }
    }
    public function shortlistindex($data)
    {   $query = ProjshortlistTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key!="MCM_CompanyName" && $key!="mcm_referenceno")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('MCM_CompanyName', true), ':value',array(':value' =>  $val)],['LIKE','mcm_referenceno', ':value',array(':value' =>  $val)]]);
                    }
                }
            }
        }
        $query->select(['*']);     
        $query->leftJoin('membercompanymst_tbl','projshortlist_tbl.prjsl_memberregmst_fk = membercompanymst_tbl.MCM_MemberRegMst_Fk');
        $query->leftJoin('usermst_tbl','projshortlist_tbl.prjsl_shortlistedcancby = usermst_tbl.UserMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk = memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->orderBy('prjsl_shortlistedcancon DESC');
        $query->andWhere('prjsl_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")));
        $query->andWhere('prjsl_status=:status',array(':status' =>  Security::sanitizeInput(1,"number")));
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }
    
    public function declareinvestmentindex($data)
    {   $query = ProjinvestmentdtlsTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key!="MCM_CompanyName" && $key!="mcm_referenceno")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('MCM_CompanyName', true), ':value',array(':value' =>  $val)],['LIKE','mcm_referenceno', ':value',array(':value' =>  $val)]]);
                    }
                }
            }
        }
        $query->select(['*','um1.um_firstname as subfname','um1.um_lastname as sublname','um2.um_firstname as ackfname','um2.um_lastname as acklname']);     
        $query->leftJoin('projectdtls_tbl','pind_projectdtls_fk = projectdtls_pk');
        $query->leftJoin('membercompanymst_tbl','pind_memcompmst_fk = MemberCompMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk');
        $query->leftJoin('usermst_tbl um1','pind_createdby = um1.UserMst_Pk');
        $query->leftJoin('usermst_tbl um2','pind_appdeclby = um2.UserMst_Pk');
        $query->orderBy('pind_createdon DESC');
        $query->andWhere('pind_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(2642,"number")));
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }
    public function eoiindex($data)
    {   $query = ProjeoisubdtlsTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key!="MCM_CompanyName" && $key!="mcm_referenceno")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('MCM_CompanyName', true), ':value',array(':value' =>  $val)],['LIKE','mcm_referenceno', ':value',array(':value' =>  $val)]]);
                    }
                }
            }
        }
        $query->select(['*',"shrtlist.UM_EmpName as shrtlistname","eoisub.UM_EmpName as eoisubname",
            "eoival.UM_EmpName as projownername","dilsub.UM_EmpName as dilinvsubname",
            "dilresub.UM_EmpName as dilinvresubname","dilapdc.UM_EmpName as dilapdcprojownername",]);     
        $query->leftJoin('projshortlist_tbl','projshortlist_tbl.projshortlist_pk = projeoisubdtls_tbl.presd_projshortlist_fk');
        $query->leftJoin('projdilsubdtls_tbl','projdilsubdtls_tbl.prdsd_projeoisubdtls_fk = projeoisubdtls_tbl.projeoisubdtls_pk');
        $query->leftJoin('membercompanymst_tbl','projshortlist_tbl.prjsl_memberregmst_fk = membercompanymst_tbl.MCM_MemberRegMst_Fk');
        $query->leftJoin('usermst_tbl shrtlist','projshortlist_tbl.prjsl_shortlistedcancby=shrtlist.UserMst_Pk');
        $query->leftJoin('usermst_tbl eoisub','projeoisubdtls_tbl.presd_eoisubmittedby = eoisub.UserMst_Pk');
        $query->leftJoin('usermst_tbl eoival','projeoisubdtls_tbl.presd_appdeclby = eoival.UserMst_Pk');
        $query->leftJoin('usermst_tbl dilsub','projdilsubdtls_tbl.prdsd_submittedby = dilsub.UserMst_Pk');
        $query->leftJoin('usermst_tbl dilresub','projdilsubdtls_tbl.prdsd_resubmittedby = dilresub.UserMst_Pk');
        $query->leftJoin('usermst_tbl dilapdc','projdilsubdtls_tbl.prdsd_appdeclby = dilapdc.UserMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk = memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->orderBy('presd_eoisubmittedon DESC');
        $query->andWhere('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")));
        $query->andWhere('presd_status<>:status',array(':status' =>  Security::sanitizeInput(5,"number")));
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }
    public function counteoi($data)
    {
        $yettovalid = ProjeoisubdtlsTbl::find()
        ->select(['*'])
        ->where("presd_status IN (:stat)",array(':stat' =>  '1,4'))
        ->andWhere('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")))
        ->count();
        $approvedcount = ProjeoisubdtlsTbl::find()
        ->select(['*'])   
        ->where('presd_status=:stat',array(':stat' =>  2))
        ->andWhere('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")))
        ->count();
        $declinedcount = ProjeoisubdtlsTbl::find()
        ->select(['*'])   
        ->where('presd_status=:stat',array(':stat' =>  3))
        ->andWhere('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")))
        ->count();
        $total = ProjeoisubdtlsTbl::find()
        ->select(['*'])   
        ->where('presd_status<>:status',array(':status' =>  5))
        ->andWhere('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput(391,"number")))
        ->count();
        $data1['total']=$total;
        $data1['yettovalid']=$yettovalid;
        $data1['approvedcount']=$approvedcount;
        $data1['declinedcount']=$declinedcount;
        
        return $data1;
    }
    public function mapteam($data){
        $projectPk = $data['projectpk'];
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project team mapped successfully!',
        );
        if($model){
            $model->prjd_projteam = json_encode($data['mapteam']);
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
    public function deleteteam($data){
        $projectPk = $data['projectpk'];
        $deletePk = $data['deleteteam'];
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
       
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project team member unmapped successfully!',
        );

        if($model){      
            $arr =  $model->prjd_projteam ;
            $arr = Json_decode($arr);            
            $arr1 = [];
            foreach($arr as $value){
                if($value!=$deletePk){
                    array_push($arr1,$value);
                }
            }
            $model->prjd_projteam = Json_encode($arr1);
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
    public function deletecontact($data){
        $projectPk = $data['projectpk'];
        $deletePk = $data['deletecontact'];
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
       
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project contact unmapped successfully!',
        );

        if($model){      
            $arr =  $model->prjd_contactinfo ;
            $arr = Json_decode($arr);            
            $arr1 = [];
            foreach($arr as $value){
                if($value!=$deletePk){
                    array_push($arr1,$value);
                }
            }
            $model->prjd_contactinfo = Json_encode($arr1);
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
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project contact mapped successfully!',
        );
        if($model){
            $model->prjd_contactinfo = json_encode($data['mapcontact']);
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
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjd_projteam,
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
    public function getselectedcontact($data){
        $projectPk = $data['projectpk'];
        $model = ProjectdtlsTbl::find()
                ->where('projectdtls_pk=:pk',array(':pk' =>  \common\components\Security::decrypt($projectPk)))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->prjd_contactinfo,
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
    public function validateproject($data) {
        $dataval=$data['projectdtls'];
        $projectPk = Security::sanitizeInput($dataval['projectpk'], "number");
        $projectstatus = Security::sanitizeInput($dataval['select'], "number");
        $comments = $dataval['comments'];
        $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
        $model->prjt_projstatus=$projectstatus;
        $model->prjt_appldeccomments=$comments;
        $model->prjt_apprdeclon=date('Y-m-d H:i:s');
        $model->prjt_apprdeclby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->prjt_apprdeclbyipaddr=\common\components\Common::getIpAddress();
        if($model->save())
        {
            if($model->prjt_projstatus==3)
            {
                ProjecttmpTblQuery::approvedmovehstry($model->projecttmp_pk);
            }else if($model->prjt_projstatus==4)
            {
                ProjecttmpTblQuery::declinedmovehstry($model->projecttmp_pk);
            }
        }
        
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model,
        );
        if(!$model){
                $result=array(
                    'status' => 101,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Empty!'
                );
        
        }
        return json_encode($result);
        
        
    }
    public function registerlicense($data) {
        $dataval=$data['licdtls'];
        $licPk = Security::sanitizeInput($dataval['liclist'], "number");
        $projpk = Security::sanitizeInput($dataval['projlist'], "number");
        $comments = $dataval['comment'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $modelref = LicinvappliedTbl::find()
            ->where("lia_applicationno =:pk",[':pk'=> $dataval['apprefno']])
            ->one();
    if(empty($modelref)){
        $model = LicinvappliedTbl::find()
                ->where("lia_projectdtls_fk =:pk",[':pk'=> $projpk])
                ->andWhere('lia_licensinginfo_fk=:id',array(':id' => $licPk))
                ->andWhere('lia_memregmst_fk=:cid',array(':cid' => $companypk))
                ->one();
        if(empty($model)){
        $model = new LicinvappliedTbl(); 
        $model->lia_createdon=date('Y-m-d H:i:s');
        $model->lia_createdby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->lia_createdbyipaddr=\common\components\Common::getIpAddress();
        }else{
        $model->lia_updatedon=date('Y-m-d H:i:s');
        $model->lia_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->lia_updatedbyipaddr=\common\components\Common::getIpAddress();
        }
        $model->lia_projectdtls_fk=$projpk;
        $model->lia_licensinginfo_fk=$licPk;
        $model->lia_status= 4;
        $model->lia_comments=$comments;
        $model->lia_memregmst_fk=$companypk;
        $model->lia_applicationno=$dataval['apprefno'];
        $model->lia_applsubmon=Security::sanitizeInput(date('Y-m-d',  strtotime($dataval['addsubdate'])),"string");
        if($model->save())
        {
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model,
        );
        }else{
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>$model->getErrors(),
            );
        }
    }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'duplicate',
                'flag'=>'D',
            );
    }
        return json_encode($result);
        
        
    }
    public function duplic($data) {
        $dataval=$data['licdtls'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        if(!empty($dataval['projlist'] && $dataval['liclist'])){
        $model = LicinvappliedTbl::find()
                ->where("lia_projectdtls_fk =:pk",[':pk'=> $dataval['projlist']])
                ->andWhere('lia_licensinginfo_fk=:id',array(':id' => $dataval['liclist']))
                ->andWhere('lia_memregmst_fk=:cid',array(':cid' => $companypk))
                ->andWhere('lia_status<>:stage',array(':stage' =>  3))
                ->one();
            if(!empty($model)){
        $result=array(
                'status' => 200,
                'statusmsg' => 'duplicate',
                'flag'=>'D',
            );
            }else{
        $result=array(
                'status' => 200,
                'statusmsg' => 'notduplicate',
                'flag'=>'N',
            );
            }
        }
        return json_encode($result);
    }
    public function audittrial($data) {
    $dataval=$data['licdtls'];
        $query = \api\modules\lic\models\LicapprhstyTbl::find();
        $query->select(['licapprhsty_tbl.*',
            'crby.um_firstname as invfname','crby.um_lastname as invlname',
            'reby.um_firstname as licauthfname','reby.um_lastname as licauthlname']);
        $query->leftJoin('usermst_tbl crby','licapprhsty_tbl.lah_submittedby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl reby','licapprhsty_tbl.lah_apprdeclby=reby.UserMst_Pk');
        $query->where('lah_licinvapplied_fk=:id',array(':id' =>  $dataval));
        $query->orderBy('licapprhsty_pk ASC');
        $query->asArray();
        $provider = new ActiveDataProvider([ 'query' => $query]);
        if(!empty($query)){
        return [
            'items' => $provider->getModels()
        ];
        }
    }
    public function decinvaudittrial($data) {
    $dataval=$data['licdtls'];
        $query = ProjinvestmenthstyTbl::find();
        $query->select(['projinvestmenthsty_tbl.*',
            'crby.um_firstname as subfname','crby.um_lastname as sublname',
            'reby.um_firstname as decinvfname','reby.um_lastname as decinvlname']);
        $query->leftJoin('usermst_tbl crby','pinh_createdby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl reby','pinh_appdeclby=reby.UserMst_Pk');
        $query->where('pinh_projinvestmentdtls_fk=:id',array(':id' =>  $dataval));
        $query->orderBy('projinvestmenthsty_pk ASC');
        $query->asArray();
        $provider = new ActiveDataProvider([ 'query' => $query]);
        if(!empty($query)){
        return [
            'items' => $provider->getModels()
        ];
        }
    }
    public function diligenceview($id)
    {
        $model=ProjectdtlsTbl::find()
            ->select(['mcm_aboutus','MCM_CompanyName','mcm_complogo_memcompfiledtlsfk','CyM_CountryName_en',
                'prdsd_onlineform','prdsd_status','prdsd_comments','prdsd_appdeclon',
                'MCM_Follow_UserMst_Fk','MCM_RegistrationYear','MemberCompMst_Pk','prjd_projdiligenceform_fk',
                'projdiligenceform_tbl.pdf_formtemplate','projdiligenceform_tbl.pdf_formname',
                'projdiligenceform_tbl.pdf_formdesc'])
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=projectdtls_tbl.prjd_memberregmst_fk')
            ->leftJoin('countrymst_tbl','membercompanymst_tbl.MCM_CountryMst_Fk=countrymst_tbl.CountryMst_Pk')
            ->leftJoin('projdiligenceform_tbl','projdiligenceform_tbl.projdiligenceform_pk=projectdtls_tbl.prjd_projdiligenceform_fk')
            ->leftJoin('projdilsubdtls_tbl','projdilsubdtls_tbl.prdsd_projectdtls_fk=projectdtls_tbl.projectdtls_pk')
            ->where('projectdtls_pk=:id',array(':id' =>  $id))
            ->asArray()
            ->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function getvalidationdata($id)
    {
        $query=  ProjecttmpTbl::find()
        ->select(['*'])
        ->leftJoin('membercompanymst_tbl','projecttmp_tbl.prjt_memberregmst_fk = membercompanymst_tbl.MCM_MemberRegMst_Fk')
        ->leftJoin('usermst_tbl','projecttmp_tbl.prjt_apprdeclby=usermst_tbl.UserMst_Pk')
        ->where('projecttmp_pk=:id',array(':id' =>  $id))
            ->asArray()
        ->one();
        if($query){
            return $query;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function followpo($data)
    {
        $compid = Security::decrypt($data['cmppk']);
        $projeoisubmodels= \api\modules\mst\models\MembercompanymstTbl::find()
                ->where("MemberCompMst_Pk=:comp",[':comp'=>$compid])
                ->one();
        if($data['boolval'] == true){
            $usrarr = explode(',', $projeoisubmodels->MCM_Follow_UserMst_Fk);
            if($usrarr[0] != \yii\db\ActiveRecord::getTokenData('user_pk',true)){
            $usrarr = array_filter($usrarr) ;
            array_push($usrarr, \yii\db\ActiveRecord::getTokenData('user_pk',true));
            $finalusrarr = implode(',', $usrarr);
            }  else {
            $finalusrarr = \yii\db\ActiveRecord::getTokenData('user_pk',true);   
            }
        }else{
           $usrarr = explode(',', $projeoisubmodels->MCM_Follow_UserMst_Fk);
            while(($i = array_search(\yii\db\ActiveRecord::getTokenData('user_pk',true),$usrarr)) !== false) {
                unset($usrarr[$i]);
            }
            $finalusrarr = implode(',', $usrarr);
        }
        $projeoisubmodels->MCM_Follow_UserMst_Fk = $finalusrarr;
        
        if ($projeoisubmodels->save() == false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        } else {
           $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
               'val'=>$projeoisubmodels->MCM_Follow_UserMst_Fk,
                'msg'=>'Followers Updated successfully'
            ); 
        }
        return json_encode($result);        
        }

    public function invdilsubmit($data)
    {
        $eoiid = $data['eoipk'];
        $formdata = $data['formdata'];
        $projdiligencemodels= \api\modules\pd\models\ProjdilsubdtlsTbl::find()
                ->where("prdsd_projeoisubdtls_fk=:pk",[':pk'=>$eoiid])
                ->one();
        if(empty($projdiligencemodels)){
         $projdiligencemodels = new ProjdilsubdtlsTbl();
         $projdiligencemodels->prdsd_onlineform = $formdata;
         $projdiligencemodels->prdsd_projectdtls_fk = $data['projpk'];   
         $projdiligencemodels->prdsd_projeoisubdtls_fk = $eoiid; 
         if($data['type']==1){
         $projdiligencemodels->prdsd_status = null; 
         }  if($data['type']==2) {
         $projdiligencemodels->prdsd_status = Security::sanitizeInput(1, "number");
         }    
         $projdiligencemodels->prdsd_submittedon = date('Y-m-d H:i:s'); 
         $projdiligencemodels->prdsd_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
         $projdiligencemodels->prdsd_submittedbyipaddr = \common\components\Common::getIpAddress();
        }  else {
         $projdiligencemodels->prdsd_onlineform = $formdata;  
         if($data['type']==1){
             if($projdiligencemodels->prdsd_status != 3){
         $projdiligencemodels->prdsd_status = null; 
             }
         }  if($data['type']==2) {
             if($projdiligencemodels->prdsd_status == 3){
         $projdiligencemodels->prdsd_status = Security::sanitizeInput(4, "number"); 
             }  else {
         $projdiligencemodels->prdsd_status = Security::sanitizeInput(1, "number");   
             }
         }    
         $projdiligencemodels->prdsd_submittedon = date('Y-m-d H:i:s'); 
         $projdiligencemodels->prdsd_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
         $projdiligencemodels->prdsd_submittedbyipaddr = \common\components\Common::getIpAddress();
        }
        
        if ($projdiligencemodels->save() == false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'error'=>$projdiligencemodels->getErrors(),
                'msg'=>'Something went wrong'
            );
        } else {
           $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'status'=>$projdiligencemodels->prdsd_status,
                'msg'=>'Diligence Updated successfully'
            ); 
        }
        return json_encode($result);        
        }
        
    public function addtechdocs($data)
    {
        $dataval=$data['techinfo'];
        $projpk = Security::decrypt($data['projectpk']);
        $financialdoc = implode(',', $dataval['financialdoc']);
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $techdocmodel= ProjtechdocumentstmpTbl::find()->where('ptdt_projecttmp_fk=:id',array(':id' => $projpk))->one();
        if(empty($techdocmodel)){
            $techdocmodel = new ProjtechdocumentstmpTbl();
            $techdocmodel->ptdt_submittedon = date('Y-m-d H:i:s');
            $techdocmodel->ptdt_submittedby = $UserPk;
            $techdocmodel->ptdt_submittedbyipaddr = $ipAddress;
        } else {
            $techdocmodel->ptdt_updatedon = date('Y-m-d H:i:s');
            $techdocmodel->ptdt_updatedby = $UserPk;
            $techdocmodel->ptdt_updatedbyipaddr = $ipAddress;
        }
        $techdocmodel->ptdt_projecttmp_fk=$projpk;
        $techdocmodel->ptdt_typeofdoc=Security::sanitizeInput($dataval['type'],'number');
        $techdocmodel->ptdt_techdoc=$financialdoc;
        if($techdocmodel->save())
        {
            $data1['title']=$techdocmodel->ptdt_typeofdoc;
            $data1['ptdt_projecttmp_fk']=$techdocmodel->ptdt_projecttmp_fk;
            $data1['achievementdoc']=$techdocmodel->ptdt_techdoc;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($techdocmodel->getErrors());
        }
        return $result;
    }
    public function addlic($data){
        return $data;
    }
    public function addfinancialdocs($data)
    {
        $dataval=$data['financialinfo'];
        $projpk = Security::decrypt($data['projectpk']);
        if($dataval['financialdoc']){
        $financialdoc = implode(',', $dataval['financialdoc']);
        }
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $UserPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ipAddress=\common\components\Common::getIpAddress();
        $financialdocmodel= ProjecttmpTbl::find()->where('projecttmp_pk=:id',array(':id' => $projpk))->one();
        $financialdocmodel->prjt_financialdocs=$financialdoc;
        if($financialdocmodel->save())
        {
            $data1['financialdoc']=$financialdocmodel->prjt_financialdocs;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'success'
            );
        }else{
            echo "<pre>";print_r($financialdocmodel->getErrors());
        }
        return $result;
    }
    public function diligencepreview($id)
    {
        $model = ProjdiligenceformTbl::find()
        ->where('projdiligenceform_pk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->asArray()->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function getprojval($id)
    {
        $model = ProjectdtlsTbl::find()
            ->select(['prjd_projectid','prjd_referenceno','um_firstname','um_lastname','prjd_projcost','piid_totinvreqd','piid_totinvrecd','projectdtls_pk','prsm_projstage']) 
            ->leftJoin('projstagemst_tbl','prjd_projstage=projstagemst_pk')
            ->leftJoin('usermst_tbl','prjd_submittedby=UserMst_Pk')
            ->leftJoin('projinvinfodtls_tbl','piid_projectdtls_fk=projectdtls_pk')
            ->where('projectdtls_pk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->asArray()->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    public function editssval($id)
    {
        $model = ProjectdtlsTbl::find()
            ->select(['prjd_projectid','prjd_referenceno','prjd_projname','prsm_projstage','projownersuccessstory_pk','prjd_projcost','piid_totinvreqd','piid_totinvrecd','projectdtls_pk','poss_youtubelink','poss_successstory'])   
            ->leftJoin('projstagemst_tbl','prjd_projstage=projstagemst_pk')
            ->leftJoin('projownersuccessstory_tbl','poss_projectdtls_fk=projectdtls_pk')
            ->leftJoin('projinvinfodtls_tbl','piid_projectdtls_fk=projectdtls_pk')
            ->where('projownersuccessstory_pk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->asArray()->one();
        if($model){
            return $model;
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }
    
    public function activsslog($id)
    {
        $model['proj'] = ProjownersuccessstoryTbl::find()
            ->select(['*','prjd_projectid','prjd_referenceno','prjd_projname','prsm_projstage','projectdtls_pk',
            'crby.um_firstname as subfname','crby.um_lastname as sublname',
            'decby.um_firstname as decfname','decby.um_lastname as declname'])    
            ->leftJoin('projectdtls_tbl','poss_projectdtls_fk=projectdtls_pk') 
            ->leftJoin('projstagemst_tbl','prjd_projstage=projstagemst_pk')
            ->leftJoin('usermst_tbl crby','poss_submittedby=crby.UserMst_Pk')
            ->leftJoin('usermst_tbl decby','poss_appdeclby=decby.UserMst_Pk')
            ->where('projownersuccessstory_pk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->asArray()->one();
        
        $model['ssstory'] = ProjownersuccessstoryhstyTbl::find()
            ->select(['*','crby.um_firstname as subfname','crby.um_lastname as sublname',
            'decby.um_firstname as decfname','decby.um_lastname as declname'])   
            ->leftJoin('projectdtls_tbl','possh_projectdtls_fk=projectdtls_pk')
            ->leftJoin('usermst_tbl crby','possh_submittedby=crby.UserMst_Pk')
            ->leftJoin('usermst_tbl decby','possh_appdeclby=decby.UserMst_Pk')
            ->leftJoin('projownersuccessstory_tbl','projownersuccessstory_pk=projownersuccessstoryhsty_pk')
            ->where('possh_projownersuccessstory_fk=:id',array(':id' =>  Security::sanitizeInput($id,"number")))->asArray()->all();
        
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
            );
        }else{
            return $model;
        }
    }
    
    public function licbyproj($projectPk)
    {
      $model = ProjreqdlictmpTbl::find()
                ->select(['li_lictitleen','li_referenceno','SecM_SectorName','IndM_IndustryName','projreqdlictmp_pk'])    
                ->leftJoin('licensinginfo_tbl','licensinginfo_pk=prlt_licensinginfo_fk')
                ->leftJoin('sectormst_tbl','SectorMst_Pk=li_sectormst_fk')
                ->leftJoin('industrymst_tbl','IndustryMst_Pk=li_industrymst_fk')
                ->where('prlt_projecttmp_fk=:fk',array(':fk' =>  \common\components\Security::decrypt($projectPk)))
                ->orderBy(['prlt_order'=>SORT_ASC])
                ->asArray()->all();
                return($model);
        
    }
    public function deletemaplic($key,$projectPk)
    {           
        $model =  ProjreqdlictmpTbl::find()
                ->where('prlt_projecttmp_fk=:fk',array(':fk' =>  \common\components\Security::decrypt($projectPk)))
                ->andWhere('projreqdlictmp_pk=:pk',array(':pk' => $key))
                ->one();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Deleted Ssuccessfully',
        );

        if($model->delete() == false){
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'aa'=>$model->getErrors()
            );
        }
        return json_encode($result);
       
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
    
    public function fetchSc($resParam){
        $projectPk = Security::decrypt($resParam->projpk);
        $scData = \common\models\SupportcollateraldtlsTbl::find()
                    ->select([
                            'supportcollateraldtls_pk as scPk',
                            'scd_memcompmst_fk as scMcmPk',
                            'scd_doctype as scDocType',
                            'scd_suppcolldoc as scDoc',
                            'scd_suppcollvideo as scVideo',
                            'scd_createdby as scCreatedBy',
                            'memcompfiledtls_pk as filePk',
                            'mcfd_memcompmst_fk as compMstPk',
                            'mcfd_origfilename as orgFileName',
                            'mcfd_sysgenerfilename as sysFileName',
                            'mcfd_filetype as fileType',
                            'mcfd_uploadedby as uploadedBy',
                        ])
                    ->leftJoin('memcompfiledtls_tbl','scd_suppcolldoc = memcompfiledtls_pk')
                    ->where('scd_shared_fk = :pk',[':pk' => $projectPk])
                    ->andWhere('scd_type = :tp',[':tp' => 1])
                    ->asArray()->all();
        return $scData;
    }
    
    public function savePackageVideo($data) {
        $docType =  $data['docType']; 
        $ret = 1;
        $duplicateCheck = SupportcollateraldtlsTbl::find()
            ->where(['scd_suppcollvideo'=>$data['uploadVideo']])
            ->andWhere(['scd_type'=>$data['shared_fk_type']])
            ->andWhere(['scd_shared_fk'=>$data['product_fk']])
            ->one();

            if(!empty($duplicateCheck)){
                $ret = 2;
            }
            
        if($ret == 1){
            $countCheck = SupportcollateraldtlsTbl::find()
                            ->where(['scd_doctype'=>$docType])
                            ->andWhere(['scd_type'=>1])
                            ->andWhere(['scd_shared_fk'=>$data['projpk']])
                            ->count();
            $maxCount = Yii::$app->params['productSupportCollateralMaxUpload'];

            if($countCheck < $maxCount) {
                $Supportcollateraldtls = new SupportcollateraldtlsTbl();
                $Supportcollateraldtls->scd_memcompmst_fk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $Supportcollateraldtls->scd_doctype = $docType;
                $Supportcollateraldtls->scd_suppcollvideo = $data['uploadVideo'];
                $Supportcollateraldtls->scd_suppcolldoc = null;
                $Supportcollateraldtls->scd_shared_fk = $data['projpk'];
                $Supportcollateraldtls->scd_type = 1;
                $Supportcollateraldtls->scd_createdon = date('Y-m-d H:i:s');
                $Supportcollateraldtls->scd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $Supportcollateraldtls->scd_createdbyipaddr = \common\components\Common::getIpAddress();
                if(!$Supportcollateraldtls->save()){
                    $ret = 0;
                }
            } else {
                $ret = 3;
            }

        }
        return $ret;
    }

    public function saveSupportCollateral($save){
        $docType =  $save['docType'];
        $ret = 1;
        if($docType == 5){
            $factory=$save['fact_fk'];
            if(!isset($_GET['page'])){
                $alreadyCheck = SupportcollateraldtlsTbl::find()
                    ->where(['scd_suppcollvideo'=>$save['uploadVideo']])
                    ->andWhere(['scd_shared_fk'=>$save['projpk']])
                    ->one();
            }else{
                $alreadyCheck = SupportcollateraldtlsTbl::find()
                    ->where('scd_suppcollvideo=:video and scd_memcompfctydtls_fk=:fact',[':video'=>$save['uploadVideo'],':fact'=>$factory])
                    ->andWhere(['scd_shared_fk'=>$save['projpk']])
                    ->one();
            }
            if(!empty($alreadyCheck)){
                $ret = 2;
            }
        }
        if($ret == 1){

            $countCheck = SupportcollateraldtlsTbl::find()
                            ->where('scd_shared_fk = :pk',[':pk' => $projectPk])
                            ->andWhere('scd_type = :tp',[':tp' => 1])
                            ->andWhere(['scd_doctype'=>$docType])
                            ->count();
            $maxCount = Yii::$app->params['supportCollateralMaxUpload'];
            if($save['fact_fk']){
                $Supportcollateraldtls = new SupportcollateraldtlsTbl();
                $Supportcollateraldtls->scd_memcompmst_fk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $Supportcollateraldtls->scd_doctype = $docType;
                if($docType == 5){
                    $Supportcollateraldtls->scd_suppcollvideo = $save['uploadVideo'];
                    $Supportcollateraldtls->scd_suppcolldoc = null;
                }else{
                    $Supportcollateraldtls->scd_suppcolldoc = $save['uploadDoc'];
                }
                $Supportcollateraldtls->scd_shared_fk = $save['projpk'];
                $Supportcollateraldtls->scd_type = 1;
                $Supportcollateraldtls->scd_memcompfctydtls_fk = $save['fact_fk'];
                $Supportcollateraldtls->scd_createdon = date('Y-m-d H:i:s');
                $Supportcollateraldtls->scd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $Supportcollateraldtls->scd_createdbyipaddr = \common\components\Common::getIpAddress();
                //echo'<pre>';print_r($Supportcollateraldtls);exit;
                if(!$Supportcollateraldtls->save()){
                    $ret = 0;
                }
                return $ret;
            }

            if($countCheck < $maxCount){
                $Supportcollateraldtls = new SupportcollateraldtlsTbl();
                $Supportcollateraldtls->scd_memcompmst_fk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $Supportcollateraldtls->scd_doctype = $docType;
                if($docType == 5){
                    $Supportcollateraldtls->scd_suppcollvideo = $save['uploadVideo'];
                    $Supportcollateraldtls->scd_suppcolldoc = 1;
                }else{
                    $Supportcollateraldtls->scd_suppcolldoc = $save['uploadDoc'];
                }
                $Supportcollateraldtls->scd_shared_fk = $save['projpk'];
                $Supportcollateraldtls->scd_type = 1;
                $Supportcollateraldtls->scd_createdon = date('Y-m-d H:i:s');
                $Supportcollateraldtls->scd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $Supportcollateraldtls->scd_createdbyipaddr = \common\components\Common::getIpAddress();
                //echo'<pre>';print_r($Supportcollateraldtls);exit;
                if(!$Supportcollateraldtls->save()){
                    $ret = 0;
                }
            }
            else{
                $ret = 3; // greater count
            }
        }
        return $ret;
    }

    public function fetchvid($resParam){
        $projectPk = Security::decrypt($resParam->projpk);
        $scData = ProjinvinfotmpTbl::find()
                ->where(['piit_projecttmp_fk'=>$projectPk])
                ->one();
        return $scData;
    }
    
    public function saveVideo($save){
        $docType =  $save['docType'];
        $ret = 1;
        if($docType == 5){
            $factory=$save['fact_fk'];
                $alreadyCheck = ProjinvinfotmpTbl::find()
                    ->where(['piit_projecttmp_fk'=>$save['projpk']])
                    ->one();
                $datavalue=explode(',', $alreadyCheck->piit_invinvestorsvideo);
            foreach ($datavalue as $key => $value) {
                if($value==$save['uploadVideo']){
                $ret = 2;
                break;
                }
            }
        }
        if($ret == 1){

            $countCheck = count(explode(',', $alreadyCheck->piit_invinvestorsvideo));
            $maxCount = Yii::$app->params['supportCollateralMaxUpload'];

            if($countCheck < $maxCount){
                $addvid = ProjinvinfotmpTbl::find()
                    ->where(['piit_projecttmp_fk'=>$save['projpk']])
                    ->one();
                if(empty($addvid)){
                $addvid = new ProjinvinfotmpTbl();
                $addvid->piit_projecttmp_fk = $save['projpk'];
                $addvid->piit_submittedon = date('Y-m-d H:i:s');
                $addvid->piit_submittedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $addvid->piit_submittedbyipaddr = \common\components\Common::getIpAddress();
                }
                if($docType == 5){
                    if(empty($alreadyCheck->piit_invinvestorsvideo)){
                    $addvid->piit_invinvestorsvideo = $save['uploadVideo'];
                    }else{
                    $val=explode(',', $alreadyCheck->piit_invinvestorsvideo);
                    array_push($val,$save['uploadVideo']);
                    $val=  implode(',', $val);
                    $addvid->piit_invinvestorsvideo = $val;
                    }
                }
                if(!$addvid->save()){
                    $ret = 0;
                }
            }
            else{
                $ret = 3; // greater count
            }
        }
        return $ret;
    }

    public function savePackageVideoinv($data) {
        $docType =  $data['docType']; 
        $ret = 1;
        $duplicateCheck = SupportcollateraldtlsTbl::find()
            ->where(['scd_suppcollvideo'=>$data['uploadVideo']])
            ->andWhere(['scd_type'=>$data['shared_fk_type']])
            ->andWhere(['scd_shared_fk'=>$data['product_fk']])
            ->one();

            if(!empty($duplicateCheck)){
                $ret = 2;
            }
            
        if($ret == 1){
            $countCheck = SupportcollateraldtlsTbl::find()
                            ->where(['scd_doctype'=>$docType])
                            ->andWhere(['scd_type'=>1])
                            ->andWhere(['scd_shared_fk'=>$data['projpk']])
                            ->count();
            $maxCount = Yii::$app->params['productSupportCollateralMaxUpload'];

            if($countCheck < $maxCount) {
                $addvid = new SupportcollateraldtlsTbl();
                $addvid->scd_memcompmst_fk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
                $addvid->scd_doctype = $docType;
                $addvid->scd_suppcollvideo = $data['uploadVideo'];
                $addvid->scd_suppcolldoc = null;
                $addvid->scd_shared_fk = $data['projpk'];
                $addvid->scd_type = 1;
                $addvid->scd_createdon = date('Y-m-d H:i:s');
                $addvid->scd_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $addvid->scd_createdbyipaddr = \common\components\Common::getIpAddress();
                if(!$addvid->save()){
                    $ret = 0;
                }
            } else {
                $ret = 3;
            }

        }
        return $ret;
    }

    public function deletevideo($resParam){
        $ret = 1;
        $projpk = Security::decrypt($resParam->projpk);
        $addvid = ProjinvinfotmpTbl::find()
                    ->where(['piit_projecttmp_fk'=>$projpk])
                    ->one();
        
        $val=explode(',', $addvid->piit_invinvestorsvideo);
        foreach ($val as $key => $value) {
            if ($resParam->scPk == $value){
                unset($val[$key]);
                break;
            }
        }
        if(empty($val)){
        $addvid->piit_invinvestorsvideo = NULL;
        }else{
        $val=  implode(',', $val);
        $addvid->piit_invinvestorsvideo = $val;
        }

        if(!$addvid->save()){
            $ret = 3;
        }

        return $ret;
    }

    public static function getApprovedProjectList() {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $model = ProjectdtlsTbl::find()
                ->select(['prjd_projname','projectdtls_pk','prjd_projectid'])
                ->where("prjd_projstatus=3")
                ->andWhere('prjd_memberregmst_fk=:regPK',array(':regPK' => $companypk))
                ->orderBy('prjd_projname ASC')
                ->asArray()
                ->all();        
        return $model;
    }

    public static function getProjectList() {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'projectlist'.$companypk;
          
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = self::projectdTblCacheQuery();
                $model = self::projectListQuery($companypk);
                $cache->store($cacheKey, $model, $duration = 0 , $cacheQuery);
                
            } else {
                $model = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $model = self::projectListQuery($companypk);
        }
             
        return $model;
    }

    public static function projectListQuery($companypk){
        $model = ProjectdtlsTbl::find()
        ->select(['prjd_projname as projectName', 'projectdtls_pk as projectPK', 'prjd_projectid as proId', 'prjd_referenceno as proRef', 'prjd_projstage as proStage',
        'CASE WHEN `prjd_projstatus` = 1 THEN "Yet to Submit for Validation"
        WHEN `prjd_projstatus` = 2 THEN "Posted for Validation"
        WHEN `prjd_projstatus` = 3 THEN "Approved"
        WHEN `prjd_projstatus` = 4 THEN "Declined"
        WHEN `prjd_projstatus` = 5 THEN "Re-Submitted" END as pro_status'])
        ->andWhere('prjd_memberregmst_fk=:regPK',array(':regPK' => $companypk))
        ->orderBy('prjd_projname ASC')
        ->asArray()
        ->all();  

        return $model;
    }

    public static function mapproject($formdata) {
        if($formdata) {
            $requistion_list = $formdata['dataval'];
            $project_id = $formdata['proPk'];

            foreach($requistion_list as $key => $val) {
                $model = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $val])->one();
                if($model) {
                    $model->crfd_projectdtls_fk = $project_id;
                    if($model->save()) {
                        $returnval['success'] = $val;
                    } else { 
                        $returnval['failure'][] = $model->getErrors();
                    }
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'success', 
                'flag' => 'S',
                'returnval' => $returnval,
            );
            return $result;
        }
    }
    
    public static function getOverallProject() {
        $path = dirname(__DIR__, 4) . '\backend\json\module\cms';
        $fp = file_get_contents($path . '\Config.json');
        $jsonDecode = json_decode($fp, TRUE);
        $projectGetStatus = $jsonDecode['project']['hasProjectApproval'];
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'overallproject'.$companypk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = self::projectdTblCacheQuery();
                if ($projectGetStatus == 1) {
                    $cacheQuery = ProjecttmpTblQuery::projecttmpTblCacheQuery();
                }
               
                $model = self::overallProjectQuery($jsonDecode, $projectGetStatus, $companypk);
                $cache->store($cacheKey, $model, $duration = 0 , $cacheQuery);
            } else {
                $model = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $model = self::overallProjectQuery($jsonDecode, $projectGetStatus, $companypk);
        }
        
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public static function overallProjectQuery($jsonDecode, $projectGetStatus, $companypk){
        if ($projectGetStatus == 1) {
            $model = ProjecttmpTbl::find()
                    ->select(['prjt_projname as projectName', 'projecttmp_pk as projectPK', 'prjt_projectid as proId', 'prjt_projectid as proRef', 'prjt_projstatus as proStatus', 'prsm_projstage as proStage'])
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->where('prjt_memberregmst_fk=:regPK and prjd_isdeleted = 2 and prjd_projstage NOT IN (2,3)', array(':regPK' => $companypk))
                    ->orderBy('prjt_createdon DESC')
                    ->limit($jsonDecode['dashboard']['projectSlider']['projectDatalimit'])
                    ->offset(0)
                    ->asArray()
                    ->all();
        } else {
            $model = ProjectdtlsTbl::find()
                    ->select(['prjd_projname as projectName', 'projectdtls_pk as projectPK', 'prjd_projectid as proId', 'prjd_referenceno as proRef', 'prjd_projstatus as proStatus', 'prsm_projstage as proStage'])
                    ->leftJoin('projstagemst_tbl', 'projstagemst_pk = prjd_projstage')
                    ->where('prjd_submittedon IS NOT NULL')
                    ->andWhere('prjd_memberregmst_fk=:regPK and prjd_isdeleted = 2 and prjd_projstage NOT IN (2,3)', array(':regPK' => $companypk))
                    ->orderBy([new \yii\db\Expression("coalesce(prjd_createdon,prjd_updatedon) DESC")])
                    ->limit($jsonDecode['dashboard']['projectSlider']['projectDatalimit'])
                    ->offset(0)
                    ->asArray()
                    ->all();
        }
        $finalData = [];
        foreach ($model as $listData) {
            if (!empty($listData['projectPK']) && $listData['projectPK'] != null) {
                $getCountData = self::getProjectBasedCount($listData['projectPK']);
                $dataCount = $getCountData['moduleData'];
                $listData['product'] = $dataCount['product'] ? $dataCount['product'] : 0;
                $listData['service'] = $dataCount['service'] ? $dataCount['service'] : 0;
                $listData['contract'] = $dataCount['contract'] ? $dataCount['contract'] : 0;
                $listData['purchaseOrder'] = $dataCount['purchaseOrder'] ? $dataCount['purchaseOrder'] : 0;
                $finalData[] = $listData;
            }
        }
        return $finalData;
    }
    public function getProjectBasedCount($projectPk) {
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $module = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                        ->select(["count(if(crfd_rqtype = 1, 1, null)) as 'product'","count(if(crfd_rqtype = 2, 1, null)) as 'service'","count(if(cmsch_type = 1, 1, null)) as 'contract'","count(if(cmsch_type = 2, 1, null)) as 'purchaseOrder'",])
                        ->leftJoin('cmscontracthdr_tbl', 'cmsch_cmsrequisitionformdtls_fk = cmsrequisitionformdtls_pk and cmsch_isdeleted = 2')
                        ->where('crfd_projectdtls_fk=:fk and crfd_isdeleted = 2 and crfd_type = 2 and crfd_memcompmst_fk = :comPk', [':fk' => $projectPk,':comPk'=>$compPK])
                        ->asArray()->One();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module ? $module : [],
        );
        return $result;
    }
    public static function GetProjectData($proPk) {
        $model = ProjectdtlsTbl::find()
                ->select(['projectdtls_pk as pro_pk','prjd_projname', 'prjd_referenceno','projectdtls_pk', 'prjd_projectid', 'prjd_projstatus', 'prjd_projstage', 'SecM_SectorName', 'prjd_plannedprojstrtdt', 'prjd_plannedprojenddt', 'prjd_submittedon', 'prjd_projdesc', 'prjd_createdon', 'created.um_firstname as createdUser', 'updated.um_firstname as updatedUser','prjd_shortsummary','CyM_CountryName_en','CM_CityName_en','SM_StateName_en','prjd_projcost','memcompfiledtls_pk','mcfd_memcompmst_fk','mcfd_uploadedby','prjd_projimg_fk','prsm_projstage','IndM_IndustryName','prjd_projteam','prjd_createdby','prjd_submittedby','prjd_countrymst_fk','prjd_statemst_fk','prjd_sectormst_fk','prjd_district','prjd_industrymst_fk','prjd_classification','prjd_projdelayreason','prjd_currencymst_fk','prjd_blockmst_fk',
                    "ROUND(SUM(IF(prjd_currencymst_fk = 3, prjd_projcost * 2.60080, prjd_projcost)),2) as 'projCostUSD'",
                    "ROUND(SUM(IF(prjd_currencymst_fk = 21, prjd_projcost / 2.60080, prjd_projcost)),3) as 'projCostOMR'" 
                    ])
                ->leftJoin('sectormst_tbl', 'SectorMst_Pk=prjd_sectormst_fk')
                ->leftJoin('industrymst_tbl', 'IndustryMst_Pk=prjd_industrymst_fk')
                ->leftJoin('projstagemst_tbl', 'projstagemst_pk=prjd_projstage')
                ->leftJoin('usermst_tbl as created', 'created.UserMst_Pk = prjd_createdby')
                ->leftJoin('usermst_tbl as updated', 'updated.UserMst_Pk = prjd_submittedby')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=prjd_countrymst_fk')
                ->leftJoin('statemst_tbl', 'prjd_statemst_fk=StateMst_Pk')
                ->leftJoin('citymst_tbl', 'prjd_citymst_fk=CityMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=prjd_projimg_fk')
                ->where('projectdtls_pk=:proPK', array(':proPK' => $proPk))
                ->asArray()
                ->one();
        if (!empty($model['prjd_projimg_fk']) != null && $model['prjd_projimg_fk'] != null && $model['prjd_projimg_fk'] != 0) {
            $model['imgUrl'] = Drive::generateUrl($model['memcompfiledtls_pk'], $model['mcfd_memcompmst_fk'], $model['mcfd_uploadedby']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        if (!empty($model['prjd_projteam']) && $model['prjd_projteam'] != null) {
            $model['contactUserlist'] = \common\models\UsermstTblQuery::getUserlistData($model['prjd_projteam']);
        } else {
            $model['contactUserlist'] = [];
        }
        $date1 = $model['prjd_plannedprojstrtdt'];
        $date2 = $model['prjd_plannedprojenddt'];

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $model['duration'] =$years. " Years, ". $months. " months, ".$days." days";
        $model['projectdtls_pk'] = base64_encode($model['projectdtls_pk']);
//        $model['prjd_projdesc'] = strip_tags($model['prjd_projdesc']);
//        $model['prjd_projdesc'] = html_entity_decode($model['prjd_projdesc']);
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public static function GetProjectreqData($proPk) {
        $model = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
            ->select(['crfd_rqclassification','crfd_reqpercent','crfd_rqrevisionno','crfd_cmsdisciplinedtls_fk','crfd_rqapproxvalue','crfd_rqprocesstype', 'crfd_rqprocesstypefile', 'crfd_rqtype', 'crfd_cmscostcenterdtls_fk', 'UserMst_Pk', 'um_firstname', 'UM_EmpId', 'cmsrequisitionformdtls_pk', 'crfd_rqid', 'crfd_rqtitle', 'crfd_rqrefno', 
                'crfd_requester', 'crfd_rqpriority', "date_format(crfd_rqdate,'%Y-%m-%d') as crfd_rqdate", 'crfd_projectdtls_fk', 'crfd_departmentmst_fk', 'DM_Name', 'crfd_rqdesc', 'crfd_rqstatement', 
                'crfd_isblanketrq', 'crfd_recurinterval', 'crfd_recurintervaltype', 
                // 'mcmpld_address', 
                'crfd_reqdeliverable', 
                'crfd_document', 
                'crfd_spares','crfd_remarks', 'prjd_projectid', 'prjd_referenceno', 'prjd_projname', 'prjd_projstatus', 
                'CASE WHEN `prjd_projstatus` = 1 then "Yet to Submit for Validation"  
                WHEN `prjd_projstatus` = 2 then "Posted for Validation"  
                WHEN `prjd_projstatus` = 3 then "Approved"  
                WHEN `prjd_projstatus` = 4 then "Declined"  
                WHEN `prjd_projstatus` = 5 then "Re-Submitted"  
                ELSE "" END as prostatus'])
            ->leftJoin('usermst_tbl', 'UserMst_Pk = crfd_requester')
            ->leftJoin('projectdtls_tbl', 'projectdtls_pk = crfd_projectdtls_fk')
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = crfd_departmentmst_fk')
            ->where('projectdtls_pk=:pk', array(':pk' => $proPk))
            ->asArray()->all();

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduleData' => $model,
                'moduleDataCount' => count($model)+1,
            );
        return $result;
    }
    public function listing($data)
    {
        $size = Security::sanitizeInput($data['size'], "number");
        $order = Security::sanitizeInput($data['order'], "string");
        $page_limit = Security::sanitizeInput($data['page'], "number");
        $page=0;
        if(!empty($page_limit) && $page_limit>1){
            $page = $page_limit - 1;
        }
        $model=ProjectdtlsTbl::find()
            ->select(['projectdtls_pk','IndM_IndustryName','SecM_SectorName','prjd_projname','prjd_projectid','prjd_projstage','prjd_projstatus','prjd_referenceno','MCM_CompanyName','prjd_projcost','prjd_projtype','prjd_projdesc','prjd_addressline','SM_StateName_en','CM_CityName_en','DATE_FORMAT(prjd_plannedprojenddt,"%d-%m-%Y") as prjd_plannedprojenddt','DATE_FORMAT(prjd_plannedprojstrtdt,"%d-%m-%Y") as prjd_plannedprojstrtdt'])
            ->leftJoin('sectormst_tbl','projectdtls_tbl.prjd_sectormst_fk=sectormst_tbl.sectorMst_Pk')
            ->leftJoin('industrymst_tbl','projectdtls_tbl.prjd_industrymst_fk=industrymst_tbl.IndustryMst_Pk')
            ->leftJoin('statemst_tbl','projectdtls_tbl.prjd_statemst_fk=statemst_tbl.StateMst_Pk')
            ->leftJoin('citymst_tbl','projectdtls_tbl.prjd_citymst_fk=citymst_tbl.CityMst_Pk')
            ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=projectdtls_tbl.prjd_memberregmst_fk')
            ->where('prjd_memberregmst_fk=:reg_pk',array(':reg_pk' =>  $data['regpk']));
        if(!empty($data['search'])){
            $model->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjd_projname', true), ':value',array(':value' =>  $data['search'])],
                ['LIKE',Common::getTableWithPrefix('prjd_referenceno', true), ':value',array(':value' =>  $data['search'])],
                ['LIKE',Common::getTableWithPrefix('prjd_projectid', true), ':value',array(':value' =>  $data['search'])]]);
        }
        if(strtolower($order)=='desc'){
            $model->orderBy('projectdtls_pk DESC');
        }else{
            $model->orderBy('projectdtls_pk ASC');    
        }
        $page_size=(!empty($size))?$size:10;
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model, 'pagination' => ['pageSize' =>$page_size,'page'=>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page_size
        ];
    }
    public function getProjectArray($regPk) {
        $module = ProjectdtlsTbl::find()
                        ->select(['projectdtls_pk as dataPk', 'prjd_projname as dataName', 'prjd_referenceno as dataRef'])
                        ->leftJoin('projstagemst_tbl','projstagemst_pk = prjd_projstage')
                        ->where('prjd_memberregmst_fk=:fk and projstagemst_pk = 7 and prjd_isdeleted = 2', [':fk' => $regPk])
                        ->orderBy('dataName ASC')
                        ->groupBy('projectdtls_pk')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module?$module:[],
        );
        return $result;
    }
    public function autoCreatProjectTender($formData) {
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $countrymst_fk = \yii\db\ActiveRecord::getTokenData('MCM_Source_CountryMst_Fk', true);
        $module = ProjectdtlsTbl::find()
                        ->select(['projectdtls_pk'])
                        ->where('prjd_memberregmst_fk=:fk', [':fk' => $regPk])->one();
        if (!empty($module)) {
            $result = \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::autoCreatTender($formData, $module->projectdtls_pk);
        } elseif (empty($module)) {
            $model = new ProjectdtlsTbl;
            $model->prjd_memberregmst_fk = $regPk;
            $model->prjd_referenceno = '00**00';
            $model->prjd_projname = '00**00';
            $model->prjd_projstatus = 3;
            $model->prjd_countrymst_fk = $countrymst_fk;
            $model->prjd_createdon = $date;
            $model->prjd_createdby = $userPK;
            $model->prjd_submittedon = $date;
            $model->prjd_submittedby = $userPK;
            if ($model->save() === TRUE) {
                $result = \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::autoCreatTender($formData, $model->projectdtls_pk);
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
        }
        return $result;
    }
    public static function getProjectNameArray() {
        $regPk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $model = ProjectdtlsTbl::find()
                        ->select(['projectdtls_pk as dataPk', 'prjd_projname as dataName'])
                        ->where('prjd_memberregmst_fk=:fk and prjd_isdeleted = 2', [':fk' => $regPk])
                        ->asArray()->all();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model ? $model : [],
        );
        return $result;
    }
    public function getContracts($formdata){
        $data = [];
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => $data
        );

        $projectpk = Security::decrypt($formdata['projectpk']);
        $search = $formdata['searchTxt'];
        $contracts = [];
        $totalContracts = 0;
        $totalOrders = 0;
        $totalAgreements = 0;
        $jrsr_country = [];
       
        if($formdata['dataType'] == 1){
            $project = ProjectdtlsTbl::findOne($projectpk);
            $reqIds = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()->select('cmsrequisitionformdtls_pk')->where(['crfd_projectdtls_fk' => $projectpk])->column();
            $contracts = \api\modules\pms\models\CmscontracthdrTblQuery::getContracts($reqIds, $projectpk = null, $formdata);
            
        } else {
            $contracts = \api\modules\pms\models\CmscontracthdrTblQuery::getContracts($reqIds = [], $projectpk, $formdata);
        }
        if(!empty($contracts)){
            $contractCount = $purchaseOrderCount = $agreementCount = 0;
            $type = [];// Contract type
            $type[1] = 'CO';
            $type[2] = 'PO';
            $type[3] = 'BA';
            $subOrderType = [];// Sub order ype
            $subOrderType[1] = 'SC';
            $subOrderType[2] = 'SO';
            $subOrderType[3] = 'SA';
            $baseUrl = Yii::$app->params['baseUrl'];
            $awarded_to = ['dataType'=>null,'name' =>  null, 'suplier_code' => null, 'classification' => null, 'external_profile_link' => null, 'supplier360' => null,];
            $company_logo = null;
            if($project){
                $level=1;
            } else {
                $level=0;
            }
            $data =  ProjectdtlsTbl::getSubContracts($contracts, $formdata, $awarded_to, $project->prjd_projectid, $level, $baseUrl);
            $jsrsAwardedName = [];
            $nonjsrsAwardedName = [];
            $jsrsCountry = [];
            $nonjsrsCountry = [];
            $specialStatus =  [
                    ['shortname'=>'CCED','fullname'=>'CC Energy Development Oman','value'=>1],
                    ['shortname'=>'DUQM','fullname'=>'Duqm','value'=>2],
                    ['shortname'=>'OXY','fullname'=>'Occidental Oman, Inc.','value'=>3],
                    ['shortname'=>'PDO','fullname'=>'Petroleum Development Oman','value'=>4],
                ];
            usort($data, function($a, $b) {
                return $b['level'] - $a['level'];
            });           
            $levelOn = null;
            $parentNode = [];
            $resData = [];
            $parentNodeOn = false;
            $parentNodehelper = [];
            //print_r($data);die();
            foreach($data as $key => $val){
            
                $levelOn = !$levelOn ? $val['level'] : $levelOn;
                if($levelOn != $val['level']){
                    $levelOn = $val['level'];
                    $parentNodeOn = true;
                }

                if(!($parentNodeOn && in_array($val['nodeId'], $parentNode)) && $val['level'] != 0){
                    if($search){
                        if(stripos($val['name'], $search) === false && stripos($val['uid'], $search) === false){
                            continue;
                        }
                    }
                
                    if(!empty($formdata['awardType']) && !in_array($val['type'], $formdata['awardType'])) {
                        continue;
                    } 

                    if(!empty($formdata['processType']) && !in_array($val['process_type'], $formdata['processType'])) {
                        continue;
                    } 

                    if(!empty($formdata['procurementType']) && !in_array($val['procurement_type'], $formdata['procurementType'])) {
                        continue;
                    } 
                    

                    if(!empty($formdata['listStatus']) && !in_array($val['status'], $formdata['listStatus'])) {
                        continue;
                    }
                    if(!empty($formdata['subcontractStatus']) && !in_array($val['awardStatus'], $formdata['subcontractStatus'])) {
                        continue;
                    }

                    if(!empty($formdata['subContract']) && !in_array($val['subcontracting'], $formdata['subContract'])) {
                        continue;
                    }

                    if(!empty($formdata['eTendering']) && !in_array($val['etendering'], $formdata['eTendering'])) {
                        continue;
                    }

                    if (!empty($formdata['startStarDate']) && !empty($formdata['startEndDate'])) {
                        $start_date = strtotime($val['start_date']);
                        $form_start_date = strtotime($formdata['startStarDate']);
                        $form_end_date = strtotime($formdata['startEndDate']);
                        if(!($form_start_date <= $start_date && $form_end_date >= $start_date)){
                            continue;
                        }
                    }

                    if (!empty($formdata['closingStarDate']) && !empty($formdata['closingStarDate'])) {
                        $end_date = strtotime($val['end_date']);
                        $closing_start_date = strtotime($formdata['closingStarDate']);
                        $closing_end_date = strtotime($formdata['closingEndDate']);
                        if(!($end_date >= $closing_start_date && $end_date <= $closing_end_date)){
                            continue;
                        }
                    } 

                    if(!empty($formdata['classification']) && !in_array($val['awarded_to']['classification'], $formdata['classification'])) {
                        continue;
                    }
                    if(!empty($formdata['specialStatus']) && !in_array($val['awarded_to']['jsrssplstatus'], explode(',', $formdata['specialStatus']))) {
                        continue;
                    }
                    

                    if(!empty($formdata['supplierStatus'])) {
                        $supplstatus = 1;
                        if($val['awarded_to']['supplier_status']){
                            $supplstatus = 2;
                        }
                       
                        if(!in_array($supplstatus, $formdata['supplierStatus'])){
                            continue;
                        }
                    }
                    
                    if(!empty($formdata['country']) && !in_array($val['jsrs_country_pk'], $formdata['country'])) {
                        continue;
                    }

                    if(!empty($formdata['countryNon']) && !in_array($val['nonjsrs_country_pk'], $formdata['countryNon'])) {
                        continue;
                    }

                    if(!empty($formdata['awardedto']) && !in_array($val['awarded_to']['name_pk'], $formdata['awardedto'])) {
                        continue;
                    }
                   
                    if (!empty($formdata['awardedStartDate']) && !empty($formdata['awardedEndDate'])) {
                        $awarded_date = strtotime($val['awarded_to']['awarded_on']);
                        $award_start_date = strtotime($formdata['awardedStartDate']);
                        $award_end_date = strtotime($formdata['awardedEndDate']);
                       
                        if(!($awarded_date >= $award_start_date && $awarded_date <= $award_end_date)){
                            continue;
                        } 
                    } 

                    if(!empty($formdata['awardedNonJSRS']) && !in_array($val['awarded_to']['nonjsrs_name_pk'], $formdata['awardedNonJSRS'])) {
                        continue;
                    }
                    if(isset($val['quotation_pk'])) {
                        $data = \api\modules\icv\controllers\IcvController::actionIcvactualspenddataforoverview($val['quotation_pk'],'','');
                       
                        foreach ($data['items'] as $actualcommited_key => $actualcommited_value) {
                            $val['commited_val'] += $actualcommited_value['plannedamt'];
                            $val['actual_val']   += $actualcommited_value['actspendamt'];
                            
                        }
                        if($val['commited_val'] != 0) {
                            $val['icv_percentage']    = ($val['actual_val'] / $val['commited_val'] )*100;

                        } else {
                            $val['icv_percentage']    = 0;
                        }
                    }
                }  
               
                if(isset($val['commited_val'])) {
                    $projecticvplanned += $val['commited_val'];    
                } 
                if(isset($val['actual_val'])) {
                    $projecticvactual += $val['actual_val'];
                }                           

                if($projecticvplanned != 0) {
                    $icv_proj_percentage  = ($projecticvactual / $projecticvplanned  )*100;

                } else {
                    $icv_proj_percentage  = 0;
                }
                
                $val['subcontracting'] = ($val['subcontracting'] == 1) ? 'Yes' : "No";
                $val['etenderingmandate'] = ($val['etenderingmandate'] == 1) ? 'Yes' : "No";
                $resData[] = $val;
                $parentNode[] = $val['parentNodeId'];

                if($val['awarded_to']['name'] && !in_array($val['awarded_to']['name'], $jsrsAwardedName)) {
                    $jsrsAwardedName[$val['awarded_to']['name_pk']] = $val['awarded_to']['name'];
                }

                if($val['awarded_to']['nonjsrs_name'] && !in_array($val['awarded_to']['nonjsrs_name'], $nonjsrsAwardedName)) {
                    $nonjsrsAwardedName[$val['awarded_to']['nonjsrs_name_pk']] = $val['awarded_to']['nonjsrs_name'];
                }
               
                if($val['jsrs_country'] && !in_array($val['jsrs_country'], $jsrsCountry)) {
                    $jsrsCountry[$val['jsrs_country_pk']] = $val['jsrs_country'];
                }

                if($val['nonjsrs_country'] && !in_array($val['nonjsrs_country'], $nonjsrsCountry)) {
                    $nonjsrsCountry[$val['nonjsrs_country_pk']] = $val['nonjsrs_country'];
                }
                // $totalContracts += $val['subContract'];
                // $totalOrders += $val['subOrder'];
                // $totalAgreements += $val['subAgreement'];
                // if($val['parentNodeId'] == $project->prjd_projectid){
                    
                    if($val['type'] == 1){
                        $totalContracts++;
                    } else if($val['type'] == 2){
                        $totalOrders++;
                    }  else if($val['type'] == 3){
                        $totalAgreements++;
                    } 
                // }
            }
            //die();
            if($project) {
                $projectarr = array(
                    'name' => $project->prjd_projname,
                    'nodeId' => $project->prjd_projectid,
                    'parentNodeId' => null,
                    'level' => 0,
                    'type' => 'PRO',
                    'status' => $project->prjd_projstage,
                    'value' => Common::numberConversionNew($project->prjd_projcost),
                    'subContract' => $totalContracts,
                    'subOrder' => $totalOrders,
                    'subAgreement' => $totalAgreements,
                    'projecticvplanned'=> $projecticvplanned,
                    'projecticvactual'=> $projecticvactual,
                    'projecticvpercentage' => $icv_proj_percentage,
                );
                
                if($formdata['dataType'] == 1){
                    array_unshift($resData, $projectarr);
                }
            }
           
            $filterData = [
                'special_status' => $specialStatus,
                'jsrs_country' => $jsrsCountry,
                'nonjsrs_country' => $nonjsrsCountry,
                'jsrsAwardedTo' => $jsrsAwardedName,
                'nonjsrsAwardedTo' => $nonjsrsAwardedName
            ];
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => count($resData) > 1 ? $resData: [],
                'filterData' => $filterData
            );
        }
    
        return $result;
    }

    public function getContractsForIcvProgress($formdata) {

        $data = [];
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => $data
        );

        $projectpk = Security::decrypt($formdata['projectpk']);
        $year = $formdata['year'];
        $quarter = $formdata['quarter'];
        $contracts = [];
        $totalContracts = 0;
        $totalOrders = 0;
        $totalAgreements = 0;
        $jrsr_country = [];
       
        if($formdata['dataType'] == 1) {
            $project = ProjectdtlsTbl::findOne($projectpk);
            $reqIds = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()->select('cmsrequisitionformdtls_pk')->where(['crfd_projectdtls_fk' => $projectpk])->column();
            $contracts = \api\modules\pms\models\CmscontracthdrTblQuery::getContracts($reqIds, $projectpk = null, $formdata);
            
        } else {
            $contracts = \api\modules\pms\models\CmscontracthdrTblQuery::getContracts($reqIds = [], $projectpk, $formdata);
        }

        if(!empty($contracts)) {
            
            $baseUrl = Yii::$app->params['baseUrl'];
            $awarded_to = ['dataType'=>null,'name' =>  null, 'suplier_code' => null, 'classification' => null, 'external_profile_link' => null, 'supplier360' => null,];
            //$company_logo = null;
            if($project){
                $level=1;
            } else {
                $level=0;
            }
            $data =  ProjectdtlsTbl::getSubContracts($contracts, $formdata, $awarded_to, $project->prjd_projectid, $level, $baseUrl);
        
            usort($data, function($a, $b) {
                return $b['level'] - $a['level'];
            });           
            $levelOn = null;
            $parentNode = [];
            $resData = [];
            $parentNodeOn = false;
            $parentNodehelper = [];
            $resultData =[];
            foreach ($data as $key => $val) {
                $levelOn = !$levelOn ? $val['level'] : $levelOn;
                if($levelOn != $val['level']){
                    $levelOn = $val['level'];
                    $parentNodeOn = true;
                }

                if(!($parentNodeOn && in_array($val['nodeId'], $parentNode)) && $val['level'] != 0){     
                    if(isset($val['quotation_pk'])) {
                        $data = \api\modules\icv\controllers\IcvController::actionIcvactualspenddataforoverview($val['quotation_pk'],$year,$quarter);
                      
                        //print_r($data);

                        foreach ($data['items'] as $actualcommited_key => $actualcommited_value) {
                            $resultData['commited_val'] += $actualcommited_value['plannedamt'];
                            $resultData['actual_val']   += $actualcommited_value['actspendamt'];
                            
                        }
                        //print_r($data);
                        foreach($data['items'] as $datakey =>$dataval) {

                            if($dataval['icplanheadlabel'] == 'Goods') {
                                    $goodplannedSum += $dataval['plannedamt'];
                                    $goodactualSum  += $dataval['actspendamt'];
                            }
                            if($dataval['icplanheadlabel'] == 'Services') {
                                    $serviceplannedSum += $dataval['plannedamt'];
                                    $serviceactualSum  += $dataval['actspendamt'];
                            }
                            if($dataval['icplanheadlabel'] == 'Workforce') {
                                    $workforceplannedSum += $dataval['plannedamt'];
                                    $workforceactualSum  += $dataval['actspendamt'];
                            }
                            if($dataval['icplanheadlabel'] == 'Investment') {
                                    $investmentplannedSum += $dataval['plannedamt'];
                                    $investmentactualSum  += $dataval['actspendamt'];
                            }
                        }
                    } 
                }  
                // if(isset($val['commited_val'])) {
                //     $projecticvplanned += $val['commited_val'];    
                // } 
                // if(isset($val['actual_val'])) {
                //     $projecticvactual += $val['actual_val'];
                // }   
            };

            if(!empty($goodplannedSum) && !empty($goodactualSum)) {
                $resultData['goodPercentage'] = ($goodplannedSum / ($goodplannedSum + $goodactualSum))*100;
            } else {
                $resultData['goodPercentage'] = 0.00;
            }

            if(!empty($serviceplannedSum) && !empty($serviceactualSum)) {
                $resultData['servicePercentage'] = ($serviceplannedSum / ($serviceplannedSum + $serviceactualSum))*100;
            } else {
                $resultData['servicePercentage'] = 0.00;
            }

            if(!empty($workforceplannedSum) && !empty($workforceactualSum)) {
                $resultData['workforcePercentage'] = ($workforceplannedSum / ($workforceplannedSum + $workforceactualSum))*100;
            } else {
                $resultData['workforcePercentage'] = 0.00;
            }

            if(!empty($investmentplannedSum) && !empty($investmentactualSum)) {
                $resultData['investmentPercentage'] = ($investmentplannedSum / ($investmentplannedSum + $investmentactualSum))*100;
            } else {
                $resultData['investmentPercentage'] = 0.00;
            }

            //print_r($resultData);die();
             $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $resultData,
                
            );
             return $result;
        }
    }
    public static function projectdTblCacheQuery(){
        return ProjectdtlsTbl::find()
        ->select('count(*)')
        ->createCommand()
        ->getRawSql();
    }
    public function getprojectstagecount(){
        $regpk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $model = ProjectdtlsTbl::find()
            ->select([
                'count(projectdtls_pk) as `totalcount`',
                'sum(if(prjd_projstage =2 , 1, 0))  as `Suspended`',
                'sum(if(prjd_projstage =3 , 1, 0))  as `Terminated`',
                'sum(if(prjd_projstage =4 , 1, 0))  as `Completed`',
                'sum(if(prjd_projstage =7 , 1, 0))  as `InProgress`'
                ])
            ->where('prjd_memberregmst_fk=:regPK and prjd_projstage in (2,3,4,7) and prjd_isdeleted = 2', array(':regPK' => $regpk))
            ->asArray()
            ->one();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model ? $model : [],
        );
        return $result;
    }
    /**
     * Chk Project Ref detail
     */
    public function chkValidRefNumber($data) {
        if (!empty($data)) {
            $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
            $model = ProjectdtlsTbl::find()
                    ->select(['projectdtls_pk', 'prjd_projname'])
                    ->where("prjd_memberregmst_fk =:regPK and prjd_referenceno = :dataRef and prjd_isdeleted = 2", [':regPK' => $regPK, ':dataRef' => $data['dataValue']])
                    ->andWhere(['<>', 'projectdtls_pk', $data['currentPk']])
                    ->asArray()
                    ->all();
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduleData' => $model ? $model : [],
            );
        }
        return json_encode($result, true);
    }
}