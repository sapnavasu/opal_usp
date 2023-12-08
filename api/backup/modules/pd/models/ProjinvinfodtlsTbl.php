<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the model class for table "projinvinfodtls_tbl".
 *
 * @property int $projinvinfodtls_pk Primary key
 * @property int $piid_projectdtls_fk Reference to projectdtls_tbl
 * @property int $piid_invprefsrc 1 -  Personal savings and/or funds,2 - Equity capital,3 - Debt financing,4 - Crowdfunding,5 - Other (specify)
 * @property string $piid_otherprefsrc To specify if preferred source of investment is selected as Othes
 * @property string $piid_totinvreqd Total Investment required
 * @property int $piid_invreqdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piid_totinvrecd Total Investment received
 * @property int $piid_invrecdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piid_targetinvestors Reference to countrymst_tbl
 * @property string $piid_invinvestorsvideo Video URL for invite to investors
 * @property string $piid_welcomenote Welcome Note
 * @property int $piid_investtype 1 - Equity,2 - Ownership,3 - Partnership,4 - Joint Venture,5 - Take-over,6 - Build, Own, Operate (BOO),7 - Build and Operate (BO),8 - Build, Operate, Transfer (BOT)
 * @property int $piid_investmentstatus 1 - Open, 2 - Closed
 * @property string $piid_approvedon Date of approval
 * @property int $piid_approvedby Created by user id
 * @property string $piid_approvedbyipaddr IP Address of the user
 * @property string $piid_submittedon Date of update
 * @property int $piid_submittedby Updated by user id
 * @property string $piid_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $piidApprovedby
 * @property CurrencymstTbl $piidInvrecdcurrencymstFk
 * @property CurrencymstTbl $piidInvreqdcurrencymstFk
 * @property ProjectdtlsTbl $piidProjectdtlsFk
 * @property UsermstTbl $piidSubmittedby
 */
class ProjinvinfodtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvinfodtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['piid_projectdtls_fk'], 'required'],
            [['piid_projectdtls_fk', 'piid_invprefsrc', 'piid_invreqdcurrencymst_fk', 'piid_invrecdcurrencymst_fk', 'piid_investtype', 'piid_investmentstatus', 'piid_approvedby', 'piid_submittedby'], 'integer'],
            [['piid_totinvreqd', 'piid_totinvrecd'], 'number'],
            [['piid_targetinvestors', 'piid_invinvestorsvideo', 'piid_welcomenote'], 'string'],
            [['piid_approvedon', 'piid_submittedon'], 'safe'],
            [['piid_otherprefsrc'], 'string', 'max' => 100],
            [['piid_approvedbyipaddr', 'piid_submittedbyipaddr'], 'string', 'max' => 50],
            [['piid_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piid_approvedby' => 'UserMst_Pk']],
            [['piid_invrecdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piid_invrecdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piid_invreqdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piid_invreqdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piid_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['piid_projectdtls_fk' => 'projectdtls_pk']],
            [['piid_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piid_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvinfodtls_pk' => 'Projinvinfodtls Pk',
            'piid_projectdtls_fk' => 'Piid Projectdtls Fk',
            'piid_invprefsrc' => 'Piid Invprefsrc',
            'piid_otherprefsrc' => 'Piid Otherprefsrc',
            'piid_totinvreqd' => 'Piid Totinvreqd',
            'piid_invreqdcurrencymst_fk' => 'Piid Invreqdcurrencymst Fk',
            'piid_totinvrecd' => 'Piid Totinvrecd',
            'piid_invrecdcurrencymst_fk' => 'Piid Invrecdcurrencymst Fk',
            'piid_targetinvestors' => 'Piid Targetinvestors',
            'piid_invinvestorsvideo' => 'Piid Invinvestorsvideo',
            'piid_welcomenote' => 'Piid Welcomenote',
            'piid_investtype' => 'Piid Investtype',
            'piid_investmentstatus' => 'Piid Investmentstatus',
            'piid_approvedon' => 'Piid Approvedon',
            'piid_approvedby' => 'Piid Approvedby',
            'piid_approvedbyipaddr' => 'Piid Approvedbyipaddr',
            'piid_submittedon' => 'Piid Submittedon',
            'piid_submittedby' => 'Piid Submittedby',
            'piid_submittedbyipaddr' => 'Piid Submittedbyipaddr',
        ];
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiidApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piid_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiidInvrecdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piid_invrecdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiidInvreqdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piid_invreqdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiidProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'piid_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiidSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piid_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfodtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvinfodtlsTblQuery(get_called_class());
    }
}
