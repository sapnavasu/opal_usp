<?php

namespace api\modules\mst\models;

use Yii;

/**
 * This is the ActiveQuery class for [[CertapprovaldtlsTbl]].
 *
 * @see CertapprovaldtlsTbl
 */
class CertapprovaldtlsTblQuery extends \yii\db\ActiveQuery {

    /**
     * {@inheritdoc}
     * @return CertapprovaldtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CertapprovaldtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function movenextlevel($compk, $catsubcatPk) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $total_levels_configrd = \api\modules\mst\models\ApprovalworkflowconfigtrnsTbl::find()->select(['awfct_level as totalLevels'])->asArray()->all();
        
        //get the current level
        $certData = CertapprovaldtlsTbl::find()
                ->where('cad_membercompanymst_fk = :compk', [':compk' => $compk])
                ->orderBy('certapprovaldtls_pk DESC')
                ->one();
        $leveldata = CertcatsubcatapprovaldtlsTbl::find()
                ->where('ccscad_certapprovaldtls_fk = :certpk', [':certpk' => $certData->certapprovaldtls_pk])
                ->asArray()
                ->one();
        $currlevel = $leveldata['ccscad_level'];
        if ($currlevel == NULL || $currlevel == 1) {
            $nextVal = 2;
        } else {
            $nextVal = 3;
        }

        //certcatsubcatapprovaldtls_tbl
        $catsubcatQry = \api\modules\mst\models\CertcatsubcatapprovaldtlsTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        certcatsubcatapprovaldtls_pk,
                        ccscad_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = ccscad_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->all();
        if (!empty($catsubcatQry) && $catsubcatQry['ccscad_level'] < $total_levels_configrd) {
            foreach ($catsubcatQry as $value) {
                $upQry = "UPDATE certcatsubcatapprovaldtls_tbl SET ccscad_movedtonxtlevel = 2, ccscad_nxtlevel = '{$nextVal}', ccscad_level = '{$value['awfct_level']}'"
                        . " WHERE certcatsubcatapprovaldtls_pk = '{$value['certcatsubcatapprovaldtls_pk']}'";
                Yii::$app->db->createCommand($upQry)->execute();
            }
        }
        //certapprovalpardtls_tbl
        $catparQry = \api\modules\mst\models\CertapprovalpardtlsTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        certapprovaltrndtls_pk,
                        catd_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = catd_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->all();
        if (!empty($catparQry) && $catparQry['catd_level'] < $total_levels_configrd) {
            foreach ($catparQry as $value) {
                $upQry = "UPDATE certapprovalpardtls_tbl SET catd_movedtonxtlevel = 2, catd_nxtlevel = '{$nextVal}', catd_level = '{$value['awfct_level']}'"
                        . " WHERE certapprovaltrndtls_pk = '{$value['certapprovaltrndtls_pk']}'";
                Yii::$app->db->createCommand($upQry)->execute();
            }
        }
        //memcomptendbrdapprovalmain_tbl
        $catOtbrQry = \api\modules\mst\models\MemcomptendbrdapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcomptendbrdapprovalmain_pk,
                        mctbam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mctbam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catOtbrQry) && $catOtbrQry['mctbam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcomptendbrdapprovalmain_tbl SET mctbam_movedtonxtlevel = 2, mctbam_nxtlevel = '{$nextVal}', mctbam_level = '{$catOtbrQry['awfct_level']}'"
                    . " WHERE memcomptendbrdapprovalmain_pk = '{$catOtbrQry['memcomptendbrdapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompbranchapprovalmain_tbl
        $catBranchQry = \api\modules\mst\models\MemcompbranchapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompbranchapprovalmain_pk,
                        mcbam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcbam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catBranchQry) && $catBranchQry['mcbam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompbranchapprovalmain_tbl SET mcbam_movedtonxtlevel = 2, mcbam_nxtlevel = '{$nextVal}', mcbam_level = '{$catBranchQry['awfct_level']}'"
                    . " WHERE memcompbranchapprovalmain_pk = '{$catBranchQry['memcompbranchapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompfinancialapprovalmain_tbl
        $catFinancialQry = \api\modules\mst\models\MemcompfinancialapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompfinancialapprovalmain_pk,
                        mcfam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcfam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catFinancialQry) && $catFinancialQry['mcfam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompfinancialapprovalmain_tbl SET mcfam_movedtonxtlevel = 2, mcfam_nxtlevel = '{$nextVal}', mcfam_level = '{$catFinancialQry['awfct_level']}'"
                    . " WHERE memcompfinancialapprovalmain_pk = '{$catFinancialQry['memcompfinancialapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompprodapprovalmain_tbl
        $catProductsQry = \api\modules\mst\models\MemcompprodapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompprodapprovalmain_pk,
                        mcpam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcpam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catProductsQry) && $catProductsQry['mcpam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompprodapprovalmain_tbl SET mcpam_movedtonxtlevel = 2, mcpam_nxtlevel = '{$nextVal}', mcpam_level = '{$catProductsQry['awfct_level']}'"
                    . " WHERE memcompprodapprovalmain_pk = '{$catProductsQry['memcompprodapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompserviceapprovalmain_tbl
        $catServiceQry = \api\modules\mst\models\MemcompserviceapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompserviceapprovalmain_pk,
                        mcsam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcsam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catServiceQry) && $catServiceQry['mcsam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompserviceapprovalmain_tbl SET mcsam_movedtonxtlevel = 2, mcsam_nxtlevel = '{$nextVal}', mcsam_level = '{$catServiceQry['awfct_level']}'"
                    . " WHERE memcompserviceapprovalmain_pk = '{$catServiceQry['memcompserviceapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompbussrcapprovalmain_tbl
        $catBusSrcQry = \api\modules\mst\models\MemcompbussrcapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompbussrcapprovalmain_pk,
                        mcbsam_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcbsam_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catBusSrcQry) && $catBusSrcQry['mcbsam_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompbussrcapprovalmain_tbl SET mcbsam_movedtonxtlevel = 2, mcbsam_nxtlevel = '{$nextVal}', mcbsam_level = '{$catBusSrcQry['awfct_level']}'"
                    . " WHERE memcompbussrcapprovalmain_pk = '{$catBusSrcQry['memcompbussrcapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        //memcompshareholderapprovalmain_tbl
        $catSharholdQry = \api\modules\mst\models\MemcompshareholderapprovalmainTbl::find()
                ->select(
                        "certapprovaldtls_pk,
                        memcompshareholderapprovalmain_pk,
                        mcsham_level,
                        awfct_level,
                        awfuc_usermst_fk"
                )
                ->innerJoin('certapprovaldtls_tbl', 'certapprovaldtls_pk = mcsham_certapprovaldtls_fk')
                ->innerJoin('approvalworkflowconfigtrns_tbl', "approvalworkflowuserconfigtrns_pk = cad_approvalworkflowuserconfigtrns_fk")
                ->innerJoin('approvalworkflowuserconfig_tbl', "approvalworkflowuserconfig_pk = cad_approvalworkflowuserconfig_fk")
                ->where("cad_membercompanymst_fk = :compPk AND awfuc_usermst_fk = :userPk", [':compPk' => $compk, ':userPk' => $userPK])
                ->asArray()
                ->one();
        if (!empty($catSharholdQry) && $catSharholdQry['mcsham_level'] < $total_levels_configrd) {
            $upQry = "UPDATE memcompshareholderapprovalmain_tbl SET mcsham_movedtonxtlevel = 2, mcsham_nxtlevel = '{$nextVal}', mcsham_level = '{$catSharholdQry['awfct_level']}'"
                    . " WHERE memcompshareholderapprovalmain_pk = '{$catSharholdQry['memcompshareholderapprovalmain_pk']}'";
            Yii::$app->db->createCommand($upQry)->execute();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'Done'
        );
        return $result;
    }

}
