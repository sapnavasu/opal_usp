<?php

namespace api\modules\pms\models;
use common\components\Common;
use Yii;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformtrnxTbl]].
 *
 * @see CmsquestionnaireformtrnxTbl
 */
class CmsquestionnaireformtrnxTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtrnxTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

      /**
     * get quotation questionnaire
     */
    public function findBySharedFk($sharedfk)
    {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );
     
        if($sharedfk){
            $data = CmsquestionnaireformtrnxTbl::find()
                ->with('cmsqftCmsquestionnaireformFk')
                ->where(['cmsqft_shared_fk' => $sharedfk])
                ->asArray()
                ->one();
            $data->cmsqftCmsquestionnaireformFk;
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data,
            );
        }
        return $result;
    }
    
    /**
     * Save quotation Questionnaire
     */
    public function updateQuestionnaire($data){
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
        if($data){
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $questionModel = CmsquestionnaireformtrnxTbl::find()->where(['cmsqft_shared_fk' => $data['formData']['quotationpk']])->one();
            $questionModel->cmsqft_cmsquestionnaireform_fk = $data['formData']['form_id'];
            $questionModel->cmsqft_shared_fk = $data['formData']['quotationpk'];
            $questionModel->cmsqft_shared_type = $data['formData']['shared_type'];
            $questionModel->cmsqft_answer = $data['formData']['answer'];
            $questionModel->cmsqft_status = $data['formData']['status'];
            $questionModel->cmsqft_createdon = $date;
            $questionModel->cmsqft_createdby = $userPK;
            $questionModel->cmsqft_createdbyipaddr = $ip_address;
            
            if($questionModel->save() === TRUE){
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Quotation Questionnaire updated Successfully!',
                    'quotationpk' => $data['formData']['quotationpk'],
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $questionModel->getErrors()
                );
            }
           
        } 
       return $result;
    }
    /**
     * Save Quot Questionnaire Form
     */
    public function saveQuestionnaireForm($quot_pk, $data,$dataType) {
        if($dataType == 1){
            $quotData = \api\modules\quot\models\CmsquotationhdrTbl::findOne($quot_pk);            
        }
        if($quotData->cmstenderhdrtbl->cmsth_skdclosedate ? date('Y-m-d H:i:s', strtotime(gmdate('Y-m-d H:i:s')) . ' ' . $quotData->cmstenderhdrtbl->cmsthSkdTimezoneFk->tz_utcoffset) > $quotData->cmstenderhdrtbl->cmsth_skdclosedate : false) {
            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'U',
                'comments' => 'Time is Over',
                'is_time_over' => true
            );
        }
        if($quotData->cmstenderhdrtbl->cmsth_cmsquestionnaireform_fk && $data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $model = CmsquestionnaireformtrnxTbl::find()
                ->where(['=', 'cmsqft_shared_fk', $quot_pk])
                ->andWhere(['=', 'cmsqft_shared_type', $dataType])
                ->one();  
            if(!$model) {
                $model = new CmsquestionnaireformtrnxTbl();
                $model->cmsqft_createdon = $date;
                $model->cmsqft_createdby = $userPK;
                $model->cmsqft_createdbyipaddr = $ip_address;      
            }  else {                
                $model->cmsqft_updatedon = $date;
                $model->cmsqft_updatedby = $userPK;
                $model->cmsqft_updatedbyipaddr = $ip_address; 
            }           
            $model->cmsqft_cmsquestionnaireform_fk = $quotData->cmstenderhdrtbl->cmsth_cmsquestionnaireform_fk;
            $model->cmsqft_memcompmst_fk = $company_id;
            $model->cmsqft_shared_fk = $quot_pk;
            $model->cmsqft_shared_type = $dataType;
            $model->cmsqft_answer = $data;      
            if($model->save()) { 
                return array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'S',
                    'comments' => 'Response Submitted Successfully!',
                );
            } else {                    
                return array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors(),
                );
            }
        }

        return array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );
    }
    /**
     * Get Quot Questionnaire Form answer
     */
    public function getQuestionnaireFormAnswer($qpk, $dataPk, $type) {
        $questionnaire = CmsquestionnaireformtrnxTbl::find()
            ->select(['cmsqft_answer'])
            ->where(['cmsqft_cmsquestionnaireform_fk' => $qpk])
            ->andWhere(['cmsqft_shared_fk' => $dataPk])
            ->andWhere(['cmsqft_shared_type' => $type])
            ->one();
        
        $data = [
            'ques_answer' => $questionnaire['cmsqft_answer'],
        ];

        return $data;
    }
}
