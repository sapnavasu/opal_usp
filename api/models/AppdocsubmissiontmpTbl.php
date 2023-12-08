<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appdocsubmissiontmp_tbl".
 *
 * @property int $appdocsubmissiontmp_pk Primary Key
 * @property int $appdst_applicationdtlstmp_fk Reference to applicationdtlstmp_pk
 * @property int $appdst_documentdtlsmst_fk Reference to documentdtlsmst_pk
 * @property int $appdst_submissionstatus 1-Yes, 2-No
 * @property string $appdst_upload
 * @property string $appdst_remarks
 * @property string $appdst_createdon
 * @property int $appdst_createdby
 * @property string $appdst_updatedon
 * @property int $appdst_updatedby
 * @property int $appdst_status 1-Yet to submit. 2-Submitted for Approval, 3-Approved, 4-Declined, 5-updated
 * @property string $appdst_appdecon
 * @property int $appdst_appdecby
 * @property string $appdst_appdeccomment
 *
 * @property ApplicationdtlstmpTbl $appdstApplicationdtlstmpFk
 * @property DocumentdtlsmstTbl $appdstDocumentdtlsmstFk
 */
class AppdocsubmissiontmpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appdocsubmissiontmp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['appdst_applicationdtlstmp_fk', 'appdst_submissionstatus', 'appdst_createdon', 'appdst_createdby', 'appdst_status'], 'required'],
            [['appdst_applicationdtlstmp_fk', 'appdst_documentdtlsmst_fk', 'appdst_submissionstatus', 'appdst_createdby', 'appdst_updatedby', 'appdst_status', 'appdst_appdecby'], 'integer'],
            [['appdst_remarks', 'appdst_appdeccomment'], 'string'],
            [['appdst_createdon', 'appdst_updatedon', 'appdst_appdecon'], 'safe'],
            [['appdst_upload'], 'string', 'max' => 255],
            [['appdst_applicationdtlstmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlstmpTbl::className(), 'targetAttribute' => ['appdst_applicationdtlstmp_fk' => 'applicationdtlstmp_pk']],
            [['appdst_documentdtlsmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentdtlsmstTbl::className(), 'targetAttribute' => ['appdst_documentdtlsmst_fk' => 'documentdtlsmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appdocsubmissiontmp_pk' => 'Appdocsubmissiontmp Pk',
            'appdst_applicationdtlstmp_fk' => 'Appdst Applicationdtlstmp Fk',
            'appdst_documentdtlsmst_fk' => 'Appdst Documentdtlsmst Fk',
            'appdst_submissionstatus' => 'Appdst Submissionstatus',
            'appdst_upload' => 'Appdst Upload',
            'appdst_remarks' => 'Appdst Remarks',
            'appdst_createdon' => 'Appdst Createdon',
            'appdst_createdby' => 'Appdst Createdby',
            'appdst_updatedon' => 'Appdst Updatedon',
            'appdst_updatedby' => 'Appdst Updatedby',
            'appdst_status' => 'Appdst Status',
            'appdst_appdecon' => 'Appdst Appdecon',
            'appdst_appdecby' => 'Appdst Appdecby',
            'appdst_appdeccomment' => 'Appdst Appdeccomment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdstApplicationdtlstmpFk()
    {
        return $this->hasOne(ApplicationdtlstmpTbl::className(), ['applicationdtlstmp_pk' => 'appdst_applicationdtlstmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdstDocumentdtlsmstFk()
    {
        return $this->hasOne(DocumentdtlsmstTbl::className(), ['documentdtlsmst_pk' => 'appdst_documentdtlsmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return AppdocsubmissiontmpTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppdocsubmissiontmpTblQuery(get_called_class());
    }

    public static function getDocument(){
        $requestParam = $_GET;
        ini_set ( 'max_execution_time', 1200);
        $query = self::find();
        $statusFilter = $requestParam['statusFilter'];

         $query->select(['*',
         'DATE_FORMAT(appdst_createdon,"%d-%m-%Y") AS appdst_createdon',
         'DATE_FORMAT(appdst_updatedon,"%d-%m-%Y") AS appdst_updatedon','DATE_FORMAT(appdst_appdecon,"%d-%m-%Y") AS appdst_appdecon' , 'mcfd_filetype']);
         $query->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = appdst_memcompfiledtls_fk');
         $query->leftJoin('documentdtlsmst_tbl  mst','mst.documentdtlsmst_pk = appdst_documentdtlsmst_fk');
         $query->leftJoin('applicationdtlstmp_tbl  appid','appid.applicationdtlstmp_pk = appdst_applicationdtlstmp_fk');
         $query->where([
            'appdst_applicationdtlstmp_fk'=> $requestParam['appid']
        ]);
        if($requestParam['gridsearchValues'] != ''){

            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);  
            
            $documentname= $gridsearchValues['appdst_documentdtlsmst_fk'];
            $submissionstatus= $gridsearchValues['appdst_submissionstatus'];
            $status = $gridsearchValues['appdst_status'];
            $createdon = $gridsearchValues['appdst_createdon'];
            $updatedon = $gridsearchValues['appdst_updatedon'];
        

            if($documentname) //opertsor name filter
    {
            $query->andFilterWhere(['AND',
            ['LIKE', 'ddm_documentname_en', $documentname],
        ]);
    }           

    if($submissionstatus){  // submission Filter
        if(count($submissionstatus) >1){
            $appcond ="";
           if(in_array(1, $submissionstatus)){ //yes
               $appcond .= "appdst_submissionstatus='1' ||";
           }
           if(in_array(2, $submissionstatus)){ //no
            $appcond .= "appdst_submissionstatus='2' ||";
           }
        
           
           $paymentstscond = rtrim($appcond, "||");
           $query->andWhere($paymentstscond);
        }else{
            if(in_array($submissionstatus[0], [1,2])){ //Validation new/updated/Approved/Declined
                $pymt_sts = $submissionstatus[0];
                $query->andWhere("appdst_submissionstatus='$pymt_sts' ");
            }
        }
    }


        if($status){  // Status Filter
            if(count($status) >1){
                $appcond ="";
               if(in_array(1, $status)){ //new
                   $appcond .= "appdst_status='1' ||";
               }
               if(in_array(2, $status)){ //updated
                $appcond .= "appdst_status='2' ||";
               }
               if(in_array(3, $status)){ //Approved
                $appcond .= "appdst_status='3' ||";
               }
               if(in_array(4, $status)){ //Declined
                $appcond .= "appdst_status='4' ||";
               }
               
               $paymentstscond = rtrim($appcond, "||");
               $query->andWhere($paymentstscond);
            }else{
                if(in_array($status[0], [1,2,3,4])){ //Validation new/updated/Approved/Declined
                    $pymt_sts = $status[0];
                    $query->andWhere("appdst_status='$pymt_sts' ");
                }
            }
        }

        



        if($createdon && $createdon['startDate']!=null && $createdon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(appdst_createdon)', date('Y-m-d',strtotime($createdon['startDate'])), date('Y-m-d',strtotime($createdon['endDate']))]);
            }

    
        if($updatedon && $updatedon['startDate']!=null && $updatedon['endDate']!=null)
            {
                $query->andFilterWhere(['between', 'date(appdst_updatedon)', date('Y-m-d',strtotime($updatedon['startDate'])), date('Y-m-d',strtotime($updatedon['endDate']))]);
            }

       $sort_column = 'appdocsubmissiontmp_pk';
           
      // $query = $query->orderBy(['appdocsubmissiontmp_pk'=>'desc']);
       $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];  
       $order_by = ($requestParam['order']=='asc')? SORT_ASC: SORT_DESC;
       $query->orderBy(["$sort_column" => $order_by]);
        $query->asArray();
        // echo '<pre>'; print_r($query); exit;
        // echo 'success'; exit;
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
       $raw = $query->createCommand()->getRawSql();
      

      
     
        $data = $provider->getModels();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
      
        foreach ($provider->getModels() as $key => $favResData) {
         $driveImg  =   \api\components\Drive::generateUrl($favResData['appdst_memcompfiledtls_fk'],$companypk,$userpk);
         $histmodel     =   \app\models\AppdocsubmissionhstyTbl::find()->where("appdsh_AppDocSubmissionTmp_FK =:pk", [':pk' => $favResData['appdocsubmissiontmp_pk']])->orderBy(["appdocsubmissionhsty_pk" => SORT_DESC])->limit(2)->asArray()->all();
         $model     =   \app\models\OpalusermstTbl::find()->where("opalusermst_pk =:pk", [':pk' => $favResData['appdst_appdecby']])->one();
         $favData[$key] = $favResData;
         $favData[$key]['coverImages'] = $driveImg; 
         $favData[$key]['hisstatus'] = $histmodel[1]['appdsh_Status'];
         $favData[$key]['username'] = $model['oum_firstname'];
         $favData[$key]['status'] = ($favResData['appdst_appdeccomment'])?$favResData['appdst_appdeccomment']:'Nil';
         $favData[$key]['appdst_updatedon'] = ($favResData['appdst_updatedon'])?$favResData['appdst_updatedon']:"-";

        }

        $docdata  =  \app\models\AppdocsubmissiontmpTbl::find()->where("appdst_applicationdtlstmp_fk =:pk", [':pk' => $requestParam['appid']])->asArray()->All();
        foreach($docdata as $key => $value){

            $docarray[] = $value['appdst_status'];
        }

        if (count(array_unique($docarray)) === 1) {
            $datastatus=$docarray[0];
          } else {
            if(in_array(3,$docarray)){
                $datastatus=3;

            }
            if(in_array(4,$docarray)){
                $datastatus=4;

            }elseif(in_array(1,$docarray)){
                $datastatus=1;

            }elseif(in_array(2,$docarray)){
                $datastatus=2;

            }
          }

        $response = array();
        $response['data'] = $favData;
        $response['appstatus'] = $datastatus;
        $response['appdt_apptype'] = $favData[0]['appdt_apptype'];
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;
}
}
}
