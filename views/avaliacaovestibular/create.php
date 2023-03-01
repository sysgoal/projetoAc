<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoVestibular */

$this->title = 'Realizar Avaliação Vestibular';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Vestibular', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaliacao-vestibular-create">

    <h1><?= Html::encode($this->title) ?></h1>

     <?php $form = ActiveForm::begin(); ?>

    <?php
    echo TabsX::widget([
        'items' => [
            [
                'label' => '<i class="far fa-address-card"></i> Dados Gerais',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form, 'idAluno' => $idAluno, 'idProf' => $idProf]),
                'active' => true
            ],
            [
                'label' => '<i class="fas fa-stethoscope"></i> Anamnese',
                'content' => $this->render('_form_anamnese', ['model' => $model, 'form' => $form]),
            ],
             [
                'label' => '<i class="fas fa-edit"></i> Testes',
                'content' => $this->render('_form_testes', ['model' => $model, 'form' => $form]),
            ],

        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]);
    ?>

    

    <?php ActiveForm::end(); ?>
</div>
