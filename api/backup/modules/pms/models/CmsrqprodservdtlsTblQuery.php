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
 * This is the ActiveQuery class for [[CmsrqprodservdtlsTbl]].
 *
 * @see CmsrqprodservdtlsTbl
 */
class CmsrqprodservdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public static function GetReqProductData($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $reqPk = $data['reqPk'];
        $query = CmsrqprodservdtlsTbl::find()
                ->select(['cmsrqprodservdtls_pk', 'crpsd_sharedmst_fk', 'crpsd_shareddtls_fk', 'crpsd_quantity', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk', 'mcfd_uploadedby', 'PrdM_ProductName'])
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->where('crpsd_shared_fk=:reqpk and crpsd_shared_type=:sharedtype', array(':reqpk' => $reqPk, ':sharedtype' => 1))
                ->andFilterWhere(['like', 'PrdM_ProductName', $searchTxt])
                ->orFilterWhere(['like', 'PrdM_ProductCode', $searchTxt])
                ->asArray();
        $page = (!empty($size)) ? $size : 5;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $productDataArray = [];
        foreach ($provider->getModels() as $proVal) {
            if ($proVal['memcompfiledtls_pk'] != null) {
                $memcompfile_pk = Security::encrypt($proVal['memcompfiledtls_pk']);
                $memcomp_pk = Security::encrypt($proVal['mcfd_memcompmst_fk']);
                $user_pk = Security::encrypt($proVal['mcfd_uploadedby']);
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
            $productDataArray[] = $proVal;
        }

        return [
            'items' => $productDataArray,
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
        ];
    }

    public static function getViewProductList($data) {
        $size = Security::sanitizeInput($data['size'], "number");
        $searchTxt = Security::sanitizeInput($data['searchTxt'], "string_spl_char");
        $reqPk = $data['reqPk'];
        $type = $data['type'];
        ini_set('maximum_execution_time', 100);
        $query = CmsrqprodservdtlsTbl::find()
                ->select(['crpsd_displayname', 'crpsd_delivloctype', 'crpsd_delivtac', 'crpsd_delivremarks', 'crpsd_delivfreightterms', 'crpsd_deliv_mcmpld_fk', 'crpsd_delivreqdate', 'crpsd_delivdeferreddate', 'crpsd_delivmodeoftrans', 'crpsd_delivreqdate as req_date', 'crpsd_specothers', 'cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_sharedmst_fk',
                    'crpsd_shareddtls_fk', 'PrdM_ProductCode', 'crpsd_quantity',
                    'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk',
                    'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName', 'PrdM_ProductName', 'crpsd_description',
                    'projectdtls_pk', 'crpsd_deliv_mcmpld_fk as product_address_pk', 'mcmpld_address as product_address'])
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'crpsd_deliv_mcmpld_fk=memcompmplocationdtls_pk')
                ->where('crpsd_shared_fk=:reqpk and crpsd_shared_type=:sharedtype', array(':reqpk' => $reqPk, ':sharedtype' => $type))
                ->andFilterWhere(['like', 'PrdM_ProductName', $searchTxt])
                ->orFilterWhere(['like', 'PrdM_ProductCode', $searchTxt])
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
    

    public static function getRequisitionProductList($reqPk, $checkmap, $ten_id) {
        ini_set('maximum_execution_time', 100);
        if ($checkmap) {
            $query = CmstenderpsmapTbl::find()
                    ->select(['cmsrqprodservdtls_pk', 'mcmpld_officename', 'mcmpld_address', 'crpsd_displayname', 'crpsd_specothers', 'cmstenderpsmap_pk', 'ctpsm_cmstenderhdr_fk', 'ctpsm_cmsrqprodservdtls_fk', 'ctpsm_quantity as crpsd_quantity', 'cmsrqprodservdtls_pk',
                        'crpsd_type', 'crpsd_sharedmst_fk', 'crpsd_shareddtls_fk', 'prdm_productcode', 'prdm_productname',
                        'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk', 'mcfd_uploadedby',
                        'MCM_CompanyName', 'MCPrD_DisplayName', 'PrdM_ProductName', 'crpsd_description',
                        'crpsd_deliv_mcmpld_fk', 'crpsd_delivloctype', 'crpsd_delivloctypeothers', 'crpsd_delivreqdate', 'crpsd_delivdeferreddate',
                        'crpsd_delivmodeoftrans', 'crpsd_delivfreightterms', 'crpsd_delivtac', 'crpsd_delivremarks'])
                    ->leftJoin('cmsrqprodservdtls_tbl', 'ctpsm_cmsrqprodservdtls_fk = cmsrqprodservdtls_pk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                    ->leftJoin('memcompmplocationdtls_tbl', 'crpsd_deliv_mcmpld_fk = memcompmplocationdtls_pk')
                    ->where('crpsd_shared_fk=:reqpk', array(':reqpk' => $reqPk))
                    ->andWhere('crpsd_shared_type=:sharedtype', array(':sharedtype' => 1))
                    ->andWhere('ctpsm_cmstenderhdr_fk=:tenpk', array(':tenpk' => $ten_id))
                    ->asArray()
                    ->all();
            if (!$query) {
                $query = CmsrqprodservdtlsTbl::find()
                        ->select(['mcmpld_officename', 'mcmpld_address', 'crpsd_displayname', 'crpsd_specothers', 'cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_sharedmst_fk', 'crpsd_shareddtls_fk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'memcompfiledtls_pk',
                            'mcfd_memcompmst_fk', 'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName', 'PrdM_ProductName', 'crpsd_description',
                            'crpsd_deliv_mcmpld_fk', 'crpsd_delivloctype', 'crpsd_delivloctypeothers', 'crpsd_delivreqdate', 'crpsd_delivdeferreddate',
                            'crpsd_delivmodeoftrans', 'crpsd_delivfreightterms', 'crpsd_delivtac', 'crpsd_delivremarks'])
                        ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                        ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                        ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                        ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                        ->leftJoin('cmstenderpsmap_tbl', 'cmsrqprodservdtls_pk= ctpsm_cmsrqprodservdtls_fk')
                        ->leftJoin('memcompmplocationdtls_tbl', 'crpsd_deliv_mcmpld_fk = memcompmplocationdtls_pk')
                        ->where('crpsd_shared_fk=:reqpk', array(':reqpk' => $reqPk))
                        ->andWhere('crpsd_shared_type=:sharedtype', array(':sharedtype' => 1))
                        ->andWhere('ctpsm_cmsrqprodservdtls_fk is null')
                        ->asArray()
                        ->all();
            }
        } else {
            $query = CmsrqprodservdtlsTbl::find()
                    ->select(['mcmpld_officename', 'mcmpld_address', 'crpsd_displayname', 'crpsd_specothers', 'cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_sharedmst_fk',
                        'crpsd_shareddtls_fk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno',
                        'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk', 'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName',
                        'PrdM_ProductName', 'crpsd_description', 'crpsd_deliv_mcmpld_fk', 'crpsd_delivloctype', 'crpsd_delivloctypeothers',
                        'crpsd_delivreqdate', 'crpsd_delivdeferreddate', 'crpsd_delivmodeoftrans', 'crpsd_delivfreightterms', 'crpsd_delivtac',
                        'crpsd_delivremarks'])
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                    ->leftJoin('memcompmplocationdtls_tbl', 'crpsd_deliv_mcmpld_fk = memcompmplocationdtls_pk')
                    ->where('crpsd_shared_fk=:reqpk', array(':reqpk' => $reqPk))
                    ->andWhere('crpsd_shared_type=:sharedtype', array(':sharedtype' => 1))
                    ->asArray()
                    ->all();
        }

        $productDataArray = [];
        foreach ($query as $kay => $proVal) {
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
        ini_set('maximum_execution_time', 30);
        return $productDataArray;
    }

    public static function getProductList($reqPk, $type = 1) {
        ini_set('maximum_execution_time', 100);
        $query = CmsrqprodservdtlsTbl::find()
                ->select(['crpsd_displayname', 'crpsd_delivloctype', 'crpsd_delivtac', 'crpsd_delivremarks', 'crpsd_delivfreightterms', 'crpsd_deliv_mcmpld_fk', 'crpsd_delivreqdate', 'crpsd_delivdeferreddate', 'crpsd_delivmodeoftrans', 'crpsd_delivreqdate as req_date', 'crpsd_specothers', 'cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_sharedmst_fk',
                    'crpsd_shareddtls_fk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity',
                    'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'memcompfiledtls_pk', 'mcfd_memcompmst_fk',
                    'mcfd_uploadedby', 'MCM_CompanyName', 'MCPrD_DisplayName', 'PrdM_ProductName', 'crpsd_description',
                    'projectdtls_pk', 'crpsd_deliv_mcmpld_fk as product_address_pk', 'mcmpld_address as product_address'])
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('membercompanymst_tbl', 'MCPrD_MemberCompMst_Fk = MemberCompMst_Pk')
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'crpsd_deliv_mcmpld_fk=memcompmplocationdtls_pk')
                ->where('crpsd_shared_fk=:reqpk and crpsd_shared_type=:sharedtype', array(':reqpk' => $reqPk, ':sharedtype' => $type))
                ->asArray()
                ->all();
        $projectData = \api\modules\pd\models\ProjectdtlsTblQuery::GetProjectData($query[0]['projectdtls_pk']);
        $productDataArray = [];
        foreach ($query as $kay => $proVal) {
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

    public function getWikiImage($dataName) {
        $iname = str_replace(' ', '_', $dataName);
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
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'U',
            'comments' => 'Wikipedia Data Get Successfully',
            'image_url' => $image,
        );
        return $result;
    }

    public function AddProductServic($data) {
        if (!empty($data)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $proserviceArray = $data['formData'];
            $deliverydetails = $data['deliverydetails'];
            if ($proserviceArray['requi_productserivePk'] != 0 && !empty($proserviceArray['requi_productserivePk'])) {
                $model = CmsrqprodservdtlsTbl::find()->where("cmsrqprodservdtls_pk =:pk", [':pk' => $proserviceArray['requi_productserivePk']])->one();
                $model->crpsd_updatedon = $date;
                $model->crpsd_updatedby = $userPK;
                $model->crpsd_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmsrqprodservdtlsTbl();
                $model->crpsd_createdon = $date;
                $model->crpsd_createdby = $userPK;
                $model->crpsd_createdbyipaddr = $ip_address;
            }
            $model->crpsd_shared_fk = $proserviceArray['req_pk'];
            $model->crpsd_shared_type = $proserviceArray['requi_shared_type'];
            $model->crpsd_type = $proserviceArray['requi_type'];
            $model->crpsd_sharedmst_fk = $proserviceArray['requi_masterPk'];
            $model->crpsd_displayname = $proserviceArray['requi_name'];
            $model->crpsd_description = $proserviceArray['prod_desc'];
            $model->crpsd_shareddtls_fk = $proserviceArray['requi_shared_pk'];
            $model->crpsd_unitmst_fk = $proserviceArray['requi_unitmeas'];
            $model->crpsd_tagno = $proserviceArray['requi_tagno'];
            $model->crpsd_specothers = $proserviceArray['other_specify'];
            $model->crpsd_quantity = $proserviceArray['requi_quantity'];

            $model->crpsd_deliv_mcmpld_fk = $deliverydetails['locationPk'];
            $model->crpsd_delivloctype = $deliverydetails['deliveryPk'];
            // $model->crpsd_delivloctypeothers = $proserviceArray['requi_masterPk']; 

            $model->crpsd_delivreqdate = Common::convertDateTimeToServerTimezone($deliverydetails['delivery_date']);
            $model->crpsd_delivdeferreddate = Common::convertDateTimeToServerTimezone($deliverydetails['before_date']);
            $model->crpsd_delivmodeoftrans = $deliverydetails['mode_transport'];
            $model->crpsd_delivfreightterms = $deliverydetails['term_fright'];
            $model->crpsd_delivremarks = $deliverydetails['remark'];
            $model->crpsd_delivtac = $deliverydetails['terms_conditi'];

            if ($model->save() === TRUE) {
                if ((is_array($data['spacificationData'])) && (is_array($data['spacificationData'][0]['pspecifications']) && !empty($data['spacificationData'][0]['pspecifications']) && !empty($data['spacificationData'][0]['pspecifications'][0]['pslabel'])))
                    $result = CmsrqprodservtrnxTblQuery::saveData($data, $model->cmsrqprodservdtls_pk);
                else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'U',
                        'comments' => 'Product & Service Successfully',
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

    public function UpdateQuantity($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlsTbl::find()->where("cmsrqprodservdtls_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsd_quantity = $value;
            $model->crpsd_updatedon = $date;
            $model->crpsd_updatedby = $userPK;
            $model->crpsd_updatedbyipaddr = $ip_address;
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

    public function UpdateRequireddate($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlsTbl::find()->where("cmsrqprodservdtls_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsd_delivreqdate = Common::convertDateTimeToServerTimezone($value);
            $model->crpsd_updatedon = $date;
            $model->crpsd_updatedby = $userPK;
            $model->crpsd_updatedbyipaddr = $ip_address;
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

    public function UpdateMeasurement($proservicePk, $value) {
        if (!empty($proservicePk)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmsrqprodservdtlsTbl::find()->where("cmsrqprodservdtls_pk =:pk", [':pk' => $proservicePk])->one();
            $model->crpsd_unitmst_fk = $value;
            $model->crpsd_updatedon = $date;
            $model->crpsd_updatedby = $userPK;
            $model->crpsd_updatedbyipaddr = $ip_address;
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

    public static function DeleteProService($proservicePk) {
        if (!empty($proservicePk)) {
            \api\modules\pms\models\CmsrqprodservtrnxTbl::deleteAll(['IN', 'crpst_cmsprodservdtls_fk', explode(',', $proservicePk)]);
            \api\modules\pms\models\CmsrqprodservdtlsTbl::deleteAll(['IN', 'cmsrqprodservdtls_pk', explode(',', $proservicePk)]);
        }
        return $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'U',
            'comments' => 'Product Deleated Successfully!',
        );
    }

    public static function deletereqprodlist($deleteprodids) {
        $result = array(
            'status' => 200,
            'msg' => 'failure',
            'flag' => 'U',
            'comments' => 'Something Went Wrong!',
        );


        if ($deleteprodids) {
            $transaction = Yii::$app->db->beginTransaction();

            // $delete_product_trx = \api\modules\pms\models\CmsrqprodservtrnxTbl::deleteAll(['IN', 'crpst_cmsprodservdtls_fk', $deleteprodids]);
            $delete_product_dtls = \api\modules\pms\models\CmsrqprodservdtlsTbl::deleteAll(['IN', 'cmsrqprodservdtls_pk', $deleteprodids]);

            if ($delete_product_dtls) {
                $transaction->commit();
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Product Deleated Successfully!',
                );
            }
        }
        return $result;
    }

    public static function getViewProductServiceData($dataVal) {
        $size = Security::sanitizeInput($dataVal['size'], "number");
        $searchTxt = Security::sanitizeInput($dataVal['searchTxt'], "string_spl_char");
        $contractPk = Security::sanitizeInput($dataVal['contractPk'], "number");
        $query = CmstenderpsmapTbl::find()
                ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'SrvM_ServiceName', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'ctpsm_quantity', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount', 'ctpsm_unitprice', 'crpsd_delivreqdate', 'crpsd_shared_fk', 'SrvM_ServiceCode', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'ctpsm_delivdate', 'proImg.memcompfiledtls_pk as proImgPk', 'proImg.mcfd_memcompmst_fk as proImgComPk', 'proImg.mcfd_uploadedby as proImgUserPk', 'serImg.memcompfiledtls_pk as serImgPk', 'serImg.mcfd_memcompmst_fk as serImgComPk', 'serImg.mcfd_uploadedby as serImgUserPk','crpsd_displayname'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                ->leftJoin('memcompfiledtls_tbl as proImg', 'proImg.memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('memcompfiledtls_tbl as serImg', 'serImg.memcompfiledtls_pk=mcsvd_servcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 2', [':pk' => $contractPk])
                ->andFilterWhere(['or', ['like', 'prdm_productname', $searchTxt], ['like', 'prdm_productcode', $searchTxt], ['like', 'SrvM_ServiceName', $searchTxt], ['like', 'SrvM_ServiceCode', $searchTxt]])
                ->asArray();
        $page = (!empty($size)) ? $size : 2;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $productDataArray = [];
//        foreach ($provider->getModels() as $proVal) {
//            if ($proVal['proImgPk'] != null || $proVal['serImgPk'] != null) {
//                $memcompfile_pk = Security::encrypt($proVal['proImgPk'] ? $proVal['proImgPk'] : $proVal['serImgPk']);
//                $memcomp_pk = Security::encrypt($proVal['proImgComPk'] ? $proVal['proImgComPk'] : $proVal['serImgComPk']);
//                $user_pk = Security::encrypt($proVal['proImgUserPk'] ? $proVal['proImgUserPk'] : $proVal['serImgUserPk']);
//                $proVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
//            } else {
//                $iname = str_replace(' ', '_', $proVal['prdm_productname'] ? $proVal['prdm_productname'] : $proVal['SrvM_ServiceName']);
//                $url = 'https://en.wikipedia.org/wiki/' . $iname;
//                $handle = @fopen($url, 'r');
//                if ($handle !== false) {
//                    $curl = curl_init();
//                    curl_setopt($curl, CURLOPT_URL, $url);
//                    curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
//                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//                    $html = curl_exec($curl);
//                    curl_close($curl);
//                    $dom = new \domDocument;
//                    $dom->loadHTML($html);
//                    $finder = new \DomXPath($dom);
//                    $classname = "thumbimage";
//                    $nodes = $finder->query("//*[contains(@class, '$classname')]");
//                    $image = '';
//                    $content = '';
//                    foreach ($nodes as $node) {
//                        $image = $node->getAttribute('src');
//                        break;
//                    }
//                    if ($image == '' || $image == NULL) {
//                        $image = null;
//                    }
//                }
//                $proVal['image_url'] = $image;
//            }
//            $productDataArray[] = $proVal;
//        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'items' => $provider->getModels() ? $provider->getModels() : [],
            'total_count' => $provider->getTotalCount(),
        );
        return $result;
    }
    public static function getScopeProductServiceList($dataVal) {
        $size = Security::sanitizeInput($dataVal['size'], "number");
        $searchTxt = Security::sanitizeInput($dataVal['searchname'], "string_spl_char");
        $currentPK = Security::sanitizeInput($dataVal['currentPK'], "number");
        $query = CmstenderpsmapTbl::find()
                ->select(['cmsrqprodservdtls_pk', 'crpsd_type','crpsd_displayname', 'ctpsm_deviationcomment', 'cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'ctpsm_quantity', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount', 'ctpsm_unitprice', 'crpsd_delivreqdate', 'crpsd_shared_fk', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'ctpsm_delivdate', 'proImg.memcompfiledtls_pk as proImgPk', 'proImg.mcfd_memcompmst_fk as proImgComPk', 'proImg.mcfd_uploadedby as proImgUserPk', 'serImg.memcompfiledtls_pk as serImgPk', 'serImg.mcfd_memcompmst_fk as serImgComPk', 'serImg.mcfd_uploadedby as serImgUserPk'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                ->leftJoin('memcompfiledtls_tbl as proImg', 'proImg.memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('memcompfiledtls_tbl as serImg', 'serImg.memcompfiledtls_pk=mcsvd_servcoverimgfile')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 3', [':pk' => $currentPK])
                ->andFilterWhere(['or', ['like', 'prdm_productname', $searchTxt], ['like', 'prdm_productcode', $searchTxt], ['like', 'SrvM_ServiceName', $searchTxt], ['like', 'SrvM_ServiceCode', $searchTxt]])
                ->asArray();
        $page = (!empty($size)) ? $size : 2;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        $productDataArray = [];
        foreach ($provider->getModels() as $proVal) {
            if ($proVal['proImgPk'] != null || $proVal['serImgPk'] != null) {
                $memcompfile_pk = Security::encrypt($proVal['proImgPk'] ? $proVal['proImgPk'] : $proVal['serImgPk']);
                $memcomp_pk = Security::encrypt($proVal['proImgComPk'] ? $proVal['proImgComPk'] : $proVal['serImgComPk']);
                $user_pk = Security::encrypt($proVal['proImgUserPk'] ? $proVal['proImgUserPk'] : $proVal['serImgUserPk']);
//                $proVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
            } else {
//                $dataImage = self::getWikiImage($proVal['prdm_productname'] ? $proVal['prdm_productname'] : $proVal['SrvM_ServiceName']);
//                $proVal['image_url'] = null;
            }
            $productDataArray[] = $proVal;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'items' => $productDataArray ? $productDataArray : [],
            'total_count' => $provider->getTotalCount(),
        );
        return $result;
    }

    public static function getContractProduct($reqPk, $contractPk, $dataType, $quotselectPk) {
        $newDataArray = 0;
        $oldData= [];
        $contractQuery= [];
            $contractQuery = CmstenderpsmapTbl::find()
                ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'ctpsm_quantity', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount', 'ctpsm_unitprice', 'crpsd_delivreqdate', 'crpsd_shared_fk', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'ctpsm_delivdate','crpsd_displayname'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 2', [':pk' => $contractPk])
                ->asArray()
                ->all();   
        if ($dataType == 3) {
            $query = CmstenderpsmapTbl::find()
                    ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'ctpsm_quantity', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount', 'ctpsm_unitprice', 'crpsd_delivreqdate', 'crpsd_shared_fk', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'ctpsm_delivdate','crpsd_displayname'])
                    ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                    ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                    ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                    ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                    ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                    ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 3', [':pk' => $quotselectPk])
                    ->asArray()
                    ->all(); 
            $oldData = CmstenderpsmapTbl::find()
                ->select(['ctpsm_cmsrqprodservdtls_fk', 'sum(ctpsm_quantity) as ctpsm_quantity','ctpsm_shared_fk','ctpsm_shared_type'])
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = ctpsm_shared_fk')                                            
                ->where('cmsch_cmsrequisitionformdtls_fk=:pk and ctpsm_shared_type = 2', [':pk' => $reqPk])
                ->groupBy(['ctpsm_cmsrqprodservdtls_fk'])
                ->asArray()
                ->all();  
        } else if($dataType == 4 || $dataType == 1) {            
            if($dataType == 4){
                $contractTbl = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $contractPk])->one();
                $getAgree = [];
                if(!empty($contractTbl) && $contractTbl->cmsch_shared_agreetype == 1){
                     $getAgree = CmscontracthdrTbl::find()
                        ->select(['crfd_rqid', 'cmsrequisitionformdtls_pk', 'crfd_rqtitle', 'crfd_rqprocesstype as agreeProcessType', 'crfd_rqrefno','cmsch_shared_agreetype','cmsch_shared_agreefk'])
                        ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk = cmsch_cmsrequisitionformdtls_fk')
                        ->where('cmscontracthdr_pk=:conPK', array(':conPK' => $contractTbl->cmsch_shared_agreefk))
                        ->asArray()
                        ->one();
                     if($getAgree['agreeProcessType'] == 2){
                        $agreePk = $contractPk;
                    }elseif ($getAgree['agreeProcessType'] != 2) {
                        $agreePk = $contractTbl->cmsch_shared_agreefk;
                    } 
                }  else {
                    $agreePk = $contractPk;                    
                }
            }  else {
                $agreePk = $contractPk;
            }
            $query = CmsrqprodservdtlsTbl::find()
                    ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'projectdtls_pk', 'crpsd_delivreqdate', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk','crpsd_displayname'])
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                    ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                    ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                    ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                    ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                    ->where('crpsd_shared_fk=:dataPk and crpsd_shared_type=:sharedtype', array(':dataPk' => $agreePk, ':sharedtype' => 2))
                    ->asArray()
                    ->all();
        }
        $contractDataArray = [];
        $finalData = [];
        if(!empty($contractQuery)){
            foreach ($contractQuery as $kay => $dataPk) {
                $contractDataArray[] = $dataPk['cmsrqprodservdtls_pk'];
                $dataPk['isSelected']=true;
                $dataPk['maxDataVal'] = $dataPk['ctpsm_quantity'];
                $finalData[]=$dataPk;
            }
        }
        foreach ($query as $kay => $newDataVal) {
            if (!in_array($newDataVal['cmsrqprodservdtls_pk'], $contractDataArray)) {
                if ($dataType != 3) {
                    $newDataVal['ctpsm_quantity'] = '';
                    $newDataVal['ctpsm_tax'] = 0;
                    $newDataVal['ctpsm_discount'] = 0;
                    $newDataVal['ctpsm_amount'] = 0;
                    $newDataVal['ctpsm_unitprice'] = 0;
                }  
                $newDataVal['maxDataVal'] = $newDataVal['crpsd_quantity'];
                $newDataVal['cmstenderpsmap_pk'] = null;
                if($dataType == 4){
                    $newDataVal['isSelected'] = TRUE;    
                }  else {
                    $newDataVal['isSelected'] = false;   
                }
                $finalData[]=$newDataVal;
            }
        }
        if (!empty($oldData) && $dataType == 3) {
            $tempData = $finalData;
            $finalData = [];
            foreach ($tempData as $kay => $tempVal) {
                $datakey = null;
                $datakey = strval(self::searchForIdPS($tempVal['cmsrqprodservdtls_pk'], $oldData));
                if ($datakey == null) {
                    $finalData[] = $tempVal;
                } else {                    
                        if ($oldData[$datakey]['ctpsm_quantity'] < $tempVal['crpsd_quantity'] && $oldData[$datakey]['ctpsm_quantity'] != $tempVal['crpsd_quantity']) {
                            if($tempVal['isSelected'] == FALSE){    
                                $tempVal['ctpsm_quantity'] = $tempVal['crpsd_quantity'] - $oldData[$datakey]['ctpsm_quantity'];
                                $tempVal['maxDataVal'] = $tempVal['crpsd_quantity'] - $oldData[$datakey]['ctpsm_quantity'];
                            }  else {
                                $tempVal['maxDataVal'] = $tempVal['ctpsm_quantity'] + $tempVal['crpsd_quantity'] - $oldData[$datakey]['ctpsm_quantity'];
                            }
                            $finalData[] = $tempVal;
                        }
                }
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'productList' => $finalData ? $finalData : [],
        );
        return $result;
    }

    public static function getScopeData($dataPk, $currentPK, $dataType) {
        $type = 1;
        $newDataArray = 0;
        $query = CmstenderpsmapTbl::find()
                ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_displayname','ctpsm_deviationcomment', 'cmstenderpsmap_pk', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'ctpsm_quantity', 'ctpsm_tax', 'ctpsm_discount', 'ctpsm_amount', 'ctpsm_unitprice', 'crpsd_delivreqdate', 'crpsd_shared_fk', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'ctpsm_delivdate', 'proImg.memcompfiledtls_pk as proImgPk', 'proImg.mcfd_memcompmst_fk as proImgComPk', 'proImg.mcfd_uploadedby as proImgUserPk', 'serImg.memcompfiledtls_pk as serImgPk', 'serImg.mcfd_memcompmst_fk as serImgComPk', 'serImg.mcfd_uploadedby as serImgUserPk'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                ->leftJoin('memcompfiledtls_tbl as proImg', 'proImg.memcompfiledtls_pk=mcprd_prodcoverimgfile')
                ->leftJoin('memcompfiledtls_tbl as serImg', 'serImg.memcompfiledtls_pk=mcsvd_servcoverimgfile')
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                ->where('ctpsm_shared_fk=:pk and ctpsm_shared_type = 3', [':pk' => $currentPK])
                ->asArray()
                ->all();
        $oldData = CmstenderpsmapTbl::find()
                ->select(['cmstenderpsmap_pk', 'sum(ctpsm_quantity) as ctpsm_quantity', 'ctpsm_cmsrqprodservdtls_fk'])
                ->leftJoin('cmsrqprodservdtls_tbl', 'cmsrqprodservdtls_pk = ctpsm_cmsrqprodservdtls_fk')
                ->where('crpsd_shared_fk=:pk and ctpsm_shared_type = 3 and ctpsm_shared_fk = :currentPk', [':pk' => $dataPk,':currentPk' => $currentPK])
                ->groupBy(['ctpsm_cmsrqprodservdtls_fk'])
                ->asArray()
                ->all();
        if (empty($query)) {
            $query = CmsrqprodservdtlsTbl::find()
                    ->select(['cmsrqprodservdtls_pk', 'crpsd_type','crpsd_displayname', 'prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'projectdtls_pk', 'crpsd_delivreqdate', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'proImg.memcompfiledtls_pk as proImgPk', 'proImg.mcfd_memcompmst_fk as proImgComPk', 'proImg.mcfd_uploadedby as proImgUserPk', 'serImg.memcompfiledtls_pk as serImgPk', 'serImg.mcfd_memcompmst_fk as serImgComPk', 'serImg.mcfd_uploadedby as serImgUserPk'])
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                    ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                    ->leftJoin('memcompfiledtls_tbl as proImg', 'proImg.memcompfiledtls_pk=mcprd_prodcoverimgfile')
                    ->leftJoin('memcompfiledtls_tbl as serImg', 'serImg.memcompfiledtls_pk=mcsvd_servcoverimgfile')
                    ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                    ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                    ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                    ->where('crpsd_shared_fk=:dataPk and crpsd_shared_type=:sharedtype', array(':dataPk' => $dataPk, ':sharedtype' => 3))
                    ->asArray()
                    ->all();
            $type = 2;
        } else {
            $oldDataArray = [];
            foreach ($query as $kay => $data) {
                $oldDataArray[] = $data['cmsrqprodservdtls_pk'];
            }
            $newData = CmsrqprodservdtlsTbl::find()
                    ->select(['cmsrqprodservdtls_pk', 'crpsd_type', 'crpsd_displayname','prdm_productcode', 'prdm_productname', 'crpsd_quantity', 'crpsd_unitmst_fk', 'crpsd_tagno', 'unm_namesg', 'MCPrD_DisplayName', 'MCSvD_DisplayName', 'crpsd_description', 'projectdtls_pk', 'crpsd_delivreqdate', 'SrvM_ServiceCode', 'SrvM_ServiceName', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName', 'crpsd_deliv_mcmpld_fk as locationPk', 'proImg.memcompfiledtls_pk as proImgPk', 'proImg.mcfd_memcompmst_fk as proImgComPk', 'proImg.mcfd_uploadedby as proImgUserPk', 'serImg.memcompfiledtls_pk as serImgPk', 'serImg.mcfd_memcompmst_fk as serImgComPk', 'serImg.mcfd_uploadedby as serImgUserPk'])
                    ->leftJoin('unitmst_tbl', 'unitmst_pk = crpsd_unitmst_fk')
                    ->leftJoin('productmst_tbl', 'crpsd_sharedmst_fk = productmst_pk')
                    ->leftJoin('servicemst_tbl', 'crpsd_sharedmst_fk = ServiceMst_Pk')
                    ->leftJoin('memcompproddtls_tbl', 'crpsd_shareddtls_fk = memcompproddtls_pk')
                    ->leftJoin('memcompservicedtls_tbl', 'crpsd_shareddtls_fk = MemCompServDtls_Pk')
                    ->leftJoin('cmsrequisitionformdtls_tbl', 'cmsrequisitionformdtls_pk=crpsd_shared_fk')
                    ->leftJoin('memcompmplocationdtls_tbl', 'memcompmplocationdtls_pk=crpsd_deliv_mcmpld_fk')
                    ->leftJoin('memcompfiledtls_tbl as proImg', 'proImg.memcompfiledtls_pk=mcprd_prodcoverimgfile')
                    ->leftJoin('memcompfiledtls_tbl as serImg', 'serImg.memcompfiledtls_pk=mcsvd_servcoverimgfile')
                    ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                    ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                    ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                    ->leftJoin('projectdtls_tbl', 'projectdtls_pk=crfd_projectdtls_fk')
                    ->where('crpsd_shared_fk=:dataPk and crpsd_shared_type=:sharedtype', array(':dataPk' => $dataPk, ':sharedtype' => 3))
                    ->asArray()
                    ->all();
            if (!empty($newData)) {
                $finalNewVal = [];
                foreach ($newData as $kay => $newDataVal) {
                    if (!in_array($newDataVal['cmsrqprodservdtls_pk'], $oldDataArray)) {
                        $newDataVal['ctpsm_deviationcomment'] = null;
                        $newDataVal['ctpsm_quantity'] = '';
                        $newDataVal['ctpsm_tax'] = 0;
                        $newDataVal['ctpsm_discount'] = 0;
                        $newDataVal['ctpsm_amount'] = 0;
                        $newDataVal['ctpsm_unitprice'] = 0;
                        $newDataVal['cmstenderpsmap_pk'] = null;
                        $newDataVal['maxDataVal'] = $proVal['crpsd_quantity'];
//                        $newDataVal['isSelected'] = FALSE;
                        $newDataVal['isSelected'] = true;
                        $finalNewVal[] = $newDataVal;
                    }
                }
                $newDataArray = 1;
            }
        }
        $finalData = [];
        foreach ($query as $kay => $proVal) {
            if ($type == 2) {
                $proVal['ctpsm_deviationcomment'] = null;
                $proVal['ctpsm_quantity'] = '';
                $proVal['ctpsm_tax'] = 0;
                $proVal['ctpsm_discount'] = 0;
                $proVal['ctpsm_amount'] = 0;
                $proVal['ctpsm_unitprice'] = 0;
                $proVal['cmstenderpsmap_pk'] = null;
//                $proVal['isSelected'] = FALSE;
                $proVal['isSelected'] = true;
                $proVal['maxDataVal'] = $proVal['crpsd_quantity'];
            } elseif (($type == 1) || ($type == 2)) {
                $proVal['isSelected'] = true;
                $proVal['maxDataVal'] = $proVal['ctpsm_quantity'];
            }
            $finalData[] = $proVal;
        }
        if (($type == 2 || $newDataArray == 1) && !empty($oldData)) {
            if ($newDataArray == 1) {
                $savedOldData = $finalData;
                $tempData = $finalNewVal;
            } else {
                $tempData = $finalData;
            }
            $finalData = [];
            foreach ($tempData as $kay => $tempVal) {
                $datakey = null;
                $datakey = strval(self::searchForIdPS($tempVal['cmsrqprodservdtls_pk'], $oldData));
                if ($datakey == null) {
                    $finalData[] = $tempVal;
                } else {
                    if ($oldData[$datakey]['ctpsm_quantity'] < $tempVal['crpsd_quantity'] && $oldData[$datakey]['ctpsm_quantity'] != $tempVal['crpsd_quantity']) {
                        $tempVal['ctpsm_quantity'] = $tempVal['crpsd_quantity'] - $oldData[$datakey]['ctpsm_quantity'];
                        $tempVal['maxDataVal'] = $tempVal['crpsd_quantity'] - $oldData[$datakey]['ctpsm_quantity'];
                        $finalData[] = $tempVal;
                    }
                }
            }
        }
        $dataFinalArray = [];
        if ($newDataArray == 1) {
            $dataFinalArray = array_merge($savedOldData, $finalData);
        } else {
            $dataFinalArray = $finalData;
        }

        $productDataArray = [];
        foreach ($dataFinalArray as $proVal) {
            if ($proVal['proImgPk'] != null || $proVal['serImgPk'] != null) {
                $memcompfile_pk = Security::encrypt($proVal['proImgPk'] ? $proVal['proImgPk'] : $proVal['serImgPk']);
                $memcomp_pk = Security::encrypt($proVal['proImgComPk'] ? $proVal['proImgComPk'] : $proVal['serImgComPk']);
                $user_pk = Security::encrypt($proVal['proImgUserPk'] ? $proVal['proImgUserPk'] : $proVal['serImgUserPk']);
//                $proVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
            } else {
//                $dataImage = self::getWikiImage($proVal['prdm_productname'] ? $proVal['prdm_productname'] : $proVal['SrvM_ServiceName']);
//                $proVal['image_url'] = null;
            }
            if(!empty($proVal['ctpsm_deviationcomment']) && $proVal['ctpsm_deviationcomment'] != null){
                $proVal['deviationtoggle'] = 1;
            }  else {
                $proVal['deviationtoggle'] = 0;
            }
            $productDataArray[] = $proVal;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'productList' => $productDataArray ? $productDataArray : [],
            'dataType' => $type,
        );
        return $result;
    }

    public static function getContractProductChk($reqPk) {
        $tenderTbl = CmstenderhdrTbl::find()->where("cmsth_cmsrequisitionformdtls_fk =:pk and cmsth_type in (4,5,6)", [':pk' => $reqPk])->one();
//        $tenderTbl = CmstenderhdrTbl::find()->where("cmsth_cmsrequisitionformdtls_fk =:pk and cmsth_type in (4,5,6) and cmsth_tenderstatus in (5,8,1)", [':pk' => $reqPk])->one();
        if(!empty($tenderTbl)){
            $tenderData = CmsrqprodservdtlsTbl::find()
                    ->select(['cmsrqprodservdtls_pk as dataPk','crpsd_quantity as Quantity'])
                    ->where('crpsd_shared_fk=:pk and crpsd_shared_type = 3', [':pk' => $tenderTbl->cmstenderhdr_pk])
                    ->groupBy(['cmsrqprodservdtls_pk'])
                    ->asArray()
                    ->all();
            if(!empty($tenderData)){
                $conData = CmstenderpsmapTbl::find()
                    ->select(['ctpsm_cmsrqprodservdtls_fk as dataPk', 'sum(ctpsm_quantity) as Quantity','ctpsm_shared_fk','ctpsm_shared_type'])
                    ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = ctpsm_shared_fk')                                            
                    ->where('cmsch_cmsrequisitionformdtls_fk=:pk and ctpsm_shared_type = 2', [':pk' => $reqPk])
                    ->groupBy(['ctpsm_cmsrqprodservdtls_fk'])
                    ->asArray()
                    ->all();
            }
        }
        $finalData = [];
        if (!empty($tenderData) && !empty($conData)) {
            foreach ($tenderData as $kay => $fineVal) {
                $datakey = null;
                $datakey = strval(self::searchForId($fineVal['dataPk'], $conData));
                if ($datakey == null) {
                    $finalData[] = $fineVal;
                } else {
                    if ($conData[$datakey]['Quantity'] > $fineVal['Quantity'] && $conData[$datakey]['Quantity'] != $fineVal['Quantity']) {
                        $finalData[] = $fineVal;
                    }
                }
            }
        }  else {
            $finalData = $tenderData;
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'productList' => $finalData,
        );
        return $result;
    }

    public static function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['dataPk'] === $id) {
                return $key;
            }
        }
        return null;
    }
    public static function searchForIdPS($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['ctpsm_cmsrqprodservdtls_fk'] === $id) {
                return $key;
            }
        }
        return null;
    }

    public function unmaplocationdata($reqpk) {
        if ($reqpk) {
            $model = CmsrqprodservdtlsTbl::find()->where("crpsd_shared_fk =:pk and crpsd_shared_type = 1", [':pk' => $reqpk])->one();
            if ($model) {
                $ip_address = Common::getIpAddress();
                $date = date('Y-m-d H:i:s');
                $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);

                $model->crpsd_deliv_mcmpld_fk = null;
                $model->crpsd_delivloctype = null;
                $model->crpsd_updatedon = $date;
                $model->crpsd_updatedby = $userPK;
                $model->crpsd_updatedbyipaddr = $ip_address;

                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Requisition Delivery Location Update Successfully!',
                        'data' => $model,
                    );
                } else {
                    $result = array(
                        'status' => 202,
                        'msg' => 'Requisition Delivery Location Update Failied!',
                        'data' => $model,
                    );
                }
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'Requisition Delivery Location Update Successfully!',
                    'data' => $model,
                );
            }
        }
        return $result;
    }

}
