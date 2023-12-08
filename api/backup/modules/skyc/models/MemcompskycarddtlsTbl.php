<?php

namespace api\modules\skyc\models;

use \common\models\UsermstTbl;
use \common\models\BasemodulemstTbl;


use Yii;

/**
 * This is the model class for table "memcompskycarddtls_tbl".
 *
 * @property int $memcompskycarddtls_pk Primary key
 * @property int $mcosd_memcompskycardhdr_fk Reference to memcompskycardhdr_tbl.memcompskycardhdr_pk.
 * @property int $mcosd_basemodulemst_fk Reference to basemodulemst_tbl,to which module, this skycard is created for.
 * @property string $mcosd_shared_fk Project: Reference to projectdtls_tbl.projectdtls_pk(It shows, To which project oriented did the skycard had dropped), Tender: Reference to cmsrequisitionformdtls_tbl.cmsrequisitionformdtls_pk(although check crfd_type)(It shows, To which tender oriented did the skycard had dropped), EOI: Reference to cmstenderhdr_tbl.cmstenderhdr_pk(although check type column) (It shows, To which EOI oriented did the skycard had dropped), Contract: Reference to cmscontracthdr_tbl.cmscontracthdr_pk(although check type for contract)(It shows, To which Contract oriented did the skycard had dropped), Product: Reference to memcompproddtls_tbl.memcompproddtls_pk (It shows, To which product oriented did the skycard had dropped), Service: Reference to memcompservicedtls_tbl.memcompservdtls_pk (It shows, To which service oriented did the skycard had dropped), Subcontract: Reference to cmscontracthdr_tbl.cmscontracthdr_pk and check the type column 2 for subcontract (It shows, To which subcontract oriented did the skycard had dropped), 
 * @property string $mcosd_createdon Date of creation and it also refers the user skycard created date
 * @property int $mcosd_createdby Reference to usermst_tbl
 * @property string $mcosd_createdbyipaddr User IP Address
 * @property string $mcosd_updatedon Date of updation
 * @property int $mcosd_updatedby Reference to usermst_tbl
 * @property string $mcosd_updatedbyipaddr User IP Address
 *
 * @property MemcompscmanagehstyTbl[] $memcompscmanagehstyTbls
 * @property BasemodulemstTbl $mcosdBasemodulemstFk
 * @property UsermstTbl $mcosdCreatedby
 * @property MemcompskycardhdrTbl $mcosdMemcompskycardhdrFk
 * @property UsermstTbl $mcosdUpdatedby
 * @property MemcompskycardmapTbl[] $memcompskycardmapTbls
 */
class MemcompskycarddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompskycarddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcosd_memcompskycardhdr_fk', 'mcosd_createdon', 'mcosd_createdby'], 'required'],
            //, 'mcosd_updatedon', 'mcosd_updatedby'
            [['mcosd_memcompskycardhdr_fk', 'mcosd_basemodulemst_fk', 'mcosd_createdby', 'mcosd_updatedby'], 'integer'],
            [['mcosd_shared_fk'], 'string'],
            [['mcosd_createdon', 'mcosd_updatedon'], 'safe'],
            [['mcosd_createdbyipaddr', 'mcosd_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcosd_basemodulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BasemodulemstTbl::className(), 'targetAttribute' => ['mcosd_basemodulemst_fk' => 'basemodulemst_pk']],
            [['mcosd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosd_createdby' => 'UserMst_Pk']],
            [['mcosd_memcompskycardhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompskycardhdrTbl::className(), 'targetAttribute' => ['mcosd_memcompskycardhdr_fk' => 'memcompskycardhdr_pk']],
            [['mcosd_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosd_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompskycarddtls_pk' => 'Memcompskycarddtls Pk',
            'mcosd_memcompskycardhdr_fk' => 'Mcosd Memcompskycardhdr Fk',
            'mcosd_basemodulemst_fk' => 'Mcosd Basemodulemst Fk',
            'mcosd_shared_fk' => 'Mcosd Shared Fk',
            'mcosd_createdon' => 'Mcosd Createdon',
            'mcosd_createdby' => 'Mcosd Createdby',
            'mcosd_createdbyipaddr' => 'Mcosd Createdbyipaddr',
            'mcosd_updatedon' => 'Mcosd Updatedon',
            'mcosd_updatedby' => 'Mcosd Updatedby',
            'mcosd_updatedbyipaddr' => 'Mcosd Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompscmanagehstyTbls()
    {
        return $this->hasMany(MemcompscmanagehstyTbl::className(), ['mcsmh_memcompskycarddtls_fk' => 'memcompskycarddtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcosdBasemodulemstFk()
    {
        return $this->hasOne(BasemodulemstTbl::className(), ['basemodulemst_pk' => 'mcosd_basemodulemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcosdCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcosdMemcompskycardhdrFk()
    {
        return $this->hasOne(MemcompskycardhdrTbl::className(), ['memcompskycardhdr_pk' => 'mcosd_memcompskycardhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcosdUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosd_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompskycardmapTbls()
    {
        return $this->hasMany(MemcompskycardmapTbl::className(), ['mcsdm_memcompskycarddtls_fk' => 'memcompskycarddtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycarddtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompskycarddtlsTblQuery(get_called_class());
    }
}
