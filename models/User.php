<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;
    const STATUS_UPDATE = 3;


    public string $name = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public string $pass = '';
    public string $repass = '';

    public function tableName() : string
    {
        return 'users';
    }


    public function labels() : array
    {
        return [
            'name' => "Ho va Ten",
            'email' => " Dia chi email",
            'pass' => "Mat Khau",
            'repass'=>  "Nhap lai Mat khau"
        ];
    }

    public function attributes(): array
    {
        return [
            'name', 'email', 'status', 'pass'
        ];
    }

    public function save()
    {
        $this->status = self::STATUS_UPDATE;
        $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
        return parent::save();
    }


    public function rules(): array
    {
        return [

            'name' =>[self::RULE_RIQUIRED],
            'email' =>[self::RULE_RIQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'pass' =>[self::RULE_RIQUIRED, [self::RULE_MIN, 'min'=> 6], [self::RULE_MAX, 'max' => 24]],
            'repass' =>[self::RULE_RIQUIRED, [self::RULE_MATCH, 'match'=>'pass']],
        ];
    }
    
}