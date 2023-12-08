<?php

namespace api\modules\mst\models;
use yii\data\ActiveDataProvider;
use \common\components\Security;
use common\components\Common;

use Yii;

/**
 * This is the model class for table "licproceduremst_tbl".
 *
 * @property int $licproceduremst_pk Primary key
 * @property int $lpm_sectormst_fk Reference to sectormst_tbl.sectormst_pk
 * @property int $lpm_subsectormst_fk Reference to subsectormst_tbl.subsectormst_pk
 * @property int $lpm_steps Steps
 * @property string $lpm_refno Procedure reference no
 * @property string $lpm_procedurename_en Procedure Name in English
 * @property string $lpm_desc_en Description in English
 * @property string $lpm_targetduration_en Target Duration in English
 * @property string $lpm_regfee_en Registration Fee in English
 * @property string $lpm_applicable_en Applicable in English
 * @property string $lpm_prerequisites_en Prerequisites in English
 * @property string $lpm_process_en Process in English
 * @property string $lpm_splicauth_fk Commo separated value of licensauthoritiesmst_pk. Reference to licensauthoritiesmst_tbl
 * @property string $lpm_isicactivitymst_fk Commo separated value of isicactivitymst_pk. ISIC Activity Master reference
 * @property int $lpm_status Procedure Status. 1 - Active,2 - InActive, 3 - Deleted
 * @property string $lpm_createdon Record created on date & time
 * @property int $lpm_createdby Record created by user id
 * @property string $lpm_createdbyipaddr IP Address of the user
 * @property string $lpm_updatedon Record updated on date & time
 * @property int $lpm_updatedby Record updated by user id
 * @property string $lpm_updatedbyipaddr IP Address of the user
 * @property string $lpm_deletedon Datetim of deletion
 * @property int $lpm_deletedby Record deleted by user id
 */
class LicproceduremstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'licproceduremst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lpm_sectormst_fk', 'lpm_subsectormst_fk', 'lpm_steps', 'lpm_status', 'lpm_createdby', 'lpm_updatedby', 'lpm_deletedby'], 'integer'],
            [['lpm_refno', 'lpm_procedurename_en', 'lpm_desc_en', 'lpm_targetduration_en', 'lpm_regfee_en', 'lpm_applicable_en', 'lpm_prerequisites_en', 'lpm_process_en', 'lpm_splicauth_fk', 'lpm_createdon', 'lpm_createdby'], 'required'],
            [['lpm_desc_en', 'lpm_targetduration_en', 'lpm_regfee_en', 'lpm_applicable_en', 'lpm_prerequisites_en', 'lpm_process_en'], 'string'],
            [['lpm_createdon', 'lpm_updatedon', 'lpm_deletedon'], 'safe'],
            [['lpm_refno'], 'string', 'max' => 50],
            [['lpm_procedurename_en', 'lpm_splicauth_fk', 'lpm_isicactivitymst_fk'], 'string', 'max' => 500],
            [['lpm_createdbyipaddr', 'lpm_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'licproceduremst_pk' => 'Licproceduremst Pk',
            'lpm_sectormst_fk' => 'Lpm Sectormst Fk',
            'lpm_subsectormst_fk' => 'Lpm Subsectormst Fk',
            'lpm_steps' => 'Lpm Steps',
            'lpm_refno' => 'Lpm Refno',
            'lpm_procedurename_en' => 'Lpm Procedurename En',
            'lpm_desc_en' => 'Lpm Desc En',
            'lpm_targetduration_en' => 'Lpm Targetduration En',
            'lpm_regfee_en' => 'Lpm Regfee En',
            'lpm_applicable_en' => 'Lpm Applicable En',
            'lpm_prerequisites_en' => 'Lpm Prerequisites En',
            'lpm_process_en' => 'Lpm Process En',
            'lpm_splicauth_fk' => 'Lpm Splicauth Fk',
            'lpm_isicactivitymst_fk' => 'Lpm Isicactivitymst Fk',
            'lpm_status' => 'Lpm Status',
            'lpm_createdon' => 'Lpm Createdon',
            'lpm_createdby' => 'Lpm Createdby',
            'lpm_createdbyipaddr' => 'Lpm Createdbyipaddr',
            'lpm_updatedon' => 'Lpm Updatedon',
            'lpm_updatedby' => 'Lpm Updatedby',
            'lpm_updatedbyipaddr' => 'Lpm Updatedbyipaddr',
            'lpm_deletedon' => 'Lpm Deletedon',
            'lpm_deletedby' => 'Lpm Deletedby',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LicproceduremstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LicproceduremstTblQuery(get_called_class());
    }
    public static function getProcedureList(){     
        
        $model = LicproceduremstTbl::find()
                ->select(['licproceduremst_pk','lpm_procedurename_en'])
                ->where(['=','lpm_status',1])
                ->orderBy(['lpm_procedurename_en'=> SORT_ASC])
                ->asArray()->all();
        return $model;
    }
}
