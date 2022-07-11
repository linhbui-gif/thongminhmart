<?php

namespace App\Http\Controllers\Api;

use App\Province;
use App\District;
use Validator;
use App\Ward;
use App\Http\Controllers\Controller;
use App\Order;
use App\Address;
use App\Coupon;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogsApiController extends BaseController
{

    public function checkLogs(Request $request)
    {

        $folder = $request->input('folder');
        $dateLogs = $request->input('dateLogs');

        if (isset($folder) && !isset($dateLogs)) {
            $logFiles = array_filter(
                scandir(storage_path() . '/logs/' . $folder),
                fn ($fn) => !str_starts_with($fn, '.') // filter everything that begins with dot
            );

            return [
                'status' => 'success',
                'data' => array_values($logFiles),
                'message' => 'lấy thành công'
            ];
        }

        if (isset($folder) && isset($dateLogs)) {

            // $data = file_get_contents(storage_path() . '/logs/' . $folder . '/' . $dateLogs);

            $arr = [];

            $data = fopen(storage_path() . '/logs/' . $folder . '/' . $dateLogs, "r") or die("Unable to open file!");

            while (!feof($data)) {
                $arr[] = str_replace(array("\r", "\n"), '', fgets($data));
            }
            fclose($data);

            // $dataRaw = explode('\r\n', $data);

            return [
                'status' => 'success',
                'data' => $arr,
                'message' => 'lấy thành công'
            ];
        }
    }
}
