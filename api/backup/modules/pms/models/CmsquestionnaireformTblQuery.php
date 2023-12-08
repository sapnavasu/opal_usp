<?php

namespace api\modules\pms\models;
use common\components\Common;
use common\components\Security;
use Yii;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformTbl]].
 *
 * @see CmsquestionnaireformTbl
 */
class CmsquestionnaireformTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function addquestionnarie($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $transaction = Yii::$app->db->beginTransaction();
            if ($data['addinfo'][0]['cmsquestform_pk']) {
                $model = CmsquestionnaireformTbl::find()
                    ->where("cmsquestionnaireform_pk =:pk", [':pk' => Security::decrypt($data['addinfo'][0]['cmsquestform_pk'])])
                    ->one();
                if (!empty($model->cmsqf_createdon)) {
                    $model->cmsqf_updatedon = $date;
                    $model->cmsqf_updatedby = $userPK;
                    $model->cmsqf_updatedbyipaddr = Common::getIpAddress();
                    $msg = 'Questionnarie Updated Successfully';
                }
            } else {
                $model = new CmsquestionnaireformTbl();
                $model->cmsqf_createdon = $date;
                $model->cmsqf_createdby = $userPK;
                $model->cmsqf_createdbyipaddr = Common::getIpAddress();
                $msg = 'Questionnarie Added Successfully';
            }

            $model->cmsqf_type = $data['addinfo'][0]['type'];
            $model->cmsqf_formname = $data['formData']['formtitle']['name'];
            // $model->cmsqf_formnameheight = $data['formData']['formtitle']['nameheaderheight'];
            $model->cmsqf_formdesc = $data['formData']['formtitle']['description'];
            // $model->cmsqf_formdescheight = $data['formData']['formtitle']['descriptionheaderheight'];
            $model->cmsqf_formtype = $data['addinfo'][0]['formtype'];

            if($data['formData']['formtitle']['attributes']) {
                foreach ($data['formData']['formtitle']['attributes'] as $key => $value) {
                    if($value['type'] == 'file') {
                        $insert_file_mst = \api\modules\drv\models\FilemstTblQuery::addfilemstvalue($value); 
                        $inserted_pk = $insert_file_mst['moduleData']['filemst_pk'];
                        $value['filemstpk'] = $inserted_pk;
                        $data['formData']['formtitle']['attributes'][$key] = $value;
                    }
                }
                $model->cmsqf_buildertemplate = $data['formData']['formtitle']['attributes'];
            }
            
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => $msg,
                    'moduleData' => $model,
                ); 
               
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            }

            if($insert_file_mst['flag'] != 'E' || count($filee_details) == 0) {
                $transaction->commit();
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
                $transaction->rollBack();
            }
        }
        return $result;
    }

    public function getexistingquestion($data) {
        if($data) {
            if($data['pk'] > 0) {
                $model = CmsquestionnaireformTbl::find()
                    ->select(['*'])
                    ->where('cmsqf_type=:cmsqf_type', [':cmsqf_type' => $data['type']])
                    ->andWhere('cmsquestionnaireform_pk=:cmsquestionnaireform_pk', [':cmsquestionnaireform_pk' => $data['pk']])
                    ->asArray()
                    ->All();
                } else {
                    $model = CmsquestionnaireformTbl::find()
                    ->select(['*'])
                    ->where('cmsqf_type=:cmsqf_type', [':cmsqf_type' => $data['type']])
                    ->andWhere('cmsqf_formtype=:cmsqf_formtype', [':cmsqf_formtype' => 1])
                    ->asArray()
                    ->All();
                }
            return $model; 
        }
    }
}
