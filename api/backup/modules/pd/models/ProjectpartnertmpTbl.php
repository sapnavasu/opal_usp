<?php

namespace api\modules\pd\models;

use Yii;
use common\models\PartnermstTbl;
use api\modules\pd\models\ProjecttmpTbl;
use common\models\UsermstTbl;

/**
 * This is the model class for table "projectpartnertmp_tbl".
 *
 * @property int $projectpartnertmp_pk Primary Key
 * @property int $prjpt_projecttmp_fk Reference to projecttmp_tbl
 * @property int $prjpt_partnermst_fk Reference to partnermst_tbl
 * @property string $prjpt_partnerorginfo Name of the partner organization info
 * @property int $prjpt_index
 * @property string $prjpt_submittedon Date of first submission
 * @property int $prjpt_submittedby Created by user id
 * @property string $prjpt_submittedbyipaddr IP Address of the user
 * @property string $prjpt_updatedon Date of update
 * @property int $prjpt_updatedby Updated by user id
 * @property string $prjpt_updatedbyipaddr IP Address of the user
 *
 * @property PartnermstTbl $prjptPartnermstFk
 * @property ProjecttmpTbl $prjptProjecttmpFk
 * @property UsermstTbl $prjptSubmittedby
 * @property UsermstTbl $prjptUpdatedby
 */
class ProjectpartnertmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectpartnertmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjpt_projecttmp_fk', 'prjpt_partnermst_fk', 'prjpt_partnerorginfo', 'prjpt_index'], 'required'],
            [['prjpt_projecttmp_fk', 'prjpt_partnermst_fk', 'prjpt_index', 'prjpt_submittedby', 'prjpt_updatedby'], 'integer'],
            [['prjpt_submittedon', 'prjpt_updatedon'], 'safe'],
            [['prjpt_partnerorginfo'], 'string', 'max' => 150],
            [['prjpt_submittedbyipaddr', 'prjpt_updatedbyipaddr'], 'string', 'max' => 50],
            [['prjpt_partnermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => PartnermstTbl::className(), 'targetAttribute' => ['prjpt_partnermst_fk' => 'partnermst_pk']],
            [['prjpt_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['prjpt_projecttmp_fk' => 'projecttmp_pk']],
            [['prjpt_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjpt_submittedby' => 'UserMst_Pk']],
            [['prjpt_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjpt_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectpartnertmp_pk' => 'Projectpartnertmp Pk',
            'prjpt_projecttmp_fk' => 'Prjpt Projecttmp Fk',
            'prjpt_partnermst_fk' => 'Prjpt Partnermst Fk',
            'prjpt_partnerorginfo' => 'Prjpt Partnerorginfo',
            'prjpt_index' => 'Prjpt Index',
            'prjpt_submittedon' => 'Prjpt Submittedon',
            'prjpt_submittedby' => 'Prjpt Submittedby',
            'prjpt_submittedbyipaddr' => 'Prjpt Submittedbyipaddr',
            'prjpt_updatedon' => 'Prjpt Updatedon',
            'prjpt_updatedby' => 'Prjpt Updatedby',
            'prjpt_updatedbyipaddr' => 'Prjpt Updatedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjptPartnermstFk()
    {
        return $this->hasOne(PartnermstTbl::className(), ['partnermst_pk' => 'prjpt_partnermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjptProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'prjpt_projecttmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjptSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjpt_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjptUpdatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjpt_updatedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectpartnertmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectpartnertmpTblQuery(get_called_class());
    }
}
