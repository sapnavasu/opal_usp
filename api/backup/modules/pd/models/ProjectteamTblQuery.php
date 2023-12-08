<?php

namespace api\modules\pd\models;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;
use common\components\Common;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjectteamTbl]].
 *
 * @see ProjectteamTbl
 */
class ProjectteamTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectteamTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectteamTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function editprojectteam($data){
        $model = ProjectteamTbl::find()
        ->select('pt_index as id,pt_role as role,pt_bio as bio,pt_usermst_fk as user')
        ->where('pt_projectdtls_fk=:fk',array(':fk' =>  $data['projectpk']))
        ->andWhere('pt_status=:status',array(':status' => 1))
        ->asArray()->all();
        if($model){
            return $model;
        } else {
            return "";
        }
    }


    public function addprojectteam($data){
        // echo"<pre>";
        // print_r($data);exit;
        $date = date('Y-m-d H:i:s');
        $user_pk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $ip = \common\components\Common::getIpAddress();
        $i= 1 ;
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project saved successfully!',
            'returndata' => $model
        );
        if($data['projectteam']){
            foreach($data['projectteam'] as $obj) {
                $model = new ProjectteamTbl();
                $model->pt_projectdtls_fk = Security::decrypt($data['projectpk']);
                $model->pt_usermst_fk =  Security::sanitizeInput($obj['user'],"string");
                $model->pt_role = Security::sanitizeInput($obj['role'],"string");
                $model->pt_bio = Security::sanitizeInput($obj['bio'],"string");
                $model->pt_status = 1;
                $model->pt_createdon = $date;
                $model->pt_createdby = $user_pk;
                $model->pt_createdbyipaddr = $ip;
                $model->pt_index = $i;
                $i++;
                if ($model->save() === false) {
                    $result=array(
                        'status' => 404,
                        'statusmsg' => 'warning',
                        'flag'=>'E',
                        'msg'=>'Something went wrong'
                    );
                }
                
            }
            return json_encode($result);
        }
        if($data['updateprojectteam']){
            $fk = $data['projectpk'];
            $model = ProjectteamTbl::find()
            ->where('pt_projectdtls_fk=:fk',array(':fk' => $fk))
            ->asArray()->all();
                // echo "<pre>";exit;
            $arr1 = [];
            $arr2 = [];
                foreach($model as $mod) {
                    array_push($arr1,$mod['pt_index']);
                }
                foreach($data['updateprojectteam'] as $obj){
                    array_push($arr2,$obj['id']);
                }
                $add=array_diff($arr2,$arr1);
                $rem=array_diff($arr1,$arr2);
                // $x=[];$y=[];$z=[];
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project updated successfully!',
                    'returndata' => $model
                );
                $i=1;
                
                foreach($data['updateprojectteam'] as $obj) {
                    //add
                    if (in_array($obj['id'], $add)){
                        // array_push($x,$obj['id']);
                        $model_add = new ProjectteamTbl();
                        $model_add->pt_projectdtls_fk = $data['projectpk'];
                        $model_add->pt_usermst_fk = $obj['user'];
                        $model_add->pt_role = $obj['role'];
                        $model_add->pt_bio = $obj['bio'];
                        $model_add->pt_status = 1;
                        $model_add->pt_createdon = $date;
                        $model_add->pt_createdby = $user_pk;
                        $model_add->pt_createdbyipaddr = $ip;
                        $model_add->pt_index = $obj['id'];
                        // $model_add->pt_index = $i;
                        if ($model_add->save() === false) {
                            $result=array(
                                'status' => 404,
                                'statusmsg' => 'warning',
                                'flag'=>'E',
                                'msg'=>'Something went wrong'
                            );
                        }

                    }
                    
                    //update
                    else{
                        // array_push($y,$obj['id']);
                        $model_up = ProjectteamTbl::find()
                        ->where('pt_projectdtls_fk=:fk',array(':fk' => $data['projectpk']))
                        ->andWhere('pt_index=:index',array(':index' => $obj['id']))
                        ->one();
                        if($model_up){
                        $model_up->pt_usermst_fk = $obj['user'];
                        $model_up->pt_role = $obj['role'];
                        $model_up->pt_bio = $obj['bio'];
                        $model_up->pt_status = 1;
                        $model_up->pt_index = $obj['id'];
                        // $model_up->pt_index = $i;
                        $model_up->pt_updatedon = $date;
                        $model_up->pt_updatedby = $user_pk;
                        $model_up->pt_updatedbyipaddr =  $ip;
                        if ($model_up->save() === false) {
                            $result=array(
                                'status' => 404,
                                'statusmsg' => 'warning',
                                'flag'=>'E',
                                'msg'=>'Something went wrong',
                                'dev'=>$model_up->getErrors()
                            );
                        }
                    }
                    }
                    $i++;
                }
                foreach($rem as $r){
                    $model_del = ProjectteamTbl::find()
                    ->where('pt_projectdtls_fk=:fk',array(':fk' =>  $data['projectpk']))
                    ->andWhere('pt_index=:index',array(':index' => $r))
                    ->one();
                    if($model_del){
                    $model_del->pt_deletedon = $date;
                    $model_del->pt_deletedby = $user_pk;
                    $model_del->pt_deletedbyipaddr = $ip;
                    $model_del->pt_status = 2;
                    if ($model_del->save() === false) {
                        $result=array(
                            'status' => 404,
                            'statusmsg' => 'warning',
                            'flag'=>'E',
                            'msg'=>'Something went wrong'
                        );
                    }
                }
            }
                return json_encode($result);
                // <====== deeveloper console debug ====>
                // print_r("<pre>");
                // print_r($arr1);
                // print_r($arr2);
                // print_r("===========");
                // print_r($add);
                // print_r($rem);
                // print_r("===========");
                // print_r("add");
                // print_r($x);
                // print_r("remove");
                // print_r($rem);
                // print_r("update");
                // print_r($y);
                // exit;
        }
    }
}