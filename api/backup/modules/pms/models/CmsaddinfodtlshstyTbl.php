<?php

namespace api\modules\pms\models;

use \common\models\UsermstTbl;
use common\components\Security;
use Yii;

/**
 * This is the model class for table "cmsaddinfodtlshsty_tbl".
 *
 * @property int $cmsaddinfodtlshsty_pk Primary key
 * @property int $caidh_cmsaddinfodtls_fk Reference to cmsaddinfodtls_tbl
 * @property int $caidh_cmstenderhdrhsty_fk Reference to cmstenderhdrhsty_tbl
 * @property string $caidh_title Title
 * @property string $caidh_description Description
 * @property int $caidh_index index
 * @property int $caidh_status 1 - Active, 2 - Inactive
 * @property string $caidh_createdon Date of creation
 * @property int $caidh_createdby Reference to usermst_tbl
 * @property string $caidh_createdbyipaddr User IP Address
 * @property string $caidh_updatedon Date of update
 * @property int $caidh_updatedby Reference to usermst_tbl
 * @property string $caidh_updatedbyipaddr User IP Address
 *
 * @property CmsaddinfodtlsTbl $caidhCmsaddinfodtlsFk
 * @property CmstenderhdrhstyTbl $caidhCmstenderhdrhstyFk
 * @property UsermstTbl $caidhCreatedby
 * @property UsermstTbl $caidhUpdatedby
 */
class CmsaddinfodtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsaddinfodtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caidh_cmsaddinfodtls_fk', 'caidh_cmstenderhdrhsty_fk', 'caidh_title', 'caidh_description', 'caidh_status'], 'required'],
            [['caidh_cmsaddinfodtls_fk', 'caidh_cmstenderhdrhsty_fk', 'caidh_index', 'caidh_status', 'caidh_createdby', 'caidh_updatedby'], 'integer'],
            [['caidh_title', 'caidh_description'], 'string'],
            [['caidh_createdon', 'caidh_updatedon'], 'safe'],
            [['caidh_createdbyipaddr', 'caidh_updatedbyipaddr'], 'string', 'max' => 50],
            [['caidh_cmsaddinfodtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsaddinfodtlsTbl::className(), 'targetAttribute' => ['caidh_cmsaddinfodtls_fk' => 'cmsaddinfodtls_pk']],
            [['caidh_cmstenderhdrhsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrhstyTbl::className(), 'targetAttribute' => ['caidh_cmstenderhdrhsty_fk' => 'cmstenderhdrhsty_pk']],
            [['caidh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caidh_createdby' => 'UserMst_Pk']],
            [['caidh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['caidh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsaddinfodtlshsty_pk' => 'Cmsaddinfodtlshsty Pk',
            'caidh_cmsaddinfodtls_fk' => 'Caidh Cmsaddinfodtls Fk',
            'caidh_cmstenderhdrhsty_fk' => 'Caidh Cmstenderhdrhsty Fk',
            'caidh_title' => 'Caidh Title',
            'caidh_description' => 'Caidh Description',
            'caidh_index' => 'Caidh Index',
            'caidh_status' => 'Caidh Status',
            'caidh_createdon' => 'Caidh Createdon',
            'caidh_createdby' => 'Caidh Createdby',
            'caidh_createdbyipaddr' => 'Caidh Createdbyipaddr',
            'caidh_updatedon' => 'Caidh Updatedon',
            'caidh_updatedby' => 'Caidh Updatedby',
            'caidh_updatedbyipaddr' => 'Caidh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidhCmsaddinfodtlsFk()
    {
        return $this->hasOne(CmsaddinfodtlsTbl::className(), ['cmsaddinfodtls_pk' => 'caidh_cmsaddinfodtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidhCmstenderhdrhstyFk()
    {
        return $this->hasOne(CmstenderhdrhstyTbl::className(), ['cmstenderhdrhsty_pk' => 'caidh_cmstenderhdrhsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caidh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaidhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'caidh_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsaddinfodtlshstyTblQuery(get_called_class());
    }
}
