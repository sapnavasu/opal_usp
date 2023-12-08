<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feesubscriptionmsthsty_tbl".
 *
 * @property int $feesubscriptionmsthsty_pk
 * @property int $fsmh_feesubscriptionmst_fk Reference to feesubscriptionmst_pk
 * @property int $fsmh_projectmst_fk Reference to projectmst_pk
 * @property int $fsmh_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $fsmh_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $fsmh_officetype 1-Main Office,2-Branch Office,3-Both
 * @property int $fsmh_feestype 1-Certification Fee,2-Staff Evaluation Fee,3-Royalty Fee,4-Learner Training Fee,5-Learner Assessment Fee, 6-Staff Re-Evaluation Fee
 * @property string $fsmh_rolemst_fk Reference to Rolemst_pk
 * @property int $fsmh_applicationtype 1-Initial,2-Renewal,3-Update,4-Refresher,5-Surveillance 1, 6-Surveillance 2 by default 0
 * @property int $fsmh_headcount
 * @property string $fsmh_fee
 * @property int $fsmh_validityinyrs
 * @property int $fsmh_status 1-Active, 2-Inactive, by default 1
 * @property string $fsmh_createdon
 * @property int $fsmh_createdby
 * @property string $fsmh_updatedon
 * @property int $fsmh_updatedby
 *
 * @property FeesubscriptionmstTbl $fsmhFeesubscriptionmstFk
 * @property ProjectmstTbl $fsmhProjectmstFk
 * @property StandardcoursedtlsTbl $fsmhStandardcoursedtlsFk
 * @property StandardcoursemstTbl $fsmhStandardcoursemstFk
 */
class FeesubscriptionmsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feesubscriptionmsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsmh_feesubscriptionmst_fk', 'fsmh_projectmst_fk', 'fsmh_officetype', 'fsmh_feestype', 'fsmh_fee', 'fsmh_createdon', 'fsmh_createdby'], 'required'],
            [['fsmh_feesubscriptionmst_fk', 'fsmh_projectmst_fk', 'fsmh_standardcoursemst_fk', 'fsmh_standardcoursedtls_fk', 'fsmh_officetype', 'fsmh_feestype', 'fsmh_applicationtype', 'fsmh_headcount', 'fsmh_validityinyrs', 'fsmh_status', 'fsmh_createdby', 'fsmh_updatedby'], 'integer'],
            [['fsmh_rolemst_fk'], 'string'],
            [['fsmh_fee'], 'number'],
            [['fsmh_createdon', 'fsmh_updatedon'], 'safe'],
            [['fsmh_feesubscriptionmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeesubscriptionmstTbl::className(), 'targetAttribute' => ['fsmh_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']],
            [['fsmh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['fsmh_projectmst_fk' => 'projectmst_pk']],
            [['fsmh_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['fsmh_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['fsmh_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['fsmh_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feesubscriptionmsthsty_pk' => 'Feesubscriptionmsthsty Pk',
            'fsmh_feesubscriptionmst_fk' => 'Fsmh Feesubscriptionmst Fk',
            'fsmh_projectmst_fk' => 'Fsmh Projectmst Fk',
            'fsmh_standardcoursemst_fk' => 'Fsmh Standardcoursemst Fk',
            'fsmh_standardcoursedtls_fk' => 'Fsmh Standardcoursedtls Fk',
            'fsmh_officetype' => 'Fsmh Officetype',
            'fsmh_feestype' => 'Fsmh Feestype',
            'fsmh_rolemst_fk' => 'Fsmh Rolemst Fk',
            'fsmh_applicationtype' => 'Fsmh Applicationtype',
            'fsmh_headcount' => 'Fsmh Headcount',
            'fsmh_fee' => 'Fsmh Fee',
            'fsmh_validityinyrs' => 'Fsmh Validityinyrs',
            'fsmh_status' => 'Fsmh Status',
            'fsmh_createdon' => 'Fsmh Createdon',
            'fsmh_createdby' => 'Fsmh Createdby',
            'fsmh_updatedon' => 'Fsmh Updatedon',
            'fsmh_updatedby' => 'Fsmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmhFeesubscriptionmstFk()
    {
        return $this->hasOne(FeesubscriptionmstTbl::className(), ['feesubscriptionmst_pk' => 'fsmh_feesubscriptionmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'fsmh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmhStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'fsmh_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmhStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'fsmh_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeesubscriptionmsthstyTblQuery(get_called_class());
    }
}
