<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\FeeSubscriptionmstTbl;
use app\models\FeesubscriptionmsthstyTbl;

/**
 * This is the model class for table "standardcoursedtls_tbl".
 *
 * @property int $standardcoursedtls_pk primary key
 * @property int $scd_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $scd_subcoursecategorymst_fk Reference to coursecategorymst_pk
 * @property int $scd_onjobtraining 1-Yes, 2-No, by default 2
 * @property int $scd_printfinalpermitcard 1-Yes, 2-No, If scd_onjobtraining=2 then 1 else 2
 * @property int $scd_limitoflearner 1-Yes, 2-No, by default 2
 * @property int $scd_isthyclass 1-Yes, 2-No, by default 2
 * @property int $scd_thyclasslimit if scd_isthyclass = 1, then NOTNULL else NULL
 * @property int $scd_ispratclass 1-Yes, 2-No, by default 2
 * @property int $scd_practclasslimit if scd_ispractclass = 1, then NOTNULL else NULL
 * @property int $scd_asmtbatchlimit if NULL then batch limit is no, if != NULL then batch limit is Yes
 * @property int $scd_hasagelimit 1-Yes, 2-No, by default 2
 * @property int $scd_agelimit if NULL then no age limit, if != NULL then age limit is Yes
 * @property string $scd_prerequesit Reference to standardcoursedtls_pk, separated by comma
 * @property int $scd_iscertexpiry 1-Yes certificate has expiry, 2-No does not have expiry, by default 2
 * @property int $scd_iscertexpirybasedonmarks 1-Yes based on marks, 2-No not based on marks, by default 2
 * @property array $scd_markpercent insert expiry based on mark in JSON format [{min:95, max:100, expinmonth:36},{min:86, max:94, expinmonth:30},{min:67, max:85, expinmonth:24} ]
 * @property int $scd_certexpiryinmonths Not null when scd_iscertexpiry=1
 * @property int $scd_isknwlasmt 1-Yes couse have knowledge assessment, 2-No couse do not have knowledge assessment, by default 2
 * @property int $scd_minmarkfrknwlasmt Not null when scd_isknwlasmt=1
 * @property int $scd_ispratasmt 1-Yes couse have practical assessment, 2-No couse do not have practical assessment, by default 2
 * @property int $scd_ispartasmtmark 1-Yes couse have practical assessment based on grade/mark, 2-No couse do not have practical assessment based on grade/mark, by default 2
 * @property int $scd_partasmtminmark Not null when scd_ispartasmtmark=1
 *
 * @property AssessmentmstTbl[] $assessmentmstTbls
 * @property BatchmgmtdtlsTbl[] $batchmgmtdtlsTbls
 * @property BatchmgmthstyTbl[] $batchmgmthstyTbls
 * @property FeedbackmstTbl[] $feedbackmstTbls
 * @property StandardcoursemstTbl $scdStandardcoursemstFk
 * @property CoursecategorymstTbl $scdSubcoursecategorymstFk
 */
class StandardcoursedtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'standardcoursedtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scd_standardcoursemst_fk', 'scd_subcoursecategorymst_fk', 'scd_printfinalpermitcard'], 'required'],
            [['scd_standardcoursemst_fk', 'scd_subcoursecategorymst_fk', 'scd_onjobtraining', 'scd_printfinalpermitcard', 'scd_limitoflearner', 'scd_isthyclass', 'scd_thyclasslimit', 'scd_ispratclass', 'scd_practclasslimit', 'scd_asmtbatchlimit', 'scd_hasagelimit', 'scd_agelimit', 'scd_iscertexpiry', 'scd_iscertexpirybasedonmarks', 'scd_certexpiryinmonths', 'scd_isknwlasmt', 'scd_minmarkfrknwlasmt', 'scd_ispratasmt', 'scd_ispartasmtmark', 'scd_partasmtminmark'], 'integer'],
            [['scd_prerequesit'], 'string'],
            [['scd_markpercent'], 'safe'],
            [['scd_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['scd_standardcoursemst_fk' => 'standardcoursemst_pk']],
            [['scd_subcoursecategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => CoursecategorymstTbl::className(), 'targetAttribute' => ['scd_subcoursecategorymst_fk' => 'coursecategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'standardcoursedtls_pk' => 'Standardcoursedtls Pk',
            'scd_standardcoursemst_fk' => 'Scd Standardcoursemst Fk',
            'scd_subcoursecategorymst_fk' => 'Scd Subcoursecategorymst Fk',
            'scd_onjobtraining' => 'Scd Onjobtraining',
            'scd_printfinalpermitcard' => 'Scd Printfinalpermitcard',
            'scd_limitoflearner' => 'Scd Limitoflearner',
            'scd_isthyclass' => 'Scd Isthyclass',
            'scd_thyclasslimit' => 'Scd Thyclasslimit',
            'scd_ispratclass' => 'Scd Ispratclass',
            'scd_practclasslimit' => 'Scd Practclasslimit',
            'scd_asmtbatchlimit' => 'Scd Asmtbatchlimit',
            'scd_hasagelimit' => 'Scd Hasagelimit',
            'scd_agelimit' => 'Scd Agelimit',
            'scd_prerequesit' => 'Scd Prerequesit',
            'scd_iscertexpiry' => 'Scd Iscertexpiry',
            'scd_iscertexpirybasedonmarks' => 'Scd Iscertexpirybasedonmarks',
            'scd_markpercent' => 'Scd Markpercent',
            'scd_certexpiryinmonths' => 'Scd Certexpiryinmonths',
            'scd_isknwlasmt' => 'Scd Isknwlasmt',
            'scd_minmarkfrknwlasmt' => 'Scd Minmarkfrknwlasmt',
            'scd_ispratasmt' => 'Scd Ispratasmt',
            'scd_ispartasmtmark' => 'Scd Ispartasmtmark',
            'scd_partasmtminmark' => 'Scd Partasmtminmark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssessmentmstTbls()
    {
        return $this->hasMany(AssessmentmstTbl::className(), ['asmtm_standardcoursedtls_FK' => 'standardcoursedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmtdtlsTbls()
    {
        return $this->hasMany(BatchmgmtdtlsTbl::className(), ['bmd_standardcoursedtls_fk' => 'standardcoursedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBatchmgmthstyTbls()
    {
        return $this->hasMany(BatchmgmthstyTbl::className(), ['bmh_standardcoursedtls_fk' => 'standardcoursedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbackmstTbls()
    {
        return $this->hasMany(FeedbackmstTbl::className(), ['fdbkm_StandardCourseDtls_FK' => 'standardcoursedtls_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScdStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'scd_standardcoursemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScdSubcoursecategorymstFk()
    {
        return $this->hasOne(CoursecategorymstTbl::className(), ['coursecategorymst_pk' => 'scd_subcoursecategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StandardcoursedtlsTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StandardcoursedtlsTblQuery(get_called_class());
    }
    
    public static function getCourseDtlsbysubcatpk($subcatpk)
    {
        
        
        $model = StandardcoursedtlsTbl::find()
                ->select(['standardcoursedtls_pk as pk','scd_thyclasslimit as thyclasslimit','scd_practclasslimit as practclasslimit','scd_asmtbatchlimit as asmtbatchlimit','scd_subcoursecategorymst_fk','scm_assessmentin','scd_ispratclassrefresher as isrefresherpract','scd_iscertexpiry as iscertexpiry'])
                ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = scd_standardcoursemst_fk')
                ->where(['=', 'scd_subcoursecategorymst_fk',$subcatpk ])
                ->asArray()
                ->one();
        
        if($model['iscertexpiry'] == 2)
        {
            $batchlist = ReferencemstTbl::getMastersListByTypePk(9, [25]);
        }
        else
        {
            $batchlist = ReferencemstTbl::getMastersListByTypePk(9);
        }
        
        $model['batchtypelist'] = $batchlist;

        return $model;
        
    } 

    public static function isExist($id)
    {
        return StandardcoursedtlsTbl::find()->where(['=','scd_subcoursecategorymst_fk',$id])->one();
    }

    public static function existingSubcategory($id)
    {
        return StandardcoursedtlsTbl::find()->where(['=','scd_subcoursecategorymst_fk',$id])->asArry()->all();
    }

    public function savecoursedtls($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $scourse = StandardcoursemstTbl::find()->where(['=','standardcoursemst_pk',$data['courseId']])->andwhere(['=','scm_status',3])->one();
        if($scourse){
            $scourse->scm_status = 1;
            $scourse->scm_updatedon = date('Y-m-d H:i:s');
            $scourse->scm_updatedby = $userPk;
    
            if ($scourse->save()) {
    
            } else {
                echo "<pre>";
                $transaction->rollBack();
                print_r($scourse->getErrors());
                die; 
            }

        }
        $prerequesit = null;
        foreach($data['prerequesit'] as $key => $item){
            if((count($data['prerequesit'])-1) == $key ){
                $prerequesit .= $item; 
            }else{

                $prerequesit .= $item .',';
            }
        }
        $details = [
            'scd_standardcoursemst_fk' => $data['courseId'],
            'scd_subcoursecategorymst_fk' => $data['subcourse'],
            'scd_onjobtraining' => $data['onjobtraining'],
            'scd_printfinalpermitcard' => $data['printfinalpermitcard'],
            'scd_limitoflearner' => $data['limitoflearner'],
            'scd_isthyclass' => $data['isthyclass'],
            'scd_thyclasslimit' => $data['thyclasslimit'],
            'scd_ispratclass' => $data['ispratclass'],
            'scd_practclasslimit' => $data['practclasslimit'],
            'scd_asmtbatchlimit' => $data['asmtbatchlimit'],
            'scd_ispratclassrefresher' => $data['ispratclassrefresher'],
            'scd_hasagelimit' => $data['hasagelimit'],
            'scd_agelimit' => $data['agelimit'],
            'scd_prerequesit' => $prerequesit,
            'scd_iscertexpiry' => $data['iscertexpiry'],
            'scd_iscertexpirybasedonmarks' => $data['iscertexpirybasedonmarks'],
            'scd_markpercent' => $data['markpercent'],
            'scd_certexpiryinmonths' => $data['certexpiryinmonths'],
            'scd_isknwlasmt' => $data['isknwlasmt'],
            'scd_minmarkfrknwlasmt' => $data['minmarkfrknwlasmt'],
            'scd_totalmarkfrknwlasmt' => $data['totalmarkfrknwlasmt'],
            'scd_ispratasmt' => $data['ispratasmt'],
            'scd_ispartasmtmark' => $data['ispartasmtmark'],
            'scd_partasmtminmark' => $data['partasmtminmark'],
            'scd_partasmttotalmark' => $data['partasmttotalmark'],
            'scd_status'=>1,
            'scd_createdon' => date('Y-m-d H:i:s'),
            'scd_createdby' => $userPk,
        ];
        $course = new StandardcoursedtlsTbl($details);
        if($course->save()){

            $details = [
                'sccm_coursetype' => 1,
                'sccm_standardcoursedtls_fk' => $course->standardcoursedtls_pk,
                'sccm_coursecategorymst_fk' => $data['subcourse'],
                'sccm_trainer' => $data['tutorlimit'],
                'sccm_assessor' => $data['assessorlimit'],
                'sccm_trainerandassessor' => $data['tutor_assessorlimt'],
                'sccm_programmanager' => $data['pmlimit'],
                'sccm_status' => 1,
                'sccm_createdon' => date('Y-m-d H:i:s'),
                'sccm_createdby' => $userPk,
                ];
                $staff = new \app\models\StaffcourseconfigmstTbl($details);
                if($staff->save()){
                    $arr_add = [];
                    array_push($arr_add, self::feedetails($data['courseId'],$course->standardcoursedtls_pk,4,1,$data['inti_ltf']));
                    array_push($arr_add, self::feedetails($data['courseId'],$course->standardcoursedtls_pk,4,4,$data['ref_ltf']));
                    array_push($arr_add, self::feedetails($data['courseId'],$course->standardcoursedtls_pk,5,1,$data['inti_laf']));
                    array_push($arr_add, self::feedetails($data['courseId'],$course->standardcoursedtls_pk,5,4,$data['ref_laf']));
                    foreach($arr_add as $item){
                        if ($item->save()) {
                            
                        } else {
                            echo "<pre>";
                            $transaction->rollBack();
                            print_r($item->getErrors());
                            die; 
                        }
                    }
                    $transaction->commit();
                }else{
                    $transaction->rollBack();
                    echo "<pre>";
                    print_r($staff->getErrors());
                    die;
                }
                return 1;
            
        }else{
            $transaction->rollBack();
            echo "<pre>";
            print_r($course->getErrors());
            die;
        }
    }

    public function feedetails($courseid,$subcourseid,$feetype,$apptype,$fee){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $data =  [
            'fsm_projectmst_fk' => 2,
            'fsm_standardcoursemst_fk'=>$courseid,
            'fsm_standardcoursedtls_fk'=> $subcourseid,
            'fsm_feestype' => $feetype,
            'fsm_rolemst_fk' => null,
            'fsm_fee'=>$fee,
            'fsm_officetype'=>0,
            'fsm_applicationtype'=> $apptype,
            'fsm_status' => 1,
            'fsm_createdon' => date('Y-m-d H:i:s'),
            'fsm_createdby' => $userPk,
        ];
        $fee = new FeeSubscriptionmstTbl($data);
        return $fee;
    }
   
    public function editcoursedtls($data)
    {
        $transaction = Yii::$app->db->beginTransaction();
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);

        $prerequesit = null;
        foreach($data['prerequesit'] as $key => $item){
            if((count($data['prerequesit'])-1) == $key ){
                $prerequesit .= $item; 
            }else{

                $prerequesit .= $item .',';
            }
        }
        $course = StandardcoursedtlsTbl::findOne($data['subid']);

        $hisdata = [
            'scdh_standardcoursedtls_fk' => $course->standardcoursedtls_pk,
            'scdh_standardcoursemst_fk' => $course->scd_standardcoursemst_fk,
            'scdh_subcoursecategorymst_fk' => $course->scd_subcoursecategorymst_fk,
            'scdh_onjobtraining' => $course->scd_onjobtraining,
            'scdh_printfinalpermitcard' => $course->scd_printfinalpermitcard,
            'scdh_limitoflearner' => $course->scd_limitoflearner,
            'scdh_isthyclass' => $course->scd_isthyclass,
            'scdh_thyclasslimit' => $course->scd_thyclasslimit,
            'scdh_ispratclass' => $course->scd_ispratclass,
            'scdh_ispratclassrefresher' => $course->scd_ispratclassrefresher,
            'scdh_practclasslimit' => $course->scd_practclasslimit,
            'scdh_asmtbatchlimit' => $course->scd_asmtbatchlimit,
            'scdh_hasagelimit' => $course->scd_hasagelimit,
            'scdh_agelimit' => $course->scd_agelimit,
            'scdh_prerequesit' => $course->scd_prerequesit,
            'scdh_iscertexpiry' => $course->scd_iscertexpiry,
            'scdh_iscertexpirybasedonmarks' => $course->scd_iscertexpirybasedonmarks,
            'scdh_markpercent' => $course->scd_markpercent,
            'scdh_certexpiryinmonths' => $course->scd_certexpiryinmonths,
            'scdh_isknwlasmt' => $course->scd_isknwlasmt,
            'scdh_minmarkfrknwlasmt' => $course->scd_minmarkfrknwlasmt,
            'scdh_totalmarkfrknwlasmt' => $course->scd_totalmarkfrknwlasmt,
            'scdh_ispratasmt' => $course->scd_ispratasmt,
            'scdh_ispartasmtmark' => $course->scd_ispartasmtmark,
            'scdh_partasmtminmark' => $course->scd_partasmtminmark,
            'scdh_partasmttotalmark' => $course->scd_partasmttotalmark,
            'scdh_status' => $course->scd_status,
            'scdh_createdon' => $course->scd_createdon,
            'scdh_createdby' => $course->scd_createdby,
            'scdh_updatedon' => $course->scd_updatedon,
            'scdh_updatedby' => $course->scd_updatedby,
        ];

        $history = new \app\models\StandardcoursedtlshstyTbl($hisdata);

        if ($history->save()) {
            
            $course->scd_standardcoursemst_fk = $data['courseId'];
            $course->scd_subcoursecategorymst_fk = $data['subcourse'];
            $course->scd_onjobtraining = $data['onjobtraining'];
            $course->scd_printfinalpermitcard = $data['printfinalpermitcard'];
            $course->scd_limitoflearner = $data['limitoflearner'];
            $course->scd_isthyclass = $data['isthyclass'];
            $course->scd_thyclasslimit = $data['thyclasslimit'];
            $course->scd_ispratclass = $data['ispratclass'];
            $course->scd_practclasslimit = $data['practclasslimit'];
            $course->scd_asmtbatchlimit = $data['asmtbatchlimit'];
            $course->scd_ispratclassrefresher = $data['ispratclassrefresher'];
            $course->scd_hasagelimit = $data['hasagelimit'];
            $course->scd_agelimit = $data['agelimit'];
            $course->scd_prerequesit = $prerequesit;            ;
            $course->scd_iscertexpiry = $data['iscertexpiry'];
            $course->scd_markpercent = $data['markpercent'];
            $course->scd_certexpiryinmonths = $data['certexpiryinmonths'];
            $course->scd_isknwlasmt = $data['isknwlasmt'];
            $course->scd_minmarkfrknwlasmt = $data['minmarkfrknwlasmt'];
            $course->scd_totalmarkfrknwlasmt = $data['totalmarkfrknwlasmt'];
            $course->scd_ispratasmt = $data['ispratasmt'];
            $course->scd_ispartasmtmark = $data['ispartasmtmark'];
            $course->scd_partasmtminmark = $data['partasmtminmark'];
            $course->scd_partasmttotalmark = $data['partasmttotalmark'];
            $course->scd_updatedon = date('Y-m-d H:i:s');
            $course->scd_updatedby = $userPk;
        
            if ($course->save()) {

                $staff = \app\models\StaffcourseconfigmstTbl::find()->where(['=','sccm_standardcoursedtls_fk', $data['subid']])->one();

                $stafhisdata = [
                    'sccmh_staffcourseconfigmst_fk' => $staff->staffcourseconfigmst_pk,
                    'sccmh_coursetype' => $staff->sccm_coursetype,
                    'sccmh_standardcoursedtls_fk' => $staff->sccm_standardcoursedtls_fk,
                    'sccmh_coursecategorymst_fk' => $staff->sccm_coursecategorymst_fk,
                    'sccmh_trainer' => $staff->sccm_trainer,
                    'sccmh_assessor' => $staff->sccm_assessor,
                    'sccmh_trainerandassessor' => $staff->sccm_trainerandassessor,
                    'sccmh_programmanager' => $staff->sccm_programmanager,
                    'sccmh_status' => $staff->sccm_status,
                    'sccmh_createdon' => $staff->sccm_createdon,
                    'sccmh_createdby' => $staff->sccm_createdby,
                    'sccmh_updatedon' => $staff->sccm_updatedon,
                    'sccmh_updatedby' => $staff->sccm_updatedby,
                ];

                $staffHistory = new \app\models\StaffcourseconfigmsthstyTbl($stafhisdata);

                if ($staffHistory->save()) {
                    $staff->sccm_standardcoursedtls_fk = $data['subid'];
                    $staff->sccm_coursecategorymst_fk = $data['subcourse'];
                    $staff->sccm_trainer = $data['tutorlimit'];
                    $staff->sccm_assessor = $data['assessorlimit'];
                    $staff->sccm_programmanager = $data['pmlimit'];
                    $staff->sccm_updatedon = date('Y-m-d H:i:s');
                    $staff->sccm_updatedby = $userPk;
                    if ($staff->save()) {
                        $arr_upd = [];
                        $arr_his = [];
                        $init_ltf = self::updatefeedata($data['courseId'],$data['subid'],4,1,$data['inti_ltf']);
                        $init_ltf['update'] ? array_push($arr_upd,$init_ltf['update']) : '';
                        $init_ltf['history'] ? array_push($arr_his,$init_ltf['history']) : '';

                        $init_laf = self::updatefeedata($data['courseId'],$data['subid'],5,1,$data['inti_laf']);
                        $init_laf['update'] ? array_push($arr_upd,$init_laf['update']) : null;
                        $init_laf['history'] ? array_push($arr_his,$init_laf['history']) : '';

                        $ref_ltf = self::updatefeedata($data['courseId'],$data['subid'],4,4,$data['ref_ltf']);
                        $ref_ltf['update'] ? array_push($arr_upd,$ref_ltf['update']) : '';
                        $ref_ltf['history'] ? array_push($arr_his,$ref_ltf['history']) : '';

                        $ref_laf = self::updatefeedata($data['courseId'],$data['subid'],5,4,$data['ref_laf']);
                        $ref_laf['update'] ? array_push($arr_upd,$ref_laf['update']) : '';
                        $ref_laf['history'] ? array_push($arr_his,$ref_laf['history']) : '';

                        foreach($arr_upd as $item){
                            if ($item->save()) {
                                
                            } else {
                                echo "<pre>";
                                $transaction->rollBack();
                                print_r($item->getErrors());
                                die; 
                            }
                        }
                        foreach($arr_his as $item){
                            if ($item->save()) {
                                
                            } else {
                                echo "<pre>";
                                $transaction->rollBack();
                                print_r($item->getErrors());
                                die; 
                            }
                        }


                        $transaction->commit();
                        return 1;
                    } else {
                        $transaction->rollBack();
                        echo "<pre>1";
                        print_r($staff->getErrors());
                        die;
                    }
                } else {
                    $transaction->rollBack();
                    echo "<pre>1";
                    print_r($staffHistory->getErrors());
                    die;
                }

            } else {
                $transaction->rollBack();
                echo "<pre>2";
                print_r($course->getErrors());
                die;
            }
        } else {
            $transaction->rollBack();
            echo "<pre>1";
            print_r($history->getErrors());
            die;
        }
    
    }

    public function updatefeedata($courseid,$subcourseid,$feetype,$apptype,$fee){
        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $feedata = FeeSubscriptionmstTbl::find()
            ->where(['=','fsm_standardcoursemst_fk',$courseid])
            ->andwhere(['=','fsm_standardcoursedtls_fk',$subcourseid])
            ->andwhere(['=','fsm_feestype',$feetype])
            ->andwhere(['=','fsm_applicationtype',$apptype])
            ->one();

        if($feedata){
            if(round($feedata->fsm_fee) != $fee){
                $fee_his =  [
                    'fsmh_feesubscriptionmst_fk' => $feedata->feesubscriptionmst_pk,
                    'fsmh_projectmst_fk' => $feedata->fsm_projectmst_fk,
                    'fsmh_standardcoursemst_fk' => $feedata->fsm_standardcoursemst_fk,
                    'fsmh_standardcoursedtls_fk' => $feedata->fsm_standardcoursedtls_fk,
                    'fsmh_officetype' => $feedata->fsm_officetype,
                    'fsmh_feestype' => $feedata->fsm_feestype,
                    'fsmh_rolemst_fk' => $feedata->fsm_rolemst_fk,
                    'fsmh_applicationtype' => $feedata->fsm_applicationtype,
                    'fsmh_headcount' => $feedata->fsm_headcount,
                    'fsmh_fee' => $feedata->fsm_fee,
                    'fsmh_validityinyrs' => $feedata->fsm_validityinyrs,
                    'fsmh_status' => $feedata->fsm_status,
                    'fsmh_createdon' => $feedata->fsm_createdon,
                    'fsmh_createdby' => $feedata->fsm_createdby,
                    'fsmh_updatedon' => $feedata->fsm_updatedon,
                    'fsmh_updatedby' => $feedata->fsm_updatedby,
                ];
                $feehistory = new FeesubscriptionmsthstyTbl($fee_his);
               
                $feedata->fsm_fee  = $fee;
                $feedata->fsm_updatedon  = date('Y-m-d H:i:s');
                $feedata->fsm_updatedby  = $userPk;
                $data = [
                    'update' => $feedata,
                    'history' => $feehistory
                ];
                return $data;
            }else{
                $data = [
                    'update' => null,
                    'history' => null
                ];
                return $data;
            }
        }else{
            $data = [
                'update' => self::feedetails($courseid,$subcourseid,$feetype,$apptype,$fee),
                'history' => null
            ];
            return $data;
        }
    }

    public function getsubstandardcoursedtls($id)
    {
        $course =  StandardcoursedtlsTbl::find()
                ->select(['*','staffcourseconfigmst_tbl.*', 'cc.ccm_catname_en'])
                ->leftJoin('staffcourseconfigmst_tbl', 'sccm_standardcoursedtls_fk = standardcoursedtls_pk')
                ->leftJoin('coursecategorymst_tbl as CC', 'CC.coursecategorymst_pk = scd_subcoursecategorymst_fk')
                ->where(['=','standardcoursedtls_pk',$id])
                ->asArray()
                ->one();
               
        $fee = FeeSubscriptionmstTbl::find()->where(['=','fsm_standardcoursemst_fk',$course['scd_standardcoursemst_fk']])->andwhere(['=','fsm_standardcoursedtls_fk',$id])->asArray()->all();
        $data = [
            'course'=> $course,
            'fee'=> $fee
        ];
        return $data;
    }
    
    public function getsubstandardcourse($id, $limit, $index, $searchkey, $sort)
    {
        $query = self::find()
            ->select(['standardcoursedtls_pk as id','ccm_catname_en as coursesubcategory','scd_printfinalpermitcard as isprint', 'scd_thyclasslimit as thyclasslimit', 'scd_practclasslimit as praclasslimit', 'scd_asmtbatchlimit as asclasslimit', 'scd_status as status', 'scd_createdon as createdOn', 'OU.oum_firstname as createdBy', 'scd_updatedon as lastUpdatedOn', 'OUU.oum_firstname as lastUpdatedBy'])
            ->leftJoin('coursecategorymst_tbl as CCMM', 'CCMM.coursecategorymst_pk = scd_subcoursecategorymst_fk')
            ->leftJoin('standardcoursemst_tbl as SCM', 'SCM.standardcoursemst_pk = scd_standardcoursemst_fk')
            ->leftJoin('opalusermst_tbl as OUU', 'OUU.opalusermst_pk = scd_updatedby')
            ->leftJoin('opalusermst_tbl as OU', 'OU.opalusermst_pk = scd_createdby')
            ->where(['scd_standardcoursemst_fk' => $id]);
    
        if (!empty($searchkey['coursesubcategory'])) {
            $query->andWhere([ 'IN','scd_subcoursecategorymst_fk', $searchkey['coursesubcategory']]);
        }
        if (!empty($searchkey['isprint'])) {
            $query->andWhere(['IN', 'scd_printfinalpermitcard', $searchkey['isprint']]);
        }
        if (!empty($searchkey['thyclasslimit'])) {
            $query->andWhere(['=','scd_thyclasslimit', $searchkey['thyclasslimit']]);
        }
        if (!empty($searchkey['praclasslimit'])) {
            $query->andWhere(['=','scd_practclasslimit' , $searchkey['praclasslimit']]);
        }
        if (!empty($searchkey['asclasslimit'])) {
            $query->andWhere(['=','scd_asmtbatchlimit', $searchkey['asclasslimit']]);
        }
        if (!empty($searchkey['status'])) {
            $query->andWhere(['=','scd_status', $searchkey['status']]);
        }
        if(!empty($searchkey['createdOn'])){
            $stDate = date("Y-m-d",strtotime($searchkey['createdOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['createdOn']['end']))." 23:59:59"; 
            $query->andWhere('scd_createdon between "'.$stDate.'" and "'.$edDate.'"'); 
            //$query->andWhere('scd_createdon between "'.$searchkey['createdOn']['start'].'" and "'.$searchkey['createdOn']['end'].'"');   
         }
        if (!empty($searchkey['createdBy'])) {
            $query->andWhere(['=','scd_createdby', $searchkey['createdBy']]);
        }
        if(!empty($searchkey['lastUpdatedOn'])){

            $stDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['start']))." 00:00:00";
            $edDate = date("Y-m-d",strtotime($searchkey['lastUpdatedOn']['end']))." 23:59:59"; 
            $query->andWhere('scd_updatedon between "'.$stDate.'" and "'.$edDate.'"'); 
            //$query->andWhere('scd_updatedon between "'.$searchkey['lastUpdatedOn']['start'].'" and "'.$searchkey['lastUpdatedOn']['end'].'"');   
        }
        if (!empty($searchkey['lastUpdatedBy'])) {
            $query->andWhere(['=','scd_createdby', $searchkey['createdBy']]);
        }
        if(!empty($sort)){
            if($sort['key'] == 'coursesubcategory'){
                $query->orderby('ccm_catname_en '.$sort['dir']);
            }
            if($sort['key'] == 'isprint'){
                $query->orderby('scd_printfinalpermitcard '.$sort['dir']);
            }
            if($sort['key'] == 'thyclasslimit'){
                $query->orderby('scd_thyclasslimit '.$sort['dir']);
            }
            if($sort['key'] == 'praclasslimit'){
                $query->orderby('scd_practclasslimit '.$sort['dir']);
            }
            if($sort['key'] == 'asclasslimit'){
                $query->orderby('scd_asmtbatchlimit '.$sort['dir']);
            }
            if($sort['key'] == 'status'){
                $query->orderby('scd_status '.$sort['dir']);
            }
            if($sort['key'] == 'createdOn'){
                $query->orderby('scd_createdon '.$sort['dir']);
            }
            if($sort['key'] == 'createdBy'){
                $query->orderby('OU.oum_firstname '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedOn'){
                $query->orderby('scd_updatedon '.$sort['dir']);
            }
            if($sort['key'] == 'lastUpdatedBy'){
                $query->orderby('OUU.oum_firstname '.$sort['dir']);
            }
         }else{
            $query->orderby('scd_createdon desc');
         }

        $query->asArray();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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

    public function getprereqlist($id)
    {
        return self::find()->select(['standardcoursedtls_pk as id', 'ccm_catname_en as name', 'scd_subcoursecategorymst_fk'])
                ->leftJoin('standardcoursemst_tbl','standardcoursemst_pk = scd_standardcoursemst_fk')
                ->leftJoin('coursecategorymst_tbl','coursecategorymst_pk = scd_subcoursecategorymst_fk')
                ->where(['=', 'standardcoursemst_pk' , $id])->asArray()->all();
    }

    public function changesubcoursestatus($data)
    {
        $userPk = \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $requestfor = '';

        $course = self::findOne($data['id']);
        $course->scd_status = $data['status'];
        $course->scd_updatedon = date('Y-m-d H:i:s');
        $course->scd_updatedby = $userPk;

        if ($course->save()) {

        } else {
            echo "<pre>";
            print_r($course->getErrors());
            die; 
        }
            return 1;

    }

    
}
