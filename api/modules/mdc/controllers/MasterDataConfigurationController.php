<?php

namespace api\modules\mdc\controllers;

use Yii;
use api\modules\mst\controllers\MasterController;
use DateTime;
use yii\db\ActiveRecord;
use app\models\ReferencemstTbl;
use app\models\ProjectmstTbl;
use app\models\CoursecategorymstTbl;
use app\models\FeesubscriptionmstTbl;
use app\models\OpalmoherigrademstTbl;
use app\models\RascategorymstTbl;
use app\models\VehiclesubcatmstTbl;



class MasterDataConfigurationController extends MasterController
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

    public function actionGetfeeslist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $feeList = FeesubscriptionmstTbl::getFeesList($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $feeList ];
    }   

    public function actionGetfeesubscription($id)
    {
        return FeesubscriptionmstTbl::getFeeSubcription($id);
    }

    public function actionSavefeesubscription()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        
        $fee = FeesubscriptionmstTbl::editFeeSubcription($request);
        if($fee){
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => $data
            ];
        }else{
            return [
                'msg' => 'error',
                'status' => 500,
                'flag' => 'F',
                'data' => 'Not updated'
            ];
        }  
    }
    
    public function actionGetproject()
    {
        return ProjectmstTbl::getProject();
    }

    public function actionGetcoursecategorylist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $feeList = CoursecategorymstTbl::getCourseCategorylist($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $feeList ];
    }

    public function actionGetcoursecategory($id)
    {
        return CoursecategorymstTbl::getCoursecategory($id);
    }

    public function actionSavecoursecategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = CoursecategorymstTbl::alreadyExist($request['course_en']);
        if(!$exist){
            $data = CoursecategorymstTbl::addCourseCategory($request);
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
            $response->data = 'Course category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditcoursecategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $course = CoursecategorymstTbl::findOne($request['id']);
        if(strtolower($request['course_en']) != strtolower($course->ccm_catname_en)){
            $exist = CoursecategorymstTbl::alreadyExist($request['course_en']);
        }
        if(!$exist){
            $data = CoursecategorymstTbl::updateCourseCategory($request);
    
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
            $response->data = 'Course Category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course Category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatecoursestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = CoursecategorymstTbl::updatecoursestatus($request);
        if($data === 1){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'There is a sub category belongs to this category is active. So cannot deactivate it';
            $response->setStatusCode(422, 'There is a sub category belongs to this category is active. So cannot deactivate it' );
            return $response;
        } else if($data === 2){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This course category mapped with a standard course. So cannot deactivate it';
            $response->setStatusCode(422, 'This course category mapped with a standard course. So cannot deactivate it' );
            return $response;
        }else if($data === 3){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This course category mapped with a centre. So cannot deactivate it';
            $response->setStatusCode(422, 'This course category mapped with a centre. So cannot deactivate it' );
            return $response;
        }else{
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Course status updated Successfully'
            ];
        }
    }

    public function actionGetcoursesubcategorylist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $feeList = CoursecategorymstTbl::getCourseSubCategorylist($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $feeList ];
    } 

    public function actionGetcoursecategories()
    {
        return CoursecategorymstTbl::getCourseCategories();
    }

    public function actionSavecoursesubcategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = CoursecategorymstTbl::alreadyExist($request['subcategoty_en']);
        if(!$exist){
            $data = CoursecategorymstTbl::addCourseSubCategory($request);
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
            $response->data = 'Course Sub category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course Sub category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditcoursesubcategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $course = CoursecategorymstTbl::findOne($request['id']);
        if(strtolower($request['subcategoty_en']) != strtolower($course->ccm_catname_en)){
            $exist = CoursecategorymstTbl::alreadyExist($request['subcategoty_en']);
        }
        if(!$exist){
            $data = CoursecategorymstTbl::updateCourseSubCategory($request);
    
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
            $response->data = 'Course Sub Category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Course Sub Category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatecoursesubcategorystatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = CoursecategorymstTbl::updatecoursesubcategorystatus($request);
        if($data === 2){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This course category mapped with a standard course. So cannot deactivate it';
            $response->setStatusCode(422, 'This course category mapped with a standard course. So cannot deactivate it' );
            return $response;
        }else if($data === 3){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This course category mapped with a centre. So cannot deactivate it';
            $response->setStatusCode(422, 'This course category mapped with a centre. So cannot deactivate it' );
            return $response;
        }else{
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Course status updated Successfully'
            ];
        }
    }

    public function actionGetmoherigradelist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $grades = OpalmoherigrademstTbl::getMoherigradelist($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $grades ];
    } 

    public function actionGetmoherigrade($id)
    {
        return OpalmoherigrademstTbl::getMoherigrade($id);
    }

    public function actionAddmoherigrade()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = OpalmoherigrademstTbl::alreadyExist($request['grade_en']);
        if(!$exist){
            $data = OpalmoherigrademstTbl::addmoherigrade($request);
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
                    'data' => 'Error saving grade'
                ];
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Moheri Grade Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Moheri Grade Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditmoherigrade()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $course = OpalmoherigrademstTbl::findOne($request['id']);
        if(strtolower($request['grade_en']) != strtolower($course->ccm_catname_en)){
            $exist = OpalmoherigrademstTbl::alreadyExist($request['grade_en']);
        }
        if(!$exist){
            $data = OpalmoherigrademstTbl::updateMoherigrade($request);
    
            if ($data === 1) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => 'Grade edited Successfully'
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 400,
                    'flag' => 'E',
                    'data' => 'Error editing Grade'
                ];
            }

        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Moheri grade Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Moheri grade Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatmoherigradestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = CoursecategorymstTbl::updatemoherigradestatus($request);
        if($data){
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Moheri grade status  updated Successfully'
            ];
        }
    }

    public function actionGetreferencelist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $mastertype = isset($request['mastertype'])? $request['mastertype'] : null;
        $grades = ReferencemstTbl::getreferencelist($mastertype, $limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $grades ];
    } 

    public function actionGetreference($id)
    {
        return ReferencemstTbl::getreference($id);
    }

    public function actionAddreference()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = ReferencemstTbl::alreadyExist($request['name_en']);
        if(!$exist){
            $data = ReferencemstTbl::addreference($request);
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
                    'data' => 'Error saving grade'
                ];
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditreference()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $course = ReferencemstTbl::findOne($request['id']);
        if(strtolower($request['name_en']) != strtolower($course->rm_name_en)){
            $exist = ReferencemstTbl::alreadyExist($request['name_en']);
        }
        if(!$exist){
            $data = ReferencemstTbl::updatereference($request);
    
            if ($data === 1) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => 'Updated Successfully'
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 400,
                    'flag' => 'E',
                    'data' => 'Error editing Grade'
                ];
            }

        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatreferencestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = ReferencemstTbl::updatereferencestatus($request);
        if($data){
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Status  updated Successfully'
            ];
        }
    }

    public function actionGetvehiclecategorylist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $vehicleList = RascategorymstTbl::getVehicleCategorylist($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $vehicleList ];
    }

    public function actionGetvehiclecategory($id)
    {
        return RascategorymstTbl::getVehiclecategory($id);
    }

    public function actionSavevehiclecategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = RascategorymstTbl::alreadyExist($request['vehicle_en']);
        if(!$exist){
            $data = RascategorymstTbl::addVehicleCategory($request);
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
                    'data' => 'Error saving vehicle'
                ];
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Vehicle category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Vehicle category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditvehiclecategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $vehicle = RascategorymstTbl::findOne($request['id']);
        if(strtolower($request['vehicle_en']) != strtolower($vehicle->rcm_coursesubcatname_en)){
            $exist = RascategorymstTbl::alreadyExist($request['vehicle_en']);
        }
        if(!$exist){
            $data = RascategorymstTbl::updateVehicleCategory($request);
    
            if ($data === 1) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => 'Vehicle edited Successfully'
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 400,
                    'flag' => 'E',
                    'data' => 'Error editing vehicle'
                ];
            }

        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Vehicle Category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Vehicle Category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatevehiclestatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = RascategorymstTbl::updatevehiclestatus($request);
        if($data === 1){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'There is a sub category belongs to this category is active. So cannot deactivate it';
            $response->setStatusCode(422, 'There is a sub category belongs to this category is active. So cannot deactivate it' );
            return $response;
        } else if($data === 2){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This vehicle category mapped with a standard vehicle. So cannot deactivate it';
            $response->setStatusCode(422, 'This vehicle category mapped with a standard vehicle. So cannot deactivate it' );
            return $response;
        }else if($data === 3){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This vehicle category mapped with a centre. So cannot deactivate it';
            $response->setStatusCode(422, 'This vehicle category mapped with a centre. So cannot deactivate it' );
            return $response;
        }else{
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'vehicle status updated Successfully'
            ];
        }
    }

    public function actionGetvehiclesubcategorylist()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $limit = isset($request['limit'])? $request['limit'] : 10;
        $index = isset($request['index'])? $request['index'] : 0;
        $searchkey = isset($request['searchkey'])? $request['searchkey'] : null;
        $sort = isset($request['sort'])? $request['sort'] : null;
        $vehicleList = VehiclesubcatmstTbl::getVehicleSubCategorylist($limit, $index, $searchkey, $sort);
        return [ 'msg' => 'sucess', 'status' => 200, 'flag' => 'S', 'data' => $vehicleList ];
    }

    public function actionGetvehiclesubcategory($id)
    {
        return VehiclesubcatmstTbl::getVehicleSubCategory($id);
    }

    public function actionSavevehiclesubcategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $exist = VehiclesubcatmstTbl::alreadyExist($request['vehicle_en']);
        if(!$exist){
            $data = VehiclesubcatmstTbl::addVehicleSubCategory($request);
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
                    'data' => 'Error saving vehicle sub category'
                ];
            }
        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Vehicle Sub category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Vehicle Sub category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }
  
    public function actionEditvehiclesubcategory()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $vehicle = VehiclesubcatmstTbl::findOne($request['id']);
        if(strtolower($request['subcategoty_ar']) != strtolower($vehicle->vscm_vehiclename_en)){
            $exist = VehiclesubcatmstTbl::alreadyExist($request['subcategoty_ar']);
        }
        if(!$exist){
            $data = VehiclesubcatmstTbl::updateVehicleSubCategory($request);
    
            if ($data === 1) {
                return [
                    'msg' => 'success',
                    'status' => 200,
                    'flag' => 'S',
                    'data' => 'Vehicle sub category edited Successfully'
                ];
            } else {
                return [
                    'msg' => 'error',
                    'status' => 400,
                    'flag' => 'E',
                    'data' => 'Error editing vehicle sub category'
                ];
            }

        }else{
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'Vehicle Sub Category Name Already Exist. Kindly give unique name';
            $response->setStatusCode(422, 'Vehicle Sub Category Name Already Exist. Kindly give unique name' );
            return $response;
        }
    }

    public function actionUpdatevehiclesubcategorystatus()
    {
        $request_body = file_get_contents('php://input');
        $request = json_decode($request_body, true);
        $data = VehiclesubcatmstTbl::updatevehiclestatus($request);
        if($data === 2){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This vehicle Sub category mapped with a standard vehicle. So cannot deactivate it';
            $response->setStatusCode(422, 'This vehicle Sub category mapped with a standard vehicle. So cannot deactivate it' );
            return $response;
        }else if($data === 3){
            $response = Yii::$app->response;
            $response->format = \yii\web\Response::FORMAT_JSON;
            $response->data = 'This vehicle Sub category mapped with a centre. So cannot deactivate it';
            $response->setStatusCode(422, 'This vehicle Sub category mapped with a centre. So cannot deactivate it' );
            return $response;
        }else{
            return [
                'msg' => 'success',
                'status' => 200,
                'flag' => 'S',
                'data' => 'Vehicle Sub categorystatus updated Successfully'
            ];
        }
    }

}