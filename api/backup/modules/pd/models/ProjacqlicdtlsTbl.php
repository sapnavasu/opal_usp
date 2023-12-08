<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projacqlicdtls_tbl".
 *
 * @property int $projacqlicdtls_pk Primary key
 * @property int $pald_projectdtls_fk Reference to projectdtls_tbl
 * @property int $pald_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $pald_order Order of the license
 * @property string $pald_submittedon Date of first submission
 * @property int $pald_submittedby Reference to usermst_tbl
 * @property string $pald_submittedbyipaddr IP Address of the user
 * @property string $pald_approvedon Date of Approval
 * @property int $pald_approvedby Reference to usermst_tbl
 * @property string $pald_approvedbyipaddr IP Address of the user
 */
class ProjacqlicdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projacqlicdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pald_projectdtls_fk', 'pald_licensinginfo_fk', 'pald_order'], 'required'],
            [['pald_projectdtls_fk', 'pald_licensinginfo_fk', 'pald_order', 'pald_submittedby', 'pald_approvedby'], 'integer'],
            [['pald_submittedon', 'pald_approvedon'], 'safe'],
            [['pald_submittedbyipaddr', 'pald_approvedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projacqlicdtls_pk' => 'Projacqlicdtls Pk',
            'pald_projectdtls_fk' => 'Pald Projectdtls Fk',
            'pald_licensinginfo_fk' => 'Pald Licensinginfo Fk',
            'pald_order' => 'Pald Order',
            'pald_submittedon' => 'Pald Submittedon',
            'pald_submittedby' => 'Pald Submittedby',
            'pald_submittedbyipaddr' => 'Pald Submittedbyipaddr',
            'pald_approvedon' => 'Pald Approvedon',
            'pald_approvedby' => 'Pald Approvedby',
            'pald_approvedbyipaddr' => 'Pald Approvedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjacqlicdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjacqlicdtlsTblQuery(get_called_class());
    }
}
