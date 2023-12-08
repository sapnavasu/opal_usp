<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;
use api\modules\mst\models\MembercompanymstTblQuery;


use api\modules\pd\models\ProjectdtlsTblProjectdtlsTblProjectdtlsTbl;

/**
 * This is the ActiveQuery class for [[ProjdilsubdtlsTbl]].
 *
 * @see ProjdilsubdtlsTbl
 */
class ProjdilsubdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjdilsubdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjdilsubdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    
    }   
    public function getdigigence($formdata)
    {
        $diligencePk = Security::sanitizeInput($formdata['submitpk'],'number');
        $getDiligence= ProjdilsubdtlsTbl::find()
                ->select('mst.MCM_CompanyName as compname,mst.mcm_referenceno as investorid,'
                        . 'mst.mcm_stakeholderstatus as investorstatus,'
                        . 'prdsd_resubmittedon as resubmitdate,'
                        . 'prdsd_submittedon as submitdate,prdsd_onlineform as formdata,projdilsubdtls_pk as diligencepk')
                ->leftJoin('usermst_tbl um','um.UserMst_Pk=projdilsubdtls_tbl.prdsd_submittedby')
                ->leftJoin('usermst_tbl resubmitum','um.UserMst_Pk=projdilsubdtls_tbl.prdsd_resubmittedby')
                ->leftJoin('membercompanymst_tbl as mst','um.UM_MemberRegMst_Fk = mst.MCM_MemberRegMst_Fk')
                ->where('projdilsubdtls_tbl.projdilsubdtls_pk=:id',array(':id' =>  $diligencePk))
                ->asArray()
                ->one();
        if($getDiligence){
            return $getDiligence;
        } else {
            return false;
        }
        
    }
    
    public function validateupdate($formdata)
    {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $diligencePk = Security::sanitizeInput($formdata['diligencepk'],'number');
        $getDiligence = ProjdilsubdtlsTbl::find()->where("projdilsubdtls_pk =:pk",[':pk'=> $diligencePk])->one();
        if(!empty($getDiligence))
        {
            $getDiligence->prdsd_status=Security::sanitizeInput($formdata['select'],'number');
            if(!empty($formdata['comments']))
            {
            $getDiligence->prdsd_comments=Security::sanitizeInput($formdata['comments'],'string');
            }
            $getDiligence->prdsd_appdeclon=date('Y-m-d H:i:s');
            $getDiligence->prdsd_appdeclby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        
            $getDiligence->save();
            if($getDiligence->prdsd_status==2){
                $model = \api\modules\mst\models\MembercompanymstTbl::find()
                        ->where('MemberCompMst_Pk=:memcomppk',[':memcomppk'=> $companypk])
                        ->one();
                if($model->mcm_stakeholderstatus!=4){
                    $model->mcm_stakeholderstatus=Security::sanitizeInput(3,'number');
                    $model->save();
                }
            }
            $user = $getDiligence->prdsd_submittedby;
            if(Security::sanitizeInput($formdata['select'],'number')==2){
                MembercompanymstTblQuery::updatestatus($user,4);
            }
        }
        return $getDiligence;
        
    }
    public function ackinvest($formdata)
    {
        $Pk = Security::sanitizeInput($formdata['pk'],'number');
        $getackinv = ProjinvestmentdtlsTbl::find()->where("projinvestmentdtls_pk =:pk",[':pk'=> $Pk])->one();
        if(!empty($getackinv))
        {
        $model2 = new ProjinvestmenthstyTbl();
        $model2->pinh_projinvestmentdtls_fk = $getackinv->pind_projinvestmentdtls_fk;
        $model2->pinh_status = $getackinv->pind_status;
        $model2->pinh_appdeclcomments = $getackinv->pind_appdeclcomments;
        $model2->pinh_appdeclon =  $getackinv->pind_appdeclon;
        $model2->pinh_appdeclby = $getackinv->pind_appdeclby;

        
            $getackinv->pind_status=Security::sanitizeInput($formdata['select'],'number');
//            if(!empty($formdata['comments']))
//            {
//            $getackinv->prdsd_comments=Security::sanitizeInput($formdata['comments'],'string');
//            }
            $getackinv->pind_declaredon=date('Y-m-d H:i:s');
//            $getackinv->prdsd_appdeclby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
            
            
            $getackinv->save();
        }
        return $getackinv;
        
    }

    public function getdiligence($data){
        $pk = Security::decrypt($data['pk']);
        $size = Security::sanitizeInput($data['size'], "number");
        $model = ProjdilsubdtlsTbl::find();
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key =="diligencestatus" && $key!="search"&& $key!="pk")
                {
                    $model->andWhere(["prdsd_status" => $val]);
                    
                }
                    if($key =="investorstatus" && $key!="search"&& $key!="pk")
                {
                    $model->andWhere(["mst.mcm_stakeholderstatus" => $val]);
                    
                }
                    if($key =="invtype" && $key!="search"&& $key!="pk")
                {
                    $model->andWhere(["type.mrm_invidentity" => $val]);
                    
                }
                }
            }
        }
        if($data['search']){
            $model->andFilterWhere(['or',
           ['like','mst.MCM_CompanyName',$data['search']],
           ['like','mst.mcm_referenceno',$data['search']]]);
        }
               
                $model->select('type.mrm_invidentity as invtype,mst.MCM_CompanyName as compname,'
                        . 'mst.mcm_referenceno as investorid,mst.mcm_stakeholderstatus as investorstatus,'
                        . 'prdsd_status as diligencestatus,short.prjsl_shortlistedcancon as shortlistdate,'
                        . 'projdilsubdtls_pk as pk')
                ->leftJoin('usermst_tbl um','um.UserMst_Pk=projdilsubdtls_tbl.prdsd_submittedby')
                ->leftJoin('usermst_tbl resubmitum','resubmitum.UserMst_Pk=projdilsubdtls_tbl.prdsd_resubmittedby')
                ->leftJoin('usermst_tbl diligenceval','diligenceval.UserMst_Pk=projdilsubdtls_tbl.prdsd_appdeclby')
                ->leftJoin('membercompanymst_tbl as mst','um.UM_MemberRegMst_Fk = mst.MCM_MemberRegMst_Fk')
                ->leftJoin('projeoisubdtls_tbl as eoi','eoi.projeoisubdtls_pk=projdilsubdtls_tbl.prdsd_projeoisubdtls_fk')
                ->leftJoin('usermst_tbl as useoi','useoi.UserMst_Pk=eoi.presd_eoisubmittedby')
                 ->leftJoin('usermst_tbl as usreeoi','usreeoi.UserMst_Pk=eoi.presd_resubmittedby')
                ->leftJoin('usermst_tbl as approveeoi','approveeoi.UserMst_Pk=eoi.presd_appdeclby')
                ->leftJoin('projshortlist_tbl as short','short.projshortlist_pk=eoi.presd_projshortlist_fk')
                ->leftJoin('usermst_tbl as usshort','usshort.UserMst_Pk=short.prjsl_shortlistedcancby')
                ->leftJoin('memberregistrationmst_tbl as type','usshort.UM_MemberRegMst_Fk=type.MemberRegMst_Pk')
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  2190))
                ->orderBy('prdsd_submittedon DESC')
                 ->asArray();
                 $page=(!empty($size))?$size:10;
                $provider = new ActiveDataProvider([ 'query' => $model, 'pagination' => ['pageSize' =>$page]]);
                return [
                    'items' => $provider->getModels(),
                    'total_count' => $provider->getTotalCount(),
                    'limit' => $page,
                ];
    }

    public function getvalidatedtls($data){
        $diligencepk=Security::sanitizeInput($data['submitpk'],'number');
        $getDiligence= ProjdilsubdtlsTbl::find()
                ->select('prdsd_onlineform formdata,projdiligence.pdf_formname as formname,mst.MCM_CompanyName as compname,mst.mcm_referenceno as investorid,mst.mcm_stakeholderstatus as investorstatus,um.UM_EmpName as diligencesubmituser,resubmitum.UM_EmpName as diligenceresubmituser,prdsd_resubmittedon as diligenceresubmitdate,prdsd_submittedon as diligencesubmitdate,prdsd_status as diligencestatus,prdsd_comments as diligencecomments,prdsd_appdeclon as diligencevalon,diligenceval.UM_EmpName as diligencevalname,short.prjsl_shortlistedcancon as shortlistdate,usshort.UM_EmpName as shortlistname,eoi.presd_eoisubmittedon as eoisubmitdate,useoi.UM_EmpName as eoiname,usreeoi.UM_EmpName as eoiresubmitname,presd_resubmittedon as eoiresubmitdate,eoi.presd_comments as eoicomments,eoi.presd_appdeclon as eoiapprovedon,approveeoi.UM_EmpName as eoiapprovedby,prdsd_intamtforinv as invesmentamount,eoi.presd_eoiacknow as eoidescription')
                ->leftJoin('usermst_tbl um','um.UserMst_Pk=projdilsubdtls_tbl.prdsd_submittedby')
                ->leftJoin('usermst_tbl resubmitum','resubmitum.UserMst_Pk=projdilsubdtls_tbl.prdsd_resubmittedby')
                ->leftJoin('usermst_tbl diligenceval','diligenceval.UserMst_Pk=projdilsubdtls_tbl.prdsd_appdeclby')
                ->leftJoin('membercompanymst_tbl as mst','um.UM_MemberRegMst_Fk = mst.MCM_MemberRegMst_Fk')
                ->leftJoin('projeoisubdtls_tbl as eoi','eoi.projeoisubdtls_pk=projdilsubdtls_tbl.prdsd_projeoisubdtls_fk')
                ->leftJoin('usermst_tbl as useoi','useoi.UserMst_Pk=eoi.presd_eoisubmittedby')
                 ->leftJoin('usermst_tbl as usreeoi','usreeoi.UserMst_Pk=eoi.presd_resubmittedby')
                ->leftJoin('usermst_tbl as approveeoi','approveeoi.UserMst_Pk=eoi.presd_appdeclby')
                ->leftJoin('projshortlist_tbl as short','short.projshortlist_pk=eoi.presd_projshortlist_fk')
                ->leftJoin('usermst_tbl as usshort','usshort.UserMst_Pk=short.prjsl_shortlistedcancby')
                ->leftJoin('projectdtls_tbl as projdtls','projdtls.projectdtls_pk=projdilsubdtls_tbl.prdsd_projectdtls_fk')
                ->leftJoin('projdiligenceform_tbl as projdiligence','projdiligence.projdiligenceform_pk=projdtls.prjd_projdiligenceform_fk')
                ->where('projdilsubdtls_tbl.projdilsubdtls_pk=:id',array(':id' =>  $diligencepk))
                ->orderBy('short.projshortlist_pk desc')
                ->asArray()
                ->one();
        if($getDiligence){
            return $getDiligence;
        } else {
            return false;
        }
        
    }

    public function diligencecount($pk){
        $pk = Security::decrypt($pk);
        $received = ProjdilsubdtlsTbl::find()
                ->select(['*'])
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  $pk))
                ->count();
        $yetto = ProjdilsubdtlsTbl::find()
                ->andWhere('prdsd_status=:id',array(':id' => 1 ))
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  $pk))
                ->select(['*'])
                ->count();
        $re = ProjdilsubdtlsTbl::find()
                ->andWhere('prdsd_status=:id',array(':id' => 4 ))
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  $pk))
                ->select(['*'])
                ->count();
        $approved = ProjdilsubdtlsTbl::find()
                ->andWhere('prdsd_status=:id',array(':id' => 2 ))
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  $pk))
                ->select(['*'])
                ->count();
        $declined = ProjdilsubdtlsTbl::find()
                ->andWhere('prdsd_status=:id',array(':id' => 3 ))
                ->andWhere('prdsd_projectdtls_fk=:fk',array(':fk' =>  $pk))
                ->select(['*'])
                ->count();
        return [
            'received' => $received,
            'yetto' => ($yetto+$re),
            'approved' => $approved,
            'declined' => $declined,
        ];
    }
}
