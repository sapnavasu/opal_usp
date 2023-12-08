<?php

namespace api\modules\gcc\models;

use Yii;

/**
 * This is the model class for table "gcctendcontdocdtls_tbl".
 *
 * @property int $gcctendcontdocdtls_pk
 * @property int $gtcdd_gcctenddtls_fk Reference to GCC Tender Details Table
 * @property string $gtcdd_tacmpname Company name of the tender authority
 * @property string $gtcdd_taaddline1 Address line 1 of the tender authority
 * @property string $gtcdd_taaddline2 Address line 2 of the tender authority
 * @property string $gtcdd_tawebsite Website of the tender authority
 * @property string $gtcdd_fundingagency Funding Agency
 * @property string $gtcdd_cpname Contact Person Name
 * @property string $gtcdd_cpemail Contact Person E-mail
 * @property string $gtcdd_cptel Telephone number of the contact person
 * @property string $gtcdd_cpfax
 * @property string $gtcdd_supdoc Supporting Documents separated by asterisks
 * @property string $gtcdd_docsubdate Document Submission Date
 */
class gcctendcontdocdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcctendcontdocdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gtcdd_gcctenddtls_fk', 'gtcdd_tacmpname', 'gtcdd_taaddline1'], 'required'],
            [['gtcdd_gcctenddtls_fk'], 'integer'],
            [['gtcdd_taaddline1', 'gtcdd_taaddline2', 'gtcdd_supdoc'], 'string'],
            [['gtcdd_docsubdate'], 'safe'],
            [['gtcdd_tacmpname', 'gtcdd_tawebsite', 'gtcdd_cpemail'], 'string', 'max' => 255],
            [['gtcdd_fundingagency', 'gtcdd_cpname'], 'string', 'max' => 150],
            [['gtcdd_cptel', 'gtcdd_cpfax'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcctendcontdocdtls_pk' => 'Gcctendcontdocdtls Pk',
            'gtcdd_gcctenddtls_fk' => 'Gtcdd Gcctenddtls Fk',
            'gtcdd_tacmpname' => 'Gtcdd Tacmpname',
            'gtcdd_taaddline1' => 'Gtcdd Taaddline1',
            'gtcdd_taaddline2' => 'Gtcdd Taaddline2',
            'gtcdd_tawebsite' => 'Gtcdd Tawebsite',
            'gtcdd_fundingagency' => 'Gtcdd Fundingagency',
            'gtcdd_cpname' => 'Gtcdd Cpname',
            'gtcdd_cpemail' => 'Gtcdd Cpemail',
            'gtcdd_cptel' => 'Gtcdd Cptel',
            'gtcdd_cpfax' => 'Gtcdd Cpfax',
            'gtcdd_supdoc' => 'Gtcdd Supdoc',
            'gtcdd_docsubdate' => 'Gtcdd Docsubdate',
        ];
    }

    /**
     * {@inheritdoc}
     * @return gcctendcontdocdtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new gcctendcontdocdtlsTblQuery(get_called_class());
    }
}
