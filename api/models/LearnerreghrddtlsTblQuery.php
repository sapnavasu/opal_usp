<?php

namespace app\models;
use Yii;
/**
 * This is the ActiveQuery class for [[LearnerreghrddtlsTbl]].
 *
 * @see LearnerreghrddtlsTbl
 */
class LearnerreghrddtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerreghrddtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getlearnerassessment($batchId, $learnersid = null)
    {
        $model = \app\models\BatchmgmtdtlsTbl::find()->where(['batchmgmtdtls_pk'=>$batchId])->one();

        $q = "SELECT `learnerreghrddtls_pk` as tad_learnerreghrddtls_fk, sir_idnumber, sir_name_en,sir_name_ar, sir_emailid, sir_dob, sir_gender, UT.oum_firstname as th_tutor, UT.opalusermst_pk as th_tutorpk, UP.oum_firstname as pra_tutor, UP.opalusermst_pk as pra_tutorpk,
        UA.oum_firstname as asmt_staff, UA.opalusermst_pk as asmt_staffpk, UI.oum_firstname as ivqastaff, UI.opalusermst_pk as ivqastaffpk, lrhd_feestatus,lrhd_learnerfee, lrhd_paidby, lrhd_batchmgmtdtls_fk as tad_batchmgmtdtls_fk,  ST.*,
        DU.batchmgmtdurationdtls_pk as tad_batchmgmtdurationdtls_fk, BT.batchmgmtthyhdr_pk as tad_batchmgmtthyhdr_fk, BP.batchmgmtpracthdr_pk as tad_batchmgmtpracthdr_fk, TR.trngattdntdtls_pk, `lrhd_status`, LC.lcd_plaincard, LC.lcd_viewcardpath,
        (select rm_name_en from referencemst_tbl where referencemst_pk = COALESCE(group_concat(if(AA.asmtm_internalasmt=1, LM.lasmth_status, NULL )))) as kstatus, 
        (select rm_name_en from referencemst_tbl where referencemst_pk = COALESCE(group_concat(IF(AA.asmtm_internalasmt=2, LM.lasmth_status, NULL)))) as pstatus 
        FROM `learnerreghrddtls_tbl` as LR 
        LEFT JOIN `learnerasmthdr_tbl` as LM ON LR.learnerreghrddtls_pk = LM.lasmth_LearnerRegHrdDtls_FK
        LEFT JOIN `assessmentmst_tbl` as AA ON LM.lasmth_assessmentmst_fk= AA.assessmentmst_pk 
        LEFT JOIN staffinforepo_tbl as ST on LR.lrhd_staffinforepo_fk = ST.staffinforepo_pk
        LEFT JOIN batchmgmtthydtls_tbl as BTD on LR.learnerreghrddtls_pk = BTD.bmtd_learnerreghrddtls_fk
        LEFT JOIN batchmgmtthyhdr_tbl as BT on  BT.batchmgmtthyhdr_pk = BTD.bmtd_batchmgmtthyhdr_fk
        LEFT JOIN opalusermst_tbl as UT on BT.bmth_tutor = UT.opalusermst_pk
        LEFT JOIN batchmgmtpractdtls_tbl as BPD on LR.learnerreghrddtls_pk = BPD.bmpd_learnerreghrddtls_fk
        LEFT JOIN batchmgmtpracthdr_tbl BP on  BP.batchmgmtpracthdr_pk = BPD.bmpd_batchmgmtpracthdr_fk
        LEFT JOIN opalusermst_tbl as UP on BP.bmph_tutor = UP.opalusermst_pk
        LEFT JOIN batchmgmtasmtdtls_tbl as BAD on LR.learnerreghrddtls_pk = BAD.bmad_learnerreghrddtls_fk
        LEFT JOIN batchmgmtasmthdr_tbl BA on  BA.batchmgmtasmthdr_pk = BAD.bmad_batchmgmtasmthdr_fk
        LEFT JOIN opalusermst_tbl as UA on BA.bmah_assessor = UA.opalusermst_pk
        LEFT JOIN opalusermst_tbl as UI on BA.bmah_ivqastaff = UI.opalusermst_pk
        LEFT JOIN batchmgmtdurationdtls_tbl as DU on DU.bmdd_batchmgmtdtls_fk = LR.lrhd_batchmgmtdtls_fk
        LEFT JOIN learnercarddtls_tbl as LC on LR.learnerreghrddtls_pk = LC.lcd_learnerreghrddtls_fk AND lcd_status = 1"  ;
        if($model->bmd_status == 2){
            $q = $q . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk and tad_trngdate = " . date("Y-m-d"). " and tad_batchmgmtpracthdr_fk = BT.batchmgmtthyhdr_pk ";
        } else if($model->bmd_status == 3){
            $q = $q . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk and tad_trngdate = " . date("Y-m-d"). " and tad_batchmgmtpracthdr_fk = BT.batchmgmtthyhdr_pk ";
        } else{
            $q = $q . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk ";
        }
        $q = $q . " WHERE lrhd_batchmgmtdtls_fk = $batchId";

        if($learnersid !=null){
            $q = $q . " and learnerreghrddtls_pk in ($learnersid) ";
        }
        $q = $q . " GROUP By LR.learnerreghrddtls_pk";
        
        $query = Yii::$app->db->createCommand($q)->queryAll();

        $q1 = "SELECT `learnerreghrddtls_pk` as tad_learnerreghrddtls_fk, sir_idnumber, sir_name_en,sir_name_ar, sir_emailid, sir_dob, sir_gender, UT.oum_firstname as th_tutor, UT.opalusermst_pk as th_tutorpk, UP.oum_firstname as pra_tutor, UP.opalusermst_pk as pra_tutorpk,
        UA.oum_firstname as asmt_staff, UA.opalusermst_pk as asmt_staffpk, UI.oum_firstname as ivqastaff, UI.opalusermst_pk as ivqastaffpk, lrhd_feestatus,lrhd_learnerfee, lrhd_paidby, lrhd_batchmgmtdtls_fk as tad_batchmgmtdtls_fk,   ST.*,
        DU.batchmgmtdurationdtls_pk as tad_batchmgmtdurationdtls_fk, BT.batchmgmtthyhdr_pk as tad_batchmgmtthyhdr_fk, 
             BP.batchmgmtpracthdr_pk as tad_batchmgmtpracthdr_fk, TR.trngattdntdtls_pk, `lrhd_status`
        FROM `learnerreghrddtls_tbl` as LR 
        LEFT JOIN staffinforepo_tbl as ST on LR.lrhd_staffinforepo_fk = ST.staffinforepo_pk
        LEFT JOIN batchmgmtthydtls_tbl as BTD on LR.learnerreghrddtls_pk = BTD.bmtd_learnerreghrddtls_fk
        LEFT JOIN batchmgmtthyhdr_tbl as BT on  BT.batchmgmtthyhdr_pk = BTD.bmtd_batchmgmtthyhdr_fk
        LEFT JOIN opalusermst_tbl as UT on BT.bmth_tutor = UT.opalusermst_pk
        LEFT JOIN batchmgmtpractdtls_tbl as BPD on LR.learnerreghrddtls_pk = BPD.bmpd_learnerreghrddtls_fk
        LEFT JOIN batchmgmtpracthdr_tbl BP on  BP.batchmgmtpracthdr_pk = BPD.bmpd_batchmgmtpracthdr_fk
        LEFT JOIN opalusermst_tbl as UP on BP.bmph_tutor = UP.opalusermst_pk
        LEFT JOIN batchmgmtasmthdr_tbl BA on  BA.bmah_batchmgmtdtls_fk = LR.lrhd_batchmgmtdtls_fk
        LEFT JOIN opalusermst_tbl as UA on BA.bmah_assessor = UA.opalusermst_pk
        LEFT JOIN opalusermst_tbl as UI on BA.bmah_ivqastaff = UI.opalusermst_pk
        LEFT JOIN batchmgmtdurationdtls_tbl as DU on DU.bmdd_batchmgmtdtls_fk = LR.lrhd_batchmgmtdtls_fk";
        
        if($model->bmd_status == 2){
            $q1 = $q1 . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk and tad_trngdate = " . date("Y-m-d"). " and tad_batchmgmtpracthdr_fk = BT.batchmgmtthyhdr_pk ";
        } else if($model->bmd_status == 3){
            $q1 = $q1 . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk and tad_trngdate = " . date("Y-m-d"). " and tad_batchmgmtpracthdr_fk = BT.batchmgmtthyhdr_pk ";
        } else{
            $q1 = $q1 . " LEFT JOIN trngattdntdtls_tbl as TR on TR.tad_learnerreghrddtls_fk = LR.learnerreghrddtls_pk ";
        }
        $q1 = $q1 . " WHERE lrhd_batchmgmtdtls_fk = $batchId";

        if($learnersid !=null){
            $q1 = $q1 . " and learnerreghrddtls_pk in ($learnersid) ";
        }
        $q1 = $q1 . " GROUP By LR.learnerreghrddtls_pk";
        // print_r($q1);
        // exit;

        $query1 = Yii::$app->db->createCommand($q1)->queryAll();
        $learnerArray = array();
        foreach ($query as $key => $value) {
           array_push($learnerArray,$value);
        }   
        $ddd= array_map(function ($v1,$v2) {
            if($v1["sir_idnumber"] != $v2["sir_idnumber"] ){
                return $v2;
            }
        }, $query, $query1);
           
         foreach ($ddd as $key => $value) {
            if($value !=null)
                array_push($learnerArray,$value);
         }
        foreach($learnerArray as $key => $value){
            if($value['lcd_viewcardpath']){
                $viewpath = strstr($value['lcd_viewcardpath'], 'web');
                if (file_exists($viewpath)) {
                    $learnerArray[$key]['viewfileexist'] = true;
                } else {
                    $learnerArray[$key]['viewfileexist'] = false;
                }
            }
            if($value['lcd_plaincard']){
                $printpath = strstr($value['lcd_plaincard'], 'web');
                if (file_exists($printpath)) {
                    $learnerArray[$key]['printfileexist'] = true;
                } else {
                    $learnerArray[$key]['printfileexist'] = false;
                }
            }
           
        }
        return $learnerArray;
    }

