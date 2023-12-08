<?php

namespace api\modules\drv\controllers;

use api\modules\mst\controllers\MasterController;
use Yii;
use api\components\Common;
use yii\filters\auth\CompositeAuth;
use common\components\Configsession;
use common\components\Sessionn;
use api\modules\pm\controllers\NbfMasterController;
use yii\web\Response;
use app\modules\nbf\models\MemcompprofcertfdtlsTbl;
use app\filters\auth\HttpBearerAuth;
use \api\components\Security;

class DriveController extends MasterController
{
    public $modelClass = 'common\models\MemcompprofcertfdtlsTbl';

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }

    public function actions()
    {
        return [];
    }
    
     public function behaviors()
    {
		
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'only'=>['list','add','filemst','upload','datatoimage','mapreference','removereference'],
            'class' => \yii\filters\ContentNegotiator::className(),
             'formats' => [
                 'application/json' => \yii\web\Response::FORMAT_JSON,
             ],
        ];
        return $behaviors;
    }

    public function beforeAction($action)
    {
        header("access-control-allow-origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        if (!parent::beforeAction($action)) {
            return false;
        }
        return true;
    }
    /**
     * @param respective table fields
     * This method is used to insert single tables
     */
    public function actionList($directory)
    {
       //  print_r($directory); 
        $companyPk = \yii\db\ActiveRecord::getTokenData('MemberCompMst_Pk',true);
        $userPk = \yii\db\ActiveRecord::getTokenData('UserMst_Pk',true);
         $srcDirectory=Yii::$app->params['srcDirectory']; 
        $userDirectory="comp_".$companyPk."/user_".$userPk;
        $uploadPath=  \Yii::$app->params['uploadPath'];
        $dir = $srcDirectory.$uploadPath."/".$userDirectory. '/' . $directory;
        $resultList = array(); //main array
        $fileList = array(); //main array
        $folderList = array(); //main array
       
        $addedToday= \api\models\MemcompfiledtlsTbl::addedToday();
        $totalUploads= \api\models\MemcompfiledtlsTbl::totalUploads();
	
		 
        if (!is_dir($dir)) {
            mkdir($dir);
        }
	//	print_r($dir); 
        if ($dh = opendir($dir)) {
			//echo "step1";
            while (($file = readdir($dh)) != false) {	//echo "step2";

                if ($file == "." or $file == "..") {// echo "step3";
                    //...
                } else { //create object with two fields 
					//echo "step4";
                    if (is_dir($dir . '/' . $file)) {
                        $folder = array(
                            'folderName' => $file,
                            'folderSize' => \app\commonfunction\Util::formatSizeUnits(filesize($file)),
                            'folderModified' => filemtime($file),
                            'folderDisabled' => false);
                        $folderList[] = $folder;
                    } else {
                        $fileDataMst = explode('[[]]', $file);
                        $filePk=explode(".",$fileDataMst[2]);
                        $fileData = explode('_', $fileDataMst[0]);
                            $fileDetails = pathinfo($file);
								$fileDtlsPk=$filePk[0];
								$userPk=$userPk;
								$companyPk=$companyPk;
								$link=\common\components\Drive::generateUrl($fileDtlsPk, $companyPk, $userPk);
                            $list = array(
                                'filePk' => $filePk[0],
                                'fileName' => $fileDataMst[0],
                                'fileType' => $fileDetails['extension'],
                                'fileSize' => \app\commonfunction\Util::formatSizeUnits(filesize($dir . '/' . $file)),
                                'fileModified' => filemtime($file),
                                'fileUrl' => $link
                            );

                            $fileList[] = $list;
                        }

                }
            }
            $resultList['files'] = $fileList;
            $resultList['folders'] = $folderList;
            $resultList['uploadedToday'] = $addedToday;
            $resultList['totalDocument'] = $totalUploads;
        }
    // print_r($resultList);exit;
        return json_encode($resultList);
    }

    public function actionAdd($newDirectory)
    {
        if (!file_exists($newDirectory)) {
            mkdir($newDirectory, 0777, true);
        }
        return json_encode(['success']);
    }

	public function actionFilemst()
    {
		$postVar = Yii::$app->request->getRawBody();
		$params = json_decode($postVar);
		$resParam = $params->postParams;
		$fileTemplate=\api\modules\drv\models\FilemstTbl::find()->filee($resParam->fileRefNo);
		$selectedPks=array_values($resParam->selectedPks);
		
		$fileTemplate['selected_files']=\api\models\MemcompfiledtlsTbl::uploadedModuleByField($resParam->fileRefNo,$selectedPks);
		
		return json_encode($fileTemplate);
    }
    public function actionUpload() 
    {   
        $key = $_REQUEST['key'];  
         $filename = $_REQUEST['file_name'];  
		  $fileTemplate=\api\modules\drv\models\FilemstTbl::find()->filee($key);
		
		  
        if (!empty($_REQUEST['key'])) {
                !empty($fileTemplate) ? $upload = Common::file_upload_temp($fileTemplate, $_FILES) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
        return json_encode($upload);
    }
 
    public function actionUploadTemp() 
    { 
        //new aruments added that specify the file uploads before login
        $key = $_REQUEST['key'];  
         $filename = $_REQUEST['file_name'];  
		  $fileTemplate= \api\modules\drv\models\FilemstTbl::find()->filee($key);
                 
        if (!empty($key)) {
                !empty($fileTemplate) ? $upload = Common::file_upload_temp($fileTemplate, $_FILES , true ,'registration') : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
        return json_encode($upload);
    }
    
 
	//Multipleimage Upload For Mobile//
	public function actionUploadmultiplimg()
    {    
        $key = $_REQUEST['key'];  
         $filename = $_REQUEST['file_name'];  
		  $fileTemplate=\api\modules\drv\models\FilemstTbl::find()->filee($key);
        if (!empty($_REQUEST['key'])) {
                !empty($fileTemplate) ? $upload = Common::file_multiupload_temp($fileTemplate, $_FILES) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
        return json_encode($upload);
    }
    //End Multipleimage Upload For Mobile//
   public function actionUploadcrop()
    {
	    $key = $_REQUEST['key'];
        $filename = $_REQUEST['fileName'];
        $fileTemplate=\api\modules\drv\models\FilemstTbl::find()->filee($key);
		
        if (!empty($_REQUEST['key'])) {
                !empty($fileTemplate) ? $upload = Common::file_upload_crop($fileTemplate, $_FILES,$filename) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
		
        return json_encode(["data"=>$upload,"status"=>200,"success"=>true]);
    }

    public function actionDatatoimage()
    {
        $key = 'company_logo_cpm_corporate';
        $filename = $_REQUEST['file_name'];
        $jsonarr = \common\components\Configuration::getfilekeyvalue("DMS", $key);
        if (!empty($_REQUEST['key']) && !empty($_REQUEST['file_name'])) {
            !empty($jsonarr) ? $upload = Common::file_upload_temp($jsonarr, $filename) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        } else {
            !empty($jsonarr) ? $upload = Common::fileupload($jsonarr, $_FILES) : $upload = ["msg" => "No data exists towards the key", "status" => 0];
        }
        return json_encode($upload);
    }
    public function actionMapreference()
    {
        $returnStatus=[];
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);
            $resParam = $params->postParams;
			if($_REQUEST['apiFor']=="and" || $_REQUEST['apiFor']=='ios' && !empty($_REQUEST['key']))
            {
			$fileMstPk = $_REQUEST['key'];	
			}else{
			$fileMstPk=$params->fileMstPk;
			}
            $selectedPks=$params->selectedPks;
			foreach($selectedPks as $pk){
                $fileDetails=\api\models\MemcompfiledtlsTbl::findOne($pk);
                $referrenceId=[];
                if(empty($fileDetails->mcfd_referredin)){
                    $referrenceId[]=$fileMstPk;
                }else{
                    $referrenceId=json_decode($fileDetails->mcfd_referredin);
                    $referrenceId[]=$fileMstPk;
                }
                $referrenceId=array_unique($referrenceId);
                $referrenceId=json_encode($referrenceId);
                $fileDetails->mcfd_referredin=$referrenceId;
                $fileDetails->update();
                
            }
            $returnStatus['success']=1;
             return json_encode($returnStatus);
    }
    public function actionRemovereference()
    {
        $returnStatus=[];
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);
            $resParam = $params->postParams;
            $fileMstPk=$params->fileMstPk;
            $selectedPk=$params->selectedPks;
            $fileDetails=\api\models\MemcompfiledtlsTbl::findOne($selectedPk);
			
            $referrenceId=[];
            if(!empty($fileDetails->mcfd_referredin)){            
                $referrenceId=json_decode($fileDetails->mcfd_referredin);
                if (($key = array_search($fileMstPk, $referrenceId)) !== false) {
                    if($key){
                    unset($referrenceId[$key]);
                    }
                }   
            }
            $referrenceId=array_unique($referrenceId);
            $referrenceId=json_encode($referrenceId);
            $fileDetails->mcfd_referredin=$referrenceId;
			$fileDetails->update();
              //Audit Log
            $url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
            $descText="Deleted the {$fileDetails->masters->fm_filelabel}, {$fileDetails->mcfd_origfilename}.";
            //\common\components\UserActivityLog::logUserActivity(3,$descText,$url,$fileDetails->masters->fm_modulemst_fk);
            
            $returnStatus['success']=1;
             return json_encode($returnStatus);
	}
	
	public function actionRemovefile()
    {
		
        $returnStatus=[];
            $postVar = Yii::$app->request->getRawBody();
            $params = json_decode($postVar);
            $resParam = $params->postParams;
            $fileMstPk=$params->fileMstPk;
            $selectedPk=$params->selectedPks;
            $fileDetails=\api\models\MemcompfiledtlsTbl::findOne($selectedPk);
            $fileDetails->mcfd_isdeleted=1;
            $fileDetails->update();   
            $returnStatus['success']=1;
             return json_encode($returnStatus);
    }
     public function actionView()
    {
		
          $fileDtlsPk= Security::sanitizeInput(Security::decrypt($_REQUEST['f']), "number"); 
           $userPk=Security::sanitizeInput(Security::decrypt($_REQUEST['u']), "number");
		   $companyPk=Security::sanitizeInput(Security::decrypt($_REQUEST['c']), "number");
		  $trackVisit=Security::sanitizeInput(Security::decrypt($_REQUEST['t']), "number");
		  $fileDetails=\api\models\MemcompfiledtlsTbl::find()->where('memcompfiledtls_pk=:filedtlspk',[':filedtlspk'=>$fileDtlsPk])->one();
		  
		  if($_REQUEST['dbug']==1){
			echo '<pre>';
			print_r($fileDetails);
			print_r($fileDetails->masters);
			exit;
		}
		 
		 $directory=$fileDetails->masters->fm_phyfilepath;
		 //echo '<pre>';print_r($fileDetails);exit; 
        $srcDirectory=Yii::$app->params['srcDirectory'];
        $userDirectory="comp_".$fileDetails->mcfd_opalmemberregmst_fk."/user_".$fileDetails->mcfd_uploadedby;
        $uploadPath=  \Yii::$app->params['uploadPath'];
        $originalImageDirectory = $srcDirectory.$uploadPath."/".$userDirectory. '/' . $directory.'/';
		
		//echo '<pre>';print_r($originalImageDirectory);exit;
		  $download_path = $originalImageDirectory;  
		 $file = $fileDetails->mcfd_sysgenerfilename;  
		if($trackVisit){
			$url = Yii::$app->request->baseUrl."/".Yii::$app->request->pathInfo;
			$descText="Viewed the {$fileDetails->masters->fm_filelabel}, {$fileDetails->mcfd_origfilename}.";
			//\common\components\UserActivityLog::logUserActivity(5,$descText,$url,$fileDetails->masters->fm_modulemst_fk,$userPk,$companyPk);
		}
		
		if(file_exists($download_path.'/'.$file)){
            $args = array(
            'download_path' => $download_path,
            'file' => $file,
            'extension_check' => TRUE,
            'referrer_check' => FALSE,
            'referrer' => NULL,
		);
		$ext = pathinfo($download_path.'/'.$file, PATHINFO_EXTENSION);
		
		if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='jfif'){
			header("Content-Type: image/jpg");
			 $image = $download_path.'/'.$file;
			readfile($image);
			exit;
		}
            $download = new chip_download($args);
            $download_hook = $download->get_download_hook();
            if ($download_hook['download'] == TRUE) {
                $download->get_download();
            }else{
				echo 'Document mime type not associated';
			}
        }else{
			if(isset($_REQUEST['isexist'])){
				echo 'NE'; //not exist
			}elseif(isset($_REQUEST['noimg'])){
				$fname='lypis_noimg.svg';
				$path='j3new/src/assets/images/';
				if($_REQUEST['noimg']==2){
					$fname='avatar.jpg';
				}elseif($_REQUEST['noimg']=='logo'){
					$fname='NologoJPG.jpg';
				}
				$args = array(
					'download_path' => Yii::$app->params['loginExportSavePath'].$path,
					'file' => $fname,
					'extension_check' => FALSE,
					'referrer_check' => FALSE,
					'referrer' => NULL,
				);
					$download = new chip_download($args);
					$download_hook = $download->get_download_hook();
					if ($download_hook['download'] == TRUE) {
						$download->get_download();
					}
			}else{
				echo "The file you're looking for is not present in the server.";
				exit;
			}
        }
     
    }

}

