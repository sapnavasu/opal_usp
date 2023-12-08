<?php
namespace api\modules\bs\components;
use Yii;

class Exportbizsearch {
    public $Requestdata;
    public $foldername;
    public $filename;
    public $filename1;
    public $jsondata;
    public $header;
    public $masterdatatable;
    public $exportlimit;
    public function __construct($arg,$limit) {   
        $biztb = \common\models\OsbizsrchdwnldtrackTbl::findOne($arg);
        $this->Requestdata=$biztb;           
        $this->exportlimit=$limit;           
        $this->foldername = dirname(__FILE__).'/../../../../backend/documents/bizsearch/';
//        $this->foldername='/../../backend/documents/bizsearch/';
        $this->filename= $arg;
        $this->filename1 = "export_company";
        $this->jsondata = json_decode($this->Requestdata['osbsdt_exptlist'], true);        
    }
    public function createHeader(){
        $exportheader= base64_decode($this->Requestdata['osbsdt_inputfields']);
        $this->header = $exportheader;
        return $this->header;
    }
    public function CompanyTableHeader(){
        $value .= "<style>
            .text{
                mso-number-format:\"\@\";
                } </style><table border='1'>";
        $value .= "<tr  style='background-color:#E7E7E7;height:40px'>";
        $value .= "<td>Sl. No.</td>";
        $value .= "<td>JSRS REG. NO.</td>";
        $value .= "<td>JSRS SUPPLIER CODE</td>";
        $value .= "<td>JSRS STATUS</td>";
        $value .= "<td>JSRS EXPIRY DATE</td>";
        $value .= "<td>COMPANY NAME</td>";
        $value .= "<td>CR STATUS</td>";
        if(isset($this->jsondata['sezdspecialstatus']) && $this->jsondata['sezdspecialstatus'] == 'yes' ){
            $value .= "<td>SEZAD Special Status</td>";
        }
        if(isset($this->jsondata['specialstatus']) && $this->jsondata['specialstatus'] == 'yes' ){
            $value .= "<td>SPECIAL STATUS</td>";
        }
        if(isset($this->jsondata['pdolcc']) && $this->jsondata['pdolcc'] == 'yes' ){
            $value .= "<td>PDO LCC APPROVED ON</td>";
            $value .= "<td>PDO LCC CONCESSION AREA</td>";
            $value .= "<td>PDO LCC PERMANENT ADDRESS</td>";
        }
        if(isset($this->jsondata['pdolcccategorydetails']) && $this->jsondata['pdolcccategorydetails'] == 'yes' ){
            $pdolccCathead .= "<td><table border='1'>";
            $pdolccCathead .= "<tr><td colspan='3' align='center'>PDO LCC CATEGORY DETAILS</td></tr><tr>";                       
            $pdolccCathead .= "<td rowspan='2'>PDO LCC CATEGORY</td>";
            $pdolccCathead .= "<td rowspan='2'>YEARS OF EXPERIENCE</td>";
            $pdolccCathead .= "<td rowspan='2'>TOTAL CONTRACT VALUE (OMR)</td>";
            $pdolccCathead .= "</tr></table></td>";
            $value .= $pdolccCathead;
        }
        if(isset($this->jsondata['ccedlcc']) && $this->jsondata['ccedlcc'] == 'yes' ){
            $value .= "<td>CCED LCC APPROVED ON</td>";
            $value .= "<td>CCED LCC BLOCK</td>";
            $value .= "<td>CCED LCC WILAYAT</td>";
            $value .= "<td>CCED LCC VILLAGES</td>";
        }
        if(isset($this->jsondata['oxylcc']) && $this->jsondata['oxylcc'] == 'yes' ){
            $value .= "<td>OXY LCC APPROVED ON</td>";
            $value .= "<td>OXY LCC BLOCK</td>";
            $value .= "<td>OXY LCC WILAYAT</td>";
            $value .= "<td>OXY LCC VILLAGE</td>";
        }
        if(isset($this->jsondata['drpiclcc']) && $this->jsondata['drpiclcc'] == 'yes' ){
           $value .= "<td>DRPIC LCC  APPROVED ON</td>";
           $value .= "<td>DRPIC LCC WILAYAT</td>";
        }
        if(isset($this->jsondata['omanisationpercentageasperjsrs']) && $this->jsondata['omanisationpercentageasperjsrs'] == 'yes' ){
           $value .= "<td>OMANISATION PERCENTAGE AS PER JSRS</td>";
        }
       if(isset($this->jsondata['jsrsname']) && $this->jsondata['jsrsname'] == 'yes' ){
         $value .= "<td>NAME (JSRS)</td>";
       }
       if(isset($this->jsondata['jsrsemail']) && $this->jsondata['jsrsemail'] == 'yes' ){
           $value .= "<td>EMAIL (JSRS)</td>";
       }
       if(isset($this->jsondata['jsrsphone']) && $this->jsondata['jsrsphone'] == 'yes' ){
           $value .= "<td>PHONE (JSRS)</td>";
       }
       if(isset($this->jsondata['jsrsmobile']) && $this->jsondata['jsrsmobile'] == 'yes' ){
           $value .= "<td>MOBILE (JSRS)</td>";
       }
        if(isset($this->jsondata['primaryname']) && $this->jsondata['primaryname'] == 'yes' ){
            $value .= "<td>NAME (PRIMARY)</td>";
        }
        if(isset($this->jsondata['primaryemail']) && $this->jsondata['primaryemail'] == 'yes' ){
            $value .= "<td>EMAIL (PRIMARY)</td>";
        }
        if(isset($this->jsondata['primaryphone']) && $this->jsondata['primaryphone'] == 'yes' ){
            $value .= "<td>PHONE (PRIMARY)</td>";
        }
        if(isset($this->jsondata['primarymobile']) && $this->jsondata['primarymobile'] == 'yes' ){
            $value .= "<td>MOBILE (PRIMARY)</td>";
        }
        if(isset($this->jsondata['incorporatestyle']) && $this->jsondata['incorporatestyle'] == 'yes' ){
            $value .= "<td>INCORPORATION STYLE</td>";
        }
        if(isset($this->jsondata['classification']) && $this->jsondata['classification'] == 'yes' ){
            $value .= "<td>CLASSIFICATION</td>";
        }
        if(isset($this->jsondata['establishmentyear']) && $this->jsondata['establishmentyear'] == 'yes' ){
            $value .= "<td>ESTABLISHMENT YEAR</td>";
        }
        if(isset($this->jsondata['commercialregistrationno']) && $this->jsondata['commercialregistrationno'] == 'yes' ){
            $value .= "<td>COMMERCIAL REGISTRATION (CR) NO.</td>";
        }
        if(isset($this->jsondata['commercialregistrationexpiry']) && $this->jsondata['commercialregistrationexpiry'] == 'yes' ){
             $value .= "<td>COMMERCIAL REGISTRATION (CR) EXPIRY</td>";
        }
        if(isset($this->jsondata['chamberofcommercecertificateno']) && $this->jsondata['chamberofcommercecertificateno'] == 'yes' ){
             $value .= "<td>CHAMBER OF COMMERCE CERTIFICATE NO.</td>";
        }
        if(isset($this->jsondata['chamberofcommercecertificateexpiry']) && $this->jsondata['chamberofcommercecertificateexpiry'] == 'yes' ){
             $value .= "<td>CHAMBER OF COMMERCE CERTIFICATE EXPIRY</td>";
        }
        if(isset($this->jsondata['officeaddress']) && $this->jsondata['officeaddress'] == 'yes' ){
              $value .= "<td>OFFICE ADDRESS</td>";
        }
        if(isset($this->jsondata['postaladdress']) && $this->jsondata['postaladdress'] == 'yes' ){
              $value .= "<td>POSTAL ADDRESS</td>";
        }
        if(isset($this->jsondata['orgin']) && $this->jsondata['orgin'] == 'yes' ){
              $value .= "<td>ORIGIN</td>";
        }
        if(isset($this->jsondata['country']) && $this->jsondata['country'] == 'yes' ){
              $value .= "<td>COUNTRY</td>";
        }
        if(isset($this->jsondata['phoneno']) && $this->jsondata['phoneno'] == 'yes' ){
              $value .= "<td>PHONE NO.</td>";
        }
        if(isset($this->jsondata['companywebsite']) && $this->jsondata['companywebsite'] == 'yes' ){
              $value .= "<td>COMPANY WEBSITE</td>";
        }
        if(isset($this->jsondata['companyemail']) && $this->jsondata['companyemail'] == 'yes' ){
             $value .= "<td>COMPANY EMAIL</td>";
        }
//         $value .= "<td>FAX NO.</td>";
        if(isset($this->jsondata['division']) && $this->jsondata['division'] == 'yes' ){
            $divhead = "<td><table border='1'>";
            $divhead .= "<tr><td colspan='2' align='center'>Division</td></tr><tr>";        
            $divhead .= "<td rowspan='2'>Division Name</td>";
            $divhead .= "<td rowspan='2'>Sector</td>";
            $divhead .= "</tr></table></td>";
            $value .= $divhead;
        }
        if(isset($this->jsondata['omanisationpercentageasperministry']) && $this->jsondata['omanisationpercentageasperministry'] == 'yes' ){
            $momhead .= "<td><table border='1'><tr><td colspan='8' align='center'>MINISTRY OF LABOUR OMANISATION DATA</td></tr>";
            $momhead .= "<tr>";
            $momhead .= "<td><table border='1'><tr><td colspan='3' align='center'>SPECIALIST</td></tr><tr><td>EXPATS</td><td>OMANIS</td><td>TOTAL</td></tr></table></td>";
            $momhead .= "<td><table border='1'><tr><td colspan='3' align='center'>TECHNICIAN</td></tr><tr><td>EXPATS</td><td>OMANIS</td><td>TOTAL</td></tr></table></td>";
            $momhead .= "<td><table border='1'><tr><td colspan='3' align='center'>OCCUPANT</td></tr><tr><td>EXPATS</td><td>OMANIS</td><td>TOTAL</td></tr></table></td>";
            $momhead .= "<td><table border='1'><tr><td colspan='3' align='center'>SKILLED</td></tr><tr><td>EXPATS</td><td>OMANIS</td><td>TOTAL</td></tr></table></td>";
            $momhead .= "<td><table border='1'><tr><td colspan='3' align='center'>LOW SKILLED</td></tr><tr><td>EXPATS</td><td>OMANIS</td><td>TOTAL</td></tr></table></td>";
            $momhead .= "<td>OMANISATION %</td>";
            $momhead .= "<td>TOTAL OMANI STAFF</td>";
            $momhead .= "<td>TOTAL EXPAT STAFF</td>";
            $momhead .= "</tr>";
            $momhead .= "</table>";
            $momhead .= "</td>";
            $value .= $momhead;
        }
        if(isset($this->jsondata['shareholdersinformation']) && $this->jsondata['shareholdersinformation'] == 'yes' ){
            $shareholhead  = "<td><table border='1'>";
            $shareholhead .= "<tr><td colspan='6' align='center'>SHAREHOLDERS INFORMATION</td></tr><tr>";                       
            $shareholhead .= "<td rowspan='2'>TOTAL SHAREHOLDERS</td>";
            $shareholhead .= "<td rowspan='2'>TYPE</td>";
            $shareholhead .= "<td rowspan='2'>NAME</td>";
            $shareholhead .= "<td rowspan='2'>ID NUMBER</td>";
            $shareholhead .= "<td rowspan='2'>COUNTRY</td>";
            $shareholhead .= "<td rowspan='2'>% OF SHARES</td>";
            $shareholhead .= "</tr></table></td>";
            $value .= $shareholhead;
        }
        if(isset($this->jsondata['products']) && $this->jsondata['products'] == 'yes'){            
            $colcnt = $this->jsondata['prdcnt'];
            $producthead .= "<td><table border='1'>";
            $producthead .= "<tr><td colspan='".$colcnt."' align='center'>PRODUCTS</td></tr><tr>";
             if(isset($this->jsondata['jsrsproductstatus']) && $this->jsondata['jsrsproductstatus'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>PRODUCT STATUS (JSRS)</td>";
             }
             if(isset($this->jsondata['pgroupcategory']) && $this->jsondata['pgroupcategory'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>GROUP CATEGORY</td>";
             }
             if(isset($this->jsondata['pmaincategory']) && $this->jsondata['pmaincategory'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>MAIN CATEGORY</td>";
             }
             if(isset($this->jsondata['psubcategory']) && $this->jsondata['psubcategory'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>SUB CATEGORY</td>";
             }
             if(isset($this->jsondata['jsrscategorycodeproduct']) && $this->jsondata['jsrscategorycodeproduct'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>JSRS CATEGORY CODE - PRODUCT</td>";
             }
             if(isset($this->jsondata['pdisplayname']) && $this->jsondata['pdisplayname'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>DISPLAY NAME</td>";
             }
             if(isset($this->jsondata['pbusinesssource']) && $this->jsondata['pbusinesssource'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>BUSINESS SOURCE</td>";
             }
             if(isset($this->jsondata['pdivisionproduct']) && $this->jsondata['pdivisionproduct'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>DIVISION</td>";
             }
             if(isset($this->jsondata['psectorproduct']) && $this->jsondata['psectorproduct'] == 'yes'){   
                 $producthead .= "<td rowspan='2'>SECTOR</td>";
             }
             if(isset($this->jsondata['pactivities']) && $this->jsondata['pactivities'] == 'yes'){   
                $producthead .= "<td rowspan='2'>ACTIVITIES</td>";
             }
            $producthead .= "</tr></table></td>";
            $value .= $producthead;
        }
        if(isset($this->jsondata['services']) && $this->jsondata['services'] == 'yes'){            
            $scolcnt = $this->jsondata['sercnt'];
            $servicehead .= "<td><table border='1'>";
            $servicehead .= "<tr><td  colspan='".$scolcnt."' align='center'>SERVICES</td></tr><tr>";
            if(isset($this->jsondata['jsrsservicestatus']) && $this->jsondata['jsrsservicestatus'] == 'yes'){  
                 $servicehead .= "<td rowspan='2'>SERVICES  STATUS (JSRS)</td>";
            }
            if(isset($this->jsondata['sgroupcategory']) && $this->jsondata['sgroupcategory'] == 'yes'){  
                 $servicehead .= "<td rowspan='2'>GROUP CATEGORY</td>";
            }
            if(isset($this->jsondata['smaincategory']) && $this->jsondata['smaincategory'] == 'yes'){  
                $servicehead .= "<td rowspan='2'>MAIN CATEGORY</td>";
            }
            if(isset($this->jsondata['ssubcategory']) && $this->jsondata['ssubcategory'] == 'yes'){  
                $servicehead .= "<td rowspan='2'>SUB CATEGORY</td>";
            }
            if(isset($this->jsondata['jsrscategorycodeservice']) && $this->jsondata['jsrscategorycodeservice'] == 'yes'){  
               $servicehead .= "<td rowspan='2'>JSRS CATEGORY CODE - SERVICE</td>";
            }
            if(isset($this->jsondata['displaynameservice']) && $this->jsondata['displaynameservice'] == 'yes'){  
               $servicehead .= "<td rowspan='2'>DISPLAY NAME</td>";
            }
            if(isset($this->jsondata['businesssourceservice']) && $this->jsondata['businesssourceservice'] == 'yes'){  
               $servicehead .= "<td rowspan='2'>BUSINESS SOURCE</td>";
            }
            if(isset($this->jsondata['divisionservice']) && $this->jsondata['divisionservice'] == 'yes'){  
               $servicehead .= "<td rowspan='2'>DIVISION</td>";
            }
            if(isset($this->jsondata['sectorservice']) && $this->jsondata['sectorservice'] == 'yes'){  
                $servicehead .= "<td rowspan='2'>SECTOR</td>";
            }
            if(isset($this->jsondata['activitiesservice']) && $this->jsondata['activitiesservice'] == 'yes'){  
                $servicehead .= "<td rowspan='2'>ACTIVITIES</td>";
            }
            $servicehead .= "</tr></table></td>";
            $value .= $servicehead;
        }        
        $value .= "</tr>";
        $this->tableHeader=$value;                        
        return $this->tableHeader;                   
    }
    public function CompanyDataFormation(){   
        $getcountrydetails = \api\modules\mst\models\CountrymstTblQuery::countrydetails();
        $statenames = \api\modules\mst\models\StatemstTblQuery::getstatesdetails();
        $citynames = \api\modules\mst\models\CitymstTblQuery::getcitydetails();
        $wilayatnames = \common\models\WilayatmstTbl::getwilayatdetail();
        $villagenames = \common\models\VillagemstTbl::getvillagedetail();
        $pdocategorylist = \common\models\PdocategorymstTblQuery::getpdocategorydetail();
        $sectorlistdetails = \api\modules\mst\models\SectormstTblQuery::getsectordetail();
        $countrynames = $getcountrydetails['countrylist'];
        $countrydialcode = $getcountrydetails['countrydialcode'];   
        $exportquery = $this->Requestdata['osbsdt_exptquery'];
//        $exportquery =\api\modules\bs\components\Bizsearch::Jsearchexportqueryform(1);
        $row = \api\modules\bs\components\Bizsearch::Jsearchexportqueryexce($exportquery);
        $slno=1;
       if(!empty($this->exportlimit)){
             $exportLimit = $this->exportlimit;
        }else{
            $exportLimit = 0;
        }
        for ($i = 0; $i < count($row); $i++) {
            $value .= "<tr>";
            $value .= "<td valing='top'>" . $slno . "</td>";
            $value .= "<td valing='top' class='text'>" . $row[$i]['regno'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['suppliercode'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['jsrsstatus'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['expiredate'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['companyname'] . "</td>";
            $Expired='Active';
           $crExpDate=$row[$i]['crstatusdate'];
            if(!empty($crExpDate)){
                if ($row[$i]['origin'] == 'National')
                {
                    $CrExpired=date("Y-m-d", strtotime($crExpDate.' + 30 days')); 
                    $currentDate=Date('Y-m-d');
                    if($CrExpired<$currentDate){
                        $Expired = 'Expired';
                    }
                } else {
                    $CrExpired=date("Y-m-d", strtotime($crExpDate)); 
                    $currentDate=Date('Y-m-d');
                    if($CrExpired<$currentDate){
                        $Expired = "Expired";
                    }
                }
            }
            $value .= "<td>" . $Expired . "</td>";
            if(isset($this->jsondata['sezdspecialstatus']) && $this->jsondata['sezdspecialstatus'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['sezardsplsts'] . "</td>";
            }
            if(isset($this->jsondata['specialstatus']) && $this->jsondata['specialstatus'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['splsts'] . "</td>";
            }
            if(isset($this->jsondata['pdolcc']) && $this->jsondata['pdolcc'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['pdoapprovedon'] . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['pdoconcessionarea'] . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['pdopermanentadds'] . "</td>";
            }
            if(isset($this->jsondata['pdolcccategorydetails']) && $this->jsondata['pdolcccategorydetails'] == 'yes' ){
                $proserflag = true;
                $pdocatjson =  json_decode($row[$i]['pdocategory']);
                $pdocat = json_decode(json_encode($pdocatjson), true);
                if(count($pdocat) > 0){                    
                    $rowcountArr['pdocateg']=count($pdocat);
                    $pdolcccatvalue = "<table border = '1'>";
                    foreach ($pdocat as $pdolccval ) {
                        $pdolcccatvalue .= "<tr>";
                        $pdolcccatvalue .= "<td>" . (!empty($pdolccval['categoryname']) ? $pdocategorylist[$pdolccval['categoryname']] : "-") ."</td>";
                        $pdolcccatvalue .= "<td>" . (!empty($pdolccval['yearofexp']) ? $pdolccval['yearofexp'] : "-") ."</td>";
                        $pdolcccatvalue .= "<td>" . (!empty($pdolccval['contractvalue'] && $pdolccval['contractvalue'] !='-' ) ? 'OMR ' . $pdolccval['contractvalue'] : "-") ."</td>";
                        $pdolcccatvalue .= "</tr>";
                    }
                    $pdolcccatvalue .= "</table>";                                                
                }else{
                    $pdolcccatvalue = "";
                }
                $value .= "<td>". $pdolcccatvalue. "</td>";
            }
            if(isset($this->jsondata['ccedlcc']) && $this->jsondata['ccedlcc'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['ccedapprovedon'] . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['ccedblock'] . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['ccedwillayat']) ? $wilayatnames[$row[$i]['ccedwillayat']] : "-")  . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['ccedvillage']) ? $villagenames[$row[$i]['ccedvillage']] : "-") . "</td>";
            }
            if(isset($this->jsondata['oxylcc']) && $this->jsondata['oxylcc'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['oxyapprovedon'] . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['oxyblock'] . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['oxywillayat']) ? $wilayatnames[$row[$i]['oxywillayat']] : "-") . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['oxyvillage']) ? $villagenames[$row[$i]['oxyvillage']] : "-") . "</td>";
            }
            if(isset($this->jsondata['drpiclcc']) && $this->jsondata['drpiclcc'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['duqumapprovedon'] . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['duqumwillayat']) ? $wilayatnames[$row[$i]['duqumwillayat']] : "-") . "</td>";
            }
             if(isset($this->jsondata['omanisationpercentageasperjsrs']) && $this->jsondata['omanisationpercentageasperjsrs'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['omaizationpercntage'] . "</td>";
             }
             if(isset($this->jsondata['jsrsname']) && $this->jsondata['jsrsname'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['jsrsName'] . "</td>";
             }
             if(isset($this->jsondata['jsrsemail']) && $this->jsondata['jsrsemail'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['jsrsemailid'] . "</td>";
             }
             if(isset($this->jsondata['jsrsphone']) && $this->jsondata['jsrsphone'] == 'yes' ){
                if(!empty($row[$i]['jsrslandline']) && !empty($row[$i]['jsrslandlinecc'])){
                    $jsrslandline = $countrydialcode[$row[$i]['jsrslandlinecc']] . ' ' . $row[$i]['jsrslandline'];
                }elseif(!empty($row[$i]['jsrslandline']) && empty($row[$i]['jsrslandlinecc'])){
                    $jsrslandline = $row[$i]['jsrslandline'];
                }else{
                    $jsrslandline = "-";
                }
                $value .= "<td valing='top'>" . $jsrslandline . "</td>";
             }
             if(isset($this->jsondata['jsrsmobile']) && $this->jsondata['jsrsmobile'] == 'yes' ){
                if(!empty($row[$i]['jsrsmobile']) && !empty($row[$i]['jsrscc'])){
                    $jsrsmobile = $countrydialcode[$row[$i]['jsrscc']] . ' ' . $row[$i]['jsrsmobile'];
                }elseif(!empty($row[$i]['jsrsmobile']) && empty($row[$i]['jsrscc'])){
                    $jsrsmobile = $row[$i]['jsrsmobile'];
                }else{
                    $jsrsmobile = "-";
                }
                $value .= "<td valing='top'>" . $jsrsmobile . "</td>";
             }            
             if(isset($this->jsondata['primaryname']) && $this->jsondata['primaryname'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['primaryName'] . "</td>";
             }
             if(isset($this->jsondata['primaryemail']) && $this->jsondata['primaryemail'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['primaryemailid'] . "</td>";
             }
             if(isset($this->jsondata['primaryphone']) && $this->jsondata['primaryphone'] == 'yes' ){
                 if(!empty($row[$i]['primarylandline']) && !empty($row[$i]['landlinecc'])){
                    $primarylandline = $countrydialcode[$row[$i]['landlinecc']] . ' ' . $row[$i]['primarylandline'];
                }elseif(!empty($row[$i]['primarylandline']) && empty($row[$i]['landlinecc'])){
                    $primarylandline = $row[$i]['primarylandline'];
                }else{
                    $primarylandline = "-";
                }
                $value .= "<td valing='top'>" . $primarylandline . "</td>";
             }
             if(isset($this->jsondata['primarymobile']) && $this->jsondata['primarymobile'] == 'yes' ){
                 if(!empty($row[$i]['primarymobile']) && !empty($row[$i]['primarycc'])){
                    $primarymobile = $countrydialcode[$row[$i]['primarycc']] . ' ' . $row[$i]['primarymobile'];
                }elseif(!empty($row[$i]['primarymobile']) && empty($row[$i]['primarycc'])){
                    $primarymobile = $row[$i]['primarymobile'];
                }else{
                    $primarymobile = "-";
                }
                $value .= "<td valing='top'>" . $primarymobile . "</td>";
             }
             if(isset($this->jsondata['incorporatestyle']) && $this->jsondata['incorporatestyle'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['incorpstyle'] . "</td>";
             }
             if(isset($this->jsondata['classification']) && $this->jsondata['classification'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['classiciation'] . "</td>";
             }
             if(isset($this->jsondata['establishmentyear']) && $this->jsondata['establishmentyear'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['establismentyr'] . "</td>";
             }
             if(isset($this->jsondata['commercialregistrationno']) && $this->jsondata['commercialregistrationno'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['commercialnumb'] . "</td>";
             }
             if(isset($this->jsondata['commercialregistrationexpiry']) && $this->jsondata['commercialregistrationexpiry'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['commercialexpiredate'] . "</td>";
             }
             if(isset($this->jsondata['chamberofcommercecertificateno']) && $this->jsondata['chamberofcommercecertificateno'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['chambernumber'] . "</td>";
             }
             if(isset($this->jsondata['chamberofcommercecertificateexpiry']) && $this->jsondata['chamberofcommercecertificateexpiry'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['chamberexpiredate'] . "</td>";
             }
             if(isset($this->jsondata['officeaddress']) && $this->jsondata['officeaddress'] == 'yes' ){
                if(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && !empty($row[$i]['officeaddstate']) && !empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']] .  ' '. $statenames[$row[$i]['officeaddstate']] . ' ' . $citynames[$row[$i]['officeaddcity']];
                }elseif(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && !empty($row[$i]['officeaddstate']) && empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']] .  ' '. $statenames[$row[$i]['officeaddstate']];
                }elseif(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && empty($row[$i]['officeaddstate']) && empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']];
                }else{
                    $officeadds = "-";
                }
                $value .= "<td valing='top'>" . $officeadds."</td>";
             }
             if(isset($this->jsondata['postaladdress']) && $this->jsondata['postaladdress'] == 'yes' ){
                if(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && !empty($row[$i]['postalstate']) && !empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']] .  ' '. $statenames[$row[$i]['postalstate']] . ' ' . $citynames[$row[$i]['postalcity']];
               }elseif(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && !empty($row[$i]['postalstate']) && empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']] .  ' '. $statenames[$row[$i]['postalstate']];
               }elseif(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && empty($row[$i]['postalstate']) && empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']];
               }else{
                   $postaladds = "-";
               }
               $value .= "<td valing='top'>" . $postaladds . "</td>";
           }
           if(isset($this->jsondata['orgin']) && $this->jsondata['orgin'] == 'yes' ){
            $value .= "<td valing='top'>" . $row[$i]['origin'] . "</td>";
           }
           if(isset($this->jsondata['country']) && $this->jsondata['country'] == 'yes' ){
                $value .= "<td valing='top'>" . (!empty($row[$i]['officeaddcountry']) ? $countrynames[$row[$i]['officeaddcountry']] : "-") . "</td>";
           }
           if(isset($this->jsondata['phoneno']) && $this->jsondata['phoneno'] == 'yes' ){
                if(!empty($row[$i]['companylandline']) && !empty($row[$i]['companylandlinecc'])){
                    $complandline = $countrydialcode[$row[$i]['companylandlinecc']] . ' ' . $row[$i]['companylandline'];
                }elseif(!empty($row[$i]['companylandline']) && empty($row[$i]['companylandlinecc'])){
                    $complandline = $row[$i]['companylandline'];
                }else{
                    $complandline = "-";
                }
                $value .= "<td valing='top'>" . $complandline . "</td>";
           }
//            $value .= "<td valing='top'>-</td>";
           if(isset($this->jsondata['companywebsite']) && $this->jsondata['companywebsite'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['compwebsite'] . "</td>";
           }
           if(isset($this->jsondata['companyemail']) && $this->jsondata['companyemail'] == 'yes' ){
            $value .= "<td valing='top'>" . $row[$i]['compemail'] . "</td>";
           }
           if(isset($this->jsondata['division']) && $this->jsondata['division'] == 'yes' ){
               $proserflag = true;
                $divisionsectorjson =  json_decode($row[$i]['divisionsector']);
                $divisionsector = json_decode(json_encode($divisionsectorjson), true);
                if(count($divisionsector) > 0){                    
                    $rowcountArr['division']=count($divisionsector);
                    $divisionsectorvalue = "<table border = '1'>";
                    foreach ($divisionsector as $dsval ) {
                        $divisionsectorvalue .= "<tr>";
                        $divisionsectorvalue .= "<td>" . (!empty($dsval['division']) ? $dsval['division'] : "-") ."</td>";
                        if(!empty($dsval['sector'])){
                            $impsec = explode(",",$dsval['sector']);
                            foreach ($impsec as $sval ) {
                                $sectorname .= $sectorlistdetails[$sval].',';
                            }                 
                            $tsectorval = rtrim($sectorname,',');
                            $sectortd = "<td>" . $tsectorval ."</td>";
                        }else{                        
                            $sectortd = "<td>-</td>";
                        }
                        $divisionsectorvalue .= $sectortd;
                        $divisionsectorvalue .= "</tr>";
                    }
                    $divisionsectorvalue .= "</table>";                                                
                }else{
                    $divisionsectorvalue = "";
                }
                $value .= "<td>". $divisionsectorvalue. "</td>";
           }
           if(isset($this->jsondata['omanisationpercentageasperministry']) && $this->jsondata['omanisationpercentageasperministry'] == 'yes' ){
                $momvalue = "<table border = '1'>";
                $momvalue .= "<tr>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['specialistexpats']) ?$row[$i]['specialistexpats']:"-")  . "</td>
                 <td>" .  (!empty($row[$i]['specialistomani']) ?$row[$i]['specialistomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totalspecialist']) ?$row[$i]['totalspecialist']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['techexpats']) ?$row[$i]['techexpats']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['techomani']) ?$row[$i]['techomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totaltech']) ?$row[$i]['totaltech']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['occupantexpat']) ?$row[$i]['occupantexpat']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['occupantomani']) ?$row[$i]['occupantomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totaloccupant']) ?$row[$i]['totaloccupant']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['skilledexpat']) ?$row[$i]['skilledexpat']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['skilledomani']) ?$row[$i]['skilledomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totalskilled']) ?$row[$i]['totalskilled']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['lowskilledexpat']) ?$row[$i]['lowskilledexpat']:"-")  . "</td>
                 <td>" .  (!empty($row[$i]['lowskilledomani']) ?$row[$i]['lowskilledomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totallowskilled']) ?$row[$i]['totallowskilled']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td>" .  (!empty($row[$i]['percentage']) ?$row[$i]['percentage'] . '%' :"-")  . "</td>";
                $momvalue .= "<td>" . (!empty($row[$i]['totalomani']) ?$row[$i]['totalomani']:"-") . "</td>";
                $momvalue .=  "<td>" . (!empty($row[$i]['totalexpat']) ?$row[$i]['totalexpat']:"-") . "</td>";
                $momvalue .= "</tr>";
                $momvalue .= "</table>";
                $value .= "<td>". $momvalue. "</td>";
           }
           if(isset($this->jsondata['shareholdersinformation']) && $this->jsondata['shareholdersinformation'] == 'yes' ){
               $proserflag = true;
                $shareholdetjson = json_decode($row[$i]['shareholderdetail']);
                $shareholdet = json_decode(json_encode($shareholdetjson), true);
                $countshare = $row[$i]['totalshareholder'];
                if($countshare > 0){                       
                    $rowcountArr['shareholder']=$countshare;
                        $shareholdervalue = "<table border = '1'>";
                        $shareholdertot = "<td rowspan='$countshare'>". $countshare . "</td>";   
                        foreach ($shareholdet as $shareval ) {
                            $shareholdervalue .= "<tr>" .$shareholdertot;          
                            $shareholdervalue .= "<td>" . (!empty($shareval['type']) ? $shareval['type'] : "-") ."</td>";
                            $shareholdervalue .= "<td>" . (!empty($shareval['name']) ? $shareval['name'] : "-") ."</td>";
                            $shareholdervalue .= "<td>" . (!empty($shareval['idnumber']) ? $shareval['idnumber'] : "-") ."</td>";
                            $shareholdervalue .= "<td>" . (!empty($shareval['countryval']) ? $countrynames[$shareval['countryval']] : "-") ."</td>";
                            $shareholdervalue .= "<td>" . (!empty($shareval['percenatge']) ? $shareval['percenatge'] : "-") ."</td>";
                            $shareholdervalue .= "</tr>";
                            $shareholdertot = "";
                        }
                        $shareholdervalue .= "</table>";                                                
                }else{
                    $shareholdervalue = " - ";
                }
                $value .= "<td>". $shareholdervalue. "</td>";   
           }
           if(isset($this->jsondata['products']) && $this->jsondata['products'] == 'yes'){   
               $proserflag = true;
                $productdetails = self::getproductquery($row[$i]['MemberCompMst_Pk']);
                if(count($productdetails) >0){                    
                    $rowcountArr['product']=count($productdetails);
                    $productvalue = "<table border = '1'>";
                    foreach ($productdetails as $key => $pvalue) {                    
                        $productvalue .= "<tr>";
                        if(isset($this->jsondata['jsrsproductstatus']) && $this->jsondata['jsrsproductstatus'] == 'yes'){   
                            $productvalue .= "<td>{$pvalue['productStatus']}</td>";
                        }
                        if(isset($this->jsondata['pgroupcategory']) && $this->jsondata['pgroupcategory'] == 'yes'){   
                            $productvalue .= "<td>" . (!empty($pvalue['groupcategory']) ? $pvalue['groupcategory'] : "-") ."</td>";
                        }
                        if(isset($this->jsondata['pmaincategory']) && $this->jsondata['pmaincategory'] == 'yes'){   
                            $productvalue .= "<td>" . (!empty($pvalue['maincategory']) ? $pvalue['maincategory'] : "-") ."</td>";
                        }
                        if(isset($this->jsondata['psubcategory']) && $this->jsondata['psubcategory'] == 'yes'){   
                           $productvalue .= "<td>" . (!empty($pvalue['subcategory']) ? $pvalue['subcategory'] : "-") ."</td>";
                        }
                        if(isset($this->jsondata['jsrscategorycodeproduct']) && $this->jsondata['jsrscategorycodeproduct'] == 'yes'){ 
                            $productvalue .= "<td>" . (!empty($pvalue['categorycode']) ? $pvalue['categorycode'] : "-") ."</td>";
                        }
                        if(isset($this->jsondata['pdisplayname']) && $this->jsondata['pdisplayname'] == 'yes'){  
                            $productvalue .= "<td>" . (!empty($pvalue['displayName']) ? $pvalue['displayName'] : "-") ."</td>";
                        }
                        if(isset($this->jsondata['pbusinesssource']) && $this->jsondata['pbusinesssource'] == 'yes'){   
                            $businessdet = $pvalue['businessSource'];
                            if(!empty($businessdet)){
                                $businessvalue .=  "<table border = '1'>";
                                $businesssrc = explode(",",$businessdet);
                                foreach ($businesssrc as $bvalue) {
                                    $businessvalue .= "<tr>";
                                    $businessvalue .= "<td>" . (!empty($bvalue) ? $bvalue : "-") ."</td>";
                                    $businessvalue .= "</tr>";
                                }
                                $businessvalue .= "</table>";
                            }else{
                                $businessvalue = "-";
                            }
                            $productvalue .= "<td>". $businessvalue. "</td>";   
                        }
                        if(isset($this->jsondata['pdivisionproduct']) && $this->jsondata['pdivisionproduct'] == 'yes'){   
                            $divisiondet = $pvalue['division'];
                            if(!empty($divisiondet)){
                                $divisionvalue .=  "<table border = '1'>";
                                $divipart = explode(",",$divisiondet);
                                foreach ($divipart as $dvalue) {
                                    $divisionvalue .= "<tr>";
                                    $divisionvalue .= "<td>" . (!empty($dvalue) ? $dvalue : "-") ."</td>";
                                    $divisionvalue .= "</tr>";
                                }
                                $divisionvalue .= "</table>";
                            }else{
                                $divisionvalue = "-";
                            }
                            $productvalue .= "<td>". $divisionvalue. "</td>";   
                        }
                        if(isset($this->jsondata['psectorproduct']) && $this->jsondata['psectorproduct'] == 'yes'){  
                            $sectordet = $pvalue['sector'];
                            if(!empty($sectordet)){
                                $sectorvalue .=  "<table border = '1'>";
                                $sectorpart = explode(",",$sectordet);
                                foreach ($sectorpart as $svalue) {
                                    $sectorvalue .= "<tr>";
                                    $sectorvalue .= "<td>" . (!empty($svalue) ? $svalue : "-") ."</td>";
                                    $sectorvalue .= "</tr>";
                                }
                                $sectorvalue .= "</table>";
                            }else{
                                $sectorvalue = "-";
                            }
                            $productvalue .= "<td>". $sectorvalue. "</td>";   
                        }
                        if(isset($this->jsondata['pactivities']) && $this->jsondata['pactivities'] == 'yes'){   
                            $activitydet = $pvalue['activity'];
                            if(!empty($activitydet)){
                                $activityvalue .=  "<table border = '1'>";
                                $activitypart = explode(",",$sectordet);
                                foreach ($activitypart as $avalue) {
                                    $activityvalue .= "<tr>";
                                    $activityvalue .= "<td>" . (!empty($avalue) ? $avalue : "-") ."</td>";
                                    $activityvalue .= "</tr>";
                                }
                                $activityvalue .= "</table>";
                            }else{
                                $activityvalue = "-";
                            }
                            $productvalue .= "<td>". $activityvalue. "</td>";   
                        }
                        $productvalue .= "</tr>";
                    }
                    $productvalue .= "</table>";
                }else{
                    $productvalue = "-";
                }
                $value .= "<td>". $productvalue. "</td>";   
           }
           if(isset($this->jsondata['services']) && $this->jsondata['services'] == 'yes'){   
            $proserflag = true;
            $servicesdetails = self::getservicesquery($row[$i]['MemberCompMst_Pk']);
            if(count($servicesdetails) >0){                
                $rowcountArr['services']=count($servicesdetails);
                $servicesvalue = "<table border = '1'>";
                foreach ($servicesdetails as $key => $ssalue) {                    
                    $servicesvalue .= "<tr>";
                    if(isset($this->jsondata['jsrsservicestatus']) && $this->jsondata['jsrsservicestatus'] == 'yes'){  
                        $servicesvalue .= "<td>{$ssalue['serviceStatus']}</td>";
                    }
                    if(isset($this->jsondata['sgroupcategory']) && $this->jsondata['sgroupcategory'] == 'yes'){  
                        $servicesvalue .= "<td>" . (!empty($ssalue['groupcategory']) ? $ssalue['groupcategory'] : "-") ."</td>";
                    }
                    if(isset($this->jsondata['smaincategory']) && $this->jsondata['smaincategory'] == 'yes'){  
                        $servicesvalue .= "<td>" . (!empty($ssalue['maincategory']) ? $ssalue['maincategory'] : "-") ."</td>";
                    }
                    if(isset($this->jsondata['ssubcategory']) && $this->jsondata['ssubcategory'] == 'yes'){  
                        $servicesvalue .= "<td>" . (!empty($ssalue['subcategory']) ? $ssalue['subcategory'] : "-") ."</td>";
                    }
                    if(isset($this->jsondata['jsrscategorycodeservice']) && $this->jsondata['jsrscategorycodeservice'] == 'yes'){  
                        $servicesvalue .= "<td>" . (!empty($ssalue['categorycode']) ? $ssalue['categorycode'] : "-") ."</td>";
                    }
                    if(isset($this->jsondata['displaynameservice']) && $this->jsondata['displaynameservice'] == 'yes'){  
                        $servicesvalue .= "<td>" . (!empty($ssalue['displayName']) ? $ssalue['displayName'] : "-") ."</td>";
                    }
                    if(isset($this->jsondata['businesssourceservice']) && $this->jsondata['businesssourceservice'] == 'yes'){  
                        $businessdet = $ssalue['businessSource'];
                        if(!empty($businessdet)){
                            $businessvalue .=  "<table border = '1'>";
                            $businesssrc = explode(",",$businessdet);
                            foreach ($businesssrc as $bvalue) {
                                $businessvalue .= "<tr>";
                                $businessvalue .= "<td>" . (!empty($bvalue) ? $bvalue : "-") ."</td>";
                                $businessvalue .= "</tr>";
                            }
                            $businessvalue .= "</table>";
                        }else{
                            $businessvalue = "-";
                        }
                        $servicesvalue .= "<td>". $businessvalue. "</td>";   
                    }
                    if(isset($this->jsondata['divisionservice']) && $this->jsondata['divisionservice'] == 'yes'){  
                        $divisiondet = $ssalue['division'];
                        if(!empty($divisiondet)){
                            $divisionvalue .=  "<table border = '1'>";
                            $divipart = explode(",",$divisiondet);
                            foreach ($divipart as $dvalue) {
                                $divisionvalue .= "<tr>";
                                $divisionvalue .= "<td>" . (!empty($dvalue) ? $dvalue : "-") ."</td>";
                                $divisionvalue .= "</tr>";
                            }
                            $divisionvalue .= "</table>";
                        }else{
                            $divisionvalue = "-";
                        }
                        $servicesvalue .= "<td>". $divisionvalue. "</td>";  
                    }
                    if(isset($this->jsondata['sectorservice']) && $this->jsondata['sectorservice'] == 'yes'){  
                        $sectordet = $ssalue['sector'];
                        if(!empty($sectordet)){
                            $sectorvalue .=  "<table border = '1'>";
                            $sectorpart = explode(",",$sectordet);
                            foreach ($sectorpart as $svalue) {
                                $sectorvalue .= "<tr>";
                                $sectorvalue .= "<td>" . (!empty($svalue) ? $svalue : "-") ."</td>";
                                $sectorvalue .= "</tr>";
                            }
                            $sectorvalue .= "</table>";
                        }else{
                            $sectorvalue = "-";
                        }
                        $servicesvalue .= "<td>". $sectorvalue. "</td>";   
                    }
                    if(isset($this->jsondata['activitiesservice']) && $this->jsondata['activitiesservice'] == 'yes'){  
                        $activitydet = $ssalue['activity'];
                        if(!empty($activitydet)){
                            $activityvalue .=  "<table border = '1'>";
                            $activitypart = explode(",",$sectordet);
                            foreach ($activitypart as $avalue) {
                                $activityvalue .= "<tr>";
                                $activityvalue .= "<td>" . (!empty($avalue) ? $avalue : "-") ."</td>";
                                $activityvalue .= "</tr>";
                            }
                            $activityvalue .= "</table>";
                        }else{
                            $activityvalue = "-";
                        }
                        $servicesvalue .= "<td>". $activityvalue. "</td>";   
                    }
                    $servicesvalue .= "</tr>";
                }
                $servicesvalue .= "</table>";
            }else{
                $servicesvalue = "-";
            }
            $value .= "<td>". $servicesvalue. "</td>";   
           }
            $value .= "</tr>";
            if($proserflag){      
                if(!empty($rowcountArr)){                          
                    $totRowCnt+=max($rowcountArr);
                    if($totRowCnt > $exportLimit){
                        $masterdatatable[]=$value;
                        $this->masterdatatable = $masterdatatable;  
                        $value=$totRowCnt='';
                    }
                 }
            }
            $slno++;
        }
        $masterdatatable[]=$value;
        $this->masterdatatable=$masterdatatable;
        if(!$proserflag){            
            $value .= "</table>";
            $data .= trim($this->tableHeader.$value) . "\n";
        }else{
            if(empty($masterdatatable)){
                $masterdatatable[]=$value; 
                $this->masterdatatable=$masterdatatable;
            }         
        }   
        $this->tableContent=$value;
        return $this->tableContent; 
    }
    public function CompanyUnmergeDataFormation(){        
        $getcountrydetails = \api\modules\mst\models\CountrymstTblQuery::countrydetails();
        $statenames = \api\modules\mst\models\StatemstTblQuery::getstatesdetails();
        $citynames = \api\modules\mst\models\CitymstTblQuery::getcitydetails();
        $wilayatnames = \common\models\WilayatmstTbl::getwilayatdetail();
        $villagenames = \common\models\VillagemstTbl::getvillagedetail();
        $pdocategorylist = \common\models\PdocategorymstTblQuery::getpdocategorydetail();
        $countrynames = $getcountrydetails['countrylist'];
        $countrydialcode = $getcountrydetails['countrydialcode'];   
        $exportquery = $this->Requestdata['osbsdt_exptquery'];
//        $exportquery =\api\modules\bs\components\Bizsearch::Jsearchexportqueryform(1);
        $row = \api\modules\bs\components\Bizsearch::Jsearchexportqueryexce($exportquery);
        $slno=1;
        $rowcnt=1;
        if(!empty($this->exportlimit)){
             $exportLimit = $this->exportlimit -1;
        }else{
            $exportLimit = 0;
        }        
        $datacount = count($row);
        for ($i = 0; $i < count($row); $i++) {
            $value .= "<tr>";
            $value .= "<td valing='top'>" . $slno . "</td>";
            $value .= "<td valing='top' class='text'>" . $row[$i]['regno'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['suppliercode'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['jsrsstatus'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['expiredate'] . "</td>";
            $value .= "<td valing='top'>" . $row[$i]['companyname'] . "</td>";
            $Expired='Active';
           $crExpDate=$row[$i]['crstatusdate'];
            if(!empty($crExpDate)){
                if ($row[$i]['origin'] == 'National')
                {
                    $CrExpired=date("Y-m-d", strtotime($crExpDate.' + 30 days')); 
                    $currentDate=Date('Y-m-d');
                    if($CrExpired<$currentDate){
                        $Expired = 'Expired';
                    }
                } else {
                    $CrExpired=date("Y-m-d", strtotime($crExpDate)); 
                    $currentDate=Date('Y-m-d');
                    if($CrExpired<$currentDate){
                        $Expired = "Expired";
                    }
                }
            }
            $value .= "<td>" . $Expired . "</td>";
            if(isset($this->jsondata['sezdspecialstatus']) && $this->jsondata['sezdspecialstatus'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['sezardsplsts'] . "</td>";
            }
            if(isset($this->jsondata['specialstatus']) && $this->jsondata['specialstatus'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['splsts'] . "</td>";
            }
            if(isset($this->jsondata['pdolcc']) && $this->jsondata['pdolcc'] == 'yes' ){
                $value .= "<td valing='top'>" . (!empty($row[$i]['pdoapprovedon']) ? date("d-m-Y", strtotime($row[$i]['pdoapprovedon'])) : "-") . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['pdoconcessionarea'] . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['pdopermanentadds'] . "</td>";
            }
            if(isset($this->jsondata['pdolcccategorydetails']) && $this->jsondata['pdolcccategorydetails'] == 'yes' ){
                $rowcountArr['pdocateg'] = $datacount;
                $proserflag = true;
                $pdolcccatvalue = "<table border = '1'>";
                $pdolcccatvalue .= "<td>" .  (!empty($row[$i]['categoryname']) ? $pdocategorylist[$row[$i]['categoryname']] : "-") ."</td>";
                $pdolcccatvalue .= "<td>" . (!empty($row[$i]['yearofexp']) ? $row[$i]['yearofexp'] : "-") ."</td>";
                $pdolcccatvalue .= "<td>" . (!empty($row[$i]['contractvalue']) ? 'OMR ' . $row[$i]['contractvalue'] : "-") ."</td>";
                $pdolcccatvalue .= "</tr>";
                $pdolcccatvalue .= "</table>";    
                $value .= "<td>". $pdolcccatvalue. "</td>";
            }
            if(isset($this->jsondata['ccedlcc']) && $this->jsondata['ccedlcc'] == 'yes' ){
                $value .= "<td valing='top'>" . (!empty($row[$i]['ccedapprovedon']) ? date("d-m-Y", strtotime($row[$i]['ccedapprovedon'])) : "-") . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['ccedblock'] . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['ccedwillayat']) ? $wilayatnames[$row[$i]['ccedwillayat']] : "-")  . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['ccedvillage']) ? $villagenames[$row[$i]['ccedvillage']] : "-") . "</td>";
            }
            if(isset($this->jsondata['oxylcc']) && $this->jsondata['oxylcc'] == 'yes' ){              
                $value .= "<td valing='top'>" . (!empty($row[$i]['oxyapprovedon']) ? date("d-m-Y", strtotime($row[$i]['oxyapprovedon'])) : "-") . "</td>";
                $value .= "<td valing='top'>" . $row[$i]['oxyblock'] . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['oxywillayat']) ? $wilayatnames[$row[$i]['oxywillayat']] : "-") . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['oxyvillage']) ? $villagenames[$row[$i]['oxyvillage']] : "-") . "</td>";
            }
            if(isset($this->jsondata['drpiclcc']) && $this->jsondata['drpiclcc'] == 'yes' ){
                $value .= "<td valing='top'>" . (!empty($row[$i]['duqumapprovedon']) ? date("d-m-Y", strtotime($row[$i]['duqumapprovedon'])) : "-") . "</td>";
                $value .= "<td valing='top'>" . (!empty($row[$i]['duqumwillayat']) ? $wilayatnames[$row[$i]['duqumwillayat']] : "-") . "</td>";
            }
             if(isset($this->jsondata['omanisationpercentageasperjsrs']) && $this->jsondata['omanisationpercentageasperjsrs'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['omaizationpercntage'] . "</td>";
             }
             if(isset($this->jsondata['jsrsname']) && $this->jsondata['jsrsname'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['jsrsName'] . "</td>";
             }
             if(isset($this->jsondata['jsrsemail']) && $this->jsondata['jsrsemail'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['jsrsemailid'] . "</td>";
             }
             if(isset($this->jsondata['jsrsphone']) && $this->jsondata['jsrsphone'] == 'yes' ){
                if(!empty($row[$i]['jsrslandline']) && !empty($row[$i]['jsrslandlinecc'])){
                    $jsrslandline = $countrydialcode[$row[$i]['jsrslandlinecc']] . ' ' . $row[$i]['jsrslandline'];
                }elseif(!empty($row[$i]['jsrslandline']) && empty($row[$i]['jsrslandlinecc'])){
                    $jsrslandline = $row[$i]['jsrslandline'];
                }else{
                    $jsrslandline = "-";
                }
                $value .= "<td valing='top'>" . $jsrslandline . "</td>";
             }
             if(isset($this->jsondata['jsrsmobile']) && $this->jsondata['jsrsmobile'] == 'yes' ){
                if(!empty($row[$i]['jsrsmobile']) && !empty($row[$i]['jsrscc'])){
                    $jsrsmobile = $countrydialcode[$row[$i]['jsrscc']] . ' ' . $row[$i]['jsrsmobile'];
                }elseif(!empty($row[$i]['jsrsmobile']) && empty($row[$i]['jsrscc'])){
                    $jsrsmobile = $row[$i]['jsrsmobile'];
                }else{
                    $jsrsmobile = "-";
                }
                $value .= "<td valing='top'>" . $jsrsmobile . "</td>";
             }            
             if(isset($this->jsondata['primaryname']) && $this->jsondata['primaryname'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['primaryName'] . "</td>";
             }
             if(isset($this->jsondata['primaryemail']) && $this->jsondata['primaryemail'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['primaryemailid'] . "</td>";
             }
             if(isset($this->jsondata['primaryphone']) && $this->jsondata['primaryphone'] == 'yes' ){
                 if(!empty($row[$i]['primarylandline']) && !empty($row[$i]['landlinecc'])){
                    $primarylandline = $countrydialcode[$row[$i]['landlinecc']] . ' ' . $row[$i]['primarylandline'];
                }elseif(!empty($row[$i]['primarylandline']) && empty($row[$i]['landlinecc'])){
                    $primarylandline = $row[$i]['primarylandline'];
                }else{
                    $primarylandline = "-";
                }
                $value .= "<td valing='top'>" . $primarylandline . "</td>";
             }
             if(isset($this->jsondata['primarymobile']) && $this->jsondata['primarymobile'] == 'yes' ){
                 if(!empty($row[$i]['primarymobile']) && !empty($row[$i]['primarycc'])){
                    $primarymobile = $countrydialcode[$row[$i]['primarycc']] . ' ' . $row[$i]['primarymobile'];
                }elseif(!empty($row[$i]['primarymobile']) && empty($row[$i]['primarycc'])){
                    $primarymobile = $row[$i]['primarymobile'];
                }else{
                    $primarymobile = "-";
                }
                $value .= "<td valing='top'>" . $primarymobile . "</td>";
             }
             if(isset($this->jsondata['incorporatestyle']) && $this->jsondata['incorporatestyle'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['incorpstyle'] . "</td>";
             }
             if(isset($this->jsondata['classification']) && $this->jsondata['classification'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['classiciation'] . "</td>";
             }
             if(isset($this->jsondata['establishmentyear']) && $this->jsondata['establishmentyear'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['establismentyr'] . "</td>";
             }
             if(isset($this->jsondata['commercialregistrationno']) && $this->jsondata['commercialregistrationno'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['commercialnumb'] . "</td>";
             }
             if(isset($this->jsondata['commercialregistrationexpiry']) && $this->jsondata['commercialregistrationexpiry'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['commercialexpiredate'] . "</td>";
             }
             if(isset($this->jsondata['chamberofcommercecertificateno']) && $this->jsondata['chamberofcommercecertificateno'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['chambernumber'] . "</td>";
             }
             if(isset($this->jsondata['chamberofcommercecertificateexpiry']) && $this->jsondata['chamberofcommercecertificateexpiry'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['chamberexpiredate'] . "</td>";
             }
             if(isset($this->jsondata['officeaddress']) && $this->jsondata['officeaddress'] == 'yes' ){
                if(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && !empty($row[$i]['officeaddstate']) && !empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']] .  ' '. $statenames[$row[$i]['officeaddstate']] . ' ' . $citynames[$row[$i]['officeaddcity']];
                }elseif(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && !empty($row[$i]['officeaddstate']) && empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']] .  ' '. $statenames[$row[$i]['officeaddstate']];
                }elseif(!empty($row[$i]['officeaddress']) && !empty($row[$i]['officeaddcountry']) && empty($row[$i]['officeaddstate']) && empty($row[$i]['officeaddcity'])){
                    $officeadds =  $row[$i]['officeaddress'] . ' ' . $countrynames[$row[$i]['officeaddcountry']];
                }else{
                    $officeadds = "-";
                }
                $value .= "<td valing='top'>" . $officeadds."</td>";
             }
             if(isset($this->jsondata['postaladdress']) && $this->jsondata['postaladdress'] == 'yes' ){
                if(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && !empty($row[$i]['postalstate']) && !empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']] .  ' '. $statenames[$row[$i]['postalstate']] . ' ' . $citynames[$row[$i]['postalcity']];
               }elseif(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && !empty($row[$i]['postalstate']) && empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']] .  ' '. $statenames[$row[$i]['postalstate']];
               }elseif(!empty($row[$i]['postaladdress']) && !empty($row[$i]['postalcountyfk']) && empty($row[$i]['postalstate']) && empty($row[$i]['postalcity'])){
                   $postaladds =  $row[$i]['postaladdress'] . ' ' . $countrynames[$row[$i]['postalcountyfk']];
               }else{
                   $postaladds = "-";
               }
               $value .= "<td valing='top'>" . $postaladds . "</td>";
           }
           if(isset($this->jsondata['orgin']) && $this->jsondata['orgin'] == 'yes' ){
            $value .= "<td valing='top'>" . $row[$i]['origin'] . "</td>";
           }
           if(isset($this->jsondata['country']) && $this->jsondata['country'] == 'yes' ){
                $value .= "<td valing='top'>" . (!empty($row[$i]['officeaddcountry']) ? $countrynames[$row[$i]['officeaddcountry']] : "-") . "</td>";
           }
           if(isset($this->jsondata['phoneno']) && $this->jsondata['phoneno'] == 'yes' ){
                if(!empty($row[$i]['companylandline']) && !empty($row[$i]['companylandlinecc'])){
                    $complandline = $countrydialcode[$row[$i]['companylandlinecc']] . ' ' . $row[$i]['companylandline'];
                }elseif(!empty($row[$i]['companylandline']) && empty($row[$i]['companylandlinecc'])){
                    $complandline = $row[$i]['companylandline'];
                }else{
                    $complandline = "-";
                }
                $value .= "<td valing='top'>" . $complandline . "</td>";
           }
//            $value .= "<td valing='top'>-</td>";
           if(isset($this->jsondata['companywebsite']) && $this->jsondata['companywebsite'] == 'yes' ){
                $value .= "<td valing='top'>" . $row[$i]['compwebsite'] . "</td>";
           }
           if(isset($this->jsondata['companyemail']) && $this->jsondata['companyemail'] == 'yes' ){
            $value .= "<td valing='top'>" . $row[$i]['compemail'] . "</td>";
           }
           if(isset($this->jsondata['division']) && $this->jsondata['division'] == 'yes' ){
                $proserflag = true;
                $rowcountArr['division'] = $datacount;
                $divisionsectorvalue = "<table border = '1'>";
                $divisionsectorvalue .= "<tr>";
                $divisionsectorvalue .= "<td>" . (!empty($row[$i]['division']) ? $row[$i]['division'] : "-") ."</td>";
                $divisionsectorvalue .= "<td>" . (!empty($row[$i]['sector']) ? $row[$i]['sector'] : "-") ."</td>";
                $divisionsectorvalue .= "</tr>";
                $divisionsectorvalue .= "</table>";     
                $value .= "<td>". $divisionsectorvalue. "</td>";
           }
           if(isset($this->jsondata['omanisationpercentageasperministry']) && $this->jsondata['omanisationpercentageasperministry'] == 'yes' ){
                $momvalue = "<table border = '1'>";
                $momvalue .= "<tr>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['specialistexpats']) ?$row[$i]['specialistexpats']:"-")  . "</td>
                 <td>" .  (!empty($row[$i]['specialistomani']) ?$row[$i]['specialistomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totalspecialist']) ?$row[$i]['totalspecialist']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['techexpats']) ?$row[$i]['techexpats']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['techomani']) ?$row[$i]['techomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totaltech']) ?$row[$i]['totaltech']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['occupantexpat']) ?$row[$i]['occupantexpat']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['occupantomani']) ?$row[$i]['occupantomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totaloccupant']) ?$row[$i]['totaloccupant']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['skilledexpat']) ?$row[$i]['skilledexpat']:"-")  . "</td>
                <td>" .  (!empty($row[$i]['skilledomani']) ?$row[$i]['skilledomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totalskilled']) ?$row[$i]['totalskilled']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td><table border = '1'><tr><td>" .  (!empty($row[$i]['lowskilledexpat']) ?$row[$i]['lowskilledexpat']:"-")  . "</td>
                 <td>" .  (!empty($row[$i]['lowskilledomani']) ?$row[$i]['lowskilledomani']:"-")  . "</td><td>" .  (!empty($row[$i]['totallowskilled']) ?$row[$i]['totallowskilled']:"-")  . "</td></tr></table></td>";
                $momvalue .= "<td>" .  (!empty($row[$i]['percentage']) ?$row[$i]['percentage'] . '%' :"-")  . "</td>";
                $momvalue .= "<td>" . (!empty($row[$i]['totalomani']) ?$row[$i]['totalomani']:"-") . "</td>";
                $momvalue .=  "<td>" . (!empty($row[$i]['totalexpat']) ?$row[$i]['totalexpat']:"-") . "</td>";
                $momvalue .= "</tr>";
                $momvalue .= "</table>";
                $value .= "<td>". $momvalue. "</td>";
           }
           if(isset($this->jsondata['shareholdersinformation']) && $this->jsondata['shareholdersinformation'] == 'yes' ){
                $proserflag = true;
                $rowcountArr['shareholder'] = $datacount;                    
                $shrecnt = (!empty($row[$i]['totalshareholder']) ? $row[$i]['totalshareholder'] : 0);
                $shareholdervalue = "<table border = '1'>";
                $shareholdervalue .= "<tr>";
                $shareholdervalue .= "<td>" . $shrecnt ."</td>";
                $shareholdervalue .= "<td>" .  (!empty($row[$i]['type']) ? $row[$i]['type'] : "-") ."</td>";
                $shareholdervalue .= "<td>" . (!empty($row[$i]['name']) ? $row[$i]['name'] : "-") ."</td>";
                $shareholdervalue .= "<td>" . (!empty($row[$i]['idnumber']) ? $row[$i]['idnumber'] : "-") ."</td>";
                $shareholdervalue .= "<td>" . (!empty($row[$i]['countryval']) ? $countrynames[$row[$i]['countryval']] : "-") ."</td>";
                $shareholdervalue .= "<td>" . (!empty($row[$i]['percenatge']) ? $row[$i]['percenatge'] : "-") ."</td>";
                $shareholdervalue .= "</tr>";
                $shareholdervalue .= "</table>";     
                $value .= "<td>". $shareholdervalue. "</td>";
           }
           if(isset($this->jsondata['products']) && $this->jsondata['products'] == 'yes'){   
                $proserflag = true;
                $rowcountArr['product'] = $datacount;  
                $productvalue = "<table border = '1'>";
                $productvalue .= "<tr>";
                if(isset($this->jsondata['jsrsproductstatus']) && $this->jsondata['jsrsproductstatus'] == 'yes'){ 
                     $productvalue .= "<td>" . (!empty($row[$i]['productStatus']) ? $row[$i]['productStatus'] : "-") . "</td>";
                }
                if(isset($this->jsondata['pgroupcategory']) && $this->jsondata['pgroupcategory'] == 'yes'){   
                    $productvalue .= "<td>" . (!empty($row[$i]['groupcategory']) ? $row[$i]['groupcategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['pmaincategory']) && $this->jsondata['pmaincategory'] == 'yes'){   
                    $productvalue .= "<td>" . (!empty($row[$i]['maincategory']) ? $row[$i]['maincategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['psubcategory']) && $this->jsondata['psubcategory'] == 'yes'){   
                    $productvalue .= "<td>" . (!empty($row[$i]['subcategory']) ? $row[$i]['subcategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['jsrscategorycodeproduct']) && $this->jsondata['jsrscategorycodeproduct'] == 'yes'){ 
                    $productvalue .= "<td>" . (!empty($row[$i]['categorycode']) ? $row[$i]['categorycode'] : "-") . "</td>";
                }
                if(isset($this->jsondata['pdisplayname']) && $this->jsondata['pdisplayname'] == 'yes'){  
                    $productvalue .= "<td>" . (!empty($row[$i]['displayName']) ? $row[$i]['displayName'] : "-") . "</td>";
                }
                if(isset($this->jsondata['pbusinesssource']) && $this->jsondata['pbusinesssource'] == 'yes'){   
                    $businessdet = $row[$i]['businessSource'];
                    if(!empty($businessdet)){
                        $businessvalue .=  "<table border = '1'>";
                        $businesssrc = explode(",",$businessdet);
                        foreach ($businesssrc as $bvalue) {
                            $businessvalue .= "<tr>";
                            $businessvalue .= "<td>" . (!empty($bvalue) ? $bvalue : "-") ."</td>";
                            $businessvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $businessvalue .= "</table>";
                    }else{
                        $businessvalue = "-";
                    }
                    $productvalue .=  "<td>". $businessvalue. "</td>";   
                }
                if(isset($this->jsondata['pdivisionproduct']) && $this->jsondata['pdivisionproduct'] == 'yes'){   
                    $divisiondet = $row[$i]['pdivision'];
                    if(!empty($divisiondet)){
                        $divisionvalue .=  "<table border = '1'>";
                        $divipart = explode(",",$divisiondet);
                        foreach ($divipart as $dvalue) {
                            $divisionvalue .= "<tr>";
                            $divisionvalue .= "<td>" . (!empty($dvalue) ? $dvalue : "-") ."</td>";
                            $divisionvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $divisionvalue .= "</table>";
                    }else{
                        $divisionvalue = "-";
                    }
                    $productvalue .= "<td>". $divisionvalue. "</td>";   
                }
                if(isset($this->jsondata['psectorproduct']) && $this->jsondata['psectorproduct'] == 'yes'){  
                    $sectordet = $row[$i]['psector'];
                    if(!empty($sectordet)){
                        $sectorvalue .=  "<table border = '1'>";
                        $sectorpart = explode(",",$sectordet);
                        foreach ($sectorpart as $svalue) {
                            $sectorvalue .= "<tr>";
                            $sectorvalue .= "<td>" . (!empty($svalue) ? $svalue : "-") ."</td>";
                            $sectorvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $sectorvalue .= "</table>";
                    }else{
                        $sectorvalue = "-";
                    }
                    $productvalue .= "<td>". $sectorvalue. "</td>";   
                }
                if(isset($this->jsondata['pactivities']) && $this->jsondata['pactivities'] == 'yes'){   
                    $activitydet = $row[$i]['pactivity'];
                    if(!empty($activitydet)){
                        $activityvalue .=  "<table border = '1'>";
                        $activitypart = explode(",",$activitydet);
                        foreach ($activitypart as $avalue) {
                            $activityvalue .= "<tr>";
                            $activityvalue .= "<td>" . (!empty($avalue) ? $avalue : "-") ."</td>";
                            $activityvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $activityvalue .= "</table>";
                    }else{
                        $activityvalue = "-";
                    }
                    $productvalue .= "<td>". $activityvalue. "</td>";   
                }  
                $productvalue .= "</tr>";
                $productvalue .= "</table>";  
                $value .= "<td>". $productvalue. "</td>";   
           }
           if(isset($this->jsondata['services']) && $this->jsondata['services'] == 'yes'){   
                $proserflag = true;
                $rowcountArr['services'] = $datacount;  
                $servicesdetails = "<table border = '1'>";
                $servicesdetails .= "<tr>";
                if(isset($this->jsondata['jsrsservicestatus']) && $this->jsondata['jsrsservicestatus'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['serviceStatus']) ? $row[$i]['serviceStatus'] : "-") . "</td>";
                }
                if(isset($this->jsondata['sgroupcategory']) && $this->jsondata['sgroupcategory'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['groupcategory']) ? $row[$i]['groupcategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['smaincategory']) && $this->jsondata['smaincategory'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['maincategory']) ? $row[$i]['maincategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['ssubcategory']) && $this->jsondata['ssubcategory'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['subcategory']) ? $row[$i]['subcategory'] : "-") . "</td>";
                }
                if(isset($this->jsondata['jsrscategorycodeservice']) && $this->jsondata['jsrscategorycodeservice'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['categorycode']) ? $row[$i]['categorycode'] : "-") . "</td>";
                }
                if(isset($this->jsondata['displaynameservice']) && $this->jsondata['displaynameservice'] == 'yes'){  
                    $servicesdetails .= "<td>" . (!empty($row[$i]['displayName']) ? $row[$i]['displayName'] : "-") . "</td>";
                }
                if(isset($this->jsondata['businesssourceservice']) && $this->jsondata['businesssourceservice'] == 'yes'){  
                    $businessdet = $row[$i]['businessSource'];
                    if(!empty($businessdet)){
                        $businessvalue .=  "<table border = '1'>";
                        $businesssrc = explode(",",$businessdet);
                        foreach ($businesssrc as $bvalue) {
                            $businessvalue .= "<tr>";
                            $businessvalue .= "<td>" . (!empty($bvalue) ? $bvalue : "-") ."</td>";
                            $businessvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $businessvalue .= "</table>";
                    }else{
                        $businessvalue = "-";
                    }
                    $servicesdetails .= "<td>". $businessvalue. "</td>";   
                }
                if(isset($this->jsondata['divisionservice']) && $this->jsondata['divisionservice'] == 'yes'){  
                    $divisiondet = $row[$i]['sdivision'];
                    if(!empty($divisiondet)){
                        $divisionvalue .=  "<table border = '1'>";
                        $divipart = explode(",",$divisiondet);
                        foreach ($divipart as $dvalue) {
                            $divisionvalue .= "<tr>";
                            $divisionvalue .= "<td>" . (!empty($dvalue) ? $dvalue : "-") ."</td>";
                            $divisionvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $divisionvalue .= "</table>";
                    }else{
                        $divisionvalue = "-";
                    }
                    $servicesdetails .= "<td>". $divisionvalue. "</td>";  
                }
                if(isset($this->jsondata['sectorservice']) && $this->jsondata['sectorservice'] == 'yes'){  
                    $sectordet = $row[$i]['ssector'];
                    if(!empty($sectordet)){
                        $sectorvalue .=  "<table border = '1'>";
                        $sectorpart = explode(",",$sectordet);
                        foreach ($sectorpart as $svalue) {
                            $sectorvalue .= "<tr>";
                            $sectorvalue .= "<td>" . (!empty($svalue) ? $svalue : "-") ."</td>";
                            $sectorvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $sectorvalue .= "</table>";
                    }else{
                        $sectorvalue = "-";
                    }
                    $servicesdetails .= "<td>". $sectorvalue. "</td>";   
                }
                if(isset($this->jsondata['activitiesservice']) && $this->jsondata['activitiesservice'] == 'yes'){  
                    $activitydet = $row[$i]['sactivity'];
                    if(!empty($activitydet)){
                        $activityvalue .=  "<table border = '1'>";
                        $activitypart = explode(",",$activitydet);
                        foreach ($activitypart as $avalue) {
                            $activityvalue .= "<tr>";
                            $activityvalue .= "<td>" . (!empty($avalue) ? $avalue : "-") ."</td>";
                            $activityvalue .= "</tr>";
                            $rowcnt++;
                        }
                        $activityvalue .= "</table>";
                    }else{
                        $activityvalue = "-";
                    }
                    $servicesdetails .= "<td>". $activityvalue. "</td>";   
                }
                $servicesdetails .= "</tr>";
                $servicesdetails .= "</table>";  
                $value .= "<td>". $servicesdetails. "</td>";   
           }
            $value .= "</tr>";
            if($proserflag){               
                if(!empty($rowcountArr)){        
                    if($rowcnt > $exportLimit){
                        $masterdatatable[]=$value;
                        $this->masterdatatable = $masterdatatable;  
                        $value=$totRowCnt='';
                        $rowcnt=0;
                    }
                 }
            }
            $rowcnt++;
            $slno++;
        }
        $masterdatatable[]=$value;
        $this->masterdatatable=$masterdatatable;
        if(!$proserflag){            
            $value .= "</table>";
            $data .= trim($this->tableHeader.$value) . "\n";
        }else{
            if(empty($masterdatatable)){
                $masterdatatable[]=$value; 
                $this->masterdatatable=$masterdatatable;
            }         
        }   
        $this->tableContent=$value;
        return $this->tableContent; 
    }
    public function createZip(){
        $value .= "</table>";  
        $data .= trim($this->header.$this->tableHeader.$this->tableContent.$value) . "\n";
        if (((isset($this->jsondata['products']) && $this->jsondata['prdcnt']>0)) || ((isset($this->jsondata['services']) && $this->jsondata['sercnt']>0)) || (isset($this->jsondata['shareholdersinformation']) || isset($this->jsondata['division']) || isset($this->jsondata['pdolcccategorydetails']))) {
            $proserflag=true;        
        }
        $masterDataTable = $this->masterdatatable;       
        if((!empty($data) && !empty($this->filename)) || $proserflag){            
            $filename=$this->filename;
            $filename1=$this->filename1;
            $folder=$this->foldername;
            if(!is_dir($folder))
                mkdir($folder, 0777, true);
            if (extension_loaded('zip')){
                $zip = new \ZipArchive();
                if ($zip->open($folder.$filename.".zip", \ZipArchive::CREATE) !== TRUE)
                    $error = "* Sorry ZIP creation failed at this time<br/>";

                if (!empty($masterDataTable)) {                    
                    foreach ($masterDataTable as $key => $table){                      
                        $zip->addFromString($filename1.'_'.($key+1).'.xls', trim($this->header.$this->tableHeader . $table . "</table><style>.text{mso-number-format:\"\@\";}</style>"));
                    }
                }
                else { 
                    $data = $data . '<style>.text{mso-number-format:\"\@\";}</style>';
                    $zip->addFromString($filename1 . '.xls', $data);
                }
                $zip->close(); 
                $exportedstatus = '1';
                $this->Requestdata['osbsdt_exptstatus'] = $exportedstatus;
                $this->Requestdata->save();
            }
        }
    }
    public function getproductquery($compk){
        $sql = "
                SELECT * FROM
                ((SELECT 
                `MemCompProdDtls_Pk` AS `pdtPk`,
                `MCPrD_DisplayName` AS `displayName`,
                'Not Approved' AS `productStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `division`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `sector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `activity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicpm_productname AS `subcategory`,
                concat(PrdM_ProductCode, ' - ', PrdM_ProductName) AS `categorycode`
                FROM
                `memcompproddtls_tbl` `mcprd`
                LEFT JOIN `memcompproddtlsmain_tbl` `mcprdm` ON MemCompProdDtls_Pk = mcprdm_memcompproddtls_fk
                LEFT JOIN `productmst_tbl` `pm` ON pm.ProductMst_Pk = mcprd.MCPrD_ProductMst_Fk
                LEFT JOIN `bgiinduscodeprodmst_tbl` ON mcprd_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk
                LEFT JOIN `bgiindcodesubcateg_tbl` ON mcprd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
                LEFT JOIN `bgiindcodecateg_tbl` ON mcprd_bgiindcodecateg_fk = bgiindcodecateg_pk
                LEFT JOIN `memcompprodbussrcmap_tbl` `mcpbsm` ON mcprd.MemCompProdDtls_Pk = mcpbsm_memcompproddtls_fk
                LEFT JOIN `memcompbussrcdtls_tbl` `mcb` ON mcpbsm.mcpbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk
                LEFT JOIN `businesssourcemst_tbl` `bsm` ON bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk
                LEFT JOIN `memcompsectordtls_tbl`  ON mcb.mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk
                LEFT JOIN `memcompbussrcsectormap_tbl`  ON mcb.memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk
                LEFT JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                LEFT JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                LEFT JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
                WHERE (`MCPrD_MemberCompMst_Fk` = {$compk})
                GROUP BY `MemCompProdDtls_Pk`) UNION ALL (SELECT 
                `mcprdm_memcompproddtls_fk` AS `pdtPk`,
                `mcprdm_displayname` AS `displayName`,
                'Approved' AS `productStatus`,
                GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
                GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `division`,
                GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `sector`,
                GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `activity`,
                bicc_categoryname AS `groupcategory`,
                bicsc_subcategoryname AS `maincategory`, 
                bicpm_productname AS `subcategory`,
                concat(PrdM_ProductCode, ' - ', PrdM_ProductName) AS `categorycode`
                FROM
                `memcompproddtlsmain_tbl` `mcprdm`
                INNER JOIN `ProductMst_tbl` `pm` ON productmst_pk = mcprdm_productmst_fk
                INNER JOIN `bgiinduscodeprodmst_tbl` ON mcprdm_bgiinduscodeprodmst_fk = bgiinduscodeprodmst_pk
                INNER JOIN `bgiindcodesubcateg_tbl` ON mcprdm_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
                INNER JOIN `bgiindcodecateg_tbl` ON mcprdm_bgiindcodecateg_fk = bgiindcodecateg_pk
                INNER JOIN `memcompprodbussrcmapmain_tbl` `mcpbsm` ON mcprdm_memcompproddtls_fk = mcpbsmm_memcompproddtls_fk
                INNER JOIN `memcompbussrcdtlsmain_tbl` `mcb` ON mcpbsm.mcpbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk
                INNER JOIN `businesssourcemst_tbl` `bsm` ON mcbsdm_businesssourcemst_fk = businesssourcemst_pk
                INNER JOIN `memcompsectordtls_tbl`  ON mcb.mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk
                INNER JOIN `memcompbussrcsectormap_tbl`  ON mcb.mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk
                INNER JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
                INNER JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
                INNER JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
                WHERE
                (`mcprdm_membercompmst_fk` = {$compk})
                GROUP BY `mcprdm_memcompproddtls_fk`)) `produnion`
                ORDER BY `displayName` ";
        $productquery = Yii::$app->db->createCommand($sql)->queryAll();
       return $productquery;
    }
    public function getservicesquery($compk){
        $sql = "
             SELECT *
            FROM
            ((SELECT 
            `MemCompServDtls_Pk` AS `servicePk`,
            `MCSvD_DisplayName` AS `displayName`,
            'Not Approved' AS `serviceStatus`,
            GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
            GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `division`,
            GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `sector`,
            GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `activity`,
            bicc_categoryname AS `groupcategory`,
            bicsc_subcategoryname AS `maincategory`, 
            bicsm_servicename AS `subcategory`,
            concat(SrvM_ServiceCode, ' - ', SrvM_ServiceName) AS `categorycode`
            FROM `memcompservicedtls_tbl` `mcsvd` 
            LEFT JOIN `memcompservicedtlsmain_tbl` `mcsvdm` ON MemCompServDtls_Pk = mcsvdm_memcompservdtls_fk 
            LEFT JOIN `servicemst_tbl` `sm` ON sm.ServiceMst_Pk = mcsvd.MCSvD_ServiceMst_Fk 	
            LEFT JOIN `bgiinduscodeservmst_tbl` ON mcsvd_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk
            LEFT JOIN `bgiindcodesubcateg_tbl` ON mcsvd_bgiindcodesubcateg_fk = bgiindcodesubcateg_pk
            LEFT JOIN `bgiindcodecateg_tbl` ON mcsvd_bgiindcodecateg_fk = bgiindcodecateg_pk
            LEFT JOIN `memcompservbussrcmap_tbl` `mcpbsm` ON mcsvd.MemCompServDtls_Pk = mcsbsm_memcompservdtls_fk
            LEFT JOIN `memcompbussrcdtls_tbl` `mcb` ON mcpbsm.mcsbsm_memcompbussrcdtls_fk = mcb.memcompbussrcdtls_pk	
            LEFT JOIN `businesssourcemst_tbl` `bsm` ON bsm.businesssourcemst_pk = mcb.mcbsd_businesssourcemst_fk
            LEFT JOIN `memcompsectordtls_tbl`  ON mcb.mcbsd_memcompsecdtls_fk = MemCompSecDtls_Pk
            LEFT JOIN `memcompbussrcsectormap_tbl`  ON mcb.memcompbussrcdtls_pk = mcbssm_memcompbussrcdtls_fk
            LEFT JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
            LEFT JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
            LEFT JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk	
            WHERE (`MCSvD_MemberCompMst_Fk` = {$compk})
            GROUP BY `MemCompServDtls_Pk`) UNION ALL (SELECT 
            `mcsvdm_memcompservdtls_fk` AS `servicePk`,
            `mcsvdm_displayname` AS `displayName`,
            'Approved' AS `serviceStatus`,
            GROUP_CONCAT(DISTINCT bsm.bsm_bussrcname) AS `businessSource`,
            GROUP_CONCAT(DISTINCT mcsd_businessunitrefname separator ', ') AS `division`,
            GROUP_CONCAT(DISTINCT SecM_SectorName separator ', ') AS `sector`,
            GROUP_CONCAT(DISTINCT ActM_ActivityName) AS `activity`,
            bicc_categoryname AS `groupcategory`,
            bicsc_subcategoryname AS `maincategory`, 
            bicsm_servicename AS `subcategory`,
            concat(SrvM_ServiceCode, ' - ', SrvM_ServiceName) AS `categorycode`
            FROM
            `memcompservicedtlsmain_tbl` `mcsvdm` 
            INNER JOIN `servicemst_tbl` `sm` ON sm.ServiceMst_Pk = mcsvdm_servicemst_fk
            INNER JOIN `bgiinduscodeservmst_tbl` ON mcsvdm_bgiinduscodeservmst_fk = bgiinduscodeservmst_pk
            INNER JOIN `bgiindcodesubcateg_tbl` ON mcsvdm_bgiindcodesubcateg_fk  = bgiindcodesubcateg_pk
            INNER JOIN `bgiindcodecateg_tbl` ON mcsvdm_bgiindcodecateg_fk = bgiindcodecateg_pk
            INNER JOIN `memcompservbussrcmapmain_tbl` `mcpbsm` ON mcsvdm_memcompservdtls_fk = mcsbsmm_memcompservdtls_fk
            INNER JOIN `memcompbussrcdtlsmain_tbl` `mcb` ON mcpbsm.mcsbsmm_memcompbussrcdtls_fk = mcbsdm_memcompbussrcdtls_fk	
            INNER JOIN `businesssourcemst_tbl` `bsm` ON mcb.mcbsdm_businesssourcemst_fk = businesssourcemst_pk
            INNER JOIN `memcompsectordtls_tbl`  ON mcb.mcbsdm_memcompsecdtls_fk = MemCompSecDtls_Pk
            INNER JOIN `memcompbussrcsectormap_tbl`  ON mcb.mcbsdm_memcompbussrcdtls_fk = mcbssm_memcompbussrcdtls_fk
            INNER JOIN `sectormst_tbl`  ON mcbssm_sectormst_fk = SectorMst_Pk
            INNER JOIN `memcompbussrcactivity_tbl` ON mcbsa_memcompbussrcsectormap_fk = memcompbussrcsectormap_pk
            INNER JOIN `activitiesmst_tbl` ON mcbsa_activitiesmst_fk = ActivitiesMst_Pk
            WHERE (`mcsvdm_membercompmst_fk` = {$compk})
            GROUP BY `mcsvdm_memcompservdtls_fk`)) `produnion`
            ORDER BY `displayName`";
        $servicesquery = Yii::$app->db->createCommand($sql)->queryAll();
       return $servicesquery;
    }
}