<?php


namespace App;


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
        $file_name = preg_replace('/[^A-Za-z0-9\-]/', '', $file_name);

        if($extension)
            $file_name = $file_name . '.' . $extension;

        return $file_name;
    }

}
