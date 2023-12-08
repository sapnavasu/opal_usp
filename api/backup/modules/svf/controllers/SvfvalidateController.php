<?php

namespace api\modules\svf\controllers;

use yii;
use api\modules\mst\models\SectormstTbl;
use common\components\Configsession;
use common\components\Drive;
use common\components\Sessionn;
use common\models\MemcompbussrcdtlsTbl;
use common\models\MemcompprodbussrcmapTbl;
use common\models\MemcompproddtlsTbl;
use common\models\MemcompsectordtlsTbl;
use common\models\SuppcertformmembtmpTbl;
use common\models\SuppcertformpartrntmpTbl;
use common\models\SuppcertformcattmpTbl;
use common\models\SuppcertformtrntmpTbl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class SvfvalidateController extends SvfmasterController
{
    public $modelClass = '';
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
    public function actions()
    {
        return [];
    }
    public function beforeAction($action)
    {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();
        try {
            return parent::beforeAction($action);
        }
        catch (BadRequestHttpException $e){}
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;

        return $behaviors;
    }
    public function actionValidatescf()
    {
        $request_body = file_get_contents('php://input');
        $dataa = json_decode($request_body, true);
        $declineType=strtoupper($_GET['declinetype']);
        switch ($declineType) {
            case "F":
                $data= SuppcertformmembtmpTbl::validateformlevel();
                break;
            case "CT":
                $data= SuppcertformmembtmpTbl::validatecategorywise($dataa);
                break;
            case "SCT":
                $data= SuppcertformmembtmpTbl::validatesubcategorywise($dataa);
                break;
            case "P":
                $data=  SuppcertformmembtmpTbl::validateparameterwise($dataa);
                break;
            case "PPV":
                    $data = SuppcertformmembtmpTbl::validateparameterwisewithParmno($dataa);
                break;
            case "BPSP":
                $data=  SuppcertformmembtmpTbl::validatebusinesssrcprdserv($dataa['scfformdata']);
                break;
            case "PSBV":
                $data=  SuppcertformmembtmpTbl::validateoverallprdserv($dataa['scfformdata']); 
                break;
            default:
                echo "not valid input";
        }
        return $this->asJson($data);
    }
    public function actionValidateprimaryscf()
    {
        $validateuserpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $Validatedata=$data['scfformdata'];
        $companypk = $Validatedata['compid'];    
        if(!empty($Validatedata)){
            if(!empty($companypk)){
                $SuppMemtbl=SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=2 and scfmt_membercompmst_fk=:company',
                [':company'=>$companypk])->one();
                if(!empty($SuppMemtbl)){
                    if($Validatedata['status'] == 'D'){
//                        category wise check whether any declined item is there or not 
                        $iscategalldeclined = SuppcertformcattmpTbl::find()
                                ->where('scfct_suppcertformmembtmp_fk=:memtmp and scfct_status = 3 ',
                                [':memtmp'=>$SuppMemtbl->suppcertformmembtmp_pk])->count();
//                        Sub  category wise check whether any declined item is there or not 
                        $issubcategalldeclined = SuppcertformtrntmpTbl::find()
                                ->leftJoin('suppcertformcattmp_tbl','suppcertformcattmp_pk=scftt_suppcertformcattmp_fk')
                                ->where('scfct_suppcertformmembtmp_fk=:memtmp and scftt_status = 3 and scftt_isdeleted=2',
                                [':memtmp'=>$SuppMemtbl->suppcertformmembtmp_pk])->count();
//                        parameter wise check whether any declined item is there or not 
                        $isparamalldeclined = SuppcertformpartrntmpTbl::find()
                        ->where('scfptt_membercompmst_fk=:company and scfptt_scfstatus=4',
                            [':company'=>$companypk])->count();
                        if($iscategalldeclined== 0 && $issubcategalldeclined == 0 && $isparamalldeclined ==0){
                             $returnval['validatests'] = 1; // Please select decline for at least one category / sub-category / parameter internally to proceed with the final decline
                              $returnval['dataval'] = $SuppMemtbl;     
                        }else{
                            $SuppMemtbl->scfmt_isprivalid = 1;
                            $SuppMemtbl->scfmt_privalidstatus = 2;
                            $SuppMemtbl->scfmt_privalidcomment = $Validatedata['comment'];
                            $SuppMemtbl->scfmt_privalidon = date('Y-m-d H:i:s');
                            $SuppMemtbl->scfmt_privalidby = $validateuserpk;
                            if($SuppMemtbl->save(false)){
                                $returnval['validatests'] = 2; // form declined successfully
                            }
                        }
                    } elseif($Validatedata['status'] == 'A'){
//                        category wise check whether any declined item is there or not 
                        $iscategallapproved = SuppcertformcattmpTbl::find()
                                 ->leftJoin('bgivaldoccatmst_tbl','bgivaldoccatmst_pk=scfct_bgivaldoccatmst_fk')
                                ->where('scfct_suppcertformmembtmp_fk=:memtmp and scfct_status = 3 and scfct_bgivaldoccatmst_fk != 4',
                                [':memtmp'=>$SuppMemtbl->suppcertformmembtmp_pk])
                                ->orderBy('bvdcm_orderindex')
                                ->all();
//                       Sub  category wise check whether any declined item is there or not 
                       $issubcategallapproved=   Yii::$app->db->createCommand("select catg.scfct_bgivaldoccatmst_fk,subcat.suppcertformtrntmp_pk from suppcertformtrntmp_tbl as                                           subcat left join suppcertformcattmp_tbl as catg on catg.suppcertformcattmp_pk=subcat.scftt_suppcertformcattmp_fk
                                         left join bgivaldoccatmst_tbl as mstcat on mstcat.bgivaldoccatmst_pk=catg.scfct_bgivaldoccatmst_fk
                                         where scfct_suppcertformmembtmp_fk=:memtmp and scftt_status = 3 and scfct_bgivaldoccatmst_fk != 4 order by bvdcm_orderindex asc   ")
                                        ->bindValue(':memtmp', $SuppMemtbl->suppcertformmembtmp_pk)->queryAll();
//                        parameter wise check whether any declined item is there or not 
                        $isparamallapproved = SuppcertformpartrntmpTbl::find()
                         ->leftJoin('bgivaldoccatmst_tbl','bgivaldoccatmst_pk=scfptt_bgivaldoccatmst_fk')
                         ->where('scfptt_membercompmst_fk=:company and scfptt_scfstatus=4 and  scfptt_bgivaldocsubcatmst_fk  NOT IN (114,115)',
                          [':company'=>$companypk]) 
                        ->orderBy('bvdcm_orderindex')
                        ->all();
    //                    Checking whether atleast one Product/service is approved
                        $isproductorserapproved = SuppcertformpartrntmpTbl::find()
                        ->where('scfptt_membercompmst_fk=:company and scfptt_scfstatus=3 and  scfptt_bgivaldocsubcatmst_fk   IN (114,115)',
                            [':company'=>$companypk])->count();
                        
                        if(!empty($iscategallapproved) && count($iscategallapproved) > 0 || !empty($issubcategallapproved) && count($issubcategallapproved) > 0 || !empty($isparamallapproved) && count($isparamallapproved) > 0 ){             
                            if(count($iscategallapproved) > 0){
                                $categoryid = $iscategallapproved[0]['scfct_bgivaldoccatmst_fk'];
                            }elseif(count($issubcategallapproved) > 0){
                                $categoryid = $issubcategallapproved[0]['scfct_bgivaldoccatmst_fk'];
                            }elseif(count($isparamallapproved) > 0){
                                $categoryid = $isparamallapproved[0]['scfptt_bgivaldoccatmst_fk'];
                            }
                            $returnval['categoryid'] = $categoryid; // Category pk which has declined
                            $returnval['validatests'] = 3; //You have Declined item(s). Kindly Validate the Declined item(s) and then do the Overall Approval
//                            $returnval['dataval'] = $SuppMemtbl;
                        }elseif($isproductorserapproved == 0 ){
                            $returnval['categoryid'] = 4;  // product and services category PK
                            $returnval['validatests'] = 4; //Kindly Approve at least one Product / Service
//                            $returnval['dataval'] = $SuppMemtbl;
                        }else{
                            $SuppMemtbl->scfmt_isprivalid = 1;
                            $SuppMemtbl->scfmt_privalidstatus = 1;
                            $SuppMemtbl->scfmt_privalidcomment = $Validatedata['comment'];
                            $SuppMemtbl->scfmt_privalidon = date('Y-m-d H:i:s');
                            $SuppMemtbl->scfmt_privalidby = $validateuserpk;
                            if($SuppMemtbl->save(false)){                                
                                $returnval['validatests'] = 5; // form approved     
                            }
                        }
                    }
                }
            }
        }        
        $returnval['dataval'] = $SuppMemtbl;   
        return $returnval;
    }
    public function actionProductdata(){
        $sqlPrd="SELECT distinct MCPrD_MemberCompMst_Fk,MemCompProdDtls_Pk,MCPrD_DisplayName,
                memcompprodbussrcmap_tbl.mcpbsm_memcompbussrcdtls_fk,mcprd_prodrefno,mcprd_prodmodelno,PrdM_ProductName,PrdM_ProductCode,MCPrD_NationalProdStatus,
                mcor_overallrating, mcor_ratingcount ,mcor_reviewcount,mcprd_prodviewcount,MCPrD_CreatedOn,MCPrD_UpdatedOn,
                memcompbussrcdtls_tbl.mcbsd_businesssourcemst_fk,mcprd_prodcoverimgfile,memcompfiledtls_pk,mcprd_prodcoverimgfile,
                businesssourcemst_tbl.bsm_bussrcname,businesssourcemst_pk,SecM_SectorCode, SecM_SectorName as unitsector,mcbsd_others,
                mcfd_memcompmst_fk,mcfd_uploadedby,memcompfiledtls_pk,
                memcompbussrcdtls_tbl.mcbsd_refname,memcompbussrcdtls_pk,mcmppd_permitdateofissue,mcmppd_permitdateofexpiry,mcmppd_permitfile,MCPrD_SVFAdminApprovalStatus,
                CASE WHEN MCPrD_CreatedOn is null THEN 'Incomplete' 
                    WHEN `MCPrD_SVFAdminApprovalStatus`='N' THEN 'New' 
                      WHEN `MCPrD_SVFAdminApprovalStatus`='U' THEN 'New' 
                    WHEN `MCPrD_SVFAdminApprovalStatus`='A' THEN
                 'Approved' WHEN MCPrD_SVFAdminApprovalStatus='D' THEN 'Declined' END as status
              FROM memcompproddtls_tbl
              left join memcompprodbussrcmap_tbl on MemCompProdDtls_Pk=memcompprodbussrcmap_tbl.mcpbsm_memcompproddtls_fk 
              left join memcompbussrcdtls_tbl on mcpbsm_memcompbussrcdtls_fk=memcompbussrcdtls_tbl.memcompbussrcdtls_pk
              left join businesssourcemst_tbl on businesssourcemst_tbl.businesssourcemst_pk=mcbsd_businesssourcemst_fk
              left join memcompmppermitdtls_tbl on mcmppd_memcompbussrcdtls_fk=memcompbussrcdtls_pk  
              left join memcompoverallreview_tbl on mcor_shared_fk=MemCompProdDtls_Pk and mcor_type = 1
              left join productmst_tbl on MCPrD_ProductMst_Fk = productmst_pk 
              left join memcompsectordtls_tbl on mcbsd_memcompsecdtls_fk=MemCompSecDtls_Pk
              left join sectormst_tbl  on MCSD_SectorMst_Fk=SectorMst_Pk 
              left Join memcompfiledtls_tbl on  memcompfiledtls_pk=mcprd_prodcoverimgfile
WHERE `MemCompProdDtls_Pk` in (1455,1425,1459,1372,1439,1413,1302,1433,1303,1432,1460,1341,1475)
ORDER BY `memcompbussrcdtls_tbl`.`mcbsd_refname` ASC";

        $RunPrdResult=\Yii::$app->db->createCommand($sqlPrd)->queryAll();
      // echo "<pre>";print_r($RunPrdResult);die;
      $FinalResult=[];
      $tempkey=0;
      $tempref='';
        foreach ($RunPrdResult as $key =>$val){

            $FinalResult['drp_businesssource'][$key]['label']= $val['bsm_bussrcname'];
            $FinalResult['drp_businesssource'][$key]['value']= $val['businesssourcemst_pk'];
            $FinalResult['drp_businesssource_name'][$key]['label']= $val['mcbsd_refname'];
            $FinalResult['drp_businesssource_name'][$key]['value']= $val['memcompbussrcdtls_pk'];

           // $FinalResult[$val['mcbsd_refname']][]=$val;
            if($tempref =='' || $tempref !=$val['mcbsd_refname']){
                $tempkey=0;
                $tempref=$val['mcbsd_refname'];
            }

            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_MemberCompMst_Fk"]=$val['MCPrD_MemberCompMst_Fk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MemCompProdDtls_Pk"]=$val['MemCompProdDtls_Pk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_DisplayName"]=$val['MCPrD_DisplayName'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcpbsm_memcompbussrcdtls_fk"]=$val['mcpbsm_memcompbussrcdtls_fk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcprd_prodrefno"]=$val['mcprd_prodrefno'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcprd_prodmodelno"]=$val['mcprd_prodmodelno'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["PrdM_ProductName"]=$val['PrdM_ProductName'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["PrdM_ProductCode"]=$val['PrdM_ProductCode'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_NationalProdStatus"]=$val['MCPrD_NationalProdStatus'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcor_overallrating"]=$val['mcor_overallrating'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcor_ratingcount"]=$val['mcor_ratingcount'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcor_reviewcount"]=$val['mcor_reviewcount'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcprd_prodviewcount"]=$val['mcprd_prodviewcount'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_CreatedOn"]=$val['MCPrD_CreatedOn'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_UpdatedOn"]=$val['MCPrD_UpdatedOn'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcbsd_businesssourcemst_fk"]=$val['mcbsd_businesssourcemst_fk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcprd_prodcoverimgfile"]=$val['mcprd_prodcoverimgfile'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["bsm_bussrcname"]=$val['bsm_bussrcname'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["businesssourcemst_pk"]=$val['businesssourcemst_pk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["SecM_SectorCode"]=$val['SecM_SectorCode'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["unitsector"]=$val['unitsector'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcbsd_others"]=$val['mcbsd_others'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcbsd_refname"]=$val['mcbsd_refname'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["memcompbussrcdtls_pk"]=$val['memcompbussrcdtls_pk'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcmppd_permitdateofissue"]=$val['mcmppd_permitdateofissue'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcmppd_permitdateofexpiry"]=$val['mcmppd_permitdateofexpiry'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["mcmppd_permitfile"]=$val['mcmppd_permitfile'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["MCPrD_SVFAdminApprovalStatus"]=$val['MCPrD_SVFAdminApprovalStatus'];
            $FinalResult[$val['mcbsd_refname']][$tempkey]["status"]=$val['status'];

            $FinalResult[$val['mcbsd_refname']][$tempkey]["imageurl"]== Drive::generateUrl($val['mcprd_prodcoverimgfile'], $val['mcfd_memcompmst_fk'], $val['mcfd_uploadedby']);
            $tempkey++;


           // $FinalResult[$val['mcbsd_refname']][]=$val;

        }

        $list_DRp_BusS = [];
        foreach ( $FinalResult['drp_businesssource'] as $item ) {
            isset($list_DRp_BusS[$item['label']]) or $list_DRp_BusS[$item['value']] = $item;
        }

        $list_DRp_BusS_Name = [];
        foreach ( $FinalResult['drp_businesssource_name'] as $item ) {
            isset($list_DRp_BusS_Name[$item['label']]) or $list_DRp_BusS_Name[$item['value']] = $item;
        }
       $FinalCumlativeArr=[
           'drp_bus'=>array_values($list_DRp_BusS),
           'drp_bus_name'=>array_values($list_DRp_BusS_Name),
           'validationdata'=>$FinalResult
           ];
       unset($FinalCumlativeArr['validationdata']['drp_businesssource_name']);
        unset($FinalCumlativeArr['validationdata']['drp_businesssource']);
      return $this->asJson($FinalCumlativeArr);
    }
    public function actionServicedata(){
        $sqlServ="SELECT distinct MemCompServDtls_Pk,MCSvD_MemberCompMst_Fk,MCSvD_DisplayName,memcompservbussrcmap_tbl.memcompservbussrcmap_pk,
       memcompbussrcdtls_pk,memcompbussrcdtls_tbl.mcbsd_uid,memcompbussrcdtls_tbl.mcbsd_refname,businesssourcemst_tbl.bsm_bussrcname,
       businesssourcemst_tbl.businesssourcemst_pk,memcompbussrcdtls_tbl.memcompbussrcdtls_pk,bsm_bussrcname as bstype,
       MCSvD_ServiceMst_Fk, CONCAT(SrvM_ServiceCode,'-',SrvM_ServiceName) as service,SrvM_ServiceName,
       COALESCE(mcsvd_servmodelno,'NA') as mcsvd_servmodelno,MCSvD_DisplayName,SecM_SectorCode,
                 SrvM_ServiceCode, COALESCE(mcsvd_servrefno,'NA') as mcsvd_servrefno,MCSvD_CreatedOn,MCSvD_UpdatedOn,
                MCSvD_SVFAdminApprovalStatus,mcfd_sysgenerfilename,mcfd_memcompmst_fk,mcfd_filemst_fk,
            memcompfiledtls_pk,mcfd_uploadedby,mcsvd_servcoverimgfile ,
                mcor_overallrating as starCount, mcor_ratingcount as ratingCount,mcbsd_others,mcsvd_servviewcount,
            mcor_reviewcount as reviewCount,
                CASE 
            WHEN MCSvD_CreatedOn is null THEN  'Incomplete'
            WHEN  MCSvD_SVFAdminApprovalStatus is null THEN 'Yettoapply'  
            WHEN MCSvD_SVFAdminApprovalStatus='N'   THEN 'New' 
             WHEN `MCSvD_SVFAdminApprovalStatus`='A'  THEN 'Approved' 
             WHEN `MCSvD_SVFAdminApprovalStatus`='U'  THEN 'Updated' 
             WHEN `MCSvD_SVFAdminApprovalStatus`='D'  THEN 'Declined' END as servicestatus
FROM `memcompservicedtls_tbl`
left join memcompservbussrcmap_tbl on MemCompServDtls_Pk=memcompservbussrcmap_tbl.mcsbsm_memcompservdtls_fk 
left join memcompbussrcdtls_tbl on mcsbsm_memcompbussrcdtls_fk=memcompbussrcdtls_tbl.memcompbussrcdtls_pk
left join businesssourcemst_tbl on  mcbsd_businesssourcemst_fk=businesssourcemst_tbl.businesssourcemst_pk 
left join servicemst_tbl on MCSvD_ServiceMst_Fk = servicemst_pk
left Join memcompsectordtls_tbl on mcbsd_memcompsecdtls_fk=MemCompSecDtls_Pk   
left Join sectormst_tbl on MCSD_SectorMst_Fk=SectorMst_Pk  
left join industrymst_tbl on IndM_SectorMst_Fk =  SectorMst_Pk                     
left Join activitiesmst_tbl on ActM_IndustryMst_Fk = IndustryMst_Pk
left Join memcompoverallreview_tbl on mcor_shared_fk=MemCompServDtls_Pk and mcor_type = 2 
left join memcompfiledtls_tbl on memcompfiledtls_pk=mcsvd_servcoverimgfile
WHERE `MemCompServDtls_Pk` IN (565,608,558)  
ORDER BY `memcompbussrcdtls_tbl`.`mcbsd_refname`  DESC";

        $RunservResult=\Yii::$app->db->createCommand($sqlServ)->queryAll();

        $FinalResult=[];
        $tempkey=0;
        $tempref='';

    foreach ($RunservResult as $key =>$val){

        $FinalResult['drp_businesssource'][$key]['label']= $val['bsm_bussrcname'];
        $FinalResult['drp_businesssource'][$key]['value']= $val['businesssourcemst_pk'];
        $FinalResult['drp_businesssource_name'][$key]['label']= $val['mcbsd_refname'];
        $FinalResult['drp_businesssource_name'][$key]['value']= $val['memcompbussrcdtls_pk'];

        // $FinalResult[$val['mcbsd_refname']][]=$val;
        if($tempref =='' || $tempref !=$val['mcbsd_refname']){
            $tempkey=0;
            $tempref=$val['mcbsd_refname'];
        }

        $FinalResult[$val['mcbsd_refname']][]=$val;
    }

        $list_DRp_BusS = [];
        foreach ( $FinalResult['drp_businesssource'] as $item ) {
            isset($list_DRp_BusS[$item['label']]) or $list_DRp_BusS[$item['value']] = $item;
        }

        $list_DRp_BusS_Name = [];
        foreach ( $FinalResult['drp_businesssource_name'] as $item ) {
            isset($list_DRp_BusS_Name[$item['label']]) or $list_DRp_BusS_Name[$item['value']] = $item;
        }
        $FinalCumlativeArr=[
            'drp_bus'=>array_values($list_DRp_BusS),
            'drp_bus_name'=>array_values($list_DRp_BusS_Name),
            'validationdata'=>$FinalResult
        ];
        unset($FinalCumlativeArr['validationdata']['drp_businesssource_name']);
        unset($FinalCumlativeArr['validationdata']['drp_businesssource']);
        return $this->asJson($FinalCumlativeArr);
    }
    public function actionDelink(){
        $product=4;
        $memcompservbussrcmap_pk=2;
        $memcompbussrcdtls_pk=2;
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $BusMapTbl=MemcompprodbussrcmapTbl::find()->where('mcpbsm_memcompproddtls_fk=:prd', [':prd'=>$product])->all();
        if(count($BusMapTbl)==1){
            $BusMapTbl=MemcompprodbussrcmapTbl::find()->where(
                'mcpbsm_memcompproddtls_fk=:prd and mcpbsm_memcompbussrcdtls_fk=:dtail',
                [':prd'=>$product,':dtail'=>$memcompbussrcdtls_pk])->one();
            $BusDtTbl=MemcompbussrcdtlsTbl::findOne($BusMapTbl->mcpbsm_memcompbussrcdtls_fk);
            $BusDtTbl->delete();
            $BusMapTbl->delete();
            $SuppCertFormPartTempTbl=SuppcertformpartrntmpTbl::deleteAll('scfptt_bgivaldocsubcatpardtls_fk=:param and 
        scfptt_membercompmst_fk=:company and scfptt_paramvalue=:pval',
                [':param'=>405,':company'=>$company_id,':pval'=>$product]);
            $PrdDtlsModel=MemcompproddtlsTbl::findOne($product);
            $PrdDtlsModel->MCPrD_CreatedOn=null;
            $PrdDtlsModel->save(false);
        }else{
            $BusMapTbl=MemcompprodbussrcmapTbl::find()->where(
                'mcpbsm_memcompproddtls_fk=:prd and mcpbsm_memcompbussrcdtls_fk=:dtail',
                [':prd'=>$product,':dtail'=>$memcompbussrcdtls_pk])->one();
            $BusDtTbl=MemcompbussrcdtlsTbl::findOne($BusMapTbl->mcpbsm_memcompbussrcdtls_fk);
            $BusDtTbl->delete();
            $BusMapTbl->delete();
        }
        return $this->asJson(['msg'=>'Delink Successfully','Flag'=>"S"]);
    }
    
    public function actionGetvalidationovercount() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $compk = \common\components\Security::decrypt($data['compk']);
        $formpk = $data['formid'];
        $getvalidatedcount = \api\modules\mst\models\CertcatsubcatapprovaldtlsTblQuery::getvalidatedcount($compk, $formpk);
        return $getvalidatedcount;
    }

    public function actionMovetonxtuser() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data['compkarr'] = \common\components\Security::decrypt($data['compkarr']);
        $data['catsubcatPkarr'] = \common\components\Security::decrypt($data['catsubcatPkarr']);
        $compkarr = explode(",", $data['compkarr']);
        $catsubcatPkarr = explode(",", $data['catsubcatPkarr']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $formpk = $data['formid'];
        $levelresult = \api\modules\mst\models\ApprovalworkflowuserconfigTblQuery::getleveldata($formpk, $userPK, $compkarr, $catsubcatPkarr);
        return $levelresult;
    }

    public function actionRegeneratecertificate(){
       $compk = \common\components\Security::decrypt($_REQUEST['compid']);
       $formid =  \common\components\Security::sanitizeInput($_REQUEST['formid'],"number"); 
       $returndata = \common\components\Suppcertform::generatecertificate($compk,$formid);
       $cumulativeArr=[
            'status'=>200,
            'msg'=>'S',
            'data'=>$returndata
        ];
        return $this->asJson($cumulativeArr);
    }
}
