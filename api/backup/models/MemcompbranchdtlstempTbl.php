<?php

namespace app\models;

use Yii;
use common\components\Security;
use common\models\UsermstTbl;
use common\models\MembercompanymstTbl;
use \api\modules\mst\models\CitymstTbl;
use \yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/** 
 * This is the model class for table "memcompbranchdtlstemp_tbl". 
 * 
 * @property int $memcompbranchdtlstemp_pk Primary key
 * @property int $mcbdt_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $mcbdt_officetypemst_fk
 * @property string $mcbdt_latlang
 * @property string $mcbdt_branchname Bank Name
 * @property string $mcbdt_branchnumber Bank Number
 * @property int $mcbdt_industrialzonemst_fk Reference to industrialzonemst_tbl
 * @property string $mcbdt_indzoneregno
 * @property int $mcbdt_industrialestatemst_fk Reference to industrialestatemst_tbl
 * @property string $mcbdt_isicactivitymst_fk reference to isicactivitymst_tbl, multiple isicactivitymst_pk separated by comma(,)
 * @property string $mcbdt_upload Reference to memcompfiledtls_tbl, multiple memcompfiledtls_pk separated by comma (,)
 * @property string $mcbdt_officenumber
 * @property string $mcbdt_floor
 * @property string $mcbdt_buildingname
 * @property string $mcbdt_waynumber
 * @property string $mcbdt_streetname
 * @property string $mcbdt_town
 * @property int $mcbdt_statemst_fk Reference to statemst_tbl
 * @property int $mcbdt_citymst_fk Reference to citymst_tbl
 * @property int $mcbdt_poboxno
 * @property string $mcbdt_postalcode
 * @property int $mcbdt_postalstatemst_fk Reference to statemst_tbl
 * @property int $mcbdt_postalcitymst_fk Reference to citymst_tbl
 * @property int $mcbdt_scfstatus 1 - New, 2 - Updated, 3 - Approved, 4 - Declined
 * @property int $mcbdt_isdeleted Is deleted 1 - Yes, 2 - No
 * @property int $mcbdt_view 1 - Public, 2 - Private
 * @property string $mcbdt_createdon Datetime of creation
 * @property int $mcbdt_createdby Reference to usermst_tbl
 * @property string $mcbdt_createdbyipaddr User IP Address
 * @property string $mcbdt_updatedon Datetime of updation
 * @property int $mcbdt_updatedby Reference to usermst_tbl
 * @property string $mcbdt_updatedbyipaddr User IP Address
 * @property string $mcbdt_appdeclon
 * @property int $mcbdt_appdeclby
 * @property string $mcbdt_appdeclcomments
 * 
 * @property MemcompbranchdtlshstyTbl[] $memcompbranchdtlshstyTbls
 * @property MemcompbranchdtlsmainTbl[] $memcompbranchdtlsmainTbls
 * @property UsermstTbl $mcbdtCreatedby
 * @property MembercompanymstTbl $mcbdtMemcompmstFk
 * @property UsermstTbl $mcbdtUpdatedby
 */ 
class MemcompbranchdtlstempTbl extends \yii\db\ActiveRecord
{ 
    /** 
     * {@inheritdoc} 
     */ 
    public static function tableName() 
    { 
        return 'memcompbranchdtlstemp_tbl'; 
    } 

