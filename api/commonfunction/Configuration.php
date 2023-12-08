<?php
namespace app\commonfunction;
use Yii;
use yii\helpers\Url;
class Configuration extends \yii\base\BaseObject {
    
//    CONST NO_IMAGE_BASE_PATH = '/assets/img/noimage.svg';
   
    public function json($newarray,$filename) {        
        $path = getcwd().'/modules/backend/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename.'.json', 'w');
        fwrite($fp, json_encode($newarray));
    }
    public function getjson($filename) {        
        $path = getcwd().'/modules/backend/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename.'.json', 'r');
        $arr = fread($fp, filesize($path.$filename.'.json'));
        $jsondecode = json_decode($arr, true);
        if($filename == 'Company'){
            $jsondecode['companyAddress'] = base64_decode($jsondecode['companyAddress']);
        }
        if($filename == 'Scripts'){
            $jsondecode['footerScripts'] = base64_decode($jsondecode['footerScripts']);
            $jsondecode['headerScripts'] = base64_decode($jsondecode['headerScripts']);
        }
        return json_encode($jsondecode);
    }
    public function getjsonDataApplication($filename,$element = null) {        
        $path = getcwd().'/modules/backend/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename.'.json', 'r');
        $arr = fread($fp, filesize($path.$filename.'.json'));
        $jsondecode = json_decode($arr, true);     
        return (!empty($element))?$jsondecode[$element]:$jsondecode;
	}
	public function getfilekeyvalue($filename,$element) {        
        $path = getcwd().'/modules/backend/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename.'.json', 'r');
        $arr = fread($fp, filesize($path.$filename.'.json'));
        $jsondecode = json_decode($arr, true);     
        return $jsondecode[$element];
	}
	public function getfilepath($filename,$element,$field) {        
        $path = getcwd().'/modules/backend/json/';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename.'.json', 'r');
        $arr = fread($fp, filesize($path.$filename.'.json'));
        $jsondecode = json_decode($arr, true);    
        return $jsondecode[$element][0][$field];
    }
    public function getAllJsonData() {   
        $dir = getcwd().'/modules/backend/json/*';
        $fileList = glob($dir);
        $jsondecode = [];
        foreach($fileList as $filename){
            if(is_file($filename)){
                $basename = basename($filename);                
                $fp = fopen($filename, 'r');
                $arr = fread($fp, filesize($filename));
                $jsondecode[] = json_decode($arr,true);   
            }   
        }    
        return json_encode($jsondecode);
    }
    public function getProductjsonData($jsondata) {   
        $path = getcwd().'\..\gbf\src\assets\product.json';
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path, 'w');
        fwrite($fp, $jsondata);
    }
    public function dateFormatList() {
        return '<select name="dateFormat" class="custom-select form-control">
            <option value="">Select Date Format</option>
            <option value="%d-%m-%Y">31-01-2019</option>
            <option value="%m-%d-%Y">01-31-2019</option>
            <option value="%Y-%m-%d">2019-01-31</option>
            <option value="%d-%m-%y">31-01-19</option>
            <option value="%m-%d-%y">01-31-19</option>
            <option value="%m.%d.%Y">01.31.2019</option>
            <option value="%d.%m.%Y">31.01.2019</option>
            <option value="%Y.%m.%d">2019.01.31</option>
        </select>';
    }
    public function timeFormatList() {
        return '<select class="custom-select form-control" name="timeFormat">
            <option value="">Select Time Format</option>
            <option value="g:i a">12:51 pm</option>
            <option value="g:i A">12:51 PM</option>
            <option value="H:i">12:51</option>
        </select>';
    }
    public function timeZoneList() {
        return '<select class="custom-select form-control" name="timeZone">
            <option value="">Select Time Zone Format</option>
            <option value="Pacific/Midway">(UTC -11:00) Pacific/Midway</option>
		<option value="Pacific/Niue">(UTC -11:00) Pacific/Niue</option>
		<option value="Pacific/Pago_Pago">(UTC -11:00) Pacific/Pago_Pago</option>
		<option value="America/Adak">(UTC -10:00) America/Adak</option>
		<option value="Pacific/Honolulu">(UTC -10:00) Pacific/Honolulu</option>
		<option value="Pacific/Johnston">(UTC -10:00) Pacific/Johnston</option>
		<option value="Pacific/Rarotonga">(UTC -10:00) Pacific/Rarotonga</option>
		<option value="Pacific/Tahiti">(UTC -10:00) Pacific/Tahiti</option>
		<option value="Pacific/Marquesas">(UTC -09:30) Pacific/Marquesas</option>
		<option value="America/Anchorage">(UTC -09:00) America/Anchorage</option>
		<option value="America/Juneau">(UTC -09:00) America/Juneau</option>
		<option value="America/Nome">(UTC -09:00) America/Nome</option>
		<option value="America/Sitka">(UTC -09:00) America/Sitka</option>
		<option value="America/Yakutat">(UTC -09:00) America/Yakutat</option>
		<option value="Pacific/Gambier">(UTC -09:00) Pacific/Gambier</option>
		<option value="America/Dawson">(UTC -08:00) America/Dawson</option>
		<option value="America/Los_Angeles">(UTC -08:00) America/Los_Angeles</option>
		<option value="America/Metlakatla">(UTC -08:00) America/Metlakatla</option>
		<option value="America/Santa_Isabel">(UTC -08:00) America/Santa_Isabel</option>
		<option value="America/Tijuana">(UTC -08:00) America/Tijuana</option>
		<option value="America/Vancouver">(UTC -08:00) America/Vancouver</option>
		<option value="America/Whitehorse">(UTC -08:00) America/Whitehorse</option>
		<option value="Pacific/Pitcairn">(UTC -08:00) Pacific/Pitcairn</option>
		<option value="America/Boise">(UTC -07:00) America/Boise</option>
		<option value="America/Cambridge_Bay">(UTC -07:00) America/Cambridge_Bay</option>
		<option value="America/Chihuahua">(UTC -07:00) America/Chihuahua</option>
		<option value="America/Creston">(UTC -07:00) America/Creston</option>
		<option value="America/Dawson_Creek">(UTC -07:00) America/Dawson_Creek</option>
		<option value="America/Denver">(UTC -07:00) America/Denver</option>
		<option value="America/Edmonton">(UTC -07:00) America/Edmonton</option>
		<option value="America/Hermosillo">(UTC -07:00) America/Hermosillo</option>
		<option value="America/Inuvik">(UTC -07:00) America/Inuvik</option>
		<option value="America/Mazatlan">(UTC -07:00) America/Mazatlan</option>
		<option value="America/Ojinaga">(UTC -07:00) America/Ojinaga</option>
		<option value="America/Phoenix">(UTC -07:00) America/Phoenix</option>
		<option value="America/Yellowknife">(UTC -07:00) America/Yellowknife</option>
		<option value="America/Bahia_Banderas">(UTC -06:00) America/Bahia_Banderas</option>
		<option value="America/Belize">(UTC -06:00) America/Belize</option>
		<option value="America/Chicago">(UTC -06:00) America/Chicago</option>
		<option value="America/Costa_Rica">(UTC -06:00) America/Costa_Rica</option>
		<option value="America/El_Salvador">(UTC -06:00) America/El_Salvador</option>
		<option value="America/Guatemala">(UTC -06:00) America/Guatemala</option>
		<option value="America/Indiana/Knox">(UTC -06:00) America/Indiana/Knox</option>
		<option value="America/Indiana/Tell_City">(UTC -06:00) America/Indiana/Tell_City</option>
		<option value="America/Managua">(UTC -06:00) America/Managua</option>
		<option value="America/Matamoros">(UTC -06:00) America/Matamoros</option>
		<option value="America/Menominee">(UTC -06:00) America/Menominee</option>
		<option value="America/Merida">(UTC -06:00) America/Merida</option>
		<option value="America/Mexico_City">(UTC -06:00) America/Mexico_City</option>
		<option value="America/Monterrey">(UTC -06:00) America/Monterrey</option>
		<option value="America/North_Dakota/Beulah">(UTC -06:00) America/North_Dakota/Beulah</option>
		<option value="America/North_Dakota/Center">(UTC -06:00) America/North_Dakota/Center</option>
		<option value="America/North_Dakota/New_Salem">(UTC -06:00) America/North_Dakota/New_Salem</option>
		<option value="America/Rainy_River">(UTC -06:00) America/Rainy_River</option>
		<option value="America/Rankin_Inlet">(UTC -06:00) America/Rankin_Inlet</option>
		<option value="America/Regina">(UTC -06:00) America/Regina</option>
		<option value="America/Resolute">(UTC -06:00) America/Resolute</option>
		<option value="America/Swift_Current">(UTC -06:00) America/Swift_Current</option>
		<option value="America/Tegucigalpa">(UTC -06:00) America/Tegucigalpa</option>
		<option value="America/Winnipeg">(UTC -06:00) America/Winnipeg</option>
		<option value="Pacific/Galapagos">(UTC -06:00) Pacific/Galapagos</option>
		<option value="America/Atikokan">(UTC -05:00) America/Atikokan</option>
		<option value="America/Bogota">(UTC -05:00) America/Bogota</option>
		<option value="America/Cancun">(UTC -05:00) America/Cancun</option>
		<option value="America/Cayman">(UTC -05:00) America/Cayman</option>
		<option value="America/Detroit">(UTC -05:00) America/Detroit</option>
		<option value="America/Eirunepe">(UTC -05:00) America/Eirunepe</option>
		<option value="America/Guayaquil">(UTC -05:00) America/Guayaquil</option>
		<option value="America/Havana">(UTC -05:00) America/Havana</option>
		<option value="America/Indiana/Indianapolis">(UTC -05:00) America/Indiana/Indianapolis</option>
		<option value="America/Indiana/Marengo">(UTC -05:00) America/Indiana/Marengo</option>
		<option value="America/Indiana/Petersburg">(UTC -05:00) America/Indiana/Petersburg</option>
		<option value="America/Indiana/Vevay">(UTC -05:00) America/Indiana/Vevay</option>
		<option value="America/Indiana/Vincennes">(UTC -05:00) America/Indiana/Vincennes</option>
		<option value="America/Indiana/Winamac">(UTC -05:00) America/Indiana/Winamac</option>
		<option value="America/Iqaluit">(UTC -05:00) America/Iqaluit</option>
		<option value="America/Jamaica">(UTC -05:00) America/Jamaica</option>
		<option value="America/Kentucky/Louisville">(UTC -05:00) America/Kentucky/Louisville</option>
		<option value="America/Kentucky/Monticello">(UTC -05:00) America/Kentucky/Monticello</option>
		<option value="America/Lima">(UTC -05:00) America/Lima</option>
		<option value="America/Nassau">(UTC -05:00) America/Nassau</option>
		<option value="America/New_York">(UTC -05:00) America/New_York</option>
		<option value="America/Nipigon">(UTC -05:00) America/Nipigon</option>
		<option value="America/Panama">(UTC -05:00) America/Panama</option>
		<option value="America/Pangnirtung">(UTC -05:00) America/Pangnirtung</option>
		<option value="America/Port-au-Prince">(UTC -05:00) America/Port-au-Prince</option>
		<option value="America/Rio_Branco">(UTC -05:00) America/Rio_Branco</option>
		<option value="America/Thunder_Bay">(UTC -05:00) America/Thunder_Bay</option>
		<option value="America/Toronto">(UTC -05:00) America/Toronto</option>
		<option value="Pacific/Easter">(UTC -05:00) Pacific/Easter</option>
		<option value="America/Caracas">(UTC -04:30) America/Caracas</option>
		<option value="America/Anguilla">(UTC -04:00) America/Anguilla</option>
		<option value="America/Antigua">(UTC -04:00) America/Antigua</option>
		<option value="America/Aruba">(UTC -04:00) America/Aruba</option>
		<option value="America/Barbados">(UTC -04:00) America/Barbados</option>
		<option value="America/Blanc-Sablon">(UTC -04:00) America/Blanc-Sablon</option>
		<option value="America/Boa_Vista">(UTC -04:00) America/Boa_Vista</option>
		<option value="America/Curacao">(UTC -04:00) America/Curacao</option>
		<option value="America/Dominica">(UTC -04:00) America/Dominica</option>
		<option value="America/Glace_Bay">(UTC -04:00) America/Glace_Bay</option>
		<option value="America/Goose_Bay">(UTC -04:00) America/Goose_Bay</option>
		<option value="America/Grand_Turk">(UTC -04:00) America/Grand_Turk</option>
		<option value="America/Grenada">(UTC -04:00) America/Grenada</option>
		<option value="America/Guadeloupe">(UTC -04:00) America/Guadeloupe</option>
		<option value="America/Guyana">(UTC -04:00) America/Guyana</option>
		<option value="America/Halifax">(UTC -04:00) America/Halifax</option>
		<option value="America/Kralendijk">(UTC -04:00) America/Kralendijk</option>
		<option value="America/La_Paz">(UTC -04:00) America/La_Paz</option>
		<option value="America/Lower_Princes">(UTC -04:00) America/Lower_Princes</option>
		<option value="America/Manaus">(UTC -04:00) America/Manaus</option>
		<option value="America/Marigot">(UTC -04:00) America/Marigot</option>
		<option value="America/Martinique">(UTC -04:00) America/Martinique</option>
		<option value="America/Moncton">(UTC -04:00) America/Moncton</option>
		<option value="America/Montserrat">(UTC -04:00) America/Montserrat</option>
		<option value="America/Port_of_Spain">(UTC -04:00) America/Port_of_Spain</option>
		<option value="America/Porto_Velho">(UTC -04:00) America/Porto_Velho</option>
		<option value="America/Puerto_Rico">(UTC -04:00) America/Puerto_Rico</option>
		<option value="America/Santo_Domingo">(UTC -04:00) America/Santo_Domingo</option>
		<option value="America/St_Barthelemy">(UTC -04:00) America/St_Barthelemy</option>
		<option value="America/St_Kitts">(UTC -04:00) America/St_Kitts</option>
		<option value="America/St_Lucia">(UTC -04:00) America/St_Lucia</option>
		<option value="America/St_Thomas">(UTC -04:00) America/St_Thomas</option>
		<option value="America/St_Vincent">(UTC -04:00) America/St_Vincent</option>
		<option value="America/Thule">(UTC -04:00) America/Thule</option>
		<option value="America/Tortola">(UTC -04:00) America/Tortola</option>
		<option value="Atlantic/Bermuda">(UTC -04:00) Atlantic/Bermuda</option>
		<option value="America/St_Johns">(UTC -03:30) America/St_Johns</option>
		<option value="America/Araguaina">(UTC -03:00) America/Araguaina</option>
		<option value="America/Argentina/Buenos_Aires">(UTC -03:00) America/Argentina/Buenos_Aires</option>
		<option value="America/Argentina/Catamarca">(UTC -03:00) America/Argentina/Catamarca</option>
		<option value="America/Argentina/Cordoba">(UTC -03:00) America/Argentina/Cordoba</option>
		<option value="America/Argentina/Jujuy">(UTC -03:00) America/Argentina/Jujuy</option>
		<option value="America/Argentina/La_Rioja">(UTC -03:00) America/Argentina/La_Rioja</option>
		<option value="America/Argentina/Mendoza">(UTC -03:00) America/Argentina/Mendoza</option>
		<option value="America/Argentina/Rio_Gallegos">(UTC -03:00) America/Argentina/Rio_Gallegos</option>
		<option value="America/Argentina/Salta">(UTC -03:00) America/Argentina/Salta</option>
		<option value="America/Argentina/San_Juan">(UTC -03:00) America/Argentina/San_Juan</option>
		<option value="America/Argentina/San_Luis">(UTC -03:00) America/Argentina/San_Luis</option>
		<option value="America/Argentina/Tucuman">(UTC -03:00) America/Argentina/Tucuman</option>
		<option value="America/Argentina/Ushuaia">(UTC -03:00) America/Argentina/Ushuaia</option>
		<option value="America/Asuncion">(UTC -03:00) America/Asuncion</option>
		<option value="America/Bahia">(UTC -03:00) America/Bahia</option>
		<option value="America/Belem">(UTC -03:00) America/Belem</option>
		<option value="America/Campo_Grande">(UTC -03:00) America/Campo_Grande</option>
		<option value="America/Cayenne">(UTC -03:00) America/Cayenne</option>
		<option value="America/Cuiaba">(UTC -03:00) America/Cuiaba</option>
		<option value="America/Fortaleza">(UTC -03:00) America/Fortaleza</option>
		<option value="America/Godthab">(UTC -03:00) America/Godthab</option>
		<option value="America/Maceio">(UTC -03:00) America/Maceio</option>
		<option value="America/Miquelon">(UTC -03:00) America/Miquelon</option>
		<option value="America/Montevideo">(UTC -03:00) America/Montevideo</option>
		<option value="America/Paramaribo">(UTC -03:00) America/Paramaribo</option>
		<option value="America/Recife">(UTC -03:00) America/Recife</option>
		<option value="America/Santarem">(UTC -03:00) America/Santarem</option>
		<option value="America/Santiago">(UTC -03:00) America/Santiago</option>
		<option value="Antarctica/Palmer">(UTC -03:00) Antarctica/Palmer</option>
		<option value="Antarctica/Rothera">(UTC -03:00) Antarctica/Rothera</option>
		<option value="Atlantic/Stanley">(UTC -03:00) Atlantic/Stanley</option>
		<option value="America/Noronha">(UTC -02:00) America/Noronha</option>
		<option value="America/Sao_Paulo">(UTC -02:00) America/Sao_Paulo</option>
		<option value="Atlantic/South_Georgia">(UTC -02:00) Atlantic/South_Georgia</option>
		<option value="America/Scoresbysund">(UTC -01:00) America/Scoresbysund</option>
		<option value="Atlantic/Azores">(UTC -01:00) Atlantic/Azores</option>
		<option value="Atlantic/Cape_Verde">(UTC -01:00) Atlantic/Cape_Verde</option>
		<option value="Africa/Abidjan">(UTC -00:00) Africa/Abidjan</option>
		<option value="Africa/Accra">(UTC -00:00) Africa/Accra</option>
		<option value="Africa/Bamako">(UTC -00:00) Africa/Bamako</option>
		<option value="Africa/Banjul">(UTC -00:00) Africa/Banjul</option>
		<option value="Africa/Bissau">(UTC -00:00) Africa/Bissau</option>
		<option value="Africa/Casablanca">(UTC -00:00) Africa/Casablanca</option>
		<option value="Africa/Conakry">(UTC -00:00) Africa/Conakry</option>
		<option value="Africa/Dakar">(UTC -00:00) Africa/Dakar</option>
		<option value="Africa/El_Aaiun">(UTC -00:00) Africa/El_Aaiun</option>
		<option value="Africa/Freetown">(UTC -00:00) Africa/Freetown</option>
		<option value="Africa/Lome">(UTC -00:00) Africa/Lome</option>
		<option value="Africa/Monrovia">(UTC -00:00) Africa/Monrovia</option>
		<option value="Africa/Nouakchott">(UTC -00:00) Africa/Nouakchott</option>
		<option value="Africa/Ouagadougou">(UTC -00:00) Africa/Ouagadougou</option>
		<option value="Africa/Sao_Tome">(UTC -00:00) Africa/Sao_Tome</option>
		<option value="America/Danmarkshavn">(UTC -00:00) America/Danmarkshavn</option>
		<option value="Antarctica/Troll">(UTC -00:00) Antarctica/Troll</option>
		<option value="Atlantic/Canary">(UTC -00:00) Atlantic/Canary</option>
		<option value="Atlantic/Faroe">(UTC -00:00) Atlantic/Faroe</option>
		<option value="Atlantic/Madeira">(UTC -00:00) Atlantic/Madeira</option>
		<option value="Atlantic/Reykjavik">(UTC -00:00) Atlantic/Reykjavik</option>
		<option value="Atlantic/St_Helena">(UTC -00:00) Atlantic/St_Helena</option>
		<option value="Europe/Dublin">(UTC -00:00) Europe/Dublin</option>
		<option value="Europe/Guernsey">(UTC -00:00) Europe/Guernsey</option>
		<option value="Europe/Isle_of_Man">(UTC -00:00) Europe/Isle_of_Man</option>
		<option value="Europe/Jersey">(UTC -00:00) Europe/Jersey</option>
		<option value="Europe/Lisbon">(UTC -00:00) Europe/Lisbon</option>
		<option value="Europe/London">(UTC -00:00) Europe/London</option>
		<option value="UTC">(UTC -00:00) UTC</option>
		<option value="Africa/Algiers">(UTC +01:00) Africa/Algiers</option>
		<option value="Africa/Bangui">(UTC +01:00) Africa/Bangui</option>
		<option value="Africa/Brazzaville">(UTC +01:00) Africa/Brazzaville</option>
		<option value="Africa/Ceuta">(UTC +01:00) Africa/Ceuta</option>
		<option value="Africa/Douala">(UTC +01:00) Africa/Douala</option>
		<option value="Africa/Kinshasa">(UTC +01:00) Africa/Kinshasa</option>
		<option value="Africa/Lagos">(UTC +01:00) Africa/Lagos</option>
		<option value="Africa/Libreville">(UTC +01:00) Africa/Libreville</option>
		<option value="Africa/Luanda">(UTC +01:00) Africa/Luanda</option>
		<option value="Africa/Malabo">(UTC +01:00) Africa/Malabo</option>
		<option value="Africa/Ndjamena">(UTC +01:00) Africa/Ndjamena</option>
		<option value="Africa/Niamey">(UTC +01:00) Africa/Niamey</option>
		<option value="Africa/Porto-Novo">(UTC +01:00) Africa/Porto-Novo</option>
		<option value="Africa/Tunis">(UTC +01:00) Africa/Tunis</option>
		<option value="Arctic/Longyearbyen">(UTC +01:00) Arctic/Longyearbyen</option>
		<option value="Europe/Amsterdam">(UTC +01:00) Europe/Amsterdam</option>
		<option value="Europe/Andorra">(UTC +01:00) Europe/Andorra</option>
		<option value="Europe/Belgrade">(UTC +01:00) Europe/Belgrade</option>
		<option value="Europe/Berlin">(UTC +01:00) Europe/Berlin</option>
		<option value="Europe/Bratislava">(UTC +01:00) Europe/Bratislava</option>
		<option value="Europe/Brussels">(UTC +01:00) Europe/Brussels</option>
		<option value="Europe/Budapest">(UTC +01:00) Europe/Budapest</option>
		<option value="Europe/Busingen">(UTC +01:00) Europe/Busingen</option>
		<option value="Europe/Copenhagen">(UTC +01:00) Europe/Copenhagen</option>
		<option value="Europe/Gibraltar">(UTC +01:00) Europe/Gibraltar</option>
		<option value="Europe/Ljubljana">(UTC +01:00) Europe/Ljubljana</option>
		<option value="Europe/Luxembourg">(UTC +01:00) Europe/Luxembourg</option>
		<option value="Europe/Madrid">(UTC +01:00) Europe/Madrid</option>
		<option value="Europe/Malta">(UTC +01:00) Europe/Malta</option>
		<option value="Europe/Monaco">(UTC +01:00) Europe/Monaco</option>
		<option value="Europe/Oslo">(UTC +01:00) Europe/Oslo</option>
		<option value="Europe/Paris">(UTC +01:00) Europe/Paris</option>
		<option value="Europe/Podgorica">(UTC +01:00) Europe/Podgorica</option>
		<option value="Europe/Prague">(UTC +01:00) Europe/Prague</option>
		<option value="Europe/Rome">(UTC +01:00) Europe/Rome</option>
		<option value="Europe/San_Marino">(UTC +01:00) Europe/San_Marino</option>
		<option value="Europe/Sarajevo">(UTC +01:00) Europe/Sarajevo</option>
		<option value="Europe/Skopje">(UTC +01:00) Europe/Skopje</option>
		<option value="Europe/Stockholm">(UTC +01:00) Europe/Stockholm</option>
		<option value="Europe/Tirane">(UTC +01:00) Europe/Tirane</option>
		<option value="Europe/Vaduz">(UTC +01:00) Europe/Vaduz</option>
		<option value="Europe/Vatican">(UTC +01:00) Europe/Vatican</option>
		<option value="Europe/Vienna">(UTC +01:00) Europe/Vienna</option>
		<option value="Europe/Warsaw">(UTC +01:00) Europe/Warsaw</option>
		<option value="Europe/Zagreb">(UTC +01:00) Europe/Zagreb</option>
		<option value="Europe/Zurich">(UTC +01:00) Europe/Zurich</option>
		<option value="Africa/Blantyre">(UTC +02:00) Africa/Blantyre</option>
		<option value="Africa/Bujumbura">(UTC +02:00) Africa/Bujumbura</option>
		<option value="Africa/Cairo">(UTC +02:00) Africa/Cairo</option>
		<option value="Africa/Gaborone">(UTC +02:00) Africa/Gaborone</option>
		<option value="Africa/Harare">(UTC +02:00) Africa/Harare</option>
		<option value="Africa/Johannesburg">(UTC +02:00) Africa/Johannesburg</option>
		<option value="Africa/Kigali">(UTC +02:00) Africa/Kigali</option>
		<option value="Africa/Lubumbashi">(UTC +02:00) Africa/Lubumbashi</option>
		<option value="Africa/Lusaka">(UTC +02:00) Africa/Lusaka</option>
		<option value="Africa/Maputo">(UTC +02:00) Africa/Maputo</option>
		<option value="Africa/Maseru">(UTC +02:00) Africa/Maseru</option>
		<option value="Africa/Mbabane">(UTC +02:00) Africa/Mbabane</option>
		<option value="Africa/Tripoli">(UTC +02:00) Africa/Tripoli</option>
		<option value="Africa/Windhoek">(UTC +02:00) Africa/Windhoek</option>
		<option value="Asia/Amman">(UTC +02:00) Asia/Amman</option>
		<option value="Asia/Beirut">(UTC +02:00) Asia/Beirut</option>
		<option value="Asia/Damascus">(UTC +02:00) Asia/Damascus</option>
		<option value="Asia/Gaza">(UTC +02:00) Asia/Gaza</option>
		<option value="Asia/Hebron">(UTC +02:00) Asia/Hebron</option>
		<option value="Asia/Jerusalem">(UTC +02:00) Asia/Jerusalem</option>
		<option value="Asia/Nicosia">(UTC +02:00) Asia/Nicosia</option>
		<option value="Europe/Athens">(UTC +02:00) Europe/Athens</option>
		<option value="Europe/Bucharest">(UTC +02:00) Europe/Bucharest</option>
		<option value="Europe/Chisinau">(UTC +02:00) Europe/Chisinau</option>
		<option value="Europe/Helsinki">(UTC +02:00) Europe/Helsinki</option>
		<option value="Europe/Istanbul">(UTC +02:00) Europe/Istanbul</option>
		<option value="Europe/Kaliningrad">(UTC +02:00) Europe/Kaliningrad</option>
		<option value="Europe/Kiev">(UTC +02:00) Europe/Kiev</option>
		<option value="Europe/Mariehamn">(UTC +02:00) Europe/Mariehamn</option>
		<option value="Europe/Riga">(UTC +02:00) Europe/Riga</option>
		<option value="Europe/Sofia">(UTC +02:00) Europe/Sofia</option>
		<option value="Europe/Tallinn">(UTC +02:00) Europe/Tallinn</option>
		<option value="Europe/Uzhgorod">(UTC +02:00) Europe/Uzhgorod</option>
		<option value="Europe/Vilnius">(UTC +02:00) Europe/Vilnius</option>
		<option value="Europe/Zaporozhye">(UTC +02:00) Europe/Zaporozhye</option>
		<option value="Africa/Addis_Ababa">(UTC +03:00) Africa/Addis_Ababa</option>
		<option value="Africa/Asmara">(UTC +03:00) Africa/Asmara</option>
		<option value="Africa/Dar_es_Salaam">(UTC +03:00) Africa/Dar_es_Salaam</option>
		<option value="Africa/Djibouti">(UTC +03:00) Africa/Djibouti</option>
        </select>';
    }
    public function currencyList() {
        return '<select class="custom-select form-control" name="currencyName">
            <option value="">Select Currency </option>
            <option value="AUD">Australian Dollar</option>
		<option value="BAN">Bangladesh</option>
		<option value="VEF">Bol?var Fuerte</option>
		<option value="BRL">Brazilian Real</option>
		<option value="GBP">British Pound</option>
		<option value="CAD">Canadian Dollar</option>
		<option value="CLP">Chilean Peso</option>
		<option value="CNY">Chinese Yuan</option>
		<option value="CZK">Czech Koruna</option>
		<option value="DKK">Danish Krone</option>
		<option value="EUR">Euro</option>
		<option value="HKD">Hong Kong Dollar</option>
		<option value="HUF">Hungarian Forint</option>
		<option value="INR">Indian Rupee</option>
		<option value="IDR">Indonesian Rupiah</option>
		<option value="ILS">Israeli New Shekel</option>
		<option value="JPY">Japanese Yen</option>
		<option value="KRW">Korean Won</option>
		<option value="MYR">Malaysian Ringgit</option>
		<option value="MXN">Mexican Peso</option>
		<option value="NZD">New Zealand Dollar</option>
		<option value="NOK">Norwegian Krone</option>
		<option value="PKR">Pakistan Rupee</option>
		<option value="PHP">Philippine Peso</option>
		<option value="PLN">Polish Zloty</option>
		<option value="RUB">Russian Ruble</option>
		<option value="SGD">Singapore Dollar</option>
		<option value="ZAR">South African Rand</option>
		<option value="SEK">Swedish Krona</option>
		<option value="CHF">Swiss Franc</option>
		<option value="TWD">Taiwan Dollar</option>
		<option value="THB">Thai Baht</option>
		<option value="TRY">Turkish Lira</option>
		<option value="USD">US Dollar</option>
        </select>';
    }
    public function currencySymbols() {
            $currency_symbols = array(
                    'AED' => '&#1583;.&#1573;', // ?
                    'AFN' => '&#65;&#102;',
                    'ALL' => '&#76;&#101;&#107;',
//                    'AMD' => '',
                    'ANG' => '&#402;',
                    'AOA' => '&#75;&#122;', // ?
                    'ARS' => '&#36;',
                    'AUD' => '&#36;',
                    'AWG' => '&#402;',
                    'AZN' => '&#1084;&#1072;&#1085;',
                    'BAM' => '&#75;&#77;',
                    'BBD' => '&#36;',
                    'BDT' => '&#2547;', // ?
                    'BGN' => '&#1083;&#1074;',
                    'BHD' => '.&#1583;.&#1576;', // ?
                    'BIF' => '&#70;&#66;&#117;', // ?
                    'BMD' => '&#36;',
                    'BND' => '&#36;',
                    'BOB' => '&#36;&#98;',
                    'BRL' => '&#82;&#36;',
                    'BSD' => '&#36;',
                    'BTN' => '&#78;&#117;&#46;', // ?
                    'BWP' => '&#80;',
                    'BYR' => '&#112;&#46;',
                    'BZD' => '&#66;&#90;&#36;',
                    'CAD' => '&#36;',
                    'CDF' => '&#70;&#67;',
                    'CHF' => '&#67;&#72;&#70;',
//                    'CLF' => '', // ?
                    'CLP' => '&#36;',
                    'CNY' => '&#165;',
                    'COP' => '&#36;',
                    'CRC' => '&#8353;',
                    'CUP' => '&#8396;',
                    'CVE' => '&#36;', // ?
                    'CZK' => '&#75;&#269;',
                    'DJF' => '&#70;&#100;&#106;', // ?
                    'DKK' => '&#107;&#114;',
                    'DOP' => '&#82;&#68;&#36;',
                    'DZD' => '&#1583;&#1580;', // ?
                    'EGP' => '&#163;',
                    'ETB' => '&#66;&#114;',
                    'EUR' => '&#8364;',
                    'FJD' => '&#36;',
                    'FKP' => '&#163;',
                    'GBP' => '&#163;',
                    'GEL' => '&#4314;', // ?
                    'GHS' => '&#162;',
                    'GIP' => '&#163;',
                    'GMD' => '&#68;', // ?
                    'GNF' => '&#70;&#71;', // ?
                    'GTQ' => '&#81;',
                    'GYD' => '&#36;',
                    'HKD' => '&#36;',
                    'HNL' => '&#76;',
                    'HRK' => '&#107;&#110;',
                    'HTG' => '&#71;', // ?
                    'HUF' => '&#70;&#116;',
                    'IDR' => '&#82;&#112;',
                    'ILS' => '&#8362;',
                    'INR' => '&#8377;',
                    'IQD' => '&#1593;.&#1583;', // ?
                    'IRR' => '&#65020;',
                    'ISK' => '&#107;&#114;',
                    'JEP' => '&#163;',
                    'JMD' => '&#74;&#36;',
                    'JOD' => '&#74;&#68;', // ?
                    'JPY' => '&#165;',
                    'KES' => '&#75;&#83;&#104;', // ?
                    'KGS' => '&#1083;&#1074;',
                    'KHR' => '&#6107;',
                    'KMF' => '&#67;&#70;', // ?
                    'KPW' => '&#8361;',
                    'KRW' => '&#8361;',
                    'KWD' => '&#1583;.&#1603;', // ?
                    'KYD' => '&#36;',
                    'KZT' => '&#1083;&#1074;',
                    'LAK' => '&#8365;',
                    'LBP' => '&#163;',
                    'LKR' => '&#8360;',
                    'LRD' => '&#36;',
                    'LSL' => '&#76;', // ?
                    'LTL' => '&#76;&#116;',
                    'LVL' => '&#76;&#115;',
                    'LYD' => '&#1604;.&#1583;', // ?
                    'MAD' => '&#1583;.&#1605;.', //?
                    'MDL' => '&#76;',
                    'MGA' => '&#65;&#114;', // ?
                    'MKD' => '&#1076;&#1077;&#1085;',
                    'MMK' => '&#75;',
                    'MNT' => '&#8366;',
                    'MOP' => '&#77;&#79;&#80;&#36;', // ?
                    'MRO' => '&#85;&#77;', // ?
                    'MUR' => '&#8360;', // ?
                    'MVR' => '.&#1923;', // ?
                    'MWK' => '&#77;&#75;',
                    'MXN' => '&#36;',
                    'MYR' => '&#82;&#77;',
                    'MZN' => '&#77;&#84;',
                    'NAD' => '&#36;',
                    'NGN' => '&#8358;',
                    'NIO' => '&#67;&#36;',
                    'NOK' => '&#107;&#114;',
                    'NPR' => '&#8360;',
                    'NZD' => '&#36;',
                    'OMR' => '&#65020;',
                    'PAB' => '&#66;&#47;&#46;',
                    'PEN' => '&#83;&#47;&#46;',
                    'PGK' => '&#75;', // ?
                    'PHP' => '&#8369;',
                    'PKR' => '&#8360;',
                    'PLN' => '&#122;&#322;',
                    'PYG' => '&#71;&#115;',
                    'QAR' => '&#65020;',
                    'RON' => '&#108;&#101;&#105;',
                    'RSD' => '&#1044;&#1080;&#1085;&#46;',
                    'RUB' => '&#1088;&#1091;&#1073;',
                    'RWF' => '&#1585;.&#1587;',
                    'SAR' => '&#65020;',
                    'SBD' => '&#36;',
                    'SCR' => '&#8360;',
                    'SDG' => '&#163;', // ?
                    'SEK' => '&#107;&#114;',
                    'SGD' => '&#36;',
                    'SHP' => '&#163;',
                    'SLL' => '&#76;&#101;', // ?
                    'SOS' => '&#83;',
                    'SRD' => '&#36;',
                    'STD' => '&#68;&#98;', // ?
                    'SVC' => '&#36;',
                    'SYP' => '&#163;',
                    'SZL' => '&#76;', // ?
                    'THB' => '&#3647;',
                    'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
                    'TMT' => '&#109;',
                    'TND' => '&#1583;.&#1578;',
                    'TOP' => '&#84;&#36;',
                    'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
                    'TTD' => '&#36;',
                    'TWD' => '&#78;&#84;&#36;',
//                    'TZS' => '',
                    'UAH' => '&#8372;',
                    'UGX' => '&#85;&#83;&#104;',
                    'USD' => '&#36;',
                    'UYU' => '&#36;&#85;',
                    'UZS' => '&#1083;&#1074;',
                    'VEF' => '&#66;&#115;',
                    'VND' => '&#8363;',
                    'VUV' => '&#86;&#84;',
                    'WST' => '&#87;&#83;&#36;',
                    'XAF' => '&#70;&#67;&#70;&#65;',
                    'XCD' => '&#36;',
//                    'XDR' => '',
//                    'XOF' => '',
                    'XPF' => '&#70;',
                    'YER' => '&#65020;',
                    'ZAR' => '&#82;',
                    'ZMK' => '&#90;&#75;', // ?
                    'ZWL' => '&#90;&#36;',
            );
         
            $html='';
            $html.='<select class="custom-select form-control" name="currencySymbol">
            <option value="">Select Symbol</option>';
            foreach($currency_symbols as $key =>$symbl)
            {
                $html.= '<option value="'.$key.'">'.$symbl.'</option>';
            }
            $html.='</select>';
        return $html;
    }
    
    public function readFromJsonFile($path,$filename){
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename, 'r');
        $arr = fread($fp, filesize($path.$filename));
        
        return  json_decode($arr,true);
    }
    public function writeToJsonFile($path,$filename,$data) {     
        $data = json_encode($data);
        if(!is_dir($path)){
            mkdir($path, 0777, true);
        }
        $fp = fopen($path.$filename, 'w');
        if(fwrite($fp, $data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
//    public function currencyFormatList() {
//        return '<select class="custom-select form-control" name="currencyFormat">
//            <option value="">Select Currency Format</option>
//            <option value="1">1,234.56</option>
//            <option value="2">1.234,56</option>
//            <option value="3">1234.56</option>
//            <option value="4">1234,56</option>
//            <option value="5">1'.'.'.'234.56</option>
//            <option value="6">1 234.56</option>
//            <option value="7">1 234,56</option>
//            <option value="8">1 234'.'.'.'56</option>
//        </select>';
//    }
    
}