<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsnonjsrssupdtlsTbl]].
 *
 * @see CmsnonjsrssupdtlsTbl
 */
class CmsnonjsrssupdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsnonjsrssupdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function submitSupplierForm($formdata) {
        if (!empty($formdata)) {
            $compPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            if ((!empty($formdata['crNumber']) && $formdata['crNumber'] != null) && (!empty($formdata['country']) && $formdata['country'] != null)) {
                $memCompMst = \api\modules\mst\models\MembercompanymstTbl::find()
                        ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                        ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk = MemberRegMst_Pk')
                        ->where("MCM_crnumber = :crNumber and MCM_CountryMst_Fk = :country", [':crNumber' => $formdata['crNumber'], ':country' => $formdata['country']])
                        ->andWhere('MRM_MemberStatus=:status and MemberCompMst_Pk != :comPk and MRM_ValSubStatus = :valSubStatus', [':status' => 'A', ':comPk' => $compPk, ':valSubStatus' => 'A'])
                        ->andWhere('date(MCAAH_ExpiryDate) >= CURDATE()')
                        ->one();
                if (empty($memCompMst)) {
                    $memCompMstExpired = \api\modules\mst\models\MembercompanymstTbl::find()
                            ->leftJoin('memberregistrationmst_tbl', 'MCM_MemberRegMst_Fk = MemberRegMst_Pk')
                            ->leftJoin('memcompaccactvnhstry_tbl', 'mcaah_memberregmst_fk = MemberRegMst_Pk')
                            ->where("MCM_crnumber = :crNumber and MCM_CountryMst_Fk = :country", [':crNumber' => $formdata['crNumber'], ':country' => $formdata['country']])
                            ->andWhere(['IN', 'MRM_MemberStatus', 'I,V'])
                            ->andWhere('date(MCAAH_ExpiryDate) < CURDATE()')
                            ->one();
                    if (!empty($memCompMstExpired)) {
                        $nonjsrssupdtls = CmsnonjsrssupdtlsTbl::find()
                                        ->where("cmsnjsd_crregno = :crNumber and cmsnjsd_countrymst_fk = :country", [':crNumber' => $formdata['crNumber'], ':country' => $formdata['country']])->one();
                        if (!empty($nonjsrssupdtls)) {
                            $result = CmsnonjsrssupmapTblQuery::creatNonJSRSMap($formdata, $nonjsrssupdtls->cmsnonjsrssupdtls_pk);
                        } else {
                            $result = self::creatNonJSRSSupplierDtls($formdata, $memCompMstExpired->MCM_MemberRegMst_Fk);
                        }
                    } else {
                        $nonjsrssupdtls = CmsnonjsrssupdtlsTbl::find()
                                        ->where("cmsnjsd_crregno = :crNumber and cmsnjsd_countrymst_fk = :country", [':crNumber' => $formdata['crNumber'], ':country' => $formdata['country']])->one();
                        if (empty($nonjsrssupdtls)) {
                            $result = self::creatNonJSRSSupplierDtls($formdata, 0);
                        } else {
                            $result = CmsnonjsrssupmapTblQuery::creatNonJSRSMap($formdata, $nonjsrssupdtls->cmsnonjsrssupdtls_pk);
                        }
                    }
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Same company details already exist',
                    );
                }
            }
            return $result;
        }
    }

    public static function creatNonJSRSSupplierDtls($formdata, $regPK) {
        $cmsNonJSRSDtls = new CmsnonjsrssupdtlsTbl;
        $cmsNonJSRSDtls->cmsnjsd_crregno = $formdata['crNumber'];
        $cmsNonJSRSDtls->cmsnjsd_countrymst_fk = $formdata['country'];
        $cmsNonJSRSDtls->cmsnjsd_memberregmst_fk = $regPK;
        if ($cmsNonJSRSDtls->save()) {
            $result = CmsnonjsrssupmapTblQuery::creatNonJSRSMap($formdata, $cmsNonJSRSDtls->cmsnonjsrssupdtls_pk);
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $cmsNonJSRSDtls->getErrors()
            );
        }
        return $result;
    }

}
