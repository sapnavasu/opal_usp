<?php

namespace api\modules\supplierdata\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use common\models\MembercompanymstTbl;
use common\models\StkholdertypmstTbl;
use common\models\StkholderaccessmstTbl;
use common\models\WsjsrssuppdatatrackTblQuery;
use common\models\OprtenderdtlsTbl;
use common\models\UsermstTbl;
use common\components\Tender;
use common\models\MemberregistrationmstTbl;
use common\components\GeneralFunctions;
use common\components\WebServiceFunctions;
use common\components\Wsdlcontract;
class SupplierdataController extends \yii\web\Controller
// class SupplierlistController extends ActiveController
{
    
    /**
     * @SWG\get(
     *     path="",
     *     tags={"Fetch Supplier datas"},
     *     produces={"application/json"},
     *     summary="It is used to get all supplier list.",
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionTest(){

        // Yii::$app->response->format = Response::FORMAT_XML;

        
        // $supplierinfos = Yii::$app->db->createCommand("select distinct a.MCM_CompanyName As CompanyName, a.mcm_RegistrationNo As JSRSRegistrationNo, CASE WHEN a.MCM_crnumber IS NULL OR a.MCM_crnumber='' THEN '' ELSE a.MCM_crnumber END AS ComRegNo, a.MCM_SupplierCode, c.MRM_ValSubStatus, b.SVFMD_ValAppStatus from membercompanymst_tbl a INNER JOIN suppvalformmembdtls_tbl b on b.SVFMD_MemberCompMst_Pk=a.MemberCompMst_Pk inner join memberregistrationmst_tbl c on c.MemberRegMst_Pk=a.MCM_MemberRegMst_Fk  left join memcompproddtls_tbl d on d.MCPrD_MemberCompMst_Fk=a.MemberCompMst_Pk left join memcompservicedtls_tbl e on e.MCSvD_MemberCompMst_Fk=a.MemberCompMst_Pk where b.SVFMD_ValAppStatus='Y' AND c.MRM_ConfirmationStatus = 'Y' AND c.MRM_ProfileStatus = 'C' and c.MRM_MemberStatus='A' and c.MRM_CompType='S'")->queryAll();
        // WsjsrssuppdatatrackTblQuery::find()->all();
        // echo '<pre>';print_r(44);exit; //Yii::$app->request->userIP //getRequest()->getUserIP()

       

        // $criteria = MembercompanymstTbl::find();
        // $criteria->from('membercompanymst_tbl a');
        // $criteria->innerJoin('memberregistrationmst_tbl as c','c.MemberRegMst_Pk=a.MCM_MemberRegMst_Fk');
        // $criteria->innerJoin('suppcertformmembdtls_tbl as b','b.scfmd_membercompmst_fk=MemberCompMst_Pk');
        // $criteria->where("c.MRM_ValSubStatus='A' and c.MRM_OrderConfrmStat = 'A'");
        // $criteria->andwhere("c.mrm_stkholdertypmst_fk = '6'");
        // $criteria->andwhere("c.MRM_MemberStatus='A'");
        // $criteria = $criteria->all();
       
        $companySuppList=array(6,59,60,61,62,64,65,66,67,72,73);
        // $memberRegs=  MembercompanymstTbl::find()->where(['in','MemberCompMst_Pk',$companySuppList])->all();
        // $memberRegs=  MembercompanymstTbl::findAll($companySuppList);
        $value = 'suraadasdesh@businessgateways.com';
        $val = 'suresh@businessgateways.com';
        $epcTender=  UsermstTbl::find()->select('UserMst_Pk')->where("UM_EmailID like '".trim($val)."'")->orwhere("um_secemailid like '".trim($value)."'")->column();
        // \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()->where("crfd_rqrefno='".$value."'")->all();

        echo '<pre>here';print_r(empty(implode(',',$epcTender)));exit;


        
        // return $xmlDoc;
    }
    public static function actionSupplierlist(){
       
        $operator = $_GET['opr'];
        if(isset($operator) && isset(Yii::$app->params['WS_List_Opr']) && is_array(Yii::$app->params['WS_List_Opr']) && isset(Yii::$app->params['WS_List_Opr'][$operator])){
            $response = Yii::$app->response->format = Response::FORMAT_XML;
            $response->charset = 'UTF-8';
            $supplierinfos = Yii::$app->db->createCommand("select distinct a.MCM_CompanyName As CompanyName, a.mcm_RegistrationNo As JSRSRegistrationNo, CASE WHEN a.MCM_crnumber IS NULL OR a.MCM_crnumber='' THEN '' ELSE a.MCM_crnumber END AS ComRegNo, a.MCM_SupplierCode, c.MRM_ValSubStatus, c.mrm_stkholdertypmst_fk AS MRM_CompType from membercompanymst_tbl a inner join memberregistrationmst_tbl c on c.MemberRegMst_Pk=a.MCM_MemberRegMst_Fk inner join suppcertformmembdtls_tbl b on b.scfmd_membercompmst_fk=a.MemberCompMst_Pk where c.MRM_ValSubStatus='A' AND c.MRM_MemberStatus='A' and c.MRM_OrderConfrmStat = 'A' and c.mrm_stkholdertypmst_fk = '6'")->queryAll();
            $xmlDoc = [];
            $xmlchild = [];
            $xmlDoc["ROOT"]["Author"] = "Business Gateways International";
            $xmlDoc["ROOT"]["Updated_On"] = date(('jS F, Y'));
            if (count($supplierinfos) > 0) {
                foreach ($supplierinfos as $k => $supplierinfo) {
                    $xmlchild = array(
                        "COMPANY" => array(
                            "JSRSNo" => htmlspecialchars($supplierinfo['JSRSRegistrationNo']),
                            "SUPP_CODE" => htmlspecialchars($supplierinfo['MCM_SupplierCode']),
                            "COMPANY_NAME" => htmlspecialchars($supplierinfo['CompanyName']),
                            "COM_REG_NO" => htmlspecialchars($supplierinfo['ComRegNo'])
                        )
                    );    
                    array_push($xmlDoc["ROOT"],$xmlchild);
                    $xmlchild = [];
                    /*$preApprovedSupplier = "FALSE";
                    if (($supplierinfo['MRM_ValSubStatus'] != 'A') OR is_null($supplierinfo['MRM_ValSubStatus'])) {
                        $preApprovedSupplier = "TRUE";
                    }*/
                }
            }
            $track_model = new WsjsrssuppdatatrackTblQuery;
            $track_model->wjsdt_memberregmst_fk = 7;
            $track_model->wjsdt_webserviceurl = 'N';
            $track_model->wjsdt_datatrasnferred = json_encode($xmlDoc);
            $track_model->wjsdt_requestedon = date('Y-m-d H:i:s');
            $track_model->wjsdt_requestipaddr = Yii::$app->getRequest()->getUserIP();
            $track_model->save();
            return $xmlDoc;
        }
        // else{
        //     return ;
        // }
    }

    public function actionUpdatedsupplierlist() {
        $operator = $_GET['opr'];
        if(isset($operator) && isset(Yii::$app->params['WS_List_Opr']) && is_array(Yii::$app->params['WS_List_Opr']) && isset(Yii::$app->params['WS_List_Opr'][$operator])){
            $response = Yii::$app->response->format = Response::FORMAT_XML;
            $response->charset = 'UTF-8';

            $env=Yii::$app->params['baseurl']['env'];
            $baseUrl=Yii::$app->params['baseurl'][$env];
            $oprUrlRef=strtolower($_GET['opr']);
            $url_action=Yii::$app->params['WS_Url_Arr'][$oprUrlRef];

            $xmlDoc = [];
            $xmlchild = [];
            $xmlDoc["ROOT"]["Author"] = "Business Gateways International";
            
            $dateinput = '';
            if(!empty($url_action)){
                $operator_id = Yii::$app->params['WS_List_Opr'][$operator];
                $opr = Yii::$app->db->createCommand("select * from wsjsrssuppdatatrack_tbl where wjsdt_memberregmst_fk=".$operator_id." order by wsjsrssuppdatatrack_pk desc")->queryOne(); //wstrack_tbl
                if (count($opr) > 0) {
                    $row = $opr;
                    $from = $_REQUEST['from']; // date format dd-mm-yyyy
                    $to = $_REQUEST['to']; // date format dd-mm-yyyy (Optionsl)
                    if (empty($from) && empty($to)) {
                        $d = date('Y-m-d', strtotime($row['wjsdt_requestedon']));
                        
                        $dateinput = " AND (date(c.mrm_profupdatedon) >= '$d') ";
                        $fromTo = "Updated From " . date('jS M, Y', strtotime($d));
                    } else {
                        if (isset($from) && empty($to)) { 
                            $d = date('Y-m-d', strtotime($from));
                            $dateinput = " AND (date(c.mrm_profupdatedon) = '$d') ";
                            $fromTo = "Updated On " . date('jS M, Y', strtotime($d));
                        } else {
                            $d1 = date('Y-m-d', strtotime($from));
                            $d2 = date('Y-m-d', strtotime($to));
                            $dateinput = " AND (date(c.mrm_profupdatedon) between '$d1' and '$d2') ";
                            $fromTo = "Updated From " . date('jS M, Y', strtotime($d1)) . " To " . date('jS M, Y', strtotime($d2));
                        }
                    }
                }
                $query = "select distinct a.MCM_CompanyName As CompanyName, a.mcm_RegistrationNo As JSRSRegistrationNo, CASE WHEN a.MCM_crnumber IS NULL OR a.MCM_crnumber='' THEN '' ELSE a.MCM_crnumber END AS ComRegNo, a.MCM_SupplierCode, c.mrm_profupdatedon as updated from membercompanymst_tbl a inner join memberregistrationmst_tbl c on c.MemberRegMst_Pk=a.MCM_MemberRegMst_Fk inner join suppcertformmembdtls_tbl b on b.scfmd_membercompmst_fk=a.MemberCompMst_Pk  where c.MRM_ValSubStatus='A' AND c.MRM_OrderConfrmStat = 'A' AND c.MRM_MemberStatus='A' and c.mrm_stkholdertypmst_fk='6' $dateinput order by c.mrm_profupdatedon desc";
                $supplierinfos = Yii::$app->db->createCommand($query)->queryAll();
                // $fromTo = "Updated On " . date('jS M, Y');
                $xmlDoc["ROOT"]["Updated"] = $fromTo;

                if (count($supplierinfos) > 0) {
                    foreach($supplierinfos as $k=>$supplierinfo) {
                        $xmlchild = array(
                            "COMPANY" => array(
                                "JSRSNo" => htmlspecialchars($supplierinfo['JSRSRegistrationNo']),
                                "SUPP_CODE" => htmlspecialchars($supplierinfo['MCM_SupplierCode']),
                                "COMPANY_NAME" => htmlspecialchars($supplierinfo['CompanyName']),
                                "COM_REG_NO" => htmlspecialchars($supplierinfo['ComRegNo']),
                                "UPDATED_DATE" => date('d-m-Y h:i a', strtotime($supplierinfo['updated'])),
                                "LINK" => $baseUrl.'wsdl/'.$oprUrlRef.'/'.$url_action.'?jsrsno=' . htmlspecialchars($supplierinfo['JSRSRegistrationNo'])
                            )
                        );
                        array_push($xmlDoc["ROOT"],$xmlchild);
                        $xmlchild = [];
                    }
                    $track_model = new WsjsrssuppdatatrackTblQuery;
                    $track_model->wjsdt_memberregmst_fk = $operator_id;
                    $track_model->wjsdt_webserviceurl = 'U';
                    $track_model->wjsdt_datatrasnferred = json_encode($xmlDoc);
                    $track_model->wjsdt_requestedon = date('Y-m-d H:i:s');
                    $track_model->wjsdt_requestipaddr = Yii::$app->getRequest()->getUserIP();
                    $track_model->save();
                }else {
                    $xmlDoc["ROOT"]["Status"] = 'No Vendors Found';
                }
            }else{
                $xmlDoc["ROOT"]["Status"] = 'No Vendors Found';
            }
            return $xmlDoc;
        }
    }
    public function actionSupplierdlt($jsrsno,$stkeHolder=NULL) {
        $response = Yii::$app->response->format = Response::FORMAT_XML;
        $response->charset = 'UTF-8';
        // $jsrsno,$stkeHolder=NULL
        $stkeHolder = strtolower($_GET['opr']);
        $xmlDoc = [];
        $xmlchild = [];

        // $xmlDoc = new \DOMDocument();
        // $xmlDoc->formatOutput = true; //make the output pretty
        // header("Content-Type: text/xml; charset=utf-8");
        
        // $root = $xmlDoc->appendChild($xmlDoc->createElement("ROOT"));
        if (isset($_REQUEST['jsrsno']) && !empty($jsrsno) && (isset($stkeHolder) && isset(Yii::$app->params['WS_List_Opr']) && is_array(Yii::$app->params['WS_List_Opr']) && isset(Yii::$app->params['WS_List_Opr'][$stkeHolder]))) {
            $operator_id = Yii::$app->params['WS_List_Opr'][$stkeHolder];
            $d = date('Y-m-d H:i:s');
           
            $opr = Yii::$app->db->createCommand("select * from wsjsrssuppdatatrack_tbl where wjsdt_memberregmst_fk='$operator_id'")->queryOne();
            if (count($opr) <= 0){
                Yii::$app->db->createCommand("insert into wsjsrssuppdatatrack_tbl (wjsdt_memberregmst_fk, wjsdt_requestedon) values ('$operator_id', '$d')")->execute();
            }else{
                $oprUpdate = Yii::$app->db->createCommand("update wsjsrssuppdatatrack_tbl set wjsdt_requestedon='$d' where wjsdt_memberregmst_fk='$operator_id'")->execute();
            }
                

            $supplierinfos = Yii::$app->db->createCommand("select 
            a.MemberCompMst_Pk,
            a.MCM_CompanyName As CompanyName,
            a.mcm_RegistrationNo As JSRSCode,
            a.MCM_RegistrationYear As RegYear,
            acc.MCAAH_ExpiryDate as MCAAH_ExpiryDate,
             CASE
                WHEN
                    a.MCM_crnumber IS NULL
                        OR a.MCM_crnumber = ''
                THEN
                    ''
                ELSE a.MCM_crnumber
            END AS RegNo,
            (select scfptt_paramvalue from suppcertformpartrntmp_tbl where scfptt_bgivaldoccatmst_fk = 2 and  scfptt_bgivaldocsubcatmst_fk = 30 and scfptt_bgivaldocsubcatpardtls_fk =398 and scfptt_membercompmst_fk = a.MemberCompMst_Pk) as CoCCertNo,
            CASE
                WHEN
                    a.MCM_website IS NULL
                        OR a.MCM_website = ''
                THEN
                    ''
                ELSE a.MCM_website
            END AS compwebsite,
            CASE
                WHEN
                    loc.mcmpld_emailid IS NULL
                        OR loc.mcmpld_emailid = ''
                THEN
                    ''
                ELSE loc.mcmpld_emailid
            END AS EmailID,
            loc.mcmpld_address as OfficialAdd,
            a.MCM_Origin,
            CASE
            WHEN a.MCM_Origin = '' or a.MCM_Origin = 'I' THEN 'International'
                ELSE CASE
                    WHEN a.MCM_Origin = 'N' THEN 'National'
                END
            END As Origin,
            CASE
                WHEN
                    loc.mcmpld_primobnocc IS NULL
                        OR loc.mcmpld_primobnocc = ''
                THEN
                    ''
                ELSE loc.mcmpld_primobnocc
            END AS PhoneNoCC,
            CASE
                WHEN
                    loc.mcmpld_primobno IS NULL
                        OR loc.mcmpld_primobno = ''
                THEN
                    ''
                ELSE loc.mcmpld_primobno
            END AS PhoneNo,
             CASE
                WHEN
                    loc.mcmpld_landlineext IS NULL
                        OR loc.mcmpld_landlineext = ''
                THEN
                    ''
                ELSE loc.mcmpld_landlineext
            END AS PhoneNoExt,
            if(b.MCGD_IncorpStyle = '0'
                    || b.MCGD_IncorpStyle = ''
                    || b.MCGD_IncorpStyle IS NULL,
                b.MCGD_OtherIncorpStyle,
                b.MCGD_IncorpStyle) AS OtherIncorpStyle,
                if(a.MCM_Origin = 'N',
                CASE
                    WHEN
                        b.MCGD_Classification IS NULL
                            OR b.MCGD_Classification = ''
                    THEN
                        ''
                    ELSE CASE
                        WHEN b.MCGD_Classification = 'SS' THEN 'Small'
                        ELSE CASE
                            WHEN b.MCGD_Classification = 'MS' THEN 'Medium'
                            ELSE CASE
                                WHEN b.MCGD_Classification = 'SM' THEN 'Micro'
                                ELSE CASE
                                    WHEN b.MCGD_Classification = 'L' THEN 'Large'
                                    ELSE CASE
                                        WHEN b.MCGD_Classification = 'VL' THEN 'Very Large'
                                    END
                                END
                            END
                        END
                    END
                END,
                'Int') AS CompanyType,
                CASE
                WHEN c.MCCD_Name IS NULL OR c.MCCD_Name = '' THEN ''
                ELSE c.MCCD_Name
            END AS contactName,
            CASE
                WHEN
                    c.MCCD_Designation IS NULL
                        OR c.MCCD_Designation = ''
                THEN
                    ''
                ELSE c.MCCD_Designation
            END AS Jobtitle,
            CASE
                WHEN
                    c.MCCD_Department IS NULL
                        OR c.MCCD_Department = ''
                THEN
                    ''
                ELSE CASE
                    WHEN c.MCCD_Department = 'BH' THEN 'Business Head'
                    ELSE CASE
                        WHEN c.MCCD_Department = 'M' THEN 'Marketing'
                        ELSE CASE
                            WHEN c.MCCD_Department = 'BA' THEN 'Business Administration'
                            ELSE CASE
                                WHEN c.MCCD_Department = 'JP' THEN 'JSRS'
                            END
                        END
                    END
                END
            END AS Department,
            CASE
                WHEN
                    c.MCCD_Email IS NULL
                        OR c.MCCD_Email = ''
                THEN
                    ''
                ELSE c.MCCD_Email
            END AS ContactEmail,
            CASE
                WHEN
                    c.MCCD_PriPhoneCC IS NULL
                        OR c.MCCD_PriPhoneCC = ''
                THEN
                    ''
                ELSE c.MCCD_PriPhoneCC
            END AS ContactPhoneCC,
            CASE
                WHEN
                    c.MCCD_Phone1 IS NULL
                        OR c.MCCD_Phone1 = ''
                THEN
                    ''
                ELSE c.MCCD_Phone1
            END AS ContactPhone,
            CASE
                WHEN
                    c.MCCD_PriPhoneExt1 IS NULL
                        OR c.MCCD_PriPhoneExt1 = ''
                THEN
                    ''
                ELSE c.MCCD_PriPhoneExt1
            END AS ContactPhoneExt,
            CASE
                WHEN
                    c.MCCD_AltPhoneCC IS NULL
                        OR c.MCCD_AltPhoneCC = ''
                THEN
                    ''
                ELSE c.MCCD_AltPhoneCC
            END AS AlterContactPhoneCC,
            CASE
                WHEN
                    c.MCCD_Phone2 IS NULL
                        OR c.MCCD_Phone2 = ''
                THEN
                    ''
                ELSE c.MCCD_Phone2
            END AS AlterContactPhone,
            CASE
                WHEN
                    c.MCCD_AltPhoneExt1 IS NULL
                        OR c.MCCD_AltPhoneExt1 = ''
                THEN
                    ''
                ELSE c.MCCD_AltPhoneExt1
            END AS AlterContactPhoneExt,
            CASE
                WHEN
                    c.MCCD_PriMobCC IS NULL
                        OR c.MCCD_PriMobCC = ''
                THEN
                    ''
                ELSE c.MCCD_PriMobCC
            END AS MobileCC,
            CASE
                WHEN
                    c.MCCD_Mobile IS NULL
                        OR c.MCCD_Mobile = ''
                THEN
                    ''
                ELSE c.MCCD_Mobile
            END AS Mobile,
            e.CyM_CountryCode_en as CountryName,
            CASE
                WHEN
                    g.SM_StateName_en IS NULL
                        OR g.SM_StateName_en = ''
                THEN
                    ''
                ELSE g.SM_StateName_en
            END as StateName,
            CASE
                WHEN
                    h.CM_CityName_en IS NULL
                        OR h.CM_CityName_en = ''
                THEN
                    ''
                ELSE h.CM_CityName_en
            END as CityName,
            CASE
                WHEN
                    i.ISM_IncorpStyleEntity IS NULL
                        OR i.ISM_IncorpStyleEntity = ''
                THEN
                    ''
                ELSE i.ISM_IncorpStyleEntity
            END As IncorpstyleValue,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 2 AND `scfpt_bgivaldocsubcatpardtls_fk` = 8 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as RegIssue,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 2 AND `scfpt_bgivaldocsubcatpardtls_fk` = 9 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as RegExpiry,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 2 AND `scfpt_bgivaldocsubcatpardtls_fk` = 10 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as RegIssueAuthority,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 30 AND `scfpt_bgivaldocsubcatpardtls_fk` = 150 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as CoCIssue,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 30 AND `scfpt_bgivaldocsubcatpardtls_fk` = 151 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as CoCExpiry,
            (SELECT scfpt_paramvalue FROM `suppcertformpartrn_tbl` WHERE `scfpt_bgivaldoccatmst_fk` = 2 AND `scfpt_bgivaldocsubcatmst_fk` = 30 AND `scfpt_bgivaldocsubcatpardtls_fk` = 152 AND `scfpt_membercompmst_fk` = a.MemberCompMst_Pk) as CoCIssueAuthority
        from
            membercompanymst_tbl a
            inner join memcompmplocationdtls_tbl loc ON loc.mcmpld_membercompmst_fk = a.MemberCompMst_Pk
            inner join
            memcompgendtls_tbl b ON a.MemberCompMst_Pk = b.MemberCompMst_Fk
            inner join
            memcompcontactdtls_tbl c ON c.MCCD_MemberCompMst_Fk = a.MemberCompMst_Pk
            inner join
            memberregistrationmst_tbl f ON f.MemberRegMst_Pk = a.MCM_MemberRegMst_Fk
            inner join 
            suppcertformmembdtls_tbl j on j.scfmd_membercompmst_fk=a.MemberCompMst_Pk 
            inner join
            countrymst_tbl e ON e.CountryMst_Pk = if(a.MCM_Origin = 'N',
                a.MCM_CountryMst_Fk,
                a.MCM_Source_CountryMst_Fk)
            left join
            v_acchst acc ON acc.MCAAH_MemberRegMst_Fk = a.MCM_MemberRegMst_Fk
            left join
            statemst_tbl g ON g.StateMst_Pk = a.MCM_StateMst_Fk
            left join
            citymst_tbl h ON h.CityMst_Pk = a.MCM_CityMst_Fk
            left join
            incorpstylemst_tbl i ON i.IncorpStyleMst_Pk = b.MCGD_IncorpStyle
            where f.MRM_ValSubStatus='A' AND f.MRM_OrderConfrmStat = 'A' and f.MRM_MemberStatus='A' and f.mrm_stkholdertypmst_fk='6' AND a.mcm_RegistrationNo = '$jsrsno'
          ")->queryOne();
        //   where c.MCCD_Department ='JP' AND f.MRM_ValSubStatus='A' AND f.MRM_OrderConfrmStat = 'Y' and f.MRM_MemberStatus='A' and f.mrm_stkholdertypmst_fk='6' AND a.mcm_RegistrationNo = '$jsrsno'
            if (count($supplierinfos) > 0 && !empty($supplierinfos)) {
                $supplierinfo = $supplierinfos;
                $suppActDetail = Yii::$app->db->createCommand("select c.SecM_SectorName as Sector, d.IndM_IndustryName as Industry, i.ActM_ActivityName as Activity from membercompanymst_tbl a inner join memcompsectordtls_tbl b on b.MCSD_MemberCompMst_Fk=a.MemberCompMst_Pk inner join memcompsectoractivitydtls_tbl h on h.MCSAD_MemCompSecDtls_Fk=b.MemCompSecDtls_Pk left join sectormst_tbl c on c.SectorMst_Pk=b.MCSD_SectorMst_Fk left join industrymst_tbl d on d.IndustryMst_Pk=b.MCSD_IndustryMst_Fk left join activitiesmst_tbl i on i.ActivitiesMst_Pk=h.MCSAD_ActivitiesMst_Fk where a.MemberCompMst_Pk = {$supplierinfo['MemberCompMst_Pk']}")->queryAll();

                $suppprodDetail = Yii::$app->db->createCommand("select c.PrdM_ProductCode As Code, c.PrdM_ProductName as ProductName, a.mcm_RegistrationNo as supplierCode from membercompanymst_tbl a inner join memcompproddtls_tbl b on b.MCPrD_MemberCompMst_Fk=a.MemberCompMst_Pk left join productmst_tbl c on c.ProductMst_Pk=b.MCPrD_ProductMst_Fk where a.MemberCompMst_Pk = {$supplierinfo['MemberCompMst_Pk']} AND MCPrD_SVFAdminApprovalStatus='A'")->queryAll();

                $suppservDetail = Yii::$app->db->createCommand("select c.SrvM_ServiceCode As Code, c.SrvM_ServiceName as ServiceName, a.mcm_RegistrationNo as supplierCode from membercompanymst_tbl a inner join memcompservicedtls_tbl b on b.MCSvD_MemberCompMst_Fk=a.MemberCompMst_Pk left join servicemst_tbl c on c.ServiceMst_Pk=b.MCSvD_ServiceMst_Fk where a.MemberCompMst_Pk = {$supplierinfo['MemberCompMst_Pk']} AND MCSvD_SVFAdminApprovalStatus='A'")->queryAll();
                $errorcode = "200";
                $errormsg = "Success";
                $i = 0;

                $JSRSNo = $supplierinfo['JSRSCode'];
                $CompanyName = htmlspecialchars($supplierinfo['CompanyName']);
                $JsrsExpiry = $supplierinfo['MCAAH_ExpiryDate']!=NULL ? date('d-m-Y', strtotime($supplierinfo['MCAAH_ExpiryDate'])) : '';
                $RegNo = $supplierinfo['RegNo'];
                $RegDate = $supplierinfo['RegIssue'];
                $RegExpiry = $supplierinfo['RegExpiry'];
                $RegIssueAuthority = $supplierinfo['RegIssueAuthority'];
//                $Omanizationfield = $supplierinfo['Omanizationfield'] == '' ? "" : $supplierinfo['Omanizationfield'] . '%';
                if($supplierinfo['MCM_Origin']=='I'){
                    $Currency = 'USD';
                    $Omanizationfield = '0.00%';
                }else{
                    $Currency = 'OMR';
                    $omanizationPer = Yii::$app->db->createCommand("select  ifnull(round((scficv.scficvbd_totomanihc/(scficv.scficvbd_totomanihc+scficv.scficvbd_totexpathc)) * 100, 2),0)as 'per' from scficvbreakdown_tbl as scficv
                    join membercompanymst_tbl as comp on scficv.scficvbd_memcompmst_fk = comp.MemberCompMst_Pk
                    join memberregistrationmst_tbl as reg on reg.MemberRegMst_Pk = comp.MCM_MemberRegMst_Fk where reg.MRM_MemberStatus = 'A' and reg.mrm_stkholdertypmst_fk='6' and MemberCompMst_Pk={$supplierinfo['MemberCompMst_Pk']} group by MemberCompMst_Pk")->queryOne();
                                        $Omanizationfield = $omanizationPer['per'].'%';
                                    }
                                    if ($supplierinfo['IncorpstyleValue'] == '') {
                                        $StyleOfIncorp = $supplierinfo['OtherIncorpStyle'];
                                    } elseif ($supplierinfo['IncorpstyleValue'] == 'INTER') {
                                        $StyleOfIncorp = "";
                                    } else {
                                        $StyleOfIncorp = trim($supplierinfo['IncorpstyleValue']);
                                    }
                                    $Classification = $supplierinfo['CompanyType'];
                                    $EstablisYear = $supplierinfo['RegYear']!=NULL ? date('d-m-Y', strtotime($supplierinfo['RegYear'])) : '';
                                    $CocCertNo = $supplierinfo['CoCCertNo'];
                                    $CocCertIssues = empty($supplierinfo['CoCIssue']) ? "" : $supplierinfo['CoCIssue'];
                                    $CocCertExpiry = empty($supplierinfo['CoCExpiry']) ? "" : $supplierinfo['CoCExpiry'];
                                    $CocIssueAuthority = empty($supplierinfo['CoCIssueAuthority']) ? "" : $supplierinfo['CoCIssueAuthority'];
                                    $Homepage = $supplierinfo['compwebsite'];
                                    $Email = $supplierinfo['EmailID'];
                                    $Country = $supplierinfo['CountryName'];
                                    $Address1 = $supplierinfo['OfficialAdd'];
                                    $Address2 = isset($supplierinfo['OfficialAdd2']) ? $supplierinfo['OfficialAdd2'] : '';
                                    $City = $supplierinfo['CityName'];
                                    $State = $supplierinfo['StateName'];
                                    $PhoneCC = $supplierinfo['PhoneNoCC'];
                                    $Phone = str_replace("-", "", preg_replace('/[^0-9\-]/', '', $supplierinfo['PhoneNo']));
                                    $PhoneExt = $supplierinfo['PhoneNoExt'];
                                    $FaxCC = $supplierinfo['FaxNoCC'];
                                    $Fax = str_replace("-", "", preg_replace('/[^0-9\-]/', '', $supplierinfo['FaxNo']));

                                    $con_name = $supplierinfo['contactName'];
                                    $exploder = explode(' ', $con_name);
                                    $firstname = $exploder[0];
                                    $midname = $exploder[1];
                                    $lname = $exploder[2];
                                    $Middlename = $midname . $lname;
                                    $lastname = !empty($Middlename) ? $Middlename : "";
                                    $Jobtitle = $supplierinfo['Jobtitle'];
                                    $Department = $supplierinfo['Department'];
                                    $con_mail = $supplierinfo['ContactEmail'];
                                    $con_phoneCC = $supplierinfo['ContactPhoneCC'];
                                    $con_phone = $supplierinfo['ContactPhone'];
                                    $con_phoneExt = $supplierinfo['ContactPhoneExt'];
                                    $mobileCC = $supplierinfo['MobileCC'];
                                    $mobile = str_replace("-", "", preg_replace('/[^0-9\-]/', '', $supplierinfo['Mobile']));
                                    $Alter_con_phoneCC = $supplierinfo['AlterContactPhoneCC'];
                                    $Alter_con_phone = preg_replace('/[^0-9\-]/', '', $supplierinfo['AlterContactPhone']);
                                    $Alter_con_phoneExt = $supplierinfo['AlterContactPhoneExt'];
                                    if (count($suppActDetail) > 0) {
                                        $activitiesArray = array();
                                        $sectorKey = 0;
                                        $x = 1;
                                        foreach($suppActDetail as $spk=>$suppActDetails) {
                                            $activitiesArray[$sectorKey]['SECTOR' . $x] = $suppActDetails['Sector'];
                                            $activitiesArray[$sectorKey]['INDUSTRY' . $x] = $suppActDetails['Industry'];
                                            $activitiesArray[$sectorKey]['ACTIVITY' . $x] = $suppActDetails['Activity'];
                                            $sectorKey++;
                                            $x++;
                                        }
                                    }
                                    if (count($suppprodDetail) > 0) {
                                        $productArray = array();
                                        $productKey = 0;
                                        $x = 1;
                                        foreach ($suppprodDetail as $pkey=>$suppprodDetails) {
                                            $productArray[$productKey]['UNSPSC_CODE' . $x] = $suppprodDetails['Code'];
                                            $productArray[$productKey]['PRODUCT_NAME' . $x] = $suppprodDetails['ProductName'];
                                            $productKey++;
                                            $x++;
                                        }
                                    }
                                    if (count($suppservDetail) > 0) {
                                        $serviceSerialNo = 1;
                                        $serviceArray = array();
                                        $serviceKey = 0;
                                        foreach ($suppservDetail as $skey=>$suppservDetails) {
                                            $serviceArray[$serviceKey]['UNSPSC_CODE' . $serviceSerialNo] = $suppservDetails['Code'];
                                            $serviceArray[$serviceKey]['SERVICE_NAME' . $serviceSerialNo] = $suppservDetails['ServiceName'];
                                            $serviceKey++;
                                            $serviceSerialNo++;
                                        }
                                    }
                                    $supplierinformation[$i] = array(
                                        'COMPANY' => array(
                                            'COMPANY_NAME' => "$CompanyName",
                                            'JSRSNO' => "$JSRSNo",
                                            'JSRS_EXPIRY' => "$JsrsExpiry",
                                            'COM_REG_NO' => "$RegNo",
                                            'CRDATE_OF_ISSUE' => "$RegDate",
                                            'CRDATE_OF_EXPIRY' => "$RegExpiry",
                                            'CRISSUING_AUTHORITY' => "$RegIssueAuthority",
                                            'OMANIZATIONFIELD' => "$Omanizationfield",
                                            'STYLE_OF_INCORP' => "$StyleOfIncorp",
                                            'COMPANY_TYPE' => "$Classification",
                                            'DATE_OF_ESTAENT' => "$EstablisYear",
                                            'CCCERTIFICATIONNUM' => "$CocCertNo",
                                            'CCCDT_OF_ISSUE' => "$CocCertIssues",
                                            'CCCDT_OF_EXPIRY' => "$CocCertExpiry",
                                            'ISSUING_AUTHORITY' => "$CocIssueAuthority",
                                            'HOMEPAGE' => "$Homepage",
                                            'SMTP_ADDR' => "$Email",
                                            'COUNTRY' => "$Country",
                                            'ADDRESS_LINE_1' => "$Address1",
                                            'ADDRESS_LINE_2' => "$Address2",
                                            'HOME_CITY' => "$City",
                                            'STATE' => "$State",
                                            'TEL_NUMBER_COUNTRY_CODE' => "$PhoneCC",
                                            'TEL_NUMBER' => "$Phone",
                                            'TEL_NUMBER_EXTENSION' => "$PhoneExt",
                                            'FAX_NUMBER_COUNTRY_CODE' => "$FaxCC",
                                            'FAX_NUMBER' => "$Fax",
                                            'CURRENCY' => "$Currency",
                                            'TITLE' => "M/S",
                                            'NAME_FIRST' => "$con_name",
                                            'NAME_LAST' => '',
                                            'DESIGNATION' => "$Jobtitle",
                                            'DEPARTMENT' => "$Department",
                                            'MOBILE_COUNTRY_CODE' => "$mobileCC",
                                            'MOBILE' => "$mobile",
                                            'PHONE_NUMBER2_COUNTRY_CODE' => "$con_phoneCC",
                                            'PHONE_NUMBER2' => "$con_phone",
                                            'PHONE_NUMBER2_EXTENSION' => "$con_phoneExt",
                                            'CONTACT_EMAIL' => "$con_mail",
                                        ),
                                        'ACTIVITIES' => $activitiesArray,
                                        'PRODUCTS' => $productArray,
                                        'SERVICES' => $serviceArray
                                    );
                                    $xmlDoc["ROOT"]['STATUS_CODE'] =  $errorcode;
                                    $xmlDoc["ROOT"]['STATUS_MESSAGE'] =  $errormsg;
                                    foreach ($supplierinformation as $detail) {
                                        foreach ($detail['COMPANY'] as $key => $value) {
                                            $xmlchild[$key] = htmlentities($value);
                                        }
                                        if (!empty($detail['ACTIVITIES'])) {
                                            foreach ($detail['ACTIVITIES'] as $actvalue) {
                                                if (!empty($actvalue)) {
                                                    foreach ($actvalue as $key => $value) {
                                                        $xmlchild[$key] = htmlentities($value);
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($detail['PRODUCTS'])) {
                                            foreach ($detail['PRODUCTS'] as $prodvalue) {
                                                if (!empty($prodvalue)) {
                                                    foreach ($prodvalue as $key => $value) {
                                                        $xmlchild[$key] = htmlentities($value);
                                                    }
                                                }
                                            }
                                        }
                                        if (!empty($detail['SERVICES'])) {
                                            foreach ($detail['SERVICES'] as $servvalue) {
                                                if (!empty($servvalue)) {
                                                    foreach ($servvalue as $key => $value) {
                                                        $xmlchild[$key] = htmlentities($value);
                                                    }
                                                }
                                            }
                                        }
                                        $xmlDoc["ROOT"]["COMPANY"] = $xmlchild;
                                        $xmlchild = [];
                                    }
                                } else {
                                    $xmlDoc["ROOT"] = array('STATUS_CODE'=> "414",'STATUS_MESSAGE'=>"JSRS Supplier Code Missing");
                                }
                            } else {
                                $xmlDoc["ROOT"] = array('STATUS_CODE'=> "414",'STATUS_MESSAGE'=>"JSRS Supplier Code Missing");
                            }
                            $this->trackLog($xmlDoc, $stkeHolder);
                            return $xmlDoc;
                        }
    public function trackLog($xml,$stkeHolder){
        $xmlArr = $xml['ROOT'];
        $RequestPath = explode('api',dirname(__DIR__))[0].'api/runtime/wsdllog/'.$stkeHolder.'/';
        // echo $RequestPath;exit;
        if (!is_dir($RequestPath)) {
            mkdir($RequestPath, 0777, true);
        }
        $requestFileName = date('Ym').'.csv';
        $rows['STATUS']=$xmlArr['STATUS_MESSAGE'];
        $rows['STS_CODE']=$xmlArr['STATUS_CODE'];
        $rows['JSRS_NO']=$xmlArr['COMPANY']['JSRSNO'];
        $rows['COM_NAME']=$xmlArr['COMPANY']['COMPANY_NAME'];
        $rows['COM_DTL_STRING']= json_encode($xmlArr['COMPANY']);
        $rows['REQUESTED_ON']=date('Y-m-d H:i:s');
        $newfile=false;
        if(!file_exists($RequestPath.$requestFileName)){
            $newfile=True;
        }
        $file = fopen($RequestPath.$requestFileName, 'a');
        if($newfile)
            @fputcsv($file, array_keys($rows)); 
        @fputcsv($file, $rows); 
    }
     // This function write for all the operator to share link commonly
     public function actionXml(){
        // echo $_REQUEST['compName'];exit;
        // $tenderTarget=new Tender(5899,456);  // t2 - 6605, t3- 5899
        // $companyList=$tenderTarget->audience('MEMONLY');
        // print_r($companyList);exit;
        if(trim(strtolower($_REQUEST['compName']))!='omanlng'){
            $param = array('compName','url');
            $paramCount = count($param);
            $notEmptyParam = array('compName','url');
        }else{
            $param = array('compName');
            $paramCount = count($param);
            $notEmptyParam = array('compName');
        }
        if(OprtenderdtlsTbl::requestCount($paramCount) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL1','msg'=>'Parameter Mismatch, Kindly Provide Requested Parameter alone']);
        }elseif(OprtenderdtlsTbl::requestParam($param) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL2','msg'=>'Given Parameter Key is Wrong']);
        }elseif(OprtenderdtlsTbl::requestedParamIsEmpty($notEmptyParam) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL3','msg'=>'Requested Parameter(s) should not be Empty']);
        }else{ 
    //        $url = "C:\Users\bgi124.BGIINDIA\Documents\JSRS-Tender-Template.xml"; // for local testing
            date_default_timezone_set('Asia/Muscat');
            ini_set('max_execution_time', 3000000); //300 seconds = 5 minutes

            $ExcompName = $_REQUEST['compName'];
            // $userMst= UsermstTbl::find("UM_ExternalLink='{$ExcompName}'");
            $userMst= UsermstTbl::find()->where(["UM_ExternalLink"=>$ExcompName])->one();
            if(empty($userMst)){
                echo json_encode(['statusCode'=>'TURL4','msg'=>'Given shortName is not Valid']);
                exit;
            }
            $regDetails = $userMst->uMMemberRegMstFk;


            $suppservDetail = Yii::$app->db->createCommand("select membercompanymst_tbl.* from memberregistrationmst_tbl left join stkholdertypmst_tbl on stkholdertypmst_pk = mrm_stkholdertypmst_fk left join membercompanymst_tbl on MCM_MemberRegMst_Fk = MemberRegMst_Pk where stkholdertypmst_pk=7 and `MemberRegMst_Pk` = '$regDetails->MemberRegMst_Pk'")->queryOne();

            $compPk = isset($suppservDetail['MemberCompMst_Pk']) ? $suppservDetail['MemberCompMst_Pk'] : $suppservDetail->MemberCompMst_Pk;
            $oprConfigDetails = Yii::$app->params['OprDetails'];
            $configURL = $oprConfigDetails[$compPk]['openTender_WS_XML_URL'];
            if(empty($configURL)){
                $url = $_REQUEST['url']; 
            }else{
                $url = $configURL;
            }
           
            // $xml = simplexml_load_file($url);
            // // $xml = file_get_contents('D:\xampp7\htdocs\j3 doc\JSRS-Tender-Template.xml');

            function get_data($url) {
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                return $data;
            }
            $returned_content = get_data($url);
            $xml = simplexml_load_string($returned_content) or die("Failed loading XML\n");
            // echo '$source';
            // echo '<pre>';print_r($xml->Tenders->TenderDetails);//exit;


            if(!empty($suppservDetail)){
                $adminUser = $userMst;
            }else{
                $adminUser = $userMst;
            }
            
            if(!empty($adminUser)){
                $adminUserPk = $adminUser->UserMst_Pk;
            }
            // if($xml==false){
            //     echo "Failed loading XML\n";
            //     exit;
            // }
            // echo 45;exit;
            $RequestPath = explode('api',dirname(__DIR__))[0].'api/runtime/wslog/'.$compPk.'/';
            $requestFileName = date('Y-m-d').'_Request'.'.txt';
            OprtenderdtlsTbl::writeLog($RequestPath,$requestFileName,$xml);
            // foreach ($xml as $x)
            $resstatus = [];
            foreach ($xml->Tenders->TenderDetails as $x){
            // for($i=0;$i<count($xml->Tender);$i++){
            //     $x = $xml->Tender[$i];
                $Status='Fail';
                if(isset($x->Tenderid) && !empty((string)$x->Tenderid)){
                    $TendNo=$x->TenderNo;
                    $TendNo= addslashes($TendNo);
                    // $model1=OprtenderdtlsTbl::model()->find("OTD_TenderRefNo ='{$TendNo}'  AND OTD_OprCompmst_Fk=$compPk");
                    $model1=OprtenderdtlsTbl::find()->where(['OTD_TenderRefNo'=>$TendNo,'OTD_OprCompmst_Fk'=>$compPk])->One();
                    if(count($model1)==0){
                    // if(1){
                        $model=new OprtenderdtlsTbl;
                        $resArray = self::setValue($model, $x);
                        if(empty($resArray)){
                            $model->OTD_OprCompmst_Fk=$compPk;
                            $model->OTD_CreatedOn = date("Y-m-d H:i:s");
                            if(!empty($adminUserPk))
                                $model->OTD_CreatedBy = $adminUserPk;
                            if($model->save()){
                                $Status='Success';
//                                $resArray['StatusCode']='S0001';
//                                $resArray['msg']='Created Successfully';
                                $insert_id = Yii::$app->db->getLastInsertID();
                               /* $tenderTargetFile= 'tenderstarget/pending_targets/'.$insert_id.'.txt';
                                $handle = fopen($tenderTargetFile, 'w') or die('Cannot open file:  '.$tenderTargetFile);


                                $tenderTarget=new Tender($insert_id);
                                $memPk= GeneralFunctions::supplierList(); // membercompany should not get Notification
                                $companyList=$tenderTarget->audience('MEMONLY'); // Targeted Supplier membercomp List
                                $companySuppList=array_diff($companyList,$memPk);
                                if(count($companySuppList) > 0){
                                    $tenderTargettedToday = 'tenderstarget/targetted_today/' .$insert_id. '.txt';
                                    $tender = fopen($tenderTargettedToday, 'w') or die('Cannot open file:  ' . $tenderTargettedToday);
                                    $memberRegs=  MembercompanymstTbl::model()->findAll("MemberCompMst_Pk IN (".  implode(",",$companySuppList).")");
                                    $memberRegArray = array();
                                    foreach($memberRegs as $memberReg){
                                        $memberRegArray[] = $memberReg->MCM_MemberRegMst_Fk;
                                    }
                                    fwrite($tender, implode(',',$memberRegArray));
                                    //target table insertion
                                    $mergeredPk = ",".implode(",", $memberRegArray).",";
                                    // $sql = "INSERT INTO `oprtendtrgtdtls_tbl`( `OTTD_OrpicTenderDtls_FK`, `OTTD_CompRegPk`, `OTTD_mailstatus`) values ('{$insert_id}' , '{$mergeredPk}' , 'N')";
                                    Yii::$app->db->createCommand($sql)->execute();
                                }*/
                                $tenderTarget=new Tender($insert_id);
                                $memPk= GeneralFunctions::supplierList(); // membercompany should not get Notification
                                $companyList=$tenderTarget->audience('MEMONLY'); // Targeted Supplier membercomp List
                                $companySuppList=array_diff($companyList,$memPk);
                                if(count($companySuppList) > 0){
                                    $memberRegs=  MembercompanymstTbl::find()->where(['in','MemberCompMst_Pk',$companySuppList])->all();
                                    $memberRegArray = array();
                                    foreach($memberRegs as $memberReg){
                                        $memberRegArray[] = $memberReg->MCM_MemberRegMst_Fk;
                                    }
                                    //target table insertion
                                    $mergeredPk = ",".implode(",", $memberRegArray).",";
                                    $sql = "INSERT INTO `oprtendtrgtdtls_tbl`( `OTTD_OrpicTenderDtls_FK`, `OTTD_CompRegPk`, `OTTD_mailstatus`) values ('{$insert_id}' , '{$mergeredPk}' , 'N')";
                                    Yii::$app->db->createCommand($sql)->execute();
                                }
                            }else{
                                $resArray['StatusCode']='S0500';
                                $resArray['msg']=$model->getErrors();
                                
                            }
                        }
                    }
                    else{
                        $notMatch = array('OTD_OprCompmst_Fk','OTD_CreatedOn','OTD_UpdatedOn','OTD_UpdatedBy');
                        $modelOld = clone $model1;
                        $hasDifference = 0;
                        $resArray = self::setValue($model1, $x);
                        if(empty($resArray)){
                            $model1->OTD_UpdatedOn = date("Y-m-d H:i:s");
                            if(!empty($adminUserPk))
                                $model1->OTD_UpdatedBy = $adminUserPk;
                            foreach ($modelOld->attributes as $field=>$value){
                                if(!in_array($field, $notMatch)){
                                    if($value != $model1->$field){
                                        $hasDifference = 1;
                                        break;
                                    }
                                }
                            }
                            if($hasDifference == 1)
                            {
                                if($model1->update()){
                                    $Status='Success';
//                                    $resArray['StatusCode']='S0001';
//                                    $resArray['msg']='Updated Successfully';
                                    $insert_id = $model1->OrpicTenderDtls_PK;
                                    /*
                                    $tenderTargetFile= 'tenderstarget/pending_targets/'.$insert_id.'.txt';
                                    $handle = fopen($tenderTargetFile, 'w') or die('Cannot open file:  '.$tenderTargetFile); 


                                    $tenderTarget=new Tender($insert_id,$compPk);
                                    $memPk= GeneralFunctions::supplierList(); // membercompany should not get Notification
                                    $companyList=$tenderTarget->audience('MEMONLY'); // Targeted Supplier membercomp List
                                    $companySuppList=array_diff($companyList,$memPk);
                                    if(count($companySuppList) > 0)
                                    {   
                                        $tenderTargettedToday = 'tenderstarget/targetted_today/' .$insert_id. '.txt';
                                        $tender = fopen($tenderTargettedToday, 'w') or die('Cannot open file:  ' . $tenderTargettedToday);
                                        $memberRegs=  MembercompanymstTbl::model()->findAll("MemberCompMst_Pk IN (".  implode(",",$companySuppList).")");
                                        $memberRegArray = array();
                                        foreach($memberRegs as $memberReg){
                                            $memberRegArray[] = $memberReg->MCM_MemberRegMst_Fk;
                                        }
                                        fwrite($tender, implode(',',$memberRegArray));
                                        //target table insertion
                                        $mergeredPk = ",".implode(",", $memberRegArray).",";
                                        Yii::$app->db->createCommand("UPDATE oprtendtrgtdtls_tbl SET OTTD_CompRegPk = '{$mergeredPk}'  , OTTD_mailstatus = 'N' WHERE OTTD_OrpicTenderDtls_FK=$insert_id")->execute();
                                        Yii::$app->db->createCommand("Delete from jsrstenddeldtls_tbl where JTDD_OrpicTenderDtls_Fk=$insert_id")->execute(); // Drop the notification while updateing
                                    }*/

                                    $tenderTarget=new Tender($insert_id,$compPk);
                                    $memPk= GeneralFunctions::supplierList(); // membercompany should not get Notification
                                    $companyList=$tenderTarget->audience('MEMONLY'); // Targeted Supplier membercomp List
                                    $companySuppList=array_diff($companyList,$memPk);
                                    if(count($companySuppList) > 0){
                                        $memberRegs=  MembercompanymstTbl::find()->where(['in','MemberCompMst_Pk',$companySuppList])->all();
                                        $memberRegArray = array();
                                        foreach($memberRegs as $memberReg){
                                            $memberRegArray[] = $memberReg->MCM_MemberRegMst_Fk;
                                        }
                                        //target table insertion
                                        $mergeredPk = ",".implode(",", $memberRegArray).",";
                                        Yii::$app->db->createCommand("UPDATE oprtendtrgtdtls_tbl SET OTTD_CompRegPk = '{$mergeredPk}'  , OTTD_mailstatus = 'N' WHERE OTTD_OrpicTenderDtls_FK=$insert_id")->execute();
                                        Yii::$app->db->createCommand("Delete from jsrstenddeldtls_tbl where JTDD_OrpicTenderDtls_Fk=$insert_id")->execute(); // Drop the notification while updateing
                                       
                                    }
                                }else{
                                    $resArray['StatusCode']='S0500';
                                    $resArray['msg']=$model1->getErrors();
                                }
                            }else{
                                $resArray['StatusCode']=$resstatus['StatusCode']='S0010';
                                $resArray['msg']='Update Data has no Difference';
                                $resstatus['msg'] = 'Update Data has no Difference';
                            }
                        }
                    }
                }else{
                    $resArray['StatusCode']= 'S0011';
                    $resArray['msg']='Tenderid is missing';
                    
                }
                if($Status == 'Fail'){
                    $masArr[(string)$x->Tenderid]=$resArray;
                }
            }
            if(!empty($masArr)){
                $responseFileName = date('Y-m-d').'_Response'.'.txt';
                OprtenderdtlsTbl::writeLog($RequestPath,$responseFileName,$masArr);
                if(empty($resstatus)){
                    $resstatus['StatusCode'] = 'S0011';
                    $resstatus['msg'] = 'Will send an error response very soon';
                }
            }else{
                $resstatus['StatusCode']='S0200';
                $resstatus['msg']='successfully imported';
            }
            echo json_encode($resstatus);exit;
        }
    }
    public static function setValue($model,$value){
        //Tenderid
        if(!empty(trim($value->Tenderid))){
            if(strlen((string)$value->Tenderid) <=  200){
                $model->otd_tenderid = $value->Tenderid;
            }else{
                 $resArray['Tenderid']['StatusCode']='T0004';
                 $resArray['Tenderid']['msg']='TenderId Max Char 200';
            }
        }else{
             $resArray['Tenderid']['StatusCode']='T0002';
             $resArray['Tenderid']['msg']='TenderId is Empty';
        }
        //TenderNo
        if(!empty(trim($value->TenderNo))){
            if(strlen((string)$value->TenderNo) <=  200){
                $model->OTD_TenderRefNo = $value->TenderNo;
            }else{
                 $resArray['TenderNo']['StatusCode']='T0004';
                 $resArray['TenderNo']['msg']='TenderNo Max Char 200';
            }
        }else{
             $resArray['TenderNo']['StatusCode']='T0002';
             $resArray['TenderNo']['msg']='TenderNo is Empty';
        }
        //TenderName
        if(!empty(trim($value->TenderName))){
            if(strlen((string)$value->TenderName) <=  200){
                $model->OTD_TenderName = $value->TenderName;
            }else{
                 $resArray['TenderName']['StatusCode']='T0004';
                 $resArray['TenderName']['msg']='TenderName Max Char 200';
            }
        }else{
             $resArray['TenderName']['StatusCode']='T0002';
             $resArray['TenderName']['msg']='TenderName is Empty';
        }
        //Status
        if(!empty(trim($value->Status))){
            if(in_array(strtoupper(trim((string)$value->Status)), ['AWARDED','OPENED','FLOATED','COMINGSOON','POSTPONED','CANCELLED','IN-PROGRESS'])){
                $model->OTD_Status = $value->Status;
            }else{
                 $resArray['Status']['StatusCode']='T0005';
                 $resArray['Status']['msg']='Status is not matched';
            }
        }else{
             $resArray['Status']['StatusCode']='T0002';
             $resArray['Status']['msg']='Status is Empty';
        }
        
        $model->OTD_Type = "G";
        $model->OTD_SuppType="T2";
        
        //DocumentPrice
        if(!empty(trim($value->DocumentPrice)) && trim($value->DocumentPrice)!=null){
            if(strlen(trim((string)$value->DocumentPrice)) <= 20){
                if(is_numeric((string)$value->DocumentPrice)){
                    $model->OTD_DocumentPrice =(float) $value->DocumentPrice;
                }else{
                     $resArray['DocumentPrice']['StatusCode']='T0003';
                     $resArray['DocumentPrice']['msg']='Document Price Format Mismatch';
                }
            }else{
                 $resArray['DocumentPrice']['StatusCode']='T0003';
                 $resArray['DocumentPrice']['msg']='Document Price Max Digit 20';
            }
        }
        
        
        
        //LastDateCollectingDocument
        if(!empty($value->LastDateCollectingDocument)){
            if(OprtenderdtlsTbl::validateRequestedParam($value->LastDateCollectingDocument,'date')){
                $model->OTD_LastDateCollectingDoc = $value->LastDateCollectingDocument;
            }else{
                 $resArray['LastDateCollectingDocument']['StatusCode']='T0003';
                 $resArray['LastDateCollectingDocument']['msg']='Last Date Collecting Document Format Mismatch';
            }
        }else{
             $resArray['LastDateCollectingDocument']['StatusCode']='T0002';
             $resArray['LastDateCollectingDocument']['msg']='Last Date Collecting Document is Empty';
        }
        // $model->OTD_LastDateCollectingDoc = '2022-06-22';
        //TenderAmount
        if(!empty(trim($value->TenderAmount)) && trim($value->TenderAmount)!=null){
            if(strlen(trim((string)$value->TenderAmount)) <= 20){
                if(is_numeric((string)$value->TenderAmount)){
                    $model->OTD_TenderAmount = (float)$value->TenderAmount;
                }else{
                     $resArray['TenderAmount']['StatusCode']='T0003';
                     $resArray['TenderAmount']['msg']='Tender Amount Format Mismatch';
                }
            }else{
                 $resArray['TenderAmount']['StatusCode']='T0003';
                 $resArray['TenderAmount']['msg']='Tender Amount Max Digit 20';
            }
        }
        
        
        //TenderingDate
        if(!empty($value->TenderingDate)){
            if(OprtenderdtlsTbl::validateRequestedParam($value->TenderingDate,'date')){
                $model->OTD_TenderingDate = $value->TenderingDate;
            }else{
                 $resArray['TenderingDate']['StatusCode']='T0003';
                 $resArray['TenderingDate']['msg']='Tendering Date Format Mismatch';
            }
        }else{
             $resArray['TenderingDate']['StatusCode']='T0002';
             $resArray['TenderingDate']['msg']='Tendering Date is Empty';
        }
        // $model->OTD_TenderingDate='2022-06-22';
        
        //SubmissionDate
        if(!empty($value->SubmissionDate)){
            if(OprtenderdtlsTbl::validateRequestedParam($value->SubmissionDate,'date')){
                $model->OTD_SubmDate=$value->SubmissionDate;
            }else{
                 $resArray['SubmissionDate']['StatusCode']='T0003';
                 $resArray['SubmissionDate']['msg']='Submission Date Format Mismatch';
            }
        }else{
             $resArray['SubmissionDate']['StatusCode']='T0002';
             $resArray['SubmissionDate']['msg']='Submission Date is Empty';
        }

        // $model->OTD_SubmDate='2022-06-22';
        
        
        //OpeningDate
        if(!empty($value->OpeningDate)){
            if(OprtenderdtlsTbl::validateRequestedParam($value->OpeningDate,'date')){
                $model->OTD_OpeningDate=$value->OpeningDate;
            }else{
                 $resArray['OpeningDate']['StatusCode']='T0003';
                 $resArray['OpeningDate']['msg']='Opening Date Format Mismatch';
            }
        }else{
             $resArray['OpeningDate']['StatusCode']='T0002';
             $resArray['OpeningDate']['msg']='Opening Date is Empty';
        }
        // $model->OTD_OpeningDate='2022-06-22';
        //FileName
            if(!empty(trim($value->FileName)) && trim($value->FileName)!=null){
                if(filter_var(trim((string)$value->FileName), FILTER_VALIDATE_URL)) {
                    $model->OTD_FileName = $value->FileName;
                }else{
                     $resArray['FileName']['StatusCode']='T0002';
                     $resArray['FileName']['msg']='File Name must be valid URL';
                }
            }
        
        //Active
            if(!empty(trim($value->Active)) && trim($value->Active)!=null){
                if(in_array(strtoupper(trim((string)$value->Active)), ['A','I','T'])){
                    $model->OTD_Active = $value->Active;
                }else{
                     $resArray['Active']['StatusCode']='T0005';
                     $resArray['Active']['msg']='Active is not matched';
                }
            }
            //TenderDate
            if(!empty($value->TenderDate)){
                if(OprtenderdtlsTbl::validateRequestedParam($value->TenderDate,'date')){
                    $model->otd_publisheddate = $value->TenderDate;
                }else{
                     $resArray['TenderDate']['StatusCode']='T0003';
                     $resArray['TenderDate']['msg']='Tender Date Format Mismatch';
                }
            }else{
                 $resArray['TenderDate']['StatusCode']='T0002';
                 $resArray['TenderDate']['msg']='Tender Date is Empty';
            }   
            // $model->otd_publisheddate = '2022-06-22';
            
        //AwardedAmount
            if(!empty(trim($value->AwardedAmount)) && trim($value->AwardedAmount)!=null){
                if(strlen(trim((string)$value->AwardedAmount)) <= 20){
                    if(is_numeric((string)$value->AwardedAmount)){
                        $model->OTD_AwardedAmt = (float)$value->AwardedAmount;
                    }else{
                         $resArray['AwardedAmount']['StatusCode']='T0003';
                         $resArray['AwardedAmount']['msg']='Awarded Amount Format Mismatch';
                    }
                }else{
                     $resArray['AwardedAmount']['StatusCode']='T0004';
                     $resArray['AwardedAmount']['msg']='Awarded Amount Max Digit 20';
                }
            }
        
        
        
        //AwardedDate
            if(!empty(trim($value->AwardedDate)) && trim($value->AwardedDate)!=null){
                if(OprtenderdtlsTbl::validateRequestedParam($value->AwardedDate,'date')){
                    $model->OTD_AwardedDate = $value->AwardedDate;
                }else{
                     $resArray['AwardedDate']['StatusCode']='T0003';
                     $resArray['AwardedDate']['msg']='Awarded Date Format Mismatch';
                }
            }
        
        
        //Awarded_BidderName
            if(strlen((string)$value->Awarded_BidderName) <=  200){
                $model->OTD_BidderName = $value->Awarded_BidderName;
            }else{
                 $resArray['Awarded_BidderName']['StatusCode']='T0004';
                 $resArray['Awarded_BidderName']['msg']='Awarded Bidder Name Max Char 200';
            }
         
            $model->OTD_TargtClassfnStatus  = $model->OTD_TargtProdServStatus = $model->OTD_TargtLocStatus ='A';
            
        return $resArray;
    }

    public function actionSendmailtotargetsupplier(){
    /*//        $sql = "SELECT  t.OrpicTenderDtls_PK as tendId, tar.OTTD_CompRegPk as targetPks FROM `oprtenderdtls_tbl` `t` "
    //                . " Inner join oprtendtrgtdtls_tbl as tar on tar.OTTD_OrpicTenderDtls_FK=t.OrpicTenderDtls_PK "
    //                . " WHERE DATE_FORMAT(OTD_CreatedOn, '%Y-%m-%d') = '$yesterdayDate' ";        
        $yesterdayDate =   date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $TendRecoreds = OprtenderdtlsTbl::model()->findAll(array('condition' => "DATE_FORMAT(OTD_CreatedOn, '%Y-%m-%d') = '$yesterdayDate' and (OTD_UpdatedOn is Null OR DATE_FORMAT(OTD_UpdatedOn, '%Y-%m-%d') = '$yesterdayDate' )"));
        $mailFormation = array();
        if(!empty($TendRecoreds) && is_array($TendRecoreds) && count($TendRecoreds)>0){
            foreach($TendRecoreds as $TendRecored){
    //                echo '<pre>';print_r($TendRecored);exit;
                    $targetRecord = $TendRecored->target;
                    $targetPks = explode(',', $targetRecord->OTTD_CompRegPk);
                    if(!empty($targetPks) && is_array($targetPks) && count($targetPks)>0){
                        foreach($targetPks as $targetPk){
                            if(!empty($targetPk)){
                                $mailFormation[$TendRecored->OTD_OprCompmst_Fk][$targetPk] = $mailFormation[$TendRecored->OTD_OprCompmst_Fk][$targetPk] + 1;
                            } 
                        }
                    }
                }
            }
    //        echo '<pre>';print_r($mailFormation);exit;
        if(!empty($mailFormation) && is_array($mailFormation) && count($mailFormation)>0){
            foreach($mailFormation as $oprPk=>$regCompanyPks){
                if(!empty($regCompanyPks) && is_array($regCompanyPks) && count($regCompanyPks)>0){
                    $oprDetails= OperatorCompanyMstTbl::model()->findByPk($oprPk);    
                    $oprName = $oprDetails->OCM_CompanyName;
                    foreach($regCompanyPks as $regCompPk=>$targetCount){
                        if(!empty($regCompPk) && is_numeric($regCompPk)){
                            $regCompDetails = MemberregistrationmstTbl::model()->findByPk($regCompPk);
                            $compDetails = $regCompDetails->company;
                            if(!empty($compDetails)){
                                OprtenderdtlsTbl::sendTargetEmail($oprName,$compDetails,$targetCount);
                            }
                        }
                    }
                }
            }
        }*/
        // $yesterdayDate = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $yesterdayDate = date('Y-m-d');
        // $yesterdayDate='2022-06-22';
        $TendRecoreds = OprtenderdtlsTbl::find()->where("DATE_FORMAT(OTD_CreatedOn, '%Y-%m-%d') = '$yesterdayDate' and (OTD_UpdatedOn is Null OR DATE_FORMAT(OTD_UpdatedOn, '%Y-%m-%d') = '$yesterdayDate' )")->all();
        $mailFormation = array();
        if(!empty($TendRecoreds) && is_array($TendRecoreds) && count($TendRecoreds)>0){
            foreach($TendRecoreds as $TendRecored){
                    $targetRecord = $TendRecored->target;
                    $targetPks = explode(',', $targetRecord->OTTD_CompRegPk);
                    if(!empty($targetPks) && is_array($targetPks) && count($targetPks)>0){
                        foreach($targetPks as $targetPk){
                            if(!empty($targetPk)){
                                $mailFormation[$TendRecored->OTD_OprCompmst_Fk][$targetPk] = $mailFormation[$TendRecored->OTD_OprCompmst_Fk][$targetPk] + 1;
                            } 
                        }
                    }
                }
            }
        if(!empty($mailFormation) && is_array($mailFormation) && count($mailFormation)>0){
            foreach($mailFormation as $oprPk=>$regCompanyPks){
                if(!empty($regCompanyPks) && is_array($regCompanyPks) && count($regCompanyPks)>0){ 
                    $oprDetails = Yii::$app->db->createCommand("select membercompanymst_tbl.* from memberregistrationmst_tbl left join stkholdertypmst_tbl on stkholdertypmst_pk = mrm_stkholdertypmst_fk
                    left join membercompanymst_tbl on MCM_MemberRegMst_Fk = MemberRegMst_Pk where stkholdertypmst_pk=7 and MemberRegMst_Pk = $oprPk")->queryOne(); 
                    $oprName = isset($oprDetails['MCM_CompanyName']) ? $oprDetails['MCM_CompanyName'] : $oprDetails->MCM_CompanyName;
                    foreach($regCompanyPks as $regCompPk=>$targetCount){
                        if(!empty($regCompPk) && is_numeric($regCompPk)){
                            $regCompDetails = MemberregistrationmstTbl::findone($regCompPk);
                            $compDetails = $regCompDetails->company;
                            if(!empty($compDetails)){
                                OprtenderdtlsTbl::sendTargetEmail($oprName,$compDetails,$targetCount);
                            }
                        }
                    }
                }
            }
        }

    }
    public function actionSendimporterrorlog(){
     
        // $yesterdayDate =   date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
        $yesterdayDate = date('Y-m-d');
        // $yesterdayDate='2022-06-22';
        /*$oprCompPkFolders= 'api/runtime/wslog/';
        $fi = new FilesystemIterator($oprCompPkFolders, FilesystemIterator::SKIP_DOTS);
        $folderCount=iterator_count($fi);
        $foldersDir = scandir($oprCompPkFolders);
        $folders = array_diff($foldersDir, array("..", "."));*/
        $oprCompPkFolders= getcwd().'/runtime/wslog/*';
        $fi = glob($oprCompPkFolders);
        $foldersDir = scandir(getcwd().'/runtime/wslog');
        $folders = array_diff($foldersDir, array("..", "."));
        foreach ($folders as $folder){
            $oprCompPkPath= getcwd().'/runtime/wslog/'.$folder;
            $responseFileName = $yesterdayDate."_Response.txt";
            $oprCompPkPathWithFile= $oprCompPkPath.'/'.$responseFileName;
            if(file_exists($oprCompPkPathWithFile)){
                // $oprDetails= OperatorCompanyMstTbl::model()->findByPk($folder);   
                $oprDetails = Yii::$app->db->createCommand("select membercompanymst_tbl.* from memberregistrationmst_tbl left join stkholdertypmst_tbl on stkholdertypmst_pk = mrm_stkholdertypmst_fk
                left join membercompanymst_tbl on MCM_MemberRegMst_Fk = MemberRegMst_Pk where stkholdertypmst_pk=7 and MemberCompMst_Pk = $folder")->queryone(); 
               
                if(!empty($oprDetails)){
                    OprtenderdtlsTbl::sendImportErrorLog($oprCompPkPathWithFile,$responseFileName,$oprDetails);
                }
            }
        }
    }
    public function actionXmlimport(){
        
        if(trim(strtolower($_REQUEST['compName']))!='omanlng'){            
            $param = array('compName','url','emailnotification');
            $paramCount = count($param);
            $notEmptyParam = array('compName','url','emailnotification');
        }else{
            $param = array('compName','emailnotification');
            $paramCount = count($param);
            $notEmptyParam = array('compName','emailnotification');
        }
//        $param = array('compName','url','emailnotification');
//        $notEmptyParam = array('compName','url','emailnotification');
        if(WebServiceFunctions::requestCount($paramCount) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL1','msg'=>'Parameter Mismatch, Kindly Provide Requested Parameter alone']);
        }elseif(WebServiceFunctions::requestParam($param) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL2','msg'=>'Given Parameter Key is Wrong']);
        }elseif(WebServiceFunctions::requestedParamIsEmpty($notEmptyParam) == 'false')
        {
            echo json_encode(['statusCode'=>'TURL3','msg'=>'Requested Parameter(s) should not be Empty']);
        }else{
            date_default_timezone_set('Asia/Muscat');
            ini_set('max_execution_time', 3000000); //300 seconds = 5 minutes
            
            //Getting data based on user giving request comppk
            $ExcompName = (!empty($_REQUEST['compName']))? trim($_REQUEST['compName']): '';
            $MailNotification = (!empty($_REQUEST['emailnotification']))? strtolower(trim($_REQUEST['emailnotification'])): '';
            $userMst= UsermstTbl::find()->where("UM_ExternalLink='{$ExcompName}'")->one();
            if(empty($userMst)){
                echo json_encode(['statusCode'=>'TURL4','msg'=>'Given shortName is not Valid']);
                exit;
            }
            
            $compPk = $userMst->uMMemberRegMstFk->company->MemberCompMst_Pk;
            $OprCompName = $userMst->uMMemberRegMstFk->company->MCM_CompanyName;
            $contractalone = $userMst->uMMemberRegMstFk->mrm_contractsalone;
            $RegPk = $userMst->uMMemberRegMstFk->MemberRegMst_Pk; 

         
            $mrm_comp = Yii::$app->db->createCommand("select stk.stkholdertypmst_pk as MRM_CompType from memberregistrationmst_tbl mreg Left JOIN stkholdertypmst_tbl stk on mreg.mrm_stkholdertypmst_fk=stk.stkholdertypmst_pk where MemberRegMst_Pk = $RegPk")->queryone();

            /*if($userMst->uMMemberRegMstFk->MRM_CompType=='O'){
                $adminUser = $userMst->uMMemberRegMstFk->compopr;
            }else{
                $adminUser = $userMst->uMMemberRegMstFk->buyeropr;
            }   */
            if(!empty($mrm_comp)){
                $adminUser = $userMst;
            }else{
                $adminUser = $userMst;
            }         
            if(!empty($adminUser)){
                $adminUserPk = $adminUser->UserMst_Pk;
            }
            $oprConfigDetails = Yii::$app->params['OprDetails'];
            $configURL = $oprConfigDetails[$compPk]['openContract_WS_XML_URL'];
            if(empty($configURL)){
                $url = $_REQUEST['url']; 
            }else{
                $url = $configURL;
            }
            $xml = simplexml_load_file($url);
            if ($xml == FALSE){
                echo "Failed loading XML\n"; exit;
            }
            session_destroy();
            session_start();
            $log = TRUE;
            if($log){
                //Requested xml file taking as log
                $path = getcwd() . '/runtime/contractwsdl/XMLlogcontract/';
                if(!file_exists($path)){
                    if (!is_dir($path)) {
                        mkdir($path, 0777, true);
                    }
                }
                $RequestPath = $path.$compPk.'/';
                $requestFileName = date('Y-m-d').'_Request'.'.txt';
                OprtenderdtlsTbl::writeLog($RequestPath,$requestFileName,$xml);
            }
            if(count($xml)>0){
                $array_data = [];
                foreach ($xml as $x){
                    if(isset($x->Contract) && !empty($x->Contract)){
                        $data = GeneralFunctions::changexmlkeyformat($x);  
                        array_push($array_data, $data);
                    }
                }
                $type='xml';
               
                $result = GeneralFunctions::validateData($array_data,$header=[],$label=[],$type,$compPk,$contractalone);
                // echo '<pre>';print_r($result);exit;
                if(!empty($result)){
                    $json_data['total'] = $result['total'];
                    if($result['success']>0){
                        $json_data['success'] = $result['success'];
                        $rescount=1;
                        //Data From query
                        $wsdl['ewc_createdby']=$adminUserPk;
                        $wsdl['ewc_updatedby']=$adminUserPk;
                        $wsdl['ewc_memberregmst_fk']=$RegPk;
                        $wsdl['OprCompMst_Pk']=$compPk;
                        $wsdl['user_type']=$userMst->uMMemberRegMstFk->mrm_stkholdertypmst_fk;                
                        if(count($array_data)>0)
                        {
                            foreach ($array_data as $ar_value) {
                                $wsdlobject=Wsdlcontract::getInstance();
                                $wsdlobject->InsertPrjectInfo($ar_value,$wsdl,$rescount,FALSE,$contractalone,$compPk,$OprCompName,$type,$adminUserPk);
                                $rescount++;
                            }
                        }
                    }else{
                        $json_data['success'] = $result['success'];
                    }
                    $json_data['failed'] = $result['failed'];
                    $failed_list = [];
                    if($result['failed']>0){
                        $failed_data = json_decode($result['dataval']);
                        if(count($failed_data)>0){
                            foreach($failed_data as $failed){
                                if($failed->Over_all_Comments!=''){
                                    if(!empty($failed->Contract_Ref_No)){
                                        $fail['Contract_Ref_No'] = $failed->Contract_Ref_No;
                                        $fail['Contract_Title'] = $failed->Contract_Title;
                                    }else{
                                        $fail['Contract_Ref_No'] = '';
                                        $fail['Contract_Title'] = $failed->Contract_Title;
                                    }
                                    $fail['Failure_Comments'] = rtrim($failed->Over_all_Comments, ',');
                                    array_push($failed_list, $fail);
                                }
                            }
                            if($log){
                                //Failure contracts taking as log
                                $ErrorLogpath = getcwd() . '/runtime/contractwsdl/XMLErrorlogcontract/';
                                if(!file_exists($ErrorLogpath)){
                                    if (!is_dir($ErrorLogpath)) {
                                        mkdir($ErrorLogpath, 0777, true);
                                    }
                                }
                                $LogPath = $ErrorLogpath.$compPk.'/';
                                $LogFileName = date('Y-m-d').'_Response'.'.txt';
                                OprtenderdtlsTbl::writeLog($LogPath,$LogFileName,$failed_list);
                                // echo'<pre>';print_r();exit;
                                GeneralFunctions::sendXmlImportErrorLog($LogPath.$LogFileName, $LogFileName, $compPk, $OprCompName);
                            }
                        }
                    }
                    $json_data['failed_data'] = $failed_list;
                    if($json_data['success']>0){
                        $projcount=$_SESSION['projcount'];
                        $tendcount=$_SESSION['tendcount'];
                        $contcount=$_SESSION['contcount'];
                        $contupdcount=$_SESSION['contupdcount'];
                        $awrdcount=$_SESSION['awrdcount'];
                        $purcount=$_SESSION['purcount'];
                        $awardeepks=$_SESSION['AwardeePks'];
                        $awardeenopks=$_SESSION['AwardeenoPks'];
                        $awardeeyespks=$_SESSION['AwardeeyesPks'];
                        $awardeenopks= substr($awardeenopks,0,-1);
                        $awardeeyespks= substr($awardeeyespks,0,-1);
                        if(!empty($awardeenopks))
                        {
                            $awardeePksdtls=new EpcawardeemailtrgtTbl();
                            $awardeePksdtls->eamt_epcaward_fk=$awardeenopks;
                            $awardeePksdtls->eamt_oprcompmst_fk=$compPk;
                            $awardeePksdtls->eamt_hasobligation=2;
                            $awardeePksdtls->eamt_mailstatus=2;  
                            $awardeePksdtls->save();
                        }
                        if(!empty($awardeeyespks))
                        {
                            $awardeePksdtls=new EpcawardeemailtrgtTbl();
                            $awardeePksdtls->eamt_epcaward_fk=$awardeeyespks;
                            $awardeePksdtls->eamt_oprcompmst_fk=$compPk;
                            $awardeePksdtls->eamt_hasobligation=1;
                            $awardeePksdtls->eamt_mailstatus=2;
                            $awardeePksdtls->save();
                        }
                        if($MailNotification && (!empty($awardeenopks) || !empty($awardeeyespks))){
                            EPCTender::sendAwardeeMail($MailNotification, $compPk, $awardeenopks, $awardeeyespks);
                        }
                        unset($_SESSION['projcount']);
                        unset($_SESSION['tendcount']);
                        unset($_SESSION['contcount']);
                        unset($_SESSION['awrdcount']);
                        unset($_SESSION['purcount']);
                        unset($_SESSION['totalcount']);
                        if($contractalone==1) {
                            $messageText='';
                        }else{
                            $messageText= "Total New Projects: $projcount <br>\n"
                               . "Total New Tenders: $tendcount <br>\n";

                        }
                        $SuccessMsg = $messageText . "Total New Contracts: $contcount <br>\n"
                              . "Total Purchase Orders: $purcount <br>\n"
                              . "Total Awarded Contractors: $awrdcount <br>\n";
                        echo $SuccessMsg;
                    }
                    echo "<pre>2342";
                    print_r($json_data);
                    exit;
                }
            }
        }
    }
}