<?php 
namespace app\core;

class Show
{
    public static function all($var, $check = true)
    {
        echo "<pre>";
        var_dump($var);
        if($check){
            exit;
        }
        
    }
}