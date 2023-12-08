<?php

namespace api\modules\pd\models;
use common\models\UsermstTbl;

use Yii;

/**
 * This is the model class for table "projtechdocumentstmp_tbl".
 *
 * @property int $projtechdocumentstmp_pk Primary key
 * @property int $ptdt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $ptdt_typeofdoc 1- Project plan, 2 - Feasibility report, 3 - Legal
 * @property string $ptdt_techdoc Memcompfiledtls_pk stored as comma separation
 * @property string $ptdt_submittedon First date of submission
 * @property int $ptdt_submittedby Reference to usermst_tbl
 * @property string $ptdt_submittedbyipaddr IP Address of the user
 * @property string $ptdt_updatedon Datetime of Update
 * @property int $ptdt_updatedby Reference to usermst_tbl
 * @property string $ptdt_updatedbyipaddr IP Address of the user
 *
 * @property ProjecttmpTbl $ptdtProjecttmpFk
 * @property UsermstTbl $ptdtSubmittedby
 * @property UsermstTbl $ptdtUpdatedby
 */
class ProjtechdocumentstmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechdocumentstmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptdt_projecttmp_fk', 'ptdt_typeofdoc', 'ptdt_techdoc'], 'required'],
            [['ptdt_projecttmp_fk', 'ptdt_typeofdoc', 'ptdt_submittedby', 'ptdt_updatedby'], 'integer'],
            [['ptdt_techdoc'], 'string'],
            [['ptdt_submittedon', 'ptdt_updatedon'], 'safe'],
            [['ptdt_submittedbyipaddr', 'ptdt_updatedbyipaddr'], 'string', 'max' => 50],
            [['ptdt_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['ptdt_projecttmp_fk' => 'projecttmp_pk']],
            [['ptdt_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptdt_submittedby' => 'UserMst_Pk']],
            [['ptdt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ptdt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechdocumentstmp_pk' => 'Projtechdocumentstmp Pk',
            'ptdt_projecttmp_fk' => 'Ptdt Projecttmp Fk',
            'ptdt_typeofdoc' => 'Ptdt Typeofdoc',
            'ptdt_techdoc' => 'Ptdt Techdoc',
            'ptdt_submittedon' => 'Ptdt Submittedon',
            'ptdt_submittedby' => 'Ptdt Submittedby',
            'ptdt_submittedbyipaddr' => 'Ptdt Submittedbyipaddr',
            'ptdt_updatedon' => 'Ptdt Updatedon',
            'ptdt_updatedby' => 'Ptdt Updatedby',
            'ptdt_updatedbyipaddr' => 'Ptdt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdtProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'ptdt_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdtSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptdt_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtdtUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'ptdt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechdocumentstmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechdocumentstmpTblQuery(get_called_class());
    }
}
