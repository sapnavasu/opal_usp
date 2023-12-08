<?php

namespace api\modules\skyc\models;

use \common\models\UsermstTbl;
use \common\models\BasemodulemstTbl;

use Yii;

/**
 * This is the model class for table "memcompskycardhdr_tbl".
 *
 * @property int $memcompskycardhdr_pk Primary key
 * @property int $mcosc_name_usremst_fk Reference to usermst_tbl.usermst_pk(person who creates the skycard).
 * @property string $mcosc_createdon Date of creation and it also refers the user skycard created date
 * @property int $mcosc_createdby Reference to usermst_tbl
 * @property string $mcosc_createdbyipaddr User IP Address
 * @property string $mcosc_updatedon Date of updation
 * @property int $mcosc_updatedby Reference to usermst_tbl
 * @property string $mcosc_updatedbyipaddr User IP Address
 *
 * @property MemcompskycarddtlsTbl[] $memcompskycarddtlsTbls
 * @property UsermstTbl $mcoscCreatedby
 * @property UsermstTbl $mcoscNameUsremstFk
 * @property UsermstTbl $mcoscUpdatedby
 */
class MemcompskycardhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompskycardhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcosc_name_usremst_fk', 'mcosc_createdon', 'mcosc_createdby'], 'required'],//'mcosc_updatedon', 'mcosc_updatedby'
            [['mcosc_name_usremst_fk', 'mcosc_createdby', 'mcosc_updatedby'], 'integer'],
            [['mcosc_createdon', 'mcosc_updatedon'], 'safe'],
            [['mcosc_createdbyipaddr', 'mcosc_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcosc_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_createdby' => 'UserMst_Pk']],
            [['mcosc_name_usremst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_name_usremst_fk' => 'UserMst_Pk']],
            [['mcosc_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompskycardhdr_pk' => 'Memcompskycardhdr Pk',
            'mcosc_name_usremst_fk' => 'Mcosc Name Usremst Fk',
            'mcosc_createdon' => 'Mcosc Createdon',
            'mcosc_createdby' => 'Mcosc Createdby',
            'mcosc_createdbyipaddr' => 'Mcosc Createdbyipaddr',
            'mcosc_updatedon' => 'Mcosc Updatedon',
            'mcosc_updatedby' => 'Mcosc Updatedby',
            'mcosc_updatedbyipaddr' => 'Mcosc Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompskycarddtlsTbls()
    {
        return $this->hasMany(MemcompskycarddtlsTbl::className(), ['mcosd_memcompskycardhdr_fk' => 'memcompskycardhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscNameUsremstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_name_usremst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompskycardhdrTblQuery(get_called_class());
    }
}
