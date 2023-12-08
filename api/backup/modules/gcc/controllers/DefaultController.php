<?php

namespace api\modules\gcc\controllers;

use api\modules\gcc\models\GcctenddtlsTblQuery;
use api\modules\gcc\models\GcctenddtlsTbl;
use api\modules\gcc\models\GcctendsubsdtlsTbl;
use api\modules\gcc\models\GcctendsectorsubsdtlsTbl;
use yii\rest\Controller;
use DateTime;

/**
 * Default controller for the `gcc` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        echo 'GCC Controller'; exit;
        // return $this->render('index');
    }


    public function actionGcctenderlist(){
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true); 
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        if(!empty($_REQUEST['catTendPk']))
        {
            $catTendPk = trim($_REQUEST['catTendPk']);
        }
        if(!empty($_REQUEST['catId']))
        {
            $categId = trim($_REQUEST['catId']);
        }
        if(!empty($_REQUEST['limit']))
        {
            $limit = trim($_REQUEST['limit']);
        }
        if(!empty($_REQUEST['offset']))
        {
            $offset = trim($_REQUEST['offset']);
        }
        return GcctenddtlsTblQuery::getlist($categId,$limit,$offset,$catTendPk);  
    }

    public function actionGcctenderdetails(){
        
        return GcctenddtlsTblQuery::gettenderdetails($_REQUEST['gcctenderid']);
    }
    
    public function actionGetsectordtls()
    { 
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true); 
        
        $secdtl =  \Yii::$app->db->createCommand("select gcctendsectorsubsdtls_pk, gcctendsubsdtls_pk, gtssd_gcctendsectmst_fk , gtsm_sectorname, gtssd_subscribedto from gcctendsectorsubsdtls_tbl as t1
       left join gcctendsubsdtls_tbl as t2  on t1.gtssd_gcctendsubsdtls_fk = t2.gcctendsubsdtls_pk
       Left join jsrst3invoicedtls_tbl as t4 on t4.jsrst3invoicedtls_pk = t1.gtssd_jsrst3invoicedtls_fk
       
        left join gcctendsectmst_tbl as t3 on t3.gcctendsectmst_pk = t1.gtssd_gcctendsectmst_fk 
        where t2.gtsd_membcompmst_fk =  $companyPk AND (if(gtssd_subscriptionstatus IN(4,5,6,9) AND (gtssd_subscribedto >= now()) ,1,if(gtssd_subscriptionstatus IN (3,7) ,1,0)))");
  
        $secdtlres = $secdtl->queryAll();
        
        if(!empty($secdtlres)){
        foreach($secdtlres as $key=>$value){  
            $response['data'][$key]['gcctendsubsdtls_pk'] = $value['gcctendsubsdtls_pk'];
            $response['data'][$key]['catTendPk'] = $value['gcctendsectorsubsdtls_pk'];
            $response['data'][$key]['gtssd_gcctendsectmst_fk'] = $value['gtssd_gcctendsectmst_fk'];
            $response['data'][$key]['gtsm_sectorname'] = $value['gtsm_sectorname'];
            $response['data'][$key]['closing_date'] = $value['gtssd_subscribedto'];
         } 
         $response['status']=1;
         $response['msg'] = 'Success';
        }
        else{
            $response['status']=0;
            $response['msg'] = 'No Records Found';
        }
      return $response;
    }
    //categlisting j2//
    public function actionGetcategorydtl()
    {
         $subSecId = $_REQUEST['catId'];
         if(!empty($_REQUEST['limit']))
         {
             $limit = trim($_REQUEST['limit']);
         }
         if(!empty($_REQUEST['offset']))
         {
             $offset = trim($_REQUEST['offset']);
         }
         $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true); 
        
         if(!empty($subSecId)){
            $subDtl =   \Yii::$app->db->createCommand("SELECT `gcctendsubsdtls_pk` FROM `gcctendsubsdtls_tbl` WHERE `gtsd_membcompmst_fk` = $companyPk");
            $subDtlres = $subDtl->queryOne();
            
            if(!empty($subDtlres)){
                 $subDtlPk = $subDtlres['gcctendsubsdtls_pk'];
                $sectorDetails =  \Yii::$app->db->createCommand("SELECT * FROM `gcctendsectorsubsdtls_tbl` WHERE `gtssd_gcctendsectmst_fk` = $subSecId  AND `gtssd_gcctendsubsdtls_fk`= $subDtlPk ")->queryAll();
 
                 //  echo  $sectorDetails->createCommand()->getRawSql();exit;
              // print_r($sectorDetails);exit;
                if(!empty($sectorDetails)){
                    $categoryPk = $sectorDetails['gtssd_gcctendsectmst_fk'];
                    $tenderSectorPk = $sectorDetails['gcctendsectorsubsdtls_pk'];
                    if($sectorDetails['gtssd_subscribedto'] != ''){
                        $dateObj = new DateTime($sectorDetails['gtssd_subscribedto']);
                        $expDate = $dateObj->format('d-m-Y');
                    }
                    $returnArr = array('returnCode'=>100,'expDate'=>$expDate,'catPk'=>$categoryPk,'catTendPk'=>$tenderSectorPk);
                    echo json_encode($returnArr);
                }
            }
        }
    }
    //end//
    public function actionWssectorlist() {
        $compk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $seclist =  GcctenddtlsTbl::getSectorlist($compk);
        $data['res'] = 'S';
        $data['status'] = '1';
        $data['msg'] = 'success';
        $data['seclist'] = $seclist;
        echo json_encode($data);
    }
   //search
   public function actionSearchgcc(){
        $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true); 
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        return GcctenddtlsTblQuery::searchgcctenderlist();
    }
    public function actionGetgccdetnote()
    {
        $gccnote['gccdetview'] ['Corrigendum_Details'] = '<div>All the changes made to this Tender via corrigendum by the Tendering Authority.</div>' ;
        $gccnote['gccdetview'] ['Bidding_Type'] = '<div> The Bidders can bid with this bidding type  </div>';
        $gccnote['gccdetview'] ['Tender_Published_Date'] = '<div>The Date when the Tender is Published</div>';
        $gccnote['gccdetview'] ['Tender_Closing_Date'] =  '<div><p>The Date when the Tender ends.</p><br>
        <p>The Date when the Tender terminates.</p></div>';
        $gccnote['gccdetview'] ['Funding_Agency '] =  '<div> The Agency that Funds this Tender.</div>';
       
        $gccnote['gccdetview'] ['Expiry_Date'] =  '<div> The Date when your subscription pack expires.</div>';
        foreach($gccnote as $pkey=>$p)  {
            foreach($p as $ckey=>$c){
               $gccnote[$pkey][$ckey] = $c;
            }
        }
         echo json_encode(['msg' => 'success', 'status' => 1, 'data' => $gccnote]);

    }

     

}
