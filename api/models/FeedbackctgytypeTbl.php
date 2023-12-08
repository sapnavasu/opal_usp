<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedbackctgytype_tbl".
 *
 * @property int $feedbackctgytype_pk
 * @property int $fdbkct_feedbackmst_fk Reference to feedbackmst_pk
 * @property string $fdbkct_feedbacklist_en
 * @property string $fdbkct_feedbacklist_ar
 * @property int $fdbkct_order Order of question to be displayed
 * @property int $fdbkct_status 1-Active, 2-Inactive, by default 1
 * @property string $fdbkct_createdon
 * @property int $fdbkct_createdby
 * @property string $fdbkct_updatedon
 * @property int $fdbkct_updatedby
 *
 * @property FdbkquestmstTbl[] $fdbkquestmstTbls
 * @property FeedbackmstTbl $fdbkctFeedbackmstFk
 */
class FeedbackctgytypeTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedbackctgytype_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fdbkct_feedbackmst_fk', 'fdbkct_feedbacklist_en', 'fdbkct_feedbacklist_ar', 'fdbkct_order', 'fdbkct_createdby'], 'required'],
            [['fdbkct_feedbackmst_fk', 'fdbkct_order', 'fdbkct_status', 'fdbkct_createdby', 'fdbkct_updatedby'], 'integer'],
            [['fdbkct_feedbacklist_en', 'fdbkct_feedbacklist_ar'], 'string'],
            [['fdbkct_createdon', 'fdbkct_updatedon'], 'safe'],
            [['fdbkct_feedbackmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FeedbackmstTbl::className(), 'targetAttribute' => ['fdbkct_feedbackmst_fk' => 'FeedbackMst_PK']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feedbackctgytype_pk' => 'Feedbackctgytype Pk',
            'fdbkct_feedbackmst_fk' => 'Fdbkct Feedbackmst Fk',
            'fdbkct_feedbacklist_en' => 'Fdbkct Feedbacklist En',
            'fdbkct_feedbacklist_ar' => 'Fdbkct Feedbacklist Ar',
            'fdbkct_order' => 'Fdbkct Order',
            'fdbkct_status' => 'Fdbkct Status',
            'fdbkct_createdon' => 'Fdbkct Createdon',
            'fdbkct_createdby' => 'Fdbkct Createdby',
            'fdbkct_updatedon' => 'Fdbkct Updatedon',
            'fdbkct_updatedby' => 'Fdbkct Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkquestmstTbls()
    {
        return $this->hasMany(FdbkquestmstTbl::className(), ['fdbkqm_feedbackcattype_fk' => 'feedbackctgytype_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFdbkctFeedbackmstFk()
    {
        return $this->hasOne(FeedbackmstTbl::className(), ['FeedbackMst_PK' => 'fdbkct_feedbackmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return FeedbackctgytypeTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeedbackctgytypeTblQuery(get_called_class());
    }
}
