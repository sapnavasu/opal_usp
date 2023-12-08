<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "jsrchdwnldtrack_tbl".
 *
 * @property int $jsrchdwnldtrack_pk
 * @property int $jsdt_memberregmst_Fk
 * @property string $jsdt_category C-Company,G-Geographical, A-Activities, P-Product, S-Service, PPL-People, PDO-PDO Search, VB-Validation Bank, SP-Sector Partner, TB-Tender Board, ‘U’ - UNSPSC Download
 * @property int $jsdt_usermst_fk
 * @property string $jsdt_dwnlddate
 * @property string $jsdt_xlspath
 * @property string $jsdt_inputfields Data from Input field will be stored as encryted HTML
 * @property string $jsdt_exptquery Export Query
 * @property array $jsdt_exptlist List of values in the export pop up to be stored as JSON
 * @property int $jsdt_exptstatus 1- Yes, 2 - No
 * @property int $jsdt_exptby JSearch export done by. Reference to usermst_tbl
 * @property string $jsdt_expton JSearch export done on
 * @property string $jsdt_exptbyipaddr IP Address of the user who exported the JSearch
 * @property string $jsdt_emailid Email id of the user to whom the JSearch export was sent
 * @property int $jsdt_mailstatus 1- Yes, 2 - No
 * @property string $jsdt_expirydate Expiry date of the JSearch export link
 */
class JsrchdwnldtrackTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jsrchdwnldtrack_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jsdt_memberregmst_Fk', 'jsdt_category', 'jsdt_usermst_fk'], 'required'],
            [['jsdt_memberregmst_Fk', 'jsdt_usermst_fk', 'jsdt_exptstatus', 'jsdt_exptby', 'jsdt_mailstatus'], 'integer'],
            [['jsdt_dwnlddate', 'jsdt_exptlist', 'jsdt_expton', 'jsdt_expirydate'], 'safe'],
            [['jsdt_inputfields', 'jsdt_exptquery'], 'string'],
            [['jsdt_category'], 'string', 'max' => 5],
            [['jsdt_xlspath'], 'string', 'max' => 250],
            [['jsdt_exptbyipaddr'], 'string', 'max' => 15],
            [['jsdt_emailid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jsrchdwnldtrack_pk' => 'Jsrchdwnldtrack Pk',
            'jsdt_memberregmst_Fk' => 'Jsdt Memberregmst  Fk',
            'jsdt_category' => 'Jsdt Category',
            'jsdt_usermst_fk' => 'Jsdt Usermst Fk',
            'jsdt_dwnlddate' => 'Jsdt Dwnlddate',
            'jsdt_xlspath' => 'Jsdt Xlspath',
            'jsdt_inputfields' => 'Jsdt Inputfields',
            'jsdt_exptquery' => 'Jsdt Exptquery',
            'jsdt_exptlist' => 'Jsdt Exptlist',
            'jsdt_exptstatus' => 'Jsdt Exptstatus',
            'jsdt_exptby' => 'Jsdt Exptby',
            'jsdt_expton' => 'Jsdt Expton',
            'jsdt_exptbyipaddr' => 'Jsdt Exptbyipaddr',
            'jsdt_emailid' => 'Jsdt Emailid',
            'jsdt_mailstatus' => 'Jsdt Mailstatus',
            'jsdt_expirydate' => 'Jsdt Expirydate',
        ];
    }

    /**
     * {@inheritdoc}
     * @return JsrchdwnldtrackTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JsrchdwnldtrackTblQuery(get_called_class());
    }
}
