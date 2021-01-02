<?php
namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\Show;

class AuthMiddleware extends BaseMiddleware 
{
    public array $actions = [];


    public function __construct(array $action = [])
    {
        $this->actions = $action;
      
    }
    
        
    

    public function execute()
    {

        if(Application::isGuest()){
        
            if(empty($this->actions) || in_array( Application::$app->controller->action, $this->actions) ){
              
                throw new ForbiddenException();
            }

        }
    }
        
   
}