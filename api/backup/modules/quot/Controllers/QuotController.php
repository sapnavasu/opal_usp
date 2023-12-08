<?php

namespace api\modules\quot\controllers;


use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use \common\components\Security;
use api\modules\quot\controllers\QuotationMasterController;
use api\modules\quot\components\Quot;
use Yii;


class QuotController extends QuotationMasterController {

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

    /**
     * @SWG\Post(
     *     path="/quot/quot/getformdata",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Form data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataPk", type="string"),
     *                  @SWG\Property(property="currentPK", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetformdata(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $currentPK = Security::decrypt($formdata['currentPK']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $data = Quot::getFormData($dataPk,$currentPK);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/getviewformdata",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Form data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="currentPK", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetviewformdata(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPK = Security::decrypt($formdata['currentPK']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $data = Quot::getFormViewData($currentPK);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/getscopedata",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get Scope Product and Service Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataPk", type="string"),
     *                  @SWG\Property(property="currentPK", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetscopedata() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $currentPK = Security::decrypt($formdata['currentPk']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $data = Quot::getScopeData($dataPk, $currentPK, $formdata['dataType']);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/save-detail",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation detail data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="tenderhdr_fk", type="integer"),
     *                      @SWG\Property(property="quotationtitle", type="string"),
     *                      @SWG\Property(property="quotationrefno", type="string"),
     *                      @SWG\Property(property="initiatedby", type="integer"),
     *                      @SWG\Property(property="initiateddate", type="string", example="2021-07-01 10:10:10"),
     *                      @SWG\Property(property="secondary_memcompmst_fk", type="string")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveDetail(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata = $formdata['formData'];
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $currentPK = Security::decrypt($formdata['currentPk']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $formdata['dataPk'] = $dataPk;
        $formdata['currentPk'] = $currentPK;
        $data = Quot::saveDetail($formdata);
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
        $data = Quot::chkValidRefNumber($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-scope",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Scope data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="scopedesc", type="string"),
     *                      @SWG\Property(property="grandtotalamount", type="number"),
     *                      @SWG\Property(property="scope_currencymst_fk", type="integer"),
     *                      @SWG\Property(property="items", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="msrqprodservdtls_fk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="unitprice", type="number"),
     *                              @SWG\Property(property="unitcurrency_fk", type="integer"),
     *                              @SWG\Property(property="tax", type="number"),
     *                              @SWG\Property(property="discount", type="number"),
     *                              @SWG\Property(property="amount", type="number")
     *                            )
     *                      ),
     *                      @SWG\Property(property="additional_charges", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="name", type="string"),
     *                              @SWG\Property(property="amount", type="number")
     *                          )
     *                      )
     *                 ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionSaveScope(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPk = Security::decrypt($formdata['formData']['currentPk']);
        $currentPk = Security::sanitizeInput($currentPk, "number");
        $formdata['formData']['currentPk'] = $currentPk;
        $data = Quot::saveScope($formdata['formData']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-specification",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation sepcification data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="cmstnctrnx_fk", type="integer"),
     *                      @SWG\Property(property="shared_type", type="integer"),
     *                      @SWG\Property(property="type", type="integer"),
     *                      @SWG\Property(property="comments", type="string"),
     *                      @SWG\Property(property="remarks", type="string")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveSpecification(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPk = Security::decrypt($formdata['formData']['currentPk']);
        $currentPk = Security::sanitizeInput($currentPk, "number");
        $formdata['formData']['currentPk'] = $currentPk;
        $dataPk = Security::decrypt($formdata['formData']['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $formdata['formData']['dataPk'] = $dataPk;
        $data = Quot::saveSpecification($formdata['formData']);
        return $data;    }
    
    /**
     * @SWG\Post(
     *     path="/quot/quot/get-added-product-service",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get Added Product Service",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetAddedProductService(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPk = Security::decrypt($formdata['currentPk']);
        $currentPk = Security::sanitizeInput($currentPk, "number");
        $data = Quot::GetAddedProductService($currentPk);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/get-scope-view-data",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get Added Product Service",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="currentPK", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetScopeViewData(){
        $formdata = $_REQUEST;
        $currentPK = Security::decrypt($formdata['currentPK']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $formdata['currentPK'] = $currentPK;
        $data = Quot::getScopeProductServiceList($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-questionnaire",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Questionnaire",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="form_id", type="integer"),
     *                      @SWG\Property(property="shared_type", type="integer"),
     *                      @SWG\Property(property="answer", type="string"),
     *                      @SWG\Property(property="status", type="integer")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveQuestionnaire(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::saveQuestionnaire($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-deviation",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="currentPk", type="string"),
     *                       @SWG\Property(property="records", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="itemno", type="string"),
     *                              @SWG\Property(property="currequirement", type="string"),
     *                              @SWG\Property(property="reasondeviation", type="string")
     *                            )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveDeviation(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPk = Security::decrypt($formdata['formData']['currentPk']);
        $currentPk = Security::sanitizeInput($currentPk, "number");
        $formdata['formData']['currentPk'] = $currentPk;
        $data = Quot::saveDeviation($formdata['formData']);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/data-final-save",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="currentPk", type="string"),
     *                       @SWG\Property(property="records", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="itemno", type="string"),
     *                              @SWG\Property(property="currequirement", type="string"),
     *                              @SWG\Property(property="reasondeviation", type="string")
     *                            )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDataFinalSave(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPk = Security::decrypt($formdata['currentPk']);
        $currentPk = Security::sanitizeInput($currentPk, "number");
        $data = Quot::dataFinalSave($currentPk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-supporting-document",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Supporting Document",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="type", type="integer"),
     *                      @SWG\Property(property="docname", type="string"),
     *                      @SWG\Property(property="compfile_fk", type="integer"),
     *                      @SWG\Property(property="status", type="integer"),
     *                      @SWG\Property(property="remark", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveSupportingDocument(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::saveSupportingDocument($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-termscondition",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                       @SWG\Property(property="payment_terms", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="memcompmst_fk", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="name", type="string"),
     *                              @SWG\Property(property="value", type="string")
     *                            )
     *                      ),
     *                      @SWG\Property(property="invoice_interval", type="number"),
     *                      @SWG\Property(property="invoice_interval_type", type="integer"),
     *                      @SWG\Property(property="bidder_interval", type="number"),
     *                      @SWG\Property(property="bidder_interval_type", type="integer"),
     *                      @SWG\Property(property="bidder_date", type="string", example="2021-07-01"),
     *                      @SWG\Property(property="buyer_terms", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="cmstnctrnx_fk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="comment", type="string"),
     *                              @SWG\Property(property="remarks", type="string")
     *                            )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveTermscondition(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $currentPK = Security::decrypt($formdata['formData']['currentPk']);
        $currentPK = Security::sanitizeInput($currentPK, "number");
        $formdata['formData']['currentPk'] = $currentPK;
        $data = Quot::saveTermsCondition($formdata['formData']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/save-comm-detail",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation communication contact detail",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="user_contact", type="string")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionSaveCommDetail(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $data = Quot::saveCommDetail($dataPk, $formdata['userPk']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/get-detail",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation detail",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetDetail(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getDetail($formdata);
        return $data;
    }

    public function actionGetquotationidfromtender(){
         $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);

        $data = Quot::getQuotation($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/get-specification",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation specification",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetSpecification(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $data = Quot::getSpecification($dataPk,$formdata['dataType']);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/audit-list",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation Audit List",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="dataPk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAuditList(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $formdata['dataPk'] = Security::sanitizeInput($dataPk, "number");
        $data = Quot::getAuditList($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/get-scope",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation scope",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetScope(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getScope($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/get-questionnaire",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation questionnaire",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetQuestionnaire(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getQuestionnaire($formdata);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/quot/quot/get-deviation",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetDeviation(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $data = Quot::getDeviation($dataPk,$formdata['dataType']);
        return $data;
    }

/**
     * @SWG\Post(
     *     path="/quot/quot/get-supdocument",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetSupdocument(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getSupdocument($formdata);
        return $data;
    }

/**
     * @SWG\Post(
     *     path="/quot/quot/get-termscondition",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetTermscondition(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getTermscondition($formdata);
        return $data;
    }

    
/**
     * @SWG\Post(
     *     path="/quot/quot/get-communication",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Get quotation deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
    * @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="quotationpk", type="integer"
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionGetCommunication(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::getCommunication($formdata);
        return $data;
    }

    /**
     * @SWG\put(
     *     path="/quot/quot/update-detail",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="update Quotation detail data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="tenderhdr_fk", type="integer"),
     *                      @SWG\Property(property="quotationtitle", type="string"),
     *                      @SWG\Property(property="quotationrefno", type="string"),
     *                      @SWG\Property(property="initiatedby", type="integer"),
     *                      @SWG\Property(property="initiateddate", type="string", example="2021-07-01 10:10:10"),
     *                      @SWG\Property(property="secondary_memcompmst_fk", type="string")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateDetail(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateDetail($formdata);
        return $data;
    }

    /**
     * @SWG\Put(
     *     path="/quot/quot/update-scope",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Update Quotation Scope data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="scopedesc", type="string"),
     *                      @SWG\Property(property="grandtotalamount", type="number"),
     *                      @SWG\Property(property="scope_currencymst_fk", type="integer"),
     *                      @SWG\Property(property="items", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="tendermap_pk", type="integer"),
     *                              @SWG\Property(property="msrqprodservdtls_fk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="unitprice", type="number"),
     *                              @SWG\Property(property="unitcurrency_fk", type="integer"),
     *                              @SWG\Property(property="tax", type="number"),
     *                              @SWG\Property(property="discount", type="number"),
     *                              @SWG\Property(property="amount", type="number")
     *                            )
     *                      ),
     *                      @SWG\Property(property="additional_charges", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="tendercharges_pk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="name", type="string"),
     *                              @SWG\Property(property="amount", type="number")
     *                          )
     *                      )
     *                 ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */

