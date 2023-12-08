<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmssuppdocreqlistdtls_tbl".
 *
 * @property int $cmssuppdocreqlistdtls_pk Primary key
 * @property int $csdrld_cmssuppdocreqlisthdr_fk Reference to cmssuppdocreqlisthdr_tbl
 * @property int $csdrld_cmssdrldoccat_fk Reference to cmssdrldoccat_tbl
 * @property int $csdrld_submittaltype Submittal Type: 1 - Copy, 2 - Electronic File, 3 - CD/DVD
 * @property int $csdrld_submittalqty Submittal Quantity
 * @property int $csdrld_interval interval count
 * @property int $csdrld_intervaltype 1 - Days after Contract issuance, 2 - Weeks after Contract issuance, 3 - Months after contract issuance, 4 - With Material
 * @property int $csdrld_reviewclass Review Class: 1 - Approval, 2 - Information
 * @property string $csdrld_remarks Remarks
 * @property int $csdrld_status 1 - Active, 2 - Inactive
 * @property string $csdrld_createdon Date of creation
 * @property int $csdrld_createdby Reference to usermst_tbl
 * @property string $csdrld_createdbyipaddr User IP Address
 * @property string $csdrld_updatedon Date of update
 * @property int $csdrld_updatedby Reference to usermst_tbl
 * @property string $csdrld_updatedbyipaddr User IP Address
 *
 * @property CmssdrldoccatTbl $csdrldCmssdrldoccatFk
 * @property CmssuppdocreqlisthdrTbl $csdrldCmssuppdocreqlisthdrFk
 * @property UsermstTbl $csdrldCreatedby
 * @property UsermstTbl $csdrldUpdatedby
 */
class CmssuppdocreqlistdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlistdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrld_cmssuppdocreqlisthdr_fk', 'csdrld_cmssdrldoccat_fk', 'csdrld_submittaltype', 'csdrld_submittalqty', 'csdrld_reviewclass', 'csdrld_status', 'csdrld_createdon', 'csdrld_createdby'], 'required'],
            [['csdrld_cmssuppdocreqlisthdr_fk', 'csdrld_cmssdrldoccat_fk', 'csdrld_submittaltype', 'csdrld_submittalqty', 'csdrld_interval', 'csdrld_intervaltype', 'csdrld_reviewclass', 'csdrld_status', 'csdrld_createdby', 'csdrld_updatedby'], 'integer'],
            [['csdrld_remarks'], 'string'],
            [['csdrld_createdon', 'csdrld_updatedon'], 'safe'],
            [['csdrld_createdbyipaddr', 'csdrld_updatedbyipaddr'], 'string', 'max' => 50],
            [['csdrld_cmssdrldoccat_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssdrldoccatTbl::className(), 'targetAttribute' => ['csdrld_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']],
            [['csdrld_cmssuppdocreqlisthdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssuppdocreqlisthdrTbl::className(), 'targetAttribute' => ['csdrld_cmssuppdocreqlisthdr_fk' => 'cmssuppdocreqlisthdr_pk']],
            [['csdrld_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrld_createdby' => 'UserMst_Pk']],
            [['csdrld_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrld_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlistdtls_pk' => 'Cmssuppdocreqlistdtls Pk',
            'csdrld_cmssuppdocreqlisthdr_fk' => 'Csdrld Cmssuppdocreqlisthdr Fk',
            'csdrld_cmssdrldoccat_fk' => 'Csdrld Cmssdrldoccat Fk',
            'csdrld_submittaltype' => 'Csdrld Submittaltype',
            'csdrld_submittalqty' => 'Csdrld Submittalqty',
            'csdrld_interval' => 'Csdrld Interval',
            'csdrld_intervaltype' => 'Csdrld Intervaltype',
            'csdrld_reviewclass' => 'Csdrld Reviewclass',
            'csdrld_remarks' => 'Csdrld Remarks',
            'csdrld_status' => 'Csdrld Status',
            'csdrld_createdon' => 'Csdrld Createdon',
            'csdrld_createdby' => 'Csdrld Createdby',
            'csdrld_createdbyipaddr' => 'Csdrld Createdbyipaddr',
            'csdrld_updatedon' => 'Csdrld Updatedon',
            'csdrld_updatedby' => 'Csdrld Updatedby',
            'csdrld_updatedbyipaddr' => 'Csdrld Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldCmssdrldoccatFk()
    {
        return $this->hasOne(CmssdrldoccatTbl::className(), ['cmssdrldoccat_pk' => 'csdrld_cmssdrldoccat_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldCmssuppdocreqlisthdrFk()
    {
        return $this->hasOne(CmssuppdocreqlisthdrTbl::className(), ['cmssuppdocreqlisthdr_pk' => 'csdrld_cmssuppdocreqlisthdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrld_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrld_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlistdtlsTblQuery(get_called_class());
    }
}
