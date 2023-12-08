<?php

namespace api\modules\webs\components;

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

class Webservice {

    public $lang = 'en';

    public function SampleFuncation($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::addRequisition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

} 