import { Component, OnInit, Output, EventEmitter, Input } from '@angular/core';
import { DndDropEvent, DropEffect} from 'ngx-drag-drop';
import { field, value } from '../global.model';
import { ActivatedRoute } from '@angular/router';
import swal from 'sweetalert';
import { SlideInOutAnimation } from '@app/common/drive/animation';
import { Ng5SliderModule } from 'ng5-slider';

@Component({
  selector: 'app-formbuilder',
  templateUrl: './formbuilder.component.html',
  styleUrls: ['./formbuilder.component.scss'],
  animations: [SlideInOutAnimation],
})
export class FormbuilderComponent implements OnInit {
  animationState6 = 'out';
  formdatalist:boolean = false;
  formdatalistdescrip:boolean = false;
  animationState7 = 'out';
  @Output() formdata:any=new EventEmitter<any>(); 

  submittjson = '';
  public formvalid:boolean=false;
  public formbuildervalid:boolean=false;
  
  value: value = {
    label: '',
    value: ''
  };
  success = false;
  fieldModels: Array<field> = [
    {
      'type': 'text',
      'icon': 'fa-font',
      'label': 'Text',
      'header':'h2',
      'description': 'Enter Text',
      'placeholder': 'Enter Text',
      'className': 'form-control',
      'subtype': 'text',
      'regex' : '',
      'handle': true,
      'min': 12,
      'max': 90,
      'texttype':'text'
    },
    {
      'type': 'email',
      'icon': 'fa-envelope',
      'label': 'Email',
      'description': 'Enter email ID',
      'placeholder': 'Enter email ID',
      'className': 'form-control',
      'subtype': 'text',
      'regex' : '^([a-zA-Z0-9_.-]+)@([a-zA-Z0-9_.-]+)\.([a-zA-Z]{2,5})$',
      'errorText': 'Please enter a valid email',
      'handle': true
    },
    
    {
      'type': 'number',
      'label': 'Number',
      'icon': 'fa-html5',
      'description': '',
      'placeholder': 'Enter number',
      'className': 'form-control',
      'value': '20',
      'min': 12,
      'max': 90,
      'numbertype':1
    },
    {
      'type': 'date',
      'icon': 'fa-calendar',
      'label': 'Date',
      'placeholder': 'Date',
      'className': 'form-control',
      'datetype':'date'
    },
    
    {
      'type': 'textarea',
      'icon': 'fa-text-width',
      'label': 'Textarea',
      'predefvalue': ''
    },
    {
      'type': 'paragraph',
      'icon': 'fa-paragraph',
      'label': 'Paragraph',
      'placeholder': 'Enter paragraph'
    },
    {
      'type': 'checkbox',
      'label': 'Checkbox',
      'icon': 'fa-list',
      'description': 'Checkbox',
      'inline': true,
      'values': [
        {
          'label': 'Option 1',
          'value': 'option-1'
        },
        {
          'label': 'Option 2',
          'value': 'option-2'
        }
      ]
    },
    {
      'type': 'radio',
      'icon': 'fa-list-ul',
      'label': 'Radio',
      'description': 'Radio boxes',
      'values': [
        {
          'label': 'Option 1',
          'value': 'option-1'
        },
        {
          'label': 'Option 2',
          'value': 'option-2'
        }
      ]
    },
    {
      'type': 'autocomplete',
      'icon': 'fa-bars',
      'label': 'Select',
      'description': 'Select',
      'placeholder': 'Select',
      'className': 'form-control',
      'values': [
        {
          'label': 'Option 1',
          'value': 'option-1'
        },
        {
          'label': 'Option 2',
          'value': 'option-2'
        },
        {
          'label': 'Option 3',
          'value': 'option-3'
        }
      ]
    },
    {
      'type': 'file',
      'icon': 'fa-upload',
      'label': 'File',
      'description': 'File Upload',
      'value':'',
      'fileaccept':['jpg'],
      'maxfilesize':5,
      'maxfilecount':1
    },
    {
      'type': 'header',
      'icon': 'fa-header',
      'label': 'Header',
      'description': 'Add Header',
      'value':'Sample Header',
      'size':'h1'
    },
    // {
    //   "type": "datetime-local",
    //   "icon": "fa-calendar",
    //   "label": "DateTime",
    //   "placeholder": "Date Time",
    //   "className": "form-control",
    // }
  ];

  rangevalue: number = 0;
  rangehighValue: number = 0;
  rangeoptions: Ng5SliderModule = {
    floor: 0,
    ceil: 100
  };

  modelFields: Array<field> = [];
  model: any = {
    name: '',
    nameheaderheight: 'h2',
    description: '',
    descriptionheaderheight: 'h3',
    theme: {
      bgColor: 'ffffff',
      textColor: '555555',
      bannerImage: ''
    },
    attributes: this.modelFields
  };


  report = false;
  reports: any = [];
  public qustionnarie_pk:any;

  constructor(private route: ActivatedRoute) { }
  public modelattributes_onload:any;
  public description_onload:any;
  public descriptionheaderheight_onload:any;
  public modelname_onload:any;
  public nameheaderheight_onload:any;
  
  ngOnInit() {
    this.updateForm();
    this.modelname_onload = this.model.name;
    this.nameheaderheight_onload = this.model.nameheaderheight;
    this.description_onload = this.model.description;
    this.descriptionheaderheight_onload = this.model.descriptionheaderheight_onload;
  }

  resetform() {
    this.model.attributes = [];
    this.model.name = '';
    this.model.nameheaderheight = 'h2';
    this.model.description =  '';
    this.descriptionheaderheight_onload = 'h3';
  }
  
