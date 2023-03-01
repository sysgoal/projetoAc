<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */


?>
<div class="avaliacao-view">

     <?php $form = ActiveForm::begin(); ?>

<?php

echo TabsX::widget([

    'items' => [

            [

                'label' => 'Avaliação',

                'content' => $this->render('_view_avaliacao', ['model' => $model, 'form' => $form]),

                'active' => true

            ],

      
    ],

    ]);

?>

<?php ActiveForm::end(); ?>
        
        
       

</div>


  