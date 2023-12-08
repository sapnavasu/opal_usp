<?php

namespace api\modules\review\components;

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
use common\models\MemcompreviewdtlsTblQuery;

class Review {

    public $lang = 'en';

    public function addreview($data) {
        
        $sharedPk = Security::decrypt($data['reviewData']['shared_pk']);
        $sharedPk = Security::sanitizeInput($sharedPk, "number");
        if ($sharedPk != null && $sharedPk != '' && is_numeric($sharedPk)) {
            $data['reviewData']['shared_pk'] =$sharedPk;
            return MemcompreviewdtlsTblQuery::addUserdata($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'Shared Pk Not Valid', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function addReplay($data) {
        if ($data['replayData']['reviewPK'] != null && $data['replayData']['reviewPK'] != '' && is_numeric($data['replayData']['reviewPK'])) {
            return MemcompreviewdtlsTblQuery::addReplay($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'Shared Pk Not Valid', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteReview($data) {
        $reviewPk = Security::decrypt($data['review_pk']);
        $reviewPk = Security::sanitizeInput($reviewPk, "number");
        if ($reviewPk != null && $reviewPk != '' && is_numeric($reviewPk)) {
            return MemcompreviewdtlsTblQuery::deleteReviewData($reviewPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'Review Pk Not Valid', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function likeReview($data) {
        if ($data['review_pk'] != null && $data['review_pk'] != '' && is_numeric($data['review_pk'])) {
            return MemcompreviewdtlsTblQuery::likeReviewData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'Review Pk Not Valid', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function GetRatingReviewCount($sharedPk,$type) {
        if ($sharedPk != null && $sharedPk != '' && is_numeric($sharedPk)) {
            return \common\models\MemcompoverallreviewTblQuery::GetRatingReviewCount($sharedPk,$type);
        } else {
            return ['msg' => 'warning', 'comments' => 'Review Pk Not Valid', 'code' => 'ERR001', 'status' => false,'flag' => 'E'];
        }
    }
    
    public function getCurrentUser($sharedPk,$type,$userPk) {
        if ($sharedPk != null && $sharedPk != '' && is_numeric($sharedPk)) {
            return MemcompreviewdtlsTblQuery::getCurrentUser($sharedPk,$type,$userPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'Shared Pk Not Valid', 'code' => 'ERR001', 'status' => false,'flag' => 'E'];
        }
    }

    public function getreiewhistory($pk) {
        if ($pk != null && $pk != '' && is_numeric($pk)) {
            return MemcompreviewdtlsTblQuery::getreiewhistory($pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'Shared Pk Not Valid', 'code' => 'ERR001', 'status' => false,'flag' => 'E'];
        }
    }

    public function index($data) {
        $sharedPk = Security::decrypt($data['sharedPk']);
        $sharedPk = Security::sanitizeInput($sharedPk, "number");
        if ($sharedPk != null && $sharedPk != '' && is_numeric($sharedPk)) {
            $data['sharedPk'] = $sharedPk;
            return MemcompreviewdtlsTblQuery::getReviewData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'Shared Pk Not Valid', 'code' => 'ERR001', 'status' => false];
        }
    }

}
