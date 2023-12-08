<?php

namespace api\modules\pms\models;

use common\components\Common;

/**
 * This is the ActiveQuery class for [[JsrchdwnldtrackTbl]].
 *
 * @see JsrchdwnldtrackTbl
 */
class JsrchdwnldtrackTblQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return JsrchdwnldtrackTbl[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return JsrchdwnldtrackTbl|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function savedownloadhistory($compPk = null, $fieldarray = null, $query_for_excel_generation, $search_by, $type) {
        if($fieldarray) {

            $userPK = \yii\db\ActiveRecord::getTokenData('UserMst_Pk', true);
            $userName = \yii\db\ActiveRecord::getTokenData('user_name', true); 
            $compnay_name = \yii\db\ActiveRecord::getTokenData('MCM_CompanyName', true);
            $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
            $companyreg_id = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk', true);
            $user_mail_id = \yii\db\ActiveRecord::getTokenData('UM_EmailID', true);
            $expiryafter =  \Yii::$app->params['supplier_profile_export']['link_expiry_hours']; 
            // $expiryafterdatetime =    date('Y-m-d', strtotime("+$expiryafter days")); 
            
            $date = date('Y-m-d H:i:s');
            $ip_address = Common::getIpAddress();

            $search_by_table = self::array_to_table($search_by);

            $model = new JsrchdwnldtrackTbl(); 

            $model->jsdt_memberregmst_Fk =  $companyreg_id;
            $model->jsdt_category = $type;  
            $model->jsdt_usermst_fk =  $userPK;
            $model->jsdt_dwnlddate =  $date; 
            $model->jsdt_inputfields =  \base64_encode($search_by_table);
            $model->jsdt_exptquery =  $query_for_excel_generation;
            $model->jsdt_exptlist =  json_encode($fieldarray);
            $model->jsdt_exptstatus =  1;
            $model->jsdt_exptby =  $userPK;
            $model->jsdt_expton =   $date;
            $model->jsdt_exptbyipaddr =  $ip_address;
            $model->jsdt_emailid =  $user_mail_id;
            $model->jsdt_mailstatus =  2; 

            if($model->save()){
                $trackid = $model->jsrchdwnldtrack_pk; 
                try {
                    $consolePath = \Yii::$app->params['consolePath'];
                    $consoleCalling = \Yii::$app->params['consoleCalling'];
                    $link =  \Yii::$app->params['baseUrl'] . "profile/exportcsv";
                    $baseMailPath = \Yii::$app->params['baseMailPath'];
                    $fieldarray_input = json_encode($fieldarray); 
                    $required_data_input = json_encode($required_data); 
                    // echo "{$consoleCalling} {$consolePath}yii export/exportproductdata $compPk  $fieldarray_input $userPK $trackid $type $baseMailPath $expiryafter";exit;
                    if($type == 'P') {
                        pclose(popen("start {$consoleCalling} {$consolePath}yii export/exportproductdata $compPk $fieldarray_input $userPK $trackid $type $baseMailPath $expiryafter", "r")); 
                    } else {
                        pclose(popen("start {$consoleCalling} {$consolePath}yii export/exportservicedata $compPk $fieldarray_input $userPK $trackid $type $baseMailPath $expiryafter", "r")); 
                    }
                }
                catch(Exception $e){                            
                    $errormsg = $e->getMessage();                            
                    self::getErrormsg($errormsg,$pkid);                             
                }
                $retexp = date("d-m-Y", strtotime($expdate));
                if($type == 'P') {
                    $type_content = 'Product';
                } else {
                    $type_content = 'Service';
                }
                $message  = "Exporting  " . $type_content . " Catalogue once completed, The file will be send to your registered email ID";

                return  [ 'msg' => $message , 'status' => 200];
            }
        }
    }

    function array_to_table($search_by) {   
        $table .= "<table>";  
        foreach ($search_by as $key => $search_by_value) {
            $table .= "<tr>"; 
            $table .= "<td>" . $search_by_value['key'] . "</td>";  
            $table .= "<td>" . $search_by_value['value'] . "</td>";  
            $table .= "</tr>";
        } 
        return $table .= "</table>";
    }

} 