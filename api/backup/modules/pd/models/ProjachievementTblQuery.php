<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjachievementTbl]].
 *
 * @see ProjachievementTbl
 */
class ProjachievementTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjachievementTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjachievementTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addAchievement($data,$projectPk){        
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $achievementPk = [];
        foreach ($data as $key => $achievementData){
            if(empty($achievementData['projachievement_pk'])){
                $model = new ProjachievementTbl();
                $model->pachv_createdon= $date;
                $model->pachv_createdby= $userPk;
                $model->pachv_createdbyipaddr= $ip_address;
                $model->pachv_projectdtls_fk= $projectPk;
            }  else {
                $model = ProjachievementTbl::find()->where('projachievement_pk=:projachievement_pk',[':projachievement_pk'=> $achievementData['projachievement_pk']])->one(); 
                $model->pachv_updatedon= $date;
                $model->pachv_updatedby= $userPk;
                $model->pachv_updatedbyipaddr= $ip_address;
            }
            $model->pachv_title= Security::sanitizeInput($achievementData['pachv_title'], "string");
            $model->pachv_filemst_fk= Security::sanitizeInput($achievementData['pachv_filemst_fk'], "string");
            $model->pachv_year= Security::isDateValid($achievementData['pachv_year'], "Y");
            $model->pachv_description= Security::sanitizeInput($achievementData['pachv_description'], "string");
            $model->pachv_index= Security::sanitizeInput($key, "number");
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model
                );
                return json_encode($result);
            }  else {
                $achievementPk[] = $model->projachievement_pk;
            }
        }
        return $achievementPk;
    }
}
