<?php

namespace app\models;

use Yii;
use app\models\AppstaffscheddtlsTbl;

/**
 * This is the model class for table "batchmgmtasmthdr_tbl".
 *
 * @property int $batchmgmtasmthdr_pk primary key
 * @property int $bmah_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmah_batchcount Batch count to do assessment
 * @property int $bmah_assessor Reference to  opalusermst_pk
 * @property int $bmah_ivqastaff Reference to  opalusermst_pk
 * @property string $bmah_assessmentdate
 * @property string $bmah_assessstarttime
 * @property string $bmah_assessendtime
 * @property int $bmah_reqstatus 1 - Requested for Assessor Change, 2 - Assessor Changed
 * @property int $bmah_status 1-Active, 2-Inactive, by default 1
 * @property string $bmah_createdon
 * @property int $bmah_createdby
 * @property string $bmah_updatedon
 * @property int $bmah_updatedby
 *
 * @property BatchmgmtasmtdtlsTbl[] $batchmgmtasmtdtlsTbls
 * @property OpalusermstTbl $bmahAssessor
 * @property BatchmgmtdtlsTbl $bmahBatchmgmtdtlsFk
 * @property OpalusermstTbl $bmahIvqastaff
 * @property BatchmgmtasmthdrhstyTbl[] $batchmgmtasmthdrhstyTbls
 */
class BatchmgmtasmthdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtasmthdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmah_batchmgmtdtls_fk', 'bmah_batchcount', 'bmah_assessor', 'bmah_ivqastaff', 'bmah_assessmentdate', 'bmah_assessstarttime', 'bmah_assessendtime', 'bmah_createdby'], 'required'],
            [['bmah_batchmgmtdtls_fk', 'bmah_batchcount', 'bmah_assessor', 'bmah_ivqastaff', 'bmah_reqstatus', 'bmah_status', 'bmah_createdby', 'bmah_updatedby'], 'integer'],
            [['bmah_assessmentdate', 'bmah_assessstarttime', 'bmah_assessendtime', 'bmah_createdon', 'bmah_updatedon'], 'safe'],
            [['bmah_assessor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmah_assessor' => 'opalusermst_pk']],
            [['bmah_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmah_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmah_ivqastaff'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmah_ivqastaff' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtasmthdr_pk' => 'Batchmgmtasmthdr Pk',
            'bmah_batchmgmtdtls_fk' => 'Bmah Batchmgmtdtls Fk',
            'bmah_batchcount' => 'Bmah Batchcount',
            'bmah_assessor' => 'Bmah Assessor',
            'bmah_ivqastaff' => 'Bmah Ivqastaff',
            'bmah_assessmentdate' => 'Bmah Assessmentdate',
            'bmah_assessstarttime' => 'Bmah Assessstarttime',
            'bmah_assessendtime' => 'Bmah Assessendtime',
            'bmah_reqstatus' => 'Bmah Reqstatus',
            'bmah_status' => 'Bmah Status',
            'bmah_createdon' => 'Bmah Createdon',
            'bmah_createdby' => 'Bmah Createdby',
            'bmah_updatedon' => 'Bmah Updatedon',
            'bmah_updatedby' => 'Bmah Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlsTbl::className(), ['bmad_batchmgmtasmthdr_fk' => 'batchmgmtasmthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahAssessor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmah_assessor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmah_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmahIvqastaff()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmah_ivqastaff']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmthdrhstyTbls()
    {
        return $this->hasMany(BatchmgmtasmthdrhstyTbl::className(), ['bmahh_batchmgmtasmthdr_fk' => 'batchmgmtasmthdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtasmthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtasmthdrTblQuery(get_called_class());
    }



    public static function saveBatchAssmntHdr($batchpk , $requestdata) 
    {
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true); 
        $assessmentpk = [];
      foreach($requestdata['assessorarr'] as $assessorarray)
      {

            $date = $requestdata['assDate'];
            $start = $requestdata['assStartTime'];
            $end = $requestdata['assEndTime'];
            $check = false;

            $staffinfotmppks = AppstaffinfomainTbl::getStaffinfotmppksbyuserpk($assessorarray['assessor']);
            foreach ($staffinfotmppks as $tmppk) {
                $checkSlotStatus = AppstaffscheddtlsTbl::find()->where([
                    'assd_appstaffinfotmp_fk' => $tmppk['appsim_AppStaffInfotmp_FK'],
                    'assd_date' => $date,
                    'assd_dayschedule' => 64
                ]);
                if ($start && $end) {
                    $checkSlotStatus->andWhere("('".$start."'  BETWEEN assd_starttime AND assd_endtime)OR('".$end."'   BETWEEN assd_starttime AND assd_endtime)");
                }
                // echo $checkSlotStatus->createCommand()->getRawSql(); echo "  ";
                
                $checkSlotStatus = $checkSlotStatus->one();
                if($checkSlotStatus){
                    $check = true;
                }
            }

            if(!$check){
                return "statusNT";
            }

        $model = new BatchmgmtasmthdrTbl();
        $model->bmah_batchmgmtdtls_fk = $batchpk;
        $model->bmah_batchcount = $requestdata['assesmentbatchlimit'];
        $model->bmah_assessor = $assessorarray['assessor'];
        $model->bmah_ivqastaff = $assessorarray['IVQAStaff'];
        $model->bmah_assessmentdate = $requestdata['assDate'];
        $model->bmah_assessstarttime = $requestdata['assStartTime'];
        $model->bmah_assessendtime = $requestdata['assEndTime'];
        $model->bmah_status = 1;
        $model->bmah_createdon = date('Y-m-d H:i:s');
        $model->bmah_createdby = $userpk;
      
         if($model->save())
        {
            $assesorChange = AppstaffscheddtlsTbl::ChangeSchedule($model->bmah_assessor,$model->bmah_assessmentdate,$model->bmah_assessstarttime,$model->bmah_assessendtime,32,2);
            $assessmentpk[] = $model->batchmgmtasmthdr_pk;
            if(!$assesorChange)
            {
                return false;
            }
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
   
    return $assessmentpk;
         
        
    }
    public function changeassesor($batchpk,$oldstff,$newstff,$history,$status,$newivqa)
    {
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true); 
        $model = self::find()
                ->where(['=','bmah_batchmgmtdtls_fk',$batchpk])
                ->andWhere(['=','bmah_assessor',$oldstff['assesorpk']])
                ->one();
        
        if($newstff)
        {
            $scheduleoldstaff = AppstaffscheddtlsTbl::ChangeSchedule($oldstff['assesorpk'], $model->bmah_assessmentdate, $model->bmah_assessstarttime,$model->bmah_assessendtime, 64 , 2);
            $schedulenewstaff = AppstaffscheddtlsTbl::ChangeSchedule($newstff['assesorpk'],$model->bmah_assessmentdate, $model->bmah_assessstarttime,$model->bmah_assessendtime, 32 , 2);
        }
        
        
        $historymodel = \app\models\BatchmgmtasmthdrhstyTbl::movetohistory($model,$history);
        
        if($newstff)
        {
            $model->bmah_assessor = $newstff['assesorpk'];
            $model->bmah_ivqastaff = $newivqa['pk'];
        }
        
        $model->bmah_reqstatus = $status;
        $model->bmah_updatedon = date('Y-m-d H:i:s');
        $model->bmah_updatedby = $userpk;
        
        if($model->save() && $historymodel)
        {
            return $model->batchmgmtasmthdr_pk;
        }
        else{
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
        
   
    
    
   
}
