<?php

namespace api\modules\pms\models;
use common\components\Common;

use Yii;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * This is the ActiveQuery class for [[MemcompprodmstmapTbl]].
 *
 * @see MemcompprodmstmapTbl
 */
class MemcompprodmstmapTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompprodmstmapTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getMapScfProductlist($dataPk) {
        $data = [];
        if($dataPk) {
            $data = MemcompprodmstmapTbl::find()
                ->select([
                    'memcompprodmstmap_pk prodMapPk',
                    'CONCAT(PrdM_ProductCode, "-", PrdM_ProductName) productTitle'
                ])
                ->innerJoin('productmst_tbl', 'mcpmm_productmst_fk = productmst_pk')
                ->where(['mcpmm_memcompproddtls_fk' => $dataPk, 'mcpmm_isdeleted' => 2])
                ->asArray()
                ->all();
        }
        return $data;
    }

    public function deLinkProdMap($data) {
        $ip_address = Common::getIpAddress();
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if(!empty($data['dataPk'])) {
            return MemcompprodmstmapTbl::updateAll([
                'mcpmm_isdeleted' => 1,
                'mcpmm_updatedon' => date('Y-m-d H:i:s'),
                'mcpmm_updatedbyipaddr' => $ip_address,
                'mcpmm_updatedby' => $userPK

            ], ['and',
                ['=', 'mcpmm_memcompproddtls_fk', $data['dataPk']],
                ['in', 'memcompprodmstmap_pk', $data['prodMapPks']]
            ]);
        }
    }

    public function exportProdMap($data) {
        $spreadsheet = new Spreadsheet();
        $inputFileType = 'Xlsx'; // Xlsx - Xml - Ods - Slk - Gnumeric - Csv
        $inputFileName = Yii::$app->params['multiprodNservmapPath'];
        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($inputFileName);

        $headArray = [
            'Company Name',
            'Business Source Name',
            'Business Source Type',
            'Group Category',
            'Main Category',
            'Sub Category',
            'Product Name'
        ];
        $dataArray = [];

        $prodmstmap = MemcompprodmstmapTbl::find()
            ->select([
                'MCM_CompanyName',
                'CONCAT(PrdM_ProductCode, "-", PrdM_ProductName) productTitle'
            ])
            ->innerJoin('memcompproddtls_tbl', 'MemCompProdDtls_Pk = mcpmm_memcompproddtls_fk')
            ->innerJoin('membercompanymst_tbl', 'MemberCompMst_Pk = MCPrD_MemberCompMst_Fk')
            ->leftJoin('productmst_tbl', 'mcpmm_productmst_fk = productmst_pk')
            ->where(['mcpmm_memcompproddtls_fk' => $data['dataPk'], 'mcpmm_isdeleted' => 2])
            ->asArray()->all();

        foreach($prodmstmap as $prod) {
            $dataArray[] = [
                $prod['MCM_CompanyName'],
                $data['bsname'],
                $data['bstype'],
                $data['cate']['group'],
                $data['cate']['main'],
                $data['cate']['sub'],
                $prod['productTitle']
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
