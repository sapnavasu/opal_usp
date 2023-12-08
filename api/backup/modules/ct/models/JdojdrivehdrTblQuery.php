<?php

namespace api\modules\ct\models;

use Yii;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[JdojdrivehdrTbl]].
 *
 * @see JdouserpreferenceTbl
 */
class JdojdrivehdrTblQuery extends \yii\db\ActiveQuery {
    /**
     * Seen document
     */
    public function seendocument($data) {
        if (!empty($data['filePk'])) {
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');

            $jdrive = JdojdrivehdrTbl::find()
                    ->where([
                        'jdjdh_jdotargetmember_fk' => $data['targatMemberPk'],
                        'jdjdh_shared_type' => $data['type'],
                        'jdjdh_shared_fk' => $data['mainPk'],
                        'jdjdh_filepath' => $data['filePk'],
                    ])
                    ->one();
            if($jdrive) {
                $jdrive->jdjdh_updatedon = $date;
                $jdrive->jdjdh_updatedby = $userPK;
                $jdrive->jdjdh_updatedbyipaddr = $ip;
            } else {
                $jdrive = new JdojdrivehdrTbl;
                $jdrive->jdjdh_jdotargetmember_fk = $data['targatMemberPk'];
                $jdrive->jdjdh_shared_type = $data['type'];
                $jdrive->jdjdh_shared_fk = $data['mainPk'];
                $jdrive->jdjdh_filepath = $data['filePk'];
                $jdrive->jdjdh_createdon = $date;
                $jdrive->jdjdh_createdby = $userPK;
                $jdrive->jdjdh_createdbyipaddr = $ip;
            }
            $jdrive->jdjdh_isviewed = $data['status'];
            $jdrive->jdjdh_lastviewedon = $date;
            $jdrive->jdjdh_isdeleted = $data['isRemoved'] ?: 2;

            if (!$jdrive->save()) {
                return array(
                    'status' => 200,
                    'msg' => 'error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $notePref->getErrors()
                );
            }

            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'File seen successfully',
            );
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }
}
