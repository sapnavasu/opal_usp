<?php

namespace api\modules\pms\models;

use Yii;

/**
 * This is the model class for table "jsrsnonbidderhsty_tbl".
 *
 * @property int $jsrsnonbidderhsty_pk Primary key
 * @property int $jnbh_jsrsnonbidderdtls_fk Reference to jsrsnonbidderdtls_tbl
 * @property int $jnbh_cmstenderhdr_fk Reference to cmstenderhdr_tbl
 * @property string $jnbh_companyname Company Name
 * @property string $jnbh_cmpemailid Company Email ID
 * @property string $jnbh_personname Contact Person Name
 * @property string $jnbh_designation Designation of the contact person
 * @property string $jnbh_cpemailid Email of the contact person
 * @property string $jnbh_cpmobileno Mobile No
 * @property string $jnbh_createdon Date of creation
 *
 * @property CmstenderhdrTbl $jnbhCmstenderhdrFk
 * @property JsrsnonbidderdtlsTbl $jnbhJsrsnonbidderdtlsFk
 */
class JsrsnonbidderhstyTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jsrsnonbidderhsty_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jnbh_jsrsnonbidderdtls_fk', 'jnbh_cmstenderhdr_fk', 'jnbh_companyname', 'jnbh_cmpemailid', 'jnbh_personname', 'jnbh_designation', 'jnbh_cpemailid', 'jnbh_cpmobileno', 'jnbh_createdon'], 'required'],
            [['jnbh_jsrsnonbidderdtls_fk', 'jnbh_cmstenderhdr_fk'], 'integer'],
            [['jnbh_createdon'], 'safe'],
            [['jnbh_companyname'], 'string', 'max' => 250],
            [['jnbh_cmpemailid', 'jnbh_personname', 'jnbh_cpemailid'], 'string', 'max' => 255],
            [['jnbh_designation'], 'string', 'max' => 100],
            [['jnbh_cpmobileno'], 'string', 'max' => 20],
            [['jnbh_cmstenderhdr_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CmstenderhdrTbl::className(), 'targetAttribute' => ['jnbh_cmstenderhdr_fk' => 'cmstenderhdr_pk']],
            [['jnbh_jsrsnonbidderdtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => JsrsnonbidderdtlsTbl::className(), 'targetAttribute' => ['jnbh_jsrsnonbidderdtls_fk' => 'jsrsnonbidderdtls_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jsrsnonbidderhsty_pk' => 'Jsrsnonbidderhsty Pk',
            'jnbh_jsrsnonbidderdtls_fk' => 'Jnbh Jsrsnonbidderdtls Fk',
            'jnbh_cmstenderhdr_fk' => 'Jnbh Cmstenderhdr Fk',
            'jnbh_companyname' => 'Jnbh Companyname',
            'jnbh_cmpemailid' => 'Jnbh Cmpemailid',
            'jnbh_personname' => 'Jnbh Personname',
            'jnbh_designation' => 'Jnbh Designation',
            'jnbh_cpemailid' => 'Jnbh Cpemailid',
            'jnbh_cpmobileno' => 'Jnbh Cpmobileno',
            'jnbh_createdon' => 'Jnbh Createdon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnbhCmstenderhdrFk()
    {
        return $this->hasOne(CmstenderhdrTbl::className(), ['cmstenderhdr_pk' => 'jnbh_cmstenderhdr_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJnbhJsrsnonbidderdtlsFk()
    {
        return $this->hasOne(JsrsnonbidderdtlsTbl::className(), ['jsrsnonbidderdtls_pk' => 'jnbh_jsrsnonbidderdtls_fk']);
    }

    /**
     * {@inheritdoc}
     * @return JsrsnonbidderhstyTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JsrsnonbidderhstyTblQuery(get_called_class());
    }
}
