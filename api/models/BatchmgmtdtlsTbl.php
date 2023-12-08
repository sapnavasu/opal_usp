<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "batchmgmtdtls_tbl".
 *
 * @property int $batchmgmtdtls_pk primary key
 * @property int $bmd_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $bmd_appinstinfomain_fk Reference to appinstinfomain_pk
 * @property int $bmd_appcoursedtlsmain_fk Reference to appcoursedtlsmain_pk
 * @property int $bmd_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property string $bmd_Batchno
 * @property int $bmd_batchtype Reference to referencemst_pk where rm_mastertype=9
 * @property int $bmd_traininglang Reference to referencemst_pk where rm_mastertype=10
 * @property int $bmd_batchcount
 * @property string $bmd_comment Store Cancelled comments here, when a Batch is cancelled.
 * @property int $bmd_status 1-New, 2-Teaching(Theory),3-Teaching(practical), 4-Assessment, 6-Quality Check, 7-Cancelled, 8-Print
 * @property int $bmd_reqstatus 1 - Requested for Back Track, 2 - Requested for Assessor change, 3 - Assessor changed
 * @property string $bmd_createdon
 * @property int $bmd_createdby
 * @property string $bmd_updatedon
 * @property int $bmd_updatedby
 *
 * @property BatchmgmtasmtdtlsTbl[] $batchmgmtasmtdtlsTbls
 * @property BatchmgmtasmthdrTbl[] $batchmgmtasmthdrTbls
 * @property AppcoursedtlsmainTbl $bmdAppcoursedtlsmainFk
 * @property AppinstinfomainTbl $bmdAppinstinfomainFk
 * @property OpalmemberregmstTbl $bmdOpalmemberregmstFk
 * @property StandardcoursedtlsTbl $bmdStandardcoursedtlsFk
 * @property BatchmgmtdtlshstyTbl[] $batchmgmtdtlshstyTbls
 * @property BatchmgmtdurationdtlsTbl[] $batchmgmtdurationdtlsTbls
 * @property BatchmgmtpractdtlsTbl[] $batchmgmtpractdtlsTbls
 * @property BatchmgmtpracthdrTbl[] $batchmgmtpracthdrTbls
 * @property BatchmgmtthydtlsTbl[] $batchmgmtthydtlsTbls
 * @property BatchmgmtthyhdrTbl[] $batchmgmtthyhdrTbls
 * @property LearnerasmthdrTbl[] $learnerasmthdrTbls
 * @property LearnercarddtlsTbl[] $learnercarddtlsTbls
 * @property LearnercertgendtlsTbl[] $learnercertgendtlsTbls
 * @property LearnerreghrddtlsTbl[] $learnerreghrddtlsTbls
 * @property LearnerreghrddtlshstyTbl[] $learnerreghrddtlshstyTbls
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class BatchmgmtdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmd_opalmemberregmst_fk', 'bmd_appinstinfomain_fk', 'bmd_appcoursedtlsmain_fk', 'bmd_standardcoursedtls_fk', 'bmd_Batchno', 'bmd_batchtype', 'bmd_traininglang', 'bmd_batchcount', 'bmd_status', 'bmd_createdby'], 'required'],
            [['bmd_opalmemberregmst_fk', 'bmd_appinstinfomain_fk', 'bmd_appcoursedtlsmain_fk', 'bmd_standardcoursedtls_fk', 'bmd_batchtype', 'bmd_traininglang', 'bmd_batchcount', 'bmd_status', 'bmd_reqstatus', 'bmd_createdby', 'bmd_updatedby'], 'integer'],
            [['bmd_comment'], 'string'],
            [['bmd_createdon', 'bmd_updatedon'], 'safe'],
            [['bmd_Batchno'], 'string', 'max' => 100],
            [['bmd_appcoursedtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlsmainTbl::className(), 'targetAttribute' => ['bmd_appcoursedtlsmain_fk' => 'AppCourseDtlsMain_PK']],
            [['bmd_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['bmd_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['bmd_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['bmd_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['bmd_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['bmd_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtdtls_pk' => 'Batchmgmtdtls Pk',
            'bmd_opalmemberregmst_fk' => 'Bmd Opalmemberregmst Fk',
            'bmd_appinstinfomain_fk' => 'Bmd Appinstinfomain Fk',
            'bmd_appcoursedtlsmain_fk' => 'Bmd Appcoursedtlsmain Fk',
            'bmd_standardcoursedtls_fk' => 'Bmd Standardcoursedtls Fk',
            'bmd_Batchno' => 'Bmd  Batchno',
            'bmd_batchtype' => 'Bmd Batchtype',
            'bmd_traininglang' => 'Bmd Traininglang',
            'bmd_batchcount' => 'Bmd Batchcount',
            'bmd_comment' => 'Bmd Comment',
            'bmd_status' => 'Bmd Status',
            'bmd_reqstatus' => 'Bmd Reqstatus',
            'bmd_createdon' => 'Bmd Createdon',
            'bmd_createdby' => 'Bmd Createdby',
            'bmd_updatedon' => 'Bmd Updatedon',
            'bmd_updatedby' => 'Bmd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlsTbl::className(), ['bmad_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmthdrTbls()
    {
        return $this->hasMany(BatchmgmtasmthdrTbl::className(), ['bmah_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmdAppcoursedtlsmainFk()
    {
        return $this->hasOne(AppcoursedtlsmainTbl::className(), ['AppCourseDtlsMain_PK' => 'bmd_appcoursedtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmdAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'bmd_appinstinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmdOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'bmd_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmdStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'bmd_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdtlshstyTbl::className(), ['bmh_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlsTbl::className(), ['bmdd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlsTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlsTbl::className(), ['bmpd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpracthdrTbls()
    {
        return $this->hasMany(BatchmgmtpracthdrTbl::className(), ['bmph_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlsTbls()
    {
        return $this->hasMany(BatchmgmtthydtlsTbl::className(), ['bmtd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthyhdrTbls()
    {
        return $this->hasMany(BatchmgmtthyhdrTbl::className(), ['bmth_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrTbls()
    {
        return $this->hasMany(LearnerasmthdrTbl::className(), ['lasmth_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnercarddtlsTbls()
    {
        return $this->hasMany(LearnercarddtlsTbl::className(), ['lcd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnercertgendtlsTbls()
    {
        return $this->hasMany(LearnercertgendtlsTbl::className(), ['lcgd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerreghrddtlsTbls()
    {
        return $this->hasMany(LearnerreghrddtlsTbl::className(), ['lrhd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerreghrddtlshstyTbls()
    {
        return $this->hasMany(LearnerreghrddtlshstyTbl::className(), ['lrhh_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtdtlsTblQuery(get_called_class());
    }


    
    public static function saveBatchDtls($requestdata)
    {
         $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        
        $model = new BatchmgmtdtlsTbl();
        $model->bmd_appinstinfomain_fk = $requestdata['instinfopk'];
        $model->bmd_opalmemberregmst_fk = $requestdata['trainingevlocenter'];
        $model->bmd_appcoursedtlsmain_fk = $requestdata['coursedtlmainpk'];
        $model->bmd_standardcoursedtls_fk = $requestdata['stdcoursedtlsdltspk'];
        $model->bmd_batchtype = $requestdata['batchtype'];
        $model->bmd_statemst_fk = $requestdata['governorate']? $requestdata['governorate'] : null;
        $model->bmd_citymst_fk = $requestdata['wilayat']? $requestdata['wilayat'] : null;
        $model->bmd_traininglang = $requestdata['assmntlanauge'];
        $model->bmd_batchcount = $requestdata['theorybatchlimit'];
        $model->bmd_status = 1;
        $model->bmd_creationtype = 1;
        $model->bmd_Batchno = 'batchnum';
        $model->bmd_createdon = date('Y-m-d H:i:s');
        $model->bmd_createdby = $userpk;

    
        if($model->save())
        {
            return $model->batchmgmtdtls_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
                
                
    }
    
    public static function newBatchRefNo($coursedtlspk , $batchtype , $memregpk,$ismanual = null)
    {
       
        $opalregno = $memregpk == 0 ? 0 : OpalmemberregmstTbl::findOne($memregpk)->omrm_opalmembershipregnumber;
        
        $subcatpk = StandardcoursedtlsTbl::find()
                ->select(['ccm_subcatcode'])
                ->leftJoin('coursecategorymst_tbl', 'scd_subcoursecategorymst_fk = coursecategorymst_pk')
                ->where(['=','standardcoursedtls_pk', $coursedtlspk])
                ->asArray()->one()['ccm_subcatcode'];
         
      
                $getLastBatchRefNo = BatchmgmtdtlsTbl::find()
                ->select(['bmd_Batchno'])
                ->where(['=','bmd_creationtype', 1])
                ->andWhere(['<>','bmd_Batchno', 'batchnum'])
                ->asArray()               
                ->orderBy('batchmgmtdtls_pk DESC')
                ->one();
           
        $array = explode("-",$getLastBatchRefNo['bmd_Batchno']);
        if($array[3] && $array[2] ==  date('m').date('Y') || $array[3] && $array[2] ==  'M'.date('m').date('Y'))
        {
            $number = (int)$array[3] + 1;
        }
        else
        {
            $number = 001;
        }
        
        $num = sprintf("%03d", $number);
        $bType = $batchtype == 25 ? 'R':'I';
        $manvalue = ($ismanual != null) ? 'M':'';
        
       $refnumber = $subcatpk.$bType.'-'.$opalregno.'-'.$manvalue.date('m').date('Y').'-'.$num;
       
       return $refnumber;
       
    }
    public static function getBatchdataByRegPk($regPk,$limit,$index,$searchkey,$sort)
    {
        
        
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
         $allocatedprj = explode(',',\yii\db\ActiveRecord::getTokenData('oum_allocatedproject', true));
        $allocatecategory = explode(',',\yii\db\ActiveRecord::getTokenData('oum_standcoursemst_fk', true));
        
        $loginuserdtls = OpalusermstTbl::findOne($userpk);
       
       $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $model = BatchmgmtdtlsTbl::find()
                ->select(['bmd_Batchno as batch_no','bmd_opalmemberregmst_fk as regpk','n.omrm_tpname_en as tpname_en','n.omrm_tpname_ar as tpname_ar','bmd_batchtype','a.rm_name_ar as batch_type_ar','a.rm_name_en as batch_type','b.rm_name_ar as language_ar','b.rm_name_en as language','IF(appiim_officetype = 1, "Main Office", IF(appiim_officetype = 2, "Branch Office", "-")) as office_type','appiim_branchname_ar as branch_name_ar','appiim_branchname_en as branch_name','bmd_status as status','batchmgmtdtls_pk as id','bmth_batchcount as theorybatchcount','bmth_batchcount as theorybatchcount','bmph_batchcount as practbatchcount','IF(bmd_batchcount is not null, bmd_batchcount, 0) as batchcount','bmth_startdate as traintheorystart','bmth_enddate as traintheoryend','bmph_startdate as trainpractstart','bmph_enddate as trainpractend','bmah_assessmentdate as assessmentdate','bmah_assessstarttime as assessmentstart',' cast(bmah_assessendtime as time) as assessmentend','bmd_status as status','bmd_reqstatus as req_status','ccm_catname_en as category_en','ccm_catname_ar as category_ar','scd_subcoursecategorymst_fk','c.ocim_cityname_en as wilayat','d.osm_statename_en as state','bmah_assessor','group_concat(distinct(m.omrm_tpname_en)) as assessment_centre_en','group_concat(distinct(m.omrm_tpname_ar)) as assessment_centre_ar','group_concat(distinct(m.opalmemberregmst_pk)) as assessmentcentre','bmth_tutor','bmah_ivqastaff','bmd_traininglang','bmd_comment as comments','group_concat(sir_idnumber) as civilids'])
                ->leftJoin('referencemst_tbl a','a.referencemst_pk = bmd_batchtype')
                ->leftJoin('referencemst_tbl b','b.referencemst_pk = bmd_traininglang')
                ->leftJoin('appinstinfomain_tbl','appinstinfomain_pk = bmd_appinstinfomain_fk')
                ->leftJoin('batchmgmtthyhdr_tbl',' bmth_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtpracthdr_tbl','bmph_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtasmthdr_tbl','bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('standardcoursedtls_tbl','standardcoursedtls_pk = bmd_standardcoursedtls_fk')
                ->leftJoin('coursecategorymst_tbl','scd_subcoursecategorymst_fk = coursecategorymst_pk')
                ->leftJoin('appcompanydtlsmain_tbl','acdm_applicationdtlsmain_fk = appiim_applicationdtlsmain_fk')
                ->leftJoin('opalcitymst_tbl c','c.opalcitymst_pk = bmd_citymst_fk')
                ->leftJoin('opalstatemst_tbl d','d.opalstatemst_pk = bmd_statemst_fk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = bmah_assessor')
                
                ->leftJoin('learnerreghrddtls_tbl','lrhd_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('opalmemberregmst_tbl m','oum_opalmemberregmst_fk = m.opalmemberregmst_pk')
                ->leftJoin('opalmemberregmst_tbl n','bmd_opalmemberregmst_fk = n.opalmemberregmst_pk')
                ->leftJoin('staffinforepo_tbl','lrhd_staffinforepo_fk = staffinforepo_pk')
                ->groupBy('batchmgmtdtls_pk')
//                ->orderBy('bmd_createdon desc')
                ->where('bmd_Batchno is not null');
        
      
        if ($stktype == 2) {

            if ($loginuserdtls['oum_isfocalpoint'] == 1 && $loginuserdtls['oum_opalmemberregmst_fk'] == $regPk) {
                $model->having('(FIND_IN_SET('.$regPk.', assessmentcentre)) or bmd_opalmemberregmst_fk ='.$regPk);
            } else {
                $model->andWhere('bmth_tutor =' . $userpk . ' or bmph_tutor =' . $userpk . ' or bmah_assessor =' . $userpk . ' or bmah_ivqastaff =' . $userpk . ' or bmd_createdby =' . $userpk);
                
            }
      
        } else if (($stktype == 1)) {
            $model->andWhere(1);
        } else {
            $model->andWhere(0);
        }

  
        if(!empty($searchkey)){
            if(!empty($searchkey['batchno'])){
                 $model->andWhere(['Like', 'bmd_Batchno', $searchkey['batchno']]);
            }
             if(!empty($searchkey['batchtype'])){
                 $model->andWhere(['IN', 'bmd_batchtype', $searchkey['batchtype']]);
            }
            if(!empty($searchkey['officetype'])){
                 $model->andWhere(['IN', 'appiim_officetype', $searchkey['officetype']]);
            }
            if(!empty($searchkey['asssessmentcenter'])){
                 
                 $model->andWhere(['Like', 'm.omrm_tpname_en', trim($searchkey['asssessmentcenter'])]);
            }
            if(!empty($searchkey['trainingprovider'])){
                 $model->andWhere(['Like', 'n.omrm_tpname_en', $searchkey['trainingprovider']]);
            }
            if(!empty($searchkey['branchname'])){
                 $model->andWhere(['Like', 'appiim_branchname_en', $searchkey['branchname']]);
            }
            if(!empty($searchkey['totallearning'])){
                 $model->andWhere(['Like', 'bmd_Batchno', $searchkey['totallearning']]);
            }
             if(!empty($searchkey['remainingcapacity'])){
                 $model->andWhere(['Like', 'a.rm_name_en', $searchkey['remainingcapacity']]);
            }
            if(!empty($searchkey['assessmentwilayat'])){
                 $model->andWhere(['Like', 'c.ocim_cityname_en', $searchkey['assessmentwilayat']]);
            }
            if(!empty($searchkey['assessmentstate'])){
                 $model->andWhere(['Like', 'd.osm_statename_en', $searchkey['assessmentstate']]);
            }
            if(!empty($searchkey['categories'])){
              
                 $model->andWhere(['IN', 'scd_subcoursecategorymst_fk', $searchkey['categories']]);
            }
             if(!empty($searchkey['language'])){
                 $model->andWhere(['IN', 'bmd_traininglang', $searchkey['language']]);
            }
            if(!empty($searchkey['status'])){
                 $model->andWhere(['IN', 'bmd_status', $searchkey['status']]);   
            }
            if(!empty($searchkey['assessmentdatetime'])){
                 $model->andWhere('bmah_assessmentdate between "'.$searchkey['assessmentdatetime']['start'].'" and "'.$searchkey['assessmentdatetime']['end'].'"');   
                 
            }
            if(!empty($searchkey['trainingduration'])){
                 $model->andWhere('"'.$searchkey['trainingduration'].'" between bmth_startdate and bmth_enddate');   
                 
            }
            if(!empty($searchkey['trainingdurationpr'])){
                  $model->andWhere('"'.$searchkey['trainingdurationpr'].'" between bmph_startdate and bmph_enddate');   
                  
            }
        
            if(!empty($searchkey['formcontrolname'])){
                if($searchkey['formcontrolname'] == 'OGT'){
                    $model->andWhere(['NOT IN', 'bmd_status', [7,8]]);
                  
                }
                if($searchkey['formcontrolname'] == 'RCRR'){
                    $model->andWhere(['IN', 'bmd_reqstatus', [2]]);
                  
                }
                if($searchkey['formcontrolname'] == 'RFBT'){
                    $model->andWhere(['IN', 'bmd_reqstatus', [1]]);
                  
                }
                if($searchkey['formcontrolname'] == 'N'){
                  
                    $model->andWhere(['IN', 'bmd_status', [1]]);
                    $model->andWhere('bmd_opalmemberregmst_fk='.$regPk);
                  
                }
                if($searchkey['formcontrolname'] == 'T'){
                    $model->andWhere(['IN', 'bmd_status', [2,3]]);
                    $model->andWhere('bmd_opalmemberregmst_fk='.$regPk);
                  
                }
                if($searchkey['formcontrolname'] == 'YMFA'){
                    $model->andWhere('bmah_assessstarttime <= now()');
                    $model->andWhere(['NOT IN', 'bmd_status', [4,6,7,8]]);
                    $model->andWhere('bmd_opalmemberregmst_fk='.$regPk);
                  
                }
                if($searchkey['formcontrolname'] == 'A'){
                  $model->andWhere('bmd_opalmemberregmst_fk !='.$regPk.' and oum_opalmemberregmst_fk = '.$regPk); 
                  
                  
                }
                if($searchkey['formcontrolname'] == 'P'){
                    $model->andWhere(['IN', 'bmd_status', [4]]);
                    $model->andWhere('bmd_opalmemberregmst_fk='.$regPk.' or oum_opalmemberregmst_fk = '.$regPk);
                    $model->andWhere('bmah_assessmentdate = curdate()');
                    $model->andWhere('bmah_assessendtime < now()');
                  
                }
                if($searchkey['formcontrolname'] == 'YMQC'){
                    $model->andWhere(['IN', 'bmd_status', [4]]);
                    $model->andWhere('bmd_opalmemberregmst_fk='.$regPk.' or oum_opalmemberregmst_fk = '.$regPk);
                    $model->andWhere('bmah_assessmentdate = curdate()');
                    $model->andWhere('bmah_assessendtime < now()');
                }
            }
            
             if($searchkey['fsgrid']){
                // $model->andWhere(['IN', 'batchmgmtdtls_pk', $searchkey['searckkey']]);
                $model->andWhere('batchmgmtdtls_pk in('.$searchkey['fsgrid'].')');
               
           }
           
           if(!empty($searchkey['serach_civil'])){
                 $model->having('FIND_IN_SET("'.$searchkey['serach_civil'].'", civilids)');  
               
             
            }
        }
        

        if(!empty($sort)){
           
            if($sort['key'] == 'batchno'){
              
                 $model->orderBy('bmd_Batchno '.$sort['dir']);
                
            }
             if($sort['key'] == 'batchtype'){
                 $model->orderBy('a.rm_name_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'officetype'){
                 $model->orderBy('office_type '.$sort['dir']);
            }
            if($sort['key'] == 'asssessmentcenter'){
                  $model->orderBy('m.omrm_tpname_en '.$sort['dir']);
            }
            if($sort['key'] == 'trainingprovider'){
                 $model->orderBy('n.omrm_tpname_en '.$sort['dir']);
            }
            if($sort['key'] == 'branchname'){
                 $model->orderBy('appiim_branchname_en '.$sort['dir']);
            }
           
            if($sort['key'] == 'assessmentwilayat'){
                 $model->orderBy('c.ocim_cityname_en '.$sort['dir']);
                
            }
            if($sort['key'] == 'assessmentstate'){
                 $model->orderBy('d.osm_statename_en '.$sort['dir']);
            }
            if($sort['key'] == 'categories'){
              
                 $model->orderBy('ccm_catname_en '.$sort['dir']);
                
            }
             if($sort['key'] == 'language'){
                  $model->orderBy('b.rm_name_en '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                 $model->orderBy('bmd_status '.$sort['dir']);
                
            }
            if($sort['key'] == 'assessmentdatetime'){
                   $model->orderBy('bmah_assessstarttime '.$sort['dir']);  
            }
            if($sort['key'] == 'trainingdurationth'){
                 $model->orderBy('bmth_startdate '.$sort['dir']);
            }
            if($sort['key'] == 'trainingdurationpr'){
                 $model->orderBy('bmph_startdate '.$sort['dir']);  
            }
          
        }
        else
        {
            $model->orderBy(['ifnull(bmd_updatedon,bmd_createdon)' => SORT_DESC]);

        }
     

 if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && in_array(2,$allocatedprj))
        {
             $model->andWhere(['IN','scd_standardcoursemst_fk',$allocatecategory]);
        }else if(($stktype == 1) && $loginuserdtls['oum_isfocalpoint'] == 2 && !in_array(2,$allocatedprj))
        {
            $model->andWhere(0);
        }
     
       
       $batches = $model->groupBy('batchmgmtdtls_pk')
                ->asArray();
       
       $dataProvider = new ActiveDataProvider([
        'query' => $batches,
        'pagination' => [
                            'pageSize' =>$limit,
                            'page'=>$index
                        ]
            ]);
       
        $batches = $dataProvider->getModels();
        
        foreach($batches as $key => $batch)
 {
            $batches[$key]['traintheorystart'] = $batch['traintheorystart'] ? date("d-m-Y", strtotime($batch['traintheorystart'])) : $batch['traintheorystart'];
            $batches[$key]['traintheoryend'] = $batch['traintheoryend'] ? date("d-m-Y", strtotime($batch['traintheoryend'])) : $batch['traintheoryend'];
            $batches[$key]['trainpractstart'] = $batch['trainpractstart'] ? date("d-m-Y", strtotime($batch['trainpractstart'])) : $batch['trainpractstart'];
            $batches[$key]['trainpractend'] = $batch['trainpractend'] ? date("d-m-Y", strtotime($batch['trainpractend'])) : $batch['trainpractend'];

            $batches[$key]['assessmentdate'] = $batch['assessmentdate'] ? date("d-m-Y", strtotime($batch['assessmentdate'])) : $batch['assessmentdate'];
            $batches[$key]['assessmentstart'] = $batch['assessmentstart'] ? date("H:i A", strtotime($batch['assessmentstart'])) : $batch['assessmentstart'];
            $batches[$key]['assessmentend'] = $batch['assessmentend'] ? date("H:i A", strtotime($batch['assessmentend'])) : $batch['assessmentend'];
            $learnercount = LearnerreghrddtlsTbl::find()->where(['=', 'lrhd_batchmgmtdtls_fk', $batch['id']])->count();
            $batches[$key]['totallearners'] = $learnercount;
            $attendaccess = \api\components\Batch::getAttendanceDetailInfo($batch['batch_no']);
            $batches[$key]['attenddwldaccess'] = (count($attendaccess)>0)? true: false;
            
            if($batch['req_status'] == 5)
            {
                $historyrec = BatchmgmtdtlshstyTbl::find()->select('bmh_status')->where(['=','bmh_batchmgmtdtls_fk',$batch['id']])->orderBy('batchmgmtdtlshsty_pk desc')->one();
                $batches[$key]['prev_status'] =  $historyrec->bmh_status;
        }
        }
        
  $recodsset =[];
    $recodsset['batches'] = $batches;
    $recodsset['pagesize'] = $limit;
    $recodsset['totalcount'] = $dataProvider->getTotalCount();

    return $recodsset;
    }
    
    
    public static function fetchBatchdetailsByBatchno($batchno){
     
        $batch = self::find()
                ->select(['batchmgmtdtls_pk','bmd_opalmemberregmst_fk as trainingevlocenter','appiim_officetype as office_type','appiim_branchname_ar','appiim_branchname_en','scd_standardcoursemst_fk as stdcoursedtlsmstpk','standardcoursedtls_pk as stdcoursedtlsdltspk','scm_coursename_en','scm_coursename_ar','bmd_appcoursedtlsmain_fk as coursedtlmainpk','appiim_applicationdtlsmain_fk as applicatiomainpk','scd_subcoursecategorymst_fk as cour_subcate','scm_coursecategorymst_fk as cour_cate','bmd_batchtype as batchtype','bmd_traininglang as assmntlanauge','bmph_batchcount as particalbatchlimit', 'group_concat(bmph_tutor) as tutorone','bmph_startdate','bmph_enddate','a.ccm_catname_en as subcategory','b.ccm_catname_en as category','bmd_traininglang','c.rm_name_en as language','bmd_batchtype','d.rm_name_en as batchtype','bmph_batchcount as practcount','bmth_batchcount as theorycount','f.sir_name_en as theory_tutor','group_concat(bmph_tutor) as practtutor','bmd_batchcount as batchcount','bmd_status as status','bmd_Batchno as batch_no','bmd_reqstatus as req_status','ocim_cityname_en as city','osm_statename_en as state'])
                ->leftJoin('appinstinfomain_tbl','bmd_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('standardcoursedtls_tbl','standardcoursedtls_pk = bmd_standardcoursedtls_fk')
                ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = scd_standardcoursemst_fk')
                ->leftJoin('coursecategorymst_tbl a','a.coursecategorymst_pk = scd_subcoursecategorymst_fk')
                ->leftJoin('coursecategorymst_tbl b','b.coursecategorymst_pk = scm_coursecategorymst_fk')
                ->leftJoin('referencemst_tbl c','c.referencemst_pk = bmd_traininglang')
                ->leftJoin('referencemst_tbl d','d.referencemst_pk = bmd_batchtype')
//                ->leftJoin('batchmgmtasmthdr_tbl', 'bmah_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtpracthdr_tbl', 'bmph_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('batchmgmtthyhdr_tbl', 'bmth_batchmgmtdtls_fk = batchmgmtdtls_pk')
                ->leftJoin('opalcitymst_tbl', 'bmd_citymst_fk = opalcitymst_pk')
                ->leftJoin('opalstatemst_tbl', 'bmd_statemst_fk = opalstatemst_pk')
                ->leftJoin('opalusermst_tbl e','e.opalusermst_pk = bmth_tutor')
                ->leftJoin('staffinforepo_tbl f', 'f.staffinforepo_pk = e.oum_staffinforepo_fk')
                ->where(['=','bmd_Batchno',$batchno])
                ->asArray()
                ->one();
       
        $resArray = [];
        $finalArray = [];
        
        
            $resArray = $batch;
            $assessment = \app\models\BatchmgmtasmthdrTbl::find()
                    ->select(['group_concat(bmah_assessor) as assesor','opalmemberregmst_pk as assessmentcenter','bmah_batchcount as asscount','group_concat(bmah_ivqastaff)as ivqastaff','bmah_assessmentdate','bmah_assessstarttime','bmah_assessendtime'])
                    ->leftJoin('opalusermst_tbl','opalusermst_pk = bmah_assessor')
                    ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                    ->where('bmah_batchmgmtdtls_fk = '.$batch['batchmgmtdtls_pk'])->asArray()->one();
    
            $assessment['starttime'] = date('h:i A', strtotime($assessment['bmah_assessstarttime']));
            $assessment['endtime'] = date('h:i A', strtotime($assessment['bmah_assessendtime']));
            $assessment['assessmentdate'] = date('d-m-Y', strtotime($assessment['bmah_assessmentdate']));
            $resArray['assessorArray'] = $assessment;
            $resArray['assessmentcenter'] = $assessment['assessmentcenter'];
            
            $assessors = explode(',',$assessment['assesor']);
            $ivqastaffs = explode(',',$assessment['ivqastaff']);
            foreach($assessors as $assessor)
            {
                $assessornames[] = \app\models\StaffinforepoTbl::find()
                        
                        ->select(['sir_name_en','sir_name_ar','omrm_tpname_en','omrm_tpname_ar'])
                        ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = staffinforepo_pk')
                        ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                        ->where(['=','opalusermst_pk',$assessor])
                        ->asArray()
                        ->one();
            }
            $resArray['assessorArray']['assessornames'] = $assessornames;
            
            foreach($ivqastaffs as $ivqa)
            {
                $ivqanames[] = \app\models\StaffinforepoTbl::find()
                      
                        ->select(['sir_name_en','sir_name_ar','omrm_tpname_en','omrm_tpname_ar'])
                        ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = staffinforepo_pk')
                        ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                        ->where(['=','opalusermst_pk',$ivqa])
                        ->asArray()
                        ->one();
            }
            $resArray['assessorArray']['ivqastaffnames'] = $ivqanames;
            
          
            $practical = explode(',',$batch['practtutor']);
            foreach($practical as $practdata)
            {
                $practtutorname[] = \app\models\StaffinforepoTbl::find()
                        ->select(['sir_name_en','sir_name_ar'])
                        ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = staffinforepo_pk')
                        ->where(['=','opalusermst_pk',$practdata])
                        ->asArray()
                        ->one()['sir_name_en'];
            }
            $resArray['tutornamess'] = $practtutorname;
            $resArray['tutorpract'] = implode(', ',$practtutorname);
            
            $theoryslots = BatchmgmtdurationdtlsTbl::getSlotsByBatchId($batch['batchmgmtdtls_pk'],1);
            $practslots = BatchmgmtdurationdtlsTbl::getSlotsByBatchId($batch['batchmgmtdtls_pk'],2);
            
            $theorydaterange = BatchmgmtdurationdtlsTbl::find()->select(['max(bmdd_date) as max','min(bmdd_date) as min'])
                    ->where(['=','bmdd_batchclassdtls',1])
                    ->andWhere(['=','bmdd_batchmgmtdtls_fk',$batch['batchmgmtdtls_pk']])
                    ->asArray()->one();
            $practdaterange = BatchmgmtdurationdtlsTbl::find()->select(['max(bmdd_date) as max','min(bmdd_date) as min'])
                    ->where(['=','bmdd_batchclassdtls',2])
                    ->andWhere(['=','bmdd_batchmgmtdtls_fk',$batch['batchmgmtdtls_pk']])
                    ->asArray()->one();
    
            
            $resArray['theoryslots'] = $theoryslots;
            $resArray['theorydayscount'] = count($theoryslots);
            $resArray['theorydaterande'] = date('d-m-Y',strtotime($theorydaterange['min'])).' - '. date('d-m-Y',strtotime($theorydaterange['max']));
            $resArray['practslots'] = $practslots;
            $resArray['practdayscount'] = count($practslots);
            $resArray['practdaterande'] = date('d-m-Y',strtotime($practdaterange['min'])).' - '. date('d-m-Y',strtotime($practdaterange['max']));
            
            $learnercount = LearnerreghrddtlsTbl::find()->where(['=','lrhd_batchmgmtdtls_fk',$batch['batchmgmtdtls_pk']])->count();
            $resArray['totallearners'] = $learnercount;
            $resArray['status_name'] = self::getStatusName($batch['status']);
            $attendaccess = \api\components\Batch::getAttendanceDetailInfo($resArray['batch_no']);
            $resArray['attenddwldaccess'] = (count($attendaccess)>0)? true: false;
           
           
        return $resArray;
                
    }
    
    public static function getStatusName($key)
    {
        switch($key)
        {
            case '1': $value = 'New';break;
            case '2': $value = 'Teaching(Theory)';break;
            case '3': $value = 'Teaching(practical)';break;
            case '4': $value = 'Assessment';break;
            case '6': $value = 'Quality Check';break;
            case '7': $value = 'Cancelled';break;
            case '8': $value = 'Print';break;  
        }
                return $value;

    }
}
