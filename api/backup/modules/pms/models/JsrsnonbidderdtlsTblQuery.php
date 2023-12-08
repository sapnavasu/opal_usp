<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[JsrsnonbidderdtlsTbl]].
 *
 * @see JsrsnonbidderdtlsTbl
 */
class JsrsnonbidderdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
