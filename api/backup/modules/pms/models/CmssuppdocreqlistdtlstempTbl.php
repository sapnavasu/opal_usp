<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;

/**
 * This is the model class for table "cmssuppdocreqlistdtlstemp_tbl".
 *
 * @property int $cmssuppdocreqlistdtlstemp_pk Primary key
 * @property int $csdrldt_cmssuppdocreqlisthdrtemp_fk Reference to cmssuppdocreqlisthdrtemp_tbl
 * @property int $csdrldt_cmssdrldoccat_fk Reference to cmssdrldoccat_tbl
 * @property int $csdrldt_submittaltype Submittal Type: 1 - Copy, 2 - Electronic File, 3 - CD/DVD
 * @property int $csdrldt_submittalqty Submittal Quantity
 * @property int $csdrldt_interval interval count
 * @property int $csdrldt_intervaltype 1 - Days after Contract issuance, 2 - Weeks after Contract issuance, 3 - Months after contract issuance, 4 - With Material
 * @property int $csdrldt_reviewclass Review Class: 1 - Approval, 2 - Information
 * @property string $csdrldt_remarks Remarks
 * @property int $csdrldt_status 1 - Active, 2 - Inactive
 * @property string $csdrldt_createdon Date of creation
 * @property int $csdrldt_createdby Reference to usermst_tbl
 * @property string $csdrldt_createdbyipaddr User IP Address
 * @property string $csdrldt_updatedon Date of update
 * @property int $csdrldt_updatedby Reference to usermst_tbl
 * @property string $csdrldt_updatedbyipaddr User IP Address
 *
 * @property CmssdrldoccatTbl $csdrldtCmssdrldoccatFk
 * @property CmssuppdocreqlisthdrtempTbl $csdrldtCmssuppdocreqlisthdrtempFk
 * @property UsermstTbl $csdrldtCreatedby
 * @property UsermstTbl $csdrldtUpdatedby
 */
class CmssuppdocreqlistdtlstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlistdtlstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrldt_cmssuppdocreqlisthdrtemp_fk', 'csdrldt_cmssdrldoccat_fk', 'csdrldt_submittaltype', 'csdrldt_submittalqty', 'csdrldt_reviewclass', 'csdrldt_status', 'csdrldt_createdon', 'csdrldt_createdby'], 'required'],
            [['csdrldt_cmssuppdocreqlisthdrtemp_fk', 'csdrldt_cmssdrldoccat_fk', 'csdrldt_submittaltype', 'csdrldt_submittalqty', 'csdrldt_interval', 'csdrldt_intervaltype', 'csdrldt_reviewclass', 'csdrldt_status', 'csdrldt_createdby', 'csdrldt_updatedby'], 'integer'],
            [['csdrldt_remarks'], 'string'],
            [['csdrldt_createdon', 'csdrldt_updatedon'], 'safe'],
            [['csdrldt_createdbyipaddr', 'csdrldt_updatedbyipaddr'], 'string', 'max' => 50],
            [['csdrldt_cmssdrldoccat_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssdrldoccatTbl::className(), 'targetAttribute' => ['csdrldt_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']],
            [['csdrldt_cmssuppdocreqlisthdrtemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssuppdocreqlisthdrtempTbl::className(), 'targetAttribute' => ['csdrldt_cmssuppdocreqlisthdrtemp_fk' => 'cmssuppdocreqlisthdrtemp_pk']],
            [['csdrldt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldt_createdby' => 'UserMst_Pk']],
            [['csdrldt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlistdtlstemp_pk' => 'Cmssuppdocreqlistdtlstemp Pk',
            'csdrldt_cmssuppdocreqlisthdrtemp_fk' => 'Csdrldt Cmssuppdocreqlisthdrtemp Fk',
            'csdrldt_cmssdrldoccat_fk' => 'Csdrldt Cmssdrldoccat Fk',
            'csdrldt_submittaltype' => 'Csdrldt Submittaltype',
            'csdrldt_submittalqty' => 'Csdrldt Submittalqty',
            'csdrldt_interval' => 'Csdrldt Interval',
            'csdrldt_intervaltype' => 'Csdrldt Intervaltype',
            'csdrldt_reviewclass' => 'Csdrldt Reviewclass',
            'csdrldt_remarks' => 'Csdrldt Remarks',
            'csdrldt_status' => 'Csdrldt Status',
            'csdrldt_createdon' => 'Csdrldt Createdon',
            'csdrldt_createdby' => 'Csdrldt Createdby',
            'csdrldt_createdbyipaddr' => 'Csdrldt Createdbyipaddr',
            'csdrldt_updatedon' => 'Csdrldt Updatedon',
            'csdrldt_updatedby' => 'Csdrldt Updatedby',
            'csdrldt_updatedbyipaddr' => 'Csdrldt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldtCmssdrldoccatFk()
    {
        return $this->hasOne(CmssdrldoccatTbl::className(), ['cmssdrldoccat_pk' => 'csdrldt_cmssdrldoccat_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldtCmssuppdocreqlisthdrtempFk()
    {
        return $this->hasOne(CmssuppdocreqlisthdrtempTbl::className(), ['cmssuppdocreqlisthdrtemp_pk' => 'csdrldt_cmssuppdocreqlisthdrtemp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldtCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldt_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlistdtlstempTblQuery(get_called_class());
    }
}
