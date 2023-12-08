<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmsrqprodservtrnx_tbl".
 *
 * @property int $cmsrqprodservtrnx_pk Primary key
 * @property int $crpst_cmsprodservdtls_fk Reference to cmsrqprodservdtls_tbl
 * @property int $crpst_specmapmst_fk Reference to memcompprodspecmapmst_tbl, memcompservspecmapmst_tbl
 * @property int $crpst_specvaldtls_fk Reference to memcompspecprodvaldtls_tbl,memcompspecservvaldtls_tbl
 * @property int $crpst_svd_fk Reference to memcompspecprodvaldtls_tbl, memcompspecprodvaldtls_tbl stores dynamic sql pk
 * @property int $crpst_status 1 - Active, 2 - Inactive
 * @property string $crpst_createdon Date of creation
 * @property int $crpst_createdby Reference to usermst_tbl
 * @property string $crpst_createdbyipaddr User IP Address
 * @property string $crpst_updatedon Date of update
 * @property int $crpst_updatedby Reference to usermst_tbl
 * @property string $crpst_updatedbyipaddr User IP Address
 *
 * @property CmsrqprodservdtlsTbl $crpstCmsprodservdtlsFk
 * @property UsermstTbl $crpstCreatedby
 * @property UsermstTbl $crpstUpdatedby
 */
class CmsrqprodservtrnxTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsrqprodservtrnx_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['crpst_cmsprodservdtls_fk', 'crpst_specvaldtls_fk', 'crpst_status', 'crpst_createdon', 'crpst_createdby', 'crpst_createdbyipaddr'], 'required'],
            [['crpst_cmsprodservdtls_fk', 'crpst_specmapmst_fk', 'crpst_specvaldtls_fk', 'crpst_svd_fk', 'crpst_status', 'crpst_createdby', 'crpst_updatedby'], 'integer'],
            [['crpst_createdon', 'crpst_updatedon'], 'safe'],
            [['crpst_createdbyipaddr', 'crpst_updatedbyipaddr'], 'string', 'max' => 50],
            [['crpst_cmsprodservdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrqprodservdtlsTbl::className(), 'targetAttribute' => ['crpst_cmsprodservdtls_fk' => 'cmsrqprodservdtls_pk']],
            [['crpst_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['crpst_createdby' => 'UserMst_Pk']],
            [['crpst_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['crpst_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsrqprodservtrnx_pk' => 'Cmsrqprodservtrnx Pk',
            'crpst_cmsprodservdtls_fk' => 'Crpst Cmsprodservdtls Fk',
            'crpst_specmapmst_fk' => 'Crpst Specmapmst Fk',
            'crpst_specvaldtls_fk' => 'Crpst Specvaldtls Fk',
            'crpst_svd_fk' => 'Crpst Svd Fk',
            'crpst_status' => 'Crpst Status',
            'crpst_createdon' => 'Crpst Createdon',
            'crpst_createdby' => 'Crpst Createdby',
            'crpst_createdbyipaddr' => 'Crpst Createdbyipaddr',
            'crpst_updatedon' => 'Crpst Updatedon',
            'crpst_updatedby' => 'Crpst Updatedby',
            'crpst_updatedbyipaddr' => 'Crpst Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpstCmsprodservdtlsFk()
    {
        return $this->hasOne(CmsrqprodservdtlsTbl::className(), ['cmsrqprodservdtls_pk' => 'crpst_cmsprodservdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpstCreatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'crpst_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCrpstUpdatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'crpst_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservtrnxTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmsrqprodservtrnxTblQuery(get_called_class());
    }
}
