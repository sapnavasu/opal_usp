<?php

namespace api\modules\ct\models;

use Exception;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdotargetmemberTbl]].
 *
 * @see JdotargetmemberTbl
 */
class JdotargetmemberTblQuery extends \yii\db\ActiveQuery {

    public function updateinvitestatus($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $jdomemberpk = Security::sanitizeInput($data, "number");
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = date("Y-m-d H:i:s");
        $targetmember = JdotargetmemberTbl::find()
                ->where("jdtm_jdomoduledtl_fk=:pk and jdtm_target_usermst_fk = :userPk and jdtm_target_membercompmst_fk = :compPK",[':pk'=>$jdomemberpk,':userPk'=>$userPK,':compPK'=>$compPK])
                ->one();
    
        if(!empty($targetmember)){
            $targetmember->jdtm_invitestatus = 3;
            $targetmember->jdtm_userstatus = 2;
            $targetmember->jdtm_acceptedon = $data;
            if($targetmember->save()){
            
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Invite accept successfully'
                );
            }else{
                $result = array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'returndata' => $targetmember->getErrors(),
                );
            }
        }
      
        return $result;
    }

    public function addMember($dtlsPk,$createrData,$usersArray,$dataType){
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $date = date("Y-m-d H:i:s");
        if ($createrData == 1) {
            $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $memberTbl = new JdotargetmemberTbl();
            $memberTbl->jdtm_jdomoduledtl_fk = $dtlsPk;
            $memberTbl->jdtm_usertype = 1;
            $memberTbl->jdtm_target_membercompmst_fk = $compPK;
            $memberTbl->jdtm_target_usermst_fk = $userPK;
            $memberTbl->jdtm_invitestatus = 1;
            $memberTbl->jdtm_userstatus = 2;
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
            }
        } else {
            if (count($usersArray) > 0) {
                foreach ($usersArray as $key => $value) {
                    $memberTbl = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $dtlsPk, 'jdtm_target_membercompmst_fk' => $value['compPk'], 'jdtm_target_usermst_fk' => $value['UserMst_Pk'], 'jdtm_userstatus' => 3])->one();
                    if (empty($memberTbl)) {
                        $memberTbl = new JdotargetmemberTbl();
                        $memberTbl->jdtm_jdomoduledtl_fk = $dtlsPk;
                        $memberTbl->jdtm_usertype = $dataType;
                        $memberTbl->jdtm_target_membercompmst_fk = $value['compPk'];
                        $memberTbl->jdtm_target_usermst_fk = $value['UserMst_Pk'];
                        $memberTbl->jdtm_invitestatus = 2;
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
                        }
                    } else {
                        $memberTbl->jdtm_userstatus = 1;
                        $memberTbl->jdtm_rejoinedon = $date;
                        if (!$memberTbl->save()) {
                            return array(
                                'status' => 200,
                                'msg' => 'error',
                                'flag' => 'E',
                                'comments' => 'Something went wrong!',
                                'returndata' => $memberTbl->getErrors()
                            );
                        }
                    }
                }
            }
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'comments' => 'Members added successfully',
        );
        return $result;
    }
    
    public function removeMember($dtlsPk,$usersArray){
        $date = date("Y-m-d H:i:s");
        if (count($usersArray) > 0) {
            foreach ($usersArray as $key => $value) {
                $memberTbl = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $dtlsPk, 'jdtm_target_membercompmst_fk' => $value['compPk'], 'jdtm_target_usermst_fk' => $value['UserMst_Pk']])->one();
                if (!empty($memberTbl)) {                    
                    $memberTbl->jdtm_userstatus = 3;
                    if (!$memberTbl->save()) {
                        return array(
                            'status' => 200,
                            'msg' => 'error',
                            'flag' => 'E',
                            'comments' => 'Something went wrong!',
                            'returndata' => $memberTbl->getErrors()
                        );
                    }
                }
            }
        }

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'comments' => 'Members removed successfully!',
        );
        return $result;
    }

    public function addteammember($data)
    {
        $jdomoduledtlpk = Security::sanitizeInput($data['jdomoduledtlpk'], "number");
        $internal_ursers = explode(',', $data['internal_users']);
        $external_ursers = explode(',', $data['external_users']);
        $comp_pk = Security::sanitizeInput($data['comppk'], "number");
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
      
        if(count($internal_ursers)>0){
            foreach($internal_ursers as $key=>$value){
                $memberTbl = new JdotargetmemberTbl();
                $exist = $memberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $jdomoduledtlpk, 'jdtm_target_membercompmst_fk' => $comp_pk, 'jdtm_target_usermst_fk' => $value])->one();
              
                if($exist && $exist->jdtm_userstatus == 3){
                    $memberTbl = $exist;
                    $memberTbl->jdtm_rejoinedon = date('Y-m-d H:i:s');
                    $memberTbl->jdtm_userstatus = 1;
                } else {
                    $memberTbl->jdtm_jdomoduledtl_fk = $jdomoduledtlpk;
                    $memberTbl->jdtm_usertype = 1;
                    $memberTbl->jdtm_target_membercompmst_fk = $comp_pk;
                    $memberTbl->jdtm_target_usermst_fk = $value;
                    $memberTbl->jdtm_invitestatus = ($userPK == $value) ? 1 : 2;
                    $memberTbl->jdtm_userstatus = ($userPK == $value) ? 2 : 1;
                    // $memberTbl->cpa_isdiscussion = 1;
                    $memberTbl->jdtm_createdby = $userPK; 
                    $memberTbl->jdtm_createdon = date('Y-m-d H:i:s');
                    $memberTbl->jdtm_invitedon = date('Y-m-d H:i:s');
                }
                $memberTbl->save();   
            }
        }
        
        if(count($external_ursers) > 0){
            
            foreach($external_ursers as $key=>$value){
                $item = explode('*', $value);
                $memberTbl = new JdotargetmemberTbl();
                $exist = $memberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $jdomoduledtlpk, 'jdtm_target_membercompmst_fk' => $item[1], 'jdtm_target_usermst_fk' => $item[0]])->one();
                if($exist && $exist->jdtm_userstatus == 3){
                    $memberTbl = $exist;
                    $memberTbl->jdtm_rejoinedon = date('Y-m-d H:i:s');
                    $memberTbl->jdtm_userstatus = 1;
                } else {
                    $memberTbl->jdtm_jdomoduledtl_fk = $jdomoduledtlpk;
                    $memberTbl->jdtm_usertype = 1;
                    $memberTbl->jdtm_target_membercompmst_fk = $item[1];
                    $memberTbl->jdtm_target_usermst_fk = $item[0];
                    $memberTbl->jdtm_invitestatus = ($userPK == $item[0]) ? 1 : 2;;
                    $memberTbl->jdtm_userstatus =  ($userPK == $item[0]) ? 2 : 1;;
                    // $memberTbl->cpa_isdiscussion = 1;
                    $memberTbl->jdtm_createdon = date('Y-m-d H:i:s');
                    $memberTbl->jdtm_invitedon = date('Y-m-d H:i:s');
                }
                $memberTbl->save();
            }
        }

        if($internal_ursers > 0 || $external_ursers > 0){
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'Members added successfully',
                'returnData' => $memberTbl
            );
        }else{
            $result = array(
                'status' => 200,
                'msg' => 'error',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returnData' => $memberTbl->getErrors()
            );
        }
        return $result;
    }

    /**
     * get mannage members list
     */
    public function manageCardmembers($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
       
        $members = JdotargetmemberTbl::find()->where("jdtm_jdomoduledtl_fk=:pk", [':pk' => $data['formData']['moduledtlpk']])->all();
      
        $res = [];
        $arr = [];
     
        if(!empty($members)){   
            $department = '';
            $company = '';
            foreach($members as $member) {
                $user = $member->user;
                $userDep = $user->department ? $user->department->DM_Name : null;
                
                $userComp = $user->membercompany ? $user->membercompany->MCM_CompanyName : null;
                $arr = array(
                    'invite_status' => $member->jdtm_invitestatus,
                    'first_name' => $user->um_firstname,
                    'middle_name' => $user->um_lastname,
                    'last_name' => $user->um_lastname,
                    'email_id' => $user->UM_EmailID,
                    'mobile' => $user->um_primobno,
                    'accepted_on' => $member->jdtm_acceptedon,
                    'designation' => $user->designation ? $user->designation->dsg_designationname : null
                );

                if($company == $userComp){
                    if($department == $userDep){
                        $res[$company][$department][] = $arr;
                    } else {
                        $res[$company][$userDep][] = $arr;
                    }
                    
                } else {

                    if($department == $userDep){
                        $res[$userComp][$department][] = $arr;
                    } else {
                        $res[$userComp][$userDep][] = $arr;
                    }
                }
                
                $company = $userComp;
                $department = $userDep;
            }


            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $res
            );
        }

        return $result;
    }

     /*
    * Uncollaborate user
    *
    */
    public function updateCardmembers($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        try{
            if($data){
                if(is_array($data['formData']['memberpk'])){
                    $status = JdotargetmemberTbl::updateAll([
                        'jdtm_isdiscussion' => 2],
                        ['and', 
                            ['in', 'jdotargetmember_pk', $data['formData']['memberpk']], 
                            ['jdtm_jdomoduledtl_fk' => $data['formData']['moduledtlpk']]
                        ]
                    );
                
                } else {
                    $model = JdotargetmemberTbl::find()->where("jdotargetmember_pk=:pk", [':pk' => $data['formData']['memberpk']])->andWhere('jdtm_jdomoduledtl_fk=:cpk', [':cpk' => $data['formData']['moduledtlpk']])->one();
                    $model->jdtm_isdiscussion = 2;
                    $status = $model->save();
                }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Member(s) updated Successfully!'
                );
            }
                
        }catch(Exception $e){
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => null
            );
        }
        return $result;
    }

    /*
    * Exit Card
    *
    */
    public function exitCard($cardpk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $cardMember = JdotargetmemberTbl::find()->where("jdtm_jdomoduledtl_fk=:fk", [':fk' => $cardpk])->andWhere(['jdtm_target_usermst_fk' => $userPK])->one();

        if(!empty($cardMember)){
            $cardMember->jdtm_userstatus = 3;
            if($cardMember->save() ==  TRUE){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Card exited Successfully!'
                );
            }
        }
        return $result;
    }
    public static function getInvitedUserList($dataPk) {
        if (!empty($dataPk)) {
            $model = JdotargetmemberTbl::find()
                    ->select(['UserMst_Pk','um_firstname','jdotargetmember_pk','jdtm_usertype','MemberCompMst_Pk as compPk','UM_MemberRegMst_Fk','MemberCompMst_Pk','um_userdp'])
                    ->leftJoin('usermst_tbl', 'UserMst_Pk = jdtm_target_usermst_fk')
                    ->leftJoin('membercompanymst_tbl', 'MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                    ->where('jdtm_jdomoduledtl_fk=:dataPk and jdtm_userstatus != 3', array(':dataPk' => $dataPk))
                    ->asArray()
                    ->all();
        }
        $finalData = [];
        $user['internalUser'] = [];
        $user['externalUser'] = [];
        foreach ($model as $userData) {
            if (!empty($userData['um_userdp'])) {
                $userData['imageUrl'] = \common\components\Drive::generateUrl($userData['um_userdp'], $userData['MemberCompMst_Pk'], $userData['UserMst_Pk']);
            } else {
                $userData['imageUrl'] = null;
            }
            if($userData['jdtm_usertype'] == 1){
                $user['internalUser'][] = $userData;
            }  else {
                $user['externalUser'][] = $userData;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $user,
        );
        return $result;
    }
}