<?php
namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '' ;
    public string $pass = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_RIQUIRED, self::RULE_EMAIL],
            'pass' => [ self::RULE_RIQUIRED  ],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => "Email cua ban",
            'pass' => "Nhap Mat khau"

        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'email nay` khong ton` tai. !!!');
            return false;

        }

        if(password_verify($this->pass, $user->pass)){
            $this->addError('pass', 'mat. khau nay` khong dung');
            return false;
        }
       
        
        return Application::$app->login($user);

        
    }


}