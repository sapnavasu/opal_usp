<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "projreqdlicdtls_tbl".
 *
 * @property int $projreqdlicdtls_pk Primary key
 * @property int $prld_projectdtls_fk Reference to projectdtls_tbl
 * @property int $prld_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $prld_order Order of the license
 * @property string $prld_submittedon Date of first submission
 * @property int $prld_submittedby Reference to usermst_tbl
 * @property string $prld_submittedbyipaddr IP Address of the user
 * @property string $prld_approvedon Date of Approval
 * @property int $prld_approvedby Reference to usermst_tbl
 * @property string $prld_approvedbyipaddr IP Address of the user
 */
class ProjreqdlicdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projreqdlicdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prld_projectdtls_fk', 'prld_licensinginfo_fk', 'prld_order'], 'required'],
            [['prld_projectdtls_fk', 'prld_licensinginfo_fk', 'prld_order', 'prld_submittedby', 'prld_approvedby'], 'integer'],
            [['prld_submittedon', 'prld_approvedon'], 'safe'],
            [['prld_submittedbyipaddr', 'prld_approvedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projreqdlicdtls_pk' => 'Projreqdlicdtls Pk',
            'prld_projectdtls_fk' => 'Prld Projectdtls Fk',
            'prld_licensinginfo_fk' => 'Prld Licensinginfo Fk',
            'prld_order' => 'Prld Order',
            'prld_submittedon' => 'Prld Submittedon',
            'prld_submittedby' => 'Prld Submittedby',
            'prld_submittedbyipaddr' => 'Prld Submittedbyipaddr',
            'prld_approvedon' => 'Prld Approvedon',
            'prld_approvedby' => 'Prld Approvedby',
            'prld_approvedbyipaddr' => 'Prld Approvedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjreqdlicdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjreqdlicdtlsTblQuery(get_called_class());
    }
}
