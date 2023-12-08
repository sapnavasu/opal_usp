<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnerasmthdrTbl]].
 *
 * @see LearnerasmthdrTbl
 */
class LearnerasmthdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerasmthdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function assessmentreprt($data){

        
         $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $query = \app\models\AssessmentmstTbl::find()->where(['asmtm_standardcoursedtls_fk'=>$data['standcoursePK']])
        ->where(['asmtm_internalasmt'=>$data['assessmentType']])->one();
        $query1 = \app\models\ReferencemstTbl::find()->where(['rm_mastertype'=>15])
        ->where(['rm_name_en'=>$data['status']])->one();
        if($data['LearnerAsmtHdr_PK']){
            //echo '<pre>';echo 'aaaa';print_r($data); exit;
            if(is_array($data['file'])){
                $ownup =  implode(",", $data['file']);
                $fileupl = !empty($ownup) ? $ownup : NULL;
            }else{
                $fileupl = !empty($data['file']) ? $data['file'] : NULL;
            }   

            $catTable = \app\models\LearnerasmthdrTbl::find()->where(['LearnerAsmtHdr_PK' => $data['LearnerAsmtHdr_PK']])->one(); 
            
            // $hisvalue =  [
            //     'lasmthh_learnerasmthdr_fk' => $catTable->LearnerAsmtHdr_PK,
            //     'lasmthh_learnerreghrddtlshsty_fk' => $catTable->lasmth_LearnerRegHrdDtls_FK,
            //     'lasmthh_batchmgmtdtlshsty_fk' => $catTable->lasmth_batchmgmtdtls_fk,
            //     'lasmthh_batchmgmtasmtdtlshsty_fk' => $catTable->lasmth_batchmgmtasmtdtls_fk,
            //     'lasmthh_staffinforepo_fk' => $catTable->lasmth_staffinforepo_fk,
            //     'lasmthh_asmttype' => $catTable->lasmth_AsmtType,
            //     'lasmthh_asmtupload' => $catTable->lasmth_AsmtUpload,
            //     'lasmthh_assessmentmst_fk' => $catTable->lasmth_AssessmentMst_FK,
            //     'lasmthh_totalmarks' => $catTable->lasmth_TotalMarks,
            //     'lasmthh_marksecured' => $catTable->lasmth_MarkSecured,
            //     'lasmthh_percentage' => $catTable->lasmth_percentage,
            //     'lasmthh_asmtstatus' => $catTable->lasmth_AsmtStatus,
            //     'lasmthh_status' => $catTable->lasmth_Status,
            //     'lasmthh_appdecon' =>$catTable->lasmth_AppdecOn,
            //     'lasmthh_appdecby' => $catTable->lasmth_AppdecBy,
            //     'lasmthh_appdeccomments' => $catTable->lasmth_AppdecComments,
            //     'lasmthh_Createdon' => $catTable->lasmth_Createdon,
            //     'lasmthh_CreatedBy' => $catTable->lasmth_CreatedBy,
            //     // 'lasmthh_updatedon' => $catTable->lasmth_updatedon,
            //     // 'lasmthh_updatedby' => $catTable->lasmth_updatedby,
            //     'lasmthh_updatedon' =>  date('Y-m-d H:i:s'),
            //     'lasmthh_updatedby' => $userPk
            // ];
            // $learnerhist = new \app\models\LearnerasmthdrhstyTbl($hisvalue);
            // if($learnerhist->save(FALSE)){
                $catTable->LearnerAsmtHdr_PK =$data['LearnerAsmtHdr_PK'];
                $catTable->lasmth_LearnerRegHrdDtls_FK =$data['learnerPK'];
                $catTable->lasmth_batchmgmtdtls_fk =$data['batckPK'];
                $catTable->lasmth_batchmgmtasmtdtls_fk =$data['batchassessor'];
                $catTable->lasmth_staffinforepo_fk =$data['staffPK'];
                $catTable->lasmth_AssessmentMst_FK = $query->AssessmentMst_PK;                                           
                $catTable->lasmth_AsmtType = $data['type'];                        
                $catTable->lasmth_AsmtUpload = $fileupl;                
                $catTable->lasmth_TotalMarks = $data['totalmark'];                        
                $catTable->lasmth_MarkSecured =  $data['mark'];                        
                $catTable->lasmth_percentage =  $data['percentage'];                        
                $catTable->lasmth_AsmtStatus = $data['asmtstatus'];                        
                $catTable->lasmth_Status = $query1->referencemst_pk ;                        
                $catTable->lasmth_AppdecOn = date('Y-m-d H:i:s');                        
                $catTable->lasmth_updatedon = date('Y-m-d H:i:s');         
                $catTable->lasmth_updatedby = $userPk;
                $catTable->lasmth_AppdecBy = $userPk;          
                $catTable->lasmth_AppdecComments = $data['comments'];    
                if($catTable->save(FALSE)){
                    return $catTable->LearnerAsmtHdr_PK;
                }else{
                    echo '<pre>';
                    print_r($catTable->getErrors());
                    exit;
                }                    
            // }else{
            //     echo '<pre>';
            //     print_r($learnerhist->getErrors());
            //     exit;
            // }  




        } else{
            //echo '<pre>';echo 'sss';print_r($data); exit;
            if(is_array($data['file'])){
                $ownup =  implode(",", $data['file']);
                $fileupl = !empty($ownup) ? $ownup : NULL;
            }else{
                $fileupl = !empty($data['file']) ? $data['file'] : NULL;
            }   
            $catTable = new LearnerasmthdrTbl;
            $catTable->lasmth_LearnerRegHrdDtls_FK =$data['learnerPK'];
            $catTable->lasmth_batchmgmtdtls_fk =$data['batckPK'];
            $catTable->lasmth_batchmgmtasmtdtls_fk =$data['batchassessor'];
            $catTable->lasmth_staffinforepo_fk =$data['staffPK'];
            $catTable->lasmth_AssessmentMst_FK = $query->AssessmentMst_PK;                                           
            $catTable->lasmth_AsmtType = $data['type'];                        
            $catTable->lasmth_AsmtUpload =$fileupl;                        
            $catTable->lasmth_TotalMarks = $data['totalmark'];                        
            $catTable->lasmth_MarkSecured =  $data['mark'];                        
            $catTable->lasmth_percentage =  $data['percentage'];                        
            $catTable->lasmth_AsmtStatus = $data['asmtstatus'];                        
            $catTable->lasmth_Status = $query1->referencemst_pk ;                        
            $catTable->lasmth_AppdecOn = date('Y-m-d H:i:s');                        
            $catTable->lasmth_Createdon = date('Y-m-d H:i:s');                       
            $catTable->lasmth_CreatedBy = $userPk;        
            $catTable->lasmth_AppdecBy = $userPk;                        
            $catTable->lasmth_AppdecComments = $data['comments']; 
            if($catTable->save(FALSE)){
                return $catTable->LearnerAsmtHdr_PK;
            }else{
                echo '<pre>';
                print_r($catTable->getErrors());
                exit;
//                echo "<pre>";return $catTable->getErrors();exit;
            } 
        }
    }
}