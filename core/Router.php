<?php
namespace app\core;

use app\core\Request;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback; 
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback; 
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        
        
        if($callback === false){
            $this->response->setStatusCode(404);
            return $this->renderContent("Not found");
           
        }
      
        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if(is_array($callback)){
           
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            foreach($controller->getMiddlewares() as $middleware  ){
                $middleware->excute();
            }

            $callback[0] = $controller;
        }
       
        return call_user_func($callback, $this->request, $this->response);
        
    }

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