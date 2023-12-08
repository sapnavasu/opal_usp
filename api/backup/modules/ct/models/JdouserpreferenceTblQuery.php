<?php

namespace api\modules\ct\models;

use Yii;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdouserpreferenceTbl]].
 *
 * @see JdouserpreferenceTbl
 */
class JdouserpreferenceTblQuery extends \yii\db\ActiveQuery {

    /**
     * change card status
     */
    public function changecardstatus($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $jdomoduledtlpk = Security::sanitizeInput($data['dataPk'], "number");
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $moduledtl = JdouserpreferenceTbl::find()
                ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk and jdup_category = :category", [':pk' => $jdomoduledtlpk, ':sharedType' => $data['sharedType'], ':userpk' => $userPK, ':category' => $data['dataType']])
                ->one();

        if (empty($moduledtl)) {
            $moduledtl = new JdouserpreferenceTbl;
            $moduledtl->jdup_usermst_fk = $userPK;
            $moduledtl->jdup_shared_type = $data['sharedType'];
            $moduledtl->jdup_shared_fk = $jdomoduledtlpk;
            $moduledtl->jdup_category = $data['dataType'];
            $moduledtl->jdup_status = 1;
            $moduledtl->jdup_createdon = $date;
            $moduledtl->jdup_createdby = $userPK;
            $moduledtl->jdup_createdbyipaddr = $ip_address;
        } else {
            $moduledtl->jdup_status = $moduledtl->jdup_status == 1 ? 2 : 1;
            $moduledtl->jdup_updatedon = $date;
            $moduledtl->jdup_updatedby = $userPK;
            $moduledtl->jdup_updatedbyipaddr = $ip_address;
        }
        if ($moduledtl->save()) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'Card status changed successfully',
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'error',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $moduledtl->getErrors()
            );
        }
        return $result;
    }

    /**
     * change card status
     */
    public function discussionStatusChange($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $formData = $data['dataArray'];
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        if (count($formData) > 0) {
            foreach ($formData as $key => $value) {
                $moduledtl = JdouserpreferenceTbl::find()
                        ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk and jdup_category = :category", [':pk' => $value['jdodiscusshdr_pk'], ':sharedType' => 2, ':userpk' => $userPK, ':category' => 2])
                        ->one();
                if (empty($moduledtl)) {
                    $moduledtl = new JdouserpreferenceTbl;
                    $moduledtl->jdup_usermst_fk = $userPK;
                    $moduledtl->jdup_shared_type = 2;
                    $moduledtl->jdup_shared_fk = $value['jdodiscusshdr_pk'];
                    $moduledtl->jdup_category = 2;
                    $moduledtl->jdup_status = 1;
                    $moduledtl->jdup_createdon = $date;
                    $moduledtl->jdup_createdby = $userPK;
                    $moduledtl->jdup_createdbyipaddr = $ip_address;
                } else {
                    $moduledtl->jdup_status = $moduledtl->jdup_status == 1 ? 2 : 1;
                    $moduledtl->jdup_updatedon = $date;
                    $moduledtl->jdup_updatedby = $userPK;
                    $moduledtl->jdup_updatedbyipaddr = $ip_address;
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
                    'comments' => 'Card status changed successfully',
                );
            }
        }

        return $result;
    }

    /**
     * change note status
     */
    public function archivednotes($data) {
        try {
            $formData = $data;
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            if (!empty($data['notepk'])) {
                foreach($data['notepk'] as $notepk) {
                    $notePref = JdouserpreferenceTbl::find()
                            ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk", [':pk' => $notepk, ':sharedType' => 4, ':userpk' => $userPK])
                            ->one();
                    if (empty($notePref)) {
                        $notePref = new JdouserpreferenceTbl;
                        $notePref->jdup_usermst_fk = $userPK;
                        $notePref->jdup_shared_type = 4;
                        $notePref->jdup_shared_fk = $notepk;
                        $notePref->jdup_category = $data['category'];
                        $notePref->jdup_status = $data['status'];
                        $notePref->jdup_createdon = $date;
                        $notePref->jdup_createdby = $userPK;
                        $notePref->jdup_createdbyipaddr = $ip_address;
                    } else {
                        $notePref->jdup_status = $data['status'];
                        $notePref->jdup_updatedon = $date;
                        $notePref->jdup_category = $data['category'];
                        $notePref->jdup_updatedby = $userPK;
                        $notePref->jdup_updatedbyipaddr = $ip_address;
                    }
                    $status = $notePref->save();
                }
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Note archived successfully',
                );
            }
    
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'No Data',
            );;
        } catch(\Exception $e) {            
            return array(
                'status' => 200,
                'msg' => 'error',
                'flag' => 'E',
                'comments' => 'Something went wrong!'
            );
        }
    }

    /**
     * change meeting status
     */
    public function archivedmeeting($data) {
        try {
            $formData = $data;
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            if (!empty($data['meetingpk'])) {
                foreach($data['meetingpk'] as $meetingpk) {
                    $meetingPref = JdouserpreferenceTbl::find()
                            ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk", [':pk' => $meetingpk, ':sharedType' => 5, ':userpk' => $userPK])
                            ->one();
                    if (empty($meetingPref)) {
                        $meetingPref = new JdouserpreferenceTbl;
                        $meetingPref->jdup_usermst_fk = $userPK;
                        $meetingPref->jdup_shared_type = 5;
                        $meetingPref->jdup_shared_fk = $meetingpk;
                        $meetingPref->jdup_category = $data['category'];
                        $meetingPref->jdup_status = $data['status'];
                        $meetingPref->jdup_createdon = $date;
                        $meetingPref->jdup_createdby = $userPK;
                        $meetingPref->jdup_createdbyipaddr = $ip_address;
                    } else {
                        $meetingPref->jdup_status = $data['status'];
                        $meetingPref->jdup_updatedon = $date;
                        $meetingPref->jdup_category = $data['category'];
                        $meetingPref->jdup_updatedby = $userPK;
                        $meetingPref->jdup_updatedbyipaddr = $ip_address;
                    }
                    $status = $meetingPref->save();
                }
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Meeting archived successfully',
                );
            }
    
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'No Data',
            );;
        } catch(\Exception $e) {            
            return array(
                'status' => 200,
                'msg' => 'error',
                'flag' => 'E',
                'comments' => 'Something went wrong!'
            );
        }
    }

    /**
     * change note status
     */
    public function userprefnotes($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        $formData = $data;
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        if (!empty($data['notepk'])) {
            $notePref = JdouserpreferenceTbl::find()
                    ->where("jdup_shared_fk=:pk and jdup_shared_type = :sharedType and jdup_usermst_fk = :userpk", [':pk' => $data['notepk'], ':sharedType' => 4, ':userpk' => $userPK])
                    ->one();
            if (empty($notePref)) {
                $notePref = new JdouserpreferenceTbl;
                $notePref->jdup_usermst_fk = $userPK;
                $notePref->jdup_shared_type = 4;
                $notePref->jdup_shared_fk = $data['notepk'];
                $notePref->jdup_category = $data['category'];
                $notePref->jdup_status = $data['status'];
                $notePref->jdup_createdon = $date;
                $notePref->jdup_createdby = $userPK;
                $notePref->jdup_createdbyipaddr = $ip_address;
            } else {
                $notePref->jdup_status = $data['status'];
                $notePref->jdup_updatedon = $date;
                $notePref->jdup_category = $data['category'];
                $notePref->jdup_updatedby = $userPK;
                $notePref->jdup_updatedbyipaddr = $ip_address;
            }
            if (!$notePref->save()) {
                $result = array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $notePref->getErrors()
                );
                return $result;
            }
            if($data['category'] == 3 && $data['status'] == 1) {
                $comment = 'Note pinned successfully';
            } elseif($data['category'] == 3 && $data['status'] == 2) {
                $comment = 'Note unpinned successfully';
            } elseif($data['category'] == 2 && $data['status'] == 1) {
                $comment = 'Note archived successfully';
            } elseif($data['category'] == 2 && $data['status'] == 2) {
                $comment = 'Note move to my note successfully';
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => $comment,
            );
        }

        return $result;
    }

    /*
     * Saev user Notification
     */

    public function saveUserPreferences($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $sharedFk = Security::sanitizeInput($data['formData']['sharedfk'], "number");
        $sharedType = Security::sanitizeInput($data['formData']['shared_type'], "number");
        $category = Security::sanitizeInput($data['formData']['category'], "number");
        $status = Security::sanitizeInput($data['formData']['status'], "number");
        $updatedfrom = Security::sanitizeInput($data['formData']['updatedfrom'], "number");

        $userPref = JdouserpreferenceTbl::find()->where(['jdup_usermst_fk' => $sharedFk, 'jdup_shared_type' => $sharedType, 'jdup_category' => $category])->one();

        if (!$userPref) {
            $userPref = new JdouserpreferenceTbl();
        }

        $userPref->jdup_usermst_fk = Security::sanitizeInput($userPK, "number");
        $userPref->jdup_shared_type = $sharedFk;
        $userPref->jdup_shared_fk = $sharedType;
        $userPref->jdup_category = $category;
        $userPref->jdup_status = $status;
        $userPref->jdup_updatedfrom = $updatedfrom;

        if ($userPref->save() == TRUE) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'Preferences saved successfully!',
                'moduledata' => $userPref
            );
        }

        return $result;
    }

}
