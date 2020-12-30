<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            "name" => "Vuong",    
        ];
       return $this->render('home', $params);
    }

    public function contact()
    {
        $params = [];
        return $this->render('contact', $params);
    }

    public function form()
    {
        $params = [];
        return $this->render('form', $params);
    }


    public function handleForm(Request $request)
    {
       
        $body = $request->getBody();
        var_dump($body);
       
    }
}