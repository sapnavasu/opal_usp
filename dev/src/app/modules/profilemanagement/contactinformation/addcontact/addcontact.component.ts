import { ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormBuilder, FormGroup, FormGroupDirective, Validators } from '@angular/forms';
import { MatDrawer } from '@angular/material/sidenav';
import { ActivatedRoute } from '@angular/router';
import { Filee } from '@app/@shared/filee/filee';
import { CityService } from '@app/common/city/service/city.service';
import { Encrypt } from '@app/common/class/encrypt';
import { DriveInput, ValidateDrive } from '@app/common/classes/driveInput';
import { AppLocalStorageServices } from '@app/common/localstorage/applocalstorage.services';
import { StateService } from '@app/common/state/service/state.service';
import { common_var as paramsValue } from '@env/common_veriables';
import * as _moment from 'moment';
import { default as _rollupMoment } from 'moment';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '../../../profilemanagement/animation';
import { ProfileService } from '../../profile.service';
import { MatTabGroup } from '@angular/material/tabs';
import {ToastrService} from 'ngx-toastr'
import { ErrorStateMatcher } from '@angular/material/core';


const moment = _rollupMoment || _moment;
export const MY_FORMATS = {
  parse: {
    dateInput: 'DD-MM-YYYY',
  },
  display: {
    dateInput: 'DD-MM-YYYY',
    monthYearLabel: 'MMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY',
  },
};
interface Transtype {
  tvalue: string;
  tlabel: string;
}

export interface Locationlist {
  lflag: string;
  lcountry: string;
  lmobile: string;
  lmail: string;
  laddress: string;
}

