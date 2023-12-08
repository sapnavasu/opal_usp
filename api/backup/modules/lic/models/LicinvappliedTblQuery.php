<?php

namespace api\modules\lic\models;
use common\components\Security;
use common\components\Common;
use yii\data\ActiveDataProvider;
use yii\rbac\Permission;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use api\modules\lic\models\LicapprhstyTbl;

/**
 * This is the ActiveQuery class for [[LicinvappliedTbl]].
 *
 * @see LicinvappliedTbl
 */
class LicinvappliedTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return LicinvappliedTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LicinvappliedTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function index($data){
        $query = LicinvappliedTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $query->select(['projectdtls_pk','prjd_projectid','prjd_referenceno','prjd_projname','MCM_CompanyName','MemberCompMst_Pk',
        'mcm_referenceno','mcm_stakeholderstatus','lia_createdby','li_lictitleen','lia_status','li_referenceno','mrm_invidentity',
        'li_intrefno','li_targetduration','li_targetdurationtype','SecM_SectorName','lia_applicationno','li_createdon','lia_applsubmon',
        'lia_comments','lia_createdon','lia_appdeclon','aproved.um_firstname as fname','aproved.um_lastname as lname','lia_appdeclcomment',
        'usermst_tbl.um_firstname','usermst_tbl.um_lastname','lia_appdeclby','licinvapplied_pk','lia_updatedon','re.um_firstname as refname',
        're.um_lastname as relname'])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->leftJoin('usermst_tbl','lia_createdby=UserMst_Pk')
        ->leftJoin('usermst_tbl aproved','lia_appdeclby=aproved.UserMst_Pk')
        ->leftJoin('usermst_tbl re','lia_updatedby=re.UserMst_Pk')
        ->leftJoin('licensinginfo_tbl','lia_licensinginfo_fk=licensinginfo_pk')
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->leftJoin('memberregistrationmst_tbl','lia_memregmst_fk=MemberRegMst_Pk')
        ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
        ->distinct(['lia_projectdtls_fk']);

