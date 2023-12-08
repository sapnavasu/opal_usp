<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmstendertargetdtlstemp_tbl".
 *
 * @property int $cmstendertargetdtlstemp_pk Primary key
 * @property int $cmsttdt_cmstendertargethdrtemp_fk Reference to cmstendertargethdrtemp_tbl
 * @property string $cmsttdt_emailid Email id
 * @property int $cmsttdt_emailstatus 1 - Mail sent, 2 - Mail bounced, 3 - Mail Opened, 4 - Mail clicked
 * @property int $cmsttdt_mailfor 1 - New, 2 - Update
 *
 * @property CmstendertargethdrtempTbl $cmsttdtCmstendertargethdrtempFk
 */
class CmstendertargetdtlstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstendertargetdtlstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsttdt_cmstendertargethdrtemp_fk', 'cmsttdt_emailid', 'cmsttdt_emailstatus', 'cmsttdt_mailfor'], 'required'],
            [['cmsttdt_cmstendertargethdrtemp_fk', 'cmsttdt_emailstatus', 'cmsttdt_mailfor'], 'integer'],
            [['cmsttdt_emailid'], 'string'],
            [['cmsttdt_cmstendertargethdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstendertargethdrtempTbl::className(), 'targetAttribute' => ['cmsttdt_cmstendertargethdrtemp_fk' => 'cmstendertargethdrtemp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstendertargetdtlstemp_pk' => 'Cmstendertargetdtlstemp Pk',
            'cmsttdt_cmstendertargethdrtemp_fk' => 'Cmsttdt Cmstendertargethdrtemp Fk',
            'cmsttdt_emailid' => 'Cmsttdt Emailid',
            'cmsttdt_emailstatus' => 'Cmsttdt Emailstatus',
            'cmsttdt_mailfor' => 'Cmsttdt Mailfor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsttdtCmstendertargethdrtempFk()
    {
        return $this->hasOne(CmstendertargethdrtempTbl::className(), ['cmstendertargethdrtemp_pk' => 'cmsttdt_cmstendertargethdrtemp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmstendertargetdtlstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmstendertargetdtlstempTblQuery(get_called_class());
    }
}
