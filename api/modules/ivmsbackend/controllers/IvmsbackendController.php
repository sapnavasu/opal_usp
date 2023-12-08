<?php

namespace api\modules\ivmsbackend\controllers;
use setasign\Fpdi\Fpdi;
// require_once(__DIR__.'\fpdf\fpdf.php');
// require_once(__DIR__.'\fpdi\autoload.php');
use DateTime;
use DateTimeZone;
use Yii;
use api\modules\mst\controllers\MasterController;
use api\modules\center\controllers\AppCenterController;
use yii\data\ActiveDataProvider;

use app\models\StandardcoursemstTbl;
use app\models\CoursecategorymstTbl;
use app\models\StaffinforepoTbl;
use app\models\StaffacademicsTbl;
use app\models\StaffworkexpTbl;
use app\models\IntnatrecogmstTbl;
use app\models\AppintrecogtmpTbl;
use app\models\ReferencemstTbl;
use app\models\ApplicationdtlstmpTbl;
use app\models\AppcoursedtlstmpTbl;
use app\models\AppcoursetrnstmpTbl;
use app\models\AppoffercoursemainTbl;
use app\models\opalcountrymsttbl;
use app\models\RolemstTbl;
use app\models\OpalstatemstTbl;
use  app\models\OpalcitymstTbl;
use app\models\AppoffercourseunitmainTbl;
use app\models\DocumentdtlsmstTbl;
use app\models\AppoprcontracttmpTbl;
use app\models\AppdocsubmissiontmpTbl;
use app\models\AppstafflocationtmpTbl;
use app\models\AppstaffscheddtlsTbl;
use app\models\AppstaffinfotmpTbl;
use app\models\ApppymtdtlstmpTbl;
use app\models\AppapprovalhdrTbl;
use app\models\OpalInvoiceTbl;
use \app\models\OpalusermstTbl;
use \app\models\AppstaffinfomainTbl;
use app\models\OpalmemberregmstTbl;
use \app\models\ProjapprovalworkflowdtlsTbl;
use app\models\StandardcoursedtlsTbl;
use app\models\AppintrecogmainTbl;
use api\modules\center\components\SiteAudit;
use app\models\AppinstinfomainTbl;
use app\models\BatchmgmtasmthdrTbl;
use app\models\BatchmgmtthyhdrTbl;
use app\models\BatchmgmtpracthdrTbl;
use app\models\StaffcourseconfigmstTbl;
use DatePeriod;
use api\modules\cm\components\Course;


class IvmsBackendController extends MasterController
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
    
    public function actionGetdesktop(){
        $formatedData = \app\models\ApplicationdtlstmpTbl::getDesktop();
       return $this->asJson([
              'data' => $formatedData,
              'msg' => 'Success',
              'status' => 100,
          ]);
    }
   
    
}