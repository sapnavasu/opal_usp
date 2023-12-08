<?php

namespace api\modules\ct\models;
use common\models\UsermstTbl;
use Yii;

/**
 * This is the model class for table "jdojdrivehdr_tbl".
 *
 * @property int $jdojdrivehdr_pk Primary Key
 * @property int $jdjdh_jdotargetmember_fk Reference to jdotargetmember_tbl
 * @property int $jdjdh_shared_type 1 - Discussion, 2 - Task, 3 - Notes
 * @property int $jdjdh_shared_fk Reference to jdodiscusshdr_tbl, jdotaskhdr_tbl, jdonoteshdr_tbl
 * @property int $jdjdh_filepath Status Reference to memcompfiledtls_tbl
 * @property int $jdjdh_isviewed Has file been viewed by User: 1 - Yes, 2 - No
 * @property int $jdjdh_isdeleted If file is deleted on (discussion, task, notes): 1 - Yes, 2 - No
 * @property string $jdjdh_lastviewedon File Last Viewed on
 * @property string $jdjdh_createdon Date of creation
 * @property int $jdjdh_createdby Reference to usermst_tbl
 * @property string $jdjdh_createdbyipaddr User IP Address
 * @property string $jdjdh_updatedon Date of update
 * @property int $jdjdh_updatedby Reference to usermst_tbl
 * @property string $jdjdh_updatedbyipaddr User IP Address
 *
 */
class JdojdrivehdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jdojdrivehdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jdjdh_jdotargetmember_fk', 'jdjdh_shared_type', 'jdjdh_shared_fk', 'jdjdh_filepath', 'jdjdh_isviewed', 'jdjdh_lastviewedon', 'jdjdh_isdeleted', 'jdjdh_createdon', 'jdjdh_createdby'], 'required'],
            [['jdjdh_jdotargetmember_fk', 'jdjdh_shared_type', 'jdjdh_shared_fk', 'jdjdh_filepath', 'jdjdh_isviewed', 'jdjdh_isdeleted', 'jdjdh_createdby', 'jdjdh_updatedby'], 'integer'],
            [['jdjdh_lastviewedon', 'jdjdh_createdon', 'jdjdh_updatedon'], 'safe'],
            [['jdjdh_createdbyipaddr', 'jdjdh_updatedbyipaddr'], 'string', 'max' => 50],
            [['jdjdh_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdjdh_createdby' => 'UserMst_Pk']],
            [['jdjdh_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['jdjdh_updatedby' => 'UserMst_Pk']],
            [['jdjdh_jdotargetmember_fk'], 'exist', 'skipOnError' => true, 'targetClass' => JdotargetmemberTbl::className(), 'targetAttribute' => ['jdjdh_jdotargetmember_fk' => 'jdotargetmember_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jdojdrivehdr_pk' => 'Jdojdrivehdr Pk',
            'jdjdh_jdotargetmember_fk' => 'Jdjdh Jdotargetmember Fk',
            'jdjdh_shared_type' => 'Jdjdh Shared Type',
            'jdjdh_shared_fk' => 'Jdjdh Shared Fk',
            'jdjdh_filepath' => 'Jdjdh Filepath',
            'jdjdh_isviewed' => 'Jdjdh Isviewed',
            'jdjdh_lastviewedon' => 'Jdjdh Lastviewedon',
            'jdjdh_isdeleted' => 'Jdjdh Isdeleted',
            'jdjdh_createdon' => 'Jdjdh Createdon',
            'jdjdh_createdby' => 'Jdjdh Createdby',
            'jdjdh_createdbyipaddr' => 'Jdjdh Createdbyipaddr',
            'jdjdh_updatedon' => 'Jdjdh Updatedon',
            'jdjdh_updatedby' => 'Jdjdh Updatedby',
            'jdjdh_updatedbyipaddr' => 'Jdjdh Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdjdhCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdjdh_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJdjdhUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'jdjdh_updatedby']);
    }
}
