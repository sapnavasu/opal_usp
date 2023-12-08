<?php

namespace api\modules\mst\models;


use Yii;

/**
 * This is the model class for table "licauthusers_tbl".
 *
 * @property int $licauthusers_pk Primary key
 * @property int $lau_licensinginfo_fk Reference to licensinginfo_fk
 * @property int $lau_usrmst_fk Reference to usrmst_tbl
 * @property string $lau_createdon Record created on date & time
 * @property int $lau_createdby Record created by user id
 * @property string $lau_createdbyipaddr IP Address of the user
 */
class LicauthusersTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licauthusers_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lau_licensinginfo_fk', 'lau_usrmst_fk', 'lau_createdon', 'lau_createdby'], 'required'],
            [['lau_licensinginfo_fk', 'lau_usrmst_fk', 'lau_createdby'], 'integer'],
            [['lau_createdon'], 'safe'],
            [['lau_createdbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licauthusers_pk' => 'Licauthusers Pk',
            'lau_licensinginfo_fk' => 'Lau Licensinginfo Fk',
            'lau_usrmst_fk' => 'Lau Usrmst Fk',
            'lau_createdon' => 'Lau Createdon',
            'lau_createdby' => 'Lau Createdby',
            'lau_createdbyipaddr' => 'Lau Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicauthusersTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicauthusersTblQuery(get_called_class());
    }
}