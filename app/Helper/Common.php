<?php
namespace App\Helper;

use Illuminate\Support\Facades\Cache;

class Common {
    public static function getFromCache($key){
        $cache = Cache::get($key);
        if ($cache){
            return $cache;
        }
        else{
            return false;
        }
    }
    public static function putToCache($key, $value, $time = 120)
    {
        Cache::put($key, $value, $time);
        return true;
    }

    public static function getStatusOrder($ma){
        $config = config("edushop.ghtk");
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $config['link'] . "/services/shipment/v2/" . $ma,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER => array(
                "Token: " . $config['token'],
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
    public static function getTotalTimeLesson($chapters){

        $totalGiay = 0;
        foreach($chapters as $k => $chapter){
            $lessons = $chapter->lessons;
            foreach($lessons as $k_l => $lesson){
                $strTime = $lesson->time_full;
                if($strTime == null || empty($strTime)){
                    $strTime = "0:0:0";
                }
                $arrTime = explode(":", $strTime);
                $gio = $arrTime[0];
                $phut = $arrTime[1];
                $giay = $arrTime[2];

                $totalGiay += $gio * 3600 + $phut * 60 + $giay;
            }
        }
        $gio = floor($totalGiay / 3600);
        $phut = floor(($totalGiay / 60) % 60 );
        $giay = $totalGiay % 60;
        $strTime = sprintf("%02d",$gio) . ":" . sprintf("%02d",$phut) . ":" . sprintf("%02d",$giay);
        return $strTime;
    }
    public static function getTotalLesson($chapters){
        $total = 0;
        foreach($chapters as $k => $chapter){
            $total += count($chapter->lessons);
        }
        return $total;
    }
    public static function showStatusOrder($status){
        $config_status = config("edushop.order_status");
        $status = isset($config_status[$status]) ? $config_status[$status] : $config_status[0];
        $html = '<span>'.$status.'</span>';
        return $html;
    }
    public static function showPaymentMethod($method){
        $config_status = config("edushop.payment_method");
        $status = isset($config_status[$method]) ? $config_status[$method] : $config_status['cod'];
        $html = '<span>'.$status.'</span>';
        return $html;
    }
    public static function showTypeProductName($type){
        $config_status = config("edushop.type_product");
        $status = isset($config_status[$type]) ? $config_status[$type] : $config_status['product'];
        $html = '<span>'.$status.'</span>';
        return $html;
    }
    public static function getShortNameController($controller){
        $controller = preg_replace("#Controller#", "", $controller);
        return strtolower($controller);
    }
    public static function createCheckBox($items, $name){
        $html = '';
        foreach($items as $k => $item){
            $html .= '<div class="checkbox">
                               <label><input name="'.$name.'" class="minimal" type="checkbox" value="'.$k.'"> '.$item.'</label>
                      </div>';
        }
        return $html;
    }
    public static function showThumb($folderUpload, $fileName, $type = ""){
        $public_path = base_path().'/public_html';
        if($type == ""){

            $path = public_path() . "/images/" . $folderUpload . "/" . $fileName;
//            dd(public_path());
            if(!empty($fileName) && file_exists($path)){

                return asset("/images/" . $folderUpload . "/" . $fileName);
            }else{
                return asset("/images/default.jpg");
            }
        }else{
            $path = public_path() . "/images/" . $folderUpload . "/" . $type . "/" . $fileName;
            if(!empty($fileName)  && file_exists($path)){
                return asset("/images/" . $folderUpload .  "/" . $type . "/" . $fileName);
            }else{
                return asset("/images/default.jpg");
            }
        }
    }

}

?>
