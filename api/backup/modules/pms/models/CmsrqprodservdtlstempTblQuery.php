<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use api\modules\pms\models\CmstenderpsmapTbl;

/**
 * This is the ActiveQuery class for [[CmsrqprodservdtlstempTbl]].
 *
 * @see CmsrqprodservdtlstempTbl
 */
class CmsrqprodservdtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function AddProductServictemp($data) {
        if (!empty($data)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $proserviceArray = $data['formData'];
            $deliverydetails = $data['deliverydetails'];
            if ($proserviceArray['requi_productserivePk'] != 0 && !empty($proserviceArray['requi_productserivePk'])) {
                $model = CmsrqprodservdtlstempTbl::find()->where("cmsrqprodservdtlstemp_pk =:pk", [':pk' => $proserviceArray['requi_productserivePk']])->one();
                $model->crpsdt_updatedon = $date;
                $model->crpsdt_updatedby = $userPK;
                $model->crpsdt_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmsrqprodservdtlstempTbl();
                $model->crpsdt_createdon = $date;
                $model->crpsdt_createdby = $userPK;
                $model->crpsdt_createdbyipaddr = $ip_address;
                $model->crpsdt_quantity = $proserviceArray['requi_quantity'];
            }
            $model->crpsdt_shared_fk = $proserviceArray['req_pk'];
            $model->crpsdt_shared_type = $proserviceArray['requi_shared_type'];
            $model->crpsdt_type = $proserviceArray['requi_type'];
            $model->crpsdt_sharedmst_fk = $proserviceArray['requi_masterPk'];
            $model->crpsdt_displayname = $proserviceArray['requi_name'];
            $model->crpsdt_description = $proserviceArray['prod_desc'];
            $model->crpsdt_shareddtls_fk = $proserviceArray['requi_shared_pk'];
            $model->crpsdt_unitmst_fk = $proserviceArray['requi_unitmeas'];
            $model->crpsdt_tagno = $proserviceArray['requi_tagno'];
            $model->crpsdt_specothers = $proserviceArray['other_specify'];
            

            $model->crpsdt_deliv_mcmpld_fk = $deliverydetails['locationPk'];
            $model->crpsdt_delivloctype = $deliverydetails['deliveryPk'];
            // $model->crpsdt_delivloctypeothers = $proserviceArray['requi_masterPk'];

            $model->crpsdt_delivreqdate = Common::convertDateTimeToServerTimezone($deliverydetails['delivery_date']);
            $model->crpsdt_delivdeferreddate = Common::convertDateTimeToServerTimezone($deliverydetails['before_date']);
            $model->crpsdt_delivmodeoftrans = $deliverydetails['mode_transport'];
            $model->crpsdt_delivfreightterms = $deliverydetails['term_fright'];
            $model->crpsdt_delivremarks = $deliverydetails['remark'];
            $model->crpsdt_delivtac = $deliverydetails['terms_conditi'];

            if ($model->save() === TRUE) {
                //Multi Product Mapping 
                foreach($proserviceArray['requi_masterPk'] as $key => $value) {
                    $multiproductmapping = self::savemultiproductmapping($model, $value);
                }

                if ((is_array($data['spacificationData'])) && (is_array($data['spacificationData'][0]['pspecifications']) && !empty($data['spacificationData'][0]['pspecifications']) && !empty($data['spacificationData'][0]['pspecifications'][0]['pslabel'])))
                    $result = CmsrqprodservtrnxTblQuery::saveData($data, $model->cmsrqprodservdtlstemp_pk);
                else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Product / Service Added Successfully',
                        'moduleData' => $prdScMdl,
                    );
                }
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

