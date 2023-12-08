<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "compfiledtls_tbl".
 *
 * @property int $compfiledtls_pk
 * @property int $cfd_filemst_fk Reference to opalfileuploadmst_tbl
 * @property int $cfd_memcompmst_fk Reference to membercompanymst_tbl
 * @property string $cfd_origfilename Original file name as given by the user
 * @property string $cfd_sysgenerfilename System generated file name. Generated like currentdatetime with random number to avoid ambiguity
 * @property string $cfd_filetype File types such as pdf, xlsx, doc to be stored
 * @property string $cfd_uploadedon Datetime of upload
 * @property int $cfd_uploadedby Reference to usermst_tbl
 * @property int $cfd_actualfilesize Actual file size
 * @property int $cfd_isdeleted If the file is deleted then 1 else 2
 * @property string $cfd_referredin
 * @property string $cfd_createdon
 * @property int $cfd_createdby
 * @property string $cfd_updatedon
 * @property int $cfd_updatedby
 *
 * @property FilemstTbl $cfdFilemstFk
 * @property LearnerasmthdrTbl[] $learnerasmthdrTbls
 * @property StafflicensedtlsTbl[] $stafflicensedtlsTbls
 */
class CompfiledtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compfiledtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cfd_filemst_fk', 'cfd_memcompmst_fk', 'cfd_origfilename', 'cfd_sysgenerfilename', 'cfd_filetype', 'cfd_uploadedon', 'cfd_uploadedby', 'cfd_actualfilesize', 'cfd_isdeleted', 'cfd_createdby'], 'required'],
            [['cfd_filemst_fk', 'cfd_memcompmst_fk', 'cfd_uploadedby', 'cfd_actualfilesize', 'cfd_isdeleted', 'cfd_createdby', 'cfd_updatedby'], 'integer'],
            [['cfd_origfilename', 'cfd_sysgenerfilename', 'cfd_referredin'], 'string'],
            [['cfd_uploadedon', 'cfd_createdon', 'cfd_updatedon'], 'safe'],
            [['cfd_filetype'], 'string', 'max' => 10],
            [['cfd_filemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => FilemstTbl::className(), 'targetAttribute' => ['cfd_filemst_fk' => 'filemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'compfiledtls_pk' => 'Compfiledtls Pk',
            'cfd_filemst_fk' => 'Cfd Filemst Fk',
            'cfd_memcompmst_fk' => 'Cfd Memcompmst Fk',
            'cfd_origfilename' => 'Cfd Origfilename',
            'cfd_sysgenerfilename' => 'Cfd Sysgenerfilename',
            'cfd_filetype' => 'Cfd Filetype',
            'cfd_uploadedon' => 'Cfd Uploadedon',
            'cfd_uploadedby' => 'Cfd Uploadedby',
            'cfd_actualfilesize' => 'Cfd Actualfilesize',
            'cfd_isdeleted' => 'Cfd Isdeleted',
            'cfd_referredin' => 'Cfd Referredin',
            'cfd_createdon' => 'Cfd Createdon',
            'cfd_createdby' => 'Cfd Createdby',
            'cfd_updatedon' => 'Cfd Updatedon',
            'cfd_updatedby' => 'Cfd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCfdFilemstFk()
    {
        return $this->hasOne(FilemstTbl::className(), ['filemst_pk' => 'cfd_filemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearnerasmthdrTbls()
    {
        return $this->hasMany(LearnerasmthdrTbl::className(), ['lasmth_AsmtUpload' => 'compfiledtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStafflicensedtlsTbls()
    {
        return $this->hasMany(StafflicensedtlsTbl::className(), ['sld_ROPlicenseupload' => 'compfiledtls_pk']);
    }

    /**
     * {@inheritdoc}
     * @return CompfiledtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompfiledtlsTblQuery(get_called_class());
    }
}
