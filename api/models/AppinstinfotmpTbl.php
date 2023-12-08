<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appinstinfotmp_tbl".
 *
 * @property int $appinstinfotmp_pk Primary Key
 * @property int $appiit_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appiit_officetype 1-Main office, 2-branch office
 * @property int $appiit_noofexpat
 * @property int $appiit_noofomani
 * @property string $appiit_loclatitude
 * @property string $appiit_loclongitude
 * @property string $appiit_locmapurl
 * @property string $appiit_molpercent
 * @property int $appiit_nooftechstaff
 * @property int $appiit_noofcurlearners
 * @property int $appiit_maxcapacity
 * @property string $appiit_addrline1
 * @property string $appiit_addrline2
 * @property int $appiit_statemst_fk Reference to statemst_pk
 * @property int $appiit_citymst_fk Reference to citymst_pk
 * @property string $appiit_createdon
 * @property int $appiit_createdby
 * @property string $appiit_updatedon
 * @property int $appiit_updatedby
 * @property int $appiit_status
 * @property string $appiit_appdecon
 * @property int $appiit_appdecby
 * @property string $appiit_appdeccomment
 *
 * @property ApplicationdtlstmpTbl $appiitApplicationdtlstmpFk
 * @property CitymstTbl $appiitCitymstFk
 * @property StatemstTbl $appiitStatemstFk
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls
 * @property AppstaffinfotmpTbl[] $appstaffinfotmpTbls0
 */
class AppinstinfotmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appinstinfotmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appiit_applicationdtlstmp_fk', 'appiit_createdon', 'appiit_createdby', 'appiit_status'], 'required'],
            [['appiit_applicationdtlstmp_fk', 'appiit_officetype', 'appiit_noofexpat', 'appiit_noofomani', 'appiit_nooftechstaff', 'appiit_noofcurlearners', 'appiit_maxcapacity', 'appiit_statemst_fk', 'appiit_citymst_fk', 'appiit_createdby', 'appiit_updatedby', 'appiit_status', 'appiit_appdecby'], 'integer'],
            [['appiit_loclatitude', 'appiit_loclongitude', 'appiit_locmapurl', 'appiit_addrline1', 'appiit_addrline2', 'appiit_appdeccomment'], 'string'],
            //[['appiit_molpercent'], 'number'],
            [['appiit_createdon', 'appiit_updatedon', 'appiit_appdecon'], 'safe'],
            [['appiit_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appiit_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
         //   [['appiit_citymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CitymstTbl::className(), 'targetAttribute' => ['appiit_citymst_fk' => 'citymst_pk']],
           // [['appiit_statemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StatemstTbl::className(), 'targetAttribute' => ['appiit_statemst_fk' => 'statemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appinstinfotmp_pk' => 'Appinstinfotmp Pk',
            'appiit_applicationdtlstmp_fk' => 'Appiit Applicationdtlstmp Fk',
            'appiit_officetype' => 'Appiit Officetype',
            'appiit_noofexpat' => 'Appiit Noofexpat',
            'appiit_noofomani' => 'Appiit Noofomani',
            'appiit_loclatitude' => 'Appiit Loclatitude',
            'appiit_loclongitude' => 'Appiit Loclongitude',
            'appiit_locmapurl' => 'Appiit Locmapurl',
            'appiit_molpercent' => 'Appiit Molpercent',
            'appiit_nooftechstaff' => 'Appiit Nooftechstaff',
            'appiit_noofcurlearners' => 'Appiit Noofcurlearners',
            'appiit_maxcapacity' => 'Appiit Maxcapacity',
            'appiit_addrline1' => 'Appiit Addrline1',
            'appiit_addrline2' => 'Appiit Addrline2',
            'appiit_statemst_fk' => 'Appiit Statemst Fk',
            'appiit_citymst_fk' => 'Appiit Citymst Fk',
            'appiit_createdon' => 'Appiit Createdon',
            'appiit_createdby' => 'Appiit Createdby',
            'appiit_updatedon' => 'Appiit Updatedon',
            'appiit_updatedby' => 'Appiit Updatedby',
            'appiit_status' => 'Appiit Status',
            'appiit_appdecon' => 'Appiit Appdecon',
            'appiit_appdecby' => 'Appiit Appdecby',
            'appiit_appdeccomment' => 'Appiit Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppiitApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appiit_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getAppiitCitymstFk()
    // {
    //     return $this->hasOne(CitymstTbl::className(), ['citymst_pk' => 'appiit_citymst_fk']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getAppiitStatemstFk()
    // {
    //     return $this->hasOne(StatemstTbl::className(), ['statemst_pk' => 'appiit_statemst_fk']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfotmpTbls()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_appinstinfotmp_fk' => 'appinstinfotmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfotmpTbls0()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_appoffercoursetmp_fk' => 'appinstinfotmp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppinstinfotmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppinstinfotmpTblQuery(get_called_class());
    }

    public static function saveInsCenterDtls($requestdata){
        //echo '<pre>';print_r($requestdata);exit;
        if($requestdata['offtype'] == '2' && $requestdata['projecttype'] == 1){
            $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            
            $requestdata['acdt_opalmemberregmst_fk'] = $regPk;
            $requestdata['acdt_opalusermst_fk'] = $userPk;
            $requestdata['appdt_projectmst_fk'] = \Yii::$app->params['project_array'][1];
            $modelApp = new ApplicationdtlstmpTbl();
            $modelApp->appdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
            $modelApp->appdt_projectmst_fk = $requestdata['projecttype'];
            $modelApp->appdt_appreferno = 1;
            $modelApp->appdt_apptype = 1;
            $modelApp->appdt_status = 1;
            if($requestdata['projecttype'] == 4){
                // $modelApp->appdt_isprimarycert = 2;
            }
            
            if($modelApp->save()){
                if($requestdata['projecttype'] == 4){
                    $no = ApplicationdtlstmpTbl::genRefNoras($requestdata['acdt_opalmemberregmst_fk'],$modelApp->applicationdtlstmp_pk);
                }else{
                    $no = ApplicationdtlstmpTbl::genRefNo($requestdata['acdt_opalmemberregmst_fk'],$modelApp->applicationdtlstmp_pk);
                }
                $appModel = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $modelApp->applicationdtlstmp_pk])->one();
                $appModel->appdt_appreferno = $no;
                if($appModel->save()){
                }else{
                    echo "<pre>";return $appModel->getErrors();exit;
                }
            }else{
                echo "<pre>";return $modelApp->getErrors();exit;
            }

            $requestdata['appdtlstmp_id'] = $modelApp->applicationdtlstmp_pk;
        }else{
            $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
            $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
            
            $requestdata['acdt_opalmemberregmst_fk'] = $regPk;
            $requestdata['acdt_opalusermst_fk'] = $userPk;
            $requestdata['appdt_projectmst_fk'] = \Yii::$app->params['project_array'][1];
            $modelApp = new ApplicationdtlstmpTbl();
            $modelApp->appdt_opalmemberregmst_fk = $requestdata['acdt_opalmemberregmst_fk'];
            $modelApp->appdt_projectmst_fk = $requestdata['projecttype'];
            $modelApp->appdt_appreferno = 1;
            $modelApp->appdt_apptype = 1;
            $modelApp->appdt_status = 1;
            if($requestdata['projecttype'] == 4){
                // $modelApp->appdt_isprimarycert = 2;
            }
            
            if($modelApp->save()){
                if($requestdata['projecttype'] == 4){
                    $no = ApplicationdtlstmpTbl::genRefNoras($requestdata['acdt_opalmemberregmst_fk'],$modelApp->applicationdtlstmp_pk);
                }else{
                    $no = ApplicationdtlstmpTbl::genRefNo($requestdata['acdt_opalmemberregmst_fk'],$modelApp->applicationdtlstmp_pk);
                }
                $appModel = ApplicationdtlstmpTbl::find()->where(['applicationdtlstmp_pk' => $modelApp->applicationdtlstmp_pk])->one();
                $appModel->appdt_appreferno = $no;
                if($appModel->save()){
                }else{
                    echo "<pre>";return $appModel->getErrors();exit;
                }
            }else{
                echo "<pre>";return $modelApp->getErrors();exit;
            }

            $requestdata['appdtlstmp_id'] = $modelApp->applicationdtlstmp_pk;
        }
        $model = new AppinstinfotmpTbl();
        $model->appiit_opalmemberregmst_fk = $requestdata['appiit_opalmemberregmst_fk'];
        $model->appiit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        if(!empty($requestdata['brancheng']) && !empty($requestdata['brancharab'])){
            $model->appiit_branchname_en = $requestdata['brancheng'];
            $model->appiit_branchname_ar = $requestdata['brancharab'];
        }
        $model->appiit_officetype = $requestdata['offtype'];
        $model->appiit_noofexpat = $requestdata['exp_a'];
        $model->appiit_noofomani = $requestdata['oma_n'];
        $model->appiit_loclatitude = $requestdata['lat'];
        $model->appiit_loclongitude = $requestdata['lang'];
        $model->appiit_locmapurl = $requestdata['site_main'];
        $model->appiit_molpercent = $requestdata['molpercent'];
        $model->appiit_nooftechstaff = $requestdata['no_techstaff'];
        $model->appiit_noofcurlearners = $requestdata['curr_learn'];
        $model->appiit_maxcapacity = $requestdata['trainprovmax'];
        $model->appiit_addrline1 = $requestdata['address1br'];
        $model->appiit_addrline2 = $requestdata['address2br'];
        $model->appiit_statemst_fk = $requestdata['governoratebr'];
        $model->appiit_citymst_fk = $requestdata['wilayatbr'];
        $model->appiit_status = 1;
        $model->appiit_createdon = date("Y-m-d H:i:s");
        $model->appiit_createdby = $requestdata['appiit_createdby'];
         
        if($model->save()){
            if($requestdata['offtype'] == '2'){
                return $model;
            }else{
                return $model->appinstinfotmp_pk;
            }
            
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
    }

    public static function updateInsCenterDtls($requestdata){
        //echo '<pre>';print_r($requestdata['site_main']);exit;
        if($requestdata['projecttype'] == '1'){
        if($requestdata['offtype'] == '2'){
            $requestdata['appdtlstmp_id'] = $requestdata['appdtlstmp_pk'];
        }
        }
        if($requestdata['projecttype'] == '4'){
        if(!empty($requestdata['appdtlstmp_pk'])){
            $requestdata['appdtlstmp_id'] = $requestdata['appdtlstmp_pk'];
        }
        }

        $resSts = AppinstinfotmpTbl::changeStatus($requestdata['appdtlstmp_id']);
        
        $model = AppinstinfotmpTbl::find()->where(['appiit_applicationdtlstmp_fk' => $requestdata['appdtlstmp_id']])->one();
        
        //$model->appinstinfotmp_pk = $requestdata['appinstinfotmp_pk'];
        $model->appiit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
        $model->appiit_officetype = $requestdata['offtype'];

        if(!empty($requestdata['brancheng']) && !empty($requestdata['brancharab'])){
            $model->appiit_branchname_en = $requestdata['brancheng'];
            $model->appiit_branchname_ar = $requestdata['brancharab'];
        }
        $model->appiit_noofexpat = $requestdata['exp_a'];
        $model->appiit_noofomani = $requestdata['oma_n'];
        $model->appiit_loclatitude = $requestdata['lat'];
        $model->appiit_loclongitude = $requestdata['lang'];
        $model->appiit_locmapurl = $requestdata['site_main'];
        $model->appiit_molpercent = $requestdata['molpercent'];
        $model->appiit_nooftechstaff = $requestdata['no_techstaff'];
        $model->appiit_noofcurlearners = $requestdata['curr_learn'];
        $model->appiit_maxcapacity = $requestdata['trainprovmax'];
        $model->appiit_addrline1 = $requestdata['address1br'];
        $model->appiit_addrline2 = $requestdata['address2br'];
        $model->appiit_statemst_fk = $requestdata['governoratebr'];
        $model->appiit_citymst_fk = $requestdata['wilayatbr'];
        $model->appiit_addrline1 = $requestdata['inst_address1'];
        $model->appiit_addrline2 = $requestdata['inst_address2'];
        $model->appiit_statemst_fk = $requestdata['instgovernorate'];
        $model->appiit_citymst_fk = $requestdata['wila_yat'];
        if(!empty($resSts)){
            $model->appiit_status = 2;
            //$model->appiit_appdeccomment = "";
        }
        $model->appiit_updatedon = date("Y-m-d H:i:s");
        $model->appiit_updatedby = $requestdata['appiit_createdby'];
         
        if($model->save()){
            if($requestdata['offtype'] == '2'){
                $model->appiit_applicationdtlstmp_fk = $requestdata['appdtlstmp_id'];
                return $model;
            }else{
                return $model->appinstinfotmp_pk;
            }
            
        } else {
            echo "<pre>";var_dump($model->getErrors());exit;
        }  
    }

    public static function changeStatus($appDtlsPk){
    
        $model = AppinstinfotmpTbl::find()
                ->select(['appiit_status'])
                ->where("appiit_applicationdtlstmp_fk = $appDtlsPk")
                ->andWhere("appiit_status = 2 OR appiit_status = 3 OR appiit_status = 4")
                ->asArray()
                ->one();

        if(!empty($model)){
            return true;
        }else{
            return false;
        } 
    }
    
}
