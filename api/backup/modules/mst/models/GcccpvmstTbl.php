<?php

namespace api\modules\mst\models;
use \common\models\UsermstTbl;
use Yii;
use \api\modules\mst\models\GcccategorymstTbl;

/**
 * This is the model class for table "gcccpvmst_tbl".
 *
 * @property int $gcccpvmst_pk Primary key
 * @property int $gcpvm_gcccategorymst_fk Reference to gcccategorymst_tbl
 * @property string $gcpvm_cpvcode CPV Code
 * @property string $gcpvm_cpvdetails CPV Description
 * @property int $gcpvm_status Status. 1 - Active, 2 - InActive
 * @property string $gcpvm_createdon Date of creation
 * @property int $gcpvm_createdby Reference to usermst_tbl
 * @property string $gcpvm_createdbyipaddr IPAddress of the user
 *
 * @property UsermstTbl $gcpvmCreatedby
 * @property GcccategorymstTbl $gcpvmGcccategorymstFk
 */
class GcccpvmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gcccpvmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gcpvm_gcccategorymst_fk', 'gcpvm_cpvcode', 'gcpvm_cpvdetails', 'gcpvm_status'], 'required'],
            [['gcpvm_gcccategorymst_fk', 'gcpvm_status', 'gcpvm_createdby'], 'integer'],
            [['gcpvm_cpvdetails'], 'string'],
            [['gcpvm_createdon'], 'safe'],
            [['gcpvm_cpvcode'], 'string', 'max' => 10],
            [['gcpvm_createdbyipaddr'], 'string', 'max' => 50],
            [['gcpvm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['gcpvm_createdby' => 'UserMst_Pk']],
            [['gcpvm_gcccategorymst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GcccategorymstTbl::className(), 'targetAttribute' => ['gcpvm_gcccategorymst_fk' => 'gcccategorymst_pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gcccpvmst_pk' => 'Gcccpvmst Pk',
            'gcpvm_gcccategorymst_fk' => 'Gcpvm Gcccategorymst Fk',
            'gcpvm_cpvcode' => 'Gcpvm Cpvcode',
            'gcpvm_cpvdetails' => 'Gcpvm Cpvdetails',
            'gcpvm_status' => 'Gcpvm Status',
            'gcpvm_createdon' => 'Gcpvm Createdon',
            'gcpvm_createdby' => 'Gcpvm Createdby',
            'gcpvm_createdbyipaddr' => 'Gcpvm Createdbyipaddr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGcpvmCreatedby()
    {
        return $this->hasOne(UsermstTbl::className(), ['UserMst_Pk' => 'gcpvm_createdby']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGcpvmGcccategorymstFk()
    {
        return $this->hasOne(GcccategorymstTbl::className(), ['gcccategorymst_pk' => 'gcpvm_gcccategorymst_fk']);
    }

    public function saveSubcategory($save, $cppvPk=''){
        $ret = 1; // Success
        $checkCodeQuery = GcccpvmstTbl::find()
                        ->where(['gcpvm_cpvcode'=>$save['cppvCode']])
                        ->andWhere(['<>','gcpvm_status',3]);
        if($cppvPk > 0){
            $checkCodeQuery->andWhere(['<>','gcccpvmst_pk',$cppvPk]);
        }
        $checkCode = $checkCodeQuery->one();

        $checkNameQuery = GcccpvmstTbl::find()
                        ->where(['gcpvm_cpvdetails'=>$save['cppvName']])
                        ->andWhere(['<>','gcpvm_status',3]);
        if($cppvPk > 0){
            $checkNameQuery->andWhere(['<>','gcccpvmst_pk',$cppvPk]);
        }
        $checkName = $checkNameQuery->one();

        if(empty($checkCode) && empty($checkName)){
            if(!empty($cppvPk)){
                $Gcccategorymst = GcccpvmstTbl::find()
                                    ->where(['gcccpvmst_pk'=>$cppvPk])
                                    ->one();
                if(!empty($Gcccategorymst)){
                }else{
                    $ret = 2; // No Data available
                }
            }else{
                $Gcccategorymst = new GcccpvmstTbl();
                $Gcccategorymst->gcpvm_createdon = date('Y-m-d H:i:s');
                $Gcccategorymst->gcpvm_createdby = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
                $Gcccategorymst->gcpvm_createdbyipaddr = \common\components\Common::getIpAddress();
            }

            if($ret == 1){
                $Gcccategorymst->gcpvm_gcccategorymst_fk = $save['cppvFk'];
                $Gcccategorymst->gcpvm_cpvcode = $save['cppvCode'];
                $Gcccategorymst->gcpvm_cpvdetails = $save['cppvName'];
                $Gcccategorymst->gcpvm_status = $save['cppvStatus'];

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

    public function updateStatus($cppvStatus, $cppvPk, $categoryPk){
        $ret = 1; // success
        $categoryStatus = GcccategorymstTbl::checkCategoryStatus($categoryPk);

        if(!empty($categoryStatus) || $cppvStatus == 2){
            $GcccpvmstTbl = GcccpvmstTbl::find()
                                ->where(['gcccpvmst_pk'=>$cppvPk])
                                ->one();

            if(!empty($GcccpvmstTbl)){
                $GcccpvmstTbl->gcpvm_status = $cppvStatus;
                if(!$GcccpvmstTbl->save()){
                    $ret = 3; // Database error
                }
            }else{
                $ret = 2; // No data available
            }
        }else{
            $ret = 5; // Category is Inactive
        }
        return $ret;
    }

    public function updateStatusByCatId($cppvStatus, $cppvPk){
        $ret = 1; // success

        $GcccpvmstTbl = GcccpvmstTbl::find()
                            ->where(['gcpvm_gcccategorymst_fk'=>$cppvPk])
                            ->all();

        foreach ($GcccpvmstTbl as $key => $Gcccpvmst) {
            $Gcccpvmst->gcpvm_status = $cppvStatus;
            if(!$Gcccpvmst->save()){
                $ret = 3; // Database error
            }
        }

        return $ret;
    }

    public function checkAllSUbcategoryStatus($cppvPk){
        $Gcccpvmst = GcccpvmstTbl::find()
                        ->where(['gcpvm_gcccategorymst_fk'=>$cppvPk, 'gcpvm_status'=>1])
                        ->all();
        return $Gcccpvmst;
    }

    public function deleteSubCategory($cppvPk){
        $ret = 1;
        $subcategoryResult = GcccpvmstTbl::find()
                        ->where(['gcccpvmst_pk'=>$cppvPk])
                        ->one();
        if(!empty($subcategoryResult)){
            $subcategoryResult->gcpvm_status = 3;
            if($subcategoryResult->save()){
            }else{
                 $ret = 3; // Database error
            }
        }else{
            $ret = 2; // No data available
        }
        return $ret;
    }

    public function deleteSubCategoryByCatid($cppvPk){
        $subcategoryResult = GcccpvmstTbl::find()
                        ->where(['gcpvm_gcccategorymst_fk'=>$cppvPk])
                        ->all();
        foreach ($subcategoryResult as $key => $subcategory) {
            $subcategory->gcpvm_status = 3;
            if($subcategory->save()){
            }
        }
    }

    public function checkSubcatgoryCount($cppvPk){
        $Gcccpvmst = GcccpvmstTbl::find()
                        ->where(['gcpvm_gcccategorymst_fk'=>$cppvPk])
                        ->andWhere(['<>','gcpvm_status',3])
                        ->all();
        return $Gcccpvmst;
    }

    public function checkSubcatgoryActiveCount($cppvPk){
        $Gcccpvmst = GcccpvmstTbl::find()
                        ->where(['gcpvm_gcccategorymst_fk'=>$cppvPk,'gcpvm_status'=>1])
                        ->all();
        return $Gcccpvmst;
    }

    public function fetchSubCategory($cppvPk){
        $Gcccpvmst = GcccpvmstTbl::find()
                        ->select([
                            'gcccpvmst_pk as cppvPk',
                            'gcpvm_gcccategorymst_fk as categoryFk',
                            'gcpvm_cpvcode as cppvCode',
                            'gcpvm_cpvdetails as cppvName',
                            'gcpvm_status as cppvStatus'
                        ])
                        ->where(['gcccpvmst_pk'=>$cppvPk])
                        ->asArray()->one();
        return $Gcccpvmst;
    }
}
