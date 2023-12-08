<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "opalfileuploadmst_tbl".
 *
 * @property int $opalfileuploadmst_pk primary key
 * @property int $ofm_filesize size of the file
 * @property string $ofm_filetype file extensions, separated by comma\n eg. pdf,jpg,png
 * @property string $ofm_filelabel
 * @property string $ofm_phyfilepath physical file path
 * @property int $ofm_isdeleted if the files can be deleted or not. 1 - yes, 2 - no
 * @property string $ofm_fileuploadon date of upload the file
 *
 * @property OpalmemberregmstTbl[] $opalmemberregmstTbls
 * @property OpalmemcompfiledtlsTbl[] $opalmemcompfiledtlsTbls
 */
class OpalfileuploadmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opalfileuploadmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ofm_filesize', 'ofm_filetype', 'ofm_phyfilepath', 'ofm_isdeleted', 'ofm_fileuploadon'], 'required'],
            [['ofm_filesize', 'ofm_isdeleted'], 'integer'],
            [['ofm_fileuploadon'], 'safe'],
            [['ofm_filetype', 'ofm_filelabel', 'ofm_phyfilepath'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'opalfileuploadmst_pk' => 'Opalfileuploadmst Pk',
            'ofm_filesize' => 'Ofm Filesize',
            'ofm_filetype' => 'Ofm Filetype',
            'ofm_filelabel' => 'Ofm Filelabel',
            'ofm_phyfilepath' => 'Ofm Phyfilepath',
            'ofm_isdeleted' => 'Ofm Isdeleted',
            'ofm_fileuploadon' => 'Ofm Fileuploadon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemberregmstTbls()
    {
        return $this->hasMany(OpalmemberregmstTbl::className(), ['omrm_cractivity' => 'opalfileuploadmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpalmemcompfiledtlsTbls()
    {
        return $this->hasMany(OpalmemcompfiledtlsTbl::className(), ['omcfd_filemst_fk' => 'opalfileuploadmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return OpalfileuploadmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OpalfileuploadmstTblQuery(get_called_class());
    }
}
