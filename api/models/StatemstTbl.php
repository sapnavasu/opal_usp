<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statemst_tbl".
 *
 * @property int $statemst_pk
 * @property string $sm_statename_en
 * @property string $sm_statename_ar
 * @property int $sm_status 1-Active, 2-Inactive
 * @property string $sm_createdon
 * @property int $sm_createdby
 * @property string $sm_updatedon
 * @property int $sm_updatedby
 *
 * @property AppinstinfotmpTbl[] $appinstinfotmpTbls
 */
class StatemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sm_statename_en', 'sm_statename_ar', 'sm_status', 'sm_createdon', 'sm_createdby'], 'required'],
            [['sm_status', 'sm_createdby', 'sm_updatedby'], 'integer'],
            [['sm_createdon', 'sm_updatedon'], 'safe'],
            [['sm_statename_en', 'sm_statename_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'statemst_pk' => 'Statemst Pk',
            'sm_statename_en' => 'Sm Statename En',
            'sm_statename_ar' => 'Sm Statename Ar',
            'sm_status' => 'Sm Status',
            'sm_createdon' => 'Sm Createdon',
            'sm_createdby' => 'Sm Createdby',
            'sm_updatedon' => 'Sm Updatedon',
            'sm_updatedby' => 'Sm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppinstinfotmpTbls()
    {
        return $this->hasMany(AppinstinfotmpTbl::className(), ['appiit_statemst_fk' => 'statemst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return StatemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatemstTblQuery(get_called_class());
    }
}
