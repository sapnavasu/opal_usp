function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["common"], {
  /***/
  "./src/app/modules/registartionapproval/approval.service.ts":
  /*!******************************************************************!*\
    !*** ./src/app/modules/registartionapproval/approval.service.ts ***!
    \******************************************************************/

  /*! exports provided: ApprovalService */

  /***/
  function srcAppModulesRegistartionapprovalApprovalServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "ApprovalService", function () {
      return ApprovalService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");

    var ApprovalService = /*#__PURE__*/function () {
      function ApprovalService(http, httpc) {
        _classCallCheck(this, ApprovalService);

        this.http = http;
        this.httpc = httpc;
        this._url = "apr/approval/";
      }

      _createClass(ApprovalService, [{
        key: "fetchPaymentApprovalViewPageData",
        value: function fetchPaymentApprovalViewPageData(reqId) {
          return this.http.get(this._url + 'viewapproval' + '?reqId=' + reqId).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "fetchSupplierListData",
        value: function fetchSupplierListData() {
          return this.http.get(this._url + 'supplierdata').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "statusChange",
        value: function statusChange(postdata) {
          return this.http.post(this._url + 'paymentstatuschange', postdata).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "fetchProjectData",
        value: function fetchProjectData(reqId) {
          return this.http.get(this._url + 'getprojectdetails' + '?memberRegPk=' + reqId).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "resendInvoice",
        value: function resendInvoice(companyPk, regPk) {
          return this.http.get(this._url + 'resendinvoice' + '?companypk=' + companyPk + '&regpk=' + regPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "resendReceipt",
        value: function resendReceipt(companyPk, regPk) {
          return this.http.get(this._url + 'resendreceipt' + '?companypk=' + companyPk + '&regpk=' + regPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "paymtupdyestatusChange",
        value: function paymtupdyestatusChange(value, postdata) {
          var body = JSON.stringify({
            'fdata': postdata,
            'id': value
          });
          return this.http.post(this._url + 'updtepaymentstatuschange', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getcompdetails",
        value: function getcompdetails(regPk) {
          var body = JSON.stringify({
            'regpk': regPk
          });
          return this.http.post(this._url + 'getcompdetails', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getpaymenttracker",
        value: function getpaymenttracker(regPk) {
          var body = JSON.stringify({
            'regpk': regPk
          });
          return this.http.post(this._url + 'getpaymenttrackerinfo', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getsubpaymentdetails",
        value: function getsubpaymentdetails(invpk) {
          var body = JSON.stringify({
            'invpk': invpk
          });
          return this.http.post(this._url + 'getpaymentdetails', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "deactivateordeletesupplier",
        value: function deactivateordeletesupplier(data) {
          var body = JSON.stringify({
            'data': data
          });
          return this.http.post(this._url + 'deletedeactivatesupp', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "deletesupplier",
        value: function deletesupplier(data) {
          var body = JSON.stringify({
            'data': data
          });
          return this.http.post(this._url + 'deletesupplier', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getrenewaldetails",
        value: function getrenewaldetails(regPk) {
          var body = JSON.stringify({
            'regpk': regPk
          });
          return this.http.post(this._url + 'getrenewaldtls', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "checkforeignclassification",
        value: function checkforeignclassification(compPk) {
          var body = JSON.stringify({
            comp: {
              compPk: compPk
            }
          });
          return this.http.post(this._url + 'checkforeignclassification', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getapprovaltemplate",
        value: function getapprovaltemplate() {
          return this.http.get(this._url + 'getapprovaltemplate').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getstkdeletetemplate",
        value: function getstkdeletetemplate() {
          return this.http.get(this._url + 'getstkdeletetemplate').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getstkdeactivatetemplate",
        value: function getstkdeactivatetemplate() {
          return this.http.get(this._url + 'getstkdeactivatetemplate').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "resendregconfirmation",
        value: function resendregconfirmation(regPk) {
          return this.http.get(this._url + 'resendregistrationconfirma' + '?registrationid=' + regPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "changeUser",
        value: function changeUser(newAdminUserPk, regpk, userPk) {
          var body = JSON.stringify({
            newAdminUserPk: newAdminUserPk,
            regpk: regpk,
            userPk: userPk
          });
          return this.http.post(this._url + 'changeuser', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "gettrakerdetails",
        value: function gettrakerdetails(regPk, comppk) {
          return this.http.get(this._url + 'gettrakerdetails?id=' + regPk + '&sid=' + comppk).map(function (res) {
            return res.json();
          });
        }
      }]);

      return ApprovalService;
    }();

    ApprovalService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"]
      }];
    };

    ApprovalService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"]])], ApprovalService);
    /***/
  },

  /***/
  "./src/app/services/assessmentReport.service.ts":
  /*!******************************************************!*\
    !*** ./src/app/services/assessmentReport.service.ts ***!
    \******************************************************/

  /*! exports provided: AssessmentReportService */

  /***/
  function srcAppServicesAssessmentReportServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "AssessmentReportService", function () {
      return AssessmentReportService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");

    var AssessmentReportService = /*#__PURE__*/function () {
      function AssessmentReportService(http) {
        _classCallCheck(this, AssessmentReportService);

        this.http = http;
        this._url = 'ar/assessmentreport/';
      }

      _createClass(AssessmentReportService, [{
        key: "getbatchdtls",
        value: function getbatchdtls(id) {
          return this.http.get(this._url + 'getbatchdata?batchID=' + id).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getleanersdtls",
        value: function getleanersdtls(id) {
          return this.http.get(this._url + 'getlearnersdata?batchID=' + id).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getleanerdata",
        value: function getleanerdata(id) {
          return this.http.get(this._url + 'getlearnerdata?id=' + id).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "saveassessmentreport",
        value: function saveassessmentreport(data) {
          return this.http.post(this._url + 'saveassessmentreport', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getassessmentreport",
        value: function getassessmentreport(id) {
          return this.http.get(this._url + 'getassessmentreport?id=' + id).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getlearnerstatus",
        value: function getlearnerstatus() {
          return this.http.get(this._url + 'getlearnerstatus').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "savequalitycheckstatus",
        value: function savequalitycheckstatus(data) {
          return this.http.put(this._url + 'savequalitycheckstatus', data).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatelearnerstatus",
        value: function updatelearnerstatus(id) {
          return this.http.get(this._url + 'updatelearnerstatus?id=' + id).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getbatchdetails",
        value: function getbatchdetails(batchNo) {
          return this.http.get(this._url + 'getbatchdetails?batchID=' + batchNo).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getassessordetails",
        value: function getassessordetails(batchNo) {
          return this.http.get(this._url + 'getassessordetails?batchNo=' + batchNo).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "printcard",
        value: function printcard(serialno, learnerid) {
          return this.http.get(this._url + 'generatecard?batchNo=' + serialno + '&learnerid=' + learnerid).map(function (res) {
            return res.json();
          });
        }
      }]);

      return AssessmentReportService;
    }();

    AssessmentReportService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]
      }];
    };

    AssessmentReportService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])], AssessmentReportService);
    /***/
  },

  /***/
  "./src/app/services/batch.service.ts":
  /*!*******************************************!*\
    !*** ./src/app/services/batch.service.ts ***!
    \*******************************************/

  /*! exports provided: BatchService */

  /***/
  function srcAppServicesBatchServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "BatchService", function () {
      return BatchService;
    });
    /* harmony import */


    var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(
    /*! tslib */
    "./node_modules/tslib/tslib.es6.js");
    /* harmony import */


    var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(
    /*! @angular/core */
    "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");

    var BatchService = /*#__PURE__*/function () {
      function BatchService(http) {
        _classCallCheck(this, BatchService);

        this.http = http;
        this._url = 'bm/batchmanagement/';
      }

      _createClass(BatchService, [{
        key: "getbatchdtls",
        value: function getbatchdtls(regpk) {
          return this.http.get(this._url + 'get-batch-dtls?regPk=' + regpk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getTrainingEvalutionCentres",
        value: function getTrainingEvalutionCentres() {
          return this.http.get(this._url + 'get-tevalutioncentres').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getStdCourses",
        value: function getStdCourses() {
          return this.http.get(this._url + 'get-all-standard-courses').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getStdCoursesByAppPk",
        value: function getStdCoursesByAppPk(appPk) {
          return this.http.get(this._url + 'get-all-standard-courses-by-reg-pk?appPk=' + appPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getsubcatlistbycatpk",
        value: function getsubcatlistbycatpk(catPk) {
          return this.http.get(this._url + 'getsubcatlistbycatpk?catPk=' + catPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getCourseDtlsbysubcatpk",
        value: function getCourseDtlsbysubcatpk(subcatpk) {
          return this.http.get(this._url + 'get-course-dtlsbysubcatpk?subcatpk=' + subcatpk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "checkassessoravailabilty",
        value: function checkassessoravailabilty(assdate, coursepk, languagepk) {
          var body = JSON.stringify({
            assdate: assdate,
            coursepk: coursepk,
            languagepk: languagepk
          });
          return this.http.post(this._url + 'checkavailabilityassessor', body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getBranchlistbyregpk",
        value: function getBranchlistbyregpk(regPk) {
          return this.http.get(this._url + 'getbranchlistbyregpk?regpk=' + regPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getcatlist",
        value: function getcatlist() {
          return this.http.get(this._url + 'getcatlist').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "gettutorlist",
        value: function gettutorlist(regPk) {
          return this.http.get(this._url + 'get-tutors-list?regpk=' + regPk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "gettutoravailabilitylist",
        value: function gettutoravailabilitylist(data) {
          console.log(data);
          return this.http.post(this._url + 'gettutoravailabilitylist', data).map(function (response) {
            return response.json();
          });
        }
      }, {
        key: "getIVQAStaffByAssessor",
        value: function getIVQAStaffByAssessor(pk) {
          return this.http.get(this._url + 'get-ivqastafflist?pk=' + pk).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "getmasterlist",
        value: function getmasterlist() {
          return this.http.get(this._url + 'get-masters-list').map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "saveBatchData",
        value: function saveBatchData(formValue) {
          var body = JSON.stringify({
            centerdtls: formValue
          });
          return this.http.post(this._url + 'savebatchdtls', body).map(function (response) {
            return response.json();
          });
        }
      }, {
        key: "fetchBatchdetails",
        value: function fetchBatchdetails(bid) {
          return this.http.get(this._url + 'fetch-batchdetails?bid=' + bid).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "downloadattendance",
        value: function downloadattendance(data) {
          var body = JSON.stringify({
            batchno: data
          });
          return this.http.post(this._url + 'downloadattendance', body).map(function (response) {
            return response.json();
          });
        }
      }, {
        key: "ChangeBatchStatus",
        value: function ChangeBatchStatus(data, status, comments) {
          var body = JSON.stringify({
            batchno: data,
            status: status,
            comments: comments
          });
          return this.http.post(this._url + 'change-batchstatus', body).map(function (response) {
            return response.json();
          });
        }
      }]);

      return BatchService;
    }();

    BatchService.ctorParameters = function () {
      return [{
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]
      }];
    };

    BatchService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_remote_service__WEBPACK_IMPORTED_MODULE_2__["RemoteService"]])], BatchService);
    /***/
  }
}]);
//# sourceMappingURL=common-es5.js.map