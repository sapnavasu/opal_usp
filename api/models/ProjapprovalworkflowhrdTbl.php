<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projapprovalworkflowhrd_tbl".
 *
 * @property int $projapprovalworkflowhrd_pk primary key
 * @property int $pawfh_projectmst_fk Referenece to projectmst_pk
 * @property string $pawfh_workflowtitle
 * @property int $pawfh_formstatus 1-Initial, 2-update(No new staff added OR New staff role/language/sub-categories added),3-Update(added new staff OR added new staff role/language/sub-categories),4-Renewal
 * @property int $pawfh_status 1-Active. 2 Inactive, by default 1
 * @property string $pawfh_createdon
 * @property int $pawfh_createdby
 * @property string $pawfh_updatedon
 * @property int $pawfh_updatedby
 *
 * @property AppapprovalhdrTbl[] $appapprovalhdrTbls
 * @property ProjapprovalworkflowdtlsTbl[] $projapprovalworkflowdtlsTbls
 * @property ProjectmstTbl $pawfhProjectmstFk
 * @property ProjapprovalworkflowuserdtlsTbl[] $projapprovalworkflowuserdtlsTbls
 */
class ProjapprovalworkflowhrdTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projapprovalworkflowhrd_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pawfh_projectmst_fk', 'pawfh_formstatus', 'pawfh_createdby'], 'required'],
            [['pawfh_projectmst_fk', 'pawfh_formstatus', 'pawfh_status', 'pawfh_createdby', 'pawfh_updatedby'], 'integer'],
            [['pawfh_workflowtitle'], 'string'],
            [['pawfh_createdon', 'pawfh_updatedon'], 'safe'],
            [['pawfh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['pawfh_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projapprovalworkflowhrd_pk' => 'Projapprovalworkflowhrd Pk',
            'pawfh_projectmst_fk' => 'Pawfh Projectmst Fk',
            'pawfh_workflowtitle' => 'Pawfh Workflowtitle',
            'pawfh_formstatus' => 'Pawfh Formstatus',
            'pawfh_status' => 'Pawfh Status',
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
        return $this->hasMany(AppapprovalhdrTbl::className(), ['aah_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjapprovalworkflowdtlsTbls()
    {
        return $this->hasMany(ProjapprovalworkflowdtlsTbl::className(), ['pawfd_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'pawfh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjapprovalworkflowuserdtlsTbls()
    {
        return $this->hasMany(ProjapprovalworkflowuserdtlsTbl::className(), ['pawfud_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowhrdTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjapprovalworkflowhrdTblQuery(get_called_class());
    }
}
