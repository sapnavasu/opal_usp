<?php

namespace api\modules\mst\models;

use common\models\MemcompsectordtlsTbl;


/**
 * This is the model class for table "approvalworkflowuserconfig_tbl".
 *
 * @property int $approvalworkflowuserconfig_pk Primary key
 * @property int $awfuc_approvalworkflowconfigtrns_fk Reference to approvalworkflowconfigtrns_tbl
 * @property int $awfuc_memcompsecdtls_fk Reference to memcompsectordtls_tbl
 * @property int $awfuc_departmentmst_fk Reference to departmentmst_tbl
 * @property int $awfuc_usermst_fk Reference to usermst_tbl
 * @property int $awfuc_orderofapp Order of Approval
 * @property int $awfuc_isfinalapprauthority 1 - Yes, 2 - No
 * @property int $awfuc_approvallevel 1 - All Cat/Subcat/Parameter, 2 - Specific Cat/Subcat/Parameter
 * @property string $awfuc_createdon Datetime of creation
 * @property int $awfuc_createdby Reference to usermst_tbl
 * @property string $awfuc_updatedon Datetime of updation
 * @property int $awfuc_updatedby Reference to usermst_tbl
 *
 * @property ApprovalworkflowconfigtrnsTbl $approvalworkflowconfigtrnsTbl
 * @property MemcompsectordtlsTbl $memcompsectordtlsTbl
 * @property DepartmentmstTbl $departmentmstTbl
 * @property UsermstTbl $awfucUsermstFk
 * @property UsermstTbl $awfucCreatedby
 * @property UsermstTbl $awfucUpdatedby
 */
class ApprovalworkflowuserconfigTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approvalworkflowuserconfig_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awfuc_approvalworkflowconfigtrns_fk', 'awfuc_memcompsecdtls_fk', 'awfuc_departmentmst_fk', 'awfuc_usermst_fk', 'awfuc_orderofapp', 'awfuc_isfinalapprauthority', 'awfuc_approvallevel', 'awfuc_createdby', 'awfuc_updatedby'], 'integer'],
            [['awfuc_approvalworkflowconfigtrns_fk', 'awfuc_orderofapp', 'awfuc_isfinalapprauthority', 'awfuc_approvallevel', 'awfuc_createdby'], 'required'],
            [['awfuc_createdon', 'awfuc_updatedon'], 'safe'],
            [['awfuc_approvalworkflowconfigtrns_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprovalworkflowconfigtrnsTbl::className(), 'targetAttribute' => ['awfuc_approvalworkflowconfigtrns_fk' => 'approvalworkflowuserconfigtrns_pk']],
            [['awfuc_memcompsecdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompsectordtlsTbl::className(), 'targetAttribute' => ['awfuc_memcompsecdtls_fk' => 'MemCompSecDtls_Pk']],
            [['awfuc_departmentmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentmstTbl::className(), 'targetAttribute' => ['awfuc_departmentmst_fk' => 'DepartmentMst_Pk']],
            [['awfuc_usermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfuc_usermst_fk' => 'UserMst_Pk']],
            [['awfuc_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfuc_createdby' => 'UserMst_Pk']],
            [['awfuc_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfuc_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'approvalworkflowuserconfig_pk' => 'Approvalworkflowuserconfig Pk',
            'awfuc_approvalworkflowconfigtrns_fk' => 'Awfuc Approvalworkflowconfig Fk',
            'awfuc_memcompsecdtls_fk' => 'Awfuc Memcompsecdtls Fk',
            'awfuc_departmentmst_fk' => 'Awfuc Departmentmst Fk',
            'awfuc_usermst_fk' => 'Awfuc Usermst Fk',
            'awfuc_orderofapp' => 'Awfuc Order of Approval',
            'awfuc_isfinalapprauthority' => 'Awfuc Is Final Approval Authority',
            'awfuc_approvallevel' => 'Awfuc Approval Level',
            'awfuc_createdon' => 'Awfuc Createdon',
            'awfuc_createdby' => 'Awfuc Createdby',
            'awfuc_updatedon' => 'Awfuc Updatedon',
            'awfuc_updatedby' => 'Awfuc Updatedby',
        ];
    }
}
