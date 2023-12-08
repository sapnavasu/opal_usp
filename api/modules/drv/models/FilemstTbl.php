<?php

namespace api\modules\drv\models;

use Yii;

/**
 * This is the model class for table "filemst_tbl".
 *
 * @property int $filemst_pk Primary key
 * @property int $fm_filesize Defined size for the files
 * @property string $fm_filetype File extensions, separated by comma Eg. PDF,JPG,PNG
 * @property string $fm_filedimension To be specified only for Image files.
 * @property int $fm_filelabel List of files that will be uploaded in the portal
 * @property string $fm_fileicon File icon to be displayed
 * @property int $fm_modulemst_fk Reference to modulemst_tbl
 * @property int $fm_submodulemst_fk Reference to submodulemst_tbl
 * @property string $fm_phyfilepath Physical file path
 * @property int $fm_isdeleted If the files can be deleted or not. 1 - Yes, 2 - No
 */
class FilemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'filemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fm_filesize', 'fm_filetype', 'fm_filelabel', 'fm_fileicon', 'fm_modulemst_fk', 'fm_submodulemst_fk', 'fm_phyfilepath', 'fm_isdeleted'], 'required'],
            [['fm_filesize', 'fm_modulemst_fk', 'fm_submodulemst_fk', 'fm_isdeleted'], 'integer'],
            [['fm_filetype'], 'string', 'max' => 50],
            [['fm_filedimension', 'fm_fileicon'], 'string', 'max' => 15],
            [['fm_phyfilepath'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'filemst_pk' => 'Filemst Pk',
            'fm_filesize' => 'Fm Filesize',
            'fm_filetype' => 'Fm Filetype',
            'fm_filedimension' => 'Fm Filedimension',
            'fm_filelabel' => 'Fm Filelabel',
            'fm_fileicon' => 'Fm Fileicon',
            'fm_modulemst_fk' => 'Fm Modulemst Fk',
            'fm_submodulemst_fk' => 'Fm Submodulemst Fk',
            'fm_phyfilepath' => 'Fm Phyfilepath',
            'fm_isdeleted' => 'Fm Isdeleted',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FilemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FilemstTblQuery(get_called_class());
    }
    
}
