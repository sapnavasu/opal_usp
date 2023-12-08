<?php

namespace api\modules\ct\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\ct\models\ColtaskdtlsTbl;
use api\modules\ct\models\ColdiscussdtlsTbl;
use api\modules\ct\models\CollaborativemstTbl;
use api\modules\ct\models\ColdiscusshdrTbl;
use api\modules\ct\models\ColmeetingdtlsTbl;
use api\modules\ct\models\ColnotesdtlTbl;
use api\modules\ct\models\ColprojaudienceTbl;
use api\modules\ct\components\Collaborate;
use common\components\Security;
use api\modules\ct\models\JdomoduledtlTbl;
use api\modules\ct\models\JdotargetmemberTbl;
use api\modules\ct\models\JdodiscussdtlTbl;
use api\modules\ct\models\JdodiscusshdrTbl;
use api\modules\ct\models\JdotaskhdrTbl;
use api\modules\ct\models\JdonoteshdrTbl;

/**
 * Default controller for the `ct` module
 */
class CollaborateController extends ActiveController
{
    public $modelClass = 'api\modules\ct\models\CollaborativemstTbl';
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

        return $behaviors;
    }
    public function actionIndex()
    {
        return 'success';
    }
    /**
     * @SWG\Post(path="/ct/collaborate/collaboratecountlist",
     *     tags={"collaborate"},
     *     summary="Collaboration Card Count list",
     * @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "regpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCollaboratecountlist()
    {

        $response = Collaborate::collaborateCountlisting();
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/createcard",
     *     tags={"collaborate"},
     *     summary="Create & Update Card",
     * @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *   @SWG\Parameter(in = "formData", name = "regpk", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "jodmoduledtlpk", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "jdomodulemstpk", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "sharedtype", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "sharedfk", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "title", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "subject", type = "string"),
     *   @SWG\Parameter(in = "formData", name = "type", type = "string"),
     *    @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCreatecard()
    {
        $formdata = Yii::$app->request->post();
        $response = Collaborate::addcollaborate($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/cardlist",
     *     tags={"collaborate"},
     *     summary="Card listing",
     *  @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "regpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "user_type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "jdomodulemst_pk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "start_date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "end_date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "size", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "order", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "page", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCardlist()
    {
        
        $formdata = $_REQUEST;
        $response = Collaborate::cardlisting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/changecardstatus",
     *     tags={"collaborate"},
     *     summary="Card status Disabled & Archive",
     *  @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdomoduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "card_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionChangecardstatus()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::changecardstatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/addteammembers",
     *     tags={"collaborate"},
     *     summary="Add Team Members",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdomoduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "comppk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "internal_users", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "external_users", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionAddteammembers()
    {
        $formdata = Yii::$app->request->post();
        $formdata = $formdata['dataArray'];
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $response = Collaborate::addteammember($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/updateinvitestatus",
     *     tags={"collaborate"},
     *     summary="Invite status Accept or Decline",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "dataPk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdateinvitestatus()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::updateinvitestatus($formdata['dataPk']);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/getviewcarddata",
     *     tags={"collaborate"},
     *     summary="Invite status Accept or Decline",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "dataPk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionGetviewcarddata()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::getViewCardData($formdata['dataPk']);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/creatediscussion",
     *     tags={"collaborate"},
     *     summary="Discussion Create & Update",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdodishdrpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "target_members", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "filepath", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "disc_title", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "disc_desc", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCreatediscussion()
    {
        $formdata = Yii::$app->request->post();
        $formdata = $formdata['dataArray'];
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['discussionPk'] = Security::decrypt($formdata['discussionPk']);
        $response = Collaborate::adddiscussion($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/discussionstatuschange",
     *     tags={"collaborate"},
     *     summary="Discussion Status Chnage",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "dataArray", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDiscussionstatuschange()
    {
        $formdata = Yii::$app->request->post();
        $response = Collaborate::discussionStatusChange($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/discussionlisting",
     *     tags={"collaborate"},
     *     summary="Disussion Listing",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDiscussionlisting()
    {
        $formdata = $_REQUEST;
        $formdata['dtlsPK'] = Security::decrypt($formdata['dtlsPK']);
        $response = Collaborate::discussionlisting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/adddiscussionmsg",
     *     tags={"collaborate"},
     *     summary="Discussion message",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdodishdrpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "targetmempk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "message", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "filepk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionAdddiscussionmsg()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdodishdrpk'] = Security::decrypt($formdata['jdodishdrpk']);
        $response = Collaborate::adddiscussionmsg($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/editdiscussionmessage",
     *     tags={"collaborate"},
     *     summary="Edit Discussion message",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "messagepk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "message", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "filepk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionEditdiscussionmessage()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdodishdrpk'] = Security::decrypt($formdata['jdodishdrpk']);
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::editDiscussionmessage($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/deletediscmessage",
     *     tags={"collaborate"},
     *     summary="Delete Discussion message",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "messagepk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDeletemessage()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $messagepk = Security::decrypt($formdata['messagepk']);
        $messagepk = Security::sanitizeInput($messagepk, 'number');
        $response = Collaborate::deletemessage($messagepk);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/updatemessagestatus",
     *     tags={"collaborate"},
     *     summary="Discussion message read status update",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "coldiscdtlspk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "msg_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatemessagestatus()
    {
        $formdata = Yii::$app->request->post();
        $colmstpk = Security::decrypt($formdata['colmstpk']);
        $formdata['colmstpk'] = Security::sanitizeInput($colmstpk, 'number');
        $card = CollaborativemstTbl::findOne($formdata['colmstpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->cpm_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['messagepk'] = Security::decrypt($formdata['messagepk']);
        $response = ColdiscussdtlsTbl::updatemessagestatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/discussioninfo",
     *     tags={"collaborate"},
     *     summary="Discussion information",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdodishdrpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDiscussioninfo()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdodishdrpk'] = Security::decrypt($formdata['jdodishdrpk']);
        $response = Collaborate::discussioninfo($formdata);
        return $response;
    }
    
    /**
     * @SWG\Post(path="/ct/collaborate/discussionmsglist",
     *     tags={"collaborate"},
     *     summary="Discussion message informations",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdodishdrpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDiscussionmsglist()
    {
        $formdata = Yii::$app->request->post();
        $dataPk = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::discussionmsglist($dataPk);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/discussionmsginfo",
     *     tags={"collaborate"},
     *     summary="Discussion message informations",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "jdodishdrpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDiscussionmsginfo()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdodishdrpk'] = Security::decrypt($formdata['jdodishdrpk']);
        $response = Collaborate::discussionmsginfo($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/adddicsussionmember",
     *     tags={"collaborate"},
     *     summary="Add Member in discussion",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "discusshdrfk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "targetmemberfk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionAdddicsussionmember()
    {
        $formdata = Yii::$app->request->post();
        $discusshdrfk = Security::decrypt($formdata['discusshdrfk']);
        $formdata['discusshdrfk'] = Security::sanitizeInput($discusshdrfk, 'number');
        $targetmemberfk = Security::decrypt($formdata['targetmemberfk']);
        $formdata['targetmemberfk'] = Security::sanitizeInput($targetmemberfk, 'number');
        $response = Collaborate::savediscussionmember($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    // public function actionPindiscussion(){
    //     $formdata = Yii::$app->request->post();
    //     $formdata['coldischdrpk'] = Security::decrypt($formdata['coldischdrpk']);
    //     $response = ColdiscusshdrTbl::pindiscussion($formdata);
    //     return [
    //         'msg' => 'success',
    //         'status' => 200,
    //         'items' => $response
    //     ];
    // }

    /**
     * @SWG\Post(path="/ct/collaborate/updatediscusstatus",
     *     tags={"collaborate"},
     *     summary="Close discussion",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "discusshdrpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatediscusstatus()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['moduledtlpk']);
        $formdata['moduledtlpk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['moduledtlpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['discusshdrpk'] = Security::decrypt($formdata['discusshdrpk']);
        $response = Collaborate::updateDiscusStatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/createtask",
     *     tags={"collaborate"},
     *     summary="Create & Update Task",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "tasktitle", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskdesc", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "time", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "isallday", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "timezonepk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "filepk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCreatetask()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['trgtmemPk'] = Security::decrypt($formdata['trgtmemPk']);
        $formdata['taskpk'] = Security::decrypt($formdata['taskpk']);

        $response = Collaborate::addtask($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/tasklisting",
     *     tags={"collaborate"},
     *     summary="Task Listing",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionTasklisting()
    {
        $formdata = Yii::$app->request->post();
        $dataPk = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::tasklisting($dataPk);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/updatetaskstatus",
     *     tags={"collaborate"},
     *     summary="Update Task Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskstatus", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatetaskstatus()
    {
        $formdata = Yii::$app->request->post();
        $formdata['taskpk'] = Security::decrypt($formdata['taskpk']);
        $task = JdotaskhdrTbl::findOne($formdata['taskpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($task->jdth_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updatetaskstatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/deletetask",
     *     tags={"collaborate"},
     *     summary="Delete Task",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskstatus", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDeletetask()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['moduledtlpk']);
        $formdata['moduledtlpk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['taskpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['coltaskpk'] = Security::decrypt($formdata['coltaskpk']);
        $response = Collaborate::updatestatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/pintask",
     *     tags={"collaborate"},
     *     summary="Pin task",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "coltaskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "pin_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionPintask()
    {
        $formdata = Yii::$app->request->post();
        $formdata['coltaskpk'] = Security::decrypt($formdata['coltaskpk']);
        $response = ColtaskdtlsTbl::pintask($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/createnotes",
     *     tags={"collaborate"},
     *     summary="Create & Update Notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *      @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notespk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "targetmember", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "creatortargetpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notestitle", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notesdesc", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "time", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "isallday", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "filepk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "timezone", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "notifybefore", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCreatenotes()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['notepk'] = Security::decrypt($formdata['notepk']);

        $response = Collaborate::addnotes($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Post(path="/ct/collaborate/noteslisting",
     *     tags={"collaborate"},
     *     summary="Notes Listing",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionNoteslisting()
    {
        $formdata = Yii::$app->request->post();
        $dataPk = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::noteslisting($dataPk);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/updatenotesstatus",
     *     tags={"collaborate"},
     *     summary="Update Notes Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskstatus", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatenotesstatus()
    {
        $formdata = Yii::$app->request->post();
        $formdata['notepk'] = Security::decrypt($formdata['notepk']);
        $note = JdonoteshdrTbl::findOne($formdata['notepk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($note->jdnh_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updatenotestatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/userprefnotes",
     *     tags={"collaborate"},
     *     summary="Pin notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "colnotespk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "pin_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUserprefnotes()
    {
        $formdata = Yii::$app->request->post();
        $notepk = Security::decrypt($formdata['notepk']);
        $formdata['notepk'] = Security::sanitizeInput($notepk, 'number');
        $note = JdonoteshdrTbl::findOne($formdata['notepk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($note->jdnh_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::userprefnotes($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/seenfile",
     *     tags={"collaborate"},
     *     summary="Pin notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "targatMemberPk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "mainPk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "filePk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "isRemoved", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionSeenfile()
    {
        $formdata = Yii::$app->request->post();
        $formdata['targatMemberPk'] = Security::sanitizeInput(Security::decrypt($formdata['targatMemberPk']), 'number');
        $formdata['mainPk'] = Security::sanitizeInput(Security::decrypt($formdata['mainPk']), 'number');
        $formdata['filePk'] = Security::sanitizeInput(Security::decrypt($formdata['filePk']), 'number');
        $response = Collaborate::seenfile($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/userprefnotes",
     *     tags={"collaborate"},
     *     summary="Pin notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "colnotespk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "pin_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionArchivednotes()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
       
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::archivednotes($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/userprefnotes",
     *     tags={"collaborate"},
     *     summary="Pin notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "colnotespk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "pin_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionArchivedmeeting()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
       
        // if ($card->jdmd_createdby != $userPK) {
        //     return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        // }
        $response = Collaborate::archivedmeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/deletenote",
     *     tags={"collaborate"},
     *     summary="Delete notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notespk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDeletenote()
    {
        $formdata = Yii::$app->request->post();
        $formdata['notepk'] = Security::decrypt($formdata['notepk']);
        $note = JdonoteshdrTbl::findOne($formdata['notepk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($note->jdnh_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::deletenotes($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/deletenotes",
     *     tags={"collaborate"},
     *     summary="Delete notes",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notespk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDeletenotes()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
       
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::deletenotes($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/createmeeting",
     *     tags={"collaborate"},
     *     summary="Create & Update Meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "meetingpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "jdomodulepk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "title", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "presencetype", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "starttime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "endtime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "timezonepk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "location", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "purposemeeting", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notifybefore", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetcompfk", type = "string"), 
     *     @SWG\Parameter(in = "formData", name = "targetmembers", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "url", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */

    public function actionCreatemeeting()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdomodulepk'] = Security::decrypt($formdata['jdomodulepk']);
        $formdata['meetingpk'] = Security::decrypt($formdata['meetingpk']);
        $formdata['shedule'] = false;
        $response = Collaborate::addmeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/shedulemeeting",
     *     tags={"collaborate"},
     *     summary="Create & Update Meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "meetingpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "jdomodulepk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "title", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "presencetype", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "starttime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "endtime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "timezonepk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "location", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "purposemeeting", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notifybefore", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetcompfk", type = "string"), 
     *     @SWG\Parameter(in = "formData", name = "targetmembers", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "url", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */

    public function actionShedulemeeting()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdomodulepk'] = Security::decrypt($formdata['jdomodulepk']);
        $formdata['meetingpk'] = Security::decrypt($formdata['meetingpk']);
        $formdata['shedule'] = true;
        $response = Collaborate::addmeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/reshedulemeeting",
     *     tags={"collaborate"},
     *     summary="Create & Update Meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "meetingpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "jdomodulepk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "title", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "presencetype", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "starttime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "endtime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "timezonepk", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "location", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "purposemeeting", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notifybefore", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetcompfk", type = "string"), 
     *     @SWG\Parameter(in = "formData", name = "targetmembers", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "url", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */

    public function actionReshedulemeeting()
    {
        $formdata = Yii::$app->request->post();
        $formdata['jdomodulepk'] = Security::decrypt($formdata['jdomodulepk']);
        $formdata['meetingpk'] = Security::decrypt($formdata['meetingpk']);
        $response = Collaborate::reshedulemeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/meetinglist",
     *     tags={"collaborate"},
     *     summary="Meeting Listing",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "search", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionMeetinglist()
    {
        $formdata = Yii::$app->request->post();
        $formdata['moduledtlpk'] = Security::decrypt($formdata['moduledtlpk']);
        $response = Collaborate::meetinglisting($formdata);
    
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/meetinginfo",
     *     tags={"collaborate"},
     *     summary="Meeting Information",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "meetpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionMeetinginfo()
    {
        $formdata = Yii::$app->request->post();
        $formdata['meetpk'] = Security::decrypt($formdata['meetpk']);
        $formdata['userpk'] = Security::decrypt($formdata['userpk']);
        $response = Collaborate::getmeetinginfo($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    
    /**
     * @SWG\Post(path="/ct/collaborate/reschedulemeeting",
     *     tags={"collaborate"},
     *     summary="Reschedule Meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "meetingpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "date", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "starttime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "endtime", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "timezonepk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */

    public function actionReschedulemeeting()
    {
        $formdata = Yii::$app->request->post();
        $formdata['moduledtlpk'] = Security::decrypt($formdata['moduledtlpk']);
        $formdata['meetingpk'] = Security::decrypt($formdata['meetingpk']);
       
        $response = Collaborate::reschedulemeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/deletemeeting",
     *     tags={"collaborate"},
     *     summary="Delete Meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "colmeetpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDeletemeeting()
    {
        $formdata = Yii::$app->request->post();
        $colmstpk = Security::decrypt($formdata['colmstpk']);
        $formdata['colmstpk'] = Security::sanitizeInput($colmstpk, 'number');
        $card = CollaborativemstTbl::findOne($formdata['colmstpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->cpm_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = ColmeetingdtlsTbl::deletemeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    /**
     * @SWG\Post(path="/ct/collaborate/pinmeeting",
     *     tags={"collaborate"},
     *     summary="Pin meeting",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "colmstpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "colmeetpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "pin_status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionPinmeeting()
    {
        $formdata = Yii::$app->request->post();
        $colmstpk = Security::decrypt($formdata['colmstpk']);
        $formdata['colmstpk'] = Security::sanitizeInput($colmstpk, 'number');
        $card = CollaborativemstTbl::findOne($formdata['colmstpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->cpm_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['colmeetpk'] = Security::decrypt($formdata['colmeetpk']);
        $response = ColmeetingdtlsTbl::pinmeeting($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

     /**
     * @SWG\Post(path="/ct/collaborate/meetingresponse",
     *     tags={"collaborate"},
     *     summary="Update Memeber response",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "response", type = "number"),
     *      @SWG\Parameter(in = "formData", name = "responsecomment", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionMeetingresponse()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['jdomodulepk']);
        $formdata['jdomodulepk'] = Security::sanitizeInput($moduledtlpk, 'number');
        // $card = JdomoduledtlTbl::findOne($formdata['jdomodulepk']);
        // $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        // if ($card->jdmd_createdby != $userPK) {
        //     return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        // }
        $formdata['meetPk'] = Security::decrypt($formdata['meetPk']);
        $response = Collaborate::updateMemberresponse($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }


    /**
     * @SWG\Post(path="/ct/collaborate/resmeetresponse",
     *     tags={"collaborate"},
     *     summary="Update Memeber response",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *      @SWG\Parameter(in = "formData", name = "comment", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionResmeetresponse()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $response = Collaborate::resmeetresponse($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }
    
    /**
     * @SWG\Post(path="/ct/collaborate/reschedulehistory",
     *     tags={"collaborate"},
     *     summary="Update Memeber response",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "meetpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionReschedulehistory()
    {
        $formdata = Yii::$app->request->post();
        $moduledtlpk = Security::decrypt($formdata['moduledtlpk']);
        $formdata['moduledtlpk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['moduledtlpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $formdata['meetpk'] = Security::decrypt($formdata['meetpk']);
        $response = Collaborate::reschedulehistory($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/updatediscussiontopic",
     *     tags={"collaborate"},
     *     summary="Edit Discussion Topic",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "discusshdrpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "topic", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatediscussiontopic()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $moduledtlpk = Security::decrypt($formdata['formData']['moduledtlpk']);
        $formdata['formData']['moduledtlpk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $discusshdrpk = Security::decrypt($formdata['formData']['discusshdrpk']);
        $formdata['formData']['discusshdrpk'] = Security::sanitizeInput($discusshdrpk, 'number');

        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $moduledtl = JdomoduledtlTbl::findOne($moduledtlpk);

        if ($moduledtl->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updateDiscussionTopic($formdata);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/changediscussionstatus",
     *     tags={"collaborate"},
     *     summary="Change Discussion Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "discusshdrpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionChangediscussionstatus()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $discussionpk = [];
        $colmstpk = Security::decrypt($formdata['formData']['colmstpk']);
        $formdata['formData']['colmstpk'] = Security::sanitizeInput($colmstpk, 'number');
        $card = CollaborativemstTbl::findOne($formdata['formData']['colmstpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

        if ($card->cpm_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        if (is_array($formdata['formData']['discussionpk'])) {
            foreach ($formdata['formData']['discussionpk'] as $pk) {
                $discussionpk[] = Security::sanitizeInput(Security::decrypt($pk), 'number');
            }
        }
        $formdata['formData']['discussionpk'] = $discussionpk;
        $response = Collaborate::changeDiscussionStatus($formdata);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/changetaskstatus",
     *     tags={"collaborate"},
     *     summary="Change task status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionChangetaskstatus()
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($formdata['dtlsPk'], 'number');
        $module = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        if ($module->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updatetaskstatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/changenotesstatus",
     *     tags={"collaborate"},
     *     summary="Change notes status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "taskpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionChangenotesstatus()
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($formdata['dtlsPk'], 'number');
        $module = JdomoduledtlTbl::findOne($formdata['dtlsPk']);
        if ($module->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updatenotestatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/changenotestatus",
     *     tags={"collaborate"},
     *     summary="Update Note Status",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "notespk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionChangenotestatus()
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $formdata['dtlsPk'] = Security::decrypt($formdata['dtlsPk']);
        $formdata['dtlsPk'] = Security::sanitizeInput($modulformdata['dtlsPk'], 'number');
        $card = JdomoduledtlTbl::findOne($formdata['formData']['moduledtlpk']);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::updatetaskstatus($formdata);
        return [
            'msg' => 'success',
            'status' => 200,
            'items' => $response
        ];
    }

    /**
     * @SWG\Post(path="/ct/collaborate/drivelist",
     *     tags={"collaborate"},
     *     summary="Drive list",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "collaborativepk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionDrivelist()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $collaborativepk = Security::decrypt($formdata['formData']['collaborativepk']);
        $collaborativepk = Security::sanitizeInput($collaborativepk, 'number');
        $response = Collaborate::driveList($collaborativepk);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/getdrivelist",
     *     tags={"collaborate"},
     *     summary="Drive list",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "collaborativepk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionGetdrivelist()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $formdata['dataPk'] = Security::sanitizeInput($dataPk, 'number');
        $response = Collaborate::getdrivelist($formdata);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/carddetail",
     *     tags={"collaborate"},
     *     summary="Card detail",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionCarddetail()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $moduledtlpk = Security::decrypt($formdata['formData']['moduledtlpk']);
        $moduledtlpk = Security::sanitizeInput($moduledtlpk, 'number');
        $response = Collaborate::cardDetail($moduledtlpk);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/managecardmembers",
     *     tags={"collaborate"},
     *     summary="Get card memebrs",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "type", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionManagecardmembers()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $moduledtlpk = Security::decrypt($formdata['formData']['moduledtlpk']);
        $formdata['formData']['moduledtlpk'] = Security::sanitizeInput($moduledtlpk, 'number');
        $card = JdomoduledtlTbl::findOne($formdata['formData']['moduledtlpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->jdmd_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }
        $response = Collaborate::manageCardmembers($formdata);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/uncollaboratemember",
     *     tags={"collaborate"},
     *     summary="update member for no collaboration",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "memberpk", type = "string"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionUpdatecardmembers()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $cardpk = Security::decrypt($formdata['formData']['moduledtlpk']);
        $formdata['formData']['moduledtlpk'] = Security::sanitizeInput($cardpk, 'number');
        $audiencepk = [];
        $card = CollaborativemstTbl::findOne($formdata['formData']['moduledtlpk']);
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if ($card->cpm_createdby != $userPK) {
            return ['msg' => 'warning', 'comments' => 'No permissions', 'code' => 'ERR001', 'status' => false];
        }

        if (is_array($formdata['formData']['memberpk'])) {
            foreach ($formdata['formData']['memberpk'] as $pk) {
                $audiencepk[] = Security::sanitizeInput(Security::decrypt($pk), 'number');
            }
            $formdata['formData']['memberpk'] = $audiencepk;
        } else {
            $audiencepk = Security::decrypt($formdata['formData']['memberpk']);
            $formdata['formData']['memberpk'] = Security::sanitizeInput($audiencepk, 'number');
        }
        $response = Collaborate::updateCardmembers($formdata);
        return $response;
    }


    /**
     * @SWG\Post(path="/ct/collaborate/getuserdetail",
     *     tags={"collaborate"},
     *     summary="Get user detail",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "userpk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionGetuserdetail()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $userpk = Security::decrypt($formdata['formData']['userpk']);
        $userpk = Security::sanitizeInput($userpk, 'number');
        $response = Collaborate::getUserDetail($userpk);
        return $response;
    }


    /**
     * @SWG\Post(path="/ct/collaborate/exitcard",
     *     tags={"collaborate"},
     *     summary="Get user detail",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "moduledtlpk", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionExitcard()
    {
        $formdata = Yii::$app->request->post();
        $formdata['dataPk'] = Security::decrypt($formdata['dataPk']);
        $formdata['dataPk'] = Security::sanitizeInput($formdata['dataPk'], 'number');
        $response = Collaborate::exitCard($formdata['dataPk']);
        return $response;
    }

    /**
     * @SWG\Post(path="/ct/collaborate/savepreference",
     *     tags={"collaborate"},
     *     summary="Save user preferences for mute notificvation, archive task, note, meeting, discussion",
     *     @SWG\Parameter(name="Authorization",in="header",required=true, type="string",
     *     default="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiIxOTIuMTY4LjEuODAiLCJhdWQiOiIxOTIuMTY4LjEuODAiLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTU4MDkwNTE3OSwiZXhwIjoxNTgwOTA4Nzc5LCJ1aWQiOnsiTWVtYmVyQ29tcE1zdF9QayI6IjEiLCJNQ01fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1STV9NZW1iZXJTdGF0dXMiOiJBIiwiTUNNX0NvdW50cnlNc3RfRmsiOiIzMSIsIlVzZXJNc3RfUGsiOiIxIiwiTUNNX0NvbXBhbnlOYW1lIjoiUksgSW5mb3RlY2giLCJNZW1iZXJSZWdNc3RfUGsiOiIxIiwiVU1fRW1wTmFtZSI6IkthbGlhcGVydW1hbCIsIk1DTV9Tb3VyY2VfQ291bnRyeU1zdF9GayI6IjMxIiwiVU1fVHlwZSI6IlUiLCJNUk1fQ29tcFR5cGUiOiJTIiwiVU1fTWVtYmVyUmVnTXN0X0ZrIjoiMSIsIk1DTV9PcmlnaW4iOiJOIiwiTUNNX0VtYWlsSUQiOiJ1c2VyQGJ1c2luZXNzZ2F0ZXdheXMuY29tIiwidW1fbGFzdHZpc2l0IjoiXC9wcm9maWxlbWFuYWdlbWVudFwvYnJhbmNoIiwiQ291bnRyeW1zdF9QayI6IjMxIiwiYXBwbGljYXRpb25OYW1lIjoiQkdJIiwiZGVmYXVsdExhbmd1YWdlIjoiQW1zdGVyZGFtIiwibG9jYWxlTGFuZ3VhZ2UiOiJGcmFua2Z1cnQiLCJ0aW1lWm9uZSI6IkFtZXJpY2FcL05vbWUiLCJkYXRlRm9ybWF0IjoiJWQtJW0tJVkiLCJ0aW1lRm9ybWF0IjoiZzppIGEiLCJhcHBsaWNhdGlvbkxvZ29VcmwiOiJseXBpcy5wbmciLCJhcHBsaWNhdGlvblRhZ0xpbmUiOiJUaGUgTHlQSVMgcG9ydGFsIGFpbXMgdG8gRW5oYW5jZSBQcm9jdXJlbWVudCBJbWFnZSBvZiBMaWJ5YS4gIiwiYXBwbGljYXRpb25CR1VybCI6Imh0dHA6XC9cL3d3dy5idXNpbmVzc2dhdGV3YXlzLmNvbVwvaW1hZ2VzXC9lbWFpbFwvYmdpX2JnLnBuZyIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBCRyI6IiIsImFwcGxpY2F0aW9uQm90dG9tc3RyaXBUaXRsZSI6IiBFbmhhbmNlIHlvdXIgUHJvZHVjdHMgJiBTZXJ2aWNlcyAiLCJhcHBsaWNhdGlvbkJvdHRvbXN0cmlwU3ViVGl0bGUiOiJvbiBpbnRlcm5hdGlvbmFsIG1hcmtldCIsImZlYXR1cmUiOlt7IkZlYXR1cmVUaXRsZSI6IlRyYW5zcGFyZW5jeSBpbiBQcm9jdXJlbWVudCBPcGVyYXRpb25zICYgSW52ZXN0bWVudCBQcm9jZXNzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJFbXBvd2VyIExpYnlhbiBDaXRpemVucyAmIE90aGVyIFN0YWtlaG9sZGVycyB1bmRlcnN0YW5kIEdvdmVybm1lbnQgU3BlbmQiLCJGZWF0dXJlc3VidGl0bGUiOiIifSx7IkZlYXR1cmVUaXRsZSI6IkVuZm9yY2UgQWRoZXJlbmNlIHRvIE5PQ1x1MjAxOXMgU3RyYXRlZ2ljIFRhcmdldHMgJiBPYmplY3RpdmVzIiwiRmVhdHVyZXN1YnRpdGxlIjoiIn0seyJGZWF0dXJlVGl0bGUiOiJVbmlmaWVkIFN1cHBsaWVyIFBvb2wgZm9yIEluZHVzdHJ5IExldmVsIFByb2N1cmVtZW50IiwiRmVhdHVyZXN1YnRpdGxlIjoiIn1dLCJjb21hbnlOYW1lIjoiQnVzaW5lc3MgR2F0ZXdheXMgSW50ZXJuYXRpb25hbCIsImNvcHlSaWdodCI6IjIwMTQiLCJjb21wYW55QWRkcmVzcyI6IlRlc3QiLCJsb2dvIjoibHlwaXMucG5nIiwiZmF2SWNvbiI6Imh0dHBzOlwvXC93d3cuYnVzaW5lc3NnYXRld2F5cy5jb21cL3RoZW1lc1wvbWFpblwvaW1nXC9iZ2ktbG9nby5wbmcifX0.Ki71qu7PNHh_PwgWfJz6XG6Bke0iT-pE6asrHskvKww",
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "formData", name = "sharedfk", type = "string"),
     *     @SWG\Parameter(in = "formData", name = "shared_type", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "category", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "status", type = "number"),
     *     @SWG\Parameter(in = "formData", name = "updatedfrom", type = "number"),
     *     @SWG\Response(
     *         response = 200,
     *         description = "Collaborate"
     *     ),
     * )
     */
    public function actionSavepreference()
    {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $sharedfk = Security::decrypt($formdata['formData']['sharedfk']);
        $formdata['formData']['sharedfk'] = Security::sanitizeInput($sharedfk, 'number');
        $response = Collaborate::saveUserPreferences($formdata);
        return $response;
    }
    
    /**
     * @SWG\Post(
     *     path="/ct/collaborate/getinvitelist",
     *     tags={"PMS"},
     *     produces={"application/json"},
     *     summary="Save Notify User",
     *     @SWG\Parameter(name="Authorization", in="header", required=true, type="string", default="Bearer TOKEN",  description="Replace TOKEN with jwt Token"),
     *     description="Bearer token"),
     *     @SWG\Parameter(in = "body", name = "data", required = true,
     *           @SWG\Schema(
     *                      @SWG\Property(property="dataType", type="string"),
     *                      @SWG\Property(property="dataPk", type="string"),
     *          )
     *     ),
     *     @SWG\Response(response = 200, description = "Response"),
     * )
     */
    public static function actionGetinvitelist() {
        $request_body = file_get_contents('php://input');
        $formdata = json_decode($request_body, true);
        $dataPk = Security::decrypt($formdata['dataPk']);
        $dataPk = Security::sanitizeInput($dataPk, "number");
        $dtlsPK = Security::decrypt($formdata['dtlsPK']);
        $dtlsPK = Security::sanitizeInput($dtlsPK, "number");
        if ($formdata['dataType']) {
            $data = Collaborate::GetInviteList($dataPk,$formdata['dataType'],$dtlsPK,$formdata['addOrRemove'],$formdata['moduleType']);
            return $data;
        }
    }
    /**
     * @SWG\Get(
     *     path="/ct/collaborate/getactivecompanylist",
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
    public static function actionGetactivecompanylist() {
        $data = Collaborate::getActiveCompanyList();
        return $data;
    }
    /**
     * @SWG\Get(
     *     path="/ct/collaborate/getmastermodule",
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
    public static function actionGetmastermodule() {
        $data = Collaborate::getMasterModule();
        return $data;
    }
}
