<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmssuppdocreqlistdtlshsty_tbl".
 *
 * @property int $cmssuppdocreqlistdtlshsty_pk Primary key
 * @property int $csdrldh_cmssuppdocreqlistdtls_fk Reference to cmssuppdocreqlistdtls_tbl.cmssuppdocreqlistdtls_pk
 * @property int $csdrldh_cmssuppdocreqlisthdrhsty_fk Reference to cmssuppdocreqlisthdrhsty_tbl
 * @property int $csdrldh_cmssdrldoccat_fk Reference to cmssdrldoccat_tbl
 * @property int $csdrldh_submittaltype Submittal Type: 1 - Copy, 2 - Electronic File, 3 - CD/DVD
 * @property int $csdrldh_submittalqty Submittal Quantity
 * @property int $csdrldh_interval interval count
 * @property int $csdrldh_intervaltype 1 - Days after Contract issuance, 2 - Weeks after Contract issuance, 3 - Months after contract issuance, 4 - With Material
 * @property int $csdrldh_reviewclass Review Class: 1 - Approval, 2 - Information
 * @property string $csdrldh_remarks Remarks
 * @property int $csdrldh_status 1 - Active, 2 - Inactive
 * @property string $csdrldh_createdon Date of creation
 * @property int $csdrldh_createdby Reference to usermst_tbl
 * @property string $csdrldh_createdbyipaddr User IP Address
 * @property string $csdrldh_updatedon Date of update
 * @property int $csdrldh_updatedby Reference to usermst_tbl
 * @property string $csdrldh_updatedbyipaddr User IP Address
 *
 * @property CmssdrldoccatTbl $csdrldhCmssdrldoccatFk
 * @property CmssuppdocreqlisthdrhstyTbl $csdrldhCmssuppdocreqlisthdrhstyFk
 * @property UsermstTbl $csdrldhCreatedby
 * @property UsermstTbl $csdrldhUpdatedby
 */
class CmssuppdocreqlistdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmssuppdocreqlistdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['csdrldh_cmssuppdocreqlistdtls_fk', 'csdrldh_cmssuppdocreqlisthdrhsty_fk', 'csdrldh_cmssdrldoccat_fk', 'csdrldh_submittaltype', 'csdrldh_submittalqty', 'csdrldh_reviewclass', 'csdrldh_status', 'csdrldh_createdon', 'csdrldh_createdby'], 'required'],
            [['csdrldh_cmssuppdocreqlistdtls_fk', 'csdrldh_cmssuppdocreqlisthdrhsty_fk', 'csdrldh_cmssdrldoccat_fk', 'csdrldh_submittaltype', 'csdrldh_submittalqty', 'csdrldh_interval', 'csdrldh_intervaltype', 'csdrldh_reviewclass', 'csdrldh_status', 'csdrldh_createdby', 'csdrldh_updatedby'], 'integer'],
            [['csdrldh_remarks'], 'string'],
            [['csdrldh_createdon', 'csdrldh_updatedon'], 'safe'],
            [['csdrldh_createdbyipaddr', 'csdrldh_updatedbyipaddr'], 'string', 'max' => 50],
            [['csdrldh_cmssdrldoccat_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssdrldoccatTbl::className(), 'targetAttribute' => ['csdrldh_cmssdrldoccat_fk' => 'cmssdrldoccat_pk']],
            [['csdrldh_cmssuppdocreqlisthdrhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmssuppdocreqlisthdrhstyTbl::className(), 'targetAttribute' => ['csdrldh_cmssuppdocreqlisthdrhsty_fk' => 'cmssuppdocreqlisthdrhsty_pk']],
            [['csdrldh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldh_createdby' => 'UserMst_Pk']],
            [['csdrldh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['csdrldh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmssuppdocreqlistdtlshsty_pk' => 'Cmssuppdocreqlistdtlshsty Pk',
            'csdrldh_cmssuppdocreqlistdtls_fk' => 'Csdrldh Cmssuppdocreqlistdtls Fk',
            'csdrldh_cmssuppdocreqlisthdrhsty_fk' => 'Csdrldh Cmssuppdocreqlisthdrhsty Fk',
            'csdrldh_cmssdrldoccat_fk' => 'Csdrldh Cmssdrldoccat Fk',
            'csdrldh_submittaltype' => 'Csdrldh Submittaltype',
            'csdrldh_submittalqty' => 'Csdrldh Submittalqty',
            'csdrldh_interval' => 'Csdrldh Interval',
            'csdrldh_intervaltype' => 'Csdrldh Intervaltype',
            'csdrldh_reviewclass' => 'Csdrldh Reviewclass',
            'csdrldh_remarks' => 'Csdrldh Remarks',
            'csdrldh_status' => 'Csdrldh Status',
            'csdrldh_createdon' => 'Csdrldh Createdon',
            'csdrldh_createdby' => 'Csdrldh Createdby',
            'csdrldh_createdbyipaddr' => 'Csdrldh Createdbyipaddr',
            'csdrldh_updatedon' => 'Csdrldh Updatedon',
            'csdrldh_updatedby' => 'Csdrldh Updatedby',
            'csdrldh_updatedbyipaddr' => 'Csdrldh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldhCmssdrldoccatFk()
    {
        return $this->hasOne(CmssdrldoccatTbl::className(), ['cmssdrldoccat_pk' => 'csdrldh_cmssdrldoccat_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldhCmssuppdocreqlisthdrhstyFk()
    {
        return $this->hasOne(CmssuppdocreqlisthdrhstyTbl::className(), ['cmssuppdocreqlisthdrhsty_pk' => 'csdrldh_cmssuppdocreqlisthdrhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCsdrldhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'csdrldh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmssuppdocreqlistdtlshstyTblQuery(get_called_class());
    }
}
