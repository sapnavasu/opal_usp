<?php

namespace api\modules\mws\controllers;

use app\filters\auth\HttpBearerAuth;
use common\models\UsermstTbl;
use yii\rest\ActiveController;
use Yii;


use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\rbac\Permission;
use \common\components\Configuration;
use yii\web\HttpException;
use yii\rest\Controller;
use \common\models\UsermstTblQuery;
use \gcc\models\GcctenddtlsTbl;

use common\components\Common;
use \common\components\Security;
 
use \yii\db\ActiveRecord;
 

 

class WsController extends Controller
{
    public $modelClass = '\api\models\SubappfrmTbl';
   
    // public function __construct($id, $module, $config = [])
    // {
    //     parent::__construct($id, $module, $config);

    // }

 
    public function actions()
    {
        return [];
    }

    public function behaviors()
    {
        /**/
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

        return $behaviors;
    }

 /**
     * Handle the login process for staff members for backend dashboard
     *
     * Request: POST /v1/staff/login
     *
     *
     * @return \yii\web\Response
     * @throws HttpException
     */
    //User Exists//
    public function actionUserexists()
    {  
         if (isset($_REQUEST['username']) && !empty($_REQUEST['username']))
        {  
          $username = trim($_REQUEST['username']);
          $userlngth = strlen($_REQUEST['username']);
          $model = UsermstTblQuery::chkusernameexist($username);
        } 
        else {
        $data['msg']= "Enter Email ID/Username/Mobile No.";
        $data['status'] = 0; 
        return $this->asJson($data) ;
          }
       //End Phone number//
          if($userlngth >= 45 ){
          $data['msg'] = "Not Exceed more than 45 character";
          $data['status'] = 0;
          }
          if ($model > 0) {
            $data['msg'] = "success";
            $data['status'] = 1;
            }else {
            $data['msg']= "Invalid Credentials";
            $data['status'] = 0; 
            }
         return $this->asJson($data) ;
        exit;
    }
    //User Exists//
    //Password Exists//
   public function actionPasswordexists()
    {
        if (isset($_REQUEST['password']) && !empty($_REQUEST['password'])){
            // if (strlen($_REQUEST['password']) >= 8 && strlen($_REQUEST['password'])<= 15 ){
            Yii::$app->controllerNamespace ='api\modules\lgn\controllers';
            $response =Yii::$app->runAction('login/login');
              $data['res']= $response->data;
            echo json_encode($data);
            exit;
        }
        else{
              $data['msg'] ="Enter Password";
               $data['status'] = 0; 
               return $this->asJson($data) ;
               exit;

        }
        
    }
     //End//
	//Forget Password - Send OTP//	 
  public function actionSendforgotpwdmailmb()
   {
    if (isset($_REQUEST['email'])){ 
        $email = trim($_REQUEST['email']);
       
        }
        Yii::$app->controllerNamespace ='api\modules\lgn\controllers';
        $response =Yii::$app->runAction('login/sendforgotpwdmail');
        $data['res']= $response->data;
       
           if($data['res']['status'] == 2){
            $data['res']['msg'] = 'You have utilized all 3 attempts, kindly go to the login page and try again after some times.';
           }   else{
            $data['res']= $response->data;

           }
        
        echo json_encode($data);
        exit;
   }

   // Verify OTP in Mobile and send response//
   public function actionVerifymobotp()
   {     
       Yii::$app->controllerNamespace ='api\modules\lgn\controllers';
        $response =Yii::$app->runAction('login/fgtotpverify');
        $data['res'] = $response->data;
        echo json_encode($data); 
        exit;
        }

        //SetNew Password And Submit//
public function actionSetnewpassmob()
   {     
   
        if(isset($_REQUEST['newpassword']) && isset($_REQUEST['confirmpassword']) && isset($_REQUEST['userid']))
        {
            $newpassword = ltrim($_REQUEST['newpassword']);
            $confirmpassword = ltrim($_REQUEST['confirmpassword']);
            $userid = trim($_REQUEST['userid']);
          
            if(strlen($newpassword) && strlen($confirmpassword) >= 45 )
            {
                $data['msg'] ="Characters should not exceed 45 characters";
                $data['status'] = 0;
               }
             
            if($newpassword == $confirmpassword)
            {     
                $data['res'] = UsermstTblQuery::confirmAndSavePassword($userid, $newpassword);
             } else{
                $data['status']=0;
                $data['msg'] = "Passwords do not match";
            }
            echo json_encode($data); 
        exit;
        
        }
       //End SetNew Password And Submit//
  }

  public function actionSetpasswexp()
  {
    Yii::$app->controllerNamespace ='api\modules\lgn\controllers';
     $response =Yii::$app->runAction('login/isvalidlink');
     return  $response;
    exit;
   }
  //Mobile Login End //
 

  //GccTender Module// 

  
  public function actionSearchgccdata()
{
  Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
    $response = Yii::$app->runAction('default/searchgcc');
    $data['res'] = $response;
    echo json_encode($data);
    exit;
}

public function actionGetsectordtl()
{
  Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
    $response = Yii::$app->runAction('default/getsectordtls');
    $data['res'] = $response;
    echo json_encode($data);
    exit;
}


public function actionGcctenderlist()
  {
      Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
    $response = Yii::$app->runAction('default/gcctenderlist');
    $data['res'] = $response;
   // print_r($response);exit;
    if(count($response) == 0)
    {
        $data['staus'] =0;
        $data['msg'] = "Data is empty";
     }
    else
    { 
        $data['staus'] =1;
        $data['msg'] = "success";
        $data['res'] = $response;
      }
     
    echo json_encode($data);
    exit;
   }

