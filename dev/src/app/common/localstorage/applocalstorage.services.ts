import { Injectable } from '@angular/core';
import * as jwtDecode from 'jwt-decode';
import { Encrypt } from '../class/encrypt';
@Injectable()
export class AppLocalStorageServices {
	public data: any;
	public myArray =
		{
		    registerPk: 'oum_opalmemberregmst_fk',
			companyname: 'omrm_companyname_en', username: 'oum_firstname', username_mail: 'oum_emailid',
			regtype:'omrm_intendforregistration',
			userPk: 'opalusermst_pk', 
			role: 'oum_rolemst_fk', 
			reg_pk: 'oum_opalmemberregmst_fk', 
			opalusermst_pk: 'opalusermst_pk',
			user_name: 'oum_firstname', 
			stktype: 'omrm_stkholdertypmst_fk',
			omrm_stkholdertypmst_fk: 'omrm_stkholdertypmst_fk',
			apptemppk: 'apptemppk',
			projectpk: 'projectpk',
			apptype: 'apptype',
			appstatus: 'appstatus',
			isfocalpoint:'oum_isfocalpoint',
			designation:'designation',
			isadmin:'oum_isfocalpoint',
			companylogo:'companylogo',
			oum_projectmst_fk:'oum_projectmst_fk'
		};
	constructor(private secuirty: Encrypt) { }
	// SET DATA INTO LOCAL STORAGE
	setInLocal(key: string, user: any) {
		return localStorage.setItem(key, user);
	}
	// GET DATA INTO LOCAL STORAGE
	getInLocal(key?: string) {
		if(key == 'uerpermission'){
			if(localStorage.getItem('uerpermission') != undefined){
				
				let perdata = this.secuirty.decrypt(localStorage.getItem('uerpermission'));
				let permissiondata = JSON.parse(perdata);
				this.data = permissiondata;
			}
		}else{
			let v3logindata:any =jwtDecode(localStorage.getItem('v3logindata'));
			
			if (key !== '' && key) {
				const mykey = this.myArray[key];
				this.data  = v3logindata.uid[mykey];
			} else {
				const localdataobj = {
					companyname: v3logindata.uid.omrm_companyname_en,
					opalusermst_pk: v3logindata.uid.opalusermst_pk,
					registerPk: v3logindata.uid.oum_opalmemberregmst_fk,
					username: v3logindata.uid.oum_firstname,
					username_mail: v3logindata.uid.oum_emailid,
					omrm_stkholdertypmst_fk: v3logindata.uid.omrm_stkholdertypmst_fk,
					omrm_intendforregistration:v3logindata.uid.omrm_intendforregistration,
					apptemppk: v3logindata.uid.apptemppk,
					projectpk: v3logindata.uid.projectpk,
					apptype: v3logindata.uid.apptype,
					appstatus: v3logindata.uid.appstatus,
					isfocalpoint:v3logindata.uid.oum_isfocalpoint,
					designation:v3logindata.uid.designation,
					isadmin: v3logindata.uid.oum_isfocalpoint,
					companylogo:v3logindata.uid.companylogo,
					oum_projectmst_fk:v3logindata.uid.oum_projectmst_fk,
				};
				this.data = localdataobj;
			}	
		}	
		return this.data;
	}
	// DELETE DATA INTO LOCAL STORAGE
	removeInLocal(key: string) {
		let v3logindata:any =jwtDecode(localStorage.getItem('v3logindata'));
		if (key == 'lastvisit') {
			const mykey = this.myArray[key];
			const lastvisitdata = v3logindata;
			this.data = v3logindata;
		}
		// localStorage.removeItem();
		return true;
	}
	getaccessmoduleid(stktype,module)
	{ 	//stktype  1-Potal Admin (Super Admin), 2-Centre, 3-Operator, 4-Individual Candidate
		let moduleid = 0;
		if(stktype == 1)
		{
			if(module == 'Account Settings')
			moduleid = 1;
			else if(module == 'Manage Roles')
			moduleid = 2;
			else if(module == 'Manage Users')
			moduleid = 3;
			else if(module == 'Batch Management')
			moduleid = 4;
			else if(module == 'Learner Feedback')
			moduleid = 5;
			else if(module == 'Approval Management')
			moduleid = 6;
			else if(module == 'Invoice Management')
			moduleid = 7;
			else if(module == 'Learner Card Log')
			moduleid = 8;
			else if(module == 'RAS Vehicle Management')
			moduleid = 15;
			else if(module == 'Manage IVMS Device Installed Vehicles')
			moduleid = 16;
			else if(module == 'Staff Management')
			moduleid = 17;
		}else if(stktype == 2){
			if(module == 'Account Settings')
			moduleid = 9;
			else if(module == 'Manage Users')
			moduleid = 10;
			else if(module == 'Batch Management')
			moduleid = 11;
			else if(module == 'Learner Feedback')
			moduleid = 12;
			else if(module == 'Vehicle Inspection and Approval')
			moduleid = 13;
			else if(module == 'Contact us')
			moduleid = 14;
			else if(module == 'IVMS Device Installation and Approval')
			moduleid = 19;
			else if(module == 'Staff Management')
			moduleid = 20;
		}
		return moduleid;
	}

	getAccessToken() {
		const token = localStorage.getItem('v3logindata');
		return token ? token : '';
	}
}
