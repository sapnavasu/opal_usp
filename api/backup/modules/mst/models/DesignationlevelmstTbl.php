<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "designationlevelmst_tbl".
 *
 * @property int $designationlevelmst_pk Primary key
 * @property int $dlm_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $dlm_desglevelname Designation level name
 * @property int $dlm_status 1 - Active, 2 - Inactive
 * @property string $dlm_createdon Datetime of creation
 * @property int $dlm_createdby Reference to usermst_tbl
 * @property string $dlm_createdbyipaddr IP Address of the user
 * @property string $dlm_updatedon Datetime of updation
 * @property int $dlm_updatedby Reference to usermst_tbl
 * @property string $dlm_updatebyipaddr IP Address of the user
 */
class DesignationlevelmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'designationlevelmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dlm_globalportalmst_fk', 'dlm_status', 'dlm_createdby', 'dlm_updatedby'], 'integer'],
            [['dlm_desglevelname', 'dlm_status', 'dlm_createdby'], 'required'],
            [['dlm_createdon', 'dlm_updatedon'], 'safe'],
            [['dlm_desglevelname', 'dlm_createdbyipaddr', 'dlm_updatebyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'designationlevelmst_pk' => 'Designationlevelmst Pk',
            'dlm_globalportalmst_fk' => 'Dlm Globalportalmst Fk',
            'dlm_desglevelname' => 'Dlm Desglevelname',
            'dlm_status' => 'Dlm Status',
            'dlm_createdon' => 'Dlm Createdon',
            'dlm_createdby' => 'Dlm Createdby',
            'dlm_createdbyipaddr' => 'Dlm Createdbyipaddr',
            'dlm_updatedon' => 'Dlm Updatedon',
            'dlm_updatedby' => 'Dlm Updatedby',
            'dlm_updatebyipaddr' => 'Dlm Updatebyipaddr',
        ];
    }
    
    public static function designationLevelList(){
        return self::find()
                ->select(['designationlevelmst_pk as pk','dlm_desglevelname as name'])
                ->where(['dlm_status' => 1])
                ->orderBy(['dlm_desglevelname' => SORT_ASC])
                ->asArray()
                ->all();
    }
    
    public static function isAlreadyExistOrCreateNew($desgn){
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
        if(!empty($desgn)){
            $model = self::find()
                    ->where(['LIKE', 'lower(dlm_desglevelname)', $desgn])
                    ->one();
            $pk = $model->designationlevelmst_pk;
            if(empty($pk)){
                $model = new DesignationlevelmstTbl();
                $model->dlm_desglevelname = $desgn;
                $model->dlm_status = 1;
                $model->dlm_createdon = \common\components\Common::convertDateTimeToServerTimezone(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                $model->dlm_createdby = $userpk;
                $model->dlm_createdbyipaddr = \common\components\Common::getIpAddress();
                $model->save();
                $pk = $model->designationlevelmst_pk;
            }
        }
        return $pk;
    }
}
