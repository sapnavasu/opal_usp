<?php

namespace api\modules\pms\models;

use Yii;
use \common\models\UsermstTbl;
use \common\models\MemberregistrationmstTbl;
use api\modules\pms\models\CmstendertargetdtlsTbl;

/**
 * This is the model class for table "cmstendertargethdrtemp_tbl".
 *
 * @property int $cmstendertargethdrtemp_pk Primary key
 * @property int $cmsttht_cmstenderhdrtemp_fk Reference to cmstenderhdrtemp_tbl
 * @property int $cmsttht_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $cmsttht_targettype Targetted from: 1 - Shortlisted/ Pre-qualified from previous enquiry, 2 - JSRS, 3 - Non-JSRS
 *
 * @property CmstenderhdrtempTbl $cmstthtCmstenderhdrtempFk
 * @property MemberregistrationmstTbl $cmstthtMemberregmstFk
 */
class CmstendertargethdrtempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstendertargethdrtemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsttht_cmstenderhdrtemp_fk', 'cmsttht_memberregmst_fk', 'cmsttht_targettype', 'cmsttht_mailfor'], 'required'],
            [['cmsttht_cmstenderhdrtemp_fk', 'cmsttht_memberregmst_fk', 'cmsttht_targettype', 'cmsttht_mailfor'], 'integer'],
            [['cmsttht_cmstenderhdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrtempTbl::className(), 'targetAttribute' => ['cmsttht_cmstenderhdrtemp_fk' => 'cmstenderhdrtemp_pk']],
            [['cmsttht_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['cmsttht_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstendertargethdrtemp_pk' => 'Cmstendertargethdrtemp Pk',
            'cmsttht_cmstenderhdrtemp_fk' => 'Cmsttht Cmstenderhdrtemp Fk',
            'cmsttht_memberregmst_fk' => 'Cmsttht Memberregmst Fk',
            'cmsttht_targettype' => 'Cmsttht Targettype',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthtCmstenderhdrtempFk()
    {
        return $this->hasOne(CmstenderhdrtempTbl::className(), ['cmstenderhdrtemp_pk' => 'cmsttht_cmstenderhdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthtMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'cmsttht_memberregmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargethdrtempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstendertargethdrtempTblQuery(get_called_class());
    }
}
