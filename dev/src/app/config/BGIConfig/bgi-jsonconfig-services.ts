import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BgiConfig } from './bgi-config';

@Injectable()

export class BgiJsonconfigServices {
static bgiConfigData: BgiConfig;

constructor(private http: HttpClient) {}

load() {
    const jsonFile = `assets/config/BGIConfig.json`;
    return new Promise<void>((resolve, reject) => {
        this.http.get(jsonFile).toPromise().then((response: BgiConfig) => {
            BgiJsonconfigServices.bgiConfigData = (response as BgiConfig);
            resolve();
        }).catch((response: any) => {
        reject(`Could not load file '${jsonFile}': ${JSON.stringify(response)}`);
        });
    });
}
}
 