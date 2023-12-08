<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LearnerfdbkhdrTbl]].
 *
 * @see LearnerfdbkhdrTbl
 */
class LearnerfdbkhdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LearnerfdbkhdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LearnerfdbkhdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getfeedbackdatalist($reqdat){
        $stktype = \yii\db\ActiveRecord::getTokenData('omrm_stkholdertypmst_fk', true);
        $memberregmstid = \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        $model = \app\models\LearnerfdbkhdrTbl::find()
                ->select(["learnerreghrddtls_pk as lid","sir_idnumber as idnumber","sir_name_en as learnername_en","sir_name_ar as learnername_ar",
                    "bmd_Batchno as batchnumb","trainer.omrm_tpname_en as trainerprovi_en","trainer.omrm_tpname_ar as trainerprovi_ar",
                    "assesser.omrm_tpname_en as assessercentre_en","assesser.omrm_tpname_ar as assessercentre_ar","lfh_Comments as feedbackcomments"])
                ->leftJoin('learnerreghrddtls_tbl','learnerreghrddtls_pk = lfh_LearnerRegHrdDtls_FK')
                ->leftJoin('opalmemberregmst_tbl trainer','trainer.opalmemberregmst_pk = lrhd_opalmemberregmst_fk')
                ->leftJoin('batchmgmtdtls_tbl','batchmgmtdtls_pk = lrhd_batchmgmtdtls_fk')
                ->leftJoin('staffinforepo_tbl','staffinforepo_pk = lrhd_staffinforepo_fk')
                ->leftJoin('batchmgmtasmtdtls_tbl','bmad_batchmgmtdtls_fk = lrhd_batchmgmtdtls_fk and bmad_learnerreghrddtls_fk = learnerreghrddtls_pk')
                ->leftJoin('batchmgmtasmthdr_tbl','batchmgmtasmthdr_pk = bmad_batchmgmtasmthdr_fk')
                ->leftJoin('opalusermst_tbl','opalusermst_pk = bmah_assessor')
                ->leftJoin('opalmemberregmst_tbl assesser','assesser.opalmemberregmst_pk = oum_opalmemberregmst_fk')
                ->where("lfh_FdbbkStatus  = 2");
        if($stktype == 2){
            $model->andWhere("trainer.opalmemberregmst_pk =:compid or assesser.opalmemberregmst_pk =:compid",[':compid'=>$memberregmstid]);
        }
        if($reqdat['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($reqdat['gridsearchValues'],true); 
            $civil_numb = $gridsearchValues['civil_numb'];
            $learner_name = $gridsearchValues['learner_name'];
            $batchnumber = $gridsearchValues['batchnumber'];
            $trainingprovider = $gridsearchValues['trainingprovider'];
            $assessmentcentre = $gridsearchValues['assessmentcentre'];
            if(!empty($civil_numb)){
                $model->andFilterWhere(['=', 'sir_idnumber', $civil_numb]);
            }
            if(!empty($learner_name)){
                $model->andFilterWhere(['OR', ['LIKE', 'sir_name_en', $learner_name], ['LIKE', 'sir_name_ar', $learner_name]]);
            }
            if(!empty($batchnumber)){
                $model->andFilterWhere(['LIKE', 'bmd_Batchno', $batchnumber]);
            }
            if(!empty($trainingprovider)){
                $model->andFilterWhere(['OR', ['LIKE', 'trainer.omrm_tpname_en', $trainingprovider],['LIKE', 'trainer.omrm_tpname_ar', $trainingprovider]]);
            }
            if(!empty($assessmentcentre)){
                $model->andFilterWhere(['OR', ['LIKE', 'assesser.omrm_tpname_en', $assessmentcentre], ['LIKE', 'assesser.omrm_tpname_ar', $assessmentcentre]]);
            }
        }
        $sort_column = (strpos($reqdat['sort'],"-") !== false) ? explode("-",$reqdat['sort'])[1] : $reqdat['sort'];
        $order_by = ($reqdat['order']=='asc')? 'asc': 'desc';
        $model->orderBy("$sort_column $order_by");
        $model->asArray();
        $page = (!empty($reqdat['size']) && $reqdat['size'] != 'undefined') ? $reqdat['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $model,
            'pagination' => [
                'pageSize' => $page,
                'page' => $reqdat['page']   
            ],
        ]);
        $data = $provider->getModels();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
    }
}
