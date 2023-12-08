<?php
namespace api\modules\skyc\controllers;

use Yii;
use yii\web\Response;
use \common\components\Security;
use common\components\Drive;
use \common\components\Common;
use \yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\Controller;
use api\modules\skyc\controllers\SkycardMasterController;
use common\components\Sessionn;
use common\components\Configsession;
use common\models\StkholderaccessmstTbl;
  

// use \api\modules\skyc\models\MemcompskycardTbl;
use \api\modules\skyc\models\MemcompskycardhdrTbl;
use \api\modules\skyc\models\MemcompskycarddtlsTbl;
use \api\modules\skyc\models\MemcompskycardmapTbl;

use \api\modules\ct\models\JdomodulemstTbl;
use \api\modules\ct\models\JdomodulehdrTbl;
use \api\modules\ct\models\JdomoduledtlTbl;
use \api\modules\ct\models\JdotargetmemberTbl;
use \api\modules\ct\models\JdodiscusshdrTbl;
use \api\modules\ct\models\JdouserpreferenceTbl;
use \api\modules\ct\models\JdodiscussdtlTbl;
use \api\modules\ct\models\JdodiscussmemberTbl;
use \api\modules\ct\models\JdodiscussmemberTblQuery;
use \api\modules\ct\models\JdodiscussmsgreadTbl;
use \api\modules\ct\models\JdotargetmemberTblQuery;

use \common\models\MemcompproddtlsTbl;
use \common\models\MemcompservicedtlsTbl;
use \common\models\MemcompfiledtlsTbl;
use \common\models\DepartmentmstTbl;
use \api\modules\mst\models\DesignationmstTbl;


use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use \common\models\UsermstTbl;
use \common\models\MembercompanymstTbl;



class SkycardController extends SkycardMasterController{

