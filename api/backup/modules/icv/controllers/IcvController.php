<?php
namespace api\modules\icv\controllers;
use Yii;
use yii\web\Controller;

use yii\data\ActiveDataProvider;

use backend\models\IcvplanmetrictypemstTbl;
use backend\models\IcvplangoodshdrTbl;
use backend\models\IcvplanbasehdrTbl;
use backend\models\IcvplangoodsdtlTbl;
use backend\models\IcvplanservicehdrTbl;
use backend\models\IcvplanservicedtlTbl;
use backend\models\IcvplanwfspendhdrTbl;
use backend\models\IcvplanwfspenddtlTbl;
use backend\models\IcvplanwfheadcounthdrTbl;
use backend\models\IcvplanwfheadcountdtlTbl;
use backend\models\IcvplaninvesthdrTbl;
use backend\models\IcvplaninvestdtlTbl;
use backend\models\IcvplanspendTbl;
use backend\models\IcvplanspendhstryTbl;
use api\modules\quot\models\CmsquotationhdrTbl;
use common\components\Security;
use yii\db\Command;
/**
 * Default controller for the `icv` module
 */
class IcvController extends IcvMasterController
{
    public $modelClass = '\common\models\MemcompprofcertfdtlsTbl';

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = ['class' => \yii\filters\Cors::className() , 'cors' => ['Origin' => ['*'], 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'], 'Access-Control-Request-Headers' => ['*'], ], ];
        $action = Yii::$app->controller->action->id;
        $behaviors['contentNegotiator'] = ['class' => \yii\filters\ContentNegotiator::className() , 'formats' => ['application/json' => \yii\web\Response::FORMAT_JSON, ], ];

        return $behaviors;
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionGetgoods()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('id');
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $icvbasehdr = Yii::$app->getRequest()->getQueryParam('icvbasehdr');

        $query = IcvplangoodshdrTbl::find();
        $query->select('icvplangoodshdr_tbl.icvplangoodshdr_pk as id,
            icvplanmetrictypemst_tbl.ipmtm_typename as protype,
            (select ipgcm_name from icvplangoodscatmst_tbl where icvplangoodscatmst_pk = icvplangoodssubcatmst_tbl.ipgscm_icvplangoodscatmst_fk) as gcat,
            icvplangoodssubcatmst_tbl.ipgscm_name as gsubcat,
            icvplansuppcatmst_tbl.ipspcm_name as supcat,
            icvplangoodshdr_tbl.ipgh_summary as summary');

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplangoodshdr_tbl.ipgh_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplangoodssubcatmst_tbl', 'icvplangoodssubcatmst_tbl.icvplangoodssubcatmst_pk = icvplangoodshdr_tbl.ipgh_icvplangoodssubcatmst_fk');

        $query->leftJoin('icvplansuppcatmst_tbl', 'icvplansuppcatmst_tbl.icvplansuppcatmst_pk = icvplangoodshdr_tbl.ipgh_icvplansuppcatmst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }

        if ($icvbasehdr)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $icvbasehdr]);
        }

        $listofData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplangoodsdtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipgd_icvplangoodshdr_fk' => $value['id']]);

            if ($icvbasehdr == 2)
            {
                $month = date("n");
                $currentQuarter = ceil($month / 3);
                $query_dtl->andWhere(['ipgd_year' => date("Y") , 'ipgd_quarter' => $currentQuarter]);
            }
            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();

            $year = 1;
            $anuTotal = 0;
            $grandTotal = 0;

            foreach ($dtlsData as $dtldatakey => $dtldatavalue)
            {
                $listofData[$key]['y' . $year] = $dtldatavalue['ipgd_year'];

                if (is_null($dtldatavalue['ipgd_value']))
                {
                    $listofData[$key]['y' . $year . 'q' . $dtldatavalue['ipgd_quarter']] = 0;
                }
                else
                {
                    $listofData[$key]['y' . $year . 'q' . $dtldatavalue['ipgd_quarter']] = $dtldatavalue['ipgd_value'];
                    $anuTotal += $dtldatavalue['ipgd_value'];
                    $grandTotal += $dtldatavalue['ipgd_value'];
                }
                if ($dtldatavalue['ipgd_quarter'] % 4 == 0)
                {
                    $listofData[$key]['y' . $year . 'anutot'] = sprintf("%.2f", $anuTotal);

                    $year++;
                    $anuTotal = 0;
                }
                if (count($dtlsData) - 1 == $dtldatakey)
                {
                    $listofData[$key]['y' . $year . 'anutot'] = sprintf("%.2f", $anuTotal);
                    $listofData[$key]['grandtot'] = sprintf("%.2f", $grandTotal);
                }
            }
        }
        if ($icvbasehdr == 2)
        {
            $actualData = array();

            foreach ($listofData as $key => $value)
            {
                if (array_key_exists('y1', $value))
                {
                    array_push($actualData, $value);
                }
            }
            if (empty($actualData))
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $finalDummy = array();
                $goodDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "gcat" => "Select Product Category",
                    "gsubcat" => "Select Product Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => "",
                    'y1' => date('Y') ,
                    'y1q' . $currentQuarter => '0'
                );

                array_push($finalDummy, $goodDummy);

