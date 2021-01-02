<?php 

use app\core\form\Form;
use app\core\form\TextareaField;

$this->title = "CONTACT";

// var_dump($model);

?>
<h1>This is Contact</h1>

<?php
    $form = Form::begin('/contact');

    echo $form->field($model, 'subject');
    echo $form->field($model, 'email');
    echo new TextareaField($model, 'body');
?>
 <button type="submit" class="btn btn-primary">Submit</button>

   <?php Form::end(); ?>