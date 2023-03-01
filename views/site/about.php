<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'ACESSO NEGADO';
echo $model->getNavBar();
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        VOCÊ NÃO ESTÁ AUTORIZADO A VISUALIZAR ESSA PÁGINA, POR FAVOR, FAÇA O LOGIN
    </p>
<?=
$this->render('login', ['model'=>$model,])
?>

</div>
