<?php

namespace api\modules\ct\models;
use api\modules\ct\models\ColtaskdtlsTblQuery;
use api\modules\ct\models\ColdiscusshdrTblQuery;
use common\components\Drive;
use yii\db\ActiveRecord;
use api\modules\ct\models\ColprojaudienceTbl;

/**
 * This is the ActiveQuery class for [[CollaborativemstTbl]].
 *
 * @see CollaborativemstTbl
 */
class CollaborativemstTblQuery extends \yii\db\ActiveQuery {


    /**
     * get Jdrive list
     */
    public function driveList($collaborativepk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $data = [];
        if($collaborativepk){
            $tasks = ColtaskdtlsTbl::find()->where("ctd_collaborativemst_fk=:fk", [':fk' => $collaborativepk])->all();
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if(!empty($tasks)){
                foreach($tasks as $task){
                    foreach($task->attachments as $file){
                        $data[] = array(
                            'name' => $file->mcfd_origfilename,
                            'size' => $file->mcfd_actualfilesize,
                            'path' => Drive::generateUrl($file->mcfd_filemst_fk, $file->mcfd_memcompmst_fk, $userPK)
                        );
                    }
                }
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    /**
     * get Card detail
     */
    public function cardDetail($cardpk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $data = [];
       
        $card = CollaborativemstTbl::find()->where("collaborativemst_pk=:pk", [':pk' => $cardpk])->one();
     
      if(!empty($card)){
            $createdBy = $card->createdby; 
            $invited = $card->getAllmembers()->where(['cpa_invitestatus' => 1])->count();
            $accepted = $card->getAllmembers()->where(['cpa_invitestatus' => 1])->count();
            $pending = $invited-$accepted;
            $externalmembers = $card->getAllmembers()->where(['cpa_usertype' => 2])->count();
            $userPk = ActiveRecord::getTokenData('UserMst_Pk',true);
            $sentOrRecv = "Received";
            if($card->cpm_createdby == $userPk) {
                $sentOrRecv = 'Sent';
            }
            $data = array(
                'general_id' => $card->cpm_referenceno,
                'name' => $card->cpm_projectname,
                'description' => $card->cpm_projdesc,
                'type' => $card->cpm_type,
                'sentOrRecv' => $sentOrRecv,
                'created_by' => !empty($card->createdby) ? [
                    'first_name' => $createdBy->um_firstname,
                    'middle_name' => $createdBy->um_lastname,
                    'last_name' => $createdBy->um_lastname,
                    'company' => $createdBy->membercompany ?  $createdBy->membercompany->MCM_CompanyName : null
                ] : null,
                'created_on' => $card->cpm_createdon,
                'members' => [
                    'invited' => $invited,
                    'accepted' => $accepted,
                    'pending' => $pending,
                    'externalmembers' => $externalmembers
                ]
            );

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
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
       
        $card = CollaborativemstTbl::find()->where("collaborativemst_pk=:pk", [':pk' => $data['formData']['cardpk']])->one();
       
        if($card){
            $res = [];
            $arr = [];
            $members = $card->getAllmembers()->where(['cpa_usertype' => $data['formData']['type']])->all();
          
            if(!empty($members)){   
                $department = '';
                $company = '';
                foreach($members as $member) {
                    $user = $member->user;
                    $userDep = $user->department ? $user->department->DM_Name : null;
                   
                    $userComp = $user->membercompany ? $user->membercompany->MCM_CompanyName : null;
                    $arr = array(
                        'invite_status' => $member->cpa_invitestatus,
                        'first_name' => $user->um_firstname,
                        'middle_name' => $user->um_lastname,
                        'last_name' => $user->um_lastname,
                        'email_id' => $user->UM_EmailID,
                        'mobile' => $user->um_primobno,
                        'accepted_on' => $member->cpa_accdeclon,
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
           
        }

        return $result;
    }

}
