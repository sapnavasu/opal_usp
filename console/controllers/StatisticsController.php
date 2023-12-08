<?php

namespace console\controllers;

use Yii;
use yii\base\Module;
use yii\console\Controller;
use yii\helpers\Console;
use \common\components\Security;
use \common\models\MemberregistrationmstTbl;
use \common\models\DownloadtracktrnsTbl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class ExtendedMessageController
 * @package console\controllers
 */

class StatisticsController extends Controller
{

    const SUPSTATFIELDNAME =    [
            'regNo' => 'Reg Number',
            'supplierCode' => 'Supplier Code',
            'companyName' => 'Company Name',
            'howDoYouKnow' => 'Source of Registration',
            'businessSource' => 'Business Source chosen at the time of registration',
            'sectorName' => 'Sector chosen at the time of registration',
            'classification' => 'Classification',
            'countryName' => 'Country',
            'stateName' => 'State',
            'cityName' => 'City',
            'crNumber' => 'CR Number',
            'crExpiry' => 'CR Expiry',
            'styleOfIncrop' => 'Style of Incorporation',
            'createdOn' => 'Created on / Registered Date',
            'conformOn' => 'Order Confirmed On',
            'jsrsExpDate' => 'JSRS Expiry Date',
            'pcUserName' => 'Username',
            'pcName' => 'Name',
            'pcEmail' => 'Email ID',
            'pcMobileNo' => 'Mobile',
            'pcLandLineNo' => 'Phone No',
            'jcName' => 'Name',
            'jcEmail' => 'Email ID',
            'jcMobileNo' => 'Mobile',
            'jcLandLineNo' => 'Phone No',
            'subscriptionMemberStatus' => 'Member Status',
            'paymentStatus' => 'Payment Status',
            'nbfProductCount' => 'Total Products (Count)',
            'nbfServiceCount' => 'Total Services (Count)',
            'scfProductCount' => 'JSRS Approved Products',
            'scfServiceCount' => 'JSRS Approved Services',
            'noOfLogin' => 'No of Login Times',
            'webPrimaryCount' => 'Web User',
            'andPrimaryCount' => 'Android User',
            'iosPrimaryCount' => 'IOS User',
            'futureExpDate' => 'Future Expiry Date',
            'yrsOfSubscription' => 'Years Of Subscription (Recent Subscription)',
            'lastPayReceivedDate' => 'Last Payment Received Date',
            'bankName' => 'Payment Received Bank',
            'lastinvoiceDate' => 'Last Invoice Date',
            'payLastApprovedOn' => 'Payment Last Approved On',
            'timesOfRenewal' => 'Times of Renewal',
            'scfStatus' => 'SCF Status',
            'scfLastResubmittedOn' => 'SCF Last Resubmitted On',
            'jsrsApprovedOn' => 'JSRS Approved On'
        ];

