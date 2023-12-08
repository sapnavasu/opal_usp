<?php

namespace app\models;

use Yii;
use \yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apppytminvoicedtls_tbl".
 *
 * @property int $apppytminvoicedtls_pk
 * @property int $apid_opalmemberregmst_fk Reference to opalmemberregmst_pk,The centre who have to make the payment
 * @property int $apid_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $apid_feesubscriptionmst_fk Reference to feesubscriptionmst_pk
 * @property int $apid_appcoursedtlstmp_fk Reference to appcoursedtlstmp_pk
 * @property int $apid_appcoursetrnstmp_fk Reference to appcoursetrnstmp_pk
 * @property string $apid_invoiceno
 * @property string $apid_raisedon
 * @property int $apid_noofstaffeval
 * @property string $apid_coursecertfee
 * @property string $apid_staffevalfee
 * @property string $apid_vatamount
 * @property string $apid_vatpercent
 * @property string $apid_additionalcharges Additional Charges
 * @property int $apid_paymenttype 1-Online, 2-Offline
 * @property int $apid_paymentmode 1-Cheque, 2-Bank Transfer, 3-Cash
 * @property string $apid_transuniqueId
 * @property string $apid_bankname
 * @property string $apid_dateofpymt
 * @property string $apid_offlinerefno
 * @property int $apid_pymtproof Payment proof file will be stored here. Reference to memcompfiledtls_tbl
 * @property int $apid_invoicestatus 1 - Pending, 2 - Paid - Verification Pending, 3 - Approved, 4 - Declined
 * @property string $apid_appdecon
 * @property int $apid_appdecby
 * @property string $apid_appdecComments
 *
 * @property ApppymtdtlshstyTbl[] $apppymtdtlshstyTbls
 * @property ApppymtdtlsmainTbl[] $apppymtdtlsmainTbls
 * @property ApppymtdtlstmpTbl[] $apppymtdtlstmpTbls
 * @property AppcoursedtlstmpTbl $apidAppcoursedtlstmpFk
 * @property AppcoursetrnstmpTbl $apidAppcoursetrnstmpFk
 * @property ApplicationdtlstmpTbl $apidApplicationdtlstmpFk
 * @property FeesubscriptionmstTbl $apidFeesubscriptionmstFk
 * @property OpalmemberregmstTbl $apidOpalmemberregmstFk
 * @property MemcompfiledtlsTbl $apidPymtproof
 * @property StaffevaluationhstyTbl[] $staffevaluationhstyTbls
 * @property StaffevaluationmainTbl[] $staffevaluationmainTbls
 * @property StaffevaluationtmpTbl[] $staffevaluationtmpTbls
 */
class ApppytminvoicedtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apppytminvoicedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apid_opalmemberregmst_fk', 'apid_applicationdtlstmp_fk', 'apid_raisedon'], 'required'],
            [['apid_opalmemberregmst_fk', 'apid_applicationdtlstmp_fk', 'apid_feesubscriptionmst_fk', 'apid_appcoursedtlstmp_fk', 'apid_appcoursetrnstmp_fk', 'apid_noofstaffeval', 'apid_paymenttype', 'apid_paymentmode', 'apid_pymtproof', 'apid_invoicestatus', 'apid_appdecby'], 'integer'],
            [['apid_raisedon', 'apid_dateofpymt', 'apid_appdecon'], 'safe'],
            [['apid_coursecertfee', 'apid_staffevalfee', 'apid_vatpercent', 'apid_additionalcharges'], 'number'],
            [['apid_appdecComments'], 'string'],
            [['apid_invoiceno'], 'string', 'max' => 30],
            [['apid_vatamount', 'apid_offlinerefno'], 'string', 'max' => 50],
            [['apid_transuniqueId'], 'string', 'max' => 80],
            [['apid_bankname'], 'string', 'max' => 500],
            [['apid_appcoursedtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlstmpTbl::className(), 'targetAttribute' => ['apid_appcoursedtlstmp_fk' => 'appcoursedtlstmp_pk']],
            [['apid_appcoursetrnstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursetrnstmpTbl::className(), 'targetAttribute' => ['apid_appcoursetrnstmp_fk' => 'appcoursetrnstmp_pk']],
            [['apid_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['apid_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['apid_feesubscriptionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeesubscriptionmstTbl::className(), 'targetAttribute' => ['apid_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']],
            [['apid_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['apid_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['apid_pymtproof'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfiledtlsTbl::className(), 'targetAttribute' => ['apid_pymtproof' => 'memcompfiledtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'apppytminvoicedtls_pk' => 'Apppytminvoicedtls Pk',
            'apid_opalmemberregmst_fk' => 'Reference to opalmemberregmst_pk,The centre who have to make the payment',
            'apid_applicationdtlstmp_fk' => 'Reference to applicationdtlstmp_pk',
            'apid_feesubscriptionmst_fk' => 'Reference to feesubscriptionmst_pk',
            'apid_appcoursedtlstmp_fk' => 'Reference to appcoursedtlstmp_pk',
            'apid_appcoursetrnstmp_fk' => 'Reference to appcoursetrnstmp_pk',
            'apid_invoiceno' => 'Apid Invoiceno',
            'apid_raisedon' => 'Apid Raisedon',
            'apid_noofstaffeval' => 'Apid Noofstaffeval',
            'apid_coursecertfee' => 'Apid Coursecertfee',
            'apid_staffevalfee' => 'Apid Staffevalfee',
            'apid_vatamount' => 'Apid Vatamount',
            'apid_vatpercent' => 'Apid Vatpercent',
            'apid_additionalcharges' => 'Additional Charges',
            'apid_paymenttype' => '1-Online, 2-Offline',
            'apid_paymentmode' => '1-Cheque, 2-Bank Transfer, 3-Cash',
            'apid_transuniqueId' => 'Apid Transunique ID',
            'apid_bankname' => 'Apid Bankname',
            'apid_dateofpymt' => 'Apid Dateofpymt',
            'apid_offlinerefno' => 'Apid Offlinerefno',
            'apid_pymtproof' => 'Payment proof file will be stored here. Reference to memcompfiledtls_tbl',
            'apid_invoicestatus' => '1 - Pending, 2 - Paid - Verification Pending, 3 - Approved, 4 - Declined',
            'apid_appdecon' => 'Apid Appdecon',
            'apid_appdecby' => 'Apid Appdecby',
            'apid_appdecComments' => 'Apid Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlshstyTbls()
    {
        return $this->hasMany(ApppymtdtlshstyTbl::className(), ['apppdh_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlsmainTbls()
    {
        return $this->hasMany(ApppymtdtlsmainTbl::className(), ['apppdm_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppymtdtlstmpTbls()
    {
        return $this->hasMany(ApppymtdtlstmpTbl::className(), ['apppdt_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidAppcoursedtlstmpFk()
    {
        return $this->hasOne(AppcoursedtlstmpTbl::className(), ['appcoursedtlstmp_pk' => 'apid_appcoursedtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidAppcoursetrnstmpFk()
    {
        return $this->hasOne(AppcoursetrnstmpTbl::className(), ['appcoursetrnstmp_pk' => 'apid_appcoursetrnstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'apid_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidFeesubscriptionmstFk()
    {
        return $this->hasOne(FeesubscriptionmstTbl::className(), ['feesubscriptionmst_pk' => 'apid_feesubscriptionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'apid_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApidPymtproof()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'apid_pymtproof']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationhstyTbls()
    {
        return $this->hasMany(StaffevaluationhstyTbl::className(), ['seh_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationmainTbls()
    {
        return $this->hasMany(StaffevaluationmainTbl::className(), ['sem_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffevaluationtmpTbls()
    {
        return $this->hasMany(StaffevaluationtmpTbl::className(), ['set_apppytminvoicedtls_fk' => 'apppytminvoicedtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ApppytminvoicedtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApppytminvoicedtlsTblQuery(get_called_class());
    }

    public static function getInvDtls($ipArray) {
        
        $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);

        $usercourse = OpalusermstTbl::find()
        ->select(['oum_standcoursemst_fk' , 'oum_allocatedproject' , 'oum_isfocalpoint' , 'oum_opalmemberregmst_fk'])
        ->where("opalusermst_pk = '$userPk'")
        ->andWhere("oum_status = 'A'")
        ->asArray()
        ->one();   

        if($usercourse['oum_isfocalpoint'] == '1' and $usercourse['oum_opalmemberregmst_fk'] == '1'){
            $project_pk = '2,3';
            $standardcourse = '';
        }else{
            $project_pk_array = [];
            $allocatedprojects  = explode(',', $usercourse['oum_allocatedproject']);
            if(in_array('2',$allocatedprojects)){
              array_push($project_pk_array , 2);
            }
            if(in_array('3',$allocatedprojects)){
                array_push($project_pk_array , 3);
            }
            $project_pk  = implode(',',$project_pk_array);
            if($usercourse['oum_standcoursemst_fk']){
                $standardcourse =  " and stdcour.standardcoursemst_pk in (".$usercourse['oum_standcoursemst_fk'].")";
            }
        }
        
        $provider="";
            $model = ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apppytminvoicedtls_pk',
                'pm_projectname_en','pm_projectname_ar',
                "appcdt_standardcoursemst_fk",
                'omrm_companyname_en','omrm_companyname_ar',
                'omrm_tpname_en','omrm_tpname_ar',
                'appiim_officetype','appiim_branchname_en','appiim_branchname_ar',
                'omrm_opalmembershipregnumber','scm_coursename_en','scm_coursename_ar',
                'appocm_coursename_en','appocm_coursename_ar',
                'appcdt_appoffercoursemain_fk',
                'courcatstd.ccm_catname_en as catstden','courcatstd.ccm_catname_ar as catstdar',
                'courcatofr.ccm_catname_en as catofren','courcatofr.ccm_catname_ar as catofrar',
                'fsm_feestype','fsm_applicationtype','apid_coursecertfee','apid_vatamount',
                '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
                'apid_noofstaffeval','apid_invoicestatus','apid_paymenttype',
                'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
                'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
                'DATEDIFF(now(), apid_raisedon) as agedate','appcoursedtlstmp_pk','appdt_projectmst_fk'
                ])
                ->leftJoin('appcoursedtlstmp_tbl apcourdtls','apcourdtls.appcoursedtlstmp_pk = apppytminvoicedtls_tbl.apid_appcoursedtlstmp_fk')
                ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apcourdtls.appcdt_applicationdtlstmp_fk')
                ->leftJoin('projectmst_tbl pro','pro.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
                ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdtlstmp.appdt_opalmemberregmst_fk')
                ->leftJoin('appinstinfomain_tbl appinsinfo','appinsinfo.appinstinfomain_pk = apcourdtls.appcdt_appinstinfomain_fk')
                ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtls.appcdt_standardcoursemst_fk')
                ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdt_appoffercoursemain_fk')
                
                ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
                ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')

                //left join standardcoursedtls_tbl on stdcour.standardcoursemst_pk=scd_standardcoursemst_fk
                //LEFT JOIN `coursecategorymst_tbl` `ccm` ON ccm.coursecategorymst_pk = scd_subcoursecategorymst_fk
                ->leftJoin('standardcoursedtls_tbl','stdcour.standardcoursemst_pk = scd_standardcoursemst_fk')
                ->leftJoin('coursecategorymst_tbl ccm','ccm.coursecategorymst_pk = scd_subcoursecategorymst_fk')
                
                ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apppytminvoicedtls_tbl.apid_feesubscriptionmst_fk')
                //->leftJoin('applicationdtlstmp_tbl apdtmp','apdtmp.opalusermst_pk = appintrecogtmp_tbl.appintit_appdecby')
               // ->where(['IN', 'appdtlstmp.appdt_projectmst_fk', $project_pk])
               ->Where("appdtlstmp.appdt_projectmst_fk in  (".$project_pk .")    ".$standardcourse."")
                ->groupBy('apid_invoiceno');
                
                if($ipArray['gridsearchValues'] != ''){
                        if(!empty($ipArray['excel'])){
                            $gridsearchValues = $ipArray['gridsearchValues'];
                        }else{
                            $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);
                        }
                        
                        $invoice_no = $gridsearchValues['invoice_no'];
                        $course_type = $gridsearchValues['course_type'];
                        $company_name = $gridsearchValues['company_name'];
                        $training_provider = $gridsearchValues['training_provider'];
                        $office_type = $gridsearchValues['office_type'];
                        $bran_name = $gridsearchValues['bran_name'];
                        $opal_membership = $gridsearchValues['opal_membership'];
                        $course_title = $gridsearchValues['course_title'];
                        $course_cate = $gridsearchValues['course_cate'];
                        $course_sub = $gridsearchValues['course_sub'];
                        $Fee_type = $gridsearchValues['Fee_type'];
                        $noof_staff = $gridsearchValues['noof_staff'];
                        $pay_status = $gridsearchValues['pay_status'];
                        $pay_type = $gridsearchValues['pay_type'];
                        $invoice_date = $gridsearchValues['invoice_date'];
                        $invoice_age = $gridsearchValues['invoice_age'];
                        $payment_date = $gridsearchValues['payment_date'];
                        
                        if($invoice_no){
                            $model->andFilterWhere(['AND', ['LIKE', 'apid_invoiceno', $invoice_no],]);
                        }

                        if($course_type){
                            //$model->andFilterWhere(['AND', ['IN', 'appdtlstmp.appdt_projectmst_fk', $course_type],]);
                            $model->andwhere("appdtlstmp.appdt_projectmst_fk in( ".implode(",",$course_type).")");
                        }

                        if($company_name){
                            $model->andFilterWhere(['AND', ['LIKE', 'omrm_companyname_en', $company_name],]);
                        }

                        if($training_provider){
                            $model->andFilterWhere(['AND', ['LIKE', 'omrm_tpname_en', $training_provider],]);
                        }

                        if($office_type){
                            $model->andFilterWhere(['AND', ['IN', 'appiim_officetype', $office_type],]);
                        }

                        if($bran_name){
                            $model->andFilterWhere(['AND', ['LIKE', 'appiim_branchname_en', $bran_name],]);
                        }

                        if($opal_membership){
                            $model->andFilterWhere(['AND', ['LIKE', 'omrm_opalmembershipregnumber', $opal_membership],]);
                        }

                        if($course_title){
                            $model->andFilterWhere(['AND', ['LIKE', 'scm_coursename_en', $course_title],]);
                        }

                        if($course_cate){
                            $model->andFilterWhere(['AND', ['LIKE', 'courcatstd.ccm_catname_en', $course_cate],]);
                        }
                        //echo $course_sub;exit;
                        if($course_sub){
                            //$model->andFilterWhere(['AND', ['=', 'ccm.ccm_catname_en', $course_sub],]);
                            $model->andWhere("find_in_set('$course_sub',ccm.ccm_catname_en)");
                        }

                        if($Fee_type){
                            //$model->andFilterWhere(['AND', ['LIKE', 'fsm_feestype', $Fee_type],]);
                            $model->andwhere("fsm_feestype in( ".implode(",",$Fee_type).")");
                        }

                        if($noof_staff || $noof_staff == '0'){
                            $model->andFilterWhere(['AND', ['=', 'apid_noofstaffeval', $noof_staff],]);
                        }

                        if($pay_status){
                            //$model->andFilterWhere(['AND', ['LIKE', 'apid_invoicestatus', $pay_status],]);
                            $model->andwhere("apid_invoicestatus in( ".implode(",",$pay_status).")");
                        }

                        if($pay_type){
                            //$model->andFilterWhere(['AND', ['LIKE', 'apid_paymenttype', $pay_type],]);
                            $model->andwhere("apid_paymenttype in( ".implode(",",$pay_type).")");
                        }
                        
                        if($invoice_date['startDate'] && $invoice_date['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_raisedon)', date('Y-m-d',strtotime($invoice_date['startDate']. " +1 day")), date('Y-m-d',strtotime($invoice_date['endDate']. " +1 day"))]);
                        }

                        if($payment_date['startDate'] && $payment_date['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_dateofpymt)', date('Y-m-d',strtotime($payment_date['startDate']. " +1 day")), date('Y-m-d',strtotime($payment_date['endDate']. " +1 day"))]);
                        }

                        
                }
             $sort_column = (strpos($ipArray['sort'],"-") !== false) ? explode("-",$ipArray['sort'])[1] : $ipArray['sort'];
             $order_by = ($ipArray['order']=='asc')? 'asc': 'desc';
             $model->orderBy("$sort_column $order_by");
           

            if(!isset($ipArray['excel'])){
                $model->asArray();
                $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10 ;
                //$page = 250;
                $provider = new \yii\data\ActiveDataProvider([
                    'query' => $model,
                    'pagination' => [
                        'pageSize' => $page,
                        'page' => $ipArray['page']
                    ],
                ]);

                $data = $provider->getModels();
                $count = $provider->getTotalCount();
            }else{
                $data = $model->asArray()->all();
                $count = 0;
            }
            
            foreach($data as $dataInfo){
                
                    $resAry=$dataInfo;
                    $modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => $dataInfo['appcoursedtlstmp_pk']])->all();
                    //$modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => 29])->all();
                    $carArrayen=$carArrayar=array();
                    foreach($modelcat as $modelcatInfo){
                        $modelcatname = CoursecategorymstTbl::find()->where("coursecategorymst_pk =:courcat", [':courcat' => $modelcatInfo->appctt_coursecategorymst_fk])->one();
                        $carArrayen[]=$modelcatname->ccm_catname_en;
                        $carArrayar[]=$modelcatname->ccm_catname_ar;
                    }
                    $resAry['subcaten']= implode(",",$carArrayen);
                    $resAry['subcatar']= implode(",",$carArrayar);
                    $finalAry[]=$resAry;
            }
            
             $response = array();
             $response['data'] = $finalAry; 
             $response['totalcount'] = $count;
             $response['size'] = $page;
             return $response;
          
  
    }

    public static function getInvoiceview($ipArray) {
        
        $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $provider="";
            $model = ApppytminvoicedtlsTbl::find()
                ->select(['apid_invoiceno','apppytminvoicedtls_pk',
                'pm_projectname_en','pm_projectname_ar',
                'omrm_companyname_en','omrm_companyname_ar',
                'omrm_tpname_en','omrm_tpname_ar',
                'appcdt_standardcoursemst_fk',
                'appiim_officetype','appiim_branchname_en','appiim_branchname_ar',
                'omrm_opalmembershipregnumber','scm_coursename_en','scm_coursename_ar',
                'appocm_coursename_en','appocm_coursename_ar',
                'appcdt_appoffercoursemain_fk',
                'courcatstd.ccm_catname_en as catstden','courcatstd.ccm_catname_ar as catstdar',
                'courcatofr.ccm_catname_en as catofren','courcatofr.ccm_catname_ar as catofrar',
                'fsm_feestype','fsm_applicationtype','apid_coursecertfee','apid_vatamount','apid_staffevalfee',
                '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
                'apid_noofstaffeval','apid_invoicestatus','apid_paymenttype',
                'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
                'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
                'DATE_FORMAT(apid_appdecon,"%d-%m-%Y") AS apdecdate',
                'DATEDIFF(now(), apid_raisedon) as agedate','appcoursedtlstmp_pk',
                'apid_vatamount','apid_paymentmode','apid_transuniqueId','apid_bankname',
                'apid_dateofpymt','apid_pymtproof','apid_appdecComments as appcomment','apid_appdecby','apid_offlinerefno'
                ])
                ->leftJoin('appcoursedtlstmp_tbl apcourdtls','apcourdtls.appcoursedtlstmp_pk = apppytminvoicedtls_tbl.apid_appcoursedtlstmp_fk')
                ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apcourdtls.appcdt_applicationdtlstmp_fk')
                ->leftJoin('projectmst_tbl pro','pro.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
                ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdtlstmp.appdt_opalmemberregmst_fk')
                ->leftJoin('appinstinfomain_tbl appinsinfo','appinsinfo.appinstinfomain_pk = apcourdtls.appcdt_appinstinfomain_fk')
                ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtls.appcdt_standardcoursemst_fk')
                ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdt_appoffercoursemain_fk')
                ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
                ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')
                ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apppytminvoicedtls_tbl.apid_feesubscriptionmst_fk')
                //->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appintrecogtmp_tbl.appintit_appdecby')
                ->where('apppytminvoicedtls_pk = '. $ipArray['inv_pk'])
                ->asArray()->one();
            $model['apid_appdecComments'] = strip_tags($model['appcomment']);
            if(!empty($model)){
                
                    //$resAry=$dataInfo;
                    $modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => $model['appcoursedtlstmp_pk']])->all();
                    //$modelcat = AppcoursetrnstmpTbl::find()->where("appctt_appcoursedtlstmp_fk =:cour", [':cour' => 29])->all();
                    $carArrayen=$carArrayar=array();
                    foreach($modelcat as $modelcatInfo){
                        $modelcatname = CoursecategorymstTbl::find()->where("coursecategorymst_pk =:courcat", [':courcat' => $modelcatInfo->appctt_coursecategorymst_fk])->one();
                        $carArrayen[]=$modelcatname->ccm_catname_en;
                        $carArrayar[]=$modelcatname->ccm_catname_ar;
                    }
                    $model['subcaten']= implode(", ",$carArrayen);
                    $model['subcatar']= implode(", ",$carArrayar);
                    //$finalAry[]=$model;
            }

            
            $model['approvrby']= OpalusermstTbl::findOne($model['apid_appdecby'])->oum_firstname;

            $model['docUrl']= \api\components\Drive::generateUrl($model['apid_pymtproof'],$companyPk,$userPk);
            $model['fileName']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));
            $model['ext']= pathinfo($model['fileName'],PATHINFO_EXTENSION);
            $model['flePk']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));

            $response = array();
            $response['data'] = $model; 
             
            return $response;
          
  
    }

    public static function getInvCenterCertiDtls($params) {
        // $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        // $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $searchData = [
            'invoiceno' => 'apid_invoiceno',
            'compannyname' => 'omrm_companyname_en', 
            'trainingprovider' => 'omrm_tpname_en',
            'officetype' => 'appiim_officetype',
            'branchname' => 'appiim_branchname_en',
            'opalmember' => 'omrm_opalmembershipregnumber',
            'Feetype' => 'fsm_feestype',
            'invoiceamount' => 'total',
            'paymentstatus' => 'apid_invoicestatus',
            'paymenttype' => 'apid_paymenttype',
            'invoicedate' => 'invdate',
            'invoiceage' => 'agedate',
            'paymentdate' => 'pymtdate'
        ];
        $provider="";
            $model = ApppytminvoicedtlsTbl::find()
                ->select(['apppytminvoicedtls_pk','apid_invoiceno',
                'omrm_companyname_en','omrm_companyname_ar',
                'omrm_tpname_en','omrm_tpname_ar',
                "(case  
                when appiit_officetype = 1 then 'Main office' 
                when appiit_officetype = 2 then 'Branch office'
                end) as appiim_officetype",
                'appiit_branchname_en as appiim_branchname_en','appiit_branchname_ar as appiim_branchname_ar',
                'omrm_opalmembershipregnumber',
                "(case  
                when fsm_feestype = 1 then 'Certification Fee' 
                when fsm_feestype = 2 then 'Staff Evaluation Fee'
                when fsm_feestype = 3 then 'Royalty Fee'
                when fsm_feestype = 4 then 'Learner Training Fee'
                when fsm_feestype = 5 then 'Learner Assessment Fee'
                when fsm_feestype = 6 then 'Staff Re-Evaluation Fee'
                end) as fsm_feestype",
                '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0)) AS total',
                "(case  
                when apid_invoicestatus = 1 then 'Pending' 
                when apid_invoicestatus = 2 then 'Paid - Verification Pending'
                when apid_invoicestatus = 3 then 'Approved' 
                when apid_invoicestatus = 4 then 'Declined' 
                end) as apid_invoicestatus",
                "(case  
                when apid_paymenttype = 1 then 'Online' 
                when apid_paymenttype = 2 then 'Offline' 
                end) as apid_paymenttype",
                'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
                'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
                'DATEDIFF(now(), apid_raisedon) as agedate',
                
                // "(case  
                // when apid_paymentmode = 1 then 'Cheque' 
                // when apid_paymentmode = 2 then 'Bank Transfer'
                // when apid_paymentmode = 2 then 'Cash' 
                // end) as apid_paymentmode",
                "(case  
                when feesub.fsm_applicationtype = 1 then 'Initial' 
                when feesub.fsm_applicationtype = 2 then 'Renewal'
                when feesub.fsm_applicationtype = 3 then 'Update' 
                when feesub.fsm_applicationtype = 4 then 'Refresher' 
                when feesub.fsm_applicationtype = 5 then 'Surveillance 1' 
                when feesub.fsm_applicationtype = 6 then 'Surveillance 2 by dafault 0' 
                end) as fsm_applicationtype", 
                'pm_projtype'
                ])
                ->leftJoin('appcoursedtlstmp_tbl apcourdtls','apcourdtls.appcoursedtlstmp_pk = apppytminvoicedtls_tbl.apid_appcoursedtlstmp_fk')
                // ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apcourdtls.appcdt_applicationdtlstmp_fk')
                ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apppytminvoicedtls_tbl.apid_applicationdtlstmp_fk')
                ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdtlstmp.appdt_opalmemberregmst_fk')
                ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appiit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
                // ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appinstinfotmp_pk = apcourdtls.appcdt_appinstinfomain_fk')
                ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apppytminvoicedtls_tbl.apid_feesubscriptionmst_fk')
                ->leftJoin('projectmst_tbl project','project.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
                ->where(['project.pm_projtype' => 1])
                ->andWhere(['IN', 'appdtlstmp.appdt_projectmst_fk', [1]])
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC]);
                
                if($params['searchkey'] != ''){
                        $searchkey = $params['searchkey'];  
                        
                        $invoiceNo = $searchkey['invoice_no'];
                        $compannyName = $searchkey['company_name'];
                        $trainingProvider = $searchkey['training_provider'];
                        $officeType = $searchkey['officetype'];
                        $branchName = $searchkey['bran_name'];
                        $opalMember = $searchkey['opal_membership'];
                        $FeeType = $searchkey['Fee_type'];
                        $paymentStatus = $searchkey['pay_status'];
                        $paymenttype = $searchkey['pay_type'];
                        $invoicedate = $searchkey['invoice_date'];
                        $invoiceage = $searchkey['invoice_age'];
                        $paymentdate = $searchkey['payment_date'];
                                        
                        if($invoiceNo){
                            $model->andFilterWhere(['LIKE', 'apid_invoiceno', $invoiceNo]);
                        }

                        if($compannyName){
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_en', $compannyName]);
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_ar', $compannyName]);
                        }

                        if($trainingProvider){
                            $model->andFilterWhere(['LIKE', 'omrm_tpname_en', $trainingProvider]);
                            $model->andFilterWhere(['LIKE', 'omrm_tpname_ar', $trainingProvider]);
                        }

                        if($officeType){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['IN',  'appiit_officetype', $officeType]);
                        }

                        if($branchName){
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_en', $branchName]);
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_ar', $branchName]);
                        }

                        if($opalMember){
                            $model->andFilterWhere(['LIKE', 'omrm_opalmembershipregnumber', $opalMember]);
                        }

                        if($FeeType){
                            $model->andFilterWhere(['IN', 'fsm_applicationtype', $FeeType]);
                        }

                        if($paymentStatus){
                            $model->andFilterWhere(['IN', 'apid_invoicestatus', $paymentStatus]);
                        }

                        if($paymenttype){
                            $model->andFilterWhere(['IN', 'apid_paymenttype', $paymenttype]);
                        }
                        // echo $model->createCommand()->getRawSql(); die;

                        if($invoicedate['startDate'] && $invoicedate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_raisedon)', date('Y-m-d',strtotime($invoicedate['startDate'])), date('Y-m-d',strtotime($invoicedate['endDate']))]);
                        }

                        // if($invoiceage){
                        //     $model->andFilterWhere(['IN', 'agedate', $invoiceage]);
                        // }

                        if($paymentdate['startDate'] && $paymentdate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_dateofpymt)', date('Y-m-d',strtotime($paymentdate['startDate'])), date('Y-m-d',strtotime($paymentdate['endDate']))]);
                        }
                        
                }
            if(isset($searchData[$params['sort']])){
                $sort_column = $searchData[$params['sort']];
                $order_by = ($params['order']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }
             
             $model->asArray();
             if(isset($params['excel']))
             {
                $response['data'] = $model->asArray()->all();
                return $response;
             }
             $pageSize = (!empty($params['size']) && $params['size'] != 'undefined') ? $params['size'] : 10 ;
             $p = $params['page'];
             if($params['page']*$pageSize > $model->count()){
                $p = round($model->count()/$pageSize);
             }
            //  echo $params['page']*$pageSize,$model->count(); die;
             $provider = new \yii\data\ActiveDataProvider([
                 'query' => $model,
                 'pagination' => [
                     'pageSize' => $pageSize,
                     'page' => $p],
             ]);
 
            $data = $provider->getModels();
            
             $response = array();
             $response['data'] = $data;
             $response['totalcount'] = $provider->getTotalCount();
             $response['size'] = $pageSize;
             return $response;
    }
    
    public static function getTraingCenterDtl($id) {
        
        $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
            
        $model = ApppytminvoicedtlsTbl::find()
            ->select(['apppytminvoicedtls_pk','apid_invoiceno',
            'omrm_companyname_en','omrm_companyname_ar',
            'omrm_branch_en as omrm_tpname_en','omrm_branch_ar as omrm_tpname_ar',
            'apppdt_staffevafee',
            'apid_staffevalfee',
            'pm_projectname_en','pm_projectname_ar',
            'apid_noofstaffeval',
            'apid_raisedon',
            'apid_coursecertfee',
            'apid_vatamount',
            "(case  
            when appinsinfo.appiit_officetype = 1 then 'Main office' 
            when appinsinfo.appiit_officetype = 2 then 'Branch office'
            end) as appiim_officetype",
            'appiit_branchname_en as appiim_branchname_en','appiit_branchname_ar as appiim_branchname_ar',
            'omrm_opalmembershipregnumber',
            "(case  
            when fsm_feestype = 1 then 'Certification Fee' 
            when fsm_feestype = 2 then 'Staff Evaluation Fee'
            when fsm_feestype = 3 then 'Royalty Fee'
            when fsm_feestype = 4 then 'Learner Training Fee'
            when fsm_feestype = 5 then 'Learner Assessment Fee'
            when fsm_feestype = 6 then 'Staff Re-Evaluation Fee'
            end) as fsm_feestype",
            "(case  
                when feesub.fsm_applicationtype = 1 then 'Initial' 
                when feesub.fsm_applicationtype = 2 then 'Renewal'
                when feesub.fsm_applicationtype = 3 then 'Update' 
                when feesub.fsm_applicationtype = 4 then 'Refresher' 
                when feesub.fsm_applicationtype = 5 then 'Surveillance 1' 
                when feesub.fsm_applicationtype = 6 then 'Surveillance 2 by dafault 0' 
                end) as fsm_applicationtype", 
            '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
            "(case  
            when apid_invoicestatus = 1 then 'Pending' 
            when apid_invoicestatus = 2 then 'Paid - Verification Pending'
            when apid_invoicestatus = 3 then 'Approved' 
            when apid_invoicestatus = 4 then 'Declined' 
            end) as apid_invoicestatus",
            "(case  
            when apid_paymenttype = 1 then 'Online' 
            when apid_paymenttype = 2 then 'Offline' 
            end) as apid_paymenttype",
            "(case  
            when apid_paymentmode = 1 then 'Cheque' 
            when apid_paymentmode = 2 then 'Bank Transfer' 
            when apid_paymentmode = 3 then 'Cash' 
            end) as apid_paymentmode",
            // 'apid_transuniqueId',
            'apid_bankname',
            'apid_pymtproof',
            'apid_appdecby',
            'apid_appdecComments as appcomment',
            // 'apid_appdecComments',
            'ABS(apppdt_offlinerefno) as apppdt_offlinerefno',
            'ABS(apppdt_transuniqueId) as apppdt_transuniqueId',
            'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
            'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
            'DATE_FORMAT(apid_appdecon,"%d-%m-%Y") AS apdecdate',
            'DATEDIFF(now(), apid_raisedon) as agedate',
            'oum_firstname',
            'appdt_grademst_fk',
            ])
            ->leftJoin('appcoursedtlstmp_tbl apcourdtls','apcourdtls.appcoursedtlstmp_pk = apppytminvoicedtls_tbl.apid_appcoursedtlstmp_fk')
            ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apppytminvoicedtls_tbl.apid_applicationdtlstmp_fk')
            ->leftJoin('apppymtdtlstmp_tbl apppymt','apppymt.apppdt_applicationdtlstmp_fk = appdtlstmp.applicationdtlstmp_pk')
            ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdtlstmp.appdt_opalmemberregmst_fk')
            ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appiit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
            // ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appinstinfotmp_pk = apcourdtls.appcdt_appinstinfomain_fk')
            ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apppytminvoicedtls_tbl.apid_feesubscriptionmst_fk')
            ->leftJoin('opalusermst_tbl user','user.opalusermst_pk = apppytminvoicedtls_tbl.apid_appdecby')
            ->leftJoin('grademst_tbl grade','grade.grademst_pk = appdtlstmp.appdt_grademst_fk')
            ->leftJoin('projectmst_tbl project','project.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
            ->where(['=', 'apppytminvoicedtls_pk', $id])
            ->asArray()
            ->one();
        $model['apid_appdecComments'] = strip_tags($model['appcomment']);
        // echo'<pre>';print_r($model);die('test');
        $model['docUrl']= \api\components\Drive::generateUrl($model['apid_pymtproof'],$companyPk,$userPk);
        $model['fileName']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));
        $model['ext']= pathinfo($model['fileName'],PATHINFO_EXTENSION);
        $model['flePk']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));


        return $model;
          
  
    }

    
    public static function viewTechnicalIvms($id) {
        
        $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
            
        $model = ApppytminvoicedtlsTbl::find()
            ->select(['apppytminvoicedtls_pk','apid_invoiceno',
            'omrm_companyname_en','omrm_companyname_ar',
            'omrm_tpname_en','omrm_tpname_ar',
            'pm_projectname_en','pm_projectname_ar',
            'apid_noofstaffeval',
            'apid_raisedon',
            'apid_coursecertfee',
            'apid_vatamount',
            "(case  
            when appinsinfo.appiit_officetype = 1 then 'Main office' 
            when appinsinfo.appiit_officetype = 2 then 'Branch office'
            end) as appiim_officetype",
            'appiit_branchname_en as appiim_branchname_en','appiit_branchname_ar as appiim_branchname_ar',
            'omrm_opalmembershipregnumber',
            "(case  
            when fsm_feestype = 1 then 'Device Certification' 
            when fsm_feestype = 2 then 'Staff Evaluation Fee'
            when fsm_feestype = 3 then 'Royalty Fee'
            when fsm_feestype = 4 then 'Learner Training Fee'
            when fsm_feestype = 5 then 'Learner Assessment Fee'
            when fsm_feestype = 6 then 'Staff Re-Evaluation Fee'
            end) as fsm_feestype",
            "(case  
                when feesub.fsm_applicationtype = 1 then 'Initial' 
                when feesub.fsm_applicationtype = 2 then 'Renewal'
                when feesub.fsm_applicationtype = 3 then 'Update' 
                when feesub.fsm_applicationtype = 4 then 'Refresher' 
                when feesub.fsm_applicationtype = 5 then 'Surveillance 1' 
                when feesub.fsm_applicationtype = 6 then 'Surveillance 2 by dafault 0' 
                end) as fsm_applicationtype", 
            '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
            'apid_staffevalfee',
            "(case  
            when apid_invoicestatus = 1 then 'Pending' 
            when apid_invoicestatus = 2 then 'Paid - Verification Pending'
            when apid_invoicestatus = 3 then 'Approved' 
            when apid_invoicestatus = 4 then 'Declined' 
            end) as apid_invoicestatus",
            "(case  
            when apid_paymenttype = 1 then 'Online' 
            when apid_paymenttype = 2 then 'Offline' 
            end) as apid_paymenttype",
            "(case  
            when apid_paymentmode = 1 then 'Cheque' 
            when apid_paymentmode = 2 then 'Bank Transfer' 
            when apid_paymentmode = 3 then 'Cash' 
            end) as apid_paymentmode",
            // 'apid_transuniqueId',
            'apid_bankname',
            'apid_pymtproof',
            'apid_appdecby',
            'apid_appdecComments as appcomment',
            // 'apid_appdecComments',
            'ABS(apppdt_offlinerefno) as apppdt_offlinerefno',
            'ABS(apppdt_transuniqueId) as apppdt_transuniqueId',
            'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
            'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
            'DATE_FORMAT(apid_appdecon,"%d-%m-%Y") AS apdecdate',
            'DATEDIFF(now(), apid_raisedon) as agedate',
            'oum_firstname',
            'appdt_grademst_fk',
            'appdit_modelno as modelno'
            ])
            ->innerJoin('appdeviceinfotmp_tbl device','device.appdit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
            ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apid_opalmemberregmst_fk')
            ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apid_applicationdtlstmp_fk')
            ->leftJoin('apppymtdtlstmp_tbl apppymt','apppymt.apppdt_applicationdtlstmp_fk = appdtlstmp.applicationdtlstmp_pk')
            ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apid_feesubscriptionmst_fk')
            ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appiit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
            ->leftJoin('projectmst_tbl project','project.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
            ->leftJoin('opalusermst_tbl user','user.opalusermst_pk = apid_appdecby')
            ->leftJoin('grademst_tbl grade','grade.grademst_pk = appdtlstmp.appdt_grademst_fk')
            ->where(['=', 'apppytminvoicedtls_pk', $id])
            ->asArray()
            ->one();
        $model['apid_appdecComments'] = strip_tags($model['appcomment']);
        // echo'<pre>';print_r($model);die('test');
        $model['docUrl']= \api\components\Drive::generateUrl($model['apid_pymtproof'],$companyPk,$userPk);
        $model['fileName']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));
        $model['ext']= pathinfo($model['fileName'],PATHINFO_EXTENSION);
        $model['flePk']= \api\components\Drive::getFileName(\api\components\Security::encrypt($model['apid_pymtproof']));


        return $model;
          
  
    }
    public static function getTechnicalCenterCertiDtls($params) {
        // $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        // $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $searchData = [
            'invoiceno' => 'apid_invoiceno',
            'compannyname' => 'omrm_companyname_en', 
            'trainingprovider' => 'omrm_branch_en',
            'officetype' => 'appiim_officetype',
            'branchname' => 'appiim_branchname_en',
            'opalmember' => 'omrm_opalmembershipregnumber',
            'Feetype' => 'fsm_feestype',
            'invoiceamount' => 'total',
            'paymentstatus' => 'apid_invoicestatus',
            'paymenttype' => 'apid_paymenttype',
            'invoicedate' => 'invdate',
            'invoiceage' => 'agedate',
            'paymentdate' => 'pymtdate'
        ];
        $provider="";
            $model = ApppytminvoicedtlsTbl::find()
            ->select(['apppytminvoicedtls_pk','apid_invoiceno',
            'omrm_companyname_en','omrm_companyname_ar',
            'omrm_branch_en as omrm_tpname_en','omrm_branch_ar as omrm_tpname_ar',
            'pm_projectname_en','pm_projectname_ar',
            "(case  
            when appiit_officetype = 1 then 'Main office' 
            when appiit_officetype = 2 then 'Branch office'
            end) as appiim_officetype",
            'appiit_branchname_en as appiim_branchname_en','appiit_branchname_ar as appiim_branchname_ar',
            'omrm_opalmembershipregnumber',
            "(case  
            when fsm_feestype = 1 then 'Certification Fee' 
            when fsm_feestype = 2 then 'Staff Evaluation Fee'
            when fsm_feestype = 3 then 'Royalty Fee'
            when fsm_feestype = 4 then 'Learner Training Fee'
            when fsm_feestype = 5 then 'Learner Assessment Fee'
            when fsm_feestype = 6 then 'Staff Re-Evaluation Fee'
            end) as fsm_feestype",
            'apid_noofstaffeval',
            'apid_coursecertfee',
            'apid_vatamount',
            'apid_staffevalfee',
            '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
            "(case  
            when apid_invoicestatus = 1 then 'Pending' 
            when apid_invoicestatus = 2 then 'Paid - Verification Pending'
            when apid_invoicestatus = 3 then 'Approved' 
            when apid_invoicestatus = 4 then 'Declined' 
            end) as apid_invoicestatus",
            "(case  
            when apid_paymenttype = 1 then 'Online' 
            when apid_paymenttype = 2 then 'Offline' 
            end) as apid_paymenttype",
            'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
            'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
            'DATEDIFF(now(), apid_raisedon) as agedate',
            
            // "(case  
            // when apid_paymentmode = 1 then 'Cheque' 
            // when apid_paymentmode = 2 then 'Bank Transfer'
            // when apid_paymentmode = 2 then 'Cash' 
            // end) as apid_paymentmode",
            "(case  
            when feesub.fsm_applicationtype = 1 then 'Initial' 
            when feesub.fsm_applicationtype = 2 then 'Renewal'
            when feesub.fsm_applicationtype = 3 then 'Update' 
            when feesub.fsm_applicationtype = 4 then 'Refresher' 
            when feesub.fsm_applicationtype = 5 then 'Surveillance 1' 
            when feesub.fsm_applicationtype = 6 then 'Surveillance 2 by dafault 0' 
            end) as fsm_applicationtype", 
            'pm_projtype'
            ])
            ->leftJoin('appcoursedtlstmp_tbl apcourdtls','apcourdtls.appcoursedtlstmp_pk = apppytminvoicedtls_tbl.apid_appcoursedtlstmp_fk')
            // ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apcourdtls.appcdt_applicationdtlstmp_fk')
            ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apppytminvoicedtls_tbl.apid_applicationdtlstmp_fk')
            ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdtlstmp.appdt_opalmemberregmst_fk')
            ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appiit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
            ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apppytminvoicedtls_tbl.apid_feesubscriptionmst_fk')
            ->leftJoin('projectmst_tbl project','project.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
            ->where(['project.pm_projtype' => 2])
            ->andWhere(['IN', 'appdtlstmp.appdt_projectmst_fk', [4]]);
                
                if($params['searchkey'] != ''){
                        $searchkey = $params['searchkey'];  
                        $invoiceNo = $searchkey['invoice_no'];
                        $compannyName = $searchkey['company_name'];
                        $trainingProvider = $searchkey['training_provider'];
                        $officeType = $searchkey['officetype'];
                        $branchName = $searchkey['bran_name'];
                        $opalMember = $searchkey['opal_membership'];
                        $FeeType = $searchkey['Fee_type'];
                        $paymentStatus = $searchkey['pay_status'];
                        $paymenttype = $searchkey['pay_type'];
                        $invoicedate = $searchkey['invoice_date'];
                        $invoiceage = $searchkey['invoice_age'];
                        $paymentdate = $searchkey['payment_date'];
                        $noofstaff = $searchkey['noof_staff'];
                        $projectName = $searchkey['project_name'];

                                        
                        if($invoiceNo){
                            $model->andFilterWhere(['LIKE', 'apid_invoiceno', $invoiceNo]);
                        }

                        if($compannyName){
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_en', $compannyName]);
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_ar', $compannyName]);
                        }

                        if($projectName){
                            $model->andFilterWhere(['LIKE', 'pm_projectname_en', $projectName]);
                            $model->andFilterWhere(['LIKE', 'pm_projectname_ar', $projectName]);
                        }

                        if($trainingProvider){
                            $model->andFilterWhere(['LIKE', 'omrm_branch_en', $trainingProvider]);
                            $model->andFilterWhere(['LIKE', 'omrm_branch_ar', $trainingProvider]);
                        }

                        if($officeType){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['IN',  'appiit_officetype', $officeType]);
                        }

                        if($noofstaff){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['IN',  'apid_noofstaffeval', $noofstaff]);
                        }

                        if($branchName){
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_en', $branchName]);
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_ar', $branchName]);
                        }

                        if($opalMember){
                            $model->andFilterWhere(['LIKE', 'omrm_opalmembershipregnumber', $opalMember]);
                        }

                        if($FeeType){
                            $model->andFilterWhere(['IN', 'fsm_applicationtype', $FeeType]);
                        }

                        if($paymenttype){
                            $model->andFilterWhere(['IN', 'apid_paymenttype', $paymenttype]);
                        }

                        if($paymentStatus){
                            $model->andFilterWhere(['IN', 'apid_invoicestatus', $paymentStatus]);
                        }
                        // echo $model->createCommand()->getRawSql(); die;

                        if($invoicedate['startDate'] && $invoicedate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_raisedon)', date('Y-m-d',strtotime($invoicedate['startDate'])), date('Y-m-d',strtotime($invoicedate['endDate']))]);
                        }

                        // if($invoiceage){
                        //     $model->andFilterWhere(['IN', 'agedate', $invoiceage]);
                        // }

                        if($paymentdate['startDate'] && $paymentdate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_dateofpymt)', date('Y-m-d',strtotime($paymentdate['startDate'])), date('Y-m-d',strtotime($paymentdate['endDate']))]);
                        }
                }
            $sort = "apppytminvoicedtls_pk DESC";
            if(isset($searchData[$params['sort']])){
                $sort_column = $searchData[$params['sort']];
                $order_by = ($params['order']=='asc')? 'asc': 'desc';
                $sort = "$sort_column $order_by , $sort";
            }
            $model->orderBy("$sort");
            
            // echo $model->createCommand()->getRawSql(); die;

             $pageSize = (!empty($params['size']) && $params['size'] != 'undefined') ? $params['size'] : 10 ;
             if(isset($params['excel']))
             {
                $response['data'] = $model->asArray()->all();
                return $response;
             }
            //  echo $params['page']*$pageSize,$model->count(); die;
             $provider = new \yii\data\ActiveDataProvider([
                 'query' => $model->asArray(),
                 'pagination' => [
                     'pageSize' => $pageSize,
                     'page' => $params['page']],
             ]);
 
            $data = $provider->getModels();
            // print_r($data); die;
            
             $response = array();
             $response['data'] = $data;
             $response['totalcount'] = $provider->getTotalCount();
             $response['size'] = $pageSize;
             return $response;
    }

    public static function getTechnicalIvms($params) {
        // $companyPk = ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        // $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $searchData = [
            'invoiceno' => 'apid_invoiceno',
            'compannyname' => 'omrm_companyname_en', 
            'trainingprovider' => 'omrm_tpname_en',
            'officetype' => 'appiim_officetype',
            'branchname' => 'appiim_branchname_en',
            'opalmember' => 'omrm_opalmembershipregnumber',
            'Feetype' => 'fsm_feestype',
            'invoiceamount' => 'total',
            'paymentstatus' => 'apid_invoicestatus',
            'paymenttype' => 'apid_paymenttype',
            'invoicedate' => 'invdate',
            'invoiceage' => 'agedate',
            'paymentdate' => 'pymtdate',
            'modelno' => 'appdit_modelno'
        ];
        $provider="";
            $model = ApppytminvoicedtlsTbl::find()
                ->select(['apppytminvoicedtls_pk','apid_invoiceno',
                'omrm_companyname_en','omrm_companyname_ar',
                'omrm_tpname_en','omrm_tpname_ar',
                'pm_projectname_en','pm_projectname_ar',
                "(case  
                when appiit_officetype = 1 then 'Main office' 
                when appiit_officetype = 2 then 'Branch office'
                end) as appiim_officetype",
                'omrm_branch_en','omrm_branch_ar',
                'appiit_branchname_en as appiim_branchname_en','appiit_branchname_ar as appiim_branchname_ar',
                'omrm_opalmembershipregnumber',
                "(case  
                when fsm_feestype = 1 then 'Device Certification' 
                when fsm_feestype = 2 then 'Staff Evaluation Fee'
                when fsm_feestype = 3 then 'Royalty Fee'
                when fsm_feestype = 4 then 'Learner Training Fee'
                when fsm_feestype = 5 then 'Learner Assessment Fee'
                when fsm_feestype = 6 then 'Staff Re-Evaluation Fee'
                end) as fsm_feestype",
                'apid_noofstaffeval',
                'apid_coursecertfee',
                'apid_vatamount',
                'apid_staffevalfee',
                '(COALESCE(apid_coursecertfee, 0) + COALESCE(apid_vatamount, 0) + COALESCE(apid_staffevalfee, 0)) AS total',
                "(case  
                when apid_invoicestatus = 1 then 'Pending' 
                when apid_invoicestatus = 2 then 'Paid - Verification Pending'
                when apid_invoicestatus = 3 then 'Approved' 
                when apid_invoicestatus = 4 then 'Declined' 
                end) as apid_invoicestatus",
                "(case  
                when apid_paymenttype = 1 then 'Online' 
                when apid_paymenttype = 2 then 'Offline' 
                end) as apid_paymenttype",
                'DATE_FORMAT(apid_raisedon,"%d-%m-%Y") AS invdate',
                'DATE_FORMAT(apid_dateofpymt,"%d-%m-%Y") AS pymtdate',
                'DATEDIFF(now(), apid_raisedon) as agedate',
                
                // "(case  
                // when apid_paymentmode = 1 then 'Cheque' 
                // when apid_paymentmode = 2 then 'Bank Transfer'
                // when apid_paymentmode = 2 then 'Cash' 
                // end) as apid_paymentmode",
                "(case  
                when feesub.fsm_applicationtype = 1 then 'Initial' 
                when feesub.fsm_applicationtype = 2 then 'Renewal'
                when feesub.fsm_applicationtype = 3 then 'Update' 
                when feesub.fsm_applicationtype = 4 then 'Refresher' 
                when feesub.fsm_applicationtype = 5 then 'Surveillance 1' 
                when feesub.fsm_applicationtype = 6 then 'Surveillance 2 by dafault 0' 
                end) as fsm_applicationtype", 
                'pm_projtype',
                'appdit_modelno as modelno'
                ])
                ->innerJoin('appdeviceinfotmp_tbl device','device.appdit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
                ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apid_opalmemberregmst_fk')
                ->leftJoin('applicationdtlstmp_tbl appdtlstmp','appdtlstmp.applicationdtlstmp_pk = apid_applicationdtlstmp_fk')
                ->leftJoin('feesubscriptionmst_tbl feesub','feesub.feesubscriptionmst_pk = apid_feesubscriptionmst_fk')
                ->leftJoin('appinstinfotmp_tbl appinsinfo','appinsinfo.appiit_applicationdtlstmp_fk = apid_applicationdtlstmp_fk')
                ->leftJoin('projectmst_tbl project','project.projectmst_pk = appdtlstmp.appdt_projectmst_fk')
                ->where(['project.pm_projtype' => 2])
                ->andWhere(['IN', 'appdtlstmp.appdt_projectmst_fk', [5]])
                ->groupBy('apppytminvoicedtls_pk')
                ->orderBy(['apppytminvoicedtls_pk' => SORT_DESC]);
                
                if($params['searchkey'] != ''){
                        $searchkey = $params['searchkey'];  
                        
                        $invoiceNo = $searchkey['invoice_no'];
                        $compannyName = $searchkey['company_name'];
                        $trainingProvider = $searchkey['training_provider'];
                        $modelno = $searchkey['modelno'];
                        $officeType = $searchkey['officetype'];
                        $branchName = $searchkey['bran_name'];
                        $opalMember = $searchkey['opal_membership'];
                        $FeeType = $searchkey['Fee_type'];
                        $paymentStatus = $searchkey['pay_status'];
                        $paymenttype = $searchkey['pay_type'];
                        $invoicedate = $searchkey['invoice_date'];
                        $invoiceage = $searchkey['invoice_age'];
                        $paymentdate = $searchkey['payment_date'];
                        $noofstaff = $searchkey['noof_staff'];
                        $projectName = $searchkey['project_name'];

                                        
                        if($invoiceNo){
                            $model->andFilterWhere(['LIKE', 'apid_invoiceno', $invoiceNo]);
                        }

                        if($compannyName){
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_en', $compannyName]);
                            $model->andFilterWhere(['LIKE', 'omrm_companyname_ar', $compannyName]);
                        }

                        if($projectName){
                            $model->andFilterWhere(['LIKE', 'pm_projectname_en', $projectName]);
                            $model->andFilterWhere(['LIKE', 'pm_projectname_ar', $projectName]);
                        }

                        if($trainingProvider){
                            $model->andFilterWhere(['LIKE', 'omrm_branch_en', $trainingProvider]);
                            $model->andFilterWhere(['LIKE', 'omrm_branch_ar', $trainingProvider]);
                        }

                        if($modelno){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['LIKE', 'appdit_modelno', $modelno]);
                        }
                        if($officeType){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['IN',  'appiit_officetype', $officeType]);
                        }

                        if($noofstaff){
                            // print_r($officeType); die;
                            $model->andFilterWhere(['IN',  'apid_noofstaffeval', $noofstaff]);
                        }

                        if($branchName){
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_en', $branchName]);
                            $model->andFilterWhere(['LIKE', 'appiit_branchname_ar', $branchName]);
                        }

                        if($opalMember){
                            $model->andFilterWhere(['LIKE', 'omrm_opalmembershipregnumber', $opalMember]);
                        }

                        if($FeeType){
                            $model->andFilterWhere(['IN', 'fsm_applicationtype', $FeeType]);
                        }

                        if($paymenttype){
                            $model->andFilterWhere(['IN', 'apid_paymenttype', $paymenttype]);
                        }

                        if($paymentStatus){
                            $model->andFilterWhere(['IN', 'apid_invoicestatus', $paymentStatus]);
                        }
                        // echo $model->createCommand()->getRawSql(); die;

                        if($invoicedate['startDate'] && $invoicedate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_raisedon)', date('Y-m-d',strtotime($invoicedate['startDate'])), date('Y-m-d',strtotime($invoicedate['endDate']))]);
                        }

                        // if($invoiceage){
                        //     $model->andFilterWhere(['IN', 'agedate', $invoiceage]);
                        // }

                        if($paymentdate['startDate'] && $paymentdate['endDate']){
                            $model->andFilterWhere(['between', 'date(apid_dateofpymt)', date('Y-m-d',strtotime($paymentdate['startDate'])), date('Y-m-d',strtotime($paymentdate['endDate']))]);
                        }
                }
                        // echo $model->createCommand()->getRawSql(); die;
                
            if(isset($searchData[$params['sort']])){
                $sort_column = $searchData[$params['sort']];
                $order_by = ($params['order']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }
             
             $model->asArray();
             $pageSize = (!empty($params['size']) && $params['size'] != 'undefined') ? $params['size'] : 10 ;
             $p = $params['page'];
             if($params['page']*$pageSize > $model->count()){
                $p = round($model->count()/$pageSize);
             }
             if(isset($params['excel']))
             {
                $response['data'] = $model->asArray()->all();
                return $response;
             }
            //  echo $params['page']*$pageSize,$model->count(); die;
             $provider = new \yii\data\ActiveDataProvider([
                 'query' => $model,
                 'pagination' => [
                     'pageSize' => $pageSize,
                     'page' => $p],
             ]);
 
            $data = $provider->getModels();
            
             $response = array();
             $response['data'] = $data;
             $response['totalcount'] = $provider->getTotalCount();
             $response['size'] = $pageSize;
             return $response;
    }
}
