<?php
namespace api\modules\trade\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;

use \common\models\MemcomptradingdtlsTbl;
use \common\models\MemcompmplocationdtlsTbl;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Trade
{
    public $lang = 'en';
    
    /**
    * SaveBs_permit function  is used to save the business source permit information
    * @param array $data permit attributes 
    * @return success array / failure array if data not saved  
    */
    Public function save($tdata) {
    $required_fileds_error = [];
        
//        if($data['mcfd_fctnooflines'] == "" || $data['mcfd_fctnooflines'] == NULL) {
//            if (!in_array('mcfd_fctnooflines', $required_fileds_error)) {
//                array_push($required_fileds_error, 'mcfd_fctnooflines');
//            }
//        }
        if($tdata['mctd_minstoragecap'] != '' && $tdata['mctd_minstoragecap'] != NULL && $tdata['mctd_maxstoragecap'] != '' && $tdata['mctd_maxstoragecap'] != NUL) {
            if($tdata['mctd_minstoragecap'] > $tdata['mctd_maxstoragecap']) {
                array_push($required_fileds_error, 'min_max_error');
            }
        }

        
        if(count(array_filter($required_fileds_error)) < 1) {
            $addtrade_details = MemcomptradingdtlsTbl::inserttradedetails($tdata);
            if($addtrade_details['data']['memcomptradingdtls_pk']) {
                $return['memcomptradingdtls_pk'] = $addtrade_details['data']['memcomptradingdtls_pk'];
            } 
        } else {
            $error_txt = "Max storage capcity must be higher than Minimum storage capcity";
            $return = ['status' => 'Error', 'code' => '203', 'msg' => $error_txt];
        }   
        return json_encode($return);
    }
    
    /**
    * mapwithbs function  is used to map Trade with Business Source
    * @param array $data permit attributes 
    * @return success array / failure array if data not saved  
    */
    
    public function mapwithbs($data){

        if(isset($data['bspks'])){
           return  \common\models\MemcompbussrcdtlsTbl::mapwithbs($data);
        }else{
            $error_txt = "Business source PK is required";
            return ['status' => 'Error', 'code' => '203', 'msg' => $error_txt];
        }
    }
    /**
    * mapwithbs function  is used to get  mapped Trade from Business Source
    * @param  Trade encrypt PK  
    * @return string of PKs of Business source
    */
    public function getmappedbs($tradePK){
        return  \common\models\MemcompbussrcdtlsTbl::getmappedbs($tradePK);
    }
    
    public function finalcreatetrade($trade_pk) {
        $addtrade_details = MemcomptradingdtlsTbl::finalcreatetradedetails($trade_pk);
        return $addtrade_details;  
    }

    public function finalupdatetrade($trade_pk) {
        $addtrade_details = MemcomptradingdtlsTbl::finalupdatetradedetails($trade_pk);
        return $addtrade_details;  
    }
    
    public function gettradedetail($trade_pk) {
        $gettrade_details = MemcomptradingdtlsTbl::gettradedetails($trade_pk);
        return $gettrade_details;
    }

    public function getlocationdetail($location_ids) {
        $gettrade_details = MemcompmplocationdtlsTbl::getlocationdetail($location_ids);
        return $gettrade_details;
    }

    /**
    * gettradelist function  is used to get the business source permit information
    */

    public function gettradelist($data){
        $trade_listing = MemcomptradingdtlsTbl::tradelisting($data);
        return $trade_listing;
    }

            /**
     * This method is used to Delete the Trade
     * @param pk in header, Pk of the Trade Table
     */


    public function Deletetrade($pk){
        if($pk){
            $data =MemcomptradingdtlsTbl::deletetrade($pk);
        }else{
            $data = ['status'=>false,'code'=>'E001','msg'=>'Required Business source primary key'];
        }
           return $data; 
        }
    
}