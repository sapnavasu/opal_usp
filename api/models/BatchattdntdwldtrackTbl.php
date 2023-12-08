<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "batchattdntdwldtrack_tbl".
 *
 * @property int $batchattdntdwldtrack_pk primary key
 * @property int $badt_batchmgmtdtls_fk Reference to batchmgmtdtls_pk
 * @property int $badt_opalusermst_fk Reference to opalusermst_pk
 * @property string $badt_downloadedon downloaded on date and time
 * @property string $badt_downloadipaddr Downloaded by ip address
 * @property string $badt_filenamepath Download file name and file path
 *
 * @property BatchmgmtdtlsTbl $badtBatchmgmtdtlsFk
 * @property OpalusermstTbl $badtOpalusermstFk
 */
class BatchattdntdwldtrackTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batchattdntdwldtrack_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['badt_batchmgmtdtls_fk', 'badt_opalusermst_fk', 'badt_downloadedon', 'badt_filenamepath'], 'required'],
            [['badt_batchmgmtdtls_fk', 'badt_opalusermst_fk'], 'integer'],
            [['badt_downloadedon'], 'safe'],
            [['badt_downloadipaddr', 'badt_filenamepath'], 'string'],
            //[['badt_batchmgmtdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BatchmgmtdtlsTbl::className(), 'targetAttribute' => ['badt_batchmgmtdtls_fk' => 'batchmgmtdtls_pk']],
            //[['badt_opalusermst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalusermstTbl::className(), 'targetAttribute' => ['badt_opalusermst_fk' => 'opalusermst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'batchattdntdwldtrack_pk' => 'Batchattdntdwldtrack Pk',
            'badt_batchmgmtdtls_fk' => 'Badt Batchmgmtdtls Fk',
            'badt_opalusermst_fk' => 'Badt Opalusermst Fk',
            'badt_downloadedon' => 'Badt Downloadedon',
            'badt_downloadipaddr' => 'Badt Downloadipaddr',
            'badt_filenamepath' => 'Badt Filenamepath',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadtBatchmgmtdtlsFk()
    {
        return $this->hasOne(BatchmgmtdtlsTbl::className(), ['batchmgmtdtls_pk' => 'badt_batchmgmtdtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBadtOpalusermstFk()
    {
        return $this->hasOne(OpalusermstTbl::className(), ['opalusermst_pk' => 'badt_opalusermst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return BatchattdntdwldtrackTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BatchattdntdwldtrackTblQuery(get_called_class());
    }
}
