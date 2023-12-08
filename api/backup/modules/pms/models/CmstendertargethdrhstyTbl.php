<?php

namespace api\modules\pms\models;
use \common\models\UsermstTbl;
use \common\models\MemberregistrationmstTbl;
use api\modules\pms\models\CmstendertargetdtlsTbl;

use Yii;

/**
 * This is the model class for table "cmstendertargethdrhsty_tbl".
 *
 * @property int $cmstendertargethdrhsty_pk Primary key
 * @property int $cmstthh_cmstendertargethdr_fk Reference to cmstendertargethdr_tbl
 * @property int $cmstthh_cmstenderhdrhsty_fk Reference to cmstenderhdrhsty_tbl
 * @property int $cmstthh_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $cmstthh_targettype Targetted from: 1 - Shortlisted/ Pre-qualified from previous enquiry, 2 - JSRS, 3 - Non-JSRS
 *
 * @property CmstenderhdrhstyTbl $cmstthhCmstenderhdrhstyFk
 * @property CmstendertargethdrTbl $cmstthhCmstendertargethdrFk
 * @property MemberregistrationmstTbl $cmstthhMemberregmstFk
 */
class CmstendertargethdrhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstendertargethdrhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmstthh_cmstendertargethdr_fk', 'cmstthh_cmstenderhdrhsty_fk', 'cmstthh_memberregmst_fk', 'cmstthh_targettype'], 'required'],
            [['cmstthh_cmstendertargethdr_fk', 'cmstthh_cmstenderhdrhsty_fk', 'cmstthh_memberregmst_fk', 'cmstthh_targettype'], 'integer'],
            [['cmstthh_cmstenderhdrhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrhstyTbl::className(), 'targetAttribute' => ['cmstthh_cmstenderhdrhsty_fk' => 'cmstenderhdrhsty_pk']],
            //[['cmstthh_cmstendertargethdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstendertargethdrTbl::className(), 'targetAttribute' => ['cmstthh_cmstendertargethdr_fk' => 'cmstendertargethdr_pk']],
            [['cmstthh_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['cmstthh_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstendertargethdrhsty_pk' => 'Cmstendertargethdrhsty Pk',
            'cmstthh_cmstendertargethdr_fk' => 'Cmstthh Cmstendertargethdr Fk',
            'cmstthh_cmstenderhdrhsty_fk' => 'Cmstthh Cmstenderhdrhsty Fk',
            'cmstthh_memberregmst_fk' => 'Cmstthh Memberregmst Fk',
            'cmstthh_targettype' => 'Cmstthh Targettype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthhCmstenderhdrhstyFk()
    {
        return $this->hasOne(CmstenderhdrhstyTbl::className(), ['cmstenderhdrhsty_pk' => 'cmstthh_cmstenderhdrhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthhCmstendertargethdrFk()
    {
        return $this->hasOne(CmstendertargethdrTbl::className(), ['cmstendertargethdr_pk' => 'cmstthh_cmstendertargethdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthhMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'cmstthh_memberregmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstendertargethdrhstyTblQuery(get_called_class());
    }
}