class chip_download {
	
	/*
	|---------------------------
	| Properties
	|---------------------------
	*/
	
	private $download_hook = array();
	
	private $args = array(
						'download_path'			=>	NULL,
						'file'					=>	NULL,						
						'extension_check'		=>	TRUE,
						'referrer_check'		=>	FALSE,	
						'referrer'				=>	NULL,					
					);
	
	private $allowed_extensions = array(
						
						/* Archives */
						'zip'	=> 'application/zip',
						'7z'	=> 'application/octet-stream',
					
					  	/* Documents */
					  	'txt'	=> 'text/plain',
						'pdf'	=> 'application/pdf',
					  	'doc' 	=> 'application/msword',
						'xls'	=> 'application/vnd.ms-excel',
						'xlsx'	=> 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					  	'ppt'	=> 'application/vnd.ms-powerpoint',
					  
					  	/* Executables */
					  	'exe'	=> 'application/octet-stream',
					
					  	/* Images */
					  	'gif'	=> 'image/gif',
					  	'png'	=> 'image/png',
					  	'jpg'	=> 'image/jpeg',
					  	'jpeg'	=> 'image/jpeg',
					
					  	/* Audio */
					  	'mp3'	=> 'audio/mpeg',
					  	'wav'	=> 'audio/x-wav',
					
					  	/* Video */
					  	'mpeg'	=> 'video/mpeg',
					  	'mpg'	=> 'video/mpeg',
					  	'mpe'	=> 'video/mpeg',
					  	'mov'	=> 'video/quicktime',
					  	'avi'	=> 'video/x-msvideo'
					
					);
	

