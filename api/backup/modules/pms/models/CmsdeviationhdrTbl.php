<?php

namespace api\modules\pms\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "cmsdeviationhdr_tbl".
 *
 * @property int $cmsdeviationhdr_pk Primary key
 * @property int $cmsdh_shared_fk Reference to cmsquotationhdr_tbl
 * @property int $cmsdh_shared_type 1 - Quotation Deviation
 * @property string $cmsdh_itemno Item Number
 * @property string $cmsdh_currequirement Current Requirement
 * @property string $cmsdh_requestdeviation Requested Deviations
 * @property string $cmsdh_reasondeviation Reason for Deviations
 * @property string $cmsdh_createdon Date of creation
 * @property int $cmsdh_createdby Reference to usermst_tbl
 * @property string $cmsdh_createdbyipaddr User IP Address
 * @property string $cmsdh_updatedon Date of update
 * @property int $cmsdh_updatedby Reference to usermst_tbl
 * @property string $cmsdh_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $cmsdhCreatedby
 * @property CmsquotationhdrTbl $cmsdhSharedFk
 * @property UsermstTbl $cmsdhUpdatedby
 */
class CmsdeviationhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsdeviationhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsdh_shared_fk', 'cmsdh_shared_type', 'cmsdh_itemno', 'cmsdh_createdon', 'cmsdh_createdby'], 'required'],
            [['cmsdh_shared_fk', 'cmsdh_shared_type', 'cmsdh_createdby', 'cmsdh_updatedby'], 'integer'],
            [['cmsdh_currequirement', 'cmsdh_requestdeviation', 'cmsdh_reasondeviation'], 'string'],
            [['cmsdh_createdon', 'cmsdh_updatedon'], 'safe'],
            [['cmsdh_itemno', 'cmsdh_createdbyipaddr', 'cmsdh_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmsdh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsdh_createdby' => 'UserMst_Pk']],
            [['cmsdh_shared_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\quot\models\CmsquotationhdrTbl::className(), 'targetAttribute' => ['cmsdh_shared_fk' => 'cmsquotationhdr_pk']],
            [['cmsdh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmsdh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsdeviationhdr_pk' => 'Cmsdeviationhdr Pk',
            'cmsdh_shared_fk' => 'Cmsdh Shared Fk',
            'cmsdh_shared_type' => 'Cmsdh Shared Type',
            'cmsdh_itemno' => 'Cmsdh Itemno',
            'cmsdh_currequirement' => 'Cmsdh Currequirement',
            'cmsdh_requestdeviation' => 'Cmsdh Requestdeviation',
            'cmsdh_reasondeviation' => 'Cmsdh Reasondeviation',
            'cmsdh_createdon' => 'Cmsdh Createdon',
            'cmsdh_createdby' => 'Cmsdh Createdby',
            'cmsdh_createdbyipaddr' => 'Cmsdh Createdbyipaddr',
            'cmsdh_updatedon' => 'Cmsdh Updatedon',
            'cmsdh_updatedby' => 'Cmsdh Updatedby',
            'cmsdh_updatedbyipaddr' => 'Cmsdh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsdh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdhSharedFk()
    {
        return $this->hasOne(CmsquotationhdrTbl::className(), ['cmsquotationhdr_pk' => 'cmsdh_shared_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmsdhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmsdh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsdeviationhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsdeviationhdrTblQuery(get_called_class());
    }
}
