<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsnonjsrssupmapTbl]].
 *
 * @see CmsnonjsrssupmapTbl
 */
class CmsnonjsrssupmapTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupmapTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupmapTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public static function creatNonJSRSMap($formdata, $nonJSRSPK) {
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $cmsNonJSRSMap = new CmsnonjsrssupmapTbl;
        $cmsNonJSRSMap->cnjsm_cmsnonjsrssupdtls_fk = $nonJSRSPK;
        $cmsNonJSRSMap->cnjsm_orgname = $formdata['companyname'];
        $cmsNonJSRSMap->cnjsm_reason = $formdata['reasonAwarding'];
        $cmsNonJSRSMap->cnjsm_compemail = $formdata['compEmail'];
        $cmsNonJSRSMap->cnjsm_contperson = $formdata['contactName'];
        $cmsNonJSRSMap->cnjsm_designation = $formdata['contactDesignation'];
        $cmsNonJSRSMap->cnjsm_contactemail = $formdata['contactEmail'];
        $cmsNonJSRSMap->cnjsm_contactmobilecc = $formdata['mobile_cc'];
        $cmsNonJSRSMap->cnjsm_contactmobile = $formdata['mobileNo'];
        $cmsNonJSRSMap->cnjsm_address = $formdata['address'];
        $cmsNonJSRSMap->cnjsm_classification = $formdata['country'] == 31 ? $formdata['classification'] : 5;
        $cmsNonJSRSMap->cnjsm_specialstatus = $formdata['specialStatus'];
        $cmsNonJSRSMap->cnjsm_incorpstylemst_fk = $formdata['incorporationStyle'] != 'Others' ? $formdata['incorporationStyle'] : null;
        $cmsNonJSRSMap->cnjsm_incorpstyle = $formdata['incorporationStyleOthere'];
        $cmsNonJSRSMap->cnjsm_createdon = $date;
        $cmsNonJSRSMap->cnjsm_createdby = $userPK;
        $cmsNonJSRSMap->cnjsm_createdbyipaddr = $ip_address;
        if ($cmsNonJSRSMap->save()) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'Supplier Created Successfully!',
                'mapPk' => $cmsNonJSRSMap->cmsnonjsrssupmap_pk,
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $cmsNonJSRSMap->getErrors()
            );
        }
        return $result;
    }

    public static function getNonJsrsSupplierData($supplierPk) {
        $model = CmsnonjsrssupmapTbl::find()
                        ->select(['cnjsm_orgname as companyName', 'CyM_CountryName_en as countryName', 'cmsnjsd_countrymst_fk as countryPk', 'cnjsm_classification as classificatinType', 'cmsnonjsrssupmap_pk as dataPk', 'cmsnjsd_crregno as crNumber', 'cnjsm_contperson', 'cnjsm_contactemail', 'cnjsm_designation', 'ISM_IncorpStyleBrief as incorpStyle', 'cnjsm_incorpstyle as incorpStyleContent', 'cnjsm_specialstatus as specialstatus', 'cnjsm_reason'])
                        ->leftJoin('cmsnonjsrssupdtls_tbl', 'cmsnonjsrssupdtls_pk=cnjsm_cmsnonjsrssupdtls_fk')
                        ->leftJoin('countrymst_tbl', 'CountryMst_Pk=cmsnjsd_countrymst_fk')
                        ->leftJoin('incorpstylemst_tbl', 'IncorpStyleMst_Pk = cnjsm_incorpstylemst_fk')
                        ->where('cmsnonjsrssupmap_pk=:fk', [':fk' => $supplierPk])
                        ->asArray()->one();
        $model['cnjsm_reason'] = strip_tags($model['cnjsm_reason']);
        $model['imgUrl'] = 'assets/images/lypis_noimg.svg';
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model ? $model : [],
        );
        return $result;
    }

}