  openforedit(qus_pk) {
    this.qustionnarie_pk = qus_pk;
   
  }

  checkValidation() { 
    if(this.model.name != '' && this.model.description != '' && this.formbuildervalid == true) {
      this.formvalid = true;
    } else {
      this.formvalid = false;
    }
  }

  onDragStart(event: DragEvent) {
  }

  onDragEnd(event: DragEvent) {
  }

  onDraggableCopied(event: DragEvent) {
  }

  onDraggableLinked(event: DragEvent) {
  }

   onDragged( item: any, list: any[], effect: DropEffect ) {
    if ( effect === 'move' ) {
      const index = list.indexOf( item );
      list.splice( index, 1 );
    }
  }

  onDragCanceled(event: DragEvent) {
  }

  onDragover(event: DragEvent) {
  }

  onDrop( event: DndDropEvent, list?: any[] ) {
    if ( list && (event.dropEffect === 'copy' || event.dropEffect === 'move') ) {

      if (event.dropEffect === 'copy') {
      event.data.name = event.data.type + '-' + new Date().getTime();
      }
      let index = event.index;
      if ( typeof index === 'undefined' ) {
        index = list.length;
      }
      list.splice( index, 0, event.data );
      
    }
    this.formbuildervalid=true;
    this.checkValidation();
  }

  addValue(values) {
    values.push(this.value);
    this.value = {label: '', value: ''};
  }

  removeField(i) {
   
   if(this.model.attributes.length==1)
   {
    swal("Cannot Delete this field!", 'It is mandatory to have at least one field in the diligence form.', 'warning');

   }else{
    swal({
      title: "Are you sure?",
      text: "Do you want to remove this field?",
      icon: "warning",
      buttons: ['Cancel', "Yes, Remove"],
      dangerMode: true,
    })
      .then((willDelete) => {
        if (willDelete) {
          this.model.attributes.splice(i, 1);
        }
      });
    }   

  }

  updateForm() {
    const input = new FormData;
    input.append('id', this.model._id);
    input.append('name', this.model.name);
    input.append('nameheaderheight', this.model.nameheaderheight);
    input.append('description', this.model.description);
    input.append('descriptionheaderheight', this.model.descriptionheaderheight);
    input.append('bannerImage', this.model.theme.bannerImage);
    input.append('bgColor', this.model.theme.bgColor);
    input.append('textColor', this.model.theme.textColor);
    input.append('attributes', JSON.stringify(this.model.attributes));
    this.formbuildervalid=true;
    setTimeout(() => {
      this.checkValidation();
    }, 1000);
  }

  initReport() {
    this.report = true;
    const input = {
      id: this.model
    };
   
  }

  toggleValue(item) {
    item.selected = !item.selected;
   
  }
  datacheck(data) {
  }
  submit() {
    let valid = true;
    const validationArray = JSON.parse(JSON.stringify(this.model.attributes));
    validationArray.reverse().forEach(field => { 
      if (field.required && !field.value && field.type != 'checkbox') {
        swal('Error', 'Please enter ' + field.label, 'error');
        valid = false;
        return false;
      }
      if (field.required && field.regex) {
        const regex = new RegExp(field.regex);
        if (regex.test(field.value) == false) {
          swal('Error', field.errorText, 'error');
          valid = false;
          return false;
        }
      }
      if (field.required && field.type === 'checkbox') {
        if (field.values.filter(r => r.selected).length === 0) {
          swal('Error', 'Please enter ' + field.label, 'error');
          valid = false;
          return false;
        }
      }
    });
    if (!valid) {
      return false;
    }
    const input = new FormData;
    input.append('formId', this.model._id);
    input.append('attributes', JSON.stringify(this.model.attributes));
   
  }
  public submit_buttton_disable:boolean = false;
  datatoserve(data) {
    let form_validation = true;
    if(this.model.name=='')
    {
      swal('', 'Enter form name' , '');
     
      return false;
    } 
    const validationArray = JSON.parse(JSON.stringify(this.model.attributes));
    validationArray.reverse().forEach(field => {
      if(field.min > field.max && field.type == 'text') {
        form_validation = false;
        swal('Error', 'Please enter ' + field.label + ' minmum value less than maximum value', 'error');
        return false;
      } 
      if(field.max < field.min && field.type == 'text') {
        form_validation = false;
        swal('Error', 'Please enter ' + field.label + ' maximum value greater than maximum value', 'error');
        return false;
      } 
    });
    if(form_validation == true) {
      this.submit_buttton_disable = true;
      this.submittjson = data;
      let model_difference = false; 
      if(JSON.stringify(this.modelattributes_onload) != JSON.stringify(this.submittjson) && this.qustionnarie_pk != undefined) {
        model_difference = true
      } 
      this.formdata.emit({'formdata':this.submittjson,'formtitle':this.model, 'questionnarie_pk':this.qustionnarie_pk, 'model_difference':model_difference});
      this.submit_buttton_disable = false;
    }
  }

  formbuilderpopupdata(){
    this.formdatalist=true;
    this.formdatalistdescrip=false;
  }

  formbuilderdescripdata(){
    this.formdatalistdescrip=true;
    this.formdatalist=false;
  }

  closeformdescrip(){
    this.formdatalistdescrip=false;
    this.model.descriptionheaderheight = 'h3';
  } 

  closeform(){
    this.formdatalist=false;
    this.model.nameheaderheight = 'h2';
  } 

  addformnameproperty() {
    this.formdatalistdescrip = false;
  }

  addformdescproperty() {
    this.formdatalistdescrip = false;
  }
}
