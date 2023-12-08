<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalcontactusdtls_tbl".
 *
 * @property int $opalcontactusdtls_pk Primary key
 * @property int $ocud_conttype 1 - Before login, 2 - Post login
 * @property int $ocud_opalmemberregmst_fk Reference to opalmemberregmst_tbl
 * @property int $ocud_opalusermst_fk Reference to opalusermst_tbl
 * @property string $ocud_companyname Contacted Company Name
 * @property string $ocud_username Contacted User Name
 * @property string $ocud_emailid Email ID
 * @property string $ocud_emailcc Carbon Copy Email IDs
 * @property int $ocud_opalcontactquerymst_fk Reference to opalcontactquerymst_tbl
 * @property string $ocud_subject Subject of the Query
 * @property int $ocud_mobilecc Reference to opalcountrymst_tbl
 * @property string $ocud_mobileno Mobile number
 * @property string $ocud_message Message of the Query
 * @property string $ocud_opalmemcompfiledtls_fk Reference to opalmemcompfiledtls_tbl in comma separation
 * @property string $ocud_createdon Datetime of creation
 * @property string $ocud_mailtemplatepath Mail template path
 */
class OpalcontactusdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalcontactusdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ocud_conttype', 'ocud_createdon'], 'required'],
            [['ocud_conttype', 'ocud_opalmemberregmst_fk', 'ocud_opalusermst_fk', 'ocud_opalcontactquerymst_fk', 'ocud_mobilecc'], 'integer'],
            [['ocud_message', 'ocud_mailtemplatepath'], 'string'],
            [['ocud_createdon'], 'safe'],
            [['ocud_companyname'], 'string', 'max' => 250],
            [['ocud_username'], 'string', 'max' => 100],
            [['ocud_emailid', 'ocud_emailcc', 'ocud_subject'], 'string', 'max' => 255],
            [['ocud_mobileno'], 'string', 'max' => 20],
            [['ocud_opalmemcompfiledtls_fk'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalcontactusdtls_pk' => 'Opalcontactusdtls Pk',
            'ocud_conttype' => 'Ocud Conttype',
            'ocud_opalmemberregmst_fk' => 'Ocud Opalmemberregmst Fk',
            'ocud_opalusermst_fk' => 'Ocud Opalusermst Fk',
            'ocud_companyname' => 'Ocud Companyname',
            'ocud_username' => 'Ocud Username',
            'ocud_emailid' => 'Ocud Emailid',
            'ocud_emailcc' => 'Ocud Emailcc',
            'ocud_opalcontactquerymst_fk' => 'Ocud Opalcontactquerymst Fk',
            'ocud_subject' => 'Ocud Subject',
            'ocud_mobilecc' => 'Ocud Mobilecc',
            'ocud_mobileno' => 'Ocud Mobileno',
            'ocud_message' => 'Ocud Message',
            'ocud_opalmemcompfiledtls_fk' => 'Ocud Opalmemcompfiledtls Fk',
            'ocud_createdon' => 'Ocud Createdon',
            'ocud_mailtemplatepath' => 'Ocud Mailtemplatepath',
        ];
    }
}
