<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffworkexp_tbl".
 *
 * @property int $staffworkexp_pk
 * @property int $sexp_staffinforepo_fk Reference to staffinforepo_pk
 * @property string $sexp_employername
 * @property string $sexp_doj Date of Joining
 * @property int $sexp_currentlyworking 1-Yes, 2-No
 * @property string $sexp_eod date of exit, mandatory if sext_currentlyworking=2
 * @property int $sexp_opalcountrymst_fk Reference to opalcountrymst_pk
 * @property int $sexp_opalstatemst_fk Reference to opalstatemst_pk
 * @property int $sexp_opalcitymst_fk Reference to opalcitymst_pk
 * @property string $sexp_designation
 * @property int $sexp_appcoursedtlsmain_fk Reference to appcoursedtlstmp_pk
 * @property string $sexp_createdon
 * @property int $sexp_createdby
 * @property string $sexp_updatedon
 * @property int $sexp_updatedby
 *
 * @property AppcoursedtlstmpTbl $sexpAppcoursedtlsmainFk
 * @property OpalcitymstTbl $sexpOpalcitymstFk
 * @property OpalcountrymstTbl $sexpOpalcountrymstFk
 * @property OpalstatemstTbl $sexpOpalstatemstFk
 * @property StaffinforepoTbl $sexpStaffinforepoFk
 */
class StaffworkexpTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffworkexp_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sexp_staffinforepo_fk', 'sexp_employername','sexp_opalcountrymst_fk','sexp_designation', 'sexp_createdon', 'sexp_createdby'], 'required'],
            [['sexp_staffinforepo_fk', 'sexp_currentlyworking', 'sexp_opalcountrymst_fk', 'sexp_opalstatemst_fk', 'sexp_opalcitymst_fk', 'sexp_createdby', 'sexp_updatedby'], 'integer'],
            //[['sexp_employername', 'sexp_moheridoc'], 'string'],
            [['sexp_doj', 'sexp_eod', 'sexp_createdon', 'sexp_updatedon'], 'safe'],
            [['sexp_designation'], 'string', 'max' => 200],
            //[['sexp_appcoursedtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppcoursedtlstmpTbl::className(), 'targetAttribute' => ['sexp_appcoursedtlsmain_fk' => 'appcoursedtlstmp_pk']],
            [['sexp_opalcitymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcitymstTbl::className(), 'targetAttribute' => ['sexp_opalcitymst_fk' => 'opalcitymst_pk']],
            [['sexp_opalcountrymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalcountrymstTbl::className(), 'targetAttribute' => ['sexp_opalcountrymst_fk' => 'opalcountrymst_pk']],
            [['sexp_opalstatemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstatemstTbl::className(), 'targetAttribute' => ['sexp_opalstatemst_fk' => 'opalstatemst_pk']],
            [['sexp_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['sexp_staffinforepo_fk' => 'staffinforepo_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffworkexp_pk' => 'Staffworkexp Pk',
            'sexp_staffinforepo_fk' => 'Sexp Staffinforepo Fk',
            'sexp_employername' => 'Sexp Employername',
            'sexp_doj' => 'Sexp Doj',
            'sexp_currentlyworking' => 'Sexp Currentlyworking',
            'sexp_eod' => 'Sexp Eod',
            'sexp_opalcountrymst_fk' => 'Sexp Opalcountrymst Fk',
            'sexp_opalstatemst_fk' => 'Sexp Opalstatemst Fk',
            'sexp_opalcitymst_fk' => 'Sexp Opalcitymst Fk',
            'sexp_designation' => 'Sexp Designation',
            //'sexp_moheridoc' => 'Sexp Moheridoc',
            //'sexp_appcoursedtlsmain_fk' => 'Sexp Appcoursedtlsmain Fk',
            'sexp_createdon' => 'Sexp Createdon',
            'sexp_createdby' => 'Sexp Createdby',
            'sexp_updatedon' => 'Sexp Updatedon',
            'sexp_updatedby' => 'Sexp Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexpAppcoursedtlsmainFk()
    {
        return $this->hasOne(AppcoursedtlstmpTbl::className(), ['appcoursedtlstmp_pk' => 'sexp_appcoursedtlsmain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexpOpalcitymstFk()
    {
        return $this->hasOne(OpalcitymstTbl::className(), ['opalcitymst_pk' => 'sexp_opalcitymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexpOpalcountrymstFk()
    {
        return $this->hasOne(OpalcountrymstTbl::className(), ['opalcountrymst_pk' => 'sexp_opalcountrymst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexpOpalstatemstFk()
    {
        return $this->hasOne(OpalstatemstTbl::className(), ['opalstatemst_pk' => 'sexp_opalstatemst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSexpStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'sexp_staffinforepo_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffworkexpTblQuery the active query used by this AR class.
     */

    public static function find()
    {
        return new StaffworkexpTblQuery(get_called_class());
    }

    public static function getExpList($params)
    {
        return StaffworkexpTbl::find()
                  ->where(["sexp_staffinforepo_fk"=>$params])
                  ->all();
    }

    public static function saveWorkexp($requestdata){
        // echo '<pre>';print_r($requestdata->oragn_name);exit;
            if($requestdata->staffworkexp_pk)
            {
            $modelExp = StaffworkexpTbl::find()->where(["staffworkexp_pk"=>$requestdata->staffworkexp_pk])->one();
            }
            else
            {
            $modelExp = new StaffworkexpTbl();
            }
            $modelExp->sexp_staffinforepo_fk = $requestdata->stafrep_id;  
            $modelExp->sexp_employername = $requestdata->oragn_name;
            $modelExp->sexp_doj = date("Y-m-d", strtotime($requestdata->date_join));
            $curr_work=2;
            if(!empty($requestdata->curr_work)){
                $curr_work = $requestdata->curr_work;
            }
            $modelExp->sexp_currentlyworking = $curr_work;
            $modelExp->sexp_eod = date("Y-m-d", strtotime($requestdata->workdate));
            $modelExp->sexp_opalcountrymst_fk = $requestdata->employ_country;
            $modelExp->sexp_opalstatemst_fk = $requestdata->employ_state;
            $modelExp->sexp_opalcitymst_fk = $requestdata->employ_city;
            $modelExp->sexp_designation = $requestdata->designat;
            //$modelExp->sexp_moheridoc = "test";
            //$modelExp->sexp_appcoursedtlsmain_fk = 1;
            $modelExp->sexp_createdon = date("Y-m-d H:i:s");
            $modelExp->sexp_createdby = $requestdata->sexp_createdby || 1;

            if($modelExp->save()){
                return $modelExp->staffworkexp_pk;
            }else{
                echo "<pre>";var_dump($modelExp->getErrors());exit;
            } 

        }

    public static function fetchFavResult($staffid, $pageSize , $page){
  
        $favQuery = self::find();
        $favQuery->select([
                        '*','TIMESTAMPDIFF(YEAR, sexp_doj, CURDATE())  AS sexp_doj','DATE_FORMAT(sexp_eod,"%d-%m-%Y") AS sexp_eod','DATE_FORMAT(sexp_doj,"%d-%m-%Y") AS sexp_doj',
                    ])
                    ->leftJoin('appstaffinfotmp_tbl  temp','temp.appsit_staffinforepo_fk = sexp_staffinforepo_fk')
                    ->leftJoin('staffinforepo_tbl repo','repo.staffinforepo_pk = sexp_staffinforepo_fk')
                    ->leftJoin('opalcountrymst_tbl country','country.opalcountrymst_pk = sexp_opalcountrymst_fk')
                    ->leftJoin('opalstatemst_tbl state','state.opalstatemst_pk = sexp_opalstatemst_fk')
                    ->leftJoin('opalcitymst_tbl city','city.opalcitymst_pk = sexp_opalcitymst_fk')
                    ->leftJoin('memcompfiledtls_tbl  doc','doc.memcompfiledtls_pk = sexp_profdocupload');
                   
        $favQuery->where([
                        'appostaffinfotmp_pk'=> $staffid,
                    ]);
        $favQry = $favQuery->orderBy(['appostaffinfotmp_pk'=>SORT_DESC])
                    ->asArray();
        $favProvider = new \yii\data\ActiveDataProvider([
            'query' => $favQry,
            'pagination' => [
                                'pageSize' =>$pageSize,
                                'page'=>$page
                            ]
        ]);
    


        $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
        $companyPk =  \yii\db\ActiveRecord::getTokenData('oum_opalmemberregmst_fk', true);
        foreach ($favProvider->getModels() as $key => $favResData) {
            $driveImg  =   \api\components\Drive::generateUrl($favResData['sexp_profdocupload'],$companypk,$userpk);
            $favData[$key] = $favResData;
            $favData[$key]['coverImageswork'] = $driveImg; 
           }
        $favouriteRes['data'] = $favData;
        $favouriteRes['totalcount'] = $favProvider->getTotalCount();
        $favouriteRes['size'] = $pageSize;
        $favouriteRes['page'] = $page;
    
        return $favouriteRes;

    }
}
