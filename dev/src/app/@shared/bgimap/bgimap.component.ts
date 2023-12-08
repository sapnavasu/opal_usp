import { AgmMap, AgmMarker } from '@agm/core';
import { Appearance, Location, MatGoogleMapsAutocompleteComponent } from '@angular-material-extensions/google-maps-autocomplete';
import { HttpClient } from '@angular/common/http';
import { AfterViewInit, ChangeDetectorRef, Component, ElementRef, EventEmitter, Input, OnInit, Output, ViewChild, ViewEncapsulation } from '@angular/core';
import { ControlContainer, FormBuilder, FormControl } from '@angular/forms';
import { RemoteService } from '@app/remote.service';
import { TranslateService } from '@ngx-translate/core';
import { CookieService } from 'ngx-cookie-service';

import PlaceResult = google.maps.places.PlaceResult;
const place = null as google.maps.places.PlaceResult;
type Components = typeof place.address_components;

@Component({
  selector: 'app-bgimap',
  templateUrl: './bgimap.component.html',
  styleUrls: ['./bgimap.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class BgimapComponent implements  OnInit, AfterViewInit  {
  @Input() latitude: number;
  @Input() longitude: number;
  @Input() draggable: boolean;
  @Input() lat_field: boolean;
  @Input() long_field: boolean;
  @Input() address_field: boolean;
  @Input() city_auto_list_filed: boolean;
  @Input() zoom_level: number;
  @Input() country: any;
  @Input() street_view: boolean;
  @Input() placeholderText = 'Address';
  @Input() searchboxApperance = 'normal';
  @Output() locationObject: any = new EventEmitter<any>();
  @ViewChild('gsearch') gsearch: MatGoogleMapsAutocompleteComponent;
  @ViewChild('agmMap') agmMap: AgmMap;
  @ViewChild('mapMarker') mapMarker: AgmMarker;
  control: FormControl = new FormControl();


  public appearance = Appearance;
  public streetViewControl: boolean;
  public city: string;
  myForm;

  // mapForm: FormGroup;
  formData: any;

  @Output() selectedAddress: EventEmitter<any> = new EventEmitter<any>();
  @ViewChild('selected_address') selected_address: ElementRef;
  @ViewChild('selected_latitude') selected_latitude: ElementRef;
  @ViewChild('selected_longitude') selected_longitude: ElementRef;
  @Output() private lat_val = new EventEmitter < any > ();
  @Output() private long_val = new EventEmitter < any > ();

  constructor(private formBuilder: FormBuilder, public _http: HttpClient, private translate: TranslateService,
    private remoteService: RemoteService,
    private cookieService: CookieService,
              private cdr: ChangeDetectorRef, private parentFormControl: ControlContainer) { }
              languagelist = [{ "id": "1", "languageName": "English", "languagecode": "en", "CountryMst_Pk": "136", "dir": "ltr" },
              { "id": "2", "languageName": "Arabic", "languagecode": "ar", "CountryMst_Pk": "31", "dir": "rtl" }]
              dir = 'ltr';
  ngOnInit() {
    if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
      const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
      //this.patientCategory.get('patientCategory').setValue(toSelect);
     this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }else{      
      const toSelect = this.languagelist.find(c => c.id == '1');
      //this.patientCategory.get('patientCategory').setValue(toSelect);
      this.translate.setDefaultLang(toSelect.languagecode);
      this.dir = toSelect.dir;
    }
    this.remoteService.getLanguageCookie().subscribe(data => {
      this.translate.setDefaultLang(this.cookieService.get('languageCode'));
      if(this.cookieService.get('languageCookieId') && this.cookieService.get('languageCookieId') != undefined && this.cookieService.get('languageCookieId') != null){
        const toSelect = this.languagelist.find(c => c.id === this.cookieService.get('languageCookieId'));
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
        
      }else{      
        const toSelect = this.languagelist.find(c => c.id == '1');
        this.translate.setDefaultLang(toSelect.languagecode);
        this.dir = toSelect.dir;
      }
  });
    this.myForm = this.parentFormControl.control;

    this.city = ''; 
    // if(!this.latitude || !this.longitude){
    //   this._http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + this.country + '&key=AIzaSyBRrNFm0DvRXQf_E8_qy-Z8TfASFXEO8Qc').subscribe((data: any) => {
    //     if (data.status == 'OK') {
    //       this.latitude = data.results[0].geometry['location'].lat;
    //       this.longitude = data.results[0].geometry['location'].lng;
    //       this.lat_val.emit(data.results[0].geometry['location'].lat);
    //       this.long_val.emit(data.results[0].geometry['location'].lng);
    //       this.zoom_level = 7;

    //     }
    //   })
    //   this.setCurrentPosition();
    // }
  }

  ngAfterViewInit() {
    this.streetViewControl = this.street_view;
    this.cdr.detectChanges();

  }

 setCurrentPosition() {
    if ('geolocation' in navigator) {
      navigator.geolocation.getCurrentPosition((position) => {
        this.latitude = position.coords.latitude;
        this.longitude = position.coords.longitude;
        this.lat_val.emit(position.coords.latitude);
        this.long_val.emit(position.coords.longitude);
        this.zoom_level = 7;
        this.mapMarker.visible = true;
      });
    }
  }

  mapit(address: string, zoom) {
    this._http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&key=AIzaSyBRrNFm0DvRXQf_E8_qy-Z8TfASFXEO8Qc').subscribe((data: any) => {
        if (data.status == 'OK') {
          this.latitude = data.results[0].geometry.location.lat;
          this.longitude = data.results[0].geometry.location.lng;
          this.lat_val.emit(data.results[0].geometry.location.lat);
          this.long_val.emit(data.results[0].geometry.location.lng);
          this.zoom_level = zoom;
          this.mapMarker.visible = true;
          this.cdr.detectChanges();
        }
      });
  }

  mapinput() {
    if (this.searchboxApperance == 'standard') {
      this.control.reset();
    } else {
      this.gsearch.address = '';
    }
    this.cdr.detectChanges();
  }

  markerDragEnd(result) {
    this.myForm.controls.selected_latitude.setValue(result.coords.lat);
    this.myForm.controls.selected_longitude.setValue(result.coords.lng);
    this.lat_val.emit(result.coords.lat);
    this.long_val.emit(result.coords.lng);
    this.myForm.controls.selected_address.setValue('');
  }

  getLatLongValue(result) {
    this.latitude = this.selected_latitude.nativeElement.value;
    this.longitude = this.selected_longitude.nativeElement.value;
    this.lat_val.emit(this.selected_latitude.nativeElement.value);
    this.long_val.emit(this.selected_longitude.nativeElement.value);
    this.zoom_level = 3;
    this.setCurrentPosition();
    this.getCity(this.latitude, this.longitude);
  }

  getCity(sel_lat, sel_lng) {
    const geocoder = new google.maps.Geocoder;
    const latlng = { lat: Number(sel_lat), lng: Number(sel_lng) };
    geocoder.geocode({ 'location': latlng }, (results, status) => {
      if (results[0]) {
        this.myForm.controls.selected_address.setValue(results[0].formatted_address);
        this.selected_address.nativeElement.focus();
        this.selected_address.nativeElement.blur();
      } else {
        console.log('No results found');
      }
    });
  }


  getCurrentLocation(result) {
    const geocoder = new google.maps.Geocoder;
    const latlng = { lat: result.coords.lat, lng: result.coords.lng };
    this.zoom_level = 3;
    this.myForm.controls.selected_latitude.setValue(result.coords.lat);
    this.myForm.controls.selected_address.setValue('');
    this.myForm.controls.selected_longitude.setValue(result.coords.lng);
    this.lat_val.emit(result.coords.lat);
    this.long_val.emit(result.coords.lng);
    geocoder.geocode({ 'location': latlng }, (results, status) => {
      if (results[0]) {
        this.myForm.controls.selected_address.setValue(results[0].formatted_address);
        // this.selected_address.nativeElement.focus();
        // this.selected_address.nativeElement.blur();
      } else {
        console.log('No results found');
      }
    });
  }

  onAddressSelected(result: PlaceResult) {
    // console.log(this.locationFromPlace(result));
  }
  onAutocompleteSelected(result: any) {
    this.myForm.controls.selected_address.setValue(result.formatted_address);
    console.log('onAutocompleteSelected: ', result);
    this.locationFromPlace(result);
    if (result.address_components.length >= 1 && result.address_components.length <= 3) {
      this.zoom_level = 5;
    } else if (result.address_components.length >= 4 && result.address_components.length <= 6) {
      this.zoom_level = 12;
    } else if (result.address_components.length >= 7) {
      this.zoom_level = 17;
    }

  }

  onLocationSelected(location: Location) {
    // console.log('onLocationSelected: ', location);
    // this.zoom_level = 17;
    this.myForm.controls.selected_latitude.setValue(location.latitude);
    this.myForm.controls.selected_longitude.setValue(location.longitude);
    this.latitude = location.latitude;
    this.longitude = location.longitude;
    this.lat_val.emit(location.latitude);
    this.long_val.emit(location.longitude);
    this.agmMap.triggerResize();

    // console.log(this.agmMap);
    // this.agmMap.mapReady.subscribe(map => {
    //   const bounds: google.maps.LatLngBounds = new google.maps.LatLngBounds();
    //   // for (const mm of this.markers) {
    //     bounds.extend(new google.maps.LatLng(location.latitude, location.longitude));
    //   // }
    //   map.fitBounds(bounds);
    // });

  }

  public locationFromPlace(place: google.maps.places.PlaceResult) {
    const components = place.address_components;
    if (components === undefined) {
      return null;
    }

    const areaLevel3 = getShort(components, 'administrative_area_level_3');
    const locality = getLong(components, 'locality');

    const cityName = locality || areaLevel3;
    const countryName = getLong(components, 'country');
    const countryCode = getShort(components, 'country');
    const stateCode = getShort(components, 'administrative_area_level_1');
    const stateName = getLong(components, 'administrative_area_level_1');
    const name = place.name !== cityName ? place.name : null;
    const website = place.website ? place.website : null;
    const phonenumber = place.international_phone_number ? place.international_phone_number : null;
    const address = place.formatted_address ? place.formatted_address : null;
    const coordinates = {
      latitude: place.geometry.location.lat(),
      longitude: place.geometry.location.lng(),
    };

    const bounds = place.geometry.viewport.toJSON();
    // placeId is in place.place_id, if needed
    this.locationObject.emit({
      name, website, phonenumber,
      cityName, countryName, countryCode,
      stateCode, stateName, bounds,
      coordinates, address
    });
    // return { name,website, phonenumber, cityName, countryName, countryCode, stateCode,stateName, bounds, coordinates };
  }


}

function getComponent(components: Components, name: string) {
  return components.filter(component => component.types[0] === name)[0];
}

function getLong(components: Components, name: string) {
  const component = getComponent(components, name);
  return component && component.long_name;
}

function getShort(components: Components, name: string) {
  const component = getComponent(components, name);
  return component && component.short_name;
}