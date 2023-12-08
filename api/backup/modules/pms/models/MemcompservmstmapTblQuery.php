<?php

namespace api\modules\pms\models;
use common\components\Common;

use Yii;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * This is the ActiveQuery class for [[MemcompservmstmapTbl]].
 *
 * @see MemcompservmstmapTbl
 */
class MemcompservmstmapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompservmstmapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getMapScfServicelist($dataPk) {
        $data = [];
        if($dataPk) {
            $data = MemcompservmstmapTbl::find()
                ->select([
                    'memcompservmstmap_pk serviceMapPk',
                    'CONCAT(SrvM_ServiceCode, "-", SrvM_ServiceName) serviceTitle'
                ])
                ->innerJoin('servicemst_tbl', 'mcsmm_servicemst_fk = servicemst_pk')
                ->where(['mcsmm_memcompservdtls_fk' => $dataPk, 'mcsmm_isdeleted' => 2])
                ->asArray()
                ->all();
        }
        return $data;
    }

    public function deLinkServiceMap($data) {
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if(!empty($data['dataPk'])) {
            return MemcompservmstmapTbl::updateAll([
                'mcsmm_isdeleted' => 1,
                'mcsmm_updatedon' => date('Y-m-d H:i:s'),
                'mcsmm_updatedbyipaddr' => $ip_address,
                'mcsmm_updatedby' => $userPK

            ], ['and',
                ['=', 'mcsmm_memcompservdtls_fk', $data['dataPk']],
                ['in', 'memcompservmstmap_pk', $data['serviceMapPks']]
            ]);
        }
    }

    public function exportServMap($data) {
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        $inputFileName = 'D:/xampp7/htdocs/j3/scfmultiprodNservmaplist.xlsx';
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $headArray = [
            'Company Name',
            'Business Source',
            'Group Category',
            'Main Category',
            'Sub Category',
            'Service Name'
        ];
        $dataArray = [];

        $servmstmap = MemcompservmstmapTbl::find()
            ->select([
                'MCM_CompanyName',
                'CONCAT(SrvM_ServiceCode, "-", SrvM_ServiceName) serviceTitle'
            ])
            ->innerJoin('memcompservicedtls_tbl', 'MemCompServDtls_Pk = mcsmm_memcompservdtls_fk')
            ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = MCSvD_MemberCompMst_Fk')
            ->leftJoin('servicemst_tbl', 'mcsmm_servicemst_fk = servicemst_pk')
            ->where(['mcsmm_memcompservdtls_fk' => $data['dataPk'], 'mcsmm_isdeleted' => 2])
            ->asArray()->all();

        foreach($servmstmap as $serv) {
            $dataArray[] = [
                $serv['MCM_CompanyName'],
                $data['bsname'],
                $data['cate']['group'],
                $data['cate']['main'],
                $data['cate']['sub'],
                $serv['serviceTitle']
            ];
        }
        
        $col = 'A';
        foreach($headArray as $key => $value) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($col++.'9', $value);
        }
        
        $row = 10;
        foreach($dataArray as $key => $value) {
            $col = 'A';
            foreach($value as $subKey => $subVal) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue($col++.$row, $subVal);
            }    
            $row++;
        }

        $user_name = \yii\db\ActiveRecord::getTokenData('user_name', true);
        $compnay_name = \yii\db\ActiveRecord::getTokenData('MCM_CompanyName', true);

        $spreadsheet->setActiveSheetIndex(0)->setCellValue('C7', date('d-M-Y'));
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F7', $user_name);
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('H7', $compnay_name);

        // Rename worksheet
        // $spreadsheet->getActiveSheet()->setTitle('Simple');
        
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $save_path = Yii::$app->basePath.'/web/generated/exported/scfprodNservmap/' . $compnay_name .date('d-M-Y-His') . '.xlsx';
        $save_link = Yii::$app->urlManager->createAbsoluteUrl(['web/generated/exported/scfprodNservmap']) . '/' . $compnay_name .date('d-M-Y-His') . '.xlsx';
        
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $save_path . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        
        $writer = new Xlsx($spreadsheet);
        fopen($save_path, "w");
        $writer->save($save_path);
        // $writer->save("php://output");
        return $save_link;
    }
}
