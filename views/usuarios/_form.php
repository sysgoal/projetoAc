<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
 $('#senha').val('');

JS;
$this->registerJs($script);

?>

<div class="usuarios-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">

    <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'id'=>'usuario','autocomplete' => 'novo']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'cpf', ['options' => ['style' => 'width: 150px', 'id' => 'cpf']])->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99999999999']) ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'id'=> 'senha', 'autocomplete'=> 'new-password']) ?>
        </div>
         <div class="col-md-6">
   <?php $lista = ['Secretaria' => 'Secretaria', 'Profissional' => 'Profissional', 'Administrador' => 'Administrador']; ?>
            <?= $form->field($model, 'permissao')->dropDownList($lista, ['style' => 'width:200px']) ?> 
       </div>
    </div>
     <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'id'=> 'email']) ?>
        </div>
     </div>
    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
