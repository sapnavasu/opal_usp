<?php

namespace api\modules\mst\models;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;
use \common\components\Security;
use common\components\Common;

/**
 * This is the model class for table "subsectormst_tbl".
 *
 * @property int $subsectormst_pk Primary key
 * @property int $ssm_sectormst_fk Reference to sectormst_tbl
 * @property int $ssm_subsectormst_fk Reference to subsectormst_tbl
 * @property string $ssm_subsectorname Sector name in English
 * @property string $ssm_subsectorname_ara Sector name in Arabic
 * @property int $ssm_status Sub Sector Status : 1 - Active, 0 - In-Active
 * @property int $ssm_guidestatus Sub Sector Guide Status : 1 - Active, 0 - In-Active
 * @property string $ssm_createdon Record created on date & time
 * @property int $ssm_createdby Record created by user id
 * @property string $ssm_createdbyipaddr IP Address of the user
 * @property string $ssm_updatedon Record updated on date & time
 * @property int $ssm_updatedby Record updated by user id
 * @property string $ssm_updatedbyipaddr IP Address of the user
 */
class SubsectormstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subsectormst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ssm_sectormst_fk', 'ssm_subsectorname', 'ssm_status', 'ssm_createdby'], 'required'],
            [['ssm_sectormst_fk', 'ssm_subsectormst_fk', 'ssm_status', 'ssm_guidestatus', 'ssm_createdby', 'ssm_updatedby'], 'integer'],
            [['ssm_createdon', 'ssm_updatedon'], 'safe'],
            [['ssm_subsectorname', 'ssm_subsectorname_ara'], 'string', 'max' => 200],
            [['ssm_createdbyipaddr', 'ssm_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subsectormst_pk' => 'Subsectormst Pk',
            'ssm_sectormst_fk' => 'Ssm Sectormst Fk',
            'ssm_subsectormst_fk' => 'Ssm Subsectormst Fk',
            'ssm_subsectorname' => 'Ssm Subsectorname',
            'ssm_subsectorname_ara' => 'Ssm Subsectorname Ara',
            'ssm_status' => 'Ssm Status',
            'ssm_guidestatus' => 'Ssm Guidestatus',
            'ssm_createdon' => 'Ssm Createdon',
            'ssm_createdby' => 'Ssm Createdby',
            'ssm_createdbyipaddr' => 'Ssm Createdbyipaddr',
            'ssm_updatedon' => 'Ssm Updatedon',
            'ssm_updatedby' => 'Ssm Updatedby',
            'ssm_updatedbyipaddr' => 'Ssm Updatedbyipaddr',
        ];
    }
    public static function getSubSectorlist($id){      
        $model = SubsectormstTbl::find()
                ->select(['subsectormst_pk','ssm_subsectorname'])
                ->where(['=','ssm_status',1])            
                ->andWhere('ssm_sectormst_fk = :ssm_sectormst_fk',[':ssm_sectormst_fk' => $id])
                ->orderBy(['ssm_subsectorname'=> SORT_ASC])
                ->asArray()->all();
        return $model;
    }
}