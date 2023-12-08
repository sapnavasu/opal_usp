<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appauditreportlog_tbl".
 *
 * @property int $appauditreportlog_pk
 * @property int $aarl_applicationdtlstmp_fk Reference to applicationdtlstmp_tbl
 * @property int $aarl_status 1-Desktop Review Approved, 2 - Desktop Review Declined, 3-Site Auditor Approved, 4-Quality manager  Approved,5-Quality Authority Approved,6-CEO Approved
 * @property string $aarl_appdecon
 * @property int $aarl_appdecby Reference to opalusemst_tbl
 * @property string $aarl_appdeccomments
 *
 * @property ApplicationdtlstmpTbl $aarlApplicationdtlstmpFk
 */
class AppauditreportlogTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appauditreportlog_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aarl_applicationdtlstmp_fk', 'aarl_status'], 'required'],
            [['aarl_applicationdtlstmp_fk', 'aarl_status', 'aarl_appdecby'], 'integer'],
            [['aarl_appdecon'], 'safe'],
            [['aarl_appdeccomments'], 'string'],
            [['aarl_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['aarl_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appauditreportlog_pk' => 'Appauditreportlog Pk',
            'aarl_applicationdtlstmp_fk' => 'Aarl Applicationdtlstmp Fk',
            'aarl_status' => 'Aarl Status',
            'aarl_appdecon' => 'Aarl Appdecon',
            'aarl_appdecby' => 'Aarl Appdecby',
            'aarl_appdeccomments' => 'Aarl Appdeccomments',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAarlApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'aarl_applicationdtlstmp_fk']);
    }
}
