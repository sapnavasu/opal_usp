<?php

namespace api\modules\pd\models;
use yii\data\ActiveDataProvider;
use common\components\Security;
use Yii;
use common\components\Common;
use api\modules\pd\model\ProjinvestmenthstyTblQuery;

/**
 * This is the ActiveQuery class for [[ProjinvestmentdtlsTbl]].
 *
 * @see ProjinvestmentdtlsTbl
 */
class ProjinvestmentdtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjinvestmentdtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjinvestmentdtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public static function invdetails($data){
        // $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $searchname = Security::sanitizeInput($data['search'], "string");
        $model = ProjinvestmentdtlsTbl::find();
        $model->all();
        $model->select([
            'projinvestmentdtls_pk',
            'pind_projectdtls_fk',
            'MCM_CompanyName',
            'mcm_referenceno',
            'pind_status',
            'pind_createdon',
            'pind_appdeclon',
            'pind_appdeclby',
            'pind_appdeclcomments',
            'prjd_memberregmst_fk',
            'prjd_projectid',
            'prjd_projname',
            'um_firstname',
            'MemberCompMst_Pk',
            'pind_invamount',
            'prjd_projcost',
            'piid_totinvreqd',
            'piid_totinvrecd',
            'piid_submittedon',
            'pind_usrtype'
        ]);
        $model->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=projinvestmentdtls_tbl.pind_projectdtls_fk');
        $model->leftJoin('projinvinfodtls_tbl','projinvinfodtls_tbl.piid_projectdtls_fk=projectdtls_tbl.projectdtls_pk');
        $model->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=projinvestmentdtls_tbl.pind_appdeclby');
        $model->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MemberCompMst_Pk=projinvestmentdtls_tbl.pind_memcompmst_fk');
        $model->asArray();
        $sortpk = $data['sort'];

        if($data['search']!=null){
            $model->andOnCondition(['or',
           ['like','prjd_projectid',$data['search']],
           ['like','prjd_projname',$data['search']]]);
        }
        if($data['MemberCompMst_Pk']){
            $arr = explode(',',$data['MemberCompMst_Pk']);
            $model->andFilterWhere(['in','MemberCompMst_Pk',$arr]);
        }
        if($data['projectdtls_pk']){
            $arr = explode(',',$data['projectdtls_pk']);
            $model->andFilterWhere(['in','projectdtls_pk',$arr]);
        }
        if($data['status']){
            $arr = explode(',',$data['status']);
            $model->andFilterWhere(['in','pind_status',$arr]);
        }

        // $model->orderBy('pind_createdon DESC');


        // if($sortpk==1){
        //     $model->orderBy('lppu_pinned_on DESC');
        //     }else {
        //     $model->orderBy('lppu_pinned_on ASC');    
        //     }
        //     if($searchname != ''){
        //         $model->andFilterWhere(['or',['LIKE','li_referenceno', ':value',array(':value' =>  $searchname)],['LIKE','li_lictitleen', ':value',array(':value' =>  $searchname)]]);
        //     }
    

    // if($data['filter'] =='filter')
    // {
    //     unset($data['page']);
    //     unset($data['size']);
    //     unset($data['filter']);
    //     unset($data['sort']);
    //     unset($data['search']);

    //     foreach(array_filter($data) as $key =>$val)
    //     {
    //         if($val !=null)
    //         {
    //               $model->andOnCondition("$key IN ($val)");
    //         }
    //     }
    //  }
    $projdropdown = ProjinvestmentdtlsTbl::find();
    $projdropdown->all();
    $projdropdown->select([
        'pind_projectdtls_fk',
        'prjd_projectid',
        'prjd_projname',
    ]);
    $projdropdown->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=projinvestmentdtls_tbl.pind_projectdtls_fk');
    $projdropdown->groupBy(['pind_projectdtls_fk']);
    $projdropdown->orderBy(['prjd_projname'=>SORT_ASC]);

    $projdropdown->asArray();
    $providerproj = new ActiveDataProvider([
        'query' => $projdropdown, 
    ]);

    $invdropdown = ProjinvestmentdtlsTbl::find();
    $invdropdown->all();
    $invdropdown->select([
        'pind_memcompmst_fk',
        'MCM_CompanyName',
    ]);
    $invdropdown->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MemberCompMst_Pk=projinvestmentdtls_tbl.pind_memcompmst_fk');
    $invdropdown->groupBy(['pind_memcompmst_fk']);
    $invdropdown->orderBy(['MCM_CompanyName'=>SORT_ASC]);


