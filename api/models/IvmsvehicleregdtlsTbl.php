<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "ivmsvehicleregdtls_tbl".
 *
 * @property int $ivmsvehicleregdtls_pk
 * @property int $ivrd_rasvehicleownerdtls_fk Reference to rasvehicleownerdtls_pk
 * @property int $ivrd_appinstinfomain_fk  Reference to appinstinfomain_pk
 * @property int $ivrd_opalmemberregmst_fk  Reference to opalmemberregmst_pk
 * @property int $ivrd_appdeviceinfomain_fk  Reference to appdeviceinfomain_pk
 * @property string $ivrd_contpermailid  contact person mail id
 * @property string $ivrd_contpermobno  contact person mobile number
 * @property string $ivrd_vechicleregno
 * @property string $ivrd_chassisno
 * @property int $ivrd_odometerreading  Oodo meter reading
 * @property string $ivrd_ivmsserialno Device Serial Number
 * @property string $ivrd_deviceimeino Device IMEI Number
 * @property string $ivrd_vehiclemanufname  Reference to referncemst_tbl, where rm_mastertype=17
 * @property string $ivrd_speedlimitno  vehicle manufacturer name
 * @property int $ivrd_vechiclecat  Reference to rascategorymst_tbl
 * @property int $ivrd_vehiclesubcat  Reference to vehiclesubcatmst_tbl
 * @property string $ivrd_driverfatiguemgmtsysmodel  Sometime user will enter "NIL" 
 * @property string $ivrd_driverfatiguemgmtsysserialno  Sometime user will enter "NIL" 
 * @property string $ivrd_simcardno
 * @property string $ivrd_simserviceprvdr  Reference to referncemst_tbl, where rm_mastertype=18, List Active SIM Service Provider with "Others" option at last.
 * @property string $ivrd_simserviceprvdrothr  Enable this field only when "Others" option is selected from the above field
 * @property string $ivrd_primyspeedsource  primary speed source
 * @property string $ivrd_secndryspeedsource  secondary speed source
 * @property string $ivrd_spdlimtseriealno  speed limit serial number
 * @property string $ivrd_vehiclefleetno  vehicle fleet number
 * @property string $ivrd_firstropregdate
 * @property string $ivrd_modelyear
 * @property string $ivrd_installationdate
 * @property string $ivrd_inststarttime
 * @property string $ivrd_instendtime
 * @property int $ivrd_Installername  Reference to opalusemst_pk
 * @property string $ivrd_verficationcode
 * @property int $ivrd_applicationtype  1-Initial,2-Device Replacement, 3-Renewal
 * @property string $ivrd_softwareversion Software Version
 * @property int $ivrd_installationstatus  1-Installation Pending,2-Approval Pending,3-Completed,4-Registration cancelled,5-Cancelled (Device Replacement Requested), 6-Device Removed and Cancelled, 7-Declined by Senior Technician, by default 1
 * @property int $ivrd_certificatestatus   1-New,2-Valid,3-Expired,4-Cancelled
 * @property string $ivrd_dateoffiiting  Store the installation date, of the vehicle register at first against this centre and the device model no.
 * @property string $ivrd_dateofreplacement  Store the installation date, of the vehicle register for device replacement (At last) against this centre and the device model no.
 * @property string $ivrd_dateofexpiry
 * @property string $irvrd_viewcertificatepath
 * @property string $ivrd_printcertificatepath
 * @property int $ivrd_iscertificateprinted  1-Yes,2-No
 * @property int $ivrd_iscertifiacteviewed  1-Yes,2-No
 * @property string $ivrd_firstissuedate
 * @property string $ivrd_lastissuedon
 * @property string $ivrd_printedon
 * @property int $ivrd_printedby
 * @property string $ivrd_createdon
 * @property int $ivrd_createdby
 * @property string $ivrd_updatedon
 * @property int $ivrd_updatedby
 *
 * @property IvmsinspandapprovalTbl[] $ivmsinspandapprovalTbls
 * @property AppdeviceinfomainTbl $ivrdAppdeviceinfomainFk
 * @property AppinstinfomainTbl $ivrdAppinstinfomainFk
 * @property OpalusermstTbl $ivrdInstallername
 * @property OpalmemberregmstTbl $ivrdOpalmemberregmstFk
 * @property RasvehicleownerdtlsTbl $ivrdRasvehicleownerdtlsFk
 * @property RascategorymstTbl $ivrdVechiclecat
 * @property VehiclesubcatmstTbl $ivrdVehiclesubcat
 * @property IvmsvehicleregdtlshstyTbl[] $ivmsvehicleregdtlshstyTbls
 */
class IvmsvehicleregdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsvehicleregdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ivrd_rasvehicleownerdtls_fk', 'ivrd_appinstinfomain_fk', 'ivrd_opalmemberregmst_fk', 'ivrd_appdeviceinfomain_fk', 'ivrd_vechicleregno', 'ivrd_chassisno', 'ivrd_deviceimeino', 'ivrd_vehiclemanufname', 'ivrd_vechiclecat', 'ivrd_vehiclesubcat', 'ivrd_installationdate', 'ivrd_Installername', 'ivrd_applicationtype', 'ivrd_softwareversion', 'ivrd_certificatestatus', 'ivrd_createdby'], 'required'],
            [['ivrd_rasvehicleownerdtls_fk', 'ivrd_appinstinfomain_fk', 'ivrd_opalmemberregmst_fk', 'ivrd_appdeviceinfomain_fk', 'ivrd_odometerreading', 'ivrd_vechiclecat', 'ivrd_vehiclesubcat', 'ivrd_Installername', 'ivrd_applicationtype', 'ivrd_installationstatus', 'ivrd_certificatestatus', 'ivrd_iscertificateprinted', 'ivrd_iscertifiacteviewed', 'ivrd_printedby', 'ivrd_createdby', 'ivrd_updatedby'], 'integer'],
            [['ivrd_contpermailid', 'ivrd_contpermobno', 'ivrd_vechicleregno', 'ivrd_chassisno', 'ivrd_ivmsserialno', 'ivrd_deviceimeino', 'ivrd_vehiclemanufname', 'ivrd_speedlimitno', 'ivrd_driverfatiguemgmtsysmodel', 'ivrd_driverfatiguemgmtsysserialno', 'ivrd_simcardno', 'ivrd_simserviceprvdr', 'ivrd_simserviceprvdrothr', 'ivrd_primyspeedsource', 'ivrd_secndryspeedsource', 'ivrd_spdlimtseriealno', 'ivrd_vehiclefleetno', 'ivrd_softwareversion', 'irvrd_viewcertificatepath', 'ivrd_printcertificatepath'], 'string'],
            [['ivrd_firstropregdate', 'ivrd_modelyear', 'ivrd_installationdate', 'ivrd_inststarttime', 'ivrd_instendtime', 'ivrd_dateoffiiting', 'ivrd_dateofreplacement', 'ivrd_dateofexpiry', 'ivrd_firstissuedate', 'ivrd_lastissuedon', 'ivrd_printedon', 'ivrd_createdon', 'ivrd_updatedon'], 'safe'],
            [['ivrd_verficationcode'], 'string', 'max' => 45],
            [['ivrd_appdeviceinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppdeviceinfomainTbl::className(), 'targetAttribute' => ['ivrd_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']],
            [['ivrd_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['ivrd_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['ivrd_Installername'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['ivrd_Installername' => 'opalusermst_pk']],
            [['ivrd_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['ivrd_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['ivrd_rasvehicleownerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleownerdtlsTbl::className(), 'targetAttribute' => ['ivrd_rasvehicleownerdtls_fk' => 'rasvehicleownerdtls_pk']],
            [['ivrd_vechiclecat'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['ivrd_vechiclecat' => 'rascategorymst_pk']],
            [['ivrd_vehiclesubcat'], 'exist', 'skipOnError' => true, 'targetClass' => VehiclesubcatmstTbl::className(), 'targetAttribute' => ['ivrd_vehiclesubcat' => 'vehiclesubcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsvehicleregdtls_pk' => 'Ivmsvehicleregdtls Pk',
            'ivrd_rasvehicleownerdtls_fk' => 'Ivrd Rasvehicleownerdtls Fk',
            'ivrd_appinstinfomain_fk' => 'Ivrd Appinstinfomain Fk',
            'ivrd_opalmemberregmst_fk' => 'Ivrd Opalmemberregmst Fk',
            'ivrd_appdeviceinfomain_fk' => 'Ivrd Appdeviceinfomain Fk',
            'ivrd_contpermailid' => 'Ivrd Contpermailid',
            'ivrd_contpermobno' => 'Ivrd Contpermobno',
            'ivrd_vechicleregno' => 'Ivrd Vechicleregno',
            'ivrd_chassisno' => 'Ivrd Chassisno',
            'ivrd_odometerreading' => 'Ivrd Odometerreading',
            'ivrd_ivmsserialno' => 'Ivrd Ivmsserialno',
            'ivrd_deviceimeino' => 'Ivrd Deviceimeino',
            'ivrd_vehiclemanufname' => 'Ivrd Vehiclemanufname',
            'ivrd_speedlimitno' => 'Ivrd Speedlimitno',
            'ivrd_vechiclecat' => 'Ivrd Vechiclecat',
            'ivrd_vehiclesubcat' => 'Ivrd Vehiclesubcat',
            'ivrd_driverfatiguemgmtsysmodel' => 'Ivrd Driverfatiguemgmtsysmodel',
            'ivrd_driverfatiguemgmtsysserialno' => 'Ivrd Driverfatiguemgmtsysserialno',
            'ivrd_simcardno' => 'Ivrd Simcardno',
            'ivrd_simserviceprvdr' => 'Ivrd Simserviceprvdr',
            'ivrd_simserviceprvdrothr' => 'Ivrd Simserviceprvdrothr',
            'ivrd_primyspeedsource' => 'Ivrd Primyspeedsource',
            'ivrd_secndryspeedsource' => 'Ivrd Secndryspeedsource',
            'ivrd_spdlimtseriealno' => 'Ivrd Spdlimtseriealno',
            'ivrd_vehiclefleetno' => 'Ivrd Vehiclefleetno',
            'ivrd_firstropregdate' => 'Ivrd Firstropregdate',
            'ivrd_modelyear' => 'Ivrd Modelyear',
            'ivrd_installationdate' => 'Ivrd Installationdate',
            'ivrd_inststarttime' => 'Ivrd Inststarttime',
            'ivrd_instendtime' => 'Ivrd Instendtime',
            'ivrd_Installername' => 'Ivrd  Installername',
            'ivrd_verficationcode' => 'Ivrd Verficationcode',
            'ivrd_applicationtype' => 'Ivrd Applicationtype',
            'ivrd_softwareversion' => 'Ivrd Softwareversion',
            'ivrd_installationstatus' => 'Ivrd Installationstatus',
            'ivrd_certificatestatus' => 'Ivrd Certificatestatus',
            'ivrd_dateoffiiting' => 'Ivrd Dateoffiiting',
            'ivrd_dateofreplacement' => 'Ivrd Dateofreplacement',
            'ivrd_dateofexpiry' => 'Ivrd Dateofexpiry',
            'irvrd_viewcertificatepath' => 'Irvrd Viewcertificatepath',
            'ivrd_printcertificatepath' => 'Ivrd Printcertificatepath',
            'ivrd_iscertificateprinted' => 'Ivrd Iscertificateprinted',
            'ivrd_iscertifiacteviewed' => 'Ivrd Iscertifiacteviewed',
            'ivrd_firstissuedate' => 'Ivrd Firstissuedate',
            'ivrd_lastissuedon' => 'Ivrd Lastissuedon',
            'ivrd_printedon' => 'Ivrd Printedon',
            'ivrd_printedby' => 'Ivrd Printedby',
            'ivrd_createdon' => 'Ivrd Createdon',
            'ivrd_createdby' => 'Ivrd Createdby',
            'ivrd_updatedon' => 'Ivrd Updatedon',
            'ivrd_updatedby' => 'Ivrd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspandapprovalTbls()
    {
        return $this->hasMany(IvmsinspandapprovalTbl::className(), ['iia_ivmsvehicleregdtls_fk' => 'ivmsvehicleregdtls_pk']);
    }
    
    public function getIvmsinspandapprovalTbl()
    {
        return $this->hasOne(IvmsinspandapprovalTbl::className(), ['iia_ivmsvehicleregdtls_fk' => 'ivmsvehicleregdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdAppdeviceinfomainFk()
    {
        return $this->hasOne(AppdeviceinfomainTbl::className(), ['appdeviceinfomain_pk' => 'ivrd_appdeviceinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'ivrd_appinstinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdInstallername()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'ivrd_Installername']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'ivrd_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdRasvehicleownerdtlsFk()
    {
        return $this->hasOne(RasvehicleownerdtlsTbl::className(), ['rasvehicleownerdtls_pk' => 'ivrd_rasvehicleownerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdVechiclecat()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'ivrd_vechiclecat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdVehiclesubcat()
    {
        return $this->hasOne(VehiclesubcatmstTbl::className(), ['vehiclesubcatmst_pk' => 'ivrd_vehiclesubcat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsvehicleregdtlshstyTbls()
    {
        return $this->hasMany(IvmsvehicleregdtlshstyTbl::className(), ['ivrdh_ivmsvehicleregdtls_fk' => 'ivmsvehicleregdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsvehicleregdtlsTblQuery(get_called_class());
    }



    public static function saveVehicleDtls($ownerpk, $data) {


        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $application = AppinstinfomainTbl::find()->where(['=', 'appiim_applicationdtlsmain_fk', $data['applicatiomainpk']])->one();

        if ($data['isedit'] || $data['isschedule']) {
            $oldrecord = IvmsvehicleregdtlsTbl::find()->where(['ivrd_vechicleregno' => trim($data['vehiclenumber'])])->andWhere(['<>', 'ivrd_opalmemberregmst_fk', $data['registrationpk']])->orderBy('ivmsvehicleregdtls_pk DESC')->one();

            $oldcompanyrecord = IvmsvehicleregdtlsTbl::find()->where(['ivrd_vechicleregno' => trim($data['vehiclenumber'])])->andWhere(['=', 'ivrd_opalmemberregmst_fk', $data['registrationpk']])->orderBy('ivmsvehicleregdtls_pk DESC')->one();
            if ($data['isedit'] && $oldcompanyrecord) {
                $oldrecord = $oldcompanyrecord;
            }


            if ($data['isedit'] && $oldrecord) {
                $historyvehicle = IvmsvehicleregdtlshstyTbl::movetohistory($oldrecord);
                $model = $oldrecord;
            }


            if ($data['isschedule']) {
                $oldcompanyrecord->ivrd_installationstatus = 5;
                

                if ($oldcompanyrecord->validate() && $oldcompanyrecord->save()) {

                    $model = new IvmsvehicleregdtlsTbl();
                } else {
                    echo "<pre>";
                    var_dump($oldrecord->getErrors());
                    exit;
                }
            }
        } else {
            $model = new IvmsvehicleregdtlsTbl();
        }

        if ($model) {
            $model->ivrd_appinstinfomain_fk = $application->appinstinfomain_pk;

            $model->ivrd_rasvehicleownerdtls_fk = $ownerpk;
            $model->ivrd_vechicleregno = trim($data['vehiclenumber']);
            $model->ivrd_appdeviceinfomain_fk = trim($data['ivmsdevicemodel']);
            $model->ivrd_softwareversion = trim($data['softVersion']);
            $model->ivrd_contpermailid = trim($data['gm_emailid']);
            $model->ivrd_contpermobno = trim($data['gm_mobnum']);

            $model->ivrd_chassisno = trim($data['chassNumber']);
            $model->ivrd_odometerreading = trim($data['odometer']);
            $model->ivrd_ivmsserialno = trim($data['deviceserial']);
            $model->ivrd_deviceimeino = trim($data['deviceimei']);

            $model->ivrd_vehiclemanufname = trim($data['vechicelmanufact']);
//            $model->rvrd_ivmsdevicemodel = trim($data['ivmsdeviceno']);
            $model->ivrd_speedlimitno = trim($data['speedlimit']);
            $model->ivrd_vechiclecat = trim($data['vehiclecat']);
            $model->ivrd_vehiclesubcat = trim($data['vechicletype']);

            $model->ivrd_driverfatiguemgmtsysmodel = trim($data['devfatigsysmdl']);
            $model->ivrd_driverfatiguemgmtsysserialno = trim($data['devfatigsysnum']);

            $model->ivrd_simcardno = trim($data['simnmber']);

            if ($data['simprovider'] == 'other') {
                $model->ivrd_simserviceprvdr = NULL;
                $model->ivrd_simserviceprvdrothr = trim($data['simproviderother']);
            } else {
                $model->ivrd_simserviceprvdr = trim($data['simprovider']);
                $model->ivrd_simserviceprvdrothr = NULL;
            }


            $model->ivrd_primyspeedsource = trim($data['primaryspeed']);
            $model->ivrd_secndryspeedsource = trim($data['secondaryspeed']);

            $model->ivrd_spdlimtseriealno = trim($data['speedlimit']);
            $model->ivrd_vehiclefleetno = trim($data['vehiclefleet']);
            $model->ivrd_firstropregdate = $data['ropRegisterString'];
            $model->ivrd_modelyear = $data['modelYear'];

            $model->ivrd_installationdate = $data['installDateString'];
            $model->ivrd_inststarttime = $data['inspStarttimeString'];
            $model->ivrd_instendtime = $data['inspEndtimeString'];
            $model->ivrd_Installername = $data['installName'];

            if (!$data['isrenewal'] && !$data['isedit']) {

                $model->ivrd_opalmemberregmst_fk = $data['registrationpk'];
//                $model->rvrd_applicationrefno = 'rasicnumber';
                $model->ivrd_applicationtype = 1;
                $model->ivrd_installationstatus = 1;

                $model->ivrd_createdon = date('Y-m-d H:i:s');
                $model->ivrd_createdby = $userpk;
            } if ($data['isrenewal']) {

                if ($model->ivrd_opalmemberregmst_fk == $data['registrationpk']) {
                    $model->ivrd_opalmemberregmst_fk = $data['registrationpk'];
                } else {
                    $model->ivrd_opalmemberregmst_fk = $data['registrationpk'];
//                    $model->rvrd_applicationrefno = 'rasicnumber';
                }

                $model->ivrd_applicationtype = 2;
                $model->ivrd_installationstatus = 1;
                $model->ivrd_createdon = date('Y-m-d H:i:s');
                $model->ivrd_createdby = $userpk;
                $model->ivrd_updatedon = date('Y-m-d H:i:s');
                $model->ivrd_updatedby = $userpk;
            }
            if ($data['isedit']) {
                $model->ivrd_opalmemberregmst_fk = $data['registrationpk'];
//                $model->rvrd_applicationrefno = $oldrecord->rvrd_applicationrefno;
                $model->ivrd_updatedon = date('Y-m-d H:i:s');
                $model->ivrd_updatedby = $userpk;
            }
            if ($data['isschedule']) {
                $model->ivrd_opalmemberregmst_fk = $data['registrationpk'];
//                $model->rvrd_applicationrefno = 'rasicnumber';
                $model->ivrd_dateoffiiting = $oldcompanyrecord->ivrd_dateoffiiting;
                $model->ivrd_applicationtype = 2;
                $model->ivrd_installationstatus = 1;

                $model->ivrd_createdon = date('Y-m-d H:i:s');
                $model->ivrd_createdby = $userpk;
            }

            if ($model->ivrd_certificatestatus == null) {
                $model->ivrd_certificatestatus = 1;
            }

            if ($model->validate() && $model->save()) {

                return $model->ivmsvehicleregdtls_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
        return false;
    }

    public static function submitForApprovalOffline($vehicleregPk, $status) {

        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = self::findOne($vehicleregPk);
        if ($status != 7) {
            $modelhsty = IvmsvehicleregdtlshstyTbl::movetohistory($model);
        }
        if($model->ivrd_applicationtype == 1 && $status==3)
        {
            $model->ivrd_dateoffiiting = $model->ivrd_installationdate;
        }
        
        if($model->ivrd_applicationtype == 2 && $status==3)
        {
           
            $model->ivrd_dateofreplacement = date('Y-m-d H:i:s');
        }


        $model->ivrd_installationstatus = $status;
        $model->ivrd_updatedby = $userpk;
        $model->ivrd_updatedon = date('Y-m-d H:i:s');

        if ($model->validate() && $model->save()) {
            return $model->ivmsvehicleregdtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public static function checkIsVehicleNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {

        $data = trim(\api\components\Security::sanitizeInput($dataToCheck, 'string'));
       
       
        $model = self::find()
                ->where(["REPLACE(lower(REPLACE(ivrd_vechicleregno, ' ','')), '-','')" => $data])
                ->andWhere(['NOT IN', 'ivrd_installationstatus', [4,5,6]]);
//                ->andWhere(['NOT IN','ivrd_certificatestatus',[4]]);
        if ($regpk) {
            $model->andWhere(['=', 'ivrd_opalmemberregmst_fk', $regpk]);
        }
        
        return $model->exists();

//       return self::find()->where('rvrd_vechicleregno = :rvrd_vechicleregno', [':rvrd_vechicleregno' => $dataToCheck])
//                        ->exists();
    }

    public static function checkIsChassNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {
        return self::find()->where('ivrd_chassisno = :ivrd_chassisno', [':ivrd_chassisno' => $dataToCheck])
                ->andWhere(['NOT IN', 'ivrd_installationstatus', [4,5,6]])
               // ->andWhere(['NOT IN','ivrd_certificatestatus',[4]])
                        ->exists();
    }

}
