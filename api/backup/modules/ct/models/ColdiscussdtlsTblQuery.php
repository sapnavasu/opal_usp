<?php

namespace api\modules\ct\models;

/**
 * This is the ActiveQuery class for [[ColdiscussdtlsTbl]].
 *
 * @see ColdiscussdtlsTbl
 */
class ColdiscussdtlsTblQuery extends \yii\db\ActiveQuery {

    /*
    * Update discussion Title
    *
    */
    public function editMessage($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
       
        if($data){
            $model = ColdiscussdtlsTbl::find()->where("coldiscussdtls_pk =:pk", [':pk' => $data['formData']['messagepk']])->one();

            if($model){
                $model->cdd_replymessage = $data['formData']['message'];
                $model->cdd_replypath = $data['formData']['filepk'];

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Message Updated Successfully!'
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
    * delete discussion Title
    *
    */
    public function deleteMessage($messagepk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
       
        if($messagepk){
            $model = ColdiscussdtlsTbl::find()->where("coldiscussdtls_pk =:pk", [':pk' => $messagepk])->one();
            
            if($model){
                $model->cdd_isread = 2;
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Message deleted Successfully!'
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

}