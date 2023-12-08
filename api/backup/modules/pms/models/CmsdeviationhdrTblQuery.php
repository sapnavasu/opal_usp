<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use api\modules\pms\models\CmsdeviationhdrTbl;
use api\modules\pms\models\CmsquotationhdrTbl;

/**
 * This is the ActiveQuery class for [[CmsdeviationhdrTbl]].
 *
 * @see CmsdeviationhdrTbl
 */
class CmsdeviationhdrTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsdeviationhdrTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsdeviationhdrTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * Save deviation 
     */
    public function saveDeviation($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $currentPk = $data['currentPk'];
            foreach ($data['paymentTerms'] as $key => $dataVal) {
                if (!empty($dataVal['ptPk']) && $dataVal['ptPk'] != null) {
                    $deviationModel = CmsdeviationhdrTbl::find()->where("cmsdeviationhdr_pk =:pk", [':pk' => $dataVal['ptPk']])->one();
                    $deviationModel->cmsdh_updatedon = $date;
                    $deviationModel->cmsdh_updatedby = $userPK;
                    $deviationModel->cmsdh_updatedbyipaddr = $ip_address;
                } else {
                    $deviationModel = new CmsdeviationhdrTbl();
                    $deviationModel->cmsdh_createdon = $date;
                    $deviationModel->cmsdh_createdby = $userPK;
                    $deviationModel->cmsdh_createdbyipaddr = $ip_address;
                }
                $deviationModel->cmsdh_shared_fk = $currentPk;
                $deviationModel->cmsdh_shared_type = 1;
                $deviationModel->cmsdh_itemno = $dataVal['productName'];
                $deviationModel->cmsdh_currequirement = $dataVal['current_requirement'];
                $deviationModel->cmsdh_requestdeviation = $dataVal['requirement_deviation'];
                $deviationModel->cmsdh_reasondeviation = $dataVal['reason_deviation'];
                if ($deviationModel->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'C',
                        'comments' => 'Deviation added Successfully!',
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $deviationModel->getErrors()
                    );
                    return $result;
                }
            }
            $deviationCommentModel = \api\modules\quot\models\CmsquotationhdrTbl::find()->where("cmsquotationhdr_pk =:pk", [':pk' => $currentPk])->one();
            $deviationCommentModel->cmsqh_deviationcomment = $data['comments'];
            if ($deviationCommentModel->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'C',
                    'comments' => 'Deviation added Successfully!',
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $deviationCommentModel->getErrors()
                );
            }
        }
        return $result;
    }

    /**
     * get by shared Fk
     */
    public function findBySharedFk($dataPk, $dataType) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );

        if ($dataPk) {
            $data = CmsdeviationhdrTbl::find()
                    ->select(['cmsdeviationhdr_pk', 'cmsdh_itemno', 'cmsdh_currequirement', 'cmsdh_requestdeviation', 'cmsdh_reasondeviation', 'cmsdh_shared_fk','prdm_productcode', 'prdm_productname','MCPrD_DisplayName', 'MCSvD_DisplayName','SrvM_ServiceCode', 'SrvM_ServiceName','crpsd_type'])
                    ->leftJoin('cmstenderpsmap_tbl', 'cmstenderpsmap_pk = cmsdh_itemno')
                    ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                    ->where('cmsdh_shared_fk=:dataPk and cmsdh_shared_type = :dataType', [':dataPk' => $dataPk, ':dataType' => $dataType])
                    ->asArray()
                    ->all();

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    /**
     * update deviation 
     */
    public function updateDeviation($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            foreach ($data['formData']['records'] as $key => $dataVal) {
                $deviationModel = CmsdeviationhdrTbl::find()->where(['cmsdh_shared_fk' => $data['formData']['quotationpk']])->one();
                $deviationModel->cmsdh_shared_fk = $data['formData']['quotationpk'];
                $deviationModel->cmsdh_shared_type = $dataVal['shared_type'];
                $deviationModel->cmsdh_itemno = $dataVal['itemno'];
                $deviationModel->cmsdh_currequirement = $dataVal['currequirement'];
                $deviationModel->cmsdh_reasondeviation = $dataVal['reasondeviation'];
                $deviationModel->cmsdh_createdon = $date;
                $deviationModel->cmsdh_createdby = $userPK;
                $deviationModel->cmsdh_updatedbyipaddr = $ip_address;
                if ($deviationModel->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Quote Deviation updated Successfully!',
                        'quotationpk' => $dataVal['formData']['quotationpk'],
                    );
                }
            }
            $deviationCommentModel = CmsquotationhdrTbl::find(['cmsquotationhdr_pk' => $data['formData']['quotationpk']])->one();
            $deviationCommentModel->cmsqh_deviationcomment = $data['formData']['cmsqh_deviationcomment'];
            $deviationCommentModel->save();
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'returndata' => $deviationModel->getErrors()
            );
        }
        return $result;
    }

    /**
     * delete deviation 
     */
    public function deleteDeviation($id) {
        $model = CmsdeviationhdrTbl::find()->where('cmsdeviationhdr_pk=:id', array(':id' => $id))->one();
        if ($model->delete() === false) {
            $result = array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Failed to delete the object!'
            );
        } else {
            $result = array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag' => 'S',
                'msg' => 'Deleted successfully!',
            );
        }
        return json_encode($result);
    }

}
