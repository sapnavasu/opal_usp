<?php

namespace app\models;

use Yii;
use app\models\OpalmemberregmstTbl;
use app\models\ApplicationdtlstmpTbl;
use api\components\Security;

/**
 * This is the model class for table "opalusermst_tbl".
 *
 * @property int $opalusermst_pk primary key
 * @property int $oum_opalmemberregmst_fk refer to opalmemberregmst_tbl
 * @property string $oum_firstname
 * @property string $oum_loginId
 * @property string $oum_password
 * @property int $oum_isfocalpoint 1 - yes, 2 - no
 * @property int $oum_opaldesignationmst_fk reference to opaldesignationmst_tbl
 * @property int $oum_gender 1 - male, 2 - female
 * @property string $oum_dob date of birth
 * @property string $oum_emailid
 * @property string $oum_otpmail otp sent to mail
 * @property string $oum_otpexpiredon expiry of otp
 * @property int $oum_emailconfirmstatus 1 - Yes, 2 - No
 * @property string $oum_emailconfirmedon email confimred on
 * @property string $oum_mobnocc refer to opalcountrymst_tbl towards ocym_countrydialcode for mobile number 
 * @property string $oum_mobno mobile no
 * @property string $oum_status a' - active,'i' - inactive(cancel by user), 'd' -deactivate
 * @property string $oum_passwordexpiry next password expiry date will be updated here
 * @property string $oum_gcmid mobile gcm id
 * @property string $oum_apnid apple push notification id
 * @property string $oum_createdon datetime of creation
 * @property string $oum_createdby reference to opalusemst_tbl
 * @property string $oum_createdbyipaddr IP Address of the user
 * @property string $oum_updatedon datetime of updation
 * @property string $oum_updatedby reference to opalusermst_tbl
 * @property string $oum_updatedbyipaddr IP Address of the user
 * @property int $oum_fgtpasswordattempt Forgot Password attempt count max 3 /day
 * @property string $oum_fgtpasswordattempton Forgot Password attempt date and time
 *
 * @property OpalmemberregmstTbl $oumOpalmemberregmstFk
 */
class OpalusermstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalusermst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oum_opalmemberregmst_fk', 'oum_isfocalpoint', 'oum_opaldesignationmst_fk', 'oum_gender', 'oum_emailconfirmstatus', 'oum_fgtpasswordattempt'], 'integer'],
            [['oum_firstname', 'oum_status', 'oum_createdon', 'oum_createdby'], 'required'],
            [['oum_password', 'oum_status'], 'string'],
            [['oum_dob', 'oum_otpexpiredon', 'oum_emailconfirmedon', 'oum_passwordexpiry', 'oum_createdon', 'oum_updatedon', 'oum_fgtpasswordattempton'], 'safe'],
            [['oum_firstname', 'oum_apnid', 'oum_createdby'], 'string', 'max' => 100],
            [['oum_loginId', 'oum_updatedby'], 'string', 'max' => 45],
            [['oum_emailid'], 'string', 'max' => 255],
            [['oum_otpmail'], 'string', 'max' => 10],
            [['oum_mobnocc'], 'string', 'max' => 5],
            [['oum_mobno'], 'string', 'max' => 20],
            [['oum_gcmid'], 'string', 'max' => 250],
            [['oum_createdbyipaddr', 'oum_updatedbyipaddr'], 'string', 'max' => 50],
            [['oum_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['oum_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalusermst_pk' => 'Opalusermst Pk',
            'oum_opalmemberregmst_fk' => 'Oum Opalmemberregmst Fk',
            'oum_firstname' => 'Oum Firstname',
            'oum_loginId' => 'Oum Login ID',
            'oum_password' => 'Oum Password',
            'oum_isfocalpoint' => 'Oum Isfocalpoint',
            'oum_opaldesignationmst_fk' => 'Oum Opaldesignationmst Fk',
            'oum_gender' => 'Oum Gender',
            'oum_dob' => 'Oum Dob',
            'oum_emailid' => 'Oum Emailid',
            'oum_otpmail' => 'Oum Otpmail',
            'oum_otpexpiredon' => 'Oum Otpexpiredon',
            'oum_emailconfirmstatus' => 'Oum Emailconfirmstatus',
            'oum_emailconfirmedon' => 'Oum Emailconfirmedon',
            'oum_mobnocc' => 'Oum Mobnocc',
            'oum_mobno' => 'Oum Mobno',
            'oum_status' => 'Oum Status',
            'oum_passwordexpiry' => 'Oum Passwordexpiry',
            'oum_gcmid' => 'Oum Gcmid',
            'oum_apnid' => 'Oum Apnid',
            'oum_createdon' => 'Oum Createdon',
            'oum_createdby' => 'Oum Createdby',
            'oum_createdbyipaddr' => 'Oum Createdbyipaddr',
            'oum_updatedon' => 'Oum Updatedon',
            'oum_updatedby' => 'Oum Updatedby',
            'oum_updatedbyipaddr' => 'Oum Updatedbyipaddr',
            'oum_fgtpasswordattempt' => 'Oum Fgtpasswordattempt',
            'oum_fgtpasswordattempton' => 'Oum Fgtpasswordattempton',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOumOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'oum_opalmemberregmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalusermstTblQuery the active query used by this AR class.
     */


    public static function saveFocalpointDtls($data, $regpk)
    {

        $userdlts = [];
        $regdtls = OpalmemberregmstTbl::findOne($regpk);

        $model = new OpalusermstTbl();
        $model->oum_opalmemberregmst_fk = $regpk;
        $model->oum_firstname = $data['focalpoint_name'];
        $model->oum_loginId = $regdtls->omrm_regcode;
        $model->oum_isfocalpoint = 1;
        $model->oum_emailid = $data['focalpoint_emailid'];
        $model->oum_emailconfirmstatus = 2;
        $model->oum_mobnocc = '1';
        $model->oum_mobno = $data['focalpoint_mobno'];
        $model->oum_status = 'I';
        $model->oum_createdby = '1';
        $model->oum_createdon = date('Y-m-d H:i:s');
        $model->oum_createdbyipaddr = \api\components\Common::getIpAddress();

        if ($model->save()) {
            if ($model->oum_isfocalpoint == 1) {
                $response = self::genereateSetPasswordLink($model);
                $model = $response['model'];
                $resetlink = $response['resetlink'];
            }
            $designation = (string) OpaldesignationmstTbl::createNewDesig($data['focalpoint_desig'], $model->opalusermst_pk);
            if ($designation) {
                $model->oum_opaldesignationmst_fk = $designation;
            }

            if ($model->save()) {
                $userdlts = ['model' => $model, 'resetlink' => $resetlink];
                return $userdlts;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public static function genereateSetPasswordLink($model)
    {
        $model->oum_fgtpasswordattempt = 0;
        $model->oum_fgtpasswordattempton = \api\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
        $resetlink = \api\components\User::generateForgotMailLink($model, false, 'set');

        $model->save();

        $response = [
            'model' => $model,
            'resetlink' => $resetlink,
        ];

        return $response;
    }


    function login($loginid)
    {

        $data = OpalusermstTbl::find()
            ->select(['oum_opalmemberregmst_fk','oum_isfocalpoint','oum_rolemst_fk','oum_emailid', 'mr.omrm_crnumber', 'oum_loginId', 'oum_mobno', 'opalusermst_pk', 'oum_password','oum_status'])
            ->leftJoin('opalmemberregmst_tbl mr', 'mr.opalmemberregmst_pk = opalusermst_tbl.oum_opalmemberregmst_fk')

            ->andWhere('oum_status = "a" or oum_status = "e" or (oum_status = "i" && oum_emailconfirmstatus = 2)')

            ->andWhere('oum_loginId = "' . $loginid . '" or oum_emailid = "' . $loginid . '" or oum_idnumber = "' . $loginid . '" ')
            ->asArray()
            ->all();
          

        return $data;
    }

    function loginwithpass($loginid)
    {

        $data = OpalusermstTbl::find()
            ->select(['*', 'omrm_opalmembershipregnumber', 'omrm_branch_en', 'omrm_companyname_ar', 'omrm_stkholdertypmst_fk', 'omrm_companyname_en','odsg_opaldesignationname as designation'])
            ->leftJoin('opalmemberregmst_tbl', 'oum_opalmemberregmst_fk = opalmemberregmst_pk')
            ->leftJoin('opaldesignationmst_tbl', 'oum_opaldesignationmst_fk = opaldesignationmst_pk')
            ->andWhere('opalusermst_pk = "' . $loginid . '"')
            ->asArray()
            ->one();
        $appli_data = ApplicationdtlstmpTbl::getApplicationInfoByReg($data['opalmemberregmst_pk']);
        $data['apptemppk'] = $appli_data['applicationdtlstmp_pk'];
        $data['projectpk'] = $appli_data['appdt_projectmst_fk'];
        $data['apptype'] = $appli_data['appdt_apptype'];
        $data['appstatus'] = $appli_data['appdt_status'];
       // $data['userpermission'] = OpalusermstTblQuery::getuseraccess($data['opalusermst_pk']);
        return $data;
    }

    function logForgotPasswordAttempt($userpk, $type = null)
    {
        $attemptLimit = $baseUrl = \Yii::$app->params['fgtPwdMailAttemptLimit'];
        $OTPExpiryDuration = $baseUrl = \Yii::$app->params['OTPExpiryDuration'];
        $linkValidHrs = \Yii::$app->params['fgtPwdMailValidHrs'];
        $model = self::findOne($userpk);
        $model->oum_otpmail = (string) rand(1000, 5000);
        // $model->oum_otpmail = "1234";
        $endTime = strtotime("+{$OTPExpiryDuration} minutes", strtotime(date("Y-m-d H:i:s")));
        $edtime = date('Y-m-d H:i:s', $endTime);
        $model->oum_otpexpiredon = $edtime;

        if (!$model->save()) {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
        return $model;
    }


    public function sendForgotMail($dtl)
    {
        $response = self::genereateSetPasswordLink($dtl);
        $resetlink = $response['resetlink'];
        $resetlink= str_replace('type=set', 'type=reset', $resetlink);
        $userPk = $dtl->opalusermst_pk;
        $baseUrl = \Yii::$app->params['APP_URL'];
        $url = $baseUrl . "api/ma/mail/sendmail";
        $_data = [
            'type' => 'reqtochangepswcontent',
            'userpk' => $userPk,
            'link' => $resetlink,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => json_encode($_data),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return true;
    }

    public static function getForgotPassMailDtls($userPk)
    {
        $otpduration = \Yii::$app->params['OTP']['login']['expiryduration'];

        $model = OpalusermstTbl::find()
            ->select(["concat_ws(' ', oum_firstname) as name", "oum_otpmail", 'oum_emailid'])
            ->Where('opalusermst_pk =:userPk', array(':userPk' => $userPk))->asArray()->one();

        $data = [
            'email' => $model['oum_emailid'],
            'user_name' => $model['name'],
            'otp' => $model['oum_otpmail'],
            'duration' => $otpduration,

            'loginlink' => \Yii::$app->params['baseUrl'] . "admin/login",
        ];

        return $data;
    }


    public function checkValidOTP($userpk, $otp, $type = 'email')
    {
        $model = OpalusermstTbl::findOne($userpk);
        $currentDateTime = strtotime(date('Y-m-d H:i:s'));
        $curtime = date('Y-m-d h:i:sa');
        $expdatev = strtotime($model->oum_otpexpiredon);

        $otpExpiresOn = strtotime(date('Y-m-d H:i:s', strtotime($model->oum_otpexpiredon)));

        if ($model->oum_otpmail !== $otp) {
            return 2; //INVALID
        } else if (!empty($model) && ($expdatev >=  $curtime) && $model->oum_otpmail === $otp) {
            $model->oum_otpmail = NULL;
            $model->oum_otpexpiredon = NULL;

            $model->save();
            // }
            return 1;
        } else {
            return 3; //EXPIRED

        }
        die;
    }


    public function resetPassword($password, $userPk, $type = 'email',$difffocal)
    {
        $model = self::findOne($userPk);
        // $Regmodel = MemberregistrationmstTbl::findOne($model->UM_MemberRegMst_Fk);
        $decryptedPassword = Security::aesdecrypt($password);

        if (Security::aesdecrypt($model->oum_password) ==  $decryptedPassword) {
            return 'LTP';
        }
        if (strtolower($model->oum_loginId) !== strtolower($decryptedPassword)) {

            $oldpass = $model->oum_password;
            $model->oum_password = $password;

            $model->oum_fgtpasswordattempt = null;
            $model->oum_fgtpasswordattempton = null;

            $passexpdate = date('Y-m-d H:i:s', strtotime("+3 months", strtotime(date('Y-m-d H:i:s'))));
            $model->oum_passwordexpiry = $passexpdate;
            $model->oum_passwordchangedon = date('Y-m-d H:i:s');
            if ($model->save()) {
                $userPk = $model->opalusermst_pk;
                $baseUrl = \Yii::$app->params['APP_URL'];
                $url = $baseUrl . "api/ma/mail/sendmail";
                
                if(($model->oum_isfocalpoint == 2)&&(empty($oldpass))){
                    $_data = [
                        'type' => 'enterpriseadmintologin',
                        'userpk' => $userPk,
                    ];
                }else if(($model->oum_isfocalpoint == 1)&&(empty($oldpass))){
                    $_data = [
                        'type' => 'aftersetpasswordCrd',
                        'userpk' => $userPk,
                    ];
                }else if($difffocal == 'yes'){
                    $_data = [
                        'type' => 'differntfocalpoint_3',
                        'userpk' => $userPk,
                    ];
                }else{
                    $_data = [
                        'type' => 'sucessafterresetpw',
                        'userpk' => $userPk,
                    ];
                }
                $curlpass = curl_init();
                curl_setopt_array($curlpass, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => json_encode($_data),
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache",
                        "content-type: application/json",
                    ),
                ));
                $responsepass = curl_exec($curlpass);
                $err = curl_error($curlpass);
                curl_close($curlpass);

                return true;
            }
        } else {
            return 'UN'; //UN - Username Equals Password
        }
    }

    public static function confirmEmailStatus($model)
    {
        if ($model->oum_emailconfirmstatus == 2 || empty($model->oum_emailconfirmstatus)) {
            $model->oum_emailconfirmstatus = 1; //1 - confirmed
            $model->oum_status = 'a'; // a - Active
            $model->oum_emailconfirmedon = \api\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'));
            if ($model->save()) {
                $regModel = OpalmemberregmstTbl::findOne($model->oum_opalmemberregmst_fk);
                $regModel->omrm_memberStatus = 'a'; //a - Active
                $regModel->save();
            }
        }
        return $model;
    }

    public static function checkIsEmailAlreadyExists($dataToCheck, $usrpk = '', $stkholderType)
    {

        return self::find()
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->where('lower(oum_emailid) = :oum_emailid', [':oum_emailid' => $dataToCheck])
            ->andFilterWhere(['<>', 'opalusermst_pk', $usrpk])
            ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stkholderType])
            ->exists();
    }

    public static function getUserMstCacheQuery()
    {
        return self::find()
            ->select(['max(oum_updatedon), count(*)'])
            ->createCommand()
            ->getRawSql();
    }
    //user grid list  and search
 public static function getUsergridList(){
        $requestParam = $_GET;
    ini_set ( 'max_execution_time', 1200);
    $query = self::find();
    $query->select(['*',"concat_ws(' ', oum_firstname) as stafName",'oum_emailid as emailid','omrm_stkholdertypmst_fk as stakeholdertype',
        'oum_idnumber as civilNo','oum_mobno as mobilno','oum_status as status','omrm_intendforregistration as regtype',
        'DATE_FORMAT(oum_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(oum_updatedon,"%d-%m-%Y") as lastUpdateOn','oum_isthirdpartyagent as thirdPartyAgent','group_concat(DISTINCT rm_rolename_en separator ", ") as roleName_en','rm_projectmst_fk as projecttype',
        'group_concat(DISTINCT rm_rolename_ar separator ", ") as roleName_ar',
        'case when((oum_isthirdpartyagent= 1) AND oum_isthirdpartyagent is not NULL) THEN "Yes"
              when(oum_isthirdpartyagent=2 OR oum_isthirdpartyagent = NULL) THEN "No" END  as isthirdPartyAgent',
        'case when((oum_isfocalpoint= 1) AND oum_isfocalpoint is not NULL) THEN "Yes"
              when(oum_isfocalpoint =2 OR oum_isfocalpoint = NULL) THEN "No" END  as isfocalpoint',
        ])
        ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = oum_staffinforepo_fk')
        ->leftJoin('opalstkholdertypmst_tbl','opalstkholdertypmst_pk = omrm_stkholdertypmst_fk')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,oum_rolemst_fk)')
        ->groupBy('opalusermst_pk')
         ->all(); 
        if($requestParam['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true); 
            $stafName = $gridsearchValues['stafName'];
            $emailid = $gridsearchValues['emailid'];
            $stakeholdertype =  $gridsearchValues['stakeholdertype'];
            $civilNo = $gridsearchValues['oum_idnumber'];
            $companynm = $gridsearchValues['omrm_companyname_en'];
            $mobilno  = $gridsearchValues['mobilno'];
            $roleName_en = $gridsearchValues['roleName_en'];
            $status = $gridsearchValues['status'];
            $addedOn = $gridsearchValues['addedOn'];
            $lastUpdateOn = $gridsearchValues['lastUpdateOn'];
            $isthirdPartyAgent = $gridsearchValues['isthirdPartyAgent'];  
            $oum_isfocalpoint = $gridsearchValues['isfocalpoint'];  
            
            // $explrole = implode(',', $roleName_en);  
            if($stafName){ 
                $query->andFilterWhere(['LIKE', 'oum_firstname', $stafName]);
            }         
            if($emailid){
                $query->andFilterWhere(['LIKE', 'oum_emailid', $emailid]);
            }
         
            if($stakeholdertype){
                if($stakeholdertype == 1)
                {
                    $query->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stakeholdertype]);
                }
                else if($stakeholdertype == 2)
                {
                    $query->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stakeholdertype]);
                    $query->andFilterWhere(['or', ['=', 'omrm_intendforregistration', 1] , ['=', 'omrm_intendforregistration', 3]]);
//                    $query->andFilterWhere(['or', ['and', ['<>', 'rm_projectmst_fk', 4], ['<>', 'rm_projectmst_fk', 5]], ['rm_projectmst_fk' => null]]);
                    
                }
                else if($stakeholdertype == 3)
                {
                    $query->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', 2]);
                   $query->andFilterWhere(['or', ['=', 'omrm_intendforregistration', 2] , ['=', 'omrm_intendforregistration', 3]]);
//                    $query->andFilterWhere(['or', ['=', 'rm_projectmst_fk', 4], ['=', 'rm_projectmst_fk', 5]]);
                }
                
            }
            if($civilNo){
                $query->andFilterWhere(['=', 'oum_idnumber', $civilNo]);
            }        
            if($companynm){
                $query->andFilterWhere(['like', 'omrm_companyname_en', $companynm]);
            } 
            if($mobilno){
                $query->andFilterWhere(['=', 'oum_mobno', $mobilno]);
            }
            if($roleName_en){

                // $query->andFilterWhere(['IN', 'rm_rolename_en', explode(',', $explrole)]);
                $query->andFilterWhere(['LIKE', 'rm_rolename_en', $roleName_en]);
            }
            if($status){
                $query->andFilterWhere(['LIKE', 'oum_status', $status]);
            }        
            if($isthirdPartyAgent ){
                $query->andFilterWhere(['=', 'oum_isthirdpartyagent ', $isthirdPartyAgent ]);
            }
            if($oum_isfocalpoint){
                $query->andFilterWhere(['=', 'oum_isfocalpoint ', $oum_isfocalpoint ]);
            }
            if($addedOn && $addedOn!=null ){
               $dattime = date('Y-m-d',strtotime($addedOn));
               $query->andWhere(['=', 'DATE(oum_createdon)', $dattime]);
            }
            if($lastUpdateOn && $lastUpdateOn!=null ) {  
                $dattime = date('Y-m-d',strtotime($lastUpdateOn));
               $query->andWhere(['LIKE', 'DATE(oum_updatedon)', date('Y-m-d',strtotime($dattime))]);
            }
        }
        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];
        $order_by = ($requestParam['order']=='asc')? 'asc': 'desc';
        $query->orderBy("$sort_column $order_by");
        $query->asArray();
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
        $data = $provider->getModels();
        
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
}
//user center list and  search
 public static function getUserCentergridList(){
        $requestParam = $_GET;
    ini_set ( 'max_execution_time', 1200);
     $regPk =  \yii\db\ActiveRecord::getTokenData('opalmemberregmst_pk', true);
      $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
     $userProjPk = OpalusermstTbl::findOne($userPk)->oum_projectmst_fk  ;
   
      
    $query = self::find();
    $query->select(['*',"concat_ws(' ', oum_firstname) as stafName",'oum_emailid as emailid',
        'oum_idnumber as civilNo','oum_mobno as mobilno','oum_status as status',
        'DATE_FORMAT(oum_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(oum_updatedon,"%d-%m-%Y") as lastUpdateOn',
        'group_concat(DISTINCT rm_rolename_en separator ", ") as roleName_en',
        'group_concat(DISTINCT rm_rolename_ar separator ", ") as roleName_ar',
        ])
        ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->leftJoin('staffinforepo_tbl','staffinforepo_pk = oum_staffinforepo_fk')
        ->leftJoin('opalstkholdertypmst_tbl','opalstkholdertypmst_pk = omrm_stkholdertypmst_fk')
        ->leftJoin('rolemst_tbl','find_in_set(rolemst_pk,oum_rolemst_fk)')
        ->where("opalmemberregmst_pk=:regpk",[':regpk'=>$regPk]);
    if($userProjPk){
         $userProjPks = explode(',',$userProjPk);
         $query->andWhere(["IN","rm_projectmst_fk" ,$userProjPks]);
    }
     $query->andWhere("oum_isfocalpoint=:focalpoint",[':focalpoint'=>2])
        ->groupBy('opalusermst_pk')
         ->all(); 
        if($requestParam['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);              
            $stafName = trim($gridsearchValues['stafName']);
            $emailid = trim($gridsearchValues['emailid']);
            $civilNo = trim($gridsearchValues['oum_idnumber']);
            $mobilno  = trim($gridsearchValues['mobilno']);
            $roleName_en = trim($gridsearchValues['roleName_en']);
            $status = $gridsearchValues['status'];
            $addedOn = $gridsearchValues['addedOn'];
            $lastUpdateOn = $gridsearchValues['lastUpdateOn'];
            if($stafName) { 
                    $query->andFilterWhere(['LIKE', 'oum_firstname', $stafName]);
            }         
            if($emailid) {
                $query->andFilterWhere(['LIKE', 'oum_emailid', $emailid]);
            }         
            if($civilNo){
                $query->andFilterWhere(['=', 'oum_idnumber', $civilNo]);
            }        
            if($mobilno){
                $query->andFilterWhere(['=', 'oum_mobno', $mobilno]);
            }
            if($roleName_en){
                $query->andFilterWhere(['LIKE', 'rm_rolename_en', $roleName_en]);
            }
            if($status){
                $query->andFilterWhere(['=', 'oum_status', $status]);
            }    
            if($addedOn && $addedOn!=null ){
                //Submitted On Date Filter
               $dattime = date('Y-m-d',strtotime($addedOn));
               $query->andWhere( ['=', 'DATE(oum_createdon)', $dattime]);
            }
            if($lastUpdateOn && $lastUpdateOn!=null ) {  
                $dattime = date('Y-m-d',strtotime($lastUpdateOn));
               $query->andWhere(['LIKE', 'DATE(oum_updatedon)', date('Y-m-d',strtotime($dattime))]);
            }
        }
        $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];
        $order_by = ($requestParam['order']=='asc')? 'asc': 'desc';
        $query->orderBy("$sort_column $order_by");
        $query->asArray();
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
        $data = $provider->getModels();
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;    
}

                  

    public static function sendUserCreatedMail($data, $typeOfCreation,$link='') {
          
                $userPk = $data;
                $baseUrl = \Yii::$app->params['APP_URL'];
                $url = $baseUrl . "api/ma/mail/sendmail";
                $_data = [
                    'type'=>$typeOfCreation,
                    'userpk'=>$userPk,
                    'link'=>$link,
                ];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_POSTFIELDS => json_encode($_data),
                        CURLOPT_HTTPHEADER => array(
                                "cache-control: no-cache",
                                "content-type: application/json",
                        ),
                ));
               
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
            }
    public static function getUserInfoByReg($regPk){
        $result = self::find()
            ->select(['oum_firstname as firstname','oum_mobno as mobileno','cntry.ocym_countryname_en as countryname','mcode.ocym_countrydialcode as mobilecode',
            'osm_statename_en as statename','ocim_cityname_en as cityname'])
            ->leftJoin('opalmemberregmst_tbl','opalmemberregmst_pk = oum_opalmemberregmst_fk')            
            ->leftJoin('opalcountrymst_tbl cntry','cntry.opalcountrymst_pk = omrm_opalcountrymst_fk')            
            ->leftJoin('opalcountrymst_tbl mcode','mcode.opalcountrymst_pk = oum_mobnocc')            
            ->leftJoin('opalstatemst_tbl','opalstatemst_pk = omrm_opalstatemst_fk')            
            ->leftJoin('opalcitymst_tbl','opalcitymst_pk = omrm_opalcitymst_fk')            
            ->where('oum_opalmemberregmst_fk=:regpk and oum_status = :status', [':status' => 'A',':regpk'=>$regPk])
            ->asArray()->one();
        return $result;
    }     
    // oum_idnumber   
    public static function checkIsCivilOrEmailAlreadyExists($dataToCheck, $usrpk = '', $stkholderType,$type)
    { 
        // echo 'ok';exit;
        if($type=='emailid'){
        return self::find()
        ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
        ->where('lower(oum_emailid) = :oum_emailid', [':oum_emailid' => $dataToCheck])
        ->andFilterWhere(['<>', 'opalusermst_pk', $usrpk])
        ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stkholderType])
        ->exists();

    }else{
        return self::find()
            ->leftJoin('opalmemberregmst_tbl', 'opalmemberregmst_pk = oum_opalmemberregmst_fk')
            ->where('lower(oum_idnumber) = :oum_idnumber', [':oum_idnumber' => $dataToCheck])
            ->andFilterWhere(['<>', 'opalusermst_pk', $usrpk])
            ->andFilterWhere(['=', 'omrm_stkholdertypmst_fk', $stkholderType])
            ->exists();
        }
    }
    public static function getstaffuserTbl($infopk){
       
        return self::find()
        ->where('oum_staffinforepo_fk = :staffinfo_pk', [':staffinfo_pk' => $infopk])
        ->andWhere(['<>','oum_status','I'])
        ->exists(); 
    }
  function getuseraccess($userpk){
       $modal = OpalusermstTblQuery::getuseraccess($userpk);
       return $modal;



}}
