<?php
namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASS = 'password';
    public const TYPE_NUMBER = 'number';
    public string $type;

    public function __construct(Model $model, string $attr)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct( $model, $attr);

    }

    public function renderInput(): string
    {
        return sprintf( '<input type="%s" name="%s" value="%s" class="form-control %s" >',
            $this->type,
            $this->attr,
            $this->model->{$this->attr},
            $this->model->hasError($this->attr) ? 'is-invalid' : '',
        );
    }

    public function passField()
    {
        $this->type = self::TYPE_PASS;
        return $this;
    }


}