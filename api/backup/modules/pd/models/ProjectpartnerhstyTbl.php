<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use common\models\PartnermstTbl;
use api\modules\pd\models\ProjecthstyTbl;

/**
 * This is the model class for table "projectpartnerhsty_tbl".
 *
 * @property int $projectpartnerhsty_pk Primary Key
 * @property int $prjph_projecthsty_fk Reference to projecthsty_tbl
 * @property int $prjph_partnermst_fk Reference to partnermst_tbl
 * @property string $prjph_partnerorginfo Name of the partner organization info
 * @property int $prjph_index
 * @property string $prjph_histcreatedon History created on datetime
 * @property string $prjph_appdeclon Date of approval / decline
 * @property int $prjph_appdeclby Updated by user id
 * @property string $prjph_appdeclbyipaddr IP Address of the user
 * @property string $prjph_submittedon Date of first submission
 * @property int $prjph_submittedby Created by user id
 * @property string $prjph_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $prjphAppdeclby
 * @property PartnermstTbl $prjphPartnermstFk
 * @property UsermstTbl $prjphSubmittedby
 * @property ProjecthstyTbl $prjphProjecthstyFk
 */
class ProjectpartnerhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projectpartnerhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prjph_projecthsty_fk', 'prjph_partnermst_fk', 'prjph_partnerorginfo', 'prjph_index', 'prjph_histcreatedon', 'prjph_appdeclon', 'prjph_appdeclby', 'prjph_submittedon', 'prjph_submittedby'], 'required'],
            [['prjph_projecthsty_fk', 'prjph_partnermst_fk', 'prjph_index', 'prjph_appdeclby', 'prjph_submittedby'], 'integer'],
            [['prjph_histcreatedon', 'prjph_appdeclon', 'prjph_submittedon'], 'safe'],
            [['prjph_partnerorginfo'], 'string', 'max' => 150],
            [['prjph_appdeclbyipaddr', 'prjph_submittedbyipaddr'], 'string', 'max' => 50],
            [['prjph_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjph_appdeclby' => 'UserMst_Pk']],
            [['prjph_partnermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => PartnermstTbl::className(), 'targetAttribute' => ['prjph_partnermst_fk' => 'partnermst_pk']],
            [['prjph_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['prjph_submittedby' => 'UserMst_Pk']],
            [['prjph_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['prjph_projecthsty_fk' => 'projecthsty_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectpartnerhsty_pk' => 'Projectpartnerhsty Pk',
            'prjph_projecthsty_fk' => 'Prjph Projecthsty Fk',
            'prjph_partnermst_fk' => 'Prjph Partnermst Fk',
            'prjph_partnerorginfo' => 'Prjph Partnerorginfo',
            'prjph_index' => 'Prjph Index',
            'prjph_histcreatedon' => 'Prjph Histcreatedon',
            'prjph_appdeclon' => 'Prjph Appdeclon',
            'prjph_appdeclby' => 'Prjph Appdeclby',
            'prjph_appdeclbyipaddr' => 'Prjph Appdeclbyipaddr',
            'prjph_submittedon' => 'Prjph Submittedon',
            'prjph_submittedby' => 'Prjph Submittedby',
            'prjph_submittedbyipaddr' => 'Prjph Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjphAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjph_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjphPartnermstFk()
    {
        return $this->hasOne(PartnermstTbl::className(), ['partnermst_pk' => 'prjph_partnermst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjphSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'prjph_submittedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrjphProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'prjph_projecthsty_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectpartnerhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectpartnerhstyTblQuery(get_called_class());
    }
}
