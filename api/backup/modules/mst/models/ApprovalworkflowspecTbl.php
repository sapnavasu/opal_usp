<?php

namespace api\modules\mst\models;

use common\models\BgivaldocformdescmstTbl;


/**
 * This is the model class for table "approvalworkflowspec_tbl".
 *
 * @property int $approvalworkflowspec_pk Primary key
 * @property int $awfs_approvalworkflowuserconfig_fk Reference to approvalworkflowuserconfig_tbl
 * @property int $awfs_bgivaldocformdescmst_fk Reference to bgivaldocformdescmst_tbl
 * @property string $awfs_createdon Datetime of creation
 * @property int $awfs_createdby Reference to usermst_tbl
 * @property string $awfs_updatedon Datetime of updation
 * @property int $awfs_updatedby Reference to usermst_tbl
 *
 * @property ApprovalworkflowuserconfigTbl $approvalworkflowuserconfigTbl
 * @property BgivaldocformdescmstTbl $bgivaldocformdescmstTbl
 * @property UsermstTbl $awfsCreatedby
 * @property UsermstTbl $awfsUpdatedby
 */
class ApprovalworkflowspecTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'approvalworkflowspec_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['awfs_approvalworkflowuserconfig_fk', 'awfs_bgivaldocformdescmst_fk', 'awfs_createdby', 'awfs_updatedby'], 'integer'],
            [['awfs_approvalworkflowuserconfig_fk', 'awfs_bgivaldocformdescmst_fk', 'awfs_createdby'], 'required'],
            [['awfs_createdon', 'awfs_updatedon'], 'safe'],
            [['awfs_approvalworkflowuserconfig_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprovalworkflowuserconfigTbl::className(), 'targetAttribute' => ['awfs_approvalworkflowuserconfig_fk' => 'approvalworkflowuserconfig_pk']],
            [['awfs_bgivaldocformdescmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BgivaldocformdescmstTbl::className(), 'targetAttribute' => ['awfs_bgivaldocformdescmst_fk' => 'formmst_pk']],
            [['awfs_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfs_createdby' => 'UserMst_Pk']],
            [['awfs_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['awfs_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'approvalworkflowspec_pk' => 'Approvalworkflowspec Pk',
            'awfs_approvalworkflowuserconfig_fk' => 'Awfs Aapprovalworkflowuserconfig Fk',
            'awfs_bgivaldocformdescmst_fk' => 'Awfs Bgivaldocformdescmst Fk',
            'awfs_createdon' => 'Awfs Createdon',
            'awfs_createdby' => 'Awfs Createdby',
            'awfs_updatedon' => 'Awfs Updatedon',
            'awfs_updatedby' => 'Awfs Updatedby',
        ];
    }
}
