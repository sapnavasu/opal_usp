<?php

namespace app\models;

use Yii;
use app\models\FeesubscriptionmsthstyTbl;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "feesubscriptionmst_tbl".
 *
 * @property int $feesubscriptionmst_pk primary key
 * @property int $fsm_projectmst_fk Reference to projectmst_pk
 * @property int $fsm_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $fsm_standardcoursedtls_fk Reference to standardcoursedtls_pk
 * @property int $fsm_officetype 1-Main Office,2-Branch Office,3-Both
 * @property int $fsm_feestype 1-Certification Fee,2-Staff Evaluation Fee,3-Royalty Fee,4-Learner Training Fee,5-Learner Assessment Fee, 6-Staff Re-Evaluation Fee
 * @property string $fsm_rolemst_fk Reference to Rolemst_pk
 * @property int $fsm_applicationtype 1-Initial,2-Renewal,3-Update,4-Refresher,5-Surveillance 1, 6-Surveillance 2 by dafault 0
 * @property int $fsm_headcount
 * @property string $fsm_fee
 * @property int $fsm_validityinyrs
 * @property int $fsm_status 1-Active, 2-Inactive, by default 1
 * @property string $fsm_createdon
 * @property int $fsm_createdby
 *
 * @property ApppytminvoicedtlsTbl[] $apppytminvoicedtlsTbls
 * @property ProjectmstTbl $fsmProjectmstFk
 * @property StandardcoursedtlsTbl $fsmStandardcoursedtlsFk
 * @property StandardcoursemstTbl $fsmStandardcoursemstFk
 * @property FeesubscriptionmsthstyTbl[] $feesubscriptionmsthstyTbls
 */
class FeesubscriptionmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feesubscriptionmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fsm_projectmst_fk', 'fsm_officetype', 'fsm_feestype', 'fsm_createdby'], 'required'],
            [['fsm_projectmst_fk', 'fsm_standardcoursemst_fk', 'fsm_standardcoursedtls_fk', 'fsm_officetype', 'fsm_feestype', 'fsm_applicationtype', 'fsm_headcount', 'fsm_validityinyrs', 'fsm_status', 'fsm_createdby'], 'integer'],
            [['fsm_rolemst_fk'], 'string'],
            [['fsm_fee'], 'number'],
            [['fsm_createdon'], 'safe'],
            [['fsm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['fsm_projectmst_fk' => 'projectmst_pk']],
            [['fsm_standardcoursedtls_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursedtlsTbl::className(), 'targetAttribute' => ['fsm_standardcoursedtls_fk' => 'standardcoursedtls_pk']],
            [['fsm_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['fsm_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'feesubscriptionmst_pk' => 'Feesubscriptionmst Pk',
            'fsm_projectmst_fk' => 'Fsm Projectmst Fk',
            'fsm_standardcoursemst_fk' => 'Fsm Standardcoursemst Fk',
            'fsm_standardcoursedtls_fk' => 'Fsm Standardcoursedtls Fk',
            'fsm_officetype' => 'Fsm Officetype',
            'fsm_feestype' => 'Fsm Feestype',
            'fsm_rolemst_fk' => 'Fsm Rolemst Fk',
            'fsm_applicationtype' => 'Fsm Applicationtype',
            'fsm_headcount' => 'Fsm Headcount',
            'fsm_fee' => 'Fsm Fee',
            'fsm_validityinyrs' => 'Fsm Validityinyrs',
            'fsm_status' => 'Fsm Status',
            'fsm_createdon' => 'Fsm Createdon',
            'fsm_createdby' => 'Fsm Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApppytminvoicedtlsTbls()
    {
        return $this->hasMany(ApppytminvoicedtlsTbl::className(), ['apid_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'fsm_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmStandardcoursedtlsFk()
    {
        return $this->hasOne(StandardcoursedtlsTbl::className(), ['standardcoursedtls_pk' => 'fsm_standardcoursedtls_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFsmStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'fsm_standardcoursemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeesubscriptionmsthstyTbls()
    {
        return $this->hasMany(FeesubscriptionmsthstyTbl::className(), ['fsmh_feesubscriptionmst_fk' => 'feesubscriptionmst_pk']);
    }

    /**
     * {@inheritdoc}
     * @return FeesubscriptionmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeesubscriptionmstTblQuery(get_called_class());
    }


    public function getFeesList($limit, $index, $searchkey, $sort){
        $fee = self::find()
         ->select(['P.pm_projectname_en as project_en','P.pm_projectname_ar as project_ar','IF(fsm_officetype = 3, "Both", (IF(fsm_officetype = 1, "Main Office", "Branch Office"))) as officetype', 'fsm_feestype as feetype', 'fsm_applicationtype as applicanttype','fsm_headcount as headcount', 'fsm_fee as fee', 'fsm_validityinyrs as validity','fsm_status as status', 'fsm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'fsm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy','fsm_projectmst_fk as projectmst_fk','feesubscriptionmst_pk as feepk'])
         ->leftJoin('projectmst_tbl as P', 'P.projectmst_pk = fsm_projectmst_fk')
         ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = fsm_createdby')
         ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = fsm_updatedby')
         ->where(['IN', 'fsm_projectmst_fk',[1,4,5]]);
         if(!empty($searchkey['project'])){
            $fee->andWhere(['IN', 'fsm_projectmst_fk', $searchkey['project']]);
         }
         if(!empty($searchkey['officetype'])){
            $fee->andWhere(['IN', 'fsm_officetype', $searchkey['officetype']]);
         }
         if(!empty($searchkey['feetype'])){
            $fee->andwhere(['IN', 'fsm_feestype', $searchkey['feetype']]);
         }
         if(!empty($searchkey['applicanttype'])){
            $fee->andwhere(['IN', 'fsm_applicationtype', $searchkey['applicanttype']]);
         }
         if(!empty($searchkey['headcount'])){
            $fee->andwhere(['IN', 'fsm_headcount', $searchkey['headcount']]);
         }
         if(!empty($searchkey['fee'])){
            $fee->andwhere(['Like', 'fsm_fee', $searchkey['fee']]);
         }
         if(!empty($searchkey['validity'])){
            $fee->andwhere(['Like', 'fsm_validityinyrs', $searchkey['validity']]);
         }
         if(!empty($searchkey['status'])){
            $fee->andwhere(['IN', 'fsm_status', $searchkey['status']]);
         }
         if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
           $fee->andWhere('fsm_createdon between "'.$stDate.'" and "'.$edDate.'"');   
         }
         if(!empty($searchkey['createdBy'])){
            $fee->andwhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
         }
         if(!empty($searchkey['lastUpdatedOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59";
            $fee->andWhere('fsm_updatedon between "'.$stDate.'" and "'.$edDate.'"');  
         }
         if(!empty($searchkey['lastUpdatedBy'])){
            $fee->andwhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
         }
         if(!empty($sort)){
            if($sort['key'] == 'project'){
                $fee->orderby('P.pm_projectname_en '.$sort['dir']);
            }
            if($sort['key'] == 'officetype'){
                $fee->orderby('fsm_officetype '.$sort['dir']);
            }
            if($sort['key'] == 'feetype'){
                $fee->orderby('fsm_feestype '.$sort['dir']);
            }
            if($sort['key'] == 'applicanttype'){
                $fee->orderby('fsm_applicationtype '.$sort['dir']);
            }
            if($sort['key'] == 'headcount'){
                $fee->orderby('fsm_headcount '.$sort['dir']);
            }
            if($sort['key'] == 'fee'){
                $fee->orderby('fsm_fee '.$sort['dir']);
            }
            if($sort['key'] == 'validity'){
                $fee->orderby('fsm_validityinyrs '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $fee->orderby('fsm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $fee->orderby('fsm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $fee->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $fee->orderby('fsm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $fee->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $fee->orderby('fsm_createdon desc');
         }
         
         $fee->asArray();


         $dataProvider = new ActiveDataProvider([
            'query' => $fee,
            'pagination' => [
               'pageSize' =>$limit,
               'page'=>$index
            ]
         ]);
          
         $card = $dataProvider->getModels();
   
         $recodsset =[];
         $recodsset['fee'] = $card;
         $recodsset['pagesize'] = $limit;
         $recodsset['totalcount'] = $dataProvider->getTotalCount();
   
         return $recodsset;
    }

    public function getFeeSubcription($id){
        return self::find()->where(['=','feesubscriptionmst_pk', $id])->one();
    }

    public function editFeeSubcription($data){
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $fee = self::find()->where(['=','feesubscriptionmst_pk', $data['id']])->one();
        

        $feehistory = [
            'fsmh_feesubscriptionmst_fk' => $fee->feesubscriptionmst_pk,
            'fsmh_projectmst_fk' => $fee->fsm_projectmst_fk,
            'fsmh_standardcoursemst_fk' => $fee->fsm_standardcoursemst_fk,
            'fsmh_standardcoursedtls_fk' => $fee->fsm_standardcoursedtls_fk,
            'fsmh_officetype' => $fee->fsm_officetype,
            'fsmh_feestype' => $fee->fsm_feestype,
            'fsmh_rolemst_fk' => $fee->fsm_rolemst_fk,
            'fsmh_applicationtype' => $fee->fsm_applicationtype,
            'fsmh_headcount' => $fee->fsm_headcount,
            'fsmh_fee' => $fee->fsm_fee,
            'fsmh_validityinyrs' => $fee->fsm_validityinyrs,
            'fsmh_status' => $fee->fsm_status,
            'fsmh_createdon' => $fee->fsm_createdon,
            'fsmh_createdby' => $fee->fsm_createdby,
            'fsmh_updatedon' => $fee->fsm_updatedon,
            'fsmh_updatedby' => $fee->fsm_updatedby,
        ];

        $feeshistory = new FeesubscriptionmsthstyTbl($feehistory);
        if($feeshistory->save()){
            $fee->fsm_validityinyrs = $data['validity'];
            $fee->fsm_fee = $data['fee'];
            $fee->fsm_updatedon = date('Y-m-d H:i:s');
            $fee->fsm_updatedby = $userPk;
            if($fee->save()){
                $transaction->commit();
                return $fee;
            }else{
                echo "<pre>";
                $transaction->rollBack();
                print_r($fee->getErrors());
                die;
            }
            
        }else{
            echo "<pre>";
            $transaction->rollBack();
            print_r($feeshistory->getErrors());
            die;
        }
    }
}
