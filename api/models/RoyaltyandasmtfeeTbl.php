<?php

namespace app\models;

use app\models\IvmsvehicleregdtlsTbl;
use Yii;
use app\models\BatchmgmtdtlsTbl;
use app\models\LearnerreghrddtlsTbl;

/**
 * This is the model class for table "royaltyandasmtfee_tbl".
 *
 * @property int $royaltyandasmtfee_pk
 * @property int $rasf_projectmst_fk Reference to projectmst_pk
 * @property int $rasf_appcoursedtlsmain_fk Reference to appcoursedtlsmain_pk
 * @property int $rasf_feesubscriptionmst_fk Reference to feesubscriptionmst_pk
 * @property int $rasf_feetype 1-Royalty Fee,2- Assessment Fee
 * @property string $rasf_invoiceno
 * @property string $rasf_raisedon
 * @property int $rasf_totrecord If it is Technical eveluation then total learner, if it is RAS then it is total vehicle count
 * @property string $rasf_invoicedamount without VAT
 * @property string $rasf_vatamount
 * @property string $rasf_vatpercent
 * @property string $rasf_invoiceexpiry
 * @property int $rasf_paymenttype 1-Online, 2-Offline
 * @property int $rasf_paymentmode If rasf_paymenttype = then 1-Cheque, 2-Bank Transfer, 3-Cash
 * @property string $rasf_transuniqueId
 * @property string $rasf_offlinerefno
 * @property string $rasf_bankname If rasf_paymenttype = then rasf_bankname is not null
 * @property string $rasf_dateofpymt
 * @property string $rasf_Comments
 * @property string $rasf_payURL
 * @property int $rasf_pymtproof Payment proof file will be stored here. Reference to memcompfiledtls_tbl
 * @property string $rasf_ressenton Response sent back to requestor date
 * @property int $rasf_opalusermst_fk Payment Requested by
 * @property string $rasf_reqfrmurl Request from URL
 * @property string $rasf_bankrturl Return URL from Bank
 * @property string $rasf_paymenttoken
 * @property string $rasf_cardno
 * @property string $rasf_cardexpiry
 * @property int $rasf_pymtstatus 1-Pending,2-Paid Confirmation Pending,3-Overdue,4-Received,5-Declined default 1
 * @property int $rasf_invoicestatus 1-Active,2-Inactive default 1
 * @property int $rasf_paidby Reference to appinstinfomain_pk, from which centre the payment was processed
 * @property int $rasf_paidto Reference to opalmemberreg_pk, to which centre the payment was sent to
 * @property string $rasf_createdon
 * @property int $rasf_createdby Reference to opalusermst_tbl
 * @property string $rasf_appdecon
 * @property int $rasf_appdecby
 * @property string $rasf_appdecComments
 *
 * @property LeanerandvehicledtlsTbl[] $leanerandvehicledtlsTbls
 * @property AppcoursedtlsmainTbl $rasfAppcoursedtlsmainFk
 * @property FeesubscriptionmstTbl $rasfFeesubscriptionmstFk
 * @property ProjectmstTbl $rasfProjectmstFk
 */
class RoyaltyandasmtfeeTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'royaltyandasmtfee_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rasf_projectmst_fk', 'rasf_invoiceno', 'rasf_raisedon', 'rasf_totrecord', 'rasf_invoicedamount', 'rasf_paidby', 'rasf_createdon', 'rasf_createdby'], 'required'],
            [['rasf_projectmst_fk', 'rasf_feetype', 'rasf_totrecord', 'rasf_paymenttype', 'rasf_paymentmode', 'rasf_pymtproof', 'rasf_opalusermst_fk', 'rasf_pymtstatus', 'rasf_invoicestatus', 'rasf_paidby', 'rasf_paidto', 'rasf_createdby', 'rasf_appdecby'], 'integer'],
            [['rasf_invoiceno', 'rasf_vatpercent', 'rasf_Comments', 'rasf_payURL', 'rasf_reqfrmurl', 'rasf_bankrturl', 'rasf_appdecComments'], 'string'],
            [['rasf_raisedon', 'rasf_invoiceexpiry', 'rasf_dateofpymt', 'rasf_ressenton', 'rasf_createdon', 'rasf_appdecon','rasf_updatedon','rasf_updatedby','rasf_feesubscriptionmst_fk','rasf_appcoursedtlsmain_fk'], 'safe'],
            [['rasf_invoicedamount', 'rasf_vatamount'], 'number'],
            [['rasf_transuniqueId'], 'string', 'max' => 80],
            [['rasf_offlinerefno'], 'string', 'max' => 50],
            [['rasf_bankname'], 'string', 'max' => 500],
            [['rasf_paymenttoken'], 'string', 'max' => 255],
            [['rasf_cardno', 'rasf_cardexpiry'], 'string', 'max' => 45],
            [['rasf_feesubscriptionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeesubscriptionmstTbl::className(), 'targetAttribute' => ['rasf_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']],
            [['rasf_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['rasf_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'royaltyandasmtfee_pk' => 'Royaltyandasmtfee Pk',
            'rasf_projectmst_fk' => 'Rasf Projectmst Fk',
            'rasf_appcoursedtlsmain_fk' => 'Rasf Appcoursedtlsmain Fk',
            'rasf_feesubscriptionmst_fk' => 'Rasf Feesubscriptionmst Fk',
            'rasf_feetype' => 'Rasf Feetype',
            'rasf_invoiceno' => 'Rasf Invoiceno',
            'rasf_raisedon' => 'Rasf Raisedon',
            'rasf_totrecord' => 'Rasf Totrecord',
            'rasf_invoicedamount' => 'Rasf Invoicedamount',
            'rasf_vatamount' => 'Rasf Vatamount',
            'rasf_vatpercent' => 'Rasf Vatpercent',
            'rasf_invoiceexpiry' => 'Rasf Invoiceexpiry',
            'rasf_paymenttype' => 'Rasf Paymenttype',
            'rasf_paymentmode' => 'Rasf Paymentmode',
            'rasf_transuniqueId' => 'Rasf Transunique ID',
            'rasf_offlinerefno' => 'Rasf Offlinerefno',
            'rasf_bankname' => 'Rasf Bankname',
            'rasf_dateofpymt' => 'Rasf Dateofpymt',
            'rasf_Comments' => 'Rasf  Comments',
            'rasf_payURL' => 'Rasf Pay Url',
            'rasf_pymtproof' => 'Rasf Pymtproof',
            'rasf_ressenton' => 'Rasf Ressenton',
            'rasf_opalusermst_fk' => 'Rasf Opalusermst Fk',
            'rasf_reqfrmurl' => 'Rasf Reqfrmurl',
            'rasf_bankrturl' => 'Rasf Bankrturl',
            'rasf_paymenttoken' => 'Rasf Paymenttoken',
            'rasf_cardno' => 'Rasf Cardno',
            'rasf_cardexpiry' => 'Rasf Cardexpiry',
            'rasf_pymtstatus' => 'Rasf Pymtstatus',
            'rasf_invoicestatus' => 'Rasf Invoicestatus',
            'rasf_paidby' => 'Rasf Paidby',
            'rasf_paidto' => 'Rasf Paidto',
            'rasf_createdon' => 'Rasf Createdon',
            'rasf_createdby' => 'Rasf Createdby',
            'rasf_appdecon' => 'Rasf Appdecon',
            'rasf_appdecby' => 'Rasf Appdecby',
            'rasf_appdecComments' => 'Rasf Appdec Comments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeanerandvehicledtlsTbls()
    {
        return $this->hasMany(LeanerandvehicledtlsTbl::className(), ['lavd_royaltyandasmtfee_fk' => 'royaltyandasmtfee_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfAppcoursedtlsmainFk()
    {
        return $this->hasOne(AppcoursedtlsmainTbl::className(), ['AppCourseDtlsMain_PK' => 'rasf_appcoursedtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfFeesubscriptionmstFk()
    {
        return $this->hasOne(FeesubscriptionmstTbl::className(), ['feesubscriptionmst_pk' => 'rasf_feesubscriptionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasfProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'rasf_projectmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RoyaltyandasmtfeeTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RoyaltyandasmtfeeTblQuery(get_called_class());
    }

    public static function getRoyaltyListingQuery($params){

        $allowMonthCount = Yii::$app->params['month_count_invoice']??1;
    
        // $params['searchkey'] =[];
        // $params['searchkey']['invoice_month'] ='2023-06';
        $prev =false;
        $roy_pk = $params['roy_pk'];
        $where = "";
        $prevWhere = "";
        
        if($roy_pk){
            $where .="AND royaltyandasmtfee_pk = $roy_pk";
            $prevWhere .= "AND rasfh_royaltyandasmtfee_fk = $roy_pk";
        }
        
        if(!empty($params['searchkey'])){
            $data = $params['searchkey'];

            if($data['invoice_no']){
                $invoice_no = $data['invoice_no'];
                $where .="AND rasf_invoiceno LIKE '%$invoice_no%'";
                $prevWhere .= "AND rasfh_invoiceno LIKE '%$invoice_no%'";
            }

            if($data['company_name']){
                $company_name  = $data['company_name'];
                $where .="AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
                $prevWhere .= "AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
            }

            if($data['trainingprovider']){
                $trainingprovider  = $data['trainingprovider'];
                $where .="AND (omrm_tpname_en LIKE '%$trainingprovider%' OR omrm_tpname_ar LIKE '%$trainingprovider%')";
                $prevWhere .= "AND (omrm_tpname_en LIKE '%$trainingprovider%' OR omrm_tpname_ar LIKE '%$trainingprovider%')";
            }

            if($data['coursetitle']){
                $coursetitle  = $data['coursetitle'];
                $where .="AND (scm_coursename_en LIKE '%$coursetitle%' OR scm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_en LIKE '%$coursetitle%')";
                $prevWhere .= "AND (scm_coursename_en LIKE '%$coursetitle%' OR scm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_en LIKE '%$coursetitle%')";
            }

            if($data['coursecate']){
                $coursecate  = $data['coursecate'];
                $where .="AND (courcatofr.ccm_catname_ar LIKE '%$coursecate%' OR courcatofr.ccm_catname_en LIKE '%$coursecate%' OR courcatstd.ccm_catname_ar LIKE '%$coursecate%' OR courcatstd.ccm_catname_en LIKE '%$coursecate%')";
                $prevWhere .= "AND (courcatofr.ccm_catname_ar LIKE '%$coursecate%' OR courcatofr.ccm_catname_en LIKE '%$coursecate%' OR courcatstd.ccm_catname_ar LIKE '%$coursecate%' OR courcatstd.ccm_catname_en LIKE '%$coursecate%')";
            }
            
            if($data['officetype']){
                $officetype  = implode(',',$data['officetype']);
                $where .="AND appinsinfo.appiim_officetype IN ($officetype)";
                $prevWhere .= "AND appinsinfo.appiim_officetype IN ($officetype)";
            }
            
            if($data['branchname']){
                $branchname  = $data['branchname'];
                $where .="AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
                $prevWhere .= "AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
            }
            if($data['opalmember']){
                $opalmember  = $data['opalmember'];
                $where .="AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
                $prevWhere .= "AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
            }
            
            if($data['totallearner']){
                $totallearner  = $data['totallearner'];
                $where .="AND irm_intlrecogname_en LIKE '%$totallearner%'";
                $prevWhere .= "AND irm_intlrecogname_en LIKE '%$totallearner%'";
            }

            if($data['invoiceamount']){
                $invoiceamount  = $data['invoiceamount'];
                $where .="AND invoiceamount LIKE '%$invoiceamount%'";
                $prevWhere .= "AND invoiceamount LIKE '%$invoiceamount%'";
            }

            if($data['site_locate']){
                $site_locate  = $data['site_locate'];

                if(strpos($site_locate, ',') !== false){
                    $site = explode(',',$data['site_locate']);
                    $state =$site[0];
                    $where .="AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    $prevWhere .= "AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =ltrim($site[1]);
                        $where .="AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                        $prevWhere .= "AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                    }
                }else{
                    $where .="AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                    $prevWhere .= "AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                }
            }

            if($data['paymentstatus']){
                $paymentstatus  = implode(',',$data['paymentstatus']);
                $where .="AND rasf_pymtstatus IN ($paymentstatus)";
                $prevWhere .= "AND rasfh_pymtstatus IN ($paymentstatus)";
            }
            
            if($data['invoice_month']){
                $month_start_date = $data['invoice_month']['start_date'];
                $month_end_date  = $data['invoice_month']['end_date'];
               
                $date=date_format(date_create($month_start_date),'Y-m');
                $date1=date_format(date_create($month_end_date),'Y-m');


                $prev = $date != date('Y-m') || $date1 != date('Y-m')? true:false ;
                // $month_end_date = date('Y-m-d', strtotime($month_end_date. ' + 1 days'));
                $month_start_date = date('Y-m-d', strtotime($date.'-01'. ' - 1 days'));
                $where .="AND rasf_raisedon between '$month_start_date' and '$month_end_date'";
                $prevWhere .= "AND rasfh_raisedon between '$month_start_date' and '$month_end_date'";
            }

            if($data['invoiceage']){
                $invoiceage  = $data['invoiceage'];
                $where .="AND invoiceage LIKE '%$invoiceage%'";
                $prevWhere .= "AND invoiceage LIKE '%$invoiceage%'";
                
            }

            if($data['invoicedate']){
                $inv_end_date  = $data['invoicedate']['end_date'];
                $inv_start_date = $data['invoicedate']['start_date'];
                $inv_end_date = date('Y-m-d', strtotime($inv_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$inv_start_date' and '$inv_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$inv_start_date' and '$inv_end_date'";
            }

            if($data['paymentdate']){
                $pay_end_date  = $data['paymentdate']['end_date'];
                $pay_start_date = $data['paymentdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_appdecon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_appdecon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['genratedon']){
                $pay_end_date  = $data['genratedon']['end_date'];
                $pay_start_date = $data['genratedon']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdate']){
                $pay_end_date  = $data['lastupdate']['end_date'];
                $pay_start_date = $data['lastupdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_updatedon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_updatedon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdateby']){
                $lastupdateby  = $data['lastupdateby'];
                $where .="AND upby.oum_firstname LIKE '%$lastupdateby%'";
                $prevWhere .= "AND upby.oum_firstname LIKE '%$lastupdateby%'";
            }

            if($data['genratedby']){
                $genratedby  = $data['genratedby'];
                $where .="AND genby.oum_firstname LIKE '%$genratedby%'";
                $prevWhere .= "AND genby.oum_firstname LIKE '%$genratedby%'";
            }
            
        }

        $fiterArray = [
            'company_name' => 'omrm_companyname_en',
            'branchname' => 'appiim_branchname_en',
            'coursetitle'=>'scm_coursename_en',
            'trainingprovider'=>'omrm_tpname_en',
            'coursecate' => 'courcatstd.ccm_catname_en',
            'invoice_month' => 'invoicemonth',
            'invoiceno' => 'roy_pk',
            'invoiceage' => 'invoiceage',
            'invoiceamount' => 'invoiceamount',
            'invoicedate' => 'invoicedate',
            'officetype' => 'officetype',
            'opalmember' => 'opalmember',
            'paymentdate' => 'paymentdate',
            'paymentstatus' => 'paymentstatus',
            'locate' => 'state_en',
            'totallearner' => 'totallearner',
            'lastupdateby' => 'upby.oum_firstname',
            'genratedon' => 'rasf_createdon',
            'genratedby' => 'genby.oum_firstname',
            'lastupdate' => 'rasf_updatedon',
        ];

        $sort="ORDER BY roy_pk desc";
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'asc': 'desc';
            $sort = "ORDER BY $sort_column $order_by";
        }
        $query ="SELECT
            royaltyandasmtfee_pk as roy_pk,
            rasf_invoiceno as invoiceno,
            rasf_pymtstatus as paymentstatus,
            rasf_totrecord as totallearner,
            rasf_invoicedamount,
            rasf_vatamount,
            rasf_invoiceexpiry,
            rasf_createdon,
            rasf_dateofpymt,
            rasf_appcoursedtlsmain_fk,
            rasf_feetype,
            rasf_paidby,
            rasf_projectmst_fk,
            rasf_appdecon,
            DATE_FORMAT(rasf_updatedon,'%d-%m-%Y') as lastupdate,
            upby.oum_firstname as lastupdateby,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as genratedon,
            genby.oum_firstname as genratedby,
            DATE_FORMAT(rasf_raisedon,'%M %Y') as invoicemonth,
            (COALESCE(rasf_invoicedamount, 0) + COALESCE(rasf_vatamount, 0)) AS invoiceamount,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as invoicedate,
            DATE_FORMAT(rasf_appdecon,'%d-%m-%Y') as paymentdate,
            (CASE WHEN rasf_pymtstatus != 2 AND rasf_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasf_createdon) ELSE '0' END) as invoiceage,
            apcourdtlsTmp.appcoursedtlstmp_pk,
            appcdt_standardcoursemst_fk,
            opalmemberregmst_pk,
            omrm_opalmembershipregnumber,scm_coursename_en,scm_coursename_ar,
            appocm_coursename_en,appocm_coursename_ar,
            (CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_ar  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_ar ELSE '-' END) as subcatar,
            (CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_en  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_en ELSE '-' END) as subcaten,
            omrm_opalmembershipregnumber as opalmember,
            appcdt_appoffercoursemain_fk,
            omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
            omrm_tpname_en as trainingprovider_en,omrm_tpname_ar as trainingprovider_ar,
            appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
            (CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
            osm_statename_en as state_en,osm_statename_ar as state_ar,
            ocim_cityname_en as city_en,ocim_cityname_ar as city_ar
        FROM
            royaltyandasmtfee_tbl
            LEFT JOIN appcoursedtlsmain_tbl apcourdtls ON apcourdtls.AppCourseDtlsMain_PK = rasf_appcoursedtlsmain_fk
            LEFT JOIN appcoursedtlstmp_tbl apcourdtlsTmp ON apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK
            LEFT JOIN standardcoursemst_tbl stdcour ON stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk
            LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK
            LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasf_paidby
            LEFT JOIN appoffercoursemain_tbl appoffer ON appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk
            LEFT JOIN coursecategorymst_tbl courcatstd ON courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk
            LEFT JOIN coursecategorymst_tbl courcatofr ON courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk
            LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk
            LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk
            LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasf_updatedby
            LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasf_createdby
        WHERE
        rasf_projectmst_fk IN (2,3) AND rasf_invoicestatus = 1 AND rasf_feetype = 1 $where";
        
        if($prev){
            $query .= "
            UNION
            SELECT
                rasfh_royaltyandasmtfee_fk as roy_pk,
                rasfh_invoiceno as invoiceno,
                rasfh_pymtstatus as paymentstatus,
                rasfh_totrecord as totallearner,
                rasfh_invoicedamount,
                rasfh_vatamount,
                rasfh_invoiceexpiry,
                rasfh_createdon,
                rasfh_dateofpymt,
                rasfh_appcoursedtlsmain_fk as course,
                rasfh_feetype,
                rasfh_paidby,
                rasfh_projectmst_fk,
                rasfh_appdecon,
                DATE_FORMAT(rasfh_updatedon,'%d-%m-%Y') as lastupdate,
                upby.oum_firstname as lastupdateby,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as genratedon,
                genby.oum_firstname as genratedby,
                DATE_FORMAT(rasfh_raisedon,'%M %Y') as invoicemonth,
                (COALESCE(rasfh_invoicedamount, 0) + COALESCE(rasfh_vatamount, 0)) AS invoiceamount,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as invoicedate,
                DATE_FORMAT(rasfh_appdecon,'%d-%m-%Y') as paymentdate,
                (CASE WHEN rasfh_pymtstatus != 2 AND rasfh_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasfh_createdon) ELSE '0' END) as invoiceage,
                apcourdtlsTmp.appcoursedtlstmp_pk,
                appcdt_standardcoursemst_fk,
                opalmemberregmst_pk,
                omrm_opalmembershipregnumber,scm_coursename_en,scm_coursename_ar,
                appocm_coursename_en,appocm_coursename_ar,
                (CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_ar  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_ar ELSE '-' END) as subcatar,
                (CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_en  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_en ELSE '-' END) as subcaten,
                omrm_opalmembershipregnumber as opalmember,
                appcdt_appoffercoursemain_fk,
                omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
                omrm_tpname_en as trainingprovider_en,omrm_tpname_ar as trainingprovider_ar,
                appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
                (CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
                osm_statename_en as state_en,osm_statename_ar as state_ar,
                ocim_cityname_en as city_en,ocim_cityname_ar as city_ar
            FROM
                royaltyandasmtfeehsty_tbl
                LEFT JOIN appcoursedtlsmain_tbl apcourdtls ON apcourdtls.AppCourseDtlsMain_PK = rasfh_appcoursedtlsmain_fk
                LEFT JOIN appcoursedtlstmp_tbl apcourdtlsTmp ON apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK
                LEFT JOIN standardcoursemst_tbl stdcour ON stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk
                LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK
                LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasfh_paidby
                LEFT JOIN appoffercoursemain_tbl appoffer ON appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk
                LEFT JOIN coursecategorymst_tbl courcatstd ON courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk
                LEFT JOIN coursecategorymst_tbl courcatofr ON courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk
                LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk
                LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk
                LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasfh_updatedby
                LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasfh_createdby
            WHERE
                rasfh_projectmst_fk IN (2,3) AND rasfh_invoicestatus = 1 AND rasfh_feetype = 1 $prevWhere";
        }
        // $model = RoyaltyandasmtfeeTbl::findBySql($query);
        $model = RoyaltyandasmtfeeTbl::find()->from(['alias' => "($query $sort)"]);
        if(isset($params['excel']))
        {
            $response['data'] = $model->asArray()->all();
            return $response;
        }
        // echo $model->createCommand()->getRawSql(); die('');
        $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;

        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $page,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        $response['data'] = $data;
        $response['month_count'] = $allowMonthCount;
        // $response = ['status' => true,'data' => $response,'msg' => 'Success'];
        
        return $response;
    }

    public static function royaltyBatchLearnerDetails($params)
    {
        $model = BatchmgmtdtlsTbl::find()->alias('bgt')
        ->select([
            'le.Irhd_projectmst_fk as rasf_projectmst_fk',
            'bgt.bmd_appcoursedtlsmain_fk as rasf_appcoursedtlsmain_fk',
            'feesubscriptionmst_pk as rasf_feesubscriptionmst_fk',
            'bmah_assessmentdate',
            'count(distinct learnerreghrddtls_pk) as rasf_totrecord',
            '(fsm_fee * count(distinct learnerreghrddtls_pk)) as rasf_invoicedamount',
            'group_concat(distinct le.learnerreghrddtls_pk order by le.learnerreghrddtls_pk SEPARATOR ", ") as lavd_learnerreghrddtls_fk',
            'bgt.bmd_appinstinfomain_fk as rasf_paidby',
            'omrm_opalmembershipregnumber as opalMember'
        ])
        ->leftJoin('learnerreghrddtls_tbl le','le.lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk')
        ->leftJoin('batchmgmtasmtdtls_tbl','bmad_learnerreghrddtls_fk = learnerreghrddtls_pk')
        ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk
        AND bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
        ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = bmah_assessor')
        ->leftJoin('opalmemberregmst_tbl f', 'f.opalmemberregmst_pk = c.oum_opalmemberregmst_fk')
        ->leftJoin('standardcoursedtls_tbl', 'standardcoursedtls_pk = bgt.bmd_standardcoursedtls_fk')
        ->leftJoin('feesubscriptionmst_tbl','le.Irhd_projectmst_fk AND fsm_feestype = 3 AND fsm_status = 1 and fsm_standardcoursemst_fk = scd_standardcoursemst_fk');

        $model->andwhere(['LIKE', 'DATE_FORMAT(bmah_assessmentdate,"%Y-%m")', $params['month']]);
        $model->andwhere(['!=','bmd_status', 7]);
        $model->andwhere(['!=','lrhd_status', 13]);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '1-%']);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '4-%']);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '5-%']);
        $model->groupBy(['bmd_appcoursedtlsmain_fk','bmd_appinstinfomain_fk']);

        if(isset($params['rasf_appcoursedtlsmain_fk'])){
            $model->andwhere(['bgt.bmd_appcoursedtlsmain_fk'=> $params['rasf_appcoursedtlsmain_fk']]);
            // $model->andwhere(['bmd_appinstinfomain_fk'=> $params['rasf_paidby']]);
            return $model->asArray()->one();

        }
        // echo $model->createCommand()->getRawSql(); die('');
        
        return $model->asArray()->all();

    }
    
    //
    public static function royaltyBatchLearnerListing($params)
    {
        $roy_pk = $params['roy_pk'];
        $fee = RoyaltyandasmtfeeTbl::find()->select(['rasf_feesubscriptionmst_fk as roy_pk'])->where(['royaltyandasmtfee_pk' => $roy_pk])->asArray()->one();
        if(empty($fee)){
            $fee = RoyaltyandasmtfeehstyTbl::find()->select('rasfh_feesubscriptionmst_fk as roy_pk')->where(['rasfh_royaltyandasmtfee_fk' => $roy_pk])->asArray()->one();
        }
        $fee_pk = $fee['roy_pk'];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_learnerreghrddtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $roy_pk")->queryOne();
        if(!empty($learnerIds['lavd_learnerreghrddtls_fk'])){
            $model = LearnerreghrddtlsTbl::find()->alias('le')->select([
                'learnerreghrddtls_pk',
                'Irhd_emailid AS LearnerEmail',
                's.sir_idnumber AS LearnerID',
                's.sir_name_en AS LearnerName',
                's.sir_mobnum AS LearnerNumber',
                's.sir_idnumber AS civilnum',
                'bmd_Batchno AS BatchNumber',
                'lrhd_learnerfee as trainingFee',
                "lrhd_status as status",
                'fsm_fee AS royaltytrainfee'
            ])->leftJoin('staffinforepo_tbl s','s.staffinforepo_pk = le.lrhd_staffinforepo_fk')
            ->leftJoin('batchmgmtdtls_tbl bmd','bmd.batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
            ->leftJoin('standardcoursedtls_tbl', 'standardcoursedtls_pk = bmd.bmd_standardcoursedtls_fk')
            ->leftJoin('feesubscriptionmst_tbl',"feesubscriptionmst_pk = $fee_pk")
            ->andwhere(['IN','learnerreghrddtls_pk', explode(', ',$learnerIds['lavd_learnerreghrddtls_fk'])]);

            if(!empty($params['searchkey'])){
                $data = $params['searchkey'];
                if($data['batch_number']){
                    $model->andFilterWhere(['LIKE', 'bmd_Batchno', $data['batch_number']]);
                }
                if($data['civil_number']){
                    $model->andFilterWhere(['LIKE', 'sir_idnumber', $data['civil_number']]);
                }
                if($data['email_number']){
                    $model->andFilterWhere(['LIKE', 'Irhd_emailid', $data['email_number']]);
                }
                if($data['learner_name']){
                    $model->andFilterWhere(['LIKE', 'sir_name_en', $data['learner_name']]);
                }
                if($data['mobil_num']){
                    $model->andFilterWhere(['LIKE', 'sir_mobnum', $data['mobil_num']]);
                }
                if($data['status']){
                    $model->andFilterWhere(['IN', 'lrhd_status', $data['status']]);
                }
            }
        // echo $model->createCommand()->getRawSql(); die('');

            $model->asArray();
            
            $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
            if($params['order']){
                $sort_column = $params['order'];
                $order_by = ($params['sort']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $params['index']
                ],
            ]);

            $finalAry = $provider->getModels();
            $countT = $provider->getTotalCount();
        }else{
            $countT = 0;
            $page = 0;
            $finalAry = [];
        }
        
        $response['totalcount'] = $countT;
        $response['size'] = $page;
        $response['data'] = $finalAry;

        return $response;
    }

    public static function getAssesmentFeeQuery($params){
        $allowMonthCount = Yii::$app->params['month_count_invoice']??1;
    
        // $params['searchkey'] =[];
        // $params['searchkey']['invoice_month'] ='2023-06';
        $prev =false;
        $roy_pk = $params['asmnt_pk'];
        $where = "";
        $prevWhere = "";
        
        if($roy_pk){
            $where .="AND royaltyandasmtfee_pk = $roy_pk";
            $prevWhere .= "AND rasfh_royaltyandasmtfee_fk = $roy_pk";
        }
        
        if(!empty($params['searchkey'])){
            $data = $params['searchkey'];

            if($data['invoiceno']){
                $invoice_no = $data['invoiceno'];
                $where .="AND rasf_invoiceno LIKE '%$invoice_no%'";
                $prevWhere .= "AND rasfh_invoiceno LIKE '%$invoice_no%'";
            }
            
            if($data['company_name']){
                $company_name  = $data['company_name'];
                $where .="AND (opalmem.omrm_companyname_en LIKE '%$company_name%' OR opalmem.omrm_companyname_ar LIKE '%$company_name%')";
                $prevWhere .= "AND (opalmem.omrm_companyname_en LIKE '%$company_name%' OR opalmem.omrm_companyname_ar LIKE '%$company_name%')";
            }

            if($data['training_provider']){
                $trainingprovider  = $data['training_provider'];
                $where .="AND (opalmem.omrm_tpname_en LIKE '%$trainingprovider%' OR opalmem.omrm_tpname_ar LIKE '%$trainingprovider%')";
                $prevWhere .= "AND (opalmem.omrm_tpname_en LIKE '%$trainingprovider%' OR opalmem.omrm_tpname_ar LIKE '%$trainingprovider%')";
            }

            if($data['coursetitle']){
                $coursetitle  = $data['coursetitle'];
                $where .="AND (scm_coursename_en LIKE '%$coursetitle%' OR scm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_en LIKE '%$coursetitle%')";
                $prevWhere .= "AND (scm_coursename_en LIKE '%$coursetitle%' OR scm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_ar LIKE '%$coursetitle%' OR appocm_coursename_en LIKE '%$coursetitle%')";
            }

            if($data['coursecate']){
                $coursecate  = $data['coursecate'];
                $where .="AND (courcatofr.ccm_catname_ar LIKE '%$coursecate%' OR courcatofr.ccm_catname_en LIKE '%$coursecate%' OR courcatstd.ccm_catname_ar LIKE '%$coursecate%' OR courcatstd.ccm_catname_en LIKE '%$coursecate%')";
                $prevWhere .= "AND (courcatofr.ccm_catname_ar LIKE '%$coursecate%' OR courcatofr.ccm_catname_en LIKE '%$coursecate%' OR courcatstd.ccm_catname_ar LIKE '%$coursecate%' OR courcatstd.ccm_catname_en LIKE '%$coursecate%')";
            }
            
            if($data['officetype']){
                $officetype  = implode(',',$data['officetype']);
                $where .="AND appinsinfo.appiim_officetype IN ($officetype)";
                $prevWhere .= "AND appinsinfo.appiim_officetype IN ($officetype)";
            }
           
            if($data['branchname']){
                $branchname  = $data['branchname'];
                $where .="AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
                $prevWhere .= "AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
            }
            if($data['opalmember']){
                $opalmember  = $data['opalmember'];
                $where .="AND opalmem.omrm_opalmembershipregnumber LIKE '%$opalmember%'";
                $prevWhere .= "AND opalmem.omrm_opalmembershipregnumber LIKE '%$opalmember%'";
            }
            
            if($data['paymentstatus']){
                $paymentstatus  = implode(',',$data['paymentstatus']);
                
                $where .="AND rasf_pymtstatus IN ($paymentstatus)";
                $prevWhere .= "AND rasfh_pymtstatus IN ($paymentstatus)";

                // echo'<pre>';print_r($where,$prevWhere );die('tets');
            }
            
            if($data['location']){
                $site_locate  = $data['location'];

                if(strpos($site_locate, ',') !== false){
                    $site = explode(',',$site_locate);
                    $state =$site[0];
                    $where .="AND (gov.osm_statename_en LIKE '%$state%' OR gov.osm_statename_ar LIKE '%$state%')";
                    $prevWhere .= "AND (gov.osm_statename_en LIKE '%$state%' OR gov.osm_statename_ar LIKE '%$state%')";
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =ltrim($site[1]);
                        $where .="AND (city.ocim_cityname_en LIKE '%$city%' OR city.ocim_cityname_ar LIKE '%$city%')";
                        $prevWhere .= "AND (city.ocim_cityname_en LIKE '%$city%' OR city.ocim_cityname_ar LIKE '%$city%')";
                    }
                }else{
                    $where .="AND (city.ocim_cityname_en LIKE '%$site_locate%' OR city.ocim_cityname_ar LIKE '%$site_locate%' OR gov.osm_statename_en LIKE '%$site_locate%' OR gov.osm_statename_ar LIKE '%$site_locate%')";
                    $prevWhere .= "AND (city.ocim_cityname_en LIKE '%$site_locate%' OR city.ocim_cityname_ar LIKE '%$site_locate%' OR gov.osm_statename_en LIKE '%$site_locate%' OR gov.osm_statename_ar LIKE '%$site_locate%')";
                }
            }

            if($data['assessmentcentre']){
                $branchname  = $data['assessmentcentre'];
                $where .="AND (f.omrm_companyname_en LIKE '%$branchname%' OR f.omrm_companyname_ar LIKE '%$branchname%')";
                $prevWhere .= "AND (f.omrm_companyname_en LIKE '%$branchname%' OR f.omrm_companyname_ar LIKE '%$branchname%')";
            }

            if($data['assessor_locate']){
                $site_locate  = $data['assessor_locate'];

                if(strpos($site_locate, ',') !== false){
                    $site = explode(',',$site_locate);
                    $state =$site[0];
                    $where .="AND (as_gov.osm_statename_en LIKE '%$state%' OR as_gov.osm_statename_ar LIKE '%$state%')";
                    $prevWhere .= "AND (as_gov.osm_statename_en LIKE '%$state%' OR as_gov.osm_statename_ar LIKE '%$state%')";
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =ltrim($site[1]);
                        $where .="AND (as_city.ocim_cityname_en LIKE '%$city%' OR as_city.ocim_cityname_ar LIKE '%$city%')";
                        $prevWhere .= "AND (as_city.ocim_cityname_en LIKE '%$city%' OR as_city.ocim_cityname_ar LIKE '%$city%')";
                    }
                }else{
                    $where .="AND (as_city.ocim_cityname_en LIKE '%$site_locate%' OR as_city.ocim_cityname_ar LIKE '%$site_locate%' OR as_gov.osm_statename_en LIKE '%$site_locate%' OR as_gov.osm_statename_ar LIKE '%$site_locate%')";
                    $prevWhere .= "AND (as_city.ocim_cityname_en LIKE '%$site_locate%' OR as_city.ocim_cityname_ar LIKE '%$site_locate%' OR as_gov.osm_statename_en LIKE '%$site_locate%' OR as_gov.osm_statename_ar LIKE '%$site_locate%')";
                }
            }

            if($data['invoice_month']){
                $month_start_date = $data['invoice_month']['start_date'];
                $month_end_date  = $data['invoice_month']['end_date'];
                
                $date=date_format(date_create($month_start_date),'Y-m');
                $date1=date_format(date_create($month_end_date),'Y-m');


                $prev = $date != date('Y-m') || $date1 != date('Y-m')? true:false ;
                // $month_end_date = date('Y-m-d', strtotime($month_end_date. ' + 1 days'));
                $month_start_date = date('Y-m-d', strtotime($date.'-01'. ' - 1 days'));
                $where .="AND rasf_raisedon between '$month_start_date' and '$month_end_date'";
                $prevWhere .= "AND rasfh_raisedon between '$month_start_date' and '$month_end_date'";
            }
            
            if($data['invoiceage']){
                $invoiceage  = $data['invoiceage'];
                $where .="AND invoiceage LIKE '%$invoiceage%'";
                $prevWhere .= "AND invoiceage LIKE '%$invoiceage%'";
                
            }

            if($data['invoicedate']){
                $inv_end_date  = $data['invoicedate']['end_date'];
                $inv_start_date = $data['invoicedate']['start_date'];
                $inv_end_date = date('Y-m-d', strtotime($inv_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$inv_start_date' and '$inv_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$inv_start_date' and '$inv_end_date'";
            }

            if($data['paymentdate']){
                $pay_end_date  = $data['paymentdate']['end_date'];
                $pay_start_date = $data['paymentdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_appdecon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_appdecon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['genratedon']){
                $pay_end_date  = $data['genratedon']['end_date'];
                $pay_start_date = $data['genratedon']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdate']){
                $pay_end_date  = $data['lastupdate']['end_date'];
                $pay_start_date = $data['lastupdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_updatedon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_updatedon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdateby']){
                $lastupdateby  = $data['lastupdateby'];
                $where .="AND upby.oum_firstname LIKE '%$lastupdateby%'";
                $prevWhere .= "AND upby.oum_firstname LIKE '%$lastupdateby%'";
            }

            if($data['genratedby']){
                $genratedby  = $data['genratedby'];
                $where .="AND genby.oum_firstname LIKE '%$genratedby%'";
                $prevWhere .= "AND genby.oum_firstname LIKE '%$genratedby%'";
            }
        }
        $fiterArray = [
            'invoiceno' => 'asmnt_pk',
            'trainingprovider' => 'trainingprovider_en',
            'centrelocat' => 'state_en',
            'assessmentcentre' => 'companyname_en',
            'assessorlocat' => 'as_state_en',
            'officetype' => 'appinsinfo.appiim_officetype',
            'company_name' => 'omrm_companyname_en',
            'branchname' => 'appiim_branchname_en',
            'coursetitle'=>'appocm_coursename_en',
            'paymentstatus'=> 'paymentstatus',
            'invoicedate'=> 'invoicedate',
            'paymentdate'=> 'paymentdate',
            'totallearner'=> 'totallearner',
            'invoicemonth' => 'invoicemonth',
            'lastupdateby' => 'upby.oum_firstname',
            'genratedon' => 'rasf_createdon',
            'genratedby' => 'genby.oum_firstname',
            'lastupdate' => 'rasf_updatedon',
        ];

        $sort="ORDER BY asmnt_pk desc";
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'asc': 'desc';
            $sort = "ORDER BY $sort_column $order_by";
        }
        
        $query ="SELECT
            royaltyandasmtfee_pk as asmnt_pk,
            rasf_invoiceno as invoiceno,
            rasf_pymtstatus as paymentstatus,
            rasf_totrecord as totallearner,
            rasf_invoicedamount,
            rasf_vatamount,
            rasf_invoiceexpiry,
            rasf_createdon,
            rasf_dateofpymt,
            rasf_appcoursedtlsmain_fk,
            rasf_feetype,
            rasf_paidby,
            rasf_projectmst_fk,
            rasf_appdecon,
            DATE_FORMAT(rasf_updatedon,'%d-%m-%Y') as lastupdate,
            upby.oum_firstname as lastupdateby,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as genratedon,
            genby.oum_firstname as genratedby,
            DATE_FORMAT(rasf_raisedon,'%M %Y') as invoicemonth,
            (COALESCE(rasf_invoicedamount, 0) + COALESCE(rasf_vatamount, 0)) AS invoiceamount,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as invoicedate,
            DATE_FORMAT(rasf_appdecon,'%d-%m-%Y') as paymentdate,
            (CASE WHEN rasf_pymtstatus != 2 AND rasf_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasf_createdon) ELSE '0' END) as invoiceage,
            appcdt_standardcoursemst_fk,
            opalmem.opalmemberregmst_pk,
            opalmem.omrm_opalmembershipregnumber as opalmember,
            gov.osm_statename_en as state_en,gov.osm_statename_ar as state_ar,
            city.ocim_cityname_en as city_en,city.ocim_cityname_ar as city_ar,
            as_gov.osm_statename_en as as_state_en,as_gov.osm_statename_ar as as_state_ar,
            as_city.ocim_cityname_en as as_city_en,as_city.ocim_cityname_ar as as_city_ar,
            f.omrm_companyname_en as as_companyname_en,f.omrm_companyname_ar as as_companyname_ar,
            opalmem.omrm_companyname_en as companyname_en,opalmem.omrm_companyname_ar as companyname_ar,
            opalmem.omrm_tpname_en as trainingprovider_en,opalmem.omrm_tpname_ar as trainingprovider_ar,
            opalmem.omrm_branchname_en as branchname_en,opalmem.omrm_branchname_ar as branchname_ar,
            (CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype
        FROM
            royaltyandasmtfee_tbl
            LEFT JOIN appcoursedtlsmain_tbl apcourdtls ON apcourdtls.AppCourseDtlsMain_PK = rasf_appcoursedtlsmain_fk
            LEFT JOIN appcoursedtlstmp_tbl apcourdtlsTmp ON apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK
            LEFT JOIN standardcoursemst_tbl stdcour ON stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk
            LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK
            LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = apcourdtls.appcdm_appinstinfomain_fk
            LEFT JOIN appoffercoursemain_tbl appoffer ON appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk
            LEFT JOIN coursecategorymst_tbl courcatstd ON courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk
            LEFT JOIN coursecategorymst_tbl courcatofr ON courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk
            LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk
            LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk
            LEFT JOIN opalmemberregmst_tbl f ON f.opalmemberregmst_pk = rasf_paidto
            LEFT JOIN opalcitymst_tbl as_city ON as_city.opalcitymst_pk = f.omrm_opalcitymst_fk
            LEFT JOIN opalstatemst_tbl as_gov ON as_gov.opalstatemst_pk = f.omrm_opalstatemst_fk
            LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasf_updatedby
            LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasf_createdby
        WHERE
        rasf_projectmst_fk IN (2,3) AND rasf_invoicestatus = 1 AND rasf_feetype = 2 $where";
        
        if($prev){
            $query .= "
            UNION
            SELECT
                rasfh_royaltyandasmtfee_fk as asmnt_pk,
                rasfh_invoiceno as invoiceno,
                rasfh_pymtstatus as paymentstatus,
                rasfh_totrecord as totallearner,
                rasfh_invoicedamount,
                rasfh_vatamount,
                rasfh_invoiceexpiry,
                rasfh_createdon,
                rasfh_dateofpymt,
                rasfh_appcoursedtlsmain_fk,
                rasfh_feetype,
                rasfh_paidby,
                rasfh_projectmst_fk,
                rasfh_appdecon,
                DATE_FORMAT(rasfh_updatedon,'%d-%m-%Y') as lastupdate,
                upby.oum_firstname as lastupdateby,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as genratedon,
                genby.oum_firstname as genratedby,
                DATE_FORMAT(rasfh_raisedon,'%M %Y') as invoicemonth,
                (COALESCE(rasfh_invoicedamount, 0) + COALESCE(rasfh_vatamount, 0)) AS invoiceamount,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as invoicedate,
                DATE_FORMAT(rasfh_appdecon,'%d-%m-%Y') as paymentdate,
                (CASE WHEN rasfh_pymtstatus != 2 AND rasfh_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasfh_createdon) ELSE '0' END) as invoiceage,
                appcdt_standardcoursemst_fk,
                opalmem.opalmemberregmst_pk,
                opalmem.omrm_opalmembershipregnumber as opalmember,
                gov.osm_statename_en as state_en,gov.osm_statename_ar as state_ar,
                city.ocim_cityname_en as city_en,city.ocim_cityname_ar as city_ar,
                as_gov.osm_statename_en as as_state_en,as_gov.osm_statename_ar as state_ar,
                as_city.ocim_cityname_en as as_city_en,as_city.ocim_cityname_ar as city_ar,
                f.omrm_companyname_en as as_companyname_en,f.omrm_companyname_ar as as_companyname_ar,
                opalmem.omrm_companyname_en as companyname_en,opalmem.omrm_companyname_ar as companyname_ar,
                opalmem.omrm_tpname_en as trainingprovider_en,opalmem.omrm_tpname_ar as trainingprovider_ar,
                opalmem.omrm_branchname_en as branchname_en,opalmem.omrm_branchname_ar as branchname_ar,
                (CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype
            FROM
                royaltyandasmtfeehsty_tbl
                LEFT JOIN appcoursedtlsmain_tbl apcourdtls ON apcourdtls.AppCourseDtlsMain_PK = rasfh_appcoursedtlsmain_fk
                LEFT JOIN appcoursedtlstmp_tbl apcourdtlsTmp ON apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK
                LEFT JOIN standardcoursemst_tbl stdcour ON stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk
                LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK
                LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = apcourdtls.appcdm_appinstinfomain_fk
                LEFT JOIN appoffercoursemain_tbl appoffer ON appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk
                LEFT JOIN coursecategorymst_tbl courcatstd ON courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk
                LEFT JOIN coursecategorymst_tbl courcatofr ON courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk
                LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk
                LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk
                LEFT JOIN opalmemberregmst_tbl f ON f.opalmemberregmst_pk = rasfh_paidto
                LEFT JOIN opalcitymst_tbl as_city ON as_city.opalcitymst_pk = f.omrm_opalcitymst_fk
                LEFT JOIN opalstatemst_tbl as_gov ON as_gov.opalstatemst_pk = f.omrm_opalstatemst_fk
                LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasfh_updatedby
                LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasfh_createdby
            WHERE
                rasfh_projectmst_fk IN (2,3) AND rasfh_invoicestatus = 1 AND rasfh_feetype = 2 $prevWhere";
        }
        // $model = RoyaltyandasmtfeeTbl::findBySql($query);
        $model = RoyaltyandasmtfeeTbl::find()->from(['alias' => "($query $sort)"]);
        if(isset($params['excel']))
        {
            $response['data'] = $model->asArray()->all();
            return $response;
        }
        // echo $model->createCommand()->getRawSql(); die('');
        $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;

        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $page,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        $response['data'] = $data;
        $response['month_count'] = $allowMonthCount;
        // $response = ['status' => true,'data' => $response,'msg' => 'Success'];
        
        return $response;
    }

    public static function royaltyViewQuery($roy_pk){
        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $roy_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $fee_fk = 'rasf_feesubscriptionmst_fk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $paidBy = 'rasf_paidby';
            $appdecComments =  'rasf_appdecComments';

            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $fee_fk = 'rasfh_feesubscriptionmst_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $appdecon = 'rasfh_appdecon';
            $appdecComments =  'rasfh_appdecComments';
            $appdecby = 'rasfh_appdecby';
            $paidBy = 'rasfh_paidby';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model = $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        "$fee_fk",
        'apcourdtlsTmp.appcoursedtlstmp_pk',
        "$invoicedamount as invoicedamount","$vatamount as vatamount",
        'appcdt_standardcoursemst_fk',
        'omrm_opalmembershipregnumber','scm_coursename_en','scm_coursename_ar',
        'appocm_coursename_en','appocm_coursename_ar',
        'omrm_opalmembershipregnumber as opalmember',
        'appcdt_appoffercoursemain_fk',
        "DATE_FORMAT($raisedon,'%M %Y') as raisedon",
        '(CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_ar  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_ar ELSE "-" END) as subcatar',
        '(CASE WHEN appcdt_appoffercoursemain_fk IS NOT NULL THEN courcatofr.ccm_catname_en  WHEN appcdt_standardcoursemst_fk IS NOT NULL THEN courcatstd.ccm_catname_en ELSE "-" END) as subcaten',
        "$pymtstatus as paymentstatus",
        'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
        'omrm_tpname_en as trainingprovider_en','omrm_tpname_ar as trainingprovider_ar',
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        "(CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
        "$totrecord as totallearner",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus != 2 AND $pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, $createdon) ELSE '0' END) as invoiceage",
        "DATE_FORMAT($createdon,'%d-%m-%Y') as invoicedate",
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as paymentdate",
        'osm_statename_en as state_en','osm_statename_ar as state_ar',
        'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'

        ])
        ->leftJoin('appcoursedtlsmain_tbl apcourdtls',"apcourdtls.AppCourseDtlsMain_PK = $appcoursedtlsmain_fk")
        ->leftJoin('appcoursedtlstmp_tbl apcourdtlsTmp','apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK')
        ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK')
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk')
        ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
        ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->where(["$royaltyandasmtfee_pk" => $roy_pk])
        ->asArray()->one();

        return $model;
    }

    public static function getAssesmentLearnerDtlsQuery($params){
       
        $model = BatchmgmtdtlsTbl::find()->alias('bgt')->select([
            'le.Irhd_projectmst_fk as rasf_projectmst_fk',
            'fsm_standardcoursedtls_fk',
            'bgt.bmd_appcoursedtlsmain_fk as rasf_appcoursedtlsmain_fk',
            'group_concat(distinct feesubscriptionmst_pk order by feesubscriptionmst_pk SEPARATOR ",") as rasf_feesubscriptionmst_fk',
            'group_concat(distinct le.learnerreghrddtls_pk order by le.learnerreghrddtls_pk SEPARATOR ", ") as lavd_learnerreghrddtls_fk',
            'count(distinct learnerreghrddtls_pk) as rasf_totrecord',
            'sum(fsm_fee) as rasf_invoicedamount',
            'bgt.bmd_appinstinfomain_fk as rasf_paidby',
            'f.opalmemberregmst_pk as rasf_paidto',
            'omrm_opalmembershipregnumber as opalMember'
        ])
        ->leftJoin('learnerreghrddtls_tbl le','le.lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk')
        ->innerJoin('learnerasmthdr_tbl k', 'learnerreghrddtls_pk = k.lasmth_learnerreghrddtls_fk')
        ->leftJoin('batchmgmtasmtdtls_tbl', 'bmad_learnerreghrddtls_fk = learnerreghrddtls_pk')
        ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk AND bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
        ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = bmah_assessor')
        ->leftJoin('opalmemberregmst_tbl f', 'f.opalmemberregmst_pk = c.oum_opalmemberregmst_fk')
        ->leftJoin('feesubscriptionmst_tbl', 'fsm_projectmst_fk =  le.Irhd_projectmst_fk AND fsm_feestype = 5 AND fsm_status = 1 and fsm_standardcoursedtls_fk=bmd_standardcoursedtls_fk and fsm_applicationtype = (case when bmd_batchtype = 24 then 1 when bmd_batchtype = 25 then 4 end)');
        $model->andwhere(['LIKE', 'DATE_FORMAT(bmah_assessmentdate,"%Y-%m")', $params['month']]);
        $model->andwhere(['!=','bmd_status', 7]);
        $model->andwhere(['!=','lrhd_status', 13]);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '1-%']);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '4-%']);
        $model->andwhere(['NOT LIKE','bmd_Batchno', '5-%']);
        $model->andwhere(['IS NOT','feesubscriptionmst_pk', NULL]);
        $model->andwhere('f.opalmemberregmst_pk <> bmd_opalmemberregmst_fk');
        $model->groupBy(['bmd_appinstinfomain_fk', 'f.opalmemberregmst_pk']);
        
        if(isset($params['opalmemberregmst_pk'])){
            $model->andwhere(['bmd_opalmemberregmst_fk'=> $params['opalmemberregmst_pk']]);
            $model->andwhere(['bmd_appinstinfomain_fk'=> $params['rasf_paidby']]);
            $model->andwhere(['f.opalmemberregmst_pk'=> $params['rasf_paidTo']]);
            return $model->asArray()->one();

        }
        // echo $model->createCommand()->getRawSql(); die;

        return $model->asArray()->all();
    }

    public static function batchLearnerListing($params)
    {
        $asmt_key = $params['asmnt_pk'];
        $fee = RoyaltyandasmtfeeTbl::find()->select(['rasf_feesubscriptionmst_fk as fee_pk'])->where(['royaltyandasmtfee_pk' => $asmt_key])->asArray()->one();
        if(empty($fee)){
            $fee = RoyaltyandasmtfeehstyTbl::find()->select('rasfh_feesubscriptionmst_fk as fee_pk')->where(['rasfh_royaltyandasmtfee_fk' => $asmt_key])->asArray()->one();
        }
        $fee_pk = is_array($fee['fee_pk'])?explode(", ",$fee['fee_pk']):$fee['fee_pk']; 
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_learnerreghrddtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $asmt_key")->queryOne();
        if(!empty($learnerIds['lavd_learnerreghrddtls_fk'])){
            $model = LearnerreghrddtlsTbl::find()->alias('le')->select([
                'distinct(learnerreghrddtls_pk)',
                'Irhd_emailid AS LearnerEmail',
                's.sir_idnumber AS LearnerID',
                's.sir_name_en AS LearnerName',
                's.sir_mobnum AS LearnerNumber',
                's.sir_idnumber AS civilnum',
                'bmd_Batchno AS BatchNumber',
                'lrhd_learnerfee as trainingFee',
                "lrhd_status AS status",
            'fsm_fee AS assessmentfee'
            ])->leftJoin('staffinforepo_tbl s','s.staffinforepo_pk = le.lrhd_staffinforepo_fk')
            ->leftJoin('batchmgmtdtls_tbl bmd','bmd.batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
            ->leftJoin('feesubscriptionmst_tbl',"FIND_IN_SET(feesubscriptionmst_pk,'$fee_pk') and fsm_applicationtype = (case when bmd_batchtype = 24 then 1 when bmd_batchtype = 25 then 4 end)")
            ->andwhere(['IN','learnerreghrddtls_pk', explode(', ',$learnerIds['lavd_learnerreghrddtls_fk'])])->groupBy('learnerreghrddtls_pk');
            // echo $model->createCommand()->getRawSql(); die();
            if(!empty($params['searchkey'])){
                $data = $params['searchkey'];
                if($data['BatchNumber']){
                    $model->andFilterWhere(['LIKE', 'bmd_Batchno', $data['BatchNumber']]);
                }
                if($data['civilnum']){
                    $model->andFilterWhere(['LIKE', 's.sir_idnumber', $data['civilnum']]);
                }
                if($data['LearnerName']){
                    $model->andFilterWhere(['LIKE', 's.sir_name_en', $data['LearnerName']]);
                }
                if($data['LearnerEmail']){
                    $model->andFilterWhere(['LIKE', 'Irhd_emailid', $data['LearnerEmail']]);
                }
                if($data['LearnerNumber']){
                    $model->andFilterWhere(['LIKE', 's.sir_mobnum', $data['LearnerNumber']]);
                }
                if($data['traingFee']){
                    $model->andFilterWhere(['IN', 'lrhd_learnerfee', $data['traingfee']]);
                }
                if($data['assessmentfee']){
                    $model->andFilterWhere(['LIKE', 'fsm_fee', $data['assessmentfee']]);
                }

                if($data['status']){
                    $model->andFilterWhere(['lrhd_status'=>$data['status']]);
                }
            }
            $fiterArray = [
                'batchnum'=> 'bmd_Batchno',
                'emailid'=> 'Irhd_emailid',
                'mobilnum'=> 's.sir_mobnum',
                'traingfee'=> 'lrhd_learnerfee',
            ];
            $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
            if($sort_column){
                $order_by = ($params['sort']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }

            $query = $model->asArray();
            $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
            
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $params['index']
                ],
            ]);

            $finalAry = $provider->getModels();
            $tcount = $model->count();
        }else{
            $finalAry = [];
            $page =0;
            $tcount = 0;
        }
        
        $response['totalcount'] =$tcount ;
        $response['size'] = $page;
        $response['data'] = $finalAry;
        return $response;
    }

    public static function generateVehicleInvoice($params)
    {

        $model = RasvehicleregdtlsTbl::find()->alias('rasveh')
        ->select([
            'feesubscriptionmst_pk as rasf_feesubscriptionmst_fk',
            'count(distinct rasvehicleregdtls_pk) as rasf_totrecord',
            '(fsm_fee*count(distinct rasvehicleregdtls_pk)) as rasf_invoicedamount',
            'group_concat(distinct rasveh.rasvehicleregdtls_pk order by rasveh.rasvehicleregdtls_pk SEPARATOR ", ") as lavd_rasvehicleregdtls_fk',
            'rasveh.rvrd_appinstinfomain_fk as rasf_paidby',
            'omrm_opalmembershipregnumber as opalmember',
        ])
        ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk=rvrd_opalmemberregmst_fk')
        ->leftJoin('feesubscriptionmst_tbl', 'fsm_projectmst_fk =  4 AND fsm_feestype = 3 AND fsm_status = 1');
        $model->andwhere(['LIKE', 'DATE_FORMAT(rvrd_dateofinsp,"%Y-%m")', $params['month']]);
        $model->groupBy(['rasveh.rvrd_appinstinfomain_fk']);

        if(isset($params['rasf_paidby'])){
            $model->andwhere(['rasveh.rvrd_appinstinfomain_fk'=> $params['rasf_paidby']]);
            return $model->asArray()->one();
        }
        // echo $model->createCommand()->getRawSql(); die('');
        
        return $model->asArray()->all();

    }
    public static function generateIvmsInvoice($params)
    {

        $model = IvmsvehicleregdtlsTbl::find()
        ->select([
            'feesubscriptionmst_pk as rasf_feesubscriptionmst_fk',
            'count(distinct ivmsvehicleregdtls_pk) as rasf_totrecord',
            '(fsm_fee*count(distinct ivmsvehicleregdtls_pk)) as rasf_invoicedamount',
            'group_concat(distinct ivmsvehicleregdtls_pk order by ivmsvehicleregdtls_pk SEPARATOR ", ") as lavd_rasvehicleregdtls_fk',
            'ivrd_appinstinfomain_fk as rasf_paidby',
            'omrm_opalmembershipregnumber as opalmember',
        ])
        ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk=ivrd_opalmemberregmst_fk')
        ->leftJoin('feesubscriptionmst_tbl', 'fsm_projectmst_fk = 5 AND fsm_feestype = 3 AND fsm_status = 1');
        $model->andwhere(['LIKE', 'DATE_FORMAT(ivrd_dateoffiiting,"%Y-%m")', $params['month']]);
        $model->groupBy(['ivrd_appinstinfomain_fk']);

        if(isset($params['rasf_paidby'])){
            $model->andwhere(['ivrd_appinstinfomain_fk'=> $params['rasf_paidby']]);
            return $model->asArray()->one();
        }
        // echo $model->createCommand()->getRawSql(); die('');
        
        return $model->asArray()->all();

    }

    public static function techRoyaltyListingQuery($params){


        $allowMonthCount = Yii::$app->params['month_count_invoice']??1;
    
        // $params['searchkey'] =[];
        // $params['searchkey']['invoice_month'] ='2023-06';
        $prev =false;
        $roy_pk = $params['roy_pk'];
        $where = "";
        $prevWhere = "";
        
        if($roy_pk){
            $where .="AND royaltyandasmtfee_pk = $roy_pk";
            $prevWhere .= "AND rasfh_royaltyandasmtfee_fk = $roy_pk";
        }
        
        if(!empty($params['searchkey'])){
            $data = $params['searchkey'];

            if($data['invoice_no']){
                $invoice_no = $data['invoice_no'];
                $where .="AND rasf_invoiceno LIKE '%$invoice_no%'";
                $prevWhere .= "AND rasfh_invoiceno LIKE '%$invoice_no%'";
            }

            if($data['company_name']){
                $company_name  = $data['company_name'];
                $where .="AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
                $prevWhere .= "AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
            }

            if($data['centre_name']){
                $trainingprovider  = $data['centre_name'];
                $where .="AND (omrm_branch_en LIKE '%$trainingprovider%' OR omrm_branch_ar LIKE '%$trainingprovider%')";
                $prevWhere .= "AND (omrm_branch_en LIKE '%$trainingprovider%' OR omrm_branch_ar LIKE '%$trainingprovider%')";
            }

            if($data['office_type']){
                $officetype  = implode(',',$data['office_type']);
                $where .="AND appiim_officetype IN ($officetype)";
                $prevWhere .= "AND appiim_officetype IN ($officetype)";
            }

            if($data['bran_name']){
                $branchname  = $data['bran_name'];
                $where .="AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
                $prevWhere .= "AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
            }

            if($data['opal_membership']){
                $opalmember  = $data['opal_membership'];
                $where .="AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
                $prevWhere .= "AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
            }

            if($data['project_type']){
                $project_type  = $data['project_type'];
                $where .="AND (pm_projectname_en LIKE '%$project_type%' OR pm_projectname_ar LIKE '%$project_type%')";
                $prevWhere .= "AND (pm_projectname_en LIKE '%$project_type%' OR pm_projectname_ar LIKE '%$project_type%')";
            }
            
            if($data['pay_status']){
                $paymentstatus  = implode(',',$data['pay_status']);
                $where .="AND rasf_pymtstatus IN ($paymentstatus)";
                $prevWhere .= "AND rasfh_pymtstatus IN ($paymentstatus)";
            }

            if($data['site_locate']){
                $site_locate  = $data['site_locate'];

                if(strpos($site_locate, ',') !== false){
                    $site = explode(',',$data['site_locate']);
                    $state =$site[0];
                    $where .="AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    $prevWhere .= "AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =ltrim($site[1]);
                        $where .="AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                        $prevWhere .= "AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                    }
                }else{
                    $where .="AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                    $prevWhere .= "AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                }
            }

            if($data['invoice_month']){
                $month_start_date = $data['invoice_month']['start_date'];
                $month_end_date  = $data['invoice_month']['end_date'];
                
                $date=date_format(date_create($month_start_date),'Y-m');
                $date1=date_format(date_create($month_end_date),'Y-m');


                $prev = $date != date('Y-m') || $date1 != date('Y-m')? true:false ;
                // $month_end_date = date('Y-m-d', strtotime($month_end_date. ' + 1 days'));
                $month_start_date = date('Y-m-d', strtotime($date.'-01'. ' - 1 days'));
                $where .="AND rasf_raisedon between '$month_start_date' and '$month_end_date'";
                $prevWhere .= "AND rasfh_raisedon between '$month_start_date' and '$month_end_date'";
            }

            if($data['invoice_date']){
                $inv_end_date  = $data['invoice_date']['end_date'];
                $inv_start_date = $data['invoice_date']['start_date'];
                $inv_end_date = date('Y-m-d', strtotime($inv_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$inv_start_date' and '$inv_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$inv_start_date' and '$inv_end_date'";
            }

            if($data['payment_date']){
                $pay_end_date  = $data['payment_date']['end_date'];
                $pay_start_date = $data['payment_date']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_appdecon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_appdecon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['genratedon']){
                $pay_end_date  = $data['genratedon']['end_date'];
                $pay_start_date = $data['genratedon']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdate']){
                $pay_end_date  = $data['lastupdate']['end_date'];
                $pay_start_date = $data['lastupdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_updatedon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_updatedon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdateby']){
                $lastupdateby  = $data['lastupdateby'];
                $where .="AND upby.oum_firstname LIKE '%$lastupdateby%'";
                $prevWhere .= "AND upby.oum_firstname LIKE '%$lastupdateby%'";
            }

            if($data['genratedby']){
                $genratedby  = $data['genratedby'];
                $where .="AND genby.oum_firstname LIKE '%$genratedby%'";
                $prevWhere .= "AND genby.oum_firstname LIKE '%$genratedby%'";
            }
            
        }

        $fiterArray = [
            'invoiceno'=> 'invoiceno',
            'companyname' => 'omrm_companyname_en',
            'branchname' => 'appiim_branchname_en',
            'centrename'=>'omrm_tpname_en',
            'officetype' => 'officetype',
            'opalmember' => 'omrm_opalmembershipregnumber',
            'pymtstatus' => "paymentstatus",
            'locate' =>'state_en',
            'projectname'=>'pm_projectname_en',
            'invoiceamount'=>'invoiceamount',
            'paymentstatus'=>'paymentstatus',
            'invoicedate'=>'invoicedate',
            'invoiceage'=>'invoiceage',
            'paymentdate'=>'paymentdate',
            'lastupdateby' => 'upby.oum_firstname',
            'genratedon' => 'rasf_createdon',
            'genratedby' => 'genby.oum_firstname',
            'lastupdate' => 'rasf_updatedon',
        ];

        $sort="ORDER BY roy_pk desc";
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'ASC': 'DESC';
            $sort = "ORDER BY $sort_column $order_by";
        }

        $query ="SELECT
            royaltyandasmtfee_pk as roy_pk,
            rasf_invoiceno as invoiceno,
            rasf_pymtstatus as paymentstatus,
            rasf_totrecord as totalVehicle,
            rasf_invoicedamount,
            rasf_vatamount,
            rasf_invoiceexpiry,
            rasf_createdon,
            rasf_dateofpymt,
            rasf_appcoursedtlsmain_fk,
            rasf_feetype,
            rasf_paidby,
            rasf_projectmst_fk,
            rasf_appdecon,
            DATE_FORMAT(rasf_updatedon,'%d-%m-%Y') as lastupdate,
            upby.oum_firstname as lastupdateby,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as genratedon,
            genby.oum_firstname as genratedby,
            DATE_FORMAT(rasf_raisedon,'%M %Y') as invoicemonth,
            (COALESCE(rasf_invoicedamount, 0) + COALESCE(rasf_vatamount, 0)) AS invoiceamount,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as invoicedate,
            DATE_FORMAT(rasf_appdecon,'%d-%m-%Y') as paymentdate,
            (CASE WHEN rasf_pymtstatus != 2 AND rasf_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasf_createdon) ELSE '0' END) as invoiceage,
            pm_projectname_en,pm_projectname_ar,
            appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
            (CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
            osm_statename_en as state_en,osm_statename_ar as state_ar,
            ocim_cityname_en as city_en,ocim_cityname_ar as city_ar,
            omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
            omrm_branch_en as trainingprovider_en,omrm_branch_ar as trainingprovider_ar,
            opalmemberregmst_pk,
            omrm_opalmembershipregnumber as opalmember
        FROM
            royaltyandasmtfee_tbl
            LEFT JOIN projectmst_tbl pro ON pro.projectmst_pk = rasf_projectmst_fk
            LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasf_paidby
            LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk
            LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = appiim_citymst_fk
            LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = appiim_statemst_fk
            LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasf_updatedby
            LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasf_createdby
        WHERE
        rasf_projectmst_fk = 4 AND rasf_invoicestatus = 1 AND rasf_feetype = 1 $where";
        
        if($prev){
            $query .= "
            UNION
            SELECT
                rasfh_royaltyandasmtfee_fk as roy_pk,
                rasfh_invoiceno as invoiceno,
                rasfh_pymtstatus as paymentstatus,
                rasfh_totrecord as totalVehicle,
                rasfh_invoicedamount,
                rasfh_vatamount,
                rasfh_invoiceexpiry,
                rasfh_createdon,
                rasfh_dateofpymt,
                rasfh_appcoursedtlsmain_fk,
                rasfh_feetype,
                rasfh_paidby,
                rasfh_projectmst_fk,
                rasfh_appdecon,
                DATE_FORMAT(rasfh_updatedon,'%d-%m-%Y') as lastupdate,
                upby.oum_firstname as lastupdateby,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as genratedon,
                genby.oum_firstname as genratedby,
                DATE_FORMAT(rasfh_raisedon,'%M %Y') as invoicemonth,
                (COALESCE(rasfh_invoicedamount, 0) + COALESCE(rasfh_vatamount, 0)) AS invoiceamount,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as invoicedate,
                DATE_FORMAT(rasfh_appdecon,'%d-%m-%Y') as paymentdate,
                (CASE WHEN rasfh_pymtstatus != 2 AND rasfh_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasfh_createdon) ELSE '0' END) as invoiceage,
                pm_projectname_en,pm_projectname_ar,
                appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
                (CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
                osm_statename_en as state_en,osm_statename_ar as state_ar,
                ocim_cityname_en as city_en,ocim_cityname_ar as city_ar,
                omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
                omrm_branch_en as trainingprovider_en,omrm_branch_ar as trainingprovider_ar,
                opalmemberregmst_pk,
                omrm_opalmembershipregnumber as opalmember
            FROM
                royaltyandasmtfeehsty_tbl
                LEFT JOIN projectmst_tbl pro ON pro.projectmst_pk = rasfh_projectmst_fk
                LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasfh_paidby
                LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk
                LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = appiim_citymst_fk
                LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = appiim_statemst_fk
                LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasfh_updatedby
                LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasfh_createdby
            WHERE
                rasfh_projectmst_fk = 4 AND rasfh_invoicestatus = 1 AND rasfh_feetype = 1 $prevWhere";
        }
        
        // $model = RoyaltyandasmtfeeTbl::findBySql($query);
        $model = RoyaltyandasmtfeeTbl::find()->from(['alias' => "($query $sort)"]);

        if(isset($params['excel']))
        {
            $response['data'] = $model->asArray()->all();
            return $response;
        }
        // echo $model->createCommand()->getRawSql(); die('');
        $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $page,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        $response['data'] = $data;
        $response['month_count'] = $allowMonthCount;
        // $response = ['status' => true,'data' => $response,'msg' => 'Success'];
        
        return $response;

    }

     //technical installation
     public static function techIvmsQuery($params){


        $allowMonthCount = Yii::$app->params['month_count_invoice']??1;
    
        // $params['searchkey'] =[];
        // $params['searchkey']['invoice_month'] ='2023-06';
        $prev =false;
        $roy_pk = $params['roy_pk'];
        $where = "";
        $prevWhere = "";
        
        if($roy_pk){
            $where .="AND royaltyandasmtfee_pk = $roy_pk";
            $prevWhere .= "AND rasfh_royaltyandasmtfee_fk = $roy_pk";
        }
        
        if(!empty($params['searchkey'])){
            $data = $params['searchkey'];

            if($data['invoice_no']){
                $invoice_no = $data['invoice_no'];
                $where .="AND rasf_invoiceno LIKE '%$invoice_no%'";
                $prevWhere .= "AND rasfh_invoiceno LIKE '%$invoice_no%'";
            }

            if($data['company_name']){
                $company_name  = $data['company_name'];
                $where .="AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
                $prevWhere .= "AND (omrm_companyname_en LIKE '%$company_name%' OR omrm_companyname_ar LIKE '%$company_name%')";
            }

            if($data['centre_name']){
                $trainingprovider  = $data['centre_name'];
                $where .="AND (omrm_branch_en LIKE '%$trainingprovider%' OR omrm_branch_ar LIKE '%$trainingprovider%')";
                $prevWhere .= "AND (omrm_branch_en LIKE '%$trainingprovider%' OR omrm_branch_ar LIKE '%$trainingprovider%')";
            }

            if($data['office_type']){
                $officetype  = implode(',',$data['office_type']);
                $where .="AND appiim_officetype IN ($officetype)";
                $prevWhere .= "AND appiim_officetype IN ($officetype)";
            }

            if($data['bran_name']){
                $branchname  = $data['bran_name'];
                $where .="AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
                $prevWhere .= "AND (appiim_branchname_en LIKE '%$branchname%' OR appiim_branchname_ar LIKE '%$branchname%')";
            }

            if($data['opal_membership']){
                $opalmember  = $data['opal_membership'];
                $where .="AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
                $prevWhere .= "AND omrm_opalmembershipregnumber LIKE '%$opalmember%'";
            }

            if($data['project_type']){
                $project_type  = $data['project_type'];
                $where .="AND (pm_projectname_en LIKE '%$project_type%' OR pm_projectname_ar LIKE '%$project_type%')";
                $prevWhere .= "AND (pm_projectname_en LIKE '%$project_type%' OR pm_projectname_ar LIKE '%$project_type%')";
            }
            
            if($data['pay_status']){
                $paymentstatus  = implode(',',$data['pay_status']);
                $where .="AND rasf_pymtstatus IN ($paymentstatus)";
                $prevWhere .= "AND rasfh_pymtstatus IN ($paymentstatus)";
            }

            if($data['site_locate']){
                $site_locate  = $data['site_locate'];

                if(strpos($site_locate, ',') !== false){
                    $site = explode(',',$data['site_locate']);
                    $state =trim($site[0]);
                    $where .="AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    $prevWhere .= "AND (osm_statename_en LIKE '%$state%' OR osm_statename_ar LIKE '%$state%')";
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =trim($site[1]);
                        $where .="AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                        $prevWhere .= "AND (ocim_cityname_en LIKE '%$city%' OR ocim_cityname_ar LIKE '%$city%')";
                    }
                }else{
                    $where .="AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                    $prevWhere .= "AND (ocim_cityname_en LIKE '%$site_locate%' OR ocim_cityname_ar LIKE '%$site_locate%' OR osm_statename_en LIKE '%$site_locate%' OR osm_statename_ar LIKE '%$site_locate%')";
                }
            }

            if($data['invoice_month']){
                $month_start_date = $data['invoice_month']['start_date'];
                $month_end_date  = $data['invoice_month']['end_date'];
                
                $date=date_format(date_create($month_start_date),'Y-m');
                $date1=date_format(date_create($month_end_date),'Y-m');


                $prev = $date != date('Y-m') || $date1 != date('Y-m')? true:false ;
                // $month_end_date = date('Y-m-d', strtotime($month_end_date. ' + 1 days'));
                $month_start_date = date('Y-m-d', strtotime($date.'-01'. ' - 1 days'));
                $where .="AND rasf_raisedon between '$month_start_date' and '$month_end_date'";
                $prevWhere .= "AND rasfh_raisedon between '$month_start_date' and '$month_end_date'";
            }

            if($data['invoice_date']){
                $inv_end_date  = $data['invoice_date']['end_date'];
                $inv_start_date = $data['invoice_date']['start_date'];
                $inv_end_date = date('Y-m-d', strtotime($inv_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$inv_start_date' and '$inv_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$inv_start_date' and '$inv_end_date'";
            }

            if($data['payment_date']){
                $pay_end_date  = $data['payment_date']['end_date'];
                $pay_start_date = $data['payment_date']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_appdecon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_appdecon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['genratedon']){
                $pay_end_date  = $data['genratedon']['end_date'];
                $pay_start_date = $data['genratedon']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_createdon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_createdon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdate']){
                $pay_end_date  = $data['lastupdate']['end_date'];
                $pay_start_date = $data['lastupdate']['start_date'];
                $pay_end_date = date('Y-m-d', strtotime($pay_end_date. ' + 1 days'));

                $where .="AND rasf_updatedon between '$pay_start_date' and '$pay_end_date'";
                $prevWhere .= "AND rasfh_updatedon between '$pay_start_date' and '$pay_end_date'";
            }

            if($data['lastupdateby']){
                $lastupdateby  = $data['lastupdateby'];
                $where .="AND upby.oum_firstname LIKE '%$lastupdateby%'";
                $prevWhere .= "AND upby.oum_firstname LIKE '%$lastupdateby%'";
            }

            if($data['genratedby']){
                $genratedby  = $data['genratedby'];
                $where .="AND genby.oum_firstname LIKE '%$genratedby%'";
                $prevWhere .= "AND genby.oum_firstname LIKE '%$genratedby%'";
            }
            
        }

        $fiterArray = [
            'invoiceno'=> 'roy_pk',
            'companyname' => 'omrm_companyname_en',
            'branchname' => 'appiim_branchname_en',
            'centrename'=>'omrm_tpname_en',
            'officetype' => 'officetype',
            'opalmember' => 'omrm_opalmembershipregnumber',
            'pymtstatus' => "paymentstatus",
            'locate' =>'state_en',
            'projectname'=>'pm_projectname_en',
            'invoiceamount'=>'invoiceamount',
            'paymentstatus'=>'paymentstatus',
            'invoicedate'=>'invoicedate',
            'invoiceage'=>'invoiceage',
            'paymentdate'=>'paymentdate',
            'lastupdateby' => 'upby.oum_firstname',
            'genratedon' => 'rasf_createdon',
            'genratedby' => 'genby.oum_firstname',
            'lastupdate' => 'rasf_updatedon',
        ];

        $sort="ORDER BY roy_pk desc";
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'ASC': 'DESC';
            $sort = "ORDER BY $sort_column $order_by";
        }

        $query ="SELECT
            royaltyandasmtfee_pk as roy_pk,
            rasf_invoiceno as invoiceno,
            rasf_pymtstatus as paymentstatus,
            rasf_totrecord as totalVehicle,
            rasf_invoicedamount,
            rasf_vatamount,
            rasf_invoiceexpiry,
            rasf_createdon,
            rasf_dateofpymt,
            rasf_appcoursedtlsmain_fk,
            rasf_feetype,
            rasf_paidby,
            rasf_projectmst_fk,
            rasf_appdecon,
            DATE_FORMAT(rasf_updatedon,'%d-%m-%Y') as lastupdate,
            upby.oum_firstname as lastupdateby,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as genratedon,
            genby.oum_firstname as genratedby,
            DATE_FORMAT(rasf_raisedon,'%M %Y') as invoicemonth,
            (COALESCE(rasf_invoicedamount, 0) + COALESCE(rasf_vatamount, 0)) AS invoiceamount,
            DATE_FORMAT(rasf_createdon,'%d-%m-%Y') as invoicedate,
            DATE_FORMAT(rasf_appdecon,'%d-%m-%Y') as paymentdate,
            (CASE WHEN rasf_pymtstatus != 2 AND rasf_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasf_createdon) ELSE '0' END) as invoiceage,
            pm_projectname_en,pm_projectname_ar,
            appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
            (CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
            osm_statename_en as state_en,osm_statename_ar as state_ar,
            ocim_cityname_en as city_en,ocim_cityname_ar as city_ar,
            omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
            omrm_branch_en as trainingprovider_en,omrm_branch_ar as trainingprovider_ar,
            opalmemberregmst_pk,
            omrm_opalmembershipregnumber as opalmember
        FROM
            royaltyandasmtfee_tbl
            LEFT JOIN projectmst_tbl pro ON pro.projectmst_pk = rasf_projectmst_fk
            LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasf_paidby
            LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk
            LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = appiim_citymst_fk
            LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = appiim_statemst_fk
            LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasf_updatedby
            LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasf_createdby
        WHERE
        rasf_projectmst_fk = 5 AND rasf_invoicestatus = 1 AND rasf_feetype = 1 $where";
        
        if($prev){
            $query .= "
            UNION
            SELECT
                rasfh_royaltyandasmtfee_fk as roy_pk,
                rasfh_invoiceno as invoiceno,
                rasfh_pymtstatus as paymentstatus,
                rasfh_totrecord as totalVehicle,
                rasfh_invoicedamount,
                rasfh_vatamount,
                rasfh_invoiceexpiry,
                rasfh_createdon,
                rasfh_dateofpymt,
                rasfh_appcoursedtlsmain_fk,
                rasfh_feetype,
                rasfh_paidby,
                rasfh_projectmst_fk,
                rasfh_appdecon,
                DATE_FORMAT(rasfh_updatedon,'%d-%m-%Y') as lastupdate,
                upby.oum_firstname as lastupdateby,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as genratedon,
                genby.oum_firstname as genratedby,
                DATE_FORMAT(rasfh_raisedon,'%M %Y') as invoicemonth,
                (COALESCE(rasfh_invoicedamount, 0) + COALESCE(rasfh_vatamount, 0)) AS invoiceamount,
                DATE_FORMAT(rasfh_createdon,'%d-%m-%Y') as invoicedate,
                DATE_FORMAT(rasfh_appdecon,'%d-%m-%Y') as paymentdate,
                (CASE WHEN rasfh_pymtstatus != 2 AND rasfh_pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, rasfh_createdon) ELSE '0' END) as invoiceage,
                pm_projectname_en,pm_projectname_ar,
                appiim_branchname_en as branchname_en,appiim_branchname_ar as branchname_ar,
                (CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype,
                osm_statename_en as state_en,osm_statename_ar as state_ar,
                ocim_cityname_en as city_en,ocim_cityname_ar as city_ar,
                omrm_companyname_en as companyname_en,omrm_companyname_ar as companyname_ar,
                omrm_branch_en as trainingprovider_en,omrm_branch_ar as trainingprovider_ar,
                opalmemberregmst_pk,
                omrm_opalmembershipregnumber as opalmember
            FROM
                royaltyandasmtfeehsty_tbl
                LEFT JOIN projectmst_tbl pro ON pro.projectmst_pk = rasfh_projectmst_fk
                LEFT JOIN appinstinfomain_tbl appinsinfo ON appinsinfo.appinstinfomain_pk = rasfh_paidby
                LEFT JOIN opalmemberregmst_tbl opalmem ON opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk
                LEFT JOIN opalcitymst_tbl city ON city.opalcitymst_pk = appiim_citymst_fk
                LEFT JOIN opalstatemst_tbl gov ON gov.opalstatemst_pk = appiim_statemst_fk
                LEFT JOIN opalusermst_tbl upby ON upby.opalusermst_pk = rasfh_updatedby
                LEFT JOIN opalusermst_tbl genby ON genby.opalusermst_pk = rasfh_createdby
            WHERE
                rasfh_projectmst_fk = 5 AND rasfh_invoicestatus = 1 AND rasfh_feetype = 1 $prevWhere";
        }
        
        // $model = RoyaltyandasmtfeeTbl::findBySql($query);
        $model = RoyaltyandasmtfeeTbl::find()->from(['alias' => "($query $sort)"]);

        if(isset($params['excel']))
        {
            $response['data'] = $model->asArray()->all();
            return $response;
        }
        // echo $model->createCommand()->getRawSql(); die('');
        $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $page,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        $response['data'] = $data;
        $response['month_count'] = $allowMonthCount;
        // $response = ['status' => true,'data' => $response,'msg' => 'Success'];
        
        return $response;

    }

    public static function techRoyaltyViewQuery($roy_pk){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $roy_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $fee_fk = 'rasf_feesubscriptionmst_fk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $paidBy = 'rasf_paidby';
            $projectPk = "rasf_projectmst_fk";
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $fee_fk = 'rasfh_feesubscriptionmst_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $paidBy = 'rasfh_paidby';
            $projectPk = "rasfh_projectmst_fk";
            $appdecon = 'rasfh_appdecon';
            $appdecby = 'rasfh_appdecby';
            $appdecComments =  'rasfh_appdecComments';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        "$fee_fk",
        "DATE_FORMAT($raisedon,'%M %Y') as invoicemonth",
        "$paidBy",
        "$pymtstatus as paymentstatus",
        "$totrecord as totalVehicle",
        "COALESCE($invoicedamount, 0) as amount",
        "COALESCE($vatamount, 0) as vat",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus != 2 AND $pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, $createdon) ELSE '0' END) as invoiceage",
        "DATE_FORMAT($createdon,'%d-%m-%Y') as invoicedate",
        "(Case WHEN $dateofpymt IS NOT NULL THEN DATE_FORMAT($dateofpymt,'%d-%m-%Y') ELSE '-' END) as paymentdate",
        'pm_projectname_en','pm_projectname_ar',
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        '(CASE WHEN appiim_officetype = 1 THEN "Main Office" WHEN appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        'osm_statename_en as state_en','osm_statename_ar as state_ar',
        'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
        'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
        'omrm_branch_en as trainingprovider_en','omrm_branch_ar as trainingprovider_ar', // it is centre name
        // 'omrm_branch_en as centre_en','omrm_branch_ar as centre_ar',
        'opalmemberregmst_pk',
        'omrm_opalmembershipregnumber as opalmember',
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'
        ])
        ->leftjoin('projectmst_tbl pro',"pro.projectmst_pk = $projectPk")
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->andWhere([
            'AND',
            ["$feetype" => 1],
            ['=',"$projectPk",4],
            ["$royaltyandasmtfee_pk" => $roy_pk]
        ]);

        return $model->asArray()->one();
    }

    public static function techroyaltyviewIvms($roy_pk){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $roy_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $fee_fk = 'rasf_feesubscriptionmst_fk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $paidBy = 'rasf_paidby';
            $projectPk = "rasf_projectmst_fk";
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $fee_fk = 'rasfh_feesubscriptionmst_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $paidBy = 'rasfh_paidby';
            $projectPk = "rasfh_projectmst_fk";
            $appdecon = 'rasfh_appdecon';
            $appdecby = 'rasfh_appdecby';
            $appdecComments =  'rasfh_appdecComments';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        "$fee_fk",
        "DATE_FORMAT($raisedon,'%M %Y') as invoicemonth",
        "$paidBy",
        "$pymtstatus as paymentstatus",
        "$totrecord as totalVehicle",
        "COALESCE($invoicedamount, 0) as amount",
        "COALESCE($vatamount, 0) as vat",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus != 2 AND $pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, $createdon) ELSE '0' END) as invoiceage",
        "DATE_FORMAT($createdon,'%d-%m-%Y') as invoicedate",
        "(Case WHEN $dateofpymt IS NOT NULL THEN DATE_FORMAT($dateofpymt,'%d-%m-%Y') ELSE '-' END) as paymentdate",
        'pm_projectname_en','pm_projectname_ar',
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        '(CASE WHEN appiim_officetype = 1 THEN "Main Office" WHEN appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        'osm_statename_en as state_en','osm_statename_ar as state_ar',
        'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
        'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
        'omrm_branch_en as trainingprovider_en','omrm_branch_ar as trainingprovider_ar', // it is centre name
        // 'omrm_branch_en as centre_en','omrm_branch_ar as centre_ar',
        'opalmemberregmst_pk',
        'omrm_opalmembershipregnumber as opalmember',
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'
        ])
        ->leftjoin('projectmst_tbl pro',"pro.projectmst_pk = $projectPk")
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->andWhere([
            'AND',
            ["$feetype" => 1],
            ['=',"$projectPk",5],
            ["$royaltyandasmtfee_pk" => $roy_pk]
        ]);

        return $model->asArray()->one();
    }

    public static function vehicleListing($params)
    {
        $asmt_key = $params['roy_pk'];
        $fiterArray = [
            'vehiclenumber' => 'rvrd_vechicleregno',
            'chassisnumber' => 'rvrd_chassisno',
            'ownername'=>'rs.rvod_ownername_en',
            'status'=>'rvrd_inspectionstatus',
            'royaltypaid' => 'fsm_fee'
        ];
        $fee = RoyaltyandasmtfeeTbl::find()->select(['rasf_feesubscriptionmst_fk as roy_pk'])->where(['royaltyandasmtfee_pk' => $asmt_key])->asArray()->one();
        if(empty($fee)){
            $fee = RoyaltyandasmtfeehstyTbl::find()->select('rasfh_feesubscriptionmst_fk as roy_pk')->where(['rasfh_royaltyandasmtfee_fk' => $asmt_key])->asArray()->one();
        }
        $fee_pk = $fee['roy_pk'];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_rasvehicleregdtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $asmt_key")->queryOne();
        if(!empty($learnerIds['lavd_rasvehicleregdtls_fk'])){
            $model = RasvehicleregdtlsTbl::find()->alias('ve')->select([
                'rvrd_vechicleregno AS vehiclenumber',
                'rvrd_chassisno AS chassisnumber',
                'rs.rvod_ownername_en AS ownername_en',
                'rs.rvod_ownername_ar AS ownername_ar',
                'fsm_fee as royaltypaid',
                'rvrd_inspectionstatus as status',
            ])
            ->leftJoin('rasvehicleownerdtls_tbl rs','rs.rasvehicleownerdtls_pk = ve.rvrd_rasvehicleownerdtls_fk')
            ->leftJoin('feesubscriptionmst_tbl', "feesubscriptionmst_pk = $fee_pk")
            ->andwhere(['IN','rasvehicleregdtls_pk', explode(', ',$learnerIds['lavd_rasvehicleregdtls_fk'])]);
            // echo $model->createCommand()->getRawSql(); die('');
            if(!empty($params['searchkey'])){
                $data = $params['searchkey'];
                if($data['chassisnumber']){
                    $model->andFilterWhere(['LIKE', 'rvrd_chassisno', $data['chassisnumber']]);
                }
                if($data['vehiclenumber']){
                    $model->andFilterWhere(['LIKE', 'rvrd_vechicleregno', $data['vehiclenumber']]);
                }
                if($data['ownername']){
                    $model->andFilterWhere([
                        'OR',
                        ['LIKE', 'rs.rvod_ownername_en', $data['ownername']],
                        ['LIKE', 'rs.rvod_ownername_ar', $data['ownername']],
                    ]);
                }
                if($data['vehistatus']){
                    $model->andFilterWhere(['IN', 'rvrd_inspectionstatus', $data['vehistatus']]);
                }
                if($data['royaltypaid']){
                    $model->andFilterWhere(['LIKE', 'royaltypaid', $data['royaltypaid']]);
                }
            }

            $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
            if($sort_column){
                $order_by = ($params['sort']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }

            $model->asArray();
            $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
            
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $params['index']
                ],
            ]);

            $finalAry = $provider->getModels();
            $tcount = $provider->getTotalCount();
        }else{
            $finalAry = [];
            $page =0;
            $tcount = 0;
        }
        
        $response['totalcount'] =$tcount ;
        $response['size'] = $page;
        $response['data'] = $finalAry;
        return $response;
    }
    
    public static function ivmsvehicleListing($params)
    {
        $asmt_key = $params['roy_pk'];
        $fiterArray = [
            'vehiclenumber' => 'ivrd_vehiclefleetno',
            'chassisnumber' => 'ivrd_chassisno',
            'ownername'=>'rs.rvod_ownername_en',
            'status'=>'ivrd_inspectionstatus',
            'royaltypaid' => 'fsm_fee',
            'modelno' => 'appdim_modelno'
        ];
        $fee = RoyaltyandasmtfeeTbl::find()->select(['rasf_feesubscriptionmst_fk as roy_pk'])->where(['royaltyandasmtfee_pk' => $asmt_key])->asArray()->one();
        if(empty($fee)){
            $fee = RoyaltyandasmtfeehstyTbl::find()->select('rasfh_feesubscriptionmst_fk as roy_pk')->where(['rasfh_royaltyandasmtfee_fk' => $asmt_key])->asArray()->one();
        }
        $fee_pk = $fee['roy_pk'];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_rasvehicleregdtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $asmt_key")->queryOne();
        if(!empty($learnerIds['lavd_rasvehicleregdtls_fk'])){
            $model = IvmsvehicleregdtlsTbl::find()->alias('ve')->select([
                'ivrd_vehiclefleetno AS vehiclenumber',
                'ivrd_chassisno AS chassisnumber',
                'rs.rvod_ownername_en AS ownername_en',
                'rs.rvod_ownername_ar AS ownername_ar',
                'fsm_fee as royaltypaid',
                'ivrd_inspectionstatus as status',
                'appdim_modelno as modelno'
            ])
            ->leftJoin('rasvehicleownerdtls_tbl rs','rs.rasvehicleownerdtls_pk = ve.ivrd_rasvehicleownerdtls_fk')
            ->leftJoin('appdeviceinfomain_tbl','appdeviceinfomain_pk = ve.ivrd_appdeviceinfomain_fk')
            ->leftJoin('feesubscriptionmst_tbl', "feesubscriptionmst_pk = $fee_pk")
            ->andwhere(['IN','ivmsvehicleregdtls_pk', explode(', ',$learnerIds['lavd_rasvehicleregdtls_fk'])]);
            // echo $model->createCommand()->getRawSql(); die('');
            if(!empty($params['searchkey'])){
                $data = $params['searchkey'];
                if($data['chassisnumber']){
                    $model->andFilterWhere(['LIKE', 'ivrd_chassisno', $data['chassisnumber']]);
                }
                if($data['vehiclenumber']){
                    $model->andFilterWhere(['LIKE', 'ivrd_vehiclefleetno', $data['vehiclenumber']]);
                }
                if($data['ownername']){
                    $model->andFilterWhere([
                        'OR',
                        ['LIKE', 'rs.rvod_ownername_en', $data['ownername']],
                        ['LIKE', 'rs.rvod_ownername_ar', $data['ownername']],
                    ]);
                }
                if($data['vehistatus']){
                    $model->andFilterWhere(['IN', 'ivrd_inspectionstatus', $data['vehistatus']]);
                }
                if($data['royaltypaid']){
                    $model->andFilterWhere(['LIKE', 'royaltypaid', $data['royaltypaid']]);
                }
                if($data['modelno']){
                    $model->andFilterWhere(['LIKE', 'appdim_modelno', $data['modelno']]);
                }
            }

            $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
            if($sort_column){
                $order_by = ($params['sort']=='asc')? 'asc': 'desc';
                $model->orderBy("$sort_column $order_by");
            }

            $model->asArray();
            $page = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
            
            $provider = new \yii\data\ActiveDataProvider([
                'query' => $model,
                'pagination' => [
                    'pageSize' => $page,
                    'page' => $params['index']
                ],
            ]);

            $finalAry = $provider->getModels();
            $tcount = $provider->getTotalCount();
        }else{
            $finalAry = [];
            $page =0;
            $tcount = 0;
        }
        
        $response['totalcount'] =$tcount ;
        $response['size'] = $page;
        $response['data'] = $finalAry;
        return $response;
    }
    public static function downloadSingleRoyaltyQuery($params){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $params])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $invoiceno = 'rasf_invoiceno';
            $fee_fk = 'rasf_feesubscriptionmst_fk';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $paidBy = 'rasf_paidby';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $fee_fk = 'rasfh_feesubscriptionmst_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $appdecon = 'rasfh_appdecon';
            $appdecComments =  'rasfh_appdecComments';
            $appdecby = 'rasfh_appdecby';
            $paidBy = 'rasfh_paidby';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model = $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        "$fee_fk",
        'apcourdtlsTmp.appcoursedtlstmp_pk',
        "$invoicedamount as invoicedamount","$vatamount as vatamount",
        'appcdt_standardcoursemst_fk',
        'omrm_opalmembershipregnumber','scm_coursename_en','scm_coursename_ar',
        'appocm_coursename_en','appocm_coursename_ar',
        'omrm_opalmembershipregnumber as opalmember',
        'appcdt_appoffercoursemain_fk',
        "$pymtstatus as paymentstatus",
        'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
        'omrm_tpname_en as trainingprovider_en','omrm_tpname_ar as trainingprovider_ar',
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        "(CASE WHEN appinsinfo.appiim_officetype = 1 THEN 'Main Office' WHEN appinsinfo.appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
        "$totrecord as totallearner",
        "DATE_FORMAT($invoiceexpiry,'%d-%m-%Y') as invoiceexpiry",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus = 2 THEN DATEDIFF(CURRENT_DATE, $invoiceexpiry) WHEN $pymtstatus = 4 THEN DATEDIFF(CURRENT_DATE, $invoiceexpiry) ELSE '0' END) as invoiceage",
        "DATE_FORMAT($createdon,'%d-%m-%Y') as invoicedate",
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as paymentdate",
        'osm_statename_en as state_en','osm_statename_ar as state_ar',
        'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'

        ])
        ->leftJoin('appcoursedtlsmain_tbl apcourdtls',"apcourdtls.AppCourseDtlsMain_PK = $appcoursedtlsmain_fk")
        ->leftJoin('appcoursedtlstmp_tbl apcourdtlsTmp','apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK')
        ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK')
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk')
        ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
        ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->where(["$royaltyandasmtfee_pk" => $params])
        ->asArray()->one();

        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_learnerreghrddtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $params")->queryOne();
        if(!empty($learnerIds['lavd_learnerreghrddtls_fk'])){
            $learner = LearnerreghrddtlsTbl::find()->alias('le')->select([
                'learnerreghrddtls_pk',
                'Irhd_emailid AS LearnerEmail',
                's.sir_idnumber AS LearnerID',
                's.sir_name_en AS LearnerName',
                's.sir_mobnum AS LearnerNumber',
                's.sir_idnumber AS civilnum',
                'bmd_Batchno AS BatchNumber',
                'lrhd_learnerfee as trainingFee',
                'ccm_catname_en AS Category',
                "(CASE
                WHEN lrhd_status = 1 THEN 'New'
                WHEN lrhd_status = 2 THEN 'Teaching(theory)'
                WHEN lrhd_status = 3 THEN 'Teaching(practical)'
                WHEN lrhd_status = 4 THEN 'No Show(theory)'
                WHEN lrhd_status = 5 THEN 'No Show(practical)'
                WHEN lrhd_status = 6 THEN 'Assessment'
                WHEN lrhd_status = 7 THEN 'Quality Check'
                WHEN lrhd_status = 8 THEN 'Declined during Quality Check'
                WHEN lrhd_status = 9 THEN 'Resubmitted for Quality Check'
                WHEN lrhd_status = 10 THEN 'Print'
                WHEN lrhd_status = 11 THEN 'Completed'
                WHEN lrhd_status = 12 THEN 'Retake Assessment'
                WHEN lrhd_status = 13 THEN 'Registration Cancelled'
            END) AS 'LearnerStage'",
            'fsm_fee AS assessmentfee',
            'type.rm_name_en as type_en','type.rm_name_ar as type_ar',
            'lang.rm_name_en as lang_en','lang.rm_name_ar as lang_ar',
            'appiim_branchname_en','appiim_branchname_ar',
            'bmah_assessmentdate',
            'c.oum_firstname as assessor',
            'f.omrm_tpname_en AS AssessmentCentre',
            '(CASE
                WHEN bmth_startdate = bmth_enddate THEN bmth_enddate
                WHEN bmth_startdate != bmth_enddate THEN CONCAT(bmth_enddate, "-" ,bmth_enddate)
                END) AS DateTheory',
            '(CASE
                WHEN bmph_startdate = bmph_enddate THEN bmph_enddate
                WHEN bmph_startdate != bmph_enddate THEN CONCAT(bmph_startdate, "-",bmph_enddate)
                ELSE "-"
            END) AS DatePractical',
            '(case 
                when k.lasmth_status = 42 then "Competent" 
                when k.lasmth_status = 40 then "Fail" 
                when k.lasmth_status = 43 then "Non-Competent" 
                when k.lasmth_status = 39 then "Pass" 
                when k.lasmth_status = 41 then "Pending" 
            end) AS KnowledgeAssessmentPassingStatus',
            '(case 
                when l.lasmth_status = 42 then "Competent" 
                when l.lasmth_status = 40 then "Fail" 
                when l.lasmth_status = 43 then "Non-Competent" 
                when l.lasmth_status = 39 then "Pass" 
                when l.lasmth_status = 41 then "Pending" 
            end) AS PracticalAssessmentPassingStatus',
            'k.lasmth_marksecured AS KnowledgeAssessmentScore',
            'l.lasmth_marksecured AS PracticalAssessmentScore',
            'h.oum_firstname AS TutorTeaching',
            'i.oum_firstname AS TutorPractical',
            'j.oum_firstname AS IQA',
            'SUBSTRING_INDEX(group_concat(lcd_verificationno order by learnercarddtls_pk desc SEPARATOR ","), ",",1) AS VerficationNumber',

            ])->leftJoin('staffinforepo_tbl s','s.staffinforepo_pk = le.lrhd_staffinforepo_fk')
            ->leftJoin('batchmgmtdtls_tbl bmd','bmd.batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
            ->leftJoin('batchmgmtasmtdtls_tbl', 'bmad_learnerreghrddtls_fk = le.learnerreghrddtls_pk')
            ->leftJoin('feesubscriptionmst_tbl',"feesubscriptionmst_pk = $model[$fee_fk]")
            ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk AND bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = bmah_assessor')
            ->leftjoin('referencemst_tbl type','type.referencemst_pk = bmd_batchtype AND type.rm_mastertype=9')
            ->leftjoin('referencemst_tbl lang','lang.referencemst_pk = bmd_traininglang AND lang.rm_mastertype=10')
            ->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = bmd_appinstinfomain_fk')
            ->leftjoin('batchmgmtpractdtls_tbl','bmpd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftjoin('batchmgmtthydtls_tbl','bmtd_learnerreghrddtls_fk = le.learnerreghrddtls_pk')
            ->leftjoin('batchmgmtpracthdr_tbl','batchmgmtpracthdr_pk = bmpd_batchmgmtpracthdr_fk AND bmph_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftjoin('learnerasmthdr_tbl k', 'learnerreghrddtls_pk = k.lasmth_learnerreghrddtls_fk and k.lasmth_assessmentmst_fk in (select m.AssessmentMst_PK from assessmentmst_tbl m where m.asmtm_internalasmt = 1)')
            ->leftjoin('learnerasmthdr_tbl l', 'learnerreghrddtls_pk = l.lasmth_learnerreghrddtls_fk and l.lasmth_assessmentmst_fk in (select n.AssessmentMst_PK from assessmentmst_tbl n where n.asmtm_internalasmt = 2)')
            ->leftjoin('batchmgmtthyhdr_tbl','batchmgmtthyhdr_pk = bmtd_batchmgmtthyhdr_fk AND bmth_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftjoin('opalusermst_tbl h','h.opalusermst_pk = bmth_tutor')
            ->leftjoin('opalusermst_tbl i','i.opalusermst_pk = bmph_tutor')
            ->leftjoin('opalusermst_tbl j','j.opalusermst_pk = bmah_ivqastaff')
            ->leftjoin('learnercarddtls_tbl','lcd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftjoin('opalmemberregmst_tbl f','f.opalmemberregmst_pk = c.oum_opalmemberregmst_fk')
            ->leftjoin('standardcoursedtls_tbl','standardcoursedtls_pk = bmd_standardcoursedtls_fk')
            ->leftjoin('coursecategorymst_tbl','coursecategorymst_pk = scd_subcoursecategorymst_fk')
            ->andwhere(['IN','learnerreghrddtls_pk', explode(', ',$learnerIds['lavd_learnerreghrddtls_fk'])])
            ->groupBy('learnerreghrddtls_pk');
        }      
        // echo $learner->createCommand()->getRawSql(); die('');

        $model['learner'] = $learner->asArray()->all();
        // echo'<pre>';print_r($learnerIds);die('test');

        return $model;
    }
    public static function downloadSingleAssesmentRecord($asmnt_pk){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $asmnt_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';

            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $appdecon = 'rasfh_appdecon';
            $appdecComments =  'rasfh_appdecComments';
            $appdecby = 'rasfh_appdecby';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model = $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        'apcourdtlsTmp.appcoursedtlstmp_pk',
        "$invoicedamount as invoicedamount","$vatamount as vatamount",
        'appcdt_standardcoursemst_fk',
        'omrm_opalmembershipregnumber','scm_coursename_en','scm_coursename_ar',
        'appocm_coursename_en','appocm_coursename_ar',
        'omrm_opalmembershipregnumber as opalmember',
        'appcdt_appoffercoursemain_fk',
        "$pymtstatus as paymentstatus",
        "DATE_FORMAT($invoiceexpiry,'%d-%m-%Y') as invoiceexpiry",
        'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
        'omrm_tpname_en as trainingprovider_en','omrm_tpname_ar as trainingprovider_ar',
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        '(CASE WHEN appinsinfo.appiim_officetype = 1 THEN "Main Office" WHEN appinsinfo.appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        "$totrecord as totallearner",
        "(COALESCE($invoicedamount, 0) + COALESCE($vatamount, 0)) AS invoiceamount",
        "(CASE WHEN $pymtstatus != 2 AND $pymtstatus != 4 THEN DATEDIFF(CURRENT_DATE, $createdon) ELSE '0' END) as invoiceage",
        "DATE_FORMAT($createdon,'%d-%m-%Y') as invoicedate",
        "DATE_FORMAT($dateofpymt,'%d-%m-%Y') as paymentdate",
        'osm_statename_en as state_en','osm_statename_ar as state_ar',
        'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
        "DATE_FORMAT($appdecon,'%d-%m-%Y') as rasf_appdecon","$appdecComments as rasf_appdecComments","$pymtstatus as rasf_pymtstatus",'oum_firstname as confirmedBy'

        ])
        ->leftJoin('appcoursedtlsmain_tbl apcourdtls',"apcourdtls.AppCourseDtlsMain_PK = $appcoursedtlsmain_fk")
        ->leftJoin('appcoursedtlstmp_tbl apcourdtlsTmp','apcourdtlsTmp.appcoursedtlstmp_pk = apcourdtls.appcdm_AppCourseDtlsTmp_FK')
        ->leftJoin('standardcoursemst_tbl stdcour','stdcour.standardcoursemst_pk = apcourdtlsTmp.appcdt_standardcoursemst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = apcourdtls.appcdm_OpalMemberRegMst_FK')
        ->leftJoin('appinstinfomain_tbl appinsinfo','appinsinfo.appinstinfomain_pk = apcourdtls.appcdm_appinstinfomain_fk')
        ->leftJoin('appoffercoursemain_tbl appoffer','appoffer.appoffercoursemain_pk = apcourdtls.appcdm_appoffercoursemain_fk')
        ->leftJoin('coursecategorymst_tbl courcatstd','courcatstd.coursecategorymst_pk = stdcour.scm_coursecategorymst_fk')
        ->leftJoin('coursecategorymst_tbl courcatofr','courcatofr.coursecategorymst_pk = appoffer.appocm_coursecategorymst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = opalmem.omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = opalmem.omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->where(["$royaltyandasmtfee_pk" => $asmnt_pk])
        ->asArray()->one();
        // echo $model->createCommand()->getRawSql(); die('');

        // echo'<pre>';print_r($model);die('dieeeee');
        // $asmt_key = $params['asmnt_pk'];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_learnerreghrddtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $asmnt_pk")->queryOne();
        // echo'<pre>';print_r($learnerIds);die('dieeeee');

        if(!empty($learnerIds['lavd_learnerreghrddtls_fk'])){
            // $baches = LearnerreghrddtlsTbl::find()->alias('le')->select([
            //     'learnerreghrddtls_pk',
            //     'Irhd_emailid AS LearnerEmail',
            //     's.sir_idnumber AS LearnerID',
            //     's.sir_name_en AS LearnerName',
            //     's.sir_mobnum AS LearnerNumber',
            //     's.sir_idnumber AS civilnum',
            //     'bmd_Batchno AS BatchNumber',
            //     'lrhd_learnerfee as trainingFee',
            //     "(CASE
            //     WHEN lrhd_status = 1 THEN 'New'
            //     WHEN lrhd_status = 2 THEN 'Teaching(theory)'
            //     WHEN lrhd_status = 3 THEN 'Teaching(practical)'
            //     WHEN lrhd_status = 4 THEN 'No Show(theory)'
            //     WHEN lrhd_status = 5 THEN 'No Show(practical)'
            //     WHEN lrhd_status = 6 THEN 'Assessment'
            //     WHEN lrhd_status = 7 THEN 'Quality Check'
            //     WHEN lrhd_status = 8 THEN 'Declined during Quality Check'
            //     WHEN lrhd_status = 9 THEN 'Resubmitted for Quality Check'
            //     WHEN lrhd_status = 10 THEN 'Print'
            //     WHEN lrhd_status = 11 THEN 'Completed'
            //     WHEN lrhd_status = 12 THEN 'Retake Assessment'
            //     WHEN lrhd_status = 13 THEN 'Registration Cancelled'
            // END) AS 'LearnerStage'",
            // 'fsm_fee AS assessmentfee'
            // ])->leftJoin('staffinforepo_tbl s','s.staffinforepo_pk = le.lrhd_staffinforepo_fk')
            // ->leftJoin('batchmgmtdtls_tbl bmd','bmd.batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
            // ->leftJoin('feesubscriptionmst_tbl on fsm_projectmst_fk =  le.Irhd_projectmst_fk AND fsm_feestype = 5 AND fsm_status = 1 and fsm_standardcoursedtls_fk=bmd_standardcoursedtls_fk and fsm_applicationtype = (case when bmd_batchtype = 24 then 1 when bmd_batchtype = 25 then 4 end)')
            // ->andwhere(['IN','learnerreghrddtls_pk', explode(', ',$learnerIds['lavd_learnerreghrddtls_fk'])]);
            $batches = LearnerreghrddtlsTbl::find()->alias('le')->select([
                'learnerreghrddtls_pk',
                'Irhd_emailid AS LearnerEmail',
                's.sir_idnumber AS LearnerID',
                's.sir_name_en AS LearnerName',
                's.sir_mobnum AS LearnerNumber',
                's.sir_idnumber AS civilnum',
                'bmd_Batchno AS BatchNumber',
                'lrhd_learnerfee as trainingFee',
                'ccm_catname_en AS Category',
                "(CASE
                WHEN lrhd_status = 1 THEN 'New'
                WHEN lrhd_status = 2 THEN 'Teaching(theory)'
                WHEN lrhd_status = 3 THEN 'Teaching(practical)'
                WHEN lrhd_status = 4 THEN 'No Show(theory)'
                WHEN lrhd_status = 5 THEN 'No Show(practical)'
                WHEN lrhd_status = 6 THEN 'Assessment'
                WHEN lrhd_status = 7 THEN 'Quality Check'
                WHEN lrhd_status = 8 THEN 'Declined during Quality Check'
                WHEN lrhd_status = 9 THEN 'Resubmitted for Quality Check'
                WHEN lrhd_status = 10 THEN 'Print'
                WHEN lrhd_status = 11 THEN 'Completed'
                WHEN lrhd_status = 12 THEN 'Retake Assessment'
                WHEN lrhd_status = 13 THEN 'Registration Cancelled'
            END) AS 'LearnerStage'",
            'fsm_fee AS assessmentfee',
            'type.rm_name_en as type_en','type.rm_name_ar as type_ar',
            'lang.rm_name_en as lang_en','lang.rm_name_ar as lang_ar',
            'appiim_branchname_en','appiim_branchname_ar',
            'bmah_assessmentdate',
            'c.oum_firstname as assessor',
            'f.omrm_tpname_en AS AssessmentCentre',
            '(CASE
                WHEN bmth_startdate = bmth_enddate THEN bmth_enddate
                WHEN bmth_startdate != bmth_enddate THEN CONCAT(bmth_enddate, "-" ,bmth_enddate)
                END) AS DateTheory',
            '(CASE
                WHEN bmph_startdate = bmph_enddate THEN bmph_enddate
                WHEN bmph_startdate != bmph_enddate THEN CONCAT(bmph_startdate, "-",bmph_enddate)
                ELSE "-"
            END) AS DatePractical',
            '(case 
                when k.lasmth_status = 42 then "Competent" 
                when k.lasmth_status = 40 then "Fail" 
                when k.lasmth_status = 43 then "Non-Competent" 
                when k.lasmth_status = 39 then "Pass" 
                when k.lasmth_status = 41 then "Pending" 
            end) AS KnowledgeAssessmentPassingStatus',
            '(case 
                when l.lasmth_status = 42 then "Competent" 
                when l.lasmth_status = 40 then "Fail" 
                when l.lasmth_status = 43 then "Non-Competent" 
                when l.lasmth_status = 39 then "Pass" 
                when l.lasmth_status = 41 then "Pending" 
            end) AS PracticalAssessmentPassingStatus',
            'k.lasmth_marksecured AS KnowledgeAssessmentScore',
            'l.lasmth_marksecured AS PracticalAssessmentScore',
            'h.oum_firstname AS TutorTeaching',
            'i.oum_firstname AS TutorPractical',
            'j.oum_firstname AS IQA',
            'SUBSTRING_INDEX(group_concat(lcd_verificationno order by learnercarddtls_pk desc SEPARATOR ","), ",",1) AS VerficationNumber',

            ])->leftJoin('staffinforepo_tbl s','s.staffinforepo_pk = le.lrhd_staffinforepo_fk')
            ->leftJoin('batchmgmtdtls_tbl bmd','bmd.batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
            ->leftJoin('batchmgmtasmtdtls_tbl', 'bmad_learnerreghrddtls_fk = le.learnerreghrddtls_pk')
            ->leftJoin('feesubscriptionmst_tbl on fsm_projectmst_fk =  le.Irhd_projectmst_fk AND fsm_feestype = 5 AND fsm_status = 1 and fsm_standardcoursedtls_fk=bmd_standardcoursedtls_fk and fsm_applicationtype = (case when bmd_batchtype = 24 then 1 when bmd_batchtype = 25 then 4 end)')
            ->leftJoin('batchmgmtasmthdr_tbl', 'batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk AND bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = bmah_assessor')
            ->leftjoin('referencemst_tbl type','type.referencemst_pk = bmd_batchtype AND type.rm_mastertype=9')
            ->leftjoin('referencemst_tbl lang','lang.referencemst_pk = bmd_traininglang AND lang.rm_mastertype=10')
            ->leftjoin('appinstinfomain_tbl','appinstinfomain_pk = bmd_appinstinfomain_fk')
            ->leftjoin('batchmgmtpractdtls_tbl','bmpd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftjoin('batchmgmtthydtls_tbl','bmtd_learnerreghrddtls_fk = le.learnerreghrddtls_pk')
            ->leftjoin('batchmgmtpracthdr_tbl','batchmgmtpracthdr_pk = bmpd_batchmgmtpracthdr_fk AND bmph_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftjoin('learnerasmthdr_tbl k', 'learnerreghrddtls_pk = k.lasmth_learnerreghrddtls_fk and k.lasmth_assessmentmst_fk in (select m.AssessmentMst_PK from assessmentmst_tbl m where m.asmtm_internalasmt = 1)')
            ->leftjoin('learnerasmthdr_tbl l', 'learnerreghrddtls_pk = l.lasmth_learnerreghrddtls_fk and l.lasmth_assessmentmst_fk in (select n.AssessmentMst_PK from assessmentmst_tbl n where n.asmtm_internalasmt = 2)')
            ->leftjoin('batchmgmtthyhdr_tbl','batchmgmtthyhdr_pk = bmtd_batchmgmtthyhdr_fk AND bmth_batchmgmtdtls_fk = batchmgmtdtls_pk')
            ->leftjoin('opalusermst_tbl h','h.opalusermst_pk = bmth_tutor')
            ->leftjoin('opalusermst_tbl i','i.opalusermst_pk = bmph_tutor')
            ->leftjoin('opalusermst_tbl j','j.opalusermst_pk = bmah_ivqastaff')
            ->leftjoin('learnercarddtls_tbl','lcd_learnerreghrddtls_fk = learnerreghrddtls_pk')
            ->leftjoin('opalmemberregmst_tbl f','f.opalmemberregmst_pk = c.oum_opalmemberregmst_fk')
            ->leftjoin('standardcoursedtls_tbl','standardcoursedtls_pk = bmd_standardcoursedtls_fk')
            ->leftjoin('coursecategorymst_tbl','coursecategorymst_pk = scd_subcoursecategorymst_fk')
            ->andwhere(['IN','learnerreghrddtls_pk', explode(', ',$learnerIds['lavd_learnerreghrddtls_fk'])])
            ->groupBy('learnerreghrddtls_pk');
        }
        $model['batches'] = $batches->asArray()->all();

        return $model;
    }
    
    public static function downloadSingleTechRoyalty($roy_pk){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $roy_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $paidBy = 'rasf_paidby';
            $projectPk = "rasf_projectmst_fk";
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $paidBy = 'rasfh_paidby';
            $projectPk = "rasfh_projectmst_fk";
            $appdecon = 'rasfh_appdecon';
            $appdecby = 'rasfh_appdecby';
            $appdecComments =  'rasfh_appdecComments';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        '(CASE WHEN appiim_officetype = 1 THEN "Main Office" WHEN appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        'omrm_branch_en as trainingprovider_en','omrm_branch_en as trainingprovider_ar', //centre name
        ])
        ->leftjoin('projectmst_tbl pro',"pro.projectmst_pk = $projectPk")
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->andWhere([
            'AND',
            ["$feetype" => 1],
            ["$royaltyandasmtfee_pk" => $roy_pk]
        ]);

        $model= $model->asArray()->one();
        $model['vehicle']=[];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_rasvehicleregdtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $roy_pk")->queryOne();
        if(!empty($learnerIds['lavd_rasvehicleregdtls_fk'])){
            $vehicle = RasvehicleregdtlsTbl::find()->alias('ve')->select([
                'rvod_crnumber',
                'rs.rvod_ownername_en AS ownername_en',
                'rs.rvod_ownername_ar AS ownername_ar',
                'rvrd_vechicleregno AS vehiclenumber',
                'rvrd_chassisno AS chassisnumber',
                'rvrd_ivmsserialno as serial_no',
                'rvrd_speedlimitno as speed_limit',
                'rcm_coursesubcatname_en as vehicle_cat',
                'rvrd_vechiclefleetno as vehicle_fleet',
                'rm_name_en as roadtype',
                'rvrd_firstropregdate',
                'rvrd_modelyear',
                'rvrd_dateofinsp',
                'DATE_FORMAT(rvrd_inspstarttime,"%m/%d/%Y %h:%i") as rvrd_inspstarttime',
                'DATE_FORMAT(rvrd_inspendtime,"%m/%d/%Y %h:%i") as rvrd_inspendtime',
                'c.oum_firstname as inspectorname',
                'rvrd_applicationrefno',
                'rvrd_dateofexpiry',
                'rvrd_inspectionstatus',
            ])
            ->leftJoin('rasvehicleownerdtls_tbl rs','rs.rasvehicleownerdtls_pk = ve.rvrd_rasvehicleownerdtls_fk')
            ->leftJoin('rascategorymst_tbl','rascategorymst_pk = ve.rvrd_vechiclecat')
            ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = rvrd_inspectorname')
            ->leftJoin('referencemst_tbl', 'referencemst_pk = rvrd_roadtype AND rm_mastertype = 16')
            ->andwhere(['IN','rasvehicleregdtls_pk', explode(', ',$learnerIds['lavd_rasvehicleregdtls_fk'])]);
            $model['vehicle'] = $vehicle->asArray()->all();
        }

        return $model;
    }

    public static function downloadSingleTechIvms($roy_pk){

        $check = RoyaltyandasmtfeeTbl::find()->where(['royaltyandasmtfee_pk' => $roy_pk])->one();
        if(!empty($check)){
            $royaltyandasmtfee_pk = 'royaltyandasmtfee_pk';
            $invoiceno = 'rasf_invoiceno';
            $pymtstatus ='rasf_pymtstatus';
            $totrecord = 'rasf_totrecord';
            $invoicedamount = 'rasf_invoicedamount';
            $vatamount = 'rasf_vatamount';
            $invoiceexpiry = 'rasf_invoiceexpiry';
            $createdon = 'rasf_createdon';
            $dateofpymt = 'rasf_dateofpymt';
            $appcoursedtlsmain_fk = 'rasf_appcoursedtlsmain_fk';
            $feetype = 'rasf_feetype';
            $raisedon = 'rasf_raisedon';
            $paidBy = 'rasf_paidby';
            $projectPk = "rasf_projectmst_fk";
            $appdecon = 'rasf_appdecon';
            $appdecby = 'rasf_appdecby';
            $appdecComments =  'rasf_appdecComments';
            $model = RoyaltyandasmtfeeTbl::find()->alias('rasf');

        }else{
            $royaltyandasmtfee_pk = 'rasfh_royaltyandasmtfee_fk';
            $invoiceno = 'rasfh_invoiceno';
            $pymtstatus ='rasfh_pymtstatus';
            $totrecord = 'rasfh_totrecord';
            $invoicedamount = 'rasfh_invoicedamount';
            $vatamount = 'rasfh_vatamount';
            $invoiceexpiry = 'rasfh_invoiceexpiry';
            $createdon = 'rasfh_createdon';
            $dateofpymt = 'rasfh_dateofpymt';
            $appcoursedtlsmain_fk = 'rasfh_appcoursedtlsmain_fk';
            $feetype = 'rasfh_feetype';
            $raisedon = 'rasfh_raisedon';
            $paidBy = 'rasfh_paidby';
            $projectPk = "rasfh_projectmst_fk";
            $appdecon = 'rasfh_appdecon';
            $appdecby = 'rasfh_appdecby';
            $appdecComments =  'rasfh_appdecComments';
            $model = RoyaltyandasmtfeehstyTbl::find()->alias('rasf');

        }

        $model->select(["$invoiceno as invoiceno",
        "$royaltyandasmtfee_pk as roy_pk",
        'appiim_branchname_en as branchname_en','appiim_branchname_ar as branchname_ar',
        '(CASE WHEN appiim_officetype = 1 THEN "Main Office" WHEN appiim_officetype = 2 THEN "Branch Office" ELSE "-" END) as officetype',
        'omrm_branch_en as trainingprovider_en','omrm_branch_en as trainingprovider_ar', //centre name
        ])
        ->leftjoin('projectmst_tbl pro',"pro.projectmst_pk = $projectPk")
        ->leftJoin('appinstinfomain_tbl appinsinfo',"appinsinfo.appinstinfomain_pk = $paidBy")
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appiim_opalmemberregmst_fk')
        ->leftJoin('opalusermst_tbl user',"user.opalusermst_pk = $appdecby")

        ->andWhere([
            'AND',
            ["$feetype" => 1],
            ["$royaltyandasmtfee_pk" => $roy_pk]
        ]);

        $model= $model->asArray()->one();
        $model['vehicle']=[];
        $learnerIds = \Yii::$app->db->createCommand("SELECT `lavd_rasvehicleregdtls_fk` FROM `leanerandvehicledtls_tbl` WHERE `lavd_royaltyandasmtfee_fk`= $roy_pk")->queryOne();
        if(!empty($learnerIds['lavd_rasvehicleregdtls_fk'])){
            
            $vehicle = IvmsvehicleregdtlsTbl::find()->alias('ve')->select([
                'rvod_crnumber',
                'rs.rvod_ownername_en AS ownername_en',
                'rs.rvod_ownername_ar AS ownername_ar',
                'ivrd_vechicleregno AS vehiclenumber',
                'ivrd_chassisno AS chassisnumber',
                'ivrd_ivmsserialno as serial_no',
                'ivrd_spdlimtseriealno as speed_limit',
                'cat.rcm_coursesubcatname_en as vehicle_cat',
                'subcat.rcm_coursesubcatname_en as vehicle_subcat',
                'ivrd_vehiclefleetno as vehicle_fleet',
                'manuname.rm_name_en as manufactor',
                'ivrd_firstropregdate',
                'ivrd_modelyear',
                'ivrd_dateoffiiting',
                'DATE_FORMAT(ivrd_inststarttime,"%m-%d-%Y %h:%i") as ivrd_inststarttime',
                'DATE_FORMAT(ivrd_instendtime,"%m-%d-%Y %h:%i") as ivrd_instendtime',
                'c.oum_firstname as inspectorname',
                'ivrd_dateofexpiry',
                'ivrd_inspectionstatus',
                'ivrd_verficationcode',
                'ivrd_softwareversion',
                'ivrd_deviceimeino',
                'appdim_modelno',
                'ivrd_contpermobno'
            ])
            ->leftJoin('rasvehicleownerdtls_tbl rs','rs.rasvehicleownerdtls_pk = ve.ivrd_rasvehicleownerdtls_fk')
            ->leftJoin('rascategorymst_tbl cat','cat.rascategorymst_pk = ve.ivrd_vechiclecat')
            ->leftJoin('appdeviceinfomain_tbl','appdeviceinfomain_pk = ve.ivrd_appdeviceinfomain_fk')
            ->leftJoin('rascategorymst_tbl subcat','subcat.rascategorymst_pk = ve.ivrd_vehiclesubcat')
            ->leftJoin('opalusermst_tbl c', 'c.opalusermst_pk = ivrd_Installername')
            ->leftJoin('referencemst_tbl manuname', 'manuname.referencemst_pk = ivrd_vehiclemanufname AND rm_mastertype = 17')
            ->andwhere(['IN','ivmsvehicleregdtls_pk', explode(', ',$learnerIds['lavd_rasvehicleregdtls_fk'])]);
        // echo $vehicle->createCommand()->getRawSql(); die('');

            $model['vehicle'] = $vehicle->asArray()->all();
        }

        return $model;
    }
}