	/*
	|---------------------------
	| Constructor
	|
	| @public
	| @param array $args
	| @param array $allowed_extensions
	|
	|---------------------------
	*/
	
	public function __construct( $args = array(), $allowed_extensions = array()  ) {
		
		$this->set_args( $args );
		$this->set_allowed_extensions( $allowed_extensions );
						
	}
	
	/*
	|---------------------------
	| Print variable in readable format
	|
	| @public
	| @param string|array|object $var
	|
	|---------------------------
	*/
	
	public function chip_print( $var ) { 
		
		echo "<pre>";
    	print_r($var);
   	 	echo "</pre>";
	
	}
	
	/*
	|---------------------------
	| Update default arguments
	| It will update default array of class i.e $args
	|
	| @private
	| @param array $args - input arguments
	| @param array $defatuls - default arguments 
	| @return array
	|
	|---------------------------
	*/
	
	private function chip_parse_args( $args = array(), $defaults = array() ) { 
		return array_merge( $defaults, $args );	 
	}
	
	/*
	|---------------------------
	| Get extension and name of file
	|
	| @private
	| @param string $file_name 
	| @return array - having file_name and file_ext
	|
	|---------------------------
	*/
	
	private function chip_extension($file_name) {
		$temp = array();
		$temp['file_name'] = strtolower( substr( $file_name, 0, strripos( $file_name, '.' ) ) );
	    $temp['file_extension'] = strtolower( substr( $file_name, strripos( $file_name, '.' ) + 1 ) );
		return $temp;
	}
	
