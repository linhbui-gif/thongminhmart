<?php

namespace App\Helper;

class Log{

    private $folder;

    public function __construct($folder)
    {
        $this->folder = $folder;
    }

    public function put($fileName, $message){

        $pathFile = storage_path() . "/logs/" . $this->folder . "/" . $fileName . ".log";

        if(!file_exists(storage_path() . "/logs/" . $this->folder)){
            \File::makeDirectory(storage_path() . "/logs/" . $this->folder);
        }
        file_put_contents($pathFile, $message . PHP_EOL, FILE_APPEND);

    }



}


?>
