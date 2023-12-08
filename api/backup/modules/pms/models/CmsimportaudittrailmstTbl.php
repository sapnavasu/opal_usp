<?php

namespace api\modules\pms\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Command;

//require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * This is the model class for table "cmsimportaudittrailmst_tbl".
 *
 * @property int $cmsimportaudittrailmst_pk Primary Key
 * @property int $ciatm_membercompmst_fk Reference to membercompanymst_tbl
 * @property string $ciatm_importdoc Path and name of the File imported
 * @property string $ciatm_importorgdocname Original name of the document uploaded
 * @property string $ciatm_failreport Path and name of the Failed records if any
 * @property int $ciatm_successrecords number of Success records count
 * @property int $ciatm_failrecords number of Fail records count
 * @property string $ciatm_createdon Datetime of creation
 * @property int $ciatm_createdby Reference to usermst_tbl
 * @property string $ciatm_createdbyipaddr IP Address of the user
 */
class CmsimportaudittrailmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cmsimportaudittrailmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ciatm_membercompmst_fk', 'ciatm_importdoc', 'ciatm_importorgdocname', 'ciatm_successrecords', 'ciatm_createdon', 'ciatm_createdby'], 'required'],
            [['ciatm_membercompmst_fk', 'ciatm_successrecords', 'ciatm_failrecords', 'ciatm_createdby'], 'integer'],
            [['ciatm_importdoc', 'ciatm_failreport'], 'string'],
            [['ciatm_createdon'], 'safe'],
            [['ciatm_importorgdocname'], 'string', 'max' => 100],
            [['ciatm_createdbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cmsimportaudittrailmst_pk' => 'Cmsimportaudittrailmst Pk',
            'ciatm_membercompmst_fk' => 'Ciatm Membercompmst Fk',
            'ciatm_importdoc' => 'Ciatm Importdoc',
            'ciatm_importorgdocname' => 'Ciatm Importorgdocname',
            'ciatm_failreport' => 'Ciatm Failreport',
            'ciatm_successrecords' => 'Ciatm Successrecords',
            'ciatm_failrecords' => 'Ciatm Failrecords',
            'ciatm_createdon' => 'Ciatm Createdon',
            'ciatm_createdby' => 'Ciatm Createdby',
            'ciatm_createdbyipaddr' => 'Ciatm Createdbyipaddr',
        ];
    }

    public function saveExcel($data) {

        if(isset($data['data'])) {

            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);     
            $model = new CmsimportaudittrailmstTbl;  

            $model->ciatm_membercompmst_fk  = $companypk;
            $model->ciatm_importdoc         = $data['data']['filepath'];
            $model->ciatm_importorgdocname  = $data['data']['originalname'];
            $model->ciatm_successrecords    = $data['data']['successrow'] ? $data['data']['successrow']:0;
            $model->ciatm_failrecords       = $data['data']['failurerow']?$data['data']['failurerow']:0;
            $model->ciatm_createdon         = date('Y-m-d H:i:s');
            $model->ciatm_createdby         = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model->ciatm_createdbyipaddr   = \common\components\Common::getIpAddress();          
            
          

            if(count($data['errorsData']) > 0) {

                try {
                    $finalArray = array();
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    $data1 = $data['errorsData'];

                    foreach ($data1 as $key => $value) {
                        if($key == 0) {
                            array_push($finalArray, $value);        
                        } elseif($key != 0) {
                            array_push($finalArray, $value['data']);
                        }
                    }
                    $cRow = 0; $cCol = 0;
                    foreach ($finalArray as $key => $value) {
                        $cRow ++; 
                        $cCol = 65; 
                        foreach ($value as $in_key => $cell) {
                            $sheet->setCellValue(chr($cCol) . $cRow, $cell);
                            $cCol++;
                        }
                    }
                    
                    $writer = new Xlsx($spreadsheet);
                    
                    // header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                    // header("Content-Disposition: attachment;filename=\"demo.xlsx\"");
                    // header("Cache-Control: max-age=0");
                    
                    // header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                    // header("Cache-Control: cache, must-revalidate");
                    // header("Pragma: public");
                   
                   // $writer->save('./../j3new/src/assets/Error_'.$data['data']['originalname']);
                    $writer->save('./../storage/Error_'.$data['data']['originalname']);

                    $model->ciatm_failreport   = 'Error_'.$data['data']['originalname'];
                } catch (ErrorException $e) {
                    return array(
                        'status' => 500,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'returndata' => "Can't write in file . file is open in another tab"
                    );
                }
            }
            if(!$model->save())
            {
                print_r($model->getErrors());
                exit;
            }
            if ($model->save() === TRUE) {

                $errorArray = array_shift($data1);
                if(count($data1) > 0) {
                    foreach ($data1 as $key => $value) {
                       $auditdtlsmodel = new CmsimportaudittraildtlsTbl;
                       $auditdtlsmodel->cmiadd_cmsimportaudittrailmst_fk = $model->getPrimaryKey();
                       $auditdtlsmodel->cmiadd_prjd_projectid ="1";
                       $auditdtlsmodel->cmiadd_cmsth_refno = "2";
                       $auditdtlsmodel->cmiadd_contractid = "3";
                       $auditdtlsmodel->cmiadd_importrecord = json_encode($value['data']);
                       $auditdtlsmodel->cmiadd_status = '2';
                       $auditdtlsmodel->cmiadd_comments = $value['type'];
                       $auditdtlsmodel->save();
                    }
                }
                if(count($data['successData']) > 0) {
                    foreach ($data['successData'] as $key => $value) {
                       $auditdtlsmodel = new CmsimportaudittraildtlsTbl;
                       $auditdtlsmodel->cmiadd_cmsimportaudittrailmst_fk = $model->getPrimaryKey();
                       $auditdtlsmodel->cmiadd_prjd_projectid ="1";
                       $auditdtlsmodel->cmiadd_cmsth_refno = "2";
                       $auditdtlsmodel->cmiadd_contractid = "3";
                       $auditdtlsmodel->cmiadd_importrecord = json_encode($value);
                       $auditdtlsmodel->cmiadd_status = '1';
                       $auditdtlsmodel->cmiadd_comments = '';
                       $auditdtlsmodel->save();
                    }
                }
                   
                $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
                    );
            } else {
                $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong',
                        'returndata' => $model->getErrors()
                    );
            }
            return $result;
        }

    }
    public function getAuditData($sort) {

        $model =  CmsimportaudittrailmstTbl::find();
        $model->select('cmsimportaudittrailmst_pk as id,
                        ciatm_successrecords as success, 
                        ciatm_failrecords as failure, 
                        ciatm_importorgdocname as uploaddocument,
                        ciatm_failreport as failuredocument,
                        ciatm_createdon  as dateandtime,
                        ciatm_importdoc as fileurl,
                        usermst_tbl.um_firstname as createdbyfirstname,
                        usermst_tbl.um_lastname as createdbylastname,
                        ciatm_createdbyipaddr as createdipaddress');

        $model->leftJoin('usermst_tbl','cmsimportaudittrailmst_tbl.ciatm_createdby = usermst_tbl.UserMst_Pk');
        
        if ($sort == 'desc') {
            $model->orderBy(['id' => SORT_DESC]);
        } else {
           $model->orderBy(['id' => SORT_ASC]);
        }

        $model->asArray();
        $provider = new ActiveDataProvider([ 'query' => $model]);
        $finalData = $provider->getModels();
        
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $finalData
        );
        return $result;
    }

    public function createExcel($data) { 
        
        $finalArray = array();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $data1 = $data['data'];
        
        foreach ($data1 as $key => $value) {
            if($key == 0) {
                array_push($finalArray, $value);        
            } elseif($key != 0) {
                array_push($finalArray, $value['data']);
            }
        }

        $cRow = 0; $cCol = 0;
        foreach ($finalArray as $key => $value) {
            $cRow ++; 
            $cCol = 65; 
            foreach ($value as $in_key => $cell) {
                $sheet->setCellValue(chr($cCol) . $cRow, $cell);
                $cCol++;
            }
        }
        
        $writer = new Xlsx($spreadsheet);
        
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename=\"demo.xlsx\"");
        header("Cache-Control: max-age=0");
        
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: cache, must-revalidate");
        header("Pragma: public");
       
        $writer->save('./../storage/Error_'.$data['originalFileName']);
    }
}
