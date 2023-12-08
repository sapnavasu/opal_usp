import { HttpClient } from '@angular/common/http';
import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { FormArray, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { MatPaginator } from '@angular/material/paginator';
import { Util } from '@app/@shared/util';
import { FileModel } from '@app/common/classes/fileCriteria';
import { FileeCriteria } from '@app/common/classes/fileeCriteria';
import { MapLocation } from '@app/common/classes/mapLocation';
import { RemoteService } from '@app/remote.service';
import { CustomValidators } from 'ng2-validation';
import { Observable } from 'rxjs';
import swal from 'sweetalert';
import { SlideInOutAnimation } from './../animation';
import { ProfileService } from './../profile.service';



declare const google: any;
@Component({
  selector: 'app-representativeoffice',
  templateUrl: './representativeoffice.component.html',
  styleUrls: ['./representativeoffice.component.scss'],
  animations: [SlideInOutAnimation],
  encapsulation: ViewEncapsulation.None ,
})
export class RepresentativeofficeComponent implements OnInit {
  filteredStates: Observable<any[]>;
  animationState = 'out';
  searchfilter:boolean=false;
  public representativeLogo: FileeCriteria;
  public showwelcomeback=(localStorage.getItem('userlastvisit') =='1')?'1':'0';
  url: string;
  lat: string;
  lng: string;
  searchresalt=1;
  // google maps zoom level
  zoom: number =5;
  perpage = 10;
  resultsLength = 0;
  representativeofficearray = [];
  representForm: FormGroup;
  public countryarray = [];
  public statearray = [];
  public cityarray = [];
  public searchinput;
  public national = '';
  public international = '';
  buttonname: string = "Add";
  statename: string = "";
  origin: string = 'N';
  
  show = false;
  selectedOrigin: string = null;
  selectedCountry: number = null;
  heading: string = "Add Representative Office";
  updateform:boolean=false;
  searchValue:string = '';
  public countryCode = '+968';
  public custom:any='';
  selectedstate:string=this.statearray.filter(x=> x.StateMst_Pk == this.statearray.map(x => x.StateMst_Pk)[0]).map( y => y.SM_StateName_en).join("");
  countrytypelist=[{
    value:"N",
    label:'National',
  },{
    value:"I",
    label:'International',
  }]

  constructor(private profileservice: ProfileService,
    private fb: FormBuilder, public http: RemoteService,
     public _http: HttpClient,public util: Util
  ) {
   }
  @ViewChild(MatPaginator) paginator: MatPaginator;
  //@ViewChild(ProfilemanagementheaderComponent) child;
  ngOnInit() {
    this.representativeLogo = {
      fileName: 'Company logo',
      fileNote: '',
      fileFormat: 'jpg, jpeg',
      fileSize: '1 MB',
      fileMaxCount: 1,
      fileData: '',
      selectedFiles: [],
  };
   // this.child.hdrvalue="Respresentative Office";
    const reg = /^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+(\.[a-z]{2,}){1,3}(#?\/?[a-zA-Z0-9#]+)*\/?(\?[a-zA-Z0-9-_]+=[a-zA-Z0-9-%]+&?)?$/;
    this.representForm = this.fb.group({
      state: [null, Validators.compose([Validators.required])],
      city: [null, Validators.compose([Validators.required])],
      country: [null, Validators.compose([Validators.required])],
      name: [null, ''],
      website: [null, Validators.compose([Validators.pattern(reg)])],
      addressrepresent: this.fb.array([
        this.getaddress()  // load first row at start
       ]),
      email: [null, Validators.compose([Validators.required,CustomValidators.email])],
      phone: [null, Validators.compose([Validators.required])],
      fax: [null, ''],
      googlesearch: [null, ''],
      lat: [null, ''],
      lng: [null, ''],
      code: [null, ''],
      category: ['R', ''],
      pk: [null, ''],
      business_scope: [null, Validators.compose([Validators.required])],
      repdesc: [null, Validators.compose([Validators.required])],
      brand: [null, ''],
      filepath: [null, ''],
    })
    this.profileservice.getcountrylist().subscribe(data => {
      this.countryarray = data['data'];
    })
    this.representForm.controls['country'].valueChanges.subscribe(fkvalue => {
      this.representForm.controls['state'].setValue(null);
      this.representForm.controls['city'].setValue(null);
    });
      
  }
  getcity(value) {
    this.cityarray = [];
    if(this.representForm.controls['pk'].value == null){
      this.custom=null;
    }else{
      this.custom=1
    }
    this.profileservice.getcity(this.representForm.controls['country'].value, value.StateMst_Pk,this.custom).subscribe(data => {
      this.cityarray = data['data'];
    })
  }
  getcountry(value) {
    this.statearray = [];
    this.profileservice.getstatebyid(value).subscribe(data => {
      this.statearray = data['data'];
    })
  }
  displayFnstate(state) {
    if (state) {
      return state.SM_StateName_en
    }
  }
  displayFncity(city) {
    if (city) {
      return city.CM_CityName_en
    }
  }
  ngAfterViewInit() {
    this.getrepresentativeoffice(0, this.perpage);
    this.paginator._intl.itemsPerPageLabel = 'Showing';
  }
  ngAfterContentChecked() {
    if (this.representForm.valid) {
        $("#branch").addClass('completed');
    }
  }
  getrepresentativeoffice(page: any, size: any) {
    this.profileservice.getrepresentativeoffice(page, size).subscribe(data => {
      this.representativeofficearray = [];
      this.representativeofficearray = data['data'].items;
      this.markers = data['data'].latlng;
      this.resultsLength = data['data'].total_count;
      this.searchresalt = data['data'].total_count;
    });
  }
  onPaginateChange(event) {
    var pageno = parseInt(event.pageIndex) + 1;
    this.getrepresentativeoffice(pageno, this.perpage);
  }
  onSelectFile(event) {
    if (event.target.files && event.target.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]); // read file as data url
      reader.onload = (event: any) => { // called once readAsDataURL is completed
        this.url = event.target.result;
      }
    }
  }
// initial center position for the map
  clickedMarker(label: string, index: number) {
  }
  searchiconclick() {
    this.searchfilter=!this.searchfilter;
  }
  setFormValue(datas: any) {
    this.buttonname = "Update";
    this.heading = "Update Representative Office";
    this.updateform=true;
    if (datas.MCMP_CountryMst_Fk) {
      this.statearray = [];
      this.profileservice.getstatebyid(datas.MCMP_CountryMst_Fk).subscribe(data => {
        this.statearray = data['data'];
        this.representForm.patchValue({ state:Number(datas.MCMP_StateMst_Fk)});
      })
    }
    if (datas.MCMP_StateMst_Fk) {
      this.cityarray = [];
      this.profileservice.getcity(datas.MCMP_CountryMst_Fk, datas.MCMP_StateMst_Fk,null).subscribe(data => {
        this.cityarray = data['data'];
        this.representForm.patchValue({ city:Number(datas.MCMP_CityMst_Fk)});
      })
    }
    var address = [{ address: datas.address }, { address: datas.address1 }, { address: datas.address2 }];
    let control = <FormArray>this.representForm.controls.addressrepresent;
    if (address) {
      control.controls = [];
      address.forEach(x => {
        if(x.address != '' && x.address != null){
          control.push(this.fb.group({
            address: x.address
          }))
        }
      })
    }
    if (datas.filePk != '') {
      let selectedLogo:FileModel={
          filePk:datas.filePk,
          fileName:datas.fileName,
          fileUrl:datas.fileUrl,
          fileSize:datas.fileName,
          fileModified:datas.fileName,
          fileType:datas.fileName,
      };
      this.representativeLogo.selectedFiles.push(selectedLogo);
  }
    this.representForm.patchValue({
      country: Number(datas.MCMP_CountryMst_Fk),
      brand: datas.brand,
      business_scope: datas.MCMP_Business_Scope,
      repdesc: datas.MCMP_RepresentDesc,
      website: datas.website,
      email: datas.email,
      phone: datas.phone,
      fax: datas.fax,
      pk: datas.pk,
      category: 'R'
    });
  }
  formreset() { 
    this.representForm.reset();
    this.buttonname = "Add";
    this.heading= "Add Representative Office";
    this.updateform=false;
    this.ngOnInit();
  }
  deletemarketpresence(row) {
    swal({
      title: 'Alert!',
      text: 'Do you want to delete?',
      icon: 'info',
      buttons: ['Cancel', 'Ok'],
      className: 'swal-delete',
      dangerMode: true,    
      }).then((willDelete:any) => {
        if(willDelete == true){
          this.profileservice.deletemarktprsnce(row).subscribe(data => {
                if (data) {
                  this.ngAfterViewInit();
                }
            });
          }
        });
  }
  markerDragEnd(m: marker, $event: MouseEvent) {
    var cnstr = m.lat + "," + m.lng;
    this.representForm.controls['AreaCoordinates'].setValue(cnstr);
      }
    
      markers: marker[] = [
        {
          lat: this.lat,
          lng: this.lng,
          label: 'A',
      draggable: true
        }
      ]

  onSubmitdata() {
    if (this.representForm.valid) {
      this.representForm.controls['filepath'].setValue(this.representativeLogo);
      this.updateform=false;
      this.representForm.value['category']="R";
      this.profileservice.createmrktprsnce(this.representForm.value).subscribe(data => {
        this.ngAfterViewInit();
        this.formreset();
      })
    }
  }
  mapit(address: string,value:string) {
    document.querySelector('mat-sidenav-content').scrollTop =0;
    if(value == 'F'){
      var location = (<HTMLInputElement>document.getElementById("inputCity")).value;
    }else{
      var location = address;
    }
    this.lat = '';
    this.lng = '';

    return this._http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + location + '&key=AIzaSyCTt5vrK08INU70Vn0_BwOaheHi722mrGI').subscribe((data: any) => {
      if (data.status == 'OK') {
        this.lat = data.results[0].geometry['location'].lat;
        this.lng = data.results[0].geometry['location'].lng;
        this.zoom = 8;
        this.representForm.controls['lat'].setValue(data.results[0].geometry['location'].lat);
        this.representForm.controls['lng'].setValue(data.results[0].geometry['location'].lng);
      }

    })
  }

  get addressrepresent() {

    return <FormArray>this.representForm.get('addressrepresent');
  }
  changecountry()
  {
    
  }
  toggleShowDiv(divName: string) {
    if (divName === 'descriptioncontent') {
      this.animationState = this.animationState === 'out' ? 'in' : 'out';
    }
  }
  filterreset(){
    this.searchValue = null;
    this.getrepresentativeoffice(0, this.perpage);
  }
  searchfilterlist() {
    var searchValues = (<HTMLInputElement>document.getElementById("search")).value;
    if (searchValues != '') {
      this.searchinput = searchValues.trim();
      
      var filterpagestring = '';
      filterpagestring = `page=${this.paginator.pageIndex + 1}&size=${this.perpage}&category=R`;

      this.profileservice.marketprsncefiltertwo(filterpagestring, this.searchinput).subscribe(data => {
      this.representativeofficearray = [];
      this.representativeofficearray = data['data'].items;
      this.searchresalt = data['data'].total_count;
      this.resultsLength = 1;
      })
    }
    else {
      this.getrepresentativeoffice(0, this.perpage);
    }
  }
  getSelectedAddress(data:MapLocation){
    
    this.getcountrypk(data.countryName,null);
    this.statename=data.stateName;
    this.representForm.patchValue({ 
      brand:data.name,
      website:data.website,
      state:data.stateName,
      cite:data.cityName,
    });
  } 
  getcountrypk(value,value2) {
    this.profileservice.getpk(value,value2).subscribe(data => {    
      this.representForm.controls['country'].setValue(Number(data.data));
      this.getcountrycode(data.data);
      this.getcountry(data.data);
    })
  }
  getcountrycode(value) {
    this.profileservice.getcountrycode(value).subscribe(data => {
      this.countryCode = data['data'].dialcode;      
      this.representForm.controls['code'].setValue(data['data'].dialcode);
    })
  } 
   /**
 * Add new unit row into form
 */
private addaddress(index) {
  const control = <FormArray>this.representForm.controls['addressrepresent'];
  var contactarray = this.representForm.get('addressrepresent') as FormArray;
    control.push(this.getaddress());

}
private getaddress() {
  return this.fb.group({
    address: [null, ''],
  });
}
}
interface marker {
  lat: string;
  lng: string;
  label?: string;
  draggable: boolean;
}


