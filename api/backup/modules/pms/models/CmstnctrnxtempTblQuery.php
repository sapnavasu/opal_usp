<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use \api\modules\pms\models\CmstnctrnxtempTbl;

/**
 * This is the ActiveQuery class for [[CmstnctrnxtempTbl]].
 *
 * @see CmstnctrnxtempTbl
 */
class CmstnctrnxtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmstnctrnxtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function SubmitDynamicFormtemp($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['dynamicPk']) && $formdata['dynamicPk'] != null) {
                $model = CmstnctrnxtempTbl::find()->where("cmstnctrnxtemp_pk =:pk and ctnctt_shared_fk = :sharedFk", [':pk' => $formdata['dynamicPk'], ':sharedFk' => $formdata['sharedFk']])->one();
                $flag = 'U';
                $comments = 'updated successfully!';
                $model->ctnctt_updatedon = $date;
                $model->ctnctt_updatedby = $userPK;
                $model->ctnctt_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmstnctrnxtempTbl;
                $flag = 'C';
                $comments = 'added successfully!';
                $model->ctnctt_createdon = $date;
                $model->ctnctt_createdby = $userPK;
                $model->ctnctt_type = $formdata['dataType'];
                $model->ctnctt_status = 1;
                $model->ctnctt_shared_fk = $formdata['sharedFk'];
                $model->ctnctt_cmstnchdr_fk = $formdata['formPk'];
            }
            $model->ctnctt_title = $formdata['title'];
            $model->ctnctt_content = ($formdata['descContent']) ? $formdata['descContent'] : null;
            $model->ctnctt_upload = ($formdata['fileupload']) ? $formdata['fileupload'] : null;
            if ($model->save() === TRUE) {
                if($formdata['dataType']==2){
                    \api\modules\pms\models\CmstenderhdrtempTblQuery::isUpdate('common',$formdata);
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
                    'comments' => 'Something went wrong',
                    'returndata' => $model->getErrors()
                );
            }
            return $result;
        }
    }

    public function getDynamicViewListtemp($sharedFk, $dataType, $sharedType) {
        // $maintabledata = CmstnctrnxTbl::findAll(['ctnct_shared_fk' => $sharedFk, 'ctnct_type' => 2]);
        // if($maintabledata) {
        //     return CmstnctrnxTblQuery::getDynamicViewList($sharedFk, $dataType, $sharedType);
        // }
        $query = CmstnctrnxtempTbl::find()
                ->select(['cmstnctrnxtemp_pk as cmstnctrnx_pk', 'ctnctt_cmstnchdr_fk as ctnct_cmstnchdr_fk', 'ctnctt_title as ctnct_title',
                'ctnctt_shared_fk as ctnct_shared_fk', 'ctnctt_type as ctnct_type', 'ctnctt_content as ctnct_content', 'ctnctt_upload as ctnct_upload', 'ctnctt_status as ctnct_status',
                'ctnctt_createdon', 'ctnctt_createdby', 'mcfd_origfilename', 'mcfd_filetype',
                'mcfd_actualfilesize', 'mcfd_uploadedby', 'mcfd_memcompmst_fk'])
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=ctnctt_upload')
                ->where("ctnctt_shared_fk=:fk and ctnctt_type=:type and ctnctt_cmstnchdr_fk = :dataType and ctnctt_status = 1", [':fk' => $sharedFk, ':type' => $sharedType, ':dataType' => $dataType])
                ->orderBy([new \yii\db\Expression("coalesce(ctnctt_createdon,ctnctt_updatedon) DESC")])
                ->asArray()
                ->all();
        $finalData = [];
        foreach ($query as $kay => $dataVal) {
            $dataVal['ctnctt_content'] = strip_tags($dataVal['ctnctt_content']);
            if ($dataVal['ctnct_upload'] != null && $dataVal['ctnct_upload']) {
                $memcompfile_pk = $dataVal['ctnct_upload'];
                $memcomp_pk = $dataVal['mcfd_memcompmst_fk'];
                $user_pk = $dataVal['mcfd_uploadedby'];
                $dataVal['image_url'] = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk, 1);
            }
            $finalData[] = $dataVal;
        }

        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $finalData
        );
        return $result;
    }

    public function deleteDynamicDatatemp($dataPk) {
        if (!empty($dataPk)) {
            $model = CmstnctrnxtempTbl::find()->where("cmstnctrnxtemp_pk =:pk", [':pk' => $dataPk])->one();
            $model->ctnctt_status = 2;
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
