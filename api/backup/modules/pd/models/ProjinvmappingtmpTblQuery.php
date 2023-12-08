<?php

namespace api\modules\pd\models;
use common\components\Security;
use common\components\Common;

/**
 * This is the ActiveQuery class for [[ProjinvmappingtmpTbl]].
 *
 * @see ProjinvmappingtmpTbl
 */
class ProjinvmappingtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvmappingtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvmappingtmpTbl|array|null
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
            $model = ProjinvmappingtmpTbl::find()->where('projinvmappingtmp_pk=:projinvmapping_pk',[':projinvmapping_pk'=> $inviteInvData['investorid']])->one(); 
            $model->pimt_updatedon= $date;
            $model->pimt_updatedby= $userPk;
            $model->pimt_updatedbyipaddr= $ip_address;
            $model->pimt_order= Security::sanitizeInput($key, "number");
            $model->pimt_name= Security::sanitizeInput($inviteInvData['name'], "string");
            $model->pimt_status=Security::sanitizeInput(1,'number');
            $model->pimt_emailid= $inviteInvData['emailid'];
            $model->pimt_projecttmp_fk= $projectPk;
            if ($model->save() === false) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            } else {
                $inviteInvPk[] = $model->projinvmappingtmp_pk;
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
    
    public function investorbyid($pk)
    {
      $model = ProjinvmappingtmpTbl::find()
                ->select(['*'])
                ->where('projinvmappingtmp_pk=:pk',array(':pk' => Security::sanitizeInput($pk,"number")))
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
    
     public function updateinvestor($data){
        $inmodel = ProjinvmappingtmpTbl::find()
                ->where('pimt_emailid=:email',array(':email'=>$data['updateinvestor']['pimt_emailid']))
                ->andWhere('projinvmappingtmp_pk<>:pk',array(':pk' =>  Security::sanitizeInput($data['investorpk'],"number")))
                ->one();
        if(empty($inmodel)){      
        $model = ProjinvmappingtmpTbl::find()
        ->where('projinvmappingtmp_pk=:pk',array(':pk' =>  $data['investorpk']))
        ->one();
        if($model){
        $model->pimt_name = Security::sanitizeInput($data['updateinvestor']['pimt_name'],"string");
        $model->pimt_emailid = $data['updateinvestor']['pimt_emailid'];
        $model->pimt_updatedon = date('Y-m-d H:i:s');
        $model->pimt_updatedby =  \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model->pimt_updatedbyipaddr = \common\components\Common::getIpAddress();
        }
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',

            );
        }  else {
            $data1['name']=$model->pimt_name;
            $data1['investorid']=$model->projinvmappingtmp_pk;
            $data1['emailid']=$model->pimt_emailid;
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$data1,
            'msg'=>'Project investor updated successfully!',
            'returndata' => $model,
        );
        }}else{
            $data1['name']=$model->pimt_name;
            $data1['investorid']=$model->projinvmappingtmp_pk;
            $data1['emailid']=$model->pimt_emailid;
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
    
    public function getinvlistedit($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
      $model = ProjinvmappingtmpTbl::find()
                ->select(['*'])
                ->where('pimt_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($projectPk,"number")))
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
            $investor[$key]['name']=$value['pimt_name'];
            $investor[$key]['investorid']=$value['projinvmappingtmp_pk'];
            $investor[$key]['emailid']=$value['pimt_emailid'];
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
