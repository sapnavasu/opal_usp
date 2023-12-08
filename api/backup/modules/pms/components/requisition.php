<?php

namespace api\modules\pms\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;
use common\components\Security;
use common\components\Common;

class Requisition extends Pms {

    public $lang = 'en';

    

}