	/*
	|---------------------------
	| Set default arguments
	| It will set default array of class i.e $args
	|
	| @private
	| @param array $args
	| @return 0
	|
	|---------------------------
	*/
	
	private function set_args( $args = array() ) { 
		
		$defaults = $this->get_args();
		$args = $this->chip_parse_args( $args, $defaults );
		$this->args = $args;	 
	}
	
	/*
	|---------------------------
	| Get default arguments
	| It will get default array of class i.e $args
	|
	| @public
	| @return array
	|
	|---------------------------
	*/
	
	public function get_args() { 
		return $this->args;	 
	}
	
	/*
	|---------------------------
	| Set default allowed extensions
	| It will set default array of class i.e $allowed_extensions
	|
	| @private
	| @param array $allowed_extensions
	| @return 0
	|
	|---------------------------
	*/
	
	private function set_allowed_extensions( $allowed_extensions = array() ) { 
		
		$defaults = $this->get_allowed_extensions();
		$allowed_extensions = array_unique( $this->chip_parse_args( $allowed_extensions, $defaults ) );
		$this->allowed_extensions = $allowed_extensions;	 
	
	}
	
	/*
	|---------------------------
	| Get default allowed extensions
	| It will get default array of class i.e $allowed_extensions
	|
	| @public
	| @return array
	|
	|---------------------------
	*/
	
