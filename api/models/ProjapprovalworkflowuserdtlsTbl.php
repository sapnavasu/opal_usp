<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projapprovalworkflowuserdtls_tbl".
 *
 * @property int $projapprovalworkflowuserdtls_pk primary key
 * @property int $pawfud_projapprovalworkflowdtls_fk Reference to projapprovalworkflowdtls_tbl
 * @property int $pawfud_projapprovalworkflowhrd_fk Reference to projapprovalworkflowhrd_tbl
 * @property int $pawfud_opalusermst_fk Reference to opalusermst_tbl
 * @property string $pawfh_createdon
 * @property int $pawfh_createdby
 * @property string $pawfh_updatedon
 * @property int $pawfh_updatedby
 *
 * @property AppapprovalhdrTbl[] $appapprovalhdrTbls
 * @property OpalusermstTbl $pawfudOpalusermstFk
 * @property ProjapprovalworkflowdtlsTbl $pawfudProjapprovalworkflowdtlsFk
 * @property ProjapprovalworkflowhrdTbl $pawfudProjapprovalworkflowhrdFk
 */
class ProjapprovalworkflowuserdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projapprovalworkflowuserdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pawfud_projapprovalworkflowdtls_fk', 'pawfud_projapprovalworkflowhrd_fk', 'pawfud_opalusermst_fk', 'pawfh_createdby'], 'required'],
            [['pawfud_projapprovalworkflowdtls_fk', 'pawfud_projapprovalworkflowhrd_fk', 'pawfud_opalusermst_fk', 'pawfh_createdby', 'pawfh_updatedby'], 'integer'],
            [['pawfh_createdon', 'pawfh_updatedon'], 'safe'],
            [['pawfud_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['pawfud_opalusermst_fk' => 'opalusermst_pk']],
            [['pawfud_projapprovalworkflowdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowdtlsTbl::className(), 'targetAttribute' => ['pawfud_projapprovalworkflowdtls_fk' => 'projapprovalworkflowdtls_pk']],
            [['pawfud_projapprovalworkflowhrd_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjapprovalworkflowhrdTbl::className(), 'targetAttribute' => ['pawfud_projapprovalworkflowhrd_fk' => 'projapprovalworkflowhrd_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projapprovalworkflowuserdtls_pk' => 'Projapprovalworkflowuserdtls Pk',
            'pawfud_projapprovalworkflowdtls_fk' => 'Pawfud Projapprovalworkflowdtls Fk',
            'pawfud_projapprovalworkflowhrd_fk' => 'Pawfud Projapprovalworkflowhrd Fk',
            'pawfud_opalusermst_fk' => 'Pawfud Opalusermst Fk',
            'pawfh_createdon' => 'Pawfh Createdon',
            'pawfh_createdby' => 'Pawfh Createdby',
            'pawfh_updatedon' => 'Pawfh Updatedon',
            'pawfh_updatedby' => 'Pawfh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppapprovalhdrTbls()
    {
        return $this->hasMany(AppapprovalhdrTbl::className(), ['aah_projapprovalworkflowuserdtls_fk' => 'projapprovalworkflowuserdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfudOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'pawfud_opalusermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfudProjapprovalworkflowdtlsFk()
    {
        return $this->hasOne(ProjapprovalworkflowdtlsTbl::className(), ['projapprovalworkflowdtls_pk' => 'pawfud_projapprovalworkflowdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPawfudProjapprovalworkflowhrdFk()
    {
        return $this->hasOne(ProjapprovalworkflowhrdTbl::className(), ['projapprovalworkflowhrd_pk' => 'pawfud_projapprovalworkflowhrd_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjapprovalworkflowuserdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjapprovalworkflowuserdtlsTblQuery(get_called_class());
    }


    public function insertapprovaldata($userid , $msetdata , $oldproject , $oldrole){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $data = $msetdata['arproject'];
        $arrole = $msetdata['arroles'];
        $mst_projectpk = array_unique($msetdata['arprojectpk']);
        $date=date('Y-m-d H:i:s');
        if($oldproject){
            $old_project_array = explode(',' ,$oldproject) ;
            $result=array_diff($old_project_array,$data);
            $result_n=array_intersect($old_project_array,$data);
        }

        if($oldrole){
            $old_role_array = explode(',' ,$oldrole) ;
            $result_role=array_diff($old_role_array,$arrole);
            
           
        }
     
        if(empty($mst_projectpk) && empty($data)){
            $deletmodel = ProjapprovalworkflowuserdtlsTbl::find()->where(['pawfud_opalusermst_fk'=> $userid ])->asArray()->all();
            foreach($deletmodel as $data){
                $model = ProjapprovalworkflowuserdtlsTbl::find()->where(['projapprovalworkflowuserdtls_pk'=> $data['projapprovalworkflowuserdtls_pk'] ])->one();
                \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                $model->delete();
                \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

            }

        }
        //delete rows
       
        if(empty($result)){
            if(!empty($result_role)){
                $result_role =  $result_role;
            }
            if(empty($data)){
               $data = $mst_projectpk;
                $result_role  = $oldrole;
            }
       
            if($data && $result_role){
               foreach($data as $projectid){
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->asArray()
                ->all();
                if(!empty($result_role)){
                foreach($projectmodel as $hdr_pk){
                    $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                   
                     if(count($result_role) == 1){
                        $result_role_array = $result_role;
                        if(is_array($result_role)){
                            $result_role_array = implode("," ,$result_role);   
                        }
                     }else{
                        $result_role_array = implode("," ,$result_role);
                     }
       
                
                    $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                    ->select([            
                    'projapprovalworkflowdtls_pk'])
                    ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                    ->andwhere('pawfd_rolemst_fk in ('.$result_role_array.')')
                    ->asArray()
                    ->all();
                    foreach($projectworkflowtable as $workflow_pk){
                        $workflow_pk = $workflow_pk['projapprovalworkflowdtls_pk'];
                        $model = ProjapprovalworkflowuserdtlsTbl::find()->where(['pawfud_projapprovalworkflowhrd_fk'=>$hdr_pk ,'pawfud_projapprovalworkflowdtls_fk' => $workflow_pk ,'pawfud_opalusermst_fk'=> $userid ])->one();
                        if($model){
                            \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                            $model->delete();
                            \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
    
                        }
                    }
                }
            }
            }
        }

        }

     
        if($result_role){
              $result = array_merge($result_n , $result);
        }


        foreach($result as $projectid){ 
            if(empty($result_role)){
                $result_role = $arrole;
            }
            $projectmodel = ProjapprovalworkflowhrdTbl::find()
            ->select([            
            'projapprovalworkflowhrd_pk'])
            ->where("pawfh_projectmst_fk = $projectid")
            ->asArray()
            ->all();
         
            if(count($result_role) == 1){
                $result_role_array = $result_role;
                if(is_array($result_role)){
                    $result_role_array = implode("," ,$result_role);   
                }
             }else{
                $result_role_array = implode("," ,$result_role);
             }
         
        
            foreach($projectmodel as $hdr_pk){
                $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                ->select([            
                'projapprovalworkflowdtls_pk'])
                ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                ->andwhere('pawfd_rolemst_fk in ('.$result_role_array.')')
                ->asArray()
                ->all();
              

                foreach($projectworkflowtable as $workflow_pk){
                    $workflow_pk = $workflow_pk['projapprovalworkflowdtls_pk'];
                    $model = ProjapprovalworkflowuserdtlsTbl::find()->where(['pawfud_projapprovalworkflowhrd_fk'=>$hdr_pk ,'pawfud_projapprovalworkflowdtls_fk' => $workflow_pk ,'pawfud_opalusermst_fk'=> $userid ])->one();
                    if($model){
                        \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
                        $model->delete();
                        \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();

                    }
                }
            }
        }

        foreach($data as $projectid){
            if(in_array($projectid , $mst_projectpk)){
            $projectmodel = ProjapprovalworkflowhrdTbl::find()
            ->select([            
            'projapprovalworkflowhrd_pk'])
            ->where("pawfh_projectmst_fk = $projectid")
            ->asArray()
            ->all();
            foreach($projectmodel as $hdr_pk){
                $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                ->select([            
                'projapprovalworkflowdtls_pk'])
                ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                ->andwhere('pawfd_rolemst_fk in ('.implode(", " , $arrole).')')
                ->asArray()
                ->all();
                foreach($projectworkflowtable as $workflow_pk){
                    $workflow_pk = $workflow_pk['projapprovalworkflowdtls_pk'];
                    $model = ProjapprovalworkflowuserdtlsTbl::find()->where(['pawfud_projapprovalworkflowhrd_fk'=>$hdr_pk ,'pawfud_projapprovalworkflowdtls_fk' => $workflow_pk ,'pawfud_opalusermst_fk'=> $userid ])->one();
                    if($model){
                        $model->pawfh_updatedon = $date;
                        $model->pawfh_updatedby = $userPk;  
                        $model->save();

                    }else{
                        $model=new ProjapprovalworkflowuserdtlsTbl();
                        $model->pawfud_projapprovalworkflowdtls_fk  = $workflow_pk;
                        $model->pawfud_projapprovalworkflowhrd_fk  = $hdr_pk;
                        $model->pawfud_opalusermst_fk = $userid;        
                        $model->pawfh_createdon = $date;
                        $model->pawfh_createdby = $userPk;  
                        if($model->save())
                        {
                        }
                        else
                        {
                            echo "<pre>";
                            var_dump($model->getErrors());
                      }
                    }
                }
            }
        }
        }
        
    }


    public function checkapprovaldata($userid , $msetdata ){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $data = $msetdata['arproject'];
        $arrole_org = $msetdata['arroles'];
        foreach($arrole_org as $role){
        $userAccess = RoleallocationdtlsTbl::getUserPermission($role);
        $role_check= [];
        foreach($userAccess as $access){
            if (in_array('1', $data)) {
                    if($access['rad_OpalModuleMst_FK'] ==  '6' && $access['rad_OpalSubModuleMst_FK'] ==  '10'){
                     $role_check[] = '10'; 
                    $array = json_decode($access['rad_Access']);
                    if (!in_array('2', $array) || !in_array('5', $array)) {
                      
                    }
                    }
            }
            if (in_array('2', $data) || in_array('3', $data) ){
                if($access['rad_OpalModuleMst_FK'] ==  '6' && $access['rad_OpalSubModuleMst_FK'] ==  '11'){
                    $role_check[]  = '11';
                $array = json_decode($access['rad_Access']);
                if (!in_array('2', $array) || !in_array('5', $array)) {

                }
                }
          }
        if (in_array('4', $data)) {
            if($access['rad_OpalModuleMst_FK'] ==  '6' && $access['rad_OpalSubModuleMst_FK'] ==  '12'){
                $role_check[] = 12;
            $array = json_decode($access['rad_Access']);
            if (!in_array('2', $array) || !in_array('5', $array)) {

            }
            }
        }
        }
        if(!empty($role_check)){
            $arrole[] = $role;
        }
    }
        
        $arprojectpk = $msetdata['arprojectpk'];
        $date=date('Y-m-d H:i:s');
        $returndata = true;

        $desktop =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority =   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];

        //course
        $desktop_course =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment_course =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor_course =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager_course =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority_course =   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo_course =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];

        //ras

        $desktop_ras =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment_ras =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor_ras =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager_ras =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority_ras=   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo_ras =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];
 
        if(empty($arprojectpk)){    
            $returndata = true;
            return  $returndata;
        }
        foreach($data as $projectid){ 
            if(in_array($projectid , $arprojectpk)){
            if($projectid == '1' && (in_array($payment, $arrole) || in_array($auditor, $arrole) || in_array($ceo, $arrole))){
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->andwhere("pawfh_formstatus in (1,4)")  
                ->asArray()
                ->all();
            }else if($projectid == '4' && (in_array($payment_ras, $arrole) || in_array($auditor_ras, $arrole) || in_array($ceo_ras, $arrole))){
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->andwhere("pawfh_formstatus in (1,3,4)")  
                ->asArray()
                ->all();
            }else if($projectid == '2' && (in_array($payment_course, $arrole) || in_array($auditor_course, $arrole))){
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->andwhere("pawfh_formstatus in (1,3,4)")  
                ->asArray()
                ->all();
            }else if($projectid == '3' && (in_array($payment_course, $arrole) || in_array($auditor_course, $arrole))){
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->andwhere("pawfh_formstatus in (1,3,4)")  
                ->asArray()
                ->all();
            }else if(($projectid == '2' || $projectid == '3') && in_array($ceo_course, $arrole)){
                    $returndata = true;
            }else{
                $projectmodel = ProjapprovalworkflowhrdTbl::find()
                ->select([            
                'projapprovalworkflowhrd_pk'])
                ->where("pawfh_projectmst_fk = $projectid")
                ->asArray()
                ->all();

            }
           
          
            foreach($projectmodel as $hdr_pk){
                $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                foreach($arrole  as $role){
                    $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                    ->select([            
                    'projapprovalworkflowdtls_pk'])
                    ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                    ->andwhere("pawfd_rolemst_fk =  $role")
                    ->asArray()
                    ->all();  

                }
            
                if(empty($projectworkflowtable)){

                    $returndata = false;
                }

            }
        }
     }

        return $returndata;
       
        
    }

    public function checkapprovalrole($userdata , $rolepk){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $returndata = true;
        //training centre
        $desktop =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority =   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];

        //course
        $desktop_course =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment_course =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor_course =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager_course =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority_course =   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo_course =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];

        //ras

        $desktop_ras =  \Yii::$app->params['project']['trainingcentre']['desktop_id'];
        $payment_ras =  \Yii::$app->params['project']['trainingcentre']['payment_id'];
        $auditor_ras =   \Yii::$app->params['project']['trainingcentre']['auditor_id'];
        $qualitymanager_ras =  \Yii::$app->params['project']['trainingcentre']['qualitymanager_id'];
        $authority_ras=   \Yii::$app->params['project']['trainingcentre']['authority_id'];
        $ceo_ras =   \Yii::$app->params['project']['trainingcentre']['ceo_id'];
        foreach($userdata as $moduledata){ 
            if($moduledata->module== '6' && $moduledata->submodule == '10' && $moduledata->type == '5'){
              if($rolepk){
                  if(($rolepk ==  $payment || $rolepk ==  $auditor || $rolepk ==  $ceo)){
                    $projectmodel = ProjapprovalworkflowhrdTbl::find()
                    ->select([            
                    'projapprovalworkflowhrd_pk'])
                    ->where("pawfh_projectmst_fk = 1")
                    ->andwhere("pawfh_formstatus in (1,4)")  
                    ->asArray()
                    ->all();
                  }else{

                    $projectmodel = ProjapprovalworkflowhrdTbl::find()
                    ->select([            
                    'projapprovalworkflowhrd_pk'])
                    ->where("pawfh_projectmst_fk = 1")
                    ->asArray()
                    ->all();
                  }
               
                foreach($projectmodel as $hdr_pk){
                    $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                        $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                        ->select([            
                        'projapprovalworkflowdtls_pk'])
                        ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                        ->andwhere("pawfd_rolemst_fk =  $rolepk")
                        ->asArray()
                        ->all();       
                        if(empty($projectworkflowtable)){

                        $returndata = false;
                        }

                    }
             }else{
                $returndata = false;
             }
            }
            

            if($moduledata->module == '6' && $moduledata->submodule == '11' && $moduledata->type== '5'){
                if($rolepk){
                if($rolepk == $ceo_course){
                    $returndata = true;
                }else if(($rolepk ==  $payment_course || $rolepk ==  $auditor_course)){
                    $projectmodel = ProjapprovalworkflowhrdTbl::find()
                    ->select([            
                    'projapprovalworkflowhrd_pk'])
                    ->where("pawfh_projectmst_fk = 1")
                    ->andwhere("pawfh_formstatus in (1,3,4)")  
                    ->asArray()
                    ->all();
                }else{
                    $projectmodel = ProjapprovalworkflowhrdTbl::find()
                    ->select([            
                    'projapprovalworkflowhrd_pk'])
                    ->where("pawfh_projectmst_fk in (2,3)")
                    ->asArray()
                    ->all();
                    foreach($projectmodel as $hdr_pk){
                        $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                            $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                            ->select([            
                            'projapprovalworkflowdtls_pk'])
                            ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                            ->andwhere("pawfd_rolemst_fk =  $rolepk")
                            ->asArray()
                            ->all();    
                        if(empty($projectworkflowtable)){
    
                        $returndata = false;
                        }
    
                    }

                }  
             }else{
              
                $returndata = false;   
             }
            }
            if($moduledata->module == '6' && $moduledata->submodule == '12' && $moduledata->type == '5'){
                if($rolepk){
                 if(($rolepk ==  $payment_ras || $rolepk ==  $auditor_ras || $rolepk ==  $ceo_ras)){
                        $projectmodel = ProjapprovalworkflowhrdTbl::find()
                        ->select([            
                        'projapprovalworkflowhrd_pk'])
                        ->where("pawfh_projectmst_fk = 1")
                        ->andwhere("pawfh_formstatus in (1,3,4)")  
                        ->asArray()
                        ->all();
                }else{

                    $projectmodel = ProjapprovalworkflowhrdTbl::find()
                    ->select([            
                    'projapprovalworkflowhrd_pk'])
                    ->where("pawfh_projectmst_fk = 4")
                    ->asArray()
                    ->all();

                }
               
                foreach($projectmodel as $hdr_pk){
                    $hdr_pk = $hdr_pk['projapprovalworkflowhrd_pk'];
                        $projectworkflowtable = ProjapprovalworkflowdtlsTbl::find()
                        ->select([            
                        'projapprovalworkflowdtls_pk'])
                        ->where("pawfd_projapprovalworkflowhrd_fk = $hdr_pk")
                        ->andwhere("pawfd_rolemst_fk =  $rolepk")
                        ->asArray()
                        ->all();  
                        if(empty($projectworkflowtable)){
                        $returndata = false;
                        }

                    }
             }else{
                $returndata = false;  
             }
            }
           
        }
        return $returndata;
    
    }   
    
}
