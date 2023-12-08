<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "designationmst_tbl".
 *
 * @property int $designationmst_pk
 * @property int $dsg_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $dsg_designationname
 * @property int $dsg_status Status of the designation
 * @property string $dsg_createdon Datetime of creation
 * @property int $dsg_createdby Reference to usermst_tbl
 * @property string $dsg_createdbyipaddr IP Address of the user
 * @property string $dsg_updatedon Updated on datetime
 * @property int $dsg_updatedby Reference to usermst_tbl
 * @property string $dsg_updatedbyipaddr IP Address of the user
 */
class DesignationmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designationmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dsg_globalportalmst_fk', 'dsg_status', 'dsg_createdby', 'dsg_updatedby'], 'integer'],
            [['dsg_designationname', 'dsg_status', 'dsg_createdby'], 'required'],
            [['dsg_createdon', 'dsg_updatedon'], 'safe'],
            [['dsg_designationname', 'dsg_createdbyipaddr', 'dsg_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'designationmst_pk' => 'Designationmst Pk',
            'dsg_globalportalmst_fk' => 'Dsg Globalportalmst Fk',
            'dsg_designationname' => 'Dsg Designationname',
            'dsg_status' => 'Dsg Status',
            'dsg_createdon' => 'Dsg Createdon',
            'dsg_createdby' => 'Dsg Createdby',
            'dsg_createdbyipaddr' => 'Dsg Createdbyipaddr',
            'dsg_updatedon' => 'Dsg Updatedon',
            'dsg_updatedby' => 'Dsg Updatedby',
            'dsg_updatedbyipaddr' => 'Dsg Updatedbyipaddr',
        ];
    }
    
    public static function designationList(){
        return self::find()
                ->select(['designationmst_pk as pk','dsg_designationname as name'])
                ->where(['dsg_status' => 1])
                ->orderBy(['dsg_designationname' => SORT_ASC])
                ->asArray()
                ->all();
    }
    
    public static function createNewDesignation($desgn, $userpk = ''){
        $userpk = ($userpk) ? $userpk : \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $pk = self::find()
                ->where(['dsg_designationname' => $desgn,'dsg_createdby' => $userpk, 'dsg_status' => 1])
                ->asArray()->one()['designationmst_pk'];
        if(empty($pk) && !empty($desgn)){
            $model = new DesignationmstTbl();
            $model->dsg_designationname = $desgn;
            $model->dsg_status = 1;
            $model->dsg_createdon = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
            $model->dsg_createdby = $userpk;
            $model->dsg_createdbyipaddr = \common\components\Common::getIpAddress();
            $model->save();
            $pk = $model->designationmst_pk;
        }
        return $pk;
    }

    public static function isAlreadyExistOrCreateNew($desgn, $userpk = ''){
        $userpk = ($userpk) ? $userpk : \yii\db\ActiveRecord::getTokenData('user_pk', true);
        $pk = null;
        if(!empty($desgn)){
           
            $model = self::find()
                    ->where('dsg_designationname = BINARY '.'"'.$desgn.'"')->one();

            $pk = $model->designationmst_pk;
            if(empty($pk)){

                $model = new DesignationmstTbl();
                $model->dsg_designationname = $desgn;
                $model->dsg_status = 1;
                $model->dsg_createdon = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $model->dsg_createdby = $userpk;
                $model->dsg_createdbyipaddr = \common\components\Common::getIpAddress();
                $model->save();
                $pk = $model->designationmst_pk;
            }
        }
        return $pk;
    }

    public static function getDesignationName($designationPk){
        $designationName = self::find()
                ->select(['dsg_designationname'])
                ->where([
                    'dsg_status' => 1,
                    'designationmst_pk' => $designationPk,
                ])
                ->one();
        return $designationName->dsg_designationname;
    }
}
