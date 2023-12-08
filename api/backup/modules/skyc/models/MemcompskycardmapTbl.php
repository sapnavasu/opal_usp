<?php

namespace api\modules\skyc\models;

use \common\models\UsermstTbl;
use \common\models\BasemodulemstTbl;

use Yii;

/**
 * This is the model class for table "memcompskycardmap_tbl".
 *
 * @property int $memcompskycardmap_pk Primary key
 * @property int $mcsdm_memcompskycarddtls_fk Reference to memcompskycarddtls_tbl.memcompskycarddtls_pk.
 * @property int $mcsdm_participants This column refers the Primary and Secondary user who received skycard .Reference to usermst_tbl.usermst_pk
 * @property int $mcsdm_participantstype 1 - Primary user, 2 - Secondary user.
 * @property int $mcsdm_isnewtag The tag refers the new skycard or viewed skycard (default 2) : 1 - Yes, 2 - No.
 * @property string $mcsdm_tagviewedtime If mcsc_isnewtag = 1 then mcsc_tag viewed time is mandatory.
 * @property int $mcsdm_assigntype 1 - Permanent , 2 - Temporary, bydefault 1.
 * @property int $mcsdm_assign_usermst_fk It refers which user has assigned.Reference to usermst_tbl.usermst_pk
 * @property string $mcsdm_fromdate From Date,It is applicable when the user assign Temporary
 * @property string $mcsdm_todate To Date,It is applicable when the user assign Temporary
 * @property int $mcsdm_isinternotisent It defines did the Notification sent to all the internal users (default 1) 1 - No, 2 - Yes
 * @property int $mcsdm_isnotisent It defines did the Notification sent to all dropped and received skycard (default 1) 1 - No, 2 - Yes
 * @property string $mcsdm_comments Comments,if a user is reassignes then collect comments as optional
 * @property string $mcsdm_createdon Date of creation and it also refers the user skycard created date
 * @property int $mcsdm_createdby Reference to usermst_tbl
 * @property string $mcsdm_createdbyipaddr User IP Address
 * @property string $mcsdm_updatedon Date of updation
 * @property int $mcsdm_updatedby Reference to usermst_tbl
 * @property string $mcsdm_updatedbyipaddr User IP Address
 *
 * @property MemcompscmanagehstyTbl[] $memcompscmanagehstyTbls
 * @property UsermstTbl $mcsdmAssignUsermstFk
 * @property UsermstTbl $mcsdmCreatedby
 * @property MemcompskycarddtlsTbl $mcsdmMemcompskycarddtlsFk
 * @property UsermstTbl $mcsdmParticipants
 * @property UsermstTbl $mcsdmUpdatedby
 */
class MemcompskycardmapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompskycardmap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsdm_memcompskycarddtls_fk', 'mcsdm_participants', 'mcsdm_participantstype', 'mcsdm_isnewtag', 'mcsdm_createdon', 'mcsdm_createdby'], 'required'],// 'mcsdm_updatedon', 'mcsdm_updatedby'
            [['mcsdm_memcompskycarddtls_fk', 'mcsdm_participants', 'mcsdm_participantstype', 'mcsdm_isnewtag', 'mcsdm_assigntype', 'mcsdm_assign_usermst_fk', 'mcsdm_isinternotisent', 'mcsdm_isnotisent', 'mcsdm_createdby', 'mcsdm_updatedby'], 'integer'],
            [['mcsdm_tagviewedtime', 'mcsdm_fromdate', 'mcsdm_todate', 'mcsdm_createdon', 'mcsdm_updatedon'], 'safe'],
            [['mcsdm_comments'], 'string'],
            [['mcsdm_createdbyipaddr', 'mcsdm_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcsdm_assign_usermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsdm_assign_usermst_fk' => 'UserMst_Pk']],
            [['mcsdm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsdm_createdby' => 'UserMst_Pk']],
            [['mcsdm_memcompskycarddtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompskycarddtlsTbl::className(), 'targetAttribute' => ['mcsdm_memcompskycarddtls_fk' => 'memcompskycarddtls_pk']],
            [['mcsdm_participants'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsdm_participants' => 'UserMst_Pk']],
            [['mcsdm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcsdm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompskycardmap_pk' => 'Memcompskycardmap Pk',
            'mcsdm_memcompskycarddtls_fk' => 'Mcsdm Memcompskycarddtls Fk',
            'mcsdm_participants' => 'Mcsdm Participants',
            'mcsdm_participantstype' => 'Mcsdm Participantstype',
            'mcsdm_isnewtag' => 'Mcsdm Isnewtag',
            'mcsdm_tagviewedtime' => 'Mcsdm Tagviewedtime',
            'mcsdm_assigntype' => 'Mcsdm Assigntype',
            'mcsdm_assign_usermst_fk' => 'Mcsdm Assign Usermst Fk',
            'mcsdm_fromdate' => 'Mcsdm Fromdate',
            'mcsdm_todate' => 'Mcsdm Todate',
            'mcsdm_isinternotisent' => 'Mcsdm Isinternotisent',
            'mcsdm_isnotisent' => 'Mcsdm Isnotisent',
            'mcsdm_comments' => 'Mcsdm Comments',
            'mcsdm_createdon' => 'Mcsdm Createdon',
            'mcsdm_createdby' => 'Mcsdm Createdby',
            'mcsdm_createdbyipaddr' => 'Mcsdm Createdbyipaddr',
            'mcsdm_updatedon' => 'Mcsdm Updatedon',
            'mcsdm_updatedby' => 'Mcsdm Updatedby',
            'mcsdm_updatedbyipaddr' => 'Mcsdm Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompscmanagehstyTbls()
    {
        return $this->hasMany(MemcompscmanagehstyTbl::className(), ['mcsmh_memcompskycardmap_fk' => 'memcompskycardmap_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsdmAssignUsermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsdm_assign_usermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsdmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsdm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsdmMemcompskycarddtlsFk()
    {
        return $this->hasOne(MemcompskycarddtlsTbl::className(), ['memcompskycarddtls_pk' => 'mcsdm_memcompskycarddtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsdmParticipants()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsdm_participants']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcsdmUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcsdm_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardmapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompskycardmapTblQuery(get_called_class());
    }
}
