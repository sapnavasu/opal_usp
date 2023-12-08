<?php
namespace api\modules\quot\models;

/**
 * This is the model class for table "countrymst_tbl".
 * @property int $CountryMst_Pk Primary key
 * @property int $cym_globalportalmst_fk 
 * @property string $CyM_CountryName_en 
 * @property string $cym_cntrylongname 
 * @property string $cym_cntryshortname 
 * @property string $CyM_CountryCode_en 
 *  @property string $cym_twodigitcountrycode 
 *  @property string $CyM_Status 
 *  @property string $CyM_CreatedOn 
 *  @property string $CyM_CreatedBy 
 *  @property string $CyM_UpdatedOn 
 * @property string $CyM_UpdatedBy 
 */

 class CountrymstTbl extends \yii\db\ActiveRecord
{
     /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countrymst_tbl';
    }


}

