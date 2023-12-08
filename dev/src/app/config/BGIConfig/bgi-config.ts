export interface BgiConfig {
    configuration: {
        projectName: string;
        fgtMailAttemptLimit: number;
        fgtMailResendDurationSeconds: number;
        fgtLoginDurationSeconds: number;
        afterLoginStkholderTypePks: number[];
        enterpriseAdminPaginatonSet: number[];
        enterpriseAdminPerpage: number;
        otherPaginationSet: number[];
        otherPerpage: number;
        extPaginationSet: number[];
        extPerpage: number;
        accordionPaginationSet: number[];
        accordionPerpage: number;
        offlineRegDataTrackDuration: number;
        ccmailcount: number;
    };
    investment: {
        from: string;
        externallink: string;
    };
    procurement: {
        from: string;
    };
    tenderdetails: {
        demoonly: boolean;
    }
}
