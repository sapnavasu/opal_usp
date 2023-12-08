<?php

namespace api\modules\pd\models;

use Yii;
/**
 * This is the model class for table "projinvestmentdtls_tbl".
 *
 * @property int $projinvestmentdtls_pk Primary key
 * @property int $pind_projectdtls_fk Reference to projectdtls_tbl
 * @property string $pind_invamount Invested Amount
 * @property int $pind_status 1 - Submitted, 2 - Acknowledged, 3 - Project Owner Rejected 4 - Approved, 5 - Declined, 6 - Resubmitted
 * @property int $pind_usrtype 1 - Investor, 2 - Project Owner
 * @property string $pind_declaredon Declared on datetime
 * @property int $pind_memcompmst_fk Reference to membercompanymst_tbl (Investor's Reference)
 * @property string $pind_createdon Datetime of creation
 * @property int $pind_createdby Reference to usermst_tbl
 * @property string $pind_updatedon Updation datetime
 * @property int $pind_updatedby Reference to usermst_tbl
 * @property string $pind_appdeclon Approved / Declined on
 * @property int $pind_appdeclby Reference to usermst_tbl
 * @property string $pind_appdeclcomments Comments if any
 */
class ProjinvestmentdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvestmentdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pind_projectdtls_fk', 'pind_invamount', 'pind_status', 'pind_usrtype', 'pind_declaredon', 'pind_createdon', 'pind_createdby'], 'required'],
            [['pind_projectdtls_fk', 'pind_status', 'pind_usrtype', 'pind_memcompmst_fk', 'pind_createdby', 'pind_updatedby', 'pind_appdeclby'], 'integer'],
            [['pind_invamount'], 'number'],
            [['pind_declaredon', 'pind_createdon', 'pind_updatedon', 'pind_appdeclon'], 'safe'],
            [['pind_appdeclcomments'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvestmentdtls_pk' => 'Projinvestmentdtls Pk',
            'pind_projectdtls_fk' => 'Pind Projectdtls Fk',
            'pind_invamount' => 'Pind Invamount',
            'pind_status' => 'Pind Status',
            'pind_usrtype' => 'Pind Usrtype',
            'pind_declaredon' => 'Pind Declaredon',
            'pind_memcompmst_fk' => 'Pind Memcompmst Fk',
            'pind_createdon' => 'Pind Createdon',
            'pind_createdby' => 'Pind Createdby',
            'pind_updatedon' => 'Pind Updatedon',
            'pind_updatedby' => 'Pind Updatedby',
            'pind_appdeclon' => 'Pind Appdeclon',
            'pind_appdeclby' => 'Pind Appdeclby',
            'pind_appdeclcomments' => 'Pind Appdeclcomments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjinvestmentdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvestmentdtlsTblQuery(get_called_class());
    }
}