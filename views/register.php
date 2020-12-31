<h1>REGISTER FORM</h1>
<?php
  use app\core\form\Field;
  use app\core\form\Form;
?>

<?php
 
?>

<?php

  $form = Form::begin('register');
  echo $form->field($model, 'name');
  echo $form->field($model, 'email'); 
  echo $form->field($model, 'pass')->passField();
  echo $form->field($model, 'repass')->passField();

?>
  <button type="submit" class="btn btn-primary">Submit</button>
  
  <?php   echo Form::end(); ?>
















