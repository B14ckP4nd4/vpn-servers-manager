<?php

namespace App\Listeners;

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
        $file_name= $this->clearTheName($playbook->name);
        $savePath = config('ansible.playbook_path').$file_name;

        /*
         * download and save the file to storage and playbooks path
         */
        $data = $this->downloadFile( $playbook->url );
        file_put_contents( $savePath, $data );

        /*
         * update PlayBook
         */
        $playbook->update([
            'name' => $file_name,
            'path' => $savePath,
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

    protected function clearTheName($name){
        $file_name = str_replace(' ', '-', $name);
        $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);;
        $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file_name);
        $file_name = $file_name . '.yml';

        return $file_name;
    }
}
