<?php

namespace api\modules\ct\models;

use Exception;

/**
 * This is the ActiveQuery class for [[ColprojaudienceTbl]].
 *
 * @see ColprojaudienceTbl
 */
class ColprojaudienceTblQuery extends \yii\db\ActiveQuery {

    /*
    * Uncollaborate user
    *
    */
    public function updateCardmembers($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        try{
            if($data){
                if(is_array($data['formData']['audiencepk'])){
                    $status = ColprojaudienceTbl::updateAll([
                        'cpa_isdiscussion' => 2],
                        ['and', 
                            ['in', 'colprojaudience_pk', $data['formData']['audiencepk']], 
                            ['cpa_collaborativemst_fk' => $data['formData']['cardpk']]
                        ]
                    );
                
                } else {
                    $model = ColprojaudienceTbl::find()->where("colprojaudience_pk=:pk", [':pk' => $data['formData']['audiencepk']])->andWhere('cpa_collaborativemst_fk=:cpk', [':cpk' => $data['formData']['cardpk']])->one();
                    $model->cpa_isdiscussion = 2;
                    $status = $model->save();
                }

                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Member(s) updated Successfully!'
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

    public function exitCard($cardpk){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $cardMember = ColprojaudienceTbl::find()->where("cpa_collaborativemst_fk=:fk", [':fk' => $cardpk])->andWhere(['cpa_targetusers' => $userPK])->one();

        if(!empty($cardMember)){
            $cardMember->cpa_targetuserstatus = 1;

            if($cardMember->save() ==  TRUE){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Card exited Successfully!'
                );
            }
        }
        return $result;
    }
}
