<?php

namespace app\models;
use Yii;
use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;

/**
 * This is the ActiveQuery class for [[LearnercarddtlsTbl]].
 *
 * @see LearnercarddtlsTbl
 */
class LearnercarddtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnercarddtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnercarddtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getlearnercarddetails($limit,$index,$searchkey){


         // $query = "SELECT LC.lcd_learnerreghrddtls_fk, LC.learnercarddtls_pk,  LC.lcd_verificationno, LC.lcd_createdon, LC.lcd_staffinforepo_fk, SIR.sir_idnumber, SIR.sir_name_en, SIR.sir_name_ar, 
         // SLD.sld_ROPlicense, PM.pm_projectname_en, PM.pm_projectname_ar, STM.scm_coursename_en, STM.scm_coursename_ar, lcd_standardcoursemst_fk,
         // (SELECT lcd_learnerreghrddtls_fk FROM learnercarddtls_tbl WHERE lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk AND lcd_status IN (1,2) AND lcd_plaincard IS NOT NULL ORDER BY  learnercarddtls_pk DESC LIMIT 1) as leanerid,
         // (SELECT lcd_plaincard FROM learnercarddtls_tbl WHERE lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk AND lcd_status IN (1,2) AND lcd_plaincard IS NOT NULL ORDER BY  learnercarddtls_pk DESC LIMIT 1) as plaincard,
         // (select lcd_viewcardpath from learnercarddtls_tbl WHERE lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk AND lcd_status IN (1,2) AND lcd_viewcardpath IS NOT NULL ORDER BY  learnercarddtls_pk DESC LIMIT 1) as viewcard,
         // (SELECT COUNT(lcd_verificationno) FROM learnercarddtls_tbl WHERE lcd_status IN (1, 2, 3) AND lcd_staffinforepo_fk = LC.lcd_staffinforepo_fk  AND lcd_standardcoursemst_fk = LC.lcd_standardcoursemst_fk ) AS cat_count,
         // (SELECT COUNT(lcd_verificationno) FROM learnercarddtls_tbl WHERE lcd_status = 2 AND lcd_staffinforepo_fk = LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk = LC.lcd_standardcoursemst_fk ) AS exp_count
         // FROM learnercarddtls_tbl AS LC
         // LEFT JOIN staffinforepo_tbl AS SIR ON LC.lcd_staffinforepo_fk = SIR.staffinforepo_pk
         // LEFT JOIN stafflicensedtls_tbl AS SLD ON LC.lcd_staffinforepo_fk = SLD.sld_staffinforepo_fk
         // LEFT JOIN standardcoursemst_tbl AS STM ON LC.lcd_standardcoursemst_fk = STM.standardcoursemst_pk
         // LEFT JOIN projectmst_tbl AS PM ON STM.scm_projectmst_fk = PM.projectmst_pk 
         // WHERE lcd_status IN (1, 2, 3) ";

         $query = "SELECT LC.lcd_learnerreghrddtls_fk,
        LC.learnercarddtls_pk,
        LC.lcd_verificationno,
        LC.lcd_createdon,
        LC.lcd_staffinforepo_fk,
        SIR.sir_idnumber,
        SIR.sir_name_en,
        SIR.sir_name_ar,
        SLD.sld_ROPlicense,
        PM.pm_projectname_en,
        PM.pm_projectname_ar,
        STM.scm_coursename_en,
        STM.scm_coursename_ar,
        lcd_standardcoursemst_fk,";
        if($searchkey['date']){
           $query .= "(select concat(lcd_plaincard,',',lcd_viewcardpath,',',lcd_learnerreghrddtls_fk,',',lcd_cardissuedate) from learnercarddtls_tbl where lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk and lcd_status in (1,2) and lcd_isprinted = 1 and lcd_cardissuedate BETWEEN '".$searchkey['date']['start'] ."' AND '" . $searchkey['date']['end'] . "'"." order by  learnercarddtls_pk desc limit 1) as 'plaincard',";
        }else{
           $query .= "(select concat(lcd_plaincard,',',lcd_viewcardpath,',',lcd_learnerreghrddtls_fk,',',lcd_cardissuedate) from learnercarddtls_tbl where lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk and lcd_status in (1,2) and lcd_isprinted = 1 order by  learnercarddtls_pk desc limit 1) as 'plaincard',";
        }
        