                return ['items' => $finalDummy];
            }
            else
            {
                return ['items' => $actualData];
            }
        }

        if (empty($listofData))
        {
            if ($type == 'Contract' || $type == 'Project')
            {
                $month = date("n");
                $currentQuarter = ceil($month / 3);
                $finalDummy = array();
                $goodDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "gcat" => "Select Product Category",
                    "gsubcat" => "Select Product Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => "",
                    'y1' => date('Y') ,
                    'y1q' . $$currentQuarter => '0'
                );
                array_push($finalDummy, $goodDummy);
            }
            else
            {
                $goodDummy = array();

                $icvstart = Yii::$app->getRequest()->getQueryParam('starty');

                $startY = Yii::$app->getRequest()->getQueryParam('starty');
                $startq = Yii::$app->getRequest()->getQueryParam('startq');
                $endY = Yii::$app->getRequest()->getQueryParam('endy');
                $endQ = Yii::$app->getRequest()->getQueryParam('endq');

                $finalDummy = array();
                $goodDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "gcat" => "Select Product Category",
                    "gsubcat" => "Select Product Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => ""
                );

                for ($i = 0;$i < 3;$i++)
                {

                    $years = array();
                    while ($icvstart <= $endY)
                    {
                        array_push($years, $icvstart++);
                    }
                    $forendQuarter = 4;
                    foreach ($years as $key => $value)
                    {
                        if ($value != $startY)
                        {
                            $startq = 1;
                        }
                        if ($endY == $value)
                        {
                            $forendQuarter = $endQ;
                        }

                        $goodDummy['y' . ($key + 1) ] = (int)$value;
                        for ($j = $startq;$j <= $forendQuarter;$j++)
                        {
                            $goodDummy['y' . ($key + 1) . 'q' . ($j) ] = 0;
                        }
                    }
                    array_push($finalDummy, $goodDummy);
                }
            }
            return ['items' => $finalDummy];
        }
        return ['items' => $listofData];
    }

    //Get Service Grid Data
    public function actionGetservice()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('id');
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $icvbasehdr = Yii::$app->getRequest()->getQueryParam('icvbasehdr');

        $query = IcvplanservicehdrTbl::find();
        $query->select('icvplanservicehdr_tbl.icvplanservicehdr_pk as id,
            icvplanmetrictypemst_tbl.ipmtm_typename as protype,
            (select ipscm_name from icvplanservicecatmst_tbl where icvplanservicecatmst_pk = icvplanservicesubcatmst_tbl.ipsscm_icvplanservicecatmst_fk) as scat,
            icvplanservicesubcatmst_tbl.ipsscm_name as ssubcat,
            icvplansuppcatmst_tbl.ipspcm_name as supcat,
            icvplanservicehdr_tbl.ipsh_summary as summary');

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplanservicehdr_tbl.ipsh_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplanservicesubcatmst_tbl', 'icvplanservicesubcatmst_tbl.icvplanservicesubcatmst_pk = icvplanservicehdr_tbl.ipsh_icvplanservicesubcatmst_fk');

        $query->leftJoin('icvplansuppcatmst_tbl', 'icvplansuppcatmst_tbl.icvplansuppcatmst_pk = icvplanservicehdr_tbl.ipsh_icvplansuppcatmst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($icvbasehdr)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $icvbasehdr]);
        }

        $listofData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();
        //print_r($listofData);die();
        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplanservicedtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipsd_icvplanservicehdr_fk' => $value['id']]);

            if ($icvbasehdr == 2)
            {
                $month = date("n");
                $currentQuarter = ceil($month / 3);
                //print_r($currentQuarter);die();
                $query_dtl->andWhere(['ipsd_year' => date("Y") , 'ipsd_quarter' => $currentQuarter]);
            }

            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();

            $year = 1;
            $anuTotal = 0;
            $grandTotal = 0;

            foreach ($dtlsData as $dtldatakey => $dtldatavalue)
            {

                $listofData[$key]['y' . $year] = $dtldatavalue['ipsd_year'];
                if (is_null($dtldatavalue['ipsd_value']))
                {
                    $listofData[$key]['y' . $year . 'q' . $dtldatavalue['ipsd_quarter']] = 0;
                }
                else
                {
                    $listofData[$key]['y' . $year . 'q' . $dtldatavalue['ipsd_quarter']] = $dtldatavalue['ipsd_value'];
                    $anuTotal += $dtldatavalue['ipsd_value'];
                    $grandTotal += $dtldatavalue['ipsd_value'];
                }

                if ($dtldatavalue['ipsd_quarter'] % 4 == 0)
                {
                    $listofData[$key]['y' . $year . 'anutot'] = sprintf("%.2f", $anuTotal);
                    $year++;
                    $anuTotal = 0;
                }
                if (count($dtlsData) - 1 == $dtldatakey)
                {
                    $listofData[$key]['y' . $year . 'anutot'] = sprintf("%.2f", $anuTotal);
                    $listofData[$key]['grandtot'] = sprintf("%.2f", $grandTotal);
                }
            }
        }
        if ($icvbasehdr == 2)
        {
            $actualData = array();
            foreach ($listofData as $key => $value)
            {
                if (array_key_exists('y1', $value))
                {
                    array_push($actualData, $value);
                }
            }
            if (empty($actualData))
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $finalDummy = array();
                $serviceDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "scat" => "Select Service Category",
                    "ssubcat" => "Select Service Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => "",
                    'y1' => date("Y") ,
                    'y1q' . $currentQuarter => '0'
                );

                array_push($finalDummy, $serviceDummy);
                return ['items' => $finalDummy];
            }
            else
            {
                return ['items' => $actualData];
            }
        }
        if (empty($listofData))
        {
            if ($type == 'Contract' || $type == 'Project')
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $finalDummy = array();
                $serviceDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "scat" => "Select Service Category",
                    "ssubcat" => "Select Service Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => "",
                    'y1' => date("Y") ,
                    'y1q' . $currentQuarter => '0'
                );

                array_push($finalDummy, $serviceDummy);
            }
            else
            {
                $serviceDummy = array();

                $icvstart = Yii::$app->getRequest()->getQueryParam('starty');

                $startY = Yii::$app->getRequest()->getQueryParam('starty');
                $startq = Yii::$app->getRequest()->getQueryParam('startq');
                $endY = Yii::$app->getRequest()->getQueryParam('endy');
                $endQ = Yii::$app->getRequest()->getQueryParam('endq');

                $finalDummy = array();
                $serviceDummy = array(
                    "id" => "null",
                    "protype" => "Select Procurement Type",
                    "scat" => "Select Service Category",
                    "ssubcat" => "Select Service Sub Category",
                    "supcat" => "Select Supplier Category",
                    "summary" => ""
                );
                for ($i = 0;$i < 3;$i++)
                {
                    $years = array();
                    while ($icvstart <= $endY)
                    {
                        array_push($years, $icvstart++);
                    }
                    $forendQuarter = 4;
                    foreach ($years as $key => $value)
                    {
                        //print_r($startY);die();
                        if ($value != $startY)
                        {
                            $startq = 1;
                        }
                        if ($endY == $value)
                        {
                            $forendQuarter = $endQ;
                        }

                        $serviceDummy['y' . ($key + 1) ] = (int)$value;
                        for ($j = $startq;$j <= $forendQuarter;$j++)
                        {
                            $serviceDummy['y' . ($key + 1) . 'q' . ($j) ] = 0;
                        }
                    }
                    array_push($finalDummy, $serviceDummy);
                }
            }
            return ['items' => $finalDummy];
        }
        return ['items' => $listofData];
    }

    public function actionGetworkforcespend()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('id');
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $icvbasehdr = Yii::$app->getRequest()->getQueryParam('icvbasehdr');

        $wfspendData = array();
        $query = IcvplanwfspendhdrTbl::find();
        $query->select("icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk as id,
            (CASE WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 1 THEN  'Contractor' WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 2 THEN  'Sub-Contractor' ELSE '' END)as cont_subcont,
            
            icvplanmetrictypemst_tbl.ipmtm_typename as workforce_cat
            ");
        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanmetrictypemst_fk = icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($icvbasehdr)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $icvbasehdr]);
        }

        $wfspendData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();
        //print_r($wfspendData);die;
        foreach ($wfspendData as $key => $value)
        {
            $query_dtl = IcvplanwfspenddtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipwsd_icvplanwfspendhdr_fk' => $value['id']]);

            $dtlsData = $query_dtl->asArray()->all();

            $wfspendData[$key]['shd'] = $dtlsData[0]['ipwsd_value'];
            $wfspendData[$key]['smhd'] = $dtlsData[1]['ipwsd_value'];
            $wfspendData[$key]['scp'] = $dtlsData[2]['ipwsd_value'];

            $wfspendData[$key]['mhd'] = $dtlsData[3]['ipwsd_value'];
            $wfspendData[$key]['mmhd'] = $dtlsData[4]['ipwsd_value'];
            $wfspendData[$key]['mcp'] = $dtlsData[5]['ipwsd_value'];

            $wfspendData[$key]['jhd'] = $dtlsData[6]['ipwsd_value'];
            $wfspendData[$key]['jmhd'] = $dtlsData[7]['ipwsd_value'];
            $wfspendData[$key]['jcp'] = $dtlsData[8]['ipwsd_value'];

            $wfspendData[$key]['tphd'] = $dtlsData[9]['ipwsd_value'];
            $wfspendData[$key]['tpmhd'] = $dtlsData[10]['ipwsd_value'];
            $wfspendData[$key]['tpcp'] = $dtlsData[11]['ipwsd_value'];

            $wfspendData[$key]['thd'] = $dtlsData[12]['ipwsd_value'];
            $wfspendData[$key]['tmhd'] = $dtlsData[13]['ipwsd_value'];
            $wfspendData[$key]['tcp'] = $dtlsData[14]['ipwsd_value'];

            $wfspendData[$key]['skhd'] = $dtlsData[15]['ipwsd_value'];
            $wfspendData[$key]['skmhd'] = $dtlsData[16]['ipwsd_value'];
            $wfspendData[$key]['skcp'] = $dtlsData[17]['ipwsd_value'];

            $wfspendData[$key]['tot_hd'] = $dtlsData[0]['ipwsd_value'] + $dtlsData[3]['ipwsd_value'] + $dtlsData[6]['ipwsd_value'] + $dtlsData[9]['ipwsd_value'] + $dtlsData[12]['ipwsd_value'] + $dtlsData[15]['ipwsd_value'];
            $wfspendData[$key]['tot_mhd'] = $dtlsData[1]['ipwsd_value'] + $dtlsData[4]['ipwsd_value'] + $dtlsData[7]['ipwsd_value'] + $dtlsData[10]['ipwsd_value'] + $dtlsData[13]['ipwsd_value'] + $dtlsData[16]['ipwsd_value'];

            $wfspendData[$key]['tot_cp'] = $dtlsData[2]['ipwsd_value'] + $dtlsData[5]['ipwsd_value'] + $dtlsData[8]['ipwsd_value'] + $dtlsData[11]['ipwsd_value'] + $dtlsData[14]['ipwsd_value'] + $dtlsData[17]['ipwsd_value'];
        }

        if (empty($wfspendData))
        {
            array_push($wfspendData, ["id" => "null", "cont_subcont" => "Contractor",

            'workforce_cat' => "Omani", 'shd' => 0, 'smhd' => 0, 'scp' => 0,

            'mhd' => 0, 'mmhd' => 0, 'mcp' => 0,

            'jhd' => 0, 'jmhd' => 0, 'jcp' => 0,

            'tphd' => 0, 'tpmhd' => 0, 'tpcp' => 0,

            'thd' => 0, 'tmhd' => 0, 'tcp' => 0,

            'skhd' => 0, 'skmhd' => 0, 'skcp' => 0, ]);

            array_push($wfspendData, ["id" => "null", "cont_subcont" => "-",

            'workforce_cat' => "Expatriates", 'shd' => 0, 'smhd' => 0, 'scp' => 0,

            'mhd' => 0, 'mmhd' => 0, 'mcp' => 0,

            'jhd' => 0, 'jmhd' => 0, 'jcp' => 0,

            'tphd' => 0, 'tpmhd' => 0, 'tpcp' => 0,

            'thd' => 0, 'tmhd' => 0, 'tcp' => 0,

            'skhd' => 0, 'skmhd' => 0, 'skcp' => 0, ]);

            array_push($wfspendData, ["id" => "null", "cont_subcont" => "Sub-Contractor",

            'workforce_cat' => "Omani", 'shd' => 0, 'smhd' => 0, 'scp' => 0,

            'mhd' => 0, 'mmhd' => 0, 'mcp' => 0,

            'jhd' => 0, 'jmhd' => 0, 'jcp' => 0,

            'tphd' => 0, 'tpmhd' => 0, 'tpcp' => 0,

            'thd' => 0, 'tmhd' => 0, 'tcp' => 0,

            'skhd' => 0, 'skmhd' => 0, 'skcp' => 0, ]);

            array_push($wfspendData, ["id" => "null", "cont_subcont" => "-",

            'workforce_cat' => "Expatriates", 'shd' => 0, 'smhd' => 0, 'scp' => 0,

            'mhd' => 0, 'mmhd' => 0, 'mcp' => 0,

            'jhd' => 0, 'jmhd' => 0, 'jcp' => 0,

            'tphd' => 0, 'tpmhd' => 0, 'tpcp' => 0,

            'thd' => 0, 'tmhd' => 0, 'tcp' => 0,

            'skhd' => 0, 'skmhd' => 0, 'skcp' => 0, ]);
        }

        $wfspendData[4]['id'] = 4;
        $wfspendData[4]['cont_subcont'] = "Total";
        $wfspendData[4]['workforce_cat'] = "Omani";
        $wfspendData[4]['shd'] = $wfspendData[0]['shd'] + $wfspendData[2]['shd'];
        $wfspendData[4]['smhd'] = $wfspendData[0]['smhd'] + $wfspendData[2]['smhd'];
        $wfspendData[4]['scp'] = $wfspendData[0]['scp'] * $wfspendData[0]['smhd'] + $wfspendData[2]['scp'] * $wfspendData[2]['smhd'];

        $wfspendData[4]['mhd'] = $wfspendData[0]['mhd'] + $wfspendData[2]['mhd'];
        $wfspendData[4]['mmhd'] = $wfspendData[0]['mmhd'] + $wfspendData[2]['mmhd'];
        $wfspendData[4]['mcp'] = $wfspendData[0]['mcp'] * $wfspendData[0]['mmhd'] + $wfspendData[2]['mcp'] * $wfspendData[2]['mmhd'];

        $wfspendData[4]['jhd'] = $wfspendData[0]['jhd'] + $wfspendData[2]['jhd'];
        $wfspendData[4]['jmhd'] = $wfspendData[0]['jmhd'] + $wfspendData[2]['jmhd'];
        $wfspendData[4]['jcp'] = $wfspendData[0]['jcp'] * $wfspendData[0]['jmhd'] + $wfspendData[2]['jcp'] * $wfspendData[2]['jmhd'];

        $wfspendData[4]['tphd'] = $wfspendData[0]['tphd'] + $wfspendData[2]['tphd'];
        $wfspendData[4]['tpmhd'] = $wfspendData[0]['tpmhd'] + $wfspendData[2]['tpmhd'];
        $wfspendData[4]['tpcp'] = $wfspendData[0]['tpcp'] * $wfspendData[0]['tpmhd'] + $wfspendData[2]['tpcp'] * $wfspendData[2]['tpmhd'];

        $wfspendData[4]['thd'] = $wfspendData[0]['thd'] + $wfspendData[2]['thd'];
        $wfspendData[4]['tmhd'] = $wfspendData[0]['tmhd'] + $wfspendData[2]['tmhd'];
        $wfspendData[4]['tcp'] = $wfspendData[0]['tcp'] * $wfspendData[0]['tmhd'] + $wfspendData[2]['tcp'] * $wfspendData[2]['tmhd'];

        $wfspendData[4]['skhd'] = $wfspendData[0]['skhd'] + $wfspendData[2]['skhd'];
        $wfspendData[4]['skmhd'] = $wfspendData[0]['skmhd'] + $wfspendData[2]['skmhd'];
        $wfspendData[4]['skcp'] = $wfspendData[0]['skcp'] * $wfspendData[0]['skmhd'] + $wfspendData[2]['skcp'] * $wfspendData[2]['skmhd'];

        $wfspendData[4]['tot_hd'] = $wfspendData[4]['shd'] + $wfspendData[4]['mhd'] + $wfspendData[4]['jhd'] + $wfspendData[4]['tphd'] + $wfspendData[4]['thd'] + $wfspendData[4]['skhd'];

        $wfspendData[4]['tot_mhd'] = $wfspendData[4]['smhd'] + $wfspendData[4]['mmhd'] + $wfspendData[4]['jmhd'] + $wfspendData[4]['tpmhd'] + $wfspendData[4]['tmhd'] + $wfspendData[4]['skmhd'];

        $wfspendData[4]['tot_cp'] = $wfspendData[4]['scp'] + $wfspendData[4]['mcp'] + $wfspendData[4]['jcp'] + $wfspendData[4]['tpcp'] + $wfspendData[4]['tcp'] + $wfspendData[4]['skcp'];

        $wfspendData[5]['id'] = 5;
        $wfspendData[5]['cont_subcont'] = "";
        $wfspendData[5]['workforce_cat'] = "Expatriates";
        $wfspendData[5]['shd'] = $wfspendData[1]['shd'] + $wfspendData[3]['shd'];
        $wfspendData[5]['smhd'] = $wfspendData[1]['smhd'] + $wfspendData[3]['smhd'];
        $wfspendData[5]['scp'] = $wfspendData[1]['scp'] * $wfspendData[1]['smhd'] + $wfspendData[3]['scp'] * $wfspendData[3]['smhd'];

        $wfspendData[5]['mhd'] = $wfspendData[1]['mhd'] + $wfspendData[3]['mhd'];
        $wfspendData[5]['mmhd'] = $wfspendData[1]['mmhd'] + $wfspendData[3]['mmhd'];
        $wfspendData[5]['mcp'] = $wfspendData[1]['mcp'] * $wfspendData[1]['mmhd'] + $wfspendData[3]['mcp'] * $wfspendData[3]['mmhd'];

        $wfspendData[5]['jhd'] = $wfspendData[1]['jhd'] + $wfspendData[3]['jhd'];
        $wfspendData[5]['jmhd'] = $wfspendData[1]['jmhd'] + $wfspendData[3]['jmhd'];
        $wfspendData[5]['jcp'] = $wfspendData[1]['jcp'] * $wfspendData[1]['jmhd'] + $wfspendData[3]['jcp'] * $wfspendData[3]['jmhd'];

        $wfspendData[5]['tphd'] = $wfspendData[1]['tphd'] + $wfspendData[3]['tphd'];
        $wfspendData[5]['tpmhd'] = $wfspendData[1]['tpmhd'] + $wfspendData[3]['tpmhd'];
        $wfspendData[5]['tpcp'] = $wfspendData[1]['tpcp'] * $wfspendData[1]['tpmhd'] + $wfspendData[3]['tpcp'] * $wfspendData[3]['tpmhd'];

        $wfspendData[5]['thd'] = $wfspendData[1]['thd'] + $wfspendData[3]['thd'];
        $wfspendData[5]['tmhd'] = $wfspendData[1]['tmhd'] + $wfspendData[3]['tmhd'];
        $wfspendData[5]['tcp'] = $wfspendData[1]['tcp'] * $wfspendData[1]['tmhd'] + $wfspendData[3]['tcp'] * $wfspendData[3]['tmhd'];

        $wfspendData[5]['skhd'] = $wfspendData[1]['skhd'] + $wfspendData[3]['skhd'];
        $wfspendData[5]['skmhd'] = $wfspendData[1]['skmhd'] + $wfspendData[3]['skmhd'];
        $wfspendData[5]['skcp'] = $wfspendData[1]['skcp'] * $wfspendData[1]['skmhd'] + $wfspendData[3]['skcp'] * $wfspendData[3]['skmhd'];

        $wfspendData[5]['tot_hd'] = $wfspendData[5]['shd'] + $wfspendData[5]['mhd'] + $wfspendData[5]['jhd'] + $wfspendData[5]['tphd'] + $wfspendData[5]['thd'] + $wfspendData[5]['skhd'];

        $wfspendData[5]['tot_mhd'] = $wfspendData[5]['smhd'] + $wfspendData[5]['mmhd'] + $wfspendData[5]['jmhd'] + $wfspendData[5]['tpmhd'] + $wfspendData[5]['tmhd'] + $wfspendData[5]['skmhd'];

        $wfspendData[5]['tot_cp'] = $wfspendData[5]['scp'] + $wfspendData[5]['mcp'] + $wfspendData[5]['jcp'] + $wfspendData[5]['tpcp'] + $wfspendData[5]['tcp'] + $wfspendData[5]['skcp'];

        return ['items' => $wfspendData];
    }

    public function actionGetworkforcehead()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('id');
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $icvbasehdr = Yii::$app->getRequest()->getQueryParam('icvbasehdr');

        $query = IcvplanwfheadcounthdrTbl::find();

        $query->select("icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk as id,
                        icvplanmetrictypemst_tbl.ipmtm_typename as c_hp");

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanmetrictypemst_fk = icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($icvbasehdr)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $icvbasehdr]);
        }

        $wfheadData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();
        $i = 0;
        $current_year = 0;
        $sumOfYear = 0;

        foreach ($wfheadData as $key => $value)
        {
            $query_dtl = IcvplanwfheadcountdtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipwhcd_icvplanwfheadcounthdr_fk' => $value['id']]);

            if ($icvbasehdr == 2)
            {
                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $query_dtl->andWhere(['icvplanwfheadcountdtl_tbl.ipwhcd_year' => date("Y") , 'icvplanwfheadcountdtl_tbl.ipwhcd_quarter' => $currentQuarter, ]);
            }

            $dtlsData = $query_dtl->asArray()->all();

            $wfheadData[$key]['year_hp'] = $dtlsData[0]['ipwhcd_year'];
            $wfheadData[$key]['q_hp'] = 'Q' . $dtlsData[0]['ipwhcd_quarter'];

            $wfheadData[$key]['sm_nat'] = $dtlsData[0]['ipwhcd_value'];
            $wfheadData[$key]['sm_ex'] = $dtlsData[1]['ipwhcd_value'];
            $wfheadData[$key]['mm_nat'] = $dtlsData[2]['ipwhcd_value'];
            $wfheadData[$key]['mm_ex'] = $dtlsData[3]['ipwhcd_value'];
            $wfheadData[$key]['jm_nat'] = $dtlsData[4]['ipwhcd_value'];
            $wfheadData[$key]['jm_ex'] = $dtlsData[5]['ipwhcd_value'];
            $wfheadData[$key]['tp_nat'] = $dtlsData[6]['ipwhcd_value'];
            $wfheadData[$key]['tp_ex'] = $dtlsData[7]['ipwhcd_value'];
            $wfheadData[$key]['t_nat'] = $dtlsData[8]['ipwhcd_value'];
            $wfheadData[$key]['t_ex'] = $dtlsData[9]['ipwhcd_value'];
            $wfheadData[$key]['sk_nat'] = $dtlsData[10]['ipwhcd_value'];
            $wfheadData[$key]['sk_ex'] = $dtlsData[11]['ipwhcd_value'];
        }

        $i = 0;
        $sumOfYear = 0;
        $sumKey = 0;

        $sm_nat = 0;
        $sm_ex = 0;
        $mm_nat = 0;
        $mm_ex = 0;
        $jm_nat = 0;
        $jm_ex = 0;
        $tp_nat = 0;
        $tp_ex = 0;
        $t_nat = 0;
        $t_ex = 0;
        $sk_nat = 0;
        $sk_ex = 0;
        $year = 0;

        $m = 1;

        foreach ($wfheadData as $key => $value)
        {
            if ($value['year_hp'] != '' && $value['year_hp'] != null)
            {

                if ($i == 0)
                {
                    $current_year = $value['year_hp'];
                    $current_quarter = $value['q_hp'];
                    $i += 1;
                }

                if ($current_quarter == $value['q_hp'])
                {
                    $sm_nat += $value['sm_nat'];
                    $sm_ex += $value['sm_ex'];
                    $mm_nat += $value['mm_nat'];
                    $mm_ex += $value['mm_ex'];
                    $jm_nat += $value['jm_nat'];
                    $jm_ex += $value['jm_ex'];
                    $tp_nat += $value['tp_nat'];
                    $tp_ex += $value['tp_ex'];
                    $t_nat += $value['t_nat'];
                    $t_ex += $value['t_ex'];
                    $sk_nat += $value['sk_nat'];
                    $sk_ex += $value['sk_ex'];

                    $year = $value['year_hp'];
                    $current_quarter = $value['q_hp'];
                }
                else
                {
                    $data = array(
                        'id' => 'null',
                        'year_hp' => $year,
                        'c_hp' => "Total",
                        'sm_nat' => $sm_nat,
                        'sm_ex' => $sm_ex,
                        'mm_nat' => $mm_nat,
                        'mm_ex' => $mm_ex,
                        'jm_nat' => $jm_nat,
                        'jm_ex' => $jm_ex,
                        'tp_nat' => $tp_nat,
                        'tp_ex' => $tp_ex,
                        't_nat' => $t_nat,
                        't_ex' => $t_ex,
                        'sk_nat' => $sk_nat,
                        'sk_ex' => $sk_ex,
                    );

                    $spliceKey = (4 * $m) - 1;

                    array_splice($wfheadData, $spliceKey, 0, array(
                        $data
                    ));

                    $sm_nat = $value['sm_nat'];
                    $sm_ex = $value['sm_ex'];
                    $mm_nat = $value['mm_nat'];
                    $mm_ex = $value['mm_ex'];
                    $jm_nat = $value['jm_nat'];
                    $jm_ex = $value['jm_ex'];
                    $tp_nat = $value['tp_nat'];
                    $tp_ex = $value['tp_ex'];
                    $t_nat = $value['t_nat'];
                    $t_ex = $value['t_ex'];
                    $sk_nat = $value['sk_nat'];
                    $sk_ex = $value['sk_ex'];

                    $current_quarter = $next_quarter;

                    $i = 0;
                    $m += 1;
                }
            }
            else
            {

                $wfheadFinalDummy = array();

                if ($type == 'Contract' || $type == 'Project')
                {

                    $curMonth = date("m", time());
                    $curQuarter = ceil($curMonth / 3);

                    array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Existing Employees", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                    array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "New Recruit.", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                    array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Redeployment", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                    array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Total", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                }
                return ['items' => $wfheadFinalDummy];
            }

        }

        if (empty($wfheadData))
        {
            $wfheadFinalDummy = array();

            if ($type == 'Contract' || $type == 'Project')
            {

                $curMonth = date("m", time());
                $curQuarter = ceil($curMonth / 3);

                array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Existing Employees", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "New Recruit.", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Redeployment", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

                array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'c_hp' => "Total", 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);

            }
            else
            {

                $icvstart = Yii::$app->getRequest()->getQueryParam('starty');

                $startY = Yii::$app->getRequest()->getQueryParam('starty');
                $startq = Yii::$app->getRequest()->getQueryParam('startq');
                $endY = Yii::$app->getRequest()->getQueryParam('endy');
                $endQ = Yii::$app->getRequest()->getQueryParam('endq');

                $years = array();
                $wfheadcategory = ['Existing Employees', 'New Recruit.', 'Redeployment', 'Total'];
                while ($icvstart <= $endY)
                {
                    array_push($years, $icvstart++);
                }
                //print_r($wfheadcategory);die();
                $forendQuarter = 4;
                foreach ($years as $key => $value)
                {
                    //print_r($startY);die();
                    if ($value != $startY)
                    {
                        $startq = 1;
                    }
                    if ($endY == $value)
                    {
                        $forendQuarter = $endQ;
                    }
                    for ($j = $startq;$j <= $forendQuarter;$j++)
                    {

                        foreach ($wfheadcategory as $catkey => $catvalue)
                        {
                            array_push($wfheadFinalDummy, ['id' => 'null', 'year_hp' => $value, 'q_hp' => 'Q' . $j, 'c_hp' => $catvalue, 'sm_nat' => 0, 'sm_ex' => 0, 'mm_nat' => 0, 'mm_ex' => 0, 'jm_nat' => 0, 'jm_ex' => 0, 'tp_nat' => 0, 'tp_ex' => 0, 't_nat' => 0, 't_ex' => 0, 'sk_nat' => 0, 'sk_ex' => 0]);
                        }

                    }
                }
            }
            return ['items' => $wfheadFinalDummy];
        }

        $wfheadFinal = array(
            'year_hp' => $year,
            'q_hp' => '',
            'c_hp' => "Total",
            'sm_nat' => $sm_nat,
            'sm_ex' => $sm_ex,
            'mm_nat' => $mm_nat,
            'mm_ex' => $mm_ex,
            'jm_nat' => $jm_nat,
            'jm_ex' => $jm_ex,
            'tp_nat' => $tp_nat,
            'tp_ex' => $tp_ex,
            't_nat' => $t_nat,
            't_ex' => $t_ex,
            'sk_nat' => $sk_nat,
            'sk_ex' => $sk_ex,
        );

        array_push($wfheadData, $wfheadFinal);

        return ['items' => $wfheadData];
    }

    public function actionGetinvestement()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('id');
        $type = Yii::$app->getRequest()->getQueryParam('type');
        $icvbasehdr = Yii::$app->getRequest()->getQueryParam('icvbasehdr');

        $query = IcvplaninvestdtlTbl::find();
        $query->select("icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk as id,
                        icvplaninvestdtl_tbl.ipid_year as year_hp,
                        icvplaninvestdtl_tbl.ipid_value as a,
                        CONCAT('Q', `icvplaninvestdtl_tbl`.`ipid_quarter`) as q_hp,
                        a.ipih_summary as s,
                        icvplanmetrictypemst_tbl.ipmtm_typename as it,          
                        (CASE WHEN `a`.`ipih_category` = 1 THEN 'Manufacturing Facility' WHEN `a`.`ipih_category` = 2 THEN 'Ware House' ELSE 'Repair Facility' END) as ic
                        ");

        $query->leftJoin('icvplaninvesthdr_tbl a', 'icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk = a.icvplaninvesthdr_pk');

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = a.ipih_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = a.ipih_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($icvbasehdr)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $icvbasehdr]);
        }

        $query->asArray();

        $provider = new ActiveDataProvider(['query' => $query]);

        $invFinal = $provider->getModels();

        if (empty($invFinal))
        {
            $invFinalDummy = array();

            if ($type == 'Project')
            {

                array_push($invFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q2", 'ic' => "WareHouse", 'it' => "Existing Investment", 's' => "", 'a' => 0]);

                return ['items' => $invFinalDummy];

            }
            elseif ($type == 'Contract' || $type == 'Project')
            {
                $curMonth = date("m", time());
                $curQuarter = ceil($curMonth / 3);

                array_push($invFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q" . $curQuarter, 'ic' => "Ware House", 'it' => "Existing Investment", 's' => "", 'a' => 0]);

                return ['items' => $invFinalDummy];
            }
            elseif ($type == 'RFX')
            {
                array_push($invFinalDummy, ['id' => 'null', 'year_hp' => date("Y") , 'q_hp' => "Q1", 'ic' => "Existing Investment", 'it' => "Ware House", 's' => "", 'a' => 0]);

                return ['items' => $invFinalDummy];
            }

            array_push($invFinalDummy, ['id' => 'null', 'year_hp' => 'Enter Year', 'q_hp' => "Select Quarter", 'ic' => "Select Investment Category", 'it' => "Select Investment Type", 's' => "", 'a' => 0]);

            array_push($invFinalDummy, ['id' => 'null', 'year_hp' => 'Enter Year', 'q_hp' => "Select Quarter", 'ic' => "Select Investment Category", 'it' => "Select Investment Type", 's' => "", 'a' => 0]);

            array_push($invFinalDummy, ['id' => 'null', 'year_hp' => 'Enter Year', 'q_hp' => "Select Quarter", 'ic' => "Select Investment Category", 'it' => "Select Investment Type", 's' => "", 'a' => 0]);

            return ['items' => $invFinalDummy];
        }
        else
        {

            if ($type == 'Contract' || $type == 'Project')
            {
                $invContractFinal = array();
                $currentyear = date("Y");

                $curMonth = date("m", time());
                $curQuarter = ceil($curMonth / 3);

                foreach ($invFinal as $key => $value)
                {
                    if ($value['year_hp'] == $currentyear && $value['q_hp'] == 'Q' . $curQuarter)
                    {
                        array_push($invContractFinal, $value);
                    }
                }
                if (empty($invContractFinal))
                {

                    return ['items' => ['id' => 'null', 'year_hp' => 'Enter Year', 'q_hp' => "Select Quarter", 'ic' => "Select Investment Category", 'it' => "Select Investment Type", 's' => "", 'a' => 0]]; //die();
                    
                }
                else
                {
                    return ['items' => $invContractFinal]; //die();
                    
                }
            }
            return ['items' => $invFinal];
        }
    }

    // public function actionGetprotypes()
    // {
    //     $query = IcvplanmetrictypemstTbl::find();
    //     $query->select("icvplanmetrictypemst_pk as id, ipmtm_typename as name");
    //     $query->andWhere('ipmtm_icvplanmetricmst_fk=:planmetricmst', array(
    //         ':planmetricmst' => 1
    //     ));
    //     $query->asArray();
    //     $page = (!empty($size)) ? $size : 10;
    //     $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page, 'page' => $pageIndex]]);
    //     // print_r($query->createCommand()->getRawSql());die();
    //     return ['items' => $provider->getModels() , 'total_count' => $provider->getTotalCount() , 'limit' => $page, 'page' => $pageIndex
    //     ];
    // }
    public function actionUpdatedata()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

    }

    public function actionDeletegood()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if (isset($data))
        {
            foreach ($data as $key => $value)
            {
                $icvdtldelete = IcvplangoodsdtlTbl::deleteAll(['ipgd_icvplangoodshdr_fk' => $value]);
                IcvplangoodshdrTbl::deleteAll(['icvplangoodshdr_pk' => $value]);
            }

            if ($icvdtldelete)
            {
                $result = array(
                    'status' => true,
                    'msg' => 'Deleted successfully!',
                );
            }
            else
            {
                $result = array(
                    'status' => false,
                    'msg' => 'No Data Deleted!',
                );
            }
            return $result;
        }
    }

    public function actionDeleteservice()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        if (isset($data))
        {
            foreach ($data as $key => $value)
            {
                $icvdtldelete = IcvplanservicedtlTbl::deleteAll(['ipsd_icvplanservicehdr_fk' => $value]);
                IcvplanservicehdrTbl::deleteAll(['icvplanservicehdr_pk' => $value]);
            }

            if ($icvdtldelete)
            {
                $result = array(
                    'status' => true,
                    'msg' => 'Deleted successfully!',
                );
            }
            else
            {
                $result = array(
                    'status' => false,
                    'msg' => 'No Data Deleted!',
                );
            }
            return $result;
        }
    }

    //Delete Investment
    public function actionDeleteinvestment()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        if (isset($data))
        {
            foreach ($data as $key => $value)
            {
                $icvdtldelete = IcvplaninvestdtlTbl::deleteAll(['ipid_icvplaninvesthdr_fk' => $value]);
                IcvplaninvesthdrTbl::deleteAll(['icvplaninvesthdr_pk' => $value]);
            }
            if ($icvdtldelete)
            {
                $result = array(
                    'status' => true,
                    'msg' => 'Deleted successfully!',
                );
            }
            else
            {
                $result = array(
                    'status' => false,
                    'msg' => 'No Data Deleted!',
                );
            }
            return $result;
        }
    }

    public function spendHistoryICV($lastInsertedId)
    {

        if (isset($lastInsertedId))
        {

            $month = date("n");
            $currentQuarter = ceil($month / 3);

            $count = IcvplanspendTbl::find()->where(['icvps_icvplanbasehdr_fk' => $lastInsertedId, 'icvps_year' => date('Y') , 'icvps_quarter' => $currentQuarter])->count();
            if ($count >= 1)
            {
                $countResult = IcvplanspendTbl::find()->where(['icvps_icvplanbasehdr_fk' => $lastInsertedId, 'icvps_year' => date('Y') , 'icvps_quarter' => $currentQuarter])->one();
                $lastInsertedId = $countResult->icvplanspend_pk;
            }
            else
            {
                $icvplanSpend = new IcvplanspendTbl();
                $icvplanSpend->icvps_icvplanbasehdr_fk = $lastInsertedId;
                $icvplanSpend->icvps_year = date('Y');
                $icvplanSpend->icvps_quarter = $currentQuarter;
                $icvplanSpend->icvps_submittedon = date('Y-m-d H:i:s');
                $icvplanSpend->icvps_status = 2;
                $icvplanSpend->icvps_createdon = date('Y-m-d H:i:s');
                $icvplanSpend->icvps_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                $icvplanSpend->icvps_createdbyipaddr = $ip_address;
                $icvplanSpend->save();
                $insertedId = $icvplanSpend->icvplanspend_pk;
                if (isset($insertedId))
                {
                    $icvspendHstry = new IcvplanspendhstryTbl();
                    $icvspendHstry->icvpsh_icvplanspend_fk = $insertedId;
                    $icvspendHstry->icvpsh_icvplanbasehdr_fk = $lastInsertedId;
                    $icvspendHstry->icvpsh_year = date('Y');
                    $icvspendHstry->icvpsh_quarter = $currentQuarter;
                    $icvspendHstry->icvpsh_submittedon = date('Y-m-d H:i:s');
                    $icvspendHstry->icvpsh_status = 2;
                    $icvspendHstry->icvpsh_createdon = date('Y-m-d H:i:s');
                    $icvspendHstry->icvpsh_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                    $icvspendHstry->icvpsh_createdbyipaddr = $ip_address;
                    $icvspendHstry->icvpsh_histcreatedon = date('Y-m-d H:i:s');
                    $icvspendHstry->save();
                }
            }
        }
    }

    public function actionSavgoodspend()
    {
        $request_body = file_get_contents('php://input');
        $dataI = json_decode($request_body, true);

        $datas = $dataI['data'];
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $quotationpk = $dataI['quotationid'];
        $type = $dataI['type'];

        $startyear = $dataI['startyear'];
        $startquarter = $dataI['startquarter'];
        $endyear = $dataI['endyear'];
        $endquarter = $dataI['endquarter'];

        $start = $startyear;
        $year = array();

        while ($start <= $endyear)
        {
            array_push($year, $start++);
        }

        $ipbh_type = $dataI['icvbasehdr'];
        $ip_address = \common\components\Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        if (isset($companypk) && isset($quotationpk) && isset($type))
        {
            $insertData = new IcvplanbasehdrTbl();
            $insertData->ipbh_memcompmst_fk = $companypk;
            $insertData->ipbh_cmsquotationhdr_fk = $quotationpk;
            $insertData->ipbh_icvplanmetricmst_fk = $type;
            $insertData->ipbh_type = $ipbh_type;
            $insertData->ipbh_createdon = $date;
            $insertData->ipbh_createdby = $userPK;
            $insertData->ipbh_createdbyipaddr = $ip_address;
            $insertData->ipbh_updatedon = '';

            $count = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 1, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->count();

            if ($count >= 1)
            {
                $countResult = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 1, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->one();
                $lastInsertedId = $countResult->icvplanbasehdr_pk;

            }
            else
            {
                $insetredSuccess = $insertData->save();
                $lastInsertedId = $insertData->icvplanbasehdr_pk;
            }
            //print_r($datas);die();
            if (isset($lastInsertedId))
            {
                $updateCount = 0;
                foreach ($datas as $key => $data)
                {
                    if ($data['id'] == "null")
                    {
                        $goodsHdrData = new IcvplangoodshdrTbl();
                        $goodsHdrData->ipgh_icvplanbasehdr_fk = $lastInsertedId;

                        $gprotypemaster = Yii::$app->db->createCommand("SELECT * FROM icvplanmetrictypemst_tbl WHERE `ipmtm_icvplanmetricmst_fk` = 1 AND `ipmtm_typename` = " . "'" . $data['protype'] . "'")->queryOne();

                        $goodsHdrData->ipgh_icvplanmetrictypemst_fk = $gprotypemaster['icvplanmetrictypemst_pk'];

                        $gsubcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplangoodssubcatmst_tbl WHERE `ipgscm_name` = " . "'" . $data['gsubcat'] . "'")->queryOne();

                        $goodsHdrData->ipgh_icvplangoodssubcatmst_fk = $gsubcatmaster['icvplangoodssubcatmst_pk'];

                        $supcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplansuppcatmst_tbl WHERE `ipspcm_name` = " . "'" . $data['supcat'] . "'")->queryOne();

                        $goodsHdrData->ipgh_icvplansuppcatmst_fk = $supcatmaster['icvplansuppcatmst_pk'];

                        $goodsHdrData->ipgh_summary = $data['summary'];
                        $goodsHdrData->ipgh_createdon = $date;
                        $goodsHdrData->ipgh_createdby = $userPK;
                        $goodsHdrData->ipgh_createdbyipaddr = $ip_address;

                        $goodsHdrData->save();

                        $lastgoodsHdrInsertedId = $goodsHdrData->icvplangoodshdr_pk;

                        if (isset($lastgoodsHdrInsertedId))
                        {
                            $forendQuarter = 4;
                            $startquarter = $dataI['startquarter'];

                            for ($yearIndex = 0;$yearIndex < count($year);$yearIndex++)
                            {
                                if ($ipbh_type == 2)
                                {
                                    $month = date("n");
                                    $startquarter = ceil($month / 3);
                                    $forendQuarter = ceil($month / 3);

                                }
                                else
                                {
                                    if ($year[$yearIndex] != $startyear)
                                    {
                                        $startquarter = 1;
                                    }
                                }

                                if ($endyear == $year[$yearIndex])
                                {
                                    $forendQuarter = $endquarter;
                                }

                                for ($i = $startquarter;$i <= $forendQuarter;$i++)
                                {
                                    $goodsDtlsData = new IcvplangoodsdtlTbl();
                                    $goodsDtlsData->ipgd_icvplangoodshdr_fk = $lastgoodsHdrInsertedId;
                                    $goodsDtlsData->ipgd_year = $data['y' . ($yearIndex + 1) ];
                                    $goodsDtlsData->ipgd_quarter = $i;
                                    if (isset($data['y' . ($yearIndex + 1) . 'q' . $i]))
                                    {
                                        $goodsDtlsData->ipgd_value = 0;
                                    }
                                    else
                                    {
                                        $goodsDtlsData->ipgd_value = $data['y' . ($yearIndex + 1) . 'q' . $i];
                                    }
                                    $goodsDtlsData->ipgd_value = $data['y' . ($yearIndex + 1) . 'q' . $i];
                                    $goodsDtlsData->ipgd_createdon = $date;
                                    $goodsDtlsData->ipgd_createdby = $userPK;
                                    $goodsDtlsData->ipgd_createdbyipaddr = $ip_address;
                                    $goodsDtlsData->save();
                                }
                            }
                        }
                    }
                    else
                    {
                        if ($updateCount == 0)
                        {

                            $connection = Yii::$app->db;
                            $connection->createCommand()->update('icvplanbasehdr_tbl', ['ipbh_updatedon' => $date], ['ipbh_cmsquotationhdr_fk' => $quotationpk])->execute();
                            $updateCount = 1;
                        }

                        $icvhdrupdate = IcvplangoodshdrTbl::findOne($data['id']);
                        $gprotypemaster = Yii::$app->db->createCommand("SELECT * FROM icvplanmetrictypemst_tbl WHERE `ipmtm_icvplanmetricmst_fk` =1 AND `ipmtm_typename` = " . "'" . $data['protype'] . "'")->queryOne();

                        $icvhdrupdate->ipgh_icvplanmetrictypemst_fk = $gprotypemaster['icvplanmetrictypemst_pk'];

                        $gsubcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplangoodssubcatmst_tbl WHERE `ipgscm_name` = " . "'" . $data['gsubcat'] . "'")->queryOne();

                        $icvhdrupdate->ipgh_icvplangoodssubcatmst_fk = $gsubcatmaster['icvplangoodssubcatmst_pk'];

                        $supcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplansuppcatmst_tbl WHERE `ipspcm_name` = " . "'" . $data['supcat'] . "'")->queryOne();

                        $icvhdrupdate->ipgh_icvplansuppcatmst_fk = $supcatmaster['icvplansuppcatmst_pk'];

                        $icvhdrupdate->ipgh_summary = $data['summary'];

                        $icvhdrupdate->ipgh_updatedon = $date;
                        $icvhdrupdate->ipgh_updatedby = $userPK;
                        $icvhdrupdate->ipgh_updatedbyipaddr = $ip_address;

                        $icvhdrupdate->update();

                        $forendQuarter = 4;
                        $startquarter = $dataI['startquarter'];

                        for ($i = 0;$i < count($year);$i++)
                        {
                            //$icvdtlupdate = IcvplangoodsdtlTbl::find($data['y'.$i]);
                            if ($ipbh_type == 2)
                            {
                                $month = date("n");
                                $startquarter = ceil($month / 3);
                                $forendQuarter = ceil($month / 3);

                            }
                            else
                            {
                                if ($year[$yearIndex] != $startyear)
                                {
                                    $startquarter = 1;
                                }
                            }

                            if ($endyear == $year[$i])
                            {
                                $forendQuarter = $endquarter;
                            }
                            for ($j = $startquarter;$j <= $forendQuarter;$j++)
                            {
                                $connection = Yii::$app->db;
                                $connection->createCommand()->update('icvplangoodsdtl_tbl', ['ipgd_value' => $data['y' . ($i + 1) . 'q' . $j]], ['ipgd_year' => $data['y' . ($i + 1) ], 'ipgd_quarter' => $j, 'ipgd_icvplangoodshdr_fk' => $data['id']])->execute();
                            }
                        }
                    }
                }

                // Spend History Submit ICV Insertion
                if ($ipbh_type == 2)
                {
                    $this->spendHistoryICV($lastInsertedId);
                }
            }
        }
    }

    public function actionSaveservicespend()
    {
        //print_r("actionSaveservicespend");die();
        $request_body = file_get_contents('php://input');
        $dataI = json_decode($request_body, true);

        $datas = $dataI['data'];

        //print_r($datas);die();
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $quotationpk = $dataI['quotationid'];
        $type = $dataI['type'];

        $startyear = $dataI['startyear'];
        $startquarter = $dataI['startquarter'];
        $endyear = $dataI['endyear'];
        $endquarter = $dataI['endquarter'];

        $start = $startyear;
        $year = array();
        while ($start <= $endyear)
        {

            array_push($year, $start++);
        }

        $ipbh_type = $dataI['icvbasehdr'];

        $ip_address = \common\components\Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        if (isset($companypk) && isset($quotationpk) && isset($type))
        {
            $insertData = new IcvplanbasehdrTbl();

            $insertData->ipbh_memcompmst_fk = $companypk;
            $insertData->ipbh_cmsquotationhdr_fk = $quotationpk;
            $insertData->ipbh_icvplanmetricmst_fk = $type;
            $insertData->ipbh_type = $ipbh_type;
            $insertData->ipbh_createdon = $date;
            $insertData->ipbh_createdby = $userPK;
            $insertData->ipbh_createdbyipaddr = $ip_address;

            $count = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 2, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->count();
            if ($count >= 1)
            {
                $countResult = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 2, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->one();
                $lastInsertedId = $countResult->icvplanbasehdr_pk;
            }
            else
            {
                $insetredSuccess = $insertData->save();
                $lastInsertedId = $insertData->icvplanbasehdr_pk;
            }

            if (isset($lastInsertedId))
            {
                $updateCount = 0;
                foreach ($datas as $key => $data)
                {
                    if ($data['id'] == "null")
                    {
                        //print_r($data);
                        $serviceHdrData = new IcvplanservicehdrTbl();
                        $serviceHdrData->ipsh_icvplanbasehdr_fk = $lastInsertedId;

                        $sprotypemaster = Yii::$app->db->createCommand("SELECT * FROM icvplanmetrictypemst_tbl WHERE `ipmtm_icvplanmetricmst_fk` =2 AND `ipmtm_typename` = " . "'" . $data['protype'] . "'")->queryOne();

                        $serviceHdrData->ipsh_icvplanmetrictypemst_fk = $sprotypemaster['icvplanmetrictypemst_pk'];

                        $ssubcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplanservicesubcatmst_tbl WHERE `ipsscm_name` = " . "'" . $data['ssubcat'] . "'")->queryOne();

                        $serviceHdrData->ipsh_icvplanservicesubcatmst_fk = $ssubcatmaster['icvplanservicesubcatmst_pk'];

                        $supcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplansuppcatmst_tbl WHERE `ipspcm_name` = " . "'" . $data['supcat'] . "'")->queryOne();

                        $serviceHdrData->ipsh_icvplansuppcatmst_fk = $supcatmaster['icvplansuppcatmst_pk'];

                        $serviceHdrData->ipsh_summary = $data['summary'];
                        $serviceHdrData->ipsh_createdon = $date;
                        $serviceHdrData->ipsh_createdby = $userPK;
                        $serviceHdrData->ipsh_createdbyipaddr = $ip_address;

                        $serviceHdrData->save();

                        $lastserviceHdrInsertedId = $serviceHdrData->icvplanservicehdr_pk;
                        if (isset($lastserviceHdrInsertedId))
                        {
                            $forendQuarter = 4;
                            $startquarter = $dataI['startquarter'];

                            for ($yearIndex = 0;$yearIndex < count($year);$yearIndex++)
                            {
                                if ($ipbh_type == 2)
                                {
                                    $month = date("n");
                                    $startquarter = ceil($month / 3);
                                    $forendQuarter = ceil($month / 3);
                                }
                                else
                                {
                                    if ($year[$yearIndex] != $startyear)
                                    {
                                        $startquarter = 1;
                                    }
                                }
                                if ($endyear == $year[$yearIndex])
                                {
                                    $forendQuarter = $endquarter;
                                }

                                for ($i = $startquarter;$i <= $forendQuarter;$i++)
                                {
                                    $serviceDtlsData = new IcvplanservicedtlTbl();
                                    $serviceDtlsData->ipsd_icvplanservicehdr_fk = $lastserviceHdrInsertedId;
                                    $serviceDtlsData->ipsd_year = $data['y' . ($yearIndex + 1) ];
                                    $serviceDtlsData->ipsd_quarter = $i;
                                    $serviceDtlsData->ipsd_value = $data['y' . ($yearIndex + 1) . 'q' . $i];
                                    $serviceDtlsData->ipsd_createdon = $date;
                                    $serviceDtlsData->ipsd_createdby = $userPK;
                                    $serviceDtlsData->ipsd_createdbyipaddr = $ip_address;
                                    $serviceDtlsData->save();
                                }
                            }
                        }
                    }
                    else
                    {
                        if ($updateCount == 0)
                        {

                            $connection = Yii::$app->db;
                            $connection->createCommand()->update('icvplanbasehdr_tbl', ['ipbh_updatedon' => $date], ['ipbh_cmsquotationhdr_fk' => $quotationpk])->execute();
                            $updateCount = 1;
                        }

                        $icvservicehdrupdate = IcvplanservicehdrTbl::findOne($data['id']);

                        $sprotypemaster = Yii::$app->db->createCommand("SELECT * FROM icvplanmetrictypemst_tbl WHERE `ipmtm_icvplanmetricmst_fk` =2 AND `ipmtm_typename` = " . "'" . $data['protype'] . "'")->queryOne();

                        $icvservicehdrupdate->ipsh_icvplanmetrictypemst_fk = $sprotypemaster['icvplanmetrictypemst_pk'];

                        $ssubcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplanservicesubcatmst_tbl WHERE `ipsscm_name` = " . "'" . $data['ssubcat'] . "'")->queryOne();

                        $icvservicehdrupdate->ipsh_icvplanservicesubcatmst_fk = $ssubcatmaster['icvplanservicesubcatmst_pk'];

                        $supcatmaster = Yii::$app->db->createCommand("SELECT * FROM icvplansuppcatmst_tbl WHERE `ipspcm_name` = " . "'" . $data['supcat'] . "'")->queryOne();

                        $icvservicehdrupdate->ipsh_icvplansuppcatmst_fk = $supcatmaster['icvplansuppcatmst_pk'];

                        // $icvservicehdrupdate->ipsh_icvplanmetrictypemst_fk = $data['protype'];
                        // $icvservicehdrupdate->ipsh_icvplanservicesubcatmst_fk = $data['gsubcat'];
                        //$icvservicehdrupdate->ipsh_icvplansuppcatmst_fk = $data['supcat'];
                        $icvservicehdrupdate->ipsh_summary = $data['summary'];

                        $icvservicehdrupdate->ipsh_updatedon = $date;
                        $icvservicehdrupdate->ipsh_updatedby = $userPK;
                        $icvservicehdrupdate->ipsh_updatedbyipaddr = $ip_address;

                        $icvservicehdrupdate->update();

                        $forendQuarter = 4;
                        $startquarter = $dataI['startquarter'];

                        for ($i = 0;$i < count($year);$i++)
                        {
                            if ($ipbh_type == 2)
                            {
                                $month = date("n");
                                $startquarter = ceil($month / 3);
                                $forendQuarter = ceil($month / 3);
                            }
                            else
                            {
                                if ($year[$yearIndex] != $startyear)
                                {
                                    $startquarter = 1;
                                }
                            }
                            if ($endyear == $year[$i])
                            {
                                $forendQuarter = $endquarter;
                            }

                            for ($j = $startquarter;$j <= $forendQuarter;$j++)
                            {
                                $connection = Yii::$app->db;
                                $connection->createCommand()->update('icvplanservicedtl_tbl', ['ipsd_value' => $data['y' . ($i + 1) . 'q' . $j]], ['ipsd_year' => $data['y' . ($i + 1) ], 'ipsd_quarter' => $j, 'ipsd_icvplanservicehdr_fk' => $data['id']])->execute();
                            }
                        }
                    }
                }
                if ($ipbh_type == 2)
                {
                    $this->spendHistoryICV($lastInsertedId);
                }
            }
        }
    }

    public function actionSaveworkforcespend()
    {
        $request_body = file_get_contents('php://input');
        $dataI = json_decode($request_body, true);

        $datawf = $dataI['data'];

        //Workforce Spend Plan
        if ($dataI['type'] == 3)
        {
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $quotationpk = $dataI['quotationid'];
            $type = $dataI['type'];
            $ipbh_type = $dataI['icvbasehdr'];
            $ip_address = \common\components\Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            if (isset($companypk) && isset($quotationpk) && isset($type))
            {
                $insertData = new IcvplanbasehdrTbl();

                $insertData->ipbh_memcompmst_fk = $companypk;
                $insertData->ipbh_cmsquotationhdr_fk = $quotationpk;
                $insertData->ipbh_icvplanmetricmst_fk = $type;
                $insertData->ipbh_type = $ipbh_type;
                $insertData->ipbh_createdon = $date;
                $insertData->ipbh_createdby = $userPK;
                $insertData->ipbh_createdbyipaddr = $ip_address;

                $count = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 3, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->count();

                if ($count >= 1)
                {
                    $countResult = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 3, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->one();
                    $lastInsertedId = $countResult->icvplanbasehdr_pk;
                }
                else
                {
                    $insetredSuccess = $insertData->save();
                    $lastInsertedId = $insertData->icvplanbasehdr_pk;
                }

                if ($lastInsertedId)
                {
                    $updateCount = 0;

                    foreach ($datawf as $key => $data)
                    {
                        if ($data['id'] == "null")
                        {
                            $wfspendhdrInsert = new IcvplanwfspendhdrTbl();
                            if ($data['cont_subcont'] == "Contractor")
                            {
                                $wfspendhdrInsert->ipwsh_type = 1;
                            }
                            elseif ($data['cont_subcont'] == "Sub-Contractor")
                            {
                                $wfspendhdrInsert->ipwsh_type = 2;
                            }
                            else
                            {
                                $wfspendhdrInsert->ipwsh_type = 0;
                            }
                            $wfspendhdrInsert->ipwsh_icvplanbasehdr_fk = $lastInsertedId;
                            if ($data['workforce_cat'] == "Omani")
                            {
                                $wfspendhdrInsert->ipwsh_icvplanmetrictypemst_fk = 6;
                            }
                            elseif ($data['workforce_cat'] == "Expatriates")
                            {
                                $wfspendhdrInsert->ipwsh_icvplanmetrictypemst_fk = 7;
                            }

                            $wfspendhdrInsert->ipwsh_createdon = $date;
                            $wfspendhdrInsert->ipwsh_createdby = $userPK;
                            $wfspendhdrInsert->ipwsh_createdbyipaddr = $ip_address;

                            $wfspendhdrInsert->save();
                            $wfhdrlastInsertedId = $wfspendhdrInsert->icvplanwfspendhdr_pk;

                            if ($wfhdrlastInsertedId)
                            {
                                $unsetKey = ["id", "spend_plan_serial", "cont_subcont", "workforce_cat", "tot_hd", "tot_mhd", "tot_cp", "uid", "boundindex", "uniqueid", "visibleindex"];
                                foreach ($unsetKey as $key)
                                {
                                    unset($data[$key]);
                                }

                                $chunkArray = array_chunk($data, 3);
                                foreach ($chunkArray as $wfspenddtlkey => $wfspenddtlvalue)
                                {
                                    foreach ($wfspenddtlvalue as $key => $value)
                                    {
                                        $wfspenddtl = new IcvplanwfspenddtlTbl();
                                        $wfspenddtl->ipwsd_icvplanwfspendhdr_fk = $wfhdrlastInsertedId;
                                        $wfspenddtl->ipwsd_icvplandesiglevelmst_fk = $wfspenddtlkey + 1;
                                        $wfspenddtl->ipwsd_subtype = $key + 1;
                                        $wfspenddtl->ipwsd_value = $value;
                                        $wfspenddtl->ipwsd_createdon = $date;
                                        $wfspenddtl->ipwsd_createdby = $userPK;
                                        $wfspenddtl->ipwsd_createdbyipaddr = $ip_address;
                                        $wfspenddtl->save();
                                    }
                                }
                            }
                        }
                        else
                        {
                            if ($updateCount == 0)
                            {

                                $connection = Yii::$app->db;
                                $connection->createCommand()->update('icvplanbasehdr_tbl', ['ipbh_updatedon' => $date], ['ipbh_cmsquotationhdr_fk' => $quotationpk])->execute();
                                $updateCount = 1;
                            }

                            $wfspendhdrUpdate = IcvplanwfspendhdrTbl::findOne($data['id']);
                            if ($data['cont_subcont'] == "Contractor")
                            {
                                $wfspendhdrUpdate->ipwsh_type = 1;
                            }
                            elseif ($data['cont_subcont'] == "Sub-Contractor")
                            {
                                $wfspendhdrUpdate->ipwsh_type = 2;
                            }
                            else
                            {
                                $wfspendhdrUpdate->ipwsh_type = 0;
                            }
                            $wfspendhdrUpdate->ipwsh_icvplanbasehdr_fk = $lastInsertedId;
                            if ($data['workforce_cat'] == "Omani")
                            {
                                $wfspendhdrUpdate->ipwsh_icvplanmetrictypemst_fk = 6;
                            }
                            elseif ($data['workforce_cat'] == "Expatriates")
                            {
                                $wfspendhdrUpdate->ipwsh_icvplanmetrictypemst_fk = 7;
                            }

                            $wfspendhdrUpdate->ipwsh_updatedon = $date;
                            $wfspendhdrUpdate->ipwsh_updatedby = $userPK;
                            $wfspendhdrUpdate->ipwsh_updatedbyipaddr = $ip_address;

                            $wfspendhdrUpdate->update();

                            $updatedId = $data['id'];
                            $unsetKey = ["id", "spend_plan_serial", "cont_subcont", "workforce_cat", "tot_hd", "tot_mhd", "tot_cp", "uid", "boundindex", "uniqueid", "visibleindex"];

                            foreach ($unsetKey as $key)
                            {
                                unset($data[$key]);
                            }
                            $chunkArray = array_chunk($data, 3);
                            foreach ($chunkArray as $mgmtkey => $mgmtvalue)
                            {
                                foreach ($mgmtvalue as $key => $value)
                                {
                                    $connection = Yii::$app->db;
                                    $connection->createCommand()->update('icvplanwfspenddtl_tbl', ['ipwsd_value' => $value],

                                    ['ipwsd_icvplandesiglevelmst_fk' => $mgmtkey + 1, 'ipwsd_subtype' => $key + 1, 'ipwsd_icvplanwfspendhdr_fk' => $updatedId])->execute();
                                }
                            }
                        }
                    }

                    // if($ipbh_type == 2) {
                    //     print_r(expression)
                    //     $month = date("n");
                    //     $currentQuarter = ceil($month / 3);
                    //     $count = IcvplanspendTbl::find()->where(['icvps_icvplanbasehdr_fk' => $lastInsertedId,
                    //                                         'icvps_year'=>date('Y'),
                    //                                         'icvps_quarter' => $currentQuarter ])->count();
                    //     if ($count >= 1)
                    //     {
                    //         $countResult = IcvplanspendTbl::find()->where(['icvps_icvplanbasehdr_fk' => $lastInsertedId,
                    //                                                         'icvps_year'=>date('Y'),
                    //                                                         'icvps_quarter' => $currentQuarter ])->one();
                    //         $lastInsertedId = $countResult->icvplanspend_pk;
                    //     }
                    //     else
                    //     {
                    //         $icvplanSpend = new IcvplanspendTbl();
                    //         foreach ($datas as $key => $value) {
                    //             $icvplanSpend->icvps_icvplanbasehdr_fk = $lastInsertedId;
                    //             $icvplanSpend->icvps_year = $value['y1'];
                    //             $icvplanSpend->icvps_quarter = $currentQuarter;
                    //             $icvplanSpend->icvps_submittedon = $date;
                    //             $icvplanSpend->icvps_status = 2;
                    //             $icvplanSpend->icvps_createdon = $date;
                    //             $icvplanSpend->icvps_createdby = $userPK;
                    //             $icvplanSpend->icvps_createdbyipaddr = $ip_address;
                    //             $icvplanSpend->save();
                    //         }
                    //     }
                    // }
                    
                }
            }
        }
    }

    public function actionSaveworkforcehead()
    {
        $request_body = file_get_contents('php://input');
        $dataI = json_decode($request_body, true);

        $datawfh = $dataI['data'];
        if ($dataI['type'] == 4)
        {
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $quotationpk = $dataI['quotationid'];
            $type = $dataI['type'];
            $ipbh_type = $dataI['icvbasehdr'];
            $ip_address = \common\components\Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

            if (isset($companypk) && isset($quotationpk) && isset($type))
            {
                $insertData = new IcvplanbasehdrTbl();

                $insertData->ipbh_memcompmst_fk = $companypk;
                $insertData->ipbh_cmsquotationhdr_fk = $quotationpk;
                $insertData->ipbh_icvplanmetricmst_fk = $type;
                $insertData->ipbh_type = $ipbh_type;
                $insertData->ipbh_createdon = $date;
                $insertData->ipbh_createdby = $userPK;
                $insertData->ipbh_createdbyipaddr = $ip_address;

                $count = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 4, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->count();

                if ($count >= 1)
                {
                    $countResult = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 4, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->one();
                    $lastInsertedId = $countResult->icvplanbasehdr_pk;
                }
                else
                {
                    $insetredSuccess = $insertData->save();
                    $lastInsertedId = $insertData->icvplanbasehdr_pk;
                }
                //print_r($lastInsertedId);die;
                if ($lastInsertedId)
                {
                    $updateCount = 0;
                    foreach ($datawfh as $key => $data)
                    {
                        //print_r($data);die();
                        if ($data['id'] == "null")
                        {
                            //Insert
                            if ($data['c_hp'] == "Total")
                            {
                                continue;
                            }
                            $wfheadcounthdrInsert = new IcvplanwfheadcounthdrTbl();

                            $wfheadcounthdrInsert->ipwhch_icvplanbasehdr_fk = $lastInsertedId;
                            if ($data['c_hp'] == "Existing Employees")
                            {
                                $wfheadcounthdrInsert->ipwhch_icvplanmetrictypemst_fk = 8;
                            }
                            elseif ($data['c_hp'] == "New Recruit.")
                            {
                                $wfheadcounthdrInsert->ipwhch_icvplanmetrictypemst_fk = 9;
                            }
                            elseif ($data['c_hp'] == "Redeployment")
                            {
                                $wfheadcounthdrInsert->ipwhch_icvplanmetrictypemst_fk = 10;
                            }
                            else
                            {
                                continue;
                            }

                            $wfheadcounthdrInsert->ipwhch_createdon = $date;
                            $wfheadcounthdrInsert->ipwhch_createdby = $userPK;
                            $wfheadcounthdrInsert->ipwhch_createdbyipaddr = $ip_address;

                            $wfheadcounthdrInsert->save();
                            $wfHeadCountHdrPrimary = $wfheadcounthdrInsert->icvplanwfheadcounthdr_pk;

                            $quarter = preg_replace("/[^0-9]/", '', $data['q_hp']);
                            $year = $data['year_hp'];

                            $unsetKey = ["id", "year_hp", "q_hp", "c_hp", "uid", "boundindex", "uniqueid", "visibleindex"];

                            foreach ($unsetKey as $unsetkey)
                            {
                                unset($data[$unsetkey]);
                            }
                            $chunkArray = array_chunk($data, 2);
                            //print_r($chunkArray);die;
                            foreach ($chunkArray as $hdrkey => $hdrvalue)
                            {
                                foreach ($hdrvalue as $key1 => $value1)
                                {
                                    if ($wfHeadCountHdrPrimary)
                                    {
                                        $wfheadcountdtlInsert = new IcvplanwfheadcountdtlTbl();

                                        $wfheadcountdtlInsert->ipwhcd_icvplanwfheadcounthdr_fk = $wfHeadCountHdrPrimary;

                                        $wfheadcountdtlInsert->ipwhcd_icvplandesiglevelmst_fk = $hdrkey + 1;
                                        $wfheadcountdtlInsert->ipwhcd_category = $key1 + 1;

                                        $wfheadcountdtlInsert->ipwhcd_year = $year;
                                        $wfheadcountdtlInsert->ipwhcd_quarter = $quarter;
                                        $wfheadcountdtlInsert->ipwhcd_value = $value1;
                                        $wfheadcountdtlInsert->ipwhcd_createdon = $date;
                                        $wfheadcountdtlInsert->ipwhcd_createdby = $userPK;
                                        $wfheadcountdtlInsert->ipwhcd_createdbyipaddr = $ip_address;

                                        $wfheadcountdtlInsert->save();
                                        //print_r($wfheadcountdtlInsert->geterrors());die();
                                        
                                    }
                                }
                            }
                        }
                        else
                        {
                            if ($updateCount == 0)
                            {

                                $connection = Yii::$app->db;
                                $connection->createCommand()->update('icvplanbasehdr_tbl', ['ipbh_updatedon' => $date], ['ipbh_cmsquotationhdr_fk' => $quotationpk])->execute();
                                $updateCount = 1;
                            }

                            if ($data['c_hp'] == "Total")
                            {
                                continue;
                            }

                            $wfhdrUpdate = IcvplanwfheadcounthdrTbl::findOne($data['id']);

                            $wfhdrUpdate->ipwhch_icvplanbasehdr_fk = $lastInsertedId;

                            if ($data['c_hp'] == "Existing Employees")
                            {
                                $wfhdrUpdate->ipwhch_icvplanmetrictypemst_fk = 8;
                            }
                            elseif ($data['c_hp'] == "New Recruit.")
                            {
                                $wfhdrUpdate->ipwhch_icvplanmetrictypemst_fk = 9;
                            }
                            elseif ($data['c_hp'] == "Redeployment")
                            {
                                $wfhdrUpdate->ipwhch_icvplanmetrictypemst_fk = 10;
                            }
                            else
                            {
                                continue;
                            }

                            $wfhdrUpdate->ipwhch_updatedon = $date;
                            $wfhdrUpdate->ipwhch_updatedby = $userPK;
                            $wfhdrUpdate->ipwhch_updatedbyipaddr = $ip_address;

                            $wfhdrUpdate->update();

                            $quarter = preg_replace("/[^0-9]/", '', $data['q_hp']);

                            $updatedId = $data['id'];
                            $year = $data['year_hp'];
                            $unsetKey = ["id", "year_hp", "q_hp", "c_hp", "uid", "boundindex", "uniqueid", "visibleindex"];

                            foreach ($unsetKey as $unsetkey)
                            {
                                unset($data[$unsetkey]);
                            }
                            $chunkArray = array_chunk($data, 2);

                            // print_r($chunkArray);
                            foreach ($chunkArray as $mgmtkey => $mgmtvalue)
                            {
                                foreach ($mgmtvalue as $key => $value)
                                {
                                    $connection = Yii::$app->db;
                                    $connection->createCommand()->update('icvplanwfheadcountdtl_tbl', ['ipwhcd_value' => $value],

                                    ['ipwhcd_icvplandesiglevelmst_fk' => $mgmtkey + 1, 'ipwhcd_category' => $key + 1, 'ipwhcd_year' => $year, 'ipwhcd_icvplanwfheadcounthdr_fk' => $updatedId])->execute();
                                }
                            }
                        }
                    }
                    if ($ipbh_type == 2)
                    {
                        $this->spendHistoryICV($lastInsertedId);
                    }
                }
            }
        }
    }

    public function actionSaveinvestment()
    {

        $request_body = file_get_contents('php://input');
        $dataI = json_decode($request_body, true);
        $datainv = $dataI['data'];
        if ($dataI['type'] == 5)
        {
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $quotationpk = $dataI['quotationid'];
            $type = $dataI['type'];
            $ipbh_type = $dataI['icvbasehdr'];
            $ip_address = \common\components\Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            if (isset($companypk) && isset($quotationpk) && isset($type))
            {
                $insertinvData = IcvplanbasehdrTbl::find()->where(['ipbh_icvplanmetricmst_fk' => 5, 'ipbh_cmsquotationhdr_fk' => $quotationpk, 'ipbh_type' => $ipbh_type])->one();

                if (!empty($insertinvData))
                {
                    $lastInsertedId = $icvData->icvplanbasehdr_pk;
                    $insertinvData->ipbh_updatedon = $date;
                    $insertinvData->ipbh_updatedby = $userPK;
                    $insertinvData->ipbh_updatedbyipaddr = $ip_address;
                }
                else
                {
                    $insertinvData = new IcvplanbasehdrTbl();
                    $insertinvData->ipbh_createdon = $date;
                    $insertinvData->ipbh_createdby = $userPK;
                    $insertinvData->ipbh_createdbyipaddr = $ip_address;
                }
                $insertinvData->ipbh_memcompmst_fk = $companypk;
                $insertinvData->ipbh_cmsquotationhdr_fk = $quotationpk;
                $insertinvData->ipbh_icvplanmetricmst_fk = $type;
                $insertinvData->ipbh_type = $ipbh_type;
                $insetredSuccess = $insertinvData->save();
                $lastInsertedId = $insertinvData->icvplanbasehdr_pk;
                if ($lastInsertedId)
                {
                    $updateCount = 0;
                    foreach ($datainv as $key => $data)
                    {
                        if ($data['id'] == "null")
                        {
                            $invhdrInsert = new IcvplaninvesthdrTbl();
                            $invhdrInsert->ipih_icvplanbasehdr_fk = $lastInsertedId;
                            if ($data['it'] == "Existing Investment")
                            {
                                $invhdrInsert->ipih_icvplanmetrictypemst_fk = 11;
                                $invhdrtypeFlag = 11;
                            }
                            elseif ($data['it'] == "Future Investment")
                            {
                                $invhdrInsert->ipih_icvplanmetrictypemst_fk = 12;
                                $invhdrtypeFlag = 12;
                            }
                            else
                            {
                                $invhdrInsert->ipih_icvplanmetrictypemst_fk = $invhdrtypeFlag;
                            }
                            if ($data['ic'] == "Manufacturing Facility")
                            {
                                $invhdrInsert->ipih_category = 1;
                            }
                            elseif ($data['ic'] == "Ware House")
                            {
                                $invhdrInsert->ipih_category = 2;
                            }
                            elseif ($data['ic'] == "Repair Facility")
                            {
                                $invhdrInsert->ipih_category = 3;
                            }
                            $invhdrInsert->ipih_summary = $data['s'];
                            $invhdrInsert->ipih_createdon = $date;
                            $invhdrInsert->ipih_createdby = $userPK;
                            $invhdrInsert->ipih_createdbyipaddr = $ip_address;
                            $modelSave = $invhdrInsert->save(false);
                            if (!$modelSave)
                            {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'warning',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong',
                                    'returndata' => $invhdrInsert->getErrors()
                                );
                                return $result;
                            }
                            $invhdrlastInsertedId = $invhdrInsert->icvplaninvesthdr_pk;
                            $quarter = preg_replace("/[^0-9]/", '', $data['q_hp']);
                            if ($invhdrlastInsertedId)
                            {
                                $invdtlInsert = new IcvplaninvestdtlTbl();
                                $invdtlInsert->ipid_icvplaninvesthdr_fk = $invhdrlastInsertedId;
                                $invdtlInsert->ipid_year = $data['year_hp'];
                                $invdtlInsert->ipid_quarter = $quarter;
                                $invdtlInsert->ipid_value = $data['a'];
                                $invdtlInsert->ipid_createdon = $date;
                                $invdtlInsert->ipid_createdby = $userPK;
                                $invdtlInsert->ipid_createdbyipaddr = $ip_address;
                                $dtlModelSave = $invdtlInsert->save(false);
                                if (!$dtlModelSave)
                                {
                                    $result = array(
                                        'status' => 200,
                                        'msg' => 'warning',
                                        'flag' => 'E',
                                        'comments' => 'Something went wrong',
                                        'returndata' => $invdtlInsert->getErrors()
                                    );
                                    return $result;
                                }
                            }
                        }
                        else
                        {
                            if ($updateCount == 0)
                            {
                                $connection = Yii::$app->db;
                                $connection->createCommand()->update('icvplanbasehdr_tbl', ['ipbh_updatedon' => $date], ['ipbh_cmsquotationhdr_fk' => $quotationpk])->execute();
                                $updateCount = 1;
                            }

                            $invhdrUpdate = IcvplaninvesthdrTbl::findOne($data['id']);

                            $invhdrUpdate->ipih_icvplanbasehdr_fk = $lastInsertedId;
                            if ($data['it'] == "Existing Investment")
                            {
                                $invhdrUpdate->ipih_icvplanmetrictypemst_fk = 11;
                                $invhdrtypeFlag = 11;
                            }
                            elseif ($data['it'] == "Future Investment")
                            {
                                $invhdrUpdate->ipih_icvplanmetrictypemst_fk = 12;
                                $invhdrtypeFlag = 12;
                            }
                            else
                            {
                                $invhdrUpdate->ipih_icvplanmetrictypemst_fk = $invhdrtypeFlag;
                            }

                            if ($data['ic'] == "Manufacturing Facility")
                            {
                                $invhdrUpdate->ipih_category = 1;
                            }
                            elseif ($data['ic'] == "Ware House")
                            {
                                $invhdrUpdate->ipih_category = 2;
                            }
                            else
                            {
                                $invhdrUpdate->ipih_category = 3;
                            }
                            $invhdrUpdate->ipih_summary = $data['s'];

                            $invhdrUpdate->ipih_updatedon = $date;
                            $invhdrUpdate->ipih_updatedby = $userPK;
                            $invhdrUpdate->ipih_updatedbyipaddr = $ip_address;

                            $quarter = preg_replace("/[^0-9]/", '', $data['q_hp']);
                            if (!$invhdrUpdate->update())
                            {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'warning',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong',
                                    'returndata' => $invhdrUpdate->getErrors()
                                );
                                return $result;
                            }

                            $connection = Yii::$app->db;
                            $connection->createCommand()->update('icvplaninvestdtl_tbl', ['ipid_value' => $data['a'], 'ipid_quarter' => $quarter, 'ipid_year' => $data['year_hp']

                            ], ['ipid_icvplaninvesthdr_fk' => $data['id']])->execute();

                        }
                    }
                    if ($ipbh_type == 2)
                    {
                        $this->spendHistoryICV($lastInsertedId);
                    }
                }
            }
        }

    }

    //Good Listing Table
    public function actionGoodsplantbldata()
    {
        //echo \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true); die;
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        $basehdrtype = Yii::$app->getRequest()->getQueryParam('basehdr');

        //print_r($basehdrtype);die();
        $query = IcvplangoodshdrTbl::find();
        $query->select('icvplangoodshdr_tbl.icvplangoodshdr_pk as id,
            icvplangoodshdr_tbl.ipgh_icvplanmetrictypemst_fk as protype,
            icvplanmetrictypemst_tbl.ipmtm_typename as protype_name');

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplangoodshdr_tbl.ipgh_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($basehdrtype)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);
        }

        $listofData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

        //print_r($listofData);die();
        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplangoodsdtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipgd_icvplangoodshdr_fk' => $value['id']]);

            if ($basehdrtype == 2)
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $query_dtl->andWhere(['ipgd_year' => date('Y') , 'ipgd_quarter' => $currentQuarter]);
            }

            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();
            // print_r($dtlsData);
            if (!empty($dtlsData))
            {
                foreach ($dtlsData as $dtldatakey => $dtldatavalue)
                {
                    $year = $dtldatavalue['ipgd_year'];

                    $sumofData[0]['Procurement Type'] = 0;
                    $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;

                    $sumofData[1]['Procurement Type'] = 0;
                    $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;

                    $sumofData[2]['Procurement Type'] = 0;
                    $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;

                    if ($dtldatavalue['ipgd_quarter'] % 4 == 0)
                    {
                        $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = 0;
                        $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = 0;
                        $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = 0;
                    }
                }
                $sumofData[0][$year . ' ' . 'Total'] = 0;
                $sumofData[1][$year . ' ' . 'Total'] = 0;
                $sumofData[2][$year . ' ' . 'Total'] = 0;
            }

        }

        if ($basehdrtype == 2)
        {

            $sumofData[0]['Procurement Type'] = "Made in Oman";
            $sumofData[1]['Procurement Type'] = "National Suppliers";
            $sumofData[2]['Procurement Type'] = "International Suppliers";
            $sumofData[3]['Procurement Type'] = "Total";

            $month = date("n");
            $currentQuarter = ceil($month / 3);

            $sumofData[0][date('Y') . ' Q' . $currentQuarter] = "0";
            $sumofData[0][date('Y') . ' Total'] = "0";

            $sumofData[1][date('Y') . ' Q' . $currentQuarter] = "0";
            $sumofData[1][date('Y') . ' Total'] = "0";

            $sumofData[2][date('Y') . ' Q' . $currentQuarter] = "0";
            $sumofData[2][date('Y') . ' Total'] = "0";

            $sumofData[3][date('Y') . ' Q' . $currentQuarter] = "0";
            $sumofData[3][date('Y') . ' Total'] = "0";

        }

        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplangoodsdtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipgd_icvplangoodshdr_fk' => $value['id']]);

            if ($basehdrtype == 2)
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $query_dtl->andWhere(['ipgd_year' => date('Y') , 'ipgd_quarter' => $currentQuarter]);
            }

            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();

            //print_r($dtlsData);die();
            $sumofData[0]['Procurement Type'] = "Made in Oman";
            $sumofData[1]['Procurement Type'] = "National Suppliers";
            $sumofData[2]['Procurement Type'] = "International Suppliers";
            $sumofData[3]['Procurement Type'] = "Total";

            $quarterSum = 0;

            //print_r($dtlsData);die();
            foreach ($dtlsData as $dtldatakey => $dtldatavalue)
            {

                $sumQuery = IcvplangoodsdtlTbl::find();
                $sumQuery->select("
                        DISTINCT(SUM(`ipgd_value`)) as sum, ");

                $sumQuery->innerJoin("icvplangoodshdr_tbl ghdr", 'icvplangoodsdtl_tbl.ipgd_icvplangoodshdr_fk = ghdr.icvplangoodshdr_pk');

                $sumQuery->innerJoin("icvplanbasehdr_tbl", 'icvplanbasehdr_tbl.icvplanbasehdr_pk = ghdr.ipgh_icvplanbasehdr_fk');

                $sumQuery->andWhere('ghdr.ipgh_icvplanmetrictypemst_fk=:hdrfk', array(
                    ':hdrfk' => $value['protype']
                ));

                $sumQuery->andWhere(['ipgd_year' => $dtldatavalue['ipgd_year'], 'ipgd_quarter' => $dtldatavalue['ipgd_quarter'], 'icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);

                $sumQuery->asArray()->all();

                $sum_dtl = new ActiveDataProvider(['query' => $sumQuery]);

                //print_r($sumQuery->createCommand()->getRawSql());die();
                $sumData = $sum_dtl->getModels();

                //print_r($sumData[0]);die();
                if ($value['protype'] == 1)
                {
                    if (is_null($sumData[0]['sum']))
                    {
                        $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;
                    }
                    else
                    {
                        $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $sumData[0]['sum'];
                    }

                    $quarterSum += $sumData[0]['sum'];
                    $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $quarterSum;

                    $verSum = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']];

                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $verSum;
                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Total'];

                }

                if ($value['protype'] == 2)
                {
                    if (is_null($sumData[0]['sum']))
                    {
                        $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;
                    }
                    else
                    {
                        $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $sumData[0]['sum'];
                    }

                    $quarterSum += $sumData[0]['sum'];
                    $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $quarterSum;

                    $verSum = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']];

                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $verSum;
                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Total'];

                }

                if ($value['protype'] == 3)
                {
                    if (is_null($sumData[0]['sum']))
                    {
                        $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = 0;
                    }
                    else
                    {
                        $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $sumData[0]['sum'];
                    }

                    $quarterSum += $sumData[0]['sum'];
                    $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $quarterSum;

                    $verSum = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']];

                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Q' . $dtldatavalue['ipgd_quarter']] = $verSum;
                    $sumofData[3][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] = $sumofData[0][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[1][$dtldatavalue['ipgd_year'] . ' ' . 'Total'] + $sumofData[2][$dtldatavalue['ipgd_year'] . ' ' . 'Total'];
                }

                if ($dtldatavalue['ipgd_quarter'] % 4 == 0)
                {
                    $quarterSum = 0;
                }
            }
        }
        return ['items' => $sumofData, ];
    }

    //Service Plan Listing
    public function actionServiceplantbldata()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        $basehdrtype = Yii::$app->getRequest()->getQueryParam('basehdr');

        $query = IcvplanservicehdrTbl::find();
        $query->select('icvplanservicehdr_tbl.icvplanservicehdr_pk as id,
            icvplanservicehdr_tbl.ipsh_icvplanmetrictypemst_fk as protype,
            icvplanmetrictypemst_tbl.ipmtm_typename as protype_name');
        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplanservicehdr_tbl.ipsh_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($basehdrtype)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);
        }

        $listofData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

        //print_r($listofData);die();
        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplanservicedtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipsd_icvplanservicehdr_fk' => $value['id']]);

            if ($basehdrtype == 2)
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);
                $query_dtl->andWhere(['ipsd_year' => date('Y') , 'ipsd_quarter' => $currentQuarter]);
            }

            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();

            if (!empty($dtlsData))
            {
                foreach ($dtlsData as $dtldatakey => $dtldatavalue)
                {

                    $year = $dtldatavalue['ipsd_year'];

                    $sumofData[0]['Procurement Type'] = 0;
                    $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = 0;

                    $sumofData[1]['Procurement Type'] = 0;
                    $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = 0;

                    if ($dtldatavalue['ipsd_quarter'] % 4 == 0)
                    {
                        $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = 0;
                        $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = 0;

                    }
                }
                $sumofData[0][$year . ' ' . 'Total'] = 0;
                $sumofData[1][$year . ' ' . 'Total'] = 0;
            }

        }
        //print_r($sumofData);die();
        if ($basehdrtype == 2)
        {

            $sumofData[0]['Procurement Type'] = "National Suppliers";
            $sumofData[1]['Procurement Type'] = "International Suppliers";
            $sumofData[2]['Procurement Type'] = "Total";

            $month = date("n");
            $currentQuarter = ceil($month / 3);

            $sumofData[0][date('Y') . " Q" . $currentQuarter] = "0";
            $sumofData[0][date('Y') . " Total"] = "0";

            $sumofData[1][date('Y') . " Q" . $currentQuarter] = "0";
            $sumofData[1][date('Y') . " Total"] = "0";

            $sumofData[2][date('Y') . " Q" . $currentQuarter] = "0";
            $sumofData[2][date('Y') . " Total"] = "0";
        }
        foreach ($listofData as $key => $value)
        {
            $query_dtl = IcvplanservicedtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipsd_icvplanservicehdr_fk' => $value['id']]);

            if ($basehdrtype == 2)
            {

                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $query_dtl->andWhere(['ipsd_year' => date('Y') , 'ipsd_quarter' => $currentQuarter]);
            }

            $query_dtl->asArray()->all();

            $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

            $dtlsData = $provider_dtl->getModels();

            $sumofData[0]['Procurement Type'] = "National Suppliers";
            $sumofData[1]['Procurement Type'] = "International Suppliers";
            $sumofData[2]['Procurement Type'] = "Total";

            $quarterSum = 0;

            foreach ($dtlsData as $dtldatakey => $dtldatavalue)
            {

                $sumQuery = IcvplanservicedtlTbl::find();
                $sumQuery->select("
                    DISTINCT(SUM(`ipsd_value`)) as sum ");

                $sumQuery->innerJoin("icvplanservicehdr_tbl shdr", 'icvplanservicedtl_tbl.ipsd_icvplanservicehdr_fk = shdr.icvplanservicehdr_pk');

                $sumQuery->innerJoin("icvplanbasehdr_tbl", 'icvplanbasehdr_tbl.icvplanbasehdr_pk = shdr.ipsh_icvplanbasehdr_fk');

                $sumQuery->andWhere(['shdr.ipsh_icvplanmetrictypemst_fk' => $value['protype']]);

                $sumQuery->andWhere(['ipsd_year' => $dtldatavalue['ipsd_year'], 'ipsd_quarter' => $dtldatavalue['ipsd_quarter'], 'icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'icvplanbasehdr_tbl.ipbh_type' => $basehdrtype, ]);

                $sumQuery->asArray()->all();

                $sum_dtl = new ActiveDataProvider(['query' => $sumQuery]);

                $sumData = $sum_dtl->getModels();

                if ($value['protype'] == 4)
                {
                    if (is_null($sumData[0]['sum']))
                    {
                        $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = 0;
                    }
                    else
                    {
                        $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = $sumData[0]['sum'];
                    }

                    $quarterSum += $sumData[0]['sum'];
                    $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = $quarterSum;

                    $verSum = $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] + $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']];

                    $sumofData[2][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = $verSum;
                    $sumofData[2][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] + $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Total'];
                }

                if ($value['protype'] == 5)
                {
                    if (is_null($sumData[0]['sum']))
                    {
                        $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = 0;
                    }
                    else
                    {
                        $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = $sumData[0]['sum'];
                    }

                    $quarterSum += $sumData[0]['sum'];
                    $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = $quarterSum;

                    $verSum = $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] + $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']];

                    $sumofData[2][$dtldatavalue['ipsd_year'] . ' ' . 'Q' . $dtldatavalue['ipsd_quarter']] = $verSum;
                    $sumofData[2][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] = $sumofData[0][$dtldatavalue['ipsd_year'] . ' ' . 'Total'] + $sumofData[1][$dtldatavalue['ipsd_year'] . ' ' . 'Total'];
                }

                if ($dtldatavalue['ipsd_quarter'] % 4 == 0)
                {
                    $quarterSum = 0;
                }
            }

        }
        return ['items' => $sumofData];
    }

    //Investment Plan Listing
    public function actionInvestmentplantbldata()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        $basehdrtype = Yii::$app->getRequest()->getQueryParam('basehdr');

        $query = IcvplaninvestdtlTbl::find();
        $query->select("*");

        $query->leftJoin('icvplaninvesthdr_tbl a', 'icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk = a.icvplaninvesthdr_pk');

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = a.ipih_icvplanmetrictypemst_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = a.ipih_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }

        if ($basehdrtype == 2)
        {
            $month = date("n");
            $currentQuarter = ceil($month / 3);

            $query->andWhere(['icvplaninvestdtl_tbl.ipid_year' => date("Y") , 'icvplaninvestdtl_tbl.ipid_quarter' => $currentQuarter, 'icvplanbasehdr_tbl.ipbh_type' => $basehdrtype, ]);
        }
        else
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);
        }
        //echo $query->createCommand()->getRawSql();die();
        $query->orderBy('ipid_year ASC');

        $query->asArray();

        $provider = new ActiveDataProvider(['query' => $query]);

        $investmentData = $provider->getModels();
        //print_r($investmentData);die();
        $invData = array();

        foreach ($investmentData as $key => $value)
        {
            $query_inv = IcvplaninvestdtlTbl::find();
            $query_inv->select("
                icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk as id,
                icvplaninvestdtl_tbl.ipid_year as year,
                CONCAT(icvplaninvestdtl_tbl.ipid_year, CONCAT('-Q', `icvplaninvestdtl_tbl`.`ipid_quarter`)) as hyear,   
                SUM(`ipid_value`) as invamount,
                icvplaninvesthdr_tbl.ipih_summary as invsummary,
                        
                (CASE WHEN `icvplaninvesthdr_tbl`.`ipih_category` = 1 THEN 'Manufacturing Facility' WHEN `icvplaninvesthdr_tbl`.`ipih_category` = 2 THEN 'Ware House' ELSE 'Repair Facility' END) as headworkforcecate");

            $query_inv->leftJoin("icvplaninvesthdr_tbl", "icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk = icvplaninvesthdr_tbl.icvplaninvesthdr_pk");

            $query_inv->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk');

            $query_inv->andWhere(['ipih_icvplanmetrictypemst_fk' => $value['ipih_icvplanmetrictypemst_fk'], 'ipih_category' => $value['ipih_category'], 'ipih_summary' => $value['ipih_summary'], 'ipid_year' => $value['ipid_year'], 'ipid_quarter' => $value['ipid_quarter'], 'icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);

            $query_inv->asArray();

            $provider_inv = new ActiveDataProvider(['query' => $query_inv]);

            $investmentData = $provider_inv->getModels() [0];

            array_push($invData, $provider_inv->getModels() [0]);
            $invData[$key]['invtype'] = $value['ipmtm_typename'];

            $invSum += $value['ipid_value'];

        }
        //print_r($invData);die();
        $invFinalData = array_values(array_map("unserialize", array_unique(array_map("serialize", $invData))));

        if (empty($invFinalData) || empty($investmentData))
        {
            return ['items' => null];
        }
        return ['items' => $invFinalData];
    }

    ////Workforce Plan Listing
    public function actionWorkforcespendplantbldata()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        $basehdrtype = Yii::$app->getRequest()->getQueryParam('basehdr');

        $query = IcvplanwfspendhdrTbl::find();
        $query->select("icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk as id,
            (CASE WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 1 THEN  'Contractor' WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 2 THEN  'Sub-Contractor' ELSE '' END)as category,
                icvplanmetrictypemst_tbl.ipmtm_typename as workforcecate ");

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanmetrictypemst_fk = icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($basehdrtype)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);
        }

        $wfspendData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

        $spendKey = 0;
        foreach ($wfspendData as $key => $value)
        {
            $spendKey = $key;
            $query_dtl = IcvplanwfspenddtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipwsd_icvplanwfspendhdr_fk' => $value['id']]);

            $dtlsData = $query_dtl->asArray()->all();

            $wfspendData[$key]['seniormanage'] = $dtlsData[0]['ipwsd_value'] + $dtlsData[1]['ipwsd_value'] + $dtlsData[2]['ipwsd_value'];
            $wfspendData[$key]['middlemanage'] = $dtlsData[3]['ipwsd_value'] + $dtlsData[4]['ipwsd_value'] + $dtlsData[5]['ipwsd_value'];

            $wfspendData[$key]['juniormanage'] = $dtlsData[6]['ipwsd_value'] + $dtlsData[7]['ipwsd_value'] + $dtlsData[8]['ipwsd_value'];

            $wfspendData[$key]['techprofession'] = $dtlsData[9]['ipwsd_value'] + $dtlsData[10]['ipwsd_value'] + $dtlsData[11]['ipwsd_value'];

            $wfspendData[$key]['technicians'] = $dtlsData[12]['ipwsd_value'] + $dtlsData[13]['ipwsd_value'] + $dtlsData[14]['ipwsd_value'];

            $wfspendData[$key]['skilled'] = $dtlsData[15]['ipwsd_value'] + $dtlsData[16]['ipwsd_value'] + $dtlsData[17]['ipwsd_value'];

            $wfspendData[$key]['semiskilled'] = $dtlsData[18]['ipwsd_value'] + $dtlsData[19]['ipwsd_value'] + $dtlsData[20]['ipwsd_value'];

        }
        if (empty($wfspendData))
        {
            return ['items' => null];
        }

        $wfspendData[$spendKey + 1]['id'] = $spendKey + 1;
        $wfspendData[$spendKey + 1]['category'] = "Total";
        $wfspendData[$spendKey + 1]['workforcecate'] = "Omani";

        $wfspendData[$spendKey + 1]['seniormanage'] = $wfspendData[0]['seniormanage'] + $wfspendData[2]['seniormanage'];
        $wfspendData[$spendKey + 1]['middlemanage'] = $wfspendData[0]['middlemanage'] + $wfspendData[2]['middlemanage'];
        $wfspendData[$spendKey + 1]['juniormanage'] = $wfspendData[0]['juniormanage'] + $wfspendData[2]['juniormanage'];
        $wfspendData[$spendKey + 1]['techprofession'] = $wfspendData[0]['techprofession'] + $wfspendData[2]['techprofession'];
        $wfspendData[$spendKey + 1]['technicians'] = $wfspendData[0]['technicians'] + $wfspendData[2]['technicians'];
        $wfspendData[$spendKey + 1]['skilled'] = $wfspendData[0]['skilled'] + $wfspendData[2]['skilled'];
        $wfspendData[$spendKey + 1]['semiskilled'] = $wfspendData[0]['semiskilled'] + $wfspendData[2]['semiskilled'];

        $wfspendData[$spendKey + 2]['id'] = $spendKey + 2;
        $wfspendData[$spendKey + 2]['category'] = "";
        $wfspendData[$spendKey + 2]['workforcecate'] = "Expatriates";

        $wfspendData[$spendKey + 2]['seniormanage'] = $wfspendData[1]['seniormanage'] + $wfspendData[3]['seniormanage'];
        $wfspendData[$spendKey + 2]['middlemanage'] = $wfspendData[1]['middlemanage'] + $wfspendData[3]['middlemanage'];
        $wfspendData[$spendKey + 2]['juniormanage'] = $wfspendData[1]['juniormanage'] + $wfspendData[3]['juniormanage'];
        $wfspendData[$spendKey + 2]['techprofession'] = $wfspendData[1]['techprofession'] + $wfspendData[3]['techprofession'];
        $wfspendData[$spendKey + 2]['technicians'] = $wfspendData[1]['technicians'] + $wfspendData[3]['technicians'];
        $wfspendData[$spendKey + 2]['skilled'] = $wfspendData[1]['skilled'] + $wfspendData[3]['skilled'];
        $wfspendData[$spendKey + 2]['semiskilled'] = $wfspendData[1]['semiskilled'] + $wfspendData[3]['semiskilled'];

        return ['items' => $wfspendData];
    }

    //HeadCount Lisitng
    public function actionWorkforceheadplantbldata()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        $basehdrtype = Yii::$app->getRequest()->getQueryParam('basehdr');

        $query = IcvplanwfheadcounthdrTbl::find();

        $query->select("icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk as id,         
            icvplanmetrictypemst_tbl.ipmtm_typename as headworkforcecate");

        $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanmetrictypemst_fk = icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk');

        if ($quotationId)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId]);
        }
        if ($basehdrtype)
        {
            $query->andWhere(['icvplanbasehdr_tbl.ipbh_type' => $basehdrtype]);
        }

        $wfheadData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

        foreach ($wfheadData as $key => $value)
        {
            $query_dtl = IcvplanwfheadcountdtlTbl::find();
            $query_dtl->select('*');
            $query_dtl->andWhere(['ipwhcd_icvplanwfheadcounthdr_fk' => $value['id']]);

            if ($basehdrtype == 2)
            {
                $month = date("n");
                $currentQuarter = ceil($month / 3);

                $query_dtl->andWhere(['icvplanwfheadcountdtl_tbl.ipwhcd_year' => date("Y") , 'icvplanwfheadcountdtl_tbl.ipwhcd_quarter' => $currentQuarter, ]);
            }

            $dtlsData = $query_dtl->asArray()->all();

            $wfheadData[$key]['year'] = $dtlsData[0]['ipwhcd_year'];
            $wfheadData[$key]['hyear'] = $dtlsData[0]['ipwhcd_year'] . '-Q' . $dtlsData[0]['ipwhcd_quarter'];

            $wfheadData[$key]['headseniormanage'] = $dtlsData[0]['ipwhcd_value'] + $dtlsData[1]['ipwhcd_value'];
            $wfheadData[$key]['headmiddlemanage'] = $dtlsData[2]['ipwhcd_value'] + $dtlsData[3]['ipwhcd_value'];
            $wfheadData[$key]['headjuniormanage'] = $dtlsData[4]['ipwhcd_value'] + $dtlsData[5]['ipwhcd_value'];
            $wfheadData[$key]['headtechprofession'] = $dtlsData[6]['ipwhcd_value'] + $dtlsData[7]['ipwhcd_value'];
            $wfheadData[$key]['headtechnicians'] = $dtlsData[8]['ipwhcd_value'] + $dtlsData[9]['ipwhcd_value'];
            $wfheadData[$key]['headskilled'] = $dtlsData[10]['ipwhcd_value'] + $dtlsData[11]['ipwhcd_value'];
        }

        // print_r( $wfheadData);die();
        if (!empty($wfheadData))
        {

            $actualData = array();

            foreach ($wfheadData as $key => $value)
            {
                if ($value['year'] != '' && $value['year'] != null)
                {
                    array_push($actualData, $value);
                }
            }
            if (empty($actualData))
            {
                return ['items' => null];
            }
            else
            {
                return ['items' => $actualData];
            }

        }

        if (empty($wfheadData))
        {
            return ['items' => null];
        }
        return ['items' => $wfheadData];
    }

    public function actionQuotationdetails()
    {

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $quotaionPK = $data['id'];
        if ($quotaionPK)
        {

            //$query = CmsquotationhdrTbl::find();
            $query->select('
                    cmsquotationhdr_tbl.cmsquotationhdr_pk as type_id,
                    cmsquotationhdr_tbl.cmsqh_uid as summaryid,
                    cmsquotationhdr_tbl.cmsqh_quotationrefno as summaryrefno,
                    cmsquotationhdr_tbl.cmsqh_quotationtitle as summaryhead
                    ');

            $query->andWhere('cmsquotationhdr_pk=:quotationhdrPk', array(
                ':quotationhdrPk' => $quotaionPK
            ));

            $quotationDtlsData = $query->asArray()->all();

            return ['items' => $quotationDtlsData];
        }
    }
    public function actionIcvupdatedstatus()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $quotaionPK = $data['dataPk'];

        //print_r($quotaionPK);die();
        if ($quotaionPK)
        {

            $query = IcvplanbasehdrTbl::find();

            $query->select('membercompanymst_tbl.MCM_CompanyName,icvplanbasehdr_tbl.ipbh_updatedon');

            $query->leftJoin('membercompanymst_tbl', 'membercompanymst_tbl.MemberCompMst_Pk=icvplanbasehdr_tbl.ipbh_memcompmst_fk');

            $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

            $baseStatusData = $query->asArray()->one();

            //print_r($baseStatusData);die();
            return ['items' => $baseStatusData];
        }
    }

    public function actionIcvstatus()
    {

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        $quotaionPK = $data['dataPk'];

        $icvStatusFlag = 'false';

        if ($quotaionPK)
        {

            if ($icvStatusFlag == 'false')
            {

                $query = IcvplanbasehdrTbl::find();

                $query->select('*');

                $query->innerJoin('icvplangoodshdr_tbl', 'icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk=icvplanbasehdr_tbl.icvplanbasehdr_pk');

                $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

                $goodsStatus = $query->asArray()->all();

                if (count($goodsStatus) > 0)
                {
                    $icvStatusFlag = 'true';
                }
            }

            if ($icvStatusFlag == 'false')
            {

                $query = IcvplanbasehdrTbl::find();

                $query->select('*');

                $query->innerJoin('icvplanservicehdr_tbl', 'icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk=icvplanbasehdr_tbl.icvplanbasehdr_pk');

                $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

                $serviceStatus = $query->asArray()->all();

                if (count($serviceStatus) > 0)
                {
                    $icvStatusFlag = 'true';
                }

            }
            if ($icvStatusFlag == 'false')
            {

                $query = IcvplanbasehdrTbl::find();

                $query->select('*');

                $query->innerJoin('icvplanwfspendhdr_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk=icvplanbasehdr_tbl.icvplanbasehdr_pk');

                $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

                $wfspendStatus = $query->asArray()->all();

                if (count($wfspendStatus) > 0)
                {
                    $icvStatusFlag = 'true';
                }
            }

            if ($icvStatusFlag == 'false')
            {

                $query = IcvplanbasehdrTbl::find();

                $query->select('*');

                $query->innerJoin('icvplanwfheadcounthdr_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk=icvplanbasehdr_tbl.icvplanbasehdr_pk');

                $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

                $wfheadStatus = $query->asArray()->all();

                if (count($wfheadStatus) > 0)
                {
                    $icvStatusFlag = 'true';
                }

            }

            if ($icvStatusFlag == 'false')
            {

                $query = IcvplanbasehdrTbl::find();

                $query->select('*');

                $query->innerJoin('icvplaninvesthdr_tbl', 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk=icvplanbasehdr_tbl.icvplanbasehdr_pk');

                $query->andWhere(['ipbh_cmsquotationhdr_fk' => $quotaionPK]);

                $invStatus = $query->asArray()->all();
                // print_r($invStatus);die();
                if (count($invStatus) > 0)
                {
                    $icvStatusFlag = 'true';
                }

            }
            //print_r($icvStatusFlag);die();
            return ['items' => ['icvflag' => $icvStatusFlag]];
        }
    }

    public function actionIcvsummary()
    {
        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');
        if (!empty($quotationId))
        {
            // Goods Summary sum
            $result = CmsquotationhdrTbl::find()->where(['cmsquotationhdr_pk' => $quotationId])->one();

            $icvcommitementActualData = $this->actionIcvactualspenddataforoverview($quotationId, '', '');

            if (!empty($icvcommitementActualData['items']))
            {
                foreach ($icvcommitementActualData['items'] as $actualcommited_key => $actualcommited_value)
                {
                    $commited_val += $actualcommited_value['plannedamt'];
                    $actual_val += $actualcommited_value['actspendamt'];
                }
            }

            if ($commited_val != 0)
            {
                $performanceper = ($actual_val / $commited_val) * 100;
            }
            else
            {
                $performanceper = 0;
            }
            if ($result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->crfd_cmscontracthdr_fk == null)
            {
                $viewData = array(
                    'id' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk->prjd_projectid,
                    'title' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk->prjd_projname,
                    'refno' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->crfdProjectdtlsFk->prjd_referenceno,
                    'type' => 'Project',
                    'commited_val' => $commited_val,
                    'actual_val' => $actual_val,
                    'performance' => round($performanceper, 2)
                );
            }
            else
            {
                $mainType = $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->cmscontracthdrTbls->cmsch_type;
                $subType = $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->cmscontracthdrTbls->cmsch_contracttype;
                $type = 'Contract';
                if ($mainType == 1 && $subType == 1)
                {
                    $type = 'Contract';
                }
                elseif ($mainType == 1 && $subType == 2)
                {
                    $type = 'Subcontract';
                }
                elseif ($mainType == 2 && $subType == 1)
                {
                    $type = 'Purchase Order';
                }
                elseif ($mainType == 2 && $subType == 2)
                {
                    $type = 'Suborder';
                }
                elseif ($mainType == 3 && $subType == 1)
                {
                    $type = 'Agreement';
                }

                $viewData = array(
                    'id' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->cmscontracthdrTbls->cmsch_uid,
                    'title' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->cmscontracthdrTbls->cmsch_contracttitle,
                    'refno' => $result->cmstenderhdrtbl->cmsthCmsrequisitionformdtlsFk->cmscontracthdrTbls->cmsch_contractrefno,
                    'type' => $type,
                    'commited_val' => $commited_val,
                    'actual_val' => $actual_val,
                    'performance' => round($performanceper, 2)
                );

            }

            $query = IcvplangoodshdrTbl::find();

            $query->select('icvplangoodshdr_tbl.icvplangoodshdr_pk as id,
                icvplangoodshdr_tbl.ipgh_icvplanmetrictypemst_fk as protype,
                icvplanmetrictypemst_tbl.ipmtm_typename as protype_name');

            $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplangoodshdr_tbl.ipgh_icvplanmetrictypemst_fk');

            $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk');

            if ($quotationId)
            {
                $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);
            }

            $listofData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

            $summarylst = array(
                'categoeryname' => 'Planned Spend',
                'madeinoman' => 0,
                'nationalsuppliers' => 0,
                'internationalsuppliers' => 0,
                'snationalsuppliers' => 0,
                'sinternationalsuppliers' => 0,
                'futureinvestment' => 0,
                'existinginvestment' => 0,
                'omanheadcount' => 0,
                'omanmanhour' => 0,
                'omanpayroll' => 0,
                'expatriateheadcount' => 0,
                'expatriatemanhour' => 0,
                'expatriatepayroll' => 0
            );

            //print_r($listofData);die();
            foreach ($listofData as $key => $value)
            {
                $query_dtl = IcvplangoodsdtlTbl::find();
                $query_dtl->select('SUM(ipgd_value) as sumofprotype');
                $query_dtl->andWhere(['ipgd_icvplangoodshdr_fk' => $value['id']]);

                $query_dtl->asArray()->all();

                $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

                $dtlsData = $provider_dtl->getModels();

                $summarylst[strtolower(preg_replace('/\s*/', '', $value['protype_name'])) ] += $dtlsData[0]['sumofprotype'];
            }

            // print_r($summarylst);die();
            //Service Summary
            $squery = IcvplanservicehdrTbl::find();
            $squery->select('icvplanservicehdr_tbl.icvplanservicehdr_pk as id,
                icvplanservicehdr_tbl.ipsh_icvplanmetrictypemst_fk as protype,
                icvplanmetrictypemst_tbl.ipmtm_typename as protype_name');
            $squery->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = icvplanservicehdr_tbl.ipsh_icvplanmetrictypemst_fk');

            $squery->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk');

            if ($quotationId)
            {
                $squery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);
            }

            $slistofData = $squery->asArray()->addOrderBy(['id' => SORT_ASC])->all();

            foreach ($slistofData as $key => $value)
            {
                $query_dtl = IcvplanservicedtlTbl::find();
                $query_dtl->select('SUM(ipsd_value) as sumofsprotype');
                $query_dtl->andWhere('ipsd_icvplanservicehdr_fk=:hdrfk', array(
                    ':hdrfk' => $value['id']
                ));

                $query_dtl->asArray()->all();

                $provider_dtl = new ActiveDataProvider(['query' => $query_dtl]);

                $dtlsData = $provider_dtl->getModels();

                $summarylst[strtolower(preg_replace('/\s*/', '', 's' . $value['protype_name'])) ] += $dtlsData[0]['sumofsprotype'];
            }

            //Investement Summary
            

            $query = IcvplaninvestdtlTbl::find();
            $query->select("*");

            $query->leftJoin('icvplaninvesthdr_tbl a', 'icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk = a.icvplaninvesthdr_pk');

            $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk = a.ipih_icvplanmetrictypemst_fk');

            $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = a.ipih_icvplanbasehdr_fk');

            if ($quotationId)
            {
                $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);
            }

            $query->orderBy('ipid_year ASC');

            $query->asArray();

            $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 50]]);

            $investmentData = $provider->getModels();

            //print_r($investmentData);die();
            foreach ($investmentData as $key => $value)
            {

                $query_inv = IcvplaninvestdtlTbl::find();
                $query_inv->select("SUM(ipid_value) as invsummary");

                $query_inv->leftJoin("icvplaninvesthdr_tbl", "icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk = icvplaninvesthdr_tbl.icvplaninvesthdr_pk");

                $query_inv->andWhere(['ipih_icvplanmetrictypemst_fk' => $value['ipih_icvplanmetrictypemst_fk'], 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk' => $value['ipih_icvplanbasehdr_fk']]);

                $query_inv->asArray();

                $provider_inv = new ActiveDataProvider(['query' => $query_inv]);

                $investmentData = $provider_inv->getModels();

                $summarylst[strtolower(preg_replace('/\s*/', '', $value['ipmtm_typename'])) ] = $investmentData[0]['invsummary'];

            }

            //print_r($summarylst);die();
            //Workforce Summary
            $query = IcvplanwfspendhdrTbl::find();
            $query->select("icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk as id,
                (CASE WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 1 THEN  'Contractor' WHEN `icvplanwfspendhdr_tbl`.`ipwsh_type` = 2 THEN  'Sub-Contractor' ELSE '' END)as cont_subcont,
                
                icvplanmetrictypemst_tbl.ipmtm_typename as workforce_cat
                ");
            $query->leftJoin('icvplanmetrictypemst_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanmetrictypemst_fk = icvplanmetrictypemst_tbl.icvplanmetrictypemst_pk');

            $query->leftJoin('icvplanbasehdr_tbl', 'icvplanbasehdr_tbl.icvplanbasehdr_pk = icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk');

            if ($quotationId)
            {
                $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);
            }

            $wfspendData = $query->asArray()->addOrderBy(['id' => SORT_ASC])->all();

            //print_r($wfspendData);die;
            foreach ($wfspendData as $key => $value)
            {
                $query_dtl = IcvplanwfspenddtlTbl::find();
                $query_dtl->select('*');
                $query_dtl->andWhere('ipwsd_icvplanwfspendhdr_fk=:hdrfk', array(
                    ':hdrfk' => $value['id']
                ));

                $dtlsData = $query_dtl->asArray()->all();

                $wfspendData[$key]['shd'] = $dtlsData[0]['ipwsd_value'];
                $wfspendData[$key]['smhd'] = $dtlsData[1]['ipwsd_value'];
                $wfspendData[$key]['scp'] = $dtlsData[2]['ipwsd_value'];

                $wfspendData[$key]['mhd'] = $dtlsData[3]['ipwsd_value'];
                $wfspendData[$key]['mmhd'] = $dtlsData[4]['ipwsd_value'];
                $wfspendData[$key]['mcp'] = $dtlsData[5]['ipwsd_value'];

                $wfspendData[$key]['jhd'] = $dtlsData[6]['ipwsd_value'];
                $wfspendData[$key]['jmhd'] = $dtlsData[7]['ipwsd_value'];
                $wfspendData[$key]['jcp'] = $dtlsData[8]['ipwsd_value'];

                $wfspendData[$key]['tphd'] = $dtlsData[9]['ipwsd_value'];
                $wfspendData[$key]['tpmhd'] = $dtlsData[10]['ipwsd_value'];
                $wfspendData[$key]['tpcp'] = $dtlsData[11]['ipwsd_value'];

                $wfspendData[$key]['thd'] = $dtlsData[12]['ipwsd_value'];
                $wfspendData[$key]['tmhd'] = $dtlsData[13]['ipwsd_value'];
                $wfspendData[$key]['tcp'] = $dtlsData[14]['ipwsd_value'];

                $wfspendData[$key]['skhd'] = $dtlsData[15]['ipwsd_value'];
                $wfspendData[$key]['skmhd'] = $dtlsData[16]['ipwsd_value'];
                $wfspendData[$key]['skcp'] = $dtlsData[17]['ipwsd_value'];
            }

            $wfspendData[4]['id'] = 4;
            $wfspendData[4]['cont_subcont'] = "Total";
            $wfspendData[4]['workforce_cat'] = "Omani";
            $wfspendData[4]['shd'] = $wfspendData[0]['shd'] + $wfspendData[2]['shd'];
            $wfspendData[4]['smhd'] = $wfspendData[0]['smhd'] + $wfspendData[2]['smhd'];
            $wfspendData[4]['scp'] = $wfspendData[0]['scp'] * $wfspendData[0]['smhd'] + $wfspendData[2]['scp'] * $wfspendData[2]['smhd'];

            $wfspendData[4]['mhd'] = $wfspendData[0]['mhd'] + $wfspendData[2]['mhd'];
            $wfspendData[4]['mmhd'] = $wfspendData[0]['mmhd'] + $wfspendData[2]['mmhd'];
            $wfspendData[4]['mcp'] = $wfspendData[0]['mcp'] * $wfspendData[0]['mmhd'] + $wfspendData[2]['mcp'] * $wfspendData[2]['mmhd'];

            $wfspendData[4]['jhd'] = $wfspendData[0]['jhd'] + $wfspendData[2]['jhd'];
            $wfspendData[4]['jmhd'] = $wfspendData[0]['jmhd'] + $wfspendData[2]['jmhd'];
            $wfspendData[4]['jcp'] = $wfspendData[0]['jcp'] * $wfspendData[0]['jmhd'] + $wfspendData[2]['jcp'] * $wfspendData[2]['jmhd'];

            $wfspendData[4]['tphd'] = $wfspendData[0]['tphd'] + $wfspendData[2]['tphd'];
            $wfspendData[4]['tpmhd'] = $wfspendData[0]['tpmhd'] + $wfspendData[2]['tpmhd'];
            $wfspendData[4]['tpcp'] = $wfspendData[0]['tpcp'] * $wfspendData[0]['tpmhd'] + $wfspendData[2]['tpcp'] * $wfspendData[2]['tpmhd'];

            $wfspendData[4]['thd'] = $wfspendData[0]['thd'] + $wfspendData[2]['thd'];
            $wfspendData[4]['tmhd'] = $wfspendData[0]['tmhd'] + $wfspendData[2]['tmhd'];
            $wfspendData[4]['tcp'] = $wfspendData[0]['tcp'] * $wfspendData[0]['tmhd'] + $wfspendData[2]['tcp'] * $wfspendData[2]['tmhd'];

            $wfspendData[4]['skhd'] = $wfspendData[0]['skhd'] + $wfspendData[2]['skhd'];
            $wfspendData[4]['skmhd'] = $wfspendData[0]['skmhd'] + $wfspendData[2]['skmhd'];
            $wfspendData[4]['skcp'] = $wfspendData[0]['skcp'] * $wfspendData[0]['skmhd'] + $wfspendData[2]['skcp'] * $wfspendData[2]['skmhd'];

            $wfspendData[5]['id'] = 5;
            $wfspendData[5]['cont_subcont'] = "";
            $wfspendData[5]['workforce_cat'] = "Expatriates";
            $wfspendData[5]['shd'] = $wfspendData[1]['shd'] + $wfspendData[3]['shd'];
            $wfspendData[5]['smhd'] = $wfspendData[1]['smhd'] + $wfspendData[3]['smhd'];
            $wfspendData[5]['scp'] = $wfspendData[1]['scp'] * $wfspendData[1]['smhd'] + $wfspendData[3]['scp'] * $wfspendData[3]['smhd'];

            $wfspendData[5]['mhd'] = $wfspendData[1]['mhd'] + $wfspendData[3]['mhd'];
            $wfspendData[5]['mmhd'] = $wfspendData[1]['mmhd'] + $wfspendData[3]['mmhd'];
            $wfspendData[5]['mcp'] = $wfspendData[1]['mcp'] * $wfspendData[1]['mmhd'] + $wfspendData[3]['mcp'] * $wfspendData[3]['mmhd'];

            $wfspendData[5]['jhd'] = $wfspendData[1]['jhd'] + $wfspendData[3]['jhd'];
            $wfspendData[5]['jmhd'] = $wfspendData[1]['jmhd'] + $wfspendData[3]['jmhd'];
            $wfspendData[5]['jcp'] = $wfspendData[1]['jcp'] * $wfspendData[1]['jmhd'] + $wfspendData[3]['jcp'] * $wfspendData[3]['jmhd'];

            $wfspendData[5]['tphd'] = $wfspendData[1]['tphd'] + $wfspendData[3]['tphd'];
            $wfspendData[5]['tpmhd'] = $wfspendData[1]['tpmhd'] + $wfspendData[3]['tpmhd'];
            $wfspendData[5]['tpcp'] = $wfspendData[1]['tpcp'] * $wfspendData[1]['tpmhd'] + $wfspendData[3]['tpcp'] * $wfspendData[3]['tpmhd'];

            $wfspendData[5]['thd'] = $wfspendData[1]['thd'] + $wfspendData[3]['thd'];
            $wfspendData[5]['tmhd'] = $wfspendData[1]['tmhd'] + $wfspendData[3]['tmhd'];
            $wfspendData[5]['tcp'] = $wfspendData[1]['tcp'] * $wfspendData[1]['tmhd'] + $wfspendData[3]['tcp'] * $wfspendData[3]['tmhd'];

            $wfspendData[5]['skhd'] = $wfspendData[1]['skhd'] + $wfspendData[3]['skhd'];
            $wfspendData[5]['skmhd'] = $wfspendData[1]['skmhd'] + $wfspendData[3]['skmhd'];
            $wfspendData[5]['skcp'] = $wfspendData[1]['skcp'] * $wfspendData[1]['skmhd'] + $wfspendData[3]['skcp'] * $wfspendData[3]['skmhd'];

            $summarylst['omanheadcount'] = $wfspendData[4]['shd'] + $wfspendData[4]['mhd'] + $wfspendData[4]['jhd'] + $wfspendData[4]['tphd'] + $wfspendData[4]['thd'] + $wfspendData[4]['skhd'];

            $summarylst['omanmanhour'] = $wfspendData[4]['smhd'] + $wfspendData[4]['mmhd'] + $wfspendData[4]['jmhd'] + $wfspendData[4]['tpmhd'] + $wfspendData[4]['tmhd'] + $wfspendData[4]['skmhd'];

            $summarylst['omanpayroll'] = $wfspendData[4]['scp'] + $wfspendData[4]['mcp'] + $wfspendData[4]['jcp'] + $wfspendData[4]['tpcp'] + $wfspendData[4]['tcp'] + $wfspendData[4]['skcp'];

            $summarylst['expatriateheadcount'] = $wfspendData[5]['shd'] + $wfspendData[5]['mhd'] + $wfspendData[5]['jhd'] + $wfspendData[5]['tphd'] + $wfspendData[5]['thd'] + $wfspendData[5]['skhd'];

            $summarylst['expatriatemanhour'] = $wfspendData[5]['smhd'] + $wfspendData[5]['mmhd'] + $wfspendData[5]['jmhd'] + $wfspendData[5]['tpmhd'] + $wfspendData[5]['tmhd'] + $wfspendData[5]['skmhd'];

            $summarylst['expatriatepayroll'] = $wfspendData[5]['scp'] + $wfspendData[5]['mcp'] + $wfspendData[5]['jcp'] + $wfspendData[5]['tpcp'] + $wfspendData[5]['tcp'] + $wfspendData[5]['skcp'];

            $summarytotal = array(
                'goodstotal' => 0,
                'servicetotal' => 0,
                'workforcetotal' => 0,
                'investmenttotal' => 0
            );

            //print_r($summarylst);die();
            $summarytotal['goodstotal'] = $summarylst['madeinoman'] + $summarylst['nationalsuppliers'] + $summarylst['internationalsuppliers'];

            $summarytotal['servicetotal'] = $summarylst['snationalsuppliers'] + $summarylst['sinternationalsuppliers'];

            $summarytotal['workforcetotal'] = $summarylst['omanpayroll'] + $summarylst['expatriatepayroll'];

            $summarytotal['investmenttotal'] = $summarylst['futureinvestment'] + $summarylst['existinginvestment'];

            //print_r($summarylst);die();
            $summarpercentage = array(
                'madeinomanpercentage' => 0,
                'nationalsupplierpercentage' => 0,
                'internationalsupplierpercentage' => 0,
                'snationalsupplierpercentage' => 0,
                'sinternationalsupplierpercentage' => 0,
                'futureinvestmentpercentage' => 0,
                'existinginvestmentpercentage' => 0,
                'omanheadcountpercentage' => 0,
                'omanmanhourpercentage' => 0,
                'omanpayrollpercentage' => 0,
                'expatriateheadcountpercentage' => 0,
                'expatriatemanhourpercentage' => 0,
                'expatriatepayrollpercentage' => 0
            );
            if ($summarytotal['goodstotal'] != 0)
            {
                $summarpercentage['madeinomanpercentage'] = ($summarylst['madeinoman'] / $summarytotal['goodstotal']) * 100;
                $summarpercentage['nationalsupplierpercentage'] = ($summarylst['nationalsuppliers'] / $summarytotal['goodstotal']) * 100;
                $summarpercentage['internationalsupplierpercentage'] = ($summarylst['internationalsuppliers'] / $summarytotal['goodstotal']) * 100;
            }

            if ($summarytotal['servicetotal'] != 0)
            {
                $summarpercentage['snationalsupplierpercentage'] = ($summarylst['snationalsuppliers'] / $summarytotal['servicetotal']) * 100;
                $summarpercentage['sinternationalsupplierpercentage'] = ($summarylst['sinternationalsuppliers'] / $summarytotal['servicetotal']) * 100;
            }

            if ($summarytotal['workforcetotal'] != 0)
            {
                $summarpercentage['omanheadcountpercentage'] = $summarylst['omanheadcount'] / ($summarylst['omanheadcount'] + $summarylst['expatriateheadcount']) * 100;

                $summarpercentage['omanmanhourpercentage'] = $summarylst['omanmanhour'] / ($summarylst['omanmanhour'] + $summarylst['expatriatemanhour']) * 100;

                $summarpercentage['omanpayrollpercentage'] = $summarylst['omanpayroll'] / ($summarylst['omanpayroll'] + $summarylst['expatriatepayroll']) * 100;

                $summarpercentage['expatriateheadcountpercentage'] = $summarylst['expatriateheadcount'] / ($summarylst['omanheadcount'] + $summarylst['expatriateheadcount']) * 100;

                $summarpercentage['expatriatemanhourpercentage'] = $summarylst['expatriatemanhour'] / ($summarylst['omanmanhour'] + $summarylst['expatriatemanhour']) * 100;

                $summarpercentage['expatriatepayrollpercentage'] = $summarylst['expatriatepayroll'] / ($summarylst['omanpayroll'] + $summarylst['expatriatepayroll']) * 100;

            }

            if ($summarytotal['investmenttotal'] != 0)
            {
                $summarpercentage['futureinvestmentpercentage'] = ($summarylst['futureinvestment'] / $summarytotal['investmenttotal']) * 100;
                $summarpercentage['existinginvestmentpercentage'] = ($summarylst['existinginvestment'] / $summarytotal['investmenttotal']) * 100;
            }

            $plannedicv = array(
                'categoeryname' => 'Planned ICV Spend',
                'goodstotal' => 0,
                'goodsforeigncomp' => 0,
                'servicenattotal' => 0,
                'serviceintnattotal' => 0,
                'workforcetotaloman' => 0,
                'workforcetotalexp' => 0,
                'newinvestmenttotal' => 0,
                'existinvestmenttotal' => 0

            );

            if ($summarytotal['goodstotal'] != 0)
            {
                $plannedicv['goodstotal'] = $summarylst['madeinoman'] + $summarylst['nationalsuppliers'];
                $plannedicv['goodsforeigncomp'] = ($plannedicv['goodstotal'] / $summarytotal['goodstotal']) * 100;
            }

            if ($summarytotal['servicetotal'] != 0)
            {
                $plannedicv['servicenattotal'] = $summarylst['snationalsuppliers'];
                $plannedicv['serviceintnattotal'] = ($plannedicv['servicenattotal'] / $summarytotal['servicetotal']) * 100;
            }

            if ($summarytotal['workforcetotal'])
            {
                $plannedicv['workforcetotaloman'] = $summarylst['omanpayroll'];
                $plannedicv['workforcetotalexp'] = ($plannedicv['workforcetotaloman'] / $summarytotal['workforcetotal']) * 100;
            }

            if ($summarytotal['investmenttotal'])
            {
                $plannedicv['newinvestmenttotal'] = $summarylst['futureinvestment'];
                $plannedicv['existinvestmenttotal'] = ($plannedicv['newinvestmenttotal'] / $summarytotal['investmenttotal']) * 100;
            }

            return ['summarylst' => [$summarylst], 'summarpercentage' => [$summarpercentage], 'total' => [$summarytotal], 'plannedicv' => [$plannedicv], 'viewData' => $viewData, ];
        }
        else
        {
            return ['summarylst' => null];
        }
    }

    public function actionIcvactualspenddata()
    {

        //print_r($quot_id);die();
        $icvActualSpend = array();

        $quotationId = Yii::$app->getRequest()->getQueryParam('quotationid');

        // if(isset($quot_id)) {
        //     $quotationId = 71;
        // }
        //print_r($quotationId);die();
        //Goods Actual and Spend Data
        $query = IcvplangoodsdtlTbl::find();

        $query->select('SUM(ipgd_value) as sum');

        $query->leftJoin('icvplangoodshdr_tbl', 'icvplangoodshdr_tbl.icvplangoodshdr_pk = icvplangoodsdtl_tbl.ipgd_icvplangoodshdr_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        $query->asArray()->all();
        $goodsplanned = new ActiveDataProvider(['query' => $query]);
        $goodsPlanData = $goodsplanned->getModels();

        if (empty($goodsPlanData))
        {
            $goodsPlanData[0]['sum'] = "0.00";
        }
        // print_r($goodsPlanData);die();
        $gquery_spend = IcvplangoodsdtlTbl::find();
        $gquery_spend->select('SUM(ipgd_value) as sum');

        $gquery_spend->leftJoin('icvplangoodshdr_tbl', 'icvplangoodshdr_tbl.icvplangoodshdr_pk = icvplangoodsdtl_tbl.ipgd_icvplangoodshdr_fk');

        $gquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $gquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $gquery_spend->asArray()->all();
        $goodsspend = new ActiveDataProvider(['query' => $gquery_spend]);
        $goodsSpendData = $goodsspend->getModels();

        if (empty($goodsSpendData))
        {
            $goodsSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, ['icplanheadlabel' => 'Goods', 'plannedamt' => $goodsPlanData[0]['sum'], 'actspendamt' => $goodsSpendData[0]['sum']]);
        //Service Actual and Spend Data
        $squery = IcvplanservicedtlTbl::find();

        $squery->select('SUM(ipsd_value) as sum');

        $squery->leftJoin('icvplanservicehdr_tbl', 'icvplanservicehdr_tbl.icvplanservicehdr_pk = icvplanservicedtl_tbl.ipsd_icvplanservicehdr_fk');

        $squery->leftJoin('icvplanbasehdr_tbl', 'icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        $squery->asArray()->all();
        $serviceplanned = new ActiveDataProvider(['query' => $squery]);
        $servicePlanData = $serviceplanned->getModels();

        if (empty($servicePlanData))
        {
            $servicePlanData[0]['sum'] = "0.00";
        }

        $squery_spend = IcvplanservicedtlTbl::find();
        $squery_spend->select('SUM(ipsd_value) as sum');

        $squery_spend->leftJoin('icvplanservicehdr_tbl', 'icvplanservicehdr_tbl.icvplanservicehdr_pk = icvplanservicedtl_tbl.ipsd_icvplanservicehdr_fk');

        $squery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $squery_spend->asArray()->all();
        $servicespend = new ActiveDataProvider(['query' => $squery_spend]);
        $serviceSpendData = $servicespend->getModels();

        if (empty($serviceSpendData))
        {
            $serviceSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Services',
            'plannedamt' => $servicePlanData[0]['sum'],
            'actspendamt' => $serviceSpendData[0]['sum']
        ));

        //Workforce Spend Actual and Spend Data
        $wfsquery = IcvplanwfspenddtlTbl::find();

        $wfsquery->select('SUM(ipwsd_value) as sum');

        $wfsquery->leftJoin('icvplanwfspendhdr_tbl', 'icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk = icvplanwfspenddtl_tbl.ipwsd_icvplanwfspendhdr_fk');

        $wfsquery->leftJoin('icvplanbasehdr_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfsquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        $wfsquery->asArray()->all();
        $workforceplanned = new ActiveDataProvider(['query' => $wfsquery]);
        $workforcePlanData = $workforceplanned->getModels();

        $tempMultiplicationArray = array();
        $tempSumArray = array();
        $finalSumArray = array();

        foreach ($workforcePlanData as $dataKey => $dataVal)
        {
            $modKey = $dataKey % 3;
            if ($modKey == 0 && $dataKey != 0)
            {
                $sumOfTemp = array_product($tempMultiplicationArray);
                array_push($finalSumArray, $sumOfTemp);
                $tempMultiplicationArray = [];
            }
            if($modKey != 0) {
                array_push($tempMultiplicationArray, $dataVal['sum']);
            }
        }

        if (!empty($finalSumArray))
        {
            $workforcePlanData[0]['sum'] = array_sum($finalSumArray);
        }
        else
        {
            $workforcePlanData[0]['sum'] = "0.00";
        }

        $wfspendactualquery = IcvplanwfspenddtlTbl::find();

        $wfspendactualquery->select('SUM(ipwsd_value) as sum');

        $wfspendactualquery->leftJoin('icvplanwfspendhdr_tbl', 'icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk = icvplanwfspenddtl_tbl.ipwsd_icvplanwfspendhdr_fk');

        $wfspendactualquery->leftJoin('icvplanbasehdr_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfspendactualquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $wfspendactualquery->asArray()->all();
        $workforcespendplanned = new ActiveDataProvider(['query' => $wfspendactualquery]);
        $workforcespendPlanData = $workforcespendplanned->getModels();

        foreach ($workforcespendPlanData as $dataKey => $dataVal)
        {
            $modKey = $dataKey % 3;
            if ($modKey == 0 && $dataKey != 0)
            {
                $sumOfTemp = array_product($tempMultiplicationArray);
                array_push($finalSumArray, $sumOfTemp);
                $tempMultiplicationArray = [];
            }
            if($modKey != 0) {
                array_push($tempMultiplicationArray, $dataVal['sum']);
            }
        }

        if (!empty($finalSumArray))
        {
            $workforcespendPlanData[0]['sum'] = array_sum($finalSumArray);
        }
        else
        {
            $workforcespendPlanData[0]['sum'] = "0.00";
        }
        // print_r($workforcePlanData);die();
        //Workforce Head Plan Actual and Spend Data
        $wfhquery_spend = IcvplanwfheadcountdtlTbl::find();
        $wfhquery_spend->select('SUM(ipwhcd_value) as sum');

        $wfhquery_spend->leftJoin('icvplanwfheadcounthdr_tbl', 'icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk = icvplanwfheadcountdtl_tbl.ipwhcd_icvplanwfheadcounthdr_fk');

        $wfhquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfhquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        $wfhquery_spend->asArray()->all();
        $wfheadspend = new ActiveDataProvider(['query' => $wfhquery_spend]);
        $wfHeadSpendData = $wfheadspend->getModels();

        if (empty($wfHeadSpendData))
        {
            $wfHeadSpendData[0]['sum'] = "0.00";
        }

        $wfhtypetwoquery_spend = IcvplanwfheadcountdtlTbl::find();
        $wfhtypetwoquery_spend->select('SUM(ipwhcd_value) as sum');

        $wfhtypetwoquery_spend->leftJoin('icvplanwfheadcounthdr_tbl', 'icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk = icvplanwfheadcountdtl_tbl.ipwhcd_icvplanwfheadcounthdr_fk');

        $wfhtypetwoquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfhtypetwoquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $wfhtypetwoquery_spend->asArray()->all();
        $wfheadtypetwospend = new ActiveDataProvider(['query' => $wfhtypetwoquery_spend]);
        $wfHeadtypetwoSpendData = $wfheadtypetwospend->getModels();

        if (empty($wfHeadtypetwoSpendData))
        {
            $wfHeadtypetwoSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Workforce',
            'plannedamt' => $wfHeadSpendData[0]['sum'] + $workforcePlanData[0]['sum'],
            'actspendamt' => $wfHeadtypetwoSpendData[0]['sum'] + $workforcespendPlanData[0]['sum']
        ));

        //Investment Actual and Spend Data
        $squery = IcvplaninvestdtlTbl::find();

        $squery->select('SUM(ipid_value) as sum');

        $squery->leftJoin('icvplaninvesthdr_tbl', 'icvplaninvesthdr_tbl.icvplaninvesthdr_pk = icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk');

        $squery->leftJoin('icvplanbasehdr_tbl', 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        $squery->asArray()->all();
        $investmentplanned = new ActiveDataProvider(['query' => $squery]);
        $investmentPlanData = $investmentplanned->getModels();

        if (empty($investmentPlanData))
        {
            $investmentPlanData[0]['sum'] = "0.00";
        }

        $invquery = IcvplaninvestdtlTbl::find();

        $invquery->select('SUM(ipid_value) as sum');

        $invquery->leftJoin('icvplaninvesthdr_tbl', 'icvplaninvesthdr_tbl.icvplaninvesthdr_pk = icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk');

        $invquery->leftJoin('icvplanbasehdr_tbl', 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $invquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $invquery->asArray()->all();
        $investmentspend = new ActiveDataProvider(['query' => $invquery]);
        $investmentSpendData = $investmentspend->getModels();

        if (empty($investmentSpendData))
        {
            $investmentSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Investment',
            'plannedamt' => $investmentPlanData[0]['sum'],
            'actspendamt' => $investmentSpendData[0]['sum']
        ));

        //print_r($icvActualSpend);die();
        return ['items' => $icvActualSpend];
    }

    public function actionIcvactualspenddataforoverview($quotationId, $year, $quarter)
    {

        //print_r($quotationId);die();
        $icvActualSpend = array();

        //Goods Actual and Spend Data
        $query = IcvplangoodsdtlTbl::find();

        $query->select('SUM(ipgd_value) as sum');

        $query->leftJoin('icvplangoodshdr_tbl', 'icvplangoodshdr_tbl.icvplangoodshdr_pk = icvplangoodsdtl_tbl.ipgd_icvplangoodshdr_fk');

        $query->leftJoin('icvplanbasehdr_tbl', 'icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $query->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        if (!empty($year) && !empty($quarter))
        {
            $query->andWhere(['ipgd_year' => $year, 'ipgd_quarter' => $quarter]);
        }

        $query->asArray()->all();
        $goodsplanned = new ActiveDataProvider(['query' => $query]);
        $goodsPlanData = $goodsplanned->getModels();

        if (empty($goodsPlanData))
        {
            $goodsPlanData[0]['sum'] = "0.00";
        }
        //print_r($goodsPlanData);die();
        $gquery_spend = IcvplangoodsdtlTbl::find();
        $gquery_spend->select('SUM(ipgd_value) as sum');

        $gquery_spend->leftJoin('icvplangoodshdr_tbl', 'icvplangoodshdr_tbl.icvplangoodshdr_pk = icvplangoodsdtl_tbl.ipgd_icvplangoodshdr_fk');

        $gquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplangoodshdr_tbl.ipgh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $gquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        if (!empty($year) && !empty($quarter))
        {
            $gquery_spend->andWhere(['ipgd_year' => $year, 'ipgd_quarter' => $quarter]);
        }
        $gquery_spend->asArray()->all();
        $goodsspend = new ActiveDataProvider(['query' => $gquery_spend]);
        $goodsSpendData = $goodsspend->getModels();

        if (empty($goodsSpendData))
        {
            $goodsSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, ['icplanheadlabel' => 'Goods', 'plannedamt' => $goodsPlanData[0]['sum'], 'actspendamt' => $goodsSpendData[0]['sum']]);

        //print_r($icvActualSpend);die();
        //Service Actual and Spend Data
        $squery = IcvplanservicedtlTbl::find();

        $squery->select('SUM(ipsd_value) as sum');

        $squery->leftJoin('icvplanservicehdr_tbl', 'icvplanservicehdr_tbl.icvplanservicehdr_pk = icvplanservicedtl_tbl.ipsd_icvplanservicehdr_fk');

        $squery->leftJoin('icvplanbasehdr_tbl', 'icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        if (!empty($year) && !empty($quarter))
        {
            $squery->andWhere(['ipsd_year' => $year, 'ipsd_quarter' => $quarter]);
        }
        $squery->asArray()->all();
        $serviceplanned = new ActiveDataProvider(['query' => $squery]);
        $servicePlanData = $serviceplanned->getModels();

        if (empty($servicePlanData))
        {
            $servicePlanData[0]['sum'] = "0.00";
        }

        $squery_spend = IcvplanservicedtlTbl::find();
        $squery_spend->select('SUM(ipsd_value) as sum');

        $squery_spend->leftJoin('icvplanservicehdr_tbl', 'icvplanservicehdr_tbl.icvplanservicehdr_pk = icvplanservicedtl_tbl.ipsd_icvplanservicehdr_fk');

        $squery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanservicehdr_tbl.ipsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        if (!empty($year) && !empty($quarter))
        {
            $squery_spend->andWhere(['ipsd_year' => $year, 'ipsd_quarter' => $quarter]);
        }

        $squery_spend->asArray()->all();
        $servicespend = new ActiveDataProvider(['query' => $squery_spend]);
        $serviceSpendData = $servicespend->getModels();

        if (empty($serviceSpendData))
        {
            $serviceSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Services',
            'plannedamt' => $servicePlanData[0]['sum'],
            'actspendamt' => $serviceSpendData[0]['sum']
        ));

        //print_r($icvActualSpend);die();
        //Workforce Spend Actual and Spend Data
        $wfsquery = IcvplanwfspenddtlTbl::find();

        //$wfsquery->select('SUM(ipwsd_value) as sum');
        $wfsquery->select('ipwsd_value as sum');

        $wfsquery->leftJoin('icvplanwfspendhdr_tbl', 'icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk = icvplanwfspenddtl_tbl.ipwsd_icvplanwfspendhdr_fk');

        $wfsquery->leftJoin('icvplanbasehdr_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfsquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        // if(!empty($year) && !empty($quarter)) {
        //     $wfsquery->andWhere(['ipsd_year' => $year,'ipsd_quarter' =>$quarter]);
        // }
        $wfsquery->asArray()->all();
        $workforceplanned = new ActiveDataProvider(['query' => $wfsquery, 'pagination' => ['pageSize' => 100]]);
        $workforcePlanData = $workforceplanned->getModels();

        $tempMultiplicationArray = array();
        $tempSumArray = array();
        $finalSumArray = array();

        foreach ($workforcePlanData as $dataKey => $dataVal)
        {
            $modKey = $dataKey % 3;
            if ($modKey == 0 && $dataKey != 0)
            {   
                $sumOfTemp = array_product($tempMultiplicationArray);
                array_push($finalSumArray, $sumOfTemp);
                $tempMultiplicationArray = [];        
            }
            if($modKey != 0) {
                array_push($tempMultiplicationArray, $dataVal['sum']);    
            }   
        }
        if (!empty($finalSumArray))
        {
            $workforcePlanData[0]['sum'] = array_sum($finalSumArray);
        }
        else
        {
            $workforcePlanData[0]['sum'] = "0.00";
        }

        $wfspendactualquery = IcvplanwfspenddtlTbl::find();

        $wfspendactualquery->select('SUM(ipwsd_value) as sum');

        $wfspendactualquery->leftJoin('icvplanwfspendhdr_tbl', 'icvplanwfspendhdr_tbl.icvplanwfspendhdr_pk = icvplanwfspenddtl_tbl.ipwsd_icvplanwfspendhdr_fk');

        $wfspendactualquery->leftJoin('icvplanbasehdr_tbl', 'icvplanwfspendhdr_tbl.ipwsh_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfspendactualquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        $wfspendactualquery->asArray()->all();
        $workforcespendplanned = new ActiveDataProvider(['query' => $wfspendactualquery]);
        $workforcespendPlanData = $workforcespendplanned->getModels();

        $tempMultiplicationArray = array();
        $tempSumArray = array();
        $finalSumArray = array();


        foreach ($workforcespendPlanData as $dataKey => $dataVal)
        {
            $modKey = $dataKey % 3;
            if ($modKey == 0 && $dataKey != 0)
            {
                $sumOfTemp = array_product($tempMultiplicationArray);
                array_push($finalSumArray, $sumOfTemp);
                $tempMultiplicationArray = [];
            }
            if($modKey != 0) {
                array_push($tempMultiplicationArray, $dataVal['sum']);
            }
        }

        if (!empty($finalSumArray))
        {
            $workforcespendPlanData[0]['sum'] = array_sum($finalSumArray);
        }
        else
        {
            $workforcespendPlanData[0]['sum'] = "0.00";
        }

        // array_push($icvActualSpend ,array('icplanheadlabel' => 'Workforce',
        //                                 'plannedamt' => $workforcePlanData[0]['sum'],
        //                                 'actspendamt' => $workforcePlanData[0]['sum']));
        //Workforce Head Plan Actual and Spend Data
        $wfhquery_spend = IcvplanwfheadcountdtlTbl::find();
        $wfhquery_spend->select('SUM(ipwhcd_value) as sum');

        $wfhquery_spend->leftJoin('icvplanwfheadcounthdr_tbl', 'icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk = icvplanwfheadcountdtl_tbl.ipwhcd_icvplanwfheadcounthdr_fk');

        $wfhquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfhquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        if (!empty($year) && !empty($quarter))
        {
            $wfhquery_spend->andWhere(['ipwhcd_year' => $year, 'ipwhcd_quarter' => $quarter]);
        }

        $wfhquery_spend->asArray()->all();
        $wfheadspend = new ActiveDataProvider(['query' => $wfhquery_spend]);
        $wfHeadSpendData = $wfheadspend->getModels();

        if (empty($wfHeadSpendData))
        {
            $wfHeadSpendData[0]['sum'] = "0.00";
        }

        $wfhtypetwoquery_spend = IcvplanwfheadcountdtlTbl::find();
        $wfhtypetwoquery_spend->select('SUM(ipwhcd_value) as sum');

        $wfhtypetwoquery_spend->leftJoin('icvplanwfheadcounthdr_tbl', 'icvplanwfheadcounthdr_tbl.icvplanwfheadcounthdr_pk = icvplanwfheadcountdtl_tbl.ipwhcd_icvplanwfheadcounthdr_fk');

        $wfhtypetwoquery_spend->leftJoin('icvplanbasehdr_tbl', 'icvplanwfheadcounthdr_tbl.ipwhch_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $wfhtypetwoquery_spend->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        if (!empty($year) && !empty($quarter))
        {
            $wfhtypetwoquery_spend->andWhere(['ipwhcd_year' => $year, 'ipwhcd_quarter' => $quarter]);
        }

        $wfhtypetwoquery_spend->asArray()->all();
        $wfheadtypetwospend = new ActiveDataProvider(['query' => $wfhtypetwoquery_spend]);
        $wfHeadtypetwoSpendData = $wfheadtypetwospend->getModels();

        if (empty($wfHeadtypetwoSpendData))
        {
            $wfHeadtypetwoSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Workforce',
            'plannedamt' => $wfHeadSpendData[0]['sum'] + $workforcePlanData[0]['sum'],
            'actspendamt' => $wfHeadtypetwoSpendData[0]['sum'] + $workforcespendPlanData[0]['sum']
        ));

        //print_r($icvActualSpend);die();
        //Investment Actual and Spend Data
        $squery = IcvplaninvestdtlTbl::find();

        $squery->select('SUM(ipid_value) as sum');

        $squery->leftJoin('icvplaninvesthdr_tbl', 'icvplaninvesthdr_tbl.icvplaninvesthdr_pk = icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk');

        $squery->leftJoin('icvplanbasehdr_tbl', 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $squery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 1]);

        if (!empty($year) && !empty($quarter))
        {
            $squery->andWhere(['ipid_year' => $year, 'ipid_quarter' => $quarter]);
        }

        $squery->asArray()->all();
        $investmentplanned = new ActiveDataProvider(['query' => $squery]);
        $investmentPlanData = $investmentplanned->getModels();

        //print_r($investmentPlanData);die();
        if (empty($investmentPlanData))
        {
            $investmentPlanData[0]['sum'] = "0.00";
        }

        $invquery = IcvplaninvestdtlTbl::find();

        $invquery->select('SUM(ipid_value) as sum');

        $invquery->leftJoin('icvplaninvesthdr_tbl', 'icvplaninvesthdr_tbl.icvplaninvesthdr_pk = icvplaninvestdtl_tbl.ipid_icvplaninvesthdr_fk');

        $invquery->leftJoin('icvplanbasehdr_tbl', 'icvplaninvesthdr_tbl.ipih_icvplanbasehdr_fk = icvplanbasehdr_tbl.icvplanbasehdr_pk');

        $invquery->andWhere(['icvplanbasehdr_tbl.ipbh_cmsquotationhdr_fk' => $quotationId, 'ipbh_type' => 2]);

        if (!empty($year) && !empty($quarter))
        {
            $invquery->andWhere(['ipid_year' => $year, 'ipid_quarter' => $quarter]);
        }

        $invquery->asArray()->all();
        $investmentspend = new ActiveDataProvider(['query' => $invquery]);
        $investmentSpendData = $investmentspend->getModels();

        if (empty($investmentSpendData))
        {
            $investmentSpendData[0]['sum'] = "0.00";
        }

        array_push($icvActualSpend, array(
            'icplanheadlabel' => 'Investment',
            'plannedamt' => $investmentPlanData[0]['sum'],
            'actspendamt' => $investmentSpendData[0]['sum']
        ));
        //print_r($icvActualSpend);die();
        return ['items' => $icvActualSpend];

    }

    public function actionIcvspendhistory()
    {
        return \backend\models\IcvplanspendTbl::getSpendHistory($_REQUEST);
    }

    public function actionIcvactualvalidation()
    {
        return \backend\models\IcvplanspendTbl::getIcvActualValidation($_REQUEST);
    }

    public function actionUpdateicvvalidationstatus()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);

        return \backend\models\IcvplanspendTbl::Updateicvvalidationstatus($data);
    }

    public function actionGetcommentauditlog()
    {
        return \backend\models\IcvplanspendhstryTbl::getCommentAuditLog($_REQUEST);
    }
}

