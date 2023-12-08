<?php

namespace api\modules\pms\models;
use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmsinspreqdochdrtempTbl]].
 *
 * @see CmsinspreqdochdrtempTbl
 */
class CmsinspreqdochdrtempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrtempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsinspreqdochdrtempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function saveInspectionReqtemp($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (empty($formdata['headerPk']) && $formdata['headerPk'] == null) {
                $model = new CmsinspreqdochdrtempTbl;
                $model->cirdht_createdon = $date;
                $model->cirdht_createdby = $userPK;
                $model->cirdht_createdbyipaddr = $ip_address;
                $model->cirdht_status = 1;
                $model->cirdht_cmstnchdr_fk = $formdata['dynmicPk'];
                $model->cirdht_shared_fk = $formdata['sharedFk'];
                $model->cirdht_shared_type = $formdata['formType'];
                $model->cirdht_itprefno = $formdata['itp_ref_num'];
                $model->cirdht_itpdate = $formdata['itp_date'];
                $model->cirdht_itpusermst_fk = $formdata['itp_issuedBy'];
                $model->cirdht_technote = $formdata['techNotes'];
                $model->cirdht_generalnote = $formdata['generalNotes'];
                $model->cirdht_applspec = $formdata['appSpecifications'];
                $flag = 'S';
                $comments = 'Created Successfully!';
                if ($model->save() === TRUE) {
                    if($formdata['formType']==2){
                        \api\modules\pms\models\CmstenderhdrtempTblQuery::isUpdate('common',$formdata);
                    }
                    if (empty($formdata['dtlsPk']) && $formdata['dtlsPk'] == null) {
                        $result = CmsinspreqdocdtlstempTblQuery::saveInspectionReqtemp($formdata, $model->cmsinspreqdochdrtemp_pk);
                    } else {
                        $result = array(
                            'status' => 200,
                            'msg' => 'success',
                            'flag' => $flag,
                            'comments' => $comments,
                        );
                    }
                } else {
                    $result = array(
                        'status' => 200,
                        'msg' => 'warning',
                        'flag' => 'E',
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            } else {
                $result = CmsinspreqdocdtlstempTblQuery::saveInspectionReqtemp($formdata, $formdata['headerPk']);
            }
            return $result;
        }
    }

    public function getInspectionRequirenmentViewListtemp($sharedFk, $dataType, $sharedType) { 

        $query = CmsinspreqdochdrtempTbl::find()
            ->select(['cmsinspreqdochdrtemp_pk as headerPk', 'cirdht_cmstnchdr_fk as dynmicPk', 'cirdht_shared_fk as sharedFk', 'cirdht_itprefno as itp_ref_num', 'cirdht_itpdate as itp_date', 'cirdht_itpusermst_fk as itp_issuedBy', 'um_firstname as userName', 'cirdht_technote as cirdh_technote', 'cirdht_generalnote as cirdh_generalnote', 
            'cirdht_applspec as cirdh_applspec', 'cirdht_createdon as cirdh_createdon', 'cirdht_updatedon as cirdh_updatedon',
            'cmsinspreqdocdtlstemp_pk as dtlsPk', 'cirddt_activityno as cirdd_activityno', 'cirddt_activitytitle as cirdd_activitytitle', 
            'cirddt_refdoc as cirdd_refdoc', 'cirddt_remarks as cirdd_remarks', 'cirddt_status as cirdd_status', 
            'cirddt_createdon as cirdd_createdon', 'cirddt_updatedon as cirdd_updatedon'])
            ->leftJoin('cmsinspreqdocdtlstemp_tbl', 'cirddt_cmsinspreqdochdrtemp_fk = cmsinspreqdochdrtemp_pk and cirddt_status = 1')
            ->leftJoin('usermst_tbl', 'UserMst_Pk = cirdht_itpusermst_fk')
            ->where("cirdht_cmstnchdr_fk=:dataType and cirdht_shared_fk = :sharedFk and cirdht_shared_type =:sharedType and cirddt_status = 1", [':dataType' => $dataType, ':sharedFk' => $sharedFk, ':sharedType' => $sharedType])
            ->orderBy([new \yii\db\Expression("coalesce(cirddt_createdon,cirddt_updatedon) DESC")])
            ->asArray()
            ->all();
        $finallData = [];
        if ($query) {
            foreach ($query as $key => $item) {
                if (!empty($item['dtlsPk']) && $item['dtlsPk'] != null) {
                    //need history and temp table for this
                    $item['quontumChkArray'] = CmsinspreqdocactionmaptempTblQuery::getMapData($item['dtlsPk']);
                }
                $finallData[] = $item;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $finallData ? $finallData : []
        );
        return $result;
    }

    public function updateInspectionReqtemp($formdata) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            if (!empty($formdata['headerPk']) && $formdata['headerPk'] != null) {
                $model = CmsinspreqdochdrtempTbl::find()->where("cmsinspreqdochdrtemp_pk =:pk and cirdht_shared_fk = :sharedFk", [':pk' => $formdata['headerPk'], ':sharedFk' => $formdata['sharedFk']])->one();
                $flag = 'U';
                $comments = 'Updated Successfully!';
                $model->cirdht_updatedon = $date;
                $model->cirdht_updatedby = $userPK;
                $model->cirdht_updatedbyipaddr = $ip_address;
                $model->cirdht_technote = $formdata['techNotes'];
                $model->cirdht_generalnote = $formdata['generalNotes'];
                $model->cirdht_applspec = $formdata['appSpecifications'];
                
                if ($model->save() === TRUE) {
                    if($formdata['formType']==2){
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
                        'comments' => 'Something went wrong!',
                        'returndata' => $model->getErrors()
                    );
                }
            }
            return $result;
        }
    }
}
