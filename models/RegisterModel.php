<?php

namespace app\models;

use app\core\Model;

class RegisterModel extends Model
{
    public string $name = '';
    public string $email = '';
    public string $pass = '';
    public string $repass = '';

    public function register()
    {
        echo "Creating new user";
    }

    public function rules(): array
    {
        return [

            'name' =>[self::RULE_RIQUIRED],
            'email' =>[self::RULE_RIQUIRED, self::RULE_EMAIL],
            'pass' =>[self::RULE_RIQUIRED, [self::RULE_MIN, 'min'=> 6], [self::RULE_MAX, 'max' => 24]],
            'repass' =>[self::RULE_RIQUIRED, [self::RULE_MATCH, 'match'=>'pass']],
        ];
    }
    
}