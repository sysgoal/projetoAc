<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = $model->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$script = <<< JS
        
$(document).ready(function() {
  $('.fancy-box').magnificPopup({type:'image'});
});               
$('#abrirModal').click(function(){ 
    $("#myModalAluno").modal("show");        
    });

   
JS;

$this->registerJs($script);
?>
<div class="aluno-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->user->identity->permissao != null && (Yii::$app->user->identity->permissao === 'Secretaria' || Yii::$app->user->identity->permissao === 'Administrador')) {
            echo Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>



    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            //verificar template valores para diminiur coluna
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            //'contentOptions' => ['style' => 'width:10px;'], 
            'attributes' => [
                'id',
                'dt_registro',
                'nm_aluno',
                'ds_cpf',
                'ds_sexo',
                'ds_identidade',
                'ds_cep',
                'ds_endereco',
                'ds_complemento',
                'ds_telefone1',
                'ds_telefone2',
                'ds_observacao',
                [
                    'attribute' => 'id_convenio',
                    'value' => function($model, $index) {
                        if ($model->convenio != null) {
                            return $model->convenio->ds_nome;
                        } else {
                            return 'Não há';
                        }
                    },
                ],
                [
                    'attribute' => 'fl_paciente',
                    'value' => function($model, $index) {
                        if ($model->fl_paciente == '0') {
                            return 'Não';
                        } else {
                            return 'Sim';
                        }
                    },
                ],
                ['attribute' => 'id_profissional',
                    'value' => function($model, $index) {
                        if ($model->profissional != null) {
                            return $model->profissional->nm_profissional;
                        } else {
                            return 'Não há';
                        }
                    },
                ],
                [
                    'attribute' => 'Declaração',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->declaracao != null) {
                            $url = Yii::getAlias('@web') . '/declaracao/' . $model->declaracao;
                            return Html::a('Visualizar declaração', Url::to($url), ['class' => 'btn btn-primary', 'target' => '_blank']);
                        } else {
                            return 'Não há';
                        }
                    }
                ],
                [
                    'attribute' => 'Anexos',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::button('Anexos', ['class' => 'btn btn-primary', 'id' => 'abrirModal']);
                    }
                ],
            ],
        ])
        ?>


    </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >

        <?=
        DetailView::widget([
            'model' => $model,
            //verificar template valores para diminiur coluna
            'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
            //'contentOptions' => ['style' => 'width:10px;'], 
            'attributes' => [
                [
                    'attribute' => 'Foto',
                    'format' => ['raw', ['width' => '100', 'height' => '100']],
                    'value' => function($model, $index) {
                        if ($model->filename == null) {
                            return 'Sem foto';
                        } else {
                            return Html::a(Html::img(Yii::getAlias('@web') . '/images/' . $model->filename, ['width' => '100', 'height' => '100']), ['foto', 'filename' => $model->filename]);
                        }
                    },
                ],
                'dt_nascimento',
                'ds_responsaveis',
                'ds_parentesco',
                'ds_bairro',
                'ds_cidade',
                'ds_estado',
                'ds_email:email',
                'ds_profissao',
                'ds_whatsapp',
                'nr_matricula_conv',
                ['attribute' => 'dt_validade',
                    'value' => function($model, $index) {
                        if ($model->dt_validade == '31/12/1969' || $model->dt_validade == '02/12/0002') {
                            return null;
                        } else {
                            return $model->dt_validade;
                        }
                    },
                ],
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
            ]
        ]);
        ?>
    </div>

</div>

<div class="modal fade" id="myModalAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Anexos</h4>
            </div>
            <div class="modal-body">                
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    $arquivo = 'ds_arquivo'.$i;
                    if ($model->$arquivo != null) {
                        echo '<div class=row>';
                        echo '<div class=col-md-6>';
                        echo '<h5 class=modal-nome>';
                        echo $model->$arquivo;
                        echo '</h5></div>';
                        echo '<div class=col-md-3>';
                            $url = Yii::getAlias('@web') . '/arquivos/' . $model->$arquivo;
                        echo Html::a('Visualizar', Url::to($url), ['class' => 'btn btn-primary', 'target' => '_blank']);                      
                        echo '</div></div>';
                    }
                }
                ?>
            </div>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="fecha">Fechar</button>            
        </div>
    </div>
</div>

