<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmssuppdocreqlistdtlstempTbl]].
 *
 * @see CmssuppdocreqlistdtlstempTbl
 */
class CmssuppdocreqlistdtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssuppdocreqlistdtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function submitSupplierDocumenttemp($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            if (!empty($formdata['dtlsPk']) && $formdata['dtlsPk'] != null) {
                $model = CmssuppdocreqlistdtlstempTbl::find()->where("cmssuppdocreqlistdtlstemp_pk =:pk and csdrldt_cmssuppdocreqlisthdrtemp_fk = :headerPk", [':pk' => $formdata['dtlsPk'], ':headerPk' => $headerPk])->one();
                $flag = 'U';
                // csdrldc_cmssdrldoccattemp_fk
                $comments = 'updated successfully!';
                $model->csdrldt_updatedon = $date;
                $model->csdrldt_updatedby = $userPK;
                $model->csdrldt_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmssuppdocreqlistdtlstempTbl;
                $flag = 'C';
                $comments = 'created successfully!';
                $model->csdrldt_createdon = $date;
                $model->csdrldt_createdby = $userPK;
                $model->csdrldt_createdbyipaddr = $ip_address;
                $model->csdrldt_cmssuppdocreqlisthdrtemp_fk = $headerPk;
                $model->csdrldt_status = 1;
            }
            if (!empty($formdata['catPk']) && $formdata['catPk'] != null) {
                $catSave = CmssdrldoccattempTbl::find()->where("cmssdrldoccattemp_pk =:pk", [':pk' => $formdata['catPk']])->one();
                if ($catSave->csdrldct_docdesc != $formdata['description'] && $catSave != null) {
                    $catSave->csdrldct_docdesc = $formdata['description'];
                    $catSave->save();
                }
                $model->csdrldt_cmssdrldoccat_fk = $formdata['catPk'];
            } else {
                $model->csdrldt_cmssdrldoccat_fk = CmssdrldoccattempTblQuery::newDocumentCatSave($formdata);
            }
            $model->csdrldt_submittaltype = $formdata['subType'];
            $model->csdrldt_submittalqty = $formdata['subQuantity'];
            $model->csdrldt_interval = $formdata['reqinterval'];
            $model->csdrldt_intervaltype = $formdata['reqintervaltype'];
            $model->csdrldt_reviewclass = $formdata['reviewClass'];
            $model->csdrldt_remarks = $formdata['remarks'];
            if ($model->save() === TRUE) {
                if($formdata['formType']==2){
                    \api\modules\pms\models\CmstenderhdrtempTblQuery::isUpdate('common',$formdata);
                }
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
            $model = CmssuppdocreqlistdtlstempTbl::find()->where("cmssuppdocreqlistdtlstemp_pk =:pk", [':pk' => $dataPk])->one();
            $model->csdrldt_status = 2;
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

    public function autoCreatDocument($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            $model = new CmssuppdocreqlistdtlstempTbl;
            $model->csdrldt_createdon = $date;
            $model->csdrldt_createdby = $userPK;
            $model->csdrldt_createdbyipaddr = $ip_address;
            $model->csdrldt_cmssuppdocreqlisthdr_fk = $headerPk;
            $model->csdrldt_status = 1;
            $model->csdrldt_cmssdrldoccat_fk = $formdata['csdrldt_cmssdrldoccat_fk'];
            $model->csdrldt_submittaltype = $formdata['csdrldt_submittaltype'];
            $model->csdrldt_submittalqty = $formdata['csdrldt_submittalqty'];
            $model->csdrldt_interval = $formdata['csdrldt_interval'];
            $model->csdrldt_intervaltype = $formdata['csdrldt_intervaltype'];
            $model->csdrldt_reviewclass = $formdata['csdrldt_reviewclass'];
            $model->csdrldt_remarks = $formdata['csdrldt_remarks'];
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
}
