export interface City {
    CityMst_Pk: number;
    CM_StateMst_Fk: string;
    CM_CityName_en: string;
    color: string;
    CM_Status: number;
    CM_STDCode: string;
    data: Array<string>;
    CM_UpdatedOn: Date;
}