	public function get_allowed_extensions() { 
		return $this->allowed_extensions;	 
	}
	
	/*
	|---------------------------
	| Set Mimi Type
	| It will set default array of class i.e $allowed_extensions
	|
	| @private
	| @param string $file_path
	! @return string
	|
	|---------------------------
	*/
	
	private function set_mime_type( $file_path ) { 
		
		/* by Function - mime_content_type */
		if( function_exists( 'mime_content_type' ) ) {
			$file_mime_type = @mime_content_type( $file_path );
		}
		
		/* by Function - mime_content_type */
		else if( function_exists( 'finfo_file' ) ) {
			
			$finfo = @finfo_open(FILEINFO_MIME);
			$file_mime_type = @finfo_file($finfo, $file_path);
			finfo_close($finfo);  
		
		}
		
		/* Default - FALSE */
		else {
			$file_mime_type = FALSE;
		 }
		 
		 return $file_mime_type;	 
	
	}
	
	/*
	|---------------------------
	| Get Mimi Type
	| It will set default array of class i.e $allowed_extensions
	|
	| @public
	| @param string $file_path
	! @return string
	|
	|---------------------------
	*/
	
	public function get_mime_type( $file_path ) { 
		return $this->set_mime_type( $file_path );	 
	}
	
	/*
	|---------------------------
	| Pre Download Hook
	|
	| @private
	| @return 0
	|
	|---------------------------
	*/
	
