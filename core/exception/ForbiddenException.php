<?php
namespace app\core\exception;

class ForbiddenException extends \Exception
{
    protected $message  = "you don\'n have permission to access this page!!!";
    protected $code = 403;
}