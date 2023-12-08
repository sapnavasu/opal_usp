<?php

namespace api\modules\mst\models;
use api\modules\pms\models\CmstendertargethdrtempTbl;
use api\modules\pms\models\CmstendertargethdrTbl;
use api\modules\pms\models\CmstenderresponseTbl;
use api\modules\pms\models\CmstenderhdrTbl;
use api\modules\pms\models\CmstenderhdrtempTbl;
use common\models\UsermstTbl;

use Yii;

/**
 * This is the model class for table "favsrchmst_tbl".
 *
 * @property int $favsrchmst_pk
 * @property int $fsm_memberregmst_fk
 * @property string $fsm_srchname
 * @property int $fsm_createdby
 * @property string $fsm_createdon
 * @property string $fsm_updatedon
 *
 * @property FavsrchdtlsTbl[] $favsrchdtlsTbls
 * @property UsermstTbl $fsmCreatedby
 * @property MemberregistrationmstTbl $fsmMemberregmstFk
 */
class FavsrchmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favsrchmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsm_memberregmst_fk', 'fsm_srchname', 'fsm_createdby', 'fsm_createdon'], 'required'],
            [['fsm_memberregmst_fk', 'fsm_createdby'], 'integer'],
            [['fsm_createdon', 'fsm_updatedon'], 'safe'],
            [['fsm_srchname'], 'string', 'max' => 50],
            [['fsm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['fsm_createdby' => 'UserMst_Pk']],
            [['fsm_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['fsm_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'favsrchmst_pk' => 'Favsrchmst Pk',
            'fsm_memberregmst_fk' => 'Fsm Memberregmst Fk',
            'fsm_srchname' => 'Fsm Srchname',
            'fsm_createdby' => 'Fsm Createdby',
            'fsm_createdon' => 'Fsm Createdon',
            'fsm_updatedon' => 'Fsm Updatedon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavsrchdtl()
    {
        return $this->hasOne(FavsrchdtlsTbl::className(),['fsd_favsrchmst_fk' => 'favsrchmst_pk'])
       ->andOnCondition(['fsd_status' => 1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmCreatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'fsm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'fsm_memberregmst_fk']);
    }
    
    public function getSavedResults($request,$regPk,$userPk) {
        $query = self::find()->where(['fsm_memberregmst_fk' => $regPk,'fsm_createdby'=>$userPk])
                ->innerJoinWith('favsrchdtl','fsd_favsrchmst_fk = favsrchmst_pk')
                ->andWhere(['fsd_status'=>1])
                ->andFilterWhere(['LIKE','fsm_srchname', $request['search']])
                ->orderBy(['favsrchmst_pk' => SORT_DESC]);
        $pagesize = (!empty($request['size'])) ? $request['size'] : 10 ; 
        $page = (!empty($request['page'])) ? $request['page'] : 0 ; 
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pagesize,
                'page' => $page,
            ]
        ]);
        //echo $query->createCommand()->getRawSql();die();

        //print_r($provider->getModels());die();
        return ['data' => $provider->getModels(), 'totalCount' => $provider->getTotalCount()];
    }
	
	
	public function getfavlist() {
		
		$regPk = $_REQUEST['regpk'];
		$rfx_id = $_REQUEST['rfx_id'];

		$type_array = ['C','P','S','CM'];
		
		$model = FavsrchmstTbl::find()->select('*')->innerJoin('favsrchdtls_tbl','fsd_favsrchmst_fk = favsrchmst_pk')->where(['fsm_memberregmst_fk' => $regPk, 'fsd_status'=>1 ])->andwhere(['in', 'fsd_srchtype', $type_array])->orderBy(['favsrchmst_pk' => SORT_DESC])->asArray()->all();
		
		$item_array = array();
		for($i=0;$i<count($model);$i++) {			
			$item_array['result'][] = array('favsrchmst_pk'=>$model[$i]['favsrchmst_pk'],'fsm_srchname'=>ucwords($model[$i]['fsm_srchname']),'fsd_prevsrchcnt'=>$model[$i]['fsd_prevsrchcnt']);	

		}

		$model_data = CmstenderhdrtempTbl::find()->select('*')->where(['cmstenderhdrtemp_pk'=>$rfx_id])->one();

		if(count($model_data)>0) {
			$item_array['tender_critieria_bag'] = 1;
		} else {
			$item_array['tender_critieria_bag'] = 0;
		}
		
		
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item_array,
        );		
		return $result;
		
	}
	
	public function getcompanies($reqdata) {

		$regpk =  $reqdata[0]['regpk'];	
		$regids_arr =  $reqdata[0]['regids'];
		$rfx_id =  $reqdata[0]['rfx_id'];	
		$typevar =  $reqdata[0]['typevar'];	
		$model = array();
		$type_array = array('RFI'=>1,'EOI'=>2,'PQ'=>3,'RFP'=>4,'RFQ'=>5,'RFT'=>6,'eTender'=>7,'eAuction'=>8);

		
		$model_data = CmstenderhdrtempTbl::find()->select('*,cmstenderhdr_tbl.cmstenderhdr_pk')->leftJoin('cmstenderhdr_tbl','cmsth_cmstenderhdrtemp_fk = cmstht_cmstenderhdrtemp_fk')->where(['cmstenderhdrtemp_pk'=>$rfx_id])->asArray()->one();
		$cmstenderhdr_pk = 0;		
		$shortlist_array = array();
		$rejected_array = array();	
		$is_published = 0;	
		if(count($model_data)>0) {			
			$cmstenderhdr_pk = $model_data['cmstenderhdr_pk'];
			
			if($cmstenderhdr_pk>0) {
				
				$model_rft =  CmstenderresponseTbl::find()->select('*')->leftJoin('cmstenderhdr_tbl','cmstenderhdr_pk = ctr_cmstenderhdr_fk')->leftJoin('membercompanymst_tbl','ctr_memcompmst_fk = MemberCompMst_Pk')->where("ctr_status IN (5,6) AND cmstenderhdr_pk = $cmstenderhdr_pk AND cmsth_type= $cmsth_type")->asArray()->all();
				if(count($model_rft)>0) {
					
					for($i=0;$i<count($model_rft);$i++) {
						
						if($model_rft[$i]['ctr_status'] == '5') {
							$shortlist_array[] = $model_rft[$i]['ctr_memcompmst_fk'];
						} else if($model_rft[$i]['ctr_status'] == '6') {
							$rejected_array[] = $model_rft[$i]['ctr_memcompmst_fk'];
						}
					}
				}
			}
		}
		$cmsth_type = $type_array[$typevar];

		if($model_data['cmstht_tenderstatus'] == 2) {
			$is_published = 1;
		}



		
		
		if(count($regids_arr)>0) {			
			
			$model_target_temp = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$rfx_id])->asArray()->all();
			$temp_target_suppliers = array();
			for($k=0;$k<count($model_target_temp);$k++) {
				$temp_target_suppliers[] = $model_target_temp[$k]['cmsttht_memberregmst_fk'];
			}

			//echo "<pre>";
			//print_r($temp_target_suppliers);
			//echo "regids";
			//print_r($regids_arr);

			$supplier_merge = array_merge($temp_target_suppliers,$regids_arr);
			$regids = join(',',$supplier_merge) ;			
			$model = Membercompanymsttbl::find()->select("*")->leftJoin("memberregistrationmst_tbl","MemberRegMst_Pk=MCM_MemberRegMst_Fk")->leftJoin("classificationmst_tbl","ClassificationMst_Pk=mcm_classificationmst_fk")->where("MCM_MemberRegMst_Fk IN ($regids) order by
			find_in_set(MCM_MemberRegMst_Fk,'$regids') ")->asArray()->all();
		} 
		
	
		$item_array = array();
		
		for($i=0;$i<count($model);$i++) {	
		
			$company_name = $model[$i]['MCM_CompanyName'];
			$supplier_code = $model[$i]['MCM_SupplierCode'];

			$hide_supplier = 0;
			$jsrssts = 'In-Active';
			$isjsrs =  'In-Active';
			$expdate = '';
			$rejected =  0;
			$oman_company = 0;

			$classific = str_replace(' ','',$model[$i]['ClM_ClassificationType'])	;
			

			if(trim($model[$i]['MRM_ValSubStatus']) == 'A' && trim($model[$i]['MRM_MemberStatus']) == 'A') {

				$jsrssts = 'Active';
				$isjsrs =  'Active';
			} 
			
			if(isset($model[$i]['mcm_accexpirydate']) && $model[$i]['mcm_accexpirydate']!='') {
				$expdate = date('d-m-Y',strtotime($model[$i]['mcm_accexpirydate']));
			}
			$reg_pk = $model[$i]['MCM_MemberRegMst_Fk'];
			
			
			if(in_array($rejected_array,$model[$i]['MemberCompMst_Pk'])) {
				$rejected = 1;
			}
			
			if($model[$i]['MCM_Origin'] == 'N') {
				$oman_company = 1;
			}

			if(in_array($model[$i]['MCM_MemberRegMst_Fk'],$temp_target_suppliers)) { //  && $is_published == 1
				$hide_supplier = 1;
			}
			
			if(!in_array($shortlist_array,$model[$i]['MemberCompMst_Pk'])) {
				$item_array['list'][] = array('MCM_MemberRegMst_Fk'=>$reg_pk,
				'MemberCompMst_Pk'=>$model[$i]['MemberCompMst_Pk'],
				'compPk'=>$model[$i]['MemberCompMst_Pk'],
				'compkey'=>$model[$i]['MemberCompMst_Pk'],
				'select'=>'',
				'suppliercode'=>$supplier_code,
				'suppcode'=>$supplier_code,
				'companyname'=>$company_name,
				'name'=>$company_name,
				'classific'=>$classific,
				'classify'=>$classific,
				'jsrssts'=>$jsrssts,
				'isjsrs'=>$isjsrs,
				'expdate'=>$expdate,
				'exp'=>$expdate,
				'action'=>'',
				'rejected'=>$rejected,
				'national'=>$oman_company,
				'hide_supplier'=>$hide_supplier,
			    'is_published'=>$is_published);
				
			}
						
		}
		$item_array['selectedsupplierstotal'] = count($temp_target_suppliers);
		$item_array['total'] = count($item_array['list']);
		$item_array['fav_json_criteria'] = $reqdata[0]['fav_json_criteria'];	
		$item_array['fav_criteria_bag'] = $reqdata[0]['fav_criteria_bag'];
		$item_array['fav_prevsrchcnt'] = $reqdata[0]['fav_prevsrchcnt'];
				
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item_array,
        );		
		return $result;	
		
		
	}


	public function recentsearch($reqdata) {
		
		$regpk =  $reqdata[0]['regpk'];	
		$rfx_id =  $reqdata[0]['rfx_id'];
		
	

		$model = CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id] )->one();
		$title = $criteria = $criteria_bag = '';
		$display_content = 0;
		$target_suppliers_added = 0;
		if($model->cmstht_tgtname!='') {

			$title = 	$model->cmstht_tgtname;	
			$criteria = $model->cmstht_tgtcriteria;
			$criteria_bag = json_decode($model->cmstht_tgtcriteriabag,true);

			$saved_criteria = json_decode($criteria_bag['savedata']['filterSrh'],true);

			$display_content = 0;
			if(isset($saved_criteria['Supplier']['cat0'][0]['jsrssts']['dataVal'])) {
				$data_val_array = $saved_criteria['Supplier']['cat0'][0]['jsrssts']['dataVal'];
				if(in_array('2',$data_val_array)) {
					$display_content = 1;
				}

			}
			$target_suppliers_added = 1;

			$model_target = count($model->cmstendertargethdrTbls); 
		}
				
		$is_published = 0;
		if($model->cmstht_tenderstatus>1) {
			$is_published = 1;	
		}		
		
		$item_array = array();		
		if(count($model)>0) {
			$item_array = array('fsm_srchname'=>ucwords($title),
			'fsd_prevsrchcnt'=>$model_target,
			'targetcount'=>$model_target,
			'target_published'=>$is_published,
			'display_content'=>$display_content,
			'target_suppliers_added'=>$target_suppliers_added);
		}		
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item_array,
        );		
		return $result;
		
	}
	
	public function recentsearch_old($reqdata) {		
		
		$regpk =  $reqdata[0]['regpk'];	
		$rfx_id =  $reqdata[0]['rfx_id'];			 
		$model = FavsrchmstTbl::find()->select('*')->innerJoin('favsrchdtls_tbl','fsd_favsrchmst_fk = favsrchmst_pk')->where(['fsm_memberregmst_fk' => $regpk,'fsd_srchtype'=>'CM','fsd_status'=>'1'])->orderBy(['favsrchmst_pk'=>SORT_DESC])->asArray()->one();
		
		$item_array = array();		
		if(count($model)>0) {
			$item_array = array('favsrchmst_pk'=>$model['favsrchmst_pk'],'fsm_srchname'=>ucwords($model['fsm_srchname']),'fsd_prevsrchcnt'=>$model['fsd_prevsrchcnt']);
		}		
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item_array,
        );		
		return $result;
		
	}
	
	
	
	
	public function save_selected_suppliers($reqdata) {

		//echo "<pre>";
		//print_r($reqdata);
		//exit;

		if(isset($reqdata[0]['params'][0]['params'][0]['checkedIDs'])){

			$reqdata = $reqdata[0]['params'];
		}

		
		$result = array();	
		$selected_reg_ids = array();
		if(isset($reqdata[0]['params'][0]['checkedIDs']) && count($reqdata[0]['params'][0]['checkedIDs'])>0) {
			$selected_reg_ids = $reqdata[0]['params'][0]['checkedIDs'];
		}	
		if(isset($reqdata[0]['params'][0]['future_criteria'])) {
			$future_criteria = $reqdata[0]['params'][0]['future_criteria'];
		} else {
			$future_criteria = '';
		}	
		if(isset($reqdata[0]['params'][0]['selectedType'])) {
			$type = $reqdata[0]['params'][0]['selectedType'];
		} else {
			$type = '';
		}			
		
		if(isset($reqdata[0]['params'][0]['RegPk'])) {
			$login_reg_id = $reqdata[0]['params'][0]['RegPk'];
		} else {
			$login_reg_id = "";
		}

		if(isset($reqdata[0]['params'][0]['rfx_id'])) {
			$rfx_id = $reqdata[0]['params'][0]['rfx_id'];
		} else {
			$rfx_id = "";
		}
		
		
		if(isset($reqdata[0]['params'][0]['rfx_id'])) {
			$sharedrfxid = $reqdata[0]['params'][0]['rfx_id'];
		} else {
			$sharedrfxid =  "";
		}

		
		
		if(isset($reqdata[0]['params'][0]['tarfavmstpk'])) {
			$tarfavmstpk = $reqdata[0]['params'][0]['tarfavmstpk'];
		} else {
			$tarfavmstpk =  "";
		}
		
		$success_array = array('msg'=>'Target suppliers saved successfully');		
		$fail_array = array('msg'=>'There is problem while saving supplier');
	
		if(count($selected_reg_ids)>0) {

			$model_temp_data = CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id] )->one();
			
			if($model_temp_data->cmstht_type == '2') {
				$tender_type = 2;
			} else {
				$tender_type = 1;
			}
			
			//$model_tender_target = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$sharedrfxid,'cmsttht_targettype'=>$tender_type] )->all();
			$model_tender_target = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$sharedrfxid] )->all();
			if(count($model_tender_target)>0) {			
				
				if(count($model_temp_data)>0 && $model_temp_data->cmstht_tenderstatus == '1') { 
					
					CmstendertargethdrtempTbl::deleteAll('cmsttht_cmstenderhdrtemp_fk=:tendtemp AND cmsttht_targettype=:type',[':tendtemp'=>$sharedrfxid,':type'=>$tender_type]);
				}
			}
			
			FavsrchmstTbl::insertTargetSupplierTemp($sharedrfxid,$selected_reg_ids);
			$saveFormName =  $reqdata[0]['saveName']; 	
			$fsd_criteria_new = '';
			$fsd_criteriabag_new = '';
			$fsd_prevsrchcnt_new = '';
			if(isset($reqdata[0]['params'][0]['fav_json_criteria'])>0) {
				$fsd_criteria_new = $reqdata[0]['params'][0]['fav_json_criteria'];
			}	
			if(isset($reqdata[0]['params'][0]['fav_criteria_bag'])>0) {
				$fsd_criteriabag_new = $reqdata[0]['params'][0]['fav_criteria_bag'];
			}	
			if(isset($reqdata[0]['params'][0]['fav_prevsrchcnt'])>0) {
				$fsd_prevsrchcnt_new = $reqdata[0]['params'][0]['fav_prevsrchcnt'];
			}	
			
			if($future_criteria>0) { // yes means saving in the fav table				
				FavsrchmstTbl::updateFavmst($saveFormName,$fsd_criteria_new,$fsd_criteriabag_new,$fsd_prevsrchcnt_new);
			} 

			$model_data = CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id])->one();
			if(count($model_data)>0) {	
				$model_data->cmstht_tgtname = $saveFormName;
				$model_data->cmstht_tgtcriteria = $fsd_criteria_new ;
				$model_data->cmstht_tgtcriteriabag = $fsd_criteriabag_new ;
				if($model_data->newcmstendertargethdrTbls>0&&$model_data->cmstht_tenderstatus!=1){
					$model->cmstht_mailfor = 2;
				}
				if($model_data->save()) {	
					$result = array(
						'status' => 200,
						'msg' => 'success',
						'flag' => 'S',
						'moduleData' => $success_array,
					);
				} else {	
					
					$result = array(
						'status' => 200,
						'msg' => 'fails',
						'flag' => 'F',
						'moduleData' => $fail_array,
					);
				}
			}
			
		} else {
			
			$result = array(
							'status' => 201,
							'msg' => 'fails',
							'flag' => 'F',
							'moduleData' =>  $fail_array
						);
		}
		return $result;
		
		
		
	}
	
	
	public function sendTenderMail($data) {
        
		
        $content = "Hi ".$data['username'].", <br> Tender has been invited to you.<br>  Thanks,<br>" . $data['company_name'];
        return \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo('ganesh.askan@gmail.com') // $data['email']
                        ->setSubject('Tender Invited')
                        ->setHTMLBody($content)
                        ->send();
    }
	
	public function get_rft_suppliers($reqdata) {
		
		$rfx_id = $reqdata[0]['rfx_id'];
		$regpk = $reqdata[0]['regpk'];	
		$rfx_type = $reqdata[0]['rfx_type'];	
		$type_array = array('RFI'=>1,'EOI'=>2,'PQ'=>3,'RFP'=>4,'RFQ'=>5,'RFT'=>6,'eTender'=>7,'eAuction'=>8);
		
		$cmsth_type = array_search ($rfx_type, $type_array);
		$rft_count = 0;
		$model_data = CmstenderhdrtempTbl::find()->select('*')->leftJoin('cmstenderhdr_tbl','cmsth_cmstenderhdrtemp_fk = cmstht_cmstenderhdrtemp_fk')->where(['cmstenderhdrtemp_pk'=>$rfx_id])->asArray()->one();
		
		if(count($model_data)>0) {			
			$cmstenderhdr_pk = $model_data['cmstenderhdr_pk'];
			
			if($cmstenderhdr_pk>0) {
				
				$model_rft =  CmstenderresponseTbl::find()->select('*')->leftJoin('cmstenderhdr_tbl','cmstenderhdr_pk = ctr_cmstenderhdr_fk')->leftJoin('membercompanymst_tbl','ctr_memcompmst_fk = MemberCompMst_Pk')->where("ctr_status IN (5) AND cmstenderhdr_pk = $cmstenderhdr_pk AND cmsth_type= $cmsth_type")->asArray()->all();
				$rft_count = count($model_rft);
			}
		}

		$target_model = FavsrchmstTbl::find()->select('*')->innerJoin('favsrchdtls_tbl','fsd_favsrchmst_fk = favsrchmst_pk')->where(['fsm_memberregmst_fk' => $regpk,'fsd_srchtype'=>'CM','fsd_status'=>'1'])->asArray()->one();
		
		$result = array(
						'status' => 200,
						'msg' => 'fails',
						'flag' => 'S',
						'moduleData' => array('rftcount'=>$rft_count,'jsrscount'=>count($target_model)) //count($rft_count); need to replace this
						);
		return $result;	
	}
	
	
	public function show_shortlist_supplier($reqdata) {
		
			
		$type_array = array('RFI'=>1,'EOI'=>2,'PQ'=>3,'RFP'=>4,'RFQ'=>5,'RFT'=>6,'eTender'=>7,'eAuction'=>8);
		
		$rfx_id = $reqdata[0]['rfx_id'];
		$regpk = $reqdata[0]['regpk'];	
		$typevar = strtoupper(trim($reqdata[0]['typevar']));
		$cmsth_type = $type_array[$typevar];
		
		$model_data = CmstenderhdrtempTbl::find()->select('*')->leftJoin('cmstenderhdr_tbl','cmsth_cmstenderhdrtemp_fk = cmstht_cmstenderhdrtemp_fk')->where(['cmstenderhdrtemp_pk'=>$rfx_id])->asArray()->one();
				
		if(count($model_data)>0) {
			
			$cmstenderhdr_pk = $model_data['cmstenderhdr_pk'];
		
			$model =  CmstenderresponseTbl::find()->select('*')->leftJoin('cmstenderhdr_tbl','cmstenderhdr_pk = ctr_cmstenderhdr_fk')->leftJoin('membercompanymst_tbl','ctr_memcompmst_fk = MemberCompMst_Pk')->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')->leftJoin("classificationmst_tbl","ClassificationMst_Pk=mcm_classificationmst_fk")->where(['ctr_status'=>5,'cmstenderhdr_pk' => $cmstenderhdr_pk,'cmsth_type'=>$cmsth_type])->asArray()->all();
						
			
			$item_array = array();
			for($i=0;$i<count($model);$i++) {	
				$company_name = $model[$i]['MCM_CompanyName'];
				$supplier_code = $model[$i]['MCM_SupplierCode'];
				
				$classific = str_replace(' ','',$model[$i]['ClM_ClassificationType'])	;
				
				if(trim($model[$i]['MRM_MemberStatus']) == 'A') {
					$jsrssts = 'Active';
				} else {
					$jsrssts = 'In-Active';
				}
				$expdate = '';
				if(isset($model[$i]['mcm_accexpirydate']) && $model[$i]['mcm_accexpirydate']!='') {
					$expdate = date('d-m-Y',strtotime($model[$i]['mcm_accexpirydate']));
				}
				$reg_pk = $model[$i]['MCM_MemberRegMst_Fk'];
				$oman_company = 0;
				if($model[$i]['MCM_Origin'] == 'I') {
					$oman_company = 1;
				}
				$item_array['list'][] = array('MCM_MemberRegMst_Fk'=>$reg_pk,'checkbox'=>'','suppliercode'=>$supplier_code,'companyname'=>$company_name,'classific'=>$classific,'jsrssts'=>$jsrssts,'expdate'=>$expdate,'action'=>'','national'=>$oman_company);			
			}
			
			$item_array['total'] = count($item_array['list']);
		
		}
				
		$result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $item_array,
        );		
		return $result;				
					

	}

	public function get_target_edit_criteria($reqdata) {

		
		$regpk =  $reqdata[0]['regpk'];	
		$rfx_id =  $reqdata[0]['rfx_id'];			
		
		$model_temp = CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id] )->asArray()->one();
		if(count($model_temp)>0) {
			
			$item_array = array();
			$criteria = $model_temp['cmstht_tgtcriteria'];
			$criteria_bag = json_decode(json_decode($model_temp['cmstht_tgtcriteriabag'],true),true);				
			$model_target_count = count($model_temp['cmstendertargethdrTbls']); 				
			$filterdata =  json_decode($criteria_bag['savedata']['filterSrh'],true);	
					
			$title = 	$model_temp['cmstht_tgtname'];	
			$item_array = array('rfx_id'=>$rfx_id, 'favsrchmst_pk'=>0,'fsm_srchname'=>ucwords($title),'criteria'=>$criteria,'criteriabag'=>$criteria_bag,'fsd_prevsrchcnt'=>'0','filterdata'=>$filterdata);
			$result = array(
				'status' => 200,
				'msg' => 'success',
				'flag' => 'S',
				'moduleData' => $item_array,
			);

		}
				
		return $result;

	}


	public function get_edit_favsearch($reqdata) {

		$favsrchmst_edit_pk = $reqdata[0]['fav_mst_pk'];			
		$model = FavsrchmstTbl::find()->select('*')->innerJoin('favsrchdtls_tbl','fsd_favsrchmst_fk = favsrchmst_pk')->where(['favsrchmst_pk' => $favsrchmst_edit_pk])->asArray()->one();		
		$item_array = array();		
		if(count($model)>0) {
			$criteriabag = json_decode(json_decode($model['fsd_criteriabag'],true),true);
			$filterdata = json_decode($criteriabag['savedata']['filterSrh'],true);	
			
			$item_array = array('favsrchmst_pk'=>$model['favsrchmst_pk'],'fsm_srchname'=>ucwords($model['fsm_srchname']),'criteria'=>$model['fsd_criteria'],'criteriabag'=>json_decode($model['fsd_criteriabag']),'fsd_prevsrchcnt'=>$model['fsd_prevsrchcnt'],'filterdata'=>$filterdata);
			$result = array(
				'status' => 200,
				'msg' => 'success',
				'flag' => 'S',
				'moduleData' => $item_array,
			);
		} else {
			$result = array(
				'status' => 200,
				'msg' => 'fails',
				'flag' => 'F',
				'moduleData' => $item_array,
			);
		}	
	
				
		return $result;
	}


	public function get_delete_favsearch($reqdata) {

		$favsrchmst_edit_pk = $reqdata[0]['fav_mst_pk'];
		$item_array = array();		
		if($favsrchmst_edit_pk>0) {

			$model_dtls = FavsrchdtlsTbl::find()->select('*')->where(['fsd_favsrchmst_fk' => $favsrchmst_edit_pk])->one();		
			if(count($model_dtls)>0) {
				$model_dtls->delete();
			}
			
			$model = FavsrchmstTbl::findOne($favsrchmst_edit_pk);
			if(count($model)>0) {
				$model->delete();
			}
			
			if(count($model)>0) {			
				$result = array(
					'status' => 200,
					'msg' => 'success',
					'flag' => 'S',
					'moduleData' => $item_array,
				);
			} else {
				$result = array(
					'status' => 200,
					'msg' => 'fails',
					'flag' => 'F',
					'moduleData' => $item_array,
				);
			}

		} else {
			$result = array(
				'status' => 200,
				'msg' => 'fails',
				'flag' => 'F',
				'moduleData' => $item_array,
			);

		}	
				
		return $result;
	}

	public function get_tender_target_delete($reqdata) {

		$rfx_id = $reqdata[0]['rfx_id'];
		$item_array = array();		
		if($rfx_id>0) {

			$model_dtls = CmstenderhdrtempTbl::find()->select('*')->where(['cmstenderhdrtemp_pk' => $rfx_id])->one();		
			if(count($model_dtls)>0) {
				$model_dtls->cmstht_tgtname = '';
				$model_dtls->cmstht_tgtcriteria = '';
				$model_dtls->cmstht_tgtcriteriabag = '';
				$model_dtls->save();

				CmstendertargethdrtempTbl::deleteAll('cmsttht_cmstenderhdrtemp_fk=:tendtemp',[':tendtemp'=>$rfx_id]);
				$result = array(
					'status' => 200,
					'msg' => 'success',
					'flag' => 'S',
					'moduleData' => $item_array,
				);
			} else {

				$result = array(
					'status' => 200,
					'msg' => 'fails',
					'flag' => 'F',
					'moduleData' => $item_array,
				);
			}
		}							
		return $result;
	}
	
	
	public function send_reminder_target_suppliers() {

		$model = CmstenderhdrTbl::find()->select('cmstenderhdr_tbl.cmstenderhdr_pk, 
		cmstenderhdr_tbl.cmsth_skdtype,
		cmstenderhdr_tbl.cmsth_skdstartdate,
		cmstenderhdr_tbl.cmsth_skd_timezone_fk,
		cmstenderhdr_tbl.cmsth_skdclosedate,
		cmstenderhdr_tbl.cmsth_setreminder,
		cmstenderhdr_tbl.cmsth_closeintvl,
		cmstenderhdr_tbl.cmsth_closeintvltype,
		cmstenderhdr_tbl.cmsth_openintvl,
		cmstenderhdr_tbl.cmsth_openintvltype,
		cmstenderhdr_tbl.cmsth_skdclosedate,
		usermst_tbl.um_firstname,
		usermst_tbl.um_lastname,
		usermst_tbl.um_middlename,
		usermst_tbl.UM_EmailID,
		membercompanymst_tbl.MemberCompMst_Pk,
		membercompanymst_tbl.MCM_CompanyName,
		membercompanymst_tbl.MCM_SupplierCode')
		->leftJoin('cmstendertargethdr_tbl','cmstth_cmstenderhdr_fk = cmstenderhdr_pk')		
		->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = cmstth_memberregmst_fk')
		->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')		
		->leftJoin('usermst_tbl','UM_MemberRegMst_Fk=MemberRegMst_Pk')
		->where(['cmsth_tenderstatus'=>2,'usermst_tbl.um_primarycontact' => 1])->asArray()->all();

		

		for($i=0;$i<count($model);$i++) {

			$data['username'] = $model[$i]['um_firstname'].' '.$model[$i]['um_middlename'].' '.$model[$i]['um_lastname'];
			$data['email'] = $model[$i]['UM_EmailID'].' '.$model[$i]['um_middlename'].' '.$model[$i]['um_lastname'];
			$data['company_name'] = $model[$i]['MCM_CompanyName'];
			$data['supplier_code'] = $model[$i]['MCM_SupplierCode'];

			Favsrchmst::sendSupplierTenderMail($data);
		}

	}

	public function sendSupplierTenderMail($data) {
        
		
        $content = "Hi ".$data['username'].", <br> Tender has been invited to you.<br>  Thanks,<br>" . $data['company_name'];
        return \Yii::$app->mailer->compose()
                        ->setFrom('noreply@businessgateways.com')
                        ->setTo([
							'ganesh.askan@gmail.com' => 'Ganesh',
							'vignesh@businessgateways.com' => 'Vignesh'
					]) // $data['email']
                        ->setSubject('Tender Invited')
                        ->setHTMLBody($content)
                        ->send();
    }


	public function publish_scheuled_tender() {

		$model = CmstenderhdrTbl::find()->select('
		usermst_tbl.um_firstname,
		usermst_tbl.um_lastname,
		usermst_tbl.um_middlename,
		usermst_tbl.UM_EmailID,
		membercompanymst_tbl.MemberCompMst_Pk,
		membercompanymst_tbl.MCM_CompanyName,
		membercompanymst_tbl.MCM_SupplierCode')
			
		->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = cmstth_memberregmst_fk')
		->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = cmsth_memcompmst_fk')		
		->leftJoin('usermst_tbl','UM_MemberRegMst_Fk=MemberRegMst_Pk')
		->where(['cmsth_tenderstatus'=>2,'usermst_tbl.um_primarycontact' => 1])->asArray()->all();


	}


	public function save_target_only_api($reqdata) {

			
		$type_array = array('RFI'=>1,'EOI'=>2,'PQ'=>3,'RFP'=>4,'RFQ'=>5,'RFT'=>6,'eTender'=>7,'eAuction'=>8);

		$rfx_id = $reqdata[0]['rfx_id'];
		$regpk = $reqdata[0]['regpk'];	
		$regids = $reqdata[0]['regids'];	
		$typevar = strtoupper(trim($reqdata[0]['typevar']));
		$cmsth_type = $type_array[$typevar];
		$favmstpk = $reqdata[0]['favmstpk'];	
		$success_array = array('msg'=>'Target suppliers saved successfully');		
		$fail_array = array('msg'=>'There is problem while saving supplier');	
		$model_data = CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id])->one();
		if(count($model_data)>0) {
			$model_dtls = FavsrchdtlsTbl::find()->select('*')->where(['fsd_favsrchmst_fk' => $favmstpk])->one();
			if(count($model_dtls)>0) {
				$fsd_criteria = $model_dtls->fsd_criteria;
				$fsd_criteriabag = $model_dtls->fsd_criteriabag;
				$model_data->cmstht_tgtcriteria = $fsd_criteria ;
				$model_data->cmstht_tgtcriteriabag = $fsd_criteriabag ;
				if($model_data->save()) {
					$result = array(
						'status' => 200,
						'msg' => 'success',
						'flag' => 'S',
						'moduleData' => $success_array,
					);
				} else {

					$result = array(
						'status' => 200,
						'msg' => 'fails',
						'flag' => 'F',
						'moduleData' => $fail_array,
					);
				}
			}

						

		} else {

			$result = array(
				'status' => 200,
				'msg' => 'fails',
				'flag' => 'F',
				'moduleData' => $fail_array,
			);
		}

		return $result;

	}

	public function get_tender_details($rfx_id){

		$model_data = \api\modules\pms\models\CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id])->one();
		$result = array('critieria_name'=>'', 'criteria_bag'=>'');
		if(count($model_data)>0) {
			$result = array('critieria_name'=>$model_data->cmstht_tgtname, 
			'criteria_bag'=>$model_data->cmstht_tgtcriteriabag,
			'published'=>$model_data->cmstht_tenderstatus);
		}

		return $result;

	}


	public function get_supplier_target_informations($rfx_id,$published,$data) {

			$is_published = 0;
			if($published == 2) {
				$is_published = 1;
			}

	
			$temp_target_suppliers = array();
			$selected_suppliers_array = FavsrchmstTbl::get_current_target_suppliers($rfx_id,$is_published);
			
			for($k=0;$k<count($data['data']);$k++) {
				$temp_target_suppliers[] = $data['data'][$k]['regpk'];
			}
			$temp_target_suppliers_array = $temp_target_suppliers;

			$temp_target_suppliers = array_merge($selected_suppliers_array,$temp_target_suppliers);

			$regids = join(',',$temp_target_suppliers);
			$model = Membercompanymsttbl::find()->select("*")->leftJoin("memberregistrationmst_tbl","MemberRegMst_Pk=MCM_MemberRegMst_Fk")->leftJoin("classificationmst_tbl","ClassificationMst_Pk=mcm_classificationmst_fk")->where("MCM_MemberRegMst_Fk IN ($regids) order by
			find_in_set( MCM_MemberRegMst_Fk, '$regids' ) ")->asArray()->all();						
			$item_array = array();
			for($i=0;$i<count($model);$i++) {	
				$company_name = $model[$i]['MCM_CompanyName'];
				$supplier_code = $model[$i]['MCM_SupplierCode'];
				$hide_supplier = 0;
				$jsrssts = 'In-Active';
				$isjsrs =  'In-Active';
				$expdate = '';
				$rejected =  0;
				$oman_company = 0;
				$selected_supplier = 0;
				$classific = str_replace(' ','',$model[$i]['ClM_ClassificationType'])	;				
				if(trim($model[$i]['MRM_MemberStatus']) == 'A') {
					$jsrssts = 'Active';
					$isjsrs =  'Active';
				} 				
				if(isset($model[$i]['mcm_accexpirydate']) && $model[$i]['mcm_accexpirydate']!='') {
					$expdate = date('d-m-Y',strtotime($model[$i]['mcm_accexpirydate']));
				}
				$reg_pk = $model[$i]['MCM_MemberRegMst_Fk'];
				if($model[$i]['MCM_Origin'] == 'N') {
					$oman_company = 1;
				}
				if(in_array($model[$i]['MCM_MemberRegMst_Fk'],$selected_suppliers_array) ) {
					$hide_supplier = 1;
				}
				if(in_array($model[$i]['MCM_MemberRegMst_Fk'],$selected_suppliers_array)) {
					$selected_supplier = 1;
				}		
				$item_array['list'][] = array('MCM_MemberRegMst_Fk'=>$reg_pk,
				'MemberCompMst_Pk'=>$model[$i]['MemberCompMst_Pk'],
				'compPk'=>$model[$i]['MemberCompMst_Pk'],
				'compkey'=>$model[$i]['MemberCompMst_Pk'],
				'select'=>'',
				'suppliercode'=>$supplier_code,
				'suppcode'=>$supplier_code,
				'companyname'=>$company_name,
				'name'=>$company_name,
				'classific'=>$classific,
				'classify'=>$classific,
				'jsrssts'=>$jsrssts,
				'isjsrs'=>$isjsrs,
				'expdate'=>$expdate,
				'exp'=>$expdate,
				'action'=>'',
				'rejected'=>$rejected,
				'national'=>$oman_company,
				'hide_supplier'=>$hide_supplier,
				'selected_supplier'=>$selected_supplier,
				'is_published'=>$is_published);
			}

			//echo "<pre>";
			//print_r($item_array);

			$item_array['total'] = count($item_array['list']);	
			$item_array['selectedsupplierstotal'] = count($selected_suppliers_array);				
			$result = array(
				'status' => 200,
				'msg' => 'success',
				'flag' => 'S',
				'moduleData' => $item_array,
			);		
			return $result;				


	}


	function get_current_target_suppliers($rfx_id,$is_published) {
		$suppliers_array = array();
		
		//$model_tender_target = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$rfx_id,'cmsttht_targettype'=>2] )->all();
		
		$model_tender_target = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$rfx_id] )->all();
		
		if(count($model_tender_target)>0) {
			for($j=0;$j<count($model_tender_target);$j++) {
				$suppliers_array[] = $model_tender_target[$j]->cmsttht_memberregmst_fk;
			}
		}	
		return $suppliers_array;
	}


	function updateFavmst($saveFormName,$fsd_criteria,$fsd_criteriabag,$fsd_prevsrchcnt) {

		
		$srcMstObj = new FavsrchmstTbl;
		$srcMstObj->fsm_srchname =  $saveFormName;
		$srcMstObj->fsm_memberregmst_fk = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
		$srcMstObj->fsm_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
		$srcMstObj->fsm_createdon = date('Y-m-d H:i:s');
		if($srcMstObj->save()){
			$srcMstPk = $srcMstObj->favsrchmst_pk;
			$srcMstdtlObj = new FavsrchdtlsTbl;
			$srcMstdtlObj->fsd_favsrchmst_fk = $srcMstPk;
			$srcMstdtlObj->fsd_srchtype = 'CM';
			$srcMstdtlObj->fsd_status = '1';
			$srcMstdtlObj->fsd_criteria = $fsd_criteria;
			$srcMstdtlObj->fsd_criteriabag = $fsd_criteriabag;
			$srcMstdtlObj->fsd_prevsrchcnt = $fsd_prevsrchcnt;
			$srcMstdtlObj->save(); 
		}


	}

	function insertTargetSupplierTemp($rfx_id,$supplier_ids) {

		$model_tender_temp =  CmstenderhdrtempTbl::find()->where(['cmstenderhdrtemp_pk'=>$rfx_id] )->one();
		if(count($supplier_ids)>0 && count($model_tender_temp)>0) {

			if($model_tender_temp->cmstht_tenderstatus == '2') {
				// updating the existing supplier as 2
				Yii::$app->db->createCommand("update cmstendertargethdrtemp_tbl set cmsttht_targetsuptype = '2' where cmsttht_cmstenderhdrtemp_fk = '$rfx_id'  ")->execute();
			}

			if($model_tender_temp->cmstht_type == '2' || $model_tender_temp->cmstht_type == '5') {
				$tender_type = 2;
			} else {
				$tender_type = 1;

			}


			for($i=0;$i<count($supplier_ids);$i++) {				
				$single_reg_id = $supplier_ids[$i];
				$model_tender_target = CmstendertargethdrtempTbl::find()->where(['cmsttht_cmstenderhdrtemp_fk'=>$rfx_id,'cmsttht_memberregmst_fk'=>$single_reg_id,'cmsttht_targettype'=>$tender_type] )->one();

				if(count($model_tender_target) ==0) {
					$model_tender_target = new CmstendertargethdrtempTbl();
					$model_tender_target->cmsttht_cmstenderhdrtemp_fk = $rfx_id;				
					$model_tender_target->cmsttht_memberregmst_fk = $single_reg_id;
					$model_tender_target->cmsttht_targettype = $tender_type; 
					$model_tender_target->cmsttht_mailfor = 1; 
					$model_tender_target->cmsttht_targetsuptype = 1;
					$model_tender_target->save();

					
				}
			}

		}
		


	}




	
	
}
