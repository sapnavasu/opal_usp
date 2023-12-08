<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjaccreditationTbl]].
 *
 * @see ProjaccreditationTbl
 */
class ProjaccreditationTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjaccreditationTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccreditationTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addAccreditation($data,$projectPk){        
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $accreditationPk = [];
        foreach ($data as $key => $accreditationData){
            if(empty($accreditationData['projaccreditation_pk'])){
                $model = new ProjaccreditationTbl();
                $model->pacr_createdon= $date;
                $model->pacr_createdby= $userPk;
                $model->pacr_createdbyipaddr= $ip_address;
                $model->pacr_projectdtls_fk= $projectPk;
            }  else {
                $model = ProjaccreditationTbl::find()->where('projaccreditation_pk=:projaccreditation_pk',[':projaccreditation_pk'=> $accreditationData['projaccreditation_pk']])->one(); 
                $model->pacr_updatedon= $date;
                $model->pacr_updatedby= $userPk;
                $model->pacr_updatedbyipaddr= $ip_address;
            }
            $model->pacr_accreditationname= Security::sanitizeInput($accreditationData['pacr_accreditationname'], "string");
            $model->pacr_governingbody= Security::sanitizeInput($accreditationData['pacr_governingbody'], "string");
            $model->pacr_regno= Security::sanitizeInput($accreditationData['pacr_regno'], "string");
            $model->pacr_regdate= Security::isDateValid($accreditationData['pacr_regdate'], "Y-m-d");
            $model->pacr_index= Security::sanitizeInput($key, "number");
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
                return json_encode($result);
            } else {
                $accreditationPk[] = $model->projaccreditation_pk;
            }
        }
        return $accreditationPk;
    }
}
