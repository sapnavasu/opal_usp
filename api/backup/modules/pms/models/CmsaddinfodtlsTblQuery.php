<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsaddinfodtlsTbl]].
 *
 * @see CmsaddinfodtlsTbl
 */
class CmsaddinfodtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function GetAddInfoData($tenderHeaderPk) {
        $AddInfoDtlsArray = CmsaddinfodtlsTbl::find()
            ->select(['cmsaddinfodtls_pk', 'caid_cmstenderhdr_fk', 'caid_title as question', 'caid_description as answer', 'caid_index as id'])
            ->where('caid_cmstenderhdr_fk=:fk', array(':fk' => $tenderHeaderPk))
            ->andWhere('caid_status=:status', array(':status' => 1))
            ->orderBy('caid_index ASC')
            ->asArray()
            ->all();        
        return $AddInfoDtlsArray;
    }

    public function getadditonalinfolist($tenderHeaderPk) {
        $AddInfoDtlsArray = CmsaddinfodtlsTbl::find()
            ->select(['*'])
            ->where('caid_cmstenderhdr_fk=:fk', array(':fk' => $tenderHeaderPk))
            ->andWhere('caid_status=:status', array(':status' => 1))
            ->asArray()
            ->all();        
        return $AddInfoDtlsArray;
    }
    
    public static function deletereqaddinfo($addinfopk) {
        $result = array(
            'status' => 200,
            'msg' => 'failure',
            'flag' => 'U',
            'comments' => 'Something Went Wrong!',
        );

        if($addinfopk) {
            $deleteaddinfo = CmsaddinfodtlsTbl::deleteAll(['=', 'cmsaddinfodtls_pk', $addinfopk]);
            if($deleteaddinfo) {
                $result = array(
                    'status' => 200,
                    'msg' => 'success',
                    'flag' => 'U',
                    'comments' => 'Additional Information Deleated Successfully!',
                );
            }
        }
        return $result;
    }
}
