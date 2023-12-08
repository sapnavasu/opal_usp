<?php

namespace api\modules\sv\controllers;

use api\modules\mst\controllers\MasterController;
use common\models\UsermstTbl;
use Yii;
use common\components\GeneralFunctions;
use app\filters\auth\HttpBearerAuth;
//use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\HttpException;

use yii\web\Response;
use app\modules\nbf\models\MemcompprofcertfdtlsTbl;
use api\modules\pm\controllers\NbfMasterController;
use \common\models\MembercompanymstTbl;
use \common\models\MemcompsitevisitTbl;
use \common\models\SectormstTbl;
use \common\components\Security;
use common\components\Drive;
use \common\components\Common;
use yii\rest\ActiveController;
use \yii\data\ActiveDataProvider;
use \yii\db\ActiveQuery;



/**
 * Svisitmobile controller for the `sv` module
 */
class SvisitmobileController extends MasterController
{  

    public $modelClass = '\common\models\MemcompsitevisitTbl.php';
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {       
        return $this->render('index');
        //echo "working";exit;

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


    /*
    * Site visit logic starts here
    */
    public function actionAddcomments(){
      $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
      $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
       $stk_type = \yii\db\ActiveRecord::getTokenData('reg_type',true);
       
       if(empty($_REQUEST['skipcommt']) && isset($_REQUEST['skipcommt']) && in_array($_REQUEST['apiFor'],['and','ios'])){
        $rdata= ['status'=>0,'msg'=>'Please Enter Reason'];   
        echo json_encode($rdata);
        exit;
       }
    if(isset($cmpPk) && is_numeric($cmpPk)){
    $mcvsdata['skipreason'] = $_REQUEST['skipcommt'];
    $mcvsdata['status'] = 7;
    $rData = \common\models\MemcompsitevisitTbl::saveData($mcvsdata,$cmpPk);
     }else{
    $rdata= ['status'=>0,'msg'=>'Company ID missing'];   
    echo json_encode($rdata);
     exit;
    }
    echo json_encode($rData);
    exit;
       
    }

    public function actionSitevisitimagesave()
    {     
        $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
         $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);  
        $ipaddress= \common\components\Common::getIpAddress();
        Yii::$app->controllerNamespace ='api\modules\drv\controllers';
        $uplres = Yii::$app->runaction('drive/uploadmultiplimg');  
          //$images_res = \common\models\MemcompfiledtlsTbl::find();
            $images_res=Yii::$app->db->createCommand("select `memcompfiledtls_pk` FROM `memcompfiledtls_tbl` WHERE `mcfd_memcompmst_fk`= $cmpPk and `mcfd_uploadedby`= $userPk and `mcfd_filemst_fk`=235 and `mcfd_isdeleted`=0")->queryAll(); 
          for($i=2;$i<5;$i++)
            { 
            $images   .= ($images_res[$i]['memcompfiledtls_pk'].',');
            $memcfdpk = rtrim($images,',');
            $i+1;
            }
            $mcvsdata['signboardphoto'] = $images_res[0]['memcompfiledtls_pk'];
            $mcvsdata['workplacephoto'] = $images_res[1]['memcompfiledtls_pk'];
            $mcvsdata['additionalphoto'] = $memcfdpk;
            $mcvsdata['latitude'] = $_REQUEST['latitude'];
            $mcvsdata['longitude'] = $_REQUEST['longitude'];
            
            $filemst_res =\common\models\MemcompsitevisitTbl::saveData($mcvsdata,$cmpPk);
            echo json_encode($filemst_res);
        exit;
      }
    public function actionSvstatus()
    {  
         $cmpPk = yii\db\ActiveRecord::getTokenData('comp_pk',true);
         $userPk = yii\db\ActiveRecord::getTokenData('user_pk',true); 
         $usermodel = UsermstTbl::findOne($userPk); 
         $submit_by = $usermodel->um_firstname.$usermodel->um_lastname;
        
              $svstatus_res = Yii::$app->db->createCommand("select * FROM `memcompsitevisit_tbl` WHERE `mcsv_memcompmst_fk`= $cmpPk and `mcsv_createdby`=$userPk")->queryAll();
             
              $svstatus_update = Yii::$app->db->createCommand("select `mcsv_updatedon` FROM `memcompsitevisit_tbl` WHERE `mcsv_memcompmst_fk`= $cmpPk and `mcsv_createdby`=$userPk ")->queryAll();
              
              if(!empty($svstatus_update)){
              $updatedon = $svstatus_update[0]['mcsv_updatedon'];
              }
              
         //Staus 
         if(!empty($svstatus_res)){
        foreach( $svstatus_res as $val)
        { 
          $visitstatus = trim($val['mcsv_visitstatus']); 
          $createdon  = trim($val['mcsv_createdon']);
          $createdby  = trim($val['mcsv_createdby']);   
          $decrejon  = trim($val['mcsv_validatedon']);
          $decrejcmt  = trim($val['mcsv_validatedcmt']);
          $visitdate  = trim($val['mcsv_visitdate']);
          $siteinspector  = trim($val['mcsv_siteinspector']);
          $visitcomment  = trim($val['mcsv_visitcomment']);
          $updatedon  = trim($val['mcsv_updatedon']);
          $updatedby  = trim($val['mcsv_updatedby']);
          $reason = trim($val['mcsv_skipreason']);
        } 
        
         if($visitstatus == 1){
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Yet to Submit";
          }
          elseif($visitstatus == 3){
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Rejected";
            $msvstatus['dec_comments'] = $decrejcmt;
            $msvstatus['decl_date'] = $decrejon;
          }
          elseif($visitstatus == 8)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Physical Site Visit Scheduled";
            $msvstatus['dateofsv'] =  $visitdate;
            $msvstatus['sinspname'] =  $siteinspector;
            $msvstatus['comments'] =  $visitcomment;
              }
           elseif($visitstatus == 9)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Physical Site Visit Re-Scheduled";
            $msvstatus['dateofsv'] =  $visitdate;
            $msvstatus['sinspname'] =  $siteinspector;
            $msvstatus['comments'] =  $visitcomment;
           }
          elseif($visitstatus == 4)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Declined";
            $msvstatus['dec_comments'] = $decrejcmt;
            $msvstatus['decl_date'] = $decrejon;
           }
           elseif($visitstatus == 5)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Posted for Validation";
            $msvstatus['submitedon'] =$createdon;
            $msvstatus['submitedby'] =$submit_by;
          }
          elseif(!empty($updatedon) && ($visitstatus == 7) )
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Undertaking Acknowledged";
            $msvstatus['resubmitedon'] =$updatedon;  
            $msvstatus['resubmitedby'] =$submit_by;
            $msvstatus['reason'] =$reason;
          }
          elseif(empty($updatedon) && $visitstatus == 7)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Undertaking Acknowledged";
            $msvstatus['submitedon'] =$createdon; //updatedon;
            $msvstatus['submitedby'] =$submit_by;
            $msvstatus['reason'] =$reason;
          }
          elseif($visitstatus == 6)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Posted for Validation";
            $msvstatus['resubmitedon'] =$updatedon;
            $msvstatus['resubmitedby'] =$submit_by;
          }
          elseif($visitstatus == 11)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Completed Site Visit";
           }
           elseif($visitstatus == 12)
          {
            $msvstatus['status'] = 1;
            $msvstatus['msg'] = "Yet to Schedule (Physical)";
            $msvstatus['dec_comments'] = $decrejcmt;
            $msvstatus['decl_date'] = $decrejon;
           }
        } 
        else if(empty($svstatus_res)){
          $msvstatus['status'] = 1;
          $msvstatus['msg'] = "Yet to Submit";
          }
         else{
         
            $msvstatus['status'] = 0;
            $msvstatus['msg'] = "Failure";
        }
         echo json_encode($msvstatus);
        exit;
      }

      public function actionSvshowimage()
      {
         $cmpPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
         $userPk = \yii\db\ActiveRecord::getTokenData('user_pk',true);  
        
       $svstatus_res = Yii::$app->db->createCommand("SELECT `mcsv_signboardphoto`,`mcsv_workplacephoto`,`mcsv_additionalphoto` FROM `memcompsitevisit_tbl` WHERE `mcsv_memcompmst_fk`= $cmpPk and `mcsv_createdby`= $userPk")->queryOne();
       if(!empty($svstatus_res)){
        
       //print_r($svstatus_res); echo '</pre>';
         $signboardphotoid =   $svstatus_res['mcsv_signboardphoto'] ;
        $workplacephotoid =   $svstatus_res['mcsv_workplacephoto'] ;
        if(!empty($svstatus_res['mcsv_additionalphoto'])){
         $det =explode(',',$svstatus_res['mcsv_additionalphoto']); 
        }
        
        $previmage ['signboardphoto'] = Drive::generateUrl($signboardphotoid,$cmpPk,$userPk);
        $previmage ['workplacephoto'] = Drive::generateUrl($workplacephotoid ,$cmpPk,$userPk);
        if(!empty($det[0]))
        $previmage ['additionalphoto1'] = Drive::generateUrl($det[0],$cmpPk,$userPk);
        if(!empty($det[1]))
        $previmage ['additionalphoto2'] = Drive::generateUrl($det[1],$cmpPk,$userPk);
        if(!empty($det[2]))
        $previmage['additionalphoto3'] = Drive::generateUrl($det[2],$cmpPk,$userPk);
        
        $previmage['status'] = 1;
        $previmage['msg'] = "success";
        }else{
        $previmage['status'] = 0;
        $previmage['msg'] = "No Image Found";
       }
         echo json_encode($previmage);
          exit;
      }


    public function actionDynamiccontent()
    { 
        if($_REQUEST['mode'] =='dark')
        {
        $ccolor = "color:#CCCCCC";
        $bcolor = "color:#6AA6D8";
        }else{
        $ccolor = "color:#333333";
        $bcolor = "color:#006DB7";
        }
 
        $baseUrl = \Yii::$app->params['APP_URL'];
         $listimgpath = stripslashes($baseUrl."frontend/web/assets/Lite-44.png");
        $page['sitevisit']['introtitle'] ='<h1 style="font-size:16px; font-family:calibri; text-align:left; font-weight:600px;'.$bcolor.'">Introduction</h1>';
        $page['sitevisit']['intromsg'] ='<div style="width:100%; float:left; font-size:15px; font-family:calibri; text-align:left; font-weight:400px;'.$ccolor.'; line-height:23px; margin:10px 0;">
		    <p style="width:100%; float:left;">In order to support the JSRS Community during the ongoing COVID-19 pandemic and ensure the continuity of the JSRS Supplier Certification process, businessgateways introduces the temporary Online Site Validation feature.</p>
        <p style="width:100%; float:left;">As part of your JSRS Certification process, you are requested by businessgateways to upload the Office Site photos of your company through this Mobile Application. Site photos need to be clicked from the actual site location. The Application will automatically Tag your Geographic Location to the image and you can submit the Images on this Mobile Application.</p></div>';
        $page['sitevisit']['sitevalidtitle'] = '<h1 style="font-size:16px; font-family:calibri; margin:15px 0 0; text-align:left; white-space: pre-wrap; font: weight 600px;; '.$bcolor.'"><span>1.0</span> Online Site Visit Validation Procedure</h1>';
        $page['sitevisit']['sitevalidmsg'] = '<div style="width:100%; float:left;font-size:15px; font-family:calibri; text-align:left; font-weight:400px; line-height:20px; margin:10px 0;">
            <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:15px;  padding:0 10px 0 23px; line-height:23px; font-family:calibri;'.$ccolor.';list-style-position: inside;list-style-type: none;">
                <li><img src="'.$listimgpath.'" width="20" height="20"> Read and Agree to the Physical Site Visit Declaration.</li>
                <li><img src="'.$listimgpath.'" width="20" height="20">Visit your office site and click the relevant Site Photos as per the categories given in the Application. You can skip this step if you are unable to visit the office and take photos.</li>
                <li><img src="'.$listimgpath.'" width="20" height="20"> Submit to proceed with JSRS Site Validation/Certification.</li>
                <li >Site Validation/Certification status will be notified to you via mail and on the JSRS Dashboard.</li>
              </ul>
         </div>';
        $page['sitevisit']['sitenote'] = '<h1 style="font-size:14px; font-family:calibri; margin:15px 0 0 20px; text-align:left; white-space: pre-wrap; font-weight:600px;color:#333333;">Notes:</h1>';
        $page['sitevisit']['sitenotemsg'] = '<div style="width:100%; float:left;font-size:13px; font-family:calibri; text-align:left; font-weight:300px;color:#6A6A6A; line-height:23px; margin:10px 0 0 15px;">
            <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0 10px 0 23px; line-height:23px; font-family:14px; ">
          <li>Physical Site Visit will be conducted after COVID-19 pandemic restrictions are lifted.</li> 
                <li>JSRS Certification is subject to the successful validation of documents submitted in  the system.</li>
                 </ul>
        </div>';
   $page['sitevisit']['sitephotochklst'] ='<h1 style="font-size:16px; font-family:calibri; margin:15px 0 0; text-align:left; white-space: pre-wrap; font-weight:600px; '.$bcolor.'">
        <span>1.1</span> Photos Checklist</h1>';
        $page['sitevisit']['sitephotochklstmsg'] ='<div style="width:100%; float:left; font-size:14px; font-family:calibri; text-align:left; font-weight:300px;'.$ccolor.'; line-height:23px; margin:10px 0;">
		    <p style="width:100%; float:left;">Upload the Office Site photos of your Company through businessgateways Mobile Application.Site photos need to be clicked from the actual site location. The Application will automatically Tag your Geographic Location to the image and you can submit the Images on this Mobile Application.</p>
        <p style="width:100%; margin:18px 0 0 10px;font-size:14px;font-weight:bold;color:#33333;">Photos of the site must align with the following criteria:</p>
        <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0 10px 0 25px; line-height:23px; font-family:14px;font-weight:300px;color:#6A6A6A; ">
        <li>Site photos need to be uploaded from the actual site location on this mobile application to proceed with the Online Site Validation process.</li> 
        <li>Only high-quality photos are accepted. Grainy photos/low-quality photos will be noted as invalid entries.</li>
        <li>Photos must be taken in natural light; dimly lit photos, or photos of the site at night are not valid entries. </li>
        <li>Photos must only depict the site; human interference/in dimly lit photos, traction on the photos will be noted as invalid entries.</li>
        <li>Photos of industrial activities (factory/infrastructure) in the site must be uploaded.</li>
        </ul>
        </div>';
        $page['sitevisit']['virtualtitle'] = '<h1 style="font-size:17px; font-family:calibri; margin:17px 0 0; text-align:left; font-weight:bold; '.$bcolor.';">Terms and Conditions</h1>';
        $page['sitevisit']['virtualsubhead'] = '<h1 style="font-size:16px; font-family:calibri; width:100%;float:left;font-weight:600px;'.$bcolor.';">Physical Site Visit Declaration</h1>';
        $page['sitevisit']['virtualmsg'] = '<div style="width:100%; float:left;font-family:calibri; text-align:left; font-weight:normal;'.$ccolor.'; line-height:23px; margin:10px 0;">
            <p style="width:100%; float:left;font-size:14px;">I understand that due to the restrictions of COVID -19 pandemic, Business Gateways International temporarily suspended the Physical Site Visit process as part of JSRS Validation which is mandatory for the Certification</p>
          <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0 10px 0 23px; line-height:23px; font-family:14px;color:#6A6A6A;">
            <li>I hereby request Business Gateways International to process the JSRS Certification by agreeing to these Terms & Conditions.</li> 
            <li>We also acknowledge that we will adhere to the request by Business Gateways International for a successful Physical Site Visit after the certification.</li>
            <li>Failing to adhere to the Physical Site Visit request <span style="color:#33333 !important;">(after 3 attempts)</span>, Business Gateways International can revoke the JSRS certification before its expiry.</li>
          </ul>
    </div>';
        $page['sitevisit']['virtualreadterm'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
        <span>I have read and understood the above Terms and Conditions for the Physical Site Visit Validation. I agree to the above Terms and Conditions. </span>
        </div>'; 
        
        $page['sitevisit']['turnonlocsrvice'] = '<div style="width:100%; float:left;font-size:17px; font-family:calibri; text-align:left; font-weight:normal; '.$bcolor.'; line-height:23px; margin:10px 0;">
      <p style="width:100%; float:left;"><b>Turn on Location Service</b>
      </div>';
      $page['sitevisit']['turnonlocsrvicenote'] = '<div style="width:100%; float:left;font-size:15px; font-family:calibri; text-align:left; font-weight:600px; '.$ccolor.'; line-height:23px; margin:10px 0;">
      <p style="width:100%; float:left;">Kindly ensure your device “Location Service” is turned on, for your JSRS online Site Visit validation process. </p>
      </div> ';
     $page['sitevisit']['takephotosigntitle'] = '<div style="width:100%; float:left;font-size:16px; font-family:calibri; text-align:left; font-weight:normal;line-height:23px; margin:10px 0;">
      <div style="color:#333333;">Signboard <span style="color:red"> *</span></div>
       </div>';
      $page['sitevisit']['takephotosign'] = '<div style="width:100%; float:left;font-size:13px; font-family:calibri; text-align:left; font-weight:normal; color:#6A6A6A; line-height:23px; margin:10px 0;">
       <p style="width:100%; float:left;">Site photos need to be taken from the actual site location. This mobile app will automatically Tag your Geographic Location to the image and you can submit the Images on this Mobile Application</p>
        </div>';
     $page['sitevisit']['tpwptitle'] = '<div style="width:100%; float:left;font-size:16px; font-family:calibri; text-align:left; font-weight:normal;line-height:23px; margin:10px 0;">
     <div style=" color:#333333;">Workplace<span style="color:red"> *</span></div></div>';
        $page['sitevisit']['tpwpcontent'] = '<div style="width:100%; float:left;font-size:13px; font-family:calibri; text-align:left; font-weight:normal; color:#6A6A6A; line-height:23px; margin:10px 0;">
        <p> Workplace need to be taken from the actual site location.This mobile app will automatically Tag your Geographic Location to the image and you can submit the Images on this Mobile Application.</p>
        </div>';
        $page['sitevisit']['tpaddphototitle'] = '<div style="width:100%; float:left;font-size:16px; font-family:calibri; text-align:left; font-weight:normal; '.$bcolor.'; line-height:23px; margin:10px 0;">
        <span style="color:#333333;">Additional Photos</span>
        </div>';
        $page['sitevisit']['tpaddphotocont'] = '<div style="width:100%; float:left;font-size:13px; font-family:calibri; text-align:left; font-weight:normal; color:#6A6A6A; line-height:23px; margin:10px 0;">
        <p>You can upload max. 3 photos of Manufacturer/Factory</p>

        </div>';
           $page['sitevisit']['sitephoto'] = '<h1 style="font-size:14px; font-family:calibri; margin:15px 0 0; text-align:left; font-weight:bold; '.$bcolor.'">Online Site Visit Validation - Photos Checklist</h1>';
     
  $page['sitevisit']['undertaktitle'] = '<div style="width:100%; float:left;font-size:18px; font-family:calibri; text-align:left; font-weight:normal; '.$bcolor.'; line-height:23px; margin:10px 0;"> 
      <span style="font-weight:bold; color:#cc0000">Undertaking Procedure</span>
       </div>';
         $page['sitevisit']['uthead'] = '<div style="width:100%; float:left;font-size:17px; font-family:calibri; text-align:left; font-weight:normal;'.$bcolor.'; line-height:23px; margin:20px 0;">
            <p>Unable to visit your office and submit the photos?</p> 
	</div>';
 
        $page['sitevisit']['skipreasonterms'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; color:#6A6A6A; line-height:23px; margin:20px 0;">
 
            <p> Please enter the reason <span style="color:#cc0000;">*</span> </p> 
	</div>';
    $page['sitevisit']['utnote'] = '<div style="width:100%; float:left;font-size:13px; font-family:calibri; text-align:left; font-weight:normal; color:#6A6A6A;line-height:23px; margin:20px 0;">
    <p><span>Note: </span> The reason for non-submission of Office-site Photos does not guarantee  issuance of JSRS Certificate. Additionaly, the reasons provided above on non-submission are subject to validation along with other information submitted for JSRS Certification.</p> 
 </div>';
          $page['sitevisit']['agreedterms'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
            <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0 10px 0 23px; line-height:23px; font-family:14px; ">
                <li>Physical Site validation will be conducted later after COVID-19 pandemic restrictions are lifted.</li> 
                <li>JSRS Certification is also subject to successful validation of JSRS Supplier Validation Form.</li>
            </ul>
	</div>';
 
         $page['sitevisit']['onuploadphotsucc'] =  '<div style="width:100%; float:left;font-size:15px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
         <p>Success</p>
         </div>';
        $page['sitevisit']['onsubvalidsuccmsg'] = '<div style="width:100%; float:left;  font-family:calibri; text-align:left; line-height:23px; margin:10px 0;">
        <p style="color:#333333;font-size:14px;font-weight:bold;">Your Online Site Visit application is submitted for validation successfully.</p>
        <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:15px; list-style-position: inside; padding:0; line-height:23px; font-family:calibri;">
        <li> The JSRS team will now begin the Validation of the Application. </li> 
        <li> You will receive updates on the status of your Site Validation via email and notification through the JSRS Dashboard.</li>
        </ul>
        <span style="font-size:14px;color:#333333;font-weight:bold;">Notes:</span>
        <ul style="float:left; width:100%; position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0 0px 0 20px; line-height:23px; font-family:calibri;color:#6A6A6A; ">
       <li>Physical Site validation will be conducted later after COVID-19 pandemic restrictions are lifted.</li> 
        <li> JSRS Certification is also subject to successful validation of JSRS Supplier Validation Form.</li>
        </ul>
    </div>';
   $page['sitevisit']['onsubrevalidsuccmsg'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left;  line-height:23px; margin:10px 0;">
        <p style="color:#333333;font-size:14px;font-weight:bold;text-align: center;">Your Online Site Visit application is re-submitted for validation successfully.</p>

        <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:15px; list-style-position: inside; padding:0 0px 0 20px; line-height:23px; font-family:calibri;">
        <li>The JSRS team will now begin the Validation of the Application. </li> 
        <li>You will receive updates on the status of your Site Validation via email and notification through the JSRS Dashboard.</li>
        </ul>
        <span style="font-size:14px;color:#333333;font-weight:bold;">Notes:</span>
        <ul style="float:left; width:100% position:relative; margin-top:15px; font-size:13px;list-style-type:disc; padding:0  0px 0 20px; line-height:23px; font-family:calibri; color:#6A6A6A; ">
        <li>Physical Site validation will be conducted later after COVID-19 pandemic restrictions are lifted.</li> 
        <li>JSRS Certification is also subject to successful validation of JSRS Supplier Validation Form.</li>
        </ul>
    </div>';
   $page['sitevisit']['validationsts'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
            <span style="font-weight:bold; color:#cc0000">Online Site Validation Status: Declined</span>
	</div>';
        $page['sitevisit']['validationmsg'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
            Your can re-submit the site visit form after after updating the changes mentioned in the comments.
	</div>';
     $page['sitevisit']['deccommentsmsg'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal;color:#33333; line-height:23px; margin:10px 0;">
    <p style="width:100%; text-align: center;font-weight:bold;color:#33333;">Kindly find the declined comments below, update and resubmit for validation after making necessary changes.</p>
</div> ';
$page['sitevisit']['declinedcmts'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; color:red; line-height:23px; margin:10px 0;">
Declined Comments
</div>';
       $page['sitevisit']['jsrsvalappstshead'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.' line-height:23px; margin:10px 0;">
            <span style="'.$ccolor.';font-weight:bold;">JSRS Validation – Site Visit COVID-19</span>
	</div>';
        $page['sitevisit']['jsrsvalappsts'] = '<div style="width:100%; float:left;font-size:14px; font-family:calibri; text-align:left; font-weight:normal; '.$ccolor.'; line-height:23px; margin:10px 0;">
            <p style="width:100%; float:left;">JSRS Validation is in progress. You will receive updates on the status of your certification via email and notification through the JSRS Dashboard.</p>
	</div> ';
        foreach($page as $pkey=>$p)  {
           foreach($p as $ckey=>$c){
              $page[$pkey][$ckey] =  base64_encode($c);
           }
       }
        echo json_encode(['msg' => 'success', 'status' => 1, 'data' => $page]);
    }
        
}


 

