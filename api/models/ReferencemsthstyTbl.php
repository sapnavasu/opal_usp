<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referencemsthsty_tbl".
 *
 * @property int $referencemsthsty_pk
 * @property int $rmh_referencemst_fk Reference to referencemst_pk
 * @property int $rmh_mastertype 1-Contract Type master, 2-Operator master, 3-Course Level master, 7-Staff Contract Type, 8-Course Tested, 9-Batch Type, 10-Training/Assessment Language, 11-Day Schedule, 12-Education Level, 13-Request For, 14-Assessment In, 15-Assessment Status,16-Road Type
 * @property string $rmh_name_en
 * @property string $rmh_name_ar
 * @property int $rmh_status 1-Active, 2-Inactive
 * @property string $rmh_createdon
 * @property int $rmh_createdby
 * @property string $rmh_updatedon
 * @property int $rmh_updatedby
 *
 * @property ReferencemstTbl $rmhReferencemstFk
 */
class ReferencemsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referencemsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rmh_referencemst_fk', 'rmh_mastertype', 'rmh_name_en', 'rmh_status', 'rmh_createdon', 'rmh_createdby'], 'required'],
            [['rmh_referencemst_fk', 'rmh_mastertype', 'rmh_status', 'rmh_createdby', 'rmh_updatedby'], 'integer'],
            [['rmh_createdon', 'rmh_updatedon'], 'safe'],
            [['rmh_name_en', 'rmh_name_ar'], 'string', 'max' => 255],
            [['rmh_referencemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ReferencemstTbl::className(), 'targetAttribute' => ['rmh_referencemst_fk' => 'referencemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'referencemsthsty_pk' => 'Referencemsthsty Pk',
            'rmh_referencemst_fk' => 'Rmh Referencemst Fk',
            'rmh_mastertype' => 'Rmh Mastertype',
            'rmh_name_en' => 'Rmh Name En',
            'rmh_name_ar' => 'Rmh Name Ar',
            'rmh_status' => 'Rmh Status',
            'rmh_createdon' => 'Rmh Createdon',
            'rmh_createdby' => 'Rmh Createdby',
            'rmh_updatedon' => 'Rmh Updatedon',
            'rmh_updatedby' => 'Rmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmhReferencemstFk()
    {
        return $this->hasOne(ReferencemstTbl::className(), ['referencemst_pk' => 'rmh_referencemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ReferencemsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ReferencemsthstyTblQuery(get_called_class());
    }
}
