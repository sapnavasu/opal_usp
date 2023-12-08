<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExportController
 *
 * @author bgi220
 */
namespace console\controllers;

use Yii;
use yii\console\Controller;
use \api\modules\bs\components\Exportbizsearch;
use \common\models\Memcompproddtlstbl;
use \common\components\Suppcertform;

class ExportController extends Controller{
    public function actionBizmail($arg,$args,$limit){   
        $exportObj = new Exportbizsearch($arg,$limit);
        $exportObj->createHeader();        
        $data=$exportObj->jsondata;
        $data1=$exportObj->Requestdata;   
        $exportObj->CompanyTableHeader();     
        if($data['mergeoption'] == "Merge"){
            $exportObj->CompanyDataFormation();
        }else{
            $exportObj->CompanyUnmergeDataFormation();
        }        
        $exportObj->createZip();            
        $userpk = $data1['osbsdt_exptby'];
        $regpkpk = $data1['osbsdt_memregmst_fk'];
        $emailid = $data1['osbsdt_emailid'];
        $expiredate =  date("d-m-Y", strtotime($data1['osbsdt_expirydate']));
        $enpk = base64_encode($arg);
        $link = $args.$enpk;
        $usertb = \common\models\UsermstTbl::findOne($userpk);
        $companydet = \common\models\MembercompanymstTbl::find() ->where('MCM_MemberRegMst_Fk = :regpk', [':regpk' => $regpkpk])->one();  
        if($usertb->UM_Type == 'A'){            
            $name = "M/S"." ".$companydet->MCM_CompanyName;    
        }elseif($usertb->UM_Type == 'U'){
            $name = "DEAR"." ".$usertb->um_firstname . ' ' . $usertb->um_middlename . ' ' . $usertb->um_lastname ;            
        }
        $content = $name .'<br><br><br> Your customised supplier list from J Search is available in the below link. Click <a href="'. $link.'"> here</a> to download the list. <br><br>Note: The download link will be valid only until end of the day ('.$expiredate.').<br><br><br>Regards,<br>JSRS Team';
        $subject = 'J Search - Export Link';
        \Yii::$app->mailer->compose()
        ->setFrom('noreply@businessgateways.com')
        ->setTo('prithi@businessgateways.com')
//        ->setTo(\Yii::$app->params['testMailIDs'])
//        ->setTo($emailid)
        ->setSubject($subject)
        ->setHTMLBody($content)
        ->send();
    }

    public function actionExportproductdata($companypk, $fieldarr,  $userPK, $trackid, $type, $baseMailPath, $expiryafter) {
        $data = Memcompproddtlstbl::productexcelexport($companypk, $fieldarr, $userPK, $trackid, $type, $baseMailPath, $expiryafter);
    }

    public function actionExportservicedata($companypk, $fieldarr,  $userPK, $trackid, $type, $baseMailPath, $expiryafter) {
        $data = Memcompproddtlstbl::serviceexcelexport($companypk, $fieldarr, $userPK, $trackid, $type, $baseMailPath, $expiryafter);
    }

    public function actionProductandserviceszipexport($companypk,$userpk,$baseurl,$formid){   
       $proddetails = Suppcertform::getapprovedproductexport($companypk,$userpk,$baseurl,$formid);
       $servdetails = Suppcertform::getapprovedservicesexport($companypk,$userpk,$baseurl,$formid);       
       if($formid == 1){
            $fileProdserv='finishedGoods'.$companypk.date('dmy');
            $folder=dirname(__FILE__).'/../../backend/documents/finishedGoods/';
        }
        elseif($formid == 2){
            $fileProdserv='prodserv'.$companypk.date('dmy');
            $folder=dirname(__FILE__).'/../../backend/documents/prodserv/';
        }
        \common\components\Suppcertform::approvedprdsercreatezip($proddetails,$servdetails,$fileProdserv,$folder,$formid);
    }
    public function actionScfmenutblinsertion($companypk,$formid){   
       \Yii::$app->db->createCommand("call SP_certmenudata(:p1,:p2)")
            ->bindValue(':p1' , $companypk)
            ->bindValue(':p2' , $formid)
            ->execute();
    }
    public function actionScfmainhistytblinsertion($compaypk,$type,$duration=''){   
       \Yii::$app->db->createCommand("call sp_scf_tmh_insertion(:p1,:p2,:p3)")
            ->bindValue(':p1' , $compaypk)
            ->bindValue(':p2' , $type)
            ->bindValue(':p3' , $duration)
            ->execute();
    }
    
