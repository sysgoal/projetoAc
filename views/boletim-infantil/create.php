<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BoletimInfantil */

$this->title = 'Festa das Toucas';
$this->params['breadcrumbs'][] = ['label' => 'Festa das Toucas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boletim-infantil-create">
 <div align="center"><h1><?= Html::encode($this->title) ?></h1></div>
    

    <?= $this->render('_form', [
        'model' => $model, 'situacao' => $situacao,
        'model2' => $model2,
    ]) ?>

</div>