        if($data['search']!=null){
            $query->andFilterWhere(['or',
           ['like','prjd_referenceno',$data['search']],
           ['like','prjd_projectid',$data['search']],
           ['like','prjd_projname',$data['search']]]);
        }
        if($data['investor']){
            $arr = explode(',',$data['investor']);
            $query->andFilterWhere(['in','MemberCompMst_Pk',$arr]);
        }
        if($data['project']){
            $arr = explode(',',$data['project']);
            $query->andFilterWhere(['in','projectdtls_pk',$arr]);
        }
        if($data['status']){
            $arr = explode(',',$data['status']);
            $query->andFilterWhere(['in','lia_status',$arr]);
        }
        if($data['sort'] == '-'){
            $query->orderBy(['lia_createdon' => SORT_ASC]);
        }
        else{
        $query->orderBy(['lia_createdon' => SORT_DESC]);
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query,
                                            'pagination' => false,
                                             ]);

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
        ];
    }


    public function filterindex($data){
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $page = Security::sanitizeInput($data['page'], "number");
        $query = LicinvappliedTbl::find()
        ->select(['projectdtls_pk as pk','prjd_projectid as id','prjd_referenceno as ref','prjd_projname as name','MemberCompMst_Pk','licinvapplied_tbl.lia_createdon'])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->leftJoin('licinvapplied_tbl as liad','licinvapplied_tbl.lia_projectdtls_fk = liad.lia_projectdtls_fk and licinvapplied_tbl.lia_createdon < liad.lia_createdon')
        ->distinct(['lia_projectdtls_fk']);
        if($data['search']!=null){
            $query->andOnCondition(['or',
           ['like','prjd_referenceno',$data['search']],

           ['like','membercompanymst_tbl.MCM_CompanyName',$data['search']]]);
        }
        if($data['investor']){
            $arr = explode(',',$data['investor']);
            $query->andFilterWhere(['in','MemberCompMst_Pk',$arr]);
        }
        if($data['project']){
            $arr = explode(',',$data['project']);
            $query->andFilterWhere(['in','projectdtls_pk',$arr]);

        }
        if($data['status']){
            $arr = explode(',',$data['status']);
            $query->andFilterWhere(['in','licinvapplied_tbl.lia_status',$arr]);
        }
        if($data['sort'] == '-'){
            $query->orderBy(['licinvapplied_tbl.lia_createdon' => SORT_ASC]);
        }
        else{
        $query->orderBy(['licinvapplied_tbl.lia_createdon' => SORT_DESC]);
        }
        $query->andWhere('liad.licinvapplied_pk is null');
        $query->groupBy('projectdtls_pk');
        $query->asArray()->All();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 
                                             'pagination' => ['pageSize' => $page]]);

        $model = LicinvappliedTbl::find()
        ->select(['lia_projectdtls_fk'])
        ->distinct(['lia_projectdtls_fk'])
        ->asArray()->all();  
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $size,
            'total_entry' => count($model)
        ];
    }
    
    public function filterinvestor(){
        $query = LicinvappliedTbl::find()
        ->select(['MemberCompMst_Pk','MCM_CompanyName'])
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->distinct(['lia_memregmst_fk'])
        ->orderBy(['MCM_CompanyName' => SORT_ASC])
        ->asArray()->All();
        return $query;
    }
    public function filterlicense(){
        $query = LicinvappliedTbl::find()
        ->select(['licensinginfo_pk','li_lictitleen'])
        ->leftJoin('licensinginfo_tbl','licensinginfo_pk=lia_licensinginfo_fk')
        ->distinct(['lia_licensinginfo_fk'])
        ->orderBy(['li_lictitleen' => SORT_ASC])
        ->asArray()->All();
        return $query;
    }

    public function filterproject(){
        $query = LicinvappliedTbl::find()
        ->select(['projectdtls_pk','prjd_projname'])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->distinct(['lia_projectdtls_fk'])
        ->orderBy(['prjd_projname' => SORT_ASC])
        ->asArray()->All();
        return $query;
    }

    public function licencelist(){
        $query = \api\modules\mst\models\LicensinginfoTbl::find();
        $query->select(["li_lictitleen as display" , "licensinginfo_pk as value"]);
        $query->andWhere('li_status=:stat',array(':stat' =>  1)) ;
        $query->asArray();
        return $query->all();
    }

    public static function licseclist(){     
        $model = \api\modules\mst\models\SectormstTbl::find()
                ->select(['SectorMst_Pk as value','SecM_SectorName as display'])
                ->where(['=','SecM_Status','A'])
                ->orderBy(['SecM_SectorName'=> SORT_ASC])
                ->asArray()->all();
                return $model;
        
    }

    public static function licindex($data){
        $size = Security::sanitizeInput($data['size'], "number");
        $model = LicinvappliedTbl::find()
                ->select(['licinvapplied_tbl.licinvapplied_pk as pk',
                            'licinvapplied_tbl.lia_createdon as sumittedon',
                            'licinvapplied_tbl.lia_status as licensestatus',
                            'licinvapplied_tbl.lia_comments as lia_comments',
                            'licinvapplied_tbl.lia_appdeclcomment as lia_appdeclcomment',
                            'licinvapplied_tbl.lia_createdon as createdon',
                            'licinvapplied_tbl.lia_updatedon as updatedon',
                            'licinvapplied_tbl.lia_appdeclon as lia_appdeclon',
                            'licinvapplied_tbl.lia_applicationno as licenseapp',
                            'licensinginfo_tbl.li_lictitleen as licensename',
                            'licensinginfo_tbl.li_referenceno as referncenumber',
                            'projectdtls_tbl.prjd_projectid as projectid',
                            'projectdtls_tbl.prjd_referenceno as projrefno',
                            'projectdtls_tbl.prjd_projname as projname',
                            'membercompanymst_tbl.mcm_referenceno as investorid',
                            'sectormst_tbl.SecM_SectorName as sector',
                            'usermst_tbl.um_firstname as fname',
                            'usermst_tbl.um_lastname as lname',
                            'app.um_firstname as appfname',
                            'app.um_lastname as applname',
                            ])
                ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
                ->leftJoin('licensinginfo_tbl','lia_licensinginfo_fk=licensinginfo_pk')
                ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
                ->leftJoin('sectormst_tbl','prjd_sectormst_fk=SectorMst_Pk')
                ->leftJoin('usermst_tbl','lia_createdby=UserMst_Pk')
                ->leftJoin('usermst_tbl app','lia_updatedby=app.UserMst_Pk');

                if(!empty($data['search'])){
                    $model->andOnCondition(['or',
                    ['like','membercompanymst_tbl.mcm_referenceno',$data['search']],
                    ['like','membercompanymst_tbl.MCM_CompanyName',$data['search']]]);    
                }
                if(!empty($data['project'])){
                    $model->andFilterWhere(['in','lia_projectdtls_fk',explode(",",$data['project'])]);
                }
                if(!empty($data['investor'])){
                    $model->andFilterWhere(['in','lia_memregmst_fk',explode(",",$data['investor'])]);
                }
                if(!empty($data['license'])){
                    $model->andFilterWhere(['in','lia_licensinginfo_fk',explode(",",$data['license'])]);
                }
                if(!empty($data['status'])){
                    $model->andFilterWhere(['in','lia_status',explode(',',$data['status'])]);
                }
                $model->asArray();
                $page=(!empty($size))?$size:10;
                $provider = new ActiveDataProvider([ 'query' => $model,
                                                        'sort' => [
                                                            'attributes'=>[
                                                                'investorid'=>[
                                                                    'asc'=>['membercompanymst_tbl.mcm_referenceno'=>SORT_ASC],
                                                                    'desc'=>['membercompanymst_tbl.mcm_referenceno'=>SORT_DESC],
                                                                ],
                                                                'projectid'=>[
                                                                    'asc'=>['projectdtls_tbl.prjd_projectid'=>SORT_ASC],
                                                                    'desc'=>['projectdtls_tbl.prjd_projectid'=>SORT_DESC],
                                                                ],
                                                                'referncenumber'=>[
                                                                    'asc'=>['licensinginfo_tbl.li_referenceno'=>SORT_ASC],
                                                                    'desc'=>['licensinginfo_tbl.li_referenceno'=>SORT_DESC],
                                                                ],
                                                                'licensename'=>[
                                                                    'asc'=>['licensinginfo_tbl.li_lictitleen'=>SORT_ASC],
                                                                    'desc'=>['licensinginfo_tbl.li_lictitleen'=>SORT_DESC],
                                                                ],
                                                                'sumittedon'=>[
                                                                    'asc'=>['licinvapplied_tbl.lia_createdon'=>SORT_ASC],
                                                                    'desc'=>['licinvapplied_tbl.lia_createdon'=>SORT_DESC],
                                                                ],
                                                            ]
                                                        ],
                                                    'pagination' => ['pageSize' => $page]]);
                $model2 = LicinvappliedTbl::find()
                ->asArray()->all();                                           
                return [
                    'items' => $provider->getModels(),
                    'total_count' => count($model2),
                    'total' => count($model->all()),
                ];
    }
    
    public function liaindex($data){
        $query = LicinvappliedTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $query->select(['projectdtls_pk','prjd_projectid','prjd_referenceno','prjd_projname','MCM_CompanyName','MemberCompMst_Pk',
        'mcm_referenceno','mcm_stakeholderstatus','lia_createdby','li_lictitleen','lia_status','li_referenceno','mrm_invidentity',
        'li_intrefno','li_targetduration','li_targetdurationtype','SecM_SectorName','lia_applicationno','li_createdon','lia_applsubmon',
        'lia_comments','lia_createdon','lia_appdeclon','aproved.um_firstname as fname','aproved.um_lastname as lname','lia_appdeclcomment',
        'usermst_tbl.um_firstname','usermst_tbl.um_lastname','lia_appdeclby','licinvapplied_pk','lia_updatedon',
        're.um_firstname as refname','re.um_lastname as relname'])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->leftJoin('usermst_tbl','lia_createdby=UserMst_Pk')
        ->leftJoin('usermst_tbl aproved','lia_appdeclby=aproved.UserMst_Pk')
        ->leftJoin('usermst_tbl re','lia_updatedby=re.UserMst_Pk')
        ->leftJoin('licensinginfo_tbl','lia_licensinginfo_fk=licensinginfo_pk')
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->leftJoin('memberregistrationmst_tbl','lia_memregmst_fk=MemberRegMst_Pk')
        ->leftJoin('sectormst_tbl','li_sectormst_fk=SectorMst_Pk')
        ->distinct(['lia_memregmst_fk']);

        
        if(!empty($data['search'])){
            $query->andFilterWhere(['or',
            ['like','membercompanymst_tbl.mcm_referenceno',$data['search']],
            ['like','membercompanymst_tbl.MCM_CompanyName',$data['search']]]);    
        }
        if(!empty($data['project'])){
            $query->andFilterWhere(['in','lia_projectdtls_fk',explode(",",$data['project'])]);
        }
        if(!empty($data['investor'])){
            $query->andFilterWhere(['in','lia_memregmst_fk',explode(",",$data['investor'])]);
        }
        if(!empty($data['license'])){
            $query->andFilterWhere(['in','lia_licensinginfo_fk',explode(",",$data['license'])]);
        }
        if(!empty($data['status'])){
            $query->andFilterWhere(['in','lia_status',explode(',',$data['status'])]);
        }
        $query->asArray();
        // $page=(!empty($size))?$size:10;

        $query1 = LicinvappliedTbl::find()->select('lia_memregmst_fk')->distinct()->all();
        $provider = new ActiveDataProvider([ 'query' => $query,
                                                'sort' => [
                                                    'attributes'=>[
                                                        'sumittedon'=>[
                                                            'asc'=>['licinvapplied_tbl.lia_createdon'=>SORT_ASC],
                                                            'desc'=>['licinvapplied_tbl.lia_createdon'=>SORT_DESC],
                                                        ],
                                                    ]
                                                ],
                                            'pagination' => false,
                                             ]);

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'total' => count($query1)
        ];
    }


    public function liafilterindex($data){
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        $page = Security::sanitizeInput($data['page'], "number");
        $query = LicinvappliedTbl::find()
        ->select(['MemberCompMst_Pk as pk','mcm_stakeholderstatus as stat',
            'mcm_referenceno as ref','MCM_CompanyName as name',
            'mrm_invidentity as type'])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=lia_memregmst_fk')
        ->leftJoin('licensinginfo_tbl','licensinginfo_pk=lia_licensinginfo_fk')
        ->distinct(['lia_memregmst_fk']);
        
        if(!empty($data['search'])){
            $query->andFilterWhere(['or',
            ['like','membercompanymst_tbl.mcm_referenceno',$data['search']],
            ['like','membercompanymst_tbl.MCM_CompanyName',$data['search']]
            ]);    
        }
        if(!empty($data['project'])){
            $query->andFilterWhere(['in','lia_projectdtls_fk',explode(",",$data['project'])]);
        }
        if(!empty($data['investor'])){
            $query->andFilterWhere(['in','lia_memregmst_fk',explode(",",$data['investor'])]);
        }
        if(!empty($data['license'])){
            $query->andFilterWhere(['in','lia_licensinginfo_fk',explode(",",$data['license'])]);
        }
        if(!empty($data['status'])){
            $query->andFilterWhere(['in','lia_status',explode(',',$data['status'])]);
        }
        $query->asArray()->All();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 
                                                'sort' => [
                                                    'attributes'=>[
                                                        'sumittedon'=>[
                                                            'asc'=>['licinvapplied_tbl.lia_createdon'=>SORT_ASC],
                                                            'desc'=>['licinvapplied_tbl.lia_createdon'=>SORT_DESC],
                                                        ],
                                                    ]
                                                ],
                                             'pagination' => ['pageSize' => $page]]);

        $model = LicinvappliedTbl::find()
        ->select(['lia_projectdtls_fk'])
        ->distinct(['lia_projectdtls_fk'])
        ->asArray()->all();  
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $size,
            'total_entry' => count($model)
        ];
    }

    public static function licform($data){
        $model = LicinvappliedTbl::find()->where("licinvapplied_pk =:pk",[':pk'=> (int)$data['pk']])->one();
        $model->lia_status = $data['select'];
        $model->lia_appdeclcomment = $data['comments'];
        $model->lia_appdeclon = date('Y-m-d H:i:s');
        $model->lia_appdeclbyipaddr = \common\components\Common::getIpAddress();
        $model->lia_appdeclby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);

        $model2 = new LicapprhstyTbl();
        $model2->lah_licinvapplied_fk = $data['pk'];
        $model2->lah_status = $data['select'];
        $model2->lah_comments = $data['comments'];
        $model2->lah_apprdeclon =  date('Y-m-d H:i:s');
        $model2->lah_apprdeclby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model2->lah_apprdeclbyipaddr  =  \common\components\Common::getIpAddress();

        if ($model->save() === false || !$model) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>'Something went wrong!',
            ); 
        }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Successfull!',
            );
        }
        return $result;
    }

    public function getlicauth($pk){
        $model = LicinvappliedTbl::find()
        ->select(['licinvapplied_tbl.licinvapplied_pk as pk',
                    'licinvapplied_tbl.lia_applsubmon as sumittedon',
                    'licinvapplied_tbl.lia_status as licensestatus',
                    'licinvapplied_tbl.lia_comments as lia_comments',
                    'licinvapplied_tbl.lia_appdeclcomment as lia_appdeclcomment',
                    'licinvapplied_tbl.lia_createdon as createdon',
                    'licinvapplied_tbl.lia_updatedon as updatedon',
                    'licinvapplied_tbl.lia_appdeclon as lia_appdeclon',
                    'licinvapplied_tbl.lia_applicationno as licenseapp',
                    'licensinginfo_tbl.li_lictitleen as licensename',
                    'licensinginfo_tbl.li_referenceno as referncenumber',
                    'projectdtls_tbl.prjd_projectid as projectid',
                    'projectdtls_tbl.prjd_referenceno as projrefno',
                    'projectdtls_tbl.prjd_projname as projname', 
                    'membercompanymst_tbl.mcm_referenceno as investorid',
                    'membercompanymst_tbl.MCM_CompanyName as name',
                    'membercompanymst_tbl.mcm_stakeholderstatus as stat',
                    'sectormst_tbl.SecM_SectorName as sectorauth',
                    'sec.SecM_SectorName as sector',
                    'usermst_tbl.um_firstname as fname',
                    'usermst_tbl.um_lastname as lname',
                    'app.um_firstname as appfname',
                    'app.um_lastname as applname',
                    'upp.um_firstname as uppfname',
                    'upp.um_lastname as upplname',
                    'licensinginfo_tbl.li_referenceno as refrencenumber'
                    ])
        ->leftJoin('projectdtls_tbl','lia_projectdtls_fk=projectdtls_pk')
        ->leftJoin('licensinginfo_tbl','lia_licensinginfo_fk=licensinginfo_pk')
        ->leftJoin('membercompanymst_tbl','lia_memregmst_fk=MCM_MemberRegMst_Fk')
        ->leftJoin('sectormst_tbl','licensinginfo_tbl.li_sectormst_fk=SectorMst_Pk')
        ->leftJoin('sectormst_tbl sec','projectdtls_tbl.prjd_sectormst_fk=sec.SectorMst_Pk')
        ->leftJoin('usermst_tbl','lia_createdby=UserMst_Pk')
        ->leftJoin('usermst_tbl upp','lia_updatedby=upp.UserMst_Pk')
        ->leftJoin('usermst_tbl app','lia_appdeclby=app.UserMst_Pk')
        ->andWhere(['licinvapplied_pk'=>$pk])->asArray()->one();
  
        return $model;

    }

    public function projectlicenselist($datavalue=null){
        $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $size = Security::sanitizeInput($datavalue['size'], "number");
         $query = LicinvappliedTbl::find();
         if(!empty($datavalue))
         {
         $datavalue= json_decode($datavalue['formdata']);
         $page=(!empty($size))?$size:10;
            if(!empty($datavalue->searchvalue->licencevalue))
            $query->andWhere("licensinginfo_tbl.licensinginfo_pk=:licencepk",array(':licencepk'=>$datavalue->searchvalue->licencevalue)); 
            if(!empty($datavalue->searchvalue->projectvalue))
            $query->andWhere("licinvapplied_tbl.lia_projectdtls_fk=:projectpks",array(':projectpks'=>$datavalue->searchvalue->projectvalue));
            if(!empty($datavalue->searchvalue->licencestatus))
            $query->andWhere("licinvapplied_tbl.lia_status IN ({$datavalue->searchvalue->licencestatus})");
            if(!empty($datavalue->formvalue->search))
                $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('li_referenceno', true), ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','lia_applicationno', ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','li_lictitleen', ':value',array(':value' =>  $datavalue->formvalue->search)]]);
         }
         if(!empty($datavalue))
         {
         $query->select('projectdtls_pk as projectpk');
         }else{
            $query->select('count(distinct projectdtls_pk) as projectpk');  
         }
         $query->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk'); 
         $query->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk'); 
         $query->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk'); 
         $query->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk');
         $query->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk');
         $query->andWhere('licinvapplied_tbl.lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $query->asArray();
         $query->distinct(TRUE);
         $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
         return [
             'items' => $provider->getModels(),
             'total_count' => $provider->getTotalCount(),
             'limit' => $page,
         ];
         
     }
     
     public function getlicdtls($data)
     {
 
       return new ActiveDataProvider([
         'query' => LicinvappliedTbl::find()
             ->select(['licinvapplied_tbl.*','licprocedurepinup_tbl.*','prjd_projectid','prjd_referenceno',
             'prjd_projname','projectdtls_pk','licensinginfo_tbl.*','SecM_SectorName',
             'crby.um_firstname as invfname','decby.um_firstname as licauthfname',
             'crby.um_lastname as invlname','decby.um_lastname as licauthlname',
             'reby.um_lastname as rebyinvlname','reby.um_firstname as rebyinvfname',
             ])
             ->where('licinvapplied_pk=:id',array(':id' =>  $data['licdtls']))
         ->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk')
         ->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk')
          ->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk')
          ->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk')
          ->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk')
           ->leftJoin('usermst_tbl decby','licinvapplied_tbl.lia_appdeclby=decby.UserMst_Pk')
         ->leftJoin('usermst_tbl crby','licinvapplied_tbl.lia_createdby=crby.UserMst_Pk')
         ->leftJoin('usermst_tbl reby','licinvapplied_tbl.lia_updatedby=reby.UserMst_Pk')
           ->asArray()
 
     ]);
     }
     public function getlicenselist($datavalue,$projectlistpks){
         
         $datavalue= json_decode($datavalue['formdata']);
         $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $querylist = LicinvappliedTbl::find();
         
         
             $projectpks=0;
             if(!empty($projectlistpks))
             {
                 $projectpks= implode(',', $projectlistpks);
             }
            if(!empty($datavalue->searchvalue->licencevalue))
            $querylist->andWhere("licensinginfo_tbl.licensinginfo_pk=:licencepk",array(':licencepk'=>$datavalue->searchvalue->licencevalue)); 
            if(!empty($datavalue->searchvalue->projectvalue))
            $querylist->andWhere("licinvapplied_tbl.lia_projectdtls_fk=:projectpks",array(':projectpks'=>$datavalue->searchvalue->projectvalue));
            if(!empty($datavalue->searchvalue->licencestatus))
            $querylist->andWhere("licinvapplied_tbl.lia_status IN ({$datavalue->searchvalue->licencestatus})");
            if(!empty($datavalue->formvalue->search))
             $querylist->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('li_referenceno', true), ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','lia_applicationno', ':value',array(':value' =>  $datavalue->formvalue->search)],['LIKE','li_lictitleen', ':value',array(':value' =>  $datavalue->formvalue->search)]]);
 
         
         
         $querylist->select(['licinvapplied_tbl.*','prjd_projectid','prjd_referenceno','prjd_projname','projectdtls_pk','li_lictitleen','li_referenceno','SecM_SectorName']);
         $querylist->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk'); 
         $querylist->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk'); 
         $querylist->leftJoin('sectormst_tbl','sectormst_tbl.SectorMst_Pk=licensinginfo_tbl.li_sectormst_fk'); 
         $querylist->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk');
         $querylist->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk');
         $querylist->andWhere('licinvapplied_tbl.lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $querylist->andWhere("licinvapplied_tbl.lia_projectdtls_fk IN ($projectpks)") ;
         $querylist->orderBy('licinvapplied_tbl.lia_createdon desc');
         $querylist->asArray();
         
         return $querylist->all();
     }
 
         public function projectlist(){
         $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $query = LicinvappliedTbl::find();
         $query->select(['prjd_projname','projectdtls_pk']);
         $query->leftJoin('projectdtls_tbl','projectdtls_tbl.projectdtls_pk=licinvapplied_tbl.lia_projectdtls_fk'); 
         $query->leftJoin('licensinginfo_tbl','licensinginfo_tbl.licensinginfo_pk=licinvapplied_tbl.lia_licensinginfo_fk'); 
         $query->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=licinvapplied_tbl.lia_memregmst_fk');
         $query->andWhere('licinvapplied_tbl.lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $query->orderBy('prjd_projname ASC');
         $query->distinct(true);
         $query->asArray();
         return $query->all();
     }
     
     public function licencelist1(){
         $usemstpk= \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
         $query = \api\modules\mst\models\LicensinginfoTbl::find();
         $query->select(['li_lictitleen','licensinginfo_pk']);
         $query->leftJoin('licprocedurepinup_tbl','licprocedurepinup_tbl.lppu_licensinginfo_fk=licensinginfo_tbl.licensinginfo_pk'); 
         $query->leftJoin('usermst_tbl','usermst_tbl.UserMst_Pk=licprocedurepinup_tbl.lppu_pinnedby');
         $query->leftJoin('memberregistrationmst_tbl','memberregistrationmst_tbl.MemberRegMst_Pk=usermst_tbl.UM_MemberRegMst_Fk');
         $query->andWhere('licprocedurepinup_tbl.lppu_pinnedby=:id',array(':id' =>  $usemstpk)) ;
         $query->orderBy('li_lictitleen ASC');
         $query->distinct(true);
         $query->asArray();
         return $query->all();
     }
      public function licencelistcount(){
         $memcomregpk= \yii\db\ActiveRecord::getTokenData('reg_pk', true);
         $query = LicinvappliedTbl::find();
         $query->select(["sum(if (lia_status = '1',1,0)) as approvedcount","sum(if (lia_status = '3',1,0)) as declinedcount","sum(if (lia_status = '4',1,0)) as submitted","sum(if (lia_status = '5',1,0)) as resubmitted","sum(if (lia_status = '6',1,0)) as notapplicable"]);
         $query->andWhere('lia_memregmst_fk=:id',array(':id' =>  $memcomregpk)) ;
         $query->asArray();
         $licemcount=$query->one();;
         $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true); 
         $querypinned = \api\modules\inv\models\LicprocedurepinupTbl::find();
         $querypinned->select(["count(licprocedurepinup_pk) as pinnedcount"]);
         $querypinned->andWhere('lppu_memcompmst_fk=:id',array(':id' =>  $companypk)) ;
         $querypinned->asArray();
         $pinnedcount=$querypinned->one();
         $totalcount['licencecount']=$licemcount;
         $totalcount['pinnedcount']=$pinnedcount;
         return $totalcount;
     }
      public function investorlist(){
         $licencepk=71;
          $query = LicinvappliedTbl::find()
          ->select(['MCM_CompanyName','MemberCompMst_Pk'])
         ->leftJoin('membercompanymst_tbl','MCM_MemberRegMst_Fk=lia_memregmst_fk') 
         ->where('lia_licensinginfo_fk =:id',array(':id' =>  $licencepk))
         ->groupBy('MemberCompMst_Pk')
         ->asArray()->all();
         return $query;
      }
      public function licensetitle_list(){
          $licencepk=71;
         $query = LicinvappliedTbl::find()
         ->select(['prjd_projname','projectdtls_pk'])
         ->leftJoin('projectdtls_tbl','projectdtls_pk=lia_projectdtls_fk')
         ->where('lia_licensinginfo_fk =:id',array(':id' =>  $licencepk)) 
         ->groupBy('projectdtls_pk')
         ->asArray()->all();
         return $query;
      }
      public function noclicencelistcount(){
         $licencepk=\yii\db\ActiveRecord::getTokenData('licencepk',true);
         $licencepk=71;
         $query = LicinvappliedTbl::find()
        ->select(['count(1) as Received','ifnull(sum(if(lia_status=4,1,0)),0) as Yet_to_Validate','ifnull(sum(if(lia_status=5,1,0)),0) as Yet_to_Validateresubmit','ifnull(sum(if(lia_status=1,1,0)),0) as Approved','ifnull(sum(if(lia_status=3,1,0)),0) as Declined','ifnull(sum(if(lia_status=6,1,0)),0) as Not_Applicable'])
         ->where('lia_licensinginfo_fk=:id',array(':id' =>  $licencepk))
         ->asArray()->all();
         return $query;
     }
     public function lilist($data){
         if($data['projectpk'])
         {
        $projectpk= \common\components\Security::decrypt($data['projectpk']);
        if($projectpk)
        {
        $model = \api\modules\pd\models\ProjreqdlictmpTbl::find()
            ->select('group_concat(prlt_licensinginfo_fk) as pks')
            ->andWhere('prlt_projecttmp_fk=:id',array(':id' => $projectpk))
            ->asArray()
            ->one();
        }  
         }
         $query = \api\modules\mst\models\LicensinginfoTbl::find();
         $query->select(['li_lictitleen','licensinginfo_pk']);
         $query->orderBy('li_lictitleen ASC');
         if(!empty($model['pks']))
         $query->andwhere("licensinginfo_pk NOT IN({$model['pks']})");
         $query->andwhere('li_status=1');
         $query->asArray();
         return $query->all();
     }
}
