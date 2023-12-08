<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projjobtmp_tbl".
 *
 * @property int $projjobtmp_pk Primary key
 * @property int $pjt_projecttmp_fk Reference to projecttmp_tbl
 * @property string $pjt_jobid Job ID
 * @property string $pjt_jobtype Job Type
 * @property string $pjt_designation Designation
 * @property int $pjt_nationalvac No of vacancies for Nationals
 * @property int $pjt_expatriatesvac No of vacancies for Expatriates
 * @property string $pjt_submittedon Submitted on
 * @property int $pjt_submittedby Reference to Usermst_tbl
 * @property string $pjt_submittedbyipaddr IP Address of the user
 * @property string $pjt_updatedon Updated on
 * @property int $pjt_updatedby Reference to Usermst_tbl
 * @property string $pjt_updatedbyipaddr IP Address of the user
 */
class ProjjobtmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projjobtmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pjt_projecttmp_fk', 'pjt_submittedon', 'pjt_submittedby'], 'required'],
            [['pjt_projecttmp_fk', 'pjt_nationalvac', 'pjt_expatriatesvac', 'pjt_submittedby', 'pjt_updatedby'], 'integer'],
            [['pjt_submittedon', 'pjt_updatedon'], 'safe'],
            [['pjt_jobid'], 'string', 'max' => 30],
            [['pjt_jobtype', 'pjt_designation', 'pjt_submittedbyipaddr', 'pjt_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projjobtmp_pk' => 'Projjobtmp Pk',
            'pjt_projecttmp_fk' => 'Pjt Projecttmp Fk',
            'pjt_jobid' => 'Pjt Jobid',
            'pjt_jobtype' => 'Pjt Jobtype',
            'pjt_designation' => 'Pjt Designation',
            'pjt_nationalvac' => 'Pjt Nationalvac',
            'pjt_expatriatesvac' => 'Pjt Expatriatesvac',
            'pjt_submittedon' => 'Pjt Submittedon',
            'pjt_submittedby' => 'Pjt Submittedby',
            'pjt_submittedbyipaddr' => 'Pjt Submittedbyipaddr',
            'pjt_updatedon' => 'Pjt Updatedon',
            'pjt_updatedby' => 'Pjt Updatedby',
            'pjt_updatedbyipaddr' => 'Pjt Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjjobtmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjjobtmpTblQuery(get_called_class());
    }
}
