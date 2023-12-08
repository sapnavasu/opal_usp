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
 * This is the ActiveQuery class for [[LicensetrackerTbl]].
 *
 * @see LicensetrackerTbl
 */
class LicensetrackerTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicensetrackerTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicensetrackerTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}
