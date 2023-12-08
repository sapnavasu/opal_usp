<?php

namespace api\modules\pms\models;

/**
 * This is the ActiveQuery class for [[CmsquestionnairetmplformTbl]].
 *
 * @see CmsquestionnairetmplformTbl
 */
class CmsquestionnairetmplformTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsquestionnairetmplformTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsquestionnairetmplformTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getexistingquestiontemplates($data) {
        if($data) {
            if($data['pk'] > 0) {
                $model = CmsquestionnairetmplformTbl::find()
                    ->select(['*'])
                    ->where('cmsqtf_type=:type', [':type' => $data['type']])
                    ->andWhere('cmsquestionnairetmplform_pk=:pk', [':pk' => $data['pk']])
                    ->asArray()
                    ->All();
                } else {
                    $model = CmsquestionnairetmplformTbl::find()
                    ->select(['*'])
                    ->where('cmsqtf_type=:type', [':type' => $data['type']])
                    ->andWhere('cmsqtf_formtype=:formtype', [':formtype' => 1])
                    ->orderBy([new \yii\db\Expression("coalesce(cmsqtf_updatedon,cmsqtf_createdon) DESC")])
                    ->asArray()
                    ->All();
                }
            return $model;
        }
    }
}
