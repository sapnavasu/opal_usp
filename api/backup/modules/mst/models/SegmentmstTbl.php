<?php

namespace api\modules\mst\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TimeBehavior;
use common\behaviors\UserBehavior;
use yii\db\Command;
/**
 * This is the model class for table "segmentmst_tbl".
 *
 * @property int $SegmentMst_Pk
 * @property string $SegM_SegCode
 * @property string $SegM_SegName
 * @property string $SegM_SegCategory
 * @property string $SegM_Status
 * @property string $SegM_CreatedOn
 * @property int $SegM_CreatedBy
 * @property string $SegM_UpdatedOn
 * @property int $SegM_UpdatedBy
 */
class SegmentmstTbl extends \yii\db\ActiveRecord {
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'segmentmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['SegM_SegCode', 'SegM_SegName'], 'unique'],
            [['SegM_SegCode', 'SegM_SegName', 'SegM_SegCategory'], 'required'],
            [['SegM_SegCategory', 'SegM_Status'], 'string'],
            [['SegM_CreatedOn', 'SegM_UpdatedOn'], 'safe'],
            [['SegM_CreatedBy', 'SegM_UpdatedBy'], 'integer'],
            [['SegM_SegCode'], 'string', 'max' => 10],
            [['SegM_SegName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'SegmentMst_Pk' => 'Segment Mst  Pk',
            'SegM_SegCode' => 'Seg M  Seg Code',
            'SegM_SegName' => 'Seg M  Seg Name',
            'SegM_SegCategory' => 'Seg M  Seg Category',
            'SegM_Status' => 'Seg M  Status',
            'SegM_CreatedOn' => 'Seg M  Created On',
            'SegM_CreatedBy' => 'Seg M  Created By',
            'SegM_UpdatedOn' => 'Seg M  Updated On',
            'SegM_UpdatedBy' => 'Seg M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return SegmentmstTblQuery the active query used by this AR class.
     */
    public static function find() {
        return new SegmentmstTblQuery(get_called_class());
    }
    
    public function behaviors() {
        // TimestampBehavior also provides a method named touch() that allows you to assign the current timestamp to the specified attribute(s) and save them to the database. For example,
        return [ 
            [
                'class' => TimeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['SegM_CreatedOn'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['SegM_UpdatedOn'],
                ],
            ], 
            [
                'class' => UserBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['SegM_CreatedBy'],
                    // ActiveRecord::EVENT_BEFORE_UPDATE => ['CyM_UpdatedOn'],
                ],
            ],
        ];
    } 
    
    public static function getlist($category = null) {
        $type=$category;
        $listofdata = SegmentmstTbl::find()->select(['SegmentMst_Pk','SegM_SegName'])->where(['SegM_SegCategory'=> $type,'SegM_Status'=>'A'])->orderBy(['SegM_SegName'=>SORT_ASC])->asArray()->all();
        
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($listofdata)?$listofdata:[],
            'total_count' =>count($listofdata), 
        ];
    }
    
    public function getSegmentsList($company_id, $cat_type) {  
        if($cat_type == 'P') { 
            $listofdata = SegmentmstTbl::find()
                ->select(['SegmentMst_Pk','SegM_SegName']) 
                ->leftJoin('memcompproddtls_tbl','MCPrD_ProdSegmentMst_Fk = SegmentMst_Pk')
                ->where('SegM_SegCategory = :segcat', ['segcat' => $cat_type])
                ->andWhere('MCPrD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id])
                ->orderBy('SegM_SegName')
                ->asArray()
                ->all();  
        } else {
            $listofdata = SegmentmstTbl::find()
                ->select(['SegmentMst_Pk','SegM_SegName']) 
                ->leftJoin('memcompproddtls_tbl','MCSvD_ServSegmentMst_Fk = SegmentMst_Pk')
                ->where('SegM_SegCategory = :segcat', ['segcat' => $cat_type])
                ->andWhere('MCPrD_MemberCompMst_Fk = :memcompk',['memcompk' => $company_id])
                ->orderBy('SegM_SegName')
                ->asArray()
                ->all();  
        }
        return [
            'msg' => "success",
            'status' => 1,
            'items' => !empty($listofdata) ? $listofdata : [],
            'total_count' =>count($listofdata), 
        ];
    }

    public function getSegmentData($segmentPk = ''){
        $Segmentmst = SegmentmstTbl::find()
                        ->select('SegmentMst_Pk as segmentPk, SegM_SegName as segmentName')
                        ->where(['SegM_Status'=>'A']);
        if($segmentPk > 0)
        {
            $Segmentmst->andWhere(['SegmentMst_Pk'=>$segmentPk]);
        }
        $segmentResult = $Segmentmst->orderBy('SegM_SegName')
                                    ->asArray()->all();
        return $segmentResult;
    }

}
