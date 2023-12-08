<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "natlookoutsubcatmst_tbl".
 *
 * @property int $NatLookOutSubCatMst_Pk
 * @property int $NLKSCM_NatLookOutCatMst_Fk
 * @property string $NLKSCM_SubCategory
 * @property string $NLKSCM_Status
 * @property string $NLKSCM_CreatedOn
 * @property int $NLKSCM_CreatedBy
 * @property string $NLKSCM_UpdatedOn
 * @property int $NLKSCM_UpdatedBy
 */
class NatlookoutsubcatTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'natlookoutsubcatmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NLkSCM_NatLookOutCatMst_Fk', 'NLkSCM_CreatedBy', 'NLkSCM_UpdatedBy'], 'integer'],
            [['NLkSCM_Status'], 'string'],
            [['NLkSCM_CreatedOn', 'NLkSCM_UpdatedOn'], 'safe'],
            [['NLkSCM_SubCategory'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NatLookOutSubCatMst_Pk' => 'Nat Look Out Sub Cat Mst  Pk',
            'NLkSCM_NatLookOutCatMst_Fk' => 'Nlkscm  Nat Look Out Cat Mst  Fk',
            'NLkSCM_SubCategory' => 'Nlkscm  Sub Category',
            'NLkSCM_Status' => 'Nlkscm  Status',
            'NLkSCM_CreatedOn' => 'Nlkscm  Created On',
            'NLkSCM_CreatedBy' => 'Nlkscm  Created By',
            'NLkSCM_UpdatedOn' => 'Nlkscm  Updated On',
            'NLkSCM_UpdatedBy' => 'Nlkscm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return NatlookoutsubcatTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NatlookoutsubcatTblQuery(get_called_class());
    }
}
