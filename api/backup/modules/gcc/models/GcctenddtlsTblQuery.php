<?php

namespace api\modules\gcc\models;


use Yii;

/**
 * This is the ActiveQuery class for [[GcctenddtlsTbl]].
 *
 * @see GcctenddtlsTbl
 */
class GcctenddtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GcctenddtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GcctenddtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function getlist($catId,$lim,$off,$catTendPk){
       
        $CompPK =\yii\db\ActiveRecord::getTokenData("MemberCompMst_Pk",true); //1439
       $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);//1467;
        $MembRegPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);//1467;
      //exit;
       $secid = $catId;
       $baseUrl = \Yii::$app->params['APP_URL'];
        if(empty($lim)) 
        $lim=10;
        $limit = "Limit $lim";
        if(!empty($off))
        $limit .= " OFFSET $off";
        
        $gccTendsectorsubsdtls = Yii::$app->db->createCommand("select * from gcctendsectorsubsdtls_tbl 
            left join gcctendsubsdtls_tbl on gtssd_gcctendsubsdtls_fk = gcctendsubsdtls_pk where   gtssd_gcctendsectmst_fk =$secid and gcctendsectorsubsdtls_pk= $catTendPk")->queryAll();
            //print_r($gccTendsectorsubsdtls[0]['gcctendsectorsubsdtls_pk'] );  
            
            if(!empty($gccTendsectorsubsdtls) && count($gccTendsectorsubsdtls)!= 0){
            $cattId = $gccTendsectorsubsdtls[0]['gcctendsectorsubsdtls_pk'];
             $sectorMasterPkDtl =Yii::$app->db->createCommand("select gtssd_gcctendsectmst_fk from gcctendsectorsubsdtls_tbl  where gcctendsectorsubsdtls_pk= $cattId")->queryAll();
            }
           //  print_r($sectorMasterPkDtl);  exit;
            if(!empty($sectorMasterPkDtl) && count($sectorMasterPkDtl) != 0){
          $sectorMstPk = $sectorMasterPkDtl[0]['gtssd_gcctendsectmst_fk'];
            } 
            $gccTenderSubId =  \Yii::$app->db->createCommand("select * from gcctendsubsdtls_tbl where gtsd_membcompmst_fk= $CompPK");
            $gccTenderSubId = $gccTenderSubId->queryAll();
              //print_r($gccTenderSubId);  exit;
             $subcountry = $gccTenderSubId[0]['gtsd_subscribedcountries'];
             $suntdpk = $gccTenderSubId[0]['gcctendsubsdtls_pk'];
           
           
            //--
            if (!empty($catId) && !empty($suntdpk) && count($suntdpk) !=0)
            {
               if (!empty($suntdpk)) {
                    $sectorMst = \Yii::$app->db->createCommand("select GROUP_CONCAT(DISTINCT gcctendsectorsubsdtls_pk) as gcctendsectorsubsdtls_pk from gcctendsectorsubsdtls_tbl WHERE gtssd_gcctendsubsdtls_fk=$suntdpk AND (if(gtssd_subscriptionstatus IN(4,5,6,9) AND (gtssd_subscribedto > now()) ,1,if(gtssd_subscriptionstatus IN (3,7) ,1,0)))")->queryAll();
                    
                   
                   $sectorString = $sectorMst[0]['gcctendsectorsubsdtls_pk'];
                  // print_r( $sectorString );exit;
                    if (!empty($sectorString) && count($sectorString)!= 0) {
                        $cpvSub =  \Yii::$app->db->createCommand("select GROUP_CONCAT(DISTINCT gtcsd_gcctendcpvmst_fk) as gtcsd_gcctendcpvmst_fk from  gcctendcpvsubsdtls_tbl where gtcsd_gcctendsubsdtls_fk= $suntdpk AND gtcsd_gcctendsectorsubsdtls_fk IN ({$sectorString})")->queryAll();
                        $cpvString = $cpvSub[0]['gtcsd_gcctendcpvmst_fk'];
                    }
                    }
                } else {
            if (!empty($suntdpk) && count($suntdpk) !=0)
                 {
                    $cpvSub =  \Yii::$app->db->createCommand("select  GROUP_CONCAT(DISTINCT gtcsd_gcctendcpvmst_fk) as gtcsd_gcctendcpvmst_fk from gcctendcpvsubsdtls_tbl 
                    where  gtcsd_gcctendsubsdtls_fk= $suntdpk AND gtcsd_gcctendsectorsubsdtls_fk= $catId")->queryAll();
                    $cpvString = $cpvSub[0]['gtcsd_gcctendcpvmst_fk'];
                 }
                }
                if (!empty($suntdpk) && count($suntdpk) !=0){  
        $secdtl =  \Yii::$app->db->createCommand("select GROUP_CONCAT(DISTINCT gcctendsectorsubsdtls_pk) as gcctendsectorsubsdtls_pk, gcctendsubsdtls_pk, gtssd_gcctendsectmst_fk ,   gtssd_subscribedto from gcctendsectorsubsdtls_tbl as t1
           left join gcctendsubsdtls_tbl as t2  on t1.gtssd_gcctendsubsdtls_fk = t2.gcctendsubsdtls_pk
             where  gtssd_gcctendsubsdtls_fk=$suntdpk AND (if(gtssd_subscriptionstatus IN(4,5,6,9) AND (gtssd_subscribedto > now()) ,1,if(gtssd_subscriptionstatus IN (3,7) ,1,0))) ")->queryAll();
              $sectorString = $secdtl[0]['gcctendsectorsubsdtls_pk'];
              
             if (!empty($sectorString) && count($sectorString) !=0) {
                $cpvSub =  \Yii::$app->db->createCommand("select GROUP_CONCAT(DISTINCT gtcsd_gcctendcpvmst_fk) as gtcsd_gcctendcpvmst_fk  from gcctendcpvsubsdtls_tbl where gtcsd_gcctendsubsdtls_fk=$suntdpk AND gtcsd_gcctendsectorsubsdtls_fk IN ({$sectorString})")->queryAll();
                $cpvString = $cpvSub[0]['gtcsd_gcctendcpvmst_fk'];
            }else{
                $cpvSub =  \Yii::$app->db->createCommand("select GROUP_CONCAT(DISTINCT gtcsd_gcctendcpvmst_fk) as gtcsd_gcctendcpvmst_fk from gcctendcpvsubsdtls_tbl where gtcsd_gcctendsubsdtls_fk=$suntdpk AND gtcsd_gcctendsectorsubsdtls_fk = $catId")->queryAll();
                $cpvString  = $cpvSub[0]['gtcsd_gcctendcpvmst_fk'];
            }
        }
    // echo  $MembRegPk;

                if(!empty( $sectorMstPk ) && count( $sectorMstPk ) != 0)
                {
                $criteria .= "AND gccsec.gcctendsectmst_pk = {$sectorMstPk}";
                }

            $companyDeleted = Yii::$app->db->createCommand("SELECT GROUP_CONCAT(gtd_gcctendersdtls_fk) as deletedPks FROM gcctenddeldtls_tbl WHERE gtd_memberregmst_fk=$MembRegPk  AND gtd_status ='D'")->queryOne();
           // print_r($companyDeleted['deletedPks']);exit;
            
                    if (!empty($companyDeleted['deletedPks']) && count($companyDeleted['deletedPks']) != 0 ) { 
                        $delete = $companyDeleted['deletedPks'];
                        $criteria .= ("t.gcctenddtls_pk NOT IN ($delete)");
                    }
                    else {
                    if (!empty($companyDeleted['deletedPks']) && count($companyDeleted['deletedPks']) != 0 ) {  
                        $deletedPks = $companyDeleted['deletedPks'];
                        $criteria .= ("t.gcctenddtls_pk NOT IN ($deletedPks)");
                    }
                    }
            if (!empty($subscribedcountry)){
            $criteria .= ("gtd_countrymst_fk IN ($subscribedcountry)");
            }

            if (!empty($_REQUEST['country'])) {
                 $criteria .= " AND gtd_countrymst_fk='{$_REQUEST['country']}'";
            }
            if (!empty($_REQUEST['NoticeType'])) {
                $criteria .= " AND gtd_noticetype='{$_REQUEST['NoticeType']}'";
            }
            if (!empty($_REQUEST['gccstatus'])) {
                $criteria .= " AND t.gtd_status='{$_REQUEST['gccstatus']}'";
            }
            if (!empty($_REQUEST['bidding_type'])) {
                $criteria .= " AND gtd_biddingtype = '{$_REQUEST['bidding_type']}'";
                }
           
            if (!empty($_REQUEST['currency'])) {
                $criteria .= (" AND gtd_currencymst_fk='{$_REQUEST['currency']}'");
            }
            if (!empty($_REQUEST['currencyfrom']) && !empty($_REQUEST['currencyto'])) {
                $curr_from = $_REQUEST['currencyfrom'];
                $curr_to = $_REQUEST['currencyto'];
                $criteria .= " AND gtd_estcost BETWEEN $curr_from AND $curr_to";
            }
            if (!empty($_REQUEST['region'])) {
                $criteria .= " AND gtd_region='{$_REQUEST['region']}'";
            }
    
            if (!empty($_REQUEST['pub_date_from']) && !empty($_REQUEST['pub_date_to'])) {
                $publishfromdate = date('Y-m-d', strtotime($_REQUEST['pub_date_from']));
                $publishtodate = date('Y-m-d', strtotime($_REQUEST['pub_date_to']));
                $criteria .=" AND gtd_tenderpublishedon BETWEEN $publishfromdate AND $publishtodate ";
            }
            if (!empty($_REQUEST['gcc_date_from']) && !empty($_REQUEST['gcc_to'])) {
                $fromdate = date('Y-m-d', strtotime($_REQUEST['gcc_date_from']));
                $todate = date('Y-m-d', strtotime($_REQUEST['gcc_to']));
                $criteria .= " AND cont.gtcdd_docsubdate BETWEEN  $fromdate AND  $todate ";
            }
            if (!empty($cpvString)) {
                $criteria .= (" AND gcccpv.gcctendcpvmst_pk IN ( $cpvString )");
            }
            if (!empty($_REQUEST['sort'])) {
                if($_REQUEST['sort'] == 'ASC') 
                $criteria .= " ORDER BY gtd_tenderpublishedon ASC";
                else
                $criteria .= " ORDER BY gtd_tenderpublishedon DESC";
            }
         $expiryDateFrom = date('Ymd', strtotime(Yii::$app->params['GCC']['GridLimitOnExpiryDate']));
           // print_r($criteria);exit;  
           
        $totcount = \Yii::$app->db->createCommand("select COUNT(DISTINCT gcctenddtls_pk) as tot  from gcctenddtls_tbl as t 
        left join gcctendsectdtls_tbl as sect on sect.gtsd_gcctenddtls_fk=t.gcctenddtls_pk
        left join gcctendcontdocdtls_tbl as cont on cont.gtcdd_gcctenddtls_fk=t.gcctenddtls_pk 
        left join gcctendcpvmst_tbl as gcccpv on gcccpv.gcctendcpvmst_pk=sect.gtsd_gcctendcpvmst_fk
        left join gcctendsectmst_tbl as gccsec on gccsec.gcctendsectmst_pk=gcccpv.gtcm_gcctendsectmst_fk
        left join countrymst_tbl as cy on gtd_countrymst_fk=CountryMst_Pk
           WHERE (DATE_FORMAT(gtcdd_docsubdate,'%Y%m%d') >= $expiryDateFrom ) $criteria");
        $totcount = $totcount->queryAll();
        if(!empty($totcount))
        {
        $listcount =  $totcount[0]['tot']; 
        }
       
        $query = \Yii::$app->db->createCommand("select DISTINCT gcctenddtls_pk,gtd_postingid,gtd_refno,gtd_tendername, gtd_projectname,gtd_corrigendum,gtd_noticetype,gtd_biddingtype,gtd_tenderpublishedon,gtd_currencymst_fk,gtd_estcost,gtd_tenderdesc,gtd_region,gtd_regioncode,gtd_citymst_fk,gtd_statemst_fk,gtd_pincode,gtd_countrymst_fk,gtd_createdon,gtd_updatedon from  gcctenddtls_tbl as t 
        left join gcctendsectdtls_tbl as sect on sect.gtsd_gcctenddtls_fk=t.gcctenddtls_pk
        left join gcctendcontdocdtls_tbl as cont on cont.gtcdd_gcctenddtls_fk=t.gcctenddtls_pk 
        left join gcctendcpvmst_tbl as gcccpv on gcccpv.gcctendcpvmst_pk=sect.gtsd_gcctendcpvmst_fk
        left join gcctendsectmst_tbl as gccsec on gccsec.gcctendsectmst_pk=gcccpv.gtcm_gcctendsectmst_fk
        left join countrymst_tbl as cy on gtd_countrymst_fk=CountryMst_Pk
           WHERE (DATE_FORMAT(gtcdd_docsubdate,'%Y%m%d') >= $expiryDateFrom ) $criteria $limit");
         $queryres = $query->queryAll();            
         if(!empty($queryres)){
            foreach($queryres as $key=>$value){
                $country_flag = stripslashes($baseUrl."app/assets/images/flags/".$value['gtd_countrymst_fk'].".png") ;
                $response['data'][$key]['gcctenddtls_pk'] = $value['gcctenddtls_pk'];
                $response['data'][$key]['gtd_refno'] = $value['gtd_refno'];
                $response['data'][$key]['gtd_tendername'] = $value['gtd_tendername'];
                $response['data'][$key]['status'] = 'Active';
                $response['data'][$key]['gtd_noticetype'] = $value['gtd_noticetype'];
                $response['data'][$key]['gtd_tenderpublishedon'] = $value['gtd_tenderpublishedon'];
                $response['data'][$key]['countryflag'] = $country_flag;
                $response['data'][$key] ['gtd_region'] = $value['gtd_region'];
                
             } 
             $o = array(
                "status" => "1",
                "Tender Subscrided" => $response,
                "Message" => "Success",
                "Errorcode" => 0,
                "listcount" => $listcount);
      }else{
        $o = array(
            "status" => "0",
            "Tender Subscrided" => 'No Data Found',
            "Message" => "Failure",
            "Errorcode" => 0);
         }
         
         echo Json_encode($o);
         exit;
}

    public function gettenderdetails($gcctenderid) 
    {  
        //if (isset($_REQUEST['gcctenderid']) && !empty($_REQUEST['gcctenderid'])) {
            $baseUrl = \Yii::$app->params['APP_URL'];
            $gcctender_id =$gcctenderid;
       // }
        if (isset($_REQUEST['tenderSectorSubId']) && !empty($_REQUEST['tenderSectorSubId'])) {
            $tenderSectorSubId = $_REQUEST['tenderSectorSubId'];
        }
         
        $gcctenderdetails = \Yii::$app->db->createCommand("select `gtsd`.`gtsd_gcctendcpvmst_fk`,`gtd`.`gcctenddtls_pk` AS `gcctenddtls_pk`,`gtd`.`gtd_refno` AS `gtd_refno`,`gtd`.`gtd_projectname` AS `gtd_projectname`,`gtd`.`gtd_corrigendum` AS `gtd_corrigendum`,`gtd`.`gtd_status` AS `gtd_status`,`gtd`.`gtd_tenderpublishedon` AS `gtd_tenderpublishedon`,`gtd`.`gtd_noticetype` AS `gtd_noticetype`,`gtd`.`gtd_biddingtype` AS `gtd_biddingtype`,`gtd`.`gtd_estcost` AS `gtd_estcost`,`gtd`.`gtd_tendername` AS `gtd_tendername`,`gtd`.`gtd_tenderdesc` AS `gtd_tenderdesc`,`gtd`.`gtd_region` AS `gtd_region`,`cm`.`CM_CityName_en` AS `CM_CityName_en`,`sm`.`SM_StateName_en` AS `SM_StateName_en`,`cnm`.`CyM_CountryName_en` AS `CyM_CountryName_en`,`gtd`.`gtd_pincode` AS `gtd_pincode`,`gtcdd`.`gtcdd_tacmpname` AS `gtcdd_tacmpname`,concat(`gtcdd`.`gtcdd_taaddline1`,' ',`gtcdd`.`gtcdd_taaddline2`) AS `address`,`gtcdd`.`gtcdd_tawebsite` AS `gtcdd_tawebsite`,`gtcdd`.`gtcdd_fundingagency` AS `gtcdd_fundingagency`,`gtcdd`.`gtcdd_cpname` AS `gtcdd_cpname`,`gtcdd`.`gtcdd_cpemail` AS `gtcdd_cpemail`,`gtcdd`.`gtcdd_cptel` AS `gtcdd_cptel`,`gtcdd`.`gtcdd_cpfax` AS `gtcdd_cpfax`,`gtcdd`.`gtcdd_supdoc` AS `gtcdd_supdoc`,`gtcdd`.`gtcdd_docsubdate` AS `gtcdd_docsubdate`,group_concat(distinct `gtcm`.`gtcm_cpvcode`,' - ',`gtcm`.`gtcm_cpvdetails` separator ' <span></span> ') AS `gtcm_cpsdetails`,group_concat(distinct `gtsm`.`gtsm_sectorname` separator ' <span></span> ') AS `gtsm_sectorname`,`gtd`.`gtd_countrymst_fk` AS `gtd_countrymst_fk`,`curr`.`CurM_CurrencyName_en` AS `CurM_CurrencyName_en` from ((((((((`gcctenddtls_tbl` `gtd` left join `gcctendcontdocdtls_tbl` `gtcdd` on((`gtcdd`.`gtcdd_gcctenddtls_fk` = `gtd`.`gcctenddtls_pk`))) left join `gcctendsectdtls_tbl` `gtsd` on((`gtsd`.`gtsd_gcctenddtls_fk` = `gtd`.`gcctenddtls_pk`))) left join `gcctendcpvmst_tbl` `gtcm` on((`gtcm`.`gcctendcpvmst_pk` = `gtsd`.`gtsd_gcctendcpvmst_fk`))) left join `gcctendsectmst_tbl` `gtsm` on((`gtsm`.`gcctendsectmst_pk` = `gtcm`.`gtcm_gcctendsectmst_fk`))) left join `citymst_tbl` `cm` on((`cm`.`CityMst_Pk` = `gtd`.`gtd_citymst_fk`))) left join `statemst_tbl` `sm` on((`sm`.`StateMst_Pk` = `gtd`.`gtd_statemst_fk`))) left join `countrymst_tbl` `cnm` on((`cnm`.`CountryMst_Pk` = `gtd`.`gtd_countrymst_fk`))) left join `currencymst_tbl` `curr` on((`curr`.`CurrencyMst_Pk` = `gtd`.`gtd_currencymst_fk`)) )  WHERE `gtd`.gcctenddtls_pk='$gcctender_id'");
        $gcctenderdetailsres = $gcctenderdetails->queryAll();
        if(!empty($gcctenderdetailsres)){
         
         foreach($gcctenderdetailsres as $key=>$value)
         {
            $response['data']['gtsd_gcctendcpvmst_fk'] = $value['gtsd_gcctendcpvmst_fk'];
            $response['data']['gcctenddtls_pk'] = $value['gcctenddtls_pk'];
            $response['data']['gtd_refno'] = $value['gtd_refno'];
            $response['data']['gtd_projectname'] =  strip_tags($value['gtd_projectname']);
            $response['data']['gtd_corrigendum'] = strip_tags($value['gtd_corrigendum']);
            $response['data']['gtd_status'] = strip_tags($value['gtd_status']);
            $response['data']['gtd_tenderpublishedon'] = strip_tags($value['gtd_tenderpublishedon']);
            $response['data']['gtd_noticetype'] = strip_tags($value['gtd_noticetype']);
            $response['data']['gtd_biddingtype'] = strip_tags($value['gtd_biddingtype']);
            $response['data']['gtd_estcost'] = strip_tags($value['gtd_estcost']);
            $response['data']['gtd_tendername'] = strip_tags($value['gtd_tendername']);
            $response['data']['gtd_tenderdesc'] = strip_tags($value['gtd_tenderdesc']);
            $response['data']['gtd_region'] = strip_tags($value['gtd_region']);
            $response['data']['CM_CityName_en'] = strip_tags($value['CM_CityName_en']);
            $response['data']['SM_StateName_en'] = strip_tags($value['SM_StateName_en']);
            $response['data']['CyM_CountryName_en'] = strip_tags($value['CyM_CountryName_en']);
            $response['data']['gtd_pincode'] = strip_tags($value['gtd_pincode']);
            $response['data']['gtcdd_tacmpname'] = strip_tags($value['gtcdd_tacmpname']);
            $response['data']['address'] = strip_tags($value['address']);
            $response['data']['CM_CityName_en'] = strip_tags($value['CM_CityName_en']);
            $response['data']['gtcdd_tawebsite'] = strip_tags($value['gtcdd_tawebsite']);
            $response['data']['gtcdd_fundingagency'] = strip_tags($value['gtcdd_fundingagency']);
            $response['data']['gtcdd_cpname'] = strip_tags($value['gtcdd_cpname']);
            $response['data']['gtcdd_cpemail'] = strip_tags($value['gtcdd_cpemail']);
            $response['data']['gtcdd_cptel'] = strip_tags($value['gtcdd_cptel']);
            $response['data']['gtcdd_cpfax'] = strip_tags($value['gtcdd_cpfax']);
            $response['data']['gtcdd_supdoc'] = strip_tags($value['gtcdd_supdoc']);
            $response['data']['gtcdd_docsubdate'] = strip_tags($value['gtcdd_docsubdate']);
            $response['data']['prod_service'] = strip_tags($value['gtcm_cpsdetails']);
            $response['data']['category'] = strip_tags($value['gtsm_sectorname']);
            $response['data']['gtd_countrymst_fk'] = strip_tags($value['gtd_countrymst_fk']);
            $response['data']['CurM_CurrencyName_en'] = strip_tags($value['CurM_CurrencyName_en']);
            $response['data']['closingdate'] = Null;
            $flagimg = stripslashes($baseUrl."app/assets/images/flags/".$value['gtd_countrymst_fk'].".png") ;
            $response['data']['countryflag'] = $flagimg;
     
        }
        $o = array(
            "status" => "1",
            "Tender Subscrided" => $response,
            "Message" => "Success",
            "Errorcode" => 0);
        }else{

         $o = array(
            "status" => "0",
            "Tender Subscrided" => 'No Data Found',
            "Message" => "Failure",
            "Errorcode" => 0);
         }
         echo Json_encode($o);
         exit;
    
    }
 
     
}
 