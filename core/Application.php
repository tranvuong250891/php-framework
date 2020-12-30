<?php
namespace app\core;



use app\core\Request;
use app\core\Router;
use app\core\Controller;

class Application 
{

    public static string $ROOT_DIR; 
    public Router $router;
    public Request $request;
    public Response $response;  
    public Controller $controller;
    public Session $session;
    public static Application $app;
    public Database $db;


    public function __construct($rootPath, array $config)
    {

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();  
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,  $this->response);    
        $this->db = new Database($config['db']);



    }

    public function run()
    {
        $this->router->resolve();
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller) : void
    {
        $this->controller = $controller;
    }



}