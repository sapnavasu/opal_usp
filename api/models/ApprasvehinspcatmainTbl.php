<?php

namespace app\models;

use api\components\Security;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\redis\ActiveRecord as ActiveRecord2;
use function GuzzleHttp\json_decode;

/**
 * This is the model class for table "apprasvehinspcatmain_tbl".
 *
 * @property int $apprasvehinspcatmain_pk
 * @property int $arvicm_apprasvehinspcattmp_fk Reference to apprasvehinspcattmp_pk
 * @property int $arvicm_applicationdtlsmain_fk Reference to applicationdtlsmain_pk
 * @property int $arvicm_appinstinfomain_fk Reference to appinstinfomain_pk
 * @property int $arvicm_rascategorymst_fk Reference to rascategorymst_pk
 * @property string $arvicm_updatedon
 * @property int $arvicm_updatedby
 *
 * @property ApprasvehinspcathstyTbl[] $apprasvehinspcathstyTbls
 * @property AppinstinfomainTbl $arvicmAppinstinfomainFk
 * @property ApplicationdtlsmainTbl $arvicmApplicationdtlsmainFk
 * @property ApprasvehinspcattmpTbl $arvicmApprasvehinspcattmpFk
 * @property RascategorymstTbl $arvicmRascategorymstFk
 */
