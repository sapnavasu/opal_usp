<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnerreghrddtls_tbl".
 *
 * @property int $learnerreghrddtls_pk
 * @property int $lrhd_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $lrhd_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $lrhd_staffinforepo_fk Reference to staffinforepo_pk, Learner information 
 * @property string $Irhd_emailid
 * @property int $Irhd_projectmst_fk Reference to projectmst_pk
 * @property string $lrhd_learnerfee Learner Fee in OMR
 * @property int $lrhd_feestatus Learner Fee Status. 1-Paid,2- Yet to Pay
 * @property int $lrhd_paidby 1 -Learner, 2 - OPAL, 3 - Operator
 * @property int $lrhd_status 1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print,11-Completed,12-Re-take Assessment
 * @property string $lrhd_createdon
 * @property string $lrhd_appdeccomments
 * @property int $lrhd_createdby
 * @property string $lrhd_updatedon
 * @property int $lrhd_updatedby
 * @property int $lrhd_operatorname Store Operator_pk, if company to pay it. referencemst_tbl where rm_mastertype = 2 it lrhd_paidby = 3
 *
 * @property BatchmgmtasmtdtlsTbl[] $batchmgmtasmtdtlsTbls
 * @property BatchmgmtpractdtlsTbl[] $batchmgmtpractdtlsTbls
 * @property BatchmgmtthydtlsTbl[] $batchmgmtthydtlsTbls
 * @property LearnerasmthdrTbl[] $learnerasmthdrTbls
 * @property LearnercertgendtlsTbl[] $learnercertgendtlsTbls
 * @property LearnerfdbkhdrTbl[] $learnerfdbkhdrTbls
 * @property BatchmgmtdtlsTbl $lrhdBatchmgmtdtlsFk
 * @property OpalmemberregmstTbl $lrhdOpalmemberregmstFk
 * @property StaffinforepoTbl $lrhdStaffinforepoFk
 * @property LearnerreghrdhstyTbl[] $learnerreghrdhstyTbls
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class LearnerreghrddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerreghrddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lrhd_opalmemberregmst_fk', 'lrhd_batchmgmtdtls_fk', 'lrhd_staffinforepo_fk', 'Irhd_emailid', 'Irhd_projectmst_fk', 'lrhd_learnerfee', 'lrhd_feestatus', 'lrhd_status', 'lrhd_createdby'], 'required'],
            [['lrhd_opalmemberregmst_fk', 'lrhd_batchmgmtdtls_fk', 'lrhd_staffinforepo_fk', 'Irhd_projectmst_fk', 'lrhd_feestatus', 'lrhd_paidby', 'lrhd_status', 'lrhd_createdby', 'lrhd_updatedby', 'lrhd_operatorname', 'lrhd_appdecby'], 'integer'],
            [['lrhd_learnerfee'], 'number'],
            [['lrhd_createdon', 'lrhd_updatedon','lrhd_appdecon'], 'safe'],
            [['lrhd_appdeccomments'], 'string'],
            [['Irhd_emailid'], 'string', 'max' => 100],
            [['lrhd_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['lrhd_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['lrhd_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['lrhd_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['lrhd_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['lrhd_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnerreghrddtls_pk' => 'Learnerreghrddtls Pk',
            'lrhd_opalmemberregmst_fk' => 'Reference to opalmemberregmst_pk',
            'lrhd_batchmgmtdtls_fk' => 'Reference to batchmgmtdtls_pk',
            'lrhd_staffinforepo_fk' => 'Reference to staffinforepo_pk, Learner information ',
            'Irhd_emailid' => 'Irhd Emailid',
            'Irhd_projectmst_fk' => 'Reference to projectmst_pk',
            'lrhd_learnerfee' => 'Learner Fee in OMR',
            'lrhd_feestatus' => 'Learner Fee Status. 1-Paid,2- Yet to Pay',
            'lrhd_paidby' => '1 -Learner, 2 - OPAL, 3 - Operator',
            'lrhd_status' => '1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print,11-Completed,12-Re-take Assessment',
            'lrhd_createdon' => 'Lrhd Createdon',
            'lrhd_createdby' => 'Lrhd Createdby',
            'lrhd_updatedon' => 'Lrhd Updatedon',
            'lrhd_updatedby' => 'Lrhd Updatedby',
            'lrhd_operatorname' => 'Store Operator_pk, if company to pay it. referencemst_tbl where rm_mastertype = 2 it lrhd_paidby = 3',
            'lrhd_appdeccomments'=>'Lrhd appdeccomments',
            'lrhd_appdecon'=>'Lrhd appdecon',
            'lrhd_appdecby'=>'Lrhd appdecby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlsTbl::className(), ['bmad_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlsTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlsTbl::className(), ['bmpd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlsTbls()
    {
        return $this->hasMany(BatchmgmtthydtlsTbl::className(), ['bmtd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrTbls()
    {
        return $this->hasMany(LearnerasmthdrTbl::className(), ['lasmth_LearnerRegHrdDtls_FK' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnercertgendtlsTbls()
    {
        return $this->hasMany(LearnercertgendtlsTbl::className(), ['lcgd_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerfdbkhdrTbls()
    {
        return $this->hasMany(LearnerfdbkhdrTbl::className(), ['lfh_LearnerRegHrdDtls_FK' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhdBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'lrhd_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhdOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'lrhd_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhdStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'lrhd_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerreghrdhstyTbls()
    {
        return $this->hasMany(LearnerreghrdhstyTbl::className(), ['lrhh_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerreghrddtlsTblQuery(get_called_class());
    }

    public function statusUpdate($params)
    {
        $status = "";
        $batch = \app\models\BatchmgmtdtlsTbl::find()->where(['bmd_Batchno'=>$params->batchno])->one();
       
        $alllearner = \app\models\LearnerreghrddtlsTbl::find()->where(['lrhd_batchmgmtdtls_fk'=>$batch->batchmgmtdtls_pk])->count();
        foreach($params->learnerreghrddtls_pk as $tad_learnerreghrddtls_fk)
        {
           $learner =  LearnerreghrddtlsTbl::find()->where(["learnerreghrddtls_pk"=>$tad_learnerreghrddtls_fk])->one();

           if(count($learner)>0){
            $learner->lrhd_status = $params->lrhd_status;
            $status = $learner->save();
           }
        }
        $learnercount = \app\models\LearnerreghrddtlsTbl::find()
        ->where(['lrhd_batchmgmtdtls_fk'=>$batch->batchmgmtdtls_pk])
        ->andwhere(['>=','lrhd_status',$params->lrhd_status])
        ->andwhere(['!=','lrhd_status',4])
        ->andwhere(['!=','lrhd_status',5])
        ->andwhere(['!=','lrhd_status',13])
        ->count();

        // $learnercount = \app\models\LearnerreghrddtlsTbl::find()
        // ->where(['lrhd_batchmgmtdtls_fk'=>$batch->batchmgmtdtls_pk])
        // ->andwhere(['lrhd_status'=>$params->lrhd_status])->count();
        $learnernoshowcount = \app\models\LearnerreghrddtlsTbl::find()
        ->orwhere(['lrhd_status'=>4])
        ->orWhere(['lrhd_status'=>5])
        ->orWhere(['lrhd_status'=>13])
        ->andwhere(['lrhd_batchmgmtdtls_fk'=>$batch->batchmgmtdtls_pk])->count();
        $countt = $learnercount + $learnernoshowcount;
        
        $batchpk = $batch['batchmgmtdtls_pk'];
      
        $learnerlst = \app\models\BatchmgmtdtlsTbl::find()
            ->select(['Irhd_emailid', 'sir_name_en'])
            ->leftJoin('learnerreghrddtls_tbl', 'batchmgmtdtls_tbl.batchmgmtdtls_pk = learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
            ->leftJoin('staffinforepo_tbl', 'learnerreghrddtls_tbl.lrhd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            ->where(['batchmgmtdtls_pk' => $batchpk])
            ->asArray()
            ->all();
        
            $learnerId = [];
            $learnerName = [];
        
        if($alllearner == $countt){
            $batch->bmd_reqstatus = $batch->bmd_reqstatus == 5 ? null : $batch->bmd_reqstatus;
            $batch->bmd_status = $params->lrhd_status == 3 ? 3 : 4;
            if($batch->save()){
                $batchstatus= $batch->bmd_status;
                foreach ($learnerlst as $learnerlstrow) {
                    $learnerId = [$learnerlstrow['Irhd_emailid']];
                    $learnerName = [$learnerlstrow['sir_name_en']];  
//                    if($batchstatus == 3){
//                    \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'movetoprac'); 
//                    }elseif($batchstatus == 4){
//                    \api\components\Mail::learnBulk($batchpk,$learnerId,$learnerName,'movetoaccess'); 
//                    }
                } 
                
            }else{
                echo "<pre>";
                print_r($batch->getErrors());
                die;
            }
        }
        return $status;
    }
    
    public static function MoveLearnersToTheory($batchid)
    {
        $learnerhdrpk = [];
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = LearnerreghrddtlsTbl::find()->select('learnerreghrddtls_pk')->where(['=','lrhd_batchmgmtdtls_fk',$batchid])->andWhere(['=','lrhd_status',1])->asArray()->all();
        if($model)
        {
          foreach($model as $record)
        {
            $data = self::findOne($record['learnerreghrddtls_pk']);
            $datahistory = LearnerreghrddtlshstyTbl::movetohistory($data);
            
            $data->lrhd_status = 2;
            $data->lrhd_updatedby = $userpk;
            $data->lrhd_updatedon = date('Y-m-d H:i:s');
            
            if($datahistory && $data->save())
            {
                $learnerhdrpk[] = $data->learnerreghrddtls_pk;
            }
            else
            {
                echo "<pre>";
                var_dump($data->getErrors());
                exit;
            }
        }  
        }
        else
        {
            return true;
        }
        
        
        
       return $learnerhdrpk;
    }
}
