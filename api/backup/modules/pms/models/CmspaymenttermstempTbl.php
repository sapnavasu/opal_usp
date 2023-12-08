<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmspaymenttermstemp_tbl".
 *
 * @property int $cmspaymenttermstemp_pk Primary key
 * @property int $cmsptt_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmsptt_shared_fk Reference to cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $cmsptt_type 1 - Enquiry (RFI, EOI,etc,.) eTendering, 2 - Contract, 3 - Quotation
 * @property string $cmsptt_name Term Name
 * @property string $cmsptt_value Term Value
 *
 * @property MembercompanymstTbl $cmspttMemcompmstFk
 */
class CmspaymenttermstempTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmspaymenttermstemp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmsptt_memcompmst_fk', 'cmsptt_shared_fk', 'cmsptt_type', 'cmsptt_name', 'cmsptt_value'], 'required'],
            [['cmsptt_memcompmst_fk', 'cmsptt_shared_fk', 'cmsptt_type'], 'integer'],
            [['cmsptt_name', 'cmsptt_value'], 'string'],
            [['cmsptt_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\MembercompanymstTbl::className(), 'targetAttribute' => ['cmsptt_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmspaymenttermstemp_pk' => 'Cmspaymenttermstemp Pk',
            'cmsptt_memcompmst_fk' => 'Cmsptt Memcompmst Fk',
            'cmsptt_shared_fk' => 'Cmsptt Shared Fk',
            'cmsptt_type' => 'Cmsptt Type',
            'cmsptt_name' => 'Cmsptt Name',
            'cmsptt_value' => 'Cmsptt Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspttMemcompmstFk()
    {
        return $this->hasOne(\api\modules\mst\models\MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmsptt_memcompmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermstempTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmspaymenttermstempTblQuery(get_called_class());
    }
}
