<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appsiteauditreportcattmp_tbl".
 *
 * @property int $appsiteauditreportcattmp_pk primary key
 * @property int $asarct_appauditschedtmp_fk Reference to appauditschedtmp_pk
 * @property string $asarct_categorytitle_en
 * @property string $asarct_categorytitle_ar
 * @property int $asarct_order Order of title to be displayed
 * @property int $asarct_totalques
 * @property int $asarct_bronze
 * @property int $asarct_silver
 * @property int $asarct_gold
 * @property int $asarct_grademst_fk Reference to grademst_pk
 * @property string $asarct_gradingreason
 * @property string $asarct_createdon
 * @property int $asarct_createdby
 *
 * @property AppsiteauditquestionmsttmpTbl[] $appsiteauditquestionmsttmpTbls
 * @property AppsiteauditreportcathstyTbl[] $appsiteauditreportcathstyTbls
 * @property AppsiteauditreportcatmainTbl[] $appsiteauditreportcatmainTbls
 */
class AppsiteauditreportcattmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appsiteauditreportcattmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asarct_appauditschedtmp_fk', 'asarct_categorytitle_en', 'asarct_order', 'asarct_createdby'], 'required'],
            [['asarct_appauditschedtmp_fk', 'asarct_order', 'asarct_totalques', 'asarct_bronze', 'asarct_silver', 'asarct_gold', 'asarct_grademst_fk', 'asarct_createdby'], 'integer'],
            [['asarct_categorytitle_en', 'asarct_categorytitle_ar', 'asarct_gradingreason'], 'string'],
            [['asarct_createdon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appsiteauditreportcattmp_pk' => 'primary key',
            'asarct_appauditschedtmp_fk' => 'Reference to appauditschedtmp_pk',
            'asarct_categorytitle_en' => 'Asarct Categorytitle En',
            'asarct_categorytitle_ar' => 'Asarct Categorytitle Ar',
            'asarct_order' => 'Order of title to be displayed',
            'asarct_totalques' => 'Asarct Totalques',
            'asarct_bronze' => 'Asarct Bronze',
            'asarct_silver' => 'Asarct Silver',
            'asarct_gold' => 'Asarct Gold',
            'asarct_grademst_fk' => 'Reference to grademst_pk',
            'asarct_gradingreason' => 'Asarct Gradingreason',
            'asarct_createdon' => 'Asarct Createdon',
            'asarct_createdby' => 'Asarct Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditquestionmsttmpTbls()
    {
        return $this->hasMany(AppsiteauditquestionmsttmpTbl::className(), ['asaqm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditreportcathstyTbls()
    {
        return $this->hasMany(AppsiteauditreportcathstyTbl::className(), ['asarch_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppsiteauditreportcatmainTbls()
    {
        return $this->hasMany(AppsiteauditreportcatmainTbl::className(), ['asarcm_appsiteauditreportcattmp_fk' => 'appsiteauditreportcattmp_pk']);
    }

    /**
     * {@inheritdoc}
     * @return AppsiteauditreportcattmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppsiteauditreportcattmpTblQuery(get_called_class());
    }
}
