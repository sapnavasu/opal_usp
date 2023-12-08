<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "natlookoutcatmst_tbl".
 *
 * @property int $NatLookOutCatMst_Pk
 * @property string $NLKCM_Category
 * @property string $NLKCM_Status
 * @property string $NLKCM_CreatedOn
 * @property int $NLKCM_CreatedBy
 * @property string $NLKCM_UpdatedOn
 * @property int $NLKCM_UpdatedBy
 */
class NatlookoutcatmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'natlookoutcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NLKCM_Status'], 'string'],
            [['NLKCM_CreatedOn', 'NLKCM_UpdatedOn'], 'safe'],
            [['NLKCM_CreatedBy', 'NLKCM_UpdatedBy'], 'integer'],
            [['NLKCM_Category'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NatLookOutCatMst_Pk' => 'Nat Look Out Cat Mst  Pk',
            'NLKCM_Category' => 'Nlkcm  Category',
            'NLKCM_Status' => 'Nlkcm  Status',
            'NLKCM_CreatedOn' => 'Nlkcm  Created On',
            'NLKCM_CreatedBy' => 'Nlkcm  Created By',
            'NLKCM_UpdatedOn' => 'Nlkcm  Updated On',
            'NLKCM_UpdatedBy' => 'Nlkcm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NatlookoutcatmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NatlookoutcatmstTblQuery(get_called_class());
    }
}
