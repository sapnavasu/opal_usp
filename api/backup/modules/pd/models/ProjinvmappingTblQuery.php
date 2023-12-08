<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjinvmappingTbl]].
 *
 * @see ProjinvmappingTbl
 */
class ProjinvmappingTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvmappingTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappingTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addInviteInvestors($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        
        $inviteInvArray = $data['listinv'];
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');        
        $userPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('user_pk',true), "number");
        $regPk = Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('reg_pk',true), "number");
        $inviteInvPk = [];
        foreach ($inviteInvArray as $key => $inviteInvData){
            $model = ProjinvmappingTbl::find()->where('projinvmapping_pk=:projinvmapping_pk',[':projinvmapping_pk'=> $inviteInvData['investorid']])->one(); 
            $model->pim_updatedon= $date;
            $model->pim_updatedby= $userPk;
            $model->pim_updatedbyipaddr= $ip_address;
            $model->pim_order= Security::sanitizeInput($key, "number");
            $model->pim_name= Security::sanitizeInput($inviteInvData['name'], "string");
            $model->pim_status=Security::sanitizeInput(1,'number');
            $model->pim_emailid= $inviteInvData['emailid'];
            $model->pim_projectdtls_fk= $projectPk;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            } else {
                $inviteInvPk[] = $model->projinvmapping_pk;
            }
        }
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Invite Investors Add / Updated successfully!',
            'returndata' => $inviteInvPk,
        );        
        return json_encode($result);
    }
    public function updateinvestor($data){
        $inmodel = ProjinvmappingTbl::find()
                ->where('pim_emailid=:email',array(':email'=>$data['updateinvestor']['pim_emailid']))
                ->andWhere('projinvmapping_pk<>:pk',array(':pk' =>  Security::sanitizeInput($data['investorpk'],"number")))
                ->one();
        if(empty($inmodel)){      
        $model = ProjinvmappingTbl::find()
        ->where('projinvmapping_pk=:pk',array(':pk' =>  $data['investorpk']))
        ->one();
        if($model){
        $model->pim_name = Security::sanitizeInput($data['updateinvestor']['pim_name'],"string");
        $model->pim_emailid = $data['updateinvestor']['pim_emailid'];
        $model->pim_updatedon = date('Y-m-d H:i:s');
        $model->pim_updatedby =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model->pim_updatedbyipaddr = \common\components\Common::getIpAddress();
        }
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',

            );
        }  else {
            $data1['name']=$model->pim_name;
            $data1['investorid']=$model->projinvmapping_pk;
            $data1['emailid']=$model->pim_emailid;
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$data1,
            'msg'=>'Project investor updated successfully!',
            'returndata' => $model,
        );
        }}else{
            $data1['name']=$model->pim_name;
            $data1['investorid']=$model->projinvmapping_pk;
            $data1['emailid']=$model->pim_emailid;
             $result=array(
                'status' => 200,
                'data'=>$data1,
                'statusmsg' => 'dup',
                'flag'=>'F',
                'msg'=>'duplicate'
            );
        }
        return json_encode($result);
    }

    public function investorbyid($pk)
    {
      $model = ProjinvmappingTbl::find()
                ->select(['*'])
                ->where('projinvmapping_pk=:pk',array(':pk' => Security::sanitizeInput($pk,"number")))
                ->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'alert',
                'flag'=>'A',
                'msg'=>'No record found!'
            );
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $model
            );
        }
        return json_encode($result);
    }
    public function getinvlistedit($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
      $model = ProjinvmappingTbl::find()
                ->select(['*'])
                ->where('pim_projectdtls_fk=:pk',array(':pk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        $investor=[];
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'alert',
                'flag'=>'A',
                'msg'=>'No record found!'
            );
        }else{
        foreach ($model as $key => $value) {
            $investor[$key]['name']=$value['pim_name'];
            $investor[$key]['investorid']=$value['projinvmapping_pk'];
            $investor[$key]['emailid']=$value['pim_emailid'];
        }
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $investor
            );
        }
        return json_encode($result);
    }
}
