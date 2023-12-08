<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \common\models\MemcompincorpstylemstTbl;
use api\modules\mst\models\IncorpstyleMaster;
use api\modules\mst\models\SectormstTbl;
use api\modules\mst\models\ClassificationmstTbl;
use \common\models\MemcompmplocationdtlsTbl;

class Domainsearchdata {
    public function getDomainCountry($stkType){
        $countryDetails = MembercompanymstTbl::find()
                                    ->select([
                                        'CountryMst_Pk as cntryPk',
                                        'CyM_CountryName_en as filterPk',
                                        'CyM_CountryName_en as filterName'
                                    ])
                                    ->leftJoin('countrymst_tbl','CountryMst_Pk = MCM_Source_CountryMst_Fk')
                                    ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                                    ->where([
                                        'mrm_stkholdertypmst_fk'=>$stkType,
                                        'CyM_Status'=>'A',
                                        'MRM_MemberStatus'=>'A'
                                    ])
                                    ->groupBy('CountryMst_Pk')
                                    ->asArray()->all();
        return $countryDetails;
    }

    public function getDomainStyleIncorporation($stkType){
        $incorpDetails = IncorpstyleMaster::find()
                            ->select([
                                'IncorpStyleMst_Pk as incorpPk',
                                'ISM_IncorpStyleEntity as filterPk',
                                'ISM_IncorpStyleEntity as filterName',
                            ])
                            ->leftJoin('memberregistrationmst_tbl','ism_stkholdertypmst_fk = MemberRegMst_Pk')
                            ->where([
                                'ism_stkholdertypmst_fk'=>$stkType,
                                'MRM_MemberStatus'=>'A',
                                'ISM_Status'=>'A'
                            ])
                            ->groupBy('IncorpStyleMst_Pk')
                            ->asArray()->all();
        return $incorpDetails;
    }

    public function getDomainSector($stkType){
        $sectorDetails = SectormstTbl::find()
                            ->select([
                                'SectorMst_Pk as sectorPk',
                                'SecM_SectorName as filterPk',
                                'SecM_SectorName as filterName',
                            ])
                            ->innerJoin('memcompsectordtls_tbl','MCSD_SectorMst_Fk = SectorMst_Pk')
                            ->innerJoin('membercompanymst_tbl','MemberCompMst_Pk = MCSD_MemberCompMst_Fk')
                            ->innerJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->where([
                                'mrm_stkholdertypmst_fk'=>$stkType,
                                'MRM_MemberStatus'=>'A',
                                'SecM_Status'=>'A'
                            ])
                            ->groupBy('SectorMst_Pk')
                            ->orderBy(['SecM_SectorName'=>SORT_ASC])
                            ->asArray()->all();
        return $sectorDetails;
    }

    public function getDomainClassification($stkType){
        $sectorDetails = ClassificationmstTbl::find()
                            ->select([
                                'ClassificationMst_Pk as classificationPk',
                                'ClM_ClassificationType as filterPk',
                                'ClM_ClassificationType as filterName',
                            ])
                            ->leftJoin('membercompanymst_tbl','mcm_classificationmst_fk = ClassificationMst_Pk')
                            ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->where([
                                'MCM_MemberRegMst_Fk'=>$stkType,
                                'MRM_MemberStatus'=>'A',
                                'ClM_Status'=>'A'
                            ])
                            ->groupBy('ClassificationMst_Pk')
                            ->asArray()->all();
        return $sectorDetails;
    }

    public function getDomainMarketPresence($stkType){
        $domainMarketPresence = MembercompanymstTbl::find()
                                    ->select([
                                        'mcmpld_locationtype as filterPk',
                                        '(case mcmpld_locationtype when 1 then "Primary" when 2 then "Branch Office" when 3 then "Representative" when 4 then "Factory/Manufacture" when 5 then "Trading" when 6 then "Wholesale/Distributor" when 7 then "Retailer" when 8 then "Agent" when 9 then "Government Agency/Organization" when 10 then "Stockist" when 11 then "Trade House" when 13 then "Port" when 14 then "Clientele" when 15 then "Principle" when 12 then "Other Market Presence" end) as filterName'
                                    ])
                                    ->leftJoin('memcompmplocationdtls_tbl','mcmpld_membercompmst_fk = MemberCompMst_Pk')
                                    ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                                    ->where([
                                        'MCM_MemberRegMst_Fk'=>$stkType,
                                        'MRM_MemberStatus'=>'A',
                                    ])
                                    ->andWhere(['OR',
                                        ['in','mcmpld_locationtype',[1,2,3,4,6,7,8,11,12]]
                                    ])
                                    ->groupBy('mcmpld_locationtype')
                                    ->asArray()->all();
        return $domainMarketPresence;
    }

    public function getDomainMarketPresenceCountry($stkType){
        $marketPresenceCountryDetails = MemcompmplocationdtlsTbl::find()
                                    ->select([
                                        'CountryMst_Pk as cntryPk',
                                        'CyM_CountryName_en as filterPk',
                                        'CyM_CountryName_en as filterName'
                                    ])
                                    ->leftJoin('membercompanymst_tbl','MemberCompMst_Pk = mcmpld_membercompmst_fk')
                                    ->leftJoin('countrymst_tbl','CountryMst_Pk = mcmpld_countrymst_fk')
                                    ->leftJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                                    ->where([
                                        'MCM_MemberRegMst_Fk'=>$stkType,
                                        'CyM_Status'=>'A',
                                    ])
                                    ->groupBy('mcmpld_countrymst_fk')
                                    ->asArray()->all();
        return $marketPresenceCountryDetails;
    }
}
