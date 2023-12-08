<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffacademics_tbl".
 *
 * @property int $staffacademics_pk
 * @property int $sacd_staffinforepo_fk Reference to staffinforepo_pk
 * @property string $sacd_startdate
 * @property string $sacd_enddate
 * @property string $sacd_institutename
 * @property int $sacd_opalcountrymst_fk Reference to opalcountrymst_pk
 * @property int $sacd_opalstatemst_fk Reference to opalstatemst_pk
 * @property int $sacd_opalcitymst_fk Reference to opalcitymst_pk
 * @property int $sacd_edulevel Reference to referencemst_pk where rm_mastertype = 12
 * @property string $sacd_degorcert Degree or certificate
 * @property string $sacd_grade
 * @property string $sacd_createdon
 * @property int $sacd_createdby
 * @property string $sacd_updatedon
 * @property int $sacd_updatedby
 *
 * @property OpalcitymstTbl $sacdOpalcitymstFk
 * @property OpalcountrymstTbl $sacdOpalcountrymstFk
 * @property OpalstatemstTbl $sacdOpalstatemstFk
 * @property StaffinforepoTbl $sacdStaffinforepoFk
 */
class StaffacademicsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffacademics_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sacd_staffinforepo_fk', 'sacd_institutename', 'sacd_edulevel', 'sacd_degorcert', 'sacd_grade', 'sacd_createdon', 'sacd_createdby'], 'required'],
            [['sacd_staffinforepo_fk', 'sacd_opalcountrymst_fk', 'sacd_opalstatemst_fk', 'sacd_opalcitymst_fk', 'sacd_edulevel', 'sacd_createdby', 'sacd_updatedby'], 'integer'],
            [['sacd_startdate', 'sacd_enddate', 'sacd_createdon', 'sacd_updatedon'], 'safe'],
            [['sacd_institutename', 'sacd_degorcert'], 'string'],
            [['sacd_grade'], 'string'],
            [['sacd_opalcitymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['sacd_opalcitymst_fk' => 'opalcitymst_pk']],
            [['sacd_opalcountrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcountrymstTbl::className(), 'targetAttribute' => ['sacd_opalcountrymst_fk' => 'opalcountrymst_pk']],
            [['sacd_opalstatemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['sacd_opalstatemst_fk' => 'opalstatemst_pk']],
            [['sacd_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['sacd_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffacademics_pk' => 'Staffacademics Pk',
            'sacd_staffinforepo_fk' => 'Sacd Staffinforepo Fk',
            'sacd_startdate' => 'Sacd Startdate',
            'sacd_enddate' => 'Sacd Enddate',
            'sacd_institutename' => 'Sacd Institutename',
            'sacd_opalcountrymst_fk' => 'Sacd Opalcountrymst Fk',
            'sacd_opalstatemst_fk' => 'Sacd Opalstatemst Fk',
            'sacd_opalcitymst_fk' => 'Sacd Opalcitymst Fk',
            'sacd_edulevel' => 'Sacd Edulevel',
            'sacd_degorcert' => 'Sacd Degorcert',
            'sacd_grade' => 'Sacd Grade',
            'sacd_createdon' => 'Sacd Createdon',
            'sacd_createdby' => 'Sacd Createdby',
            'sacd_updatedon' => 'Sacd Updatedon',
            'sacd_updatedby' => 'Sacd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSacdOpalcitymstFk()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'sacd_opalcitymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSacdOpalcountrymstFk()
    {
        return $this->hasOne(OpalcountrymstTbl::className(), ['opalcountrymst_pk' => 'sacd_opalcountrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSacdOpalstatemstFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'sacd_opalstatemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSacdStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'sacd_staffinforepo_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffacademicsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffacademicsTblQuery(get_called_class());
    }

    public static function fetchFavResult($staffid, $pageSize , $page){
  
        $favQuery = self::find();
        $favQuery->select([
                        '*','TIMESTAMPDIFF(YEAR, sir_dob, CURDATE())  AS age','DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appsit_appdecon','DATE_FORMAT(sir_dob,"%d-%m-%Y") AS sir_dob',
                        'DATE_FORMAT(sacd_startdate,"%d-%m-%Y") AS sacd_startdate','DATE_FORMAT(sacd_enddate,"%d-%m-%Y") AS sacd_enddate'
                    ])
                    ->leftJoin('appstaffinfotmp_tbl  temp','temp.appsit_staffinforepo_fk = sacd_staffinforepo_fk')
                    ->leftJoin('staffinforepo_tbl repo','repo.staffinforepo_pk = sacd_staffinforepo_fk')
                    ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = temp.appsit_applicationdtlstmp_fk')
                    ->leftJoin('opalcountrymst_tbl country','country.opalcountrymst_pk = sacd_opalcountrymst_fk')
                    ->leftJoin('opalstatemst_tbl state','state.opalstatemst_pk = sacd_opalstatemst_fk')
                    ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = sacd_opalcitymst_fk')
                    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = sir_moheridoc');
                   
        $favQuery->where([
                        'appostaffinfotmp_pk'=> $staffid,
                    ]);
        $favQry = $favQuery->orderBy(['appostaffinfotmp_pk'=>SORT_DESC])
                    ->asArray();
        $favProvider = new \yii\data\ActiveDataProvider([
            'query' => $favQry,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $Roledata  =  \app\models\RolemstTbl::find()->where("rm_projectmst_fk =:pk", [':pk' => 1])->asArray()->All();
        foreach($Roledata as  $Data){

            $rolearr[$Data['rolemst_pk']] = $Data['rm_rolename_en'];
        }
        foreach ($favProvider->getModels() as $key => $favResData) {
            $driveImg  =   \api\components\Drive::generateUrl($favResData['sacd_certupload'],$companypk,$userpk);
            $favData[$key] = $favResData;
            $countrymodel     =   \app\models\OpalcountrymstTbl::find()->where("opalcountrymst_pk =:pk", [':pk' => $favResData['sir_nationality']])->one();
            $statemodel     =   \app\models\OpalstatemstTbl::find()->where("opalstatemst_pk =:pk", [':pk' => $favResData['sir_opalstatemst_fk']])->one();
            $citymodel     =   \app\models\OpalcitymstTbl::find()->where("opalcitymst_pk =:pk", [':pk' => $favResData['sir_opalcitymst_fk']])->one();
            $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appsit_appdecby']])->one();
            $equlevelmodel     =   \app\models\ReferencemstTbl::find()->where("referencemst_pk =:pk", [':pk' => $favResData['sacd_edulevel']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['sir_nationality'] = $countrymodel['ocym_countryname_en'];
            $favData[$key]['sir_opalstatemst_fk'] = $statemodel['osm_statename_en'];
            $favData[$key]['sir_opalcitymst_fk'] = $citymodel['ocim_cityname_en'];
            $favData[$key]['coverImg'] = $driveImg; 
            $favData[$key]['sacd_edulevel'] = $equlevelmodel['rm_name_en'];

            $mainrole_arr = explode("," ,$favResData['appsit_mainrole']);
            $rolestr = [];
            foreach($mainrole_arr as $pk){
                 $rolestr[] =    $rolearr[$pk];
            }
            $mainrole_str = implode("," ,$rolestr);
            $favData[$key]['appsit_mainrole'] = $mainrole_str;
           }
        $favouriteRes['data'] = $favData;
        $favouriteRes['totalcount'] = $favProvider->getTotalCount();
        $favouriteRes['size'] = $pageSize;
        $favouriteRes['page'] = $page;
    
        return $favouriteRes;
    }

    public function saveAcademics($requestdata)
    {
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        if($requestdata->staffacademics_pk)
        {
            $modelAcc = StaffacademicsTbl::find()->where(["staffacademics_pk"=>$requestdata->staffacademics_pk])->one();
        }
        else
        {
            $modelAcc = new StaffacademicsTbl();
        }

        
        $modelAcc->sacd_staffinforepo_fk = $requestdata->sacd_staffinforepo_fk;
        $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata->year_join));
        $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata->year_pass));
        $modelAcc->sacd_institutename = $requestdata->institute_name;
        $modelAcc->sacd_opalcountrymst_fk = $requestdata->institue_country;
        $modelAcc->sacd_opalstatemst_fk = $requestdata->inst_state;
        $modelAcc->sacd_opalcitymst_fk = $requestdata->inst_city;
        $modelAcc->sacd_edulevel = $requestdata->edut_level;
        $modelAcc->sacd_degorcert = $requestdata->degree_cert;
        $modelAcc->sacd_grade = $requestdata->gpa_grade;
        $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
        $modelAcc->sacd_createdby = $userPk;

        if($modelAcc->save()){
            return $modelAcc;
        }else{
            echo "<pre>";var_dump($modelAcc->getErrors());exit;
        }
    }
}
