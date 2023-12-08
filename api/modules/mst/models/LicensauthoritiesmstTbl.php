<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use \common\components\Security;
use common\components\Common;

use Yii;

/**
 * This is the model class for table "licensauthoritiesmst_tbl".
 *
 * @property int $licensauthoritiesmst_pk Primary key
 * @property int $lam_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property string $lam_licenseauthname_en License Authority Name in English
 * @property int $lam_status Procedure Status. 1 - Active,2 - Inactive
 * @property string $lam_createdon Record created on date & time
 * @property int $lam_createdby Record created by user id
 * @property string $lam_createdbyipaddr IP Address of the user
 * @property string $lam_updatedon Record updated on date & time
 * @property int $lam_updatedby Record updated by user id
 * @property string $lam_updatedbyipaddr IP Address of the user
 */
class LicensauthoritiesmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licensauthoritiesmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lam_memberregmst_fk', 'lam_status', 'lam_createdby', 'lam_updatedby'], 'integer'],
            [['lam_licenseauthname_en', 'lam_status', 'lam_createdon', 'lam_createdby'], 'required'],
            [['lam_createdon', 'lam_updatedon'], 'safe'],
            [['lam_licenseauthname_en'], 'string', 'max' => 500],
            [['lam_createdbyipaddr', 'lam_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licensauthoritiesmst_pk' => 'Licensauthoritiesmst Pk',
            'lam_memberregmst_fk' => 'Lam Memberregmst Fk',
            'lam_licenseauthname_en' => 'Lam Licenseauthname En',
            'lam_status' => 'Lam Status',
            'lam_createdon' => 'Lam Createdon',
            'lam_createdby' => 'Lam Createdby',
            'lam_createdbyipaddr' => 'Lam Createdbyipaddr',
            'lam_updatedon' => 'Lam Updatedon',
            'lam_updatedby' => 'Lam Updatedby',
            'lam_updatedbyipaddr' => 'Lam Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicensauthoritiesmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicensauthoritiesmstTblQuery(get_called_class());
    }
    public static function editLicAuthlist($id){              
        return new ActiveDataProvider([
            'query' => LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk','lam_licenseauthname_en'])
                ->leftJoin('licauthusers_tbl','licauthusers_tbl.lau_usrmst_fk=licensauthoritiesmst_tbl.licensauthoritiesmst_pk')
                ->where(['=','lam_status',1])
                ->andWhere('lau_licensinginfo_fk = :lau_licensinginfo_fk',[':lau_licensinginfo_fk' => $id])
                ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
        ]);
    }
    // public static function licAuthoritList(){     
    //     return new ActiveDataProvider([
    //         'query' => LicensauthoritiesmstTbl::find()
    //             ->select(['licensauthoritiesmst_pk as value','lam_licenseauthname_en as display'])
    //             ->where(['=','lam_status',1])
    //             ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
    //     ]);
    // }
    public static function licAuthoritList(){     
        $model =  LicensauthoritiesmstTbl::find()
                ->select(['licensauthoritiesmst_pk as value','lam_licenseauthname_en as display'])
                ->where(['=','lam_status',1])
                ->orderBy(['lam_licenseauthname_en'=> SORT_ASC])
                ->asArray()->all();
                return $model;
        
    }
}
