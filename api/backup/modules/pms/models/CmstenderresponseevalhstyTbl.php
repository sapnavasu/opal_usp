<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmstenderresponseevalhsty_tbl".
 *
 * @property int $cmstenderresponseevalhsty_pk Primary key
 * @property int $ctreh_cmstenderresponse_fk Reference to membercompanymst_tbl
 * @property int $ctreh_status 5 - Shortlisted, 6- Rejected,  7 - Awarded
 * @property string $ctreh_comment Tender Response Comment
 * @property string $ctreh_createdon Date of creation
 * @property int $ctreh_createdby Reference to usermst_tbl
 * @property string $ctreh_createdbyipaddr User IP Address
 * @property string $ctreh_updatedon Date of update
 * @property int $ctreh_updatedby Reference to usermst_tbl
 * @property string $ctreh_updatedbyipaddr User IP Address
 *
 * @property CmstenderresponseTbl $ctrehCmstenderresponseFk
 * @property UsermstTbl $ctrehCreatedby
 * @property UsermstTbl $ctrehUpdatedby
 */

class CmstenderresponseevalhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmstenderresponseevalhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctreh_cmstenderresponse_fk', 'ctreh_status', 'ctreh_createdby', 'ctreh_updatedby'], 'integer'],
            [['ctreh_cmstenderresponse_fk', 'ctreh_status', 'ctreh_createdby'], 'required'],
            [['ctreh_createdon', 'ctreh_updatedon'], 'safe'],
            [['ctreh_comment'], 'string'],
            [['ctreh_cmstenderresponse_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderresponseTbl::className(), 'targetAttribute' => ['ctreh_cmstenderresponse_fk' => 'cmstenderresponse_pk']],
            [['ctreh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctreh_createdby' => 'UserMst_Pk']],
            [['ctreh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ctreh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmstenderresponseevalhsty_pk' => 'Cmstenderresponse Pk',
            'ctreh_cmstenderresponse_fk' => 'Ctreh Memcompmst Fk',
            'ctreh_status' => 'Ctreh Cmstender Fk',
            'ctreh_comment' => 'Ctreh Type',
            'ctreh_createdon' => 'Ctreh Createdon',
            'ctreh_createdby' => 'Ctreh Createdby',
            'ctreh_createdbyipaddr' => 'Ctreh Createdbyipaddr',
            'ctreh_updatedon' => 'Ctreh Updatedon',
            'ctreh_updatedby' => 'Ctreh Updatedby',
            'ctreh_updatedbyipaddr' => 'Ctreh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmstenderresponseTbl(){
        return $this->hasOne(CmstenderresponseTbl::class,  ['cmstenderresponse_pk' => 'ctreh_cmstenderresponse_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtrehCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ctreh_createdby']);
    }
}
