<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auditchklstmst_tbl".
 *
 * @property int $auditchklstmst_pk
 * @property int $aclm_projectmst_fk Reference to projectmst_pk
 * @property string $aclm_categorytitle_en
 * @property string $aclm_categorytitle_ar
 * @property int $aclm_order Order of title to be displayed
 * @property int $aclm_status 1-Active, 2-Inactive, by default 1
 * @property string $aclm_version
 * @property string $aclm_createdon
 * @property int $aclm_createdby
 * @property string $aclm_updatedon
 * @property int $aclm_updatedby
 *
 * @property ProjectmstTbl $aclmProjectmstFk
 * @property AuditquestionmstTbl[] $auditquestionmstTbls
 */
class AuditchklstmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auditchklstmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aclm_projectmst_fk', 'aclm_categorytitle_en', 'aclm_categorytitle_ar', 'aclm_order', 'aclm_version', 'aclm_createdby'], 'required'],
            [['aclm_projectmst_fk', 'aclm_order', 'aclm_status', 'aclm_createdby', 'aclm_updatedby'], 'integer'],
            [['aclm_categorytitle_en', 'aclm_categorytitle_ar'], 'string'],
            [['aclm_version'], 'number'],
            [['aclm_createdon', 'aclm_updatedon'], 'safe'],
            [['aclm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['aclm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'auditchklstmst_pk' => 'Auditchklstmst Pk',
            'aclm_projectmst_fk' => 'Reference to projectmst_pk',
            'aclm_categorytitle_en' => 'Aclm Categorytitle En',
            'aclm_categorytitle_ar' => 'Aclm Categorytitle Ar',
            'aclm_order' => 'Order of title to be displayed',
            'aclm_status' => '1-Active, 2-Inactive, by default 1',
            'aclm_version' => 'Aclm Version',
            'aclm_createdon' => 'Aclm Createdon',
            'aclm_createdby' => 'Aclm Createdby',
            'aclm_updatedon' => 'Aclm Updatedon',
            'aclm_updatedby' => 'Aclm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAclmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'aclm_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuditquestionmstTbls()
    {
        return $this->hasMany(AuditquestionmstTbl::className(), ['aqm_auditchklstmst_fk' => 'auditchklstmst_pk']);
    }
}
