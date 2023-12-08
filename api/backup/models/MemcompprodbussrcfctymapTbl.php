<?php

namespace app\models;

use Yii;
use \common\models\MemcompfctydtlsTbl;
use \common\models\MemcompprodbussrcmapTbl;

/**
 * This is the model class for table "memcompprodbussrcfctymap_tbl".
 *
 * @property int $memcompprodbussrcfctymap_pk Primary key
 * @property int $mcpbsfm_memcompprodbussrcmap_fk Reference to memcompprodbussrcmap_tbl
 * @property int $mcpbsfm_memcompfctydtls_fk Reference to memcompfctydtls_tbl
 *
 * @property MemcompfctydtlsTbl $mcpbsfmMemcompfctydtlsFk
 * @property MemcompprodbussrcmapTbl $mcpbsfmMemcompprodbussrcmapFk
 */
class MemcompprodbussrcfctymapTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompprodbussrcfctymap_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcpbsfm_memcompprodbussrcmap_fk', 'mcpbsfm_memcompfctydtls_fk'], 'required'],
            [['mcpbsfm_memcompprodbussrcmap_fk', 'mcpbsfm_memcompfctydtls_fk'], 'integer'],
            [['mcpbsfm_memcompfctydtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompfctydtlsTbl::className(), 'targetAttribute' => ['mcpbsfm_memcompfctydtls_fk' => 'memcompfctydtls_pk']],
            [['mcpbsfm_memcompprodbussrcmap_fk'], 'exist', 'skipOnError' => true, 'targetClass' => MemcompprodbussrcmapTbl::className(), 'targetAttribute' => ['mcpbsfm_memcompprodbussrcmap_fk' => 'memcompprodbussrcmap_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompprodbussrcfctymap_pk' => 'Memcompprodbussrcfctymap Pk',
            'mcpbsfm_memcompprodbussrcmap_fk' => 'Mcpbsfm Memcompprodbussrcmap Fk',
            'mcpbsfm_memcompfctydtls_fk' => 'Mcpbsfm Memcompfctydtls Fk',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpbsfmMemcompfctydtlsFk()
    {
        return $this->hasOne(MemcompfctydtlsTbl::className(), ['memcompfctydtls_pk' => 'mcpbsfm_memcompfctydtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMcpbsfmMemcompprodbussrcmapFk()
    {
        return $this->hasOne(MemcompprodbussrcmapTbl::className(), ['memcompprodbussrcmap_pk' => 'mcpbsfm_memcompprodbussrcmap_fk']);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodbussrcfctymapTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompprodbussrcfctymapTblQuery(get_called_class());
    }
}
