<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contactusdtls_tbl".
 *
 * @property int $contactusdtls_pk Primary key
 * @property int $cud_conttype 1 - Before login, 2 - Post login
 * @property int $cud_membercompmst_fk Reference to membercompanymst_tbl
 * @property int $cud_usermst_fk Reference to usermst_tbl
 * @property string $cud_companyname Contacted Company Name
 * @property string $cud_username Contacted User Name
 * @property string $cud_emailid Email ID
 * @property int $cud_querytype List of values to be provided
 * @property string $cud_subject Subject of the Query
 * @property string $cud_message Messageof the Query
 * @property string $cud_fileupload Uploaded files in comma / *** separation
 * @property string $cud_createdon Datetime of creation
 * @property string $cud_mailtemplatepath Mail template path
 */
class ContactusdtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contactusdtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['cud_conttype', 'cud_createdon'], 'required'],
            [['cud_conttype', 'cud_membercompmst_fk', 'cud_usermst_fk', 'cud_contactquerymst_fk', 'cud_mobilecc'], 'integer'],
            [['cud_message', 'cud_mailtemplatepath'], 'string'],
            [['cud_createdon'], 'safe'],
            [['cud_companyname'], 'string', 'max' => 250],
            [['cud_username'], 'string', 'max' => 100],
            [['cud_emailid', 'cud_emailcc', 'cud_subject'], 'string', 'max' => 255],
            [['cud_mobileno'], 'string', 'max' => 20],
            [['cud_memcompfiledtls_fk'], 'string', 'max' => 50],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contactusdtls_pk' => 'Contactusdtls Pk',
            'cud_conttype' => 'Cud Conttype',
            'cud_membercompmst_fk' => 'Cud Membercompmst Fk',
            'cud_usermst_fk' => 'Cud Usermst Fk',
            'cud_companyname' => 'Cud Companyname',
            'cud_username' => 'Cud Username',
            'cud_emailid' => 'Cud Emailid',
            'cud_querytype' => 'Cud Querytype',
            'cud_subject' => 'Cud Subject',
            'cud_message' => 'Cud Message',
            'cud_fileupload' => 'Cud Fileupload',
            'cud_createdon' => 'Cud Createdon',
            'cud_mailtemplatepath' => 'Cud Mailtemplatepath',
        ];
    }
}
