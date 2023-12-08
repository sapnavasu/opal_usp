<?php

namespace api\modules\ct\models;

/**
 * This is the model class for table "jdodiscussmember_tbl".
 *
 * @property int $jdodiscussmember_pk Primary key
 * @property int $jddm_jdodiscusshdr_fk Reference to jdodiscusshdr_tbl
 * @property int $jddm_jdotargetmember_fk Reference to jdotargetmember_tbl
 * @property int $jddm_status Status of User in Discussion: 1 - Active, 2 - Inactive
 * @property string $jddm_createdon Date of creation
 * @property int $jddm_createdby Reference to usermst_tbl
 * @property string $jddm_createdbyipaddr User IP Address
 * @property string $jddm_updatedon Date of update
 * @property int $jddm_updatedby Reference to usermst_tbl
 * @property string $jddm_updatedbyipaddr  User IP Address
 * @property string jddm_rejoinedon Date of Rejoined (When user leaves a card and added by Admin again)
 * 
 * */

class JdodiscussmemberTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdodiscussmember_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jddm_jdodiscusshdr_fk', 'jddm_jdotargetmember_fk', 'jddm_status', 'jddm_createdon', 'jddm_createdby', 'jddm_createdbyipaddr'], 'required'],
            [['jddm_jdodiscusshdr_fk', 'jddm_jdotargetmember_fk'], 'integer'],
            [['jddm_createdon'], 'safe'],
            [['jddm_createdbyipaddr'], 'string', 'max' => 50],
        ];

    }
    
      /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdodiscussmember_pk' => 'Jdodiscussmember Pk',
            'jddm_jdodiscusshdr_fk' => 'Jddm Jdodiscusshdr Fk',
            'jddm_jdotargetmember_fk' => 'Jddm jdotargetmember Fk',
            'jddm_createdon' => 'Jddm Created On',
            'jddm_createdby' => 'jddm Created By',
            'jddm_createdbyipaddr' => 'Jddm Createdbyipaddr',
            'jddm_updatedon' => 'Jddm Updated On',
            'jddm_updatedby' => 'Jddm Updated By',
            'jddm_updatedbyipaddr' => 'Jddm updatedbyipaddr',
            'jddm_rejoinedon' => 'Jddm Rejoinedon'
        ];
    }

    public function getTargetmember(){
        return $this->hasOne(\api\modules\ct\models\JdotargetmemberTbl::class, ['jdotargetmember_pk' => 'jddm_jdotargetmember_fk']);
    }
}