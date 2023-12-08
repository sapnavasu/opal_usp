<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsaddinfodtlstempTbl]].
 *
 * @see CmsaddinfodtlstempTbl
 */
class CmsaddinfodtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsaddinfodtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function GetAddInfoData($tenderHeaderPk) {
        $AddInfoDtlsArray = CmsaddinfodtlstempTbl::find()
            ->select(['cmsaddinfodtlstemp_pk', 'caidt_cmstenderhdrtemp_fk', 'caidt_title as question', 'caidt_description as answer', 'caidt_index as id'])
            ->where('caidt_cmstenderhdrtemp_fk=:fk', array(':fk' => $tenderHeaderPk))
            ->andWhere('caidt_status=:status', array(':status' => 1))
            ->orderBy('caidt_index ASC')
            ->asArray()->all();        
        return $AddInfoDtlsArray;
    }

    public function getadditonalinfolist($tenderHeaderPk) {
        $AddInfoDtlsArray = CmsaddinfodtlstempTbl::find()
            ->select(['*'])
            ->where('caidt_cmstenderhdrtemp_fk=:fk', array(':fk' => $tenderHeaderPk))
            ->andWhere('caidt_status=:status', array(':status' => 1))
            ->orderBy('caidt_index ASC')
            ->asArray()->all();        
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
            $deleteaddinfo = CmsaddinfodtlstempTbl::deleteAll(['=', 'cmsaddinfodtlstemp_pk', $addinfopk]);
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