    public function actionUpdateScope(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateScope($formdata);
        return $data;
    }

    /**
     * @SWG\Put(
     *     path="/quot/quot/update-specification",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Update Quotation sepcification data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="cmstnctrnx_fk", type="integer"),
     *                      @SWG\Property(property="shared_type", type="integer"),
     *                      @SWG\Property(property="type", type="integer"),
     *                      @SWG\Property(property="comments", type="string"),
     *                      @SWG\Property(property="remarks", type="string")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateSpecification(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateSpecification($formdata);
        return $data;
    }

     /**
     * @SWG\Put(
     *     path="/quot/quot/update-questionnaire",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Add Quotation Questionnaire",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="form_id", type="integer"),
     *                      @SWG\Property(property="shared_type", type="integer"),
     *                      @SWG\Property(property="answer", type="string"),
     *                      @SWG\Property(property="status", type="integer")
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateQuestionnaire(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateQuestionnaire($formdata);
        return $data;
    }

    /**
     * @SWG\Put(
     *     path="/quot/quot/update-deviation",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="update Quotation Deviation",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                       @SWG\Property(property="records", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="deviation_pk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="itemno", type="string"),
     *                              @SWG\Property(property="currequirement", type="string"),
     *                              @SWG\Property(property="reasondeviation", type="string")
     *                            )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateDeviation(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateDeviation($formdata);
        return $data;
    }

    /**
    *   @SWG\Delete(
     *     path="/quot/qout/delete-deviation/{ids}",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Delete",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(parameter="ids", name="ids", type="integer", in="path"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteDeviation() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        return Quot::deleteDeviation($dataPk);
    }

    /**
     * @SWG\Put(
     *     path="/quot/quot/update-supporting-document",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Update Quotation Supporting Document",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                      @SWG\Property(property="type", type="integer"),
     *                      @SWG\Property(property="docname", type="string"),
     *                      @SWG\Property(property="compfile_fk", type="integer"),
     *                      @SWG\Property(property="status", type="integer"),
     *                      @SWG\Property(property="remark", type="string"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateSupportingDocument(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateSupportingDocument($formdata);
        return $data;
    }

    /**
     * @SWG\Put(
     *     path="/quot/quot/update-termscondition",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Update Quotation termscondition",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="formData", type="object",
     *                      @SWG\Property(property="quotationpk", type="integer"),
     *                       @SWG\Property(property="payment_terms", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="payment_pk", type="integer"),
     *                              @SWG\Property(property="memcompmst_fk", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="name", type="string"),
     *                              @SWG\Property(property="value", type="string")
     *                            )
     *                      ),
     *                      @SWG\Property(property="invoice_interval", type="number"),
     *                      @SWG\Property(property="invoice_interval_type", type="integer"),
     *                      @SWG\Property(property="bidder_interval", type="number"),
     *                      @SWG\Property(property="bidder_interval_type", type="integer"),
     *                      @SWG\Property(property="bidder_date", type="string", example="2021-07-01"),
     *                      @SWG\Property(property="buyer_terms", type="array",
     *                            @SWG\Items(type="object",
     *                              @SWG\Property(property="buyer_pk", type="integer"),
     *                              @SWG\Property(property="cmstnctrnx_fk", type="integer"),
     *                              @SWG\Property(property="shared_type", type="integer"),
     *                              @SWG\Property(property="type", type="integer"),
     *                              @SWG\Property(property="comment", type="string"),
     *                              @SWG\Property(property="remarks", type="string")
     *                            )
     *                      ),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionUpdateTermscondition(){
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $data = Quot::updateTermsCondition($formdata);
        return $data;
    }

    /**
    *   @SWG\Delete(
     *     path="/quot/qout/delete-termscondition",
     *     tags={"quot"},
     *     produces={"application/json"},
     *     summary="Delete termscondition",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(parameter="ids", name="ids", type="integer", in="path"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeleteTermscondition() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        return Quot::deleteTermscondition($dataPk);
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/save-questionnaire-form",
     *     tags={"rfx"},
     *     produces={"application/json"},
     *     summary="Save RFX Questionnaire Form",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="rfx_pk", type="integer", example=3),
     *                  @SWG\Property(property="questionnaire_pk", type="integer", example=1),
     *                  @SWG\Property(property="data", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionSaveQuestionnaireForm() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $quot_pk = Security::decrypt($formdata['quot_pk']);
        $quot_pk = Security::sanitizeInput($quot_pk, "number");
        $data = Quot::saveQuestionnaireForm($quot_pk, $formdata['data'],$formdata['dataType']);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/quot/quot/get-questionnaire-form-answer",
     *     tags={"rfx"},
     *     produces={"application/json"},
     *     summary="Get RFX Questionnaire Form Answer",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="pk", type="integer", example=3),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetQuestionnaireFormAnswer() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $qpk = Security::decrypt($formdata['qpk']);
        $qpk = Security::sanitizeInput($qpk, "number");
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, 'number');
        $type = Security::sanitizeInput($formdata['type'], 'number');
        $data = Quot::getQuestionnaireFormAnswer($qpk, $dataPk, $type);
        return $data;
    }
}