<?php

namespace api\modules\pms\models;

use common\components\Security;
use common\components\Common;
use common\components\Drive;
use yii\data\ActiveDataProvider;
use Yii;
use yii\helpers\Url;

/**
 * This is the ActiveQuery class for [[CmscontractagreementdtlsTbl]].
 *
 * @see CmscontractagreementdtlsTbl
 */
class CmscontractagreementdtlsTblQuery extends \yii\db\ActiveQuery {
    /* public function active()
      {
      return $this->andWhere('[[status]]=1');
      } */

    /**
     * {@inheritdoc}
     * @return CmscontractagreementdtlsTbl[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmscontractagreementdtlsTbl|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

    public function insertData($headerPk, $dataType, $supplierPk, $inserType) {
        $ip_address = Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $model = new CmscontractagreementdtlsTbl;
        $model->cmscad_createdon = $date;
        $model->cmscad_createdby = $userPK;
        $model->cmscad_createdbyipaddr = $ip_address;
        $model->cmscad_cmscontractagreementhdr_fk = $headerPk;
        $model->cmscad_shared_type = $dataType;
        $model->cmscad_shared_fk = $supplierPk;
        $model->cmscad_isprimarycontractor = $inserType;
        $model->cmscad_status = 1;
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
                'comments' => 'Something went wrong!',
                'returndata' => $model->getErrors()
            );
        }
    }

    public function setContractor($formdata, $headerPk) {
        if (!empty($formdata)) {
            $ip_address = Common::getIpAddress();
            $date = date('Y-m-d H:i:s');
            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $model = CmscontractagreementdtlsTbl::find()->select(['cmscontractagreementstls_pk'])->where("cmscad_cmscontractagreementhdr_fk =:pk", [':pk' => $headerPk])->asArray()->all();
            if (!empty($model)) {
                foreach ($model as $kay => $dataVal) {
                    $selecatData = CmscontractagreementdtlsTbl::find()->where("cmscad_cmscontractagreementhdr_fk =:pk", [':pk' => $dataVal['cmscontractagreementstls_pk']])->one();
                    $selecatData->cmscad_status = 2;
                    $selecatData->cmscad_updatedon = $date;
                    $selecatData->cmscad_updatedby = $userPK;
                    $selecatData->cmscad_updatedbyipaddr = $ip_address;
                    $selecatData->save();
                }
            }
            if (!empty($formdata['primerySuppler']) && $formdata['primerySuppler'] != null) {
                $primarySupplier = self::insertData($headerPk, $formdata['primerySuppler']['dataType'], $formdata['primerySuppler']['dataPk'], 1);
            }
            if (!empty($formdata['secondarySuppler']) && $formdata['secondarySuppler'] != null) {
                foreach ($formdata['secondarySuppler'] as $kay => $dataValFormPk) {
                    $secondarySupplier = self::insertData($headerPk, $dataValFormPk['dataType'], $dataValFormPk['dataPk'], 2);
                }
            }
        }
    }

    public function getPrimarySupplierArray() {
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey1 = 'primarysupplier1'.$companypk;
            $cacheKey2 = 'primarysupplier2'.$companypk;
    
            if(empty($cache->retreive($cacheKey1))){
                $cacheQuery1 = self::contrctagrmntCacheQuery();
                $query1 = self::primarySupplierArrayQuery1($companypk);
                $cache->store($cacheKey1, $query1, $duration = 0 , $cacheQuery1);
            } else {
                $query1 = self::primarySupplierArrayQuery1($companypk);
            }

            if(empty($cache->retreive($cacheKey2))){
                $cacheQuery2 = \api\modules\pms\models\CmsawarddtlsTblQuery::cmsawardToQueryCache();
                $query2 = self::primarySupplierArrayQuery2($companypk);
                $cache->store($cacheKey2, $query2, $duration = 0 , $cacheQuery2);
            } else {
                $query2 = self::primarySupplierArrayQuery2($companypk);
            }
        } catch(\Exception $e){
            $query1 = self::primarySupplierArrayQuery1($companypk);
            $query2 = self::primarySupplierArrayQuery2($companypk);
        }
       
        $unionQuery = (new \yii\db\Query())
                ->from(['dummy_name' => $query1->union($query2)])
                ->orderBy([new \yii\db\Expression("coalesce(cname,nonJsrsName) ASC")])
                ->groupBy(['dataPk', 'nonJsrsPk']);
        $provider = new ActiveDataProvider([
            'query' => $unionQuery,
        ]);
        $finalData = [];
        foreach ($provider->getModels() as $listData) {
            if (!empty($listData['dataPk']) || !empty($listData['nonJsrsPk'])) {
                $finalData[]=$listData;
            }
        }
        $result = array(
            'status' => 200,
            'msg' => 'success',
            'flag' => 'S',
            'moduleData' => $finalData,
        );
        return $result;
    }

    public static function primarySupplierArrayQuery1($companypk) {
        $query1 = (new \yii\db\Query())
                ->select(['memberComp.MemberCompMst_Pk as dataPk', 'cmsnonjsrssupmap_pk as nonJsrsPk', 'memberComp.MCM_CompanyName as cname', 'cnjsm_orgname as nonJsrsName'])
                ->from('cmscontractagreementdtls_tbl')
                ->leftJoin('cmscontractagreementhdr_tbl', 'cmscontractagreementhdr_pk = cmscad_cmscontractagreementhdr_fk')
                ->leftJoin('cmscontracthdr_tbl', 'cmsch_shared_agreefk = cmscontractagreementhdr_pk and cmsch_shared_agreetype = 2')
                ->leftJoin('membercompanymst_tbl as memberComp', 'memberComp.MemberCompMst_Pk=cmscad_shared_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmscad_shared_fk')
                ->leftJoin('usermst_tbl', 'cmscad_createdby = UserMst_Pk')
                ->leftJoin('membercompanymst_tbl as userData', 'userData.MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('userData.MemberCompMst_Pk=:pk and cmscad_isprimarycontractor =:dataType', array(':pk' => $companypk, ':dataType' => 1));

        return $query1;
    }

    public static function primarySupplierArrayQuery2($companypk) {
        $query2 = (new \yii\db\Query())
                ->select(['memberComp.MemberCompMst_Pk as dataPk', 'cmsnonjsrssupmap_pk as nonJsrsPk', 'memberComp.MCM_CompanyName as cname', 'cnjsm_orgname as nonJsrsName'])
                ->from('cmsawarddtls_tbl')
                ->leftJoin('cmscontracthdr_tbl', 'cmscontracthdr_pk = cmsad_cmscontracthdr_fk and cmsch_type = 3 and cmsch_shared_agreetype = 1')
                ->leftJoin('membercompanymst_tbl as memberComp', 'memberComp.MemberCompMst_Pk=cmsad_memcompmst_fk')
                ->leftJoin('cmsnonjsrssupmap_tbl', 'cmsnonjsrssupmap_pk=cmsad_cmsnonjsrssupmap_fk')
                ->leftJoin('usermst_tbl', 'cmsad_createdby = UserMst_Pk')
                ->leftJoin('membercompanymst_tbl as userData', 'userData.MCM_MemberRegMst_Fk = UM_MemberRegMst_Fk')
                ->where('userData.MemberCompMst_Pk=:pk and cmsad_isprimarycontractor =:dataType', array(':pk' => $companypk, ':dataType' => 1));
        return $query2;
    }

    public static function contrctagrmntCacheQuery() {
        return CmscontractagreementdtlsTbl::find()
        ->select(['max(cmscad_updatedon), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
}
