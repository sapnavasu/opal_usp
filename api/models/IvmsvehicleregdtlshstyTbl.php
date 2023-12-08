<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ivmsvehicleregdtlshsty_tbl".
 *
 * @property int $ivmsvehicleregdtlshsty_pk
 * @property int $ivrdh_ivmsvehicleregdtls_fk Reference to ivmsvehicleregdtls_pk
 * @property int $ivrdh_rasvehicleownerdtlshsty_fk Reference to rasvehicleownerdtlshsty_pk
 * @property int $ivrdh_appinstinfomain_fk  Reference to appinstinfomain_pk
 * @property int $ivrdh_opalmemberregmst_fk  Reference to opalmemberregmst_pk
 * @property int $ivrdh_appdeviceinfomain_fk  Reference to appdeviceinfomain_pk
 * @property string $ivrdh_contpermailid  contact person mail id
 * @property string $ivrdh_contpermobno contact person mobile number
 * @property string $ivrdh_vechicleregno
 * @property string $ivrdh_chassisno
 * @property int $ivrdh_odometerreading  Oodo meter reading
 * @property string $ivrdh_ivmsserialno Device Serial Number
 * @property string $ivrdh_deviceimeino Device IMEI Number
 * @property string $ivrdh_vehiclemanufname  Reference to referencemst_tbl, where rm_mastertype=17
 * @property string $ivrdh_speedlimitno  vehicle manufacturer name
 * @property int $ivrdh_vechiclecat Reference to rascategorymst_tbl
 * @property int $ivrdh_vehiclesubcat  Reference to vehiclesubcatmst_tbl
 * @property string $ivrdh_driverfatiguemgmtsysmodel  Sometime user will enter "NIL"
 * @property string $ivrdh_driverfatiguemgmtsysserialno  Sometime user will enter "NIL" 
 * @property string $ivrdh_simcardno
 * @property string $ivrdh_simserviceprvdr  Reference to referncemst_tbl, where rm_mastertype=18, List Active SIM Service Provider with "Others" option at last.
 * @property string $ivrdh_simserviceprvdrothr  Enable this field only when "Others" option is selected from the above field
 * @property string $ivrdh_primyspeedsource  primary speed source
 * @property string $ivrdh_secndryspeedsource  secondary speed source
 * @property string $ivrdh_spdlimtseriealno speed limit serial number
 * @property string $ivrdh_vehiclefleetno  vehicle fleet number
 * @property string $ivrdh_firstropregdate
 * @property string $ivrdh_modelyear
 * @property string $ivrdh_installationdate
 * @property string $ivrdh_inststarttime
 * @property string $ivrdh_instendtime
 * @property int $ivrdh_Installername  Reference to opalusemst_pk
 * @property string $ivrdh_verficationcode
 * @property int $ivrdh_applicationtype  1-Initial,2-Device Replacement, 3-Renewal
 * @property string $ivrdh_softwareversion Software Version
 * @property int $ivrdh_installationstatus  1-Installation Pending,2-Approval Pending,3-Completed,4-Registration cancelled,5-Cancelled (Device Replacement Requested), 6-Device Removed and Cancelled, 7-Declined by Senior Technician, by default 1
 * @property int $ivrdh_certificatestatus  1-New,2-Valid,3-Expired,4-Cancelled
 * @property string $ivrdh_dateoffiiting  Store the installation date, of the vehicle register at first against this centre and the device model no.
 * @property string $ivrdh_dateofreplacement  Store the installation date, of the vehicle register for device replacement (At last) against this centre and the device model no.
 * @property string $ivrdh_dateofexpiry
 * @property string $irvrd_viewcertificatepath
 * @property string $ivrdh_printcertificatepath
 * @property int $ivrdh_iscertificateprinted  1-Yes,2-No
 * @property int $ivrdh_iscertifiacteviewed  1-Yes,2-No
 * @property string $ivrdh_firstissuedate
 * @property string $ivrdh_lastissuedon
 * @property string $ivrdh_printedon
 * @property int $ivrdh_printedby
 * @property string $ivrdh_createdon
 * @property int $ivrdh_createdby
 * @property string $ivrdh_updatedon
 * @property int $ivrdh_updatedby
 *
 * @property IvmsinspandapprovalhstyTbl[] $ivmsinspandapprovalhstyTbls
 * @property AppdeviceinfomainTbl $ivrdhAppdeviceinfomainFk
 * @property AppinstinfomainTbl $ivrdhAppinstinfomainFk
 * @property OpalusermstTbl $ivrdhInstallername
 * @property IvmsvehicleregdtlsTbl $ivrdhIvmsvehicleregdtlsFk
 * @property OpalmemberregmstTbl $ivrdhOpalmemberregmstFk
 * @property RasvehicleownerdtlshstyTbl $ivrdhRasvehicleownerdtlshstyFk
 * @property RascategorymstTbl $ivrdhVechiclecat
 * @property VehiclesubcatmstTbl $ivrdhVehiclesubcat
 */
class IvmsvehicleregdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ivmsvehicleregdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ivrdh_ivmsvehicleregdtls_fk', 'ivrdh_rasvehicleownerdtlshsty_fk', 'ivrdh_appinstinfomain_fk', 'ivrdh_opalmemberregmst_fk', 'ivrdh_appdeviceinfomain_fk', 'ivrdh_vechicleregno', 'ivrdh_chassisno', 'ivrdh_deviceimeino', 'ivrdh_vehiclemanufname', 'ivrdh_vechiclecat', 'ivrdh_vehiclesubcat', 'ivrdh_installationdate', 'ivrdh_Installername', 'ivrdh_applicationtype', 'ivrdh_softwareversion', 'ivrdh_certificatestatus', 'ivrdh_createdby'], 'required'],
            [['ivrdh_ivmsvehicleregdtls_fk', 'ivrdh_rasvehicleownerdtlshsty_fk', 'ivrdh_appinstinfomain_fk', 'ivrdh_opalmemberregmst_fk', 'ivrdh_appdeviceinfomain_fk', 'ivrdh_odometerreading', 'ivrdh_vechiclecat', 'ivrdh_vehiclesubcat', 'ivrdh_Installername', 'ivrdh_applicationtype', 'ivrdh_installationstatus', 'ivrdh_certificatestatus', 'ivrdh_iscertificateprinted', 'ivrdh_iscertifiacteviewed', 'ivrdh_printedby', 'ivrdh_createdby', 'ivrdh_updatedby'], 'integer'],
            [['ivrdh_contpermailid', 'ivrdh_contpermobno', 'ivrdh_vechicleregno', 'ivrdh_chassisno', 'ivrdh_ivmsserialno', 'ivrdh_deviceimeino', 'ivrdh_vehiclemanufname', 'ivrdh_speedlimitno', 'ivrdh_driverfatiguemgmtsysmodel', 'ivrdh_driverfatiguemgmtsysserialno', 'ivrdh_simcardno', 'ivrdh_simserviceprvdr', 'ivrdh_simserviceprvdrothr', 'ivrdh_primyspeedsource', 'ivrdh_secndryspeedsource', 'ivrdh_spdlimtseriealno', 'ivrdh_vehiclefleetno', 'ivrdh_softwareversion', 'irvrd_viewcertificatepath', 'ivrdh_printcertificatepath'], 'string'],
            [['ivrdh_firstropregdate', 'ivrdh_modelyear', 'ivrdh_installationdate', 'ivrdh_inststarttime', 'ivrdh_instendtime', 'ivrdh_dateoffiiting', 'ivrdh_dateofreplacement', 'ivrdh_dateofexpiry', 'ivrdh_firstissuedate', 'ivrdh_lastissuedon', 'ivrdh_printedon', 'ivrdh_createdon', 'ivrdh_updatedon'], 'safe'],
            [['ivrdh_verficationcode'], 'string', 'max' => 45],
            [['ivrdh_appdeviceinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppdeviceinfomainTbl::className(), 'targetAttribute' => ['ivrdh_appdeviceinfomain_fk' => 'appdeviceinfomain_pk']],
            [['ivrdh_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['ivrdh_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['ivrdh_Installername'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['ivrdh_Installername' => 'opalusermst_pk']],
            [['ivrdh_ivmsvehicleregdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => IvmsvehicleregdtlsTbl::className(), 'targetAttribute' => ['ivrdh_ivmsvehicleregdtls_fk' => 'ivmsvehicleregdtls_pk']],
            [['ivrdh_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['ivrdh_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
            [['ivrdh_rasvehicleownerdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleownerdtlshstyTbl::className(), 'targetAttribute' => ['ivrdh_rasvehicleownerdtlshsty_fk' => 'rasvehicleownerdtlshsty_pk']],
            [['ivrdh_vechiclecat'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['ivrdh_vechiclecat' => 'rascategorymst_pk']],
            [['ivrdh_vehiclesubcat'], 'exist', 'skipOnError' => true, 'targetClass' => VehiclesubcatmstTbl::className(), 'targetAttribute' => ['ivrdh_vehiclesubcat' => 'vehiclesubcatmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ivmsvehicleregdtlshsty_pk' => 'Ivmsvehicleregdtlshsty Pk',
            'ivrdh_ivmsvehicleregdtls_fk' => 'Ivrdh Ivmsvehicleregdtls Fk',
            'ivrdh_rasvehicleownerdtlshsty_fk' => 'Ivrdh Rasvehicleownerdtlshsty Fk',
            'ivrdh_appinstinfomain_fk' => 'Ivrdh Appinstinfomain Fk',
            'ivrdh_opalmemberregmst_fk' => 'Ivrdh Opalmemberregmst Fk',
            'ivrdh_appdeviceinfomain_fk' => 'Ivrdh Appdeviceinfomain Fk',
            'ivrdh_contpermailid' => 'Ivrdh Contpermailid',
            'ivrdh_contpermobno' => 'Ivrdh Contpermobno',
            'ivrdh_vechicleregno' => 'Ivrdh Vechicleregno',
            'ivrdh_chassisno' => 'Ivrdh Chassisno',
            'ivrdh_odometerreading' => 'Ivrdh Odometerreading',
            'ivrdh_ivmsserialno' => 'Ivrdh Ivmsserialno',
            'ivrdh_deviceimeino' => 'Ivrdh Deviceimeino',
            'ivrdh_vehiclemanufname' => 'Ivrdh Vehiclemanufname',
            'ivrdh_speedlimitno' => 'Ivrdh Speedlimitno',
            'ivrdh_vechiclecat' => 'Ivrdh Vechiclecat',
            'ivrdh_vehiclesubcat' => 'Ivrdh Vehiclesubcat',
            'ivrdh_driverfatiguemgmtsysmodel' => 'Ivrdh Driverfatiguemgmtsysmodel',
            'ivrdh_driverfatiguemgmtsysserialno' => 'Ivrdh Driverfatiguemgmtsysserialno',
            'ivrdh_simcardno' => 'Ivrdh Simcardno',
            'ivrdh_simserviceprvdr' => 'Ivrdh Simserviceprvdr',
            'ivrdh_simserviceprvdrothr' => 'Ivrdh Simserviceprvdrothr',
            'ivrdh_primyspeedsource' => 'Ivrdh Primyspeedsource',
            'ivrdh_secndryspeedsource' => 'Ivrdh Secndryspeedsource',
            'ivrdh_spdlimtseriealno' => 'Ivrdh Spdlimtseriealno',
            'ivrdh_vehiclefleetno' => 'Ivrdh Vehiclefleetno',
            'ivrdh_firstropregdate' => 'Ivrdh Firstropregdate',
            'ivrdh_modelyear' => 'Ivrdh Modelyear',
            'ivrdh_installationdate' => 'Ivrdh Installationdate',
            'ivrdh_inststarttime' => 'Ivrdh Inststarttime',
            'ivrdh_instendtime' => 'Ivrdh Instendtime',
            'ivrdh_Installername' => 'Ivrdh  Installername',
            'ivrdh_verficationcode' => 'Ivrdh Verficationcode',
            'ivrdh_applicationtype' => 'Ivrdh Applicationtype',
            'ivrdh_softwareversion' => 'Ivrdh Softwareversion',
            'ivrdh_installationstatus' => 'Ivrdh Installationstatus',
            'ivrdh_certificatestatus' => 'Ivrdh Certificatestatus',
            'ivrdh_dateoffiiting' => 'Ivrdh Dateoffiiting',
            'ivrdh_dateofreplacement' => 'Ivrdh Dateofreplacement',
            'ivrdh_dateofexpiry' => 'Ivrdh Dateofexpiry',
            'irvrd_viewcertificatepath' => 'Irvrd Viewcertificatepath',
            'ivrdh_printcertificatepath' => 'Ivrdh Printcertificatepath',
            'ivrdh_iscertificateprinted' => 'Ivrdh Iscertificateprinted',
            'ivrdh_iscertifiacteviewed' => 'Ivrdh Iscertifiacteviewed',
            'ivrdh_firstissuedate' => 'Ivrdh Firstissuedate',
            'ivrdh_lastissuedon' => 'Ivrdh Lastissuedon',
            'ivrdh_printedon' => 'Ivrdh Printedon',
            'ivrdh_printedby' => 'Ivrdh Printedby',
            'ivrdh_createdon' => 'Ivrdh Createdon',
            'ivrdh_createdby' => 'Ivrdh Createdby',
            'ivrdh_updatedon' => 'Ivrdh Updatedon',
            'ivrdh_updatedby' => 'Ivrdh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvmsinspandapprovalhstyTbls()
    {
        return $this->hasMany(IvmsinspandapprovalhstyTbl::className(), ['iiah_ivmsvehicleregdtlshsty_fk' => 'ivmsvehicleregdtlshsty_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhAppdeviceinfomainFk()
    {
        return $this->hasOne(AppdeviceinfomainTbl::className(), ['appdeviceinfomain_pk' => 'ivrdh_appdeviceinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhAppinstinfomainFk()
    {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'ivrdh_appinstinfomain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhInstallername()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'ivrdh_Installername']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhIvmsvehicleregdtlsFk()
    {
        return $this->hasOne(IvmsvehicleregdtlsTbl::className(), ['ivmsvehicleregdtls_pk' => 'ivrdh_ivmsvehicleregdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'ivrdh_opalmemberregmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhRasvehicleownerdtlshstyFk()
    {
        return $this->hasOne(RasvehicleownerdtlshstyTbl::className(), ['rasvehicleownerdtlshsty_pk' => 'ivrdh_rasvehicleownerdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhVechiclecat()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'ivrdh_vechiclecat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIvrdhVehiclesubcat()
    {
        return $this->hasOne(VehiclesubcatmstTbl::className(), ['vehiclesubcatmst_pk' => 'ivrdh_vehiclesubcat']);
    }

    /**
     * {@inheritdoc}
     * @return IvmsvehicleregdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IvmsvehicleregdtlshstyTblQuery(get_called_class());
    }



    public static function movetohistory($data)
    {
        $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=','rvodh_rasvehicleownerdtls_fk',$data->ivrd_rasvehicleownerdtls_fk])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];
        
        if(!$ownerhistory)
        {
          $ownermodel = RasvehicleownerdtlsTbl::findOne($data->ivrd_rasvehicleownerdtls_fk);
          $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);  
        }
        
        
        $model = new IvmsvehicleregdtlshstyTbl();
        $model->ivrdh_ivmsvehicleregdtls_fk = $data->ivmsvehicleregdtls_pk;
        $model->ivrdh_appinstinfomain_fk = $data->ivrd_appinstinfomain_fk;
        $model->ivrdh_opalmemberregmst_fk = $data->ivrd_opalmemberregmst_fk;
        $model->ivrdh_rasvehicleownerdtlshsty_fk = (int)$ownerhistory;
        $model->ivrdh_appdeviceinfomain_fk = $data->ivrd_appdeviceinfomain_fk;
        $model->ivrdh_contpermailid = $data->ivrd_contpermailid;
        $model->ivrdh_contpermobno = $data->ivrd_contpermobno;
        $model->ivrdh_vechicleregno = $data->ivrd_vechicleregno;
        $model->ivrdh_chassisno = $data->ivrd_chassisno;
        $model->ivrdh_odometerreading = $data->ivrd_odometerreading;
        $model->ivrdh_ivmsserialno = $data->ivrd_ivmsserialno;
        $model->ivrdh_deviceimeino = $data->ivrd_deviceimeino;
        $model->ivrdh_vehiclemanufname = $data->ivrd_vehiclemanufname;
        $model->ivrdh_speedlimitno = $data->ivrd_speedlimitno;
        $model->ivrdh_vechiclecat = $data->ivrd_vechiclecat;
        $model->ivrdh_vehiclesubcat = $data->ivrd_vehiclesubcat;
        $model->ivrdh_driverfatiguemgmtsysmodel = $data->ivrd_driverfatiguemgmtsysmodel;
        $model->ivrdh_driverfatiguemgmtsysserialno = $data->ivrd_driverfatiguemgmtsysserialno;
        $model->ivrdh_simcardno = $data->ivrd_simcardno;
        $model->ivrdh_simserviceprvdr = $data->ivrd_simserviceprvdr;
        $model->ivrdh_simserviceprvdrothr = $data->ivrd_simserviceprvdrothr;
        $model->ivrdh_primyspeedsource = $data->ivrd_primyspeedsource;
        $model->ivrdh_secndryspeedsource = $data->ivrd_secndryspeedsource;
        $model->ivrdh_spdlimtseriealno = $data->ivrd_spdlimtseriealno;
        $model->ivrdh_vehiclefleetno = $data->ivrd_vehiclefleetno;
        $model->ivrdh_firstropregdate = $data->ivrd_firstropregdate;
        $model->ivrdh_modelyear = $data->ivrd_modelyear;
        $model->ivrdh_installationdate = $data->ivrd_installationdate;
        $model->ivrdh_inststarttime = $data->ivrd_inststarttime;
        $model->ivrdh_instendtime = $data->ivrd_instendtime;
        $model->ivrdh_Installername = $data->ivrd_Installername;
        $model->ivrdh_verficationcode = $data->ivrd_verficationcode;
        $model->ivrdh_applicationtype = $data->ivrd_applicationtype;
        $model->ivrdh_softwareversion = $data->ivrd_softwareversion;
        $model->ivrdh_installationstatus = $data->ivrd_installationstatus;
        $model->ivrdh_certificatestatus = $data->ivrd_certificatestatus;
        $model->ivrdh_dateoffiiting = $data->ivrd_dateoffiiting;
        $model->ivrdh_dateofreplacement = $data->ivrd_dateofreplacement;
        $model->ivrdh_dateofexpiry = $data->ivrd_dateofexpiry;
        $model->irvrd_viewcertificatepath = $data->irvrd_viewcertificatepath;
        $model->ivrdh_printcertificatepath = $data->ivrd_printcertificatepath;
        $model->ivrdh_iscertificateprinted = $data->ivrd_iscertificateprinted;
        $model->ivrdh_iscertifiacteviewed = $data->ivrd_iscertifiacteviewed;
        $model->ivrdh_firstissuedate = $data->ivrd_firstissuedate;
        $model->ivrdh_lastissuedon = $data->ivrd_lastissuedon;
        $model->ivrdh_printedon = $data->ivrd_printedon;
        $model->ivrdh_printedby = $data->ivrd_printedby;
        $model->ivrdh_createdon = $data->ivrd_createdon;
        $model->ivrdh_createdby = $data->ivrd_createdby;
        $model->ivrdh_updatedon = $data->ivrd_updatedon;
        $model->ivrdh_updatedby = $data->ivrd_updatedby;
        if($model->validate() && $model->save())
            {
                return $model->ivmsvehicleregdtlshsty_pk;
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
    }
}
