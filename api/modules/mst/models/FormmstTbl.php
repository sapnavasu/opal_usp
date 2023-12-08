<?php

namespace api\modules\mst\models;

use app\filters\auth\HttpBearerAuth;
use Yii;
use app\commonfunction\Common;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\helpers\Url;
use yii\rbac\Permission;
use api\modules\mst\controllers\MasterController;

use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use api\modules\mst\models\FormmstTbl;
use app\modules\nbf\components\Profile;
use common\models\BasemodulemstTbl;
use \common\components\Security;



/**
 * This is the model class for table "formmst_tbl".
 *
 * @property int $formmst_pk Primary key
 * @property int $frm_globalportalmst_fk Reference to globalportalmst_tbl
 * @property string $frm_formname Form name
 * @property string $frm_formdesc Form description
 * @property array $frm_formtemplate Form Template
 * @property int $frm_stkholdertypmst_fk Reference to stkholdertypmst_tbl
 * @property int $frm_basemodulemst_fk Reference to basemodulemst_tbl
 * @property int $frm_status 1 - Active, 2 - Inactive
 * @property int $frm_isworkflowapprapplicable 1 - Yes, 2 - No
 * @property string $frm_createdon Datetime of creation
 * @property int $frm_createdby Reference to usermst_tbl
 * @property string $frm_createdbyipaddr IP Address of the user
 * @property string $frm_updatedon Datetime of updation
 * @property int $frm_updatedby Reference to usermst_tbl
 * @property string $frm_updatedbyipaddr IP Address of the user
 *
 * @property FormcategorymstTbl[] $formcategorymstTbls
 * @property BasemodulemstTbl $frmBasemodulemstFk
 * @property UsermstTbl $frmCreatedby
 * @property GlobalportalmstTbl $frmGlobalportalmstFk
 * @property UsermstTbl $frmUpdatedby
 * @property SuppcertformmembdtlsTbl[] $suppcertformmembdtlsTbls
 * @property SuppcertformmembtmpTbl[] $suppcertformmembtmpTbls
 */
