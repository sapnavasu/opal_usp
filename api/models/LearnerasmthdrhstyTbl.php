<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learnerasmthdrhsty_tbl".
 *
 * @property int $learnerasmthdrhsty_pk primary key
 * @property int $lasmthh_learnerasmthdr_fk Reference to learnerasmthdr_pk
 * @property int $lasmthh_learnerreghrddtlshsty_fk Reference to learnerreghrddtlshsty_pk
 * @property int $lasmthh_batchmgmtdtlshsty_fk Reference tobatchmgmtdtlshsty_pk
 * @property int $lasmthh_batchmgmtasmtdtlshsty_fk Reference to batchmgmtasmtdtlshsty_pk
 * @property int $lasmthh_staffinforepo_fk Reference to staffinforepo_pk
 * @property int $lasmthh_asmttype 1-Offline, 2-Online, by default 1
 * @property int $lasmthh_asmtupload Reference to memcompfiledtls_pk, NOT NULL when lasmth_asmttype = 1
 * @property int $lasmthh_assessmentmst_fk Reference to assessmentmst_pk, NOT NULL when lasmth_asmttype = 2
 * @property string $lasmthh_totalmarks Calculate as assessmentmst_tbl.asmtm_noofquestions * asmtquestionmst_tbl.asmtqm_mark
 * @property string $lasmthh_marksecured Calculate as asmtquestionmst_tbl.asmtqm_mark * lasmtqd_quesresult=1
 * @property string $lasmthh_percentage
 * @property int $lasmthh_asmtstatus assessment status 1-Not yet appeared, 2-Appeared
 * @property int $lasmthh_status Reference to referencemst_pk where rm_mastertype=15
 * @property string $lasmthh_appdecon
 * @property int $lasmthh_appdecby
 * @property string $lasmthh_appdeccomments
 * @property string $lasmthh_Createdon assessor details
 * @property int $lasmthh_CreatedBy assessor details
 * @property string $lasmthh_updatedon assessor details
 * @property int $lasmthh_updatedby assessor details
 *
 * @property BatchmgmtasmtdtlshstyTbl $lasmthhBatchmgmtasmtdtlshstyFk
 * @property BatchmgmtdtlshstyTbl $lasmthhBatchmgmtdtlshstyFk
 * @property LearnerasmthdrTbl $lasmthhLearnerasmthdrFk
 * @property LearnerreghrddtlshstyTbl $lasmthhLearnerreghrddtlshstyFk
 * @property StaffinforepoTbl $lasmthhStaffinforepoFk
 * @property LearnerasmtquesdtlshstyTbl[] $learnerasmtquesdtlshstyTbls
 */
class LearnerasmthdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'learnerasmthdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lasmthh_learnerasmthdr_fk', 'lasmthh_learnerreghrddtlshsty_fk', 'lasmthh_batchmgmtdtlshsty_fk', 'lasmthh_batchmgmtasmtdtlshsty_fk', 'lasmthh_staffinforepo_fk', 'lasmthh_asmtstatus', 'lasmthh_status', 'lasmthh_CreatedBy', 'lasmthh_updatedon', 'lasmthh_updatedby'], 'required'],
            [['lasmthh_learnerasmthdr_fk', 'lasmthh_learnerreghrddtlshsty_fk', 'lasmthh_batchmgmtdtlshsty_fk', 'lasmthh_batchmgmtasmtdtlshsty_fk', 'lasmthh_staffinforepo_fk', 'lasmthh_asmttype', 'lasmthh_asmtupload', 'lasmthh_assessmentmst_fk', 'lasmthh_asmtstatus', 'lasmthh_status', 'lasmthh_appdecby', 'lasmthh_CreatedBy', 'lasmthh_updatedby'], 'integer'],
            [['lasmthh_totalmarks', 'lasmthh_marksecured', 'lasmthh_percentage'], 'number'],
            [['lasmthh_appdecon', 'lasmthh_Createdon', 'lasmthh_updatedon'], 'safe'],
            [['lasmthh_appdeccomments'], 'string'],
            [['lasmthh_batchmgmtasmtdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtasmtdtlshstyTbl::className(), 'targetAttribute' => ['lasmthh_batchmgmtasmtdtlshsty_fk' => 'batchmgmtasmtdtlshsty_pk']],
            [['lasmthh_batchmgmtdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlshstyTbl::className(), 'targetAttribute' => ['lasmthh_batchmgmtdtlshsty_fk' => 'batchmgmtdtlshsty_pk']],
            [['lasmthh_learnerasmthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerasmthdrTbl::className(), 'targetAttribute' => ['lasmthh_learnerasmthdr_fk' => 'LearnerAsmtHdr_PK']],
            [['lasmthh_learnerreghrddtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LearnerreghrddtlshstyTbl::className(), 'targetAttribute' => ['lasmthh_learnerreghrddtlshsty_fk' => 'learnerreghrddtlshsty_pk']],
            [['lasmthh_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['lasmthh_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'learnerasmthdrhsty_pk' => 'primary key',
            'lasmthh_learnerasmthdr_fk' => 'Reference to learnerasmthdr_pk',
            'lasmthh_learnerreghrddtlshsty_fk' => 'Reference to learnerreghrddtlshsty_pk',
            'lasmthh_batchmgmtdtlshsty_fk' => 'Reference tobatchmgmtdtlshsty_pk',
            'lasmthh_batchmgmtasmtdtlshsty_fk' => 'Reference to batchmgmtasmtdtlshsty_pk',
            'lasmthh_staffinforepo_fk' => 'Reference to staffinforepo_pk',
            'lasmthh_asmttype' => '1-Offline, 2-Online, by default 1',
            'lasmthh_asmtupload' => 'Reference to memcompfiledtls_pk, NOT NULL when lasmth_asmttype = 1',
            'lasmthh_assessmentmst_fk' => 'Reference to assessmentmst_pk, NOT NULL when lasmth_asmttype = 2',
            'lasmthh_totalmarks' => 'Calculate as assessmentmst_tbl.asmtm_noofquestions * asmtquestionmst_tbl.asmtqm_mark',
            'lasmthh_marksecured' => 'Calculate as asmtquestionmst_tbl.asmtqm_mark * lasmtqd_quesresult=1',
            'lasmthh_percentage' => 'Lasmthh Percentage',
            'lasmthh_asmtstatus' => 'assessment status 1-Not yet appeared, 2-Appeared',
            'lasmthh_status' => 'Reference to referencemst_pk where rm_mastertype=15',
            'lasmthh_appdecon' => 'Lasmthh Appdecon',
            'lasmthh_appdecby' => 'Lasmthh Appdecby',
            'lasmthh_appdeccomments' => 'Lasmthh Appdeccomments',
            'lasmthh_Createdon' => 'assessor details',
            'lasmthh_CreatedBy' => 'assessor details',
            'lasmthh_updatedon' => 'assessor details',
            'lasmthh_updatedby' => 'assessor details',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthhBatchmgmtasmtdtlshstyFk()
    {
        return $this->hasOne(BatchmgmtasmtdtlshstyTbl::className(), ['batchmgmtasmtdtlshsty_pk' => 'lasmthh_batchmgmtasmtdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthhBatchmgmtdtlshstyFk()
    {
        return $this->hasOne(BatchmgmtdtlshstyTbl::className(), ['batchmgmtdtlshsty_pk' => 'lasmthh_batchmgmtdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthhLearnerasmthdrFk()
    {
        return $this->hasOne(LearnerasmthdrTbl::className(), ['LearnerAsmtHdr_PK' => 'lasmthh_learnerasmthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthhLearnerreghrddtlshstyFk()
    {
        return $this->hasOne(LearnerreghrddtlshstyTbl::className(), ['learnerreghrddtlshsty_pk' => 'lasmthh_learnerreghrddtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLasmthhStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'lasmthh_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmtquesdtlshstyTbls()
    {
        return $this->hasMany(LearnerasmtquesdtlshstyTbl::className(), ['lasmtqdh_learnerasmthdrhsty_fk' => 'learnerasmthdrhsty_pk']);
    }

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LearnerasmthdrhstyTblQuery(get_called_class());
    }
}
