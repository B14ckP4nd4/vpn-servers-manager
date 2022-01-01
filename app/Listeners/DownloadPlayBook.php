<?php

namespace App\Listeners;

use App\AnsibleFileManager;
use App\Events\PlayBookAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class DownloadPlayBook implements ShouldQueue
{
    use InteractsWithQueue;

    public $queue = 'playbooks';

    public $tries = 5;


    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PlayBookAdded  $event
     * @return void
     */
    public function handle(PlayBookAdded $event)
    {
        $playbook = $event->playbook;

        /*
         * determine saving path
         */
        $file_name= AnsibleFileManager::clearName($playbook->name,'yml');
        $savePath = config('ansible.playbook_path');

        /*
         * download and save the file to storage and playbooks path
         */
        $data = $this->downloadFile( $playbook->url );
        $playBookPath = AnsibleFileManager::saveFile($file_name, $savePath, $data);

        /*
         * update PlayBook
         */
        $playbook->update([
            'name' => $file_name,
            'path' => $playBookPath,
            'last_updated_at' => Carbon::now(),
        ]);
    }

    protected function downloadFile($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

}
