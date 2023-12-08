<?php

namespace api\modules\pd\models;

use Yii;
use api\modules\pd\models\ProjecttmpTbl;

/**
 * This is the model class for table "projtechnicaltmp_tbl".
 *
 * @property int $projtechnicaltmp_pk Primary key
 * @property int $ptt_projecttmp_fk Reference to projectdtls_tbl
 * @property string $ptt_techinfo Technical Information
 * @property string $ptt_techapprovals Technical Approvals
 * @property string $ptt_socioecoimpact Socio Economic impact
 * @property string $ptt_environmental Environmental
 * @property int $ptt_fdiclassification 1 - Horizontal FDI, 2 -  Vertical FDI, 3 -  Backward FDI
 * @property string $ptt_marketoverview Market Overview
 * @property string $ptt_marketneeds Market needs
 * @property string $ptt_markettrends Market Trends
 * @property string $ptt_similrefer Similar reference
 * @property string $ptt_submittedon First creation date
 * @property int $ptt_submittedby Reference to usermst_tbl
 * @property string $ptt_submittedbyipaddr IP Address of the user
 * @property string $ptt_updatedon Updated on date
 * @property int $ptt_updatedby Reference to usermst_tbl
 * @property string $ptt_updatedbyipaddr IP Address of the user
 *
 * @property ProjecttmpTbl $pttProjecttmpFk
 */
class ProjtechnicaltmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projtechnicaltmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptt_projecttmp_fk'], 'required'],
            [['ptt_projecttmp_fk', 'ptt_fdiclassification', 'ptt_submittedby', 'ptt_updatedby'], 'integer'],
            [['ptt_techinfo', 'ptt_techapprovals', 'ptt_socioecoimpact', 'ptt_environmental', 'ptt_marketoverview', 'ptt_marketneeds', 'ptt_markettrends', 'ptt_similrefer'], 'string'],
            [['ptt_submittedon', 'ptt_updatedon'], 'safe'],
            [['ptt_submittedbyipaddr', 'ptt_updatedbyipaddr'], 'string', 'max' => 50],
            [['ptt_projecttmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjecttmpTbl::className(), 'targetAttribute' => ['ptt_projecttmp_fk' => 'projecttmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projtechnicaltmp_pk' => 'Projtechnicaltmp Pk',
            'ptt_projecttmp_fk' => 'Ptt Projecttmp Fk',
            'ptt_techinfo' => 'Ptt Techinfo',
            'ptt_techapprovals' => 'Ptt Techapprovals',
            'ptt_socioecoimpact' => 'Ptt Socioecoimpact',
            'ptt_environmental' => 'Ptt Environmental',
            'ptt_fdiclassification' => 'Ptt Fdiclassification',
            'ptt_marketoverview' => 'Ptt Marketoverview',
            'ptt_marketneeds' => 'Ptt Marketneeds',
            'ptt_markettrends' => 'Ptt Markettrends',
            'ptt_similrefer' => 'Ptt Similrefer',
            'ptt_submittedon' => 'Ptt Submittedon',
            'ptt_submittedby' => 'Ptt Submittedby',
            'ptt_submittedbyipaddr' => 'Ptt Submittedbyipaddr',
            'ptt_updatedon' => 'Ptt Updatedon',
            'ptt_updatedby' => 'Ptt Updatedby',
            'ptt_updatedbyipaddr' => 'Ptt Updatedbyipaddr',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPttProjecttmpFk()
    {
        return $this->hasOne(ProjecttmpTbl::className(), ['projecttmp_pk' => 'ptt_projecttmp_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ProjtechnicaltmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjtechnicaltmpTblQuery(get_called_class());
    }
}
