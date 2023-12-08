<?php

namespace api\modules\mst\models;


/**
 * This is the model class for table "approvalworkflowconfigtrns_tbl".
 *
 * @property int $approvalworkflowuserconfigtrns_pk Primary key
 * @property int $awfctt_approvalworkflowconfigdtls_fk Reference to formmst_tbl
 * @property string $awfct_minactionreq Minimum Approval/Decline required
 * @property string $awfct_level Level of approval
 * @property string $awfct_createdon Datetime of creation
 * @property int $awfct_createdby Reference to usermst_tbl
 * @property string $awfct_updatedon Datetime of updation
 * @property int $awfct_updatedby Reference to usermst_tbl
 *
 * @property ApprovalworkflowconfigdtlsTbl $approvalworkflowconfigdtlsTbl
 * @property UsermstTbl $awfctCreatedby
 * @property UsermstTbl $awfctUpdatedby
 */
class ApprovalworkflowconfigtrnsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approvalworkflowconfigtrns_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awfctt_approvalworkflowconfigdtls_fk', 'awfct_minactionreq', 'awfct_level', 'awfct_createdby', 'awfct_updatedby'], 'integer'],
            [['awfctt_approvalworkflowconfigdtls_fk', 'awfct_minactionreq', 'awfct_level', 'awfct_createdby'], 'required'],
            [['awfct_createdon', 'awfct_updatedon'], 'safe'],
            [['awfctt_approvalworkflowconfigdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprovalworkflowconfigdtlsTbl::className(), 'targetAttribute' => ['awfctt_approvalworkflowconfigdtls_fk' => 'approvalworkflowconfigdtls_pk']],
            [['awfct_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfct_createdby' => 'UserMst_Pk']],
            [['awfct_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfct_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'approvalworkflowuserconfigtrns_pk' => 'Approvalworkflowconfigtrns Pk',
            'awfctt_approvalworkflowconfigdtls_fk' => 'Awfct Formmst Fk',
            'awfct_minactionreq' => 'Awfct Minactionreq',
            'awfct_level' => 'Awfct Level',
            'awfct_createdon' => 'Awfct Createdon',
            'awfct_createdby' => 'Awfct Createdby',
            'awfct_updatedon' => 'Awfct Updatedon',
            'awfct_updatedby' => 'Awfct Updatedby',
        ];
    }
}