    public function actionSupplierstat($userPk, $companyPk, $memRegPk, $downloadInitiatePk, $fromReportDate='', $toReportDate='', $overAllSelectedField, $cntArrCnt, $inputFileName, $savePathName, $applicationPathName){
        $selectedField = str_replace('[','',$overAllSelectedField);
        $selectedField = str_replace(']','',$selectedField);
        $selectedField = substr_replace($selectedField,'',-4);

        $selectedField = explode('****,', $selectedField);


        $cntArrCntField = str_replace('[','',$cntArrCnt);
        $cntArrCntField = str_replace(']','',$cntArrCntField);
        $cntArrCntField = substr_replace($cntArrCntField,'',-4);

        $cntArrCntField = explode('****,', $cntArrCntField);
        $cntArrCntFieldArr = [];
        foreach ($cntArrCntField as $key => $cntArrCntFieldVal) {
            $splitKey = explode('*****', $cntArrCntFieldVal);
            $cntArrCntFieldArr[$splitKey[0]] = $splitKey[1];
        }

        $primaryContactCnt = $jsrsOperationCnt = $primaryContactCntCur = $jsrsOperationCntCur = $allCount = 0;
        foreach ($cntArrCntFieldArr as $key => $value) {
            if($key == 'primaryContactFields'){
                $primaryContactCnt = $allCount;
                $primaryContactCntCur = $value;
            }
            if($key == 'jsrsOperationCntFields'){
                $jsrsOperationCnt = $allCount; 
                $jsrsOperationCntCur = $value; 
            }
            $allCount += $value;
        }

        if(!empty($fromReportDate) && !empty($toReportDate)){
            $fromReportDate = date('Y-m-d', strtotime($fromReportDate));
            $toReportDate = date('Y-m-d', strtotime($toReportDate));
        }

        $supplierStatQuery = MemberregistrationmstTbl::find()
                                ->select($selectedField)
                                ->from('memberregistrationmst_tbl mrm')
                                ->innerJoin('membercompanymst_tbl mcm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk and MRM_MemberStatus = "A"')
                                ->innerJoin('usermst_tbl um','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk AND um.UM_Status = "A"')
                                ->leftJoin('businesssourcemst_tbl bsm','find_in_set(bsm.businesssourcemst_pk, mrm.mrm_businsrc) AND bsm.bsm_status = 1')
                                ->leftJoin('sectormst_tbl smt','find_in_set(smt.SectorMst_Pk, mrm.mrm_compsector) AND smt.SecM_Status = "A"')
                                ->leftJoin('countrymst_tbl cmt','um.um_primobnocc = cmt.CountryMst_Pk AND cmt.CyM_Status = "A"')
                                ->leftJoin('statemst_tbl sm','sm.StateMst_Pk = um.um_statemst_fk AND sm.SM_Status = "A"')
                                ->leftJoin('citymst_tbl cm','cm.CityMst_Pk = um.um_citymst_fk AND cm.CM_Status = "A"')
                                ->leftJoin('incorpstylemst_tbl icsm', 'mrm.mrm_incorpstylemst_fk = icsm.IncorpStyleMst_Pk AND icsm.ISM_Status = "A"')
                                ->leftJoin('howdoyouknowmst_tbl hdyk','hdyk.howdoyouknowmst_pk = mcm.mcm_howdoyouknowmst_fk AND hdyk.hdkm_status = "A"')
                                ->leftJoin('classificationmst_tbl clm', 'mcm.mcm_classificationmst_fk = clm.classificationmst_pk AND clm.ClM_Status = "A"')
                                ->leftJoin('v_acchst as vah','mrm.MemberRegMst_Pk = vah.mcaah_memberregmst_fk')
                                ->leftJoin('userlogintrack_tbl ult','ult.ult_usermst_fk = um.UserMst_Pk')
                                ->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk and mcprd.MCPrD_CreatedOn IS NOT NULL and mcprd.mcprd_isdeleted = 2')
                                ->leftJoin('memcompservicedtls_tbl mcsd','mcsd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk and mcsd.MCSvD_CreatedOn IS NOT NULL and mcsd.mcsvd_isdeleted = 2')
                                ->leftJoin('memcomppymtinfodtls_tbl mcpid','mcpid.mcpid_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompinvoicedtls_tbl mcid','mcid.mcid_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompaccactvnhstry_tbl mcaah','mcaah.mcaah_memberregmst_fk = mrm.MemberRegMst_Pk')
                                ->leftJoin('suppcertformmembtmp_tbl scfmt','scfmt.scfmt_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->where([
                                    'MemberRegMst_Pk' => 794,
                                    'mrm_stkholdertypmst_fk' => 6
                                ]);

        if(!empty($fromReportDate) && !empty($toReportDate)){
            $supplierStatQuery->andWhere(['between', "date_format(mcaah.mcaah_accountactivatedon,'%Y-%m-%d')", $fromReportDate, $toReportDate]);
        }    
        
        $supplierStatResult = $supplierStatQuery->groupBy(['MemberRegMst_Pk','UserMst_Pk'])
                                ->asArray()
                                ->all();

