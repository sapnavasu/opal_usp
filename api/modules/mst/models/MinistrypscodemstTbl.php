<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "ministrypscodemst_tbl".
 *
 * @property int $MinistryPSCodeMst_Pk
 * @property string $MPSCM_ProdServCode
 * @property string $MPSCM_ProdServName
 * @property string $MPSCM_CreatedOn
 * @property int $MPSCM_CreatedBy
 * @property string $MPSCM_UpdatedOn
 * @property int $MPSCM_UpdatedBy
 */
class MinistrypscodemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ministrypscodemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MPSCM_ProdServCode', 'MPSCM_ProdServName', 'MPSCM_CreatedOn', 'MPSCM_CreatedBy', 'MPSCM_UpdatedOn', 'MPSCM_UpdatedBy'], 'required'],
            [['MPSCM_CreatedOn', 'MPSCM_UpdatedOn'], 'safe'],
            [['MPSCM_CreatedBy', 'MPSCM_UpdatedBy'], 'integer'],
            [['MPSCM_ProdServCode'], 'string', 'max' => 10],
            [['MPSCM_ProdServName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MinistryPSCodeMst_Pk' => 'Ministry Pscode Mst  Pk',
            'MPSCM_ProdServCode' => 'Mpscm  Prod Serv Code',
            'MPSCM_ProdServName' => 'Mpscm  Prod Serv Name',
            'MPSCM_CreatedOn' => 'Mpscm  Created On',
            'MPSCM_CreatedBy' => 'Mpscm  Created By',
            'MPSCM_UpdatedOn' => 'Mpscm  Updated On',
            'MPSCM_UpdatedBy' => 'Mpscm  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MinistrypscodemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MinistrypscodemstTblQuery(get_called_class());
    }
}
