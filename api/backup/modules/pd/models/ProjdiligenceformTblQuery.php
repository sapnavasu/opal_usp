<?php

namespace api\modules\pd\models;

use Yii;
use yii\rbac\Permission;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;
use api\modules\pd\models\ProjecttmpTbl; 

// use api\modules\pd\models\ProjdiligenceformTbl;

/**
 * This is the ActiveQuery class for [[ProjdiligenceformTbl]].
 *
 * @see ProjdiligenceformTbl
 */
class ProjdiligenceformTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjdiligenceformTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjdiligenceformTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function submitdigigence($data)
    {
       $fromdata= $data['diligenceform'];
       $projectPk = Security::decrypt($data['projectpk']);
       $model = ProjecttmpTbl::find()->where("projecttmp_pk =:pk",[':pk'=> $projectPk])->one();
       if($model->prjt_projstatus == 3){
       $diligenceForm=new ProjdiligenceformTbl();
       $diligenceForm->pdf_formname=$fromdata['formtitle']['name']; 
       $diligenceForm->pdf_formdesc=$fromdata['formtitle']['description'];
       $diligenceForm->pdf_formtemplate=$fromdata['formdata'];
       $diligenceForm->pdf_buildertemplate=$fromdata['formtitle']['attributes'];
       $diligenceForm->pdf_formtype=2;
       $diligenceForm->pdf_createdby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       $diligenceForm->pdf_createdbyipaddr=\common\components\Common::getIpAddress();
       $diligenceForm->pdf_createdon=date('Y-m-d H:i:s');
       if(!$diligenceForm->save())
       {
           $diligenceForm->getErrors();
       }
    }
    if($model->prjt_projstatus == 1){
        if($data['dilpk'] == 0){
            $diligenceForm=new ProjdiligenceformTbl();
       $diligenceForm->pdf_createdby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       $diligenceForm->pdf_createdbyipaddr=\common\components\Common::getIpAddress();
       $diligenceForm->pdf_createdon=date('Y-m-d H:i:s');
        }else{
            $diligenceForm = ProjdiligenceformTbl::find()->where("projdiligenceform_pk =:pk",[':pk'=> $data['dilpk']])->one();
       $diligenceForm->pdf_updatedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       $diligenceForm->pdf_updatedbyipaddr=\common\components\Common::getIpAddress();
       $diligenceForm->pdf_updatedon=date('Y-m-d H:i:s');
        }
       $diligenceForm->pdf_formname=$fromdata['formtitle']['name'];
       $diligenceForm->pdf_formdesc=$fromdata['formtitle']['description'];
       $diligenceForm->pdf_formtemplate=$fromdata['formdata'];
       $diligenceForm->pdf_buildertemplate=$fromdata['formtitle']['attributes'];
       $diligenceForm->pdf_formtype=2;
       if(!$diligenceForm->save())
       {
           $diligenceForm->getErrors();
       }
    }
       $model->prjt_projdiligenceform_fk=$diligenceForm->projdiligenceform_pk;
       $model->prjt_projstatus=1;
       $model->save();
       return $diligenceForm;
    }

   
}
