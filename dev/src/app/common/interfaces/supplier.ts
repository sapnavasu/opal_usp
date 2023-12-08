export interface Supplier {
    Pk:number;
    name:string;
    code:string;
    jsrsNo:number;
    country:string;
    regDate:Date;
    expiryDate:Date;
    logoPath : string;
    QR_CodePath: string;
    externalProfileName:string;
    externalProfileLink: string;
}


export interface CountryList {
    CountryMst_Pk: number,
    CyM_CountryName_en: string,
    CyM_CountryCode_en: string,
    CyM_CountryDialCode: string,
    dialcode: string
  }