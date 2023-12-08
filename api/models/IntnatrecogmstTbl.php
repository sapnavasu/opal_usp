<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "intnatrecogmst_tbl".
 *
 * @property int $intnatrecogmst_pk
 * @property string $irm_intlrecogname_en
 * @property string $irm_intlrecogname_ar
 * @property int $irm_status 1-Active, 2-Inactive
 * @property string $irm_createdon
 * @property int $irm_createdby
 * @property string $irm_updatedon
 * @property int $irm_updatedby
 *
 * @property AppintrecogtmpTbl[] $appintrecogtmpTbls
 */
class IntnatrecogmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intnatrecogmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['irm_intlrecogname_en', 'irm_intlrecogname_ar', 'irm_status', 'irm_createdby'], 'required'],
            [['irm_status', 'irm_createdby', 'irm_updatedby'], 'integer'],
            [['irm_createdon', 'irm_updatedon'], 'safe'],
            [['irm_intlrecogname_en', 'irm_intlrecogname_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'intnatrecogmst_pk' => 'Intnatrecogmsg Pk',
            'irm_intlrecogname_en' => 'Irm Intlrecogname En',
            'irm_intlrecogname_ar' => 'Irm Intlrecogname Ar',
            'irm_status' => 'Irm Status',
            'irm_createdon' => 'Irm Createdon',
            'irm_createdby' => 'Irm Createdby',
            'irm_updatedon' => 'Irm Updatedon',
            'irm_updatedby' => 'Irm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppintrecogtmpTbls()
    {
        return $this->hasMany(AppintrecogtmpTbl::className(), ['appintit_intnatrecogmst_fk' => 'intnatrecogmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IntnatrecogmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntnatrecogmstTblQuery(get_called_class());
    }
}
