<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehicleregdtlshsty_tbl".
 *
 * @property int $rasvehicleregdtlshsty_pk
 * @property int $rvrdh_rasvehicleregdtls_fk Reference to rasvehicleregdtls_pk
 * @property int $rvrdh_appinstinfomain_fk
 * @property int $rvrdh_opalmemberregmst_fk
 * @property int $rvrdh_rasvehicleownerdtlshsty_fk Reference to rasvehicleownerdtlshsty_pk
 * @property string $rvrdh_vechicleregno
 * @property string $rvrdh_chassisno
 * @property string $rvrdh_ivmsserialno
 * @property string $rvrdh_ivmsvendorname
 * @property string $rvrdh_ivmsdevicemodel
 * @property string $rvrdh_speedlimitno
 * @property int $rvrdh_vechiclecat Reference to rascategorymst_tbl
 * @property string $rvrdh_vechiclefleetno
 * @property int $rvrdh_roadtype Reference to Referencemst_pk, rm_mastertype = 16
 * @property string $rvrdh_firstropregdate
 * @property string $rvrdh_modelyear
 * @property string $rvrdh_dateofinsp
 * @property string $rvrdh_inspstarttime
 * @property string $rvrdh_inspendtime
 * @property int $rvrdh_inspectorname Reference to opalusermst_pk
 * @property string $rvrdh_dateofexpiry
 * @property string $rvrdh_applicationrefno RASIC999/001 (RASIC<OPAL Membership Number>/<Auto incremental number>)
 * @property string $rvrdh_verificationno
 * @property int $rvrdh_applicationtype 1-Initial,2-Renewal
 * @property int $rvrdh_inspectionstatus 1-Inspection Pending,2-Verification Pending,3-Completed,4-Supervisor Approval Pending,5-Declined by Verifier, defautlt 1
 * @property int $rvrdh_permitstatus 1-New,2-Valid,3-Expired
 * @property string $rvrdh_viewstickerpath
 * @property string $rvrdh_printstickerpath
 * @property int $rvrdh_isstickerprinted 1-Yes,2-No
 * @property int $rvrdh_iscardviewed 1-Yes,2-No
 * @property string $rvrdh_firstissuedate
 * @property string $rvrdh_lastissuedon
 * @property string $rvrdh_printedon
 * @property int $rvrdh_printedby
 * @property string $rvrdh_createdon
 * @property int $rvrdh_createdby
 * @property string $rvrdh_updatedon
 * @property int $rvrdh_updatedby
 *
 * @property OpalusermstTbl $rvrdhInspectorname
 * @property RasvehicleownerdtlshstyTbl $rvrdhRasvehicleownerdtlshstyFk
 * @property RasvehicleregdtlsTbl $rvrdhRasvehicleregdtlsFk
 * @property ReferencemstTbl $rvrdhRoadtype
 * @property RascategorymstTbl $rvrdhVechiclecat
 */
class RasvehicleregdtlshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehicleregdtlshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rvrdh_rasvehicleregdtls_fk', 'rvrdh_appinstinfomain_fk', 'rvrdh_opalmemberregmst_fk', 'rvrdh_rasvehicleownerdtlshsty_fk', 'rvrdh_vechicleregno', 'rvrdh_vechiclecat', 'rvrdh_applicationtype', 'rvrdh_inspectionstatus', 'rvrdh_permitstatus', 'rvrdh_createdon', 'rvrdh_createdby'], 'required'],
            [['rvrdh_rasvehicleregdtls_fk', 'rvrdh_appinstinfomain_fk', 'rvrdh_opalmemberregmst_fk', 'rvrdh_rasvehicleownerdtlshsty_fk', 'rvrdh_vechiclecat', 'rvrdh_roadtype', 'rvrdh_inspectorname', 'rvrdh_applicationtype', 'rvrdh_inspectionstatus', 'rvrdh_permitstatus', 'rvrdh_isstickerprinted', 'rvrdh_iscardviewed', 'rvrdh_printedby', 'rvrdh_createdby', 'rvrdh_updatedby'], 'integer'],
            [['rvrdh_vechicleregno', 'rvrdh_chassisno', 'rvrdh_ivmsserialno', 'rvrdh_ivmsvendorname', 'rvrdh_ivmsdevicemodel', 'rvrdh_speedlimitno', 'rvrdh_vechiclefleetno', 'rvrdh_applicationrefno', 'rvrdh_viewstickerpath', 'rvrdh_printstickerpath'], 'string'],
            [['rvrdh_firstropregdate', 'rvrdh_modelyear', 'rvrdh_dateofinsp', 'rvrdh_inspstarttime', 'rvrdh_inspendtime', 'rvrdh_dateofexpiry', 'rvrdh_firstissuedate', 'rvrdh_lastissuedon', 'rvrdh_printedon', 'rvrdh_createdon', 'rvrdh_updatedon'], 'safe'],
            [['rvrdh_verificationno'], 'string', 'max' => 50],
            [['rvrdh_inspectorname'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['rvrdh_inspectorname' => 'opalusermst_pk']],
            [['rvrdh_rasvehicleownerdtlshsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleownerdtlshstyTbl::className(), 'targetAttribute' => ['rvrdh_rasvehicleownerdtlshsty_fk' => 'rasvehicleownerdtlshsty_pk']],
            [['rvrdh_rasvehicleregdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RasvehicleregdtlsTbl::className(), 'targetAttribute' => ['rvrdh_rasvehicleregdtls_fk' => 'rasvehicleregdtls_pk']],
            [['rvrdh_roadtype'], 'exist', 'skipOnError' => true, 'targetClass' => ReferencemstTbl::className(), 'targetAttribute' => ['rvrdh_roadtype' => 'referencemst_pk']],
            [['rvrdh_vechiclecat'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['rvrdh_vechiclecat' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehicleregdtlshsty_pk' => 'Rasvehicleregdtlshsty Pk',
            'rvrdh_rasvehicleregdtls_fk' => 'Rvrdh Rasvehicleregdtls Fk',
            'rvrdh_appinstinfomain_fk' => 'Rvrdh Appinstinfomain Fk',
            'rvrdh_opalmemberregmst_fk' => 'Rvrdh Opalmemberregmst Fk',
            'rvrdh_rasvehicleownerdtlshsty_fk' => 'Rvrdh Rasvehicleownerdtlshsty Fk',
            'rvrdh_vechicleregno' => 'Rvrdh Vechicleregno',
            'rvrdh_chassisno' => 'Rvrdh Chassisno',
            'rvrdh_ivmsserialno' => 'Rvrdh Ivmsserialno',
            'rvrdh_ivmsvendorname' => 'Rvrdh Ivmsvendorname',
            'rvrdh_ivmsdevicemodel' => 'Rvrdh Ivmsdevicemodel',
            'rvrdh_speedlimitno' => 'Rvrdh Speedlimitno',
            'rvrdh_vechiclecat' => 'Rvrdh Vechiclecat',
            'rvrdh_vechiclefleetno' => 'Rvrdh Vechiclefleetno',
            'rvrdh_roadtype' => 'Rvrdh Roadtype',
            'rvrdh_firstropregdate' => 'Rvrdh Firstropregdate',
            'rvrdh_modelyear' => 'Rvrdh Modelyear',
            'rvrdh_dateofinsp' => 'Rvrdh Dateofinsp',
            'rvrdh_inspstarttime' => 'Rvrdh Inspstarttime',
            'rvrdh_inspendtime' => 'Rvrdh Inspendtime',
            'rvrdh_inspectorname' => 'Rvrdh Inspectorname',
            'rvrdh_dateofexpiry' => 'Rvrdh Dateofexpiry',
            'rvrdh_applicationrefno' => 'Rvrdh Applicationrefno',
            'rvrdh_verificationno' => 'Rvrdh Verificationno',
            'rvrdh_applicationtype' => 'Rvrdh Applicationtype',
            'rvrdh_inspectionstatus' => 'Rvrdh Inspectionstatus',
            'rvrdh_permitstatus' => 'Rvrdh Permitstatus',
            'rvrdh_viewstickerpath' => 'Rvrdh Viewstickerpath',
            'rvrdh_printstickerpath' => 'Rvrdh Printstickerpath',
            'rvrdh_isstickerprinted' => 'Rvrdh Isstickerprinted',
            'rvrdh_iscardviewed' => 'Rvrdh Iscardviewed',
            'rvrdh_firstissuedate' => 'Rvrdh Firstissuedate',
            'rvrdh_lastissuedon' => 'Rvrdh Lastissuedon',
            'rvrdh_printedon' => 'Rvrdh Printedon',
            'rvrdh_printedby' => 'Rvrdh Printedby',
            'rvrdh_createdon' => 'Rvrdh Createdon',
            'rvrdh_createdby' => 'Rvrdh Createdby',
            'rvrdh_updatedon' => 'Rvrdh Updatedon',
            'rvrdh_updatedby' => 'Rvrdh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdhInspectorname()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'rvrdh_inspectorname']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdhRasvehicleownerdtlshstyFk()
    {
        return $this->hasOne(RasvehicleownerdtlshstyTbl::className(), ['rasvehicleownerdtlshsty_pk' => 'rvrdh_rasvehicleownerdtlshsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdhRasvehicleregdtlsFk()
    {
        return $this->hasOne(RasvehicleregdtlsTbl::className(), ['rasvehicleregdtls_pk' => 'rvrdh_rasvehicleregdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdhRoadtype()
    {
        return $this->hasOne(ReferencemstTbl::className(), ['referencemst_pk' => 'rvrdh_roadtype']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRvrdhVechiclecat()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'rvrdh_vechiclecat']);
    }

    /**
     * {@inheritdoc}
     * @return RasvehicleregdtlshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RasvehicleregdtlshstyTblQuery(get_called_class());
    }


    
    public static function movetohistory($data)
    {
        $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=','rvodh_rasvehicleownerdtls_fk',$data->rvrd_rasvehicleownerdtls_fk])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];
        
        if(!$ownerhistory)
        {
          $ownermodel = RasvehicleownerdtlsTbl::findOne($data->rvrd_rasvehicleownerdtls_fk);
          $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);  
        }
        
        
        $model = new RasvehicleregdtlshstyTbl();
        $model->rvrdh_rasvehicleregdtls_fk = $data->rasvehicleregdtls_pk;
        $model->rvrdh_appinstinfomain_fk = $data->rvrd_appinstinfomain_fk;
        $model->rvrdh_opalmemberregmst_fk = $data->rvrd_opalmemberregmst_fk;
        $model->rvrdh_rasvehicleownerdtlshsty_fk = (int)$ownerhistory;
        $model->rvrdh_vechicleregno = $data->rvrd_vechicleregno;
        $model->rvrdh_chassisno = $data->rvrd_chassisno;
        $model->rvrdh_odometerreading = $data->rvrd_odometerreading;
        $model->rvrdh_ivmsserialno = $data->rvrd_ivmsserialno;
        $model->rvrdh_ivmsvendorname = $data->rvrd_ivmsvendorname;
        $model->rvrdh_ivmsdevicemodel = $data->rvrd_ivmsdevicemodel;
        $model->rvrdh_speedlimitno = $data->rvrd_speedlimitno;
        $model->rvrdh_vechiclecat = $data->rvrd_vechiclecat;
        $model->rvrdh_vechiclefleetno = $data->rvrd_vechiclefleetno;
        $model->rvrdh_roadtype = $data->rvrd_roadtype;
        $model->rvrdh_firstropregdate = $data->rvrd_firstropregdate;
        $model->rvrdh_modelyear = $data->rvrd_modelyear;
        $model->rvrdh_dateofinsp = $data->rvrd_dateofinsp;
        $model->rvrdh_inspstarttime = $data->rvrd_inspstarttime;
        $model->rvrdh_inspendtime = $data->rvrd_inspendtime;
        $model->rvrdh_inspectorname = $data->rvrd_inspectorname;
        $model->rvrdh_dateofexpiry = $data->rvrd_dateofexpiry;
        $model->rvrdh_applicationrefno = $data->rvrd_applicationrefno;
        $model->rvrdh_verificationno = $data->rvrd_verificationno;
        $model->rvrdh_applicationtype = $data->rvrd_applicationtype;
        $model->rvrdh_inspectionstatus = $data->rvrd_inspectionstatus;
        $model->rvrdh_permitstatus = $data->rvrd_permitstatus;
        $model->rvrdh_viewstickerpath = $data->rvrd_viewstickerpath;
        $model->rvrdh_printstickerpath = $data->rvrd_printstickerpath;
        $model->rvrdh_isstickerprinted = $data->rvrd_isstickerprinted;
        $model->rvrdh_iscardviewed = $data->rvrd_iscardviewed;
        $model->rvrdh_firstissuedate = $data->rvrd_firstissuedate;
        $model->rvrdh_lastissuedon = $data->rvrd_lastissuedon;
        $model->rvrdh_printedon = $data->rvrd_printedon;
        $model->rvrdh_printedby = $data->rvrd_printedby;
        $model->rvrdh_createdon = $data->rvrd_createdon;
        $model->rvrdh_createdby = $data->rvrd_createdby;
        $model->rvrdh_updatedon = $data->rvrd_updatedon;
        $model->rvrdh_updatedby = $data->rvrd_updatedby;

        if($model->save())
            {
                return $model->rasvehicleregdtlshsty_pk;
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
    }
}
