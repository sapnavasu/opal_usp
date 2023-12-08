<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtthyhdr_tbl".
 *
 * @property int $batchmgmtthyhdr_pk primary key
 * @property int $bmth_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmth_batchcount Batch count for the Theory class on Training the learner
 * @property int $bmth_tutor Reference to  usermst_pk
 * @property string $bmth_startdate
 * @property string $bmth_enddate
 * @property int $bmth_status 1-Active, 2-Inactive, by default 1
 * @property string $bmth_createdon
 * @property int $bmth_createdby
 * @property string $bmth_updatedon
 * @property int $bmth_updatedby
 *
 * @property BatchmgmtdurationdtlsTbl[] $batchmgmtdurationdtlsTbls
 * @property BatchmgmtthydtlsTbl[] $batchmgmtthydtlsTbls
 * @property BatchmgmtdtlsTbl $bmthBatchmgmtdtlsFk
 * @property OpalusermstTbl $bmthTutor
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class BatchmgmtthyhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtthyhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmth_batchmgmtdtls_fk', 'bmth_batchcount', 'bmth_tutor', 'bmth_startdate', 'bmth_enddate', 'bmth_createdby'], 'required'],
            [['bmth_batchmgmtdtls_fk', 'bmth_batchcount', 'bmth_tutor', 'bmth_status', 'bmth_createdby', 'bmth_updatedby'], 'integer'],
            [['bmth_startdate', 'bmth_enddate', 'bmth_createdon', 'bmth_updatedon'], 'safe'],
            [['bmth_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmth_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmth_tutor'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['bmth_tutor' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtthyhdr_pk' => 'primary key',
            'bmth_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'bmth_batchcount' => 'Batch count for the Theory class on Training the learner',
            'bmth_tutor' => 'Reference to  usermst_pk',
            'bmth_startdate' => 'Bmth Startdate',
            'bmth_enddate' => 'Bmth Enddate',
            'bmth_status' => '1-Active, 2-Inactive, by default 1',
            'bmth_createdon' => 'Bmth Createdon',
            'bmth_createdby' => 'Bmth Createdby',
            'bmth_updatedon' => 'Bmth Updatedon',
            'bmth_updatedby' => 'Bmth Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlsTbl::className(), ['bmdd_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlsTbls()
    {
        return $this->hasMany(BatchmgmtthydtlsTbl::className(), ['bmtd_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmthBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmth_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmthTutor()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'bmth_tutor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtthyhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtthyhdrTblQuery(get_called_class());
    }
    
    public static function saveBatchThryHdr($batchpk , $requestdata)
    {
        
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true); 
        $durationnew = AppstaffinfomainTbl::preparedurationarray($requestdata['slots'],'subarr');
        $check = false;
        foreach ($durationnew as $durationrecord) {

            $date = $durationrecord['datestring'];
            $start = $durationrecord['start'];
            $end = $durationrecord['end'];
            $staffinfotmppks = AppstaffinfomainTbl::getStaffinfotmppksbyuserpk($requestdata['tutor']);
            foreach ($staffinfotmppks as $tmppk) {
                $checkSlotStatus = AppstaffscheddtlsTbl::find()->where([
                    'assd_appstaffinfotmp_fk' => $tmppk['appsim_AppStaffInfotmp_FK'],
                    'assd_date' => $date,
                    'assd_dayschedule' => 64
                ]);
                if ($start && $end) {
                    $checkSlotStatus->andWhere("('".$start."'  BETWEEN assd_starttime AND assd_endtime)OR('".$end."'   BETWEEN assd_starttime AND assd_endtime)");
                }
                //  echo $checkSlotStatus->createCommand()->getRawSql(); die;

                $checkSlotStatus = $checkSlotStatus->one();
                if($checkSlotStatus){
                    $check = true;
                }
            }
        }
        if(!$check){
            return "statusNT";
        }

        $model = new BatchmgmtthyhdrTbl();
        $model->bmth_batchmgmtdtls_fk = $batchpk;
        $model->bmth_batchcount = $requestdata['theorybatchlimit'];
        $model->bmth_tutor = $requestdata['tutor'];
        $model->bmth_startdate = date('Y-m-d',(string)$requestdata['slots'][0]['date']/1000);
        $model->bmth_enddate = date('Y-m-d',$requestdata['slots'][sizeof($requestdata['slots']) - 1]['date']/1000);
        $model->bmth_status = 1;
        $model->bmth_createdby = $userpk;
        $model->bmth_createdon = date('Y-m-d H:i:s');
        if($model->save())
        {
            return $model->batchmgmtthyhdr_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
    
    
    
    
}
