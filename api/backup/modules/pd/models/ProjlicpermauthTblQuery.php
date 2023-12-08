<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjlicpermauthTbl]].
 *
 * @see ProjlicpermauthTbl
 */
class ProjlicpermauthTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjlicpermauthTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjlicpermauthTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addLicPermitAuth($licensauthoritiesmst_fk,$projlicpermauth_pk,$projecdtlsPk){
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        if(empty($projlicpermauth_pk)){
            $model = new ProjlicpermauthTbl();
            $model->plpa_createdon= $date;
            $model->plpa_createdby= $userPk;
            $model->plpa_createdbyipaddr= $ip_address;
            $model->plpa_projectdtls_fk= $projecdtlsPk;
        }  else {
            $model = ProjaccreditationTbl::find()->where('projaccreditation_pk=:projaccreditation_pk',[':projaccreditation_pk'=> $accreditationData['projaccreditation_pk']])->one(); 
            $model->plpa_updatedon= $date;
            $model->plpa_updatedby= $userPk;
            $model->plpa_updatedbyipaddr= $ip_address;
        }
            $model->plpa_licensauthoritiesmst_fk= $licensauthoritiesmst_fk;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
                return json_encode($result);
            }
    }
    public function authorities($projecdtlsPk)
    {
      
        $model = ProjlicpermauthTbl::find()
                ->select('group_concat(lam_licenseauthname_en) as licAuthDtls')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=plpa_licensauthoritiesmst_fk')
                ->where('plpa_projectdtls_fk=:fk',array(':fk'=> Security::sanitizeInput($projecdtlsPk,"number")))->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'returndata' => $model
            );
        }
        return json_encode($result);
    }
}
