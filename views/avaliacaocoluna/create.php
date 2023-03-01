<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AvaliacaoColuna */


$script = <<< JS

var resultadoAval;
$('#al01').change(function() {
    $('#botao').empty();
    var id = $(this).val();  
    $.get('index.php?r=avaliacaocoluna/get-dados-aluno', { id: id},function(data){
           var data = $.parseJSON(data);        
            var url = "/web/index.php?r=aluno/view&id="+data.id;
            $("#botao").append("<a href="+url+" target=_blank>Visualizar</a>").addClass("far fa-address-card");
        if(data.id_convenio == null || data.id_convenio == ""){        
            document.getElementById("conv").innerHTML="Não há";
        }else{    
            $.get('index.php?r=avaliacaocoluna/get-dados-aluno-convenio', { id: data.id_convenio}, function(data2){
            var data2 = $.parseJSON(data2);                   
            document.getElementById("conv").innerHTML=data2.ds_nome;
        });  
    }

    if(data.ds_parentesco == null || data.ds_parentesco == ""){
        document.getElementById("parente").innerHTML="Não há";
        document.getElementById("cuid").innerHTML="Não há";
     }else{
        document.getElementById("parente").innerHTML=data.ds_parentesco;
        document.getElementById("cuid").innerHTML=data.ds_responsaveis;
     }
       
    document.getElementById("prof").innerHTML=data.ds_profissao;
    var dtnasc = data.dt_nascimento;
    var hoje = new Date;
    var arrDataExclusao = dtnasc.split('/');
    var stringFormatada = arrDataExclusao[1] + '-' + arrDataExclusao[0] + '-' +
     arrDataExclusao[2];
    var dataFormatada1 = new Date(stringFormatada);    
   var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
     document.getElementById("txt").innerHTML=idade + " anos ";  
   });   
        
         $.get('index.php?r=avaliacaocoluna/get-avaliacoes', {id: id}, function(data) {                     
             resultadoAval = parseData(data); 
            if(resultadoAval != null && resultadoAval[0] != null && resultadoAval[0].dt_avaliacao != null){
              $('#caixaDialog').dialog( 'open' ); 
            }else{
              $('#caixaDialog').dialog( 'close' ); 
            }
             
         }); 
  
   });
 
        validaTextArea('diagnostico');
 
        function validaTextArea(nomeId){
          
            let contador = 0;
            $('#'+nomeId+'').keyup(function(e){             
            if (e.keyCode != 13){
                contador++;            
            }
            if(contador >= 43 && e.keyCode == 32){
           $('#'+nomeId+'').val($('#'+nomeId+'').val()+'\\n');
             contador = 0;
            }
        });
        }
        
 $('#diagnostico').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_diagnostico_medico + '<br/>';
             });     
            $('#historicos').html('<b><u>Diagnóstico Médico</u></b> <br/>' + dadosMotivo.join(' '));        
});  
        
$('#medicoResp').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_medico_responsavel + '<br/>';
             });     
            $('#historicos').html('<b><u>Médico Responsável</u></b> <br/>' + dadosMotivo.join(' '));        
});
        
$('#tempoServico').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;             
                 if(value.nr_tempo_servico != null){
                    dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.nr_tempo_servico + '<br/>';
                  }else{
                    dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - Não informado <br/>';
                  }
             });     
            $('#historicos').html('<b><u>Tempo de trabalho em horas</u></b> <br/>' + dadosMotivo.join(' '));        
});
 
 $('#medicamento').click(function() { 
        let dadosMedicamento = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMedicamento[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_medicamento_uso + '<br/>';
             });     
            $('#historicos').html('<b><u>Medicamentos em uso</u></b> <br/>' + dadosMedicamento.join(' '));      
});
        
$('#cirurgia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_cirurgia + '<br/>';
             });     
            $('#historicos').html('<b><u>Cirurgias</u></b> <br/>' + dados.join(' '));      
});

$('#patologia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_patologia + '<br/>';
             });     
            $('#historicos').html('<b><u>Patologias</u></b> <br/>' + dados.join(' '));      
});

$('#avd').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_disfuncao_avds + '<br/>';
             });     
            $('#historicos').html('<b><u>Disfunção Avds</u></b> <br/>' + dados.join(' '));      
});

$('#queixa').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_queixa_atual + '<br/>';
             });     
            $('#historicos').html('<b><u>Queixa atual</u></b> <br/>' + dados.join(' '));      
});

$('#hma').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_hma + '<br/>';
             });     
            $('#historicos').html('<b><u>HMA</u></b> <br/>' + dados.join(' '));      
});

$('#dor').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_dor + '<br/>';
             });     
            $('#historicos').html('<b><u>Dor</u></b> <br/>' + dados.join(' '));      
});

$('#localizacao').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_localizacao + '<br/>';
             });     
            $('#historicos').html('<b><u>Localização\irradiação da dor</u></b> <br/>' + dados.join(' '));      
});
        
        
        
    function formataDate(data, formato) {
        if (formato == "pt-br") {
          return (data.substr(0, 10).split("-").reverse().join("/"));
        } else {
          return (data.substr(0, 10).split("/").reverse().join("-"));
        }    
    }

    function parseData(data) {
        if (!data) return {};
        if (typeof data === 'object') return data;
        if (typeof data === 'string') return JSON.parse(data);

        return {};
}
    

JS;
$this->registerJs($script);




$this->title = 'Realizar avaliação da coluna';
$this->params['breadcrumbs'][] = ['label' => 'Avaliação de coluna', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<div class="avaliacao-coluna-create">

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
                'label' => '<i class="fas fa-stethoscope"></i> Anamnese',
                'content' => $this->render('_form_anamnese', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-dumbbell"></i> Exame Físico',
                'content' => $this->render('_form_fisica', ['model' => $model, 'form' => $form]),
            ],
            [
                'label' => '<i class="fas fa-edit"></i> Testes Específicos',
                'content' => $this->render('_form_testes', ['model' => $model, 'form' => $form]),
            ],
        ],
        'position' => TabsX::POS_ABOVE,
        'encodeLabels' => false
    ]);
    ?>

    

    <?php ActiveForm::end(); ?>
</div>
