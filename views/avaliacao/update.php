<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

$this->title = 'Atualizar avaliação: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id_avaliacao]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="avaliacao-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $alunos = $model->getDadoUmAluno($model->aluno->id);
    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo TabsX::widget([
        'items' => [
            [
                'label' => '<i class="far fa-address-card"></i> Dados Gerais',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form, 'alunos' => $alunos, 'idProf' => $idProf]),
                'active' => true
            ],
            [
                'label' => '<i class="fas fa-heartbeat"></i> Cardíaco/Circ.',
                'content' => $this->render('_form_cardiaco', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-apple-alt"></i> Digestivo',
                'content' => $this->render('_form_digestivo', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-smoking"></i> Respiratório',
                'content' => $this->render('_form_respiratorio', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-bone"></i> Ortopédico',
                'content' => $this->render('_form_ortopedico', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-child"></i> Reprodutor',
                'content' => $this->render('_form_reprodutor', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-child"></i> Fisioterápica',
                'content' => $this->render('_form_fisica', ['model' => $model, 'form' => $form]),
            ],
        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]);
    ?>


    <?php ActiveForm::end(); ?>




</div>
