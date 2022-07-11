<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Common;
use App\Http\Controllers\Controller;
use App\User as MainModel;

use Carbon\Carbon;
use App\Helper\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class TranslateController extends Controller
{
    protected $pathView = "admin.page.translate.";
    protected $searchList = [
        'all' => 'Search By All',
        'id' => 'Search By Id',
        'email' => 'Search By Email'
    ];
    protected $listFile = [
        'sidebar',"auth", "pagination", "passwords"
    ];
    public function __construct(){
        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->controllerName = $shortController;
        $this->folderUpload = $shortController;
        view()->share("controller", $shortController);
        view()->share("folderUpload", $this->folderUpload);
        view()->share("pathView", $this->pathView);
        view()->share("searchList", $this->searchList);
        view()->share("controllerName", $this->controllerName);
        $this->locate = app()->getLocale();
        $this->model = new MainModel();
    }
    public function index(Request $request){
        $this->locate = app()->getLocale();
        $params = $request->all();
        $params['search_list'] = $this->searchList;
        $params['search_type'] = isset($params['search_type']) && in_array($params['search_type'], array_flip($this->searchList) ) ? $params['search_type'] : "all";
        $params['search_value'] = isset($params['search_value']) ? $params['search_value'] : "";
        $data['params'] = $params;

        $langCurrent = $this->locate;
        $arrLang = [];
        foreach($this->listFile as $k => $fileName){
            $arrLang[$fileName] = $this->read( $langCurrent, $fileName);
        }
        $data['arrLang'] =  $arrLang;

        $controller = (new \ReflectionClass($this))->getShortName();
        $shortController = Common::getShortNameController($controller);
        $this->logFolder = $shortController;

        if($this->logFolder){
            $time = Carbon::now()->format('H:i:s');
            $message = "[$time] " . Auth::user()->email . " view";
            $log = new Log($this->logFolder);
            $log->put("log-" . date("Y-m-d"), $message);
        }

        return view($this->pathView . 'index')->with($data);
    }
    public function update(Request $request){
        $this->locate = app()->getLocale();
        $data = $request->data;
        $langCurrent = $this->locate;
        foreach($data as $file_name => $items){
            $this->save($file_name, $items);
        }
        return redirect()->back();
    }
    private function read($lang, $file)
    {
        if ($lang == '') $lang = App::getLocale();
        $this->path = base_path().'/resources/lang/'.$lang.'/'.$file.'.php';
        $arrayLang = Lang::get($file);
        if (gettype($arrayLang) == 'string') $arrayLang = array();
        return $arrayLang;
    }
    private function save($fileName ,$items)
    {
        $this->locate = app()->getLocale();
        $content = "<?php\n\nreturn\n[\n";

        foreach ($items as $k => $v)
        {
            $v = addslashes($v);
            $content .= "\t'".$k."' => '".$v."',\n";
        }

        $content .= "];";
        $path = base_path().'/resources/lang/'.$this->locate.'/'.$fileName.'.php';
        file_put_contents($path, $content);


    }

}
