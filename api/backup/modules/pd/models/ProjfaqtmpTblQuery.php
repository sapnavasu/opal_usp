<?php

namespace api\modules\pd\models;
use api\modules\pd\models\ProjfaqtmpTbl;
use common\components\Security;

/**
 * This is the ActiveQuery class for [[ProjfaqtmpTbl]].
 *
 * @see ProjfaqtmpTbl
 */
class ProjfaqtmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjfaqtmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqtmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function faqdtls($projectPk)
    {
      $model = ProjfaqtmpTbl::find()
                ->select(['*'])
                ->where('pft_projecttmp_fk=:fk',array(':fk' => Security::sanitizeInput($projectPk,"number")))
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
        ProjfaqtmpTbl::deleteAll('pft_projecttmp_fk=:pk',[':pk'=>Security::sanitizeInput($project_fk,"number")]);

        foreach ($data['projectfaq']['frequentArray'] as $value)
        {  
            // Security::sanitizeInput($proHigArray['prjd_contactinfo'], "string");
            $model = new ProjfaqtmpTbl;
            $model->pft_projecttmp_fk=$project_fk;
            $model->pft_question=Security::sanitizeInput($value['faqquestion'], "string_spl_char");
            $model->pft_answer=Security::sanitizeInput($value['faqanswer'], "string_spl_char");
            $model->pft_index=$i;
            $model->pft_status=1;
            $model->pft_type=2;
            $model->pft_submittedon=date('Y-m-d H:i:s');
            $model->pft_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->pft_submittedbyipaddr=\common\components\Common::getIpAddress();
            $i=$i+1;    
            if ($model->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$model->getErrors()
                );
            }
        }
        return json_encode($result);
        
       
    }
    public function getfaqlistedit($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
      $model = ProjfaqtmpTbl::find()
                ->select(['*'])
                ->where('pft_projecttmp_fk=:pk',array(':pk' => Security::sanitizeInput($projectPk,"number")))
                ->asArray()->all();
        $faq=[];
        if (empty($model)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'alert',
                'flag'=>'A',
                'msg'=>'No record found!'
            );
        }else{
        foreach ($model as $key => $value) {
            $faq[$key]['ques']=$value['pft_question'];
            $faq[$key]['ans']=$value['pft_answer'];
        }
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Request successfull!',
                'data' => $faq
            );
        }
        return json_encode($result);
    }
}
