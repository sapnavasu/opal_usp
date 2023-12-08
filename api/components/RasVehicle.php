<?php

namespace api\components;

use app\models\AppinstinfomainTbl;
use app\models\OpalmemberregmstTbl;
use app\models\RasvehicleownerdtlshstyTbl;
use app\models\RasvehicleownerdtlsTbl;
use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\base\BaseObject;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;
use ZipStream\Exception;
use function GuzzleHttp\json_encode;

class RasVehicle extends BaseObject {

    public static function importexceldata($requestdata) {

        $path = explode('api/', Drive::getAbsFilePath($requestdata['file']));

        try {
            $getexceldata = IOFactory::load($path[1]);
            $sheet_array = $getexceldata->getActiveSheet()->toArray(null, null, null, null, 1, 2);
            $dataToSaveArray = array_filter($sheet_array);
        } catch (PHPExcel_Exception $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        } catch (Exception $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        } catch (InvalidArgumentException $e) {
            $templdatestatus = TRUE;
            $jsonData['templdatestatus'] = $templdatestatus;
            $jsonData['msg'] = 'datareaderror';
            $jsonData['title'] = 'Invalid Input!';
            $jsonData['dtls'] = 'Kindly use the sample template we have provided.<br>Fill the fields only with the required data.<br>Do not enter any other input format or formula.';
            return json_encode($jsonData);
        }

        $masterArray = array();
        $successarray = array();
        $headArray = array();

        foreach ($dataToSaveArray as $innerarray) {
            $dataToSaveArrayNew[] = array_filter($innerarray);
        }
        $dataToSaveArray = array_filter($dataToSaveArrayNew);

        $headerArray = array_filter($dataToSaveArray[0]);

        foreach ($headerArray as $key => $head) {

            $keyvalue2 = $headerArray[$key];

            if ($keyvalue2) {
                $requiredarray[$key] = $head;
                $testcount2 = strpos($requiredarray[$key], "(");
                if (!empty($testcount2)) {
                    $requiredarray[$key] = trim(substr($requiredarray[$key], 0, $testcount2));
                }
            }

            $keyvalue = str_replace("*", "", $head);
            $testcount = strpos($keyvalue, "(");
            if (!empty($testcount)) {
                $keyvalue = substr($keyvalue, 0, $testcount);
            }

            $headArray[] = trim($keyvalue);
        }

        $dataToSaveArray[0] = array_filter($dataToSaveArray[0]);

        $headcount = count($headArray);
        unset($dataToSaveArray[0]);

        $i = 0;
        $success = 0;

        $templdatestatus = TRUE;
        $validdata = TRUE;
        $Requiredcomments = "";
        $opalmemberreg = null;
        $invalidcomments = "";
        $officetype = null;
        $requiredcomm = false;

        $LableArray = array("Company Name", "RAS Centre Name", "Office Type", "Branch Name", "Vehicle Owner Name", "CR Number", "Vehicle Registration Number", "Chassis No.", "Vehicle Category", "Road Type", "Date of Inspection", "Inspector Name", "Date of Expiry", "RASIC Number", "Verification Code", "Sticker Status", "Created on");

        if ($headcount != count($LableArray)) {
            $templdatestatus = FALSE;
        }

        if ($headArray != $LableArray) {
            $templdatestatus = FALSE;
        }

        foreach ($dataToSaveArray as $key => $value) {

            if (empty($value['0']) && empty($value['1']) && empty($value['2']) && empty($value['3']) && empty($value['4']) && empty($value['5']) && empty($value['6']) && empty($value['7']) && empty($value['8']) && empty($value['9']) && empty($value['10']) && empty($value['11']) && empty($value['12']) && empty($value['13']) && empty($value['14']) && empty($value['15']) && empty($value['16']) && empty($value['17']) && empty($value['18']) && empty($value['19']) && empty($value['20']) && empty($value['21']) && empty($value['22']) && empty($value['23']) && empty($value['24']) && empty($value['25']) && empty($value['26']) && empty($value['27']) && empty($value['28']) && empty($value['29']) && empty($value['30']) && empty($value['31']) && empty($value['32']) && empty($value['33']) && empty($value['34']) && empty($value['35']) && empty($value['36']) && empty($value['37'])) {
                $value = array_filter($value);
                $i--;
            }
            foreach ($value as $key1 => $value1) {

                $newarray = $value;
                end($newarray);         // move the internal pointer to the end of the array
                $last = key($newarray);
                $lastkeyvalue = str_replace("*", "", $headerArray[$last]);
                $testcount = strpos($lastkeyvalue, "(");
                if ($testcount) {
                    $lastkeyvalue = substr($lastkeyvalue, 0, $testcount);
                }
                $lastkeyvalue = trim($lastkeyvalue);

                $value1 = trim($value1);
                $keyvalue = str_replace("*", "", $headerArray[$key1]);

                $testcount = strpos($keyvalue, "(");

                if (!empty($keyvalue) && $keyvalue != NULL) {
                    $masterArray[$i][trim($keyvalue)] = $value1;
                }

                $keyvalue = str_replace("*", "", $headerArray[$key1]);

                if (!$requiredcomm) {
                    foreach ($requiredarray as $reqkey => $reqvalue) {
                        if (empty($value[array_search($reqvalue, $headArray)])) {
                            $masterArray[$i]['pq_cellattr'][$reqvalue][style] = 'background:#f44250;font-weight:bold;';
                            $validdata = 'FALSE';
                            $Requiredcomments .= $reqvalue . ", ";
                        }
                    }
                }
                $requiredcomm = true;

                if (trim($keyvalue) == 'Company Name' && !empty($value1)) {
                    $opalmemberreg = OpalmemberregmstTbl::find()->select(['opalmemberregmst_pk as Pk'])->where(['=', 'omrm_companyname_en', $value1])->asArray()->one()['Pk'];

                    if (!$opalmemberreg) {
                        $masterArray[$i]['pq_cellattr']['Company Name'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "No company found with the name '" . $value1 . "', ";
                    }
                }

                if (trim($keyvalue) == 'Office Type' && !empty($value1)) {
                    if ($value1 != 'Main Office' && $value1 != 'Branch Office') {
                        $masterArray[$i]['pq_cellattr']['Office Type'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "Office Type, ";
                    } else if ($value1 == 'Main Office') {
                        $officetype = 1;
                    } else if ($value1 == 'Branch Office') {
                        $officetype = 2;
                    }
                }
                if (trim($keyvalue) == 'Branch Name' && ( empty($value1) || $value1 == "NULL") && $officetype == 2) {
                    $masterArray[$i]['pq_cellattr']['Branch Name'][style] = 'background:#f44250;font-weight:bold;';
                    $validdata = 'FALSE';
                    $Requiredcomments = "Branch Name, ";
                }

                if (trim($keyvalue) == 'Road Type' && !empty($value1)) {
                    if ($value1 != 'Blacktop' && $value1 != 'Blacktop & Graded Road' && $value1 != 'Graded Road') {
                        $masterArray[$i]['pq_cellattr']['Road Type'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "Road Type, ";
                    } elseif ($value1 == 'Blacktop') {
                        $roadtype = 1;
                    } elseif ($value1 == 'Graded Road') {
                        $roadtype = 2;
                    } elseif ($value1 == 'Blacktop & Graded Road') {
                        $roadtype = 3;
                    }
                }


                if (trim($keyvalue) == 'Date of Inspection' && !empty($value1)) {

                    $timestampinsp = ($value1 - 25569) * 86400;
                    $masterArray[$i]['Date of Inspection'] = date("d-m-Y", $timestampinsp);
                    if (!strtotime(date("d-m-Y", $timestampinsp))) {
                        $masterArray[$i]['pq_cellattr']['Date of Inspection'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "Date of Inspection, ";
                    }
                }



                if (trim($keyvalue) == 'Date of Expiry' && !empty($value1)) {

                    $timestampexpiry = ($value1 - 25569) * 86400;
                    $masterArray[$i]['Date of Expiry'] = date("d-m-Y", $timestampexpiry);

                    if (!strtotime(date("d-m-Y", $timestampexpiry))) {
                        $masterArray[$i]['pq_cellattr']['Date of Expiry'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "Date of Expiry, ";
                    }
                }


                if (trim($keyvalue) == 'Created on' && !empty($value1)) {

                    $timestampcrete = ($value1 - 25569) * 86400;
                    $masterArray[$i]['Created on'] = date("d/m/Y", $timestampcrete);

                    if (!strtotime(date("d-m-Y", $timestampcrete))) {
                        $masterArray[$i]['pq_cellattr']['Created on'][style] = 'background:#f44250;font-weight:bold;';
                        $validdata = 'FALSE';
                        $invalidcomments .= "Created on, ";
                    }
                }


                if (trim($keyvalue) == $lastkeyvalue && $validdata == 'TRUE') {

                    $recordsave = self::saverasvehicleimport($masterArray[$i]);

                    if ($recordsave === true) {
                        $successarray[] = $masterArray[$i];
                        unset($masterArray[$i]);
                        $i--;
                        $success++;
                    } else {

                        foreach ($recordsave as $key => $record) {

                            $masterArray[$i]['pq_cellattr'][$key][style] = 'background:#f44250;font-weight:bold;';
                            $validdata = 'FALSE';
                            $invalidcomments .= "invalid value - '" . $key . "', ";
                        }
                    }
                }

                if ($validdata == 'FALSE') {
                    if (!empty($Requiredcomments)) {
                        if (empty($Requiredlabe)) {
                            $overallcomments .= 'E' . ++$j . ". Required Fields: " . $Requiredcomments;
                            $Requiredlabe = 1;
                        } else {
                            $overallcomments .= $Requiredcomments;
                        }
                    }

                    if (!empty($invalidcomments)) {
                        if (empty($invalidlable)) {
                            $overallcomments .= 'E' . ++$j . ". Invalid data: " . $invalidcomments;
                            $invalidlable = 1;
                        } else {
                            $overallcomments .= $invalidcomments . "";
                        }
                    }

                    $masterArray[$i]['Over_all_Comments'] = $overallcomments;
                    $Requiredcomments = "";
                    $invalidcomments = "";
                }
            }
            $i++;
        }
        if($masterArray["-1"])
        {
            unset($masterArray["-1"]);
        }
        
       
        $jsonData['errorarray'] = $masterArray;
        $jsonData['successarray'] = $successarray;
        $jsonData['failed'] = $i;
        $jsonData['success'] = $success;
        $jsonData['total'] = $success + $i;
        $jsonData['templdatestatus'] = $templdatestatus;

        return json_encode($jsonData);
    }

    public static function saverasvehicleimport($data) {
       
        $userpk = ActiveRecord::getTokenData('opalusermst_pk', true);
        $transaction = \Yii::$app->db->beginTransaction();
        
        $opalmemberreg = OpalmemberregmstTbl::find()->select(['opalmemberregmst_pk as Pk'])->where(['=', 'omrm_companyname_en', $data['Company Name']])->asArray()->one()['Pk'];

        if ($data['Office Type'] == 'Main Office') {
            $officetype = 1;
        } else if ($data['Office Type'] == 'Branch Office') {
            $officetype = 2;
        }

        $model = AppinstinfomainTbl::find()->select(['appinstinfomain_pk as Pk'])
                ->leftJoin('applicationdtlsmain_tbl', 'applicationdtlsmain_pk = appiim_applicationdtlsmain_fk')
                ->where(['=', 'appiim_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=', 'appiim_officetype', $officetype])
                ->andWhere(['=', 'appdm_projectmst_fk', 4]);
        if ($officetype == 2) {
            $model->andWhere(['=', 'appiim_branchname_en', $data['Branch Name']]);
        }
    
        $instinfoPk = $model->asArray()->one()['Pk'];
          
        if (!$instinfoPk && $officetype == 1) {
            $returndata['Application'] = 2;
        } else if (!$instinfoPk && $officetype == 1) {
            $returndata['Branch Application'] = 2;
        }
     
        $category = \app\models\RascategorymstTbl::find()
                        ->select(['rascategorymst_pk as Pk'])
                        ->leftJoin('apprasvehinspcatmain_tbl', 'arvicm_rascategorymst_fk = rascategorymst_pk')
                        ->where(['OR', ['=', 'rcm_coursesubcatname_en', $data['Vehicle Category']], ['=', 'rcm_coursesubcatname_ar', $data['Vehicle Category']]])
                        ->andWhere(['=', 'arvicm_appinstinfomain_fk', $instinfoPk])
                        ->asArray()->one()['Pk'];
       
        if (!$category) {
            $returndata['Vehicle Category'] = 2;
        }
        
        $rasvehicleOwner = RasvehicleownerdtlsTbl::find()
                        ->select(['rasvehicleownerdtls_pk as Pk'])
                        ->where(['=', 'rvod_crnumber', $data['CR Number']])
                        ->andWhere(['=', 'rvod_ownername_en', $data['Vehicle Owner Name (English)']])
                        ->asArray()
                        ->one()['Pk'];

        if (!$rasvehicleOwner) {

            $rasvehicleOwnercivil = RasvehicleownerdtlsTbl::find()
                            ->select(['rasvehicleownerdtls_pk as Pk'])
                            ->where(['=', 'rvod_crnumber', $data['CR Number']])
                            ->asArray()
                            ->one()['Pk'];

            if ($rasvehicleOwnercivil) {

                $rasownerhsty = RasvehicleownerdtlshstyTbl::find()
                                ->select(['rvodh_rasvehicleownerdtls_fk as Pk'])
                                ->where(['=', 'rvodh_crnumber', $data['CR Number']])
                                ->andWhere(['=', 'rvodh_ownername_en', $data['Vehicle Owner Name (English)']])
                                ->asArray()
                                ->one()['Pk'];

                if (!$rasownerhsty) {

                    $model = new RasvehicleownerdtlshstyTbl();
                    $model->rvodh_rasvehicleownerdtls_fk = $rasvehicleOwnercivil;
                    $model->rvodh_ownername_en = $data['Vehicle Owner Name (English)'];
                    $model->rvodh_ownername_ar = $data['Vehicle Owner Name (English)'];
                    $model->rvodh_crnumber = $data['CR Number'];
                    $model->rvodh_status = 1;
                    $model->rvodh_createdon = date('Y-m-d H:i:s');
                    $model->rvodh_createdby = $userpk;

                    if (!$model->save()) {
                       $returndata['Vehicle Owner Record History'] = 2;
                    } else {
                        $rasvehicleOwner = $rasvehicleOwnercivil;
                    }
                }
                $rasvehicleOwner = $rasvehicleOwnercivil;
            } else {
                $model = new RasvehicleownerdtlsTbl();

                $model->rvod_ownername_en = $data['Vehicle Owner Name (English)'];
                $model->rvod_ownername_ar = $data['Vehicle Owner Name (English)'];
                $model->rvod_crnumber = $data['CR Number'];
                $model->rvod_status = 1;
                $model->rvod_createdon = date('Y-m-d H:i:s');
                $model->rvod_createdby = $userpk;

                if (!$model->save()) {
                    $returndata['Vehicle Owner Record'] = 2;
                    } else {
                    $rasvehicleOwner = $model->rasvehicleownerdtls_pk;
                }
            }
        }

        $datavehicle = trim(\api\components\Security::sanitizeInput($data['Vehicle Registration Number'], 'string'));
        
         $datavehicle =  str_replace(' ', '', $datavehicle);
       $datavehicle =  str_replace('-', '', $datavehicle);
        $vehiclerecord = \app\models\RasvehicleregdtlsTbl::find()
                ->select(['rasvehicleregdtls_pk as Pk', 'rvrd_applicationrefno as rasic'])
                ->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $datavehicle])
                ->andwhere(['=', 'rvrd_opalmemberregmst_fk', $opalmemberreg])
                ->andWhere(['=','rvrd_appinstinfomain_fk',$instinfoPk])
                ->asArray()
                ->one();
        

        $roadtype = \app\models\ReferencemstTbl::getRefPkByTypePkandName(16, $data['Road Type']);

        $inspector = self::getInspectorinfopkbyname($data['Inspector Name'], $instinfoPk);     
        
        if (!$inspector) {
            $inspector = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);
        }
        

        if ($vehiclerecord && $instinfoPk && $category && $roadtype && $opalmemberreg) {
            
            $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=', 'rvodh_rasvehicleownerdtls_fk', $rasvehicleOwner])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];

            if (!$ownerhistory) {
                $ownermodel = RasvehicleownerdtlsTbl::findOne($rasvehicleOwner);
                $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);
            }

            $vehiclehsty = new \app\models\RasvehicleregdtlshstyTbl();
            $vehiclehsty->rvrdh_rasvehicleregdtls_fk = $vehiclerecord['Pk'];
            $vehiclehsty->rvrdh_appinstinfomain_fk = $instinfoPk;
            $vehiclehsty->rvrdh_opalmemberregmst_fk = $opalmemberreg;
            $vehiclehsty->rvrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
            $vehiclehsty->rvrdh_vechicleregno = $data['Vehicle Registration Number'];
            $vehiclehsty->rvrdh_chassisno = $data['Chassis No.'];
            $vehiclehsty->rvrdh_vechiclecat = (int)$category;
            $vehiclehsty->rvrdh_roadtype = $roadtype;
            $vehiclehsty->rvrdh_dateofinsp = date('Y-m-d', strtotime($data['Date of Inspection']));
            $vehiclehsty->rvrdh_inspectorname = (int) $inspector;
            $vehiclehsty->rvrdh_dateofexpiry = date('Y-m-d', strtotime($data['Date of Expiry']));
            $vehiclehsty->rvrdh_applicationrefno = $vehiclerecord['rasic'];
            $vehiclehsty->rvrdh_applicationtype = 1;
            $vehiclehsty->rvrdh_inspectionstatus = 3;
            $vehiclehsty->rvrdh_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
            $code = $data['Verification Code'] == 'NULL'?null:$data['Verification Code'];
            $vehiclehsty->rvrdh_verificationno = $code;
            $vehiclehsty->rvrdh_createdon = date('Y-m-d', strtotime($data['Created on']));
            $vehiclehsty->rvrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

            if ($vehiclehsty->save()) {
                $vehiclenumber = $vehiclehsty->rvrdh_rasvehicleregdtls_fk;
            } else {
                $returndata['Vehicle History Record'] = 2;
            }
            
             $record = \app\models\RasvehicleregdtlsTbl::findOne($vehiclerecord['Pk']);
            if(!$record->rvrd_dateofexpiry)
            {
                $record->rvrd_dateofexpiry = date('Y-m-d', strtotime($data['Date of Expiry']));
                
            }
            if ($record->save()) {
                $vehiclenumber = $record->rasvehicleregdtls_pk;
            } else {
                $returndata['Vehicle Record Expiry'] = 2;
            }
        } else if ($instinfoPk && $category && $roadtype && $opalmemberreg) {

            $companyrec = \app\models\RasvehicleregdtlsTbl::find()
                    ->select(['rasvehicleregdtls_pk as Pk', 'rvrd_applicationrefno as rasic'])
                    ->where(["REPLACE(lower(REPLACE(rvrd_vechicleregno, ' ','')), '-','')" => $datavehicle])
                    ->andWhere(['=','rvrd_appinstinfomain_fk',$instinfoPk])
                    ->asArray()
                    ->one();
            
            

            if ($companyrec && $instinfoPk && $category && $roadtype && $opalmemberreg) {
                $ownerhistory = RasvehicleownerdtlshstyTbl::find()->where(['=', 'rvodh_rasvehicleownerdtls_fk', $rasvehicleOwner])->orderBy('rasvehicleownerdtlshsty_pk desc')->one()['rasvehicleownerdtlshsty_pk'];

                if (!$ownerhistory) {
                    $ownermodel = RasvehicleownerdtlsTbl::findOne($rasvehicleOwner);
                    $ownerhistory = RasvehicleownerdtlshstyTbl::movetohistory($ownermodel);
                }

                $vehiclehsty = new \app\models\RasvehicleregdtlshstyTbl();
                $vehiclehsty->rvrdh_rasvehicleregdtls_fk = $companyrec['Pk'];
                $vehiclehsty->rvrdh_appinstinfomain_fk = $instinfoPk;
                $vehiclehsty->rvrdh_opalmemberregmst_fk = $opalmemberreg;
                $vehiclehsty->rvrdh_rasvehicleownerdtlshsty_fk = $ownerhistory;
                $vehiclehsty->rvrdh_vechicleregno = $data['Vehicle Registration Number'];
                $vehiclehsty->rvrdh_chassisno = $data['Chassis No.'];
                $vehiclehsty->rvrdh_vechiclecat = (int)$category;
                $vehiclehsty->rvrdh_roadtype = $roadtype;
                $vehiclehsty->rvrdh_dateofinsp = date('Y-m-d', strtotime($data['Date of Inspection']));
                $vehiclehsty->rvrdh_inspectorname = (int) $inspector;
                $vehiclehsty->rvrdh_dateofexpiry = date('Y-m-d', strtotime($data['Date of Expiry']));
                $vehiclehsty->rvrdh_applicationrefno = $vehiclerecord['rasic'];
                $vehiclehsty->rvrdh_applicationtype = 1;
                $vehiclehsty->rvrdh_inspectionstatus = 10;
                $vehiclehsty->rvrdh_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
                $code = $data['Verification Code'] == 'NULL'?null:$data['Verification Code'];
                $vehiclehsty->rvrdh_verificationno = $code;
                $vehiclehsty->rvrdh_createdon = date('Y-m-d', strtotime($data['Created on']));
                $vehiclehsty->rvrdh_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);

                if ($vehiclehsty->save()) {
                    $vehiclenumber = $vehiclehsty->rvrdh_rasvehicleregdtls_fk;
                } else {
                    $returndata['Vehicle History Record'] = 2;
                }
            } else if( $instinfoPk && $category && $roadtype && $opalmemberreg) {
                $vehicle = new \app\models\RasvehicleregdtlsTbl();
                $vehicle->rvrd_appinstinfomain_fk = $instinfoPk;
                $vehicle->rvrd_opalmemberregmst_fk = $opalmemberreg;
                $vehicle->rvrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
                $vehicle->rvrd_vechicleregno = $data['Vehicle Registration Number'];
                $vehicle->rvrd_chassisno = $data['Chassis No.'];
                $vehicle->rvrd_vechiclecat = (int)$category;
                $vehicle->rvrd_roadtype = $roadtype;
                $vehicle->rvrd_dateofinsp = date('Y-m-d', strtotime($data['Date of Inspection']));
                $vehicle->rvrd_inspectorname = (int)$inspector;
                $vehicle->rvrd_dateofexpiry = date('Y-m-d', strtotime($data['Date of Expiry']));
                $vehicle->rvrd_applicationrefno = \app\models\RasvehicleregdtlsTbl::generatenewvehiclerefno($opalmemberreg);
                $vehicle->rvrd_applicationtype = 1;
               
                $vehicle->rvrd_inspectionstatus = 3;
                $vehicle->rvrd_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
               $code = $data['Verification Code'] == 'NULL'?null:$data['Verification Code'];
                $vehicle->rvrd_verificationno = $code;                $vehicle->rvrd_createdon = date('Y-m-d', strtotime($data['Created on']));
                $vehicle->rvrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);
                
                if($anyvehicle)
                {
                    $vehicle->rvrd_inspectionstatus = 10;
                    if($anyvehicle['rvrd_permitstatus'] == 2 || $anyvehicle['rvrd_permitstatus'] == 3)
                    {
                         $vehicle->rvrd_permitstatus = 4;
                    }
                    else
                    {
                        $vehicle->rvrd_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
                    }   
                }
                else
                {
                    $vehicle->rvrd_inspectionstatus = 3;
                    $vehicle->rvrd_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
                }

                if ($vehicle->save()) {
                    $vehiclenumber = $vehicle->rasvehicleregdtls_pk;
                } else {
                   
                    $returndata['Vehicle Record'] = 2;
                }
            }
        } 
//        else {
//            $vehicle = new \app\models\RasvehicleregdtlsTbl();
//            $vehicle->rvrd_appinstinfomain_fk = $instinfoPk;
//            $vehicle->rvrd_opalmemberregmst_fk = $opalmemberreg;
//            $vehicle->rvrd_rasvehicleownerdtls_fk = $rasvehicleOwner;
//            $vehicle->rvrd_vechicleregno = $data['Vehicle Registration Number'];
//            $vehicle->rvrd_chassisno = $data['Chassis No.'];
//            $vehicle->rvrd_vechiclecat = $category;
//            $vehicle->rvrd_roadtype = $roadtype;
//            $vehicle->rvrd_dateofinsp = date('Y-m-d', strtotime($data['Date of Inspection']));
//            $vehicle->rvrd_inspectorname = (int) $inspector;
//            $vehicle->rvrd_dateofexpiry = date('Y-m-d', strtotime($data['Date of Expiry']));
//            $vehicle->rvrd_applicationrefno = \app\models\RasvehicleregdtlsTbl::generatenewvehiclerefno($opalmemberreg);
//            $vehicle->rvrd_applicationtype = 1;
//            $vehicle->rvrd_inspectionstatus = 3;
//            $vehicle->rvrd_permitstatus = $data['Sticker Status'] == 'Expired' ? 3 : 2;
//            $vehicle->rvrd_verificationno = $data['Verification Code'];
//            $vehicle->rvrd_createdon = date('Y-m-d', strtotime($data['Date of Expiry']));
//            $vehicle->rvrd_createdby = OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) ? OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg, 4) : OpalmemberregmstTbl::getFocalPointByMemregPK($opalmemberreg);
//
//            if ($vehicle->save()) {
//                $vehiclenumber = $vehicle->rasvehicleregdtls_pk;
//            } else {
//                
//                $returndata['Vehicle Record'] = 2;
//            }
//        }

        if ($vehiclenumber) {
            $transaction->commit();
            return true;
        } else {
             $transaction->rollBack();

            if (empty($returndata)) {
                $returndata['Overall'] = 2;
            }

            return $returndata;
        }
    }

    public static function getInspectorinfopkbyname($name, $instinfomainpk) {
        $staffpk = \app\models\AppstaffinfomainTbl::find()
                        ->select(['opalusermst_pk as Pk'])
                        ->leftJoin('staffinforepo_tbl', 'staffinforepo_pk = appsim_StaffInfoRepo_FK')
                        ->leftJoin('opalusermst_tbl', 'oum_staffinforepo_fk = staffinforepo_pk')
                        ->where(['=', 'appsim_AppInstInfoMain_FK', $instinfomainpk])
                        ->andWhere("FIND_IN_SET('16', oum_rolemst_fk)")
                        ->andWhere(['OR', ['=', 'sir_name_en', $name], ['=', 'oum_firstname', $name]])
                        ->asArray()->one()['Pk'];

        return $staffpk;
    }

}

?>