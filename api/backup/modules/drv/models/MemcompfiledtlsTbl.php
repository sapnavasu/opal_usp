<?php

namespace api\modules\drv\models;

use Yii;

/**
 * This is the model class for table "memcompfiledtls_tbl".
 *
 * @property string $memcompfiledtls_pk
 * @property int $mcfd_filemst_fk Reference to filemst_tbl
 * @property int $mcfd_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $mcfd_origfilename Original file name as given by the user
 * @property string $mcfd_sysgenerfilename System generated file name. Generated like currentdatetime with random number to avoid ambiguity
 * @property string $mcfd_uploadedon Datetime of upload
 * @property int $mcfd_uploadedby Reference to usermst_tbl
 * @property int $mcfd_actualfilesize Actual file size
 * @property int $mcfd_isdeleted If the file is deleted then 1 else 2
 */
class MemcompfiledtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memcompfiledtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcfd_filemst_fk', 'mcfd_memcompmst_fk', 'mcfd_origfilename', 'mcfd_sysgenerfilename', 'mcfd_uploadedon', 'mcfd_uploadedby', 'mcfd_actualfilesize', 'mcfd_isdeleted'], 'required'],
            [['mcfd_filemst_fk', 'mcfd_memcompmst_fk', 'mcfd_uploadedby', 'mcfd_actualfilesize', 'mcfd_isdeleted'], 'integer'],
            [['mcfd_origfilename', 'mcfd_sysgenerfilename'], 'string'],
            [['mcfd_uploadedon'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memcompfiledtls_pk' => 'Memcompfiledtls Pk',
            'mcfd_filemst_fk' => 'Mcfd Filemst Fk',
            'mcfd_memcompmst_fk' => 'Mcfd Memcompmst Fk',
            'mcfd_origfilename' => 'Mcfd Origfilename',
            'mcfd_sysgenerfilename' => 'Mcfd Sysgenerfilename',
            'mcfd_uploadedon' => 'Mcfd Uploadedon',
            'mcfd_uploadedby' => 'Mcfd Uploadedby',
            'mcfd_actualfilesize' => 'Mcfd Actualfilesize',
            'mcfd_isdeleted' => 'Mcfd Isdeleted',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MemcompfiledtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemcompfiledtlsTblQuery(get_called_class());
    }
}
