<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehicleregdtls_tbl".
 *
 * @property int $rasvehicleregdtls_pk
 * @property int $rvrd_appinstinfomain_fk
 * @property int $rvrd_opalmemberregmst_fk
 * @property int $rvrd_rasvehicleownerdtls_fk Reference to rasvehicleownerdtls_pk
 * @property string $rvrd_vechicleregno
 * @property string $rvrd_chassisno
 * @property string $rvrd_ivmsserialno
 * @property string $rvrd_ivmsvendorname
 * @property string $rvrd_ivmsdevicemodel
 * @property string $rvrd_speedlimitno
 * @property int $rvrd_vechiclecat Reference to rascategorymst_tbl
 * @property string $rvrd_vechiclefleetno
 * @property int $rvrd_roadtype Reference to Referencemst_pk, rm_mastertype = 16
 * @property string $rvrd_firstropregdate
 * @property string $rvrd_modelyear
 * @property string $rvrd_dateofinsp
 * @property string $rvrd_inspstarttime
 * @property string $rvrd_inspendtime
 * @property int $rvrd_inspectorname Reference to opalusermst_pk
 * @property string $rvrd_dateofexpiry
 * @property string $rvrd_applicationrefno RASIC999/001 (RASIC<OPAL Membership Number>/<Auto incremental number>)
 * @property string $rvrd_verificationno
 * @property int $rvrd_applicationtype 1-Initial,2-Renewal
 * @property int $rvrd_inspectionstatus 1-Inspection Pending,2-Verification Pending,3-Completed,4-Supervisor Approval Pending,5-Declined by Verifier,6-Declined by Supervisor, 7-Re-Inspection Required, 8-Rejected, 9-Rejected and Cancelled, 10-Cancelled(Renewal) default 1
 * @property int $rvrd_permitstatus 1-New,2-Valid,3-Expired
 * @property string $rvrd_viewstickerpath
 * @property string $rvrd_printstickerpath
 * @property int $rvrd_isstickerprinted 1-Yes,2-No
 * @property int $rvrd_iscardviewed 1-Yes,2-No
 * @property string $rvrd_firstissuedate
 * @property string $rvrd_lastissuedon
 * @property string $rvrd_printedon
 * @property int $rvrd_printedby
 * @property string $rvrd_createdon
 * @property int $rvrd_createdby
 * @property string $rvrd_updatedon
 * @property int $rvrd_updatedby
 *
 * @property OpalusermstTbl $rvrdInspectorname
 * @property RasvehicleownerdtlsTbl $rvrdRasvehicleownerdtlsFk
 * @property ReferencemstTbl $rvrdRoadtype
 * @property RascategorymstTbl $rvrdVechiclecat
 * @property RasvehicleregdtlshstyTbl[] $rasvehicleregdtlshstyTbls
 * @property VehicleinspandapprovalTbl[] $vehicleinspandapprovalTbls
 */
