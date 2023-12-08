<?php

// namespace api\modules\nty\controllers;
namespace api\modules\nty\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use common\models\MembercompanymstTbl;
use common\models\UsermstTbl;
use common\models\MemberregistrationmstTbl;
use common\models\BcastnotifmstTbl;
use common\models\BcastnotifdtlsTbl;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use common\components\Common;
use common\components\Security;

class NotificationController extends \yii\web\Controller
{
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

        // $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    static function actionSuppliernotices(){
        
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getDashboardData();
        $size = Security::sanitizeInput($_REQUEST['size'], "number");
        $page = Security::sanitizeInput($_REQUEST['page'], "number");
        $request = Yii::$app->request->post();
       
// echo'<pre>';print_r($request['filter']['unreadmsg']);exit;
        return self::fetchdatas($data,$size,$page,$request);
        
    }
    static function actionSupplierupdatenotices(){
        
        $request = \Yii::$app->request->post(); 
        $dashboard = new \common\components\Dashboard();
        $data = $dashboard->getDashboardData();
        $size = Security::sanitizeInput($_REQUEST['size'], "number");
        $page = Security::sanitizeInput($_REQUEST['page'], "number");
        if(empty($request['notif_pk'])&&isset($data['contact']['pk'])&&$request['status']==1){
            BcastnotifdtlsTbl::updateAll(['bnd_status'=>2,'bnd_viewedon'=>date('Y-m-d H:i:s'),'bnd_viewedby'=>$data['contact']['pk'],'bnd_viewedbyipaddr'=>Yii::$app->getRequest()->getUserIP()],['and',['=', 'bnd_status', 1], ['=', 'bnd_usermst_fk',$data['contact']['pk']]]);
        }elseif(!empty($request['notif_pk'])&&isset($data['contact']['pk'])){
            $notification_record = BcastnotifdtlsTbl::find()->where(['in','bcastnotifdtls_pk',$request['notif_pk']])->andwhere("bnd_usermst_fk='".$data['contact']['pk']."'")->all();
            // echo'<pre>';print_r($notification_record);exit;
            foreach($notification_record as $val){
                // echo $val->bcastnotifdtls_pk;exit;
                if($val->bnd_viewedon==null){
                    // 'bnd_viewedon','bnd_viewedby','bnd_viewedbyipaddr','bnd_deletedon','bnd_deletedby','bnd_deletedbyipaddr'
                    $val->updateAll(['bnd_status'=>$request['status'],'bnd_viewedon'=>date('Y-m-d H:i:s'),'bnd_viewedby'=>$data['contact']['pk'],'bnd_viewedbyipaddr'=>Yii::$app->getRequest()->getUserIP()],['=','bcastnotifdtls_pk',$val->bcastnotifdtls_pk]);
                }else if($request['status']==3){
                    $val->updateAll(['bnd_status'=>$request['status'],'bnd_deletedon'=>date('Y-m-d H:i:s'),'bnd_deletedby'=>$data['contact']['pk'],'bnd_deletedbyipaddr'=>Yii::$app->getRequest()->getUserIP()],['=','bcastnotifdtls_pk',$val->bcastnotifdtls_pk]);
                }else{
                    $val->updateAll(['bnd_status'=>$request['status']],['=','bcastnotifdtls_pk',$val->bcastnotifdtls_pk]);
                }
            }
            // $notice_data = BcastnotifdtlsTbl::updateAll(['bnd_status'=>$request['status']],['in','bcastnotifdtls_pk',$request['notif_pk']]);
            // return self::fetchdatas($data,$size,$page,$request);
        }
        return self::fetchdatas($data,$size,$page,$request);
    }
    static function fetchdatas($data,$size,$page,$request){
        // echo $data['contact']['pk'];exit;
        $datasfor = $request['datafor'];
        $sortpk = $request['filter']['sorting'];
        $search = $request['filter']['searchbytitle'];
        if(isset($data['contact']['pk'])){
            
            /*$all_notice_data['notice_data'] = Yii::$app->db->createCommand("select substring_index(b.bnm_msgtitle,'*-**-*',1) as title,b.bnm_msgdesc as para1,  substring_index(b.bnm_msgtitle,'*-**-*',-1) as para2, bcastnotifdtls_pk,bnd_status,bnd_intrash, bnm_createdon as date, bnm_tz_utcoffset,bnm_closing_date,	bnm_createdon as time, CAST(0 as SIGNED) as checked from bcastnotifdtls_tbl a inner join testnoticemast_tbl b on b.bcastnotifmst_pk=a.bnd_bcastnotifmst_fk where bnd_status!=3 and bnd_usermst_fk='".$data['contact']['pk']."' order by bcastnotifdtls_pk desc")->queryAll();

            $all_notice_data['notice_data_intrash']=Yii::$app->db->createCommand("select substring_index(b.bnm_msgtitle,'*-**-*',1) as title,b.bnm_msgdesc as para1, substring_index(b.bnm_msgtitle,'*-**-*',-1) as para2, bcastnotifdtls_pk,bnd_status,bnd_intrash, bnm_createdon as date,bnm_tz_utcoffset,bnm_closing_date,bnm_createdon as time, CAST(0 as SIGNED) from bcastnotifdtls_tbl a inner join testnoticemast_tbl b on b.bcastnotifmst_pk=a.bnd_bcastnotifmst_fk where bnd_status=3 and  bnd_usermst_fk='".$data['contact']['pk']."' order by bcastnotifdtls_pk desc")->queryAll();*/

            // title:"Received an Updated RFQ [Ref. No here ?]",date:"21-01-2020",time:"19:00(GMT+4)",para1:"You have received an updated Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",para2:"Daleel"
           
            $query = BcastnotifdtlsTbl::find()->select(["bnm_msgtitle as title","bnm_msgdesc as para1", "bnm_noticefrom as para2", "bcastnotifdtls_pk","bnd_status","bnd_intrash", "bnm_createdon as date","bnm_tz_utcoffset","bnm_closing_date","bnm_msgstatus","bnm_isdeleted","bnm_refno","bnm_msgtype","bnm_createdon as time", "CAST(0 as SIGNED)"])->innerJoin('bcastnotifmst_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk');
             
            /* $query2 = BcastnotifdtlsTbl::find()->select(["substring_index(bnm_msgtitle,'*-**-*',1) as title","bnm_msgdesc as para1", "substring_index(bnm_msgtitle,'*-**-*',-1) as para2", "bcastnotifdtls_pk","bnd_status","bnd_intrash", "bnm_createdon as date","bnm_tz_utcoffset","bnm_closing_date","bnm_refno","bnm_createdon as time", "CAST(0 as SIGNED)"])->innerJoin('testnoticemast_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk')
            ->where("bnd_status=3 and bnd_usermst_fk='".$data['contact']['pk']."'")->asArray();*/

            


            $msg_type = '';
            if($datasfor=='notice'||$datasfor=='trashnotice'){
                $msg_type = 'bnm_msgtype=3 and ';
            }
            else if($datasfor=='awards'||$datasfor=='trashawards'){
                $msg_type = 'bnm_msgtype=5 and ';
            }
           if($request['filter']['unreadmsg']){
                $query->where("bnm_msgstatus=1 and bnd_status=1 and ".$msg_type."bnd_usermst_fk='".$data['contact']['pk']."'");
           }
            elseif($datasfor=='notice'){
                $query->where("bnm_msgstatus=1 and bnd_status!=3 and bnm_msgtype=3 and bnd_usermst_fk='".$data['contact']['pk']."'");
            }
            elseif($datasfor=='trashnotice'){
                $query->where("bnm_msgstatus=1 and bnd_status=3 and bnm_msgtype=3 and bnd_usermst_fk='".$data['contact']['pk']."'");
            }
            elseif($datasfor=='awards'){
                $query->where("bnm_msgstatus=1 and bnd_status!=3 and bnm_msgtype=5 and bnd_usermst_fk='".$data['contact']['pk']."'");
            }
            elseif($datasfor=='trashawards'){
                $query->where("bnm_msgstatus=1 and bnd_status!=3 and bnm_msgtype=5 and bnd_usermst_fk='".$data['contact']['pk']."'");
            }
            else{
                $query->where("bnm_msgstatus=1 and bnd_usermst_fk='".$data['contact']['pk']."'");
            }
            if($search!=''){
                $query->andwhere('bnm_msgtitle like "%'.$search.'%"');
            }
            $sort = ['bcastnotifdtls_pk' => SORT_DESC];  
            if($sortpk=='desc') {
                $sort = ['bcastnotifdtls_pk' => SORT_DESC];  
            } elseif ($sortpk == 'asc') {
                $sort = ['bcastnotifdtls_pk' => SORT_ASC];        
            }
            // echo $query->createCommand()->getRawSql();exit;
            $query->asArray();
            $size = (!empty($size)) ? $size : 10;
            $page = (!empty($page)) ? $page : 1;
    
            $provider = new ActiveDataProvider([
                'query' => $query,
                'sort' => [
                    'defaultOrder' => $sort
                ],
                'pagination' => ['pageSize' => $size]
            ]);

            /*$size2 = (!empty($size)) ? $size : 10;
            $page2 = (!empty($page)) ? $page : 1;
    
            $provider2 = new ActiveDataProvider([
                'query' => $query2,
                'sort' => [
                    'defaultOrder' => $sort
                ],
                'pagination' => ['pageSize' => $size2]
            ]);*/
            $date = new \DateTime();
            $timeZone = $date->getTimezone();
            $all_notice_data = [];
            $all_notice_data['notice_data'] = $provider->getModels();
            // $all_notice_data['notice_data_intrash'] = $provider2->getModels();
            
            for($i=0;$i<count($all_notice_data['notice_data']);$i++){
                $all_notice_data['notice_data'][$i]['bnm_closing_date'] =  date('d-m-Y H:m A',strtotime(Common::convertTimezone($all_notice_data['notice_data'][$i]['bnm_closing_date'],$all_notice_data['notice_data'][$i]['bnm_tz_utcoffset'], $timeZone->getName())));
            }
            /*for($i=0;$i<count($all_notice_data['notice_data_intrash']);$i++){
                $all_notice_data['notice_data_intrash'][$i]['bnm_closing_date'] = Common::convertTimezone($all_notice_data['notice_data_intrash'][$i]['bnm_closing_date'],$all_notice_data['notice_data_intrash'][$i]['bnm_tz_utcoffset'], $timeZone->getName());
            }*/
            // $all_notice_data['total_notice_data'] = $provider->getTotalCount();
            if($datasfor=='notice'||$datasfor=='awards'){
                if($datasfor=='notice'){
                    $all_notice_data['total_notice_data'] = $provider->getTotalCount();
                }
                else{
                    $all_notice_data['total_notice_data'] = BcastnotifdtlsTbl::find()->innerJoin('bcastnotifmst_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk')->where("bnm_msgstatus=1 and bnd_status!=3 and bnm_msgtype=3 and bnd_usermst_fk='".$data['contact']['pk']."'")->count();
                }
                if($datasfor=='awards'){
                    $all_notice_data['total_award_data'] = $provider->getTotalCount();
                }
                else{
                    $all_notice_data['total_award_data'] = BcastnotifdtlsTbl::find()->innerJoin('bcastnotifmst_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk')->where("bnm_msgstatus=1 and bnd_status!=3 and bnm_msgtype=5 and bnd_usermst_fk='".$data['contact']['pk']."'")->count();
                }
            }
            if($datasfor=='trashawards'||$datasfor=='trashnotice'){
                if($datasfor=='trashnotice'){
                    $all_notice_data['total_notice_data'] = $provider->getTotalCount();
                }
                else{
                    $all_notice_data['total_notice_data'] = BcastnotifdtlsTbl::find()->innerJoin('bcastnotifmst_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk')->where("bnm_msgstatus=1 and bnd_status=3 and bnm_msgtype=3 and bnd_usermst_fk='".$data['contact']['pk']."'")->count();
                }
                
                if($datasfor=='trashawards'){
                    $all_notice_data['total_award_data'] = $provider->getTotalCount();
                }
                else{
                    $all_notice_data['total_award_data'] = BcastnotifdtlsTbl::find()->innerJoin('bcastnotifmst_tbl', 'bcastnotifmst_pk = bnd_bcastnotifmst_fk')->where("bnm_msgstatus=1 and bnd_status=3 and bnm_msgtype=5 and bnd_usermst_fk='".$data['contact']['pk']."'")->count();
                }
            }
           
            
           
          
           
            // $all_notice_data['total_notice_data_intrash'] = $provider2->getTotalCount();
          
            // echo '<pre>';print_r($notice_data);exit;
            Yii::$app->response->format = Response::FORMAT_JSON;
            return !empty($all_notice_data) ? $all_notice_data : [];
            // return $this->asJson([
            //     'msg' => "success",
            //     'status' => 1,
            //     'data'=>!empty($all_notice_data) ? $all_notice_data : []
            // ]);
        }
    }
}