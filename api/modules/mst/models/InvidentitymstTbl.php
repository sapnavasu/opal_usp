<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "invidentitymst_tbl".
 *
 * @property int $invidentitymst_pk Primary key
 * @property string $iim_invidentity Stakeholder Identity  in English
 * @property string $iim_stkholdtype 1 - Investor Community,2 - Project Owner,3 - Service Community
 * @property int $iim_status Status of the Investor Identity. 0 - Inactive, 1 - Active
 * @property string $iim_createdon Record created on date & time
 * @property int $iim_createdby Record created by user id
 * @property string $iim_createdbyipaddr IP Address of the user
 * @property string $iim_updatedon Record updated on date & time
 * @property int $iim_updatedby Record updated by user id
 * @property string $iim_updatedbyipaddr IP Address of the user
 */
class InvidentitymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invidentitymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iim_invidentity', 'iim_stkholdtype', 'iim_status', 'iim_createdby'], 'required'],
            [['iim_status', 'iim_createdby', 'iim_updatedby'], 'integer'],
            [['iim_createdon', 'iim_updatedon'], 'safe'],
            [['iim_invidentity', 'iim_createdbyipaddr', 'iim_updatedbyipaddr'], 'string', 'max' => 50],
            [['iim_stkholdtype'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'invidentitymst_pk' => 'Invidentitymst Pk',
            'iim_invidentity' => 'Iim Invidentity',
            'iim_stkholdtype' => 'Iim Stkholdtype',
            'iim_status' => 'Iim Status',
            'iim_createdon' => 'Iim Createdon',
            'iim_createdby' => 'Iim Createdby',
            'iim_createdbyipaddr' => 'Iim Createdbyipaddr',
            'iim_updatedon' => 'Iim Updatedon',
            'iim_updatedby' => 'Iim Updatedby',
            'iim_updatedbyipaddr' => 'Iim Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return InvidentitymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InvidentitymstTblQuery(get_called_class());
    }
}
