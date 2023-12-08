<?php

namespace app\models;
use \app\models\MemcompbranchdtlstempTbl;
/**
 * This is the ActiveQuery class for [[MemcompbranchdtlstempTbl]].
 *
 * @see MemcompbranchdtlstempTbl
 */
class MemcompbranchdtlstempTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompbranchdtlstempTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompbranchdtlstempTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    public function getbranchdet(){
        $branchModel = [];
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != undefined){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
           $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
            $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }
        $stktype=\common\components\Security::sanitizeInput($_REQUEST['stktype'],"number");
        $category=\common\components\Security::sanitizeInput($_REQUEST['category'],"number");
        $formpk=\common\components\Security::sanitizeInput($_REQUEST['form'],"number");
        if(in_array($stktype, [1,6,15])){
            $branchModel=MemcompbranchdtlstempTbl::find()
            ->select(['scfct_status','scfct_appdeclcomments','memcompbranchdtlstemp_tbl.*','izm_zonename_ar as zonename_ar','izm_zonename_en as zonename_en',
            'iem_estatename_ar as estatename_ar','iem_estatename_en as estatename_en','blm_licesename_en as licesename_en',
            'blm_licensename_ar as licesename_ar' ,'otm_officename_ar as officename_ar','otm_officename_en as officename_en'])
            ->leftJoin(\common\models\SuppcertformmembtmpTbl::tableName(),'scfmt_membercompmst_fk=mcbdt_memcompmst_fk ')
            ->leftJoin(\common\models\SuppcertformcattmpTbl::tableName(),'scfct_suppcertformmembtmp_fk=suppcertformmembtmp_pk')
            ->leftJoin('industrialzonemst_tbl','mcbdt_industrialzonemst_fk=industrialzonemst_pk')   
            ->leftJoin('businesslicensemst_tbl','mcbdt_businesslicensemst_fk=businesslicensemst_pk')   
            ->leftJoin('industrialestatemst_tbl','mcbdt_industrialestatemst_fk=industrialestatemst_pk')  
            ->leftJoin('officetypemst_tbl','officetypemst_pk=mcbdt_officetypemst_fk') 
            ->where('mcbdt_memcompmst_fk =:company and  scfct_bgivaldoccatmst_fk=:category and scfmt_formmst_fk=:formpk and mcbdt_scfstatus is NOT NULL and 
                mcbdt_isdeleted=:mcbdt_isdeleted', [':company'=>$companypk,':category'=>$category,':mcbdt_isdeleted'=>2,':formpk'=>$formpk])
            ->orderBy('memcompbranchdtlstemp_pk desc')->asArray()->all();
            if(!empty($branchModel)){
                foreach ($branchModel as $key => $value) {                    
                    if($stktype == 1){
                        $togetstatus = \api\modules\mst\models\MemcompbranchapprovaldtlsTbl::find()
                        ->leftJoin("memcompbranchapprovalmain_tbl", "memcompbranchapprovalmain_pk=mcbad_memcompbranchapprovalmain_fk")
                        ->leftJoin('certapprovaldtls_tbl','mcbam_certapprovaldtls_fk = certapprovaldtls_pk')
                        ->where("mcbad_memcompbranchdtlstemp_fk=:branchtemp",
                        [':branchtemp'=>$value['memcompbranchdtlstemp_pk']])->orderby('certapprovaldtls_pk desc')->one();
                        $branchModel[$key]['mcbad_status'] = !empty($togetstatus) && !empty($togetstatus->mcbad_status) ? $togetstatus->mcbad_status : 0;
                        $branchModel[$key]['mcbad_comments'] = !empty($togetstatus) && !empty($togetstatus->mcbad_comments) ? $togetstatus->mcbad_comments : NULL;
                    }
                    $activitylicupload= $value['mcbdt_upload'];
                    $isicactivity = !empty($value['mcbdt_isicactivitymst_fk']) ? count(explode(",", $value['mcbdt_isicactivitymst_fk'])) : 0;
                    $activitylicupld = explode(",", $activitylicupload);
                    $activityliccnt = count($activitylicupld);
                    $branchdoc = [];
                    if(count($activitylicupld) > 0){
                        foreach ($activitylicupld as $upkey => $upvalue) {
                            $branchdoc[$upkey]['docUrl'] = \common\components\Drive::generateUrl($upvalue,$companypk,$userpk,1);
                            $branchdoc[$upkey]['fileName'] = \common\components\Drive::getFileName(\common\components\Security::encrypt($upvalue));
                            $branchdoc[$upkey]['ext'] =  pathinfo($branchdoc[$upkey]['fileName'],PATHINFO_EXTENSION);
                        }
                    }
                    $branchModel[$key]['filedoccnt'] = $activityliccnt;
                    $branchModel[$key]['filedocarr'] = $branchdoc;
                    $branchModel[$key]['isicactivity'] = $isicactivity;
                }
            }
        }
         return $branchModel;
    }
    public function getbranchmaplist(){
        if(isset($_REQUEST['compid']) && !empty($_REQUEST['compid']) && $_REQUEST['compid'] != undefined){
           $companypk = \common\components\Security::decrypt($_REQUEST['compid']);
           $getdata = \common\models\MembercompanymstTbl::findOne($companypk);
           $userpk = $getdata->mCMMemberRegMstFk->primaryuser['UserMst_Pk'];
        }else{
           $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
           $userpk=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        }
        $branchModel=MemcompbranchdtlstempTbl::find()
        ->select(['memcompbranchdtlstemp_tbl.*','izm_zonename_ar as zonename_ar','izm_zonename_en as zonename_en',
            'iem_estatename_ar as estatename_ar','iem_estatename_en as estatename_en','blm_licesename_en as licesename_en',
            'blm_licensename_ar as licesename_ar','otm_officename_ar as officename_ar','otm_officename_en as officename_en'])
        ->leftJoin('industrialzonemst_tbl','mcbdt_industrialzonemst_fk=industrialzonemst_pk')   
        ->leftJoin('businesslicensemst_tbl','mcbdt_businesslicensemst_fk=businesslicensemst_pk')   
        ->leftJoin('industrialestatemst_tbl','mcbdt_industrialestatemst_fk=industrialestatemst_pk')  
        ->leftJoin('officetypemst_tbl','officetypemst_pk=mcbdt_officetypemst_fk') 
        ->where('mcbdt_memcompmst_fk =:company and mcbdt_scfstatus is NULL and mcbdt_isdeleted=:mcbdt_isdeleted',
                [':company'=>$companypk,':mcbdt_isdeleted'=>2])->orderBy('memcompbranchdtlstemp_pk desc')->asArray()->all();   
        if(!empty($branchModel)){
            foreach ($branchModel as $key => $value) {
                $activitylicupload= $value['mcbdt_upload'];
                $isicactivity = !empty($value['mcbdt_isicactivitymst_fk']) ? count(explode(",", $value['mcbdt_isicactivitymst_fk'])) : 0;
                $activitylicupld = explode(",", $activitylicupload);
                $activityliccnt = count($activitylicupld);
                $branchdoc = [];
                if(count($activitylicupld) > 0){
                    foreach ($activitylicupld as $upkey => $upvalue) {
                        $branchdoc[$upkey]['docUrl'] = \common\components\Drive::generateUrl($upvalue,$companypk,$userpk,1);
                        $branchdoc[$upkey]['fileName'] = \common\components\Drive::getFileName(\common\components\Security::encrypt($upvalue));
                        $branchdoc[$upkey]['ext'] =  pathinfo($branchdoc[$upkey]['fileName'],PATHINFO_EXTENSION);
                    }
                }
                $branchModel[$key]['filedoccnt'] = $activityliccnt;
                $branchModel[$key]['filedocarr'] = $branchdoc;
                $branchModel[$key]['isicactivity'] = $isicactivity;
            }
        }
         return $branchModel;
    }
    public function getbsbranchmaplist(){
        $brnchids = $branchModel = [];
        $formid = \common\components\Security::sanitizeInput($_REQUEST['formid'],"number");
        if(!empty($_REQUEST['brnchids']) && $_REQUEST['brnchids'] != undefined) {
            $brnchids = explode(',',$_REQUEST['brnchids']);
        }        
        if($brnchids) {
            $branchModel=MemcompbranchdtlstempTbl::find()
                ->select(['memcompbranchdtlstemp_tbl.*','izm_zonename_ar as zonename_ar','izm_zonename_en as zonename_en', 'iem_estatename_ar as estatename_ar','iem_estatename_en as estatename_en','blm_licesename_en as licesename_en'
                ,'otm_officename_ar as officename_ar','otm_officename_en as officename_en','mcbdt_memcompmst_fk','mcbdt_createdby'])
                ->leftJoin('industrialzonemst_tbl','mcbdt_industrialzonemst_fk=industrialzonemst_pk') 
                ->leftJoin('industrialestatemst_tbl','mcbdt_industrialestatemst_fk=industrialestatemst_pk')  
                ->leftJoin('businesslicensemst_tbl','mcbdt_businesslicensemst_fk=businesslicensemst_pk') 
                ->leftJoin('officetypemst_tbl','officetypemst_pk=mcbdt_officetypemst_fk') 
                ->where('mcbdt_isdeleted=2')
                ->andWhere(['in', 'memcompbranchdtlstemp_pk', $brnchids])
                ->orderBy('memcompbranchdtlstemp_pk desc')
                ->asArray()->all();   
        }
        if(count($branchModel) >0){
            $stktype = \yii\db\ActiveRecord::getTokenData('reg_type', true);
            if($stktype == 1){
                $levelUser = \api\modules\mst\models\CertapprovaldtlsTbl::find()
                ->select(['certapprovaldtls_pk'])            
                ->where('cad_membercompanymst_fk=:compk',[':compk' => $branchModel[0]['mcbdt_memcompmst_fk']])->orderBy("certapprovaldtls_pk desc")->asArray()->one();       
            }
            foreach ($branchModel as $key => $value) {
                if($stktype == 1){
                    $togetstatus = \api\modules\mst\models\MemcompbranchapprovaldtlsTbl::find()
                    ->leftJoin("memcompbranchapprovalmain_tbl", "memcompbranchapprovalmain_pk=mcbad_memcompbranchapprovalmain_fk")
                    ->where("mcbam_certapprovaldtls_fk=:cerapp and mcbad_memcompbranchdtlstemp_fk=:branchtemp",
                    [':cerapp'=>$levelUser['certapprovaldtls_pk'],':branchtemp'=>$value['memcompbranchdtlstemp_pk']])->one();
                    $branchModel[$key]['mcbdt_scfstatus'] = !empty($togetstatus) && !empty($togetstatus->mcbad_status) ? $togetstatus->mcbad_status : 3;
                    $branchModel[$key]['mcbdt_appdeclcomments'] = !empty($togetstatus) && !empty($togetstatus->mcbad_comments) ? $togetstatus->mcbad_comments : NULL;
                }
                $activitylicupload= $value['mcbdt_upload'];
                $isicactivity = !empty($value['mcbdt_isicactivitymst_fk']) ? count(explode(",", $value['mcbdt_isicactivitymst_fk'])) : 0;
                $activitylicupld = explode(",", $activitylicupload);
                $activityliccnt = count($activitylicupld);
                $branchdoc = [];
                if(count($activitylicupld) > 0){
                    foreach ($activitylicupld as $upkey => $upvalue) {
                        $branchdoc[$upkey]['docUrl'] = \common\components\Drive::generateUrl($upvalue,$value['mcbdt_memcompmst_fk'],$value['mcbdt_createdby'],1);
                        $branchdoc[$upkey]['fileName'] = \common\components\Drive::getFileName(\common\components\Security::encrypt($upvalue));
                        $branchdoc[$upkey]['ext'] =  pathinfo($branchdoc[$upkey]['fileName'],PATHINFO_EXTENSION);
                    }
                }
                $branchModel[$key]['filedoccnt'] = $activityliccnt;
                $branchModel[$key]['filedocarr'] = $branchdoc;
                $branchModel[$key]['isicactivity'] = $isicactivity;
            }
        }
         return $branchModel;
    }
    public function savebranchder($data,$compid=''){
        $returndata = FALSE;
        if(isset($compid) && !empty($compid) && $compid != undefined){
            $companypk = $compid;
         }else{
             $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
         }
         $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
         $ipadress = \common\components\Common::getIpAddress();
         $dateTime = date('Y-m-d H:i:s');
         if(!empty($data['mappedpks'])){
             $StrToArr=explode(',',$data['mappedpks']);
             foreach ($StrToArr as $key =>$otbval){
                 $branchModel=MemcompbranchdtlstempTbl::find()
                 ->where('mcbdt_memcompmst_fk=:company and memcompbranchdtlstemp_pk =:branchid and mcbdt_isdeleted=:mcbdt_isdeleted and mcbdt_scfstatus is NULL', 
                [':company'=>$compid,':mcbdt_isdeleted'=>2,':branchid'=>$otbval])->one();
                 if(!empty($branchModel)){
                     $branchModel->mcbdt_scfstatus = 1;
                     $branchModel->mcbdt_updatedon = $dateTime;
                     $branchModel->mcbdt_updatedby = $userpk;
                     $branchModel->mcbdt_updatedbyipaddr = $ipadress;
                     if($branchModel->save(false)){
                         $returndata = TRUE;
                    }
                 }
             }
         }
         return $returndata;
    }
    public function getisicactlistdata($branchid,$companypk){
        $Model=MemcompbranchdtlstempTbl::find()
        ->select(['concat_ws("-",ActM_ActivityCode, ActM_ActivityName) as name_en',
            'concat_ws("-",ActM_ActivityCode_ar, ActM_ActivityName_ar) as name_ar'])
        ->leftJoin('activitiesmst_tbl','find_in_set(ActivitiesMst_Pk, mcbdt_isicactivitymst_fk)')    
        ->where('mcbdt_memcompmst_fk =:company and memcompbranchdtlstemp_pk=:branchid',
        [':company'=>$companypk,':branchid'=>$branchid])->asArray()->all();   
        return $Model;
    }
}
