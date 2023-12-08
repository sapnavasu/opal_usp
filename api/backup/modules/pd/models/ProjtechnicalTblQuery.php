<?php

namespace api\modules\pd\models;
use common\components\Common;
use common\components\Security;
/**
 * This is the ActiveQuery class for [[ProjtechnicalTbl]].
 *
 * @see ProjtechnicalTbl
 */
class ProjtechnicalTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjtechnicalTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicalTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function addprojtecinfo($data){
        $proTechinfoArray = $data['technicalinfo'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        
        $model = ProjtechnicalTbl::find()->where("pt_projectdtls_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
        $model = new ProjtechnicalTbl();
        }
        $model->pt_projectdtls_fk =  Security::sanitizeInput($projectPk, "number");
        if(!empty($proTechinfoArray['projtecinfo'])){
        $model->pt_techinfo =   $proTechinfoArray['projtecinfo'];
        }
        if(!empty($proTechinfoArray['projtecapp'])){
        $model->pt_techapprovals = $proTechinfoArray['projtecapp'];
        }

        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'msg'=>'Project Info created successfully!',
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

    public function addprojectsocio($data){
        $proSocioArray = $data['projsocio'];
        $projectPk = Security::decrypt($data['projectpk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $model = ProjtechnicalTbl::find()->where("pt_projectdtls_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
        $model = new ProjtechnicalTbl();
        }
        $model->pt_projectdtls_fk = Security::sanitizeInput($projectPk, "number");
        if(!empty($proSocioArray['projsocemp'])){
        $model->pt_employoppor = $proSocioArray['projsocemp'];
        }
        if(!empty($proSocioArray['projsocinfra'])){
        $model->pt_infrastructure =  Security::sanitizeInput($proSocioArray['projsocinfra'], "string");
        }
        if(!empty($proSocioArray['projsocin'])){
        $model->pt_tourism =  $proSocioArray['projsocin'];
        }
        if(!empty($proSocioArray['projsocinc'])){
        $model->pt_supplychain = $proSocioArray['projsocinc'];
        }
        if(!empty($proSocioArray['projsocto'])){
        $model->pt_employment = $proSocioArray['projsocto'];
        }
        if(!empty($proSocioArray['projsocen'])){
        $model->pt_environmental = $proSocioArray['projsocen'];
        }

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
        $model = ProjtechnicalTbl::find()->where("pt_projectdtls_fk =:fk",[':fk'=> $projectPk])->one();
        if(empty($model)){
        $model = new ProjtechnicalTbl();
        }
        $model->pt_projectdtls_fk = Security::sanitizeInput($projectPk, "number");
        if(!empty($proBusinessArray['overview'])){
        $model->pt_marketoverview =  $proBusinessArray['overview'];
        }
        if(!empty($proBusinessArray['needs'])){
        $model->pt_marketneeds = $proBusinessArray['needs'];
        }
        if(!empty($proBusinessArray['trends'])){
        $model->pt_markettrends = $proBusinessArray['trends'];
        }
        if(!empty($proBusinessArray['refs'])){
        $model->pt_similrefer = $proBusinessArray['refs'];
        }
        
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

}