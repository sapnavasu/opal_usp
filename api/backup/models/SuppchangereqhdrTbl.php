<?php

namespace api\models;

use Yii;

/**
 * This is the model class for table "suppchangereqhdr_tbl".
 *
 * @property int $suppchangereqhdr_pk Primary Key
 * @property int $scrh_memberregmst_fk Reference to memberregistrationmst_tbl
 * @property int $scrh_basemodulemst_fk For which module Reference to basemodulemst_tbl
 * @property int $scrh_updatedfor 1 - Registration, 2 - Renewal
 * @property string $scrh_upload Supplier request proof: Reference to memcompfiledtls_tbl in comma separation
 * @property string $scrh_comments comments
 * @property string $scrh_createdon Date of creation
 * @property int $scrh_createdby Created by Back end admin: Reference to usermst_tbl
 * @property string $scrh_createdbyipaddr User IP Address
 *
 * @property SuppchangereqdtlsTbl[] $suppchangereqdtlsTbls
 * @property BasemodulemstTbl $scrhBasemodulemstFk
 * @property UsermstTbl $scrhCreatedby
 * @property MemberregistrationmstTbl $scrhMemberregmstFk
 */
class SuppchangereqhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suppchangereqhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scrh_memberregmst_fk', 'scrh_basemodulemst_fk', 'scrh_updatedfor', 'scrh_comments', 'scrh_createdon', 'scrh_createdby'], 'required'],
            [['scrh_memberregmst_fk', 'scrh_basemodulemst_fk', 'scrh_updatedfor', 'scrh_createdby'], 'integer'],
            [['scrh_upload', 'scrh_comments'], 'string'],
            [['scrh_createdon'], 'safe'],
            [['scrh_createdbyipaddr'], 'string', 'max' => 50],
            [['scrh_basemodulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\BasemodulemstTbl::className(), 'targetAttribute' => ['scrh_basemodulemst_fk' => 'basemodulemst_pk']],
            [['scrh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['scrh_createdby' => 'UserMst_Pk']],
            [['scrh_memberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\MemberregistrationmstTbl::className(), 'targetAttribute' => ['scrh_memberregmst_fk' => 'MemberRegMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'suppchangereqhdr_pk' => 'Suppchangereqhdr Pk',
            'scrh_memberregmst_fk' => 'Scrh Memberregmst Fk',
            'scrh_basemodulemst_fk' => 'Scrh Basemodulemst Fk',
            'scrh_updatedfor' => 'Scrh Updatedfor',
            'scrh_upload' => 'Scrh Upload',
            'scrh_comments' => 'Scrh Comments',
            'scrh_createdon' => 'Scrh Createdon',
            'scrh_createdby' => 'Scrh Createdby',
            'scrh_createdbyipaddr' => 'Scrh Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuppchangereqdtlsTbls()
    {
        return $this->hasMany(SuppchangereqdtlsTbl::className(), ['scrd_suppchangereqhdr_fk' => 'suppchangereqhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScrhBasemodulemstFk()
    {
        return $this->hasOne(BasemodulemstTbl::className(), ['basemodulemst_pk' => 'scrh_basemodulemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScrhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'scrh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScrhMemberregmstFk()
    {
        return $this->hasOne(MemberregistrationmstTbl::className(), ['MemberRegMst_Pk' => 'scrh_memberregmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return SuppchangereqhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuppchangereqhdrTblQuery(get_called_class());
    }
}