<?php
namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "classmst_tbl".
 *
 * @property int $ClassMst_Pk
 * @property int $ClsM_FamilyMst_Fk
 * @property string $ClsM_ClassCode
 * @property string $ClsM_ClassName
 * @property string $ClsM_Status
 * @property string $ClsM_CreatedOn
 * @property int $ClsM_CreatedBy
 * @property string $ClsM_UpdatedOn
 * @property int $ClsM_UpdatedBy
 *
 * @property ProductmstTbl[] $productmstTbls
 * @property ServicemstTbl[] $servicemstTbls
 */
class ClassmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'classmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ClsM_ClassCode', 'ClsM_ClassName'], 'unique'],
            [['ClsM_FamilyMst_Fk', 'ClsM_ClassCode', 'ClsM_ClassName'], 'required'],
            [['ClsM_FamilyMst_Fk', 'ClsM_CreatedBy', 'ClsM_UpdatedBy'], 'integer'],
            [['ClsM_Status'], 'string'],
            [['ClsM_CreatedOn', 'ClsM_UpdatedOn'], 'safe'],
            [['ClsM_ClassCode'], 'string', 'max' => 10],
            [['ClsM_ClassName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ClassMst_Pk' => 'Class Mst  Pk',
            'ClsM_FamilyMst_Fk' => 'Cls M  Family Mst  Fk',
            'ClsM_ClassCode' => 'Cls M  Class Code',
            'ClsM_ClassName' => 'Cls M  Class Name',
            'ClsM_Status' => 'Cls M  Status',
            'ClsM_CreatedOn' => 'Cls M  Created On',
            'ClsM_CreatedBy' => 'Cls M  Created By',
            'ClsM_UpdatedOn' => 'Cls M  Updated On',
            'ClsM_UpdatedBy' => 'Cls M  Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductmstTbls()
    {
        return $this->hasMany(ProductmstTbl::className(), ['PrdM_ClassMst_Fk' => 'ClassMst_Pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicemstTbls()
    {
        return $this->hasMany(ServicemstTbl::className(), ['SrvM_ClassMst_Fk' => 'ClassMst_Pk']);
    }
    public static function find()
        {
            return new ClassmstTblQuery(get_called_class());
        }
    public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['ClsM_CreatedOn'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['ClsM_UpdatedOn'],
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['ClsM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
    }

    public static function getclasslist()
    {
        if(isset($_GET['family']) && isset($_GET['segment'])){
           $family=$_GET['family'];
           $family = explode(",",$family);
           $segment=$_GET['segment'];
           $segment = explode(",",$segment);
           $frbizsearch = $_GET['frbizsearch'];
           $type = !empty($_REQUEST['type'])?$_REQUEST['type']:'P';
           if($frbizsearch == "true"){
               $classmodel=self::find()
                   ->select(['ClassMst_Pk','ClsM_ClassCode','ClsM_ClassName','FamM_FamilyName','ClsM_SegmentMst_Fk'])
                   ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                   ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                   ->where(['=','ClsM_FamilyCategory',$type])   
                   ->andWhere(['=','ClsM_Status','A'])
                   ->andWhere(['IN','ClsM_FamilyMst_Fk',$family])
                   ->andWhere(['IN','ClsM_SegmentMst_Fk',$segment])
                   ->orderBy([
                            'FamM_FamilyName' => SORT_ASC,
                            'ClsM_ClassName' => SORT_ASC
                        ])
                   ->asArray()->all();
           }else{
               $classmodel=self::find()
                   ->select(['ClassMst_Pk','ClsM_ClassCode','ClsM_ClassName','FamM_FamilyName','ClsM_SegmentMst_Fk'])
                   ->leftJoin('familymst_tbl','FamilyMst_Pk = ClsM_FamilyMst_Fk')
                   ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                   ->where(['=','ClsM_FamilyCategory',$type])   
                   ->andWhere(['IN','ClsM_FamilyMst_Fk',$family])
                   ->andWhere(['IN','ClsM_SegmentMst_Fk',$segment])
                   ->asArray()->all();
           }

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($classmodel)?$classmodel:[],
                'total_count' =>count($classmodel),

            ];
        }
    }
    
    public function getclass($company_id, $cat_type) {
        if($cat_type == 'P') {
            $classlist = self::find()  
                ->select(['ClassMst_Pk','ClsM_ClassName'])
                ->leftJoin('memcompproddtls_tbl','MCPrD_ProdClassMst_Fk = ClassMst_Pk') 
                ->where(['=','ClsM_FamilyCategory',$cat_type])
                ->andWhere('ClsM_FamilyMst_Fk = :memcompk',['memcompk' => $company_id]) 
                ->orderBy('ClsM_ClassName ASC')
                ->asArray()
                ->all(); 
        } elseif ($cat_type == 's') {
            $classlist = self::find()  
                ->select(['ClassMst_Pk','ClsM_ClassName'])
                ->leftJoin('memcompservicedtls_tbl','MCSvD_ServClassMst_Fk = FamilyMst_Pk') 
                ->where(['=','ClsM_FamilyCategory',$cat_type])
                ->andWhere('ClsM_FamilyMst_Fk = :memcompk',['memcompk' => $company_id])
                ->orderBy('ClsM_ClassName ASC')
                ->asArray()
                ->all(); 
        }
        
        return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($familylist) ? $familylist : [],
                'total_count' => count($familylist),
            ];
    }

    public function getClassData($segmentPk, $familyPk){
        $Classmst = ClassmstTbl::find()
                        ->select('ClassMst_Pk as classPk, ClsM_ClassName as ClassName')
                        ->where(['ClsM_Status'=>'A','ClsM_SegmentMst_Fk'=>$segmentPk, 'ClsM_FamilyMst_Fk'=>$familyPk])
                        ->orderBy('ClsM_ClassName ASC')
                        ->asArray()->all(); 
        return $Classmst;
    }

    public function checkCodeCount($classCode, $classPk=''){
        $Classquery = ClassmstTbl::find()
                        ->where(['ClsM_ClassCode'=>$classCode]);
        if(!empty($classPk)){
            $Classquery->andWhere(['<>','ClassMst_Pk',$classPk]);
        }
        $classResult = $Classquery->one();

        return $classResult;
    }

    public function checkNameCount($className, $classPk=''){
        $Classquery = ClassmstTbl::find()
                        ->where(['ClsM_ClassName'=>$className]);
        if(!empty($classPk)){
            $Classquery->andWhere(['<>','ClassMst_Pk',$classPk]);
        }
        $classResult = $Classquery->one();

        return $classResult;
    }
}
