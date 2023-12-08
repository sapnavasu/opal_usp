<?php

namespace api\modules\lc\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use app\models\BatchmgmtdtlsTbl;
use app\models\LearnerreghrddtlsTbl;
use DateTime;
use yii\db\ActiveRecord;
use api\components\Security;
use Da\QrCode\QrCode;


class LearnercardController extends MasterController
{

    public $modelClass = 'app\models\BatchmgmtdtlsTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
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

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionGetlearnercard(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;

        $data =  \app\models\LearnercarddtlsTblQuery::getlearnercarddetails($limit, $index, $searchkey);
        return $data;
    }    

    public function actionGetstandardcourse(){
        $project = \app\models\ProjectmstTbl::find()->all();
        $standcourse = \app\models\StandardcoursemstTbl::find()->all();
        $data = [
            'project'=>$project,
            'standcourse'=>$standcourse
        ];
        return $data;
    }

    public function actionGetsinglelearnercard(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $staffId = $request['staffid'];
        $courseid = isset($request['courseid'])? $request['courseid'] : null;

        $data =  \app\models\LearnercarddtlsTblQuery::getsinglelearnercarddetails($staffId, $courseid);
        return $data;
    }  

    public function actionCarddetails(){
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $staffId = $request['staffid'];
        $courseid = $request['courseid'];

        $data =  \app\models\LearnercarddtlsTblQuery::getcarddetails($staffId, $courseid, $limit, $index, $searchkey);
        return $data;        
    }

    public function actionGetsubcategories($courseid){

        $data = \app\models\StandardcoursedtlsTbl::find()
        ->select(['standardcoursedtls_pk','scd_standardcoursemst_fk', 'ccm_catname_en'])
        ->leftJoin('coursecategorymst_tbl', 'scd_subcoursecategorymst_fk = coursecategorymst_pk')
        ->where(["=", "scd_standardcoursemst_fk", $courseid])
        ->orderBy(['ccm_catname_en'=>SORT_ASC])
        ->asArray()->all();
        return $data;

    }

    public function actionGetnationality(){

        $data = \app\models\OpalcountrymstTbl::find()->asArray()->all();
        return $data;

    }

    public function actionEditcard(){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $category = [];
        $expiryDatesub = [];
        $batchid = '';

        $editlcard = \app\models\LearnercarddtlsTbl::find()->where(['=','learnercarddtls_pk',$request['id']])->one();
        $staff = \app\models\StaffinforepoTbl::find()->where(['=', 'staffinforepo_pk', $editlcard->lcd_staffinforepo_fk])->one();
        $stafflincense = \app\models\StafflicensedtlsTbl::find()->where(['=', 'sld_staffinforepo_fk', $editlcard->lcd_staffinforepo_fk])->one();

        if(gettype($request['profileimg']) == 'array' && $staff->sir_photo != $request['profileimg'][0]){
            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query1 = \Yii::$app->db->createCommand("UPDATE staffinforepo_tbl SET  sir_photo = :sir_photo, 
            sir_updatedon = :sir_updatedon, sir_updatedby = :sir_updatedby WHERE staffinforepo_pk = :staffid ")
            ->bindValue(':sir_photo', $request['profileimg'][0])
            ->bindValue(':sir_updatedon', date('Y-m-d H:i:s'))
            ->bindValue(':sir_updatedby', $userPk)
            ->bindValue(':staffid', $editlcard->lcd_staffinforepo_fk)
            ->execute();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            $staff->sir_photo = $request['profileimg'][0];
            if($query1){
               
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($query1);
                die;
            }
        }
        if(empty($stafflincense)){
            if($request['ropnumber']){
                $stafflincensedata = new \app\models\StafflicensedtlsTbl;
                $stafflincensedata->sld_staffinforepo_fk = $editlcard->lcd_staffinforepo_fk;
                $stafflincensedata->sld_ROPlicense = $request['ropnumber'];
                $stafflincensedata->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
                $stafflincensedata->sld_hasROPlightlicense = 1;
                $stafflincensedata->sld_hasROPheavylicense = 1;
                $stafflincensedata->sld_createdon = date('Y-m-d H:i:s');
                $stafflincensedata->sld_createdby = $userPk;
                if($stafflincensedata->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($stafflincensedata->getErrors());
                    die;
                }
            }
        }else{
            $stafflincense->sld_ROPlicense = $request['ropnumber'];
            $stafflincense->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
            $stafflincense->sld_updatedon = date('Y-m-d H:i:s');
            $stafflincense->sld_updatedby = $userPk;
            if($stafflincense->save()){

            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($stafflincense->getErrors());
                die;
            }
        }
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno', $request['batch']])->one();
        if($request['training'] != $batch->bmd_opalmemberregmst_fk){
            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query1 = \Yii::$app->db->createCommand("UPDATE batchmgmtdtls_tbl SET  bmd_opalmemberregmst_fk = :bmd_opalmemberregmst_fk,bmd_updatedon = :bmd_updatedon,
                bmd_updatedby = :bmd_updatedby where batchmgmtdtls_pk = :batchmgmtdtls_pk")
            ->bindValue(':bmd_opalmemberregmst_fk',  $request['training'])
            ->bindValue(':bmd_updatedon', date('Y-m-d H:i:s'))
            ->bindValue(':bmd_updatedby', $userPk)
            ->bindValue(':batchmgmtdtls_pk', $batch->batchmgmtdtls_pk)
            ->execute();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            if($query1){
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($query1->getErrors());
                die;
            }
        }

        
        if($editlcard->lcd_isprinted != $request['mentioned']){
            $category = [];
            $expiryDatesub = [];
            $batchid = '';
            $carddetails =  \app\models\LearnercarddtlsTbl::find()
            ->where(['=', 'lcd_staffinforepo_fk', $editlcard->lcd_staffinforepo_fk])
            ->andwhere(['=','lcd_standardcoursemst_fk', $editlcard->lcd_standardcoursemst_fk])
            ->andwhere(['!=','lcd_status', 4])->asArray()->all();
            foreach($carddetails as $item){
                if($item['lcd_isprinted'] == 1 && $item['learnercarddtls_pk'] != $editlcard->learnercarddtls_pk){
                    $aa = [
                        'cate' => $item['lcd_subcategoryname'],
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($category, $aa);
                    if($item['lcd_cardexpiry']){
                        $bb = [
                            'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    } else{
                        $bb = [
                            'date' => 'N/A',
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    }
                    $batchid = $item['lcd_batchmgmtdtls_fk'];
                }
                if($request['mentioned'] == 1 && $item['learnercarddtls_pk'] == $editlcard->learnercarddtls_pk){
                    $aa = [
                        'cate' => $item['lcd_subcategoryname'],
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($category, $aa);
                    if($request['workdate']){
                        $bb = [
                            'date' => date("d-m-Y", strtotime( $request['workdate'])),
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    } else{
                        $bb = [
                            'date' => 'N/A',
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    }
                    $batchid = $item['lcd_batchmgmtdtls_fk'];
                }
            }
            
            usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
            usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
            $standcourse = \app\models\StandardcoursedtlsTbl::find()->where(['=','standardcoursedtls_pk',$editlcard->lcd_standardcoursedtls_fk])->one();
            $subcategory = \app\models\CoursecategorymstTbl::find()->where(['=','coursecategorymst_pk',$standcourse->scd_subcoursecategorymst_fk])->one();
            $titlesub = $subcategory->ccm_catname_en;
            if($titlesub == 'Heavy Vehicle'){
                $k = 0;
                foreach($carddetails as $item){
                    if($item['lcd_subcategoryname'] == 'Light Vehicle'){

                        $expiryDatesub[$k]['date'] = $request['workdate'] ? date("d-m-Y", strtotime($request['workdate'])) : 'N/A';
                    }
                    $k++;
                }
                
            }



            $staff = \app\models\StaffinforepoTbl::find()->where(['=', 'staffinforepo_pk', $editlcard->lcd_staffinforepo_fk])->one();
            $stafflincense = \app\models\StafflicensedtlsTbl::find()->where(['=', 'sld_staffinforepo_fk', $editlcard->lcd_staffinforepo_fk])->one();

            if($editlcard->lcd_verificationno == '--' || $editlcard->lcd_verificationno == 'OLD-DATA' || empty($editlcard->lcd_verificationno)){
                $learnercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $editlcard->lcd_staffinforepo_fk])
                ->andwhere(['=','lcd_standardcoursemst_fk', $editlcard->lcd_standardcoursemst_fk])
                ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();

                $verification = '';
                if(count($learnercarddata) == 0){
                    $learnercarddata1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])
                    ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                    if(count($learnercarddata1) == 0){
                        $flag = false;
                        while(!$flag){
                            $verification = 'LC'.substr(sha1(time()), 0, 8);
                            $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                            if($isexist == 0){
                                $flag = true;
                            }
                        }
                    }else{
                        $verification = $learnercarddata1[0]['lcd_verificationno'];
                    }
                }else{
                    $verification = $learnercarddata[0]['lcd_verificationno'];
                }

            }else{
                $verification = $editlcard->lcd_verificationno ;
            }



            $userdata=[
                'name'=>$staff->sir_name_en,
                'issuedata'=> date('d-m-Y'),   
                'licNo'=> $stafflincense->sld_ROPlicense ? $stafflincense->sld_ROPlicense : 'Nil',
                'cattable'=>$category,
                'expirytable'=>$expiryDatesub,
                'title' => $editlcard->lcd_standardcoursemst_fk != 1 ? $editlcard->lcd_categoryname : '',
                'nolice' => $editlcard->lcd_standardcoursemst_fk == 1 ? 1 : 0,
                'civilno'=> $staff->sir_idnumber,
                'verificationcode'=> $verification,
            ];
            
            $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
            ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
            ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
            ->where(['memcompfiledtls_pk'=>$staff->sir_photo])->asArray()->one();
            $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
            $userPkf = $file_info['mcfd_uploadedby'];
            $img_name = $file_info['mcfd_sysgenerfilename'];
            $org_name = $file_info['mcfd_origfilename'];
            $phy_filepath = $file_info['fm_phyfilepath'];
            $uploadPath = \Yii::$app->params['uploadPath'];
            $srcDirectory=Yii::$app->params['srcDirectory']; 
            $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
            $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;

            $batch  = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$batchid])->one();
            
            $regPk = $batch->bmd_opalmemberregmst_fk;
            $filename = 'card_'.$editlcard->lcd_standardcoursemst_fk.'_'.$editlcard->lcd_staffinforepo_fk.'_'.$editlcard->lcd_learnerreghrddtls_fk.'_print.pdf';
            $path = "../api/web/learnercard/$regPk/";

            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }

            //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
            $qrCode = (new QrCode(''))
            ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
            $qrCode->writeFile(__DIR__ . '/code.png'); 
            $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
            $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
            //Print PDF generate
            $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
            //$mpdf->SetProtection(array());
            $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
            $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
            $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";

            //View PDF generate
            $filenameview = 'card_'.$editlcard->lcd_standardcoursemst_fk.'_'.$editlcard->lcd_staffinforepo_fk.'_'.$editlcard->lcd_learnerreghrddtls_fk.'_view.pdf';
            $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
            $mpdfview->SetProtection(array());
            $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
            $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
            $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";

            

            foreach($carddetails as $item){
                 $lcard = \app\models\LearnercarddtlsTbl::find()->where(['=','learnercarddtls_pk',$item['learnercarddtls_pk']])->one();
                 if($lcard){
                     $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($lcard->learnercarddtls_pk);
                     if($card){
                         if($item['learnercarddtls_pk'] == $editlcard->learnercarddtls_pk){
                             $newcard = [
                                 'lcd_staffinforepo_fk' => $item['lcd_staffinforepo_fk'],
                                 'lcd_batchmgmtdtls_fk' => $item['lcd_batchmgmtdtls_fk'],
                                 'lcd_learnerreghrddtls_fk' => $item['lcd_learnerreghrddtls_fk'],
                                 'lcd_standardcoursemst_fk' => $item['lcd_standardcoursemst_fk'],
                                 'lcd_standardcoursedtls_fk' => $item['lcd_standardcoursedtls_fk'],
                                 'lcd_categoryname' => $item['lcd_categoryname'],
                                 'lcd_subcategoryname' => $item['lcd_subcategoryname'],
                                 'lcd_isprinted' =>  $request['mentioned'],
                                 'lcd_serialno' => $item['lcd_serialno'],
                                 'lcd_cardexpiry' => $request['workdate'] ? $request['workdate'] : null,
                                 'lcd_cardissuedate' => date('Y-m-d'),
                                 'lcd_plaincard' => $request['mentioned'] == 1 ? $url : null,
                                 'lcd_viewcardpath' => $request['mentioned'] == 1 ? $viewurl : null,
                                 'lcd_verificationno' => $verification,
                                 'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                 'lcd_createdon' => date('Y-m-d H:i:s'),
                                 'lcd_createdby' => $userPk,
                             ];
                         }else{
                             if($titlesub == 'Heavy Vehicle' && $item['lcd_subcategoryname'] == 'Light Vehicle'){
                                 $newcard = [
                                     'lcd_staffinforepo_fk' => $item['lcd_staffinforepo_fk'],
                                     'lcd_batchmgmtdtls_fk' => $item['lcd_batchmgmtdtls_fk'],
                                     'lcd_learnerreghrddtls_fk' => $item['lcd_learnerreghrddtls_fk'],
                                     'lcd_standardcoursemst_fk' => $item['lcd_standardcoursemst_fk'],
                                     'lcd_standardcoursedtls_fk' => $item['lcd_standardcoursedtls_fk'],
                                     'lcd_categoryname' => $item['lcd_categoryname'],
                                     'lcd_subcategoryname' => $item['lcd_subcategoryname'],
                                     'lcd_isprinted' =>  $item['lcd_isprinted'],
                                     'lcd_serialno' => $item['lcd_serialno'],
                                     'lcd_cardexpiry' => $request['workdate'] ? $request['workdate'] : null,
                                     'lcd_cardissuedate' => date('Y-m-d'),
                                     'lcd_plaincard' => $item['lcd_isprinted'] == 1 ? $url : null,
                                     'lcd_viewcardpath' => $item['lcd_isprinted'] == 1 ? $viewurl : null,
                                     'lcd_verificationno' => $verification,
                                     'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                     'lcd_createdon' => date('Y-m-d H:i:s'),
                                     'lcd_createdby' => $userPk,
                                 ];
                             }else{
                                 $newcard = [
                                     'lcd_staffinforepo_fk' => $item['lcd_staffinforepo_fk'],
                                     'lcd_batchmgmtdtls_fk' => $item['lcd_batchmgmtdtls_fk'],
                                     'lcd_learnerreghrddtls_fk' => $item['lcd_learnerreghrddtls_fk'],
                                     'lcd_standardcoursemst_fk' => $item['lcd_standardcoursemst_fk'],
                                     'lcd_standardcoursedtls_fk' => $item['lcd_standardcoursedtls_fk'],
                                     'lcd_categoryname' => $item['lcd_categoryname'],
                                     'lcd_subcategoryname' => $item['lcd_subcategoryname'],
                                     'lcd_isprinted' =>  $item['lcd_isprinted'],
                                     'lcd_serialno' => $item['lcd_serialno'],
                                     'lcd_cardexpiry' => $item['lcd_cardexpiry'],
                                     'lcd_cardissuedate' => date('Y-m-d'),
                                     'lcd_plaincard' => $item['lcd_isprinted'] == 1 ? $url : null,
                                     'lcd_viewcardpath' => $item['lcd_isprinted'] == 1 ? $viewurl : null,
                                     'lcd_verificationno' => $verification,
                                     'lcd_status' => $item['lcd_cardexpiry'] ? (strtotime($item['lcd_cardexpiry']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                     'lcd_createdon' => date('Y-m-d H:i:s'),
                                     'lcd_createdby' => $userPk,
                                 ];
                             }
     
                         }
     
                         $ncard = new \app\models\LearnercarddtlsTbl($newcard);
                         
                         if($ncard->save()){
     
                         }else{
                             $transaction->rollBack();
                             echo "<pre>";
                             print_r($ncard->getErrors());
                             die;
                         }
                     }else{
                         $transaction->rollBack();
                         echo "<pre>";
                         print_r($card->getErrors());
                         die;
                     }
                 }
            }
            $transaction->commit();
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Card Generated successfully" ];
        }else{
            $standcourse = \app\models\StandardcoursedtlsTbl::find()->where(['=','standardcoursedtls_pk',$editlcard->lcd_standardcoursedtls_fk])->one();
            $subcategory = \app\models\CoursecategorymstTbl::find()->where(['=','coursecategorymst_pk',$standcourse->scd_subcoursecategorymst_fk])->one();
            $titlesub = $subcategory->ccm_catname_en;
            $learnercards = \app\models\LearnercarddtlsTbl::find()
            ->where(['lcd_status'=>1])
            ->orwhere(['lcd_status'=>2])
            ->andwhere(['!=','learnercarddtls_pk', $editlcard->learnercarddtls_pk])
            ->andwhere(['lcd_staffinforepo_fk' => $editlcard->lcd_staffinforepo_fk])
            ->andwhere(['lcd_standardcoursemst_fk'=>$editlcard->lcd_standardcoursemst_fk])
            ->orderBy(['lcd_standardcoursedtls_fk'=>SORT_ASC])->asArray()->all();
            //if($request['mentioned'] == 1){
                $category = [];
                $expiryDatesub = [];
                foreach($learnercards as $item){
                    if($item['lcd_isprinted'] == 1){
                        $aa = [
                            'cate' => $item['lcd_subcategoryname'],
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($category, $aa);
                        if($item['lcd_cardexpiry']){
                            $bb = [
                                'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                                'id' => $item['lcd_standardcoursedtls_fk'],
                            ];
                            array_push($expiryDatesub,$bb);
                        } else{
                            $bb = [
                                'date' => 'N/A',
                                'id' => $item['lcd_standardcoursedtls_fk'],
                            ];
                            array_push($expiryDatesub,$bb);
                        }
                    }
                }
                if($request['mentioned'] == 1){
                    $aa = [
                        'cate' => $editlcard->lcd_subcategoryname,
                        'id' => $editlcard->lcd_standardcoursedtls_fk,
                    ];
                    array_push($category, $aa);
                    if($request['workdate']){
                        $bb = [
                            'date' => date("d-m-Y", strtotime( $request['workdate'])),
                            'id' => $editlcard->lcd_standardcoursedtls_fk,
                        ];
                        array_push($expiryDatesub,$bb);
                    } else{
                        $bb = [
                            'date' => 'N/A',
                            'id' => $editlcard->lcd_standardcoursedtls_fk,
                        ];
                        array_push($expiryDatesub,$bb);
                    }

                }
                $batchid = $editlcard->lcd_batchmgmtdtls_fk;
                
                usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                if($titlesub == 'Heavy Vehicle'){
                    $k = 0;
                    foreach($learnercards as $item){ 
                        if($item['lcd_subcategoryname'] == 'Light Vehicle'){
                            $expiryDatesub[$k]['date'] = $request['workdate'] ? date("d-m-Y", strtotime($request['workdate'])) : 'N/A';
                        }
                        $k++;
                    }
                    
                }
               
                if($editlcard->lcd_verificationno == '--' || $editlcard->lcd_verificationno == 'OLD-DATA' || empty($editlcard->lcd_verificationno)){
                    $learnercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $editlcard->lcd_staffinforepo_fk])
                    ->andwhere(['=','lcd_standardcoursemst_fk', $editlcard->lcd_standardcoursemst_fk])
                    ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
    
                    $verification = '';
                    if(count($learnercarddata) == 0){
                        $learnercarddata1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])
                        ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                        if(count($learnercarddata1) == 0){
                            $flag = false;
                            while(!$flag){
                                $verification = 'LC'.substr(sha1(time()), 0, 8);
                                $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                                if($isexist == 0){
                                    $flag = true;
                                }
                            }
                        }else{
                            $verification = $learnercarddata1[0]['lcd_verificationno'];
                        }
                    }else{
                        $verification = $learnercarddata[0]['lcd_verificationno'];
                    }
    
                }else{
                    $verification = $editlcard->lcd_verificationno ;
                }
                
                $userdata=[
                    'name'=>$staff->sir_name_en,
                    'issuedata'=> date('d-m-Y'),   
                    'licNo'=> $request['ropnumber'] ? $request['ropnumber'] : 'Nil',
                    'cattable'=>$category,
                    'expirytable'=>$expiryDatesub,
                    'title' => $editlcard->lcd_standardcoursemst_fk != 1 ? $editlcard->lcd_categoryname : '',
                    'nolice' => $editlcard->lcd_standardcoursemst_fk == 1 ? 1 : 0,
                    'civilno'=> $staff->sir_idnumber,
                    'verificationcode'=> $verification,
                ];
                $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                ->where(['memcompfiledtls_pk'=>$staff->sir_photo])->asArray()->one();
                $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
                $userPkf = $file_info['mcfd_uploadedby'];
                $img_name = $file_info['mcfd_sysgenerfilename'];
                $org_name = $file_info['mcfd_origfilename'];
                $phy_filepath = $file_info['fm_phyfilepath'];
                $uploadPath = \Yii::$app->params['uploadPath'];
                $srcDirectory=Yii::$app->params['srcDirectory']; 
                $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
                $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
        
                $batch  = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$batchid])->one();
                $regPk = $batch->bmd_opalmemberregmst_fk;
                $filename = 'card_'.$editlcard->lcd_standardcoursemst_fk.'_'.$staff->staffinforepo_pk.'_'.$editlcard->lcd_learnerreghrddtls_fk.'_print.pdf';
                $path = "../api/web/learnercard/$regPk/";
                if(!is_dir($path)){
                    mkdir($path, 0777, true);
                }
    
