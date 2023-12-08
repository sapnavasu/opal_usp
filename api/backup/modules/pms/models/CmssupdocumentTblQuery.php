<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;
use \api\modules\quot\models\CmsquotationhdrTblQuery;
use api\modules\pms\models\CmstenderhdrTbl;

/**
 * This is the ActiveQuery class for [[CmssupdocumentTbl]].
 *
 * @see CmssupdocumentTbl
 */
class CmssupdocumentTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmssupdocumentTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumentTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    /**
     * saveData function  is used to save the Support Document information information
     * @param array $data permit attributes 
     * @return success array / failure array if data not saved  
     */
    public function saveData($data) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        if (isset($data['Pk']) && !empty($data['Pk']) && is_numeric($data['Pk'])) {
            $record = CmssupdocumentTbl::findByPk($data['Pk']);
            $record->attributes = $data;
            $record->cmssd_updatedon = date('Y-m-d H:i:s');
            $record->cmssd_updatedby = $userPK;
            $record->cmssd_updatedby = $userPK;
            $msg = 'Supporting Document Updated Successfully';
        } else {
            $record = new CmssupdocumentTbl();
            $record->attributes = $data;
            $record->cmssd_createdon = date('Y-m-d H:i:s');
            $record->cmssd_createdby = $userPK;
            $msg = 'Supporting Document Created Successfully';
        }
        $record->cmssd_status = 1;
        if ($record->save()) {
            $prefix = 'crsd';
            $underline = '_';
            foreach ($record as $col => $key) {
                $rdata[str_replace($underline, "", str_replace($prefix, "", $col))] = $key;
            }


            return ['status' => true, 'code' => 'S000', 'msg' => $msg, 'data' => $rdata];
        } else {
            return ['status' => false, 'code' => 'E001', 'msg' => 'Something went worng'];
            ;
        }
    }

    public function adddocument($data) {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $record = new CmssupdocumentTbl();
        $record->cmssd_upload = $data['filePk'];
        $record->cmssd_type = $data['type'];
        $record->cmssd_shared_fk = $data['shared_fk'];
        $record->cmssd_docname = $data['docname'];
        $record->cmssd_createdon = date('Y-m-d H:i:s');
        $record->cmssd_createdby = $userPK;
        $record->cmssd_status = 1;
        
        $delete_model = CmssupdocumentTbl::deleteAll([ 'and',
            ['cmssd_shared_fk' => $data['shared_fk']],
            ['cmssd_type' => $data['type']]]);

        $msg = 'Supporting Document Created Successfully';
        if ($record->save(false)) {
            return ['status' => true, 'code' => 'S000', 'msg' => $msg, 'data' => $record];
        } else {
            return ['status' => false, 'code' => 'E001', 'msg' => 'Something went worng'];
            ;
        }
    }

    public function getData($pk, $type) {

        $model = CmssupdocumentTbl::find()
                        ->select('cmssupdocument_pk as cmssupdocumentpk,'
                                . 'cmssd_upload,mcfd_memcompmst_fk,memcompfiledtls_pk,mcfd_uploadedby,'
                                . 'cmssd_shared_fk as sharedfk, '
                                . 'cmssd_docname as docname, '
                                . 'cmssd_createdon as docdate, '
                                . 'mcfd_actualfilesize as docsize, '
                                . 'cmssd_upload as upload')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=cmssd_upload')
                        ->where("cmssd_shared_fk=:pk and cmssd_type=:type AND cmssd_status=:status", [':pk' => $pk, ':type' => $type, ':status' => 1])
                        ->asArray()->all();
        $docDataArray = [];
        $filecount = count($model);
        foreach ($model as $docVal) {
            if ($docVal['memcompfiledtls_pk'] != null) {
                $memcompfile_pk = $docVal['memcompfiledtls_pk'];
                $memcomp_pk = $docVal['mcfd_memcompmst_fk'];
                $user_pk = $docVal['mcfd_uploadedby'];
                $img_path = Drive::generateUrl($memcompfile_pk, $memcomp_pk, $user_pk);
                $docVal['image_url'] = $img_path;
                $filename = Drive::getFileName(Security::encrypt($memcompfile_pk));
                $filenamearray = explode('.', $filename);
                $docVal['fileName'] = $filename;
                $docVal['fileType'] = end($filenamearray);
                $docDataArray[] = $docVal;
            } else {
                $docVal['image_url'] = null;
                $docDataArray[] = $docVal;
            }
        }

        if (!empty($model)) {
            $rdata = ['status' => true, 'code' => 'S000', 'msg' => '', 'data' => $docDataArray, 'fileCount' => $filecount];
        } else {
            $rdata = ['status' => false, 'code' => 'E001', 'msg' => 'Record not found'];
        }
        return $rdata;
    }

    public function delData($id) {

        $record = CmssupdocumentTbl::findOne($id);
        if (!empty($record)) {
            if ($record->delete())
                $rdata = ['status' => true, 'code' => 'S000', 'msg' => 'Supporting Document Deleted Successfully', 'data' => $model];
            else
                $rdata = ['status' => false, 'code' => 'E002', 'msg' => 'Something went wrong'];
        }else {
            $rdata = ['status' => false, 'code' => 'E001', 'msg' => 'Record not found'];
        }
        return $rdata;
    }

    public function saveSupportingDocument($formdata) {
        if (!empty($formdata)) {
            if ($formdata['dataType'] == 7) {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->cmsch_supdocremarks = $formdata['remark_disc'];
            } elseif ($formdata['dataType'] == 1) {
                $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->crfd_remarks = $formdata['remark_disc'];
            } elseif ($formdata['dataType'] == 3) {
                $model = CmstenderhdrTbl::find()->where("cmstenderhdr_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->cmsth_remarks = $formdata['remark_disc'];
            } elseif ($formdata['dataType'] == 14) {
                $model = \api\modules\quot\models\CmsquotationhdrTbl::find()->where("cmsquotationhdr_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->cmsqh_suppdocremark = $formdata['remark_disc'];
            }
            if ($model) {
                // if ($model->cmsch_supdocremarks != null || $model->crfd_remarks != null) {
                //     $comments = 'Supporting Document Updated Successfully';
                //     $flag = 'U';
                // } else {
                $comments = 'Supporting Document Added Successfully';
                $flag = 'C';
                // }
                if ($model->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => $flag,
                        'comments' => $comments
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

    public function supportDocumentSave($formdata) {
        $sharedFk = $formdata['sharedfk'];
        $dataType = $formdata['type'];
        $uploadArray = $formdata['fileupload'];
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        foreach ($uploadArray as $key => $dataVal) {
            if ($dataVal) {
                $module = new CmssupdocumentTbl();
                $module->cmssd_shared_fk = $sharedFk;
                $module->cmssd_type = $dataType;
                $module->cmssd_upload = $dataVal;
                $module->cmssd_status = 1;
                $module->cmssd_createdon = $date;
                $module->cmssd_createdby = $userPK;
                $module->cmssd_createdbyipaddr = $ip_address;
                if ($module->save() === TRUE) {
                    $result = array(
                        'status' => 200,
                        'msg' => 'success',
                        'flag' => 'S',
                        'moduleData' => '',
                    );
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'Error',
                        'flag' => 'E',
                        'moduleData' => $module->getErrors(),
                    );
                }
            }
        }

        return $result;
    }

    public function saveQouteSupportDoc($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = new CmssupdocumentTbl();
            $model->cmssd_shared_fk = $data['formData']['quotationpk'];
            $model->cmssd_type = $data['formData']['type'];
            $model->cmssd_docname = $data['formData']['docname'];
            $model->cmssd_upload = $data['formData']['compfile_fk'];
            $model->cmssd_status = $data['formData']['status'];
            $model->cmssd_createdon = $date;
            $model->cmssd_createdby = $userPK;
            $model->cmssd_createdbyipaddr = $ip_address;

            CmsquotationhdrTblQuery::saveSupdocRemark($data);

            if ($model->save() == TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Supporting document added Successfully!',
                    'quotationpk' => $data['formData']['quotationpk'],
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
        }
        return $result;
    }

    /**
     * get by shared Fk
     */
    public function findBySharedFk($sharedfk) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
            'returndata' => []
        );

        if ($sharedfk) {

            $data = CmssupdocumentTbl::find()
                    ->where(['cmssd_shared_fk' => $sharedfk])
                    ->with('cmssdUpload')
                    ->all();

            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'returndata' => $data
            );
        }
        return $result;
    }

    public function updateQouteSupportDoc($data) {
        $result = array(
            'status' => 200,
            'msg' => 'warning',
            'flag' => 'E',
            'comments' => 'No Data',
        );

        if ($data) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmssupdocumentTbl::find()->where(['cmssd_shared_fk' => $data['formData']['quotationpk']])->one();
            $model->cmssd_shared_fk = $data['formData']['quotationpk'];
            $model->cmssd_type = $data['formData']['type'];
            $model->cmssd_docname = $data['formData']['docname'];
            $model->cmssd_upload = $data['formData']['compfile_fk'];
            $model->cmssd_status = $data['formData']['status'];
            $model->cmssd_createdon = $date;
            $model->cmssd_createdby = $userPK;
            $model->cmssd_createdbyipaddr = $ip_address;

            CmsquotationhdrTblQuery::saveSupdocRemark($data);

            if ($model->save() == TRUE) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Supporting document updated Successfully!',
                    'quotationpk' => $data['formData']['quotationpk'],
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
        }
        return $result;
    }

    public function creatSupportingDocument($data, $dataPk, $dataType) {
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $ip_address = Common::getIpAddress();
        $module = new CmssupdocumentTbl();
        $module->cmssd_shared_fk = $dataPk;
        $module->cmssd_type = $dataType;
        $module->cmssd_docname = $data->cmssd_docname;
        $module->cmssd_upload = $data->cmssd_upload;
        $module->cmssd_status = 1;
        $module->cmssd_createdon = $date;
        $module->cmssd_createdby = $userPK;
        $module->cmssd_createdbyipaddr = $ip_address;
        if ($module->save() === TRUE) {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => 'success'
            );
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'Error',
                'flag' => 'E',
                'comments' => 'Something went wrong!',
                'moduleData' => $module->getErrors(),
            );
        }
        return $result;
    }

}
