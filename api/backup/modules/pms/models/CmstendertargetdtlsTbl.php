<?php

namespace api\modules\pms\models;

use Yii;


/**
 * This is the model class for table "cmstendertargetdtls_tbl".
 *
 * @property int $cmstendertargetdtls_pk
 * @property int $cmsttd_cmstendertargethdr_fk Reference to cmstendertargethdr_tbl
 * @property int $cmstth_membecmsttd_emailid cmsttd_emailid
 * @property int $cmsttd_emailstatus 1 - Mail sent, 2 - Mail bounced, 3 - Mail Opened, 4 - Mail clicked
 *
 */
class CmstendertargetdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstendertargetdtls_tbl';
    }

      /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsttd_cmstendertargethdr_fk', 'cmsttd_cmstendertargethdr_fk', 'cmsttd_emailstatus'], 'required'],
            [['cmsttd_cmstendertargethdr_fk', 'cmsttd_emailstatus'], 'integer'],
           
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        [
            'cmstendertargetdtls_pk' => 'Cmsttd cmstendertargetdtls Pk',
            'cmsttd_cmstendertargethdr_fk' => 'Cmsttd cmstendertargethdr Fk',
            'cmsttd_emailstatus' => 'Cmsttd email status',
            'cmstth_membecmsttd_emailid' => 'Cmstth membecmsttd emailid'
        ];
    }
}