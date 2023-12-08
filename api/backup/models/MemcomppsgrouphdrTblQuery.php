<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[MemcomppsgrouphdrTbl]].
 *
 * @see MemcomppsgrouphdrTbl
 */
class MemcomppsgrouphdrTblQuery extends \yii\db\ActiveQuery
{
    public static $group_breadcrump = '';
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcomppsgrouphdrTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcomppsgrouphdrTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function insertprojectgroup($data, $parentid = null) {
        if($data) {
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk = \yii\db\ActiveRecord::getTokenData('user_pk', true);
            $ip_addr = \common\components\Common::getIpAddress();  
            if($parentid == 0) {
                // $delete_model = MemcomppsgrouphdrTbl::deleteAll('memcomppsgrouphdr_pk > 0');
            } 

            foreach($data as $key => $value) {
                if($value['id']) {
                    $model = MemcomppsgrouphdrTbl::findOne($value['id']);
                } else {
                    $model = new MemcomppsgrouphdrTbl();
                }

                $model->mcpsgh_membercompmst_fk = $company_id;
                $model->mcpsgh_groupname = $value['name'];
                $model->mcpsgh_memcomppsgrouphdr_fk = $value['parent_id'];
                $model->mcpsgh_prodmapcount = 0;
                $model->mcpsgh_servicemapcount = 0;
                $model->mcpsgh_status = 1;
                $model->mcpsgh_createdon = date('Y-m-d H:i:s'); 
                $model->mcpsgh_createdby = $userpk;
                $model->mcpsgh_createdbyipaddr = $ip_addr;
                if($model->save()) {
                    if($value['children']) {
                        $parentid = $model->memcomppsgrouphdr_pk;
                        if($value['parent_id'] ==  null) {
                            $value['children'][0]['parent_id'] = $parentid;
                        }
                        self::insertprojectgroup($value['children'], $parentid);
                    }
                }
                
            }
            $max_id = MemcomppsgrouphdrTbl::find()->max('memcomppsgrouphdr_pk');
            // $model = MemcomppsgrouphdrTbl::findOne($max_id);
            // $max_parent_id = $model->mcpsgh_memcomppsgrouphdr_fk;
            return $max_id;

        }

    }
    public function getprojectgroup($company_id = '') {
        if(empty($company_id)){
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        }

        $progroup=MemcomppsgrouphdrTbl::find()
        ->select(['memcomppsgrouphdr_pk as id', 'mcpsgh_memcomppsgrouphdr_fk as parent_id', 'mcpsgh_groupname as name'])
        ->where('mcpsgh_membercompmst_fk = :compk', ['compk' => $company_id])
        ->orderBy('memcomppsgrouphdr_pk DESC')
        ->asArray()
        ->all(); 
        $gettrreestructure = self::maptree($progroup);
        return $gettrreestructure;
    }

    public function maptree(array $data, $parentid = null) {
        $progrouparray = array();
        foreach($data as $key => $value) {
            if($value['parent_id'] == $parentid) {
                $children = self::maptree($data, $value['id']);
                if($children) {
                    $value['children'] = $children;
                }
                $progrouparray[] = $value;
            }
            
        }
        return  $progrouparray;
    }

    public function getprojectgroupforid($id) {

       $gettrreestructure = self::getparents($id);
       $breadscrumb = '';
        
        sort($gettrreestructure, SORT_NUMERIC);
        foreach($gettrreestructure as $key => $val) {
            $parentid = MemcomppsgrouphdrTbl::find()
                ->select(['mcpsgh_memcomppsgrouphdr_fk as parent_id', 'mcpsgh_groupname'])
                ->where('memcomppsgrouphdr_pk = :grppk', ['grppk' => $val])
                ->asArray()
                ->all(); 
            $parentstructure[] = $parentid[0]['mcpsgh_groupname'];
            
            if($parentid[0]['mcpsgh_groupname']  != '' && $parentid[0]['mcpsgh_groupname']  != null) {
                if($key == sizeof($gettrreestructure) - 1) {
                    $breadscrumb .= $parentid[0]['mcpsgh_groupname'];
                } else {
                    $breadscrumb .= $parentid[0]['mcpsgh_groupname'] . ' > ';
                }
            }
        }
        return $breadscrumb;
    }

    public function getparentsname($id) {
        $parentstructure = array();
        $parentid = MemcomppsgrouphdrTbl::find()
            ->select(['mcpsgh_memcomppsgrouphdr_fk as parent_id', 'mcpsgh_groupname'])
            ->where('memcomppsgrouphdr_pk = :grppk', ['grppk' => $id])
            ->asArray()
            ->all(); 
        $parentstructure[] = $parentid[0]['mcpsgh_groupname'];
        if($parentid[0]['parent_id'] != null) {
            $parentid = self::getparentsname($parentid[0]['parent_id']);
            $parentstructure[] = $parentid[0]['mcpsgh_groupname'];
        } 

        return  $parentstructure;
    }

    public function getparents($id) {
        $nodeids = array();
        $nodeids[] = $id;
        $parentid = MemcomppsgrouphdrTbl::find()
            ->select(['mcpsgh_memcomppsgrouphdr_fk as parent_id'])
            ->where('memcomppsgrouphdr_pk = :grppk', ['grppk' => $id])
            ->asArray()
            ->all(); 
        $nodeids[] = $parentid[0]['parent_id'];
        if($parentid[0]['parent_id'] != null) {
            $childparentid = self::getparents($parentid[0]['parent_id']);
            $nodeids[] = $childparentid[0]['parent_id'];
        } 

        return  $nodeids;
    }

    public function getchildren($id) {
        return  MemcomppsgrouphdrTbl::find()
            ->select(['memcomppsgrouphdr_pk'])
            ->where('mcpsgh_memcomppsgrouphdr_fk = :grppk', ['grppk' => $id])
            ->asArray()
            ->all();  
    }

    public static function deletegroupid($id) {
        if($id) {
            
            $children = self::getchildren($id);
            
            foreach ($children as $key => $value) {
                $nodeid =  $value['memcomppsgrouphdr_pk'];
                \common\models\MemcompproddtlsTbl::removegrouping($nodeid);
                \common\models\MemcompservicedtlsTbl::removegrouping($nodeid);
                MemcomppsgrouphdrTbl::deleteAll('memcomppsgrouphdr_pk=:gid',[':gid' => $nodeid]); 
                self::deletegroupid($value['memcomppsgrouphdr_pk']);
            }

            \common\models\MemcompproddtlsTbl::removegrouping($id);
            \common\models\MemcompservicedtlsTbl::removegrouping($id);
            MemcomppsgrouphdrTbl::deleteAll('memcomppsgrouphdr_pk=:gid',[':gid' => $id]); 
        }
    }

      public function getancestornode($id, $name = '') {
        if($id != null) {
            $value =  self::getparentnode($id);
            self::$group_breadcrump .= ' > ' . $name;
        } else {
            return substr(substr(self::$group_breadcrump,2), 0 , -2);
        }
        return substr(substr(self::$group_breadcrump, 2), 0 , -2);
      }

      public function getparentnode($id) {
        $parentid = MemcomppsgrouphdrTbl::find()
            ->select(['mcpsgh_memcomppsgrouphdr_fk as parent_id', 'mcpsgh_groupname as name'])
            ->where('memcomppsgrouphdr_pk = :grppk', ['grppk' => $id])
            ->asArray()
            ->all(); 
        self::getancestornode($parentid[0]['parent_id'], $parentid[0]['name']);
    }

    public function setgroup_breadcrump() {
        self::$group_breadcrump = '';
    }
}
