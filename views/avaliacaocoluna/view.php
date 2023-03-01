<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoColuna */

$this->title = $model->aluno->nm_aluno;
$this->params['breadcrumbs'][] = ['label' => 'Avaliação de coluna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaliacao-coluna-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if ($model->situacao !== 'Concluída' && (Yii::$app->user->identity->permissao == 'Profissional') || Yii::$app->user->identity->permissao == 'Administrador' ) {
            echo Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
    </p>
    
   <div class="col-sm-6 col-md-6 col-lg-6" >
    <?= DetailView::widget([
        'model' => $model,
        'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
        'attributes' => [
            ['format' => 'raw',
                    'attribute' => 'Paciente',
                    'value' => function($model) {
                        return Html::a('Visualizar', ['aluno/view', 'id' => $model->id_aluno], ['class' => 'btn btn-primary', 'target' => '_blank']);
                    }
                ],
                'situacao',
            [                
              'attribute'=>'Profissão',              
              'value' => function($model, $index){
                return $model->aluno->ds_profissao;                  
              },
                    
            ],
            [                
              'attribute'=>'Data de nascimento',              
              'value' => function($model, $index){
                return $model->aluno->dt_nascimento;                  
              },
                    
            ],
            'dt_avaliacao',
            'cd_avaliacao',            
            'nr_tempo_servico',
            [                
              'attribute'=>'ds_cuidador',              
              'value' => function($model, $index){
                return $model->aluno->ds_responsaveis;                  
              },
                    
            ],                      
            [                
              'attribute'=>'ds_parentesco',              
              'value' => function($model, $index){
                return $model->aluno->ds_parentesco;                  
              },
                    
            ],
            'ds_diagnostico_medico',
            'ds_medico_responsavel',
            'ds_queixa_atual',
            'ds_disfuncao_avds',
            'ds_hma',
            'ds_dor',
            'ds_localizacao',
            'ds_frequencia_dor',
            'ds_caracteristica_dor',
            'ds_patologia_associada',
            'ds_medicamento_uso',
            'ds_hp_hf_hs',
            'ds_cirurgia_internacao',
            'ds_fisioterapia_quando',
            'ds_locomocao',            
            
        ],
    ]) ?>

   </div>
    <div class="col-sm-6 col-md-6 col-lg-6" >

    <?= DetailView::widget([
         'model' => $model,
        //verificar template valores para diminiur coluna
        'template' => "<tr><th  style='width:250px'>{label}</th><td>{value}</td></tr>",
         //'contentOptions' => ['style' => 'width:10px;'], 
         'attributes' => [
             [                
              'attribute'=>'id_profissional',             
              'value' => function($model, $index){               
                  return $model->profissional->nm_profissional;            
              },
                    
            ],     
                       
            'ds_avaliacao_postural',          
            'ds_movimentacao_ativa',
            'ds_compressao',
            'ds_observacao_compressao',
            'ds_distracao',
            'ds_observacao_distracao',
            'ds_slump',
            'ds_observacao_slump',
            'ds_esfigmomanometro',
            'ds_obs_esfigmomanometro',
            'ds_gillet',
            'ds_observacao_gillet',
            'ds_mackenzie',
            'ds_obs_mackenzie',
            'ds_william',
            'ds_obs_william',
            'ds_subirdescer',
            'ds_obs_subirdescer',
            'ds_piriforme',
            'ds_obs_piriforme',
            'ds_exames_complementares',
            'ds_conduta',
            
             ]
             ]);


    ?>
   </div>
    
</div>
