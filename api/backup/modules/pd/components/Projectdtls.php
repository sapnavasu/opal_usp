<?php
namespace api\modules\pd\components;
use api\modules\pd\models\ProjecttmpTbl;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjinvmappingtmpTbl;
use common\components\Security;


use api\modules\drv\models\FilemstTbl;
use api\modules\mst\models\BussourcemstTbl;
use api\modules\mst\models\MemcompprodmarketpresenceTbl;
use api\modules\mst\models\SectormstTbl;
use Yii;
use yii\data\ActiveDataProvider;
use \api\modules\mst\models\ClassmstTbl;
use \api\modules\mst\models\FamilymstTbl;
use \api\modules\mst\models\SegmentmstTbl;
use \api\modules\mst\models\ProductmstTbl;
use common\components\UpdateTrigger;
use common\components\Common;
use common\components\Drive;
use const Swagger\Annotations\UNDEFINED;
use common\models\MemcompquantitypriceTbl;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of projectdtls
 *
 * @author bgi130
 */

class Projectdtls {
    public $projectpk;
    
    public function __construct($projectpks=NULL){
        $projectPk = Security::decrypt($projectpks);
        $this->projectpk=$projectPk;
        
    } 
    //put your code here
    public function gettempprojectview()
    {
        
        $headers = Yii::$app->request->headers;
        $authorization = $headers->get('Authorization');

        if ($authorization == null || $authorization == '' || $authorization == 'Bearer null') {
            $track = '';
        } else {
            $loggedin_user = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $track = 1;
        }
        
          $projtmp = ProjecttmpTbl::find()
                ->select('prjt_projname as projectname,prjt_referenceno as referenceno,prjt_projectid as projectid,prjt_investorbenefits as msgtoinvestors,'
                        . 'projstagemst_tbl.prsm_projstage as projstage,prjt_shortsummary as shortsummary,prjt_projdesc as projdesc,'
                        . 'sectormst_tbl.SecM_SectorName as sectorname,industrymst_tbl.IndM_IndustryName as IndustryName,prjt_benefeat as benefeat,'
                        . 'prjt_mfrtargmarkets as mfrtargmarkets,prjt_mfrprodlevels as mfrprodlevels,prjt_projcategory as projcategory,'
                        . 'prjt_splcategory as splcategory,prjt_investorbenefits as investorbenefits,projtypemst_tbl.ptm_projecttype as projtype,'
                        . 'prjt_otherprojtype as otherprojtype,prjt_projcost as projcost, prjt_debt as debt,prjt_amtspentsofar as amtspentsofar,'
                        . 'prjt_equity as equity,prjt_debtequityratio as debtequityratio,prjt_balanceamt as balanceamt,prjt_dateofinception as dateofinception,'
                        . 'prjt_plannedprojstrtdt as plannedprojstrtdt,prjt_plannedprojenddt as plannedprojenddt,prjt_projdelayreason as projdelayreason,'
                        . 'scheme1.psm_schemename as schemename1,scheme1.psm_schemetype as schemetype1,scheme2.psm_schemename as schemename2,scheme2.psm_schemetype as schemetype2,prjt_projpromoterdtls_fk as promoterfk,'
                        . 'prjt_projcentralschemeothers as projcentralschemeothers,prjt_projstateschemeothers as projstateschemeothers,'
                        . 'prjt_sustdevelopgoal,prjt_projstatus as projstatus,prjt_presentstatus as presentstatus,prjt_presentstatusothers as presentstatusothers,'
                        . 'projfundmst_tbl.pfm_fundedby as fundedby,prjt_projotherfund as projotherfund,prjt_projfundmst_fk as projfundpk,prjt_natureofprop as natureofprop,prjt_proptype as proptype,'
                        . 'prjt_landarea as landarea,unitmst_tbl.unm_namesg as unittype,projmodeofimplentmst_tbl.pmim_modetype as modetype,prjt_projmodeofimplentmst_fk as modeval,'
                        . 'projmodeofimplentmst_tbl.pmim_modesubtype as modesubtype,prjt_otherimplementation as otherimplementation,'
                        . 'projownershipmst_tbl.posm_ownership as ownership,projzonemst_tbl.pzm_projsubzone as projsubzone,prjt_addressline as addressline,'
                        . 'prjt_latitude as latitude,prjt_longitude as longitude,state1.SM_StateName_en as StateName1,city1.CM_CityName_en as CityName1,'
                        . 'prjt_projteam as projteam,prjt_contactinfo as contactinfo,prjt_projinvproced as projinvproced,prjt_website as website,prjt_district as districtnme,'
                        . 'prjt_socialmedia as socialmedia,prjt_finindicators as finindicators,prjt_roi as roi,prjt_riskfactors as riskfactors,'
                        . 'prjt_riskdisclosures as riskdisclosures,projdiligenceform_tbl.pdf_buildertemplate as buildptm_projecttypeertemplate,'
                        . 'prjt_financialdocs as financialdocs,prjt_interestfortender as interestfortender,prjt_updatedon as updatedon,'
                        . 'projinvinfotmp_tbl.piit_totinvreqd as totinvreqd,projinvinfotmp_tbl.piit_totinvrecd as totinvrecd,'
                        . 'ptt_techinfo as techinfo,ptt_fdiclassification as fdiclass,ptt_techapprovals as techapprovals,ptt_socioecoimpact as socioecoimpact,projinvinfotmp_tbl.piit_invinvestorsvideo as invvideo,'
                        . 'ptt_environmental as environmental,ptt_marketoverview as marketoverview,ptt_marketneeds as marketneeds,ptt_markettrends as markettrends,'
                        . 'ptt_similrefer as similrefer,projinvinfotmp_tbl.piit_investtype as investtype,projinvinfotmp_tbl.piit_investmentstatus as investmentstatus,'
                        . 'projinvinfotmp_tbl.piit_targetinvestors as targetinvestors,piit_invprefsrc as invprefsrc,piit_otherprefsrc as otherprefsrc,'
                        . 'prjt_projcostvalue as projcostvalue,prjt_fundpercent as fundpercent,prjt_fundrefno as fundrefno,projinvinfotmp_tbl.piit_welcomenote as welcomenote,'
                        . 'projdiligenceform_tbl.pdf_buildertemplate as buildertemplate,projtechdocumentstmp_tbl.ptdt_techdoc as techdoc')
                ->leftJoin('sectormst_tbl','SectorMst_Pk=prjt_sectormst_fk')
                ->leftJoin('projstagemst_tbl','projstagemst_pk=prjt_projstage')
                ->leftJoin('projschememst_tbl as scheme1','scheme1.projschememst_pk=prjt_projscentralschememst_fk')
                ->leftJoin('projschememst_tbl as scheme2','scheme2.projschememst_pk=prjt_projstateschememst_fk')
                ->leftJoin('projownershipmst_tbl','projownershipmst_pk=prjt_projownershipmst_fk')
                ->leftJoin('projfundmst_tbl','prjt_projfundmst_fk=projfundmst_pk')
                ->leftJoin('projtypemst_tbl','prjt_projtype=projtypemst_pk')
                ->leftJoin('projzonemst_tbl','projzonemst_pk=prjt_projzonemst_fk')
                ->leftJoin('industrymst_tbl','IndustryMst_Pk=prjt_industrymst_fk')
                ->leftJoin('projinvinfotmp_tbl','piit_projecttmp_fk=projecttmp_pk')
                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=prjt_memberregmst_fk')
                ->leftJoin('statemst_tbl as state1','state1.StateMst_Pk=prjt_statemst_fk')
                ->leftJoin('citymst_tbl as city1','city1.CityMst_Pk=prjt_citymst_fk')
                ->leftJoin('unitmst_tbl','unitmst_pk=prjt_unitmst_fk')
                ->leftJoin('projtechdocumentstmp_tbl','ptdt_projecttmp_fk=projecttmp_pk')
                ->leftJoin('projmodeofimplentmst_tbl','projmodeofimplentmst_pk=prjt_projmodeofimplentmst_fk')
                ->leftJoin('projdiligenceform_tbl','projdiligenceform_pk=prjt_projdiligenceform_fk')
                ->leftJoin('projtechnicaltmp_tbl','projecttmp_pk=ptt_projecttmp_fk')
                ->where('projecttmp_pk=:pk', array(':pk'=> \common\components\Security::sanitizeInput($this->projectpk,"number")))->asArray()->one();
          
          if(!empty($projtmp)){
          $teamarr =  $projtmp['projteam'] ;
        $teamarr = Json_decode($teamarr);
        if($teamarr!=[]){
        $teampk = implode(',',$teamarr);
        $team = UsermstTbl::find()
                ->select('DM_Name as departname,UM_EmpId as empid,dsg_designationname as designation,um_firstname as firstname,um_lastname as lastname')
                ->where("UserMst_Pk IN ($teampk)")
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                 ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
                ->andWhere('UM_Status=:status',array(':status'=>'A'))
                ->asArray()->all();
        }
        $department=[];
        if($team){
        foreach ($team as $key => $value) {
            $department[$key][$value['departname']]['empid']=$value['empid'];
            $department[$key][$value['departname']]['designation']=$value['designation'];
            $department[$key][$value['departname']]['name']=$value['um_lastname'].' '.$value['lastname'];
        }
        }
        $maindepart=[];
        foreach ($department as $key => $deparrt) {
            foreach ($deparrt as $keyval => $value) {
                $maindepart[$keyval][]=$value;
            }
        }
        
//        Contact details
        $contactarr =  $projtmp['contactinfo'] ;
        if(!empty($contactarr))
        {
        $contactarr = Json_decode($contactarr);
        $cntctpk = implode(',',$contactarr);
        
        $contact = UsermstTbl::find()
                ->select('DM_Name as departname,UM_EmpId as empid,dsg_designationname as designation,um_firstname as firstname,um_lastname as lastname')
                ->where("UserMst_Pk IN ($cntctpk)")
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
                ->andWhere('UM_Status=:status',array(':status'=>'A'))
                ->asArray()->all();
        }
        
        $departmentcontact=[];
        if($contact){
        foreach ($contact as $key => $value) {
            $departmentcontact[$key][$value['departname']]['empid']=$value['empid'];
            $departmentcontact[$key][$value['departname']]['designation']=$value['designation'];
            $departmentcontact[$key][$value['departname']]['name']=$value['um_lastname'].' '.$value['lastname'];
        }
        }
        $maincontactdepart=[];
        foreach ($departmentcontact as $key => $deparrt) {
            foreach ($deparrt as $keyval => $value) {
                $maincontactdepart[$keyval][]=$value;
            }
        }
//       Invite Investor details
        $inviteinv = ProjinvmappingtmpTbl::find()
                ->select(['*'])
                ->where('pimt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($this->projectpk,"number")))
                ->asArray()->all();
        $investor=[];
        if (!empty($inviteinv)){
        foreach ($inviteinv as $key => $value) {
            $investor[$key]['name']=$value['pimt_name'];
            $investor[$key]['investorid']=$value['projinvmappingtmp_pk'];
            $investor[$key]['emailid']=$value['pimt_emailid'];
        }
        }
        $partnerdtls = \api\modules\pd\models\ProjectpartnertmpTbl::find()
                ->select(['*'])
                ->leftJoin('partnermst_tbl', 'partnermst_pk = prjpt_partnermst_fk')
                ->where('prjpt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($this->projectpk,"number")))
                ->asArray()->all();
        $partnerarr=[];
        if (!empty($partnerdtls)){
        foreach ($partnerdtls as $key => $value) {
            $partnerarr[$key]['orgname']=$value['prjpt_partnerorginfo'];
            $partnerarr[$key]['orgtype']=$value['prms_orgtype'];
            $partnerarr[$key]['orgimage']='';
        }
        }
        
        $achiveaccreditions = \api\modules\pd\models\ProjaccachievetmpTbl::find()
                ->select(['*'])
                ->leftJoin('memcompacomplishdtls_tbl', 'memcompacomplishdtls_pk = paat_memcompacomplishdtls_fk')
                ->where('paat_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($this->projectpk,"number")))
                ->asArray()->all();
        $accreditionsarr=[];
        $achivearr=[];
        $k=0;
        $j=0;
        if (!empty($achiveaccreditions)){
        foreach ($achiveaccreditions as $key => $value) {
            if($value['paat_type']==1)
            {
            $accreditionsarr[$k]['certifyno']=$value['mcad_accachieveno'];
            $accreditionsarr[$k]['title']=$value['mcad_title'];
            $accreditionsarr[$k]['issuedby']=$value['mcad_issuedby'];
            $accreditionsarr[$k]['issuedon']=$value['mcad_issuedon'];
            $k++;
            }else if($value['paat_type']==2)
            {
            $achivearr[$j]['title']=$value['mcad_title'];
            $achivearr[$j]['yearahive']=$value['mcad_issuedon'];
            $achivearr[$j]['describe']=$value['mcad_desc'];   
            $achivearr[$j]['uploadimage']=$value['mcad_newsupload'];   
            $j++;
            }
        }
        }
        if($projtmp['predefinedtags'])
        {
            $predefinedtags = \api\modules\mst\models\SectormstTbl::find()
                ->select(['*'])
                ->where("SectorMst_Pk IN ({$projtmp['predefinedtags']})")
                ->asArray()->all();
            
        }
        $acquiredlicdtls = \api\modules\pd\models\ProjacqlictmpTbl::find()
                ->select('licensinginfo_tbl.li_lictitleen as licensename,licensinginfo_tbl.li_referenceno licreferenceno,licensinginfo_tbl.li_validity as livalidity')
                ->leftJoin('licensinginfo_tbl', 'licensinginfo_pk = palt_licensinginfo_fk')
                ->where('palt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($this->projectpk,"number")))
                ->asArray()->all();
        $acquirelicencearr=[];
        if (!empty($acquiredlicdtls)){
        foreach ($acquiredlicdtls as $key => $value) {
            $acquirelicencearr[$key]['licname']=$value['licensename'];
            $acquirelicencearr[$key]['licref']=$value['licreferenceno'];
            $acquirelicencearr[$key]['licval']=$value['livalidity'];
        }
        }
        $requiredlicdtls = \api\modules\pd\models\ProjreqdlictmpTbl::find()
                ->select('licensinginfo_tbl.li_lictitleen as licensename,licensinginfo_tbl.li_referenceno licreferenceno,sectormst_tbl.SecM_SectorName as SectorName,industrymst_tbl.IndM_IndustryName as IndustryName,licensauthoritiesmst_tbl.lam_licenseauthname_en as licenseauthname')
                ->leftJoin('licensinginfo_tbl', 'licensinginfo_pk = prlt_licensinginfo_fk')
                ->leftJoin('sectormst_tbl', 'SectorMst_Pk = li_sectormst_fk')
                ->leftJoin('industrymst_tbl', 'IndustryMst_Pk = li_industrymst_fk')
                ->leftJoin('licauthdtls_tbl', 'lad_licensinginfo_fk = licensinginfo_pk')
                ->leftJoin('licensauthoritiesmst_tbl', 'licensauthoritiesmst_pk = lad_licensauthoritiesmst_fk')
                ->where('prlt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($this->projectpk,"number")))
                ->asArray()->all();
        $requirelicencearr=[];
        if (!empty($requiredlicdtls)){
        foreach ($requiredlicdtls as $key => $value) {
            $requirelicencearr[$key]['licname']=$value['licensename'];
            $requirelicencearr[$key]['licref']=$value['licreferenceno'];
            $requirelicencearr[$key]['sectorname']=$value['SectorName'];
            $requirelicencearr[$key]['industryname']=$value['IndustryName'];
            $requirelicencearr[$key]['licenseauthname']=$value['licenseauthname'];
        }
        }
        $promopk=$projtmp['promoterfk'];
        if($promopk!='' && $promopk!=null){
        $promotorsdtls = \api\modules\pd\models\ProjpromoterdtlsTbl::find()
                ->select(['*'])
                ->where("projpromoterdtls_pk IN ($promopk)")
                ->asArray()->all();
        $promotorsarr=[];
        if (!empty($promotorsdtls)){
        foreach ($promotorsdtls as $key => $value) {
            $promotorsarr[$key]['promotername']=$value['ppd_promotername'];
            $promotorsarr[$key]['website']=$value['ppd_website'];
            $promotorsarr[$key]['address']=$value['ppd_address'];
            $promotorsarr[$key]['projetrole']=$value['ppd_projectrole'];
            $promotorsarr[$key]['promsummary']=$value['ppd_promsummary'];
            $promotorsarr[$key]['others']=$value['ppd_others'];
        }
        }
        }else{
        $promotorsarr=[];  
        }
        
        
        $fundpk=$projtmp['projfundpk'];
        $otherfund=$projtmp['projotherfund'];
        if($fundpk!='' && $fundpk!=null){
        $funddtls = \api\modules\pd\models\ProjfundmstTbl::find()
                ->select(['group_concat(pfm_fundedby) as projfundby'])
                ->where("projfundmst_pk IN ($fundpk)")
                ->asArray()->all();
        $projtmp['fundedby']=$funddtls[0]['projfundby'];
//echo "<pre>";
//print_r($projtmp);
//exit;
        }
        
        
        $projfaqtemp= \api\modules\pd\models\ProjfaqtmpTbl::find()->select('pft_question as question,pft_answer as answer')->where("pft_projecttmp_fk =:pk",[':pk'=> $this->projectpk])->asArray()->all();
        
        $shortlistedcnt = \api\modules\pd\models\ProjshortlistTbl::find()
        ->select(['*'])
        ->where("prjsl_status=:stat",array(':stat' =>  1))
        ->andWhere('prjsl_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput($this->projectpk,"number")))
        ->count();
        $eoiformcnt = \api\modules\pd\models\ProjeoisubdtlsTbl::find()
        ->select(['*'])   
        ->where('presd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput($this->projectpk,"number")))
        ->count();
        $diligenceformcnt = \api\modules\pd\models\ProjdilsubdtlsTbl::find()
        ->select(['*'])
        ->andWhere('prdsd_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput($this->projectpk,"number")))
        ->count();
        $declareinvcnt = \api\modules\pd\models\ProjinvestmentdtlsTbl::find()
        ->select(['*'])   
        ->where('pind_status<>:status',array(':status' =>  2))
        ->andWhere('pind_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput($this->projectpk,"number")))
        ->count();
        $investedcnt = \api\modules\pd\models\ProjinvestmentdtlsTbl::find()
        ->select(['*'])   
        ->where('pind_status<>:status',array(':status' =>  4))
        ->andWhere('pind_projectdtls_fk=:pk',array(':pk' =>  Security::sanitizeInput($this->projectpk,"number")))
        ->count();
        
//        Marketing collatreals video
        
        $Supportcollateraldtls = \common\models\SupportcollateraldtlsTbl::fetchScprojectvideo(Security::sanitizeInput($this->projectpk,"number"), 5, 1, \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true));

        foreach ($Supportcollateraldtls as $key => $value) {
            if (strpos($value['scVideo'], 'youtube') > 0) {
                // $Supportcollateraldtls[$key]['scVideo'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe  frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" height=\"500\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$value['scVideo']);
                $Supportcollateraldtls[$key]['scVideo'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "www.youtube.com/embed/$1", $value['scVideo']);
            } else {
                $Supportcollateraldtls[$key]['scVideo'] = preg_replace("/\s*[a-zA-Z\/\/:\.]*vimeo.com\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "player.vimeo.com/video/$1", $value['scVideo']);
            }
        }
        
//        Marketing collatreals images
        $Supportcollateraldtlsimg = \common\models\SupportcollateraldtlsTbl::fetchScprojectvideo(Security::sanitizeInput($this->projectpk,"number"), 7, 1, \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true));
        foreach ($Supportcollateraldtlsimg as $key => $value) {
            if (!empty($value)) {
                $Supportcollateraldtlsimg[$key] = ['imagePath' => Drive::generateUrl($value, \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true), $loggedin_user, $track), 'imagePk' => $value['scDoc']];
            }
        }
        
//        Investment video
        if(!empty($projtmp['invvideo']))   
        {
        $invvideoArray = explode(',', $projtmp['invvideo']);            
        }
        foreach ($invvideoArray as $key => $value) {
            if (strpos($value, 'youtube') > 0) {
                $invvideoArray[$key] = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "www.youtube.com/embed/$1", $value);
            } else {
                $invvideoArray[$key] = preg_replace("/\s*[a-zA-Z\/\/:\.]*vimeo.com\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "player.vimeo.com/video/$1", $value);
            }
        }
        
//        Financial images
        if(!empty($projtmp['financialdocs'])){
        $financialimgs =  explode(',', $projtmp['financialdocs']);
        }
        foreach ($financialimgs as $key => $value) {
            $financialimgsDtls[$key] = ['imagePath' => Drive::generateUrl($value, \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true), $loggedin_user, $track), 'imagePk' => $value,'imgdtl' => Drive::getfiledetails($value,\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true))];
            $financialimgsDtls[$key]['imgdtl']['mcfd_actualfilesize']= self::formatSizeUnits($financialimgsDtls[$key]['imgdtl']['mcfd_actualfilesize']);
        }
        
        
        
//        Technical images
        if(!empty($projtmp['techdoc'])){
        $technicalimgs =  explode(',', $projtmp['techdoc']);
        }
        foreach ($technicalimgs as $key => $value) {
            $technicalimgsDtls[$key] = ['imagePath' => Drive::generateUrl($value, \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true), $loggedin_user, $track), 'imagePk' => $value,'imgdtl' => Drive::getfiledetails($value,\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true))];
            $technicalimgsDtls[$key]['imgdtl']['mcfd_actualfilesize']= self::formatSizeUnits($financialimgsDtls[$key]['imgdtl']['mcfd_actualfilesize']);
        }
        
        
        $data['shortlistedcnt']=$shortlistedcnt;
        $data['eoiformcnt']=$eoiformcnt;
        $data['diligenceformcnt']=$diligenceformcnt;
        $data['declareinvcnt']=$declareinvcnt;
        $data['investedcnt']=$investedcnt;
        $data['projectdtl']=$projtmp;
        $data['projectpartner']=$partnerarr;
        $data['projectpromoter']=$promotorsarr;
        $data['projfaq']=$projfaqtemp;
        $data['predefinedtags']=$predefinedtags;
        $data['accreditionsarr']=$accreditionsarr;
        $data['achivearr']=$achivearr;
        $data['acquirelic']=$acquirelicencearr;
        $data['requirelic']=$requirelicencearr;
        $data['projectteam']=$maindepart;
        $data['projecttcontact']=$maincontactdepart;
        $data['projectinviteinv']=$investor;
        $data['support_document']=$Supportcollateraldtls;
        $data['supportimg']=$Supportcollateraldtlsimg;
        $data['invvideoArray']=$invvideoArray;
        $data['financialimgsDtls']=$financialimgsDtls;
        $data['technicalimgsDtls']=$technicalimgsDtls;
        return $data;
         }
    }
    
    public function getmainprojectview()
    {
         $projmain = \api\modules\pd\models\ProjectdtlsTbl::find()
                ->select('prjd_projname as projectname,prjd_referenceno as referenceno,prjd_projectid as projectid,prjd_shortsummary as shortsummary,prjd_projdesc as projdesc,sectormst_tbl.SecM_SectorName as sectorname,industrymst_tbl.IndM_IndustryName as IndustryName,prjd_benefeat as benefeat,prjd_investorbenefits as investorbenefits,prjd_msgtoinvestors as msgtoinvestors,prjd_projtype as projtype,prjd_otherprojtype as otherprojtype,prjd_projcost as projcost, prjd_debt as debt,prjd_amtspentsofar as amtspentsofar,prjd_equity as equity,prjd_balanceamt as balanceamt,prjd_debtequratio as debtequratio,prjd_grant as grant,prjd_dateofinception as dateofinception,prjd_plannedprojstrtdt as plannedprojstrtdt,prjt_plannedprojenddt as plannedprojenddt,prjd_projstage as projstage,prjd_projdelayreason as projdelayreason,prjd_projscentralschememst_fk as projscentralschememst_fk,prjd_projcentralschemeothers as projcentralschemeothers,prjd_projstateschememst_fk as projstateschememst_fk,prjd_projstateschemeothers as projstateschemeothers,prjd_projstatus as projstatus,prjd_presentstatus as presentstatus,prjd_presentstatusothers as presentstatusothers,prjd_freezone as freezone,prjd_projzone as projzone,prjd_projzone as projzone,prjd_projzone as projzone,prjd_otherprojrequire as otherprojrequire,prjd_projfundmst_fk as projfundmst_fk,prjd_projotherfund as projotherfund,prjd_natureofprop as natureofprop,prjd_proptype as proptype,prjd_landarea as landarea,unitmst_tbl.unm_nameplu as unm_nameplu,prjd_ismarqueeproj as ismarqueeproj,prjd_issdgproj as issdgproj,prjd_sdgprojdesc as sdgprojdesc,prjd_projmodeofimplentmst_fk as projmodeofimplentmst_fk,prjd_otherimplementation as otherimplementation,prjd_projownership as projownership,prjd_addressline as addressline,prjd_latitude as latitude,prjd_longitude as longitude,statemst_tbl.SM_StateName_en as StateName,citymst_tbl.CM_CityName_en as CityName,prjd_memcompmplocationdtls_fk as memcompmplocationdtls_fk,prjd_projteam as projteam,prjd_contactinfo as contactinfo,prjd_projinvproced as projinvproced,prjd_licensauthoritiesmst_fk as licensauthoritiesmst_fk,prjd_website as website,prjd_socialmedia as socialmedia,prjd_finindicators as finindicators,prjd_roi as roi,prjd_riskfactors as riskfactors,prjd_riskdisclosures as riskdisclosures,prjd_projdiligenceform_fk as projdiligenceform_fk,prjd_financialdocs as financialdocs,prjd_interestfortender as interestfortender,prjd_predefinedtags as predefinedtags,prjd_selftags as selftags,projinvinfotmp_tbl.piid_totinvreqd as totinvreqd,projinvinfotmp_tbl.piid_totinvrecd as totinvrecd')
                ->leftJoin('sectormst_tbl','SectorMst_Pk=prjd_sectormst_fk')
                ->leftJoin('industrymst_tbl','IndustryMst_Pk=prjd_industrymst_fk')
                ->leftJoin('projinvinfotmp_tbl','piit_projecttmp_fk=projectdtls_pk')
                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=prjd_memberregmst_fk')
                ->leftJoin('statemst_tbl','StateMst_Pk=prjd_statemst_fk')
                ->leftJoin('citymst_tbl','CityMst_Pk=prjd_citymst_fk')
                ->leftJoin('projmodeofimplentmst_tbl','projmodeofimplentmst_pk=prjd_projmodeofimplentmst_fk')
                ->leftJoin('projdiligenceform_tbl','projdiligenceform_pk=prjd_projdiligenceform_fk')
                
                ->where('projectdtls_pk=:pk', array(':pk'=> \common\components\Security::sanitizeInput($this->projectpk,"number")))->asArray()->one();
          if(!empty($projmain)){
          $teamarr =  $projmain['projteam'] ;
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
        
//      Contact details
        $contactarr =  $projmain['contactinfo'] ;
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
//      Invite Investor details
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
        
        $data['projectdtl']=$projmain;
        $data['projectteam']=$team;
        $data['projecttcontact']=$contact;
        $data['projectinviteinv']=$investor;
        return $data;
    }
    
    }
    
    public static function getLiveProjectsCount() {
        return \api\modules\pd\models\ProjectdtlsTbl::find()
                ->select(['count(1) as projcount'])
                ->where(['prjd_projstatus' => 3])
                ->asArray()->one();
    }
    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
}
