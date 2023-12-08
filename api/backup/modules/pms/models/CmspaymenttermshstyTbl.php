<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "cmspaymenttermshsty_tbl".
 *
 * @property int $cmspaymenttermshsty_pk Primary key
 * @property int $cmspth_cmspaymentterms_fk refrerence to cmspaymentterms_tbl.cmspaymentterms_pk
 * @property int $cmspth_memcompmst_fk Reference to membercompanymst_tbl
 * @property int $cmspth_shared_fk Reference to cmstenderhdr_tbl, cmscontracthdr_tbl, cmsquotationhdr_tbl
 * @property int $cmspth_type 1 - Enquiry (RFI, EOI,etc,.) eTendering, 2 - Contract, 3 - Quotation
 * @property string $cmspth_name Term Name
 * @property string $cmspth_value Term Value
 *
 * @property MembercompanymstTbl $cmspthMemcompmstFk
 */
class CmspaymenttermshstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmspaymenttermshsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cmspth_cmspaymentterms_fk', 'cmspth_memcompmst_fk', 'cmspth_shared_fk', 'cmspth_type', 'cmspth_name', 'cmspth_value'], 'required'],
            [['cmspth_cmspaymentterms_fk', 'cmspth_memcompmst_fk', 'cmspth_shared_fk', 'cmspth_type'], 'integer'],
            [['cmspth_name', 'cmspth_value'], 'string'],
            [['cmspth_memcompmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => \api\modules\mst\models\MembercompanymstTbl::className(), 'targetAttribute' => ['cmspth_memcompmst_fk' => 'MemberCompMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmspaymenttermshsty_pk' => 'Cmspaymenttermshsty Pk',
            'cmspth_cmspaymentterms_fk' => 'Cmspth Cmspaymentterms Fk',
            'cmspth_memcompmst_fk' => 'Cmspth Memcompmst Fk',
            'cmspth_shared_fk' => 'Cmspth Shared Fk',
            'cmspth_type' => 'Cmspth Type',
            'cmspth_name' => 'Cmspth Name',
            'cmspth_value' => 'Cmspth Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCmspthMemcompmstFk()
    {
        return $this->hasOne(\api\modules\mst\models\MembercompanymstTbl::className(), ['MemberCompMst_Pk' => 'cmspth_memcompmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return CmspaymenttermshstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CmspaymenttermshstyTblQuery(get_called_class());
    }
}
