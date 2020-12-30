<?php
namespace app\core\form;

use app\core\Model;

class Form 
{
    public static function begin($action, $method = 'post')
    {
        echo sprintf('<form class="container" action="%s" method="%s">', $action, $method);
         return new Form();

    }

    public function field(Model $model, $attr)
    {
        return new Field($model, $attr);
    }

    public static function end()
    {
        return '</form>';
    }
}