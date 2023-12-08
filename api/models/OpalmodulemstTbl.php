<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%opalmodulemst_tbl}}".
 *
 * @property int $opalmodulemst_pk used as primary key
 * @property int $omm_opalstkholdertypmst_fk Reference to opalstkholdertypmst_pk
 * @property string $omm_name_en name/description of the module in English
 * @property string $omm_name_ar name/description of the module in Arabic
 * @property string $omm_infocontent_en Info content of the module in English
 * @property string $omm_infocontent_ar Info content of the module in Arabic
 * @property int $omm_order
 * @property string $omm_crudaccess 1 - create,2-view,3- update,4-delete,5-Approval,6-Download
 * @property int $omm_status if the module is active or not...active  - 1, inactive – 2
 * @property string $omm_createdon datetime of creation
 * @property int $omm_createdby reference to opalusemst_tbl
 * @property string $omm_updatedon datetime of updation
 * @property int $omm_updatedby reference to opalusermst_tbl
 *
 * @property FilemstTbl[] $filemstTbls
 * @property OpalstkholdertypmstTbl $ommOpalstkholdertypmstFk
 * @property OpalsubmodulemstTbl[] $opalsubmodulemstTbls
 * @property RoleallocationdtlsTbl[] $roleallocationdtlsTbls
 * @property UseraccessallocationdtlsTbl[] $useraccessallocationdtlsTbls
 * @property UseraccessallocationhstyTbl[] $useraccessallocationhstyTbls
 */
class OpalmodulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%opalmodulemst_tbl}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['omm_opalstkholdertypmst_fk', 'omm_name_en', 'omm_name_ar', 'omm_order', 'omm_status', 'omm_createdby'], 'required'],
            [['omm_opalstkholdertypmst_fk', 'omm_order', 'omm_status', 'omm_createdby', 'omm_updatedby'], 'integer'],
            [['omm_infocontent_en', 'omm_infocontent_ar'], 'string'],
            [['omm_createdon', 'omm_updatedon'], 'safe'],
            [['omm_name_en', 'omm_name_ar'], 'string', 'max' => 250],
            [['omm_crudaccess'], 'string', 'max' => 15],
            [['omm_opalstkholdertypmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstkholdertypmstTbl::className(), 'targetAttribute' => ['omm_opalstkholdertypmst_fk' => 'opalstkholdertypmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalmodulemst_pk' => 'Opalmodulemst Pk',
            'omm_opalstkholdertypmst_fk' => 'Omm Opalstkholdertypmst Fk',
            'omm_name_en' => 'Omm Name En',
            'omm_name_ar' => 'Omm Name Ar',
            'omm_infocontent_en' => 'Omm Infocontent En',
            'omm_infocontent_ar' => 'Omm Infocontent Ar',
            'omm_order' => 'Omm Order',
            'omm_crudaccess' => 'Omm Crudaccess',
            'omm_status' => 'Omm Status',
            'omm_createdon' => 'Omm Createdon',
            'omm_createdby' => 'Omm Createdby',
            'omm_updatedon' => 'Omm Updatedon',
            'omm_updatedby' => 'Omm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilemstTbls()
    {
        return $this->hasMany(FilemstTbl::className(), ['fm_modulemst_fk' => 'opalmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOmmOpalstkholdertypmstFk()
    {
        return $this->hasOne(OpalstkholdertypmstTbl::className(), ['opalstkholdertypmst_pk' => 'omm_opalstkholdertypmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalsubmodulemstTbls()
    {
        return $this->hasMany(OpalsubmodulemstTbl::className(), ['osmm_opalmodulemst_fk' => 'opalmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleallocationdtlsTbls()
    {
        return $this->hasMany(RoleallocationdtlsTbl::className(), ['rad_OpalModuleMst_FK' => 'opalmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUseraccessallocationdtlsTbls()
    {
        return $this->hasMany(UseraccessallocationdtlsTbl::className(), ['uaad_OpalModuleMst_FK' => 'opalmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUseraccessallocationhstyTbls()
    {
        return $this->hasMany(UseraccessallocationhstyTbl::className(), ['uaah_OpalModuleMst_FK' => 'opalmodulemst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalmodulemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalmodulemstTblQuery(get_called_class());
    }
}
