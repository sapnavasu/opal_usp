<?php

namespace app\models;

use app\models\OpalcitymstTbl;
use app\models\OpalstatemstTbl;
use Yii;
use yii\db\ActiveRecord;
use app\models\ApplicationdtlsmainTbl;
use api\models\MemcompfiledtlsTbl;
use api\components\Drive;
use api\components\Security;

/**
 * This is the model class for table "appstaffinfomain_tbl".
 *
 * @property int $AppStaffInfoMain_PK Primary Key
 * @property int $appsim_AppStaffInfotmp_FK Reference to appostaffinfotmp_pk
 * @property int $appsim_OpalMemberRegMst_FK Reference to opalmemberregmst_pk
 * @property int $appsim_ApplicationDtlsMain_FK Reference to applicationdtlsmain_pk
 * @property int $appsim_AppInstInfoMain_FK Reference to appinstinfomain_pk
 * @property string $appsim_AppOfferCourseMain_FK Reference to appoffercoursetmp_pk, NULL when staff map to standard course
 * @property int $appsim_StaffInfoRepo_FK Reference to staffinforepo_pk
 * @property string $appsim_appcoursetrnsmain_fk Reference to appcoursetrnsmain_tbl, if Staff is mapped for Standard and Customized Course
 * @property string $appsim_mainrole Reference to rolemst_pk
 * @property string $appsim_jobtitle
 * @property int $appsim_contracttype Reference to referencemst_pk where rm_mastertype=7
 * @property string $appsim_roleforcourse 1-Tutor, 2-Trainer
 * @property string $appsim_emailid
 * @property string $appsim_language Reference to referencemst_pk where rm_mastertype=10
 * @property string $appsim_UpdatedOn
 * @property int $appsim_UpdatedBy
 *
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 * @property AppinstinfomainTbl $appsimAppInstInfoMainFK
 * @property ApplicationdtlsmainTbl $appsimApplicationDtlsMainFK
 * @property AppstaffinfotmpTbl $appsimAppStaffInfotmpFK
 * @property ReferencemstTbl $appsimContracttype
 * @property OpalmemberregmstTbl $appsimOpalMemberRegMstFK
 * @property StaffinforepoTbl $appsimStaffInfoRepoFK
 * @property AppstafflocationmainTbl[] $appstafflocationmainTbls
 * @property StaffevaluationmainTbl[] $staffevaluationmainTbls
 */
class AppstaffinfomainTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appstaffinfomain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appsim_AppStaffInfotmp_FK', 'appsim_OpalMemberRegMst_FK', 'appsim_ApplicationDtlsMain_FK', 'appsim_StaffInfoRepo_FK', 'appsim_mainrole', 'appsim_jobtitle', 'appsim_contracttype', 'appsim_emailid'], 'required'],
            [['appsim_AppStaffInfotmp_FK', 'appsim_OpalMemberRegMst_FK', 'appsim_ApplicationDtlsMain_FK', 'appsim_AppInstInfoMain_FK', 'appsim_StaffInfoRepo_FK', 'appsim_contracttype', 'appsim_UpdatedBy'], 'integer'],
            [['appsim_AppOfferCourseMain_FK', 'appsim_appcoursetrnsmain_fk', 'appsim_mainrole', 'appsim_jobtitle', 'appsim_roleforcourse', 'appsim_language'], 'string'],
            [['appsim_UpdatedOn'], 'safe'],
            [['appsim_emailid'], 'string', 'max' => 100],
            [['appsim_AppStaffInfotmp_FK'], 'unique'],
            [['appsim_AppInstInfoMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['appsim_AppInstInfoMain_FK' => 'appinstinfomain_pk']],
            [['appsim_ApplicationDtlsMain_FK'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['appsim_ApplicationDtlsMain_FK' => 'applicationdtlsmain_pk']],
            [['appsim_AppStaffInfotmp_FK'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfotmpTbl::className(), 'targetAttribute' => ['appsim_AppStaffInfotmp_FK' => 'appostaffinfotmp_pk']],
            [['appsim_contracttype'], 'exist', 'skipOnError' => true, 'targetClass' => ReferencemstTbl::className(), 'targetAttribute' => ['appsim_contracttype' => 'referencemst_pk']],
            [['appsim_OpalMemberRegMst_FK'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appsim_OpalMemberRegMst_FK' => 'opalmemberregmst_pk']],
            [['appsim_StaffInfoRepo_FK'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['appsim_StaffInfoRepo_FK' => 'staffinforepo_pk']],
          ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AppStaffInfoMain_PK' => 'Primary Key',
            'appsim_AppStaffInfotmp_FK' => 'Reference to appostaffinfotmp_pk',
            'appsim_OpalMemberRegMst_FK' => 'Reference to opalmemberregmst_pk',
            'appsim_ApplicationDtlsMain_FK' => 'Reference to applicationdtlsmain_pk',
            'appsim_AppInstInfoMain_FK' => 'Reference to appinstinfomain_pk',
            'appsim_AppOfferCourseMain_FK' => 'Reference to appoffercoursetmp_pk, NULL when staff map to standard course',
            'appsim_StaffInfoRepo_FK' => 'Reference to staffinforepo_pk',
            'appsim_appcoursetrnsmain_fk' => 'Reference to appcoursetrnsmain_tbl, if Staff is mapped for Standard and Customized Course',
            'appsim_mainrole' => 'Reference to rolemst_pk',
            'appsim_jobtitle' => 'Appsim Jobtitle',
            'appsim_contracttype' => 'Reference to referencemst_pk where rm_mastertype=7',
            'appsim_roleforcourse' => '1-Tutor, 2-Trainer',
            'appsim_emailid' => 'Appsim Emailid',
            'appsim_language' => 'Reference to referencemst_pk where rm_mastertype=10',
            'appsim_UpdatedOn' => 'Appsim  Updated On',
            'appsim_UpdatedBy' => 'Appsim  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_AppStaffInfomain_FK' => 'AppStaffInfoMain_PK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimAppInstInfoMainFK()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appsim_AppInstInfoMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimApplicationDtlsMainFK()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'appsim_ApplicationDtlsMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimAppOfferCourseMainFK()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appsim_AppOfferCourseMain_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimAppStaffInfotmpFK()
    {
        return $this->hasOne(AppstaffinfotmpTbl::className(), ['appostaffinfotmp_pk' => 'appsim_AppStaffInfotmp_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimMainrole()
    {
        return $this->hasOne(RolemstTbl::className(), ['rolemst_pk' => 'appsim_mainrole']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimOpalMemberRegMstFK()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appsim_OpalMemberRegMst_FK']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsimStaffInfoRepoFK()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'appsim_StaffInfoRepo_FK']);
    }

    /**
     * {@inheritdoc}
     * @return AppstaffinfomainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppstaffinfomainTblQuery(get_called_class());
    }


    
     public static function getTutorsListByRegPk($regPk)
    {
        
        $model =  self::find()
                ->select(['opalusermst_pk as pk','sir_name_en as staffname_en','sir_name_ar as staffname_ar','omrm_tpname_en as companyname_en','omrm_tpname_ar as companyname_ar'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_staffinforepo_fk')
                ->leftJoin('opalusermst_tbl','staffinforepo_pk = oum_staffinforepo_fk')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['IN','sir_type',[1,3]])
                ->andWhere("((FIND_IN_SET('12', appsim_roleforcourse)) || (appsim_roleforcourse = 12 ))")
                ->andWhere(['=','appsim_OpalMemberRegMst_FK',$regPk])
                ->andWhere('opalusermst_pk is not null')
                ->andwhere(['=','oum_status','A'])
                ->asArray()->all();

        
        return $model;
    }
    
    public static function getTutorsListForBatch($data)
    {
       
      $finalarray = [];
       
        
        $batches =  self::find()
                ->select(['opalusermst_pk as pk','sir_name_en as staffname_en','sir_name_ar as staffname_ar','omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar','group_concat(appsim_language)','group_concat(appsim_roleforcourse)','staffinforepo_pk','appctm_coursecategorymst_fk','appcdm_StandardCoursemst_FK as standardpk','sccd_cardexpiry','IF(DATE_ADD(NOW(), INTERVAL + 1 MONTH) > sccd_cardexpiry AND NOW() <= sccd_cardexpiry, 1, 0) AS is_nearingexpiry',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) <= sccd_cardexpiry AND NOW() > sccd_cardexpiry, 1,  0) AS graceperiod',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired','staffcompetencycarddtls_pk AS competancy_pk','DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate','DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y") AS graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk','appdt_status as appstatus','appdt_apptype as apptype'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_staffinforepo_fk')
                ->leftJoin('opalusermst_tbl','staffinforepo_pk = oum_staffinforepo_fk')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->leftJoin('appcoursetrnsmain_tbl','FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
                ->leftJoin('appcoursedtlsmain_tbl','appctm_AppCourseDtlsMain_FK = AppCourseDtlsMain_PK')
                ->leftJoin('applicationdtlsmain_tbl','applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
                ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->leftJoin('standardcoursedtls_tbl','scd_subcoursecategorymst_fk = '.$data['subcategory'].' and scd_standardcoursemst_fk = appcdm_StandardCoursemst_FK')
        ->leftJoin('staffcompetencycardhdr_tbl','staffinforepo_pk = scch_staffinforepo_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk AND standardcoursedtls_pk = sccd_standardcoursedtls_fk')
                ->where(['IN','sir_type',[1,3]])
               ->andWhere("((FIND_IN_SET('12', appsim_roleforcourse)) || (appsim_roleforcourse = 12 ))")
                ->andWhere("(FIND_IN_SET('".$data['subcategory']."', appctm_coursecategorymst_fk)) || (appctm_coursecategorymst_fk = '".$data['subcategory']."' )")
        ->andWhere("(FIND_IN_SET('".$data['language']."', appsim_language)) || (appsim_language = '".$data['language']."' )")
                ->andWhere('opalusermst_pk is not null')
                ->andwhere(['=','oum_status','A']);
        
        
        $batches->andwhere(['=','opalmemberregmst_pk',$data['regpk']]);
         
        
        $model = $batches->groupBy('staffcompetencycarddtls_pk')
                ->asArray()->all();
        
        
        
        $arrayname = $data['type'] == 1 ? 'subarr' : 'subarrpract';
           
        $durationnew = self::preparedurationarray($data['duration'],$arrayname);
        
        $modelschedule = self::checkAppstaffschedule($model,$durationnew);
        
        $model = self::batchtables($modelschedule,$durationnew);
     
       
       foreach($model as $value)
       {
         $finalarray[$value['pk']] = $value ;
       }
       foreach($finalarray as $value)
       {
         $dataArray[] = $value ;
       }
        return $dataArray;
    }
    
    public static function batchtables($model,$durationnew)
    {
    
        $updatedstafflist =[];
        foreach($durationnew as $durationrecord ) {
       
            $date = $durationrecord['datestring'];
            $start = $durationrecord['start'];
            $end = $durationrecord['end'];
        
            foreach ($model as $staffrecord) {
            
                $theoryrecord = BatchmgmtthyhdrTbl::find()
                                ->select(['batchmgmtthyhdr_pk'])
                                ->where(['=', 'bmth_tutor', $staffrecord['pk']])
                                ->andWhere(['<>','bmth_status',3])
                                ->asArray()->all();

                if ($theoryrecord){
                    foreach ($theoryrecord as $theory) {
                        $durationtr = BatchmgmtdurationdtlsTbl::find()
                                        ->where(['=', 'bmdd_batchmgmtthyhdr_fk', $theory['batchmgmtthyhdr_pk']])
                                        ->andWhere(['=', 'bmdd_date', $date])
                                        ->andWhere("('".$start."'  BETWEEN bmdd_starttime AND bmdd_endtime)OR('".$end."'   BETWEEN bmdd_starttime AND bmdd_endtime)")
                                        ->asArray()->all();
                        
                      
                    }
                    if (!$durationtr) {
                            $stafflist[] = $staffrecord;
                        }
                        else
                        {
                            $list[] = $staffrecord['pk'];
                        }
                } else {
                    $stafflist[] = $staffrecord;
                }
            }
           
           
            foreach ($stafflist as $staffrecordpract) {
             
                $practrecord = BatchmgmtpracthdrTbl::find()
                                ->select(['batchmgmtpracthdr_pk'])
                                ->where(['=', 'bmph_tutor', $staffrecordpract['pk']])
                                ->andWhere(['<>','bmph_status',3])
                                ->asArray()->all();
               
                if ($practrecord){
                    foreach ($practrecord as $pract) {
                        
                        $durationpract = BatchmgmtdurationdtlsTbl::find()
                                        ->where(['=','bmdd_batchmgmtpracthdr_fk',$pract['batchmgmtpracthdr_pk']])
                                        ->andWhere(['=', 'bmdd_date', $date])
                                         ->andWhere("('".$start."'  BETWEEN bmdd_starttime AND bmdd_endtime)OR('".$end."'   BETWEEN bmdd_starttime AND bmdd_endtime)")
                                        ->asArray()->all();
                        
                    }
                    if (!$durationpract) {
                            $stafflistmain[] = $staffrecordpract;
                        }
                  
                } else {
                    $stafflistmain[] = $staffrecordpract;
                }
            }
            
            foreach ($stafflistmain as $staffassment) {
             
                $assmentrecord = BatchmgmtasmthdrTbl::find()
                                ->select(['batchmgmtasmthdr_pk'])
                                ->where(['=', 'bmah_assessor', $staffassment['pk']])
                                ->andWhere(['=', 'bmah_assessmentdate', $date])
                                ->andWhere("('".$start."'  BETWEEN bmah_assessstarttime AND bmah_assessendtime)OR('".$end."'   BETWEEN bmah_assessstarttime AND bmah_assessendtime)")
                                ->andWhere(['<>','bmah_status',3])
                                ->asArray()->all();
                
                if (!$assmentrecord) {
                           $updatedstafflist[] = $staffassment;
                        }
               
            }
           
        
            return $updatedstafflist;
        }
    }
    
    public static  function getStaffinfotmppksbyuserpk($userpk)
    {
         return  AppstaffinfomainTbl::find()
                ->select(['appsim_AppStaffInfotmp_FK'])
                ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
                ->where(['=','opalusermst_pk',$userpk])
                ->asArray()->all();
         
      
    }
    
    public static function checkAppstaffschedule($model, $durationnew) {
        $list = [];
        foreach ($durationnew as $durationrecord) {

            $date = $durationrecord['datestring'];
            $start = $durationrecord['start'];
            $end = $durationrecord['end'];

            foreach ($model as $record) {
                $staffinfotmppks = self::getStaffinfotmppksbyuserpk($record['pk']);
              
                foreach ($staffinfotmppks as $tmppk) {
                    $data = AppstaffscheddtlsTbl::find()
                            ->where(['=', 'assd_appstaffinfotmp_fk', $tmppk['appsim_AppStaffInfotmp_FK']])
                            ->andWhere(['=', 'assd_dayschedule', 64])
                            ->andWhere(['=', 'assd_date', $date]);
                 
                    if ($start && $end) {
                        $data->andWhere("('".$start."'  BETWEEN assd_starttime AND assd_endtime)OR('".$end."'   BETWEEN assd_starttime AND assd_endtime)");
                    }
                    $staffreords = $data->one();
                   
                    if ($staffreords && !in_array($record,$list)) {
                        $list[] = $record;
                      
                    }
                }
            } 
        }
       
        return $list;
    }

    public static function getAssessorsListByRegPk($regPk)
    {
        
        $model =  self::find()
                ->select(['opalusermst_pk as pk','sir_name_en as staffname_en','sir_name_ar as staffname_ar','omrm_tpname_en as companyname_en','omrm_tpname_ar as companyname_ar'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_staffinforepo_fk')
                ->leftJoin('opalusermst_tbl','staffinforepo_pk = oum_staffinforepo_fk')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['IN','sir_type',[1,3]])
               ->andWhere("((FIND_IN_SET('13', appsim_roleforcourse)) || (appsim_roleforcourse = 13 ))")
                ->andWhere(['=','appsim_OpalMemberRegMst_FK',$regPk])
                ->andWhere('opalusermst_pk is not null')
                ->andwhere(['=','oum_status','A'])
                ->asArray()->all();
        

        return $model;
    }
    
     public static function getIVQAStaffbyaccessorpk($pk,$coursepk,$subcate,$language,$wilayat)
    {
            $regpk = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
         
            $User = OpalusermstTbl::findOne($pk);
            
             $coursedtls = AppcoursedtlsmainTbl::find()
                ->select(['acdm_citymst_fk','appiim_citymst_fk','scm_assessmentin'])
                ->leftJoin('appinstinfomain_tbl','appcdm_appinstinfomain_fk = appinstinfomain_pk')
                ->leftJoin('applicationdtlsmain_tbl','appiim_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->leftJoin('appcompanydtlsmain_tbl','acdm_applicationdtlsmain_fk = appiim_applicationdtlsmain_fk')
                 ->leftJoin('standardcoursemst_tbl','appcdm_StandardCoursemst_FK = standardcoursemst_pk')
                    
                ->where(['=','appcoursedtlsmain_pk',$coursepk])
                ->asArray()->one();
           $citypk = $wilayat ;    
          $data =  self::find()
                ->select(['opalusermst_pk as pk','sir_name_en as staffname_en','sir_name_ar as staffname_ar','omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar','oum_opalmemberregmst_fk as comppk','sccd_cardexpiry','IF(DATE_ADD(NOW(), INTERVAL + 1 MONTH) > sccd_cardexpiry AND NOW() <= sccd_cardexpiry, 1, 0) AS is_nearingexpiry',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) <= sccd_cardexpiry AND NOW() > sccd_cardexpiry, 1,  0) AS graceperiod',' IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired','staffcompetencycarddtls_pk AS competancy_pk','DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate','DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y") AS graceperioddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk','appdt_status as appstatus','appdt_apptype as apptype'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_staffinforepo_fk')
                ->leftJoin('opalusermst_tbl','staffinforepo_pk = oum_staffinforepo_fk')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->leftJoin('appstaffLocationmain_tbl', 'aslm_appstaffinfomain_fk = AppStaffInfoMain_PK')
                ->leftJoin('appcoursetrnsmain_tbl','FIND_IN_SET(appcoursetrnsmain_pk, appsim_appcoursetrnsmain_fk)')
                ->leftJoin('appcoursedtlsmain_tbl','appcoursedtlsmain_pk = appctm_AppCourseDtlsMain_FK')
                
                ->leftJoin('applicationdtlsmain_tbl a','a.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
                  ->leftJoin('applicationdtlstmp_tbl', 'a.appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                ->leftJoin('standardcoursedtls_tbl','scd_subcoursecategorymst_fk = '.$subcate.' and scd_standardcoursemst_fk = appcdm_StandardCoursemst_FK')
        ->leftJoin('staffcompetencycardhdr_tbl','staffinforepo_pk = scch_staffinforepo_fk')
        ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk AND standardcoursedtls_pk = sccd_standardcoursedtls_fk')
                ->leftJoin('applicationdtlsmain_tbl b','a.appdm_opalmemberregmst_fk = b.appdm_opalmemberregmst_fk and b.appdm_projectmst_fk = 1')
                
                ->where(['IN','sir_type',[1,3]])
                ->andWhere("((FIND_IN_SET('14', appsim_roleforcourse)) || (appsim_roleforcourse = 14 ))")
                ->andWhere(['=','appsim_OpalMemberRegMst_FK',$User->oum_opalmemberregmst_fk]) 
                ->andWhere("(FIND_IN_SET('".$subcate."', appctm_coursecategorymst_fk)) || (appctm_coursecategorymst_fk = '".$subcate."' )")
                ->andWhere("(FIND_IN_SET('".$language."', appsim_language)) || (appsim_language = '".$language."' )")
                ->andwhere(['=','oum_status','A'])
                ->andwhere(['!=','opalusermst_pk',$pk]);
//                        if ($citypk && $coursedtls['scm_assessmentin'] == '17') {
//           $data->andWhere("(FIND_IN_SET('".$citypk."', aslm_opalcitymst_fk)) || (aslm_opalcitymst_fk = '".$citypk."' )");
//        } else if (!$citypk && $coursedtls['scm_assessmentin'] == '17') {
//            $data->andWhere('aslm_opalcitymst_fk is null');
//        }
        
       
      
        $model = $data->groupBy('staffcompetencycarddtls_pk')->asArray()->all();
       
        //                 ->andWhere('find_in_set("'.$language.'",appsim_language)');
         
       
        $key = array_rand($model,1);
        $resarray[] = $model[$key];
        

    if($model)
    {
    
        if($regpk == $User->oum_opalmemberregmst_fk)
         {
           return ['msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => $model];
         }
         else
         {
            return ['msg' => 'assigned', 'status' => 2, 'flag' => 'A', 'data' => $resarray[0]];
         }
    }
     return ['msg' => 'failure', 'status' => 3, 'flag' => 'F', 'data' => ''];

        
        
    }
    
    public static function getAssesorsList()
    {
        
        $model =  self::find()
                ->select(['opalusermst_pk as pk','sir_name_en as staffname_en','sir_name_ar as staffname_ar','omrm_tpname_en as companyname_en','omrm_tpname_ar as companyname_ar'])
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = appsim_staffinforepo_fk')
                ->leftJoin('opalusermst_tbl','staffinforepo_pk = oum_staffinforepo_fk')
                ->leftJoin('opalmemberregmst_tbl','oum_opalmemberregmst_fk = opalmemberregmst_pk')
                ->where(['IN','sir_type',[1,3]])
                ->andWhere('find_in_set("13",appsim_roleforcourse)')
                ->andWhere('opalusermst_pk is not null')
                ->andwhere(['=','oum_status','A'])
                ->asArray()->all();

        return $model;
    }
    
    public static function preparedurationarray($data,$arrayname)
    {
       $durationarray = [];
       
         $i = 0; 
         
       foreach($data as $daterecord)
       {
          
          foreach($daterecord[$arrayname] as $key => $subarray)
          {
           
                 $durationarray[$i] = $daterecord;
                 $durationarray[$i][$arrayname] = [];
                 $durationarray[$i]['start'] = $subarray['startTime'];
                 $durationarray[$i]['end'] = $subarray['endTime'];
                 $i++;
          }
       }
       
      return $durationarray;
           
           
    }


    // Technical staff management
    public static function technicalListingQuery($params)
    {
        $userPk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $loginuserdtls = OpalusermstTbl::findOne($userPk);
        $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);

        $isAdmmin = ActiveRecord::getTokenData('oum_isfocalpoint', true);
        $model = ApplicationdtlsmainTbl::find()->select([ 
            'staffinforepo_pk',
            'scch_verificationcode',
            'appsim_AppStaffInfotmp_FK as StaffInfotmp',  
            'pm_projectname_en as projectName_en','pm_projectname_ar as projectName_ar',
            'omrm_branch_en as trainigCentre_en','omrm_branch_ar as trainigCentre_ar',
            'appiim_branchname_en as branchName_en','appiim_branchname_ar as branchName_ar',
            "(CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
            'osm_statename_en as state_en','osm_statename_ar as state_ar',
            'ocim_cityname_en as city_en','ocim_cityname_ar as city_ar',
            'sir_idnumber as civilNumber',
            'sir_name_en as staffName_en','sir_name_ar as staffName_ar', 
            'group_concat(distinct rm_rolename_en order by rm_rolename_en SEPARATOR ", ") as role_en',
            'group_concat(distinct rm_rolename_ar order by rm_rolename_ar SEPARATOR ", ") as role_ar',
            'oum_status as accountstatus',
            'group_concat(distinct rcm_coursesubcatname_en order by rcm_coursesubcatname_en SEPARATOR ", ") as categories_en',
            'group_concat(distinct rcm_coursesubcatname_ar order by rcm_coursesubcatname_ar SEPARATOR ", ") as categories_ar',
            'appsim_emailid as email_id',
            'sccd_cardexpiry',
            'sccd_createdon',
            "DATE_FORMAT(sccd_cardexpiry,'%d-%m-%Y') as Dateofexp",
            "DATE_FORMAT(sccd_createdon,'%d-%m-%Y') as last_approved",
            "sccd_status as cpmstatus",
            'omrm_opalmembershipregnumber as opalmember',
            'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
            'omrm_branch_en as centreName_en','omrm_branch_ar as centreName_ar',
            "(CASE WHEN appsim_roleforcourse LIKE '%16%' THEN 'yes' ELSE 'no' END) as isInspector",
        ])
        
        ->innerJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdm_opalmemberregmst_fk')
        ->innerJoin('appinstinfomain_tbl appinfo','applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
        ->leftJoin('appstaffinfomain_tbl','appinstinfomain_pk = appsim_AppInstInfoMain_FK')
        ->leftJoin('opalusermst_tbl user','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
        ->leftJoin('apprasvehinspcatmain_tbl','FIND_IN_SET(apprasvehinspcatmain_pk,appsim_apprasvehinspcatmain_fk)')
        ->innerJoin('rascategorymst_tbl cat','cat.rascategorymst_pk = arvicm_rascategorymst_fk')
        ->innerJoin('rolemst_tbl role','FIND_IN_SET(role.rolemst_pk,appsim_roleforcourse)')
        ->innerJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('projectmst_tbl proj', 'proj.projectmst_pk = appdm_projectmst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('staffcompetencycardhdr_tbl comphdr','comphdr.scch_staffinforepo_fk=appsim_StaffInfoRepo_FK')
        ->leftJoin('staffcompetencycarddtls_tbl compdtl','compdtl.sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')

        ->where([
            "appdm_issuspended" => 2,
        ])
        ->andWhere([
            //  "scch_projectmst_fk" => 4,
             "appdm_projectmst_fk" => 4
        ])->andWhere([
            "pm_projtype" => 2

        ])->groupBy('AppStaffInfoMain_PK');

        if($stktype == 2){
            if ($loginuserdtls['oum_isfocalpoint'] == 1 && $loginuserdtls['oum_opalmemberregmst_fk'] == $regPk) {
                $model->andWhere([
                    "appdm_opalmemberregmst_fk" => $regPk,
                ]);
            }else if($loginuserdtls['oum_staffinforepo_fk']){
                $trainingCentre = ApplicationdtlsmainTbl::find()->select([
                    'appdm_opalmemberregmst_fk',
                ])->innerJoin('appinstinfomain_tbl appinfo','applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
                ->leftJoin('appstaffinfomain_tbl','appinstinfomain_pk = appsim_AppInstInfoMain_FK')
                ->where([
                    'appsim_StaffInfoRepo_FK' => $loginuserdtls['oum_staffinforepo_fk']
                ])->asArray()->one();

                if($trainingCentre){
                    $model->andWhere([
                        "appdm_opalmemberregmst_fk" => $trainingCentre['appdm_opalmemberregmst_fk'],
                    ]);
                }
            }else{
                $model->andWhere(0);
            }
            
        }

        // echo $model->createCommand()->getRawSql(); die;                


        if($params['searchkey'] != ''){
            $searchkey = $params['searchkey'];  
            $projectName = $searchkey['projectName'];
            $centreName = $searchkey['centreName'];
            $company_name = $searchkey['company_name'];
            $member_number = $searchkey['member_number'];
            $officetype = $searchkey['officetype'];
            $branchName = $searchkey['branchName'];
            $siteLocation = $searchkey['siteLocation'];
            $civilNumber = $searchkey['civilNumber'];
            $staffName = $searchkey['staffName'];
            $email_id = $searchkey['email_id'];
            $roLes = $searchkey['roLes'];
            $categories = $searchkey['subCategories'];
            $compCard = $searchkey['compCard'];
            $expiryDate = $searchkey['expiryDate'];
            $approvedOn = $searchkey['approvedOn'];
            $accountstatus = $searchkey['accountstatus'];

            if($projectName){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'pm_projectname_en', $projectName],
                    ['LIKE', 'pm_projectname_ar', $projectName]
                ]);
            }

            if($centreName){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'omrm_branch_en', $centreName],
                    ['LIKE', 'omrm_branch_en', $centreName]
                ]);
            }
            
            if($company_name){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'omrm_companyname_en', $company_name],
                    ['LIKE', 'omrm_companyname_ar', $company_name]
                ]);
            }

            if($member_number){
                $model->andFilterWhere(['LIKE', 'omrm_opalmembershipregnumber', $member_number]);
            }
            
            if($officetype){
                $model->andFilterWhere(['AND', ['IN', 'appiim_officetype', $officetype]]);
            }

            if($branchName){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'appiim_branchname_ar', $branchName],
                    ['LIKE', 'appiim_branchname_en', $branchName]
                ]);
            }
            if($siteLocation){
                if(strpos($siteLocation, ',') !== false){
                    $site = explode(',',$siteLocation);
                    $state =trim($site[0]);
                    $model->andFilterWhere(['OR',
                        ['LIKE', 'osm_statename_ar', $state],
                        ['LIKE', 'osm_statename_en', $state]
                    ]);
                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =trim($site[1]);
                        $model->andFilterWhere(['OR',
                            ['LIKE', 'ocim_cityname_ar', $city],
                            ['LIKE', 'ocim_cityname_en', $city]
                        ]);
                    }
                }else{
                    $model->andFilterWhere(['OR',
                        ['LIKE', 'osm_statename_ar', $siteLocation],
                        ['LIKE', 'osm_statename_en', $siteLocation],
                        ['LIKE', 'ocim_cityname_ar', $siteLocation],
                        ['LIKE', 'ocim_cityname_en', $siteLocation]
                    ]);
                }
            }
            if($civilNumber){
                $model->andFilterWhere(['LIKE', 'sir_idnumber', $civilNumber]);
            }
            if($staffName){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'sir_name_en', $staffName],
                    ['LIKE', 'sir_name_ar', $staffName]
                ]);
            }
            if($email_id){
                $model->andFilterWhere(['LIKE', 'appsim_emailid', $email_id]);
            }
            $roleFilter = '';
            foreach($roLes as $k=>$role){
                $roleFilter.=(($k!=0)?"OR ":"")."FIND_IN_SET($role,oum_rolemst_fk)";
            }

            if($roleFilter){
                $model->andFilterWhere(['OR',
                    $roleFilter
                ]);
            }

            $catFilter = '';
            foreach($categories as $kt=>$cat){
                $catFilter.=(($kt!=0)?"OR ":"")."FIND_IN_SET($cat,rascategorymst_pk)";
            }

            if($catFilter){
                $model->andFilterWhere(['OR',
                    $catFilter
                ]);
            }
            if($compCard){
                $model->andFilterWhere(['AND', ['IN', 'sccd_status', $compCard]]);
            }
           
            if($expiryDate){
                $startDate  = $expiryDate['start_date'];
                $endDate = $expiryDate['end_date'];
                $endDate = date('Y-m-d', strtotime($endDate. ' + 1 days'));

                $model->andFilterWhere(['between', 'sccd_cardexpiry', $startDate,$endDate]);

            }
            if($approvedOn){
                $startDate  = $approvedOn['start_date'];
                $endDate = $approvedOn['end_date'];
                $endDate = date('Y-m-d', strtotime($endDate. ' + 1 days'));

                $model->andFilterWhere(['between', 'sccd_createdon', $startDate,$endDate]);
            }
            if($accountstatus){
                if (($key = array_search('null', $accountstatus)) !== false) {
                    unset($accountstatus[$key]);
                    $q = "oum_status IS NULL";
                    if($accountstatus){
                        $accountstatus = implode(',',$accountstatus);
                        $q = "(oum_status IN ($accountstatus) OR oum_status IS NULL)";
                    }
                }else{
                    $accountstatus = implode(',',$accountstatus);
                    $q = "oum_status IN ($accountstatus)";
                }
                $model->andWhere($q);
            }
            
        }
        // echo $model->createCommand()->getRawSql(); die;                

        $fiterArray = [
            'project_name' => 'pm_projectname_en',
            'centre_name' => 'omrm_tpname_en',
            'office_type' => 'appiim_officetype',
            'branch_name' => 'appiim_branchname_en',
            'site_locaton' => 'city_en',
            'civil_number' => 'sir_idnumber',
            'staff_name' => 'sir_name_en',
            'email_id' => 'appsim_emailid',
            'roles' => 'role_en',
            'categories' => 'rcm_coursesubcatname_en',
            'competency_card' => 'sccd_status',
            'dateofexp' => 'sccd_cardexpiry',
            'last_approved' => 'sccd_createdon',
            'account_status' => 'oum_status',
            'member_number' => 'omrm_opalmembershipregnumber',
            'company_name' => 'omrm_companyname_en',
        ];
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        $sort = '';
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'asc': 'desc';
            $sort .= "$sort_column $order_by, ";
        }
        $sort .= 'staffcompetencycarddtls_pk desc';
        $model->orderBy($sort);

        if(isset($params['excel'])){
            $response['data'] = $model->asArray()->all();
            return $response;
        }   
        $model->asArray();

        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();
        // echo'<pre>';print($data);die('teststst');
        $response = array();
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $data;
        return $response;
    }

    public static function trainingListingQuery($params)
    {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $loginuserdtls = OpalusermstTbl::findOne($userpk);
        $stktype = $loginuserdtls->oumOpalmemberregmstFk->omrm_stkholdertypmst_fk;
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $model = self::find()->select([ 
            'staffinforepo_pk',
            'scch_verificationcode',
            'appsim_AppStaffInfotmp_FK as StaffInfotmp',  
            'omrm_tpname_en  as trainigCentre_en','omrm_tpname_ar as trainigCentre_ar',
            'appiim_branchname_en as branchName_en','appiim_branchname_ar as branchName_ar',
            "(CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
            "(CASE WHEN appiim_officetype = 1 THEN omgov.osm_statename_en WHEN appiim_officetype = 2 THEN gov.osm_statename_en END) as state_en",
            "(CASE WHEN appiim_officetype = 1 THEN omgov.osm_statename_ar WHEN appiim_officetype = 2 THEN gov.osm_statename_ar END) as state_ar",
            "(CASE WHEN appiim_officetype = 1 THEN omcity.ocim_cityname_en WHEN appiim_officetype = 2 THEN city.ocim_cityname_en END) as city_en",
            "(CASE WHEN appiim_officetype = 1 THEN omcity.ocim_cityname_ar WHEN appiim_officetype = 2 THEN city.ocim_cityname_ar END) as city_ar",
            'group_concat(distinct appwil.ocim_cityname_ar order by appwil.ocim_cityname_ar SEPARATOR ",") as approvewilayat_ar',
            'group_concat(distinct appwil.ocim_cityname_en order by appwil.ocim_cityname_en SEPARATOR ",") as approvewilayat_en',
            'sir_idnumber as civil_number',
            'standardcoursemst_pk',
            'scm_coursename_en as categories_en','scm_coursename_ar as categories_ar',
            'sir_name_en as staffName_en','sir_name_ar as staffName_ar',
            'group_concat(distinct rm_rolename_en order by rm_rolename_en SEPARATOR ", ") as role_en',
            'group_concat(distinct rm_rolename_ar order by rm_rolename_ar SEPARATOR ", ") as role_ar',
            "group_concat(distinct ccm_catname_en order by ccm_catname_en SEPARATOR ', ') as sub_categories_en",
            "group_concat(distinct ccm_catname_ar order by ccm_catname_ar SEPARATOR ', ') as sub_categories_ar",
            // "group_concat(distinct a.rm_name_en order by a.rm_name_en SEPARATOR ', ') as language_en",
            // "group_concat(distinct a.rm_name_ar order by a.rm_name_ar SEPARATOR ', ') as language_ar",
            "oum_status as account_status",
            'appsim_emailid as email_id',
            'sccd_cardexpiry',
            'sccd_createdon',
            "DATE_FORMAT(sccd_cardexpiry,'%d-%m-%Y') as dateofexp",
            "DATE_FORMAT(sccd_createdon,'%d-%m-%Y') as last_approved",
            "sccd_status as competency_card",
            'omrm_opalmembershipregnumber as opalmember',
            'omrm_companyname_en as companyname_en','omrm_companyname_ar as companyname_ar',
            'appsim_language',
            'appsim_roleforcourse',
            'appcdm_OpalMemberRegMst_FK',
            "(CASE WHEN appsim_roleforcourse LIKE '%12%' OR appsim_roleforcourse LIKE '%13%' THEN 'yes' ELSE 'no' END) as isAssessor",
            "appcdm_standardcoursemst_fk as coursePk"
        ])
        ->innerJoin('appcoursetrnsmain_tbl appcou','FIND_IN_SET(AppCourseTrnsMain_pk,appsim_appcoursetrnsmain_fk)')
        ->innerJoin('appcoursedtlsmain_tbl appcouMain','AppCourseDtlsMain_PK  = appctm_AppCourseDtlsMain_FK')
        ->innerJoin('applicationdtlsmain_tbl app','app.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
        ->innerJoin('coursecategorymst_tbl coucat','coursecategorymst_pk = appctm_coursecategorymst_fk')
        ->innerJoin('standardcoursemst_tbl stdcou','standardcoursemst_pk = appcdm_standardcoursemst_fk')
        ->innerJoin('appinstinfomain_tbl appinfo','appinfo.appinstinfomain_pk = appcdm_appinstinfomain_fk')
        ->innerJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appcdm_OpalMemberRegMst_FK')
        ->innerJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('appstafflocationmain_tbl apploc', 'apploc.aslm_appstaffinfomain_fk = AppStaffInfoMain_PK')
        ->leftJoin('opalcitymst_tbl appwil', 'appwil.opalcitymst_pk = apploc.aslm_opalcitymst_fk')
        ->innerJoin('projectmst_tbl proj', 'proj.projectmst_pk = app.appdm_projectmst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalstatemst_tbl omgov','omgov.opalstatemst_pk = omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl omcity','omcity.opalcitymst_pk = omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user','user.oum_staffinforepo_fk = staff.staffinforepo_pk')
        ->innerJoin('staffcompetencycardhdr_tbl comphdr','comphdr.scch_staffinforepo_fk=appsim_StaffInfoRepo_FK AND scch_standardcoursemst_fk = appcdm_standardcoursemst_fk')
        ->leftJoin('staffcompetencycarddtls_tbl compdtl','compdtl.sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
        ->leftJoin('applicationdtlsmain_tbl appct','appiim_applicationdtlsmain_fk=appct.applicationdtlsmain_pk')
        ->innerJoin('rolemst_tbl role','FIND_IN_SET(role.rolemst_pk,appsim_roleforcourse)');
        // ->innerJoin('referencemst_tbl a','find_in_set(a.referencemst_pk,appsim_language) AND rm_mastertype=10');
        
        if(!empty($params['searchkey']['available_Date'])){
            $model->innerJoin('appstaffscheddtls_tbl','assd_appstaffinfotmp_fk = appsim_AppStaffInfotmp_FK');
            $model->where([
                "assd_date" => $params['searchkey']['available_Date'],
                "assd_dayschedule" => 64,
            ]);
        }
        if($stktype == 2){
            if ($loginuserdtls['oum_isfocalpoint'] == 1 && $loginuserdtls['oum_opalmemberregmst_fk'] == $regPk) {
                $model->andWhere([
                    "appcdm_OpalMemberRegMst_FK" => $regPk,
                ]);
            }else if($loginuserdtls['oum_staffinforepo_fk']){
                $trainingCentre = self::find()->select([
                    'appcdm_OpalMemberRegMst_FK',
                ])->innerJoin('appcoursetrnsmain_tbl appcou','FIND_IN_SET(AppCourseTrnsMain_pk,appsim_appcoursetrnsmain_fk)')
                ->innerJoin('appcoursedtlsmain_tbl appcouMain','AppCourseDtlsMain_PK  = appctm_AppCourseDtlsMain_FK')->where([
                    'appsim_StaffInfoRepo_FK' => $loginuserdtls['oum_staffinforepo_fk']
                ])->asArray()->one();

                if($trainingCentre){
                    $model->andWhere([
                        "appcdm_OpalMemberRegMst_FK" => $trainingCentre['appcdm_OpalMemberRegMst_FK'],
                    ]);
                }
            }else{
                $model->andWhere(0);
            }
            
        }
        $model->andWhere([
            "app.appdm_issuspended" => 2,
            "appct.appdm_issuspended" => 2
        ])->groupBy('appcdm_OpalMemberRegMst_FK,appcdm_standardcoursemst_fk,staffinforepo_pk');
        // echo $model->createCommand()->getRawSql(); die('');

        if($params['searchkey'] != ''){
            $searchkey = $params['searchkey'];  
            $company_name = $searchkey['company_name'];
            $member_number = $searchkey['member_number'];
            $training_centre = $searchkey['training_centre'];
            $officetype = $searchkey['officetype'];
            $branch_name = $searchkey['branch_name'];
            $site_locaton = $searchkey['site_locaton'];
            $course = $searchkey['course'];
            $civil_number = $searchkey['civil_number'];
            $staff_name = $searchkey['staff_name'];
            $email_id = $searchkey['email_id'];
            $roles = $searchkey['roLes'];
            $language = $searchkey['language'];
            $approvewilayat = $searchkey['approvewilayat'];
            $course_sub = $searchkey['course_sub'];
            $competency_card = $searchkey['competency_card'];
            $dateofexp = $searchkey['dateofexp'];
            $last_approved = $searchkey['last_approved'];
            $account_status = $searchkey['account_status'];

            if($company_name){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'omrm_companyname_en', $company_name],
                    ['LIKE', 'omrm_companyname_ar', $company_name]
                ]);
            }

            if($member_number){
                $model->andFilterWhere(['LIKE', 'omrm_opalmembershipregnumber', $member_number]);
            }

            if($training_centre){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'omrm_tpname_en', $training_centre],
                    ['LIKE', 'omrm_tpname_ar', $training_centre]
                ]);
            }
            if($officetype){
                $model->andFilterWhere(['IN', 'appiim_officetype', $officetype]);
            }
            if($branch_name){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'appiim_branchname_ar', $branch_name],
                    ['LIKE', 'appiim_branchname_en', $branch_name]
                ]);
            }
            if($site_locaton){
                if(strpos($site_locaton, ',') !== false){
                    $site = explode(',',$site_locaton);
                    $state =$site[0];
                    
                    $model->andWhere("(CASE WHEN appiim_officetype = 1 THEN (omgov.osm_statename_en LIKE '%$state%' OR omgov.osm_statename_ar LIKE '%$state%') WHEN appiim_officetype = 2 THEN (gov.osm_statename_en LIKE '%$state%' OR gov.osm_statename_ar LIKE '%$state%') END)");
                    
                                    
                    if(isset($site[1]) && !empty($site[1])){
                        $city =ltrim($site[1]);
                        
                        $model->andWhere("(CASE WHEN appiim_officetype = 1 THEN (omcity.ocim_cityname_ar LIKE '%$city%' OR omcity.ocim_cityname_en LIKE '%$city%') WHEN appiim_officetype = 2 THEN (city.ocim_cityname_ar LIKE '%$city%' OR  city.ocim_cityname_ar LIKE '%$city%') END)");
                    }
                }else{
                    $model->andWhere("(CASE WHEN appiim_officetype = 1 THEN (omgov.osm_statename_en LIKE '%$site_locaton%' OR omgov.osm_statename_ar LIKE '%$site_locaton%' OR omcity.ocim_cityname_ar LIKE '%$site_locaton%' OR omcity.ocim_cityname_en LIKE '%$site_locaton%') WHEN appiim_officetype = 2 THEN (gov.osm_statename_en LIKE '%$site_locaton%' OR gov.osm_statename_ar LIKE '%$site_locaton%' OR  city.ocim_cityname_ar LIKE '%$site_locaton%' OR  city.ocim_cityname_ar LIKE '%$site_locaton%') END)");
                }
            }
            if($course){
                $model->andFilterWhere(['IN', 'standardcoursemst_pk', $course]);
            }
            if($civil_number){
                $model->andFilterWhere(['LIKE', 'sir_idnumber', $civil_number]);
            }
            if($staff_name){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'sir_name_en', $staff_name],
                    ['LIKE', 'sir_name_ar', $staff_name]
                ]);
            }
            if($email_id){
                $model->andFilterWhere(['LIKE', 'appsim_emailid', $email_id]);
            }
            if($roles){
                $roles = is_array($roles)?implode(',',$roles):$roles;
                $model->andFilterWhere(['LIKE','appsim_roleforcourse',$roles]);
            }
            
            if($language){
                $language = is_array($language)?implode(',',$language):$language;
                $model->andFilterWhere(['LIKE', 'appsim_language', $language]);
            }
            if($approvewilayat){
                $model->andFilterWhere(['OR',
                    ['LIKE', 'appwil.ocim_cityname_ar', $approvewilayat],
                    ['LIKE', 'appwil.ocim_cityname_en', $approvewilayat]
                ]);
                // $model->andWhere("(FIND_IN_SET('".$approvewilayat."','approvewilayat_en')) > 0 OR (FIND_IN_SET('".$approvewilayat."','approvewilayat_ar')) > 0");

            }
            if($course_sub){
                $model->andFilterWhere(['IN', 'coursecategorymst_pk', $course_sub]);
            }
            if($competency_card){
                $model->andFilterWhere(['IN', 'sccd_status', $competency_card]);
            }
           
            if($dateofexp){
                $startDate  = $dateofexp['start_date'];
                $endDate = $dateofexp['end_date'];
                $endDate = date('Y-m-d', strtotime($endDate. ' + 1 days'));

                $model->andFilterWhere(['between', 'sccd_cardexpiry', $startDate,$endDate]);

            }
            if($last_approved){
                $startDate  = $last_approved['start_date'];
                $endDate = $last_approved['end_date'];
                $endDate = date('Y-m-d', strtotime($endDate. ' + 1 days'));

                $model->andFilterWhere(['between', 'sccd_createdon', $startDate,$endDate]);
            }

            if($account_status){
                if (($key = array_search('null', $account_status)) !== false) {
                    unset($account_status[$key]);
                    $q = "oum_status IS NULL";
                    if($account_status){
                        $account_status = implode(',',$account_status);
                        $q = "(oum_status IN ($account_status) OR oum_status IS NULL)";
                    }
                }else{
                    $account_status = implode(',',$account_status);
                    $q = "oum_status IN ($account_status)";
                }
                $model->andWhere($q);
            }
            
        }

        $fiterArray = [
            'training_centre' => 'omrm_tpname_en',
            'branch_name' => 'appiim_branchname_en',
            'site_locaton' => 'city_en',
            'course' => 'scm_coursename_en',
            'civil_number' => 'sir_idnumber',
            'staff_name' => 'sir_name_en',
            'email_id' => 'appsim_emailid',
            'roles' => 'role_en',
            'language' => 'language',
            'approvewilayat' => 'approvewilayat_en',
            'course_sub' => 'ccm_catname_en', 
            'competency_card' => 'sccd_status',
            'dateofexp' => 'sccd_cardexpiry',
            'last_approved' => 'sccd_createdon',
            'account_status' => 'oum_status',
            'member_number' => 'omrm_opalmembershipregnumber',
            'company_name' => 'omrm_companyname_en', //copy
        ];
        $sort_column = isset($fiterArray[$params['order']])?$fiterArray[$params['order']]:$params['order'];
        $sort = '';
        if($sort_column){
            $order_by = ($params['sort']=='asc')? 'asc': 'desc';
            $sort .= "$sort_column $order_by, ";
        }
        $sort .= 'staffcompetencycarddtls_pk desc';
        $model->orderBy($sort);
        
        // echo $model->createCommand()->getRawSql(); die; 
        if(isset($params['download_id'])){
            $model->where([
                "sir_idnumber" => $params['download_id'],
                "appcdm_standardcoursemst_fk" => $params['coursePk'],
            ]);
        }  
        $data = $model->asArray()->all();
        foreach($data as $k => $lang){
            $lang = $lang['appsim_language'];
            if(empty($lang)){
                continue;
            }
            $language = \Yii::$app->db->createCommand("SELECT group_concat(distinct rm_name_ar order by rm_name_ar SEPARATOR ', ') as language_ar,group_concat(distinct rm_name_en order by rm_name_en SEPARATOR ', ') as language_en FROM `referencemst_tbl` WHERE `referencemst_pk` IN ($lang)")->queryOne();
            $data[$k]['language_ar'] = $language['language_ar'];
            $data[$k]['language_en'] = $language['language_en'];
        }             

        if(isset($params['excel'])){
            $response['data'] = $data;
            return $response;
        } 
        if(isset($params['download_id'])){
            $response['data'] =!empty($data)?$data[0]:$data;
            return $response;
        }   
        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();
        $datatpro=[];
        foreach($data as $index => $d){
            $datatpro[] = $d;
        }
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $datatpro;
        
        return $response;
    }
    

    public static function trainingView($id,$course)
    {
        $model = self::find()->select([ 
            'staffinforepo_pk',
            'scch_verificationcode',
            'appsim_AppStaffInfotmp_FK as StaffInfotmp',  
            'omrm_tpname_en as trainigCentre_en','omrm_tpname_ar as trainigCentre_ar',
            'appiim_branchname_en as branchName_en','appiim_branchname_ar as branchName_ar',
            "(CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
            "(CASE WHEN appiim_officetype = 1 THEN omgov.osm_statename_en WHEN appiim_officetype = 2 THEN gov.osm_statename_en END) as state_en",
            "(CASE WHEN appiim_officetype = 1 THEN omgov.osm_statename_ar WHEN appiim_officetype = 2 THEN gov.osm_statename_ar END) as state_ar",
            "(CASE WHEN appiim_officetype = 1 THEN omcity.ocim_cityname_en WHEN appiim_officetype = 2 THEN city.ocim_cityname_en END) as city_en",
            "(CASE WHEN appiim_officetype = 1 THEN omcity.ocim_cityname_ar WHEN appiim_officetype = 2 THEN city.ocim_cityname_ar END) as city_ar",
            'sir_idnumber as civil_number',
            'per_gov.osm_statename_en as per_state_en','per_gov.osm_statename_ar as per_state_ar',
            'per_city.ocim_cityname_en as per_city_en','per_city.ocim_cityname_ar as per_city_ar',
            'scm_coursename_en as categories_en','scm_coursename_ar as categories_ar',
            'sir_name_en as staffName_en','sir_name_ar as staffName_ar',
            'group_concat(distinct roleforco.rm_rolename_en order by roleforco.rm_rolename_en SEPARATOR ",") as courserole_en',
            'group_concat(distinct roleforco.rm_rolename_ar order by roleforco.rm_rolename_ar SEPARATOR ",") as courserole_ar',
            "group_concat(distinct ccm_catname_en order by ccm_catname_en SEPARATOR ',') as sub_categories_en",
            "group_concat(distinct ccm_catname_ar order by ccm_catname_ar SEPARATOR ',') as sub_categories_ar",
            // "group_concat(distinct a.rm_name_en order by a.rm_name_en SEPARATOR ',') as language_en",
            // "group_concat(distinct a.rm_name_ar order by a.rm_name_ar SEPARATOR ',') as language_ar",
            "oum_status as account_status",
            'appsim_emailid as email_id',
            "DATE_FORMAT(sccd_cardexpiry,'%d-%m-%Y') as dateofexp",
            "DATE_FORMAT(sccd_createdon,'%d-%m-%Y') as last_approved",
            "sccd_status as competency_card",
            "DATE_FORMAT(sir_dob,'%d-%m-%Y') as dob",
            "DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),sir_dob)), '%Y')+0 AS age",
            "(CASE WHEN sir_gender = 1 THEN 'Male' WHEN sir_gender = 2 THEN 'Female' ELSE '-' END) as gender",
            "ocym_countryname_en as nationality_en","ocym_countryname_ar as nationality_ar",
            "contr.rm_name_en as contract_type_en",
            "contr.rm_name_ar as contract_type_ar",
            "appsim_jobtitle as job",
            "sir_addrline1 as address",
            "sir_addrline2 as address2",
            // 'group_concat(distinct assor_gov.osm_statename_en order by assor_gov.osm_statename_en SEPARATOR ",") as assessor_state_en',
            // 'group_concat(distinct assor_gov.osm_statename_ar order by assor_gov.osm_statename_ar SEPARATOR ",") as assessor_state_ar',
            // 'group_concat(distinct assor_city.ocim_cityname_en order by assor_city.ocim_cityname_en SEPARATOR ",") as assessor_city_en',
            // 'group_concat(distinct assor_city.ocim_cityname_ar order by assor_city.ocim_cityname_ar SEPARATOR ",") as assessor_city_ar',
            'group_concat(distinct roleuser.rm_rolename_en order by roleuser.rm_rolename_en SEPARATOR ",") as userrole_en',
            'group_concat(distinct roleuser.rm_rolename_ar order by roleuser.rm_rolename_ar SEPARATOR ",") as userrole_ar',
            'photo.memcompfiledtls_pk as memcompfiledtls_pk','photo.mcfd_uploadedby as mcfd_uploadedby','photo.mcfd_opalmemberregmst_fk as mcfd_opalmemberregmst_fk',
            'moheridoc.memcompfiledtls_pk as moheridoc_memcompfiledtls_pk','moheridoc.mcfd_uploadedby as moheridoc_mcfd_uploadedby','moheridoc.mcfd_opalmemberregmst_fk as moheridoc_mcfd_opalmemberregmst_fk',
            // 'cv.memcompfiledtls_pk as cv_memcompfiledtls_pk','cv.mcfd_uploadedby as cv_mcfd_uploadedby','cv.mcfd_opalmemberregmst_fk as cv_mcfd_opalmemberregmst_fk'
            'sir_staffcv',
            'appsim_language',
            'appsim_roleforcourse',
            "(CASE WHEN appsim_roleforcourse LIKE '%12%' OR appsim_roleforcourse LIKE '%13%' THEN 'yes' ELSE 'no' END) as isAssessor",
            "appcdm_standardcoursemst_fk as coursePk",
            'group_concat(distinct aslm_opalstatemst_fk SEPARATOR "-") as assessor_state_fk',
            'group_concat(distinct aslm_opalcitymst_fk SEPARATOR "-") as assessor_city_fk',

        ])
        ->innerJoin('appcoursetrnsmain_tbl appcou','FIND_IN_SET(AppCourseTrnsMain_pk,appsim_appcoursetrnsmain_fk)')
        ->innerJoin('appcoursedtlsmain_tbl appcouMain','AppCourseDtlsMain_PK  = appctm_AppCourseDtlsMain_FK')
        ->innerJoin('applicationdtlsmain_tbl app','app.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
        ->innerJoin('coursecategorymst_tbl coucat','coursecategorymst_pk = appctm_coursecategorymst_fk')
        ->innerJoin('standardcoursemst_tbl stdcou','standardcoursemst_pk = appcdm_standardcoursemst_fk')
        ->innerJoin('appinstinfomain_tbl appinfo','appinfo.appinstinfomain_pk = appcdm_appinstinfomain_fk')
        ->innerJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appcdm_OpalMemberRegMst_FK')
        ->innerJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('appstafflocationmain_tbl apploc', 'apploc.aslm_appstaffinfomain_fk = AppStaffInfoMain_PK')
        ->leftJoin('projectmst_tbl proj', 'proj.projectmst_pk = app.appdm_projectmst_fk')
        ->leftJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalstatemst_tbl omgov','omgov.opalstatemst_pk = omrm_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl omcity','omcity.opalcitymst_pk = omrm_opalcitymst_fk')
        ->leftJoin('opalusermst_tbl user','user.oum_staffinforepo_fk = staff.staffinforepo_pk')
        ->leftJoin('opalstatemst_tbl per_gov','per_gov.opalstatemst_pk = sir_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl per_city','per_city.opalcitymst_pk = sir_opalcitymst_fk')
        ->leftJoin('rolemst_tbl roleforco','FIND_IN_SET(roleforco.rolemst_pk,appsim_roleforcourse)')
        // ->leftJoin('referencemst_tbl a','find_in_set(a.referencemst_pk,appsim_language)')
        ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sir_nationality')
        ->leftJoin('referencemst_tbl contr','contr.referencemst_pk = appsim_contracttype AND contr.rm_mastertype=7')
        ->leftJoin('rolemst_tbl roleuser','FIND_IN_SET(roleuser.rolemst_pk,oum_rolemst_fk)')
        // ->leftJoin('opalstatemst_tbl assor_gov','assor_gov.opalstatemst_pk = aslm_opalstatemst_fk')
        // ->leftJoin('opalcitymst_tbl assor_city','assor_city.opalcitymst_pk = aslm_opalcitymst_fk')
        // ->leftJoin('opalcitymst_tbl assor_city','FIND_IN_SET(assor_city.opalcitymst_pk,aslm_opalcitymst_fk)')
        ->leftjoin('memcompfiledtls_tbl as photo','photo.memcompfiledtls_pk = sir_photo')
        ->leftjoin('memcompfiledtls_tbl as moheridoc','moheridoc.memcompfiledtls_pk = sir_moheridoc')
        ->leftjoin('memcompfiledtls_tbl as cv','cv.memcompfiledtls_pk = sir_staffcv')
        ->leftJoin('staffcompetencycardhdr_tbl comphdr','comphdr.scch_staffinforepo_fk=appsim_StaffInfoRepo_FK AND scch_standardcoursemst_fk = appcdm_standardcoursemst_fk')
        ->leftJoin('staffcompetencycarddtls_tbl compdtl','compdtl.sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');

        if($course){
            $model->where([
                'appcdm_standardcoursemst_fk' => $course
            ]);
        }
        $model->andWhere([
            "appdm_issuspended" => 2,
            "sir_idnumber" => $id,
        ])->groupBy('appcdm_OpalMemberRegMst_FK,appcdm_standardcoursemst_fk,staffinforepo_pk')->orderBy('staffcompetencycarddtls_pk desc');
        // echo $model->createCommand()->getRawSql(); die; 
        $dataOne = $model->asArray()->one();
        if($dataOne['memcompfiledtls_pk']){
            $dataOne['profile'] = Drive::generateUrl($dataOne['memcompfiledtls_pk'], $dataOne['mcfd_opalmemberregmst_fk'],$dataOne['mcfd_uploadedby']);
        }   
        
        if($dataOne['moheridoc_memcompfiledtls_pk']){
            $dataOne['sir_moheridoc'] = Drive::generateUrl($dataOne['moheridoc_memcompfiledtls_pk'], $dataOne['moheridoc_mcfd_opalmemberregmst_fk'],$dataOne['moheridoc_mcfd_uploadedby']);
            $dataOne['sir_moheridoc_fileType'] = Drive::getFileType(Security::encrypt($dataOne['moheridoc_memcompfiledtls_pk']));
        }   
        if(!empty($dataOne['appsim_language'])){
            $lang = $dataOne['appsim_language'];
            $language = \Yii::$app->db->createCommand("SELECT group_concat(distinct rm_name_ar order by rm_name_ar SEPARATOR ', ') as language_ar,group_concat(distinct rm_name_en order by rm_name_en SEPARATOR ', ') as language_en FROM `referencemst_tbl` WHERE `referencemst_pk` IN ($lang)")->queryOne();
            $dataOne['language_ar'] = $language['language_ar'];
            $dataOne['language_en'] = $language['language_en'];
        }  

        $dataOne['as_address_en'] = null;
        $dataOne['as_address_ar'] = null;
        if($dataOne['assessor_state_fk']){
            $stateFk = explode('-',$dataOne['assessor_state_fk']);
            $cityFk = explode('-',$dataOne['assessor_city_fk']);
            foreach($stateFk as $k=> $stFk){
                $state = OpalstatemstTbl::find()->select(['osm_statename_en','osm_statename_ar'])->where(['opalstatemst_pk' => $stFk])->one();
                $dataOne['as_address_en'][$k]['state']=$state->osm_statename_en;
                $dataOne['as_address_ar'][$k]['state']=$state->osm_statename_ar;

                $city_en = '';
                $city_ar = '';
                if(isset($cityFk[$k])){
                    $cityFk[$k] = explode(',',$cityFk[$k]);
                    foreach($cityFk[$k] as $key=>$ctFk){
                        $city = OpalcitymstTbl::find()->select(['ocim_cityname_en','ocim_cityname_ar'])->where(['opalcitymst_pk' => $ctFk])->one();
                        if($key==0){
                            $city_en.=$city->ocim_cityname_en;
                            $city_ar.=$city->ocim_cityname_ar;
                        }else{
                            $city_en.=','.$city->ocim_cityname_en;
                            $city_ar.=','.$city->ocim_cityname_ar;
                        }
                    }
                }
                $dataOne['as_address_en'][$k]['city']=$city_en;
                $dataOne['as_address_ar'][$k]['city']=$city_ar;
            }
        }

        // if($dataOne['cv_memcompfiledtls_pk']){
        //     $dataOne['sir_staffcv'] = Drive::generateUrl($dataOne['cv_memcompfiledtls_pk'], $dataOne['cv_mcfd_opalmemberregmst_fk'],$dataOne['cv_mcfd_uploadedby']);
        // }   
        return $dataOne; 
    }

    public static function technicalView($id)
    {
        $model = ApplicationdtlsmainTbl::find()->select([ 
            'staffinforepo_pk',
            'scch_verificationcode',
            'appsim_AppStaffInfotmp_FK as StaffInfotmp',  
            'pm_projectname_en as projectName_en','pm_projectname_ar as projectName_ar',
            'omrm_branch_en as trainigCentre_en','omrm_branch_ar as trainigCentre_ar',
            'appiim_branchname_en as branchName_en','appiim_branchname_ar as branchName_ar',
            "(CASE WHEN appiim_officetype = 1 THEN 'Main Office' WHEN appiim_officetype = 2 THEN 'Branch Office' ELSE '-' END) as officetype",
            'gov.osm_statename_en as state_en','gov.osm_statename_ar as state_ar',
            'city.ocim_cityname_en as city_en','city.ocim_cityname_ar as city_ar',
            'per_gov.osm_statename_en as per_state_en','per_gov.osm_statename_ar as per_state_ar',
            'per_city.ocim_cityname_en as per_city_en','per_city.ocim_cityname_ar as per_city_ar',
            'sir_idnumber as civil_number',
            'sir_name_en as staffName_en','sir_name_ar as staffName_ar',
            'group_concat(distinct roleforco.rm_rolename_en order by roleforco.rm_rolename_en SEPARATOR ", ") as rolecourse_en',
            'group_concat(distinct roleforco.rm_rolename_ar order by roleforco.rm_rolename_ar SEPARATOR ", ") as rolecourse_ar',
            'oum_status as account_status',
            'group_concat(distinct rcm_coursesubcatname_en order by rcm_coursesubcatname_en SEPARATOR ", ") as categories_en',
            'group_concat(distinct rcm_coursesubcatname_ar order by rcm_coursesubcatname_ar SEPARATOR ", ") as categories_ar',
            'appsim_emailid as email_id',
            "DATE_FORMAT(sccd_cardexpiry,'%d-%m-%Y') as expiryDate",
            "DATE_FORMAT(sccd_createdon,'%d-%m-%Y') as last_approved",
            "sccd_status as cpmstatus",
            'sccd_createdon',
            'sccd_cardexpiry',
            "DATE_FORMAT(sir_dob,'%d-%m-%Y') as dob",
            "DATE_FORMAT(FROM_DAYS(DATEDIFF(now(),sir_dob)), '%Y')+0 AS age",
            "(CASE WHEN sir_gender = 1 THEN 'Male' WHEN sir_gender = 2 THEN 'Female' ELSE '-' END) as gender",
            "ocym_countryname_en as nationality_en","ocym_countryname_ar as nationality_ar",
            "contr.rm_name_en as contract_type_en",
            "contr.rm_name_ar as contract_type_ar",
            "appsim_jobtitle as job",
            "sir_addrline1 as address",
            "sir_addrline2 as address2",
            'sir_photo.memcompfiledtls_pk as memcompfiledtls_pk','sir_photo.mcfd_uploadedby as mcfd_uploadedby','sir_photo.mcfd_opalmemberregmst_fk as mcfd_opalmemberregmst_fk',
            'sir_civilidback.memcompfiledtls_pk as Idb_memcompfiledtls_pk','sir_civilidback.mcfd_uploadedby as Idb_mcfd_uploadedby','sir_civilidback.mcfd_opalmemberregmst_fk as Idb_mcfd_opalmemberregmst_fk',
            'sir_civilidfront.memcompfiledtls_pk as Idf_memcompfiledtls_pk','sir_civilidfront.mcfd_uploadedby as Idf_mcfd_uploadedby','sir_civilidfront.mcfd_opalmemberregmst_fk as Idf_mcfd_opalmemberregmst_fk',
            'group_concat(distinct lic.sld_ROPlicenseupload order by lic.sld_ROPlicenseupload SEPARATOR ", ") as sld_ROPlicenseupload',
            'moheridoc.memcompfiledtls_pk as moheridoc_memcompfiledtls_pk','moheridoc.mcfd_uploadedby as moheridoc_mcfd_uploadedby','moheridoc.mcfd_opalmemberregmst_fk as moheridoc_mcfd_opalmemberregmst_fk',
            // 'cv.memcompfiledtls_pk as cv_memcompfiledtls_pk','cv.mcfd_uploadedby as cv_mcfd_uploadedby','cv.mcfd_opalmemberregmst_fk as cv_mcfd_opalmemberregmst_fk'
            'sir_staffcv',
            "(CASE WHEN appsim_roleforcourse LIKE '%16%' THEN 'yes' ELSE 'no' END) as isInspector",
            ])
        ->innerJoin('opalmemberregmst_tbl opalmem','opalmem.opalmemberregmst_pk = appdm_opalmemberregmst_fk')
        ->innerJoin('appinstinfomain_tbl appinfo','applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
        ->leftJoin('appstaffinfomain_tbl','appinstinfomain_pk = appsim_AppInstInfoMain_FK')
        ->leftJoin('opalusermst_tbl user','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
        ->leftJoin('apprasvehinspcatmain_tbl','FIND_IN_SET(apprasvehinspcatmain_pk,appsim_apprasvehinspcatmain_fk)')
        ->innerJoin('rascategorymst_tbl cat','cat.rascategorymst_pk = arvicm_rascategorymst_fk')
        ->leftJoin('rolemst_tbl roleuser','FIND_IN_SET(roleuser.rolemst_pk,oum_rolemst_fk)')
        ->innerJoin('staffinforepo_tbl staff', 'staff.staffinforepo_pk = appsim_StaffInfoRepo_FK')
        ->leftJoin('stafflicensedtls_tbl lic', 'sld_staffinforepo_fk = appsim_StaffInfoRepo_FK')
        ->innerJoin('projectmst_tbl proj', 'proj.projectmst_pk = appdm_projectmst_fk')
        ->innerJoin('opalstatemst_tbl gov','gov.opalstatemst_pk = appiim_statemst_fk')
        ->innerJoin('opalcitymst_tbl city','city.opalcitymst_pk = appiim_citymst_fk')
        ->leftJoin('opalstatemst_tbl per_gov','per_gov.opalstatemst_pk = sir_opalstatemst_fk')
        ->leftJoin('opalcitymst_tbl per_city','per_city.opalcitymst_pk = sir_opalcitymst_fk')
        ->innerJoin('rolemst_tbl roleforco','FIND_IN_SET(roleforco.rolemst_pk,appsim_roleforcourse)')
        ->leftJoin('referencemst_tbl a','find_in_set(a.referencemst_pk,appsim_language)')
        ->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sir_nationality')
        ->leftJoin('referencemst_tbl contr','contr.referencemst_pk = appsim_contracttype AND contr.rm_mastertype=7')
        ->leftjoin('memcompfiledtls_tbl sir_photo','sir_photo.memcompfiledtls_pk = sir_photo')
        ->leftjoin('memcompfiledtls_tbl sir_civilidfront','sir_civilidfront.memcompfiledtls_pk = sir_civilidfront')
        ->leftjoin('memcompfiledtls_tbl sir_civilidback','sir_civilidback.memcompfiledtls_pk = sir_civilidback')
        ->leftjoin('memcompfiledtls_tbl as moheridoc','moheridoc.memcompfiledtls_pk = sir_moheridoc')
        ->leftjoin('memcompfiledtls_tbl as cv','cv.memcompfiledtls_pk = sir_staffcv')
        ->innerJoin('staffcompetencycardhdr_tbl comphdr','comphdr.scch_staffinforepo_fk=appsim_StaffInfoRepo_FK')
        ->leftJoin('staffcompetencycarddtls_tbl compdtl','compdtl.sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
        
        ->where([
            "sir_idnumber" => $id,
            "appdm_issuspended" => 2,
        ])
        ->andWhere([
             "scch_projectmst_fk" => 4,
             "appdm_projectmst_fk" => 4
        ])->andWhere([
            "pm_projtype" => 2

        ])->groupBy('AppStaffInfoMain_PK');


        // echo $model->createCommand()->getRawSql(); die;                
        $dataOne = $model->asArray()->one();
        $dataOne['profile']= '';
        if($dataOne['memcompfiledtls_pk']){
            $dataOne['profile'] = Drive::generateUrl($dataOne['memcompfiledtls_pk'], $dataOne['mcfd_opalmemberregmst_fk'],$dataOne['mcfd_uploadedby']);
        }  
        $dataOne['id_front']='';
        if($dataOne['Idf_memcompfiledtls_pk']){
            $dataOne['id_front'] = Drive::generateUrl($dataOne['Idf_memcompfiledtls_pk'], $dataOne['Idf_mcfd_opalmemberregmst_fk'],$dataOne['Idf_mcfd_uploadedby']);
            $dataOne['id_front_fileType'] = Drive::getFileType(Security::encrypt($dataOne['Idf_memcompfiledtls_pk']));

        } 
        $dataOne['id_back']='';
        if($dataOne['Idb_memcompfiledtls_pk']){
            $dataOne['id_back'] = Drive::generateUrl($dataOne['Idb_memcompfiledtls_pk'], $dataOne['Idb_mcfd_opalmemberregmst_fk'],$dataOne['Idb_mcfd_uploadedby']);
            $dataOne['id_back_fileType'] = Drive::getFileType(Security::encrypt($dataOne['Idb_memcompfiledtls_pk']));

        } 

        if($dataOne['moheridoc_memcompfiledtls_pk']){
            $dataOne['sir_moheridoc'] = Drive::generateUrl($dataOne['moheridoc_memcompfiledtls_pk'], $dataOne['moheridoc_mcfd_opalmemberregmst_fk'],$dataOne['moheridoc_mcfd_uploadedby']);
            $dataOne['sir_fileType'] = Drive::getFileType(Security::encrypt($dataOne['moheridoc_memcompfiledtls_pk']));
        }   

        // if($dataOne['cv_memcompfiledtls_pk']){
        //     $dataOne['sir_staffcv'] = Drive::generateUrl($dataOne['cv_memcompfiledtls_pk'], $dataOne['cv_mcfd_opalmemberregmst_fk'],$dataOne['cv_mcfd_uploadedby']);
        // }  

        if(!empty($dataOne['sld_ROPlicenseupload'])){
            $dataOne['sld_ROPlicenseupload'] = explode(',',$dataOne['sld_ROPlicenseupload']);
            foreach($dataOne['sld_ROPlicenseupload'] as $license){
                $mem = MemcompfiledtlsTbl::find()->where(['memcompfiledtls_pk'=>$license])->one();
                $dataOne['license'][] = Drive::generateUrl($mem->memcompfiledtls_pk, $mem->mcfd_opalmemberregmst_fk,$mem->mcfd_uploadedby);
                $dataOne['license_type'][] = Drive::getFileType(Security::encrypt($mem->memcompfiledtls_pk));
            } 
        }             
        return $dataOne;
    }

    public static function educationDetail($params)
    {
        $model = StaffacademicsTbl::find()->select([
            'sacd_institutename as institutename',
            'sacd_degorcert as certificateTitle',
            'rm_name_en as edulevel_en','rm_name_ar as edulevel_ar',
            "DATE_FORMAT(sacd_enddate,'%d-%m-%Y') as gradDate",
            'sacd_grade as grade',
            'sacd_certupload',
            'memcompfiledtls_pk','mcfd_uploadedby','mcfd_opalmemberregmst_fk',
        ])->leftjoin('referencemst_tbl','referencemst_pk = sacd_edulevel AND rm_mastertype = 12')
        ->leftjoin('memcompfiledtls_tbl','memcompfiledtls_pk = sacd_certupload')
        ->where(['sacd_staffinforepo_fk' => $params['id']]);

        // echo $model->createCommand()->getRawSql(); die; 
        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();
        foreach($data as $k => $dataOne){
            if($dataOne['memcompfiledtls_pk']){
               $data[$k]['url'] = Drive::generateUrl($dataOne['memcompfiledtls_pk'], $dataOne['mcfd_opalmemberregmst_fk'],$dataOne['mcfd_uploadedby']);
               $data[$k]['edu_fileType'] = Drive::getFileType(Security::encrypt($dataOne['memcompfiledtls_pk']));
            }
        } 

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $data;
        
        return $response;
    }

    public static function workDetail($params)
    {
        $model = StaffworkexpTbl::find()->select([
            'sexp_employername as institutename',
            "DATE_FORMAT(sexp_doj,'%d-%m-%Y') as doj",
            "(CASE WHEN sexp_currentlyworking=2 THEN DATE_FORMAT(sexp_eod,'%d-%m-%Y') ELSE '-' END) as eod",
            'sexp_designation as jobTitle',
            'memcompfiledtls_pk','mcfd_uploadedby','mcfd_opalmemberregmst_fk',
        ])
        ->leftjoin('memcompfiledtls_tbl','memcompfiledtls_pk = sexp_profdocupload')
        ->where(['sexp_staffinforepo_fk' => $params['id']]);

        // echo $model->createCommand()->getRawSql(); die;   
        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $data = $provider->getModels();
        foreach($data as $k => $dataOne){
           if($dataOne['memcompfiledtls_pk']){
              $data[$k]['url'] = Drive::generateUrl($dataOne['memcompfiledtls_pk'], $dataOne['mcfd_opalmemberregmst_fk'],$dataOne['mcfd_uploadedby']);
              $data[$k]['certi_fileType'] = Drive::getFileType(Security::encrypt($dataOne['memcompfiledtls_pk']));

            }
        } 
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $data;
        
        return $response;
    }

    public static function techCalendarScheduleList($params)
    {
        $model = OpalusermstTbl::find()->select([
            'rasvehicleregdtls_pk',
            'rvrd_inspstarttime as start',
            'rvrd_inspendtime as end',
            'rvrd_dateofinsp as date',
            'concat(DATE_FORMAT(rvrd_inspstarttime,"%h:%i%p"),"-",DATE_FORMAT(rvrd_inspendtime,"%h:%i%p")) as title',
        ])
        ->leftjoin('rasvehicleregdtls_tbl rvrd','rvrd_inspectorname = opalusermst_pk')
        ->where(['oum_staffinforepo_fk'=>$params['id']])
        ->asArray()->all();
        return $model;
    }

    public static function calendarScheduleList($params)
    {
        $date = date("Y-m-d", strtotime(" -62 days"));
        $model = AppstaffscheddtlsTbl::find()->select([
            'appstaffscheddtls_pk',
            'assd_appstaffinfotmp_fk',
            'assd_dayschedule as status_id',
            'assd_starttime as start',
            'assd_endtime as end',
            'assd_date',
            'concat(DATE_FORMAT(assd_starttime,"%h:%i%p"),"-",DATE_FORMAT(assd_endtime,"%h:%i%p")) as title',
            'rm_name_en as status_en',
            'rm_name_ar as status_ar',
            "(CASE WHEN rm_name_en = 'Available' THEN 'availableColor' WHEN rm_name_en = 'Booked' THEN 'bookingColor' WHEN rm_name_en = 'Holiday' THEN 'holidayColor' WHEN rm_name_en = 'Not Available' THEN 'notColor' WHEN rm_name_en = 'Weekend' THEN 'weekendColor' END) as cssClass",
            "if(assd_date >= CURDATE(),'yes','no') as dtype",
            "(CASE WHEN assd_bookedfor = 1 THEN (CASE WHEN bmth_status IS NOT NULL THEN bmth_status ELSE bmph_status END) WHEN assd_bookedfor = 2 THEN bmah_status ELSE null END) as batchStatus",
        ])
        ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule AND rm_mastertype=11')
        ->leftjoin('appstaffinfotmp_tbl','appostaffinfotmp_pk = assd_appstaffinfotmp_fk')
        ->leftjoin('opalusermst_tbl','oum_staffinforepo_fk = appsit_staffinforepo_fk')
        
        ->leftjoin('batchmgmtasmthdr_tbl assessor','bmah_assessor = opalusermst_pk AND assd_date =bmah_assessmentdate')
        ->leftjoin('batchmgmtdtls_tbl assessorStatus','assessorStatus.batchmgmtdtls_pk = assessor.bmah_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtthyhdr_tbl tutorT','bmth_tutor = opalusermst_pk AND assd_date =bmth_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusT','tutorStatusT.batchmgmtdtls_pk = tutorT.bmth_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtpracthdr_tbl tutorP','bmph_tutor = opalusermst_pk AND assd_date =bmph_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusP','tutorStatusP.batchmgmtdtls_pk = tutorP.bmph_batchmgmtdtls_fk')
        ->where(['assd_appstaffinfotmp_fk'=>$params['id']])->andWhere("assd_date > '$date'")
        ->asArray()->all();
        // groupby appostaffinfotmp_pk
        // echo $model->createCommand()->getRawSql(); die;
        
        return $model;
    }

    // AppstaffscheddtlsTbl
    public static function bookingListingQuery($params)
    {
        $model = AppstaffscheddtlsTbl::find()->select([
            'appstaffscheddtls_pk as id',
            'assd_appstaffinfotmp_fk as staffInfo',
            'assd_date',
            "DATE_FORMAT(assd_date,'%d-%m-%Y') as date",
            'concat(DATE_FORMAT(assd_starttime,"%h:%i%p"),"-",DATE_FORMAT(assd_endtime,"%h:%i%p")) as time',
            'rm_name_en as status_en',
            'rm_name_ar as status_ar',
            'assd_dayschedule',
            'assd_starttime as start',
            'assd_endtime as end',
            'tutorStatusT.bmd_Batchno as tt',
            'tutorStatusP.bmd_Batchno as pp',
            "(CASE WHEN assd_bookedfor = 1 THEN (CASE WHEN tutorStatusT.bmd_Batchno IS NOT NULL THEN group_concat(DISTINCT tutorStatusT.bmd_Batchno) ELSE group_concat(DISTINCT tutorStatusp.bmd_Batchno) END) WHEN assd_bookedfor = 2 THEN group_concat(DISTINCT assessorStatus.bmd_Batchno) ELSE '-' END) as batchno",
            "(CASE WHEN assd_bookedfor = 1 THEN 'Training' WHEN assd_bookedfor = 2 THEN 'Assessment' ELSE '-' END) as booked_for"
        ])
        ->leftJoin('referencemst_tbl','referencemst_pk = assd_dayschedule AND rm_mastertype=11')
        ->leftjoin('appstaffinfotmp_tbl','appostaffinfotmp_pk = assd_appstaffinfotmp_fk')
        ->leftjoin('opalusermst_tbl','oum_staffinforepo_fk = appsit_staffinforepo_fk')
        
        ->leftjoin('batchmgmtasmthdr_tbl assessor','bmah_assessor = opalusermst_pk AND assd_date =bmah_assessmentdate')
        ->leftjoin('batchmgmtdtls_tbl assessorStatus','assessorStatus.batchmgmtdtls_pk = assessor.bmah_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtthyhdr_tbl tutorT','bmth_tutor = opalusermst_pk AND assd_date =bmth_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusT','tutorStatusT.batchmgmtdtls_pk = tutorT.bmth_batchmgmtdtls_fk')
        
        ->leftjoin('batchmgmtpracthdr_tbl tutorP','bmph_tutor = opalusermst_pk AND assd_date =bmph_startdate') 
        ->leftjoin('batchmgmtdtls_tbl tutorStatusP','tutorStatusP.batchmgmtdtls_pk = tutorP.bmph_batchmgmtdtls_fk')
        ->where(['assd_appstaffinfotmp_fk'=>$params['id']])->groupBy('assd_date');

        // echo $model->createCommand()->getRawSql(); die;
        if(isset($params['excel'])){
            $startDate = $params['date']['startDate'];
            $endDate = $params['date']['endDate'];
            $model->andFilterWhere(['between', "assd_date", date('Y-m-d',strtotime($startDate)), date('Y-m-d',strtotime($endDate))]);
            return $model->asArray()->all();
        }   

        if(!empty($params['searchkey'])){
            $data = $params['searchkey'];
            if(isset($data['addeddate']['start_date'])){
                $model->andFilterWhere(['between', "assd_date", date('Y-m-d',strtotime($data['addeddate']['start_date'])), date('Y-m-d',strtotime($data['addeddate']['end_date']))]);
            }
            
            if($data['status']){
                $model->andFilterWhere(['IN', 'assd_dayschedule', $data['status']]);
            }
        }
        // if(isset($fiterArray[$params['order']])){
        //     $sort_column = $fiterArray[$params['order']];
        //     $order_by = ($params['sort']=='asc')? 'asc': 'desc';
        //     echo $sort_column; 
        //     $model->orderBy("$sort_column $order_by");
        // }
        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $provider->getModels();
        
        return $response;
    }

    public static function technicalBookingListingQuery($params)
    {
        $model = OpalusermstTbl::find()->select([
            'rvrd_dateofinsp as date',
            'concat(DATE_FORMAT(rvrd_inspstarttime,"%h:%I:%p"),"-",DATE_FORMAT(rvrd_inspendtime,"%h:%I:%p")) as time',
        ])
        ->leftjoin('rasvehicleregdtls_tbl rvrd','rvrd_inspectorname = opalusermst_pk')
        ->where(['oum_staffinforepo_fk'=>$params['id']])
        ->asArray()->all();
        // echo $model->createCommand()->getRawSql(); die;
        if(isset($params['excel'])){
            return $model->asArray()->all();
        }   

        $pageSize = (!empty($params['limit']) && $params['limit'] != 'undefined') ? $params['limit'] : 10 ;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model->asArray(),
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $params['index']
            ],
        ]);

        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $pageSize;
        $response['data'] = $provider->getModels();
        
        return $response;
    }


    public static function saveScheduleTime($data)
    {
        $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $date = date("Y-m-d H:i:s");
        $response['status'] = false;
// print_r($data); die;
        $model = AppstaffscheddtlsTbl::find()->where([
            'assd_appstaffinfotmp_fk' => $data['pk'],
            'assd_date' => date('Y-m-d', strtotime($data['selectedDate']['startDate']))
        ])->asArray()->all();
    
        $newInputTime =date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['startDate'];
        $EndTime =date('Y-m-d', strtotime($data['selectedDate']['startDate'])).' '.$data['EndDate'];
        
        $isTimeAvailable = true;
        foreach ($model as $schedule) {
            $startTime = strtotime($schedule['assd_starttime']);
            $endTime = strtotime($schedule['assd_endtime']);
            
            if (strtotime($newInputTime) >= $startTime && strtotime($newInputTime) < $endTime || strtotime($newInputTime) < $endTime && strtotime($EndTime) > $startTime) {
                $isTimeAvailable = false;
                break; 
            }
        }
        
        if ($isTimeAvailable) {
            $datePeriod = self::dates($data['selectedDate']['startDate'],$data['selectedDate']['endDate']);
            
            $transcation = Yii::$app->db->beginTransaction();
            try {
                foreach($datePeriod as $singledate) {
                    $starttime = $singledate.' '.$data['startDate'];
                    $endtime = $singledate.' '.$data['EndDate'];
                    
                    $model = new AppstaffscheddtlsTbl();
                    $model->assd_opalmemberregmst_fk = $regPk;
                    $model->assd_appstaffinfotmp_fk =  $data['pk'];
                    $model->assd_date =$singledate;
                    $model->assd_dayschedule =64;            
                    $model->assd_starttime=  $starttime;
                    $model->assd_endtime = $endtime;
                    $model->assd_status = 1;
                    $model->assd_createdon =  $date;
                    $model->assd_createdby =  $userPk;
                    $model->save();
                }
                $transcation->commit();
                $response['message'] = "Data has been saved.";
                $response['status'] = true;

            } catch (Exception $exception) {
                $transcation->rollBack();
                $response['message']=$exception->getMessage();
            }
        } else {
            $response['message'] = "This time slot is currently booked, and therefore, you cannot update the time slot.";
        }
        return $response;
    }

    public static function updateScheduleTime($data)
    {}

    public function dates($strDateFrom, $strDateTo) {

       
        $step = '+1 day';
        $output_format = 'Y-m-d';
        $dates = array();
        $current = strtotime($strDateFrom);
        $last = strtotime($strDateTo);
    
        while( $current <= $last ) {
    
            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }
            return $dates;
    }
}