    public function actionDatainsertiontofinaluser($compaypk, $formid, $valuserpk, $certpk){
        $SuppMemtbl = \common\models\SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company', [":form" => $formid, ":company" => $compaypk])->one();
        if (!empty($SuppMemtbl)) {
            $leveluser = \api\modules\mst\models\FormmstTbl::find()
                            ->select(['approvalworkflowuserconfigtrns_pk', 'approvalworkflowuserconfig_pk', 'awfct_level'])
                            ->leftJoin('approvalworkflowconfigdtls_tbl', 'awfcd_formmst_fk=formmst_pk and awfcd_status =1')
                            ->leftJoin('approvalworkflowconfigtrns_tbl', 'awfct_approvalworkflowconfigdtls_fk=approvalworkflowconfigdtls_pk')
                            ->leftJoin('approvalworkflowuserconfig_tbl', 'awfuc_approvalworkflowconfigtrns_fk=approvalworkflowuserconfigtrns_pk')
                            ->where("awfuc_usermst_fk=:userpk and formmst_pk=:formpk and frm_isworkflowapprapplicable=:workflowapp", [':userpk' => $valuserpk, 'formpk' => $formid, 'workflowapp' => 1])->asArray()->one();
            $levelSuppMemtbl = new \api\modules\mst\models\CertapprovaldtlsTbl();
            $levelSuppMemtbl->cad_membercompanymst_fk = $compaypk;
            $levelSuppMemtbl->cad_suppcertformmembtmp_fk = $SuppMemtbl->suppcertformmembtmp_pk;
            $levelSuppMemtbl->cad_approvalworkflowuserconfig_fk = $leveluser['approvalworkflowuserconfig_pk'];
            $levelSuppMemtbl->cad_approvalworkflowuserconfigtrns_fk = $leveluser['approvalworkflowuserconfigtrns_pk'];
            $levelSuppMemtbl->cad_status = 0;
            $levelSuppMemtbl->cad_comments = NULL;
            $levelSuppMemtbl->cad_updatedon = date('Y-m-d H:i:s');
            $levelSuppMemtbl->cad_actioncompleted = 1;
            if ($levelSuppMemtbl->save(false)) {
                $level = $leveluser['awfct_level'];
                /* Insert Category and Subcategory 
                 *  To Take categorytmp table pk */
                    Yii::$app->db->createCommand("insert into certcatsubcatapprovaldtls_tbl (ccscad_certapprovaldtls_fk, ccscad_suppcertformcattmp_fk, 
                    ccscad_suppcertformtrntmp_fk, ccscad_level, ccscad_status, ccscad_movedtonxtlevel, ccscad_nxtlevel, ccscad_comments, ccscad_isvalidated, 
                    ccscad_apprdclnby, ccscad_updatedon) select :p1, catpk, trntmpk, :p2, catstatus, 1, :p2, comment, isvalidated, :p3, now() from 
                    (select ccscad_suppcertformcattmp_fk as catpk,ccscad_suppcertformtrntmp_fk as trntmpk, ccscad_status AS catstatus,ccscad_comments as comment, ccscad_isvalidated AS isvalidated
                     from certcatsubcatapprovaldtls_tbl where ccscad_certapprovaldtls_fk =($certpk)) as t")
                            ->bindValue(':p1', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p2', $level)
                            ->bindValue(':p3', $valuserpk)
                            ->execute();
                }
                /* Insert Parameter table */
                Yii::$app->db->createCommand("insert into certapprovalpardtls_tbl (catd_certapprovaldtls_fk, catd_suppcertformpartrntmp_fk, 
                catd_approvalworkflowuserconfig_fk, catd_level, catd_status, catd_movedtonxtlevel, catd_nxtlevel, catd_comments, catd_isvalidated, 
                catd_apprdclnby, catd_updatedon) select :p1, parpk, :p2, :p5, pstatus, 1, :p5, comment, isvalidated, :p3, now() from 
                (select catd_suppcertformpartrntmp_fk as parpk,catd_status as pstatus,catd_comments as comment, catd_isvalidated AS isvalidated
                     from certapprovalpardtls_tbl where catd_certapprovaldtls_fk =($certpk)) as t")
                        ->bindValue(':p1', $levelSuppMemtbl->certapprovaldtls_pk)
                        ->bindValue(':p2', $leveluser['approvalworkflowuserconfig_pk'])
                        ->bindValue(':p3', $valuserpk)
                        ->bindValue(':p4', $compaypk)
                        ->bindValue(':p5', $level)
                        ->execute();
                /* Insert Oman tender table */
                $checkomantenderdet = \common\models\MemcomptendbrdtempTbl::find()->where("mctbt_membcompmst_fk=:compk and
                mctbt_scfstatus is not null and mctbt_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($checkomantenderdet > 0) {
                    Yii::$app->db->createCommand("insert into memcomptendbrdapprovalmain_tbl (mctbam_membercompanymst_fk, mctbam_certapprovaldtls_fk, 
                    mctbam_level, mctbam_status, mctbam_movedtonxtlevel, mctbam_nxtlevel, mctbam_isvalidated, mctbam_comments, 
                    mctbam_apprdclnby, mctbam_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mctbam_status as catstatus, mctbam_isvalidated as isvalidated, mctbam_comments as comment 
                    from memcomptendbrdapprovalmain_tbl where mctbam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $omantendermaintbl = \api\modules\mst\models\MemcomptendbrdapprovalmainTbl::find()->where("mctbam_membercompanymst_fk=:compk
                     and mctbam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $omantenderprevusrdata = \api\modules\mst\models\MemcomptendbrdapprovalmainTbl::find()->where("mctbam_membercompanymst_fk=:compk
                     and mctbam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcomptendbrdapprovaldtls_tbl (mctbad_memcomptendbrdapprovalmain_fk,
                        mctbad_memcomptendbrdtemp_fk, mctbad_status, mctbad_comments, mctbad_isvalidated, mctbad_apprdclnby , mctbad_updatedon) select :p1, 
                        omantedpk, pstatus, comment, isvalidated, :p2, now() from (select mctbad_memcomptendbrdtemp_fk as omantedpk, 
                        mctbad_status as pstatus, mctbad_isvalidated as isvalidated, 
                        mctbad_comments as comment from memcomptendbrdapprovaldtls_tbl where mctbad_memcomptendbrdapprovalmain_fk = :p4) as t")
                            ->bindValue(':p1', $omantendermaintbl->memcomptendbrdapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p4', $omantenderprevusrdata->memcomptendbrdapprovalmain_pk)
                            ->execute();
                }
                /* Insert Branch details table */
                $checkbranchdet = \app\models\MemcompbranchdtlstempTbl::find()->where("mcbdt_memcompmst_fk=:compk and
                mcbdt_scfstatus is not null and mcbdt_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($checkbranchdet > 0) {
                    Yii::$app->db->createCommand("insert into memcompbranchapprovalmain_tbl (mcbam_membercompanymst_fk, mcbam_certapprovaldtls_fk, 
                    mcbam_level, mcbam_status, mcbam_movedtonxtlevel, mcbam_nxtlevel, mcbam_isvalidated, mcbam_comments, 
                    mcbam_apprdclnby, mcbam_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcbam_status as catstatus, mcbam_isvalidated as isvalidated, mcbam_comments as comment 
                    from memcompbranchapprovalmain_tbl where mcbam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $branchdetmaintbl = \api\modules\mst\models\MemcompbranchapprovalmainTbl::find()->where("mcbam_membercompanymst_fk=:compk
                     and mcbam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $branchdetprevusrdata = \api\modules\mst\models\MemcompbranchapprovalmainTbl::find()->where("mcbam_membercompanymst_fk=:compk
                     and mcbam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcompbranchapprovaldtls_tbl (mcbad_memcompbranchapprovalmain_fk,
                        mcbad_memcompbranchdtlstemp_fk, mcbad_status, mcbad_comments, mcbad_isvalidated, mcbad_apprdclnby , mcbad_updatedon) select :p1, 
                        branchpk, bstatus, comment, isvalidated, :p2, now() from (select mcbad_memcompbranchdtlstemp_fk as branchpk,mcbad_status AS bstatus, 
                        mcbad_isvalidated AS isvalidated, mcbad_comments as comment from memcompbranchapprovaldtls_tbl where mcbad_memcompbranchapprovalmain_fk = :p4) as t")
                            ->bindValue(':p1', $branchdetmaintbl->memcompbranchapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p4', $branchdetprevusrdata->memcompbranchapprovalmain_pk)
                            ->execute();
                }
                /* Insert Financial report table */
                $checkfinancialrepdet = \common\models\MemcompfinancialtempTbl::find()->where("mcft_membcompmst_fk=:compk and
                mcft_scfstatus is not null and mcft_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($checkfinancialrepdet > 0) {
                    $despt = $formid == 1 ? 9 : 26;
                    Yii::$app->db->createCommand("insert into memcompfinancialapprovalmain_tbl (mcfam_membercompanymst_fk, mcfam_certapprovaldtls_fk, 
                    mcfam_level, mcfam_status, mcfam_movedtonxtlevel, mcfam_nxtlevel, mcfam_isvalidated, mcfam_comments, 
                    mcfam_apprdclnby, mcfam_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcfam_status AS catstatus, mcfam_isvalidated AS isvalidated, mcfam_comments as comment 
                    from memcompfinancialapprovalmain_tbl where mcfam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $finarepmaintbl = \api\modules\mst\models\MemcompfinancialapprovalmainTbl::find()->where("mcfam_membercompanymst_fk=:compk
                     and mcfam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $finarepprevusrdata = \api\modules\mst\models\MemcompfinancialapprovalmainTbl::find()->where("mcfam_membercompanymst_fk=:compk
                     and mcfam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcompfinancialapprovaldtls_tbl (mcfad_memcompfinancialapprovalmain_fk,
                        mcfad_memcompfinancialtemp_fk, mcfad_status, mcfad_comments, mcfad_isvalidated, mcfad_apprdclnby , mcfad_updatedon) select :p1, 
                        finapk, bstatus, comment, isvalidated, :p2, now() from (select mcfad_memcompfinancialtemp_fk as finapk, 
                        mcfad_status AS bstatus, mcfad_isvalidated AS isvalidated, 
                        mcfad_comments as comment from memcompfinancialapprovaldtls_tbl where mcfad_memcompfinancialapprovalmain_fk = :p4) as t")
                            ->bindValue(':p1', $finarepmaintbl->memcompfinancialapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p4', $finarepprevusrdata->memcompfinancialapprovalmain_pk)
                            ->execute();
                }
                /* Insert shareholder  details table */
                $checkshareholderdet = \common\models\MemcompshareholderdtlsTbl::find()->where("mcshd_memcompmst_fk=:compk and
                mcshd_scfstatus is not null and mcshd_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($checkshareholderdet > 0) {
                    Yii::$app->db->createCommand("insert into memcompshareholderapprovalmain_tbl (mcsham_membercompanymst_fk, mcsham_certapprovaldtls_fk, 
                    mcsham_level, mcsham_status, mcsham_movedtonxtlevel, mcsham_nxtlevel, mcsham_isvalidated, mcsham_comments, 
                    mcsham_apprdclnby, mcsham_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcsham_status as catstatus, mcsham_isvalidated AS isvalidated, mcsham_comments as comment 
                    from memcompshareholderapprovalmain_tbl where mcsham_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $shareholdermaintbl = \api\modules\mst\models\MemcompshareholderapprovalmainTbl::find()->where("mcsham_membercompanymst_fk=:compk
                     and mcsham_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $shareholderprevusrdata = \api\modules\mst\models\MemcompshareholderapprovalmainTbl::find()->where("mcsham_membercompanymst_fk=:compk
                     and mcsham_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcompshareholderapprovaldtls_tbl (mcshad_memcompshareholderapprovalmain_fk,
                        mcshad_memcompshareholderdtls_fk, mcshad_status, mcshad_comments, mcshad_isvalidated, mcshad_apprdclnby , mcshad_updatedon) select :p1, 
                        shareholdpk, bstatus, comment, isvalidated, :p2, now() from (select mcshad_memcompshareholderdtls_fk as shareholdpk, 
                        mcshad_status AS bstatus, mcshad_isvalidated AS isvalidated, 
                        mcshad_comments as comment from memcompshareholderapprovaldtls_tbl where mcshad_memcompshareholderapprovalmain_fk = :p4) as t")
                            ->bindValue(':p1', $shareholdermaintbl->memcompshareholderapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p4', $shareholderprevusrdata->memcompshareholderapprovalmain_pk)
                            ->execute();
                }
                /* Insert Business source table */
                $bussrcdet = \common\models\MemcompbussrcdtlsTbl::find()->where("mcbsd_membercompanymst_fk=:compk and
                mcbsd_scfadminstatus is not null and mcbsd_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($bussrcdet > 0) {
                    $despt = $formid == 1 ? 34 : 33;
                    Yii::$app->db->createCommand("insert into memcompbussrcapprovalmain_tbl (mcbsam_membercompanymst_fk, mcbsam_certapprovaldtls_fk, 
                    mcbsam_level, mcbsam_status, mcbsam_movedtonxtlevel, mcbsam_nxtlevel, mcbsam_isvalidated, mcbsam_comments, 
                    mcbsam_apprdclnby, mcbsam_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcbsam_status AS catstatus, mcbsam_isvalidated AS isvalidated, mcbsam_comments as comment 
                    from memcompbussrcapprovalmain_tbl
                    where mcbsam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $bussrcmaintbl = \api\modules\mst\models\MemcompbussrcapprovalmainTbl::find()->where("mcbsam_membercompanymst_fk=:compk
                     and mcbsam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $bussrcprevusrdata = \api\modules\mst\models\MemcompbussrcapprovalmainTbl::find()->where("mcbsam_membercompanymst_fk=:compk
                     and mcbsam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcompbussrcapprovaldtls_tbl (mcbsad_memcompbussrcapprovalmain_fk,
                        mcbsad_memcompbussrcdtls_fk, mcbsad_status, mcbsad_comments, mcbsad_isvalidated, mcbsad_apprdclnby , mcbsad_updatedon)
                        select :p1, bussrcpk, bstatus, comment, isvalidated, :p2, now() from (select mcbsad_memcompbussrcdtls_fk as bussrcpk, 
                        mcbsad_status AS bstatus, mcbsad_isvalidated AS isvalidated, mcbsad_comments as comment from memcompbussrcapprovaldtls_tbl 
                        where mcbsad_memcompbussrcapprovalmain_fk = :p3) as t")
                            ->bindValue(':p1', $bussrcmaintbl->memcompbussrcapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p3', $bussrcprevusrdata->memcompbussrcapprovalmain_pk)
                            ->execute();
                }
                /* Insert Product table */
                $productdet = \common\models\MemcompproddtlsTbl::find()->where("MCPrD_MemberCompMst_Fk=:compk and
                MCPrD_SVFAdminApprovalStatus is not null and mcprd_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($productdet > 0) {
                    $despt = $formid == 1 ? 13 : 28;
                    Yii::$app->db->createCommand("insert into memcompprodapprovalmain_tbl (mcpam_membercompanymst_fk, mcpam_certapprovaldtls_fk, 
                    mcpam_level, mcpam_status, mcpam_movedtonxtlevel, mcpam_nxtlevel, mcpam_isvalidated, mcpam_comments, 
                    mcpam_apprdclnby, mcpam_updatedon) select :p1, :p2, :p3, catstatus,  1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcpam_status AS catstatus, mcpam_isvalidated AS isvalidated, mcpam_comments as comment 
                    from memcompprodapprovalmain_tbl 
                    where mcpam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    
                    $productmaintbl = \api\modules\mst\models\MemcompprodapprovalmainTbl::find()->where("mcpam_membercompanymst_fk=:compk
                     and mcpam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $productprevusrdata = \api\modules\mst\models\MemcompprodapprovalmainTbl::find()->where("mcpam_membercompanymst_fk=:compk
                     and mcpam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    Yii::$app->db->createCommand("insert into memcompprodapprovaldtls_tbl (mcpad_memcompprodapprovalmain_fk,
                        mcpad_memcompproddtls_fk, mcpad_status, mcpad_comments, mcpad_isvalidated, mcpad_apprdclnby , mcpad_updatedon) select :p1, 
                        prdpk, bstatus, comment, isvalidated, :p2, now() from (select mcpad_memcompproddtls_fk as prdpk, 
                        mcpad_status AS bstatus, mcpad_isvalidated as isvalidated, mcpad_comments as comment from memcompprodapprovaldtls_tbl 
                        where mcpad_memcompprodapprovalmain_fk = :p3) as t")
                            ->bindValue(':p1', $productmaintbl->memcompprodapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p3', $productprevusrdata->memcompprodapprovalmain_pk)
                            ->execute();
                }
                /* Insert Services table */
                $servicesdet = \common\models\MemcompservicedtlsTbl::find()->where("MCSvD_MemberCompMst_Fk=:compk and
                MCSvD_SVFAdminApprovalStatus is not null and mcsvd_isdeleted = 2", [':compk' => $compaypk])->count();
                if ($servicesdet > 0) {
                    $despt = $formid == 1 ? 14 : 29;
                    Yii::$app->db->createCommand("insert into memcompserviceapprovalmain_tbl (mcsam_membercompanymst_fk, mcsam_certapprovaldtls_fk, 
                    mcsam_level, mcsam_status, mcsam_movedtonxtlevel, mcsam_nxtlevel, mcsam_isvalidated, mcsam_comments, 
                    mcsam_apprdclnby, mcsam_updatedon) select :p1, :p2, :p3, catstatus, 1, :p3, isvalidated, comment, :p4, now() from 
                    (select mcsam_status AS catstatus, mcsam_isvalidated AS isvalidated, mcsam_comments as comment 
                    from memcompserviceapprovalmain_tbl 
                    where mcsam_certapprovaldtls_fk = ($certpk)) as t")
                            ->bindValue(':p1', $compaypk)
                            ->bindValue(':p2', $levelSuppMemtbl->certapprovaldtls_pk)
                            ->bindValue(':p3', $level)
                            ->bindValue(':p4', $valuserpk)
                            ->execute();
                    $servmaintbl = \api\modules\mst\models\MemcompserviceapprovalmainTbl::find()->where("mcsam_membercompanymst_fk=:compk
                     and mcsam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $levelSuppMemtbl->certapprovaldtls_pk])->one();
                    
                    $servprevusrdata = \api\modules\mst\models\MemcompserviceapprovalmainTbl::find()->where("mcsam_membercompanymst_fk=:compk
                     and mcsam_certapprovaldtls_fk=:certap", [':compk' => $compaypk, ':certap' => $certpk])->one();
                    
                    
                    Yii::$app->db->createCommand("insert into memcompserviceapprovaldtls_tbl (mcsad_memcompserviceapprovalmain_fk,
                        mcsad_memcompservicedtls_fk, mcsad_status, mcsad_comments, mcsad_isvalidated, mcsad_apprdclnby , mcsad_updatedon) select :p1, 
                        servpk, bstatus, comment, isvalidated, :p2, now() from (select mcsad_memcompservicedtls_fk as servpk, 
                        mcsad_status AS bstatus, mcsad_isvalidated AS isvalidated, mcsad_comments as comment from memcompserviceapprovaldtls_tbl                         
                        where mcsad_memcompserviceapprovalmain_fk = :p3) as t")
                            ->bindValue(':p1', $servmaintbl->memcompserviceapprovalmain_pk)
                            ->bindValue(':p2', $valuserpk)
                            ->bindValue(':p3', $servprevusrdata->memcompserviceapprovalmain_pk)
                            ->execute();
                }
            }
        }    
    public function actionDatainsertiontoapprovaltable($compaypk,$formid,$valuserpk){
        $SuppMemtbl =  \common\models\SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:form and scfmt_membercompmst_fk =:company',
            [":form"=>$formid,":company"=>$compaypk])->one();
        if(!empty($SuppMemtbl)){
            $leveluser = \api\modules\mst\models\FormmstTbl::find()
            ->select(['approvalworkflowuserconfigtrns_pk','group_concat(approvalworkflowuserconfig_pk) as approvalworkflowuserconfig_pk','awfct_level'])
            ->leftJoin('approvalworkflowconfigdtls_tbl','awfcd_formmst_fk=formmst_pk and awfcd_status =1')
            ->leftJoin('approvalworkflowconfigtrns_tbl','awfct_approvalworkflowconfigdtls_fk=approvalworkflowconfigdtls_pk')
            ->leftJoin('approvalworkflowuserconfig_tbl','awfuc_approvalworkflowconfigtrns_fk=approvalworkflowuserconfigtrns_pk')
            ->where("awfuc_usermst_fk in ($valuserpk) and formmst_pk=:formpk and frm_isworkflowapprapplicable=:workflowapp",
            ['formpk'=>$formid,'workflowapp'=>1])->asArray()->one();
            $levelSuppMemtbl = new \api\modules\mst\models\CertapprovaldtlsTbl();
            $levelSuppMemtbl->cad_membercompanymst_fk = $compaypk;
            $levelSuppMemtbl->cad_suppcertformmembtmp_fk = $SuppMemtbl->suppcertformmembtmp_pk;
            $levelSuppMemtbl->cad_approvalworkflowuserconfig_fk = $leveluser['approvalworkflowuserconfig_pk'];
            $levelSuppMemtbl->cad_approvalworkflowuserconfigtrns_fk = $leveluser['approvalworkflowuserconfigtrns_pk'];
            $levelSuppMemtbl->cad_status = 0;
            $levelSuppMemtbl->cad_comments = NULL;
            $levelSuppMemtbl->cad_updatedon = date('Y-m-d H:i:s');
            $levelSuppMemtbl->cad_actioncompleted = 1;
            if($levelSuppMemtbl->save(false)){
                $level = $leveluser['awfct_level'];
                /* Insert Category */
                Yii::$app->db->createCommand("insert into certcatsubcatapprovaldtls_tbl (ccscad_certapprovaldtls_fk, ccscad_suppcertformcattmp_fk, 
                    ccscad_suppcertformtrntmp_fk, ccscad_level, ccscad_status, ccscad_movedtonxtlevel, ccscad_nxtlevel, ccscad_comments, ccscad_isvalidated, 
                    ccscad_apprdclnby, ccscad_updatedon) select :p2, catpk, NULL, :p3, catstatus, 1, NULL, comment, 2, NULL, now() from 
                    (select suppcertformcattmp_pk as catpk, CASE WHEN scfct_status = 1 THEN 0 WHEN scfct_status = 4 THEN 3 WHEN scfct_status = 2 
                    THEN 1 WHEN scfct_status = 3 THEN 2 END AS catstatus,
                    scfct_appdeclcomments as comment from suppcertformcattmp_tbl where scfct_suppcertformmembtmp_fk=:p1) as t")
                 ->bindValue(':p1' , $SuppMemtbl->suppcertformmembtmp_pk)
                 ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                 ->bindValue(':p3' , $level)
                 ->execute();
                /* Insert Subcategory 
                *  To Take categorytmp table pk */
                $togetcatpk = \common\models\SuppcertformcattmpTbl::find()
                ->select("group_concat(suppcertformcattmp_pk) as pks","")
                ->where('scfct_suppcertformmembtmp_fk=:membtmp',[':membtmp'=>$SuppMemtbl->suppcertformmembtmp_pk])
                ->groupBy("scfct_suppcertformmembtmp_fk")->asArray()->one();
                if(!empty($togetcatpk) && !empty($togetcatpk['pks'])){
                    $catpk = $togetcatpk['pks'];
                    Yii::$app->db->createCommand("insert into certcatsubcatapprovaldtls_tbl (ccscad_certapprovaldtls_fk, ccscad_suppcertformcattmp_fk, 
                    ccscad_suppcertformtrntmp_fk, ccscad_level, ccscad_status, ccscad_movedtonxtlevel, ccscad_nxtlevel, ccscad_comments, ccscad_isvalidated, 
                    ccscad_apprdclnby, ccscad_updatedon) select :p1, catpk, subcatpk, :p2, catstatus, 1, NULL, comment, 2, NULL, now() from 
                    (select scftt_suppcertformcattmp_fk as catpk,suppcertformtrntmp_pk as subcatpk, CASE WHEN scftt_status = 1 THEN 0 WHEN scftt_status = 4 THEN 3 WHEN scftt_status = 2 
                    THEN 1 WHEN scftt_status = 3 THEN 2 END AS catstatus,
                    scftt_appdeclcomments as comment from suppcertformtrntmp_tbl where scftt_suppcertformcattmp_fk in ($catpk) and scftt_isdeleted =2) as t")
                    ->bindValue(':p1' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p2' , $level)
                    ->execute();
                }                
                /* Insert Parameter table */
                Yii::$app->db->createCommand("insert into certapprovalpardtls_tbl (catd_certapprovaldtls_fk, catd_suppcertformpartrntmp_fk, 
                catd_approvalworkflowuserconfig_fk, catd_level, catd_status, catd_movedtonxtlevel, catd_nxtlevel, catd_comments, catd_isvalidated, 
                catd_apprdclnby, catd_updatedon) select :p1, trnpk, :p2, :p5, pstatus, 1, NULL, comment, 2, NULL, now() from 
                (select suppcertformpartrntmp_pk as trnpk, CASE WHEN scfptt_scfstatus = 1 THEN 0 WHEN scfptt_scfstatus = 2 THEN 3 
                WHEN scfptt_scfstatus = 3 THEN 1 WHEN scfptt_scfstatus = 4 THEN 2 END AS pstatus, scfptt_appdeclcomments as comment from suppcertformpartrntmp_tbl 
                where scfptt_membercompmst_fk =:p4 and scfptt_isdeleted =2) as t")
                ->bindValue(':p1' , $levelSuppMemtbl->certapprovaldtls_pk)
                ->bindValue(':p2' , $leveluser['approvalworkflowuserconfig_pk'])
                ->bindValue(':p4' , $compaypk)
                ->bindValue(':p5' , $level)
                ->execute();
                /* Insert Oman tender table */
                $checkomantenderdet = \common\models\MemcomptendbrdtempTbl::find()->where("mctbt_membcompmst_fk=:compk and
                mctbt_scfstatus is not null and mctbt_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($checkomantenderdet > 0){          
                    Yii::$app->db->createCommand("insert into memcomptendbrdapprovalmain_tbl (mctbam_membercompanymst_fk, mctbam_certapprovaldtls_fk, 
                    mctbam_level, mctbam_status, mctbam_movedtonxtlevel, mctbam_nxtlevel, mctbam_isvalidated, mctbam_comments, 
                    mctbam_apprdclnby, mctbam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scfct_status = 1 THEN 0 WHEN scfct_status = 4 THEN 3 WHEN scfct_status = 2 THEN 1 WHEN scfct_status = 3 THEN 2 END AS catstatus, 
                    scfct_appdeclcomments as comment 
                    from suppcertformcattmp_tbl where scfct_suppcertformmembtmp_fk=:p5 and scfct_bgivaldoccatmst_fk= 3) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)                               
                    ->bindValue(':p5' , $SuppMemtbl->suppcertformmembtmp_pk)        
                    ->execute();
                    $omantendermaintbl = \api\modules\mst\models\MemcomptendbrdapprovalmainTbl::find()->where("mctbam_membercompanymst_fk=:compk
                     and mctbam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcomptendbrdapprovaldtls_tbl (mctbad_memcomptendbrdapprovalmain_fk,
                        mctbad_memcomptendbrdtemp_fk, mctbad_status, mctbad_comments, mctbad_isvalidated, mctbad_apprdclnby , mctbad_updatedon) select :p1, 
                        omantedpk, pstatus, comment, 2, NULL, now() from (select memcomptendbrdtemp_pk as omantedpk, 
                        CASE WHEN mctbt_scfstatus = 1 THEN 0 WHEN mctbt_scfstatus = 2 THEN 3 WHEN mctbt_scfstatus = 3 THEN 1 WHEN mctbt_scfstatus = 4 
                        THEN 2 END AS pstatus,
                        mctbt_appdeclcomments as comment from memcomptendbrdtemp_tbl where mctbt_membcompmst_fk =:p3 and mctbt_scfstatus is not null
                        and mctbt_isdeleted =2) as t")
                    ->bindValue(':p1' , $omantendermaintbl->memcomptendbrdapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                /* Insert Branch details table */
                $checkbranchdet = \app\models\MemcompbranchdtlstempTbl::find()->where("mcbdt_memcompmst_fk=:compk and
                mcbdt_scfstatus is not null and mcbdt_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($checkbranchdet > 0){
                    Yii::$app->db->createCommand("insert into memcompbranchapprovalmain_tbl (mcbam_membercompanymst_fk, mcbam_certapprovaldtls_fk, 
                    mcbam_level, mcbam_status, mcbam_movedtonxtlevel, mcbam_nxtlevel, mcbam_isvalidated, mcbam_comments, 
                    mcbam_apprdclnby, mcbam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scfct_status = 1 THEN 0 WHEN scfct_status = 4 THEN 3 WHEN scfct_status = 2 THEN 1 WHEN scfct_status = 3 THEN 2 END AS catstatus, 
                    scfct_appdeclcomments as comment 
                    from suppcertformcattmp_tbl where scfct_suppcertformmembtmp_fk=:p5 and scfct_bgivaldoccatmst_fk= 4) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)              
                    ->bindValue(':p5' , $SuppMemtbl->suppcertformmembtmp_pk)        
                    ->execute();
                    $branchdetmaintbl =\api\modules\mst\models\MemcompbranchapprovalmainTbl::find()->where("mcbam_membercompanymst_fk=:compk
                     and mcbam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompbranchapprovaldtls_tbl (mcbad_memcompbranchapprovalmain_fk,
                        mcbad_memcompbranchdtlstemp_fk, mcbad_status, mcbad_comments, mcbad_isvalidated, mcbad_apprdclnby , mcbad_updatedon) select :p1, 
                        branchpk, bstatus, comment, 2, NULL, now() from (select memcompbranchdtlstemp_pk as branchpk, 
                        CASE WHEN mcbdt_scfstatus = 1 THEN 0 WHEN mcbdt_scfstatus = 2 THEN 3 WHEN mcbdt_scfstatus = 3 THEN 1 WHEN mcbdt_scfstatus = 4 
                        THEN 2 END AS bstatus,
                        mcbdt_appdeclcomments as comment from memcompbranchdtlstemp_tbl where mcbdt_memcompmst_fk =:p3 and mcbdt_scfstatus is not null
                        and mcbdt_isdeleted =2) as t")
                    ->bindValue(':p1' , $branchdetmaintbl->memcompbranchapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                /* Insert Financial report table */
                $checkfinancialrepdet = \common\models\MemcompfinancialtempTbl::find()->where("mcft_membcompmst_fk=:compk and
                mcft_scfstatus is not null and mcft_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($checkfinancialrepdet > 0){
                    $despt = $formid == 1 ? 9  : 26;
                    Yii::$app->db->createCommand("insert into memcompfinancialapprovalmain_tbl (mcfam_membercompanymst_fk, mcfam_certapprovaldtls_fk, 
                    mcfam_level, mcfam_status, mcfam_movedtonxtlevel, mcfam_nxtlevel, mcfam_isvalidated, mcfam_comments, 
                    mcfam_apprdclnby, mcfam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scftt_status = 1 THEN 0 WHEN scftt_status = 4 THEN 3 WHEN scftt_status = 2 THEN 1 WHEN scftt_status = 3 THEN 2 END AS catstatus, 
                    scftt_appdeclcomments as comment 
                    from suppcertformtrntmp_tbl left join suppcertformcattmp_tbl on suppcertformcattmp_pk =  scftt_suppcertformcattmp_fk
                    left join suppcertformmembtmp_tbl on suppcertformmembtmp_pk =  scfct_suppcertformmembtmp_fk 
                    where scftt_bgivaldocformdescmst_fk=:p5 and scfmt_membercompmst_fk = :p1) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)                     
                    ->bindValue(':p5' , $despt)        
                    ->execute();
                    $finarepmaintbl =\api\modules\mst\models\MemcompfinancialapprovalmainTbl::find()->where("mcfam_membercompanymst_fk=:compk
                     and mcfam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompfinancialapprovaldtls_tbl (mcfad_memcompfinancialapprovalmain_fk,
                        mcfad_memcompfinancialtemp_fk, mcfad_status, mcfad_comments, mcfad_isvalidated, mcfad_apprdclnby , mcfad_updatedon) select :p1, 
                        finapk, bstatus, comment, 2, NULL, now() from (select memcompfinancialtemp_pk as finapk, 
                        CASE WHEN mcft_scfstatus = 1 THEN 0 WHEN mcft_scfstatus = 2 THEN 3 WHEN mcft_scfstatus = 3 THEN 1 WHEN mcft_scfstatus = 4 
                        THEN 2 END AS bstatus,
                        mcft_appdeclcomments as comment from memcompfinancialtemp_tbl where mcft_membcompmst_fk =:p3 and mcft_scfstatus is not null
                        and mcft_isdeleted =2) as t")
                    ->bindValue(':p1' , $finarepmaintbl->memcompfinancialapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                 /* Insert shareholder  details table */
                $checkshareholderdet = \common\models\MemcompshareholderdtlsTbl::find()->where("mcshd_memcompmst_fk=:compk and
                mcshd_scfstatus is not null and mcshd_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($checkshareholderdet > 0){
                    Yii::$app->db->createCommand("insert into memcompshareholderapprovalmain_tbl (mcsham_membercompanymst_fk, mcsham_certapprovaldtls_fk, 
                    mcsham_level, mcsham_status, mcsham_movedtonxtlevel, mcsham_nxtlevel, mcsham_isvalidated, mcsham_comments, 
                    mcsham_apprdclnby, mcsham_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scfct_status = 1 THEN 0 WHEN scfct_status = 4 THEN 3 WHEN scfct_status = 2 THEN 1 WHEN scfct_status = 3 THEN 2 END AS catstatus, 
                    scfct_appdeclcomments as comment 
                    from suppcertformcattmp_tbl where scfct_suppcertformmembtmp_fk=:p5 and scfct_bgivaldoccatmst_fk= 10) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)                               
                    ->bindValue(':p5' , $SuppMemtbl->suppcertformmembtmp_pk)        
                    ->execute();
                    $shareholdermaintbl =\api\modules\mst\models\MemcompshareholderapprovalmainTbl::find()->where("mcsham_membercompanymst_fk=:compk
                     and mcsham_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompshareholderapprovaldtls_tbl (mcshad_memcompshareholderapprovalmain_fk,
                        mcshad_memcompshareholderdtls_fk, mcshad_status, mcshad_comments, mcshad_isvalidated, mcshad_apprdclnby , mcshad_updatedon) select :p1, 
                        shareholdpk, bstatus, comment, 2, NULL, now() from (select memcompshareholderdtls_pk as shareholdpk, 
                        CASE WHEN mcshd_scfstatus = 1 THEN 0 WHEN mcshd_scfstatus = 2 THEN 3 WHEN mcshd_scfstatus = 3 THEN 1 WHEN mcshd_scfstatus = 4 
                        THEN 2 END AS bstatus,
                        mcshd_appdeclcomments as comment from memcompshareholderdtls_tbl where mcshd_memcompmst_fk =:p3 and 
                        mcshd_scfstatus is not null and mcshd_isdeleted =2) as t")
                    ->bindValue(':p1' , $shareholdermaintbl->memcompshareholderapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                /* Insert Business source table */
                $bussrcdet = \common\models\MemcompbussrcdtlsTbl::find()->where("mcbsd_membercompanymst_fk=:compk and
                mcbsd_scfadminstatus is not null and mcbsd_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($bussrcdet > 0){
                    $despt = $formid == 1 ? 34  : 33;
                    Yii::$app->db->createCommand("insert into memcompbussrcapprovalmain_tbl (mcbsam_membercompanymst_fk, mcbsam_certapprovaldtls_fk, 
                    mcbsam_level, mcbsam_status, mcbsam_movedtonxtlevel, mcbsam_nxtlevel, mcbsam_isvalidated, mcbsam_comments, 
                    mcbsam_apprdclnby, mcbsam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scftt_status = 1 THEN 0 WHEN scftt_status = 4 THEN 3 WHEN scftt_status = 2 THEN 1 WHEN scftt_status = 3 THEN 2 END AS catstatus, 
                    scftt_appdeclcomments as comment 
                    from suppcertformtrntmp_tbl left join suppcertformcattmp_tbl on suppcertformcattmp_pk =  scftt_suppcertformcattmp_fk
                    left join suppcertformmembtmp_tbl on suppcertformmembtmp_pk =  scfct_suppcertformmembtmp_fk
                    where scftt_bgivaldocformdescmst_fk=:p5 and scfmt_membercompmst_fk = :p1) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)                         
                    ->bindValue(':p5' , $despt)         
                    ->execute();
                    $bussrcmaintbl = \api\modules\mst\models\MemcompbussrcapprovalmainTbl::find()->where("mcbsam_membercompanymst_fk=:compk
                     and mcbsam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompbussrcapprovaldtls_tbl (mcbsad_memcompbussrcapprovalmain_fk,
                        mcbsad_memcompbussrcdtls_fk, mcbsad_status, mcbsad_comments, mcbsad_isvalidated, mcbsad_apprdclnby , mcbsad_updatedon) select :p1, 
                        bussrcpk, bstatus, comment, 2, NULL, now() from (select memcompbussrcdtls_pk as bussrcpk, 
                        CASE WHEN mcbsd_scfadminstatus = 'N' THEN 0 WHEN mcbsd_scfadminstatus = 'U' THEN 3 WHEN mcbsd_scfadminstatus = 'A' THEN 1
                        WHEN mcbsd_scfadminstatus = 'D' THEN 2 END AS bstatus, mcbsd_appdeclcomments as comment from memcompbussrcdtls_tbl 
                        where mcbsd_membercompanymst_fk =:p3 and mcbsd_scfadminstatus is not null and mcbsd_isdeleted =2) as t")
                    ->bindValue(':p1' , $bussrcmaintbl->memcompbussrcapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                /* Insert Product table */
                $productdet = \common\models\MemcompproddtlsTbl::find()->where("MCPrD_MemberCompMst_Fk=:compk and
                MCPrD_SVFAdminApprovalStatus is not null and mcprd_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($productdet > 0){
                    $despt = $formid == 1 ? 13  : 28;
                    Yii::$app->db->createCommand("insert into memcompprodapprovalmain_tbl (mcpam_membercompanymst_fk, mcpam_certapprovaldtls_fk, 
                    mcpam_level, mcpam_status, mcpam_movedtonxtlevel, mcpam_nxtlevel, mcpam_isvalidated, mcpam_comments, 
                    mcpam_apprdclnby, mcpam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scftt_status = 1 THEN 0 WHEN scftt_status = 4 THEN 3 WHEN scftt_status = 2 THEN 1 WHEN scftt_status = 3 THEN 2 END AS catstatus, 
                    scftt_appdeclcomments as comment 
                    from suppcertformtrntmp_tbl left join suppcertformcattmp_tbl on suppcertformcattmp_pk =  scftt_suppcertformcattmp_fk
                    left join suppcertformmembtmp_tbl on suppcertformmembtmp_pk =  scfct_suppcertformmembtmp_fk 
                    where scftt_bgivaldocformdescmst_fk=:p5  and scfmt_membercompmst_fk =:p1) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)          
                    ->bindValue(':p5' , $despt)        
                    ->execute();
                    $productmaintbl = \api\modules\mst\models\MemcompprodapprovalmainTbl::find()->where("mcpam_membercompanymst_fk=:compk
                     and mcpam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompprodapprovaldtls_tbl (mcpad_memcompprodapprovalmain_fk,
                        mcpad_memcompproddtls_fk, mcpad_status, mcpad_comments, mcpad_isvalidated, mcpad_apprdclnby , mcpad_updatedon) select :p1, 
                        prdpk, bstatus, comment, 2, NULL, now() from (select MemCompProdDtls_Pk as prdpk, 
                        CASE WHEN MCPrD_SVFAdminApprovalStatus = 'N' THEN 0 WHEN MCPrD_SVFAdminApprovalStatus = 'U' THEN 3 WHEN 
                        MCPrD_SVFAdminApprovalStatus = 'A' THEN 1 WHEN MCPrD_SVFAdminApprovalStatus = 'D' THEN 2 END AS bstatus, 
                        mcprd_appdeclcomments as comment from memcompproddtls_tbl 
                        where MCPrD_MemberCompMst_Fk =:p3 and MCPrD_SVFAdminApprovalStatus is not null and mcprd_isdeleted =2) as t")
                    ->bindValue(':p1' , $productmaintbl->memcompprodapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
                 /* Insert Services table */
                $servicesdet = \common\models\MemcompservicedtlsTbl::find()->where("MCSvD_MemberCompMst_Fk=:compk and
                MCSvD_SVFAdminApprovalStatus is not null and mcsvd_isdeleted = 2",[':compk'=>$compaypk])->count();
                if($servicesdet > 0){
                    $despt = $formid == 1 ? 14  : 29;
                    Yii::$app->db->createCommand("insert into memcompserviceapprovalmain_tbl (mcsam_membercompanymst_fk, mcsam_certapprovaldtls_fk, 
                    mcsam_level, mcsam_status, mcsam_movedtonxtlevel, mcsam_nxtlevel, mcsam_isvalidated, mcsam_comments, 
                    mcsam_apprdclnby, mcsam_updatedon) select :p1, :p2, :p3, catstatus,  1, NULL, 2, comment, NULL, now() from 
                    (select CASE WHEN scftt_status = 1 THEN 0 CASE WHEN scftt_status = 4 THEN 3 WHEN scftt_status = 2 THEN 1 WHEN scftt_status = 3 THEN 2 END AS catstatus, 
                    scftt_appdeclcomments as comment 
                    from suppcertformtrntmp_tbl left join suppcertformcattmp_tbl on suppcertformcattmp_pk =  scftt_suppcertformcattmp_fk 
                    left join suppcertformmembtmp_tbl on suppcertformmembtmp_pk =  scfct_suppcertformmembtmp_fk 
                    where scftt_bgivaldocformdescmst_fk=:p5  and scfmt_membercompmst_fk =:p1) as t")
                    ->bindValue(':p1' , $compaypk)
                    ->bindValue(':p2' , $levelSuppMemtbl->certapprovaldtls_pk)
                    ->bindValue(':p3' , $level)                               
                    ->bindValue(':p5' , $despt)        
                    ->execute();
                    $servmaintbl = \api\modules\mst\models\MemcompserviceapprovalmainTbl::find()->where("mcsam_membercompanymst_fk=:compk
                     and mcsam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$levelSuppMemtbl->certapprovaldtls_pk])->one();
                    Yii::$app->db->createCommand("insert into memcompserviceapprovaldtls_tbl (mcsad_memcompserviceapprovalmain_fk,
                        mcsad_memcompservicedtls_fk, mcsad_status, mcsad_comments, mcsad_isvalidated, mcsad_apprdclnby , mcsad_updatedon) select :p1, 
                        servpk, bstatus, comment, 2, NULL, now() from (select MemCompServDtls_Pk as servpk, 
                        CASE WHEN MCSvD_SVFAdminApprovalStatus = 'N' THEN 0 WHEN MCSvD_SVFAdminApprovalStatus = 'U' THEN 3 WHEN 
                        MCSvD_SVFAdminApprovalStatus = 'A' THEN 1 WHEN MCSvD_SVFAdminApprovalStatus = 'D' THEN 2 END AS bstatus, 
                        mcsvd_appdeclcomments as comment from memcompservicedtls_tbl                         
                        where MCSvD_MemberCompMst_Fk =:p3 and MCSvD_SVFAdminApprovalStatus is not null and mcsvd_isdeleted =2) as t")
                    ->bindValue(':p1' , $servmaintbl->memcompserviceapprovalmain_pk)
                    ->bindValue(':p3' , $compaypk)
                    ->execute();
                }
            }
        }
    }
    public function actionChangevalidationstatus($compaypk,$certapprovaldtlspk,$validateuserpk,$userconf){
        Yii::$app->db->createCommand("update certcatsubcatapprovaldtls_tbl set ccscad_isvalidated=1, ccscad_apprdclnby= $validateuserpk where ccscad_certapprovaldtls_fk=:p1 and ccscad_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        Yii::$app->db->createCommand("update certapprovalpardtls_tbl set catd_isvalidated=1, catd_apprdclnby = $validateuserpk, catd_approvalworkflowuserconfig_fk = $userconf  where catd_certapprovaldtls_fk=:p1 and catd_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        Yii::$app->db->createCommand("update memcomptendbrdapprovalmain_tbl set mctbam_isvalidated=1, mctbam_apprdclnby = $validateuserpk  where mctbam_certapprovaldtls_fk=:p1 and mctbam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $omantendermaintbl = \api\modules\mst\models\MemcomptendbrdapprovalmainTbl::find()->where("mctbam_membercompanymst_fk=:compk and mctbam_certapprovaldtls_fk=:certap", 
        [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($omantendermaintbl) && !empty($omantendermaintbl->memcomptendbrdapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcomptendbrdapprovaldtls_tbl set mctbad_isvalidated=1, mctbad_apprdclnby = $validateuserpk where mctbad_memcomptendbrdapprovalmain_fk=:p1 and mctbad_isvalidated = 2")->bindValue(':p1' , $omantendermaintbl->memcomptendbrdapprovalmain_pk)->execute();
        }
        Yii::$app->db->createCommand("update memcompbranchapprovalmain_tbl set mcbam_isvalidated=1, mcbam_apprdclnby =  $validateuserpk where mcbam_certapprovaldtls_fk=:p1 and mcbam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $branchdetmaintbl =\api\modules\mst\models\MemcompbranchapprovalmainTbl::find()->where("mcbam_membercompanymst_fk=:compk  and mcbam_certapprovaldtls_fk=:certap", 
        [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($branchdetmaintbl) && !empty($branchdetmaintbl->memcompbranchapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompbranchapprovaldtls_tbl set mcbad_isvalidated=1, mcbad_apprdclnby =  $validateuserpk where mcbad_memcompbranchapprovalmain_fk=:p1 and mcbad_isvalidated = 2")->bindValue(':p1' , $branchdetmaintbl->memcompbranchapprovalmain_pk)->execute();
        }         
        Yii::$app->db->createCommand("update memcompfinancialapprovalmain_tbl set mcfam_isvalidated=1, mcfam_apprdclnby = $validateuserpk where mcfam_certapprovaldtls_fk=:p1 and mcfam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $finarepmaintbl =\api\modules\mst\models\MemcompfinancialapprovalmainTbl::find()->where("mcfam_membercompanymst_fk=:compk
        and mcfam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($finarepmaintbl) && !empty($finarepmaintbl->memcompfinancialapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompfinancialapprovaldtls_tbl set mcfad_isvalidated=1, mcfad_apprdclnby = $validateuserpk  where mcfad_memcompfinancialapprovalmain_fk=:p1 and mcfad_isvalidated = 2")->bindValue(':p1' , $finarepmaintbl->memcompfinancialapprovalmain_pk)->execute();
        }         
        Yii::$app->db->createCommand("update memcompshareholderapprovalmain_tbl set mcsham_isvalidated=1, mcsham_apprdclnby = $validateuserpk where mcsham_certapprovaldtls_fk=:p1 and mcsham_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $shareholdermaintbl =\api\modules\mst\models\MemcompshareholderapprovalmainTbl::find()->where("mcsham_membercompanymst_fk=:compk
        and mcsham_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($shareholdermaintbl) && !empty($shareholdermaintbl->memcompfinancialapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompshareholderapprovaldtls_tbl set mcshad_isvalidated=1, mcshad_apprdclnby = $validateuserpk  where mcshad_memcompshareholderapprovalmain_fk=:p1 and mcshad_isvalidated = 2")->bindValue(':p1' , $shareholdermaintbl->memcompshareholderapprovalmain_pk)->execute();
        }         
        Yii::$app->db->createCommand("update memcompbussrcapprovalmain_tbl set mcbsam_isvalidated=1, mcbsam_apprdclnby = $validateuserpk where mcbsam_certapprovaldtls_fk=:p1 and mcbsam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $bussrcmaintbl = \api\modules\mst\models\MemcompbussrcapprovalmainTbl::find()->where("mcbsam_membercompanymst_fk=:compk
        and mcbsam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($bussrcmaintbl) && !empty($bussrcmaintbl->memcompbussrcapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompbussrcapprovaldtls_tbl set mcbsad_isvalidated=1, mcbsad_apprdclnby = $validateuserpk  where mcbsad_memcompbussrcapprovalmain_fk=:p1 and mcbsad_isvalidated = 2")->bindValue(':p1' , $bussrcmaintbl->memcompbussrcapprovalmain_pk)->execute();
        }         
        Yii::$app->db->createCommand("update memcompprodapprovalmain_tbl set mcpam_isvalidated=1, mcpam_apprdclnby = $validateuserpk where mcpam_certapprovaldtls_fk=:p1 and mcpam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $productmaintbl = \api\modules\mst\models\MemcompprodapprovalmainTbl::find()->where("mcpam_membercompanymst_fk=:compk
        and mcpam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($productmaintbl) && !empty($productmaintbl->memcompprodapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompprodapprovaldtls_tbl set mcpad_isvalidated=1, mcpad_apprdclnby = $validateuserpk  where mcpad_memcompprodapprovalmain_fk=:p1 and mcpad_isvalidated = 2")->bindValue(':p1' , $productmaintbl->memcompprodapprovalmain_pk)->execute();
        }         
        Yii::$app->db->createCommand("update memcompserviceapprovalmain_tbl set mcsam_isvalidated=1, mcsam_apprdclnby = $validateuserpk where mcsam_certapprovaldtls_fk=:p1 and mcsam_isvalidated = 2")->bindValue(':p1' , $certapprovaldtlspk)->execute();
        $servmaintbl = \api\modules\mst\models\MemcompserviceapprovalmainTbl::find()->where("mcsam_membercompanymst_fk=:compk
                     and mcsam_certapprovaldtls_fk=:certap", [':compk'=>$compaypk,':certap'=>$certapprovaldtlspk])->one();
        if(!empty($servmaintbl) && !empty($servmaintbl->memcompserviceapprovalmain_pk)){
            Yii::$app->db->createCommand("update memcompserviceapprovaldtls_tbl set mcsad_isvalidated=1, mcsad_apprdclnby = $validateuserpk  where mcsad_memcompserviceapprovalmain_fk=:p1 and mcsad_isvalidated = 2")->bindValue(':p1' , $servmaintbl->memcompserviceapprovalmain_pk)->execute();
        }         
    }
}