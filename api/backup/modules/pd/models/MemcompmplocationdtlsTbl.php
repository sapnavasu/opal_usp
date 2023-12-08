<?php

namespace api\modules\pd\models;

use Yii;

/**
 * This is the model class for table "memcompmplocationdtls_tbl".
 *
 * @property int $memcompmplocationdtls_pk Primary key
 * @property int $mcmpld_membercompmst_fk Reference to membercompanymst_tbl
 * @property int $mcmpld_locationtype 1 - Primary, 2 - Branch, 3 - Representative, 4 - Factory / Manufacture, 5 - Trading, 6 - Wholesale / Distributor, 7 - Retailer, 8 - Agent, 9 - Government Agency / Organization,10 - Stockist, 11 - Trade House, 12 - Others, 13 - Port, 14 - Clientele, 15 - Principle, 16 - Delivery, 17 - Head Office
 * @property string $mcmpld_otherloc To enter if the option is selected as Others
 * @property int $mcmpld_nationality 1 - National, 2 - International
 * @property int $mcmpld_modeoftrans 1- Railways, 2- Roadways, 3- Airways, 4- Waterways, 5- Pipe-Lines
 * @property string $mcmpld_officename Name of the office
 * @property string $mcmpld_crregno CR Reg no of the office
 * @property string $mcmpld_description Description
 * @property string $mcmpld_businscope Business scope
 * @property string $mcmpld_complogo Company Logo .Reference to memcompfiledtls_tbl
 * @property string $mcmpld_branchid Branch ID
 * @property string $mcmpld_address Address of the office
 * @property string $mcmpld_latitude Latitude
 * @property string $mcmpld_longitude Longitude
 * @property int $mcmpld_countrymst_fk Reference to countrymst_tbl
 * @property int $mcmpld_statemst_fk Reference to statemst_tbl
 * @property int $mcmpld_citymst_fk Reference to citymst_tbl
 * @property string $mcmpld_postaladdress Postal Address
 * @property int $mcmpld_postalstatemst_fk Reference to statemst_tbl
 * @property int $mcmpld_postalcitymst_fk Reference to citymst_tbl
 * @property int $mcmpld_postalcountrymst_fk Reference to countrymst_tbl
 * @property int $mcmpld_primobnocc Country code of primary mobile number. Reference to countrymst_tbl
 * @property string $mcmpld_primobno Primary Mobile No
 * @property int $mcmpld_landlinenocc Landline number country code. Reference to countrymst_tbl
 * @property string $mcmpld_landlineno Landline number
 * @property string $mcmpld_landlineext Landline extension
 * @property string $mcmpld_emailid Email ID
 * @property string $mcmpld_website Website
 * @property int $mcmpld_leasetype 1 - Owner, 2 - Tenant
 * @property string $mcmpld_leasestartdt Lease start date
 * @property string $mcmpld_leaseenddt Lease end date
 * @property string $mcmpld_leasedoc Lease document. Reference to memcompfiledtls_tbl in comma separation
 * @property int $mcmpld_isprimheadofc 1 - Yes, 2 - No
 * @property int $mcmpld_ispostaladdr If postal address available or not. 1 - Yes, 2 - No
 *
 * @property MemcompfctydtlsTbl[] $memcompfctydtlsTbls
 * @property CitymstTbl $mcmpldCitymstFk
 * @property MemcompfiledtlsTbl $mcmpldComplogo
 * @property CountrymstTbl $mcmpldCountrymstFk
 * @property MembercompanymstTbl $mcmpldMembercompmstFk
 * @property StatemstTbl $mcmpldStatemstFk
 * @property MemcompprodmarketpresenceTbl[] $memcompprodmarketpresenceTbls
 * @property MemcompservmarketpresenceTbl[] $memcompservmarketpresenceTbls
 * @property MemcomptradingdtlsTbl[] $memcomptradingdtlsTbls
 */
class MemcompmplocationdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompmplocationdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcmpld_membercompmst_fk'], 'required'],
            [['mcmpld_membercompmst_fk', 'mcmpld_locationtype', 'mcmpld_nationality', 'mcmpld_modeoftrans', 'mcmpld_complogo', 'mcmpld_countrymst_fk', 'mcmpld_statemst_fk', 'mcmpld_citymst_fk', 'mcmpld_postalstatemst_fk', 'mcmpld_postalcitymst_fk', 'mcmpld_postalcountrymst_fk', 'mcmpld_primobnocc', 'mcmpld_landlinenocc', 'mcmpld_leasetype', 'mcmpld_isprimheadofc', 'mcmpld_ispostaladdr'], 'integer'],
            [['mcmpld_otherloc', 'mcmpld_officename', 'mcmpld_description', 'mcmpld_businscope', 'mcmpld_address', 'mcmpld_postaladdress', 'mcmpld_leasedoc'], 'string'],
            [['mcmpld_latitude', 'mcmpld_longitude'], 'number'],
            [['mcmpld_leasestartdt', 'mcmpld_leaseenddt'], 'safe'],
            [['mcmpld_crregno'], 'string', 'max' => 40],
            [['mcmpld_branchid'], 'string', 'max' => 30],
            [['mcmpld_primobno', 'mcmpld_landlineno'], 'string', 'max' => 20],
            [['mcmpld_landlineext'], 'string', 'max' => 4],
            [['mcmpld_emailid', 'mcmpld_website'], 'string', 'max' => 255],
            [['mcmpld_citymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\CitymstTbl::className(), 'targetAttribute' => ['mcmpld_citymst_fk' => 'CityMst_Pk']],
            [['mcmpld_complogo'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\drv\models\MemcompfiledtlsTbl::className(), 'targetAttribute' => ['mcmpld_complogo' => 'memcompfiledtls_pk']],
            [['mcmpld_countrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\CountrymstTbl::className(), 'targetAttribute' => ['mcmpld_countrymst_fk' => 'CountryMst_Pk']],
            [['mcmpld_membercompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\MembercompanymstTbl::className(), 'targetAttribute' => ['mcmpld_membercompmst_fk' => 'MemberCompMst_Pk']],
            [['mcmpld_statemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\StatemstTbl::className(), 'targetAttribute' => ['mcmpld_statemst_fk' => 'StateMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompmplocationdtls_pk' => 'Memcompmplocationdtls Pk',
            'mcmpld_membercompmst_fk' => 'Mcmpld Membercompmst Fk',
            'mcmpld_locationtype' => 'Mcmpld Locationtype',
            'mcmpld_otherloc' => 'Mcmpld Otherloc',
            'mcmpld_nationality' => 'Mcmpld Nationality',
            'mcmpld_modeoftrans' => 'Mcmpld Modeoftrans',
            'mcmpld_officename' => 'Mcmpld Officename',
            'mcmpld_crregno' => 'Mcmpld Crregno',
            'mcmpld_description' => 'Mcmpld Description',
            'mcmpld_businscope' => 'Mcmpld Businscope',
            'mcmpld_complogo' => 'Mcmpld Complogo',
            'mcmpld_branchid' => 'Mcmpld Branchid',
            'mcmpld_address' => 'Mcmpld Address',
            'mcmpld_latitude' => 'Mcmpld Latitude',
            'mcmpld_longitude' => 'Mcmpld Longitude',
            'mcmpld_countrymst_fk' => 'Mcmpld Countrymst Fk',
            'mcmpld_statemst_fk' => 'Mcmpld Statemst Fk',
            'mcmpld_citymst_fk' => 'Mcmpld Citymst Fk',
            'mcmpld_postaladdress' => 'Mcmpld Postaladdress',
            'mcmpld_postalstatemst_fk' => 'Mcmpld Postalstatemst Fk',
            'mcmpld_postalcitymst_fk' => 'Mcmpld Postalcitymst Fk',
            'mcmpld_postalcountrymst_fk' => 'Mcmpld Postalcountrymst Fk',
            'mcmpld_primobnocc' => 'Mcmpld Primobnocc',
            'mcmpld_primobno' => 'Mcmpld Primobno',
            'mcmpld_landlinenocc' => 'Mcmpld Landlinenocc',
            'mcmpld_landlineno' => 'Mcmpld Landlineno',
            'mcmpld_landlineext' => 'Mcmpld Landlineext',
            'mcmpld_emailid' => 'Mcmpld Emailid',
            'mcmpld_website' => 'Mcmpld Website',
            'mcmpld_leasetype' => 'Mcmpld Leasetype',
            'mcmpld_leasestartdt' => 'Mcmpld Leasestartdt',
            'mcmpld_leaseenddt' => 'Mcmpld Leaseenddt',
            'mcmpld_leasedoc' => 'Mcmpld Leasedoc',
            'mcmpld_isprimheadofc' => 'Mcmpld Isprimheadofc',
            'mcmpld_ispostaladdr' => 'Mcmpld Ispostaladdr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompfctydtlsTbls()
    {
        return $this->hasMany(MemcompfctydtlsTbl::className(), ['mcfd_memcompmplocationdtls_fk' => 'memcompmplocationdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmpldCitymstFk()
    {
        return $this->hasOne(CitymstTbl::className(), ['CityMst_Pk' => 'mcmpld_citymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmpldComplogo()
    {
        return $this->hasOne(MemcompfiledtlsTbl::className(), ['memcompfiledtls_pk' => 'mcmpld_complogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmpldCountrymstFk()
    {
        return $this->hasOne(CountrymstTbl::className(), ['CountryMst_Pk' => 'mcmpld_countrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmpldMembercompmstFk()
    {
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'mcmpld_membercompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcmpldStatemstFk()
    {
        return $this->hasOne(StatemstTbl::className(), ['StateMst_Pk' => 'mcmpld_statemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprodmarketpresenceTbls()
    {
        return $this->hasMany(MemcompprodmarketpresenceTbl::className(), ['mcpmp_memcompmplocationdtls_fk' => 'memcompmplocationdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompservmarketpresenceTbls()
    {
        return $this->hasMany(MemcompservmarketpresenceTbl::className(), ['mcsmp_memcompmplocationdtls_fk' => 'memcompmplocationdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcomptradingdtlsTbls()
    {
        return $this->hasMany(MemcomptradingdtlsTbl::className(), ['mctd_memcompmplocationdtls_fk' => 'memcompmplocationdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompmplocationdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompmplocationdtlsTblQuery(get_called_class());
    }
}
