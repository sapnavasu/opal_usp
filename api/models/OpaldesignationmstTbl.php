<?php

namespace app\models;

use Yii;
use api\components\Common;

/**
 * This is the model class for table "opaldesignationmst_tbl".
 *
 * @property int $opaldesignationmst_pk
 * @property string $odsg_opaldesignationname
 * @property int $odsg_status 1-Active, 2-In active
 * @property string $odsg_createdon Datetime of creation
 * @property int $odsg_createdby Reference to opalusermst_tbl
 * @property string $odsg_createdbyipaddr IP Address of the user
 * @property string $odsg_updatedon Updated on datetime
 * @property int $odsg_updatedby Reference to opalusermst_tbl
 * @property string $odsg_updatedbyipaddr IP Address of the user
 */
class OpaldesignationmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opaldesignationmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['odsg_opaldesignationname', 'odsg_status', 'odsg_createdon', 'odsg_createdby'], 'required'],
            [['odsg_status', 'odsg_createdby', 'odsg_updatedby'], 'integer'],
            [['odsg_createdon', 'odsg_updatedon'], 'safe'],
            [['odsg_opaldesignationname'], 'string', 'max' => 100],
            [['odsg_createdbyipaddr', 'odsg_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opaldesignationmst_pk' => 'Opaldesignationmst Pk',
            'odsg_opaldesignationname' => 'Odsg Opaldesignationname',
            'odsg_status' => 'Odsg Status',
            'odsg_createdon' => 'Odsg Createdon',
            'odsg_createdby' => 'Odsg Createdby',
            'odsg_createdbyipaddr' => 'Odsg Createdbyipaddr',
            'odsg_updatedon' => 'Odsg Updatedon',
            'odsg_updatedby' => 'Odsg Updatedby',
            'odsg_updatedbyipaddr' => 'Odsg Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OpaldesignationmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpaldesignationmstTblQuery(get_called_class());
    }
    
    public static function createNewDesig($degination,$userpk)
    {
        
        $desig = OpaldesignationmstTbl::find()->where(['=','odsg_opaldesignationname', $degination])->one();
        if($desig)
        {
            return $desig->opaldesignationmst_pk;
        }
        else
        {
          $model = new OpaldesignationmstTbl();
        $model->odsg_opaldesignationname = $degination;
        $model->odsg_status = 1;
        $model->odsg_createdon = date('Y-m-d H:i:s');
        $model->odsg_createdby = $userpk;
        $model->odsg_createdbyipaddr = Common::getIpAddress(); 
        
        if($model->save())
        {
            return $model->opaldesignationmst_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }  
        }
        
    }
}
