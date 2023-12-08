<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memcompadditonalinfo_tbl".
 *
 * @property int $memcompadditonalinfo_pk
 * @property int $mcai_membercompanymst_fk
 * @property int $mcai_certtype 1 - Tender Board Registration, 2 - Riyada Certificate, 3 - VAT Certification
 * @property int $mcai_yesno 1-Yes, 2-No
 * @property string $mcai_certnumber
 * @property string $mcai_createdon
 * @property int $mcai_createdby
 * @property string $mcai_updatedon
 * @property int $mcai_updatedby
 */
class MemcompadditonalinfoTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompadditonalinfo_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcai_membercompanymst_fk', 'mcai_certtype', 'mcai_yesno', 'mcai_createdon', 'mcai_createdby'], 'required'],
            [['mcai_membercompanymst_fk', 'mcai_certtype', 'mcai_yesno', 'mcai_createdby', 'mcai_updatedby'], 'integer'],
            [['mcai_createdon', 'mcai_updatedon'], 'safe'],
            [['mcai_certnumber'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompadditonalinfo_pk' => 'Memcompadditonalinfo Pk',
            'mcai_membercompanymst_fk' => 'Mcai Membercompanymst Fk',
            'mcai_certtype' => 'Mcai Certtype',
            'mcai_yesno' => 'Mcai Yesno',
            'mcai_certnumber' => 'Mcai Certnumber',
            'mcai_createdon' => 'Mcai Createdon',
            'mcai_createdby' => 'Mcai Createdby',
            'mcai_updatedon' => 'Mcai Updatedon',
            'mcai_updatedby' => 'Mcai Updatedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompadditonalinfoTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompadditonalinfoTblQuery(get_called_class());
    }
    
    public static function saveAdditionalInfos($requestdata,$compdtls,$userdtls)
    {
        $data['userid'] = $userdtls->UserMst_Pk;
        $data['compid'] = $compdtls->MemberCompMst_Pk;
    
       if($requestdata['istenderbrdreg']==1)
       {
           $datatend['type'] = 1;
           $datatend['certnumber'] = $requestdata['tenderbrdregnum'];
           $datatend['yesno'] = 1;
           $tenderpk = self::newAdditionalinfo($datatend,$data);  
       }
       else
       {
           $datatend['type'] = 1;
           $datatend['yesno'] = 2;
           $tenderpk = self::newAdditionalinfo($datatend,$data); 
       }
       
       
       if($requestdata['isRiyadacert']==1)
       {
           $datariya['type'] = 2;
           $datariya['certnumber'] = $requestdata['riyadacertnum'];
           $datariya['yesno'] = 1;
           $riyadapk = self::newAdditionalinfo($datariya,$data);  
       }
       else
       {
           $datariya['type'] = 2;
           $datariya['yesno'] = 2;
           $riyadapk = self::newAdditionalinfo($datariya,$data); 
       }
       
       
       if($requestdata['isVatCert']==1)
       {
           $datavat['type'] = 3;
           $datavat['certnumber'] = $requestdata['vatcertnum'];
           $datavat['yesno'] = 1;
           $vatpk = self::newAdditionalinfo($datavat,$data);  
       }
       else
       {
           $datavat['type'] = 3;
           $datavat['yesno'] = 2;
           $vatpk = self::newAdditionalinfo($datavat,$data); 
       }
       
       
        if($requestdata['isjsrscert']==1)
       {
           $datajsrs['type'] = 4;
           $datajsrs['certnumber'] = $requestdata['jsrscertnum'];
           $datajsrs['yesno'] = 1;
           $jsrspk = self::newAdditionalinfo($datajsrs,$data);  
       }
       else
       {
           $datajsrs['type'] = 4;
           $datajsrs['yesno'] = 2;
           $jsrspk = self::newAdditionalinfo($datajsrs,$data); 
       }
       
       $additionalinfopks['vatpk']=$vatpk;
       $additionalinfopks['riyadapk']=$riyadapk;
       $additionalinfopks['tenderpk']=$tenderpk;
       $additionalinfopks['jsrspk']=$jsrspk;
       
       return $additionalinfopks;
       
       
    }
    
    public static function newAdditionalinfo($datacert,$data)
    {
        $model = new MemcompadditonalinfoTbl;
        $model->mcai_yesno = $datacert['yesno'];
        $model->mcai_membercompanymst_fk = $data['compid'];
        $model->mcai_certtype = $datacert['type'];
        $model->mcai_certnumber = $datacert['certnumber']?$datacert['certnumber']:null;
        $model->mcai_createdby = $data['userid'];
        $model->mcai_createdon = date('Y-m-d H:i:s');
        
        if($model->save())
        {
            return $model->memcompadditonalinfo_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
    }

    public function getRiyadaCertNumber($value)
    {
        $res = '';    
        $model =  self::find()
                ->select('*')
                ->where(['mcai_membercompanymst_fk'=>$value,
                         'mcai_certtype' =>2,
                         'mcai_yesno' => 1
                        ])->asArray()->one();

        if(!empty($model) && isset($model['mcai_certnumber'])) {
            $res = $model['mcai_certnumber'];
            return $res;
        } else {
            return $res;
        }
    }

    public function getJsrsNumber($value) {
        $res = '';    
        $model =  self::find()
                ->select('*')
                ->where(['mcai_membercompanymst_fk'=>$value,
                         'mcai_certtype' =>4,
                         'mcai_yesno' => 1
                        ])->asArray()->one();

        if(!empty($model) && isset($model['mcai_certnumber'])) {
            $res = $model['mcai_certnumber'];
            return $res;
        } else {
            return $res;
        }
    }
    public function getVATCertNumber($value)
    {
        $res = '';    
        $model =  self::find()
                ->select('*')
                ->where(['mcai_membercompanymst_fk'=>$value,
                         'mcai_certtype' =>3,
                         'mcai_yesno' => 1
                        ])->asArray()->one();

        if(!empty($model) && isset($model['mcai_certnumber'])) {
            $res = $model['mcai_certnumber'];
            return $res;
        } else {
            return $res;
        }
    }
}