//    public function movedtoqualitycheck($ids){
//         foreach($ids as $item){
//             $connection = Yii::$app->db;
//             $connection->createCommand()->update('learnerreghrddtls_tbl', ['lrhd_status' => 5], 'learnerreghrddtls_pk > $item');
//             if(!$connection->execute()){
//                 $result = array(
//                     'status' => 500,
//                     'msg' => 'warning',
//                     'flag' => 'E',
//                     'comments' => 'Something went wrong',
//                     'returndata' => $connection->getErrors()
//                 );
//                 return $result;
//             }
//         }
//         $result = array(
//             'status' => 200,
//             'msg' => 'Sucess',
//             'flag' => 'S',
//         );
//    }

   public function getlearnerdata($id){
        $query = Yii::$app->db->createCommand("SELECT lrhd_batchmgmtdtls_fk,`learnerreghrddtls_pk`, lrhd_appdecon, lrhd_appdecby, lrhd_appdeccomments, `lrhd_status`, `Irhd_emailid`,BA.batchmgmtasmtdtls_pk,B.bmd_standardcoursedtls_fk, B.batchmgmtdtls_pk, S.staffinforepo_pk, B.bmd_Batchno, S.sir_idnumber, S.sir_emailid, S.sir_name_en,  S.sir_dob, S.sir_gender, SC.scd_markpercent, SC.scd_isknwlasmt, SC.scd_minmarkfrknwlasmt, SC.scd_ispratasmt, SC.scd_ispartasmtmark, SC.scd_partasmtminmark, SC.scd_ispratclassrefresher,SC.scd_partasmttotalmark,SC.scd_totalmarkfrknwlasmt,
        S.sir_photo,IF (((SELECT COUNT(*)  FROM `learnerasmthdr_tbl`  LEFT JOIN learnerreghrddtls_tbl ON learnerasmthdr_tbl.lasmth_LearnerRegHrdDtls_FK = learnerreghrddtls_tbl.learnerreghrddtls_pk) > 0) ,
        (group_concat(if(AA.asmtm_internalasmt=1, LM.lasmth_status, NULL ))), NULL) as kstatus,
        IF (((SELECT COUNT(*)  FROM `learnerasmthdr_tbl`  LEFT JOIN learnerreghrddtls_tbl ON learnerasmthdr_tbl.lasmth_LearnerRegHrdDtls_FK = learnerreghrddtls_tbl.learnerreghrddtls_pk) > 0) ,
        (group_concat(if(AA.asmtm_internalasmt=2, LM.lasmth_status, NULL ))),NULL) as pstatus 
                        FROM learnerreghrddtls_tbl as LR 
                        LEFT JOIN batchmgmtdtls_tbl as B ON LR.lrhd_batchmgmtdtls_fk = B.batchmgmtdtls_pk
                        LEFT JOIN batchmgmtasmtdtls_tbl as BA ON LR.learnerreghrddtls_pk = BA.bmad_learnerreghrddtls_fk
                        LEFT JOIN staffinforepo_tbl as S ON LR.lrhd_staffinforepo_fk = S.staffinforepo_pk
                        LEFT JOIN standardcoursedtls_tbl as SC ON B.bmd_standardcoursedtls_fk = SC.standardcoursedtls_pk
                        LEFT JOIN `learnerasmthdr_tbl` as LM ON LR.learnerreghrddtls_pk = LM.lasmth_LearnerRegHrdDtls_FK
                        LEFT JOIN `assessmentmst_tbl` as AA ON LM.lasmth_assessmentmst_fk= AA.assessmentmst_pk 
                        WHERE LR.learnerreghrddtls_pk = $id
                        group by learnerreghrddtls_pk")->queryAll();
        return $query[0];
   }

  

}
