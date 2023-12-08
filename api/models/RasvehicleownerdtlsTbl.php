<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rasvehicleownerdtls_tbl".
 *
 * @property int $rasvehicleownerdtls_pk
 * @property string $rvod_ownername_en
 * @property string $rvod_ownername_ar
 * @property string $rvod_crnumber
 * @property int $rvod_status 1-Active,2-Inactive default 1
 * @property string $rvod_createdon
 * @property int $rvod_createdby
 * @property string $rvod_updatedon
 * @property int $rvod_updatedby
 *
 * @property RasvehicleownerdtlshstyTbl[] $rasvehicleownerdtlshstyTbls
 */
class RasvehicleownerdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rasvehicleownerdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rvod_ownername_en', 'rvod_ownername_ar', 'rvod_crnumber', 'rvod_createdby'], 'required'],
            [['rvod_ownername_en', 'rvod_ownername_ar', 'rvod_crnumber'], 'string'],
            [['rvod_status', 'rvod_createdby', 'rvod_updatedby'], 'integer'],
            [['rvod_createdon', 'rvod_updatedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rasvehicleownerdtls_pk' => 'Rasvehicleownerdtls Pk',
            'rvod_ownername_en' => 'Rvod Ownername En',
            'rvod_ownername_ar' => 'Rvod Ownername Ar',
            'rvod_crnumber' => 'Rvod Crnumber',
            'rvod_status' => 'Rvod Status',
            'rvod_createdon' => 'Rvod Createdon',
            'rvod_createdby' => 'Rvod Createdby',
            'rvod_updatedon' => 'Rvod Updatedon',
            'rvod_updatedby' => 'Rvod Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRasvehicleownerdtlshstyTbls()
    {
        return $this->hasMany(RasvehicleownerdtlshstyTbl::className(), ['rvodh_rasvehicleownerdtls_fk' => 'rasvehicleownerdtls_pk']);
    }
    
    public static function saveVehicleOwner($data)
    {
       
          $userpk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $ownerdtl = RasvehicleownerdtlsTbl::find()->where(['=','rvod_crnumber',trim($data['crNumber'])])->one();
        if($ownerdtl)
        {
            if($ownerdtl->rvod_ownername_en == trim($data['ownName']) && $ownerdtl->rvod_ownername_ar == trim($data['ownNameArb']))
            {
                $ownerdtlpk = $ownerdtl->rasvehicleownerdtls_pk;
            }
            else
            {
                $historymodel = RasvehicleownerdtlshstyTbl::movetohistory($ownerdtl);
                $ownerdtl->rvod_ownername_en = trim($data['ownName']);
                $ownerdtl->rvod_ownername_ar = trim($data['ownNameArb']);
                $ownerdtl->rvod_updatedon = date('Y-m-d H:i:s');
                $ownerdtl->rvod_updatedby = $userpk;
                
                if($historymodel && $ownerdtl->save())
                {
                   $ownerdtlpk =  $ownerdtl->rasvehicleownerdtls_pk;
                }
                else
                {
                    echo "<pre>";
                    var_dump($ownerdtl->getErrors());
                    exit;
                }
            }
            
        }
        else
        {
            $model = new RasvehicleownerdtlsTbl();
        
            $model->rvod_ownername_en = trim($data['ownName']);
            $model->rvod_ownername_ar = trim($data['ownNameArb']);
            $model->rvod_crnumber = trim($data['crNumber']);
            $model->rvod_status = 1;
            $model->rvod_createdon = date('Y-m-d H:i:s');
            $model->rvod_createdby = $userpk;
            if($model->save())
            {
                $ownerdtlpk = $model->rasvehicleownerdtls_pk;
            }
            else
            {
                echo "<pre>";
                var_dump($model->getErrors());
                exit;
            }
        }
        
        return $ownerdtlpk;
    }
    
    public static function getpreviousownerlist($searchdata=null,$type=1)
    {
        
       $columnname  = $type == 2 ? 'rvod_ownername_ar' : 'rvod_ownername_en';
        
        $model = self::find()
                ->select(['rasvehicleownerdtls_pk as pk','rvod_ownername_en as name_en','rvod_ownername_ar as name_ar','rvod_crnumber as crnumber'])
                ->andWhere(['=','rvod_status',1]);
        if($searchdata)
        {
            $model->where(['Like',$columnname,$searchdata]);
        }
       
        $data = $model->asArray()
                ->all();
        
        return $data;
    }
}
