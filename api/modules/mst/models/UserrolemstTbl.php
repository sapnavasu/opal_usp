<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "userrolemst_tbl".
 *
 * @property int $UserRoleMst_Pk
 * @property string $URM_Role
 * @property string $URM_Status
 * @property string $URM_CreatedOn
 * @property int $URM_CreatedBy
 * @property string $URM_UpdatedOn
 * @property int $URM_UpdatedBy
 */
class UserrolemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'userrolemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['URM_Role', 'URM_Status', 'URM_CreatedOn', 'URM_CreatedBy'], 'required'],
            [['URM_Status'], 'string'],
            [['URM_CreatedOn', 'URM_UpdatedOn'], 'safe'],
            [['URM_CreatedBy', 'URM_UpdatedBy'], 'integer'],
            [['URM_Role'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserRoleMst_Pk' => 'User Role Mst  Pk',
            'URM_Role' => 'Urm  Role',
            'URM_Status' => 'Urm  Status',
            'URM_CreatedOn' => 'Urm  Created On',
            'URM_CreatedBy' => 'Urm  Created By',
            'URM_UpdatedOn' => 'Urm  Updated On',
            'URM_UpdatedBy' => 'Urm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserrolemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserrolemstTblQuery(get_called_class());
    }
}
