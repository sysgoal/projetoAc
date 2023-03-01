<?php
use kartik\select2\Select2;

$script = <<< JS

$('#al01').change(function() { 
    $('#botao').empty();
    var id = $(this).val();  
    $.get('index.php?r=avaliacaocoluna/get-dados-aluno', { id: id}, function(data){
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
        
        
        
JS;
$this->registerJs($script);

?>

<div class="avaliacao-superior-form">

    <br>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'dt_avaliacao')->textInput(['style' => 'width:200px', 'value' => date('d/m/Y'), 'readonly'=> true]) ?>
        </div>
        <div class="col-md-3">            
            <?= $form->field($model, 'cd_avaliacao')->textInput(['style' => 'width:200px']) ?>
        </div>   
        <div class="col-md-4">
             <?php 
                if($idAluno != null){
                    $alunos = $model->getDadoUmAluno($idAluno);
                }else{
                   $alunos = $model->getDataListAluno();
                }
            ?>
            <?=
            $form->field($model, 'id_aluno', ['options' => ['style' => 'width: 500px']])->widget(Select2::className(), [
                'model' => $model,
                'attribute' => 'id',
                'data' => $alunos,
                'options' => ['placeholder' => ' --Selecione um paciente-- ', 'id' => 'al01'],
                'language' => 'pt_BR',
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]);
            ?>     
        </div>
        <div class="col-md-2">
             <div id="botao"></div>            
 	
        </div> 
    </div>
        <div class="row">
        <div class="col-md-2">
            <?php echo '<b>Idade: </b><br>'; ?> 
            <div id ="txt"></div>
        </div>
         <div class="col-md-2">
            <?php echo '<b>Profissão: </b><br>'; ?>  
             <div id ="prof"></div>
        </div>        
         <div class="col-md-2">
            <?= $form->field($model, 'nr_tempo_servico')->textInput(['style' => 'width:100px']) ?>                         
        </div>
        <div class="col-md-2">
            <?php echo '<b>Convênio: </b><br>'; ?>  
             <div id ="conv"></div>
        </div> 
        <div class="col-md-2">
            <?php echo '<b>Cuidador: </b><br>'; ?>  
             <div id ="cuid"></div>
        </div>
        <div class="col-md-2">
            <?php echo '<b>Parentesco: </b><br>'; ?>  
             <div id ="parente"></div>
        </div>
        
    </div>

      <div class="row">
       
        <div class="col-md-6">
            <?= $form->field($model, 'ds_medico_responsavel')->textInput(['style' => 'width:500px']) ?>            
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ds_diagnostico_medico')->textarea(['style' => 'width:500px', 'rows' => 6, 'id'=>'diagnostico']) ?>
        </div>
    </div>

<?= $form->field($model, 'id_profissional')->hiddenInput(['value' => $model->getAvaliador($idProf)->id_profissional])->label(false) ?>
    

</div>
