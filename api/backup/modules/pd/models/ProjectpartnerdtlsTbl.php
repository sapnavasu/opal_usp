<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use common\models\PartnermstTbl;

/**
 * This is the model class for table "projectpartnerdtls_tbl".
 *
 * @property int $projectpartnerdtls_pk Primary Key
 * @property int $prjpd_projectdtls_fk Reference to projectdtls_tbl
 * @property int $prjpd_partnermst_fk Reference to partnermst_tbl
 * @property string $prjpd_partnerorginfo Name of the partner organization info
 * @property int $prjpd_index
 * @property string $prjpd_approvedon Date of approved
 * @property int $prjpd_approvedby Created by user id
 * @property string $prjpd_approvedbyipaddr IP Address of the user
 * @property string $prjpd_submittedon Date of first submission
 * @property int $prjpd_submittedby Updated by user id
 * @property string $prjpd_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $prjpdApprovedby
 * @property PartnermstTbl $prjpdPartnermstFk
 * @property UsermstTbl $prjpdSubmittedby
 */
class ProjectpartnerdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectpartnerdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjpd_projectdtls_fk', 'prjpd_partnermst_fk', 'prjpd_partnerorginfo', 'prjpd_index', 'prjpd_approvedon', 'prjpd_approvedby'], 'required'],
            [['prjpd_projectdtls_fk', 'prjpd_partnermst_fk', 'prjpd_index', 'prjpd_approvedby', 'prjpd_submittedby'], 'integer'],
            [['prjpd_approvedon', 'prjpd_submittedon'], 'safe'],
            [['prjpd_partnerorginfo'], 'string', 'max' => 150],
            [['prjpd_approvedbyipaddr', 'prjpd_submittedbyipaddr'], 'string', 'max' => 50],
            [['prjpd_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjpd_approvedby' => 'UserMst_Pk']],
            [['prjpd_partnermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => PartnermstTbl::className(), 'targetAttribute' => ['prjpd_partnermst_fk' => 'partnermst_pk']],
            [['prjpd_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjpd_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectpartnerdtls_pk' => 'Projectpartnerdtls Pk',
            'prjpd_projectdtls_fk' => 'Prjpd Projectdtls Fk',
            'prjpd_partnermst_fk' => 'Prjpd Partnermst Fk',
            'prjpd_partnerorginfo' => 'Prjpd Partnerorginfo',
            'prjpd_index' => 'Prjpd Index',
            'prjpd_approvedon' => 'Prjpd Approvedon',
            'prjpd_approvedby' => 'Prjpd Approvedby',
            'prjpd_approvedbyipaddr' => 'Prjpd Approvedbyipaddr',
            'prjpd_submittedon' => 'Prjpd Submittedon',
            'prjpd_submittedby' => 'Prjpd Submittedby',
            'prjpd_submittedbyipaddr' => 'Prjpd Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjpdApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjpd_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjpdPartnermstFk()
    {
        return $this->hasOne(PartnermstTbl::className(), ['partnermst_pk' => 'prjpd_partnermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjpdSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjpd_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectpartnerdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectpartnerdtlsTblQuery(get_called_class());
    }
}
