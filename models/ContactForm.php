<?php
namespace app\models;

use app\core\Model;

class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [ self::RULE_RIQUIRED ],
            'email' => [ self::RULE_RIQUIRED ],
            'body' => [ self::RULE_RIQUIRED ],

        ];
    } 

    public function labels(): array
    {
        return [
            'subject' => "Doi tuong",
            'email' => "Moi ban nhap email",
            'body' => "nhap Body",

        ];
    }

    public function send()
    {
        return true;
    }

    
}