<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "invintent_tbl".
 *
 * @property int $invintent_pk Primary Key
 * @property string $invi_type Stakeholder's Registration Intent in English
 * @property int $invi_stkholdtype 1 - Investor Community,2 - Project Owner
 * @property int $invi_status 0 - InActive, 1 - Active
 * @property string $invi_createdon
 * @property int $invi_createdby
 * @property string $invi_createdbyipaddr IP Address of the user
 * @property string $invi_updatedon
 * @property int $invi_updatedby
 * @property string $invi_updatedbyipaddr IP Address of the user
 */
class InvintentTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invintent_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invi_type', 'invi_stkholdtype', 'invi_createdby'], 'required'],
            [['invi_stkholdtype', 'invi_status', 'invi_createdby', 'invi_updatedby'], 'integer'],
            [['invi_createdon', 'invi_updatedon'], 'safe'],
            [['invi_type'], 'string', 'max' => 100],
            [['invi_createdbyipaddr', 'invi_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invintent_pk' => 'Invintent Pk',
            'invi_type' => 'Invi Type',
            'invi_stkholdtype' => 'Invi Stkholdtype',
            'invi_status' => 'Invi Status',
            'invi_createdon' => 'Invi Createdon',
            'invi_createdby' => 'Invi Createdby',
            'invi_createdbyipaddr' => 'Invi Createdbyipaddr',
            'invi_updatedon' => 'Invi Updatedon',
            'invi_updatedby' => 'Invi Updatedby',
            'invi_updatedbyipaddr' => 'Invi Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvintentTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvintentTblQuery(get_called_class());
    }
}
