<?php

namespace api\modules\pd\models;
use \common\models\UsermstTbl;
use \common\models\MemcompacomplishdtlsTbl;

use Yii;

/**
 * This is the model class for table "projaccachievetmp_tbl".
 *
 * @property int $projaccachievetmp_pk Primary key
 * @property int $paat_projecttmp_fk Reference to projecttmp_tbl
 * @property string $paat_memcompacomplishdtls_fk Reference to memcompacomplishdtls_tbl
 * @property int $paat_type 1 - Accreditation, 2 - Achievement, 3 - Award, 4 - Certificate
 * @property string $paat_memcompfiledtls_fk Memcompfiledtls_pk stored in comma separation
 * @property int $paat_index For sorting purpose
 * @property string $paat_submittedon First creation date
 * @property int $paat_submittedby Reference to usermst_tbl
 * @property string $paat_submittedbyipaddr IP Address of the user
 * @property string $paat_updatedon Datetime of updation
 * @property int $paat_updatedby Reference to usermst_tbl
 * @property string $paat_updatedbyipaddr IP Address of the user
 *
 * @property MemcompacomplishdtlsTbl $paatMemcompacomplishdtlsFk
 * @property ProjecttmpTbl $paatProjecttmpFk
 * @property UsermstTbl $paatSubmittedby
 * @property UsermstTbl $paatUpdatedby
 */
class ProjaccachievetmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projaccachievetmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paat_projecttmp_fk', 'paat_memcompacomplishdtls_fk', 'paat_type', 'paat_index'], 'required'],
            [['paat_projecttmp_fk', 'paat_memcompacomplishdtls_fk', 'paat_type', 'paat_index', 'paat_submittedby', 'paat_updatedby'], 'integer'],
            [['paat_memcompfiledtls_fk'], 'string'],
            [['paat_submittedon', 'paat_updatedon'], 'safe'],
            [['paat_submittedbyipaddr', 'paat_updatedbyipaddr'], 'string', 'max' => 50],
            [['paat_memcompacomplishdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompacomplishdtlsTbl::className(), 'targetAttribute' => ['paat_memcompacomplishdtls_fk' => 'memcompacomplishdtls_pk']],
            [['paat_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['paat_projecttmp_fk' => 'projecttmp_pk']],
            [['paat_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paat_submittedby' => 'UserMst_Pk']],
            [['paat_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['paat_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projaccachievetmp_pk' => 'Projaccachievetmp Pk',
            'paat_projecttmp_fk' => 'Paat Projecttmp Fk',
            'paat_memcompacomplishdtls_fk' => 'Paat Memcompacomplishdtls Fk',
            'paat_type' => 'Paat Type',
            'paat_memcompfiledtls_fk' => 'Paat Memcompfiledtls Fk',
            'paat_index' => 'Paat Index',
            'paat_submittedon' => 'Paat Submittedon',
            'paat_submittedby' => 'Paat Submittedby',
            'paat_submittedbyipaddr' => 'Paat Submittedbyipaddr',
            'paat_updatedon' => 'Paat Updatedon',
            'paat_updatedby' => 'Paat Updatedby',
            'paat_updatedbyipaddr' => 'Paat Updatedbyipaddr',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaatProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'paat_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaatSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paat_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaatUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'paat_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjaccachievetmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjaccachievetmpTblQuery(get_called_class());
    }
}
