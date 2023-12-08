<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjectpartnerdtlsTbl]].
 *
 * @see ProjectpartnerdtlsTbl
 */
class ProjectpartnerdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectpartnerdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectpartnerdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function opdtls($projectPk){
      $model =  ProjectpartnerdtlsTbl::find()
                ->select(['*'])
                ->leftJoin('partnermst_tbl','prjpd_partnermst_fk=partnermst_pk')
                ->where('prjpd_projectdtls_fk=:fk',array(':fk' => Security::sanitizeInput($projectPk,"number")))
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
                'returndata' => $model
            );
        }
        return json_encode($result);
    }
}
