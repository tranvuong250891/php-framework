<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\Show;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            "name" => "Vuong",    
        ];
       return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
              
                Application::$app->session->setFlash('success', 'Cam on ban da Contact !!!');
                return $response->redirect('/contact');
            }
        }
       

        return $this->render('contact', [
            'model' => $contact,
        ]);
    }

    public function form()
    {
        $params = [];
        return $this->render('form', $params);
    }


    public function handleForm(Request $request)
    {
       
        $body = $request->getBody();
      
       
    }
}