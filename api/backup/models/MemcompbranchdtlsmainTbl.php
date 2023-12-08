<?php

namespace app\models;

use Yii;
use common\components\Security;
use common\models\UsermstTbl;
use common\models\MembercompanymstTbl;
use \api\modules\mst\models\CitymstTbl;
use \yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "memcompbranchdtlsmain_tbl".
 *
 * @property int $memcompbranchdtlsmain_pk Primary key
 * @property int $mcbdm_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $mcbdm_memcompbranchdtlstemp_fk Reference to memcompbranchdtlstemp_tbl
 * @property string $mcbdm_branchname Bank Name
 * @property string $mcbdm_branchnumber Bank Number
 * @property int $mcbdm_industrialzonemst_fk Reference to industrialzonemst_tbl
 * @property string $mcbdm_indzoneregno
 * @property int $mcbdm_industrialestatemst_fk Reference to industrialestatemst_tbl
 * @property int $mcbdm_view 1 - Public, 2 - Private
 * @property string $mcbdm_createdon Datetime of creation
 * @property int $mcbdm_createdby Reference to usermst_tbl
 * @property string $mcbdm_createdbyipaddr User IP Address
 * @property string $mcbdm_updatedon Datetime of updation
 * @property int $mcbdm_updatedby Reference to usermst_tbl
 * @property string $mcbdm_updatedbyipaddr User IP Address
 *
 * @property MemcompbranchdtlshstyTbl[] $memcompbranchdtlshstyTbls
 * @property UsermstTbl $mcbdmCreatedby
 * @property MemcompbranchdtlstempTbl $mcbdmMemcompbranchdtlstempFk
 * @property MembercompanymstTbl $mcbdmMemcompmstFk
 * @property UsermstTbl $mcbdmUpdatedby
 */
class MemcompbranchdtlsmainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbranchdtlsmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbdm_memcompmst_fk', 'mcbdm_branchname', 'mcbdm_branchnumber', 'mcbdm_industrialzonemst_fk', 'mcbdm_industrialestatemst_fk', 'mcbdm_createdby'], 'required'],
            [['mcbdm_memcompmst_fk', 'mcbdm_memcompbranchdtlstemp_fk', 'mcbdm_industrialzonemst_fk', 'mcbdm_industrialestatemst_fk', 'mcbdm_view', 'mcbdm_createdby', 'mcbdm_updatedby'], 'integer'],
            [['mcbdm_createdon', 'mcbdm_updatedon'], 'safe'],
            [['mcbdm_branchname', 'mcbdm_indzoneregno', 'mcbdm_createdbyipaddr', 'mcbdm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcbdm_branchnumber'], 'string', 'max' => 20],
            [['mcbdm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcbdm_createdby' => 'UserMst_Pk']],
            [['mcbdm_memcompbranchdtlstemp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => self::className(), 'targetAttribute' => ['mcbdm_memcompbranchdtlstemp_fk' => 'memcompbranchdtlstemp_pk']],
            [['mcbdm_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['mcbdm_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['mcbdm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcbdm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbranchdtlsmain_pk' => 'Memcompbranchdtlsmain Pk',
            'mcbdm_memcompmst_fk' => 'Mcbdm Memcompmst Fk',
            'mcbdm_memcompbranchdtlstemp_fk' => 'Mcbdm Memcompbranchdtlstemp Fk',
            'mcbdm_branchname' => 'Mcbdm Branchname',
            'mcbdm_branchnumber' => 'Mcbdm Branchnumber',
            'mcbdm_industrialzonemst_fk' => 'Mcbdm Industrialzonemst Fk',
            'mcbdm_indzoneregno' => 'Mcbdm Indzoneregno',
            'mcbdm_industrialestatemst_fk' => 'Mcbdm Industrialestatemst Fk',
            'mcbdm_view' => 'Mcbdm View',
            'mcbdm_createdon' => 'Mcbdm Createdon',
            'mcbdm_createdby' => 'Mcbdm Createdby',
            'mcbdm_createdbyipaddr' => 'Mcbdm Createdbyipaddr',
            'mcbdm_updatedon' => 'Mcbdm Updatedon',
            'mcbdm_updatedby' => 'Mcbdm Updatedby',
            'mcbdm_updatedbyipaddr' => 'Mcbdm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompbranchdtlshstyTbls()
    {
        return $this->hasMany(MemcompbranchdtlshstyTbl::className(), ['mcbdh_memcompbranchdtlsmain_fk' => 'memcompbranchdtlsmain_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbdmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcbdm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbdmMemcompbranchdtlstempFk()
    {
        return $this->hasOne(MemcompbranchdtlstempTbl::className(), ['memcompbranchdtlstemp_pk' => 'mcbdm_memcompbranchdtlstemp_fk']);
    }

    public function getCityName()
    {
        print_r('expression');die();
        return $this->hasOne(\api\modules\mst\models\CitymstTbl::className(), ['mcbdm_citymst_fk' => 'CityMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbdmMemcompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'mcbdm_memcompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbdmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcbdm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemQuery(get_called_class());
    }
    
   
}
