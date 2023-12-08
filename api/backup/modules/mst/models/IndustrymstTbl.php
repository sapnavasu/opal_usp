<?php

namespace api\modules\mst\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "industrymst_tbl".
 *
 * @property int $IndustryMst_Pk
 * @property int $IndM_SectorMst_Fk
 * @property string $IndM_IndustryCode
 * @property string $IndM_IndustryName
 * @property string $IndM_Status
 * @property string $IndM_CreatedOn
 * @property int $IndM_CreatedBy
 * @property string $IndM_UpdatedOn
 * @property int $IndM_UpdatedBy
 */
class IndustrymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'industrymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IndM_IndustryCode','IndM_IndustryName'],'unique'],
            [['IndM_SectorMst_Fk', 'IndM_CreatedBy', 'IndM_UpdatedBy'], 'integer'],
            [['IndM_Status'], 'string'],
            [['IndM_CreatedOn', 'IndM_UpdatedOn'], 'safe'],
            [['IndM_IndustryCode', 'IndM_IndustryName'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IndustryMst_Pk' => 'Industry Mst  Pk',
            'IndM_SectorMst_Fk' => 'Ind M  Sector Mst  Fk',
            'IndM_IndustryCode' => 'Ind M  Industry Code',
            'IndM_IndustryName' => 'Ind M  Industry Name',
            'IndM_Status' => 'Ind M  Status',
            'IndM_CreatedOn' => 'Ind M  Created On',
            'IndM_CreatedBy' => 'Ind M  Created By',
            'IndM_UpdatedOn' => 'Ind M  Updated On',
            'IndM_UpdatedBy' => 'Ind M  Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return IndustrymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IndustrymstTblQuery(get_called_class());
    }

    public function getIndustry($id){
        $query = IndustrymstTbl::find();
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
        $query->select(['IndM_IndustryName as name','IndustryMst_Pk as pk'])
            ->where('IndM_SectorMst_Fk = :IndM_SectorMst_Fk and IndM_Status = :IndM_Status',[':IndM_SectorMst_Fk' => $sectorid,':IndM_Status'=>'A'])
            ->orderBy(['IndM_IndustryName' => SORT_ASC])
            ->asArray();

        $page = (isset($_REQUEST['size'])) ? $_REQUEST['size'] : 5;
        $provider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => ['pageSize' => $page]
        ]);

        return $provider;
    }

    public static function getdataindustry()
    {
        if(isset($_GET['sector']))
        {
            $sector=$_GET['sector'];
            $industrymodel=self::find()->select(['IndustryMst_Pk','IndM_IndustryName'])->where(['IndM_SectorMst_Fk'=>$sector,'IndM_Status'=>'A'])->asArray()->all();
   
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($industrymodel)?$industrymodel:[],
                'total_count' =>count($industrymodel),

            ];
        }

    }

    public function getIndListDtlsBySector($sectorPk){
        return IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->andWhere("IndM_SectorMst_Fk=:sector",[":sector"=>$sectorPk])
                ->orderBy('IndM_IndustryName ASC')
                ->asArray()
                ->all();
    }
    public function getIndListBySector($sectorPk){
        if($sectorPk != null){            
        $model= IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->andWhere(['IN', 'IndM_SectorMst_Fk', $sectorPk])
                ->orderBy('IndM_IndustryName ASC')
                ->asArray()
                ->all();
        }  else {
            $model= IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->orderBy('IndM_IndustryName ASC')
                ->asArray()
                ->all();
        }
        $result = array(
            'status' => 200,
            'msg' => 'Success',
            'flag' => 'S',
            'returndata' => $model ? $model : [],
        );
        return $result;
    }
    public function getIndListDtlsByProject($registerPk){
        return \api\modules\pd\models\ProjectdtlsTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->leftJoin('industrymst_tbl', 'IndustryMst_Pk = prjd_industrymst_fk')
                ->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->andWhere("prjd_memberregmst_fk=:regPk and prjd_isdeleted = 2",[":regPk"=>$registerPk])
                ->orderBy('IndM_IndustryName ASC')
                ->asArray()
                ->all();
    }
    public function getindlistdtls(){
        return IndustrymstTbl::find()
                ->select(['IndustryMst_Pk','IndM_IndustryName'])
                ->where('IndM_Status = :IndM_Status',[':IndM_Status' => 'A'])
                ->orderBy('IndM_IndustryName ASC')
                ->asArray()
                ->all();
    }
    public static function getindustrylist()
    {
            $industrymodel=self::find()->select(['IndustryMst_Pk','IndM_IndustryName'])->where(['IndM_Status'=>'A'])->orderBy(['IndM_IndustryName' => SORT_ASC])->asArray()->all();
            // $query->orderBy(['licinvapplied_tbl.lia_createdon' => SORT_ASC]);


   
            return [
                'msg' => "success",
                'status' => 1,
                'items' => !empty($industrymodel)?$industrymodel:[],
                'total_count' =>count($industrymodel),

            ];

    }

}
