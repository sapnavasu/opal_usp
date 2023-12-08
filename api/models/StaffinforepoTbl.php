<?php

namespace app\models;

use Yii;
use DateTime;

/**
 * This is the model class for table "staffinforepo_tbl".
 *
 * @property int $staffinforepo_pk
 * @property int $sir_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $sir_type 1-Staff, 2-Candidate, 3-both
 * @property int $sir_idnumber exclude prefix zero '0', Civil ID
 * @property string $sir_name_en
 * @property string $sir_name_ar
 * @property string $sir_emailid
 * @property string $sir_dob
 * @property int $sir_gender 1-Male, 2-Female
 * @property int $sir_photo Reference to compfiledtls_pk
 * @property int $sir_nationality Reference to opalcountrymst_pk
 * @property int $sir_civilidfront Reference to compfiledtls_pk
 * @property int $sir_civilidback Reference to compfiledtls_pk
 * @property string $sir_addrline1
 * @property string $sir_addrline2
 * @property int $sir_opalstatemst_fk Reference to opalstatemst_pk
 * @property int $sir_opalcitymst_fk Reference to opalcitymst_pk
 * @property string $sir_createdon
 * @property int $sir_createdby
 * @property string $sir_updatedon
 * @property int $sir_updatedby
 *
 * @property AppstaffinfohstyTbl[] $appstaffinfohstyTbls
 * @property AppstaffinfomainTbl[] $appstaffinfomainTbls
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls
 * @property LearnerreghrddtlsTbl[] $learnerreghrddtlsTbls
 * @property StaffacademicsTbl[] $staffacademicsTbls
 * @property OpalcitymstTbl $sirOpalcitymstFk
 * @property OpalmemberregmstTbl $sirOpalmemberregmstFk
 * @property OpalstatemstTbl $sirOpalstatemstFk
 * @property StafflicensedtlsTbl[] $stafflicensedtlsTbls
 * @property StaffworkexpTbl[] $staffworkexpTbls
 * @property TrngattdntdtlsTbl[] $trngattdntdtlsTbls
 */
class StaffinforepoTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffinforepo_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sir_idnumber', 'sir_name_en', 'sir_name_ar', 'sir_emailid', 'sir_dob', 'sir_gender', 'sir_nationality', 'sir_opalstatemst_fk', 'sir_opalcitymst_fk', 'sir_createdon', 'sir_createdby'], 'required'],
            [['sir_opalmemberregmst_fk', 'sir_type', 'sir_gender', 'sir_photo', 'sir_nationality', 'sir_civilidfront', 'sir_civilidback', 'sir_opalstatemst_fk', 'sir_opalcitymst_fk', 'sir_createdby', 'sir_updatedby'], 'integer'],
            [['sir_dob', 'sir_createdon', 'sir_updatedon'], 'safe'],
            //[['sir_staffrole', 'sir_jobtitle'], 'string'],
            [['sir_name_en', 'sir_name_ar', 'sir_addrline1', 'sir_addrline2'], 'string', 'max' => 255],
            [['sir_emailid'], 'string', 'max' => 100],
            [['sir_opalcitymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['sir_opalcitymst_fk' => 'opalcitymst_pk']],
            [['sir_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['sir_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['sir_opalstatemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['sir_opalstatemst_fk' => 'opalstatemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffinforepo_pk' => 'Staffinforepo Pk',
            'sir_opalmemberregmst_fk' => 'Sir Opalmemberregmst Fk',
            'sir_type' => 'Sir Type',
            'sir_idnumber' => 'Sir Idnumber',
            'sir_name_en' => 'Sir Name En',
            'sir_name_ar' => 'Sir Name Ar',
            'sir_emailid' => 'Sir Emailid',
            'sir_dob' => 'Sir Dob',
            'sir_gender' => 'Sir Gender',
            'sir_photo' => 'Sir Photo',
            'sir_nationality' => 'Sir Nationality',
            'sir_civilidfront' => 'Sir Civilidfront',
            'sir_civilidback' => 'Sir Civilidback',
            'sir_addrline1' => 'Sir Addrline1',
            'sir_addrline2' => 'Sir Addrline2',
            'sir_opalstatemst_fk' => 'Sir Opalstatemst Fk',
            'sir_opalcitymst_fk' => 'Sir Opalcitymst Fk',
            'sir_createdon' => 'Sir Createdon',
            'sir_createdby' => 'Sir Createdby',
            'sir_updatedon' => 'Sir Updatedon',
            'sir_updatedby' => 'Sir Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_StaffInfoRepo_FK' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_StaffInfoRepo_FK' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfotmpTbls()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerreghrddtlsTbls()
    {
        return $this->hasMany(LearnerreghrddtlsTbl::className(), ['lrhd_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffacademicsTbls()
    {
        return $this->hasMany(StaffacademicsTbl::className(), ['sacd_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSirOpalcitymstFk()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'sir_opalcitymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSirOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'sir_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSirOpalstatemstFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'sir_opalstatemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafflicensedtlsTbls()
    {
        return $this->hasMany(StafflicensedtlsTbl::className(), ['sld_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffworkexpTbls()
    {
        return $this->hasMany(StaffworkexpTbl::className(), ['sexp_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrngattdntdtlsTbls()
    {
        return $this->hasMany(TrngattdntdtlsTbl::className(), ['tad_staffinforepo_fk' => 'staffinforepo_pk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffinforepoTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffinforepoTblQuery(get_called_class());
    }


    public static function saveStaff($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        $model = new StaffinforepoTbl();
        $model->sir_opalmemberregmst_fk = $requestdata['sir_opalmemberregmst_fk'];
        $model->sir_type = 1;
        $model->sir_idnumber = str_replace(' ', '', $requestdata['civil_num']);
        $model->sir_name_en = $requestdata['staffeng'];
        $model->sir_name_ar = $requestdata['staffarab'];
        $model->sir_emailid = $requestdata['email_id'];
        $model->sir_dob = date("Y-m-d", strtotime($requestdata['date_birth']));
        $model->sir_gender = $requestdata['gend_er'];
        $model->sir_nationality = $requestdata['national'];

        // $role = "";
        // if(!empty($requestdata['role'])){
        //     $role = implode(',', $requestdata['role']);
        // }
        // $model->sir_staffrole = $role;

        //$model->sir_jobtitle = $requestdata['job_title'];
        // $model->sir_contracttype = $requestdata['cont_type'];
        $model->sir_addrline1 = $requestdata['house'];
        $model->sir_addrline2 = $requestdata['houseadd'];
        $model->sir_opalstatemst_fk = $requestdata['state'];
        $model->sir_opalcitymst_fk = $requestdata['city'];
        $model->sir_createdon = date("Y-m-d H:i:s");
        $model->sir_createdby = $requestdata['sir_createdby'];


        if ($model->save()) {

            $modelInsObj = AppinstinfotmpTbl::find()
                ->select(['appinstinfotmp_pk'])
                ->where("appiit_applicationdtlstmp_fk =" . $requestdata['appdtlstmp_id'])->one();
            //echo '<pre>';print_r($requestdata);exit;
            $modelAcc = new AppstaffinfotmpTbl();
            $modelAcc->appsit_opalmemberregmst_fk = $requestdata['sir_opalmemberregmst_fk'];
            //echo $requestdata['appdtlstmp_id'];exit;
            //$modelAcc->appsit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
            $modelAcc->appsit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
            $modelAcc->appsit_appinstinfotmp_fk = $modelInsObj->appinstinfotmp_pk;
            $modelAcc->appsit_staffinforepo_fk = $model->staffinforepo_pk;
            $modelAcc->appsit_emailid = $requestdata['email_id'];
            ///////
            //$modelAcc->appsit_appoffercoursetmp_fk=1;


            //$modelAcc->appsit_applicationdtlstmp_fk = 1;
            ///////
            $role = "";
            if (!empty($requestdata['role'])) {
                $role = implode(',', $requestdata['role']);
            }
            if($requestdata['projecttype'] == 1){
            $modelAcc->appsit_mainrole = $role;
            }else if($requestdata['projecttype'] == 4){
            $modelAcc->appsit_roleforcourse = $role;
            $modelAcc->appsit_apprasvehinspcattmp_fk = implode(',', $requestdata['inspect_Vtype']);

            }
            $modelAcc->appsit_jobtitle = $requestdata['job_title'];
            $modelAcc->appsit_contracttype = $requestdata['cont_type'];
            $modelAcc->appsit_status = 1;
            $modelAcc->appsit_createdon = date("Y-m-d H:i:s");
            $modelAcc->appsit_createdby = $requestdata['sir_createdby'];
            //echo '<pre>';print_r($modelAcc);exit;
            if ($modelAcc->save()) {
            } else {
                echo "<pre>";
                var_dump($modelAcc->getErrors());
                exit;
            }

            //update status for re submit starts
            $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
            $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlstmp_id']);
            //update status for re submit ends

            return $model->staffinforepo_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public static function saveLearner($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        $regPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $staffObj = StaffinforepoTbl::find()
                ->select(['*'])
                ->where(['sir_idnumber' => $requestdata->sir_idnumber])->one();
                //->where("sir_idnumber ='$requestdata->sir_idnumber'.")->one();
        
        //check age limit starts
        $modelBatchRes = BatchmgmtdtlsTbl::find()->select(['*'])
                        ->leftJoin('standardcoursedtls_tbl std','std.standardcoursedtls_pk = batchmgmtdtls_tbl.bmd_standardcoursedtls_fk')
                        ->where(['batchmgmtdtls_pk' => $requestdata->batchmgmtdtls])
                        ->asArray()
                        ->one();
        
        //$requestdata->age = 20;
        if(!empty($modelBatchRes)){
            if($modelBatchRes['scd_hasagelimit'] == '1'){
                if($modelBatchRes['scd_agelimit'] > $requestdata->age){
                    return "age_limit";
                    exit;
                }
            }

            if($modelBatchRes['bmd_status'] != '1'){
                    return "batch_notnew";
                    exit;
            }
        }
        //check age limit Ends

        //check batch Is Available starts

        //check batch Is Available Ends

        //check standard course Card Starts
        $modelStdRes = LearnercarddtlsTbl::find()->select(['*'])
                        ->where(['lcd_standardcoursemst_fk' => $modelBatchRes['bmd_standardcoursedtls_fk']])
                        ->asArray()
                        ->one();
        $stdRes = StandardcoursedtlsTbl::find()->select(['*'])
                        ->where(['standardcoursedtls_pk' => $modelBatchRes['bmd_standardcoursedtls_fk']])
                        ->asArray()
                        ->one();
        
        if(!empty($stdRes)){
            if(!empty($stdRes['scd_prerequesit'])){
                $stdArray = explode(",", $stdRes['scd_prerequesit']);
                foreach($stdArray as $stdDtls){
                    $stdResData = LearnercarddtlsTbl::find()->select(['*'])
                        ->where(['lcd_standardcoursedtls_fk' => $stdDtls])
                        ->andWhere(['lcd_status' => '1'])
                        ->asArray()
                        ->one();
                    if(empty($stdResData)){
                        // return "card_limit";
                        // exit;
                    }
                }
            }
        }
        //check standard course Card Ends
        
        $type="2";
            if(!empty($staffObj)){
                $staffinforepo = $staffObj->staffinforepo_pk;
                $opalmemberregmst = $staffObj->sir_opalmemberregmst_fk;
                $emailid = $staffObj->sir_emailid;
                if($staffObj->sir_type == '1'){
                    $type="3";
                    $model = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $staffObj->staffinforepo_pk])->one();
                    $model->sir_type = $type;
                    $model->save();
                }else{
                    
                    $lerRes = LearnerreghrddtlsTbl::find()
                                                    ->where(['lrhd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls])
                                                    ->andWhere(['lrhd_staffinforepo_fk' => $staffObj->staffinforepo_pk])->all();
                    
                    // if(!empty($lerRes)){
                    //     return "already_registered";
                    //     exit;
                    // }
                    
                    $query1Res =   \Yii::$app->db->createCommand("SELECT bmd_standardcoursedtls_fk FROM batchmgmtdtls_tbl join learnerreghrddtls_tbl on batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk where lrhd_staffinforepo_fk = $staffObj->staffinforepo_pk and batchmgmtdtls_pk = $requestdata->batchmgmtdtls")
                                        ->queryAll();

                    $query2Res =   \Yii::$app->db->createCommand("SELECT bmd_standardcoursedtls_fk FROM batchmgmtdtls_tbl join learnerreghrddtls_tbl on batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk where lrhd_staffinforepo_fk = $staffObj->staffinforepo_pk and batchmgmtdtls_pk = $requestdata->batchmgmtdtls and bmd_status not in ('7','8')")
                                        ->queryAll();
                                     
                    $array2 = array();
                    foreach($query2Res as $query2Info){
                        $array2[] = $query2Info['bmd_standardcoursedtls_fk'];
                        
                    }

                    if(!empty($query1Res) && !empty($query2Res)){
                        if (in_array($query1Res[0]['bmd_standardcoursedtls_fk'], $array2)){
                            // return "same_course";
                            // exit;
                        } else { 
                        }
                    } else {
                    }
                    
                    
                }  
            }else{
                
                $type="2";
                $model = new StaffinforepoTbl();
                $model->sir_opalmemberregmst_fk = $regPk;
                $model->sir_type = $type;
                $model->sir_idnumber = str_replace(' ', '', $requestdata->sir_idnumber);
                $model->sir_name_en = $requestdata->sir_name_en;
                $model->sir_name_ar = $requestdata->sir_name_ar;
                $model->sir_emailid = $requestdata->sir_emailid;
                $model->sir_dob = $requestdata->sir_dob;
                $model->sir_gender = $requestdata->sir_gender;
                $model->sir_nationality = $requestdata->sir_nationality;
                $model->sir_photo = $requestdata->sir_photo[0];
                $model->sir_mobnum = $requestdata->mnumber;
                $model->sir_altmobnum = $requestdata->mnumber2;
                if(is_array($requestdata->sir_civilidfront)){
                    if(count($requestdata->sir_civilidfront) > 1){
                        $model->sir_civilidfront = $requestdata->sir_civilidfront[0];
                        $model->sir_civilidback = $requestdata->sir_civilidfront[1];
                    }else{
                        $model->sir_civilidfront = $requestdata->sir_civilidfront[0];
                    }
                }else{
                    $model->sir_civilidfront = "";
                }

                $model->sir_addrline1 = $requestdata->sir_addrline1;
                $model->sir_addrline2 = $requestdata->sir_addrline2;
                $model->sir_opalstatemst_fk = $requestdata->state;
                $model->sir_opalcitymst_fk = $requestdata->city;
                $model->sir_createdon = date("Y-m-d H:i:s");
                $model->sir_createdby = $userPk;
                if(!$model->save()){
                    echo "<pre>";var_dump($model->getErrors());exit;
                }else{
                    $staffinforepo = $model->staffinforepo_pk;
                    $opalmemberregmst = $model->sir_opalmemberregmst_fk;
                    $emailid = $model->sir_emailid;
                }
           }

                $modelStfLc = StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk' => $staffObj->staffinforepo_pk])->all();
                if(!empty($modelStfLc)){
                    $license = StafflicensedtlsTbl::find()->where(['stafflicensedtls_pk' => $modelStfLc[0]->stafflicensedtls_pk])->one();
                    
                    $light = "";
                    $heavy = "";
                    // if ($requestdata->light_issue_date) {
                    //     $light = new DateTime($requestdata->light_issue_date);;
                    //     $light = $light->format('Y-m-d');
                    // }
                    // if ($requestdata->heavy_issue_date) {
                    //     $heavy = new DateTime($requestdata->heavy_issue_date);
                    //     $heavy = $heavy->format('Y-m-d');
                    // }

                    $light = $requestdata->light_issue_date;
                    $heavy = $requestdata->heavy_issue_date;
                        
                    
                    $heavy = $requestdata->heavy_issue_date;
                    $license->sld_staffinforepo_fk = $staffinforepo;
                    $license->sld_ROPlicense = $requestdata->license_number;
                    if($requestdata->radion_button == 1){
                        if(is_array($requestdata->license_card)){
                            if(count($requestdata->license_card) > 1){
                                $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                                //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }else{
                                $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }
                            //$license->sld_ROPlicenseupload = "";
                        }else{
                            $license->sld_ROPlicenseupload = "";
                        }
                    } else {
                        $license->sld_ROPlicenseupload = "";
                        $license->sld_ROPlicense = "";
                    }
                    $license->sld_hasROPlightlicense = $requestdata->light_license;
                    $license->sld_hasROPheavylicense = $requestdata->heavy_license;
                    if($requestdata->light_license == 2){
                        $light = "";
                    }
         
                    if($requestdata->heavy_license == 2){
                        $heavy = "";
                    }
                    $license->sld_ROPlightlicense = $light;
                    $license->sld_ROPheavylicense = $heavy;
                    $license->sld_createdby = $userPk;
                }else{
                    $license = new StafflicensedtlsTbl();
                    $light = "";
                    $heavy = "";
                    $light = "";
                    $heavy = "";
                    // if ($requestdata->light_issue_date) {
                    //     $light = new DateTime($requestdata->light_issue_date);;
                    //     $light = $light->format('Y-m-d');
                    // }
                    // if ($requestdata->heavy_issue_date) {
                    //     $heavy = new DateTime($requestdata->heavy_issue_date);
                    //     $heavy = $heavy->format('Y-m-d');
                    // }

                    $light = $requestdata->light_issue_date;
                        
                    
                    $heavy = $requestdata->heavy_issue_date;
                    $license->sld_staffinforepo_fk = $staffinforepo;
                    $license->sld_ROPlicense = $requestdata->license_number;
                    if($requestdata->radion_button == 1){
                        if(is_array($requestdata->license_card)){
                            if(count($requestdata->license_card) > 1){
                                $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                                //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }else{
                                $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }
                            //$license->sld_ROPlicenseupload = "";
                        }else{
                            $license->sld_ROPlicenseupload = "";
                        }
                    } else {
                        $license->sld_ROPlicenseupload = "";
                        $license->sld_ROPlicense = "";
                    }
                    $license->sld_hasROPlightlicense = $requestdata->light_license;
                    $license->sld_hasROPheavylicense = $requestdata->heavy_license;
                    if($requestdata->light_license == 2){
                        $light = "";
                    }
         
                    if($requestdata->heavy_license == 2){
                        $heavy = "";
                    }
                    $license->sld_ROPlightlicense = $light;
                    $license->sld_ROPheavylicense = $heavy;
                    $license->sld_createdby = $userPk;
                }

                
                if ($license->save()) {
                }else {
                    echo "<pre>";var_dump($license->getErrors());exit;
                }

            // $license = new StafflicensedtlsTbl();
            // $light = "";
            // $heavy = "";
            // if ($requestdata->light_issue_date) {
            //     $light = new DateTime($requestdata->light_issue_date);;
            //     $light = $light->format('Y-m-d');
            // }
            // if ($requestdata->heavy_issue_date) {
            //     $heavy = new DateTime($requestdata->heavy_issue_date);
            //     $heavy = $heavy->format('Y-m-d');
            // }

            // //$license->sld_staffinforepo_fk = $model->staffinforepo_pk;
            // $license->sld_staffinforepo_fk = $staffinforepo;
            // $license->sld_ROPlicense = $requestdata->license_number;
            
            // if(is_array($requestdata->license_card)){
            //     if(count($requestdata->license_card) > 1){
            //         $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
            //         //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
            //     }else{
            //         $license->sld_ROPlicenseupload = $requestdata->license_card[0];
            //     }
            //     //$license->sld_ROPlicenseupload = "";
            // }else{
            //     $license->sld_ROPlicenseupload = "";
            // }

            // //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
            // $license->sld_hasROPlightlicense = $requestdata->light_license;
            // $license->sld_hasROPheavylicense = $requestdata->heavy_license;
            // $license->sld_ROPlightlicense = $light;
            // $license->sld_ROPheavylicense = $heavy;
            // $license->sld_createdby = $userPk;

          
            // if ($license->save()) {
            // }else {
            //     echo "<pre>";var_dump($license->getErrors());exit;
            // }


            //     $modelBatch = BatchmgmtdtlsTbl::find()
            //         ->select(['*'])
            //         ->leftJoin('appcoursedtlsmain_tbl appcour','appcour.AppCourseDtlsMain_PK = batchmgmtdtls_tbl.bmd_appcoursedtlsmain_fk')
            //         ->leftJoin('applicationdtlsmain_tbl appmain','appmain.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
            //         ->where("batchmgmtdtls_pk =" . $requestdata->batchmgmtdtls)
            //     ->asArray()
            //     ->one();
                
            //     $learner = new LearnerreghrddtlsTbl();
            //     $learner->lrhd_staffinforepo_fk = $staffinforepo;
            //     $learner->Irhd_emailid = $emailid;
            //     $learner->lrhd_opalmemberregmst_fk = $modelBatch['bmd_opalmemberregmst_fk'];
            //     $learner->lrhd_batchmgmtdtls_fk = $requestdata->batchmgmtdtls;
            //     $learner->Irhd_projectmst_fk = $modelBatch['appdm_projectmst_fk'];
            //    // $learner->lrhd_learnerfee = $requestdata->learner_fee || 0.001;
            //     $learner->lrhd_learnerfee = $requestdata->learner_fee || 0.001;
            //     $learner->lrhd_feestatus = $requestdata->learner_fee_status || '2';
            //     $learner->lrhd_paidby = $requestdata->paid_by;
            //     $learner->lrhd_status = 1;
            //     $learner->lrhd_createdby = $userPk;
                
            //     if(!$learner->save()) {
            //         echo "<pre>";var_dump($learner->getErrors());exit;
            //     }

            //     // theory update start
            //     $modelThryHdr = BatchmgmtthyhdrTbl::find()->where(['bmth_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmth_status' => 1])
            //                         ->orderBy(['batchmgmtthyhdr_pk' => SORT_ASC])
            //                         ->one();

            //     $modelThryDtls = BatchmgmtthydtlsTbl::find()->where(['bmtd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmtd_batchmgmtthyhdr_fk' => $modelThryHdr->batchmgmtthyhdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdr)){
            //         if(count($modelThryDtls) < $modelThryHdr->bmth_batchcount){
            //             $saveBatchDtls = new BatchmgmtthydtlsTbl();
            //             $saveBatchDtls->bmtd_batchmgmtdtls_fk = $modelThryHdr->bmth_batchmgmtdtls_fk;
            //             $saveBatchDtls->bmtd_batchmgmtthyhdr_fk = $modelThryHdr->batchmgmtthyhdr_pk;
            //             $saveBatchDtls->bmtd_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
            //             $saveBatchDtls->bmtd_status = 1;
            //             $saveBatchDtls->bmtd_createdon = date("Y-m-d H:i:s");
            //             $saveBatchDtls->bmtd_createdby = $userPk;
            //             if(!$saveBatchDtls->save()) {
            //                 echo "<pre>";var_dump($saveBatchDtls->getErrors());exit;
            //             }
            //         }
            //     }

            //     $modelThryDtlsCnt = BatchmgmtthydtlsTbl::find()->where(['bmtd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmtd_batchmgmtthyhdr_fk' => $modelThryHdr->batchmgmtthyhdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdr)){
            //         if(count($modelThryDtlsCnt) == $modelThryHdr->bmth_batchcount){
            //             $modelBatchUpdate = BatchmgmtthyhdrTbl::find()->where(['batchmgmtthyhdr_pk' => $modelThryHdr->batchmgmtthyhdr_pk])->one();
            //             $modelBatchUpdate->bmth_status = 2;
            //             $modelBatchUpdate->save();
            //         }
            //     }
            //     // theory update end

            //     // pracical update start
            //     $modelThryHdrPrt = BatchmgmtpracthdrTbl::find()->where(['bmph_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmph_status' => 1])
            //                         ->orderBy(['batchmgmtpracthdr_pk' => SORT_ASC])
            //                         ->one();

            //     $modelThryDtlsPrt = BatchmgmtpractdtlsTbl::find()->where(['bmpd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmpd_batchmgmtpracthdr_fk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdrPrt)){
            //         if(count($modelThryDtlsPrt) < $modelThryHdrPrt->bmph_batchcount){
            //             $saveBatchDtlsPrt = new BatchmgmtpractdtlsTbl();
            //             $saveBatchDtlsPrt->bmpd_batchmgmtdtls_fk = $modelThryHdrPrt->bmph_batchmgmtdtls_fk;
            //             $saveBatchDtlsPrt->bmpd_batchmgmtpracthdr_fk = $modelThryHdrPrt->batchmgmtpracthdr_pk;
            //             $saveBatchDtlsPrt->bmpd_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
            //             $saveBatchDtlsPrt->bmpd_status = 1;
            //             $saveBatchDtlsPrt->bmpd_createdon = date("Y-m-d H:i:s");
            //             $saveBatchDtlsPrt->bmpd_createdby = $userPk;
            //             if(!$saveBatchDtlsPrt->save()) {
            //                 echo "<pre>";var_dump($saveBatchDtlsPrt->getErrors());exit;
            //             }
            //         }
            //     }

            //     $modelThryDtlsPrtCnt = BatchmgmtpractdtlsTbl::find()->where(['bmpd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmpd_batchmgmtpracthdr_fk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdrPrt)){
            //         if(count($modelThryDtlsPrtCnt) == $modelThryHdrPrt->bmph_batchcount){
            //             $modelBatchUpdatePrt = BatchmgmtpracthdrTbl::find()->where(['batchmgmtpracthdr_pk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])->one();
            //             $modelBatchUpdatePrt->bmph_status = 2;
            //             $modelBatchUpdatePrt->save();
            //         }
            //     }
            //     // pracical update end

            //     // assesment update start
            //     $modelThryHdrAss = BatchmgmtasmthdrTbl::find()->where(['bmah_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmah_status' => 1])
            //                         ->orderBy(['batchmgmtasmthdr_pk' => SORT_ASC])
            //                         ->one();

            //     $modelThryDtlsAss = BatchmgmtasmtdtlsTbl::find()->where(['bmad_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmad_batchmgmtasmthdr_fk' => $modelThryHdrAss->batchmgmtasmthdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdrAss)){
            //         if(count($modelThryDtlsAss) < $modelThryHdrAss->bmah_batchcount){
            //             $saveBatchDtlsAss = new BatchmgmtasmtdtlsTbl();
            //             $saveBatchDtlsAss->bmad_batchmgmtdtls_fk = $modelThryHdrAss->bmah_batchmgmtdtls_fk;
            //             $saveBatchDtlsAss->bmad_batchmgmtasmthdr_fk = $modelThryHdrAss->batchmgmtasmthdr_pk;
            //             $saveBatchDtlsAss->bmad_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
            //             $saveBatchDtlsAss->bmad_staffinforepo_fk = $model->staffinforepo_pk;;
            //             $saveBatchDtlsAss->bmad_status = 1;
            //             $saveBatchDtlsAss->bmad_createdon = date("Y-m-d H:i:s");
            //             $saveBatchDtlsAss->bmad_createdby = $userPk;
            //             if(!$saveBatchDtlsAss->save()) {
            //                 echo "<pre>";var_dump($saveBatchDtlsAss->getErrors());exit;
            //             }
            //         }
            //     }

            //     $modelThryDtlsAssCnt = BatchmgmtasmtdtlsTbl::find()->where(['bmad_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmad_batchmgmtasmthdr_fk' => $modelThryHdrAss->batchmgmtasmthdr_pk])
            //                         ->all();

            //     if(!empty($modelThryHdrAss)){
            //         if(count($modelThryDtlsAssCnt) == $modelThryHdrAss->bmah_batchcount){
            //             $modelBatchUpdateAss = BatchmgmtasmthdrTbl::find()->where(['batchmgmtasmthdr_pk' => $modelThryHdrAss->batchmgmtasmthdr_pk])->one();
            //             $modelBatchUpdateAss->bmah_status = 2;
            //             $modelBatchUpdateAss->save();
            //         }
            //     }
            //     // assesment update end

                return $license;

            

            // echo "test"; exit;


        // } else {
        //     echo "<pre>";
        //     var_dump($model->getErrors());
        //     exit;
        // }
    }

    public static function Learnerage($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        $regPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        //check age limit starts
        $modelBatchRes = BatchmgmtdtlsTbl::find()->select(['*'])
                        ->leftJoin('standardcoursedtls_tbl std','std.standardcoursedtls_pk = batchmgmtdtls_tbl.bmd_standardcoursedtls_fk')
                        ->where(['batchmgmtdtls_pk' => $requestdata->form->batchmgmtdtls])
                        ->asArray()
                        ->one();
        
        return $modelBatchRes;
        
    }

    public function getLearnerEduList($params)
    {
        $education = StaffacademicsTbl::find()->where(["sacd_staffinforepo_fk" => $params])->all();

        return $education;
    }



    public static function saveStaffedu($requestdata)
    {
        $regPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);

        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $modelAcc = new StaffacademicsTbl();
        if (!empty($requestdata['stfrepo'])) {
            $modelAcc->sacd_staffinforepo_fk = $requestdata['stfrepo'];
        }

        if (!empty($requestdata['sacd_staffinforepo_fk'])) {
            $modelAcc->sacd_staffinforepo_fk = $requestdata['sacd_staffinforepo_fk'];
        }

       
        //$modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['year_join']));
        $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['GradeDate']));
        $modelAcc->sacd_institutename = $requestdata['institute_name'];
     
        // if(!empty($requestdata['education_files'])){
        //     $modelAcc->sacd_certupload = $requestdata['education_files'][0];
        // }        
        $modelAcc->sacd_edulevel = $requestdata['edut_level'];
        $modelAcc->sacd_degorcert = $requestdata['degree_cert'];
        $modelAcc->sacd_grade = $requestdata['gpa_grade'];
        $modelAcc->sacd_createdon = date("Y-m-d H:i:s");
        $modelAcc->sacd_createdby = $userPk;
        $modelAcc->sacd_certupload = $requestdata['education_files'];

        if ($modelAcc->save()) {

            if(!empty($requestdata['learner'])){

            }else{
                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlstmp_id']);
                //update status for re submit ends
            }
            

            return $modelAcc->staffacademics_pk;
        } else {
            echo "<pre>";
            var_dump($modelAcc->getErrors());
            exit;
        }
    }

    public static function updateStaffedu($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        //$modelAcc = new StaffacademicsTbl();
        $modelAcc = StaffacademicsTbl::find()->where(['staffacademics_pk' => $requestdata['staffacademics_pk']])->one();
        //$modelAcc->sacd_staffinforepo_fk = $requestdata['stfrepo'];
       $modelAcc->sacd_startdate = date("Y-m-d", strtotime($requestdata['year_join']));
        $modelAcc->sacd_enddate = date("Y-m-d", strtotime($requestdata['GradeDate']));        $modelAcc->sacd_institutename = $requestdata['institute_name'];
        $modelAcc->sacd_edulevel = $requestdata['edut_level'];
        $modelAcc->sacd_degorcert = $requestdata['degree_cert'];
        $modelAcc->sacd_grade = $requestdata['gpa_grade'];
        $modelAcc->sacd_updatedon = date("Y-m-d H:i:s");
        $modelAcc->sacd_updatedby = $requestdata['sir_createdby'];
        $modelAcc->sacd_certupload = $requestdata['education_files'];

        if ($modelAcc->save()) {

           
            if(!empty($requestdata['learner'])){

            }else{
                 //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlstmp_id']);
                //update status for re submit ends
            }

            return $modelAcc->staffacademics_pk;
        } else {
            echo "<pre>";
            var_dump($modelAcc->getErrors());
            exit;
        }
    }


    public static function saveWorkexp($requestdata)
    {
        $modelExp = new StaffworkexpTbl();
        if (!empty($requestdata['sexp_staffinforepo_fk'])) {
            $modelExp->sexp_staffinforepo_fk = $requestdata['sexp_staffinforepo_fk'];
        }

        if (!empty($requestdata['stafrep_id'])) {
            $modelExp->sexp_staffinforepo_fk = $requestdata['stafrep_id'];
        }

    

        $modelExp->sexp_employername = $requestdata['oragn_name'];
       
        if ($requestdata['date_join'] != 'Invalid date' &&  (!empty($requestdata['date_join'])) ){
            $modelExp->sexp_doj = date("Y-m-d", strtotime($requestdata['date_join']));
        }

        $curr_work = 2;
        if (!empty($requestdata['curr_work'])) {
            $curr_work = $requestdata['curr_work'];
        }
        $modelExp->sexp_currentlyworking = $curr_work;
        if (!empty($requestdata['workdate'])) {
            $modelExp->sexp_eod = date("Y-m-d", strtotime($requestdata['workdate']));
        }

        $modelExp->sexp_opalcountrymst_fk = $requestdata['employ_country'];
      
        if (!empty($requestdata['employ_state'])) {
            $modelExp->sexp_opalstatemst_fk = $requestdata['employ_state'];
        }
        if (!empty($requestdata['employ_city'])) {
            $modelExp->sexp_opalcitymst_fk = $requestdata['employ_city'];
        }

        if (!empty($requestdata['file_workexperience'])) {
            $modelExp->sexp_profdocupload = $requestdata['file_workexperience'];
        }
       
        $modelExp->sexp_designation = $requestdata['designat'];
        //$modelExp->sexp_moheridoc = "test";
        //$modelExp->sexp_appcoursedtlsmain_fk = 1;
        $modelExp->sexp_createdon = date("Y-m-d H:i:s");
        $modelExp->sexp_createdby = $requestdata['sexp_createdby'];

        if ($modelExp->save()) {
            if(!empty($requestdata['learnerwork'])){

            }else{
                 //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlsPk']);
                //update status for re submit ends
            }
            
            return $modelExp->staffworkexp_pk;
        } else {
            echo "<pre>";
            var_dump($modelExp->getErrors());
            exit;
        }
    }


    public static function getTutorsListByRegPk($regPk)
    {
        return StaffinforepoTbl::find()
            ->select(['staffinforepo_pk as pk', 'sir_name_en as staffname_en', 'sir_name_ar as staffname_ar'])
            ->where(['IN', 'sir_staffrole', [11]])
            ->andWhere(['IN', 'sir_type', [1, 3]])
            ->andWhere(['=', 'sir_opalmemberregmst_fk', $regPk])
            ->asArray()->all();
    }

    public static function getLearnersList()
    {
        return StaffinforepoTbl::find()
            ->where(["IN", "sir_type", [2]])
            ->all();
    }

    public static function getAssessorsList()
    {
        return StaffinforepoTbl::find()
            ->select(['staffinforepo_pk as pk', 'sir_name_en as staffname_en', 'sir_name_ar as staffname_ar'])
            ->where(['IN', 'sir_staffrole', [12]])
            ->andWhere(['IN', 'sir_type', [1, 3]])
            ->asArray()->all();
    }


    public static function saveStaffcourmoher($requestdata)
    {
       
        //echo '<pre>';print_r($requestdata);exit;
        $requestdata['staffFormbasc']['staffinforepo_pk'] = $requestdata['stafrep_id'];
        $requestdata['staffFormbasc']['appdtlsPk'] = $requestdata['appdtlsPk'];
        $requestdata['staffFormbasc']['staff_repo'] = $requestdata['staff_repo'];
        $requestdata['staffFormbasc']['document'] = $requestdata['doucumentform'];
        $requestdata['staffFormbasc']['projecttype'] = $requestdata['projecttype'];

        $staffinforpk = StaffinforepoTbl::updateStaffDtls($requestdata['staffFormbasc']);
        //  echo '<pre>';print_r($requestdata['appostaffinfotmp_pk']);exit;

        $model = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $staffinforpk])->one();
     
        //  echo '<pre>';print_r($model);exit;
       
        $cour = "";
        if (!empty($requestdata['selectcourses'])) {
            $cour = implode(',', $requestdata['selectcourses']);
        }

        $model->appsit_appoffercoursetmp_fk = $cour;
        if ($model->save()) {
            //return $model->appsit_staffinforepo_fk;
        } else {
            echo "<pre22>";
            var_dump($model->getErrors());
            exit;
        }

        $modelstf = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $requestdata['stafrep_id']])->one();

        $fle = 0;
        if (is_array($requestdata['filemoher'])) {
            $fle = $requestdata['filemoher'][0];
        } else {
            $fle = $requestdata['filemoher'];
        }

    //    var_dump($requestdata['doucumentform']['file_molEmployment']);exit;
        if($requestdata['projecttype'] == 1){
            $modelstf->sir_moheridoc = $fle;
        }else if($requestdata['projecttype'] == 4){
            $modelstf->sir_moheridoc = $requestdata['doucumentform']['file_molEmployment'];
            $modelstf->sir_civilidfront = $requestdata['doucumentform']['id_card'];
        } 
        if ($modelstf->save()) {
  
            //update status for re submit starts
            $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
            $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlsPk']);
            //update status for re submit ends

            return $model->appsit_staffinforepo_fk;
        } else {
            echo "<pre>";
            var_dump($modelstf->getErrors());
            exit;
        }
    }

    public static function updateWorkexp($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        $modelExp = StaffworkexpTbl::find()->where(['staffworkexp_pk' => $requestdata['staffworkexp_pk']])->one();
        //$modelExp->sexp_staffinforepo_fk = $requestdata['sexp_staffinforepo_fk'];
        $modelExp->sexp_employername = $requestdata['oragn_name'];
       
        if (!empty($requestdata['date_join']) && $requestdata['date_join'] != 'Invalid date') {
            $modelExp->sexp_doj = date("Y-m-d", strtotime($requestdata['date_join']));
        }
      
        $curr_work = 2;
        
        if (!empty($requestdata['curr_work'] )) {
            $curr_work = $requestdata['curr_work'];
            
        }

        if(!empty($requestdata['workdate'])){
            $modelExp->sexp_eod = date("Y-m-d", strtotime($requestdata['workdate']));
        }
        
        $modelExp->sexp_currentlyworking = $curr_work;
        
        $modelExp->sexp_opalcountrymst_fk = $requestdata['employ_country'];
        
        if (!empty($requestdata['employ_state'])) {
            $modelExp->sexp_opalstatemst_fk = $requestdata['employ_state'];
        }
        if (!empty($requestdata['employ_city'])) {
            $modelExp->sexp_opalcitymst_fk = $requestdata['employ_city'];
        }

      
      
        if (!empty($requestdata['file_workexperience'])) {
            $modelExp->sexp_profdocupload = $requestdata['file_workexperience'];
        }
        $modelExp->sexp_designation = $requestdata['designat'];
        //$modelExp->sexp_moheridoc = "test";
        //$modelExp->sexp_appcoursedtlsmain_fk = 1;
        $modelExp->sexp_updatedon = date("Y-m-d H:i:s");
        $modelExp->sexp_updatedby = $requestdata['sexp_createdby'];
  
        if ($modelExp->save()) {
            
            if(!empty($requestdata['learnerwork'])){

            }else{
                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlsPk']);
                //update status for re submit ends
            }
            return $modelExp->staffworkexp_pk;
        } else {
            echo "<pre>";
            var_dump($modelExp->getErrors());
            exit;
        }
    }

    public static function getstaffbas($ipArray)
    {
        //echo '<pre>';print_r($requestdata);exit;
        $model = StaffacademicsTbl::find()
            ->select([
                '*',
                'DATE_FORMAT(sacd_startdate,"%d-%m-%Y") AS start_date',
              
                'DATE_FORMAT(sacd_enddate,"%d-%m-%Y") AS end_date','sacd_enddate AS gradedate',
                'DATE_FORMAT(sacd_createdon,"%d-%m-%Y") AS created_on',
               
                'DATE_FORMAT(sacd_updatedon,"%d-%m-%Y") AS updated_on',
                'rm_name_ar as edulvl_ar','rm_name_en as edulvl_en',
        'mcfd_filetype','memcompfiledtls_pk','mcfd_opalmemberregmst_fk','mcfd_uploadedby'
            ])
            ->leftJoin('referencemst_tbl','referencemst_pk = sacd_edulevel')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sacd_certupload')
            //->leftJoin('staffacademics_tbl stac','stac.sacd_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            //->leftJoin('coursecategorymst_tbl cat','cat.coursecategorymst_pk = appoffercoursetmp_tbl.appoct_coursecategorymst_fk')
            ->where("sacd_staffinforepo_fk =" . $ipArray['stfrepo']);
        //->asArray()
        //->all();

        if ($ipArray['gridsearchValues'] != '') {
            $gridsearchValues = json_decode($ipArray['gridsearchValues'], true);

            $institute = $gridsearchValues['institute'];
            $degree = $gridsearchValues['degree'];
            $year_join = $gridsearchValues['year_join'];
            $year_pass = $gridsearchValues['year_pass'];
            $edu_level_search = $gridsearchValues['edu_level_search'];
            $sacd_grade = $gridsearchValues['sacd_grade'];
            $grade = $gridsearchValues['grade'];
            $add_On = $gridsearchValues['add_On'];
            $Last_Date = $gridsearchValues['Last_Date'];

            if ($institute) {
                $model->andFilterWhere(['AND', ['LIKE', 'sacd_institutename', $institute],]);
            }

            if ($degree) {
                $model->andFilterWhere(['AND', ['LIKE', 'sacd_degorcert', $degree],]);
            }

            // if ($year_join['startDate'] && $year_join['endDate']) {
            //     $model->andFilterWhere(['between', 'date(sacd_startdate)', date('Y-m-d', strtotime($year_join['startDate'])), date('Y-m-d', strtotime($year_join['endDate']))]);
            // }

            if ($year_join) {
                $model->andFilterWhere(['AND', ['IN', 'sacd_edulevel', $year_join],]);
            }

            if ($year_pass['startDate'] && $year_pass['endDate']) {
                $model->andFilterWhere(['between', 'date(sacd_enddate)', date('Y-m-d', strtotime($year_pass['startDate'])), date('Y-m-d', strtotime($year_pass['endDate']))]);
            }

            // if ($edu_level_search && $edu_level_search) {
            //     $model->andFilterWhere(['AND', ['IN', 'sacd_edulevel', $edu_level_search],]);
            // }

            if ($grade) {
                $model->andFilterWhere(['AND', ['LIKE', 'sacd_grade', $grade],]);
            }

            if ($add_On['startDate'] && $add_On['endDate']) {
                $model->andFilterWhere(['between', 'date(sacd_createdon)', date('Y-m-d', strtotime($add_On['startDate'])), date('Y-m-d', strtotime($add_On['endDate']))]);
            }

            if ($Last_Date['startDate'] && $Last_Date['endDate']) {
                $model->andFilterWhere(['between', 'date(sacd_updatedon)', date('Y-m-d', strtotime($Last_Date['startDate'])), date('Y-m-d', strtotime($Last_Date['endDate']))]);
            }
        }
        $sort_column = (strpos($ipArray['sort'], "-") !== false) ? explode("-", $ipArray['sort'])[1] : $ipArray['sort'];
        $order_by = ($ipArray['order'] == 'asc') ? 'asc' : 'desc';
        if($sort_column == 'sacd_createdon' && $order_by == 'asc'){
        $model->orderBy(['DATE_FORMAT(sacd_createdon,"%Y-%m-%d")'=>SORT_ASC]);
        }else if($sort_column == 'sacd_createdon' && $order_by == 'desc'){
        $model->orderBy(['DATE_FORMAT(sacd_createdon,"%Y-%m-%d")'=>SORT_DESC]);
        }else if($sort_column == 'sacd_updatedon' && $order_by == 'asc'){
        $model->orderBy(['DATE_FORMAT(sacd_updatedon,"%Y-%m-%d")'=>SORT_ASC]);
        }else if($sort_column == 'sacd_updatedon' && $order_by == 'desc'){
        $model->orderBy(['DATE_FORMAT(sacd_updatedon,"%Y-%m-%d")'=>SORT_DESC]);
        }else{
        $model->orderBy("$sort_column $order_by");
        }
       // $model->orderBy("$sort_column $order_by");
        $model->asArray();
        $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $page,
                'page' => $ipArray['page']
            ],
        ]);

        $data = $provider->getModels();
        
        foreach($data as $key => $record){
            $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
            $data[$key]['url'] =  $url;
        }
        
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
    }

    public static function getstaffwork($ipArray)
    {

        $model = StaffworkexpTbl::find()
            ->select([
                '*',
                'DATE_FORMAT(sexp_doj,"%d-%m-%Y") AS start_date',
                'DATE_FORMAT(sexp_eod,"%d-%m-%Y") AS end_date',
                'DATE_FORMAT(sexp_createdon,"%d-%m-%Y") AS created_on',
                'DATE_FORMAT(sexp_updatedon,"%d-%m-%Y") AS updated_on',
                'ocym_countryname_en','ocym_countryname_ar','osm_statename_en','osm_statename_ar',
                'ocim_cityname_en','ocim_cityname_ar'
            ])
  			->leftJoin('opalcountrymst_tbl','opalcountrymst_pk = sexp_opalcountrymst_fk')
            ->leftJoin('opalstatemst_tbl','opalstatemst_pk = sexp_opalstatemst_fk')
            ->leftJoin('opalcitymst_tbl','opalcitymst_pk = sexp_opalcitymst_fk')
            //->leftJoin('staffworkexp_tbl stwk','stwk.sexp_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk')
            //->leftJoin('coursecategorymst_tbl cat','cat.coursecategorymst_pk = appoffercoursetmp_tbl.appoct_coursecategorymst_fk')
            ->leftJoin('memcompfiledtls_tbl','memcompfiledtls_pk = sexp_profdocupload')
            ->where("sexp_staffinforepo_fk =" . $ipArray['stfrepo']);


        if ($ipArray['gridsearchValues'] != '') {
            $gridsearchValues = json_decode($ipArray['gridsearchValues'], true);

            $oranisation = $gridsearchValues['oranisation'];
            $date_joined = $gridsearchValues['date_joined'];
            $work_till = $gridsearchValues['work_till'];
            $designation = $gridsearchValues['designation'];
            $add_edOn = $gridsearchValues['add_edOn'];
            $date_last = $gridsearchValues['date_last'];
            $count = $gridsearchValues['count'];
            $gover = $gridsearchValues['gover'];
            $wilaya = $gridsearchValues['wilaya'];

            if ($oranisation) {
                $model->andFilterWhere(['AND', ['LIKE', 'sexp_employername', $oranisation],]);
            }

            if ($date_joined['startDate'] && $date_joined['endDate']) {
                $model->andFilterWhere(['between', 'date(sexp_doj)', date('Y-m-d', strtotime($date_joined['startDate'])), date('Y-m-d', strtotime($date_joined['endDate']))]);
            }

            if ($work_till['startDate'] && $work_till['endDate']) {
                $model->andFilterWhere(['between', 'date(sexp_eod)', date('Y-m-d', strtotime($work_till['startDate'])), date('Y-m-d', strtotime($work_till['endDate']))]);
            }

            if ($count) {
                $model->andFilterWhere(['AND', ['LIKE', 'ocym_countryname_en', $count],]);
            }

            if ($gover) {
                $model->andFilterWhere(['AND', ['LIKE', 'osm_statename_en', $gover],]);
            }

            if ($wilaya) {
                $model->andFilterWhere(['AND', ['LIKE', 'ocim_cityname_en', $wilaya],]);
            }

            if ($designation) {
                $model->andFilterWhere(['AND', ['LIKE', 'sexp_designation', $designation],]);
            }

            if ($add_edOn['startDate'] && $add_edOn['endDate']) {
                $model->andFilterWhere(['between', 'date(sexp_createdon)', date('Y-m-d', strtotime($add_edOn['startDate'])), date('Y-m-d', strtotime($add_edOn['endDate']))]);
            }

            if ($date_last['startDate'] && $date_last['endDate']) {
                $model->andFilterWhere(['between', 'date(sexp_updatedon)', date('Y-m-d', strtotime($date_last['startDate'])), date('Y-m-d', strtotime($date_last['endDate']))]);
            }
        }

        $sort_column = (strpos($ipArray['sort'], "-") !== false) ? explode("-", $ipArray['sort'])[1] : $ipArray['sort'];
        $order_by = ($ipArray['order'] == 'asc') ? 'asc' : 'desc';
        if($sort_column == 'sexp_updatedon' && $order_by == 'asc'){
        $model->orderBy(['DATE_FORMAT(sexp_updatedon,"%Y-%m-%d")'=>SORT_ASC]);
        }else if($sort_column == 'sexp_updatedon' && $order_by == 'desc'){
        $model->orderBy(['DATE_FORMAT(sexp_updatedon,"%Y-%m-%d")'=>SORT_DESC]);
        }else if($sort_column == 'sexp_createdon' && $order_by == 'asc'){
        $model->orderBy(['DATE_FORMAT(sexp_createdon,"%Y-%m-%d")'=>SORT_ASC]);
        }else if($sort_column == 'sexp_createdon' && $order_by == 'desc'){
        $model->orderBy(['DATE_FORMAT(sexp_createdon,"%Y-%m-%d")'=>SORT_DESC]);
        }else{
        $model->orderBy("$sort_column $order_by");
        }
      //  $model->orderBy("$sort_column $order_by");
        $model->asArray();
        $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10;
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $page,
                'page' => $ipArray['page']
            ],
        ]);

        $data = $provider->getModels();
        
        foreach($data as $key => $record){
            $url = \api\components\Drive::generateUrl($record['memcompfiledtls_pk'],$record['mcfd_opalmemberregmst_fk'],$record['mcfd_uploadedby']);
            $data[$key]['workurl'] =  $url;
        }
        
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
    }

    public static function getstaff($ipArray)
    {    

        $model = StaffinforepoTbl::find()
                    ->select(['*',
                                'IF(sir_gender=1,"Male", "Female") AS gender',
                                'DATE_FORMAT(sir_createdon,"%d-%m-%Y") AS created_on',
                                'DATE_FORMAT(sir_updatedon,"%d-%m-%Y") AS updated_on',
                                'DATE_FORMAT(sir_dob,"%d-%m-%Y") AS dob',
                                'DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appdecon',
                                'DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), sir_dob)), "%Y") + 0 AS age'])
                    ->leftJoin('opalcountrymst_tbl con','con.opalcountrymst_pk = staffinforepo_tbl.sir_nationality ')
                    //->leftJoin('referencemst_tbl reft','reft.referencemst_pk = staffinforepo_tbl.sir_contracttype')
                    ->innerJoin('appstaffinfotmp_tbl appstf','appstf.appsit_staffinforepo_fk = staffinforepo_tbl.staffinforepo_pk');
                    if($ipArray['projecttype'] == 4){
                        $model->leftJoin('rolemst_tbl ras','find_in_set(ras.rolemst_pk,appsit_roleforcourse)');

                    }else{
                        $model->leftJoin('rolemst_tbl main','find_in_set(main.rolemst_pk,appsit_mainrole)');

                    }
                    $model->leftJoin('opalusermst_tbl usermst','usermst.opalusermst_pk = appstf.appsit_appdecby')
                    ->leftJoin('referencemst_tbl reft','reft.referencemst_pk = appstf.appsit_contracttype')
                    ->leftJoin('Stafflicensedtls_Tbl','sld_staffinforepo_fk= staffinforepo_tbl.staffinforepo_pk')
                    //"sir_opalmemberregmst_fk" => $ipArray['memRegPk'],
                    ->where([ "appsit_applicationdtlstmp_fk" => $ipArray['appdtlssavetmp_id']]); 
                       

        if($ipArray['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($ipArray['gridsearchValues'],true);  
            
            $civil_numb = $gridsearchValues['civil_numb'];
            $staff_name = $gridsearchValues['staff_name'];
            $email_id = $gridsearchValues['email_id'];
            $gender = $gridsearchValues['gender'];
            $Nation = $gridsearchValues['Nation'];
            $status_cour = $gridsearchValues['status_cour'];
            $main_role = $gridsearchValues['main_role'];
            $inspect_cat = $gridsearchValues['inspect_cat'];
            $cont_type = $gridsearchValues['cont_type'];
            $addd_oncour = $gridsearchValues['addd_oncour'];
            $LastUpdatedcour = $gridsearchValues['LastUpdatedstaff'];
                            
            if($civil_numb){
                $model->andFilterWhere(['AND', ['LIKE', 'sir_idnumber', $civil_numb],]);
            }

            // if($staff_name){
            //     $model->andFilterWhere(['AND', ['LIKE', 'sir_name_en', $staff_name],]);
            // }

            if($email_id){
                $model->andFilterWhere(['AND', ['LIKE', 'sir_emailid', $email_id],]);
            }

            // if($gender){
            //     $model->andFilterWhere(['AND', ['LIKE', 'sir_gender', $gender],]);
            // }

            // if($Nation){
            //     $model->andFilterWhere(['AND', ['LIKE', 'sir_nationality', $Nation],]);
            // }

            if($cont_type){
                $model->andFilterWhere(['AND', ['LIKE', 'appsit_contracttype', $cont_type],]);
            }


            if ($staff_name) {
                $model->andFilterWhere(['AND', ['LIKE', 'sir_name_en', $staff_name],]);
            }

            // if ($email_id) {
            //     $model->andFilterWhere(['AND', ['LIKE', 'sir_emailid', $email_id],]);
            // }

            if ($gender) {
                // $model->andFilterWhere(['AND', ['LIKE', 'sir_gender', $gender],]);                
                $model->andwhere("sir_gender  in (".implode(',',$gender).")");
            }

            if ($Nation) {
                $model->andFilterWhere(['AND', ['LIKE', 'ocym_countryname_en', $Nation],]);
            }

            if ($cont_type) {
                $model->andFilterWhere(['AND', ['LIKE', 'appsit_contracttype', $cont_type],]);
            }

            if ($main_role) {
                $modelApp = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' =>  $ipArray['appdtlssavetmp_id']])->asArray()->one();
                if($modelApp['appdt_projectmst_fk'] == 4){
                    $model->andwhere("ras.rm_rolename_en  like '%".$main_role."%'");
                }else{
                    $model->andwhere("main.rm_rolename_en  like '%".$main_role."%'");
                }
                // $model->orwhere("main.rm_rolename_en  like '%".$main_role."%'");
                //$model->andWhere(new \yii\db\Expression('FIND_IN_SET(:user_find,appsit_mainrole)'));
                //$model->addParams([':user_find' => $main_role]);
            }

            if ($status_cour) {
                $model->andFilterWhere(['AND', ['IN', 'appsit_status', $status_cour],]);
            }
            if (!empty($inspect_cat)) {
                $model->andwhere("appsit_apprasvehinspcattmp_fk  in (".implode(',',$inspect_cat).")");
              
            }
            if ($addd_oncour['startDate'] && $addd_oncour['endDate']) {
                $model->andFilterWhere(['between', 'date(sir_createdon)', date('Y-m-d', strtotime($addd_oncour['startDate'] . " +1 day")), date('Y-m-d', strtotime($addd_oncour['endDate'] . " +1 day"))]);
            }

            if ($LastUpdatedcour['startDate'] && $LastUpdatedcour['endDate']) {
                $model->andFilterWhere(['between', 'date(sir_updatedon)', date('Y-m-d', strtotime($LastUpdatedcour['startDate'] . " +1 day")), date('Y-m-d', strtotime($LastUpdatedcour['endDate'] . " +1 day"))]);
            }
        }
        $sort_column = (strpos($ipArray['sort'], "-") !== false) ? explode("-", $ipArray['sort'])[1] : $ipArray['sort'];
        $order_by = ($ipArray['order'] == 'asc') ? 'asc' : 'desc';
        $model->groupBy('staffinforepo_pk');
        $model->orderBy("$sort_column $order_by");
        $model->asArray();
    //    $a =  $model->createCommand()->getRawSql();
        // echo $a;exit;
        $page = (!empty($ipArray['size']) && $ipArray['size'] != 'undefined') ? $ipArray['size'] : 10;
        // $page =10;

        //to check staff data exist in main table or not
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $page,
                'page' => $ipArray['page']
            ],
        ]);

        $data = $provider->getModels();
        //->asArray()
        //->all();
  
        $resAry = array();
        $finalAry = array();
        if (!empty($data)) {
            foreach ($data as $courInfo) {
//                 print_r($ipArray['projecttype']);
// print_r($courInfo);exit;
                $resAry = $courInfo;


                $staffmodeldata     =   \app\models\AppstaffinfomainTbl::find()->where("appsim_AppStaffInfotmp_FK =:pk", [':pk' => $courInfo['appostaffinfotmp_pk']])->one();
                $resAry['approval'] = ($staffmodeldata)?1:0;

                //$resAry['courRole']= AppoffercourseunittmpTbl::find()->where(['appocut_appoffercoursetmp_fk'=>$courInfo['sir_staffrole']])->asArray()->all();
                if($ipArray['projecttype'] == 1){
                    $crVal = $courInfo['appsit_mainrole'];
                }elseif($ipArray['projecttype'] == 4){
                    $crVal = $courInfo['appsit_roleforcourse'];
                }
                if (!empty($crVal)) {
                    $courTstRes = \Yii::$app->db->createCommand("SELECT * from rolemst_tbl where rolemst_pk IN ($crVal)")->queryAll();
                    $ctStr = $ctStrVal = $ctStrAr = $ctStrValAr = array();
                    if (!empty($courTstRes)) {
                        foreach ($courTstRes as $courTstVal) {
                            //$ctStr['crEn']=$courTstVal['rm_rolename_en'];
                            $ctStrVal[] = $courTstVal['rm_rolename_en'];

                            //$ctStrAr['crAr']=$courTstVal['rm_name_ar'];
                            $ctStrValAr[] = $courTstVal['rm_rolename_ar'];
                        }
                        $resAry['roleEn'] = implode(",", $ctStrVal);
                        $resAry['roleAr'] = implode(",", $ctStrValAr);
                    }
                }
                $rascat =  $courInfo['appsit_apprasvehinspcattmp_fk'];
                if (!empty($rascat)) {
                    // $courTstRes = \Yii::$app->db->createCommand("SELECT * from rolemst_tbl where rolemst_pk IN ($crVal)")->queryAll();
                    $courTstRes =   \app\models\ApprasvehinspcattmpTbl::find()  
                    ->select(['apprasvehinspcattmp_pk','rascategorymst_pk','rcm_coursesubcatname_ar','rcm_coursesubcatname_en','arvict_status','DATE_FORMAT(arvict_createdon,"%d-%m-%Y") as  inspectcreatedon','DATE_FORMAT(arvict_updatedon,"%d-%m-%Y") as  inspectlastupdate'])
                    ->leftJoin('rascategorymst_tbl','rascategorymst_pk = arvict_rascategorymst_fk')
                    ->where('apprasvehinspcattmp_pk in ('.$rascat.')')->asArray()->all();
                    $ctStr = $ctStrVal = $ctStrAr = $ctStrValAr = array();
                    if (!empty($courTstRes)) {
                        foreach ($courTstRes as $courTstVal) {
                            //$ctStr['crEn']=$courTstVal['rm_rolename_en'];
                            $ctStrVal[] = $courTstVal['rcm_coursesubcatname_en'];

                            //$ctStrAr['crAr']=$courTstVal['rm_name_ar'];
                            $ctStrValAr[] = $courTstVal['rcm_coursesubcatname_ar'];
                            $rascatmst[] = $courTstVal['rascategorymst_pk'];
                        }
                        $resAry['rcm_coursesubcatname_en'] = implode(",", $ctStrVal);
                        $resAry['rcm_coursesubcatname_ar'] = implode(",", $ctStrValAr);
                    }
                 
                    $comptcard = AppstaffinfotmpTbl::find()
                    ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1'
                    when appsit_iscarddetails = 1  then '4'  when appsit_iscarddetails = 3  then '4' 
                    when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                    ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                    ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                    $comptcard->andWhere(['appostaffinfotmp_pk'=>$courInfo['appostaffinfotmp_pk']]);
                    $comptcard->andWhere('sccd_rascategorymst_fk in('.implode(",",$rascatmst).')');
                    $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                    $compt =  $comptcard->asArray()->one();
                    $comptancycard = empty($compt['competcard'])?'1':$compt['competcard'];
                    $resAry['comptancycard'] = $comptancycard;
                }
                $finalAry[] = $resAry;
            }
        }
        $response = array();
        $response['data'] = $finalAry;
       
        $response['totalcount'] =count($finalAry);
        $response['size'] = $page;
        return $response;
    }


    public static function updateStaff($requestdata)
    {
        //echo '<pre>';print_r($requestdata);exit;
        //$model = new StaffinforepoTbl();
        $model = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $requestdata['staffinforepo_pk']])->one();
        if($model['sir_type'] == 2){
            $model->sir_type = 3;
        }else{
            $model->sir_type = 1;
        }

       
        //$model->sir_opalmemberregmst_fk = $requestdata['sir_opalmemberregmst_fk'];
      //  $model->sir_type = 1;
        //$model->sir_idnumber = $requestdata['civil_num'];
        $model->sir_name_en = $requestdata['staffeng'];
        $model->sir_name_ar = $requestdata['staffarab'];
        $model->sir_emailid = $requestdata['email_id'];
        $model->sir_dob = date("Y-m-d", strtotime($requestdata['date_birth']));
        $model->sir_gender = $requestdata['gend_er'];
        $model->sir_nationality = $requestdata['national'];

        // $role = "";
        // if(!empty($requestdata['role'])){
        //     $role = implode(',', $requestdata['role']);
        // }
        // $model->sir_staffrole = $role;

        //$model->sir_jobtitle = $requestdata['job_title'];
        // $model->sir_contracttype = $requestdata['cont_type'];
        $model->sir_addrline1 = $requestdata['house'];
        $model->sir_addrline2 = $requestdata['houseadd'];
        $model->sir_opalstatemst_fk = $requestdata['state'];
        $model->sir_opalcitymst_fk = $requestdata['city'];
        $model->sir_updatedon = date("Y-m-d H:i:s");
        $model->sir_updatedby = $requestdata['sir_createdby'];


        if ($model->save()) {
          // empty staff temif
          if(empty($requestdata['appostaffinfotmp_pk'])){
                $modelInsObj = AppinstinfotmpTbl::find()
                ->select(['appinstinfotmp_pk'])
                ->where("appiit_applicationdtlstmp_fk =" . $requestdata['appdtlstmp_id'])->one();
                //echo '<pre>';print_r($requestdata);exit;
                $modelAcc = new AppstaffinfotmpTbl();
                $modelAcc->appsit_opalmemberregmst_fk = $requestdata['sir_opalmemberregmst_fk'];
                $modelAcc->appsit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
                $modelAcc->appsit_appinstinfotmp_fk = $modelInsObj->appinstinfotmp_pk;
                $modelAcc->appsit_staffinforepo_fk = $model->staffinforepo_pk;
                $modelAcc->appsit_emailid = $requestdata['email_id'];

                $role = "";
                if (!empty($requestdata['role'])) {
                $role = implode(',', $requestdata['role']);
                }
                if($requestdata['projecttype'] == 1){
                    $modelAcc->appsit_mainrole = $role;
                    }else if($requestdata['projecttype'] == 4){
                    $modelAcc->appsit_roleforcourse = $role;
                    $modelAcc->appsit_apprasvehinspcattmp_fk = implode(',', $requestdata['inspect_Vtype']);

                    }
                $modelAcc->appsit_jobtitle = $requestdata['job_title'];
                $modelAcc->appsit_contracttype = $requestdata['cont_type'];
                $modelAcc->appsit_status = 1;
                $modelAcc->appsit_createdon = date("Y-m-d H:i:s");
                $modelAcc->appsit_createdby = $requestdata['sir_createdby'];
                //echo '<pre>';print_r($modelAcc);exit;
                if ($modelAcc->save()) {
                } else {
                echo "<pre>";
                var_dump($modelAcc->getErrors());
                exit;
                }

                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlstmp_id']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlstmp_id']);
                //update status for re submit ends

                return $model->staffinforepo_pk;
               // when staffinfotempt  end 


            }else{

         

            $resSts =  StaffinforepoTbl::changeStatus($requestdata['appostaffinfotmp_pk']);

            $modelInsObj = AppinstinfotmpTbl::find()
                ->select(['appinstinfotmp_pk'])
                ->where("appiit_applicationdtlstmp_fk =" . $requestdata['appdtlstmp_id'])->one();

            $modelAcc = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $requestdata['appostaffinfotmp_pk']])->one();

            $modelAcc->appsit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];

            $role = "";
            if (!empty($requestdata['role'])) {
                $role = implode(',', $requestdata['role']);
            }
            if($requestdata['projecttype'] == 1){
                $modelAcc->appsit_mainrole = $role;
                }else if($requestdata['projecttype'] == 4){
                $modelAcc->appsit_roleforcourse = $role;
                $modelAcc->appsit_apprasvehinspcattmp_fk = implode(',', $requestdata['inspect_Vtype']);
                }
            $modelAcc->appsit_jobtitle = $requestdata['job_title'];
            $modelAcc->appsit_contracttype = $requestdata['cont_type'];
            if (!empty($resSts)) {
                $modelAcc->appsit_status = 2;
                //$modelAcc->appsit_appdeccomment = "";
            }
            $modelAcc->appsit_updatedon = date("Y-m-d H:i:s");
            $modelAcc->appsit_updatedby = $requestdata['sir_createdby'];
            if ($modelAcc->save()) {
            } else {
                echo "<pre>";
                var_dump($modelAcc->getErrors());
                exit;
            }
            return $model->staffinforepo_pk;
          }
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public static function updateStaffDtls($requestdata)
    {
        // echo '<pre>';print_r($requestdata);exit;
        $model = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $requestdata['staffinforepo_pk']])->one();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        if($model['sir_type'] == 2){
            $model->sir_type = 3;
        }else{
            $model->sir_type = 1;
        }


        $model->sir_name_en = $requestdata['staffeng'];
        $model->sir_name_ar = $requestdata['staffarab'];
        $model->sir_emailid = $requestdata['email_id'];
        $model->sir_dob = date("Y-m-d", strtotime($requestdata['date_birth']));
        $model->sir_gender = $requestdata['gend_er'];
        $model->sir_nationality = $requestdata['national'];
        $model->sir_addrline1 = $requestdata['house'];
        $model->sir_addrline2 = $requestdata['houseadd'];
        $model->sir_opalstatemst_fk = $requestdata['state'];
        $model->sir_opalcitymst_fk = $requestdata['city'];
        $model->sir_updatedon = date("Y-m-d H:i:s");
        $model->sir_updatedby = $userPk;

        if ($model->save()) {
              
            if(empty($requestdata['appostaffinfotmp_pk']) && empty($requestdata['staff_repo'])){
                $modelInsObj = AppinstinfotmpTbl::find()
                ->select(['appinstinfotmp_pk' , 'appiit_opalmemberregmst_fk'])
                ->where("appiit_applicationdtlstmp_fk =" . $requestdata['appdtlsPk'])->one();

                $modelAcc = new AppstaffinfotmpTbl();
                $modelAcc->appsit_opalmemberregmst_fk = $modelInsObj->appiit_opalmemberregmst_fk;
                $modelAcc->appsit_applicationdtlstmp_fk = $requestdata['appdtlsPk'];
                $modelAcc->appsit_appinstinfotmp_fk = $modelInsObj->appinstinfotmp_pk;
                $modelAcc->appsit_staffinforepo_fk = $model->staffinforepo_pk;
                $modelAcc->appsit_emailid = $requestdata['email_id'];
    
                $role = "";
                if (!empty($requestdata['role'])) {
                $role = implode(',', $requestdata['role']);
                }

                if($requestdata['projecttype'] == 1){
                    $modelAcc->appsit_mainrole = $role;
                }else if($requestdata['projecttype'] == 4){
                    $modelAcc->appsit_roleforcourse = $role;
                    $modelAcc->appsit_apprasvehinspcattmp_fk = implode(',', $requestdata['inspect_Vtype']);
                }
    
                $modelAcc->appsit_jobtitle = $requestdata['job_title'];
                $modelAcc->appsit_contracttype = $requestdata['cont_type'];
                $modelAcc->appsit_status = 1;
                $modelAcc->appsit_createdon = date("Y-m-d H:i:s");
                $modelAcc->appsit_createdby = $userPk;
                //echo '<pre>';print_r($modelAcc);exit;
                if ($modelAcc->save()) {
                    $requestdata['appostaffinfotmp_pk'] = $modelAcc->appostaffinfotmp_pk;
                } else {
                echo "<pre>";
                var_dump($modelAcc->getErrors());
                exit;
                }
              
                $roplicence = StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk'=>$requestdata['staffinforepo_pk']])->one();
               
                if(!empty($roplicence)){
                    $roplicence->sld_staffinforepo_fk = $requestdata['staffinforepo_pk'];
                    $roplicence->sld_hasROPheavylicense = 2;
                    $roplicence->sld_hasROPlightlicense = 2;
                    $roplicence->sld_ROPlicenseupload =  $requestdata['document']['file_ropLicense'];
                    $roplicence->sld_updatedon = date("Y-m-d H:i:s");
                    $roplicence->sld_updatedby = $userPk;
                }else{
                    $roplicence = new StafflicensedtlsTbl();
                    $roplicence->sld_staffinforepo_fk = $requestdata['staffinforepo_pk'];
                    $roplicence->sld_hasROPheavylicense = 2;
                    $roplicence->sld_hasROPlightlicense = 2;
                    $roplicence->sld_ROPlicenseupload =  $requestdata['document']['file_ropLicense'];
                    $roplicence->sld_createdon = date("Y-m-d H:i:s");
                    $roplicence->sld_createdby = $userPk;
                }
                if (!$roplicence->save()) {
                    echo "<pre>";
                    var_dump($roplicence->getErrors());
                    exit;
                } 
               
                //update status for re submit starts
                $resStsApp = \app\models\AppoffercoursetmpTbl::checkStatusAppTmp($requestdata['appdtlsPk']);
                $resStsAppUpdate = \app\models\AppoffercoursetmpTbl::updateResbmtAppTmp($resStsApp['appdt_status'], $requestdata['appdtlsPk']);
                //update status for re submit ends
               // return $model->staffinforepo_pk;
              

            }
            $roplicence = StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk'=>$requestdata['staffinforepo_pk']])->one();
               
            if(!empty($roplicence)){
                $roplicence->sld_staffinforepo_fk = $requestdata['staffinforepo_pk'];
                $roplicence->sld_hasROPheavylicense = 2;
                $roplicence->sld_hasROPlightlicense = 2;
                $roplicence->sld_ROPlicenseupload =  $requestdata['document']['file_ropLicense'];
                $roplicence->sld_updatedon = date("Y-m-d H:i:s");
                $roplicence->sld_updatedby = $userPk;
            }else{
                $roplicence = new StafflicensedtlsTbl();
                $roplicence->sld_staffinforepo_fk = $requestdata['staffinforepo_pk'];
                $roplicence->sld_hasROPheavylicense = 2;
                $roplicence->sld_hasROPlightlicense = 2;
                $roplicence->sld_ROPlicenseupload =  $requestdata['document']['file_ropLicense'];
                $roplicence->sld_createdon = date("Y-m-d H:i:s");
                $roplicence->sld_createdby = $userPk;
            }
            if (!$roplicence->save()) {
                echo "<pre>";
                var_dump($roplicence->getErrors());
                exit;
            } 
            $modelAccDtls = AppstaffinfotmpTbl::find()->where(['appsit_staffinforepo_fk' => $requestdata['staffinforepo_pk']])->orderBy(['appostaffinfotmp_pk' => SORT_DESC])->one();
      
            $resSts =  StaffinforepoTbl::changeStatus($modelAccDtls->appostaffinfotmp_pk);

       

            $modelInsObj = AppinstinfotmpTbl::find()
                ->select(['appinstinfotmp_pk'])
                ->where("appiit_applicationdtlstmp_fk =" . $modelAccDtls->appsit_applicationdtlstmp_fk)->one();

                $appliactiondata = ApplicationdtlstmpTbl::find()
                ->where('applicationdtlstmp_pk = '. $modelAccDtls->appsit_applicationdtlstmp_fk)->asArray()->one();
            $modelAcc = AppstaffinfotmpTbl::find()->where(['appostaffinfotmp_pk' => $modelAccDtls->appostaffinfotmp_pk])->one();

            $modelAcc->appsit_applicationdtlstmp_fk = $modelAccDtls->appsit_applicationdtlstmp_fk;

            $role = "";
            if (!empty($requestdata['role'])) {
                $role = implode(',', $requestdata['role']);
            }
            if($requestdata['projecttype'] == 1){
                $modelAcc->appsit_mainrole = $role;
            }else if($requestdata['projecttype'] == 4){
                $role_new = $requestdata['inspect_Vtype'];
                $role_curr = explode(",",$modelAcc->appsit_apprasvehinspcattmp_fk);
                $diff_role = array_diff($role_new, $role_curr);

                $comptcard = AppstaffinfotmpTbl::find()
                ->select(["(case  when appsit_iscarddetails = 2 and staffcompetencycarddtls_pk is null then '1'
                when appsit_iscarddetails = 1 then '4' 
                when sccd_status =1 then '2'  when sccd_status =2 then '3'  end) as competcard"])
                ->leftJoin('staffcompetencycardhdr_tbl','scch_staffinforepo_fk = appsit_staffinforepo_fk')
                ->leftJoin('staffcompetencycarddtls_tbl','sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk');
                $comptcard->andWhere(['appostaffinfotmp_pk'=>$modelAccDtls->appostaffinfotmp_pk]);
                $comptcard->andWhere('sccd_rascategorymst_fk in('.implode(",",$role_new).')');
                $comptcard->orderBy(['staffcompetencycardhdr_pk' => SORT_DESC]);
                $compt =  $comptcard->asArray()->one();
                $comptancycard = empty($compt['competcard'])?'1':$compt['competcard'];
                
                $rolenew = $requestdata['role'];
                $roleexists =  explode(",",$modelAcc->appsit_roleforcourse);
                $diff_rolees = array_diff($rolenew, $roleexists);
                if ((!empty($diff_role) || !empty($diff_rolees)) && $appliactiondata['appdt_status'] != 1) {
                    $modelAcc->appsit_iscarddetails = 1;
                }elseif($comptancycard == 3){
                    $modelAcc->appsit_iscarddetails = 3;
                }
                $modelAcc->appsit_roleforcourse = $role;
                $modelAcc->appsit_apprasvehinspcattmp_fk = implode(',', $requestdata['inspect_Vtype']);
               

            }

            $modelAcc->appsit_jobtitle = $requestdata['job_title'];
            $modelAcc->appsit_contracttype = $requestdata['cont_type'];
            if (!empty($resSts)) {
                $modelAcc->appsit_status = 2;
                $modelAcc->appsit_appdeccomment = "";
                $modelAcc->appsit_updatedon = date("Y-m-d H:i:s");
                $modelAcc->appsit_updatedby = $userPk;
            }
          
            if ($modelAcc->save()) {
            } else {
                echo "<pre>";
                var_dump($modelAcc->getErrors());
                exit;
            }

            $appstafftmppk=$modelAcc->appostaffinfotmp_pk;
            $repopk=$requestdata['staffinforepo_pk'];
       
            $vehilepk= $requestdata['inspect_Vtype'];

            foreach ($vehilepk as $test){
                $sample = $test;
            }

           
         
            self::staffevaluation($appstafftmppk,$repopk,$vehilepk);
            return $modelAcc->appostaffinfotmp_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    public function staffevaluation($appstafftmppk,$repopk,$vehilepk){
        $vehilepk = implode(',', $vehilepk);
        if(!empty($vehilepk)){
        $categroymstpk  = ApprasvehinspcattmpTbl::find()->select(['arvict_rascategorymst_fk'])->where('apprasvehinspcattmp_pk in('.$vehilepk.')')->asArray()->all();
        }
        if(!empty( $categroymstpk)){

        foreach($categroymstpk as $pk){;
            $evaluations = StaffevaluationtmpTbl::find()->where(['set_staffinforepo_fk'=>$repopk,'set_rascategorymst_fk'=>$pk['arvict_rascategorymst_fk']])->asArray()->all();
            if(!empty( $evaluations)){
                foreach($evaluations as $eve){
                $evaluation = StaffevaluationtmpTbl::find()->where(['staffevaluationtmp_pk'=>$eve['staffevaluationtmp_pk']])->one();
                $evaluation->set_appstaffinfotmp_fk = $appstafftmppk;
                if(!$evaluation->save()){
                    // return $evaluation->getErrors();
                }
            }
            }
        }
        }

         return true;
    }

     
    public static function changeStatus($appDtlsPk)
    {
        $model = AppstaffinfotmpTbl::find()
            ->select(['appsit_status'])
            ->where("appostaffinfotmp_pk = $appDtlsPk")
            ->andWhere("appsit_status = 2 OR appsit_status = 3 OR appsit_status = 4")
            ->asArray()
            ->one();
            

        if (!empty($model)) {
            return true;
        } else {
            return false;
        }
    }

    public static function registerlearnerfinal($requestdatadtls){
        
        //$requestdata;
        $validation_status = '';
        $requestdata = $requestdatadtls->form;
        $requestdata->learner_fee = $requestdatadtls->learner_fee;
        $requestdata->learner_fee_status = $requestdatadtls->learner_fee_status;
        $requestdata->paid_by = $requestdatadtls->paid_by;
        $requestdata->total_year = $requestdatadtls->total_year;
        $requestdata->company_name = $requestdatadtls->company_name;
        $requestdata->learnerreghrddtls_pk = $requestdatadtls->learnerreghrddtls_pk;
        $requestdata->staff_repo = $requestdatadtls->staff_repo;

        $regPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $lnrrcard_exp_before = \Yii::$app->params['learnercard_expiry_days']['before'];
        $lnrrcard_exp_after = \Yii::$app->params['learnercard_expiry_days']['after'];

        //echo '<pre>';print_r($requestdata);exit;
        //////////////////////////////////////////
        if(!empty($requestdata->finalsave)){
            $staffObj = StaffinforepoTbl::find()
                    ->select(['*'])
                    ->where(['sir_idnumber' => $requestdata->sir_idnumber])->one();
                    //->where("sir_idnumber ='$requestdata->sir_idnumber'.")->one();
            
            //check age limit starts
            $modelBatchRes = BatchmgmtdtlsTbl::find()->select(['*'])
                            ->leftJoin('standardcoursedtls_tbl std','std.standardcoursedtls_pk = batchmgmtdtls_tbl.bmd_standardcoursedtls_fk')
                            ->where(['batchmgmtdtls_pk' => $requestdata->batchmgmtdtls])
                            ->asArray()
                            ->one();
            
            //$requestdata->age = 20;
            if(!empty($modelBatchRes)){
                if($modelBatchRes['scd_hasagelimit'] == '1'){
                    if($modelBatchRes['scd_agelimit'] > $requestdata->age){
                        return "age_limit";
                        exit;
                    }
                }

                if($modelBatchRes['bmd_status'] != '1'){
                    return "batch_notnew";
                    exit;
                }
            }
            //check age limit Ends
            
            

            
            
            //check standard course Card Starts
            $modelStdRes = LearnercarddtlsTbl::find()->select(['*'])
                            ->where(['lcd_standardcoursemst_fk' => $modelBatchRes['bmd_standardcoursedtls_fk']])
                            ->asArray()
                            ->one();
            $stdRes = StandardcoursedtlsTbl::find()->select(['*'])
                            ->where(['standardcoursedtls_pk' => $modelBatchRes['bmd_standardcoursedtls_fk']])
                            ->asArray()
                            ->one();
            
            if(!empty($stdRes)){
                if(!empty($stdRes['scd_prerequesit'])){
                    $stdArray = explode(",", $stdRes['scd_prerequesit']);
                    foreach($stdArray as $stdDtls){
                        $stdResData = LearnercarddtlsTbl::find()->select(['*'])
                            ->where(['lcd_standardcoursedtls_fk' => $stdDtls])
                            ->andWhere(['lcd_status' => '1'])
                            ->asArray()
                            ->one();
                        if(empty($stdResData)){
                            // return "card_limit";
                            // exit;
                        }
                    }
                }
            }
            //check standard course Card Ends

            //check Civil no Validation Starts Here
            $dataStaff = StaffinforepoTbl::find()
                ->select(['*'])
                ->innerJoin('learnerreghrddtls_tbl','learnerreghrddtls_tbl.lrhd_staffinforepo_fk=staffinforepo_pk')
                ->innerJoin('batchmgmtdtls_tbl','batchmgmtdtls_tbl.batchmgmtdtls_pk=learnerreghrddtls_tbl.lrhd_batchmgmtdtls_fk')
                ->leftJoin('referencemst_tbl','referencemst_tbl.referencemst_pk=batchmgmtdtls_tbl.bmd_batchtype')
                ->Where(['sir_idnumber' => $requestdata->sir_idnumber])
                ->andWhere(['bmd_standardcoursedtls_fk' => $requestdata->cour])
                ->orderBy(['learnerreghrddtls_pk' => SORT_DESC])
                ->asArray()
                ->one();

            $dataBatch = BatchmgmtdtlsTbl::find()
            ->select(['*'])
            ->Where(['bmd_Batchno' => $requestdata->batchno])
            ->asArray()
            ->one();
            
            if($dataBatch['bmd_standardcoursedtls_fk'] == $dataStaff['bmd_standardcoursedtls_fk']){
                if(!empty($dataStaff)){
                    if($dataStaff['lrhd_status'] == 1 
                        || $dataStaff['lrhd_status'] == 2 
                        || $dataStaff['lrhd_status'] == 3
                        || $dataStaff['lrhd_status'] == 4
                        || $dataStaff['lrhd_status'] == 5
                        || $dataStaff['lrhd_status'] == 6
                        || $dataStaff['lrhd_status'] == 7
                        || $dataStaff['lrhd_status'] == 8
                        || $dataStaff['lrhd_status'] == 9
                        || $dataStaff['lrhd_status'] == 12){
                            if($dataStaff['bmd_status'] < 7){
                                $validation_status = 1; // Already In Some Batch
                            }
                    }
                    
                    if($dataStaff['lrhd_status'] == 10 || $dataStaff['lrhd_status'] == 11){
                    
                        $lerCard = LearnercarddtlsTbl::find()
                                        ->select(['*'])
                                        ->Where(['lcd_staffinforepo_fk' => $dataStaff['staffinforepo_pk']])
                                        ->andWhere(['lcd_batchmgmtdtls_fk' => $dataStaff['batchmgmtdtls_pk']])
                                        ->andWhere(['lcd_learnerreghrddtls_fk' => $dataStaff['learnerreghrddtls_pk']])
                                        ->andWhere(['lcd_standardcoursedtls_fk' => $requestdata->cour])
                                        ->orderBy(['learnercarddtls_pk' => SORT_DESC])
                                        ->asArray()
                                        ->one();
    
                        $bthAssmt = BatchmgmtasmthdrTbl::find()
                                        ->select(['*'])
                                        ->Where(['bmah_batchmgmtdtls_fk' => $dataBatch['batchmgmtdtls_pk']])
                                        ->orderBy(['batchmgmtasmthdr_pk' => SORT_DESC])
                                        ->asArray()
                                        ->one();
    
                        $today = $bthAssmt['bmah_assessmentdate'];
                        $futureDate = $lerCard['lcd_cardexpiry'];
                        $difference = strtotime($today) - strtotime($futureDate);
                        $days = $difference/(60 * 60)/24;
                        $expired_date =$days;
                        
                        
                        if($dataStaff['bmd_status'] == 8){
                            //if($dataStaff['bmd_batchtype'] == $dataBatch['bmd_batchtype']){
                                if($expired_date < $lnrrcard_exp_before){ // 31
                                    if($dataBatch['bmd_batchtype'] == 24){
                                        $validation_status = 2;
                                        $batch_type = 3;
                                    } else if($dataBatch['bmd_batchtype'] == 25){
                                        $validation_status = '';
                                        $batch_type = '';
                                    }
                                }
                                
                                if($expired_date > $lnrrcard_exp_after){ // 30
                                    // $validation_status = 2;
                                    // $batch_type = 4;
                                    if($dataBatch['bmd_batchtype'] == 24){
                                        $validation_status ='';
                                        $batch_type = '';
                                    } else if($dataBatch['bmd_batchtype'] == 25){
                                        $validation_status = 2;
                                        $batch_type = 4;
                                    }
                                }
                            //}
    
                            // if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                                
                            //     if($expired_date < 31){
                            //         if($dataBatch['bmd_batchtype'] == 24){
                            //             $validation_status = '';
                            //             $batch_type = '';
                            //         } else if($dataBatch['bmd_batchtype'] == 25){
                            //             $validation_status = '';
                            //         }
                            //     }
    
                            //     if($expired_date > 31){
                            //         if($dataBatch['bmd_batchtype'] == 24){
                            //             $validation_status = 2;
                            //             $batch_type = 3;
                            //         } else if($dataBatch['bmd_batchtype'] == 25){
                            //             $validation_status = 2;
                            //             $batch_type = 4;
                            //         }
                            //     }
                            // }
                        } 
                    }
    
                    
    
                    if($dataStaff['lrhd_status'] == 12){
                        if($dataStaff['bmd_status'] == 8){
                            if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                                //$validation_status = 3; // Allowed Only Ini Cancel mean Ini/Ref canl mean Ref
                                if($dataStaff['bmd_batchtype'] == 24){
                                    $validation_status = 3;
                                    $batch_type = 1;
                                } else if($dataStaff['bmd_batchtype'] == 25){
                                    $validation_status = 3;
                                    $batch_type = 2;
                                }
                            }
                        }
                    }
    
                
                    if($dataStaff['lrhd_status'] == 13){
                            if($dataStaff['bmd_batchtype'] != $dataBatch['bmd_batchtype']){
                                //$validation_status = 3; // Allowed Only Ini Cancel mean Ini/Ref canl mean Ref
                                if($dataStaff['bmd_batchtype'] == 24){
                                    $validation_status = 3;
                                    $batch_type = 1;
                                } else if($dataStaff['bmd_batchtype'] == 25){
                                    $validation_status = 3;
                                    $batch_type = 2;
                                }
                            }
                    }

                }

                if(!empty($requestdata->sir_idnumber)){
                    $response = [
                        'status' => 1, 'valstatus' => $validation_status, 'batch_type' => $batch_type, 'lnrrcard_exp_days' => $lnrrcard_exp_after, 'data' => $data, 'dataStaff' => $dataStaff, 'msg' => 'Success',
                    ];
                    if(!empty($validation_status)){
                        return $response;
                        exit;
                    }
                    
                }else{
                    $response = [
                        'status' => 1, 'valstatus' => '', 'batch_type' => '', 'data' => '', 'dataStaff' => '', 'msg' => 'Success',
                    ];
                }
                
            }else{
                if(!empty($requestdata->sir_idnumber) && empty($dataStaff) && $dataBatch['bmd_batchtype'] == 25){//new learner adding to refresher batch
                    $validation_status = 5;
                    $response = [
                        'status' => 1, 'valstatus' => $validation_status, 'batch_type' => $batch_type, 'lnrrcard_exp_days' => $lnrrcard_exp_after, 'data' => $data, 'dataStaff' => $dataStaff, 'msg' => 'Success',
                    ];
                    return $response;
                    exit;
                }
            }
            //check Civil no Validation Ends Here

                $type="2";
                if(!empty($staffObj)){
                    $staffinforepo = $staffObj->staffinforepo_pk;
                    $opalmemberregmst = $staffObj->sir_opalmemberregmst_fk;
                    $emailid = $staffObj->sir_emailid;
                    if($staffObj->sir_type == '1'){
                        $type="3";
                        $model = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $staffObj->staffinforepo_pk])->one();
                        $model->sir_type = $type;
                        $model->save();
                    }else{
                        
                        $lerRes = LearnerreghrddtlsTbl::find()
                                                        ->where(['lrhd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls])
                                                        ->andWhere(['lrhd_staffinforepo_fk' => $staffObj->staffinforepo_pk])->all();
                        
                        $query1Res =   \Yii::$app->db->createCommand("SELECT bmd_standardcoursedtls_fk FROM batchmgmtdtls_tbl join learnerreghrddtls_tbl on batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk where lrhd_staffinforepo_fk = $staffObj->staffinforepo_pk and batchmgmtdtls_pk = $requestdata->batchmgmtdtls")
                                            ->queryAll();

                        $query2Res =   \Yii::$app->db->createCommand("SELECT bmd_standardcoursedtls_fk FROM batchmgmtdtls_tbl join learnerreghrddtls_tbl on batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk where lrhd_staffinforepo_fk = $staffObj->staffinforepo_pk and batchmgmtdtls_pk = $requestdata->batchmgmtdtls and bmd_status not in ('7')")
                                            ->queryAll();
                                        
                        $array2 = array();
                        foreach($query2Res as $query2Info){
                            $array2[] = $query2Info['bmd_standardcoursedtls_fk'];
                            
                        }

                        if(!empty($query1Res) && !empty($query2Res)){
                            // if (in_array($query1Res[0]['bmd_standardcoursedtls_fk'], $array2)){
                            //     return "same_course";
                            //     exit;
                            // } else {  
                            // }
                        } else {
                        }  
                    }  
                }else{    
                }

                    
                    $modelStfRepo = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $staffinforepo])->one();
                    $modelStfRepo->sir_idnumber = str_replace(' ', '', $requestdata->sir_idnumber);
                    $modelStfRepo->sir_name_en = $requestdata->sir_name_en;
                    $modelStfRepo->sir_name_ar = $requestdata->sir_name_ar;
                    $modelStfRepo->sir_emailid = $requestdata->sir_emailid;
                    $modelStfRepo->sir_dob = $requestdata->sir_dob;
                    $modelStfRepo->sir_gender = $requestdata->sir_gender;
                    $modelStfRepo->sir_nationality = $requestdata->sir_nationality;
                    $modelStfRepo->sir_photo = $requestdata->sir_photo[0];
                    $modelStfRepo->sir_mobnum = $requestdata->mnumber;
                    $modelStfRepo->sir_altmobnum = $requestdata->mnumber2;
                    if(is_array($requestdata->sir_civilidfront)){
                        if(count($requestdata->sir_civilidfront) > 1){
                            $modelStfRepo->sir_civilidfront = $requestdata->sir_civilidfront[0];
                            $modelStfRepo->sir_civilidback = $requestdata->sir_civilidfront[1];
                        }else{
                            $modelStfRepo->sir_civilidfront = $requestdata->sir_civilidfront[0];
                        }
                    }else{
                        $modelStfRepo->sir_civilidfront = "";
                    }

                    $modelStfRepo->sir_addrline1 = $requestdata->sir_addrline1;
                    $modelStfRepo->sir_addrline2 = $requestdata->sir_addrline2;
                    $modelStfRepo->sir_opalstatemst_fk = $requestdata->state;
                    $modelStfRepo->sir_opalcitymst_fk = $requestdata->city;
                    $modelStfRepo->sir_createdon = date("Y-m-d H:i:s");
                    $modelStfRepo->sir_createdby = $userPk;
                    if(!$modelStfRepo->save()){
                        echo "<pre>";var_dump($modelStfRepo->getErrors());exit;
                    }

                
                $modelStfLc = StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk' => $staffObj->staffinforepo_pk])->all();
                if(!empty($modelStfLc)){
                    $license = StafflicensedtlsTbl::find()->where(['stafflicensedtls_pk' => $modelStfLc[0]->stafflicensedtls_pk])->one();
                    
                    $light = "";
                    $heavy = "";
                    // if ($requestdata->light_issue_date) {
                    //     $light = new DateTime($requestdata->light_issue_date);
                    //     $light = $light->format('Y-m-d');
                    // }
                    // if ($requestdata->heavy_issue_date) {
                    //     $heavy = new DateTime($requestdata->heavy_issue_date);
                    //     $heavy = $heavy->format('Y-m-d');
                    // }

                    
                    $light = $requestdata->light_issue_date;
                    
                    $heavy = $requestdata->heavy_issue_date;

                    $license->sld_staffinforepo_fk = $staffinforepo;
                    $license->sld_ROPlicense = $requestdata->license_number;
                    // if($requestdata->radion_button == 1){
                    //     if(is_array($requestdata->license_card)){
                    //         if(count($requestdata->license_card) > 1){
                    //             //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    //             $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                    //         }else{
                    //             $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    //         }
                    //     }else{
                    //         $license->sld_ROPlicenseupload = "";
                    //     }
                    // } else {
                    //     $license->sld_ROPlicenseupload = "";
                    //     $license->sld_ROPlicense = "";
                    // }

                    if($requestdata->radion_button == 1){
                        if(is_array($requestdata->license_card)){
                            if(count($requestdata->license_card) > 1){
                                //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                                $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                            }else{
                                $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }
                        }else if(!empty($requestdata->license_card)){
                            $license->sld_ROPlicenseupload = $requestdata->license_card;
                        }else{
                            $license->sld_ROPlicenseupload = "";
                        }
                    } else {
                        $license->sld_ROPlicenseupload = "";
                        $license->sld_ROPlicense = "";
                    }

                    $license->sld_hasROPlightlicense = $requestdata->light_license;
                    $license->sld_hasROPheavylicense = $requestdata->heavy_license;
                    if($requestdata->light_license == 2){
                        $light = "";
                    }
        
                    if($requestdata->heavy_license == 2){
                        $heavy = "";
                    }
                    $license->sld_ROPlightlicense = $light;
                    $license->sld_ROPheavylicense = $heavy;
                    $license->sld_createdby = $userPk;
                }else{
                    $license = new StafflicensedtlsTbl();
                    $light = "";
                    $heavy = "";
                    // if ($requestdata->light_issue_date) {
                    //     $light = new DateTime($requestdata->light_issue_date);;
                    //     $light = $light->format('Y-m-d');
                    // }
                    // if ($requestdata->heavy_issue_date) {
                    //     $heavy = new DateTime($requestdata->heavy_issue_date);
                    //     $heavy = $heavy->format('Y-m-d');
                    // }

                    
                    $light = $requestdata->light_issue_date;
                        
                    
                    $heavy = $requestdata->heavy_issue_date;
                    $license->sld_staffinforepo_fk = $staffinforepo;
                    $license->sld_ROPlicense = $requestdata->license_number;
                    // if($requestdata->radion_button == 1){
                    //     if(is_array($requestdata->license_card)){
                    //         if(count($requestdata->license_card) > 1){
                    //             //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    //             $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                    //         }else{
                    //             $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    //         }
                    //     }else{
                    //         $license->sld_ROPlicenseupload = "";
                    //     }
                    // } else {
                    //     $license->sld_ROPlicenseupload = "";
                    //     $license->sld_ROPlicense = "";
                    // }

                    if($requestdata->radion_button == 1){
                        if(is_array($requestdata->license_card)){
                            if(count($requestdata->license_card) > 1){
                                //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                                $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                            }else{
                                $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                            }
                        }else if(!empty($requestdata->license_card)){
                            $license->sld_ROPlicenseupload = $requestdata->license_card;
                        }else{
                            $license->sld_ROPlicenseupload = "";
                        }
                    } else {
                        $license->sld_ROPlicenseupload = "";
                        $license->sld_ROPlicense = "";
                    }

                    $license->sld_hasROPlightlicense = $requestdata->light_license;
                    $license->sld_hasROPheavylicense = $requestdata->heavy_license;
                    if($requestdata->light_license == 2){
                        $light = "";
                    }
        
                    if($requestdata->heavy_license == 2){
                        $heavy = "";
                    }
                    $license->sld_ROPlightlicense = $light;
                    $license->sld_ROPheavylicense = $heavy;
                    $license->sld_createdby = $userPk;
                }

                
                if ($license->save()) {
                }else {
                    echo "<pre>";var_dump($license->getErrors());exit;
                }
                    
                    $modelBatch = BatchmgmtdtlsTbl::find()
                        ->select(['*'])
                        ->leftJoin('appcoursedtlsmain_tbl appcour','appcour.AppCourseDtlsMain_PK = batchmgmtdtls_tbl.bmd_appcoursedtlsmain_fk')
                        ->leftJoin('applicationdtlsmain_tbl appmain','appmain.applicationdtlsmain_pk = appcdm_ApplicationDtlsMain_FK')
                        ->where("batchmgmtdtls_pk =" . $requestdata->batchmgmtdtls)
                    ->asArray()
                    ->one();

                    $learner = new LearnerreghrddtlsTbl();
                    $learner->lrhd_staffinforepo_fk = $staffinforepo;
                    $learner->Irhd_emailid = $requestdata->sir_emailid;
                    $learner->lrhd_opalmemberregmst_fk = $modelBatch['bmd_opalmemberregmst_fk'];
                    $learner->lrhd_batchmgmtdtls_fk = $requestdata->batchmgmtdtls;
                    $learner->Irhd_projectmst_fk = $modelBatch['appdm_projectmst_fk'];
                    $learner->lrhd_totalyearexp = $requestdata->total_year;
                    $learner->lrhd_learnerfee = $requestdata->learner_fee;
                    $learner->lrhd_feestatus = $requestdata->learner_fee_status;
                    $learner->lrhd_paidby = $requestdata->paid_by;
                    $learner->lrhd_operatorname = $requestdata->company_name;
                    $learner->lrhd_status = 1;
                    $learner->lrhd_createdby = $userPk;
                    
                    if(!$learner->save()) {
                        echo "<pre>";var_dump($learner->getErrors());exit;
                    }

                    // theory update start
                    $modelThryHdr = BatchmgmtthyhdrTbl::find()->where(['bmth_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmth_status' => 1])
                                        ->orderBy(['batchmgmtthyhdr_pk' => SORT_ASC])
                                        ->one();

                    $modelThryDtls = BatchmgmtthydtlsTbl::find()->where(['bmtd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmtd_batchmgmtthyhdr_fk' => $modelThryHdr->batchmgmtthyhdr_pk])
                                        ->all();

                    if(!empty($modelThryHdr)){
                        if(count($modelThryDtls) < $modelThryHdr->bmth_batchcount){
                            $saveBatchDtls = new BatchmgmtthydtlsTbl();
                            $saveBatchDtls->bmtd_batchmgmtdtls_fk = $modelThryHdr->bmth_batchmgmtdtls_fk;
                            $saveBatchDtls->bmtd_batchmgmtthyhdr_fk = $modelThryHdr->batchmgmtthyhdr_pk;
                            $saveBatchDtls->bmtd_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
                            $saveBatchDtls->bmtd_status = 1;
                            $saveBatchDtls->bmtd_createdon = date("Y-m-d H:i:s");
                            $saveBatchDtls->bmtd_createdby = $userPk;
                            if(!$saveBatchDtls->save()) {
                                echo "<pre>";var_dump($saveBatchDtls->getErrors());exit;
                            }
                        }
                    }

                    $modelThryDtlsCnt = BatchmgmtthydtlsTbl::find()->where(['bmtd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmtd_batchmgmtthyhdr_fk' => $modelThryHdr->batchmgmtthyhdr_pk])
                                        ->all();

                    if(!empty($modelThryHdr)){
                        if(count($modelThryDtlsCnt) == $modelThryHdr->bmth_batchcount){
                            $modelBatchUpdate = BatchmgmtthyhdrTbl::find()->where(['batchmgmtthyhdr_pk' => $modelThryHdr->batchmgmtthyhdr_pk])->one();
                            $modelBatchUpdate->bmth_status = 2;
                            $modelBatchUpdate->save();
                        }
                    }
                    // theory update end

                    // pracical update start
                    $modelThryHdrPrt = BatchmgmtpracthdrTbl::find()
                                                ->where(['bmph_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls])
                                                ->andWhere(['in', 'bmph_status', [1, 3]])
                                        ->orderBy(['batchmgmtpracthdr_pk' => SORT_ASC])
                                        ->one();
                    
                    // update Inactive to Active
                    if($modelThryHdrPrt->bmph_status == '3'){
                        $modelBatchUpdatePrtInAt = BatchmgmtpracthdrTbl::find()->where(['batchmgmtpracthdr_pk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])->one();
                        $modelBatchUpdatePrtInAt->bmph_status = 1;
                        $modelBatchUpdatePrtInAt->save();
                    }

                    $modelThryDtlsPrt = BatchmgmtpractdtlsTbl::find()->where(['bmpd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmpd_batchmgmtpracthdr_fk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])
                                        ->all();

                    if(!empty($modelThryHdrPrt)){
                        if(count($modelThryDtlsPrt) < $modelThryHdrPrt->bmph_batchcount){
                            $saveBatchDtlsPrt = new BatchmgmtpractdtlsTbl();
                            $saveBatchDtlsPrt->bmpd_batchmgmtdtls_fk = $modelThryHdrPrt->bmph_batchmgmtdtls_fk;
                            $saveBatchDtlsPrt->bmpd_batchmgmtpracthdr_fk = $modelThryHdrPrt->batchmgmtpracthdr_pk;
                            $saveBatchDtlsPrt->bmpd_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
                            $saveBatchDtlsPrt->bmpd_status = 1;
                            $saveBatchDtlsPrt->bmpd_createdon = date("Y-m-d H:i:s");
                            $saveBatchDtlsPrt->bmpd_createdby = $userPk;
                            if(!$saveBatchDtlsPrt->save()) {
                                echo "<pre>";var_dump($saveBatchDtlsPrt->getErrors());exit;
                            }
                        }
                    }

                    $modelThryDtlsPrtCnt = BatchmgmtpractdtlsTbl::find()->where(['bmpd_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmpd_batchmgmtpracthdr_fk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])
                                        ->all();

                    if(!empty($modelThryHdrPrt)){
                        if(count($modelThryDtlsPrtCnt) == $modelThryHdrPrt->bmph_batchcount){
                            $modelBatchUpdatePrt = BatchmgmtpracthdrTbl::find()->where(['batchmgmtpracthdr_pk' => $modelThryHdrPrt->batchmgmtpracthdr_pk])->one();
                            $modelBatchUpdatePrt->bmph_status = 2;
                            $modelBatchUpdatePrt->save();
                        }
                    }
                    // pracical update end

                    // assesment update start
                    $modelThryHdrAss = BatchmgmtasmthdrTbl::find()->where(['bmah_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmah_status' => 1])
                                        ->orderBy(['batchmgmtasmthdr_pk' => SORT_ASC])
                                        ->one();

                    $modelThryDtlsAss = BatchmgmtasmtdtlsTbl::find()->where(['bmad_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmad_batchmgmtasmthdr_fk' => $modelThryHdrAss->batchmgmtasmthdr_pk])
                                        ->all();

                    if(!empty($modelThryHdrAss)){
                        if(count($modelThryDtlsAss) < $modelThryHdrAss->bmah_batchcount){
                            $saveBatchDtlsAss = new BatchmgmtasmtdtlsTbl();
                            $saveBatchDtlsAss->bmad_batchmgmtdtls_fk = $modelThryHdrAss->bmah_batchmgmtdtls_fk;
                            $saveBatchDtlsAss->bmad_batchmgmtasmthdr_fk = $modelThryHdrAss->batchmgmtasmthdr_pk;
                            $saveBatchDtlsAss->bmad_learnerreghrddtls_fk = $learner->learnerreghrddtls_pk;
                            $saveBatchDtlsAss->bmad_staffinforepo_fk = $staffinforepo;
                            $saveBatchDtlsAss->bmad_status = 1;
                            $saveBatchDtlsAss->bmad_createdon = date("Y-m-d H:i:s");
                            $saveBatchDtlsAss->bmad_createdby = $userPk;
                            if(!$saveBatchDtlsAss->save()) {
                                echo "<pre>";var_dump($saveBatchDtlsAss->getErrors());exit;
                            }
                        }
                    }

                    $modelThryDtlsAssCnt = BatchmgmtasmtdtlsTbl::find()->where(['bmad_batchmgmtdtls_fk' => $requestdata->batchmgmtdtls, 'bmad_batchmgmtasmthdr_fk' => $modelThryHdrAss->batchmgmtasmthdr_pk])
                                        ->all();

                    if(!empty($modelThryHdrAss)){
                        if(count($modelThryDtlsAssCnt) == $modelThryHdrAss->bmah_batchcount){
                            $modelBatchUpdateAss = BatchmgmtasmthdrTbl::find()->where(['batchmgmtasmthdr_pk' => $modelThryHdrAss->batchmgmtasmthdr_pk])->one();
                            $modelBatchUpdateAss->bmah_status = 2;
                            $modelBatchUpdateAss->save();
                        }
                    }
                    // assesment update end

                    return $learner;

                
        }
            // else {
        //     $learner = LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $requestdata->learnerreghrddtls_pk])->one();
        //     $learner->lrhd_totalyearexp = $requestdata->total_year;
        //     $learner->lrhd_learnerfee = $requestdata->learner_fee;
        //     $learner->lrhd_feestatus = $requestdata->learner_fee_status;
        //     $learner->lrhd_paidby = $requestdata->paid_by;
        //     $learner->lrhd_operatorname = $requestdata->company_name;
        //     if ($learner->save()) {
        //         return $learner;
        //     }else {
        //         echo "<pre>";var_dump($learner->getErrors());exit;
        //     }
        // }
        //////////////////////////////////////////

        
    }


    public static function updatelearner($requestdata){
        
        $regPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        //echo '<pre>';print_r($requestdata->sir_dob);exit;
        $staffObj = StaffinforepoTbl::find()
                    ->select(['*'])
                    ->where(['sir_idnumber' => $requestdata->sir_idnumber])->one();
        $staffinforepo = $staffObj->staffinforepo_pk;
        $opalmemberregmst = $staffObj->sir_opalmemberregmst_fk;
        $emailid = $staffObj->sir_emailid;

        //check age limit starts
        $modelBatchRes = BatchmgmtdtlsTbl::find()->select(['*'])
        ->leftJoin('standardcoursedtls_tbl std','std.standardcoursedtls_pk = batchmgmtdtls_tbl.bmd_standardcoursedtls_fk')
        ->where(['batchmgmtdtls_pk' => $requestdata->batchmgmtdtls])
        ->asArray()
        ->one();

        //$requestdata->age = 20;
        if(!empty($modelBatchRes)){
        if($modelBatchRes['scd_hasagelimit'] == '1'){
        if($modelBatchRes['scd_agelimit'] > $requestdata->age){
            return "age_limit";
            exit;
        }
        }

        // if($modelBatchRes['bmd_status'] != '1'){
        // return "batch_notnew";
        // exit;
        // }
        }
        //check age limit Ends
        
        $modelStfRepo = StaffinforepoTbl::find()->where(['staffinforepo_pk' => $staffinforepo])->one();
        $modelStfRepo->sir_idnumber = str_replace(' ', '', $requestdata->sir_idnumber);
        $modelStfRepo->sir_name_en = $requestdata->sir_name_en;
        $modelStfRepo->sir_name_ar = $requestdata->sir_name_ar;
        $modelStfRepo->sir_emailid = $requestdata->sir_emailid;
        $modelStfRepo->sir_dob = $requestdata->sir_dob;
        $modelStfRepo->sir_gender = $requestdata->sir_gender;
        $modelStfRepo->sir_nationality = $requestdata->sir_nationality;
        $modelStfRepo->sir_photo = $requestdata->sir_photo[0];
        $modelStfRepo->sir_mobnum = $requestdata->mnumber;
        $modelStfRepo->sir_altmobnum = $requestdata->mnumber2;
        if(is_array($requestdata->sir_civilidfront)){
            if(count($requestdata->sir_civilidfront) > 1){
                $modelStfRepo->sir_civilidfront = $requestdata->sir_civilidfront[0];
                $modelStfRepo->sir_civilidback = $requestdata->sir_civilidfront[1];
            }else{
                $modelStfRepo->sir_civilidfront = $requestdata->sir_civilidfront[0];
            }
        }else{
            $modelStfRepo->sir_civilidfront = "";
        }

        $modelStfRepo->sir_addrline1 = $requestdata->sir_addrline1;
        $modelStfRepo->sir_addrline2 = $requestdata->sir_addrline2;
        $modelStfRepo->sir_opalstatemst_fk = $requestdata->state;
        $modelStfRepo->sir_opalcitymst_fk = $requestdata->city;
        $modelStfRepo->sir_createdon = date("Y-m-d H:i:s");
        $modelStfRepo->sir_createdby = $userPk;
        if(!$modelStfRepo->save()){
            echo "<pre>";var_dump($modelStfRepo->getErrors());exit;
        }

        $learner = LearnerreghrddtlsTbl::find()->where(['learnerreghrddtls_pk' => $requestdata->lear_pk])->one();
        $learner->Irhd_emailid = $requestdata->sir_emailid;
        $learner->lrhd_updatedon = date("Y-m-d H:i:s");
        $learner->lrhd_updatedby = $userPk;
        if ($learner->save()) {
        }else {
            echo "<pre>";var_dump($learner->getErrors());exit;
        }


        $modelStfLc = StafflicensedtlsTbl::find()->where(['sld_staffinforepo_fk' => $staffObj->staffinforepo_pk])->all();
        if(!empty($modelStfLc)){
            $license = StafflicensedtlsTbl::find()->where(['stafflicensedtls_pk' => $modelStfLc[0]->stafflicensedtls_pk])->one();
            
            $light = "";
            $heavy = "";
            // if ($requestdata->light_issue_date) {
            //     $light = new DateTime($requestdata->light_issue_date);
            //     $light = $light->format('Y-m-d');
            // }

            // if ($requestdata->heavy_issue_date) {
            //     $heavy = new DateTime($requestdata->heavy_issue_date);
            //     $heavy = $heavy->format('Y-m-d');
            // }

            
            $light = $requestdata->light_issue_date;
            
            $heavy = $requestdata->heavy_issue_date;

            $license->sld_staffinforepo_fk = $staffinforepo;
            $license->sld_ROPlicense = $requestdata->license_number;
            //echo '<pre>';print_r($requestdata->license_card);exit;
            if($requestdata->radion_button == 1){
                if(is_array($requestdata->license_card)){
                    if(count($requestdata->license_card) > 1){
                        //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                        $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                    }else{
                        $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    }
                }else if(!empty($requestdata->license_card)){
                    $license->sld_ROPlicenseupload = $requestdata->license_card;
                }else{
                    $license->sld_ROPlicenseupload = "";
                }
            } else {
                $license->sld_ROPlicenseupload = "";
                $license->sld_ROPlicense = "";
            }

            
            $license->sld_hasROPlightlicense = $requestdata->light_license;
            $license->sld_hasROPheavylicense = $requestdata->heavy_license;
            if($requestdata->light_license == 2){
                $light = "";
            }
 
            if($requestdata->heavy_license == 2){
                $heavy = "";
            }
            $license->sld_ROPlightlicense = $light;
            $license->sld_ROPheavylicense = $heavy;
            $license->sld_createdby = $userPk;
        }else{
            $license = new StafflicensedtlsTbl();
            $light = "";
            $heavy = "";
            // if ($requestdata->light_issue_date) {
            //     $light = new DateTime($requestdata->light_issue_date);;
            //     $light = $light->format('Y-m-d');
            // }
            // if ($requestdata->heavy_issue_date) {
            //     $heavy = new DateTime($requestdata->heavy_issue_date);
            //     $heavy = $heavy->format('Y-m-d');
            // }

            
            $light = $requestdata->light_issue_date;
            
            $heavy = $requestdata->heavy_issue_date;

            $license->sld_staffinforepo_fk = $staffinforepo;
            $license->sld_ROPlicense = $requestdata->license_number;
            if($requestdata->radion_button == 1){
                if(is_array($requestdata->license_card)){
                    if(count($requestdata->license_card) > 1){
                        //$license->sld_ROPlicenseupload = $requestdata->license_card[0];
                        $license->sld_ROPlicenseupload = implode(',', $requestdata->license_card);
                    }else{
                        $license->sld_ROPlicenseupload = $requestdata->license_card[0];
                    }
                }else{
                    $license->sld_ROPlicenseupload = "";
                }
            } else {
                $license->sld_ROPlicenseupload = "";
                $license->sld_ROPlicense = "";
            }
            $license->sld_hasROPlightlicense = $requestdata->light_license;
            $license->sld_hasROPheavylicense = $requestdata->heavy_license;
            if($requestdata->light_license == 2){
                $light = "";
            }
 
            if($requestdata->heavy_license == 2){
                $heavy = "";
            }
            $license->sld_ROPlightlicense = $light;
            $license->sld_ROPheavylicense = $heavy;
            $license->sld_createdby = $userPk;
        }

        if ($license->save()) {
            return $modelStfRepo;
        } else {
                echo "<pre>";var_dump($license->getErrors());exit;
        }
        //////////////////////////////////////////
    }

    public static function fetchFavResult($staffid, $pageSize , $page){
  
        $favQuery = self::find();
        $favQuery->select([
                        '*','TIMESTAMPDIFF(YEAR, sir_dob, CURDATE())  AS age','DATE_FORMAT(appsit_appdecon,"%d-%m-%Y") AS appsit_appdecon1','DATE_FORMAT(sir_dob,"%d-%m-%Y") AS sir_dob1'
                        
                    ])
                    ->leftJoin('appstaffinfotmp_tbl  temp','temp.appsit_staffinforepo_fk = staffinforepo_pk')
                    //->leftJoin('staffinforepo_tbl repo','repo.staffinforepo_pk = sacd_staffinforepo_fk')
                    ->leftJoin('applicationdtlstmp_tbl apptemp','apptemp.applicationdtlstmp_pk = temp.appsit_applicationdtlstmp_fk')
                    // ->leftJoin('opalcountrymst_tbl country','country.opalcountrymst_pk = sacd_opalcountrymst_fk')
                    // ->leftJoin('opalstatemst_tbl state','state.opalstatemst_pk = sacd_opalstatemst_fk')
                    // ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = sacd_opalcitymst_fk')
                    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = sir_moheridoc')
                    ->leftJoin('apprasvehinspcattmp_tbl veh','find_in_set(veh.apprasvehinspcattmp_pk,temp.appsit_apprasvehinspcattmp_fk)')
                    ->leftJoin('stafflicensedtls_tbl stafflicence','stafflicence.sld_staffinforepo_fk = staffinforepo_pk');
                    
                  
                   
        $favQuery->where([
                        'appostaffinfotmp_pk'=> $staffid,
                    ]);
        $favQry = $favQuery->groupBy('apprasvehinspcattmp_pk')->orderBy(['appostaffinfotmp_pk'=>SORT_DESC])
                    ->asArray();
                    
    //         $a =  $datalifavQryst->createCommand()->getRawSql();
    // print($a);exit;        
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
           
            $driveImg  =   \api\components\Drive::generateUrl($favResData['sir_moheridoc'],$companypk,$userpk);
            $civilfront  =   \api\components\Drive::generateUrl($favResData['sir_civilidfront'],$companypk,$userpk);
            $licenceupload  =   \api\components\Drive::generateUrl($favResData['sld_ROPlicenseupload'],$companypk,$userpk);
            $favData[$key] = $favResData;
            $countrymodel        =   \app\models\OpalcountrymstTbl::find()->where("opalcountrymst_pk =:pk", [':pk' => $favResData['sir_nationality']])->one();
            $statemodel          =   \app\models\OpalstatemstTbl::find()->where("opalstatemst_pk =:pk", [':pk' => $favResData['sir_opalstatemst_fk']])->one();
            $citymodel           =   \app\models\OpalcitymstTbl::find()->where("opalcitymst_pk =:pk", [':pk' => $favResData['sir_opalcitymst_fk']])->one();
            $model               =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appsit_appdecby']])->one();
            $equlevelmodel       =   \app\models\ReferencemstTbl::find()->where("referencemst_pk =:pk", [':pk' => $favResData['sacd_edulevel']])->one();
            $civilfrontmodel     =    \api\models\MemcompfiledtlsTbl::find()->where("memcompfiledtls_pk =:pk", [':pk' => $favResData['sir_civilidfront']])->one();
            $Ropmodel            =    \api\models\MemcompfiledtlsTbl::find()->where("memcompfiledtls_pk =:pk", [':pk' => $favResData['sld_ROPlicenseupload']])->one();
            $favData[$key]['username'] = $model['oum_firstname'];
            $favData[$key]['sir_nationality'] = $countrymodel['ocym_countryname_en'];
            $favData[$key]['sir_opalstatemst_fk'] = $statemodel['osm_statename_en'];
            $favData[$key]['sir_opalcitymst_fk'] = $citymodel['ocim_cityname_en'];
            $favData[$key]['coverImages'] = $driveImg; 
            $favData[$key]['coverImages1'] = $civilfront; 
            $favData[$key]['coverImages2'] = $licenceupload; 
            $favData[$key]['sacd_edulevel'] = $equlevelmodel['rm_name_en'];
            $favData[$key]['civilfiletype'] = $civilfrontmodel['mcfd_filetype'];
            $favData[$key]['licencefiletype'] = $Ropmodel['mcfd_filetype'];
            $address  =      $favResData['sir_addrline1']. ',';
            if($favResData['sir_addrline2']){
                $address .=  $favResData['sir_addrline2'].',';
            }
            
            $address .= 'Oman,'.$statemodel['osm_statename_en'].','. $citymodel['ocim_cityname_en'];

            $favData[$key]['address'] = trim($address, ",") ;
            $mainrole_arr = explode("," ,$favResData['appsit_mainrole']);
            $rolestr = [];
            foreach($mainrole_arr as $pk){
                 $rolestr[] =    $rolearr[$pk];
            }
            $mainrole_str = implode(", " ,$rolestr);
            $favData[$key]['appsit_mainrole'] = $mainrole_str;
           }
        $favouriteRes['data'] = $favData;
        $favouriteRes['totalcount'] = $favProvider->getTotalCount();
        $favouriteRes['size'] = $pageSize;
        $favouriteRes['page'] = $page;
    
        return $favouriteRes;
    
}
}
