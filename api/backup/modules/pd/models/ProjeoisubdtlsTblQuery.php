<?php

namespace api\modules\pd\models;
use common\components\Security;
use \common\models\UsermstTbl;

/**
 * This is the ActiveQuery class for [[ProjeoisubdtlsTbl]].
 *
 * @see ProjeoisubdtlsTbl
 */
class ProjeoisubdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjeoisubdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjeoisubdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function eoisubmit($data){
        $eoisubmitvalue=$data['submiteoi'];
        if(empty($eoisubmitvalue['eoipk']))
        {
        $projeoisubmodels=new ProjeoisubdtlsTbl();
        $projeoisubmodels->presd_projectdtls_fk=Security::sanitizeInput($eoisubmitvalue['projectpk'],'number');
        $projeoisubmodels->presd_projshortlist_fk=Security::sanitizeInput($eoisubmitvalue['shortpk'],'number');;
        $projeoisubmodels->presd_eoisubmittedon=date('Y-m-d');
        $projeoisubmodels->presd_eoiacknow=Security::sanitizeInput($eoisubmitvalue['eoicommentes'],'string');
        $projeoisubmodels->presd_eoisubmittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $projeoisubmodels->presd_eoisubmittedbyipaddr=\common\components\Common::getIpAddress();
        $projeoisubmodels->presd_status=1;
        }else{
        $projeoisubmodels= ProjeoisubdtlsTbl::find()->where("projeoisubdtls_pk=:eoipk",[':eoipk'=>$eoisubmitvalue['eoipk']])->one();
        $projeoisubmodels->presd_projectdtls_fk=Security::sanitizeInput($eoisubmitvalue['projectpk'],'number');
        $projeoisubmodels->presd_projshortlist_fk=Security::sanitizeInput($eoisubmitvalue['shortpk'],'number');
        $projeoisubmodels->presd_eoiacknow=Security::sanitizeInput($eoisubmitvalue['eoicommentes'],'string');
        $projeoisubmodels->presd_resubmittedon=date('Y-m-d');
        $projeoisubmodels->presd_resubmittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $projeoisubmodels->presd_resubmittedbyipaddr=\common\components\Common::getIpAddress();
        $projeoisubmodels->presd_status=4;    
        }
        $projeoisubmodels->save();
        return $projeoisubmodels;
        
    }
    
    public function withdraweoi($data){
//       echo "<pre>";print_r($data['eoipk']);exit;
        $projeoisubmodels= ProjeoisubdtlsTbl::find()->where("projeoisubdtls_pk=:eoipk",[':eoipk'=>$data['eoipk']])->one();
        if(!empty($projeoisubmodels)){
        $projeoisubmodels->presd_status=5;
        $projeoisubmodels->save();
        }
        return $projeoisubmodels;
    }
    public function validateeoi($data){
        $projeoisubmodels= ProjeoisubdtlsTbl::find()->where("projeoisubdtls_pk=:eoipk",[':eoipk'=>$data['eoipk']])->one();
        if(!empty($projeoisubmodels)){
        $projeoisubmodels->presd_status=Security::sanitizeInput($data['stat'], "number");
        if($data['stat'] == 3){
            $projeoisubmodels->presd_comments=Security::sanitizeInput($data['deccomment'], "string");
        }  else {
            $projeoisubmodels->presd_comments=Security::sanitizeInput($data['apprvcomment'], "string");
        }
        $projeoisubmodels->presd_appdeclon = date('Y-m-d H:i:s');
        $projeoisubmodels->presd_appdeclby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $projeoisubmodels->presd_appdeclbyipaddr =\common\components\Common::getIpAddress();
      if ($projeoisubmodels->save() === false) {
          $result=array(
              'status' => 404,
              'statusmsg' => 'warning',
              'flag'=>'E',
              'msg'=>'Something went wrong'
          );
      }  else {
          $model = UsermstTbl::find()
                    ->select(['UM_EmpName'])
                    ->where("UserMst_Pk=:pk",[':pk'=>$projeoisubmodels->presd_appdeclby])
                    ->asArray()->one();
            $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'projownername'=>$model['UM_EmpName'],
                    'valdate'=>$projeoisubmodels->presd_appdeclon,
                    'msg'=>'EOI validated successfully!',
                    'returndata' => $projeoisubmodels
                );
      }
            return json_encode($result);
    }
    }
}
