<?php

namespace api\modules\mst\models;
use \common\models\UsermstTbl;
use \api\modules\mst\models\GcccpvmstTbl;

use Yii;
use yii\data\ActiveDataProvider;
use \common\components\Security;

/**
 * This is the model class for table "gcccategorymst_tbl".
 *
 * @property int $gcccategorymst_pk Primary key
 * @property int $gcm_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $gcm_categcode Category Code
 * @property string $gcm_categname Category Name
 * @property int $gcm_status If the Sector is active or not. Active - 1, Inactive – 2
 * @property string $gcm_createdon Date of creation
 * @property int $gcm_createdby Reference to usermst_tbl
 * @property string $gcm_createdbyipaddr IPAddress of the user
 *
 * @property UsermstTbl $gcmCreatedby
 * @property GlobalportalmstTbl $gcmGlobalportalmstFk
 * @property GcccpvmstTbl[] $gcccpvmstTbls
 */
class GcccategorymstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcccategorymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gcm_globalportalmst_fk', 'gcm_status', 'gcm_createdby'], 'integer'],
            [['gcm_categcode', 'gcm_categname'], 'required'],
            [['gcm_createdon'], 'safe'],
            [['gcm_categcode'], 'string', 'max' => 10],
            [['gcm_categname', 'gcm_createdbyipaddr'], 'string', 'max' => 50],
            [['gcm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['gcm_createdby' => 'UserMst_Pk']],
            [['gcm_globalportalmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GlobalportalmstTbl::className(), 'targetAttribute' => ['gcm_globalportalmst_fk' => 'globalportalmst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcccategorymst_pk' => 'Gcccategorymst Pk',
            'gcm_globalportalmst_fk' => 'Gcm Globalportalmst Fk',
            'gcm_categcode' => 'Gcm Categcode',
            'gcm_categname' => 'Gcm Categname',
            'gcm_status' => 'Gcm Status',
            'gcm_createdon' => 'Gcm Createdon',
            'gcm_createdby' => 'Gcm Createdby',
            'gcm_createdbyipaddr' => 'Gcm Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGcmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'gcm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGcmGlobalportalmstFk()
    {
        return $this->hasOne(GlobalportalmstTbl::className(), ['globalportalmst_pk' => 'gcm_globalportalmst_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGcccpvmstTbls()
    {
        return $this->hasMany(GcccpvmstTbl::className(), ['gcpvm_gcccategorymst_fk' => 'gcccategorymst_pk']);
    }

    public function saveCategory($save, $cppvPk=''){
        $ret = 1; // Success
        $checkCodeQuery = GcccategorymstTbl::find()
                        ->where(['gcm_categcode'=>$save['cppvCode']])
                        ->andWhere(['<>','gcm_status',3]);
        if($cppvPk > 0){
            $checkCodeQuery->andWhere(['<>','gcccategorymst_pk',$cppvPk]);
        }
        $checkCode = $checkCodeQuery->one();

        $checkNameQuery = GcccategorymstTbl::find()
                        ->where(['gcm_categname'=>$save['cppvName']])
                        ->andWhere(['<>','gcm_status',3]);
        if($cppvPk > 0){
            $checkNameQuery->andWhere(['<>','gcccategorymst_pk',$cppvPk]);
        }
        $checkName = $checkNameQuery->one();

        if(empty($checkCode) && empty($checkName)){
            if(!empty($cppvPk)){
                $Gcccategorymst = GcccategorymstTbl::find()
                                    ->where(['gcccategorymst_pk'=>$cppvPk])
                                    ->one();
                if(!empty($Gcccategorymst)){
                }else{
                    $ret = 2; // No Data available
                }
            }else{
                $Gcccategorymst = new GcccategorymstTbl();
                $Gcccategorymst->gcm_createdon = date('Y-m-d H:i:s');
                $Gcccategorymst->gcm_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $Gcccategorymst->gcm_createdbyipaddr = \common\components\Common::getIpAddress();
            }

            if($ret == 1){
                $Gcccategorymst->gcm_categcode = $save['cppvCode'];
                $Gcccategorymst->gcm_categname = $save['cppvName'];
                $Gcccategorymst->gcm_status = $save['cppvStatus'];

                if(!$Gcccategorymst->save()){
                    $ret = 3; // Db Error
                }
            }
        }else{
            if(!empty($checkCode) && !empty($checkName)){
                $ret = 4; // Both are available
            }elseif(!empty($checkCode)){
                $ret = 5; // Code Available
            }elseif(!empty($checkName)){
                $ret = 6; // Name Available
            }
        }
        return $ret;
    }

    public function getAllActiveCategory(){
        $Gcccategorymst = GcccategorymstTbl::find()
                            ->select([
                                'gcccategorymst_pk as categoryPk',
                                'gcm_categname as categoryName'
                            ])
                            ->where(['gcm_status'=>1])
                            ->orderBy(['gcm_categname'=>SORT_ASC])
                            ->asArray()
                            ->all();
        return $Gcccategorymst;
    }

    public function getCppvListData($cppvParams){
        $sortColumn = (isset($cppvParams['sort_column']) && !empty($cppvParams['sort_column']))?$cppvParams['sort_column']:'created_on';

        $GcccategoryQuery = GcccategorymstTbl::find()
                            ->select([
                                'gcccategorymst_pk as pk',
                                'gcm_categcode as cppvCode',
                                'gcm_categname as cppvName',
                                "if(gcccategorymst_pk,'Root','') as refName",
                                'gcccategorymst_pk as refPk',
                                'gcm_status as cppvStatus',
                                'gcm_createdon as created_on'
                            ])
                            ->where(['<>','gcm_status',3]);
        if(isset($cppvParams['CPVCategory']) && !empty($cppvParams['CPVCategory'])){
            $GcccategoryQuery->andWhere(['LIKE','gcm_categname',$cppvParams['CPVCategory']]);
        }
        if(isset($cppvParams['Category']) && !empty($cppvParams['Category'])){
            $GcccategoryQuery->andWhere(['LIKE','gcm_categcode',$cppvParams['Category']]);
        }
        if(isset($cppvParams['status']) && !empty($cppvParams['status'])){
            $GcccategoryQuery->andWhere(['gcm_status'=>$cppvParams['status']]);
        }
        if(isset($cppvParams['SelectRootCategory']) && (!empty($cppvParams['SelectRootCategory']) && $cppvParams['SelectRootCategory'] !='root')){
            $GcccategoryQuery->andWhere(['gcccategorymst_pk'=>$cppvParams['SelectRootCategory']]);
        }
        $GcccategoryQ1 = $GcccategoryQuery->asArray();

        $GcccpvmstQuery = GcccpvmstTbl::find()
                            ->select([
                                'gcccpvmst_pk as pk',
                                'gcpvm_cpvcode as cppvCode',
                                'gcpvm_cpvdetails as cppvName',
                                'gcm_categname as refName',
                                'gcpvm_gcccategorymst_fk as refPk',
                                'gcpvm_status as cppvStatus',
                                'gcpvm_createdon as created_on'
                            ])
                            ->leftJoin('gcccategorymst_tbl','gcpvm_gcccategorymst_fk = gcccategorymst_pk')
                            ->where(['<>','gcpvm_status',3]);
        if(isset($cppvParams['CPVCategory']) && !empty($cppvParams['CPVCategory'])){
            $GcccpvmstQuery->andWhere(['LIKE','gcpvm_cpvdetails',$cppvParams['CPVCategory']]);
        }
        if(isset($cppvParams['Category']) && !empty($cppvParams['Category'])){
            $GcccpvmstQuery->andWhere(['LIKE','gcpvm_cpvcode',$cppvParams['Category']]);
        }
        if(isset($cppvParams['status']) && !empty($cppvParams['status'])){
            $GcccpvmstQuery->andWhere(['gcpvm_status'=>$cppvParams['status']]);
        }
        if(isset($cppvParams['SelectRootCategory']) && !empty($cppvParams['SelectRootCategory'])){
            $GcccpvmstQuery->andWhere(['gcpvm_gcccategorymst_fk'=>$cppvParams['SelectRootCategory']]);
        }
        $GcccategoryQ2 = $GcccpvmstQuery->asArray();

        if(isset($cppvParams['SelectRootCategory']) && $cppvParams['SelectRootCategory'] > 0){
            $unionQuery = $GcccategoryQ2->orderBy([ "{$sortColumn}" => $cppvParams['sort_type']]);
        }else{
            $unionQuery = (new \yii\db\Query())
                        ->from(['dummy_name' => $GcccategoryQ1->union($GcccategoryQ2)])
                        ->orderBy([ "{$sortColumn}" => $cppvParams['sort_type']]);
        }

        $cppvProvider = new ActiveDataProvider(
                        [
                            'query' => $unionQuery, 
                            'pagination' => [
                                'pageSize' =>$cppvParams['size'],
                                'page'=>$cppvParams['page']
                            ]
                        ]
                    );

        $cppvRes['data'] = $cppvProvider->getModels();
        $cppvRes['totalcount'] = $cppvProvider->getTotalCount();
        $cppvRes['size'] = $cppvParams['size'];
        $cppvRes['page'] = $cppvParams['page'];
        return $cppvRes;
    }

    public function updateStatus($cppvStatus, $cppvPk, $categoryPk){
        $ret = 1; // success

        /*$subCatStatus = GcccpvmstTbl::checkAllSUbcategoryStatus($cppvPk);
        if(empty($subCatStatus) || $cppvStatus == 1){*/
            $Gcccategorymst = GcccategorymstTbl::find()
                                ->where(['gcccategorymst_pk'=>$cppvPk])
                                ->one();

            if(!empty($Gcccategorymst)){
                $Gcccategorymst->gcm_status = $cppvStatus;
                if(!$Gcccategorymst->save()){
                    $ret = 3; // Database error
                }
            }else{
                $ret = 2; // No data available
            }
        /*}else{
            $ret = 4; // Some Subcategory status are active
        }*/
        return $ret;
    }

    public function checkCategoryStatus($categoryPk){
        $Gcccategory = GcccategorymstTbl::find()
                        ->where(['gcccategorymst_pk'=>$categoryPk, 'gcm_status'=> 1])
                        ->one();
        return $Gcccategory;
    }

    public function deleteCategory($cppvPk){
        $ret = 1;
        /*$checkSubcatgoryCount = GcccpvmstTbl::checkSubcatgoryCount($cppvPk);*/

        /*if(empty($checkSubcatgoryCount)){*/
            $categoryResult = GcccategorymstTbl::find()
                            ->where(['gcccategorymst_pk'=>$cppvPk])
                            ->one();
            if(!empty($categoryResult)){
                $categoryResult->gcm_status = 3;
                if($categoryResult->save()){
                }else{
                     $ret = 3; // Database error
                }
            }else{
                $ret = 2; // No data available
            }
        /*}else{
            $ret = 4; //Some subcategory available
        }*/
        return $ret;
    }

    public function fetchCategory($cppvPk){
        $Gcccategory = GcccategorymstTbl::find()
                        ->select([
                            'gcccategorymst_pk as cppvPk',
                            "if(gcccategorymst_pk,'root','') as categoryFk",
                            'gcm_categcode as cppvCode',
                            'gcm_categname as cppvName',
                            'gcm_status as cppvStatus'
                        ])
                        ->where(['gcccategorymst_pk'=>$cppvPk])
                        ->asArray()->one();
        return $Gcccategory;
    }
}
