<?php

namespace api\modules\pd\models;

use Yii;
use api\modules\pd\models\ProjecttmpTbl;
use common\models\UsermstTbl;

/**
 * This is the model class for table "projfaqtmp_tbl".
 *
 * @property int $projfaqtmp_pk
 * @property int $pft_projecttmp_fk Reference to projecttmp_tbl
 * @property string $pft_question Question
 * @property string $pft_answer Answer for the question
 * @property int $pft_type 1 - General, 2 - Project, 3 - Product, 4 - Services
 * @property int $pft_index index of the QA
 * @property int $pft_status 1 - Active, 2 - Inactive
 * @property string $pft_submittedon Datetime of first submission
 * @property int $pft_submittedby Reference to usermst_tbl
 * @property string $pft_submittedbyipaddr User IP Address
 * @property string $pft_updatedon Datetime of updation
 * @property int $pft_updatedby Reference to usermst_tbl
 * @property string $pft_updatedbyipaddr User IP Address
 *
 * @property ProjecttmpTbl $pftProjecttmpFk
 * @property UsermstTbl $pftSubmittedby
 * @property UsermstTbl $pftUpdatedby
 */
class ProjfaqtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projfaqtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pft_projecttmp_fk', 'pft_type', 'pft_index', 'pft_status', 'pft_submittedby', 'pft_updatedby'], 'integer'],
            [['pft_question', 'pft_answer', 'pft_type', 'pft_status', 'pft_submittedon', 'pft_submittedby'], 'required'],
            [['pft_question', 'pft_answer'], 'string'],
            [['pft_submittedon', 'pft_updatedon'], 'safe'],
            [['pft_submittedbyipaddr', 'pft_updatedbyipaddr'], 'string', 'max' => 50],
            [['pft_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['pft_projecttmp_fk' => 'projecttmp_pk']],
            [['pft_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pft_submittedby' => 'UserMst_Pk']],
            [['pft_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pft_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projfaqtmp_pk' => 'Projfaqtmp Pk',
            'pft_projecttmp_fk' => 'Pft Projecttmp Fk',
            'pft_question' => 'Pft Question',
            'pft_answer' => 'Pft Answer',
            'pft_type' => 'Pft Type',
            'pft_index' => 'Pft Index',
            'pft_status' => 'Pft Status',
            'pft_submittedon' => 'Pft Submittedon',
            'pft_submittedby' => 'Pft Submittedby',
            'pft_submittedbyipaddr' => 'Pft Submittedbyipaddr',
            'pft_updatedon' => 'Pft Updatedon',
            'pft_updatedby' => 'Pft Updatedby',
            'pft_updatedbyipaddr' => 'Pft Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPftProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'pft_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPftSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pft_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPftUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pft_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjfaqtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjfaqtmpTblQuery(get_called_class());
    }
}
