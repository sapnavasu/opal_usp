<?php

namespace api\modules\ct\models;

use Exception;

/**
 * This is the ActiveQuery class for [[ColdiscusshdrTbl]].
 *
 * @see ColdiscusshdrTbl
 */
class ColdiscusshdrTblQuery extends \yii\db\ActiveQuery {

    /*
    * Update discussion Title
    *
    */
    public function updateTitle($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data){
            $model = ColdiscusshdrTbl::find()->where("coldiscusshdr_pk =:pk", [':pk' => $data['formData']['discussionpk']])->one();
            
            if($model){
                $model->cdh_title = $data['formData']['title'];
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Topic Updated Successfully!'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
        return $result;
    }

     /*
    * Update discussion Title
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
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            try{
                $ids = $data['formData']['discussionpk'];
                ColdiscusshdrTbl::updateAll([
                    'cdh_status' => $data['formData']['status']
                ], ['in', 'coldiscusshdr_pk', $ids]);

                $discussion = ColdiscusshdrTbl::find()->where(['in', 'coldiscusshdr_pk', $ids])->one();
              
                $msg = "Status changed to Active";
                if($data['formData']['status'] == 2){
                    if($userPK)
                    $msg = "Status changed to Archive";
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => $msg
                );

            } catch(\Exception $e){
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                );
            }
        }
        return $result;
    }


}
