<?php

namespace api\modules\ct\models;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[ColuserpreferenceTbl]].
 *
 * @see ColuserpreferenceTbl
 */
class ColuserpreferenceTblQuery extends \yii\db\ActiveQuery {

    /*
    * Mute Notification
    */
    public function saveUserPreferences($data){
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

        $userPref = ColuserpreferenceTbl::find()->where(['cup_usermst_fk' => $sharedFk, 'cup_shared_type' => $sharedType, 'cup_category' => $category])->one();

        if(!$userPref){
            $userPref = new ColuserpreferenceTbl();
        }
       
        $userPref->cup_usermst_fk = Security::sanitizeInput($userPK, "number");
        $userPref->cup_shared_type = $sharedFk;
        $userPref->cup_shared_fk = $sharedType;
        $userPref->cup_category = $category;
        $userPref->cup_status = $status;
        $userPref->cup_updatedfrom = $updatedfrom;
        
        if($userPref->save() ==  TRUE){
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => 'Preferences saved successfully!'
            );
        }
        
        return $result;
    }
}