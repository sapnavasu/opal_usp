<?php

namespace api\modules\pd\models;

use Yii;
use api\modules\mst\models\CurrencymstTbl;
use api\modules\pd\models\ProjecttmpTbl;
use common\models\UsermstTbl;

/**
 * This is the model class for table "projinvinfotmp_tbl".
 *
 * @property int $projinvinfotmp_pk Primary key
 * @property int $piit_projecttmp_fk Reference to projecttmp_tbl
 * @property int $piit_invprefsrc 1 -  Personal savings and/or funds,2 - Equity capital,3 - Debt financing,4 - Crowdfunding,5 - Other (specify)
 * @property string $piit_otherprefsrc To specify if preferred source of investment is selected as Othes
 * @property string $piit_totinvreqd Total Investment required
 * @property int $piit_invreqdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piit_totinvrecd Total Investment received
 * @property int $piit_invrecdcurrencymst_fk Reference to currencymst_tbl
 * @property string $piit_targetinvestors Reference to countrymst_tbl
 * @property string $piit_invinvestorsvideo Video URL for invite to investors
 * @property string $piit_welcomenote Welcome Note
 * @property int $piit_investtype 1 - Equity,2 - Ownership,3 - Partnership,4 - Joint Venture,5 - Take-over,6 - Build, Own, Operate (BOO),7 - Build and Operate (BO),8 - Build, Operate, Transfer (BOT)
 * @property int $piit_investmentstatus 1 - Open, 2 - Closed
 * @property string $piit_submittedon Date of first creation
 * @property int $piit_submittedby Submitted by user id
 * @property string $piit_submittedbyipaddr IP Address of the user
 * @property string $piit_updatedon Date of update
 * @property int $piit_updatedby Updated by user id
 * @property string $piit_updatedbyipaddr IP Address of the user
 *
 * @property CurrencymstTbl $piitInvrecdcurrencymstFk
 * @property CurrencymstTbl $piitInvreqdcurrencymstFk
 * @property ProjecttmpTbl $piitProjecttmpFk
 * @property UsermstTbl $piitSubmittedby
 * @property UsermstTbl $piitUpdatedby
 */
class ProjinvinfotmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvinfotmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['piit_projecttmp_fk'], 'required'],
            [['piit_projecttmp_fk', 'piit_invprefsrc', 'piit_invreqdcurrencymst_fk', 'piit_invrecdcurrencymst_fk', 'piit_investtype', 'piit_investmentstatus', 'piit_submittedby', 'piit_updatedby'], 'integer'],
            [['piit_totinvreqd', 'piit_totinvrecd'], 'number'],
            [['piit_targetinvestors', 'piit_invinvestorsvideo', 'piit_welcomenote'], 'string'],
            [['piit_submittedon', 'piit_updatedon'], 'safe'],
            [['piit_otherprefsrc'], 'string', 'max' => 100],
            [['piit_submittedbyipaddr', 'piit_updatedbyipaddr'], 'string', 'max' => 50],
            [['piit_invrecdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piit_invrecdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piit_invreqdcurrencymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CurrencymstTbl::className(), 'targetAttribute' => ['piit_invreqdcurrencymst_fk' => 'CurrencyMst_Pk']],
            [['piit_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['piit_projecttmp_fk' => 'projecttmp_pk']],
            [['piit_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piit_submittedby' => 'UserMst_Pk']],
            [['piit_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['piit_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvinfotmp_pk' => 'Projinvinfotmp Pk',
            'piit_projecttmp_fk' => 'Piit Projecttmp Fk',
            'piit_invprefsrc' => 'Piit Invprefsrc',
            'piit_otherprefsrc' => 'Piit Otherprefsrc',
            'piit_totinvreqd' => 'Piit Totinvreqd',
            'piit_invreqdcurrencymst_fk' => 'Piit Invreqdcurrencymst Fk',
            'piit_totinvrecd' => 'Piit Totinvrecd',
            'piit_invrecdcurrencymst_fk' => 'Piit Invrecdcurrencymst Fk',
            'piit_targetinvestors' => 'Piit Targetinvestors',
            'piit_invinvestorsvideo' => 'Piit Invinvestorsvideo',
            'piit_welcomenote' => 'Piit Welcomenote',
            'piit_investtype' => 'Piit Investtype',
            'piit_investmentstatus' => 'Piit Investmentstatus',
            'piit_submittedon' => 'Piit Submittedon',
            'piit_submittedby' => 'Piit Submittedby',
            'piit_submittedbyipaddr' => 'Piit Submittedbyipaddr',
            'piit_updatedon' => 'Piit Updatedon',
            'piit_updatedby' => 'Piit Updatedby',
            'piit_updatedbyipaddr' => 'Piit Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiitInvrecdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piit_invrecdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiitInvreqdcurrencymstFk()
    {
        return $this->hasOne(CurrencymstTbl::className(), ['CurrencyMst_Pk' => 'piit_invreqdcurrencymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiitProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'piit_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiitSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piit_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPiitUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'piit_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvinfotmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvinfotmpTblQuery(get_called_class());
    }
}
