<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;

/**
 * This is the model class for table "familymst_tbl".
 *
 * @property int $FamilyMst_Pk
 * @property int $FamM_SegmentMst_Fk
 * @property string $FamM_FamilyCode
 * @property string $FamM_FamilyName
 * @property string $FamM_Status
 * @property string $FamM_CreatedOn
 * @property int $FamM_CreatedBy
 * @property string $FamM_UpdatedOn
 * @property int $FamM_UpdatedBy
 */
class FamilymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $segname;
    public static function tableName()
    {
        return 'familymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FamM_FamilyName'], 'unique'],
            [['FamM_SegmentMst_Fk', 'FamM_FamilyCode', 'FamM_FamilyName'], 'required'],
            [['FamM_SegmentMst_Fk', 'FamM_CreatedBy', 'FamM_UpdatedBy'], 'integer'],
            [['FamM_Status'], 'string'],
            [['FamM_CreatedOn', 'FamM_UpdatedOn','segname'], 'safe'],
            [['FamM_FamilyCode'], 'string', 'max' => 10],
            [['FamM_FamilyName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FamilyMst_Pk' => 'Family Mst  Pk',
            'FamM_SegmentMst_Fk' => 'Fam M  Segment Mst  Fk',
            'FamM_FamilyCode' => 'Fam M  Family Code',
            'FamM_FamilyName' => 'Fam M  Family Name',
            'FamM_Status' => 'Fam M  Status',
            'FamM_CreatedOn' => 'Fam M  Created On',
            'FamM_CreatedBy' => 'Fam M  Created By',
            'FamM_UpdatedOn' => 'Fam M  Updated On',
            'FamM_UpdatedBy' => 'Fam M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FamilymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FamilymstTblQuery(get_called_class());
    }
    public function getSegdt()
    {
         return $this->hasOne(SegmentmstTbl::className(), ['SegmentMst_Pk' => 'FamM_SegmentMst_Fk']);
    }
    public function behaviors()
    {
            // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
            return [
               [
                    'class' => TimeBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['FamM_CreatedOn'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
               [
                    'class' => UserBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['FamM_CreatedBy'],
            //                         ActiveRecord::EVENT_BEFORE_UPDATE => ['FamM_UpdatedOn'],
                    ],
                ],
            ];
    }
    public static function getfamilylist()
    {
        if(isset($_GET['segment']) && !empty($_GET['segment']))
        { 
            $frbizsearch = $_GET['frbizsearch'];
            $type = !empty($_REQUEST['type'])?$_REQUEST['type']:'P';
            $segment=$_GET['segment'];
            $segment = explode(",",$segment);
            if($frbizsearch){
                $familymodel=self::find()
                        ->select(['FamilyMst_Pk','FamM_FamilyName','SegM_SegName','FamM_SegmentMst_Fk'])
                        ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                        ->where(['=','FamM_FamilyCategory',$type])
                         ->andWhere(['=','FamM_Status','A'])
                        ->andWhere(['IN','FamM_SegmentMst_Fk',$segment])
                        ->orderBy([
                            'SegM_SegName' => SORT_ASC,
                            'FamM_FamilyName' => SORT_ASC
                        ])
                        ->asArray()->all();
            }else{
                $familymodel=self::find()
                        ->select(['FamilyMst_Pk','FamM_FamilyName','SegM_SegName','FamM_SegmentMst_Fk'])
                        ->leftJoin('segmentmst_tbl','segmentmst_pk = FamM_SegmentMst_Fk')
                        ->where(['=','FamM_FamilyCategory',$type])
                        ->andWhere(['IN','FamM_SegmentMst_Fk',$segment])
                        ->orderBy('FamM_FamilyName ASC')
                        ->asArray()->all();
            }

            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($familymodel)?$familymodel:[],
                'total_count' =>count($familymodel),

            ];
        }
    }
    
    public function getFamily($company_id, $cat_type) {   
        if($cat_type == 'P') {
            $familylist = self::find()  
                ->select(['FamilyMst_Pk','FamM_FamilyName'])
                ->leftJoin('memcompproddtls_tbl','MCPrD_ProdFamilyMst_Fk = FamilyMst_Pk') 
                ->where(['=','FamM_FamilyCategory',$cat_type])
                ->andWhere('MCSvD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id]) 
                ->orderBy('FamM_FamilyName ASC')
                ->asArray()
                ->all(); 
        } elseif ($cat_type == 's') {
            $familylist = self::find()  
                ->select(['FamilyMst_Pk','FamM_FamilyName'])
                ->leftJoin('memcompservicedtls_tbl','MCSvD_ServFamilyMst_Fk = FamilyMst_Pk') 
                ->where(['=','FamM_FamilyCategory',$cat_type])
                ->andWhere('MCSvD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id])
                ->orderBy('FamM_FamilyName ASC')
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

    public function getFamilyData($segmentPk){
        $Familymst = FamilymstTbl::find()
                        ->select('FamilyMst_Pk as familyPk, FamM_FamilyName as familyName')
                        ->where(['FamM_Status'=>'A','FamM_SegmentMst_Fk'=>$segmentPk])
                        ->orderBy('FamM_FamilyName ASC')
                        ->asArray()->all();
        return $Familymst;
    }
    
    public static function isFamilyMapped($familypk){
        return \common\models\MemcompproddtlsTbl::find()->where(['IN','MCPrD_ProdFamilyMst_Fk',$familypk])->andWhere(['!=', 'mcprd_isdeleted', 1])->exists() ||
                \common\models\MemcompservicedtlsTbl::find()->where(['IN','MCSvD_ServFamilyMst_Fk',$familypk])->andWhere(['!=', 'mcsvd_isdeleted', 1])->exists() ||
                ClassmstTbl::find()->where(['IN','ClsM_FamilyMst_Fk',$familypk])->andWhere(['ClsM_Status' => 'A'])->exists();
    }
    
    public static function isFamilyNameAlreadyAvailable($famName,$famPk = ''){
        return self::find()
                ->where(['FamM_FamilyName' => $famName])
                ->andFilterWhere(['<>','FamilyMst_Pk',$famPk])
                ->exists();
    }
    
    public static function isFamilyCodeAlreadyAvailable($famName,$famPk = ''){
        return self::find()
                ->where(['FamM_FamilyCode' => $famName])
                ->andFilterWhere(['<>','FamilyMst_Pk',$famPk])
                ->exists();
    }
}