    public static function getProductListtemp($reqPk, $type = 1) {
        ini_set('maximum_execution_time', 100);
        $query = CmsrqprodservdtlstempTbl::find()
                ->select(['crpsdt_displayname', 'crpsdt_delivloctype', 'crpsdt_delivtac', 'crpsdt_delivremarks',
                    'crpsdt_delivfreightterms', 'crpsdt_deliv_mcmpld_fk', 'crpsdt_delivreqdate',
                    'crpsdt_delivdeferreddate', 'crpsdt_delivmodeoftrans', 'crpsdt_delivreqdate as req_date',
                    'crpsdt_specothers', 'cmsrqprodservdtlstemp_pk', 'crpsdt_type', 'crpsdt_sharedmst_fk',
                    'crpsdt_shareddtls_fk', 'prdm_productcode', 'prdm_productname', 'crpsdt_quantity',
                    'crpsdt_unitmst_fk', 'crpsdt_tagno', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk',
                    'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName', 'PrdM_ProductName', 'crpsdt_description',
                    'projectdtls_pk', 'crpsdt_deliv_mcmpld_fk as product_address_pk', 'mcmpld_address as product_address'])
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsdt_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsdt_sharedmst_fk = productmst_pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsdt_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsdt_shared_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'crpsdt_deliv_mcmpld_fk=memcompmplocationdtls_pk')
                ->where('crpsdt_shared_fk=:reqpk and crpsdt_shared_type=:sharedtype', array(':reqpk' => $reqPk, ':sharedtype' => $type))
                ->asArray()
                ->all();
        $projectData = \api\modules\pd\models\ProjectdtlsTblQuery::GetProjectData($query[0]['projectdtls_pk']);
        $productDataArray = [];
        $product_list = 0;
        $service_list = 0;
        foreach ($query as $kay => $proVal) {
            if($proVal['crpsdt_type'] == 1) {
                // $proVal['proser_data'] = \api\modules\mst\models\ProductmstTblQuery::GetProductMstData($proVal['cmsrqprodservdtlstemp_pk']);
                $proVal['proser_data'] = \api\modules\mst\models\ProductmstTblQuery::GetProductMstData($proVal['crpsdt_sharedmst_fk']);
                $product_list++;
            } else {
                // $proVal['proser_data'] = \api\modules\mst\models\ServicemstTblQuery::GetServiceMstData($proVal['cmsrqprodservdtlstemp_pk']);
                $proVal['proser_data'] = \api\modules\mst\models\ServicemstTblQuery::GetServiceMstData($proVal['crpsdt_sharedmst_fk']);
                $service_list++;
            }
            if ($proVal['memcompfiledtls_pk'] != null) {
                $memcompfile_pk = $proVal['memcompfiledtls_pk'];
                $memcomp_pk = $proVal['mcfd_memcompmst_fk'];
                $user_pk = $proVal['mcfd_uploadedby'];
                $proVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
            } else {
                /*
                $iname = str_replace(' ', '_', $proVal['PrdM_ProductName']);
                $url = 'https://en.wikipedia.org/wiki/' . $iname;
                $handle = @fopen($url, 'r');
                if ($handle !== false) {
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $html = curl_exec($curl);
                    curl_close($curl);
                    $dom = new \domDocument;
                    $dom->loadHTML($html);
                    $finder = new \DomXPath($dom);
                    $classname = "thumbimage";
                    $nodes = $finder->query("//*[contains(@class, '$classname')]");
                    $image = '';
                    $content = '';
                    foreach ($nodes as $node) {
                        $image = $node->getAttribute('src');
                        break;
                    }
                    if ($image == '' || $image == NULL) {
                        $image = null;
                    }
                }
                */
                $proVal['image_url'] = NULL; //$image;
            }
            $proVal['slNo'] = str_pad($kay + 1, 2, "0", STR_PAD_LEFT);
            $proVal['product_count'] = $product_list;
            $proVal['service_count'] = $service_list;
            $productDataArray[] = $proVal;
        }
        ini_set('maximum_execution_time', 30);
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'productList' => $productDataArray,
            'projectData' => $projectData,
        );
        return $result;
    }

    public static function getViewProductList($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $reqPk = $data['reqPk'];
        $type = $data['type'];
        ini_set('maximum_execution_time', 100);
        $query = CmsrqprodservdtlstempTbl::find()
                ->select(['crpsdt_displayname', 'crpsdt_delivloctype', 'crpsdt_delivtac', 'crpsdt_delivremarks',
                'crpsdt_delivfreightterms', 'crpsdt_deliv_mcmpld_fk', 'crpsdt_delivreqdate',
                'crpsdt_delivdeferreddate', 'crpsdt_delivmodeoftrans', 'crpsdt_delivreqdate as req_date',
                'crpsdt_specothers', 'cmsrqprodservdtlstemp_pk', 'crpsdt_type', 'crpsdt_sharedmst_fk',
                'crpsdt_shareddtls_fk', 'PrdM_ProductCode', 'PrdM_ProductName', 'crpsdt_quantity',
                'crpsdt_unitmst_fk', 'crpsdt_tagno', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk',
                'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName', 'crpsdt_description',
                'projectdtls_pk', 'crpsdt_deliv_mcmpld_fk as product_address_pk', 'mcmpld_address as product_address'])
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsdt_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsdt_sharedmst_fk = productmst_pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsdt_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsdt_shared_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'crpsdt_deliv_mcmpld_fk=memcompmplocationdtls_pk')
                ->where('crpsdt_shared_fk=:reqpk and crpsdt_shared_type=:sharedtype', array(':reqpk' => $reqPk, ':sharedtype' => $type))
                ->andFilterWhere(['like', 'PrdM_ProductName', $searchTxt])
                ->orFilterWhere(['like', 'PrdM_ProductCode', $searchTxt])
                ->orFilterWhere(['like', 'crpsdt_displayname', $searchTxt])
                ->asArray();

        $page = (!empty($size)) ? $size : 5;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $productDataArray = [];

        foreach ($provider->getModels() as $kay => $proVal) {
            if ($proVal['memcompfiledtls_pk'] != null) {
                $memcompfile_pk = $proVal['memcompfiledtls_pk'];
                $memcomp_pk = $proVal['mcfd_memcompmst_fk'];
                $user_pk = $proVal['mcfd_uploadedby'];
                $proVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
            } else {
                $iname = str_replace(' ', '_', $proVal['PrdM_ProductName']);
                $url = 'https://en.wikipedia.org/wiki/' . $iname;
                $handle = @fopen($url, 'r');
                if ($handle !== false) {
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $html = curl_exec($curl);
                    curl_close($curl);
                    $dom = new \domDocument;
                    $dom->loadHTML($html);
                    $finder = new \DomXPath($dom);
                    $classname = "thumbimage";
                    $nodes = $finder->query("//*[contains(@class, '$classname')]");
                    $image = '';
                    $content = '';
                    foreach ($nodes as $node) {
                        $image = $node->getAttribute('src');
                        break;
                    }
                    if ($image == '' || $image == NULL) {
                        $image = null;
                    }
                }
                $proVal['image_url'] = $image;
            }
            $proVal['slNo'] = str_pad($kay + 1, 2, "0", STR_PAD_LEFT);
            $productDataArray[] = $proVal;
        }
        
        $projectData = \api\modules\pd\models\ProjectdtlsTblQuery::GetProjectData($productDataArray[0]['projectdtls_pk']);
        ini_set('maximum_execution_time', 30);
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'productList' => $productDataArray,
            'projectData' => $projectData,
            'total_count' => $provider->getTotalCount(),
        );
        return $result;
    }

    public static function DeleteProServicetemp($proservicePk) {
        if (!empty($proservicePk)) {
            \api\modules\pms\models\CmsrqprodservtrnxTbl::deleteAll(['IN', 'crpst_cmsprodservdtls_fk', explode(',', $proservicePk)]);
            \api\modules\pms\models\CmsrqprodservdtlstempTbl::deleteAll(['IN', 'cmsrqprodservdtlstemp_pk', explode(',', $proservicePk)]);
        }
        return $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'U',
            'comments' => 'Product Deleated Successfully!',
        );
    }

    
    public function UpdateMeasurementtemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlstempTbl::find()->where("cmsrqprodservdtlstemp_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsdt_unitmst_fk = $value;
            $model->crpsdt_updatedon = $date;
            $model->crpsdt_updatedby = $userPK;
            $model->crpsdt_updatedbyipaddr = $ip_address;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Measurement Updated Successfully!',
                    'moduleData' => $model,
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

    public function UpdateQuantitytemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlstempTbl::find()->where("cmsrqprodservdtlstemp_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsdt_quantity = $value;
            $model->crpsdt_updatedon = $date;
            $model->crpsdt_updatedby = $userPK;
            $model->crpsdt_updatedbyipaddr = $ip_address;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Count Updated Successfully!',
                    'moduleData' => $model,
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

    
    public function UpdateRequireddatetemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlstempTbl::find()->where("cmsrqprodservdtlstemp_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsdt_delivreqdate = Common::convertDateTimeToServerTimezone($value);
            $model->crpsdt_updatedon = $date;
            $model->crpsdt_updatedby = $userPK;
            $model->crpsdt_updatedbyipaddr = $ip_address;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Delivery Required Date Updated Successfully!',
                    'moduleData' => $model,
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

    public function savemultiproductmapping($model, $prodserv_pk) {
        if($prodserv_pk) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            $mapping_model = new api\modules\pms\models\CmsrqprodservmaptempTbl();
            $mapping_model->crpsmt_createdon =  $date;
            $mapping_model->crpsmt_createdby = $userPK;
            $mapping_model->crpsmt_createdbyipaddr = $ip_address;
            $mapping_model->crpsmt_sharedmst_fk = $prodserv_pk;
            $mapping_model->crpsmt_cmsrqprodservdtlstemp_fk = $model->cmsrqprodservdtlstemp_pk;
            
            if(!$mapping_model->save()) {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $mapping_model->getErrors()
                ); 
            } else {
                $result = array(
                    'status' => true
                );
            }
        }
        return $result;
        
    } 
}

