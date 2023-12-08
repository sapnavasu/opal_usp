<?php
namespace api\components;
use yii;
use yii\web\Session;
use yii\base\Component;
use common\models\MembercompanymstTbl;
use common\models\MemberregistrationmstTbl;

class Sessionn extends Component{

    public static function setSession(){

    $session = \Yii::$app->session;


    // $session->close();

    // $session->removeAll();

    // $session->destroy();

    session_id("session2");

    $session->open();

    // $model = MemberregistrationmstTbl::find()
    // ->select(['MemberCompMst_Pk','MCM_MemberRegMst_Fk','MRM_MemberStatus','MCM_CountryMst_Fk','MemberRegMst_Pk','MCM_Origin',
    // 'MCM_Source_CountryMst_Fk','UM_Type','MRM_CompType','UserMst_Pk','UM_MemberRegMst_Fk'])
    // ->joinWith('Company','Registration')
    // ->where('MemberRegMst_Pk =:MemberRegMst_Pk AND MRM_CompType IN ("S", "SP")',[':MemberRegMst_Pk' => 575]);

    $session['company_primary_id'] = 1;
                               
    $session['company_primary_reg_id'] = 1;

    $session['is_login'] = 1;

    $session['user_status'] = 'A';

    $session['login_time_stamp']= time();

    $session['company_country'] =  31;

    $session['register_primary_id'] = 575;

    $session['user_origin'] = 'N';

    $session['user_source_country'] = 31;

    $session['logintype'] = 'C';

    $session['user_type'] = 'S';

    //session['company_type'] = $row[0]['MRM_CompType'];

    $session['company_user_primary_id'] = 1;

    $session['company_user_member_id'] = 575;

   // session_start();
    $_SESSION['mysession'] = 'mysession sudahkar';

    return $session;
    // Yii::app()->db->createCommand("update usermst_tbl set UM_Online_Status='A' where UserMst_Pk=".session['company_user_primary_id'])->execute();
    }

}