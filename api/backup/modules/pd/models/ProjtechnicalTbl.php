<?php

namespace api\modules\pd\models;

use Yii;
use common\models\UsermstTbl;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the model class for table "projtechnical_tbl".
 *
 * @property int $projtechnical_pk Primary key
 * @property int $pt_projectdtls_fk Reference to projectdtls_tbl
 * @property string $pt_techinfo Technical Information
 * @property string $pt_techapprovals Technical Approvals
 * @property string $pt_socioecoimpact Socio Economic impact
 * @property string $pt_environmental Environmental
 * @property int $pt_fdiclassification 1 - Horizontal FDI, 2 -  Vertical FDI, 3 -  Backward FDI
 * @property string $pt_marketoverview Market Overview
 * @property string $pt_marketneeds Market needs
 * @property string $pt_markettrends Market Trends
 * @property string $pt_similrefer Similar reference
 * @property string $pt_approvedon Datetime of approval
 * @property int $pt_approvedby Reference to usermst_tbl
 * @property string $pt_approvedbyipaddr User IP Address
 * @property string $pt_submittedon First date of submission
 * @property int $pt_submittedby Reference to usermst_tbl
 * @property string $pt_submittedbyipaddr IP Address of the user
 *
 * @property UsermstTbl $ptApprovedby
 * @property ProjectdtlsTbl $ptProjectdtlsFk
 * @property UsermstTbl $ptSubmittedby
 */
class ProjtechnicalTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechnical_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pt_projectdtls_fk'], 'required'],
            [['pt_projectdtls_fk', 'pt_fdiclassification', 'pt_approvedby', 'pt_submittedby'], 'integer'],
            [['pt_techinfo', 'pt_techapprovals', 'pt_socioecoimpact', 'pt_environmental', 'pt_marketoverview', 'pt_marketneeds', 'pt_markettrends', 'pt_similrefer'], 'string'],
            [['pt_approvedon', 'pt_submittedon'], 'safe'],
            [['pt_approvedbyipaddr', 'pt_submittedbyipaddr'], 'string', 'max' => 50],
            [['pt_approvedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pt_approvedby' => 'UserMst_Pk']],
            [['pt_projectdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectdtlsTbl::className(), 'targetAttribute' => ['pt_projectdtls_fk' => 'projectdtls_pk']],
            [['pt_submittedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['pt_submittedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechnical_pk' => 'Projtechnical Pk',
            'pt_projectdtls_fk' => 'Pt Projectdtls Fk',
            'pt_techinfo' => 'Pt Techinfo',
            'pt_techapprovals' => 'Pt Techapprovals',
            'pt_socioecoimpact' => 'Pt Socioecoimpact',
            'pt_environmental' => 'Pt Environmental',
            'pt_fdiclassification' => 'Pt Fdiclassification',
            'pt_marketoverview' => 'Pt Marketoverview',
            'pt_marketneeds' => 'Pt Marketneeds',
            'pt_markettrends' => 'Pt Markettrends',
            'pt_similrefer' => 'Pt Similrefer',
            'pt_approvedon' => 'Pt Approvedon',
            'pt_approvedby' => 'Pt Approvedby',
            'pt_approvedbyipaddr' => 'Pt Approvedbyipaddr',
            'pt_submittedon' => 'Pt Submittedon',
            'pt_submittedby' => 'Pt Submittedby',
            'pt_submittedbyipaddr' => 'Pt Submittedbyipaddr',
        ];
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtApprovedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pt_approvedby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtProjectdtlsFk()
    {
        return $this->hasOne(ProjectdtlsTbl::className(), ['projectdtls_pk' => 'pt_projectdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPtSubmittedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'pt_submittedby']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicalTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechnicalTblQuery(get_called_class());
    }
}
