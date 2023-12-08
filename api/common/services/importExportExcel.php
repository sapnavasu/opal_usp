<?php
namespace api\common\services;

class importExportExcel{

    public function doImport($filepk, $modelClass){
        
        return $res;
    }

    public function import($filepk, $model){
         // $file = Yii::getAlias('@api/import_sample_XLS.xls');
        $fileDetails = \common\models\MemcompfiledtlsTbl::findOne($filepk);
        $directory = $fileDetails->masters->fm_phyfilepath;
        $srcDirectory= \Yii::$app->params['srcDirectory'];
        $userDirectory="comp_".$fileDetails->mcfd_memcompmst_fk."/user_".$fileDetails->mcfd_uploadedby;
        $uploadPath=  \Yii::$app->params['uploadPath'];
        $download_path = $srcDirectory.$uploadPath."/".$userDirectory. '/' . $directory.'/';
		$file = $download_path.'/'.$fileDetails->mcfd_sysgenerfilename;
      
		if(file_exists($file)){
            $data = \moonland\phpexcel\Excel::import($file, [
                'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel. 
                'setIndexSheetByName' => true, // set this if your excel data with multiple worksheet, the index of array will be set with the sheet name. If this not set, the index will use numeric. 
                // 'getOnlySheet' => 'sheet1', // you can set this property if you want to get the specified sheet from the excel data with multiple worksheet.
            ]);
        
            $failedRec = [];
            $status = false;
            if(!empty($data)){
                foreach($data as  $value){
                    if(array_filter($value)){
                        foreach($value as $key => $val){
                            // $key = str_replace(' ', '_', $key);//replace space in column name
                            if(strpos($key, 'pk')){
                                if($val){
                                    $model = $model->findOne($val);// get record with primary key
                                }
                            } 
                            if($key && $val){
                                $model->$key = $val; // set data to model
                            }
                        }
                    
                        if( $model->save() == TRUE){
                            $status = true;
                        } else {
                            $status = false;
                            $failedRec[] = $value;
                        }
                    }
                }
            }
            $result = array(
                'status' => $status,
                'message' => empty($failedRec) ? "Records imported successfully" : "Some records are not imported",
                'failedRec' => $failedRec
            );
        } else {
            $result = array(
                'status' => false,
                'message' => "File does not exist"
            );
        }
        
        return $result;

    }
}