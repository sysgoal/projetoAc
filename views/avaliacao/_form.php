<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\jui\Dialog;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */
/* @var $form yii\widgets\ActiveForm */
?>

<br>
<div class="avaliacao-form">
<?php
Dialog::begin([
    'id' => 'caixaDialog',
    'clientOptions' => [
        'modal' => false,
        'autoOpen' => false,
        'width' => 300,
        'height' => 320,
        'title' => 'Histórico',
        
        'position' => ['my' => 'right bottom', 'at' => 'right bottom'],      
    ]
]);

echo '<div id =historicos></div>';

Dialog::end();
?>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'dt_avaliacao')->textInput(['style' => 'width:200px', 'value' => date('d/m/Y'), 'readonly' => true]) ?>            
        </div>
        <div class="col-md-6">

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">



<?=
$form->field($model, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
    'model' => $model,
    'attribute' => 'id',
    'data' => $alunos,
    'options' => ['placeholder' => ' --Selecione um paciente-- ', 'id' => 'al01'],
    'language' => 'pt_BR',
    'pluginOptions' => [
        'allowClear' => true,
    ],
])
?>     
        </div>
        <div class="col-md-2">
            <?php echo '<b>Idade: </b><br>'; ?> 
            <div id ="txt"></div>
            <?= $form->field($model, 'ds_idade_atual')->textInput(['style' => 'width:500px', 'id' => 'idade'])->label(false) ?>            
        </div>
        <div class="col-md-2">
            <?php echo '<b>Profissão: </b><br>'; ?>  
            <div id ="prof"></div>
        </div>  
        <div class="col-md-2">
            <div id="botao"></div>            

        </div>  
    </div>

    <div class="row">

        <div class="col-md-6">
<?= $form->field($model, 'ds_motivo')->textarea(['style' => 'width:500px', 'rows' => 3, 'id' => 'motivo']) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-md-6">
<?= $form->field($model, 'image1')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
<?= $form->field($model, 'image2')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
<?= $form->field($model, 'image3')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
<?= $form->field($model, 'image4')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
<?= $form->field($model, 'image5')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
<?= $form->field($model, 'image6')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
<?= $form->field($model, 'image7')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png', 'jpeg']]]); ?>
        </div>

        <div class="col-md-6">
<?= $form->field($model, 'video')->widget(\kartik\file\FileInput::className(), ['pluginOptions' => ['allowedFileExtensions' => ['avi', 'mkv', 'rmvb', 'mp4', 'AVI', 'RMVB', 'MKV', 'MP4']]]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $model->getAvaliador($idProf)->id_profissional])->label(false) ?>
        </div>
    </div>


</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <h5 class="modal-nome">Nome </h5> 
                <button type="button" class="btn btn-success" id="historico">Histórico</button>
                <button type="button" class="btn btn-success" id="visualiza">Visualizar</button>
                <button type="button" class="btn btn-primary" id="cadastraAluno">Cadastrar Aluno</button>
                <h5 class="modal-prof">Prof</h5>
                <h5 class="modal-agend">Agenda</h5>
                <h5 class="modal-horario">horario</h5>
                <h5 class="modal-just">jutificativa</h5>

                <br><br>
                <div class="row" id="combo">
                    <div class="col-md-4">
                        <select class="form-control" style="width:180px" id="selecao">
                            <option value="selecione" selected>Selecione</option>
                            <option value="Finalizado">Finalizado</option>
                            <option value="Não Compareceu" >Não Compareceu</option>
                            <option value="Falta Justificada">Falta Justificada</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success" id="salvar">&nbsp;&nbsp; Salvar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="excluir">Excluir</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>

            </div>
        </div>
    </div>
</div>