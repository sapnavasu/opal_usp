<?php

namespace api\modules\stat\components;

use Yii;
use common\components\Security;
use \common\models\MemberregistrationmstTbl;
use \common\models\DownloadtracktrnsTbl;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Supplierstat {
    const SUPSTATFIELDS = [
            'companyFields' => [
                'regNo'=>'mcm.MCM_crnumber as regNo', // Completed
                'supCode'=>'mcm.MCM_SupplierCode as supplierCode', // Completed
                'cmpNamae'=>'mcm.MCM_CompanyName as companyName', // Completed
                'srcOfReg'=>'hdyk.hdkm_howdoyouknow as howDoYouKnow', // Completed
                'bSrcAtReg'=>'group_concat(DISTINCT bsm.bsm_bussrcname) as businessSource', // Completed
                'secAtReg'=>'group_concat(DISTINCT smt.SecM_SectorName) as sectorName', // Completed
                'classification'=>'clm.ClM_ClassificationType as classification', // Completed 
                'country'=>'cmt.CyM_CountryName_en as countryName', // Completed
                'state'=>'sm.SM_StateName_en as stateName', // Completed
                'city'=>'cm.CM_CityName_en as cityName', // Completed
                'geoZone'=>'', // not required
                'crNum'=> 'mcm.MCM_crnumber as crNumber', // Completed
                'crExpiry'=>'mcm.MCM_RegistrationExpiry as crExpiry', // Completed
                'soi'=>'icsm.ISM_IncorpStyleEntity as styleOfIncrop', // Completed
                'createdOn'=>'mrm.MRM_CreatedOn as createdOn', // Completed
                'orderConformOn'=>'mrm.MRM_OrderConfrmOn as conformOn', // Completed
                'JsrsExpiryDate'=>'date_format(COALESCE(vah.mcaah_expirydate),\'%d-%m-%Y\') as jsrsExpDate' // Completed
            ],
            'primaryContactFields' => [
                'userName'=>"if(um.um_primarycontact = 1, um.UM_LoginId, '') as pcUserName", // Completed
                'name'=>'if(um.um_primarycontact = 1, (concat_ws(" ",um.um_firstname, um.um_middlename, um.um_lastname)), \'\') as pcName', // Completed
                'emailId'=>"if(um.um_primarycontact = 1, um.UM_EmailID, '') as pcEmail", // Completed
                'mobileNo'=>"if(um.um_primarycontact = 1, um.um_primobno, '') as pcMobileNo", // Completed
                'phoneNo'=>"if(um.um_primarycontact = 1, um.um_landlineno, '') as pcLandLineNo"// Completed
            ],
            'jsrsOperationCntFields' => [
                'name'=>'if(um.um_oprcontact = 1, (concat_ws(" ",um.um_firstname, um.um_middlename, um.um_lastname)), \'\') as jcName', // Completed
                'emailId'=>"if(um.um_oprcontact = 1, um.UM_EmailID, '') as jcEmail", // Completed
                'mobileNo'=>"if(um.um_oprcontact = 1, um.um_primobno, '') as jcMobileNo", // Completed
                'phoneNo'=>"if(um.um_oprcontact = 1, um.um_landlineno, '') as jcLandLineNo"// Completed
            ],
            'subscriptionDetails' => [
                'memberStatus'=>'(case mrm.MRM_MemberStatus when "A" then "Active" when "I" then "InActive" when "V" then "Validation Pending" end) as subscriptionMemberStatus', // Completed
                'subscriptionStatus'=>'mrm_memsubscriptionmst_fk', // Pending
                'paymentStatus'=>'(case mrm.MRM_AFVPStatus when "N" then "Not expired" when "E" then "Expired" when "P" then "Payment Done" when "RC" then "Payment Received" when "RF" then "Payment Refunded" when "D" then "Payment Declined" when "PI" then "Payment Inprogress" end) as paymentStatus'// Completed
            ],
            'enquiryDetails' => [ // Need to contact sreeni
                'rfxCntReceivedFromOperator'=>'', // Pending from sreeni end
                'rfxCntReceivedFromBuyer'=>'', // Pending from sreeni end
                'rfxCntReceivedFromContractor'=>'', // Pending from sreeni end
                'nbfPdtCount'=>'count(mcprd.MemCompProdDtls_Pk) as nbfProductCount', // Completed
                'nbfServiceCount'=>'count(mcsd.MemCompServDtls_Pk) as nbfServiceCount', // Completed
                'scfPdtCount'=>"if(mcprd.MCPrD_SVFAdminApprovalStatus = 'A', count(mcprd.MemCompProdDtls_Pk),0) as scfProductCount", // Completed
                'scfServiceCount'=>"if(mcsd.MCSvD_SVFAdminApprovalStatus = 'A', count(mcsd.MemCompServDtls_Pk),0) as scfServiceCount", // Completed
                'gccTenderSubscription'=>'' // still not
            ],
            'loginUserDetails' => [
                'noOfLogin'=>'count(ult.ult_usermst_fk) as noOfLogin', // Completed 
                'webUserIncPrimaryCnt'=>"sum(if(ult.ult_loggedfrom = 1, 1, 0)) as webPrimaryCount", // Completed
                'androidUserIncPrimaryCnt'=>"sum(if(ult.ult_loggedfrom = 2, 1, 0)) as andPrimaryCount", // Completed
                'iosUserIncPrimaryCnt'=>"sum(if(ult.ult_loggedfrom = 3, 1, 0)) as iosPrimaryCount" // Completed
            ],
            'paymentRenewalDetails' => [ // sathya
                'futureExpDate'=>'date_format(vah.mcaah_expirydate,\'%d-%m-%Y\') as futureExpDate', // Completed
                'yearsOfSubscription'=>'date_format(vah.mcaah_expirydate,\'%d-%m-%Y\') as yrsOfSubscription', // Completed
                'lastPayReceivedDate'=>"if(mcpid.mcpid_pymtstatus = 3,date_format(max(mcpid.mcpid_submittedon),'%d-%m-%Y') , '') as lastPayReceivedDate", // Completed
                'payReceivedBank'=>"if((mcpid.mcpid_paymenttype = 1 AND mcpid.mcpid_pymtmode = 1), mcpid.mcpid_bankname,'') as bankName", // Completed
                'lastinvoiceDate'=>"(date_format(max(mcid.mcid_generatedon),'%d-%m-%Y')) as lastinvoiceDate", // Completed
                'payLastApprovedOn'=>"if(mcpid.mcpid_pymtstatus = 3,date_format(max(mcpid.mcpid_approvedon),'%d-%m-%Y') , '') as payLastApprovedOn", // Completed
                'timesOfRenewal'=>"substring_index(group_concat(mcaah.mcaah_activationhierarchy order by memcompaccactvnhstry_pk desc), ',', 1) as timesOfRenewal" // Completed
            ],
            'certificationDetails' => [ // karthick || KIRUBA
                'scfStatus'=>"substring_index(group_concat((case scfmt.scfmt_scfstatus when 'I' then 'In-progress' when 'A' then 'Approved' when 'D' then 'Declined' when 'RS' then 'Resubmitted' when 'R' then 'Reopened' when 'U' then 'Updated' when 'DI' then 'Declined In Progress' when 'OSD' then 'Overall SCF Declined' when 'OVD' then 'Overall VB Declined' when 'S' then 'Submitted' end) order by memcompaccactvnhstry_pk desc), ',', 1) as scfStatus", // Completed
                'scfLastResubmittedOn'=>"(date_format(max(scfmt.scfmt_updatedon),'%d-%m-%Y')) as scfLastResubmittedOn",  // Completed
                'jsrsApprovedOn'=>'date_format(mrm.MRM_ValAccOn,\'%d-%m-%Y\') as jsrsApprovedOn', // Completed
                'sezadCertifiedOn'=>'', // Pending // Balaji
                /*'madayanCertifiedOn'=>'' // remove*/
            ]
        ];

    public function supplierStatResult($filterHeadings, $fromReportDate='', $toReportDate='')
    {
        $overAllSelectedFields = [];
        $cntArrCnt = [];
        foreach ($filterHeadings as $key => $filterHeadVal) {
            $getDbFields = [];
            if(array_key_exists($key, self::SUPSTATFIELDS)){
                $filterFieldHeader = (array) $filterHeadVal[0];
                $getDbFields = self::checkFieldAvailable($filterFieldHeader, self::SUPSTATFIELDS[$key], $filterHeadings);
                $cntArrCnt[] = $key.'*****'.count($getDbFields)."****";
            }
            $overAllSelectedFields = array_merge($overAllSelectedFields, $getDbFields);
        }
        
        self::supplierStatQuery($overAllSelectedFields, $cntArrCnt, $fromReportDate, $toReportDate);

        return 1;
    }

    public function checkFieldAvailable($userSearchFields, $defaultSearchFields, $filterHeadings){
        $selectedFieldArr = [];
        foreach ($userSearchFields as $key => $searchField) {
            if($searchField == 1 && array_key_exists($key, $defaultSearchFields)){
                $selectedFieldArr[] = $defaultSearchFields[$key]."****";
            }
        }
        return $selectedFieldArr;
    }

    public function supplierStatQuery($overAllSelectedFields, $cntArrCnt, $fromReportDate='', $toReportDate=''){
        
        if($fromReportDate || $toReportDate == ''){$fromReportDate='1/1/2000'; $toReportDate=date("Y/m/d");};
        $consolePath = Yii::$app->params['consolePath'];
        $consoleCalling = Yii::$app->params['consoleCalling'];
        $inputFileName = Yii::$app->params['supplierStatExportPath'];
        $savePathName = Yii::$app->params['supplierStatExportSavePath'];
        $applicationPathName = Yii::$app->params['baseUrl'];
       
        $overAllSelectedField = json_encode($overAllSelectedFields);

        $cntArrCnt = json_encode($cntArrCnt);
        
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $memRegPk = \yii\db\ActiveRecord::getTokenData('UM_MemberRegMst_Fk',true);
        
        $downloadInitiate = new DownloadtracktrnsTbl();

        $downloadInitiate->dtt_membercomp_fk = $companyPk;
        $downloadInitiate->dtt_usermst_fk = $userPk;
        $downloadInitiate->dtt_downloadiniton = date('Y-m-d H:i:s');
        $downloadInitiate->dtt_downloadstatus = 1;
        $downloadInitiate->dtt_downloadtype = 1;

       
        $downloadInitiate->save();
        $downloadInitiatePk = Yii::$app->db->getLastInsertID();
        $handle= shell_exec("{$consoleCalling} {$consolePath}yii statistics/supplierstat $userPk $companyPk $memRegPk $downloadInitiatePk $fromReportDate $toReportDate $overAllSelectedField $cntArrCnt $inputFileName $savePathName $applicationPathName");
        // $handle= pclose(popen("start {$consoleCalling} {$consolePath}yii statistics/supplierstat $userPk $companyPk $memRegPk $downloadInitiatePk $fromReportDate $toReportDate $overAllSelectedField $cntArrCnt $inputFileName $savePathName $applicationPathName", "r"));
        return true;
    }

    public function cronSupplierStatResult(){
        $consolePath = Yii::$app->params['consolePath'];
        $consoleCalling = Yii::$app->params['consoleCalling'];
        $inputFileName = Yii::$app->params['supplierStatExportPath'];
        $savePathName = Yii::$app->params['supplierStatExportSavePath'];
        $applicationPathName = Yii::$app->params['baseUrl'];

        echo shell_exec("{$consoleCalling} {$consolePath}yii statistics/cronsupplierstat $inputFileName $savePathName $applicationPathName");exit;
        $handle= pclose(popen("start {$consoleCalling} {$consolePath}yii statistics/cronsupplierstat $inputFileName $savePathName $applicationPathName", "r"));
        return true;

        return 1;
    }
}
