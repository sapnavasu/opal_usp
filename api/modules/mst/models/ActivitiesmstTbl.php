<?php
namespace api\modules\mst\models;
use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;
use \api\modules\mst\models\SectormstTbl;
use \common\models\MemcompsectordtlsTbl;
use \common\models\MemcompsectoractivitydtlsTbl;

/**
 * This is the model class for table "activitiesmst_tbl".
 *
 * @property int $ActivitiesMst_Pk
 * @property int $ActM_SectorMst_Fk
 * @property int $ActM_IndustryMst_Fk
 * @property string $ActM_ActivityCode
 * @property string $ActM_ActivityName
 * @property string $ActM_Status
 * @property string $ActM_CreatedOn
 * @property int $ActM_CreatedBy
 * @property string $ActM_UpdatedOn
 * @property int $ActM_UpdatedBy
 */
class ActivitiesmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activitiesmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ActM_ActivityName','ActM_ActivityCode'],'unique'],
            [['ActM_SectorMst_Fk', 'ActM_IndustryMst_Fk'], 'integer'],
            [['ActM_Status'], 'string'],
            [['ActM_CreatedOn', 'ActM_UpdatedOn'], 'safe'],
            [['ActM_ActivityCode'], 'string', 'max' => 10],
            [['ActM_ActivityName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ActivitiesMst_Pk' => 'Activities Mst  Pk',
            'ActM_SectorMst_Fk' => 'Act M  Sector Mst  Fk',
            'ActM_IndustryMst_Fk' => 'Act M  Industry Mst  Fk',
            'ActM_ActivityCode' => 'Act M  Activity Code',
            'ActM_ActivityName' => 'Act M  Activity Name',
            'ActM_Status' => 'Act M  Status',
            'ActM_CreatedOn' => 'Act M  Created On',
            'ActM_CreatedBy' => 'Act M  Created By',
            'ActM_UpdatedOn' => 'Act M  Update On',
            'ActM_UpdatedBy' => 'Act M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ActivitiesmstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivitiesmstTblQuery(get_called_class());
    }
	 public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['ActM_CreatedOn'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['ActM_UpdatedOn'],
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['ActM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
    }

    public function getActivities($sectorid,$industryid){
        $query = ActivitiesmstTbl::find();
        if ($_REQUEST['type'] == 'filter') {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach (array_filter($_REQUEST) as $key => $val) {
                if (!is_null($val)) {
                    $query->andFilterWhere(['LIKE', Common::getTableWithPrefix($key, true), $val]);
                }
            }
        }
        $query->select(['ActM_ActivityName as name','ActivitiesMst_Pk as pk'])
            ->where('ActM_SectorMst_Fk = :ActM_SectorMst_Fk and ActM_Status = :ActM_Status and ActM_IndustryMst_Fk = :ActM_IndustryMst_Fk',
                [':ActM_SectorMst_Fk'=>$sectorid,':ActM_Status'=>'A', ':ActM_IndustryMst_Fk'=> $industryid])
            ->orderBy(['ActM_ActivityName' => SORT_ASC])
            ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => ['pageSize' => $page]
        ]);

        return $provider;
    }
    public static function getactivity()
    { 
        $industry = $_REQUEST['industry'];
        $sector = $_REQUEST['sector'];
        $activitymodel=self::find()->select(['ActivitiesMst_Pk AS item_id','ActM_ActivityName AS item_value'])
        ->where('ActM_IndustryMst_Fk =:ActM_IndustryMst_Fk and ActM_SectorMst_Fk =:ActM_SectorMst_Fk',[':ActM_IndustryMst_Fk'=>$industry,':ActM_SectorMst_Fk'=> $sector])->asArray()->all();
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($activitymodel)?$activitymodel:[],
            'total_count' =>count($activitymodel),

        ];
    }
    public static function getactivitylist($sector_id)
    {  
        $sector_ids = explode(',', $sector_id) ;
        $activitymodel = self::find()
            ->select(['ActivitiesMst_Pk AS item_id','ActM_ActivityName AS item_value'])
            ->where(['IN','ActM_SectorMst_Fk', $sector_ids]);
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($activitymodel)?$activitymodel:[],
            'total_count' =>count($activitymodel), 
        ];
    }
    
    public static function getsectorlist($activity)
    {  
        $sector_fks = self::find()
            ->select(['ActM_SectorMst_Fk'])
            ->where(['IN','ActivitiesMst_Pk', $activity])
            ->groupBy(['ActM_SectorMst_Fk'])
            ->asArray()
            ->all();
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($sector_fks)?$sector_fks:[],
            'total_count' =>count($sector_fks), 
        ];
    }
    public static function getactivityforsector($sectors, $type) {
        $sectors_id = explode(',', $sectors);
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);

        if($type == 'product') {

            $activitylist = self::find()
                ->select(['ActivitiesMst_Pk', 'ActM_ActivityName', 'ActM_SectorMst_Fk'])
                ->leftJoin('memcompsectordtls_tbl', 'MCSD_SectorMst_Fk = ActM_SectorMst_Fk')
                ->where(['IN','ActM_SectorMst_Fk', $sectors_id])
                ->groupBy('ActM_ActivityName')
                ->asArray()
                ->all();  
        } else {
        //   $activitylist = self::find()
        //         ->select(['ActivitiesMst_Pk', 'ActM_ActivityName', 'ActM_SectorMst_Fk'])
        //         ->leftJoin('memcompservicedtls_tbl','mcsvd_memcompbussrcdtls_fk = mcbsa_memcompbussrcdtls_fk')
        //         ->where(['IN','ActM_SectorMst_Fk', $sectors_id])
        //         ->andWhere('MCSvD_MemberCompMst_Fk = :MCSvD_MemberCompMst_Fk',['MCSvD_MemberCompMst_Fk' => $company_id])
        //         ->groupBy('ActM_ActivityName')
        //         ->asArray()
        //         ->all(); 
                
            $activitylist = self::find()
                ->select(['ActivitiesMst_Pk', 'ActM_ActivityName', 'ActM_SectorMst_Fk'])
                ->leftJoin('memcompsectordtls_tbl', 'MCSD_SectorMst_Fk = ActM_SectorMst_Fk')
                ->where(['IN','ActM_SectorMst_Fk', $sectors_id])
                ->groupBy('ActM_ActivityName')
                ->asArray()
                ->all(); 
        }

        $activitylist_grouping = [];
        $final_activitylist_grouping = [];
        foreach($activitylist as $key => $val) {
            $sector_name = SectormstTbl::getSectorName($val['ActM_SectorMst_Fk']);
            $activitylist_grouping[$sector_name[0]['SecM_SectorName']][] = $val;
        }
        $i = 0;
        foreach($activitylist_grouping as $key1 => $val) { 
            $final_activitylist_grouping[$i]['groupname'] = $key1;
            $final_activitylist_grouping[$i]['value'][] = $val;
            $i++;
        }
        return $final_activitylist_grouping; 
    }
    
}
