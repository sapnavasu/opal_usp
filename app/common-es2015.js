(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["common"],{

/***/ "./src/app/modules/registartionapproval/approval.service.ts":
/*!******************************************************************!*\
  !*** ./src/app/modules/registartionapproval/approval.service.ts ***!
  \******************************************************************/
/*! exports provided: ApprovalService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ApprovalService", function() { return ApprovalService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");




let ApprovalService = class ApprovalService {
    constructor(http, httpc) {
        this.http = http;
        this.httpc = httpc;
        this._url = "apr/approval/";
    }
    fetchPaymentApprovalViewPageData(reqId) {
        return this.http.get(this._url + 'viewapproval' + '?reqId=' + reqId).map(res => res.json());
    }
    fetchSupplierListData() {
        return this.http.get(this._url + 'supplierdata').map(res => res.json());
    }
    statusChange(postdata) {
        return this.http.post(this._url + 'paymentstatuschange', postdata).map(res => res.json());
    }
    fetchProjectData(reqId) {
        return this.http.get(this._url + 'getprojectdetails' + '?memberRegPk=' + reqId).map(res => res.json());
    }
    resendInvoice(companyPk, regPk) {
        return this.http.get(this._url + 'resendinvoice' + '?companypk=' + companyPk + '&regpk=' + regPk).map(res => res.json());
    }
    resendReceipt(companyPk, regPk) {
        return this.http.get(this._url + 'resendreceipt' + '?companypk=' + companyPk + '&regpk=' + regPk).map(res => res.json());
    }
    paymtupdyestatusChange(value, postdata) {
        let body = JSON.stringify({ 'fdata': postdata, 'id': value });
        return this.http.post(this._url + 'updtepaymentstatuschange', body).map(res => res.json());
    }
    getcompdetails(regPk) {
        let body = JSON.stringify({ 'regpk': regPk });
        return this.http.post(this._url + 'getcompdetails', body).map(res => res.json());
    }
    getpaymenttracker(regPk) {
        let body = JSON.stringify({ 'regpk': regPk });
        return this.http.post(this._url + 'getpaymenttrackerinfo', body).map(res => res.json());
    }
    getsubpaymentdetails(invpk) {
        let body = JSON.stringify({ 'invpk': invpk });
        return this.http.post(this._url + 'getpaymentdetails', body).map(res => res.json());
    }
    deactivateordeletesupplier(data) {
        let body = JSON.stringify({ 'data': data });
        return this.http.post(this._url + 'deletedeactivatesupp', body).map(res => res.json());
    }
    deletesupplier(data) {
        let body = JSON.stringify({ 'data': data });
        return this.http.post(this._url + 'deletesupplier', body).map(res => res.json());
    }
    getrenewaldetails(regPk) {
        let body = JSON.stringify({ 'regpk': regPk });
        return this.http.post(this._url + 'getrenewaldtls', body).map(res => res.json());
    }
    checkforeignclassification(compPk) {
        const body = JSON.stringify({ comp: { compPk: compPk } });
        return this.http.post(this._url + 'checkforeignclassification', body).map(res => res.json());
    }
    getapprovaltemplate() {
        return this.http.get(this._url + 'getapprovaltemplate').map(res => res.json());
    }
    getstkdeletetemplate() {
        return this.http.get(this._url + 'getstkdeletetemplate').map(res => res.json());
    }
    getstkdeactivatetemplate() {
        return this.http.get(this._url + 'getstkdeactivatetemplate').map(res => res.json());
    }
    resendregconfirmation(regPk) {
        return this.http.get(this._url + 'resendregistrationconfirma' + '?registrationid=' + regPk).map(res => res.json());
    }
    changeUser(newAdminUserPk, regpk, userPk) {
        const body = JSON.stringify({ newAdminUserPk: newAdminUserPk, regpk: regpk, userPk: userPk });
        return this.http.post(this._url + 'changeuser', body).map(res => res.json());
    }
    gettrakerdetails(regPk, comppk) {
        return this.http.get(this._url + 'gettrakerdetails?id=' + regPk + '&sid=' + comppk).map(res => res.json());
    }
};
ApprovalService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"] },
    { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"] }
];
ApprovalService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
        providedIn: 'root'
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"]])
], ApprovalService);



/***/ }),

/***/ "./src/app/services/assessmentReport.service.ts":
/*!******************************************************!*\
  !*** ./src/app/services/assessmentReport.service.ts ***!
  \******************************************************/
