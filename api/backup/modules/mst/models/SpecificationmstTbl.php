<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "specificationmst_tbl".
 *
 * @property int $SpecificationMst_Pk
 * @property string $SpM_Specification
 * @property string $SpM_SpecDesc
 * @property string $SpM_SpecCategory
 * @property int $spm_spectype
 * @property string $SpM_Status
 * @property string $SpM_CreatedOn
 * @property int $SpM_CreatedBy
 *
 * @property MemcompprodspecdtlsTbl[] $memcompprodspecdtlsTbls
 */
class SpecificationmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specificationmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SpM_Specification', 'SpM_SpecDesc', 'SpM_SpecCategory', 'SpM_Status', 'SpM_CreatedOn', 'SpM_CreatedBy'], 'required'],
            [['SpM_SpecDesc', 'SpM_SpecCategory', 'SpM_Status'], 'string'],
            [['spm_spectype', 'SpM_CreatedBy'], 'integer'],
            [['SpM_CreatedOn'], 'safe'],
            [['SpM_Specification'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SpecificationMst_Pk' => 'Specification Mst  Pk',
            'SpM_Specification' => 'Sp M  Specification',
            'SpM_SpecDesc' => 'Sp M  Spec Desc',
            'SpM_SpecCategory' => 'Sp M  Spec Category',
            'spm_spectype' => 'Spm Spectype',
            'SpM_Status' => 'Sp M  Status',
            'SpM_CreatedOn' => 'Sp M  Created On',
            'SpM_CreatedBy' => 'Sp M  Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemcompprodspecdtlsTbls()
    {
        return $this->hasMany(MemcompprodspecdtlsTbl::className(), ['MCPSD_ProdSpecification_Fk' => 'SpecificationMst_Pk']);
    }

    /**
     * {@inheritdoc}
     * @return SpecificationmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecificationmstTblQuery(get_called_class());
    }
		 public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['SpM_CreatedOn'],
                        
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['SpM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
}
}
