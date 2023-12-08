<?php

namespace console\controllers;

use common\models\MemcompoverallreviewTbl;
use common\models\MemcompreviewdtlsTbl;
use Yii;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;


class LypiscronController extends Controller
{
    public function actionGetbizdashboardcount(){
        $json_path = dirname(__DIR__).'/../lypis/src/assets/bizcount.json';
        $countResult = \Yii::$app->db->createCommand("select 
count(MemberCompMst_Pk) as 'Company'
,count(distinct MCPrD_ProductMst_Fk) as 'Products'
,count(distinct MCSvD_ServiceMst_Fk) as 'Services'
,count(distinct MCSAD_ActivitiesMst_Fk) as 'Activities'
,count(distinct MCM_Source_CountryMst_Fk) 'Country'
from membercompanymst_tbl mcm
left join memberregistrationmst_tbl mrm on mrm.MemberRegMst_Pk=mcm.MCM_MemberRegMst_Fk 
left join memcompproddtls_tbl mcprd on mcprd.MCPrD_MemberCompMst_Fk=mcm.MemberCompMst_Pk and MCPrD_SVFAdminApprovalStatus='A'
left join productmst_tbl pm on pm.ProductMst_Pk=mcprd.MCPrD_ProductMst_Fk and pm.PrdM_Status='A'
left join memcompservicedtls_tbl mcsvd on mcsvd.MCSvD_MemberCompMst_Fk=mcm.MemberCompMst_Pk and MCSvD_SVFAdminApprovalStatus='A'
left join servicemst_tbl sm on sm.ServiceMst_Pk=mcsvd.MCSvD_ServiceMst_Fk and sm.SrvM_Status='A'
left join memcompsectordtls_tbl mcsd on mcsd.MCSD_MemberCompMst_Fk=mcm.MemberCompMst_Pk
left join memcompsectoractivitydtls_tbl mcsad on mcsad.MCSAD_MemCompSecDtls_Fk =
mcsd.MemCompSecDtls_Pk
where mrm.MRM_MemberStatus='A' and mrm_stkholdertypmst_fk=6;")->queryOne();
        if($countResult!=''){
            $jsonFormat = json_encode($countResult);
            if(file_put_contents($json_path, $jsonFormat)){
                
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function actionGetbizsearchdashboardcount(){
        echo'<pre>';print_r('condition');exit;
        $json_path = dirname(__DIR__).'/../lypis/src/assets/bizcount.json';
        $countResult = \Yii::$app->db->createCommand("SELECT (SELECT COUNT(UserMst_Pk) as userCount FROM `usermst_tbl` WHERE (`UM_MemberRegMst_Fk`='1') AND (`UM_Status`='A') AND (`UM_Type`='U')) AS `userCount`, (SELECT COUNT(MemCompSecDtls_Pk) as businessUnitCount FROM `memcompsectordtls_tbl` WHERE `MCSD_MemberCompMst_Fk`='1') AS `businessUnitCount`, (SELECT COUNT(UserMst_Pk) as logCount FROM `usermst_tbl` INNER JOIN `usermonitorlog_tbl` ON uml_usermst_fk = UserMst_Pk WHERE (`UM_MemberRegMst_Fk` IS NULL) AND (`UM_Status`='A') AND (`UM_Type`='U')) AS `logCount`, (SELECT COUNT(MemCompProdDtls_Pk) as productCount FROM `memcompproddtls_tbl` WHERE `MCPrD_MemberCompMst_Fk`='1') AS `productCount`, (SELECT COUNT(MemCompServDtls_Pk) as serviceCount FROM `memcompservicedtls_tbl` WHERE `MCSvD_MemberCompMst_Fk`='1') AS `serviceCount`, (SELECT COUNT(memcompmplocationdtls_pk) as marketPresenceCount FROM `memcompmplocationdtls_tbl` WHERE (`mcmpld_membercompmst_fk`='1') AND (`mcmpld_locationtype` IN (1, 2, 3, 4, 6, 7, 8, 11, 12))) AS `marketPresenceCount` FROM `membercompanymst_tbl` WHERE `MemberCompMst_Pk`='1'")->queryOne();
        if($countResult!=''){
            $jsonFormat = json_encode($countResult);
            if(file_put_contents($json_path, $jsonFormat)){
                
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

	public function actionOverallreviewcalculation($shared,$type,$operation,$reviewpk){
        $model=new MemcompoverallreviewTbl();
        $model->mcor_type=1;
        $model->mcor_shared_fk=460;
        $model->mcor_ratingcount=5;
        $model->mcor_overallrating=5;
        $model->mcor_reviewcount=5;
        $model->save(false);

        /*$memcalModel=MemcompoverallreviewTbl::find()->where('mcor_shared_fk=:shared and mcor_type=:type',
            [':shared'=>$shared,':type'=>$type])->one();
        $ratingModel=MemcompreviewdtlsTbl::findOne($reviewpk);
        if($operation=='update'){
            if(!empty($ratingModel)){
                if(empty($ratingModel->mcrd_comment)){
                    $memcalModel->mcor_reviewcount=$memcalModel->mcor_reviewcount-1;
                }
                $memcalModel->mcor_ratingcount=$memcalModel->mcor_ratingcount-1;
                $memcalModel->mcor_overallrating=$memcalModel->mcor_overallrating-$ratingModel->mcrd_rating;
                $memcalModel->save(false);
            }
        }
        $ratingcount=$memcalModel->mcor_overallrating+$ratingModel->mcrd_rating;
        if(empty($memcalModel)){
            $memcalModel=new MemcompoverallreviewTbl();
            $memcalModel->mcor_overallrating=$ratingcount;
        }
        else{
            $memcalModel->mcor_overallrating=$ratingcount/2;
        }
        if(!empty($ratingModel->mcrd_comment)){
            $memcalModel->mcor_reviewcount=$memcalModel->mcor_reviewcount+11;
        }

        $memcalModel->mcor_shared_fk=$shared;
        $memcalModel->mcor_type=$type;
        $memcalModel->mcor_reviewcount=$memcalModel->mcor_reviewcount+1;
        $memcalModel->save(false);*/

    }
}