/*! exports provided: AssessmentReportService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AssessmentReportService", function() { return AssessmentReportService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");



let AssessmentReportService = class AssessmentReportService {
    constructor(http) {
        this.http = http;
        this._url = 'ar/assessmentreport/';
    }
    getbatchdtls(id) {
        return this.http.get(this._url + 'getbatchdata?batchID=' + id).map(res => res.json());
    }
    getleanersdtls(id) {
        return this.http.get(this._url + 'getlearnersdata?batchID=' + id).map(res => res.json());
    }
    getleanerdata(id) {
        return this.http.get(this._url + 'getlearnerdata?id=' + id).map(res => res.json());
    }
    saveassessmentreport(data) {
        return this.http.post(this._url + 'saveassessmentreport', data).map(res => res.json());
    }
    getassessmentreport(id) {
        return this.http.get(this._url + 'getassessmentreport?id=' + id).map(res => res.json());
    }
    getlearnerstatus() {
        return this.http.get(this._url + 'getlearnerstatus').map(res => res.json());
    }
    savequalitycheckstatus(data) {
        return this.http.put(this._url + 'savequalitycheckstatus', data).map(res => res.json());
    }
    updatelearnerstatus(id) {
        return this.http.get(this._url + 'updatelearnerstatus?id=' + id).map(res => res.json());
    }
    getbatchdetails(batchNo) {
        return this.http.get(this._url + 'getbatchdetails?batchID=' + batchNo).map(res => res.json());
    }
    getassessordetails(batchNo) {
        return this.http.get(this._url + 'getassessordetails?batchNo=' + batchNo).map(res => res.json());
    }
    printcard(serialno, learnerid) {
        return this.http.get(this._url + 'generatecard?batchNo=' + serialno + '&learnerid=' + learnerid).map(res => res.json());
    }
};
AssessmentReportService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] }
];
AssessmentReportService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
        providedIn: 'root'
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])
], AssessmentReportService);



/***/ }),

/***/ "./src/app/services/batch.service.ts":
/*!*******************************************!*\
  !*** ./src/app/services/batch.service.ts ***!
  \*******************************************/
/*! exports provided: BatchService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "BatchService", function() { return BatchService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @app/remote.service */ "./src/app/remote.service.ts");



let BatchService = class BatchService {
    constructor(http) {
        this.http = http;
        this._url = 'bm/batchmanagement/';
    }
    getbatchdtls(regpk) {
        return this.http.get(this._url + 'get-batch-dtls?regPk=' + regpk).map(res => res.json());
    }
    getTrainingEvalutionCentres() {
        return this.http.get(this._url + 'get-tevalutioncentres').map(res => res.json());
    }
    getStdCourses() {
        return this.http.get(this._url + 'get-all-standard-courses').map(res => res.json());
    }
    getStdCoursesByAppPk(appPk) {
        return this.http.get(this._url + 'get-all-standard-courses-by-reg-pk?appPk=' + appPk).map(res => res.json());
    }
    getsubcatlistbycatpk(catPk) {
        return this.http.get(this._url + 'getsubcatlistbycatpk?catPk=' + catPk).map(res => res.json());
    }
    getCourseDtlsbysubcatpk(subcatpk) {
        return this.http.get(this._url + 'get-course-dtlsbysubcatpk?subcatpk=' + subcatpk).map(res => res.json());
    }
    checkassessoravailabilty(assdate, coursepk, languagepk) {
        let body = JSON.stringify({ assdate: assdate, coursepk: coursepk, languagepk: languagepk });
        return this.http.post(this._url + 'checkavailabilityassessor', body).map(res => res.json());
    }
    getBranchlistbyregpk(regPk) {
        return this.http.get(this._url + 'getbranchlistbyregpk?regpk=' + regPk).map(res => res.json());
    }
    getcatlist() {
        return this.http.get(this._url + 'getcatlist').map(res => res.json());
    }
    gettutorlist(regPk) {
        return this.http.get(this._url + 'get-tutors-list?regpk=' + regPk).map(res => res.json());
    }
    gettutoravailabilitylist(data) {
        console.log(data);
        return this.http.post(this._url + 'gettutoravailabilitylist', data).map(response => response.json());
    }
    getIVQAStaffByAssessor(pk) {
        return this.http.get(this._url + 'get-ivqastafflist?pk=' + pk).map(res => res.json());
    }
    getmasterlist() {
        return this.http.get(this._url + 'get-masters-list').map(res => res.json());
    }
    saveBatchData(formValue) {
        let body = JSON.stringify({ centerdtls: formValue });
        return this.http.post(this._url + 'savebatchdtls', body).map(response => response.json());
    }
    fetchBatchdetails(bid) {
        return this.http.get(this._url + 'fetch-batchdetails?bid=' + bid).map(res => res.json());
    }
    downloadattendance(data) {
        let body = JSON.stringify({ batchno: data });
        return this.http.post(this._url + 'downloadattendance', body).map(response => response.json());
    }
    ChangeBatchStatus(data, status, comments) {
        let body = JSON.stringify({ batchno: data, status: status, comments: comments });
        return this.http.post(this._url + 'change-batchstatus', body).map(response => response.json());
    }
};
BatchService.ctorParameters = () => [
    { type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"] }
];
BatchService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
        providedIn: 'root'
    }),
    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])
], BatchService);



/***/ })

}]);
//# sourceMappingURL=common-es2015.js.map