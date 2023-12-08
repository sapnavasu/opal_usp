<?php

namespace api\modules\bs\components;
use Yii;
use common\components\Security;
use \common\models\MembercompanymstTbl;
use \api\modules\bs\components\Internalsearch;
use \api\modules\bs\components\Companyprofilefilter;
use \common\models\MemcompprdserfollowdtlsTbl;
use \common\models\MemcompproddtlsTbl;
use \common\models\MemcompservicedtlsTbl;
use \common\models\MemcompmplocationdtlsTbl;
use \common\models\MemcompacomplishdtlsTbl;

class Domainsearch {
    //{"savedata":{"searchType":2,"criteriaType":"2","keyword":[],"filterData":"","saveName":"ttt","queryAll":true}}

    public function domainCriteria(){
        $regPK = \yii\db\ActiveRecord::getTokenData('reg_pk',true);
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);

        $companyProfileQuery = self::companyProfileCount($stkType, $cmpPK);
        // stakeholder final query
        $companyQuery = MembercompanymstTbl::find()
                            ->where(['MemberCompMst_Pk'=>$cmpPK])
                            ->addSelect([
                                'companyProfileCount'=>'('.$companyProfileQuery->createCommand()->getRawSql().')',
                            ]);
        $companyResult = $companyQuery->asArray()->one();

        $overAllCount = $companyResult['companyProfileCount'];

