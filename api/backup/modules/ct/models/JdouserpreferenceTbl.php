<?php

namespace api\modules\ct\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "jdouserpreference_tbl".
 *
 * @property int $jdouserpreference_pk Primary Key
 * @property int $jdup_usermst_fk Reference to usermst_tbl
 * @property int $jdup_shared_type 1 - Card, 2 - Discussion, 3 - Task, 4 - Notes, 5 - Meeting Scheduler
 * @property int $jdup_shared_fk Reference to jdomoduledtl_tbl, jdodiscusshdr_tbl, jdotaskhdr_tbl, jdonoteshdr_tbl
 * @property int $jdup_category 1 - Mute Notification (Card, Discussion), 2 - Archive (Card, Discussion, Task, Notes), 3 - Pinned (Notes)
 * @property int $jdup_status Status: 1 - Yes, 2 - No
 * @property string $jdup_createdon Date of creation
 * @property int $jdup_createdby Reference to usermst_tbl
 * @property string $jdup_createdbyipaddr User IP Address
 * @property string $jdup_updatedon Date of update
 * @property int $jdup_updatedby Reference to usermst_tbl
 * @property string $jdup_updatedbyipaddr User IP Address
 *
 * @property UsermstTbl $jdupCreatedby
 * @property UsermstTbl $jdupUpdatedby
 * @property UsermstTbl $jdupUsermstFk
 */
class JdouserpreferenceTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdouserpreference_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdup_usermst_fk', 'jdup_shared_type', 'jdup_shared_fk', 'jdup_category', 'jdup_status', 'jdup_createdon', 'jdup_createdby'], 'required'],
            [['jdup_usermst_fk', 'jdup_shared_type', 'jdup_shared_fk', 'jdup_category', 'jdup_status', 'jdup_createdby', 'jdup_updatedby'], 'integer'],
            [['jdup_createdon', 'jdup_updatedon'], 'safe'],
            [['jdup_createdbyipaddr', 'jdup_updatedbyipaddr'], 'string', 'max' => 50],
            [['jdup_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdup_createdby' => 'UserMst_Pk']],
            [['jdup_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdup_updatedby' => 'UserMst_Pk']],
            [['jdup_usermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdup_usermst_fk' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdouserpreference_pk' => 'Jdouserpreference Pk',
            'jdup_usermst_fk' => 'Jdup Usermst Fk',
            'jdup_shared_type' => 'Jdup Shared Type',
            'jdup_shared_fk' => 'Jdup Shared Fk',
            'jdup_category' => 'Jdup Category',
            'jdup_status' => 'Jdup Status',
            'jdup_createdon' => 'Jdup Createdon',
            'jdup_createdby' => 'Jdup Createdby',
            'jdup_createdbyipaddr' => 'Jdup Createdbyipaddr',
            'jdup_updatedon' => 'Jdup Updatedon',
            'jdup_updatedby' => 'Jdup Updatedby',
            'jdup_updatedbyipaddr' => 'Jdup Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdupCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdup_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdupUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdup_updatedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdupUsermstFk()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdup_usermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return JdouserpreferenceTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JdouserpreferenceTblQuery(get_called_class());
    }
}
