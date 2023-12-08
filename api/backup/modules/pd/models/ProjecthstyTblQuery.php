<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjecthstyTbl]].
 *
 * @see ProjecthstyTbl
 */
class ProjecthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjecthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjecthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function projhistory($id){
        $query = ProjecthstyTbl::find()
                ->select(['projecthsty_pk','prjh_projecttmp_fk','prjh_projstatus','prjh_appldeccomments','prjh_histcreatedon','prjh_apprdeclon','prjh_submittedby','prjh_apprdeclby',
                'aproved.um_firstname as afname','aproved.um_lastname as alname','submit.um_firstname as sfname','prjh_submittedon','prjh_approvalno',
                'submit.um_lastname as slname'])
                ->leftJoin('usermst_tbl aproved','prjh_apprdeclby=aproved.UserMst_Pk')
                ->leftJoin('usermst_tbl submit','prjh_submittedby=submit.UserMst_Pk')
                ->where('prjh_projecttmp_fk=:id',[':id'=> $id])
                ->orderBy(['prjh_histcreatedon' => SORT_ASC])
                ->asArray()->all();
        return $query;
    }

}
