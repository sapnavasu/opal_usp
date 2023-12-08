<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmscontractagreementhdrTbl]].
 *
 * @see CmscontractagreementhdrTbl
 */
class CmscontractagreementhdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmscontractagreementhdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmscontractagreementhdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function saveOfflineAgreement($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['agreementPk']) && $formdata['agreementPk'] != null) {
                $model = CmscontractagreementhdrTbl::find()->where("cmscontractagreementhdr_pk =:pk", [':pk' => $formdata['agreementPk']])->one();
                $flag = 'U';
                $comments = 'Updated Successfully!';
                $model->cmscah_updatedon = $date;
                $model->cmscah_updatedby = $userPK;
                $model->cmscah_updatedbyipaddr = $ip_address;
            } else {
                $flag = 'C';
                $comments = 'Created Successfully!';
                $model = new CmscontractagreementhdrTbl;
                $model->cmscah_createdon = $date;
                $model->cmscah_createdby = $userPK;
                $model->cmscah_createdbyipaddr = $ip_address;
                $model->cmscah_uid = Common::getUniqueId('Agreement');
            }
            $model->cmscah_refno = $formdata['refNumber'];
            $model->cmscah_title = strip_tags($formdata['title']);
            $model->cmscah_issueddate = $formdata['agreementIssueDate'];
            $model->cmscah_startdate = $formdata['submitStartDate'];
            $model->cmscah_enddate = $formdata['submitEndDate'];
            $model->cmscah_tav_currencymst_fk = $formdata['currencyPk'];
            $model->cmscah_totagreevalue = $formdata['totalAgreementVal'];
            $model->cmscah_agreecreatedby = $formdata['createdBy'];
            $model->cmscah_docupload = $formdata['uploadPk'];
            if ($model->save() === TRUE) {
                $setContractor = CmscontractagreementdtlsTblQuery::setContractor($formdata, $model->cmscontractagreementhdr_pk);
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments,
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }

    public function agreementList($data) {
        $companypk = \yii\db\ActiveRecord::getTokenData('comp_pk', true);
        $size = Security::sanitizeInput($data['size'], "number");
        $tednerFk = Security::sanitizeInput($data['tednerFk'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $sortpk = Security::sanitizeInput($data['sort'], "number");
        $primaryComp = Security::sanitizeInput($data['primaryComp'], "number");
        $startDate = Security::sanitizeInput($data['startDate'], "string_spl_char");
        $endDate = Security::sanitizeInput($data['endDate'], "string_spl_char");
        $classification = Security::sanitizeInput($data['classification'], "string_spl_char");
        $country = Security::sanitizeInput($data['country'], "string_spl_char");
        $issuedBy = Security::sanitizeInput($data['issuedBy'], "string_spl_char");
        $query1 = (new \yii\db\Query())
                ->select(['cmscontractagreementhdr_pk as dataPk', 'cmscah_uid as unicId', 'cmscah_refno as dataRefno', 'cmscah_title as dataTitle', 'cmscah_issueddate as issueData', 'cmscah_startdate as startDate', 'cmscah_enddate as endDate','cmscah_tav_currencymst_fk as currencyFk',
                    "ROUND(IF(cmscah_tav_currencymst_fk = 3, cmscah_totagreevalue * 2.60080, cmscah_totagreevalue),2) as 'totalValUSD'",
                    "ROUND(IF(cmscah_tav_currencymst_fk = 21, cmscah_totagreevalue / 2.60080, cmscah_totagreevalue),3) as 'totalValOMR'",
                    'username.um_firstname as issuedBy', 'jsrsComp.MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk','cmsch_shared_agreetype as agreeType', 'CurM_CurrSymbol as currencySymbol', new \yii\db\Expression('"offline" as dataType'),
                   'ClM_ClassificationType AS jsrsClass',
                    'CASE  WHEN `cnjsm_classification` = 1 THEN "MSME-Micro" WHEN `cnjsm_classification` = 2 THEN "MSME-Small" WHEN `cnjsm_classification` = 3 THEN "MSME-Medium" WHEN `cnjsm_classification` = 4 THEN "Large" WHEN `cnjsm_classification` = 5 THEN "Internationall" ELSE null  END AS nonJsrsClass'])
                ->from('cmscontractagreementhdr_tbl')
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_shared_agreefk = cmscontractagreementhdr_pk and cmsch_shared_agreetype = 2')
                ->leftJoin('usermst_tbl as username', 'username.UserMst_Pk = cmscah_agreecreatedby')
                ->leftJoin('cmscontractagreementdtls_tbl', 'cmscad_cmscontractagreementhdr_fk = cmscontractagreementhdr_pk and cmscad_isprimarycontractor = 1 and cmscad_status = 1')
                ->leftJoin('membercompanymst_tbl as jsrsComp', 'MemberCompMst_Pk=cmscad_shared_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmscad_shared_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('classificationmst_tbl', 'ClassificationMst_Pk = jsrsComp.mcm_classificationmst_fk')
                ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = jsrsComp.MCM_Source_CountryMst_Fk')
                ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmscah_tav_currencymst_fk')
                ->leftJoin('usermst_tbl as userDataGet', 'cmscah_createdby = userDataGet.UserMst_Pk')
                ->leftJoin('membercompanymst_tbl as userData', 'userData.MCM_MemberRegMst_Fk = userDataGet.UM_MemberRegMst_Fk')
                ->where('userData.MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                ->andWhere('DATE(cmscah_enddate) > CURDATE()')
                ->andFilterWhere(['or', ['like', 'cmscah_uid', $searchTxt], ['like', 'cmscah_refno', $searchTxt], ['like', 'cmscah_title', $searchTxt]]);
        if (!empty($startDate)) {
            $query1->andFilterWhere(['=', 'STR_TO_DATE(cmscah_startdate,"%Y-%m-%d")', $startDate]);
        }
        if (!empty($endDate)) {
            $query1->andFilterWhere(['=', 'STR_TO_DATE(cmscah_enddate,"%Y-%m-%d")', $endDate]);
        }
        if (!empty($primaryComp)) {
            $query1->andFilterWhere(['=', 'cmscad_shared_fk', $primaryComp]);
        }
        if (!empty($classification)) {
            $query1->andFilterWhere(['or', ['IN', 'jsrsComp.mcm_classificationmst_fk', $classification], ['IN', 'cnjsm_classification', $classification]]);
        }
        if (!empty($country)) {
            $query1->andFilterWhere(['or', ['IN', 'jsrsComp.MCM_Source_CountryMst_Fk', $country], ['IN', 'cmsnjsd_countrymst_fk', $country]]);
        }
        if (!empty($issuedBy)) {
            $query1->andFilterWhere(['IN', 'cmscah_agreecreatedby', $issuedBy]);
        }

        $query2 = (new \yii\db\Query())
                ->select(['cmscontracthdr_pk as dataPk', 'cmsch_uid as unicId', 'cmsch_contractrefno as dataRefno', 'cmsch_contracttitle as dataTitle', 'cmsch_initiateddate as issueData', 'cmsch_contractstartdate as startDate', 'cmsch_contractenddate as endDate','cmsch_currencymst_fk as currencyFk',
                    "ROUND(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue),2) as 'totalValUSD'",
                    "ROUND(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue),3) as 'totalValOMR'",
                    'username.um_firstname as issuedBy', 'jsrsComp.MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk', 'cmsch_shared_agreetype as agreeType', 'CurM_CurrSymbol as currencySymbol', new \yii\db\Expression('"online" as dataType'),
                   'ClM_ClassificationType AS jsrsClass',
                    'CASE  WHEN `cnjsm_classification` = 1 THEN "MSME-Micro" WHEN `cnjsm_classification` = 2 THEN "MSME-Small" WHEN `cnjsm_classification` = 3 THEN "MSME-Medium" WHEN `cnjsm_classification` = 4 THEN "Large" WHEN `cnjsm_classification` = 5 THEN "Internationall" ELSE null  END AS nonJsrsClass'])
                ->from('cmscontracthdr_tbl')
                ->leftJoin('cmsawarddtls_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk and cmsad_isprimarycontractor = 1')
                ->leftJoin('usermst_tbl as username', 'username.UserMst_Pk = cmsad_createdby')
                ->leftJoin('membercompanymst_tbl as jsrsComp', 'MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('classificationmst_tbl', 'ClassificationMst_Pk = jsrsComp.mcm_classificationmst_fk')
                ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = jsrsComp.MCM_Source_CountryMst_Fk')
                ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmsch_currencymst_fk')
                ->leftJoin('usermst_tbl as userDataGet', 'cmsch_createdby = userDataGet.UserMst_Pk')
                ->leftJoin('membercompanymst_tbl as userData', 'userData.MCM_MemberRegMst_Fk = userDataGet.UM_MemberRegMst_Fk')
                ->where('userData.MemberCompMst_Pk=:pk', array(':pk' => $companypk))
                ->andWhere('DATE(cmsch_contractenddate) > CURDATE() and cmsch_createdon	is not null')
                ->andWhere('cmsch_type = :type', array(':type' => 3))
                ->andFilterWhere(['or', ['like', 'cmsch_uid', $searchTxt], ['like', 'cmsch_contractrefno', $searchTxt], ['like', 'cmsch_contracttitle', $searchTxt]]);
        if (!empty($startDate)) {
            $query2->andFilterWhere(['=', 'STR_TO_DATE(cmsch_contractstartdate,"%Y-%m-%d")', $startDate]);
        }
        if (!empty($endDate)) {
            $query2->andFilterWhere(['=', 'STR_TO_DATE(cmsch_contractenddate,"%Y-%m-%d")', $endDate]);
        }
        if (!empty($primaryComp)) {
            $query2->andFilterWhere(['or', ['=', 'cmsad_memcompmst_fk', $primaryComp], ['=', 'cmsad_cmsnonjsrssupmap_fk', $primaryComp]]);
        }
        if (!empty($classification)) {
            $query2->andFilterWhere(['IN', 'cmsad_classificationk', $classification]);
        }
        if (!empty($country)) {
            $query2->andFilterWhere(['or', ['IN', 'jsrsComp.MCM_Source_CountryMst_Fk', $country], ['IN', 'cmsnjsd_countrymst_fk', $country]]);
        }
        if (!empty($issuedBy)) {
            $query2->andFilterWhere(['IN', 'cmsad_createdby', $issuedBy]);
        }

        $page = (!empty($size)) ? $size : 4;
        $unionQuery = (new \yii\db\Query())
                ->from(['dummy_name' => $query1->union($query2)])
                ->where('datapk is not null');
        if ($sortpk == 1) {
            $unionQuery->orderBy(['dataTitle' => SORT_ASC]);
        } else {
            $unionQuery->orderBy(['dataTitle' => SORT_DESC]);
        }
        $provider = new ActiveDataProvider(['query' => $unionQuery]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            if (!empty($listData['dataPk'])) {
                $listData['dataTitle'] = html_entity_decode(strip_tags($listData['dataTitle']));
                $listData['issuedValueUSD'] = '0.00';
                $listData['issuedValueOMR'] = '0.000';
                $listData['availableValueUSD'] = '0.00';
                $listData['availableValueOMR'] = '0.000';
                $AlreadyIssuedValue = CmscontracthdrTbl::find()
                        ->select([
                            "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'issuedValueUSD'",
                            "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'issuedValueOMR'",
                        ])
                        ->where("cmsch_shared_agreefk =:dataPk and cmsch_shared_agreetype = :type", [':dataPk' => $listData['dataPk'], ':type' => $listData['dataType'] == 'Online' ? 1 : 2])
                        ->asArray()
                        ->one();
                if (!empty($AlreadyIssuedValue['issuedValueUSD'])) {
                    $listData['issuedValueUSD'] = $AlreadyIssuedValue['issuedValueUSD'];
                    $listData['issuedValueOMR'] = $AlreadyIssuedValue['issuedValueOMR'];
                    $listData['availableValueUSD'] = round($listData['totalValUSD'] - $AlreadyIssuedValue['issuedValueUSD'], 2);
                    $listData['availableValueOMR'] = round($listData['totalValOMR'] - $AlreadyIssuedValue['issuedValueOMR'], 3);
                } else {
                    $listData['availableValueUSD'] = $listData['totalValUSD'];
                    $listData['availableValueOMR'] = $listData['totalValOMR'];
                }
                if($listData['availableValueUSD'] > 1){
                    $finalData[] = $listData;                    
                }
            }
        }
        return [
            'items' => $finalData ? $finalData : [],
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public function getAgreement($dataVal) {
        if ($dataVal['dataType'] == 1) {
            $model = CmsawarddtlsTbl::find()
                    ->select(['cmscontracthdr_pk as dataPk', 'cmsch_uid as unicId', 'cmsch_contractrefno as dataRefno', 'cmsch_contracttitle as dataTitle', 'cmsch_initiateddate as issueData', 'cmsch_contractstartdate as startDate', 'cmsch_contractenddate as endDate','cmsch_currencymst_fk as currencyFk','ClM_ClassificationType AS jsrsClass',
                    'CASE  WHEN `cnjsm_classification` = 1 THEN "MSME-Micro" WHEN `cnjsm_classification` = 2 THEN "MSME-Small" WHEN `cnjsm_classification` = 3 THEN "MSME-Medium" WHEN `cnjsm_classification` = 4 THEN "Large" WHEN `cnjsm_classification` = 5 THEN "Internationall" ELSE null  END AS nonJsrsClass',
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'totalValUSD'",
                        "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'totalValOMR'",
                        'username.um_firstname as issuedBy', 'jsrsComp.MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk','cmsch_shared_agreetype as agreeType', 'CurM_CurrSymbol as currencySymbol', 'CurrencyMst_Pk as currencyPk', 'CurM_CurrencyName_en as currencyName', new \yii\db\Expression('"online" as dataType')])
                    ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk and cmsch_type = 3')
                    ->leftJoin('usermst_tbl as username', 'username.UserMst_Pk = cmsad_createdby')
                    ->leftJoin('membercompanymst_tbl as jsrsComp', 'MemberCompMst_Pk=cmsad_memcompmst_fk')
                    ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
                    ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                    ->leftJoin('classificationmst_tbl', 'ClassificationMst_Pk = jsrsComp.mcm_classificationmst_fk')
                    ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = jsrsComp.MCM_Source_CountryMst_Fk')
                    ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                    ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmsch_currencymst_fk')
                    ->where('cmsad_cmscontracthdr_fk=:dataPk', array(':dataPk' => $dataVal['dataPk']))
                    ->asArray()
                    ->one();
            $contractorArray = CmsawarddtlsTbl::find()
                    ->select(['cmsawarddtls_pk', 'cmsad_memcompmst_fk', 'cmsad_cmsnonjsrssupmap_fk', 'cmsad_isprimarycontractor'])
                    ->where('cmsad_cmscontracthdr_fk=:dataPk', array(':dataPk' => $dataVal['dataPk']))
                    ->asArray()
                    ->all();
        } elseif ($dataVal['dataType'] == 2) {
            $model = CmscontractagreementhdrTbl::find()
                    ->select(['cmscontractagreementhdr_pk as dataPk', 'cmscah_uid as unicId', 'cmscah_refno as dataRefno', 'cmscah_title as dataTitle', 'cmscah_issueddate as issueData', 'cmscah_startdate as startDate', 'cmscah_enddate as endDate', new \yii\db\Expression('"offline" as dataType'),'cmsch_currencymst_fk as currencyFk','ClM_ClassificationType AS jsrsClass',
                    'CASE  WHEN `cnjsm_classification` = 1 THEN "MSME-Micro" WHEN `cnjsm_classification` = 2 THEN "MSME-Small" WHEN `cnjsm_classification` = 3 THEN "MSME-Medium" WHEN `cnjsm_classification` = 4 THEN "Large" WHEN `cnjsm_classification` = 5 THEN "Internationall" ELSE null  END AS nonJsrsClass',
                        "ROUND(SUM(IF(cmscah_tav_currencymst_fk = 3, cmscah_totagreevalue * 2.60080, cmscah_totagreevalue)),2) as 'totalValUSD'",
                        "ROUND(SUM(IF(cmscah_tav_currencymst_fk = 21, cmscah_totagreevalue / 2.60080, cmscah_totagreevalue)),3) as 'totalValOMR'",
                        'username.um_firstname as issuedBy', 'jsrsComp.MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName', 'jsrsCountry.CyM_CountryName_en as jsrsCountryname', 'nonJsrsCountry.CyM_CountryName_en as nonjsrsCountryname', 'jsrsCountry.CountryMst_Pk as jsrsCountryPk', 'nonJsrsCountry.CountryMst_Pk as nonJsrsCountryPk','cmsch_shared_agreetype as agreeType', 'CurM_CurrSymbol as currencySymbol', 'CurrencyMst_Pk as currencyPk', 'CurM_CurrencyName_en as currencyName'])
                    ->leftJoin('cmscontracthdr_tbl', 'cmsch_shared_agreefk = cmscontractagreementhdr_pk and cmsch_shared_agreetype = 2')
                    ->leftJoin('usermst_tbl as username', 'username.UserMst_Pk = cmscah_agreecreatedby')
                    ->leftJoin('cmscontractagreementdtls_tbl', 'cmscad_cmscontractagreementhdr_fk = cmscontractagreementhdr_pk and cmscad_isprimarycontractor = 1 and cmscad_status = 1')
                    ->leftJoin('membercompanymst_tbl as jsrsComp', 'MemberCompMst_Pk=cmscad_shared_fk')
                    ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmscad_shared_fk')
                    ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                    ->leftJoin('classificationmst_tbl', 'ClassificationMst_Pk = jsrsComp.mcm_classificationmst_fk')
                    ->leftJoin('countrymst_tbl as jsrsCountry', 'jsrsCountry.CountryMst_Pk = jsrsComp.MCM_Source_CountryMst_Fk')
                    ->leftJoin('countrymst_tbl as nonJsrsCountry', 'nonJsrsCountry.CountryMst_Pk = cmsnjsd_countrymst_fk')
                    ->leftJoin('currencymst_tbl', 'CurrencyMst_Pk = cmscah_tav_currencymst_fk')
                    ->where('cmscontractagreementhdr_pk=:dataPk', array(':dataPk' => $dataVal['dataPk']))
                    ->asArray()
                    ->one();
            $contractorArray = CmscontractagreementdtlsTbl::find()
                    ->select(['cmscontractagreementstls_pk', 'cmscad_shared_type', 'cmscad_shared_fk', 'cmscad_isprimarycontractor'])
                    ->where('cmscad_cmscontractagreementhdr_fk=:dataPk', array(':dataPk' => $dataVal['dataPk']))
                    ->asArray()
                    ->all();
        }
        $model['dataTitle'] = html_entity_decode(strip_tags($model['dataTitle']));
        $model['issuedValueUSD'] = '0.00';
        $model['issuedValueOMR'] = '0.000';
        $model['availableValueUSD'] = '0.00';
        $model['availableValueOMR'] = '0.000';
        $AlreadyIssuedValue = CmscontracthdrTbl::find()
                ->select([
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 3, cmsch_contractvalue * 2.60080, cmsch_contractvalue)),2) as 'issuedValueUSD'",
                    "ROUND(SUM(IF(cmsch_currencymst_fk = 21, cmsch_contractvalue / 2.60080, cmsch_contractvalue)),3) as 'issuedValueOMR'",
                ])
                ->where("cmsch_shared_agreefk =:dataPk and cmsch_shared_agreetype = :type", [':dataPk' => $model['dataPk'], ':type' => $model['dataType'] == 'Online' ? 1 : 2])
                ->asArray()
                ->one();
        if (!empty($AlreadyIssuedValue['issuedValueUSD'])) {
            $model['issuedValueUSD'] = $AlreadyIssuedValue['issuedValueUSD'];
            $model['issuedValueOMR'] = $AlreadyIssuedValue['issuedValueOMR'];
            $model['availableValueUSD'] = round($model['totalValUSD'] - $AlreadyIssuedValue['issuedValueUSD'], 2);
            $model['availableValueOMR'] = round($model['totalValOMR'] - $AlreadyIssuedValue['issuedValueOMR'], 3);
        } else {
            $model['availableValueUSD'] = $model['totalValUSD'];
            $model['availableValueOMR'] = $model['totalValOMR'];
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
            'contractArray' => $contractorArray ? $contractorArray : [],
        );
        return $result;
    }

}
