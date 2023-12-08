<?php

namespace api\modules\pms\controllers;

use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;
use common\components\Sessionn;
use common\components\Configsession;
use \common\components\Security;
use api\modules\pms\controllers\InvoiceMasterController;
use api\modules\pms\models\CmsinvoicerefTbl;
use api\modules\pms\models\CmspaymenttermsTbl;
use api\modules\pms\models\CmspaymenttermsTblQuery;
use api\modules\pms\models\CmscontracthdrTbl;
use api\modules\pms\models\CmsawarddtlsTbl;
use api\modules\mst\models\CurrencymstTbl;
use \common\models\UsermstTbl;
use common\components\Common;
use common\components\Drive;




class CmsinvoiceController extends InvoiceMasterController {

    public $modelClass = '\api\modules\pms\models\CmsinvoicerefTbl';

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
	
	public function actionInvoice_information() {
		
		$contract_id = $_REQUEST['contract_id'];
		
		$module  = CmsinvoicerefTbl::find()->select('sum(cmsir_amount) as invoiceamt, cmsir_status as status, count(*) as invoice, cmsir_currencymst_fk ')->where('cmsir_cmscontracthdr_fk=:fk', [':fk' => $contract_id])->groupBy('cmsir_status')->asArray()->All();
		
		//echo "<pre>";
		//print_r($module);
		
		if(count($module)>0) {
			
			$item_array['total']=array('invoiceamt'=>0,'invoice'=>'0','cmsir_currencymst_fk'=>0,'currency_name'=>0,'status'=>'total');
			$item_array['yet to pay']= array('invoiceamt'=>0,'invoice'=>'0','cmsir_currencymst_fk'=>0,'currency_name'=>0,'status'=>'yet to pay');
			$item_array['paid']=array('invoiceamt'=>0,'invoice'=>'0','cmsir_currencymst_fk'=>0,'currency_name'=>0,'status'=>'paid');
			$item_array['overdue']=array('invoiceamt'=>0,'invoice'=>'0','cmsir_currencymst_fk'=>0,'currency_name'=>0,'status'=>'overdue');
			
			
			
			for($i=0;$i<count($module);$i++) {
				$currency_symbol  = '';
				if($module[$i]['cmsir_currencymst_fk']>0) {
					$currency_id = $module[$i]['cmsir_currencymst_fk'];
					$currency_model = CurrencymstTbl::find()->where(['CurrencyMst_Pk'=>$currency_id])->one();
					if(count($currency_model)>0) {
						$currency_symbol = $currency_model->CurM_CurrSymbol;
					}					
						
				}
						
				
				
				if($module[$i]['status'] == '1') {	
					$module[$i]['inv_status_name'] = 'yet to pay';					
					$item_array['yet to pay']['invoiceamt'] = $module[$i]['invoiceamt'];					
					$item_array['yet to pay']['currency_name'] = $currency_symbol;
					$item_array['yet to pay']['invoice'] = $module[$i]['invoice'];
					
				} else if($module[$i]['status'] == '2') {
					$module[$i]['inv_status_name'] = 'paid';	
					$item_array['paid']['invoiceamt'] = $module[$i]['invoiceamt'];					
					$item_array['paid']['currency_name'] = $currency_symbol;
					$item_array['paid']['invoice'] = $module[$i]['invoice'];						
				} else if($module[$i]['status'] == '3') {	
					$module[$i]['inv_status_name'] = 'Overdue';					
					$item_array['overdue']['invoiceamt'] = $module[$i]['invoiceamt'];					
					$item_array['overdue']['currency_name'] = $currency_symbol;
					$item_array['overdue']['invoice'] = $module[$i]['invoice'];			
				}
				
				
				
			}
			
			$item_array['total']['invoiceamt'] = $item_array['unpaid']['invoiceamt'] +  $item_array['paid']['invoiceamt'] +  $item_array['yet to pay']['invoiceamt'] +  $item_array['overdue']['invoiceamt'];
			$item_array['total']['invoice'] = $item_array['unpaid']['invoice'] +  $item_array['paid']['invoice'] +  $item_array['yet to pay']['invoice'] + $item_array['overdue']['invoice'];
			$item_array['total']['currency_name'] = $currency_symbol;
			
			
			
			$finalarray[0] = $item_array['total'];
			$finalarray[1] = $item_array['yet to pay'];
			$finalarray[2] = $item_array['paid'];
			$finalarray[3] = $item_array['overdue'];
			
			
		}
		
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $finalarray,
        );
        return $result;					
		
		
		
		
		
	}
	
	public function actionContract_info() {		
				
		$contract_id = $_REQUEST['contract_id'];
		$module = CmscontracthdrTbl::find()
                        ->select('*')
                        ->where('cmscontracthdr_pk=:fk', [':fk' => $contract_id])                        
                        ->asArray()->All();
						
		//echo "<pre>";
		//print_r($module);
		//exit;		
		
		$cmsch_currencymst_fk = $module[0]['cmsch_currencymst_fk'];
		$currency_symbol = '';
		if($module[0]['cmsch_currencymst_fk']>0) {
			
			$currency_model = CurrencymstTbl::find()->where(['CurrencyMst_Pk'=>$cmsch_currencymst_fk])->one();
			if(count($currency_model)>0) {
				$currency_symbol = $currency_model->CurM_CurrSymbol;
			}					
				
		}
		if(isset($module[0]['cmscontracthdr_pk']) && $module[0]['cmscontracthdr_pk']>0) {
			/*
			$model_award = CmsawarddtlsTbl::find()->select([
                                'MemberCompMst_Pk as companypk',
                                'MCM_CompanyName as companyname',
                            ])->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsad_memcompmst_fk')
                            ->where(['cmsad_cmscontracthdr_f' => $contract_id])->one();
							*/
			$model_award = \Yii::$app->db->createCommand("SELECT MemberCompMst_Pk AS companypk, MCM_CompanyName AS companyname, MCM_SupplierCode AS suppliercode  FROM `cmsawarddtls_tbl` LEFT JOIN `membercompanymst_tbl` ON MemberCompMst_Pk = cmsad_memcompmst_fk WHERE cmsad_cmscontracthdr_fk='$contract_id' and cmsad_isprimarycontractor ='1' ")->queryAll();				
			$module[0]['companypk']	= 	$model_award[0]['companypk'];
			$module[0]['suppliercode']	= 	strtoupper($model_award[0]['suppliercode']);
			$module[0]['companyname']	= 	ucwords($model_award[0]['companyname']);			
							
			
		}
		
		$module[0]['currency_symbol'] = $currency_symbol;
		
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module,
        );
        return $result;					
		
	}
	
	public function actionGet_payment_terms() {
		
		$contract_id = $_REQUEST['contract_id'];
		
		$module = CmspaymenttermsTbl::find()
                        ->select(['cmspt_name', 'cmspt_value', 'cmspaymentterms_pk'])
                        ->where('cmspt_shared_fk=:fk', [':fk' => $contract_id])
                        ->orderBy('cmspt_name ASC')
                        ->groupBy('cmspt_name')
                        ->asArray()->All();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $module,
        );
        return $result;
	}
 
   
    public function actionSave_supplier_invoice()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);
		
		
		$files_to_upload = '';
		if(isset($data['fileupload']['selectedFilesPk'])) {
			$files_to_upload = join(',',$data['fileupload']['selectedFilesPk']);
		}
		
		
		
		
		$payment_term_id = $data['payment_terms_id'];		
		$contract_pk = $data['contract_pk'];
		$invoice_pk = $data['invoice_pk'];
		
		
		
		$mode_payment_term =  CmspaymenttermsTbl::find()->where(['cmspaymentterms_pk' => $payment_term_id])->one();
		
		$payment_term_text = '';
		if(count($mode_payment_term)>0) {
			$payment_term_text = $mode_payment_term->cmspt_name;
		}
		
		$model_contract = CmscontracthdrTbl::find()->where(['cmscontracthdr_pk' => $contract_pk])->one();   
		$cmsir_cmscontracthdr_fk =0;	
        if(count($model_contract)>0) {
			$cmsir_cmscontracthdr_fk = $model_contract->cmsch_memcompmst_fk;
			$cmsir_currencymst_fk = $model_contract->cmsch_currencymst_fk;
		} 

		if($data['invoice_pk']>0) {
			$model_invoice  = CmsinvoicerefTbl::find()->where('cmsinvoiceref_pk=:fk', [':fk' => $invoice_pk])->one();
			
			$model_invoice->cmsir_updatedon = date('Y-m-d H:i:s');
			$model_invoice->cmsir_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
			$model_invoice->cmsir_updatedbyipaddr = \common\components\Common::getIpAddress();
			
		} else {
			
			$model_invoice = new \api\modules\pms\models\CmsinvoicerefTbl();
			
			$model_invoice->cmsir_createdon = date('Y-m-d H:i:s');
			$model_invoice->cmsir_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
			$model_invoice->cmsir_createdbyipaddr = \common\components\Common::getIpAddress();
		
		}
		
		
		
		
		
		$model_invoice->cmsir_cmscontracthdr_fk = $contract_pk;
		$model_invoice->cmsir_memcompmst_fk = $cmsir_cmscontracthdr_fk;
		$model_invoice->cmsir_invoicerefno = $data['invoice_ref_no'];
		$model_invoice->cmsir_invoicedate = Common::convertDateTimeToServerTimezone($data['invoice_date'],'Y-m-d H:i:s');
		$model_invoice->cmsir_cmspaymentterms_fk = $payment_term_id;
		$model_invoice->cmsir_paymentterm = $payment_term_text;
		$model_invoice->cmsir_wccgrn_refno = $data['invoice_wcc_no'];
		$model_invoice->cmsir_currencymst_fk = $cmsir_currencymst_fk;
		$model_invoice->cmsir_amount = $data['invoice_amount'];
		$model_invoice->cmsir_remarks = $data['remark'];
		$model_invoice->cmsir_duedate =  Common::convertDateTimeToServerTimezone($data['invoice_due_date'],'Y-m-d H:i:s');
		$model_invoice->cmsir_status = 1;			
		$model_invoice->cmsir_fileupload = $files_to_upload;
		
		//echo "<pre>";
		//print_r($model_invoice->attributes);
		//exit;
		
		
		if($model_invoice->save()) {
			
			if($data['invoice_pk']>0) {
				 $result = array(
					'status' => 200,
					'statusmsg' => 'success',
					'flag'=>'S',
					'msg'=>'Invoice Created Successfully',
					'returndata' => 0
				);
			
			} else {
				
				$result = array(
					'status' => 200,
					'statusmsg' => 'success',
					'flag'=>'S',
					'msg'=>'Invoice Updated Successfully',
					'returndata' => 0
				);

				
			}
		} else {			
			
			$result = array(
                'status' => 100,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'There is some problem while creating invoice',
                'returndata' => 0
            );
			
		}		

		
		return json_encode($result);
		
 
        
    }
	
	public function actionShow_all_invoices() {
		
		
		$contract_id = $_REQUEST['contract_id'];
		
		$module  = CmsinvoicerefTbl::find()->joinWith('cmsir_currencymst_fk')
                        ->select('*')
						->leftJoin('usermst_tbl','UserMst_Pk = cmsir_createdby')
                        ->where('cmsir_cmscontracthdr_fk=:fk', [':fk' => $contract_id])                        
                        ->asArray()->All();
						


		$item =array();				
		for($i=0;$i<count($module);$i++) {
			
			$currency_symbol = '';				
			if(isset($module[$i]['cmsir_currencymst_fk']['CurM_CurrSymbol'])) {
				$currency_symbol = $module[$i]['cmsir_currencymst_fk']['CurM_CurrSymbol'];
			}
			$cmsir_status = '';	
			if(isset($module[$i]['cmsir_status']) && $module[$i]['cmsir_status'] == '1') {
				$cmsir_status = 'Unpaid';
			} else if(isset($module[$i]['cmsir_status']) && $module[$i]['cmsir_status'] == '2') {
				$cmsir_status = 'Paid';
			} else if(isset($module[$i]['cmsir_status']) && $module[$i]['cmsir_status'] == '3') {
				$cmsir_status = 'Overdue';
			}
			
			$created_by = $module[$i]['um_firstname'].' '.$module[$i]['um_middlename'].' '.$module[$i]['um_lastname'];
			
			$item[] = array('invid'=>$module[$i]['cmsinvoiceref_pk'],'invrefno'=>strtoupper($module[$i]['cmsir_invoicerefno']),'invdate'=>date('d-m-Y',strtotime($module[$i]['cmsir_invoicedate'])),'createby'=>$created_by,'invterm'=>ucwords($module[$i]['cmsir_paymentterm']),'invcurrency'=>$currency_symbol,'invamount'=>$module[$i]['cmsir_amount'],'invduedate'=>date('d-m-Y',strtotime($module[$i]['cmsir_duedate'])),'invstatus'=>$cmsir_status,'action'=>'');

		}	
		
			
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item,
        );
        return $result;
		
		
	}
	
	
	public function  actionEdit_invoice_cms() {
		
		$invoice_id = $_REQUEST['invoice_id'];	
		
		$module  = CmsinvoicerefTbl::find()
                        ->select('*')						
                        ->where('cmsinvoiceref_pk=:fk', [':fk' => $invoice_id])                        
                        ->asArray()->one();
						
	
						
		$item =array();						
						
		if(count($module)>0) {
			
			$item = array('invid'=>$module['cmsinvoiceref_pk'],'invrefno'=>strtoupper($module['cmsir_invoicerefno']),'invdate'=>date('d/m/Y',strtotime($module['cmsir_invoicedate'])),'createby'=>$created_by,'wccno'=>$module['cmsir_wccgrn_refno'],'invterm'=>ucwords($module['cmsir_paymentterm']),'invcurrency'=>$module['cmsir_currencymst_fk'],'invamount'=>$module['cmsir_amount'],'invduedate'=>date('d/m/Y',strtotime($module['cmsir_duedate'])),'fupload'=>$module['cmsir_fileupload'],'invstatus'=>$cmsir_status,'action'=>'');

		}	

		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item,
        );
        return $result;	
						
		
		
	}
	
	
	
	public function  actionUpdate_invoice() {
		
		
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $time_zone = \yii\db\ActiveRecord::getTokenData('timeZone',true);
        date_default_timezone_set($time_zone);
		
		
		$files_to_upload = '';
		if(isset($data['fileupload']['selectedFilesPk'])) {
			$files_to_upload = join(',',$data['fileupload']['selectedFilesPk']);
		}
		
		
		
		
		$payment_term_id = $data['payment_terms_id'];	
		$contract_id = $_REQUEST['contract_id'];
		
		$model_invoice  = CmsinvoicerefTbl::find()
                        ->select('*')						
                        ->where('cmsir_cmscontracthdr_fk=:fk', [':fk' => $contract_id])->one();
						
		$item =array();						
						
		if(count($model_invoice)>0) {
			
			$mode_payment_term =  CmspaymenttermsTbl::find()->where(['cmspaymentterms_pk' => $payment_term_id])->one();
		
			$payment_term_text = '';
			if(count($mode_payment_term)>0) {
				$payment_term_text = $mode_payment_term->cmspt_name;
			}
			
			$model_contract = CmscontracthdrTbl::find()->where(['cmscontracthdr_pk' => $contract_pk])->one();   
			$cmsir_cmscontracthdr_fk =0;	
			if(count($model_contract)>0) {
				$cmsir_cmscontracthdr_fk = $model_contract->cmsch_memcompmst_fk;
				$cmsir_currencymst_fk = $model_contract->cmsch_currencymst_fk;
			}                
			
			$model_invoice = new \api\modules\pms\models\CmsinvoicerefTbl();
			$model_invoice->cmsir_cmscontracthdr_fk = $contract_pk;
			$model_invoice->cmsir_memcompmst_fk = $cmsir_cmscontracthdr_fk;
			$model_invoice->cmsir_invoicerefno = $data['invoice_ref_no'];
			$model_invoice->cmsir_invoicedate = Common::convertDateTimeToServerTimezone($data['invoice_date'],'Y-m-d H:i:s');
			$model_invoice->cmsir_cmspaymentterms_fk = $payment_term_id;
			$model_invoice->cmsir_paymentterm = $payment_term_text;
			$model_invoice->cmsir_wccgrn_refno = $data['invoice_wcc_no'];
			$model_invoice->cmsir_currencymst_fk = $cmsir_currencymst_fk;
			$model_invoice->cmsir_amount = $data['invoice_amount'];
			$model_invoice->cmsir_duedate =  Common::convertDateTimeToServerTimezone($data['invoice_due_date'],'Y-m-d H:i:s');
			$model_invoice->cmsir_status = 1;			
			$model_invoice->cmsir_fileupload = $files_to_upload;
			$model_invoice->cmsir_updatedon = date('Y-m-d H:i:s');
			$model_invoice->cmsir_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
			$model_invoice->cmsir_updatedbyipaddr = \common\components\Common::getIpAddress();
			
			//echo "<pre>";
			//print_r($model_invoice->attributes);
			//exit;
			
			
			if($model_invoice->save()) {
				 $result = array(
					'status' => 200,
					'statusmsg' => 'success',
					'flag'=>'S',
					'msg'=>'Invoice Created Successfully',
					'returndata' => 0
				);
			} else {			
				
				$result = array(
					'status' => 100,
					'statusmsg' => 'warning',
					'flag'=>'E',
					'msg'=>'There is some problem while creating invoice',
					'returndata' => 0
				);
				
			}

		}	

		return json_encode($result);
						
		
		
	}
	
	

   
    
}
