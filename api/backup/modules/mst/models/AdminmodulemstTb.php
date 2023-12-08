<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "adminmodulemst_tb".
 *
 * @property int $AdminModuleMst_Pk
 * @property int $AMM_UserRoleMst_Fk
 * @property string $AMM_ModName
 * @property string $AMM_Status
 * @property string $AMM_CreatedOn
 * @property int $AMM_CreatedBy
 * @property string $AMM_UpdatedOn
 * @property int $AMM_UpdatedBy
 */
class AdminmodulemstTb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adminmodulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AMM_UserRoleMst_Fk', 'AMM_CreatedBy', 'AMM_UpdatedBy'], 'integer'],
            [['AMM_Status'], 'string'],
            [['AMM_CreatedOn', 'AMM_UpdatedOn'], 'safe'],
            [['AMM_ModName'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AdminModuleMst_Pk' => 'Admin Module Mst  Pk',
            'AMM_UserRoleMst_Fk' => 'Amm  User Role Mst  Fk',
            'AMM_ModName' => 'Amm  Mod Name',
            'AMM_Status' => 'Amm  Status',
            'AMM_CreatedOn' => 'Amm  Created On',
            'AMM_CreatedBy' => 'Amm  Created By',
            'AMM_UpdatedOn' => 'Amm  Updated On',
            'AMM_UpdatedBy' => 'Amm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdminmodulemstTbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdminmodulemstTbQuery(get_called_class());
    }
}
