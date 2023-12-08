<?php

namespace app\models;

use api\components\Security;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use function GuzzleHttp\json_decode;

/**
 * This is the model class for table "appdeviceinfomain_tbl".
 *
 * @property int $appdeviceinfomain_pk
 * @property int $appdim_appdeviceinfotmp_fk Reference to appdeviceinfotmp_pk
 * @property int $appdim_opalmemberregmst_fk Reference to opalmemberregmst_pk
 * @property int $appdim_applicationdtlsmain_fk Reference to applicationdtlstmp_pk
 * @property int $appdim_appinstinfomain_fk Reference to appinstinfomain_pk
 * @property string $appdim_ivmsmanufacturer
 * @property string $appdim_modelno unique field
 * @property string $appdim_softwareversion Software Version
 * @property string $appdim_countryoforigin Reference to opalcountrymst_tbl, Country of Origin
 * @property string $appdim_tracertificateno TRA Certificate Number
 * @property string $appdim_traappcertupload Upload TRA Approval Certificate
 * @property string $appdim_traappvalidity TRA Approval Validity
 * @property string $appdim_vendorname Vendor Name (as in TRA Registration)
 * @property string $appdim_updatedon
 * @property int $appdim_updatedby
 *
 * @property AppdeviceinfohstyTbl[] $appdeviceinfohstyTbls
 * @property AppdeviceinfotmpTbl $appdimAppdeviceinfotmpFk
 * @property AppinstinfomainTbl $appdimAppinstinfomainFk
 * @property ApplicationdtlstmpTbl $appdimApplicationdtlstmpFk
 * @property OpalmemberregmstTbl $appdimOpalmemberregmstFk
 * @property AppivmsdocsubmissionmainTbl[] $appivmsdocsubmissionmainTbls
 * @property IvmsvehicleregdtlsTbl[] $ivmsvehicleregdtlsTbls
 * @property IvmsvehicleregdtlshstyTbl[] $ivmsvehicleregdtlshstyTbls
 */
