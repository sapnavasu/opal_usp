<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "adminsubmodulemst_tbl".
 *
 * @property int $AdminSubModuleMst_Pk
 * @property int $ASMM_ModuleMst_Fk
 * @property string $ASMM_SubModName
 * @property string $ASMM_Status
 * @property string $ASMM_CreatedOn
 * @property int $ASMM_CreatedBy
 * @property string $ASMM_UpdatedOn
 * @property int $ASMM_UpdatedBy
 */
class AdminsubmodulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adminsubmodulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ASMM_ModuleMst_Fk', 'ASMM_CreatedBy', 'ASMM_UpdatedBy'], 'integer'],
            [['ASMM_Status'], 'string'],
            [['ASMM_CreatedOn', 'ASMM_UpdatedOn'], 'safe'],
            [['ASMM_SubModName'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AdminSubModuleMst_Pk' => 'Admin Sub Module Mst  Pk',
            'ASMM_ModuleMst_Fk' => 'Asmm  Module Mst  Fk',
            'ASMM_SubModName' => 'Asmm  Sub Mod Name',
            'ASMM_Status' => 'Asmm  Status',
            'ASMM_CreatedOn' => 'Asmm  Created On',
            'ASMM_CreatedBy' => 'Asmm  Created By',
            'ASMM_UpdatedOn' => 'Asmm  Updated On',
            'ASMM_UpdatedBy' => 'Asmm  Updated By',
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
