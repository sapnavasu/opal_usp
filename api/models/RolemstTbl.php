<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rolemst_tbl".
 *
 * @property int $rolemst_pk
 * @property int $rm_opalstkholdertypmst_fk Reference to opalstkholdertypmst_tbl
 * @property int $rm_projectmst_fk Reference to projectmst_pk
 * @property string $rm_rolename_en
 * @property string $rm_rolename_ar
 * @property string $rm_higherrole Reference to rolemst_tbl.rolemst_pk
 * @property int $rm_status 1-Active, 2-Inactive, 3-suspend if no more training providers allowed to register for the course approval
 * @property string $rm_createdon
 * @property int $rm_createdby
 * @property string $rm_updatedon
 * @property int $rm_updatedby
 *
 * @property ProjapprovalworkflowdtlsTbl[] $projapprovalworkflowdtlsTbls
 * @property RoleallocationdtlsTbl[] $roleallocationdtlsTbls
 * @property OpalstkholdertypmstTbl $rmOpalstkholdertypmstFk
 * @property ProjectmstTbl $rmProjectmstFk
 */
class RolemstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rolemst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rm_opalstkholdertypmst_fk', 'rm_rolename_en', 'rm_rolename_ar', 'rm_status', 'rm_createdby'], 'required'],
            [['rm_opalstkholdertypmst_fk', 'rm_projectmst_fk', 'rm_status', 'rm_createdby', 'rm_updatedby'], 'integer'],
            [['rm_higherrole'], 'string'],
            [['rm_createdon', 'rm_updatedon'], 'safe'],
            [['rm_rolename_en', 'rm_rolename_ar'], 'string', 'max' => 100],
            [['rm_opalstkholdertypmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => OpalstkholdertypmstTbl::className(), 'targetAttribute' => ['rm_opalstkholdertypmst_fk' => 'opalstkholdertypmst_pk']],
            [['rm_projectmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectmstTbl::className(), 'targetAttribute' => ['rm_projectmst_fk' => 'projectmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rolemst_pk' => 'Rolemst Pk',
            'rm_opalstkholdertypmst_fk' => 'Reference to opalstkholdertypmst_tbl',
            'rm_projectmst_fk' => 'Reference to projectmst_pk',
            'rm_rolename_en' => 'Rm Rolename En',
            'rm_rolename_ar' => 'Rm Rolename Ar',
            'rm_higherrole' => 'Reference to rolemst_tbl.rolemst_pk',
            'rm_status' => '1-Active, 2-Inactive, 3-suspend if no more training providers allowed to register for the course approval',
            'rm_createdon' => 'Rm Createdon',
            'rm_createdby' => 'Rm Createdby',
            'rm_updatedon' => 'Rm Updatedon',
            'rm_updatedby' => 'Rm Updatedby',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfohstyTbls()
    {
        return $this->hasMany(AppstaffinfohstyTbl::className(), ['appsih_mainrole' => 'rolemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfomainTbls()
    {
        return $this->hasMany(AppstaffinfomainTbl::className(), ['appsim_mainrole' => 'rolemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppstaffinfotmpTbls()
    {
        return $this->hasMany(AppstaffinfotmpTbl::className(), ['appsit_mainrole' => 'rolemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleallocationdtlsTbls()
    {
        return $this->hasMany(RoleallocationdtlsTbl::className(), ['rad_RoleMst_FK' => 'rolemst_pk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmOpalstkholdertypmstFk()
    {
        return $this->hasOne(OpalstkholdertypmstTbl::className(), ['opalstkholdertypmst_pk' => 'rm_opalstkholdertypmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRmProjectmstFk()
    {
        return $this->hasOne(ProjectmstTbl::className(), ['opalstkholdertypmst_pk' => 'rm_projectmst_fk']);
    }

    /**
     * {@inheritdoc}
     * @return RolemstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolemstTblQuery(get_called_class());
    }
    // role list and search
   public static function getUserroleList(){
    $requestParam = $_GET;
    $isfocalpoint =  \yii\db\ActiveRecord::getTokenData('oum_isfocalpoint', true);
    $userPk =  \yii\db\ActiveRecord::getTokenData('opalusermst_pk', true);
    ini_set ( 'max_execution_time', 1200);
    $query = self::find();
    $query ->select(['*','rm_opalstkholdertypmst_fk as stakeholdertype','rm_projectmst_fk as projecttype','proj.pm_projectname_en as projectname_en','proj.pm_projectname_ar as projectname_ar','rm_rolename_ar as rolename_ar',
    'rm_rolename_en as rolename_en','DATE_FORMAT(rm_createdon,"%d-%m-%Y") as addedOn','DATE_FORMAT(rm_updatedon,"%d-%m-%Y") as updatedOn','rm_status as status','rm_higherrole as higherRole'])
    ->leftJoin('projectmst_tbl proj','proj.projectmst_pk = rm_projectmst_fk');
        if($isfocalpoint == 2){
            $gethighrrole = \app\models\OpalusermstTbl::find()
            ->select(['group_concat(DISTINCT rm_higherrole) as highrole'])
            ->leftJoin("rolemst_tbl","find_in_set(rolemst_pk,oum_rolemst_fk)")
            ->where("opalusermst_pk=:userid",[':userid'=>$userPk])->groupBy("opalusermst_pk")->asArray()->one();
            if(!empty($gethighrrole) && !empty($gethighrrole['highrole'])){
                $notinhighrole = $gethighrrole['highrole'];
                $query->where("rolemst_pk not in ($notinhighrole)");
            }
        }
        if($requestParam['gridsearchValues'] != ''){
            $gridsearchValues = json_decode($requestParam['gridsearchValues'],true);              
            $stktypesearch = $gridsearchValues['stktypesearch'];
            $projectsearch = $gridsearchValues['projectsearch'];
            $rolesearch       = $gridsearchValues['rolesearch'];
            $highrolesearch = $gridsearchValues['highrolesearch'];
            $statussearch  = $gridsearchValues['statussearch'];
            $addedonsearch = $gridsearchValues['addedonsearch'];
           
            $updatedonsearch = $gridsearchValues['updatedonsearch'];    
            if($stktypesearch){ 
                if($stktypesearch == 1){
                    $query->andFilterWhere(['=', 'rm_opalstkholdertypmst_fk', $stktypesearch]);
                }elseif($stktypesearch == 2){
                   
                    $query->andFilterWhere(['or', ['rm_projectmst_fk' => NULL],['<>', 'rm_projectmst_fk', 4] ]);
                    $query->andFilterWhere(['=', 'rm_opalstkholdertypmst_fk', 2]);
                }elseif($stktypesearch == 3){
                     $query->andFilterWhere(['=', 'rm_opalstkholdertypmst_fk', 2]);
                    $query->andFilterWhere(['=', 'rm_projectmst_fk', 4]);  
                }
            }
            if($projectsearch){
                $query->andFilterWhere(['=', 'projectmst_pk', $projectsearch]);
            }
            if(!empty($highrolesearch)) {
                $query->andWhere("find_in_set(:highrolesearch,rm_higherrole)",[':highrolesearch'=>$highrolesearch]);
            }
            if($statussearch){
                $query->andFilterWhere(['LIKE', 'rm_status', $statussearch]);
            }
            if($rolesearch){
                $query->andFilterWhere(['LIKE', 'rm_rolename_en', $rolesearch]);
            }
            if($addedonsearch && $addedonsearch!=null){    
                //Submitted On Date Filter
               $dattime = date('Y-m-d',strtotime($addedonsearch));
               $query->andWhere(['=', 'DATE(rm_createdon)', $dattime]);         
            }    
            if($updatedonsearch && $updatedonsearch!=null ){  
                $dattime = date('Y-m-d',strtotime($updatedonsearch));
               $query->andWhere(['LIKE', 'DATE(rm_updatedon)', date('Y-m-d',strtotime($dattime))]);               
            }
        }
      $sort_column = (strpos($requestParam['sort'],"-") !== false) ? explode("-",$requestParam['sort'])[1] : $requestParam['sort'];
       $order_by = ($requestParam['order']=='asc')? 'asc': 'desc';
       $query->orderBy("$sort_column $order_by");
       $query->groupBy("rolemst_pk");
     
        $query->asArray();
        
        $page = (!empty($requestParam['size']) && $requestParam['size'] != 'undefined') ? $requestParam['size'] : 10 ;  
        $provider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $page,
                'page' => $requestParam['page']
            ]
        ]);
        $data = $provider->getModels();
        foreach ($data as $key => $favResData) {
            $gethigherrole = self::find()
                    ->select(['group_concat(DISTINCT rm_rolename_en separator ", ") as hgeren','group_concat(DISTINCT rm_rolename_ar separator ", ") as hgerar'])
                    ->where("find_in_set(rolemst_pk,:higherrole)",[':higherrole'=>$favResData['higherRole']])->asArray()->one();
            $data[$key]['higherrole_en'] = $gethigherrole['hgeren'];
            $data[$key]['higherrole_ar'] = $gethigherrole['hgerar'];
            $data[$key]['higherRolearr'] = explode(',', $favResData['higherRole']);
           }
        $response = array();
        $response['data'] = $data;
        $response['totalcount'] = $provider->getTotalCount();
        $response['size'] = $page;
        return $response;    
    }
    // check-is-role-already-exits
    public static function checkIsRoleAlreadyExit($dataToCheck,$stkholderType,$type)
    {
        if($type =='arrole'){
            return self::find()
            ->where('lower(rm_rolename_en) = :rolename', [':rolename' => $dataToCheck])
             ->andWhere(['=', 'rm_opalstkholdertypmst_fk', $stkholderType])
            ->exists();
        }else{
            return self::find()
            ->where('lower(rm_rolename_ar) = :rolenameAr', [':rolenameAr' => $dataToCheck])
             ->andWhere(['=', 'rm_opalstkholdertypmst_fk', $stkholderType])
            ->exists();
        }
    }
}
