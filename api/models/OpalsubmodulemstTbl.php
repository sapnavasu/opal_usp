<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%opalsubmodulemst_tbl}}".
 *
 * @property int $opalsubmodulemst_pk used as primary key
 * @property int $osmm_opalstkholdertypmst_fk Reference to opalstkholdertypmst_pk
 * @property int $osmm_opalmodulemst_fk reference to opalmodulemst_tbl
 * @property string $osmm_name_en name/description of the module
 * @property string $osmm_name_ar
 * @property int $osmm_order
 * @property string $osmm_crudaccess 1 - create,2-view,3- update,4-delete,5-Approval,6-Download
 * @property int $osmm_status if the submodule is active or not.. active  - 1, inactive – 2
 * @property string $osmm_createdon datetime of creation
 * @property int $osmm_createdby reference to opalusemst_tbl
 * @property string $osmm_updatedon datetime of updation
 * @property int $osmm_updatedby reference to opalusermst_tbl
 *
 * @property FilemstTbl[] $filemstTbls
 * @property OpalmodulemstTbl $osmmOpalmodulemstFk
 * @property OpalstkholdertypmstTbl $osmmOpalstkholdertypmstFk
 * @property RoleallocationdtlsTbl[] $roleallocationdtlsTbls
 * @property UseraccessallocationdtlsTbl[] $useraccessallocationdtlsTbls
 * @property UseraccessallocationhstyTbl[] $useraccessallocationhstyTbls
 */
class OpalsubmodulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%opalsubmodulemst_tbl}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['osmm_opalstkholdertypmst_fk', 'osmm_opalmodulemst_fk', 'osmm_name_en', 'osmm_name_ar', 'osmm_order', 'osmm_status', 'osmm_createdby'], 'required'],
            [['osmm_opalstkholdertypmst_fk', 'osmm_opalmodulemst_fk', 'osmm_order', 'osmm_status', 'osmm_createdby', 'osmm_updatedby'], 'integer'],
            [['osmm_createdon', 'osmm_updatedon'], 'safe'],
            [['osmm_name_en'], 'string', 'max' => 500],
            [['osmm_name_ar'], 'string', 'max' => 250],
            [['osmm_crudaccess'], 'string', 'max' => 15],
            [['osmm_opalmodulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmodulemstTbl::className(), 'targetAttribute' => ['osmm_opalmodulemst_fk' => 'opalmodulemst_pk']],
            [['osmm_opalstkholdertypmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstkholdertypmstTbl::className(), 'targetAttribute' => ['osmm_opalstkholdertypmst_fk' => 'opalstkholdertypmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalsubmodulemst_pk' => 'Opalsubmodulemst Pk',
            'osmm_opalstkholdertypmst_fk' => 'Osmm Opalstkholdertypmst Fk',
            'osmm_opalmodulemst_fk' => 'Osmm Opalmodulemst Fk',
            'osmm_name_en' => 'Osmm Name En',
            'osmm_name_ar' => 'Osmm Name Ar',
            'osmm_order' => 'Osmm Order',
            'osmm_crudaccess' => 'Osmm Crudaccess',
            'osmm_status' => 'Osmm Status',
            'osmm_createdon' => 'Osmm Createdon',
            'osmm_createdby' => 'Osmm Createdby',
            'osmm_updatedon' => 'Osmm Updatedon',
            'osmm_updatedby' => 'Osmm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilemstTbls()
    {
        return $this->hasMany(FilemstTbl::className(), ['fm_submodulemst_fk' => 'opalsubmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsmmOpalmodulemstFk()
    {
        return $this->hasOne(OpalmodulemstTbl::className(), ['opalmodulemst_pk' => 'osmm_opalmodulemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOsmmOpalstkholdertypmstFk()
    {
        return $this->hasOne(OpalstkholdertypmstTbl::className(), ['opalstkholdertypmst_pk' => 'osmm_opalstkholdertypmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleallocationdtlsTbls()
    {
        return $this->hasMany(RoleallocationdtlsTbl::className(), ['rad_OpalSubModuleMst_FK' => 'opalsubmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUseraccessallocationdtlsTbls()
    {
        return $this->hasMany(UseraccessallocationdtlsTbl::className(), ['uaad_OpalSubmoduleMst_FK' => 'opalsubmodulemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUseraccessallocationhstyTbls()
    {
        return $this->hasMany(UseraccessallocationhstyTbl::className(), ['uaah_OpalSubModuleMst_FK' => 'opalsubmodulemst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalsubmodulemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalsubmodulemstTblQuery(get_called_class());
    }
    public function getModuleItsSubmodulebyStakholder($stkPk){
        
        if($stkPk == 3)
        {
            $stkPk = 2;
        }
      
        $modules = OpalsubmodulemstTbl::find()
                    ->select([
                        'distinct (opalsubmodulemst_pk )as smPk' , 
                        'm.opalmodulemst_pk as mPk',
                        'm.omm_name_en as mName',
                        'm.omm_crudaccess as mAccess',
                        'osmm_name_en as smName',
                        'm.omm_infocontent_en as minfo',
                        'osmm_crudaccess as smAccess'
                    ])
                    ->leftJoin('opalmodulemst_tbl m','osmm_opalmodulemst_fk = m.opalmodulemst_pk')
                    ->where([
                        'osmm_opalstkholdertypmst_fk' => $stkPk,
                        'm.omm_status'=>1,
                        'osmm_status'=>1
                    ]);
                    $module_info = $modules->orderBy([
                        'm.omm_order'=>SORT_ASC,
                        'osmm_order'=>SORT_ASC,
                    ])
                    ->asArray()->all();
                   
        return $module_info;
    }
}

//=================
// osmm_opalmodulemst_fk==module pk,opalSubModuleMst_tbl;
// opalsubmodulemst_pk =sub module pk,opalSubModuleMst_tbl;

// osmm_crudaccess= sub module access;opalSubModuleMst_tb;


// omm_crudaccess= module access,opalmodulemst_tbl;