        return [
            [
                'criteriaType'=>'1',
                'criteriaName'=>'All',
                'criteriaCount'=>$overAllCount,
                'stakeholderType'=>[],
            ],
            [
                'criteriaType'=>'2',
                'criteriaName'=>'Company Profile',
                'criteriaCount'=>$companyResult['companyProfileCount'],
                'stakeholderType'=>['1', '2', '3', '6', '7', '9', '11'],
            ],
        ];
    }

    public function companyProfileCount($stkType, $cmpPK){
        $companyProfileQuery = MembercompanymstTbl::find()
                        ->select([
                            'COUNT(MemberCompMst_Pk) as companyProfileCount'
                        ])
                        ->innerJoin('memberregistrationmst_tbl','MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                        ->where([
                            'mrm_stkholdertypmst_fk'=>$stkType,
                            'MRM_MemberStatus'=>'A'
                        ]);
        return $companyProfileQuery;
    }

    public function domainSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh=''){
        switch ($criteriaType) {
            case '2': // Company Profile
                $finalQuery = self::companyProfileSearch($searchKey, $searchSort, $filterSrh);
                break;
        }
        
        return $finalQuery;
    }
    
    public static function companyProfileSearch($searchKey, $searchSort, $filterSrh=''){

        $searchKeyArr = [];
        if(!empty($filterSrh)){
            foreach ($filterSrh as $fskey => $filterType) {
                if(is_array($filterType)){
                    if($filterType[0]->parent[0]->type > 0 && $filterType[0]->parent[0]->combination > 0 && $filterType[0]->parent[0]->dataVal){
                        $searchKeyArr[] = $fskey;
                    }
                }
            }
        }
        $cmpPK = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $stkType = \yii\db\ActiveRecord::getTokenData('reg_type',true);



        $companyProfileSearchQuery = MembercompanymstTbl::find()
                            ->select([
                                'mcm.MemberCompMst_Pk as companyPk',
                                'mcm.MCM_CompanyName as companyName',
                                'cm.ClM_ClassificationType as classificationType',
                                'cm.ClM_HeadCount as headCount',
                                'cmt.CyM_CountryName_en as countryName',
                                'cmt.CountryMst_Pk as countryPk'
                            ])
                            ->from('membercompanymst_tbl as mcm')
                            ->innerJoin('memberregistrationmst_tbl as mrm','mcm.MCM_MemberRegMst_Fk = mrm.MemberRegMst_Pk')
                            ->leftJoin('classificationmst_tbl as cm','cm.ClassificationMst_Pk = mcm.mcm_classificationmst_fk')
                            ->leftJoin('countrymst_tbl as cmt','cmt.CountryMst_Pk = mcm.MCM_Source_CountryMst_Fk')
                            ->leftJoin('statemst_tbl as st','st.StateMst_Pk = mcm.MCM_StateMst_Fk')
                            ->leftJoin('citymst_tbl as ct','ct.CityMst_Pk = mcm.MCM_CityMst_Fk')
                            ->leftJoin('incorpstylemst_tbl as ism','ism.ism_stkholdertypmst_fk = mrm.MemberRegMst_Pk')
                            ->leftJoin('memcompsectordtls_tbl as mscd','mscd.MCSD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                            ->leftJoin('sectormst_tbl as sm','sm.SectorMst_Pk = mscd.MCSD_SectorMst_Fk')
                            ->leftJoin('memcompmplocationdtls_tbl as mcmpld','mcmpld.mcmpld_membercompmst_fk = mcm.MemberCompMst_Pk')
                            ->where([
                                'mrm.mrm_stkholdertypmst_fk'=>$stkType,
                                'mrm.MRM_MemberStatus'=>'A'
                            ]);


        if(!empty($searchKey)){
           $companyProfileSearchQuery->andWhere(['OR',
                                        ['OR LIKE','mcm.MCM_CompanyName',$searchKey],
                                        ['OR LIKE','sm.SecM_SectorName',$searchKey],
                                        ['OR LIKE','cm.ClM_ClassificationType',$searchKey],
                                        ['OR LIKE','cmt.CyM_CountryName_en',$searchKey],
                                        ['OR LIKE','mcm.mcm_aboutus',$searchKey],
                                        ['OR LIKE','mcm.mcm_externalproflink',$searchKey],
                                        ['OR LIKE','mcmpld.mcmpld_officename',$searchKey],
                                        ['OR LIKE','mcm.MCM_crnumber',$searchKey],
                                        ['OR LIKE','mrm.mrm_supplierid',$searchKey],
                                        ['OR LIKE','mrm.mrm_investorid',$searchKey],
                                        ['OR LIKE','mrm.mrm_projownerid',$searchKey]
                                    ]);
        }

        $finalFormation = '';
        if(!empty($filterSrh)){
            $finalFormation = Internalsearch::advanceCoditionFormation($filterSrh,2,2);
        }


        if($finalFormation != ''){
            $finalFormation .= ')';
            //echo'<pre>';print_r($finalFormation);exit;
            $companyProfileSearchQuery->andWhere($finalFormation);
        }
        if($searchSort == 'Desc'){
           $companyProfileSearchQuery->orderBy(['mcm.MCM_CompanyName'=>SORT_DESC]); 
        }else{
            $companyProfileSearchQuery->orderBy(['mcm.MCM_CompanyName'=>SORT_ASC]);
        }
        $companyProfileSearchQuery->groupBy('mcm.MemberCompMst_Pk');
        $companyProfileSearchQueryResult = $companyProfileSearchQuery->asArray();
        //echo'<pre>';print_r($companyProfileSearchQueryResult->createCommand()->getRawSql());exit;
        return $companyProfileSearchQueryResult;
    }

    public function domainFieldSearch($criteriaType, $fsKey, $type){
        if($criteriaType == 2){ // Company Profile
            $filterFieldCombination = Companyprofilefilter::filterQueryFieldTypeFormation($fsKey, $type);
        }
        return $filterFieldCombination;
    }

    public function getCompanyProfileDetails($companyPk){
        $compPk = \yii\db\ActiveRecord::getTokenData('comp_pk',true);
        $companyDetail = MembercompanymstTbl::find()
                                    ->select([
                                        'mcm.MCM_crnumber as lypisId',
                                        'mcm.MCM_CompanyName as companyName',
                                        'cm.ClM_ClassificationType as classificationType',
                                        'cm.ClM_HeadCount as headCount',
                                        'cnt.CyM_CountryName_en as country',
                                        'mcm.mcm_aboutus as aboutUs',
                                        'sm.SecM_SectorName as bunitName',
                                        'mrm.mrm_stkholdertypmst_fk as stkType',
                                        'mrm.mrm_supplierid as supplierId',
                                        'mrm.mrm_investorid as investorId',
                                        'mrm.mrm_projownerid as ownerId',
                                        'date_format(mrm.MRM_CreatedOn,\'%M %Y\') as membersince',
                                        'year(curdate()) - year(mrm.MRM_CreatedOn) - (date_format(curdate(),\'%m%d\') < date_format(mrm.MRM_CreatedOn, \'%m%d\')) as membersinceyearcount',
                                    ])
                                    ->from('membercompanymst_tbl mcm')
                                    ->leftJoin('Memberregistrationmst_tbl mrm', 'mcm.MCM_Memberregmst_Fk = mrm.MemberRegMst_Pk')
                                    ->leftJoin('classificationmst_tbl cm', 'mcm.mcm_classificationmst_fk = cm.classificationmst_pk')
                                    ->leftJoin('countrymst_tbl cnt', 'cnt.CountryMst_Pk = mcm.MCM_Source_CountryMst_Fk')
                                    ->leftJoin('memcompsectordtls_tbl mscd','mscd.MCSD_MemberCompMst_Fk = mcm.MemberCompMst_Pk')
                                    ->leftJoin('sectormst_tbl sm','sm.SectorMst_Pk = mscd.MCSD_SectorMst_Fk')
                                    ->where(['MemberCompMst_Pk' => $companyPk])
                                    ->asArray()->one();

        $follow = MemcompprdserfollowdtlsTbl::getCountAndIsFollowing(1,$companyPk,2,$compPk);
        $companyDetail['productcount'] = MemcompproddtlsTbl::getProductCount($companyPk) - 1;
        $companyDetail['servicecount'] = MemcompservicedtlsTbl::getServiceCount($companyPk) - 1;
        $companyDetail['marketPresenceCount'] = MemcompmplocationdtlsTbl::getMarketPresenceCount($companyPk);
        $companyDetail['certifiacationCount'] = MemcompacomplishdtlsTbl::getCertificateCountByCompany($companyPk);

        return $companyDetail;
    }
}
