<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memcomppsgrouphdr_tbl".
 *
 * @property int $memcomppsgrouphdr_pk Primary Key
 * @property int $mcpsgh_membercompmst_fk Reference to membercompanymst_tbl
 * @property string $mcpsgh_groupname Name of the group
 * @property int $mcpsgh_memcomppsgrouphdr_fk Reference to memcomppsgrouphdr_tbl
 * @property string $mcpsgh_prodmapcount Product mapped to this group
 * @property string $mcpsgh_servicemapcount Service mapped to this group
 * @property int $mcpsgh_status 1 - Active, 2 - Inactive
 * @property string $mcpsgh_createdon Date of creation
 * @property int $mcpsgh_createdby Reference to usermst_tbl
 * @property string $mcpsgh_createdbyipaddr Created by user's IP Address
 * @property string $mcpsgh_updatedon Date of update
 * @property int $mcpsgh_updatedby Reference to usermst_tbl
 * @property string $mcpsgh_updatedbyipaddr Updated by user's IP Address
 *
 * @property MemcompproddtlsTbl[] $memcompproddtlsTbls
 * @property UsermstTbl $mcpsghCreatedby
 * @property MembercompanymstTbl $mcpsghMembercompmstFk
 * @property MemcomppsgrouphdrTbl $mcpsghMemcomppsgrouphdrFk
 * @property MemcomppsgrouphdrTbl[] $memcomppsgrouphdrTbls
 * @property UsermstTbl $mcpsghUpdatedby
 * @property MemcompservicedtlsTbl[] $memcompservicedtlsTbls
 */
class MemcomppsgrouphdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcomppsgrouphdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpsgh_membercompmst_fk', 'mcpsgh_groupname', 'mcpsgh_status', 'mcpsgh_createdon', 'mcpsgh_createdby'], 'required'],
            [['mcpsgh_membercompmst_fk', 'mcpsgh_memcomppsgrouphdr_fk', 'mcpsgh_status', 'mcpsgh_createdby', 'mcpsgh_updatedby'], 'integer'],
            [['mcpsgh_prodmapcount', 'mcpsgh_servicemapcount'], 'number'],
            [['mcpsgh_createdon', 'mcpsgh_updatedon'], 'safe'],
            [['mcpsgh_groupname'], 'string', 'max' => 255],
            [['mcpsgh_createdbyipaddr', 'mcpsgh_updatedbyipaddr'], 'string', 'max' => 50],
            [['mcpsgh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['mcpsgh_createdby' => 'UserMst_Pk']],
            [['mcpsgh_membercompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\MembercompanymstTbl::className(), 'targetAttribute' => ['mcpsgh_membercompmst_fk' => 'MemberCompMst_Pk']],
            [['mcpsgh_memcomppsgrouphdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcomppsgrouphdrTbl::className(), 'targetAttribute' => ['mcpsgh_memcomppsgrouphdr_fk' => 'memcomppsgrouphdr_pk']],
            [['mcpsgh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\UsermstTbl::className(), 'targetAttribute' => ['mcpsgh_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcomppsgrouphdr_pk' => 'Memcomppsgrouphdr Pk',
            'mcpsgh_membercompmst_fk' => 'Mcpsgh Membercompmst Fk',
            'mcpsgh_groupname' => 'Mcpsgh Groupname',
            'mcpsgh_memcomppsgrouphdr_fk' => 'Mcpsgh Memcomppsgrouphdr Fk',
            'mcpsgh_prodmapcount' => 'Mcpsgh Prodmapcount',
            'mcpsgh_servicemapcount' => 'Mcpsgh Servicemapcount',
            'mcpsgh_status' => 'Mcpsgh Status',
            'mcpsgh_createdon' => 'Mcpsgh Createdon',
            'mcpsgh_createdby' => 'Mcpsgh Createdby',
            'mcpsgh_createdbyipaddr' => 'Mcpsgh Createdbyipaddr',
            'mcpsgh_updatedon' => 'Mcpsgh Updatedon',
            'mcpsgh_updatedby' => 'Mcpsgh Updatedby',
            'mcpsgh_updatedbyipaddr' => 'Mcpsgh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompproddtlsTbls()
    {
        return $this->hasMany(\common\models\MemcompproddtlsTbl::className(), ['mcprd_memcompsgrouphdr_fk' => 'memcomppsgrouphdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpsghCreatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'mcpsgh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpsghMembercompmstFk()
    {
        return $this->hasOne(\common\models\MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'mcpsgh_membercompmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpsghMemcomppsgrouphdrFk()
    {
        return $this->hasOne(MemcomppsgrouphdrTbl::className(), ['memcomppsgrouphdr_pk' => 'mcpsgh_memcomppsgrouphdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcomppsgrouphdrTbls()
    {
        return $this->hasMany(MemcomppsgrouphdrTbl::className(), ['mcpsgh_memcomppsgrouphdr_fk' => 'memcomppsgrouphdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpsghUpdatedby()
    {
        return $this->hasOne(\common\models\UsermstTbl::className(), ['UserMst_Pk' => 'mcpsgh_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompservicedtlsTbls()
    {
        return $this->hasMany(\common\models\MemcompservicedtlsTbl::className(), ['mcsvd_memcompsgrouphdr_fk' => 'memcomppsgrouphdr_pk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcomppsgrouphdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcomppsgrouphdrTblQuery(get_called_class());
    }
}
