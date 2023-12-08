export interface ISupplierlistbizsearch {
    pk : string,
    supplier_code: string;
    company_name : string;
    country : string;
    searchresultcompany: string;
    city: string;
    favourites: string;
    recommended:string;
    sezdstatus:number;
    countrypk:number
    origin:string;
    classification:string;
    incorporationStyle:string;
    company_pk:number;
    sector:string;
    sectorpk:string; // multiple values separated by comma
    product:string;
    productpk:string; // multiple values separated by comma
    service:string;
    servicepk:string; // multiple values separated by comma
    nationalproduct:string;
  }