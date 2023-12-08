<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rascategorymsthsty_tbl".
 *
 * @property int $rascategorymsthsty_tbl
 * @property int $rcmh_rascategorymst_fk Reference to rascategorymst_pk
 * @property int $rcmh_projectmst_fk Reference to projectmst_pk
 * @property string $rcmh_coursesubcatname_en
 * @property string $rcmh_coursesubcatname_ar
 * @property int $rcmh_status 1-Active, 2-Inactive, by default 1
 * @property string $rcmh_createdon
 * @property int $rcmh_createdby
 * @property string $rcmh_updatedon
 * @property int $rcmh_updatedby
 *
 * @property ProjectmstTbl $rcmhProjectmstFk
 * @property RascategorymstTbl $rcmhRascategorymstFk
 */
class RascategorymsthstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rascategorymsthsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rcmh_rascategorymst_fk', 'rcmh_projectmst_fk', 'rcmh_coursesubcatname_en', 'rcmh_coursesubcatname_ar', 'rcmh_status', 'rcmh_createdon', 'rcmh_createdby'], 'required'],
            [['rcmh_rascategorymst_fk', 'rcmh_projectmst_fk', 'rcmh_status', 'rcmh_createdby', 'rcmh_updatedby'], 'integer'],
            [['rcmh_coursesubcatname_en', 'rcmh_coursesubcatname_ar'], 'string'],
            [['rcmh_createdon', 'rcmh_updatedon'], 'safe'],
            [['rcmh_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['rcmh_projectmst_fk' => 'projectmst_pk']],
            [['rcmh_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['rcmh_rascategorymst_fk' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rascategorymsthsty_tbl' => 'Rascategorymsthsty Tbl',
            'rcmh_rascategorymst_fk' => 'Rcmh Rascategorymst Fk',
            'rcmh_projectmst_fk' => 'Rcmh Projectmst Fk',
            'rcmh_coursesubcatname_en' => 'Rcmh Coursesubcatname En',
            'rcmh_coursesubcatname_ar' => 'Rcmh Coursesubcatname Ar',
            'rcmh_status' => 'Rcmh Status',
            'rcmh_createdon' => 'Rcmh Createdon',
            'rcmh_createdby' => 'Rcmh Createdby',
            'rcmh_updatedon' => 'Rcmh Updatedon',
            'rcmh_updatedby' => 'Rcmh Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRcmhProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'rcmh_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRcmhRascategorymstFk()
    {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'rcmh_rascategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RascategorymsthstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RascategorymsthstyTblQuery(get_called_class());
    }
}