   public function actionGcctenderdtls()
  {
      Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
    $response = Yii::$app->runAction('default/gcctenderdetails');
    $data['res'] = $response;
    echo json_encode($data);
    exit;
   } 
   public function actionGetcategdtls()
   {
       Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
     $response = Yii::$app->runAction('default/getcategorydtl');
     $data['res'] = $response;
     echo json_encode($data);
     exit;
    } 
  
    public function actionGccdetviewnote()
     {
      Yii::$app->controllerNamespace ='api\modules\gcc\controllers';
      $response = Yii::$app->runAction('default/getgccdetnote');
       exit;
     }
  //End GccTender Module//

  //JSearch API Service starts//

  public function actionGetsearchcriteriamb()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers';
    $response = Yii::$app->runaction('bizsearch/get-search-criteria');
    return $response;
    exit;
  }

  public function actionGetpscategorymb()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers';
    $response = Yii::$app->runaction('bizsearch/get-ps-category');
    return $response;
    exit;
    
  }

  public function actionGetpscategorysrch()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers';
    $response = Yii::$app->runaction('bizsearch/get-ps-categorysearch');
    return $response;
    exit;
    
  }

  public function actionGetcritsrchtypmb()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers'; 
    $isd_response = Yii::$app->runaction('bizsearch/initialize-smartfilter-data');//req:{searchType: , criteriaType:}
   // print_r($isd_response->data['status']);exit;
     $data['res1'] = $isd_response->data;
    
    $data['msg1'] = $isd_response->data['msg'];
    if($isd_response->data['status']==100){
      $data['status1']=1;
    }   
    
    $gbsr_response1 = Yii::$app->runaction('bizsearch/get-bsearch-result');//req:{searchType: , criteriaType:,searchFrom:,triggerFrom:}
    $data['res2'] = $gbsr_response1->data; 
    $data['msg'] = $gbsr_response1->data['msg'];
     if($gbsr_response1->data['status'] == 100){
      $data['status']=1;
    }
    return $data;
    exit;
     
  }

  
  public function actionGetbsearchmb()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers';
    $gbr_response = Yii::$app->runaction('bizsearch/get-bsearch-result');
    $gsc_response1 = Yii::$app->runaction('bizsearch/get-search-criteria');
    Yii::$app->controllerNamespace ='api\modules\ea\controllers';
    $fuld_response = Yii::$app->runaction('monitor/fetch-user-login-details');
    exit;
 }

  public function actionSrchinprod()
  {
    Yii::$app->controllerNamespace ='api\modules\bs\controllers';
    $tes = Yii::$app->runaction('bizsearch/get-bsearch-result');
    return $tes;
    exit;
    
  }

  //JSearch  API Service Ends//

  //Site Visit Logic starts//
  public function actionSvskipcomm()
  {
   Yii::$app->controllerNamespace ='api\modules\sv\controllers';
   // print_r(Yii::$app->controllerNamespace);exit;
     $response = Yii::$app->runaction('svisitmobile/addcomments');
    //print_r(Yii::$app->controllerNamespace);exit;
       exit;
  }
  public function actionSavmultimg()
  {
   
    Yii::$app->controllerNamespace ='api\modules\sv\controllers';
    $response = Yii::$app->runaction('svisitmobile/sitevisitimagesave');
    exit;
  }

  public function actionSvcontent()
  {
   Yii::$app->controllerNamespace ='api\modules\sv\controllers';
   $response = Yii::$app->runaction('svisitmobile/dynamiccontent');
   exit;
  }
  public function actionSitevisitstatus()
  {
   Yii::$app->controllerNamespace ='api\modules\sv\controllers';
   $response = Yii::$app->runaction('svisitmobile/svstatus');
   exit;
  }
  public function actionSvshowimg()
  {
   Yii::$app->controllerNamespace ='api\modules\sv\controllers';
   $response = Yii::$app->runaction('svisitmobile/svshowimage');
   exit;
  }
  //Site Visit Logic Ends//
  //Contact us//
  public function actionContusimgupload()
  {
    Yii::$app->controllerNamespace ='api\modules\drv\controllers';
    $response = Yii::$app->runaction('drive/uploadmultiplimg');  
    /* $data['res1'] = $response;
    Yii::$app->controllerNamespace ='api\modules\drv\controllers';
    $mapres = Yii::$app->runaction('drive/mapreference');  */ 
    return $response;
    exit;
   }

  public function actionContussave()
  {
    Yii::$app->controllerNamespace ='api\modules\mcp\controllers';
    $response = Yii::$app->runaction('mastercompanyprofile/insertcontactus');  
    return $response;
    exit;
  }
  public function actionGetusercc()
  {
    Yii::$app->controllerNamespace ='api\modules\mcp\controllers';
    $respnose['ccemail'] = json_decode(Yii::$app->runaction('mastercompanyprofile/contactusccdata'));  
    $respnose['typequery'] =  json_decode(Yii::$app->runaction('mastercompanyprofile/contactusmasterdata'));  
      return $respnose  ;
    exit;
  }  
  
  //End Contact us//
 // Notification Starts here//
 
 //End Notification//

}
   