<?php

namespace api\modules\mst\models;

use api\modules\mst\models\MemberregistrationmstTbl;
use common\components\Drive;
use common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;
/**
 * This is the ActiveQuery class for [[MembercompanymstTbl]].
 *
 * @see MembercompanymstTbl
 */
class MembercompanymstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MembercompanymstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MembercompanymstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function stakeholderstatus()
    {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model = MembercompanymstTbl::find()
                ->select(['mcm_stakeholderstatus as status'])
                ->where('MemberCompMst_Pk=:memcomppk',[':memcomppk'=> $companypk])
                ->asArray()->All();
        return $model;
       
    }
    public function updatestatus($user,$status){
        $model = MembercompanymstTbl::find()
                ->leftJoin('usermst_tbl','UM_MemberRegMst_Fk=MCM_MemberRegMst_Fk' )
                ->where('UserMst_Pk=:pk',[':pk'=> $user])
                ->one();
        $model->mcm_stakeholderstatus = $status;
        $model->save();
        return $status;
       
    }

    public function getcompany($fk){
        $model = MemberregistrationmstTbl::find()
                ->select(['MemberCompMst_Pk','MCM_CompanyName'])
                ->leftJoin('membercompanymst_tbl','MemberRegMst_Pk=MCM_MemberRegMst_Fk' )
                ->where('mrm_stkholdertypmst_fk=:fk',[':fk'=> $fk])
                ->asArray()->All();
        return $model;
    }
    public function getcompanyinv(){
        $model = MembercompanymstTbl::find()
                ->select(['MemberCompMst_Pk','MCM_CompanyName','mcm_referenceno as investorid','type.mrm_invidentity as invtype'])
                ->leftJoin('memberregistrationmst_tbl as type','MCM_MemberRegMst_Fk=type.MemberRegMst_Pk')
                ->andWhere(['not',['mcm_stakeholderstatus'=>null]])
                ->andWhere(['not',['mcm_stakeholderstatus'=>1]])
                ->andWhere(['not',['mcm_stakeholderstatus'=>2]])
                ->orderBy('MCM_CompanyName ASC')
                ->asArray()->All();
        return $model;
    }
    public function getSupplierList($searchkey){
        $model = MembercompanymstTbl::find()
                ->select(['MemberCompMst_Pk','MCM_CompanyName'])
                ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
                ->where('mrm_stkholdertypmst_fk=6')
                ->andWhere("MRM_MemberStatus='A'")
                ->andFilterWhere(['LIKE','MCM_CompanyName',$searchkey])
                ->orderBy('MCM_CompanyName ASC')
                ->asArray()->All();
        return $model;
    }

    public function getSupplierListbyid($ids){

        $model = MemberregistrationmstTbl::find()
                ->select(['MemberRegMst_Pk', 'MemberCompMst_Pk','mrm_createdby', 'MCM_CompanyName as supp_name', 'mcm_referenceno as supplierid', 'mcm_classificationmst_fk', 'ClM_ClassificationType as classification', 'mcm_complogo_memcompfiledtlsfk as log_fk'])
                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
                ->leftJoin('classificationmst_tbl','ClassificationMst_Pk=mcm_classificationmst_fk')
                // ->where("MRM_MemberStatus='A'")
                ->andWhere(["IN","MCM_MemberRegMst_Fk", $ids])
                ->orderBy('MCM_CompanyName ASC')
                ->asArray()->All();
                foreach ($model as $key => $value) {
                   $model[$key]['logo'] = Drive::generateUrl($value['mcm_complogo_memcompfiledtlsfk'], $value['MemberCompMst_Pk'], $value['mrm_createdby']);
                }
        return $model;
    }

    public static function addindividualinfo(){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        // return $companypk;

        $model = MemberregistrationmstTbl::find()
        ->select(['mrm_investortypeprefmst_fk','MemberCompMst_Pk','MemberRegMst_Pk','mcm_referenceno','um_firstname','um_lastname','UM_EmailID','MCM_Source_CountryMst_Fk','MCM_website','maincountry.CyM_CountryName_en as countryname','um_primobnocc','um_primobno','um_landlinecc','um_landlineno','um_landlineext','dial.CountryMst_Pk as countrypkmobile','um_dob','mrm_invintent_fk','um_passport','diallandline.CountryMst_Pk as countrypklandline','mcm_complogo_memcompfiledtlsfk','mrm_sectormst_fk','mrm_profupdatedon'])
        ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
        ->leftJoin('usermst_tbl','UM_MemberRegMst_Fk=MemberRegMst_Pk')
        // ->leftJoin('usermst_tbl dial','dial.UM_MemberRegMst_Fk=MemberRegMst_Pk')
        ->leftJoin('countrymst_tbl as maincountry','CountryMst_Pk=MCM_Source_CountryMst_Fk')
        ->leftJoin('countrymst_tbl as dial','dial.CyM_CountryDialCode=usermst_tbl.um_primobnocc')
        ->leftJoin('countrymst_tbl as diallandline','diallandline.CyM_CountryDialCode=usermst_tbl.um_landlinecc')
        ->where('MemberRegMst_Pk=:fk',[':fk'=> $companypk])
        ->asArray()->All();

            return $model;
        }
    public static function GetSupplierData($supplierPk) {
        $model = MembercompanymstTbl::find()
                ->select(['MCM_CompanyName as companyName','MCM_SupplierCode','CyM_CountryName_en as countryName','MCM_Source_CountryMst_Fk as countryPk','ClM_ClassificationType as classificatinType','ISM_IncorpStyleBrief as incorpStyle','mrm_otherincorpstyle as incorpStyleContent','MemberRegMst_Pk as dataPk','MCM_crnumber as crNumber','SM_StateName_en as stateName','MRM_RenewalStatus as memberStatus','CM_CityName_en as cityName','group_concat(CASE mclch_lcctype WHEN 1 THEN " CCED" WHEN 2 THEN " DUQM" WHEN 3 THEN " OXY" WHEN 4 THEN " PDO" WHEN 5 THEN " Riyada" END) as specialstatus','mcm_complogo_memcompfiledtlsfk','MemberCompMst_Pk','mrm_createdby'])
                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->leftJoin('memcompmplocationdtls_tbl','mcmpld_membercompmst_fk=MemberCompMst_Pk and mcmpld_locationtype = 1')
                ->leftJoin('countrymst_tbl','CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl','StateMst_Pk=mcmpld_statemst_fk')
                ->leftJoin('citymst_tbl','CityMst_Pk=mcmpld_citymst_fk')
                ->leftJoin('classificationmst_tbl','ClassificationMst_Pk = mcm_classificationmst_fk')
                ->leftJoin('incorpstylemst_tbl','IncorpStyleMst_Pk = mrm_incorpstylemst_fk')
                ->leftJoin('memcomplcccerthdr_tbl',"mclch_membercompmst_fk = MemberCompMst_Pk and mclch_status = 1")
                ->where('MemberCompMst_Pk=:pk', [':pk' => $supplierPk])
                ->asArray()->one();
        if ($model['mcm_complogo_memcompfiledtlsfk'] != null) {
            $model['imgUrl'] = Drive::generateUrl($model['mcm_complogo_memcompfiledtlsfk'], $model['MemberCompMst_Pk'], $model['mrm_createdby']);
        } else {
            $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public static function getMemCompCacheQuery() {
        return MembercompanymstTbl::find()
        ->select(['count(*)'])
        ->createCommand()
        ->getRawSql();
    }
    public static function getPdoLccExport(){
        $downsts=TRUE;
        $userPK = Security::decrypt($_REQUEST['userPK']);
        $userType = Security::decrypt($_REQUEST['UM_Type']);
        $regType = Security::decrypt($_REQUEST['reg_type']);
        if($regType == 6 && $userType == 'U'){
            $downsts=FALSE;            
        }
        if($downsts){
            $today=date('Ymd');
            $skipid= \common\components\Common::Pdoexportskip();
            $expodtl = MembercompanymstTbl::find()
                ->select(['MCM_SupplierCode','MCM_MemberRegMst_Fk','mcm_RegistrationNo','MCM_crnumber','MCM_RegistrationExpiry','MCM_CompanyName','mcmpld_emailid','MCM_Origin','mcmpld_website','MCCD_Name',
                    "IF(mcmpld_landlineno = null,'-',CONCAT_WS('-',mcmpld_landlinenocc,mcmpld_landlineno,mcmpld_landlineext)) as comph",
                    "IF(MCCD_Phone1 = null,'-',CONCAT_WS('-',MCCD_PriPhoneCC,MCCD_Phone1,MCCD_PriPhoneExt1)) as jsrsph",
                    "IF(MCCD_Mobile = null,'-',CONCAT_WS('-',MCCD_PriMobCC,MCCD_Mobile)) as jsrsmob",
                    "date_format(mcm_accexpirydate,'%d-%m-%Y') as JsrsExpDate","case when(date_format(mcm_accexpirydate,'%Y%m%d')>='$today' and (MRM_RenewalStatus in ('R','NE','E','I','ER','GE') or MRM_RenewalStatus is NULL)) then 'Active' when(date_format(mcm_accexpirydate,'%Y%m%d') <'$today' and (MRM_RenewalStatus in ('R','NE','E','I','ER','GE') or MRM_RenewalStatus is NULL)) then 'Expired' when MRM_RenewalStatus not in ('R','NE','E','I','ER','GE') then 'Renewal In-progress' end  as JsrsSts","case when MCM_Origin='N' and date_format(date_add(MCM_RegistrationExpiry,interval 30 day),'%Y%m%d') < '$today' then 'Expired' when MCM_Origin!='N' and date_format(MCM_RegistrationExpiry,'%Y%m%d') < '$today' then 'Expired' else 'Active'  end as crstatus",'date(max(mclch_lcccerton)) as lastupdatedon',"date_format(mclch_lcccerton,'%d-%m-%Y %H:%i:%s') as pdoissuedon","ifnull(pcm_categoryname,'') as pdo_cat","ifnull(scfpcd_yrofexp,0) as yrofexp","ifnull(scfpcd_totcontvalue,0) as contamt",'ifnull(momp_specialistexpats,0) as momp_specialistexpats','ifnull(momp_totalspecialist,0) as momp_totalspecialist','ifnull(momp_techomani,0) as momp_techomani','ifnull(momp_techexpats,0) as momp_techexpats','ifnull(momp_totaltech,0) as momp_totaltech','ifnull(momp_occupantomani,0) as momp_occupantomani','ifnull(momp_occupantexpat,0) as momp_occupantexpat','ifnull(momp_totaloccupant,0) as momp_totaloccupant',' ifnull(momp_skilledomani,0) as momp_skilledomani','ifnull(momp_skilledexpat,0) as momp_skilledexpat','ifnull(momp_totalskilled,0) as momp_totalskilled','ifnull(momp_lowskilledomani,0) as momp_lowskilledomani','ifnull(momp_lowskilledexpat,0) as momp_lowskilledexpat','ifnull(momp_totallowskilled,0) as momp_totallowskilled','ifnull(momp_omanisation,0) as momp_omanisation','ifnull(momp_totalexpat,0) as momp_totalexpat','ifnull(momp_totalomani,0) as momp_totalomani'])
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->leftJoin('memcomplcccerthdr_tbl', 'mclch_membercompmst_fk = MemberCompMst_Pk')
                ->leftJoin('memcompcontactdtls_tbl', "MCCD_MemberCompMst_Fk = MemberCompMst_Pk and MCCD_Department='JP'")                    
                ->leftJoin('scfpdocatdtls_tbl', 'scfpcd_memcompmst_fk = MemberCompMst_Pk and scfpcd_isapproved = 1')
                ->leftJoin('pdocategorymst_tbl', 'pdocategorymst_pk = scfpcd_pdocategorymst_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')                 
                ->leftJoin('ministofmanpower_tbl', 'momp_membercompmst_fk = MemberCompMst_Pk')
                ->where("MRM_MemberStatus= 'A' AND mrm_stkholdertypmst_fk=6 AND (MRM_RenewalStatus not in('GE') or MRM_RenewalStatus is null) AND (mclch_lcctype = 4 AND mclch_status = 1) and MRM_ValSubStatus='A'");
                if (!empty($skipid)) {
                    $expodtl->andWhere(['<>', 'MemberCompMst_Pk', $skipid]);
                }
                $expodtl->groupBy("MemberCompMst_Pk,scfpcd_pdocategorymst_fk")
                ->asArray()
                ->all();
                $provider = new ActiveDataProvider(['query' => $expodtl, 'pagination' => ['pageSize' => 0]]);
                $dataRow = '';
                $listData=$provider->getModels();
        foreach ($listData as $key => $dataVal){
            $JsrsExpDate = $dataVal['JsrsExpDate'] == null ? '-':$dataVal['JsrsExpDate'];
            $MCCD_Name = $dataVal['MCCD_Name'] == null ? '-':$dataVal['MCCD_Name'];
            $dataRow.="<tr><td>".($key+1)."</td>
                            <td>".$dataVal['MCM_SupplierCode']."</td>
                            <td>".$dataVal['MCM_CompanyName']."</td>
                            <td style=\"text-align: left;\">".$dataVal['MCM_crnumber']."</td>
                            <td>".$dataVal['JsrsSts']."</td>
                            <td>".$JsrsExpDate."</td>
                            <td>".$dataVal['crstatus']."</td>
                            <td>".$dataVal['pdoissuedon']."</td>
                            <td>".$dataVal['pdo_cat']."</td>                            
                            <td>".$dataVal['yrofexp']."</td>                            
                            <td>".$dataVal['contamt']."</td>                            
                            <td>".$MCCD_Name."</td>
                            <td>".$dataVal['mcmpld_emailid']."</td>                            
                            <td style=\"text-align: left;\">".$dataVal['jsrsph']."</td>
                            <td style=\"text-align: left;\">".$dataVal['jsrsmob']."</td>
                            <td style=\"text-align: left;\">".$dataVal['comph']."</td>                            
                            <td>".$dataVal['mcmpld_website']."</td>                            
                            <td>".$dataVal['momp_specialistexpats']."</td>
                            <td>".$dataVal['momp_specialistomani']."</td>
                            <td>".$dataVal['momp_totalspecialist']."</td>
                            <td>".$dataVal['momp_techexpats']."</td>
                            <td>".$dataVal['momp_techomani']."</td>
                            <td>".$dataVal['momp_totaltech']."</td>
                            <td>".$dataVal['momp_occupantexpat']."</td>
                            <td>".$dataVal['momp_occupantomani']."</td>
                            <td>".$dataVal['momp_totaloccupant']."</td>
                            <td>".$dataVal['momp_skilledexpat']."</td>
                            <td>".$dataVal['momp_skilledomani']."</td>
                            <td>".$dataVal['momp_totalskilled']."</td>
                            <td>".$dataVal['momp_lowskilledexpat']."</td>
                            <td>".$dataVal['momp_lowskilledomani']."</td>
                            <td>".$dataVal['momp_totallowskilled']."</td>
                            <td>".$dataVal['momp_omanisation']."</td>
                            <td>".$dataVal['momp_totalexpat']."</td>
                            <td>".$dataVal['momp_totalomani']."</td>
                        </tr>";
        }        
        if(!empty($dataVal)){
            $tracktbl = new \common\models\DownloadtracktrnsTbl();
            $tracktbl->dtt_membercomp_fk = $userdtl['MemberCompMst_Pk'];
            $tracktbl->dtt_usermst_fk = $userPK;
            $tracktbl->dtt_downloadiniton = date('Y-m-d H:i:s');
            $tracktbl->dtt_donwloadedon = date('Y-m-d H:i:s');
            $tracktbl->dtt_downloadtype = 7;
            $tracktbl->dtt_downloadstatus = 3;
            if(!$tracktbl->save()){  
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $tracktbl->getErrors()
                );
            }
        }
        $userdtl = \common\models\UsermstTbl::find()
                ->select(['um_firstname', 'MCM_CompanyName','MemberCompMst_Pk'])
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('UserMst_Pk=:pk', array(':pk' => $userPK))
                ->asArray()
                ->one();
        $value .= '<table border="1">';      
        $value .= '<tr><td colspan="6">';
        $value .= '<table><tr><td height="100"><img src="https://businessgateways.com/images/PDO-LCC-Logos.jpg" alt ="Businessgateways_International_JSRS_PetroleumDevelopmentOman_Logo"/></td></tr></table>';
        $value .= '</td></tr>';
        $value .= '<tr><td colspan="6" style="text-align:center; font-weight:bold; font-size:16px;"><a href="https://businessgateways.com" target="_blank">Business Gateways International LLC</a></td></tr>';
        $value .= '<tr><td colspan="6" style="text-align:center; font-weight:bold; font-size:16px;">PDO LCC'."'s".' With LCC Category Details</td></tr>';
        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Company Name </td>';
        $value .= '<td colspan="1" style="text-align:left; font-weight:bold; font-size:16px;">'.$userdtl['MCM_CompanyName'].'</td>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> User Name </td>';
        $value .= '<td colspan="1" style="text-align:center; font-weight:bold; font-size:16px;"> '.$userdtl['um_firstname'].' </td>';
        $value .= '</tr>';
        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Downloaded On </td>';
        $value .= '<td colspan="1" style="text-align:left; font-weight:bold; font-size:16px;"> '.date('jS F, Y H:i:s').' </td>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Criteria </td>';
        $value .= '<td colspan="1" style="text-align:center; font-weight:bold; font-size:16px;"> PDO LCC </td>';
        $value .= '</tr>';

        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Data Updated On </td>';
        $value .= '<td colspan="4" style="font-weight:bold; font-size:16px;"> '.date('jS F, Y', strtotime($listData[0]['lastupdatedon'])).' </td>';
        $value .= '</tr>';                
        $value .= '</table>';
        $value .= '<table><tr><td></td></tr></table>';        
        $value .= "<style>
                        .text{
mso-number-format:\"\@\";
} </style><table border='1'>";
        $value .= "<tr  style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td rowspan='3'> Sl no.</td>";
        $value .= "<td rowspan='3'>SUPPLIER CODE</td>";
        $value .= "<td rowspan='3'>COMPANY NAME</td>";
        $value .= "<td rowspan='3'>REGISTRATION NO.</td>";
        $value .= "<td rowspan='3'>JSRS STATUS</td>";
        $value .= "<td rowspan='3'>JSRS Expiry Date</td>";
        $value .= "<td rowspan='3'>CR STATUS</td>";
        $value .= "<td rowspan='3'>PDO LCC APPROVED ON</td>";
        $value .= "<td rowspan='3'>PDO LCC CATEGORY</td>";
        $value .= "<td rowspan='3'>YEARS OF EXPERIENCE</td>";
        $value .= "<td rowspan='3'>TOTAL CONTRACT VALUE (OMR)</td>";
        $value .= "<td rowspan='3'>Name (JSRS)</td>";
        $value .= "<td rowspan='3'>COMPANY EMAIL</td>";
        $value .= "<td rowspan='3'>PHONE (JSRS)</td>";
        $value .= "<td rowspan='3'>MOBILE (JSRS)</td>";
        $value .= "<td rowspan='3'>PHONE NO.</td>";
        $value .= "<td rowspan='3'>COMPANY WEBSITE</td>";
        $value .= "<td colspan='18' style='text-align:center;'>MINISTRY OF LABOUR OMANISATION DATA</td>";
        $value .= "</tr>";
        $value .= "<tr style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td colspan='3' style='text-align:center;'>SPECIALIST</td>";
        $value .= "<td colspan='3' style='text-align:center;'>TECHNICIAN</td>";
        $value .= "<td colspan='3' style='text-align:center;'>OCCUPANT</td>";
        $value .= "<td colspan='3' style='text-align:center;'>SKILLED</td>";
        $value .= "<td colspan='3' style='text-align:center;'>LOW SKILLED</td>";
        $value .= "<td rowspan='2'>OMANISATION %</td>";
        $value .= "<td rowspan='2'>TOTAL OMANI</td>";
        $value .= "<td rowspan='2'>TOTAL EXPAT</td>";
        $value .= "</tr>";
        $value .= "<tr style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "</tr>";
        $value .= $dataRow;
        $value .= '</table>';
        $data .= trim($value) . "\n";
        //insertion part
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=PDO_LCC's_With_LCC_Category_Details.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$data";exit;
        }else{
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'You are not authourized to access this page',
            );
        return print_r($result);
        }
    }
    public static function getShareholdersData(){
        $downsts=TRUE;
        $userPK = Security::decrypt($_REQUEST['userPK']);
        $userType = Security::decrypt($_REQUEST['UM_Type']);
        $regType = Security::decrypt($_REQUEST['reg_type']);
        if($regType == 6 && $userType == 'U'){
            $downsts=FALSE;            
        }
        if($downsts){
            $today=date('Ymd');
            $skipid= \common\components\Common::Pdoexportskip();
            $expodtl = MembercompanymstTbl::find()
                ->select(['MCM_SupplierCode','MCM_MemberRegMst_Fk','mcm_RegistrationNo','MCM_crnumber','MCM_RegistrationExpiry','MCM_CompanyName','mcmpld_emailid','MCM_Origin','mcmpld_website','MCCD_Name',
                    "IF(mcmpld_landlineno = null,'-',CONCAT_WS('-',mcmpld_landlinenocc,mcmpld_landlineno,mcmpld_landlineext)) as comph",
                    "IF(MCCD_Phone1 = null,'-',CONCAT_WS('-',MCCD_PriPhoneCC,MCCD_Phone1,MCCD_PriPhoneExt1)) as jsrsph",
                    "IF(MCCD_Mobile = null,'-',CONCAT_WS('-',MCCD_PriMobCC,MCCD_Mobile)) as jsrsmob",'momp_specialistomani',
                    "date_format(mcm_accexpirydate,'%d-%m-%Y') as JsrsExpDate","case when(date_format(mcm_accexpirydate,'%Y%m%d')>='$today' and (MRM_RenewalStatus in ('R','NE','E','I','ER','GE') or MRM_RenewalStatus is NULL)) then 'Active' when(date_format(mcm_accexpirydate,'%Y%m%d') <'$today' and (MRM_RenewalStatus in ('R','NE','E','I','ER','GE') or MRM_RenewalStatus is NULL)) then 'Expired' when MRM_RenewalStatus not in ('R','NE','E','I','ER','GE') then 'Renewal In-progress' end  as JsrsSts","case when MCM_Origin='N' and date_format(date_add(MCM_RegistrationExpiry,interval 30 day),'%Y%m%d') < '$today' then 'Expired' when MCM_Origin!='N' and date_format(MCM_RegistrationExpiry,'%Y%m%d') < '$today' then 'Expired' else 'Active'  end as crstatus",'date(max(mclch_lcccerton)) as lastupdatedon',"date_format(mclch_lcccerton,'%d-%m-%Y %H:%i:%s') as pdoissuedon",'ifnull(momp_specialistexpats,0) as momp_specialistexpats','ifnull(momp_totalspecialist,0) as momp_totalspecialist','ifnull(momp_techomani,0) as momp_techomani','ifnull(momp_techexpats,0) as momp_techexpats','ifnull(momp_totaltech,0) as momp_totaltech','ifnull(momp_occupantomani,0) as momp_occupantomani','ifnull(momp_occupantexpat,0) as momp_occupantexpat','ifnull(momp_totaloccupant,0) as momp_totaloccupant',' ifnull(momp_skilledomani,0) as momp_skilledomani','ifnull(momp_skilledexpat,0) as momp_skilledexpat','ifnull(momp_totalskilled,0) as momp_totalskilled','ifnull(momp_lowskilledomani,0) as momp_lowskilledomani','ifnull(momp_lowskilledexpat,0) as momp_lowskilledexpat','ifnull(momp_totallowskilled,0) as momp_totallowskilled','ifnull(momp_omanisation,0) as momp_omanisation','ifnull(momp_totalexpat,0) as momp_totalexpat','ifnull(momp_totalomani,0) as momp_totalomani','mcshdm_type','mcshdm_name','mcshdm_regno','CyM_CountryName_en','mcshdm_percentofstake'])
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->leftJoin('memcompcontactdtls_tbl', "MCCD_MemberCompMst_Fk = MemberCompMst_Pk and MCCD_Department='JP'")   
                ->leftJoin('memcompmplocationdtls_tbl', 'mcmpld_membercompmst_fk = MemberCompMst_Pk and mcmpld_locationtype = 1')                 
                ->leftJoin('ministofmanpower_tbl', 'momp_membercompmst_fk = MemberCompMst_Pk')
                ->leftJoin('memcompshareholderdtlsmain_tbl', 'mcshdm_memcompmst_fk = MemberCompMst_Pk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk = mcshdm_countrymst_fk')
                ->leftJoin('memcomplcccerthdr_tbl', 'mclch_membercompmst_fk = MemberCompMst_Pk')
                ->where("MRM_MemberStatus= 'A' AND mrm_stkholdertypmst_fk=6 AND (MRM_RenewalStatus not in('GE') or MRM_RenewalStatus is null) AND (mclch_lcctype = 4 AND mclch_status = 1) and MRM_ValSubStatus='A'");
                if (!empty($skipid)) {
                    $expodtl->andWhere(['<>', 'MemberCompMst_Pk', $skipid]);
                }
                $expodtl->groupBy("MemberCompMst_Pk")
                ->asArray()
                ->all();
                $provider = new ActiveDataProvider(['query' => $expodtl, 'pagination' => ['pageSize' => 0]]);
                $dataRow = '';
                $listData=$provider->getModels();
        foreach ($listData as $key => $dataVal){
            $JsrsExpDate = $dataVal['JsrsExpDate'] == null ? '-':$dataVal['JsrsExpDate'];
            $MCCD_Name = $dataVal['MCCD_Name'] == null ? '-':$dataVal['MCCD_Name'];
            $dataRow.="<tr><td>".($key+1)."</td>
                            <td>".$dataVal['MCM_SupplierCode']."</td>
                            <td>".$dataVal['MCM_CompanyName']."</td>
                            <td style=\"text-align: left;\">".$dataVal['MCM_crnumber']."</td>
                            <td>".$dataVal['JsrsSts']."</td>
                            <td>".$JsrsExpDate."</td>
                            <td>".$dataVal['crstatus']."</td>
                            <td>".$dataVal['pdoissuedon']."</td>                          
                            <td>".$MCCD_Name."</td>
                            <td>".$dataVal['mcmpld_emailid']."</td>
                            <td style=\"text-align: left;\">".$dataVal['jsrsph']."</td>
                            <td style=\"text-align: left;\">".$dataVal['jsrsmob']."</td>
                            <td style=\"text-align: left;\">".$dataVal['comph']."</td>                                           
                            <td>".$dataVal['mcmpld_website']."</td>                                
                            <td>".$dataVal['momp_specialistexpats']."</td>
                            <td>".$dataVal['momp_specialistomani']."</td>
                            <td>".$dataVal['momp_totalspecialist']."</td>
                            <td>".$dataVal['momp_techexpats']."</td>
                            <td>".$dataVal['momp_techomani']."</td>
                            <td>".$dataVal['momp_totaltech']."</td>
                            <td>".$dataVal['momp_occupantexpat']."</td>
                            <td>".$dataVal['momp_occupantomani']."</td>
                            <td>".$dataVal['momp_totaloccupant']."</td>
                            <td>".$dataVal['momp_skilledexpat']."</td>
                            <td>".$dataVal['momp_skilledomani']."</td>
                            <td>".$dataVal['momp_totalskilled']."</td>
                            <td>".$dataVal['momp_lowskilledexpat']."</td>
                            <td>".$dataVal['momp_lowskilledomani']."</td>
                            <td>".$dataVal['momp_totallowskilled']."</td>
                            <td>".$dataVal['momp_omanisation']."</td>
                            <td>".$dataVal['momp_totalexpat']."</td>
                            <td>".$dataVal['momp_totalomani']."</td>
                            <td>".$dataVal['mcshdm_type']."</td>
                            <td>".$dataVal['mcshdm_name']."</td>
                            <td>".$dataVal['mcshdm_regno']."</td>
                            <td>".$dataVal['CyM_CountryName_en']."</td>
                            <td>".$dataVal['mcshdm_percentofstake']."</td>
                        </tr>";
        }        
        if(!empty($dataVal)){
            $tracktbl = new \common\models\DownloadtracktrnsTbl();
            $tracktbl->dtt_membercomp_fk = $userdtl['MemberCompMst_Pk'];
            $tracktbl->dtt_usermst_fk = $userPK;
            $tracktbl->dtt_downloadiniton = date('Y-m-d H:i:s');
            $tracktbl->dtt_donwloadedon = date('Y-m-d H:i:s');
            $tracktbl->dtt_downloadtype = 8;
            $tracktbl->dtt_downloadstatus = 3;
            if(!$tracktbl->save()){  
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $tracktbl->getErrors()
                );
            }
        }
        $userdtl = \common\models\UsermstTbl::find()
                ->select(['um_firstname', 'MCM_CompanyName','MemberCompMst_Pk'])
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('UserMst_Pk=:pk', array(':pk' => $userPK))
                ->asArray()
                ->one();
        $value .= '<table border="1">';        
        
        $value .= '<tr><td colspan="6">';
        $value .= '<table><tr><td height="100"><img src="https://businessgateways.com/images/PDO-LCC-Logos.jpg" alt ="Businessgateways_International_JSRS_PetroleumDevelopmentOman_Logo"/></td></tr></table>';
        $value .= '</td></tr>';
        $value .= '<tr><td colspan="6" style="text-align:center; font-weight:bold; font-size:16px;"><a href="https://businessgateways.com" target="_blank">Business Gateways International LLC</a></td></tr>';
        $value .= '<tr><td colspan="6" style="text-align:center; font-weight:bold; font-size:16px;">PDO LCC'."'s".' With Shareholder Info</td></tr>';
        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Company Name </td>';
        $value .= '<td colspan="1" style="text-align:left; font-weight:bold; font-size:16px;">'.$userdtl['MCM_CompanyName'].'</td>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> User Name </td>';
        $value .= '<td colspan="1" style="text-align:center; font-weight:bold; font-size:16px;"> '.$userdtl['um_firstname'].' </td>';
        $value .= '</tr>';

        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Downloaded On </td>';
        $value .= '<td colspan="1" style="text-align:left; font-weight:bold; font-size:16px;"> '.date('jS F, Y H:i:s').' </td>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Criteria </td>';
        $value .= '<td colspan="1" style="text-align:center; font-weight:bold; font-size:16px;"> PDO LCC </td>';
        $value .= '</tr>';

        $value .= '<tr>';
        $value .= '<td colspan="2" style="text-align:center; font-weight:bold; font-size:16px;"> Data Updated On </td>';
        $value .= '<td colspan="4" style="font-weight:bold; font-size:16px;"> '.date('jS F, Y', strtotime($listData[0]['lastupdatedon'])).' </td>';
        $value .= '</tr>';                
        $value .= '</table>';
        $value .= '<table><tr><td></td></tr></table>';        
        $value .= "<style>
                        .text{
mso-number-format:\"\@\";
} </style><table border='1'>";
        $value .= "<tr  style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td rowspan='3'> Sl no.</td>";
        $value .= "<td rowspan='3'>SUPPLIER CODE</td>";
        $value .= "<td rowspan='3'>COMPANY NAME</td>";
        $value .= "<td rowspan='3'>REGISTRATION NO.</td>";
        $value .= "<td rowspan='3'>JSRS STATUS</td>";
        $value .= "<td rowspan='3'>JSRS Expiry Date</td>";
        $value .= "<td rowspan='3'>CR STATUS</td>";
        $value .= "<td rowspan='3'>PDO LCC APPROVED ON</td>";
        $value .= "<td rowspan='3'>Name (JSRS)</td>";
        $value .= "<td rowspan='3'>COMPANY EMAIL</td>";
        $value .= "<td rowspan='3'>PHONE (JSRS)</td>";
        $value .= "<td rowspan='3'>MOBILE (JSRS)</td>";
        $value .= "<td rowspan='3'>PHONE NO.</td>";
        $value .= "<td rowspan='3'>COMPANY WEBSITE</td>";
        $value .= "<td colspan='18' style='text-align:center;'>MINISTRY OF LABOUR OMANISATION DATA</td>";
        $value .= "<td colspan='5' style='text-align:center;'>SHAREHOLDERS INFORMATION</td>";
        $value .= "</tr>";
        $value .= "<tr style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td colspan='3' style='text-align:center;'>SPECIALIST</td>";
        $value .= "<td colspan='3' style='text-align:center;'>TECHNICIAN</td>";
        $value .= "<td colspan='3' style='text-align:center;'>OCCUPANT</td>";
        $value .= "<td colspan='3' style='text-align:center;'>SKILLED</td>";
        $value .= "<td colspan='3' style='text-align:center;'>LOW SKILLED</td>";
        $value .= "<td rowspan='2'>OMANISATION %</td>";
        $value .= "<td rowspan='2'>TOTAL OMANI</td>";
        $value .= "<td rowspan='2'>TOTAL EXPAT</td>";
//        $value .= "<td rowspan='2'>TOTAL SHAREHOLDERS</td>";
        $value .= "<td rowspan='2'>TYPE</td>";
        $value .= "<td rowspan='2'>NAME</td>";
        $value .= "<td rowspan='2'>ID NUMBER</td>";
        $value .= "<td rowspan='2'>COUNTRY</td>";
        $value .= "<td rowspan='2'>% OF SHARES</td>";
        $value .= "</tr>";
        $value .= "<tr style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "<td>EXPAT</td>";
        $value .= "<td>OMANIS</td>";
        $value .= "<td>TOTAL</td>";
        $value .= "</tr>";
        $value .= $dataRow;
        $value .= '</table>';
        $data .= trim($value) . "\n";
        //insertion part
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=PDO_LCC's_With_LCC_Category_Details.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        print "$header\n$data";exit;
        }else{
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'You are not authourized to access this page',
            );
        return print_r($result);
        }
    }
    
}
