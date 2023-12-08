<?php

namespace api\modules\pd\models;

use Yii;
/**
 * This is the model class for table "projinvestmenthsty_tbl".
 *
 * @property int $projinvestmenthsty_pk Primary key
 * @property int $pinh_projinvestmentdtls_fk Reference to projinvestmentdtls_tbl
 * @property int $pinh_projectdtls_fk Reference to projectdtls_tbl
 * @property string $pinh_invamount Invested Amount
 * @property int $pinh_status 1 - Submitted, 2 - Acknowledged, 3 - Approved, 4 - Declined
 * @property int $pinh_usrtype 1 - Investor, 2 - Project Owner
 * @property string $pinh_declaredon Declared on datetime
 * @property string $pinh_histcreatedon Datetime of history creation
 * @property string $pinh_createdon Datetime of creation
 * @property int $pinh_createdby Reference to usermst_tbl
 * @property string $pinh_appdeclon Approved / Declined on
 * @property int $pinh_appdeclby Reference to usermst_tbl
 * @property string $pinh_appdeclcomments Comments if any
 */
class ProjinvestmenthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projinvestmenthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pinh_projinvestmentdtls_fk', 'pinh_projectdtls_fk', 'pinh_invamount', 'pinh_status', 'pinh_usrtype', 'pinh_declaredon', 'pinh_histcreatedon', 'pinh_createdon', 'pinh_createdby'], 'required'],
            [['pinh_projinvestmentdtls_fk', 'pinh_projectdtls_fk', 'pinh_status', 'pinh_usrtype', 'pinh_createdby', 'pinh_appdeclby'], 'integer'],
            [['pinh_invamount'], 'number'],
            [['pinh_declaredon', 'pinh_histcreatedon', 'pinh_createdon', 'pinh_appdeclon'], 'safe'],
            [['pinh_appdeclcomments'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projinvestmenthsty_pk' => 'Projinvestmenthsty Pk',
            'pinh_projinvestmentdtls_fk' => 'Pinh Projinvestmentdtls Fk',
            'pinh_projectdtls_fk' => 'Pinh Projectdtls Fk',
            'pinh_invamount' => 'Pinh Invamount',
            'pinh_status' => 'Pinh Status',
            'pinh_usrtype' => 'Pinh Usrtype',
            'pinh_declaredon' => 'Pinh Declaredon',
            'pinh_histcreatedon' => 'Pinh Histcreatedon',
            'pinh_createdon' => 'Pinh Createdon',
            'pinh_createdby' => 'Pinh Createdby',
            'pinh_appdeclon' => 'Pinh Appdeclon',
            'pinh_appdeclby' => 'Pinh Appdeclby',
            'pinh_appdeclcomments' => 'Pinh Appdeclcomments',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjinvestmenthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjinvestmenthstyTblQuery(get_called_class());
    }
}