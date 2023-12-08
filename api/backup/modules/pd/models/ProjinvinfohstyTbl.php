<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\pd\models\ProjecthstyTbl;
/**
 * This is the model class for table "projinvinfohsty_tbl".
 *
 * @property int $projinvinfohsty_pk Primary key
 * @property int $piih_projecthsty_fk Reference to projecthsty_tbl
 * @property int $piih_invprefsrc 1 -  Personal savings and/or funds,2 - Equity capital,3 - Debt financing,4 - Crowdfunding,5 - Other (specify)
 * @property string $piih_otherprefsrc To specify if preferred source of investment is selected as Othes
 * @property string $piih_totinvreqd Total Investment required
 * @property int $piih_invreqdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piih_totinvrecd Total Investment received
 * @property int $piih_invrecdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piih_targetinvestors Reference to countrymst_tbl
 * @property string $piih_invinvestorsvideo Video URL for invite to investors
 * @property string $piih_welcomenote Welcome Note
 * @property int $piih_investtype 1 - Equity,2 - Ownership,3 - Partnership,4 - Joint Venture,5 - Take-over,6 - Build, Own, Operate (BOO),7 - Build and Operate (BO),8 - Build, Operate, Transfer (BOT)
 * @property int $piih_investmentstatus 1 - Open, 2 - Closed
 * @property string $piih_histcreatedon Date of history creation
 * @property string $piih_appdeclon Date of approval / decline
 * @property int $piih_appdeclby Created by user id
 * @property string $piih_appdeclbyipaddr IP Address of the user
 * @property string $piih_submittedon Date of first submission
 * @property int $piih_submittedby Submitted by user id
 * @property string $piih_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $piihAppdeclby
 * @property CurrencymstTbl $piihInvrecdcurrencymstFk
 * @property CurrencymstTbl $piihInvreqdcurrencymstFk
 * @property ProjecthstyTbl $piihProjecthstyFk
 * @property UsermstTbl $piihSubmittedby
 */
class ProjinvinfohstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvinfohsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['piih_projecthsty_fk'], 'required'],
            [['piih_projecthsty_fk', 'piih_invprefsrc', 'piih_invreqdcurrencymst_fk', 'piih_invrecdcurrencymst_fk', 'piih_investtype', 'piih_investmentstatus', 'piih_appdeclby', 'piih_submittedby'], 'integer'],
            [['piih_totinvreqd', 'piih_totinvrecd'], 'number'],
            [['piih_targetinvestors', 'piih_invinvestorsvideo', 'piih_welcomenote'], 'string'],
            [['piih_histcreatedon', 'piih_appdeclon', 'piih_submittedon'], 'safe'],
            [['piih_otherprefsrc'], 'string', 'max' => 100],
            [['piih_appdeclbyipaddr', 'piih_submittedbyipaddr'], 'string', 'max' => 50],
            [['piih_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piih_appdeclby' => 'UserMst_Pk']],
            [['piih_invrecdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piih_invrecdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piih_invreqdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piih_invreqdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piih_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['piih_projecthsty_fk' => 'projecthsty_pk']],
            [['piih_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piih_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvinfohsty_pk' => 'Projinvinfohsty Pk',
            'piih_projecthsty_fk' => 'Piih Projecthsty Fk',
            'piih_invprefsrc' => 'Piih Invprefsrc',
            'piih_otherprefsrc' => 'Piih Otherprefsrc',
            'piih_totinvreqd' => 'Piih Totinvreqd',
            'piih_invreqdcurrencymst_fk' => 'Piih Invreqdcurrencymst Fk',
            'piih_totinvrecd' => 'Piih Totinvrecd',
            'piih_invrecdcurrencymst_fk' => 'Piih Invrecdcurrencymst Fk',
            'piih_targetinvestors' => 'Piih Targetinvestors',
            'piih_invinvestorsvideo' => 'Piih Invinvestorsvideo',
            'piih_welcomenote' => 'Piih Welcomenote',
            'piih_investtype' => 'Piih Investtype',
            'piih_investmentstatus' => 'Piih Investmentstatus',
            'piih_histcreatedon' => 'Piih Histcreatedon',
            'piih_appdeclon' => 'Piih Appdeclon',
            'piih_appdeclby' => 'Piih Appdeclby',
            'piih_appdeclbyipaddr' => 'Piih Appdeclbyipaddr',
            'piih_submittedon' => 'Piih Submittedon',
            'piih_submittedby' => 'Piih Submittedby',
            'piih_submittedbyipaddr' => 'Piih Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiihAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piih_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiihInvrecdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piih_invrecdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiihInvreqdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piih_invreqdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiihProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'piih_projecthsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiihSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piih_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfohstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvinfohstyTblQuery(get_called_class());
    }
}
