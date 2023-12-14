<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

$this->title = 'Atualizar avaliação: ' . $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação Hipopressivo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aluno->nm_aluno, 'url' => ['view', 'id' => $model->id_avaliacao]];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="avaliacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

   
 <?php $form = ActiveForm::begin(); ?>

<?php

echo TabsX::widget([

    'items' => [

            [
                'label' => '<i class="far fa-address-card"></i> Dados Gerais',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form, 'idAluno' => $idAluno, 'idProf'=>$idProf]),
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
                'label' => '<i class="fas fa-ruler"></i> Perimetros',
                'content' => $this->render('_form_perimetros', ['model' => $model, 'form' => $form]),
            ],
             
            [
                'label' => '<i class="fas fa-x-ray"></i> Hipopressivo',
                'content' => $this->render('_form_hipopressivo', ['model' => $model, 'form' => $form]),
            ],
        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false    
    ]);

?>

<?php ActiveForm::end(); ?>
        
        
       

</div>
