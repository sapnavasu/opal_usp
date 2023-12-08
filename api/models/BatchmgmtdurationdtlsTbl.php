<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchmgmtdurationdtls_tbl".
 *
 * @property int $batchmgmtdurationdtls_pk primary key
 * @property int $bmdd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $bmdd_batchmgmtthyhdr_fk Reference to batchmgmtthyhdr_pk
 * @property int $bmdd_batchmgmtpracthdr_fk Reference to batchmgmtpracthdr_pk
 * @property int $bmdd_batchclassdtls 1-theory class, 2-practical class
 * @property string $bmdd_date
 * @property int $bmdd_dayschedule Reference to referencemst_pk where rm_mastertype=11
 * @property string $bmdd_starttime
 * @property string $bmdd_endtime
 * @property string $bmdd_createdon
 * @property int $bmdd_createdby
 * @property string $bmdd_updatedon
 * @property int $bmdd_updatedby
 *
 * @property BatchmgmtdtlsTbl $bmddBatchmgmtdtlsFk
 * @property BatchmgmtpracthdrTbl $bmddBatchmgmtpracthdrFk
 * @property BatchmgmtthyhdrTbl $bmddBatchmgmtthyhdrFk
 * @property BatchmgmtdurationdtlshstyTbl[] $batchmgmtdurationdtlshstyTbls
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class BatchmgmtdurationdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchmgmtdurationdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bmdd_batchmgmtdtls_fk', 'bmdd_batchclassdtls', 'bmdd_date', 'bmdd_dayschedule', 'bmdd_createdby'], 'required'],
            [['bmdd_batchmgmtdtls_fk', 'bmdd_batchmgmtthyhdr_fk', 'bmdd_batchmgmtpracthdr_fk', 'bmdd_batchclassdtls', 'bmdd_dayschedule', 'bmdd_createdby', 'bmdd_updatedby'], 'integer'],
            [['bmdd_date', 'bmdd_starttime', 'bmdd_endtime', 'bmdd_createdon', 'bmdd_updatedon'], 'safe'],
            [['bmdd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['bmdd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['bmdd_batchmgmtpracthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtpracthdrTbl::className(), 'targetAttribute' => ['bmdd_batchmgmtpracthdr_fk' => 'batchmgmtpracthdr_pk']],
            [['bmdd_batchmgmtthyhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtthyhdrTbl::className(), 'targetAttribute' => ['bmdd_batchmgmtthyhdr_fk' => 'batchmgmtthyhdr_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchmgmtdurationdtls_pk' => 'Batchmgmtdurationdtls Pk',
            'bmdd_batchmgmtdtls_fk' => 'Bmdd Batchmgmtdtls Fk',
            'bmdd_batchmgmtthyhdr_fk' => 'Bmdd Batchmgmtthyhdr Fk',
            'bmdd_batchmgmtpracthdr_fk' => 'Bmdd Batchmgmtpracthdr Fk',
            'bmdd_batchclassdtls' => 'Bmdd Batchclassdtls',
            'bmdd_date' => 'Bmdd Date',
            'bmdd_dayschedule' => 'Bmdd Dayschedule',
            'bmdd_starttime' => 'Bmdd Starttime',
            'bmdd_endtime' => 'Bmdd Endtime',
            'bmdd_createdon' => 'Bmdd Createdon',
            'bmdd_createdby' => 'Bmdd Createdby',
            'bmdd_updatedon' => 'Bmdd Updatedon',
            'bmdd_updatedby' => 'Bmdd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmddBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'bmdd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmddBatchmgmtpracthdrFk()
    {
        return $this->hasOne(BatchmgmtpracthdrTbl::className(), ['batchmgmtpracthdr_pk' => 'bmdd_batchmgmtpracthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBmddBatchmgmtthyhdrFk()
    {
        return $this->hasOne(BatchmgmtthyhdrTbl::className(), ['batchmgmtthyhdr_pk' => 'bmdd_batchmgmtthyhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdurationdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtdurationdtlshstyTbl::className(), ['bmddh_batchmgmtdurationdtls_fk' => 'batchmgmtdurationdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_batchmgmtdurationdtls_fk' => 'batchmgmtdurationdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchmgmtdurationdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchmgmtdurationdtlsTblQuery(get_called_class());
    }
    
    public static function saveBatchdurations($requestdata , $batchdtls)
    {
        
        if($requestdata['slots'])
        {
        
            foreach($requestdata['slots'] as $key => $slot)
        {
                
            $durationpkthr[$key] = self::AddNewDurationRecord($slot,$batchdtls);
        }
        }
        
        
        if($requestdata['practslots'])
        {
           
            foreach($requestdata['practslots'] as $key => $slot)
        {
            $durationpkprac[$key] = self::AddNewDurationRecordPract($slot,$batchdtls);
            
        }
        }
        
        
        $duration['theory'] = $durationpkthr;
        $duration['practical'] = $durationpkprac;
        
        return $duration;
        
        
    }
    
    
    public static function AddNewDurationRecord($data ,$batchdtls)
    {
       $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       $theorypk = [];
       
       if($data['schedule'] == 64)
       {
            foreach ($data['subarr'] as $slots) {
                
            $model = new BatchmgmtdurationdtlsTbl();
            $model->bmdd_batchmgmtdtls_fk = $batchdtls['batchpk'];
            $model->bmdd_batchmgmtthyhdr_fk = $batchdtls['thhdrpk'];
            $model->bmdd_batchclassdtls = 1;
            $model->bmdd_dayschedule = $data['schedule'];
            $model->bmdd_date = $data['datestring'];
            $model->bmdd_starttime = $slots['startTime'];
            $model->bmdd_endtime = $slots['endTime'];
            $model->bmdd_createdby = $userpk;
            $model->bmdd_createdon = date('Y-m-d H:i:s');
            
            if ($model->save()) {
                $theorypk[] = $model->batchmgmtdurationdtls_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
       }
       else
       {
           
           $model = new BatchmgmtdurationdtlsTbl();
            $model->bmdd_batchmgmtdtls_fk = $batchdtls['batchpk'];
            $model->bmdd_batchmgmtthyhdr_fk = $batchdtls['thhdrpk'];
            $model->bmdd_batchclassdtls = 1;
            $model->bmdd_dayschedule = $data['schedule'];
            $model->bmdd_date = $data['datestring'];
            $model->bmdd_starttime = null;
            $model->bmdd_endtime = null;
            $model->bmdd_createdby = $userpk;
            $model->bmdd_createdon = date('Y-m-d H:i:s');
            
            if ($model->save()) {
                $theorypk[] = $model->batchmgmtdurationdtls_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
       }
      
        return $theorypk;
    }
    
    public static function AddNewDurationRecordPract($data ,$batchdtls)
    {
       $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
       
       $practdurpks = [];
      
           foreach($batchdtls['prhdrpk'] as $practpk)
           {
               if($data['schedule'] == 64)
               {
                foreach ($data['subarrpract'] as $slots) {
           
                    $model = new BatchmgmtdurationdtlsTbl();
                    $model->bmdd_batchmgmtdtls_fk = $batchdtls['batchpk'];
                    $model->bmdd_batchmgmtpracthdr_fk = $practpk;
                    $model->bmdd_batchclassdtls = 2;
                    $model->bmdd_dayschedule = $data['schedule'];
                    $model->bmdd_date = $data['datestring'];
                    $model->bmdd_starttime = $slots['startTime'];
                    $model->bmdd_endtime = $slots['endTime'];
                    $model->bmdd_createdby = $userpk;
                    $model->bmdd_createdon = date('Y-m-d H:i:s');
                    
                    if ($model->save()) {
                        $practdurpks[] = $model->batchmgmtdurationdtls_pk;
                    } else {
                        echo "<pre>";
                        var_dump($model->getErrors());
                        exit;
                    }
               
            
           }
               }
               else{
                   
                   
                   $model = new BatchmgmtdurationdtlsTbl();
                    $model->bmdd_batchmgmtdtls_fk = $batchdtls['batchpk'];
                    $model->bmdd_batchmgmtpracthdr_fk = $practpk;
                    $model->bmdd_batchclassdtls = 2;
                    $model->bmdd_dayschedule = $data['schedule'];
                    $model->bmdd_date = $data['datestring'];
                    $model->bmdd_starttime =  null;
                    $model->bmdd_endtime =  null;
                    $model->bmdd_createdby = $userpk;
                    $model->bmdd_createdon = date('Y-m-d H:i:s');
                  
                  
                    if ($model->save()) {
                        $practdurpks[] = $model->batchmgmtdurationdtls_pk;
                    } else {
                        echo "<pre>";
                        var_dump($model->getErrors());
                        exit;
                    }
               }
            
        }
        
      
        return $practdurpks;
    }
    
    public static function getSlotsByBatchId($batchpk , $type = 1)
    {
        
        $model = self::find()
                ->select(['bmdd_batchmgmtdtls_fk','batchmgmtdurationdtls_pk','rm_name_en as dayschedule','bmdd_dayschedule as schedule','bmdd_date as selecteddate','bmdd_starttime as start','bmdd_endtime as end'])
                ->leftJoin('referencemst_tbl','referencemst_pk = bmdd_dayschedule')
                ->where(['=','bmdd_batchmgmtdtls_fk',$batchpk])
                ->andWhere(['=','bmdd_batchclassdtls',$type])                ->groupBy('bmdd_starttime')                ->asArray()
                ->all();
        
        
        foreach($model as $key => $data)
        {
             $model[$key]['selecteddate'] = $data['selecteddate'] ? date("D d-M-Y",strtotime($data['selecteddate'])) : $data['selecteddate'] ;
             
             $model[$key]['start'] = $data['start'] ? date('h:i A', strtotime($data['start'])) : null;
             $model[$key]['end'] =  $data['end'] ? date('h:i A', strtotime($data['end'])) : null;
             $model[$key]['diffdecimal'] = ( $data['end'] && $data['start']) ? \api\components\Common::datediff( $data['end'],$data['start']) : null;
             $model[$key]['diff'] = \api\components\Common::convertTime($model[$key]['diffdecimal']);
        }
        
        
       
      return $model;
       
    }
}