        $query .= "count(distinct LC.lcd_standardcoursedtls_fk) as cat_count,
        (select count(distinct lcd_standardcoursedtls_fk) from learnercarddtls_tbl where lcd_staffinforepo_fk=LC.lcd_staffinforepo_fk AND lcd_standardcoursemst_fk=LC.lcd_standardcoursemst_fk and lcd_status = 2) as exp_count, 
        if(lcd_status=2,count(distinct LC.lcd_standardcoursedtls_fk),0)AS ecount
        FROM 
        learnercarddtls_tbl AS LC  JOIN staffinforepo_tbl AS SIR ON LC.lcd_staffinforepo_fk=SIR.staffinforepo_pk LEFT JOIN stafflicensedtls_tbl AS SLD ON LC.lcd_staffinforepo_fk=SLD.sld_staffinforepo_fk  JOIN
        standardcoursemst_tbl AS STM ON
        LC.lcd_standardcoursemst_fk=STM.standardcoursemst_pk  JOIN projectmst_tbl AS PM ON STM.scm_projectmst_fk=PM.projectmst_pk
        WHERE lcd_status IN(1,2,3)  ";
        
        if($searchkey['verficationno']){
          
      $query .= ' and LC.lcd_verificationno  LIKE "%'.$searchkey['verficationno'].'%" ';
        }
        if($searchkey['roplicenseno']){
          
           $query .= ' and SLD.sld_ROPlicense LIKE "%'.$searchkey['roplicenseno'] .'%" ';
        }
        if($searchkey['idnumber']){

           $query .= ' and SIR.sir_idnumber LIKE "%'.$searchkey['idnumber'] .'%" ';
        }
        if($searchkey['name']){

           $query .= ' and SIR.sir_name_en LIKE "%'.$searchkey['name'] .'%" ';
        }
        if($searchkey['course']){

           $value = '(';
           foreach($searchkey['course'] as $d){
              $value .= $d. ',';
           }
           $value = trim($value,",");
           $value .= ')';
           $query .= " and PM.projectmst_pk IN " .$value ;
        }
        if($searchkey['category']){

           $value = '(';
           foreach($searchkey['category'] as $d){
              $value .= $d. ',';
           }
           $value = trim($value,",");
           $value .= ')';

           $query .= " and STM.standardcoursemst_pk IN " . $value ;
        }
        if($searchkey['date']){

          // $s = $searchkey['date']['start'].' 00:00:00';
           //$e = $searchkey['date']['end'].' 23:59:59';
           //$query .= " and LC.lcd_cardissuedate BETWEEN '".$s ."' AND '" . $e . "'";
            $query .= " and LC.lcd_cardissuedate BETWEEN '".$searchkey['date']['start'] ."' AND '" . $searchkey['date']['end'] . "'";
        }
        $query = $query . " GROUP BY  LC.lcd_staffinforepo_fk, LC.lcd_standardcoursemst_fk
        ORDER BY LC.lcd_createdon DESC";
      // echo $query;
      // exit;

