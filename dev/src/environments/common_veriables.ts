export const common_var = {
  //opal Start
    maincentre:{
        maintab: {
          'trainingEvaluationCentre': true,
          'technicalEvaluationCentre': true,
        },
        trainingEvaluationCentre: {
          'invoiceManagement': true
        },
        TechnicalEvaluationCentre: {
          'subsidary': true
        },
    },
  //opal END
  activitySelectionLimit: 10,
  hsemax: 5,
  qcmax: 5,
  rdmax: 5,
  infmax: 5,
  locationLimit: 4,
  // pack deploycountry
  deployCountry: 31,
  deployCountryname: "Oman",
  downloadFileURL: location.protocol + '//192.168.1.27:82/opal_usp/storage/',
  // Libya Country Related Data
  omanPk: 31,
  omanDialCode: '+968',
  omanCurrencyName: 'OMR',
  omanRecordFromDB: { CountryMst_Pk: 31, CyM_CountryName_en: 'Oman', CyM_CountryCode_en: 'OM', CyM_CountryDialCode: '00968', dialcode: '+968' },
  currencyArray:[{clabel: "OMR", cname: "Omani Rial",cvalue: "3"},{clabel: "USD", cname: "US Dollar",cvalue: "21"}],
  libyaPk: 245,
  libyaDialCode: '+218',
  libyaCurrencyName: 'LYD',
  libyaRecordFromDB: { CountryMst_Pk: 245, CyM_CountryName_en: 'Libya', CyM_CountryCode_en: 'LY', CyM_CountryDialCode: '00218', dialcode: '+218' },
  productPriceMandatory: true,
  servicePriceMandatory: false,
  SectorManufacturerPk: 5,
  busSrcManufacturerPk: 1,
  faqCountRestructionforProduct: 5,
  faqCountRestructionforService: 5,
  addProductMinstryOfGasEnable: false,
  addServiceMinstryOfGasEnable: false,
  contactCountRestructionforBussrc: 1,
  contactCountRestructionforProudct: 5,
  contactCountRestructionforService: 5,
  addProdctMinimumSpecification: 1,
  addServiceMinimumSpecification: 1,
  defaultCurrency: 21,
  rfiadditonalinfomaxcount: 5,
  showscfmarquee: false,
  
  
  extprofCondtion: {
    'isextprof': true,
    'insights': false,
    'filter': true,
    'readyness': false,
    'viewcount': true,
    'addSection': false,
    'operation': false,
    'action': false,
    'operationtype': 'S',
    'bsource': true,
    'status': false,
    'insightsAll': false,
  },
  scfCondition: {
    'insights': false,
    'readyness': false,
    'viewcount': false,
    'filter': true,
    'addSection': true,
    'operation': true,
    'action': false,
    'operationtype': 'M',
    'bsource': true,
    'status': false,
    'insightsAll': true,
  },
  cmsCondition: {
    'insights': false,
    'filter': true,
    'addSection': false,
    'readyness': false,
    'viewcount': false,
    'operation': true,
    'action': false,
    'operationtype': 'S',
    'bsource': true,
    'status': false,
    'insightsAll': false,
  },
  cmsServCondition: {
    'insights': false,
    'filter': true,
    'readyness': false,
    'viewcount': false,
    'addSection': false,
    'operation': true,
    'action': false,
    'operationtype': 'S',
    'bsource': true,
    'insightsAll': false,
  },
  cmsreqCondition: {
    'insights': false,
    'filter': true,
    'addSection': false,
    'readyness': false,
    'viewcount': false,
    'operation': false,
    'action': false,
    'operationtype': 'S',
    'bsource': true,
    'status': true,
    'insightsAll': false,
    'selectType': 'radio'
  },
  cmsreqServCondition: {
    'insights': false,
    'filter': true,
    'readyness': false,
    'viewcount': false,
    'addSection': false,
    'operation': false,
    'action': false,
    'operationtype': 'S',
    'bsource': true,
    'status': true,
    'insightsAll': false,
    'selectType': 'radio'
  },
  ServCondition: {
    'isextprof': false,
    'insights': true,
    'filter': true,
    'viewcount': true,
    'readyness': false,
    'addSection': true,
    'operation': false,
    'action': true,
    'operationtype': 'M',
    'bsource': true,
    'status': true,
    'insightsAll': false,
    'typeofview': true
  },
  extprofServCondition: {
    'isextprof': true,
    'insights': false,
    'filter': true,
    'viewcount': true,
    'readyness': false,
    'addSection': false,
    'operation': false,
    'action': false,
    'operationtype': '',
    'bsource': true,
    'status': false,
    'insightsAll': false,
  },
  CKEditortemplate: {
    'addproduct_productdesc': true,
    'addproduct_productsummry': true,
    'addproduct_package': true,
    'addproduct_technicalinfo': true,
    'addservice_servicedesc': true,
    'addservice_servicesummry': true,
    'addservice_servicetechnical': true,
    'addfactory_factorysummry': true,
    'addfactory_factoryscope': true,
  },
  PMS: {
    requistions: {
      supportingDocumentLimit: 3,
    }
  },
  busSrcPk: {
    bussource: [
      {
        'bcrcname': 'Manufacturer',
        'bsrcvalue': 1
      },
      {
        'bcrcname': 'Trading',
        'bsrcvalue': 2
      },
      {
        'bcrcname': 'Agent',
        'bsrcvalue': 5
      }
    ]
  }, 
  enquriy_type : {
    1:'RFI', 
    2:'EOI', 
    3:'PQ', 
    4:'RFP', 
    5:'RFQ', 
    6:'RFT', 
    7:'eTender', 
    8:'eAuction'
  }
};