    $invdropdown->asArray();
    $providerinv = new ActiveDataProvider([
        'query' => $invdropdown, 
    ]);






        $page = (!empty($_REQUEST['size'])) ? $_REQUEST['size'] : 10; 
        $provider = new ActiveDataProvider([
            'query' => $model, 
            'pagination' => ['pageSize' => $page],
            'sort' => [
                'attributes'=>[
                    'prjd_projectid'=>[
                        'asc'=>['projectdtls_tbl.prjd_projectid'=>SORT_ASC],
                        'desc'=>['projectdtls_tbl.prjd_projectid'=>SORT_DESC],
                    ],
                    'prjd_projname'=>[
                        'asc'=>['projectdtls_tbl.prjd_projname'=>SORT_ASC],
                        'desc'=>['projectdtls_tbl.prjd_projname'=>SORT_DESC],
                    ],
                    'mcm_referenceno'=>[
                        'asc'=>['membercompanymst_tbl.mcm_referenceno'=>SORT_ASC],
                        'desc'=>['membercompanymst_tbl.mcm_referenceno'=>SORT_DESC],
                    ],
                    'MCM_CompanyName'=>[
                        'asc'=>['membercompanymst_tbl.MCM_CompanyName'=>SORT_ASC],
                        'desc'=>['membercompanymst_tbl.MCM_CompanyName'=>SORT_DESC],
                    ],
                    'pind_createdon'=>[
                        'asc'=>['projinvestmentdtls_tbl.pind_createdon'=>SORT_ASC],
                        'desc'=>['projinvestmentdtls_tbl.pind_createdon'=>SORT_DESC],
                    ],
                    'pind_usrtype'=>[
                        'asc'=>['projinvestmentdtls_tbl.pind_usrtype'=>SORT_ASC],
                        'desc'=>['projinvestmentdtls_tbl.pind_usrtype'=>SORT_DESC],
                    ],

                ]
            ],

		]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'projectdropdwn' => $providerproj->getModels(),
            'invdropdwn' => $providerinv->getModels(),


        ];


    }


    public function getinvdetailsbyid($pk){
        $model = ProjinvestmentdtlsTbl::find();
        $model->select([
            'projinvestmentdtls_pk',
            'pind_projectdtls_fk',
            'MCM_CompanyName',
            'mcm_referenceno',
            'pind_status',
            'pind_createdon',
            'pind_appdeclon',
            'pind_appdeclby',
            'pind_appdeclcomments',
            'prjd_memberregmst_fk',
            'prjd_projectid',
            'prjd_projname',
            'MemberCompMst_Pk',
            'pind_invamount',
            'prjd_projcost',
            'piid_totinvreqd',
            'piid_totinvrecd',
            'piid_submittedon',
            'prjd_referenceno',
            'mcm_stakeholderstatus',
            'pind_createdby',
            'val.um_firstname as valfname',
            'val.um_lastname as vallname',
             'sub.um_firstname as subfname',
            'sub.um_lastname as sublname',
            'pind_declaredon'
        ]);
        $model->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=projinvestmentdtls_tbl.pind_projectdtls_fk');
        $model->leftJoin('projinvinfodtls_tbl','projinvinfodtls_tbl.piid_projectdtls_fk=projectdtls_tbl.projectdtls_pk');
        $model->leftJoin('usermst_tbl sub','sub.UserMst_Pk=pind_createdby');
        $model->leftJoin('usermst_tbl val','val.UserMst_Pk=pind_appdeclby');
        $model->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MemberCompMst_Pk=projinvestmentdtls_tbl.pind_memcompmst_fk');
        $model->andWhere(['projinvestmentdtls_pk'=>$pk]);
        $model->asArray()->one();
        // return $model;

        $provider = new ActiveDataProvider([
            'query' => $model, 
		]);
        return [
            'items' => $provider->getModels(),
            // 'total_count' => $provider->getTotalCount(),
        ];

    }

    public static function licform($data){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model = ProjinvestmentdtlsTbl::find()->where("projinvestmentdtls_pk =:pk",[':pk'=> (int)$data['pk']])->one();

       $modelhst = new ProjinvestmenthstyTbl();
       $modelhst->pinh_projectdtls_fk = $model->pind_projectdtls_fk;
       $modelhst->pinh_projinvestmentdtls_fk = (int)$data['pk'];
       $modelhst->pinh_memcompmst_fk = $model->pind_memcompmst_fk;
       $modelhst->pinh_declaredon = $model->pind_declaredon;
       $modelhst->pinh_status = $model->pind_status;
       $modelhst->pinh_usrtype = 2;
       $modelhst->pinh_invamount =  $model->pind_invamount;
       $modelhst->pinh_histcreatedon = date('Y-m-d H:i:s');
       if(!empty($model->pind_updatedon)){
       $modelhst->pinh_createdon = $model->pind_updatedon;
       $modelhst->pinh_createdby = $model->pind_updatedby;
    }  else{
        $modelhst->pinh_createdon = $model->pind_createdon;
        $modelhst->pinh_createdby = $model->pind_createdby;
    }
       $modelhst->pinh_appdeclcomments = $model->pind_appdeclcomments;
       $modelhst->pinh_appdeclby = $model->pind_appdeclby;
       $modelhst->pinh_appdeclon = $model->pind_appdeclon;



       $model->pind_status = $data['select'];
       $model->pind_appdeclcomments = $data['comments'];
       $model->pind_appdeclby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
       $model->pind_appdeclon = date('Y-m-d H:i:s');

        // return $modelhst;
        if($model->save() && $modelhst->save()){
            return [
                'data'=>"Investment Re Declared Successfully!"
            ];
        }else{
            return [
                'error'=>'error',
            ];
        }
    }

    public function investedindex($data){
        $pk =  Security::decrypt($data['pk']);
        $pk = 2642;
        $model = ProjinvestmentdtlsTbl::find()->select([
                    'pind_memcompmst_fk','mst.MCM_CompanyName as compname',
                    'mst.mcm_referenceno as investorid',
                    'mst.mcm_stakeholderstatus as invstatus',
                    'max(pind_createdon) as cdate',
                    'max(pind_updatedon) as udate',
                    'type.mrm_invidentity as invtype'])
                ->groupBy('pind_memcompmst_fk')
                ->orderBy([
                    'cdate' => SORT_DESC,
                    'udate'=>SORT_DESC
                   ])
                ->leftJoin('membercompanymst_tbl as mst','pind_memcompmst_fk = mst.MemberCompMst_Pk')
                ->leftJoin('memberregistrationmst_tbl as type','mst.MCM_MemberRegMst_Fk=type.MemberRegMst_Pk')
                ->andWhere(['pind_projectdtls_fk' => $pk]);
                if(!empty($data['search'])){
                    $model->andFilterWhere(['or',
                    ['like','mst.mcm_referenceno',$data['search']],
                    ['like','mst.MCM_CompanyName',$data['search']]
                    ]);    
                }
                if(!empty($data['status'])){
                    $model->andWhere(['pind_status'=>explode(',',$data['status'])]);    
                } 
                if(!empty($data['type'])){
                    $model->andWhere(['type.mrm_invidentity'=>$data['type']]);    
                }        
        $model->andWhere(['<>','pind_status',3]);
        $model->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $model, 'pagination' => ['pageSize' =>$page]]);

        $total = ProjinvestmentdtlsTbl::find()->select(['pind_memcompmst_fk'])->where(['pind_projectdtls_fk' => $pk])->andWhere(['<>','pind_status',3])->distinct('pind_memcompmst_fk')->asArray()->all();

        $reciv = ProjinvestmentdtlsTbl::find()->select(['pind_memcompmst_fk'])->where(['pind_projectdtls_fk' => $pk])->andWhere(['<>','pind_status',3])->asArray()->all();
        $yetto = ProjinvestmentdtlsTbl::find()->select(['pind_memcompmst_fk'])->andWhere(['pind_projectdtls_fk' => $pk])->andWhere(['or',['pind_status'=>1],['pind_status'=>6]])->asArray()->all();
        $appro = ProjinvestmentdtlsTbl::find()->select(['pind_memcompmst_fk'])->andWhere(['pind_projectdtls_fk' => $pk])->andWhere(['pind_status'=>4])->asArray()->all();
        $decli = ProjinvestmentdtlsTbl::find()->select(['pind_memcompmst_fk'])->andWhere(['pind_projectdtls_fk' => $pk])->andWhere(['pind_status'=>5])->asArray()->all();
        $proj = ProjinvestmentdtlsTbl::find()->select([
                                                        'inv.piid_totinvreqd as invreq',
                                                        'inv.piid_totinvrecd as invrec',
                                                        'pro.prjd_projectid as proid',
                                                        'pro.prjd_referenceno as prorefno', 
                                                        'pro.prjd_projcost as projcost',
                                                        'pro.prjd_projname as proname'])
                ->where(['pind_projectdtls_fk' => $pk])
                ->leftJoin('projectdtls_tbl as pro','pind_projectdtls_fk = pro.projectdtls_pk')
                ->leftJoin('projinvinfodtls_tbl as inv','pind_projectdtls_fk = inv.piid_projectdtls_fk')
                ->asArray()->one();

        $arr = array();
        $temp_model = $provider->getModels();

        foreach ($temp_model as $key => $value) {
            $model2 = ProjinvestmentdtlsTbl::find()->select([
                                                            'projinvestmentdtls_pk as pk',
                                                            'mst.MemberCompMst_Pk as compk',
                                                            'inv.piid_totinvreqd as invreq',
                                                            'pind_invamount as invamount',
                                                            'inv.piid_totinvrecd as invrec',
                                                            'pind_status as status',
                                                            'pind_declaredon as invon',
                                                            'pro.prjd_projectid as proid',
                                                            'pro.prjd_referenceno as prorefno',
                                                            'pro.prjd_projname as proname',
                                                            'pro.prjd_projcost as projcost',
                                                            'pind_createdon as createdon',
                                                            'user1.um_firstname as createdbyfn',
                                                            'user1.um_lastname as createdbyln',
                                                            'mst.mcm_referenceno as createdbyid',
                                                            'user2.um_firstname as appdeclbyfn',
                                                            'user2.um_lastname as appdeclbyln',
                                                            'user3.um_firstname as updatedbyfn',
                                                            'user3.um_lastname as updatedbyln',
                                                            'pind_updatedon as updatedon',
                                                            'pind_appdeclcomments as comment',
                                                            'pind_appdeclon as appdeclon',
                                                            'type.mrm_invidentity as invtype',
                                                            'pind_memcompmst_fk as memcomp',
                                                            'mst.MCM_CompanyName as compname'
                                                            ])
            ->leftJoin('projectdtls_tbl as pro','pind_projectdtls_fk = pro.projectdtls_pk')
            ->leftJoin('projinvinfodtls_tbl as inv','pind_projectdtls_fk = inv.piid_projectdtls_fk')
            ->leftJoin('usermst_tbl as user1','pind_createdby = user1.UserMst_Pk')
            ->leftJoin('usermst_tbl as user2','pind_appdeclby = user2.UserMst_Pk')
            ->leftJoin('usermst_tbl as user3','pind_updatedby = user3.UserMst_Pk')
            ->leftJoin('membercompanymst_tbl as mst','user1.UM_MemberRegMst_Fk = mst.MCM_MemberRegMst_Fk')
            ->leftJoin('memberregistrationmst_tbl as type','mst.MCM_MemberRegMst_Fk=type.MemberRegMst_Pk')
            ->andWhere(['pind_projectdtls_fk' => $pk])
            ->andWhere(['pind_memcompmst_fk'=>$value['pind_memcompmst_fk']])
            ->andFilterWhere(['pind_status'=>$data['status']=='1,6'?explode(',',$data['status']):$data['status']])
            ->orderBy([
                'pind_createdon' => SORT_DESC,
                'pind_updatedon'=>SORT_DESC
               ])
            ->andWhere(['<>','pind_status',3])
            ->asArray()->all();
            if(count($model2)){
            array_push($arr,array("parent"=>$value,"child"=>$model2,"count"=>count($model2)));
            }
        }

        return [
            'items' => $arr,
            'total_count' => $provider->getTotalCount(),
            'project' => $proj,
            'total' => count($total),
            'reciv' => count($reciv),
            'yetto' => count($yetto),
            'appro' => count($appro),
            'decli' => count($decli),
            'limit' => $page,
        ];

    }

    public function invDeclare($data){
        $pk_dec=Security::decrypt($data['projectpk']);
        $pk=Security::sanitizeInput($pk_dec,'number');
        $pk = 2642;
        $model = new ProjinvestmentdtlsTbl();
        $model->pind_projectdtls_fk = $pk;
        $model->pind_memcompmst_fk = Security::decrypt($data['inv']);
        $model->pind_declaredon =  Common::convertDateTimeToServerTimezone($data['date'],'Y-m-d H:i:s');
        $model->pind_status = 1;
        $model->pind_usrtype = 2;
        $model->pind_invamount = $data['refno'];
        $model->pind_createdon = date('Y-m-d H:i:s');
        $model->pind_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);


        if($model->save()){
            return [
                'data'=>"Investment Declared Successfully!"
            ];
        }else{
            return [
                'error'=>"Error!",
            ];
        }
    }
    public function invRedeclare($data){
        $pro_pk=Security::sanitizeInput(Security::decrypt($data['projectpk']),'number');
        $pro_pk = 2642;
        $pk=Security::sanitizeInput(Security::decrypt($data['pk']),'number');
        $model =  ProjinvestmentdtlsTbl::find()->where(['projinvestmentdtls_pk'=>$pk])->One();
        //history table
        $modelhst = new ProjinvestmenthstyTbl();
        $modelhst->pinh_projectdtls_fk = $pro_pk;
        $modelhst->pinh_projinvestmentdtls_fk = $pk;
        $modelhst->pinh_memcompmst_fk = Security::sanitizeInput(Security::decrypt($data['inv']),'number');
        $modelhst->pinh_declaredon = $model->pind_declaredon;
        $modelhst->pinh_status = $model->pind_status;
        $modelhst->pinh_usrtype = 2;
        $modelhst->pinh_invamount =  $model->pind_invamount;
        $modelhst->pinh_createdon = $model->pind_createdon;
        $modelhst->pinh_histcreatedon = date('Y-m-d H:i:s');
        $modelhst->pinh_createdby = $model->pind_createdby;
        $modelhst->pinh_appdeclon = $model->pind_appdeclon;
        $modelhst->pinh_appdeclby = $model->pind_appdeclby;
        $modelhst->pinh_appdeclcomments = $model->pind_appdeclcomments;

        //updating main table
        $model->pind_projectdtls_fk = $pro_pk;
        $model->pind_memcompmst_fk = Security::sanitizeInput(Security::decrypt($data['inv']),'number');
        $model->pind_declaredon = Common::convertDateTimeToServerTimezone($data['date'],'Y-m-d H:i:s');
        $model->pind_status = 6;
        $model->pind_usrtype = 2;
        $model->pind_invamount = $data['refno'];
        $model->pind_updatedon = date('Y-m-d H:i:s');
        $model->pind_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        
        

        if($model->save() && $modelhst->save()){
            return [
                'data'=>"Investment Re Declared Successfully!"
            ];
        }else{
            return [
                'error'=>"Error!",
            ];
        }
    }

    public function invest($data){
        $model = new ProjinvestmentdtlsTbl();
        $model->pind_projectdtls_fk = $data['pk']['projectdtls_pk'];
        $model->pind_memcompmst_fk = $data['pk']['companypk'];
        $model->pind_status = 1;
        $model->pind_usrtype = 1;
        $model->pind_declaredon =  Common::convertDateTimeToServerTimezone($data['form']['investon'],'Y-m-d H:i:s');
        $model->pind_invamount = $data['form']['investamtusd'];
        $model->pind_createdon = date('Y-m-d H:i:s');
        $model->pind_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        if($model->save()){
            return [
                'data'=>"Investment Declared Successfully!"
            ];
        }else{
            return [
                'data'=>"Error!",
            ];
        }
    }
    public function reinvest($data){
        $model = ProjinvestmentdtlsTbl::find()->where("projinvestmentdtls_pk =:pk",[':pk'=> (int)$data['lpk']])->one();

        //history table
        $modelhst = new ProjinvestmenthstyTbl();
        $modelhst->pinh_projectdtls_fk = $model->pind_projectdtls_fk;
        $modelhst->pinh_projinvestmentdtls_fk = (int)$data['lpk'];
        $modelhst->pinh_memcompmst_fk = $model->pind_memcompmst_fk;
        $modelhst->pinh_declaredon = $model->pind_declaredon;
        $modelhst->pinh_status = $model->pind_status;
        $modelhst->pinh_usrtype = 1;
        $modelhst->pinh_invamount =  $model->pind_invamount;
        $modelhst->pinh_createdon = $model->pind_createdon;
        $modelhst->pinh_histcreatedon = date('Y-m-d H:i:s');
        $modelhst->pinh_createdby = $model->pind_createdby;
        $modelhst->pinh_appdeclon = $model->pind_appdeclon;
        $modelhst->pinh_appdeclby = $model->pind_appdeclby;
        $modelhst->pinh_appdeclcomments = $model->pind_appdeclcomments;

        //updating main table
        $model->pind_status = 6;
        $model->pind_usrtype = 1;
        $model->pind_declaredon =  Common::convertDateTimeToServerTimezone($data['form']['investon'],'Y-m-d H:i:s');
        $model->pind_invamount = $data['form']['investamtusd'];
        $model->pind_updatedon = date('Y-m-d H:i:s');
        $model->pind_updatedby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        if($model->save() && $modelhst->save()){
            return [
                'data'=>"Investment Re Declared Successfully!"
            ];
        }else{
            return [
                'data'=>"Error!",
            ];
        }
    }

}