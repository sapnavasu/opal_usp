<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "tbgrademst_tbl".
 *
 * @property string $TBGradeMst_Pk
 * @property int $TBGM_TBSecMst_Fk
 * @property string $TBGM_GradeDtls
 * @property string $TBGM_CreatedOn
 * @property int $TBGM_CreatedBy
 * @property string $TBGM_UpdatedOn
 * @property int $TBGM_UpdatedBy
 */
class TbgrademstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbgrademst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TBGM_TBSecMst_Fk', 'TBGM_CreatedBy', 'TBGM_UpdatedBy'], 'integer'],
            [['TBGM_CreatedOn', 'TBGM_UpdatedOn'], 'safe'],
            [['TBGM_GradeDtls'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TBGradeMst_Pk' => 'Tbgrade Mst  Pk',
            'TBGM_TBSecMst_Fk' => 'Tbgm  Tbsec Mst  Fk',
            'TBGM_GradeDtls' => 'Tbgm  Grade Dtls',
            'TBGM_CreatedOn' => 'Tbgm  Created On',
            'TBGM_CreatedBy' => 'Tbgm  Created By',
            'TBGM_UpdatedOn' => 'Tbgm  Updated On',
            'TBGM_UpdatedBy' => 'Tbgm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TbgrademstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TbgrademstTblQuery(get_called_class());
    }
}
