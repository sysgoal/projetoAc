<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profissional */

$this->title = 'Visualizar Profissional';
;
$this->params['breadcrumbs'][] = ['label' => 'Profissional', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profissional-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id_profissional], ['class' => 'btn btn-primary']) ?>
        <?php
        if ($model->ds_ativo == 1) {
            echo Html::a('Desativar', ['desativar', 'id' => $model->id_profissional], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza que deseja desativar?',
                    'method' => 'post',
                ],
            ]);
        } else {
             echo Html::a('Ativar', ['ativar', 'id' => $model->id_profissional], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Tem certeza que deseja ativar?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>


    <?=
    DetailView::widget([
        'model' => $model,
        'template' => "<tr><th  style='width:300px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            'dt_cadastro',
            'nm_profissional',
            'dt_nascimento',
            'ds_cpf',
            'tp_registro',
            'nr_registro',
            'ds_endereco',
            'ds_complemento',
            'ds_bairro',
            'ds_cidade',
            'ds_estado',
            'ds_cep',
            'nr_whatsapp',
            'nr_telefone',
            [
                'attribute' => 'ds_ativo',
                'value' => function($model, $index) {
                    if ($model->ds_ativo == 1) {
                        return 'ATIVO';
                    } else {
                        return 'INATIVO';
                    }
                },
            ],
        ],
    ])
    ?>



</div>
