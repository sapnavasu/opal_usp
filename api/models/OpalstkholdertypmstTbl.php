<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalstkholdertypmst_tbl".
 *
 * @property int $opalstkholdertypmst_pk primary key
 * @property string $oshm_stakeholdertype name of the stakeholder type
 * @property string $oshm_shortcode short code of the stakeholder
 * @property int $oshm_status 1 - active, 2 - inactive, 3 - deleted
 * @property string $oshm_createdon datetime of creation
 * @property int $oshm_createdby reference to opalusermst_tbl
 * @property string $oshm_createdbyipaddr created by user's ip address
 * @property string $oshm_updatedon datetime of updation
 * @property string $oshm_updatedby updated by user's ip address
 * @property string $oshm_updatedbyipaddr updated by user's ip address
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 * @property RolemstTbl[] $rolemstTbls
 * @property RolemstTbl[] $rolemstTbls0
 */
class OpalstkholdertypmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalstkholdertypmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['oshm_stakeholdertype', 'oshm_status', 'oshm_createdon', 'oshm_createdby'], 'required'],
            [['oshm_status', 'oshm_createdby'], 'integer'],
            [['oshm_createdon', 'oshm_updatedon'], 'safe'],
            [['oshm_stakeholdertype', 'oshm_createdbyipaddr', 'oshm_updatedby', 'oshm_updatedbyipaddr'], 'string', 'max' => 50],
            [['oshm_shortcode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalstkholdertypmst_pk' => 'Opalstkholdertypmst Pk',
            'oshm_stakeholdertype' => 'Oshm Stakeholdertype',
            'oshm_shortcode' => 'Oshm Shortcode',
            'oshm_status' => 'Oshm Status',
            'oshm_createdon' => 'Oshm Createdon',
            'oshm_createdby' => 'Oshm Createdby',
            'oshm_createdbyipaddr' => 'Oshm Createdbyipaddr',
            'oshm_updatedon' => 'Oshm Updatedon',
            'oshm_updatedby' => 'Oshm Updatedby',
            'oshm_updatedbyipaddr' => 'Oshm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['omrm_stkholdertypmst_fk' => 'opalstkholdertypmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolemstTbls()
    {
        return $this->hasMany(RolemstTbl::className(), ['rm_opalstkholdertypmst_fk' => 'opalstkholdertypmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolemstTbls0()
    {
        return $this->hasMany(RolemstTbl::className(), ['rm_projectmst_fk' => 'opalstkholdertypmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalstkholdertypmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalstkholdertypmstTblQuery(get_called_class());
    }


    public static function getStkholderTypes(){
        return  self::find()
            ->select(['opalstkholdertypmst_pk','oshm_stakeholdertype'])
            ->where(['oshm_status' => 1])
            ->orderBy(['opalstkholdertypmst_pk' => SORT_ASC])
            ->asArray()->all();
    }
    
    public static function getStkholderCacheQuery() {
        return self::find()
        ->select(['max(oshm_createdon), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
}