    /** 
     * {@inheritdoc} 
     */ 
    public function rules()
    {
        return [
            [['mcbdt_memcompmst_fk', 'mcbdt_officetypemst_fk', 'mcbdt_createdby'], 'required'],
            [['mcbdt_memcompmst_fk', 'mcbdt_officetypemst_fk', 'mcbdt_industrialzonemst_fk', 'mcbdt_industrialestatemst_fk', 'mcbdt_businesslicensemst_fk', 'mcbdt_statemst_fk', 'mcbdt_citymst_fk', 'mcbdt_poboxno', 'mcbdt_postalstatemst_fk', 'mcbdt_postalcitymst_fk', 'mcbdt_scfstatus', 'mcbdt_isdeleted', 'mcbdt_view', 'mcbdt_createdby', 'mcbdt_updatedby', 'mcbdt_appdeclby'], 'integer'],
            [['mcbdt_latlong', 'mcbdt_isicactivitymst_fk', 'mcbdt_upload', 'mcbdt_appdeclcomments'], 'string'],
            [['mcbdt_createdon', 'mcbdt_updatedon', 'mcbdt_appdeclon'], 'safe'],
            [['mcbdt_branchname', 'mcbdt_floor', 'mcbdt_buildingname', 'mcbdt_waynumber', 'mcbdt_streetname', 'mcbdt_town'], 'string', 'max' => 100],
            [['mcbdt_branchnumber', 'mcbdt_indzoneregno', 'mcbdt_officenumber', 'mcbdt_createdbyipaddr', 'mcbdt_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcbdt_postalcode'], 'string', 'max' => 10],
            [['mcbdt_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcbdt_createdby' => 'UserMst_Pk']],
            [['mcbdt_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MembercompanymstTbl::className(), 'targetAttribute' => ['mcbdt_memcompmst_fk' => 'MemberCompMst_Pk']],
            [['mcbdt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcbdt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /** 
     * {@inheritdoc} 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'memcompbranchdtlstemp_pk' => 'Memcompbranchdtlstemp Pk',
            'mcbdt_memcompmst_fk' => 'Mcbdt Memcompmst Fk',
            'mcbdt_officetypemst_fk' => 'Mcbdt Officetypemst Fk',
            'mcbdt_branchname' => 'Mcbdt Branchname',
            'mcbdt_branchnumber' => 'Mcbdt Branchnumber',
            'mcbdt_industrialzonemst_fk' => 'Mcbdt Industrialzonemst Fk',
            'mcbdt_indzoneregno' => 'Mcbdt Indzoneregno',
            'mcbdt_industrialestatemst_fk' => 'Mcbdt Industrialestatemst Fk',
            'mcbdt_isicactivitymst_fk' => 'Mcbdt Isicactivitymst Fk',
            'mcbdt_upload' => 'Mcbdt Upload',
            'mcbdt_officenumber' => 'Mcbdt Officenumber',
            'mcbdt_floor' => 'Mcbdt Floor',
            'mcbdt_buildingname' => 'Mcbdt Buildingname',
            'mcbdt_waynumber' => 'Mcbdt Waynumber',
            'mcbdt_streetname' => 'Mcbdt Streetname',
            'mcbdt_town' => 'Mcbdt Town',
            'mcbdt_statemst_fk' => 'Mcbdt Statemst Fk',
            'mcbdt_citymst_fk' => 'Mcbdt Citymst Fk',
            'mcbdt_poboxno' => 'Mcbdt Poboxno',
            'mcbdt_postalcode' => 'Mcbdt Postalcode',
            'mcbdt_postalstatemst_fk' => 'Mcbdt Postalstatemst Fk',
            'mcbdt_postalcitymst_fk' => 'Mcbdt Postalcitymst Fk',
            'mcbdt_scfstatus' => 'Mcbdt Scfstatus',
            'mcbdt_isdeleted' => 'Mcbdt Isdeleted',
            'mcbdt_view' => 'Mcbdt View',
            'mcbdt_createdon' => 'Mcbdt Createdon',
            'mcbdt_createdby' => 'Mcbdt Createdby',
            'mcbdt_createdbyipaddr' => 'Mcbdt Createdbyipaddr',
            'mcbdt_updatedon' => 'Mcbdt Updatedon',
            'mcbdt_updatedby' => 'Mcbdt Updatedby',
            'mcbdt_updatedbyipaddr' => 'Mcbdt Updatedbyipaddr',
            'mcbdt_appdeclon' => 'Mcbdt Appdeclon',
            'mcbdt_appdeclby' => 'Mcbdt Appdeclby',
            'mcbdt_appdeclcomments' => 'Mcbdt Appdeclcomments',
        ]; 
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMemcompbranchdtlshstyTbls() 
    { 
        return $this->hasMany(MemcompbranchdtlshstyTbl::className(), ['mcbdh_memcompbranchdtlstemp_fk' => 'memcompbranchdtlstemp_pk']);
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMemcompbranchdtlsmainTbls() 
    { 
        return $this->hasMany(MemcompbranchdtlsmainTbl::className(), ['mcbdm_memcompbranchdtlstemp_fk' => 'memcompbranchdtlstemp_pk']);
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMcbdtCreatedby() 
    { 
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcbdt_createdby']);
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMcbdtMemcompmstFk() 
    { 
        return $this->hasOne(MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'mcbdt_memcompmst_fk']);
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMcbdtUpdatedby() 
    { 
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcbdt_updatedby']);
    } 

      public function getState()
    {
        return $this->hasOne(\api\modules\mst\models\StatemstTbl::className(), ['StateMst_Pk' => 'mcbdt_statemst_fk']);
    }
    public function getCity()
    {
        return $this->hasOne(\api\modules\mst\models\CitymstTbl::className(), ['CityMst_Pk' => 'mcbdt_citymst_fk']);
    }
    /** 
     * {@inheritdoc} 
     * @return MemcompbranchdtlstempTblQuery the active query used by this AR class. 
     */ 
    public static function find() 
    { 
        return new MemcompbranchdtlstempTblQuery(get_called_class()); 
    } 
    
     public static function saveBranchDtlsReg($requestdata,$regdtls, $compdtls,$userdtls)
    {
        $model = new MemcompbranchdtlstempTbl();
        $model->mcbdt_memcompmst_fk = $compdtls->MemberCompMst_Pk;
        $model->mcbdt_branchname = Security::sanitizeInput($requestdata['branchName'],'string_spl_char');
        $model->mcbdt_branchnumber = Security::sanitizeInput($requestdata['branchid'],'string_spl_char');
        
        
        $model->mcbdt_industrialzonemst_fk = Security::sanitizeInput($requestdata['industrialzone'],'number');
        $model->mcbdt_indzoneregno = Security::sanitizeInput($requestdata['industrialzonenum'],'string_spl_char');
       
        $model->mcbdt_industrialestatemst_fk = Security::sanitizeInput($requestdata['industrialestate'],'number');
         $model->mcbdt_businesslicensemst_fk = Security::sanitizeInput($requestdata['businesslicence'],'number');
        $model->mcbdt_officetypemst_fk = (!empty($requestdata['officeType'])) ? $requestdata['officeType'] : null;
        $model->mcbdt_officenumber = (!empty($requestdata['officenumber'])) ? $requestdata['officenumber'] : null;
        $model->mcbdt_floor = (!empty($requestdata['floor'])) ? $requestdata['floor'] : null;
        $model->mcbdt_buildingname = (!empty($requestdata['building'])) ? $requestdata['building'] : null;
        if($requestdata['est_state'] == 'other')
        {
            $model->mcbdt_statemst_fk = \api\modules\mst\models\StatemstTbl::addNewState($requestdata['est_country'],$requestdata['est_state_other']);
        }
        else
        {
        $model->mcbdt_statemst_fk = (!empty($requestdata['est_state'])) ? $requestdata['est_state'] : null;
        }
       
        if($requestdata['est_city'] == 'other')
        {
             $model->mcbdt_citymst_fk = \api\modules\mst\models\CitymstTbl::addNewCity($requestdata['est_country'],$model->mcbdt_statemst_fk,$requestdata['est_city_other'], $userdtls->UserMst_Pk);
        }
        else
        {
              $model->mcbdt_citymst_fk = (!empty($requestdata['est_city'])) ? $requestdata['est_city'] : null;
        }
        $model->mcbdt_streetname = (!empty($requestdata['streetname'])) ? $requestdata['streetname'] : null;
        $model->mcbdt_waynumber = (!empty($requestdata['waynumber'])) ? $requestdata['waynumber'] : null;
        $model->mcbdt_town = (!empty($requestdata['town'])) ? $requestdata['town'] : null;
        $model->mcbdt_poboxno =  (!empty($requestdata['poboxnumber'])) ? (int)$requestdata['poboxnumber'] : null;
        $model->mcbdt_postalcode =  (!empty($requestdata['postalcode'])) ? $requestdata['postalcode'] : null;
        $model->mcbdt_postalstatemst_fk = (!empty($requestdata['est_post_state'])) ? $requestdata['est_post_state'] : null;
        $model->mcbdt_postalcitymst_fk = (!empty($requestdata['est_post_city'])) ? $requestdata['est_post_city'] : null;
        $model->mcbdt_createdby = $userdtls->UserMst_Pk;
        $model->mcbdt_createdon = date('Y-m-d H:i:s');
        $model->mcbdt_createdbyipaddr = \common\components\Common::getIpAddress();
       
        if($model->save())
        {
            return $model;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public function saveBranchTemp_dtls($data){
        //print_r($data); exit;
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != "undefined"){
            $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }
        $category=4;
        $compk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $stakeholdertype=\yii\db\ActiveRecord::getTokenData('reg_type', true);
        $formpk=$stakeholdertype==15?1:2;
        $state = Security::sanitizeInput($data['offgovernate'], 'number');
        $state = ($state == 0) ? null : $state;
        $city = Security::sanitizeInput($data['offwilayat'], 'number');
        $city = ($city == 0) ? null : $city;

        

        if($data['branchtempdtlspk']) {
           
            $branchmodel=MemcompbranchdtlstempTbl::findOne($data['branchtempdtlspk']);

            $branchmodel->mcbdt_memcompmst_fk=$compk;
            $branchmodel->mcbdt_officetypemst_fk=Security::sanitizeInput($data['transporttype'], 'number');
            $branchmodel->mcbdt_branchname=Security::sanitizeInput($data['name'], 'string_spl_char');
            $branchmodel->mcbdt_branchnumber=Security::sanitizeInput($data['branchid'], 'string');
            
            $branchmodel->mcbdt_industrialzonemst_fk=Security::sanitizeInput($data['industryzone'], 'number');
            $branchmodel->mcbdt_indzoneregno=$data['izrn'];
            
            $branchmodel->mcbdt_industrialestatemst_fk=Security::sanitizeInput($data['industryestate'], 'number');
            $branchmodel->mcbdt_businesslicensemst_fk=Security::sanitizeInput($data['businesslicense'], 'number');
            $branchmodel->mcbdt_isicactivitymst_fk=$data['isic_activity'];
            $branchmodel->mcbdt_upload=implode(',',$data['actvlicenseUpload']);
            $branchmodel->mcbdt_officenumber=Security::sanitizeInput($data['officenumber'], 'string');
            $branchmodel->mcbdt_floor=Security::sanitizeInput($data['floor'], 'string');
            $branchmodel->mcbdt_buildingname=Security::sanitizeInput($data['buildingnumber'], 'string_spl_char');
            $branchmodel->mcbdt_waynumber=Security::sanitizeInput($data['waynumber'], 'string');
            $branchmodel->mcbdt_streetname=$data['streetname'];
            $branchmodel->mcbdt_town=$data['townarea'];
            $branchmodel->mcbdt_statemst_fk=$state;
            $branchmodel->mcbdt_citymst_fk=$city;
            $branchmodel->mcbdt_poboxno=$data['poboxnumber'];
            $branchmodel->mcbdt_postalcode=$data['postalcode'];
            $branchmodel->mcbdt_postalstatemst_fk=$data['postalgovernate'];
            $branchmodel->mcbdt_postalcitymst_fk=$data['postalwilayat'];
            if($branchmodel->mcbdt_scfstatus==3 || $branchmodel->mcbdt_scfstatus==4){
                $branchmodel->mcbdt_scfstatus=2;
                $branchmodel->mcbdt_appdeclon=null;
                $branchmodel->mcbdt_appdeclby=null;
                $branchmodel->mcbdt_appdeclcomments=null;
            }            
            $branchmodel->mcbdt_isdeleted=2;
            $branchmodel->mcbdt_createdon=date('Y-m-d H:i:s');
            $branchmodel->mcbdt_createdby=$userPk;
            $branchmodel->mcbdt_createdbyipaddr=\common\components\Common::getIpAddress();            
            if(!$branchmodel->update()) {
                echo "<pre>";
                print_r($branchmodel->getErrors());
                die;
            }else{
                if(!empty($branchmodel->mcbdt_scfstatus)){
                    $formMemtmp=\common\models\SuppcertformmembtmpTbl::find()->where('scfmt_formmst_fk=:formpk and scfmt_membercompmst_fk=:company',
                    [':formpk'=>$formpk,':company'=>$companypk])->one();
                     if(empty($formMemtmp)){
                        $formMemtmp=new \common\models\SuppcertformmembtmpTbl();
                        $formMemtmp->scfmt_scfstatus='I';
                    }else{
                        if(in_array($formMemtmp->scfmt_scfstatus,['D','OSD'])){
                            $formMemtmp->scfmt_scfstatus='DI';
                        }elseif($formMemtmp->scfmt_scfstatus == 'A'){
                            $formMemtmp->scfmt_scfstatus='UI';
                        }
                    }    
                    $formMemtmp->scfmt_formmst_fk=$formpk;
                    $formMemtmp->scfmt_membercompmst_fk=$companypk;  
                    $formMemtmp->scfmt_submittedon=date('Y-m-d H:i:s');
                    $formMemtmp->scfmt_submittedby=$userPk;
                    if($formMemtmp->save(false)){
                        $SupCatModel=\common\models\SuppcertformcattmpTbl::find()
                                ->where('scfct_suppcertformmembtmp_fk=:membtmp and scfct_bgivaldoccatmst_fk=:cat',
                            [':membtmp'=>$formMemtmp->suppcertformmembtmp_pk,':cat'=>$category])->one();
                        if(in_array($SupCatModel->scfct_status,[2,3])){
                          $SupCatModel->scfct_status=4;
                        }
                        else{
                         $SupCatModel->scfct_status=1;
                        }
                        $SupCatModel->scfct_submittedon=date('Y-m-d H:i:s');
                        $SupCatModel->scfct_submittedby=$userpk;
                        $SupCatModel->save(false);
                    }
                  }
                return $branchmodel;
            }

        } else {            
            $branchmodel=new MemcompbranchdtlstempTbl();

            $branchmodel->mcbdt_memcompmst_fk=$compk;
            $branchmodel->mcbdt_officetypemst_fk=Security::sanitizeInput($data['transporttype'], 'number');
            $branchmodel->mcbdt_branchname=Security::sanitizeInput($data['name'], 'string_spl_char');
            $branchmodel->mcbdt_branchnumber=Security::sanitizeInput($data['branchid'], 'string');
            
            $branchmodel->mcbdt_industrialzonemst_fk=Security::sanitizeInput($data['industryzone'], 'number');
            $branchmodel->mcbdt_indzoneregno=$data['izrn'];
            
            $branchmodel->mcbdt_industrialestatemst_fk=Security::sanitizeInput($data['industryestate'], 'number');
            $branchmodel->mcbdt_businesslicensemst_fk=Security::sanitizeInput($data['businesslicense'], 'number');
            $branchmodel->mcbdt_isicactivitymst_fk=$data['isic_activity'];
            $branchmodel->mcbdt_upload=implode(',',$data['actvlicenseUpload']);
            $branchmodel->mcbdt_officenumber=Security::sanitizeInput($data['officenumber'], 'string');
            // $branchmodel->mcbdt_floor=Security::sanitizeInput($data['floor'], 'number');
            $branchmodel->mcbdt_floor=Security::sanitizeInput($data['floor'], 'string');
            $branchmodel->mcbdt_buildingname=Security::sanitizeInput($data['buildingnumber'], 'string_spl_char');
            $branchmodel->mcbdt_waynumber=Security::sanitizeInput($data['waynumber'], 'string');
            $branchmodel->mcbdt_streetname=$data['streetname'];
            $branchmodel->mcbdt_town=$data['townarea'];
            $branchmodel->mcbdt_statemst_fk=$state;
            $branchmodel->mcbdt_citymst_fk=$city;
            $branchmodel->mcbdt_poboxno=$data['poboxnumber'];
            $branchmodel->mcbdt_postalcode=$data['postalcode'];
            $branchmodel->mcbdt_postalstatemst_fk=$data['postalgovernate'];
            $branchmodel->mcbdt_postalcitymst_fk=$data['postalwilayat'];
            //$branchmodel->mcbdt_scfstatus=1;
            $branchmodel->mcbdt_isdeleted=2;
            $branchmodel->mcbdt_createdon=date('Y-m-d H:i:s');
            $branchmodel->mcbdt_createdby=$userPk;
            $branchmodel->mcbdt_createdbyipaddr=\common\components\Common::getIpAddress();
            if(!$branchmodel->save()) {
                echo "<pre>";
                print_r($branchmodel->getErrors());
                die;
            }else{
                return $branchmodel;
            }
        }

        
        

    }
    public static function deleteMarketPresence($id){
        if(!empty($id)){
            $model = self::findOne($id);
            if(!empty($model)){
                $model->mcbdt_isdeleted = 1;
                if($model->save()){
                    return true;
                }else{
                    return false; 
                }
            }else{
                return false;        
            }
        }
        return false;
    }

    public function getbsdivisionsector($brachid){

        $branchdivsec=MemcompbranchdtlstempTbl::find()->select(['GROUP_CONCAT(DISTINCT(mcbdt_isicactivitymst_fk)) as isiscact_pk'])
        ->where(['in','memcompbranchdtlstemp_pk',$brachid])
        ->asArray()->all();

        $compPK = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        $activityListQuery = \api\modules\mst\models\ActivitiesmstTbl::find()
                        ->select(['ActM_SectorMst_Fk','mcsd_businessunitrefname as divname','mcsd_referenceno as divid','SecM_SectorName as secName','SecM_SectorName_ar as secName_ar'])
                        ->leftJoin('sectormst_tbl','ActM_SectorMst_Fk = SectorMst_Pk')
                        ->leftJoin('memcompsectordtls_tbl','find_in_set(ActM_SectorMst_Fk, MCSD_SectorMst_Fk)')
                        ->where(['in','ActivitiesMst_Pk', explode (",", $branchdivsec[0]['isiscact_pk'])])
                        ->andwhere(['MCSD_MemberCompMst_Fk'=>$compPK])
                        ->andWhere(['ActM_Status'=>'A'])
                        ->groupBy('ActM_SectorMst_Fk')
                        ->asArray()->all();
            $secId = [];
            $divname = [];
            $secName = [];
            $secName_ar = [];
            $divid = [];
            foreach ($activityListQuery as $key => $value) {
                if (!in_array($value['ActM_SectorMst_Fk'], $secId)) {
                    $secId[] = $value['ActM_SectorMst_Fk'];
                }
                if (!in_array($value['divname'], $divname)) {
                    $divname[] = $value['divname'];
                }
                if (!in_array($value['secName'], $secName)) {
                    $secName[] = $value['secName'];
                }
                if (!in_array($value['secName_ar'], $secName_ar)) {
                    $secName_ar[] = $value['secName_ar'];
                }
                if (!in_array($value['divid'], $divid)) {
                    $divid[] = $value['divid'];
                }            
            }
            $isic_activitiesdata = ['divname'=>rtrim(implode(', ', $divname)), 'divid'=>implode(',', $divid), 'actarr'=>$secName, 'actarr_ar' => $secName_ar];
        
        return $isic_activitiesdata;
      

    }

}
