<?php
namespace app\core;

class View 
{
    public string $tittle = '';

    public function renderView($view, $params = [])
    {
        echo  str_replace("{{content}}", $this->renderOnlyView($view, $params), $this->layoutContent());
     
    }
    public function renderContent($content)
    {
        echo  str_replace("{{content}}", $content, $this->layoutContent());
        
    }


    public function layoutContent()
    {
        $layout = Application::$app->layout;
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
        
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        
          return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $k =>$v){
            ${$k} = $v;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}