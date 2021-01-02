<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField 
{
    public Model $model;
    public string $attr;

    public function __construct(Model $model, string $attr)
    {
        $this->type = 'text';
        $this->model = $model;
        $this->attr = $attr;
    }

    abstract public function renderInput(): string; 

    public function __toString()
    {
        return sprintf('<div class="mb-3">
        <label class="form-label">%s</label>
        %s
        <div class="invalid-feedback">
               %s 
            </div>
      </div>',
            $this->model->labels()[$this->attr] ?? $this->attr,
            $this->renderInput(),
            $this->model->getFirstError($this->attr),


        );
    }
}