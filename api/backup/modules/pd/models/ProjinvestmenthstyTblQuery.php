<?php

namespace api\modules\pd\models;

/**
 * This is the ActiveQuery class for [[ProjinvestmenthstyTbl]].
 *
 * @see ProjinvestmenthstyTbl
 */
class ProjinvestmenthstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvestmenthstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvestmenthstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function history($id){
        $query = ProjinvestmenthstyTbl::find()
                ->select(['projinvestmenthsty_pk','pinh_projinvestmentdtls_fk','pinh_status','pinh_appdeclcomments','pinh_createdon',
                'aproved.um_firstname as afname','aproved.um_lastname as alname','submit.um_firstname as sfname',
                'submit.um_lastname as slname','pinh_appdeclon','pinh_declaredon'])
                ->leftJoin('usermst_tbl aproved','pinh_createdby=aproved.UserMst_Pk')
                ->leftJoin('usermst_tbl submit','pinh_appdeclby=submit.UserMst_Pk')
                ->where('pinh_projinvestmentdtls_fk=:id',[':id'=> $id])
                // ->orderBy(['pinh_appdeclon' => SORT_ASC,'pinh_declaredon' => SORT_ASC])
                ->orderBy(['pinh_histcreatedon' => SORT_ASC])
                ->asArray()->all();
        return $query;
    }

    public function getinvhist($pk){
        $query = ProjinvestmenthstyTbl::find()
                ->select(['projinvestmenthsty_pk',
                            'pinh_projinvestmentdtls_fk',
                            'pinh_status as status',
                            'pinh_appdeclcomments as comment',
                            'aproved.um_firstname as afname',
                            'aproved.um_lastname as alname',
                            'submit.um_firstname as sfname',
                            'submit.um_lastname as slname',
                            'create.um_firstname as cfname',
                            'create.um_lastname as clname',
                            'pinh_appdeclon as appdeclon',
                            'pinh_declaredon as declaredon',
                            'pinh_createdon as createdon',
                            'pinh_invamount as amount',
                            'pinh_histcreatedon as hston',
                        ])
                ->leftJoin('usermst_tbl aproved','pinh_createdby=aproved.UserMst_Pk')
                ->leftJoin('usermst_tbl submit','pinh_appdeclby=submit.UserMst_Pk')
                ->leftJoin('usermst_tbl create','pinh_createdby=create.UserMst_Pk')
                ->where('pinh_projinvestmentdtls_fk=:pk',[':pk'=> $pk])
                ->orderBy(['pinh_histcreatedon' => SORT_ASC])
                ->asArray()->all();
        return $query;
    }


    public function invsubon($pk){
        $query = ProjinvestmenthstyTbl::find()
                ->select([
                            'create.um_firstname as cfname',
                            'create.um_lastname as clname',
                            'pinh_declaredon as declaredon',
                            'pinh_createdon as createdon',
                            'pinh_invamount as amount',
                            'pinh_histcreatedon as hston'
                        ])
                ->leftJoin('usermst_tbl create','pinh_createdby=create.UserMst_Pk')
                ->andWhere('pinh_projinvestmentdtls_fk=:pk',[':pk'=> $pk])
                ->andWhere('pinh_status=:status',[':status'=> 1])
                ->asArray()->all();
        return $query;
    }
}
