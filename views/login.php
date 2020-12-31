<h1>LOGIN</h1>
<?php
  use app\core\form\Field;
  use app\core\form\Form;
?>

<?php
  
?>

<?php

  $form = Form::begin('login');
  echo $form->field($model, 'email');
  echo $form->field($model, 'pass')->passField(); 


?>
  <button type="submit" class="btn btn-primary">Submit</button>
  
  <?php   echo Form::end(); ?>
