    public $modelClass = '\api\modules\skyc\models\MemcompskycardhdrTbl';//MemcompprofcertfdtlsTbl
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }
    
    public function beforeAction($action) {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();
 
        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            
        }
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



    public function actionGet_prod_mapped_user($prod_pk,$Stype) {

        $user_dept_idss=array();
        $user_designation_ids=array();

        // echo"\n\n prod_pk $prod_pk\n";
        
        if($Stype=='P')
        {
            $mappeduser_idss = MemcompproddtlsTbl::find()
            ->select([
                'MemCompProdDtls_Pk as pdtPk',
                'MCPrD_DisplayName as prod_name',
                'mcprd_prodrefno as prod_ref_no',
                'mcprd_prodcoverimgfile as imagePK',
                'MCPrD_MemberCompMst_Fk as compk',
                'mcprd_updatedby as img_upby',
                'mcprd_contactinfo'

            ])->where(['MemCompProdDtls_Pk' => $prod_pk])->asArray()->one();
        } 
        
        $prodImg = Drive::generateUrl($mappeduser_idss['imagePK'],$mappeduser_idss['compk'],$mappeduser_idss['img_upby']);
        $mappeduser_idss['prodImg']=$prodImg;

       
        if(!empty($mappeduser_idss) && $mappeduser_idss['mcprd_contactinfo']!='')
        {

        
            $user_idss=array_map('intval', explode(',', $mappeduser_idss['mcprd_contactinfo']));
            $user_pks=$mappeduser_idss['mcprd_contactinfo'];
            $mapped_user_details = \common\models\UsermstTbl::find()->select(['um_departmentmst_fk','UM_Designation'])->where(['in','UserMst_Pk',$user_idss])->asArray()->all();
        
            if($mapped_user_details)
            {
                foreach($mapped_user_details as $user_det)
                {
                    if(!in_array($user_det['um_departmentmst_fk'],$user_dept_idss))
                    {
                        if(strpos($user_det['um_departmentmst_fk'],','))
                        {
                            $user_dep_ids=explode(',',$user_det['um_departmentmst_fk']);
                            foreach($user_dep_ids as $dids) 
                            {
                                array_push($user_dept_idss,$dids);
                            }          
                        }else{
                            array_push($user_dept_idss,$user_det['um_departmentmst_fk']);

                        }
                    }
                    array_push($user_designation_ids,$user_det['UM_Designation']);
                }    
            }

           
            //   $mappedUserList =  \common\models\UsermstTbl::find()
            //     ->select([
            //         'UserMst_Pk as userPk',
            //         "concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",
            //         'dsg_designationname as designation', 
            //         'DepartmentMst_Pk as departmentId', 
            //         'DM_Name as departmentName', 
            //         'UM_EmailID as emailId', 
            //         'um_primobno as mobileNo', 
            //         'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCC',
            //         'UM_Status as onlineStatus'
            //     ])
            //     ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
            //     ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
            //     ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
            //     ->where([
            //     'in','UserMst_Pk',$user_idss
            //     ])
            //     ->groupBy(['DepartmentMst_Pk','UserMst_Pk'])
            //     ->orderBy([
            //         'DM_Name'=>SORT_ASC,
            //         'um_firstname'=>SORT_ASC
            //     ])
            //     ->asArray()
            //     ->all();

            $mappedUserList=UsermstTbl::find()
            ->select(['um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'])
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
            ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
            ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
            ->where("UserMst_Pk in ($user_pks)")
            ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
            ->orderBy('DM_Name asc')
            ->asArray()
            ->all();

                // echo"<pre>";
                // print_r($mappedUserList);
                // exit; 

                if (!empty($mappedUserList)) {
                    $depPK = [];
                    foreach ($mappedUserList as $key => $value) {
                        $userArray = [];
                        foreach ($mappedUserList as $key => $userVal) {

                            $userVal['userImg'] = Drive::generateUrl($userVal['userImg'], $userVal['compPk'], $userVal['userPk']);
                            if ($value['departmentId'] == $userVal['departmentId']) {
                                $userArray[] = $userVal;
                            }
                        }
                        if (!in_array($value['departmentId'], $depPK)) {
                            $user_dept[] = ['departName' => $value['departmentName'],'depID'=>$value['departmentId'], 'userArray' => $userArray];
                            $depPK[] = $value['departmentId'];
                        }
                    }
                }


                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'userData' => $user_dept,
                    'prodDetails'=>$mappeduser_idss
                );
               

        }
        
        return $result;
       
    }

    
    public function actionSaveskycard()
    {

        
        $Skycard_postData = file_get_contents('php://input');
        $skyc_data = json_decode($Skycard_postData, true);

        $rec_pks=[];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date=date('Y-m-d H:i:s');
        $ip_address = Common::getIpAddress();
        
        // echo"<pre>";
        // print_r($skyc_data);
        // exit;

        $dishdrtbl_pk='';
        if(!empty($skyc_data))
        {

            
            $topic=$skyc_data['skyc_sub'];
            $messages=$skyc_data['skyc_msg'];
            $filepks=$skyc_data['file_attachment'][0];

            if($userPK!='' && $userPK!=null && $userPK!="undefined")
            {

                //code to find is this is new skycard start
                $getRecList = MemcompskycardhdrTbl::find()->select(['mcsdm_participants'])
                ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
                ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
                ->where([
                    'mcosc_name_usremst_fk' => $userPK
                    ])
                ->asArray()->all();

                    
                if(!empty($getRecList))
                {

                    foreach($getRecList as $rec_pk)
                    {
                        if(!empty($rec_pk['mcsdm_participants']) && $rec_pk['mcsdm_participants']!=null){
                            if(!in_array($rec_pk['mcsdm_participants'],$rec_pks))
                            {
                                array_push($rec_pks,$rec_pk['mcsdm_participants']);
                            }
                        }
                        
                    }
                }

                // echo"<pre>\n";
                // print_r($rec_pks);
                // exit;
                

                if(!empty($skyc_data['selected_users_pk']))
                {
                   
                        
                        $targerUser_PK_arr=$skyc_data['selected_users_pk'];
                        array_unshift($targerUser_PK_arr,$userPK);
                        

                        if($skyc_data['stype']=='P')
                        {
                            $bText='product';
                            $b_pk=\common\models\BasemodulemstTbl::find()->select(['basemodulemst_pk'])->where(['like','bmm_name','%'.$bText.'%', false])->asArray()->one();
                        }else if($skyc_data['stype']=='S'){
                            $bText='service';
                            $b_pk=\common\models\BasemodulemstTbl::find()->select(['basemodulemst_pk'])->where(['like','bmm_name','%'.$bText.'%', false])->asArray()->one();
                        }

                        $primary_userPK=$skyc_data['selected_users_pk'][0];

                        $skycardModel=MemcompskycardhdrTbl::find()
                        // ->where(['mcosc_prirecv_usremst_fk'=>$primary_userPK])
                        ->where(['mcosc_name_usremst_fk'=>$userPK])
                        ->one();

                        

                        $exitingSkycUser=0;
                        foreach($skyc_data['selected_users_pk'] as $selUser){
                           
                            if(!in_array($selUser,$rec_pks)){
                                $exitingSkycUser=1;
                            }
                        }

                        // echo"<pre>exitingSkycUser $exitingSkycUser\n ";
                        // print_r($skycardModel);


                        // echo"\nhdr pk";
                        // print_r($skycardModel->memcompskycardhdr_pk);
                        // exit;
                        
                        if(empty($skycardModel) || $exitingSkycUser==1)
                        {

                            $skycardModel=new MemcompskycardhdrTbl();
                            $skycardModel->mcosc_name_usremst_fk = $userPK;
                            $skycardModel->mcosc_createdon = $date;
                            $skycardModel->mcosc_createdby = $userPK;
                            $skycardModel->mcosc_createdbyipaddr = $ip_address;

                            // //temparary
                            // $skycardModel->mcosc_updatedon=$date;
                            // $skycardModel->mcosc_updatedby=$userPK;
                        
                        }else{
                             $skycardModel->mcosc_updatedon=$date;
                             $skycardModel->mcosc_updatedby=$userPK;
                             $skycardModel->mcosc_updatedbyipaddr=$ip_address;
                             if(!$skycardModel->save()){
                                $result = array(
                                    'status' => 200,
                                    'status_msg' => 'error',
                                    'flag'=>'E',
                                    'msg'=>'Something went wrong!',
                                    'returndata' => $skycardModel->getErrors()
                                );
                                return $result;
                            }
                        }

                     
                        // $skycardModel->mcosc_updatedon=null;

                        if($skycardModel->save()){

                            // $skycard_dtlsModel=MemcompskycardhdrTbl::find()
                            // ->leftJoin('memcompskycarddtls_tbl',' mcosd_memcompskycardhdr_fk = memcompskycardhdr_pk')
                            // ->where(['mcosc_name_usremst_fk'=>$userPK])
                            // ->andwhere(['mcosd_memcompskycardhdr_fk'=>$skycardModel->memcompskycardhdr_pk])
                            // ->one();
                            // if(empty($skycard_dtlsModel)){
                                $skycard_dtlsModel=new MemcompskycarddtlsTbl();
                                $skycard_dtlsModel->mcosd_memcompskycardhdr_fk=$skycardModel->memcompskycardhdr_pk;
                                $skycard_dtlsModel->mcosd_basemodulemst_fk=$b_pk['basemodulemst_pk'];
                                $skycard_dtlsModel->mcosd_shared_fk=$skyc_data['selected_prod_pk'];
                                // $skycard_dtlsModel->mcosd_isnewtag = $is_new_tag;
                                // $skycard_dtlsModel->mcosd_participants=$targetuser_pk;
                                // $skycard_dtlsModel->mcosd_participantstype=($primary_userPK==$targetuser_pk)?1:2;
                                $skycard_dtlsModel->mcosd_createdon = $date;
                                $skycard_dtlsModel->mcosd_createdby = $userPK;
                                $skycard_dtlsModel->mcosd_createdbyipaddr = $ip_address;

                                //temp
                                // $skycard_dtlsModel->mcosd_updatedon=$date;
                                // $skycard_dtlsModel->mcosd_updatedby=$userPK;
                                if(!$skycard_dtlsModel->save()){
                                    $result = array(
                                        'status' => 200,
                                        'status_msg' => 'error',
                                        'flag'=>'E',
                                        'msg'=>'Something went wrong!',
                                        'returndata' => $skycard_dtlsModel->getErrors()
                                    );
                                    return $result;
                                }
                             

                            // }else
                            // {
                               
                            //     $skycard_dtlsModel->mcosd_updatedon=$date;
                            //     $skycard_dtlsModel->mcosd_updatedby=$userPK;
                            //     $skycard_dtlsModel->mcosd_updatedbyipaddr=$ip_address;
                            //     if(!$skycard_dtlsModel->save()){
                            //         $result = array(
                            //             'status' => 200,
                            //             'status_msg' => 'error',
                            //             'flag'=>'E',
                            //             'msg'=>'Something went wrong!',
                            //             'returndata' => $skycard_dtlsModel->getErrors()
                            //         );
                            //         return $result;
                            //     }
                             
                                
                            // }

                            foreach($skyc_data['selected_users_pk'] as $targetuser_pk){

                                $isalreadyexist=0;

                                if(!in_array($targetuser_pk,$rec_pks))
                                {
                                    $is_new_tag=2;
                                }
                                else{

                                    $checkTageViewVal=MemcompskycardmapTbl::find()->where(['mcsdm_participants'=>1024])
                                    ->andwhere(['mcsdm_isnewtag'=>2])
                                    ->asArray()->one();
                                    if(!empty($checkTageViewVal)){
                                        $is_new_tag=2;
                                    }else{
                                        $is_new_tag=1;
                                    }
                    
                                    $isalreadyexist=1;
                                }
                                

                                $skycard_mapModel=new MemcompskycardmapTbl();
                                $skycard_mapModel->mcsdm_memcompskycarddtls_fk=$skycard_dtlsModel->memcompskycarddtls_pk ;
                                $skycard_mapModel->mcsdm_participants=$targetuser_pk;
                                $skycard_mapModel->mcsdm_participantstype=($primary_userPK==$targetuser_pk)?1:2;
                                $skycard_mapModel->mcsdm_isnewtag = $is_new_tag;
                                $skycard_mapModel->mcsdm_createdon = $date;
                                $skycard_mapModel->mcsdm_createdby = $userPK;
                                $skycard_mapModel->mcsdm_createdbyipaddr = $ip_address;

                                //temp

                                // $skycard_mapModel->mcsdm_updatedon = $date;
                                // $skycard_mapModel->mcsdm_updatedby = $userPK;

                                if($isalreadyexist==1)
                                {
                                   
                                    $updatedOndtls = Yii::$app->db->createCommand('UPDATE memcompskycardmap_tbl SET mcsdm_updatedon="'.$date.'" ,mcsdm_updatedby="'.$userPK.'",mcsdm_updatedbyipaddr="'.$ip_address.'" WHERE mcsdm_participants="'.$targetuser_pk.'" and mcsdm_createdby="'.$userPK.'"');
                                    $updatedOndtls_result=$updatedOndtls->execute();
                                    if(!$updatedOndtls_result)
                                    {
                                        $result = array(
                                            'status' => 200,
                                            'status_msg' => 'error',
                                            'flag'=>'E',
                                            'msg'=>'Something went wrong in updating the data in memcompskycardmap_tbl !',
                                            'returndata' => 0
                                        );
                                        return $result;
                                    }
        
                                }
                                // $skycard_mapModel->mcosd_updatedon=null;
                                $flag = "S";

                                if(!$skycard_mapModel->save())
                                {
                                    $flag='E';
                                    return $skycard_mapModel;
                                }
                            }
                            // echo"\n\nflag $flag\n";
                            if($flag!='E')
                            {
                                $jdomodule=new JdomodulemstTbl();
                                $jdomodule->jdmm_modulename="Skycard";
                                $jdomodule->jdmm_status=1;
                                $jdomodule->jdmm_createdon=$date;
                                $jdomodule->jdmm_createdby=$userPK;
                                $jdomodule->jdmm_createdbyipaddr=$ip_address;
                                if($jdomodule->save())
                                {
                                    $jdomodulehdr=new JdomodulehdrTbl();
                                    $get_regPk=\common\models\UsermstTbl::find()->select(['UM_MemberRegMst_Fk'])->innerJoin('memberregistrationmst_tbl','UM_MemberRegMst_Fk = memberregistrationmst_tbl.MemberRegMst_Pk')->where([
                                        'UserMst_Pk'=> $userPK
                                        ])->one();
                                    
                                    $jdomodulehdr->jdmh_memberregmst_fk=$get_regPk->UM_MemberRegMst_Fk;
                                    $jdomodulehdr->jdmh_jdomodulemst_fk=$jdomodule->jdomodulemst_pk;
                                    $jdomodulehdr->jdmh_createdon=$date;
                                    $jdomodulehdr->jdmh_createdby=$userPK;
                                    $jdomodulehdr->jdmh_createdbyipaddr=$ip_address;
                                    if($jdomodulehdr->save())
                                    {
                                        $jdomoduledtl=new JdomoduledtlTbl();
                                        $digits = 4;
                                        $random_UID="SC".rand(pow(10, $digits-1), pow(10, $digits)-1);
                                        $jdomoduledtl->jdmd_jdomodulehdr_fk=$jdomodulehdr->jdomodulehdr_pk;
                                        $jdomoduledtl->jdmd_uid="$random_UID";
                                        $jdomoduledtl->jdmd_shared_type=3;
                                        $jdomoduledtl->jdmd_shared_fk=$skycard_dtlsModel->memcompskycarddtls_pk;
                                        $jdomoduledtl->jdmd_title=$topic;
                                        $jdomoduledtl->jdmd_subject=$messages;
                                        $jdomoduledtl->jdmd_type=2;
                                        $jdomoduledtl->jdmd_upload_filepath=$filepks;
                                        $jdomoduledtl->jdmd_status=1;
                                        $jdomoduledtl->jdmd_createdon=$date;
                                        $jdomoduledtl->jdmd_createdby=$userPK;
                                        $jdomoduledtl->jdmd_createdbyipaddr=$ip_address;
                                        if($jdomoduledtl->save())
                                        {

                                            
                                            foreach($targerUser_PK_arr as $targetuserPK){

                                                $get_rec_compmst=\common\models\UsermstTbl::find()->select(['membercompanymst_tbl.MemberCompMst_Pk'])->innerJoin('membercompanymst_tbl','UM_MemberRegMst_Fk = membercompanymst_tbl.MCM_MemberRegMst_Fk')->where([
                                                    'UserMst_Pk'=> $targetuserPK
                                                    ])->asArray()->one();
        
                                                $jdojdotargetmember=new JdotargetmemberTbl();
                                                $jdojdotargetmember->jdtm_jdomoduledtl_fk=$jdomoduledtl->jdomoduledtl_pk;
                                                $jdojdotargetmember->jdtm_usertype=2;
                                                $jdojdotargetmember->jdtm_target_membercompmst_fk=$get_rec_compmst['MemberCompMst_Pk'];
                                                $jdojdotargetmember->jdtm_target_usermst_fk=$targetuserPK;
                                                $jdojdotargetmember->jdtm_invitestatus=($targetuserPK==$userPK)?1:3;
                                                $jdojdotargetmember->jdtm_userstatus=($targetuserPK==$userPK)?2:1;
                                                $jdojdotargetmember->jdtm_createdon=$date;
                                                $jdojdotargetmember->jdtm_createdby=$userPK;
                                                $jdojdotargetmember->jdtm_createdbyipaddr=$ip_address;
                                                $jdojdotargetmember->jdtm_invitedon =$date;
                
                                                if(!$jdojdotargetmember->save())
                                                {
                                                    $flag='E';
                                                    print_r($jdojdotargetmember->getErrors());
                                                    return $jdojdotargetmember;
                                                }
                                            }
                                            if($flag!='E')
                                            {
                                                $jdopreferenceModel = new JdouserpreferenceTbl;
                                                $jdopreferenceModel->jdup_usermst_fk = $userPK;
                                                $jdopreferenceModel->jdup_shared_type = 2;
                                                $jdopreferenceModel->jdup_shared_fk = $jdomoduledtl->jdomoduledtl_pk;
                                                $jdopreferenceModel->jdup_category = 1;
                                                $jdopreferenceModel->jdup_status = 1;
                                                $jdopreferenceModel->jdup_createdon = $date;
                                                $jdopreferenceModel->jdup_createdby = $userPK;
                                                $jdopreferenceModel->jdup_createdbyipaddr = $ip_address;
                                                if($jdopreferenceModel->save())
                                                {

                                                    $creator_target_pk=JdotargetmemberTbl::find()->where(['jdtm_target_usermst_fk'=>$userPK])
                                                            ->andwhere(['jdtm_jdomoduledtl_fk'=>$jdomoduledtl->jdomoduledtl_pk])->one()->jdotargetmember_pk;

                                                    $jdodishdrdtls = new JdodiscusshdrTbl();
                                                    $jdodishdrdtls->jddh_jdomoduledtl_fk = $jdomoduledtl->jdomoduledtl_pk;
                                                    $jdodishdrdtls->jddh_creator_jdotargetmember_fk = $creator_target_pk;
                                                    $jdodishdrdtls->jddh_status = 1;
                                                    $jdodishdrdtls->jddh_createdby = $userPK;
                                                    $jdodishdrdtls->jddh_createdon = $date;
                                                    $jdodishdrdtls->jddh_createdbyipaddr = $ip_address;
                                                    $jdodishdrdtls->jddh_topic = $topic;
                                                    $jdodishdrdtls->jddh_desc = $messages;
                                                    $jdodishdrdtls->jddh_filepath =$filepks;
                                                    if($jdodishdrdtls->save())
                                                    {
                                                        foreach($targerUser_PK_arr as $targetuserPK){

                    
                                                            $user_target_pk=JdotargetmemberTbl::find()->where(['jdtm_target_usermst_fk'=>$targetuserPK])
                                                            ->andwhere(['jdtm_jdomoduledtl_fk'=>$jdomoduledtl->jdomoduledtl_pk])->one()->jdotargetmember_pk;

                                                            $dishdrtbl_pk=$jdodishdrdtls->jdodiscusshdr_pk;

                                                            $jdodiscussmbrModel = new JdodiscussmemberTbl();
                                                            $jdodiscussmbrModel->jddm_jdodiscusshdr_fk = $jdodishdrdtls->jdodiscusshdr_pk;
                                                            $jdodiscussmbrModel->jddm_jdotargetmember_fk = $user_target_pk;
                                                            $jdodiscussmbrModel->jddm_status = 1;
                                                            $jdodiscussmbrModel->jddm_createdon = $date;
                                                            $jdodiscussmbrModel->jddm_createdby = $userPK;
                                                            $jdodiscussmbrModel->jddm_createdbyipaddr = $ip_address;
            
                                                            if (!$jdodiscussmbrModel->save()) 
                                                            {
                                                                $flag='E';
                                                                print_r($jdodiscussmbrModel->getErrors());
                                                                return $jdodiscussmbrModel;
                                                            }
                                                        }
                                                        if($flag!='E')
                                                        {
                                                            $user_discsmbr_pk=JdodiscussmemberTbl::find()
                                                            ->leftJoin('jdodiscusshdr_tbl','jddh_creator_jdotargetmember_fk=jddm_jdotargetmember_fk')
                                                            ->where(['jddm_jdodiscusshdr_fk'=>$jdodishdrdtls->jdodiscusshdr_pk])->one()->jdodiscussmember_pk;

                                                            $discussdtlTblmodel = new JdodiscussdtlTbl();
                                                            $discussdtlTblmodel->jddd_jdodiscusshdr_fk = $jdodishdrdtls->jdodiscusshdr_pk;
                                                            $discussdtlTblmodel->jddd_jdodiscussmember_fk = $user_discsmbr_pk;
                                                            $discussdtlTblmodel->jddd_messagetype=1;
                                                            $discussdtlTblmodel->jddd_reply_message = $messages;
                                                            $discussdtlTblmodel->jddd_reply_filepath = $filepks;          
                                                            $discussdtlTblmodel->jddd_createdbyipaddr = $ip_address;
                                                            $discussdtlTblmodel->jddd_createdby = $userPK;
                                                            $discussdtlTblmodel->jddd_createdon = $date;
                                                            $discussdtlTblmodel->jddd_isdeleted = 2;
                                            
                                                            if($discussdtlTblmodel->save())
                                                            {
                                                                $JdodiscussmsgreadTbl=new JdodiscussmsgreadTbl();

                                                                $JdodiscussmsgreadTbl->jddmr_jdodiscussdtl_fk=$discussdtlTblmodel->jdodiscussdtl_pk;

                                                                $JdodiscussmsgreadTbl->jddmr_received_jdodiscussmember_fk=$discussdtlTblmodel->jddd_jdodiscussmember_fk;
                                                                $JdodiscussmsgreadTbl->jddmr_isread=1;
                                                                $JdodiscussmsgreadTbl->jddmr_isdeleted=2;
                                                                $JdodiscussmsgreadTbl->jddmr_createdon=$date;
                                                                $JdodiscussmsgreadTbl->jddmr_createdby=$userPK;
                                                                $JdodiscussmsgreadTbl->jddmr_createdbyipaddr=$ip_address;

                                                                if($JdodiscussmsgreadTbl->save()){

                                                                    // $sendEmail=self::sendMail($skyc_data['selected_users_pk']);

                                                                    $result = array(
                                                                        'status' => 200,
                                                                        'status_msg' => 'success',
                                                                        'flag'=>'S',
                                                                        'msg'=>'Skycard Dropped Successfully',
                                                                        'returndata' => 0
                                                                    );
                                                                    
                                                                }else{
                                                                    print_r($JdodiscussmsgreadTbl->getErrors());
                                                                }

                                                            }else{
                                                                print_r($discussdtlTblmodel->getErrors());
                                                            }
                                                        }else{
                                                            print_r($jdodiscussmbrModel->getErrors());
                                                        }
                                                    }else{
                                                        print_r($jdodishdrdtls->getErrors());
                                                    }
                                                }else{
                                                    print_r($jdopreferenceModel->getErrors());
                                                }
                                            }else{
                                                print_r($jdojdotargetmember->getErrors());
                                            }

                                        }else{
                                            print_r($jdomoduledtl->getErrors());
                                        }
                                    }else{
                                        print_r($jdomodulehdr->getErrors());
                                    }

                                }else{
                                    print_r($jdomodule->getErrors());
                                }
                            }else{
                                print_r($skycard_dtlsModel->getErrors());
                            }
                            

                        }
                        else
                        {
                            $result = array(
                                'status' => 200,
                                'status_msg' => 'error',
                                'flag'=>'E',
                                'msg'=>'Something went wrong!',
                                'returndata' => $skycardModel->getErrors()
                            );

                        }
                }


            }
        }


        return $result;

    }

    public function actionSkycarddetails()
    {


        // $page,$size,$searchText,$sortType,$desgn,$dep,$countryPk
        $request = Yii::$app->request->post();

        // echo"\n\n<pre>request  ";
        // print_r($request);
        // exit;

        $page = $request['page'];
        $size = $request['size'];
        $searchText = $request['searchText'];
        $sortType = $request['sortType'];
        $desgn = $request['desgn'];
        $dep = $request['filterdata']['dep'];
        $countryPk=$request['filterdata']['countryPk'];
        $selectedskycUser=$request['selectedskycUser'];
        $createdOnstartdate=date("Y-m-d",strtotime($request['filterdata']['createdOn']['startDate']));
        $createdOnenddate=date('Y-m-d',strtotime($request['filterdata']['createdOn']['endDate']));
        $updatedOnstartdate=date('Y-m-d',strtotime($request['filterdata']['updateOn']['startDate']));
        $updatedOnenddate=date('Y-m-d',strtotime($request['filterdata']['updateOn']['endDate']));
        
    
        // echo"\n\n<pre>createdON  ";
        // print_r($createdOnstartdate);

        // echo"\n\n <pre>updatedON";
        // print_r($updatedOnenddate);
        // exit;
        
        // echo"\nselectedskycUser $selectedskycUser\n";
       if(!empty($selectedskycUser) && $selectedskycUser!=null){
        $skyc_user_pk=$selectedskycUser;
       }else{
        $skyc_user_pk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       }
        // $skyc_user_pk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $date_format='%d-%m-%Y';
        $rec_card=[];
        $drop_card=[];

        $skycard_user_data=\common\models\UsermstTbl::find()
        ->select([
            'UM_EmpId as EmpId',
            'UserMst_Pk as userPk',
            'um_firstname',
            'um_lastname',
            "concat_ws(um_firstname,' ',um_middlename,' ',um_lastname) as 'membername'",
            'dsg_designationname as des_name', 
            'DepartmentMst_Pk as depId', 
            'DM_Name as dep_name', 
            'UM_EmailID as emailId', 
            'um_primobno as mobileNo', 
            'CyM_CountryName_en as countryName',
            'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCC',
            'um_userdp',
            'CountryMst_Pk as country_code',
            'MemberCompMst_Pk as companyPk',
           
            ])
            ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
            ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
            ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk=um_userdp')
            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->where(['UserMst_Pk'=>$skyc_user_pk])->asArray()->one();

            $skycard_user_data['userImage'] = Drive::generateUrl($skycard_user_data['um_userdp'],$skycard_user_data['companyPk'],$skyc_user_pk);
      
        if(!empty($skycard_user_data))
        {

                //code to get received skycard start
                $get_rec_skycard_details=MemcompskycardhdrTbl::find()->select([
                    'memcompskycardhdr_pk as skycardPk',
                    'mcosc_name_usremst_fk',
                  
                    'skycdtls.memcompskycarddtls_pk as skycarddtlsPK',
                    'skycdtls.mcosd_shared_fk',

                    'mcsdm_participants as target_userpk',
                    'mcsdm_participantstype as skycard_type',
                    'mcsdm_isnewtag',
                  
                    // "COALESCE(date_format(min(mcosc_createdon),'$date_format'),'') as createdon1",
                    // "COALESCE(date_format(date(max(skycdtls.mcosd_updatedon)),'$date_format'),'') as updatedon1",
                    "COALESCE(date_format(mcosc_createdon,'$date_format'),'') as createdon1",
                    "COALESCE(date_format(date(mcosc_updatedon),'$date_format'),'') as updatedon1",
                    'UM_EmpId as EmpId',
                    'UserMst_Pk as userPk',
                    "COALESCE(um_firstname,'') as um_firstname",
                    "COALESCE(um_lastname,'') as um_lastname",
                    // 'um_lastname',
                    'dsg_designationname as des_name', 
                    'DepartmentMst_Pk as depId', 
                    'DM_Name as dep_name', 
                    'UM_EmailID as emailId', 
                    'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCC',
                    'um_primobno as mobileNo', 
                    'CyM_CountryName_en as countryName',
                    'MCM_MemberRegMst_Fk as reg_fk',
                    'MemberCompMst_Pk as comp_pk',
                    'MCM_SupplierCode',
                    'MCM_CompanyName as comp_name',
                    'um_userdp as imgpk',
                    'CountryMst_Pk as country_code',
                    'mcm_complogo_memcompfiledtlsfk as complogopk',
                    'UM_Status as onlineStatus',
                    "COALESCE(um_landlineno,'') as um_landlineno",
                    'um_landlineext',
                    'jdomoduledtl_pk',
                    'jdodiscusshdr_pk',
                    'memcompskycardhdr_pk',
                    "group_concat(distinct(jdomoduledtl_pk)) as modpks"


                ])
                ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
                ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
                ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
                ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
                ->leftJoin('usermst_tbl','UserMst_Pk=mcosc_name_usremst_fk')
                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=UM_MemberRegMst_Fk')
                ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
                ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
                ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
                ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
                ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk=mcm_complogo_memcompfiledtlsfk')
                ->where([
                    'mcsdm_participants'=> $skyc_user_pk,
                    ])
                ->andwhere([
                        'jdomoduledtl_tbl.jdmd_shared_type'=> 3,
                ]);
                if (!empty($searchText) && $searchText != null) {
                    $get_rec_skycard_details->andFilterWhere(['or', ['like', 'um_firstname', $searchText], ['like', 'um_lastname', $searchText],['like', 'dsg_designationname', $searchText],['like', 'DM_Name', $searchText],['like', 'UM_EmailID', $searchText]]);
                }

                if (!empty($desgn) && $desgn != null && !empty($dep) && $dep != null && !empty($countryPk) && $countryPk != null) {

                    $get_rec_skycard_details->andFilterWhere(['like', 'um_primobnocc', $countryPk])
                    ->andFilterWhere(['like', 'dsg_designationname', $desgn])
                    ->andFilterWhere(['like', 'DM_Name', $dep]);
                }

                if(!empty($request['filterdata']['createdOn']) && !empty($request['filterdata']['updateOn'])){
                   
                    $get_rec_skycard_details->andwhere(['between', 'mcosc_createdon', $createdOnstartdate, $createdOnenddate ])
                    ->andwhere(['between', 'date(mcosc_updatedon)', $updatedOnstartdate, $updatedOnenddate ]);
                }
                
                if(!empty($sortType) && $sortType!='')
                {
                    if($sortType=='new')
                    {
                        // $get_rec_skycard_details->orderBy([
                            
                        //     'max(mcosc_createdon)'=>SORT_DESC,
                        // ]);
                        $get_rec_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_DESC]);
                    }else{
                        $get_rec_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_ASC]);
                    }
                    
                }else{
                    
                    // $get_rec_skycard_details->orderBy([
                            
                    //     'max(mcosc_createdon)'=>SORT_DESC,
                    // ]);
                    $get_rec_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_DESC]);
                }
                
                $get_rec_skycard_details->groupBy([
                    'mcosc_name_usremst_fk',
                ])
                ->asArray();


                $page_size = (!empty($size)) ? $size : 6;

                $provider = new ActiveDataProvider([ 'query' => $get_rec_skycard_details, 'pagination' => ['pageSize' => $page_size]]);

                // echo"<pre>assaddsdsd\n";
                // print_r($provider->getModels());
                // exit;
              
            //code to get received skycard end


            //code to get dropped skycard start
            $get_drop_skycard_details=MemcompskycardhdrTbl::find()->select([
                'memcompskycardhdr_pk as skycardPk',
                'mcosc_name_usremst_fk',
                'mcosc_createdbyipaddr',
               
                'skycdtls.memcompskycarddtls_pk as skycarddtlsPK',
                'skycdtls.mcosd_shared_fk',
                
                'mcsdm_participants as target_userpk',
                'mcsdm_participantstype as skycard_type',
                'mcsdm_isnewtag',
        
                // "COALESCE(date_format(min(mcosc_createdon),'$date_format'),'') as createdon1",
                // "COALESCE(date_format(date(mcosc_updatedon),'$date_format'),'') as updatedon1",
                // "COALESCE(date_format(date(max(skycdtls.mcosd_updatedon)),'$date_format'),'') as updatedon1",
                "COALESCE(date_format(mcosc_createdon,'$date_format'),'') as createdon1",
                "COALESCE(date_format(date(mcosc_updatedon),'$date_format'),'') as updatedon1",
              
                'UM_EmpId as EmpId',
                'UserMst_Pk as userPk',
                'um_firstname',
                'um_lastname',
                "concat_ws(um_firstname,' ',um_middlename,' ',um_lastname) as 'membername'",
                'dsg_designationname as des_name', 
                'DepartmentMst_Pk as depId', 
                'DM_Name as dep_name', 
                'UM_EmailID as emailId', 
                'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCC',
                'um_primobno as mobileNo', 
                'CyM_CountryName_en as countryName',
                'MCM_MemberRegMst_Fk as reg_fk',
                'MemberCompMst_Pk as comp_pk',
                'MCM_SupplierCode',
                'MCM_CompanyName as comp_name',
                'um_userdp as imgpk',
                'CountryMst_Pk as country_code',
                'mcm_complogo_memcompfiledtlsfk as complogopk',
                'UM_Status as onlineStatus',
                'um_landlineno',
                'um_landlineext',
                'jdomoduledtl_pk as jdomoduledtl_pk',
                'jdodiscusshdr_pk',
                "group_concat(distinct(jdomoduledtl_pk)) as modpks"
            ])
            ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
            ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
            ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
            ->leftJoin('usermst_tbl','UserMst_Pk=mcsdm_participants')
            ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=UM_MemberRegMst_Fk')
            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
            ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
            ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
            ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk=mcm_complogo_memcompfiledtlsfk')
            ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
            ->where([
                'mcosc_name_usremst_fk'=> $skyc_user_pk,
                ])
            ->andwhere(['mcosc_createdby'=>$skyc_user_pk])
            ->andwhere([
                'mcsdm_participantstype'=> 1,
            ])
            ->andwhere([
                    'jdomoduledtl_tbl.jdmd_shared_type'=> 3,
            ]);
            if (!empty($searchText) && $searchText != null) {
                $get_drop_skycard_details->andFilterWhere(['or', ['like', 'um_firstname', $searchText], ['like', 'um_lastname', $searchText],['like', 'dsg_designationname', $searchText],['like', 'DM_Name', $searchText],['like', 'UM_EmailID', $searchText]]);
            }
            if (!empty($desgn) && $desgn != null && !empty($dep) && $dep != null && !empty($countryPk) && $countryPk != null) {

                $get_drop_skycard_details->andFilterWhere(['like', 'um_primobnocc', $countryPk])
                ->andFilterWhere(['like', 'dsg_designationname', $desgn])
                ->andFilterWhere(['like', 'DM_Name', $dep]);
            }

            if(!empty($request['filterdata']['createdOn']) && !empty($request['filterdata']['updateOn'])){

                // echo"asdjkahsd";
                $get_drop_skycard_details->andFilterwhere(['between', 'mcosc_createdon', $createdOnstartdate, $createdOnenddate ])
                ->andFilterwhere(['between', 'mcosc_updatedon', $updatedOnstartdate, $updatedOnenddate ]);
            }
            if(!empty($sortType) && $sortType!=null)
            {
                if($sortType=='new')
                {
                    // $get_drop_skycard_details->orderBy([
                        
                    //     'max(mcosc_createdon)'=>SORT_DESC,
                    // ]);
                    $get_drop_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_DESC]);

                }else{
                    // $get_drop_skycard_details->orderBy([
                        
                    //     'max(mcosc_createdon)'=>SORT_ASC,
                    // ]);
                    $get_drop_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_ASC]);
                }
                
            }else{
                // $get_drop_skycard_details->orderBy([
                        
                //     'max(mcosc_createdon)'=>SORT_DESC,
                // ]);
                $get_drop_skycard_details->orderBy(['COALESCE(mcosc_updatedon, mcosc_createdon)' => SORT_DESC]);
            }
            $get_drop_skycard_details->groupBy([
                'mcosd_memcompskycardhdr_fk',
            ])
            ->asArray();
         
            $page_size = (!empty($size)) ? $size : 6;

            $provider_drop = new ActiveDataProvider([ 'query' => $get_drop_skycard_details, 'pagination' => ['pageSize' => $page_size]]);

            //code to get dropped skycard end
        }
        $rec_data=[];
        $drop_data=[];

        // echo"<pre>\n";
        // print_r($provider_drop->getModels());
        // exit;
        if(!empty($provider->getModels()))//$get_rec_skycard_details
        {

           foreach($provider->getModels() as $value)
           {
                $value['companylogo'] = Drive::generateUrl($value['complogopk'],$value['comp_pk'], $value['userPk']).'&noimg=1';

                $value['userImage'] = Drive::generateUrl($value['imgpk'],$value['comp_pk'],$value['userPk']);
                

                $userArray = [];
                $mappedUserArr=[];
                // $userArray = JdodiscussmemberTblQuery::getDiscussionUser($value['jdodiscusshdr_pk']);

                // $userArray=JdotargetmemberTblQuery::getInvitedUserList($value['jdomoduledtl_pk']);

               
                $userArray=self::getInvitedUserList($value['modpks']);
            
                // $mappedUserArr=$userArray['moduleData']['internalUser'];
                $mappedUserArr=array_merge($userArray['moduleData']['internalUser'],$userArray['moduleData']['externalUser']);

                $value['userList'] = $mappedUserArr;

                $rec_data[]=$value;
           }
           $skycard_user_data['recv_skycard']=$rec_data;
        }
        // echo"<pre>\n";
        // print_r($provider_drop->getModels());
        // exit;
        if(!empty($provider_drop->getModels()))//$get_drop_skycard_details
        {
             

           foreach($provider_drop->getModels() as $drop_value)
           {
                
                $drop_value['companylogo'] = Drive::generateUrl($drop_value['complogopk'],$drop_value['comp_pk'], $drop_value['userPk']).'&noimg=1';


                $drop_value['userImage'] = Drive::generateUrl($drop_value['imgpk'],$drop_value['comp_pk'],$drop_value['userPk']);

                $userArray = [];
                $mappedUserArr=[];
                // $userArray = JdodiscussmemberTblQuery::getDiscussionUser($drop_value['jdodiscusshdr_pk']);           
                

                // $userArray=JdotargetmemberTblQuery::getInvitedUserList($drop_value['jdomoduledtl_pk']);
               
                $userArray=self::getInvitedUserList($drop_value['modpks']);

                $mappedUserArr=array_merge($userArray['moduleData']['internalUser'],$userArray['moduleData']['externalUser']);
       
                $drop_value['userList'] = $mappedUserArr;

                $drop_data[]=$drop_value;
           }
           $skycard_user_data['drop_skycard']=$drop_data;
        }

        
       $DiscussionCount=self::getTotalDiscussion($skyc_user_pk);

        // echo"\n<pre>";
        // print_r( $provider_drop->getModels());
        // exit;

        $skycard_user_data['reassign']=[];
        
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'received_count'=>$provider->getTotalCount(),
            'dropped_count'=>$provider_drop->getTotalCount(),
            'skycardData' => $skycard_user_data,
            'DiscussionCount'=>$DiscussionCount,
            'limit' => $page_size
        );

        return $result;
    } 



    public function actionUpdate_skyc_tagview()
    {

       
        $viewTagUpdtData = file_get_contents('php://input');
        $skycard_update_data = json_decode($viewTagUpdtData, true);
        $user_pk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

      
        $sender_user_pk=$skycard_update_data['card_sender_pk'];
        $skycard_pk=$skycard_update_data['skycard_pk'];
        $viewd_time=$updated_time=date('Y-m-d H:i:s');

        // echo"\n skycard_pk $skycard_pk\n";
        // exit;
 

    //    $checkSkycard=MemcompskycardhdrTbl::find()->select(['mcsdm_memcompskycarddtls_fk','mcsdm_participants','mcsdm_isnewtag','mcsdm_tagviewedtime'])
    //    ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
    //     ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
    //     ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
    //    ->where(['memcompskycardhdr_pk'=>$skycard_pk])
    //    ->andwhere(['mcsdm_participants'=>$user_pk])->asArray()->one();


       $checkSkycard=MemcompskycardmapTbl::find()->select(['mcsdm_memcompskycarddtls_fk','mcsdm_participants','mcsdm_isnewtag','mcsdm_tagviewedtime'])
       ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.memcompskycarddtls_pk=mcsdm_memcompskycarddtls_fk') 
        ->leftJoin('memcompskycardhdr_tbl','memcompskycardhdr_pk = skycdtls.mcosd_memcompskycardhdr_fk ')
        // ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
       ->where(['memcompskycardhdr_pk'=>$skycard_pk])
       ->andwhere(['mcsdm_participants'=>$user_pk])
       ->asArray();

        $checkSkycard=$checkSkycard->createCommand()->queryAll();

    //    echo"\n<pre>";
    //    print_r($checkSkycard);
    //    exit;

       if(!empty($checkSkycard)){
            foreach($checkSkycard as $key=>$skyctagup){

                if($skyctagup['mcsdm_isnewtag']!=1){
                    $updateTagvalue = Yii::$app->db->createCommand('UPDATE memcompskycardmap_tbl SET mcsdm_isnewtag=1 ,mcsdm_tagviewedtime="'.$viewd_time.'"  WHERE mcsdm_memcompskycarddtls_fk="'.$skyctagup['mcsdm_memcompskycarddtls_fk'].'" and mcsdm_participants="'.$user_pk.'"');
                    $updated_result=$updateTagvalue->execute();
    
                    if(!$updated_result){
                        $result = array(
                            'status' => 500,
                            'msg' => 'Something went wrong!!',
                            'flag' => 'F',
                            'skycardData' => 0,
                        );
                        return $result;
                    }else{
                        $sFlag='U';
                    }
                }else{
                    $sFlag='NC';
                }
                

            }
            if($sFlag=='U' || $sFlag=='NC'){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'skycardData' =>0 ,
                );
            }
       }
        
        return $result;
    }




    public function getUser($userPK)
    {
        $get_user_data=\common\models\UsermstTbl::find()->select([
            'UM_EmpId as EmpId',
            'UserMst_Pk as userPk',
            'um_firstname',
            'um_lastname',
            "concat_ws(um_firstname,' ',um_middlename,' ',um_lastname) as 'membername'",
            'dsg_designationname as des_name', 
            'DepartmentMst_Pk as depId', 
            'DM_Name as dep_name', 
            'UM_EmailID as emailId', 
            'um_primobno as mobileNo', 
            'CyM_CountryName_en as countryName',
            'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCC',
            'um_userdp',
            'CountryMst_Pk as country_code',
            'MemberCompMst_Pk as companyPk',
            'mcm_complogo_memcompfiledtlsfk as complogopk',
            'MCM_CompanyName as compName',
            'MCM_SupplierCode supCode',
            'um_landlineno',
            'um_landlineext'
            ])->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
            ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
            ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk=um_userdp')
            ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->where(['UserMst_Pk'=>$userPK])->asArray()->one();

            $get_user_data['userImage'] = Drive::generateUrl($get_user_data['um_userdp'],$get_user_data['companyPk'],$userPK);

            $get_user_data['compLogo'] = Drive::generateUrl($get_user_data['complogopk'],$get_user_data['companyPk'], $userPK).'&noimg=1';

        return $get_user_data;
    }


    public function actionAdd_discussion()
    {

        $add_discussiondata = file_get_contents('php://input');
        $skyc_reply_data = json_decode($add_discussiondata, true);

        $filepks =$skyc_reply_data['file_pks'] > 0 ? implode(',', $skyc_reply_data['file_pks']) : null; 
        $message=$skyc_reply_data['reply_msg'];
        $jdodishdrpk = $skyc_reply_data['jdodiscusshdr_pk'];
        $msg_topic=$skyc_reply_data['msg_sub'];
        $selectedProdPK=$skyc_reply_data['prodPK'];
       
        

        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        $discussMemberPK = JdodiscussmemberTbl::find()
            ->leftJoin('jdotargetmember_tbl', 'jddm_jdotargetmember_fk = jdotargetmember_pk')
            ->where(['jddm_jdodiscusshdr_fk' => $jdodishdrpk, 'jdtm_target_usermst_fk' => $userPK])
            ->one()->jdodiscussmember_pk;

        if($jdodishdrpk) {
            $model = new JdodiscussdtlTbl();
            $model->jddd_jdodiscusshdr_fk = $jdodishdrpk;
            $model->jddd_jdodiscussmember_fk = $discussMemberPK;
            $model->jddd_messagetype=1;
            $model->jddd_reply_message = $message;
            $model->jddd_reply_filepath = $filepks;          
            $model->jddd_createdbyipaddr = $ip_address;
            $model->jddd_createdby = $userPK;
            $model->jddd_createdon = date('Y-m-d H:i:s');
            $model->jddd_isdeleted = 2;

            if($model->save()) {
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Message sent Successfully!',
                    'moduelData' => $model,
                    'selectedProdPK'=>$selectedProdPK
                );
            } else {
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors(),
                    'selectedProdPK'=>$selectedProdPK
                );
            }
        }
        
        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }
    

    
    public function actionSkycard_discussion1($sender_pk,$jdomodulePK,$type,$chooseByType,$skyc_pk,$sortType,$selectedManageUser)
    {
        
        // echo"\nskyc_pk $selectedManageUser\n";
        $droppedUserpk=$sender_pk;

        if(!empty($selectedManageUser) && $selectedManageUser!=null){
            $rec_pk=$selectedManageUser;
        }else{
            $rec_pk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }
        
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);
        
        $date_format='%d-%m-%Y';

        if($type=='drop'){

            $getmappedUser= MemcompskycardhdrTbl::find()->select(["group_concat(DISTINCT(skmap.mcsdm_participants)) as mcsdm_participants"])
            ->leftJoin('memcompskycarddtls_tbl skydtls','skydtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk')
            ->leftJoin('memcompskycardmap_tbl as skmap','skmap.mcsdm_memcompskycarddtls_fk=skydtls.memcompskycarddtls_pk')->where(['memcompskycardhdr_pk'=>$skyc_pk])->asArray()->all();
            if(!empty($getmappedUser))
            {
                $userpksss=array_map('intval', explode(',', $getmappedUser[0]['mcsdm_participants']));
            }
        }
 
        // echo"userpksss \n\n";
        // print_r($userpksss);
        // exit;
        $getProdList =  \api\modules\skyc\models\MemcompskycardhdrTbl::find()->select(["group_concat(DISTINCT(jdomoduledtl_pk) ORDER BY mcosd_createdon DESC) as modulepk"])
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk=memcompskycarddtls_pk')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=  skycdtls.memcompskycarddtls_pk');
        if($type=='recv')
        {
            $getProdList->where([
                'memcompskycardmap_tbl.mcsdm_participants'=> $rec_pk
                ])
            ->andwhere([
                'mcosc_name_usremst_fk'=> $droppedUserpk
            ]);
        }elseif($type=='drop'){
            $getProdList->where(['in',
                'memcompskycardmap_tbl.mcsdm_participants',$userpksss
            ])
            ->andwhere([
                'mcosc_name_usremst_fk'=> $rec_pk
            ]);
        }
        $getProdList->andwhere([
            'jdomoduledtl_tbl.jdmd_shared_type'=> 3,
        ]);
       
        $getProdList->asArray()->one();
        $getProdList=$getProdList->createCommand()->queryOne();
        if(!empty($getProdList))
        {
            $modulePks=array_map('intval', explode(',', $getProdList['modulepk']));
        }

        // echo"\n<pre>getProdList\n";
        // print_r($modulePks);
        // exit;
     
       
        $skycard_receiver_data=self::getUser($rec_pk);
        // $sky_sender_data=self::getUser($droppedUserpk);
        
        $skycard_discussionData['skycard_receiver']=$skycard_receiver_data;
        // $skycard_discussionData['skycard_sender']=$sky_sender_data;


        //get the item list which towards the user dropped skycard

        $SkycardData=MemcompskycardhdrTbl::find()->select([
            'memcompskycardhdr_pk as skycardPk',
            'mcosc_name_usremst_fk',
            'mcosc_createdbyipaddr',
            'bmm_name',

            'skycdtls.memcompskycarddtls_pk as skycarddtlsPK',
            'skycdtls.mcosd_basemodulemst_fk as basemodPK',
            'skycdtls.mcosd_shared_fk as item_pk',

            'mcsdm_participants as target_userpk',
            'mcsdm_participantstype as skycard_type',
            'mcsdm_isnewtag',

            "COALESCE(date_format(mcosd_createdon,'$date_format'),'') as skyc_createdon",
            "COALESCE(date_format(date(mcosd_updatedon),'$date_format'),'') as skyc_updatedon",
           

            'jdodiscusshdr_pk', 'jddh_topic', 'jddh_desc', 'UserMst_Pk as userPk', 'MemberCompMst_Pk as companyPk', 'MCM_CompanyName as compName','mcm_complogo_memcompfiledtlsfk as complogopk', 'um_userdp', "CONCAT(UPPER(SUBSTRING(um_firstname,1,1)),LOWER(SUBSTRING(um_firstname,2))) as um_firstname","CONCAT(UPPER(SUBSTRING(um_lastname,1,1)),LOWER(SUBSTRING(um_lastname,2))) as um_lastname", 'jddh_creator_jdotargetmember_fk as creatorMemberPk', 'user.jdtm_target_usermst_fk as currentUserPk','jddh_filepath',
            'DATE_FORMAT(jddh_createdon,"%d-%m-%Y") as jddh_createdon', 'jddh_jdomoduledtl_fk', 'jddh_status', 'DATE_FORMAT(jddh_clsdrevon,"%d-%m-%Y") as closedOn',
            'jdmd_status as card_status',
            "date(user.jdtm_createdon) as jdtm_createdon",
            'user.jdtm_invitestatus',
            'DATE_FORMAT(jddh_clsdrevon,"%d-%m-%Y") as jddh_clsdrevon',
           
           
        ])
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
        ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
        ->leftJoin('jdodiscussmember_tbl', 'jddm_jdodiscusshdr_fk=jdodiscusshdr_pk')
        ->leftJoin('jdotargetmember_tbl as user', 'user.jdotargetmember_pk=jddm_jdotargetmember_fk and user.jdtm_jdomoduledtl_fk = jddh_jdomoduledtl_fk')
        ->leftJoin('jdotargetmember_tbl as creator', 'creator.jdotargetmember_pk=jddh_creator_jdotargetmember_fk and creator.jdtm_jdomoduledtl_fk = jddh_jdomoduledtl_fk')
        ->leftJoin('usermst_tbl', 'UserMst_Pk=creator.jdtm_target_usermst_fk')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk=UM_MemberRegMst_Fk')
        ->leftJoin('basemodulemst_tbl','basemodulemst_pk=skycdtls.mcosd_basemodulemst_fk')
        ->where(['in','jddh_jdomoduledtl_fk',$modulePks])
        ->andWhere('user.jdtm_target_usermst_fk=:userpk', array(':userpk' => $rec_pk));
        // ':moduledtlpk' => $jdomodulePK, 

        if($type=='recv')
        {
            $SkycardData->andwhere([
                'mcsdm_participants'=> $rec_pk
                ])
            ->andwhere([
                'mcosc_name_usremst_fk'=> $droppedUserpk
            ]);
        }elseif($type=='drop'){
            // $SkycardData->andwhere([
            //     'mcsdm_participants'=> $droppedUserpk
            //     ])
            $SkycardData->andwhere([
                'mcosc_name_usremst_fk'=> $rec_pk
            ]);
        }
        if($sortType!='' && $sortType!=null)
        {
            if($sortType=='C')
            {
                $SkycardData->andWhere(['jddh_status'=>3]);
               
            }
        }
        if($chooseByType!='' && $chooseByType!=null && $chooseByType!='all')
        {
            if($chooseByType=='P')
            {
                $searchName='product';
            }else{
                $searchName='service';
            }
            $SkycardData->andwhere(['like','bmm_name','%'.$searchName.'%', false]);
        }
        $SkycardData->groupBy([
            'skycdtls.mcosd_shared_fk'
        ]);
        if($sortType!='' && $sortType!=null)
        {
            if($sortType=='N')
            {
                $SkycardData->orderBy([
                    
                    'mcosd_createdon'=>SORT_DESC
                ]);
            }else if($sortType=='O'){
                $SkycardData->orderBy([
                    
                    'mcosd_createdon'=>SORT_ASC
                ]);
            }
            
        }else {
           
            $SkycardData->orderBy([
                    
                'mcosd_createdon'=>SORT_DESC
            ]);
        }
        $SkycardData->asArray();

        $SkycardData=$SkycardData->createCommand()->queryAll();

        // echo"\n chooseByType $chooseByType\n\n";
        // echo"<pre>SkycardData\n\n";
        // print_r($SkycardData);
        // exit;

        $data=[];
        $archived=[];
        $topics=[];
        $prod_count=0;
        $serv_count=0;
        $finalData = [];

       


        foreach($SkycardData as $key=>$val)
        {
            $files = [];
            $userArray = [];
            if(!empty($val['skycard_filepk']))
            {
                
                $fileObj = MemcompfiledtlsTbl::findOne($val['skycard_filepk']);
                $files[] = [
                    'name' => $fileObj->mcfd_origfilename,
                    'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                    'size' => $fileObj->mcfd_actualfilesize,
                    'type' => $fileObj->mcfd_filetype
                ];
             
            }
            
            // $userArray = JdodiscussmemberTblQuery::getDiscussionUser($val['jdodiscusshdr_pk']);           
            // $userArray=JdotargetmemberTblQuery::getInvitedUserList($model['jddh_jdomoduledtl_fk']);
            $val['userList'] = $userArray['moduleData'];

            // $addedremoveduser=self::getAddedRemovedmembers($val['jddh_jdomoduledtl_fk'],$val['jdodiscusshdr_pk'],$val['jdtm_createdon']);

          
            // exit;

            
            $itemDetails='';
            // $item_type=\common\models\BasemodulemstTbl::find()->where(['basemodulemst_pk'=>$val['basemodPK']])->one()->bmm_name;

            // echo"\nbmm_name  ".$val['bmm_name'];
            
            if(strpos(strtolower($val['bmm_name']),'product')!==false)
            {
               
                $itemDetails = MemcompproddtlsTbl::find()
                        ->select([
                            'MemCompProdDtls_Pk as pdtPk',
                            'MCPrD_DisplayName as prod_name',
                            'mcprd_prodrefno as prod_ref_no',
                            'mcprd_prodcoverimgfile as imagePK',
                            'MCPrD_MemberCompMst_Fk as compk',
                            'mcprd_updatedby as img_upby'
    
                        ])
                        ->where([
                            'MemCompProdDtls_Pk'=>$val['item_pk'],
                            // 'MCPrD_SVFAdminApprovalStatus'=>'A',
                        ])
                        ->andWhere(['!=', 'mcprd_isdeleted', 1])
                        ->asArray()->one();
                        // ->createCommand()->sql;

                        $prod_count=$prod_count+MemcompproddtlsTbl::find()
                        ->where([
                            'MemCompProdDtls_Pk'=>$val['item_pk'],
                        ])
                        ->andWhere(['!=', 'mcprd_isdeleted', 1])
                        ->asArray()->count();

                        $driveImg = Drive::generateUrl($itemDetails['imagePK'],$itemDetails['compk'],$itemDetails['img_upby']);
                        $itemDetails['itemImg']=$driveImg;
                        $itemDetails['itemCategory']='P';
                        
                        
            }else if(strpos(strtolower($val['bmm_name']),'service')!==false)
            {
               
                
                $itemDetails = MemcompservicedtlsTbl::find()
                        ->select([
                            'MemCompServDtls_Pk as pdtPk',
                            'MCSvD_DisplayName as prod_name',
                            'mcsvd_servrefno as prod_ref_no',
                            'mcsvd_servcoverimgfile as imagePK',
                            'MCSvD_MemberCompMst_Fk as compk',
                            'mcsvd_updatedby as img_upby'
    
                        ])
                        ->where([
                            'MemCompServDtls_Pk'=>$val['item_pk'],
                            // 'MCPrD_SVFAdminApprovalStatus'=>'A',
                        ])
                        ->andWhere(['!=', 'mcsvd_isdeleted', 1])
                        ->asArray()->one();
                        // ->createCommand()->sql;

                        $serv_count=$serv_count+MemcompservicedtlsTbl::find()
                        ->where([
                            'MemCompServDtls_Pk'=>$val['item_pk'],
                        ])
                        ->andWhere(['!=', 'mcsvd_isdeleted', 1])
                        ->asArray()->count();

                        $driveImg = Drive::generateUrl($itemDetails['imagePK'],$itemDetails['compk'],$itemDetails['img_upby']);
                        $itemDetails['itemImg']=$driveImg;
                        $itemDetails['itemCategory']='S';
                        
                        
            }


            $itemDetails['received_on']=$val['skyc_createdon'];
            $itemDetails['updatedon_on']=$val['skyc_updatedon'];
            $itemDetails['closed_on']=$val['closedOn'];
            $itemDetails['jdodiscusshdr_pk']=$val['jdodiscusshdr_pk'];
            $itemDetails['jddh_jdomoduledtl_fk']=$val['jddh_jdomoduledtl_fk'];
            $itemDetails['jddh_status']=$val['jddh_status'];
            $itemDetails['topic']=$val['jddh_topic'];
            $itemDetails['disCreatedUserPk']=$val['mcosc_name_usremst_fk'];
            // $itemDetails['priUser_pk']=$val['priUser_pk'];
            $itemDetails['jdup_status']=$val['jdup_status'];
            $itemDetails['jdup_updatedon']=$val['jdup_updatedon'];
            $itemDetails['userInfo']=self::getUser(($type=='recv')?$val['mcosc_name_usremst_fk']:$val['target_userpk']);
            // $itemDetails['userList']=$val['userList'];
            // $itemDetails['addedremoveduser']=$addedremoveduser;
            $itemDetails['jdtm_invitestatus']=$val['jdtm_invitestatus'];
            // $itemDetails['card_status']=$val['card_status'];
            // $itemDetails['jdmd_arcrevon']=$val['jdmd_arcrevon'];
            $itemDetails['jddh_status']=$val['jddh_status'];
            $itemDetails['jddh_clsdrevon']=$val['jddh_clsdrevon'];

            $data1=[];
            
            if($itemDetails !='')
            {
               
                if($val['jddh_status']==3)
                {
                    $archived[]=$itemDetails;
                }else{
                    $topics[]=$itemDetails;
                }
                
            }
           

        }

        $skycard_discussionData['prod_count']=$prod_count;
        $skycard_discussionData['serv_count']=$serv_count;
        $skycard_discussionData['topics_list']=$topics;
        $skycard_discussionData['archived_list']=$archived;
       


        // echo"Test\n";
        // echo"<pre>\n\n Skycard data";
        // print_r($itemDetails);
        // exit;

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'skyDisscussionData' => $skycard_discussionData,
            
        );

        return $result;

    }

    public function actionSkycard_chathistory($dataPk,$modulepk)
    {


        // echo"\n modulepk $modulepk";
        // echo"\n dataPk $dataPk";
        
        $data = [];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        $targetedUser = JdotargetmemberTbl::find()->select(['jdtm_userstatus','jdtm_removedon','jdtm_rejoinedon'])->where(['jdtm_userstatus'=>3])->orWhere(['jdtm_userstatus'=>4])
        ->andwhere(['jdtm_jdomoduledtl_fk'=>$modulepk])
        ->andwhere(['jdtm_target_usermst_fk'=>$userPK])
        ->asArray()->one();

        // echo"<pre>\n\n";
        // print_r($targetedUser);
        // exit;

        $model = JdodiscussdtlTbl::find()
            ->select([
                'IF(jddd_createdby = '.$userPK.' and jddd_createdon >= DATE_SUB(NOW(), INTERVAL 1 HOUR), jdodiscussdtl_pk, null) id',
                'jddd_createdon date',
                'CONCAT_WS(" ", creator.um_firstname, creator.um_middlename, creator.um_lastname) name',
                'creator.um_userdp userImg',
                'jddd_reply_filepath files',
                'MemberCompMst_Pk',
                'creator.UserMst_Pk',
                'dsg_designationname position',
                'MCM_CompanyName company',
                'jddd_reply_message comment',   
                'creator.um_landlineno',
                'creator.UM_EmailID as emailId',
                'creator.um_primobno as mobileNo',
                'creator.um_landlineext',
                'jdtm_userstatus',
                'jdtm_removedon',
                'jdtm_rejoinedon',
                'CASE WHEN `jdtm_userstatus` =3 then "Removed" WHEN `jdtm_userstatus` =4 then "Rejoined" ELSE "Active" END as userstatus',
                

                             ])
            ->leftJoin('jdodiscusshdr_tbl','jddd_jdodiscusshdr_fk = jdodiscusshdr_pk')
            ->leftJoin('jdodiscussmember_tbl','jddd_jdodiscussmember_fk = jdodiscussmember_pk')
            ->leftJoin('jdotargetmember_tbl','jddm_jdotargetmember_fk = jdotargetmember_pk')
            ->leftJoin('usermst_tbl targator', 'jdtm_target_usermst_fk = targator.UserMst_Pk')
            ->leftJoin('usermst_tbl creator', 'jddd_createdby = creator.UserMst_Pk')
            ->leftJoin('designationmst_tbl', 'creator.UM_Designation = designationmst_pk')
            ->leftJoin('membercompanymst_tbl', 'jdtm_target_membercompmst_fk = MemberCompMst_Pk')
            ->Where(['jddd_jdodiscusshdr_fk' => $dataPk, 'jddd_isdeleted' => 2])
            ->andwhere(['jddd_messagetype'=>1]);
            if(!empty($targetedUser) && $targetedUser['jdtm_userstatus']==4)
            {
                // echo"asdasd";

                // echo"\nn rejoined on ".$targetedUser['jdtm_rejoinedon'];
                // echo"\nn jdtm_removedon on ".$targetedUser['jdtm_removedon'];
                $model->andWhere(['<=', 'jddd_createdon', $targetedUser['jdtm_removedon']]);
                $model->orwhere(['>=', 'jddd_createdon', $targetedUser['jdtm_rejoinedon']]);
              
            }elseif(!empty($targetedUser) && $targetedUser['jdtm_userstatus']==3){
                $model->andwhere(['<=', 'jddd_createdon', $targetedUser['jdtm_removedon']]);
            }
        $model->orderBy('jdodiscussdtl_pk ASC');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);

        // echo"<pre>\n\n";
        // print_r($provider->getModels());
        // exit;
        $isFirst = true;
        foreach($provider->getModels() as $proVal) {
            if($isFirst) {
                $isFirst = false;
            } else {
                $proVal['id'] = null;
            }
            if ($proVal['userImg']) {
                $proVal['userImg'] = Drive::generateUrl($proVal['userImg'], $proVal['MemberCompMst_Pk'], $val['UserMst_Pk']);
            } else {
                $proVal['userImg'] = 'assets/images/avatar.jpg';
            }
            $files = [];
            if($proVal['files']) {
                foreach(explode(',', $proVal['files']) as $filePk) {
                    $fileObj = MemcompfiledtlsTbl::findOne($filePk);
                    $files[] = [
                        'name' => $fileObj->mcfd_origfilename,
                        'url' => Drive::generateUrl($fileObj->memcompfiledtls_pk, $fileObj->mcfd_memcompmst_fk, $fileObj->mcfd_uploadedby),
                        'size' => $fileObj->mcfd_actualfilesize,
                        'type' => $fileObj->mcfd_filetype
                    ];
                }
            }
            $proVal['files'] = $files;
            $data[] = $proVal;
        }

        $addedremoveduser=self::getAddedRemovedmembers($modulepk,$dataPk,null);
        $userArray = JdodiscussmemberTblQuery::getDiscussionUser($dataPk);

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'Comments'=>$data,
            'addedremoveduser'=>$addedremoveduser,
            'userList'=>$userArray['moduleData']
        );

        return $result;
        
    }

    public function actionDiscuss_statuschange()
    {
       
        $disStatusData = file_get_contents('php://input');
        $disc_data = json_decode($disStatusData, true);
       
       $moduletbl_pk=$disc_data['selected_data']['jddh_jdomoduledtl_fk'];

        // echo"\n moduletbl_pk $moduletbl_pk \n";
      
       
        if (!empty($disc_data)) {
           
            
                $formData=$disc_data['selected_data'];

                // echo"\n\n<pre>";
                // print_r($formData);

                $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                $ip_address = Common::getIpAddress();
                $date = date('Y-m-d H:i:s');
                
                if ($formData!='') {
                    //count($formData) > 0
                //     if($disc_data['dataType'] == 2){
                        
                //         $jdomoduledtl = JdomoduledtlTbl::find()
                //         ->where("jdomoduledtl_pk=:pk and jdmd_shared_type = :sharedType", [':pk' => $moduletbl_pk, ':sharedType' => 3])
                //         ->one();

                //         if(!empty($jdomoduledtl)){
                //             $jdomoduledtl->jdmd_status = $jdomoduledtl->jdmd_status == 3 ? 4 : 3;
                //             $jdomoduledtl->jdmd_arcrevon=$date;
                //         }if (!$jdomoduledtl->save()) {
                //             $result = array(
                //                 'status' => 200,
                //                 'msg' => 'error',
                //                 'flag' => 'E',
                //                 'comments' => 'Something went wrong!',
                //                 'returndata' => $jdomoduledtl->getErrors()
                //             );
                //             return $result;
                //         }

                //         // echo"<pre>";
                //         // print_r($jdomoduledtl);
                //         // exit;
                       
                //             // foreach ($formData as $key => $value) {
                //                 $moduledtl = JdouserpreferenceTbl::find()
                //                         ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk and jdup_category = :category", [':pk' => $formData['jdodiscusshdr_pk'], ':sharedType' => 2, ':userpk' => $userPK, ':category' => 2])
                //                         ->one();
                //                 if (empty($moduledtl)) {
                //                     $moduledtl = new JdouserpreferenceTbl;
                //                     $moduledtl->jdup_usermst_fk = $userPK;
                //                     $moduledtl->jdup_shared_type = 2;
                //                     $moduledtl->jdup_shared_fk = $formData['jdodiscusshdr_pk'];//$value['jdodiscusshdr_pk'];
                //                     $moduledtl->jdup_category = 2;
                //                     $moduledtl->jdup_status = 1;
                //                     $moduledtl->jdup_createdon = $date;
                //                     $moduledtl->jdup_createdby = $userPK;
                //                     $moduledtl->jdup_createdbyipaddr = $ip_address;
                //                 } else {
                //                     $moduledtl->jdup_status = $moduledtl->jdup_status == 1 ? 2 : 1;
                //                     $moduledtl->jdup_updatedon = $date;
                //                     $moduledtl->jdup_updatedby = $userPK;
                //                     $moduledtl->jdup_updatedbyipaddr = $ip_address;
                //                 }
                //                 if (!$moduledtl->save()) {
                //                     $result = array(
                //                         'status' => 200,
                //                         'msg' => 'error',
                //                         'flag' => 'E',
                //                         'comments' => 'Something went wrong!',
                //                         'returndata' => $moduledtl->getErrors()
                //                     );
                //                     return $result;
                //                 }
                //                 $result = array(
                //                     'status' => 200,
                //                     'msg' => 'success',
                //                     'flag' => 'S',
                //                     'comments' => 'Discussion status changed successfully',
                //                 );
                //             //}
                        

                // }else{
                    // close discussion
                  
                        // foreach ($formData as $key => $value) {

                         
                            $moduledtl = JdodiscusshdrTbl::find()
                                    ->where("jdodiscusshdr_pk=:pk", [':pk' => $formData['jdodiscusshdr_pk']])
                                    ->one();

                        
                            if (!empty($moduledtl)) {
                                $moduledtl->jddh_status = $moduledtl->jddh_status == 3 ? 4 : 3;
                                $moduledtl->jddh_clsdrevon = $date;
                                $moduledtl->jddh_clsdrevby = $userPK;
                                $moduledtl->jddh_clsdrevbyipaddr = $ip_address;
                                $moduledtl->jddh_updatedon=$date;
                                $moduledtl->jddh_updatedby=$userPK;
                                $moduledtl->jddh_updatedbyipaddr=$ip_address;
                            }
                            if (!$moduledtl->save()) {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'error',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong!',
                                    'returndata' => $moduledtl->getErrors()
                                );
                                return $result;
                            }
                            $result = array(
                                'status' => 200,
                                'msg' => 'success',
                                'flag' => 'S',
                                'comments' => $disc_data['dataType'] == 2?'Discussion Revoked':'Discussion Closed',
                            );
                        //}
                    
                 //}
                }
        
                return $result;                  
            
        }
    }

    public function sendMail($userPKs)
    {
        $flag=0;
        if(!empty($userPKs))
        {
            foreach($userPKs as $userid)
            {
                $get_user_email=\common\models\UsermstTbl::find()->select(['UM_EmailID'])->where($userid)->asArray()->one();
                if(!empty($get_user_email))
                {
                
                    $send_email=\Yii::$app->mailer->compose()
                    ->setFrom('noreply@businessgateways.com')
                    ->setTo('priyanka@businessgateways.com')
                    ->setSubject('Shared Skycard Notification')
                    ->setHTMLBody("Testing purpose please ignore")
                    ->send();
                    if($send_email)
                    {
                        $flag=1;
                    }
                }
            }
            // return $flag;
        }
        
        return $flag;
    }


    /*Function to get Add members */

    public function actionMember_list($prodPK,$skyc_type,$itemType,$priUserPk,$discreatedUser,$module_Pk)
    {
        
        $userPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        
        // echo"\nskyc_type $skyc_type\n";
        if($skyc_type=='drop')
        {
            $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);

        
        }else if($skyc_type=='recv')
        {
            $regPK=MembercompanymstTbl::find()
            ->leftJoin('usermst_tbl', 'UM_MemberRegMst_Fk=MCM_MemberRegMst_Fk')
            ->where(['UserMst_Pk'=>$discreatedUser])
            ->one()->MCM_MemberRegMst_Fk;

        }

        // echo"\npriUserPk $priUserPk";
        // echo"\ndiscreatedUser $discreatedUser";
        // exit;


        $comp_info1=MembercompanymstTbl::find()->select(['UserMst_Pk','CountryMst_Pk as country_code','CyM_CountryName_en as country_name',
            'MCM_MemberRegMst_Fk as reg_fk','MemberCompMst_Pk as comp_pk','MCM_SupplierCode','MCM_CompanyName as comp_name','mcm_complogo_memcompfiledtlsfk as complogopk',
        ])
        ->leftJoin('usermst_tbl', 'UM_MemberRegMst_Fk=MCM_MemberRegMst_Fk')
        ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
        ->where(['UserMst_Pk'=>$discreatedUser])
        // ->where(['MCM_MemberRegMst_Fk'=>$regPK])
        ->asArray()->one();

        if(!empty($comp_info1))
        {
            $comp_info1['comp_logo']=Drive::generateUrl($comp_info1['complogopk'],$comp_info1['comp_pk'], $comp_info1['UserMst_Pk']).'&noimg=1';
        }

        if($skyc_type=='recv'){
            $priUserPk=$userPk;
        }
        $comp_info2=MembercompanymstTbl::find()->select(['UserMst_Pk','CountryMst_Pk as country_code','CyM_CountryName_en as country_name',
            'MCM_MemberRegMst_Fk as reg_fk','MemberCompMst_Pk as comp_pk','MCM_SupplierCode','MCM_CompanyName as comp_name','mcm_complogo_memcompfiledtlsfk as complogopk',
        ])
        ->leftJoin('usermst_tbl', 'UM_MemberRegMst_Fk=MCM_MemberRegMst_Fk')
        ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
        ->where(['UserMst_Pk'=>$priUserPk])
        // ->where(['MCM_MemberRegMst_Fk'=>$regPK])
        ->asArray()->one();
        if(!empty($comp_info2))
        {
            $comp_info2['comp_logo']=Drive::generateUrl($comp_info2['complogopk'],$comp_info2['comp_pk'], $comp_info2['UserMst_Pk']).'&noimg=1';
        }
        

    
        $internal_user=[];
        $external_user=[];


        // echo"\nmodule_Pk $module_Pk\n";

        /* External user list who mapped to the product start*/
        if($itemType=='P')
        {
            $mappeduser_idss = MemcompproddtlsTbl::find()->select(['mcprd_contactinfo as prodContInfo'])->where(['MemCompProdDtls_Pk' => $prodPK])->asArray()->one(); 
        }else if($itemType=='S'){
            $mappeduser_idss = MemcompservicedtlsTbl::find()->select(['mcsvd_contactinfo as prodContInfo'])->where(['MemCompServDtls_Pk'=>$prodPK])->asArray()->one();
        }

    //     echo"\n<pre>mappeduser_idss\n";
    //     print_r($mappeduser_idss);
    //    exit;


        if(!empty($mappeduser_idss) && $mappeduser_idss['prodContInfo']!='')
        {

            $user_pks=$mappeduser_idss['prodContInfo'];

            $user_pks_exp=explode(',',$user_pks);

            $added_user=[];
            $nonadded_user=[];

            foreach($user_pks_exp as $upk)
            {
                $targetedUser = JdotargetmemberTbl::find()
                ->select(['jdtm_createdon','jdtm_jdomoduledtl_fk','jdtm_target_usermst_fk'])
                // ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_userstatus != 3", [':pk' =>$module_Pk])
                ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_target_usermst_fk =:userpk and jdtm_userstatus != 3", [':pk' =>$module_Pk,':userpk'=>$upk])
                ->asArray()
                ->one();

                if(!empty($targetedUser))
                {
                    $added_user[]=$upk;
                }else{
                    $nonadded_user[]=$upk;
                }
            }
            $added_user=implode(',',$added_user);
            $nonadded_user=implode(',',$nonadded_user);

            // echo"\n<pre>";
            // print_r($added_user);
            // echo"\n\n<pre>";
            // print_r($nonadded_user);
            // exit;
        if(!empty($added_user))
        {
            $AddedmappedUserList=UsermstTbl::find()
            ->select(['um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'])
            ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
            ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
            ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
            ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
            ->where("UserMst_Pk in ($added_user)")
            ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
            ->orderBy('DM_Name asc')
            ->asArray()
            ->all();

            
                if (!empty($AddedmappedUserList)) {
                    $depPK = [];
                    foreach ($AddedmappedUserList as $key => $value) {
                        $userArray = [];
                        foreach ($AddedmappedUserList as $key => $userVal) {

                            $userVal['userImg'] = Drive::generateUrl($userVal['userImg'], $userVal['compPk'], $userVal['userPk']);
                            
                                $userVal['targetUser_createdon']=$targetedUser['jdtm_createdon'];
                                $userVal['isadded']=1;
                           
                            if ($value['departmentId'] == $userVal['departmentId']) {
                                $userArray[] = $userVal;
                            }
                        }
                        if (!in_array($value['departmentId'], $depPK)) {
                            $user_dept1['addedUser'][] = ['departName' => $value['departmentName'],'depID'=>$value['departmentId'], 'userArray' => $userArray];
                            $depPK[] = $value['departmentId'];
                        }
                    }
                }
            }
            if(!empty($nonadded_user))
            {
                $NonAddedmappedUserList=UsermstTbl::find()
                ->select(['um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'])
                ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
                ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
                ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
                ->where("UserMst_Pk in ($nonadded_user)")
                ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
                ->orderBy('DM_Name asc')
                ->asArray()
                ->all();
            }
            

            
                if (!empty($NonAddedmappedUserList)) {
                    $depPK = [];
                    foreach ($NonAddedmappedUserList as $key => $value) {
                        $userArray = [];
                        foreach ($NonAddedmappedUserList as $key => $userVal) {

                            $userVal['userImg'] = Drive::generateUrl($userVal['userImg'], $userVal['compPk'], $userVal['userPk']);
                            
                                $userVal['targetUser_createdon']='';
                                $userVal['isadded']=0;
                           
                            if ($value['departmentId'] == $userVal['departmentId']) {
                                $userArray[] = $userVal;
                            }
                        }
                        if (!in_array($value['departmentId'], $depPK)) {
                            $user_dept1['nonaddedUser'][] = ['departName' => $value['departmentName'],'depID'=>$value['departmentId'], 'userArray' => $userArray];
                            $depPK[] = $value['departmentId'];
                        }
                    }
                }


        }
        // echo"<pre>\n\n user_dept1\n\n";
        // print_r($user_dept1);
        // exit;
     
      
        /* External user list who mapped to the product end*/
        // echo"\nregPK $regPK";

        /* Internal user list who having the skycard access start */

            $internalUserList = UsermstTbl::find()
                            ->select([
                                'um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'
                                
                            ])
                            ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
                            ->leftJoin('memcompsectordtls_tbl','find_in_set(MemCompSecDtls_Pk, um_busunit)')
                            //->leftJoin('sectormst_tbl','find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)')
                            ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
                            ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
                            ->leftJoin('userpermtrn_tbl','UPT_UserMst_Fk = UserMst_Pk')
                            ->leftJoin('basemodulemst_tbl','basemodulemst_pk=upt_basemodulemst_fk')
                            ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                            //->where(['UM_MemberRegMst_Fk'=>$stkRegPk,'UM_Type'=>'U'])
                            ->where(['UM_MemberRegMst_Fk'=>$regPK])
                            ->andWhere(['UM_Status'=>'A'])
                            // ->andWhere(['<>','UM_Status','D'])
                            ->andWhere("UM_Type != 'MA' ")
                            ->andwhere(['um_emailconfirmstatus'=>1])
                            ->andwhere(['like','bmm_name','%SkyCard Management%', false])
                            ->orderBy(['COALESCE(UM_UpdatedOn, UM_CreatedOn)' => SORT_DESC])
                                        ->groupBy('UserMst_Pk')
                                        ->asArray();

        $internalUserListProvider = new ActiveDataProvider([ 'query' => $internalUserList]);

        // echo"->getModels()\n<pre>\n";
        // print_r($internalUserListProvider->getModels());
        
        $added_user1=[];
        $nonadded_user1=[];
        if(!empty($internalUserListProvider->getModels()))
        {
            foreach($internalUserListProvider->getModels() as $key => $value)
            {
                // echo"\n\nuserpk ".$value['userPk'];

                $targetedUser = JdotargetmemberTbl::find()
                ->select(['jdtm_createdon','jdtm_jdomoduledtl_fk','jdtm_target_usermst_fk'])
                // ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_userstatus != 3", [':pk' =>$module_Pk])
                ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_target_usermst_fk =:userpk and jdtm_userstatus != 3", [':pk' =>$module_Pk,':userpk'=>$value['userPk']])
                ->asArray()
                ->one();

                if(!empty($targetedUser))
                {
                    $added_user1[]=$value['userPk'];
                }else{
                    $nonadded_user1[]=$value['userPk'];
                }
            }
            $added_user1=implode(',',$added_user1);
            $nonadded_user1=implode(',',$nonadded_user1);
        }

        // echo"asdsdsdas";
        // print_r($nonadded_user1);
        // exit;
    if(!empty($added_user1))
    {
        $AddedmappedUserList=UsermstTbl::find()
        ->select(['um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'])
        ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
        ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
        ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
        ->where("UserMst_Pk in ($added_user1)")
        ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
        ->orderBy('DM_Name asc')
        ->asArray()
        ->all();

        
            if (!empty($AddedmappedUserList)) {
                $depPK = [];
                foreach ($AddedmappedUserList as $key => $value) {
                    $userArray = [];
                    foreach ($AddedmappedUserList as $key => $userVal) {

                        $userVal['userImg'] = Drive::generateUrl($userVal['userImg'], $userVal['compPk'], $userVal['userPk']);
                        
                            $userVal['targetUser_createdon']=$targetedUser['jdtm_createdon'];
                            $userVal['isadded']=1;
                       
                        if ($value['departmentId'] == $userVal['departmentId']) {
                            $userArray[] = $userVal;
                        }
                    }
                    if (!in_array($value['departmentId'], $depPK)) {
                        $user_dept2['addedUser'][] = ['departName' => $value['departmentName'],'depID'=>$value['departmentId'], 'userArray' => $userArray];
                        $depPK[] = $value['departmentId'];
                    }
                }
            }
        }

        //     echo"<pre>";
        // print_r($user_dept2);
        // exit;
    if(!empty($nonadded_user1))
    {
        $NonAddedmappedUserList=UsermstTbl::find()
        ->select(['um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'um_userdp userImg', 'UM_EmailID as emailId', 'trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc', 'dsg_designationname as designation', 'DM_Name as departmentName', 'UserMst_Pk as userPk','DepartmentMst_Pk','MemberCompMst_Pk as compPk','um_userdp','DepartmentMst_Pk as departmentId'])
        ->leftJoin('departmentmst_tbl', 'DepartmentMst_Pk = um_departmentmst_fk')
        ->leftJoin('designationmst_tbl', 'designationmst_pk = UM_Designation')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
        ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
        ->where("UserMst_Pk in ($nonadded_user1)")
        ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
        ->orderBy('DM_Name asc')
        ->asArray()
        ->all();

        
            if (!empty($NonAddedmappedUserList)) {
                $depPK = [];
                foreach ($NonAddedmappedUserList as $key => $value) {
                    $userArray = [];
                    foreach ($NonAddedmappedUserList as $key => $userVal) {

                        $userVal['userImg'] = Drive::generateUrl($userVal['userImg'], $userVal['compPk'], $userVal['userPk']);
                        
                            $userVal['targetUser_createdon']='';
                            $userVal['isadded']=0;
                       
                        if ($value['departmentId'] == $userVal['departmentId']) {
                            $userArray[] = $userVal;
                        }
                    }
                    if (!in_array($value['departmentId'], $depPK)) {
                        $user_dept2['nonaddedUser'][] = ['departName' => $value['departmentName'],'depID'=>$value['departmentId'], 'userArray' => $userArray];
                        $depPK[] = $value['departmentId'];
                    }
                }
            }
        }

        

       
        /* Internal user list who having the skycard access end */

        // echo"\n\nskyc_type $skyc_type\n";
        // echo"<pre>\nuser_dept2\n";
        // print_r($user_dept2);
        if($skyc_type=='drop')
        {
            $internal_user=$user_dept2;
            $external_user=$user_dept1;
            $internal_compInfo=$comp_info1;
            $external_compInfo=$comp_info2;
        
        }else if($skyc_type=='recv')
        {
            $internal_user=$user_dept1;
            $external_user=$user_dept2;
            $internal_compInfo=$comp_info2;
            $external_compInfo=$comp_info1;
            
        }

        
        // exit;

        return $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'internalUsers' => $internal_user,
            'externalUsers'=>$external_user,
            'internal_compInfo'=>$internal_compInfo,
            'external_compInfo'=>$external_compInfo,
            'skycardType'=>$skyc_type,
        );


    }

    public function actionAddremoveuser()
    {

       
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date("Y-m-d H:i:s");

       
        // echo"\nskycardPK $skycardPK";
        // exit;

        $userData = file_get_contents('php://input');
        $selectedUserData = json_decode($userData, true);
        $addremoveUserData=$selectedUserData['selected_data'];

        if(!empty($addremoveUserData))
        {
           
            
            $modulePK=$addremoveUserData['selectItemData']['jddh_jdomoduledtl_fk'];
            $discussionhdrPk=$addremoveUserData['selectItemData']['jdodiscusshdr_pk'];

            // echo"\nprodpk ".$addremoveUserData['selectItemData']['pdtPk'];

            // echo"\n modulePK $modulePK";

            $skycardPK=JdomoduledtlTbl::find()
            ->leftJoin('memcompskycarddtls_tbl', 'memcompskycarddtls_pk = jdmd_shared_fk')
            ->leftJoin('memcompskycardhdr_tbl', 'memcompskycardhdr_pk = mcosd_memcompskycardhdr_fk')
            ->where(['mcosd_shared_fk'=>$addremoveUserData['selectItemData']['pdtPk']])
            ->andwhere(['jdomoduledtl_pk'=>$modulePK])->one()->jdmd_shared_fk;

            // echo"\n\n<pre>skycardPK \n";
            // print_r($skycardPK);
            // exit;

            // if($skycardPK!='' && $skycardPK!=null)
            // {

                if (count($addremoveUserData['internalUser']) > 0) {
                    foreach ($addremoveUserData['internalUser'] as $key => $value) {

                        $exitingUser=0;
                        $isnewUser=0;


                        // echo"\nskycardPK $skycardPK";
                        // echo"\userPk ".$value['userPk'];
                        // echo"\pdtPk ".$addremoveUserData['selectItemData']['pdtPk'];

                        $check_secondayUser=MemcompskycarddtlsTbl::find()
                        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = memcompskycarddtls_pk ')     
                        // ->where(['mcosd_participants'=>$value['userPk']])
                        ->where(['mcosd_memcompskycardhdr_fk'=>$skycardPK])
                        ->andwhere(['mcsdm_participants'=>$value['userPk']])
                        ->andwhere(['mcosd_shared_fk'=>$addremoveUserData['selectItemData']['pdtPk']])
                        ->asArray()->one();

                        // echo"<pre>skycardPK \n";
                        // print_r($check_secondayUser);
                        // exit;
                            // if(empty($check_secondayUser))
                            // {
                            //     $skycard_dtlsModel=new MemcompskycarddtlsTbl();
                            //     $skycard_dtlsModel->mcosd_memcompskycardhdr_fk=$skycardPK;
                            //     $skycard_dtlsModel->mcosd_isnewtag = 2;
                            //     $skycard_dtlsModel->mcosd_participants=$value['userPk'];
                            //     $skycard_dtlsModel->mcosd_participantstype=2;
                            //     $skycard_dtlsModel->mcosd_createdon = $date;
                            //     $skycard_dtlsModel->mcosd_createdby = $userPK;
                            //     $skycard_dtlsModel->mcosd_createdbyipaddr = $ip_address;

                            //     if (!$skycard_dtlsModel->save()) {
                            //         return array(
                            //             'status' => 200,
                            //             'msg' => 'error',
                            //             'flag' => 'E',
                            //             'comments' => 'Something went wrong!',
                            //             'returndata' => $skycard_dtlsModel->getErrors()
                            //         );
                            //     }else{
                            //         $isnewUser=1;
                            //     }
                            // }else{
                            //     $exitingUser=1;
                            // }

                            $skycarddtlsPK=MemcompskycarddtlsTbl::find()   
                            ->where(['memcompskycarddtls_pk'=>$skycardPK])
                            ->andwhere(['mcosd_shared_fk'=>$addremoveUserData['selectItemData']['pdtPk']])
                            ->one()->memcompskycarddtls_pk;

                            // echo"<pre>skycarddtlsPK \n";
                            // print_r($skycarddtlsPK);
                            // exit;
                            if(empty($check_secondayUser))
                            {
                                $skycard_mapModel=new MemcompskycardmapTbl();
                                $skycard_mapModel->mcsdm_memcompskycarddtls_fk=$skycarddtlsPK;
                                $skycard_mapModel->mcsdm_participants=$value['userPk'];
                                $skycard_mapModel->mcsdm_participantstype=2;
                                $skycard_mapModel->mcsdm_isnewtag = 2;
                                $skycard_mapModel->mcsdm_createdon = $date;
                                $skycard_mapModel->mcsdm_createdby = $userPK;
                                $skycard_mapModel->mcsdm_createdbyipaddr = $ip_address;

                                //temp

                                $skycard_mapModel->mcsdm_updatedon = $date;
                                $skycard_mapModel->mcsdm_updatedby = $userPK;

                                if (!$skycard_mapModel->save()) {
                                    return array(
                                        'status' => 200,
                                        'msg' => 'error',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong!',
                                        'returndata' => $skycard_mapModel->getErrors()
                                    );
                                }else{
                                    $isnewUser=1;
                                }
                            }else{
                                $exitingUser=1;
                            }

                            if($isnewUser==1 || $exitingUser==1)
                            { 
                                $memberTbl = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $modulePK, 'jdtm_target_membercompmst_fk' => $value['compPk'], 'jdtm_target_usermst_fk' => $value['userPk']])->one();
                                
                                $username=UsermstTbl::find()->select(["concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName"])->where(['UserMst_Pk'=>$value['userPk']])->asArray()->one();

                                // echo"\n\n<pre>internal\n";
                                // print_r($memberTbl);

                                if (empty($memberTbl)) {
                                    $memberTbl = new JdotargetmemberTbl();
                                    $memberTbl->jdtm_jdomoduledtl_fk = $modulePK;
                                    $memberTbl->jdtm_usertype = 1;
                                    $memberTbl->jdtm_target_membercompmst_fk = $value['compPk'];
                                    $memberTbl->jdtm_target_usermst_fk = $value['userPk'];
                                    $memberTbl->jdtm_invitestatus = 3;
                                    $memberTbl->jdtm_userstatus = 1;
                                    $memberTbl->jdtm_createdon = $date;
                                    $memberTbl->jdtm_createdby = $userPK;
                                    $memberTbl->jdtm_createdbyipaddr = $ip_address;
                                    $memberTbl->jdtm_invitedon = $date;
                                    if (!$memberTbl->save()) {
                                        return array(
                                            'status' => 200,
                                            'msg' => 'error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'returndata' => $memberTbl->getErrors()
                                        );
                                    }else{
                                        $jdoTargetTbl = JdodiscussmemberTbl::find()
                                        ->where("jddm_jdodiscusshdr_fk=:pk and jddm_jdotargetmember_fk = :userPk", [':pk' => $discussionhdrPk, ':userPk' => $memberTbl->jdotargetmember_pk])
                                        ->one();
                                        if (empty($jdoTargetTbl)) {
                                            $model = new JdodiscussmemberTbl();
                                            $model->jddm_jdodiscusshdr_fk = $discussionhdrPk;
                                            $model->jddm_jdotargetmember_fk = $memberTbl->jdotargetmember_pk;
                                            $model->jddm_status = 1;
                                            $model->jddm_createdon = $date;
                                            $model->jddm_createdby = $userPK;
                                            $model->jddm_createdbyipaddr = $ip_address;
                                            if (!$model->save()) {
                                                return array(
                                                    'status' => 200,
                                                    'msg' => 'error',
                                                    'flag' => 'E',
                                                    'comments' => 'Something went wrong!',
                                                    'returndata' => $model->getErrors()
                                                );
                                            }else{
                                                $discussdtlTblmodel = new JdodiscussdtlTbl();
                                                $discussdtlTblmodel->jddd_jdodiscusshdr_fk = $discussionhdrPk;
                                                $discussdtlTblmodel->jddd_jdodiscussmember_fk = $model->jdodiscussmember_pk;
                                                $discussdtlTblmodel->jddd_messagetype=2;
                                                $discussdtlTblmodel->jddd_reply_message = $username['userFullName'].' '.'joined';
                                                $discussdtlTblmodel->jddd_reply_filepath = '';          
                                                $discussdtlTblmodel->jddd_createdbyipaddr = $ip_address;
                                                $discussdtlTblmodel->jddd_createdby = $userPK;
                                                $discussdtlTblmodel->jddd_createdon = $date;
                                                $discussdtlTblmodel->jddd_isdeleted = 2;
                                
                                                if(!$discussdtlTblmodel->save())
                                                {
                                                    return array(
                                                        'status' => 200,
                                                        'msg' => 'error',
                                                        'flag' => 'E',
                                                        'comments' => 'Something went wrong!',
                                                        'returndata' => $discussdtlTblmodel->getErrors()
                                                    );
                                                }
                                            }
                                        }elseif (!empty($jdoTargetTbl)) {
                                            $jdoTargetTbl->jddm_status = 2;
                                            
                                            if (!$jdoTargetTbl->save()) {
                                                return array(
                                                    'status' => 200,
                                                    'msg' => 'error',
                                                    'flag' => 'E',
                                                    'comments' => 'Something went wrong!',
                                                    'returndata' => $jdoTargetTbl->getErrors()
                                                );
                                            }
                                        }
                                    }
                                } else {
                                    // $memberTbl->jdtm_userstatus = ($memberTbl->jdtm_userstatus==3)?1:3;
                                    // echo"\nuserstatus ".$memberTbl->jdtm_userstatus;
                                    $memberTbl->jdtm_userstatus = ($memberTbl->jdtm_userstatus==3)?4:3;
                                    if($memberTbl->jdtm_userstatus==3){
                                        $memberTbl->jdtm_removedon=$date;
                                        
                                        
                                    }elseif($memberTbl->jdtm_userstatus==4){
                                        $memberTbl->jdtm_rejoinedon=$date;
                                    }
                                    
                                    if (!$memberTbl->save()) {
                                        return array(
                                            'status' => 200,
                                            'msg' => 'error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'returndata' => $memberTbl->getErrors()
                                        );
                                    }
                                    
                                    $jdoTargetTbl = JdodiscussmemberTbl::find()
                                        ->where("jddm_jdodiscusshdr_fk=:pk and jddm_jdotargetmember_fk = :userPk", [':pk' => $discussionhdrPk, ':userPk' => $memberTbl->jdotargetmember_pk])
                                        ->one();
                                    if (!empty($jdoTargetTbl)) {

                                        // echo"\n disstatus ".$jdoTargetTbl->jddm_status;
                                        $jdoTargetTbl->jddm_status = ($jdoTargetTbl->jddm_status==1)?2:1;
                                        if (!$jdoTargetTbl->save()) {
                                            return array(
                                                'status' => 200,
                                                'msg' => 'error',
                                                'flag' => 'E',
                                                'comments' => 'Something went wrong!',
                                                'returndata' => $jdoTargetTbl->getErrors()
                                            );
                                        }
                                    }

                                    $discussdtlTblmodel = new JdodiscussdtlTbl();
                                    $discussdtlTblmodel->jddd_jdodiscusshdr_fk = $discussionhdrPk;
                                    $discussdtlTblmodel->jddd_jdodiscussmember_fk = $jdoTargetTbl->jdodiscussmember_pk;
                                    $discussdtlTblmodel->jddd_messagetype=($memberTbl->jdtm_userstatus==3)?3:2;
                                    $discussdtlTblmodel->jddd_reply_message =($memberTbl->jdtm_userstatus==3)? $username['userFullName'].' '.'removed':$username['userFullName'].' '.'joined';
                                    $discussdtlTblmodel->jddd_reply_filepath = '';          
                                    $discussdtlTblmodel->jddd_createdbyipaddr = $ip_address;
                                    $discussdtlTblmodel->jddd_createdby = $userPK;
                                    $discussdtlTblmodel->jddd_createdon = $date;
                                    $discussdtlTblmodel->jddd_isdeleted = 2;
                    
                                    if(!$discussdtlTblmodel->save())
                                    {
                                        return array(
                                            'status' => 200,
                                            'msg' => 'error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'returndata' => $discussdtlTblmodel->getErrors()
                                        );
                                    }
                                
                                    
                                }
                        //}

                        }

                    }
                }

                // echo"\ncount externalUser\n";
                // print_r(count($addremoveUserData['externalUser']));

                if (count($addremoveUserData['externalUser']) > 0) {
                    foreach ($addremoveUserData['externalUser'] as $key => $value) {

                        $exitingUser=0;
                        $isnewUser=0;

                        // $check_secondayUser=MemcompskycarddtlsTbl::find()
                        // ->where(['mcosd_participants'=>$value['userPk']])
                        // ->andwhere(['mcosd_memcompskycardhdr_fk'=>$skycardPK])->asArray()->one();

                        $check_secondayUser=MemcompskycarddtlsTbl::find()
                        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = memcompskycarddtls_pk ')     
                        // ->where(['mcosd_participants'=>$value['userPk']])
                        ->where(['mcosd_memcompskycardhdr_fk'=>$skycardPK])
                        ->andwhere(['mcsdm_participants'=>$value['userPk']])
                        ->andwhere(['mcosd_shared_fk'=>$addremoveUserData['selectItemData']['pdtPk']])
                        ->asArray()->one();

                            // if(empty($check_secondayUser))
                            // {

                                
                            //     $skycard_dtlsModel=new MemcompskycarddtlsTbl();
                            //     $skycard_dtlsModel->mcosd_memcompskycardhdr_fk=$skycardPK;
                            //     $skycard_dtlsModel->mcosd_isnewtag = 2;
                            //     $skycard_dtlsModel->mcosd_participants=$value['userPk'];
                            //     $skycard_dtlsModel->mcosd_participantstype=2;
                            //     $skycard_dtlsModel->mcosd_createdon = $date;
                            //     $skycard_dtlsModel->mcosd_createdby = $userPK;
                            //     $skycard_dtlsModel->mcosd_createdbyipaddr = $ip_address;

                            //     if (!$skycard_dtlsModel->save()) {
                            //         return array(
                            //             'status' => 200,
                            //             'msg' => 'error',
                            //             'flag' => 'E',
                            //             'comments' => 'Something went wrong!',
                            //             'returndata' => $skycard_dtlsModel->getErrors()
                            //         );
                            //     }else{
                            //         $isnewUser=1;
                            //     }
                            // }else{
                            //     $exitingUser=1;
                            // }

                            $skycarddtlsPK=MemcompskycarddtlsTbl::find()   
                            ->where(['mcosd_memcompskycardhdr_fk'=>$skycardPK])
                            ->andwhere(['mcosd_shared_fk'=>$addremoveUserData['selectItemData']['pdtPk']])
                            ->one()->memcompskycarddtls_pk;

                            // echo"<pre>skycarddtlsPK \n";
                            // print_r($skycarddtlsPK);
                            // exit;
                            if(empty($check_secondayUser))
                            {
                                $skycard_mapModel=new MemcompskycardmapTbl();
                                $skycard_mapModel->mcsdm_memcompskycarddtls_fk=$skycarddtlsPK;
                                $skycard_mapModel->mcsdm_participants=$value['userPk'];
                                $skycard_mapModel->mcsdm_participantstype=2;
                                $skycard_mapModel->mcsdm_isnewtag = 2;
                                $skycard_mapModel->mcsdm_createdon = $date;
                                $skycard_mapModel->mcsdm_createdby = $userPK;
                                $skycard_mapModel->mcsdm_createdbyipaddr = $ip_address;

                                //temp

                                $skycard_mapModel->mcsdm_updatedon = $date;
                                $skycard_mapModel->mcsdm_updatedby = $userPK;

                                if (!$skycard_mapModel->save()) {
                                    return array(
                                        'status' => 200,
                                        'msg' => 'error',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong!',
                                        'returndata' => $skycard_mapModel->getErrors()
                                    );
                                }else{
                                    $isnewUser=1;
                                }
                            }else{
                                $exitingUser=1;
                            }

                        if($isnewUser==1 || $exitingUser==1)
                        {
                                
                            $memberTbl = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $modulePK, 'jdtm_target_membercompmst_fk' => $value['compPk'], 'jdtm_target_usermst_fk' => $value['userPk']])->one();
                            
                            $username=UsermstTbl::find()->select(["concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName"])->where(['UserMst_Pk'=>$value['userPk']])->asArray()->one();

                            // echo"\n\n<pre>";
                            // print_r($memberTbl);

                            if (empty($memberTbl)) {
                                $memberTbl = new JdotargetmemberTbl();
                                $memberTbl->jdtm_jdomoduledtl_fk = $modulePK;
                                $memberTbl->jdtm_usertype = 2;
                                $memberTbl->jdtm_target_membercompmst_fk = $value['compPk'];
                                $memberTbl->jdtm_target_usermst_fk = $value['userPk'];
                                $memberTbl->jdtm_invitestatus = 3;
                                $memberTbl->jdtm_userstatus = 1;
                                $memberTbl->jdtm_createdon = $date;
                                $memberTbl->jdtm_createdby = $userPK;
                                $memberTbl->jdtm_createdbyipaddr = $ip_address;
                                $memberTbl->jdtm_invitedon = $date;
                                if (!$memberTbl->save()) {
                                    return array(
                                        'status' => 200,
                                        'msg' => 'error',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong!',
                                        'returndata' => $memberTbl->getErrors()
                                    );
                                }else{ 
                                
                                    $jdoTargetTbl = JdodiscussmemberTbl::find()
                                    ->where("jddm_jdodiscusshdr_fk=:pk and jddm_jdotargetmember_fk = :userPk", [':pk' => $discussionhdrPk, ':userPk' => $memberTbl->jdotargetmember_pk])
                                    ->one();
                                    if (empty($jdoTargetTbl)) {
                                        $model = new JdodiscussmemberTbl();
                                        $model->jddm_jdodiscusshdr_fk = $discussionhdrPk;
                                        $model->jddm_jdotargetmember_fk = $memberTbl->jdotargetmember_pk;
                                        $model->jddm_status = 1;
                                        $model->jddm_createdon = $date;
                                        $model->jddm_createdby = $userPK;
                                        $model->jddm_createdbyipaddr = $ip_address;
                                        if (!$model->save()) {
                                            return array(
                                                'status' => 200,
                                                'msg' => 'error',
                                                'flag' => 'E',
                                                'comments' => 'Something went wrong!',
                                                'returndata' => $model->getErrors()
                                            );
                                        }else{
                                            $discussdtlTblmodel = new JdodiscussdtlTbl();
                                            $discussdtlTblmodel->jddd_jdodiscusshdr_fk = $discussionhdrPk;
                                            $discussdtlTblmodel->jddd_jdodiscussmember_fk = $model->jdodiscussmember_pk;
                                            $discussdtlTblmodel->jddd_messagetype=2;
                                            $discussdtlTblmodel->jddd_reply_message = $username['userFullName'].' '.'joined';
                                            $discussdtlTblmodel->jddd_reply_filepath = '';          
                                            $discussdtlTblmodel->jddd_createdbyipaddr = $ip_address;
                                            $discussdtlTblmodel->jddd_createdby = $userPK;
                                            $discussdtlTblmodel->jddd_createdon = $date;
                                            $discussdtlTblmodel->jddd_isdeleted = 2;
                            
                                            if(!$discussdtlTblmodel->save())
                                            {
                                                return array(
                                                    'status' => 200,
                                                    'msg' => 'error',
                                                    'flag' => 'E',
                                                    'comments' => 'Something went wrong!',
                                                    'returndata' => $discussdtlTblmodel->getErrors()
                                                );
                                            }
                                        }
                                    }elseif (!empty($jdoTargetTbl)) {
                                        $jdoTargetTbl->jddm_status = ($jdoTargetTbl->jddm_status==1)?2:1;
                                        $memberTbl->jdtm_remdrejnon=$date;
                                        if (!$jdoTargetTbl->save()) {
                                            return array(
                                                'status' => 200,
                                                'msg' => 'error',
                                                'flag' => 'E',
                                                'comments' => 'Something went wrong!',
                                                'returndata' => $jdoTargetTbl->getErrors()
                                            );
                                        }
                                    }
                                }
                            } else {
                                // $memberTbl->jdtm_userstatus = ($memberTbl->jdtm_userstatus==3)?1:3;
                                $memberTbl->jdtm_userstatus = ($memberTbl->jdtm_userstatus==3)?4:3;
                                if($memberTbl->jdtm_userstatus==3){
                                    $memberTbl->jdtm_removedon=$date;
                                    
                                    
                                }elseif($memberTbl->jdtm_userstatus==4){
                                    $memberTbl->jdtm_rejoinedon=$date;
                                }
                                if (!$memberTbl->save()) {
                                    return array(
                                        'status' => 200,
                                        'msg' => 'error',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong!',
                                        'returndata' => $memberTbl->getErrors()
                                    );
                                }


                                $jdoTargetTbl = JdodiscussmemberTbl::find()
                                ->where("jddm_jdodiscusshdr_fk=:pk and jddm_jdotargetmember_fk = :userPk", [':pk' => $discussionhdrPk, ':userPk' => $memberTbl->jdotargetmember_pk])
                                ->one();
                                if (!empty($jdoTargetTbl)) {
                                    $jdoTargetTbl->jddm_status =  ($jdoTargetTbl->jddm_status==1)?2:1;
                                    if (!$jdoTargetTbl->save()) {
                                        return array(
                                            'status' => 200,
                                            'msg' => 'error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'returndata' => $jdoTargetTbl->getErrors()
                                        );
                                    }
                                }

                                    $discussdtlTblmodel = new JdodiscussdtlTbl();
                                    $discussdtlTblmodel->jddd_jdodiscusshdr_fk = $discussionhdrPk;
                                    $discussdtlTblmodel->jddd_jdodiscussmember_fk = $jdoTargetTbl->jdodiscussmember_pk;
                                    $discussdtlTblmodel->jddd_messagetype=($memberTbl->jdtm_userstatus==3)?3:2;
                                    $discussdtlTblmodel->jddd_reply_message =($memberTbl->jdtm_userstatus==3)? $username['userFullName'].' '.'removed':$username['userFullName'].' '.'joined';
                                    $discussdtlTblmodel->jddd_reply_filepath = '';          
                                    $discussdtlTblmodel->jddd_createdbyipaddr = $ip_address;
                                    $discussdtlTblmodel->jddd_createdby = $userPK;
                                    $discussdtlTblmodel->jddd_createdon = $date;
                                    $discussdtlTblmodel->jddd_isdeleted = 2;
                    
                                    if(!$discussdtlTblmodel->save())
                                    {
                                        return array(
                                            'status' => 200,
                                            'msg' => 'error',
                                            'flag' => 'E',
                                            'comments' => 'Something went wrong!',
                                            'returndata' => $discussdtlTblmodel->getErrors()
                                        );
                                    }
                            }
                        }

                    }
                }
                
            //}
        }
        
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'comments' => 'Members Updated successfully',
        );
        
      
        return $result;
       

        // echo"<pre>";
        // print_r($addremoveUserData);
        
    }


   public function getInvitedUserList($modulePks) {

        $finalData = [];
        $user['internalUser'] = [];
        $user['externalUser'] = [];
        $intuserpk=[];
        $extuserpk=[];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        // echo"<pre>";
        // print_r($modulePks);
       
        if (!empty($modulePks)) {

            $modulePks_arr=explode(',',$modulePks);

            // echo"<pre>modulePks_arr\n";
            // print_r($modulePks_arr);
            foreach($modulePks_arr as $modpk)
            {

                // echo"\nmodpk $modpk\n";

                $model = JdotargetmemberTbl::find()
                    ->select(['UserMst_Pk','um_firstname','jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp'])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where('jdtm_jdomoduledtl_fk=:dataPk and jdtm_userstatus != 3', array(':dataPk' => $modpk))
                    ->asArray()
                    ->all();

                    // echo"<pre>\n";
                    // print_r($model);

                    foreach ($model as $userData) {
                        if (!empty($userData['um_userdp'])) {
                            $userData['imageUrl'] = \common\components\Drive::generateUrl($userData['um_userdp'], $userData['MemberCompMst_Pk'], $userData['UserMst_Pk']);
                        } else {
                            $userData['imageUrl'] = null;
                        }
                        if($userData['jdtm_usertype'] == 1){
                            if(!in_array($userData['UserMst_Pk'],$intuserpk) && $userData['UserMst_Pk']!=$userPK)
                            {
                                // echo"\n". $userData['UserMst_Pk'];
                                $user['internalUser'][] = $userData;
                                $intuserpk[]=$userData['UserMst_Pk'];
                            }

                        }  else {

                            if(!in_array($userData['UserMst_Pk'],$extuserpk) && $userData['UserMst_Pk']!=$userPK)
                            {
                                // echo"\n". $userData['UserMst_Pk'];
                                $user['externalUser'][] = $userData;
                                $extuserpk[]=$userData['UserMst_Pk'];
                            }
                            
                        }
                    }
                    
            }

            
        }
        
        // echo"\n\n<pre>";
        // print_r($user);
        // exit;

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $user,
        );
        return $result;
    }

    public function getAddedRemovedmembers($modpk,$jdohdrpk,$date)
    {

       

        $finalData = [];
        $user['removed_on'] = [];
        $user['added_on'] = [];
        

        $model = JdotargetmemberTbl::find()
        ->select(['UserMst_Pk','um_firstname','um_lastname',"concat_ws(' ',um_firstname, um_middlename, um_lastname) as  userFullName",'jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp','jdtm_createdon','jdtm_userstatus','jddd_messagetype','jddd_reply_message','jdodiscussdtl_pk','MCM_CompanyName as comp_name',"COALESCE(um_landlineno,'') as um_landlineno",
        'um_landlineext','trim(concat(CyM_CountryDialCode," ",um_primobno)) as mobileNo' ,'um_primobnocc','UM_EmailID as emailId','jdtm_removedon','jdtm_rejoinedon'])
        ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
        ->leftJoin('jdodiscussmember_tbl', 'jddm_jdotargetmember_fk = jdotargetmember_pk')
        ->leftJoin('jdodiscussdtl_tbl', 'jddd_jdodiscussmember_fk = jdodiscussmember_pk')
        ->leftJoin('countrymst_tbl', 'um_primobnocc=CountryMst_Pk')
        ->where('jdtm_jdomoduledtl_fk=:dataPk and (jddd_messagetype=2 or jddd_messagetype=3)', array(':dataPk' => $modpk))
        ->orderBy(['jdodiscussdtl_pk'=>SORT_DESC,'COALESCE(jdtm_createdon, jdtm_removedon,jdtm_rejoinedon)' => SORT_DESC])
        ->asArray()
        ->all();

        foreach($model as $moddata)
        {
            $moddata['userImg'] = Drive::generateUrl($moddata['um_userdp'], $moddata['compPk'], $moddata['UserMst_Pk']);

            $finaldata[]=$moddata;
        }

       
        // echo"<pre>\n";
        // print_r($finaldata);
        // exit;
        
       
        return $finaldata;
        
    }
 
    public function getTotalDiscussion($Userpk)
    {
        // echo"\nUserpk $Userpk";
        $date_format='%d-%m-%Y';
        // $Userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $countArr=0;
        // $recvSkycard_Count=MemcompskycardhdrTbl::find()
        // ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        // ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')     
        // ->where([
        //     'mcsdm_participants'=> $Userpk,
        //     ])
        // ->asArray()->all();
        
        $recvSkycard_Count=MemcompskycardmapTbl::find()->select(['mcsdm_memcompskycarddtls_fk','mcsdm_participants','mcsdm_isnewtag','mcsdm_tagviewedtime'])
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.memcompskycarddtls_pk=mcsdm_memcompskycarddtls_fk') 
         ->leftJoin('memcompskycardhdr_tbl','memcompskycardhdr_pk = skycdtls.mcosd_memcompskycardhdr_fk ')
         ->where([
            'mcsdm_participants'=> $Userpk,
            ])
        ->asArray()->all();

        // echo"<pre>recvSkycard_Count";
        // print_r($recvSkycard_Count);
        // exit;

        // $postedSkycard_Count=MemcompskycardhdrTbl::find()
        // ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        // ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')  
        // ->where([
        //     'mcosc_name_usremst_fk'=> $Userpk,
        //     ])
        // ->asArray()->all();

        $postedSkycard_Count=MemcompskycarddtlsTbl::find()
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = memcompskycarddtls_pk ') 
        ->where([
            'mcosd_createdby'=> $Userpk,
            ])
        ->asArray()->all();
        // ->count();

        // echo"<pre>";
        // print_r($postedSkycard_Count);

        // exit;

        // $countArr=['recvDisCount'=>$recvSkycard_Count,'postDiscCount'=>$postedSkycard_Count];
        $countArr=count($recvSkycard_Count) + count($postedSkycard_Count);

       
        return $countArr;
       
        
    }

    public function actionGetdesgndept()
    {

        $UserPK=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $date_format='%d-%m-%Y';
        $UserDesgnDept=MemcompskycardhdrTbl::find()->select([
            
            'dsg_designationname as des_name', 
            'DepartmentMst_Pk as depId', 
            'DM_Name as dep_name', 
            'UserMst_Pk',
            'designationmst_pk as desID',
            'jdomoduledtl_pk',

        ])
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
        ->leftJoin('jdotargetmember_tbl','jdtm_jdomoduledtl_fk = jdomoduledtl_pk')
        ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
        ->leftJoin('designationmst_tbl', 'UM_Designation = designationmst_pk')
        ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=UM_MemberRegMst_Fk')
        ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=MemberRegMst_Pk')
        ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
        ->where([
            'mcsdm_participants'=> $UserPK,
        ])
        ->andwhere(['<>','jdtm_userstatus',3])
        ->andWhere('UM_Status = :UM_Status', ['UM_Status' => 'A'])
        ->orwhere(['mcosc_name_usremst_fk'=>$UserPK])
        ->orderBy('DM_Name asc')
        // ->groupBy(['depId'])
        ->distinct()
        ->asArray()->all();

        $dept_idss=[];
        $des_idss=[];
       


        if(!empty($UserDesgnDept))
        {
            foreach($UserDesgnDept as $userData)
            {
                
                if(!empty($userData['depId']) && $userData['depId']!=null){
                    if(!in_array($userData['depId'],$dept_idss))
                        {
                            $userdepts[]=['depId'=>$userData['depId'],'depName'=>$userData['dep_name']];
                            array_push($dept_idss,$userData['depId']);
                        }
                }
                
                if(!empty($userData['desID']) && $userData['desID']!=null){
                    if(!in_array($userData['desID'],$des_idss))
                    {
                        $userdesgn[]=['desId'=>$userData['desID'],'desName'=>$userData['des_name']];
                        array_push($des_idss,$userData['desID']);
                    }
                }
                

            }
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'UserData' => ['departments'=>$userdepts,'designations'=>$userdesgn],
        );
        return $result;

        
    }

    public function actionGetSkycardUsers(){

        // $page,$size,$sortUserType,$searchedText
        $userPk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $regPK = \yii\db\ActiveRecord::getTokenData('MCM_MemberRegMst_Fk', true);

        $request = Yii::$app->request->post();
        $size = $request['page'];
        $page = $request['size'];
        $sortUserType=$request['sortUserType'];
        $searchedText=$request['searchedText'];
        $filterdata=$request['filterdata'];

        $department=[];
        $designation=[];

        $users = [];
        $deppks=[];
        $despks=[];

        // echo"<pre>filterdata \n";
        // print_r($filterdata);
        // exit;
    
       
        // $regPK=7;
        $internalUserList = UsermstTbl::find()
        ->select([
            
            'UserMst_Pk as userPk', 
            'UM_EmpId as empId', 
            'um_firstname as fname', 
            'um_middlename as mName',  
            'um_lastname as lname', 
            "concat_ws(' ',um_firstname, um_middlename, um_lastname) as  membername",
            'dsg_designationname as designation', 
            'um_departmentmst_fk as departmentId', 
            'group_concat(DISTINCT DM_Name separator ", ") as departmentName', 
            'UM_Status as status' , 
            'um_isinvited as invitedStatus',
            'UM_EmailID as emailId', 
            'um_primobno as mobileNo', 
            'um_primobnocc as mobileNoCC', 
            'REPLACE(CyM_CountryDialCode,"00","+") as mobileNoCCode',
            'UM_TimeZone as timezone',
            //'um_branchname as branch',
            'um_busunit as busunit',
            'um_whatsapp as whatsappNo', 
            'um_whatsappcc as whatsappCC',
            'group_concat(DISTINCT mcsd_businessunitrefname separator ", ") as bUnitSector',
            'UM_Type as userType',
            'count(UserPermTrn_Pk) as isModuleAllocated',
            'um_emailconfirmstatus as emailStatus','um_userdp',
            '(case UM_Status when "A" then "Active" when "I" then "Inactive" when "Y" then "Yet to Approve" when "YR" then "Yet to Register" end) as userStatus',
            'MemberCompMst_Pk as compPk',
            'um_userdp userImg',
            'UM_Designation as desID',

        ])
        ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
        ->leftJoin('memcompsectordtls_tbl','find_in_set(MemCompSecDtls_Pk, um_busunit)')
        //->leftJoin('sectormst_tbl','find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)')
        ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
        ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
        ->leftJoin('userpermtrn_tbl','UPT_UserMst_Fk = UserMst_Pk')
        ->leftJoin('basemodulemst_tbl','basemodulemst_pk=upt_basemodulemst_fk')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
        //->where(['UM_MemberRegMst_Fk'=>$stkRegPk,'UM_Type'=>'U'])
        ->where(['UM_MemberRegMst_Fk'=>$regPK])
        ->andWhere(['<>','UM_Status','D'])
        ->andWhere(['<>','UM_Type','MA'])
        // ->andWhere(['<>','UM_Status','D'])
        ->andWhere("UM_Type != 'MA' ")
        ->andwhere(['um_emailconfirmstatus'=>1])
        ->andwhere(['like','bmm_name','%SkyCard Management%', false]);
        if(isset($searchedText) && !empty($searchedText)){
            $internalUserList->andFilterWhere(['or', ['like', 'um_firstname', $searchedText], ['like', 'um_lastname', $searchedText],['like', 'dsg_designationname', $searchedText],['like', 'DM_Name', $searchedText],['like', 'UM_EmailID', $searchedText]]);
        }
        if (!empty($filterdata) && $filterdata!=null) {

            $internalUserList->andFilterWhere(['like','concat_ws(" ",um_firstname,um_middlename,um_lastname)', $filterdata['username']])
            ->andFilterWhere(['like', 'UM_EmailID', $filterdata['emailID']])
            // ->andFilterWhere('find_in_set(:deptpk,um_departmentmst_fk)',
            //         [':deptpk' => $filterdata['dept']])
            ->andFilterWhere(['like', 'UM_Designation', $filterdata['desgn']])
            ->andFilterWhere(['like', 'DepartmentMst_Pk', $filterdata['dept']]);
            // ->andFilterWhere(['like', 'dsg_designationname', $filterdata['desgn']])
            // ->andFilterWhere(['like', 'DM_Name', $filterdata['dept']]);

        }
        
        if($sortUserType=='new') {
            $internalUserList->orderBy(['COALESCE(UM_UpdatedOn, UM_CreatedOn)' => SORT_DESC]) ; 
        } elseif ($sortUserType == 'old') {
           $internalUserList ->orderBy(['COALESCE(UM_UpdatedOn, UM_CreatedOn)' => SORT_ASC])  ;      
        }else{
            $internalUserList->orderBy(['COALESCE(UM_UpdatedOn, UM_CreatedOn)' => SORT_DESC]);
        }
        $internalUserList->groupBy('UserMst_Pk')
        ->asArray();
        $size = (!empty($size)) ? $size : 10;
        $page = (!empty($page)) ? $page : 1;    

        // echo"asgdhafsd";
        // print_r($sort);
        // exit;
 
        $internalUserListProvider = new ActiveDataProvider([
            'query' => $internalUserList,
            // 'sort' => [
            //     'defaultOrder' => $sortqry
            // ],
            'pagination' => ['pageSize' => $size]
        ]);

        // print_r($internalUserListProvider->getModels());
        // exit;

       
        $recCnt=0;
        $postCnt=0;
        $totDisc=0;
        $totSkycard=0;
        $activecardCnt=0;
        if (!empty($internalUserListProvider->getModels())) {
           
            foreach ($internalUserListProvider->getModels() as $key => $value) {
               

                $value['userImg'] = Drive::generateUrl($value['userImg'], $value['compPk'], $value['userPk']);
                $users[]=$value;

                $deptpks=explode(',',$value['departmentId']);
                
                if(!empty($deptpks))
                {
                    foreach($deptpks as $depid)
                    {
                        
                        if(!in_array($depid,$deppks)){
                            
                            $deppks[]=$depid;
                        }
                    }
                }
                if(!in_array($value['desID'],$despks))
                {
                   $despks[]=$value['desID'];
                }

                $skycardCounts=self::skycardCounts($value['userPk']);
                $totalDiscussion=self::getTotalDiscussion($value['userPk']);
                $recCnt=$recCnt+$skycardCounts['recCount'];
                $postCnt=$postCnt+$skycardCounts['postCount'];
                $totDisc=$totDisc+$totalDiscussion;
                $totSkycard=$recCnt+$postCnt;
                $activecardCnt=$activecardCnt+$skycardCounts['activecardCount'];
             
                

            }
        }

        $userdepdesgn=self::UserDepDesgn($regPK);
       


        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'UserData' => $users,
            'dataCount'=>$internalUserListProvider->getTotalCount(),
            'userdepdesgn'=>$userdepdesgn,
            'SkycardCounts'=>['recCnt'=>$recCnt,'postCnt'=>$postCnt,'totDisc'=>$totDisc,'reAsgn'=>0,'totSkycard'=>$totSkycard,'activecardCnt'=>$activecardCnt]
        );
        return $result;
    }

    function skycardCounts($skyc_user_pk){


        $recSkycards=MemcompskycardhdrTbl::find()
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
        ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
        ->where([
            'mcsdm_participants'=> $skyc_user_pk,
            ])
        ->andwhere([
                'jdomoduledtl_tbl.jdmd_shared_type'=> 3,
        ])
        ->orderBy([
                    
                'max(mcosc_createdon)'=>SORT_DESC,
            ])
        ->groupBy([
            'mcosc_name_usremst_fk',
        ])
        ->asArray();
        $provider = new ActiveDataProvider([ 'query' => $recSkycards]);

        // echo"\n\n rec count ";
        // print_r($provider->getTotalCount());


        //code to get dropped skycard start
        $postedSkycards=MemcompskycardhdrTbl::find()
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
        ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
        ->where([
            'mcosc_name_usremst_fk'=> $skyc_user_pk,
            ])
        ->andwhere(['mcosc_createdby'=>$skyc_user_pk])
        ->andwhere([
            'mcsdm_participantstype'=> 1,
        ])
        ->andwhere([
                'jdomoduledtl_tbl.jdmd_shared_type'=> 3,
        ])
        ->orderBy([
                    
                'max(mcosc_createdon)'=>SORT_DESC,
            ])
            ->groupBy([
            'mcosd_memcompskycardhdr_fk',
        ])
        ->asArray();
        $provider_drop = new ActiveDataProvider([ 'query' => $postedSkycards]);

        // echo"\n\n rec provider Count ";
        // print_r($provider_drop->getTotalCount());

        $activeSkycardCount=MemcompskycardhdrTbl::find()->select(['mcosd_shared_fk','jdomoduledtl_pk'])
        ->leftJoin('memcompskycarddtls_tbl skycdtls','skycdtls.mcosd_memcompskycardhdr_fk=memcompskycardhdr_pk') 
        ->leftJoin('memcompskycardmap_tbl','mcsdm_memcompskycarddtls_fk = skycdtls.memcompskycarddtls_pk ')
        ->leftJoin('jdomoduledtl_tbl','jdmd_shared_fk=skycdtls.memcompskycarddtls_pk')
        ->leftJoin('jdodiscusshdr_tbl','jddh_jdomoduledtl_fk=jdomoduledtl_pk')
        ->leftJoin('jdotargetmember_tbl','jdtm_jdomoduledtl_fk=jdomoduledtl_pk')
        ->where(['mcsdm_createdby'=>$skyc_user_pk])
        ->orwhere(['mcsdm_participants'=>$skyc_user_pk])
        ->andwhere(['!=','jddh_status',3])
        ->groupBy([
            'skycdtls.memcompskycarddtls_pk',
        ])->asArray();
        
        // echo"\n\nskyc_user_pk $skyc_user_pk";

        $provider_activecard = new ActiveDataProvider([ 'query' => $activeSkycardCount]);

        // echo"\n provider_activecard ";
        // print_r($provider_activecard->getTotalCount());


        // echo"\n\nactiveSkycardCount\n<pre>";
        // print_r($provider_activecard->getModels());
        return $countArr=['recCount'=>$provider->getTotalCount(),'postCount'=>$provider_drop->getTotalCount(),'activecardCount'=>$provider_activecard->getTotalCount()];
        
    }

    public function UserDepDesgn($regPK){
        // $deppks,$despks
       
        $Department=[];
        $Designation=[];
        $SkycardUserDesgDept = UsermstTbl::find()
        ->select([
            
            'UserMst_Pk as userPk', 
            'DepartmentMst_Pk as depPK','DM_Name as depName',
            'designationmst_pk as desPK','dsg_designationname as desName'


        ])
        ->leftJoin('departmentmst_tbl','find_in_set(DepartmentMst_Pk, um_departmentmst_fk)')
        ->leftJoin('memcompsectordtls_tbl','find_in_set(MemCompSecDtls_Pk, um_busunit)')
        ->leftJoin('designationmst_tbl','designationmst_pk = UM_Designation')
        ->leftJoin('countrymst_tbl','um_primobnocc = CountryMst_Pk')
        ->leftJoin('userpermtrn_tbl','UPT_UserMst_Fk = UserMst_Pk')
        ->leftJoin('basemodulemst_tbl','basemodulemst_pk=upt_basemodulemst_fk')
        ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
        ->where(['UM_MemberRegMst_Fk'=>$regPK])
        ->andWhere(['<>','UM_Status','D'])
        ->andWhere(['<>','UM_Type','MA'])
        // ->andWhere(['<>','UM_Status','D'])
        ->andWhere("UM_Type != 'MA' ")
        ->andwhere(['um_emailconfirmstatus'=>1])
        ->andwhere(['like','bmm_name','%SkyCard Management%', false])
        ->groupBy('UserMst_Pk')
        ->asArray();
       
 
        $internalUserListProvider = new ActiveDataProvider([
            'query' => $SkycardUserDesgDept,
        ]);

        $deppk=[];
        $despk=[];
        foreach($internalUserListProvider->getModels() as $key=>$value){

            if(!in_array($value['depPK'],$deppk)){
                array_push($deppk,$value['depPK']);
                $Department[]=['depPK'=>$value['depPK'],'depName'=>$value['depName']];
            }

            if(!in_array($value['desPK'],$despk)){
                array_push($despk,$value['desPK']);
                $Designation[]=['desPK'=>$value['desPK'],'desName'=>$value['desName']];
            }


        }

        // $Department=DepartmentmstTbl::find()->select(['DepartmentMst_Pk as depPK','DM_Name as depName'])
        // ->where(['in','DepartmentMst_Pk',$deppks])
        // ->andwhere(['DM_Status'=>1])
        // ->asArray()->all();

        // $Designation=DesignationmstTbl::find()->select(['designationmst_pk as desPK','dsg_designationname as desName'])
        // ->where(['in','designationmst_pk',$despks])
        // ->andwhere(['dsg_status'=>1])
        // ->asArray()->all();

        return $depdesgnarr=['department'=>$Department,'designation'=>$Designation];



    }
     

}