        $provider = new SqlDataProvider([
            'sql' => $query,
            'pagination' => [
                'pageSize' => $limit,
                'page'=> $index
            ]
        ]);
        $data = $provider->getModels();
         foreach($data as $key => $value){
            $filepath = explode(',', $value['plaincard']);
            if($filepath[1]){
               $viewpath = strstr($filepath[1], 'web');
               if (file_exists($viewpath)) {
                  $data[$key]['viewfileexist'] = true;
               } else {
                  $data[$key]['viewfileexist'] = false;
               }
            }
            if($filepath[0]){
               $printpath = strstr($filepath[0], 'web');
               if (file_exists($printpath)) {
                  $data[$key]['printfileexist'] = true;
               } else {
                  $data[$key]['printfileexist'] = false;
               }
            }
         }
        $recodsset =[];
        $recodsset['learnerscards'] = $data;
        $recodsset['pagesize'] = $limit;
        $recodsset['totalcount'] = $provider->getTotalCount();
        return $recodsset;
    }

    public function getsinglelearnercarddetails($staffId, $courseid){
      $query = "SELECT SIR.staffinforepo_pk, SIR.sir_idnumber, SIR.sir_name_en, SIR.sir_name_ar, SIR.sir_dob, SIR.sir_photo,SIR.sir_gender, 
      SIR.sir_nationality, OC.ocym_countryname_en, SLD.sld_ROPlicense, SLD.sld_ROPlicenseupload, LC.lcd_verificationno, 
      LC.lcd_createdon, LC.lcd_staffinforepo_fk, PM.pm_projectname_en, PM.pm_projectname_ar,STM.scm_coursename_en, STM.scm_coursename_ar, STM.standardcoursemst_pk,
      (select lcd_cardissuedate from learnercarddtls_tbl where lcd_staffinforepo_fk=$staffId AND lcd_standardcoursemst_fk=$courseid and lcd_status in (1,2) and lcd_isprinted = 1 order by  learnercarddtls_pk desc limit 1) as lastissued
      FROM learnercarddtls_tbl AS LC
      LEFT JOIN staffinforepo_tbl AS SIR ON LC.lcd_staffinforepo_fk = SIR.staffinforepo_pk
      LEFT JOIN stafflicensedtls_tbl AS SLD ON LC.lcd_staffinforepo_fk = SLD.sld_staffinforepo_fk
      LEFT JOIN opalcountrymst_tbl AS OC ON SIR.sir_nationality = OC.opalcountrymst_pk
      LEFT JOIN standardcoursemst_tbl AS STM ON LC.lcd_standardcoursemst_fk = STM.standardcoursemst_pk
      LEFT JOIN projectmst_tbl AS PM ON STM.scm_projectmst_fk = PM.projectmst_pk 
      WHERE LC.lcd_staffinforepo_fk = $staffId AND LC.lcd_status IN (1, 2, 3)";
      if($courseid){
         $query .= " AND LC.lcd_standardcoursemst_fk = $courseid ";
      }
      
      $query .= " GROUP BY LC.lcd_learnerreghrddtls_fk, LC.lcd_staffinforepo_fk, LC.lcd_standardcoursemst_fk
      ORDER BY LC.lcd_createdon DESC";


      $result = Yii::$app->db->createCommand($query)->queryAll();
      return $result[0];
    }

    public function getcarddetails($staffId, $courseid, $limit, $index, $searchkey){
      $card = \app\models\LearnercarddtlsTbl::find()
      ->select(['learnercarddtls_pk','lcd_subcategoryname','lcd_isprinted','lcd_cardexpiry','lcd_verificationno','lcd_learnerreghrddtls_fk','B.bmd_Batchno','O.omrm_tpname_en','lcd_plaincard', 'lcd_viewcardpath' ])
      ->leftjoin('batchmgmtdtls_tbl B','B.batchmgmtdtls_pk = lcd_batchmgmtdtls_fk')
      ->leftjoin('opalmemberregmst_tbl O', 'O.opalmemberregmst_pk = B.bmd_opalmemberregmst_fk')
      ->where(['=', 'lcd_staffinforepo_fk', $staffId])
      ->andwhere(['=','lcd_standardcoursemst_fk', $courseid])
      ->andwhere(['!=','lcd_status', 4]);
      
      if(!empty($searchkey['subcourse'])){
         $card->andWhere(['IN', 'lcd_standardcoursedtls_fk', $searchkey['subcourse']]);
      }
      if(!empty($searchkey['isprint'])){
         $card->andwhere(['IN', 'lcd_isprinted', $searchkey['isprint']]);
      }
      if(!empty($searchkey['expirydate'])){
         $card->andWhere('lcd_cardexpiry between "'.$searchkey['expirydate']['start'].'" and "'.$searchkey['expirydate']['end'].'"');   
      }
      if(!empty($searchkey['batchno'])){
         $card->andWhere(['Like', 'B.bmd_Batchno', $searchkey['batchno']]);
      }
      if(!empty($searchkey['centre'])){
         $card->andWhere(['Like', 'O.omrm_tpname_en', $searchkey['centre']]);
      }
      $card->orderby('lcd_createdon desc')->asArray();


      $dataProvider = new ActiveDataProvider([
         'query' => $card,
         'pagination' => [
            'pageSize' =>$limit,
            'page'=>$index
         ]
      ]);

      $data = $dataProvider->getModels();
      foreach($data as $key => $value){
         if($value['lcd_viewcardpath']){
            $viewpath = strstr($value['lcd_viewcardpath'], 'web');
            if (file_exists($viewpath)) {
               $data[$key]['viewfileexist'] = true;
            } else {
               $data[$key]['viewfileexist'] = false;
            }
         }
         if($value['lcd_plaincard']){
            $printpath = strstr($value['lcd_plaincard'], 'web');
            if (file_exists($printpath)) {
               $data[$key]['printfileexist'] = true;
            } else {
               $data[$key]['printfileexist'] = false;
            }
         }
      }
      
       
      //$card = $dataProvider->getModels();

      $recodsset =[];
      $recodsset['cards'] = $data;
      $recodsset['pagesize'] = $limit;
      $recodsset['totalcount'] = $dataProvider->getTotalCount();

      return $recodsset;
    } 

    public function changecivilnumber($newcivilnumber, $oldcivilnumber){


      // $data = \app\models\StaffinforepoTbl::find()->where(['=', 'sir_idnumber', $civilnumber])->one();
      // if($data){
      //     return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => true ];
      // }else{
      //     return [ 'msg' => 'sucess', 'status' => 1, 'flag' => 'S', 'data' => false ];
      // }
      $transaction = Yii::$app->db->beginTransaction();

      $nstaff = \app\models\StaffinforepoTbl::find()->where(['=','sir_idnumber',$newcivilnumber])->one();
      $ostaff = \app\models\StaffinforepoTbl::find()->where(['=','sir_idnumber',$oldcivilnumber])->one();
      $batchassessor = \app\models\BatchmgmtasmtdtlsTbl::find()->select('batchmgmtasmtdtls_pk')->where(['=','bmad_staffinforepo_fk',$ostaff->staffinforepo_pk])->asArray()->all();
      foreach($batchassessor as $batch){
          $assessor = \app\models\BatchmgmtasmtdtlsTbl::find()->where(['=','batchmgmtasmtdtls_pk',$batch['batchmgmtasmtdtls_pk']])->one(); 
          $assessor->bmad_staffinforepo_fk = $nstaff->staffinforepo_pk;
          if($assessor->save()){

          }else{
              $transaction->rollBack();
              echo "<pre>1";
              print_r($assessor->getErrors());
              die;
          }
      }
      $leaners = \app\models\LearnerreghrddtlsTbl::find()->select('learnerreghrddtls_pk')->where(['=','lrhd_staffinforepo_fk',$ostaff->staffinforepo_pk])->asArray()->all();
      foreach($leaners as $leaner){
         //  $leanerdata = \app\models\LearnerreghrddtlsTbl::find()->where(['=','learnerreghrddtls_pk', $leaner['learnerreghrddtls_pk']])->one();
         //  $leanerdata->lrhd_staffinforepo_fk = $nstaff->staffinforepo_pk;

         $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
         $query1 = \Yii::$app->db->createCommand("UPDATE learnerreghrddtls_tbl SET  lrhd_staffinforepo_fk = :lrhd_staffinforepo_fk WHERE learnerreghrddtls_pk = :learnerreghrddtls_pk ")
         ->bindValue(':lrhd_staffinforepo_fk', $nstaff->staffinforepo_pk)
         ->bindValue(':learnerreghrddtls_pk', $leaner['learnerreghrddtls_pk'])
         ->execute();
         $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
         if($query1){

         }else{
            $transaction->rollBack();
            echo "<pre>2";
            print_r($query1->getErrors());
            die;
         }
      }
     
      $leanerassessments = \app\models\LearnerasmthdrTbl::find()->select('LearnerAsmtHdr_PK')->where(['=','lasmth_staffinforepo_fk',$ostaff->staffinforepo_pk])->asArray()->all();
      foreach($leanerassessments as $leanerassessment){
         $leanerassessmentdata = \app\models\LearnerasmthdrTbl::find()->where(['=','LearnerAsmtHdr_PK', $leanerassessment['LearnerAsmtHdr_PK']])->one();
         $leanerassessmentdata->lasmth_staffinforepo_fk = $nstaff->staffinforepo_pk;
         if($leanerassessmentdata->save()){

          }else{
              $transaction->rollBack();
              echo "<pre>3";
              print_r($leanerassessmentdata->getErrors());
              die;
          }
      }
     
      $leanercards = \app\models\LearnercarddtlsTbl::find()->select('learnercarddtls_pk')->where(['=','lcd_staffinforepo_fk',$ostaff->staffinforepo_pk])->asArray()->all();
      foreach($leanercards as $leanercard){
          $leanercarddata = \app\models\LearnercarddtlsTbl::find()->where(['=','learnercarddtls_pk', $leanercard['learnercarddtls_pk']])->one();
          $leanercarddata->lcd_staffinforepo_fk = $nstaff->staffinforepo_pk;
          if($leanercarddata->save()){

          }else{
              $transaction->rollBack();
              echo "<pre>4";
              print_r($leanercarddata->getErrors());
              die;
          }
      }


      $transaction->commit();
      return 1;

   }

   public function movecardtohistory($cardid){

      $transaction = Yii::$app->db->beginTransaction();
      $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
      $card = \app\models\LearnercarddtlsTbl::find()->where(['=','learnercarddtls_pk', $cardid])->one();
      $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
      $query = \Yii::$app->db->createCommand("INSERT INTO learnercarddtlshsty_tbl (lcdh_learnercarddtls_fk,lcdh_staffinforepo_fk, lcdh_batchmgmtdtls_fk,lcdh_learnerreghrddtls_fk,
      lcdh_standardcoursemst_fk, lcdh_standardcoursedtls_fk, lcdh_categoryname, lcdh_subcategoryname, lcdh_isprinted, lcdh_serialno,  lcdh_cardexpiry, lcdh_cardissuedate,
      lcdh_plaincard, lcdh_viewcardpath, lcdh_verificationno, lcdh_status, lcdh_printedon, lcdh_printedby, lcdh_createdon, lcdh_createdby  ) 
      VALUES (:lcdh_learnercarddtls_fk, :lcdh_staffinforepo_fk, :lcdh_batchmgmtdtls_fk, :lcdh_learnerreghrddtls_fk, :lcdh_standardcoursemst_fk, :lcdh_standardcoursedtls_fk, 
      :lcdh_categoryname, :lcdh_subcategoryname, :lcdh_isprinted, :lcdh_serialno,  :lcdh_cardexpiry, :lcdh_cardissuedate, :lcdh_plaincard, :lcdh_viewcardpath, :lcdh_verificationno, 
      :lcdh_status, :lcdh_printedon, :lcdh_printedby, :lcdh_createdon, :lcdh_createdby)")
      ->bindValue(':lcdh_learnercarddtls_fk', $card->learnercarddtls_pk)
      ->bindValue(':lcdh_staffinforepo_fk', $card->lcd_staffinforepo_fk)
      ->bindValue(':lcdh_batchmgmtdtls_fk', $card->lcd_batchmgmtdtls_fk)
      ->bindValue(':lcdh_learnerreghrddtls_fk', $card->lcd_learnerreghrddtls_fk)
      ->bindValue(':lcdh_standardcoursemst_fk', $card->lcd_standardcoursemst_fk)
      ->bindValue(':lcdh_standardcoursedtls_fk', $card->lcd_standardcoursedtls_fk)
      ->bindValue(':lcdh_categoryname', $card->lcd_categoryname)
      ->bindValue(':lcdh_subcategoryname', $card->lcd_subcategoryname)
      ->bindValue(':lcdh_isprinted', $card->lcd_isprinted)
      ->bindValue(':lcdh_serialno', $card->lcd_serialno)
      ->bindValue(':lcdh_cardexpiry', $card->lcd_cardexpiry)
      ->bindValue(':lcdh_cardissuedate', $card->lcd_cardissuedate)
      ->bindValue(':lcdh_plaincard', $card->lcd_plaincard)
      ->bindValue(':lcdh_viewcardpath', $card->lcd_viewcardpath)
      ->bindValue(':lcdh_verificationno', $card->lcd_verificationno)
      ->bindValue(':lcdh_status', 4)
      ->bindValue(':lcdh_printedon', $card->lcd_printedon)
      ->bindValue(':lcdh_printedby', $card->lcd_printedby)
      ->bindValue(':lcdh_createdby', $card->lcd_createdby)
      ->bindValue(':lcdh_createdon', $card->lcd_createdon)
      ->execute();
      $batchid = \Yii::$app->db->getLastInsertID();
      $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
      if($query){
         $q = \Yii::$app->db->createCommand("set foreign_key_checks=0;")->execute();
         $query1 = \Yii::$app->db->createCommand("DELETE FROM learnercarddtls_tbl WHERE learnercarddtls_pk = $cardid;")->execute();
         $q1 = \Yii::$app->db->createCommand("set foreign_key_checks=1;")->execute();
        if($query1){
            $transaction->commit();
         }else{
            $transaction->rollBack();
            echo "<pre>";
            print_r($query1->getErrors());
            die;
         }
      }else{
          $transaction->rollBack();
          echo "<pre>";
          print_r($query->getErrors());
          die;
      }

      return 1;
   }
}