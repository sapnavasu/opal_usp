export class Contact {
  primarykey:number;
  name: string;
  department: string;
  designation: string;
  email1: string;
  email2: string;
  mobile1cc: string;
  mobile1: string;
  mobile2cc: string;
  mobile2: string;
  phone1cc: string;
  phone1ext: string;
  phone1: string;
  phone2cc: string;
  phone2: string;
  phone2ext: string;
  faxcc: string;
  fax: string;
  shortdesc: string;
  avatarurl: string;
  profile_bgi: string;
  profile_skype: string;
  profile_facebook: string;
  profile_twitter: string;
  profile_linkedin: string;

  fullname(){
    return this.name+' - '+ this.designation;
  }
}