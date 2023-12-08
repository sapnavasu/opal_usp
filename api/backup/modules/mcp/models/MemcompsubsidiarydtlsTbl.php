<?php

namespace api\modules\mcp\models;

use Yii;

/**
 * This is the model class for table "memcompsubsidiarydtls_tbl".
 *
 * @property int $memcompsubsidiarydtls_pk Primary key
 * @property int $mcsd_membercompmst_fk Reference to membercompanymst_tbl
 * @property string $mcsd_subsidname
 * @property string $mcsd_address Address
 * @property string $mcsd_investmentdls Investment details
 * @property int $mcsd_marketshare Percentage of market share
 */
class MemcompsubsidiarydtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompsubsidiarydtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcsd_membercompmst_fk', 'mcsd_subsidname'], 'required'],
            [['mcsd_membercompmst_fk', 'mcsd_marketshare'], 'integer'],
            [['mcsd_address', 'mcsd_investmentdls'], 'string'],
            [['mcsd_subsidname'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompsubsidiarydtls_pk' => 'Memcompsubsidiarydtls Pk',
            'mcsd_membercompmst_fk' => 'Mcsd Membercompmst Fk',
            'mcsd_subsidname' => 'Mcsd Subsidname',
            'mcsd_address' => 'Mcsd Address',
            'mcsd_investmentdls' => 'Mcsd Investmentdls',
            'mcsd_marketshare' => 'Mcsd Marketshare',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompsubsidiarydtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompsubsidiarydtlsTblQuery(get_called_class());
    }
}
