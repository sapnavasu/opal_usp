<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "jsrsnonbidderdtls_tbl".
 *
 * @property int $jsrsnonbidderdtls_pk primary key
 * @property int $jnbd_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property string $jnbd_companyname Company name
 * @property string $jnbd_crregno Commercial Registration Number
 * @property string $jnbd_cmpemailid Company Email Id
 * @property int $jnbd_countrymst_fk Reference to countrymst_tbl
 * @property string $jnbd_personname Contact Person Name
 * @property string $jnbd_department Department name
 * @property string $jnbd_designation Designation Name
 * @property string $jnbd_cpemailid Contact person email id
 * @property int $jnbd_cpmobcountrycode Contact person mobile country code Reference to countrymst_tbl
 * @property string $jnbd_cpmobileno Contact person mobile no
 * @property int $jnbd_isoffemailverified Company Mail id verified or not. 1 - Yes, 0- No
 * @property string $jnbd_registeredon Registered On datetime
 * @property string $jnbd_timezone Timezone
 * @property string $jnbd_ipaddress IP Address
 * @property string $jnbd_emailverifiedon Email Verified Datetime
 * @property int $jnbd_isregistered Is registered Default 0 : 0 - Not Registered, 1 - Registered
 * @property int $jnbd_trgtfrometend Bidder primary key from Etendering will be inserted. If 0 then registration done from JSRS Default 0
 *
 * @property CountrymstTbl $jnbdCountrymstFk
 * @property CountrymstTbl $jnbdCpmobcountrycode
 * @property MemberregistrationmstTbl $jnbdMemberregmstFk
 * @property JsrsnonbidderhstyTbl[] $jsrsnonbidderhstyTbls
 */
class JsrsnonbidderdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jsrsnonbidderdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jnbd_memberregmst_fk', 'jnbd_companyname', 'jnbd_crregno', 'jnbd_cmpemailid', 'jnbd_countrymst_fk', 'jnbd_personname', 'jnbd_designation', 'jnbd_cpemailid', 'jnbd_cpmobileno'], 'required'],
            [['jnbd_memberregmst_fk', 'jnbd_countrymst_fk', 'jnbd_cpmobcountrycode', 'jnbd_isoffemailverified', 'jnbd_isregistered', 'jnbd_trgtfrometend'], 'integer'],
            [['jnbd_registeredon', 'jnbd_emailverifiedon'], 'safe'],
            [['jnbd_companyname', 'jnbd_crregno', 'jnbd_timezone'], 'string', 'max' => 250],
            [['jnbd_cmpemailid', 'jnbd_personname', 'jnbd_cpemailid'], 'string', 'max' => 255],
            [['jnbd_department', 'jnbd_designation'], 'string', 'max' => 100],
            [['jnbd_cpmobileno'], 'string', 'max' => 20],
            [['jnbd_ipaddress'], 'string', 'max' => 50],
            [['jnbd_countrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CountrymstTbl::className(), 'targetAttribute' => ['jnbd_countrymst_fk' => 'CountryMst_Pk']],
            [['jnbd_cpmobcountrycode'], 'exist', 'skipOnError' => true, 'targetClass' => CountrymstTbl::className(), 'targetAttribute' => ['jnbd_cpmobcountrycode' => 'CountryMst_Pk']],
            [['jnbd_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['jnbd_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jsrsnonbidderdtls_pk' => 'Jsrsnonbidderdtls Pk',
            'jnbd_memberregmst_fk' => 'Jnbd Memberregmst Fk',
            'jnbd_companyname' => 'Jnbd Companyname',
            'jnbd_crregno' => 'Jnbd Crregno',
            'jnbd_cmpemailid' => 'Jnbd Cmpemailid',
            'jnbd_countrymst_fk' => 'Jnbd Countrymst Fk',
            'jnbd_personname' => 'Jnbd Personname',
            'jnbd_department' => 'Jnbd Department',
            'jnbd_designation' => 'Jnbd Designation',
            'jnbd_cpemailid' => 'Jnbd Cpemailid',
            'jnbd_cpmobcountrycode' => 'Jnbd Cpmobcountrycode',
            'jnbd_cpmobileno' => 'Jnbd Cpmobileno',
            'jnbd_isoffemailverified' => 'Jnbd Isoffemailverified',
            'jnbd_registeredon' => 'Jnbd Registeredon',
            'jnbd_timezone' => 'Jnbd Timezone',
            'jnbd_ipaddress' => 'Jnbd Ipaddress',
            'jnbd_emailverifiedon' => 'Jnbd Emailverifiedon',
            'jnbd_isregistered' => 'Jnbd Isregistered',
            'jnbd_trgtfrometend' => 'Jnbd Trgtfrometend',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnbdCountrymstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'jnbd_countrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnbdCpmobcountrycode()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'jnbd_cpmobcountrycode']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnbdMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'jnbd_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJsrsnonbidderhstyTbls()
    {
        return $this->hasMany(JsrsnonbidderhstyTbl::className(), ['jnbh_jsrsnonbidderdtls_fk' => 'jsrsnonbidderdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JsrsnonbidderdtlsTblQuery(get_called_class());
    }
}