class ApprasvehinspcatmainTbl extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'apprasvehinspcatmain_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['arvicm_apprasvehinspcattmp_fk', 'arvicm_applicationdtlsmain_fk', 'arvicm_appinstinfomain_fk', 'arvicm_rascategorymst_fk'], 'required'],
            [['arvicm_apprasvehinspcattmp_fk', 'arvicm_applicationdtlsmain_fk', 'arvicm_appinstinfomain_fk', 'arvicm_rascategorymst_fk', 'arvicm_updatedby'], 'integer'],
            [['arvicm_updatedon'], 'safe'],
            [['arvicm_appinstinfomain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppinstinfomainTbl::className(), 'targetAttribute' => ['arvicm_appinstinfomain_fk' => 'appinstinfomain_pk']],
            [['arvicm_applicationdtlsmain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApplicationdtlsmainTbl::className(), 'targetAttribute' => ['arvicm_applicationdtlsmain_fk' => 'applicationdtlsmain_pk']],
            [['arvicm_apprasvehinspcattmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ApprasvehinspcattmpTbl::className(), 'targetAttribute' => ['arvicm_apprasvehinspcattmp_fk' => 'apprasvehinspcattmp_pk']],
            [['arvicm_rascategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => RascategorymstTbl::className(), 'targetAttribute' => ['arvicm_rascategorymst_fk' => 'rascategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'apprasvehinspcatmain_pk' => 'Apprasvehinspcatmain Pk',
            'arvicm_apprasvehinspcattmp_fk' => 'Arvicm Apprasvehinspcattmp Fk',
            'arvicm_applicationdtlsmain_fk' => 'Arvicm Applicationdtlsmain Fk',
            'arvicm_appinstinfomain_fk' => 'Arvicm Appinstinfomain Fk',
            'arvicm_rascategorymst_fk' => 'Arvicm Rascategorymst Fk',
            'arvicm_updatedon' => 'Arvicm Updatedon',
            'arvicm_updatedby' => 'Arvicm Updatedby',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getApprasvehinspcathstyTbls() {
        return $this->hasMany(ApprasvehinspcathstyTbl::className(), ['avrich_apprasvehinspcatmain_fk' => 'apprasvehinspcatmain_pk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getArvicmAppinstinfomainFk() {
        return $this->hasOne(AppinstinfomainTbl::className(), ['appinstinfomain_pk' => 'arvicm_appinstinfomain_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getArvicmApplicationdtlsmainFk() {
        return $this->hasOne(ApplicationdtlsmainTbl::className(), ['applicationdtlsmain_pk' => 'arvicm_applicationdtlsmain_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getArvicmApprasvehinspcattmpFk() {
        return $this->hasOne(ApprasvehinspcattmpTbl::className(), ['apprasvehinspcattmp_pk' => 'arvicm_apprasvehinspcattmp_fk']);
    }

    /**
     * @return ActiveQuery
     */
    public function getArvicmRascategorymstFk() {
        return $this->hasOne(RascategorymstTbl::className(), ['rascategorymst_pk' => 'arvicm_rascategorymst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return ApprasvehinspcatmainTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new ApprasvehinspcatmainTblQuery(get_called_class());
    }

    public static function getAllVehicleCategoriesByAppPk($appPk) {

//        $model = ApplicationdtlsmainTbl::findOne($appPk);


        $data = self::find()
                ->select(['rascategorymst_pk as rascatpk', 'trim(rcm_coursesubcatname_en) as category_en', 'trim(rcm_coursesubcatname_ar) as category_ar'])
                ->leftJoin('rascategorymst_tbl', 'rascategorymst_pk = arvicm_rascategorymst_fk')
                ->leftJoin('applicationdtlsmain_tbl', 'arvicm_applicationdtlsmain_fk = applicationdtlsmain_pk')
                ->andWhere(['=', 'appdm_issuspended', 2])
                ->andWhere(['=', 'arvicm_applicationdtlsmain_fk', $appPk])//->createCommand()->getRawSql();
//               ->groupBy('standardcoursemst_pk')
                ->asArray()
                ->all();

        return $data;
    }
    
    public static function getAllVehicleCategoriesIVMS() {

//        $model = ApplicationdtlsmainTbl::findOne($appPk);


        $data = RascategorymstTbl::find()
                ->select(['rascategorymst_pk as rascatpk', 'trim(rcm_coursesubcatname_en) as category_en', 'trim(rcm_coursesubcatname_ar) as category_ar'])
                ->andWhere(['=', 'rcm_status', 1])//->createCommand()->getRawSql();
//               ->groupBy('standardcoursemst_pk')
                ->asArray()
                ->all();

        return $data;
    }

    public static function getinspectoname($request) {

        $data = json_decode($request, true);
        
        $isfocalpoint= ActiveRecord::getTokenData('oum_isfocalpoint', true);
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        

        $regPk = Security::decrypt($data['registrationpk']);
        $appPk = Security::decrypt($data['applicatiomainpk']);
        $catePk = Security::decrypt($data['categoryPk']);
        $date = Security::decrypt($data['date']);
        $startTime = Security::decrypt($data['startTime']);
        $endTime = Security::decrypt($data['endTime']);
        $ifedit = $data['ifedit'];
        
        
        $inspectors = [];

        $query = OpalusermstTbl::find()
                        ->select(['opalusermst_pk as pk', 'oum_firstname','IF(DATE_ADD(NOW(), INTERVAL + 1 MONTH) > sccd_cardexpiry AND NOW() <= sccd_cardexpiry,  1, 0) AS is_nearingexpiry', 'IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) <= sccd_cardexpiry AND NOW() > sccd_cardexpiry, 1, 0) AS graceperiod', 'IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired', 'staffcompetencycarddtls_pk AS competancy_pk', 'DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate', 'DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y")  AS graceperioddate','IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired', 'staffcompetencycarddtls_pk AS competancy_pk', 'DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate', 'DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y")  AS graceperioddate','DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 2 MONTH),"%d-%m-%Y")  AS expireddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk'])
                        ->leftJoin('appstaffinfomain_tbl', 'appsim_StaffInfoRepo_FK = oum_staffinforepo_fk')
                        ->leftJoin('apprasvehinspcatmain_tbl', 'FIND_IN_SET(apprasvehinspcatmain_pk,appsim_apprasvehinspcatmain_fk)')
                        ->leftJoin('staffcompetencycardhdr_tbl', 'oum_staffinforepo_fk = scch_staffinforepo_fk')
                        ->leftJoin('staffcompetencycarddtls_tbl', 'sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk AND arvicm_rascategorymst_fk = sccd_rascategorymst_fk')
                        ->leftJoin('applicationdtlsmain_tbl', 'appsim_ApplicationDtlsMain_FK = applicationdtlsmain_pk')
                        ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                        ->where(['=', 'oum_opalmemberregmst_fk', $regPk])
                        ->andWhere(['=', 'appsim_ApplicationDtlsMain_FK', $appPk])
                        ->andWhere("((FIND_IN_SET('" . $catePk . "', arvicm_rascategorymst_fk)) || (arvicm_rascategorymst_fk = " . $catePk . " ))")
                         ->andWhere("((FIND_IN_SET('16', oum_rolemst_fk)) || (oum_rolemst_fk = 16 ))");
                    if($isfocalpoint == 2)
                    {
                        $query->andWhere(['=','opalusermst_pk',$userpk]);
                    }
                      $model = $query->asArray()->all();
                     
     
      
        if ($model) {
            foreach ($model as $record) {
                $data = RasvehicleregdtlsTbl::find()
                        ->where(['=', 'rvrd_inspectorname', $record['pk']])
                        ->andWhere(['NOT IN','rvrd_inspectionstatus',[3,9,10]])
                        ->andWhere("('" . $startTime . "'  BETWEEN rvrd_inspstarttime AND rvrd_inspendtime) OR ('" . $endTime . "'    BETWEEN rvrd_inspstarttime AND rvrd_inspendtime) OR (rvrd_inspstarttime   BETWEEN '" . $startTime . "'  AND '" . $endTime . "' ) OR (rvrd_inspendtime   BETWEEN '" . $startTime . "'  AND '" . $endTime . "' )")
                       ->exists();
      
                if (!$data) {
                    $inspectors[] = $record;
                }
            }
        }
        if($ifedit)
        {
            $inspectors = $model;
        }
        
        return $inspectors;
    }

}
