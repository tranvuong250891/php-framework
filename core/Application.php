<?php
namespace app\core;



use app\core\Request;
use app\core\Router;
use app\core\Controller;
use app\models\User;

class Application 
{

    public string $layout = 'main';
    public static string $ROOT_DIR; 
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;  
    public ?Controller $controller = null;
    public Session $session;
    public static Application $app;
    public Database $db;
    public ?DBModel $user;


    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();  
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,  $this->response);    
        $this->db = new Database($config['db']);
        
      
        $keyName = $this->userClass::primaryKey();
        $keyValue = $this->session->get('user');

        if($keyValue){
            $this->user = $this->userClass::findOne([$keyName => $keyValue ]);
        } else{
            $this->user = null;
        }
    }

    public function isGuest()
    {   
        return !self::$app->user;  
    }   

    public function run()
    {
        try {
            $this->router->resolve();
           return;
        } catch (\Exception $e) {
            echo "111";
        }
        
    }

    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller) : void
    {
        $this->controller = $controller;
    }

    public function login(DBModel $user)
    {
        $this->user = $user ?? false;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

}