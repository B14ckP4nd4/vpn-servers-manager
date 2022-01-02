<?php


namespace App;


use App\Models\InventoryItem;
use App\Models\InventoryVar;
use Illuminate\Support\Collection;

class AnsibleFileManager
{
    /**
     * determine constructor
     */
    public function __construct()
    {

    }

    /**
     * remove special chars from name
     *
     * @param string $name
     * @param string | boolean $extension
     * @return string
     */
    public static function clearName($name, $extension = false){
        $file_name = str_replace(' ', '-', $name);
        $file_name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file_name);;
        $file_name = preg_replace('/[^A-Za-z0-9\-_]/', '', $file_name);

        if($extension)
            $extension = ltrim($extension,'.');
            $file_name = $file_name . '.' . $extension;

        return $file_name;
    }


    /**
     * generate inventory file content from the base data
     * @param Collection $hosts
     * @param array $vars
     * @return string
     */
    public static function generateInventoryFile(Collection $hosts, array $vars)
    {
        $content = [];

        // set hosts
        foreach ($hosts as $host)
        {
            $content[] = $host->server;
        }

        // set vars
        if(!empty($vars)){
            $content[] = "[all:vars]";

            foreach ($vars as $var){
                $value = str_replace("'", "\\'", $var['val']);
                $content[] = "{$var['name']}='$value'";
            }
        }

        return implode("\n",$content);
    }


    /**
     * save the content and set permission
     * @param string $fileName
     * @param string $path
     * @param string $content
     * @return string
     */
    public static function saveFile($fileName, $path = null, $content = null,$append = false){
        if(!is_null($path)){
            $fileName = ltrim($fileName, '/');
            $path = rtrim($path , '/');
            $fullPath = $path . '/' . $fileName;
        }
        else
        {
            $fullPath = $fileName;
        }

        if(file_exists($fullPath)){
            $newFile = fopen($fullPath,"w+");
            fwrite($newFile, $content);
            fclose($newFile);
        }
        else
        {
            $newFile= fopen($fullPath, 'w+');

            if($append)
                $newFile= fopen($fullPath, 'w');

            fwrite($newFile, $content);
            fclose($newFile);

            chmod($fullPath, 0664);
        }

        return $fullPath;
    }

    /**
     * load a file
     * @param $filePath
     * @return false|string
     * @throws \Exception
     */
    public static function loadFile($filePath)
    {
        if(!file_exists($filePath))
            return false;

        // get contents of a file into a string
        $handle = fopen($filePath, "r");
        $contents = fread($handle, filesize($filePath));
        fclose($handle);

        return $contents;
    }
}
