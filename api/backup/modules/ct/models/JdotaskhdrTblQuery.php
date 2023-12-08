<?php

namespace api\modules\ct\models;

use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use common\components\Drive;

/**
 * This is the ActiveQuery class for [[JdotaskhdrTbl]].
 *
 * @see JdotaskhdrTbl
 */
class JdotaskhdrTblQuery extends \yii\db\ActiveQuery {

    
    public function addtask($data)
    {
        $moduledtlpk = $data['dtlsPk'];
        $taskpk = $data['taskpk'];
        $taskdtl = JdotaskhdrTbl::find()
                ->where("jdotaskhdr_pk=:pk",[':pk'=>$taskpk])
                ->one();
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if(!$taskdtl){
            $taskdtl = new JdotaskhdrTbl();
            $taskdtl->jdth_jdomoduledtl_fk = Security::sanitizeInput($moduledtlpk, "number");
            $taskdtl->jdth_creator_jdotargetmember_fk = Security::sanitizeInput($data['trgtmemPk'], "number");
            $taskdtl->jdth_tasktitle = Security::sanitizeInput($data['title'], "string");
            $taskdtl->jdth_taskdesc = Security::sanitizeInput($data['description'], "string");
            $taskdtl->jdth_taskdate = date("Y-m-d", strtotime($data['date']));
            $taskdtl->jdth_tasktime = date("H:i:s", strtotime($data['time']));
            $taskdtl->jdth_notifybefore = $data['notifytime'];
            $taskdtl->jdth_notifyallday = $data['allTime'] ? 1 : 2;
            $taskdtl->jdth_task_filepath = implode(',', $data['filePks']);
            $taskdtl->jdth_task_timezone_fk = Security::sanitizeInput($data['timezone'], "string");
            $taskdtl->jdth_isdeleted = 2;
            $taskdtl->jdth_createdon = date('Y-m-d H:i:s');
            $taskdtl->jdth_createdby = $userPK;
            $taskdtl->jdth_createdbyipaddr = $ip_address;
            $msg = "Task details inserted successfully";
            $flag = 'C';
        }else{
            // $taskdtl->jdth_tasktitle = Security::sanitizeInput($data['title'], "string");
            // $taskdtl->jdth_taskdesc = Security::sanitizeInput($data['description'], "string");
            $taskdtl->jdth_taskdate = date("Y-m-d", strtotime($data['date']));
            $taskdtl->jdth_tasktime = date("H:i:s", strtotime($data['time']));
            $taskdtl->jdth_notifybefore = $data['notifytime'];
            $taskdtl->jdth_task_timezone_fk = Security::sanitizeInput($data['timezone'], "string");
            $taskdtl->jdth_notifyallday = $data['allTime'] ? 1 : 2;
            // $taskdtl->jdth_task_filepath = implode(',', $data['filePks']);
            $taskdtl->jdth_updatedon = date('Y-m-d H:i:s');
            $taskdtl->jdth_updatedby = $userPK;
            $taskdtl->jdth_updatedbyipaddr = $ip_address;
            $msg = "Task details updated successfully";
            $flag = 'U';
        }

        if($taskdtl->save()){
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => $flag,
                'comments' => $msg,
            );
        }else{
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $taskdtl->getErrors()
            );
        }
    }

    public function updatestatus($data){
        $coltaskpk = Security::sanitizeInput($data['coltaskpk'], "number");
        $status = Security::sanitizeInput($data['taskstatus'], "number");
        $coltaskdtls= JdotaskhdrTbl::find()
                ->where("coltaskdtls_pk=:pk",[':pk'=>$coltaskpk])
                ->one();
        if(!empty($coltaskdtls)){
            $coltaskdtls->ctd_status = $status;
            if($coltaskdtls->save()){
                if($status == 2){
                    $msg = "Task Completed successfully";
                }elseif($status == 3){
                    $msg = "Task Delete successfully";
                }
            }else{
                $msg = "Something went wrong";
            }
        }else{
            $msg = "No record found";
        }
        return $msg;
    }

    public function tasklisting($dataPk)
    {
        $filesQ = 'CONCAT("[",GROUP_CONCAT(JSON_OBJECT("pk",memcompfiledtls_pk,"comp_pk",mcfd_memcompmst_fk,"uploadedby",mcfd_uploadedby,"type",mcfd_filetype,"size",mcfd_actualfilesize)),"]") as files';
        $model = JdotaskhdrTbl::find()
            ->select([
                'jdotaskhdr_pk',
                'jdth_tasktitle',
                'jdth_taskdesc',
                'jdth_notifyallday',
                'jdth_taskdate',
                'jdth_tasktime',
                'jdth_status',
                'jdth_notifybefore',
                'jdth_task_filepath',
                'jdth_task_timezone_fk',
                'tz_utcoffset',
                'CASE 
                    WHEN `jdth_status` = 1 then "In Progress" 
                    WHEN `jdth_status` = 2 then "Completed"  
                    WHEN `jdth_status` = 3 then "Deleted"
                    ELSE "" 
                END as task_status',
                $filesQ])
            ->leftJoin('timezone_tbl', 'jdth_task_timezone_fk = timezone_pk')
            ->leftJoin('memcompfiledtls_tbl', 'FIND_IN_SET(memcompfiledtls_pk, jdth_task_filepath)')
            ->Where(['jdth_jdomoduledtl_fk' => $dataPk, 'jdth_isdeleted' => 2]);
        $model->orderBy('jdotaskhdr_pk DESC');
        $model->groupBy('jdotaskhdr_pk');
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
                'taskid' => $data['jdotaskhdr_pk'],
                'allTime' => $data['jdth_notifyallday'] == 1,
                'isArchived' => $data['jdth_status'] == 2 || $data['jdth_status'] == 3,
                'archiveStatus' => $data['task_status'],
                'notifytime' => $data['jdth_notifybefore'],
                'selectedfilesPK' => explode(',', $data['jdth_task_filepath']),
                'date' => $data['jdth_taskdate'],
                'time' => $data['jdth_tasktime'],
                'timezone' => $data['jdth_task_timezone_fk'],
                'timezoneOffset' => $data['tz_utcoffset'],
                'title' => $data['jdth_tasktitle'],
                'description' => $data['jdth_taskdesc'],
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
       
        try{
            if($data){
                if(is_array($data['taskpk'])){
                    if($data['isDeleted']) {
                        $status = JdotaskhdrTbl::updateAll([
                            'jdth_isdeleted' => 1],
                            ['in', 'jdotaskhdr_pk', $data['taskpk']
                        ]);
                    } else {
                        $status = JdotaskhdrTbl::updateAll([
                            'jdth_status' => $data['status']],
                            ['in', 'jdotaskhdr_pk', $data['taskpk']
                        ]);
                    }

                } else {
                    if($data['isDeleted']) {
                        $model = JdotaskhdrTbl::findOne($data['taskpk']);
                        $model->jdth_isdeleted = 1;
                        $status = $model->save();
                    } else {
                        $model = JdotaskhdrTbl::findOne($data['taskpk']);
                        $model->jdth_status = $data['status'];
                        $status = $model->save();                        
                    }
                }
            
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Task status updated Successfully!'
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

}