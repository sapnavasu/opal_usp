<?php

namespace api\modules\ct\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use api\modules\ct\models\ColdiscusshdrTblQuery;
use api\modules\ct\models\ColdiscussdtlsTblQuery;
use api\modules\ct\models\ColtaskdtlsTblQuery;
use api\modules\ct\models\ColnotesdtlTblQuery;
use api\modules\ct\models\CollaborativemstTblQuery;
use api\modules\ct\models\ColprojaudienceTblQuery;
use api\modules\ct\models\ColuserpreferenceTblQuery;
use api\modules\ct\models\JdomodulehdrTblQuery;
use api\modules\ct\models\JdomoduledtlTblQuery;
use api\modules\ct\models\JdouserpreferenceTblQuery;
use api\modules\ct\models\JdotargetmemberTblQuery;
use api\modules\ct\models\JdodiscusshdrTblQuery;
use api\modules\ct\models\JdodiscussmemberTblQuery;
use api\modules\ct\models\JdodiscussdtlTblQuery;
use api\modules\ct\models\JdotaskhdrTblQuery;
use api\modules\ct\models\JdonoteshdrTblQuery;
use api\modules\ct\models\JdonotesmemberTblQuery;
use api\modules\ct\models\JdomeetingskdhdrTblQuery;
use api\modules\ct\models\JdomeetskdmemberTblQuery;
use api\modules\ct\models\JdomeetreskdTblQuery;
use api\modules\ct\models\JdojdrivehdrTblQuery;

class Collaborate{
    public $lang = 'en';

     /**
     * Update discussion title
     */
    public function collaborateCountlisting(){
            return JdomodulehdrTblQuery::collaborateCountlisting();
    }

