<?php

namespace api\modules\mcp\models;
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
 * This is the ActiveQuery class for [[MemcompsubsidiarydtlsTbl]].
 *
 * @see MemcompsubsidiarydtlsTbl
 */
class MemcompsubsidiarydtlsTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return MemcompsubsidiarydtlsTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return MemcompsubsidiarydtlsTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function addSubs($data){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $value=$data['subs'];
        $addsubs = MemcompsubsidiarydtlsTbl::find()->where('memcompsubsidiarydtls_pk=:pk',array(':pk'=>$value['pk']))->one();
        if(empty($addsubs)){
        $addsubs = new MemcompsubsidiarydtlsTbl;
        }
        $addsubs->mcsd_membercompmst_fk=$companypk;
        $addsubs->mcsd_investmentdls= Security::sanitizeInput($value['investdtls'], "string");
        $addsubs->mcsd_address= Security::sanitizeInput($value['subsidyaddress'], "string");
        $addsubs->mcsd_marketshare= Security::sanitizeInput($value['pershare'], "number");
        $addsubs->mcsd_subsidname= Security::sanitizeInput($value['subsidyname'], "string");     
        if ($addsubs->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$addsubs->getErrors()
                );
            }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Subsidiaries Add / Updated successfully!',
                'returndata' => $addsubs,
            ); 
            }
            return json_encode($result);
    }
    public function addinvinfo($data){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $regpk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $value=$data['subs'];
        $arr=  $value['licensename'];
        $addsubs = \api\modules\mst\models\MemberregistrationmstTbl::find()->where('MemberRegMst_Pk=:pk',array(':pk'=>$regpk))->one();
        $addsubs->mrm_invidentitymst_fk= Security::sanitizeInput($value['investid'], "number");
        $addsubs->mrm_invintent_fk= Security::sanitizeInput($value['registrationint'], "number");
        $addsubs->mrm_sectormst_fk= implode(',', $data['val']);
        $addsubs->mrm_investortypeprefmst_fk= implode(',', $value['cinv_type_pre']);
        $addsubs->mrm_cmplisting=  implode(',', $arr);     
        if ($addsubs->save() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$addsubs->getErrors()
                );
            }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Info Add / Updated successfully!',
                'returndata' => $addsubs,
            ); 
            }
            return json_encode($result);
    }
    public function deletesubsidiaries($data){
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $value=$data['subs'];
        $addsubs = MemcompsubsidiarydtlsTbl::find()->where('memcompsubsidiarydtls_pk=:pk',array(':pk'=>$value))->one();
        if ($addsubs->delete() === false) {
                $result=array(
                    'status' => 404,
                    'statusmsg' => 'warning',
                    'flag'=>'E',
                    'msg'=>$addsubs->getErrors()
                );
            }else{
            $result=array(
                'status' => 200,
                'statusmsg' => 'success',
                'flag'=>'S',
                'msg'=>'Subsidiaries deleted successfully!',
                'returndata' => $addsubs,
            ); 
            }
            return json_encode($result);
    }
    public function getprofiledata() {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $regpk=\yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $model = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select(['mrm_investortypeprefmst_fk','mcm_referenceno','maincountry.CyM_CountryDialCode as mobccode','dial.CyM_CountryDialCode as landccode','maincountry.CountryMst_Pk as mobcc','dial.CountryMst_Pk as landcc','um_primobno','um_landlineno','um_landlineext','UM_EmailID','MCM_website','mrm_invintent_fk','mrm_sectormst_fk','mrm_invidentitymst_fk','mrm_cmplisting'])
                ->leftJoin('memberregistrationmst_tbl','MemberRegMst_Pk=MCM_MemberRegMst_Fk')
                ->leftJoin('usermst_tbl','UM_MemberRegMst_Fk=MemberRegMst_Pk')
                ->leftJoin('countrymst_tbl as maincountry','maincountry.CyM_CountryDialCode=usermst_tbl.um_primobnocc')
                ->leftJoin('countrymst_tbl as dial','dial.CyM_CountryDialCode=usermst_tbl.um_landlinecc')
                ->where('MemberRegMst_Pk=:memcomppk',[':memcomppk'=> $regpk])
                ->andWhere('UM_Type=:status',[':status'=>'C'])
                ->asArray()->all();
        return $model;
    }
    public function getsubsedit($data) {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model = MemcompsubsidiarydtlsTbl::find()
                ->select('*')
                ->leftJoin('membercompanymst_tbl','mcsd_membercompmst_fk=MemberCompMst_Pk')
                ->where('memcompsubsidiarydtls_pk=:pk',[':pk'=> $data['subs']])
                ->asArray()->all();
        return $model;
    }
    public function getcompinfo() {
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $model = \api\modules\mst\models\MembercompanymstTbl::find()
                ->select('*')
                ->where('MemberCompMst_Pk=:pk',[':pk'=> $companypk])
                ->asArray()->all();
        return $model;
    }
    public function getsubsindex($data)
    {   $query = MemcompsubsidiarydtlsTbl::find();
        $companypk=\yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $size = Security::sanitizeInput($data['size'], "number");
        if($data['type']=='filter')
        {
            unset($data['type']);
            unset($data['page']);
            unset($data['size']);
            foreach(array_filter($data) as $key =>$val)
            {
                if($val !=null)
                {
                    $query->andFilterWhere(['or',['LIKE','mcsd_subsidname',$val],['LIKE','mcsd_investmentdls',$val]]); 
                }
            }
        }
        $query->select(['*']);     
        $query->andWhere('mcsd_membercompmst_fk=:memcomppk',[':memcomppk'=> $companypk]);
        $query->orderBy('memcompsubsidiarydtls_pk DESC');
        $query->asArray();
        $page=(!empty($size))?$size:10;
        $provider = new \yii\data\ActiveDataProvider([ 'query' => $query, 'pagination' => ['pageSize' =>$page]]);
        
        $model = MemcompsubsidiarydtlsTbl::find()
        ->select(['memcompsubsidiarydtls_pk'])
        ->where('mcsd_membercompmst_fk=:pk',array(':pk' =>  $companypk))
        ->asArray()->all();
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => $page,
            'total_entry' => count($model)
        ];
    }
}
