<?php
namespace api\modules\quot\models;
use api\modules\quot\models\CountrymstTbl;
use api\modules\quot\models\ClassificationmstTbl;
use api\modules\mst\models\MemberregistrationmstTbl;
/**
 * This is the model class for table "membercompanymst_tbl".
 *
 * @property int $MemberCompMst_Pk Primary key
 * @property int $MCM_MemberRegMst_Fk Reference to 
 * @property string $MCM_CompanyName Company Name
 * @property string $MCM_crnumber Registration number
 * @property string $MCM_RegistrationYear Registeration year
 * @property string $MCM_RegistrationExpiry Expiry Date
 * @property string $mcm_RegistrationNo JSRS Registeration number
 * @property integer $mcm_complogo_memcompfiledtlsfk 
 * @property enum $MCM_Origin 
 * @property integer $MCM_Source_CountryMst_Fk 
 * @property integer $MCM_CountryMst_Fk 
 * @property integer $MCM_StateMst_Fk 
 * @property integer $MCM_CityMst_Fk 
 * @property string $MCM_website
 * @property json $mcm_socialmedia
 * @property integer $mcm_classificationmst_fk
 * @property string $mcm_aboutus
 * @property string $mcm_vision
 * @property string $mcm_mission
 * @property string $mcm_otherdocs
 * @property string $mcm_externalproflink
 * @property string $mcm_externalprofbanner
 * @property integer $mcm_stakeholderstatus
 * @property string $mcm_explorercreatedon
 * @property string $mcm_explorercreatedon
 * @property string $mcm_championcreatedon
 * @property string $mcm_familycreatedon
 * @property string $mcm_follow_usermst_fk
 * @property string $mcm_groupcmpname
 * @property string $mcm_groupcmpcode
 * @property string $mcm_groupcmpstatus
 * @property string $MCM_SupplierCode
 * @property integer $mcm_howdoyouknowmst_fk
 * @property string $mcm_howdoothers
 * @property integer $mcm_supplierrating
 * @property string mcm_vatinno
 * @property string mcm_accexpirydate
 */

class CmsmembercompanymstTbl extends \yii\db\ActiveRecord
{
     /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membercompanymst_tbl';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountrymsttbl(){
        return $this->hasOne(CountrymstTbl::class,  ['CountryMst_Pk' => 'MCM_CountryMst_Fk']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassificationmstTbl(){
        return $this->hasOne(ClassificationmstTbl::class,  ['ClassificationMst_Pk' => 'mcm_classificationmst_fk']);
    }
    
    public function getMCMMemberRegMstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'MCM_MemberRegMst_Fk']);
    }

}
