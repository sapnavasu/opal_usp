<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjecthstyTbl;

/**
 * This is the model class for table "projtechnicalhsty_tbl".
 *
 * @property int $projtechnicalhsty_pk Primary key
 * @property int $pth_projecthsty_fk Reference to projecthsty_tbl
 * @property string $pth_techinfo Technical Information
 * @property string $pth_techapprovals Technical Approvals
 * @property string $pth_socioecoimpact Socio Economic impact
 * @property string $pth_environmental Environmental
 * @property int $pth_fdiclassification 1 - Horizontal FDI, 2 -  Vertical FDI, 3 -  Backward FDI
 * @property string $pth_marketoverview Market Overview
 * @property string $pth_marketneeds Market needs
 * @property string $pth_markettrends Market Trends
 * @property string $pth_similrefer Similar reference
 * @property string $pth_histcreatedon Datetime of history creation
 * @property string $pth_appdeclon Datetime of approval / decline
 * @property int $pth_appdeclby Reference to usermst_tbl
 * @property string $pth_appdeclbyipaddr User IP Address
 * @property string $pth_submittedon First date of submission
 * @property int $pth_submittedby Reference to usermst_tbl
 * @property string $pth_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $pthAppdeclby
 * @property ProjecthstyTbl $pthProjecthstyFk
 * @property UsermstTbl $pthSubmittedby
 */
class ProjtechnicalhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechnicalhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pth_projecthsty_fk'], 'required'],
            [['pth_projecthsty_fk', 'pth_fdiclassification', 'pth_appdeclby', 'pth_submittedby'], 'integer'],
            [['pth_techinfo', 'pth_techapprovals', 'pth_socioecoimpact', 'pth_environmental', 'pth_marketoverview', 'pth_marketneeds', 'pth_markettrends', 'pth_similrefer'], 'string'],
            [['pth_histcreatedon', 'pth_appdeclon', 'pth_submittedon'], 'safe'],
            [['pth_appdeclbyipaddr', 'pth_submittedbyipaddr'], 'string', 'max' => 50],
            [['pth_appdeclby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pth_appdeclby' => 'UserMst_Pk']],
            [['pth_projecthsty_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecthstyTbl::className(), 'targetAttribute' => ['pth_projecthsty_fk' => 'projecthsty_pk']],
            [['pth_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pth_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechnicalhsty_pk' => 'Projtechnicalhsty Pk',
            'pth_projecthsty_fk' => 'Pth Projecthsty Fk',
            'pth_techinfo' => 'Pth Techinfo',
            'pth_techapprovals' => 'Pth Techapprovals',
            'pth_socioecoimpact' => 'Pth Socioecoimpact',
            'pth_environmental' => 'Pth Environmental',
            'pth_fdiclassification' => 'Pth Fdiclassification',
            'pth_marketoverview' => 'Pth Marketoverview',
            'pth_marketneeds' => 'Pth Marketneeds',
            'pth_markettrends' => 'Pth Markettrends',
            'pth_similrefer' => 'Pth Similrefer',
            'pth_histcreatedon' => 'Pth Histcreatedon',
            'pth_appdeclon' => 'Pth Appdeclon',
            'pth_appdeclby' => 'Pth Appdeclby',
            'pth_appdeclbyipaddr' => 'Pth Appdeclbyipaddr',
            'pth_submittedon' => 'Pth Submittedon',
            'pth_submittedby' => 'Pth Submittedby',
            'pth_submittedbyipaddr' => 'Pth Submittedbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPthAppdeclby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pth_appdeclby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPthProjecthstyFk()
    {
        return $this->hasOne(ProjecthstyTbl::className(), ['projecthsty_pk' => 'pth_projecthsty_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPthSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pth_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicalhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechnicalhstyTblQuery(get_called_class());
    }
}
