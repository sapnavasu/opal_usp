export interface ViewModelData{
    companyInfo:{
        name: string;
        logo: string;
        country: string;
        countryFlag: string;
        supplierId?: string;
        sector: string;
        CR_No: string;
        incop_style: string;
        business_source: string;
        website: string;
    },certificationFeeInfo:{
        headCount: string;
        annualSale: string;
        enterpriseClass: string;
        product_servicePack: string;
        years_of_sub: string;
        total_sub_fee: string;
    },contactInfo:{
        primaryContact:{
            firstName: string;
            lastName: string;
            emailId: string;
            mobile:string;
            landline:string;
            department: string;
            designation:string;
        },paymentContact:{
            firstName: string;
            lastName: string;
            emailId: string;
            mobile:string;
            landline:string;
            department: string;
            designation:string;
        }
    },paymentDetails:{
        paymentMode: string;
        transactionId: string;
        bankName: string;
        date: string;
        paymentProof: string;
    },downloadData:{
        invoice: string;
        receipt: string;
    }
}