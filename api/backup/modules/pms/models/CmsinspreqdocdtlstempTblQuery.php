<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsinspreqdocdtlstempTbl]].
 *
 * @see CmsinspreqdocdtlstempTbl
 */
class CmsinspreqdocdtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdocdtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function saveInspectionReqtemp($formdata, $headerPk) {
        if (!empty($formdata)) {
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $ip_address = Common::getIpAddress();
            if (!empty($formdata['dtlsPk']) && $formdata['dtlsPk'] != null) {
                $model = CmsinspreqdocdtlstempTbl::find()->where("cmsinspreqdocdtlstemp_pk =:pk and cirddt_cmsinspreqdochdrtemp_fk = :headerPk", [':pk' => $formdata['dtlsPk'], ':headerPk' => $headerPk])->one();
                $flag = 'U';
                $comments = 'updated successfully!';
                $model->cirddt_updatedon = $date;
                $model->cirddt_updatedby = $userPK;
                $model->cirddt_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmsinspreqdocdtlstempTbl;
                $flag = 'C';
                $comments = 'created successfully!';
                $model->cirddt_createdon = $date;
                $model->cirddt_createdby = $userPK;
                $model->cirddt_createdbyipaddr = $ip_address;
                $model->cirddt_cmsinspreqdochdrtemp_fk = $headerPk;
                $model->cirddt_status = 1;
            }
            $model->cirddt_activityno = $formdata['activityNo'];
            $model->cirddt_activitytitle = $formdata['title'];
            $model->cirddt_refdoc = $formdata['refDoc'];
            $model->cirddt_remarks = $formdata['remarks'];
            if ($model->save() === TRUE) {
                if (!empty($formdata['quontumChkArray'])) {
                    $mapData = CmsinspreqdocactionmaptempTblQuery::saveInspectionReqMaptemp($formdata['quontumChkArray'], $model->cmsinspreqdocdtlstemp_pk);
                }
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => $flag,
                    'comments' => $comments,
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
            return $result;
        }
    }

    public function deleteInspecationData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmsinspreqdocdtlstempTbl::find()->where("cmsinspreqdocdtlstemp_pk =:pk", [':pk' => $dataPk])->one();
            $model->cirddt_status = 2;
            if ($model->save() === TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
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
            return $result;
        }
    }
}