     /**
     * Update discussion title
     */
    public function addcollaborate($formdata){
        if (!empty($formdata)) {
            return JdomodulehdrTblQuery::addcollaborate($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * card listing
     */
    public function cardlisting($formdata){
        if (!empty($formdata)) {
            return JdomoduledtlTblQuery::cardlisting($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Update discussion title
     */
    public function updateDiscussionTopic($data){
        if (!empty($data)) {
            return ColdiscusshdrTblQuery::updateTopic($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Update discussion status
     */
    public function updateDiscusStatus($data){
        if (!empty($data)) {
            return JdodiscusshdrTblQuery::updateDiscusStatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
        
    }

      /**
     * Add discussion message
     */
    public function adddiscussionmsg($data){
        if (!empty($data)) {
            return JdodiscussdtlTblQuery::adddiscussionmsg($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Update discussion message
     */
    public function editDiscussionmessage($data){
        if (!empty($data)) {
            return JdodiscussdtlTblQuery::editMessage($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
        
    }

     /**
     * delete messagediscussioninfo
     */
    public function deletemessage($messagepk){
        if (!empty($messagepk)) {
            return JdodiscussdtlTblQuery::deleteMessage($messagepk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
        
    }

     /**
     * add memebr to discussion
     */
    public function savediscussionmember($messagepk){
        if (!empty($messagepk)) {
            return JdodiscussmemberTblQuery::savediscussionmember($messagepk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
        
    }

    
      /**
     * Update task status
     */
    public function updatetaskstatus($data){
        if (!empty($data)) {
            return JdotaskhdrTblQuery::changeStatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
        
    }

      /**
     * Update Note status
     */
    public function updatenotestatus($data){
        if (!empty($data)) {
            return JdonoteshdrTblQuery::changeStatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }        
    }

    /**
     * Update Note status
     */
    public function userprefnotes($data){
        if (!empty($data)) {
            return JdouserpreferenceTblQuery::userprefnotes($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }        
    }

    /**
     * Seen File by User
     */
    public function seenfile($data){
        if (!empty($data)) {
            return JdojdrivehdrTblQuery::seendocument($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }        
    }

    /**
     * Archived notes status
     */
    public function archivednotes($data){
        if (!empty($data)) {
            return JdouserpreferenceTblQuery::archivednotes($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }        
    }

    /**
     * Archived meeting status
     */
    public function archivedmeeting($data){
        if (!empty($data)) {
            return JdouserpreferenceTblQuery::archivedmeeting($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }        
    }

    /**
     * get Jdrive List
     */
    public function driveList($collaborativepk){
        if (!empty($collaborativepk)) {
            return CollaborativemstTblQuery::driveList($collaborativepk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * get Jdrive List
     */
    public function getdrivelist($formdata){
        if (!empty($formdata)) {
            return JdomoduledtlTblQuery::driveList($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * get Card detail
     */
    public function cardDetail($cardpk){
        if (!empty($cardpk)) {
            return JdomoduledtlTblQuery::cardDetail($cardpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    /**
     * manage members
     */
    public function manageCardmembers($data){
        if (!empty($data)) {
            return JdotargetmemberTblQuery::manageCardmembers($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
     /**
     * unCollaboratemember card member
     */
    public function updateCardmembers($data){
        if (!empty($data)) {
            return JdotargetmemberTblQuery::updateCardmembers($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * get user detail JDrive
     */
    public function getUserDetail($userpk){
        if (!empty($userpk)) {
            return \common\models\UsermstTblQuery::findById($userpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * exit card
     */
    public function exitCard($cardpk){
        if (!empty($cardpk)) {
            return JdotargetmemberTblQuery::exitCard($cardpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * save user preference
     */
    public function saveUserPreferences($data){
        if (!empty($data)) {
            return JdouserpreferenceTblQuery::saveUserPreferences($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Change card status
     */
    public function changecardstatus($data){
        if (!empty($data)) {
            return JdouserpreferenceTblQuery::changecardstatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    /**
     * Change Accept Invite
     */
    public function acceptInvite($data){
        if (!empty($data)) {
            return JdotargetmemberTblQuery::acceptInvite($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Add team members
     */
    public function addteammember($data) {
        if (!empty($data)) {
            if (count($data['internalInvite']) > 0) {
                if($data['dataOpen'] == 1){
                    if($data['moduleType'] == 1){
                        $internalUser = JdotargetmemberTblQuery::addMember($data['dtlsPk'], 2, $data['internalInvite'], 1);                  
                    } elseif ($data['moduleType'] == 2) {
                        $internalUser = JdodiscussmemberTblQuery::savediscussionmember($data['dtlsPk'], 2, $data['internalInvite']);
                    } elseif ($data['moduleType'] == 3) {
                        $internalUser = JdonotesmemberTblQuery::addNotesMembers($data['dtlsPk'], array_map(function($v) {
                            return $v['jdoTargerPk'];
                        }, $data['internalInvite']));
                    } elseif ($data['moduleType'] == 4) {
                        $internalUser = JdomeetskdmemberTblQuery::addMeetingMembers($data['dtlsPk'], array_map(function($v) {
                            return $v['jdoTargerPk'];
                        }, $data['internalInvite']));
                    }
                } else {
                    if($data['moduleType'] == 1){
                        $internalUser = JdotargetmemberTblQuery::removeMember($data['dtlsPk'],$data['internalInvite']);              
                    } elseif ($data['moduleType'] == 2) {
                        $internalUser = JdodiscussmemberTblQuery::removeMember($data['dtlsPk'], $data['internalInvite']);
                    } elseif ($data['moduleType'] == 3) {
                        $internalUser = JdonotesmemberTblQuery::removeMember($data['dtlsPk'], $data['internalInvite']);
                    } elseif ($data['moduleType'] == 4) {
                        $internalUser = JdomeetskdmemberTblQuery::removeMember($data['dtlsPk'], $data['internalInvite']);
                    }
                }
                if($internalUser['flag'] == 'E'){
                    return $internalUser;
                }
            }
            if (count($data['externalInvite']) > 0) {
                if($data['dataOpen'] == 1){
                    if($data['moduleType'] ==  1){
                        $externalUser = JdotargetmemberTblQuery::addMember($data['dtlsPk'], 2, $data['externalInvite'], 2);       
                    } elseif ($data['moduleType'] == 2) {
                        $externalUser = JdodiscussmemberTblQuery::savediscussionmember($data['dtlsPk'], 2, $data['externalInvite']);
                    } elseif ($data['moduleType'] == 3) {
                        $externalUser = JdonotesmemberTblQuery::saveNotesMembers($data['dtlsPk'], array_map(function($v) {
                            return $v['jdoTargerPk'];
                        }, $data['externalInvite']));
                    } 
                }  else {
                    
                    if($data['moduleType'] ==  1){
                        $externalUser = JdotargetmemberTblQuery::removeMember($data['dtlsPk'],$data['externalInvite']); 
                    } elseif ($data['moduleType'] == 2) {
                        $externalUser = JdodiscussmemberTblQuery::removeMember($data['dtlsPk'], $data['externalInvite']);
                    } elseif ($data['moduleType'] == 3) {
                        $externalUser = JdonotesmemberTblQuery::removeMember($data['dtlsPk'], $data['externalInvite']);
                    }                
                }
                if($externalUser['flag'] == 'E'){
                    return $externalUser;
                }
            }
            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => $data['dataOpen'] == 1 ? 'New User Added Successfully!' : 'User Removed Successfully!',
            );
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * update member status
     */
    public function updateinvitestatus($data){
        if (!empty($data)) {
            return JdotargetmemberTblQuery::updateinvitestatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    
    /**
     * Get Card View Data
     */
    public function getViewCardData($data){
        if (!empty($data)) {
            return JdomoduledtlTblQuery::getViewCardData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    

    /**
     * Discussion update status
     */
    public function discussionStatusChange($data){
        if (!empty($data)) {
            if($data['dataType'] == 2){
                return JdouserpreferenceTblQuery::discussionStatusChange($data);                
            }  else {
                return JdodiscusshdrTblQuery::discussionStatusChange($data);                    
            }
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    
    /**
     * update member status
     */
    public function adddiscussion($data){
        if (!empty($data)) {
            return JdodiscusshdrTblQuery::adddiscussion($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    
    
    /**
     * Discussion listing
     */
    public function discussionlisting($data){
        if (!empty($data)) {
            return JdodiscusshdrTblQuery::discussionlisting($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    

     /**
     * Discussion Info
     */
    public function discussioninfo($data){
        if (!empty($data)) {
            return JdodiscusshdrTblQuery::discussioninfo($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }   

     /**
     * Discussion Info
     */
    public function discussionmsginfo($data){
        if (!empty($data)) {
            return JdodiscussdtlTblQuery::discussionmsginfo($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }  

    /**
     * Discussion Message Info
     */
    public function discussionmsglist($dataPk){
        if (!empty($dataPk)) {
            return JdodiscussdtlTblQuery::discussionmsglist($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }  

     /**
     * Add task
     */
    public function addtask($data){
        if (!empty($data)) {
            return JdotaskhdrTblQuery::addtask($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Task listing
     */
    public function tasklisting($dataPk){
        if (!empty($dataPk)) {
            return JdotaskhdrTblQuery::tasklisting($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

      /**
     * Create Note
     */
    public function addnotes($data){
        if (!empty($data)) {
            return JdonoteshdrTblQuery::addnotes($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Create Note
     */
    public function noteslisting($dataPk){
        if (!empty($dataPk)) {
            return JdonoteshdrTblQuery::noteslisting($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * Delete Note
     */
    public function deletenotes($data){
        if (!empty($data)) {
            return JdonoteshdrTblQuery::deletenotes($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * add meeting
     */
    public function addmeeting($data){
        if (!empty($data)) {
            return JdomeetingskdhdrTblQuery::addmeeting($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * add meeting
     */
    public function reshedulemeeting($data){
        if (!empty($data)) {
            return JdomeetreskdTblQuery::savedetail($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

      /**
     * add meeting
     */
    public function meetinglisting($data){
        if (!empty($data)) {
            return JdomeetingskdhdrTblQuery::meetinglisting($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

     /**
     * meeting Info
     */
    public function getmeetinginfo($data){
        if (!empty($data)) {
            return JdomeetingskdhdrTblQuery::getmeetinginfo($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * meeting Info
     */
    public function updateMemberresponse($data){
        if (!empty($data)) {
            return JdomeetskdmemberTblQuery::updateResponse($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
     /**
     *Reschedule meeting
     */
    public function reschedulemeeting($data){
        if (!empty($data)) {
            return JdomeetingskdhdrTblQuery::reschedulemeeting($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * update Reschdule Response
     */
    public function resmeetresponse($data){
        if (!empty($data)) {
            return \api\modules\ct\models\JdomeetreskdTblQuery::resmeetresponse($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * Reschdule history
     */
    public function reschedulehistory($data){
        if (!empty($data)) {
            return \api\modules\ct\models\JdomeetreskdTblQuery::reschedulehistory($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }    
     /**
     * save user preference
     */
    public function GetInviteList($dataPk,$dataType,$dtlsPK,$addOrRemove,$moduleType){
        if (!empty($dataType)) {
            return \common\models\UsermstTblQuery::GetInviteList($dataPk,$dataType,$dtlsPK,$addOrRemove,$moduleType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function getActiveCompanyList() {
            return \common\models\MemberregistrationmstTbl::getActiveCompanyList();
    }
    public function getMasterModule() {
            return \api\modules\ct\models\JdomodulemstTblQuery::getMasterModule();
    }
}