<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalstatemst_tbl".
 *
 * @property int $opalstatemst_pk primary key
 * @property int $osm_opalcountrymst_fk reference to opalcountrymst_tbl
 * @property string $osm_statename_en state name english
 * @property string $osm_statename_ar state name arabic
 * @property string $osm_statecode_en state code english
 * @property string $osm_statecode_ar state code arabic
 * @property int $osm_status state status. 1 - active, 2 - inactive
 * @property string $osm_createdon datetime of creation
 * @property int $osm_createdby reference to opalusemst_tbl
 * @property string $osm_updatedon datetime of updation
 * @property int $osm_updatedby reference to opalusermst_tbl
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 */
class OpalstatemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalstatemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['osm_opalcountrymst_fk', 'osm_statename_en', 'osm_statename_ar', 'osm_status', 'osm_createdon', 'osm_createdby'], 'required'],
            [['osm_opalcountrymst_fk', 'osm_status', 'osm_createdby', 'osm_updatedby'], 'integer'],
            [['osm_createdon', 'osm_updatedon'], 'safe'],
            [['osm_statename_en', 'osm_statename_ar'], 'string', 'max' => 100],
            [['osm_statecode_en', 'osm_statecode_ar'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalstatemst_pk' => 'Opalstatemst Pk',
            'osm_opalcountrymst_fk' => 'Osm Opalcountrymst Fk',
            'osm_statename_en' => 'Osm Statename En',
            'osm_statename_ar' => 'Osm Statename Ar',
            'osm_statecode_en' => 'Osm Statecode En',
            'osm_statecode_ar' => 'Osm Statecode Ar',
            'osm_status' => 'Osm Status',
            'osm_createdon' => 'Osm Createdon',
            'osm_createdby' => 'Osm Createdby',
            'osm_updatedon' => 'Osm Updatedon',
            'osm_updatedby' => 'Osm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['oum_opalstatemst_fk' => 'opalstatemst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalstatemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalstatemstTblQuery(get_called_class());
    }
}
