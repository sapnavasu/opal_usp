<?php

namespace api\modules\drv\models;
use Yii;

/**
 * This is the ActiveQuery class for [[FilemstTbl]].
 *
 * @see FilemstTbl
 */
class FilemstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FilemstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FilemstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function filee($pk){
        return \api\modules\drv\models\FilemstTbl::find()
                ->select(['fm_filelabel as fileName',
                    'filemst_pk as key',
                    'fm_filelabel as fileNote',
                    'fm_filetype as fileFormat',
                    'fm_filesize as fileSize',
                    'fm_filedimension as fileDimension',
                    'fm_fileicon as fileIcon',
                    'fm_modulemst_fk as fileModPk',
                    'fm_submodulemst_fk as fileSubModPk',
                    'fm_filemaxcount as fileMaxCount',
                    'fm_phyfilepath as filePath',
                    'fm_iscrop as fileIsCrop',
                    'fm_cropratio as fileCropRatio',
                    ])
                ->where('filemst_pk = :key',['key' => $pk])
                ->asArray()
                ->one();
    }

    public function addfilemstvalue($value) { 
        if($value) { 
            if($value['filemstpk']) {
                $model = FilemstTbl::findOne($value['filemstpk']);
            } else {  
                $model = new FilemstTbl();
                
            } 
           // print_r($value);print_r(implode(',',$value['fileaccept'])); 
            $model->fm_filesize = $value['maxfilesize'] * 1024 * 1024; //converting MB to B
            $model->fm_filetype = $value['fileaccept']; //implode(',',$value['fileaccept']))
            $model->fm_filelabel = $value['description'];
            $model->fm_fileicon =  'jpgIcon.jpg'; // as of now hardcoded
            $model->fm_modulemst_fk = 1;
            $model->fm_submodulemst_fk = 1;
            $model->fm_filemaxcount = $value['maxfilecount'];
            $model->fm_phyfilepath = $value['description'];
            $model->fm_isdeleted = 0;
          // print_r($model);
            if ($model->save() === TRUE) { 
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => $msg,
                    'moduleData' => $model,
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!44',
                    'returndata' => $model->getErrors(),
                );
            }
        }  
        return $result; 
    }
}
