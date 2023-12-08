<?php

namespace api\modules\mst\models;

use common\components\Common;
use common\components\Security;
use common\models\DepartmentmstTbl;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use function GuzzleHttp\Promise\all;

/**
 * This is the model class for table "formcategorymst_tbl".
 *
 * @property int $formcategorymst_pk Primary key
 * @property int $fcm_formmst_fk Reference to formmst_tbl
 * @property string $fcm_categoryname Category Name
 * @property string $fcm_categorydesc Category description
 * @property int $fcm_sortorder Sorting order
 * @property int $fcm_status 1 - Active, 2 - InActive
 * @property array $fcm_catformtemplate Dynamic category form template
 * @property string $fcm_createdon Datetime of creation
 * @property int $fcm_createdby Reference to usermst_tbl
 * @property string $fcm_createdbyipaddr IP Address of the user
 * @property string $fcm_updatedon Datetime of updation
 * @property int $fcm_updatedby Reference to usermst_tbl
 * @property string $fcm_updatedbyipaddr IP Address of the user
 */
define(default_page_size,10);
class FormcategorymstTbl extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formcategorymst_tbl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fcm_formmst_fk', 'fcm_categoryname', 'fcm_categorydesc', 'fcm_sortorder', 'fcm_status'], 'required'],
            [['fcm_formmst_fk', 'fcm_sortorder', 'fcm_status', 'fcm_createdby', 'fcm_updatedby'], 'integer'],
            [['fcm_categorydesc'], 'string'],
            [['fcm_createdon', 'fcm_updatedon'], 'safe'],
            [['fcm_categoryname'], 'string', 'max' => 50],
            [['fcm_createdbyipaddr', 'fcm_updatedbyipaddr'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'formcategorymst_pk' => 'Formcategorymst Pk',
            'fcm_formmst_fk' => 'Fcm Formmst Fk',
            'fcm_categoryname' => 'Fcm Categoryname',
            'fcm_categorydesc' => 'Fcm Categorydesc',
            'fcm_sortorder' => 'Fcm Sortorder',
            'fcm_status' => 'Fcm Status',
            'fcm_catformtemplate' => 'Fcm Catformtemplate',
            'fcm_createdon' => 'Fcm Createdon',
            'fcm_createdby' => 'Fcm Createdby',
            'fcm_createdbyipaddr' => 'Fcm Createdbyipaddr',
            'fcm_updatedon' => 'Fcm Updatedon',
            'fcm_updatedby' => 'Fcm Updatedby',
            'fcm_updatedbyipaddr' => 'Fcm Updatedbyipaddr',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FormcategorymstTblQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormcategorymstTblQuery(get_called_class());
    }

    public static function addcategory()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $save_data = $error = [];
        $token_data = \Yii\db\ActiveRecord::getTokenData();
        $user_pk = $token_data->UserMst_Pk;
        $transcation = Yii::$app->db->beginTransaction();
        if (!empty($data)) {
            $save_data['CatName'] = Security::sanitizeInput($data['formmaster']['CatName'], 'string_spl_char');
            $save_data['CatDescription'] = Security::sanitizeInput($data['formmaster']['CatDescription'], 'string_spl_char');
            $save_data['update_formid'] = !empty($data['formmaster']['update_formid']) ? Security::decrypt($data['formmaster']['update_formid']) : '';
            $save_data['Status'] = Security::sanitizeInput($data['formmaster']['Status'], 'string');
            $save_data['Form_pk'] = Security::sanitizeInput($data['formmaster']['Form_pk'], 'number');
            $final_status = !empty($save_data['Status']) ? 1 : 0;
            $insert_or_edit_model = new FormcategorymstTbl();
            $msg = 'Created';
            $order_model = FormcategorymstTbl::find()->where('fcm_formmst_fk=:formpk', ['formpk' => $save_data['Form_pk']])->orderBy('formcategorymst_pk desc')->one();
            $order_model_id = $order_model->fcm_sortorder + 1;
            if (empty($order_model)) {
                $order_model_id = 0;
            }
            if (!empty($save_data['update_formid'])) {
                $msg = 'Updated';
                $insert_or_edit_model = FormcategorymstTbl::findOne($save_data['update_formid']);
                $insert_or_edit_model->fcm_updatedby = $user_pk;
                $insert_or_edit_model->fcm_updatedbyipaddr = Common::getIpAddress();
            }
            $insert_or_edit_model->fcm_categoryname = $save_data['CatName'];
            $insert_or_edit_model->fcm_categorydesc = $save_data['CatDescription'];
            $insert_or_edit_model->fcm_formmst_fk = $save_data['Form_pk'];
            $insert_or_edit_model->fcm_sortorder = $order_model_id;
            $insert_or_edit_model->fcm_status = $final_status;
            $insert_or_edit_model->fcm_updatedon = date('Y-m-d H:i:s');
            $insert_or_edit_model->fcm_createdby = $user_pk;
            $insert_or_edit_model->fcm_createdbyipaddr = Common::getIpAddress();
            $insert_or_edit_model->fcm_catformtemplate = '{}';
            try {
                $insert_or_edit_model->save('false');
                $transcation->commit();
                $result = array('status' => 200, 'statusmsg' => 'success', 'flag' => 'S', 'msg' => "Form Category $msg Successfully", 'returndata' => Security::encrypt($insert_or_edit_model->formcategorymst_pk));
            } catch (Exception $exception) {
                $error[] = $exception->getMessage();
                $transcation->rollBack();
            }
        }
        return !empty($error) ? $error : $result;
    }

    public static function getcatformlist()
    {

        $query = FormcategorymstTbl::find();
        $cat_is_or_not = isset($_REQUEST['category']) ? Security::decrypt($_REQUEST['category']) : '';
        if ($_REQUEST['type'] == 'filter') {
//            $_REQUEST['sort'] = Security::sanitizeInput($_REQUEST['sort'], "string");
//            $_REQUEST['order'] = Security::sanitizeInput($_REQUEST['order'], "string");
//            $_REQUEST['page'] = Security::sanitizeInput($_REQUEST['page'], "number");
//            $_REQUEST['size'] = Security::sanitizeInput($_REQUEST['size'], "number");
//            $_REQUEST['filter'] = Security::sanitizeInput($_REQUEST['filter'], "string");
//            $_REQUEST['fcm_formmst_fk'] = Security::sanitizeInput($_REQUEST['fcm_formmst_fk'], "number");
//            $_REQUEST['fcm_categoryname'] = Security::sanitizeInput($_REQUEST['fcm_categoryname'], "string");
//            $_REQUEST['fcm_categorydesc'] = Security::sanitizeInput($_REQUEST['fcm_categorydesc'], "string");
//            $status=$_REQUEST['fcm_status'] = Security::sanitizeInput($_REQUEST['fcm_status'], "string");

            unset($_REQUEST['type']);
            unset($_REQUEST['sort']);
            unset($_REQUEST['order']);
            unset($_REQUEST['page']);
            unset($_REQUEST['size']);
            unset($_REQUEST['category']);

            foreach ($_REQUEST as $key => $val) {
                if (!is_null($val)) {
                    $query->andFilterWhere(['LIKE', \app\commonfunction\Common::getTableWithPrefix($key, true), ':' . $key, [':' . $key => $val]]);
                }
            }
        }
        $query->select(['formcategorymst_tbl.*', 'formmst_tbl.frm_formname','basemodulemst_tbl.bmm_name']);
        $query->leftJoin('formmst_tbl', 'formmst_pk=fcm_formmst_fk');
        $query->leftJoin('basemodulemst_tbl','basemodulemst_pk=formmst_tbl.frm_basemodulemst_fk');
        $query->orderBy(['COALESCE(fcm_createdon,fcm_updatedon)' => SORT_DESC]);
        $query->asArray();
        $page = (isset($_GET['size'])) ? $_GET['size'] : default_page_size;

        $provider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => $page]]);
        if (!empty($cat_is_or_not)) {
            $query->where('fcm_formmst_fk=:form', [':form' => $cat_is_or_not]);
            $query->orderBy(['fcm_sortorder' => SORT_ASC]);
            $provider = new ActiveDataProvider(['query' => $query, 'pagination' => false]);
        }

        return [
            'items' => $provider->getModels(),
            'total_count' => $provider->getTotalCount(),
            'limit' => 10,
        ];
    }

    public static function reorderform()
    {

        $request_body = file_get_contents('php://input');
        $data_order = json_decode($request_body, true);
        $save_arr=['status'=>'S','msg'=>'Category form ordered successfully'];
        if (!empty($data_order['datasource_ids'])) {
            $list_of_string_ids = explode(',',$data_order['datasource_ids']);
            foreach ($list_of_string_ids as $key => $val) {
                $cat_form = self::findOne($val);
                $cat_form->fcm_sortorder = $key + 1;
                if (!$cat_form->save('false')) {
                    $error[] = $cat_form->getErrors();
                }
            }
        }
        return !empty($error)?$error:$save_arr;
    }
}
