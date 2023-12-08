<?php

namespace api\modules\pms\models;

use common\components\Common;
use common\components\Security;
use yii\data\ActiveDataProvider;
use Yii;
use yii\db\Exception;
use PhpOffice\PhpSpreadsheet\Calculation\Database;
use yii\base\Exception as YiiException;

/**
 * This is the ActiveQuery class for [[CmstenderpsmapTbl]].
 *
 * @see CmstenderpsmapTbl
 */
class CmstenderpsmapTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstenderpsmapTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstenderpsmapTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function mapreqproduct($data, $tenPk) {
        if ($data) {
            $tenPk = \common\components\Security::decrypt($tenPk);
            $prodspecdtls = cmstenderpsmapTbl::deleteAll(['=', 'ctpsm_cmstenderhdr_fk', $tenPk]);
            foreach ($data['prod_quantitiy'] as $key => $value) {
                $model = new CmstenderpsmapTbl();

                $model->ctpsm_cmstenderhdr_fk = $tenPk;
                $model->ctpsm_cmsrqprodservdtls_fk = $value['productpk'];
                $model->ctpsm_quantity = $value['quantity'];

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Requistion Mapping Successful!',
                        'moduleData' => $model,
                    );
                } else {
                    return $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
        }
        return $result;
    }

    public function DeleteScopProduct($deletePk) {
        $model = CmstenderpsmapTbl::find()->where([
                    'cmstenderpsmap_pk' => $deletePk
                ])->one();
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        } else {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }
    }

    public function addBillOfMeterial($formdata) {
        $sharedFk = $formdata['contractPk'];
        $tableData = $formdata['tableData'];
        $currencyPk = $formdata['currencyPk'];
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        foreach ($tableData as $key => $dataVal) {
            if (!empty($dataVal['ctpsm_unitprice']) && $dataVal['ctpsm_unitprice'] != 0 && $dataVal['isSelected'] == TRUE) {
                if (!empty($dataVal['cmstenderpsmap_pk'])) {
                    $module = CmstenderpsmapTbl::find()
                            ->where(['cmstenderpsmap_pk' => $dataVal['cmstenderpsmap_pk']])
                            ->one();
                    $module->ctpsm_updatedon = $date;
                    $module->ctpsm_updatedby = $userPK;
                    $module->ctpsm_updatedbyipaddr = $ip_address;
                } else {
                    $module = new CmstenderpsmapTbl();
                    $module->ctpsm_shared_fk = $sharedFk;
                    $module->ctpsm_shared_type = 2;
                    $module->ctpsm_cmsrqprodservdtls_fk = $dataVal['cmsrqprodservdtls_pk'];
                    $module->ctpsm_createdon = $date;
                    $module->ctpsm_createdby = $userPK;
                    $module->ctpsm_createdbyipaddr = $ip_address;
                }
                if (empty($dataVal['ctpsm_quantity'])) {
                    $module->ctpsm_quantity = $dataVal['crpsd_quantity'];
                } else {
                    $module->ctpsm_quantity = $dataVal['ctpsm_quantity'];
                }
                $module->ctpsm_unitprice = $dataVal['ctpsm_unitprice'];
                $module->ctpsm_tax = $dataVal['ctpsm_tax'];
                $module->ctpsm_discount = $dataVal['ctpsm_discount'];
                $module->ctpsm_amount = $dataVal['ctpsm_amount'];
                $module->ctpsm_unitcurrency_fk = $currencyPk;
                $module->ctpsm_delivdate = $dataVal['crpsd_delivreqdate'];
                $module->ctpsm_deliv_mcmpld_fk = $dataVal['locationPk'];
                if ($module->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'moduleData' => '',
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'moduleData' => $module->getErrors(),
                    );
                }
            } else {
                if (!empty($dataVal['cmstenderpsmap_pk'])) {
                    $module = CmstenderpsmapTbl::find()->where('cmstenderpsmap_pk=:dataPK and ctpsm_shared_type = 2 and ctpsm_shared_fk = :sharedFk', array(':dataPK' => $dataVal['cmstenderpsmap_pk'],':sharedFk' => $sharedFk))->one();
                    if(!empty($module)){                            
                    if ($module->delete() === false) {
                        $result = array(
                            'status' => 422,
                            'statusmsg' => 'warning',
                            'flag' => 'E',
                            'msg' => 'Failed to delete the object!'
                        );
                        return $result;
                    }
                    }
                }
            }
        }

        return $result;
    }

    public static function GetAddedProductService($currentPK) {
        $query = CmstenderpsmapTbl::find()
                ->select(['cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'crpsd_type'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 3', [':pk' => $currentPK])
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'returndata' => $query ? $query : [],
        );
        return $result;
    }

}
