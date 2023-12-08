<?php

namespace api\modules\mst\models;


/**
 * This is the model class for table "approvalworkflowconfigdtls_tbl".
 *
 * @property int $approvalworkflowconfigdtls_pk Primary key
 * @property int $awfcd_formmst_fk Reference to formmst_tbl
 * @property string $awfcd_workfowtitle Workflow title
 * @property int $awfcd_status 1 - Active, 2 - Inactive
 * @property string $awfcd_createdon Datetime of creation
 * @property int $awfcd_createdby Reference to usermst_tbl
 * @property string $awfcd_updatedon Datetime of updation
 * @property int $awfcd_updatedby Reference to usermst_tbl
 *
 * @property FormmstTbl $formmstTbl
 * @property UsermstTbl $awfcdCreatedby
 * @property UsermstTbl $awfcdUpdatedby
 */
class ApprovalworkflowconfigdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approvalworkflowconfig_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awfcd_formmst_fk', 'awfcd_status', 'awfcd_createdby', 'awfcd_updatedby'], 'integer'],
            [['awfcd_formmst_fk', 'awfcd_workfowtitle', 'awfcd_status', 'awfcd_createdby'], 'required'],
            [['awfcd_workfowtitle'], 'string'],
            [['awfcd_createdon', 'awfcd_updatedon'], 'safe'],
            [['awfcd_formmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FormmstTbl::className(), 'targetAttribute' => ['awfcd_formmst_fk' => 'formmst_pk']],
            [['awfcd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfcd_createdby' => 'UserMst_Pk']],
            [['awfcd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfcd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'approvalworkflowconfigdtls_pk' => 'Approvalworkflowconfigdtls Pk',
            'awfcd_formmst_fk' => 'Awfcd Formmst Fk',
            'awfcd_workfowtitle' => 'Awfcd Workflow Title',
            'awfcd_status' => 'Awfcd Status',
            'awfcd_createdon' => 'Awfcd Createdon',
            'awfcd_createdby' => 'Awfcd Createdby',
            'awfcd_updatedon' => 'Awfcd Updatedon',
            'awfcd_updatedby' => 'Awfcd Updatedby',
        ];
    }
}
