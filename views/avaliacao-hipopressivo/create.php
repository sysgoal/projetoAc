<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Avaliacao */

//$this->title = 'Realizar Avaliação Hipopressivo';
echo '<h1><div id=nomeTitulo>Realizar Avaliação Hipopressivo</div></h1>';
?>

<?php 
$script = <<< JS

var resultadoAval;
var controleExibirDiag = false;
$('#idade').hide();
$('#al01').change(function() {
  $('#botao').empty();
  var id = $(this).val();
  $.get('index.php?r=avaliacaocoluna/get-dados-aluno', {
    id: id
  }, function(data) {         
        var data = $.parseJSON(data);
        var url = "/web/index.php?r=aluno/view&id=" + data.id;
        $("#botao").append("<a href=" + url + " target=_blank>Visualizar</a>").addClass("far fa-address-card");
        document.getElementById("prof").innerHTML = data.ds_profissao;
        var dtnasc = data.dt_nascimento;
        var hoje = new Date;
        var arrDataExclusao = dtnasc.split('/');
        var stringFormatada = arrDataExclusao[1] + '-' + arrDataExclusao[0] + '-' +
          arrDataExclusao[2];
        var dataFormatada1 = new Date(stringFormatada);
        var idade = Math.floor(Math.ceil(Math.abs(dataFormatada1.getTime() - hoje.getTime()) / (1000 * 3600 * 24)) / 365.25);
        document.getElementById("txt").innerHTML = idade + " anos ";
        $('#idade').val(idade);
         $('#nomeTitulo').html('Realizar Avaliação Hipopressivo - '+data.nm_aluno);
    });
        
         $.get('index.php?r=avaliacao/get-avaliacoes', {id: id}, function(data) {                     
             resultadoAval = parseData(data); 
            if(resultadoAval != null && resultadoAval[0] != null && resultadoAval[0].dt_avaliacao != null){
              $('#caixaDialog').dialog( 'open' ); 
              controleExibirDiag = true;
            }else{
              $('#caixaDialog').dialog( 'close' ); 
              controleExibirDiag = false;
            }
             
         }); 
});


 $('#motivo').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_motivo + '<br/>';
             });     
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Motivo</u></b> <br/>' + dadosMotivo.join(' '));        
});  
        
$('#medicoResp').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_medico_responsavel + '<br/>';
             });     
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Médico Responsável</u></b> <br/>' + dadosMotivo.join(' '));        
});
        
$('#medico').click(function() { 
        let dadosMotivo = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMotivo[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_anamnese_medico + '<br/>';
             });
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }     
            $('#historicos').html('<b><u>Anamnese</u></b> <br/>' + dadosMotivo.join(' '));        
});
 
 $('#medicamento').click(function() { 
        let dadosMedicamento = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dadosMedicamento[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_medicamento + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Medicamentos</u></b> <br/>' + dadosMedicamento.join(' '));      
});
        
$('#cirurgia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_cirurgia + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Cirurgias</u></b> <br/>' + dados.join(' '));      
});

$('#patologia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_patologia + '<br/>';
             });     
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }
            $('#historicos').html('<b><u>Patologias</u></b> <br/>' + dados.join(' '));      
});

$('#apacirc').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_aparelho_circ + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Aparelho circulatório</u></b> <br/>' + dados.join(' '));      
});

$('#endema').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_endema + '<br/>';
             });     
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }
            $('#historicos').html('<b><u>Queixas</u></b> <br/>' + dados.join(' '));      
});
      
$('#nrAgua').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.nr_litros_agua_dia + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Litros de água dia</u></b> <br/>' + dados.join(' '));      
});
        
$('#nrRefeicao').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.nr_refeicoes_dia + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Número de Refeições</u></b> <br/>' + dados.join(' '));      
});
        
$('#consumoAlcool').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_acool + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Consumo de álcool</u></b> <br/>' + dados.join(' '));      
});
        
$('#digestivo').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_comentario_disgestivo + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Digestivo</u></b> <br/>' + dados.join(' '));      
});
        
$('#sono').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_sono + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Sono</u></b> <br/>' + dados.join(' '));      
});
        
$('#alergia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_alergia + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Alergia</u></b> <br/>' + dados.join(' '));      
});

