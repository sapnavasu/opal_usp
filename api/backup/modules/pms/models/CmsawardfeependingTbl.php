<?php

namespace api\modules\pms\models;

use common\models\UsermstTbl;
use api\modules\mst\models\MemberregistrationmstTbl;
use Yii;

/**
 * This is the model class for table "cmsawardfeepending_tbl".
 *
 * @property int $cmsawardfeepending_pk Primary Key
 * @property int $cafp_cmsrequisitionformdtls_fk Reference used on tender creation: Reference to cmsrequisitionformdtls_tbl 
 * @property int $cafp_awarder_memregmst_fk Reference to memberregistrationmst_tbl
 * @property int $cafp_awardee_memregmst_fk Reference to memberregistrationmst_tbl [tried to award but supplier has pending sucess fee]
 * @property int $cafp_createdby Reference to usermst_tbl [User who tried to give award]
 * @property string $cafp_createdon Date of Creation
 * @property int $cafp_isfeepaidmailsent Is Fee Paid Mail Sent (Default:0) : 0 - Yet to send, 1 - Sent
 * @property string $cafp_feepaidmailsenton Fee Paid Mail Sent on
 *
 * @property MemberregistrationmstTbl $cafpAwardeeMemregmstFk
 * @property MemberregistrationmstTbl $cafpAwarderMemregmstFk
 * @property CmsrequisitionformdtlsTbl $cafpCmsrequisitionformdtlsFk
 * @property UsermstTbl $cafpCreatedby
 */
class CmsawardfeependingTbl extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'cmsawardfeepending_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['cafp_cmsrequisitionformdtls_fk', 'cafp_awarder_memregmst_fk', 'cafp_awardee_memregmst_fk', 'cafp_createdby', 'cafp_createdon'], 'required'],
            [['cafp_cmsrequisitionformdtls_fk', 'cafp_awarder_memregmst_fk', 'cafp_awardee_memregmst_fk', 'cafp_createdby', 'cafp_isfeepaidmailsent'], 'integer'],
            [['cafp_createdon', 'cafp_feepaidmailsenton'], 'safe'],
            [['cafp_awardee_memregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['cafp_awardee_memregmst_fk' => 'MemberRegMst_Pk']],
            [['cafp_awarder_memregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['cafp_awarder_memregmst_fk' => 'MemberRegMst_Pk']],
            [['cafp_cmsrequisitionformdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmsrequisitionformdtlsTbl::className(), 'targetAttribute' => ['cafp_cmsrequisitionformdtls_fk' => 'cmsrequisitionformdtls_pk']],
            [['cafp_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cafp_createdby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'cmsawardfeepending_pk' => 'Cmsawardfeepending Pk',
            'cafp_cmsrequisitionformdtls_fk' => 'Cafp Cmsrequisitionformdtls Fk',
            'cafp_awarder_memregmst_fk' => 'Cafp Awarder Memregmst Fk',
            'cafp_awardee_memregmst_fk' => 'Cafp Awardee Memregmst Fk',
            'cafp_createdby' => 'Cafp Createdby',
            'cafp_createdon' => 'Cafp Createdon',
            'cafp_isfeepaidmailsent' => 'Cafp Isfeepaidmailsent',
            'cafp_feepaidmailsenton' => 'Cafp Feepaidmailsenton',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCafpAwardeeMemregmstFk() {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'cafp_awardee_memregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCafpAwarderMemregmstFk() {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'cafp_awarder_memregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCafpCmsrequisitionformdtlsFk() {
        return $this->hasOne(CmsrequisitionformdtlsTbl::className(), ['cmsrequisitionformdtls_pk' => 'cafp_cmsrequisitionformdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCafpCreatedby() {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cafp_createdby']);
    }

    /**
     * {@inheritdoc}
     * @return CmsawardfeependingTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new CmsawardfeependingTblQuery(get_called_class());
    }

}
