<?php

namespace api\models;

/**
 * This is the ActiveQuery class for [[CmsrfxpreferencehdrTbl]].
 *
 * @see CmsrfxpreferencehdrTbl
 */
class CmsrfxpreferencehdrTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsrfxpreferencehdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsrfxpreferencehdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    
    public static function Saverfxpreference($data)
    {
        //print_r($data);die();
        $criteria=json_encode($data['query']);
        $title=$data['saveName'];
        $ip_address = \common\components\Common::getIpAddress();
        $date = date('Y-m-d H:i:s');
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $preference=new CmsrfxpreferencehdrTbl();
        $preference->crfxph_memcompmst_fk=$companyPk;
        $preference->crfxph_title=$title;
        $preference->crfxph_criteria=$criteria;
        $preference->crfxph_criteriabag=$criteria;
        $preference->crfxph_status=1;
        $preference->crfxph_createdon=$date;
        $preference->crfxph_createdby=$userPK;
        $preference->crfxph_createdbyipaddr=$ip_address;
        $preference->save();
        //print_r($preference->save());die();
        if (!$preference->save(false)) {
             $result = array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'W',
                'erroData' => $preference->getErrors()
            );
            return $result;
        } else {
            $result = array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S',
                'moduleData' => $preference->cmsrfxpreferencehdr_pk
            );
            return $result;
        }
    }

    public static function Rfxpreferencelist()
    {
        $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $query = CmsrfxpreferencehdrTbl::find()
                ->select('*')
                ->where('crfxph_createdby=:pk', array(':pk' => $userPK))
                ->andWhere('crfxph_memcompmst_fk=:cpk', array(':cpk' => $companyPk))
                ->orderBy([new \yii\db\Expression("coalesce(crfxph_updatedon,crfxph_createdon) DESC")])
                ->asArray()
                ->all();
        return [
            'data' => $query
        ];
    }

    public static function Removerfxpreference($reqPk)
    {
        $model = CmsrfxpreferencehdrTbl::findOne($reqPk);
        if ($model && $model->delete()) {
            return array(
                'status' => 200,
                'msg' => 'success',
                'flag' => 'S'
            );
        } else {
            return array(
                'status' => 200,
                'msg' => 'warning',
                'flag' => 'W',
                'erroData' => $preference->getErrors()
            );
        }
    }
}
