<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use \common\components\Drive;
use common\components\Common;
use api\modules\ct\models\JdonoteshdrTbl;
use api\modules\ct\models\JdonotesmemberTbl;

/**
 * This is the ActiveQuery class for [[JdonoteshdrTbl]].
 *
 * @see JdonoteshdrTbl
 */
class JdonoteshdrTblQuery extends \yii\db\ActiveQuery {

    
    public function addnotes($data)
    {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        $notesdtls= JdonoteshdrTbl::findOne($data['notepk']);
        if($notesdtls) {
            $notesdtls->jdnh_notestitle = Security::sanitizeInput($data['title'], "string");
            $notesdtls->jdnh_notesdesc = Security::sanitizeInput($data['description'], "string");
            $notesdtls->jdnh_notesdate = date("Y-m-d", strtotime($data['date']));
            $notesdtls->jdnh_notestime = date("H:i:s", strtotime($data['time']));
            $notesdtls->jdnh_notifyallday = $data['allday'] ? 1 : 2;
            $notesdtls->jdnh_notes_filepath = implode(',', $data['notesUpload']);
            $notesdtls->jdnh_notifybefore = Security::sanitizeInput($data['notifybefore'], "string");
            $notesdtls->jdnh_notes_timezone_fk = Security::sanitizeInput($data['timezone'], "string");
            $notesdtls->jdnh_status = 1;
            $notesdtls->jdnh_updatedon = date('Y-m-d H:i:s');
            $notesdtls->jdnh_updatedbyipaddr = $ip_address;
            $notesdtls->jdnh_updatedby = $userPK;
            $msg = "Note details updated successfully";
        } else {
            $targetmemberPK = JdotargetmemberTbl::find()->where(['jdtm_jdomoduledtl_fk' => $data['dtlsPk'], 'jdtm_target_usermst_fk' => $userPK])->one()->jdotargetmember_pk;

            $notesdtls = new JdonoteshdrTbl();
            $notesdtls->jdnh_jdomoduledtl_fk = Security::sanitizeInput($data['dtlsPk'], "number");
            $notesdtls->jdnh_creator_jdotargetmember_fk = $targetmemberPK;
            $notesdtls->jdnh_notestitle = Security::sanitizeInput($data['title'], "string");
            $notesdtls->jdnh_notesdesc = Security::sanitizeInput($data['description'], "string");
            $notesdtls->jdnh_notifybefore = Security::sanitizeInput($data['notifybefore'], "string");
            $notesdtls->jdnh_notesdate = date("Y-m-d", strtotime($data['date']));
            $notesdtls->jdnh_notestime =  date("H:i:s", strtotime($data['time']));
            $notesdtls->jdnh_notifyallday = $data['allday'] ? 1 : 2;
            $notesdtls->jdnh_notes_filepath = implode(',', $data['notesUpload']);
            $notesdtls->jdnh_notes_timezone_fk = Security::sanitizeInput($data['timezone'], "string");
            $notesdtls->jdnh_status = 1;
            $notesdtls->jdnh_isdeleted = 2;
            $notesdtls->jdnh_createdon = date('Y-m-d H:i:s');
            $notesdtls->jdnh_createdbyipaddr = $ip_address;
            $notesdtls->jdnh_createdby = $userPK;
           
            $msg = "Note detail saved successfully";
        }

        if($notesdtls->save() == TRUE) {
            if(!$data['notespk']) {
                if($data['internalInvite']) {
                    $array = $data['internalInvite'];
                } elseif($data['externalInvite']) {
                    $array = $data['externalInvite'];
                } elseif($data['internalInvite'] && $data['externalInvite']) {
                    $array = array_merge($data['internalInvite'], $data['externalInvite']);
                }
                JdonotesmemberTblQuery::saveNotesMembers($notesdtls->jdonoteshdr_pk, array_map(function($v) {
                    return $v['jdoTargerPk'];
                }, $array));
            }
            
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => $msg,
                'moduleData' => $notesdtls,
            ); 

        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $notesdtls->getErrors()
            );
        }
        return $result;
    }

    public function deletenotes($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if($data){
            if(is_array($data['notepk'])){
                $status = JdonoteshdrTbl::updateAll([
                    'jdnh_isdeleted' => 1],
                    ['in', 'jdonoteshdr_pk', $data['notepk']
                ]);

            } else {
                $model = JdonoteshdrTbl::find()->where("jdonoteshdr_pk=:pk", [':pk' => $data['notepk']])->one();
                if($model){
                    $model->jdnh_isdeleted = 1;
                    $status = $model->save();
                }            
            }
            if($status){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Notes details deleted successfully'
                ); 

            }else{
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!'
                );
            }
        }
        return $result;
    }
   
    public function noteslisting($dataPk)
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $filesQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby,"type",mcfd_filetype,"size",mcfd_actualfilesize)),"]") as files';
        $model = JdonoteshdrTbl::find()
            ->select([
                'jdonoteshdr_pk',
                'jdnh_notestitle',
                'jdnh_notesdesc',
                'jdnh_notesdate',
                'jdnh_notestime',
                'jdnh_notifybefore',
                'jdnh_notifyallday',
                'jdnh_status',
                'jdnh_notes_filepath',
                'jdnh_notes_timezone_fk',
                'tz_utcoffset',
                'IF(jdtm_target_usermst_fk = '.$userPK.', true, false) isShared',
                'CASE  
                    WHEN `jdnh_status` = 3 then "Deleted"
                    WHEN `jdup_category` = 2 then "Archived"
                    WHEN `jdnh_createdby` != '.$userPK.' then "Shared Notes"
                    WHEN `jdup_category` = 3 then "Pinned Notes"
                    WHEN `jdnh_status` = 1 then "My Notes" 
                    WHEN `jdnh_status` = 2 then "Completed"
                    ELSE "" 
                END as notes_status',
                'DATE_FORMAT(jdnh_createdon,"%d-%m-%Y") as jdnh_createdon',
                $filesQ])
            ->leftJoin('timezone_tbl', 'jdnh_notes_timezone_fk = timezone_pk')
            ->leftJoin('jdonotesmember_tbl', 'jdonoteshdr_pk = jdnm_jdonoteshdr_fk')
            ->leftJoin('jdotargetmember_tbl', 'jdnm_jdotargetmember_fk = jdotargetmember_pk')
            ->leftJoin('jdouserpreference_tbl', 'jdonoteshdr_pk = jdup_shared_fk and jdup_shared_type = 4 and jdup_status = 1 and jdup_usermst_fk = '.$userPK)
            ->leftJoin('memcompfiledtls_tbl', 'FIND_IN_SET(memcompfiledtls_pk, jdnh_notes_filepath)')
            ->Where(['jdnh_jdomoduledtl_fk' => $dataPk, 'jdnh_isdeleted' => 2])
            ->andWhere(['or',
                ['=', 'jdtm_target_usermst_fk', $userPK],
                ['=', 'jdnh_createdby', $userPK],
            ]);
        
        $model->orderBy('jdonoteshdr_pk DESC');
        $model->groupBy('jdonoteshdr_pk');
        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $list = [];
        foreach($provider->getModels() as $data){
            $files = [];
            foreach(json_decode($data['files']) as $response) {
                if($response->pk) {     
                    $files[$response->pk] = [
                        'filePk' => $response->pk,
                        'name' => Drive::getFileName(Security::encrypt($response->pk)),
                        'url' => Drive::generateUrl($response->pk, $response->comp_pk, $response->uploadedby),
                        'size' => $response->size,
                        'type' => $response->type
                    ];
                }
            }

            $list[] = [
                'notepk' => $data['jdonoteshdr_pk'],
                'allday' => $data['jdnh_notifyallday'] == 1,
                'archiveStatus' => $data['notes_status'],
                'isShared' => (boolean)$data['isShared'],
                'notifybefore' => $data['jdnh_notifybefore'],
                'notesUpload' => $data['jdnh_notes_filepath'] ? explode(',', $data['jdnh_notes_filepath']) : [],
                'date' => $data['jdnh_notesdate'],
                'time' => $data['jdnh_notestime'],
                'timezone' => $data['jdnh_notes_timezone_fk'],
                'timezoneOffset' => $data['tz_utcoffset'],
                'title' => $data['jdnh_notestitle'],
                'description' => $data['jdnh_notesdesc'],
                'userList' => JdonotesmemberTblQuery::getNotesUser($data['jdonoteshdr_pk'])['moduleData'],
                'files' => array_values($files)
            ];
        }
        
        return [
            'list' => $list,
            'total_count' => $provider->getTotalCount()
        ];
    }

     /*
    * Update status
    *
    */
    public function changeStatus($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
       
        if($data){
            if(is_array($data['notepk'])){
                $status = JdonoteshdrTbl::updateAll([
                    'jdnh_status' => $data['status']],
                    ['in', 'jdonoteshdr_pk', $data['notepk']
                ]);

            } else {
                $model = JdonoteshdrTbl::find()->where("jdonoteshdr_pk=:pk", [':pk' => $data['notepk']])->one();
                if($model){
                    $model->jdnh_status = $data['status'];
                    $status = $model->save();
                }
            
            }
        
            if ($status) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Note(s) status updated Successfully!'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => null
                );
            }
            
        }
        return $result;
    }

}