@Component({
  selector: 'app-addcontact',
  templateUrl: './addcontact.component.html',
  styleUrls: ['./addcontact.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None
})
export class AddcontactComponent implements OnInit {
  matcher: ErrorStateMatcher = new ErrorStateMatcher();
  public formGroup: FormGroup;
  @ViewChild('mapTab') mapTab: ElementRef<HTMLElement>;
  @Input() drawer: MatDrawer;
  @Input() panel: number;
  animationState = 'out';
  animationState2 = 'out';
  @Input() locationType: number;
  @Input() sideNavHeaderName: string;
  @Input() popupContentPrefix: string;
  @Input() helpContent: string;
  @Input() dyHelpContent: any;
  @Input() showBusinessScope: boolean = false;
  @Input() sidePanelToggle: boolean = true;
  @Input() showLogo: boolean = false;
  @Input() hidePropertyType: boolean = false;
  @Input() hideCrn: boolean = false;
  @Input() hideBranchid: boolean = false;
  @Input() showDescription: boolean = false;
  @Input() showNationality: boolean = false;
  @Input() showOtherMarketPresence: boolean = false;
  @Input() namePlaceholder: string;
  @Input() descPlaceholder: string;
  @Input() addressPlaceholder: string;
  @Input() countrylist: any = [];
  @Input() companyname: string;
  @Input() perpage: number;
  @Output() marketpresencelist: any = new EventEmitter<any>();
  @Output() selectedPanel: any = new EventEmitter<any>();
  @ViewChild('tab') tab:MatTabGroup;
  @ViewChild('leasedoc') leaseDocFilee: Filee;
  @ViewChild('complogo') compLogoFilee: Filee;
  @Input() emailwebsite : boolean = false;
  @Input() portNamehide : boolean = false;
  @Input() hideComponentHeader : boolean = false;
  @ViewChild('formDirective') formDirective: FormGroupDirective;
  @Input() fromFactoryInfo : boolean = false;
  @Input() fromLogistic : boolean = false;
  @Input() noLeaseDoc : boolean = false;
  @Input() hideFax : boolean = false;
  @Input() headOfficeId: string;
  @Input() hideLocationlist: boolean = false;
  
  @Output() private validation = new EventEmitter<any>();
  @ViewChild('scrollDiv') scrollElement: ElementRef;
  @ViewChild('searchFieldbus') searchFieldbus : ElementRef;
  public countrylisttemp: any = [];
  public companypk: number;
  public encryptedcompanypk: string = '';
  
  // public country_code_flag: number = paramsValue.omanPk;
  // public country_code_flag_fax: number = paramsValue.omanPk;
  // public phonecode: string = paramsValue.omanDialCode;
  // public phonecodefax: string = paramsValue.omanDialCode;
  
  public country_code_flag;
  public country_code_flag_fax;
  public phonecode: string;
  public phonecodefax: string;

  public searchCountry: string;
  public searchState: string;
  public searchCity: string;
  public statelist: any = [];
  public selectedDeliveryType: any;
  public citylist: any = [];
  public buttonname: string = 'Add';
  public editMode: boolean = false;
  public maxDate = new Date();
  public minDate = new Date();
  public mapMarkerLocation: string = '';
  public latitude: number;
  public longitude: number;
  public enabled: boolean = true;
  public disableSubmitButton: boolean = false;
  public drv_leasedoc: DriveInput;
  public drv_repcomplogo: DriveInput;
  public countrydisabled:boolean = false;
  @Input() logoUrl: string;
  @Input() showPostalAddress: boolean = false;
  @Input() isHeadOfficeGiven: boolean;
  searchCountryFlag: string;
  searchCountryFlag1: string;
  defaultNationality: string;
  defaultCountryPk: any;
  lypisID: string;
  infotoggle:boolean = false;
  public sideNavSubHeaderNameText: any = 'Delivery';

  @Input() public set sideNavSubHeaderName(value: any) {
    this.sideNavSubHeaderNameText = value;
  }
  public get sideNavSubHeaderName() {
    return this.sideNavSubHeaderNameText;
  }



  transporttypes: Transtype[] = [
    {tvalue: '3', tlabel: 'Airways'},
    {tvalue: '1', tlabel: 'Railways'},
    {tvalue: '2', tlabel: 'Roadways'},
    {tvalue: '4', tlabel: 'Waterways'},
    // {tvalue: '5', tlabel: 'Pipe-Lines'},
  ];
  deliverytypes: Transtype[] = [
    {tvalue: '1', tlabel: 'Branch'},
    {tvalue: '2', tlabel: 'Warehouse'},
    {tvalue: '3', tlabel: 'Other'},
  ];
  public locationlists:any = [];
  public showmapbutton:boolean = true;
  
  previousFormValue: any;

  despchange(){
    this.infotoggle = !this.infotoggle;
  }

  /*Sar Starts*/
  public stkholdertype:number = 0;
  /*Sar Ens*/

  constructor(private formBuilder: FormBuilder, private profileService: ProfileService,
    private localStorage: AppLocalStorageServices, private stateService: StateService,
    private cityService: CityService, private cdr: ChangeDetectorRef,
    private security: Encrypt, private routeid: ActivatedRoute,public toastr: ToastrService) { }

  getlocationlist() {
    this.profileService.getcmsmatketpresencelist(16).subscribe(data => {
      if(data) {
        this.locationlists_backup = this.locationlists = data.data.items.data;
      }
    });
  }

  ngOnInit() {  
    this.getlocationlist();
    this.stkholdertype = this.localStorage.getInLocal('reg_type');
    this.country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
    this.country_code_flag_fax = Number(this.localStorage.getInLocal('countryPk'));
    this.phonecode = this.localStorage.getInLocal('country_dialcode');
    this.phonecodefax = this.localStorage.getInLocal('country_dialcode');
    if(paramsValue.omanPk!=undefined)
    {
    this.defaultNationality = (this.country_code_flag == paramsValue.omanPk) ? '1' : '2';
    this.defaultCountryPk =  paramsValue.omanPk;
    }
    this.lypisID = this.localStorage.getInLocal('lypis_id');
    this.locationType = (this.locationType) ? (this.locationType) : 0;
    this.namePlaceholder = (this.namePlaceholder) ? this.namePlaceholder : "Organisation Name";
    this.descPlaceholder = (this.descPlaceholder) ? this.descPlaceholder : "";
    this.addressPlaceholder = (this.addressPlaceholder) ? this.addressPlaceholder : "Organisation Address";
    
    this.companypk = this.localStorage.getInLocal('comp_pk');
    this.encryptedcompanypk = this.security.encrypt(this.companypk);
    this.initializeFormGroup();

    if(this.locationType == 1){
      this.formGroup.controls['name'].disable();
    }
    

    this.formGroup.controls['country'].valueChanges.subscribe(value => {
      if(value){
        this.getStateList(value);
      }
    });

    this.formGroup.controls['state'].valueChanges.subscribe(value => {
      if(value){
        this.getCityList(value);
      }
    });

    this.formGroup.controls['primeheadofz'].valueChanges.subscribe(checked => {
      if(checked && this.isHeadOfficeGiven) {
        swal({
          title: `Do you want to delete the existing Head Office?`,
          icon: 'warning',
          buttons: ["No", "Yes"],
          dangerMode: true,
          closeOnClickOutside: false,
          closeOnEsc: false
        }).then((willDelete) => {
          if (!willDelete) {
            this.formGroup.controls['primeheadofz'].setValue(false);
          }
        });
      }
    })


    this.drv_leasedoc = {
      fileMstPk: 19,
      selectedFilesPk:[]
    }

    this.drv_repcomplogo = {
      fileMstPk: 20,
      selectedFilesPk:[]
    }
    this.formGroup.valueChanges.map((value) => {
      var dataVal={type:this.locationType,value:this.formGroup.valid};
      this.validation.emit(dataVal)
    })
    .subscribe((value) => { });
  }

  setshowmap(val) {
    if(val.index == 0) {
      this.showmapbutton = true;
    } else {
      this.showmapbutton = false;
    }
  }
  public selectedAddress = [];
  mapselectedlocation() {
    this.profileService.getlocationdetail(this.selected_location_id).subscribe(data => {
      let dataToSend = {
        data: data['data'].items,
        isDelete: false,
        last_added_mp_pk: this.selected_location_id,
      };

      if(this.sidePanelToggle ==true){
        this.drawer.toggle();
      }

      this.marketpresencelist.emit(dataToSend);
    });
  }
  public selected_location_id = null;
  setlocationid(id) {
    this.selected_location_id = id;
    this.tab.selectedIndex = 0;
  }
  public locationlists_backup:any;
  filteroutlocation(searchword,type) {
    if(searchword != '') {
      let searchword_lowercase=searchword.toLowerCase().trim();
      if(type ==1){
        if(searchword_lowercase.length >=3){
          this.locationlists=this.locationlists.filter(x=>(x.country.toLowerCase().includes(searchword_lowercase)) || x.mcmpld_landlineno.toLowerCase().includes(searchword_lowercase)  || x.mcmpld_address.toLowerCase().includes(searchword_lowercase) || x.mcmpld_emailid.toLowerCase().includes(searchword_lowercase));
        }
      }
    } else {
      this.locationlists = this.locationlists_backup;
    }
  }

  public map_data_onload;
  initializeFormGroup() {
    this.formGroup = this.formBuilder.group({
      location_pk: ["", ""],
      companypk: [this.companypk, ""],
      name: ["", Validators.required],
      type: [this.locationType, Validators.required],
      otherloc: ["", ""],
      nationality: [this.defaultNationality, ""],
      crn: ["", ""],
      description: ["", ""],
      business_scope: ["", ""],
      branchid: ["", Validators.required],
      address: ["", Validators.required],
      latitude: ["", ""],
      longitude: ["", ""],
      country: [Number(this.localStorage.getInLocal('countryPk')), Validators.required],
      state: [null, ''],
      city: [null, ''],
      postaladdress: [null, ''],
      postalcountry: [null, ''],
      postalstate: [null, ''],
      postalcity: [null, ''],
      postalAddressAvailable: [false, ''],
      landline_cc: ["", Validators.required],
      landline_no: ["", Validators.required],
      landline_ext: ["", ""],
      faxnocc: ["", ""],
      faxno: ["", ""],
      emailid: ["", [Validators.required, Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]],
      website: ["", [Validators.pattern(/^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/)]],
      repcomplogo: ['',''],
      property_type: ['', Validators.required],
      issued_on: ['', ''],
      expired_on: ['', ''],
      leasedoc: ['', ''],
      selected_address: ['', ''],
      selected_latitude: ['', ''],
      selected_longitude: ['', ''],
      transporttype:['',''],
      deliveryLocationType:[null,''],
      primeheadofz:[null,''],
      headofficeid:[null,''],

    });
    this.getStateList(this.localStorage.getInLocal('countryPk'))
    if (this.locationType == 1) {
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    } else if (this.locationType == 2) {
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    } else if (this.locationType == 3) {
      this.form.business_scope.setValidators([Validators.required]);
      this.form.description.setValidators([Validators.required]);
      this.form.business_scope.updateValueAndValidity();
      this.form.description.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
      this.form.repcomplogo.setValidators([ValidateDrive]);
      this.form.repcomplogo.updateValueAndValidity();
    }
    else if (this.locationType == 5 || this.locationType == 6 || this.locationType == 11) {
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    } else if (this.locationType == 7) {
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    } else if (this.locationType == 8) {
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
    } else if (this.locationType == 12) {
      this.form.otherloc.setValidators([Validators.required]);
      this.form.otherloc.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    } else if (this.locationType == 13) {
      this.form.otherloc.setValidators(null);
      this.form.otherloc.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
      this.form.transporttype.setValidators([Validators.required]);
      this.form.transporttype.updateValueAndValidity();
      this.form.emailid.setValidators(null);
      this.form.emailid.updateValueAndValidity();
      this.form.website.setValidators(null);
      this.form.website.updateValueAndValidity();
      this.form.landline_cc.setValidators(null);
      this.form.landline_cc.updateValueAndValidity();
      this.form.landline_no.setValidators(null);
      this.form.landline_no.updateValueAndValidity();
      this.form.deliveryLocationType.setValidators(null);
      this.form.deliveryLocationType.updateValueAndValidity();
    } else if (this.locationType == 16) {
      this.form.otherloc.setValidators(null);
      this.form.otherloc.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.name.setValidators(null);
      this.form.name.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
      this.form.transporttype.setValidators(null);
      this.form.transporttype.updateValueAndValidity();
      this.form.deliveryLocationType.setValidators(null);
      this.form.deliveryLocationType.updateValueAndValidity();
      this.form.emailid.setValidators([Validators.required,Validators.pattern(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)]);
      this.form.emailid.updateValueAndValidity();
      this.form.website.setValidators(null);
      this.form.website.updateValueAndValidity();
      this.form.landline_cc.setValidators([Validators.required]);
      this.form.landline_cc.updateValueAndValidity();
      this.form.landline_no.setValidators([Validators.required]);
      this.form.landline_no.updateValueAndValidity();
    } else if(this.locationType == 4) {
      this.form.otherloc.setValidators(null);
      this.form.otherloc.updateValueAndValidity();
      this.form.crn.setValidators(null);
      this.form.crn.updateValueAndValidity();
      this.form.branchid.setValidators(null);
      this.form.branchid.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
      this.form.name.setValidators(null);
      this.form.name.updateValueAndValidity();
      this.form.emailid.setValidators(null);
      this.form.emailid.updateValueAndValidity();
      this.form.website.setValidators(null);
      this.form.website.updateValueAndValidity();
    } else if(this.locationType == 17) {
      this.form.nationality.setValidators([Validators.required]);
      this.form.nationality.updateValueAndValidity();
      this.form.property_type.setValidators(null);
      this.form.property_type.updateValueAndValidity();
    }

    if(this.stkholdertype == 6 && this.locationType == 2){
      this.form.crn.setValidators([Validators.required]);
      this.form.crn.updateValueAndValidity();
    }
  }

  patchForm(data) {
    this.formGroup.patchValue({
      location_pk: data.memcompmplocationdtls_pk,
      companypk: data.mcmpld_membercompmst_fk,
      name: data.mcmpld_officename,
      type: data.mcmpld_locationtype,
      otherloc: data.mcmpld_otherloc,
      nationality: data.mcmpld_nationality,
      crn: data.mcmpld_crregno,
      description: data.mcmpld_description,
      business_scope: data.mcmpld_businscope,
      branchid: data.mcmpld_branchid,
      address: data.mcmpld_address,
      latitude: data.mcmpld_latitude,
      longitude: data.mcmpld_longitude,
      country: Number(data.mcmpld_countrymst_fk),
      state: Number(data.mcmpld_statemst_fk),
      city: Number(data.mcmpld_citymst_fk),
      postalAddressAvailable: (data.mcmpld_ispostaladdr == 2) ? true : false,
      postaladdress: data.mcmpld_postaladdress,
      postalcountry: Number(data.mcmpld_postalcountrymst_fk),
      postalstate: Number(data.mcmpld_postalstatemst_fk),
      postalcity: Number(data.mcmpld_postalcitymst_fk),
      landline_cc: data.dialocode_country_code,
      landline_no: data.mcmpld_landlineno,
      landline_ext: data.mcmpld_landlineext,
      faxnocc: data.mcmpld_faxnocc,
      faxno: data.mcmpld_faxno,
      emailid: data.mcmpld_emailid,
      website: data.mcmpld_website,
      recomplogo:Array(data.mcmpld_complogo),
      leasedoc: data.mcmpld_leasedoc != null ? Array(data.mcmpld_leasedoc) : null,
      property_type: data.mcmpld_leasetype,
      issued_on: data.mcmpld_leasestartdt != null ? data.mcmpld_leasestartdt : '',
      expired_on: data.mcmpld_leaseenddt != null ? data.mcmpld_leaseenddt:'',
      transporttype:String(data.mcmpld_modeoftrans),
      deliveryLocationType:data.deliveryType,
    });
    this.formGroup.controls['primeheadofz'].setValue((data.mcmpld_isprimheadofc == 1) ? true : false, { emitEvent: false});
    this.formGroup.controls['headofficeid'].setValue((data.mcmpld_isprimheadofc == 2) ? this.headOfficeId : '', { emitEvent: false});
    this.changeLabelName(String(data.mcmpld_modeoftrans));
    this.map_data_onload = this.formGroup.value;

    if(data.mcmpld_ispostaladdr == 2) {
      this.form.postaladdress.setValue(this.form.address.value);
      this.form.postalcountry.setValue(this.form.country.value);
      this.form.postalstate.setValue(this.form.state.value);
      this.form.postalcity.setValue(this.form.city.value);
    }

    if(this.fromLogistic) {

      this.routeid.queryParams.subscribe(params => {
        if (params['fct']) {
          this.fctpk = params['fct'];
        }
      });
    }

    this.country_code_flag = Number(data.landlinecc);
    this.country_code_flag_fax = Number(data.landline_cc);
    this.country_code_flag = Number(data.dialcode_country_pk);
    this.phonecode = data.dialocode_country_code;
    this.setfaxcountryFlag(Number(data.mcmpld_countrymst_fk));
    this.mapMarkerLocation = data.mcmpld_address;
    if(this.locationType == 3){
      this.drv_repcomplogo.selectedFilesPk = Array(data.mcmpld_complogo);
      setTimeout(()=> { 
        if(this.compLogoFilee) {
          this.compLogoFilee.triggerChange(); 
        }
        this.previousFormValue = this.formDirective.value; 
      },1000);
    }
    this.drv_leasedoc.selectedFilesPk = Array(data.mcmpld_leasedoc);
    if(!this.fromFactoryInfo){
      setTimeout(()=> { if(this.leaseDocFilee) this.leaseDocFilee.triggerChange()},1000);
    }
    this.cdr.detectChanges();
    this.selected_ownertype = data.mcmpld_leasetype;
    if(this.fromFactoryInfo){
      this.hideShowDateField('');
    }
    this.previousFormValue = this.formDirective.value;
  }

  changeLabelName(value) {
    if(value == 1) {
      this.namePlaceholder = 'Train Station';
    } else if( value == 2) {
      this.namePlaceholder = 'Warehouse';
    } else if(value == 3) {
      this.namePlaceholder = 'Airport';
    } else if(value == 4) {
      this.namePlaceholder = 'Port';
    }
  }
  public selected_ownertype;
  public last_added_mp_pk;
  public fctpk;
  public transmode;
  public deliveryType;
  
  save(formDirective: FormGroupDirective) {
    if (this.formGroup.valid) {
      this.transmode = this.formGroup.controls['transporttype'].value;
      this.deliveryType = this.formGroup.controls['deliveryLocationType'].value;
      this.disableSubmitButton = true;

      this.profileService.saveMarketPresence(this.formGroup.getRawValue()).subscribe(data => {
        if (data['data'].status == 1) {
          this.last_added_mp_pk = data['data'].added_marketpresence_pk;
          this.disableSubmitButton = false;
          if(!this.fromFactoryInfo) {
            swal({
              title:this.popupContentPrefix ? this.popupContentPrefix + data['data'].data : data['data'].data.trim(),
              icon: 'success',
              closeOnClickOutside: false,
              closeOnEsc: false
            });
            if(this.sidePanelToggle ==true){
              this.drawer.toggle();
            }
            this.resetFile();
            this.resetData(formDirective);
            this.editMode = false;
          }
          if(this.fromLogistic) {

            this.routeid.queryParams.subscribe(params => {
              if (params['fct']) {
                this.fctpk = params['fct'];
              }
            });

          }
          this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, 1, this.perpage);
          let el: HTMLElement = this.mapTab.nativeElement;
          el.click();
        }
      });
    }
  }
externalSaveReset(dataType){
  if(dataType == 1){
    this.save(this.formDirective);
  }else if(dataType == 2){
    this.resetData(this.formDirective);
  }
}
  resetData(formDirective?: FormGroupDirective) {
    this.formGroup.reset();
    if (formDirective)
      formDirective.resetForm();
    this.disableSubmitButton = false;
    this.form.type.setValue(this.locationType);
    this.form.country.setValue(Number(this.localStorage.getInLocal('countryPk')));
    this.form.companypk.setValue(this.companypk);
    this.phonecode = '';
    this.country_code_flag = 0;
    this.country_code_flag_fax = 0;
    this.reloadGoogleMaps();
    this.animationState = 'out';
    this.animationState2="out";
    this.formGroup.controls['name'].enable();
    this.formGroup.controls['crn'].enable();
    this.country_code_flag = Number(this.localStorage.getInLocal('countryPk'));
    this.country_code_flag_fax = Number(this.localStorage.getInLocal('countryPk'));
    this.phonecode = this.localStorage.getInLocal('country_dialcode');
    this.phonecodefax = this.localStorage.getInLocal('country_dialcode');
    this.scrollElement.nativeElement.scrollTo(0, 0);
    this.getStateList(this.localStorage.getInLocal('countryPk'));
    if(this.searchFieldbus) {
      this.searchFieldbus.nativeElement.value = '';
    }
    this.filteroutlocation('','');
    this.selected_location_id = '';
  }

  showtoolicon:boolean=true;
  edit(data: any) {
    this.buttonname = 'Update';
    this.editMode = true;
    this.formGroup.controls['crn'].disable();
    if(this.sideNavHeaderName == "Registered Office"){
    this.countrydisabled = true;
    this.showtoolicon = false;
    }
    this.patchForm(data);
    if(!this.fromFactoryInfo){
      this.drawer.toggle();
    }
  }

  delete(pk: number, page?: number, search?: string) {
    swal({
      title: `Do you want to delete this ${this.sideNavHeaderName}?`,
      icon: 'warning',
      buttons: ["No", "Yes"],
      dangerMode: true,
      closeOnClickOutside: false,
      closeOnEsc: false
    }).then((willDelete) => {
      if (willDelete) {
        let encryptedPk = this.security.encrypt(pk);
        let encryptedType = this.security.encrypt(this.locationType);
        this.profileService.deleteMarketPresence(encryptedPk,encryptedType).subscribe(data => {
          if (data['data'].status == 1) {
            // swal({
            //   'title':this.sideNavHeaderName + ' deleted successfully',
            //   icon: 'success',
            //   closeOnClickOutside: false,
            //   closeOnEsc: false
            // });
            this.showSuccess()
            this.getMarketPresenceList(this.encryptedcompanypk, this.locationType, page, this.perpage, search, true);
          }
        });
      }
    });
  }
  showSuccess(){
    this.toastr.success('Deleted successfully.', 'Success !', {
        timeOut: 3000,
        "positionClass":"toast-bottom-left",
    });
  }

  getMarketPresenceList(companypk, type, pageno, perpage, search?: string, forDelete?: boolean) {
    forDelete = forDelete ? forDelete : false;
    this.profileService.getMarketPresenceList(companypk, type, pageno, perpage, search).subscribe(data => {
      if(this.deliverytypes){
      let index = null;
      index= this.deliverytypes.findIndex(x => x.tvalue == this.deliveryType);
      this.selectedDeliveryType =this.deliverytypes[index];
      }
      let dataToSend = {
        data: data['data'].items.data,
        count: data['data'].items.count,
        overallcount: data['data'].items.overallcount,
        isDelete: forDelete,
        last_added_mp_pk: this.last_added_mp_pk,
        deliverytypeData:this.selectedDeliveryType,
      };
      this.locationlists=data['data'].items.data;
      this.marketpresencelist.emit(dataToSend);
    })
  }

  setcountryFlag(value, type?: string) {
    this.country_code_flag = value;
    if(this.countrylist !== null){
    this.countrylist.forEach(x => {
      if (x.CountryMst_Pk == value) {
        this.formGroup.controls['landline_cc'].setValue(x.dialcode);
        this.phonecode = x.dialcode;
      }
    });
  }
  }

  setfaxcountryFlag(value, type?: string) {
    this.country_code_flag_fax = value;
    if(this.countrylist !== null){
    this.countrylist.forEach(x => {
      if (x.CountryMst_Pk == value) {
        // this.formGroup.controls['landline_cc'].setValue(x.dialcode);
        this.phonecodefax = x.dialcode;
      }
    });
  }
  }

  get form() {
    if(this.formGroup != undefined) {
      return this.formGroup.controls;
    }
  }

  getStateList(countrypk: number) {
    countrypk = (countrypk) ? countrypk : this.formGroup.controls['country'].value;
    this.stateService.getstatebyid(countrypk).subscribe(data => {
      this.statelist = data['data'];
    })
  }

  getCityList(statepk: number) {
    this.cityService.getcitybystateid(statepk).subscribe(data => {
      this.citylist = data['data'];
    })
  }

  getLocationDetails(value) {
    
    this.form.address.setValue(value.address);
    this.form.latitude.setValue(String(value.coordinates.latitude));
    this.form.longitude.setValue(String(value.coordinates.longitude));
    this.getcountrypk(value.countryName, value.stateName, value.cityName);
    if (value.countryName != paramsValue.omanRecordFromDB.CyM_CountryName_en) {
      let index = this.countrylist.findIndex(x => x.CyM_CountryName_en.toLowerCase().trim() == value.countryName.toLowerCase().trim());
      if (index !== -1) {
        this.phonecode = this.countrylist[index].dialcode;
        this.phonecodefax = this.countrylist[index].dialcode;
        this.country_code_flag = this.countrylist[index].CountryMst_Pk;
        this.country_code_flag_fax = this.countrylist[index].CountryMst_Pk;
        this.form.landline_cc.setValue(this.countrylist[index].dialcode);
      } else {
        this.phonecode = '';
        this.country_code_flag = 0;
        this.country_code_flag_fax = 0;
        this.form.landline_cc.setValue('');
      }
    } else {
      this.phonecode = paramsValue.omanDialCode;
      this.country_code_flag = paramsValue.omanPk;
      this.country_code_flag_fax = paramsValue.omanPk;
      this.form.landline_cc.setValue(paramsValue.omanDialCode);
    }
  }

  getcountrypk(country?: string, state?: string, city?: string) {
    
    
    this.profileService.getCountryStateCityPk(country, state, city).subscribe(data => {
      if (data.data.country == String(paramsValue.omanPk)) {
        this.form.nationality.setValue('1');
      } else {
        this.form.nationality.setValue('2', { emitEvent: false});
        this.form.country.setValue(Number(data.data.country));
      }
      this.form.state.setValue(Number(data.data.state));
      this.form.city.setValue(Number(data.data.city));
    })
  }

  hideShowDateField(event) {
  let event_check;
  if(event == '') {
    event_check = this.selected_ownertype;
  } else {
    event_check = event.value;
  }
  if (event_check == '1' || this.locationType == 13 || this.locationType == 16 || this.noLeaseDoc == true) {
    this.form.issued_on.setValue("");
    this.form.expired_on.setValue("");
    this.form.issued_on.setValidators(null);
    this.form.issued_on.updateValueAndValidity();
    this.form.expired_on.setValidators(null);
    this.form.expired_on.updateValueAndValidity();
    this.form.leasedoc.setValidators(null);
    this.form.leasedoc.updateValueAndValidity();
    if(this.form.leasedoc.value){
      this.form.leasedoc.reset();
      this.resetFile();
    }
  } else {
    this.form.issued_on.setValidators([Validators.required]);
    this.form.issued_on.updateValueAndValidity();
    this.form.expired_on.setValidators([Validators.required]);
    this.form.expired_on.updateValueAndValidity();
    this.form.leasedoc.setValidators([Validators.required]);
    this.form.leasedoc.updateValueAndValidity();
  }
}
toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontentmarketpresence') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }

  infolisting(divName: string) {
    if (divName === 'infoview') {
        this.animationState2 = this.animationState2 === 'out' ? 'in' : 'out';
    }
}

  reloadGoogleMaps() {
    this.enabled = false;
    this.cdr.detectChanges();
    this.enabled = true;
  }
  fileeSelected(file, fileId) {
    fileId.selectedFilesPk = file;
  }

  resetFile(){
    if(this.locationType == 3){
      this.drv_repcomplogo.selectedFilesPk = [];
      setTimeout(()=> { if(this.compLogoFilee) this.compLogoFilee.triggerChange() },1000);
    }
    this.drv_leasedoc.selectedFilesPk = [];
    if(!this.fromFactoryInfo){
      setTimeout(()=> { if(this.leaseDocFilee) this.leaseDocFilee.triggerChange() },1000);
    }
  }

  get isFormValid() {
    let isValid = true;
    if((this.formGroup.valid && !this.previousFormValue) || (this.previousFormValue && this.isFormValueChanged)){
      isValid = this.formGroup.invalid;
    }
    return isValid;
  }

  get isFormValueChanged() {
    return JSON.stringify(this.previousFormValue) !== JSON.stringify(this.formGroup.value);
  }

  showSweetAlert() {
    if (this.formGroup.touched) {
      let msg = '';
      if(this.locationType == 13) {
        msg = 'Logistics Location';
      } else {
        msg = this.sideNavHeaderName;
      }
      swal({
        title: 'Do you want to cancel adding this ' + msg + '?',
        text: 'All the data that you entered will be lost.',
        icon: 'warning',
        buttons: ['No', 'Yes'],
        dangerMode: true,
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then((willDelete) => {
        if (willDelete) {
          this.drawer.toggle(); 
          this.formGroup.reset();
          this.buttonname = 'Add';
          this.editMode = false;
          this.resetData();
          this.resetFile();
          this.disableSubmitButton = false;
          this.animationState = 'out';
          this.animationState2="out";
        }
      });
    } else {
      this.drawer.toggle(); 
      this.formGroup.reset();
      this.buttonname = 'Add';
      this.editMode = false;
      this.resetData();
      this.resetFile();
      this.disableSubmitButton = false;
      this.animationState = 'out';
      this.animationState2="out";
    }
  }

  setPostalAddress(event) {
    if(event.checked) {
      this.form.postaladdress.setValue(this.form.address.value);
      this.form.postalcountry.setValue(this.form.country.value);
      this.form.postalstate.setValue(this.form.state.value);
      this.form.postalcity.setValue(this.form.city.value);
    } else {
      this.form.postaladdress.setValue('');
      this.form.postalcountry.setValue('');
      this.form.postalstate.setValue('');
      this.form.postalcity.setValue('');
    }
  }


}
