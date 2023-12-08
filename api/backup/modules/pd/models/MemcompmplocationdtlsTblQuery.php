<?php

namespace api\modules\pd\models;

use yii\data\ActiveDataProvider;
use common\components\Security;
use api\modules\pd\models\ProjectdtlsTblQuery;
use api\modules\pd\models\ProjectdtlsTbl;

/**
 * This is the ActiveQuery class for [[MemcompmplocationdtlsTbl]].
 *
 * @see MemcompmplocationdtlsTbl
 */
class MemcompmplocationdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return MemcompmplocationdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompmplocationdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function addofflocation($data) {
        $projectPk = $data['projectpk'];

        $model = new MemcompmplocationdtlsTbl();
        $model->mcmpld_membercompmst_fk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model->mcmpld_address = $data['projectloc']['off_line'];
        $model->mcmpld_latitude = $data['projectloc']['off_add'][0];
        $model->mcmpld_longitude = $data['projectloc']['off_add'][1];
        $model->mcmpld_statemst_fk = $data['projectloc']['off_gov'];
        $model->mcmpld_citymst_fk = $data['projectloc']['off_cty'];

        if ($model->save() === false) {
            $result = array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Something went wrong!',
            );
        }
        $result = array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag' => 'S',
            'msg' => 'Project office location added successfully!',
            'data' => $model->memcompmplocationdtls_pk,
        );
        $new = ProjecttmpTbl::find()
                ->where('projecttmp_pk=:pk', array(':pk' => \common\components\Security::decrypt($projectPk)))
                ->one();
        if ($new) {
            $new->prjt_memcompmplocationdtls_fk = $model->memcompmplocationdtls_pk;
            if ($new->save() == false) {
                $result = array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag' => 'E',
                    'msg' => 'Something went wrong!'
                );
            }
        }
        return json_encode($result);
    }

    public function getoffloc() {
        $model = MemcompmplocationdtlsTbl::find()
                        ->select(['*'])
                        ->leftJoin('statemst_tbl', 'mcmpld_statemst_fk=StateMst_Pk')
                        ->leftJoin('citymst_tbl', 'mcmpld_citymst_fk=CityMst_Pk')
                        ->where('mcmpld_membercompmst_fk=:by', array(':by' => \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true)))
                        ->orderBy(['memcompmplocationdtls_pk' => SORT_DESC])
                        ->asArray()->all();
        return($model);
    }

    public function getContatData($dataPk,$dataType) {
        $model = MemcompmplocationdtlsTbl::find()
                ->select(['memcompmplocationdtls_pk','mcmpld_locationtype','mcmpld_officename','mcmpld_address','mcmpld_latitude','mcmpld_longitude','mcmpld_countrymst_fk','mcmpld_statemst_fk','mcmpld_citymst_fk','mcmpld_landlinenocc','mcmpld_landlineno','mcmpld_landlineext','mcmpld_emailid','CyM_CountryName_en','CM_CityName_en','SM_StateName_en'])
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'mcmpld_statemst_fk=StateMst_Pk')
                ->leftJoin('citymst_tbl', 'mcmpld_citymst_fk=CityMst_Pk')
                ->where('mcmpld_locationtype=:type', array(':type' => $dataType == 1 ? 17 :18))
                ->andWhere('memcompmplocationdtls_pk=:pk', array(':pk' => $dataPk))
                ->asArray()
                ->one();
            $result = array(
                'status' => 200,
                'msg' => 'Success',
                'flag' => 'S',
                'returndata' => $model ? $model: [],
            );
            return $result;
    }
    public function getContatDataArray($comPk,$dataType) {
        $model = MemcompmplocationdtlsTbl::find()
                ->select(['memcompmplocationdtls_pk','mcmpld_locationtype','mcmpld_officename','mcmpld_address','mcmpld_latitude','mcmpld_longitude','mcmpld_countrymst_fk','mcmpld_statemst_fk','mcmpld_citymst_fk','mcmpld_landlinenocc','mcmpld_landlineno','mcmpld_landlineext','mcmpld_emailid','CyM_CountryName_en','CM_CityName_en','SM_StateName_en',])
                ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                ->leftJoin('statemst_tbl', 'mcmpld_statemst_fk=StateMst_Pk')
                ->leftJoin('citymst_tbl', 'mcmpld_citymst_fk=CityMst_Pk')
                ->where('mcmpld_locationtype=:type', array(':type' => $dataType == 1 ? 17 :18))
                ->andWhere('mcmpld_membercompmst_fk=:pk', array(':pk' => $comPk))
                ->asArray()
                ->all();
            $result = array(
                'status' => 200,
                'msg' => 'Success',
                'flag' => 'S',
                'returndata' => $model ? $model: [],
            );
            return $result;
    }
    public function saveContactData($formdata) {
         if (!empty($formdata)) {
            if (!empty($formdata['dataPk']) && $formdata['dataPk'] != null) {
                $model = MemcompmplocationdtlsTbl::find()->where("cmscontracthdr_pk =:pk", [':pk' => $formdata['dataPk']])->one();
                $comments = 'Data Updated Successfully';
                $flag = 'U';
            } else {
                $model = new MemcompmplocationdtlsTbl;
                $flag = 'C';
                $comments = 'Data Added Successfully';
                $model->mcmpld_membercompmst_fk = $formdata['companyPk'];
                $model->mcmpld_locationtype = $formdata['dataType'] == 1 ? 17 : 18;
            }
            $model->mcmpld_officename = $formdata['companyName'];
            $model->mcmpld_address = $formdata['selected_address'];
            $model->mcmpld_countrymst_fk = $formdata['country'];
            $model->mcmpld_statemst_fk = $formdata['state'];
            $model->mcmpld_citymst_fk = $formdata['city'];
            $model->mcmpld_landlineno = $formdata['landline_no'];
            $model->mcmpld_landlinenocc = $formdata['landline_cc'];
            $model->mcmpld_landlineext = $formdata['landline_ext'];
            $model->mcmpld_emailid = $formdata['email'];
            $model->mcmpld_latitude = $formdata['selected_latitude'];
            $model->mcmpld_longitude = $formdata['selected_longitude'];
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
    public function deleteContactData($dataPk) {
        if (!empty($dataPk)) {
            $model = MemcompmplocationdtlsTbl::find()->where("memcompmplocationdtls_pk =:pk", [':pk' => $dataPk])->one();
            if ($model->delete() === false) {
                $result = array(
                    'status' => 200,
                    'msg' => 'warning',
                    'flag' => 'E',
                    'comments' => 'Something went wrong!',
                    'returndata' => $model->getErrors()
                );
            } else {
                $result = array(
                    'status' => 200,
                    'msg' => 'Success',
                    'flag' => 'S',
                );
            }
            return $result;
        }
    }

    public function getviewoffloc($data) {
        $projectPk = $data['projectpk'];
        if (!empty($projectPk)) {
            $model = MemcompmplocationdtlsTbl::find()
                            ->select(['*'])
                            ->leftJoin('statemst_tbl', 'mcmpld_statemst_fk=StateMst_Pk')
                            ->leftJoin('citymst_tbl', 'mcmpld_citymst_fk=CityMst_Pk')
                            ->andWhere('projecttmp_pk=:pk', array(':pk' => \common\components\Security::decrypt($projectPk)))
                            ->asArray()->one();
            return($model);
        }
    }

    public function getofflocbyid($data) {
        $locationPk = $data['locationpk'];
        $model = MemcompmplocationdtlsTbl::find()
                        ->select(['*'])
                        ->andWhere('memcompmplocationdtls_pk=:pk', array(':pk' => \common\components\Security::decrypt($locationPk)))
                        ->asArray()->one();
        return($model);
    }

    public function GetLocationData($locationPk) {
;
        $model = MemcompmplocationdtlsTbl::find()
                        ->select(['*'])
                        ->andWhere('memcompmplocationdtls_pk=:pk', array(':pk' => $locationPk))
                        ->asArray()->one();
        return($model);
    }
    public function getLocationDataByPk($locationPk) {
        $model = MemcompmplocationdtlsTbl::find()
                        ->select(['mcmpld_address', 'mcmpld_landlineno', 'mcmpld_emailid','mcmpld_countrymst_fk', 'CyM_CountryDialCode as dialcode', 'CyM_CountryName_en as countryName', 'SM_StateName_en as stateName', 'CM_CityName_en as cityName','memcompmplocationdtls_pk as locationPk'])
                        ->leftJoin('countrymst_tbl', 'CountryMst_Pk=mcmpld_countrymst_fk')
                        ->leftJoin('statemst_tbl', 'StateMst_Pk=mcmpld_statemst_fk')
                        ->leftJoin('citymst_tbl', 'CityMst_Pk=mcmpld_citymst_fk')
                        ->where('memcompmplocationdtls_pk=:pk', array(':pk' => $locationPk))
                        ->asArray()->one();
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $model,
        );
        return $result;
    }

    public function updateoffloc($data) {
        $locationPk = $data['locationpk'];
        $model = MemcompmplocationdtlsTbl::find()
                ->select(['*'])
                ->andWhere('memcompmplocationdtls_pk=:pk', array(':pk' => \common\components\Security::decrypt($locationPk)))
                ->one();
        $model->mcmpld_address = $data['projectloc']['off_line'];
        $model->mcmpld_latitude = $data['projectloc']['off_add'][0];
        $model->mcmpld_longitude = $data['projectloc']['off_add'][1];
        $model->mcmpld_statemst_fk = $data['projectloc']['off_gov'];
        $model->mcmpld_citymst_fk = $data['projectloc']['off_cty'];

        if ($model->save() === false) {
            $result = array(
                'status' => 404,
                'statusmsg' => 'warning',
                'flag' => 'E',
                'msg' => 'Something went wrong!',
            );
        }
        $result = array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag' => 'S',
            'msg' => 'Project office location updated successfully!',
        );
        return json_encode($result);
    }

    public function addAdditionalInfo($data) {
        if ($data['dataPk'] != '' && $data['dataPk'] != null) {
            $model = MemcompmplocationdtlsTbl::find()->where("memcompmplocationdtls_pk =:pk", [':pk' => $data['dataPk']])->one();
            $dataStatus = 'Additional Data Update Successfully!';
        } else {
            $model = new MemcompmplocationdtlsTbl();
            $dataStatus = 'Additional Data Add Successfully!';
        }
        $model->mcmpld_membercompmst_fk = $data['companyPk'];
        $model->mcmpld_locationtype = $data['dataType'];
        $model->mcmpld_otherloc = $data['othertype'];
        $model->mcmpld_officename = $data['companyName'];
        $model->mcmpld_address = $data['address'];
        $model->mcmpld_countrymst_fk = $data['country'];
        $model->mcmpld_statemst_fk = $data['state'];
        $model->mcmpld_citymst_fk = $data['city'];
        $model->mcmpld_landlinenocc = $data['landline_cc'];
        $model->mcmpld_landlineno = $data['landline_no'];
        $model->mcmpld_landlineext = $data['landline_ext'];
        $model->mcmpld_emailid = $data['emailid'];
        $model->mcmpld_website = $data['website'];
        if ($model->save() === TRUE) {
            $dataList = MemcompmplocationdtlsTbl::find()
                    ->select(['mcmpld_membercompmst_fk', 'mcmpld_locationtype', 'mcmpld_otherloc', 'mcmpld_officename', 'mcmpld_address', 'mcmpld_countrymst_fk', 'mcmpld_statemst_fk', 'mcmpld_citymst_fk', 'mcmpld_landlinenocc', 'mcmpld_landlineno', 'mcmpld_landlineext', 'mcmpld_emailid', 'mcmpld_website', 'memcompmplocationdtls_pk'])
                    ->where('mcmpld_membercompmst_fk = :mcmpld_membercompmst_fk', ['mcmpld_membercompmst_fk' => $data['companyPk']])
                    ->andWhere('mcmpld_locationtype=:type', array(':type' => $data['dataType']))
                    ->orderBy(['memcompmplocationdtls_pk' => SORT_DESC])
                    ->asArray()
                    ->all();
            $finaArray=[];
            foreach ($dataList as $dataVal) {
                $dataVal['type']=$data['dataType'];
                $dataVal['checked']=false;
                $finaArray[]=$dataVal;
            }
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'comments' => $dataStatus,
                'dataList' => $finaArray,
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
        return json_encode($result);
    }
     public static function checkIsCompanyEmailAlreadyExists($dataToCheck,$regpk = '',$stktype=''){
         $retsts = TRUE;
         $isAvailable =  \common\models\UsermstTbl::checkIsEmailAlreadyExists($dataToCheck,$regpk,$stktype);
        if($isAvailable) {
            $isAvailable = \common\models\UsermstTbl::checkEmailIsActiveorInactive($dataToCheck,$regpk,$stktype);
        } else {
            $isAvailable = 'false';        
        }
        if($isAvailable == "false"){
            $retsts = FALSE;
        }
        return $retsts;
    }
}
