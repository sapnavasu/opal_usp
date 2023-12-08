<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roleallocationdtls_tbl".
 *
 * @property int $RoleAllocationDtls_pk
 * @property int $rad_RoleMst_FK Reference to rolemst_tbl.rolemst_pk
 * @property int $rad_OpalModuleMst_FK Reference to opalmodulemst_pk
 * @property int $rad_OpalSubModuleMst_FK Reference to opalsubmodulemst_pk
 * @property array $rad_Access {1:0, 2:0, 3:0, 4:0, 5:0, 6:0}, here index 1 - Create  2 - Read  3 - Update  4 - Delete, 5-Approve, 6-Download, Value 1-Hading access, 0-No access
 * @property string $rad_CreatedOn
 * @property int $rad_CreatedBy
 * @property string $rad_UpdatedOn
 * @property int $rad_UpdatedBy
 *
 * @property OpalmodulemstTbl $radOpalModuleMstFK
 * @property OpalsubmodulemstTbl $radOpalSubModuleMstFK
 * @property RolemstTbl $radRoleMstFK
 */
class RoleallocationdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roleallocationdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rad_RoleMst_FK', 'rad_OpalModuleMst_FK', 'rad_Access', 'rad_CreatedOn', 'rad_CreatedBy'], 'required'],
            [['rad_RoleMst_FK', 'rad_OpalModuleMst_FK', 'rad_OpalSubModuleMst_FK', 'rad_CreatedBy', 'rad_UpdatedBy'], 'integer'],
            [['rad_Access', 'rad_CreatedOn', 'rad_UpdatedOn'], 'safe'],
            [['rad_OpalModuleMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmodulemstTbl::className(), 'targetAttribute' => ['rad_OpalModuleMst_FK' => 'opalmodulemst_pk']],
            [['rad_OpalSubModuleMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalsubmodulemstTbl::className(), 'targetAttribute' => ['rad_OpalSubModuleMst_FK' => 'opalsubmodulemst_pk']],
            [['rad_RoleMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => RolemstTbl::className(), 'targetAttribute' => ['rad_RoleMst_FK' => 'rolemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'RoleAllocationDtls_pk' => 'Role Allocation Dtls Pk',
            'rad_RoleMst_FK' => 'Reference to rolemst_tbl.rolemst_pk',
            'rad_OpalModuleMst_FK' => 'Reference to opalmodulemst_pk',
            'rad_OpalSubModuleMst_FK' => 'Reference to opalsubmodulemst_pk',
            'rad_Access' => '{1:0, 2:0, 3:0, 4:0, 5:0, 6:0}, here index 1 - Create  2 - Read  3 - Update  4 - Delete, 5-Approve, 6-Download, Value 1-Hading access, 0-No access',
            'rad_CreatedOn' => 'Rad  Created On',
            'rad_CreatedBy' => 'Rad  Created By',
            'rad_UpdatedOn' => 'Rad  Updated On',
            'rad_UpdatedBy' => 'Rad  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadHigherRole()
    {
        return $this->hasOne(RoleallocationdtlsTbl::className(), ['RoleAllocationDtls_pk' => 'rad_HigherRole']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleallocationdtlsTbls()
    {
        return $this->hasMany(RoleallocationdtlsTbl::className(), ['rad_HigherRole' => 'RoleAllocationDtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadOpalModuleMstFK()
    {
        return $this->hasOne(OpalmodulemstTbl::className(), ['opalmodulemst_pk' => 'rad_OpalModuleMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadOpalSubModuleMstFK()
    {
        return $this->hasOne(OpalsubmodulemstTbl::className(), ['opalsubmodulemst_pk' => 'rad_OpalSubModuleMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadRoleMstFK()
    {
        return $this->hasOne(RolemstTbl::className(), ['rolemst_pk' => 'rad_RoleMst_FK']);
    }
public function getModuleItsSubmodulebyStakholder($rolepk,$type=''){
if($type==1){
    $modules = RoleallocationdtlsTbl::find()
        ->select([
            'RoleAllocationDtls_pk',
            'omm_name_en as mName',
            'osmm_name_en as osname',
            'omm_crudaccess as mAccess',
            'osmm_crudaccess as smAccess',
            'rad_Access',
            'opalmodulemst_pk',
            'opalsubmodulemst_pk',
        ])
        ->leftJoin('opalmodulemst_tbl','rad_OpalModuleMst_FK = opalmodulemst_pk')
        ->leftJoin('opalsubmodulemst_tbl','rad_OpalModuleMst_FK = opalsubmodulemst_pk')
        ->where([
            'omm_status'=>1,
            'osmm_status'=>1,
        ])
    ->where(['rad_RoleMst_FK'=>$rolepk])

        ->groupBy('rad_OpalModuleMst_FK')
        ->asArray()->all();


    }else{
        $modules = RoleallocationdtlsTbl::find()
        ->select([
            'RoleAllocationDtls_pk',
            'omm_name_en as mName',
            'osmm_name_en as osname',
            'omm_crudaccess as mAccess',
            'osmm_crudaccess as smAccess',
            'rad_Access',
            'opalmodulemst_pk',
            'opalsubmodulemst_pk',
        ])
        ->leftJoin('opalmodulemst_tbl','rad_OpalModuleMst_FK = opalmodulemst_pk')
        ->leftJoin('opalsubmodulemst_tbl','rad_OpalModuleMst_FK = opalsubmodulemst_pk')
        // ->where([
        //     'omm_status'=>1,
        //     'osmm_status'=>1,
        // ])
        ->where(['rad_RoleMst_FK'=>$rolepk])

        ->asArray()->all();
    }
     //echo'<pre>';print_r($modules->createCommand()->getRawSql());exit;
     return $modules;
 }
 public function getUserPermission($rolepk){
  
        $permissionAccess = RoleallocationdtlsTbl::find()
                            ->select('Roleallocationdtls_tbl.*, osmm_opalmodulemst_fk')
                            ->leftJoin('opalSubModuleMst_tbl','opalsubmodulemst_pk = rad_OpalSubModuleMst_FK')
                            ->where("rad_RoleMst_FK in ($rolepk)")
                            ->asArray()->all();
//        ['rad_RoleMst_FK'=>$rolepk]
                            // echo'<pre>';print_r($permissionAccess);exit;
    return $permissionAccess;
}
}
