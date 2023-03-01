<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoSuperior */

$this->title = 'Atualizar avaliação superior: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Superior', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="avaliacao-superior-update">

 <h1><?= Html::encode($this->title) ?></h1>

  <?php 
$form = ActiveForm::begin(); ?> 
<?php
echo TabsX::widget([
        'items' => [

            [
                'label' =>'<i class="far fa-address-card"></i> Dados Gerais',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form, 'idAluno' => $idAluno, 'idProf'=> $idProf]),
                'active' => true
            ],

            [
                'label' => '<i class="fas fa-stethoscope"></i> Anamnese',
                'content' => $this->render('_form_anamnese', ['model' => $model, 'form' => $form]),
            ],
        
            [
                'label' => '<i class="fas fa-dumbbell"></i> Exame Físico',
                'content' =>  $this->render('_form_fisica', ['model' => $model, 'form' => $form]),

            ],
        
            [
                'label' => '<i class="fas fa-edit"></i> Testes Específicos',
                'content' =>  $this->render('_form_testes', ['model' => $model, 'form' => $form]),

            ],
        
    ],

    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
?>


<?php ActiveForm::end(); ?>
</div>

