<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnerreghrddtlshsty_tbl".
 *
 * @property int $learnerreghrddtlshsty_pk primary key
 * @property int $lrhh_learnerreghrddtls_fk Reference to learnerreghrddtls_pk
 * @property int $lrhh_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $lrhh_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $lrhh_staffinforepo_fk Reference to staffinforepo_pk, Learner information 
 * @property string $Irhh_emailid
 * @property int $Irhh_projectmst_fk Reference to projectmst_pk
 * @property string $lrhh_leanerfee Learner Fee in OMR
 * @property int $lrhh_feestatus Learner Fee Status. 1-Paid,2- Yet to Pay
 * @property int $lrhh_paidby 1 - Learner, 2 - OPAL, 3 - Operator
 * @property int $lrhh_operatorname Store Operator_pk, if company to pay it. referencemst_tbl where rm_mastertype = 2 it lrhd_paidby = 3
 * @property int $lrhh_status 1-New, 2-Teaching(theory),3-Teaching(practical),4-No Show(theory),5-No Show(practical), 6-Assessment, 7-Quality Check,8-Declined during Quality Check,9-Resubmitted for Quality Check 10-Print,11-Completed,12-Re-take Assessment
 * @property string $lrhh_createdon
 * @property int $lrhh_createdby
 * @property int $lrhh_updatedby
 * @property string $lrhh_updatedon
 * @property string $lrhh_appdecon
 * @property int $lrhh_appdecby
 * @property string $lrhh_appdeccomments
 *
 * @property BatchmgmtasmtdtlshstyTbl[] $batchmgmtasmtdtlshstyTbls
 * @property BatchmgmtpractdtlshstyTbl[] $batchmgmtpractdtlshstyTbls
 * @property BatchmgmtthydtlshstyTbl[] $batchmgmtthydtlshstyTbls
 * @property LearnerasmthdrhstyTbl[] $learnerasmthdrhstyTbls
 * @property ProjectmstTbl $irhhProjectmstFk
 * @property BatchmgmtdtlsTbl $lrhhBatchmgmtdtlsFk
 * @property LearnerreghrddtlsTbl $lrhhLearnerreghrddtlsFk
 * @property OpalmemberregmstTbl $lrhhOpalmemberregmstFk
 * @property StaffinforepoTbl $lrhhStaffinforepoFk
 */
class LearnerreghrddtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerreghrddtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lrhh_opalmemberregmst_fk', 'lrhh_batchmgmtdtls_fk', 'lrhh_staffinforepo_fk', 'Irhh_emailid', 'Irhh_projectmst_fk', 'lrhh_leanerfee', 'lrhh_feestatus', 'lrhh_status', 'lrhh_createdon', 'lrhh_createdby'], 'required'],
            [['lrhh_learnerreghrddtls_fk', 'lrhh_opalmemberregmst_fk', 'lrhh_batchmgmtdtls_fk', 'lrhh_staffinforepo_fk', 'Irhh_projectmst_fk', 'lrhh_feestatus', 'lrhh_paidby', 'lrhh_operatorname', 'lrhh_status', 'lrhh_createdby', 'lrhh_updatedby', 'lrhh_appdecby'], 'integer'],
            [['lrhh_leanerfee'], 'number'],
            [['lrhh_createdon', 'lrhh_updatedon', 'lrhh_appdecon'], 'safe'],
            [['lrhh_appdeccomments'], 'string'],
            [['Irhh_emailid'], 'string', 'max' => 100],
            [['Irhh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['Irhh_projectmst_fk' => 'projectmst_pk']],
            [['lrhh_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['lrhh_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            [['lrhh_learnerreghrddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlsTbl::className(), 'targetAttribute' => ['lrhh_learnerreghrddtls_fk' => 'learnerreghrddtls_pk']],
            [['lrhh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['lrhh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['lrhh_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['lrhh_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnerreghrddtlshsty_pk' => 'Learnerreghrddtlshsty Pk',
            'lrhh_learnerreghrddtls_fk' => 'Lrhh Learnerreghrddtls Fk',
            'lrhh_opalmemberregmst_fk' => 'Lrhh Opalmemberregmst Fk',
            'lrhh_batchmgmtdtls_fk' => 'Lrhh Batchmgmtdtls Fk',
            'lrhh_staffinforepo_fk' => 'Lrhh Staffinforepo Fk',
            'Irhh_emailid' => 'Irhh Emailid',
            'Irhh_projectmst_fk' => 'Irhh Projectmst Fk',
            'lrhh_leanerfee' => 'Lrhh Leanerfee',
            'lrhh_feestatus' => 'Lrhh Feestatus',
            'lrhh_paidby' => 'Lrhh Paidby',
            'lrhh_operatorname' => 'Lrhh Operatorname',
            'lrhh_status' => 'Lrhh Status',
            'lrhh_createdon' => 'Lrhh Createdon',
            'lrhh_createdby' => 'Lrhh Createdby',
            'lrhh_updatedby' => 'Lrhh Updatedby',
            'lrhh_updatedon' => 'Lrhh Updatedon',
            'lrhh_appdecon' => 'Lrhh Appdecon',
            'lrhh_appdecby' => 'Lrhh Appdecby',
            'lrhh_appdeccomments' => 'Lrhh Appdeccomments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtasmtdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtasmtdtlshstyTbl::className(), ['bmadh_learnerreghrddtlshsty_fk' => 'learnerreghrddtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtpractdtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtpractdtlshstyTbl::className(), ['bmpdh_learnerreghrddtlshsty_fk' => 'learnerreghrddtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtthydtlshstyTbls()
    {
        return $this->hasMany(BatchmgmtthydtlshstyTbl::className(), ['bmtdh_learnerreghrddtlshsty_fk' => 'learnerreghrddtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrhstyTbls()
    {
        return $this->hasMany(LearnerasmthdrhstyTbl::className(), ['lasmthh_learnerreghrddtlshsty_fk' => 'learnerreghrddtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIrhhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'Irhh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhhBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'lrhh_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhhLearnerreghrddtlsFk()
    {
        return $this->hasOne(LearnerreghrddtlsTbl::className(), ['learnerreghrddtls_pk' => 'lrhh_learnerreghrddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'lrhh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLrhhStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'lrhh_staffinforepo_fk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerreghrddtlshstyTblQuery(get_called_class());
    }
    
     
      
    public static function movetohistory($data)
    {
        $model = new LearnerreghrddtlshstyTbl();
        $model->lrhh_learnerreghrddtls_fk = $data->learnerreghrddtls_pk;
        $model->lrhh_opalmemberregmst_fk = $data->lrhd_opalmemberregmst_fk;
        $model->lrhh_batchmgmtdtls_fk = $data->lrhd_batchmgmtdtls_fk;
        $model->lrhh_staffinforepo_fk = $data->lrhd_staffinforepo_fk;
        $model->Irhh_emailid = $data->Irhd_emailid;
        $model->Irhh_projectmst_fk = $data->Irhd_projectmst_fk;
        $model->lrhh_leanerfee = $data->lrhd_learnerfee;
        $model->lrhh_feestatus = $data->lrhd_feestatus;
        $model->lrhh_paidby = $data->lrhd_paidby;
        $model->lrhh_operatorname = $data->lrhd_operatorname;
        $model->lrhh_status = $data->lrhd_status;
        $model->lrhh_createdon = $data->lrhd_createdon;
        $model->lrhh_createdby = $data->lrhd_createdby;
        $model->lrhh_updatedby = $data->lrhd_updatedby;
        $model->lrhh_updatedon = $data->lrhd_updatedon;
        $model->lrhh_appdecon = $data->lrhd_appdecon;
        $model->lrhh_appdecby = $data->lrhd_appdecby;
        $model->lrhh_appdeccomments = $data->lrhd_appdeccomments;
        
        if($model->save())
        {
          return  $model->learnerreghrddtlshsty_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        
    }
}
