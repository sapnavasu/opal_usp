<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appstaffscheddtls_tbl".
 *
 * @property int $appstaffscheddtls_pk Primary Key
 * @property int $assd_opalmemberregmst_fk Reference to opalmemberregmst_tbl.opalmemberregmst_pk
 * @property int $assd_appstaffinfotmp_fk Reference to appostaffinfo_pk
 * @property string $assd_fromdate
 * @property string $assd_todate
 * @property int $assd_dayschedule Reference to referencemst_pk where rm_mastertype=11
 * @property string $assd_starttime
 * @property string $assd_endtime
 * @property int $assd_status 1-Active still remains in same branch, 2-Inactive staff moved to another branch
 * @property string $assd_createdon
 * @property int $assd_createdby
 * @property string $assd_updatedon
 * @property int $assd_updatedby
 *
 * @property AppstaffinfotmpTbl $assdAppstaffinfotmpFk
 * @property OpalmemberregmstTbl $assdOpalmemberregmstFk
 */
class AppstaffscheddtlsTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appstaffscheddtls_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assd_opalmemberregmst_fk', 'assd_appstaffinfotmp_fk', 'assd_dayschedule','assd_status', 'assd_createdby'], 'required'],
            [['assd_opalmemberregmst_fk', 'assd_appstaffinfotmp_fk', 'assd_dayschedule', 'assd_status', 'assd_createdby', 'assd_updatedby'], 'integer'],
            [['assd_fromdate', 'assd_createdon', 'assd_updatedon'], 'safe'],
            [['assd_appstaffinfotmp_fk'], 'exist', 'skipOnError' => true, 'targetClass' => AppstaffinfotmpTbl::className(), 'targetAttribute' => ['assd_appstaffinfotmp_fk' => 'appostaffinfotmp_pk']],
            [['assd_opalmemberregmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalmemberregmstTbl::className(), 'targetAttribute' => ['assd_opalmemberregmst_fk' => 'opalmemberregmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appstaffscheddtls_pk' => 'Appstaffscheddtls Pk',
            'assd_opalmemberregmst_fk' => 'Assd Opalmemberregmst Fk',
            'assd_appstaffinfotmp_fk' => 'Assd Appstaffinfotmp Fk',
            'assd_fromdate' => 'Assd Fromdate',
            'assd_todate' => 'Assd Todate',
            'assd_dayschedule' => 'Assd Dayschedule',
            // 'assd_starttime' => 'Assd Starttime',
            // 'assd_endtime' => 'Assd Endtime',
            'assd_status' => 'Assd Status',
            'assd_createdon' => 'Assd Createdon',
            'assd_createdby' => 'Assd Createdby',
            'assd_updatedon' => 'Assd Updatedon',
            'assd_updatedby' => 'Assd Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssdAppstaffinfotmpFk()
    {
        return $this->hasOne(AppstaffinfotmpTbl::className(), ['appostaffinfotmp_pk' => 'assd_appstaffinfotmp_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssdOpalmemberregmstFk()
    {
        return $this->hasOne(OpalmemberregmstTbl::className(), ['opalmemberregmst_pk' => 'assd_opalmemberregmst_fk']);
    }
    
    public static function ChangeSchedule($assessorPk,$assessmentdate,$starttime= null, $endtime=null ,$status ,$stafftype)
    {
        $assessorpk = AppstaffinfomainTbl::find()
                ->select(['appsim_AppStaffInfotmp_FK'])
                ->leftJoin('opalusermst_tbl','oum_staffinforepo_fk = appsim_StaffInfoRepo_FK')
                ->where(['=','opalusermst_pk',$assessorPk])
                ->asArray()->all();


        foreach($assessorpk as $assessor)
        {
           
            $data = self::find()
                ->where(['=','assd_appstaffinfotmp_fk',$assessor['appsim_AppStaffInfotmp_FK']])
                ->andWhere(['=','assd_date',$assessmentdate]);
        
            
            if($starttime && $endtime)
            {
                $data->andWhere("date_format(assd_starttime,'%H:%i') <= date_format('".$starttime."','%H:%i')");
                $data->andWhere("date_format(assd_endtime,'%H:%i') >= date_format('".$endtime."','%H:%i')");
            }
      
                $model = $data->one();
            
      
       if($model)
       {
//            $statuscheck = \api\components\Common::staffschedulestatuscheck($model->appstaffscheddtls_pk,$assessorPk,$starttime,$endtime);
        $model->assd_dayschedule = $status;
        $model->assd_bookedfor = $stafftype;
     
        if($model->save())
        {
          
            $datapks[] =  $model->appstaffscheddtls_pk;
        }
        else
        {
            echo "<pre>";
            var_dump($model->getErrors());
            exit;
        }
       }
       }
     
     return $datapks;

                
    }
}
