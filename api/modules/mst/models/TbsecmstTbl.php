<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the model class for table "tbsecmst_tbl".
 *
 * @property int $TBSecMst_Pk
 * @property string $TBSM_SecDtls
 * @property string $TBSM_CreatedOn
 * @property int $TBSM_CreatedBy
 * @property string $TBSM_UpdatedOn
 * @property int $TBSM_UpdatedBy
 *
 * @property TbgrademstTbl[] $tbgrademstTbls
 * @property TbgrademstTbl[] $tbgrademstTbls0
 */
class TbsecmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbsecmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TBSM_SecDtls', 'TBSM_CreatedOn', 'TBSM_CreatedBy'], 'required'],
            [['TBSM_CreatedOn', 'TBSM_UpdatedOn'], 'safe'],
            [['TBSM_CreatedBy', 'TBSM_UpdatedBy'], 'integer'],
            [['TBSM_SecDtls'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TBSecMst_Pk' => 'Tbsec Mst  Pk',
            'TBSM_SecDtls' => 'Tbsm  Sec Dtls',
            'TBSM_CreatedOn' => 'Tbsm  Created On',
            'TBSM_CreatedBy' => 'Tbsm  Created By',
            'TBSM_UpdatedOn' => 'Tbsm  Updated On',
            'TBSM_UpdatedBy' => 'Tbsm  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbgrademstTbls()
    {
        return $this->hasMany(TbgrademstTbl::className(), ['TBGM_TBSecMst_Fk' => 'TBSecMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbgrademstTbls0()
    {
        return $this->hasMany(TbgrademstTbl::className(), ['TBGM_TBSecMst_Fk' => 'TBSecMst_Pk']);
    }

    /**
     * {@inheritdoc}
     * @return TbsecmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TbsecmstTblQuery(get_called_class());
    }
}
