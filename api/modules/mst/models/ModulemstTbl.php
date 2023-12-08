<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "modulemst_tbl".
 *
 * @property int $ModuleMst_Pk Used as Primary Key
 * @property string $MM_Name Name/Description of the Module
 * @property string $MM_ModuleBase If the module belongs to divisions like SectorPartner, NGP, Gateways Framework, etc or normal National Business Framework...NBF – N, SectorPartner – S
 * @property string $mm_crudaccess 1 - Create  2 - Read  3 - Update  4 - Delete
 * @property int $MM_Status If the Module is active or not...Active  - 1, Inactive – 0
 * @property string $MM_CreatedOn The date and time when the record is created
 * @property int $MM_CreatedBy The ID of the login session ID when the record is created
 * @property string $MM_UpdatedOn The date and time when the record is last updated
 * @property int $MM_UpdatedBy The ID of the last login session ID when the record is updated
 *
 * @property UsermstTbl $mMCreatedBy
 * @property UsermstTbl $mMUpdatedBy
 */
class ModulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MM_Name', 'MM_ModuleBase', 'MM_Status', 'MM_CreatedBy'], 'required'],
            [['MM_Status', 'MM_CreatedBy', 'MM_UpdatedBy'], 'integer'],
            [['MM_CreatedOn', 'MM_UpdatedOn'], 'safe'],
            [['MM_Name'], 'string', 'max' => 250],
            [['MM_ModuleBase'], 'string', 'max' => 5],
            [['mm_crudaccess'], 'string', 'max' => 15],
            [['MM_CreatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['MM_CreatedBy' => 'UserMst_Pk']],
            [['MM_UpdatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['MM_UpdatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ModuleMst_Pk' => 'Module Mst  Pk',
            'MM_Name' => 'Mm  Name',
            'MM_ModuleBase' => 'Mm  Module Base',
            'mm_crudaccess' => 'Mm Crudaccess',
            'MM_Status' => 'Mm  Status',
            'MM_CreatedOn' => 'Mm  Created On',
            'MM_CreatedBy' => 'Mm  Created By',
            'MM_UpdatedOn' => 'Mm  Updated On',
            'MM_UpdatedBy' => 'Mm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMMCreatedBy()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'MM_CreatedBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMMUpdatedBy()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'MM_UpdatedBy']);
    }

    /**
     * {@inheritdoc}
     * @return ModulemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModulemstTblQuery(get_called_class());
    }
}