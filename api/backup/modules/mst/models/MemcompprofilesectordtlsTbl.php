<?php

namespace api\modules\mst\models; 

use Yii;

/**
 * This is the model class for table "memcompsectordtls_tbl".
 *
 * @property int $MemCompSecDtls_Pk
 * @property int $MCSD_MemberCompMst_Fk
 * @property int $MCSD_SectorMst_Fk
 * @property int $mcsd_industrymst_fk
 * @property int $MCSD_ActivitiesCount
 */
class MemcompprofilesectordtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompsectordtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MCSD_MemberCompMst_Fk', 'MCSD_SectorMst_Fk', 'MCSD_ActivitiesCount'], 'required'],
            [['MCSD_MemberCompMst_Fk', 'MCSD_SectorMst_Fk', 'mcsd_industrymst_fk', 'MCSD_ActivitiesCount'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MemCompSecDtls_Pk' => 'Mem Comp Sec Dtls  Pk',
            'MCSD_MemberCompMst_Fk' => 'Mcsd  Member Comp Mst  Fk',
            'MCSD_SectorMst_Fk' => 'Mcsd  Sector Mst  Fk',
            'mcsd_industrymst_fk' => 'Mcsd  Industry Mst  Fk',
            'MCSD_ActivitiesCount' => 'Mcsd  Activities Count',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompprofilesectordtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprofilesectordtlsTblQuery(get_called_class());
    }
    public function getSector()
    {
        return $this->hasOne(SectormstTbl::className(),['SectorMst_Pk'=>'MCSD_SectorMst_Fk']);
    }
    public function getIndustry(){
        return $this->hasOne(IndustrymstTbl::className(),['IndustryMst_Pk'=>'mcsd_industrymst_fk']);
    }
    public function getActivitysector(){
        return $this->hasMany(MemcompprofilesectoractivitydtlsTbl::className(),['MCSAD_MemCompSecDtls_Fk'=>'MemCompSecDtls_Pk']);
    }
    
    public function getsectormapping() {
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $sector_mapping = MemcompprofilesectordtlsTbl::find()
                ->where('MCSD_MemberCompMSt_Fk = :company',[':company' => $company_id])
                ->all();
        $final_sector_maping = [];
        foreach($sector_mapping as $key => $val) {
           $final_sector_maping[$key]['sectorarr_key'] = $key;
           $final_sector_maping[$key]['sectorpk'] = $val->MCSD_SectorMst_Fk;
           $final_sector_maping[$key]['industrypk'] = $val->mcsd_industrymst_fk;
           $final_sector_maping[$key]['sectorname'] = $val->sector->SecM_SectorName;
           $final_sector_maping[$key]['industryname'] = $val->industry->IndM_IndustryName;
           $final_sector_maping[$key]['expand'] = false;
           if(!empty($val->activitysector)){
               foreach ($val->activitysector as $actkey => $actval){
                   $final_sector_maping[$key]['activitydata'][$actkey]['sec_act_key'] = $actkey;
                   $final_sector_maping[$key]['activitydata'][$actkey]['activitypk'] = $actval->activity->ActivitiesMst_Pk;
                   $final_sector_maping[$key]['activitydata'][$actkey]['activityname'] = $actval->activity->ActM_ActivityName;
                   $final_sector_maping[$key]['activitydata'][$actkey]['fulldetails'][] = [
                       'sectorpk'=>$val->MCSD_SectorMst_Fk,
                       'industrypk'=>$val->mcsd_industrymst_fk,
                       'sectorname'=>$val->sector->SecM_SectorName,
                       'industryname'=>$val->industry->IndM_IndustryName,
                       'panel'=>$key
                       ];

               }
           }
        }
        return json_encode($final_sector_maping);
    }
}
