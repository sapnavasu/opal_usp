<?php

namespace api\modules\ct\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use common\components\Security;
use common\components\Common;

/**
 * This is the model class for table "jdomodulemst_tbl".
 *
 * @property int $jdomodulemst_pk Primary key
 * @property string $jdmm_modulename name of the module
 * @property int $jdmm_status 1 - Active, 2 - Inactive
 * @property string $jdmm_createdon Datetime of creation
 * @property int $jdmm_createdby Reference to usermst_tbl
 * @property string $jdmm_createdbyipaddr IP Address of the user
 * @property string $jdmm_updatedon 1 - Web, 2 - Android, 3 - IOS
 * @property int $jdmm_updatedby Reference to usermst_tbl
 * @property string $jdmm_updatedbyipaddr IP Address of the user
 * 
 */
class JdomodulemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomodulemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmm_modulename', 'jdmm_status', 'jdmm_createdby'], 'required'],
            [['jdmm_status', 'jdmm_updatedby'], 'integer'],//'jdmm_modulename', 'jdmm_createdbyipaddr',
            [['jdmm_modulename', 'jdmm_createdon', 'jdmm_updatedbyipaddr', 'jdmm_createdbyipaddr'], 'string'],
            [['jdmm_createdon'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdomodulemst_pk' => 'Jdomodulemst Pk',
            'jdmm_modulename' => 'Jdmm Modulename',
            'jdmm_status' => 'Jdmm Status',
            'jdmm_createdon' => 'Jdmm Createdon',
            'jdmm_createdby' => 'Jdmm Createdby',
            'jdmm_createdbyipaddr' => 'Jdmm Createdbyipaddr',
            'jdmm_updatedon' => 'Jdmm Updatedon',
            'jdmm_updatedby' => 'Jdmm Updatedby',
            'jdmm_updatedbyipaddr' => 'Jdmm Updatedbyipaddr'
        ];
    }
    
}
