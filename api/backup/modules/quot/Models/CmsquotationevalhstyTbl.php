<?php

namespace api\modules\quot\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmsquotationevalhsty_tbl".
 *
 * @property int $cmsquotationevalhsty_pk Primary key
 * @property int $cmsqeh_cmsquotationhdr_fk Reference to membercompanymst_tbl
 * @property int $cmsqeh_status 5 - Shortlisted, 6- Rejected,  7 - Awarded
 * @property string $cmsqeh_comment Quotation Status Comment
 * @property string $cmsqeh_createdon Date of creation
 * @property int $cmsqeh_createdby Reference to usermst_tbl
 * @property string $cmsqeh_createdbyipaddr User IP Address
 * @property string $cmsqeh_updatedon Date of update
 * @property int $cmsqeh_updatedby Reference to usermst_tbl
 * @property string $cmsqeh_updatedbyipaddr User IP Address
 *
 * @property CmsquotationhdrTbl $cmsqehCmsquotationhdrFk
 * @property UsermstTbl $cmsqehCreatedby
 * @property UsermstTbl $cmsqehUpdatedby
 */

class CmsquotationevalhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsquotationevalhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsqeh_cmsquotationhdr_fk', 'cmsqeh_status', 'cmsqeh_createdby', 'cmsqeh_updatedby'], 'integer'],
            [['cmsqeh_cmsquotationhdr_fk', 'cmsqeh_status', 'cmsqeh_createdby'], 'required'],
            [['cmsqeh_createdon', 'cmsqeh_updatedon'], 'safe'],
            [['cmsqeh_comment'], 'string'],
            [['cmsqeh_cmsquotationhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsquotationhdrTbl::className(), 'targetAttribute' => ['cmsqeh_cmsquotationhdr_fk' => 'cmsquotationhdr_pk']],
            [['cmsqeh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqeh_createdby' => 'UserMst_Pk']],
            [['cmsqeh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsqeh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsquotationevalhsty_pk' => 'Cmsquotationhdr Pk',
            'cmsqeh_cmsquotationhdr_fk' => 'Cmsqeh Memcompmst Fk',
            'cmsqeh_status' => 'Cmsqeh Cmstenderhdr Fk',
            'cmsqeh_comment' => 'Cmsqeh Type',
            'cmsqeh_createdon' => 'Cmsqeh Createdon',
            'cmsqeh_createdby' => 'Cmsqeh Createdby',
            'cmsqeh_createdbyipaddr' => 'Cmsqeh Createdbyipaddr',
            'cmsqeh_updatedon' => 'Cmsqeh Updatedon',
            'cmsqeh_updatedby' => 'Cmsqeh Updatedby',
            'cmsqeh_updatedbyipaddr' => 'Cmsqeh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsquotationhdrTbl(){
        return $this->hasOne(CmsquotationhdrTbl::class,  ['cmsquotationhdr_pk' => 'cmsqeh_cmsquotationhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsqehCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsqeh_createdby']);
    }
}
