<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjshortlistTbl]].
 *
 * @see ProjshortlistTbl
 */
class ProjshortlistTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjshortlistTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjshortlistTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function shortlistproj($data){
        $projectPk = $data['projectpk'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $model = ProjshortlistTbl::find()
                ->where('prjsl_projectdtls_fk=:id',array(':id' => $projectPk))
                ->andWhere('prjsl_memberregmst_fk=:memid',array(':memid' => $companypk))
                ->one();
        if(empty($model)){
        $model = new ProjshortlistTbl();
        }
        $model->prjsl_projectdtls_fk = $projectPk;
        $model->prjsl_memberregmst_fk = $companypk;
        $model->prjsl_status = 1;
        $model->prjsl_shortlistedcancon = date('Y-m-d H:i:s');
        $model->prjsl_shortlistedcancby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->prjsl_shortlistedbycancipaddr = \common\components\Common::getIpAddress();
          if ($model->save() === false) {
          $result=array(
              'status' => 404,
              'statusmsg' => 'warning',
              'flag'=>'E',
              'msg'=>'Something went wrong'
          );
      } else{
          $result=array(
              'status' => 200,
              'statusmsg' => 'success',
              'flag'=>'S',
              'msg'=>'Project Shortlisted successfully!',
              'shortlistpk' => $model->projshortlist_pk,
              'status' => $model->prjsl_status,
          );
      }
        
      return $result;
    }
    public function cancelshortlistproj($data){
        $projectPk = $data['projectpk'];
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
		$model = ProjshortlistTbl::find()
                ->where('prjsl_projectdtls_fk=:id',array(':id' => $projectPk))
                ->andWhere('prjsl_memberregmst_fk=:memid',array(':memid' => $companypk))
                ->one();
        $model->prjsl_status = 2;
        $model->prjsl_shortlistedcancon = date('Y-m-d H:i:s');
        $model->prjsl_shortlistedcancby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->prjsl_shortlistedbycancipaddr = \common\components\Common::getIpAddress();
          if ($model->save() === false) {
          $result=array(
              'status' => 404,
              'statusmsg' => 'warning',
              'flag'=>'E',
              'msg'=>'Something went wrong'
          );
      } else{
          $result=array(
              'status' => 200,
              'statusmsg' => 'success',
              'flag'=>'S',
              'msg'=>'Project Shortlist Cancelled successfully!',
              'shortlistpk' => $model->projshortlist_pk,
              'status' => $model->prjsl_status,
          );
      }
      return $result;
}
}