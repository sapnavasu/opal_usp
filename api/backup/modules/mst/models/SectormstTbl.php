<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\data\ActiveDataProvider;
use \common\components\Security;
use common\components\Common;

/**
 * This is the model class for table "sectormst_tbl".
 *
 * @property int $SectorMst_Pk
 * @property string $SecM_SectorCode
 * @property string $SecM_SectorName
 * @property string $SecM_Status
 * @property string $SecM_CreatedOn
 * @property int $SecM_CreatedBy
 * @property string $SecM_UpdatedOn
 * @property int $SecM_UpdatedBy
 */
class SectormstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sectormst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SecM_SectorCode','SecM_SectorName'],'unique'],
            [['SecM_Status'], 'string'],
            [['SecM_CreatedOn', 'SecM_UpdatedOn'], 'safe'],
            [['SecM_CreatedBy', 'SecM_UpdatedBy'], 'integer'],
            [['SecM_SectorCode', 'SecM_SectorName'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SectorMst_Pk' => 'Sector Mst  Pk',
            'SecM_SectorCode' => 'Sec M  Sector Code',
            'SecM_SectorName' => 'Sec M  Sector Name',
            'SecM_Status' => 'Sec M  Status',
            'SecM_CreatedOn' => 'Sec M  Created On',
            'SecM_CreatedBy' => 'Sec M  Created By',
            'SecM_UpdatedOn' => 'Sec M  Updated On',
            'SecM_UpdatedBy' => 'Sec M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SectormstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectormstTblQuery(get_called_class());
    }
     public function behaviors()
            {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
                   [
                        'class' => TimeBehavior::className(),
                        'attributes' => [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['SecM_CreatedOn'],
                            ActiveRecord::EVENT_BEFORE_UPDATE => ['SecM_UpdatedOn'],
                        ],
                    ],
                   [
                        'class' => UserBehavior::className(),
                        'attributes' => [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['SecM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                        ],
                    ],
            ];
            }

    public function getSectors(){
        $query = SectormstTbl::find();
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
        $query->select(['SecM_SectorName as name','SectorMst_Pk as pk'])
            ->where('SecM_Status = :SecM_Status',[':SecM_Status'=>'A'])
            ->orderBy(['SecM_SectorName' => SORT_ASC])
            ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => ['pageSize' => $page]
        ]);


        $data = $provider->getModels();

        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($data)?$data:[],
            'total_count' => $provider->getTotalCount(),
            // 'limit' => $page,
        ];
    }

    public static function getSectorlist(){        
        $model = SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->where(['=','SecM_Status','A'])
                ->orderBy(['SecM_SectorName'=> SORT_ASC])
                ->asArray()->all();
        return $model;
    }
    public static function getsectordata()
    {
		$type = filter_input(INPUT_GET, 'type',FILTER_SANITIZE_STRING);
        if($type == 'P'){
            $last_inserted_id = \common\models\MemcompproddtlsTbl::find()->select(['memcompproddtls_pk'])->orderBy(['memcompproddtls_pk' => SORT_DESC])->asArray()->one();
			$last_inserted_id['memcompproddtls_pk'] += 1;
            $pk = "JSRSPRO-".$last_inserted_id['memcompproddtls_pk'];
        }else if($type=='S'){
            $last_inserted_id = \common\models\MemcompservicedtlsTbl::find()->select(['MemCompServDtls_Pk'])->where(['!=', 'mcsvd_isdeleted', 1])->orderBy(['MemCompServDtls_Pk' => SORT_DESC])->asArray()->one();
			$last_inserted_id['MemCompServDtls_Pk'] += 1;
            $pk = "JSRSSER-".$last_inserted_id['MemCompServDtls_Pk'];
        }
        
        try{
            $cache = new \api\common\services\CacheBGI();
            $cacheKey = 'sector'.$pk;
            if(empty($cache->retreive($cacheKey))){
                $cacheQuery = self::sectormstQueryCache();
                $sectormodel=self::find()->select(['SectorMst_Pk','SecM_SectorName','SecM_SectorName_ar'])->where(['SecM_Status'=>'A'])->orderBy(['SecM_SectorName'=>SORT_ASC])->asArray()->all();
                $cache->store($cacheKey, $sectormodel, $duration = 0 , $cacheQuery);
    
            } else {
                $sectormodel = $cache->retreive($cacheKey);
            }

        } catch(\Exception $e){
            $sectormodel = self::find()->select(['SectorMst_Pk','SecM_SectorName','SecM_SectorName_ar'])->where(['SecM_Status'=>'A'])->orderBy(['SecM_SectorName'=>SORT_ASC])->asArray()->all();
        } 
       
        if($type){
            return [
                'msg' => "success",
                'status' => 1,
                'jsrs_product_ref' => $pk,
                'items' => !empty($sectormodel)?$sectormodel:[],
                'total_count' => count($sectormodel),
            ];
        }else{
            return $sectormodel;
        }

    }
    public static function getsectorlistforactivity($sectors)
    {  
        $sector_ids = [];
        foreach($sectors['items'] as $key => $value) {
           $sector_ids[] = $value['ActM_SectorMst_Fk'];
        }
        $sectormodel = self::find()
            ->select(['SectorMst_Pk', 'SecM_SectorName'])
            ->where(['IN','SectorMst_Pk', $sector_ids])
            ->orderBY('SecM_SectorName ASC')
            ->asArray()->all();
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($sectormodel)?$sectormodel:[],
            'total_count' =>count($sectormodel), 
        ];
    }
    public static function getSectorlists(){        
        $model = SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->where(['=','SecM_Status','A'])
                ->orderBy(['SecM_SectorName'=> SORT_ASC])
                ->asArray()->all();
        return $model;
    }
    
    public static function getSectorName($sector_id) {
         $model = SectormstTbl::find()
                ->select(['SectorMst_Pk','SecM_SectorName'])
                ->where(['=','SectorMst_Pk',$sector_id])
                ->asArray()->all();
        return $model;
    }
    
    public static function getSectorNamesByPk($sector_id) {
         $model = SectormstTbl::find()
                ->select(['SecM_SectorName'])
                ->where(['IN','SectorMst_Pk',$sector_id])
                ->asArray()->all();
        return array_column($model,'SecM_SectorName');
    }

    public static function getSectorDtl(){
        $model = SectormstTbl::find()
                ->select([
                    'SectorMst_Pk as sectorPk',
                    'SecM_SectorName as sectorName'
                ])
                ->where(['=','SecM_Status','A'])
                ->orderBy(['SecM_SectorName'=> SORT_ASC])
                ->asArray()->all();
        return $model;        
    }

    public static function sectormstQueryCache(){
        return self::find()
        ->select(['max(SecM_UpdatedOn), count(*)'])
        ->createCommand()
        ->getRawSql();
    }
    public static function getsectorbydivsion($divisionpk){
        $company_id = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk', true);
        $model = SectormstTbl::find()
                ->select([
                    'SectorMst_Pk as sectorPk',
                    'SecM_SectorName as sectorName'
                ])
                ->leftJoin('memcompsectordtls_tbl','find_in_set(SectorMst_Pk, MCSD_SectorMst_Fk)')
                  ->andWhere(['MemCompSecDtls_Pk' => $divisionpk])
                 ->andWhere(['MCSD_MemberCompMst_Fk' => $company_id])
                ->orderBy(['SecM_SectorName'=> SORT_ASC])
                ->asArray()->all();
        return $model;        
    }
}
