<?php

namespace api\modules\ct\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "jdomoduledtl_tbl".
 *
 * @property int $jdomoduledtl_pk Primary Key
 * @property int $jdmd_jdomodulehdr_fk Reference to jdomodulehdr_tbl
 * @property string $jdmd_uid Unique ID Auto generated value
 * @property int $jdmd_shared_type 1 - Project, 2 - Requisition/ Tender Notice, 3 - Tender Enquiry (RFI, EOI,etc,.), 4 - Contract/ PO, 5 - General
 * @property int $jdmd_shared_fk Reference to projectdtls_tbl, cmsrequisitionformdtls_tbl, cmstenderhdr_tbl, cmscontracthdr_tbl
 * @property string $jdmd_title Titile
 * @property string $jdmd_subject Subject
 * @property int $jdmd_type Type of Card: 1 - Internal, 2 - External
 * @property int $jdmd_status 1 - Active, 2 - Closed (Inactive)
 * @property string $jdmd_createdon Date of creation
 * @property int $jdmd_createdby Reference to usermst_tbl
 * @property string $jdmd_createdbyipaddr User IP Address
 * @property string $jdmd_closedon Date of closed
 * @property int $jdmd_closedby Reference to usermst_tbl
 * @property string $jdmd_closedbyipaddr User IP Address
 *
 * @property JdodiscusshdrTbl[] $jdodiscusshdrTbls
 * @property JdomeetingskdhdrTbl[] $jdomeetingskdhdrTbls
 * @property UsermstTbl $jdmdClosedby
 * @property UsermstTbl $jdmdCreatedby
 * @property JdomodulehdrTbl $jdmdJdomodulehdrFk
 * @property JdonoteshdrTbl[] $jdonoteshdrTbls
 * @property JdotargetmemberTbl[] $jdotargetmemberTbls
 * @property JdotaskhdrTbl[] $jdotaskhdrTbls
 */
class JdomoduledtlTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdomoduledtl_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdmd_jdomodulehdr_fk', 'jdmd_uid', 'jdmd_title', 'jdmd_type', 'jdmd_status', 'jdmd_createdon', 'jdmd_createdby'], 'required'],
            [['jdmd_jdomodulehdr_fk', 'jdmd_shared_type', 'jdmd_shared_fk', 'jdmd_type', 'jdmd_status', 'jdmd_createdby', 'jdmd_closedby'], 'integer'],
            [['jdmd_subject'], 'string'],
            [['jdmd_createdon', 'jdmd_closedon'], 'safe'],
            [['jdmd_uid'], 'string', 'max' => 20],
            [['jdmd_title'], 'string', 'max' => 255],
            [['jdmd_createdbyipaddr', 'jdmd_closedbyipaddr'], 'string', 'max' => 50],
            [['jdmd_closedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdmd_closedby' => 'UserMst_Pk']],
            [['jdmd_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdmd_createdby' => 'UserMst_Pk']],
            [['jdmd_jdomodulehdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => JdomodulehdrTbl::className(), 'targetAttribute' => ['jdmd_jdomodulehdr_fk' => 'jdomodulehdr_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdomoduledtl_pk' => 'Jdomoduledtl Pk',
            'jdmd_jdomodulehdr_fk' => 'Jdmd Jdomodulehdr Fk',
            'jdmd_uid' => 'Jdmd Uid',
            'jdmd_shared_type' => 'Jdmd Shared Type',
            'jdmd_shared_fk' => 'Jdmd Shared Fk',
            'jdmd_title' => 'Jdmd Title',
            'jdmd_subject' => 'Jdmd Subject',
            'jdmd_type' => 'Jdmd Type',
            'jdmd_status' => 'Jdmd Status',
            'jdmd_createdon' => 'Jdmd Createdon',
            'jdmd_createdby' => 'Jdmd Createdby',
            'jdmd_createdbyipaddr' => 'Jdmd Createdbyipaddr',
            'jdmd_closedon' => 'Jdmd Closedon',
            'jdmd_closedby' => 'Jdmd Closedby',
            'jdmd_closedbyipaddr' => 'Jdmd Closedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdodiscusshdrTbls()
    {
        return $this->hasMany(JdodiscusshdrTbl::className(), ['jddh_jdomoduledtl_fk' => 'jdomoduledtl_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdomeetingskdhdrTbls()
    {
        return $this->hasMany(JdomeetingskdhdrTbl::className(), ['jdmsh_jdomoduledtl_fk' => 'jdomoduledtl_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdmdClosedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdmd_closedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdmdCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdmd_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdmdJdomodulehdrFk()
    {
        return $this->hasOne(JdomodulehdrTbl::className(), ['jdomodulehdr_pk' => 'jdmd_jdomodulehdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdonoteshdrTbls()
    {
        return $this->hasMany(JdonoteshdrTbl::className(), ['jdnh_jdomoduledtl_fk' => 'jdomoduledtl_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdotargetmemberTbls()
    {
        return $this->hasMany(JdotargetmemberTbl::className(), ['jdtm_jdomoduledtl_fk' => 'jdomoduledtl_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdotaskhdrTbls()
    {
        return $this->hasMany(JdotaskhdrTbl::className(), ['jdth_jdomoduledtl_fk' => 'jdomoduledtl_pk']);
    }

    /**
     * {@inheritdoc}
     * @return JdomoduledtlTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JdomoduledtlTblQuery(get_called_class());
    }
}
