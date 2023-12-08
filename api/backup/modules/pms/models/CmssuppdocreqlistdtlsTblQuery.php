<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssuppdocreqlistdtlsTbl]].
 *
 * @see CmssuppdocreqlistdtlsTbl
 */
class CmssuppdocreqlistdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function autoCreatDocument($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $model = new CmssuppdocreqlistdtlsTbl;
            $model->csdrld_createdon = $date;
            $model->csdrld_createdby = $userPK;
            $model->csdrld_createdbyipaddr = $ip_address;
            $model->csdrld_cmssuppdocreqlisthdr_fk = $headerPk;
            $model->csdrld_status = 1;
            $model->csdrld_cmssdrldoccat_fk = $formdata['csdrld_cmssdrldoccat_fk'];
            $model->csdrld_submittaltype = $formdata['csdrld_submittaltype'];
            $model->csdrld_submittalqty = $formdata['csdrld_submittalqty'];
            $model->csdrld_interval = $formdata['csdrld_interval'];
            $model->csdrld_intervaltype = $formdata['csdrld_intervaltype'];
            $model->csdrld_reviewclass = $formdata['csdrld_reviewclass'];
            $model->csdrld_remarks = $formdata['csdrld_remarks'];
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
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

    public function submitSupplierDocument($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            if (!empty($formdata['dtlsPk']) && $formdata['dtlsPk'] != null) {
                $model = CmssuppdocreqlistdtlsTbl::find()->where("cmssuppdocreqlistdtls_pk =:pk and csdrld_cmssuppdocreqlisthdr_fk = :headerPk", [':pk' => $formdata['dtlsPk'], ':headerPk' => $headerPk])->one();
                $flag = 'U';
                $comments = 'updated successfully!';
                $model->csdrld_updatedon = $date;
                $model->csdrld_updatedby = $userPK;
                $model->csdrld_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmssuppdocreqlistdtlsTbl;
                $flag = 'C';
                $comments = 'created successfully!';
                $model->csdrld_createdon = $date;
                $model->csdrld_createdby = $userPK;
                $model->csdrld_createdbyipaddr = $ip_address;
                $model->csdrld_cmssuppdocreqlisthdr_fk = $headerPk;
                $model->csdrld_status = 1;
            }
            if (!empty($formdata['catPk']) && $formdata['catPk'] != null) {
                $catSave = CmssdrldoccatTbl::find()->where("cmssdrldoccat_pk =:pk", [':pk' => $formdata['catPk']])->one();
                if ($catSave->csdrldc_docdesc != $formdata['description']) {
                    $catSave->csdrldc_docdesc = $formdata['description'];
                    $catSave->save();
                }
                $model->csdrld_cmssdrldoccat_fk = $formdata['catPk'];
            } else {
                $model->csdrld_cmssdrldoccat_fk = CmssdrldoccatTblQuery::newDocumentCatSave($formdata);
            }
            $model->csdrld_submittaltype = $formdata['subType'];
            $model->csdrld_submittalqty = $formdata['subQuantity'];
            $model->csdrld_interval = $formdata['reqinterval'];
            $model->csdrld_intervaltype = $formdata['reqintervaltype'];
            $model->csdrld_reviewclass = $formdata['reviewClass'];
            $model->csdrld_remarks = $formdata['remarks'];
            if ($model->save() === TRUE) {
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

    public function deleteSupplierDocumentData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmssuppdocreqlistdtlsTbl::find()->where("cmssuppdocreqlistdtls_pk =:pk", [':pk' => $dataPk])->one();
            $model->csdrld_status = 2;
            if ($model->save() === TRUE) {
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

}
