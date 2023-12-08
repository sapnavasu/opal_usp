<?php

namespace api\modules\scc\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use DateTime;
use yii\db\ActiveRecord;
use app\models\StandardcoursemstTbl;
use app\models\StandardcoursedtlsTbl;
use app\models\StaffcourseconfigmstTbl;
use app\models\DocumentdtlsmstTbl;
use app\models\ReferencemstTbl;
use app\models\CoursecategorymstTbl;


class StandardCourseConfigurationController extends MasterController
{


    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

    }

    public function actions()
    {
        return [];
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

        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionGetcourselist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $courseList = StandardcoursemstTbl::getCourse($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $courseList ];
    }

    public function actionGetcourserelateddata()
    {
        $assessmentin = ReferencemstTbl::getReferrenceBasedMasterType(14);
        $requestfor = ReferencemstTbl::getReferrenceBasedMasterType(13);
        $courseLevel = ReferencemstTbl::getReferrenceBasedMasterType(3);
        $coursecategory = CoursecategorymstTbl::getCourseCategories();
        $data = [
            'assessmentin' => $assessmentin,
            'requestfor' => $requestfor,
            'courseLevel' => $courseLevel,
            'coursecategory' => $coursecategory
        ];

        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionSavecourse()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = StandardcoursemstTbl::alreadyExist($request['title_en']);
        if(!$exist){
            $data = StandardcoursemstTbl::savestandardcourse($request);
            if ($data) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => $data
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 500,
                    'flag' => 'F',
                    'data' => 'Error saving course'
                ];
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Course Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditcourse()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $course = StandardcoursemstTbl::findOne($request['id']);
        if(strtolower($request['title_en']) != strtolower($course->scm_coursename_en)){
            $exist = StandardcoursemstTbl::alreadyExist($request['title_en']);
        }
        if(!$exist){
            $data = StandardcoursemstTbl::editstandardcourse($request);
    
            if ($data === 1) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => 'Course edited Successfully'
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 400,
                    'flag' => 'E',
                    'data' => 'Error editing course'
                ];
            }

        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Course Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionChangecoursestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = StandardcoursemstTbl::changestandardcoursestatus($request);

        if ($data === 1) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Status updated Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error editing course'
            ];
        }
    }

    public function actionGetcourse($id)
    {
        $data = StandardcoursemstTbl::getstandardcourse($id);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionGetallsubcourselist()
    {
        $data = CoursecategorymstTbl::getSubCourseCategoriesList();
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionGetallsubcourse($standmstid, $courseid)
    {
        $data = CoursecategorymstTbl::getAllSubcourseCategories($standmstid, $courseid);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionGetprereqlist($id)
    {
        $data = StandardcoursedtlsTbl::getprereqlist($id);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionGetsubcourselist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $id = isset($request['id'])? $request['id'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $data = StandardcoursedtlsTbl::getsubstandardcourse($id,$limit,$index,$searchkey,$sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionGetsubcourse($id)
    {
        $data = StandardcoursedtlsTbl::getsubstandardcoursedtls($id);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionSavecoursedtls()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = StandardcoursedtlsTbl::savecoursedtls($request);
        if($data === 1){
            return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => 'Sub-course saved Successfully' ];
        }else{
            return [ 'msg' => 'Fail', 'status' => 500, 'flag' => 'F', 'data' => 'Sub-course not saved Successfully' ];
        }
    }

    public function actionEditcoursedtls()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = StandardcoursedtlsTbl::editcoursedtls($request);
        if($data === 1){
            return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => 'Sub-course updated Successfully' ];
        }else{
            return [ 'msg' => 'Fail', 'status' => 500, 'flag' => 'F', 'data' => 'Sub-course not updated Successfully' ];
        }
    }

    public function actionChangesubcoursestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = StandardcoursedtlsTbl::changesubcoursestatus($request);

        if ($data === 1) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Status updated Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error editing course'
            ];
        }
    }

    public function actionGetrequestfor($id){
        $data = StandardcoursemstTbl::getrequestfor($id);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $data ];
    }

    public function actionSavedocument()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = DocumentdtlsmstTbl::savedocumentdtls($request);
        if ($data === 1) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Document saved Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error saving Document'
            ];
        }
    }

    public function actionEditdocument()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = DocumentdtlsmstTbl::editdocumentdtls($request);
    
        if ($data === 1) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Document edited Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error editing Document'
            ];
        }
    }
    
    public function actionGetdocumentlist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $courseList = DocumentdtlsmstTbl::getdocumentdtls($request['id'], $limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $courseList ];
    }

    public function actionChangedocumentstatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = DocumentdtlsmstTbl::changedocumentstatus($request);

        if ($data === 1) {
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Status updated Successfully'
            ];
        } else {
            return [
                'msg' => 'error',
                'status' => 400,
                'flag' => 'E',
                'data' => 'Error editing course'
            ];
        }
    }
    
    
}