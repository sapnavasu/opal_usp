<?php

namespace api\modules\mst\models;

use Yii;
use \common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;
use common\models\UsermstTbl;

/**
 * This is the model class for table "licensinginfo_tbl".
 *
 * @property int $licensinginfo_pk Primary key
 * @property int $li_sectormst_fk Reference to sectormst_tbl
 * @property int $li_industrymst_fk Reference to industrymst_tbl
 * @property int $li_licproceduremst_fk Reference to licproceduremst_tbl
 * @property int $li_memberregmst_fk Reference to memberregistrationmst_tbl. Authorized Person to Approve the license
 * @property string $li_referenceno Reference No
 * @property int $li_status License status. 1 - Active, 2 - InActive, 3 - Deleted
 * @property string $li_intrefno Internal Reference No
 * @property string $li_validity Validity of the license
 * @property string $li_lictitleen License title in English
 * @property string $li_licdescen License Description in English
 * @property string $li_needoflicenseen Need of license in English
 * @property string $li_applicableen Applicable in English
 * @property string $li_processen Process in English
 * @property int $li_targetdurationtype 1 - Days, 2 - Weeks, 3 - Months, 4 - Years,5-Others
 * @property string $li_targetduration Target duration in Numbers
 * @property string $li_licensefeeen License Fee in English
 * @property string $li_docneedprocessen Documents to be attached in English
 * @property string $li_guaranteesen Guarantees in English
 * @property string $li_advisoriesen Advisories in English
 * @property string $li_servreqchanen Service request channels in English
 * @property string $li_servvalidityen Service validity in English
 * @property string $li_createdon Record created on date & time
 * @property int $li_createdby Record created by user id
 * @property string $li_createdbyipaddr IP Address of the user
 * @property string $li_updatedon Record updated on date & time
 * @property int $li_updatedby Record updated by user id
 * @property string $li_updatedbyipaddr IP Address of the user
 * @property int $li_deletedby Record deleted by user id
 * @property string $li_deletedon Record deleted on datetime
 * @property string $li_deletedbyipaddr IP Address of the user
 *
 * @property LicauthdtlsTbl[] $licauthdtlsTbls
 * @property UsermstTbl $liCreatedby
 * @property UsermstTbl $liDeletedby
 * @property LicproceduremstTbl $liLicproceduremstFk
 * @property MemberregistrationmstTbl $liMemberregmstFk
 * @property SectormstTbl $liSectormstFk
 * @property UsermstTbl $liUpdatedby
 */
class LicensinginfoTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licensinginfo_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['li_sectormst_fk', 'li_industrymst_fk', 'li_licproceduremst_fk', 'li_memberregmst_fk', 'li_status', 'li_targetdurationtype', 'li_createdby', 'li_updatedby', 'li_deletedby'], 'integer'],
            [['li_referenceno', 'li_createdon', 'li_createdby'], 'required'],
            [['li_validity', 'li_createdon', 'li_updatedon', 'li_deletedon'], 'safe'],
            [['li_lictitleen', 'li_licdescen', 'li_needoflicenseen', 'li_applicableen', 'li_processen', 'li_licensefeeen', 'li_docneedprocessen', 'li_guaranteesen', 'li_advisoriesen', 'li_servreqchanen', 'li_servvalidityen'], 'string'],
            [['li_referenceno', 'li_intrefno'], 'string', 'max' => 30],
            [['li_targetduration'], 'string', 'max' => 100],
            [['li_createdbyipaddr', 'li_updatedbyipaddr', 'li_deletedbyipaddr'], 'string', 'max' => 50],
            [['li_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['li_createdby' => 'UserMst_Pk']],
            [['li_deletedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['li_deletedby' => 'UserMst_Pk']],
            [['li_licproceduremst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => LicproceduremstTbl::className(), 'targetAttribute' => ['li_licproceduremst_fk' => 'licproceduremst_pk']],
            [['li_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemberregistrationmstTbl::className(), 'targetAttribute' => ['li_memberregmst_fk' => 'MemberRegMst_Pk']],
            [['li_sectormst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => SectormstTbl::className(), 'targetAttribute' => ['li_sectormst_fk' => 'SectorMst_Pk']],
            [['li_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['li_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licensinginfo_pk' => 'Licensinginfo Pk',
            'li_sectormst_fk' => 'Li Sectormst Fk',
            'li_industrymst_fk' => 'Li Industrymst Fk',
            'li_licproceduremst_fk' => 'Li Licproceduremst Fk',
            'li_memberregmst_fk' => 'Li Memberregmst Fk',
            'li_referenceno' => 'Li Referenceno',
            'li_status' => 'Li Status',
            'li_intrefno' => 'Li Intrefno',
            'li_validity' => 'Li Validity',
            'li_lictitleen' => 'Li Lictitleen',
            'li_licdescen' => 'Li Licdescen',
            'li_needoflicenseen' => 'Li Needoflicenseen',
            'li_applicableen' => 'Li Applicableen',
            'li_processen' => 'Li Processen',
            'li_targetdurationtype' => 'Li Targetdurationtype',
            'li_targetduration' => 'Li Targetduration',
            'li_licensefeeen' => 'Li Licensefeeen',
            'li_docneedprocessen' => 'Li Docneedprocessen',
            'li_guaranteesen' => 'Li Guaranteesen',
            'li_advisoriesen' => 'Li Advisoriesen',
            'li_servreqchanen' => 'Li Servreqchanen',
            'li_servvalidityen' => 'Li Servvalidityen',
            'li_createdon' => 'Li Createdon',
            'li_createdby' => 'Li Createdby',
            'li_createdbyipaddr' => 'Li Createdbyipaddr',
            'li_updatedon' => 'Li Updatedon',
            'li_updatedby' => 'Li Updatedby',
            'li_updatedbyipaddr' => 'Li Updatedbyipaddr',
            'li_deletedby' => 'Li Deletedby',
            'li_deletedon' => 'Li Deletedon',
            'li_deletedbyipaddr' => 'Li Deletedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicauthdtlsTbls()
    {
        return $this->hasMany(LicauthdtlsTbl::className(), ['lad_licensinginfo_fk' => 'licensinginfo_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'li_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiDeletedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'li_deletedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiLicproceduremstFk()
    {
        return $this->hasOne(LicproceduremstTbl::className(), ['licproceduremst_pk' => 'li_licproceduremst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'li_memberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiSectormstFk()
    {
        return $this->hasOne(SectormstTbl::className(), ['SectorMst_Pk' => 'li_sectormst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLiUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'li_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return LicensinginfoTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicensinginfoTblQuery(get_called_class());
    }
    
    public static function getLicensData($requestdata){
        $query = LicensinginfoTbl::find();
        $type = Security::sanitizeInput($requestdata['type'], "string");
        $size = Security::sanitizeInput($requestdata['size'], "number");
        if($type=='filter'){
            unset($requestdata['type']);
            unset($requestdata['sort']);
            unset($requestdata['order']);
            unset($requestdata['page']);
            unset($requestdata['size']);
            foreach(array_filter($requestdata) as $key =>$val)
            {
                
                if(!is_null($val))
                {
                  
                    if($key=="li_createdon")
                    {
                
                       $query->andWhere("date(if(li_updatedon IS NULL, li_createdon,li_updatedon))='$val'");
                    }else{
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true), $val]);
                    
                    }
                }
            }
        }
        $query->select(['licensinginfo_tbl.*']);
        $query->andWhere(['<>','li_status', 3]);
        $query->asArray();
        $page=(isset($size))?$size:10;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        $model = LicensinginfoTbl::find()
        ->select(['licensinginfo_pk'])
        ->Where(['<>','li_status', 3])
        ->asArray()->all();
        
        $response = array();
        $response['data'] = $provider->getModels();
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        $response['total_entry'] = count($model);
        return $response;
    }
    public static function addlicenseData($data){   
        $ip_address = Common::getIpAddress();
        $date= date('Y-m-d H:i:s');
        $userPk =Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true), "number");
        $formArray = $data['licenseForm'];  
        $licensePk =Security::decrypt($formArray['licensinginfo_pk']);
        $licensePk =Security::sanitizeInput($licensePk, "number");
        if(empty($licensePk)){
            $model = LicensinginfoTbl::find()->where('li_referenceno = :li_referenceno',[':li_referenceno'=> Security::sanitizeInput($formArray['li_referenceno'], "string")])->asArray()->one();
            if(!empty($model)){
                return "dup";
            }
            $model = new LicensinginfoTbl();
            $model->li_status = 1;
            $model->li_createdon = $date;
            $model->li_createdby = $userPk;
            $model->li_createdbyipaddr = $ip_address;
        }  else {            
            $model = LicensinginfoTbl::find()->where(['licensinginfo_pk' => $licensePk])->one();    
            $model->li_updatedon = $date;
            $model->li_updatedby = $userPk;
            $model->li_updatedbyipaddr = $ip_address;
        }
            $model->li_sectormst_fk = Security::sanitizeInput($formArray['li_sectormst_fk'], "number");
            $model->li_industrymst_fk = Security::sanitizeInput($formArray['li_industrymst_fk'], "number");
            $model->li_licproceduremst_fk = Security::sanitizeInput($formArray['li_licproceduremst_fk'], "number");
            $model->li_memberregmst_fk = Security::sanitizeInput($formArray['li_stkholdregistration_fk'], "number");
            $model->li_referenceno = Security::sanitizeInput($formArray['li_referenceno'], "html");
            $model->li_intrefno = Security::sanitizeInput($formArray['li_intrefno'], "html");
            $model->li_lictitleen = Security::sanitizeInput($formArray['li_lictitleen'], "html");
            $model->li_licdescen = $formArray['li_licdescen'];
            $model->li_needoflicenseen = $formArray['li_needoflicenseen'];
            $model->li_targetdurationtype = Security::sanitizeInput($formArray['li_targetdurationtype'], "number");
            $model->li_targetduration = Security::sanitizeInput($formArray['li_targetduration'], "string");
            $model->li_licensefeeen = $formArray['li_licensefeeen'];
            $model->li_docneedprocessen = $formArray['li_docneedprocessen'];
            $model->li_guaranteesen = $formArray['li_guaranteesen'];
            $model->li_advisoriesen = $formArray['li_advisoriesen'];
            $model->li_servreqchanen = $formArray['li_servreqchanen'];
            $model->li_servvalidityen = $formArray['li_servvalidityen'];
        if ($model->save() === false) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->getErrors()
            );
            return json_encode($result);
        }  else {        
            if(empty($licensePk)){
            $fk=$model->licensinginfo_pk;
            $a= $data['list']; 
            $max=sizeof($a);
            if($max>0){
                for($i=0; $i<$max; $i++) { 
                    $model1 = new LicauthdtlsTbl();
                    $model1->lad_licensinginfo_fk = $fk;
                    $model1->lad_createdbyipaddr = $ip_address;
                    $model1->lad_createdon = $date;
                    $model1->lad_createdby = $userPk;
                    $model1->lad_licensauthoritiesmst_fk = $a[$i];
                    if ($model1->save() === false) {
                        $result=array(
                            'status' => 200,
                            'statusmsg' => 'warning',
                            'flag'=>'E',
                            'msg'=>'Something went wrong!',
                            'returndata' => $model1
                        );
                        return json_encode($result);
                    }
                }
            }
        }else{            
            $fk=$model->licensinginfo_pk;
            $updatem = LicauthdtlsTbl::deleteAll('lad_licensinginfo_fk=:lad_licensinginfo_fk',[':lad_licensinginfo_fk'=>$fk]);
            $a= $data['list'];
            $max=sizeof($a);
            for($i=0; $i<$max; $i++) { 
                $model1 = new LicauthdtlsTbl();
                $model1->lad_licensinginfo_fk = $fk;
                $model1->lad_createdbyipaddr = $ip_address;
                $model1->lad_createdon = $date;
                $model1->lad_createdby = $userPk;
                $model1->lad_licensauthoritiesmst_fk = $a[$i];
                if ($model1->save() === false) {
                    $result=array(
                        'status' => 200,
                        'statusmsg' => 'warning',
                        'flag'=>'E',
                        'msg'=>'Something went wrong!',
                        'returndata' => $model1
                    );
                    return json_encode($result);
                }
            }
        }
        if($formArray['licAuthorities']){
            if(!empty($formArray['licensinginfo_pk'])){
                $DeleteAuthModule = LicauthdtlsTbl::find()->where('lad_licensinginfo_fk=:lad_licensinginfo_fk',[':lad_licensinginfo_fk'=>$formArray['licensinginfo_pk']])->all();
                if($DeleteAuthModule){
                    foreach ($DeleteAuthModule as $module) {
                        if ($module->delete() === false) {
                            $result=array(
                                'status' => 200,
                                'statusmsg' => 'warning',
                                'flag'=>'E',
                                'msg'=>'Something went wrong!',
                                'returndata' => $module
                            );
                            return json_encode($result);
                        }
                    }
                }
            }
            foreach ($formArray['licAuthorities'] as $authoritiesVal){
                $licAuth = new LicauthdtlsTbl();
                $licAuth->lad_licensinginfo_fk = $model->licensinginfo_pk;;
                $licAuth->lad_licensauthoritiesmst_fk = Security::sanitizeInput($authoritiesVal, "number");
                $licAuth->lad_createdon = $date;
                $licAuth->lad_createdby = $userPk;
                $licAuth->lad_createdbyipaddr = $ip_address;
                if ($licAuth->save() === false) {
                    $result=array(
                        'status' => 200,
                        'statusmsg' => 'warning',
                        'flag'=>'E',
                        'msg'=>'Something went wrong!',
                        'returndata' => $licAuth
                    );
                    return json_encode($result);
                }
            }
        }
        if(empty($licensePk)){
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'license created successfully!',
                'returndata' => $model
            );
        }  else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'license Updated successfully!',
                'returndata' => $model
            );
        }
        return json_encode($result);
        }
    }
    public static function updatelicenseData($data){
        $params=[];           
        $ip_address = Common::getIpAddress();
        $id = Security::decrypt($data['updatestatus']);
        $id = Security::sanitizeInput($id, "number");
        $model = LicensinginfoTbl::find()->where('licensinginfo_pk=:licensinginfo_pk',[':licensinginfo_pk'=> $id ])->one();
        if($id){ 
            $status=($model->li_status=="1")?"2":"1";
            $model->li_status=$status;
            $model->li_updatedon=date('Y-m-d H:i:s');
            $model->li_updatedby=Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true), "number");
            $model->li_updatedbyipaddr=$ip_address;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'License updated successfully',
                'returndata' => $model->licensinginfo_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Something went wrong!',
                'returndata' => $model->licensinginfo_pk

            );
        }
        return json_encode($result);        
    }
    public static function editlicenseData($licensepk){
        $id = Security::decrypt($licensepk);
        $id = Security::sanitizeInput($id, "number");
        $model = LicensinginfoTbl::find()
                ->select(['licensinginfo_tbl.*','group_concat(lad_licensauthoritiesmst_fk) as pks'])
                ->leftJoin('licauthdtls_tbl','licensinginfo_pk=lad_licensinginfo_fk')
                ->where('licensinginfo_pk=:licensinginfo_pk',[':licensinginfo_pk'=> $id])->asArray()->one();
        if (empty($model)) {
            return [
            'msg' => "warning",
            'status' => 0,
            'items' => $model->getErrors(),
            ];
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }
    }
    
    public function getliclist($licval)
    {
//        echo "<pre>";
//        print_r(array_filter($licval));
//        exit;
        
//      return new ActiveDataProvider([
        $model= LicensinginfoTbl::find()
            ->select(['licensinginfo_pk as licenseid','li_lictitleen as licensename'])
            ->where(['=','li_status',1])
            ->orderBy('li_lictitleen ASC')
            ->asArray()->all();
        return $model;
//            ->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjt_projname', true), ':value',array(':value' =>  $licval['licenserefno'])],
//                      ['LIKE',Common::getTableWithPrefix('prjt_referenceno', true), ':value1',array(':value1' =>   $licval['sector'])],
//                      ['LIKE',Common::getTableWithPrefix('prjt_projectid', true), ':value2',array(':value2' =>   $licval['industry'])]])

//    ]);
    }
    public static function deleteLicenseData($licensepk){
        $ip_address = Common::getIpAddress();
        $id = Security::decrypt($licensepk);
        $id = Security::sanitizeInput($id, "number");
        $model = LicensinginfoTbl::find()->where('licensinginfo_pk=:licensinginfo_pk',[':licensinginfo_pk'=> $id])->one();
        $model->li_status="3";
        $model->li_deletedon=date('Y-m-d H:i:s');
        $model->li_deletedby=Security::sanitizeInput(\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true),'number');
        $model->li_deletedbyipaddr=$ip_address;
        if ($model->save(false)) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'license deleted successfully',
                'returndata' => $model->licensinginfo_pk
            );
        } else {
            $result=array(
                'status' => 422,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong',
            );
        }
        return json_encode($result);
    }
    public static function viewlicenseData($licensepk){
        $id = Security::decrypt($licensepk);
        $id = Security::sanitizeInput($id, "number");
        $ip_address = Common::getIpAddress();
        $model = LicensinginfoTbl::find()
                ->select('li_lictitleen,li_referenceno,li_intrefno,li_lictitleen,li_needoflicenseen,li_licdescen,li_licensefeeen,li_docneedprocessen,li_guaranteesen,li_advisoriesen,li_servreqchanen,li_servvalidityen,li_targetdurationtype,li_targetduration,IndM_IndustryName AS ssm_subsectorname,SecM_SectorName,lpm_procedurename_en')
                ->leftJoin('sectormst_tbl','SectorMst_Pk=li_sectormst_fk')
                ->leftJoin('industrymst_tbl','IndustryMst_Pk=li_industrymst_fk')
                ->leftJoin('licproceduremst_tbl','licproceduremst_pk=li_licproceduremst_fk')
                ->where('licensinginfo_pk=:licensinginfo_pk',[':licensinginfo_pk'=> $id])->asArray()->one();
        if (empty($model)) {
            return [
            'msg' => "warning",
            'status' => 0,
            'items' => $model->getErrors(),
            ];
        }else{
            return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($model)?$model:[],
            ];
        }
    }
}
