<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form ActiveForm */
$script = <<< JS
$("#modal1").modal("hide");
$("#visualizar").click(function() { 
  $("#modal1").modal("show");
  $("#tabela3 .trAppend").remove();
  
  $("#modal1 .modal-title").html("Histórico do Atendimento");
  var id = $('#visualizar').val();
  $.get("index.php?r=horario-agenda/dados-aluno", {
    idAluno: id
  }, function(data) {
    var dtnasc = data.dt_nascimento;
    var nome = data.nm_aluno;
    var hoje = new Date;
    var arrDataExclusao = dtnasc.split("/");
    var stringFormatada = arrDataExclusao[1] + "-" + arrDataExclusao[0] + "-" + arrDataExclusao[2];
    var dataFormatada1 = new Date(stringFormatada);
    var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25); 
   $("#modal1 .modal-nome").html("Aluno/Paciente: <b>" + nome + "</b>&nbsp;&nbsp;&nbsp;");
    $("#modal1 .modal-dt").html("Data de Nascimento: <b>" + formataDate(dtnasc, "pt-br") + "</b>&nbsp;&nbsp;&nbsp;");
    $("#modal1 .modal-idade").html("Idade<b>: " + idade + " anos</b>&nbsp;&nbsp;&nbsp;");
    $("#modal1 .modal-sexo").html("Sexo: <b>" + data.ds_sexo + "</b>&nbsp;&nbsp;&nbsp;");
    $.get("index.php?r=horario-agenda/dados-convenio", {
      id: data.id_convenio
    }, function(data2) {
      if (data2 != null && data2.ds_nome != null) {
        $("#modal1 .modal-just").html("Convênio: <b>" + data2.ds_nome + "</b>&nbsp;&nbsp;&nbsp;");
      }
    });
  });
  $.get("index.php?r=horario-agenda/dados-agenda", {
    idAluno: id
  }, function(data) {
    data.forEach(historicoAtendimento);
  });
  $.get("index.php?r=horario-agenda/dados-avaliacao", {
    id: id
  }, function(data) {
    data.forEach(historicoAtendimento21);
  });
});

function historicoAtendimento(item, indice) {
    if (item.ds_objetivo == null) {
      item.ds_objetivo = "";
    }
    if (item.ds_descricao == null) {
      item.ds_descricao = "";
    }
      indice = parseInt(indice) + 1;
   $("#tabela").append("<tr class=trAppend><th rowspan=2 style=text-align:center;>" + formataDate(item.dt_inicio, "pt-br") + "</th><th rowspan=2 style=text-align:center;>" + indice + "</th><th style=text-align:center;>" + item.ds_descricao + "</th><th rowspan=2 style=text-align:center;>" + item.nome + "</th><th rowspan=2 style=text-align:center;>" + item.ds_agendamento + "</th></tr><tr><th style=text-align:center;>" + item.ds_objetivo + "</th></tr>");
    
  
}
        
$("#fechar").click(function() {
  location.reload();
});

function historicoAtendimento21(item) {
  if(item.dataAvaliacao != null && item.tpAvaliacao != null){
     $("#tabela4").append("<tr class=trAppend><th style=text-align:center;>" + formataDate(item.dataAvaliacao, "pt-br") + "</th><th style=text-align:center;>" + item.tpAvaliacao + "</th><th style=text-align:center;>" + item.profissional + "</th></tr>");

   }
}
    
function formataDate(data, formato) {
  if (formato == "pt-br") {
    return (data.substr(0, 10).split("-").reverse().join("/"));
  } else {
    return (data.substr(0, 10).split("/").reverse().join("-"));
  }
}
JS;
$this->registerJs($script);
?>
<div class="aluno-index">
    <?php $alunos = $searchModel->getListNameAluno(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //  ['class' => 'yii\grid\SerialColumn'],            
            [
                'attribute' => 'nm_aluno',
                'contentOptions' => ['style' => 'width:700px; white-space: normal;'],
                'value' => function ($model, $index, $widget) {
                    return $model->nm_aluno;
                },
                'filter' => Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'id',
                            'data' => $alunos,
                            'options' => ['placeholder' => ' --Selecione um paciente-- '],
                            'language' => 'pt_BR',
                            'pluginOptions' => [
                                'allowClear' => true,
                                'width' => '500px',
                            ],
                        ]
                ),
            ],
            'ds_cpf',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{create}',
                // 'visible' => Yii::$app->user->isGuest ? false : true,
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['title' => Yii::t('app', 'Histórico'),
                                    'id' => 'visualizar', 'value'=>$model->id
                        ]);
//return Html::a('<span class="glyphicon glyphicon-plus"></span>', $url, [
                        //	'title' => Yii::t('yii', 'Create'),
//				]);                                         
                    }
                ]
            ],
        ],
    ]);
    ?>


</div><!-- aluno-index -->

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard="false" data-backdrop="static" >
   <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">                                
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <th><h5 class="modal-nome">Nome </h5> </th> 
                                        <th><h5 class="modal-sexo">Sexo </h5> </th> 
                                        <th><h5 class="modal-dt">Data de Nascimento </h5> </th> 
                                        <th><h5 class="modal-idade">Idade</h5> </th>

                                    </tr>
                                    <br/>
 
                                </table>
                                <br/><br/>
                                <div class="list-group panel">
                                    <a href="#submenu1" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Histórico de atendimento <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="submenu1" style="height: 0px;">                                                       
                                        <table id="tabela" border="1px"  width="850">                                                              
                                            <tr><th rowspan="2" style="text-align: center; background-color: gray">Data </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Sessão </th>
                                                <th style="text-align: center; background-color: gray">Descrição </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Profissional </th>
                                                <th rowspan="2" style="text-align: center; background-color: gray">Status </th>

                                            </tr> 
                                            <tr>                                                                 
                                                <th style="text-align: center; background-color: gray">Observação </th>
                                            </tr> 

                                        </table>

                                    </div>                                          

                                    <a href="#submenu2" class="list-group-item sub-item collapsed" data-toggle="collapse" data-parent="#submenu1">Histórico de Avaliações <span class=" menu-ico-collapse"><i class="glyphicon glyphicon-chevron-down"></i></span></a>
                                    <div class="list-group-submenu collapse" id="submenu2" style="height: 0px;">                                                       
                                     

                                        <table id="tabela4" border="1px"  width="850">                                                              
                                            <tr><th style="text-align: center; background-color: gray">Data </th>
                                                <th  style="text-align: center; background-color: gray">Tipo de Avaliação </th>                                                                  
                                                <th  style="text-align: center; background-color: gray">Profissional </th>
                                            </tr> 


                                        </table>
                                    </div>
                                </div>
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="fechar">Fechar</button>
                            </div>
                        </div>
                          
   </div>
</div>
                                
