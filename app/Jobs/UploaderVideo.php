<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Vimeo\Laravel\Facades\Vimeo;
class UploaderVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $name;
    protected $id;

    public function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileZip =  storage_path() . "/app/public/tmp/" . $this->name;
        $zip = \Zip::open($fileZip);
        $zip->extract(storage_path() . "/app/public/tmp_unzip");

        $path_parts  = pathinfo($this->name);
        $fileName = $path_parts['filename'] . ".mp4";
        $filePut =  storage_path() . "/app/public/tmp_unzip/" . $fileName;
        // giải nén

        $vimeo = Vimeo::connection('main');
       $response = $vimeo->upload($filePut, [
                    'name' =>  $fileName
               ]);

//        //lay ten video vua upload
        $arrResponse = explode('/', $response);
        $name_response = "";
        if(isset($arrResponse[2])){
            $name_response = $arrResponse[2];
        }
        if(!empty($name_response)){
            \App\Lesson::where('id', $this->id)->update([ 'video_full' => $name_response ]);
        }

        Storage::disk('public')->delete('tmp/' . $this->name);
        Storage::disk('public')->delete('tmp_unzip/' .$fileName);
    }
}
