<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[AccessreportdtlsTbl]].
 *
 * @see AccessreportdtlsTbl
 */
class AccessreportdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AccessreportdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AccessreportdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
     public function getOBGReport() {
        $comPk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model = AccessreportdtlsTbl::find()
                ->select(['ard_publicationtype', 'accessreportdtls_pk', 'ard_createdon', 'ard_createdby'])
                ->where('ard_memcompmst_fk=:comPk', array(':comPk' => $comPk))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model ? $model : null,
        );
        return $result;
    }
    public function accessReport($data) {
        $comPk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $message='Your request to activate the free subscription has been sent to Oxford Business Group. You can access the online reports within 4-5 working days using your JSRS registered email ID.'; 
        $AccessreportdtlsTbl=new AccessreportdtlsTbl();
        $AccessreportdtlsTbl->ard_memcompmst_fk = $comPk;
        $AccessreportdtlsTbl->ard_publicationtype = $data;
        $AccessreportdtlsTbl->ard_createdby = $userPK;
        $AccessreportdtlsTbl->ard_createdon = date('Y-m-d H:i:s');
        if($AccessreportdtlsTbl->save()){
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => $message,
            );
        }  else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
                'returndata' => $AccessreportdtlsTbl->getErrors()
            );
        }
        return $result;
    }
}
