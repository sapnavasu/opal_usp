<?php

namespace api\modules\review\controllers;

use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\Controller;
use common\components\Sessionn;
use api\modules\review\components\Review;
use common\components\Configsession;
use \common\components\Security;

/**
 * Default controller for the `review` module
 */
class ReviewController extends ReviewMasterController {

    public $modelClass = '\common\models\MemcompreviewdtlsTbl';

    public function __construct($id, $module, $config = []) {
        parent::__construct($id, $module, $config);
    }

    public function actions() {
        return [];
    }

    public function beforeAction($action) {
        header('Content-type: application/json; charset=utf-8');
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
     *     path="/review/review/addreview",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Add Review Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="reviewData", type="object",
     *                      @SWG\Property(property="userpk", type="string"),
     *                      @SWG\Property(property="reviewPK", type="string"),
     *                      @SWG\Property(property="shared_pk", type="string"),
     *                      @SWG\Property(property="type", type="integer"),
     *                      @SWG\Property(property="companyName", type="string"),
     *                      @SWG\Property(property="name", type="string"),
     *                      @SWG\Property(property="email", type="string"),
     *                      @SWG\Property(property="comments", type="string"),
     *                      @SWG\Property(property="rating", type="integer"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionAddreview() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);  
        $data = Review::addreview($formdata);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/review/review/replay",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Add Replay Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="replayData", type="object",
     *                      @SWG\Property(property="comments", type="string"),
     *                      @SWG\Property(property="company_Pk", type="string"),
     *                      @SWG\Property(property="reviewPK", type="string"),
     *                      @SWG\Property(property="type", type="integer"),
     *              ),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionReplay() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true); 
        $company_Pk = Security::decrypt($formdata['replayData']['company_Pk']);
        $formdata['replayData']['company_Pk'] = Security::sanitizeInput($company_Pk, "number");
        $reviewPK = Security::decrypt($formdata['replayData']['reviewPK']);
        $formdata['replayData']['reviewPK'] = Security::sanitizeInput($reviewPK, "number");
        $data = Review::addReplay($formdata);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/review/review/deletereview",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Delete Review Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="review_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionDeletereview() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);  
        $data = Review::deleteReview($formdata);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/review/review/getratingreviewcount",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Get Review And Rating Count",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="shared_pk", type="string"),
     *                  @SWG\Property(property="type", type="integer"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetratingreviewcount() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedPk = Security::decrypt($formdata['shared_pk']);
        $sharedPk = Security::sanitizeInput($sharedPk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $data = Review::GetRatingReviewCount($sharedPk,$type);
        return $data;
    }
    /**
     * @SWG\Post(
     *     path="/review/review/getcurrentuser",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Get User Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="sharedPk", type="string"),
     *                  @SWG\Property(property="userPk", type="string"),
     *                  @SWG\Property(property="type", type="integer"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetcurrentuser() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedPk = Security::decrypt($formdata['sharedPk']);
        $sharedPk = Security::sanitizeInput($sharedPk, "number");
        $userPk = Security::decrypt($formdata['userPk']);
        $userPk = Security::sanitizeInput($userPk, "number");
        $type = Security::sanitizeInput($formdata['type'], "number");
        $data = Review::getCurrentUser($sharedPk,$type,$userPk);
        return $data;
    }

        /**
     * @SWG\Post(
     *     path="/review/review/getreviewhistory",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Get User Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="rev_pk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionGetreviewhistory() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $rev_pk = Security::decrypt($formdata['rev_pk']);
        $rev_pk = Security::sanitizeInput($rev_pk, "number");
        $data = Review::getreiewhistory($rev_pk);
        return $data;
    }

    /**
     * @SWG\Post(
     *     path="/review/review/likereview",
     *     tags={"Review"},
     *     produces={"application/json"},
     *     summary="Like Review Data",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                  @SWG\Property(property="detailPk", type="string"),
     *                  @SWG\Property(property="user", type="string"),
     *                  @SWG\Property(property="company", type="string"),
     *                  @SWG\Property(property="typeofModule", type="string"),
     *                  @SWG\Property(property="type", type="string"),
     *                  @SWG\Property(property="status", type="integer"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionLikereview() {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);  
        $reviewPk = Security::decrypt($data['review_pk']);
        $data['review_pk'] = Security::sanitizeInput($reviewPk, "number");
        $followtype = Security::decrypt($data['followtype']);
        $data['followtype'] = Security::sanitizeInput($followtype, "number");
        $type = Security::decrypt($data['type']);
        $data['type'] = Security::sanitizeInput($type, "number");
        $company = Security::decrypt($data['company']);
        if($company != null){
            $data['company'] = Security::sanitizeInput($company, "number");
        } else {
            $data['company'] =null;
        }
        $user = Security::decrypt($data['user']);  
        if($user != null){ 
        $data['user'] = Security::sanitizeInput($user, "number");         
        } else {
        $data['user'] = null;                 
        }
        $likedata = Review::likeReview($data);
        return $likedata;
    }
    /**
     * @SWG\Get(
     *     path="/review/review/index",
     *     tags={"Review"},
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     summary="It is used to get list of review data.",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     @SWG\Parameter(in = "formData", name = "sort", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "integer"),
     *     @SWG\Parameter(in = "formData", name = "sharedPk", type = "string"),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public function actionIndex(){
        return Review::index($_REQUEST);
    }

}
