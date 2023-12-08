<?php

namespace api\modules\pms\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use \common\components\Security;
use api\modules\pms\controllers\PmsMasterController;
use api\modules\apr\controllers\ApprovalController;
use api\modules\pms\components\Pms;
use api\modules\pd\models\MemcompmplocationdtlsTblQuery;
use api\modules\pd\models\ProjecttmpTblQuery;
use common\components\Drive;
use Yii;
use PhpOffice;
ini_set('memory_limit','2048M');

class PmsController extends PmsMasterController {

    public $modelClass = '\common\models\MemcompprofcertfdtlsTbl';

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
    }

    public function beforeAction($action) {
        header('Content-type: application/json; charset=utf-8');
        Configsession::setConfigsession();
        Sessionn::setSession();

        try {
            return parent::beforeAction($action);
        } catch (BadRequestHttpException $e) {
            
        }
    }

    public function behaviors() {
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

    /**
     * @SWG\Post(
     *     path="/pms/pms/requistionadd",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Requistion Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="requistitionData", type="object",
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="req_cardtitle", type="string"),
     *                      @SWG\Property(property="req_refno", type="string"),
     *                      @SWG\Property(property="req_requester", type="string"),
     *                      @SWG\Property(property="req_priority", type="string"),
     *                      @SWG\Property(property="req_date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionRequistionadd() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['requistitionData']['req_pk']);
        $formdata['requistitionData']['req_pk'] = Security::sanitizeInput($req_pk, "number");
        $data = Pms::Requistionadd($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/productserviceadd",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Product&Service ",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="requistitionData", type="object",
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="req_cardtitle", type="string"),
     *                      @SWG\Property(property="req_refno", type="string"),
     *                      @SWG\Property(property="req_requester", type="string"),
     *                      @SWG\Property(property="req_priority", type="string"),
     *                      @SWG\Property(property="req_date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionProductserviceadd() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['formData']['req_pk']);
        $formdata['formData']['req_pk'] = Security::sanitizeInput($req_pk, "number");
        $data = Pms::AddProductServic($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/productserviceaddtemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Product&Service ",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="requistitionData", type="object",
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="req_cardtitle", type="string"),
     *                      @SWG\Property(property="req_refno", type="string"),
     *                      @SWG\Property(property="req_requester", type="string"),
     *                      @SWG\Property(property="req_priority", type="string"),
     *                      @SWG\Property(property="req_date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionProductserviceaddtemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['formData']['req_pk']);
        $formdata['formData']['req_pk'] = Security::sanitizeInput($req_pk, "number");
        $data = Pms::AddProductServictemp($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getwikiimage",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Wiki Image ",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="requistitionData", type="object",
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="req_cardtitle", type="string"),
     *                      @SWG\Property(property="req_refno", type="string"),
     *                      @SWG\Property(property="req_requester", type="string"),
     *                      @SWG\Property(property="req_priority", type="string"),
     *                      @SWG\Property(property="req_date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetwikiimage() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataName = $formdata['DataName'];
        $data = Pms::getWikiImage($dataName);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrqproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrqproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $reqpk = Security::sanitizeInput($reqpk, "number");
        $checkmap = $formdata['checkmap'];
        $type = $formdata['type'];
        $ten_id = Security::decrypt($formdata['ten_id']);
        $ten_id = Security::sanitizeInput($ten_id, "number");
        $data = Pms::getRequisitionProductList($reqpk, $checkmap, $ten_id, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $reqpk = Security::sanitizeInput($reqpk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $data = Pms::getProductList($reqpk, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getproducttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetproducttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $reqpk = Security::sanitizeInput($reqpk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $data = Pms::getProductListtemp($reqpk, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getuserlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get User List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="registerPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetuserlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $registerPk = Security::decrypt($formdata['registerPk']);
        $registerPk = Security::sanitizeInput($registerPk, "number");
        $data = Pms::getUserList($registerPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getproductdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Product Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="proPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetproductdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::GetProductData($formdata['proPk'], $formdata['prdserpk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getproductdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Product Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="proPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetproductmstdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::GetProductMstData($formdata['proPk']);
        return $data;
    }
    public static function actionGetservicemstdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::GetserviceMstData($formdata['servPk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getservicedata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Service Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="servicePk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetservicedata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::GetServiceData($formdata['servicePk'], $formdata['prdserpk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getspecificationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Product Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="catPk", type="string"),
     *                  @SWG\Property(property="type", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetspecificationdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::GetSpecificationData($formdata['catPk'], $formdata['productserivePk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getlocationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Location Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="location_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetlocationdatabypk() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $locationPk = Security::decrypt($formdata['locationPk']);
        $locationPk = Security::sanitizeInput($locationPk, "number");
        $data = Pms::getLocationDataByPk($locationPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/unmaplocationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Unmapping Location Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="location_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionUnmaplocationdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['req_pk']);
        $req_pk = Security::sanitizeInput($req_pk, "number");
        $data = Pms::unmaplocationdata($req_pk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdepartmentlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get User List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="compPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdepartmentlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $compPk = Security::decrypt($formdata['compPk']);
        $compPk = Security::sanitizeInput($compPk, "number");
        $data = Pms::getDepartmentList($compPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdisicplinelist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get User List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="compPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdisicplinelist() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = Pms::getdisicplinelist($companypk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getcostcentrelist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get User List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="compPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcostcentrelist() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = Pms::getcostcentrelist($companypk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getreqdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetreqdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $reqpk = Security::sanitizeInput($reqpk, "number");
        $data = Pms::getReqData($reqpk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getreqlistdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition List Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetreqlistdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpks = $formdata['reqpks'];
        // $reqpks = Security::decrypt($formdata['reqpks']);
        // $reqpk = Security::sanitizeInput($reqpk, "number");
        $data = Pms::getreqlistdata($reqpks);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getproject",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Project Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetproject() {
        $data = Pms::getProject();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getoverallproject",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Overall Project Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetoverallproject() {
        $data = Pms::getOverallProject();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getrecentlyviewed",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Recently Viewed",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrecentlyviewed() {
        $data = Pms::getRecentlyViewed();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getallproject",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Overall Project Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetallproject() {
        $data = Pms::getProjectList();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/mapproject",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Overall Project Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionMapproject() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::mapproject($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getunitdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Unit Master Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetunitdata() {
        $data = Pms::getUnitMasterData();
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsupplierlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $searchkey = $formdata['searchkey'];
        $data = Pms::getSupplierList($searchkey);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsupplierlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierlistbyid() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $ids = $formdata['ids'];
        $data = Pms::getSupplierListbyid($ids);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/deletemapspec",
     *     tags={"Delete Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletemapspec() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $spctblpk = Security::decrypt($formdata['sptbl']);
        $spctblpk = Security::sanitizeInput($spctblpk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::Deletemapspec($spctblpk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/deleteproservice",
     *     tags={"Delete Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteproservice() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::DeleteProService($formdata['proservicePk']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/deleteproservicetemp",
     *     tags={"Delete Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteproservicetemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::DeleteProServicetemp($formdata['proservicePk']);
        return $data;
    }


    /**
     * @SWG\Get(
     *     path="/pms/pms/getcompanylist",
     *     tags={"Delete Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcompanylist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::getCompanyList($formdata['searchValue']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updatequantity",
     *     tags={"Update Quantity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdatequantity() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateQuantity($proservicePk, $formdata['value']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updatequantitytemp",
     *     tags={"Update Quantity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdatequantitytemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateQuantitytemp($proservicePk, $formdata['value']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updaterequireddate",
     *     tags={"Update Required Date "},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdaterequireddate() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateRequireddate($proservicePk, $formdata['value']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updaterequireddatetemp",
     *     tags={"Update Required Date "},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdaterequireddatetemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateRequireddatetemp($proservicePk, $formdata['value']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getprojectbasedtenderarray",
     *     tags={"Update Quantity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprojectbasedtenderarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['projectPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $data = Pms::getProjectBasedTenderArray($dataPk,$formdata['dataType']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updatemeasurement",
     *     tags={"Update Quantity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdatemeasurement() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateMeasurement($proservicePk, $formdata['value']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/updatemeasurementtemp",
     *     tags={"Update Quantity"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "sptbl", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdatemeasurementtemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proservicePk = Security::decrypt($formdata['proservicePk']);
        $proservicePk = Security::sanitizeInput($proservicePk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::UpdateMeasurementtemp($proservicePk, $formdata['value']);
        return $data;
    }


    /**
     * @SWG\Get(
     *     path="/pms/pms/getuserdefspecmst",
     *     tags={"Get User Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "type", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "catPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetuserdefspecmst() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedpk = Security::decrypt($formdata['catPk']);
        $sharedpk = Security::sanitizeInput($sharedpk, "number"); // Send Product or service Master PK
        $type = $formdata['type']; // P-> Product / S->service
        $data = Pms::GetUserDefSpecmst($sharedpk, $type);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getchechkinentity",
     *     tags={"Get User Specificaion"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Specificaion",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "type", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "catPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetchechkinentity() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $data = Pms::getChechkinEntity($contractPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getviewrfidata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI View Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetviewrfidata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenderHeaderPk = Security::decrypt($formdata['tendeheaderPk']);
        $tenderHeaderPk = Security::sanitizeInput($tenderHeaderPk, "number");
        $data = Pms::GetViewRFIdata($tenderHeaderPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getviewrfpdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFP View Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetviewrfpdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenderHeaderPk = Security::decrypt($formdata['tendeheaderPk']);
        $tenderHeaderPk = Security::sanitizeInput($tenderHeaderPk, "number");
        $data = Pms::GetViewRFPdata($tenderHeaderPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getviewpqdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get PQ View Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetviewpqdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenderHeaderPk = Security::decrypt($formdata['tendeheaderPk']);
        $tenderHeaderPk = Security::sanitizeInput($tenderHeaderPk, "number");
        $data = Pms::GetViewPQdata($tenderHeaderPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getviewcontractsdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Contracts View Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetviewcontractsdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::getViewContractsData($contractPk);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getsubcountdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Sub Count Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetsubcountdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getSubCountData($dataPk);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getcontractordata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Sub Count Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcontractordata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getContractorData($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getprojectbasedcontractor",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprojectbasedcontractor() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getProjectBasedContractor($dataPk);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getawardissued",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetawardissued() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getAwardIssued($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getobligatedenquiries",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetobligatedenquiries() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getObligatedEnquiries($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/gettotalrequisition",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettotalrequisition() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getTotalRequisition($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/gettendercount",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettendercount() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getTenderCount($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getpendingevaluation",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetpendingevaluation() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getPendingEvaluation($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getissuedenquiries",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Based Contractor List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "dataPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetissuedenquiries() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getIssuedEnquiries($dataPk,$formdata['dataType']);
            return $data;
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong',
            );
        }
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getvieweoidata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get EOI View Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetvieweoidata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenderHeaderPk = Security::decrypt($formdata['tendeheaderPk']);
        $tenderHeaderPk = Security::sanitizeInput($tenderHeaderPk, "number");
        $data = Pms::GetViewEOIdata($tenderHeaderPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getprojectdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprojectdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proPk = Security::decrypt($formdata['proPk']);
        $proPk = Security::sanitizeInput($proPk, "number");
        $data = Pms::GetProjectData($proPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getprojectdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Project Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprojectreqdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $proPk = Security::decrypt($formdata['proPk']);
        $proPk = Security::sanitizeInput($proPk, "number");
        $data = Pms::GetProjectreqData($proPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getproductlist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetproductlist() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::GetReqProductData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/get-view-product-list",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetViewProductList() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getViewProductData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/get-view-product-listtemp",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetViewProductListtemp() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getViewProductDatatemp($formdata['reqPk'], 3);
        return $data;
    }

     /**
     * @SWG\Get(
     *     path="/pms/pms/get-view-product-listtemplist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "tendeheaderPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetViewProductListtemplist() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getViewProductDatalisting($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getrfilistdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetrfilistdata() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getRFIListData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getagreementlist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAgreementlist() {
        $formdata = $_REQUEST;
        $tednerFk = Security::decrypt($formdata['tednerFk']);
        $formdata['tednerFk'] = Security::sanitizeInput($tednerFk, "number");
        $data = Pms::agreementList($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getcontractlistdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcontractlistdata() {
        
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getContractListData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getmanagelisting",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetmanagelisting() {
        $formdata = $_REQUEST;
        $data = Pms::getManageListing($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/geteoilistdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGeteoilistdata() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getEOIListData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/gettenderlist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettenderlist() {
        $formdata = $_REQUEST;
        if($formdata['from_page_value'] != 2) {
            $proPk = Security::decrypt($formdata['proPk']);
            $formdata['proPk'] = Security::sanitizeInput($proPk, "number");
        }
        $data = Pms::GetTenderDataArray($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getactiverfxcount",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFx Active Count",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetactiverfxcount() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['reqPk']);
        $type = $formdata['type'];
        $data = Pms::getActiverfxCount($req_pk, $type);
        return $data;
    } 

    /**
     * @SWG\Get(
     *     path="/pms/pms/getcategoryList",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcategorylist() {
        $data = Pms::getCategoryList();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getrequserlist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get User List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetrequserlist() {
        $data = Pms::getReqUserList();
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/rfiadd",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Requistion Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="rfiData", type="object",
     *                      @SWG\Property(property="req_id", type="string"),
     *                      @SWG\Property(property="rficardtit", type="string"),
     *                      @SWG\Property(property="rficardrefno", type="string"),
     *                      @SWG\Property(property="rfi_initiateby", type="string"),
     *                      @SWG\Property(property="initiate_Date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionRfiadd() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        // $req_pk = Security::decrypt($formdata['rfiData']['req_id']);
        $formdata['rfiData']['req_id'] = Security::sanitizeInput($formdata['rfiData']['req_id'], "number");
        $data = Pms::rfiadd($formdata);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/restrictawardingcontract",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Requistion Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="regPk", type="string",
     *                  @SWG\Property(property="supplierRegPk", type="string",
     *                  @SWG\Property(property="tenderPk", type="string",
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionRestrictawardingcontract() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $regPk = Security::decrypt($formdata['regPk']);
        $supplierRegPk = Security::decrypt($formdata['supplierRegPk']);
        $tenderPk = Security::decrypt($formdata['tenderPk']);
        $formdata['regPk'] = Security::sanitizeInput($regPk, "number");
        $formdata['supplierRegPk'] = Security::sanitizeInput($supplierRegPk, "number");
        $formdata['tenderPk'] = Security::sanitizeInput($tenderPk, "number");
        $data = Pms::restrictAwardingContract($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfidata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfidata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $type = $formdata['type'];
        $data = Pms::getrfiData($tenpk, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfidatafortender",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfidatafortender() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $type = $formdata['type'];
        $data = Pms::getrfidatafortender($tenpk, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfidatafortendertemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfidatafortendertemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $type = $formdata['type'];
        $data = Pms::getrfidatafortendertemp($tenpk, $type);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfxdatafortender",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFx List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfxdatafortender() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $page = Security::sanitizeInput($formdata['page'], "number");
        $perpage = Security::sanitizeInput($formdata['perpage'], "number");
        $sortorder = Security::sanitizeInput($formdata['sortorder'], "number");
        $data = Pms::getrfxdatafortender($tenpk, $type, $page, $perpage, $sortorder);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfxdatafortendertemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFx List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfxdatafortendertemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $page = Security::sanitizeInput($formdata['page'], "number");
        $perpage = Security::sanitizeInput($formdata['perpage'], "number");
        $sortorder = Security::sanitizeInput($formdata['sortorder'], "number");
        $data = Pms::getrfxdatafortendertemp($tenpk, $type, $page, $perpage, $sortorder);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfxdatafortendercount",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFx List count",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfxdatafortendercount() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $data = Pms::getrfxdatafortendercount($tenpk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfxdatafortendercount",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFx List count",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="ten_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrfxdatafortendercounttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenpk = Security::decrypt($formdata['ten_pk']);
        $tenpk = Security::sanitizeInput($tenpk, "number");
        $data = Pms::getrfxdatafortendercounttemp($tenpk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/gettimezones",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGettimezones() {
        $data = Pms::gettimezones();
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletereqproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Requistion Product Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                @SWG\Property(property="proserids", type="string"),
     *           ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletereqproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $deleteproductids = $formdata['proserids'];
        $data = Pms::deletereqproduct($deleteproductids);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletereqaddinfo",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Requistion Additional Info",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                @SWG\Property(property="addinfopk", type="string"),
     *           ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletereqaddinfo() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $deleteaddinfopk = $formdata['addinfopk'];
        $data = Pms::deletereqaddinfo($deleteaddinfopk);
        return $data;
    }

     /**
     * @SWG\Post(
     *     path="/pms/pms/deleteenquiry",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete tender enquiry",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                @SWG\Property(property="ten_id", type="string"),
     *           ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteenquiry() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $deletetenpk = $formdata['ten_id'];
        $data = Pms::deletetenquiry($deletetenpk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deleteenquirytemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete tender enquiry",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                @SWG\Property(property="ten_id", type="string"),
     *           ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteenquirytemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $deletetenpk = $formdata['ten_id'];
        $data = Pms::deletetenquirytemp($deletetenpk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/mapreqproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Map Requistion Product Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                @SWG\Property(property="proserids", type="string"),
     *           ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionMapreqproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $prodarray = $formdata['prodarray'];
        $tenPk = $formdata['ten_id'];
        $data = Pms::mapreqproduct($prodarray, $tenPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/addquestionnarie",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Questionnarie",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAddquestionnarie() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::addquestionnarie($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/addquestionnarietemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Questionnarie",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAddquestionnarietemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::addquestionnarietemp($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getexistingquestion",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetexistingquestion() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata) {
            $data = Pms::getexistingquestion($formdata);
            return $data;
        }
    }

     /**
     * @SWG\Post(
     *     path="/pms/pms/getexistingquestiontemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetexistingquestiontemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata) {
            $data = Pms::getexistingquestiontemp($formdata);
            return $data;
        }
    }

    public static function actionDeletequestionanarie() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata) {
            $data = Pms::deletequestionnarie($formdata);
            return $data;
        }
    }

    public function actionGetviewoffloc() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        return MemcompmplocationdtlsTblQuery::getviewoffloc($data);
    }

    public function actionEditoverallproject() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        return ProjecttmpTblQuery::Editoverallproject($data);
    }

    public function actionGetachiveacred() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        return ProjecttmpTblQuery::getachiveacred($data);
    }

    public function actionGetsearchresult() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = [];
        if ($formdata) {
            $criteriaType = Security::decrypt($formdata['criteriaType']);
            $criteriaType = Security::sanitizeInput($criteriaType, 'number');

            $searchType = Security::decrypt($formdata['searchType']);
            $searchType = Security::sanitizeInput($searchType, 'number');

            $searchFrom = Security::decrypt($formdata['searchFrom']);
            $searchFrom = Security::sanitizeInput($searchFrom, 'number');

            $triggerFrom = Security::decrypt($formdata['triggerFrom']);
            $triggerFrom = Security::sanitizeInput($triggerFrom, 'number');

            $searchPage = Security::sanitizeInput($formdata['searchPage'], 'number');

            if (isset($formdata['searchSort']) && $formdata['searchSort'] == 'Desc') {
                $searchSort = 'Desc';
            } else {
                $searchSort = 'ASC';
            }

            $searchKey = $formdata['searchKey'];
            $filterSrh = $formdata['filterSrh'];
            if ($criteriaType > 0 && $searchType > 0 && $searchFrom > 0 && $triggerFrom > 0 && $searchPage >= 0) {
                $data['searchResult'] = Pms::getBizSearchData($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh);
                $message = 'Success';
                $status = 100;
            } else {
                $data['resStr'] = [$criteriaType, $searchType, $searchFrom, $triggerFrom, $searchPage];
                $message = 'sanitize error';
                $status = 106;
            }
        } else {
            $message = 'Fields are missing';
            $status = 101;
        }

        return $this->asJson([
                    'data' => $data,
                    'msg' => $message,
                    'status' => $status,
        ]);
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getcontractdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Contract Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "pojectPk", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "pojectPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcontractdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $data = Pms::GetContractData($reqPk, $contractPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getnonjsrssupplierdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Supplier Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetnonjsrssupplierdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $supplierPk = Security::decrypt($formdata['supplierPk']);
        $supplierPk = Security::sanitizeInput($supplierPk, "number");
        $data = Pms::getNonJsrsSupplierData($supplierPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getsupplierdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Supplier Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetsupplierdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $supplierPk = Security::decrypt($formdata['supplierPk']);
        $supplierPk = Security::sanitizeInput($supplierPk, "number");
        $data = Pms::GetSupplierData($supplierPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getincorpstyleList",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Incorpstyle List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetincorpstylelist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $countryPK = Security::decrypt($formdata['countryPK']);
        $countryPK = Security::sanitizeInput($countryPK, "number");
        $data = Pms::getIncorpStyleList($countryPK);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getsupplieruserdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Supplier User Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetsupplieruserdata() {
        // echo  Security::encrypt(502);die;
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $supplierPk = Security::decrypt($formdata['supplierPk']);
        $supplierPk = Security::sanitizeInput($supplierPk, "number");
        $data = Pms::GetSupplierUserData($supplierPk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/gettermscondition",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Terms & Condition",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettermscondition() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $data = Pms::getTermsCondition($sharedFk, $formdata['type']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/gettermsconditiontemp",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Terms & Condition",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "supplierPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettermsconditiontemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $data = Pms::getTermsConditiontemp($sharedFk, $formdata['type']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getformarray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Form Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "type", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetformarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $type = Security::decrypt($formdata['type']);
        $type = Security::sanitizeInput($type, "number");
        $data = Pms::getFormArrayData($type);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getcurrencyarray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Currency Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcurrencyarray() {
        $data = Pms::getCurrencyArray();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getprimarysupplier",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Currency Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprimarysupplier() {
        $data = Pms::getPrimarySupplierArray();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getlocationarray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Location Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetlocationarray() {
        $data = Pms::getLocationArray();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getawardedtocomparray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetawardedtocomparray() {
        $data = Pms::getAwardedtoCompArray();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getstatistics",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetstatistics() {
        $data = Pms::getstatistics();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getautocompletearray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetautocompletearray() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = Pms::getAutocompleteArray($companypk);
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getsuppliercreatstatus",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetsuppliercreatstatus() {
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $data = Pms::getSupplierCreatStatus($regPk);
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getprojectarray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Autocomplete Data Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetprojectarray() {
        $regPk = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
        $data = Pms::getProjectArray($regPk);
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/pms/pms/getcontractarray",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Contract Array",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcontractarray() {
        $comPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $data = Pms::getContractArray($comPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitterms",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitterms() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata) {
            $data = Pms::submitTerms($formdata);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submittermstemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmittermstemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata) {
            $data = Pms::submitTermstemp($formdata);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getawardedtoarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="contractPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetawardedtoarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::getAwardedtoArray($contractPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrftdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrftdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        if ($reqPk) {
            $data = Pms::getRFTData($reqPk,$formdata['dataType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrftdatapk",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrftdatapk() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $quotPk = Security::decrypt($formdata['quotPk']);
        $quotPk = Security::sanitizeInput($quotPk, "number");
        if ($quotPk) {
            $data = Pms::getRFTDataPk($quotPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getquotationarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetquotationarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $rftPk = Security::decrypt($formdata['rftPk']);
        $rftPk = Security::sanitizeInput($rftPk, "number");
        if ($rftPk) {
            $data = Pms::getQuotationArray($rftPk);
            return $data;
        }
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/getquotationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetquotationdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $quotPk = Security::decrypt($formdata['quotPk']);
        $quotPk = Security::sanitizeInput($quotPk, "number");
        if ($quotPk) {
            $data = Pms::getQuotationData($quotPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsubmitedcontractor",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsubmitedcontractor() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::getSubmitedContractor($contractPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getagreement",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="dataVal", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetagreement() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['dataVal']) {
            $data = Pms::getAgreement($formdata['dataVal']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrftdataarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                 @SWG\Property(property="reqPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrftdataarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        if ($reqPk) {
            $data = Pms::getRFTDataArray($reqPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savesupportingdocument",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavesupportingdocument() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata) {
            $data = Pms::saveSupportingDocument($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savesupportingdocumenttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Terms",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavesupportingdocumenttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata) {
            $data = Pms::saveSupportingDocumenttemp($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletescopeproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Scope Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="deletePk", type="string",
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletescopeproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $deletePk = Security::decrypt($formdata['deletePk']);
        $deletePk = Security::sanitizeInput($deletePk, "number");
        if ($deletePk) {
            $data = Pms::DeleteScopProduct($deletePk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getcontractproduct",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcontractproduct() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $data = Pms::getContractProduct($reqPk, $contractPk, $formdata['dataType'], $formdata['quotselectPk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getviewproductservicedata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="paymentTerms", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetviewproductservicedata() {
        $formdata = $_REQUEST;
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['contractPk'] = $contractPk;
        $data = Pms::getViewProductServiceData($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/gettenderpscharges",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGettenderpscharges() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $data = Pms::getTenderPSCharges($contractPk, $formdata['dataType']);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/deletetenderpscharges",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Tender PS Charges",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletetenderpscharges() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPK = Security::decrypt($formdata['dataPK']);
        $dataPK = Security::sanitizeInput($dataPK, "number");
        $data = Pms::deleteTenderPScharges($dataPK);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getlocationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetlocationdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $locationPk = $formdata['locationPk']? Security::decrypt($formdata['locationPk']) : Security::decrypt($formdata['location_pk']);
        $locationPk = Security::sanitizeInput($locationPk, "number");
        $data = Pms::GetLocationData($locationPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getcontractproductchk",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Product",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqPk", type="string",
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcontractproductchk() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getContractProductChk($reqPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitscope",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Scope",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="datatableType", type="object"),
     *                      @SWG\Property(property="tableData", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitscope() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::submitScope($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitscopeonline",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Scope",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="datatableType", type="object"),
     *                      @SWG\Property(property="tableData", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitscopeonline() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::submitScopeOnline($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savecontractinfo",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Scope",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="datatableType", type="object"),
     *                      @SWG\Property(property="tableData", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavecontractinfo() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::saveContractInfo($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitsupplierform",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Supplier Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="crNumber", type="string"),
     *                      @SWG\Property(property="companyname", type="string"),
     *                      @SWG\Property(property="address", type="string"),
     *                      @SWG\Property(property="country", type="string"),
     *                      @SWG\Property(property="compEmail", type="string"),
     *                      @SWG\Property(property="contactName", type="string"),
     *                      @SWG\Property(property="contactDesignation", type="string"),
     *                      @SWG\Property(property="contactEmail", type="string"),
     *                      @SWG\Property(property="mobile_cc", type="string"),
     *                      @SWG\Property(property="mobileNo", type="string"),
     *                      @SWG\Property(property="classification", type="string"),
     *                      @SWG\Property(property="specialStatus", type="string"),
     *                      @SWG\Property(property="incorporationStyle", type="string"),
     *                      @SWG\Property(property="ecsScore", type="string"),
     *                      @SWG\Property(property="supplierPk", type="string"),
     *                      @SWG\Property(property="contractPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitsupplierform() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata['formData']['supplierPk'] != null && $formdata['formData']['supplierPk'] != '') {
            $supplierPk = Security::decrypt($formdata['formData']['supplierPk']);
            $supplierPk = Security::sanitizeInput($supplierPk, "number");
            $formdata['formData']['supplierPk'] = $supplierPk;
        }
        if ($formdata) {
            $data = Pms::submitSupplierForm($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitcontractcard",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Contract Card",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contcardtit", type="string"),
     *                      @SWG\Property(property="contcardrefno", type="string"),
     *                      @SWG\Property(property="cont_initiateby", type="string"),
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="cont_contracType", type="number"),
     *                      @SWG\Property(property="initiate_Date", type="string"),
     *                      @SWG\Property(property="cont_method", type="number"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitcontractcard() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['formData']['req_pk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        $formdata['formData']['req_pk'] = $reqPk;
        if ($formdata['formData']['contractPk'] != null) {
            $contractPk = Security::decrypt($formdata['formData']['contractPk']);
            $contractPk = Security::sanitizeInput($contractPk, "number");
            $formdata['formData']['contractPk'] = $contractPk;
        }
        if ($formdata['formData']['quotationhdrFk'] != null) {
            $quotationhdrFk = Security::decrypt($formdata['formData']['quotationhdrFk']);
            $quotationhdrFk = Security::sanitizeInput($quotationhdrFk, "number");
            $formdata['formData']['quotationhdrFk'] = $quotationhdrFk;
        }
        if ($formdata) {
            $data = Pms::submitContractCard($formdata['formData']);
            return $data;
        }
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/submitcardstatus",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Contract Card Status",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="dataPk", type="string"),
     *                      @SWG\Property(property="dataComments", type="string"),
     *                      @SWG\Property(property="dataStaus", type="number"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitcardstatus() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['formData']['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $formdata['formData']['dataPk'] = $dataPk;
        if ($formdata) {
            $data = Pms::submitCardStatus($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/saveofflineagreement",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Contract Card",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="refNumber", type="string"),
     *                      @SWG\Property(property="agreementIssueDate", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="startDate", type="string"),
     *                      @SWG\Property(property="endDate", type="string"),
     *                      @SWG\Property(property="totalAgreementVal", type="number"),
     *                      @SWG\Property(property="createdBy", type="string"),
     *                      @SWG\Property(property="primerySuppler", type="number"),
     *                      @SWG\Property(property="secondarySuppler", type="number"),
     *                      @SWG\Property(property="uploadPk", type="number"),
     *                      @SWG\Property(property="currencyPk", type="number"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveofflineagreement() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $agreementPk = Security::decrypt($formdata['formData']['agreementPk']);
        $agreementPk = Security::sanitizeInput($agreementPk, "number");
        $formdata['formData']['agreementPk'] = $agreementPk;
        if ($formdata) {
            $data = Pms::saveOfflineAgreement($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitdynamicform",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formPk", type="string"),
     *                      @SWG\Property(property="sharedFk", type="string"),
     *                      @SWG\Property(property="dynamicPk", type="string"),
     *                      @SWG\Property(property="dataType", type="number"),
     *                      @SWG\Property(property="fileupload", type="object"),
     *                      @SWG\Property(property="descContent", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitdynamicform() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formPk = Security::decrypt($formdata['formData']['formPk']);
        $formPk = Security::sanitizeInput($formPk, "number");
        $formdata['formData']['formPk'] = $formPk;
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata['formData']['dynamicPk'] != null) {
            $dynamicPk = Security::decrypt($formdata['formData']['dynamicPk']);
            $dynamicPk = Security::sanitizeInput($dynamicPk, "number");
            $formdata['formData']['dynamicPk'] = $dynamicPk;
        }
        if ($formdata) {
            $data = Pms::SubmitDynamicForm($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitdynamicformtemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formPk", type="string"),
     *                      @SWG\Property(property="sharedFk", type="string"),
     *                      @SWG\Property(property="dynamicPk", type="string"),
     *                      @SWG\Property(property="dataType", type="number"),
     *                      @SWG\Property(property="fileupload", type="object"),
     *                      @SWG\Property(property="descContent", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitdynamicformtemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formPk = Security::decrypt($formdata['formData']['formPk']);
        $formPk = Security::sanitizeInput($formPk, "number");
        $formdata['formData']['formPk'] = $formPk;
        $sharedFk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        $formdata['formData']['sharedFk'] = $sharedFk;
        if ($formdata['formData']['dynamicPk'] != null) {
            $dynamicPk = Security::decrypt($formdata['formData']['dynamicPk']);
            $dynamicPk = Security::sanitizeInput($dynamicPk, "number");
            $formdata['formData']['dynamicPk'] = $dynamicPk;
        }
        if ($formdata) {
            $data = Pms::SubmitDynamicFormtemp($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdynamicviewlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdynamicviewlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        if ($sharedFk) {
            $data = Pms::getDynamicViewList($sharedFk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdynamiclist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdynamiclist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        if ($sharedFk) {
            $data = Pms::getDynamicList($sharedFk,$formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdynamiclisttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdynamiclisttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedFk = Security::decrypt($formdata['sharedFk']);
        $sharedFk = Security::sanitizeInput($sharedFk, "number");
        if ($sharedFk) {
            $data = Pms::getDynamicListtemp($sharedFk,$formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getnotifyuserarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetnotifyuserarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['userPk']) {
            $data = Pms::getNotifyUserArray($formdata['userPk']);
            return $data ? $data : ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'E', 'status' => false];
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'flag' => 'E', 'status' => false];
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsupplierdocumentlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier Document List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierdocumentlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getSupplierDocumentList($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsupplierdocumentlisttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier Document List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierdocumentlisttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getSupplierDocumentListtemp($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getsupplierdocumentviewlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier Document List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierdocumentviewlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedFk']);
        $exSharedFk = Security::sanitizeInput($exSharedFk, "number");
        if ($sharedfk) {
            $data = Pms::getSupplierDocumentViewList($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getinspectionrequirenment",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetinspectionrequirenment() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getInspectionRequirenmentList($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getinspectionrequirenmenttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetinspectionrequirenmenttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getInspectionRequirenmentListtemp($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getContatData",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcontatdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::getContatData($dataPk, $formdata['dataType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getcontactaftersave",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcontactaftersave() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getContactAfterSave($sharedfk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getcontatdataarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetcontatdataarray() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $companyPk = Security::decrypt($formdata['companyPk']);
        $companyPk = Security::sanitizeInput($companyPk, "number");
        if ($companyPk) {
            $data = Pms::getContatDataArray($companyPk, $formdata['dataType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getinspectionrequirenmentview",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Inspection Requirenment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetinspectionrequirenmentview() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedFk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::getInspectionRequirenmentViewList($sharedfk, $formdata['dataType'], $formdata['formType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletedynamicdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletedynamicdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteDynamicData($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletedynamicdatatemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="sharedFk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletedynamicdatatemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteDynamicDatatemp($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletecontact",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletecontact() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteContactData($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deleteawarded",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteawarded() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($contractPk && $dataPk) {
            $data = Pms::deleteAwarded($contractPk, $dataPk, $formdata['dataType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deleteinspecationmapdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Inspecation Map Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteinspecationmapdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteiInspecationMapData($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savenotifyuser",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Notify User",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="userPk", type="string"),
     *                      @SWG\Property(property="contractPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavenotifyuser() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::saveNotifyUser($contractPk, $formdata['userPk'], $formdata['dataType']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/saveawardedto",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Notify User",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="primeryPk", type="string"),
     *                      @SWG\Property(property="secondaryPk", type="string"),
     *                      @SWG\Property(property="contractPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveawardedto() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($contractPk) {
            $data = Pms::SaveAwardedTo($formdata['formData'], $formdata['dataType'], $formdata['primeryPk'], $formdata['secondaryPk']);
            return $data;
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitcontractfinalsave",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Contract Final Save",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="optonSelection", type="string"),
     *                      @SWG\Property(property="timeZone", type="string"),
     *                      @SWG\Property(property="submittedOn", type="string"),
     *              ),
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitcontractfinalsave() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::submitContractFinalSave($contractPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savesubcontractrule",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Notify User",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="subRequirement", type="string"),
     *                      @SWG\Property(property="classification", type="string"),
     *                      @SWG\Property(property="req_percentage", type="string"),
     *                      @SWG\Property(property="etenderMandate", type="string"),
     *                      @SWG\Property(property="oblicationScope", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavesubcontractrule() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::saveSubcontractRule($formdata['formData']);
            return $data;
        }
    }

     public static function actionSavecontractoricvcommitement() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::SaveContractorICVCommitement($formdata['formData']);
            return $data;
        }
    }

    public static function actionUpdateicvcommitementvalue() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        // $contractPk = Security::decrypt($formdata['formData']['contractPk']);
        // $contractPk = Security::sanitizeInput($contractPk, "number");
        // $formdata['formData']['contractPk'] = $contractPk;
        if ($formdata) {
            $data = Pms::Updateicvcommitementvalue($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/chklccstatus",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Notify User",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="contractPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */


    public static function actionGeticvstatus() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        //$contractPk = Security::decrypt($formdata['formData']['contractPk']);
        //$contractPk = Security::sanitizeInput($contractPk, "number");
        //$formdata['formData']['contractPk'] = $contractPk;
    
        if (!empty($formdata)) {
            //print_r($formdata);die;
            $data = Pms::GetIcvStatus($formdata);
            return $data;
        }
    }

    public static function actionChklccstatus() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $contractPk = Security::decrypt($formdata['conPk']);
        $contractPk = Security::sanitizeInput($contractPk, "number");
        if ($contractPk) {
            $data = Pms::chkLccStatus($contractPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deleteinspecationdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Inspecation Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteinspecationdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteInspecationData($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deleteinspecationdatatemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Inspecation Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeleteinspecationdatatemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteInspecationDatatemp($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletesupplierdocumentdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Supplier Document Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletesupplierdocumentdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteSupplierDocumentData($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletesupplierdocumentdatatemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Delete Supplier Document Data",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionDeletesupplierdocumentdatatemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        if ($dataPk) {
            $data = Pms::deleteSupplierDocumentDatatemp($dataPk);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitsupplierdocument",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Supplier Document Requirment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="date", type="string"),
     *                      @SWG\Property(property="issuedBy", type="number"),
     *                      @SWG\Property(property="ref_num", type="string"),
     *                      @SWG\Property(property="documentCategory", type="string"),
     *                      @SWG\Property(property="documentCode", type="string"),
     *                      @SWG\Property(property="description", type="string"),
     *                      @SWG\Property(property="subType", type="number"),
     *                      @SWG\Property(property="subQuantity", type="string"),
     *                      @SWG\Property(property="reqinterval", type="string"),
     *                      @SWG\Property(property="reqintervaltype", type="number"),
     *                      @SWG\Property(property="reviewClass", type="number"),
     *                      @SWG\Property(property="remarks", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitsupplierdocument() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        $formdata['formData']['sharedFk'] = $sharedfk;
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata['formData']['dtlsPk'] != null) {
            $dtlsPk = Security::decrypt($formdata['formData']['dtlsPk']);
            $dtlsPk = Security::sanitizeInput($dtlsPk, "number");
            $formdata['formData']['dtlsPk'] = $dtlsPk;
        }
        if ($formdata) {
            $data = Pms::submitSupplierDocument($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/submitsupplierdocumenttemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Supplier Document Requirment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="date", type="string"),
     *                      @SWG\Property(property="issuedBy", type="number"),
     *                      @SWG\Property(property="ref_num", type="string"),
     *                      @SWG\Property(property="documentCategory", type="string"),
     *                      @SWG\Property(property="documentCode", type="string"),
     *                      @SWG\Property(property="description", type="string"),
     *                      @SWG\Property(property="subType", type="number"),
     *                      @SWG\Property(property="subQuantity", type="string"),
     *                      @SWG\Property(property="reqinterval", type="string"),
     *                      @SWG\Property(property="reqintervaltype", type="number"),
     *                      @SWG\Property(property="reviewClass", type="number"),
     *                      @SWG\Property(property="remarks", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSubmitsupplierdocumenttemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        $formdata['formData']['sharedFk'] = $sharedfk;
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata['formData']['dtlsPk'] != null) {
            $dtlsPk = Security::decrypt($formdata['formData']['dtlsPk']);
            $dtlsPk = Security::sanitizeInput($dtlsPk, "number");
            $formdata['formData']['dtlsPk'] = $dtlsPk;
        }
        if ($formdata) {
            $data = Pms::submitSupplierDocumenttemp($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/savecontactdata",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Supplier Document Requirment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavecontactdata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['formData']['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $formdata['formData']['dataPk'] = $dataPk;
        if ($formdata) {
            $data = Pms::saveContactData($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/saveconsigneenotifyingparty",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Supplier Document Requirment",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveconsigneenotifyingparty() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        if ($sharedfk) {
            $data = Pms::saveConsigneeNotifyingParty($sharedfk, $formdata['consigneePk'], $formdata['notifyingpartyPk']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/saveinspectionreq",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Inspection Requirement",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="itp_date", type="string"),
     *                      @SWG\Property(property="itp_issuedBy", type="number"),
     *                      @SWG\Property(property="itp_ref_num", type="string"),
     *                      @SWG\Property(property="techNotes", type="string"),
     *                      @SWG\Property(property="generalNotes", type="string"),
     *                      @SWG\Property(property="appSpecifications", type="string"),
     *                      @SWG\Property(property="remarks", type="number"),
     *                      @SWG\Property(property="activityNo", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="refDoc", type="number"),
     *                      @SWG\Property(property="quontumChkArray", type="object"
     *                      @SWG\Property(property="dataPK", type="string"),
     *                      @SWG\Property(property="quontum", type="string"),
     *                      @SWG\Property(property="action", type="string"),
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveinspectionreq() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata['formData']['dtlsPk'] != null) {
            $dtlsPk = Security::decrypt($formdata['formData']['dtlsPk']);
            $dtlsPk = Security::sanitizeInput($dtlsPk, "number");
            $formdata['formData']['dtlsPk'] = $dtlsPk;
        }
        if ($formdata) {
            $data = Pms::saveInspectionReq($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/saveinspectionreqtemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Inspection Requirement",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="itp_date", type="string"),
     *                      @SWG\Property(property="itp_issuedBy", type="number"),
     *                      @SWG\Property(property="itp_ref_num", type="string"),
     *                      @SWG\Property(property="techNotes", type="string"),
     *                      @SWG\Property(property="generalNotes", type="string"),
     *                      @SWG\Property(property="appSpecifications", type="string"),
     *                      @SWG\Property(property="remarks", type="number"),
     *                      @SWG\Property(property="activityNo", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="refDoc", type="number"),
     *                      @SWG\Property(property="quontumChkArray", type="object"
     *                      @SWG\Property(property="dataPK", type="string"),
     *                      @SWG\Property(property="quontum", type="string"),
     *                      @SWG\Property(property="action", type="string"),
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveinspectionreqtemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata['formData']['dtlsPk'] != null) {
            $dtlsPk = Security::decrypt($formdata['formData']['dtlsPk']);
            $dtlsPk = Security::sanitizeInput($dtlsPk, "number");
            $formdata['formData']['dtlsPk'] = $dtlsPk;
        }
        if ($formdata) {
            $data = Pms::saveInspectionReqtemp($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/updateinspectionreq",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Inspection Requirement",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="itp_date", type="string"),
     *                      @SWG\Property(property="itp_issuedBy", type="number"),
     *                      @SWG\Property(property="itp_ref_num", type="string"),
     *                      @SWG\Property(property="techNotes", type="string"),
     *                      @SWG\Property(property="generalNotes", type="string"),
     *                      @SWG\Property(property="appSpecifications", type="string"),
     *                      @SWG\Property(property="remarks", type="number"),
     *                      @SWG\Property(property="activityNo", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="refDoc", type="number"),
     *                      @SWG\Property(property="quontumChkArray", type="object"
     *                      @SWG\Property(property="dataPK", type="string"),
     *                      @SWG\Property(property="quontum", type="string"),
     *                      @SWG\Property(property="action", type="string"),
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionUpdateinspectionreq() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        $formdata['formData']['sharedFk'] = $sharedfk;
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata) {
            $data = Pms::updateInspectionReq($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/updateinspectionreqtemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Inspection Requirement",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="contractPk", type="string"),
     *                      @SWG\Property(property="headerPk", type="string"),
     *                      @SWG\Property(property="dtlsPk", type="string"),
     *                      @SWG\Property(property="itp_date", type="string"),
     *                      @SWG\Property(property="itp_issuedBy", type="number"),
     *                      @SWG\Property(property="itp_ref_num", type="string"),
     *                      @SWG\Property(property="techNotes", type="string"),
     *                      @SWG\Property(property="generalNotes", type="string"),
     *                      @SWG\Property(property="appSpecifications", type="string"),
     *                      @SWG\Property(property="remarks", type="number"),
     *                      @SWG\Property(property="activityNo", type="string"),
     *                      @SWG\Property(property="title", type="string"),
     *                      @SWG\Property(property="refDoc", type="number"),
     *                      @SWG\Property(property="quontumChkArray", type="object"
     *                      @SWG\Property(property="dataPK", type="string"),
     *                      @SWG\Property(property="quontum", type="string"),
     *                      @SWG\Property(property="action", type="string"),
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionUpdateinspectionreqtemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedFk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        $formdata['formData']['sharedFk'] = $sharedfk;
        if ($formdata['formData']['headerPk'] != null) {
            $headerPk = Security::decrypt($formdata['formData']['headerPk']);
            $headerPk = Security::sanitizeInput($headerPk, "number");
            $formdata['formData']['headerPk'] = $headerPk;
        }
        if ($formdata) {
            $data = Pms::updateInspectionReqtemp($formdata['formData']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/supportdocumentsave",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Support Document Save",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="fileupload", type="string"),
     *                      @SWG\Property(property="sharedfk", type="string"),
     *                      @SWG\Property(property="type", type="string"),
     *                      @SWG\Property(property="supportTblPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSupportdocumentsave() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedfk']);
        $sharedfk = Security::sanitizeInput($sharedfk, "number");
        $formdata['formData']['sharedfk'] = $sharedfk;
        if ($formdata) {
            $data = Pms::supportDocumentSave($formdata['formData']);
            return $data;
        }
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/autocreatprojecttender",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Support Document Save",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="fileupload", type="string"),
     *                      @SWG\Property(property="sharedfk", type="string"),
     *                      @SWG\Property(property="type", type="string"),
     *                      @SWG\Property(property="supportTblPk", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAutocreatprojecttender() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata) {
            $data = Pms::autoCreatProjectTender($formdata['formdata']);
            return $data;
        }
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getactivitynoarray",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Document Category",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetactivitynoarray() {
        $data = Pms::getActivityNoArray();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getdocumentcategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Document Category",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdocumentcategory() {
        $data = Pms::getDocumentCategory();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getdocumentcategorytemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Document Category",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdocumentcategorytemp() {
        $data = Pms::getDocumentCategorytemp();
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getsupplierlistawarded",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Supplier List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsupplierlistawarded() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenderPk = Security::decrypt($formdata['tenderPk']);
        $tenderPk = Security::sanitizeInput($tenderPk, "number");
        $data = Pms::getSupplierListAwardedTo($tenderPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdocumentcode",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Document Code",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdocumentcode() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['dataVal']) {
            $data = Pms::getDocumentCode($formdata['dataVal']);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getdocumentcodetemp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Document Code",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetdocumentcodetemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata['dataVal']) {
            $data = Pms::getDocumentCodeTemp($formdata['dataVal']);
            return $data;
        }
    }

    public function actionGetdashboarddata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $suppPk = Security::decrypt($formdata['suppPk']);
        $suppPk = Security::sanitizeInput($suppPk, "number");
        $data['feedlists'] = [ ['header' => "RFQ991 - Supply of Diesel Generator 500kVA with Canopy & skid mounted",
                "status" => "Open ",
                "publishedby" => "Oman Oil & Gas",
                "publishedon" => "11-12-2020",
                "estmatevalue" => "5000.00",
                "currency" => "USD",
                "closingdate" => "15/01/2021"], ['header' => "RFT005 - Construction of Sub Station",
                "status" => "Open ",
                "publishedby" => "Oman Oil & Gas",
                "publishedon" => "02-12-2020",
                "estmatevalue" => "900.00",
                "currency" => "USD",
                "closingdate" => "30/12/2020"]];
        $data['elemtdata'] = [
            
            ['status' => "Operators",
                "received" => "180",
                "submitted" => "110",
                "shortlisted" => "10",
                "rejected" => "10",
                "resultwait" => "80"],
            ['status' => "Contractors",
                "received" => "20",
                "submitted" => "10",
                "shortlisted" => "05",
                "rejected" => "02",
                "resultwait" => "10"],
		    ['status' => "Total",
                "received" => "200",
                "submitted" => "100",
                "shortlisted" => "25",
                "rejected" => "12",
                "resultwait" => "90"]
            ];
        $data['elemtdata1'] = [
            ['divenquiry' => "Manufacturing",
                "divtotal" => "200 ",
                "divopen" => "100"],
            ['divenquiry' => "Trading",
                "divtotal" => "100 ",
                "divopen" => "50"],
            ['divenquiry' => "OIL & GAS",
                "divtotal" => "50 ",
                "divopen" => "25"]
        ];
        $data['elemtdata2'] = [
            ['catenquiry' => "Valves",
                "cattotal" => "200 ",
                "catopen" => "100"],
            ['catenquiry' => "Transformers",
                "cattotal" => "100 ",
                "catopen" => "50"],
            ['catenquiry' => "Seamless Pipes",
                "cattotal" => "50 ",
                "catopen" => "25"]
        ];
        $data['elemtdata3'] = [
            ['enquiries' => "Manufacturing",
                "responded" => "200 ",
                "shortlisted" => "100",
                "awarded" => "100"
            ],
            ['enquiries' => "Trading",
                "responded" => "100 ",
                "shortlisted" => "50",
                "awarded" => "50"],
            ['enquiries' => "OIL & GAS",
                "responded" => "50 ",
                "shortlisted" => "25",
                "awarded" => "20"]
        ];
        $data['elemtdata4'] = [
            ['enquiries' => "Valves",
                "responded" => "200 ",
                "shortlisted" => "100",
                "awarded" => "100"
            ],
            ['enquiries' => "Transformers",
                "responded" => "100 ",
                "shortlisted" => "50",
                "awarded" => "50"],
            ['enquiries' => "Seamless Pipes",
                "responded" => "40 ",
                "shortlisted" => "20",
                "awarded" => "20"]
        ];
        $data['elemtdata5'] = [
            ['enquiries' => "RFQ487 - Supply of SS Seamless Pipes less than 4 inch",
                "closedatetime" => "25/12/2020 18:00 ",
                "targetinfo" => "Shortlisted",
                "levelinfo" => "3"
            ],
            ['enquiries' => "RFT650 - Replacement of damage cable, service wire, earthling and FRB box at various places in Sulphur Plant Area",
                "closedatetime" => "28/12/2020 17:00 ",
                "targetinfo" => "Yes to Respond",
                "levelinfo" => "1"]
        ];
		$data['elemtdataetender'] = [
            
            ['status' => "Operators",
                "received" => "180",
                "submitted" => "110",
                "shortlisted" => "10",
                "rejected" => "10",
                "resultwait" => "80",
                "closedx" => "2",
                "biddecline" => "2"
            ],
            ['status' => "Contractors",
                "received" => "20",
                "submitted" => "10",
                "shortlisted" => "05",
                "rejected" => "02",
                "resultwait" => "10",
                "closedx" => "1",
                "biddecline" => "2"
            ],
			['status' => "Total",
                "received" => "200",
                "submitted" => "100",
                "shortlisted" => "25",
                "rejected" => "12",
                "resultwait" => "90",
                "closedx" => "3",
                "biddecline" => "4"
            ]
        ];
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getrfxlist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFX Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reqpk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetrfxlist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $reqpk = Security::sanitizeInput($reqpk, "number");
        $data = Pms::getRfxList($reqpk);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getrfilistdata",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFI Data List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetfilterdynamicdata() {
        $formdata = $_REQUEST;
        $reqPk = Security::decrypt($formdata['reqPk']);
        $formdata['reqPk'] = Security::sanitizeInput($reqPk, "number");
        $data = Pms::getFilterDynamicData($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getrequisitionlist",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Requisition List",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetrequisitionlist() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = Pms::getrequisitionlist($data);
        return $data;
    }

    public static function actionRfxpreferencelist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        return Pms::Rfxpreferencelist();
    }

    public static function actionRemoverfxpreference() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqPk = Security::decrypt($formdata['reqPk']);
        $reqPk = Security::sanitizeInput($reqPk, "number");
        return Pms::Removerfxpreference($reqPk);
    }

    public static function actionSaverfxpreference() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::Saverfxpreference($formdata);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/addtenderdetails",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Add Tender Details",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAddtenderdetails() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $data = Pms::addtenderdetails($data);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/deleterequisition",
     *     tags={"Delete Requisition"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Delete added Requisition",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleterequisition() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::deleterequisition($formdata['reqpk']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/submitrequisition",
     *     tags={"Submit Requisition"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Submit Requisition",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSubmitrequisition() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::submitrequisition($formdata['reqpk']);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/getfilterdeptlist",
     *     tags={"Get Departmentlist"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get Departmentlist",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "proservicePk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetfilterdeptlist() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $data = Pms::getfilterdeptlist($companypk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/addquicktender",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Qucik Tender Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quicktender", type="object",
     *                      @SWG\Property(property="req_pk", type="string"),
     *                      @SWG\Property(property="req_cardtitle", type="string"),
     *                      @SWG\Property(property="req_refno", type="string"),
     *                      @SWG\Property(property="req_requester", type="string"),
     *                      @SWG\Property(property="req_priority", type="string"),
     *                      @SWG\Property(property="req_date", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionAddquicktender() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $req_pk = Security::decrypt($formdata['quicktender']['req_pk']);
        $contract_pk = Security::decrypt($formdata['quicktender']['contract_pk']);
        $formdata['quicktender']['req_pk'] = Security::sanitizeInput($req_pk, "number");
        $formdata['quicktender']['contract_pk'] = Security::sanitizeInput($contract_pk, "number");
        $data = Pms::addquicktender($formdata);
        return $data;
    }

    public function actionViewinvoice() {
        $filename = Security::decrypt($_REQUEST['dataVal']);
        $companyPk = Security::decrypt($_REQUEST['cpk']);
        $path = "../api/web/generated/invoice/cms/" . $companyPk . "/" . $filename;
        header("Content-type: application/pdf");
        header("Content-Disposition: inline; filename = $filename");
        @readfile($path);
        exit;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/deletetender",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Add Qucik Tender Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quicktender", type="object",
     *                      @SWG\Property(property="req_pk", type="string"), 
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public static function actionDeletetender() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tender_pk = $formdata['pk'];
        $tender_pk = Security::decrypt($tender_pk);
        $tender_pk = Security::sanitizeInput($tender_pk, "number"); //  cmsrqprodservtrnx_tbl PK
        $data = Pms::deletetender($tender_pk);
        return $data;
    }
    
    public function actionDownloadinvoice() {
        $filename = Security::decrypt($_REQUEST['dataVal']);
        $companyPk = Security::decrypt($_REQUEST['cpk']);
        $path = "../api/web/generated/invoice/cms/" . $companyPk . "/" . $filename;
        header("Content-type: application/pdf");
        header("Content-Description: File Transfer");
        header("Content-type: application/octet-stream");
        header("Content-type: application/force-download");
        header("Content-Disposition: attachment; filename = $filename");
        header("Content-Length:". filesize($path));
        @readfile($path);
        exit;
    }
    public function actionSuccessfesslisting(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $retdata =\api\modules\pms\models\CmsawarddtlsTblQuery::getcontractfeesapproval($formdata);
        $formatedData = array();
        if(count($retdata) > 0){
            $formatedData = \api\modules\pms\models\CmsawarddtlsTblQuery::formatsucessfeesapproval($retdata['data']);
        }
        return $this->asJson([
                'data' => $formatedData,
                'totalcount'=>$retdata['totalcount'],
                'msg' => 'Success',
                'status' => 100,
        ]);
    }
    public function actionSuccessfessapprovalview(){
        $awasrdpk = \common\components\Security::decrypt($_REQUEST['awardid']);
        $retdata =\api\modules\pms\models\CmsawarddtlsTblQuery::getcontractsuccessfessview($awasrdpk);
        return $this->asJson([
                'data' => $retdata,
                'msg' => 'Success',
                'status' => 100,
        ]);
    }
    public function actionDownloadreceipt() {    
        $receiptPk = \common\components\Security::sanitizeInput($_REQUEST['rpk'], 'number', false);
        $compPk = \common\components\Security::sanitizeInput($_REQUEST['cpk'], 'number', false);
        if(!empty($receiptPk)){
            $receiptDetails = \common\models\MemcomppymtrcptdtlsTbl::findOne($receiptPk);
            $fileName =  $receiptDetails['mcpr_receiptpath'];
            $path = dirname(__FILE__)."/../../../../backend/receipt/sucessfees/".$compPk."/";
            header("Content-type: application/pdf");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename = $fileName");
            header("Content-Length:". filesize($path.$fileName));
            @readfile($path.$fileName);
            exit;
        }        
    }
      public function actionSuccessfessstatuschange(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $statusData['paymentPk'] = \common\components\Security::decrypt($data['paymentPk']);
        $statusData['approvalType']= $data['fdata']['selectstatus'];
        $statusData['approvalCmds'] = $data['fdata']['comments'];
        $resdata = \common\components\ApprovalComponents::successfesstatusChange($statusData);
        $contrctpk = \common\components\Security::decrypt($data['cvalue']);
        if($resdata){
            $regPk = $resdata['RegPk'];
            $compPk = $resdata['companyPk'];
            $invoicepk = $resdata['invoicepk'];
            $payinfopk = $resdata['payinfopk'];
            if($resdata['aprStatus']=='approve'){
                $model = \common\models\MemcompinvoicedtlsTbl::find()->where("memcompinvoicedtls_pk =:pk", [':pk' => $invoicepk])->one();
                $model->mcid_invoicestatus = 'CP';
                if ($model->save() === TRUE) {
                    $updatePendingStatus =\api\modules\pms\models\CmsawardfeependingTblQuery::pendingInvoiceStatusUpdate($compPk,$regPk);
                    $receiptModel = new \common\models\MemcomppymtrcptdtlsTbl();
                    $receipt_no = \common\components\common::generateInvoiceNo('REC', 'REC');
                    $receiptModel->mcpr_memcomppymtinfodtls_fk = $payinfopk;
                    $receiptModel->mcpr_memcompinvoicedtls_fk = $invoicepk;
                    $receiptModel->mcpr_receiptno = $receipt_no;
                    $receiptModel->mcpr_createdon = date('Y-m-d');
                    $receiptModel->mcpr_createdby = \yii\db\ActiveRecord::getTokenData('user_pk', true);
                    if ($receiptModel->save()) {
                        $receipt_path = \common\components\common::getInvoiceName($receipt_no, $receiptModel->mcpr_createdon);
                        $receiptModel->mcpr_receiptpath = $receipt_path;
                        $receiptModel->save();
                        \common\components\common::updateInvoiceNo('REC');
                        self::generateReceipt($compPk, $regPk, $contrctpk, $receiptModel, 1);
                        return $this->asJson([
                                    'data' => $resdata,
                                    'msg' => 'Success',
                                    'status' => 100,
                        ]);
                    } else {
                        echo "<pre>";
                        print_r($receiptModel->getErrors());
                        exit;
                    }
                } else {
                        echo "<pre>";
                        print_r($model->getErrors());
                        exit;
                    }
                
            }else{
                return $this->asJson([
                    'data' => $resdata,
                    'msg' => 'Success',
                    'status' => 100,
                ]); 
            }
        }else{
            return $this->asJson([
                    'data' => $resdata,
                    'msg' => 'Success',
                    'status' => 100,
                ]); 
        }        
     }
     public function actionUpdtepaymentstatuschange(){
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $paympk =  \common\components\Security::decrypt($data['id']);
        if(!empty($paympk)){
            $pymtModel = \common\models\MemcomppymtinfodtlsTbl::findOne($paympk);
            $pymtModel->mcpid_pymtstatus = $data['fdata']['selectpaymentstatus'];
            if($data['fdata']['selectpaymentstatus'] == 1){                
                $pymtModel->mcpid_transuniqueid = $data['fdata']['paymentnumber'];
            }
            $pymtModel->mcpid_apprcomments = $data['fdata']['comments'];
            if($pymtModel->save()){
                $invoiceModel = \common\models\MemcompinvoicedtlsTbl::findOne($pymtModel->mcpid_memcompinvoicedtls_fk);
                if($pymtModel->mcpid_pymtstatus==3){
                    $invoiceModel->mcid_invoicestatus = 'I';
                }elseif($pymtModel->mcpid_pymtstatus==4){
                    $invoiceModel->mcid_invoicestatus = 'C'; 
                }
                $invoiceModel->save();
                $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Updated successfully!',
                );
            }else{
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$pymtModel->getErrors(),
                );
            }            
        }else{
            $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>"Id is empty",
                );
        }
        return $result;
    }
    public function generateReceipt($compPk,$regPk,$contrctpk,$receiptModel,$type) {
        $receiptDtls= \common\components\ApprovalComponents::getInvoiceDtls($compPk,$regPk,$contrctpk,$receiptModel,$type);
        $receiptno = $receiptModel->mcpr_receiptno;
        $receiptpath = $receiptModel->mcpr_receiptpath;
        $receiptDtls['receiptdate']=date('d-m-Y',strtotime($receiptModel->mcpr_createdon));
        $receiptDtls['mcpr_receiptno']=$receiptModel->mcpr_receiptno;
        $baseUrl = \Yii::$app->params['baseUrl'];
        $rootPath = \Yii::$app->params['loginExportSavePath'];
        if($type == 1){            
            $path = $rootPath."backend/receipt/sucessfees/$compPk";
        }
       
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }             
//        $amtintowords = "-";
//        $invoiceamt = "-";
//        $receivedamt="-";
        if(!empty($receiptDtls['address'])){
            if(!empty($receiptDtls['city']) && !empty($receiptDtls['state']) && !empty($receiptDtls['country'] )){
                $address = $receiptDtls['address'] .',' . $receiptDtls['city'] .',' . $receiptDtls['state']  .',' . $receiptDtls['country'];
            }elseif(!empty($receiptDtls['state']) && !empty($receiptDtls['country'] )){
                 $address = $receiptDtls['address'] .',' . $receiptDtls['state']  .',' . $receiptDtls['country'];
            }elseif(!empty($receiptDtls['city']) && !empty($receiptDtls['country'] )){
                 $address = $receiptDtls['address'] .',' . $receiptDtls['city']  .',' . $receiptDtls['country'];
            }else{
                 $address = $receiptDtls['address'] .',' .  $receiptDtls['country'];
            }            
        }else{
            $address = "-";
        }
        $invformat = 2;
        $revamformat = 2; 
        $origin = 'I';
        if($receiptDtls['Rcurrencysymbol'] == 'OMR'){
            $revamformat = 3; 
            $origin = 'N';
        }
        if($receiptDtls['Icurrencysymbol'] == 'OMR'){
            $invformat = 3;
        }
        $invoiceamt = number_format($receiptDtls['invoiceamt'], $invformat);
        $receivedamt = number_format($receiptDtls['receivedamt'], $revamformat);
        //echo $invoiceamt. '-'.$receivedamt; exit;
        $amtintowords = \common\components\Common::AmountInWords($receiptDtls['receivedamt'], $origin);
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 5,
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_bottom' => 5,
        'autoPageBreak' => true,
        'default_font' => 'cairoregular',
        //'format' => 'A3'
        'format' => [250, 330]]);
        $mpdf->shrink_tables_to_fit = 1;		
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .5;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($this->renderPartial('feesreceipt',['receiptDtls'=>$receiptDtls,'amtintowords'=>$amtintowords,'receivedamt'=>$receivedamt,'invoiceamt'=>$invoiceamt,'address'=>$address]));
        $mpdf->Output($rootPath."backend/receipt/sucessfees/$compPk/$receiptpath",'F'); 
    }
    public static function actionGetprojectstatus() {
        $data = \api\modules\pd\models\ProjectdtlsTblQuery::getprojectstagecount();
        return $data;
    }
    public function actionGeturlforfile() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $file = $data['file'];
        $createdby = $data['createdby'];
        $company = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        return Drive::generateUrl($file, $company, $createdby);
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/checkduplicaterefid",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get RFI duplicate",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *          @SWG\Schema(
     *                  @SWG\Property(property="quicktender", type="object",
     *                      @SWG\Property(property="req_pk", type="string"), 
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionCheckduplicaterefid() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::checkduplicaterefid($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/checkduplicaterfxrefid",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Ref No duplicate",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *          @SWG\Schema(
     *                  @SWG\Property(property="quicktender", type="object",
     *                      @SWG\Property(property="req_pk", type="string"), 
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionCheckduplicaterfxrefid() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Pms::checkduplicaterfxrefid($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/tenderclousrereport",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get tender closure report Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData",  name = "reqpk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionTenderclousrereport(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $data = Pms::getTenderClosureReport($reqpk);
        return $data;
    }

       /**
     * @SWG\Post(
     *     path="/pms/pms/gettenderrfx",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get tender closure report Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData",  name = "reqpk", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "rfxtype", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "recent", type = "boolean"),
     *     @SWG\Parameter(in = "formData",  name = "download", type = "boolean"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGettenderrfx() {
        $request_body = file_get_contents('php://input');
        $reqdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($reqdata['reqpk']);
        $reqdata['reqpk'] = Security::sanitizeInput($reqpk, "number");
        $data = Pms::getTenderRFx($reqdata);
        return $data;
    }
    
      /**
     * @SWG\Post(
     *     path="/pms/pms/getreqcontractawards",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get tender closure report Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData",  name = "reqpk", type = "string"),
     *     @SWG\Parameter(in = "formData",  name = "rfxtype", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetreqcontractawards() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['formData']['reqpk']);
        $formdata['formData']['reqpk'] = Security::sanitizeInput($reqpk, "number");
        $data = Pms::getReqContractAwards($formdata);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/checking-ref-number",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation detail data", 
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataValue", type="string"),
     *                  @SWG\Property(property="dataType", type="string"),
     *                  @SWG\Property(property="currentPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionCheckingRefNumber(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPK = Security::decrypt($formdata['currentPk']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $formdata['currentPk'] = $currentPK;
        $data = Pms::chkValidRefNumber($formdata);
        return $data;
    }
    
      /**
     * @SWG\Post(
     *     path="/pms/pms/downloadclousrereport",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get tender closure report Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData",  name = "reqpk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDownloadclousrereport(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $reqpk = Security::decrypt($formdata['reqpk']);
        $formdata['reqpk'] = Security::sanitizeInput($reqpk, "number");
        $data = Pms::downloadTenderClosureReport($formdata);
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $user = \common\models\UsermstTbl::findOne($userpk);
        $generatedBy = '';
        if($user){
            $generatedBy = $user->um_firstname;
            if($user->um_middlename){
                $generatedBy .= ''.$user->um_middlename;
            }
            if($user->um_lastname){
                $generatedBy .= ''.$user->um_lastname;
            }
        }
        $comp_pk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $loggedComp = \common\models\MembercompanymstTbl::find()->where(['MemberCompMst_Pk' => $comp_pk])->one();
        $companyName = $company->MCM_CompanyName;
        $data['companyName'] = $companyName;
        $data['generatedon'] = date('d-m-Y H:i:s');
        $data['generatedby'] = $generatedBy;
        $baseUrl = \Yii::$app->params['baseUrl'];
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'margin_top' => 5,
        'margin_left' => 5,
        'margin_right' => 5,
        'margin_bottom' => 5,
        'autoPageBreak' => true,
        'default_font' => 'cairoregular',
        'format' => [250, 330]]);
        $mpdf->shrink_tables_to_fit = 1;		
        $mpdf->SetWatermarkImage($baseUrl.'assets/images/jsrs-logo-icon.png');
        $mpdf->watermarkImageAlpha = .5;
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML(\Yii::$app->controller->renderPartial('tenderclosurereport',['data'=>$data['returndata']]));
        $downloadpath = \Yii::$app->params['api_download_path']['tenderClosuerReport'];
        $path = $downloadpath.'/'.$reqpk;
        
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        } 
        $filepath = $path.'/'.time().'.pdf';
       
        $mpdf->Output($filepath,'F'); 
        return ['url' => \Yii::$app->params['backendBaseUrl'].'api/'.$filepath];
    }
  
    /**
     * @SWG\Get(
     *     path="/pms/pms/changestatus",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFx Active Count",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionChangestatus() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenid = $formdata['tenid'];
        $status = $formdata['status'];
        $data = Pms::changestatus($tenid, $status);
        return $data;
    }

    /**
     * @SWG\Get(
     *     path="/pms/pms/changestatustemp",
     *     tags={"PMS"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="Get RFx Active Count",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData",  name = "reqPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionChangestatustemp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $tenid = $formdata['tenid'];
        $status = $formdata['status'];
        $comments = $formdata['comments'];
        $data = Pms::changestatustemp($tenid, $status, $comments);
        return $data;
    }

    public function actionChangestatustest() {
        $tendTarget['cmstth_cmstenderhdr_fk'] = 184;
        $tendTarget['cmstth_memberregmst_fk'] = 6;
        $tendTarget['cmstth_targettype'] = 2;
        \api\modules\pms\models\CmstendertargethdrTbl::saveData($tendTarget);
    }

    public function actionSaveexcel() {
        //print_r("ExcelValidation");die();
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        
        
        if($formdata['data']['successcount']>0)
        {
            $newcontracts = $formdata['successData'];
            $rescount = 1;
            foreach($newcontracts as $contract)
            {
                $result = \api\modules\pms\models\CmscontracthdrTblQuery::saveimportedcontract($contract,$rescount);
                $rescount++;
            }
            
            
            $result=array(
                    'status' => 200,
                    'statusmsg' => 'success',
                    'flag'=>'S',
                    'msg'=>'Contract Inserted successfully!',
                );
        }
        else
        { 
            $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>"Id is empty",
                );
        }
        return $result;
       \api\modules\pms\models\CmsimportaudittrailmstTbl::saveExcel($formdata);
    }
    function validateDate($date, $format = 'd-m-Y')
    {
        $d = \DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) == $date;
    }
    function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function actionValidateExel() {
        $membregid = \yii\db\ActiveRecord::getTokenData('reg_pk', true);
        $comppk =  \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $path = explode('api/',Drive::getAbsFilePath($formdata['data']['filePk']));
        
        try {
              $getexceldata= \PhpOffice\PhpSpreadsheet\IOFactory::load($path[1]);
              $sheet_array=$getexceldata->getActiveSheet()->toArray(null,null,null,null,1,2);
              $sheet_array = array_map('array_filter', $sheet_array);
              $dataToSaveArray = array_filter($sheet_array);
                } catch(PHPExcel_Exception $e){
                    $templdatestatus=TRUE;
                    $jsonData['templdatestatus']= $templdatestatus;
                    $jsonData['msg'] = 'datareaderror';
                    $jsonData['title'] = Yii::t('ess', 'Invalid Input!');
                    $jsonData['dtls'] = Yii::t('ess', 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.');     
//                    \backend\modules\ess\components\Dashboard::unlinkallfiles($folderpath);
                    return json_encode($jsonData);
                } catch(Exception $e){
                    $templdatestatus=TRUE;
                    $jsonData['templdatestatus']= $templdatestatus;
                    $jsonData['msg'] = 'datareaderror';
                    $jsonData['title'] = Yii::t('ess', 'Invalid Input!');
                    $jsonData['dtls'] = Yii::t('ess', 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.'); 
//                    \backend\modules\ess\components\Dashboard::unlinkallfiles($folderpath);                    
                    return json_encode($jsonData);
                }
                
        $masterArray = array();
        $successarray = array();
        $headArray = array();
        $headerArray = array_filter($dataToSaveArray[0]);
        
         foreach ($headerArray as $key => $head) {
                    $keyvalue= str_replace("*","",$head);
                    $testcount=  strpos($keyvalue,"(");
                    if(!empty($testcount)){
                    $keyvalue= substr($keyvalue,0,$testcount);
                    
                    }
                    if(trim($keyvalue)=='e-Tendering_Mandate'){
                      $keyvalue='Tendering_Mandate';
                    }
                    $headArray[]=trim($keyvalue);
                    
                }
               
                $dataToSaveArray[0]=array_filter($dataToSaveArray[0]);
                $headcount=count($headArray);
                             unset($dataToSaveArray[0]);
                $i=0;
                $success=0;
                
                $wsdlobject = \common\components\Wsdlcontract::getInstance();
                
                $templdatestatus=TRUE;
                if($_SESSION['ocm_contract']!=1) { 
                $LableArray = array("Project_Ref_No", "Project_Title","Project_Location_Governorate","Project_Location_Wilayat", "Project_Status",'Tender_Ref_No','Tender_Title','Contract_Ref_No','Contract_Title','Contract_Description','Procurement_Type','Group_Category','Main_Category','Subcategory','Award_Type','Contract_Start_Date','Contract_End_Date','Estimated_Duration','Contract_Status','Contract_Comments','Supplier_JSRS_Certified','Awarded_to_JSRS_Supplier_Code','Supplier_Name','Supplier_CR_Number','Supplier_Country','Supplier_Contact_Name','Supplier_Contact_Email','Tendering_Mandate','Obligation_Type','SME_Obligation_Percentage','LCC_Obligation_Percentage','Scope_of_Obligation','Contract_Amount_USD','Operator_Contact_Person_Name','Email','Phone','Ext','Mobile');
                
                
                if($headcount!=count($LableArray))
                {
                    $templdatestatus=FALSE;
                }
                if($headArray!=$LableArray)
                {
                    $templdatestatus=FALSE;
                }
                }else{
                    $LableArray = array('Contract_Ref_No','Contract_Title','Contract_Description','Procurement_Type','Group_Category','Main_Category','Subcategory','Award_Type','Contract_Start_Date','Contract_End_Date','Estimated_Duration','Contract_Status','Contract_Comments','Supplier_JSRS_Certified','Awarded_to_JSRS_Supplier_Code','Supplier_Name','Supplier_CR_Number','Supplier_Country','Supplier_Contact_Name','Supplier_Contact_Email','Tendering_Mandate','Obligation_Type','SME_Obligation_Percentage','LCC_Obligation_Percentage','Scope_of_Obligation','Contract_Amount_USD','Operator_Contact_Person_Name','Email','Phone','Ext','Mobile');
                    if($headcount!=count($LableArray))
                    {
                        $templdatestatus=FALSE;
                    }
                    if($headArray!=$LableArray)
                    {
                        $templdatestatus=FALSE;
                    }
                }
                
                foreach ($dataToSaveArray as $key => $value) {
                    $eTedner='No';
                    $contractAmt='No';
                    $contractAmtval='No';
                    $ContractCommend='No';
                    $scoboblication='No';
                    $sme_obligation='No';
                    $lcc_obligation='No';
                    $not_applicable='No';
                    $datemandate='No';
                    $jsrssupp='';
                    $comments="";
                    $Jsrscomments="";
                    $Requiredcomments="";
                    $limitexceedcomments="";
                    $GroupCatecomments="";
                    $Requiredcountry="";
                    $MainCatecomments="";
                    $formatecomments="";
                    $overallcomments="";
                    $Jsrslable="";
                    $Requiredlabe="";
                    $limitexceedlable="";
                    $GroupCatelable="";
                    $subCatelable="";
                    $MainCatelable="";
                    $formatelable="";
                    $invalidlable="";
                    $overalllable="";
                    $j=0;
                    $validdata='TRUE';
                    $contractdata='FALSE';
                    $groupnamecomments="";
                    $projectcount=0;
                    $contractComments='';
                    
                     if(empty($value['0']) && empty($value['1']) && empty($value['2']) && empty($value['3']) && empty($value['4']) && empty($value['5']) && empty($value['6']) && empty($value['7']) && empty($value['8']) && empty($value['9']) && empty($value['10']) && empty($value['11']) && empty($value['12']) && empty($value['13']) && empty($value['14']) && empty($value['15']) && empty($value['16']) && empty($value['17']) && empty($value['18']) && empty($value['19']) && empty($value['20']) && empty($value['21']) && empty($value['22']) && empty($value['23']) && empty($value['24']) && empty($value['25']) && empty($value['26']) && empty($value['27']) && empty($value['28']) && empty($value['29']) && empty($value['30']) && empty($value['31']) && empty($value['32']) && empty($value['33']) && empty($value['34']) && empty($value['35']) && empty($value['36']) && empty($value['37']))
                    {
                        $value= array_filter($value);
                        $i--;
                    }
                    
                     $sme_percentvalue = $lcc_percentvalue = 0;
                     foreach ($value as $key1 => $value1) {
                         
                         $newarray= $value;
                         end($newarray);         // move the internal pointer to the end of the array
                         $last = key($newarray);
                         $lastkeyvalue = str_replace("*","",$headerArray[$last]);
                         
                         
                        $value1 = trim($value1);
                        $keyvalue= str_replace("*","",$headerArray[$key1]);
                        
                        $testcount=  strpos($keyvalue,"(");
                        if(!empty($testcount)){
                        $keyvalue= substr($keyvalue,0,$testcount);}
                        if(trim($keyvalue)=='e-Tendering_Mandate'){
                          $keyvalue='Tendering_Mandate';
                        }
                        if(!empty($keyvalue) && $keyvalue!=NULL)
                        {
                        $masterArray[$i][trim($keyvalue)] = $value1;
                        
                        }
                        
                       
                        $GroupCatecomments="";
                        $SubCatecomments="";
                        $MainCatecomments="";
                        $Jsrscomments="";
                        $project='yes';
                        
                       if($_SESSION['ocm_contract']!=1) { 
                          
                          if(!in_array(trim($keyvalue), $LableArray) && !empty($keyvalue))
                          {
                              $templdatestatus=FALSE;
                          }
                          
                           
                        if(trim($keyvalue)=='Project_Ref_No' && empty($value1))
                        {
                            
                            $project='No';
                            $masterArray[$i]['pq_cellattr'][Project_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Project_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Project_Ref_No' && !empty($value1) && strlen($value1)>30)
                        {
                           $project='No';
                            $masterArray[$i]['pq_cellattr'][Project_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $masterArray[$i]['pq_cellattr'][Project_Ref_No][title]= 'invalid project no.';
                            $validdata='FALSE';
                            $limitexceedcomments=" Project_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Project_Ref_No' && !empty($value1))
                        {
//                           $epcProject= \api\modules\pd\models\ProjectdtlsTbl::find();
                        
                            $epcProject = \api\modules\pd\models\ProjectdtlsTbl::find()
                                         ->where('prjd_referenceno = :prjd_referenceno', [':prjd_referenceno' => $value1])
                                         ->andWhere('prjd_memberregmst_fk = :prjd_memberregmst_fk', [':prjd_memberregmst_fk' => $membregid])
                                         ->one();
                               
                        }
                        if(trim($keyvalue)=='Project_Title' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Project_Title ,";
                        }
                        if(trim($keyvalue)=='Project_Title' && !empty($value1) && strlen($value1)>150)
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Project_Title ,";
                        }
                        if(trim($keyvalue)=='Project_Status' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Status][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Project_Status ,";
                        }
                        
                        if(trim($keyvalue)=='Project_Status' && !empty($value1) && $wsdlobject->getProjectstatus($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Status][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Project_Status ,";
                        }
                        if(trim($keyvalue)=='Project_Location_Governorate' && empty($value1) && Yii::$app->params['GOV_PROJECT_ENABLE'])
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Location_Governorate][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Project_Location_Governorate ,";
                        }
                        if(trim($keyvalue)=='Project_Location_Governorate' && !empty($value1)  && Yii::$app->params['GOV_PROJECT_ENABLE'])
                        {
                            $masterArray[$i]['pq_cellattr'][Project_Location_Governorate][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Project_Location_Governorate ,";
                        }

                        if(trim($keyvalue)=='Project_Location_Wilayat' && !empty($value1))
                        {
                            $stateVal = $wsdlobject->getGovernance($value['2']);
                            $cityVal = CitymstTbl::model()->find("CM_CityName_en LIKE :cityVal AND CM_StateMst_Fk = :stateVal AND CM_CountryMst_Fk=31 ",array(':cityVal'=>$value1,':stateVal'=>$stateVal));
                            if(empty($cityVal))
                            {
                                $masterArray[$i]['pq_cellattr'][Project_Location_Wilayat][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" Project_Location_Wilayat ,";
                            }
                        }
                        
                        if(trim($keyvalue)=='Tender_Ref_No' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Tender_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Tender_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Tender_Ref_No' && !empty($value1) && strlen($value1)>30)
                        {
                            $masterArray[$i]['pq_cellattr'][Tender_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Tender_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Tender_Ref_No' && !empty($value1))
                        {
                            
                            $epcTender = \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                                    ->where('crfd_rqrefno = :tenderrefno', [':tenderrefno' => $value1])
                                    ->andWhere('crfd_projectdtls_fk = :crfd_projectdtls_fk', [':crfd_projectdtls_fk' => $epcProject->projectdtls_pk])->one();
                           
                            
                            $epcTenderVal=  \api\modules\pms\models\CmsrequisitionformdtlsTbl::find()
                                            ->where('crfd_rqrefno = :tenderrefno', [':tenderrefno' => $value1])->all();
                                 
                                    
                            foreach ($epcTenderVal as $valueTend) {
                          
                            if(!empty($valueTend))
                            {
                                
                                if($valueTend->crfd_projectdtls_fk!=$epcProject->projectdtls_pk && $valueTend->crfd_memcompmst_fk == $comppk)
                                {
                                $masterArray[$i]['pq_cellattr'][Tender_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $TednerComments=" Tender already created towards different Project. ";
                                }
                            }
                        }
                            
                        }
                        if(trim($keyvalue)=='Tender_Title' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Tender_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Tender_Title ,";
                        }
                        if(trim($keyvalue)=='Tender_Title' && !empty($value1) && strlen($value1)>150)
                        {
                            $masterArray[$i]['pq_cellattr'][Tender_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Tender_Title ,";
                        }
                       }else{
                           $epcProject= EPCProject::model()->find('EPCPD_projrefno=:projrefno and EPCPD_OprCompMst_Pk=:compk',array('projrefno'=>'00**00','compk'=>$membregid));
                           $epcTender= EpctenderhdrTbl::model()->find('eth_epcprojdtls_fk=:epcprojdtls_fk and eth_tenderrefno=:tenderrefno',array('epcprojdtls_fk'=>$epcProject->EPCprojdtls_Pk,'tenderrefno'=>'00**00'));
                           
                            
                            
                          
                          if(!in_array(trim($keyvalue), $LableArray) && !empty($keyvalue))
                          {
                              $templdatestatus=FALSE;
                       }
                          
                       }
//                        if(trim($keyvalue)=='Tender_Category' && empty($value1))
//                        {
//                            $masterArray[$i]['pq_cellattr'][Tender_Category][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Tender_Category,";
//                        }
//                        if(trim($keyvalue)=='Tender_Category' && !empty($value1) && $wsdlobject->getTenderCategory($value1)=='')
//                        {
//                            $masterArray[$i]['pq_cellattr'][Tender_Category][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $invalidcomments=" Tender_Category,";
//                        }
                       
                       
                        if(trim($keyvalue)=='Contract_Ref_No' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Contract_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Contract_Ref_No' && !empty($value1) && strlen($value1)>30)
                        {
                           
                            $masterArray[$i]['pq_cellattr'][Contract_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Contract_Ref_No ,";
                        }
                        if(trim($keyvalue)=='Contract_Ref_No' && !empty($value1))
                        {
                            
                            $epcContract = \api\modules\pms\models\CmscontracthdrTbl::find()
                                    ->where('cmsch_cmsrequisitionformdtls_fk=:cmsch_cmsrequisitionformdtls_fk and cmsch_contractrefno=:cmsch_contractrefno',array(':cmsch_cmsrequisitionformdtls_fk'=>$epcTender->cmsrequisitionformdtls_pk,':cmsch_contractrefno'=>$value1))
                                    ->one();
                            if(!empty($epcContract))
                            {
                              
                                $masterArray[$i]['pq_cellattr'][Contract_Ref_No][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $contractComments=" Contract is already created. Kindly update via form.";
                            }else{
                                $epcContract = \api\modules\pms\models\CmscontracthdrTbl::find()
                                    ->where('cmsch_cmsrequisitionformdtls_fk=:cmsch_cmsrequisitionformdtls_fk ',array(':cmsch_cmsrequisitionformdtls_fk'=>$epcTender->cmsrequisitionformdtls_pk))
                                    ->one();
                                
                                if(!empty($epcContract))
                                {
//                                    if($epcContract->EPCCD_contrefno!=$value1)
//                                    {
//                                    $masterArray[$i]['pq_cellattr'][Contract_Ref_No][style]= 'background:#f44250;font-weight:bold;';
//                                    $validdata='FALSE';
//                                    $contractComments=" Contract already created for the Tender. Only one Contract is allowed towards a tender. ";
//                                    }
                                }
                            }
                            
                            
                        }
                        if(trim($keyvalue)=='Contract_Title' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Contract_Title ,";
                        }
                        if(trim($keyvalue)=='Contract_Title' && !empty($value1) && strlen($value1)>150)
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Title][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Contract_Title ,";
                        }
//                        if(trim($keyvalue)=='Contract_Description' && empty($value1))
//                        {
//                            $masterArray[$i]['pq_cellattr'][Contract_Description][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Contract_Description ,";
//                        }
                        if(trim($keyvalue)=='Tendering_Mandate' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Tendering_Mandate][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" e-Tendering_Mandate ,";
                        }
                        if(trim($keyvalue)=='Tendering_Mandate' && !empty($value1) && $wsdlobject->etendering(trim($value1))=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Tendering_Mandate][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" e-Tendering_Mandate ,";
                        }
                        if(trim($keyvalue)=="Award_Type" && !empty($value1) && $wsdlobject->getawardtype($value1)!='1')
                        {
                            $datemandate='Yes';
                        }
                        if(trim($keyvalue)=='Contract_Start_Date' && empty($value1) && $datemandate=='Yes')
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Start_Date][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Contract_Start_Date ,";
                        }
                        if(trim($keyvalue)=='Contract_Start_Date' && !empty($value1) && !$this->validateDate($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Start_Date][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $formatecomments=" Contract_Start_Date ,";
                        }
                        if(trim($keyvalue)=='Contract_End_Date' && empty($value1) && $datemandate=='Yes')
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_End_Date][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Contract_End_Date ,";
                        }
                        if(trim($keyvalue)=='Contract_End_Date' && !empty($value1) && !$this->validateDate($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_End_Date][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $formatecomments=" Contract_End_Date ,";
                        }
                        
                        
                        if(trim($keyvalue)=='Estimated_Duration' && empty($value1) && $datemandate=='Yes')
                        {
                            $masterArray[$i]['pq_cellattr'][Estimated_Duration][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Estimated_Duration ,";
                        }
                        if(trim($keyvalue)=='Estimated_Duration' && !empty($value1) && $wsdlobject->getduration($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Estimated_Duration][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Estimated_Duration ,";
                        }
                        if(trim($keyvalue)=='Procurement_Type' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Procurement_Type][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Procurement_Type ,";
                        }
                        if(trim($keyvalue)=='Procurement_Type' && !empty($value1) && $wsdlobject->getprocuremnttype($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Procurement_Type][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Procurement_Type ,";
                        }
                        if(trim($keyvalue)=='Contract_Status' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Status][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments="Contract_Status ,";
                        }
                        if(trim($keyvalue)=='Contract_Status' && !empty($value1) && $wsdlobject->getContractstatus($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Status][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments="Contract_Status ,";
                        }
                        if(trim($keyvalue)=='Group_Category' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Group_Category][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Group_Category ,";
                        }
                        if(trim($keyvalue)=='Group_Category' && !empty($value1))
                        {
                            $gorupexplode= explode("#", $value1);
                            $gorupcatexplode= explode("#", $value1);
                            $wsdlobject=new \common\components\Wsdlcontract();
                            if(is_array($gorupexplode))
                            {
                            foreach ($gorupexplode as $key => $groupcode) {
                                $getMaincate=$wsdlobject->insercategory($groupcode,'group');
                                if(empty($getMaincate))
                                {
                                    $masterArray[$i]['pq_cellattr'][Group_Category][style]= 'background:#f44250;font-weight:bold;';
                                    $validdata='FALSE';
                                    $GroupCatecomments.=$groupcode." ,";
                                }
                            }
                            }
                        }

//                        if($keyvalue=='Main_Category' && empty($value1))
//                        {
//                            $masterArray[$i]['pq_cellattr'][Main_Category][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Main_Category ,";
//                        }
                        if(trim($keyvalue)=='Main_Category' && !empty($value1))
                        {

                            $gorupexplode= explode("#", $value1);
                            $wsdlobject=new \common\components\Wsdlcontract();
                             if(is_array($gorupexplode))
                            {
                            foreach ($gorupexplode as $key => $groupcode) {
                                $getMaincate=$wsdlobject->insercategory($groupcode,'main');
                                if(empty($getMaincate))
                                {
                                    $masterArray[$i]['pq_cellattr'][Main_Category][style]= 'background:#f44250;font-weight:bold;';
                                    $validdata='FALSE';
                                    $MainCatecomments.=$groupcode." ,";
                                }
                            }
                            }
                             if(is_array($gorupcatexplode))
                            {
                            foreach ($gorupcatexplode as $key => $catgroup) {
                                
                                foreach ($gorupexplode as $keys => $group) {
                                    
                                    $Groupcategroy[$keys][$catgroup]=$group;
                                }
                                
                            }
                            }
                            if(is_array($Groupcategroy))
                            {
                            foreach ($Groupcategroy as $groupval => $Groupcat) {
                                
                                foreach ($Groupcat as $groupname => $cate) {
                                    $getMaincate=$wsdlobject->Checkcategory($groupname,$cate);
                                    if(empty($getMaincate))
                                    {
//                                        $masterArray[$i]['pq_cellattr'][Main_Category][style]= 'background:#f44250;font-weight:bold;';
//                                        $validdata='FALSE';
//                                        $groupnamecomments.=$groupname." ,";
                                    }
                                }
                            }
                            }
                         }
                        
                         if(trim($keyvalue)=='Supplier_JSRS_Certified' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_JSRS_Certified][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_JSRS_Certified ,";
                        }
                         if(trim($keyvalue)=='Supplier_JSRS_Certified' && !empty($value1) && $wsdlobject->getJsrsvalidate($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_JSRS_Certified][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Supplier_JSRS_Certified ,";
                        }
                        
                        if(trim($keyvalue) == 'Supplier_JSRS_Certified')
                        {
                            
                           $wsdlobject=new \common\components\Wsdlcontract();
                            $jsrsval=$wsdlobject->getcasesenstive($value1);
                            if($jsrsval=='Yes')
                            {
                            $jsrssupp='yes';
                            
                            }else if($jsrsval=='No')
                            {
                                $jsrssupp='No';
                            }
                        }
                        if(trim($keyvalue)=='Awarded_to_JSRS_Supplier_Code' && empty($value1) && $jsrssupp=='yes')
                        {
                            $masterArray[$i]['pq_cellattr'][Awarded_to_JSRS_Supplier_Code][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Awarded_to_JSRS_Supplier_Code ,";
                        }
                        if(trim($keyvalue)=='Supplier_CR_Number' && empty($value1) && $jsrsval=='No')
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_CR_Number][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_CR_Number ,";
                        }
                        if(trim($keyvalue)=='Supplier_CR_Number' && !empty($value1) && strlen($value1)>250)
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_CR_Number][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_CR_Number ,";
                        }
                        if(trim($keyvalue)=='Supplier_CR_Number'  && $jsrsval=='No')
                        {
                            if($_SESSION['ocm_contract'] == 1){
                                $countryName = trim(strtolower($value['R'])); // Value must be from Country field
                            }else{
                                $countryName = trim(strtolower($value['Y'])); // Value must be from Country field
                            }
                            $JSRS_Status = ContractHelpers::get_CR_Status_In_JSRS_Now($value1,$countryName);
                             if($JSRS_Status['code'] == 3){
                                $masterArray[$i]['pq_cellattr'][Supplier_CR_Number][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $jsrsCertify=$JSRS_Status['errorText'];
                            }   
                        }
                        if(trim($keyvalue)=='Supplier_Country' && empty($value1) && $jsrssupp=='No')
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Country][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_Country ,";
                        }
                        if(trim($keyvalue)=='Supplier_Country' && !empty($value1) && $jsrssupp=='No')
                        {
                            $countryname=HelperFunctions::getCountryid($value1);
                            if(empty($countryname))
                            {
                            $masterArray[$i]['pq_cellattr'][Supplier_Country][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcountry=" Provided country is not matched with our system ,";
                            }
                        }
                        if(trim($keyvalue)=='Supplier_Name' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Name][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_Name ,";
                        }
                        if(trim($keyvalue)=='Supplier_Name' && !empty($value1) && strlen($value1)>250)
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Name][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_Name ,";
                        }

                        if(trim($keyvalue)=='Awarded_to_JSRS_Supplier_Code' && !empty($value1))
                        {
                            $suppliercode=$value1;
                        }                        
                        if(trim($keyvalue)=='Supplier_Name' && !empty($value1))
                        {
                            $suppliername=$value1;
                        }
                        if(trim($keyvalue)=='Supplier_CR_Number' && !empty($value1))
                        {
                            $crnumber=$value1;
                        }
                        if(!empty($suppliercode)  && trim($keyvalue)=='Supplier_Name' && $jsrssupp=='yes')
                        {
                           
                            $dataval['Awarded_to_JSRS_Supplier_Code']=$suppliercode;
                            $dataval['Supplier_CR_Number']=$crnumber;
                            $dataval['Supplier_Name']=$suppliername;
                           $wsdlobject=new \common\components\Wsdlcontract();
                            
                            $getdetails=$wsdlobject->getsupplierpk($dataval,TRUE);
                            
                            
                            if(!$getdetails)
                            {
                                $validdata='FALSE';
                                $masterArray[$i]['pq_cellattr'][Awarded_to_JSRS_Supplier_Code][style]= 'background:#f44250;font-weight:bold;';
                                $masterArray[$i]['pq_cellattr'][Supplier_CR_Number][style]= 'background:#f44250;font-weight:bold;';
                                
                                    $Jsrscomments="Contractor is not an JSRS Certified Supplier,";
                                
                                
                            }else if(!empty ($dataval['Awarded_to_JSRS_Supplier_Code']) && !empty ($getdetails)) {
                                
                               
                                if(trim($dataval['Supplier_CR_Number'])!=trim($getdetails->MCM_crnumber) && trim($dataval['Supplier_CR_Number']))
                                {
                                $masterArray[$i]['JSRS_Registered_CR_Number']=$getdetails->MCM_crnumber;
                                $masterArray[$i]['pq_cellattr'][JSRS_Registered_CR_Number][style]= 'background:#228B22;font-weight:bold;';
                               // $masterArray[$i]['pq_cellattr'][Supplier_CR_Number][style]= 'background:#f44250;font-weight:bold;';
//                                 $validdata='FALSE';
//                                 $overallcomments='Given CR Number is wrong, refer to "JSRS Registered CR Number" column for the registered CR Number of the supplier in JSRS';
                                }
                                
                                if(trim($dataval['Supplier_Name'])!=trim($getdetails->MCM_CompanyName))
                                {
//                                 $validdata='FALSE';
                                 $masterArray[$i]['JSRS_Registered_Supplier_Name']=$getdetails->MCM_CompanyName;
                                 $masterArray[$i]['pq_cellattr'][JSRS_Registered_Supplier_Name][style]= 'background:#228B22;font-weight:bold;';
                                }
                                
                            }

                        }
                       
//                        if(trim($keyvalue)=='e-Tendering_Mandate' && !empty($value1) && $wsdlobject->getcasesenstive($value1)=='Yes')
//                        {
//                            $eTedner='Yes';
//                        }
//                        if($eTedner=='Yes')
//                        {
                           

                            
                            
//                        }
                        if(trim($keyvalue)=='Award_Type' && empty($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Award_Type][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Award_Type ,";
                        }
                        if(trim($keyvalue)=='Award_Type' && !empty($value1) && $wsdlobject->getawardtype($value1)=='')
                        {
                            $masterArray[$i]['pq_cellattr'][Award_Type][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Award_Type ,";
                        }
                        if(trim($keyvalue)=="Award_Type" && !empty($value1) && $wsdlobject->getawardtype($value1)!='3')
                        {
                            $contractAmt='Yes';
                            $awardType=$wsdlobject->getawardtype($value1);
                        }else{
                            $awardType=$wsdlobject->getawardtype($value1);
                        }
                        if(trim($keyvalue)=='Obligation_Type' && empty($value1))
                         {
                               $masterArray[$i]['pq_cellattr'][Obligation_Type][style]= 'background:#f44250;font-weight:bold;';
                               $masterArray[$i]['pq_cellattr'][Obligation_Type][title]= 'Required Obligation type';
                               $Requiredcomments=" Obligation_Type ,";
                               $validdata='FALSE';
                        }                       
                        if(trim($keyvalue)=="Obligation_Type" && !empty($value1) && $wsdlobject->getOblicationType($value1)!=5)
                        {
                            $scoboblication='Yes';
                            if($wsdlobject->getOblicationType($value1)==3){
                                $sme_obligation='Yes';
                                $lcc_obligation='Yes';
                            }
                            if($wsdlobject->getOblicationType($value1)==1){
                                $sme_obligation='Yes';                                
                            }
                            if($wsdlobject->getOblicationType($value1)==2){
                                $lcc_obligation='Yes';                                
                            }
                            if($wsdlobject->getOblicationType($value1)==5){
                                $not_applicable='Yes';                                
                            }
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && !empty($value1) && $sme_obligation!='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" SME_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && is_numeric($value1) && $sme_obligation!='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" SME_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && !empty($value1) && $lcc_obligation!='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" LCC_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && is_numeric($value1) && $lcc_obligation!='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" LCC_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && is_numeric($value1) && $not_applicable=='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" SME_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && is_numeric($value1) && $not_applicable=='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $invalidcomments=" LCC_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='Obligation_Type' && !empty($value1) && ($wsdlobject->getOblicationType($value1)==0 || $wsdlobject->getOblicationType($value1) == 4))
                        {
                               $masterArray[$i]['pq_cellattr'][Obligation_Type][style]= 'background:#f44250;font-weight:bold;';
                               $masterArray[$i]['pq_cellattr'][Obligation_Type][title]= 'Required Obligation type';
                               $invalidcomments=" Obligation_Type ,";
                               $validdata='FALSE';
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && !is_numeric($value1) && $sme_obligation=='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $Requiredcomments=" SME_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && !empty($value1) && $sme_obligation=='Yes' && !is_numeric($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" SME_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && $sme_obligation=='Yes' && is_numeric($value1)){
                            if($value1 < 0){
                                $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" SME_Obligation_Percentage ,";
                            }
                            if($value1 > 100){
                                $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" SME_Obligation_Percentage ,";
                            }
                            $sme_decimal = explode('.', $value1);
                            if(!empty($sme_decimal[1])){
                                if(strlen($sme_decimal[1]) > 2){
                                    $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                    $validdata='FALSE';
                                    $invalidcomments=" SME_Obligation_Percentage ,";
                                }
                            }
                        }
                        if(trim($keyvalue)=='SME_Obligation_Percentage' && !empty($value1) && $sme_obligation=='Yes' && is_numeric($value1))
                        {
                            $sme_percentvalue = $value1;
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && !is_numeric($value1) && $lcc_obligation=='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $Requiredcomments=" LCC_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && !empty($value1) && $lcc_obligation=='Yes' && !is_numeric($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" LCC_Obligation_Percentage ,";
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && $lcc_obligation=='Yes' && is_numeric($value1)){
                            if($value1 < 0){
                                $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" LCC_Obligation_Percentage ,";
                            }
                            if($value1 > 100){
                                $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" LCC_Obligation_Percentage ,";
                            }
                            $lcc_decimal = explode('.', $value1);
                            if(!empty($lcc_decimal[1])){
                                if(strlen($lcc_decimal[1]) > 2){
                                    $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                    $validdata='FALSE';
                                    $invalidcomments=" LCC_Obligation_Percentage ,";
                                }
                            }
                        }
                        if(trim($keyvalue)=='LCC_Obligation_Percentage' && !empty($value1) && $lcc_obligation=='Yes' && is_numeric($value1))
                        {
                            $lcc_percentvalue = $value1;
                        }
                        $tot_percentvalue = 0;
                        if($sme_obligation=='Yes' && $lcc_obligation=='Yes' && (trim($keyvalue)=='LCC_Obligation_Percentage' || trim($keyvalue)=='SME_Obligation_Percentage'))
                        {
                            $tot_percentvalue = $sme_percentvalue + $lcc_percentvalue;
                            if($tot_percentvalue > 100){
                                $masterArray[$i]['pq_cellattr'][SME_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $masterArray[$i]['pq_cellattr'][LCC_Obligation_Percentage][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" SME_Obligation_Percentage , LCC_Obligation_Percentage ,";
                            }
                        }
                        if(trim($keyvalue)=='Scope_of_Obligation' && empty($value1) && $scoboblication=='Yes')
                        {
                               $masterArray[$i]['pq_cellattr'][Scope_of_Obligation][style]= 'background:#f44250;font-weight:bold;';
                               $validdata='FALSE';
                               $Requiredcomments=" Scope_of_Obligation ,";
                        }
                        
//                        if($contractAmt=='Yes' && $scoboblication=='Yes' && trim($keyvalue)=='Contract_Amount_USD' && $value1=='')
//                        {
//                            $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Contract_Amount_USD ,";
//                        }
//                        if($awardType==3 && $scoboblication=='Yes' && trim($keyvalue)=='Contract_Amount_USD' && $value1=='')
//                        {
//                            $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Contract_Amount_USD ,";
//                        }
                        if(trim($keyvalue)=='Contract_Amount_USD' && is_numeric($value1) && $value1==0)
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Contract_Amount_USD ,";
                        } 
                        if(trim($keyvalue)=='Contract_Amount_USD' && !empty($value1) && !is_numeric($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $invalidcomments=" Contract_Amount_USD ,";
                        } 
                        if(trim($keyvalue)=='Contract_Amount_USD' && !empty($value1) && strlen($value1)>30)
                        {
                            $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Contract_Amount_USD ,";
                        }
                        if(trim($keyvalue)=='Contract_Amount_USD' && !empty($value1))
                        {
                            
                            if (preg_match('/[\'^Â£$%&*()}{@#~?><>,|=_+Â¬-]/', $value1))
                            {
                                $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
                                $validdata='FALSE';
                                $invalidcomments=" Contract_Amount_USD ,";
                            }else{
                                if(count(explode('.',$value1))>2){
                                    $masterArray[$i]['pq_cellattr'][Contract_Amount_USD][style]= 'background:#f44250;font-weight:bold;';
                                    $validdata='FALSE';
                                    $invalidcomments=" Contract_Amount_USD ,";
                                }
                            }
                        }
                        if(trim($keyvalue)=='Operator_Contact_Person_Name' && !empty($value1) && strlen($value1)>100)
                        {
                            $masterArray[$i]['pq_cellattr'][Operator_Contact_Person_Name][style]= 'background:#f44250;font-weight:bold;';
                            $limitexceedcomments=" Operator_Contact_Person_Name ,";
                            $validdata='FALSE';
                        }

                       
                        if(trim($keyvalue)=='Phone' && !empty($value1) && strlen($value1)>15)
                        {
                            $masterArray[$i]['pq_cellattr'][Phone][style]= 'background:#f44250;font-weight:bold;';
                            $limitexceedcomments=" Phone ,";
                            $validdata='FALSE';
                        }
                        if(trim($keyvalue)=='Ext' && !empty($value1) && strlen($value1)>4)
                        {
                            $masterArray[$i]['pq_cellattr'][Ext][style]= 'background:#f44250;font-weight:bold;';
                            $limitexceedcomments=" Ext ,";
                            $validdata='FALSE';
                        }
                       
                        if(trim($keyvalue)=='Mobile' && !empty($value1) && strlen($value1)>15)
                        {
                            $masterArray[$i]['pq_cellattr'][Mobile][style]= 'background:#f44250;font-weight:bold;';
                            $limitexceedcomments=" Mobile ,";
                            $validdata='FALSE';
                        }
                        if(trim($keyvalue)=='Email' && !empty($value1) && !$this->isValidEmail($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Email][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $formatecomments=" Email ,";
                        }
//                        if(trim($keyvalue)=='Email' && !empty($value1))
//                        {
//                            $masterArray[$i]['pq_cellattr'][Email][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Email ,";
//                        }
                        if(trim($keyvalue)=='Supplier_Contact_Name' && empty($value1) && $jsrssupp=='No')
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Contact_Name][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_Contact_Name ,";
                        }
                        if(trim($keyvalue)=='Supplier_Contact_Name' && !empty($value1) && strlen($value1)>100)
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Contact_Name][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Supplier_Contact_Name ,";
                        }
                        if(trim($keyvalue)=='Supplier_Contact_Email' && empty($value1) && $jsrssupp=='No')
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Contact_Email][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $Requiredcomments=" Supplier_Contact_Email ,";
                        }
                        if(trim($keyvalue)=='Supplier_Contact_Email' && !empty($value1) && strlen($value1)>255)
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Contact_Email][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $limitexceedcomments=" Supplier_Contact_Email ,";
                        }
                        if(trim($keyvalue)=='Supplier_Contact_Email' && !empty($value1) && !$this->isValidEmail($value1))
                        {
                            $masterArray[$i]['pq_cellattr'][Supplier_Contact_Email][style]= 'background:#f44250;font-weight:bold;';
                            $validdata='FALSE';
                            $formatecomments=" Supplier_Contact_Email ,";
                        }
                        
                        if(trim($keyvalue)=='Contract_Status' && !empty($value1) && $wsdlobject->getcasesenstive($value1)=='Active')
                        {
                            $ContractCommend='Yes';
                        }
//                        if($ContractCommend=='Yes' && trim($keyvalue)=='Contract_Comments' && empty($value1))
//                        {
//                            $masterArray[$i]['pq_cellattr'][Contract_Comments][style]= 'background:#f44250;font-weight:bold;';
//                            $validdata='FALSE';
//                            $Requiredcomments=" Contract_Comments ,";
//                        }
//                        if(trim($keyvalue)=='Contract_Award_Certificate' && !empty($value1))
//                        {
//                            
//                            $explodUrl=explode(',', $value1);
//                            if(count($explodUrl)>1)
//                            {
//                                $jsrsCertify=" More than one Certificate is not allowed: ".$explodUrl[0];
//                                $masterArray[$i]['pq_cellattr'][Contract_Award_Certificate][style]= 'background:#f44250;font-weight:bold;';
//                                $validdata='FALSE';
//                            }else{
//                            foreach ($explodUrl as $expUrl) {
//                                if(substr(trim($expUrl), -3)!='pdf')
//                                {
//                                    $jsrsCertify=" Certificate format should be only PDF: ".$expUrl;
//                                    $masterArray[$i]['pq_cellattr'][Contract_Award_Certificate][style]= 'background:#f44250;font-weight:bold;';
//                                    $validdata='FALSE';
//                                }else if(!$wsdlobject->ValidUrl($expUrl)){
//                                     $jsrsCertify=" Certificate link in not valid: ".$expUrl;
//                                     $masterArray[$i]['pq_cellattr'][Contract_Award_Certificate][style]= 'background:#f44250;font-weight:bold;';
//                                    $validdata='FALSE';
//                                }
//                            }
//                            }
//                            
//                        }
                        if(trim($keyvalue)==$lastkeyvalue && $validdata=='TRUE')
                        {
                            
                            $successarray[] = $masterArray[$i];
                            unset($masterArray[$i]);
                            $i--;
                            $success++;
                            
                        }
                        
                        if($validdata=='FALSE'){
                            if(!empty($Requiredcomments))
                            {
                                if(empty($Requiredlabe))
                                {
                                    $overallcomments.= 'E'.++$j.". Required Fields: ".$Requiredcomments;
                                    $Requiredlabe=1;
                                }else{
                                    $overallcomments.= $Requiredcomments;
                                }

                            }
                            if(!empty($Requiredcountry))
                            {
                                    $overallcomments.= 'E'.++$j.".". $Requiredcountry;

                            }
                            if(!empty($limitexceedcomments))
                            {

                                if(empty($limitexceedlable))
                                {
                                    $overallcomments.= 'E'.++$j.". Fields which exceeded the allowed Character: ".$limitexceedcomments;
                                    $limitexceedlable=1;
                                }else{
                                    $overallcomments.= $limitexceedcomments;
                                }
                            }
                            
                            if(!empty($formatecomments))
                            {
                                if(empty($formatelable))
                                {
                                    $overallcomments.= 'E'.++$j.". Field type mismatch: ".$formatecomments;
                                    $formatelable=1;
                                }else{
                                    $overallcomments.= $formatecomments."";
                                }
                            }
                            if(!empty($invalidcomments))
                            {
                                if(empty($invalidlable))
                                {
                                    $overallcomments.= 'E'.++$j.". Invalid data: ".$invalidcomments;
                                    $invalidlable=1;
                                }else{
                                    $overallcomments.= $invalidcomments."";
                                }
                            }
                            if(!empty($GroupCatecomments))
                            {
                                $GroupCatelable="";
                                if(empty($GroupCatelable))
                                {
                                    $overallcomments.= 'E'.++$j.". Group Category is not valid: ".$GroupCatecomments;
                                    $GroupCatelable=1;
                                }else{
                                    $overallcomments.= $GroupCatecomments;
                                }
                            }
                            if(!empty($MainCatecomments))
                            {
                                if(empty($MainCatelable))
                                {
                                    $overallcomments.= 'E'.++$j.". Main Category is not valid: ".$MainCatecomments;
                                    $MainCatelable=1;
                                }else{
                                    $overallcomments.= $MainCatecomments;
                                }
                            }
//                            if(!empty($groupnamecomments))
//                            {
//                                $overallcomments.= ++$j." Main category is required for the Group Category: ".$groupnamecomments;
//                            }
                            if(!empty($jsrsCertify))
                            {
                                $overallcomments.= 'E'.++$j.". ".$jsrsCertify;
                            }
                            if(!empty($Jsrscomments))
                            {
                               
                                if(empty($Jsrslable))
                                {
                                    $overallcomments.= 'E'.++$j.". Contractor is not an JSRS Certified Supplier. "; $Jsrslable=1;
                                }else{
                                    $overallcomments.= $Jsrscomments."";
                                }
                            }
                            if(!empty($TednerComments))
                            {
                                $masterArray[$i]['Over_all_Comments']= "E1.".$TednerComments;
                            }else  if(!empty($contractComments))
                            {
                                 $masterArray[$i]['Over_all_Comments']= "E1.".$contractComments;
                            }else{
                            $masterArray[$i]['Over_all_Comments'] = $overallcomments;
                            }
                        }
                        
                        $Requiredcomments="";
                        $limitexceedcomments="";
                        $GroupCatecomments="";
                        $formatecomments="";
                        $invalidcomments="";
                        $MainCatecomments="";
                        $groupnamecomments="";
                        $jsrsCertify="";
                        $Requiredcountry="";
                    }
                    $i++;
                }
                
                $jsonData['errorarray']= $masterArray;
                $jsonData['successarray']= $successarray;
                $jsonData['failed']= $i;
                $jsonData['success']= $success;
                $jsonData['total']= $success+$i;
                $jsonData['templdatestatus']= $templdatestatus;
                $_SESSION['totalcount']=$jsonData['total'];
                 

        return json_encode($jsonData);
          
    }

    public function actionCreateexcel() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        \api\modules\pms\models\CmsimportaudittrailmstTbl::createExcel($formdata);   
    }

    public function actionGetaudittrialdata() {
        $sort = Yii::$app->getRequest()->getQueryParam('sort');
        return \api\modules\pms\models\CmsimportaudittrailmstTbl::getAuditData($sort);
    }

        /**
     * @SWG\Post(
     *     path="/pms/pms/rfxrepublish",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Submit Dynamic Form",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="rfx_id", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionRfxrepublish() {
        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $rfx_id = Security::decrypt($formdata['rfx_id']);
        $rfx_id = Security::sanitizeInput($rfx_id, "number");
        if ($rfx_id) {
            $data = Pms::rfxrepublish($rfx_id);
            return $data;
        }
    }

    /**
     * @SWG\Post(
     *     path="/pms/pms/getexistingquestionnarietmp",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Requisition Product List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetexistingquestionnarietmp() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        if ($formdata) {
            $data = Pms::getexistingquestionnarietmp($formdata);
            return $data;
        }
    }
    
    /**
     * @SWG\Post(
     *     path="/pms/pms/getgroupcategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Group Category List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetgroupcategory() {
        $data = Pms::getGroupCategory();
        return $data;
    }
    
    /**
     * @SWG\Post(
     *     path="/pms/pms/getmaincategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Main Category List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetmaincategory() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = [];
        if(count($formdata['grpcatpk'])){
            $catvalue = implode(',', $formdata['grpcatpk']);
            $data = Pms::getMainCategory($catvalue);
        }            
       return $data;
    }
    
    /**
     * @SWG\Post(
     *     path="/pms/pms/getsubcategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Sub Category List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetsubcategory() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = [];
        if(count($formdata['maincatpk'])){
            $catvalue = implode(',', $formdata['maincatpk']);
            $data = Pms::getSubCategory($catvalue);
        }            
       return $data;
    }
    
    /**
     * @SWG\Post(
     *     path="/pms/pms/savegrpcategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Group Category",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSavecontractcategory() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $ContractPk = Security::decrypt($formdata['formData']['ContractPk']);
        $formdata['formData']['ContractPk'] = Security::sanitizeInput($ContractPk, "number");
        $data = [];
        $data = Pms::saveContractCategory($formdata['formData']);          
       return $data;
    }
    
    /**
     * @SWG\Post(
     *     path="/pms/pms/getselectedgroupcategory",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Group Category List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="formdata", type="object"),
     *                      @SWG\Property(property="formtitle", type="object"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetselectedcategory() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $ContractPk = Security::decrypt($formdata['contractpk']);
        $formdata['contractpk'] = Security::sanitizeInput($ContractPk, "number");
        $data = [];
        $data = Pms::getselectedCategory($formdata['contractpk']);
        return $data;
        
    }
    /**
     * @SWG\Post(
     *     path="/pms/pms/geticvenable",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Get Contract Group Category List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="projectPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGeticvenable() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $projectPk = Security::decrypt($formdata['projectPk']);
        $projectPk = Security::sanitizeInput($projectPk, "number");
        $data = [];
        $data = Pms::getICVEnable($projectPk);
        return $data;
        
    }
}