class FormmstTbl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formmst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['frm_globalportalmst_fk', 'frm_stkholdertypmst_fk', 'frm_basemodulemst_fk', 'frm_status', 'frm_isworkflowapprapplicable', 'frm_createdby', 'frm_updatedby'], 'integer'],
            [['frm_formname', 'frm_formdesc', 'frm_basemodulemst_fk', 'frm_status', 'frm_isworkflowapprapplicable', 'frm_createdby'], 'required'],
            [['frm_formdesc'], 'string'],
            [['frm_formtemplate', 'frm_createdon', 'frm_updatedon'], 'safe'],
            [['frm_formname', 'frm_createdbyipaddr', 'frm_updatedbyipaddr'], 'string', 'max' => 50],
            [['frm_basemodulemst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => BasemodulemstTbl::className(), 'targetAttribute' => ['frm_basemodulemst_fk' => 'basemodulemst_pk']],
            [['frm_createdby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['frm_createdby' => 'UserMst_Pk']],
            [['frm_globalportalmst_fk'], 'exist', 'skipOnError' => true, 'targetClass' => GlobalportalmstTbl::className(), 'targetAttribute' => ['frm_globalportalmst_fk' => 'globalportalmst_pk']],
            [['frm_updatedby'], 'exist', 'skipOnError' => true, 'targetClass' => UsermstTbl::className(), 'targetAttribute' => ['frm_updatedby' => 'UserMst_Pk']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'formmst_pk' => 'Formmst Pk',
            'frm_globalportalmst_fk' => 'Frm Globalportalmst Fk',
            'frm_formname' => 'Frm Formname',
            'frm_formdesc' => 'Frm Formdesc',
            'frm_formtemplate' => 'Frm Formtemplate',
            'frm_stkholdertypmst_fk' => 'Frm Stkholdertypmst Fk',
            'frm_basemodulemst_fk' => 'Frm Basemodulemst Fk',
            'frm_status' => 'Frm Status',
            'frm_isworkflowapprapplicable' => 'Frm Is Work Flow Appr Applicable',
            'frm_createdon' => 'Frm Createdon',
            'frm_createdby' => 'Frm Createdby',
            'frm_createdbyipaddr' => 'Frm Createdbyipaddr',
            'frm_updatedon' => 'Frm Updatedon',
            'frm_updatedby' => 'Frm Updatedby',
            'frm_updatedbyipaddr' => 'Frm Updatedbyipaddr',
        ];
    }
    
    public static function getformdata($requestdata){
        $query = FormmstTbl::find();
        if($_REQUEST['type']=='filter')
        {
            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            foreach(array_filter($_REQUEST) as $key =>$val)
            {
                if(!is_null($val))
                {   
                    $query->andFilterWhere(['LIKE',Common::getTableWithPrefix($key, true),':'.$key, [':'.$key=>$val]]);
                }
            }
        }
        $query->select(['formmst_tbl.*','basemodulemst_tbl.bmm_name']);
        $query->leftJoin('basemodulemst_tbl','basemodulemst_pk=frm_basemodulemst_fk');
        $query->asArray();
        $page=(isset($_GET['size']))?$_GET['size']:default_page;
        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' =>$page]]);
        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' =>10,
        ];
    }
    public static function addformdata($data){
        $model = new FormmstTbl();
        $params=[];
        $frm_name=$data['formmaster']['FormName'];
        $check_form = FormmstTbl::find()->where(['like', 'frm_formname', $frm_name])->one();
        if($check_form){
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Form name already exists!',

            );
            return json_encode($result);
        }
        else{
        $status=($data['formmaster']['Status'] ==true)?1:2;
        $isworkflowapprapplicable=empty($data['formmaster']['isworkflowapprapplicable'])?false:$data['formmaster']['isworkflowapprapplicable'];
        $isworkflow=($isworkflowapprapplicable ==true)?1:2;
        $model->frm_status=$status;
        $model->frm_isworkflowapprapplicable=$isworkflow;
        $model->frm_formtemplate="{'sample':'sample'}";
        $model->frm_formname=$data['formmaster']['FormName'];
        $model->frm_formdesc=$data['formmaster']['FormDescription'];
        $model->frm_basemodulemst_fk=$data['formmaster']['Module'];
        $model->frm_createdon=date('Y:m:d H:i:s');
        $model->frm_createdby=\yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Created Successfully',
                'returndata' => $model->formmst_pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'Something went wrong',

            );
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);
    }

    }
    public static function deleteformdata($pk,$type){
        if($type ==1)
        {
            $model = FormcategorymstTbl::find()->where(['formcategorymst_pk'    =>  $pk])->one();
        }
        else{
            $model = \api\modules\mst\models\FormmstTbl::find()->where(['formmst_pk'    =>  $pk])->one();
            if(!empty($model))
            {
              $formctmodel=FormcategorymstTbl::deleteAll('fcm_formmst_fk=:formpk',[':formpk'=>$pk]);
            }
        }
        if ($model->delete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }else{
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(200);
            return "ok";
        }

    }
    public static function getformbyid($pk){
        $form = FormmstTbl::find()
            ->select(['formmst_tbl.*'])
            ->where(['formmst_pk'=>$pk])
            ->asArray()
            ->all();
        if($form){
            return $form;
        } else {
            throw new NotFoundHttpException("Object not found: $pk");
        }

    }
    public static function updateformdata($data){
        $pk = $data['formmaster']['update_formid'];
        $model = FormmstTbl::find()->where([
            'formmst_pk'    =>  $pk
        ])->one();
        $params=[];
        if($data['formmaster'])
        {
            $model->frm_formname=$data['formmaster']['FormName'];
            $model->frm_formdesc=$data['formmaster']['FormDescription'];
            $model->frm_basemodulemst_fk=$data['formmaster']['Module'];
            $status=($data['formmaster']['Status'] ==true)?1:2;
            $model->frm_status=$status;
        }
        $model->load($params, '');
        if ($model->validate() && $model->save()) {
            $result=array(
                'status' => 200,
                'statusmsg' => 'success','flag'=>'S',
                'msg'=>'Updated Successfully',
                'returndata' => $model->formmst_pk
            );
        } else {
            $result=array(
                'status' => 200,
                'statusmsg' => 'warning','flag'=>'E',
                'msg'=>'something went wrong',

            );
            throw new HttpException(422, json_encode($model->errors));
        }

        return json_encode($result);

}
public static function statuschange($data){
    if($data['updatestatus'])
        { 
            $model = FormmstTbl::find()->where([
                'formmst_pk'    =>  $data['updatestatus']
            ])->one();
            $status=($model->frm_status==1)?2:1;
            $model->frm_status = $status;
            $model->save();
        }
}

}
