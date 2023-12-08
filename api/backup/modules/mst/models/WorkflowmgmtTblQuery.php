<?php

namespace api\modules\mst\models;

use Yii;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\mst\models\WorkflowmgmtTbl;
use api\modules\mst\models\MembercompanymstTblQuery;
use common\models\BasemodulemstTbl;
use common\models\StkholdertypmstTbl;
use common\components\Security;


/**
 * This is the ActiveQuery class for [[WorkflowmgmtTbl]].
 *
 * @see WorkflowmgmtTbl
 */
class WorkflowmgmtTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return WorkflowmgmtTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return WorkflowmgmtTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function view($id){
        $query = WorkflowmgmtTbl::find()
        ->select(['UM_EmpName','wfm_allocatedon','shm_stakeholdertype','MCM_CompanyName','wfm_memcompmst_fk','wfm_stkholdtype','wfm_basesubmodule','wfm_basemoduleulemst_fk','super.basemodulemst_pk as superpk','super.bmm_name as supername','sub.basemodulemst_pk as subpk','sub.bmm_name as subname'])
        ->andWhere('workflowmgmt_pk=:pk',array(':pk' =>  $id))
        ->leftJoin('basemodulemst_tbl super','super.basemodulemst_pk=wfm_basemoduleulemst_fk')
        ->leftJoin('basemodulemst_tbl sub','sub.basemodulemst_pk=wfm_basesubmodule')
        ->leftJoin('stkholdertypmst_tbl','stkholdertypmst_pk=wfm_stkholdtype')
        ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk=wfm_memcompmst_fk')
        ->leftJoin('usermst_tbl','UserMst_Pk=wfm_allocatedby')
        ->asArray();
        $provider = new ActiveDataProvider([ 'query' => $query]);
        
        if($provider->getModels()){
            return $provider->getModels();
        } else {
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function history($module,$submodule){
        $query = WorkflowmgmtTbl::find()
        ->select(['UM_EmpName','wfm_allocatedon','MCM_CompanyName','shm_stakeholdertype','super.basemodulemst_pk as superpk','super.bmm_name as supername','sub.basemodulemst_pk as subpk','sub.bmm_name as subname'])
        ->andWhere(['wfm_basemoduleulemst_fk' =>  $module,'wfm_basesubmodule' =>  $submodule])
        ->leftJoin('basemodulemst_tbl super','super.basemodulemst_pk=wfm_basemoduleulemst_fk')
        ->leftJoin('basemodulemst_tbl sub','sub.basemodulemst_pk=wfm_basesubmodule')
        ->leftJoin('stkholdertypmst_tbl','stkholdertypmst_pk=wfm_stkholdtype')
        ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk=wfm_memcompmst_fk')
        ->leftJoin('usermst_tbl','UserMst_Pk=wfm_allocatedby')
        ->orderBy(['wfm_allocatedon' => SORT_ASC])
        ->asArray();
        $provider = new ActiveDataProvider([ 'query' => $query]);
        
        if($provider->getModels()){
            return $provider->getModels();
        } else {
            echo $model->geterrors();exit;
            throw new NotFoundHttpException("Object not found: $id");
        }
    }

    public function add($data){
        $model = WorkflowmgmtTbl::find()
        ->andWhere(['wfm_basemoduleulemst_fk' =>   Security::sanitizeInput($data['workflow']['wfm_basemoduleulemst_fk'], "number"),
                    'wfm_basesubmodule' =>  Security::sanitizeInput($data['workflow']['wfm_basesubmodule'], "number"),
                    'wfm_memcompmst_fk' =>  Security::sanitizeInput($data['workflow']['wfm_memcompmst_fk'], "number")])
        ->asArray()->all();
        if(!empty($model)){
            $result=array(
                'status' => 200,
                'statusmsg' => 'Duplicate',
                'flag'=>'D',
                'msg'=>'Workflow added successfully',
            );
        return json_encode($result);

        }
        $model = new WorkflowmgmtTbl();
        $model->wfm_basemoduleulemst_fk = Security::sanitizeInput($data['workflow']['wfm_basemoduleulemst_fk'], "number");
        $model->wfm_basesubmodule = Security::sanitizeInput($data['workflow']['wfm_basesubmodule'], "number");
        $model->wfm_stkholdtype = Security::sanitizeInput($data['workflow']['wfm_stkholdtype']['stkholdertypmst_pk'], "number");
        $model->wfm_memcompmst_fk = Security::sanitizeInput($data['workflow']['wfm_memcompmst_fk'], "number");
        $model->wfm_allocatedon = date('Y-m-d H:i:s');
        $model->wfm_allocatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wfm_status = 1;
        if ($model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Workflow added successfully',
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }

        return json_encode($result);
    }

    public function update($data,$id){
        

        $model = WorkflowmgmtTbl::find()->where([
            'workflowmgmt_pk'    =>  $id
        ])->one();
        
        $query = WorkflowmgmtTbl::find()
        ->andWhere(['wfm_basemoduleulemst_fk' =>   $model->wfm_basemoduleulemst_fk,
                    'wfm_basesubmodule' => $model->wfm_basesubmodule,
                    'wfm_memcompmst_fk' => $model->wfm_memcompmst_fk])
        ->andWhere(['<>','workflowmgmt_pk',$id])
        ->asArray()->all();
        if(!empty($query)){
            $result=array(
                'status' => 200,
                'statusmsg' => 'Duplicate',
                'flag'=>'D',
                'msg'=>'Workflow added successfully',
            );
        return json_encode($result);
        }

        $model->wfm_stkholdtype = Security::sanitizeInput($data['workflow']['wfm_stkholdtype']['stkholdertypmst_pk'], "number");
        $model->wfm_memcompmst_fk = Security::sanitizeInput($data['workflow']['wfm_memcompmst_fk'], "number");
        $model->wfm_allocatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->wfm_allocatedon = date('Y-m-d H:i:s');

            if ($model->save()) {
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Workflow updated successfully',
                );
            } else {

                $result=array(
                    'status' => 200,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>'Something went wrong',
                );
            }
       

        return json_encode($result);
    }

    public function companyarr(){
        $query = WorkflowmgmtTbl::find()
                 ->select(['wfm_memcompmst_fk'])
                 ->asArray()->all();
        return $query;

    }
}
