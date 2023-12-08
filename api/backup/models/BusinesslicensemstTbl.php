<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "businesslicensemst_tbl".
 *
 * @property int $businesslicensemst_pk reference to industrialzonemst_tbl.industrialzonemst_pk
 * @property int $blm_industrialzonemst_fk Reference to industrialzonemst_tbl
 * @property string $blm_licesename_en
 * @property string $blm_licensename_ar
 * @property int $blm_status Industrial Estate status. 1 - Active, 2 - Inactive
 * @property string $blm_createdon
 * @property int $blm_createdby Reference to usermst_tbl
 * @property string $blm_updatedon
 * @property int $blm_updatedby Reference to usermst_tbl
 */
class BusinesslicensemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'businesslicensemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blm_industrialzonemst_fk', 'blm_licesename_en', 'blm_status', 'blm_createdon', 'blm_createdby'], 'required'],
            [['blm_industrialzonemst_fk', 'blm_status', 'blm_createdby', 'blm_updatedby'], 'integer'],
            [['blm_createdon', 'blm_updatedon'], 'safe'],
            [['blm_licesename_en', 'blm_licensename_ar'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'businesslicensemst_pk' => 'Businesslicensemst Pk',
            'blm_industrialzonemst_fk' => 'Blm Industrialzonemst Fk',
            'blm_licesename_en' => 'Blm Licesename En',
            'blm_licensename_ar' => 'Blm Licensename Ar',
            'blm_status' => 'Blm Status',
            'blm_createdon' => 'Blm Createdon',
            'blm_createdby' => 'Blm Createdby',
            'blm_updatedon' => 'Blm Updatedon',
            'blm_updatedby' => 'Blm Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BusinesslicensemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BusinesslicensemstTblQuery(get_called_class());
    }
}