class RasvehicleregdtlsTbl extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'rasvehicleregdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['rvrd_appinstinfomain_fk', 'rvrd_opalmemberregmst_fk', 'rvrd_rasvehicleownerdtls_fk', 'rvrd_vechicleregno', 'rvrd_vechiclecat', 'rvrd_applicationtype', 'rvrd_inspectionstatus', 'rvrd_permitstatus', 'rvrd_createdby'], 'required'],
            [['rvrd_appinstinfomain_fk', 'rvrd_opalmemberregmst_fk', 'rvrd_rasvehicleownerdtls_fk', 'rvrd_vechiclecat', 'rvrd_roadtype', 'rvrd_inspectorname', 'rvrd_applicationtype', 'rvrd_inspectionstatus', 'rvrd_permitstatus', 'rvrd_isstickerprinted', 'rvrd_iscardviewed', 'rvrd_printedby', 'rvrd_createdby', 'rvrd_updatedby'], 'integer'],
            [['rvrd_vechicleregno', 'rvrd_chassisno', 'rvrd_ivmsserialno', 'rvrd_ivmsvendorname', 'rvrd_ivmsdevicemodel', 'rvrd_speedlimitno', 'rvrd_vechiclefleetno', 'rvrd_applicationrefno', 'rvrd_viewstickerpath', 'rvrd_printstickerpath'], 'string'],
            [['rvrd_firstropregdate', 'rvrd_modelyear', 'rvrd_dateofinsp', 'rvrd_inspstarttime', 'rvrd_inspendtime', 'rvrd_dateofexpiry', 'rvrd_firstissuedate', 'rvrd_lastissuedon', 'rvrd_printedon', 'rvrd_createdon', 'rvrd_updatedon'], 'safe'],
            [['rvrd_verificationno'], 'string', 'max' => 50],
            [['rvrd_inspectorname'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['rvrd_inspectorname' => 'opalusermst_pk']],
            [['rvrd_rasvehicleownerdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleownerdtlsTbl::className(), 'targetAttribute' => ['rvrd_rasvehicleownerdtls_fk' => 'rasvehicleownerdtls_pk']],
            [['rvrd_roadtype'], 'exist', 'skipOnError' => true, 'targetClass' => ReferencemstTbl::className(), 'targetAttribute' => ['rvrd_roadtype' => 'referencemst_pk']],
            [['rvrd_vechiclecat'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['rvrd_vechiclecat' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'rasvehicleregdtls_pk' => 'Rasvehicleregdtls Pk',
            'rvrd_appinstinfomain_fk' => 'Rvrd Appinstinfomain Fk',
            'rvrd_opalmemberregmst_fk' => 'Rvrd Opalmemberregmst Fk',
            'rvrd_rasvehicleownerdtls_fk' => 'Rvrd Rasvehicleownerdtls Fk',
            'rvrd_vechicleregno' => 'Rvrd Vechicleregno',
            'rvrd_chassisno' => 'Rvrd Chassisno',
            'rvrd_ivmsserialno' => 'Rvrd Ivmsserialno',
            'rvrd_ivmsvendorname' => 'Rvrd Ivmsvendorname',
            'rvrd_ivmsdevicemodel' => 'Rvrd Ivmsdevicemodel',
            'rvrd_speedlimitno' => 'Rvrd Speedlimitno',
            'rvrd_vechiclecat' => 'Rvrd Vechiclecat',
            'rvrd_vechiclefleetno' => 'Rvrd Vechiclefleetno',
            'rvrd_roadtype' => 'Rvrd Roadtype',
            'rvrd_firstropregdate' => 'Rvrd Firstropregdate',
            'rvrd_modelyear' => 'Rvrd Modelyear',
            'rvrd_dateofinsp' => 'Rvrd Dateofinsp',
            'rvrd_inspstarttime' => 'Rvrd Inspstarttime',
            'rvrd_inspendtime' => 'Rvrd Inspendtime',
            'rvrd_inspectorname' => 'Rvrd Inspectorname',
            'rvrd_dateofexpiry' => 'Rvrd Dateofexpiry',
            'rvrd_applicationrefno' => 'Rvrd Applicationrefno',
            'rvrd_verificationno' => 'Rvrd Verificationno',
            'rvrd_applicationtype' => 'Rvrd Applicationtype',
            'rvrd_inspectionstatus' => 'Rvrd Inspectionstatus',
            'rvrd_permitstatus' => 'Rvrd Permitstatus',
            'rvrd_viewstickerpath' => 'Rvrd Viewstickerpath',
            'rvrd_printstickerpath' => 'Rvrd Printstickerpath',
            'rvrd_isstickerprinted' => 'Rvrd Isstickerprinted',
            'rvrd_iscardviewed' => 'Rvrd Iscardviewed',
            'rvrd_firstissuedate' => 'Rvrd Firstissuedate',
            'rvrd_lastissuedon' => 'Rvrd Lastissuedon',
            'rvrd_printedon' => 'Rvrd Printedon',
            'rvrd_printedby' => 'Rvrd Printedby',
            'rvrd_createdon' => 'Rvrd Createdon',
            'rvrd_createdby' => 'Rvrd Createdby',
            'rvrd_updatedon' => 'Rvrd Updatedon',
            'rvrd_updatedby' => 'Rvrd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdInspectorname() {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'rvrd_inspectorname']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdRasvehicleownerdtlsFk() {
        return $this->hasOne(RasvehicleownerdtlsTbl::className(), ['rasvehicleownerdtls_pk' => 'rvrd_rasvehicleownerdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdRoadtype() {
        return $this->hasOne(ReferencemstTbl::className(), ['referencemst_pk' => 'rvrd_roadtype']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdVechiclecat() {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'rvrd_vechiclecat']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehicleregdtlshstyTbls() {
        return $this->hasMany(RasvehicleregdtlshstyTbl::className(), ['rvrdh_rasvehicleregdtls_fk' => 'rasvehicleregdtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicleinspandapprovalTbls() {
        return $this->hasMany(VehicleinspandapprovalTbl::className(), ['via_rasvehicleregdtls_fk' => 'rasvehicleregdtls_pk']);
    }

    public function getVehicleinspandapprovalTbl() {
        return $this->hasOne(VehicleinspandapprovalTbl::className(), ['via_rasvehicleregdtls_fk' => 'rasvehicleregdtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehicleregdtlsTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new RasvehicleregdtlsTblQuery(get_called_class());
    }

    public static function saveVehicleDtls($ownerpk, $data) {
        

        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $application = AppinstinfomainTbl::find()->where(['=', 'appiim_applicationdtlsmain_fk', $data['applicatiomainpk']])->one();
        if ($data['isrenewal'] || $data['isedit']) {
            
            $vehiclenumber = trim(\api\components\Security::sanitizeInput(trim($data['vehiclenumber']), 'string'));
            $oldrecord = RasvehicleregdtlsTbl::find()->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $vehiclenumber])->andWhere(['<>','rvrd_opalmemberregmst_fk',$data['registrationpk']])->orderBy('rasvehicleregdtls_pk DESC')->one();
            $oldcompanyrecord = RasvehicleregdtlsTbl::find()->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $vehiclenumber])->andWhere(['=','rvrd_opalmemberregmst_fk',$data['registrationpk']])->orderBy('rasvehicleregdtls_pk DESC')->one();
           
           
            if ($oldrecord) {
                $historyvehicle = RasvehicleregdtlshstyTbl::movetohistory($oldrecord);
            }
            if($data['isrenewal'] && $oldrecord)
            {
                $oldrecord->rvrd_inspectionstatus = 10;
                $oldrecord->rvrd_updatedon = date('Y-m-d H:i:s');
                $oldrecord->rvrd_updatedby = $userpk;
            }
            if($data['isedit'])
            {
                $oldrecord = $oldcompanyrecord;
            }
            
            
            if ($oldrecord->save()) {
                if($data['isrenewal'])
                {
                    if ($oldcompanyrecord) {
                    $historyvehicle = RasvehicleregdtlshstyTbl::movetohistory($oldcompanyrecord);
                   }
                    if($oldcompanyrecord )
                    {
                        $model = $oldcompanyrecord;
                    }
                    else
                    {
                         $model = new RasvehicleregdtlsTbl();
                    } 
                   
                }
                else
                {
                    $model = $oldrecord;
                   
                }
                
            } else {
                echo "<pre>";
                var_dump($oldrecord->getErrors());
                exit;
            }
        }
        else
        {
             $model = new RasvehicleregdtlsTbl();
            
        }

        if ($model) 
        {
            
            $model->rvrd_appinstinfomain_fk = $application->appinstinfomain_pk;
            
            $model->rvrd_rasvehicleownerdtls_fk = $ownerpk;
            $model->rvrd_vechicleregno = trim($data['vehiclenumber']);
            $model->rvrd_chassisno = trim($data['chassNumber']);
            $model->rvrd_odometerreading = trim($data['odometer']);
            $model->rvrd_ivmsserialno = trim($data['ivmsNumber']);
            $model->rvrd_ivmsvendorname = trim($data['ivmsvendorname']);
            $model->rvrd_ivmsdevicemodel = trim($data['ivmsdeviceno']);
            $model->rvrd_speedlimitno = trim($data['speedlimit']);
            $model->rvrd_vechiclecat = trim($data['vehiclecat']);
            $model->rvrd_vechiclefleetno = trim($data['fleetNumber']);
            $model->rvrd_roadtype = $data['roadType'];
            $model->rvrd_firstropregdate = date('Y-m-d', strtotime($data['ropRegister']));
            $model->rvrd_modelyear = $data['modelYear'];
            $model->rvrd_dateofinsp = $data['inspectionDateString'];
            
            $model->rvrd_inspstarttime = $data['inspStarttimeString'];
            $model->rvrd_inspendtime = $data['inspEndtimeString'];
            $model->rvrd_inspectorname = $data['inspectorName'];
            
            if (!$data['isrenewal'] && !$data['isedit']) {
                $model->rvrd_opalmemberregmst_fk = $data['registrationpk'];
                $model->rvrd_applicationrefno = 'rasicnumber';
                $model->rvrd_applicationtype = 1;
                $model->rvrd_inspectionstatus = 1;
                
                $model->rvrd_createdon = date('Y-m-d H:i:s');
                $model->rvrd_createdby = $userpk;
            } if ($data['isrenewal']) {
                
                if($model->rvrd_opalmemberregmst_fk == $data['registrationpk'])
                {
                     $model->rvrd_opalmemberregmst_fk = $data['registrationpk'];
                }
                else
                {
                    $model->rvrd_opalmemberregmst_fk = $data['registrationpk'];
                    $model->rvrd_applicationrefno = 'rasicnumber';
                }
                
               
               
                $model->rvrd_applicationtype = 2;
                $model->rvrd_inspectionstatus = 1;
                $model->rvrd_createdon = date('Y-m-d H:i:s');
                $model->rvrd_createdby = $userpk;
                $model->rvrd_updatedon = date('Y-m-d H:i:s');
                $model->rvrd_updatedby = $userpk;
            }
            if ($data['isedit']) {
                $model->rvrd_opalmemberregmst_fk = $data['registrationpk'];
                $model->rvrd_applicationrefno = $oldrecord->rvrd_applicationrefno;
                $model->rvrd_updatedon = date('Y-m-d H:i:s');
                $model->rvrd_updatedby = $userpk;
            }
            
            if( $model->rvrd_permitstatus == null)
            {
                $model->rvrd_permitstatus = 1;
            }
            if ($model->save()) {
                return $model->rasvehicleregdtls_pk;
            } else {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
        return false;
    }

    public static function checkIsVehicleNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {

        $data = trim(\api\components\Security::sanitizeInput($dataToCheck, 'string'));
        
        $model = self::find()
                ->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $data])
                ->andWhere(['NOT IN','rvrd_inspectionstatus',[9,10]]);
        if ($regpk) {
            $model->andWhere(['=', 'rvrd_opalmemberregmst_fk', $regpk]);
        }
       
        return $model->exists();

//       return self::find()->where('rvrd_vechicleregno = :rvrd_vechicleregno', [':rvrd_vechicleregno' => $dataToCheck])
//                        ->exists();
    }

    public static function checkIsChassNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {
        return self::find()->where('rvrd_chassisno = :rvrd_chassisno', [':rvrd_chassisno' => $dataToCheck])
                           ->andWhere(['NOT IN','rvrd_inspectionstatus',[9,10]])
                        ->exists();
    }

    public static function checkIsIVMSNumAlreadyExists($dataToCheck, $regpk = '', $userpk = '') {
        return self::find()->where('rvrd_ivmsserialno = :rvrd_ivmsserialno', [':rvrd_ivmsserialno' => $dataToCheck])
                        ->exists();
    }

    public static function generatenewvehiclerefno($memregpk) {

        $opalregno = OpalmemberregmstTbl::findOne($memregpk)->omrm_opalmembershipregnumber;
 
        $lastrasicvalue = RasvehicleregdtlsTbl::find()
                        ->select(["MAX(CONVERT(SUBSTRING_INDEX(rvrd_applicationrefno, '/', -1), DECIMAL)) as rvrd_applicationrefno"])
                        ->where(['=', 'rvrd_opalmemberregmst_fk', $memregpk])
                        ->andWhere(['<>', 'rvrd_applicationrefno', 'rasicnumber'])
                        ->asArray()
                        ->orderBy('rasvehicleregdtls_pk DESC')
                        ->one()['rvrd_applicationrefno'];
        

//        $lastrasicvalue = explode('/', explode('RASIC', $lastrasicnumber)[1])[1];

        if ($lastrasicvalue) {
            $number = (int) $lastrasicvalue + 1;
        } else {
            $number = 001;
        }
        

        $num = sprintf("%03d", $number);

        $refnumber = 'RASIC' . $opalregno . '/' . $num;
        
       

        return $refnumber;
    }

    public static function moveToVerifierOfflineVehicle($vehicleregPk, $status) {

        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = self::findOne($vehicleregPk);
        if ($status != 7) {
            $modelhsty = RasvehicleregdtlshstyTbl::movetohistory($model);
        }


        $model->rvrd_inspectionstatus = $status;
        $model->rvrd_updatedby = $userpk;
        $model->rvrd_updatedon = date('Y-m-d H:i:s');

        if ($model->save()) {
            return $model->rasvehicleregdtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }
    
    public static function cancelvehicle($vehicleregPk)
    {
        $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $model = self::findOne($vehicleregPk);
        
        $modelhsty = RasvehicleregdtlshstyTbl::movetohistory($model);
        
        $model->rvrd_inspectionstatus = 9;
        $model->rvrd_permitstatus = 4;
        $model->rvrd_updatedby = $userpk;
        $model->rvrd_updatedon = date('Y-m-d H:i:s');

        if ($model->save()) {
            return $model->rasvehicleregdtls_pk;
        } else {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

}
