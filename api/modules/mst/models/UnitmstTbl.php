<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "unitmst_tbl".
 *
 * @property int $unitmst_pk
 * @property string $unm_namesg Unit Name in Singular
 * @property string $unm_nameplu Unit Name in Plural
 * @property string $unm_symbol Symbol of Unit
 * @property string $unm_type Type of Unit
 * @property int $unm_status 1- Active, 2 - Inactive Default: Active
 * @property string $unm_createdon datetime
 * @property int $unm_createdby Reference to usermst_tbl
 * @property string $unm_updatedon Date of update
 * @property int $unm_updatedby Reference to usermst_tbl
 *
 * @property MemcompfctydtlsTbl[] $memcompfctydtlsTbls
 * @property MemcompproddtlsTbl[] $memcompproddtlsTbls
 * @property MemcompproddtlsTbl[] $memcompproddtlsTbls0
 * @property MemcomptradingdtlsTbl[] $memcomptradingdtlsTbls
 * @property UsermstTbl $unmCreatedby
 * @property UsermstTbl $unmUpdatedby
 */
class UnitmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unitmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unm_namesg', 'unm_createdby'], 'required'],
            [['unm_status', 'unm_createdby', 'unm_updatedby'], 'integer'],
            [['unm_createdon', 'unm_updatedon'], 'safe'],
            [['unm_namesg', 'unm_nameplu', 'unm_type'], 'string', 'max' => 50],
            [['unm_symbol'], 'string', 'max' => 10],
            // [['unm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['unm_createdby' => 'UserMst_Pk']],
            // [['unm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['unm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unitmst_pk' => 'Unitmst Pk',
            'unm_namesg' => 'Unm Namesg',
            'unm_nameplu' => 'Unm Nameplu',
            'unm_symbol' => 'Unm Symbol',
            'unm_type' => 'Unm Type',
            'unm_status' => 'Unm Status',
            'unm_createdon' => 'Unm Createdon',
            'unm_createdby' => 'Unm Createdby',
            'unm_updatedon' => 'Unm Updatedon',
            'unm_updatedby' => 'Unm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompfctydtlsTbls()
    {
        return $this->hasMany(MemcompfctydtlsTbl::className(), ['mcfd_annuprodcapunit' => 'unitmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompproddtlsTbls()
    {
        return $this->hasMany(MemcompproddtlsTbl::className(), ['mcprd_ordercapacityunit' => 'unitmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompproddtlsTbls0()
    {
        return $this->hasMany(MemcompproddtlsTbl::className(), ['mcprd_produnit' => 'unitmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcomptradingdtlsTbls()
    {
        return $this->hasMany(MemcomptradingdtlsTbl::className(), ['mctd_storagecapunit' => 'unitmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'unm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'unm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return UnitmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UnitmstTblQuery(get_called_class());
    }
    public function getUnitlist() {
        $unitlist = UnitmstTbl::find()
                ->select(['unitmst_pk as mvalue','unm_namesg_en as mlabel','unm_namesg_ar'])
                ->where('unm_status = :unm_status',[':unm_status' => '1'])
                ->orderBy('unm_namesg_en ASC')
                ->asArray()
                ->all();

                //unm_namesg
        return $unitlist;
    }
}