class AppdeviceinfomainTbl extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appdeviceinfomain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdim_appdeviceinfotmp_fk', 'appdim_opalmemberregmst_fk', 'appdim_applicationdtlsmain_fk', 'appdim_appinstinfomain_fk', 'appdim_ivmsmanufacturer', 'appdim_modelno', 'appdim_softwareversion', 'appdim_countryoforigin', 'appdim_tracertificateno', 'appdim_traappvalidity', 'appdim_vendorname'], 'required'],
            [['appdim_appdeviceinfotmp_fk', 'appdim_opalmemberregmst_fk', 'appdim_applicationdtlsmain_fk', 'appdim_appinstinfomain_fk', 'appdim_updatedby'], 'integer'],
            [['appdim_ivmsmanufacturer', 'appdim_modelno', 'appdim_softwareversion', 'appdim_countryoforigin', 'appdim_tracertificateno', 'appdim_traappcertupload', 'appdim_vendorname'], 'string'],
            [['appdim_traappvalidity', 'appdim_updatedon'], 'safe'],
            [['appdim_appdeviceinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppdeviceinfotmpTbl::className(), 'targetAttribute' => ['appdim_appdeviceinfotmp_fk' => 'appdeviceinfotmp_pk']],
            [['appdim_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['appdim_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['appdim_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appdim_applicationdtlsmain_fk' => 'applicationdtlstmp_pk']],
            [['appdim_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['appdim_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appdeviceinfomain_pk' => 'Appdeviceinfomain Pk',
            'appdim_appdeviceinfotmp_fk' => 'Appdim Appdeviceinfotmp Fk',
            'appdim_opalmemberregmst_fk' => 'Appdim Opalmemberregmst Fk',
            'appdim_applicationdtlsmain_fk' => 'Appdim Applicationdtlstmp Fk',
            'appdim_appinstinfomain_fk' => 'Appdim Appinstinfomain Fk',
            'appdim_ivmsmanufacturer' => 'Appdim Ivmsmanufacturer',
            'appdim_modelno' => 'Appdim Modelno',
            'appdim_softwareversion' => 'Appdim Softwareversion',
            'appdim_countryoforigin' => 'Appdim Countryoforigin',
            'appdim_tracertificateno' => 'Appdim Tracertificateno',
            'appdim_traappcertupload' => 'Appdim Traappcertupload',
            'appdim_traappvalidity' => 'Appdim Traappvalidity',
            'appdim_vendorname' => 'Appdim Vendorname',
            'appdim_updatedon' => 'Appdim Updatedon',
            'appdim_updatedby' => 'Appdim Updatedby',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdeviceinfohstyTbls()
    {
        return $this->hasMany(AppdeviceinfohstyTbl::className(), ['appdih_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdimAppdeviceinfotmpFk()
    {
        return $this->hasOne(AppdeviceinfotmpTbl::className(), ['appdeviceinfotmp_pk' => 'appdim_appdeviceinfotmp_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdimAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'appdim_appinstinfomain_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdimApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'appdim_applicationdtlsmain_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppdimOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'appdim_opalmemberregmst_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAppivmsdocsubmissionmainTbls()
    {
        return $this->hasMany(AppivmsdocsubmissionmainTbl::className(), ['appidsm_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIvmsvehicleregdtlsTbls()
    {
        return $this->hasMany(IvmsvehicleregdtlsTbl::className(), ['ivrd_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getIvmsvehicleregdtlshstyTbls()
    {
        return $this->hasMany(IvmsvehicleregdtlshstyTbl::className(), ['ivrdh_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppdeviceinfomainTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppdeviceinfomainTblQuery(get_called_class());
    }
    
    public static function getDeviceInfoByAppPk($appPk,$excludepk=null)
    {
        $model = self::find()
                ->select(['appdeviceinfomain_pk as devicePk', 'appdim_modelno as modelno', 'appdim_softwareversion as softversion'])
                ->leftJoin('appinstinfomain_tbl', 'appinstinfomain_pk = appdim_appinstinfomain_fk')
                ->leftJoin('applicationdtlsmain_tbl', 'appdim_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->andWhere(['=', 'appdm_issuspended', 2])
                ->andWhere(['=', 'appiim_applicationdtlsmain_fk', $appPk]);
                if($excludepk)
                {
                    $model->andWhere(['<>','appdeviceinfomain_pk',$excludepk]);
                }
           $data = $model->asArray()
                ->all();

        return $data;
    }
    
    
    public static function getInstationTechnician($request) {

        $data = json_decode($request, true);
        
        $isfocalpoint= ActiveRecord::getTokenData('oum_isfocalpoint', true);
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $role = ActiveRecord::getTokenData('oum_rolemst_fk', true);
        $roles = explode(',',$role);
        
        $regPk = Security::decrypt($data['registrationpk']);
        $appPk = Security::decrypt($data['applicatiomainpk']);
        $ivmsmodel = Security::decrypt($data['ivmsdevicemodel']);
        $date = Security::decrypt($data['date']);
        $startTime = Security::decrypt($data['startTime']);
        $endTime = Security::decrypt($data['endTime']);
        $ifedit = $data['ifedit'];
        
        
        
        $apppk = AppdeviceinfomainTbl::findOne($ivmsmodel);
        
        
        $appPk = $apppk->appdim_applicationdtlsmain_fk;
        
        
        $inspectors = [];

        $query = OpalusermstTbl::find()
                        ->select(['opalusermst_pk as pk', 'oum_firstname'])
                        ->leftJoin('appstaffinfomain_tbl', 'appsim_StaffInfoRepo_FK = oum_staffinforepo_fk')
                        
                        ->where(['=', 'oum_opalmemberregmst_fk', $regPk])
                        ->andWhere(['=', 'appsim_ApplicationDtlsMain_FK', $appPk])
                        ->andWhere("((FIND_IN_SET('" . $ivmsmodel . "', appsim_appdeviceinfomain_fk)) || (appsim_appdeviceinfomain_fk = " . $ivmsmodel . " ))")
                         ->andWhere("((FIND_IN_SET('20', oum_rolemst_fk)) || (oum_rolemst_fk = 20 ))");
                    if($isfocalpoint == 2 && (int)$role===20 )
                    {
                        $query->andWhere(['=','opalusermst_pk',$userpk]);
                    }
                    else if($isfocalpoint == 1 || ($isfocalpoint == 2 && in_array(19,$roles)))
                    {
                        
                        $query->andWhere('opalusermst_pk is not NULL');
                    }
                    else
                    {
                        $query->andWhere(0);
                    }
                    
                      $model = $query->asArray()->all();
                     
      
        if ($model) {
            foreach ($model as $record) {
                $data = IvmsvehicleregdtlsTbl::find()
                        ->where(['=', 'ivrd_Installername', $record['pk']])
                        ->andWhere(['NOT IN','ivrd_installationstatus',[3,4,5,6]])
                        ->andWhere("('" . $startTime . "'  BETWEEN ivrd_inststarttime AND ivrd_instendtime) OR ('" . $endTime . "'    BETWEEN ivrd_inststarttime AND ivrd_instendtime) OR (ivrd_inststarttime   BETWEEN '" . $startTime . "'  AND '" . $endTime . "' ) OR (ivrd_instendtime   BETWEEN '" . $startTime . "'  AND '" . $endTime . "' )")
                       ->exists();
      
                if (!$data) {
                    $inspectors[] = $record;
                }
            }
        }
        else
        {
             $inspectors = $model;
        }
        if($ifedit)
        {
            $inspectors = $model;
        }
        
        return $inspectors;
    }
    
    
}