export const scfCategoryControl = {
  isenabledrive:false,
  corporatesummary: {
    'industrialpaper': false,
    'corporatedocumentation': false,
    'officephoto': false
  },
  subsidary: {
    'subsidary': true
  },
  humanresources: {
    'hr': true
  },
  shareholderinformation: {
    'uploadpartnershipandauthorized': false
  }
};

export const Lccdivison = {
  city_north: [
    {
      'citypk': '1',
      'cityname': 'Adam',
      'lowercity': 'adam'
    },
    {
      'citypk': '2',
      'cityname': 'Bahla',
      'lowercity': 'bahla'
    },
    {
      'citypk': '3',
      'cityname': 'Ibri',
      'lowercity': 'ibri'
    },
    {
      'citypk': '9',
      'cityname': 'Others',
      'lowercity': ''
    }
  ],
  city_south: [
    {
      'citypk': '4',
      'cityname': 'Al Jazir',
      'lowercity': 'al jazir'
    },
    {
      'citypk': '5',
      'cityname': 'Hima',
      'lowercity': 'hima'
    },
    {
      'citypk': '6',
      'cityname': 'Maqsan',
      'lowercity': 'maqsan'
    },
    {
      'citypk': '7',
      'cityname': 'Shaleem',
      'lowercity': 'shaleem'
    },
    {
      'citypk': '8',
      'cityname': 'Thumrait',
      'lowercity': 'thumrait'
    },
    {
      'citypk': '9',
      'cityname': 'Others',
      'lowercity': ''
    }
  ],
  switchoption: [
    {
      'value': 'Yes',
      'id': '1'
    },
    {
      'value': 'No',
      'id': '0'
    }
  ],switchoptionRiyada: [
    {
      'value': 'Yes',
      'id': '1'
    },
    {
      'value': 'No',
      'id': '0'
    }
  ]
  
};

export const scfmandatorypks = {
  'oissrcatid': [1,2,3,4,5,7,8,9,10],   
  'SCNatcatid': [1,2,3,4,5,6,8,9,10],   
  'SCIntcatid': [1,2,6],   
  'mandatory': ['1', '2', '7'],   
  'mandatorynational': ['1', '2', '3', '4', '5','6','7','8','9','10']
};
export const scfstatuslist = {
  'showprimaryvali':false,
  'categorylevel': [
    {'id': 2, 'label': 'Approve'},
    {'id': 3, 'label': 'Decline'}
  ],
  'subcategorylevel': [
    {'id': 2, 'label': 'Approve'},
    {'id': 3, 'label': 'Decline'}
  ],
  'parameterlevel': [
    {'id': 3, 'label': 'Approve'},
    {'id': 4, 'label': 'Decline'}
  ],
  'formlevel': [
    {'id': 1, 'label': 'Approve'},
    {'id': 2, 'label': 'Decline'},
  ],
  'Primaryformlevel' :[
    {'id': 'A', 'label': 'Approve'},
    {'id': 'D', 'label': 'Decline'}
  ],
  'businesssrcparameterlevel': [
    {'id': 1, 'label': 'Approve'},
    {'id': 2, 'label': 'Decline'}
  ],
};
