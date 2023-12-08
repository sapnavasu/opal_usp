<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsrqprodservtrnxTbl]].
 *
 * @see CmsrqprodservtrnxTbl
 */
class CmsrqprodservtrnxTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmsrqprodservtrnxTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrqprodservtrnxTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public static function Deletemapspec($spctblpk) {
        if (!empty($spctblpk)) {
            \api\modules\pms\models\CmsrqprodservtrnxTbl::deleteAll('cmsrqprodservtrnx_pk=:dtpk', [':dtpk' => $spctblpk]);
        }
        return $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'U',
            'comments' => 'Deleted Successfully!',
        );
    }

    public static function getspeclist($productmstpk, $cmsrqprodservdtlspk) {
        $typOfArr = [1 => 'T', 2 => 'S', 3 => 'C'];
        $restrictArr = [1 => '', 2 => 'characters', 3 => 'alphanumeric', 4 => 'numeric', 5 => 'decimalnumeric', '6' => 'negativedecimal'];
        $predFArr = [];
        $requireCount = \common\models\MemcompprodspecmapmstTbl::find()
                        ->where('mcpsmm_productmst_fk=:prdsp and mcpsmm_ismandatory=:man',
                                [':prdsp' => $productmstpk, ':man' => 1])->count();
        $achievecpount = 0;
        $preDfMdl = \common\models\SpecificationmstTbl::find()->select([
                            'SpecificationMst_Pk', 'SpM_Specification',
                            'memcompprodspecmapmst_pk', 'mcpsmm_spectype', 'mcpsmm_specvalidation', 'mcpsmm_ismandatory', 'mcpsmm_index',
                            'cmsrqprodservtrnx_pk',
                            'memcompspecprodvaldtls_pk', 'mcspvd_parvalue', 'crpst_svd_fk'])->
                        innerJoin('memcompprodspecmapmst_tbl', 'SpecificationMst_Pk = mcpsmm_specificationmst_fk')->
                        leftJoin('cmsrqprodservtrnx_tbl', 'memcompprodspecmapmst_pk=crpst_specmapmst_fk and crpst_cmsprodservdtls_fk=' . $cmsrqprodservdtlspk)
                        ->leftJoin('memcompspecprodvaldtls_tbl', 'crpst_specvaldtls_fk=memcompspecprodvaldtls_pk')
                        ->where('mcpsmm_productmst_fk=:prd ', [':prd' => $productmstpk])->asArray()->all();

        if (!empty($preDfMdl)) {
            foreach ($preDfMdl as $key => $val) {
                $predFArr[$key]['label'] = $val['SpM_Specification'];
                $predFArr[$key]['fieldtype'] = $typOfArr[$val['mcpsmm_spectype']];
                $prevVal = '';
                if ($val['mcspvd_parvalue']) {
                    $prevVal = $val['memcompspecprodvaldtls_pk'] . "prv";
                }
                $predFArr[$key]['fieldname'] = $prevVal . str_replace(' ', '', $val['SpM_Specification']) . 'bgi' . $val['SpecificationMst_Pk'];
                $predFArr[$key]['required'] = $val['mcpsmm_ismandatory'] == 1 ? true : false;
                if (!is_null($val['mcspvd_parvalue']) && !empty($val['mcspvd_parvalue']) && $val['mcpsmm_ismandatory'] == 1) {
                    $achievecpount++;
                }
                $predFArr[$key]['value'] = $val['mcspvd_parvalue'];
                $predFArr[$key]['restrict'] = $restrictArr[$val['mcpsmm_specvalidation']];
                if ($val['mcpsmm_spectype'] == 2 || $val['mcpsmm_spectype'] == 3) {
                    $valDtlsMdloptdynamic = MemcompspecprodvaldtlsTbl::find()->where('mcspvd_specificationmst_fk=:spec 
                    and mcspvd_status=1 and mcspvd_productmst_fk is null',
                                    [':spec' => $val['SpecificationMst_Pk']])
                            ->orderBy('mcspvd_status asc')
                            ->one();

                    if (!empty($valDtlsMdloptdynamic)) {
                        $strOfquery = str_replace(['***', '{', '}'], '', $valDtlsMdloptdynamic->mcspvd_parvalue);
                        $strOfresult = Yii::$app->db->createCommand($strOfquery)->queryAll();
                    } else {
                        $valDtlsMdlopt = MemcompspecprodvaldtlsTbl::find()->select(['mcspvd_parvalue as text', 'memcompspecprodvaldtls_pk as value'])
                                ->where('mcspvd_specificationmst_fk=:spec and mcspvd_status=1 and mcspvd_productmst_fk =:prd',
                                        [':spec' => $val['SpecificationMst_Pk'], ':prd' => $productmstpk])
                                ->orderBy('mcspvd_status asc')->asArray()
                                ->all();
                        $strOfresult = array_values($valDtlsMdlopt);
                    }
                    $predFArr[$key]['options'] = $strOfresult;
                }
            }
        }

        $addMoreSpec = CmsrqprodservtrnxTbl::find()->select(['SpecificationMst_Pk', 'SpM_Specification as pslabel', 'mcspvd_parvalue as psvalue',
                            'memcompspecprodvaldtls_pk', 'cmsrqprodservtrnx_pk'])->innerJoin('memcompspecprodvaldtls_tbl', 'crpst_specvaldtls_fk =memcompspecprodvaldtls_pk')
                        ->innerJoin('specificationmst_tbl', 'mcspvd_specificationmst_fk = SpecificationMst_Pk')
                        ->where('crpst_cmsprodservdtls_fk=:prd and crpst_specmapmst_fk is null', [':prd' => $cmsrqprodservdtlspk])->asArray()->all();
        //$addMoreSpec = [];
        $formvalid = ($requireCount == $achievecpount && $requireCount != 0) ? true : false;
        $returnBoth = ['predefinedms' => $predFArr, 'addmore' => $addMoreSpec, 'formvalid' => $formvalid];
        return $returnBoth;
    }

    public function saveData($data, $cmsprodservdtlspk) {
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $oldspecdata = $data['spacificationData'][1];
        $newspecdata = $data['spacificationData'][0]['pspecifications'];
        $mstpk = $data['formData']['requi_masterPk']; // product master pk 
        $seprator = 'bgi';
        if (!empty($oldspecdata[1])) {
            try {
                $transcation = Yii::$app->db->beginTransaction();
                foreach ($oldspecdata as $key => $val) {
                    $KEYAR = array_keys($oldspecdata[$key])[0];
                    $valspc = array_values($oldspecdata[$key])[0];
                    $keyexplode = explode($seprator, $KEYAR);
                    $prdspsModel = \common\models\MemcompspecprodvaldtlsTbl::find()
                                    ->where('mcspvd_productmst_fk=:prd and mcspvd_specificationmst_fk=:spec and mcspvd_status =2',
                                            [':prd' => $mstpk, ':spec' => $keyexplode[1]] )->orderBy('memcompspecprodvaldtls_pk desc')->one();
                    $mpdMdl = \common\models\MemcompprodspecmapmstTbl::find()
                                    ->where('mcpsmm_productmst_fk=:mstprd and mcpsmm_specificationmst_fk=:spec',
                                            [':mstprd' => $mstpk, ':spec' => $keyexplode[1]])->one();
                    $mapk = $mpdMdl->memcompprodspecmapmst_pk;
                     if (empty($prdspsModel) || strtolower(trim( $prdspsModel->mcspvd_parvalue)) != strtolower(trim($valspc))) {
                        $prdspsModel = new \common\models\MemcompspecprodvaldtlsTbl();
                        $prdspsModel->mcspvd_createdon = date('Y-m-d H:i:s');
                        $prdspsModel->mcspvd_createdby = $userpk;
                        $prdspsModel->mcspvd_memcompprodspecmapmst_fk = $mapk;
                        $prdspsModel->mcspvd_productmst_fk = $mstpk;
                        $prdspsModel->mcspvd_specificationmst_fk = $keyexplode[1];
                        $prdspsModel->mcspvd_parvalue = $valspc;
                        $prdspsModel->mcspvd_status = 2;
                    } else {
                        $prdspsModel->mcspvd_updatedon = date('Y-m-d H:i:s');
                        $prdspsModel->mcspvd_updatedby = $userpk;
                    }
                    $prdspsModel->mcspvd_specificationmst_fk = $keyexplode[1];
                    if ($prdspsModel->save(false)) {
                        $prdSpecMdlPd = CmsrqprodservtrnxTbl::find()
                                        ->where('crpst_cmsprodservdtls_fk=:prdMn and crpst_specmapmst_fk=:map',
                                                [':map' => $mapk, ':prdMn' => $cmsprodservdtlspk])->one();
                        if (empty($prdSpecMdlPd)) {
                            $prdSpecMdlPd = new CmsrqprodservtrnxTbl();
                            $prdSpecMdlPd->crpst_status = 1;
                            $prdSpecMdlPd->crpst_specmapmst_fk = $mapk;
                            $prdSpecMdlPd->crpst_createdby = $userpk;
                            $prdSpecMdlPd->crpst_createdon = date('Y-m-d H:i:s');
                            $prdSpecMdlPd->crpst_createdbyipaddr = \common\components\Common::getIpAddress();
                            $prdSpecMdlPd->crpst_cmsprodservdtls_fk = $cmsprodservdtlspk;
                            $prdSpecMdlPd->crpst_specvaldtls_fk = $prdspsModel->memcompspecprodvaldtls_pk;
                            $prdSpecMdlPd->crpst_svd_fk = 0;
                        } else {
                            $prdSpecMdlPd->crpst_specvaldtls_fk = $prdspsModel->memcompspecprodvaldtls_pk;
                            $prdSpecMdlPd->crpst_cmsprodservdtls_fk = $cmsprodservdtlspk;
                            $prdSpecMdlPd->crpst_updatedon = date('Y-m-d H:i:s');
                            $prdSpecMdlPd->crpst_updatedby = $userpk;
                            $prdSpecMdlPd->crpst_updatedbyipaddr = \common\components\Common::getIpAddress();
                            $prdSpecMdlPd->crpst_specmapmst_fk = $mapk;
                        }
                        $prdSpecMdlPd->save(false);
                    }
                }
                $transcation->commit();
            } catch (Exception $exception) {
                $error[] = $exception->getMessage();
                $transcation->rollBack();
            }
        }
        if (!empty($newspecdata) && !empty($newspecdata[0]['pslabel'])) {

            try {
                $transFrNew = Yii::$app->db->beginTransaction();
                foreach ($newspecdata as $key => $val) {
                    if (!empty($val['pslabel']) && !empty($val['psvalue']))
                        $spcMstModel = \common\models\SpecificationmstTbl::find()
                                        ->where("SpM_SpecCategory='P' and LOWER(trim(SpM_Specification))=:spec and SpM_Status='I'",
                                                [':spec' => strtolower(trim($val['pslabel']))])->one();
                    if (empty($spcMstModel)) {
                        $spcMstModel = new \common\models\SpecificationmstTbl();
                    };
                    $spcMstModel->SpM_SpecCategory = "P";
                    $spcMstModel->SpM_CreatedBy = $userpk;
                    $spcMstModel->SpM_Specification = trim($val['pslabel']);
                    $spcMstModel->SpM_SpecDesc = trim($val['pslabel']);
                    $spcMstModel->SpM_Status = 'I';
                    $spcMstModel->SpM_CreatedOn = date('Y-m-d H:i:s');
                    if ($spcMstModel->save()) {
                        $SpecValdt = \common\models\MemcompspecprodvaldtlsTbl::find()->where('mcspvd_specificationmst_fk=:spec 
                                   and mcspvd_productmst_fk=:prd and LOWER(trim(mcspvd_parvalue))=:val and mcspvd_status=2',
                                        [':spec' => trim($spcMstModel->SpecificationMst_Pk), ':prd' => $mstpk, ':val' => strtolower(trim($val['psvalue'])) ])
                                ->orderBy('memcompspecprodvaldtls_pk desc')
                                ->one();
                        if (empty($SpecValdt)) {
                            $SpecValdt = New \common\models\MemcompspecprodvaldtlsTbl();
                            $SpecValdt->mcspvd_specificationmst_fk = $spcMstModel->SpecificationMst_Pk;
                            $SpecValdt->mcspvd_productmst_fk = $mstpk;
                            $SpecValdt->mcspvd_createdby = $userpk;
                            $SpecValdt->mcspvd_status = '2';
                            $SpecValdt->mcspvd_createdon = date('Y-m-d H:i:s');
                            $SpecValdt->mcspvd_parvalue = $val['psvalue'];
                        } else {
                            $SpecValdt->mcspvd_updatedby = $userpk;
                            $SpecValdt->mcspvd_updatedon = date('Y-m-d H:i:s');
                        }

                        if ($SpecValdt->save()) {
                            $prdScMdl = CmsrqprodservtrnxTbl::findOne($val['spctblpk']);
                            if (!empty($prdScMdl)) {
                                $prdScMdl->crpst_updatedon = date('Y-m-d H:i:s');
                                $prdScMdl->crpst_updatedby = $userpk;
                                $prdScMdl->crpst_updatedbyipaddr = \common\components\Common::getIpAddress();
                            } else {
                                $prdScMdl = new CmsrqprodservtrnxTbl();
                                $prdScMdl->crpst_status = 1;
                                $prdScMdl->crpst_createdon = date('Y-m-d H:i:s');
                                $prdScMdl->crpst_createdby = $userpk;
                                $prdScMdl->crpst_createdbyipaddr = \common\components\Common::getIpAddress();
                            }
                            $prdScMdl->crpst_cmsprodservdtls_fk = $cmsprodservdtlspk;
                            $prdScMdl->crpst_specvaldtls_fk = $SpecValdt->memcompspecprodvaldtls_pk;
                            $prdScMdl->save();
                        }
                    }
                }
                $transFrNew->commit();
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Product & Service Successfully',
                    'moduleData' => $prdScMdl,
                );
            } catch (Exception $exception) {
                $error[] = $exception->getMessage();
                $transFrNew->rollBack();
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong',
                    'returndata' => $error
                );
            }
            return $result;
        }
        return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'No data to save',
                    'moduleData' => $prdScMdl,
                );
    }

}
