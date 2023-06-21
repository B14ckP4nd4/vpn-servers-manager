<?php

namespace App\Console\Commands;

use App\AnsibleFileManager;
use App\Models\Inventory;
use Illuminate\Console\Command;

class cleanLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->removeEmptyInventories();

        exec('cat /dev/null >' . storage_path('logs/laravel.log'));
        exec('cat /dev/null >' . storage_path('logs/requests.log'));
        exec('cat /dev/null >' . storage_path('logs/error.log'));

        $day = 1;

        if(date('d') < 3)
            return Command::SUCCESS;

        for($i = 1; $i <= date('d'); $i++)
        {
            exec('rm -f ' . storage_path('ansible/plays/') . '*_'.date('Y').'-'.date('m').'-'.$i.'*'.'.log');
        }

        exec('rm -f /var/logs/message*');
        exec('rm -f /var/logs/secur*');
        exec('rm -f /var/logs/maillo*');
        exec('rm -f /var/logs/cro*');
        exec('rm -f /var/logs/httpd/error_log-*');
        exec('rm -f /var/logs/httpd/access_log-*');
        exec('find /var -name "*.log" \( \( -size +50M -mtime +7 \) -o -mtime +30 \) -exec truncate {} --size 0 \;');
        exec('yum clean all');
        exec('rm -rf /var/cache/yum');
        exec('rm -rf /var/tmp/yum-*');
        exec('rm -rf /root/.npm /home/*/.npm /root/.node-gyp /home/*/.node-gyp /tmp/npm-*');
        exec('rm -rf /root/.npm /home/*/.npm /root/.node-gyp /home/*/.node-gyp /tmp/npm-*');
        exec('rm -rf /var/cache/mock/* /var/lib/mock/*');
        exec('rm -rf /home/*/.cache/*/* /root/.cache/*/* ');

        $this->comment('Logs have been cleared!');


        return Command::SUCCESS;
    }

    private function removeEmptyInventories(){
        $inventoriesPath = storage_path('ansible/inventories');
        $inventoriFiles = scandir($inventoriesPath);
        unset($inventoriFiles[0]);
        unset($inventoriFiles[1]);

        $inventories = Inventory::orderBy('id','ASC')->get();

        $activeInventories = [];

        foreach ($inventories as $inventory){
            $filename = AnsibleFileManager::clearName($inventory->name , 'ini');
            $inventoryHosts = $inventory->items()->get();

            if($inventoryHosts->count() > 0)
            {
                $activeInventories[] = $filename;
            }
        }

        foreach ($inventoriFiles as $inventoriFile){
            if(!in_array($inventoriFile,$activeInventories)){
                $deletedFile = $inventoriesPath . '/' . $inventoriFile;
                unset($deletedFile);
            }
        }

    }
}