$('#comentario1').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_comentario_tabagismo + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Tabagismo</u></b> <br/>' + dados.join(' '));      
});

$('#respira').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_doenca_respiratoria + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Doença respiratória</u></b> <br/>' + dados.join(' '));      
});   

$('#dsatv').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_atividade_fisica + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Atividade física</u></b> <br/>' + dados.join(' '));      
});   
        
$('#dsdor').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_dor + '<br/>';
             });
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }     
            $('#historicos').html('<b><u>Dor</u></b> <br/>' + dados.join(' '));      
});   
        
$('#filhos').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.nr_filhos + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Filhos</u></b> <br/>' + dados.join(' '));      
});           

$('#noc').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.nr_nocturia + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Nictúria</u></b> <br/>' + dados.join(' '));      
});           
        
$('#sex').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_sexo + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Sexo</u></b> <br/>' + dados.join(' '));      
});           

$('#inco').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_incontinencia + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Incontinência</u></b> <br/>' + dados.join(' '));      
});   

$('#postural').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_avaliacao_postural + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Avaliação Postural</u></b> <br/>' + dados.join(' '));      
});  
        
        
$('#bracod').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_braco_de + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Braço D/ Braço E</u></b> <br/>' + dados.join(' '));      
});  
        
$('#torax').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_torax_abm + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Tórax</u></b> <br/>' + dados.join(' '));      
});  
    
        
$('#cintura').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_umbigo + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Perimetria umbigo</u></b> <br/>' + dados.join(' '));      
});          

$('#quadril').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_quadril + '<br/>';
             });     
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }
            $('#historicos').html('<b><u>Quadril</u></b> <br/>' + dados.join(' '));      
});  
        
$('#coxa').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_coxa_de + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Coxa D/ Coxa E</u></b> <br/>' + dados.join(' '));      
});  
        
$('#panturrilha').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_panturrilha_de + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Panturrilha D/E</u></b> <br/>' + dados.join(' '));      
});  
        
$('#peso').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_peso + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Peso</u></b> <br/>' + dados.join(' '));      
});  
        
$('#pa').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_pa + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>P.A</u></b> <br/>' + dados.join(' '));      
});  
        
$('#altura').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_altura + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Altura</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#conduta').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_conduta + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Conduta</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#dias').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_diastase + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Diastase</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#flex').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_flexibilidade + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Flexibilidade</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#competencia').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_competencia + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Competência/Tônus</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#metabolismo').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_metabolismo + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Metabolismo</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#idadeC').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_idade + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Idade Corporal</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#mGorda').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_massa_gorda + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>% de gordura</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#mMagra').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_massa_magra + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Músculo esquelético</u></b> <br/>' + dados.join(' '));      
}); 
    
$('#visceral').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_gordura_visceral + '<br/>';
             });    
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             } 
            $('#historicos').html('<b><u>Gordura visceral</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#5Acima').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_5_acima + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Perimetria +5</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#5Abaixo').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_5_abaixo + '<br/>';
             });   
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }  
            $('#historicos').html('<b><u>Perimetria -5</u></b> <br/>' + dados.join(' '));      
}); 

$('#10Acima').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_10_acima + '<br/>';
             });  
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }   
            $('#historicos').html('<b><u>Perimetria +10</u></b> <br/>' + dados.join(' '));      
}); 
        
$('#10Abaixo').click(function() { 
        let dados = [];
            $.each(resultadoAval, function (index, value) {       
                 var dtaval = value.dt_avaliacao;              
                 dados[index] =  '<b>'+formataDate(dtaval,'pt-br')+'</b>' + ' - ' + value.ds_10_abaixo + '<br/>';
             }); 
             if(controleExibirDiag){
                 $('#caixaDialog').dialog( 'open' ); 
             }    
            $('#historicos').html('<b><u>Perimetria -10</u></b> <br/>' + dados.join(' '));      
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
 
?>

<div class="avaliacao-create">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo TabsX::widget([
        'items' => [
            [
                'label' => '<i class="far fa-address-card"></i> Dados Gerais',
                'content' => $this->render('_form', ['model' => $model, 'form' => $form, 'idAluno' => $idAluno, 'idProf'=> $idProf]),
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
