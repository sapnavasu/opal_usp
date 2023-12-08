<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmstnctrnxTbl]].
 *
 * @see CmstnctrnxTbl
 */
class CmstnctrnxTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmstnctrnxTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmstnctrnxTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function SubmitDynamicForm($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['dynamicPk']) && $formdata['dynamicPk'] != null) {
                $model = CmstnctrnxTbl::find()->where("cmstnctrnx_pk =:pk and ctnct_shared_fk = :sharedFk", [':pk' => $formdata['dynamicPk'], ':sharedFk' => $formdata['sharedFk']])->one();
                $flag = 'U';
                $comments = 'updated successfully!';
                $model->ctnct_updatedon = $date;
                $model->ctnct_updatedby = $userPK;
                $model->ctnct_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmstnctrnxTbl;
                $flag = 'C';
                $comments = 'added successfully!';
                $model->ctnct_createdon = $date;
                $model->ctnct_createdby = $userPK;
                $model->ctnct_type = $formdata['dataType'];
                $model->ctnct_status = 1;
                $model->ctnct_shared_fk = $formdata['sharedFk'];
                $model->ctnct_cmstnchdr_fk = $formdata['formPk'];
            }
            $model->ctnct_title = $formdata['title'];
            $model->ctnct_content = ($formdata['descContent']) ? $formdata['descContent'] : null;
            $model->ctnct_upload = ($formdata['fileupload']) ? $formdata['fileupload'] : null;
            if ($model->save() === TRUE) {
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

    public function saveBidderTerms($formdata) {
        $result = ['status' => true];
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['bidderTermsPk']) && $formdata['bidderTermsPk'] != null) {
                $model = CmstnctrnxTbl::find()->where("cmstnctrnx_pk =:pk and ctnct_shared_fk = :sharedFk", [':pk' => $formdata['bidderTermsPk'], ':sharedFk' => $formdata['currentPk']])->one();
                $model->ctnct_updatedon = $date;
                $model->ctnct_updatedby = $userPK;
                $model->ctnct_updatedbyipaddr = $ip_address;
            } else {
                $model = new CmstnctrnxTbl;
                $model->ctnct_createdon = $date;
                $model->ctnct_createdby = $userPK;
                $model->ctnct_type = 4;
                $model->ctnct_status = 1;
                $model->ctnct_shared_fk = $formdata['currentPk'];
                $model->ctnct_cmstnchdr_fk = 15;
            }
            $model->ctnct_content = ($formdata['bidderTerms']) ? $formdata['bidderTerms'] : null;
            $model->ctnct_upload = ($formdata['fileupload_Db']) ? $formdata['fileupload_Db'] : null;
            if (!$model->save()) {
                $result = array(
                    'status' => 200,
                    'msg' => 'Error',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors(),
                );
            }
        }
        return $result;
    }

    public function getDynamicList($sharedFk, $exSharedFk, $dataType, $exDataType, $exFormType, $formType) {
        if (!empty($sharedFk)) {
            $query = self::searchDynamicData($sharedFk, $dataType, $formType, 1);
            if (empty($query) && !empty($exSharedFk)) {
                $query = self::searchDynamicData($sharedFk, $dataType, $formType, 2);
                if (empty($query)) {
                    $query = self::searchDynamicData($exSharedFk, $dataType, $exFormType, 1);
                    if (!empty($query)) {
                        $ip_address = Common::getIpAddress();
                        $date = date('Y-m-d H:i:s');
                        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
                        foreach ($query as $kay => $dataVal) {
                            $model = new CmstnctrnxTbl;
                            $model->ctnct_createdon = $date;
                            $model->ctnct_createdby = $userPK;
                            $model->ctnct_type = $formType;
                            $model->ctnct_status = 1;
                            $model->ctnct_shared_fk = $sharedFk;
                            $model->ctnct_cmstnchdr_fk = $dataType;
                            $model->ctnct_title = $dataVal['ctnct_title'];
                            $model->ctnct_content = ($dataVal['ctnct_content']) ? $dataVal['ctnct_content'] : null;
                            $model->ctnct_upload = ($dataVal['ctnct_upload']) ? $dataVal['ctnct_upload'] : null;
                            if ($model->save() === TRUE) {
                                
                            } else {
                                $result = array(
                                    'status' => 200,
                                    'msg' => 'warning',
                                    'flag' => 'E',
                                    'comments' => 'Something went wrong',
                                    'returndata' => $model->getErrors()
                                );
                                return $result;
                            }
                        }
                        $query = self::searchDynamicData($sharedFk, $dataType, $formType, 1);
                    }
                } else {
                    $query = [];
                }
            }
            $finalData = [];
            foreach ($query as $kay => $dataVal) {
                $dataVal['ctnct_content'] = strip_tags($dataVal['ctnct_content']);
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
    }

    public function searchDynamicData($sharedFk, $dataType, $sharedType, $type) {
        if ($type == 1) {
            $query = CmstnctrnxTbl::find()
                    ->select(['cmstnctrnx_pk', 'ctnct_cmstnchdr_fk', 'ctnct_title', 'ctnct_shared_fk', 'ctnct_type', 'ctnct_content', 'ctnct_upload', 'ctnct_status', 'ctnct_createdon', 'ctnct_createdby', 'mcfd_origfilename', 'mcfd_filetype', 'mcfd_actualfilesize', 'mcfd_uploadedby', 'mcfd_memcompmst_fk'])
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=ctnct_upload')
                    ->where("ctnct_shared_fk=:fk and ctnct_type=:type and ctnct_cmstnchdr_fk = :dataType and ctnct_status = 1", [':fk' => $sharedFk, ':type' => $sharedType, ':dataType' => $dataType])
                    ->orderBy([new \yii\db\Expression("coalesce(ctnct_createdon,ctnct_updatedon) DESC")])
                    ->asArray()
                    ->all();
        } else {
            $query = CmstnctrnxTbl::find()
                    ->select(['cmstnctrnx_pk', 'ctnct_cmstnchdr_fk', 'ctnct_title', 'ctnct_shared_fk', 'ctnct_type', 'ctnct_content', 'ctnct_upload', 'ctnct_status', 'ctnct_createdon', 'ctnct_createdby', 'mcfd_origfilename', 'mcfd_filetype', 'mcfd_actualfilesize', 'mcfd_uploadedby', 'mcfd_memcompmst_fk'])
                    ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=ctnct_upload')
                    ->where("ctnct_shared_fk=:fk and ctnct_type=:type and ctnct_cmstnchdr_fk = :dataType", [':fk' => $sharedFk, ':type' => $sharedType, ':dataType' => $dataType])
                    ->orderBy([new \yii\db\Expression("coalesce(ctnct_createdon,ctnct_updatedon) DESC")])
                    ->asArray()
                    ->all();
        }
        return $query;
    }

    public function getDynamicViewList($sharedFk, $dataType, $sharedType) {
        $query = CmstnctrnxTbl::find()
                ->select(['cmstnctrnx_pk', 'ctnct_cmstnchdr_fk', 'ctnct_title', 'ctnct_shared_fk', 'ctnct_type', 'ctnct_content', 'ctnct_upload', 'ctnct_status', 'ctnct_createdon', 'ctnct_createdby', 'mcfd_origfilename', 'mcfd_filetype', 'mcfd_actualfilesize', 'mcfd_uploadedby', 'mcfd_memcompmst_fk'])
                ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=ctnct_upload')
                ->where("ctnct_shared_fk=:fk and ctnct_type=:type and ctnct_cmstnchdr_fk = :dataType and ctnct_status = 1", [':fk' => $sharedFk, ':type' => $sharedType, ':dataType' => $dataType])
                ->orderBy([new \yii\db\Expression("coalesce(ctnct_createdon,ctnct_updatedon) DESC")])
                ->asArray()
                ->all();
        $finalData = [];
        foreach ($query as $kay => $dataVal) {
            $dataVal['ctnct_content'] = strip_tags($dataVal['ctnct_content']);
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

    public function deleteDynamicData($dataPk) {
        if (!empty($dataPk)) {
            $model = CmstnctrnxTbl::find()->where("cmstnctrnx_pk =:pk", [':pk' => $dataPk])->one();
            $model->ctnct_status = 2;
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
