<?php
namespace api\modules\mda\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use yii\web\Response;
use \common\components\Security;
use \api\modules\mda\components\News;
use \common\models\NewsdtlTbl;
use \common\models\EventsdtlTbl;
use \common\models\WebinardtlsTbl;
use \common\models\EventvenuedtlsTbl;
use \common\models\EventsorgdtlsTbl;
use \common\models\EventscontactdtlsTbl;
use \common\models\EventsponsordtlsTbl;

class MediaController extends MasterController{

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

    public function beforeAction($action)
    {
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /*
        Path : api/mda/media/news-list-data
        Description : News List Data 
        Params :    {
                        postParams:{
                            page, 
                            size,
                            column,
                            direction,

                        }
                    }
    */
    public function actionNewsListData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $newsParams['page'] = isset($resParam->page)?$resParam->page:0;
        $newsParams['size'] = isset($resParam->size)?$resParam->size:10;
        $newsParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $newsParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $newsParams['newsTitle'] = isset($resParam->newsTitle)?$resParam->newsTitle:'';

        $newsParams['publishDate'] = '';
        if(isset($resParam->publishDate) && !empty($resParam->publishDate)){
            $dt = strtotime($resParam->publishDate);
            $dtformat = date('Y-m-d', $dt);
            $newsParams['publishDate'] =  Security::isDateValid($dtformat,'Y-m-d');
        }
        $newsParams['filterSatus'] = isset($resParam->filterSatus)?$resParam->filterSatus:'';

        $newsListData = NewsdtlTbl::getNewsListData($newsParams);

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $newsListData['data'],
            'totalcount' => $newsListData['totalcount'],
            'size' => $newsListData['size'],
            'page' => $newsListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-news-details
        Description : Add / Fetch news details
        Params :    {
                        postParams:{
                            newsPk
                        }
                    }
    */

    public function actionFetchNewsDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->newsPk) && !empty($resParam->newsPk)){
            $newsPk =  Security::decrypt($resParam->newsPk);
            $newsPk =  Security::sanitizeInput($newsPk,'number');

            if($newsPk > 0){
                $data['newsDetails'] = NewsdtlTbl::getNewsDetails($newsPk);
                $data['newsDetails']['uploadPath'] = explode(',', $data['newsDetails']['uploadPath']);
                $data['newsDetails']['searchTag'] = explode(',', $data['newsDetails']['searchTag']);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/save-news
        Description : Add / Update news details
        Params :    {
                        postParams:{
                            newsPk
                            title
                            desc
                            source
                            newsDate
                            searchTag
                            newsFileUpload
                        }
                    }
    */
    public function actionSaveNews(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->title) && !empty($resParam->title) && isset($resParam->source) && !empty($resParam->source) && isset($resParam->newsDate) && !empty($resParam->newsDate)){
            $newsPk =  Security::decrypt($resParam->newsPk);
            $newsPk =  Security::sanitizeInput($newsPk,'number');

            $save['title'] =  Security::sanitizeInput($resParam->title,'string_spl_char');
            $save['desc'] =  Security::sanitizeInput($resParam->desc,'string_spl_char');
            $save['source'] =  Security::sanitizeInput($resParam->source,'string_spl_char');
            
            $save['newsDate'] =  Security::isDateValid($resParam->newsDate,'Y-m-d');

            $save['searchTag'] = $save['newsFileUpload'] = '';
            if(!empty($resParam->newsFileUpload)){
                $save['newsFileUpload'] = implode(',', $resParam->newsFileUpload);
            }

            if(!empty($resParam->searchTag)){
                $save['searchTag'] = implode(',', $resParam->searchTag);
            }

            if(!empty($save['title']) && !empty($save['source']) && !empty($save['newsDate'])){
                $afterSave = NewsdtlTbl::saveNewsDetails($save, $newsPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/update-news-status
        Description : Update News Status
        Params :    {
                        postParams:{
                            newsPk,
                            newsStatus
                        }
                    }
    */
    public function actionUpdateNewsStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->newsPk) && !empty($resParam->newsPk) && isset($resParam->newsStatus) && !empty($resParam->newsStatus)){
            $newsPk =  Security::decrypt($resParam->newsPk);
            $newsPk =  Security::sanitizeInput($newsPk,'number');
            $newsStatus =  Security::decrypt($resParam->newsStatus);
            $newsStatus =  Security::sanitizeInput($newsStatus,'number');

            if($newsPk > 0 && $newsStatus > 0){
                $afterDelete = NewsdtlTbl::updateNewsDetails($newsPk, $newsStatus);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }


        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/delete-news
        Description : Delete News
        Params :    {
                        postParams:{
                            newsPk
                        }
                    }
    */
    public function actionDeleteNews(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->newsPk) && !empty($resParam->newsPk)){
            $newsPk =  Security::decrypt($resParam->newsPk);
            $newsPk =  Security::sanitizeInput($newsPk,'number');

            if($newsPk > 0){
                $afterDelete = NewsdtlTbl::deleteNewsDetails($newsPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/webinar-list-data
        Description : Webinar List Data 
        Params :    {
                        postParams:{
                            page, 
                            size,
                            column,
                            direction,
                        }
                    }
    */
    public function actionWebinarListData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $webinarParams['page'] = isset($resParam->page)?$resParam->page:0;
        $webinarParams['size'] = isset($resParam->size)?$resParam->size:10;
        $webinarParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $webinarParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $webinarParams['webniartitle'] = isset($resParam->webniartitle)?$resParam->webniartitle:'';

        $webinarParams['webinarDateTime'] = (isset($resParam->webinarDateTime) && !empty($resParam->webinarDateTime))?Security::isDateValid($resParam->webinarDateTime,'Y-m-d H:i:s'):'';
        $webinarParams['filterStatus'] = isset($resParam->filterStatus)?$resParam->filterStatus:'';

        $webinarListData = WebinardtlsTbl::getWebinarListData($webinarParams);

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $webinarListData['data'],
            'totalcount' => $webinarListData['totalcount'],
            'size' => $webinarListData['size'],
            'page' => $webinarListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-webinar-details
        Description : Add / Fetch webinar details
        Params :    {
                        postParams:{
                            webinarPk
                        }
                    }
    */

    public function actionFetchWebinarDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->webinarPk) && !empty($resParam->webinarPk)){
            $webinarPk =  Security::decrypt($resParam->webinarPk);
            $webinarPk =  Security::sanitizeInput($webinarPk,'number');

            if($webinarPk > 0){
                $data['webinarDetails'] = WebinardtlsTbl::getWebinarDetails($webinarPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }


    /*
        Path : api/mda/media/save-webinar
        Description : Add / Update webinar details
        Params :    {
                        postParams:{
                            webinarPk
                            topic
                            desc
                            link
                            dateTime
                            duration
                            timeZone
                        }
                    }
    */
    public function actionSaveWebinar(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->topic) && !empty($resParam->topic) && isset($resParam->link) && !empty($resParam->link) && isset($resParam->dateTime) && !empty($resParam->dateTime) && isset($resParam->duration) && !empty($resParam->duration) && isset($resParam->timeZone) && !empty($resParam->timeZone)){
            $webinarPk =  Security::decrypt($resParam->webinarPk);
            $webinarPk =  Security::sanitizeInput($webinarPk,'number');

            $save['topic'] =  Security::sanitizeInput($resParam->topic,'string_spl_char');
            $save['desc'] =  Security::sanitizeInput($resParam->desc,'string_spl_char');
            $save['link'] =  Security::sanitizeInput($resParam->link,'string_spl_char');
            $dt = strtotime($resParam->dateTime);
            $dtformat = date('Y-m-d H:i:s', $dt);
            $save['dateTime'] =  Security::isDateValid($dtformat,'Y-m-d H:i:s');
            
            $save['duration'] =  Security::sanitizeInput($resParam->duration,'string_spl_char');
            $save['timeZone'] =  Security::sanitizeInput($resParam->timeZone,'number');

            if(!empty($save['topic']) && !empty($save['link']) && !empty($save['dateTime']) && !empty($save['duration']) && $save['timeZone'] > 0){
                $afterSave = WebinardtlsTbl::saveWebinarDetails($save, $webinarPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/update-webinar-status
        Description : Update Webinar Status
        Params :    {
                        postParams:{
                            webinarPk,
                            webinarStatus
                        }
                    }
    */
    public function actionUpdateWebinarStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->webinarPk) && !empty($resParam->webinarPk) && isset($resParam->webinarStatus) && !empty($resParam->webinarStatus)){
            $webinarPk =  Security::decrypt($resParam->webinarPk);
            $webinarPk =  Security::sanitizeInput($webinarPk,'number');
            $webinarStatus =  Security::decrypt($resParam->webinarStatus);
            $webinarStatus =  Security::sanitizeInput($webinarStatus,'number');

            if($webinarPk > 0 && $webinarStatus > 0){
                $afterDelete = WebinardtlsTbl::updateWebinarDetails($webinarPk, $webinarStatus);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }


        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/delete-webinar
        Description : Delete Webinar
        Params :    {
                        postParams:{
                            webinarPk
                        }
                    }
    */
    public function actionDeleteWebinar(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->webinarPk) && !empty($resParam->webinarPk)){
            $webinarPk =  Security::decrypt($resParam->webinarPk);
            $webinarPk =  Security::sanitizeInput($webinarPk,'number');
            if($webinarPk > 0){
                $afterDelete = WebinardtlsTbl::deleteWebinarDetails($webinarPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/events-list-data
        Description : Events List Data 
        Params :    {
                        postParams:{
                            page, 
                            size,
                            column,
                            direction,

                        }
                    }
    */
    public function actionEventsListData(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $eventsParams['page'] = isset($resParam->page)?$resParam->page:0;
        $eventsParams['size'] = isset($resParam->size)?$resParam->size:10;
        $eventsParams['sort_column'] = isset($resParam->column)?$resParam->column:'';
        $direction = isset($resParam->direction)?$resParam->direction:'';
        $eventsParams['sort_type'] = ($direction == "asc") ? SORT_ASC : SORT_DESC;

        $eventsParams['eventName'] = isset($resParam->eventName)?$resParam->eventName:'';
        $eventsParams['eventCategory'] = isset($resParam->eventCategory)?$resParam->eventCategory:'';
        $eventsParams['eventSatus'] = isset($resParam->eventSatus)?$resParam->eventSatus:'';

        $eventsListData = EventsdtlTbl::getEventsListData($eventsParams);

        $message = $this->baseErrorMessage('success');
        $status = 100;

        return $this->asJson([
            'data' => $eventsListData['data'],
            'totalcount' => $eventsListData['totalcount'],
            'size' => $eventsListData['size'],
            'page' => $eventsListData['page'],
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-events-details
        Description : Add / Fetch events details
        Params :    {
                        postParams:{
                            eventsPk
                        }
                    }
    */

    public function actionFetchEventsDetails(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsPk) && !empty($resParam->eventsPk)){
            $eventsPk =  Security::decrypt($resParam->eventsPk);
            $eventsPk =  Security::sanitizeInput($eventsPk,'number');

            if($eventsPk > 0){
                $data['eventsDetails'] = EventsdtlTbl::getEventsDetails($eventsPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/save-events
        Description : Add / Update events details
        Params :    {
                        postParams:{
                            eventsPK
                            title
                            category
                            description
                            startDate
                            endDate
                            dateTime
                            eventsFileUpload
                        }
                    }
    */
    public function actionSaveEvents(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->title) && !empty($resParam->title) && isset($resParam->category) && !empty($resParam->category) && isset($resParam->startDate) && !empty($resParam->startDate) && isset($resParam->endDate) && !empty($resParam->endDate) && isset($resParam->dateTime) && !empty($resParam->dateTime)){
            $eventsPK =  Security::decrypt($resParam->eventsPK);
            $eventsPK =  Security::sanitizeInput($eventsPK,'number');

            $save['title'] =  Security::sanitizeInput($resParam->title,'string_spl_char');
            $save['category'] =  Security::sanitizeInput($resParam->category,'number');
            $save['desc'] =  Security::sanitizeInput($resParam->description,'string_spl_char');
            $save['startDate'] =  Security::isDateValid($resParam->startDate,'Y-m-d');
            $save['endDate'] =  Security::isDateValid($resParam->endDate,'Y-m-d');
            
            $dateTime = $resParam->dateTime;
            $dateTimeArr = [];
            foreach ($dateTime as $key => $dtVal) {
                $dtKey = Security::isDateValid($dtVal->eveDate,'Y-m-d');
                $dateTimeArr[$dtKey] = [
                    'starttime' => $dtVal->starttime,
                    'endtime' => $dtVal->endtime,
                ];
            }

            $save['dateTime'] = json_encode($dateTimeArr);
            $save['eventsFileUpload'] = '';
            if(!empty($resParam->eventsFileUpload) && is_array($resParam->eventsFileUpload)){
                $save['eventsFileUpload'] = implode(',', $resParam->eventsFileUpload);
            }
            
            if(!empty($save['title']) && !empty($save['startDate']) && !empty($save['endDate']) && $save['category'] > 0){
                $afterSave = EventsdtlTbl::saveEventsDetails($save, $eventsPK);

                if($afterSave['ret'] == 1){
                    $data['eventPk'] = $afterSave['eventPk'];
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave['ret'] == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave['ret'] == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/update-events-status
        Description : Update Events Status
        Params :    {
                        postParams:{
                            eventsPk,
                            eventsStatus
                        }
                    }
    */
    public function actionUpdateEventsStatus(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsPk) && !empty($resParam->eventsPk) && isset($resParam->eventsStatus) && !empty($resParam->eventsStatus)){
            $eventsPk =  Security::decrypt($resParam->eventsPk);
            $eventsPk =  Security::sanitizeInput($eventsPk,'number');
            $eventsStatus =  Security::decrypt($resParam->eventsStatus);
            $eventsStatus =  Security::sanitizeInput($eventsStatus,'number');

            if($eventsPk > 0 && $eventsStatus > 0){
                $afterDelete = EventsdtlTbl::updateEventsDetails($eventsPk, $eventsStatus);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }


        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/delete-events
        Description : Delete Webinar
        Params :    {
                        postParams:{
                            eventsPk
                        }
                    }
    */
    public function actionDeleteEvents(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsPk) && !empty($resParam->eventsPk)){
            $eventsPk =  Security::decrypt($resParam->eventsPk);
            $eventsPk =  Security::sanitizeInput($eventsPk,'number');

            if($eventsPk > 0){
                $afterDelete = EventsdtlTbl::deleteEventsDetails($eventsPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/save-events-venue
        Description : Add / Update events venue details
        Params :    {
                        postParams:{
                            eventVenuePk
                            eventFk
                            address
                            country
                            state
                            city
                            latitude
                            longitude
                        }
                    }
    */
    public function actionSaveEventsVenue(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventFk) && !empty($resParam->eventFk) && isset($resParam->address) && !empty($resParam->address) && isset($resParam->country) && !empty($resParam->country) && isset($resParam->latitude) && !empty($resParam->latitude) && isset($resParam->longitude) && !empty($resParam->longitude)){
            
            /**/

            $eventVenuePk =  Security::decrypt($resParam->eventVenuePk);
            $eventVenuePk =  Security::sanitizeInput($eventVenuePk,'number');
            $eventFk =  Security::decrypt($resParam->eventFk);
            $save['eventFk'] =  Security::sanitizeInput($eventFk,'number');

            $save['address'] =  Security::sanitizeInput($resParam->address,'string_spl_char');
            $save['country'] =  Security::sanitizeInput($resParam->country,'number');
            $save['state'] =  Security::sanitizeInput($resParam->state,'number');
            $save['city'] =  Security::sanitizeInput($resParam->city,'number');
            $save['latitude'] =  Security::sanitize_double($resParam->latitude);
            $save['longitude'] = Security::sanitize_double($resParam->longitude);

            if($save['eventFk'] > 0 && !empty($save['address']) && $save['country'] > 0 && $save['latitude'] > 0 && $save['longitude'] > 0){
                /**/
                $afterSave = EventvenuedtlsTbl::saveEventsVenue($save, $eventVenuePk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }


    /*
        Path : api/mda/media/delete-events-venue
        Description : Delete Venue
        Params :    {
                        postParams:{
                            eventsVenuePk
                        }
                    }
    */
    public function actionDeleteEventsVenue(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsVenuePk) && !empty($resParam->eventsVenuePk)){
            $eventsVenuePk =  Security::decrypt($resParam->eventsVenuePk);
            $eventsVenuePk =  Security::sanitizeInput($eventsVenuePk,'number');

            if($eventsVenuePk > 0){
                $afterDelete = EventvenuedtlsTbl::deleteVenueDetails($eventsVenuePk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/save-events-organiser
        Description : Add / Update events organiser details
        Params :    {
                        postParams:{
                            eventOrgPk
                            eventFk
                            orgName
                            address
                            country
                            state
                            city
                            latitude
                            longitude
                        }
                    }
    */
    public function actionSaveEventsOrganiser(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventFk) && !empty($resParam->eventFk) && isset($resParam->orgName) && !empty($resParam->orgName) && isset($resParam->address) && !empty($resParam->address) && isset($resParam->country) && !empty($resParam->country) && isset($resParam->latitude) && !empty($resParam->latitude) && isset($resParam->longitude) && !empty($resParam->longitude)){

            $eventOrgPk =  Security::decrypt($resParam->eventOrgPk);
            $eventOrgPk =  Security::sanitizeInput($eventOrgPk,'number');
            $eventFk =  Security::decrypt($resParam->eventFk);
            $save['eventFk'] =  Security::sanitizeInput($eventFk,'number');

            $save['orgName'] =  Security::sanitizeInput($resParam->orgName,'string');
            $save['address'] =  Security::sanitizeInput($resParam->address,'string_spl_char');
            $save['country'] =  Security::sanitizeInput($resParam->country,'number');
            $save['state'] =  Security::sanitizeInput($resParam->state,'number');
            $save['city'] =  Security::sanitizeInput($resParam->city,'number');
            $save['latitude'] =  Security::sanitize_double($resParam->latitude);
            $save['longitude'] = Security::sanitize_double($resParam->longitude);

            if($save['eventFk'] > 0 && !empty($save['address']) && $save['country'] > 0 && $save['latitude'] > 0 && $save['longitude'] > 0){
                
                $afterSave = EventsorgdtlsTbl::saveEventsOrganiser($save, $eventOrgPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/delete-events-org
        Description : Delete Organiser
        Params :    {
                        postParams:{
                            eventsOrgPk
                        }
                    }
    */
    public function actionDeleteEventsOrg(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsOrgPk) && !empty($resParam->eventsOrgPk)){
            $eventsOrgPk =  Security::decrypt($resParam->eventsOrgPk);
            $eventsOrgPk =  Security::sanitizeInput($eventsOrgPk,'number');

            if($eventsOrgPk > 0){
                $afterDelete = EventsorgdtlsTbl::deleteOrgDetails($eventsOrgPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/save-events-contact
        Description : Add / Update events contact details
        Params :    {
                        postParams:{
                            eventCntPk
                            eventFk
                            personName
                            department
                            designation
                            emailId
                            mobileCode
                            mobileNumber
                            landlineLineCode
                            landlineLineNumber
                            landLineExt
                        }
                    }
    */
    public function actionSaveEventsContact(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventFk) && !empty($resParam->eventFk) && isset($resParam->personName) && !empty($resParam->personName) && isset($resParam->department) && !empty($resParam->department) && isset($resParam->designation) && !empty($resParam->designation) && isset($resParam->emailId) && !empty($resParam->emailId) && isset($resParam->mobileCode) && !empty($resParam->mobileCode) && isset($resParam->mobileNumber) && !empty($resParam->mobileNumber)){
            $eventCntPk =  Security::decrypt($resParam->eventCntPk);
            $eventCntPk =  Security::sanitizeInput($eventCntPk,'number');
            $eventFk =  Security::decrypt($resParam->eventFk);
            $save['eventFk'] =  Security::sanitizeInput($eventFk,'number');

            $save['personName'] =  Security::sanitizeInput($resParam->personName,'string');
            $save['department'] =  Security::sanitizeInput($resParam->department,'string');
            $save['designation'] =  Security::sanitizeInput($resParam->designation,'string');
            $save['emailId'] =  Security::sanitizeInput($resParam->emailId,'string_spl_char');
            $save['mobileCode'] =  Security::sanitizeInput($resParam->mobileCode,'string_spl_char');
            $save['mobileNumber'] =  Security::sanitizeInput($resParam->mobileNumber,'number');
            $save['landlineLineCode'] =  Security::sanitizeInput($resParam->landlineLineCode,'string_spl_char');
            $save['landlineLineNumber'] =  Security::sanitizeInput($resParam->landlineLineNumber,'number');
            $save['landLineExt'] =  Security::sanitizeInput($resParam->landLineExt,'number');
            

            if($save['eventFk'] > 0 && !empty($save['personName']) && !empty($save['department'])  && !empty($save['designation'])  && !empty($save['emailId']) && $save['mobileCode'] > 0 && $save['mobileNumber'] > 0){
                $afterSave = EventscontactdtlsTbl::saveEventsContacts($save, $eventCntPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/delete-events-contact
        Description : Delete Contacts
        Params :    {
                        postParams:{
                            eventsCntPk
                        }
                    }
    */
    public function actionDeleteEventsContact(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsCntPk) && !empty($resParam->eventsCntPk)){
            $eventsCntPk =  Security::decrypt($resParam->eventsCntPk);
            $eventsCntPk =  Security::sanitizeInput($eventsCntPk,'number');

            if($eventsCntPk > 0){
                $afterDelete = EventscontactdtlsTbl::deleteCntDetails($eventsCntPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/save-events-sponsor
        Description : Add / Update events sponsor details
        Params :    {
                        postParams:{
                            eventSponPk
                            eventFk
                            sponName
                            fileDtlsPk
                        }
                    }
    */
    public function actionSaveEventsSponsor(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventFk) && !empty($resParam->eventFk) && isset($resParam->sponName) && !empty($resParam->sponName)){
            $eventSponPk =  Security::decrypt($resParam->eventSponPk);
            $eventSponPk =  Security::sanitizeInput($eventSponPk,'number');
            $eventFk =  Security::decrypt($resParam->eventFk);
            $save['eventFk'] =  Security::sanitizeInput($eventFk,'number');

            $save['sponName'] =  Security::sanitizeInput($resParam->sponName,'string');
            $save['fileDtlsPk'] =  $resParam->fileDtlsPk;
            if($save['eventFk'] > 0 && !empty($save['sponName'])){
                $afterSave = EventsponsordtlsTbl::saveEventsSponsor($save, $eventSponPk);

                if($afterSave == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterSave == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterSave == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/delete-events-sponsor
        Description : Delete Sponsor
        Params :    {
                        postParams:{
                            eventsSponPk
                        }
                    }
    */
    public function actionDeleteEventsSponsor(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsSponPk) && !empty($resParam->eventsSponPk)){
            $eventsSponPk =  Security::decrypt($resParam->eventsSponPk);
            $eventsSponPk =  Security::sanitizeInput($eventsSponPk,'number');

            if($eventsSponPk > 0){
                $afterDelete = EventsponsordtlsTbl::deleteSponDetails($eventsSponPk);

                if($afterDelete == 1){
                    $message = $this->baseErrorMessage('success');
                    $status = 100;
                }elseif($afterDelete == 2){
                    $message = $this->baseErrorMessage('notAvailable');
                    $status = 104;
                }elseif($afterDelete == 3){
                    $message = $this->baseErrorMessage('dbError');
                    $status = 103;
                }
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/fetch-events-sponsor
        Description : fetch Sponsor
        Params :    {
                        postParams:{
                            eventsSponPk
                        }
                    }
    */
    public function actionFetchEventsSponsor(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsSponPk) && !empty($resParam->eventsSponPk)){
            $eventsSponPk =  Security::decrypt($resParam->eventsSponPk);
            $eventsSponPk =  Security::sanitizeInput($eventsSponPk,'number');

            if($eventsSponPk > 0){
                $data['spnDetails'] = EventsponsordtlsTbl::fetchSponDetails($eventsSponPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/contact-person-list
        Description : Contact Person List
        Params :    {
                        postParams:{
                            eventPk
                        }
                    }
    */
    public function actionContactPersonList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventPk) && !empty($resParam->eventPk)){
            $eventPk =  Security::decrypt($resParam->eventPk);
            $eventPk =  Security::sanitizeInput($eventPk,'number');

            $data['cntPersonDetails'] = EventscontactdtlsTbl::getCpListData($eventPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/sponsor-list
        Description : Sponsor List Data
        Params :    {
                        postParams:{
                            eventPk
                        }
                    }
    */
    public function actionSponsorList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventPk) && !empty($resParam->eventPk)){
            $eventPk =  Security::decrypt($resParam->eventPk);
            $eventPk =  Security::sanitizeInput($eventPk,'number');

            $data['sponDetails'] = EventsponsordtlsTbl::getSponListData($eventPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-contact-person
        Description : fetch contact person
        Params :    {
                        postParams:{
                            eventsCntPk
                        }
                    }
    */
    public function actionFetchContactPerson(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsCntPk) && !empty($resParam->eventsCntPk)){
            $eventsCntPk =  Security::decrypt($resParam->eventsCntPk);
            $eventsCntPk =  Security::sanitizeInput($eventsCntPk,'number');

            if($eventsCntPk > 0){
                $data['cntDetails'] = EventscontactdtlsTbl::fetchContactDetails($eventsCntPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/venue-list
        Description : venue List Data
        Params :    {
                        postParams:{
                            eventPk
                        }
                    }
    */
    public function actionVenueList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventPk) && !empty($resParam->eventPk)){
            $eventPk =  Security::decrypt($resParam->eventPk);
            $eventPk =  Security::sanitizeInput($eventPk,'number');

            $data['venueDetails'] = EventvenuedtlsTbl::getVenueListData($eventPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-events-venue
        Description : fetch venue
        Params :    {
                        postParams:{
                            eventsVenuePk
                        }
                    }
    */
    public function actionFetchEventsVenue(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsVenuePk) && !empty($resParam->eventsVenuePk)){
            $eventsVenuePk =  Security::decrypt($resParam->eventsVenuePk);
            $eventsVenuePk =  Security::sanitizeInput($eventsVenuePk,'number');

            if($eventsVenuePk > 0){
                $data['venueDetails'] = EventvenuedtlsTbl::fetchVenueDetails($eventsVenuePk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*
        Path : api/mda/media/org-list
        Description : org List Data
        Params :    {
                        postParams:{
                            eventPk
                        }
                    }
    */
    public function actionOrgList(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventPk) && !empty($resParam->eventPk)){
            $eventPk =  Security::decrypt($resParam->eventPk);
            $eventPk =  Security::sanitizeInput($eventPk,'number');

            $data['orgDetails'] = EventsorgdtlsTbl::getOrgListData($eventPk);
            $message = $this->baseErrorMessage('success');
            $status = 100;
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);
    }

    /*
        Path : api/mda/media/fetch-events-org
        Description : fetch org
        Params :    {
                        postParams:{
                            eventsOrgPk
                        }
                    }
    */
    public function actionFetchEventsOrg(){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        if(isset($resParam->eventsOrgPk) && !empty($resParam->eventsOrgPk)){
            $eventsOrgPk =  Security::decrypt($resParam->eventsOrgPk);
            $eventsOrgPk =  Security::sanitizeInput($eventsOrgPk,'number');

            if($eventsOrgPk > 0){
                $data['orgDetails'] = EventsorgdtlsTbl::fetchOrgDetails($eventsOrgPk);
                $message = $this->baseErrorMessage('success');
                $status = 100;
            }else{
                $message = $this->baseErrorMessage('sanitizeError');
                $status = 106;
            }
        }else{
            $message = $this->baseErrorMessage('missingFields');
            $status = 101;
        }

        return $this->asJson([
            'data' => $data,
            'msg' => $message,
            'status' => $status,
        ]);   
    }

    /*Error message creation*/
    function baseErrorMessage($type){
        $postVar = Yii::$app->request->getRawBody();
        $params = json_decode($postVar);
        $resParam = $params->postParams;
        $data = [];

        $resMessage = '';
        switch ($type) {
            case 'success':
                $resMessage = 'Success';
                break;
            case 'notAvailable':
                $resMessage = 'Data is not available towards this';
                break;
            case 'missingFields':
                $resMessage = 'Mandatory Fields are missing';
                break;
            case 'dbError':
                $resMessage = 'Database error occurs';
                break;
            case 'smAlreadyAvailable':
                $resMessage = 'This data is already available';
                break;
            case 'sanitizeError':
                $resMessage = 'Sanitization Error';
                break;
        }
        return $resMessage;
    }
}
