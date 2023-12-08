import { Component, Input, OnInit } from '@angular/core';
import { SlideInOutAnimation } from '@app/common/drive/animation';

@Component({
  selector: 'app-opaluserallocation',
  templateUrl: './opaluserallocation.component.html',
  styleUrls: ['./opaluserallocation.component.scss'],
  animations: [SlideInOutAnimation]
})
export class OpaluserallocationComponent implements OnInit {
  public moduleIdsArr:any = [];
  public modulepersArr:any = [];
  constructor() { }

  ngOnInit(): void {
  }
  toggleRowall(){ 
    //alert("toggle");
    console.info("toggleRowall");
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function(key){
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function(key){
      return [key];
    });
    convertArr.forEach((subModArr,mainIndex) => {
      subModArr[0].forEach((item,subIndex) => {
        for(let i=1;i<=6;i++){            
        }
      });
    });
       if((<HTMLInputElement>document.getElementById("allexcl")).getAttribute('data-label') == 'fa-plus'){
          (<HTMLInputElement>document.getElementById("allexcl")).setAttribute('data-label','fa-minus');
          (<HTMLInputElement>document.getElementById("allexcl")).classList.remove("fa-plus");
          (<HTMLInputElement>document.getElementById("allexcl")).classList.add("fa-minus");
          convertModArr.forEach((index) =>{
            (<HTMLInputElement>document.getElementById("_sh_"+ index)).parentElement.parentElement.classList.add("activeParent"); 
            (<HTMLInputElement>document.getElementById("_sh_" + index)).setAttribute('data-label','fa-minus');
            (<HTMLInputElement>document.getElementById("_sh_" + index)).classList.remove("fa-plus");
            (<HTMLInputElement>document.getElementById("_sh_" + index)).classList.add("fa-minus");
          });
          convertArr.forEach((subModArr,mainIndex) => {
            subModArr[0].forEach((item,subIndex) => {
              (<HTMLInputElement>document.getElementById(item +"_0")).parentElement.parentElement.classList.remove("rowCollapse"); 
              (<HTMLInputElement>document.getElementById(item +"_0")).parentElement.parentElement.classList.add("rowExpand"); 
            });
          });
    }else{
        (<HTMLInputElement>document.getElementById("allexcl")).setAttribute('data-label','fa-plus');
        (<HTMLInputElement>document.getElementById("allexcl")).classList.remove("fa-minus");
        (<HTMLInputElement>document.getElementById("allexcl")).classList.add("fa-plus");
        convertModArr.forEach((index) =>{   
            (<HTMLInputElement>document.getElementById("_sh_" +index)).parentElement.parentElement.classList.remove("activeParent"); 
            (<HTMLInputElement>document.getElementById("_sh_" + index)).setAttribute('data-label','fa-plus');
            (<HTMLInputElement>document.getElementById("_sh_" + index)).classList.remove("fa-minus");
            (<HTMLInputElement>document.getElementById("_sh_" + index)).classList.add("fa-plus");
        }); 
        convertArr.forEach((subModArr,mainIndex) => {
          subModArr[0].forEach((item,subIndex) => {
            (<HTMLInputElement>document.getElementById("_sh_" + item +"_0")).parentElement.parentElement.classList.add("rowCollapse"); 
            (<HTMLInputElement>document.getElementById("_sh_" + item +"_0")).parentElement.parentElement.classList.remove("rowExpand"); 
          });
        });
    }    
  }
  toggleRow(event, module_id){ 
    if((<HTMLInputElement>document.getElementById(module_id)).getAttribute('data-label') == 'fa-plus'){
      //alert("togglerow if condition" +  this.onlyview+"_sh_" + module_id);
      (<HTMLInputElement>document.getElementById(module_id)).setAttribute('data-label','fa-minus');
      (<HTMLInputElement>document.getElementById(module_id)).classList.remove("fa-plus");
      (<HTMLInputElement>document.getElementById(module_id)).classList.add("fa-minus");
      (<HTMLInputElement>document.getElementById(module_id)).parentElement.parentElement.classList.add("activeParent"); 
      //alert(JSON.stringify(this.moduleIdsArr[module_id]));
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if((<HTMLInputElement>document.getElementById(item +"_0"))){
          (<HTMLInputElement>document.getElementById(item +"_0")).parentElement.parentElement.classList.remove("rowCollapse"); 
          (<HTMLInputElement>document.getElementById(item +"_0")).parentElement.parentElement.classList.add("rowExpand"); 
        }
      });
     }else{
      //alert("togglerow else condition");
      (<HTMLInputElement>document.getElementById(module_id)).setAttribute('data-label','fa-plus');
      (<HTMLInputElement>document.getElementById( module_id)).classList.remove("fa-minus");
      (<HTMLInputElement>document.getElementById( module_id)).classList.add("fa-plus");
      (<HTMLInputElement>document.getElementById( module_id)).parentElement.parentElement.classList.remove("activeParent"); 
      this.moduleIdsArr[module_id].forEach((item, index) => {
          if((<HTMLInputElement>document.getElementById( item +"_0"))){
            (<HTMLInputElement>document.getElementById( item +"_0")).parentElement.parentElement.classList.add("rowCollapse"); 
            (<HTMLInputElement>document.getElementById( item +"_0")).parentElement.parentElement.classList.remove("rowExpand"); 
          }          
        });
      } 
  }
  toggleRow1(moduleId){
    this.moduleIdsArr[moduleId].forEach((item, index) => {
      for(let i=1; i<=6;i++){
      
        if((<HTMLInputElement>document.getElementById("mm-"+moduleId+"-"+i))){
          (<HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i)).checked = true;
        } 
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = true;
        }
        if((<HTMLInputElement>document.getElementById("module_"+moduleId))){
          (<HTMLInputElement>document.getElementById("module_"+moduleId)).checked = true;
        } 
      }
    });
  }
  moduleToggle(event, module_id, accessType){
    if(event.target.checked == true){
      let activeReadCnt = 0;
      let totalCnt = 0;
      this.moduleIdsArr[module_id].forEach((item, index) => {
        totalCnt = totalCnt + 1;
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked = true;
        }

        if((<HTMLInputElement>document.getElementById("module_" + item + "_2"))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked = true;
          activeReadCnt = activeReadCnt + 1;
        }
      });

      if(activeReadCnt == totalCnt){
        if(<HTMLInputElement>document.getElementById('mm-'+module_id+'-2')){
          //var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-2');
          //tgleReadChked.classList.add("mat-checked");
          (<HTMLInputElement>document.getElementById('mm-'+module_id+'-2')).checked = true;
        }        
      }
    }else{
      this.moduleIdsArr[module_id].forEach((item, index) => {
        if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          (<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked = false;
        }
        if(accessType == 2){
          for(let i=1; i<=6;i++){
            if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
            }
            if(<HTMLInputElement>document.getElementById('mm-'+module_id+'-'+i)){
              //var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+module_id+'-'+i);
              //tgleReadChked.classList.remove("mat-checked");
              (<HTMLInputElement>document.getElementById('mm-'+module_id+'-'+i)).checked = false;
            }            
          }
        }
      });
    }
    var inputElements = [].slice.call(document.querySelectorAll('.selval_'+ module_id));
    var checkedValue = inputElements.filter(chk => chk.checked).length;
    var count = inputElements.filter(chk => chk).length;
    if(checkedValue == count){
      (<HTMLInputElement>document.getElementById("module_" + module_id)).checked = true;
    }else{
      (<HTMLInputElement>document.getElementById("module_" + module_id)).checked = false;
    }
  }

  checkBoxCheck(event, module_id, accessType){
    let splitModule = module_id.split('_');
    let activeCnt = 0;
    let activeReadCnt = 0;
    let totalCnt = 0;
    if(event.target.checked == true){
      if((<HTMLInputElement>document.getElementById("module_" + module_id + "_2"))){
        (<HTMLInputElement>document.getElementById("module_" + module_id + "_2")).checked = true;
      }
      
      this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
       if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType))){
          totalCnt = totalCnt + 1;
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+accessType)).checked == true){
            activeCnt = activeCnt + 1;
          }
        }
        if((<HTMLInputElement>document.getElementById("module_" + item + "_2"))){
          if((<HTMLInputElement>document.getElementById("module_" + item + "_2")).checked == true){
            activeReadCnt = activeReadCnt + 1;
          }
        }
      });
      if(activeCnt == totalCnt){
        //var tgle = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType);
        //var tgleReadChecked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
        //tgleReadChecked.classList.add("mat-checked");
        //(<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2')).checked = true;
        (<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType)).checked = true;
      }else{
        //(<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2')).checked = false;
        (<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType)).checked = false;
      }
     /*  if(activeReadCnt == totalCnt){
        var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-2');
        tgleReadChked.classList.add("mat-checked");
      } */
    }else{
      //const enToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+accessType));
      //enToggle.classList.remove("mat-checked");
      if((<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType))){
        (<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+accessType)).checked = false;
      }     
      if(accessType == 2){
        this.moduleIdsArr[splitModule[0]].forEach((item, index) => {
          if(module_id == item){
            for(let i=1; i<=6;i++){
              if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
                (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
                (<HTMLInputElement>document.getElementById('mm-'+splitModule[0]+'-'+i)).checked = false;
              }
              //const allToggle = (<HTMLInputElement>document.getElementById("mm-"+splitModule[0]+"-"+i));
              //allToggle.classList.remove("mat-checked");
            }
          }
        });
      }
    }
    var inputElements = [].slice.call(document.querySelectorAll('.selval_'+ splitModule[0]));
    var checkedValue = inputElements.filter(chk => chk.checked).length;
    var count = inputElements.filter(chk => chk).length;
    if(checkedValue == count){
      (<HTMLInputElement>document.getElementById("module_" + splitModule[0])).checked = true;
    }else{
      (<HTMLInputElement>document.getElementById("module_" + splitModule[0])).checked = false;
    }
  }

  fullMOduleCheck(){
    let modArr = this.moduleIdsArr;
    let convertArr = Object.keys(modArr).map(function(key){
      return [modArr[key]];
    });

    let convertModArr = Object.keys(modArr).map(function(key){
      return [key];
    });
    /* if(event.target.checked== true){ */
      convertArr.forEach((subModArr,mainIndex) => {
        subModArr[0].forEach((item,subIndex) => {
          for(let i=1;i<=6;i++){            
            if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
              (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;            }
          }
        });
      });

      convertModArr.forEach((index) =>{        
        for(let i=1;i<=6;i++){
          if((<HTMLInputElement>document.getElementById("mm-"+ index+"-"+i))){
            var tgleReadChked = (<HTMLInputElement>document.getElementById('mm-'+index+'-'+i)).checked = false;
          }
        }
        if((<HTMLInputElement>document.getElementById("module_" + index))){
          (<HTMLInputElement>document.getElementById("module_" + index)).checked = false;
        }
      }); 
  
  }

  checkAllModule(event,moduleId){
    if(event.target.checked == true) {
      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
          if((<HTMLInputElement>document.getElementById("mm-"+moduleId+"-"+i))){
            (<HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i)).checked = true;
          }
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = true;
          }
        }
      });
    }else{
    

      this.moduleIdsArr[moduleId].forEach((item, index) => {
        for(let i=1; i<=6;i++){
         /*  var tgleReadChked = <HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i);
            tgleReadChked.classList.remove("mat-checked"); */
            if((<HTMLInputElement>document.getElementById("mm-"+moduleId+"-"+i))){
              (<HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+i)).checked = false;
            }
          if((<HTMLInputElement>document.getElementById("module_" + item + "_"+i))){
            (<HTMLInputElement>document.getElementById("module_" + item + "_"+i)).checked = false;
          }
        }
      });
    }
    let countChecked =false;
    this.moduleIdsArr[moduleId].forEach((item, index) => {
      countChecked= false;
        for(let ic=1; ic<=6;ic++){
        if((<HTMLInputElement>document.getElementById("mm-"+moduleId+"-"+ic))){
          if((<HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+ic)).checked) {
            countChecked=true
          }
        }
      }
    });

    let checkupdatecount = 0;
      for(let ic=1;ic<=6;ic++){
        if((<HTMLInputElement>document.getElementById("mm-"+moduleId+"-"+ic))){
          if((<HTMLInputElement>document.getElementById('mm-'+moduleId+'-'+ic)).checked) {
            checkupdatecount++;
          }
        }
      }
  }
}
