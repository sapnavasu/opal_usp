<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "servicemst_tbl".
 *
 * @property int $ServiceMst_Pk
 * @property int $SrvM_ClassMst_Fk
 * @property string $SrvM_ServiceCode
 * @property string $SrvM_ServiceName
 * @property string $PrdM_RiskType
 * @property string $PrdM_RiskSeverity
 * @property string $SrvM_Status
 * @property string $SrvM_CreatedOn
 * @property int $SrvM_CreatedBy
 * @property string $SrvM_UpdatedOn
 * @property int $SrvM_UpdatedBy
 *
 * @property ClassmstTbl $srvMClassMstFk
 */
class ServicemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'servicemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
       {
           return [
               [['SrvM_SegmentMst_Fk', 'SrvM_FamilyMst_Fk', 'SrvM_ClassMst_Fk', 'srvm_iscovid', 'SrvM_CreatedBy', 'SrvM_UpdatedBy'], 'integer'],
               [['SrvM_ServiceCode', 'SrvM_ServiceName', 'SrvM_Status', 'SrvM_CreatedOn', 'SrvM_CreatedBy'], 'required'],
               [['SrvM_Status'], 'string'],
               [['SrvM_CreatedOn', 'SrvM_UpdatedOn'], 'safe'],
               [['SrvM_ServiceCode'], 'string', 'max' => 45],
               [['SrvM_ServiceName'], 'string', 'max' => 200],
               [['SrvM_ClassMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => ClassmstTbl::className(), 'targetAttribute' => ['SrvM_ClassMst_Fk' => 'ClassMst_Pk']],
               [['SrvM_FamilyMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => FamilymstTbl::className(), 'targetAttribute' => ['SrvM_FamilyMst_Fk' => 'FamilyMst_Pk']],
               [['SrvM_SegmentMst_Fk'], 'exist', 'skipOnError' => true, 'targetClass' => SegmentmstTbl::className(),
    'targetAttribute' => ['SrvM_SegmentMst_Fk' => 'SegmentMst_Pk']],
           ];
       }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
   {
       return [
           'ServiceMst_Pk' => 'Service Mst  Pk',
           'SrvM_SegmentMst_Fk' => 'Srv M  Segment Mst  Fk',
           'SrvM_FamilyMst_Fk' => 'Srv M  Family Mst  Fk',
           'SrvM_ClassMst_Fk' => 'Srv M  Class Mst  Fk',
           'SrvM_ServiceCode' => 'Srv M  Service Code',
           'SrvM_ServiceName' => 'Srv M  Service Name',
           'SrvM_Status' => 'Srv M  Status',
           'srvm_iscovid' => 'Srvm Iscovid',
           'SrvM_CreatedOn' => 'Srv M  Created On',
           'SrvM_CreatedBy' => 'Srv M  Created By',
           'SrvM_UpdatedOn' => 'Srv M  Updated On',
           'SrvM_UpdatedBy' => 'Srv M  Updated By',
       ];
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSrvMClassMstFk()
    {
        return $this->hasOne(ClassmstTbl::className(), ['ClassMst_Pk' => 'SrvM_ClassMst_Fk']);
    }

    /**
     * {@inheritdoc}
     * @return ServicemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServicemstTblQuery(get_called_class());
    }
	 public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['SrvM_CreatedOn'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['SrvM_UpdatedOn'],
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['SrvM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
    }
    public static function getservicelisting()
    {
        if(isset($_GET['family']) && isset($_GET['class']) && isset($_GET['segment']))
        {
            $family=$_GET['family'];
            $family = explode(",",$family);
            $class=$_GET['class'];
            $class = explode(",",$class);
            $segment=$_GET['segment'];
            $segment = explode(",",$segment);
            $frbizsearch = $_GET['frbizsearch'];
            if($frbizsearch){
                $servicemodel=ServicemstTbl::find()
                ->select(['ServiceMst_Pk','SrvM_ServiceCode','concat(SrvM_ServiceCode,"-",SrvM_ServiceName) as SrvM_ServiceName','ClsM_ClassName','SrvM_SegmentMst_Fk'])
                ->leftJoin('classmst_tbl','classmst_pk = SrvM_ClassMst_Fk')
                ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                ->where(['IN','SrvM_FamilyMst_Fk',$family])
                ->andWhere(['IN','SrvM_SegmentMst_Fk',$segment])
                ->andWhere(['IN','SrvM_ClassMst_Fk',$class])
                ->andWhere('SrvM_Status = :SrvM_Status', ['SrvM_Status' => 'A'])
                
                ->orderBy([
                    'ClsM_ClassName' => SORT_ASC,
                    'SrvM_ServiceName' => SORT_ASC
                    ])
                    ->asArray()->all();
                }else{
                    $servicemodel=ServicemstTbl::find()
                    ->select(['ServiceMst_Pk','SrvM_ServiceCode','SrvM_ServiceName','ClsM_ClassName','SrvM_SegmentMst_Fk'])
                    ->leftJoin('classmst_tbl','classmst_pk = SrvM_ClassMst_Fk')
                    ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                    ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                    ->where(['IN','SrvM_FamilyMst_Fk',$family])
                    ->andWhere(['IN','SrvM_SegmentMst_Fk',$segment])
                    ->andWhere(['IN','SrvM_ClassMst_Fk',$class])
                    ->andWhere('SrvM_Status = :SrvM_Status', ['SrvM_Status' => 'A'])
                ->asArray()->all();
            }
            
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($servicemodel)?$servicemodel:[],
                'total_count' =>count($servicemodel),

            ];
        }
    }
    public function getserviceonsearch($searchkey, $type) {
        if($type  == 'service') {
        $productlist = BgiindcodecategTbl::find()  
            ->select(['SrvM_ServiceCode','bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeservmst_pk','bicc_categoryname','bicsc_subcategoryname',
            'bicsm_servicename', 'CONCAT(SrvM_ServiceCode, "/", SrvM_ServiceName)',
            'CONCAT(bicc_categoryname   ," > ",bicsc_subcategoryname," > ",bicsm_servicename," > ",SrvM_ServiceName) as breadcrumb',
            'CONCAT(bicc_categoryname," > ",bicsc_subcategoryname," > ",bicsm_servicename," > ") as paritialbreadcrumb',
            'CONCAT(SrvM_ServiceCode, "/", SrvM_ServiceName) as unpscproduct',
            'CONCAT(SrvM_ServiceCode, "-", SrvM_ServiceName) as servicecodeandname',
            'ServiceMst_Pk', 'SrvM_ServiceName','ubsm_bgiinduscodeservmst_fk','bicsm_bgiindcodecateg_fk', 'bicsm_bgiindcodesubcateg_fk'])
            ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
            ->innerJoin('bgiinduscodeservmst_tbl','bgiindcodesubcateg_pk = bicsm_bgiindcodesubcateg_fk')  
            ->innerJoin('unsscbiscmapping_tbl','bgiinduscodeservmst_pk = ubsm_bgiinduscodeservmst_fk')  
            ->innerJoin('servicemst_tbl','ubsm_servicemst_fk = ServiceMst_Pk')  
            ->FilterWhere(['or',
                ['like','SrvM_ServiceName', $searchkey],
                ['like','SrvM_ServiceCode', $searchkey]
            ])
            ->andWhere(['=', 'bicc_categorytype', 'S'])
            ->orderBy('SrvM_ServiceName ASC')
            ->createCommand()->queryAll();
            // ->asArray()->all();
        } else if($type  == 'Segment') {
            $productlist = BgiindcodecategTbl::find()  
            ->select(['bgiindcodecateg_pk','bicc_categoryname', 'CONCAT(bicc_categoryname) as breadcrumb'])
            ->FilterWhere(['and',
                ['like','bicc_categoryname', $searchkey],
            ])
            ->orderBy('bicc_categoryname ASC')
            ->asArray()
            ->all();
        } else if($type  == 'Family') {
            $productlist = BgiindcodecategTbl::find()  
            ->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bicc_categoryname','bicsc_subcategoryname',
            'CONCAT(bicc_categoryname   ," > ",bicsc_subcategoryname) as breadcrumb'])
            ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
            ->FilterWhere(['and',
                ['like','bicsc_subcategoryname', $searchkey],
            ])
            ->orderBy('bicsc_subcategoryname ASC')
            ->asArray()
            ->all();
        } else if($type == 'Class') {
            $productlist = BgiindcodecategTbl::find()  
            ->select(['bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeservmst_pk','bicc_categoryname','bicsc_subcategoryname','bicsm_servicename',
            'CONCAT(bicc_categoryname   ," > ",bicsc_subcategoryname," > ",bicsm_servicename) as breadcrumb'])
            ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
            ->innerJoin('bgiinduscodeservmst_tbl','bgiindcodesubcateg_pk = bicsm_bgiindcodesubcateg_fk')  
            ->innerJoin('unsscbiscmapping_tbl','bgiinduscodeservmst_pk = ubsm_bgiinduscodeservmst_fk')  
            ->FilterWhere(['and',
                ['like','bicsm_servicename', $searchkey],
            ])
            ->orderBy('bicsm_servicename ASC')
            ->asArray()
            ->all();
        }

        return $productlist;
       
    }

    public function getservicedetails($pk) {
        if($pk) {
            $servicelist = BgiindcodecategTbl::find()  
                ->select(['SrvM_ServiceCode','bgiindcodecateg_pk','bgiindcodesubcateg_pk','bgiinduscodeservmst_pk','bicc_categoryname','bicsc_subcategoryname',
                'bicsm_servicename', 'CONCAT(SrvM_ServiceCode, "/", SrvM_ServiceName)',
                'CONCAT(bicc_categoryname   ," > ",bicsc_subcategoryname," > ",bicsm_servicename," > ",SrvM_ServiceName) as breadcrumb',
                'CONCAT(SrvM_ServiceCode, "/", SrvM_ServiceName) as unpscproduct',
                'ServiceMst_Pk', 'SrvM_ServiceName','ubsm_bgiinduscodeservmst_fk','bicsm_bgiindcodecateg_fk', 'bicsm_bgiindcodesubcateg_fk'])
                ->innerJoin('bgiindcodesubcateg_tbl','bgiindcodecateg_pk = bicsc_bgiindcodecateg_fk')  
                ->innerJoin('bgiinduscodeservmst_tbl','bgiindcodesubcateg_pk = bicsm_bgiindcodesubcateg_fk')  
                ->innerJoin('unsscbiscmapping_tbl','bgiinduscodeservmst_pk = ubsm_bgiinduscodeservmst_fk')  
                ->innerJoin('servicemst_tbl','ubsm_servicemst_fk = ServiceMst_Pk')  
                ->where('ServiceMst_Pk =:pk',[':pk'=>$pk])
                ->asArray()
                ->all(); 
            return $servicelist;
        }
    }
}