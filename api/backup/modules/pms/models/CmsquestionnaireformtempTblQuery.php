<?php

namespace api\modules\pms\models;

use common\components\Common;
use common\components\Security;
use Yii;

/**
 * This is the ActiveQuery class for [[CmsquestionnaireformtempTbl]].
 *
 * @see CmsquestionnaireformtempTbl
 */
class CmsquestionnaireformtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnaireformtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function addquestionnarietemp($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if($data) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $transaction = Yii::$app->db->beginTransaction();
            if ($data['addinfo'][0]['cmsquestform_pk']) {
                $model = CmsquestionnaireformtempTbl::find()
                    ->where("cmsquestionnaireformtemp_pk =:pk", [':pk' => Security::decrypt($data['addinfo'][0]['cmsquestform_pk'])])
                    ->one();
                if (!empty($model->cmsqft_createdon)) {
                    $model->cmsqft_updatedon = $date;
                    $model->cmsqft_updatedby = $userPK;
                    $model->cmsqft_updatedbyipaddr = Common::getIpAddress();
                    $msg = 'Questionnarie Updated Successfully';
                }
            } else {
                $model = new CmsquestionnaireformtempTbl();
                $model->cmsqft_createdon = $date;
                $model->cmsqft_createdby = $userPK;
                $model->cmsqft_createdbyipaddr = Common::getIpAddress();
                $model->cmsqft_memcompmst_fk = $company_id;
                $msg = 'Questionnarie Added Successfully';
            }

            $model->cmsqft_type = $data['addinfo'][0]['type'];
            $model->cmsqft_formname = $data['formData']['formtitle']['name'];
            $model->cmsqft_formdesc = $data['formData']['formtitle']['description'];
            $model->cmsqft_formtype = $data['addinfo'][0]['formtype'];

            if($data['formData']['formtitle']['attributes']) {
                foreach ($data['formData']['formtitle']['attributes'] as $key => $value) {
                    if($value['type'] == 'file') {
                        $insert_file_mst = \api\modules\drv\models\FilemstTblQuery::addfilemstvalue($value);
                        $inserted_pk = $insert_file_mst['moduleData']['filemst_pk'];
                        $value['filemstpk'] = $inserted_pk;
                        $data['formData']['formtitle']['attributes'][$key] = $value;
                    }
                }
                $model->cmsqft_buildertemplate = $data['formData']['formtitle']['attributes'];
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

    public function getexistingquestiontemp($data) {
        if($data) {
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if($data['pk'] > 0) {
                $model = CmsquestionnaireformtempTbl::find()
                    ->select(['*'])
                    ->where('cmsqft_type=:cmsqft_type', [':cmsqft_type' => $data['type']])
                    ->andWhere('cmsquestionnaireformtemp_pk=:cmsquestionnaireformtemp_pk', [':cmsquestionnaireformtemp_pk' => $data['pk']])
                    ->andWhere('cmsqft_createdby=:userid',[':userid'=>$userPK])
                    ->asArray()
                    ->All();
                } else {
                    $model = CmsquestionnaireformtempTbl::find()
                    ->select(['*'])
                    ->where('cmsqft_type=:cmsqft_type', [':cmsqft_type' => $data['type']])
                    // ->andWhere('cmsqft_formtype=:cmsqft_formtype', [':cmsqft_formtype' => 1])
                    ->orderBy([new \yii\db\Expression("coalesce(cmsqft_updatedon,cmsqft_createdon) DESC")])
                    ->andWhere('cmsqft_createdby=:userid',[':userid'=>$userPK])
                    ->asArray()
                    ->All();
                }
            return $model;
        }
    }
}
