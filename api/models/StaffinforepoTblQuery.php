<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StaffinforepoTbl]].
 *
 * @see StaffinforepoTbl
 */
class StaffinforepoTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StaffinforepoTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StaffinforepoTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function getStaffInfoRepoList($id) {
        // $result = StaffinforepoTbl::find()
        //           ->select('staffinforepo_pk','sir_idnumber as civilnumber','sir_name_en as staffname','sir_name_ar as staffname_ar','sir_dob as age','roleforcourse','cour_subcate','competencycard','status','sir_createdon as addedon','sir_updatedon as lastupdated')
        //           ->leftJoin('staffevaluationtmp_tbl','set_staffinforepo_fk = staffinforepo_pk AND set_asmttype=2')
        //           ->where(['IN','sir_type','1,3'])
        //           ->andWhere(['sir_opalmemberregmst_fk' => $id])
        //           ->asArray()
        //           ->all();
        $result = ApplicationdtlstmpTbl::find()
                ->select("staffinforepo_pk,ccm_catname_en AS cour_subcate , appctt_coursecategorymst_fk, rm_rolename_en AS roleforcourse,rm_rolename_ar,sir_idnumber AS civilnumber,sir_name_en AS staffname,sir_name_ar,sir_dob AS age, appsit_status AS status,appsit_createdon AS addedon,appsit_updatedon AS lastupdated")
                 ->innerJoin('appstaffinfotmp_tbl',' appsit_applicationdtlstmp_fk=applicationdtlstmp_pk')
                 ->leftJoin('staffinforepo_tbl','appsit_staffinforepo_fk = staffinforepo_pk')
                 ->leftJoin('appcoursetrnstmp_tbl','appsit_appcoursetrnstmp_fk = appcoursetrnstmp_pk')
                 ->leftJoin('rolemst_tbl','appsit_roleforcourse = rolemst_pk')
                 ->leftJoin('coursecategorymst_tbl','appctt_coursecategorymst_fk = coursecategorymst_pk')
                ->where("applicationdtlstmp_pk = '$id' group by staffinforepo_pk")
                ->asArray()
                ->all();
          
        return $result;
    }
}
