<?php

namespace app\commonfunction;
use yii;


class CommonDb extends \yii\base\BaseObject{


    const GETSINGLETABLECOLUMNPREFIX = array(

        "memcompprofiledtls" => "MCPD_",
        "memcompprodspecdtls" => "MCPSD_",
        "mctbrsecgrddtls" => "MCTBRSGD_",
        "membercompanymst" => "MCM_",
        "memcompgendtls" => "MCGD_",
        "memcomplookoutproddtls" => "MCLPD_",
        "memcomplookoutservdtls" => "MCLSD_",
        "memcompmarketpresencedtls" => "MCMP_",
        "memcompproddtls" => "MCPrD_",
        "memcompprofachvdtls" => "MCPAvD_",
        "memcompprofcertfdtls" => "MCPCD_",
        "memcompprofsuppattdtls" => "MCPASD_",
        "memcompsectordtls" => "MCSD_",
        "memcompservicedtls" => "MCSvD_",
        "memcompacomplishdtls" => "mcad_",
        "memcompprodservagentsprncp" => "mcpsap_",
        "memcompservprncp" => "mcsp_",
        "userpermtrn" => "UPT_",
        "memcompservspecdtls" => "MCSSD_",
        "usermst" => "um_",
        "userprofile_tbl" => "up_",
        "usrprofcontactdtls" => "upcd_"
    );

    public static function singleInsertion($field, $tablename) {

        // $tablename = array_keys($field);
        foreach ($field as $key => $value) {

            if (!empty($value)) {

                if ($key == "status") {
                    $status = ($field == true) ? "A" : "I";
                    $data[self::GETSINGLETABLECOLUMNPREFIX[$tablename] . $key . ''] = $status;
                } else if ($key == $tablename . '_pk') {
                    $data[$key] = $value;
                } else {
                    $data[self::GETSINGLETABLECOLUMNPREFIX[$tablename] . $key . ''] = $value;
                }
            }
        }
        if (!empty($tablename))
            $modelname = self::getModelname($tablename);

        $insertdata['modelname'] = !empty($modelname) ? $modelname : "";
        $insertdata['data'] = $data;
        return $insertdata;
    }

    public static function getModelname($field){
        $tablepath = "\app\modules\\nbf\models\\";
        $tablename = $tablepath. $field."tbl";
        return $tablename;
    }

    
}