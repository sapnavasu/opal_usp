<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CmsgroupcatmstTbl]].
 *
 * @see CmsgroupcatmstTbl
 */
class CmsgroupcatmstTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CmsgroupcatmstTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CmsgroupcatmstTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getgroupcategorylist(){
        $model = CmsgroupcatmstTbl::find()
                ->select(['cmsgroupcatmst_pk as gcat_pk','cgcm_name as gcat_name'])
                ->where('cgcm_status=:status',array(':status' => 1))
                ->orderBy('cgcm_name ASC')
                ->asArray()->all();
            return $model;
    }

    public function savecmscategroydetails($data) {
        if($data) {
            $type = $data['type'];
            $grp_val = (array) array_unique($data['grp_val']);
            $main_val = $data['main_val'];
            $sub_val = $data['sub_val'];
            $req_pk = $data['req_pk'];
            foreach ($grp_val as $key => $value) {
                $allgroups = CmsgroupcatdtlsTbl::find()
                     ->select(['cgcd_cmsgroupcatmst_fk'])
                     ->where(['=', 'cgcd_shared_fk', $req_pk])
                     ->andWhere(['=', 'cgcd_shared_type', $type])
                     ->asArray()
                     ->all();
 
                foreach ($allgroups as $agkey => $agvalue) {
                    $ag[] = $agvalue['cgcd_cmsgroupcatmst_fk'];
                }

                $model = CmsgroupcatdtlsTbl::find()
                    ->where(['=', 'cgcd_shared_fk', $req_pk])
                    ->andWhere(['=', 'cgcd_shared_type', $type])
                    ->andWhere(['=', 'cgcd_cmsgroupcatmst_fk', $value])
                    ->one();
                    
                $groups_removed_by_user = array_diff($ag, $grp_val);
                $group_count = count($groups_removed_by_user);

                if($group_count > 0) {
                    self::removegroupvalue($groups_removed_by_user, $req_pk, $type);
                }

                if($model) {
                    $model->cgcd_cmsgroupcatmst_fk = $value;
                } else {
                    $model = new CmsgroupcatdtlsTbl();
                    $model->cgcd_shared_fk = $req_pk;
                    $model->cgcd_shared_type = $type;
                    $model->cgcd_cmsgroupcatmst_fk = $value;
                }
                if ($model->save()) {
                    $added_group_pk = $model->cmsgroupcatdtls_pk;

                    $group_val_model = CmsgroupcatdtlsTbl::find()
                        ->where(['=', 'cmsgroupcatdtls_pk', $added_group_pk])
                        ->one();
                    $grouppk = $group_val_model->cgcd_cmsgroupcatmst_fk;
                    $main_val_arr = (array) array_unique($main_val[$grouppk]);

                    $allmaincat = CmsmaincatdtlsTbl::find()
                        ->where(['=', 'cmcd_cmsgroupcatdtls_fk', $added_group_pk])
                        ->asArray()
                        ->all();
                    
                        foreach ($allmaincat as $mckey => $mcvalue) {
                            $maincatvalue[] = $mcvalue['cmcd_cmsmaincatmst_fk'];
                        }
                        $userremovedmaincatvalue = array_diff($maincatvalue, $main_val_arr);
                        if(count($userremovedmaincatvalue) > 0) {
                            self::removespecificmainvalue($userremovedmaincatvalue,$grouppk);
                        }

                    foreach ($main_val_arr as $key1 => $value1) {
                        $mmodel = CmsmaincatdtlsTbl::find()
                            ->where(['=', 'cmcd_cmsgroupcatdtls_fk', $added_group_pk])
                            ->andWhere(['=', 'cmcd_cmsmaincatmst_fk', $value1])
                            ->one();
                        if($mmodel) {
                            $mmodel->cmcd_cmsmaincatmst_fk = $value1;
                        } else {
                            $mmodel = new CmsmaincatdtlsTbl();
                            $mmodel->cmcd_cmsgroupcatdtls_fk = $added_group_pk;
                            $mmodel->cmcd_cmsmaincatmst_fk = $value1;
                        }
                        if ($mmodel->save()) {

                            $added_main_pk = $mmodel->cmsmaincatdtls_pk;

                            $group_val_model = CmsmaincatdtlsTbl::find()
                                ->where(['=', 'cmsmaincatdtls_pk', $added_main_pk])
                                ->one();
                            $mainpk = $group_val_model->cmcd_cmsmaincatmst_fk;
                            $sub_val_arr = (array) array_unique($sub_val[$mainpk]);

                            $allsubcat = CmssubcatdtlsTbl::find()
                                ->where(['=', 'cscd_cmsmaincatdtls_fk', $added_main_pk])
                                ->asArray()
                                ->all();
                        
                            foreach ($allsubcat as $sckey => $scvalue) {
                                $subcatvalue[] = $scvalue['cscd_cmssubcatmst_fk'];
                            }
                            $userremovedsubcatvalue = array_diff($subcatvalue, $sub_val_arr);
                            if(count($userremovedsubcatvalue) > 0) {
                                self::removespecificsubvalue($userremovedsubcatvalue,$mainpk);
                            }

        
                            foreach ($sub_val_arr as $key2 => $value2) {
                                $smodel = CmssubcatdtlsTbl::find()
                                    ->where(['=', 'cscd_cmsmaincatdtls_fk', $added_main_pk])
                                    ->andWhere(['=', 'cscd_cmssubcatmst_fk', $value2])
                                    ->one();
                                if($smodel) {
                                    $smodel->cscd_cmssubcatmst_fk = $value2;
                                } else {
                                    $smodel = new CmssubcatdtlsTbl();
                                    $smodel->cscd_cmsmaincatdtls_fk = $added_main_pk;
                                    $smodel->cscd_cmssubcatmst_fk = $value2;
                                }
                                if ($smodel->save()) {
                                    $success["msg"] = "success";
                                    $success["status"] = 1;
                                } else {
                                    print_r($mmodel->getErrors());exit;
                                }
                            }
                           
                        } else {
                            print_r($mmodel->getErrors());exit;
                        }
                    }        

                } else {
                    return [
                        "msg" => print_r($model->getErrors()),
                        "status" => 0
                    ];
                }
                
            }

            $success["data"] = $data;
            return $success;
        }

    }

    public function removegroupvalue($groups_removed_by_user, $req_pk, $type) {
        if($groups_removed_by_user) {
            foreach ($groups_removed_by_user as $key => $value) {
                $groupdet = CmsgroupcatdtlsTbl::find()
                    ->where(['=', 'cgcd_shared_fk', $req_pk])
                    ->andWhere(['=', 'cgcd_shared_type', $type])
                    ->andWhere(['=', 'cgcd_cmsgroupcatmst_fk', $value])
                    ->one();
                    $groupdtl_pk = $groupdet->cmsgroupcatdtls_pk;
                self::removemainvalue($groupdtl_pk);
                $deletegroupcatdtls = CmsgroupcatdtlsTbl::deleteAll('cgcd_cmsgroupcatmst_fk =' . $value . ' and cgcd_shared_fk =' . $req_pk . ' and cgcd_shared_type = ' . $type);
            }
        }
    }

    public function removemainvalue($groupdtl_pk) {
        if($groupdtl_pk) {

            $maingrpdet = CmsmaincatdtlsTbl::find()
                ->where(['=', 'cmcd_cmsgroupcatdtls_fk', $groupdtl_pk])
                ->asArray()
                ->all();
                if($maingrpdet) {
                    foreach($maingrpdet as $mgkey => $mgvalue) {
                        self::removesubgroup($mgvalue['cmsmaincatdtls_pk']);
                    }
                }
              
            $deletemaincatdtls = CmsmaincatdtlsTbl::deleteAll('cmcd_cmsgroupcatdtls_fk =' . $groupdtl_pk);
        }
    }

    public function removespecificmainvalue($userremovedmaincatvalue,$grouppk) {
        if($grouppk) {

            foreach($userremovedmaincatvalue as $urkey => $urvalue) {
                $maingrpdet = CmsmaincatdtlsTbl::find()
                    ->where(['=', 'cmcd_cmsgroupcatdtls_fk', $grouppk])
                    ->andWhere(['=', 'cmcd_cmsmaincatmst_fk', $urvalue])
                    ->asArray()
                    ->all();
                    if($maingrpdet) {
                        foreach($maingrpdet as $mgkey => $mgvalue) {
                            self::removesubgroup($mgvalue['cmsmaincatdtls_pk']);
                        }
                    }
                  
                $deletemaincatdtls = CmsmaincatdtlsTbl::deleteAll('cmcd_cmsgroupcatdtls_fk =' . $grouppk . ' and cmcd_cmsmaincatmst_fk =' . $urvalue);
            }

        }
    }

    public function removesubgroup($maincatdtl_pk) {
        if($maincatdtl_pk) {
            $deletesubcatdtls = CmssubcatdtlsTbl::deleteAll('cscd_cmsmaincatdtls_fk =' . $maincatdtl_pk);
        }
    }

    public function removespecificsubgroup($maincatdtl_pk) {
        if($maincatdtl_pk) {
            $deletesubcatdtls = CmssubcatdtlsTbl::deleteAll('cscd_cmsmaincatdtls_fk =' . $maincatdtl_pk);
        }
    }

    public function removespecificsubvalue($userremovedsubcatvalue,$mainpk) {
        if($userremovedsubcatvalue) {
            foreach ($userremovedsubcatvalue as $urkey => $urvalue) {
                $deletesubcatdtls = CmssubcatdtlsTbl::deleteAll('cscd_cmsmaincatdtls_fk =' . $mainpk . ' and cscd_cmssubcatmst_fk =' . $urvalue);
            }
        }

    }
    
    public static function getGroupCategory() {
        $groupcategoryMst = CmsgroupcatmstTbl::find()
                ->select(["cmsgroupcatmst_pk as dataPk", 'cgcm_name as dataName'])
                ->where('cgcm_status=1')
                ->orderBy('cgcm_name ASC')
                ->asArray()
                ->all();
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'moduleData' => $groupcategoryMst ? $groupcategoryMst : [],
        );
        return $result;
    }
}
