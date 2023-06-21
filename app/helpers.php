<?php
use \Illuminate\Support\Facades\Redis;
use \Carbon\Carbon;


if(!function_exists("update_last_play")){
    function update_last_play($server_ip,$playbook_name)
    {
        $last_plays = Redis::get('last_plays');

        if(!$last_plays)
            $last_plays = json_encode([]);

        $last_plays = json_decode($last_plays,true);

        $last_plays[$server_ip] = [
            'time' => Carbon::now()->timestamp,
            'playbook' => $playbook_name,
        ];

        $last_plays = json_encode($last_plays);

        return Redis::set('last_plays',$last_plays);
    }
}
