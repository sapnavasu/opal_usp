<?php
namespace api\modules\ws\controllers;


use api\modules\pm\controllers\NbfMasterController;
use yii\web\Response;
use common\models\WorkspacemstTblQuery;
use common\models\WidgetsmstTblQuery;
use common\models\WorkspacemodulemstTblQuery;

class WorkspaceController extends NbfMasterController
{
    
    public $modelClass = 'common\models\MemcompprofcertfdtlsTbl';
    public $reg_id;
    public $companypk;
    public $userpk;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }

    public function beforeAction($action)
    {
        $reg_id = \yii\db\ActiveRecord::getTokenData('MemberRegMst_Pk',true);
        $companypk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userpk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
        self::setSession($reg_id,$companypk,$userpk);
        header('Content-type: application/json; charset=utf-8');
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * @param $reg_id
     * @param $companypk
     * @param $userpk
     */
    public function setSession($reg_id, $companypk, $userpk) {
        $this->reg_id = $reg_id;
        $this->companypk = $companypk;
        $this->userpk = $userpk;
    }


    /**
     * @param respective table fields
     * This method is used to insert single tables
     * @return Response
     */
    public function actionGetworkspacelist()
    {
        $workspaceList = WorkspacemstTblQuery::getWorkspaceList($this->getTokenData());
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $workspaceList
        ]);
    }

    /**
     * This action is used to get modules towards the workspace
     * @return Response
     */
    public function actionGetworkspacemodules(){
        $workspace_pk = filter_input(INPUT_GET,'workspace_pk',FILTER_SANITIZE_NUMBER_INT);
        $modules_pk = filter_input(INPUT_GET,'modules_pk',FILTER_SANITIZE_STRING);
        $modulesList = WorkspacemodulemstTblQuery::getWorkspaceModules($workspace_pk,$modules_pk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $modulesList
        ]);
    }

    public function actionGetwidgetsbymodules(){
        $workspace_pk = $_GET['workspace_pk'];
        $modulespk = $_GET['modules_pk'];
        $widgetsList = WidgetsmstTblQuery::getWidgetsByModules($modulespk,$workspace_pk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $widgetsList
        ]);
    }
    
    public function actionSaveworkspace(){ 
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true); 
        $workspace = $data['workspace'];
        $widgetArr = explode(",", $workspace['widgets_pk']);
        $modules = WidgetsmstTblQuery::getModulesByWidgetsPk($widgetArr);
        $workspace['modules_pk'] = $modules['modules'];
        
        if(isset($workspace['workspace_pk']) && !empty($workspace['workspace_pk'] && $workspace['workspacefor'] == 2)){ 
            $save_workspace_mst_tbl = WorkspacemstTblQuery::save_workspace_mst_tbl($workspace);
            $get_modules = WorkspacemstTblQuery::getModulesPkByWorkspace($workspace['workspace_pk']);
            $workspace['modules_pk'] = $get_modules['pk'];
            $save_workspace_trns_tbl = \common\models\WorkspacetrnsTblQuery::save_workspace_trns_tbl($workspace,$workspace['workspace_pk']);
        }elseif(isset($workspace['workspace_name']) && !empty($workspace['workspace_name'])){
            $save_workspace_mst_tbl = WorkspacemstTblQuery::save_workspace_mst_tbl($workspace);
            if($save_workspace_mst_tbl['status'] == 1){
                $save_workspace_trns_tbl = \common\models\WorkspacetrnsTblQuery::save_workspace_trns_tbl($workspace,$save_workspace_mst_tbl['workspace_pk']);
            }else{
                return $this->asJson([
                    "msg" => "something went wrong",
                    "status" => 0
                ]);
            }
        }elseif($workspace['workspacefor'] == 1){ 
            $save_workspace_trns_tbl = \common\models\WorkspacetrnsTblQuery::save_workspace_trns_tbl($workspace,$workspace['workspace_pk']);
        }
        return $this->asJson($save_workspace_trns_tbl);
    }
    
    public function actionGetuserworkspacelist(){
        $workspaceList = WorkspacemstTblQuery::getUserWorkspaceList($workspace_pk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $workspaceList
        ]);
    }
    
    public function actionGetworkspacedtls(){
        $workspace_pk = filter_input(INPUT_GET, 'workspace_pk',FILTER_SANITIZE_NUMBER_INT);
        $get_dtls = WorkspacemstTblQuery::getUserWorkspaceList($workspace_pk);
        $get_widgets_dtls = WidgetsmstTblQuery::getWidgetsByModules(null,$workspace_pk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "workspace_dtls" => $get_dtls,
            "widget_dtls" => $get_widgets_dtls
        ]);
    }
    
    public function actionDeleteworkspace(){
        $workspace_pk = filter_input(INPUT_GET, 'workspace_pk',FILTER_SANITIZE_NUMBER_INT);
        $delete = WorkspacemstTblQuery::delete_workspace($workspace_pk);
        if($delete){
            return $this->asJson([
                "msg" => "success",
                "status" => 1
            ]);
        }else{
            return $this->asJson([
                "msg" => "failure",
                "status" => 0
            ]);
        }
    }
    
    public function actionGetworkspacenames(){
        $workspaceName = $_GET['workspace_name'];
        $getWorkspaceNames = WorkspacemstTblQuery::getWorkspaceName($workspaceName);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => $getWorkspaceNames
        ]);
    }
    
    public function actionWorkspacewidgetslist(){
        $ws_widgetslist = WorkspacemstTblQuery::getWorkspaceAndWidgets($this->userpk);
        return $this->asJson([
            "msg" => "success",
            "status" => 1,
            "items" => !empty($ws_widgetslist)?$ws_widgetslist:[]
        ]);
    }
    
    public function actionSaveworkspacepermission(){
        $widgets_pk = $_GET['widgets_pk']; 
        $saveWsPermission = \common\models\WorkspacepermissionTblQuery::insertWorkspacePermission($widgets_pk,$this->userpk);
        return $this->asJson($saveWsPermission);
    }
    
    public function actionGetworkspacepermission(){
        $getWsPermission = \common\models\WorkspacepermissionTblQuery::getWorkspacePermission($this->userpk);
        return $this->asJson($getWsPermission);
    }
}
