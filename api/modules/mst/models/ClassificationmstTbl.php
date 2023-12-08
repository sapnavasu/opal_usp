<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "classificationmst_tbl".
 *
 * @property string $ClassificationMst_Pk
 * @property string $ClM_HeadCount
 * @property string $ClM_AnnualSales
 * @property string $ClM_ClassificationType
 * @property string $ClM_CreatedOn
 * @property int $ClM_CreatedBy
 * @property string $ClM_UpdatedOn
 * @property int $ClM_UpdatedBy
 */
class ClassificationmstTbl extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'classificationmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['CIM_stkholdertypmst_fk', 'ClM_CreatedBy', 'ClM_UpdatedBy'], 'integer'],
            [['ClM_ClassificationType', 'ClM_Status', 'ClM_CreatedBy'], 'required'],
            [['ClM_Status'], 'string'],
            [['ClM_CreatedOn', 'ClM_UpdatedOn'], 'safe'],
            [['ClM_ClassificationType'], 'string', 'max' => 30],
            [['ClM_HeadCount', 'ClM_AnnualSales'], 'string', 'max' => 50],
            [['ClM_CreatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ClM_CreatedBy' => 'UserMst_Pk']],
            [['ClM_UpdatedBy'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['ClM_UpdatedBy' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'ClassificationMst_Pk' => 'Classification Mst  Pk',
            'CIM_stkholdertypmst_fk' => 'Cim Stkholdertypmst Fk',
            'ClM_ClassificationType' => 'Cl M  Classification Type',
            'ClM_HeadCount' => 'Cl M  Head Count',
            'ClM_AnnualSales' => 'Cl M  Annual Sales',
            'ClM_Status' => 'Cl M  Status',
            'ClM_CreatedOn' => 'Cl M  Created On',
            'ClM_CreatedBy' => 'Cl M  Created By',
            'ClM_UpdatedOn' => 'Cl M  Updated On',
            'ClM_UpdatedBy' => 'Cl M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClassificationmstTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new ClassificationmstTblQuery(get_called_class());
    }

    public function behaviors() {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [
            [
                'class' => TimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ClM_CreatedOn'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['ClM_UpdatedOn'],
                ],
            ],
            [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ClM_CreatedBy'],
                //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                ],
            ],
        ];
    }

    public static function isClassificationMapped($classificationpk) {
        return \common\models\MembercompanymstTbl::find()
                        ->where(['mcm_classificationmst_fk' => $classificationpk])
                        ->exists();
    }

    public static function getInternationalClassification($requestdata = null) {
        if ($requestdata) {
            return self::find()
                            ->where(['ClM_ClassificationType' => "International",
                                'ClM_HeadCount' => null, 'ClM_AnnualSales' => null])
                            ->andWhere(['CIM_stkholdertypmst_fk' => $requestdata['stktype']])
                            ->all();
        }
        else
        {
        return self::find()
        ->where(['ClM_ClassificationType' => "International",
        'ClM_HeadCount' => null, 'ClM_AnnualSales' => null])
        ->all();
        }
    }
}
