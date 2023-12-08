<?php

namespace api\modules\mst\controllers;

class EventController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
