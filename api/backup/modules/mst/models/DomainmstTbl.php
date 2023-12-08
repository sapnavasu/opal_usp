<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "domainmst_tbl".
 *
 * @property string $DomainMst_Pk
 * @property string $DoM_DomainName
 * @property string $DoM_Status
 * @property string $DoM_CreatedOn
 * @property int $DoM_CreatedBy
 * @property string $DoM_UpdatedOn
 * @property int $DoM_UpdatedBy
 */
class DomainmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'domainmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DoM_Status'], 'string'],
            [['DoM_CreatedOn', 'DoM_UpdatedOn'], 'safe'],
            [['DoM_CreatedBy', 'DoM_UpdatedBy'], 'integer'],
            [['DoM_DomainName'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DomainMst_Pk' => 'Domain Mst  Pk',
            'DoM_DomainName' => 'Do M  Domain Name',
            'DoM_Status' => 'Do M  Status',
            'DoM_CreatedOn' => 'Do M  Created On',
            'DoM_CreatedBy' => 'Do M  Created By',
            'DoM_UpdatedOn' => 'Do M  Updated On',
            'DoM_UpdatedBy' => 'Do M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DomainmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DomainmstTblQuery(get_called_class());
    }
}
