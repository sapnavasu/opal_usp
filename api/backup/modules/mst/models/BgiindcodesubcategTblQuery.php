<?php

namespace api\modules\mst\models;

/**
 * This is the ActiveQuery class for [[BgiindcodesubcategTbl]].
 *
 * @see BgiindcodesubcategTbl
 */
class BgiindcodesubcategTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return BgiindcodesubcategTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BgiindcodesubcategTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function active($db = null)
    {
        return $this->andWhere(['bicsc_categorystatus' => 1]);
    }

    public static function getfamilylist($request = null)
    {
        if(isset($_GET['category']) && !empty($_GET['category'])) {
            $category = $_GET['category'];
            // $type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : 1;
            $type = !empty($_GET['type']) ? $_GET['type']==1?'P':'S' : 'P';
        } else {
            $category = trim($request['category']);
            // $type = trim($request['type']) == 'P' ? 1 : 2;
            $type = !empty(trim($request['type'])) ? $request['type']==1?'P':'S' : 'P';
        }

        if(isset($category) && !empty($category))
        { 
            // $type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : 1;
            // $category = $_GET['category'];
            
            $subcateforymodel = BgiindcodesubcategTbl::find()
                ->select(['bgiindcodesubcateg_pk','bicsc_subcategoryname','bicc_categoryname','bicsc_bgiindcodecateg_fk'])
                ->leftJoin('bgiindcodecateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')
                ->where(['=','bicsc_subcategorytype', $type])
                ->andWhere(['IN','bicsc_bgiindcodecateg_fk', $category])
                ->orderBy('bicsc_subcategoryname ASC')
                ->asArray()->all();

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($subcateforymodel) ? $subcateforymodel : [],
                'total_count' => count($subcateforymodel),
            ];
        }
    }

    public static function getsubcategorylist($request = null) {
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);

        if(isset($_GET['category']) && !empty($_GET['category'])) { 
            $category = $_GET['category'];
            $type = !empty($_REQUEST['type']) ? $_REQUEST['type'] : 1;
        } else {
            $category = trim($request['category']);
            $type = trim($request['type']) == 'P' ? 1 : 2;
        }

        if(isset($category) && !empty($category)) { 

            if($type == 1) {
                $subcateforymodel = BgiindcodesubcategTbl::find()
                    ->select(['bgiindcodesubcateg_pk','bicsc_subcategoryname'])
                    // ->leftJoin('bgiindcodecateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')
                    ->leftJoin('memcompproddtls_tbl','bgiindcodesubcateg_pk = mcprd_bgiindcodesubcateg_fk')
                    ->where(['=','bicsc_subcategorytype', $type])
                    ->andWhere(['=','bicsc_bgiindcodecateg_fk', $category])
                    ->andWhere(['=','MCPrD_MemberCompMst_Fk', $company_id])
                    ->groupBy('bgiindcodesubcateg_pk')
                    ->orderBy('bicsc_subcategoryname ASC')
                    ->asArray()->all();
            } else {
                $subcateforymodel = BgiindcodesubcategTbl::find()
                    ->select(['bgiindcodesubcateg_pk','bicsc_subcategoryname'])
                    // ->leftJoin('bgiindcodecateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')
                    ->leftJoin('memcompservicedtls_tbl','bgiindcodesubcateg_pk = mcsvd_bgiindcodesubcateg_fk')
                    ->where(['=','bicsc_subcategorytype', $type])
                    ->andWhere(['=','bicsc_bgiindcodecateg_fk', $category])
                    ->andWhere(['=','MCSvD_MemberCompMst_Fk', $company_id])
                    ->groupBy('bgiindcodesubcateg_pk')
                    ->orderBy('bicsc_subcategoryname ASC')
                    ->asArray()->all();
            }
            

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($subcateforymodel) ? $subcateforymodel : [],
                'total_count' => count($subcateforymodel),
            ];
        }
    }
}