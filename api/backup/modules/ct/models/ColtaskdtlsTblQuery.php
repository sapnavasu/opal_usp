<?php

namespace api\modules\ct\models;
use Exception;

/**
 * This is the ActiveQuery class for [[ColtaskdtlsTbl]].
 *
 * @see ColtaskdtlsTbl
 */
class ColtaskdtlsTblQuery extends \yii\db\ActiveQuery {

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
                if(is_array($data['formData']['taskpk'])){
                    $status = ColtaskdtlsTbl::updateAll([
                        'ctd_status' => $data['formData']['status']],
                        ['in', 'coltaskdtls_pk', $data['formData']['taskpk']
                    ]);

                } else {
                    $model = ColtaskdtlsTbl::find()->where("coltaskdtls_pk=:pk", [':pk' => $data['formData']['taskpk']])->one();
                    $model->ctd_status = $data['formData']['status'];
                    $status = $model->save();
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