                //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
                $qrCode = (new QrCode(''))
                ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
                $qrCode->writeFile(__DIR__ . '/code.png'); 
                $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
                $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
                //Print PDF generate
                $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                //$mpdf->SetProtection(array());
                $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
                $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";
        
                //View PDF generate
                $filenameview = 'card_'.$editlcard->lcd_standardcoursemst_fk.'_'.$staff->staffinforepo_pk.'_'.$editlcard->lcd_learnerreghrddtls_fk.'_view.pdf';
                $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                $mpdfview->SetProtection(array());
                $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
                $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
            
    
            if($titlesub == 'Heavy Vehicle'){

                foreach($learnercards as $item){ 
                    if($item['lcd_subcategoryname'] == 'Light Vehicle'){
                       
                        $lightcard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                        $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                        $lightcard1 = [
                            'lcd_staffinforepo_fk' => $lightcard->lcd_staffinforepo_fk,
                            'lcd_batchmgmtdtls_fk' => $lightcard->lcd_batchmgmtdtls_fk,
                            'lcd_learnerreghrddtls_fk' => $lightcard->lcd_learnerreghrddtls_fk,
                            'lcd_standardcoursemst_fk' => $lightcard->lcd_standardcoursemst_fk,
                            'lcd_standardcoursedtls_fk' => $lightcard->lcd_standardcoursedtls_fk,
                            'lcd_categoryname' => $lightcard->lcd_categoryname,
                            'lcd_subcategoryname' => $lightcard->lcd_subcategoryname,
                            'lcd_isprinted' =>  $lightcard->lcd_isprinted,
                            'lcd_serialno' => $lightcard->lcd_serialno,
                            'lcd_cardexpiry' => $request['workdate'] ? $request['workdate'] : null,
                            'lcd_cardissuedate' => date('Y-m-d'),
                            'lcd_plaincard' => $lightcard->lcd_isprinted == 1 ?   $url : null,
                            'lcd_viewcardpath' => $lightcard->lcd_isprinted == 1 ?  $viewurl : null,
                            'lcd_verificationno' => $verification,
                            'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                            'lcd_createdon' => date('Y-m-d H:i:s'),
                            'lcd_createdby' => $userPk,
                        ];
                        $ligncard = new \app\models\LearnercarddtlsTbl($lightcard1);
                        if($ligncard->save()){
                            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($ligncard->getErrors());
                            die;
                        }
                    }else{
                        $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                        if( $verification != $card1->lcd_verificationno){

                            $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                            $vcard = [
                                'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                                'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                                'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                                'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                                'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                                'lcd_categoryname' => $card1->lcd_categoryname,
                                'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                                'lcd_isprinted' =>  $card1->lcd_isprinted,
                                'lcd_serialno' => $card1->lcd_serialno,
                                'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                                'lcd_cardissuedate' => date('Y-m-d'),
                                'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                                'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                                'lcd_verificationno' => $verification,
                                'lcd_status' => $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                'lcd_createdon' => date('Y-m-d H:i:s'),
                                'lcd_createdby' => $userPk,
                            ];
                            $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                            if($vercard->save()){
                
                            }else{
                                $transaction->rollBack();
                                echo "<pre>";
                                print_r($vercard->getErrors());
                                die;
                            }
                        }
                    }
                    $k++;
                }
                
            }else{
                foreach($learnercards as $item){ 
                    $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                    if( $verification != $card1->lcd_verificationno){
                        $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                        $vcard = [
                            'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                            'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                            'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                            'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                            'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                            'lcd_categoryname' => $card1->lcd_categoryname,
                            'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                            'lcd_isprinted' =>  $card1->lcd_isprinted,
                            'lcd_serialno' => $card1->lcd_serialno,
                            'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                            'lcd_cardissuedate' => date('Y-m-d'),
                            'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                            'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                            'lcd_verificationno' => $verification,
                            'lcd_status' =>  $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                            'lcd_createdon' => date('Y-m-d H:i:s'),
                            'lcd_createdby' => $userPk,
                        ];
                        $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                        if($vercard->save()){
            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($vercard->getErrors());
                            die;
                        }
                    }
                }
            }
            $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($editlcard->learnercarddtls_pk);
            if($card){
    
                $newcard = [
                    'lcd_staffinforepo_fk' => $editlcard->lcd_staffinforepo_fk,
                    'lcd_batchmgmtdtls_fk' => $editlcard->lcd_batchmgmtdtls_fk,
                    'lcd_learnerreghrddtls_fk' => $editlcard->lcd_learnerreghrddtls_fk,
                    'lcd_standardcoursemst_fk' => $editlcard->lcd_standardcoursemst_fk,
                    'lcd_standardcoursedtls_fk' => $editlcard->lcd_standardcoursedtls_fk,
                    'lcd_categoryname' => $editlcard->lcd_categoryname,
                    'lcd_subcategoryname' => $editlcard->lcd_subcategoryname,
                    'lcd_isprinted' =>  $request['mentioned'],
                    'lcd_serialno' => $editlcard->lcd_serialno,
                    'lcd_cardexpiry' => $request['workdate'] ? $request['workdate'] : Null,
                    'lcd_cardissuedate' => date('Y-m-d'),
                    'lcd_plaincard' => $request['mentioned'] == 1 ? $url : null,
                    'lcd_viewcardpath' => $request['mentioned'] == 1 ? $viewurl : null,
                    'lcd_verificationno' => $verification,
                    'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                    'lcd_createdon' => date('Y-m-d H:i:s'),
                    'lcd_createdby' => $userPk,
                ];
                $ncard = new \app\models\LearnercarddtlsTbl($newcard);
                
                if($ncard->save()){
                    $transaction->commit();
                    return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Card Generated successfully" ];
    
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($ncard->getErrors());
                    die;
                }
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($card->getErrors());
                die;
            }
        }
    }

    public function actionSaveandgeneratercard(){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $staffdata = \app\models\StaffinforepoTbl::find()->where(['=', 'staffinforepo_pk', $request['staffid']])->one();//test22
        $lincedata = \app\models\StafflicensedtlsTbl::find()->where(['=','sld_staffinforepo_fk',$request['staffid']])->one();
        $civilnu = '';
        
        if($staffdata->sir_idnumber != $request['crNumber']){
            $alstaff = \app\models\StaffinforepoTbl::find()->where(['=', 'sir_idnumber', $request['crNumber']])->one();//test1
            
            if($alstaff){
                $data =  \app\models\LearnercarddtlsTblQuery::changecivilnumber($request['crNumber'],$staffdata->sir_idnumber);
                
                $civilnu = $alstaff->sir_idnumber;
                $request['staffid'] = $alstaff->staffinforepo_pk;//test1
                $staffdata = $alstaff;
                $lincedata = \app\models\StafflicensedtlsTbl::find()->where(['=','sld_staffinforepo_fk',$request['staffid']])->one();
            }
        }
        $phote = empty($civilnu) ? gettype($request['uploaded']) == 'array' ? $request['uploaded'][0] : $request['uploaded'] : $alstaff->sir_photo;
        
        if(empty($civilnu)){

            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query1 = \Yii::$app->db->createCommand("UPDATE staffinforepo_tbl SET  sir_idnumber = :sir_idnumber,sir_gender = :sir_gender,
             sir_name_en = :sir_name_en, sir_name_ar = :sir_name_ar, sir_dob = :sir_dob, sir_photo = :sir_photo, sir_nationality = :sir_nationality,
             sir_updatedon = :sir_updatedon, sir_updatedby = :sir_updatedby WHERE staffinforepo_pk = :staffid ")
            ->bindValue(':sir_idnumber',  !empty($civilnu) ?  $civilnu : $request['crNumber'])
            ->bindValue(':sir_name_en', $request['learname'])
            ->bindValue(':sir_name_ar', $request['learnamearabic'])
            ->bindValue(':sir_dob', $request['date_birth'])
            ->bindValue(':sir_gender', $request['gender'])
            ->bindValue(':sir_photo', $phote)
            ->bindValue(':sir_nationality', $request['national'])
            ->bindValue(':sir_updatedon', date('Y-m-d H:i:s'))
            ->bindValue(':sir_updatedby', $userPk)
            ->bindValue(':staffid', $request['staffid'])
            ->execute();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    
            if($query1) {
            }
            else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($query1->getErrors());
                die;
            }
            if(!empty($lincedata)){
                $lincedata->sld_ROPlicense = $request['ropnumber'] ? $request['ropnumber'] : null;
                $lincedata->sld_ROPlicenseupload = count($request['roplicen_se']) == 0 ? null : count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) : $request['roplicen_se'][0] ;
                $lincedata->sld_updatedon=date('Y-m-d H:i:s');          
                $lincedata->sld_updatedby=$userPk;
                if($lincedata->save()) {
    
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($lincedata->getErrors());
                    die;
                }
            }else{
                if($request['ropnumber']){
                    $stafflincense = new \app\models\StafflicensedtlsTbl;
                    $stafflincense->sld_staffinforepo_fk = $request['staffid'];
                    $stafflincense->sld_ROPlicense = $request['ropnumber'];
                    $stafflincense->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
                    $stafflincense->sld_hasROPlightlicense = 1;
                    $stafflincense->sld_hasROPheavylicense = 1;
                    $stafflincense->sld_createdon = date('Y-m-d H:i:s');
                    $stafflincense->sld_createdby = $userPk;
                    if($stafflincense->save()){
    
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($stafflincense->getErrors());
                        die;
                    }
                }
            }
        }
        
        // if($pdfgen){
        $category = [];
        $expiryDatesub = [];
        $batchid = '';
        $standardcoursemst = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$request['courseid']])->one();
        $carddetails =  \app\models\LearnercarddtlsTbl::find()
        ->andwhere(['=', 'lcd_staffinforepo_fk', $request['staffid']])
        ->andwhere(['=','lcd_standardcoursemst_fk', $request['courseid']])
        ->andwhere(['!=','lcd_status', 4])->asArray()->all();
        
        foreach($carddetails as $item){
            if($item['lcd_isprinted'] == 1){
                $aa = [
                    'cate' => $item['lcd_subcategoryname'],
                    'id' => $item['lcd_standardcoursedtls_fk'],
                ];
                array_push($category, $aa);
                if($item['lcd_cardexpiry']){
                    $bb = [
                        'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($expiryDatesub,$bb);
                } else{
                    $bb = [
                        'date' => 'N/A',
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($expiryDatesub,$bb);
                }
                $batchid = $item['lcd_batchmgmtdtls_fk'];
            }
        }
        
        usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
        usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
        if($request['verifiednumber'] == '--' || $request['verifiednumber'] == 'OLD-DATA' || empty($request['verifiednumber'])){
            $learnercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])->andwhere(['=','lcd_standardcoursemst_fk', $request['courseid']])
            ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();

            $verification = '';
            if(count($learnercarddata) == 0){
                $learnercarddata1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])
                ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                if(count($learnercarddata1) == 0){
                    $flag = false;
                    while(!$flag){
                        $verification = 'LC'.substr(sha1(time()), 0, 8);
                        $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                        if($isexist == 0){
                            $flag = true;
                        }
                    }
                }else{
                    $verification = $learnercarddata1[0]['lcd_verificationno'];
                }
            }else{
                $verification = $learnercarddata[0]['lcd_verificationno'];
            }

        }else{
            $verification = $request['verifiednumber'] ;
        }

        $userdata=[
            'name'=> empty($civilnu) ? $request['learname'] : $alstaff->sir_name_en ,
            'issuedata'=> date('d-m-Y'),   
            'licNo'=> $request['ropnumber'] ? $request['ropnumber'] : 'Nil',
            'cattable'=>$category,
            'expirytable'=>$expiryDatesub,
            'title' => $standardcoursemst->standardcoursemst_pk != 1 ? $standardcoursemst->scm_coursename_en : '',
            'nolice' => $standardcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
            'civilno'=> $request['crNumber'],
            'verificationcode'=> $verification ,
        ];
        
        $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
        ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
        ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
        ->where(['memcompfiledtls_pk'=>$phote])->asArray()->one();
        $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
        $userPkf = $file_info['mcfd_uploadedby'];
        $img_name = $file_info['mcfd_sysgenerfilename'];
        $org_name = $file_info['mcfd_origfilename'];
        $phy_filepath = $file_info['fm_phyfilepath'];
        $uploadPath = \Yii::$app->params['uploadPath'];
        $srcDirectory=Yii::$app->params['srcDirectory']; 
        $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
        $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
        
        $batch  = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$batchid])->one();
        $regPk = $batch->bmd_opalmemberregmst_fk;
        $filename = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$request['staffid'].'_print.pdf';
        $path = "../api/web/learnercard/$regPk/";

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        
        //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
        $qrCode = (new QrCode(''))
        ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
        $qrCode->writeFile(__DIR__ . '/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
        $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
        //Print PDF generate
        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        //$mpdf->SetProtection(array());
        $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
        $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
        $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";

        //View PDF generate
        $filenameview = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$request['staffid'].'_view.pdf';
        $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        $mpdfview->SetProtection(array());
        $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
        $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
        $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
        

        foreach($carddetails as $item){
            $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
            if($card){

                $newcard = [
                    'lcd_staffinforepo_fk' => $item['lcd_staffinforepo_fk'],
                    'lcd_batchmgmtdtls_fk' => $item['lcd_batchmgmtdtls_fk'],
                    'lcd_learnerreghrddtls_fk' => $item['lcd_learnerreghrddtls_fk'],
                    'lcd_standardcoursemst_fk' => $item['lcd_standardcoursemst_fk'],
                    'lcd_standardcoursedtls_fk' => $item['lcd_standardcoursedtls_fk'],
                    'lcd_categoryname' => $item['lcd_categoryname'],
                    'lcd_subcategoryname' => $item['lcd_subcategoryname'],
                    'lcd_isprinted' =>  $item['lcd_isprinted'],
                    'lcd_serialno' => $item['lcd_serialno'],
                    'lcd_cardexpiry' => $item['lcd_cardexpiry'],
                    'lcd_cardissuedate' => date('Y-m-d'),
                    'lcd_plaincard' => $item['lcd_isprinted'] == 1 ? $url : null,
                    'lcd_viewcardpath' => $item['lcd_isprinted'] == 1 ? $viewurl : null,
                    'lcd_verificationno' =>  $verification,
                    'lcd_status' => $item['lcd_cardexpiry'] ? (strtotime($item['lcd_cardexpiry']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                    'lcd_createdon' => date('Y-m-d H:i:s'),
                    'lcd_createdby' => $userPk,
                ];
                $ncard = new \app\models\LearnercarddtlsTbl($newcard);
                
                if($ncard->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($ncard->getErrors());
                    die;
                }
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($card->getErrors());
                die;
            }
        }
        $transaction->commit();
        return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Card Generated successfully" ];
        
    }

    public function actionGetbatchnumber($batchno, $courseid){
        $data = \app\models\BatchmgmtdtlsTbl::find()->select(['batchmgmtdtls_pk', 'bmd_Batchno'])
        ->leftjoin('standardcoursedtls_tbl S', 'S.standardcoursedtls_pk = bmd_standardcoursedtls_fk')
        ->leftjoin('standardcoursemst_tbl SM', 'SM.standardcoursemst_pk = S.scd_standardcoursemst_fk')
        ->where(['=','SM.standardcoursemst_pk', $courseid])
        ->andwhere(['LIKE','bmd_Batchno',$batchno])->asArray()->all();
        return $data;
    }

    public function actionGettrainingcenter($batchid){
        $data = \app\models\OpalmemberregmstTbl::find()->select(['opalmemberregmst_pk', 'omrm_tpname_en', 'omrm_tpname_ar']);
        if($batchid != 'null'){
            $data->leftjoin('batchmgmtdtls_tbl a','a.bmd_opalmemberregmst_fk = opalmemberregmst_pk')->where(['=','a.batchmgmtdtls_pk',$batchid]);

        }
        $result = $data->andWhere(['not', ['omrm_tpname_en' => null]])->orderby('omrm_tpname_en asc')->asArray()->all();
        return $result;
    }

    public function actionAlreadyexistsubcategorycard($staffid, $categoryid){
        $data = \app\models\LearnercarddtlsTbl::find()->where(['=','lcd_standardcoursedtls_fk',$categoryid])
        ->andwhere(['=','lcd_staffinforepo_fk',$staffid])
        ->andwhere(['!=','lcd_status',4])->one();
        return $data;
    }

    public function actionAddsubcategory(){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $standcourse = \app\models\StandardcoursedtlsTbl::find()->where(['=','standardcoursedtls_pk',$request['subcate']])->one();
        $standcoursemst = \app\models\StandardcoursemstTbl::find()->where(['=','standardcoursemst_pk',$standcourse->scd_standardcoursemst_fk])->one();
        $staff = \app\models\StaffinforepoTbl::find()->where(['=', 'staffinforepo_pk', $request['staffid']])->one();
        $stafflincense = \app\models\StafflicensedtlsTbl::find()->where(['=', 'sld_staffinforepo_fk', $request['staffid']])->one();
        $memreg = $request['training'] ? $request['training'] : 0;
        $batchid = '';
        if(gettype($request['profileimg']) == 'array' && $staff->sir_photo != $request['profileimg'][0]){
            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query1 = \Yii::$app->db->createCommand("UPDATE staffinforepo_tbl SET  sir_photo = :sir_photo, 
            sir_updatedon = :sir_updatedon, sir_updatedby = :sir_updatedby WHERE staffinforepo_pk = :staffid ")
            ->bindValue(':sir_photo', $request['profileimg'][0])
            ->bindValue(':sir_updatedon', date('Y-m-d H:i:s'))
            ->bindValue(':sir_updatedby', $userPk)
            ->bindValue(':staffid', $request['staffid'])
            ->execute();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            $staff->sir_photo = $request['profileimg'][0];
            if($query1){
               
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($query1);
                die;
            }
        }
        if(empty($stafflincense)){
            if($request['ropnumber']){
                $stafflincensedata = new \app\models\StafflicensedtlsTbl;
                $stafflincensedata->sld_staffinforepo_fk = $request['staffid'];
                $stafflincensedata->sld_ROPlicense = $request['ropnumber'];
                $stafflincensedata->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
                $stafflincensedata->sld_hasROPlightlicense = 1;
                $stafflincensedata->sld_hasROPheavylicense = 1;
                $stafflincensedata->sld_createdon = date('Y-m-d H:i:s');
                $stafflincensedata->sld_createdby = $userPk;
                if($stafflincensedata->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($stafflincensedata->getErrors());
                    die;
                }
            }
        }else{
            $stafflincense->sld_ROPlicense = $request['ropnumber'];
            $stafflincense->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
            $stafflincense->sld_updatedon = date('Y-m-d H:i:s');
            $stafflincense->sld_updatedby = $userPk;
            if($stafflincense->save()){

            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($stafflincense->getErrors());
                die;
            }
        }
        if(!$request['batch']){
            $batchno = \app\models\BatchmgmtdtlsTbl::newBatchRefNo($request['subcate'], 24,$memreg,true);
            
            $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
            bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
            VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
            :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
            ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
            ->bindValue(':bmd_appinstinfomain_fk', 0)
            ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
            ->bindValue(':bmd_standardcoursedtls_fk', $request['subcate'])
            ->bindValue(':bmd_Batchno', $batchno)
            ->bindValue(':bmd_batchtype', 24)
            ->bindValue(':bmd_traininglang', 27)
            ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
            ->bindValue(':bmd_comment', null)
            ->bindValue(':bmd_status', 8)
            ->bindValue(':bmd_reqstatus', null)
            ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
            ->bindValue(':bmd_createdby', $userPk)
            ->bindValue(':bmd_creationtype', 1)
            ->execute();
            $batchid = \Yii::$app->db->getLastInsertID();
            $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

            if($query){
                

            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($batch->getErrors());
                die;
            }
        } else{
            $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$request['batch']['batchmgmtdtls_pk']])->andwhere(['=','bmd_standardcoursedtls_fk',$request['subcate']])->one();
            if(empty($batch)){
                $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
                bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
                VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
                :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
                ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
                ->bindValue(':bmd_appinstinfomain_fk', 0)
                ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
                ->bindValue(':bmd_standardcoursedtls_fk', $request['subcate'])
                ->bindValue(':bmd_Batchno', $request['batchno'])
                ->bindValue(':bmd_batchtype', 24)
                ->bindValue(':bmd_traininglang', 27)
                ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
                ->bindValue(':bmd_comment', null)
                ->bindValue(':bmd_status', 8)
                ->bindValue(':bmd_reqstatus', null)
                ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
                ->bindValue(':bmd_createdby', $userPk)
                ->bindValue(':bmd_creationtype', 2)
                ->execute();
                $batchid = \Yii::$app->db->getLastInsertID();
                $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    
                if($query){
                    
    
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($batch->getErrors());
                    die;
                }
            }else{
                $batchid = $batch->batchmgmtdtls_pk;
            }
        }

        $learner = \app\models\LearnerreghrddtlsTbl::find()->where(['=','lrhd_batchmgmtdtls_fk',$batchid])->andwhere(['=','lrhd_staffinforepo_fk', $request['staffid']])->one();
        if(!$learner){
            $qq = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
            $query1 = \Yii::$app->db->createCommand("INSERT INTO learnerreghrddtls_tbl (lrhd_opalmemberregmst_fk, lrhd_batchmgmtdtls_fk, lrhd_staffinforepo_fk,
            Irhd_emailid, Irhd_projectmst_fk, lrhd_learnerfee, lrhd_feestatus, lrhd_paidby, lrhd_status, lrhd_createdon,lrhd_createdby, lrhd_operatorname, lrhd_appdeccomments,lrhd_appdecon, lrhd_appdecby   ) 
            VALUES (:lrhd_opalmemberregmst_fk, :lrhd_batchmgmtdtls_fk, :lrhd_staffinforepo_fk, :Irhd_emailid, :Irhd_projectmst_fk, 
            :lrhd_learnerfee, :lrhd_feestatus, :lrhd_paidby, :lrhd_status, :lrhd_createdon, :lrhd_createdby, :lrhd_operatorname, :lrhd_appdeccomments, :lrhd_appdecon, :lrhd_appdecby)")
            ->bindValue(':lrhd_opalmemberregmst_fk', $memreg)
            ->bindValue(':lrhd_batchmgmtdtls_fk', $batchid)
            ->bindValue(':lrhd_staffinforepo_fk', $request['staffid'])
            ->bindValue(':Irhd_emailid', $staff->sir_emailid)
            ->bindValue(':Irhd_projectmst_fk', 2)
            ->bindValue(':lrhd_learnerfee', 0)
            ->bindValue(':lrhd_feestatus', 1)
            ->bindValue(':lrhd_paidby', null)
            ->bindValue(':lrhd_status', 10)
            ->bindValue(':lrhd_createdon', date('Y-m-d H:i:s'))
            ->bindValue(':lrhd_createdby', $userPk)
            ->bindValue(':lrhd_operatorname', null)
            ->bindValue(':lrhd_appdeccomments', null)
            ->bindValue(':lrhd_appdecon', null)
            ->bindValue(':lrhd_appdecby', null)
            ->execute();
            $learnerid = \Yii::$app->db->getLastInsertID();
            $qq1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
            if($query1){
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($query1->getErrors());
                die;
            }

        }else{

            $learnerid = $learner->learnerreghrddtls_pk;
            $learner->lrhd_status = 10;
            $learner->lrhd_updatedon = date('Y-m-d H:i:s');
            $learner->lrhd_updatedby = $userPk;
            if($learner->save()){
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($learner->getErrors());
                die;
            }
        }
        $subcategory = \app\models\CoursecategorymstTbl::find()->where(['=','coursecategorymst_pk',$standcourse->scd_subcoursecategorymst_fk])->one();
        $learnercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])->andwhere(['=','lcd_standardcoursemst_fk', $standcoursemst->standardcoursemst_pk])
        ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();

        $verification = '';
        if(count($learnercarddata) == 0){
            $learnercarddata1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])
            ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
            if(count($learnercarddata1) == 0){
                $flag = false;
                while(!$flag){
                    $verification = 'LC'.substr(sha1(time()), 0, 8);
                    $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                    if($isexist == 0){
                        $flag = true;
                    }
                }
            }else{
                $verification = $learnercarddata1[0]['lcd_verificationno'];
            }
        }else{
            $verification = $learnercarddata[0]['lcd_verificationno'];
        }

        $learnercards = \app\models\LearnercarddtlsTbl::find()
        ->where(['lcd_status'=>1])
        ->orwhere(['lcd_status'=>2])
        //->andwhere(['lcd_isprinted'=>1])
        ->andwhere(['lcd_staffinforepo_fk' => $request['staffid']])
        ->andwhere(['lcd_standardcoursemst_fk'=>$standcoursemst->standardcoursemst_pk])
        ->orderBy(['lcd_standardcoursedtls_fk'=>SORT_ASC])->asArray()->all();
        $titlesub = $subcategory->ccm_catname_en;
       // if($request['mentioned'] == 1){


            $category = [];
            $expiryDatesub = [];
            foreach($learnercards as $item){
                if($item["lcd_isprinted"] == 1){
                    $aa = [
                        'cate' => $item['lcd_subcategoryname'],
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($category, $aa);
                    if($item['lcd_cardexpiry']){
                        $bb = [
                            'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    } else{
                        $bb = [
                            'date' => 'N/A',
                            'id' => $item['lcd_standardcoursedtls_fk'],
                        ];
                        array_push($expiryDatesub,$bb);
                    }

                }
            }
            if($request['mentioned'] == 1){
                $aa1 = [
                    'cate' => $subcategory->ccm_catname_en,
                    'id' => $request['subcate'],
                ];
                array_push($category, $aa1);
                if($request['workdate']){
                    $bb = [
                        'date' => date("d-m-Y", strtotime( $request['workdate'])),
                        'id' => $request['subcate'],
                    ];
                    array_push($expiryDatesub,$bb);
                } else{
                    $bb = [
                        'date' => 'N/A',
                        'id' => $request['subcate'],
                    ];
                    array_push($expiryDatesub,$bb);
    
                }

            }
            usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
            usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
            
            if($titlesub == 'Heavy Vehicle'){
                $k = 0;
                foreach($learnercards as $item){
                    if($item['lcd_subcategoryname'] == 'Light Vehicle'){

                        $expiryDatesub[$k]['date'] = $request['workdate'] ? date("d-m-Y", strtotime($request['workdate'])) : 'N/A';
                        
                    }
                    $k++;
                }
                
            }

            $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                        ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                        ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                        ->where(['memcompfiledtls_pk'=>$staff->sir_photo])->asArray()->one();
                        $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
                        $userPkf = $file_info['mcfd_uploadedby'];
                        $img_name = $file_info['mcfd_sysgenerfilename'];
                        $org_name = $file_info['mcfd_origfilename'];
                        $phy_filepath = $file_info['fm_phyfilepath'];
                        $uploadPath = \Yii::$app->params['uploadPath'];
                        $srcDirectory=Yii::$app->params['srcDirectory']; 
                        $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
                        $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;


            $userdata=[
                'name'=>$staff->sir_name_en ? $staff->sir_name_en : 'Nil',
                'issuedata'=> date('d-m-Y'),   
                'licNo'=> $request['ropnumber'] ? $request['ropnumber'] : 'Nil',
                'cattable'=>$category,
                'expirytable'=>$expiryDatesub,
                'title' => $standcoursemst->standardcoursemst_pk != 1 ? $standcoursemst->scm_coursename_en : '',
                'nolice' => $standcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
                'civilno'=> $staff->sir_idnumber,
                'verificationcode'=> $verification,
            ];

            $regPk = $batch->bmd_opalmemberregmst_fk ? $batch->bmd_opalmemberregmst_fk : $memreg;
            $filename = 'card_'.$standcoursemst->standardcoursemst_pk.'_'.$staff->staffinforepo_pk.'_'.$learnerid.'_print.pdf';
            $path = "../api/web/learnercard/$regPk/";
            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }

            //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
            $qrCode = (new QrCode(''))
            ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
            $qrCode->writeFile(__DIR__ . '/code.png'); 
            $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
            $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
            //Print PDF generate
            $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
            //$mpdf->SetProtection(array());
            $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
            $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
            $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";
    
            //View PDF generate
            $filenameview = 'card_'.$standcoursemst->standardcoursemst_pk.'_'.$staff->staffinforepo_pk.'_'.$learnerid.'_view.pdf';
            $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
            $mpdfview->SetProtection(array());
            $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
            $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
            $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
        
        
        if($titlesub == 'Heavy Vehicle'){
            foreach($learnercards as $item){
                if($item['lcd_subcategoryname'] == 'Light Vehicle'){

                    $lightcard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                    $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                    $lightcard1 = [
                        'lcd_staffinforepo_fk' => $lightcard->lcd_staffinforepo_fk,
                        'lcd_batchmgmtdtls_fk' => $lightcard->lcd_batchmgmtdtls_fk,
                        'lcd_learnerreghrddtls_fk' => $lightcard->lcd_learnerreghrddtls_fk,
                        'lcd_standardcoursemst_fk' => $lightcard->lcd_standardcoursemst_fk,
                        'lcd_standardcoursedtls_fk' => $lightcard->lcd_standardcoursedtls_fk,
                        'lcd_categoryname' => $lightcard->lcd_categoryname,
                        'lcd_subcategoryname' => $lightcard->lcd_subcategoryname,
                        'lcd_isprinted' => $lightcard->lcd_isprinted,
                        'lcd_serialno' => $lightcard->lcd_serialno,
                        'lcd_cardexpiry' => $request['workdate'] ? $request['workdate'] : null,
                        'lcd_cardissuedate' => date('Y-m-d'),
                        'lcd_plaincard' => $lightcard->lcd_isprinted == 1 ?   $url : null,
                        'lcd_viewcardpath' => $lightcard->lcd_isprinted == 1 ?  $viewurl : null,
                        'lcd_verificationno' => $verification,
                        'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                        'lcd_createdon' => date('Y-m-d H:i:s'),
                        'lcd_createdby' => $userPk,
                    ];
                    $ligncard = new \app\models\LearnercarddtlsTbl($lightcard1);
                    if($ligncard->save()){
                        
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($ligncard->getErrors());
                        die;
                    }
                }else{
                    $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                    if( $verification != $card1->lcd_verificationno){

                        $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                        $vcard = [
                            'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                            'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                            'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                            'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                            'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                            'lcd_categoryname' => $card1->lcd_categoryname,
                            'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                            'lcd_isprinted' =>  $card1->lcd_isprinted,
                            'lcd_serialno' => $card1->lcd_serialno,
                            'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                            'lcd_cardissuedate' => date('Y-m-d'),
                            'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                            'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                            'lcd_verificationno' => $verification,
                            'lcd_status' => $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                            'lcd_createdon' => date('Y-m-d H:i:s'),
                            'lcd_createdby' => $userPk,
                        ];
                        $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                        if($vercard->save()){
            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($vercard->getErrors());
                            die;
                        }
                    }
                }
            }
            
        }else{
            foreach($learnercards as $item){ 
                $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                if( $verification != $card1->lcd_verificationno){

                    $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                    $vcard = [
                        'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                        'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                        'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                        'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                        'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                        'lcd_categoryname' => $card1->lcd_categoryname,
                        'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                        'lcd_isprinted' =>  $card1->lcd_isprinted,
                        'lcd_serialno' => $card1->lcd_serialno,
                        'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                        'lcd_cardissuedate' => date('Y-m-d'),
                        'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                        'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                        'lcd_verificationno' => $verification,
                        'lcd_status' => $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                        'lcd_createdon' => date('Y-m-d H:i:s'),
                        'lcd_createdby' => $userPk,
                    ];
                    $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                    if($vercard->save()){
        
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($vercard->getErrors());
                        die;
                    }
                }
            }
        }
        
        $learnercarddata =  [
            'lcd_staffinforepo_fk' => $request['staffid'],
            'lcd_batchmgmtdtls_fk' => $batchid,
            'lcd_learnerreghrddtls_fk' => $learnerid,
            'lcd_standardcoursemst_fk' => $standcoursemst->standardcoursemst_pk,
            'lcd_standardcoursedtls_fk' => $request['subcate'],
            'lcd_categoryname' => $standcoursemst->scm_coursename_en,
            'lcd_subcategoryname' => $subcategory->ccm_catname_en,
            'lcd_isprinted' => $request['mentioned'],
            'lcd_serialno' => null,
            'lcd_cardexpiry' => $request['workdate'] ? $request['workdate']  : null,
            'lcd_cardissuedate' => date('Y-m-d'),
            'lcd_plaincard' => $request['mentioned'] == 1 ?  $url : null,
            'lcd_viewcardpath' => $request['mentioned'] == 1 ?  $viewurl : null,
            'lcd_verificationno' => $verification,
            'lcd_status' => $request['workdate'] ? (strtotime($request['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
            'lcd_createdon' => date('Y-m-d H:i:s'),
            'lcd_createdby' => $userPk,
        ];
        $learnercard = new \app\models\LearnercarddtlsTbl($learnercarddata);
        
        if($learnercard->save()){
            
            $transaction->commit();
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Learner card generated successfully" ];
        }else{
            $transaction->rollBack();
            echo "<pre>";
            print_r($learnercard->getErrors());
            die;
        }
    }

    public function actionGetstaffdata($civilnumber){
        $query ="SELECT O.ocym_countryname_en, SL.sld_ROPlicense, SL.sld_ROPlicenseupload, S.staffinforepo_pk, S.sir_idnumber, S.sir_name_en, S.sir_name_ar, S.sir_dob, S.sir_gender, S.sir_photo, S.sir_nationality 
                FROM staffinforepo_tbl AS S
                LEFT JOIN stafflicensedtls_tbl AS SL ON SL.sld_staffinforepo_fk = staffinforepo_pk 
                LEFT JOIN opalcountrymst_tbl AS O ON O.opalcountrymst_pk = sir_nationality 
                WHERE sir_idnumber = '$civilnumber'";
        $result = Yii::$app->db->createCommand($query)->queryAll();
        return $result[0];
    }

    public function actionAddstaff(){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        
        $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $query = \Yii::$app->db->createCommand("INSERT INTO staffinforepo_tbl (sir_opalmemberregmst_fk,sir_type,sir_idnumber,sir_name_en,sir_name_ar,sir_emailid,
        sir_dob,sir_gender,sir_photo,sir_nationality,sir_opalstatemst_fk,sir_opalcitymst_fk, sir_createdon, sir_createdby) VALUES (:sir_opalmemberregmst_fk,:sir_type,:sir_idnumber,:sir_name_en,:sir_name_ar,
        :sir_emailid, :sir_dob, :sir_gender, :sir_photo, :sir_nationality,:sir_opalstatemst_fk,:sir_opalcitymst_fk, :sir_createdon, :sir_createdby)")
        ->bindValue(':sir_opalmemberregmst_fk', 0)
        ->bindValue(':sir_type', 2)
        ->bindValue(':sir_idnumber', $request['crNumber'])
        ->bindValue(':sir_name_en', $request['learname'])
        ->bindValue(':sir_name_ar', $request['learnamearabic'])
        ->bindValue(':sir_emailid', 'noemail@noemail.com')
        ->bindValue(':sir_dob', $request['date_birth'])
        ->bindValue(':sir_gender', $request['gender'])
        ->bindValue(':sir_photo', $request['uploaded'][0])
        ->bindValue(':sir_nationality', $request['national'])
        ->bindValue(':sir_opalstatemst_fk', 5142)
        ->bindValue(':sir_opalcitymst_fk', 145058)
        ->bindValue(':sir_createdon', date('Y-m-d H:i:s'))
        ->bindValue(':sir_createdby', $userPk)
        ->execute();
        $staffid = \Yii::$app->db->getLastInsertID();
        $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        if($query){
            if($request['ropnumber']){
                $stafflincense = new \app\models\StafflicensedtlsTbl;
                $stafflincense->sld_staffinforepo_fk = $staffid;
                $stafflincense->sld_ROPlicense = $request['ropnumber'];
                $stafflincense->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
                $stafflincense->sld_hasROPlightlicense = 1;
                $stafflincense->sld_hasROPheavylicense = 1;
                $stafflincense->sld_createdon = date('Y-m-d H:i:s');
                $stafflincense->sld_createdby = $userPk;
                if($stafflincense->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($stafflincense->getErrors());
                    die;
                }
            }
            ///////////
            foreach($request['newcard'] as $newcard){
                $memreg = $newcard['training'] ? $newcard['training'] : 0;
                $standcourse = \app\models\StandardcoursedtlsTbl::find()->where(['=','standardcoursedtls_pk',$newcard['subcate']])->one();
                $standcoursemst = \app\models\StandardcoursemstTbl::find()->where(['=','standardcoursemst_pk',$standcourse->scd_standardcoursemst_fk])->one();
                if(!$newcard['batch']){
                    $batchno = \app\models\BatchmgmtdtlsTbl::newBatchRefNo($newcard['subcate'], 24, $memreg,true);
        
                    $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                    $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
                    bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
                    VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
                    :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
                    ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
                    ->bindValue(':bmd_appinstinfomain_fk', 0)
                    ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
                    ->bindValue(':bmd_standardcoursedtls_fk', $newcard['subcate'])
                    ->bindValue(':bmd_Batchno', $batchno)
                    ->bindValue(':bmd_batchtype', 24)
                    ->bindValue(':bmd_traininglang', 27)
                    ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
                    ->bindValue(':bmd_comment', null)
                    ->bindValue(':bmd_status', 8)
                    ->bindValue(':bmd_reqstatus', null)
                    ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
                    ->bindValue(':bmd_createdby', $userPk)
                    ->bindValue(':bmd_creationtype', 1)
                    ->execute();
                    $batchid = \Yii::$app->db->getLastInsertID();
                    $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                    if($query){
                        
        
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($batch->getErrors());
                        die;
                    }
                } else{
                    $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$newcard['batch']['batchmgmtdtls_pk']])->andwhere(['=','bmd_standardcoursedtls_fk',$newcard['subcate']])->one();
                    $batchid = $newcard['batch']['batchmgmtdtls_pk'];
                    if(empty($batch)){
                        $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                        $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
                        bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
                        VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
                        :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
                        ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
                        ->bindValue(':bmd_appinstinfomain_fk', 0)
                        ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
                        ->bindValue(':bmd_standardcoursedtls_fk', $newcard['subcate'])
                        ->bindValue(':bmd_Batchno', $newcard['batchno'])
                        ->bindValue(':bmd_batchtype', 24)
                        ->bindValue(':bmd_traininglang', 27)
                        ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
                        ->bindValue(':bmd_comment', null)
                        ->bindValue(':bmd_status', 8)
                        ->bindValue(':bmd_reqstatus', null)
                        ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
                        ->bindValue(':bmd_createdby', $userPk)
                        ->bindValue(':bmd_creationtype', 2)
                        ->execute();
                        $batchid = \Yii::$app->db->getLastInsertID();
                        $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                        if($query){
                            
            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($batch->getErrors());
                            die;
                        }
                    }
                }
                $qq = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                $query1 = \Yii::$app->db->createCommand("INSERT INTO learnerreghrddtls_tbl (lrhd_opalmemberregmst_fk, lrhd_batchmgmtdtls_fk, lrhd_staffinforepo_fk,
                Irhd_emailid, Irhd_projectmst_fk, lrhd_learnerfee, lrhd_feestatus, lrhd_paidby, lrhd_status, lrhd_createdon,lrhd_createdby, lrhd_operatorname, lrhd_appdeccomments,lrhd_appdecon, lrhd_appdecby   ) 
                VALUES (:lrhd_opalmemberregmst_fk, :lrhd_batchmgmtdtls_fk, :lrhd_staffinforepo_fk, :Irhd_emailid, :Irhd_projectmst_fk, 
                :lrhd_learnerfee, :lrhd_feestatus, :lrhd_paidby, :lrhd_status, :lrhd_createdon, :lrhd_createdby, :lrhd_operatorname, :lrhd_appdeccomments, :lrhd_appdecon, :lrhd_appdecby)")
                ->bindValue(':lrhd_opalmemberregmst_fk', $memreg)
                ->bindValue(':lrhd_batchmgmtdtls_fk', $batchid)
                ->bindValue(':lrhd_staffinforepo_fk', $staffid)
                ->bindValue(':Irhd_emailid', 'noemail@noemail.com')
                ->bindValue(':Irhd_projectmst_fk', 2)
                ->bindValue(':lrhd_learnerfee', 0)
                ->bindValue(':lrhd_feestatus', 1)
                ->bindValue(':lrhd_paidby', null)
                ->bindValue(':lrhd_status', 10)
                ->bindValue(':lrhd_createdon', date('Y-m-d H:i:s'))
                ->bindValue(':lrhd_createdby', $userPk)
                ->bindValue(':lrhd_operatorname', null)
                ->bindValue(':lrhd_appdeccomments', null)
                ->bindValue(':lrhd_appdecon', null)
                ->bindValue(':lrhd_appdecby', null)
                ->execute();
                $learnerid = \Yii::$app->db->getLastInsertID();
                $qq1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                
                if($query1){
                    $subcategory = \app\models\CoursecategorymstTbl::find()->where(['=','coursecategorymst_pk',$standcourse->scd_subcoursecategorymst_fk])->one();
                    $learnercard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $staffid])
                        ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->asArray()->all();
        
                    $verification = '';
                    if(count($learnercard) == 0){
                    $flag = false;
                    while(!$flag){
                        $verification = 'LC'.substr(sha1(time()), 0, 8);
                        $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                        if($isexist == 0){
                            $flag = true;
                        }
                    }
                    }else{
                        $verification = $learnercard[0]['lcd_verificationno'];
                    }
                    //if($newcard['mentioned'] == 1){
                       
                        $learnercards = \app\models\LearnercarddtlsTbl::find()
                        ->where(['lcd_status'=>1])
                        ->orwhere(['lcd_status'=>2])
                       // ->andwhere(['lcd_isprinted'=>1])
                        ->andwhere(['lcd_staffinforepo_fk' => $staffid])
                        ->andwhere(['lcd_standardcoursemst_fk'=>$standcoursemst->standardcoursemst_pk])
                        ->orderBy(['lcd_standardcoursedtls_fk'=>SORT_ASC])->asArray()->all();
        
                        $category = [];
                        $expiryDatesub = [];
                        foreach($learnercards as $item){
                            if($item['lcd_isprinted'] == 1){
                                $aa = [
                                    'cate' => $item['lcd_subcategoryname'],
                                    'id' => $item['lcd_standardcoursedtls_fk'],
                                ];
                                array_push($category, $aa);
                                if($item['lcd_cardexpiry']){
                                    $bb = [
                                        'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                                        'id' => $item['lcd_standardcoursedtls_fk'],
                                    ];
                                    array_push($expiryDatesub,$bb);
                                } else{
                                    $bb = [
                                        'date' => 'N/A',
                                        'id' => $item['lcd_standardcoursedtls_fk'],
                                    ];
                                    array_push($expiryDatesub,$bb);
                                }
                            }
                        }
                        if($newcard['mentioned'] == 1){
                            $aa1 = [
                                'cate' => $subcategory->ccm_catname_en,
                                'id' => $newcard['subcate'],
                            ];
                            array_push($category, $aa1);
                            if($newcard['workdate']){
                                $bb = [
                                    'date' => date("d-m-Y", strtotime( $newcard['workdate'])),
                                    'id' => $newcard['subcate'],
                                ];
                                array_push($expiryDatesub,$bb);
                            } else{
                                $bb = [
                                    'date' => 'N/A',
                                    'id' => $newcard['subcate'],
                                ];
                                array_push($expiryDatesub,$bb);
                
                            }
                        }
                        usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                        usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                        $titlesub = $subcategory->ccm_catname_en;
                        if($titlesub == 'Heavy Vehicle'){
                            $k = 0;
                            foreach($learnercards as $items){
                                if($items['lcd_subcategoryname'] == 'Light Vehicle'){
                                    $expiryDatesub[$k]['date'] = $newcard['workdate'] ? date("d-m-Y", strtotime($newcard['workdate'])) : 'N/A';
                                   
                                }
                                $k++;
                            }
                            
                        }
            
                        $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                                    ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                                    ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                                    ->where(['memcompfiledtls_pk'=>$request['uploaded'][0]])->asArray()->one();
                                    $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
                                    $userPkf = $file_info['mcfd_uploadedby'];
                                    $img_name = $file_info['mcfd_sysgenerfilename'];
                                    $org_name = $file_info['mcfd_origfilename'];
                                    $phy_filepath = $file_info['fm_phyfilepath'];
                                    $uploadPath = \Yii::$app->params['uploadPath'];
                                    $srcDirectory=Yii::$app->params['srcDirectory']; 
                                    $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
                                    $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
            
            
                        $userdata=[
                            'name'=>$request['learname'] ? $request['learname'] : 'Nil',
                            'issuedata'=> date('d-m-Y'),   
                            'licNo'=> $request['ropnumber'] ? $request['ropnumber'] : 'Nil',
                            'cattable'=>$category,
                            'expirytable'=>$expiryDatesub,
                            'title' => $standcoursemst->standardcoursemst_pk != 1 ? $standcoursemst->scm_coursename_en : '',
                            'nolice' => $standcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
                            'civilno'=> $request['crNumber'],
                            'verificationcode'=> $verification,
                        ];
                        
                        $regPk = $batch->bmd_opalmemberregmst_fk ? $batch->bmd_opalmemberregmst_fk : 0;
                        $filename = 'card_'.$standcoursemst->standardcoursemst_pk.'_'.$staffid.'_'.$learnerid.'_print.pdf';
                        $path = "../api/web/learnercard/$regPk/";
                        if(!is_dir($path)){
                            mkdir($path, 0777, true);
                        }
            
                        //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
                        $qrCode = (new QrCode(''))
                        ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
                        $qrCode->writeFile(__DIR__ . '/code.png'); 
                        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
                        $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
                        //Print PDF generate
                        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                        //$mpdf->SetProtection(array());
                        $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                        $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
                        $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";
                
                        //View PDF generate
                        $filenameview = 'card_'.$standcoursemst->standardcoursemst_pk.'_'.$staffid.'_'.$learnerid.'_view.pdf';
                        $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                        $mpdfview->SetProtection(array());
                        $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                        $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
                        $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
                   
                    if($titlesub == 'Heavy Vehicle'){
                        foreach($learnercards as $items){
                            if($items['lcd_subcategoryname'] == 'Light Vehicle'){
                                $lightcard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                                $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                                $lightcard1 = [
                                    'lcd_staffinforepo_fk' => $lightcard->lcd_staffinforepo_fk,
                                    'lcd_batchmgmtdtls_fk' => $lightcard->lcd_batchmgmtdtls_fk,
                                    'lcd_learnerreghrddtls_fk' => $lightcard->lcd_learnerreghrddtls_fk,
                                    'lcd_standardcoursemst_fk' => $lightcard->lcd_standardcoursemst_fk,
                                    'lcd_standardcoursedtls_fk' => $lightcard->lcd_standardcoursedtls_fk,
                                    'lcd_categoryname' => $lightcard->lcd_categoryname,
                                    'lcd_subcategoryname' => $lightcard->lcd_subcategoryname,
                                    'lcd_isprinted' =>  $lightcard->lcd_isprinted,
                                    'lcd_serialno' => $lightcard->lcd_serialno,
                                    'lcd_cardexpiry' => $newcard['workdate'] ? $newcard['workdate'] : null,
                                    'lcd_cardissuedate' => date('Y-m-d'),
                                    'lcd_plaincard' => $lightcard->lcd_isprinted == 1 ?   $url : null,
                                    'lcd_viewcardpath' => $lightcard->lcd_isprinted == 1 ?  $viewurl : null,
                                    'lcd_verificationno' => $verification,
                                    'lcd_status' => $newcard['workdate'] ? (strtotime($newcard['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                    'lcd_createdon' => date('Y-m-d H:i:s'),
                                    'lcd_createdby' => $userPk,
                                ];
                                $ligncard = new \app\models\LearnercarddtlsTbl($lightcard1);
                                if($ligncard->save()){
                                   
                                }else{
                                    $transaction->rollBack();
                                    echo "<pre>";
                                    print_r($ligncard->getErrors());
                                    die;
                                }

                            }
                        }
                    
                    }
                    
                    $learnercarddata =  [
                        'lcd_staffinforepo_fk' => $staffid,
                        'lcd_batchmgmtdtls_fk' => $batchid,
                        'lcd_learnerreghrddtls_fk' => $learnerid,
                        'lcd_standardcoursemst_fk' => $standcoursemst->standardcoursemst_pk,
                        'lcd_standardcoursedtls_fk' => $newcard['subcate'],
                        'lcd_categoryname' => $standcoursemst->scm_coursename_en,
                        'lcd_subcategoryname' => $subcategory->ccm_catname_en,
                        'lcd_isprinted' => $newcard['mentioned'],
                        'lcd_serialno' => null,
                        'lcd_cardexpiry' =>  $newcard['workdate'] ? $newcard['workdate']  : null,
                        'lcd_cardissuedate' => date('Y-m-d'),
                        'lcd_plaincard' => $newcard['mentioned'] == 1 ?  $url : null,
                        'lcd_viewcardpath' => $newcard['mentioned'] == 1 ?  $viewurl : null,
                        'lcd_verificationno' => $verification,
                        'lcd_status' => $newcard['workdate'] ? (strtotime($newcard['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                        'lcd_createdon' => date('Y-m-d H:i:s'),
                        'lcd_createdby' => $userPk,
                    ];
                    $learnercard = new \app\models\LearnercarddtlsTbl($learnercarddata);
                    if($learnercard->save()){
                        
                    }else{
                        $transaction->rollBack();
                        print_r($learnercard->getErrors());
                        die;
                    }
        
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($query1->getErrors());
                    die;
                }
            }
            $transaction->commit();
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Learner card generated successfully" ];

            ////////////

        }else{
            $transaction->rollBack();
            echo "<pre>";
            print_r($query->getErrors());
            die;
        }

        
    }

    public function actionAddlearnerwithnewcatergory(){
        
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $staffdata = \app\models\StaffinforepoTbl::find()->where(['=', 'staffinforepo_pk', $request['staffid']])->one();
        $lincedata = \app\models\StafflicensedtlsTbl::find()->where(['=','sld_staffinforepo_fk',$request['staffid']])->one();
       
        $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
        $query1 = \Yii::$app->db->createCommand("UPDATE staffinforepo_tbl SET sir_type = :sir_type, sir_idnumber = :sir_idnumber,
         sir_name_en = :sir_name_en, sir_name_ar = :sir_name_ar, sir_dob = :sir_dob, sir_photo = :sir_photo, sir_nationality = :sir_nationality,
         sir_updatedon = :sir_updatedon, sir_updatedby = :sir_updatedby WHERE staffinforepo_pk = :staffid ")
        ->bindValue(':sir_type', $staffdata->sir_type == 1 ? 3 : $staffdata->sir_type)
        ->bindValue(':sir_idnumber', $request['crNumber'])
        ->bindValue(':sir_name_en', $request['learname'])
        ->bindValue(':sir_name_ar', $request['learnamearabic'])
        ->bindValue(':sir_dob', $request['date_birth'])
        ->bindValue(':sir_photo', $request['uploaded'][0])
        ->bindValue(':sir_nationality', $request['national'])
        ->bindValue(':sir_updatedon', date('Y-m-d H:i:s'))
        ->bindValue(':sir_updatedby', $userPk)
        ->bindValue(':staffid', $request['staffid'])
        ->execute();
        $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

        if($query1) {
            if($lincedata){
                $lincedata->sld_ROPlicense = $request['ropnumber'];
                $lincedata->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0] ;
                $lincedata->sld_updatedon=date('Y-m-d H:i:s');          
                $lincedata->sld_updatedby=$userPk;
                if($lincedata->save()) {
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($lincedata->getErrors());
                    die;
                }
            }
            else{
                if($request['ropnumber']){
                    $lincedata = new \app\models\StafflicensedtlsTbl;
                    $lincedata->sld_staffinforepo_fk = $request['staffid'];
                    $lincedata->sld_ROPlicense = $request['ropnumber'];
                    $lincedata->sld_ROPlicenseupload = count($request['roplicen_se']) > 1 ? implode(',', $request['roplicen_se']) :$request['roplicen_se'][0];
                    $lincedata->sld_hasROPlightlicense = 1;
                    $lincedata->sld_hasROPheavylicense = 1;
                    $lincedata->sld_createdon = date('Y-m-d H:i:s');
                    $lincedata->sld_createdby = $userPk;
                    if($lincedata->save()) {
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($lincedata->getErrors());
                        die;
                    }
                }
            }
           
            foreach($request['newcard'] as $newcard){
                $batchid = '';

                $memreg = $newcard['training'] ? $newcard['training'] : 0;
                $standardcoursemst = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$request['category']])->one();
                $standcourse = \app\models\StandardcoursedtlsTbl::find()->where(['=','standardcoursedtls_pk',$newcard['subcate']])->one();
                if(empty($newcard['batch'])){
                    $batchno = \app\models\BatchmgmtdtlsTbl::newBatchRefNo($newcard['subcate'], 24, $memreg,true);
        
                    $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                    $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
                    bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
                    VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
                    :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
                    ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
                    ->bindValue(':bmd_appinstinfomain_fk', 0)
                    ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
                    ->bindValue(':bmd_standardcoursedtls_fk', $newcard['subcate'])
                    ->bindValue(':bmd_Batchno', $batchno)
                    ->bindValue(':bmd_batchtype', 24)
                    ->bindValue(':bmd_traininglang', 27)
                    ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
                    ->bindValue(':bmd_comment', null)
                    ->bindValue(':bmd_status', 8)
                    ->bindValue(':bmd_reqstatus', null)
                    ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
                    ->bindValue(':bmd_createdby', $userPk)
                    ->bindValue(':bmd_creationtype', 1)
                    ->execute();
                    $batchid = \Yii::$app->db->getLastInsertID();
                    $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                    if($query){
                        
        
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($batch->getErrors());
                        die;
                    }
                } else{
                    $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$newcard['batch']['batchmgmtdtls_pk']])->andwhere(['=','bmd_standardcoursedtls_fk',$newcard['subcate']])->one();
                    $batchid = $newcard['batch']['batchmgmtdtls_pk'];
                    if(empty($batch)){
                        $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                        $query = \Yii::$app->db->createCommand("INSERT INTO batchmgmtdtls_tbl (bmd_opalmemberregmst_fk, bmd_appinstinfomain_fk, bmd_appcoursedtlsmain_fk,bmd_standardcoursedtls_fk,
                        bmd_Batchno, bmd_batchtype, bmd_traininglang, bmd_batchcount, bmd_comment, bmd_status, bmd_reqstatus, bmd_createdon, bmd_createdby, bmd_creationtype ) 
                        VALUES (:bmd_opalmemberregmst_fk, :bmd_appinstinfomain_fk, :bmd_appcoursedtlsmain_fk, :bmd_standardcoursedtls_fk,
                        :bmd_Batchno, :bmd_batchtype, :bmd_traininglang, :bmd_batchcount, :bmd_comment, :bmd_status, :bmd_reqstatus, :bmd_createdon, :bmd_createdby, :bmd_creationtype)")
                        ->bindValue(':bmd_opalmemberregmst_fk', $memreg)
                        ->bindValue(':bmd_appinstinfomain_fk', 0)
                        ->bindValue(':bmd_appcoursedtlsmain_fk', 0)
                        ->bindValue(':bmd_standardcoursedtls_fk', $newcard['subcate'])
                        ->bindValue(':bmd_Batchno', $newcard['batchno'])
                        ->bindValue(':bmd_batchtype', 24)
                        ->bindValue(':bmd_traininglang', 27)
                        ->bindValue(':bmd_batchcount', $standcourse->scd_thyclasslimit)
                        ->bindValue(':bmd_comment', null)
                        ->bindValue(':bmd_status', 8)
                        ->bindValue(':bmd_reqstatus', null)
                        ->bindValue(':bmd_createdon', date('Y-m-d H:i:s'))
                        ->bindValue(':bmd_createdby', $userPk)
                        ->bindValue(':bmd_creationtype', 2)
                        ->execute();
                        $batchid = \Yii::$app->db->getLastInsertID();
                        $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                        if($query){
                            
            
                        }else{
                            $transaction->rollBack();
                            echo "<pre>";
                            print_r($batch->getErrors());
                            die;
                        }
                    }
                }
                
                $learner = \app\models\LearnerreghrddtlsTbl::find()->where(['=','lrhd_batchmgmtdtls_fk',$batchid])->andwhere(['=','lrhd_staffinforepo_fk', $request['staffid']])->one();
                if(!$learner){
                    $qq = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                    $query1 = \Yii::$app->db->createCommand("INSERT INTO learnerreghrddtls_tbl (lrhd_opalmemberregmst_fk, lrhd_batchmgmtdtls_fk, lrhd_staffinforepo_fk,
                    Irhd_emailid, Irhd_projectmst_fk, lrhd_learnerfee, lrhd_feestatus, lrhd_paidby, lrhd_status, lrhd_createdon,lrhd_createdby, lrhd_operatorname, lrhd_appdeccomments,lrhd_appdecon, lrhd_appdecby   ) 
                    VALUES (:lrhd_opalmemberregmst_fk, :lrhd_batchmgmtdtls_fk, :lrhd_staffinforepo_fk, :Irhd_emailid, :Irhd_projectmst_fk, 
                    :lrhd_learnerfee, :lrhd_feestatus, :lrhd_paidby, :lrhd_status, :lrhd_createdon, :lrhd_createdby, :lrhd_operatorname, :lrhd_appdeccomments, :lrhd_appdecon, :lrhd_appdecby)")
                    ->bindValue(':lrhd_opalmemberregmst_fk', $memreg)
                    ->bindValue(':lrhd_batchmgmtdtls_fk', $batchid)
                    ->bindValue(':lrhd_staffinforepo_fk', $request['staffid'])
                    ->bindValue(':Irhd_emailid', $staffdata->sir_emailid)
                    ->bindValue(':Irhd_projectmst_fk', 2)
                    ->bindValue(':lrhd_learnerfee', 0)
                    ->bindValue(':lrhd_feestatus', 1)
                    ->bindValue(':lrhd_paidby', null)
                    ->bindValue(':lrhd_status', 10)
                    ->bindValue(':lrhd_createdon', date('Y-m-d H:i:s'))
                    ->bindValue(':lrhd_createdby', $userPk)
                    ->bindValue(':lrhd_operatorname', null)
                    ->bindValue(':lrhd_appdeccomments', null)
                    ->bindValue(':lrhd_appdecon', null)
                    ->bindValue(':lrhd_appdecby', null)
                    ->execute();
                    $learnerid = \Yii::$app->db->getLastInsertID();
                    $qq1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
                    if($query1){
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($query1->getErrors());
                        die;
                    }

                }else{
                    $learnerid = $learner->learnerreghrddtls_pk;
                    $learner->lrhd_status = 10;
                    $learner->lrhd_updatedon = date('Y-m-d H:i:s');
                    $learner->lrhd_updatedby = $userPk;
                    if($learner->save()){
                    }else{
                        $transaction->rollBack();
                        echo "<pre>";
                        print_r($learner->getErrors());
                        die;
                    }
                }
                $category = [];
                $expiryDatesub = [];
                $subcategory = \app\models\CoursecategorymstTbl::find()->where(['=','coursecategorymst_pk',$standcourse->scd_subcoursecategorymst_fk])->one();

                $learnercard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])->andwhere(['=','lcd_standardcoursemst_fk', $request['category']])
                ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();

                $verification = '';
                if(count($learnercard) == 0){
                    $learnercard1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $request['staffid']])
                    ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                    if(count($learnercard1) == 0){
                        $flag = false;
                        while(!$flag){
                            $verification = 'LC'.substr(sha1(time()), 0, 8);
                            $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                            if($isexist == 0){
                                $flag = true;
                            }
                        }
                    }else{
                        $verification = $learnercard1[0]['lcd_verificationno'];
                    }
                }else{
                    $verification = $learnercard[0]['lcd_verificationno'];
                }
                $carddetails = \app\models\LearnercarddtlsTbl::find()
                ->where(['lcd_status'=>1])
                ->orwhere(['lcd_status'=>2])
                //->andwhere(['lcd_isprinted'=>1])
                ->andwhere(['lcd_staffinforepo_fk' => $request['staffid']])
                ->andwhere(['lcd_standardcoursemst_fk'=>$standardcoursemst->standardcoursemst_pk])
                ->orderBy(['lcd_standardcoursedtls_fk'=>SORT_ASC])->asArray()->all();
                $titlesub = $subcategory->ccm_catname_en;

                //if($newcard['mentioned'] == 1){
                    

                    foreach($carddetails as $item){
                        if($item['lcd_isprinted'] == 1){
                            $aa = [
                                'cate' => $item['lcd_subcategoryname'],
                                'id' => $item['lcd_standardcoursedtls_fk'],
                            ];
                            array_push($category, $aa);
                            if($item['lcd_cardexpiry']){
                                $bb = [
                                    'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                                    'id' => $item['lcd_standardcoursedtls_fk'],
                                ];
                                array_push($expiryDatesub,$bb);
                            } else{
                                $bb = [
                                    'date' => 'N/A',
                                    'id' => $item['lcd_standardcoursedtls_fk'],
                                ];
                                array_push($expiryDatesub,$bb);
                            }
                            // $batchid = $item['lcd_batchmgmtdtls_fk'];
                        }
                    }
                    if($newcard['mentioned'] == 1){
                        $aa1 = [
                            'cate' => $subcategory->ccm_catname_en,
                            'id' => $newcard['subcate'],
                        ];
                        array_push($category, $aa1);
                        if($newcard['workdate']){
                            $bb = [
                                'date' => date("d-m-Y", strtotime( $newcard['workdate'])),
                                'id' => $newcard['subcate'],
                            ];
                            array_push($expiryDatesub,$bb);
                        } else{
                            $bb = [
                                'date' => 'N/A',
                                'id' => $newcard['subcate'],
                            ];
                            array_push($expiryDatesub,$bb);
            
                        }
                    }
                    usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                    usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
                   
                    
                        if($titlesub == 'Heavy Vehicle'){

                            $k = 0;
                            foreach($carddetails as $items){
                                if($items['lcd_subcategoryname'] == 'Light Vehicle'){
                                    $expiryDatesub[$k]['date'] = $newcard['workdate'] ? date("d-m-Y", strtotime($newcard['workdate'])) : 'N/A';
                                    
                                }
                                $k++;
                            }
                            
                        }
                    $userdata=[
                        'name'=>$request['learname'],
                        'issuedata'=> date('d-m-Y'),   
                        'licNo'=> $request['ropnumber'] ? $request['ropnumber'] : 'Nil',
                        'cattable'=>$category,
                        'expirytable'=>$expiryDatesub,
                        'title' => $standardcoursemst->standardcoursemst_pk != 1 ? $standardcoursemst->scm_coursename_en : '',
                        'nolice' => $standardcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
                        'civilno'=> $request['crNumber'],
                        'verificationcode'=> $verification ,
                    ];
                    
                    $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
                    ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
                    ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
                    ->where(['memcompfiledtls_pk'=>$request['uploaded'][0]])->asArray()->one();
                    $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
                    $userPkf = $file_info['mcfd_uploadedby'];
                    $img_name = $file_info['mcfd_sysgenerfilename'];
                    $org_name = $file_info['mcfd_origfilename'];
                    $phy_filepath = $file_info['fm_phyfilepath'];
                    $uploadPath = \Yii::$app->params['uploadPath'];
                    $srcDirectory=Yii::$app->params['srcDirectory']; 
                    $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
                    $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
    
                    //$batch  = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$batchid])->one();
                    $regPk = $memreg;
                    $filename = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$request['staffid'].'_'.$learnerid.'_print.pdf';
                    $path = "../api/web/learnercard/$regPk/";
    
                    if(!is_dir($path)){
                        mkdir($path, 0777, true);
                    }
    
                        //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
                        $qrCode = (new QrCode(''))
                        ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
                        $qrCode->writeFile(__DIR__ . '/code.png'); 
                        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
                        $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
                        //Print PDF generate
                        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                        //$mpdf->SetProtection(array());
                        $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                        $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
                    $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";
    
                    //View PDF generate
                    $filenameview = 'card_'.$standardcoursemst->standardcoursemst_pk.'_'.$request['staffid'].'_'.$learnerid.'_view.pdf';
                    $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
                    $mpdfview->SetProtection(array());
                    $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
                    $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
                    $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
                //}
                if($titlesub == 'Heavy Vehicle'){
                    foreach($carddetails as $items){
                        if($items['lcd_subcategoryname'] == 'Light Vehicle'){
                            $lightcard = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                
                            $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                            $lightcard1 = [
                                'lcd_staffinforepo_fk' => $lightcard->lcd_staffinforepo_fk,
                                'lcd_batchmgmtdtls_fk' => $lightcard->lcd_batchmgmtdtls_fk,
                                'lcd_learnerreghrddtls_fk' => $lightcard->lcd_learnerreghrddtls_fk,
                                'lcd_standardcoursemst_fk' => $lightcard->lcd_standardcoursemst_fk,
                                'lcd_standardcoursedtls_fk' => $lightcard->lcd_standardcoursedtls_fk,
                                'lcd_categoryname' => $lightcard->lcd_categoryname,
                                'lcd_subcategoryname' => $lightcard->lcd_subcategoryname,
                                'lcd_isprinted' =>  $lightcard->lcd_isprinted,
                                'lcd_serialno' => $lightcard->lcd_serialno,
                                'lcd_cardexpiry' => $newcard['workdate'] ? $newcard['workdate'] : null,
                                'lcd_cardissuedate' => date('Y-m-d'),
                                'lcd_plaincard' => $lightcard->lcd_isprinted == 1 ?   $url : null,
                                'lcd_viewcardpath' => $lightcard->lcd_isprinted == 1 ?  $viewurl : null,
                                'lcd_verificationno' => $verification,
                                'lcd_status' => $newcard['workdate'] ? (strtotime($newcard['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                'lcd_createdon' => date('Y-m-d H:i:s'),
                                'lcd_createdby' => $userPk,
                            ];
                            $ligncard = new \app\models\LearnercarddtlsTbl($lightcard1);
                            if($ligncard->save()){
                                
                            }else{
                                $transaction->rollBack();
                                echo "<pre>";
                                print_r($ligncard->getErrors());
                                die;
                            }
                        }else{
                            $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                            if( $verification != $card1->lcd_verificationno){

                                $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                                $vcard = [
                                    'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                                    'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                                    'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                                    'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                                    'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                                    'lcd_categoryname' => $card1->lcd_categoryname,
                                    'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                                    'lcd_isprinted' =>  $card1->lcd_isprinted,
                                    'lcd_serialno' => $card1->lcd_serialno,
                                    'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                                    'lcd_cardissuedate' => date('Y-m-d'),
                                    'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                                    'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                                    'lcd_verificationno' => $verification,
                                    'lcd_status' =>  $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                    'lcd_createdon' => date('Y-m-d H:i:s'),
                                    'lcd_createdby' => $userPk,
                                ];
                                $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                                if($vercard->save()){
                    
                                }else{
                                    $transaction->rollBack();
                                    echo "<pre>";
                                    print_r($vercard->getErrors());
                                    die;
                                }
                            }
                        }
                    }
                }else{
                    foreach($carddetails as $item){ 
                        $card1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'learnercarddtls_pk', $item['learnercarddtls_pk']])->one();
                        if( $verification != $card1->lcd_verificationno){

                            $licard = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
                            $vcard = [
                                'lcd_staffinforepo_fk' => $card1->lcd_staffinforepo_fk,
                                'lcd_batchmgmtdtls_fk' => $card1->lcd_batchmgmtdtls_fk,
                                'lcd_learnerreghrddtls_fk' => $card1->lcd_learnerreghrddtls_fk,
                                'lcd_standardcoursemst_fk' => $card1->lcd_standardcoursemst_fk,
                                'lcd_standardcoursedtls_fk' => $card1->lcd_standardcoursedtls_fk,
                                'lcd_categoryname' => $card1->lcd_categoryname,
                                'lcd_subcategoryname' => $card1->lcd_subcategoryname,
                                'lcd_isprinted' =>  $card1->lcd_isprinted,
                                'lcd_serialno' => $card1->lcd_serialno,
                                'lcd_cardexpiry' => $card1->lcd_cardexpiry,
                                'lcd_cardissuedate' => date('Y-m-d'),
                                'lcd_plaincard' => $card1->lcd_isprinted == 1 ?   $url : null,
                                'lcd_viewcardpath' => $card1->lcd_isprinted == 1 ?  $viewurl : null,
                                'lcd_verificationno' => $verification,
                                'lcd_status' => $card1->lcd_cardexpiry ? (strtotime($card1->lcd_cardexpiry) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                                'lcd_createdon' => date('Y-m-d H:i:s'),
                                'lcd_createdby' => $userPk,
                            ];
                            $vercard = new \app\models\LearnercarddtlsTbl($vcard);
                            if($vercard->save()){
                
                            }else{
                                $transaction->rollBack();
                                echo "<pre>";
                                print_r($vercard->getErrors());
                                die;
                            }
                        }
                    }
                }
                $newcard = [
                    'lcd_staffinforepo_fk' => $request['staffid'],
                    'lcd_batchmgmtdtls_fk' => $batchid,
                    'lcd_learnerreghrddtls_fk' => $learnerid,
                    'lcd_standardcoursemst_fk' => $request['category'],
                    'lcd_standardcoursedtls_fk' => $newcard['subcate'],
                    'lcd_categoryname' => $standardcoursemst->scm_coursename_en,
                    'lcd_subcategoryname' => $subcategory->ccm_catname_en,
                    'lcd_isprinted' =>  $newcard['mentioned'],
                    'lcd_serialno' => null,
                    'lcd_cardexpiry' => $newcard['workdate'] ? $newcard['workdate']  : null,
                    'lcd_cardissuedate' => date('Y-m-d'),
                    'lcd_plaincard' => $newcard['mentioned'] == 1 ?  $url : null,
                    'lcd_viewcardpath' => $newcard['mentioned'] == 1 ?  $viewurl : null,
                    'lcd_verificationno' => $verification,
                    'lcd_status' => $newcard['workdate'] ? (strtotime($newcard['workdate']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                    'lcd_createdon' => date('Y-m-d H:i:s'),
                    'lcd_createdby' => $userPk,
                ];

                $ncard = new \app\models\LearnercarddtlsTbl($newcard);
                
                if($ncard->save()){
                    
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($ncard->getErrors());
                    die;
                }
                
            }
            $transaction->commit();
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "card generated successfully" ];
           
        }
        else{
            $transaction->rollBack();
            echo "<pre>";
            print_r($staffdata->getErrors());
            die;
        }
    }

    public function actionAlreadybatchnoexist($batchno, $subcateid){
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->one();
        if($batch){
            $batch1 = \app\models\BatchmgmtdtlsTbl::find()->where(['=','bmd_Batchno',$batchno])->andwhere(['=','bmd_standardcoursedtls_fk',$subcateid])->one();
            if($batch1){
                return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "You can use this batch number" ];
            }else{
                return [ 'msg' => 'sucess', 'status' => 2, 'flag' => 'F', 'data' => "You can't use this batch number" ];
            }
        }else{
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "You can use this batch number" ];
        }
    }

    public function actionDeactivecard($cardid){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $carddetail = \app\models\LearnercarddtlsTbl::find()->where(['=','learnercarddtls_pk', $cardid])->one();
        $cardwiththesamebatch = \app\models\LearnercarddtlsTbl::find()->where(['=','lcd_learnerreghrddtls_fk',$carddetail->lcd_learnerreghrddtls_fk])
        ->andWhere(['=','lcd_batchmgmtdtls_fk',$carddetail->lcd_batchmgmtdtls_fk])->orderby('learnercarddtls_pk  desc')->asArray()->all();
        if(count($cardwiththesamebatch) == 1){
            $carddetail->lcd_status = 4;
            if($carddetail->save()){

            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($carddetail->getErrors());
                die;
            }
        }else{
            if($cardwiththesamebatch[0]['learnercarddtls_pk'] == $cardid){
                $carddetail->lcd_status = 4;
                if($carddetail->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($carddetail->getErrors());
                    die;
                }
                foreach($cardwiththesamebatch as $rcard){
                    if($rcard['learnercarddtls_pk'] != $cardid && $rcard['lcd_status'] == 4){
                        $card =  \app\models\LearnercarddtlsTblQuery::movecardtohistory($rcard['learnercarddtls_pk']);
                    } 
                }
            }else{
                $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($cardid);
            }
        }
        $category = [];
        $expiryDatesub = [];
        $batchid = '';
        $standardcoursemst = \app\models\StandardcoursemstTbl::find()->where(['standardcoursemst_pk'=>$carddetail->lcd_standardcoursemst_fk])->one();
        $carddetails =  \app\models\LearnercarddtlsTbl::find()
        ->andwhere(['=', 'lcd_staffinforepo_fk', $carddetail->lcd_staffinforepo_fk])
        ->andwhere(['=','lcd_standardcoursemst_fk', $carddetail->lcd_standardcoursemst_fk])
        ->andwhere(['!=','lcd_status', 4])->asArray()->all();
        
        foreach($carddetails as $item){
            if($item['lcd_isprinted'] == 1){
                $aa = [
                    'cate' => $item['lcd_subcategoryname'],
                    'id' => $item['lcd_standardcoursedtls_fk'],
                ];
                array_push($category, $aa);
                if($item['lcd_cardexpiry']){
                    $bb = [
                        'date' => date("d-m-Y", strtotime( $item['lcd_cardexpiry'])),
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($expiryDatesub,$bb);
                } else{
                    $bb = [
                        'date' => 'N/A',
                        'id' => $item['lcd_standardcoursedtls_fk'],
                    ];
                    array_push($expiryDatesub,$bb);
                }
                $batchid = $item['lcd_batchmgmtdtls_fk'];
            }
        }
        
        usort($category, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
        usort($expiryDatesub, function($a, $b) {if ($a['id'] == $b['id']) {  return 0; } return ($a['id'] < $b['id']) ? -1 : 1;});
        if($carddetail->lcd_verificationno == '--' || $carddetail->lcd_verificationno == 'OLD-DATA' || empty($carddetail->lcd_verificationno)){
            $learnercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $carddetail->lcd_staffinforepo_fk])->andwhere(['=','lcd_standardcoursemst_fk', $carddetails->lcd_standardcoursemst_fk])
            ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();

            $verification = '';
            if(count($learnercarddata) == 0){
                $learnercarddata1 = \app\models\LearnercarddtlsTbl::find()->where(['=', 'lcd_staffinforepo_fk', $carddetail->lcd_staffinforepo_fk])
                ->andwhere(['!=','lcd_verificationno','--'])->andwhere(['!=','lcd_verificationno','OLD-DATA'])->andWhere(['not', ['lcd_verificationno' => null]])->asArray()->all();
                if(count($learnercarddata1) == 0){
                    $flag = false;
                    while(!$flag){
                        $verification = 'LC'.substr(sha1(time()), 0, 8);
                        $isexist = \app\models\LearnercarddtlsTbl::find()->where(['lcd_verificationno' => $verification])->count();    
                        if($isexist == 0){
                            $flag = true;
                        }
                    }
                }else{
                    $verification = $learnercarddata1[0]['lcd_verificationno'];
                }
            }else{
                $verification = $learnercarddata[0]['lcd_verificationno'];
            }

        }else{
            $verification = $carddetail->lcd_verificationno;
        }
        $staff = \app\models\StaffinforepoTbl::find()->where(['=','staffinforepo_pk',$carddetail->lcd_staffinforepo_fk])->one();
        $stafflin = \app\models\StafflicensedtlsTbl::find()->where(['=','sld_staffinforepo_fk',$carddetail->lcd_staffinforepo_fk])->one();
        
        $userdata=[
            'name'=>$staff->sir_name_en,
            'issuedata'=> date('d-m-Y'),   
            'licNo'=> $stafflin->sld_ROPlicense ? $stafflin->sld_ROPlicense : 'Nil',
            'cattable'=>$category,
            'expirytable'=>$expiryDatesub,
            'title' => $standardcoursemst->standardcoursemst_pk != 1 ? $standardcoursemst->scm_coursename_en : '',
            'nolice' => $standardcoursemst->standardcoursemst_pk == 1 ? 1 : 0,
            'civilno'=> $staff->sir_idnumber,
            'verificationcode'=> $verification ,
        ];
        
        $file_info = \api\modules\drv\models\MemcompfiledtlsTbl::find()
        ->select(['mcfd_opalmemberregmst_fk','mcfd_uploadedby','mcfd_sysgenerfilename','mcfd_origfilename','fm_phyfilepath'])
        ->leftJoin('filemst_tbl','filemst_tbl.filemst_pk = memcompfiledtls_tbl.mcfd_filemst_fk')
        ->where(['memcompfiledtls_pk'=>$staff->sir_photo])->asArray()->one();
        $companyPk = $file_info['mcfd_opalmemberregmst_fk'];
        $userPkf = $file_info['mcfd_uploadedby'];
        $img_name = $file_info['mcfd_sysgenerfilename'];
        $org_name = $file_info['mcfd_origfilename'];
        $phy_filepath = $file_info['fm_phyfilepath'];
        $uploadPath = \Yii::$app->params['uploadPath'];
        $srcDirectory=Yii::$app->params['srcDirectory']; 
        $userDirectory = "comp_" . $companyPk . "/user_" . $userPkf;
        $target_path = $srcDirectory.$uploadPath . "/" . $userDirectory . '/' . $phy_filepath . '/'.$img_name;
        
        $batch  = \app\models\BatchmgmtdtlsTbl::find()->where(['=','batchmgmtdtls_pk',$carddetail->lcd_batchmgmtdtls_fk])->one();
        $regPk = $batch->bmd_opalmemberregmst_fk;
        $filename = 'card_'.$standardcoursemst->standardcoursemst_pk .'_'.$staff->staffinforepo_pk.'_print.pdf';
        $path = "../api/web/learnercard/$regPk/";

        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        
        //QR generate  https://opaloman.om/uat8686/verify-product/?verifylearner=1234#learner
        $qrCode = (new QrCode(''))
        ->setText(Yii::$app->params['website_url']."verify-product/?verifylearner=$verification#learner");
        $qrCode->writeFile(__DIR__ . '/code.png'); 
        $qrcode = '<img src="' . $qrCode->writeDataUri() . '" style="width: 40px; height:40px; padding-top:10px;padding-left:25px;padding-right:15px">';$backendBaseUrl = \Yii::$app->params['backendBaseUrl'];
        $profileimage = '<img src="' . rawurlencode($target_path) . '" style="width:20mm; height:20mm; padding-top:20px;padding-left:15px;padding-bottom:10px;padding-right:15px">';
        //Print PDF generate
        $mpdf = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        //$mpdf->SetProtection(array());
        $mpdf->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
        $mpdf->Output("../api/web/learnercard/$regPk/$filename", 'F');
        $url = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filename";

        //View PDF generate
        $filenameview = 'card_'.$standardcoursemst->standardcoursemst_pk .'_'.$staff->staffinforepo_pk.'_view.pdf';
        $mpdfview = new \Mpdf\Mpdf(['mode' => '','format' => [85.60, 53.98],'margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 00,'margin_header' => 0,'margin_footer' => 00]);
        $mpdfview->SetProtection(array());
        $mpdfview->WriteHTML($this->renderPartial('../../view/pdf/id-card',['qrcode'=>$qrcode, 'userdata' => $userdata, 'profileimage'=>$profileimage]));
        $mpdfview->Output("../api/web/learnercard/$regPk/$filenameview", 'F');
        $viewurl = Yii::$app->params['opal_cert_path']."/web/learnercard/$regPk/$filenameview";
        

        foreach($carddetails as $item){
            $card = \app\models\LearnercarddtlsTblQuery::movecardtohistory($item['learnercarddtls_pk']);
            if($card){

                $newcard = [
                    'lcd_staffinforepo_fk' => $item['lcd_staffinforepo_fk'],
                    'lcd_batchmgmtdtls_fk' => $item['lcd_batchmgmtdtls_fk'],
                    'lcd_learnerreghrddtls_fk' => $item['lcd_learnerreghrddtls_fk'],
                    'lcd_standardcoursemst_fk' => $item['lcd_standardcoursemst_fk'],
                    'lcd_standardcoursedtls_fk' => $item['lcd_standardcoursedtls_fk'],
                    'lcd_categoryname' => $item['lcd_categoryname'],
                    'lcd_subcategoryname' => $item['lcd_subcategoryname'],
                    'lcd_isprinted' =>  $item['lcd_isprinted'],
                    'lcd_serialno' => $item['lcd_serialno'],
                    'lcd_cardexpiry' => $item['lcd_cardexpiry'],
                    'lcd_cardissuedate' => date('Y-m-d'),
                    'lcd_plaincard' => $item['lcd_isprinted'] == 1 ? $url : null,
                    'lcd_viewcardpath' => $item['lcd_isprinted'] == 1 ? $viewurl : null,
                    'lcd_verificationno' =>  $verification,
                    'lcd_status' => $item['lcd_cardexpiry'] ? (strtotime($item['lcd_cardexpiry']) < strtotime(date('Y-m-d'))) ? 2 : 1 : 1,
                    'lcd_createdon' => date('Y-m-d H:i:s'),
                    'lcd_createdby' => $userPk,
                ];
                $ncard = new \app\models\LearnercarddtlsTbl($newcard);
                
                if($ncard->save()){

                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($ncard->getErrors());
                    die;
                }
            }else{
                $transaction->rollBack();
                echo "<pre>";
                print_r($card->getErrors());
                die;
            }
        }
        $transaction->commit();
        if($card){
            return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => "Card deactivated successfully" ];
        }else{
            return [ 'msg' => 'Fail', 'status' => 2, 'flag' => 'F', 'data' => "Card not deactivated " ];
        }
    }

}