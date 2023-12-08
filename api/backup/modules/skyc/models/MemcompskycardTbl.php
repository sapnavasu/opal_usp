<?php

namespace api\modules\skyc\models;

use Yii;
use \common\models\UsermstTbl;
use \common\models\BasemodulemstTbl;


/**
 * This is the model class for table "memcompskycard_tbl".
 *
 * @property int $memcompskycard_pk Primary key
 * @property int $mcosc_name_usremst_fk Reference to usermst_tbl.usermst_fk(person who creates the skycard).
 * @property int $mcosc_isnewtag The tag refers the new skycard or viewed skycard (default 2) : 1 - Yes, 2 - No.
 * @property string $mcosc_tagviewedtime If mcsc_isnewtag = 1 then mcsc_tag viewed time is mandatory.
 * @property int $mcosc_basemodulemst_fk Reference to basemodulemst_tbl,to which module, this skycard is created for.
 * @property int $mcosc_shared_fk Reference to usermst_tbl.usermst_pk(It shows, To which user did the skycard had dropped),  memcompproddtls_tbl.MemCompProdDtls_Pk(It shows, To which product user did the skycard had dropped), memcompservicedtls_tbl.MemCompServDtls_Pk(It shows, To which service user did the skycard had dropped), membercompanymst_tbl.MemberCompMst_Pk(It shows, To which supplier user did the skycard had dropped),departmentmst_tbl.DepartmentMst_Pk(It shows, To which department users did the skycard had dropped).
 * @property int $mcosc_recv_usremst_fk This column refers the user name of received skycard users.Reference to usermst_tbl.usermst_pk
 * @property int $mcosc_assigntype 1 - Permanent , 2 - Temporary, bydefault 1.
 * @property int $mcosc_assign_usermst_fk It refers which user has assigned.Reference to usermst_tbl.usermst_pk
 * @property string $mcosc_fromdate From Date,It is applicable when the user assign Temporary
 * @property string $mcosc_todate To Date,It is applicable when the user assign Temporary
 * @property int $mcosc_isinternotisent It defines did the Notification sent to all the internal users (default 1) 1 - No, 2 - Yes
 * @property int $mcosc_isnotisent It defines did the Notification sent to all dropped and received skycard (default 1) 1 - No, 2 - Yes
 * @property string $mcosc_comments Comments,if a user is reassignes then collect comments as optional
 * @property string $mcosc_createdon Date of creation and it also refers the user skycard created date
 * @property int $mcosc_createdby Reference to usermst_tbl
 * @property string $mcosc_createdbyipaddr User IP Address
 * @property string $mcosc_updatedon Date of updation
 * @property int $mcosc_updatedby Reference to usermst_tbl
 * @property string $mcosc_updatedbyipaddr User IP Address
 *
 * @property MemcompscmanagehstyTbl[] $memcompscmanagehstyTbls
 * @property UsermstTbl $mcoscAssignUsermstFk
 * @property BasemodulemstTbl $mcoscBasemodulemstFk
 * @property UsermstTbl $mcoscCreatedby
 * @property UsermstTbl $mcoscNameUsremstFk
 * @property UsermstTbl $mcoscRecvUsremstFk
 * @property UsermstTbl $mcoscUpdatedby
 */
class MemcompskycardTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompskycard_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcosc_name_usremst_fk', 'mcosc_isnewtag', 'mcosc_recv_usremst_fk', 'mcosc_createdon', 'mcosc_createdby'], 'required'],//, 'mcosc_updatedon', 'mcosc_updatedby'
            [['mcosc_name_usremst_fk', 'mcosc_isnewtag', 'mcosc_basemodulemst_fk', 'mcosc_shared_fk', 'mcosc_recv_usremst_fk', 'mcosc_assigntype', 'mcosc_assign_usermst_fk', 'mcosc_isinternotisent', 'mcosc_isnotisent', 'mcosc_createdby', 'mcosc_updatedby'], 'integer'],
            [['mcosc_tagviewedtime', 'mcosc_fromdate', 'mcosc_todate', 'mcosc_createdon', 'mcosc_updatedon'], 'safe'],
            [['mcosc_comments'], 'string'],
            [['mcosc_createdbyipaddr', 'mcosc_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcosc_assign_usermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_assign_usermst_fk' => 'UserMst_Pk']],
            [['mcosc_basemodulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BasemodulemstTbl::className(), 'targetAttribute' => ['mcosc_basemodulemst_fk' => 'basemodulemst_pk']],
            [['mcosc_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_createdby' => 'UserMst_Pk']],
            [['mcosc_name_usremst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_name_usremst_fk' => 'UserMst_Pk']],
            [['mcosc_recv_usremst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_recv_usremst_fk' => 'UserMst_Pk']],
            [['mcosc_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['mcosc_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompskycard_pk' => 'Memcompskycard Pk',
            'mcosc_name_usremst_fk' => 'Mcosc Name Usremst Fk',
            'mcosc_isnewtag' => 'Mcosc Isnewtag',
            'mcosc_tagviewedtime' => 'Mcosc Tagviewedtime',
            'mcosc_basemodulemst_fk' => 'Mcosc Basemodulemst Fk',
            'mcosc_shared_fk' => 'Mcosc Shared Fk',
            'mcosc_recv_usremst_fk' => 'Mcosc Recv Usremst Fk',
            'mcosc_assigntype' => 'Mcosc Assigntype',
            'mcosc_assign_usermst_fk' => 'Mcosc Assign Usermst Fk',
            'mcosc_fromdate' => 'Mcosc Fromdate',
            'mcosc_todate' => 'Mcosc Todate',
            'mcosc_isinternotisent' => 'Mcosc Isinternotisent',
            'mcosc_isnotisent' => 'Mcosc Isnotisent',
            'mcosc_comments' => 'Mcosc Comments',
            'mcosc_createdon' => 'Mcosc Createdon',
            'mcosc_createdby' => 'Mcosc Createdby',
            'mcosc_createdbyipaddr' => 'Mcosc Createdbyipaddr',
            'mcosc_updatedon' => 'Mcosc Updatedon',
            'mcosc_updatedby' => 'Mcosc Updatedby',
            'mcosc_updatedbyipaddr' => 'Mcosc Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompscmanagehstyTbls()
    {
        return $this->hasMany(MemcompscmanagehstyTbl::className(), ['mcsmh_memcompskycard_fk' => 'memcompskycard_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscAssignUsermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_assign_usermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscBasemodulemstFk()
    {
        return $this->hasOne(BasemodulemstTbl::className(), ['basemodulemst_pk' => 'mcosc_basemodulemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscNameUsremstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_name_usremst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscRecvUsremstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_recv_usremst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcoscUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'mcosc_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompskycardTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompskycardTblQuery(get_called_class());
    }
}
