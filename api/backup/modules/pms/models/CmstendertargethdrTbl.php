<?php

namespace api\modules\pms\models;

use Yii;
use \common\models\UsermstTbl;
use \common\models\MemberregistrationmstTbl;
use api\modules\pms\models\CmstendertargetdtlsTbl;



/**
 * This is the model class for table "cmstendertargethdr_tbl".
 *
 * @property int $cmstendertargethdr_pk
 * @property int $cmstth_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property int $cmstth_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $cmstth_targettype 1- Shortlisted/ Pre-qualified from previous enquiry, 2- JSRS, 3- Non-JSRS
 *
 */
class CmstendertargethdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstendertargethdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmstth_cmstenderhdr_fk', 'cmstth_memberregmst_fk', 'cmstth_targettype'], 'required'],
            [['cmstth_cmstenderhdr_fk', 'cmstth_memberregmst_fk', 'cmstth_targettype'], 'integer'],
            [['cmstth_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['cmstth_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['cmstth_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['cmstth_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstth_cmstenderhdr_fk' => 'Cmstth Cmstenderhdr Fk',
            'cmstth_memberregmst_fk' => 'Cmstth Memberregmst Fk',
            'cmstth_targettype' => 'Cmstth Target Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsTender()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'cmstth_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstthMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'cmstth_memberregmst_fk']);
    }
    

    public static function saveData($data) {
        $model = new self();     
        $model->attributes = $data;
        $model->save();
    }

      /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstendertargetdtlsTbl()
    {
        return $this->hasOne(CmstendertargetdtlsTbl::className(), ['cmstendertargetdtls_pk' => 'cmsttd_cmstendertargethdr_fk']);
    }
}
