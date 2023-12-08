import { interval, Subscription } from 'rxjs';
import { FormGroup } from '@angular/forms';
import { debounceTime, distinctUntilChanged } from 'rxjs/operators';
import { RegistrationService } from './registration.service';
import { Encrypt } from '@app/common/class/encrypt';

export class OfflineProcess {
    oldFormValue: any;
    newFormValue: any;
    backendJsonFormValue: any;
    intervalSubscription: Subscription;
    constructor(protected security: Encrypt, 
        protected regService: RegistrationService){}

    runAtRegularIntervals() {
        this.isDifferentFormValue(this.newFormValue);
    }
    
    writeIntoLocalStorage(oldval,newval,formData: any) {
        this.oldFormValue = oldval;
        this.newFormValue = newval;
        let key;
        if (("inv_identity" in formData) && formData['inv_identity'] == 2) {
            key = this.security.encrypt(formData.firstname);
        } else if(formData.company_name){
            key = this.security.encrypt(formData.company_name);
        }
        let localData = this.security.encrypt(JSON.stringify(formData));
        localStorage.setItem(key,localData);
    }
        
    isDifferentFormValue(newFormValue: any): void {
        if (((this.backendJsonFormValue && JSON.stringify(this.backendJsonFormValue) !== JSON.stringify(newFormValue))
            || !this.backendJsonFormValue) && newFormValue && 
            (newFormValue['company_name'] || ("inv_identity" in newFormValue) && newFormValue['inv_identity'] == 2 && newFormValue['firstname'])) {
            this.writeToBackendJsonFile(newFormValue);
        }
    }

    writeToBackendJsonFile(formValue: any): void {
        this.regService.storeOfflineFormData(this.security.encrypt(JSON.stringify(formValue))).subscribe(data => {
            if(data['data'].status === 1){
                this.backendJsonFormValue = formValue;
            }
        });
    }

    clearLocallyStoredData() {
        let key = this.security.encrypt(this.newFormValue.company_name);
        if(localStorage.getItem(key) !== null){
            localStorage.removeItem(key);
            this.regService.removeOfflineData(this.security.encrypt(JSON.stringify(this.newFormValue))).subscribe(d =>  console.log('Local data removed'));
            this.intervalSubscription.unsubscribe();
        }
    }

    unsubscribeInterval() {
        this.intervalSubscription.unsubscribe();
    }
    writeregFormDatajson(form1:any,ip:any)
    {
       
        let body = JSON.stringify({ supplierdtls: form1 ,ip:ip});
        this.regService.writeregFormDatajson(body).subscribe(data => {return data});

    }
}
