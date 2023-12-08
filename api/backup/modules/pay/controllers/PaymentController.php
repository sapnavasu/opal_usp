<?php

namespace api\modules\pay\controllers;

use yii\web\Controller;
use Yii;
use api\modules\pay;
use Mpdf\Mpdf;
/**
 * Default controller for the `pay` module
 */
class PaymentController extends Controller
{
    
   public $_encryptkey, $_cardType, $_requestType, $_paymenttoken;
   public function actions()
    {
        return [];
    }
    public function beforeAction($action) {
        $this->_encryptkey = 'bus!nessg@tew@ys!ntern@t!on@l';
        $this->_cardType = ['ODC', 'OC', 'OTO', 'OTC', 'T'];
        $this->_requestType = ['REG', 'RENEW', 'CMS', 'MDN', 'ET', 'GCC'];
        $this->_paymenttoken = ['Y','N'];
        return TRUE;
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $baseUrl = \Yii::$app->params['baseUrl'];
        $htmlpdf= $this->renderPartial('payment',['baseUrl'=>$baseUrl] );		
        //$baseUrl = \Yii::$app->params['baseUrl'];
        $mpdf = new mPDF([
			'margin_top' => 5,
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_bottom' => 5,
			'autoPageBreak' => true,
            'default_font' => 'cairoregular',
            //'format' => 'A3'
            'format' => [250, 330]
		]); 
        $mpdf->shrink_tables_to_fit = 1;		
		//$mpdf->SetWatermarkImage('http://bgi.businessgateways.net/j3/app/assets/images/jsrsnewlogo.png',.1, 1, 200, '', '', '', true, true);
        $mpdf->SetWatermarkImage($baseUrl.'/assets/images/jsrs-logo-icon.png');
        $mpdf->showWatermarkImage = true;
        $mpdf->WriteHTML($htmlpdf);
        $mpdf->Output();
        exit;
    }
    
     
}
