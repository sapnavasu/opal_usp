<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "workflowmgmt_tbl".
 *
 * @property string $workflowmgmt_pk Primary key
 * @property int $wfm_basemoduleulemst_fk Reference to basemodulemst_tbl
 * @property int $wfm_basesubmodule Reference to basemodulemst_tbl
 * @property int $wfm_stkholdtype Reference to stkholdertypmst_tbl
 * @property int $wfm_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $wfm_status 1 - Active, 2 - Inactive
 * @property string $wfm_allocatedon Date of allocation
 * @property int $wfm_allocatedby Reference to usermst_tbl
 *
 * @property UsermstTbl $wfmAllocatedby
 * @property BasemodulemstTbl $wfmBasemoduleulemstFk
 * @property BasemodulemstTbl $wfmBasesubmodule
 * @property MembercompanymstTbl $wfmMemcompmstFk
 * @property StkholdertypmstTbl $wfmStkholdtype
 */
class WorkflowmgmtTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workflowmgmt_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wfm_basemoduleulemst_fk', 'wfm_basesubmodule', 'wfm_stkholdtype', 'wfm_memcompmst_fk', 'wfm_status', 'wfm_allocatedon', 'wfm_allocatedby'], 'required'],
            [['wfm_basemoduleulemst_fk', 'wfm_basesubmodule', 'wfm_stkholdtype', 'wfm_memcompmst_fk', 'wfm_status', 'wfm_allocatedby'], 'integer'],
            [['wfm_allocatedon'], 'safe'],
            [['wfm_allocatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['wfm_allocatedby' => 'UserMst_Pk']],
            [['wfm_basemoduleulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\BasemodulemstTbl::className(), 'targetAttribute' => ['wfm_basemoduleulemst_fk' => 'basemodulemst_pk']],
            [['wfm_basesubmodule'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\BasemodulemstTbl::className(), 'targetAttribute' => ['wfm_basesubmodule' => 'basemodulemst_pk']],
            [['wfm_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['wfm_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['wfm_stkholdtype'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\StkholdertypmstTbl::className(), 'targetAttribute' => ['wfm_stkholdtype' => 'stkholdertypmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'workflowmgmt_pk' => 'Workflowmgmt Pk',
            'wfm_basemoduleulemst_fk' => 'Wfm Basemoduleulemst Fk',
            'wfm_basesubmodule' => 'Wfm Basesubmodule',
            'wfm_stkholdtype' => 'Wfm Stkholdtype',
            'wfm_memcompmst_fk' => 'Wfm Memcompmst Fk',
            'wfm_status' => 'Wfm Status',
            'wfm_allocatedon' => 'Wfm Allocatedon',
            'wfm_allocatedby' => 'Wfm Allocatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWfmAllocatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'wfm_allocatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWfmBasemoduleulemstFk()
    {
        return $this->hasOne(BasemodulemstTbl::className(), ['basemodulemst_pk' => 'wfm_basemoduleulemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWfmBasesubmodule()
    {
        return $this->hasOne(BasemodulemstTbl::className(), ['basemodulemst_pk' => 'wfm_basesubmodule']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWfmMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'wfm_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWfmStkholdtype()
    {
        return $this->hasOne(StkholdertypmstTbl::className(), ['stkholdertypmst_pk' => 'wfm_stkholdtype']);
    }

    /**
     * {@inheritdoc}
     * @return WorkflowmgmtTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkflowmgmtTblQuery(get_called_class());
    }
}