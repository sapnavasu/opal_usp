<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtpracthdr_tbl".
 *
 * @property int $batchmgmtpracthdr_pk primary key
 * @property int $bmph_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmph_batchcount Batch count for the Practical class on Training the learner
 * @property int $bmph_tutor Reference to  usermst_pk
 * @property string $bmph_startdate
 * @property string $bmph_enddate
 * @property int $bmph_status 1-Active, 2-Inactive, by default 1
 * @property string $bmph_createdon
 * @property int $bmph_createdby
 * @property string $bmph_updatedon
 * @property int $bmph_updatedby
 *
 * @property BatchmgmtdurationdtlsTbl[] $batchmgmtdurationdtlsTbls
 * @property BatchmgmtpractdtlsTbl[] $batchmgmtpractdtlsTbls
 * @property BatchmgmtdtlsTbl $bmphBatchmgmtdtlsFk
 * @property OpalusermstTbl $bmphTutor
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class BatchmgmtpracthdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtpracthdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmph_batchmgmtdtls_fk', 'bmph_batchcount', 'bmph_tutor', 'bmph_startdate', 'bmph_enddate', 'bmph_createdby'], 'required'],
            [['bmph_batchmgmtdtls_fk', 'bmph_batchcount', 'bmph_tutor', 'bmph_status', 'bmph_createdby', 'bmph_updatedby'], 'integer'],
            [['bmph_startdate', 'bmph_enddate', 'bmph_createdon', 'bmph_updatedon'], 'safe'],
            [['bmph_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmph_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmph_tutor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmph_tutor' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtpracthdr_pk' => 'primary key',
            'bmph_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'bmph_batchcount' => 'Batch count for the Practical class on Training the learner',
            'bmph_tutor' => 'Reference to  usermst_pk',
            'bmph_startdate' => 'Bmph Startdate',
            'bmph_enddate' => 'Bmph Enddate',
            'bmph_status' => '1-Active, 2-Inactive, by default 1',
            'bmph_createdon' => 'Bmph Createdon',
            'bmph_createdby' => 'Bmph Createdby',
            'bmph_updatedon' => 'Bmph Updatedon',
            'bmph_updatedby' => 'Bmph Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlsTbl::className(), ['bmdd_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlsTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlsTbl::className(), ['bmpd_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmphBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmph_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmphTutor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmph_tutor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtpracthdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtpracthdrTblQuery(get_called_class());
    }
    
    public static function saveBatchPracHdr($batchpk , $requestdata)
    {
        $practicalpks = [];
       if((($requestdata['theorybatchlimit'] / $requestdata['particalbatchlimit']) <= 1) && (($requestdata['theorybatchlimit'] % $requestdata['particalbatchlimit']) == 0))
       {
       
        $tutor =  $requestdata['tutorone'];
        $durationnew = AppstaffinfomainTbl::preparedurationarray($requestdata['practslots'],'subarrpract');
        $check = false;
        foreach ($durationnew as $durationrecord) {

            $date = $durationrecord['datestring'];
            $start = $durationrecord['start'];
            $end = $durationrecord['end'];

            $staffinfotmppks = AppstaffinfomainTbl::getStaffinfotmppksbyuserpk($tutor);
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
        }
        if(!$check){
            return "statusNT";
        }

          $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $model = new BatchmgmtpracthdrTbl();
            $model->bmph_batchmgmtdtls_fk = $batchpk;
            $model->bmph_batchcount = $requestdata['particalbatchlimit'];
            $model->bmph_status = 1;
            $model->bmph_tutor = $tutor;
            $model->bmph_startdate = date('Y-m-d', (string) $requestdata['practslots'][0]['date'] / 1000);
            $model->bmph_enddate = date('Y-m-d', $requestdata['practslots'][sizeof($requestdata['practslots']) - 1]['date'] / 1000);
            $model->bmph_createdby = $userpk;
            $model->bmph_createdon = date('Y-m-d H:i:s');

            if ($model->save()) {
                $practicalpks[] = $model->batchmgmtpracthdr_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            } 
       }
       else
       {
           foreach ($requestdata['tutorone'] as $tutor) {
            $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            $model = new BatchmgmtpracthdrTbl();
            $model->bmph_batchmgmtdtls_fk = $batchpk;
            $model->bmph_batchcount = $requestdata['particalbatchlimit'];
            $model->bmph_status = 1;
            $model->bmph_tutor = $tutor;
            $model->bmph_startdate = date('Y-m-d', (string) $requestdata['practslots'][0]['date'] / 1000);
            $model->bmph_enddate = date('Y-m-d', $requestdata['practslots'][sizeof($requestdata['practslots']) - 1]['date'] / 1000);
            $model->bmph_createdby = $userpk;
            $model->bmph_createdon = date('Y-m-d H:i:s');

            if ($model->save()) {
                $practicalpks[] = $model->batchmgmtpracthdr_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
       }
        
        
        
        return $practicalpks;
    }
}
