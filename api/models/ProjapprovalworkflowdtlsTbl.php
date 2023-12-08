<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projapprovalworkflowdtls_tbl".
 *
 * @property int $projapprovalworkflowdtls_pk primary key
 * @property int $pawfd_projapprovalworkflowhrd_fk Reference to projapprovalworkflowhrd_pk
 * @property int $pawfd_rolemst_fk 1-desktop review,2-Payment Approval, 3-Site Audit,4-Quality Manager Approval, 5-OPAL Authority Approval,6-CEO Approval..  Reference to rolemst_tbl
 * @property int $pawfh_status 1-Active. 2 Inactive, by default 1
 * @property int $pawfh_approvalorder Order of approval
 * @property int $pawfh_Isfinalauthority 1-Yes,2-No
 * @property string $pawfh_createdon
 * @property int $pawfh_createdby
 * @property string $pawfh_updatedon
 * @property int $pawfh_updatedby
 *
 * @property AppapprovalhdrTbl[] $appapprovalhdrTbls
 * @property ProjapprovalworkflowhrdTbl $pawfdProjapprovalworkflowhrdFk
 * @property RolemstTbl $pawfdRolemstFk
 * @property ProjapprovalworkflowuserdtlsTbl[] $projapprovalworkflowuserdtlsTbls
 */
class ProjapprovalworkflowdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projapprovalworkflowdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pawfd_projapprovalworkflowhrd_fk', 'pawfd_rolemst_fk', 'pawfh_approvalorder', 'pawfh_Isfinalauthority', 'pawfh_createdby'], 'required'],
            [['pawfd_projapprovalworkflowhrd_fk', 'pawfd_rolemst_fk', 'pawfh_status', 'pawfh_approvalorder', 'pawfh_Isfinalauthority', 'pawfh_createdby', 'pawfh_updatedby'], 'integer'],
            [['pawfh_createdon', 'pawfh_updatedon'], 'safe'],
            [['pawfd_projapprovalworkflowhrd_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowhrdTbl::className(), 'targetAttribute' => ['pawfd_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']],
            [['pawfd_rolemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RolemstTbl::className(), 'targetAttribute' => ['pawfd_rolemst_fk' => 'rolemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projapprovalworkflowdtls_pk' => 'Projapprovalworkflowdtls Pk',
            'pawfd_projapprovalworkflowhrd_fk' => 'Pawfd Projapprovalworkflowhrd Fk',
            'pawfd_rolemst_fk' => 'Pawfd Rolemst Fk',
            'pawfh_status' => 'Pawfh Status',
            'pawfh_approvalorder' => 'Pawfh Approvalorder',
            'pawfh_Isfinalauthority' => 'Pawfh  Isfinalauthority',
            'pawfh_createdon' => 'Pawfh Createdon',
            'pawfh_createdby' => 'Pawfh Createdby',
            'pawfh_updatedon' => 'Pawfh Updatedon',
            'pawfh_updatedby' => 'Pawfh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppapprovalhdrTbls()
    {
        return $this->hasMany(AppapprovalhdrTbl::className(), ['aah_projapprovalworkflowdtls_fk' => 'projapprovalworkflowdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfdProjapprovalworkflowhrdFk()
    {
        return $this->hasOne(ProjapprovalworkflowhrdTbl::className(), ['projapprovalworkflowhrd_pk' => 'pawfd_projapprovalworkflowhrd_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfdRolemstFk()
    {
        return $this->hasOne(RolemstTbl::className(), ['rolemst_pk' => 'pawfd_rolemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjapprovalworkflowuserdtlsTbls()
    {
        return $this->hasMany(ProjapprovalworkflowuserdtlsTbl::className(), ['pawfud_projapprovalworkflowdtls_fk' => 'projapprovalworkflowdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjapprovalworkflowdtlsTblQuery(get_called_class());
    }
}