        //echo'<pre>';print_r($supplierStatResult->createCommand()->getRawSql());exit;
        //echo'<pre>';print_r($supplierStatResult);exit;
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        //$inputFileName = Yii::$app->params['supplierStatExportPath'];
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        //$supplierStatResult = [];
        $rowId = 10;
        $i = 1;
        foreach($supplierStatResult as $key => $supplierStatRslt) {
            if($key == 0){
                $j = 0;
                $colId = 'A';
                foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                    if($j == 0){
                        $j++; 
                        $colId++; 
                    }
                    if(array_key_exists($jKey, $supplierStatRslt)){
                        if(($j > $primaryContactCnt) && ($j <= ($primaryContactCnt + $primaryContactCntCur))){
                            $colspanstart = $colId;
                            if($j == ($primaryContactCnt + 1)){
                                $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId.$rowId, 'Primary Contact');
                                $spanColId = $colId;
                            }

                            if($j == ($primaryContactCnt + $primaryContactCntCur)){
                                $spreadsheet->setActiveSheetIndex(0)->mergeCells($spanColId.$rowId.':'.$colspanstart.$rowId);
                            }
                            
                            if($j <= ($primaryContactCnt + $primaryContactCntCur)){
                                $colspanstart++;
                                $j++;
                            }
                            $colId = $colspanstart;
                        }elseif(($j > $jsrsOperationCnt) && ($j <= ($jsrsOperationCnt + $jsrsOperationCntCur))){
                            $colspanstart = $colId;
                            if($j == ($jsrsOperationCnt + 1)){
                                $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId.$rowId, 'JSRS Operations Contact');
                                $spanColId = $colId;
                            }

                            if($j == ($jsrsOperationCnt + $jsrsOperationCntCur)){
                                $spreadsheet->setActiveSheetIndex(0)->mergeCells($spanColId.$rowId.':'.$colspanstart.$rowId);
                            }

                            if($j <= ($jsrsOperationCnt + $jsrsOperationCntCur)){
                                $colspanstart++;
                                $j++;
                            }
                            $colId = $colspanstart;
                        }else{
                            $j++;
                            $colId++;    
                        }
                    }
                }
                $rowId++;

                $j = 0;
                $colId = 'A';
                foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                    if($j == 0){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId,'Sl.No');
                        $j++;
                    }
                    if(array_key_exists($jKey, $supplierStatRslt)){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $supStatFieldName);
                    }
                }
                $rowId++;
            }

            $colId = 'A';
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $i);

            foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                if(array_key_exists($jKey, $supplierStatRslt)){
                    if($jKey == 'scfStatus'){
                        $finalValue = !empty($supplierStatRslt[$jKey])?$supplierStatRslt[$jKey]:'Yet to submit';
                    }else{
                        $finalValue = !empty($supplierStatRslt[$jKey])?$supplierStatRslt[$jKey]:'-';
                    }
                    
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $finalValue);
                }
            }

            $rowId++;
            $i++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        //$savePathName = Yii::$app->params['supplierStatExportSavePath'];
        $fileName = date('d-M-Y-His') . '.xlsx';
        $save_path =$savePathName.'reports/'.$fileName;

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        fopen($save_path, "w");
        $writer->save($save_path);

        $encrypDownloadInitiatePk = Security::encrypt($downloadInitiatePk);
        $downloadInitiate = DownloadtracktrnsTbl::find()
                                ->where([
                                    'downloadtracktrns_pk' => $downloadInitiatePk
                                ])
                                ->one();

        if(!empty($downloadInitiate)){
            $downloadInitiate->dtt_donwloadedfile = $fileName;
            $downloadInitiate->save();
        }



        $mailUrl = $applicationPathName.'backendadmin/download/'.$encrypDownloadInitiatePk;
        $bodyContent = "Dear Super Admin, Now click the below link to download the supplier statistics <a href='".$mailUrl."' target='_blank'>click here to download </a> to authorize it.  <br> Thanks";

        $mailSend = \Yii::$app->mailer->compose()
                ->setFrom(['noreply@businessgateways.com'=>'Business Gateways International'])
                ->setTo(['jeeva@businessgateways.com','ananth@businessgateways.com','saravanakumar@businessgateways.com','saifsami@businessgateways.com','srimathi@businessgateways.com','badmashree@businessgateways.com'])
                ->setSubject('Supplier Statistics Report')
                ->setHTMLBody($bodyContent);
        $mailSend->send();

        return true;
    }

    public function actionCronsupplierstat($inputFileName, $savePathName, $applicationPathName){
        $supplierStatQuery = MemberregistrationmstTbl::find()
                                ->select([
                                    "mcm.MCM_crnumber AS regNo",
                                    "mcm.MCM_SupplierCode AS supplierCode",
                                    "mcm.MCM_CompanyName AS companyName",
                                    "hdyk.hdkm_howdoyouknow AS howDoYouKnow",
                                    "group_concat(DISTINCT bsm.bsm_bussrcname) as businessSource",
                                    "group_concat(DISTINCT smt.SecM_SectorName) as sectorName",
                                    "clm.ClM_ClassificationType AS classification",
                                    "cmt.CyM_CountryName_en AS countryName",
                                    "sm.SM_StateName_en AS stateName",
                                    "cm.CM_CityName_en AS cityName",
                                    "mcm.MCM_crnumber AS crNumber",
                                    "mcm.MCM_RegistrationExpiry AS crExpiry",
                                    "icsm.ISM_IncorpStyleEntity AS styleOfIncrop",
                                    "mrm.MRM_CreatedOn AS createdOn",
                                    "mrm.MRM_OrderConfrmOn AS conformOn",
                                    "date_format(COALESCE(vah.mcaah_expirydate),  '%d-%m-%Y') as jsrsExpDate",
                                    "if(um.um_primarycontact = 1, um.UM_LoginId, '') as pcUserName",
                                    "if(um.um_primarycontact = 1, (concat_ws(' ', um.um_firstname, um.um_middlename, um.um_lastname)), '') as pcName",
                                    "if(um.um_primarycontact = 1, um.UM_EmailID, '') as pcEmail",
                                    "if(um.um_primarycontact = 1, um.um_primobno, '') as pcMobileNo",
                                    "if(um.um_primarycontact = 1, um.um_landlineno, '') as pcLandLineNo",
                                    "if(um.um_oprcontact = 1,(concat_ws(' ', um.um_firstname, um.um_middlename, um.um_lastname)), '') as jcName",
                                    "if(um.um_oprcontact = 1, um.UM_EmailID, '') as jcEmail",
                                    "if(um.um_oprcontact = 1, um.um_primobno, '') as jcMobileNo",
                                    "if(um.um_oprcontact = 1, um.um_landlineno, '') as jcLandLineNo",
                                    "(case mrm.MRM_MemberStatus when 'A' then 'Active' when 'I' then 'InActive' when 'V' then 'Validation Pending' end) as subscriptionMemberStatus",
                                    "(case mrm.MRM_AFVPStatus when 'N' then 'Not expired' when 'E' then 'Expired' when 'P' then 'Payment Done' when 'RC' then 'Payment Received' when 'RF' then 'Payment Refunded' when 'D' then 'Payment Declined' when 'PI' then 'Payment Inprogress' end) as paymentStatus",
                                    "count(mcprd.MemCompProdDtls_Pk) as nbfProductCount",
                                    "count(mcsd.MemCompServDtls_Pk) as nbfServiceCount",
                                    "if(mcprd.MCPrD_SVFAdminApprovalStatus = 'A', count(mcprd.MemCompProdDtls_Pk), 0) as scfProductCount",
                                    "if(mcsd.MCSvD_SVFAdminApprovalStatus = 'A', count(mcsd.MemCompServDtls_Pk), 0) as scfServiceCount",
                                    "count(ult.ult_usermst_fk) as noOfLogin", 
                                    "sum(if(ult.ult_loggedfrom = 1, 1, 0)) as webPrimaryCount",
                                    "sum(if(ult.ult_loggedfrom = 2, 1, 0)) as andPrimaryCount",
                                    "sum(if(ult.ult_loggedfrom = 3, 1, 0)) as iosPrimaryCount",
                                    "date_format(vah.mcaah_expirydate, '%d-%m-%Y') as futureExpDate",
                                    "date_format(vah.mcaah_expirydate, '%d-%m-%Y') as yrsOfSubscription",
                                    "if(mcpid.mcpid_pymtstatus = 3, date_format(max(mcpid.mcpid_submittedon), '%d-%m-%Y'), '') as lastPayReceivedDate",
                                    "if((mcpid.mcpid_paymenttype = 1 AND mcpid.mcpid_pymtmode = 1), mcpid.mcpid_bankname, '') as bankName",
                                    "(date_format(max(mcid.mcid_generatedon), '%d-%m-%Y')) as lastinvoiceDate",
                                    "if(mcpid.mcpid_pymtstatus = 3, date_format(max(mcpid.mcpid_approvedon), '%d-%m-%Y'), '') as payLastApprovedOn",
                                    "substring_index(group_concat(mcaah.mcaah_activationhierarchy order by memcompaccactvnhstry_pk desc), ',', 1) as timesOfRenewal",
                                    "substring_index(group_concat((case scfmt.scfmt_scfstatus when 'I' then 'In-progress' when 'A' then 'Approved' when 'D' then 'Declined' when 'RS' then 'Resubmitted' when 'R' then 'Reopened' when 'U' then 'Updated' when 'DI' then 'Declined In Progress' when 'OSD' then 'Overall SCF Declined' when 'OVD' then 'Overall VB Declined' when 'S' then 'Submitted' end) order by memcompaccactvnhstry_pk desc), ',', 1) as scfStatus",
                                    "(date_format(max(scfmt.scfmt_updatedon), '%d-%m-%Y')) as scfLastResubmittedOn",
                                    "date_format(mrm.MRM_ValAccOn, '%d-%m-%Y') as jsrsApprovedOn"
                                ])
                                ->from('memberregistrationmst_tbl mrm')
                                ->innerJoin('membercompanymst_tbl mcm','mrm.MemberRegMst_Pk = mcm.MCM_MemberRegMst_Fk and MRM_MemberStatus = "A"')
                                ->innerJoin('usermst_tbl um','mrm.MemberRegMst_Pk = um.UM_MemberRegMst_Fk AND um.UM_Status = "A"')
                                ->leftJoin('businesssourcemst_tbl bsm','find_in_set(bsm.businesssourcemst_pk, mrm.mrm_businsrc) AND bsm.bsm_status = 1')
                                ->leftJoin('sectormst_tbl smt','find_in_set(smt.SectorMst_Pk, mrm.mrm_compsector) AND smt.SecM_Status = "A"')
                                ->leftJoin('countrymst_tbl cmt','um.um_primobnocc = cmt.CountryMst_Pk AND cmt.CyM_Status = "A"')
                                ->leftJoin('statemst_tbl sm','sm.StateMst_Pk = um.um_statemst_fk AND sm.SM_Status = "A"')
                                ->leftJoin('citymst_tbl cm','cm.CityMst_Pk = um.um_citymst_fk AND cm.CM_Status = "A"')
                                ->leftJoin('incorpstylemst_tbl icsm', 'mrm.mrm_incorpstylemst_fk = icsm.IncorpStyleMst_Pk AND icsm.ISM_Status = "A"')
                                ->leftJoin('howdoyouknowmst_tbl hdyk','hdyk.howdoyouknowmst_pk = mcm.mcm_howdoyouknowmst_fk AND hdyk.hdkm_status = "A"')
                                ->leftJoin('classificationmst_tbl clm', 'mcm.mcm_classificationmst_fk = clm.classificationmst_pk AND clm.ClM_Status = "A"')
                                ->leftJoin('v_acchst as vah','mrm.MemberRegMst_Pk = vah.mcaah_memberregmst_fk')
                                ->leftJoin('userlogintrack_tbl ult','ult.ult_usermst_fk = um.UserMst_Pk')
                                ->leftJoin('memcompproddtls_tbl mcprd','mcprd.MCPrD_MemberCompMst_Fk = mcm.MemberCompMst_Pk and mcprd.MCPrD_CreatedOn IS NOT NULL and mcprd.mcprd_isdeleted = 2')
                                ->leftJoin('memcompservicedtls_tbl mcsd','mcsd.MCSvD_MemberCompMst_Fk = mcm.MemberCompMst_Pk and mcsd.MCSvD_CreatedOn IS NOT NULL and mcsd.mcsvd_isdeleted = 2')
                                ->leftJoin('memcomppymtinfodtls_tbl mcpid','mcpid.mcpid_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompinvoicedtls_tbl mcid','mcid.mcid_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->leftJoin('memcompaccactvnhstry_tbl mcaah','mcaah.mcaah_memberregmst_fk = mrm.MemberRegMst_Pk')
                                ->leftJoin('suppcertformmembtmp_tbl scfmt','scfmt.scfmt_membercompmst_fk = mcm.MemberCompMst_Pk')
                                ->where([
                                    'MemberRegMst_Pk' => 794,
                                    'mrm_stkholdertypmst_fk' => 6
                                ]);
                                

        $supplierStatResult = $supplierStatQuery->groupBy(['MemberRegMst_Pk','UserMst_Pk'])
                                ->asArray()
                                ->all();

        //echo'<pre>';print_r($supplierStatResult->createCommand()->getRawSql());exit;
        
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        //$inputFileName = Yii::$app->params['supplierStatExportPath'];
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $rowId = 10;
        $i = 1;
        foreach($supplierStatResult as $key => $supplierStatRslt) {
            if($key == 0){
                $j = 0;
                $colId = 'A';
                foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                    if($j == 0){
                        $j++; 
                        $colId++; 
                    }
                    if(array_key_exists($jKey, $supplierStatRslt)){
                        if(($j > $primaryContactCnt) && ($j <= ($primaryContactCnt + $primaryContactCntCur))){
                            $colspanstart = $colId;
                            if($j == ($primaryContactCnt + 1)){
                                $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId.$rowId, 'Primary Contact');
                                $spanColId = $colId;
                            }

                            if($j == ($primaryContactCnt + $primaryContactCntCur)){
                                $spreadsheet->setActiveSheetIndex(0)->mergeCells($spanColId.$rowId.':'.$colspanstart.$rowId);
                            }
                            
                            if($j <= ($primaryContactCnt + $primaryContactCntCur)){
                                $colspanstart++;
                                $j++;
                            }
                            $colId = $colspanstart;
                        }elseif(($j > $jsrsOperationCnt) && ($j <= ($jsrsOperationCnt + $jsrsOperationCntCur))){
                            $colspanstart = $colId;
                            if($j == ($jsrsOperationCnt + 1)){
                                $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId.$rowId, 'JSRS Contact');
                                $spanColId = $colId;
                            }

                            if($j == ($jsrsOperationCnt + $jsrsOperationCntCur)){
                                $spreadsheet->setActiveSheetIndex(0)->mergeCells($spanColId.$rowId.':'.$colspanstart.$rowId);
                            }

                            if($j <= ($jsrsOperationCnt + $jsrsOperationCntCur)){
                                $colspanstart++;
                                $j++;
                            }
                            $colId = $colspanstart;
                        }else{
                            $j++;
                            $colId++;    
                        }
                    }
                }
                $rowId++;

                $j = 0;
                $colId = 'A';
                foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                    if($j == 0){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId,'Sl.No');
                        $j++;
                    }
                    if(array_key_exists($jKey, $supplierStatRslt)){
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $supStatFieldName);
                    }
                }
                $rowId++;
            }

            $colId = 'A';
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $i);

            foreach (self::SUPSTATFIELDNAME as $jKey => $supStatFieldName) {
                if(array_key_exists($jKey, $supplierStatRslt)){
                    if($jKey == 'scfStatus'){
                        $finalValue = !empty($supplierStatRslt[$jKey])?$supplierStatRslt[$jKey]:'Yet to submit';
                    }else{
                        $finalValue = !empty($supplierStatRslt[$jKey])?$supplierStatRslt[$jKey]:'-';
                    }
                    
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($colId++.$rowId, $finalValue);
                }
            }

            $rowId++;
            $i++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        
        $fileName = date('d-M-Y-His') . '.xlsx';
        $save_path = $savePathName.$fileName;

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = new Xlsx($spreadsheet);
        fopen($save_path, "w");
        $writer->save($save_path);

        return true;
    }
}
