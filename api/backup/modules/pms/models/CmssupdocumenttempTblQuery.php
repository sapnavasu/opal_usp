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
 * This is the ActiveQuery class for [[CmssupdocumenttempTbl]].
 *
 * @see CmssupdocumenttempTbl
 */
class CmssupdocumenttempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmssupdocumenttempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmssupdocumenttempTbl|array|null
     */
    public function one($db = null)
    {
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
            $record = CmssupdocumenttempTbl::findByPk($data['Pk']);
            $record->attributes = $data;
            $record->cmssdt_updatedon = date('Y-m-d H:i:s');
            $record->cmssdt_updatedby = $userPK;
            $record->cmssdt_updatedby = $userPK;
            $msg = 'Supporting Document Updated Successfully';

        } else {
            $record = new CmssupdocumenttempTbl();
            $record->attributes = $data;
            $record->cmssdt_createdon = date('Y-m-d H:i:s');
            $record->cmssdt_createdby = $userPK;
            $msg = 'Supporting Document Created Successfully';

        }
        $record->cmssdt_status = 1;
        if ($record->save()) {
            if(isset($data['cmssdt_shared_fk'])&&$data['cmssdt_shared_fk']!='')
                CmstenderhdrtempTblQuery::isUpdate('supportdoc',$data['cmssdt_shared_fk']);
            // $result
            $prefix = 'crsdt';
            $underline = '_';
            foreach ($record as $col => $key) {
                $rdata[str_replace($underline, "", str_replace($prefix, "", $col))] = $key;
            }

            return ['status' => true, 'code' => 'S000', 'msg' => $msg, 'data' => $rdata];
        } else {
            return ['status' => false, 'code' => 'E001', 'msg' => 'Something went worng'];
        }
    }

    public function getDatatemp($pk, $type) {

        $model = CmssupdocumenttempTbl::find()
                        ->select('cmssupdocumenttemp_pk as cmssupdocumentpk,'
                                . 'cmssdt_upload,mcfd_memcompmst_fk,memcompfiledtls_pk,mcfd_uploadedby,'
                                . 'cmssdt_shared_fk as sharedfk, '
                                . 'cmssdt_docname as docname, '
                                . 'cmssdt_createdon as docdate, '
                                . 'mcfd_actualfilesize as docsize, '
                                . 'cmssdt_upload as upload')
                        ->leftJoin('memcompfiledtls_tbl', 'memcompfiledtls_pk=cmssdt_upload')
                        ->where("cmssdt_shared_fk=:pk and cmssdt_type=:type AND cmssdt_status=:status", [':pk' => $pk, ':type' => $type, ':status' => 1])
                        ->asArray()->all();
        $docDataArray = [];
        $filecount = count($model);
        foreach ($model as $key => $docVal) {
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

    public function saveSupportingDocumenttemp($formdata) {
        if (!empty($formdata)) {
            if ($formdata['dataType'] == 7) {
                $model = CmscontracthdrTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->cmsch_supdocremarks = $formdata['remark_disc'];
            } elseif ($formdata['dataType'] == 1) {
                $model = CmsrequisitionformdtlsTbl::find()->where("cmsrequisitionformdtls_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->crfd_remarks = $formdata['remark_disc'];
            } elseif ($formdata['dataType'] == 3) {
                // $model = CmstenderhdrTbl::find()->where("cmstenderhdr_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                // $model->cmsth_remarks = $formdata['remark_disc'];
                $model = CmstenderhdrtempTbl::find()->where("cmstenderhdrtemp_pk =:pk", [':pk' => $formdata['sharedFk']])->one();
                $model->cmstht_remarks = $formdata['remark_disc'];
                
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
                    
                    if($formdata['dataType'] == 3){
                        $isupdated = CmstenderhdrtempTblQuery::isUpdate('supportdoctext',$formdata);
                        if($isupdated){
                            $model->cmstht_mailfor = $isupdated;
                            $model->save();
                        }
                    }
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

    public function delDatatemp($id) {

        $record = CmssupdocumenttempTbl::findOne($id);
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
}
