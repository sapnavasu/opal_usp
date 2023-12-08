<?php

namespace api\modules\pms\components;

use app\filters\auth\HttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\rbac\Permission;
use yii\web\Session;
use yii\db\ActiveRecord;
use common\components\Security;
use common\components\Common;
use api\modules\pms\models\CmstenderhdrTblQuery;
use api\modules\pms\models\CmstenderhdrtempTblQuery;
use api\modules\mst\models\TimezoneTbl;
use api\modules\bs\components\Internalsearch;

class Pms {

    public $lang = 'en';

    public function Requistionadd($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::addRequisition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function AddProductServic($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::AddProductServic($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function AddProductServictemp($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::AddProductServictemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getRequisitionProductList($reqPk, $checkmap, $ten_id, $type) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getRequisitionProductList($reqPk, $checkmap, $ten_id, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getProductList($reqPk, $type = 1) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getProductList($reqPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getProductListtemp($reqPk, $type = 1) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::getProductListtemp($reqPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getUserList($registerPk) {
        if (!empty($registerPk)) {
            return \common\models\UsermstTblQuery::getCompanyUserList($registerPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetProductData($proPk, $prodserpk='') {
        if (!empty($proPk)) {
            return \common\models\MemcompproddtlsTbl::GetProductData($proPk, $prodserpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetProductMstData($proPk) {
        if (!empty($proPk)) {
            return \api\modules\mst\models\ProductmstTblQuery::GetProductMstData($proPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetServiceMstData($proPk) {
        if (!empty($proPk)) {
            return \api\modules\mst\models\ServicemstTblQuery::GetServiceMstData($proPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetServiceData($servicePk, $prdserpk = '') {
        if (!empty($servicePk)) {
            return \common\models\MemcompservicedtlsTbl::getServiceDetails($servicePk, $prdserpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetSpecificationData($catPk, $productserivePk) {
        if (!empty($catPk)) {
            return \api\modules\pms\models\CmsrqprodservtrnxTblQuery::getspeclist($catPk, $productserivePk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateQuantity($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::UpdateQuantity($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateQuantitytemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::UpdateQuantitytemp($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateRequireddate($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::UpdateRequireddate($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateRequireddatetemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::UpdateRequireddatetemp($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getProjectBasedTenderArray($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getProjectBasedTenderArray($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function autoCreatProjectTender($formData) {
        if (!empty($formData)) {
            return \api\modules\pd\models\ProjectdtlsTblQuery::autoCreatProjectTender($formData);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateMeasurement($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::UpdateMeasurement($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function UpdateMeasurementtemp($proservicePk, $value) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::UpdateMeasurementtemp($proservicePk, $value);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetUserDefSpecmst($catPk, $type) {
        if (!empty($catPk)) {
            return \api\modules\mst\models\SpecificationmstTblQuery::GetUserDefSpecmst($catPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function Deletemapspec($spctblpk) {
        if (!empty($spctblpk)) {
            return \api\modules\pms\models\CmsrqprodservtrnxTblQuery::Deletemapspec($spctblpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getWikiImage($dataName) {
        if (!empty($dataName)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getWikiImage($dataName);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function DeleteProService($proservicePk) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::DeleteProService($proservicePk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function DeleteProServicetemp($proservicePk) {
        if (!empty($proservicePk)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::DeleteProServicetemp($proservicePk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getCompanyList($searchData) {
        if (!empty($searchData)) {
            return \common\models\MembercompanymstTblQuery::getCompanyList($searchData);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getChechkinEntity($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::getChechkinEntity($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetLocationData($location_pk) {
        if (!empty($location_pk)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::GetLocationData($location_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getLocationDataByPk($location_pk) {
        if (!empty($location_pk)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::getLocationDataByPk($location_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function unmaplocationdata($req_pk) {
        if (!empty($req_pk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::unmaplocationdata($req_pk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getDepartmentList($compPk) {
        if (!empty($compPk)) {
            return \common\models\DepartmentmstTblQuery::getDepartmentList($compPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getdisicplinelist($compPk) {
        if (!empty($compPk)) {
            return \app\models\CmsdisciplinedtlsTblQuery::getdisicplinelist($compPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getcostcentrelist($compPk) {
        if (!empty($compPk)) {
            return \app\models\CmscostcenterdtlsTblQuery::getcostcentrelist($compPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getReqData($reqPk) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getReqData($reqPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getreqlistdata($reqPks) {
        if (!empty($reqPks)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getrequisitionlistbyids($reqPks);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getProject() {
        return \api\modules\pd\models\ProjectdtlsTblQuery::getApprovedProjectList();
    }

    public function getProjectList() {
        return \api\modules\pd\models\ProjectdtlsTblQuery::getProjectList();
    }

    public function mapproject($formdata) {
        return \api\modules\pd\models\ProjectdtlsTblQuery::mapproject($formdata);
    }
    
    public function getRecentlyViewed() {
        return \common\models\BizsearchhstyTblQuery::getRecentlyViewed();
    }
    
    public function getOverallProject() {
        return \api\modules\pd\models\ProjectdtlsTblQuery::getOverallProject();
    }

    public function getUnitMasterData() {
        return \api\modules\mst\models\UnitmstTblQuery::getUnitMasterData();
    }

    public function getSupplierList($searchkey) {
        if (!empty($searchkey)) {
            return \api\modules\mst\models\MembercompanymstTblQuery::getSupplierList($searchkey);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetViewRFIdata($tenderHeaderPk) {
        if (!empty($tenderHeaderPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::GetViewRFIdata($tenderHeaderPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetViewRFPdata($tenderHeaderPk) {
        if (!empty($tenderHeaderPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::GetViewRFPdata($tenderHeaderPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetViewPQdata($tenderHeaderPk) {
        if (!empty($tenderHeaderPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::GetViewPQdata($tenderHeaderPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getViewContractsData($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getViewContractsData($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSubCountData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getSubCountData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getAwarderDetails($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::getAwarderDetails($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContractorData($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getContractorData($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getProjectBasedContractor($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getProjectBasedContractor($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getAwardIssued($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getAwardIssued($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getObligatedEnquiries($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getObligatedEnquiries($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getTotalRequisition($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getTotalRequisition($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getTenderCount($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getTenderCount($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getPendingEvaluation($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getPendingEvaluation($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getIssuedEnquiries($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getIssuedEnquiries($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetViewEOIdata($tenderHeaderPk) {
        if (!empty($tenderHeaderPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::GetViewEOIdata($tenderHeaderPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetProjectData($proPk) {
        if (!empty($proPk)) {
            return \api\modules\pd\models\ProjectdtlsTblQuery::GetProjectData($proPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetProjectreqData($proPk) {
        if (!empty($proPk)) {
            return \api\modules\pd\models\ProjectdtlsTblQuery::GetProjectreqData($proPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function GetTenderDataArray($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::GetTenderDataArray($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getActiverfxCount($reqPk, $type) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getActiverfxCount($reqPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    } 

    public function getCategoryList() {
        return c::GetTenderDataArray($data);
    }

    public function getReqUserList() {
        return \common\models\UsermstTblQuery::getReqUserList();
    }

    public function GetReqProductData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::GetReqProductData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getViewProductData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getViewProductList($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getViewProductDatalisting($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::getViewProductList($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getViewProductDatatemp($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrqprodservdtlstempTblQuery::getProductListtemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getRFIListData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getRFIListData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function agreementList($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmscontractagreementhdrTblQuery::agreementList($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function getContractListData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getContractListData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getManageListing($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getManageListing($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getEOIListData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getEOIListData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function rfiadd($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::addRequisition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function restrictAwardingContract($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsawardfeependingTblQuery::restrictAwardingContract($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfiData($tenPk, $type) {
        if (!empty($tenPk)) {
            return CmstenderhdrTblQuery::getrfidata($tenPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfidatafortender($tenPk, $type) {
        if (!empty($tenPk)) {
            return CmstenderhdrTblQuery::getrfidatafortender($tenPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfidatafortendertemp($tenPk, $type) {
        if (!empty($tenPk)) {
            return CmstenderhdrtempTblQuery::getrfidatafortender($tenPk, $type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfxdatafortender($tenPk, $type, $page, $perpage, $sortorder) {
        if (!empty($tenPk) && !empty($type)) {
            return CmstenderhdrTblQuery::getrfxdatafortender($tenPk, $type, $page, $perpage, $sortorder);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfxdatafortendertemp($tenPk, $type, $page, $perpage, $sortorder) {
        if (!empty($tenPk) && !empty($type)) {
            return CmstenderhdrtempTblQuery::getrfxdatafortendertemp($tenPk, $type, $page, $perpage, $sortorder);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfxdatafortendercount($tenPk) {
        if (!empty($tenPk)) {
            return CmstenderhdrTblQuery::getrfxdatafortendercount($tenPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrfxdatafortendercounttemp($tenPk) {
        if (!empty($tenPk)) {
            return CmstenderhdrtempTblQuery::getrfxdatafortendercounttemp($tenPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function gettimezones() {
        $timezones = TimezoneTbl::getTimeZonesList();
        if ($timezones) {
            return $timezones;
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deletereqproduct($reqprodids) {
        if ($reqprodids) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::deletereqprodlist($reqprodids);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Product Id to delete', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deletereqaddinfo($addinfopk) {
        if ($addinfopk) {
            return \api\modules\pms\models\CmsaddinfodtlsTblQuery::deletereqaddinfo($addinfopk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Product Id to delete', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deletetenquiry($tenpk) {
        if ($tenpk) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::deletetenquiry($tenpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Enquiry Id to delete', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deletetenquirytemp($tenpk) {
        if ($tenpk) {
            return \api\modules\pms\models\CmstenderhdrtempTblQuery::deletetenquirytemp($tenpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Enquiry Id to delete', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function mapreqproduct($data, $tenPk) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderpsmapTblQuery::mapreqproduct($data, $tenPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function addquestionnarie($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsquestionnaireformTblQuery::addquestionnarie($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function addquestionnarietemp($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsquestionnaireformtempTblQuery::addquestionnarietemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getexistingquestion($data) {
        if ($data) {
            return \api\modules\pms\models\CmsquestionnaireformTblQuery::getexistingquestion($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getexistingquestiontemp($data) {
        if ($data) {
            return \api\modules\pms\models\CmsquestionnaireformtempTblQuery::getexistingquestiontemp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getexistingquestionnarietmp($data) {
        if ($data) {
            return \api\modules\pms\models\CmsquestionnairetmplformTblQuery::getexistingquestionnarietmp($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deletequestionnarie($data) {
        if ($data) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::deletequestionnarie($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getBizSearchData($searchType, $criteriaType, $searchKey, $searchFrom, $triggerFrom, $searchPage, $searchSort, $filterSrh = '') {
        switch ($searchType) {
            case '1': // Internal Search
                $finalQuery = self::internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh);
                break;
            case '2': // Domain Search
                // $finalQuery = Domainsearch::domainSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh);
                break;
        }

        if ($triggerFrom == 1) {
            $pageSize = 2;
            $page = 0;
        } else {
            $pageSize = (isset($_REQUEST['pageSize']) && $_REQUEST['pageSize'] > 0) ? $_REQUEST['pageSize'] : '10';
            $page = ($searchPage > 0) ? $searchPage : '0';
        }

        $searchProvider = new ActiveDataProvider([
            'query' => $finalQuery,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $page
            ]
        ]);

        $searchRes['data'] = $providerData = $searchProvider->getModels();

        if ($searchType == 1) {
            if ($criteriaType == 3) { // Business Unit
                $businessUnitArr = [];
                foreach ($providerData as $key => $businessUnit) {
                    $businessUnitArr[$key] = $businessUnit;
                    $userCount = Internalsearch::businessUnitUserCount($businessUnit['bUnitPk']);
                    $businessUnitArr[$key]['userCount'] = (isset($userCount['userCount']) && ($userCount['userCount'] > 0)) ? $userCount['userCount'] : 0;
                }

                $searchRes['data'] = $businessUnitArr;
            } elseif ($criteriaType == 5 || $criteriaType == 6) { // Product & Service
                $searchData = [];
                foreach ($providerData as $key => $pdtSerData) {
                    $driveImg = Drive::generateUrl($pdtSerData['imagePK'], 1, 1);
                    $searchData[$key] = $pdtSerData;
                    $searchData[$key]['coverImg'] = $driveImg;
                }
                $searchRes['data'] = $searchData;
            }
        }

        $searchRes['totalcount'] = $searchProvider->getTotalCount();
        $searchRes['size'] = 10;
        $searchRes['page'] = 1;

        return $searchRes;
    }

    public function internalSearch($criteriaType, $searchKey, $searchFrom, $searchSort, $filterSrh = '') {
        switch ($criteriaType) {
            case '2': // Users
                $finalQuery = Internalsearch::userSearch($searchKey, $searchSort, $filterSrh);
                break;
            case '3': // Business Unit
                $finalQuery = Internalsearch::bunitSearch($searchKey, $searchSort, $filterSrh);
                break;
            case '4': // Monitor Logs
                $finalQuery = Internalsearch::monitorLogSearch($searchKey, $searchSort, $filterSrh);
                break;
            case '5': // Products
                $finalQuery = Internalsearch::productSearch($searchKey, $searchSort, $filterSrh);
                break;
            case '6': // Services
                $finalQuery = Internalsearch::serviceSearch($searchKey, $searchSort, $filterSrh);
                break;
            case '7': // Market Presence
                $finalQuery = Internalsearch::marketPresenceSearch($searchKey, $searchSort, $filterSrh);
                break;
        }

        return $finalQuery;
    }
    public function GetContractData($reqPk,$contractPk) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::GetContractData($reqPk,$contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getNonJsrsSupplierData($supplierPk) {
        if (!empty($supplierPk)) {
            return \api\modules\pms\models\CmsnonjsrssupmapTblQuery::getNonJsrsSupplierData($supplierPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function GetSupplierData($supplierPk) {
        if (!empty($supplierPk)) {
            return \api\modules\mst\models\MembercompanymstTblQuery::GetSupplierData($supplierPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function DeleteScopProduct($deletePk) {
        if (!empty($deletePk)) {
            return \api\modules\pms\models\CmstenderpsmapTblQuery::DeleteScopProduct($deletePk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function GetSupplierUserData($supplierPk) {
        if (!empty($supplierPk)) {
            return \common\models\UsermstTblQuery::GetSupplierUserData($supplierPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getFormArrayData($type) {
        if (!empty($type)) {
            return \api\modules\pms\models\CmstnchdrTblQuery::GetSupplierUserData($type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitTerms($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::submitTerms($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitTermstemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmspaymenttermstempTblQuery::submitTermstemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getAwardedtoArray($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::getAwardedtoArray($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getRFTData($reqPk,$dataType) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getRFTData($reqPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getRFTDataPk($quotPk) {
        if (!empty($quotPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getRFTDataPk($quotPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getRFTDataArray($reqPk) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getRFTDataArray($reqPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getQuotationArray($quotPk) {
        if (!empty($quotPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getQuotationArray($quotPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getQuotationData($quotPk) {
        if (!empty($quotPk)) {
            return \api\modules\quot\models\CmsquotationhdrTblQuery::getQuotationData($quotPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSubmitedContractor($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::getAwardedtoArray($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getAgreement($dataVal) {
        if (!empty($dataVal)) {
            return \api\modules\pms\models\CmscontractagreementhdrTblQuery::getAgreement($dataVal);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveSupportingDocument($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmssupdocumentTblQuery::saveSupportingDocument($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveSupportingDocumenttemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmssupdocumenttempTblQuery::saveSupportingDocumenttemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContractProduct($reqPk,$contractPk,$dataType,$quotselectPk) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getContractProduct($reqPk,$contractPk,$dataType,$quotselectPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getViewProductServiceData($dataVal) {
        if (!empty($dataVal)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getViewProductServiceData($dataVal);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getTenderPSCharges($contractPk,$dataType) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmstenderpschargesTblQuery::getTenderPSCharges($contractPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteTenderPScharges($dataPK) {
        if (!empty($dataPK)) {
            return \api\modules\pms\models\CmstenderpschargesTblQuery::deleteTenderPScharges($dataPK);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getTermsCondition($sharedFk,$type) {
        if (!empty($sharedFk)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::getTermsCondition($sharedFk,$type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getTermsConditiontemp($sharedFk,$type) {
        if (!empty($sharedFk)) {
            return \api\modules\pms\models\CmspaymenttermstempTblQuery::getTermsConditiontemp($sharedFk,$type);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContractProductChk($reqPk) {
        if (!empty($reqPk)) {
            return \api\modules\pms\models\CmsrqprodservdtlsTblQuery::getContractProductChk($reqPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getAutocompleteArray($companypk) {
        if (!empty($companypk)) {
            return \api\modules\pms\models\CmspaymenttermsTblQuery::getAutocompleteArray($companypk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSupplierCreatStatus($regPk) {
        if (!empty($regPk)) {
            return \common\models\MemberregistrationmstTbl::getSupplierCreatStatus($regPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getProjectArray($regPk) {
        if (!empty($regPk)) {
            return \api\modules\pd\models\ProjectdtlsTblQuery::getProjectArray($regPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContractArray($comPk) {
        if (!empty($comPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getContractArray($comPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getCurrencyArray() {
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'currency';
            
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = \api\modules\mst\models\CurrencymstTblQuery::getCurrencyCacheQuery();
                $data = \api\modules\mst\models\CurrencymstTblQuery::getCurrencyArray();
                $cache->store($cacheKey, $data, $duration = 0 , $cacheQuery);
            } else {
                $data = $cache->retreive($cacheKey);
            }
        } catch(\Exception $e){
            $data = \api\modules\mst\models\CurrencymstTblQuery::getCurrencyArray();
        }
       
        return $data;
    }
    
    public function getPrimarySupplierArray() {
            return \api\modules\pms\models\CmscontractagreementdtlsTblQuery::getPrimarySupplierArray();
    }
    public function getLocationArray() {
            return \api\modules\mst\models\CountrymstTblQuery::countrylist();
    }
    public function getAwardedtoCompArray() {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::getAwardedtoCompArray();
    }
    public function getstatistics() {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getstatistics();
    }
    public function submitScope($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveScope($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitScopeOnline($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::submitScopeOnline($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveContractInfo($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveContractInfo($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitSupplierForm($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsnonjsrssupdtlsTblQuery::submitSupplierForm($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitContractCard($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::submitContractCard($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitCardStatus($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::submitCardStatus($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveOfflineAgreement($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontractagreementhdrTblQuery::saveOfflineAgreement($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function SubmitDynamicForm($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmstnctrnxTblQuery::SubmitDynamicForm($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function SubmitDynamicFormtemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmstnctrnxtempTblQuery::SubmitDynamicFormtemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getDynamicList($sharedFk,$dataType,$formType) {
        if (!empty($sharedFk)) {
            return \api\modules\pms\models\CmstnctrnxTblQuery::getDynamicViewList($sharedFk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getDynamicListtemp($sharedFk,$dataType,$formType) {
        if (!empty($sharedFk)) {
            return \api\modules\pms\models\CmstnctrnxtempTblQuery::getDynamicViewListtemp($sharedFk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getDynamicViewList($sharedFk,$dataType,$formType) {
        if (!empty($sharedFk)) {
            return \api\modules\pms\models\CmstnctrnxTblQuery::getDynamicViewList($sharedFk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveNotifyUser($contractPk,$userPk,$dataType) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveNotifyUser($contractPk,$userPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function SaveAwardedTo($formdata,$dataType,$primeryPk,$secondaryPk) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::SaveAwardedTo($formdata,$dataType,$primeryPk,$secondaryPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveSubcontractRule($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveSubcontractRule($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function SaveContractorICVCommitement($formdata) {

        //print_r($formdata);die();

        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveContractorICVCommitement($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function Updateicvcommitementvalue($formdata) {

        //print_r($formdata);die();

        if (!empty($formdata)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::updateicvcommitementvalue($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function GetIcvStatus($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getIcvStatus($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function chkLccStatus($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::chkLccStatus($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getNotifyUserArray($userPk) {
        if (!empty($userPk)) {
            return \common\models\UsermstTblQuery::getNotifyUserArray($userPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSupplierDocumentList($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmssuppdocreqlisthdrTblQuery::getSupplierDocumentViewList($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSupplierDocumentListtemp($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmssuppdocreqlisthdrtempTblQuery::getSupplierDocumentViewListtemp($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSupplierDocumentViewList($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmssuppdocreqlisthdrTblQuery::getSupplierDocumentViewList($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getInspectionRequirenmentList($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmsinspreqdochdrTblQuery::getInspectionRequirenmentViewList($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getInspectionRequirenmentListtemp($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmsinspreqdochdrtempTblQuery::getInspectionRequirenmentViewListtemp($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContatData($dataPk,$dataType) {
        if (!empty($dataPk)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::getContatData($dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContactAfterSave($sharedfk) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::getContactAfterSave($sharedfk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getContatDataArray($companyPk,$dataType) {
        if (!empty($companyPk)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::getContatDataArray($companyPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getInspectionRequirenmentViewList($sharedfk,$dataType,$formType) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmsinspreqdochdrTblQuery::getInspectionRequirenmentViewList($sharedfk,$dataType,$formType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteDynamicData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmstnctrnxTblQuery::deleteDynamicData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteDynamicDatatemp($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmstnctrnxtempTblQuery::deleteDynamicDatatemp($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteContactData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::deleteContactData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteInspecationData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsinspreqdocdtlsTblQuery::deleteInspecationData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteInspecationDatatemp($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsinspreqdocdtlstempTblQuery::deleteInspecationData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteAwarded($contractPk,$dataPk,$dataType) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmsawarddtlsTblQuery::deleteAwarded($contractPk,$dataPk,$dataType);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteiInspecationMapData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmsinspreqdocactionmapTblQuery::deleteiInspecationMapData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteSupplierDocumentData($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmssuppdocreqlistdtlsTblQuery::deleteSupplierDocumentData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function deleteSupplierDocumentDatatemp($dataPk) {
        if (!empty($dataPk)) {
            return \api\modules\pms\models\CmssuppdocreqlistdtlstempTblQuery::deleteSupplierDocumentData($dataPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitSupplierDocument($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmssuppdocreqlisthdrTblQuery::submitSupplierDocument($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitSupplierDocumenttemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmssuppdocreqlisthdrtempTblQuery::submitSupplierDocumenttemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveContactData($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pd\models\MemcompmplocationdtlsTblQuery::saveContactData($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveConsigneeNotifyingParty($sharedfk,$consigneePk,$notifyingpartyPk) {
        if (!empty($sharedfk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::saveContactData($sharedfk,$consigneePk,$notifyingpartyPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveInspectionReq($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsinspreqdochdrTblQuery::saveInspectionReq($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function saveInspectionReqtemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsinspreqdochdrtempTblQuery::saveInspectionReqtemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function updateInspectionReq($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsinspreqdochdrTblQuery::updateInspectionReq($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function updateInspectionReqtemp($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmsinspreqdochdrtempTblQuery::updateInspectionReqtemp($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function supportDocumentSave($formdata) {
        if (!empty($formdata)) {
            return \api\modules\pms\models\CmssupdocumentTblQuery::supportDocumentSave($formdata);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function submitContractFinalSave($contractPk) {
        if (!empty($contractPk)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::submitContractFinalSave($contractPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getActivityNoArray() {
            return \api\modules\pms\models\CmsinspreqdocdtlsTblQuery::getActivityNoArray();
    }
    public function getIncorpStyleList($countryPK) {
        if (!empty($countryPK)) {
            return \common\models\IncorpstylemstTbl::getIncorpStyleList($countryPK);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getSupplierListAwardedTo($tenderPk) {
        if (!empty($tenderPk)) {
            return \common\models\MemberregistrationmstTbl::getSupplierListAwardedTo($tenderPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }            
    }
    public function getDocumentCategory() {
            return \api\modules\pms\models\CmssdrldoccatTblQuery::getDocumentCategory();
    }

    public function getDocumentCategorytemp() {
        return \api\modules\pms\models\CmssdrldoccattempTblQuery::getDocumentCategory();
    }
    public function getDocumentCode($dataVal) {
        if (!empty($dataVal)) {
            return \api\modules\pms\models\CmssdrldoccatTblQuery::getDocumentCode($dataVal);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getDocumentCodeTemp($dataVal) {
        if (!empty($dataVal)) {
            return \api\modules\pms\models\CmssdrldoccattempTblQuery::getDocumentCode($dataVal);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getrequisitionlist($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getrequisitionlist($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
	    }
	}
    public function getRfxList() {
        $request_body = file_get_contents('php://input');
        $data =	json_decode($request_body, true);
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getRfxList($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getFilterDynamicData($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::getFilterDynamicData($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function Rfxpreferencelist() {
        return \api\models\CmsrfxpreferencehdrTblQuery::Rfxpreferencelist();        
    }

    public function Removerfxpreference($reqPk) {
        if($reqPk) {
            return \api\models\CmsrfxpreferencehdrTblQuery::Removerfxpreference($reqPk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }       
    }

    public function Saverfxpreference($data) {
        if (!empty($data)) {
            return \api\models\CmsrfxpreferencehdrTblQuery::Saverfxpreference($data);
        }
    }
    
    public function addtenderdetails($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::addtenderdetails($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function deleterequisition($reqpk) {
        if (!empty($reqpk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::deleterequisition($reqpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function submitrequisition($reqpk) {
        if (!empty($reqpk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::submitrequisition($reqpk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    public function getfilterdeptlist($companypk) {
        if (!empty($companypk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getfilterdeptlist($companypk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function addquicktender($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::addquicktender($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function deletetender($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::deleterequisition($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function checkduplicaterefid($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::checkduplicaterefid($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    } 

    public function checkduplicaterfxrefid($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::checkduplicaterfxrefid($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    } 

    public function getTenderClosureReport($tendernoticepk) {
        if (!empty($tendernoticepk)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getClosureReport($tendernoticepk);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getTenderRfx($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getTenderRfx($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function getReqContractAwards($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::getReqContractAwards($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function changestatus($ten_id, $status) {
        if (!empty($ten_id) && !empty($status)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::changestatus($ten_id, $status);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function changestatustemp($ten_id, $status, $comments) {
        if (!empty($ten_id) && !empty($status)) {
            return \api\modules\pms\models\CmstenderhdrtempTblQuery::changestatustemp($ten_id, $status, $comments);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function chkValidRefNumber($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmscontracthdrTblQuery::chkValidRefNumber($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }

    public function downloadTenderClosureReport($data) {
        if (!empty($data)) {
            return \api\modules\pms\models\CmsrequisitionformdtlsTblQuery::downloadClosureReport($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    } 

    public function rfxrepublish($rfx_id) { 
        if (!empty($rfx_id)) {
            return \api\modules\pms\models\CmstenderhdrTblQuery::rfxrepublish($rfx_id);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function getGroupCategory() {
        return \app\models\CmsgroupcatmstTblQuery::getGroupCategory();
    }
    
    public function getMainCategory($value) {
            return \app\models\CmsmaincatmstTblQuery::getMainCategory($value);
    }
    public function getSubCategory($value) {
            return \app\models\CmssubcatmstTblQuery::getSubCategory($value);
    }
     public function saveContractCategory($data) {
        if (!empty($data)) {
            return \app\models\CmsgroupcatdtlsTblQuery::saveGrpCategory($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
     public function getICVEnable($data) {
        if (!empty($data)) {
            return CmstenderhdrTblQuery::getICVEnable($data);
        } else {
            return ['msg' => 'warning', 'comments' => 'No Data', 'code' => 'ERR001', 'status' => false];
        }
    }
    
    public function getselectedCategory($contractpk) {
        return \app\models\CmsgroupcatdtlsTblQuery::getselectedCategory($contractpk);
    }
} 