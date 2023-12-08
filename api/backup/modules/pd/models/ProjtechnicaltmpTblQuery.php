<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;

/**
 * This is the ActiveQuery class for [[ProjtechnicaltmpTbl]].
 *
 * @see ProjtechnicaltmpTbl
 */
class ProjtechnicaltmpTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechnicaltmpTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicaltmpTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function addprojtecinfo($data){
        $proTechinfoArray = $data['technicalinfo'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");

        $model = ProjtechnicaltmpTbl::find()->where("ptt_projecttmp_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
            $model = new ProjtechnicaltmpTbl();
            $model->ptt_submittedon=date('Y-m-d H:i:s');
            $model->ptt_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ptt_submittedbyipaddr=\common\components\Common::getIpAddress();
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Project Technical created successfully!',
                'returndata' => $model
            );
        }
        else{
            $model->ptt_updatedon=date('Y-m-d H:i:s');
            $model->ptt_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ptt_updatedbyipaddr=\common\components\Common::getIpAddress();
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Project Technical updated successfully!',
                'returndata' => $model
            );
        }

        $model->ptt_projecttmp_fk =  Security::sanitizeInput($projectPk, "number");

        if(!empty($proTechinfoArray['projtecinfo'])){
        $model->ptt_techinfo =   $proTechinfoArray['projtecinfo'];
        }
        if(!empty($proTechinfoArray['projtecapp'])){
        $model->ptt_techapprovals = $proTechinfoArray['projtecapp'];
        }
        if(!empty($proTechinfoArray['secioeconomics'])){
        $model->ptt_socioecoimpact = $proTechinfoArray['secioeconomics'];
        }
        if(!empty($proTechinfoArray['projsocen'])){
        $model->ptt_environmental = $proTechinfoArray['projsocen'];
        }
        if(!empty($proTechinfoArray['fdiclassify'])){
        $model->ptt_fdiclassification = $proTechinfoArray['fdiclassify'];
        }
        
       
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        }
        return json_encode($result);

    }

    public function addprojectsocio($data){
        $proSocioArray = $data['projsocio'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjtechnicaltmpTbl::find()->where("ptt_projecttmp_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
        $model = new ProjtechnicaltmpTbl();
        }
        $model->ptt_projecttmp_fk = Security::sanitizeInput($projectPk, "number");
        if(!empty($proSocioArray['projsocemp'])){
        $model->ptt_employoppor = $proSocioArray['projsocemp'];
        }
        if(!empty($proSocioArray['projsocinfra'])){
        $model->ptt_infrastructure =  Security::sanitizeInput($proSocioArray['projsocinfra'], "string");
        }
        if(!empty($proSocioArray['projsocin'])){
        $model->ptt_tourism =  $proSocioArray['projsocin'];
        }
        if(!empty($proSocioArray['projsocinc'])){
        $model->ptt_supplychain = $proSocioArray['projsocinc'];
        }
        if(!empty($proSocioArray['projsocto'])){
        $model->ptt_employment = $proSocioArray['projsocto'];
        }
        if(!empty($proSocioArray['projsocen'])){
        $model->ptt_environmental = $proSocioArray['projsocen'];
        }

        $model->ptt_submittedon=date('Y-m-d H:i:s');
        $model->ptt_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->ptt_submittedbyipaddr=\common\components\Common::getIpAddress();
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Socio-Economics created successfully!',
            'returndata' => $model
        );
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong'
            );
        }
        return json_encode($result);
    }

    public function addbusinesscase($data){
        $proBusinessArray = $data['businesscase'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjtechnicaltmpTbl::find()->where("ptt_projecttmp_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
        $model = new ProjtechnicaltmpTbl();
            $model->ptt_submittedon=date('Y-m-d H:i:s');
            $model->ptt_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ptt_submittedbyipaddr=\common\components\Common::getIpAddress();
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Project Technical created successfully!',
                'returndata' => $model
            );
        }
        else{
            $model->ptt_updatedon=date('Y-m-d H:i:s');
            $model->ptt_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            $model->ptt_updatedbyipaddr=\common\components\Common::getIpAddress();
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Project Technical updated successfully!',
                'returndata' => $model
            );
        }
        $model->ptt_projecttmp_fk = Security::sanitizeInput($projectPk, "number");
        if(!empty($proBusinessArray['overview'])){
        $model->ptt_marketoverview =  $proBusinessArray['overview'];
        }
        if(!empty($proBusinessArray['needs'])){
        $model->ptt_marketneeds = $proBusinessArray['needs'];
        }
        if(!empty($proBusinessArray['trends'])){
        $model->ptt_markettrends = $proBusinessArray['trends'];
        }
        if(!empty($proBusinessArray['refs'])){
        $model->ptt_similrefer = $proBusinessArray['refs'];
        }
            if ($model->save() === false) {
        $result=array(
            'status' => 404,
            'statusmsg' => 'warning',
            'flag'=>'E',
            'msg'=>'Something went wrong'
        );
    }
                return json_encode($result);
    }

    public function addemployment($data){
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjtechnicaltmpTbl::find()
        ->where("ptt_projecttmp_fk=:BSPK",[':BSPK'=>$projectPk])->one();
        if(empty($model) || $model==null)
        $model = new ProjtechnicaltmpTbl();
            $model->ptt_projecttmp_fk = $projectPk;
            $model->ptt_infrastructure = $data['employmentData']['prjt_infrastruct'];
            $model->ptt_tourism = $data['employmentData']['prjt_tourism'];
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project employment added successfully!',
            'returndata' => $model
        );
        if ($model->save() === false) {
            $result=array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>$model->getErrors()
            );
        }
        return json_encode($result);

    }
}
