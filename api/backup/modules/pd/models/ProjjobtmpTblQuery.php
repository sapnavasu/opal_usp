<?php

namespace api\modules\pd\models;
use common\components\Security;


/**
 * This is the ActiveQuery class for [[ProjjobtmpTbl]].
 *
 * @see ProjjobtmpTbl
 */
class ProjjobtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjjobtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjjobtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function addprojectjob($data){
        $project_fk = Security::decrypt($data['projectpk']);
        // return $project_fk;
        $i=1;
        ProjjobtmpTbl::deleteAll('pjt_projecttmp_fk=:pk',[':pk'=>Security::sanitizeInput($project_fk,"number")]);

        foreach ($data['projectjob']['permitlicenses'] as $value)
        {  

        if($value['projid']==null && $value['projtype']==null && $value['projdesignation']==null && $value['projtnational']==null && $value['projexpatry']==null)
           continue;  
            // Security::sanitizeInput($proHigArray['prjd_contactinfo'], "string");
            $model = new ProjjobtmpTbl;
            $model->pjt_projecttmp_fk=$project_fk;
            if($value['projid']!=null){
            $model->pjt_jobid= $value['projid'];
            }
            if($value['projtype']!=null){
            $model->pjt_jobtype= $value['projtype'];
            }
            if($value['projdesignation']!=null){
            $model->pjt_designation= $value['projdesignation'];
            }  
            if($value['projtnational']!=null){
            $model->pjt_nationalvac= $value['projtnational'];
            }
            if($value['projexpatry']!=null){
            $model->pjt_expatriatesvac= $value['projexpatry'];
            }
            $model->pjt_submittedon=date('Y-m-d H:i:s');
            $model->pjt_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->pjt_submittedbyipaddr=\common\components\Common::getIpAddress();
            $i=$i+1;    
            if ($model->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$model->getErrors(),
                );
            }
            else{
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Project JOb added successfully!',
                    'returndata' => $model
                );
            }
        }
        return json_encode($result);
        
    }

}
