function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return typeof key === "symbol" ? key : String(key); }

function _toPrimitive(input, hint) { if (typeof input !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (typeof res !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["modules-notification-notification-module"], {
  /***/
  "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/notification/notification/notification.component.html":
  /*!*********************************************************************************************************************!*\
    !*** ./node_modules/raw-loader/dist/cjs.js!./src/app/modules/notification/notification/notification.component.html ***!
    \*********************************************************************************************************************/

  /*! exports provided: default */

  /***/
  function node_modulesRawLoaderDistCjsJsSrcAppModulesNotificationNotificationNotificationComponentHtml(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = "<div fxLayout=\"row wrap\" #scrollDiv class=\"topbar\">\r\n  <div fxFlex.gt-sm=\"60\" fxFlex.gt-xs=\"60\" fx fxFlex=\"100\" class=\"p-l-30 p-r-30\">\r\n    <h1 class=\"fs-18 m-t-13 m-b-9 txt-blue\">Notifications</h1>\r\n  </div>\r\n  <div fxFlex.gt-sm=\"40\" fxFlex.gt-xs=\"40\" fxFlex=\"100\" fxLayoutAlign=\"end\" class=\"p-l-30 p-r-30\">\r\n    <ul class=\"breadcrumb\">\r\n      <li>\r\n        <span class=\"activebreadcrumb\">Notifications</span>\r\n      </li>\r\n      <li><a href=\"dashboard/supplier\"><i class=\"fa fa-home\" matTooltip=\"Home\" matTooltipPosition=\"below\"></i></a></li>\r\n    </ul>\r\n  </div>\r\n</div>\r\n<div fxLayout=\"row wrap\" fxLayoutAlign=\"center\">\r\n<div fxFlex.gt-sm=\"100\" fxFlex=\"100\" >   \r\n      <div class=\"discussionleftright\">\r\n        <div class=\"leftsidecontent\">\r\n          <div>\r\n            <mat-tab-group id='topicsandacrchieve' (selectedTabChange)=\"tabidentify($event)\">\r\n              <mat-tab>\r\n                <ng-template mat-tab-label>\r\n                  Categories\r\n                </ng-template>\r\n                <div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-speech-bubble\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"noticetab()\">\r\n                        <div class=\"usercontent\" >\r\n                          <p class=\"topicname\">Enquiries</p>\r\n                          <p class=\"dateandcreateby\">\r\n                            (EOI, PQ, RFQ, RFT & Sealed Bid)\r\n                          </p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>{{resultsnoticeLength}}</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <!--div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-broadcast\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"broadtab()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">Broadcasts</p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>18</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div-->\r\n                <!-- <div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-speech-bubble\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"advisorytab()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">Advisories</p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>04</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div> -->\r\n                <div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-contractsonly\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\"  (click)=\"contracttab()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">Awards</p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>{{resultsawardLength}}</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <!-- <div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-speech-bubble\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"bidtab()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">eBid</p>\r\n                          <p class=\"dateandcreateby\">\r\n                            (e-Tender,e-Auction)\r\n                          </p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>20</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div> -->\r\n              </mat-tab>\r\n              <mat-tab>\r\n                <ng-template mat-tab-label>\r\n                  Trash\r\n                </ng-template>\r\n                <div class=\"tabcontent\">\r\n                  <div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-speech-bubble\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"tashnotice()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">Enquiries</p>\r\n                          <p class=\"dateandcreateby\">\r\n                            (EOI, PQ, RFQ, RFT & Sealed Bid)\r\n                          </p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"counting\">\r\n                        <p>{{resultsnoticeLength}}</p>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n                <div class=\"tabcontent\">\r\n                  <!--div class=\"eachtopiccontainer\">\r\n                    <div class=\"eachtopicitem\">\r\n                      <div class=\"checkboxes\">\r\n                        <i class=\"bgi bgi-speech-bubble\"></i>\r\n                      </div>\r\n                      <div class=\"topicdetails\" (click)=\"tashbroad()\">\r\n                        <div class=\"usercontent\">\r\n                          <p class=\"topicname\">Broadcast</p>\r\n                        </div>\r\n                      </div>\r\n                      <div class=\"countash\">\r\n                        <p>10</p>\r\n                      </div>\r\n                    </div>\r\n                  </div-->\r\n                  <!-- <div class=\"tabcontent\">\r\n                    <div class=\"eachtopiccontainer\">\r\n                      <div class=\"eachtopicitem\">\r\n                        <div class=\"checkboxes\">\r\n                          <i class=\"bgi bgi-speech-bubble\"></i>\r\n                        </div>\r\n                        <div class=\"topicdetails\" (click)=\"tashadvisory()\">\r\n                          <div class=\"usercontent\">\r\n                            <p class=\"topicname\">Advisories</p>\r\n                          </div>\r\n                        </div> -->\r\n                        <!--div class=\"countash\">\r\n                          <p>10</p>\r\n                        </div-->\r\n                      <!-- </div>\r\n                    </div>\r\n                  </div> -->\r\n                  <div class=\"tabcontent\">\r\n                    <div class=\"eachtopiccontainer\">\r\n                      <div class=\"eachtopicitem\">\r\n                        <div class=\"checkboxes\">\r\n                          <i class=\"bgi bgi-speech-bubble\"></i>\r\n                        </div>\r\n                        <div class=\"topicdetails\" (click)=\"tashadvisory()\">\r\n                          <div class=\"usercontent\">\r\n                            <p class=\"topicname\">Awards</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"counting\">\r\n                          <p>{{resultsawardLength}}</p>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </div>\r\n                </div>\r\n              </mat-tab>\r\n            </mat-tab-group>\r\n          </div>\r\n        </div>\r\n        <div class=\"rightsidecontent1 w-100\">\r\n          <div fxLayout=\"row wrap\" class=\"w-100 rightsidecontent\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\" class=\"w-100\">\r\n              <div class=\"rightinfo\">\r\n                <div class=\"checkboxes\">\r\n                  <mat-checkbox [(ngModel)]=\"checkall\" (change)=\"check_uncheckall()\"></mat-checkbox>\r\n                  <button mat-button [matMenuTriggerFor]=\"menu1\" class=\"txt-blue sortby m-t-5\">\r\n                    <i class=\"bgi bgi-dropdown p-l-10 fs-10\"></i>\r\n                  </button>\r\n                  <mat-menu #menu1=\"matMenu\" class=\"editdelete\">\r\n                    <button mat-menu-item (click)=\"updatenotification('read')\">Mark as Read</button>\r\n                    <button mat-menu-item (click)=\"updatenotification('unread')\">Mark all as Read</button>\r\n                    <button mat-menu-item (click)=\"updatenotification('delete')\">Delete</button>\r\n                  </mat-menu>\r\n                  <!-- <mat-menu #menu1=\"matMenu\" class=\"editdelete\">\r\n                    <button mat-menu-item>Restore</button>\r\n                    <button mat-menu-item>Delete Permanently</button>\r\n                    <button mat-menu-item>Empty trash now</button>\r\n                  </mat-menu> -->\r\n                  <p class=\"unred\">{{notification_title}}</p>\r\n                </div>\r\n                <div class=\"searchfilter\">\r\n                  <div class=\"searchProject\">\r\n                    <form [formGroup]=\"filterform\">\r\n                      <mat-form-field class=\"example-full-width \" appearance=\"fill\">\r\n                        <input autocomplete=\"off\" appAlphanumsymb type=\"text fs-15\" matInput\r\n                          placeholder=\"Search by Title\" formControlName=\"searchbytitle\">\r\n                        <mat-icon class=\"searchicon\" matSuffix><i class=\"bgi bgi-search\"></i>\r\n                        </mat-icon>\r\n                        <!-- <mat-icon  class=\"reseticon\" matSuffix>clear</mat-icon> -->\r\n                      </mat-form-field>\r\n                    </form>\r\n                  </div>\r\n                </div>\r\n                <div class=\"p-t-1\">\r\n                  <p><span class=\"p-r-5 unred\">Unread</span>\r\n                    <mat-slide-toggle [checked]=\"unreadflag\" (change)=\"filterunread()\"></mat-slide-toggle>\r\n                  </p>\r\n                </div>\r\n                <div class=\"sort p-t-5\">\r\n                  <button mat-button [matMenuTriggerFor]=\"menu\" class=\"txt-blue sortby m-t-5\">Sort by\r\n                    <i class=\"bgi bgi-dropdown p-l-10 fs-10\"></i>\r\n                  </button>\r\n                  <mat-menu #menu=\"matMenu\" class=\"editdelete\">\r\n                    <button mat-menu-item (click)=\"sortnotification('asc')\">Ascending</button>\r\n                    <button mat-menu-item (click)=\"sortnotification('desc')\">Descending</button>\r\n                  </mat-menu>\r\n                </div>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"tabnotice\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of allnoticelistfilter;let i = index\">\r\n                    \r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title (click)=\"statustoRead(notice.bcastnotifdtls_pk,i)\">\r\n                        <p>\r\n                          <ng-template *ngIf=\"notice['checked'] = castconversion(notice.checked)\"></ng-template>\r\n                          <mat-checkbox [(ngModel)]=\"notice.checked\" (change)=\"isSelected()\"></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover removbold{{i}}\" [ngClass]=\"notice.bnd_status==1 ? 'fw-bold':''\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span>{{notice.date | date:'dd-MM-y' }}</span><span class=\"m-l-30\">{{notice.date | date:'HH:mm(z)'}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\" [innerHtml]=\"messagecontent(notice)\"></p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <!-- <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download\"></i>\r\n                        </div>\r\n                      </div> -->\r\n                      <button mat-button [routerLink]=\"['/pms/rfxlist']\" [queryParams]=\"{ refno:notice.bnm_refno}\" class=\"txt-blue  m-t-5\"> View more\r\n                      </button>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                  <mat-paginator class=\"p-r-10\" ngClass.xs=\"block\" ngClass.sm=\"block\"\r\n                    [style.visibility]=\"(resultsLength > 10) ? 'visible' : 'hidden' \"\r\n                    class=\"masterPage masterbottom normalpage\" showFirstLastButtons (page)=\"noticePaginator($event);\"\r\n                    [pageSize]=\"perpage\"\r\n                    [pageIndex]=\"paginator?.pageIndex\" [length]=\"paginator?.length\">\r\n                  </mat-paginator>\r\n                </mat-accordion>\r\n                \r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"tabbroad\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"tabadvisory\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"tabcontract\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"tabbid\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <!-- <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"noticetrash\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of allnoticelistfilter | searchFilter:filternotice : 'title'\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>\r\n                          <ng-template *ngIf=\"notice['checked'] = castconversion(notice.checked)\"></ng-template>\r\n                          <mat-checkbox [(ngModel)]=\"notice.checked\" (change)=\"isSelected()\"></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date | date:'dd-MM-y'}}</span><span class=\"m-l-30\">{{notice.date | date:'HH:mm(z)'}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}} {{notice.bnm_closing_date | date:'HH:mm(z)'}}.</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p> -->\r\n                      <!-- <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div> -->\r\n                      <!-- <button mat-button [routerLink]=\"['/pms/rfxlist']\" [queryParams]=\"{ refno:notice.bnm_refno}\" class=\"txt-blue  m-t-5\"> View more\r\n                      </button>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div> -->\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"broadtrash\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>\r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\">{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n          <div fxLayout=\"row wrap\" class=\"rightcontent notice\"  *ngIf=\"advisorytrash\">\r\n            <div fxFlex.gt-sm=\"100\" fxFlex=\"100\">\r\n              <div class=\"p-10\">\r\n                <mat-accordion>\r\n                  <mat-expansion-panel hideToggle *ngFor=\"let notice of noticelist\">\r\n                    <mat-expansion-panel-header [collapsedHeight]=\"customCollapsedHeight\"\r\n                    [expandedHeight]=\"customExpandedHeight\" (click)=\"scrollTo('page-content')\">\r\n                      <mat-panel-title>                        \r\n                        <p>                        \r\n                          <mat-checkbox></mat-checkbox> <span class=\"p-l-10 txt-3 titlehover\" >{{notice.title}}</span>\r\n                        </p>\r\n                        <p class=\"txt-6\"><span> {{notice.date}}</span><span class=\"m-l-30\">{{notice.time}}</span></p>\r\n                      </mat-panel-title>\r\n                    </mat-expansion-panel-header>\r\n                    <div class=\"expcontent m-t-30\">\r\n                      <h4 class=\"fs-13 txt-6\">Message</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para1}}</p>\r\n                      <h4 class=\"fs-13 txt-6 m-t-20\">Received from</h4>\r\n                      <p class=\"fs-15 txt-3\">{{notice.para2}}</p>\r\n                      <div class=\"article m-t-30\">\r\n                        <div class=\"docart\">\r\n                          <div class=\"notes m-r-10\"> <i class=\"bgi bgi-notes \"></i> </div>\r\n                          <div>\r\n                            <p class=\"artdoc fs-14 m-0\">Article.dox</p>\r\n                            <p class=\"txt-6 fs-14\">256 kb</p>\r\n                          </div>\r\n                        </div>\r\n                        <div class=\"download\">\r\n                          <i class=\"bgi bgi-download txt-6\"></i>\r\n                        </div>\r\n                      </div>\r\n                    </div>\r\n                  </mat-expansion-panel>\r\n                </mat-accordion>\r\n              </div>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </div>\r\n    </div>\r\n  </div>";
    /***/
  },

  /***/
  "./src/app/modules/notification/notification-routing.module.ts":
  /*!*********************************************************************!*\
    !*** ./src/app/modules/notification/notification-routing.module.ts ***!
    \*********************************************************************/

  /*! exports provided: NotificationRoutingModule */

  /***/
  function srcAppModulesNotificationNotificationRoutingModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "NotificationRoutingModule", function () {
      return NotificationRoutingModule;
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


    var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/router */
    "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
    /* harmony import */


    var _app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/auth/auth.guard */
    "./src/app/auth/auth.guard.ts");
    /* harmony import */


    var _notification_notification_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! ./notification/notification.component */
    "./src/app/modules/notification/notification/notification.component.ts");

    var routes = [{
      path: '',
      children: [{
        path: 'notification',
        canActivate: [_app_auth_auth_guard__WEBPACK_IMPORTED_MODULE_3__["AuthGuard"]],
        component: _notification_notification_component__WEBPACK_IMPORTED_MODULE_4__["NotificationComponent"]
      }]
    }];

    var NotificationRoutingModule = /*#__PURE__*/_createClass(function NotificationRoutingModule() {
      _classCallCheck(this, NotificationRoutingModule);
    });

    NotificationRoutingModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      imports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"].forChild(routes)],
      exports: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterModule"]]
    })], NotificationRoutingModule);
    /***/
  },

  /***/
  "./src/app/modules/notification/notification.module.ts":
  /*!*************************************************************!*\
    !*** ./src/app/modules/notification/notification.module.ts ***!
    \*************************************************************/

  /*! exports provided: NotificationModule */

  /***/
  function srcAppModulesNotificationNotificationModuleTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "NotificationModule", function () {
      return NotificationModule;
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


    var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @angular/common */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
    /* harmony import */


    var _notification_routing_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! ./notification-routing.module */
    "./src/app/modules/notification/notification-routing.module.ts");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
    /* harmony import */


    var _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/flex-layout */
    "./node_modules/@angular/flex-layout/__ivy_ngcc__/esm2015/flex-layout.js");
    /* harmony import */


    var ngx_smart_popover__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(
    /*! ngx-smart-popover */
    "./node_modules/ngx-smart-popover/__ivy_ngcc__/fesm2015/ngx-smart-popover.js");
    /* harmony import */


    var _app_shared__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(
    /*! @app/@shared */
    "./src/app/@shared/index.ts");
    /* harmony import */


    var _notification_notification_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(
    /*! ./notification/notification.component */
    "./src/app/modules/notification/notification/notification.component.ts");

    var NotificationModule = /*#__PURE__*/_createClass(function NotificationModule() {
      _classCallCheck(this, NotificationModule);
    });

    NotificationModule = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"])({
      declarations: [_notification_notification_component__WEBPACK_IMPORTED_MODULE_8__["NotificationComponent"]],
      imports: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _notification_routing_module__WEBPACK_IMPORTED_MODULE_3__["NotificationRoutingModule"], _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["ReactiveFormsModule"], _app_shared__WEBPACK_IMPORTED_MODULE_7__["SharedModule"], _angular_flex_layout__WEBPACK_IMPORTED_MODULE_5__["FlexLayoutModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["FormsModule"], ngx_smart_popover__WEBPACK_IMPORTED_MODULE_6__["PopoverModule"]]
    })], NotificationModule);
    /***/
  },

  /***/
  "./src/app/modules/notification/notification/notification.component.scss":
  /*!*******************************************************************************!*\
    !*** ./src/app/modules/notification/notification/notification.component.scss ***!
    \*******************************************************************************/

  /*! exports provided: default */

  /***/
  function srcAppModulesNotificationNotificationNotificationComponentScss(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony default export */


    __webpack_exports__["default"] = ".txt-3 {\n  color: #333;\n}\n\n.txt-6 {\n  color: #666666;\n}\n\n.txt-9 {\n  color: #666;\n}\n\nbody {\n  background: #fff;\n}\n\n.page-content {\n  width: 100%;\n  margin: 0 auto;\n  padding-top: 0px;\n}\n\n.page-content .bredscruminexp {\n  padding-left: 35px;\n  padding-right: 35px;\n  padding-bottom: 0px;\n}\n\n.topbar {\n  align-items: center;\n}\n\n.discussionleftright {\n  border-top: 3px solid #006cb7;\n  display: flex;\n  margin-left: 30px;\n  margin-right: 30px;\n  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);\n}\n\n.discussionleftright .leftsidecontent {\n  background: #fff;\n  width: 420px;\n  border-right: 1px solid #ddd;\n}\n\n.discussionleftright .leftsidecontent .lefttop {\n  display: flex;\n  justify-content: space-between;\n  align-items: center !important;\n  padding-bottom: 10px;\n}\n\n.discussionleftright .leftsidecontent .lefttop .menutopic {\n  height: 30px;\n  width: 30px;\n  display: flex;\n  justify-content: center;\n  align-items: center !important;\n  color: #555;\n}\n\n.discussionleftright .leftsidecontent .lefttop .menutopic .mat-button-wrapper {\n  max-height: 100%;\n  display: flex;\n  align-items: center;\n}\n\n.discussionleftright .leftsidecontent .lefttop p {\n  margin: 0;\n}\n\n.discussionleftright .leftsidecontent .lefttop .searchandmore {\n  display: flex;\n  justify-content: flex-end;\n  align-items: center !important;\n}\n\n.discussionleftright .leftsidecontent .lefttop .searchandmore i {\n  padding-right: 5px;\n  margin-right: 15px;\n  padding-left: 5px;\n  color: #666;\n  cursor: pointer;\n}\n\n.discussionleftright .leftsidecontent .lefttop .searchandmore i:nth-child(2) {\n  margin-right: 5px;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-labels {\n  width: 100%;\n  margin-left: 0;\n  padding: 5px;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-label {\n  opacity: 1 !important;\n  height: 40px !important;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-list {\n  opacity: 1 !important;\n  background: #f2f3f7;\n  height: 50px !important;\n  padding: 0px !important;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-body {\n  padding-left: 0;\n  padding-right: 0;\n  padding-top: 0;\n  background-color: #fff;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-label {\n  width: 50% !important;\n  border-radius: 2px;\n  height: 40px;\n  margin-right: 0 !important;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-label-active {\n  background-color: #006cb7;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-label-active .mat-tab-label-content {\n  color: #fff;\n}\n\n.discussionleftright #topicsandacrchieve .mat-tab-header {\n  border: 0;\n  background-color: transparent !important;\n}\n\n.discussionleftright #topicsandacrchieve .mat-ink-bar {\n  display: none !important;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer {\n  padding: 0px 10px;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem {\n  display: flex;\n  border-bottom: 1px solid #ddd;\n  padding-top: 20px;\n  padding-bottom: 20px;\n  min-height: 70px;\n  padding-left: 20px;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .checkboxes {\n  width: 25px;\n  display: flex;\n  justify-content: center;\n  margin-top: 5px;\n  font-size: 1.25rem;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .checkboxes i {\n  color: #f58020;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails {\n  width: calc(100% - 80px);\n  display: flex;\n  cursor: pointer;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .userimage {\n  width: 55px;\n  height: 55px;\n  position: relative;\n  z-index: 0;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .userimage::after {\n  content: \"\";\n  background: #f58020;\n  position: absolute;\n  height: 60%;\n  right: -3px;\n  width: 67%;\n  z-index: -1;\n  bottom: -3px;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .userimage img {\n  max-width: 100%;\n  width: 100%;\n  z-index: 9999;\n  position: relative;\n  max-width: 100%;\n  background: #fff;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .usercontent {\n  width: calc(100% - 55px);\n  padding-left: 20px;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .usercontent .topicname {\n  color: #333;\n  font-size: 1rem;\n  margin: 0;\n  font-weight: 600;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .topicdetails .usercontent .dateandcreateby {\n  display: flex;\n  justify-content: flex-start;\n  align-items: center !important;\n  margin: 0;\n  color: #656565;\n  font-size: 0.8125rem;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .counting p {\n  font-size: 0.75rem;\n  background: #f04242;\n  color: #fff;\n  padding: 1px 9px;\n  border-radius: 10px;\n}\n\n.discussionleftright #topicsandacrchieve .eachtopiccontainer .eachtopicitem .countash p {\n  font-size: 0.75rem;\n  background: #ddd;\n  color: #333;\n  padding: 1px 9px;\n  border-radius: 10px;\n}\n\n.discussionleftright .rightsidecontent {\n  width: 100%;\n  padding-left: 0px;\n  position: relative;\n  display: flex;\n  background-color: #fff;\n}\n\n.discussionleftright .rightsidecontent .rightinfo {\n  display: flex;\n  width: 100%;\n  justify-content: space-between;\n  height: 50px !important;\n  background: #f2f3f7;\n  padding-left: 20px;\n  padding-right: 20px;\n  padding-top: 8px;\n}\n\n.discussionleftright .rightsidecontent .rightinfo p {\n  margin: 0;\n}\n\n.discussionleftright .rightsidecontent .checkboxes {\n  display: flex;\n  padding-top: 5px;\n}\n\n.discussionleftright .rightsidecontent .checkboxes .mat-checkbox-frame {\n  border-width: 1px !important;\n}\n\n.discussionleftright .rightsidecontent .checkboxes .sortby {\n  width: 8px !important;\n  display: flex;\n  cursor: pointer;\n  font-size: 1.125rem;\n  color: #333;\n  padding: 0px;\n  font-family: \"cairosemibold\";\n  min-width: 34px !important;\n  line-height: 6px !important;\n}\n\n.discussionleftright .rightsidecontent .checkboxes .sortby .mat-form-field-infix {\n  margin-top: 0px !important;\n  border-top: 0px !important;\n  padding: 0.5em 0 !important;\n}\n\n.discussionleftright .rightsidecontent .checkboxes .sortby .mat-form-field-underline {\n  display: none !important;\n}\n\n.discussionleftright .rightsidecontent .checkboxes .sortby .mat-button {\n  min-width: 0px;\n  color: #fff;\n}\n\n.discussionleftright .rightsidecontent .searchfilter {\n  display: flex;\n  justify-content: space-between;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject {\n  width: 275px;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field {\n  border: 1px solid #e5e5e5;\n  padding: 0;\n  margin: 0;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-wrapper {\n  padding-bottom: 0;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-flex {\n  position: relative;\n  border: 1px solid #fff;\n  padding: 1px 12px !important;\n  padding-bottom: 10px;\n  background-color: #fff;\n  border-radius: 2px !important;\n  height: 33px;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-flex .mat-form-field-infix {\n  border-bottom: 0px !important;\n  padding: 0;\n  padding-top: 6px;\n  border-top: 40px;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-flex .mat-form-field-suffix {\n  position: relative;\n  margin-left: 10px;\n  color: #c0bbbb;\n  font-weight: bold;\n  top: 0px;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-flex .mat-form-field-suffix .mat-icon {\n  font-size: 18px !important;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-flex .mat-form-field-prefix {\n  position: relative;\n  margin-right: 10px;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-underline {\n  display: none;\n}\n\n.discussionleftright .rightsidecontent .searchfilter .searchProject .mat-form-field-appearance-fill .mat-form-field-flex {\n  border-radius: none !important;\n}\n\n.discussionleftright .rightsidecontent button {\n  cursor: pointer;\n  width: auto !important;\n}\n\n.discussionleftright .rightsidecontent .unred {\n  font-size: 0.875rem;\n  font-family: \"cairosemibold\";\n  color: #000;\n}\n\n.discussionleftright .rightsidecontent .sort .sortby {\n  width: 8px !important;\n  display: flex;\n  cursor: pointer;\n  font-size: 0.875rem;\n  color: #333;\n  padding: 0px;\n  font-family: \"cairosemibold\";\n  min-width: 64px !important;\n  line-height: 6px !important;\n}\n\n.discussionleftright .rightsidecontent .sort .sortby .mat-form-field-infix {\n  margin-top: 0px !important;\n  border-top: 0px !important;\n  padding: 0.5em 0 !important;\n}\n\n.discussionleftright .rightsidecontent .sort .sortby .mat-form-field-underline {\n  display: none !important;\n}\n\n.discussionleftright .rightsidecontent .sort .sortby .mat-button {\n  min-width: 0px;\n  color: #fff;\n}\n\n.editdelete.mat-menu-panel {\n  margin-top: 5px;\n  background-color: #333 !important;\n}\n\n.editdelete.mat-menu-panel .mat-menu-item {\n  height: 32px !important;\n  color: #fff !important;\n  line-height: 32px !important;\n}\n\n@media (max-width: 768px) {\n  .discussionleftright {\n    display: block !important;\n  }\n  .discussionleftright .eachtopiccontainer {\n    width: 100%;\n  }\n  .discussionleftright .leftsidecontent {\n    width: 100% !important;\n    padding-right: 0 !important;\n    border: 0 !important;\n  }\n  .discussionleftright .rightsidecontent {\n    width: 100% !important;\n    padding-left: 3px !important;\n  }\n  .discussionleftright .joincomment {\n    width: calc(100% - 5px) !important;\n  }\n  .discussionleftright #topicsandacrchieve .mat-tab-labels {\n    margin-left: 0 !important;\n    width: 100%;\n    margin-top: 0 !important;\n    display: flex !important;\n  }\n}\n\n@media (max-width: 767px) {\n  .eachitemindetail .divisions .topicdetails {\n    display: block !important;\n    padding: 15px;\n  }\n  .eachitemindetail .divisions .topicdetails .usercontent {\n    padding-left: 0 !important;\n    padding-top: 15px;\n  }\n}\n\n.rightsidecontent1 {\n  background-color: #fff;\n}\n\n.rightcontent {\n  background-color: #fff;\n}\n\n.rightcontent .mat-expansion-panel {\n  box-shadow: none;\n  border-bottom: 1px solid #ddd;\n  border-radius: 0px !important;\n}\n\n.rightcontent .mat-expansion-panel-header-title {\n  justify-content: space-between;\n}\n\n.rightcontent .mat-expansion-panel-header-title p {\n  display: flex;\n}\n\n.rightcontent .mat-expansion-panel-header-title .counting {\n  font-size: 0.75rem;\n  background: #f04242;\n  color: #fff;\n  padding: 3px 9px;\n  border-radius: 10px;\n  margin-right: 15px;\n}\n\n.rightcontent .mat-expansion-panel-header:hover {\n  background: transparent !important;\n}\n\n.rightcontent .mat-expansion-panel-header:hover .titlehover {\n  color: #006cb7;\n}\n\n.rightcontent .mat-checkbox-frame {\n  border-width: 1px !important;\n}\n\n.rightcontent .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  background-color: #006cb7;\n}\n\n.rightcontent .mat-expansion-panel-header {\n  padding: 0px 12px;\n}\n\n.rightcontent .mat-expanded .mat-expansion-panel-header {\n  background-color: #006cb7 !important;\n  color: #fff;\n  padding: 0px 12px;\n}\n\n.rightcontent .mat-expanded mat-panel-title p {\n  color: #fff !important;\n  display: flex;\n}\n\n.rightcontent .mat-expanded .titlehover {\n  color: #fff !important;\n}\n\n.rightcontent .mat-expanded .mat-checkbox-frame {\n  color: #fff;\n  background: #fff;\n  border: #ffff;\n}\n\n.rightcontent .mat-expanded .mat-checkbox-checked.mat-accent .mat-checkbox-background {\n  color: #006cb7;\n  background: #fff;\n}\n\n.rightcontent .mat-expanded .mat-checkbox-checkmark-path {\n  stroke: #006cb7 !important;\n}\n\n.rightcontent .article {\n  display: flex;\n  width: 100%;\n  justify-content: space-between;\n  padding: 20px;\n}\n\n.rightcontent .article .docart {\n  display: flex;\n}\n\n.rightcontent .article .docart .artdoc {\n  color: #006cb7;\n}\n\n.rightcontent .article .notes {\n  background: #e0f0ff;\n  color: #006cb7;\n  padding: 15px;\n  border-radius: 2px;\n  height: 60px;\n}\n\n.rightcontent .article .notes i {\n  font-size: 1.5625rem;\n  color: #006cb7;\n}\n\n.rightcontent .article .download {\n  margin-top: 14px;\n  background: #ffff;\n  padding: 11px 15px;\n  border-radius: 25px;\n  height: 45px;\n}\n\n.rightcontent .article .download i {\n  color: #fff;\n}\n\n.rightcontent .article:hover {\n  background-color: #f2f3f7;\n}\n\n.rightcontent .article:hover .notes {\n  background: #006cb7;\n}\n\n.rightcontent .article:hover .notes i {\n  color: #fff;\n}\n\n.rightcontent .article:hover .download {\n  background: #ffff;\n  cursor: pointer;\n}\n\n.rightcontent .article:hover .download i {\n  color: #666;\n}\n\n.titlehover {\n  white-space: nowrap;\n  text-overflow: ellipsis;\n  width: 350px;\n  display: block;\n  overflow: hidden;\n}\n\n.activebreadcrumb {\n  font-family: \"cairosemibold\";\n}\n\n.fw-bold {\n  font-weight: bold;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvbW9kdWxlcy9ub3RpZmljYXRpb24vbm90aWZpY2F0aW9uL0M6XFxqZW5raW5zXFx3b3Jrc3BhY2VcXE9QQUwgLSBEZXYgQnVpbGQgMjAwXFxkZXYvc3JjXFxhcHBcXG1vZHVsZXNcXG5vdGlmaWNhdGlvblxcbm90aWZpY2F0aW9uXFxub3RpZmljYXRpb24uY29tcG9uZW50LnNjc3MiLCJzcmMvYXBwL21vZHVsZXMvbm90aWZpY2F0aW9uL25vdGlmaWNhdGlvbi9ub3RpZmljYXRpb24uY29tcG9uZW50LnNjc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBb0JBO0VBQ0ksV0FBQTtBQ25CSjs7QURxQkE7RUFDSSxjQUFBO0FDbEJKOztBRG9CQTtFQUNJLFdBQUE7QUNqQko7O0FEbUJBO0VBQ0ksZ0JBQUE7QUNoQko7O0FEa0JBO0VBQ0ksV0FBQTtFQUNBLGNBQUE7RUFDQSxnQkFBQTtBQ2ZKOztBRGdCSTtFQUNJLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxtQkFBQTtBQ2RSOztBRGlCQTtFQUNLLG1CQUFBO0FDZEw7O0FEZ0JBO0VBQ0ksNkJBQUE7RUFDQSxhQUFBO0VBQ0EsaUJBQUE7RUFDQSxrQkFBQTtFQUNBLHlDQUFBO0FDYko7O0FEY0k7RUFDSSxnQkFBQTtFQUNBLFlBQUE7RUFDQSw0QkFBQTtBQ1pSOztBRGFRO0VBdkNKLGFBQUE7RUFDQSw4QkFBQTtFQUNBLDhCQUFBO0VBdUNRLG9CQUFBO0FDVFo7O0FEVVk7RUFDSSxZQUFBO0VBQ0EsV0FBQTtFQTNEWixhQUFBO0VBQ0EsdUJBQUE7RUFDQSw4QkFBQTtFQTJEWSxXQUFBO0FDTmhCOztBRE9nQjtFQUNJLGdCQUFBO0VBQ0EsYUFBQTtFQUNBLG1CQUFBO0FDTHBCOztBRFFZO0VBQ0ksU0FBQTtBQ05oQjs7QURRWTtFQTdEUixhQUFBO0VBQ0EseUJBQUE7RUFDQSw4QkFBQTtBQ3dESjs7QURLZ0I7RUFDSSxrQkFBQTtFQUNBLGtCQUFBO0VBQ0EsaUJBQUE7RUFDQSxXQUFBO0VBQ0EsZUFBQTtBQ0hwQjs7QURJb0I7RUFDSSxpQkFBQTtBQ0Z4Qjs7QURVUTtFQUNJLFdBQUE7RUFDQSxjQUFBO0VBRUEsWUFBQTtBQ1RaOztBRFdRO0VBQ0kscUJBQUE7RUFDQSx1QkFBQTtBQ1RaOztBRFdTO0VBQ0cscUJBQUE7RUFDQSxtQkFBQTtFQUNBLHVCQUFBO0VBQ0EsdUJBQUE7QUNUWjs7QURXUTtFQUNJLGVBQUE7RUFDQSxnQkFBQTtFQUNBLGNBQUE7RUFDQSxzQkFBQTtBQ1RaOztBRFdRO0VBQ0kscUJBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7RUFDQSwwQkFBQTtBQ1RaOztBRFdRO0VBQ0kseUJBQUE7QUNUWjs7QURVWTtFQUNJLFdBQUE7QUNSaEI7O0FEV1E7RUFDSSxTQUFBO0VBQ0Esd0NBQUE7QUNUWjs7QURXUTtFQUNJLHdCQUFBO0FDVFo7O0FEV1E7RUFDSSxpQkFBQTtBQ1RaOztBRFVZO0VBQ0ksYUFBQTtFQUNBLDZCQUFBO0VBQ0EsaUJBQUE7RUFDQSxvQkFBQTtFQUNBLGdCQUFBO0VBQ0Esa0JBQUE7QUNSaEI7O0FEU2dCO0VBQ0ksV0FBQTtFQUNBLGFBQUE7RUFDQSx1QkFBQTtFQUNBLGVBQUE7RUFDQSxrQkFBQTtBQ1BwQjs7QURRb0I7RUFDSSxjQUFBO0FDTnhCOztBRFNnQjtFQUNJLHdCQUFBO0VBQ0EsYUFBQTtFQUNBLGVBQUE7QUNQcEI7O0FEUW9CO0VBQ0ksV0FBQTtFQUNBLFlBQUE7RUFDQSxrQkFBQTtFQUNBLFVBQUE7QUNOeEI7O0FET3dCO0VBQ0ksV0FBQTtFQUNBLG1CQUFBO0VBQ0Esa0JBQUE7RUFDQSxXQUFBO0VBQ0EsV0FBQTtFQUNBLFVBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtBQ0w1Qjs7QURPd0I7RUFDSSxlQUFBO0VBQ0EsV0FBQTtFQUNBLGFBQUE7RUFDQSxrQkFBQTtFQUNBLGVBQUE7RUFDQSxnQkFBQTtBQ0w1Qjs7QURRb0I7RUFDSSx3QkFBQTtFQUNBLGtCQUFBO0FDTnhCOztBRE93QjtFQUNJLFdBQUE7RUFDQSxlQUFBO0VBQ0EsU0FBQTtFQUNBLGdCQUFBO0FDTDVCOztBRE93QjtFQXBMcEIsYUFBQTtFQUNBLDJCQUFBO0VBQ0EsOEJBQUE7RUFvTHdCLFNBQUE7RUFDQSxjQUFBO0VBQ0Esb0JBQUE7QUNINUI7O0FEUW9CO0VBQ0ksa0JBQUE7RUFDQSxtQkFBQTtFQUNBLFdBQUE7RUFDQSxnQkFBQTtFQUNBLG1CQUFBO0FDTnhCOztBRFVvQjtFQUNJLGtCQUFBO0VBQ0EsZ0JBQUE7RUFDQSxXQUFBO0VBQ0EsZ0JBQUE7RUFDQSxtQkFBQTtBQ1J4Qjs7QURjSTtFQUNJLFdBQUE7RUFDQSxpQkFBQTtFQUNBLGtCQUFBO0VBQ0EsYUFBQTtFQUNBLHNCQUFBO0FDWlI7O0FEYVE7RUFDSSxhQUFBO0VBQ0EsV0FBQTtFQUNBLDhCQUFBO0VBQ0EsdUJBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxnQkFBQTtBQ1haOztBRFlZO0VBQ0ksU0FBQTtBQ1ZoQjs7QURlUTtFQUNJLGFBQUE7RUFDQSxnQkFBQTtBQ2JaOztBRGNZO0VBQ0ksNEJBQUE7QUNaaEI7O0FEY1k7RUFDSSxxQkFBQTtFQUNBLGFBQUE7RUFDQSxlQUFBO0VBQ0EsbUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNDLDRCQUFBO0VBQ0QsMEJBQUE7RUFDQSwyQkFBQTtBQ1poQjs7QURjZ0I7RUFDRSwwQkFBQTtFQUNBLDBCQUFBO0VBQ0EsMkJBQUE7QUNabEI7O0FEZWdCO0VBQ0Usd0JBQUE7QUNibEI7O0FEZ0JnQjtFQUNFLGNBQUE7RUFDQSxXQUFBO0FDZGxCOztBRG1CUTtFQUNJLGFBQUE7RUFDQSw4QkFBQTtBQ2pCWjs7QURrQlk7RUFDSSxZQUFBO0FDaEJoQjs7QURpQmdCO0VBQ0kseUJBQUE7RUFDQSxVQUFBO0VBQ0EsU0FBQTtBQ2ZwQjs7QURpQmdCO0VBQ0ksaUJBQUE7QUNmcEI7O0FEaUJnQjtFQUNFLGtCQUFBO0VBQ0Esc0JBQUE7RUFDQSw0QkFBQTtFQUNBLG9CQUFBO0VBQ0Esc0JBQUE7RUFDQSw2QkFBQTtFQUNBLFlBQUE7QUNmbEI7O0FEZ0JrQjtFQUNFLDZCQUFBO0VBQ0EsVUFBQTtFQUNBLGdCQUFBO0VBQ0EsZ0JBQUE7QUNkcEI7O0FEZ0JrQjtFQUNFLGtCQUFBO0VBQ0EsaUJBQUE7RUFDQSxjQUFBO0VBQ0EsaUJBQUE7RUFDQSxRQUFBO0FDZHBCOztBRGVvQjtFQUNJLDBCQUFBO0FDYnhCOztBRGlCa0I7RUFDRSxrQkFBQTtFQUNBLGtCQUFBO0FDZnBCOztBRG1CZ0I7RUFDRSxhQUFBO0FDakJsQjs7QURvQmdCO0VBQ0UsOEJBQUE7QUNsQmxCOztBRHNCUTtFQUNFLGVBQUE7RUFDQSxzQkFBQTtBQ3BCVjs7QURzQlE7RUFDSSxtQkFBQTtFQUNDLDRCQUFBO0VBQ0QsV0FBQTtBQ3BCWjs7QUR1Qlk7RUFDSSxxQkFBQTtFQUNBLGFBQUE7RUFDQSxlQUFBO0VBQ0EsbUJBQUE7RUFDQSxXQUFBO0VBQ0EsWUFBQTtFQUNDLDRCQUFBO0VBQ0QsMEJBQUE7RUFDQSwyQkFBQTtBQ3JCaEI7O0FEdUJnQjtFQUNFLDBCQUFBO0VBQ0EsMEJBQUE7RUFDQSwyQkFBQTtBQ3JCbEI7O0FEd0JnQjtFQUNFLHdCQUFBO0FDdEJsQjs7QUR5QmdCO0VBQ0UsY0FBQTtFQUNBLFdBQUE7QUN2QmxCOztBRDhCQTtFQUNRLGVBQUE7RUFDQSxpQ0FBQTtBQzNCUjs7QUQ0Qkk7RUFDSSx1QkFBQTtFQUNBLHNCQUFBO0VBQ0EsNEJBQUE7QUMxQlI7O0FENkJBO0VBQ0k7SUFDSSx5QkFBQTtFQzFCTjtFRDJCTTtJQUNJLFdBQUE7RUN6QlY7RUQyQk07SUFDSSxzQkFBQTtJQUNBLDJCQUFBO0lBQ0Esb0JBQUE7RUN6QlY7RUQyQk07SUFDSSxzQkFBQTtJQUNBLDRCQUFBO0VDekJWO0VEMkJNO0lBQ0ksa0NBQUE7RUN6QlY7RUQyQk07SUFDSSx5QkFBQTtJQUNBLFdBQUE7SUFDQSx3QkFBQTtJQUNBLHdCQUFBO0VDekJWO0FBQ0Y7O0FENEJBO0VBR1k7SUFDSSx5QkFBQTtJQUNBLGFBQUE7RUM1QmQ7RUQ2QmM7SUFDSSwwQkFBQTtJQUNBLGlCQUFBO0VDM0JsQjtBQUNGOztBRGdDQTtFQUNJLHNCQUFBO0FDOUJKOztBRGdDQTtFQUNJLHNCQUFBO0FDN0JKOztBRDhCSTtFQUNJLGdCQUFBO0VBQ0EsNkJBQUE7RUFDQSw2QkFBQTtBQzVCUjs7QUQ4Qkk7RUFDSSw4QkFBQTtBQzVCUjs7QUQ2QlE7RUFDSSxhQUFBO0FDM0JaOztBRDZCUTtFQUNJLGtCQUFBO0VBQ0EsbUJBQUE7RUFDQSxXQUFBO0VBQ0EsZ0JBQUE7RUFDQSxtQkFBQTtFQUNBLGtCQUFBO0FDM0JaOztBRDhCSTtFQUNJLGtDQUFBO0FDNUJSOztBRDZCUTtFQUNJLGNBQUE7QUMzQlo7O0FEOEJJO0VBQ0ksNEJBQUE7QUM1QlI7O0FEOEJJO0VBQ0kseUJBQUE7QUM1QlI7O0FEOEJJO0VBQ0ksaUJBQUE7QUM1QlI7O0FEK0JRO0VBQ0ksb0NBQUE7RUFDQSxXQUFBO0VBQ0EsaUJBQUE7QUM3Qlo7O0FEZ0NZO0VBQ0ksc0JBQUE7RUFDQSxhQUFBO0FDOUJoQjs7QURpQ1E7RUFDSSxzQkFBQTtBQy9CWjs7QURpQ1E7RUFDSSxXQUFBO0VBQ0EsZ0JBQUE7RUFDQSxhQUFBO0FDL0JaOztBRGlDUTtFQUNJLGNBQUE7RUFDQSxnQkFBQTtBQy9CWjs7QURpQ1E7RUFDSSwwQkFBQTtBQy9CWjs7QURtQ0k7RUFDSSxhQUFBO0VBQ0EsV0FBQTtFQUNBLDhCQUFBO0VBQ0EsYUFBQTtBQ2pDUjs7QURrQ1E7RUFDSSxhQUFBO0FDaENaOztBRGlDWTtFQUNJLGNBQUE7QUMvQmhCOztBRGtDUTtFQUNJLG1CQUFBO0VBQ0EsY0FBQTtFQUNBLGFBQUE7RUFDQSxrQkFBQTtFQUNBLFlBQUE7QUNoQ1o7O0FEaUNZO0VBQ0ksb0JBQUE7RUFDQSxjQUFBO0FDL0JoQjs7QURrQ1E7RUFDSSxnQkFBQTtFQUNBLGlCQUFBO0VBQ0Esa0JBQUE7RUFDQSxtQkFBQTtFQUNBLFlBQUE7QUNoQ1o7O0FEaUNZO0VBQ0csV0FBQTtBQy9CZjs7QURrQ1E7RUFDSSx5QkFBQTtBQ2hDWjs7QURpQ1k7RUFDSSxtQkFBQTtBQy9CaEI7O0FEZ0NnQjtFQUNJLFdBQUE7QUM5QnBCOztBRGlDWTtFQUNJLGlCQUFBO0VBQ0EsZUFBQTtBQy9CaEI7O0FEZ0NnQjtFQUNHLFdBQUE7QUM5Qm5COztBRHFDQTtFQUNJLG1CQUFBO0VBQ0EsdUJBQUE7RUFDQSxZQUFBO0VBQ0EsY0FBQTtFQUNBLGdCQUFBO0FDbENKOztBRHFDRTtFQUNJLDRCQUFBO0FDbENOOztBRG9DRTtFQUNFLGlCQUFBO0FDakNKIiwiZmlsZSI6InNyYy9hcHAvbW9kdWxlcy9ub3RpZmljYXRpb24vbm90aWZpY2F0aW9uL25vdGlmaWNhdGlvbi5jb21wb25lbnQuc2NzcyIsInNvdXJjZXNDb250ZW50IjpbIkBtaXhpbiBmbGV4Y2VudGVyIHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcclxuICAgIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcclxufVxyXG5AbWl4aW4gZmxleHN0YXJ0IHtcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIGZsZXhlbmQge1xyXG4gICAgZGlzcGxheTogZmxleDtcclxuICAgIGp1c3RpZnktY29udGVudDogZmxleC1lbmQ7XHJcbiAgICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XHJcbn1cclxuQG1peGluIHNwYWNlYmV0d2VlbiB7XHJcbiAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xyXG59XHJcbi50eHQtM3tcclxuICAgIGNvbG9yOiAjMzMzO1xyXG59ICBcclxuLnR4dC02e1xyXG4gICAgY29sb3I6ICM2NjY2NjY7XHJcbn0gICAgXHJcbi50eHQtOXtcclxuICAgIGNvbG9yOiAjNjY2O1xyXG59IFxyXG5ib2R5e1xyXG4gICAgYmFja2dyb3VuZDogI2ZmZjtcclxufVxyXG4ucGFnZS1jb250ZW50e1xyXG4gICAgd2lkdGg6IDEwMCU7XHJcbiAgICBtYXJnaW46IDAgYXV0bztcclxuICAgIHBhZGRpbmctdG9wOiAwcHg7XHJcbiAgICAuYnJlZHNjcnVtaW5leHB7XHJcbiAgICAgICAgcGFkZGluZy1sZWZ0OiAzNXB4O1xyXG4gICAgICAgIHBhZGRpbmctcmlnaHQ6IDM1cHg7ICBcclxuICAgICAgICBwYWRkaW5nLWJvdHRvbTogMHB4O1xyXG4gICAgfVxyXG59XHJcbi50b3BiYXJ7XHJcbiAgICAgYWxpZ24taXRlbXM6IGNlbnRlcjtcclxufVxyXG4uZGlzY3Vzc2lvbmxlZnRyaWdodCB7XHJcbiAgICBib3JkZXItdG9wOiAzcHggc29saWQgIzAwNmNiNztcclxuICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICBtYXJnaW4tbGVmdDogMzBweDtcclxuICAgIG1hcmdpbi1yaWdodDogMzBweDtcclxuICAgIGJveC1zaGFkb3c6IDAgMnB4IDZweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xyXG4gICAgLmxlZnRzaWRlY29udGVudCB7XHJcbiAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICB3aWR0aDogNDIwcHg7XHJcbiAgICAgICAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RkZDsgICAgICAgXHJcbiAgICAgICAgLmxlZnR0b3Age1xyXG4gICAgICAgICAgICBAaW5jbHVkZSBzcGFjZWJldHdlZW4oKTtcclxuICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDEwcHg7XHJcbiAgICAgICAgICAgIC5tZW51dG9waWMge1xyXG4gICAgICAgICAgICAgICAgaGVpZ2h0OiAzMHB4O1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDMwcHg7XHJcbiAgICAgICAgICAgICAgICBAaW5jbHVkZSBmbGV4Y2VudGVyKCk7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzU1NTtcclxuICAgICAgICAgICAgICAgIC5tYXQtYnV0dG9uLXdyYXBwZXIge1xyXG4gICAgICAgICAgICAgICAgICAgIG1heC1oZWlnaHQ6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgICAgICBhbGlnbi1pdGVtczogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIHAge1xyXG4gICAgICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5zZWFyY2hhbmRtb3JlIHtcclxuICAgICAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhlbmQoKTtcclxuICAgICAgICAgICAgICAgIGkge1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDVweDtcclxuICAgICAgICAgICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiA1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2NjY7XHJcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgICY6bnRoLWNoaWxkKDIpIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiA1cHg7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgfVxyXG4gICAgI3RvcGljc2FuZGFjcmNoaWV2ZSB7XHJcblxyXG4gICAgICAgIC5tYXQtdGFiLWxhYmVscyB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICBtYXJnaW4tbGVmdDogMDtcclxuICAgICAgICAgICAgLy8gYm94LXNoYWRvdzogaW5zZXQgMCAwIDVweCByZ2JhKDE2OCwgMTcyLCAxODMsIDAuMzUpO1xyXG4gICAgICAgICAgICBwYWRkaW5nOiA1cHg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtdGFiLWxhYmVse1xyXG4gICAgICAgICAgICBvcGFjaXR5OiAxICFpbXBvcnRhbnQ7ICBcclxuICAgICAgICAgICAgaGVpZ2h0OiA0MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICAubWF0LXRhYi1saXN0e1xyXG4gICAgICAgICAgICBvcGFjaXR5OiAxICFpbXBvcnRhbnQ7ICBcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2YyZjNmNztcclxuICAgICAgICAgICAgaGVpZ2h0OiA1MHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LXRhYi1ib2R5IHtcclxuICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwO1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogMDtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgICAgICB9XHJcbiAgICAgICAgLm1hdC10YWItbGFiZWwge1xyXG4gICAgICAgICAgICB3aWR0aDogNTAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJvcmRlci1yYWRpdXM6IDJweDtcclxuICAgICAgICAgICAgaGVpZ2h0OiA0MHB4O1xyXG4gICAgICAgICAgICBtYXJnaW4tcmlnaHQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLm1hdC10YWItbGFiZWwtYWN0aXZlIHtcclxuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogIzAwNmNiNztcclxuICAgICAgICAgICAgLm1hdC10YWItbGFiZWwtY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH1cclxuICAgICAgICAubWF0LXRhYi1oZWFkZXIge1xyXG4gICAgICAgICAgICBib3JkZXI6IDA7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6IHRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtaW5rLWJhciB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLmVhY2h0b3BpY2NvbnRhaW5lciB7XHJcbiAgICAgICAgICAgIHBhZGRpbmc6IDBweCAxMHB4O1xyXG4gICAgICAgICAgICAuZWFjaHRvcGljaXRlbSB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nLXRvcDogMjBweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiAyMHB4O1xyXG4gICAgICAgICAgICAgICAgbWluLWhlaWdodDogNzBweDtcclxuICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgICAgICAgICAgICAgIC5jaGVja2JveGVzIHtcclxuICAgICAgICAgICAgICAgICAgICB3aWR0aDogMjVweDtcclxuICAgICAgICAgICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICAgICAgICAgIGp1c3RpZnktY29udGVudDogY2VudGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDVweDtcclxuICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDEuMjVyZW07XHJcbiAgICAgICAgICAgICAgICAgICAgaXtcclxuICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICNmNTgwMjA7XHJcbiAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLnRvcGljZGV0YWlscyB7XHJcbiAgICAgICAgICAgICAgICAgICAgd2lkdGg6IGNhbGMoMTAwJSAtIDgwcHgpO1xyXG4gICAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICAgICAgY3Vyc29yOiBwb2ludGVyO1xyXG4gICAgICAgICAgICAgICAgICAgIC51c2VyaW1hZ2Uge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogNTVweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiA1NXB4O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHotaW5kZXg6IDA7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICY6OmFmdGVyIHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGNvbnRlbnQ6IFwiXCI7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjU4MDIwO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IGFic29sdXRlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgaGVpZ2h0OiA2MCU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICByaWdodDogLTNweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIHdpZHRoOiA2NyU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB6LWluZGV4OiAtMTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGJvdHRvbTogLTNweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICBpbWcge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB6LWluZGV4OiA5OTk5O1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgYmFja2dyb3VuZDogI2ZmZjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICAudXNlcmNvbnRlbnQge1xyXG4gICAgICAgICAgICAgICAgICAgICAgICB3aWR0aDogY2FsYygxMDAlIC0gNTVweCk7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIHBhZGRpbmctbGVmdDogMjBweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgLnRvcGljbmFtZSB7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMXJlbTtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIG1hcmdpbjogMDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OjYwMDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgICAgICAgICAuZGF0ZWFuZGNyZWF0ZWJ5IHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIEBpbmNsdWRlIGZsZXhzdGFydCgpO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgY29sb3I6ICM2NTY1NjU7XHJcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBmb250LXNpemU6IDAuODEyNXJlbTsgICAgICAgICAgICAgICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAuY291bnRpbmd7XHJcbiAgICAgICAgICAgICAgICAgICAgcHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjA0MjQyO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMXB4IDlweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICAuY291bnRhc2h7XHJcbiAgICAgICAgICAgICAgICAgICAgcHtcclxuICAgICAgICAgICAgICAgICAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZGRkO1xyXG4gICAgICAgICAgICAgICAgICAgICAgICBjb2xvcjogIzMzMztcclxuICAgICAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMXB4IDlweDtcclxuICAgICAgICAgICAgICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAgICAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbiAgICAucmlnaHRzaWRlY29udGVudCB7XHJcbiAgICAgICAgd2lkdGg6MTAwJTsgICAgICAgIFxyXG4gICAgICAgIHBhZGRpbmctbGVmdDogMHB4OyAgICAgICBcclxuICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgIC5yaWdodGluZm97XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7IFxyXG4gICAgICAgICAgICB3aWR0aDoxMDAlO1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgIGhlaWdodDogNTBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjJmM2Y3O1xyXG4gICAgICAgICAgICBwYWRkaW5nLWxlZnQ6IDIwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctcmlnaHQ6IDIwcHg7XHJcbiAgICAgICAgICAgIHBhZGRpbmctdG9wOiA4cHg7XHJcbiAgICAgICAgICAgIHB7XHJcbiAgICAgICAgICAgICAgICBtYXJnaW46IDA7XHJcbiAgICAgICAgICAgIH1cclxuXHJcbiAgICAgICAgfVxyXG4gICAgICAgIFxyXG4gICAgICAgIC5jaGVja2JveGVze1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXRvcDogNXB4O1xyXG4gICAgICAgICAgICAubWF0LWNoZWNrYm94LWZyYW1le1xyXG4gICAgICAgICAgICAgICAgYm9yZGVyLXdpZHRoOiAxcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAuc29ydGJ5IHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiA4cHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDEuMTI1cmVtO1xyXG4gICAgICAgICAgICAgICAgY29sb3I6ICMzMzM7ICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICBwYWRkaW5nOiAwcHg7XHJcbiAgICAgICAgICAgICAgICAgZm9udC1mYW1pbHk6ICdjYWlyb3NlbWlib2xkJztcclxuICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMzRweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgbGluZS1oZWlnaHQ6IDZweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXgge1xyXG4gICAgICAgICAgICAgICAgICBtYXJnaW4tdG9wOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgYm9yZGVyLXRvcDogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDAuNWVtIDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XHJcbiAgICAgICAgICAgICAgICAgIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1idXR0b24ge1xyXG4gICAgICAgICAgICAgICAgICBtaW4td2lkdGg6IDBweDtcclxuICAgICAgICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgICBcclxuICAgICAgICAuc2VhcmNoZmlsdGVye1xyXG4gICAgICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgICAgICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XHJcbiAgICAgICAgICAgIC5zZWFyY2hQcm9qZWN0IHtcclxuICAgICAgICAgICAgICAgIHdpZHRoOiAyNzVweDtcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZHtcclxuICAgICAgICAgICAgICAgICAgICBib3JkZXI6IDFweCBzb2xpZCAjZTVlNWU1O1xyXG4gICAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDA7XHJcbiAgICAgICAgICAgICAgICAgICAgbWFyZ2luOiAwO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXdyYXBwZXJ7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1ib3R0b206IDA7XHJcbiAgICAgICAgICAgICAgICB9ICAgIFxyXG4gICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLWZsZXgge1xyXG4gICAgICAgICAgICAgICAgICBwb3NpdGlvbjogcmVsYXRpdmU7XHJcbiAgICAgICAgICAgICAgICAgIGJvcmRlcjogMXB4IHNvbGlkICNmZmY7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmc6IDFweCAxMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgIHBhZGRpbmctYm90dG9tOiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xyXG4gICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiAycHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgaGVpZ2h0OiAzM3B4O1xyXG4gICAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtaW5maXh7XHJcbiAgICAgICAgICAgICAgICAgICAgYm9yZGVyLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZzogMDtcclxuICAgICAgICAgICAgICAgICAgICBwYWRkaW5nLXRvcDogNnB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGJvcmRlci10b3A6IDQwcHg7XHJcbiAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXN1ZmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi1sZWZ0OiAxMHB4O1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiAjYzBiYmJiO1xyXG4gICAgICAgICAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiBib2xkO1xyXG4gICAgICAgICAgICAgICAgICAgIHRvcDogMHB4OyAgICAgICBcclxuICAgICAgICAgICAgICAgICAgICAubWF0LWljb257XHJcbiAgICAgICAgICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMThweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgICAgLm1hdC1mb3JtLWZpZWxkLXByZWZpeCB7XHJcbiAgICAgICAgICAgICAgICAgICAgcG9zaXRpb246IHJlbGF0aXZlO1xyXG4gICAgICAgICAgICAgICAgICAgIG1hcmdpbi1yaWdodDogMTBweDtcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xyXG4gICAgICAgICAgICAgICAgICBkaXNwbGF5OiBub25lO1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1hcHBlYXJhbmNlLWZpbGwgLm1hdC1mb3JtLWZpZWxkLWZsZXgge1xyXG4gICAgICAgICAgICAgICAgICBib3JkZXItcmFkaXVzOiBub25lICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0gXHJcbiAgICAgICAgfSAgICAgICBcclxuICAgICAgICBidXR0b24ge1xyXG4gICAgICAgICAgY3Vyc29yOiBwb2ludGVyOyAgIFxyXG4gICAgICAgICAgd2lkdGg6IGF1dG8gIWltcG9ydGFudDtcclxuICAgICAgICB9ICBcclxuICAgICAgICAudW5yZWR7XHJcbiAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICBjb2xvcjogIzAwMDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLnNvcnR7XHJcbiAgICAgICAgICAgIC5zb3J0Ynkge1xyXG4gICAgICAgICAgICAgICAgd2lkdGg6IDhweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcclxuICAgICAgICAgICAgICAgIGZvbnQtc2l6ZTogMC44NzVyZW07XHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzMzMzsgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIHBhZGRpbmc6IDBweDtcclxuICAgICAgICAgICAgICAgICBmb250LWZhbWlseTogJ2NhaXJvc2VtaWJvbGQnO1xyXG4gICAgICAgICAgICAgICAgbWluLXdpZHRoOiA2NHB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBsaW5lLWhlaWdodDogNnB4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICBcclxuICAgICAgICAgICAgICAgIC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XHJcbiAgICAgICAgICAgICAgICAgIG1hcmdpbi10b3A6IDBweCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgICBib3JkZXItdG9wOiAwcHggIWltcG9ydGFudDtcclxuICAgICAgICAgICAgICAgICAgcGFkZGluZzogMC41ZW0gMCAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcclxuICAgICAgICAgICAgICAgICAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgXHJcbiAgICAgICAgICAgICAgICAubWF0LWJ1dHRvbiB7XHJcbiAgICAgICAgICAgICAgICAgIG1pbi13aWR0aDogMHB4O1xyXG4gICAgICAgICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgICAgIH1cclxuICAgICAgICAgICAgfVxyXG4gICAgICAgIH0gIFxyXG4gICAgfVxyXG4gICAgXHJcbn1cclxuLmVkaXRkZWxldGUubWF0LW1lbnUtcGFuZWx7XHJcbiAgICAgICAgbWFyZ2luLXRvcDogNXB4O1xyXG4gICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMzMzMgIWltcG9ydGFudDsgICAgXHJcbiAgICAubWF0LW1lbnUtaXRlbXtcclxuICAgICAgICBoZWlnaHQ6IDMycHggIWltcG9ydGFudDtcclxuICAgICAgICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xyXG4gICAgICAgIGxpbmUtaGVpZ2h0OiAzMnB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbn1cclxuQG1lZGlhIChtYXgtd2lkdGg6IDc2OHB4KSB7XHJcbiAgICAuZGlzY3Vzc2lvbmxlZnRyaWdodCB7XHJcbiAgICAgICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcclxuICAgICAgICAuZWFjaHRvcGljY29udGFpbmVyIHtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5sZWZ0c2lkZWNvbnRlbnQge1xyXG4gICAgICAgICAgICB3aWR0aDogMTAwJSAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICBwYWRkaW5nLXJpZ2h0OiAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIGJvcmRlcjogMCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgICAgICAucmlnaHRzaWRlY29udGVudCB7XHJcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgIHBhZGRpbmctbGVmdDogM3B4ICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5qb2luY29tbWVudCB7XHJcbiAgICAgICAgICAgIHdpZHRoOiBjYWxjKDEwMCUgLSA1cHgpICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgfVxyXG4gICAgICAgICN0b3BpY3NhbmRhY3JjaGlldmUgLm1hdC10YWItbGFiZWxzIHtcclxuICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgd2lkdGg6IDEwMCU7XHJcbiAgICAgICAgICAgIG1hcmdpbi10b3A6IDAgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleCAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG5AbWVkaWEgKG1heC13aWR0aDogNzY3cHgpIHtcclxuICAgIC5lYWNoaXRlbWluZGV0YWlsIHtcclxuICAgICAgICAuZGl2aXNpb25zIHtcclxuICAgICAgICAgICAgLnRvcGljZGV0YWlscyB7XHJcbiAgICAgICAgICAgICAgICBkaXNwbGF5OiBibG9jayAhaW1wb3J0YW50O1xyXG4gICAgICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICAgICAgICAgIC51c2VyY29udGVudCB7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy1sZWZ0OiAwICFpbXBvcnRhbnQ7XHJcbiAgICAgICAgICAgICAgICAgICAgcGFkZGluZy10b3A6IDE1cHg7XHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICB9XHJcbn1cclxuLnJpZ2h0c2lkZWNvbnRlbnQxe1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxufVxyXG4ucmlnaHRjb250ZW50e1xyXG4gICAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcclxuICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVse1xyXG4gICAgICAgIGJveC1zaGFkb3c6IG5vbmU7XHJcbiAgICAgICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNkZGQ7XHJcbiAgICAgICAgYm9yZGVyLXJhZGl1czogMHB4ICFpbXBvcnRhbnQ7XHJcbiAgICB9XHJcbiAgICAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXItdGl0bGV7XHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIHB7XHJcbiAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5jb3VudGluZ3tcclxuICAgICAgICAgICAgZm9udC1zaXplOiAwLjc1cmVtO1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZjA0MjQyO1xyXG4gICAgICAgICAgICBjb2xvcjogI2ZmZjtcclxuICAgICAgICAgICAgcGFkZGluZzogM3B4IDlweDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMTBweDtcclxuICAgICAgICAgICAgbWFyZ2luLXJpZ2h0OiAxNXB4OyAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlcjpob3ZlcntcclxuICAgICAgICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xyXG4gICAgICAgIC50aXRsZWhvdmVye1xyXG4gICAgICAgICAgICBjb2xvcjojMDA2Y2I3O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgIC5tYXQtY2hlY2tib3gtZnJhbWV7XHJcbiAgICAgICAgYm9yZGVyLXdpZHRoOiAxcHggIWltcG9ydGFudDtcclxuICAgIH0gICBcclxuICAgIC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZHtcclxuICAgICAgICBiYWNrZ3JvdW5kLWNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgfVxyXG4gICAgLm1hdC1leHBhbnNpb24tcGFuZWwtaGVhZGVye1xyXG4gICAgICAgIHBhZGRpbmc6IDBweCAxMnB4OyAgXHJcbiAgICB9XHJcbiAgICAubWF0LWV4cGFuZGVke1xyXG4gICAgICAgIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlciB7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjcgIWltcG9ydGFudDtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7ICBcclxuICAgICAgICAgICAgcGFkZGluZzogMHB4IDEycHg7ICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgbWF0LXBhbmVsLXRpdGxle1xyXG4gICAgICAgICAgICBwe1xyXG4gICAgICAgICAgICAgICAgY29sb3I6I2ZmZiAhaW1wb3J0YW50OyBcclxuICAgICAgICAgICAgICAgIGRpc3BsYXk6IGZsZXg7XHJcbiAgICAgICAgICAgIH1cclxuICAgICAgICB9XHJcbiAgICAgICAgLnRpdGxlaG92ZXJ7XHJcbiAgICAgICAgICAgIGNvbG9yOiNmZmYgIWltcG9ydGFudDtcclxuICAgICAgICB9XHJcbiAgICAgICAgLm1hdC1jaGVja2JveC1mcmFtZXtcclxuICAgICAgICAgICAgY29sb3I6ICNmZmY7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgICAgIGJvcmRlcjogI2ZmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZHtcclxuICAgICAgICAgICAgY29sb3I6ICMwMDZjYjc7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQ6ICNmZmY7XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5tYXQtY2hlY2tib3gtY2hlY2ttYXJrLXBhdGh7XHJcbiAgICAgICAgICAgIHN0cm9rZTogIzAwNmNiNyAhaW1wb3J0YW50O1xyXG4gICAgICAgIH1cclxuICAgIH1cclxuICAgXHJcbiAgICAuYXJ0aWNsZXtcclxuICAgICAgICBkaXNwbGF5OiBmbGV4O1xyXG4gICAgICAgIHdpZHRoOiAxMDAlOyAgICAgICAgXHJcbiAgICAgICAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xyXG4gICAgICAgIHBhZGRpbmc6IDIwcHg7XHJcbiAgICAgICAgLmRvY2FydHtcclxuICAgICAgICAgICAgZGlzcGxheTogZmxleDtcclxuICAgICAgICAgICAgLmFydGRvY3tcclxuICAgICAgICAgICAgICAgIGNvbG9yOiAjMDA2Y2I3O1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgIC5ub3Rlc3tcclxuICAgICAgICAgICAgYmFja2dyb3VuZDogI2UwZjBmZjsgICAgICAgICAgIFxyXG4gICAgICAgICAgICBjb2xvcjogIzAwNmNiNztcclxuICAgICAgICAgICAgcGFkZGluZzogMTVweDtcclxuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogMnB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDYwcHg7XHJcbiAgICAgICAgICAgIGl7XHJcbiAgICAgICAgICAgICAgICBmb250LXNpemU6IDEuNTYyNXJlbTsgXHJcbiAgICAgICAgICAgICAgICBjb2xvcjogIzAwNmNiNzsgICAgICAgICAgICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgIH0gICAgICAgICAgICBcclxuICAgICAgICB9XHJcbiAgICAgICAgLmRvd25sb2Fke1xyXG4gICAgICAgICAgICBtYXJnaW4tdG9wOiAxNHB4O1xyXG4gICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmZjtcclxuICAgICAgICAgICAgcGFkZGluZzogMTFweCAxNXB4O1xyXG4gICAgICAgICAgICBib3JkZXItcmFkaXVzOiAyNXB4O1xyXG4gICAgICAgICAgICBoZWlnaHQ6IDQ1cHg7XHJcbiAgICAgICAgICAgIGl7XHJcbiAgICAgICAgICAgICAgIGNvbG9yOiNmZmY7IFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICAgICY6aG92ZXJ7XHJcbiAgICAgICAgICAgIGJhY2tncm91bmQtY29sb3I6ICNmMmYzZjc7XHJcbiAgICAgICAgICAgIC5ub3Rlc3tcclxuICAgICAgICAgICAgICAgIGJhY2tncm91bmQ6ICMwMDZjYjc7XHJcbiAgICAgICAgICAgICAgICBpe1xyXG4gICAgICAgICAgICAgICAgICAgIGNvbG9yOiNmZmY7ICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICB9IFxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIC5kb3dubG9hZHsgICAgICAgICAgICAgICAgXHJcbiAgICAgICAgICAgICAgICBiYWNrZ3JvdW5kOiAjZmZmZjsgICBcclxuICAgICAgICAgICAgICAgIGN1cnNvcjpwb2ludGVyOyAgICAgICAgICAgIFxyXG4gICAgICAgICAgICAgICAgaXtcclxuICAgICAgICAgICAgICAgICAgIGNvbG9yOiM2NjY7IFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIFxyXG4gICAgICAgIH1cclxuICAgIH1cclxufVxyXG4udGl0bGVob3ZlciB7XHJcbiAgICB3aGl0ZS1zcGFjZTogbm93cmFwO1xyXG4gICAgdGV4dC1vdmVyZmxvdzogZWxsaXBzaXM7XHJcbiAgICB3aWR0aDogMzUwcHg7XHJcbiAgICBkaXNwbGF5OiBibG9jaztcclxuICAgIG92ZXJmbG93OiBoaWRkZW47XHJcbiAgICBcclxuICB9XHJcbiAgLmFjdGl2ZWJyZWFkY3J1bWJ7XHJcbiAgICAgIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcclxuICB9XHJcbiAgLmZ3LWJvbGR7XHJcbiAgICBmb250LXdlaWdodDogYm9sZDtcclxuICB9IiwiLnR4dC0zIHtcbiAgY29sb3I6ICMzMzM7XG59XG5cbi50eHQtNiB7XG4gIGNvbG9yOiAjNjY2NjY2O1xufVxuXG4udHh0LTkge1xuICBjb2xvcjogIzY2Njtcbn1cblxuYm9keSB7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG59XG5cbi5wYWdlLWNvbnRlbnQge1xuICB3aWR0aDogMTAwJTtcbiAgbWFyZ2luOiAwIGF1dG87XG4gIHBhZGRpbmctdG9wOiAwcHg7XG59XG4ucGFnZS1jb250ZW50IC5icmVkc2NydW1pbmV4cCB7XG4gIHBhZGRpbmctbGVmdDogMzVweDtcbiAgcGFkZGluZy1yaWdodDogMzVweDtcbiAgcGFkZGluZy1ib3R0b206IDBweDtcbn1cblxuLnRvcGJhciB7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXI7XG59XG5cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IHtcbiAgYm9yZGVyLXRvcDogM3B4IHNvbGlkICMwMDZjYjc7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIG1hcmdpbi1sZWZ0OiAzMHB4O1xuICBtYXJnaW4tcmlnaHQ6IDMwcHg7XG4gIGJveC1zaGFkb3c6IDAgMnB4IDZweCByZ2JhKDAsIDAsIDAsIDAuMTUpO1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLmxlZnRzaWRlY29udGVudCB7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG4gIHdpZHRoOiA0MjBweDtcbiAgYm9yZGVyLXJpZ2h0OiAxcHggc29saWQgI2RkZDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5sZWZ0c2lkZWNvbnRlbnQgLmxlZnR0b3Age1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgcGFkZGluZy1ib3R0b206IDEwcHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAubGVmdHNpZGVjb250ZW50IC5sZWZ0dG9wIC5tZW51dG9waWMge1xuICBoZWlnaHQ6IDMwcHg7XG4gIHdpZHRoOiAzMHB4O1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGNlbnRlcjtcbiAgYWxpZ24taXRlbXM6IGNlbnRlciAhaW1wb3J0YW50O1xuICBjb2xvcjogIzU1NTtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5sZWZ0c2lkZWNvbnRlbnQgLmxlZnR0b3AgLm1lbnV0b3BpYyAubWF0LWJ1dHRvbi13cmFwcGVyIHtcbiAgbWF4LWhlaWdodDogMTAwJTtcbiAgZGlzcGxheTogZmxleDtcbiAgYWxpZ24taXRlbXM6IGNlbnRlcjtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5sZWZ0c2lkZWNvbnRlbnQgLmxlZnR0b3AgcCB7XG4gIG1hcmdpbjogMDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5sZWZ0c2lkZWNvbnRlbnQgLmxlZnR0b3AgLnNlYXJjaGFuZG1vcmUge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtZW5kO1xuICBhbGlnbi1pdGVtczogY2VudGVyICFpbXBvcnRhbnQ7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAubGVmdHNpZGVjb250ZW50IC5sZWZ0dG9wIC5zZWFyY2hhbmRtb3JlIGkge1xuICBwYWRkaW5nLXJpZ2h0OiA1cHg7XG4gIG1hcmdpbi1yaWdodDogMTVweDtcbiAgcGFkZGluZy1sZWZ0OiA1cHg7XG4gIGNvbG9yOiAjNjY2O1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAubGVmdHNpZGVjb250ZW50IC5sZWZ0dG9wIC5zZWFyY2hhbmRtb3JlIGk6bnRoLWNoaWxkKDIpIHtcbiAgbWFyZ2luLXJpZ2h0OiA1cHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWxhYmVscyB7XG4gIHdpZHRoOiAxMDAlO1xuICBtYXJnaW4tbGVmdDogMDtcbiAgcGFkZGluZzogNXB4O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAubWF0LXRhYi1sYWJlbCB7XG4gIG9wYWNpdHk6IDEgIWltcG9ydGFudDtcbiAgaGVpZ2h0OiA0MHB4ICFpbXBvcnRhbnQ7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWxpc3Qge1xuICBvcGFjaXR5OiAxICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQ6ICNmMmYzZjc7XG4gIGhlaWdodDogNTBweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nOiAwcHggIWltcG9ydGFudDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0ICN0b3BpY3NhbmRhY3JjaGlldmUgLm1hdC10YWItYm9keSB7XG4gIHBhZGRpbmctbGVmdDogMDtcbiAgcGFkZGluZy1yaWdodDogMDtcbiAgcGFkZGluZy10b3A6IDA7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWxhYmVsIHtcbiAgd2lkdGg6IDUwJSAhaW1wb3J0YW50O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGhlaWdodDogNDBweDtcbiAgbWFyZ2luLXJpZ2h0OiAwICFpbXBvcnRhbnQ7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWxhYmVsLWFjdGl2ZSAubWF0LXRhYi1sYWJlbC1jb250ZW50IHtcbiAgY29sb3I6ICNmZmY7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5tYXQtdGFiLWhlYWRlciB7XG4gIGJvcmRlcjogMDtcbiAgYmFja2dyb3VuZC1jb2xvcjogdHJhbnNwYXJlbnQgIWltcG9ydGFudDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0ICN0b3BpY3NhbmRhY3JjaGlldmUgLm1hdC1pbmstYmFyIHtcbiAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAuZWFjaHRvcGljY29udGFpbmVyIHtcbiAgcGFkZGluZzogMHB4IDEwcHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5lYWNodG9waWNjb250YWluZXIgLmVhY2h0b3BpY2l0ZW0ge1xuICBkaXNwbGF5OiBmbGV4O1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbiAgcGFkZGluZy10b3A6IDIwcHg7XG4gIHBhZGRpbmctYm90dG9tOiAyMHB4O1xuICBtaW4taGVpZ2h0OiA3MHB4O1xuICBwYWRkaW5nLWxlZnQ6IDIwcHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5lYWNodG9waWNjb250YWluZXIgLmVhY2h0b3BpY2l0ZW0gLmNoZWNrYm94ZXMge1xuICB3aWR0aDogMjVweDtcbiAgZGlzcGxheTogZmxleDtcbiAganVzdGlmeS1jb250ZW50OiBjZW50ZXI7XG4gIG1hcmdpbi10b3A6IDVweDtcbiAgZm9udC1zaXplOiAxLjI1cmVtO1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAuZWFjaHRvcGljY29udGFpbmVyIC5lYWNodG9waWNpdGVtIC5jaGVja2JveGVzIGkge1xuICBjb2xvcjogI2Y1ODAyMDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0ICN0b3BpY3NhbmRhY3JjaGlldmUgLmVhY2h0b3BpY2NvbnRhaW5lciAuZWFjaHRvcGljaXRlbSAudG9waWNkZXRhaWxzIHtcbiAgd2lkdGg6IGNhbGMoMTAwJSAtIDgwcHgpO1xuICBkaXNwbGF5OiBmbGV4O1xuICBjdXJzb3I6IHBvaW50ZXI7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5lYWNodG9waWNjb250YWluZXIgLmVhY2h0b3BpY2l0ZW0gLnRvcGljZGV0YWlscyAudXNlcmltYWdlIHtcbiAgd2lkdGg6IDU1cHg7XG4gIGhlaWdodDogNTVweDtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICB6LWluZGV4OiAwO1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAuZWFjaHRvcGljY29udGFpbmVyIC5lYWNodG9waWNpdGVtIC50b3BpY2RldGFpbHMgLnVzZXJpbWFnZTo6YWZ0ZXIge1xuICBjb250ZW50OiBcIlwiO1xuICBiYWNrZ3JvdW5kOiAjZjU4MDIwO1xuICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gIGhlaWdodDogNjAlO1xuICByaWdodDogLTNweDtcbiAgd2lkdGg6IDY3JTtcbiAgei1pbmRleDogLTE7XG4gIGJvdHRvbTogLTNweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0ICN0b3BpY3NhbmRhY3JjaGlldmUgLmVhY2h0b3BpY2NvbnRhaW5lciAuZWFjaHRvcGljaXRlbSAudG9waWNkZXRhaWxzIC51c2VyaW1hZ2UgaW1nIHtcbiAgbWF4LXdpZHRoOiAxMDAlO1xuICB3aWR0aDogMTAwJTtcbiAgei1pbmRleDogOTk5OTtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBtYXgtd2lkdGg6IDEwMCU7XG4gIGJhY2tncm91bmQ6ICNmZmY7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5lYWNodG9waWNjb250YWluZXIgLmVhY2h0b3BpY2l0ZW0gLnRvcGljZGV0YWlscyAudXNlcmNvbnRlbnQge1xuICB3aWR0aDogY2FsYygxMDAlIC0gNTVweCk7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0ICN0b3BpY3NhbmRhY3JjaGlldmUgLmVhY2h0b3BpY2NvbnRhaW5lciAuZWFjaHRvcGljaXRlbSAudG9waWNkZXRhaWxzIC51c2VyY29udGVudCAudG9waWNuYW1lIHtcbiAgY29sb3I6ICMzMzM7XG4gIGZvbnQtc2l6ZTogMXJlbTtcbiAgbWFyZ2luOiAwO1xuICBmb250LXdlaWdodDogNjAwO1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAuZWFjaHRvcGljY29udGFpbmVyIC5lYWNodG9waWNpdGVtIC50b3BpY2RldGFpbHMgLnVzZXJjb250ZW50IC5kYXRlYW5kY3JlYXRlYnkge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IGZsZXgtc3RhcnQ7XG4gIGFsaWduLWl0ZW1zOiBjZW50ZXIgIWltcG9ydGFudDtcbiAgbWFyZ2luOiAwO1xuICBjb2xvcjogIzY1NjU2NTtcbiAgZm9udC1zaXplOiAwLjgxMjVyZW07XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAjdG9waWNzYW5kYWNyY2hpZXZlIC5lYWNodG9waWNjb250YWluZXIgLmVhY2h0b3BpY2l0ZW0gLmNvdW50aW5nIHAge1xuICBmb250LXNpemU6IDAuNzVyZW07XG4gIGJhY2tncm91bmQ6ICNmMDQyNDI7XG4gIGNvbG9yOiAjZmZmO1xuICBwYWRkaW5nOiAxcHggOXB4O1xuICBib3JkZXItcmFkaXVzOiAxMHB4O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAuZWFjaHRvcGljY29udGFpbmVyIC5lYWNodG9waWNpdGVtIC5jb3VudGFzaCBwIHtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xuICBiYWNrZ3JvdW5kOiAjZGRkO1xuICBjb2xvcjogIzMzMztcbiAgcGFkZGluZzogMXB4IDlweDtcbiAgYm9yZGVyLXJhZGl1czogMTBweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IHtcbiAgd2lkdGg6IDEwMCU7XG4gIHBhZGRpbmctbGVmdDogMHB4O1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGJhY2tncm91bmQtY29sb3I6ICNmZmY7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAucmlnaHRpbmZvIHtcbiAgZGlzcGxheTogZmxleDtcbiAgd2lkdGg6IDEwMCU7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2VlbjtcbiAgaGVpZ2h0OiA1MHB4ICFpbXBvcnRhbnQ7XG4gIGJhY2tncm91bmQ6ICNmMmYzZjc7XG4gIHBhZGRpbmctbGVmdDogMjBweDtcbiAgcGFkZGluZy1yaWdodDogMjBweDtcbiAgcGFkZGluZy10b3A6IDhweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5yaWdodGluZm8gcCB7XG4gIG1hcmdpbjogMDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5jaGVja2JveGVzIHtcbiAgZGlzcGxheTogZmxleDtcbiAgcGFkZGluZy10b3A6IDVweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5jaGVja2JveGVzIC5tYXQtY2hlY2tib3gtZnJhbWUge1xuICBib3JkZXItd2lkdGg6IDFweCAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLmNoZWNrYm94ZXMgLnNvcnRieSB7XG4gIHdpZHRoOiA4cHggIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICBmb250LXNpemU6IDEuMTI1cmVtO1xuICBjb2xvcjogIzMzMztcbiAgcGFkZGluZzogMHB4O1xuICBmb250LWZhbWlseTogXCJjYWlyb3NlbWlib2xkXCI7XG4gIG1pbi13aWR0aDogMzRweCAhaW1wb3J0YW50O1xuICBsaW5lLWhlaWdodDogNnB4ICFpbXBvcnRhbnQ7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuY2hlY2tib3hlcyAuc29ydGJ5IC5tYXQtZm9ybS1maWVsZC1pbmZpeCB7XG4gIG1hcmdpbi10b3A6IDBweCAhaW1wb3J0YW50O1xuICBib3JkZXItdG9wOiAwcHggIWltcG9ydGFudDtcbiAgcGFkZGluZzogMC41ZW0gMCAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLmNoZWNrYm94ZXMgLnNvcnRieSAubWF0LWZvcm0tZmllbGQtdW5kZXJsaW5lIHtcbiAgZGlzcGxheTogbm9uZSAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLmNoZWNrYm94ZXMgLnNvcnRieSAubWF0LWJ1dHRvbiB7XG4gIG1pbi13aWR0aDogMHB4O1xuICBjb2xvcjogI2ZmZjtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5zZWFyY2hmaWx0ZXIge1xuICBkaXNwbGF5OiBmbGV4O1xuICBqdXN0aWZ5LWNvbnRlbnQ6IHNwYWNlLWJldHdlZW47XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuc2VhcmNoZmlsdGVyIC5zZWFyY2hQcm9qZWN0IHtcbiAgd2lkdGg6IDI3NXB4O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnNlYXJjaGZpbHRlciAuc2VhcmNoUHJvamVjdCAubWF0LWZvcm0tZmllbGQge1xuICBib3JkZXI6IDFweCBzb2xpZCAjZTVlNWU1O1xuICBwYWRkaW5nOiAwO1xuICBtYXJnaW46IDA7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuc2VhcmNoZmlsdGVyIC5zZWFyY2hQcm9qZWN0IC5tYXQtZm9ybS1maWVsZC13cmFwcGVyIHtcbiAgcGFkZGluZy1ib3R0b206IDA7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuc2VhcmNoZmlsdGVyIC5zZWFyY2hQcm9qZWN0IC5tYXQtZm9ybS1maWVsZC1mbGV4IHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBib3JkZXI6IDFweCBzb2xpZCAjZmZmO1xuICBwYWRkaW5nOiAxcHggMTJweCAhaW1wb3J0YW50O1xuICBwYWRkaW5nLWJvdHRvbTogMTBweDtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbiAgYm9yZGVyLXJhZGl1czogMnB4ICFpbXBvcnRhbnQ7XG4gIGhlaWdodDogMzNweDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5zZWFyY2hmaWx0ZXIgLnNlYXJjaFByb2plY3QgLm1hdC1mb3JtLWZpZWxkLWZsZXggLm1hdC1mb3JtLWZpZWxkLWluZml4IHtcbiAgYm9yZGVyLWJvdHRvbTogMHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDA7XG4gIHBhZGRpbmctdG9wOiA2cHg7XG4gIGJvcmRlci10b3A6IDQwcHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuc2VhcmNoZmlsdGVyIC5zZWFyY2hQcm9qZWN0IC5tYXQtZm9ybS1maWVsZC1mbGV4IC5tYXQtZm9ybS1maWVsZC1zdWZmaXgge1xuICBwb3NpdGlvbjogcmVsYXRpdmU7XG4gIG1hcmdpbi1sZWZ0OiAxMHB4O1xuICBjb2xvcjogI2MwYmJiYjtcbiAgZm9udC13ZWlnaHQ6IGJvbGQ7XG4gIHRvcDogMHB4O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnNlYXJjaGZpbHRlciAuc2VhcmNoUHJvamVjdCAubWF0LWZvcm0tZmllbGQtZmxleCAubWF0LWZvcm0tZmllbGQtc3VmZml4IC5tYXQtaWNvbiB7XG4gIGZvbnQtc2l6ZTogMThweCAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnNlYXJjaGZpbHRlciAuc2VhcmNoUHJvamVjdCAubWF0LWZvcm0tZmllbGQtZmxleCAubWF0LWZvcm0tZmllbGQtcHJlZml4IHtcbiAgcG9zaXRpb246IHJlbGF0aXZlO1xuICBtYXJnaW4tcmlnaHQ6IDEwcHg7XG59XG4uZGlzY3Vzc2lvbmxlZnRyaWdodCAucmlnaHRzaWRlY29udGVudCAuc2VhcmNoZmlsdGVyIC5zZWFyY2hQcm9qZWN0IC5tYXQtZm9ybS1maWVsZC11bmRlcmxpbmUge1xuICBkaXNwbGF5OiBub25lO1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnNlYXJjaGZpbHRlciAuc2VhcmNoUHJvamVjdCAubWF0LWZvcm0tZmllbGQtYXBwZWFyYW5jZS1maWxsIC5tYXQtZm9ybS1maWVsZC1mbGV4IHtcbiAgYm9yZGVyLXJhZGl1czogbm9uZSAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgYnV0dG9uIHtcbiAgY3Vyc29yOiBwb2ludGVyO1xuICB3aWR0aDogYXV0byAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnVucmVkIHtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xuICBjb2xvcjogIzAwMDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5zb3J0IC5zb3J0Ynkge1xuICB3aWR0aDogOHB4ICFpbXBvcnRhbnQ7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGN1cnNvcjogcG9pbnRlcjtcbiAgZm9udC1zaXplOiAwLjg3NXJlbTtcbiAgY29sb3I6ICMzMzM7XG4gIHBhZGRpbmc6IDBweDtcbiAgZm9udC1mYW1pbHk6IFwiY2Fpcm9zZW1pYm9sZFwiO1xuICBtaW4td2lkdGg6IDY0cHggIWltcG9ydGFudDtcbiAgbGluZS1oZWlnaHQ6IDZweCAhaW1wb3J0YW50O1xufVxuLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQgLnNvcnQgLnNvcnRieSAubWF0LWZvcm0tZmllbGQtaW5maXgge1xuICBtYXJnaW4tdG9wOiAwcHggIWltcG9ydGFudDtcbiAgYm9yZGVyLXRvcDogMHB4ICFpbXBvcnRhbnQ7XG4gIHBhZGRpbmc6IDAuNWVtIDAgIWltcG9ydGFudDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5zb3J0IC5zb3J0YnkgLm1hdC1mb3JtLWZpZWxkLXVuZGVybGluZSB7XG4gIGRpc3BsYXk6IG5vbmUgIWltcG9ydGFudDtcbn1cbi5kaXNjdXNzaW9ubGVmdHJpZ2h0IC5yaWdodHNpZGVjb250ZW50IC5zb3J0IC5zb3J0YnkgLm1hdC1idXR0b24ge1xuICBtaW4td2lkdGg6IDBweDtcbiAgY29sb3I6ICNmZmY7XG59XG5cbi5lZGl0ZGVsZXRlLm1hdC1tZW51LXBhbmVsIHtcbiAgbWFyZ2luLXRvcDogNXB4O1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjMzMzICFpbXBvcnRhbnQ7XG59XG4uZWRpdGRlbGV0ZS5tYXQtbWVudS1wYW5lbCAubWF0LW1lbnUtaXRlbSB7XG4gIGhlaWdodDogMzJweCAhaW1wb3J0YW50O1xuICBjb2xvcjogI2ZmZiAhaW1wb3J0YW50O1xuICBsaW5lLWhlaWdodDogMzJweCAhaW1wb3J0YW50O1xufVxuXG5AbWVkaWEgKG1heC13aWR0aDogNzY4cHgpIHtcbiAgLmRpc2N1c3Npb25sZWZ0cmlnaHQge1xuICAgIGRpc3BsYXk6IGJsb2NrICFpbXBvcnRhbnQ7XG4gIH1cbiAgLmRpc2N1c3Npb25sZWZ0cmlnaHQgLmVhY2h0b3BpY2NvbnRhaW5lciB7XG4gICAgd2lkdGg6IDEwMCU7XG4gIH1cbiAgLmRpc2N1c3Npb25sZWZ0cmlnaHQgLmxlZnRzaWRlY29udGVudCB7XG4gICAgd2lkdGg6IDEwMCUgIWltcG9ydGFudDtcbiAgICBwYWRkaW5nLXJpZ2h0OiAwICFpbXBvcnRhbnQ7XG4gICAgYm9yZGVyOiAwICFpbXBvcnRhbnQ7XG4gIH1cbiAgLmRpc2N1c3Npb25sZWZ0cmlnaHQgLnJpZ2h0c2lkZWNvbnRlbnQge1xuICAgIHdpZHRoOiAxMDAlICFpbXBvcnRhbnQ7XG4gICAgcGFkZGluZy1sZWZ0OiAzcHggIWltcG9ydGFudDtcbiAgfVxuICAuZGlzY3Vzc2lvbmxlZnRyaWdodCAuam9pbmNvbW1lbnQge1xuICAgIHdpZHRoOiBjYWxjKDEwMCUgLSA1cHgpICFpbXBvcnRhbnQ7XG4gIH1cbiAgLmRpc2N1c3Npb25sZWZ0cmlnaHQgI3RvcGljc2FuZGFjcmNoaWV2ZSAubWF0LXRhYi1sYWJlbHMge1xuICAgIG1hcmdpbi1sZWZ0OiAwICFpbXBvcnRhbnQ7XG4gICAgd2lkdGg6IDEwMCU7XG4gICAgbWFyZ2luLXRvcDogMCAhaW1wb3J0YW50O1xuICAgIGRpc3BsYXk6IGZsZXggIWltcG9ydGFudDtcbiAgfVxufVxuQG1lZGlhIChtYXgtd2lkdGg6IDc2N3B4KSB7XG4gIC5lYWNoaXRlbWluZGV0YWlsIC5kaXZpc2lvbnMgLnRvcGljZGV0YWlscyB7XG4gICAgZGlzcGxheTogYmxvY2sgIWltcG9ydGFudDtcbiAgICBwYWRkaW5nOiAxNXB4O1xuICB9XG4gIC5lYWNoaXRlbWluZGV0YWlsIC5kaXZpc2lvbnMgLnRvcGljZGV0YWlscyAudXNlcmNvbnRlbnQge1xuICAgIHBhZGRpbmctbGVmdDogMCAhaW1wb3J0YW50O1xuICAgIHBhZGRpbmctdG9wOiAxNXB4O1xuICB9XG59XG4ucmlnaHRzaWRlY29udGVudDEge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZmZmO1xufVxuXG4ucmlnaHRjb250ZW50IHtcbiAgYmFja2dyb3VuZC1jb2xvcjogI2ZmZjtcbn1cbi5yaWdodGNvbnRlbnQgLm1hdC1leHBhbnNpb24tcGFuZWwge1xuICBib3gtc2hhZG93OiBub25lO1xuICBib3JkZXItYm90dG9tOiAxcHggc29saWQgI2RkZDtcbiAgYm9yZGVyLXJhZGl1czogMHB4ICFpbXBvcnRhbnQ7XG59XG4ucmlnaHRjb250ZW50IC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlci10aXRsZSB7XG4gIGp1c3RpZnktY29udGVudDogc3BhY2UtYmV0d2Vlbjtcbn1cbi5yaWdodGNvbnRlbnQgLm1hdC1leHBhbnNpb24tcGFuZWwtaGVhZGVyLXRpdGxlIHAge1xuICBkaXNwbGF5OiBmbGV4O1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXItdGl0bGUgLmNvdW50aW5nIHtcbiAgZm9udC1zaXplOiAwLjc1cmVtO1xuICBiYWNrZ3JvdW5kOiAjZjA0MjQyO1xuICBjb2xvcjogI2ZmZjtcbiAgcGFkZGluZzogM3B4IDlweDtcbiAgYm9yZGVyLXJhZGl1czogMTBweDtcbiAgbWFyZ2luLXJpZ2h0OiAxNXB4O1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXI6aG92ZXIge1xuICBiYWNrZ3JvdW5kOiB0cmFuc3BhcmVudCAhaW1wb3J0YW50O1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuc2lvbi1wYW5lbC1oZWFkZXI6aG92ZXIgLnRpdGxlaG92ZXIge1xuICBjb2xvcjogIzAwNmNiNztcbn1cbi5yaWdodGNvbnRlbnQgLm1hdC1jaGVja2JveC1mcmFtZSB7XG4gIGJvcmRlci13aWR0aDogMXB4ICFpbXBvcnRhbnQ7XG59XG4ucmlnaHRjb250ZW50IC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZCB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjc7XG59XG4ucmlnaHRjb250ZW50IC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlciB7XG4gIHBhZGRpbmc6IDBweCAxMnB4O1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuZGVkIC5tYXQtZXhwYW5zaW9uLXBhbmVsLWhlYWRlciB7XG4gIGJhY2tncm91bmQtY29sb3I6ICMwMDZjYjcgIWltcG9ydGFudDtcbiAgY29sb3I6ICNmZmY7XG4gIHBhZGRpbmc6IDBweCAxMnB4O1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuZGVkIG1hdC1wYW5lbC10aXRsZSBwIHtcbiAgY29sb3I6ICNmZmYgIWltcG9ydGFudDtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5yaWdodGNvbnRlbnQgLm1hdC1leHBhbmRlZCAudGl0bGVob3ZlciB7XG4gIGNvbG9yOiAjZmZmICFpbXBvcnRhbnQ7XG59XG4ucmlnaHRjb250ZW50IC5tYXQtZXhwYW5kZWQgLm1hdC1jaGVja2JveC1mcmFtZSB7XG4gIGNvbG9yOiAjZmZmO1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xuICBib3JkZXI6ICNmZmZmO1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuZGVkIC5tYXQtY2hlY2tib3gtY2hlY2tlZC5tYXQtYWNjZW50IC5tYXQtY2hlY2tib3gtYmFja2dyb3VuZCB7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBiYWNrZ3JvdW5kOiAjZmZmO1xufVxuLnJpZ2h0Y29udGVudCAubWF0LWV4cGFuZGVkIC5tYXQtY2hlY2tib3gtY2hlY2ttYXJrLXBhdGgge1xuICBzdHJva2U6ICMwMDZjYjcgIWltcG9ydGFudDtcbn1cbi5yaWdodGNvbnRlbnQgLmFydGljbGUge1xuICBkaXNwbGF5OiBmbGV4O1xuICB3aWR0aDogMTAwJTtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xuICBwYWRkaW5nOiAyMHB4O1xufVxuLnJpZ2h0Y29udGVudCAuYXJ0aWNsZSAuZG9jYXJ0IHtcbiAgZGlzcGxheTogZmxleDtcbn1cbi5yaWdodGNvbnRlbnQgLmFydGljbGUgLmRvY2FydCAuYXJ0ZG9jIHtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG4ucmlnaHRjb250ZW50IC5hcnRpY2xlIC5ub3RlcyB7XG4gIGJhY2tncm91bmQ6ICNlMGYwZmY7XG4gIGNvbG9yOiAjMDA2Y2I3O1xuICBwYWRkaW5nOiAxNXB4O1xuICBib3JkZXItcmFkaXVzOiAycHg7XG4gIGhlaWdodDogNjBweDtcbn1cbi5yaWdodGNvbnRlbnQgLmFydGljbGUgLm5vdGVzIGkge1xuICBmb250LXNpemU6IDEuNTYyNXJlbTtcbiAgY29sb3I6ICMwMDZjYjc7XG59XG4ucmlnaHRjb250ZW50IC5hcnRpY2xlIC5kb3dubG9hZCB7XG4gIG1hcmdpbi10b3A6IDE0cHg7XG4gIGJhY2tncm91bmQ6ICNmZmZmO1xuICBwYWRkaW5nOiAxMXB4IDE1cHg7XG4gIGJvcmRlci1yYWRpdXM6IDI1cHg7XG4gIGhlaWdodDogNDVweDtcbn1cbi5yaWdodGNvbnRlbnQgLmFydGljbGUgLmRvd25sb2FkIGkge1xuICBjb2xvcjogI2ZmZjtcbn1cbi5yaWdodGNvbnRlbnQgLmFydGljbGU6aG92ZXIge1xuICBiYWNrZ3JvdW5kLWNvbG9yOiAjZjJmM2Y3O1xufVxuLnJpZ2h0Y29udGVudCAuYXJ0aWNsZTpob3ZlciAubm90ZXMge1xuICBiYWNrZ3JvdW5kOiAjMDA2Y2I3O1xufVxuLnJpZ2h0Y29udGVudCAuYXJ0aWNsZTpob3ZlciAubm90ZXMgaSB7XG4gIGNvbG9yOiAjZmZmO1xufVxuLnJpZ2h0Y29udGVudCAuYXJ0aWNsZTpob3ZlciAuZG93bmxvYWQge1xuICBiYWNrZ3JvdW5kOiAjZmZmZjtcbiAgY3Vyc29yOiBwb2ludGVyO1xufVxuLnJpZ2h0Y29udGVudCAuYXJ0aWNsZTpob3ZlciAuZG93bmxvYWQgaSB7XG4gIGNvbG9yOiAjNjY2O1xufVxuXG4udGl0bGVob3ZlciB7XG4gIHdoaXRlLXNwYWNlOiBub3dyYXA7XG4gIHRleHQtb3ZlcmZsb3c6IGVsbGlwc2lzO1xuICB3aWR0aDogMzUwcHg7XG4gIGRpc3BsYXk6IGJsb2NrO1xuICBvdmVyZmxvdzogaGlkZGVuO1xufVxuXG4uYWN0aXZlYnJlYWRjcnVtYiB7XG4gIGZvbnQtZmFtaWx5OiBcImNhaXJvc2VtaWJvbGRcIjtcbn1cblxuLmZ3LWJvbGQge1xuICBmb250LXdlaWdodDogYm9sZDtcbn0iXX0= */";
    /***/
  },

  /***/
  "./src/app/modules/notification/notification/notification.component.ts":
  /*!*****************************************************************************!*\
    !*** ./src/app/modules/notification/notification/notification.component.ts ***!
    \*****************************************************************************/

  /*! exports provided: NotificationComponent */

  /***/
  function srcAppModulesNotificationNotificationNotificationComponentTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "NotificationComponent", function () {
      return NotificationComponent;
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


    var _env_environment__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @env/environment */
    "./src/environments/environment.ts");
    /* harmony import */


    var _app_modules_notification_notification_notification_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/modules/notification/notification/notification.service */
    "./src/app/modules/notification/notification/notification.service.ts");
    /* harmony import */


    var _angular_material_paginator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/material/paginator */
    "./node_modules/@angular/material/__ivy_ngcc__/fesm2015/paginator.js");
    /* harmony import */


    var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(
    /*! @angular/forms */
    "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");

    var NotificationComponent = /*#__PURE__*/function () {
      function NotificationComponent(noticeservice) {
        _classCallCheck(this, NotificationComponent);

        this.noticeservice = noticeservice;
        this.panelOpenState = false;
        this.tabnotice = true;
        this.tabbroad = false;
        this.tabadvisory = false;
        this.tabcontract = false;
        this.tabbid = false;
        this.noticetrash = false;
        this.broadtrash = false;
        this.advisorytrash = false;
        this.customCollapsedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_2__["environment"].customCollapsedHeight;
        this.customExpandedHeight = _env_environment__WEBPACK_IMPORTED_MODULE_2__["environment"].customExpandedHeight;
        this.checkall = false; // readtoogle:boolean = false;
        // filternotice:string = '';

        this.category_trash = 1;
        this.page = 0;
        this.perpage = 10;
        this.resultsnoticeLength = 0;
        this.resultsawardLength = 0;
        this.resultsLength = 0;
        this.datafor = 'notice';
        this.cleardata = false;
        this.filterform = new _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormGroup"]({
          searchbytitle: new _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormControl"](''),
          sorting: new _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormControl"](''),
          unreadmsg: new _angular_forms__WEBPACK_IMPORTED_MODULE_5__["FormControl"]('')
        }); // noticelist: Eachrnoticelist[];

        this.allnoticelist = [];
        this.trashnoticelist = [];
        this.unreadflag = false; // noticelist = []

        this.notification_title = 'Enquiries';
        this.noticelist = [{
          title: "Received a New RFQ [Ref. No ?] ",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "You have received a RFQ from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",
          para2: "Daleel",
          checked: false
        }, {
          title: "Received an Updated RFQ [Ref. No here ?]",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "You have received an updated Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",
          para2: "Daleel",
          checked: false
        }, {
          title: "Respond to RFQ [Ref. No here ?]",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "Reminder to respond to the received Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",
          para2: "Daleel",
          checked: false
        }, {
          title: "Received a New RFQ [Ref. No here ?]",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "You have received a Request for Quotation (RFQ) from [Ref. No - title ?]. Kindly respond to the RFQ on or before (d-m-Y) 01-05-2022 11:46 AM(UTC-10:00).",
          para2: "Daleel",
          checked: false
        }, {
          title: "RFQ [Ref. No here ?] has been Terminated.",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "PDO has terminated the Request for Quotation (RFQ) from [Ref. No - title ?]",
          para2: "Daleel",
          checked: false
        }, {
          title: "This is the primary content of the panel",
          date: "21-01-2020",
          time: "19:00(GMT+4)",
          para1: "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
          para2: "Business Gateways International (I) Private Limited",
          checked: false
        }, {
          title: "Reviewing Existing Documentation",
          date: "20-01-2020",
          time: "20:00(GMT+4)",
          para1: "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
          para2: "Business Gateways International (I) Private Limited",
          checked: false
        }, {
          title: "Sample Privacy Policy Template - Terms-Feed",
          date: "22-01-2020",
          time: "06:00(GMT+4)",
          para1: "Google Tasks. Google Tasks lets you create a to-do list within your desktop Gmail or the Google Tasks app When you add a task, you can integrate it into your Gmail calendar, and add details or subtasks.With the updated Gmail design, Google Tasks is sleeker and easier to incorporate into your work routine.Flaticon has plenty of qualified graphic designers who are creating exclusive content on a daily basis.",
          para2: "Business Gateways International (I) Private Limited",
          checked: false
        }];
      }

      _createClass(NotificationComponent, [{
        key: "isOverflowing",
        value: function isOverflowing(el) {
          return el.offsetWidth < el.scrollWidth;
        }
      }, {
        key: "ngOnInit",
        value: function ngOnInit() {
          var _this = this;

          // this.paginator.length = 0;  
          this.filterform.get('searchbytitle').valueChanges.debounceTime(500).subscribe(function (val) {
            _this.noticedatas();
          });
          this.noticedatas();
        } // searchtitle(){
        //   // this.filterform.get('searchbytitle').valueChanges.debounceTime(500).subscribe(val => {
        //       this.noticedatas(); 
        //   // });
        // }

      }, {
        key: "noticePaginator",
        value: function noticePaginator(event) {
          this.noticedatas('pagination', event);
          this.paginator.pageIndex = event.pageIndex; // this.paginator.pageSize = event.pageSize;
          //this.paginator.page.emit(event);
        }
      }, {
        key: "noticetab",
        value: function noticetab() {
          if (this.tabnotice) {
            this.clear();
          }

          this.tabnotice = true;
          this.tabbroad = false;
          this.tabadvisory = false;
          this.tabcontract = false;
          this.tabbid = false;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'Enquiries';
          this.datafor = 'notice'; // this.noticedatas(); 
        }
      }, {
        key: "broadtab",
        value: function broadtab() {
          if (!this.tabbroad) {
            this.clear();
          }

          this.tabbroad = true;
          this.tabnotice = false;
          this.tabadvisory = false;
          this.tabcontract = false;
          this.tabbid = false;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false; // this.notification_title = 'Advisories'
        }
      }, {
        key: "advisorytab",
        value: function advisorytab() {
          if (!this.tabadvisory) {
            this.clear();
          }

          this.tabadvisory = true;
          this.tabbroad = false;
          this.tabnotice = false;
          this.tabcontract = false;
          this.tabbid = false;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'Advisories';
        }
      }, {
        key: "contracttab",
        value: function contracttab() {
          // if(!this.tabcontract){
          //   this.clear()
          // }
          this.tabcontract = false;
          this.tabadvisory = false;
          this.tabbroad = false;
          this.tabnotice = true;
          this.tabbid = false;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'Awards';
          this.datafor = 'awards';
          this.noticedatas();
        }
      }, {
        key: "bidtab",
        value: function bidtab() {
          if (!this.tabbid) {
            this.clear();
          }

          this.tabbid = true;
          this.tabcontract = false;
          this.tabadvisory = false;
          this.tabbroad = false;
          this.tabnotice = false;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'eBid';
        }
      }, {
        key: "tashnotice",
        value: function tashnotice() {
          if (!this.noticetrash) {
            this.clear();
          }

          this.tabbid = false;
          this.tabcontract = false;
          this.tabadvisory = false;
          this.tabbroad = false;
          this.tabnotice = true;
          this.noticetrash = false;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'Enquiries';
          this.datafor = 'trashnotice';
          this.noticedatas();
        }
      }, {
        key: "tashbroad",
        value: function tashbroad() {
          if (!this.broadtrash) {
            this.clear();
          }

          this.tabbid = false;
          this.tabcontract = false;
          this.tabadvisory = false;
          this.tabbroad = false;
          this.tabnotice = false;
          this.noticetrash = false;
          this.broadtrash = true;
          this.advisorytrash = false;
        }
      }, {
        key: "tashadvisory",
        value: function tashadvisory() {
          // if(!this.advisorytrash){
          //   this.clear()
          // }
          this.tabbid = false;
          this.tabcontract = false;
          this.tabadvisory = false;
          this.tabbroad = false;
          this.tabnotice = false;
          this.noticetrash = true;
          this.broadtrash = false;
          this.advisorytrash = false;
          this.notification_title = 'Awards';
          this.datafor = 'trashawards'; // this.noticedatas();
        }
      }, {
        key: "scrollTo",
        value: function scrollTo(className) {
          try {
            var elementList = document.querySelectorAll('.' + className);
            var element = elementList[0];
            element.scrollIntoView({
              behavior: 'smooth'
            });
          } catch (error) {
            console.log('page-content');
          }
        }
      }, {
        key: "noticedatas",
        value: function noticedatas(init, event) {
          var _this2 = this;

          if (init == "pagination") {
            this.perpage = event.pageSize;
            this.page = parseInt(event.pageIndex) + 1;
          }

          this.noticeservice.getnotification(this.datafor, this.filterform.value, this.perpage, this.page).subscribe(function (data) {
            _this2.setnoticevalue(data);
          });
        }
      }, {
        key: "filterunread",
        value: function filterunread() {
          this.unreadflag = !this.unreadflag;
          this.filterform.patchValue({
            unreadmsg: this.unreadflag
          });
          this.noticedatas();
        }
      }, {
        key: "updatenotification",
        value: function updatenotification(upaction) {
          var _this3 = this;

          var notificationIds = [];

          if (upaction == 'unread') {
            this.noticeservice.updatenotification(notificationIds, 1, this.datafor, this.filterform.value, this.perpage, this.page).subscribe(function (data) {
              _this3.setnoticevalue(data);
            });
          } else {
            this.allnoticelistfilter.forEach(function (val, key) {
              if (typeof val['checked'] != "string" && val['checked']) {
                notificationIds.push(val['bcastnotifdtls_pk']);
              }
            });

            if (notificationIds.length > 0) {
              if (upaction == 'read') {
                this.noticeservice.updatenotification(notificationIds, 2, this.datafor, this.filterform.value, this.perpage, this.page).subscribe(function (data) {
                  _this3.setnoticevalue(data);
                });
              } else if (upaction == 'delete') {
                this.noticeservice.updatenotification(notificationIds, 3, this.datafor, this.filterform.value, this.perpage, this.page).subscribe(function (data) {
                  _this3.setnoticevalue(data);
                });
              }
            }
          }
        }
      }, {
        key: "setnoticevalue",
        value: function setnoticevalue(data) {
          this.resultsnoticeLength = data['data']['total_notice_data'];
          this.resultsawardLength = data['data']['total_award_data'];

          if (this.datafor == 'notice' || this.datafor == 'trashnotice') {
            this.paginator.length = data['data']['total_notice_data'];
            this.resultsLength = data['data']['total_notice_data'];
          } else if (this.datafor == 'awards' || this.datafor == 'trashawards') {
            this.paginator.length = data['data']['total_award_data'];
            this.resultsLength = data['data']['total_award_data'];
          }

          this.allnoticelist = data['data']['notice_data'];
          this.allnoticelistfilter = this.allnoticelist;
          this.checkall = false;
        }
      }, {
        key: "sortnotification",
        value: function sortnotification(srttype) {
          this.filterform.patchValue({
            sorting: srttype
          });
          this.noticedatas();
        }
      }, {
        key: "castconversion",
        value: function castconversion(ischecked) {
          return typeof ischecked != "string" && ischecked ? true : false;
        }
      }, {
        key: "check_uncheckall",
        value: function check_uncheckall() {
          for (var i = 0; i < this.allnoticelistfilter.length; i++) {
            this.allnoticelistfilter[i].checked = this.checkall;
          }
        }
      }, {
        key: "isSelected",
        value: function isSelected() {
          this.checkall = this.allnoticelistfilter.every(function (notification_rec) {
            return notification_rec.checked == true;
          });
        }
      }, {
        key: "clear",
        value: function clear() {
          this.allnoticelistfilter = [];
          this.allnoticelist = [];
          this.unreadflag = false;
          this.checkall = false;
          this.check_uncheckall();
          this.page = 0; // this.cleardata = true;
          // this.filterform.patchValue({
          //   searchbytitle:''
          // });

          this.filterform.reset(); // this.filternotice = '';
        }
      }, {
        key: "tabidentify",
        value: function tabidentify(tabindex) {
          this.category_trash = tabindex.index == 0 ? 1 : 2;
          this.resultsnoticeLength = 0;
          this.resultsawardLength = 0;
          this.resultsLength = 0;
          this.paginator.pageIndex = 0;

          if (this.category_trash == 1) {
            this.noticetab();
          } else {
            this.tashnotice();
          }
        }
      }, {
        key: "statustoRead",
        value: function statustoRead(noifypk, index) {
          var notificationIds = [noifypk];

          if (this.allnoticelistfilter[index]['bnd_status'] == 1) {
            document.querySelectorAll('.removbold' + index)[0].classList.remove('fw-bold');
            this.noticeservice.updatenotification(notificationIds, 2, this.datafor, this.filterform.value, this.perpage, this.page).subscribe(function (data) {});
          }
        }
      }, {
        key: "messagecontent",
        value: function messagecontent(notice) {
          if (notice.bnm_isdeleted == 1 || notice.bnm_msgtype != 3) {
            return notice.para1;
          } else {
            return notice.para1 + ' ' + notice.bnm_closing_date + '.';
          }
        }
      }]);

      return NotificationComponent;
    }();

    NotificationComponent.ctorParameters = function () {
      return [{
        type: _app_modules_notification_notification_notification_service__WEBPACK_IMPORTED_MODULE_3__["NotificationService"]
      }];
    };

    Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])(_angular_material_paginator__WEBPACK_IMPORTED_MODULE_4__["MatPaginator"]), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:type", _angular_material_paginator__WEBPACK_IMPORTED_MODULE_4__["MatPaginator"])], NotificationComponent.prototype, "paginator", void 0);
    NotificationComponent = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
      selector: 'app-notification',
      template: Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! raw-loader!./notification.component.html */
      "./node_modules/raw-loader/dist/cjs.js!./src/app/modules/notification/notification/notification.component.html"))["default"],
      encapsulation: _angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewEncapsulation"].None,
      styles: [Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__importDefault"])(__webpack_require__(
      /*! ./notification.component.scss */
      "./src/app/modules/notification/notification/notification.component.scss"))["default"]]
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_app_modules_notification_notification_notification_service__WEBPACK_IMPORTED_MODULE_3__["NotificationService"]])], NotificationComponent);
    /***/
  },

  /***/
  "./src/app/modules/notification/notification/notification.service.ts":
  /*!***************************************************************************!*\
    !*** ./src/app/modules/notification/notification/notification.service.ts ***!
    \***************************************************************************/

  /*! exports provided: NotificationService */

  /***/
  function srcAppModulesNotificationNotificationNotificationServiceTs(module, __webpack_exports__, __webpack_require__) {
    "use strict";

    __webpack_require__.r(__webpack_exports__);
    /* harmony export (binding) */


    __webpack_require__.d(__webpack_exports__, "NotificationService", function () {
      return NotificationService;
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


    var _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(
    /*! @app/common/class/encrypt */
    "./src/app/common/class/encrypt.ts");
    /* harmony import */


    var _app_remote_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(
    /*! @app/remote.service */
    "./src/app/remote.service.ts");
    /* harmony import */


    var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(
    /*! @angular/common/http */
    "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");

    var NotificationService = /*#__PURE__*/function () {
      function NotificationService(http, _http, encryClass) {
        _classCallCheck(this, NotificationService);

        this.http = http;
        this._http = _http;
        this.encryClass = encryClass;
        this._url = 'nty/notification';
      }

      _createClass(NotificationService, [{
        key: "getnotification",
        value: function getnotification(datafor, filter, page, pageindex) {
          var body = JSON.stringify({
            'datafor': datafor,
            'filter': filter
          });
          return this._http.post("".concat(this._url, "/suppliernotices") + "?size=" + page + "&page=" + pageindex, body).map(function (res) {
            return res.json();
          });
        }
      }, {
        key: "updatenotification",
        value: function updatenotification(notifyPk, status, datafor, filter, page, pageindex) {
          var body = JSON.stringify({
            'notif_pk': notifyPk,
            'status': status,
            'datafor': datafor,
            'filter': filter
          });
          return this._http.post("".concat(this._url, "/supplierupdatenotices"), body).map(function (res) {
            return res.json();
          });
        }
      }]);

      return NotificationService;
    }();

    NotificationService.ctorParameters = function () {
      return [{
        type: _angular_common_http__WEBPACK_IMPORTED_MODULE_4__["HttpClient"]
      }, {
        type: _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"]
      }, {
        type: _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_2__["Encrypt"]
      }];
    };

    NotificationService = Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"])([Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])({
      providedIn: 'root'
    }), Object(tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"])("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_4__["HttpClient"], _app_remote_service__WEBPACK_IMPORTED_MODULE_3__["RemoteService"], _app_common_class_encrypt__WEBPACK_IMPORTED_MODULE_2__["Encrypt"]])], NotificationService);
    /***/
  }
}]);
//# sourceMappingURL=modules-notification-notification-module-es5.js.map