<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Config as MainModel;
use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LogsController extends AdminController
{

    public function __construct()
    {
    }
    protected function indexLogs()
    {

        $logs = [];

        $logFolder = array_diff(array_filter(
            scandir(storage_path() . '/logs'),
            fn ($fn) => !str_starts_with($fn, '.') // filter everything that begins with dot
        ), ['laravel.log', 'queue.log']);

        foreach ($logFolder as $key => $value) {

            if (is_dir(storage_path() . '/logs/' . $value)) {

                $logFiles = array_filter(
                    scandir(storage_path() . '/logs/' . $value),
                    fn ($fn) => !str_starts_with($fn, '.') // filter everything that begins with dot
                );
    
                $logs[$value] = $logFiles;
            }

        }

        $controllerName = 'Logs';

        return view('admin.logs')->with([
            'controllerName' => $controllerName,
            'logs' => $logs
        ]);
    }
    // option validate Store
    protected function validateStore(Request $request)
    {
    }
    // option validate Update
    protected function validateUpdate(Request $request, $id = "")
    {
    }
}
