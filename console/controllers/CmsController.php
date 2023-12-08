<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CmsController
 *
 * @author bgi220
 */
namespace console\controllers;

use Yii;
use yii\console\Controller;

class CmsController extends Controller{
    public function actionSendmailcontact($contractPk, $label, $userPk,$app_url,$baseUrl) { 
        $data= \api\modules\pms\models\CmscontracthdrTblQuery::notifyUserEmail($contractPk, $label, $userPk,$app_url,$baseUrl);
    }
}
