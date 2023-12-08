<?php

namespace api\modules\mst\models;

use Yii;
use \common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "licauthdtls_tbl".
 *
 * @property int $licauthdtls_pk Primary key
 * @property int $lad_licensinginfo_fk Reference to licensinginfo_tbl
 * @property int $lad_licensauthoritiesmst_fk Reference to licensauthorities_tbl
 * @property string $lad_createdon Record created on date & time
 * @property int $lad_createdby Record created by user id
 * @property string $lad_createdbyipaddr IP Address of the user
 */
class LicauthdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licauthdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lad_licensinginfo_fk', 'lad_licensauthoritiesmst_fk', 'lad_createdon', 'lad_createdby'], 'required'],
            [['lad_licensinginfo_fk', 'lad_licensauthoritiesmst_fk', 'lad_createdby'], 'integer'],
            [['lad_createdon'], 'safe'],
            [['lad_createdbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licauthdtls_pk' => 'Licauthdtls Pk',
            'lad_licensinginfo_fk' => 'Lad Licensinginfo Fk',
            'lad_licensauthoritiesmst_fk' => 'Lad Licensauthoritiesmst Fk',
            'lad_createdon' => 'Lad Createdon',
            'lad_createdby' => 'Lad Createdby',
            'lad_createdbyipaddr' => 'Lad Createdbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicauthdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicauthdtlsTblQuery(get_called_class());
    }
    public static function licenseAuthDtls($data){
        $id = Security::decrypt($data);
        $id = Security::sanitizeInput($id, "number");
        $model = LicauthdtlsTbl::find()
                ->select('group_concat(lam_licenseauthname_en) as licAuthDtls')
                ->leftJoin('licensauthoritiesmst_tbl','licensauthoritiesmst_pk=lad_licensauthoritiesmst_fk')
                ->where('lad_licensinginfo_fk=:lad_licensinginfo_fk',[':lad_licensinginfo_fk'=> $id])->asArray()->all();
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
    public static function getSelectedAuthlist($data){        
        return new ActiveDataProvider([
            'query' => LicauthdtlsTbl::find()
                ->select(['lad_licensauthoritiesmst_fk'])
                ->Where('lad_licensinginfo_fk=:lad_licensinginfo_fk',[':lad_licensinginfo_fk'=>$data])
        ]);
    }
}
