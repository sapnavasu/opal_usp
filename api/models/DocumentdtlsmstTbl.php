<?php

namespace app\models;
use yii\data\ActiveDataProvider;

use Yii;

/**
 * This is the model class for table "documentdtlsmst_tbl".
 *
 * @property int $documentdtlsmst_pk
 * @property int $ddm_projectmst_fk reference to projectmst_pk
 * @property string $ddm_documentname_en
 * @property string $ddm_documentname_ar
 * @property string $ddm_documentdesc_en
 * @property string $ddm_documentdesc_ar
 * @property int $ddm_mandatestatus 1-Mandatory, 2-Non Mandatory (Optional)
 * @property int $ddm_status 1-Active, 2-Inactive
 * @property string $ddm_createdon
 * @property int $ddm_createdby
 * @property string $ddm_updatedon
 * @property int $ddm_updatedby
 *
 * @property AppdocsubmissionhstyTbl[] $appdocsubmissionhstyTbls
 * @property AppdocsubmissionmainTbl[] $appdocsubmissionmainTbls
 * @property AppdocsubmissiontmpTbl[] $appdocsubmissiontmpTbls
 * @property ProjectmstTbl $ddmProjectmstFk
 */
class DocumentdtlsmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documentdtlsmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ddm_projectmst_fk', 'ddm_documentname_en', 'ddm_documentname_ar', 'ddm_mandatestatus', 'ddm_status', 'ddm_createdby'], 'required'],
            [['ddm_projectmst_fk', 'ddm_mandatestatus', 'ddm_status', 'ddm_createdby', 'ddm_updatedby'], 'integer'],
            [['ddm_documentdesc_en', 'ddm_documentdesc_ar'], 'string'],
            [['ddm_createdon', 'ddm_updatedon'], 'safe'],
            [['ddm_documentname_en', 'ddm_documentname_ar'], 'string', 'max' => 255],
            [['ddm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['ddm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'documentdtlsmst_pk' => 'Documentdtlsmst Pk',
            'ddm_projectmst_fk' => 'Ddm Projectmst Fk',
            'ddm_documentname_en' => 'Ddm Documentname En',
            'ddm_documentname_ar' => 'Ddm Documentname Ar',
            'ddm_documentdesc_en' => 'Ddm Documentdesc En',
            'ddm_documentdesc_ar' => 'Ddm Documentdesc Ar',
            'ddm_mandatestatus' => 'Ddm Mandatestatus',
            'ddm_status' => 'Ddm Status',
            'ddm_createdon' => 'Ddm Createdon',
            'ddm_createdby' => 'Ddm Createdby',
            'ddm_updatedon' => 'Ddm Updatedon',
            'ddm_updatedby' => 'Ddm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissionhstyTbls()
    {
        return $this->hasMany(AppdocsubmissionhstyTbl::className(), ['appdsh_DocumentdtlsMst_FK' => 'documentdtlsmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissionmainTbls()
    {
        return $this->hasMany(AppdocsubmissionmainTbl::className(), ['appdsm_DocumentDtlsMst_FK' => 'documentdtlsmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppdocsubmissiontmpTbls()
    {
        return $this->hasMany(AppdocsubmissiontmpTbl::className(), ['appdst_documentdtlsmst_fk' => 'documentdtlsmst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDdmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'ddm_projectmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return DocumentdtlsmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocumentdtlsmstTblQuery(get_called_class());
    }

    
    public function savedocumentdtls($data){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        
        $details = [
            'ddm_projectmst_fk' => 2,
            'ddm_documentname_en' => $data['docname_en'],
            'ddm_documentname_ar' => $data['docname_ar'],
            'ddm_requestfor' => $data['requestfor'],
            'ddm_standardcoursemst_fk' => $data['standardmstid'],
            'ddm_mandatestatus' => 1,
            'ddm_status' => 1,
            'ddm_createdon' => date('Y-m-d H:i:s'),
            'ddm_createdby' => $userPk
        ];
        $course = new DocumentdtlsmstTbl($details);
        if($course->save()){
            
        }else{
            echo "<pre>";
            print_r($course->getErrors());
            die;
        }
        return 1;
    }

    
    public function editdocumentdtls($data)
    {
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $transaction = Yii::$app->db->beginTransaction();

        $document = DocumentdtlsmstTbl::findOne($data['id']);


        $dochis =  [
            'ddmh_documentdtlsmst_fk' => $document->documentdtlsmst_pk,
            'ddmh_projectmst_fk' => $document->ddm_projectmst_fk,
            'ddmh_standardcoursemst_fk' => $document->ddm_standardcoursemst_fk,
            'ddmh_requestfor' => $document->ddm_requestfor,
            'ddmh_documentname_en' => $document->ddm_documentname_en,
            'ddmh_documentname_ar' => $document->ddm_documentname_ar,
            'ddmh_documentdesc_en' => $document->ddm_documentdesc_en,
            'ddmh_documentdesc_ar' => $document->ddm_documentdesc_ar,
            'ddmh_mandatestatus' => $document->ddm_mandatestatus,
            'ddmh_status' => $document->ddm_status,
            'ddmh_createdon' => $document->ddm_createdon,
            'ddmh_createdby' => $document->ddm_createdby,
            'ddmh_updatedon' => $document->ddm_updatedon,
            'ddmh_updatedby' => $document->ddm_updatedby
        ];

        $dochistory = new \app\models\DocumentdtlsmsthstyTbl($dochis);

        if ($dochistory->save()) {
            $document->ddm_documentname_en = $data['docname_en'];
            $document->ddm_documentname_ar = $data['docname_ar'];
            $document->ddm_requestfor = $data['requestfor'];
            $document->ddm_standardcoursemst_fk = $data['standardmstid'];
            $document->ddm_updatedon = date('Y-m-d H:i:s');
            $document->ddm_updatedby = $userPk;
            if ($document->save()) {
                $transaction->commit();
            } else {
                $transaction->rollBack();
                echo "<pre>";
                print_r($document->getErrors());
                die; 
            }
        } else {
            $transaction->rollBack();
            echo "<pre>";
            print_r($dochistory->getErrors());
            die; 
        }
        return 1;

    }
    public function getdocumentdtls($id, $limit, $index, $searchkey,$sort) {

        $courses = DocumentdtlsmstTbl::find()
            ->select(['documentdtlsmst_pk as id','RMM.rm_name_en as requestfor', 'ddm_documentname_en as docname_en', 'ddm_documentname_ar as docname_ar', 'ddm_status as status', 'ddm_createdon as createdOn', 'OU.oum_firstname as createdBy', 'ddm_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy'])
            ->leftJoin('referencemst_tbl as RMM', 'RMM.referencemst_pk = ddm_requestfor')
            ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = ddm_createdby')
            ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = ddm_updatedby')
            ->where(['ddm_standardcoursemst_fk' => $id]);

        if (!empty($searchkey['requestfor'])) {
            $courses->andWhere(['IN', 'ddm_requestfor', $searchkey['requestfor']]);
        }
        if (!empty($searchkey['docname_en'])) {
            $courses->andWhere(['Like', 'ddm_documentname_en', $searchkey['docname_en']]);
        }
        if (!empty($searchkey['docname_ar'])) {
            $courses->andWhere(['Like', 'ddm_documentname_ar', $searchkey['docname_ar']]);
        }
        if (!empty($searchkey['status'])) {
            $courses->andWhere(['IN', 'ddm_status', $searchkey['status']]);
        }
        if (!empty($searchkey['createdOn'])) {
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
            $courses->andWhere('ddm_createdon between "'.$stDate.'" and "'.$edDate.'"'); 
            //$courses->andWhere('ddm_createdon between "'.$searchkey['createdOn']['start'].'" and "'.$searchkey['createdOn']['end'].'"');   
        }
        if (!empty($searchkey['createdBy'])) {
            $courses->andWhere(['Like', 'OU.oum_firstname', $searchkey['createdBy']]);
        }
        if (!empty($searchkey['lastUpdatedOn'])) {
            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59"; 
            $courses->andWhere('ddm_updatedon between "'.$stDate.'" and "'.$edDate.'"'); 

            //$courses->andWhere('ddm_updatedon between "'.$searchkey['lastUpdatedOn']['start'].'" and "'.$searchkey['lastUpdatedOn']['end'].'"');   
        }
        if (!empty($searchkey['lastUpdatedBy'])) {
            $courses->andWhere(['Like', 'OUU.oum_firstname', $searchkey['lastUpdatedBy']]);
        }
        if(!empty($sort)){
            if($sort['key'] == 'requestfor'){
                $courses->orderby('ddm_requestfor '.$sort['dir']);
            }
            if($sort['key'] == 'docname_en'){
                $courses->orderby('ddm_documentname_en '.$sort['dir']);
            }
            if($sort['key'] == 'docname_ar'){
                $courses->orderby('ddm_documentname_ar '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $courses->orderby('ddm_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $courses->orderby('ddm_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $courses->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $courses->orderby('ddm_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $courses->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $courses->orderby('ddm_createdon desc');
         }
        $courses->asArray();
        $dataProvider = new ActiveDataProvider([
            'query' => $courses,
            'pagination' => [
            'pageSize' =>$limit,
            'page'=>$index
            ]
        ]);
        
        $card = $dataProvider->getModels();

        $recodsset =[];
        $recodsset['courses'] = $card;
        $recodsset['pagesize'] = $limit;
        $recodsset['totalcount'] = $dataProvider->getTotalCount();

        return $recodsset;
    }

    public function changedocumentstatus($data)
    {
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $requestfor = '';

        $course = self::findOne($data['id']);
        $course->ddm_status = $data['status'];
        $course->ddm_updatedon = date('Y-m-d H:i:s');
        $course->ddm_updatedby = $userPk;

        if ($course->save()) {

        } else {
            echo "<pre>";
            print_r($course->getErrors());
            die; 
        }
            return 1;

    }


}