	private function set_download_hook() { 
		
		/* Allowed Extensions */
		$allowed_extensions = $this->get_allowed_extensions();
		
		/* Arguments */
		$args = $this->get_args();		
		
		/* Extract Arguments */
		extract($args);
		
		/* Directory Depth */
		$dir_depth = dirname( $file );
		if ( !empty( $dir_depth ) && $dir_depth != "." ) {
			$download_path = $download_path . $dir_depth . "/";
		} 
		
		/* File Name */
		$file = basename( $file );
		
		/* File Path */
		$file_path = $download_path . $file;
		$this->download_hook['file_path'] = $file_path;
		
		/* File and File Path Validation */
		if( empty( $file ) || !file_exists( $file_path ) ) {
			$this->download_hook['download'] = FALSE;
			$this->download_hook['message'] = "Invalid File or File Path.";
			return 0;
		}
		
		/* File Name and Extension */
		$nameext = $this->chip_extension($file);
		$file_name = $nameext['file_name'];
		$file_extension = $nameext['file_extension'];
		
		$this->download_hook['file'] = $file;
		$this->download_hook['file_name'] = $file_name;
		$this->download_hook['file_extension'] = $file_extension;

		/* Allowed Extension - Validation */
		if ( $extension_check == TRUE && !array_key_exists( $file_extension, $allowed_extensions ) ) {
		  $this->download_hook['download'] = FALSE;
		  $this->download_hook['message'] = "File is not allowed to download"; 
		  return 0;
		}
		
		/* Referrer - Validation */		
		if ( $referrer_check == TRUE && !empty($referrer) && strpos( strtoupper( $_SERVER['HTTP_REFERER'] ), strtoupper( $referrer ) ) === FALSE ) {
			$this->download_hook['download'] = FALSE;
		 	$this->download_hook['message'] = "Internal server error - Please contact system administrator";
			return 0;
		}
		
		/* File Size in Bytes */
		$file_size = filesize($file_path);
		$this->download_hook['file_size'] = $file_size;
		
		/* File Mime Type - Auto, Manual, Default */
		$file_mime_type = $this->get_mime_type( $file_path );		
		if( empty( $file_mime_type ) ) {
			
			$file_mime_type = $allowed_extensions[$file_extension];
			if( empty( $file_mime_type ) ) {
				$file_mime_type = "application/force-download";
			}
		
		}		
		
		$this->download_hook['file_mime_type'] = $file_mime_type;
		
		$this->download_hook['download'] = TRUE;
		$this->download_hook['message'] = "File is ready to download";
		return 0;		
	
	}
	
	/*
	|---------------------------
	| Download Hook
	| Allows you to do some action before download
	|
	| @public
	| @return array
	|
	|---------------------------
	*/
	
	public function get_download_hook() { 
		$this->set_download_hook();
		return $this->download_hook;
	}
	
	/*
	|---------------------------
	| Post Download Hook
	|
	| @private
	| @return array
	|
	|---------------------------
	*/
	
	private function set_post_download_hook() { 
		return $this->download_hook;
	}
	
	/*
	|---------------------------
	| Download
	| Start download stream
	|
	| @public
	| @return 0
	|
	|---------------------------
	*/
	
	public function set_download() { 
		
		/* Download Hook */
		$download_hook = $this->set_post_download_hook();
		
		/* Extract */
		extract($download_hook);
		
		/* Recheck */
		if( $download_hook['download'] != TRUE ) {
			echo "File is not allowed to download";
			return 0;
		}
		
		/* Execution Time Unlimited */
		set_time_limit(0);
		
		/*
		|----------------
		| Header
		| Forcing a download using readfile()
		|----------------
		*/
		
		header('Content-Description: File Transfer');
		header('Content-Type: ' . $file_mime_type);
		header('Content-Disposition: inline; filename=' . $file);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
//		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . $file_size);
		ob_clean();
		flush();
		readfile($file_path);
		exit;
		
	}
	
	/*
	|---------------------------
	| Download
	| Start download stream
	|
	| @public
	| @return array
	|
	|---------------------------
	*/
	
	public function get_download() { 
		$this->set_download();
		exit;
	}

	/*
	|---------------------------
	| Destructor
	|---------------------------
	*/
	
	public function __destruct() {
	}


}
?>