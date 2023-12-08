<?php

namespace api\modules\mst\models;

use Yii;
use common\components\Security;

/**
 * This is the model class for table "globalportalmst_tbl".
 *
 * @property int $globalportalmst_pk Primary key
 * @property string $gpm_refno Reference no to the respective portal
 * @property string $gpm_portalname Portalname
 * @property string $gpm_listofcountries List of countrymst_pk in comma separation
 * @property int $gpm_status 1 - Active, 2 - Inactive
 * @property string $gpm_createdon Datetime of creation
 * @property int $gpm_createdby Reference to usermst_tbl
 * @property string $gpm_createdbyipaddr User IP Address
 * @property string $gpm_updatedon Datetime of updation
 * @property int $gpm_updatedby Reference to usermst_tbl
 * @property string $gpm_updatedbyipaddr User IP Address
 */
class GlobalportalmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'globalportalmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gpm_refno', 'gpm_portalname', 'gpm_listofcountries', 'gpm_status', 'gpm_createdon', 'gpm_createdby'], 'required'],
            [['gpm_listofcountries'], 'string'],
            [['gpm_status', 'gpm_createdby', 'gpm_updatedby'], 'integer'],
            [['gpm_createdon', 'gpm_updatedon'], 'safe'],
            [['gpm_refno'], 'string', 'max' => 20],
            [['gpm_portalname'], 'string', 'max' => 40],
            [['gpm_createdbyipaddr', 'gpm_updatedbyipaddr'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'globalportalmst_pk' => 'Globalportalmst Pk',
            'gpm_refno' => 'Gpm Refno',
            'gpm_portalname' => 'Gpm Portalname',
            'gpm_listofcountries' => 'Gpm Listofcountries',
            'gpm_status' => 'Gpm Status',
            'gpm_createdon' => 'Gpm Createdon',
            'gpm_createdby' => 'Gpm Createdby',
            'gpm_createdbyipaddr' => 'Gpm Createdbyipaddr',
            'gpm_updatedon' => 'Gpm Updatedon',
            'gpm_updatedby' => 'Gpm Updatedby',
            'gpm_updatedbyipaddr' => 'Gpm Updatedbyipaddr',
        ];
    }
    
    public static function getFrameworkData($requestdata){
        $query = self::find();
        $RequestData = $requestdata;

        $query->select(['globalportalmst_pk','gpm_portalname', 'gpm_refno','gpm_listofcountries','gpm_status']);
        if(!empty($_REQUEST['portalname'])){
            $frameworkname = strtolower(\common\components\Security::sanitizeInput($_REQUEST['portalname'],"string"));
            $query->andWhere('lower(gpm_portalname) like :gpm_portalname',[':gpm_portalname' => "%{$frameworkname}%"]);
        }
        
        if(!empty($_REQUEST['refno'])){
            $refno = strtolower(\common\components\Security::sanitizeInput($_REQUEST['refno'],"string"));
            $query->andWhere('lower(gpm_refno) like :gpm_refno',[':gpm_refno' => "%{$refno}%"]);
        }
        
        if(!empty($_REQUEST['countries'])){
            $order = strtolower(\common\components\Security::sanitizeInput($_REQUEST['countries'],"number"));
            $query->andWhere('find_in_set(:order,gpm_listofcountries)',[':order' => $order]);
        }
        $sort_column = (strpos($_REQUEST['sort'],"-") !== false) ? explode("-",$_REQUEST['sort'])[1] : $_REQUEST['sort'];
        $query->orderBy("$sort_column {$_REQUEST['order']}");
        $query->asArray();
        $page = (!empty($RequestData['size'])) ? $RequestData['size'] : 10 ;  
        
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
            ]
        ]);
        $data = $provider->getModels();
        foreach($data as $key => $value){
            $countrynames = CountryMaster::find()->select(['group_concat(CyM_CountryName_en) as countryname'])
                    ->where(['IN','CountryMst_Pk', explode(",", $value['gpm_listofcountries'])])
                    ->asArray()->one()['countryname'];
            $data[$key]['countrynames'] = $countrynames;
        }
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
    }
    
    public static function saveNewFramework($requestdata){
        $userpk = \yii\db\ActiveRecord::getTokenData('user_pk',true);
        $ipAddress = \common\components\Common::getIpAddress();
        $frameworkname = Security::sanitizeInput($requestdata['framework_name'], "string");
        if(self::isPortalAlreadyExists('gpm_refno',$requestdata['framework_refno'],$requestdata['framework_pk'])){
            return 2; //Refno already exists
        }
        if(self::isPortalAlreadyExists('gpm_portalname',$frameworkname,$requestdata['framework_pk'])){
            return 3; //portalname already exists
        }
        if($requestdata['framework_pk']){
            $model = self::findOne($requestdata['framework_pk']);
            $model->gpm_updatedon = date('Y-m-d H:i:s');
            $model->gpm_updatedby = $userpk;
            $model->gpm_updatedbyipaddr = $ipAddress;
        }else{
            $model = new GlobalportalmstTbl();
            $model->gpm_createdon = date('Y-m-d H:i:s');
            $model->gpm_createdby = $userpk;
            $model->gpm_createdbyipaddr = $ipAddress;
        }
        
        $model->gpm_refno = $requestdata['framework_refno'];
        $model->gpm_portalname = $frameworkname;
        $model->gpm_listofcountries = Security::sanitizeInput(implode(",",$requestdata['framework_countries']),"string_spl_char");
        $model->gpm_status = ($requestdata['framework_status']) ? 1 : 2;
        
        return $model->save();
    }
    
    public static function getframeworkbypk($pk){
        return self::findOne($pk);
    }
    
    public static function changeStatus($pk){
        if(empty($pk)){
           return false; 
        }
        $model = self::findOne($pk);
        $model->gpm_status = ($model->gpm_status == 1) ? 2 : 1;
        return $model->save();
    }
    
    public static function isPortalAlreadyExists($column,$dataToCheck,$globalportalmst_pk){
        if(empty($globalportalmst_pk)){
            return self::find()->where("$column = :dataToCheck",[':dataToCheck' => $dataToCheck])->exists();
        }
        return self::find()->where("$column = :dataToCheck and globalportalmst_pk <> :globalportalmst_pk",[':dataToCheck' => $dataToCheck, ':globalportalmst_pk' => $globalportalmst_pk])->exists();
    }
    
    public static function getCountryList(){
        $query = CountryMaster::find()
            ->select(['CountryMst_Pk', 'CyM_CountryName_en', 'CyM_CountryCode_en', 'CyM_CountryDialCode', 'concat("+",trim(leading "00" from CyM_CountryDialCode)) as dialcode'])
            ->where(['=', 'CyM_Status', 'A'])
            ->andWhere(['=','cym_globalportalmst_fk',0])
            ->asArray();
        
        $provider = new \yii\data\ActiveDataprovider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['CyM_CountryName_en'=>SORT_ASC]],
            'pagination' => false
        ]);
        
        return $provider->getModels();
    }
}
