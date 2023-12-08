<?php

namespace api\modules\ct\models;

/**
 * This is the ActiveQuery class for [[ColnotesdtlTbl]].
 *
 * @see ColnotesdtlTbl
 */
class ColnotesdtlTblQuery extends \yii\db\ActiveQuery {

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
            if(is_array($data['formData']['notespk'])){
                $status = ColnotesdtlTbl::updateAll([
                    'cnd_notesstatus' => $data['formData']['status']],
                    ['in', 'colnotesdtl_pk', $data['formData']['notespk']
                ]);

            } else {
                $model = ColnotesdtlTbl::find()->where("colnotesdtl_pk=:pk", [':pk' => $data['formData']['notespk']])->one();
                if($model){
                    $model->cnd_notesstatus = $data['formData']['status'];
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