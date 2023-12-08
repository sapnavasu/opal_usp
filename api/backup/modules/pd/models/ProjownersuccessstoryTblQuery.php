<?php

namespace api\modules\pd\models;
use Yii;
use yii\data\ActiveDataProvider;
use common\components\Security;
use common\components\Common;
use \common\models\UsermstTbl;
use api\modules\mst\models\CountryMaster;
use api\modules\pd\models\ProjtechnicaltmpTbl;
use api\modules\pd\models\ProjinvinfotmpTbl;
use api\modules\pd\models\ProjaccachievetmpTbl;
use api\modules\pd\models\ProjfaqtmpTbl;
use api\modules\pd\models\ProjinvmappingtmpTbl;
use api\modules\pd\models\ProjlicpermauthTblQuery;
use api\modules\pd\models\ProjectpartnerdtlsTbl;

/**
 * This is the ActiveQuery class for [[ProjownersuccessstoryTbl]].
 *
 * @see ProjownersuccessstoryTbl
 */
class ProjownersuccessstoryTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjownersuccessstoryTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function index($data)
    {  
        // return $_SESSION['v3session'];
        $query = ProjownersuccessstoryTbl::find();
        $size = Security::sanitizeInput($data['size'], "number");
        $sortpk = Security::sanitizeInput($data['onsortpk'], "number");
        if(array_key_exists('memberRegPk',$data)){ 
            $memberRegPk = $data['memberRegPk'];
            $securityObj = new Security();
            $companypk = $securityObj->decrypt($memberRegPk);
        }else{
            $companypk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        }
        // return $companypk;

        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            unset($data['onsortpk']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    if($key!="prjd_projname" && $key!="SecM_SectorName")
                    {
                      $query->andOnCondition("$key IN ($val)");
                    }else{
                      $query->andFilterWhere(['or',['LIKE',Common::getTableWithPrefix('prjd_projname', true), ':value',array(':value' =>  $val)],
                      ['LIKE',Common::getTableWithPrefix('SecM_SectorName', true), ':value',array(':value' =>  $val)]]); 
                    }
                }
            }
        }
        $query->select(['*',"crby.um_firstname as ownerfname","crby.um_lastname as ownerlname","decby.um_firstname as appfname","decby.um_lastname as applname"]);
        $query->leftJoin('projectdtls_tbl','projownersuccessstory_tbl.poss_projectdtls_fk = projectdtls_tbl.projectdtls_pk');
        $query->leftJoin('sectormst_tbl','projectdtls_tbl.prjd_sectormst_fk=sectormst_tbl.sectorMst_Pk');        
        $query->leftJoin('projstagemst_tbl','projectdtls_tbl.prjd_projstage=projstagemst_tbl.projstagemst_pk');        
        $query->leftJoin('usermst_tbl crby','projownersuccessstory_tbl.poss_submittedby=crby.UserMst_Pk');
        $query->leftJoin('usermst_tbl decby','projownersuccessstory_tbl.poss_appdeclby=decby.UserMst_Pk');
        $query->leftJoin('memberregistrationmst_tbl','crby.UM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk');
        $query->andWhere('MemberRegMst_Pk=:id',array(':id' => $companypk)); 
        if($sortpk==1){
        $query->orderBy('projownersuccessstory_pk DESC');
        }else {
        $query->orderBy('projownersuccessstory_pk ASC');    
        }
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        $model = ProjownersuccessstoryTbl::find()
        ->select(['projownersuccessstory_pk'])    
        ->leftJoin('projectdtls_tbl','projownersuccessstory_tbl.poss_projectdtls_fk = projectdtls_tbl.projectdtls_pk')
        ->leftJoin('usermst_tbl crby','projownersuccessstory_tbl.poss_submittedby=crby.UserMst_Pk')
        ->leftJoin('usermst_tbl decby','projownersuccessstory_tbl.poss_appdeclby=decby.UserMst_Pk')
        ->leftJoin('memberregistrationmst_tbl','crby.UM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk')
        ->leftJoin('membercompanymst_tbl','membercompanymst_tbl.MCM_MemberRegMst_Fk=memberregistrationmst_tbl.MemberRegMst_Pk')
        ->andWhere('MemberRegMst_Pk=:id',array(':id' => $companypk))
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total_entry' => count($model)
        ];
    }
    
    public function addsstory($id)
    {
       $projectpk= Security::sanitizeInput($id['projectvalue'], "number");
        $model = new ProjownersuccessstoryTbl(); 
        $model->poss_submittedon=date('Y-m-d H:i:s');
        $model->poss_submittedby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->poss_projectdtls_fk=$projectpk;
        $model->poss_status=Security::sanitizeInput(1, "number");
        $model->poss_successstory= $id['ssdesc'];
        if($model->save())
        {
        $result=array(
            'status' => 200,
            'statusmsg' => 'success',
            'flag'=>'S',
            'data'=>$model->projownersuccessstory_pk,
        );
        }else{
            $result=array(
                'status' => 101,
                'statusmsg' => 'warning',
                'flag'=>'E',
                'msg'=>$model->getErrors(),
            );
        }
        return json_encode($result);
        
    
    }
    
    public function fetchvid($resParam){
        $Pk = Security::decrypt($resParam->pk);
        $scData = ProjownersuccessstoryTbl::find()
                ->where(['projownersuccessstory_pk'=>$Pk])
                ->one();
        return $scData;
    }
    
    public function saveVideo($save){
        $docType =  $save['docType'];
        $ret = 1;
        if($ret == 1){
                $addvid = ProjownersuccessstoryTbl::find()
                    ->where(['projownersuccessstory_pk'=>$save['pk']])
                    ->one();
                $addvid->poss_youtubelink = $save['uploadVideo'];
                if(!$addvid->save()){
                    $ret = 0;
                }
        }
        return $ret;
    }
}
