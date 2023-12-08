<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "memcompbussrcsectormap_tbl".
 *
 * @property int $memcompbussrcsectormap_pk
 * @property int $mcbssm_memcompbussrcdtls_fk Reference to memcompbussrcdtls_tbl
 * @property int $mcbssm_sectormst_fk Reference to sectormst_tbl
 *
 * @property MemcompbussrcdtlsTbl $mcbssmMemcompbussrcdtlsFk
 * @property SectormstTbl $mcbssmSectormstFk
 */
class MemcompbussrcsectormapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompbussrcsectormap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcbssm_memcompbussrcdtls_fk', 'mcbssm_sectormst_fk'], 'required'],
            [['mcbssm_memcompbussrcdtls_fk', 'mcbssm_sectormst_fk'], 'integer'],
            [['mcbssm_memcompbussrcdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\MemcompbussrcdtlsTbl::className(), 'targetAttribute' => ['mcbssm_memcompbussrcdtls_fk' => 'memcompbussrcdtls_pk']],
            [['mcbssm_sectormst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\SectormstTbl::className(), 'targetAttribute' => ['mcbssm_sectormst_fk' => 'SectorMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompbussrcsectormap_pk' => 'Memcompbussrcsectormap Pk',
            'mcbssm_memcompbussrcdtls_fk' => 'Mcbssm Memcompbussrcdtls Fk',
            'mcbssm_sectormst_fk' => 'Mcbssm Sectormst Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbssmMemcompbussrcdtlsFk()
    {
        return $this->hasOne(MemcompbussrcdtlsTbl::className(), ['memcompbussrcdtls_pk' => 'mcbssm_memcompbussrcdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcbssmSectormstFk()
    {
        return $this->hasOne(SectormstTbl::className(), ['SectorMst_Pk' => 'mcbssm_sectormst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbussrcsectormapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompbussrcsectormapTblQuery(get_called_class());
    }
}
