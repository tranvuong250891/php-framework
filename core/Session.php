<?php
namespace app\core;

class Session 
{
    protected const FLASH_KEY = 'flash_message';







    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage){
            $flashMessage['removed'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        // var_dump($_SESSION[self::FLASH_KEY]);
        

    }

    public function setflash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message,

        ];
    }

    public function getflash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false; 
    }


    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach($flashMessages as $key => &$flashMessage){
            if($flashMessage['removed']){
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages ;

        

    }    
}