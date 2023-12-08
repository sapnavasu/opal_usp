<?php

namespace api\modules\lic\models;
use common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * This is the ActiveQuery class for [[LicapprhstyTbl]].
 *
 * @see LicapprhstyTbl
 */
class LicapprhstyTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicapprhstyTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicapprhstyTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function index($id){
        $query = LicapprhstyTbl::find()
                ->select(['licapprhsty_pk','lah_licinvapplied_fk','lah_status','lah_comments',
                'aproved.um_firstname as afname','aproved.um_lastname as alname','submit.um_firstname as sfname',
                'submit.um_lastname as slname','lah_submittedon','lah_apprdeclon'])
                ->leftJoin('usermst_tbl aproved','lah_apprdeclby=aproved.UserMst_Pk')
                ->leftJoin('usermst_tbl submit','lah_submittedby=submit.UserMst_Pk')
                ->where('lah_licinvapplied_fk=:id',[':id'=> $id])
                ->orderBy(['lah_submittedon' => SORT_ASC])
                ->asArray()->all();
        return $query;
    }
    
    public function gethstrycount($pk){
        $query = LicapprhstyTbl::find()
                ->select(['count(licapprhsty_pk) as hstrycount'])
                ->where('lah_licinvapplied_fk=:id',[':id'=> $pk])
                ->asArray()->one();
        return $query;
    }
}
