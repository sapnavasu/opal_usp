<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OpalfileuploadmstTbl]].
 *
 * @see OpalfileuploadmstTbl
 */
class OpalfileuploadmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OpalfileuploadmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OpalfileuploadmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
   
    
    public function filee($pk){
        return \app\models\OpalfileuploadmstTbl::find()
                ->select(['ofm_filelabel as fileName',
                    'opalfileuploadmst_pk as key',
                    'ofm_filelabel as fileNote',
                    'ofm_filetype as fileFormat',
                    'ofm_filesize as fileSize',
                    'ofm_phyfilepath as filePath',
                    ])
                ->where('opalfileuploadmst_pk = :key',['key' => $pk])
                ->asArray()
                ->one();
    }
}
