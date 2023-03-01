<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoSuperior */

$this->title = 'Realizar avaliação superior';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação superior', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="avaliacao-superior-create">

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
