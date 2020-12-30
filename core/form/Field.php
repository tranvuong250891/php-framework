<?php
namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attr;
    public const TYPE_TEXT = 'text';
    public const TYPE_PASS = 'password';
    public const TYPE_NUMBER = 'number';



    /**
     * Class constructor.
     */
    public function __construct(Model $model, string $attr)
    {
        $this->type = 'text';
        $this->model = $model;
        $this->attr = $attr;
    }

    public function __toString()
    {
        return sprintf('<div class="mb-3">
        <label class="form-label">%s</label>
        <input type="%s" name="%s" value="%s" class="form-control %s" >
        <div class="invalid-feedback">
               %s 
            </div>
      </div>',
            $this->model->labels()[$this->attr] ?? $this->attr,
            $this->type,
            $this->attr,
            $this->model->{$this->attr},
            $this->model->hasError($this->attr) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attr),


        );
    }


    public function passField()
    {
        $this->type = self::TYPE_PASS;
        return $this;
    }


}