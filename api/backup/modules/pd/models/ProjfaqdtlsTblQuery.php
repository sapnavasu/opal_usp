<?php

namespace api\modules\pd\models;
use api\modules\pd\models\ProjfaqdtlsTbl;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjfaqdtlsTbl]].
 *
 * @see ProjfaqdtlsTbl
 */
class ProjfaqdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjfaqdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function faqdtls($projectPk)
    {
      $model = ProjfaqdtlsTbl::find()
                ->select(['*'])
                ->where('pfd_projectdtls_fk=:fk',array(':fk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        if (empty($model)) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!'
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

    public function addprojectfaq($data){
        $project_fk = Security::decrypt($data['projectpk']);
        $i=1;
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project F.A.Q. added successfully!',
            'returndata' => $model
        );
        foreach ($data['projectfaq']['frequentArray'] as $value)
        {  
            // Security::sanitizeInput($proHigArray['prjd_contactinfo'], "string");
            $model = new ProjfaqdtlsTbl;
            $model->pfd_projectdtls_fk=$project_fk;
            $model->pfd_question=Security::sanitizeInput($value['ques'], "string_spl_char");
            $model->pfd_answer=Security::sanitizeInput($value['ans'], "string_spl_char");
            $model->pfd_index=$i;
            $model->pfd_status=1;
            $model->pfd_type=2;
            $model->pfd_createdon=date('Y-m-d H:i:s');
            $model->pfd_createdby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->pfd_createdbyipaddr=\common\components\Common::getIpAddress();
            $i=$i+1;    
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
}
