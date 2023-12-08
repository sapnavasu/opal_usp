<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staffcompetencycardhdr_tbl".
 *
 * @property int $staffcompetencycardhdr_pk primary key
 * @property int $scch_staffinforepo_fk Reference to staffinforepo_tbl
 * @property int $scch_projectmst_fk Reference to Projectmst_tbl
 * @property int $scch_standardcoursemst_fk Reference to standardcoursemst_pk
 * @property int $scch_appoffercoursemain_fk Reference to appoffercoursemain_pk
 * @property string $scch_rolemst_fk Reference to rolemst_pk For all the project, the respective approved Role will be stored here
 * @property string $scch_language Reference to referencemsttbl.rm_mastertype=10
 * @property string $scch_cardissuedate
 * @property int $scch_status 1 - Valid, 2 - In-active (when change is made and re-issued the card) / Destroyed and issued new card
 * @property string $scch_printedon
 * @property int $scch_printedby
 * @property string $scch_createdon
 * @property int $scch_createdby
 *
 * @property StaffcompetencycarddtlsTbl[] $staffcompetencycarddtlsTbls
 * @property AppoffercoursemainTbl $scchAppoffercoursemainFk
 * @property ProjectmstTbl $scchProjectmstFk
 * @property StaffinforepoTbl $scchStaffinforepoFk
 * @property StandardcoursemstTbl $scchStandardcoursemstFk
 */
class StaffcompetencycardhdrTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staffcompetencycardhdr_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scch_staffinforepo_fk', 'scch_projectmst_fk', 'scch_rolemst_fk', 'scch_status', 'scch_createdby'], 'required'],
            [['scch_staffinforepo_fk', 'scch_projectmst_fk', 'scch_standardcoursemst_fk', 'scch_appoffercoursemain_fk', 'scch_status', 'scch_printedby', 'scch_createdby'], 'integer'],
            [['scch_rolemst_fk', 'scch_language'], 'string'],
            [['scch_cardissuedate', 'scch_printedon', 'scch_createdon'], 'safe'],
            [['scch_appoffercoursemain_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppoffercoursemainTbl::className(), 'targetAttribute' => ['scch_appoffercoursemain_fk' => 'appoffercoursemain_pk']],
            [['scch_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['scch_projectmst_fk' => 'projectmst_pk']],
            [['scch_staffinforepo_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StaffinforepoTbl::className(), 'targetAttribute' => ['scch_staffinforepo_fk' => 'staffinforepo_pk']],
            [['scch_standardcoursemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => StandardcoursemstTbl::className(), 'targetAttribute' => ['scch_standardcoursemst_fk' => 'standardcoursemst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'staffcompetencycardhdr_pk' => 'primary key',
            'scch_staffinforepo_fk' => 'Reference to staffinforepo_tbl',
            'scch_projectmst_fk' => 'Reference to Projectmst_tbl',
            'scch_standardcoursemst_fk' => 'Reference to standardcoursemst_pk',
            'scch_appoffercoursemain_fk' => 'Reference to appoffercoursemain_pk',
            'scch_rolemst_fk' => 'Reference to rolemst_pk For all the project, the respective approved Role will be stored here',
            'scch_language' => 'Reference to referencemsttbl.rm_mastertype=10',
            'scch_cardissuedate' => 'Scch Cardissuedate',
            'scch_status' => '1 - Valid, 2 - In-active (when change is made and re-issued the card) / Destroyed and issued new card',
            'scch_printedon' => 'Scch Printedon',
            'scch_printedby' => 'Scch Printedby',
            'scch_createdon' => 'Scch Createdon',
            'scch_createdby' => 'Scch Createdby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffcompetencycarddtlsTbls()
    {
        return $this->hasMany(StaffcompetencycarddtlsTbl::className(), ['sccd_staffcompetencycardhdr_fk' => 'staffcompetencycardhdr_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchAppoffercoursemainFk()
    {
        return $this->hasOne(AppoffercoursemainTbl::className(), ['appoffercoursemain_pk' => 'scch_appoffercoursemain_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['projectmst_pk' => 'scch_projectmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchStaffinforepoFk()
    {
        return $this->hasOne(StaffinforepoTbl::className(), ['staffinforepo_pk' => 'scch_staffinforepo_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScchStandardcoursemstFk()
    {
        return $this->hasOne(StandardcoursemstTbl::className(), ['standardcoursemst_pk' => 'scch_standardcoursemst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return StaffcompetencycardhdrTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffcompetencycardhdrTblQuery(get_called_class());
    }
    
    public static function getstaffdetailsoncompetancyras($staffuserpk,$rasctegorymstpk,$vehiclepk)
    {
         $model = OpalusermstTbl::find()
                        ->select(['opalusermst_pk as pk', 'oum_firstname','IF(DATE_ADD(NOW(), INTERVAL + 1 MONTH) > sccd_cardexpiry AND NOW() <= sccd_cardexpiry,  1, 0) AS is_nearingexpiry', 'IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) <= sccd_cardexpiry AND NOW() > sccd_cardexpiry, 1, 0) AS graceperiod', 'IF(DATE_ADD(NOW(), INTERVAL - 1 MONTH) > sccd_cardexpiry,  1, 0) AS is_expired', 'staffcompetencycarddtls_pk AS competancy_pk', 'DATE_FORMAT(sccd_cardexpiry,"%d-%m-%Y") AS nearingdate', 'DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 1 MONTH),"%d-%m-%Y")  AS graceperioddate','DATE_FORMAT(DATE_ADD(sccd_cardexpiry, INTERVAL + 2 MONTH),"%d-%m-%Y")  AS expireddate','if(appdt_apptype = 2 and appdt_status not in (17,19),1,0) as renewed','applicationdtlstmp_pk as temppk'])
                        ->leftJoin('staffcompetencycardhdr_tbl', 'oum_staffinforepo_fk = scch_staffinforepo_fk')
                        ->leftJoin('staffcompetencycarddtls_tbl', 'sccd_staffcompetencycardhdr_fk = staffcompetencycardhdr_pk')
                        ->leftJoin('appstaffinfomain_tbl', 'scch_staffinforepo_fk = appsim_StaffInfoRepo_FK')
                        ->leftJoin('applicationdtlsmain_tbl', 'appsim_ApplicationDtlsMain_FK = applicationdtlsmain_pk')
                        ->leftJoin('applicationdtlstmp_tbl', 'appdm_applicationdtlstmp_fk = applicationdtlstmp_pk')
                        ->where(['=','opalusermst_pk',$staffuserpk])
                        ->andWhere("((FIND_IN_SET('" . $rasctegorymstpk . "', sccd_rascategorymst_fk)) || (sccd_rascategorymst_fk = " . $rasctegorymstpk . " ))")
                        ->asArray()->one();
         
         
       return $model;
    }
}
