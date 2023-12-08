<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsawarddtlsTbl]].
 *
 * @see CmsawarddtlsTbl
 */
class CmsawarddtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsawarddtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsawarddtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function inserData($formData, $formType, $dataPk, $type, $dataType) {
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $loginType = \yii\db\ActiveRecord::getTokenData('reg_type', true);
        if ($dataType == 1) {
            $chkModule = CmsawarddtlsTbl::find()
                    ->where("cmsad_cmscontracthdr_fk =:contractPk and cmsad_memcompmst_fk =:dataPk and cmsad_isprimarycontractor = :dataType", [':contractPk' => $formData['contractPk'], ':dataPk' => $dataPk, ':dataType' => $type])
                    ->one();
            $comModel = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->select(['ClM_ClassificationType as classificatinType'])
                            ->leftJoin('classificationmst_tbl', 'ClassificationMst_Pk = mcm_classificationmst_fk')
                            ->where('MemberCompMst_Pk=:pk', [':pk' => $dataPk])
                            ->asArray()->one();
        } else {
            $chkModule = CmsawarddtlsTbl::find()
                    ->where("cmsad_cmscontracthdr_fk =:contractPk and cmsad_cmsnonjsrssupmap_fk =:dataPk and cmsad_isprimarycontractor = :dataType", [':contractPk' => $formData['contractPk'], ':dataPk' => $dataPk, ':dataType' => $type])
                    ->one();
            $comModel = CmsnonjsrssupmapTbl::find()
                            ->select(['cnjsm_classification as classificatinType', 'cnjsm_specialstatus as specialstatus'])
                            ->where('cmsnonjsrssupmap_pk=:pk', [':pk' => $dataPk])
                            ->asArray()->one();
        }
        if (empty($chkModule)) {
            $model = new CmsawarddtlsTbl;
            if ($loginType == 6) {
                $subContract = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formData['contractPk']])->one();
                $tender = $subContract->cmschCmsrequisitionformdtlsFk;
                $operatorCompPk = $subContract->cmschCmscontracthdrFk;
                $deviated = null;
                $splStatus = null;
                if ($dataType == 1) {
                    $statusChk = self::chkDeviatedSplstatus($dataPk, $tender->crfd_rqclassification, $comModel['classificatinType'], $operatorCompPk->cmsch_memcompmst_fk);
                    $deviated = $statusChk['deviated'];
                    $splStatus = $statusChk['splstatus'];
                } else {
                    $classificationArray = [1 => 'MSME - Micro', 2 => 'MSME - Small', 3 => 'MSME - Medium'];
                    if ($tender->crfd_rqclassification == 2 || $tender->crfd_rqclassification == 3) {
                        $lccCompArray = \Yii::$app->params['lcc']['compPk'];
                        if (in_array($operatorCompPk->cmsch_memcompmst_fk, $lccCompArray)) {
                            $opratorLcc = array_search($operatorCompPk->cmsch_memcompmst_fk, $lccCompArray);
                        }
                    }
                    if ($tender->crfd_rqclassification == 1) {
                        if (in_array($comModel['classificatinType'], $classificationArray)) {
                            $deviated = 2;
                        } else {
                            $deviated = 1;
                        }
                    } elseif ($tender->crfd_rqclassification == 2) {
                        if ($opratorLcc == $comModel['specialstatus']) {
                            $deviated = 2;
                        } else {
                            $deviated = 1;
                        }
                    } elseif ($tender->crfd_rqclassification == 3) {
                        if (in_array($comModel['classificatinType'], $classificationArray) || $opratorLcc == $comModel['specialstatus']) {
                            $deviated = 2;
                        } else {
                            $deviated = 1;
                        }
                    }
                    $splStatus = $comModel['specialstatus'];
                }
            } else {
                $opratorPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
                $lccCompArray = \Yii::$app->params['lcc']['compPk'];
                $opratorLcc = array_search($opratorPk, $lccCompArray);
                if ($opratorLcc == 'pdo') {
                    $nonJsrsStatus = 4;
                } elseif ($opratorLcc == 'cced') {
                    $nonJsrsStatus = 1;
                } elseif ($opratorLcc == 'duqm') {
                    $nonJsrsStatus = 2;
                } elseif ($opratorLcc == 'oxy') {
                    $nonJsrsStatus = 3;
                } else {
                    $nonJsrsStatus = null;
                }
                if ($dataType == 1) {
                    $splStatus = $nonJsrsStatus;
                } else {
                    $splStatus = $opratorLcc ? $opratorLcc : null;
                }
            }
            if ($dataType == 1) {
                if ($comModel['classificatinType'] == 'MSME - Micro') {
                    $model->cmsad_classification = 1;
                } elseif ($comModel['classificatinType'] == 'MSME - Small') {
                    $model->cmsad_classification = 2;
                } elseif ($comModel['classificatinType'] == 'MSME - Medium') {
                    $model->cmsad_classification = 3;
                } elseif ($comModel['classificatinType'] == 'Large') {
                    $model->cmsad_classification = 4;
                } else {
                    $model->cmsad_classification = 5;
                }
                $model->cmsad_jsrssplstatus = $splStatus;
                $model->cmsad_memcompmst_fk = $dataPk;
            } elseif ($dataType == 2) {
                $model->cmsad_cmsnonjsrssupmap_fk = $dataPk;
                $model->cmsad_classification = $comModel['classificatinType'];
                $model->cmsad_nonjsrssplstatus = $splStatus;
            }
            if($type == 1){
                $model->cmsad_justifycomment = $formData['resason_desc'];
                if(!empty($formData['resason_proof'])){
                    $model->cmsad_justifydocupload = strval($formData['resason_proof'][0]);                                    
                }  else {
                    $model->cmsad_justifydocupload = null; 
                }
            }
            $model->cmsad_isdeviated = $deviated;
            $model->cmsad_isprimarycontractor = $type;
            $model->cmsad_cmscontracthdr_fk = $formData['contractPk'];
            $model->cmsad_createdon = $date;
            $model->cmsad_createdby = $userPK;
            $model->cmsad_createdbyipaddr = $ip_address;
            if ($model->save()) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Contractor details added successfully'
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
        } else {
            if($type == 1){
                $chkModule->cmsad_justifycomment = $formData['resason_desc'];
                if(!empty($formData['resason_proof'])){
                    $chkModule->cmsad_justifydocupload = strval($formData['resason_proof'][0]);                                    
                }  else {
                    $chkModule->cmsad_justifydocupload = null; 
                }
                if ($chkModule->save()) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'comments' => 'Contractor details added successfully'
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $chkModule->getErrors()
                    );
                }
            }
        }
        return $result;
    }

    public function chkDeviatedSplstatus($compPk, $tenderClass, $supplerClass, $operatorCompPk) {
        $result = [];
        if (!empty($tenderClass) && $tenderClass != 4) {
            $result['deviated'] = null;
            $result['splstatus'] = null;
            $classificationArray = ['MSME - Micro', 'MSME - Small', 'MSME - Medium'];
            $compTable = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->where('MemberCompMst_Pk=:pk', [':pk' => $compPk])->one();
            if ($tenderClass == 2 || $tenderClass == 3) {
                $lccCompArray = \Yii::$app->params['lcc']['compPk'];
                if (in_array($operatorCompPk, $lccCompArray)) {
                    $opratorLcc = array_search($operatorCompPk, $lccCompArray);
                }
                $lccStatus = \common\models\MemcomplcccerthdrTblQuery::lccStatusChk($compTable, $opratorLcc);
            }
            if ($tenderClass == 1) {
                if (in_array($supplerClass, $classificationArray)) {
                    $result['deviated'] = 2;
                } else {
                    $result['deviated'] = 1;
                }
            } elseif ($tenderClass == 2) {
                if ($lccStatus == true) {
                    $result['deviated'] = 2;
                } else {
                    $result['deviated'] = 1;
                }
            } elseif ($tenderClass == 3) {
                if (in_array($supplerClass, $classificationArray) || $lccStatus == true) {
                    $result['deviated'] = 2;
                } else {
                    $result['deviated'] = 1;
                }
            }
            if ($lccStatus) {
                $result['splstatus'] = $lccStatus == 'pdo' ? 4 : $lccStatus == 'cced' ? 1 : $lccStatus == 'duqm' ? 2 : $lccStatus == 'oxy' ? 3 : null;
            } else {
                $result['splstatus'] = null;
            }
        } else {
            $result['deviated'] = null;
            $result['splstatus'] = null;
        }
    }

    public function SaveAwardedTo($formdata, $formType, $primeryPk, $secondaryPk) {
        if (!empty($formdata) && !empty($primeryPk)) {
            $result = self::inserData($formdata, $dataType, $primeryPk['dataPk'], 1, $primeryPk['dataType']);
             if ($result['flag'] == 'E') {
                        return $result;
                }
            if (!empty($secondaryPk) && $secondaryPk != NULL) {
                foreach ($secondaryPk as $key => $dataVal) {
                    $result = self::inserData($formdata, $formType, $dataVal['dataPk'], 0, $dataVal['dataType']);
                    if ($result['flag'] == 'E') {
                        return $result;
                    }
                }
            }
            return $result;
        }
    }

    public function getAwardedtoArray($contractPk) {
        $model = CmsawarddtlsTbl::find()
                ->select(['cmsawarddtls_pk', 'cmsad_cmscontracthdr_fk', 'cmsad_memcompmst_fk', 'cmsad_cmsnonjsrssupmap_fk', 'cmsad_isprimarycontractor'])
                ->where('cmsad_cmscontracthdr_fk=:conPK', array(':conPK' => $contractPk))
                ->asArray()
                ->all();

        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function getContractStatus() {
        $companyPk= \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model = CmsawarddtlsTbl::find()
                ->where('cmsad_memcompmst_fk=:comPk and cmsad_isprimarycontractor = 1', array(':comPk' => $companyPk))
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model ? 1 : 0,
        );
        return $result;
    }

    public function getChechkinEntity($contractPk) {
        $model = CmsawarddtlsTbl::find()
                ->select(['cmsad_memcompmst_fk as companyPk', 'cmsad_cmsnonjsrssupmap_fk as cmsnonjsrs', 'MCM_CompanyName as companyName', 'cnjsm_orgname as nonjsrsCompanyname',])
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->where('cmsad_cmscontracthdr_fk=:conPK', array(':conPK' => $contractPk))
                ->asArray()
                ->all();
        $finalData = [];
        foreach ($model as $key => $dataVal) {
            if ($dataVal['companyPk'] != null || $dataVal['cmsnonjsrs'] != null) {
                $finalData[] = $dataVal;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $finalData,
        );
        return $result;
    }

    public function deleteAwarded($contractPk, $dataPk, $dataType) {
        if (!empty($dataPk)) {
            if ($dataType == 1) {
                $model = CmsawarddtlsTbl::find()
                        ->where("cmsad_cmscontracthdr_fk =:contractPk and cmsad_memcompmst_fk =:dataPk", [':contractPk' => $contractPk, ':dataPk' => $dataPk])
                        ->one();
                $model->delete();
            } elseif ($dataType == 2) {
                $model = CmsawarddtlsTbl::find()
                        ->where("cmsad_cmscontracthdr_fk =:contractPk and cmsad_cmsnonjsrssupmap_fk =:dataPk", [':contractPk' => $contractPk, ':dataPk' => $dataPk])
                        ->one();
                $model->delete();
                $mapDelete = CmsnonjsrssupmapTbl::find()
                        ->where("cmsnonjsrssupmap_pk =:dataPk", [':dataPk' => $dataPk])
                        ->one();
                $mapDelete->delete();
            }
            if ($model) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
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

    public static function getAwardedtoCompArray() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $modelJsrs = CmsawarddtlsTbl::find()
                ->select([ 'distinct coalesce(MCM_CompanyName) as CompanyName', 'cmsad_memcompmst_fk as dataPK'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->where('cmsch_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_memcompmst_fk' => null]])
                ->orderBy("CompanyName ASC")
                ->asArray()
                ->all();
        $modelJsrsCountry = CmsawarddtlsTbl::find()
                ->select([ 'distinct coalesce(CyM_CountryName_en) as CountryName', 'CountryMst_Pk as dataPK'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk = MCM_Source_CountryMst_Fk')
                ->where('cmsch_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_memcompmst_fk' => null]])
                ->orderBy("CountryName ASC")
                ->asArray()
                ->all();
        $modelNONJsrs = CmsawarddtlsTbl::find()
                ->select([ 'distinct coalesce(cnjsm_orgname) as CompanyName', 'cmsad_cmsnonjsrssupmap_fk as dataPK'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->where('cmsch_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_cmsnonjsrssupmap_fk' => null]])
                ->orderBy("CompanyName ASC")
                ->asArray()
                ->all();
        $modelNONJsrsCountry = CmsawarddtlsTbl::find()
                ->select([ 'distinct coalesce(CyM_CountryName_en) as CountryName', 'CountryMst_Pk as dataPK'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk = cmsnjsd_countrymst_fk')
                ->where('cmsch_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_cmsnonjsrssupmap_fk' => null]])
                ->orderBy("CountryName ASC")
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'jsrs' => $modelJsrs ? $modelJsrs : [],
            'jsrsCountry' => $modelJsrsCountry ? $modelJsrsCountry : [],
            'nonJsrs' => $modelNONJsrs ? $modelNONJsrs : [],
            'nonCountry' => $modelNONJsrsCountry ? $modelNONJsrsCountry : [],
        );
        return $result;
    }

    public static function getAwardedbyCompArray() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $modelJsrs = CmsawarddtlsTbl::find()
                ->select([ 'distinct coalesce(MCM_CompanyName) as CompanyName', 'MemberCompMst_Pk as dataPK', 'mrm_stkholdertypmst_fk as stkholderType'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsch_memcompmst_fk')
                ->leftJoin('memberregistrationmst_tbl', 'MemberRegMst_Pk = MCM_MemberRegMst_Fk')
                ->where('cmsad_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_memcompmst_fk' => null]])
                ->orderBy("CompanyName ASC")
                ->asArray()
                ->all();

        $data = [];
        foreach ($modelJsrs as $listData) {
            if ($listData['stkholderType'] == 6) {
                $data['Contractor']['list'][] = $listData;
                $data['Contractor']['name'] = 'Contractor';
            } else {
                $data['Operator/Buyer']['list'][] = $listData;
                $data['Operator/Buyer']['name'] = 'Operator/Buyer';
            }
        }
        $data = array_values($data);
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $data ? $data : [],
        );
        return $result;
    }

    public static function getCurrencyAward() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $modelCurrency = CmsawarddtlsTbl::find()
                ->select([ 'CurrencyMst_Pk as dataPK', 'CurM_CurrencyName_en as dataName', 'CurM_CurrSymbol as dataSymbol'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('currencymst_tbl', 'cmsch_currencymst_fk = CurrencyMst_Pk')
                ->where('cmsad_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract', array(':data' => 0, ':contract' => 1))
                ->andWhere(['not', ['cmsad_memcompmst_fk' => null]])
                ->orderBy("CurM_CurrencyName_en ASC")
                ->groupBy("CurrencyMst_Pk")
                ->asArray()
                ->all();
        $data = [];
        foreach ($modelCurrency as $listData) {
            if ($listData['dataPK'] != null) {
                $data[] = $listData;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $data ? $data : [],
        );
        return $result;
    }

    public static function getAwardsReceived() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $awardsReceived = CmsawarddtlsTbl::find()
                ->select([
                    "count(if(cmsch_type = 1, 1,null)) as 'coCount'", 
                    "count(if(cmsch_type = 3, 1,null)) as 'baCount'", 
                    "count(if(cmsch_type = 2, 1,null)) as 'poCount'", 
                    "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coValueOMR'",
                    
                    "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baValueOMR'",
                    
                    "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poValueOMR'",
                    ])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->where('cmsad_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract and cmsch_isdeleted = 2 and cmsch_contractstatus != 2', array(':data' => 0, ':contract' => 1))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $awardsReceived ? $awardsReceived : [],
        );
        return $result;
    }

    public static function getIssuedAward() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $issuedAward = CmsawarddtlsTbl::find()
                ->select([
                    "count(if(cmsch_type = 1, 1,null)) as 'coCount'",
                    "count(if(cmsch_type = 3, 1,null)) as 'baCount'",
                    "count(if(cmsch_type = 2, 1,null)) as 'poCount'",
                    "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coValueOMR'",                    
                    "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baValueOMR'",                    
                    "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poValueOMR'",
                    ])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->where('cmsch_memcompmst_fk=:compPK', array(':compPK' => $companypk))
                ->andWhere('cmsad_isdeactivated=:data and cmsad_isprimarycontractor=:contract and cmsch_createdon is not null', array(':data' => 0, ':contract' => 1))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $issuedAward ? $issuedAward : [],
        );
        return $result;
    }

    public static function getObligatedAwardsIssued() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $obligated = CmscontracthdrTbl::find()
                ->select([
                    "count(if(cmsch_type = 1 and cmsch_obligation = 1 , 1,null)) as 'coMSMECount'",
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coMSMEValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coMSMEValueOMR'",    
                    "count(if(cmsch_type = 1 and cmsch_obligation = 2 , 1,null)) as 'coLCCCount'",
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coLCCValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coLCCValueOMR'",  
                    "count(if(cmsch_type = 1 and cmsch_obligation = 3 , 1,null)) as 'coAllCount'", 
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'coAllValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 1 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'coAllValueOMR'",   
                    
                    "count(if(cmsch_type = 3 and cmsch_obligation = 1 , 1,null)) as 'baMSMECount'",
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baMSMEValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baMSMEValueOMR'",    
                    "count(if(cmsch_type = 3 and cmsch_obligation = 2 , 1,null)) as 'baLCCCount'",
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baLCCValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baLCCValueOMR'",  
                    "count(if(cmsch_type = 3 and cmsch_obligation = 3 , 1,null)) as 'baAllCount'", 
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'baAllValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 3 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'baAllValueOMR'",
                    
                    "count(if(cmsch_type = 2 and cmsch_obligation = 1 , 1,null)) as 'poMSMECount'", 
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poMSMEValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 1, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poMSMEValueOMR'",   
                    "count(if(cmsch_type = 2 and cmsch_obligation = 2 , 1,null)) as 'poLCCCount'", 
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poLCCValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 2, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poLCCValueOMR'",   
                    "count(if(cmsch_type = 2 and cmsch_obligation = 3 , 1,null)) as 'poAllCount'", 
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 3, cmsad_awardamt * 2.60080, cmsad_awardamt),0)),2) as 'poALLValueUSD'",
                    "ROUND(SUM(if(cmsch_type = 2 and cmsch_obligation = 3, IF(cmsch_currencymst_fk = 21, cmsad_awardamt / 2.60080, cmsad_awardamt),0)),3) as 'poALLValueOMR'"])
                ->leftJoin('cmsawarddtls_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->where('cmsch_memcompmst_fk=:pk and cmsad_isprimarycontractor = 1 and cmsad_isdeactivated=0 and cmsch_createdon is not null and cmsch_obligation in (1,2,3) and cmsch_isdeleted = 2 and cmsch_contractstatus != 2', array(':pk' => $companypk))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $obligated ? $obligated : [],
        );
        return $result;
    }

    public static function getObligatedEnquiriesIssued() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $obligated = CmsrequisitionformdtlsTbl::find()
                ->select(["count(if(crfd_rqclassification = 1 , 1,null)) as 'MSMECount'", "count(if(crfd_rqclassification = 2 , 1,null)) as 'LCCCount'", "count(if(crfd_rqclassification = 3 , 1,null)) as 'AllCount'", "count(if(crfd_rqclassification = 4 , 1,null)) as 'otherCount'"])
                ->where('crfd_memcompmst_fk=:pk', array(':pk' => $companypk))
                ->asArray()
                ->one();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $obligated ? $obligated : [],
        );
        return $result;
    }

    public function getcontractfeesapproval($formdata) {
//        ,' mcpid.mcpid_pymtstatus as pymtsts',' mcpid.mcpid_submittedon as submton',' mcpid.mcpid_transdate as pymtdate',' mcpid.mcpid_transuniqueid as tranuniqueid',' mcpid.memcomppymtinfodtls_pk as pymtid'
        $query = CmsawarddtlsTbl::find();
        $query->select(['MCM_SupplierCode as suppliercode', 'MCM_CompanyName as jsrsCompanyName', 'cnjsm_orgname as nonJsrsCompanyName',
            'cmsch_contracttitle as contTitle', 'mcid_generatedon as invoicedate', 'cmsch_contractvalue as contractvalue',
            'crfd_rqprocesstype as tendertype', 'MCM_Origin as jsrsOrigin', 'cmsnjsd_countrymst_fk as nonJsrsOrigin', 'cmsawarddtls_pk as awdpk',
            'memcompinvoicedtls_pk as invopk', 'cmscontracthdr_pk as contactpk', 'mcpid.mcpid_pymtstatus as pymtsts', 'mcpid.mcpid_submittedon as submton',
            'mcpid.mcpid_transdate as pymtdate', 'mcpid.mcpid_transrefno as tranuniqueid', 'mcpid.memcomppymtinfodtls_pk as pymtid',
            'mcid_invoiceamount', 'mcid_vatamount', 'mcpid.mcpid_addchrgs', 'mcpid.mcpid_paymenttype']);
        $query->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = cmsad_memcompmst_fk');
        $query->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk');
        $query->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk');
        $query->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk');
        $query->innerJoin('memcompinvoicedtls_tbl', 'mcid_shared_fk = cmscontracthdr_pk  and mcid_basemodulemst_fk = 131');
        $query->leftJoin('memcomppymtinfodtls_tbl as mcpid', 'mcpid.mcpid_memcompinvoicedtls_fk = memcompinvoicedtls_pk');
        $query->leftJoin('memcomppymtinfodtls_tbl as mcpid_d', 'mcpid.mcpid_memcompinvoicedtls_fk = mcpid_d.mcpid_memcompinvoicedtls_fk 
        and mcpid.memcomppymtinfodtls_pk  < mcpid_d.memcomppymtinfodtls_pk');
        $query->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk');
        $query->where("cmsad_isprimarycontractor=:isprim and mcpid_d.memcomppymtinfodtls_pk is null", [':isprim' => 1]);
        if (!empty($formdata['fdata']['searchkey']) && !empty($formdata['fdata']['searchvalue']) && $formdata['fdata']['searchkey'] == 'suppliercode') {
            $query->andWhere(['like', 'MCM_SupplierCode', $formdata['fdata']['searchvalue']]);
        }
        if (!empty($formdata['fdata']['searchkey']) && !empty($formdata['fdata']['searchvalue']) && $formdata['fdata']['searchkey'] == 'companyname') {
            $query->andWhere(['like', 'MCM_CompanyName', $formdata['fdata']['searchvalue']]);
        }
        if (!empty($formdata['fdata']['searchkey']) && !empty($formdata['fdata']['searchvalue']) && $formdata['fdata']['searchkey'] == 'registrationno') {
            $query->andWhere(['like', 'mcm_RegistrationNo', $formdata['fdata']['searchvalue']]);
        }
        $query->asArray();
        $size = (!empty($_REQUEST['size']) && $_REQUEST['size'] != 'undefined') ? $_REQUEST['size'] : 10;
        $pageno = (!empty($_REQUEST['page']) && $_REQUEST['page'] != 'undefined') ? $_REQUEST['page'] : 0;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $size,
                'page' => $pageno
            ]
        ]);
        $data = $provider->getModels();
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $size;
        return $response;
    }

    public function formatsucessfeesapproval($fessquerry) {
        $successfessarr = [];
        if (count($fessquerry) > 0) {
            // \common\components\Security::encrypt
            $encryptObj = new Security();
            $tendertypearr = [1 => 'Direct Award', 2 => 'Offline Tendering', 3 => 'Online Tendering', 4 => 'Single Source'];
            //$OMR = 2.60080;
            $OMR = Yii::$app->params['omr_currency_convert_amt_for_usd'];
            $currentdate = date('Y-m-d');
            //1 - New, 2 - Payment Inprogress, 3 - Approved, 4 - Declined, 5 - Refunded, 6 - Failed, 7 - Cancelled, 8 -Others
            // $paymtstsarr = [1 => 'Yet to validate', 2 => 'Payment In-progress', 3 => 'Approved', 4 => 'Declined', 5 => 'Refunded', 6 => 'Payment Pending', 7 => 'Payment Pending',8=>'Payment Pending'];
            $paymtstsarr = [
                0 => 'Payment Pending',
                1 => 'Yet to validate',
                2 => 'Payment In-progress',
                3 => 'Approved',
                4 => 'Declined',
                5 => 'Refunded',
                6 => 'Failed',
                7 => 'Cancelled',
                8 => 'Others'
            ];
            // $paymtclassarr = [1 => 'paymentpending', 2 => 'paymentingprogresscolor', 3 => 'active', 4 => 'declined', 5 => 'declined', 6 => 'declined', 7 => 'declined',8=>'declined'];
            $paymtclassarr = [
                0 => 'paymentpending',
                1 => 'verficationpending',
                2 => 'paymentingprogress',
                3 => 'Approved',
                4 => 'declined',
                5 => 'refund',
                6 => 'declined',
                7 => 'cancelled',
                8 => 'others'
            ];
            foreach ($fessquerry as $key => $value) {
//                $totalamount = (1 / 100) * $value['invamt'];
//                $totalOMRamount = ($totalamount / $OMR);
//                $Omramount = round($totalOMRamount, 3, PHP_ROUND_HALF_UP);
//                if ($Omramount < 50) {
//                    $Omramount = 50;
//                } else if ($Omramount > 500) {
//                    $Omramount = 500;
//                }
                $invoice_amt_omr = !empty($value['mcid_invoiceamount']) ? $value['mcid_invoiceamount'] : 0;
                $vat_amt = !empty($value['mcid_vatamount']) ? $value['mcid_vatamount'] : 0;
                $addi_charge = !empty($value['mcpid_addchrgs']) ? $value['mcpid_addchrgs'] : 0;
                //$roundedValue = $Omramount;
                $invoice_amt_usd = '0.00';
                if ($value['jsrsOrigin'] == 'I') {
                    //$invoice_amt_usd = Common::getusdbyomr($invoice_amt_omr);
                    $invoice_amt_usd = number_format($invoice_amt_omr,2, '.', '');
                }
                $date1 = date_create($value['invoicedate']);
                $date2 = date_create($currentdate);
                $diff = date_diff($date1, $date2);
                $age = $diff->format("%a days");

                $showupdatebtn = 1;
                if (in_array($value['pymtsts'], [0, 3, 4, 5, 6, 7, 8])) {
                    $showupdatebtn = 2;
                }

                $successfessarr[$key]['suppliercode'] = !empty($value['suppliercode']) ? $value['suppliercode'] : 'NIL';
                $successfessarr[$key]['organisationname'] = !empty($value['jsrsCompanyName']) ? $value['jsrsCompanyName'] : $value['nonJsrsCompanyName'];
                $successfessarr[$key]['contract'] = $value['contTitle'];
                $successfessarr[$key]['currency'] = ($value['jsrsOrigin'] == 'I') ? 'USD' : 'OMR';
                $successfessarr[$key]['jsrsOrigin'] = $value['jsrsOrigin'];
                $successfessarr[$key]['contractsucessfee_omr'] = $invoice_amt_omr;
                $successfessarr[$key]['contractsucessfee_usd'] = $invoice_amt_usd;
                $successfessarr[$key]['invoice_withvat'] = $invoice_amt + $vat_amt;
                $successfessarr[$key]['total_paidamount'] = $invoice_amt + $vat_amt + $addi_charge;
                $successfessarr[$key]['tenderprocess'] = $tendertypearr[$value['tendertype']];
                $successfessarr[$key]['invoicegenerted'] = !empty($value['invoicedate']) ? date('d-m-Y', strtotime($value['invoicedate'])) : '-';
                $successfessarr[$key]['submittedon'] = !empty($value['submton']) ? date('d-m-Y', strtotime($value['submton'])) : '-';
                $successfessarr[$key]['invoiceagedays'] = $age;
                $successfessarr[$key]['paymentstsval'] = $value['pymtsts'];
                $successfessarr[$key]['showupdatebtn'] = $showupdatebtn;
                $successfessarr[$key]['paymentstatus'] = !empty($value['pymtsts']) ? $paymtstsarr[$value['pymtsts']] : $paymtstsarr[0];
                $successfessarr[$key]['paymtclass'] = !empty($value['pymtsts']) ? $paymtclassarr[$value['pymtsts']] : $paymtclassarr[0];
                $successfessarr[$key]['awdid'] = $encryptObj->encrypt($value['awdpk']);
                $successfessarr[$key]['contactpk'] = $encryptObj->encrypt($value['contactpk']);
                $successfessarr[$key]['pymtid'] = $encryptObj->encrypt($value['pymtid']);
                $successfessarr[$key]['pymtdate'] = !empty($value['pymtdate']) ? date('d-m-Y', strtotime($value['pymtdate'])) : '-';
                $successfessarr[$key]['tranuniqueid'] = !empty($value['tranuniqueid']) ? $value['tranuniqueid'] : '-';
            }
        }
        return $successfessarr;
    }

    public function getcontractsuccessfessview($awasrdpk) {
        $paymtdetarr = [];
        $successfessarr = [];
        $fessquerry = CmsawarddtlsTbl::find()
                ->select([ 'compTo.MCM_SupplierCode as suppliercode', 'compBy.MCM_CompanyName as awardedby', 'compTo.MCM_MemberRegMst_Fk as regpk',
                    'compTo.MCM_CompanyName as jsrsCompanyName', 'mcid_invoicepath as invpath', 'memcompinvoicedtls_tbl.mcid_membercompmst_fk as incompk',
                    'cnjsm_orgname as nonJsrsCompanyName', 'cmsch_contractrefno as contref', 'cmsch_contracttitle as contTitle', 'cmsch_obligation as obligation',
                    'mcid_generatedon as invoicedate', 'cmsch_contractvalue as contractval', 'crfd_rqprocesstype as tendertype', 'compTo.MCM_Origin as jsrsOrigin',
                    'cmsnjsd_countrymst_fk as nonJsrsOrigin', 'memcompinvoicedtls_pk as invopk', 'cmscontracthdr_pk as contactpk', 'mcid_invoiceamount as invamt','cmscontracthdr_pk','cmsch_type'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk')
                ->leftJoin('membercompanymst_tbl as compTo', 'compTo.MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('membercompanymst_tbl as compBy', 'compBy.MemberCompMst_Pk=cmsch_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk = cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                ->leftJoin('memcompinvoicedtls_tbl', 'mcid_shared_fk = cmscontracthdr_pk and  mcid_basemodulemst_fk = 131')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                ->where("cmsad_isprimarycontractor=:isprim and cmsawarddtls_pk=:awardpk", [':isprim' => 1, ':awardpk' => $awasrdpk])
                ->asArray()
                ->one();
        if (!empty($fessquerry)) {
            $registerId = $fessquerry['regpk'];
            $userData = \common\models\UsermstTbl::getCompanyUser($registerId);
            $userPk = $userData['UserMst_Pk'];
            if (!empty($fessquerry['jsrsOrigin'])) {
                $Origin = $fessquerry['jsrsOrigin'];
            } elseif (!empty($fessquerry['nonJsrsOrigin'])) {
                $Origin = $fessquerry['nonJsrsOrigin'] == 31 ? 'N' : 'I';
            }
            if ($Origin == 'N') {
                $contractvalusd = Common::getusdbyomr($fessquerry['contractval']);
                $contractvalomr = number_format($fessquerry['contractval'],3, '.', '');
            } else {
                $contractvalusd = number_format($fessquerry['contractval'],2, '.', '');
                $contractvalomr = Common::getomrbyusd($fessquerry['contractval']);
            }
            if (!empty($fessquerry['invpath']) && !empty($fessquerry['incompk'])) {
                $dataName = \common\components\Security::encrypt($fessquerry['invpath']);
                $compPK = \common\components\Security::encrypt($fessquerry['incompk']);
                $viewlink = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadinvoice?dataVal=' . $dataName . '&cpk=' . $compPK]);
            } else {
                $viewlink = '';
            }
            $inamt = $fessquerry['invamt'];
            if ($Origin == 'N') {
                $successfees = $inamt;
            } else {
                $successfees = number_format($inamt,2, '.', '');
                //$successfees = Common::getusdbyomr($inamt);
            }
            $tendertypearr = [1 => 'Direct Award', 2 => 'Offline Tendering', 3 => 'Online Tendering', 4 => 'Single Source'];
            $awardtypearr = [1 => 'General Contract', 2 => 'Purchase Order', 3 => 'Blanket Agreement'];
            $obligtypearr = [1 => 'MSME', 2 => 'LCC', 3 => 'MSME & LCC', 4 => 'Others', 5 => 'Not Applicable'];
            $successfessarr['suppliercode'] = !empty($fessquerry['suppliercode']) ? $fessquerry['suppliercode'] : 'NIL';
            $successfessarr['Companyname'] = !empty($fessquerry['jsrsCompanyName']) ? $fessquerry['jsrsCompanyName'] : $fessquerry['nonJsrsCompanyName'];
            $successfessarr['awardedby'] = $fessquerry['awardedby'];
            $successfessarr['contractPk'] = \common\components\Security::encrypt($fessquerry['cmscontracthdr_pk']);
            $successfessarr['Contracttitle'] = $fessquerry['contTitle'];
            $successfessarr['Contractrefno'] = $fessquerry['contref'];
            $successfessarr['obligationtype'] = $obligtypearr[$fessquerry['obligation']];
            $successfessarr['tendertype'] = $tendertypearr[$fessquerry['tendertype']];
            $successfessarr['awardtype'] = $awardtypearr[$fessquerry['cmsch_type']];
            $successfessarr['contractvalusd'] = $contractvalusd;
            $successfessarr['currency'] = ($Origin == 'I') ? 'USD' : 'OMR';
            $successfessarr['invoice'] = $viewlink;
            $successfessarr['contractvalomr'] = $contractvalomr;
            $successfessarr['successfees'] = $successfees;
            if (!empty($fessquerry['invopk'])) {
                $paymtdetails = \common\models\MemcomppymtinfodtlsTbl::find()
                                ->select("mcpid_pymtmode,mcpid_transrefno,mcpid_bankname,mcpid_transdate,mcpid_pymtproof,mcpid_pymtstatus,mcpid_comment ,mcpr_createdon,memcomppymtrcptdtls_pk,mcpid_apprcomments,mcpid_approvedon,mcpid_approvedby,memcomppymtinfodtls_pk")
                                ->leftJoin('memcomppymtrcptdtls_tbl', 'mcpr_memcomppymtinfodtls_fk = memcomppymtinfodtls_pk')
                                ->where("mcpid_memcompinvoicedtls_fk=:invpk ", [':invpk' => $fessquerry['invopk']])
                                ->orderBy(['memcomppymtrcptdtls_pk' => SORT_DESC,'memcomppymtinfodtls_pk'=>SORT_DESC])
                                ->asArray()->one();
                if (!empty($paymtdetails)) {
                    $paymodearr = [1 => 'Bank Transfer', 2 => 'Cheque or Cash Deposit'];
                    $paymtdetarr['paymentmode'] = $paymodearr[$paymtdetails['mcpid_pymtmode']];
                    $paymtdetarr['paymentPk'] = \common\components\Security::encrypt($paymtdetails['memcomppymtinfodtls_pk']);
                    $paymtdetarr['chequeno'] = $paymtdetails['mcpid_transrefno'];
                    $paymtdetarr['bankname'] = $paymtdetails['mcpid_bankname'];
                    $paymtdetarr['dateofpayment'] = !empty($paymtdetails['mcpid_transdate']) ? date('d-m-Y', strtotime($paymtdetails['mcpid_transdate'])) : '-';
                    $paymtdetarr['currency'] = ($Origin == 'I') ? 'USD' : 'OMR';
                    $paymtdetarr['successfees'] = $successfees;
                    $paymtdetarr['invoice'] = $viewlink;
                    if (!empty($paymtdetails['mcpid_pymtproof'])) {
                        $paymtdetarr['paymentproof'] = \common\components\Drive::generateUrl($paymtdetails['mcpid_pymtproof'], $fessquerry['incompk'], $registerId);
                        $paymtdetarr['filetype'] = \common\models\MemcompfiledtlsTbl::getFileTypeByPk($paymtdetails['mcpid_pymtproof']);
                    } else {
                        $paymtdetarr['paymentproof'] = "";
                        $paymtdetarr['filetype'] = "";
                    }
                    $paymtstsarr = [1 => 'Payment Pending', 2 => 'Payment Inprogress', 3 => 'Approved', 4 => 'Declined', 5 => 'Refunded', 6 => 'Failed', 7 => 'Cancelled'];
                    $paymtdetarr['pymtsts'] = $paymtdetails['mcpid_pymtstatus'];
                    if (in_array($paymtdetails['mcpid_pymtstatus'], [3, 4])) {
                        $paymtdetarr['isshowapprovdet'] = 1;
                        $paymtdetarr['pymtstatus'] = $paymtstsarr[$paymtdetails['mcpid_pymtstatus']];
                        $paymtdetarr['pymtstatusid'] = $paymtdetails['mcpid_pymtstatus'];
                        $paymtdetarr['pymtcmts'] = !empty($paymtdetails['mcpid_apprcomments']) ? $paymtdetails['mcpid_apprcomments'] : "";
                        $paymtdetarr['approveDeclineDate'] = !empty($paymtdetails['mcpid_approvedon']) ? date('d-m-Y', strtotime($paymtdetails['mcpid_approvedon'])) : '-';
                    } else {
                        $paymtdetarr['isshowapprovdet'] = 2;
                        $paymtdetarr['pymtstatus'] = "";
                        $paymtdetarr['pymtstatusid'] = "";
                        $paymtdetarr['pymtcmts'] = "";
                    }
                    $paymtdetarr['recptissedon'] = !empty($paymtdetails['mcpr_createdon']) ? date('d-m-Y', strtotime($paymtdetails['mcpr_createdon'])) : '-';
                    if (!empty($paymtdetails['memcomppymtrcptdtls_pk'])) {
                        $paymtdetarr['paymentreceipt'] = \Yii::$app->urlManager->createAbsoluteUrl(['/pms/pms/downloadreceipt?cpk=' . $fessquerry['incompk'] . '&rpk=' . $paymtdetails['memcomppymtrcptdtls_pk']]);
                    }
                }
            }
        }
        return ['successfessarr' => $successfessarr, 'paymtdetarr' => $paymtdetarr];
    }

    public static function cmsawardToQueryCache() {
        return CmsawarddtlsTbl::find()
                        ->select(['max(cmsad_updatedon), count(*)'])
                        ->createCommand()
                        ->getRawSql();
    }

}
