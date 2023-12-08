<?php

namespace api\modules\pms\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;

/**
 * This is the model class for table "cmscontractagreementhdr_tbl".
 *
 * @property int $cmscontractagreementhdr_pk Primary key
 * @property string $cmscah_uid Unique ID Auto generated value
 * @property string $cmscah_refno Reference Number
 * @property string $cmscah_title Title
 * @property string $cmscah_issueddate Agreement Issued Date
 * @property string $cmscah_startdate Agreement Start Date
 * @property string $cmscah_enddate Agreement End Date
 * @property int $cmscah_tav_currencymst_fk Reference to currencymst_tbl Total Agreement Value
 * @property string $cmscah_totagreevalue Total Agreement value
 * @property int $cmscah_agreecreatedby Agreement Created by
 * @property string $cmscah_docupload Reference to memcompfiledtls_tbl in comma separation
 * @property string $cmscah_createdon Date of creation
 * @property int $cmscah_createdby Reference to usermst_tbl
 * @property string $cmscah_createdbyipaddr User IP Address
 * @property string $cmscah_updatedon Date of update
 * @property int $cmscah_updatedby Reference to usermst_tbl
 * @property string $cmscah_updatedbyipaddr User IP Address
 *
 * @property CmscontractagreementdtlsTbl[] $cmscontractagreementdtlsTbls
 * @property UsermstTbl $cmscahCreatedby
 * @property CurrencymstTbl $cmscahTavCurrencymstFk
 * @property UsermstTbl $cmscahUpdatedby
 */
class CmscontractagreementhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmscontractagreementhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmscah_uid', 'cmscah_refno', 'cmscah_title', 'cmscah_issueddate', 'cmscah_agreecreatedby'], 'required'],
            [['cmscah_issueddate', 'cmscah_startdate', 'cmscah_enddate', 'cmscah_createdon', 'cmscah_updatedon'], 'safe'],
            [['cmscah_tav_currencymst_fk', 'cmscah_agreecreatedby', 'cmscah_createdby', 'cmscah_updatedby'], 'integer'],
            [['cmscah_totagreevalue'], 'number'],
            [['cmscah_docupload'], 'string'],
            [['cmscah_uid', 'cmscah_refno'], 'string', 'max' => 20],
            [['cmscah_title'], 'string', 'max' => 255],
            [['cmscah_createdbyipaddr', 'cmscah_updatedbyipaddr'], 'string', 'max' => 50],
            [['cmscah_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmscah_createdby' => 'UserMst_Pk']],
            [['cmscah_tav_currencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['cmscah_tav_currencymst_fk' => 'CurrencyMst_Pk']],
            [['cmscah_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['cmscah_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmscontractagreementhdr_pk' => 'Cmscontractagreementhdr Pk',
            'cmscah_uid' => 'Cmscah Uid',
            'cmscah_refno' => 'Cmscah Refno',
            'cmscah_title' => 'Cmscah Title',
            'cmscah_issueddate' => 'Cmscah Issueddate',
            'cmscah_startdate' => 'Cmscah Startdate',
            'cmscah_enddate' => 'Cmscah Enddate',
            'cmscah_tav_currencymst_fk' => 'Cmscah Tav Currencymst Fk',
            'cmscah_totagreevalue' => 'Cmscah Totagreevalue',
            'cmscah_agreecreatedby' => 'Cmscah Agreecreatedby',
            'cmscah_docupload' => 'Cmscah Docupload',
            'cmscah_createdon' => 'Cmscah Createdon',
            'cmscah_createdby' => 'Cmscah Createdby',
            'cmscah_createdbyipaddr' => 'Cmscah Createdbyipaddr',
            'cmscah_updatedon' => 'Cmscah Updatedon',
            'cmscah_updatedby' => 'Cmscah Updatedby',
            'cmscah_updatedbyipaddr' => 'Cmscah Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscontractagreementdtlsTbls()
    {
        return $this->hasMany(CmscontractagreementdtlsTbl::className(), ['cmscad_cmscontractagreementhdr_fk' => 'cmscontractagreementhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscahCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmscah_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscahTavCurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'cmscah_tav_currencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmscahUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'cmscah_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return CmscontractagreementhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmscontractagreementhdrTblQuery(get_called_class());
    }
}
