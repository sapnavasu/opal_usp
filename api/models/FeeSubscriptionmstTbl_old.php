<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feesubscriptionmst_tbl".
 *
 * @property int $feesubscriptionmst_pk primary key
 * @property int $fsm_projectmst_fk Reference to projectmst_pk
 * @property int $fsm_feestype 1-Certification Fee,2-Staff Evaluation Fee,3-Royalty Fee,4-Learner Fee   
 * @property int $fsm_applicationtype 1-Initial,2-Renewal,3-Update,4-Refresher  by dafault 0
 * @property string $fsm_fee
 * @property int $fsm_status 1-Active,2-Inactive
 * @property string $fsm_createdon
 * @property int $fsm_createdby
 *
 * @property FeesubscriptionhstyTbl[] $feesubscriptionhstyTbls
 * @property ProjectmstTbl $fsmProjectmstFk
 */
class FeeSubscriptionmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feesubscriptionmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsm_projectmst_fk', 'fsm_feestype', 'fsm_fee', 'fsm_createdby'], 'required'],
            [['fsm_projectmst_fk', 'fsm_feestype', 'fsm_applicationtype', 'fsm_status', 'fsm_createdby'], 'integer'],
            [['fsm_fee'], 'number'],
            [['fsm_createdon'], 'safe'],
            [['fsm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['fsm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feesubscriptionmst_pk' => 'Feesubscriptionmst Pk',
            'fsm_projectmst_fk' => 'Fsm Projectmst Fk',
            'fsm_feestype' => 'Fsm Feestype',
            'fsm_applicationtype' => 'Fsm Applicationtype',
            'fsm_fee' => 'Fsm Fee',
            'fsm_status' => 'Fsm Status',
            'fsm_createdon' => 'Fsm Createdon',
            'fsm_createdby' => 'Fsm Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeesubscriptionhstyTbls()
    {
        return $this->hasMany(FeesubscriptionhstyTbl::className(), ['fsh_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'fsm_projectmst_fk']);
    }
}
